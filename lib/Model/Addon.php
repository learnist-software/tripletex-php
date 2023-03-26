<?php
/**
 * Addon
 *
 * PHP version 5
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Tripletex API
 *
 * ## Usage  - **Download the spec** [swagger.json](/v2/swagger.json) file, it is a [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification).  - **Generating a client** can easily be done using tools like [swagger-codegen](https://github.com/swagger-api/swagger-codegen) or other that accepts [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) specs.     - For swagger codegen it is recommended to use the flag: **--removeOperationIdPrefix**.        Unique operation ids are about to be introduced to the spec, and this ensures forward compatibility - and results in less verbose generated code.   ## Overview  - Partial resource updating is done using the `PUT` method with optional fields instead of the `PATCH` method.  - **Actions** or **commands** are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  - **Summaries** or **aggregated** results are represented in our RESTful path with a prefixed `>`. Example: `/v2/hours/>thisWeeksBillables`.  - **Request ID** is a key found in all responses in the header with the name `x-tlx-request-id`. For validation and error responses it is also in the response body. If additional log information is absolutely necessary, our support division can locate the key value.  - **version** This is a revision number found on all persisted resources. If included, it will prevent your PUT/POST from overriding any updates to the resource since your GET.  - **Date** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DD`.  - **DateTime** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DDThh:mm:ss`.  - **Searching** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  - **Missing fields** or even **no response data** can occur because result objects and fields are filtered on authorization.  - **See [GitHub](https://github.com/Tripletex/tripletex-api2) for more documentation, examples, changelog and more.**  - **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for additional information.**   ## Authentication  - **Tokens:** The Tripletex API uses 3 different tokens    - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.    - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=1505&languageId=0)    - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header.  - **Authentication** is done via [Basic access authentication](https://en.wikipedia.org/wiki/Basic_access_authentication)    - **username** is used to specify what company to access.      - `0` or blank means the company of the employee.      - Any other value means accountant clients. Use `/company/>withLoginAccess` to get a list of those.    - **password** is the **sessionToken**.    - If you need to create the header yourself use `Authorization: Basic <encoded token>` where `encoded token` is the string `<target company id or 0>:<your session token>` Base64 encoded.   ## Tags  - `[BETA]` This is a beta endpoint and can be subject to change. - `[DEPRECATED]` Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.   ## Fields  Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements, done via `<field>(<subResourceFields>)`. `*` means all fields for that resource. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All resources and some subResources :  `*,activity(name),employee(*)`.   ## Sorting  Use the `sorting` parameter to specify sorting. It takes a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `<field>.<subObjectField>`. Example values: - `date` - `project.name` - `project.name, -date`   ## Changes  To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  **NOTE** > For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).   ## Rate limiting  Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope  #### Multiple values  ```json {   \"fullResultSize\": ###, // {number} [DEPRECATED]   \"from\": ###, // {number} Paging starting from   \"count\": ###, // {number} Paging count   \"versionDigest\": \"###\", // {string} Hash of full result, null if no result   \"values\": [...{...object...},{...object...},{...object...}...] } ```  #### Single value  ```json {   \"value\": {...single object...} } ```   ## WebHook envelope  ```json {   \"subscriptionId\": ###, // Subscription id   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Id of object this event is for   \"value\": {... single object, null if object.deleted ...} } ```   ## Error/warning envelope  ```json {   \"status\": ###, // {number} HTTP status code   \"code\": #####, // {number} internal status code of event   \"message\": \"###\", // {string} Basic feedback message in your language   \"link\": \"###\", // {string} Link to doc   \"developerMessage\": \"###\", // {string} More technical message   \"validationMessages\": [ // {array} List of validation messages, can be null     {       \"field\": \"###\", // {string} Name of field       \"message\": \"###\" // {string} Validation message for field     }   ],   \"requestId\": \"###\" // {string} Same as x-tlx-request-id  } ```   ## Status codes / Error codes  - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   -  **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000** Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception - **403 Forbidden** - When AuthorisationManager says no.   -  **9000** Security Exception - **404 Not Found** - For resources that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000** Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** - Unexpected condition was encountered and no more specific message is suitable   - **1000** Exception
 *
 * OpenAPI spec version: 2.70.19
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.41
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Learnist\Tripletex\Model;

use \ArrayAccess;
use \Learnist\Tripletex\ObjectSerializer;

/**
 * Addon Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Addon implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Addon';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'version' => 'int',
'changes' => '\Learnist\Tripletex\Model\Change[]',
'url' => 'string',
'name' => 'string',
'description' => 'string',
'short_description' => 'string',
'redirect_url' => 'string',
'status' => 'string',
'wizard_step' => 'int',
'is_public' => 'bool',
'api_consumer_id' => 'int',
'visibility' => 'string',
'link_to_info' => 'string',
'partner_name' => 'string',
'target_system_name' => 'string',
'categories' => 'string[]',
'logo' => '\Learnist\Tripletex\Model\AddonLogoDTO',
'active' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
'version' => 'int32',
'changes' => null,
'url' => null,
'name' => null,
'description' => null,
'short_description' => null,
'redirect_url' => null,
'status' => null,
'wizard_step' => 'int32',
'is_public' => null,
'api_consumer_id' => 'int32',
'visibility' => null,
'link_to_info' => null,
'partner_name' => null,
'target_system_name' => null,
'categories' => null,
'logo' => null,
'active' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
'version' => 'version',
'changes' => 'changes',
'url' => 'url',
'name' => 'name',
'description' => 'description',
'short_description' => 'shortDescription',
'redirect_url' => 'redirectUrl',
'status' => 'status',
'wizard_step' => 'wizardStep',
'is_public' => 'isPublic',
'api_consumer_id' => 'apiConsumerId',
'visibility' => 'visibility',
'link_to_info' => 'linkToInfo',
'partner_name' => 'partnerName',
'target_system_name' => 'targetSystemName',
'categories' => 'categories',
'logo' => 'logo',
'active' => 'active'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'version' => 'setVersion',
'changes' => 'setChanges',
'url' => 'setUrl',
'name' => 'setName',
'description' => 'setDescription',
'short_description' => 'setShortDescription',
'redirect_url' => 'setRedirectUrl',
'status' => 'setStatus',
'wizard_step' => 'setWizardStep',
'is_public' => 'setIsPublic',
'api_consumer_id' => 'setApiConsumerId',
'visibility' => 'setVisibility',
'link_to_info' => 'setLinkToInfo',
'partner_name' => 'setPartnerName',
'target_system_name' => 'setTargetSystemName',
'categories' => 'setCategories',
'logo' => 'setLogo',
'active' => 'setActive'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'version' => 'getVersion',
'changes' => 'getChanges',
'url' => 'getUrl',
'name' => 'getName',
'description' => 'getDescription',
'short_description' => 'getShortDescription',
'redirect_url' => 'getRedirectUrl',
'status' => 'getStatus',
'wizard_step' => 'getWizardStep',
'is_public' => 'getIsPublic',
'api_consumer_id' => 'getApiConsumerId',
'visibility' => 'getVisibility',
'link_to_info' => 'getLinkToInfo',
'partner_name' => 'getPartnerName',
'target_system_name' => 'getTargetSystemName',
'categories' => 'getCategories',
'logo' => 'getLogo',
'active' => 'getActive'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const STATUS_IN_DEVELOPMENT = 'IN_DEVELOPMENT';
const STATUS_PENDING = 'PENDING';
const STATUS_REJECTED = 'REJECTED';
const STATUS_APPROVED = 'APPROVED';
const VISIBILITY_COMPANY_WIDE = 'COMPANY_WIDE';
const VISIBILITY_PERSONAL = 'PERSONAL';
const VISIBILITY_INTERNAL = 'INTERNAL';
const CATEGORIES_OTHER = 'OTHER';
const CATEGORIES_YEAR_END = 'YEAR_END';
const CATEGORIES_BANK = 'BANK';
const CATEGORIES_STAFF = 'STAFF';
const CATEGORIES_BOOKING_AND_CHECKOUT = 'BOOKING_AND_CHECKOUT';
const CATEGORIES_CRM = 'CRM';
const CATEGORIES_DEBT_COLLECTION = 'DEBT_COLLECTION';
const CATEGORIES_ONLINE_STORE = 'ONLINE_STORE';
const CATEGORIES_HRM = 'HRM';
const CATEGORIES_REPORTING = 'REPORTING';
const CATEGORIES_TRAVEL_AND_EXPENSES = 'TRAVEL_AND_EXPENSES';
const CATEGORIES_RECONCILLIATION = 'RECONCILLIATION';
const CATEGORIES_PAYMENT_SERVICES = 'PAYMENT_SERVICES';
const CATEGORIES_CHECKOUT = 'CHECKOUT';
const CATEGORIES_FAG_SYSTEMER = 'FAG_SYSTEMER';
const CATEGORIES_FINANCIAL_SERVICES = 'FINANCIAL_SERVICES';
const CATEGORIES_PROJECT = 'PROJECT';
const CATEGORIES_MILAGE = 'MILAGE';
const CATEGORIES_WAREHOUSE_LOGISTICS = 'WAREHOUSE_LOGISTICS';
const CATEGORIES_TIMESHEET = 'TIMESHEET';
const CATEGORIES_BOARD_WORK = 'BOARD_WORK';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_IN_DEVELOPMENT,
self::STATUS_PENDING,
self::STATUS_REJECTED,
self::STATUS_APPROVED,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVisibilityAllowableValues()
    {
        return [
            self::VISIBILITY_COMPANY_WIDE,
self::VISIBILITY_PERSONAL,
self::VISIBILITY_INTERNAL,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getCategoriesAllowableValues()
    {
        return [
            self::CATEGORIES_OTHER,
self::CATEGORIES_YEAR_END,
self::CATEGORIES_BANK,
self::CATEGORIES_STAFF,
self::CATEGORIES_BOOKING_AND_CHECKOUT,
self::CATEGORIES_CRM,
self::CATEGORIES_DEBT_COLLECTION,
self::CATEGORIES_ONLINE_STORE,
self::CATEGORIES_HRM,
self::CATEGORIES_REPORTING,
self::CATEGORIES_TRAVEL_AND_EXPENSES,
self::CATEGORIES_RECONCILLIATION,
self::CATEGORIES_PAYMENT_SERVICES,
self::CATEGORIES_CHECKOUT,
self::CATEGORIES_FAG_SYSTEMER,
self::CATEGORIES_FINANCIAL_SERVICES,
self::CATEGORIES_PROJECT,
self::CATEGORIES_MILAGE,
self::CATEGORIES_WAREHOUSE_LOGISTICS,
self::CATEGORIES_TIMESHEET,
self::CATEGORIES_BOARD_WORK,        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['short_description'] = isset($data['short_description']) ? $data['short_description'] : null;
        $this->container['redirect_url'] = isset($data['redirect_url']) ? $data['redirect_url'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['wizard_step'] = isset($data['wizard_step']) ? $data['wizard_step'] : null;
        $this->container['is_public'] = isset($data['is_public']) ? $data['is_public'] : null;
        $this->container['api_consumer_id'] = isset($data['api_consumer_id']) ? $data['api_consumer_id'] : null;
        $this->container['visibility'] = isset($data['visibility']) ? $data['visibility'] : null;
        $this->container['link_to_info'] = isset($data['link_to_info']) ? $data['link_to_info'] : null;
        $this->container['partner_name'] = isset($data['partner_name']) ? $data['partner_name'] : null;
        $this->container['target_system_name'] = isset($data['target_system_name']) ? $data['target_system_name'] : null;
        $this->container['categories'] = isset($data['categories']) ? $data['categories'] : null;
        $this->container['logo'] = isset($data['logo']) ? $data['logo'] : null;
        $this->container['active'] = isset($data['active']) ? $data['active'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVisibilityAllowableValues();
        if (!is_null($this->container['visibility']) && !in_array($this->container['visibility'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'visibility', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int $version version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return \Learnist\Tripletex\Model\Change[]
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param \Learnist\Tripletex\Model\Change[] $changes changes
     *
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets short_description
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->container['short_description'];
    }

    /**
     * Sets short_description
     *
     * @param string $short_description short_description
     *
     * @return $this
     */
    public function setShortDescription($short_description)
    {
        $this->container['short_description'] = $short_description;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string $redirect_url redirect_url
     *
     * @return $this
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets wizard_step
     *
     * @return int
     */
    public function getWizardStep()
    {
        return $this->container['wizard_step'];
    }

    /**
     * Sets wizard_step
     *
     * @param int $wizard_step wizard_step
     *
     * @return $this
     */
    public function setWizardStep($wizard_step)
    {
        $this->container['wizard_step'] = $wizard_step;

        return $this;
    }

    /**
     * Gets is_public
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->container['is_public'];
    }

    /**
     * Sets is_public
     *
     * @param bool $is_public is_public
     *
     * @return $this
     */
    public function setIsPublic($is_public)
    {
        $this->container['is_public'] = $is_public;

        return $this;
    }

    /**
     * Gets api_consumer_id
     *
     * @return int
     */
    public function getApiConsumerId()
    {
        return $this->container['api_consumer_id'];
    }

    /**
     * Sets api_consumer_id
     *
     * @param int $api_consumer_id api_consumer_id
     *
     * @return $this
     */
    public function setApiConsumerId($api_consumer_id)
    {
        $this->container['api_consumer_id'] = $api_consumer_id;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param string $visibility visibility
     *
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $allowedValues = $this->getVisibilityAllowableValues();
        if (!is_null($visibility) && !in_array($visibility, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'visibility', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets link_to_info
     *
     * @return string
     */
    public function getLinkToInfo()
    {
        return $this->container['link_to_info'];
    }

    /**
     * Sets link_to_info
     *
     * @param string $link_to_info link_to_info
     *
     * @return $this
     */
    public function setLinkToInfo($link_to_info)
    {
        $this->container['link_to_info'] = $link_to_info;

        return $this;
    }

    /**
     * Gets partner_name
     *
     * @return string
     */
    public function getPartnerName()
    {
        return $this->container['partner_name'];
    }

    /**
     * Sets partner_name
     *
     * @param string $partner_name partner_name
     *
     * @return $this
     */
    public function setPartnerName($partner_name)
    {
        $this->container['partner_name'] = $partner_name;

        return $this;
    }

    /**
     * Gets target_system_name
     *
     * @return string
     */
    public function getTargetSystemName()
    {
        return $this->container['target_system_name'];
    }

    /**
     * Sets target_system_name
     *
     * @param string $target_system_name target_system_name
     *
     * @return $this
     */
    public function setTargetSystemName($target_system_name)
    {
        $this->container['target_system_name'] = $target_system_name;

        return $this;
    }

    /**
     * Gets categories
     *
     * @return string[]
     */
    public function getCategories()
    {
        return $this->container['categories'];
    }

    /**
     * Sets categories
     *
     * @param string[] $categories categories
     *
     * @return $this
     */
    public function setCategories($categories)
    {
        $allowedValues = $this->getCategoriesAllowableValues();
        if (!is_null($categories) && array_diff($categories, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'categories', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['categories'] = $categories;

        return $this;
    }

    /**
     * Gets logo
     *
     * @return \Learnist\Tripletex\Model\AddonLogoDTO
     */
    public function getLogo()
    {
        return $this->container['logo'];
    }

    /**
     * Sets logo
     *
     * @param \Learnist\Tripletex\Model\AddonLogoDTO $logo logo
     *
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->container['logo'] = $logo;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool $active active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->container['active'] = $active;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
