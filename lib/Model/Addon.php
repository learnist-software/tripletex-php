<?php
/**
 * Addon
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Tripletex API
 *
 * ## Usage  - **Download the spec** [swagger.json](/v2/swagger.json) file, it is a [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification).  - **Generating a client** can easily be done using tools like [swagger-codegen](https://github.com/swagger-api/swagger-codegen) or other that accepts [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) specs.     - For swagger codegen it is recommended to use the flag: **--removeOperationIdPrefix**.        Unique operation ids are about to be introduced to the spec, and this ensures forward compatibility - and results in less verbose generated code.   ## Overview  - Partial resource updating is done using the `PUT` method with optional fields instead of the `PATCH` method.  - **Actions** or **commands** are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  - **Summaries** or **aggregated** results are represented in our RESTful path with a prefixed `>`. Example: `/v2/hours/>thisWeeksBillables`.  - **Request ID** is a key found in all responses in the header with the name `x-tlx-request-id`. For validation and error responses it is also in the response body. If additional log information is absolutely necessary, our support division can locate the key value.  - **version** This is a revision number found on all persisted resources. If included, it will prevent your PUT/POST from overriding any updates to the resource since your GET.  - **Date** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DD`.  - **DateTime** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DDThh:mm:ss`.  - **Searching** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  - **Missing fields** or even **no response data** can occur because result objects and fields are filtered on authorization.  - **See [GitHub](https://github.com/Tripletex/tripletex-api2) for more documentation, examples, changelog and more.**  - **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for additional information.**   ## Authentication  - **Tokens:** The Tripletex API uses 3 different tokens    - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.    - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=1505&languageId=0)    - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header.  - **Authentication** is done via [Basic access authentication](https://en.wikipedia.org/wiki/Basic_access_authentication)    - **username** is used to specify what company to access.      - `0` or blank means the company of the employee.      - Any other value means accountant clients. Use `/company/>withLoginAccess` to get a list of those.    - **password** is the **sessionToken**.    - If you need to create the header yourself use `Authorization: Basic <encoded token>` where `encoded token` is the string `<target company id or 0>:<your session token>` Base64 encoded.   ## Tags  - `[BETA]` This is a beta endpoint and can be subject to change. - `[DEPRECATED]` Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.   ## Fields  Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements, done via `<field>(<subResourceFields>)`. `*` means all fields for that resource. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All resources and some subResources :  `*,activity(name),employee(*)`.   ## Sorting  Use the `sorting` parameter to specify sorting. It takes a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `<field>.<subObjectField>`. Example values: - `date` - `project.name` - `project.name, -date`   ## Changes  To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  **NOTE** > For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).   ## Rate limiting  Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope  #### Multiple values  ```json {   \"fullResultSize\": ###, // {number} [DEPRECATED]   \"from\": ###, // {number} Paging starting from   \"count\": ###, // {number} Paging count   \"versionDigest\": \"###\", // {string} Hash of full result, null if no result   \"values\": [...{...object...},{...object...},{...object...}...] } ```  #### Single value  ```json {   \"value\": {...single object...} } ```   ## WebHook envelope  ```json {   \"subscriptionId\": ###, // Subscription id   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Id of object this event is for   \"value\": {... single object, null if object.deleted ...} } ```   ## Error/warning envelope  ```json {   \"status\": ###, // {number} HTTP status code   \"code\": #####, // {number} internal status code of event   \"message\": \"###\", // {string} Basic feedback message in your language   \"link\": \"###\", // {string} Link to doc   \"developerMessage\": \"###\", // {string} More technical message   \"validationMessages\": [ // {array} List of validation messages, can be null     {       \"field\": \"###\", // {string} Name of field       \"message\": \"###\" // {string} Validation message for field     }   ],   \"requestId\": \"###\" // {string} Same as x-tlx-request-id  } ```   ## Status codes / Error codes  - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   -  **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000** Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception - **403 Forbidden** - When AuthorisationManager says no.   -  **9000** Security Exception - **404 Not Found** - For resources that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000** Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** - Unexpected condition was encountered and no more specific message is suitable   - **1000** Exception
 *
 * The version of the OpenAPI document: 2.70.19
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.3.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
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
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Addon implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Addon';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'active' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'active' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'version' => false,
		'changes' => false,
		'url' => false,
		'name' => false,
		'description' => false,
		'short_description' => false,
		'redirect_url' => false,
		'status' => false,
		'wizard_step' => false,
		'is_public' => false,
		'api_consumer_id' => false,
		'visibility' => false,
		'link_to_info' => false,
		'partner_name' => false,
		'target_system_name' => false,
		'categories' => false,
		'logo' => false,
		'active' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
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
        'active' => 'active'
    ];

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
        'active' => 'setActive'
    ];

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
        'active' => 'getActive'
    ];

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
        return self::$openAPIModelName;
    }

    public const STATUS_IN_DEVELOPMENT = 'IN_DEVELOPMENT';
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_REJECTED = 'REJECTED';
    public const STATUS_APPROVED = 'APPROVED';
    public const VISIBILITY_COMPANY_WIDE = 'COMPANY_WIDE';
    public const VISIBILITY_PERSONAL = 'PERSONAL';
    public const VISIBILITY_INTERNAL = 'INTERNAL';
    public const CATEGORIES_OTHER = 'OTHER';
    public const CATEGORIES_YEAR_END = 'YEAR_END';
    public const CATEGORIES_BANK = 'BANK';
    public const CATEGORIES_STAFF = 'STAFF';
    public const CATEGORIES_BOOKING_AND_CHECKOUT = 'BOOKING_AND_CHECKOUT';
    public const CATEGORIES_CRM = 'CRM';
    public const CATEGORIES_DEBT_COLLECTION = 'DEBT_COLLECTION';
    public const CATEGORIES_ONLINE_STORE = 'ONLINE_STORE';
    public const CATEGORIES_HRM = 'HRM';
    public const CATEGORIES_REPORTING = 'REPORTING';
    public const CATEGORIES_TRAVEL_AND_EXPENSES = 'TRAVEL_AND_EXPENSES';
    public const CATEGORIES_RECONCILLIATION = 'RECONCILLIATION';
    public const CATEGORIES_PAYMENT_SERVICES = 'PAYMENT_SERVICES';
    public const CATEGORIES_CHECKOUT = 'CHECKOUT';
    public const CATEGORIES_FAG_SYSTEMER = 'FAG_SYSTEMER';
    public const CATEGORIES_FINANCIAL_SERVICES = 'FINANCIAL_SERVICES';
    public const CATEGORIES_PROJECT = 'PROJECT';
    public const CATEGORIES_MILAGE = 'MILAGE';
    public const CATEGORIES_WAREHOUSE_LOGISTICS = 'WAREHOUSE_LOGISTICS';
    public const CATEGORIES_TIMESHEET = 'TIMESHEET';
    public const CATEGORIES_BOARD_WORK = 'BOARD_WORK';

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
            self::STATUS_APPROVED,
        ];
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
            self::VISIBILITY_INTERNAL,
        ];
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
            self::CATEGORIES_BOARD_WORK,
        ];
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('short_description', $data ?? [], null);
        $this->setIfExists('redirect_url', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('wizard_step', $data ?? [], null);
        $this->setIfExists('is_public', $data ?? [], null);
        $this->setIfExists('api_consumer_id', $data ?? [], null);
        $this->setIfExists('visibility', $data ?? [], null);
        $this->setIfExists('link_to_info', $data ?? [], null);
        $this->setIfExists('partner_name', $data ?? [], null);
        $this->setIfExists('target_system_name', $data ?? [], null);
        $this->setIfExists('categories', $data ?? [], null);
        $this->setIfExists('logo', $data ?? [], null);
        $this->setIfExists('active', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) > 80)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 80.";
        }

        if (!is_null($this->container['description']) && (mb_strlen($this->container['description']) > 1024)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 1024.";
        }

        if (!is_null($this->container['short_description']) && (mb_strlen($this->container['short_description']) > 150)) {
            $invalidProperties[] = "invalid value for 'short_description', the character length must be smaller than or equal to 150.";
        }

        if (!is_null($this->container['redirect_url']) && (mb_strlen($this->container['redirect_url']) > 1024)) {
            $invalidProperties[] = "invalid value for 'redirect_url', the character length must be smaller than or equal to 1024.";
        }

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['wizard_step']) && ($this->container['wizard_step'] < 1)) {
            $invalidProperties[] = "invalid value for 'wizard_step', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getVisibilityAllowableValues();
        if (!is_null($this->container['visibility']) && !in_array($this->container['visibility'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'visibility', must be one of '%s'",
                $this->container['visibility'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['link_to_info']) && (mb_strlen($this->container['link_to_info']) > 1024)) {
            $invalidProperties[] = "invalid value for 'link_to_info', the character length must be smaller than or equal to 1024.";
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
     * @return int|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int|null $id id
     *
     * @return self
     */
    public function setId($id)
    {

        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets version
     *
     * @return int|null
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int|null $version version
     *
     * @return self
     */
    public function setVersion($version)
    {

        if (is_null($version)) {
            throw new \InvalidArgumentException('non-nullable version cannot be null');
        }

        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return \Learnist\Tripletex\Model\Change[]|null
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param \Learnist\Tripletex\Model\Change[]|null $changes changes
     *
     * @return self
     */
    public function setChanges($changes)
    {

        if (is_null($changes)) {
            throw new \InvalidArgumentException('non-nullable changes cannot be null');
        }

        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string|null $url url
     *
     * @return self
     */
    public function setUrl($url)
    {

        if (is_null($url)) {
            throw new \InvalidArgumentException('non-nullable url cannot be null');
        }

        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (!is_null($name) && (mb_strlen($name) > 80)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Addon., must be smaller than or equal to 80.');
        }


        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (!is_null($description) && (mb_strlen($description) > 1024)) {
            throw new \InvalidArgumentException('invalid length for $description when calling Addon., must be smaller than or equal to 1024.');
        }


        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets short_description
     *
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->container['short_description'];
    }

    /**
     * Sets short_description
     *
     * @param string|null $short_description short_description
     *
     * @return self
     */
    public function setShortDescription($short_description)
    {
        if (!is_null($short_description) && (mb_strlen($short_description) > 150)) {
            throw new \InvalidArgumentException('invalid length for $short_description when calling Addon., must be smaller than or equal to 150.');
        }


        if (is_null($short_description)) {
            throw new \InvalidArgumentException('non-nullable short_description cannot be null');
        }

        $this->container['short_description'] = $short_description;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string|null $redirect_url redirect_url
     *
     * @return self
     */
    public function setRedirectUrl($redirect_url)
    {
        if (!is_null($redirect_url) && (mb_strlen($redirect_url) > 1024)) {
            throw new \InvalidArgumentException('invalid length for $redirect_url when calling Addon., must be smaller than or equal to 1024.');
        }


        if (is_null($redirect_url)) {
            throw new \InvalidArgumentException('non-nullable redirect_url cannot be null');
        }

        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }

        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets wizard_step
     *
     * @return int|null
     */
    public function getWizardStep()
    {
        return $this->container['wizard_step'];
    }

    /**
     * Sets wizard_step
     *
     * @param int|null $wizard_step wizard_step
     *
     * @return self
     */
    public function setWizardStep($wizard_step)
    {

        if (!is_null($wizard_step) && ($wizard_step < 1)) {
            throw new \InvalidArgumentException('invalid value for $wizard_step when calling Addon., must be bigger than or equal to 1.');
        }


        if (is_null($wizard_step)) {
            throw new \InvalidArgumentException('non-nullable wizard_step cannot be null');
        }

        $this->container['wizard_step'] = $wizard_step;

        return $this;
    }

    /**
     * Gets is_public
     *
     * @return bool|null
     */
    public function getIsPublic()
    {
        return $this->container['is_public'];
    }

    /**
     * Sets is_public
     *
     * @param bool|null $is_public is_public
     *
     * @return self
     */
    public function setIsPublic($is_public)
    {

        if (is_null($is_public)) {
            throw new \InvalidArgumentException('non-nullable is_public cannot be null');
        }

        $this->container['is_public'] = $is_public;

        return $this;
    }

    /**
     * Gets api_consumer_id
     *
     * @return int|null
     */
    public function getApiConsumerId()
    {
        return $this->container['api_consumer_id'];
    }

    /**
     * Sets api_consumer_id
     *
     * @param int|null $api_consumer_id api_consumer_id
     *
     * @return self
     */
    public function setApiConsumerId($api_consumer_id)
    {

        if (is_null($api_consumer_id)) {
            throw new \InvalidArgumentException('non-nullable api_consumer_id cannot be null');
        }

        $this->container['api_consumer_id'] = $api_consumer_id;

        return $this;
    }

    /**
     * Gets visibility
     *
     * @return string|null
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     *
     * @param string|null $visibility visibility
     *
     * @return self
     */
    public function setVisibility($visibility)
    {
        $allowedValues = $this->getVisibilityAllowableValues();
        if (!is_null($visibility) && !in_array($visibility, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'visibility', must be one of '%s'",
                    $visibility,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($visibility)) {
            throw new \InvalidArgumentException('non-nullable visibility cannot be null');
        }

        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets link_to_info
     *
     * @return string|null
     */
    public function getLinkToInfo()
    {
        return $this->container['link_to_info'];
    }

    /**
     * Sets link_to_info
     *
     * @param string|null $link_to_info link_to_info
     *
     * @return self
     */
    public function setLinkToInfo($link_to_info)
    {
        if (!is_null($link_to_info) && (mb_strlen($link_to_info) > 1024)) {
            throw new \InvalidArgumentException('invalid length for $link_to_info when calling Addon., must be smaller than or equal to 1024.');
        }


        if (is_null($link_to_info)) {
            throw new \InvalidArgumentException('non-nullable link_to_info cannot be null');
        }

        $this->container['link_to_info'] = $link_to_info;

        return $this;
    }

    /**
     * Gets partner_name
     *
     * @return string|null
     */
    public function getPartnerName()
    {
        return $this->container['partner_name'];
    }

    /**
     * Sets partner_name
     *
     * @param string|null $partner_name partner_name
     *
     * @return self
     */
    public function setPartnerName($partner_name)
    {

        if (is_null($partner_name)) {
            throw new \InvalidArgumentException('non-nullable partner_name cannot be null');
        }

        $this->container['partner_name'] = $partner_name;

        return $this;
    }

    /**
     * Gets target_system_name
     *
     * @return string|null
     */
    public function getTargetSystemName()
    {
        return $this->container['target_system_name'];
    }

    /**
     * Sets target_system_name
     *
     * @param string|null $target_system_name target_system_name
     *
     * @return self
     */
    public function setTargetSystemName($target_system_name)
    {

        if (is_null($target_system_name)) {
            throw new \InvalidArgumentException('non-nullable target_system_name cannot be null');
        }

        $this->container['target_system_name'] = $target_system_name;

        return $this;
    }

    /**
     * Gets categories
     *
     * @return string[]|null
     */
    public function getCategories()
    {
        return $this->container['categories'];
    }

    /**
     * Sets categories
     *
     * @param string[]|null $categories categories
     *
     * @return self
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

        if (is_null($categories)) {
            throw new \InvalidArgumentException('non-nullable categories cannot be null');
        }

        $this->container['categories'] = $categories;

        return $this;
    }

    /**
     * Gets logo
     *
     * @return \Learnist\Tripletex\Model\AddonLogoDTO|null
     */
    public function getLogo()
    {
        return $this->container['logo'];
    }

    /**
     * Sets logo
     *
     * @param \Learnist\Tripletex\Model\AddonLogoDTO|null $logo logo
     *
     * @return self
     */
    public function setLogo($logo)
    {

        if (is_null($logo)) {
            throw new \InvalidArgumentException('non-nullable logo cannot be null');
        }

        $this->container['logo'] = $logo;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active active
     *
     * @return self
     */
    public function setActive($active)
    {

        if (is_null($active)) {
            throw new \InvalidArgumentException('non-nullable active cannot be null');
        }

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
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
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
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


