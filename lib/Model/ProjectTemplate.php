<?php
/**
 * ProjectTemplate
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
 * ProjectTemplate Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProjectTemplate implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ProjectTemplate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
'start_date' => 'string',
'end_date' => 'string',
'is_internal' => 'bool',
'number' => 'string',
'display_name_format' => 'string',
'project_manager' => '\Learnist\Tripletex\Model\Employee',
'department' => '\Learnist\Tripletex\Model\Department',
'main_project' => '\Learnist\Tripletex\Model\Project',
'project_category' => '\Learnist\Tripletex\Model\ProjectCategory',
'reference' => 'string',
'external_accounts_number' => 'string',
'description' => 'string',
'invoice_comment' => 'string',
'attention' => '\Learnist\Tripletex\Model\Contact',
'contact' => '\Learnist\Tripletex\Model\Contact',
'customer' => '\Learnist\Tripletex\Model\Customer',
'delivery_address' => '\Learnist\Tripletex\Model\DeliveryAddress',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'currency' => '\Learnist\Tripletex\Model\Currency',
'mark_up_order_lines' => 'float',
'mark_up_fees_earned' => 'float',
'is_fixed_price' => 'bool',
'fixedprice' => 'float',
'is_price_ceiling' => 'bool',
'price_ceiling_amount' => 'float',
'general_project_activities_per_project_only' => 'bool',
'for_participants_only' => 'bool',
'project_hourly_rates' => '\Learnist\Tripletex\Model\ProjectHourlyRateTemplate[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
'start_date' => null,
'end_date' => null,
'is_internal' => null,
'number' => null,
'display_name_format' => null,
'project_manager' => null,
'department' => null,
'main_project' => null,
'project_category' => null,
'reference' => null,
'external_accounts_number' => null,
'description' => null,
'invoice_comment' => null,
'attention' => null,
'contact' => null,
'customer' => null,
'delivery_address' => null,
'vat_type' => null,
'currency' => null,
'mark_up_order_lines' => null,
'mark_up_fees_earned' => null,
'is_fixed_price' => null,
'fixedprice' => null,
'is_price_ceiling' => null,
'price_ceiling_amount' => null,
'general_project_activities_per_project_only' => null,
'for_participants_only' => null,
'project_hourly_rates' => null    ];

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
        'name' => 'name',
'start_date' => 'startDate',
'end_date' => 'endDate',
'is_internal' => 'isInternal',
'number' => 'number',
'display_name_format' => 'displayNameFormat',
'project_manager' => 'projectManager',
'department' => 'department',
'main_project' => 'mainProject',
'project_category' => 'projectCategory',
'reference' => 'reference',
'external_accounts_number' => 'externalAccountsNumber',
'description' => 'description',
'invoice_comment' => 'invoiceComment',
'attention' => 'attention',
'contact' => 'contact',
'customer' => 'customer',
'delivery_address' => 'deliveryAddress',
'vat_type' => 'vatType',
'currency' => 'currency',
'mark_up_order_lines' => 'markUpOrderLines',
'mark_up_fees_earned' => 'markUpFeesEarned',
'is_fixed_price' => 'isFixedPrice',
'fixedprice' => 'fixedprice',
'is_price_ceiling' => 'isPriceCeiling',
'price_ceiling_amount' => 'priceCeilingAmount',
'general_project_activities_per_project_only' => 'generalProjectActivitiesPerProjectOnly',
'for_participants_only' => 'forParticipantsOnly',
'project_hourly_rates' => 'projectHourlyRates'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
'start_date' => 'setStartDate',
'end_date' => 'setEndDate',
'is_internal' => 'setIsInternal',
'number' => 'setNumber',
'display_name_format' => 'setDisplayNameFormat',
'project_manager' => 'setProjectManager',
'department' => 'setDepartment',
'main_project' => 'setMainProject',
'project_category' => 'setProjectCategory',
'reference' => 'setReference',
'external_accounts_number' => 'setExternalAccountsNumber',
'description' => 'setDescription',
'invoice_comment' => 'setInvoiceComment',
'attention' => 'setAttention',
'contact' => 'setContact',
'customer' => 'setCustomer',
'delivery_address' => 'setDeliveryAddress',
'vat_type' => 'setVatType',
'currency' => 'setCurrency',
'mark_up_order_lines' => 'setMarkUpOrderLines',
'mark_up_fees_earned' => 'setMarkUpFeesEarned',
'is_fixed_price' => 'setIsFixedPrice',
'fixedprice' => 'setFixedprice',
'is_price_ceiling' => 'setIsPriceCeiling',
'price_ceiling_amount' => 'setPriceCeilingAmount',
'general_project_activities_per_project_only' => 'setGeneralProjectActivitiesPerProjectOnly',
'for_participants_only' => 'setForParticipantsOnly',
'project_hourly_rates' => 'setProjectHourlyRates'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
'start_date' => 'getStartDate',
'end_date' => 'getEndDate',
'is_internal' => 'getIsInternal',
'number' => 'getNumber',
'display_name_format' => 'getDisplayNameFormat',
'project_manager' => 'getProjectManager',
'department' => 'getDepartment',
'main_project' => 'getMainProject',
'project_category' => 'getProjectCategory',
'reference' => 'getReference',
'external_accounts_number' => 'getExternalAccountsNumber',
'description' => 'getDescription',
'invoice_comment' => 'getInvoiceComment',
'attention' => 'getAttention',
'contact' => 'getContact',
'customer' => 'getCustomer',
'delivery_address' => 'getDeliveryAddress',
'vat_type' => 'getVatType',
'currency' => 'getCurrency',
'mark_up_order_lines' => 'getMarkUpOrderLines',
'mark_up_fees_earned' => 'getMarkUpFeesEarned',
'is_fixed_price' => 'getIsFixedPrice',
'fixedprice' => 'getFixedprice',
'is_price_ceiling' => 'getIsPriceCeiling',
'price_ceiling_amount' => 'getPriceCeilingAmount',
'general_project_activities_per_project_only' => 'getGeneralProjectActivitiesPerProjectOnly',
'for_participants_only' => 'getForParticipantsOnly',
'project_hourly_rates' => 'getProjectHourlyRates'    ];

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

    const DISPLAY_NAME_FORMAT_STANDARD = 'NAME_STANDARD';
const DISPLAY_NAME_FORMAT_INCL_CUSTOMER_NAME = 'NAME_INCL_CUSTOMER_NAME';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME = 'NAME_INCL_PARENT_NAME';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NUMBER = 'NAME_INCL_PARENT_NUMBER';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER = 'NAME_INCL_PARENT_NAME_AND_NUMBER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDisplayNameFormatAllowableValues()
    {
        return [
            self::DISPLAY_NAME_FORMAT_STANDARD,
self::DISPLAY_NAME_FORMAT_INCL_CUSTOMER_NAME,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NAME,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NUMBER,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['is_internal'] = isset($data['is_internal']) ? $data['is_internal'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['display_name_format'] = isset($data['display_name_format']) ? $data['display_name_format'] : null;
        $this->container['project_manager'] = isset($data['project_manager']) ? $data['project_manager'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['main_project'] = isset($data['main_project']) ? $data['main_project'] : null;
        $this->container['project_category'] = isset($data['project_category']) ? $data['project_category'] : null;
        $this->container['reference'] = isset($data['reference']) ? $data['reference'] : null;
        $this->container['external_accounts_number'] = isset($data['external_accounts_number']) ? $data['external_accounts_number'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['invoice_comment'] = isset($data['invoice_comment']) ? $data['invoice_comment'] : null;
        $this->container['attention'] = isset($data['attention']) ? $data['attention'] : null;
        $this->container['contact'] = isset($data['contact']) ? $data['contact'] : null;
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['delivery_address'] = isset($data['delivery_address']) ? $data['delivery_address'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['mark_up_order_lines'] = isset($data['mark_up_order_lines']) ? $data['mark_up_order_lines'] : null;
        $this->container['mark_up_fees_earned'] = isset($data['mark_up_fees_earned']) ? $data['mark_up_fees_earned'] : null;
        $this->container['is_fixed_price'] = isset($data['is_fixed_price']) ? $data['is_fixed_price'] : null;
        $this->container['fixedprice'] = isset($data['fixedprice']) ? $data['fixedprice'] : null;
        $this->container['is_price_ceiling'] = isset($data['is_price_ceiling']) ? $data['is_price_ceiling'] : null;
        $this->container['price_ceiling_amount'] = isset($data['price_ceiling_amount']) ? $data['price_ceiling_amount'] : null;
        $this->container['general_project_activities_per_project_only'] = isset($data['general_project_activities_per_project_only']) ? $data['general_project_activities_per_project_only'] : null;
        $this->container['for_participants_only'] = isset($data['for_participants_only']) ? $data['for_participants_only'] : null;
        $this->container['project_hourly_rates'] = isset($data['project_hourly_rates']) ? $data['project_hourly_rates'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDisplayNameFormatAllowableValues();
        if (!is_null($this->container['display_name_format']) && !in_array($this->container['display_name_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'display_name_format', must be one of '%s'",
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
     * Gets start_date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string $start_date start_date
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string $end_date end_date
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets is_internal
     *
     * @return bool
     */
    public function getIsInternal()
    {
        return $this->container['is_internal'];
    }

    /**
     * Sets is_internal
     *
     * @param bool $is_internal is_internal
     *
     * @return $this
     */
    public function setIsInternal($is_internal)
    {
        $this->container['is_internal'] = $is_internal;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets display_name_format
     *
     * @return string
     */
    public function getDisplayNameFormat()
    {
        return $this->container['display_name_format'];
    }

    /**
     * Sets display_name_format
     *
     * @param string $display_name_format display_name_format
     *
     * @return $this
     */
    public function setDisplayNameFormat($display_name_format)
    {
        $allowedValues = $this->getDisplayNameFormatAllowableValues();
        if (!is_null($display_name_format) && !in_array($display_name_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'display_name_format', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['display_name_format'] = $display_name_format;

        return $this;
    }

    /**
     * Gets project_manager
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getProjectManager()
    {
        return $this->container['project_manager'];
    }

    /**
     * Sets project_manager
     *
     * @param \Learnist\Tripletex\Model\Employee $project_manager project_manager
     *
     * @return $this
     */
    public function setProjectManager($project_manager)
    {
        $this->container['project_manager'] = $project_manager;

        return $this;
    }

    /**
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department $department department
     *
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets main_project
     *
     * @return \Learnist\Tripletex\Model\Project
     */
    public function getMainProject()
    {
        return $this->container['main_project'];
    }

    /**
     * Sets main_project
     *
     * @param \Learnist\Tripletex\Model\Project $main_project main_project
     *
     * @return $this
     */
    public function setMainProject($main_project)
    {
        $this->container['main_project'] = $main_project;

        return $this;
    }

    /**
     * Gets project_category
     *
     * @return \Learnist\Tripletex\Model\ProjectCategory
     */
    public function getProjectCategory()
    {
        return $this->container['project_category'];
    }

    /**
     * Sets project_category
     *
     * @param \Learnist\Tripletex\Model\ProjectCategory $project_category project_category
     *
     * @return $this
     */
    public function setProjectCategory($project_category)
    {
        $this->container['project_category'] = $project_category;

        return $this;
    }

    /**
     * Gets reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->container['reference'];
    }

    /**
     * Sets reference
     *
     * @param string $reference reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->container['reference'] = $reference;

        return $this;
    }

    /**
     * Gets external_accounts_number
     *
     * @return string
     */
    public function getExternalAccountsNumber()
    {
        return $this->container['external_accounts_number'];
    }

    /**
     * Sets external_accounts_number
     *
     * @param string $external_accounts_number external_accounts_number
     *
     * @return $this
     */
    public function setExternalAccountsNumber($external_accounts_number)
    {
        $this->container['external_accounts_number'] = $external_accounts_number;

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
     * Gets invoice_comment
     *
     * @return string
     */
    public function getInvoiceComment()
    {
        return $this->container['invoice_comment'];
    }

    /**
     * Sets invoice_comment
     *
     * @param string $invoice_comment Comment for project invoices
     *
     * @return $this
     */
    public function setInvoiceComment($invoice_comment)
    {
        $this->container['invoice_comment'] = $invoice_comment;

        return $this;
    }

    /**
     * Gets attention
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getAttention()
    {
        return $this->container['attention'];
    }

    /**
     * Sets attention
     *
     * @param \Learnist\Tripletex\Model\Contact $attention attention
     *
     * @return $this
     */
    public function setAttention($attention)
    {
        $this->container['attention'] = $attention;

        return $this;
    }

    /**
     * Gets contact
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \Learnist\Tripletex\Model\Contact $contact contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Customer
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Customer $customer customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets delivery_address
     *
     * @return \Learnist\Tripletex\Model\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->container['delivery_address'];
    }

    /**
     * Sets delivery_address
     *
     * @param \Learnist\Tripletex\Model\DeliveryAddress $delivery_address delivery_address
     *
     * @return $this
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->container['delivery_address'] = $delivery_address;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType $vat_type vat_type
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets mark_up_order_lines
     *
     * @return float
     */
    public function getMarkUpOrderLines()
    {
        return $this->container['mark_up_order_lines'];
    }

    /**
     * Sets mark_up_order_lines
     *
     * @param float $mark_up_order_lines Set mark-up (%) for order lines.
     *
     * @return $this
     */
    public function setMarkUpOrderLines($mark_up_order_lines)
    {
        $this->container['mark_up_order_lines'] = $mark_up_order_lines;

        return $this;
    }

    /**
     * Gets mark_up_fees_earned
     *
     * @return float
     */
    public function getMarkUpFeesEarned()
    {
        return $this->container['mark_up_fees_earned'];
    }

    /**
     * Sets mark_up_fees_earned
     *
     * @param float $mark_up_fees_earned Set mark-up (%) for fees earned.
     *
     * @return $this
     */
    public function setMarkUpFeesEarned($mark_up_fees_earned)
    {
        $this->container['mark_up_fees_earned'] = $mark_up_fees_earned;

        return $this;
    }

    /**
     * Gets is_fixed_price
     *
     * @return bool
     */
    public function getIsFixedPrice()
    {
        return $this->container['is_fixed_price'];
    }

    /**
     * Sets is_fixed_price
     *
     * @param bool $is_fixed_price Project is fixed price if set to true, hourly rate if set to false.
     *
     * @return $this
     */
    public function setIsFixedPrice($is_fixed_price)
    {
        $this->container['is_fixed_price'] = $is_fixed_price;

        return $this;
    }

    /**
     * Gets fixedprice
     *
     * @return float
     */
    public function getFixedprice()
    {
        return $this->container['fixedprice'];
    }

    /**
     * Sets fixedprice
     *
     * @param float $fixedprice Fixed price amount, in the project's currency.
     *
     * @return $this
     */
    public function setFixedprice($fixedprice)
    {
        $this->container['fixedprice'] = $fixedprice;

        return $this;
    }

    /**
     * Gets is_price_ceiling
     *
     * @return bool
     */
    public function getIsPriceCeiling()
    {
        return $this->container['is_price_ceiling'];
    }

    /**
     * Sets is_price_ceiling
     *
     * @param bool $is_price_ceiling Set to true if an hourly rate project has a price ceiling.
     *
     * @return $this
     */
    public function setIsPriceCeiling($is_price_ceiling)
    {
        $this->container['is_price_ceiling'] = $is_price_ceiling;

        return $this;
    }

    /**
     * Gets price_ceiling_amount
     *
     * @return float
     */
    public function getPriceCeilingAmount()
    {
        return $this->container['price_ceiling_amount'];
    }

    /**
     * Sets price_ceiling_amount
     *
     * @param float $price_ceiling_amount Price ceiling amount, in the project's currency.
     *
     * @return $this
     */
    public function setPriceCeilingAmount($price_ceiling_amount)
    {
        $this->container['price_ceiling_amount'] = $price_ceiling_amount;

        return $this;
    }

    /**
     * Gets general_project_activities_per_project_only
     *
     * @return bool
     */
    public function getGeneralProjectActivitiesPerProjectOnly()
    {
        return $this->container['general_project_activities_per_project_only'];
    }

    /**
     * Sets general_project_activities_per_project_only
     *
     * @param bool $general_project_activities_per_project_only Set to true if a general project activity must be linked to project to allow time tracking.
     *
     * @return $this
     */
    public function setGeneralProjectActivitiesPerProjectOnly($general_project_activities_per_project_only)
    {
        $this->container['general_project_activities_per_project_only'] = $general_project_activities_per_project_only;

        return $this;
    }

    /**
     * Gets for_participants_only
     *
     * @return bool
     */
    public function getForParticipantsOnly()
    {
        return $this->container['for_participants_only'];
    }

    /**
     * Sets for_participants_only
     *
     * @param bool $for_participants_only Set to true if only project participants can register information on the project
     *
     * @return $this
     */
    public function setForParticipantsOnly($for_participants_only)
    {
        $this->container['for_participants_only'] = $for_participants_only;

        return $this;
    }

    /**
     * Gets project_hourly_rates
     *
     * @return \Learnist\Tripletex\Model\ProjectHourlyRateTemplate[]
     */
    public function getProjectHourlyRates()
    {
        return $this->container['project_hourly_rates'];
    }

    /**
     * Sets project_hourly_rates
     *
     * @param \Learnist\Tripletex\Model\ProjectHourlyRateTemplate[] $project_hourly_rates Project Rate Types tied to the project.
     *
     * @return $this
     */
    public function setProjectHourlyRates($project_hourly_rates)
    {
        $this->container['project_hourly_rates'] = $project_hourly_rates;

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
