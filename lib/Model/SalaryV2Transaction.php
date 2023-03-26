<?php
/**
 * SalaryV2Transaction
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
 * SalaryV2Transaction Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalaryV2Transaction implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalaryV2Transaction';

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
'display_name' => 'string',
'date' => 'string',
'year' => 'int',
'month' => 'int',
'period_as_string' => 'string',
'is_historical' => 'bool',
'payroll_tax_calc_method' => 'string',
'voucher_comment' => 'string',
'payslip_general_comment' => 'string',
'completed' => 'bool',
'reversed' => 'bool',
'reverser' => 'bool',
'pay_slips_available_date' => 'string',
'salary_payments' => '\Learnist\Tripletex\Model\SalaryV2Payment[]',
'payment_date' => 'string',
'not_deletable_message' => 'string',
'has_bank_transfers' => 'bool',
'voucher' => '\Learnist\Tripletex\Model\SalaryV2Voucher',
'allow_delete_payments' => 'bool',
'payroll_tax_basis_amount' => 'float',
'sum_paid_amount' => 'float',
'sum_total_vacation_allowance_amount' => 'float',
'sum_tax_deduction_amount' => 'float',
'sum_payroll_tax_amount' => 'float',
'any_external_changes_on_this_transaction' => 'bool',
'attachment' => '\Learnist\Tripletex\Model\Document',
'amelding_wage_id' => 'int',
'hourly_wage_code_ids' => 'int[]',
'contains_negative_wps' => 'bool',
'payment_type' => '\Learnist\Tripletex\Model\SalaryV2PaymentType'    ];

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
'display_name' => null,
'date' => null,
'year' => 'int32',
'month' => 'int32',
'period_as_string' => null,
'is_historical' => null,
'payroll_tax_calc_method' => null,
'voucher_comment' => null,
'payslip_general_comment' => null,
'completed' => null,
'reversed' => null,
'reverser' => null,
'pay_slips_available_date' => null,
'salary_payments' => null,
'payment_date' => null,
'not_deletable_message' => null,
'has_bank_transfers' => null,
'voucher' => null,
'allow_delete_payments' => null,
'payroll_tax_basis_amount' => null,
'sum_paid_amount' => null,
'sum_total_vacation_allowance_amount' => null,
'sum_tax_deduction_amount' => null,
'sum_payroll_tax_amount' => null,
'any_external_changes_on_this_transaction' => null,
'attachment' => null,
'amelding_wage_id' => 'int32',
'hourly_wage_code_ids' => 'int32',
'contains_negative_wps' => null,
'payment_type' => null    ];

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
'display_name' => 'displayName',
'date' => 'date',
'year' => 'year',
'month' => 'month',
'period_as_string' => 'periodAsString',
'is_historical' => 'isHistorical',
'payroll_tax_calc_method' => 'payrollTaxCalcMethod',
'voucher_comment' => 'voucherComment',
'payslip_general_comment' => 'payslipGeneralComment',
'completed' => 'completed',
'reversed' => 'reversed',
'reverser' => 'reverser',
'pay_slips_available_date' => 'paySlipsAvailableDate',
'salary_payments' => 'salaryPayments',
'payment_date' => 'paymentDate',
'not_deletable_message' => 'notDeletableMessage',
'has_bank_transfers' => 'hasBankTransfers',
'voucher' => 'voucher',
'allow_delete_payments' => 'allowDeletePayments',
'payroll_tax_basis_amount' => 'payrollTaxBasisAmount',
'sum_paid_amount' => 'sumPaidAmount',
'sum_total_vacation_allowance_amount' => 'sumTotalVacationAllowanceAmount',
'sum_tax_deduction_amount' => 'sumTaxDeductionAmount',
'sum_payroll_tax_amount' => 'sumPayrollTaxAmount',
'any_external_changes_on_this_transaction' => 'anyExternalChangesOnThisTransaction',
'attachment' => 'attachment',
'amelding_wage_id' => 'ameldingWageId',
'hourly_wage_code_ids' => 'hourlyWageCodeIds',
'contains_negative_wps' => 'containsNegativeWps',
'payment_type' => 'paymentType'    ];

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
'display_name' => 'setDisplayName',
'date' => 'setDate',
'year' => 'setYear',
'month' => 'setMonth',
'period_as_string' => 'setPeriodAsString',
'is_historical' => 'setIsHistorical',
'payroll_tax_calc_method' => 'setPayrollTaxCalcMethod',
'voucher_comment' => 'setVoucherComment',
'payslip_general_comment' => 'setPayslipGeneralComment',
'completed' => 'setCompleted',
'reversed' => 'setReversed',
'reverser' => 'setReverser',
'pay_slips_available_date' => 'setPaySlipsAvailableDate',
'salary_payments' => 'setSalaryPayments',
'payment_date' => 'setPaymentDate',
'not_deletable_message' => 'setNotDeletableMessage',
'has_bank_transfers' => 'setHasBankTransfers',
'voucher' => 'setVoucher',
'allow_delete_payments' => 'setAllowDeletePayments',
'payroll_tax_basis_amount' => 'setPayrollTaxBasisAmount',
'sum_paid_amount' => 'setSumPaidAmount',
'sum_total_vacation_allowance_amount' => 'setSumTotalVacationAllowanceAmount',
'sum_tax_deduction_amount' => 'setSumTaxDeductionAmount',
'sum_payroll_tax_amount' => 'setSumPayrollTaxAmount',
'any_external_changes_on_this_transaction' => 'setAnyExternalChangesOnThisTransaction',
'attachment' => 'setAttachment',
'amelding_wage_id' => 'setAmeldingWageId',
'hourly_wage_code_ids' => 'setHourlyWageCodeIds',
'contains_negative_wps' => 'setContainsNegativeWps',
'payment_type' => 'setPaymentType'    ];

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
'display_name' => 'getDisplayName',
'date' => 'getDate',
'year' => 'getYear',
'month' => 'getMonth',
'period_as_string' => 'getPeriodAsString',
'is_historical' => 'getIsHistorical',
'payroll_tax_calc_method' => 'getPayrollTaxCalcMethod',
'voucher_comment' => 'getVoucherComment',
'payslip_general_comment' => 'getPayslipGeneralComment',
'completed' => 'getCompleted',
'reversed' => 'getReversed',
'reverser' => 'getReverser',
'pay_slips_available_date' => 'getPaySlipsAvailableDate',
'salary_payments' => 'getSalaryPayments',
'payment_date' => 'getPaymentDate',
'not_deletable_message' => 'getNotDeletableMessage',
'has_bank_transfers' => 'getHasBankTransfers',
'voucher' => 'getVoucher',
'allow_delete_payments' => 'getAllowDeletePayments',
'payroll_tax_basis_amount' => 'getPayrollTaxBasisAmount',
'sum_paid_amount' => 'getSumPaidAmount',
'sum_total_vacation_allowance_amount' => 'getSumTotalVacationAllowanceAmount',
'sum_tax_deduction_amount' => 'getSumTaxDeductionAmount',
'sum_payroll_tax_amount' => 'getSumPayrollTaxAmount',
'any_external_changes_on_this_transaction' => 'getAnyExternalChangesOnThisTransaction',
'attachment' => 'getAttachment',
'amelding_wage_id' => 'getAmeldingWageId',
'hourly_wage_code_ids' => 'getHourlyWageCodeIds',
'contains_negative_wps' => 'getContainsNegativeWps',
'payment_type' => 'getPaymentType'    ];

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
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['year'] = isset($data['year']) ? $data['year'] : null;
        $this->container['month'] = isset($data['month']) ? $data['month'] : null;
        $this->container['period_as_string'] = isset($data['period_as_string']) ? $data['period_as_string'] : null;
        $this->container['is_historical'] = isset($data['is_historical']) ? $data['is_historical'] : null;
        $this->container['payroll_tax_calc_method'] = isset($data['payroll_tax_calc_method']) ? $data['payroll_tax_calc_method'] : null;
        $this->container['voucher_comment'] = isset($data['voucher_comment']) ? $data['voucher_comment'] : null;
        $this->container['payslip_general_comment'] = isset($data['payslip_general_comment']) ? $data['payslip_general_comment'] : null;
        $this->container['completed'] = isset($data['completed']) ? $data['completed'] : null;
        $this->container['reversed'] = isset($data['reversed']) ? $data['reversed'] : null;
        $this->container['reverser'] = isset($data['reverser']) ? $data['reverser'] : null;
        $this->container['pay_slips_available_date'] = isset($data['pay_slips_available_date']) ? $data['pay_slips_available_date'] : null;
        $this->container['salary_payments'] = isset($data['salary_payments']) ? $data['salary_payments'] : null;
        $this->container['payment_date'] = isset($data['payment_date']) ? $data['payment_date'] : null;
        $this->container['not_deletable_message'] = isset($data['not_deletable_message']) ? $data['not_deletable_message'] : null;
        $this->container['has_bank_transfers'] = isset($data['has_bank_transfers']) ? $data['has_bank_transfers'] : null;
        $this->container['voucher'] = isset($data['voucher']) ? $data['voucher'] : null;
        $this->container['allow_delete_payments'] = isset($data['allow_delete_payments']) ? $data['allow_delete_payments'] : null;
        $this->container['payroll_tax_basis_amount'] = isset($data['payroll_tax_basis_amount']) ? $data['payroll_tax_basis_amount'] : null;
        $this->container['sum_paid_amount'] = isset($data['sum_paid_amount']) ? $data['sum_paid_amount'] : null;
        $this->container['sum_total_vacation_allowance_amount'] = isset($data['sum_total_vacation_allowance_amount']) ? $data['sum_total_vacation_allowance_amount'] : null;
        $this->container['sum_tax_deduction_amount'] = isset($data['sum_tax_deduction_amount']) ? $data['sum_tax_deduction_amount'] : null;
        $this->container['sum_payroll_tax_amount'] = isset($data['sum_payroll_tax_amount']) ? $data['sum_payroll_tax_amount'] : null;
        $this->container['any_external_changes_on_this_transaction'] = isset($data['any_external_changes_on_this_transaction']) ? $data['any_external_changes_on_this_transaction'] : null;
        $this->container['attachment'] = isset($data['attachment']) ? $data['attachment'] : null;
        $this->container['amelding_wage_id'] = isset($data['amelding_wage_id']) ? $data['amelding_wage_id'] : null;
        $this->container['hourly_wage_code_ids'] = isset($data['hourly_wage_code_ids']) ? $data['hourly_wage_code_ids'] : null;
        $this->container['contains_negative_wps'] = isset($data['contains_negative_wps']) ? $data['contains_negative_wps'] : null;
        $this->container['payment_type'] = isset($data['payment_type']) ? $data['payment_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['year'] === null) {
            $invalidProperties[] = "'year' can't be null";
        }
        if ($this->container['month'] === null) {
            $invalidProperties[] = "'month' can't be null";
        }
        if ($this->container['salary_payments'] === null) {
            $invalidProperties[] = "'salary_payments' can't be null";
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
     * Gets period_as_string
     *
     * @return string
     */
    public function getPeriodAsString()
    {
        return $this->container['period_as_string'];
    }

    /**
     * Sets period_as_string
     *
     * @param string $period_as_string period_as_string
     *
     * @return $this
     */
    public function setPeriodAsString($period_as_string)
    {
        $this->container['period_as_string'] = $period_as_string;

        return $this;
    }

    /**
     * Gets is_historical
     *
     * @return bool
     */
    public function getIsHistorical()
    {
        return $this->container['is_historical'];
    }

    /**
     * Sets is_historical
     *
     * @param bool $is_historical With historical wage vouchers you can update the wage system with information dated before the opening balance.
     *
     * @return $this
     */
    public function setIsHistorical($is_historical)
    {
        $this->container['is_historical'] = $is_historical;

        return $this;
    }

    /**
     * Gets payroll_tax_calc_method
     *
     * @return string
     */
    public function getPayrollTaxCalcMethod()
    {
        return $this->container['payroll_tax_calc_method'];
    }

    /**
     * Sets payroll_tax_calc_method
     *
     * @param string $payroll_tax_calc_method Employee National Insurance calculation method
     *
     * @return $this
     */
    public function setPayrollTaxCalcMethod($payroll_tax_calc_method)
    {
        $this->container['payroll_tax_calc_method'] = $payroll_tax_calc_method;

        return $this;
    }

    /**
     * Gets voucher_comment
     *
     * @return string
     */
    public function getVoucherComment()
    {
        return $this->container['voucher_comment'];
    }

    /**
     * Sets voucher_comment
     *
     * @param string $voucher_comment Comment on voucher
     *
     * @return $this
     */
    public function setVoucherComment($voucher_comment)
    {
        $this->container['voucher_comment'] = $voucher_comment;

        return $this;
    }

    /**
     * Gets payslip_general_comment
     *
     * @return string
     */
    public function getPayslipGeneralComment()
    {
        return $this->container['payslip_general_comment'];
    }

    /**
     * Sets payslip_general_comment
     *
     * @param string $payslip_general_comment Comment to be shown on all payslips
     *
     * @return $this
     */
    public function setPayslipGeneralComment($payslip_general_comment)
    {
        $this->container['payslip_general_comment'] = $payslip_general_comment;

        return $this;
    }

    /**
     * Gets completed
     *
     * @return bool
     */
    public function getCompleted()
    {
        return $this->container['completed'];
    }

    /**
     * Sets completed
     *
     * @param bool $completed completed
     *
     * @return $this
     */
    public function setCompleted($completed)
    {
        $this->container['completed'] = $completed;

        return $this;
    }

    /**
     * Gets reversed
     *
     * @return bool
     */
    public function getReversed()
    {
        return $this->container['reversed'];
    }

    /**
     * Sets reversed
     *
     * @param bool $reversed reversed
     *
     * @return $this
     */
    public function setReversed($reversed)
    {
        $this->container['reversed'] = $reversed;

        return $this;
    }

    /**
     * Gets reverser
     *
     * @return bool
     */
    public function getReverser()
    {
        return $this->container['reverser'];
    }

    /**
     * Sets reverser
     *
     * @param bool $reverser reverser
     *
     * @return $this
     */
    public function setReverser($reverser)
    {
        $this->container['reverser'] = $reverser;

        return $this;
    }

    /**
     * Gets pay_slips_available_date
     *
     * @return string
     */
    public function getPaySlipsAvailableDate()
    {
        return $this->container['pay_slips_available_date'];
    }

    /**
     * Sets pay_slips_available_date
     *
     * @param string $pay_slips_available_date The date payslips are made available to the employee. Defaults to voucherDate.
     *
     * @return $this
     */
    public function setPaySlipsAvailableDate($pay_slips_available_date)
    {
        $this->container['pay_slips_available_date'] = $pay_slips_available_date;

        return $this;
    }

    /**
     * Gets salary_payments
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Payment[]
     */
    public function getSalaryPayments()
    {
        return $this->container['salary_payments'];
    }

    /**
     * Sets salary_payments
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Payment[] $salary_payments Link to individual payslip objects.
     *
     * @return $this
     */
    public function setSalaryPayments($salary_payments)
    {
        $this->container['salary_payments'] = $salary_payments;

        return $this;
    }

    /**
     * Gets payment_date
     *
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->container['payment_date'];
    }

    /**
     * Sets payment_date
     *
     * @param string $payment_date The date payslips are paid
     *
     * @return $this
     */
    public function setPaymentDate($payment_date)
    {
        $this->container['payment_date'] = $payment_date;

        return $this;
    }

    /**
     * Gets not_deletable_message
     *
     * @return string
     */
    public function getNotDeletableMessage()
    {
        return $this->container['not_deletable_message'];
    }

    /**
     * Sets not_deletable_message
     *
     * @param string $not_deletable_message not_deletable_message
     *
     * @return $this
     */
    public function setNotDeletableMessage($not_deletable_message)
    {
        $this->container['not_deletable_message'] = $not_deletable_message;

        return $this;
    }

    /**
     * Gets has_bank_transfers
     *
     * @return bool
     */
    public function getHasBankTransfers()
    {
        return $this->container['has_bank_transfers'];
    }

    /**
     * Sets has_bank_transfers
     *
     * @param bool $has_bank_transfers has_bank_transfers
     *
     * @return $this
     */
    public function setHasBankTransfers($has_bank_transfers)
    {
        $this->container['has_bank_transfers'] = $has_bank_transfers;

        return $this;
    }

    /**
     * Gets voucher
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Voucher
     */
    public function getVoucher()
    {
        return $this->container['voucher'];
    }

    /**
     * Sets voucher
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Voucher $voucher voucher
     *
     * @return $this
     */
    public function setVoucher($voucher)
    {
        $this->container['voucher'] = $voucher;

        return $this;
    }

    /**
     * Gets allow_delete_payments
     *
     * @return bool
     */
    public function getAllowDeletePayments()
    {
        return $this->container['allow_delete_payments'];
    }

    /**
     * Sets allow_delete_payments
     *
     * @param bool $allow_delete_payments True if bank payments are deletable
     *
     * @return $this
     */
    public function setAllowDeletePayments($allow_delete_payments)
    {
        $this->container['allow_delete_payments'] = $allow_delete_payments;

        return $this;
    }

    /**
     * Gets payroll_tax_basis_amount
     *
     * @return float
     */
    public function getPayrollTaxBasisAmount()
    {
        return $this->container['payroll_tax_basis_amount'];
    }

    /**
     * Sets payroll_tax_basis_amount
     *
     * @param float $payroll_tax_basis_amount payroll_tax_basis_amount
     *
     * @return $this
     */
    public function setPayrollTaxBasisAmount($payroll_tax_basis_amount)
    {
        $this->container['payroll_tax_basis_amount'] = $payroll_tax_basis_amount;

        return $this;
    }

    /**
     * Gets sum_paid_amount
     *
     * @return float
     */
    public function getSumPaidAmount()
    {
        return $this->container['sum_paid_amount'];
    }

    /**
     * Sets sum_paid_amount
     *
     * @param float $sum_paid_amount sum_paid_amount
     *
     * @return $this
     */
    public function setSumPaidAmount($sum_paid_amount)
    {
        $this->container['sum_paid_amount'] = $sum_paid_amount;

        return $this;
    }

    /**
     * Gets sum_total_vacation_allowance_amount
     *
     * @return float
     */
    public function getSumTotalVacationAllowanceAmount()
    {
        return $this->container['sum_total_vacation_allowance_amount'];
    }

    /**
     * Sets sum_total_vacation_allowance_amount
     *
     * @param float $sum_total_vacation_allowance_amount sum_total_vacation_allowance_amount
     *
     * @return $this
     */
    public function setSumTotalVacationAllowanceAmount($sum_total_vacation_allowance_amount)
    {
        $this->container['sum_total_vacation_allowance_amount'] = $sum_total_vacation_allowance_amount;

        return $this;
    }

    /**
     * Gets sum_tax_deduction_amount
     *
     * @return float
     */
    public function getSumTaxDeductionAmount()
    {
        return $this->container['sum_tax_deduction_amount'];
    }

    /**
     * Sets sum_tax_deduction_amount
     *
     * @param float $sum_tax_deduction_amount sum_tax_deduction_amount
     *
     * @return $this
     */
    public function setSumTaxDeductionAmount($sum_tax_deduction_amount)
    {
        $this->container['sum_tax_deduction_amount'] = $sum_tax_deduction_amount;

        return $this;
    }

    /**
     * Gets sum_payroll_tax_amount
     *
     * @return float
     */
    public function getSumPayrollTaxAmount()
    {
        return $this->container['sum_payroll_tax_amount'];
    }

    /**
     * Sets sum_payroll_tax_amount
     *
     * @param float $sum_payroll_tax_amount sum_payroll_tax_amount
     *
     * @return $this
     */
    public function setSumPayrollTaxAmount($sum_payroll_tax_amount)
    {
        $this->container['sum_payroll_tax_amount'] = $sum_payroll_tax_amount;

        return $this;
    }

    /**
     * Gets any_external_changes_on_this_transaction
     *
     * @return bool
     */
    public function getAnyExternalChangesOnThisTransaction()
    {
        return $this->container['any_external_changes_on_this_transaction'];
    }

    /**
     * Sets any_external_changes_on_this_transaction
     *
     * @param bool $any_external_changes_on_this_transaction any_external_changes_on_this_transaction
     *
     * @return $this
     */
    public function setAnyExternalChangesOnThisTransaction($any_external_changes_on_this_transaction)
    {
        $this->container['any_external_changes_on_this_transaction'] = $any_external_changes_on_this_transaction;

        return $this;
    }

    /**
     * Gets attachment
     *
     * @return \Learnist\Tripletex\Model\Document
     */
    public function getAttachment()
    {
        return $this->container['attachment'];
    }

    /**
     * Sets attachment
     *
     * @param \Learnist\Tripletex\Model\Document $attachment attachment
     *
     * @return $this
     */
    public function setAttachment($attachment)
    {
        $this->container['attachment'] = $attachment;

        return $this;
    }

    /**
     * Gets amelding_wage_id
     *
     * @return int
     */
    public function getAmeldingWageId()
    {
        return $this->container['amelding_wage_id'];
    }

    /**
     * Sets amelding_wage_id
     *
     * @param int $amelding_wage_id amelding_wage_id
     *
     * @return $this
     */
    public function setAmeldingWageId($amelding_wage_id)
    {
        $this->container['amelding_wage_id'] = $amelding_wage_id;

        return $this;
    }

    /**
     * Gets hourly_wage_code_ids
     *
     * @return int[]
     */
    public function getHourlyWageCodeIds()
    {
        return $this->container['hourly_wage_code_ids'];
    }

    /**
     * Sets hourly_wage_code_ids
     *
     * @param int[] $hourly_wage_code_ids List of wage code ids that are hourly wage code
     *
     * @return $this
     */
    public function setHourlyWageCodeIds($hourly_wage_code_ids)
    {
        $this->container['hourly_wage_code_ids'] = $hourly_wage_code_ids;

        return $this;
    }

    /**
     * Gets contains_negative_wps
     *
     * @return bool
     */
    public function getContainsNegativeWps()
    {
        return $this->container['contains_negative_wps'];
    }

    /**
     * Sets contains_negative_wps
     *
     * @param bool $contains_negative_wps contains_negative_wps
     *
     * @return $this
     */
    public function setContainsNegativeWps($contains_negative_wps)
    {
        $this->container['contains_negative_wps'] = $contains_negative_wps;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return \Learnist\Tripletex\Model\SalaryV2PaymentType
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param \Learnist\Tripletex\Model\SalaryV2PaymentType $payment_type payment_type
     *
     * @return $this
     */
    public function setPaymentType($payment_type)
    {
        $this->container['payment_type'] = $payment_type;

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
