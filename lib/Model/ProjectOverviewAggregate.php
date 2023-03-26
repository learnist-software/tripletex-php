<?php
/**
 * ProjectOverviewAggregate
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
 * ProjectOverviewAggregate Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectOverviewAggregate implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProjectOverviewAggregate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'is_project_attestor' => 'bool'
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
        'is_project_attestor' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'name' => false,
		'display_name' => false,
		'number' => false,
		'start_date' => false,
		'end_date' => false,
		'is_ready_for_invoicing' => false,
		'is_closed' => false,
		'is_fixed_price' => false,
		'is_internal' => false,
		'is_auth_project_overview_contract_type' => false,
		'project_manager' => false,
		'customer' => false,
		'main_project' => false,
		'department' => false,
		'project_category' => false,
		'planned_budget' => false,
		'completed_budget' => false,
		'access_type' => false,
		'invoice_reserve_total_amount_currency' => false,
		'invoice_akonto_reserve_amount_currency' => false,
		'invoice_extracosts_reserve_currency' => false,
		'invoice_fee_reserve_currency' => false,
		'hours_to_approve' => false,
		'invoices_to_approve' => false,
		'expenses_to_approve' => false,
		'vouchers_to_approve' => false,
		'is_project_attestor' => false
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
        'is_project_attestor' => 'isProjectAttestor'
    ];

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
        'is_project_attestor' => 'setIsProjectAttestor'
    ];

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
        'is_project_attestor' => 'getIsProjectAttestor'
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

    public const ACCESS_TYPE_NONE = 'NONE';
    public const ACCESS_TYPE_READ = 'READ';
    public const ACCESS_TYPE_WRITE = 'WRITE';

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
            self::ACCESS_TYPE_WRITE,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('start_date', $data ?? [], null);
        $this->setIfExists('end_date', $data ?? [], null);
        $this->setIfExists('is_ready_for_invoicing', $data ?? [], null);
        $this->setIfExists('is_closed', $data ?? [], null);
        $this->setIfExists('is_fixed_price', $data ?? [], null);
        $this->setIfExists('is_internal', $data ?? [], null);
        $this->setIfExists('is_auth_project_overview_contract_type', $data ?? [], null);
        $this->setIfExists('project_manager', $data ?? [], null);
        $this->setIfExists('customer', $data ?? [], null);
        $this->setIfExists('main_project', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('project_category', $data ?? [], null);
        $this->setIfExists('planned_budget', $data ?? [], null);
        $this->setIfExists('completed_budget', $data ?? [], null);
        $this->setIfExists('access_type', $data ?? [], null);
        $this->setIfExists('invoice_reserve_total_amount_currency', $data ?? [], null);
        $this->setIfExists('invoice_akonto_reserve_amount_currency', $data ?? [], null);
        $this->setIfExists('invoice_extracosts_reserve_currency', $data ?? [], null);
        $this->setIfExists('invoice_fee_reserve_currency', $data ?? [], null);
        $this->setIfExists('hours_to_approve', $data ?? [], null);
        $this->setIfExists('invoices_to_approve', $data ?? [], null);
        $this->setIfExists('expenses_to_approve', $data ?? [], null);
        $this->setIfExists('vouchers_to_approve', $data ?? [], null);
        $this->setIfExists('is_project_attestor', $data ?? [], null);
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

        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($this->container['access_type']) && !in_array($this->container['access_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'access_type', must be one of '%s'",
                $this->container['access_type'],
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

        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {

        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }

        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string|null $number number
     *
     * @return self
     */
    public function setNumber($number)
    {

        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }

        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string|null
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string|null $start_date start_date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {

        if (is_null($start_date)) {
            throw new \InvalidArgumentException('non-nullable start_date cannot be null');
        }

        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string|null $end_date end_date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {

        if (is_null($end_date)) {
            throw new \InvalidArgumentException('non-nullable end_date cannot be null');
        }

        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets is_ready_for_invoicing
     *
     * @return bool|null
     */
    public function getIsReadyForInvoicing()
    {
        return $this->container['is_ready_for_invoicing'];
    }

    /**
     * Sets is_ready_for_invoicing
     *
     * @param bool|null $is_ready_for_invoicing is_ready_for_invoicing
     *
     * @return self
     */
    public function setIsReadyForInvoicing($is_ready_for_invoicing)
    {

        if (is_null($is_ready_for_invoicing)) {
            throw new \InvalidArgumentException('non-nullable is_ready_for_invoicing cannot be null');
        }

        $this->container['is_ready_for_invoicing'] = $is_ready_for_invoicing;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool|null
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool|null $is_closed is_closed
     *
     * @return self
     */
    public function setIsClosed($is_closed)
    {

        if (is_null($is_closed)) {
            throw new \InvalidArgumentException('non-nullable is_closed cannot be null');
        }

        $this->container['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Gets is_fixed_price
     *
     * @return bool|null
     */
    public function getIsFixedPrice()
    {
        return $this->container['is_fixed_price'];
    }

    /**
     * Sets is_fixed_price
     *
     * @param bool|null $is_fixed_price is_fixed_price
     *
     * @return self
     */
    public function setIsFixedPrice($is_fixed_price)
    {

        if (is_null($is_fixed_price)) {
            throw new \InvalidArgumentException('non-nullable is_fixed_price cannot be null');
        }

        $this->container['is_fixed_price'] = $is_fixed_price;

        return $this;
    }

    /**
     * Gets is_internal
     *
     * @return bool|null
     */
    public function getIsInternal()
    {
        return $this->container['is_internal'];
    }

    /**
     * Sets is_internal
     *
     * @param bool|null $is_internal is_internal
     *
     * @return self
     */
    public function setIsInternal($is_internal)
    {

        if (is_null($is_internal)) {
            throw new \InvalidArgumentException('non-nullable is_internal cannot be null');
        }

        $this->container['is_internal'] = $is_internal;

        return $this;
    }

    /**
     * Gets is_auth_project_overview_contract_type
     *
     * @return bool|null
     */
    public function getIsAuthProjectOverviewContractType()
    {
        return $this->container['is_auth_project_overview_contract_type'];
    }

    /**
     * Sets is_auth_project_overview_contract_type
     *
     * @param bool|null $is_auth_project_overview_contract_type is_auth_project_overview_contract_type
     *
     * @return self
     */
    public function setIsAuthProjectOverviewContractType($is_auth_project_overview_contract_type)
    {

        if (is_null($is_auth_project_overview_contract_type)) {
            throw new \InvalidArgumentException('non-nullable is_auth_project_overview_contract_type cannot be null');
        }

        $this->container['is_auth_project_overview_contract_type'] = $is_auth_project_overview_contract_type;

        return $this;
    }

    /**
     * Gets project_manager
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getProjectManager()
    {
        return $this->container['project_manager'];
    }

    /**
     * Sets project_manager
     *
     * @param \Learnist\Tripletex\Model\Employee|null $project_manager project_manager
     *
     * @return self
     */
    public function setProjectManager($project_manager)
    {

        if (is_null($project_manager)) {
            throw new \InvalidArgumentException('non-nullable project_manager cannot be null');
        }

        $this->container['project_manager'] = $project_manager;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Company|null
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Company|null $customer customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {

        if (is_null($customer)) {
            throw new \InvalidArgumentException('non-nullable customer cannot be null');
        }

        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets main_project
     *
     * @return \Learnist\Tripletex\Model\Project|null
     */
    public function getMainProject()
    {
        return $this->container['main_project'];
    }

    /**
     * Sets main_project
     *
     * @param \Learnist\Tripletex\Model\Project|null $main_project main_project
     *
     * @return self
     */
    public function setMainProject($main_project)
    {

        if (is_null($main_project)) {
            throw new \InvalidArgumentException('non-nullable main_project cannot be null');
        }

        $this->container['main_project'] = $main_project;

        return $this;
    }

    /**
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department|null
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department|null $department department
     *
     * @return self
     */
    public function setDepartment($department)
    {

        if (is_null($department)) {
            throw new \InvalidArgumentException('non-nullable department cannot be null');
        }

        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets project_category
     *
     * @return \Learnist\Tripletex\Model\ProjectCategory|null
     */
    public function getProjectCategory()
    {
        return $this->container['project_category'];
    }

    /**
     * Sets project_category
     *
     * @param \Learnist\Tripletex\Model\ProjectCategory|null $project_category project_category
     *
     * @return self
     */
    public function setProjectCategory($project_category)
    {

        if (is_null($project_category)) {
            throw new \InvalidArgumentException('non-nullable project_category cannot be null');
        }

        $this->container['project_category'] = $project_category;

        return $this;
    }

    /**
     * Gets planned_budget
     *
     * @return float|null
     */
    public function getPlannedBudget()
    {
        return $this->container['planned_budget'];
    }

    /**
     * Sets planned_budget
     *
     * @param float|null $planned_budget planned_budget
     *
     * @return self
     */
    public function setPlannedBudget($planned_budget)
    {

        if (is_null($planned_budget)) {
            throw new \InvalidArgumentException('non-nullable planned_budget cannot be null');
        }

        $this->container['planned_budget'] = $planned_budget;

        return $this;
    }

    /**
     * Gets completed_budget
     *
     * @return float|null
     */
    public function getCompletedBudget()
    {
        return $this->container['completed_budget'];
    }

    /**
     * Sets completed_budget
     *
     * @param float|null $completed_budget completed_budget
     *
     * @return self
     */
    public function setCompletedBudget($completed_budget)
    {

        if (is_null($completed_budget)) {
            throw new \InvalidArgumentException('non-nullable completed_budget cannot be null');
        }

        $this->container['completed_budget'] = $completed_budget;

        return $this;
    }

    /**
     * Gets access_type
     *
     * @return string|null
     */
    public function getAccessType()
    {
        return $this->container['access_type'];
    }

    /**
     * Sets access_type
     *
     * @param string|null $access_type READ/WRITE access on project
     *
     * @return self
     */
    public function setAccessType($access_type)
    {
        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($access_type) && !in_array($access_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'access_type', must be one of '%s'",
                    $access_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($access_type)) {
            throw new \InvalidArgumentException('non-nullable access_type cannot be null');
        }

        $this->container['access_type'] = $access_type;

        return $this;
    }

    /**
     * Gets invoice_reserve_total_amount_currency
     *
     * @return float|null
     */
    public function getInvoiceReserveTotalAmountCurrency()
    {
        return $this->container['invoice_reserve_total_amount_currency'];
    }

    /**
     * Sets invoice_reserve_total_amount_currency
     *
     * @param float|null $invoice_reserve_total_amount_currency invoice_reserve_total_amount_currency
     *
     * @return self
     */
    public function setInvoiceReserveTotalAmountCurrency($invoice_reserve_total_amount_currency)
    {

        if (is_null($invoice_reserve_total_amount_currency)) {
            throw new \InvalidArgumentException('non-nullable invoice_reserve_total_amount_currency cannot be null');
        }

        $this->container['invoice_reserve_total_amount_currency'] = $invoice_reserve_total_amount_currency;

        return $this;
    }

    /**
     * Gets invoice_akonto_reserve_amount_currency
     *
     * @return float|null
     */
    public function getInvoiceAkontoReserveAmountCurrency()
    {
        return $this->container['invoice_akonto_reserve_amount_currency'];
    }

    /**
     * Sets invoice_akonto_reserve_amount_currency
     *
     * @param float|null $invoice_akonto_reserve_amount_currency invoice_akonto_reserve_amount_currency
     *
     * @return self
     */
    public function setInvoiceAkontoReserveAmountCurrency($invoice_akonto_reserve_amount_currency)
    {

        if (is_null($invoice_akonto_reserve_amount_currency)) {
            throw new \InvalidArgumentException('non-nullable invoice_akonto_reserve_amount_currency cannot be null');
        }

        $this->container['invoice_akonto_reserve_amount_currency'] = $invoice_akonto_reserve_amount_currency;

        return $this;
    }

    /**
     * Gets invoice_extracosts_reserve_currency
     *
     * @return float|null
     */
    public function getInvoiceExtracostsReserveCurrency()
    {
        return $this->container['invoice_extracosts_reserve_currency'];
    }

    /**
     * Sets invoice_extracosts_reserve_currency
     *
     * @param float|null $invoice_extracosts_reserve_currency invoice_extracosts_reserve_currency
     *
     * @return self
     */
    public function setInvoiceExtracostsReserveCurrency($invoice_extracosts_reserve_currency)
    {

        if (is_null($invoice_extracosts_reserve_currency)) {
            throw new \InvalidArgumentException('non-nullable invoice_extracosts_reserve_currency cannot be null');
        }

        $this->container['invoice_extracosts_reserve_currency'] = $invoice_extracosts_reserve_currency;

        return $this;
    }

    /**
     * Gets invoice_fee_reserve_currency
     *
     * @return float|null
     */
    public function getInvoiceFeeReserveCurrency()
    {
        return $this->container['invoice_fee_reserve_currency'];
    }

    /**
     * Sets invoice_fee_reserve_currency
     *
     * @param float|null $invoice_fee_reserve_currency invoice_fee_reserve_currency
     *
     * @return self
     */
    public function setInvoiceFeeReserveCurrency($invoice_fee_reserve_currency)
    {

        if (is_null($invoice_fee_reserve_currency)) {
            throw new \InvalidArgumentException('non-nullable invoice_fee_reserve_currency cannot be null');
        }

        $this->container['invoice_fee_reserve_currency'] = $invoice_fee_reserve_currency;

        return $this;
    }

    /**
     * Gets hours_to_approve
     *
     * @return float|null
     */
    public function getHoursToApprove()
    {
        return $this->container['hours_to_approve'];
    }

    /**
     * Sets hours_to_approve
     *
     * @param float|null $hours_to_approve hours_to_approve
     *
     * @return self
     */
    public function setHoursToApprove($hours_to_approve)
    {

        if (is_null($hours_to_approve)) {
            throw new \InvalidArgumentException('non-nullable hours_to_approve cannot be null');
        }

        $this->container['hours_to_approve'] = $hours_to_approve;

        return $this;
    }

    /**
     * Gets invoices_to_approve
     *
     * @return float|null
     */
    public function getInvoicesToApprove()
    {
        return $this->container['invoices_to_approve'];
    }

    /**
     * Sets invoices_to_approve
     *
     * @param float|null $invoices_to_approve invoices_to_approve
     *
     * @return self
     */
    public function setInvoicesToApprove($invoices_to_approve)
    {

        if (is_null($invoices_to_approve)) {
            throw new \InvalidArgumentException('non-nullable invoices_to_approve cannot be null');
        }

        $this->container['invoices_to_approve'] = $invoices_to_approve;

        return $this;
    }

    /**
     * Gets expenses_to_approve
     *
     * @return float|null
     */
    public function getExpensesToApprove()
    {
        return $this->container['expenses_to_approve'];
    }

    /**
     * Sets expenses_to_approve
     *
     * @param float|null $expenses_to_approve expenses_to_approve
     *
     * @return self
     */
    public function setExpensesToApprove($expenses_to_approve)
    {

        if (is_null($expenses_to_approve)) {
            throw new \InvalidArgumentException('non-nullable expenses_to_approve cannot be null');
        }

        $this->container['expenses_to_approve'] = $expenses_to_approve;

        return $this;
    }

    /**
     * Gets vouchers_to_approve
     *
     * @return float|null
     */
    public function getVouchersToApprove()
    {
        return $this->container['vouchers_to_approve'];
    }

    /**
     * Sets vouchers_to_approve
     *
     * @param float|null $vouchers_to_approve vouchers_to_approve
     *
     * @return self
     */
    public function setVouchersToApprove($vouchers_to_approve)
    {

        if (is_null($vouchers_to_approve)) {
            throw new \InvalidArgumentException('non-nullable vouchers_to_approve cannot be null');
        }

        $this->container['vouchers_to_approve'] = $vouchers_to_approve;

        return $this;
    }

    /**
     * Gets is_project_attestor
     *
     * @return bool|null
     */
    public function getIsProjectAttestor()
    {
        return $this->container['is_project_attestor'];
    }

    /**
     * Sets is_project_attestor
     *
     * @param bool|null $is_project_attestor is_project_attestor
     *
     * @return self
     */
    public function setIsProjectAttestor($is_project_attestor)
    {

        if (is_null($is_project_attestor)) {
            throw new \InvalidArgumentException('non-nullable is_project_attestor cannot be null');
        }

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


