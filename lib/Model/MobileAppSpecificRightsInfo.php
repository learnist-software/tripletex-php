<?php
/**
 * MobileAppSpecificRightsInfo
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
 * MobileAppSpecificRightsInfo Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MobileAppSpecificRightsInfo implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MobileAppSpecificRightsInfo';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'hour_registration_enabled' => 'bool',
        'project_enabled' => 'bool',
        'department_enabled' => 'bool',
        'user_is_allowed_to_register_hours' => 'bool',
        'payroll_accounting_enabled' => 'bool',
        'user_is_auth_wage_menu' => 'bool',
        'user_is_auth_my_salary' => 'bool',
        'electronic_vouchers_enabled' => 'bool',
        'travel_expense_enabled' => 'bool',
        'document_archive_enabled' => 'bool',
        'archive_reception_enabled' => 'bool',
        'user_is_payslip_only' => 'bool',
        'travel_expense_rates_enabled' => 'bool',
        'tax_free_mileage_rates_enabled' => 'bool',
        'approve_travel_expense_enabled' => 'bool',
        'user_is_auth_project_info' => 'bool',
        'user_is_auth_travel_and_expense_approve' => 'bool',
        'user_is_auth_employee_info' => 'bool',
        'user_is_auth_voucher_approve' => 'bool',
        'user_is_auth_remit_approve' => 'bool',
        'user_is_auth_invoicing' => 'bool',
        'user_is_auth_create_order' => 'bool',
        'vat_on_for_company' => 'bool',
        'tax_free_diet_rates_enabled' => 'bool',
        'travel_diet_ignore_posting_enabled' => 'bool',
        'employee_enabled' => 'bool',
        'hour_balance_enabled_for_employee' => 'bool',
        'vacation_balance_enabled_for_employee' => 'bool',
        'user_is_auth_create_customer' => 'bool',
        'user_is_auth_project_menu' => 'bool',
        'user_is_auth_company_accounting_reports' => 'bool',
        'vvselectro_enabled' => 'bool',
        'customer_enabled' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'hour_registration_enabled' => null,
        'project_enabled' => null,
        'department_enabled' => null,
        'user_is_allowed_to_register_hours' => null,
        'payroll_accounting_enabled' => null,
        'user_is_auth_wage_menu' => null,
        'user_is_auth_my_salary' => null,
        'electronic_vouchers_enabled' => null,
        'travel_expense_enabled' => null,
        'document_archive_enabled' => null,
        'archive_reception_enabled' => null,
        'user_is_payslip_only' => null,
        'travel_expense_rates_enabled' => null,
        'tax_free_mileage_rates_enabled' => null,
        'approve_travel_expense_enabled' => null,
        'user_is_auth_project_info' => null,
        'user_is_auth_travel_and_expense_approve' => null,
        'user_is_auth_employee_info' => null,
        'user_is_auth_voucher_approve' => null,
        'user_is_auth_remit_approve' => null,
        'user_is_auth_invoicing' => null,
        'user_is_auth_create_order' => null,
        'vat_on_for_company' => null,
        'tax_free_diet_rates_enabled' => null,
        'travel_diet_ignore_posting_enabled' => null,
        'employee_enabled' => null,
        'hour_balance_enabled_for_employee' => null,
        'vacation_balance_enabled_for_employee' => null,
        'user_is_auth_create_customer' => null,
        'user_is_auth_project_menu' => null,
        'user_is_auth_company_accounting_reports' => null,
        'vvselectro_enabled' => null,
        'customer_enabled' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'hour_registration_enabled' => false,
		'project_enabled' => false,
		'department_enabled' => false,
		'user_is_allowed_to_register_hours' => false,
		'payroll_accounting_enabled' => false,
		'user_is_auth_wage_menu' => false,
		'user_is_auth_my_salary' => false,
		'electronic_vouchers_enabled' => false,
		'travel_expense_enabled' => false,
		'document_archive_enabled' => false,
		'archive_reception_enabled' => false,
		'user_is_payslip_only' => false,
		'travel_expense_rates_enabled' => false,
		'tax_free_mileage_rates_enabled' => false,
		'approve_travel_expense_enabled' => false,
		'user_is_auth_project_info' => false,
		'user_is_auth_travel_and_expense_approve' => false,
		'user_is_auth_employee_info' => false,
		'user_is_auth_voucher_approve' => false,
		'user_is_auth_remit_approve' => false,
		'user_is_auth_invoicing' => false,
		'user_is_auth_create_order' => false,
		'vat_on_for_company' => false,
		'tax_free_diet_rates_enabled' => false,
		'travel_diet_ignore_posting_enabled' => false,
		'employee_enabled' => false,
		'hour_balance_enabled_for_employee' => false,
		'vacation_balance_enabled_for_employee' => false,
		'user_is_auth_create_customer' => false,
		'user_is_auth_project_menu' => false,
		'user_is_auth_company_accounting_reports' => false,
		'vvselectro_enabled' => false,
		'customer_enabled' => false
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
        'hour_registration_enabled' => 'hourRegistrationEnabled',
        'project_enabled' => 'projectEnabled',
        'department_enabled' => 'departmentEnabled',
        'user_is_allowed_to_register_hours' => 'userIsAllowedToRegisterHours',
        'payroll_accounting_enabled' => 'payrollAccountingEnabled',
        'user_is_auth_wage_menu' => 'userIsAuthWageMenu',
        'user_is_auth_my_salary' => 'userIsAuthMySalary',
        'electronic_vouchers_enabled' => 'electronicVouchersEnabled',
        'travel_expense_enabled' => 'travelExpenseEnabled',
        'document_archive_enabled' => 'documentArchiveEnabled',
        'archive_reception_enabled' => 'archiveReceptionEnabled',
        'user_is_payslip_only' => 'userIsPayslipOnly',
        'travel_expense_rates_enabled' => 'travelExpenseRatesEnabled',
        'tax_free_mileage_rates_enabled' => 'taxFreeMileageRatesEnabled',
        'approve_travel_expense_enabled' => 'approveTravelExpenseEnabled',
        'user_is_auth_project_info' => 'userIsAuthProjectInfo',
        'user_is_auth_travel_and_expense_approve' => 'userIsAuthTravelAndExpenseApprove',
        'user_is_auth_employee_info' => 'userIsAuthEmployeeInfo',
        'user_is_auth_voucher_approve' => 'userIsAuthVoucherApprove',
        'user_is_auth_remit_approve' => 'userIsAuthRemitApprove',
        'user_is_auth_invoicing' => 'userIsAuthInvoicing',
        'user_is_auth_create_order' => 'userIsAuthCreateOrder',
        'vat_on_for_company' => 'vatOnForCompany',
        'tax_free_diet_rates_enabled' => 'taxFreeDietRatesEnabled',
        'travel_diet_ignore_posting_enabled' => 'travelDietIgnorePostingEnabled',
        'employee_enabled' => 'employeeEnabled',
        'hour_balance_enabled_for_employee' => 'hourBalanceEnabledForEmployee',
        'vacation_balance_enabled_for_employee' => 'vacationBalanceEnabledForEmployee',
        'user_is_auth_create_customer' => 'userIsAuthCreateCustomer',
        'user_is_auth_project_menu' => 'userIsAuthProjectMenu',
        'user_is_auth_company_accounting_reports' => 'userIsAuthCompanyAccountingReports',
        'vvselectro_enabled' => 'vvselectroEnabled',
        'customer_enabled' => 'customerEnabled'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'hour_registration_enabled' => 'setHourRegistrationEnabled',
        'project_enabled' => 'setProjectEnabled',
        'department_enabled' => 'setDepartmentEnabled',
        'user_is_allowed_to_register_hours' => 'setUserIsAllowedToRegisterHours',
        'payroll_accounting_enabled' => 'setPayrollAccountingEnabled',
        'user_is_auth_wage_menu' => 'setUserIsAuthWageMenu',
        'user_is_auth_my_salary' => 'setUserIsAuthMySalary',
        'electronic_vouchers_enabled' => 'setElectronicVouchersEnabled',
        'travel_expense_enabled' => 'setTravelExpenseEnabled',
        'document_archive_enabled' => 'setDocumentArchiveEnabled',
        'archive_reception_enabled' => 'setArchiveReceptionEnabled',
        'user_is_payslip_only' => 'setUserIsPayslipOnly',
        'travel_expense_rates_enabled' => 'setTravelExpenseRatesEnabled',
        'tax_free_mileage_rates_enabled' => 'setTaxFreeMileageRatesEnabled',
        'approve_travel_expense_enabled' => 'setApproveTravelExpenseEnabled',
        'user_is_auth_project_info' => 'setUserIsAuthProjectInfo',
        'user_is_auth_travel_and_expense_approve' => 'setUserIsAuthTravelAndExpenseApprove',
        'user_is_auth_employee_info' => 'setUserIsAuthEmployeeInfo',
        'user_is_auth_voucher_approve' => 'setUserIsAuthVoucherApprove',
        'user_is_auth_remit_approve' => 'setUserIsAuthRemitApprove',
        'user_is_auth_invoicing' => 'setUserIsAuthInvoicing',
        'user_is_auth_create_order' => 'setUserIsAuthCreateOrder',
        'vat_on_for_company' => 'setVatOnForCompany',
        'tax_free_diet_rates_enabled' => 'setTaxFreeDietRatesEnabled',
        'travel_diet_ignore_posting_enabled' => 'setTravelDietIgnorePostingEnabled',
        'employee_enabled' => 'setEmployeeEnabled',
        'hour_balance_enabled_for_employee' => 'setHourBalanceEnabledForEmployee',
        'vacation_balance_enabled_for_employee' => 'setVacationBalanceEnabledForEmployee',
        'user_is_auth_create_customer' => 'setUserIsAuthCreateCustomer',
        'user_is_auth_project_menu' => 'setUserIsAuthProjectMenu',
        'user_is_auth_company_accounting_reports' => 'setUserIsAuthCompanyAccountingReports',
        'vvselectro_enabled' => 'setVvselectroEnabled',
        'customer_enabled' => 'setCustomerEnabled'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'hour_registration_enabled' => 'getHourRegistrationEnabled',
        'project_enabled' => 'getProjectEnabled',
        'department_enabled' => 'getDepartmentEnabled',
        'user_is_allowed_to_register_hours' => 'getUserIsAllowedToRegisterHours',
        'payroll_accounting_enabled' => 'getPayrollAccountingEnabled',
        'user_is_auth_wage_menu' => 'getUserIsAuthWageMenu',
        'user_is_auth_my_salary' => 'getUserIsAuthMySalary',
        'electronic_vouchers_enabled' => 'getElectronicVouchersEnabled',
        'travel_expense_enabled' => 'getTravelExpenseEnabled',
        'document_archive_enabled' => 'getDocumentArchiveEnabled',
        'archive_reception_enabled' => 'getArchiveReceptionEnabled',
        'user_is_payslip_only' => 'getUserIsPayslipOnly',
        'travel_expense_rates_enabled' => 'getTravelExpenseRatesEnabled',
        'tax_free_mileage_rates_enabled' => 'getTaxFreeMileageRatesEnabled',
        'approve_travel_expense_enabled' => 'getApproveTravelExpenseEnabled',
        'user_is_auth_project_info' => 'getUserIsAuthProjectInfo',
        'user_is_auth_travel_and_expense_approve' => 'getUserIsAuthTravelAndExpenseApprove',
        'user_is_auth_employee_info' => 'getUserIsAuthEmployeeInfo',
        'user_is_auth_voucher_approve' => 'getUserIsAuthVoucherApprove',
        'user_is_auth_remit_approve' => 'getUserIsAuthRemitApprove',
        'user_is_auth_invoicing' => 'getUserIsAuthInvoicing',
        'user_is_auth_create_order' => 'getUserIsAuthCreateOrder',
        'vat_on_for_company' => 'getVatOnForCompany',
        'tax_free_diet_rates_enabled' => 'getTaxFreeDietRatesEnabled',
        'travel_diet_ignore_posting_enabled' => 'getTravelDietIgnorePostingEnabled',
        'employee_enabled' => 'getEmployeeEnabled',
        'hour_balance_enabled_for_employee' => 'getHourBalanceEnabledForEmployee',
        'vacation_balance_enabled_for_employee' => 'getVacationBalanceEnabledForEmployee',
        'user_is_auth_create_customer' => 'getUserIsAuthCreateCustomer',
        'user_is_auth_project_menu' => 'getUserIsAuthProjectMenu',
        'user_is_auth_company_accounting_reports' => 'getUserIsAuthCompanyAccountingReports',
        'vvselectro_enabled' => 'getVvselectroEnabled',
        'customer_enabled' => 'getCustomerEnabled'
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
        $this->setIfExists('hour_registration_enabled', $data ?? [], null);
        $this->setIfExists('project_enabled', $data ?? [], null);
        $this->setIfExists('department_enabled', $data ?? [], null);
        $this->setIfExists('user_is_allowed_to_register_hours', $data ?? [], null);
        $this->setIfExists('payroll_accounting_enabled', $data ?? [], null);
        $this->setIfExists('user_is_auth_wage_menu', $data ?? [], null);
        $this->setIfExists('user_is_auth_my_salary', $data ?? [], null);
        $this->setIfExists('electronic_vouchers_enabled', $data ?? [], null);
        $this->setIfExists('travel_expense_enabled', $data ?? [], null);
        $this->setIfExists('document_archive_enabled', $data ?? [], null);
        $this->setIfExists('archive_reception_enabled', $data ?? [], null);
        $this->setIfExists('user_is_payslip_only', $data ?? [], null);
        $this->setIfExists('travel_expense_rates_enabled', $data ?? [], null);
        $this->setIfExists('tax_free_mileage_rates_enabled', $data ?? [], null);
        $this->setIfExists('approve_travel_expense_enabled', $data ?? [], null);
        $this->setIfExists('user_is_auth_project_info', $data ?? [], null);
        $this->setIfExists('user_is_auth_travel_and_expense_approve', $data ?? [], null);
        $this->setIfExists('user_is_auth_employee_info', $data ?? [], null);
        $this->setIfExists('user_is_auth_voucher_approve', $data ?? [], null);
        $this->setIfExists('user_is_auth_remit_approve', $data ?? [], null);
        $this->setIfExists('user_is_auth_invoicing', $data ?? [], null);
        $this->setIfExists('user_is_auth_create_order', $data ?? [], null);
        $this->setIfExists('vat_on_for_company', $data ?? [], null);
        $this->setIfExists('tax_free_diet_rates_enabled', $data ?? [], null);
        $this->setIfExists('travel_diet_ignore_posting_enabled', $data ?? [], null);
        $this->setIfExists('employee_enabled', $data ?? [], null);
        $this->setIfExists('hour_balance_enabled_for_employee', $data ?? [], null);
        $this->setIfExists('vacation_balance_enabled_for_employee', $data ?? [], null);
        $this->setIfExists('user_is_auth_create_customer', $data ?? [], null);
        $this->setIfExists('user_is_auth_project_menu', $data ?? [], null);
        $this->setIfExists('user_is_auth_company_accounting_reports', $data ?? [], null);
        $this->setIfExists('vvselectro_enabled', $data ?? [], null);
        $this->setIfExists('customer_enabled', $data ?? [], null);
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
     * Gets hour_registration_enabled
     *
     * @return bool|null
     */
    public function getHourRegistrationEnabled()
    {
        return $this->container['hour_registration_enabled'];
    }

    /**
     * Sets hour_registration_enabled
     *
     * @param bool|null $hour_registration_enabled hour_registration_enabled
     *
     * @return self
     */
    public function setHourRegistrationEnabled($hour_registration_enabled)
    {

        if (is_null($hour_registration_enabled)) {
            throw new \InvalidArgumentException('non-nullable hour_registration_enabled cannot be null');
        }

        $this->container['hour_registration_enabled'] = $hour_registration_enabled;

        return $this;
    }

    /**
     * Gets project_enabled
     *
     * @return bool|null
     */
    public function getProjectEnabled()
    {
        return $this->container['project_enabled'];
    }

    /**
     * Sets project_enabled
     *
     * @param bool|null $project_enabled project_enabled
     *
     * @return self
     */
    public function setProjectEnabled($project_enabled)
    {

        if (is_null($project_enabled)) {
            throw new \InvalidArgumentException('non-nullable project_enabled cannot be null');
        }

        $this->container['project_enabled'] = $project_enabled;

        return $this;
    }

    /**
     * Gets department_enabled
     *
     * @return bool|null
     */
    public function getDepartmentEnabled()
    {
        return $this->container['department_enabled'];
    }

    /**
     * Sets department_enabled
     *
     * @param bool|null $department_enabled department_enabled
     *
     * @return self
     */
    public function setDepartmentEnabled($department_enabled)
    {

        if (is_null($department_enabled)) {
            throw new \InvalidArgumentException('non-nullable department_enabled cannot be null');
        }

        $this->container['department_enabled'] = $department_enabled;

        return $this;
    }

    /**
     * Gets user_is_allowed_to_register_hours
     *
     * @return bool|null
     */
    public function getUserIsAllowedToRegisterHours()
    {
        return $this->container['user_is_allowed_to_register_hours'];
    }

    /**
     * Sets user_is_allowed_to_register_hours
     *
     * @param bool|null $user_is_allowed_to_register_hours user_is_allowed_to_register_hours
     *
     * @return self
     */
    public function setUserIsAllowedToRegisterHours($user_is_allowed_to_register_hours)
    {

        if (is_null($user_is_allowed_to_register_hours)) {
            throw new \InvalidArgumentException('non-nullable user_is_allowed_to_register_hours cannot be null');
        }

        $this->container['user_is_allowed_to_register_hours'] = $user_is_allowed_to_register_hours;

        return $this;
    }

    /**
     * Gets payroll_accounting_enabled
     *
     * @return bool|null
     */
    public function getPayrollAccountingEnabled()
    {
        return $this->container['payroll_accounting_enabled'];
    }

    /**
     * Sets payroll_accounting_enabled
     *
     * @param bool|null $payroll_accounting_enabled payroll_accounting_enabled
     *
     * @return self
     */
    public function setPayrollAccountingEnabled($payroll_accounting_enabled)
    {

        if (is_null($payroll_accounting_enabled)) {
            throw new \InvalidArgumentException('non-nullable payroll_accounting_enabled cannot be null');
        }

        $this->container['payroll_accounting_enabled'] = $payroll_accounting_enabled;

        return $this;
    }

    /**
     * Gets user_is_auth_wage_menu
     *
     * @return bool|null
     */
    public function getUserIsAuthWageMenu()
    {
        return $this->container['user_is_auth_wage_menu'];
    }

    /**
     * Sets user_is_auth_wage_menu
     *
     * @param bool|null $user_is_auth_wage_menu user_is_auth_wage_menu
     *
     * @return self
     */
    public function setUserIsAuthWageMenu($user_is_auth_wage_menu)
    {

        if (is_null($user_is_auth_wage_menu)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_wage_menu cannot be null');
        }

        $this->container['user_is_auth_wage_menu'] = $user_is_auth_wage_menu;

        return $this;
    }

    /**
     * Gets user_is_auth_my_salary
     *
     * @return bool|null
     */
    public function getUserIsAuthMySalary()
    {
        return $this->container['user_is_auth_my_salary'];
    }

    /**
     * Sets user_is_auth_my_salary
     *
     * @param bool|null $user_is_auth_my_salary user_is_auth_my_salary
     *
     * @return self
     */
    public function setUserIsAuthMySalary($user_is_auth_my_salary)
    {

        if (is_null($user_is_auth_my_salary)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_my_salary cannot be null');
        }

        $this->container['user_is_auth_my_salary'] = $user_is_auth_my_salary;

        return $this;
    }

    /**
     * Gets electronic_vouchers_enabled
     *
     * @return bool|null
     */
    public function getElectronicVouchersEnabled()
    {
        return $this->container['electronic_vouchers_enabled'];
    }

    /**
     * Sets electronic_vouchers_enabled
     *
     * @param bool|null $electronic_vouchers_enabled electronic_vouchers_enabled
     *
     * @return self
     */
    public function setElectronicVouchersEnabled($electronic_vouchers_enabled)
    {

        if (is_null($electronic_vouchers_enabled)) {
            throw new \InvalidArgumentException('non-nullable electronic_vouchers_enabled cannot be null');
        }

        $this->container['electronic_vouchers_enabled'] = $electronic_vouchers_enabled;

        return $this;
    }

    /**
     * Gets travel_expense_enabled
     *
     * @return bool|null
     */
    public function getTravelExpenseEnabled()
    {
        return $this->container['travel_expense_enabled'];
    }

    /**
     * Sets travel_expense_enabled
     *
     * @param bool|null $travel_expense_enabled travel_expense_enabled
     *
     * @return self
     */
    public function setTravelExpenseEnabled($travel_expense_enabled)
    {

        if (is_null($travel_expense_enabled)) {
            throw new \InvalidArgumentException('non-nullable travel_expense_enabled cannot be null');
        }

        $this->container['travel_expense_enabled'] = $travel_expense_enabled;

        return $this;
    }

    /**
     * Gets document_archive_enabled
     *
     * @return bool|null
     */
    public function getDocumentArchiveEnabled()
    {
        return $this->container['document_archive_enabled'];
    }

    /**
     * Sets document_archive_enabled
     *
     * @param bool|null $document_archive_enabled document_archive_enabled
     *
     * @return self
     */
    public function setDocumentArchiveEnabled($document_archive_enabled)
    {

        if (is_null($document_archive_enabled)) {
            throw new \InvalidArgumentException('non-nullable document_archive_enabled cannot be null');
        }

        $this->container['document_archive_enabled'] = $document_archive_enabled;

        return $this;
    }

    /**
     * Gets archive_reception_enabled
     *
     * @return bool|null
     */
    public function getArchiveReceptionEnabled()
    {
        return $this->container['archive_reception_enabled'];
    }

    /**
     * Sets archive_reception_enabled
     *
     * @param bool|null $archive_reception_enabled archive_reception_enabled
     *
     * @return self
     */
    public function setArchiveReceptionEnabled($archive_reception_enabled)
    {

        if (is_null($archive_reception_enabled)) {
            throw new \InvalidArgumentException('non-nullable archive_reception_enabled cannot be null');
        }

        $this->container['archive_reception_enabled'] = $archive_reception_enabled;

        return $this;
    }

    /**
     * Gets user_is_payslip_only
     *
     * @return bool|null
     */
    public function getUserIsPayslipOnly()
    {
        return $this->container['user_is_payslip_only'];
    }

    /**
     * Sets user_is_payslip_only
     *
     * @param bool|null $user_is_payslip_only user_is_payslip_only
     *
     * @return self
     */
    public function setUserIsPayslipOnly($user_is_payslip_only)
    {

        if (is_null($user_is_payslip_only)) {
            throw new \InvalidArgumentException('non-nullable user_is_payslip_only cannot be null');
        }

        $this->container['user_is_payslip_only'] = $user_is_payslip_only;

        return $this;
    }

    /**
     * Gets travel_expense_rates_enabled
     *
     * @return bool|null
     */
    public function getTravelExpenseRatesEnabled()
    {
        return $this->container['travel_expense_rates_enabled'];
    }

    /**
     * Sets travel_expense_rates_enabled
     *
     * @param bool|null $travel_expense_rates_enabled travel_expense_rates_enabled
     *
     * @return self
     */
    public function setTravelExpenseRatesEnabled($travel_expense_rates_enabled)
    {

        if (is_null($travel_expense_rates_enabled)) {
            throw new \InvalidArgumentException('non-nullable travel_expense_rates_enabled cannot be null');
        }

        $this->container['travel_expense_rates_enabled'] = $travel_expense_rates_enabled;

        return $this;
    }

    /**
     * Gets tax_free_mileage_rates_enabled
     *
     * @return bool|null
     */
    public function getTaxFreeMileageRatesEnabled()
    {
        return $this->container['tax_free_mileage_rates_enabled'];
    }

    /**
     * Sets tax_free_mileage_rates_enabled
     *
     * @param bool|null $tax_free_mileage_rates_enabled tax_free_mileage_rates_enabled
     *
     * @return self
     */
    public function setTaxFreeMileageRatesEnabled($tax_free_mileage_rates_enabled)
    {

        if (is_null($tax_free_mileage_rates_enabled)) {
            throw new \InvalidArgumentException('non-nullable tax_free_mileage_rates_enabled cannot be null');
        }

        $this->container['tax_free_mileage_rates_enabled'] = $tax_free_mileage_rates_enabled;

        return $this;
    }

    /**
     * Gets approve_travel_expense_enabled
     *
     * @return bool|null
     */
    public function getApproveTravelExpenseEnabled()
    {
        return $this->container['approve_travel_expense_enabled'];
    }

    /**
     * Sets approve_travel_expense_enabled
     *
     * @param bool|null $approve_travel_expense_enabled approve_travel_expense_enabled
     *
     * @return self
     */
    public function setApproveTravelExpenseEnabled($approve_travel_expense_enabled)
    {

        if (is_null($approve_travel_expense_enabled)) {
            throw new \InvalidArgumentException('non-nullable approve_travel_expense_enabled cannot be null');
        }

        $this->container['approve_travel_expense_enabled'] = $approve_travel_expense_enabled;

        return $this;
    }

    /**
     * Gets user_is_auth_project_info
     *
     * @return bool|null
     */
    public function getUserIsAuthProjectInfo()
    {
        return $this->container['user_is_auth_project_info'];
    }

    /**
     * Sets user_is_auth_project_info
     *
     * @param bool|null $user_is_auth_project_info user_is_auth_project_info
     *
     * @return self
     */
    public function setUserIsAuthProjectInfo($user_is_auth_project_info)
    {

        if (is_null($user_is_auth_project_info)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_project_info cannot be null');
        }

        $this->container['user_is_auth_project_info'] = $user_is_auth_project_info;

        return $this;
    }

    /**
     * Gets user_is_auth_travel_and_expense_approve
     *
     * @return bool|null
     */
    public function getUserIsAuthTravelAndExpenseApprove()
    {
        return $this->container['user_is_auth_travel_and_expense_approve'];
    }

    /**
     * Sets user_is_auth_travel_and_expense_approve
     *
     * @param bool|null $user_is_auth_travel_and_expense_approve user_is_auth_travel_and_expense_approve
     *
     * @return self
     */
    public function setUserIsAuthTravelAndExpenseApprove($user_is_auth_travel_and_expense_approve)
    {

        if (is_null($user_is_auth_travel_and_expense_approve)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_travel_and_expense_approve cannot be null');
        }

        $this->container['user_is_auth_travel_and_expense_approve'] = $user_is_auth_travel_and_expense_approve;

        return $this;
    }

    /**
     * Gets user_is_auth_employee_info
     *
     * @return bool|null
     */
    public function getUserIsAuthEmployeeInfo()
    {
        return $this->container['user_is_auth_employee_info'];
    }

    /**
     * Sets user_is_auth_employee_info
     *
     * @param bool|null $user_is_auth_employee_info user_is_auth_employee_info
     *
     * @return self
     */
    public function setUserIsAuthEmployeeInfo($user_is_auth_employee_info)
    {

        if (is_null($user_is_auth_employee_info)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_employee_info cannot be null');
        }

        $this->container['user_is_auth_employee_info'] = $user_is_auth_employee_info;

        return $this;
    }

    /**
     * Gets user_is_auth_voucher_approve
     *
     * @return bool|null
     */
    public function getUserIsAuthVoucherApprove()
    {
        return $this->container['user_is_auth_voucher_approve'];
    }

    /**
     * Sets user_is_auth_voucher_approve
     *
     * @param bool|null $user_is_auth_voucher_approve user_is_auth_voucher_approve
     *
     * @return self
     */
    public function setUserIsAuthVoucherApprove($user_is_auth_voucher_approve)
    {

        if (is_null($user_is_auth_voucher_approve)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_voucher_approve cannot be null');
        }

        $this->container['user_is_auth_voucher_approve'] = $user_is_auth_voucher_approve;

        return $this;
    }

    /**
     * Gets user_is_auth_remit_approve
     *
     * @return bool|null
     */
    public function getUserIsAuthRemitApprove()
    {
        return $this->container['user_is_auth_remit_approve'];
    }

    /**
     * Sets user_is_auth_remit_approve
     *
     * @param bool|null $user_is_auth_remit_approve user_is_auth_remit_approve
     *
     * @return self
     */
    public function setUserIsAuthRemitApprove($user_is_auth_remit_approve)
    {

        if (is_null($user_is_auth_remit_approve)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_remit_approve cannot be null');
        }

        $this->container['user_is_auth_remit_approve'] = $user_is_auth_remit_approve;

        return $this;
    }

    /**
     * Gets user_is_auth_invoicing
     *
     * @return bool|null
     */
    public function getUserIsAuthInvoicing()
    {
        return $this->container['user_is_auth_invoicing'];
    }

    /**
     * Sets user_is_auth_invoicing
     *
     * @param bool|null $user_is_auth_invoicing user_is_auth_invoicing
     *
     * @return self
     */
    public function setUserIsAuthInvoicing($user_is_auth_invoicing)
    {

        if (is_null($user_is_auth_invoicing)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_invoicing cannot be null');
        }

        $this->container['user_is_auth_invoicing'] = $user_is_auth_invoicing;

        return $this;
    }

    /**
     * Gets user_is_auth_create_order
     *
     * @return bool|null
     */
    public function getUserIsAuthCreateOrder()
    {
        return $this->container['user_is_auth_create_order'];
    }

    /**
     * Sets user_is_auth_create_order
     *
     * @param bool|null $user_is_auth_create_order user_is_auth_create_order
     *
     * @return self
     */
    public function setUserIsAuthCreateOrder($user_is_auth_create_order)
    {

        if (is_null($user_is_auth_create_order)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_create_order cannot be null');
        }

        $this->container['user_is_auth_create_order'] = $user_is_auth_create_order;

        return $this;
    }

    /**
     * Gets vat_on_for_company
     *
     * @return bool|null
     */
    public function getVatOnForCompany()
    {
        return $this->container['vat_on_for_company'];
    }

    /**
     * Sets vat_on_for_company
     *
     * @param bool|null $vat_on_for_company vat_on_for_company
     *
     * @return self
     */
    public function setVatOnForCompany($vat_on_for_company)
    {

        if (is_null($vat_on_for_company)) {
            throw new \InvalidArgumentException('non-nullable vat_on_for_company cannot be null');
        }

        $this->container['vat_on_for_company'] = $vat_on_for_company;

        return $this;
    }

    /**
     * Gets tax_free_diet_rates_enabled
     *
     * @return bool|null
     */
    public function getTaxFreeDietRatesEnabled()
    {
        return $this->container['tax_free_diet_rates_enabled'];
    }

    /**
     * Sets tax_free_diet_rates_enabled
     *
     * @param bool|null $tax_free_diet_rates_enabled tax_free_diet_rates_enabled
     *
     * @return self
     */
    public function setTaxFreeDietRatesEnabled($tax_free_diet_rates_enabled)
    {

        if (is_null($tax_free_diet_rates_enabled)) {
            throw new \InvalidArgumentException('non-nullable tax_free_diet_rates_enabled cannot be null');
        }

        $this->container['tax_free_diet_rates_enabled'] = $tax_free_diet_rates_enabled;

        return $this;
    }

    /**
     * Gets travel_diet_ignore_posting_enabled
     *
     * @return bool|null
     */
    public function getTravelDietIgnorePostingEnabled()
    {
        return $this->container['travel_diet_ignore_posting_enabled'];
    }

    /**
     * Sets travel_diet_ignore_posting_enabled
     *
     * @param bool|null $travel_diet_ignore_posting_enabled travel_diet_ignore_posting_enabled
     *
     * @return self
     */
    public function setTravelDietIgnorePostingEnabled($travel_diet_ignore_posting_enabled)
    {

        if (is_null($travel_diet_ignore_posting_enabled)) {
            throw new \InvalidArgumentException('non-nullable travel_diet_ignore_posting_enabled cannot be null');
        }

        $this->container['travel_diet_ignore_posting_enabled'] = $travel_diet_ignore_posting_enabled;

        return $this;
    }

    /**
     * Gets employee_enabled
     *
     * @return bool|null
     */
    public function getEmployeeEnabled()
    {
        return $this->container['employee_enabled'];
    }

    /**
     * Sets employee_enabled
     *
     * @param bool|null $employee_enabled employee_enabled
     *
     * @return self
     */
    public function setEmployeeEnabled($employee_enabled)
    {

        if (is_null($employee_enabled)) {
            throw new \InvalidArgumentException('non-nullable employee_enabled cannot be null');
        }

        $this->container['employee_enabled'] = $employee_enabled;

        return $this;
    }

    /**
     * Gets hour_balance_enabled_for_employee
     *
     * @return bool|null
     */
    public function getHourBalanceEnabledForEmployee()
    {
        return $this->container['hour_balance_enabled_for_employee'];
    }

    /**
     * Sets hour_balance_enabled_for_employee
     *
     * @param bool|null $hour_balance_enabled_for_employee hour_balance_enabled_for_employee
     *
     * @return self
     */
    public function setHourBalanceEnabledForEmployee($hour_balance_enabled_for_employee)
    {

        if (is_null($hour_balance_enabled_for_employee)) {
            throw new \InvalidArgumentException('non-nullable hour_balance_enabled_for_employee cannot be null');
        }

        $this->container['hour_balance_enabled_for_employee'] = $hour_balance_enabled_for_employee;

        return $this;
    }

    /**
     * Gets vacation_balance_enabled_for_employee
     *
     * @return bool|null
     */
    public function getVacationBalanceEnabledForEmployee()
    {
        return $this->container['vacation_balance_enabled_for_employee'];
    }

    /**
     * Sets vacation_balance_enabled_for_employee
     *
     * @param bool|null $vacation_balance_enabled_for_employee vacation_balance_enabled_for_employee
     *
     * @return self
     */
    public function setVacationBalanceEnabledForEmployee($vacation_balance_enabled_for_employee)
    {

        if (is_null($vacation_balance_enabled_for_employee)) {
            throw new \InvalidArgumentException('non-nullable vacation_balance_enabled_for_employee cannot be null');
        }

        $this->container['vacation_balance_enabled_for_employee'] = $vacation_balance_enabled_for_employee;

        return $this;
    }

    /**
     * Gets user_is_auth_create_customer
     *
     * @return bool|null
     */
    public function getUserIsAuthCreateCustomer()
    {
        return $this->container['user_is_auth_create_customer'];
    }

    /**
     * Sets user_is_auth_create_customer
     *
     * @param bool|null $user_is_auth_create_customer user_is_auth_create_customer
     *
     * @return self
     */
    public function setUserIsAuthCreateCustomer($user_is_auth_create_customer)
    {

        if (is_null($user_is_auth_create_customer)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_create_customer cannot be null');
        }

        $this->container['user_is_auth_create_customer'] = $user_is_auth_create_customer;

        return $this;
    }

    /**
     * Gets user_is_auth_project_menu
     *
     * @return bool|null
     */
    public function getUserIsAuthProjectMenu()
    {
        return $this->container['user_is_auth_project_menu'];
    }

    /**
     * Sets user_is_auth_project_menu
     *
     * @param bool|null $user_is_auth_project_menu user_is_auth_project_menu
     *
     * @return self
     */
    public function setUserIsAuthProjectMenu($user_is_auth_project_menu)
    {

        if (is_null($user_is_auth_project_menu)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_project_menu cannot be null');
        }

        $this->container['user_is_auth_project_menu'] = $user_is_auth_project_menu;

        return $this;
    }

    /**
     * Gets user_is_auth_company_accounting_reports
     *
     * @return bool|null
     */
    public function getUserIsAuthCompanyAccountingReports()
    {
        return $this->container['user_is_auth_company_accounting_reports'];
    }

    /**
     * Sets user_is_auth_company_accounting_reports
     *
     * @param bool|null $user_is_auth_company_accounting_reports user_is_auth_company_accounting_reports
     *
     * @return self
     */
    public function setUserIsAuthCompanyAccountingReports($user_is_auth_company_accounting_reports)
    {

        if (is_null($user_is_auth_company_accounting_reports)) {
            throw new \InvalidArgumentException('non-nullable user_is_auth_company_accounting_reports cannot be null');
        }

        $this->container['user_is_auth_company_accounting_reports'] = $user_is_auth_company_accounting_reports;

        return $this;
    }

    /**
     * Gets vvselectro_enabled
     *
     * @return bool|null
     */
    public function getVvselectroEnabled()
    {
        return $this->container['vvselectro_enabled'];
    }

    /**
     * Sets vvselectro_enabled
     *
     * @param bool|null $vvselectro_enabled vvselectro_enabled
     *
     * @return self
     */
    public function setVvselectroEnabled($vvselectro_enabled)
    {

        if (is_null($vvselectro_enabled)) {
            throw new \InvalidArgumentException('non-nullable vvselectro_enabled cannot be null');
        }

        $this->container['vvselectro_enabled'] = $vvselectro_enabled;

        return $this;
    }

    /**
     * Gets customer_enabled
     *
     * @return bool|null
     */
    public function getCustomerEnabled()
    {
        return $this->container['customer_enabled'];
    }

    /**
     * Sets customer_enabled
     *
     * @param bool|null $customer_enabled customer_enabled
     *
     * @return self
     */
    public function setCustomerEnabled($customer_enabled)
    {

        if (is_null($customer_enabled)) {
            throw new \InvalidArgumentException('non-nullable customer_enabled cannot be null');
        }

        $this->container['customer_enabled'] = $customer_enabled;

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


