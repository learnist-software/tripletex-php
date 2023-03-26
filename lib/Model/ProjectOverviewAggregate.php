<?php
/**
 * ProjectOverviewAggregate
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
 * ProjectOverviewAggregate Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProjectOverviewAggregate implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ProjectOverviewAggregate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'name' => 'string',
'display_name' => 'string',
'number' => 'string',
'start_date' => 'string',
'end_date' => 'string',
'is_ready_for_invoicing' => 'bool',
'is_closed' => 'bool',
'is_fixed_price' => 'bool',
'is_internal' => 'bool',
'is_auth_project_overview_contract_type' => 'bool',
'project_manager' => '\Learnist\Tripletex\Model\Employee',
'customer' => '\Learnist\Tripletex\Model\Company',
'main_project' => '\Learnist\Tripletex\Model\Project',
'department' => '\Learnist\Tripletex\Model\Department',
'project_category' => '\Learnist\Tripletex\Model\ProjectCategory',
'planned_budget' => 'float',
'completed_budget' => 'float',
'access_type' => 'string',
'invoice_reserve_total_amount_currency' => 'float',
'invoice_akonto_reserve_amount_currency' => 'float',
'invoice_extracosts_reserve_currency' => 'float',
'invoice_fee_reserve_currency' => 'float',
'hours_to_approve' => 'float',
'invoices_to_approve' => 'float',
'expenses_to_approve' => 'float',
'vouchers_to_approve' => 'float',
'is_project_attestor' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
'name' => null,
'display_name' => null,
'number' => null,
'start_date' => null,
'end_date' => null,
'is_ready_for_invoicing' => null,
'is_closed' => null,
'is_fixed_price' => null,
'is_internal' => null,
'is_auth_project_overview_contract_type' => null,
'project_manager' => null,
'customer' => null,
'main_project' => null,
'department' => null,
'project_category' => null,
'planned_budget' => null,
'completed_budget' => null,
'access_type' => null,
'invoice_reserve_total_amount_currency' => null,
'invoice_akonto_reserve_amount_currency' => null,
'invoice_extracosts_reserve_currency' => null,
'invoice_fee_reserve_currency' => null,
'hours_to_approve' => null,
'invoices_to_approve' => null,
'expenses_to_approve' => null,
'vouchers_to_approve' => null,
'is_project_attestor' => null    ];

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
'name' => 'name',
'display_name' => 'displayName',
'number' => 'number',
'start_date' => 'startDate',
'end_date' => 'endDate',
'is_ready_for_invoicing' => 'isReadyForInvoicing',
'is_closed' => 'isClosed',
'is_fixed_price' => 'isFixedPrice',
'is_internal' => 'isInternal',
'is_auth_project_overview_contract_type' => 'isAuthProjectOverviewContractType',
'project_manager' => 'projectManager',
'customer' => 'customer',
'main_project' => 'mainProject',
'department' => 'department',
'project_category' => 'projectCategory',
'planned_budget' => 'plannedBudget',
'completed_budget' => 'completedBudget',
'access_type' => 'accessType',
'invoice_reserve_total_amount_currency' => 'invoiceReserveTotalAmountCurrency',
'invoice_akonto_reserve_amount_currency' => 'invoiceAkontoReserveAmountCurrency',
'invoice_extracosts_reserve_currency' => 'invoiceExtracostsReserveCurrency',
'invoice_fee_reserve_currency' => 'invoiceFeeReserveCurrency',
'hours_to_approve' => 'hoursToApprove',
'invoices_to_approve' => 'invoicesToApprove',
'expenses_to_approve' => 'expensesToApprove',
'vouchers_to_approve' => 'vouchersToApprove',
'is_project_attestor' => 'isProjectAttestor'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'name' => 'setName',
'display_name' => 'setDisplayName',
'number' => 'setNumber',
'start_date' => 'setStartDate',
'end_date' => 'setEndDate',
'is_ready_for_invoicing' => 'setIsReadyForInvoicing',
'is_closed' => 'setIsClosed',
'is_fixed_price' => 'setIsFixedPrice',
'is_internal' => 'setIsInternal',
'is_auth_project_overview_contract_type' => 'setIsAuthProjectOverviewContractType',
'project_manager' => 'setProjectManager',
'customer' => 'setCustomer',
'main_project' => 'setMainProject',
'department' => 'setDepartment',
'project_category' => 'setProjectCategory',
'planned_budget' => 'setPlannedBudget',
'completed_budget' => 'setCompletedBudget',
'access_type' => 'setAccessType',
'invoice_reserve_total_amount_currency' => 'setInvoiceReserveTotalAmountCurrency',
'invoice_akonto_reserve_amount_currency' => 'setInvoiceAkontoReserveAmountCurrency',
'invoice_extracosts_reserve_currency' => 'setInvoiceExtracostsReserveCurrency',
'invoice_fee_reserve_currency' => 'setInvoiceFeeReserveCurrency',
'hours_to_approve' => 'setHoursToApprove',
'invoices_to_approve' => 'setInvoicesToApprove',
'expenses_to_approve' => 'setExpensesToApprove',
'vouchers_to_approve' => 'setVouchersToApprove',
'is_project_attestor' => 'setIsProjectAttestor'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'name' => 'getName',
'display_name' => 'getDisplayName',
'number' => 'getNumber',
'start_date' => 'getStartDate',
'end_date' => 'getEndDate',
'is_ready_for_invoicing' => 'getIsReadyForInvoicing',
'is_closed' => 'getIsClosed',
'is_fixed_price' => 'getIsFixedPrice',
'is_internal' => 'getIsInternal',
'is_auth_project_overview_contract_type' => 'getIsAuthProjectOverviewContractType',
'project_manager' => 'getProjectManager',
'customer' => 'getCustomer',
'main_project' => 'getMainProject',
'department' => 'getDepartment',
'project_category' => 'getProjectCategory',
'planned_budget' => 'getPlannedBudget',
'completed_budget' => 'getCompletedBudget',
'access_type' => 'getAccessType',
'invoice_reserve_total_amount_currency' => 'getInvoiceReserveTotalAmountCurrency',
'invoice_akonto_reserve_amount_currency' => 'getInvoiceAkontoReserveAmountCurrency',
'invoice_extracosts_reserve_currency' => 'getInvoiceExtracostsReserveCurrency',
'invoice_fee_reserve_currency' => 'getInvoiceFeeReserveCurrency',
'hours_to_approve' => 'getHoursToApprove',
'invoices_to_approve' => 'getInvoicesToApprove',
'expenses_to_approve' => 'getExpensesToApprove',
'vouchers_to_approve' => 'getVouchersToApprove',
'is_project_attestor' => 'getIsProjectAttestor'    ];

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

    const ACCESS_TYPE_NONE = 'NONE';
const ACCESS_TYPE_READ = 'READ';
const ACCESS_TYPE_WRITE = 'WRITE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccessTypeAllowableValues()
    {
        return [
            self::ACCESS_TYPE_NONE,
self::ACCESS_TYPE_READ,
self::ACCESS_TYPE_WRITE,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['is_ready_for_invoicing'] = isset($data['is_ready_for_invoicing']) ? $data['is_ready_for_invoicing'] : null;
        $this->container['is_closed'] = isset($data['is_closed']) ? $data['is_closed'] : null;
        $this->container['is_fixed_price'] = isset($data['is_fixed_price']) ? $data['is_fixed_price'] : null;
        $this->container['is_internal'] = isset($data['is_internal']) ? $data['is_internal'] : null;
        $this->container['is_auth_project_overview_contract_type'] = isset($data['is_auth_project_overview_contract_type']) ? $data['is_auth_project_overview_contract_type'] : null;
        $this->container['project_manager'] = isset($data['project_manager']) ? $data['project_manager'] : null;
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['main_project'] = isset($data['main_project']) ? $data['main_project'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['project_category'] = isset($data['project_category']) ? $data['project_category'] : null;
        $this->container['planned_budget'] = isset($data['planned_budget']) ? $data['planned_budget'] : null;
        $this->container['completed_budget'] = isset($data['completed_budget']) ? $data['completed_budget'] : null;
        $this->container['access_type'] = isset($data['access_type']) ? $data['access_type'] : null;
        $this->container['invoice_reserve_total_amount_currency'] = isset($data['invoice_reserve_total_amount_currency']) ? $data['invoice_reserve_total_amount_currency'] : null;
        $this->container['invoice_akonto_reserve_amount_currency'] = isset($data['invoice_akonto_reserve_amount_currency']) ? $data['invoice_akonto_reserve_amount_currency'] : null;
        $this->container['invoice_extracosts_reserve_currency'] = isset($data['invoice_extracosts_reserve_currency']) ? $data['invoice_extracosts_reserve_currency'] : null;
        $this->container['invoice_fee_reserve_currency'] = isset($data['invoice_fee_reserve_currency']) ? $data['invoice_fee_reserve_currency'] : null;
        $this->container['hours_to_approve'] = isset($data['hours_to_approve']) ? $data['hours_to_approve'] : null;
        $this->container['invoices_to_approve'] = isset($data['invoices_to_approve']) ? $data['invoices_to_approve'] : null;
        $this->container['expenses_to_approve'] = isset($data['expenses_to_approve']) ? $data['expenses_to_approve'] : null;
        $this->container['vouchers_to_approve'] = isset($data['vouchers_to_approve']) ? $data['vouchers_to_approve'] : null;
        $this->container['is_project_attestor'] = isset($data['is_project_attestor']) ? $data['is_project_attestor'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($this->container['access_type']) && !in_array($this->container['access_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'access_type', must be one of '%s'",
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
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name display_name
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

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
     * Gets is_ready_for_invoicing
     *
     * @return bool
     */
    public function getIsReadyForInvoicing()
    {
        return $this->container['is_ready_for_invoicing'];
    }

    /**
     * Sets is_ready_for_invoicing
     *
     * @param bool $is_ready_for_invoicing is_ready_for_invoicing
     *
     * @return $this
     */
    public function setIsReadyForInvoicing($is_ready_for_invoicing)
    {
        $this->container['is_ready_for_invoicing'] = $is_ready_for_invoicing;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool $is_closed is_closed
     *
     * @return $this
     */
    public function setIsClosed($is_closed)
    {
        $this->container['is_closed'] = $is_closed;

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
     * @param bool $is_fixed_price is_fixed_price
     *
     * @return $this
     */
    public function setIsFixedPrice($is_fixed_price)
    {
        $this->container['is_fixed_price'] = $is_fixed_price;

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
     * Gets is_auth_project_overview_contract_type
     *
     * @return bool
     */
    public function getIsAuthProjectOverviewContractType()
    {
        return $this->container['is_auth_project_overview_contract_type'];
    }

    /**
     * Sets is_auth_project_overview_contract_type
     *
     * @param bool $is_auth_project_overview_contract_type is_auth_project_overview_contract_type
     *
     * @return $this
     */
    public function setIsAuthProjectOverviewContractType($is_auth_project_overview_contract_type)
    {
        $this->container['is_auth_project_overview_contract_type'] = $is_auth_project_overview_contract_type;

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
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Company
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Company $customer customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->container['customer'] = $customer;

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
     * Gets planned_budget
     *
     * @return float
     */
    public function getPlannedBudget()
    {
        return $this->container['planned_budget'];
    }

    /**
     * Sets planned_budget
     *
     * @param float $planned_budget planned_budget
     *
     * @return $this
     */
    public function setPlannedBudget($planned_budget)
    {
        $this->container['planned_budget'] = $planned_budget;

        return $this;
    }

    /**
     * Gets completed_budget
     *
     * @return float
     */
    public function getCompletedBudget()
    {
        return $this->container['completed_budget'];
    }

    /**
     * Sets completed_budget
     *
     * @param float $completed_budget completed_budget
     *
     * @return $this
     */
    public function setCompletedBudget($completed_budget)
    {
        $this->container['completed_budget'] = $completed_budget;

        return $this;
    }

    /**
     * Gets access_type
     *
     * @return string
     */
    public function getAccessType()
    {
        return $this->container['access_type'];
    }

    /**
     * Sets access_type
     *
     * @param string $access_type READ/WRITE access on project
     *
     * @return $this
     */
    public function setAccessType($access_type)
    {
        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($access_type) && !in_array($access_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'access_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['access_type'] = $access_type;

        return $this;
    }

    /**
     * Gets invoice_reserve_total_amount_currency
     *
     * @return float
     */
    public function getInvoiceReserveTotalAmountCurrency()
    {
        return $this->container['invoice_reserve_total_amount_currency'];
    }

    /**
     * Sets invoice_reserve_total_amount_currency
     *
     * @param float $invoice_reserve_total_amount_currency invoice_reserve_total_amount_currency
     *
     * @return $this
     */
    public function setInvoiceReserveTotalAmountCurrency($invoice_reserve_total_amount_currency)
    {
        $this->container['invoice_reserve_total_amount_currency'] = $invoice_reserve_total_amount_currency;

        return $this;
    }

    /**
     * Gets invoice_akonto_reserve_amount_currency
     *
     * @return float
     */
    public function getInvoiceAkontoReserveAmountCurrency()
    {
        return $this->container['invoice_akonto_reserve_amount_currency'];
    }

    /**
     * Sets invoice_akonto_reserve_amount_currency
     *
     * @param float $invoice_akonto_reserve_amount_currency invoice_akonto_reserve_amount_currency
     *
     * @return $this
     */
    public function setInvoiceAkontoReserveAmountCurrency($invoice_akonto_reserve_amount_currency)
    {
        $this->container['invoice_akonto_reserve_amount_currency'] = $invoice_akonto_reserve_amount_currency;

        return $this;
    }

    /**
     * Gets invoice_extracosts_reserve_currency
     *
     * @return float
     */
    public function getInvoiceExtracostsReserveCurrency()
    {
        return $this->container['invoice_extracosts_reserve_currency'];
    }

    /**
     * Sets invoice_extracosts_reserve_currency
     *
     * @param float $invoice_extracosts_reserve_currency invoice_extracosts_reserve_currency
     *
     * @return $this
     */
    public function setInvoiceExtracostsReserveCurrency($invoice_extracosts_reserve_currency)
    {
        $this->container['invoice_extracosts_reserve_currency'] = $invoice_extracosts_reserve_currency;

        return $this;
    }

    /**
     * Gets invoice_fee_reserve_currency
     *
     * @return float
     */
    public function getInvoiceFeeReserveCurrency()
    {
        return $this->container['invoice_fee_reserve_currency'];
    }

    /**
     * Sets invoice_fee_reserve_currency
     *
     * @param float $invoice_fee_reserve_currency invoice_fee_reserve_currency
     *
     * @return $this
     */
    public function setInvoiceFeeReserveCurrency($invoice_fee_reserve_currency)
    {
        $this->container['invoice_fee_reserve_currency'] = $invoice_fee_reserve_currency;

        return $this;
    }

    /**
     * Gets hours_to_approve
     *
     * @return float
     */
    public function getHoursToApprove()
    {
        return $this->container['hours_to_approve'];
    }

    /**
     * Sets hours_to_approve
     *
     * @param float $hours_to_approve hours_to_approve
     *
     * @return $this
     */
    public function setHoursToApprove($hours_to_approve)
    {
        $this->container['hours_to_approve'] = $hours_to_approve;

        return $this;
    }

    /**
     * Gets invoices_to_approve
     *
     * @return float
     */
    public function getInvoicesToApprove()
    {
        return $this->container['invoices_to_approve'];
    }

    /**
     * Sets invoices_to_approve
     *
     * @param float $invoices_to_approve invoices_to_approve
     *
     * @return $this
     */
    public function setInvoicesToApprove($invoices_to_approve)
    {
        $this->container['invoices_to_approve'] = $invoices_to_approve;

        return $this;
    }

    /**
     * Gets expenses_to_approve
     *
     * @return float
     */
    public function getExpensesToApprove()
    {
        return $this->container['expenses_to_approve'];
    }

    /**
     * Sets expenses_to_approve
     *
     * @param float $expenses_to_approve expenses_to_approve
     *
     * @return $this
     */
    public function setExpensesToApprove($expenses_to_approve)
    {
        $this->container['expenses_to_approve'] = $expenses_to_approve;

        return $this;
    }

    /**
     * Gets vouchers_to_approve
     *
     * @return float
     */
    public function getVouchersToApprove()
    {
        return $this->container['vouchers_to_approve'];
    }

    /**
     * Sets vouchers_to_approve
     *
     * @param float $vouchers_to_approve vouchers_to_approve
     *
     * @return $this
     */
    public function setVouchersToApprove($vouchers_to_approve)
    {
        $this->container['vouchers_to_approve'] = $vouchers_to_approve;

        return $this;
    }

    /**
     * Gets is_project_attestor
     *
     * @return bool
     */
    public function getIsProjectAttestor()
    {
        return $this->container['is_project_attestor'];
    }

    /**
     * Sets is_project_attestor
     *
     * @param bool $is_project_attestor is_project_attestor
     *
     * @return $this
     */
    public function setIsProjectAttestor($is_project_attestor)
    {
        $this->container['is_project_attestor'] = $is_project_attestor;

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
