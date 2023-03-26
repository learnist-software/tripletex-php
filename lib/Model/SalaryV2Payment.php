<?php
/**
 * SalaryV2Payment
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
 * SalaryV2Payment Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalaryV2Payment implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalaryV2Payment';

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
'transaction' => '\Learnist\Tripletex\Model\SalaryV2Transaction',
'employee' => '\Learnist\Tripletex\Model\SalaryV2Employee',
'employment' => '\Learnist\Tripletex\Model\Employment',
'date' => 'string',
'year' => 'int',
'month' => 'int',
'vacation_allowance_amount' => 'float',
'gross_amount' => 'float',
'amount' => 'float',
'number' => 'int',
'sum_amount_tax_deductions' => 'float',
'payroll_tax_amount' => 'float',
'payroll_tax_basis' => 'float',
'payroll_tax_municipality' => '\Learnist\Tripletex\Model\Municipality',
'division' => '\Learnist\Tripletex\Model\Company',
'holiday_allowance_rate' => 'float',
'bank_account_or_iban' => 'string',
'payroll_tax_percentage' => 'float',
'delivery_method_pay_slip' => 'string',
'is_tax_card_missing' => 'bool',
'comment' => 'string',
'specifications' => '\Learnist\Tripletex\Model\SalaryV2Specification[]',
'travel_expenses' => '\Learnist\Tripletex\Model\SalaryV2TravelExpense[]',
'employee_hourly_wage' => 'float',
'tax_description' => 'string',
'gross_amount_description' => 'string',
'seamen_days_on_board' => 'int',
'last_month_paid_amount' => 'float',
'employee_salary_date' => 'string',
'suggest_add_readjustment' => 'bool',
'is_employment_info_ameldinger' => 'bool',
'seamen_deduction' => 'bool',
'validation_results' => '\Learnist\Tripletex\Model\SalaryV2PaymentValidationResult'    ];

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
'transaction' => null,
'employee' => null,
'employment' => null,
'date' => null,
'year' => 'int32',
'month' => 'int32',
'vacation_allowance_amount' => null,
'gross_amount' => null,
'amount' => null,
'number' => 'int32',
'sum_amount_tax_deductions' => null,
'payroll_tax_amount' => null,
'payroll_tax_basis' => null,
'payroll_tax_municipality' => null,
'division' => null,
'holiday_allowance_rate' => null,
'bank_account_or_iban' => null,
'payroll_tax_percentage' => null,
'delivery_method_pay_slip' => null,
'is_tax_card_missing' => null,
'comment' => null,
'specifications' => null,
'travel_expenses' => null,
'employee_hourly_wage' => null,
'tax_description' => null,
'gross_amount_description' => null,
'seamen_days_on_board' => 'int32',
'last_month_paid_amount' => null,
'employee_salary_date' => null,
'suggest_add_readjustment' => null,
'is_employment_info_ameldinger' => null,
'seamen_deduction' => null,
'validation_results' => null    ];

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
'transaction' => 'transaction',
'employee' => 'employee',
'employment' => 'employment',
'date' => 'date',
'year' => 'year',
'month' => 'month',
'vacation_allowance_amount' => 'vacationAllowanceAmount',
'gross_amount' => 'grossAmount',
'amount' => 'amount',
'number' => 'number',
'sum_amount_tax_deductions' => 'sumAmountTaxDeductions',
'payroll_tax_amount' => 'payrollTaxAmount',
'payroll_tax_basis' => 'payrollTaxBasis',
'payroll_tax_municipality' => 'payrollTaxMunicipality',
'division' => 'division',
'holiday_allowance_rate' => 'holidayAllowanceRate',
'bank_account_or_iban' => 'bankAccountOrIban',
'payroll_tax_percentage' => 'payrollTaxPercentage',
'delivery_method_pay_slip' => 'deliveryMethodPaySlip',
'is_tax_card_missing' => 'isTaxCardMissing',
'comment' => 'comment',
'specifications' => 'specifications',
'travel_expenses' => 'travelExpenses',
'employee_hourly_wage' => 'employeeHourlyWage',
'tax_description' => 'taxDescription',
'gross_amount_description' => 'grossAmountDescription',
'seamen_days_on_board' => 'seamenDaysOnBoard',
'last_month_paid_amount' => 'lastMonthPaidAmount',
'employee_salary_date' => 'employeeSalaryDate',
'suggest_add_readjustment' => 'suggestAddReadjustment',
'is_employment_info_ameldinger' => 'isEmploymentInfoAmeldinger',
'seamen_deduction' => 'seamenDeduction',
'validation_results' => 'validationResults'    ];

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
'transaction' => 'setTransaction',
'employee' => 'setEmployee',
'employment' => 'setEmployment',
'date' => 'setDate',
'year' => 'setYear',
'month' => 'setMonth',
'vacation_allowance_amount' => 'setVacationAllowanceAmount',
'gross_amount' => 'setGrossAmount',
'amount' => 'setAmount',
'number' => 'setNumber',
'sum_amount_tax_deductions' => 'setSumAmountTaxDeductions',
'payroll_tax_amount' => 'setPayrollTaxAmount',
'payroll_tax_basis' => 'setPayrollTaxBasis',
'payroll_tax_municipality' => 'setPayrollTaxMunicipality',
'division' => 'setDivision',
'holiday_allowance_rate' => 'setHolidayAllowanceRate',
'bank_account_or_iban' => 'setBankAccountOrIban',
'payroll_tax_percentage' => 'setPayrollTaxPercentage',
'delivery_method_pay_slip' => 'setDeliveryMethodPaySlip',
'is_tax_card_missing' => 'setIsTaxCardMissing',
'comment' => 'setComment',
'specifications' => 'setSpecifications',
'travel_expenses' => 'setTravelExpenses',
'employee_hourly_wage' => 'setEmployeeHourlyWage',
'tax_description' => 'setTaxDescription',
'gross_amount_description' => 'setGrossAmountDescription',
'seamen_days_on_board' => 'setSeamenDaysOnBoard',
'last_month_paid_amount' => 'setLastMonthPaidAmount',
'employee_salary_date' => 'setEmployeeSalaryDate',
'suggest_add_readjustment' => 'setSuggestAddReadjustment',
'is_employment_info_ameldinger' => 'setIsEmploymentInfoAmeldinger',
'seamen_deduction' => 'setSeamenDeduction',
'validation_results' => 'setValidationResults'    ];

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
'transaction' => 'getTransaction',
'employee' => 'getEmployee',
'employment' => 'getEmployment',
'date' => 'getDate',
'year' => 'getYear',
'month' => 'getMonth',
'vacation_allowance_amount' => 'getVacationAllowanceAmount',
'gross_amount' => 'getGrossAmount',
'amount' => 'getAmount',
'number' => 'getNumber',
'sum_amount_tax_deductions' => 'getSumAmountTaxDeductions',
'payroll_tax_amount' => 'getPayrollTaxAmount',
'payroll_tax_basis' => 'getPayrollTaxBasis',
'payroll_tax_municipality' => 'getPayrollTaxMunicipality',
'division' => 'getDivision',
'holiday_allowance_rate' => 'getHolidayAllowanceRate',
'bank_account_or_iban' => 'getBankAccountOrIban',
'payroll_tax_percentage' => 'getPayrollTaxPercentage',
'delivery_method_pay_slip' => 'getDeliveryMethodPaySlip',
'is_tax_card_missing' => 'getIsTaxCardMissing',
'comment' => 'getComment',
'specifications' => 'getSpecifications',
'travel_expenses' => 'getTravelExpenses',
'employee_hourly_wage' => 'getEmployeeHourlyWage',
'tax_description' => 'getTaxDescription',
'gross_amount_description' => 'getGrossAmountDescription',
'seamen_days_on_board' => 'getSeamenDaysOnBoard',
'last_month_paid_amount' => 'getLastMonthPaidAmount',
'employee_salary_date' => 'getEmployeeSalaryDate',
'suggest_add_readjustment' => 'getSuggestAddReadjustment',
'is_employment_info_ameldinger' => 'getIsEmploymentInfoAmeldinger',
'seamen_deduction' => 'getSeamenDeduction',
'validation_results' => 'getValidationResults'    ];

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

    const DELIVERY_METHOD_PAY_SLIP_MANUAL = 'MANUAL';
const DELIVERY_METHOD_PAY_SLIP_EBOKS = 'EBOKS';
const DELIVERY_METHOD_PAY_SLIP__PRINT = 'PRINT';
const DELIVERY_METHOD_PAY_SLIP_EMAIL = 'EMAIL';
const DELIVERY_METHOD_PAY_SLIP_APP = 'APP';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDeliveryMethodPaySlipAllowableValues()
    {
        return [
            self::DELIVERY_METHOD_PAY_SLIP_MANUAL,
self::DELIVERY_METHOD_PAY_SLIP_EBOKS,
self::DELIVERY_METHOD_PAY_SLIP__PRINT,
self::DELIVERY_METHOD_PAY_SLIP_EMAIL,
self::DELIVERY_METHOD_PAY_SLIP_APP,        ];
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
        $this->container['transaction'] = isset($data['transaction']) ? $data['transaction'] : null;
        $this->container['employee'] = isset($data['employee']) ? $data['employee'] : null;
        $this->container['employment'] = isset($data['employment']) ? $data['employment'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['year'] = isset($data['year']) ? $data['year'] : null;
        $this->container['month'] = isset($data['month']) ? $data['month'] : null;
        $this->container['vacation_allowance_amount'] = isset($data['vacation_allowance_amount']) ? $data['vacation_allowance_amount'] : null;
        $this->container['gross_amount'] = isset($data['gross_amount']) ? $data['gross_amount'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['sum_amount_tax_deductions'] = isset($data['sum_amount_tax_deductions']) ? $data['sum_amount_tax_deductions'] : null;
        $this->container['payroll_tax_amount'] = isset($data['payroll_tax_amount']) ? $data['payroll_tax_amount'] : null;
        $this->container['payroll_tax_basis'] = isset($data['payroll_tax_basis']) ? $data['payroll_tax_basis'] : null;
        $this->container['payroll_tax_municipality'] = isset($data['payroll_tax_municipality']) ? $data['payroll_tax_municipality'] : null;
        $this->container['division'] = isset($data['division']) ? $data['division'] : null;
        $this->container['holiday_allowance_rate'] = isset($data['holiday_allowance_rate']) ? $data['holiday_allowance_rate'] : null;
        $this->container['bank_account_or_iban'] = isset($data['bank_account_or_iban']) ? $data['bank_account_or_iban'] : null;
        $this->container['payroll_tax_percentage'] = isset($data['payroll_tax_percentage']) ? $data['payroll_tax_percentage'] : null;
        $this->container['delivery_method_pay_slip'] = isset($data['delivery_method_pay_slip']) ? $data['delivery_method_pay_slip'] : null;
        $this->container['is_tax_card_missing'] = isset($data['is_tax_card_missing']) ? $data['is_tax_card_missing'] : null;
        $this->container['comment'] = isset($data['comment']) ? $data['comment'] : null;
        $this->container['specifications'] = isset($data['specifications']) ? $data['specifications'] : null;
        $this->container['travel_expenses'] = isset($data['travel_expenses']) ? $data['travel_expenses'] : null;
        $this->container['employee_hourly_wage'] = isset($data['employee_hourly_wage']) ? $data['employee_hourly_wage'] : null;
        $this->container['tax_description'] = isset($data['tax_description']) ? $data['tax_description'] : null;
        $this->container['gross_amount_description'] = isset($data['gross_amount_description']) ? $data['gross_amount_description'] : null;
        $this->container['seamen_days_on_board'] = isset($data['seamen_days_on_board']) ? $data['seamen_days_on_board'] : null;
        $this->container['last_month_paid_amount'] = isset($data['last_month_paid_amount']) ? $data['last_month_paid_amount'] : null;
        $this->container['employee_salary_date'] = isset($data['employee_salary_date']) ? $data['employee_salary_date'] : null;
        $this->container['suggest_add_readjustment'] = isset($data['suggest_add_readjustment']) ? $data['suggest_add_readjustment'] : null;
        $this->container['is_employment_info_ameldinger'] = isset($data['is_employment_info_ameldinger']) ? $data['is_employment_info_ameldinger'] : null;
        $this->container['seamen_deduction'] = isset($data['seamen_deduction']) ? $data['seamen_deduction'] : null;
        $this->container['validation_results'] = isset($data['validation_results']) ? $data['validation_results'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['employee'] === null) {
            $invalidProperties[] = "'employee' can't be null";
        }
        if ($this->container['employment'] === null) {
            $invalidProperties[] = "'employment' can't be null";
        }
        $allowedValues = $this->getDeliveryMethodPaySlipAllowableValues();
        if (!is_null($this->container['delivery_method_pay_slip']) && !in_array($this->container['delivery_method_pay_slip'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'delivery_method_pay_slip', must be one of '%s'",
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
     * Gets transaction
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Transaction
     */
    public function getTransaction()
    {
        return $this->container['transaction'];
    }

    /**
     * Sets transaction
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Transaction $transaction transaction
     *
     * @return $this
     */
    public function setTransaction($transaction)
    {
        $this->container['transaction'] = $transaction;

        return $this;
    }

    /**
     * Gets employee
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Employee
     */
    public function getEmployee()
    {
        return $this->container['employee'];
    }

    /**
     * Sets employee
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Employee $employee employee
     *
     * @return $this
     */
    public function setEmployee($employee)
    {
        $this->container['employee'] = $employee;

        return $this;
    }

    /**
     * Gets employment
     *
     * @return \Learnist\Tripletex\Model\Employment
     */
    public function getEmployment()
    {
        return $this->container['employment'];
    }

    /**
     * Sets employment
     *
     * @param \Learnist\Tripletex\Model\Employment $employment employment
     *
     * @return $this
     */
    public function setEmployment($employment)
    {
        $this->container['employment'] = $employment;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date Voucher date.
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int $year year
     *
     * @return $this
     */
    public function setYear($year)
    {
        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->container['month'];
    }

    /**
     * Sets month
     *
     * @param int $month month
     *
     * @return $this
     */
    public function setMonth($month)
    {
        $this->container['month'] = $month;

        return $this;
    }

    /**
     * Gets vacation_allowance_amount
     *
     * @return float
     */
    public function getVacationAllowanceAmount()
    {
        return $this->container['vacation_allowance_amount'];
    }

    /**
     * Sets vacation_allowance_amount
     *
     * @param float $vacation_allowance_amount vacation_allowance_amount
     *
     * @return $this
     */
    public function setVacationAllowanceAmount($vacation_allowance_amount)
    {
        $this->container['vacation_allowance_amount'] = $vacation_allowance_amount;

        return $this;
    }

    /**
     * Gets gross_amount
     *
     * @return float
     */
    public function getGrossAmount()
    {
        return $this->container['gross_amount'];
    }

    /**
     * Sets gross_amount
     *
     * @param float $gross_amount gross_amount
     *
     * @return $this
     */
    public function setGrossAmount($gross_amount)
    {
        $this->container['gross_amount'] = $gross_amount;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param int $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets sum_amount_tax_deductions
     *
     * @return float
     */
    public function getSumAmountTaxDeductions()
    {
        return $this->container['sum_amount_tax_deductions'];
    }

    /**
     * Sets sum_amount_tax_deductions
     *
     * @param float $sum_amount_tax_deductions sum_amount_tax_deductions
     *
     * @return $this
     */
    public function setSumAmountTaxDeductions($sum_amount_tax_deductions)
    {
        $this->container['sum_amount_tax_deductions'] = $sum_amount_tax_deductions;

        return $this;
    }

    /**
     * Gets payroll_tax_amount
     *
     * @return float
     */
    public function getPayrollTaxAmount()
    {
        return $this->container['payroll_tax_amount'];
    }

    /**
     * Sets payroll_tax_amount
     *
     * @param float $payroll_tax_amount payroll_tax_amount
     *
     * @return $this
     */
    public function setPayrollTaxAmount($payroll_tax_amount)
    {
        $this->container['payroll_tax_amount'] = $payroll_tax_amount;

        return $this;
    }

    /**
     * Gets payroll_tax_basis
     *
     * @return float
     */
    public function getPayrollTaxBasis()
    {
        return $this->container['payroll_tax_basis'];
    }

    /**
     * Sets payroll_tax_basis
     *
     * @param float $payroll_tax_basis payroll_tax_basis
     *
     * @return $this
     */
    public function setPayrollTaxBasis($payroll_tax_basis)
    {
        $this->container['payroll_tax_basis'] = $payroll_tax_basis;

        return $this;
    }

    /**
     * Gets payroll_tax_municipality
     *
     * @return \Learnist\Tripletex\Model\Municipality
     */
    public function getPayrollTaxMunicipality()
    {
        return $this->container['payroll_tax_municipality'];
    }

    /**
     * Sets payroll_tax_municipality
     *
     * @param \Learnist\Tripletex\Model\Municipality $payroll_tax_municipality payroll_tax_municipality
     *
     * @return $this
     */
    public function setPayrollTaxMunicipality($payroll_tax_municipality)
    {
        $this->container['payroll_tax_municipality'] = $payroll_tax_municipality;

        return $this;
    }

    /**
     * Gets division
     *
     * @return \Learnist\Tripletex\Model\Company
     */
    public function getDivision()
    {
        return $this->container['division'];
    }

    /**
     * Sets division
     *
     * @param \Learnist\Tripletex\Model\Company $division division
     *
     * @return $this
     */
    public function setDivision($division)
    {
        $this->container['division'] = $division;

        return $this;
    }

    /**
     * Gets holiday_allowance_rate
     *
     * @return float
     */
    public function getHolidayAllowanceRate()
    {
        return $this->container['holiday_allowance_rate'];
    }

    /**
     * Sets holiday_allowance_rate
     *
     * @param float $holiday_allowance_rate holiday_allowance_rate
     *
     * @return $this
     */
    public function setHolidayAllowanceRate($holiday_allowance_rate)
    {
        $this->container['holiday_allowance_rate'] = $holiday_allowance_rate;

        return $this;
    }

    /**
     * Gets bank_account_or_iban
     *
     * @return string
     */
    public function getBankAccountOrIban()
    {
        return $this->container['bank_account_or_iban'];
    }

    /**
     * Sets bank_account_or_iban
     *
     * @param string $bank_account_or_iban bank_account_or_iban
     *
     * @return $this
     */
    public function setBankAccountOrIban($bank_account_or_iban)
    {
        $this->container['bank_account_or_iban'] = $bank_account_or_iban;

        return $this;
    }

    /**
     * Gets payroll_tax_percentage
     *
     * @return float
     */
    public function getPayrollTaxPercentage()
    {
        return $this->container['payroll_tax_percentage'];
    }

    /**
     * Sets payroll_tax_percentage
     *
     * @param float $payroll_tax_percentage payroll_tax_percentage
     *
     * @return $this
     */
    public function setPayrollTaxPercentage($payroll_tax_percentage)
    {
        $this->container['payroll_tax_percentage'] = $payroll_tax_percentage;

        return $this;
    }

    /**
     * Gets delivery_method_pay_slip
     *
     * @return string
     */
    public function getDeliveryMethodPaySlip()
    {
        return $this->container['delivery_method_pay_slip'];
    }

    /**
     * Sets delivery_method_pay_slip
     *
     * @param string $delivery_method_pay_slip delivery_method_pay_slip
     *
     * @return $this
     */
    public function setDeliveryMethodPaySlip($delivery_method_pay_slip)
    {
        $allowedValues = $this->getDeliveryMethodPaySlipAllowableValues();
        if (!is_null($delivery_method_pay_slip) && !in_array($delivery_method_pay_slip, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'delivery_method_pay_slip', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['delivery_method_pay_slip'] = $delivery_method_pay_slip;

        return $this;
    }

    /**
     * Gets is_tax_card_missing
     *
     * @return bool
     */
    public function getIsTaxCardMissing()
    {
        return $this->container['is_tax_card_missing'];
    }

    /**
     * Sets is_tax_card_missing
     *
     * @param bool $is_tax_card_missing is_tax_card_missing
     *
     * @return $this
     */
    public function setIsTaxCardMissing($is_tax_card_missing)
    {
        $this->container['is_tax_card_missing'] = $is_tax_card_missing;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string $comment comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets specifications
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Specification[]
     */
    public function getSpecifications()
    {
        return $this->container['specifications'];
    }

    /**
     * Sets specifications
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Specification[] $specifications Link to salary specifications.
     *
     * @return $this
     */
    public function setSpecifications($specifications)
    {
        $this->container['specifications'] = $specifications;

        return $this;
    }

    /**
     * Gets travel_expenses
     *
     * @return \Learnist\Tripletex\Model\SalaryV2TravelExpense[]
     */
    public function getTravelExpenses()
    {
        return $this->container['travel_expenses'];
    }

    /**
     * Sets travel_expenses
     *
     * @param \Learnist\Tripletex\Model\SalaryV2TravelExpense[] $travel_expenses Link to salary specifications.
     *
     * @return $this
     */
    public function setTravelExpenses($travel_expenses)
    {
        $this->container['travel_expenses'] = $travel_expenses;

        return $this;
    }

    /**
     * Gets employee_hourly_wage
     *
     * @return float
     */
    public function getEmployeeHourlyWage()
    {
        return $this->container['employee_hourly_wage'];
    }

    /**
     * Sets employee_hourly_wage
     *
     * @param float $employee_hourly_wage employee_hourly_wage
     *
     * @return $this
     */
    public function setEmployeeHourlyWage($employee_hourly_wage)
    {
        $this->container['employee_hourly_wage'] = $employee_hourly_wage;

        return $this;
    }

    /**
     * Gets tax_description
     *
     * @return string
     */
    public function getTaxDescription()
    {
        return $this->container['tax_description'];
    }

    /**
     * Sets tax_description
     *
     * @param string $tax_description tax_description
     *
     * @return $this
     */
    public function setTaxDescription($tax_description)
    {
        $this->container['tax_description'] = $tax_description;

        return $this;
    }

    /**
     * Gets gross_amount_description
     *
     * @return string
     */
    public function getGrossAmountDescription()
    {
        return $this->container['gross_amount_description'];
    }

    /**
     * Sets gross_amount_description
     *
     * @param string $gross_amount_description gross_amount_description
     *
     * @return $this
     */
    public function setGrossAmountDescription($gross_amount_description)
    {
        $this->container['gross_amount_description'] = $gross_amount_description;

        return $this;
    }

    /**
     * Gets seamen_days_on_board
     *
     * @return int
     */
    public function getSeamenDaysOnBoard()
    {
        return $this->container['seamen_days_on_board'];
    }

    /**
     * Sets seamen_days_on_board
     *
     * @param int $seamen_days_on_board seamen_days_on_board
     *
     * @return $this
     */
    public function setSeamenDaysOnBoard($seamen_days_on_board)
    {
        $this->container['seamen_days_on_board'] = $seamen_days_on_board;

        return $this;
    }

    /**
     * Gets last_month_paid_amount
     *
     * @return float
     */
    public function getLastMonthPaidAmount()
    {
        return $this->container['last_month_paid_amount'];
    }

    /**
     * Sets last_month_paid_amount
     *
     * @param float $last_month_paid_amount last_month_paid_amount
     *
     * @return $this
     */
    public function setLastMonthPaidAmount($last_month_paid_amount)
    {
        $this->container['last_month_paid_amount'] = $last_month_paid_amount;

        return $this;
    }

    /**
     * Gets employee_salary_date
     *
     * @return string
     */
    public function getEmployeeSalaryDate()
    {
        return $this->container['employee_salary_date'];
    }

    /**
     * Sets employee_salary_date
     *
     * @param string $employee_salary_date employee_salary_date
     *
     * @return $this
     */
    public function setEmployeeSalaryDate($employee_salary_date)
    {
        $this->container['employee_salary_date'] = $employee_salary_date;

        return $this;
    }

    /**
     * Gets suggest_add_readjustment
     *
     * @return bool
     */
    public function getSuggestAddReadjustment()
    {
        return $this->container['suggest_add_readjustment'];
    }

    /**
     * Sets suggest_add_readjustment
     *
     * @param bool $suggest_add_readjustment suggest_add_readjustment
     *
     * @return $this
     */
    public function setSuggestAddReadjustment($suggest_add_readjustment)
    {
        $this->container['suggest_add_readjustment'] = $suggest_add_readjustment;

        return $this;
    }

    /**
     * Gets is_employment_info_ameldinger
     *
     * @return bool
     */
    public function getIsEmploymentInfoAmeldinger()
    {
        return $this->container['is_employment_info_ameldinger'];
    }

    /**
     * Sets is_employment_info_ameldinger
     *
     * @param bool $is_employment_info_ameldinger is_employment_info_ameldinger
     *
     * @return $this
     */
    public function setIsEmploymentInfoAmeldinger($is_employment_info_ameldinger)
    {
        $this->container['is_employment_info_ameldinger'] = $is_employment_info_ameldinger;

        return $this;
    }

    /**
     * Gets seamen_deduction
     *
     * @return bool
     */
    public function getSeamenDeduction()
    {
        return $this->container['seamen_deduction'];
    }

    /**
     * Sets seamen_deduction
     *
     * @param bool $seamen_deduction seamen_deduction
     *
     * @return $this
     */
    public function setSeamenDeduction($seamen_deduction)
    {
        $this->container['seamen_deduction'] = $seamen_deduction;

        return $this;
    }

    /**
     * Gets validation_results
     *
     * @return \Learnist\Tripletex\Model\SalaryV2PaymentValidationResult
     */
    public function getValidationResults()
    {
        return $this->container['validation_results'];
    }

    /**
     * Sets validation_results
     *
     * @param \Learnist\Tripletex\Model\SalaryV2PaymentValidationResult $validation_results validation_results
     *
     * @return $this
     */
    public function setValidationResults($validation_results)
    {
        $this->container['validation_results'] = $validation_results;

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
