<?php
/**
 * TripletexCompanyModules
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
 * TripletexCompanyModules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TripletexCompanyModules implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TripletexCompanyModules';

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
'company_id' => 'int',
'modulehourlist' => 'bool',
'module_travel_expense' => 'bool',
'module_invoice' => 'bool',
'moduleaccountinginternal' => 'bool',
'module_accounting_external' => 'bool',
'moduleproject' => 'bool',
'moduleproduct' => 'bool',
'modulecustomer' => 'bool',
'moduleemployee' => 'bool',
'moduledepartment' => 'bool',
'approveinvoices' => 'bool',
'approvehourlists' => 'bool',
'approvetravelreports' => 'bool',
'modulebudget' => 'bool',
'modulenote' => 'bool',
'moduletask' => 'bool',
'moduleresourceallocation' => 'bool',
'moduleprojecteconomy' => 'bool',
'modulereferencefee' => 'bool',
'modulehistorical' => 'bool',
'moduleprojectcategory' => 'bool',
'moduleprojectlocation' => 'bool',
'module_project_budget' => 'bool',
'modulesubscription' => 'bool',
'completeweeklyhourlists' => 'bool',
'completemonthlyhourlists' => 'bool',
'approvemonthlyhourlists' => 'bool',
'moduleprojectprognosis' => 'bool',
'modulebunches' => 'bool',
'module_vacation_balance' => 'bool',
'module_accounting_reports' => 'bool',
'module_customer_categories' => 'bool',
'module_customer_category1' => 'bool',
'module_customer_category2' => 'bool',
'module_customer_category3' => 'bool',
'moduleprojectsubcontract' => 'bool',
'module_payroll_accounting' => 'bool',
'module_time_balance' => 'bool',
'module_working_hours' => 'bool',
'module_currency' => 'bool',
'module_wage_export' => 'bool',
'module_auto_customer_number' => 'bool',
'module_auto_vendor_number' => 'bool',
'module_provision_salary' => 'bool',
'module_order_number' => 'bool',
'module_order_discount' => 'bool',
'module_order_markup' => 'bool',
'module_order_line_cost' => 'bool',
'module_stop_watch' => 'bool',
'module_contact' => 'bool',
'module_auto_project_number' => 'bool',
'module_swedish' => 'bool',
'module_resource_groups' => 'bool',
'module_ocr' => 'bool',
'module_travel_expense_rates' => 'bool',
'monthly_hourlist_minus_time_warning' => 'bool',
'module_voucher_scanning' => 'bool',
'module_invoice_scanning' => 'bool',
'module_project_participants' => 'bool',
'module_holyday_plan' => 'bool',
'module_employee_category' => 'bool',
'module_product_invoice' => 'bool',
'auto_invoicing' => 'bool',
'module_invoice_fee_comment' => 'bool',
'module_employee_accounting' => 'bool',
'module_department_accounting' => 'bool',
'module_project_accounting' => 'bool',
'module_product_accounting' => 'bool',
'module_subscription_address_list' => 'bool',
'module_electro' => 'bool',
'module_nrf' => 'bool',
'module_gtin' => 'bool',
'module_elproffen' => 'bool',
'module_rorkjop' => 'bool',
'module_order_ext' => 'bool',
'module_result_budget' => 'bool',
'module_amortization' => 'bool',
'module_change_debt_collector' => 'bool',
'module_voucher_types' => 'bool',
'module_onninen123' => 'bool',
'module_elektro_union' => 'bool',
'module_ahlsell_partner' => 'bool',
'module_archive' => 'bool',
'module_warehouse' => 'bool',
'module_project_budget_reference_fee' => 'bool',
'module_nets_eboks' => 'bool',
'module_nets_print_salary' => 'bool',
'module_nets_print_invoice' => 'bool',
'module_invoice_import' => 'bool',
'module_email' => 'bool',
'module_ocr_auto_pay' => 'bool',
'module_approve_voucher' => 'bool',
'module_approve_department_voucher' => 'bool',
'module_approve_project_voucher' => 'bool',
'module_order_out' => 'bool',
'module_mesan' => 'bool',
'module_divisions' => 'bool',
'module_boligmappa' => 'bool',
'module_addition_project_markup' => 'bool',
'module_wage_project_accounting' => 'bool',
'module_accountant_connect_client' => 'bool',
'module_wage_amortization' => 'bool',
'module_subscriptions_periodisation' => 'bool',
'module_activity_hourly_wage_wage_code' => 'bool',
'module_crm' => 'bool',
'module_api20' => 'bool',
'module_control_schema_required_invoicing' => 'bool',
'module_control_schema_required_hour_tracking' => 'bool',
'module_finance_tax' => 'bool',
'module_pensionreport' => 'bool',
'module_agro' => 'bool',
'module_mamut' => 'bool',
'module_invoice_option_paper' => 'bool',
'module_smart_scan' => 'bool',
'module_offer' => 'bool',
'module_auto_bank_reconciliation' => 'bool',
'module_voucher_automation' => 'bool',
'module_encrypted_pay_slip' => 'bool',
'module_invoice_option_vipps' => 'bool',
'module_invoice_option_efaktura' => 'bool',
'module_invoice_option_avtale_giro' => 'bool',
'module_factoring_aprila' => 'bool',
'module_factoring_visma_finance' => 'string',
'module_cash_credit_aprila' => 'bool',
'module_invoice_option_autoinvoice_ehf' => 'bool'    ];

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
'company_id' => 'int32',
'modulehourlist' => null,
'module_travel_expense' => null,
'module_invoice' => null,
'moduleaccountinginternal' => null,
'module_accounting_external' => null,
'moduleproject' => null,
'moduleproduct' => null,
'modulecustomer' => null,
'moduleemployee' => null,
'moduledepartment' => null,
'approveinvoices' => null,
'approvehourlists' => null,
'approvetravelreports' => null,
'modulebudget' => null,
'modulenote' => null,
'moduletask' => null,
'moduleresourceallocation' => null,
'moduleprojecteconomy' => null,
'modulereferencefee' => null,
'modulehistorical' => null,
'moduleprojectcategory' => null,
'moduleprojectlocation' => null,
'module_project_budget' => null,
'modulesubscription' => null,
'completeweeklyhourlists' => null,
'completemonthlyhourlists' => null,
'approvemonthlyhourlists' => null,
'moduleprojectprognosis' => null,
'modulebunches' => null,
'module_vacation_balance' => null,
'module_accounting_reports' => null,
'module_customer_categories' => null,
'module_customer_category1' => null,
'module_customer_category2' => null,
'module_customer_category3' => null,
'moduleprojectsubcontract' => null,
'module_payroll_accounting' => null,
'module_time_balance' => null,
'module_working_hours' => null,
'module_currency' => null,
'module_wage_export' => null,
'module_auto_customer_number' => null,
'module_auto_vendor_number' => null,
'module_provision_salary' => null,
'module_order_number' => null,
'module_order_discount' => null,
'module_order_markup' => null,
'module_order_line_cost' => null,
'module_stop_watch' => null,
'module_contact' => null,
'module_auto_project_number' => null,
'module_swedish' => null,
'module_resource_groups' => null,
'module_ocr' => null,
'module_travel_expense_rates' => null,
'monthly_hourlist_minus_time_warning' => null,
'module_voucher_scanning' => null,
'module_invoice_scanning' => null,
'module_project_participants' => null,
'module_holyday_plan' => null,
'module_employee_category' => null,
'module_product_invoice' => null,
'auto_invoicing' => null,
'module_invoice_fee_comment' => null,
'module_employee_accounting' => null,
'module_department_accounting' => null,
'module_project_accounting' => null,
'module_product_accounting' => null,
'module_subscription_address_list' => null,
'module_electro' => null,
'module_nrf' => null,
'module_gtin' => null,
'module_elproffen' => null,
'module_rorkjop' => null,
'module_order_ext' => null,
'module_result_budget' => null,
'module_amortization' => null,
'module_change_debt_collector' => null,
'module_voucher_types' => null,
'module_onninen123' => null,
'module_elektro_union' => null,
'module_ahlsell_partner' => null,
'module_archive' => null,
'module_warehouse' => null,
'module_project_budget_reference_fee' => null,
'module_nets_eboks' => null,
'module_nets_print_salary' => null,
'module_nets_print_invoice' => null,
'module_invoice_import' => null,
'module_email' => null,
'module_ocr_auto_pay' => null,
'module_approve_voucher' => null,
'module_approve_department_voucher' => null,
'module_approve_project_voucher' => null,
'module_order_out' => null,
'module_mesan' => null,
'module_divisions' => null,
'module_boligmappa' => null,
'module_addition_project_markup' => null,
'module_wage_project_accounting' => null,
'module_accountant_connect_client' => null,
'module_wage_amortization' => null,
'module_subscriptions_periodisation' => null,
'module_activity_hourly_wage_wage_code' => null,
'module_crm' => null,
'module_api20' => null,
'module_control_schema_required_invoicing' => null,
'module_control_schema_required_hour_tracking' => null,
'module_finance_tax' => null,
'module_pensionreport' => null,
'module_agro' => null,
'module_mamut' => null,
'module_invoice_option_paper' => null,
'module_smart_scan' => null,
'module_offer' => null,
'module_auto_bank_reconciliation' => null,
'module_voucher_automation' => null,
'module_encrypted_pay_slip' => null,
'module_invoice_option_vipps' => null,
'module_invoice_option_efaktura' => null,
'module_invoice_option_avtale_giro' => null,
'module_factoring_aprila' => null,
'module_factoring_visma_finance' => null,
'module_cash_credit_aprila' => null,
'module_invoice_option_autoinvoice_ehf' => null    ];

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
'company_id' => 'companyId',
'modulehourlist' => 'modulehourlist',
'module_travel_expense' => 'moduleTravelExpense',
'module_invoice' => 'moduleInvoice',
'moduleaccountinginternal' => 'moduleaccountinginternal',
'module_accounting_external' => 'moduleAccountingExternal',
'moduleproject' => 'moduleproject',
'moduleproduct' => 'moduleproduct',
'modulecustomer' => 'modulecustomer',
'moduleemployee' => 'moduleemployee',
'moduledepartment' => 'moduledepartment',
'approveinvoices' => 'approveinvoices',
'approvehourlists' => 'approvehourlists',
'approvetravelreports' => 'approvetravelreports',
'modulebudget' => 'modulebudget',
'modulenote' => 'modulenote',
'moduletask' => 'moduletask',
'moduleresourceallocation' => 'moduleresourceallocation',
'moduleprojecteconomy' => 'moduleprojecteconomy',
'modulereferencefee' => 'modulereferencefee',
'modulehistorical' => 'modulehistorical',
'moduleprojectcategory' => 'moduleprojectcategory',
'moduleprojectlocation' => 'moduleprojectlocation',
'module_project_budget' => 'moduleProjectBudget',
'modulesubscription' => 'modulesubscription',
'completeweeklyhourlists' => 'completeweeklyhourlists',
'completemonthlyhourlists' => 'completemonthlyhourlists',
'approvemonthlyhourlists' => 'approvemonthlyhourlists',
'moduleprojectprognosis' => 'moduleprojectprognosis',
'modulebunches' => 'modulebunches',
'module_vacation_balance' => 'moduleVacationBalance',
'module_accounting_reports' => 'moduleAccountingReports',
'module_customer_categories' => 'moduleCustomerCategories',
'module_customer_category1' => 'moduleCustomerCategory1',
'module_customer_category2' => 'moduleCustomerCategory2',
'module_customer_category3' => 'moduleCustomerCategory3',
'moduleprojectsubcontract' => 'moduleprojectsubcontract',
'module_payroll_accounting' => 'modulePayrollAccounting',
'module_time_balance' => 'moduleTimeBalance',
'module_working_hours' => 'moduleWorkingHours',
'module_currency' => 'moduleCurrency',
'module_wage_export' => 'moduleWageExport',
'module_auto_customer_number' => 'moduleAutoCustomerNumber',
'module_auto_vendor_number' => 'moduleAutoVendorNumber',
'module_provision_salary' => 'moduleProvisionSalary',
'module_order_number' => 'moduleOrderNumber',
'module_order_discount' => 'moduleOrderDiscount',
'module_order_markup' => 'moduleOrderMarkup',
'module_order_line_cost' => 'moduleOrderLineCost',
'module_stop_watch' => 'moduleStopWatch',
'module_contact' => 'moduleContact',
'module_auto_project_number' => 'moduleAutoProjectNumber',
'module_swedish' => 'moduleSwedish',
'module_resource_groups' => 'moduleResourceGroups',
'module_ocr' => 'moduleOcr',
'module_travel_expense_rates' => 'moduleTravelExpenseRates',
'monthly_hourlist_minus_time_warning' => 'monthlyHourlistMinusTimeWarning',
'module_voucher_scanning' => 'moduleVoucherScanning',
'module_invoice_scanning' => 'moduleInvoiceScanning',
'module_project_participants' => 'moduleProjectParticipants',
'module_holyday_plan' => 'moduleHolydayPlan',
'module_employee_category' => 'moduleEmployeeCategory',
'module_product_invoice' => 'moduleProductInvoice',
'auto_invoicing' => 'autoInvoicing',
'module_invoice_fee_comment' => 'moduleInvoiceFeeComment',
'module_employee_accounting' => 'moduleEmployeeAccounting',
'module_department_accounting' => 'moduleDepartmentAccounting',
'module_project_accounting' => 'moduleProjectAccounting',
'module_product_accounting' => 'moduleProductAccounting',
'module_subscription_address_list' => 'moduleSubscriptionAddressList',
'module_electro' => 'moduleElectro',
'module_nrf' => 'moduleNrf',
'module_gtin' => 'moduleGtin',
'module_elproffen' => 'moduleElproffen',
'module_rorkjop' => 'moduleRorkjop',
'module_order_ext' => 'moduleOrderExt',
'module_result_budget' => 'moduleResultBudget',
'module_amortization' => 'moduleAmortization',
'module_change_debt_collector' => 'moduleChangeDebtCollector',
'module_voucher_types' => 'moduleVoucherTypes',
'module_onninen123' => 'moduleOnninen123',
'module_elektro_union' => 'moduleElektroUnion',
'module_ahlsell_partner' => 'moduleAhlsellPartner',
'module_archive' => 'moduleArchive',
'module_warehouse' => 'moduleWarehouse',
'module_project_budget_reference_fee' => 'moduleProjectBudgetReferenceFee',
'module_nets_eboks' => 'moduleNetsEboks',
'module_nets_print_salary' => 'moduleNetsPrintSalary',
'module_nets_print_invoice' => 'moduleNetsPrintInvoice',
'module_invoice_import' => 'moduleInvoiceImport',
'module_email' => 'moduleEmail',
'module_ocr_auto_pay' => 'moduleOcrAutoPay',
'module_approve_voucher' => 'moduleApproveVoucher',
'module_approve_department_voucher' => 'moduleApproveDepartmentVoucher',
'module_approve_project_voucher' => 'moduleApproveProjectVoucher',
'module_order_out' => 'moduleOrderOut',
'module_mesan' => 'moduleMesan',
'module_divisions' => 'moduleDivisions',
'module_boligmappa' => 'moduleBoligmappa',
'module_addition_project_markup' => 'moduleAdditionProjectMarkup',
'module_wage_project_accounting' => 'moduleWageProjectAccounting',
'module_accountant_connect_client' => 'moduleAccountantConnectClient',
'module_wage_amortization' => 'moduleWageAmortization',
'module_subscriptions_periodisation' => 'moduleSubscriptionsPeriodisation',
'module_activity_hourly_wage_wage_code' => 'moduleActivityHourlyWageWageCode',
'module_crm' => 'moduleCRM',
'module_api20' => 'moduleApi20',
'module_control_schema_required_invoicing' => 'moduleControlSchemaRequiredInvoicing',
'module_control_schema_required_hour_tracking' => 'moduleControlSchemaRequiredHourTracking',
'module_finance_tax' => 'moduleFinanceTax',
'module_pensionreport' => 'modulePensionreport',
'module_agro' => 'moduleAgro',
'module_mamut' => 'moduleMamut',
'module_invoice_option_paper' => 'moduleInvoiceOptionPaper',
'module_smart_scan' => 'moduleSmartScan',
'module_offer' => 'moduleOffer',
'module_auto_bank_reconciliation' => 'moduleAutoBankReconciliation',
'module_voucher_automation' => 'moduleVoucherAutomation',
'module_encrypted_pay_slip' => 'moduleEncryptedPaySlip',
'module_invoice_option_vipps' => 'moduleInvoiceOptionVipps',
'module_invoice_option_efaktura' => 'moduleInvoiceOptionEfaktura',
'module_invoice_option_avtale_giro' => 'moduleInvoiceOptionAvtaleGiro',
'module_factoring_aprila' => 'moduleFactoringAprila',
'module_factoring_visma_finance' => 'moduleFactoringVismaFinance',
'module_cash_credit_aprila' => 'moduleCashCreditAprila',
'module_invoice_option_autoinvoice_ehf' => 'moduleInvoiceOptionAutoinvoiceEhf'    ];

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
'company_id' => 'setCompanyId',
'modulehourlist' => 'setModulehourlist',
'module_travel_expense' => 'setModuleTravelExpense',
'module_invoice' => 'setModuleInvoice',
'moduleaccountinginternal' => 'setModuleaccountinginternal',
'module_accounting_external' => 'setModuleAccountingExternal',
'moduleproject' => 'setModuleproject',
'moduleproduct' => 'setModuleproduct',
'modulecustomer' => 'setModulecustomer',
'moduleemployee' => 'setModuleemployee',
'moduledepartment' => 'setModuledepartment',
'approveinvoices' => 'setApproveinvoices',
'approvehourlists' => 'setApprovehourlists',
'approvetravelreports' => 'setApprovetravelreports',
'modulebudget' => 'setModulebudget',
'modulenote' => 'setModulenote',
'moduletask' => 'setModuletask',
'moduleresourceallocation' => 'setModuleresourceallocation',
'moduleprojecteconomy' => 'setModuleprojecteconomy',
'modulereferencefee' => 'setModulereferencefee',
'modulehistorical' => 'setModulehistorical',
'moduleprojectcategory' => 'setModuleprojectcategory',
'moduleprojectlocation' => 'setModuleprojectlocation',
'module_project_budget' => 'setModuleProjectBudget',
'modulesubscription' => 'setModulesubscription',
'completeweeklyhourlists' => 'setCompleteweeklyhourlists',
'completemonthlyhourlists' => 'setCompletemonthlyhourlists',
'approvemonthlyhourlists' => 'setApprovemonthlyhourlists',
'moduleprojectprognosis' => 'setModuleprojectprognosis',
'modulebunches' => 'setModulebunches',
'module_vacation_balance' => 'setModuleVacationBalance',
'module_accounting_reports' => 'setModuleAccountingReports',
'module_customer_categories' => 'setModuleCustomerCategories',
'module_customer_category1' => 'setModuleCustomerCategory1',
'module_customer_category2' => 'setModuleCustomerCategory2',
'module_customer_category3' => 'setModuleCustomerCategory3',
'moduleprojectsubcontract' => 'setModuleprojectsubcontract',
'module_payroll_accounting' => 'setModulePayrollAccounting',
'module_time_balance' => 'setModuleTimeBalance',
'module_working_hours' => 'setModuleWorkingHours',
'module_currency' => 'setModuleCurrency',
'module_wage_export' => 'setModuleWageExport',
'module_auto_customer_number' => 'setModuleAutoCustomerNumber',
'module_auto_vendor_number' => 'setModuleAutoVendorNumber',
'module_provision_salary' => 'setModuleProvisionSalary',
'module_order_number' => 'setModuleOrderNumber',
'module_order_discount' => 'setModuleOrderDiscount',
'module_order_markup' => 'setModuleOrderMarkup',
'module_order_line_cost' => 'setModuleOrderLineCost',
'module_stop_watch' => 'setModuleStopWatch',
'module_contact' => 'setModuleContact',
'module_auto_project_number' => 'setModuleAutoProjectNumber',
'module_swedish' => 'setModuleSwedish',
'module_resource_groups' => 'setModuleResourceGroups',
'module_ocr' => 'setModuleOcr',
'module_travel_expense_rates' => 'setModuleTravelExpenseRates',
'monthly_hourlist_minus_time_warning' => 'setMonthlyHourlistMinusTimeWarning',
'module_voucher_scanning' => 'setModuleVoucherScanning',
'module_invoice_scanning' => 'setModuleInvoiceScanning',
'module_project_participants' => 'setModuleProjectParticipants',
'module_holyday_plan' => 'setModuleHolydayPlan',
'module_employee_category' => 'setModuleEmployeeCategory',
'module_product_invoice' => 'setModuleProductInvoice',
'auto_invoicing' => 'setAutoInvoicing',
'module_invoice_fee_comment' => 'setModuleInvoiceFeeComment',
'module_employee_accounting' => 'setModuleEmployeeAccounting',
'module_department_accounting' => 'setModuleDepartmentAccounting',
'module_project_accounting' => 'setModuleProjectAccounting',
'module_product_accounting' => 'setModuleProductAccounting',
'module_subscription_address_list' => 'setModuleSubscriptionAddressList',
'module_electro' => 'setModuleElectro',
'module_nrf' => 'setModuleNrf',
'module_gtin' => 'setModuleGtin',
'module_elproffen' => 'setModuleElproffen',
'module_rorkjop' => 'setModuleRorkjop',
'module_order_ext' => 'setModuleOrderExt',
'module_result_budget' => 'setModuleResultBudget',
'module_amortization' => 'setModuleAmortization',
'module_change_debt_collector' => 'setModuleChangeDebtCollector',
'module_voucher_types' => 'setModuleVoucherTypes',
'module_onninen123' => 'setModuleOnninen123',
'module_elektro_union' => 'setModuleElektroUnion',
'module_ahlsell_partner' => 'setModuleAhlsellPartner',
'module_archive' => 'setModuleArchive',
'module_warehouse' => 'setModuleWarehouse',
'module_project_budget_reference_fee' => 'setModuleProjectBudgetReferenceFee',
'module_nets_eboks' => 'setModuleNetsEboks',
'module_nets_print_salary' => 'setModuleNetsPrintSalary',
'module_nets_print_invoice' => 'setModuleNetsPrintInvoice',
'module_invoice_import' => 'setModuleInvoiceImport',
'module_email' => 'setModuleEmail',
'module_ocr_auto_pay' => 'setModuleOcrAutoPay',
'module_approve_voucher' => 'setModuleApproveVoucher',
'module_approve_department_voucher' => 'setModuleApproveDepartmentVoucher',
'module_approve_project_voucher' => 'setModuleApproveProjectVoucher',
'module_order_out' => 'setModuleOrderOut',
'module_mesan' => 'setModuleMesan',
'module_divisions' => 'setModuleDivisions',
'module_boligmappa' => 'setModuleBoligmappa',
'module_addition_project_markup' => 'setModuleAdditionProjectMarkup',
'module_wage_project_accounting' => 'setModuleWageProjectAccounting',
'module_accountant_connect_client' => 'setModuleAccountantConnectClient',
'module_wage_amortization' => 'setModuleWageAmortization',
'module_subscriptions_periodisation' => 'setModuleSubscriptionsPeriodisation',
'module_activity_hourly_wage_wage_code' => 'setModuleActivityHourlyWageWageCode',
'module_crm' => 'setModuleCrm',
'module_api20' => 'setModuleApi20',
'module_control_schema_required_invoicing' => 'setModuleControlSchemaRequiredInvoicing',
'module_control_schema_required_hour_tracking' => 'setModuleControlSchemaRequiredHourTracking',
'module_finance_tax' => 'setModuleFinanceTax',
'module_pensionreport' => 'setModulePensionreport',
'module_agro' => 'setModuleAgro',
'module_mamut' => 'setModuleMamut',
'module_invoice_option_paper' => 'setModuleInvoiceOptionPaper',
'module_smart_scan' => 'setModuleSmartScan',
'module_offer' => 'setModuleOffer',
'module_auto_bank_reconciliation' => 'setModuleAutoBankReconciliation',
'module_voucher_automation' => 'setModuleVoucherAutomation',
'module_encrypted_pay_slip' => 'setModuleEncryptedPaySlip',
'module_invoice_option_vipps' => 'setModuleInvoiceOptionVipps',
'module_invoice_option_efaktura' => 'setModuleInvoiceOptionEfaktura',
'module_invoice_option_avtale_giro' => 'setModuleInvoiceOptionAvtaleGiro',
'module_factoring_aprila' => 'setModuleFactoringAprila',
'module_factoring_visma_finance' => 'setModuleFactoringVismaFinance',
'module_cash_credit_aprila' => 'setModuleCashCreditAprila',
'module_invoice_option_autoinvoice_ehf' => 'setModuleInvoiceOptionAutoinvoiceEhf'    ];

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
'company_id' => 'getCompanyId',
'modulehourlist' => 'getModulehourlist',
'module_travel_expense' => 'getModuleTravelExpense',
'module_invoice' => 'getModuleInvoice',
'moduleaccountinginternal' => 'getModuleaccountinginternal',
'module_accounting_external' => 'getModuleAccountingExternal',
'moduleproject' => 'getModuleproject',
'moduleproduct' => 'getModuleproduct',
'modulecustomer' => 'getModulecustomer',
'moduleemployee' => 'getModuleemployee',
'moduledepartment' => 'getModuledepartment',
'approveinvoices' => 'getApproveinvoices',
'approvehourlists' => 'getApprovehourlists',
'approvetravelreports' => 'getApprovetravelreports',
'modulebudget' => 'getModulebudget',
'modulenote' => 'getModulenote',
'moduletask' => 'getModuletask',
'moduleresourceallocation' => 'getModuleresourceallocation',
'moduleprojecteconomy' => 'getModuleprojecteconomy',
'modulereferencefee' => 'getModulereferencefee',
'modulehistorical' => 'getModulehistorical',
'moduleprojectcategory' => 'getModuleprojectcategory',
'moduleprojectlocation' => 'getModuleprojectlocation',
'module_project_budget' => 'getModuleProjectBudget',
'modulesubscription' => 'getModulesubscription',
'completeweeklyhourlists' => 'getCompleteweeklyhourlists',
'completemonthlyhourlists' => 'getCompletemonthlyhourlists',
'approvemonthlyhourlists' => 'getApprovemonthlyhourlists',
'moduleprojectprognosis' => 'getModuleprojectprognosis',
'modulebunches' => 'getModulebunches',
'module_vacation_balance' => 'getModuleVacationBalance',
'module_accounting_reports' => 'getModuleAccountingReports',
'module_customer_categories' => 'getModuleCustomerCategories',
'module_customer_category1' => 'getModuleCustomerCategory1',
'module_customer_category2' => 'getModuleCustomerCategory2',
'module_customer_category3' => 'getModuleCustomerCategory3',
'moduleprojectsubcontract' => 'getModuleprojectsubcontract',
'module_payroll_accounting' => 'getModulePayrollAccounting',
'module_time_balance' => 'getModuleTimeBalance',
'module_working_hours' => 'getModuleWorkingHours',
'module_currency' => 'getModuleCurrency',
'module_wage_export' => 'getModuleWageExport',
'module_auto_customer_number' => 'getModuleAutoCustomerNumber',
'module_auto_vendor_number' => 'getModuleAutoVendorNumber',
'module_provision_salary' => 'getModuleProvisionSalary',
'module_order_number' => 'getModuleOrderNumber',
'module_order_discount' => 'getModuleOrderDiscount',
'module_order_markup' => 'getModuleOrderMarkup',
'module_order_line_cost' => 'getModuleOrderLineCost',
'module_stop_watch' => 'getModuleStopWatch',
'module_contact' => 'getModuleContact',
'module_auto_project_number' => 'getModuleAutoProjectNumber',
'module_swedish' => 'getModuleSwedish',
'module_resource_groups' => 'getModuleResourceGroups',
'module_ocr' => 'getModuleOcr',
'module_travel_expense_rates' => 'getModuleTravelExpenseRates',
'monthly_hourlist_minus_time_warning' => 'getMonthlyHourlistMinusTimeWarning',
'module_voucher_scanning' => 'getModuleVoucherScanning',
'module_invoice_scanning' => 'getModuleInvoiceScanning',
'module_project_participants' => 'getModuleProjectParticipants',
'module_holyday_plan' => 'getModuleHolydayPlan',
'module_employee_category' => 'getModuleEmployeeCategory',
'module_product_invoice' => 'getModuleProductInvoice',
'auto_invoicing' => 'getAutoInvoicing',
'module_invoice_fee_comment' => 'getModuleInvoiceFeeComment',
'module_employee_accounting' => 'getModuleEmployeeAccounting',
'module_department_accounting' => 'getModuleDepartmentAccounting',
'module_project_accounting' => 'getModuleProjectAccounting',
'module_product_accounting' => 'getModuleProductAccounting',
'module_subscription_address_list' => 'getModuleSubscriptionAddressList',
'module_electro' => 'getModuleElectro',
'module_nrf' => 'getModuleNrf',
'module_gtin' => 'getModuleGtin',
'module_elproffen' => 'getModuleElproffen',
'module_rorkjop' => 'getModuleRorkjop',
'module_order_ext' => 'getModuleOrderExt',
'module_result_budget' => 'getModuleResultBudget',
'module_amortization' => 'getModuleAmortization',
'module_change_debt_collector' => 'getModuleChangeDebtCollector',
'module_voucher_types' => 'getModuleVoucherTypes',
'module_onninen123' => 'getModuleOnninen123',
'module_elektro_union' => 'getModuleElektroUnion',
'module_ahlsell_partner' => 'getModuleAhlsellPartner',
'module_archive' => 'getModuleArchive',
'module_warehouse' => 'getModuleWarehouse',
'module_project_budget_reference_fee' => 'getModuleProjectBudgetReferenceFee',
'module_nets_eboks' => 'getModuleNetsEboks',
'module_nets_print_salary' => 'getModuleNetsPrintSalary',
'module_nets_print_invoice' => 'getModuleNetsPrintInvoice',
'module_invoice_import' => 'getModuleInvoiceImport',
'module_email' => 'getModuleEmail',
'module_ocr_auto_pay' => 'getModuleOcrAutoPay',
'module_approve_voucher' => 'getModuleApproveVoucher',
'module_approve_department_voucher' => 'getModuleApproveDepartmentVoucher',
'module_approve_project_voucher' => 'getModuleApproveProjectVoucher',
'module_order_out' => 'getModuleOrderOut',
'module_mesan' => 'getModuleMesan',
'module_divisions' => 'getModuleDivisions',
'module_boligmappa' => 'getModuleBoligmappa',
'module_addition_project_markup' => 'getModuleAdditionProjectMarkup',
'module_wage_project_accounting' => 'getModuleWageProjectAccounting',
'module_accountant_connect_client' => 'getModuleAccountantConnectClient',
'module_wage_amortization' => 'getModuleWageAmortization',
'module_subscriptions_periodisation' => 'getModuleSubscriptionsPeriodisation',
'module_activity_hourly_wage_wage_code' => 'getModuleActivityHourlyWageWageCode',
'module_crm' => 'getModuleCrm',
'module_api20' => 'getModuleApi20',
'module_control_schema_required_invoicing' => 'getModuleControlSchemaRequiredInvoicing',
'module_control_schema_required_hour_tracking' => 'getModuleControlSchemaRequiredHourTracking',
'module_finance_tax' => 'getModuleFinanceTax',
'module_pensionreport' => 'getModulePensionreport',
'module_agro' => 'getModuleAgro',
'module_mamut' => 'getModuleMamut',
'module_invoice_option_paper' => 'getModuleInvoiceOptionPaper',
'module_smart_scan' => 'getModuleSmartScan',
'module_offer' => 'getModuleOffer',
'module_auto_bank_reconciliation' => 'getModuleAutoBankReconciliation',
'module_voucher_automation' => 'getModuleVoucherAutomation',
'module_encrypted_pay_slip' => 'getModuleEncryptedPaySlip',
'module_invoice_option_vipps' => 'getModuleInvoiceOptionVipps',
'module_invoice_option_efaktura' => 'getModuleInvoiceOptionEfaktura',
'module_invoice_option_avtale_giro' => 'getModuleInvoiceOptionAvtaleGiro',
'module_factoring_aprila' => 'getModuleFactoringAprila',
'module_factoring_visma_finance' => 'getModuleFactoringVismaFinance',
'module_cash_credit_aprila' => 'getModuleCashCreditAprila',
'module_invoice_option_autoinvoice_ehf' => 'getModuleInvoiceOptionAutoinvoiceEhf'    ];

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

    const MODULE_FACTORING_VISMA_FINANCE_OFF = 'OFF';
const MODULE_FACTORING_VISMA_FINANCE_STARTED = 'STARTED';
const MODULE_FACTORING_VISMA_FINANCE_SIGNING_STARTED = 'SIGNING_STARTED';
const MODULE_FACTORING_VISMA_FINANCE_ON = 'ON';
const MODULE_FACTORING_VISMA_FINANCE_IN_REVIEW = 'IN_REVIEW';
const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_ON = 'DEACTIVATED_FROM_ON';
const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_OFF = 'DEACTIVATED_FROM_OFF';
const MODULE_FACTORING_VISMA_FINANCE_FAILED = 'FAILED';
const MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT = 'OPTED_OUT';

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
self::MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT,        ];
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
        $this->container['company_id'] = isset($data['company_id']) ? $data['company_id'] : null;
        $this->container['modulehourlist'] = isset($data['modulehourlist']) ? $data['modulehourlist'] : null;
        $this->container['module_travel_expense'] = isset($data['module_travel_expense']) ? $data['module_travel_expense'] : null;
        $this->container['module_invoice'] = isset($data['module_invoice']) ? $data['module_invoice'] : null;
        $this->container['moduleaccountinginternal'] = isset($data['moduleaccountinginternal']) ? $data['moduleaccountinginternal'] : null;
        $this->container['module_accounting_external'] = isset($data['module_accounting_external']) ? $data['module_accounting_external'] : null;
        $this->container['moduleproject'] = isset($data['moduleproject']) ? $data['moduleproject'] : null;
        $this->container['moduleproduct'] = isset($data['moduleproduct']) ? $data['moduleproduct'] : null;
        $this->container['modulecustomer'] = isset($data['modulecustomer']) ? $data['modulecustomer'] : null;
        $this->container['moduleemployee'] = isset($data['moduleemployee']) ? $data['moduleemployee'] : null;
        $this->container['moduledepartment'] = isset($data['moduledepartment']) ? $data['moduledepartment'] : null;
        $this->container['approveinvoices'] = isset($data['approveinvoices']) ? $data['approveinvoices'] : null;
        $this->container['approvehourlists'] = isset($data['approvehourlists']) ? $data['approvehourlists'] : null;
        $this->container['approvetravelreports'] = isset($data['approvetravelreports']) ? $data['approvetravelreports'] : null;
        $this->container['modulebudget'] = isset($data['modulebudget']) ? $data['modulebudget'] : null;
        $this->container['modulenote'] = isset($data['modulenote']) ? $data['modulenote'] : null;
        $this->container['moduletask'] = isset($data['moduletask']) ? $data['moduletask'] : null;
        $this->container['moduleresourceallocation'] = isset($data['moduleresourceallocation']) ? $data['moduleresourceallocation'] : null;
        $this->container['moduleprojecteconomy'] = isset($data['moduleprojecteconomy']) ? $data['moduleprojecteconomy'] : null;
        $this->container['modulereferencefee'] = isset($data['modulereferencefee']) ? $data['modulereferencefee'] : null;
        $this->container['modulehistorical'] = isset($data['modulehistorical']) ? $data['modulehistorical'] : null;
        $this->container['moduleprojectcategory'] = isset($data['moduleprojectcategory']) ? $data['moduleprojectcategory'] : null;
        $this->container['moduleprojectlocation'] = isset($data['moduleprojectlocation']) ? $data['moduleprojectlocation'] : null;
        $this->container['module_project_budget'] = isset($data['module_project_budget']) ? $data['module_project_budget'] : null;
        $this->container['modulesubscription'] = isset($data['modulesubscription']) ? $data['modulesubscription'] : null;
        $this->container['completeweeklyhourlists'] = isset($data['completeweeklyhourlists']) ? $data['completeweeklyhourlists'] : null;
        $this->container['completemonthlyhourlists'] = isset($data['completemonthlyhourlists']) ? $data['completemonthlyhourlists'] : null;
        $this->container['approvemonthlyhourlists'] = isset($data['approvemonthlyhourlists']) ? $data['approvemonthlyhourlists'] : null;
        $this->container['moduleprojectprognosis'] = isset($data['moduleprojectprognosis']) ? $data['moduleprojectprognosis'] : null;
        $this->container['modulebunches'] = isset($data['modulebunches']) ? $data['modulebunches'] : null;
        $this->container['module_vacation_balance'] = isset($data['module_vacation_balance']) ? $data['module_vacation_balance'] : null;
        $this->container['module_accounting_reports'] = isset($data['module_accounting_reports']) ? $data['module_accounting_reports'] : null;
        $this->container['module_customer_categories'] = isset($data['module_customer_categories']) ? $data['module_customer_categories'] : null;
        $this->container['module_customer_category1'] = isset($data['module_customer_category1']) ? $data['module_customer_category1'] : null;
        $this->container['module_customer_category2'] = isset($data['module_customer_category2']) ? $data['module_customer_category2'] : null;
        $this->container['module_customer_category3'] = isset($data['module_customer_category3']) ? $data['module_customer_category3'] : null;
        $this->container['moduleprojectsubcontract'] = isset($data['moduleprojectsubcontract']) ? $data['moduleprojectsubcontract'] : null;
        $this->container['module_payroll_accounting'] = isset($data['module_payroll_accounting']) ? $data['module_payroll_accounting'] : null;
        $this->container['module_time_balance'] = isset($data['module_time_balance']) ? $data['module_time_balance'] : null;
        $this->container['module_working_hours'] = isset($data['module_working_hours']) ? $data['module_working_hours'] : null;
        $this->container['module_currency'] = isset($data['module_currency']) ? $data['module_currency'] : null;
        $this->container['module_wage_export'] = isset($data['module_wage_export']) ? $data['module_wage_export'] : null;
        $this->container['module_auto_customer_number'] = isset($data['module_auto_customer_number']) ? $data['module_auto_customer_number'] : null;
        $this->container['module_auto_vendor_number'] = isset($data['module_auto_vendor_number']) ? $data['module_auto_vendor_number'] : null;
        $this->container['module_provision_salary'] = isset($data['module_provision_salary']) ? $data['module_provision_salary'] : null;
        $this->container['module_order_number'] = isset($data['module_order_number']) ? $data['module_order_number'] : null;
        $this->container['module_order_discount'] = isset($data['module_order_discount']) ? $data['module_order_discount'] : null;
        $this->container['module_order_markup'] = isset($data['module_order_markup']) ? $data['module_order_markup'] : null;
        $this->container['module_order_line_cost'] = isset($data['module_order_line_cost']) ? $data['module_order_line_cost'] : null;
        $this->container['module_stop_watch'] = isset($data['module_stop_watch']) ? $data['module_stop_watch'] : null;
        $this->container['module_contact'] = isset($data['module_contact']) ? $data['module_contact'] : null;
        $this->container['module_auto_project_number'] = isset($data['module_auto_project_number']) ? $data['module_auto_project_number'] : null;
        $this->container['module_swedish'] = isset($data['module_swedish']) ? $data['module_swedish'] : null;
        $this->container['module_resource_groups'] = isset($data['module_resource_groups']) ? $data['module_resource_groups'] : null;
        $this->container['module_ocr'] = isset($data['module_ocr']) ? $data['module_ocr'] : null;
        $this->container['module_travel_expense_rates'] = isset($data['module_travel_expense_rates']) ? $data['module_travel_expense_rates'] : null;
        $this->container['monthly_hourlist_minus_time_warning'] = isset($data['monthly_hourlist_minus_time_warning']) ? $data['monthly_hourlist_minus_time_warning'] : null;
        $this->container['module_voucher_scanning'] = isset($data['module_voucher_scanning']) ? $data['module_voucher_scanning'] : null;
        $this->container['module_invoice_scanning'] = isset($data['module_invoice_scanning']) ? $data['module_invoice_scanning'] : null;
        $this->container['module_project_participants'] = isset($data['module_project_participants']) ? $data['module_project_participants'] : null;
        $this->container['module_holyday_plan'] = isset($data['module_holyday_plan']) ? $data['module_holyday_plan'] : null;
        $this->container['module_employee_category'] = isset($data['module_employee_category']) ? $data['module_employee_category'] : null;
        $this->container['module_product_invoice'] = isset($data['module_product_invoice']) ? $data['module_product_invoice'] : null;
        $this->container['auto_invoicing'] = isset($data['auto_invoicing']) ? $data['auto_invoicing'] : null;
        $this->container['module_invoice_fee_comment'] = isset($data['module_invoice_fee_comment']) ? $data['module_invoice_fee_comment'] : null;
        $this->container['module_employee_accounting'] = isset($data['module_employee_accounting']) ? $data['module_employee_accounting'] : null;
        $this->container['module_department_accounting'] = isset($data['module_department_accounting']) ? $data['module_department_accounting'] : null;
        $this->container['module_project_accounting'] = isset($data['module_project_accounting']) ? $data['module_project_accounting'] : null;
        $this->container['module_product_accounting'] = isset($data['module_product_accounting']) ? $data['module_product_accounting'] : null;
        $this->container['module_subscription_address_list'] = isset($data['module_subscription_address_list']) ? $data['module_subscription_address_list'] : null;
        $this->container['module_electro'] = isset($data['module_electro']) ? $data['module_electro'] : null;
        $this->container['module_nrf'] = isset($data['module_nrf']) ? $data['module_nrf'] : null;
        $this->container['module_gtin'] = isset($data['module_gtin']) ? $data['module_gtin'] : null;
        $this->container['module_elproffen'] = isset($data['module_elproffen']) ? $data['module_elproffen'] : null;
        $this->container['module_rorkjop'] = isset($data['module_rorkjop']) ? $data['module_rorkjop'] : null;
        $this->container['module_order_ext'] = isset($data['module_order_ext']) ? $data['module_order_ext'] : null;
        $this->container['module_result_budget'] = isset($data['module_result_budget']) ? $data['module_result_budget'] : null;
        $this->container['module_amortization'] = isset($data['module_amortization']) ? $data['module_amortization'] : null;
        $this->container['module_change_debt_collector'] = isset($data['module_change_debt_collector']) ? $data['module_change_debt_collector'] : null;
        $this->container['module_voucher_types'] = isset($data['module_voucher_types']) ? $data['module_voucher_types'] : null;
        $this->container['module_onninen123'] = isset($data['module_onninen123']) ? $data['module_onninen123'] : null;
        $this->container['module_elektro_union'] = isset($data['module_elektro_union']) ? $data['module_elektro_union'] : null;
        $this->container['module_ahlsell_partner'] = isset($data['module_ahlsell_partner']) ? $data['module_ahlsell_partner'] : null;
        $this->container['module_archive'] = isset($data['module_archive']) ? $data['module_archive'] : null;
        $this->container['module_warehouse'] = isset($data['module_warehouse']) ? $data['module_warehouse'] : null;
        $this->container['module_project_budget_reference_fee'] = isset($data['module_project_budget_reference_fee']) ? $data['module_project_budget_reference_fee'] : null;
        $this->container['module_nets_eboks'] = isset($data['module_nets_eboks']) ? $data['module_nets_eboks'] : null;
        $this->container['module_nets_print_salary'] = isset($data['module_nets_print_salary']) ? $data['module_nets_print_salary'] : null;
        $this->container['module_nets_print_invoice'] = isset($data['module_nets_print_invoice']) ? $data['module_nets_print_invoice'] : null;
        $this->container['module_invoice_import'] = isset($data['module_invoice_import']) ? $data['module_invoice_import'] : null;
        $this->container['module_email'] = isset($data['module_email']) ? $data['module_email'] : null;
        $this->container['module_ocr_auto_pay'] = isset($data['module_ocr_auto_pay']) ? $data['module_ocr_auto_pay'] : null;
        $this->container['module_approve_voucher'] = isset($data['module_approve_voucher']) ? $data['module_approve_voucher'] : null;
        $this->container['module_approve_department_voucher'] = isset($data['module_approve_department_voucher']) ? $data['module_approve_department_voucher'] : null;
        $this->container['module_approve_project_voucher'] = isset($data['module_approve_project_voucher']) ? $data['module_approve_project_voucher'] : null;
        $this->container['module_order_out'] = isset($data['module_order_out']) ? $data['module_order_out'] : null;
        $this->container['module_mesan'] = isset($data['module_mesan']) ? $data['module_mesan'] : null;
        $this->container['module_divisions'] = isset($data['module_divisions']) ? $data['module_divisions'] : null;
        $this->container['module_boligmappa'] = isset($data['module_boligmappa']) ? $data['module_boligmappa'] : null;
        $this->container['module_addition_project_markup'] = isset($data['module_addition_project_markup']) ? $data['module_addition_project_markup'] : null;
        $this->container['module_wage_project_accounting'] = isset($data['module_wage_project_accounting']) ? $data['module_wage_project_accounting'] : null;
        $this->container['module_accountant_connect_client'] = isset($data['module_accountant_connect_client']) ? $data['module_accountant_connect_client'] : null;
        $this->container['module_wage_amortization'] = isset($data['module_wage_amortization']) ? $data['module_wage_amortization'] : null;
        $this->container['module_subscriptions_periodisation'] = isset($data['module_subscriptions_periodisation']) ? $data['module_subscriptions_periodisation'] : null;
        $this->container['module_activity_hourly_wage_wage_code'] = isset($data['module_activity_hourly_wage_wage_code']) ? $data['module_activity_hourly_wage_wage_code'] : null;
        $this->container['module_crm'] = isset($data['module_crm']) ? $data['module_crm'] : null;
        $this->container['module_api20'] = isset($data['module_api20']) ? $data['module_api20'] : null;
        $this->container['module_control_schema_required_invoicing'] = isset($data['module_control_schema_required_invoicing']) ? $data['module_control_schema_required_invoicing'] : null;
        $this->container['module_control_schema_required_hour_tracking'] = isset($data['module_control_schema_required_hour_tracking']) ? $data['module_control_schema_required_hour_tracking'] : null;
        $this->container['module_finance_tax'] = isset($data['module_finance_tax']) ? $data['module_finance_tax'] : null;
        $this->container['module_pensionreport'] = isset($data['module_pensionreport']) ? $data['module_pensionreport'] : null;
        $this->container['module_agro'] = isset($data['module_agro']) ? $data['module_agro'] : null;
        $this->container['module_mamut'] = isset($data['module_mamut']) ? $data['module_mamut'] : null;
        $this->container['module_invoice_option_paper'] = isset($data['module_invoice_option_paper']) ? $data['module_invoice_option_paper'] : null;
        $this->container['module_smart_scan'] = isset($data['module_smart_scan']) ? $data['module_smart_scan'] : null;
        $this->container['module_offer'] = isset($data['module_offer']) ? $data['module_offer'] : null;
        $this->container['module_auto_bank_reconciliation'] = isset($data['module_auto_bank_reconciliation']) ? $data['module_auto_bank_reconciliation'] : null;
        $this->container['module_voucher_automation'] = isset($data['module_voucher_automation']) ? $data['module_voucher_automation'] : null;
        $this->container['module_encrypted_pay_slip'] = isset($data['module_encrypted_pay_slip']) ? $data['module_encrypted_pay_slip'] : null;
        $this->container['module_invoice_option_vipps'] = isset($data['module_invoice_option_vipps']) ? $data['module_invoice_option_vipps'] : null;
        $this->container['module_invoice_option_efaktura'] = isset($data['module_invoice_option_efaktura']) ? $data['module_invoice_option_efaktura'] : null;
        $this->container['module_invoice_option_avtale_giro'] = isset($data['module_invoice_option_avtale_giro']) ? $data['module_invoice_option_avtale_giro'] : null;
        $this->container['module_factoring_aprila'] = isset($data['module_factoring_aprila']) ? $data['module_factoring_aprila'] : null;
        $this->container['module_factoring_visma_finance'] = isset($data['module_factoring_visma_finance']) ? $data['module_factoring_visma_finance'] : null;
        $this->container['module_cash_credit_aprila'] = isset($data['module_cash_credit_aprila']) ? $data['module_cash_credit_aprila'] : null;
        $this->container['module_invoice_option_autoinvoice_ehf'] = isset($data['module_invoice_option_autoinvoice_ehf']) ? $data['module_invoice_option_autoinvoice_ehf'] : null;
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
                "invalid value for 'module_factoring_visma_finance', must be one of '%s'",
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
     * Gets company_id
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int $company_id company_id
     *
     * @return $this
     */
    public function setCompanyId($company_id)
    {
        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets modulehourlist
     *
     * @return bool
     */
    public function getModulehourlist()
    {
        return $this->container['modulehourlist'];
    }

    /**
     * Sets modulehourlist
     *
     * @param bool $modulehourlist modulehourlist
     *
     * @return $this
     */
    public function setModulehourlist($modulehourlist)
    {
        $this->container['modulehourlist'] = $modulehourlist;

        return $this;
    }

    /**
     * Gets module_travel_expense
     *
     * @return bool
     */
    public function getModuleTravelExpense()
    {
        return $this->container['module_travel_expense'];
    }

    /**
     * Sets module_travel_expense
     *
     * @param bool $module_travel_expense module_travel_expense
     *
     * @return $this
     */
    public function setModuleTravelExpense($module_travel_expense)
    {
        $this->container['module_travel_expense'] = $module_travel_expense;

        return $this;
    }

    /**
     * Gets module_invoice
     *
     * @return bool
     */
    public function getModuleInvoice()
    {
        return $this->container['module_invoice'];
    }

    /**
     * Sets module_invoice
     *
     * @param bool $module_invoice module_invoice
     *
     * @return $this
     */
    public function setModuleInvoice($module_invoice)
    {
        $this->container['module_invoice'] = $module_invoice;

        return $this;
    }

    /**
     * Gets moduleaccountinginternal
     *
     * @return bool
     */
    public function getModuleaccountinginternal()
    {
        return $this->container['moduleaccountinginternal'];
    }

    /**
     * Sets moduleaccountinginternal
     *
     * @param bool $moduleaccountinginternal moduleaccountinginternal
     *
     * @return $this
     */
    public function setModuleaccountinginternal($moduleaccountinginternal)
    {
        $this->container['moduleaccountinginternal'] = $moduleaccountinginternal;

        return $this;
    }

    /**
     * Gets module_accounting_external
     *
     * @return bool
     */
    public function getModuleAccountingExternal()
    {
        return $this->container['module_accounting_external'];
    }

    /**
     * Sets module_accounting_external
     *
     * @param bool $module_accounting_external module_accounting_external
     *
     * @return $this
     */
    public function setModuleAccountingExternal($module_accounting_external)
    {
        $this->container['module_accounting_external'] = $module_accounting_external;

        return $this;
    }

    /**
     * Gets moduleproject
     *
     * @return bool
     */
    public function getModuleproject()
    {
        return $this->container['moduleproject'];
    }

    /**
     * Sets moduleproject
     *
     * @param bool $moduleproject moduleproject
     *
     * @return $this
     */
    public function setModuleproject($moduleproject)
    {
        $this->container['moduleproject'] = $moduleproject;

        return $this;
    }

    /**
     * Gets moduleproduct
     *
     * @return bool
     */
    public function getModuleproduct()
    {
        return $this->container['moduleproduct'];
    }

    /**
     * Sets moduleproduct
     *
     * @param bool $moduleproduct moduleproduct
     *
     * @return $this
     */
    public function setModuleproduct($moduleproduct)
    {
        $this->container['moduleproduct'] = $moduleproduct;

        return $this;
    }

    /**
     * Gets modulecustomer
     *
     * @return bool
     */
    public function getModulecustomer()
    {
        return $this->container['modulecustomer'];
    }

    /**
     * Sets modulecustomer
     *
     * @param bool $modulecustomer modulecustomer
     *
     * @return $this
     */
    public function setModulecustomer($modulecustomer)
    {
        $this->container['modulecustomer'] = $modulecustomer;

        return $this;
    }

    /**
     * Gets moduleemployee
     *
     * @return bool
     */
    public function getModuleemployee()
    {
        return $this->container['moduleemployee'];
    }

    /**
     * Sets moduleemployee
     *
     * @param bool $moduleemployee moduleemployee
     *
     * @return $this
     */
    public function setModuleemployee($moduleemployee)
    {
        $this->container['moduleemployee'] = $moduleemployee;

        return $this;
    }

    /**
     * Gets moduledepartment
     *
     * @return bool
     */
    public function getModuledepartment()
    {
        return $this->container['moduledepartment'];
    }

    /**
     * Sets moduledepartment
     *
     * @param bool $moduledepartment moduledepartment
     *
     * @return $this
     */
    public function setModuledepartment($moduledepartment)
    {
        $this->container['moduledepartment'] = $moduledepartment;

        return $this;
    }

    /**
     * Gets approveinvoices
     *
     * @return bool
     */
    public function getApproveinvoices()
    {
        return $this->container['approveinvoices'];
    }

    /**
     * Sets approveinvoices
     *
     * @param bool $approveinvoices approveinvoices
     *
     * @return $this
     */
    public function setApproveinvoices($approveinvoices)
    {
        $this->container['approveinvoices'] = $approveinvoices;

        return $this;
    }

    /**
     * Gets approvehourlists
     *
     * @return bool
     */
    public function getApprovehourlists()
    {
        return $this->container['approvehourlists'];
    }

    /**
     * Sets approvehourlists
     *
     * @param bool $approvehourlists approvehourlists
     *
     * @return $this
     */
    public function setApprovehourlists($approvehourlists)
    {
        $this->container['approvehourlists'] = $approvehourlists;

        return $this;
    }

    /**
     * Gets approvetravelreports
     *
     * @return bool
     */
    public function getApprovetravelreports()
    {
        return $this->container['approvetravelreports'];
    }

    /**
     * Sets approvetravelreports
     *
     * @param bool $approvetravelreports approvetravelreports
     *
     * @return $this
     */
    public function setApprovetravelreports($approvetravelreports)
    {
        $this->container['approvetravelreports'] = $approvetravelreports;

        return $this;
    }

    /**
     * Gets modulebudget
     *
     * @return bool
     */
    public function getModulebudget()
    {
        return $this->container['modulebudget'];
    }

    /**
     * Sets modulebudget
     *
     * @param bool $modulebudget modulebudget
     *
     * @return $this
     */
    public function setModulebudget($modulebudget)
    {
        $this->container['modulebudget'] = $modulebudget;

        return $this;
    }

    /**
     * Gets modulenote
     *
     * @return bool
     */
    public function getModulenote()
    {
        return $this->container['modulenote'];
    }

    /**
     * Sets modulenote
     *
     * @param bool $modulenote modulenote
     *
     * @return $this
     */
    public function setModulenote($modulenote)
    {
        $this->container['modulenote'] = $modulenote;

        return $this;
    }

    /**
     * Gets moduletask
     *
     * @return bool
     */
    public function getModuletask()
    {
        return $this->container['moduletask'];
    }

    /**
     * Sets moduletask
     *
     * @param bool $moduletask moduletask
     *
     * @return $this
     */
    public function setModuletask($moduletask)
    {
        $this->container['moduletask'] = $moduletask;

        return $this;
    }

    /**
     * Gets moduleresourceallocation
     *
     * @return bool
     */
    public function getModuleresourceallocation()
    {
        return $this->container['moduleresourceallocation'];
    }

    /**
     * Sets moduleresourceallocation
     *
     * @param bool $moduleresourceallocation moduleresourceallocation
     *
     * @return $this
     */
    public function setModuleresourceallocation($moduleresourceallocation)
    {
        $this->container['moduleresourceallocation'] = $moduleresourceallocation;

        return $this;
    }

    /**
     * Gets moduleprojecteconomy
     *
     * @return bool
     */
    public function getModuleprojecteconomy()
    {
        return $this->container['moduleprojecteconomy'];
    }

    /**
     * Sets moduleprojecteconomy
     *
     * @param bool $moduleprojecteconomy moduleprojecteconomy
     *
     * @return $this
     */
    public function setModuleprojecteconomy($moduleprojecteconomy)
    {
        $this->container['moduleprojecteconomy'] = $moduleprojecteconomy;

        return $this;
    }

    /**
     * Gets modulereferencefee
     *
     * @return bool
     */
    public function getModulereferencefee()
    {
        return $this->container['modulereferencefee'];
    }

    /**
     * Sets modulereferencefee
     *
     * @param bool $modulereferencefee modulereferencefee
     *
     * @return $this
     */
    public function setModulereferencefee($modulereferencefee)
    {
        $this->container['modulereferencefee'] = $modulereferencefee;

        return $this;
    }

    /**
     * Gets modulehistorical
     *
     * @return bool
     */
    public function getModulehistorical()
    {
        return $this->container['modulehistorical'];
    }

    /**
     * Sets modulehistorical
     *
     * @param bool $modulehistorical modulehistorical
     *
     * @return $this
     */
    public function setModulehistorical($modulehistorical)
    {
        $this->container['modulehistorical'] = $modulehistorical;

        return $this;
    }

    /**
     * Gets moduleprojectcategory
     *
     * @return bool
     */
    public function getModuleprojectcategory()
    {
        return $this->container['moduleprojectcategory'];
    }

    /**
     * Sets moduleprojectcategory
     *
     * @param bool $moduleprojectcategory moduleprojectcategory
     *
     * @return $this
     */
    public function setModuleprojectcategory($moduleprojectcategory)
    {
        $this->container['moduleprojectcategory'] = $moduleprojectcategory;

        return $this;
    }

    /**
     * Gets moduleprojectlocation
     *
     * @return bool
     */
    public function getModuleprojectlocation()
    {
        return $this->container['moduleprojectlocation'];
    }

    /**
     * Sets moduleprojectlocation
     *
     * @param bool $moduleprojectlocation moduleprojectlocation
     *
     * @return $this
     */
    public function setModuleprojectlocation($moduleprojectlocation)
    {
        $this->container['moduleprojectlocation'] = $moduleprojectlocation;

        return $this;
    }

    /**
     * Gets module_project_budget
     *
     * @return bool
     */
    public function getModuleProjectBudget()
    {
        return $this->container['module_project_budget'];
    }

    /**
     * Sets module_project_budget
     *
     * @param bool $module_project_budget module_project_budget
     *
     * @return $this
     */
    public function setModuleProjectBudget($module_project_budget)
    {
        $this->container['module_project_budget'] = $module_project_budget;

        return $this;
    }

    /**
     * Gets modulesubscription
     *
     * @return bool
     */
    public function getModulesubscription()
    {
        return $this->container['modulesubscription'];
    }

    /**
     * Sets modulesubscription
     *
     * @param bool $modulesubscription modulesubscription
     *
     * @return $this
     */
    public function setModulesubscription($modulesubscription)
    {
        $this->container['modulesubscription'] = $modulesubscription;

        return $this;
    }

    /**
     * Gets completeweeklyhourlists
     *
     * @return bool
     */
    public function getCompleteweeklyhourlists()
    {
        return $this->container['completeweeklyhourlists'];
    }

    /**
     * Sets completeweeklyhourlists
     *
     * @param bool $completeweeklyhourlists completeweeklyhourlists
     *
     * @return $this
     */
    public function setCompleteweeklyhourlists($completeweeklyhourlists)
    {
        $this->container['completeweeklyhourlists'] = $completeweeklyhourlists;

        return $this;
    }

    /**
     * Gets completemonthlyhourlists
     *
     * @return bool
     */
    public function getCompletemonthlyhourlists()
    {
        return $this->container['completemonthlyhourlists'];
    }

    /**
     * Sets completemonthlyhourlists
     *
     * @param bool $completemonthlyhourlists completemonthlyhourlists
     *
     * @return $this
     */
    public function setCompletemonthlyhourlists($completemonthlyhourlists)
    {
        $this->container['completemonthlyhourlists'] = $completemonthlyhourlists;

        return $this;
    }

    /**
     * Gets approvemonthlyhourlists
     *
     * @return bool
     */
    public function getApprovemonthlyhourlists()
    {
        return $this->container['approvemonthlyhourlists'];
    }

    /**
     * Sets approvemonthlyhourlists
     *
     * @param bool $approvemonthlyhourlists approvemonthlyhourlists
     *
     * @return $this
     */
    public function setApprovemonthlyhourlists($approvemonthlyhourlists)
    {
        $this->container['approvemonthlyhourlists'] = $approvemonthlyhourlists;

        return $this;
    }

    /**
     * Gets moduleprojectprognosis
     *
     * @return bool
     */
    public function getModuleprojectprognosis()
    {
        return $this->container['moduleprojectprognosis'];
    }

    /**
     * Sets moduleprojectprognosis
     *
     * @param bool $moduleprojectprognosis moduleprojectprognosis
     *
     * @return $this
     */
    public function setModuleprojectprognosis($moduleprojectprognosis)
    {
        $this->container['moduleprojectprognosis'] = $moduleprojectprognosis;

        return $this;
    }

    /**
     * Gets modulebunches
     *
     * @return bool
     */
    public function getModulebunches()
    {
        return $this->container['modulebunches'];
    }

    /**
     * Sets modulebunches
     *
     * @param bool $modulebunches modulebunches
     *
     * @return $this
     */
    public function setModulebunches($modulebunches)
    {
        $this->container['modulebunches'] = $modulebunches;

        return $this;
    }

    /**
     * Gets module_vacation_balance
     *
     * @return bool
     */
    public function getModuleVacationBalance()
    {
        return $this->container['module_vacation_balance'];
    }

    /**
     * Sets module_vacation_balance
     *
     * @param bool $module_vacation_balance module_vacation_balance
     *
     * @return $this
     */
    public function setModuleVacationBalance($module_vacation_balance)
    {
        $this->container['module_vacation_balance'] = $module_vacation_balance;

        return $this;
    }

    /**
     * Gets module_accounting_reports
     *
     * @return bool
     */
    public function getModuleAccountingReports()
    {
        return $this->container['module_accounting_reports'];
    }

    /**
     * Sets module_accounting_reports
     *
     * @param bool $module_accounting_reports module_accounting_reports
     *
     * @return $this
     */
    public function setModuleAccountingReports($module_accounting_reports)
    {
        $this->container['module_accounting_reports'] = $module_accounting_reports;

        return $this;
    }

    /**
     * Gets module_customer_categories
     *
     * @return bool
     */
    public function getModuleCustomerCategories()
    {
        return $this->container['module_customer_categories'];
    }

    /**
     * Sets module_customer_categories
     *
     * @param bool $module_customer_categories module_customer_categories
     *
     * @return $this
     */
    public function setModuleCustomerCategories($module_customer_categories)
    {
        $this->container['module_customer_categories'] = $module_customer_categories;

        return $this;
    }

    /**
     * Gets module_customer_category1
     *
     * @return bool
     */
    public function getModuleCustomerCategory1()
    {
        return $this->container['module_customer_category1'];
    }

    /**
     * Sets module_customer_category1
     *
     * @param bool $module_customer_category1 module_customer_category1
     *
     * @return $this
     */
    public function setModuleCustomerCategory1($module_customer_category1)
    {
        $this->container['module_customer_category1'] = $module_customer_category1;

        return $this;
    }

    /**
     * Gets module_customer_category2
     *
     * @return bool
     */
    public function getModuleCustomerCategory2()
    {
        return $this->container['module_customer_category2'];
    }

    /**
     * Sets module_customer_category2
     *
     * @param bool $module_customer_category2 module_customer_category2
     *
     * @return $this
     */
    public function setModuleCustomerCategory2($module_customer_category2)
    {
        $this->container['module_customer_category2'] = $module_customer_category2;

        return $this;
    }

    /**
     * Gets module_customer_category3
     *
     * @return bool
     */
    public function getModuleCustomerCategory3()
    {
        return $this->container['module_customer_category3'];
    }

    /**
     * Sets module_customer_category3
     *
     * @param bool $module_customer_category3 module_customer_category3
     *
     * @return $this
     */
    public function setModuleCustomerCategory3($module_customer_category3)
    {
        $this->container['module_customer_category3'] = $module_customer_category3;

        return $this;
    }

    /**
     * Gets moduleprojectsubcontract
     *
     * @return bool
     */
    public function getModuleprojectsubcontract()
    {
        return $this->container['moduleprojectsubcontract'];
    }

    /**
     * Sets moduleprojectsubcontract
     *
     * @param bool $moduleprojectsubcontract moduleprojectsubcontract
     *
     * @return $this
     */
    public function setModuleprojectsubcontract($moduleprojectsubcontract)
    {
        $this->container['moduleprojectsubcontract'] = $moduleprojectsubcontract;

        return $this;
    }

    /**
     * Gets module_payroll_accounting
     *
     * @return bool
     */
    public function getModulePayrollAccounting()
    {
        return $this->container['module_payroll_accounting'];
    }

    /**
     * Sets module_payroll_accounting
     *
     * @param bool $module_payroll_accounting module_payroll_accounting
     *
     * @return $this
     */
    public function setModulePayrollAccounting($module_payroll_accounting)
    {
        $this->container['module_payroll_accounting'] = $module_payroll_accounting;

        return $this;
    }

    /**
     * Gets module_time_balance
     *
     * @return bool
     */
    public function getModuleTimeBalance()
    {
        return $this->container['module_time_balance'];
    }

    /**
     * Sets module_time_balance
     *
     * @param bool $module_time_balance module_time_balance
     *
     * @return $this
     */
    public function setModuleTimeBalance($module_time_balance)
    {
        $this->container['module_time_balance'] = $module_time_balance;

        return $this;
    }

    /**
     * Gets module_working_hours
     *
     * @return bool
     */
    public function getModuleWorkingHours()
    {
        return $this->container['module_working_hours'];
    }

    /**
     * Sets module_working_hours
     *
     * @param bool $module_working_hours module_working_hours
     *
     * @return $this
     */
    public function setModuleWorkingHours($module_working_hours)
    {
        $this->container['module_working_hours'] = $module_working_hours;

        return $this;
    }

    /**
     * Gets module_currency
     *
     * @return bool
     */
    public function getModuleCurrency()
    {
        return $this->container['module_currency'];
    }

    /**
     * Sets module_currency
     *
     * @param bool $module_currency module_currency
     *
     * @return $this
     */
    public function setModuleCurrency($module_currency)
    {
        $this->container['module_currency'] = $module_currency;

        return $this;
    }

    /**
     * Gets module_wage_export
     *
     * @return bool
     */
    public function getModuleWageExport()
    {
        return $this->container['module_wage_export'];
    }

    /**
     * Sets module_wage_export
     *
     * @param bool $module_wage_export module_wage_export
     *
     * @return $this
     */
    public function setModuleWageExport($module_wage_export)
    {
        $this->container['module_wage_export'] = $module_wage_export;

        return $this;
    }

    /**
     * Gets module_auto_customer_number
     *
     * @return bool
     */
    public function getModuleAutoCustomerNumber()
    {
        return $this->container['module_auto_customer_number'];
    }

    /**
     * Sets module_auto_customer_number
     *
     * @param bool $module_auto_customer_number module_auto_customer_number
     *
     * @return $this
     */
    public function setModuleAutoCustomerNumber($module_auto_customer_number)
    {
        $this->container['module_auto_customer_number'] = $module_auto_customer_number;

        return $this;
    }

    /**
     * Gets module_auto_vendor_number
     *
     * @return bool
     */
    public function getModuleAutoVendorNumber()
    {
        return $this->container['module_auto_vendor_number'];
    }

    /**
     * Sets module_auto_vendor_number
     *
     * @param bool $module_auto_vendor_number module_auto_vendor_number
     *
     * @return $this
     */
    public function setModuleAutoVendorNumber($module_auto_vendor_number)
    {
        $this->container['module_auto_vendor_number'] = $module_auto_vendor_number;

        return $this;
    }

    /**
     * Gets module_provision_salary
     *
     * @return bool
     */
    public function getModuleProvisionSalary()
    {
        return $this->container['module_provision_salary'];
    }

    /**
     * Sets module_provision_salary
     *
     * @param bool $module_provision_salary module_provision_salary
     *
     * @return $this
     */
    public function setModuleProvisionSalary($module_provision_salary)
    {
        $this->container['module_provision_salary'] = $module_provision_salary;

        return $this;
    }

    /**
     * Gets module_order_number
     *
     * @return bool
     */
    public function getModuleOrderNumber()
    {
        return $this->container['module_order_number'];
    }

    /**
     * Sets module_order_number
     *
     * @param bool $module_order_number module_order_number
     *
     * @return $this
     */
    public function setModuleOrderNumber($module_order_number)
    {
        $this->container['module_order_number'] = $module_order_number;

        return $this;
    }

    /**
     * Gets module_order_discount
     *
     * @return bool
     */
    public function getModuleOrderDiscount()
    {
        return $this->container['module_order_discount'];
    }

    /**
     * Sets module_order_discount
     *
     * @param bool $module_order_discount module_order_discount
     *
     * @return $this
     */
    public function setModuleOrderDiscount($module_order_discount)
    {
        $this->container['module_order_discount'] = $module_order_discount;

        return $this;
    }

    /**
     * Gets module_order_markup
     *
     * @return bool
     */
    public function getModuleOrderMarkup()
    {
        return $this->container['module_order_markup'];
    }

    /**
     * Sets module_order_markup
     *
     * @param bool $module_order_markup module_order_markup
     *
     * @return $this
     */
    public function setModuleOrderMarkup($module_order_markup)
    {
        $this->container['module_order_markup'] = $module_order_markup;

        return $this;
    }

    /**
     * Gets module_order_line_cost
     *
     * @return bool
     */
    public function getModuleOrderLineCost()
    {
        return $this->container['module_order_line_cost'];
    }

    /**
     * Sets module_order_line_cost
     *
     * @param bool $module_order_line_cost module_order_line_cost
     *
     * @return $this
     */
    public function setModuleOrderLineCost($module_order_line_cost)
    {
        $this->container['module_order_line_cost'] = $module_order_line_cost;

        return $this;
    }

    /**
     * Gets module_stop_watch
     *
     * @return bool
     */
    public function getModuleStopWatch()
    {
        return $this->container['module_stop_watch'];
    }

    /**
     * Sets module_stop_watch
     *
     * @param bool $module_stop_watch module_stop_watch
     *
     * @return $this
     */
    public function setModuleStopWatch($module_stop_watch)
    {
        $this->container['module_stop_watch'] = $module_stop_watch;

        return $this;
    }

    /**
     * Gets module_contact
     *
     * @return bool
     */
    public function getModuleContact()
    {
        return $this->container['module_contact'];
    }

    /**
     * Sets module_contact
     *
     * @param bool $module_contact module_contact
     *
     * @return $this
     */
    public function setModuleContact($module_contact)
    {
        $this->container['module_contact'] = $module_contact;

        return $this;
    }

    /**
     * Gets module_auto_project_number
     *
     * @return bool
     */
    public function getModuleAutoProjectNumber()
    {
        return $this->container['module_auto_project_number'];
    }

    /**
     * Sets module_auto_project_number
     *
     * @param bool $module_auto_project_number module_auto_project_number
     *
     * @return $this
     */
    public function setModuleAutoProjectNumber($module_auto_project_number)
    {
        $this->container['module_auto_project_number'] = $module_auto_project_number;

        return $this;
    }

    /**
     * Gets module_swedish
     *
     * @return bool
     */
    public function getModuleSwedish()
    {
        return $this->container['module_swedish'];
    }

    /**
     * Sets module_swedish
     *
     * @param bool $module_swedish module_swedish
     *
     * @return $this
     */
    public function setModuleSwedish($module_swedish)
    {
        $this->container['module_swedish'] = $module_swedish;

        return $this;
    }

    /**
     * Gets module_resource_groups
     *
     * @return bool
     */
    public function getModuleResourceGroups()
    {
        return $this->container['module_resource_groups'];
    }

    /**
     * Sets module_resource_groups
     *
     * @param bool $module_resource_groups module_resource_groups
     *
     * @return $this
     */
    public function setModuleResourceGroups($module_resource_groups)
    {
        $this->container['module_resource_groups'] = $module_resource_groups;

        return $this;
    }

    /**
     * Gets module_ocr
     *
     * @return bool
     */
    public function getModuleOcr()
    {
        return $this->container['module_ocr'];
    }

    /**
     * Sets module_ocr
     *
     * @param bool $module_ocr module_ocr
     *
     * @return $this
     */
    public function setModuleOcr($module_ocr)
    {
        $this->container['module_ocr'] = $module_ocr;

        return $this;
    }

    /**
     * Gets module_travel_expense_rates
     *
     * @return bool
     */
    public function getModuleTravelExpenseRates()
    {
        return $this->container['module_travel_expense_rates'];
    }

    /**
     * Sets module_travel_expense_rates
     *
     * @param bool $module_travel_expense_rates module_travel_expense_rates
     *
     * @return $this
     */
    public function setModuleTravelExpenseRates($module_travel_expense_rates)
    {
        $this->container['module_travel_expense_rates'] = $module_travel_expense_rates;

        return $this;
    }

    /**
     * Gets monthly_hourlist_minus_time_warning
     *
     * @return bool
     */
    public function getMonthlyHourlistMinusTimeWarning()
    {
        return $this->container['monthly_hourlist_minus_time_warning'];
    }

    /**
     * Sets monthly_hourlist_minus_time_warning
     *
     * @param bool $monthly_hourlist_minus_time_warning monthly_hourlist_minus_time_warning
     *
     * @return $this
     */
    public function setMonthlyHourlistMinusTimeWarning($monthly_hourlist_minus_time_warning)
    {
        $this->container['monthly_hourlist_minus_time_warning'] = $monthly_hourlist_minus_time_warning;

        return $this;
    }

    /**
     * Gets module_voucher_scanning
     *
     * @return bool
     */
    public function getModuleVoucherScanning()
    {
        return $this->container['module_voucher_scanning'];
    }

    /**
     * Sets module_voucher_scanning
     *
     * @param bool $module_voucher_scanning module_voucher_scanning
     *
     * @return $this
     */
    public function setModuleVoucherScanning($module_voucher_scanning)
    {
        $this->container['module_voucher_scanning'] = $module_voucher_scanning;

        return $this;
    }

    /**
     * Gets module_invoice_scanning
     *
     * @return bool
     */
    public function getModuleInvoiceScanning()
    {
        return $this->container['module_invoice_scanning'];
    }

    /**
     * Sets module_invoice_scanning
     *
     * @param bool $module_invoice_scanning module_invoice_scanning
     *
     * @return $this
     */
    public function setModuleInvoiceScanning($module_invoice_scanning)
    {
        $this->container['module_invoice_scanning'] = $module_invoice_scanning;

        return $this;
    }

    /**
     * Gets module_project_participants
     *
     * @return bool
     */
    public function getModuleProjectParticipants()
    {
        return $this->container['module_project_participants'];
    }

    /**
     * Sets module_project_participants
     *
     * @param bool $module_project_participants module_project_participants
     *
     * @return $this
     */
    public function setModuleProjectParticipants($module_project_participants)
    {
        $this->container['module_project_participants'] = $module_project_participants;

        return $this;
    }

    /**
     * Gets module_holyday_plan
     *
     * @return bool
     */
    public function getModuleHolydayPlan()
    {
        return $this->container['module_holyday_plan'];
    }

    /**
     * Sets module_holyday_plan
     *
     * @param bool $module_holyday_plan module_holyday_plan
     *
     * @return $this
     */
    public function setModuleHolydayPlan($module_holyday_plan)
    {
        $this->container['module_holyday_plan'] = $module_holyday_plan;

        return $this;
    }

    /**
     * Gets module_employee_category
     *
     * @return bool
     */
    public function getModuleEmployeeCategory()
    {
        return $this->container['module_employee_category'];
    }

    /**
     * Sets module_employee_category
     *
     * @param bool $module_employee_category module_employee_category
     *
     * @return $this
     */
    public function setModuleEmployeeCategory($module_employee_category)
    {
        $this->container['module_employee_category'] = $module_employee_category;

        return $this;
    }

    /**
     * Gets module_product_invoice
     *
     * @return bool
     */
    public function getModuleProductInvoice()
    {
        return $this->container['module_product_invoice'];
    }

    /**
     * Sets module_product_invoice
     *
     * @param bool $module_product_invoice module_product_invoice
     *
     * @return $this
     */
    public function setModuleProductInvoice($module_product_invoice)
    {
        $this->container['module_product_invoice'] = $module_product_invoice;

        return $this;
    }

    /**
     * Gets auto_invoicing
     *
     * @return bool
     */
    public function getAutoInvoicing()
    {
        return $this->container['auto_invoicing'];
    }

    /**
     * Sets auto_invoicing
     *
     * @param bool $auto_invoicing auto_invoicing
     *
     * @return $this
     */
    public function setAutoInvoicing($auto_invoicing)
    {
        $this->container['auto_invoicing'] = $auto_invoicing;

        return $this;
    }

    /**
     * Gets module_invoice_fee_comment
     *
     * @return bool
     */
    public function getModuleInvoiceFeeComment()
    {
        return $this->container['module_invoice_fee_comment'];
    }

    /**
     * Sets module_invoice_fee_comment
     *
     * @param bool $module_invoice_fee_comment module_invoice_fee_comment
     *
     * @return $this
     */
    public function setModuleInvoiceFeeComment($module_invoice_fee_comment)
    {
        $this->container['module_invoice_fee_comment'] = $module_invoice_fee_comment;

        return $this;
    }

    /**
     * Gets module_employee_accounting
     *
     * @return bool
     */
    public function getModuleEmployeeAccounting()
    {
        return $this->container['module_employee_accounting'];
    }

    /**
     * Sets module_employee_accounting
     *
     * @param bool $module_employee_accounting module_employee_accounting
     *
     * @return $this
     */
    public function setModuleEmployeeAccounting($module_employee_accounting)
    {
        $this->container['module_employee_accounting'] = $module_employee_accounting;

        return $this;
    }

    /**
     * Gets module_department_accounting
     *
     * @return bool
     */
    public function getModuleDepartmentAccounting()
    {
        return $this->container['module_department_accounting'];
    }

    /**
     * Sets module_department_accounting
     *
     * @param bool $module_department_accounting module_department_accounting
     *
     * @return $this
     */
    public function setModuleDepartmentAccounting($module_department_accounting)
    {
        $this->container['module_department_accounting'] = $module_department_accounting;

        return $this;
    }

    /**
     * Gets module_project_accounting
     *
     * @return bool
     */
    public function getModuleProjectAccounting()
    {
        return $this->container['module_project_accounting'];
    }

    /**
     * Sets module_project_accounting
     *
     * @param bool $module_project_accounting module_project_accounting
     *
     * @return $this
     */
    public function setModuleProjectAccounting($module_project_accounting)
    {
        $this->container['module_project_accounting'] = $module_project_accounting;

        return $this;
    }

    /**
     * Gets module_product_accounting
     *
     * @return bool
     */
    public function getModuleProductAccounting()
    {
        return $this->container['module_product_accounting'];
    }

    /**
     * Sets module_product_accounting
     *
     * @param bool $module_product_accounting module_product_accounting
     *
     * @return $this
     */
    public function setModuleProductAccounting($module_product_accounting)
    {
        $this->container['module_product_accounting'] = $module_product_accounting;

        return $this;
    }

    /**
     * Gets module_subscription_address_list
     *
     * @return bool
     */
    public function getModuleSubscriptionAddressList()
    {
        return $this->container['module_subscription_address_list'];
    }

    /**
     * Sets module_subscription_address_list
     *
     * @param bool $module_subscription_address_list module_subscription_address_list
     *
     * @return $this
     */
    public function setModuleSubscriptionAddressList($module_subscription_address_list)
    {
        $this->container['module_subscription_address_list'] = $module_subscription_address_list;

        return $this;
    }

    /**
     * Gets module_electro
     *
     * @return bool
     */
    public function getModuleElectro()
    {
        return $this->container['module_electro'];
    }

    /**
     * Sets module_electro
     *
     * @param bool $module_electro module_electro
     *
     * @return $this
     */
    public function setModuleElectro($module_electro)
    {
        $this->container['module_electro'] = $module_electro;

        return $this;
    }

    /**
     * Gets module_nrf
     *
     * @return bool
     */
    public function getModuleNrf()
    {
        return $this->container['module_nrf'];
    }

    /**
     * Sets module_nrf
     *
     * @param bool $module_nrf module_nrf
     *
     * @return $this
     */
    public function setModuleNrf($module_nrf)
    {
        $this->container['module_nrf'] = $module_nrf;

        return $this;
    }

    /**
     * Gets module_gtin
     *
     * @return bool
     */
    public function getModuleGtin()
    {
        return $this->container['module_gtin'];
    }

    /**
     * Sets module_gtin
     *
     * @param bool $module_gtin module_gtin
     *
     * @return $this
     */
    public function setModuleGtin($module_gtin)
    {
        $this->container['module_gtin'] = $module_gtin;

        return $this;
    }

    /**
     * Gets module_elproffen
     *
     * @return bool
     */
    public function getModuleElproffen()
    {
        return $this->container['module_elproffen'];
    }

    /**
     * Sets module_elproffen
     *
     * @param bool $module_elproffen module_elproffen
     *
     * @return $this
     */
    public function setModuleElproffen($module_elproffen)
    {
        $this->container['module_elproffen'] = $module_elproffen;

        return $this;
    }

    /**
     * Gets module_rorkjop
     *
     * @return bool
     */
    public function getModuleRorkjop()
    {
        return $this->container['module_rorkjop'];
    }

    /**
     * Sets module_rorkjop
     *
     * @param bool $module_rorkjop module_rorkjop
     *
     * @return $this
     */
    public function setModuleRorkjop($module_rorkjop)
    {
        $this->container['module_rorkjop'] = $module_rorkjop;

        return $this;
    }

    /**
     * Gets module_order_ext
     *
     * @return bool
     */
    public function getModuleOrderExt()
    {
        return $this->container['module_order_ext'];
    }

    /**
     * Sets module_order_ext
     *
     * @param bool $module_order_ext module_order_ext
     *
     * @return $this
     */
    public function setModuleOrderExt($module_order_ext)
    {
        $this->container['module_order_ext'] = $module_order_ext;

        return $this;
    }

    /**
     * Gets module_result_budget
     *
     * @return bool
     */
    public function getModuleResultBudget()
    {
        return $this->container['module_result_budget'];
    }

    /**
     * Sets module_result_budget
     *
     * @param bool $module_result_budget module_result_budget
     *
     * @return $this
     */
    public function setModuleResultBudget($module_result_budget)
    {
        $this->container['module_result_budget'] = $module_result_budget;

        return $this;
    }

    /**
     * Gets module_amortization
     *
     * @return bool
     */
    public function getModuleAmortization()
    {
        return $this->container['module_amortization'];
    }

    /**
     * Sets module_amortization
     *
     * @param bool $module_amortization module_amortization
     *
     * @return $this
     */
    public function setModuleAmortization($module_amortization)
    {
        $this->container['module_amortization'] = $module_amortization;

        return $this;
    }

    /**
     * Gets module_change_debt_collector
     *
     * @return bool
     */
    public function getModuleChangeDebtCollector()
    {
        return $this->container['module_change_debt_collector'];
    }

    /**
     * Sets module_change_debt_collector
     *
     * @param bool $module_change_debt_collector module_change_debt_collector
     *
     * @return $this
     */
    public function setModuleChangeDebtCollector($module_change_debt_collector)
    {
        $this->container['module_change_debt_collector'] = $module_change_debt_collector;

        return $this;
    }

    /**
     * Gets module_voucher_types
     *
     * @return bool
     */
    public function getModuleVoucherTypes()
    {
        return $this->container['module_voucher_types'];
    }

    /**
     * Sets module_voucher_types
     *
     * @param bool $module_voucher_types module_voucher_types
     *
     * @return $this
     */
    public function setModuleVoucherTypes($module_voucher_types)
    {
        $this->container['module_voucher_types'] = $module_voucher_types;

        return $this;
    }

    /**
     * Gets module_onninen123
     *
     * @return bool
     */
    public function getModuleOnninen123()
    {
        return $this->container['module_onninen123'];
    }

    /**
     * Sets module_onninen123
     *
     * @param bool $module_onninen123 module_onninen123
     *
     * @return $this
     */
    public function setModuleOnninen123($module_onninen123)
    {
        $this->container['module_onninen123'] = $module_onninen123;

        return $this;
    }

    /**
     * Gets module_elektro_union
     *
     * @return bool
     */
    public function getModuleElektroUnion()
    {
        return $this->container['module_elektro_union'];
    }

    /**
     * Sets module_elektro_union
     *
     * @param bool $module_elektro_union module_elektro_union
     *
     * @return $this
     */
    public function setModuleElektroUnion($module_elektro_union)
    {
        $this->container['module_elektro_union'] = $module_elektro_union;

        return $this;
    }

    /**
     * Gets module_ahlsell_partner
     *
     * @return bool
     */
    public function getModuleAhlsellPartner()
    {
        return $this->container['module_ahlsell_partner'];
    }

    /**
     * Sets module_ahlsell_partner
     *
     * @param bool $module_ahlsell_partner module_ahlsell_partner
     *
     * @return $this
     */
    public function setModuleAhlsellPartner($module_ahlsell_partner)
    {
        $this->container['module_ahlsell_partner'] = $module_ahlsell_partner;

        return $this;
    }

    /**
     * Gets module_archive
     *
     * @return bool
     */
    public function getModuleArchive()
    {
        return $this->container['module_archive'];
    }

    /**
     * Sets module_archive
     *
     * @param bool $module_archive module_archive
     *
     * @return $this
     */
    public function setModuleArchive($module_archive)
    {
        $this->container['module_archive'] = $module_archive;

        return $this;
    }

    /**
     * Gets module_warehouse
     *
     * @return bool
     */
    public function getModuleWarehouse()
    {
        return $this->container['module_warehouse'];
    }

    /**
     * Sets module_warehouse
     *
     * @param bool $module_warehouse module_warehouse
     *
     * @return $this
     */
    public function setModuleWarehouse($module_warehouse)
    {
        $this->container['module_warehouse'] = $module_warehouse;

        return $this;
    }

    /**
     * Gets module_project_budget_reference_fee
     *
     * @return bool
     */
    public function getModuleProjectBudgetReferenceFee()
    {
        return $this->container['module_project_budget_reference_fee'];
    }

    /**
     * Sets module_project_budget_reference_fee
     *
     * @param bool $module_project_budget_reference_fee module_project_budget_reference_fee
     *
     * @return $this
     */
    public function setModuleProjectBudgetReferenceFee($module_project_budget_reference_fee)
    {
        $this->container['module_project_budget_reference_fee'] = $module_project_budget_reference_fee;

        return $this;
    }

    /**
     * Gets module_nets_eboks
     *
     * @return bool
     */
    public function getModuleNetsEboks()
    {
        return $this->container['module_nets_eboks'];
    }

    /**
     * Sets module_nets_eboks
     *
     * @param bool $module_nets_eboks module_nets_eboks
     *
     * @return $this
     */
    public function setModuleNetsEboks($module_nets_eboks)
    {
        $this->container['module_nets_eboks'] = $module_nets_eboks;

        return $this;
    }

    /**
     * Gets module_nets_print_salary
     *
     * @return bool
     */
    public function getModuleNetsPrintSalary()
    {
        return $this->container['module_nets_print_salary'];
    }

    /**
     * Sets module_nets_print_salary
     *
     * @param bool $module_nets_print_salary module_nets_print_salary
     *
     * @return $this
     */
    public function setModuleNetsPrintSalary($module_nets_print_salary)
    {
        $this->container['module_nets_print_salary'] = $module_nets_print_salary;

        return $this;
    }

    /**
     * Gets module_nets_print_invoice
     *
     * @return bool
     */
    public function getModuleNetsPrintInvoice()
    {
        return $this->container['module_nets_print_invoice'];
    }

    /**
     * Sets module_nets_print_invoice
     *
     * @param bool $module_nets_print_invoice module_nets_print_invoice
     *
     * @return $this
     */
    public function setModuleNetsPrintInvoice($module_nets_print_invoice)
    {
        $this->container['module_nets_print_invoice'] = $module_nets_print_invoice;

        return $this;
    }

    /**
     * Gets module_invoice_import
     *
     * @return bool
     */
    public function getModuleInvoiceImport()
    {
        return $this->container['module_invoice_import'];
    }

    /**
     * Sets module_invoice_import
     *
     * @param bool $module_invoice_import module_invoice_import
     *
     * @return $this
     */
    public function setModuleInvoiceImport($module_invoice_import)
    {
        $this->container['module_invoice_import'] = $module_invoice_import;

        return $this;
    }

    /**
     * Gets module_email
     *
     * @return bool
     */
    public function getModuleEmail()
    {
        return $this->container['module_email'];
    }

    /**
     * Sets module_email
     *
     * @param bool $module_email module_email
     *
     * @return $this
     */
    public function setModuleEmail($module_email)
    {
        $this->container['module_email'] = $module_email;

        return $this;
    }

    /**
     * Gets module_ocr_auto_pay
     *
     * @return bool
     */
    public function getModuleOcrAutoPay()
    {
        return $this->container['module_ocr_auto_pay'];
    }

    /**
     * Sets module_ocr_auto_pay
     *
     * @param bool $module_ocr_auto_pay module_ocr_auto_pay
     *
     * @return $this
     */
    public function setModuleOcrAutoPay($module_ocr_auto_pay)
    {
        $this->container['module_ocr_auto_pay'] = $module_ocr_auto_pay;

        return $this;
    }

    /**
     * Gets module_approve_voucher
     *
     * @return bool
     */
    public function getModuleApproveVoucher()
    {
        return $this->container['module_approve_voucher'];
    }

    /**
     * Sets module_approve_voucher
     *
     * @param bool $module_approve_voucher module_approve_voucher
     *
     * @return $this
     */
    public function setModuleApproveVoucher($module_approve_voucher)
    {
        $this->container['module_approve_voucher'] = $module_approve_voucher;

        return $this;
    }

    /**
     * Gets module_approve_department_voucher
     *
     * @return bool
     */
    public function getModuleApproveDepartmentVoucher()
    {
        return $this->container['module_approve_department_voucher'];
    }

    /**
     * Sets module_approve_department_voucher
     *
     * @param bool $module_approve_department_voucher module_approve_department_voucher
     *
     * @return $this
     */
    public function setModuleApproveDepartmentVoucher($module_approve_department_voucher)
    {
        $this->container['module_approve_department_voucher'] = $module_approve_department_voucher;

        return $this;
    }

    /**
     * Gets module_approve_project_voucher
     *
     * @return bool
     */
    public function getModuleApproveProjectVoucher()
    {
        return $this->container['module_approve_project_voucher'];
    }

    /**
     * Sets module_approve_project_voucher
     *
     * @param bool $module_approve_project_voucher module_approve_project_voucher
     *
     * @return $this
     */
    public function setModuleApproveProjectVoucher($module_approve_project_voucher)
    {
        $this->container['module_approve_project_voucher'] = $module_approve_project_voucher;

        return $this;
    }

    /**
     * Gets module_order_out
     *
     * @return bool
     */
    public function getModuleOrderOut()
    {
        return $this->container['module_order_out'];
    }

    /**
     * Sets module_order_out
     *
     * @param bool $module_order_out module_order_out
     *
     * @return $this
     */
    public function setModuleOrderOut($module_order_out)
    {
        $this->container['module_order_out'] = $module_order_out;

        return $this;
    }

    /**
     * Gets module_mesan
     *
     * @return bool
     */
    public function getModuleMesan()
    {
        return $this->container['module_mesan'];
    }

    /**
     * Sets module_mesan
     *
     * @param bool $module_mesan module_mesan
     *
     * @return $this
     */
    public function setModuleMesan($module_mesan)
    {
        $this->container['module_mesan'] = $module_mesan;

        return $this;
    }

    /**
     * Gets module_divisions
     *
     * @return bool
     */
    public function getModuleDivisions()
    {
        return $this->container['module_divisions'];
    }

    /**
     * Sets module_divisions
     *
     * @param bool $module_divisions module_divisions
     *
     * @return $this
     */
    public function setModuleDivisions($module_divisions)
    {
        $this->container['module_divisions'] = $module_divisions;

        return $this;
    }

    /**
     * Gets module_boligmappa
     *
     * @return bool
     */
    public function getModuleBoligmappa()
    {
        return $this->container['module_boligmappa'];
    }

    /**
     * Sets module_boligmappa
     *
     * @param bool $module_boligmappa module_boligmappa
     *
     * @return $this
     */
    public function setModuleBoligmappa($module_boligmappa)
    {
        $this->container['module_boligmappa'] = $module_boligmappa;

        return $this;
    }

    /**
     * Gets module_addition_project_markup
     *
     * @return bool
     */
    public function getModuleAdditionProjectMarkup()
    {
        return $this->container['module_addition_project_markup'];
    }

    /**
     * Sets module_addition_project_markup
     *
     * @param bool $module_addition_project_markup module_addition_project_markup
     *
     * @return $this
     */
    public function setModuleAdditionProjectMarkup($module_addition_project_markup)
    {
        $this->container['module_addition_project_markup'] = $module_addition_project_markup;

        return $this;
    }

    /**
     * Gets module_wage_project_accounting
     *
     * @return bool
     */
    public function getModuleWageProjectAccounting()
    {
        return $this->container['module_wage_project_accounting'];
    }

    /**
     * Sets module_wage_project_accounting
     *
     * @param bool $module_wage_project_accounting module_wage_project_accounting
     *
     * @return $this
     */
    public function setModuleWageProjectAccounting($module_wage_project_accounting)
    {
        $this->container['module_wage_project_accounting'] = $module_wage_project_accounting;

        return $this;
    }

    /**
     * Gets module_accountant_connect_client
     *
     * @return bool
     */
    public function getModuleAccountantConnectClient()
    {
        return $this->container['module_accountant_connect_client'];
    }

    /**
     * Sets module_accountant_connect_client
     *
     * @param bool $module_accountant_connect_client module_accountant_connect_client
     *
     * @return $this
     */
    public function setModuleAccountantConnectClient($module_accountant_connect_client)
    {
        $this->container['module_accountant_connect_client'] = $module_accountant_connect_client;

        return $this;
    }

    /**
     * Gets module_wage_amortization
     *
     * @return bool
     */
    public function getModuleWageAmortization()
    {
        return $this->container['module_wage_amortization'];
    }

    /**
     * Sets module_wage_amortization
     *
     * @param bool $module_wage_amortization module_wage_amortization
     *
     * @return $this
     */
    public function setModuleWageAmortization($module_wage_amortization)
    {
        $this->container['module_wage_amortization'] = $module_wage_amortization;

        return $this;
    }

    /**
     * Gets module_subscriptions_periodisation
     *
     * @return bool
     */
    public function getModuleSubscriptionsPeriodisation()
    {
        return $this->container['module_subscriptions_periodisation'];
    }

    /**
     * Sets module_subscriptions_periodisation
     *
     * @param bool $module_subscriptions_periodisation module_subscriptions_periodisation
     *
     * @return $this
     */
    public function setModuleSubscriptionsPeriodisation($module_subscriptions_periodisation)
    {
        $this->container['module_subscriptions_periodisation'] = $module_subscriptions_periodisation;

        return $this;
    }

    /**
     * Gets module_activity_hourly_wage_wage_code
     *
     * @return bool
     */
    public function getModuleActivityHourlyWageWageCode()
    {
        return $this->container['module_activity_hourly_wage_wage_code'];
    }

    /**
     * Sets module_activity_hourly_wage_wage_code
     *
     * @param bool $module_activity_hourly_wage_wage_code module_activity_hourly_wage_wage_code
     *
     * @return $this
     */
    public function setModuleActivityHourlyWageWageCode($module_activity_hourly_wage_wage_code)
    {
        $this->container['module_activity_hourly_wage_wage_code'] = $module_activity_hourly_wage_wage_code;

        return $this;
    }

    /**
     * Gets module_crm
     *
     * @return bool
     */
    public function getModuleCrm()
    {
        return $this->container['module_crm'];
    }

    /**
     * Sets module_crm
     *
     * @param bool $module_crm module_crm
     *
     * @return $this
     */
    public function setModuleCrm($module_crm)
    {
        $this->container['module_crm'] = $module_crm;

        return $this;
    }

    /**
     * Gets module_api20
     *
     * @return bool
     */
    public function getModuleApi20()
    {
        return $this->container['module_api20'];
    }

    /**
     * Sets module_api20
     *
     * @param bool $module_api20 module_api20
     *
     * @return $this
     */
    public function setModuleApi20($module_api20)
    {
        $this->container['module_api20'] = $module_api20;

        return $this;
    }

    /**
     * Gets module_control_schema_required_invoicing
     *
     * @return bool
     */
    public function getModuleControlSchemaRequiredInvoicing()
    {
        return $this->container['module_control_schema_required_invoicing'];
    }

    /**
     * Sets module_control_schema_required_invoicing
     *
     * @param bool $module_control_schema_required_invoicing module_control_schema_required_invoicing
     *
     * @return $this
     */
    public function setModuleControlSchemaRequiredInvoicing($module_control_schema_required_invoicing)
    {
        $this->container['module_control_schema_required_invoicing'] = $module_control_schema_required_invoicing;

        return $this;
    }

    /**
     * Gets module_control_schema_required_hour_tracking
     *
     * @return bool
     */
    public function getModuleControlSchemaRequiredHourTracking()
    {
        return $this->container['module_control_schema_required_hour_tracking'];
    }

    /**
     * Sets module_control_schema_required_hour_tracking
     *
     * @param bool $module_control_schema_required_hour_tracking module_control_schema_required_hour_tracking
     *
     * @return $this
     */
    public function setModuleControlSchemaRequiredHourTracking($module_control_schema_required_hour_tracking)
    {
        $this->container['module_control_schema_required_hour_tracking'] = $module_control_schema_required_hour_tracking;

        return $this;
    }

    /**
     * Gets module_finance_tax
     *
     * @return bool
     */
    public function getModuleFinanceTax()
    {
        return $this->container['module_finance_tax'];
    }

    /**
     * Sets module_finance_tax
     *
     * @param bool $module_finance_tax module_finance_tax
     *
     * @return $this
     */
    public function setModuleFinanceTax($module_finance_tax)
    {
        $this->container['module_finance_tax'] = $module_finance_tax;

        return $this;
    }

    /**
     * Gets module_pensionreport
     *
     * @return bool
     */
    public function getModulePensionreport()
    {
        return $this->container['module_pensionreport'];
    }

    /**
     * Sets module_pensionreport
     *
     * @param bool $module_pensionreport module_pensionreport
     *
     * @return $this
     */
    public function setModulePensionreport($module_pensionreport)
    {
        $this->container['module_pensionreport'] = $module_pensionreport;

        return $this;
    }

    /**
     * Gets module_agro
     *
     * @return bool
     */
    public function getModuleAgro()
    {
        return $this->container['module_agro'];
    }

    /**
     * Sets module_agro
     *
     * @param bool $module_agro module_agro
     *
     * @return $this
     */
    public function setModuleAgro($module_agro)
    {
        $this->container['module_agro'] = $module_agro;

        return $this;
    }

    /**
     * Gets module_mamut
     *
     * @return bool
     */
    public function getModuleMamut()
    {
        return $this->container['module_mamut'];
    }

    /**
     * Sets module_mamut
     *
     * @param bool $module_mamut module_mamut
     *
     * @return $this
     */
    public function setModuleMamut($module_mamut)
    {
        $this->container['module_mamut'] = $module_mamut;

        return $this;
    }

    /**
     * Gets module_invoice_option_paper
     *
     * @return bool
     */
    public function getModuleInvoiceOptionPaper()
    {
        return $this->container['module_invoice_option_paper'];
    }

    /**
     * Sets module_invoice_option_paper
     *
     * @param bool $module_invoice_option_paper module_invoice_option_paper
     *
     * @return $this
     */
    public function setModuleInvoiceOptionPaper($module_invoice_option_paper)
    {
        $this->container['module_invoice_option_paper'] = $module_invoice_option_paper;

        return $this;
    }

    /**
     * Gets module_smart_scan
     *
     * @return bool
     */
    public function getModuleSmartScan()
    {
        return $this->container['module_smart_scan'];
    }

    /**
     * Sets module_smart_scan
     *
     * @param bool $module_smart_scan module_smart_scan
     *
     * @return $this
     */
    public function setModuleSmartScan($module_smart_scan)
    {
        $this->container['module_smart_scan'] = $module_smart_scan;

        return $this;
    }

    /**
     * Gets module_offer
     *
     * @return bool
     */
    public function getModuleOffer()
    {
        return $this->container['module_offer'];
    }

    /**
     * Sets module_offer
     *
     * @param bool $module_offer module_offer
     *
     * @return $this
     */
    public function setModuleOffer($module_offer)
    {
        $this->container['module_offer'] = $module_offer;

        return $this;
    }

    /**
     * Gets module_auto_bank_reconciliation
     *
     * @return bool
     */
    public function getModuleAutoBankReconciliation()
    {
        return $this->container['module_auto_bank_reconciliation'];
    }

    /**
     * Sets module_auto_bank_reconciliation
     *
     * @param bool $module_auto_bank_reconciliation module_auto_bank_reconciliation
     *
     * @return $this
     */
    public function setModuleAutoBankReconciliation($module_auto_bank_reconciliation)
    {
        $this->container['module_auto_bank_reconciliation'] = $module_auto_bank_reconciliation;

        return $this;
    }

    /**
     * Gets module_voucher_automation
     *
     * @return bool
     */
    public function getModuleVoucherAutomation()
    {
        return $this->container['module_voucher_automation'];
    }

    /**
     * Sets module_voucher_automation
     *
     * @param bool $module_voucher_automation module_voucher_automation
     *
     * @return $this
     */
    public function setModuleVoucherAutomation($module_voucher_automation)
    {
        $this->container['module_voucher_automation'] = $module_voucher_automation;

        return $this;
    }

    /**
     * Gets module_encrypted_pay_slip
     *
     * @return bool
     */
    public function getModuleEncryptedPaySlip()
    {
        return $this->container['module_encrypted_pay_slip'];
    }

    /**
     * Sets module_encrypted_pay_slip
     *
     * @param bool $module_encrypted_pay_slip module_encrypted_pay_slip
     *
     * @return $this
     */
    public function setModuleEncryptedPaySlip($module_encrypted_pay_slip)
    {
        $this->container['module_encrypted_pay_slip'] = $module_encrypted_pay_slip;

        return $this;
    }

    /**
     * Gets module_invoice_option_vipps
     *
     * @return bool
     */
    public function getModuleInvoiceOptionVipps()
    {
        return $this->container['module_invoice_option_vipps'];
    }

    /**
     * Sets module_invoice_option_vipps
     *
     * @param bool $module_invoice_option_vipps module_invoice_option_vipps
     *
     * @return $this
     */
    public function setModuleInvoiceOptionVipps($module_invoice_option_vipps)
    {
        $this->container['module_invoice_option_vipps'] = $module_invoice_option_vipps;

        return $this;
    }

    /**
     * Gets module_invoice_option_efaktura
     *
     * @return bool
     */
    public function getModuleInvoiceOptionEfaktura()
    {
        return $this->container['module_invoice_option_efaktura'];
    }

    /**
     * Sets module_invoice_option_efaktura
     *
     * @param bool $module_invoice_option_efaktura module_invoice_option_efaktura
     *
     * @return $this
     */
    public function setModuleInvoiceOptionEfaktura($module_invoice_option_efaktura)
    {
        $this->container['module_invoice_option_efaktura'] = $module_invoice_option_efaktura;

        return $this;
    }

    /**
     * Gets module_invoice_option_avtale_giro
     *
     * @return bool
     */
    public function getModuleInvoiceOptionAvtaleGiro()
    {
        return $this->container['module_invoice_option_avtale_giro'];
    }

    /**
     * Sets module_invoice_option_avtale_giro
     *
     * @param bool $module_invoice_option_avtale_giro module_invoice_option_avtale_giro
     *
     * @return $this
     */
    public function setModuleInvoiceOptionAvtaleGiro($module_invoice_option_avtale_giro)
    {
        $this->container['module_invoice_option_avtale_giro'] = $module_invoice_option_avtale_giro;

        return $this;
    }

    /**
     * Gets module_factoring_aprila
     *
     * @return bool
     */
    public function getModuleFactoringAprila()
    {
        return $this->container['module_factoring_aprila'];
    }

    /**
     * Sets module_factoring_aprila
     *
     * @param bool $module_factoring_aprila module_factoring_aprila
     *
     * @return $this
     */
    public function setModuleFactoringAprila($module_factoring_aprila)
    {
        $this->container['module_factoring_aprila'] = $module_factoring_aprila;

        return $this;
    }

    /**
     * Gets module_factoring_visma_finance
     *
     * @return string
     */
    public function getModuleFactoringVismaFinance()
    {
        return $this->container['module_factoring_visma_finance'];
    }

    /**
     * Sets module_factoring_visma_finance
     *
     * @param string $module_factoring_visma_finance module_factoring_visma_finance
     *
     * @return $this
     */
    public function setModuleFactoringVismaFinance($module_factoring_visma_finance)
    {
        $allowedValues = $this->getModuleFactoringVismaFinanceAllowableValues();
        if (!is_null($module_factoring_visma_finance) && !in_array($module_factoring_visma_finance, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'module_factoring_visma_finance', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['module_factoring_visma_finance'] = $module_factoring_visma_finance;

        return $this;
    }

    /**
     * Gets module_cash_credit_aprila
     *
     * @return bool
     */
    public function getModuleCashCreditAprila()
    {
        return $this->container['module_cash_credit_aprila'];
    }

    /**
     * Sets module_cash_credit_aprila
     *
     * @param bool $module_cash_credit_aprila module_cash_credit_aprila
     *
     * @return $this
     */
    public function setModuleCashCreditAprila($module_cash_credit_aprila)
    {
        $this->container['module_cash_credit_aprila'] = $module_cash_credit_aprila;

        return $this;
    }

    /**
     * Gets module_invoice_option_autoinvoice_ehf
     *
     * @return bool
     */
    public function getModuleInvoiceOptionAutoinvoiceEhf()
    {
        return $this->container['module_invoice_option_autoinvoice_ehf'];
    }

    /**
     * Sets module_invoice_option_autoinvoice_ehf
     *
     * @param bool $module_invoice_option_autoinvoice_ehf module_invoice_option_autoinvoice_ehf
     *
     * @return $this
     */
    public function setModuleInvoiceOptionAutoinvoiceEhf($module_invoice_option_autoinvoice_ehf)
    {
        $this->container['module_invoice_option_autoinvoice_ehf'] = $module_invoice_option_autoinvoice_ehf;

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
