<?php
/**
 * Modules
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
 * OpenAPI Generator version: 6.5.0-SNAPSHOT
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
 * Modules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Modules implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Modules';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'accounting' => 'bool',
        'invoice' => 'bool',
        'salary' => 'bool',
        'salary_start_date' => 'string',
        'project' => 'bool',
        'ocr' => 'bool',
        'auto_pay_ocr' => 'bool',
        'remit' => 'bool',
        'electronic_vouchers' => 'bool',
        'electro' => 'bool',
        'vvs' => 'bool',
        'agro' => 'bool',
        'mamut' => 'bool',
        'approve_voucher' => 'bool',
        'moduleprojecteconomy' => 'bool',
        'moduleemployee' => 'bool',
        'module_contact' => 'bool',
        'modulecustomer' => 'bool',
        'moduledepartment' => 'bool',
        'moduleprojectcategory' => 'bool',
        'moduleinvoice' => 'bool',
        'module_currency' => 'bool',
        'module_project_budget' => 'bool',
        'module_factoring_visma_finance' => 'string',
        'complete_monthly_hour_lists' => 'bool',
        'module_department_accounting' => 'bool',
        'module_wage_project_accounting' => 'bool',
        'module_project_accounting' => 'bool',
        'module_product_accounting' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'accounting' => null,
        'invoice' => null,
        'salary' => null,
        'salary_start_date' => null,
        'project' => null,
        'ocr' => null,
        'auto_pay_ocr' => null,
        'remit' => null,
        'electronic_vouchers' => null,
        'electro' => null,
        'vvs' => null,
        'agro' => null,
        'mamut' => null,
        'approve_voucher' => null,
        'moduleprojecteconomy' => null,
        'moduleemployee' => null,
        'module_contact' => null,
        'modulecustomer' => null,
        'moduledepartment' => null,
        'moduleprojectcategory' => null,
        'moduleinvoice' => null,
        'module_currency' => null,
        'module_project_budget' => null,
        'module_factoring_visma_finance' => null,
        'complete_monthly_hour_lists' => null,
        'module_department_accounting' => null,
        'module_wage_project_accounting' => null,
        'module_project_accounting' => null,
        'module_product_accounting' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'accounting' => false,
		'invoice' => false,
		'salary' => false,
		'salary_start_date' => false,
		'project' => false,
		'ocr' => false,
		'auto_pay_ocr' => false,
		'remit' => false,
		'electronic_vouchers' => false,
		'electro' => false,
		'vvs' => false,
		'agro' => false,
		'mamut' => false,
		'approve_voucher' => false,
		'moduleprojecteconomy' => false,
		'moduleemployee' => false,
		'module_contact' => false,
		'modulecustomer' => false,
		'moduledepartment' => false,
		'moduleprojectcategory' => false,
		'moduleinvoice' => false,
		'module_currency' => false,
		'module_project_budget' => false,
		'module_factoring_visma_finance' => false,
		'complete_monthly_hour_lists' => false,
		'module_department_accounting' => false,
		'module_wage_project_accounting' => false,
		'module_project_accounting' => false,
		'module_product_accounting' => false
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
        'accounting' => 'accounting',
        'invoice' => 'invoice',
        'salary' => 'salary',
        'salary_start_date' => 'salaryStartDate',
        'project' => 'project',
        'ocr' => 'ocr',
        'auto_pay_ocr' => 'autoPayOcr',
        'remit' => 'remit',
        'electronic_vouchers' => 'electronicVouchers',
        'electro' => 'electro',
        'vvs' => 'vvs',
        'agro' => 'agro',
        'mamut' => 'mamut',
        'approve_voucher' => 'approveVoucher',
        'moduleprojecteconomy' => 'moduleprojecteconomy',
        'moduleemployee' => 'moduleemployee',
        'module_contact' => 'moduleContact',
        'modulecustomer' => 'modulecustomer',
        'moduledepartment' => 'moduledepartment',
        'moduleprojectcategory' => 'moduleprojectcategory',
        'moduleinvoice' => 'moduleinvoice',
        'module_currency' => 'moduleCurrency',
        'module_project_budget' => 'moduleProjectBudget',
        'module_factoring_visma_finance' => 'moduleFactoringVismaFinance',
        'complete_monthly_hour_lists' => 'completeMonthlyHourLists',
        'module_department_accounting' => 'moduleDepartmentAccounting',
        'module_wage_project_accounting' => 'moduleWageProjectAccounting',
        'module_project_accounting' => 'moduleProjectAccounting',
        'module_product_accounting' => 'moduleProductAccounting'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'accounting' => 'setAccounting',
        'invoice' => 'setInvoice',
        'salary' => 'setSalary',
        'salary_start_date' => 'setSalaryStartDate',
        'project' => 'setProject',
        'ocr' => 'setOcr',
        'auto_pay_ocr' => 'setAutoPayOcr',
        'remit' => 'setRemit',
        'electronic_vouchers' => 'setElectronicVouchers',
        'electro' => 'setElectro',
        'vvs' => 'setVvs',
        'agro' => 'setAgro',
        'mamut' => 'setMamut',
        'approve_voucher' => 'setApproveVoucher',
        'moduleprojecteconomy' => 'setModuleprojecteconomy',
        'moduleemployee' => 'setModuleemployee',
        'module_contact' => 'setModuleContact',
        'modulecustomer' => 'setModulecustomer',
        'moduledepartment' => 'setModuledepartment',
        'moduleprojectcategory' => 'setModuleprojectcategory',
        'moduleinvoice' => 'setModuleinvoice',
        'module_currency' => 'setModuleCurrency',
        'module_project_budget' => 'setModuleProjectBudget',
        'module_factoring_visma_finance' => 'setModuleFactoringVismaFinance',
        'complete_monthly_hour_lists' => 'setCompleteMonthlyHourLists',
        'module_department_accounting' => 'setModuleDepartmentAccounting',
        'module_wage_project_accounting' => 'setModuleWageProjectAccounting',
        'module_project_accounting' => 'setModuleProjectAccounting',
        'module_product_accounting' => 'setModuleProductAccounting'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'accounting' => 'getAccounting',
        'invoice' => 'getInvoice',
        'salary' => 'getSalary',
        'salary_start_date' => 'getSalaryStartDate',
        'project' => 'getProject',
        'ocr' => 'getOcr',
        'auto_pay_ocr' => 'getAutoPayOcr',
        'remit' => 'getRemit',
        'electronic_vouchers' => 'getElectronicVouchers',
        'electro' => 'getElectro',
        'vvs' => 'getVvs',
        'agro' => 'getAgro',
        'mamut' => 'getMamut',
        'approve_voucher' => 'getApproveVoucher',
        'moduleprojecteconomy' => 'getModuleprojecteconomy',
        'moduleemployee' => 'getModuleemployee',
        'module_contact' => 'getModuleContact',
        'modulecustomer' => 'getModulecustomer',
        'moduledepartment' => 'getModuledepartment',
        'moduleprojectcategory' => 'getModuleprojectcategory',
        'moduleinvoice' => 'getModuleinvoice',
        'module_currency' => 'getModuleCurrency',
        'module_project_budget' => 'getModuleProjectBudget',
        'module_factoring_visma_finance' => 'getModuleFactoringVismaFinance',
        'complete_monthly_hour_lists' => 'getCompleteMonthlyHourLists',
        'module_department_accounting' => 'getModuleDepartmentAccounting',
        'module_wage_project_accounting' => 'getModuleWageProjectAccounting',
        'module_project_accounting' => 'getModuleProjectAccounting',
        'module_product_accounting' => 'getModuleProductAccounting'
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

    public const MODULE_FACTORING_VISMA_FINANCE_OFF = 'OFF';
    public const MODULE_FACTORING_VISMA_FINANCE_STARTED = 'STARTED';
    public const MODULE_FACTORING_VISMA_FINANCE_SIGNING_STARTED = 'SIGNING_STARTED';
    public const MODULE_FACTORING_VISMA_FINANCE_ON = 'ON';
    public const MODULE_FACTORING_VISMA_FINANCE_IN_REVIEW = 'IN_REVIEW';
    public const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_ON = 'DEACTIVATED_FROM_ON';
    public const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_OFF = 'DEACTIVATED_FROM_OFF';
    public const MODULE_FACTORING_VISMA_FINANCE_FAILED = 'FAILED';
    public const MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT = 'OPTED_OUT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModuleFactoringVismaFinanceAllowableValues()
    {
        return [
            self::MODULE_FACTORING_VISMA_FINANCE_OFF,
            self::MODULE_FACTORING_VISMA_FINANCE_STARTED,
            self::MODULE_FACTORING_VISMA_FINANCE_SIGNING_STARTED,
            self::MODULE_FACTORING_VISMA_FINANCE_ON,
            self::MODULE_FACTORING_VISMA_FINANCE_IN_REVIEW,
            self::MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_ON,
            self::MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_OFF,
            self::MODULE_FACTORING_VISMA_FINANCE_FAILED,
            self::MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT,
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
        $this->setIfExists('accounting', $data ?? [], null);
        $this->setIfExists('invoice', $data ?? [], null);
        $this->setIfExists('salary', $data ?? [], null);
        $this->setIfExists('salary_start_date', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('ocr', $data ?? [], null);
        $this->setIfExists('auto_pay_ocr', $data ?? [], null);
        $this->setIfExists('remit', $data ?? [], null);
        $this->setIfExists('electronic_vouchers', $data ?? [], null);
        $this->setIfExists('electro', $data ?? [], null);
        $this->setIfExists('vvs', $data ?? [], null);
        $this->setIfExists('agro', $data ?? [], null);
        $this->setIfExists('mamut', $data ?? [], null);
        $this->setIfExists('approve_voucher', $data ?? [], null);
        $this->setIfExists('moduleprojecteconomy', $data ?? [], null);
        $this->setIfExists('moduleemployee', $data ?? [], null);
        $this->setIfExists('module_contact', $data ?? [], null);
        $this->setIfExists('modulecustomer', $data ?? [], null);
        $this->setIfExists('moduledepartment', $data ?? [], null);
        $this->setIfExists('moduleprojectcategory', $data ?? [], null);
        $this->setIfExists('moduleinvoice', $data ?? [], null);
        $this->setIfExists('module_currency', $data ?? [], null);
        $this->setIfExists('module_project_budget', $data ?? [], null);
        $this->setIfExists('module_factoring_visma_finance', $data ?? [], null);
        $this->setIfExists('complete_monthly_hour_lists', $data ?? [], null);
        $this->setIfExists('module_department_accounting', $data ?? [], null);
        $this->setIfExists('module_wage_project_accounting', $data ?? [], null);
        $this->setIfExists('module_project_accounting', $data ?? [], null);
        $this->setIfExists('module_product_accounting', $data ?? [], null);
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

        $allowedValues = $this->getModuleFactoringVismaFinanceAllowableValues();
        if (!is_null($this->container['module_factoring_visma_finance']) && !in_array($this->container['module_factoring_visma_finance'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'module_factoring_visma_finance', must be one of '%s'",
                $this->container['module_factoring_visma_finance'],
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
     * Gets accounting
     *
     * @return bool|null
     */
    public function getAccounting()
    {
        return $this->container['accounting'];
    }

    /**
     * Sets accounting
     *
     * @param bool|null $accounting Not readable. Only for input.
     *
     * @return self
     */
    public function setAccounting($accounting)
    {
        if (is_null($accounting)) {
            throw new \InvalidArgumentException('non-nullable accounting cannot be null');
        }
        $this->container['accounting'] = $accounting;

        return $this;
    }

    /**
     * Gets invoice
     *
     * @return bool|null
     */
    public function getInvoice()
    {
        return $this->container['invoice'];
    }

    /**
     * Sets invoice
     *
     * @param bool|null $invoice Not readable. Only for input.
     *
     * @return self
     */
    public function setInvoice($invoice)
    {
        if (is_null($invoice)) {
            throw new \InvalidArgumentException('non-nullable invoice cannot be null');
        }
        $this->container['invoice'] = $invoice;

        return $this;
    }

    /**
     * Gets salary
     *
     * @return bool|null
     */
    public function getSalary()
    {
        return $this->container['salary'];
    }

    /**
     * Sets salary
     *
     * @param bool|null $salary Not readable. Only for input.
     *
     * @return self
     */
    public function setSalary($salary)
    {
        if (is_null($salary)) {
            throw new \InvalidArgumentException('non-nullable salary cannot be null');
        }
        $this->container['salary'] = $salary;

        return $this;
    }

    /**
     * Gets salary_start_date
     *
     * @return string|null
     */
    public function getSalaryStartDate()
    {
        return $this->container['salary_start_date'];
    }

    /**
     * Sets salary_start_date
     *
     * @param string|null $salary_start_date salary_start_date
     *
     * @return self
     */
    public function setSalaryStartDate($salary_start_date)
    {
        if (is_null($salary_start_date)) {
            throw new \InvalidArgumentException('non-nullable salary_start_date cannot be null');
        }
        $this->container['salary_start_date'] = $salary_start_date;

        return $this;
    }

    /**
     * Gets project
     *
     * @return bool|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param bool|null $project Not readable. Only for input.
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets ocr
     *
     * @return bool|null
     */
    public function getOcr()
    {
        return $this->container['ocr'];
    }

    /**
     * Sets ocr
     *
     * @param bool|null $ocr ocr
     *
     * @return self
     */
    public function setOcr($ocr)
    {
        if (is_null($ocr)) {
            throw new \InvalidArgumentException('non-nullable ocr cannot be null');
        }
        $this->container['ocr'] = $ocr;

        return $this;
    }

    /**
     * Gets auto_pay_ocr
     *
     * @return bool|null
     */
    public function getAutoPayOcr()
    {
        return $this->container['auto_pay_ocr'];
    }

    /**
     * Sets auto_pay_ocr
     *
     * @param bool|null $auto_pay_ocr auto_pay_ocr
     *
     * @return self
     */
    public function setAutoPayOcr($auto_pay_ocr)
    {
        if (is_null($auto_pay_ocr)) {
            throw new \InvalidArgumentException('non-nullable auto_pay_ocr cannot be null');
        }
        $this->container['auto_pay_ocr'] = $auto_pay_ocr;

        return $this;
    }

    /**
     * Gets remit
     *
     * @return bool|null
     */
    public function getRemit()
    {
        return $this->container['remit'];
    }

    /**
     * Sets remit
     *
     * @param bool|null $remit remit
     *
     * @return self
     */
    public function setRemit($remit)
    {
        if (is_null($remit)) {
            throw new \InvalidArgumentException('non-nullable remit cannot be null');
        }
        $this->container['remit'] = $remit;

        return $this;
    }

    /**
     * Gets electronic_vouchers
     *
     * @return bool|null
     */
    public function getElectronicVouchers()
    {
        return $this->container['electronic_vouchers'];
    }

    /**
     * Sets electronic_vouchers
     *
     * @param bool|null $electronic_vouchers Not readable. Only for input.
     *
     * @return self
     */
    public function setElectronicVouchers($electronic_vouchers)
    {
        if (is_null($electronic_vouchers)) {
            throw new \InvalidArgumentException('non-nullable electronic_vouchers cannot be null');
        }
        $this->container['electronic_vouchers'] = $electronic_vouchers;

        return $this;
    }

    /**
     * Gets electro
     *
     * @return bool|null
     */
    public function getElectro()
    {
        return $this->container['electro'];
    }

    /**
     * Sets electro
     *
     * @param bool|null $electro Not readable. Only for input.
     *
     * @return self
     */
    public function setElectro($electro)
    {
        if (is_null($electro)) {
            throw new \InvalidArgumentException('non-nullable electro cannot be null');
        }
        $this->container['electro'] = $electro;

        return $this;
    }

    /**
     * Gets vvs
     *
     * @return bool|null
     */
    public function getVvs()
    {
        return $this->container['vvs'];
    }

    /**
     * Sets vvs
     *
     * @param bool|null $vvs Not readable. Only for input.
     *
     * @return self
     */
    public function setVvs($vvs)
    {
        if (is_null($vvs)) {
            throw new \InvalidArgumentException('non-nullable vvs cannot be null');
        }
        $this->container['vvs'] = $vvs;

        return $this;
    }

    /**
     * Gets agro
     *
     * @return bool|null
     */
    public function getAgro()
    {
        return $this->container['agro'];
    }

    /**
     * Sets agro
     *
     * @param bool|null $agro agro
     *
     * @return self
     */
    public function setAgro($agro)
    {
        if (is_null($agro)) {
            throw new \InvalidArgumentException('non-nullable agro cannot be null');
        }
        $this->container['agro'] = $agro;

        return $this;
    }

    /**
     * Gets mamut
     *
     * @return bool|null
     */
    public function getMamut()
    {
        return $this->container['mamut'];
    }

    /**
     * Sets mamut
     *
     * @param bool|null $mamut mamut
     *
     * @return self
     */
    public function setMamut($mamut)
    {
        if (is_null($mamut)) {
            throw new \InvalidArgumentException('non-nullable mamut cannot be null');
        }
        $this->container['mamut'] = $mamut;

        return $this;
    }

    /**
     * Gets approve_voucher
     *
     * @return bool|null
     */
    public function getApproveVoucher()
    {
        return $this->container['approve_voucher'];
    }

    /**
     * Sets approve_voucher
     *
     * @param bool|null $approve_voucher Only readable for now
     *
     * @return self
     */
    public function setApproveVoucher($approve_voucher)
    {
        if (is_null($approve_voucher)) {
            throw new \InvalidArgumentException('non-nullable approve_voucher cannot be null');
        }
        $this->container['approve_voucher'] = $approve_voucher;

        return $this;
    }

    /**
     * Gets moduleprojecteconomy
     *
     * @return bool|null
     */
    public function getModuleprojecteconomy()
    {
        return $this->container['moduleprojecteconomy'];
    }

    /**
     * Sets moduleprojecteconomy
     *
     * @param bool|null $moduleprojecteconomy moduleprojecteconomy
     *
     * @return self
     */
    public function setModuleprojecteconomy($moduleprojecteconomy)
    {
        if (is_null($moduleprojecteconomy)) {
            throw new \InvalidArgumentException('non-nullable moduleprojecteconomy cannot be null');
        }
        $this->container['moduleprojecteconomy'] = $moduleprojecteconomy;

        return $this;
    }

    /**
     * Gets moduleemployee
     *
     * @return bool|null
     */
    public function getModuleemployee()
    {
        return $this->container['moduleemployee'];
    }

    /**
     * Sets moduleemployee
     *
     * @param bool|null $moduleemployee moduleemployee
     *
     * @return self
     */
    public function setModuleemployee($moduleemployee)
    {
        if (is_null($moduleemployee)) {
            throw new \InvalidArgumentException('non-nullable moduleemployee cannot be null');
        }
        $this->container['moduleemployee'] = $moduleemployee;

        return $this;
    }

    /**
     * Gets module_contact
     *
     * @return bool|null
     */
    public function getModuleContact()
    {
        return $this->container['module_contact'];
    }

    /**
     * Sets module_contact
     *
     * @param bool|null $module_contact module_contact
     *
     * @return self
     */
    public function setModuleContact($module_contact)
    {
        if (is_null($module_contact)) {
            throw new \InvalidArgumentException('non-nullable module_contact cannot be null');
        }
        $this->container['module_contact'] = $module_contact;

        return $this;
    }

    /**
     * Gets modulecustomer
     *
     * @return bool|null
     */
    public function getModulecustomer()
    {
        return $this->container['modulecustomer'];
    }

    /**
     * Sets modulecustomer
     *
     * @param bool|null $modulecustomer modulecustomer
     *
     * @return self
     */
    public function setModulecustomer($modulecustomer)
    {
        if (is_null($modulecustomer)) {
            throw new \InvalidArgumentException('non-nullable modulecustomer cannot be null');
        }
        $this->container['modulecustomer'] = $modulecustomer;

        return $this;
    }

    /**
     * Gets moduledepartment
     *
     * @return bool|null
     */
    public function getModuledepartment()
    {
        return $this->container['moduledepartment'];
    }

    /**
     * Sets moduledepartment
     *
     * @param bool|null $moduledepartment moduledepartment
     *
     * @return self
     */
    public function setModuledepartment($moduledepartment)
    {
        if (is_null($moduledepartment)) {
            throw new \InvalidArgumentException('non-nullable moduledepartment cannot be null');
        }
        $this->container['moduledepartment'] = $moduledepartment;

        return $this;
    }

    /**
     * Gets moduleprojectcategory
     *
     * @return bool|null
     */
    public function getModuleprojectcategory()
    {
        return $this->container['moduleprojectcategory'];
    }

    /**
     * Sets moduleprojectcategory
     *
     * @param bool|null $moduleprojectcategory moduleprojectcategory
     *
     * @return self
     */
    public function setModuleprojectcategory($moduleprojectcategory)
    {
        if (is_null($moduleprojectcategory)) {
            throw new \InvalidArgumentException('non-nullable moduleprojectcategory cannot be null');
        }
        $this->container['moduleprojectcategory'] = $moduleprojectcategory;

        return $this;
    }

    /**
     * Gets moduleinvoice
     *
     * @return bool|null
     */
    public function getModuleinvoice()
    {
        return $this->container['moduleinvoice'];
    }

    /**
     * Sets moduleinvoice
     *
     * @param bool|null $moduleinvoice moduleinvoice
     *
     * @return self
     */
    public function setModuleinvoice($moduleinvoice)
    {
        if (is_null($moduleinvoice)) {
            throw new \InvalidArgumentException('non-nullable moduleinvoice cannot be null');
        }
        $this->container['moduleinvoice'] = $moduleinvoice;

        return $this;
    }

    /**
     * Gets module_currency
     *
     * @return bool|null
     */
    public function getModuleCurrency()
    {
        return $this->container['module_currency'];
    }

    /**
     * Sets module_currency
     *
     * @param bool|null $module_currency module_currency
     *
     * @return self
     */
    public function setModuleCurrency($module_currency)
    {
        if (is_null($module_currency)) {
            throw new \InvalidArgumentException('non-nullable module_currency cannot be null');
        }
        $this->container['module_currency'] = $module_currency;

        return $this;
    }

    /**
     * Gets module_project_budget
     *
     * @return bool|null
     */
    public function getModuleProjectBudget()
    {
        return $this->container['module_project_budget'];
    }

    /**
     * Sets module_project_budget
     *
     * @param bool|null $module_project_budget module_project_budget
     *
     * @return self
     */
    public function setModuleProjectBudget($module_project_budget)
    {
        if (is_null($module_project_budget)) {
            throw new \InvalidArgumentException('non-nullable module_project_budget cannot be null');
        }
        $this->container['module_project_budget'] = $module_project_budget;

        return $this;
    }

    /**
     * Gets module_factoring_visma_finance
     *
     * @return string|null
     */
    public function getModuleFactoringVismaFinance()
    {
        return $this->container['module_factoring_visma_finance'];
    }

    /**
     * Sets module_factoring_visma_finance
     *
     * @param string|null $module_factoring_visma_finance module_factoring_visma_finance
     *
     * @return self
     */
    public function setModuleFactoringVismaFinance($module_factoring_visma_finance)
    {
        if (is_null($module_factoring_visma_finance)) {
            throw new \InvalidArgumentException('non-nullable module_factoring_visma_finance cannot be null');
        }
        $allowedValues = $this->getModuleFactoringVismaFinanceAllowableValues();
        if (!in_array($module_factoring_visma_finance, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'module_factoring_visma_finance', must be one of '%s'",
                    $module_factoring_visma_finance,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['module_factoring_visma_finance'] = $module_factoring_visma_finance;

        return $this;
    }

    /**
     * Gets complete_monthly_hour_lists
     *
     * @return bool|null
     */
    public function getCompleteMonthlyHourLists()
    {
        return $this->container['complete_monthly_hour_lists'];
    }

    /**
     * Sets complete_monthly_hour_lists
     *
     * @param bool|null $complete_monthly_hour_lists complete_monthly_hour_lists
     *
     * @return self
     */
    public function setCompleteMonthlyHourLists($complete_monthly_hour_lists)
    {
        if (is_null($complete_monthly_hour_lists)) {
            throw new \InvalidArgumentException('non-nullable complete_monthly_hour_lists cannot be null');
        }
        $this->container['complete_monthly_hour_lists'] = $complete_monthly_hour_lists;

        return $this;
    }

    /**
     * Gets module_department_accounting
     *
     * @return bool|null
     */
    public function getModuleDepartmentAccounting()
    {
        return $this->container['module_department_accounting'];
    }

    /**
     * Sets module_department_accounting
     *
     * @param bool|null $module_department_accounting module_department_accounting
     *
     * @return self
     */
    public function setModuleDepartmentAccounting($module_department_accounting)
    {
        if (is_null($module_department_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_department_accounting cannot be null');
        }
        $this->container['module_department_accounting'] = $module_department_accounting;

        return $this;
    }

    /**
     * Gets module_wage_project_accounting
     *
     * @return bool|null
     */
    public function getModuleWageProjectAccounting()
    {
        return $this->container['module_wage_project_accounting'];
    }

    /**
     * Sets module_wage_project_accounting
     *
     * @param bool|null $module_wage_project_accounting module_wage_project_accounting
     *
     * @return self
     */
    public function setModuleWageProjectAccounting($module_wage_project_accounting)
    {
        if (is_null($module_wage_project_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_wage_project_accounting cannot be null');
        }
        $this->container['module_wage_project_accounting'] = $module_wage_project_accounting;

        return $this;
    }

    /**
     * Gets module_project_accounting
     *
     * @return bool|null
     */
    public function getModuleProjectAccounting()
    {
        return $this->container['module_project_accounting'];
    }

    /**
     * Sets module_project_accounting
     *
     * @param bool|null $module_project_accounting read only
     *
     * @return self
     */
    public function setModuleProjectAccounting($module_project_accounting)
    {
        if (is_null($module_project_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_project_accounting cannot be null');
        }
        $this->container['module_project_accounting'] = $module_project_accounting;

        return $this;
    }

    /**
     * Gets module_product_accounting
     *
     * @return bool|null
     */
    public function getModuleProductAccounting()
    {
        return $this->container['module_product_accounting'];
    }

    /**
     * Sets module_product_accounting
     *
     * @param bool|null $module_product_accounting read only
     *
     * @return self
     */
    public function setModuleProductAccounting($module_product_accounting)
    {
        if (is_null($module_product_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_product_accounting cannot be null');
        }
        $this->container['module_product_accounting'] = $module_product_accounting;

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


