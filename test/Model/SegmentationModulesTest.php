<?php
/**
 * SegmentationModulesTest
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
 * Please update the test case below to test the model.
 */

namespace Learnist\Tripletex;

/**
 * SegmentationModulesTest Class Doc Comment
 *
 * @category    Class
 * @description SegmentationModules
 * @package     Learnist\Tripletex
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class SegmentationModulesTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test "SegmentationModules"
     */
    public function testSegmentationModules()
    {
    }

    /**
     * Test attribute "moduleaccountinginternal"
     */
    public function testPropertyModuleaccountinginternal()
    {
    }

    /**
     * Test attribute "moduleaccountingexternal"
     */
    public function testPropertyModuleaccountingexternal()
    {
    }

    /**
     * Test attribute "moduledepartment"
     */
    public function testPropertyModuledepartment()
    {
    }

    /**
     * Test attribute "moduleprojectprognosis"
     */
    public function testPropertyModuleprojectprognosis()
    {
    }

    /**
     * Test attribute "moduleresourceallocation"
     */
    public function testPropertyModuleresourceallocation()
    {
    }

    /**
     * Test attribute "moduleprojecteconomy"
     */
    public function testPropertyModuleprojecteconomy()
    {
    }

    /**
     * Test attribute "moduleinvoice"
     */
    public function testPropertyModuleinvoice()
    {
    }

    /**
     * Test attribute "modulebudget"
     */
    public function testPropertyModulebudget()
    {
    }

    /**
     * Test attribute "modulereferencefee"
     */
    public function testPropertyModulereferencefee()
    {
    }

    /**
     * Test attribute "module_hour_cost"
     */
    public function testPropertyModuleHourCost()
    {
    }

    /**
     * Test attribute "moduleemployee"
     */
    public function testPropertyModuleemployee()
    {
    }

    /**
     * Test attribute "moduleproject"
     */
    public function testPropertyModuleproject()
    {
    }

    /**
     * Test attribute "moduleprojectcategory"
     */
    public function testPropertyModuleprojectcategory()
    {
    }

    /**
     * Test attribute "module_project_budget"
     */
    public function testPropertyModuleProjectBudget()
    {
    }

    /**
     * Test attribute "moduletask"
     */
    public function testPropertyModuletask()
    {
    }

    /**
     * Test attribute "module_travel_expense"
     */
    public function testPropertyModuleTravelExpense()
    {
    }

    /**
     * Test attribute "modulecustomer"
     */
    public function testPropertyModulecustomer()
    {
    }

    /**
     * Test attribute "modulenote"
     */
    public function testPropertyModulenote()
    {
    }

    /**
     * Test attribute "modulesubscription"
     */
    public function testPropertyModulesubscription()
    {
    }

    /**
     * Test attribute "moduleproduct"
     */
    public function testPropertyModuleproduct()
    {
    }

    /**
     * Test attribute "module_voucher_export"
     */
    public function testPropertyModuleVoucherExport()
    {
    }

    /**
     * Test attribute "moduleaccountingreports"
     */
    public function testPropertyModuleaccountingreports()
    {
    }

    /**
     * Test attribute "module_customer_categories"
     */
    public function testPropertyModuleCustomerCategories()
    {
    }

    /**
     * Test attribute "module_customer_category1"
     */
    public function testPropertyModuleCustomerCategory1()
    {
    }

    /**
     * Test attribute "module_customer_category2"
     */
    public function testPropertyModuleCustomerCategory2()
    {
    }

    /**
     * Test attribute "module_customer_category3"
     */
    public function testPropertyModuleCustomerCategory3()
    {
    }

    /**
     * Test attribute "moduleprojectsubcontract"
     */
    public function testPropertyModuleprojectsubcontract()
    {
    }

    /**
     * Test attribute "approvehourlists"
     */
    public function testPropertyApprovehourlists()
    {
    }

    /**
     * Test attribute "approveinvoices"
     */
    public function testPropertyApproveinvoices()
    {
    }

    /**
     * Test attribute "approvetravelreports"
     */
    public function testPropertyApprovetravelreports()
    {
    }

    /**
     * Test attribute "completeweeklyhourlists"
     */
    public function testPropertyCompleteweeklyhourlists()
    {
    }

    /**
     * Test attribute "completemonthlyhourlists"
     */
    public function testPropertyCompletemonthlyhourlists()
    {
    }

    /**
     * Test attribute "approvemonthlyhourlists"
     */
    public function testPropertyApprovemonthlyhourlists()
    {
    }

    /**
     * Test attribute "invoiceapprovedhoursmandatory"
     */
    public function testPropertyInvoiceapprovedhoursmandatory()
    {
    }

    /**
     * Test attribute "module_payroll_accounting"
     */
    public function testPropertyModulePayrollAccounting()
    {
    }

    /**
     * Test attribute "module_payroll_accounting_no"
     */
    public function testPropertyModulePayrollAccountingNo()
    {
    }

    /**
     * Test attribute "modulehourlist"
     */
    public function testPropertyModulehourlist()
    {
    }

    /**
     * Test attribute "module_time_balance"
     */
    public function testPropertyModuleTimeBalance()
    {
    }

    /**
     * Test attribute "module_vacation_balance"
     */
    public function testPropertyModuleVacationBalance()
    {
    }

    /**
     * Test attribute "module_working_hours"
     */
    public function testPropertyModuleWorkingHours()
    {
    }

    /**
     * Test attribute "module_currency"
     */
    public function testPropertyModuleCurrency()
    {
    }

    /**
     * Test attribute "module_contact"
     */
    public function testPropertyModuleContact()
    {
    }

    /**
     * Test attribute "module_swedish"
     */
    public function testPropertyModuleSwedish()
    {
    }

    /**
     * Test attribute "module_auto_project_number"
     */
    public function testPropertyModuleAutoProjectNumber()
    {
    }

    /**
     * Test attribute "module_wage_export"
     */
    public function testPropertyModuleWageExport()
    {
    }

    /**
     * Test attribute "approve_weekly_hourlists"
     */
    public function testPropertyApproveWeeklyHourlists()
    {
    }

    /**
     * Test attribute "module_provision_salary"
     */
    public function testPropertyModuleProvisionSalary()
    {
    }

    /**
     * Test attribute "module_order_number"
     */
    public function testPropertyModuleOrderNumber()
    {
    }

    /**
     * Test attribute "module_order_discount"
     */
    public function testPropertyModuleOrderDiscount()
    {
    }

    /**
     * Test attribute "module_order_markup"
     */
    public function testPropertyModuleOrderMarkup()
    {
    }

    /**
     * Test attribute "module_order_line_cost"
     */
    public function testPropertyModuleOrderLineCost()
    {
    }

    /**
     * Test attribute "module_resource_groups"
     */
    public function testPropertyModuleResourceGroups()
    {
    }

    /**
     * Test attribute "module_vendor"
     */
    public function testPropertyModuleVendor()
    {
    }

    /**
     * Test attribute "module_auto_customer_number"
     */
    public function testPropertyModuleAutoCustomerNumber()
    {
    }

    /**
     * Test attribute "module_auto_vendor_number"
     */
    public function testPropertyModuleAutoVendorNumber()
    {
    }

    /**
     * Test attribute "module_historical"
     */
    public function testPropertyModuleHistorical()
    {
    }

    /**
     * Test attribute "show_travel_report_letterhead"
     */
    public function testPropertyShowTravelReportLetterhead()
    {
    }

    /**
     * Test attribute "module_ocr"
     */
    public function testPropertyModuleOcr()
    {
    }

    /**
     * Test attribute "module_remit"
     */
    public function testPropertyModuleRemit()
    {
    }

    /**
     * Test attribute "module_remit_nets"
     */
    public function testPropertyModuleRemitNets()
    {
    }

    /**
     * Test attribute "module_remit_ztl"
     */
    public function testPropertyModuleRemitZtl()
    {
    }

    /**
     * Test attribute "module_remit_auto_pay"
     */
    public function testPropertyModuleRemitAutoPay()
    {
    }

    /**
     * Test attribute "module_travel_expense_rates"
     */
    public function testPropertyModuleTravelExpenseRates()
    {
    }

    /**
     * Test attribute "module_voucher_scanning"
     */
    public function testPropertyModuleVoucherScanning()
    {
    }

    /**
     * Test attribute "module_invoice_scanning"
     */
    public function testPropertyModuleInvoiceScanning()
    {
    }

    /**
     * Test attribute "module_holyday_plan"
     */
    public function testPropertyModuleHolydayPlan()
    {
    }

    /**
     * Test attribute "module_employee_category"
     */
    public function testPropertyModuleEmployeeCategory()
    {
    }

    /**
     * Test attribute "multiple_customer_categories"
     */
    public function testPropertyMultipleCustomerCategories()
    {
    }

    /**
     * Test attribute "module_product_invoice"
     */
    public function testPropertyModuleProductInvoice()
    {
    }

    /**
     * Test attribute "auto_invoicing"
     */
    public function testPropertyAutoInvoicing()
    {
    }

    /**
     * Test attribute "module_factoring"
     */
    public function testPropertyModuleFactoring()
    {
    }

    /**
     * Test attribute "module_employee_accounting"
     */
    public function testPropertyModuleEmployeeAccounting()
    {
    }

    /**
     * Test attribute "module_department_accounting"
     */
    public function testPropertyModuleDepartmentAccounting()
    {
    }

    /**
     * Test attribute "module_project_accounting"
     */
    public function testPropertyModuleProjectAccounting()
    {
    }

    /**
     * Test attribute "module_wage_project_accounting"
     */
    public function testPropertyModuleWageProjectAccounting()
    {
    }

    /**
     * Test attribute "module_product_accounting"
     */
    public function testPropertyModuleProductAccounting()
    {
    }

    /**
     * Test attribute "module_electro"
     */
    public function testPropertyModuleElectro()
    {
    }

    /**
     * Test attribute "module_nrf"
     */
    public function testPropertyModuleNrf()
    {
    }

    /**
     * Test attribute "module_result_budget"
     */
    public function testPropertyModuleResultBudget()
    {
    }

    /**
     * Test attribute "module_voucher_types"
     */
    public function testPropertyModuleVoucherTypes()
    {
    }

    /**
     * Test attribute "module_warehouse"
     */
    public function testPropertyModuleWarehouse()
    {
    }

    /**
     * Test attribute "module_nets_eboks"
     */
    public function testPropertyModuleNetsEboks()
    {
    }

    /**
     * Test attribute "module_nets_print_salary"
     */
    public function testPropertyModuleNetsPrintSalary()
    {
    }

    /**
     * Test attribute "module_nets_print_invoice"
     */
    public function testPropertyModuleNetsPrintInvoice()
    {
    }

    /**
     * Test attribute "hourly_rate_projects_write_up_down"
     */
    public function testPropertyHourlyRateProjectsWriteUpDown()
    {
    }

    /**
     * Test attribute "show_recently_closed_projects_on_supplier_invoice"
     */
    public function testPropertyShowRecentlyClosedProjectsOnSupplierInvoice()
    {
    }

    /**
     * Test attribute "module_email"
     */
    public function testPropertyModuleEmail()
    {
    }

    /**
     * Test attribute "send_payslips_by_email"
     */
    public function testPropertySendPayslipsByEmail()
    {
    }

    /**
     * Test attribute "module_approve_voucher"
     */
    public function testPropertyModuleApproveVoucher()
    {
    }

    /**
     * Test attribute "module_approve_project_voucher"
     */
    public function testPropertyModuleApproveProjectVoucher()
    {
    }

    /**
     * Test attribute "module_approve_department_voucher"
     */
    public function testPropertyModuleApproveDepartmentVoucher()
    {
    }

    /**
     * Test attribute "module_archive"
     */
    public function testPropertyModuleArchive()
    {
    }

    /**
     * Test attribute "module_order_out"
     */
    public function testPropertyModuleOrderOut()
    {
    }

    /**
     * Test attribute "module_mesan"
     */
    public function testPropertyModuleMesan()
    {
    }

    /**
     * Test attribute "module_accountant_connect_client"
     */
    public function testPropertyModuleAccountantConnectClient()
    {
    }

    /**
     * Test attribute "module_divisions"
     */
    public function testPropertyModuleDivisions()
    {
    }

    /**
     * Test attribute "module_boligmappa"
     */
    public function testPropertyModuleBoligmappa()
    {
    }

    /**
     * Test attribute "module_addition_project_markup"
     */
    public function testPropertyModuleAdditionProjectMarkup()
    {
    }

    /**
     * Test attribute "tripletex_support_login_access_company_level"
     */
    public function testPropertyTripletexSupportLoginAccessCompanyLevel()
    {
    }

    /**
     * Test attribute "module_crm"
     */
    public function testPropertyModuleCrm()
    {
    }

    /**
     * Test attribute "module_pensionreport"
     */
    public function testPropertyModulePensionreport()
    {
    }

    /**
     * Test attribute "module_control_schema_required_invoicing"
     */
    public function testPropertyModuleControlSchemaRequiredInvoicing()
    {
    }

    /**
     * Test attribute "module_control_schema_required_hour_tracking"
     */
    public function testPropertyModuleControlSchemaRequiredHourTracking()
    {
    }

    /**
     * Test attribute "module_invoice_option_vipps"
     */
    public function testPropertyModuleInvoiceOptionVipps()
    {
    }

    /**
     * Test attribute "module_invoice_option_efaktura"
     */
    public function testPropertyModuleInvoiceOptionEfaktura()
    {
    }

    /**
     * Test attribute "module_invoice_option_paper"
     */
    public function testPropertyModuleInvoiceOptionPaper()
    {
    }

    /**
     * Test attribute "module_invoice_option_avtale_giro"
     */
    public function testPropertyModuleInvoiceOptionAvtaleGiro()
    {
    }

    /**
     * Test attribute "module_invoice_option_ehf_incoming"
     */
    public function testPropertyModuleInvoiceOptionEhfIncoming()
    {
    }

    /**
     * Test attribute "module_invoice_option_ehf_outbound"
     */
    public function testPropertyModuleInvoiceOptionEhfOutbound()
    {
    }

    /**
     * Test attribute "module_api20"
     */
    public function testPropertyModuleApi20()
    {
    }

    /**
     * Test attribute "module_agro"
     */
    public function testPropertyModuleAgro()
    {
    }

    /**
     * Test attribute "module_mamut"
     */
    public function testPropertyModuleMamut()
    {
    }

    /**
     * Test attribute "module_factoring_aprila"
     */
    public function testPropertyModuleFactoringAprila()
    {
    }

    /**
     * Test attribute "module_cash_credit_aprila"
     */
    public function testPropertyModuleCashCreditAprila()
    {
    }

    /**
     * Test attribute "module_invoice_option_autoinvoice_ehf"
     */
    public function testPropertyModuleInvoiceOptionAutoinvoiceEhf()
    {
    }

    /**
     * Test attribute "module_smart_scan"
     */
    public function testPropertyModuleSmartScan()
    {
    }

    /**
     * Test attribute "module_auto_bank_reconciliation"
     */
    public function testPropertyModuleAutoBankReconciliation()
    {
    }

    /**
     * Test attribute "module_offer"
     */
    public function testPropertyModuleOffer()
    {
    }

    /**
     * Test attribute "module_voucher_automation"
     */
    public function testPropertyModuleVoucherAutomation()
    {
    }

    /**
     * Test attribute "module_amortization"
     */
    public function testPropertyModuleAmortization()
    {
    }

    /**
     * Test attribute "module_encrypted_pay_slip"
     */
    public function testPropertyModuleEncryptedPaySlip()
    {
    }

    /**
     * Test attribute "hour_cost_factor_project"
     */
    public function testPropertyHourCostFactorProject()
    {
    }

    /**
     * Test attribute "factoring_visma_finance"
     */
    public function testPropertyFactoringVismaFinance()
    {
    }

    /**
     * Test attribute "year_end_report"
     */
    public function testPropertyYearEndReport()
    {
    }

    /**
     * Test attribute "module_logistics"
     */
    public function testPropertyModuleLogistics()
    {
    }
}
