<?php
/**
 * TripletexCompanyModules
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
 * TripletexCompanyModules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TripletexCompanyModules implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TripletexCompanyModules';

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
        'module_invoice_option_autoinvoice_ehf' => 'bool'
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
        'module_invoice_option_autoinvoice_ehf' => null
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
		'company_id' => false,
		'modulehourlist' => false,
		'module_travel_expense' => false,
		'module_invoice' => false,
		'moduleaccountinginternal' => false,
		'module_accounting_external' => false,
		'moduleproject' => false,
		'moduleproduct' => false,
		'modulecustomer' => false,
		'moduleemployee' => false,
		'moduledepartment' => false,
		'approveinvoices' => false,
		'approvehourlists' => false,
		'approvetravelreports' => false,
		'modulebudget' => false,
		'modulenote' => false,
		'moduletask' => false,
		'moduleresourceallocation' => false,
		'moduleprojecteconomy' => false,
		'modulereferencefee' => false,
		'modulehistorical' => false,
		'moduleprojectcategory' => false,
		'moduleprojectlocation' => false,
		'module_project_budget' => false,
		'modulesubscription' => false,
		'completeweeklyhourlists' => false,
		'completemonthlyhourlists' => false,
		'approvemonthlyhourlists' => false,
		'moduleprojectprognosis' => false,
		'modulebunches' => false,
		'module_vacation_balance' => false,
		'module_accounting_reports' => false,
		'module_customer_categories' => false,
		'module_customer_category1' => false,
		'module_customer_category2' => false,
		'module_customer_category3' => false,
		'moduleprojectsubcontract' => false,
		'module_payroll_accounting' => false,
		'module_time_balance' => false,
		'module_working_hours' => false,
		'module_currency' => false,
		'module_wage_export' => false,
		'module_auto_customer_number' => false,
		'module_auto_vendor_number' => false,
		'module_provision_salary' => false,
		'module_order_number' => false,
		'module_order_discount' => false,
		'module_order_markup' => false,
		'module_order_line_cost' => false,
		'module_stop_watch' => false,
		'module_contact' => false,
		'module_auto_project_number' => false,
		'module_swedish' => false,
		'module_resource_groups' => false,
		'module_ocr' => false,
		'module_travel_expense_rates' => false,
		'monthly_hourlist_minus_time_warning' => false,
		'module_voucher_scanning' => false,
		'module_invoice_scanning' => false,
		'module_project_participants' => false,
		'module_holyday_plan' => false,
		'module_employee_category' => false,
		'module_product_invoice' => false,
		'auto_invoicing' => false,
		'module_invoice_fee_comment' => false,
		'module_employee_accounting' => false,
		'module_department_accounting' => false,
		'module_project_accounting' => false,
		'module_product_accounting' => false,
		'module_subscription_address_list' => false,
		'module_electro' => false,
		'module_nrf' => false,
		'module_gtin' => false,
		'module_elproffen' => false,
		'module_rorkjop' => false,
		'module_order_ext' => false,
		'module_result_budget' => false,
		'module_amortization' => false,
		'module_change_debt_collector' => false,
		'module_voucher_types' => false,
		'module_onninen123' => false,
		'module_elektro_union' => false,
		'module_ahlsell_partner' => false,
		'module_archive' => false,
		'module_warehouse' => false,
		'module_project_budget_reference_fee' => false,
		'module_nets_eboks' => false,
		'module_nets_print_salary' => false,
		'module_nets_print_invoice' => false,
		'module_invoice_import' => false,
		'module_email' => false,
		'module_ocr_auto_pay' => false,
		'module_approve_voucher' => false,
		'module_approve_department_voucher' => false,
		'module_approve_project_voucher' => false,
		'module_order_out' => false,
		'module_mesan' => false,
		'module_divisions' => false,
		'module_boligmappa' => false,
		'module_addition_project_markup' => false,
		'module_wage_project_accounting' => false,
		'module_accountant_connect_client' => false,
		'module_wage_amortization' => false,
		'module_subscriptions_periodisation' => false,
		'module_activity_hourly_wage_wage_code' => false,
		'module_crm' => false,
		'module_api20' => false,
		'module_control_schema_required_invoicing' => false,
		'module_control_schema_required_hour_tracking' => false,
		'module_finance_tax' => false,
		'module_pensionreport' => false,
		'module_agro' => false,
		'module_mamut' => false,
		'module_invoice_option_paper' => false,
		'module_smart_scan' => false,
		'module_offer' => false,
		'module_auto_bank_reconciliation' => false,
		'module_voucher_automation' => false,
		'module_encrypted_pay_slip' => false,
		'module_invoice_option_vipps' => false,
		'module_invoice_option_efaktura' => false,
		'module_invoice_option_avtale_giro' => false,
		'module_factoring_aprila' => false,
		'module_factoring_visma_finance' => false,
		'module_cash_credit_aprila' => false,
		'module_invoice_option_autoinvoice_ehf' => false
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
        'module_invoice_option_autoinvoice_ehf' => 'moduleInvoiceOptionAutoinvoiceEhf'
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
        'module_invoice_option_autoinvoice_ehf' => 'setModuleInvoiceOptionAutoinvoiceEhf'
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
        'module_invoice_option_autoinvoice_ehf' => 'getModuleInvoiceOptionAutoinvoiceEhf'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('company_id', $data ?? [], null);
        $this->setIfExists('modulehourlist', $data ?? [], null);
        $this->setIfExists('module_travel_expense', $data ?? [], null);
        $this->setIfExists('module_invoice', $data ?? [], null);
        $this->setIfExists('moduleaccountinginternal', $data ?? [], null);
        $this->setIfExists('module_accounting_external', $data ?? [], null);
        $this->setIfExists('moduleproject', $data ?? [], null);
        $this->setIfExists('moduleproduct', $data ?? [], null);
        $this->setIfExists('modulecustomer', $data ?? [], null);
        $this->setIfExists('moduleemployee', $data ?? [], null);
        $this->setIfExists('moduledepartment', $data ?? [], null);
        $this->setIfExists('approveinvoices', $data ?? [], null);
        $this->setIfExists('approvehourlists', $data ?? [], null);
        $this->setIfExists('approvetravelreports', $data ?? [], null);
        $this->setIfExists('modulebudget', $data ?? [], null);
        $this->setIfExists('modulenote', $data ?? [], null);
        $this->setIfExists('moduletask', $data ?? [], null);
        $this->setIfExists('moduleresourceallocation', $data ?? [], null);
        $this->setIfExists('moduleprojecteconomy', $data ?? [], null);
        $this->setIfExists('modulereferencefee', $data ?? [], null);
        $this->setIfExists('modulehistorical', $data ?? [], null);
        $this->setIfExists('moduleprojectcategory', $data ?? [], null);
        $this->setIfExists('moduleprojectlocation', $data ?? [], null);
        $this->setIfExists('module_project_budget', $data ?? [], null);
        $this->setIfExists('modulesubscription', $data ?? [], null);
        $this->setIfExists('completeweeklyhourlists', $data ?? [], null);
        $this->setIfExists('completemonthlyhourlists', $data ?? [], null);
        $this->setIfExists('approvemonthlyhourlists', $data ?? [], null);
        $this->setIfExists('moduleprojectprognosis', $data ?? [], null);
        $this->setIfExists('modulebunches', $data ?? [], null);
        $this->setIfExists('module_vacation_balance', $data ?? [], null);
        $this->setIfExists('module_accounting_reports', $data ?? [], null);
        $this->setIfExists('module_customer_categories', $data ?? [], null);
        $this->setIfExists('module_customer_category1', $data ?? [], null);
        $this->setIfExists('module_customer_category2', $data ?? [], null);
        $this->setIfExists('module_customer_category3', $data ?? [], null);
        $this->setIfExists('moduleprojectsubcontract', $data ?? [], null);
        $this->setIfExists('module_payroll_accounting', $data ?? [], null);
        $this->setIfExists('module_time_balance', $data ?? [], null);
        $this->setIfExists('module_working_hours', $data ?? [], null);
        $this->setIfExists('module_currency', $data ?? [], null);
        $this->setIfExists('module_wage_export', $data ?? [], null);
        $this->setIfExists('module_auto_customer_number', $data ?? [], null);
        $this->setIfExists('module_auto_vendor_number', $data ?? [], null);
        $this->setIfExists('module_provision_salary', $data ?? [], null);
        $this->setIfExists('module_order_number', $data ?? [], null);
        $this->setIfExists('module_order_discount', $data ?? [], null);
        $this->setIfExists('module_order_markup', $data ?? [], null);
        $this->setIfExists('module_order_line_cost', $data ?? [], null);
        $this->setIfExists('module_stop_watch', $data ?? [], null);
        $this->setIfExists('module_contact', $data ?? [], null);
        $this->setIfExists('module_auto_project_number', $data ?? [], null);
        $this->setIfExists('module_swedish', $data ?? [], null);
        $this->setIfExists('module_resource_groups', $data ?? [], null);
        $this->setIfExists('module_ocr', $data ?? [], null);
        $this->setIfExists('module_travel_expense_rates', $data ?? [], null);
        $this->setIfExists('monthly_hourlist_minus_time_warning', $data ?? [], null);
        $this->setIfExists('module_voucher_scanning', $data ?? [], null);
        $this->setIfExists('module_invoice_scanning', $data ?? [], null);
        $this->setIfExists('module_project_participants', $data ?? [], null);
        $this->setIfExists('module_holyday_plan', $data ?? [], null);
        $this->setIfExists('module_employee_category', $data ?? [], null);
        $this->setIfExists('module_product_invoice', $data ?? [], null);
        $this->setIfExists('auto_invoicing', $data ?? [], null);
        $this->setIfExists('module_invoice_fee_comment', $data ?? [], null);
        $this->setIfExists('module_employee_accounting', $data ?? [], null);
        $this->setIfExists('module_department_accounting', $data ?? [], null);
        $this->setIfExists('module_project_accounting', $data ?? [], null);
        $this->setIfExists('module_product_accounting', $data ?? [], null);
        $this->setIfExists('module_subscription_address_list', $data ?? [], null);
        $this->setIfExists('module_electro', $data ?? [], null);
        $this->setIfExists('module_nrf', $data ?? [], null);
        $this->setIfExists('module_gtin', $data ?? [], null);
        $this->setIfExists('module_elproffen', $data ?? [], null);
        $this->setIfExists('module_rorkjop', $data ?? [], null);
        $this->setIfExists('module_order_ext', $data ?? [], null);
        $this->setIfExists('module_result_budget', $data ?? [], null);
        $this->setIfExists('module_amortization', $data ?? [], null);
        $this->setIfExists('module_change_debt_collector', $data ?? [], null);
        $this->setIfExists('module_voucher_types', $data ?? [], null);
        $this->setIfExists('module_onninen123', $data ?? [], null);
        $this->setIfExists('module_elektro_union', $data ?? [], null);
        $this->setIfExists('module_ahlsell_partner', $data ?? [], null);
        $this->setIfExists('module_archive', $data ?? [], null);
        $this->setIfExists('module_warehouse', $data ?? [], null);
        $this->setIfExists('module_project_budget_reference_fee', $data ?? [], null);
        $this->setIfExists('module_nets_eboks', $data ?? [], null);
        $this->setIfExists('module_nets_print_salary', $data ?? [], null);
        $this->setIfExists('module_nets_print_invoice', $data ?? [], null);
        $this->setIfExists('module_invoice_import', $data ?? [], null);
        $this->setIfExists('module_email', $data ?? [], null);
        $this->setIfExists('module_ocr_auto_pay', $data ?? [], null);
        $this->setIfExists('module_approve_voucher', $data ?? [], null);
        $this->setIfExists('module_approve_department_voucher', $data ?? [], null);
        $this->setIfExists('module_approve_project_voucher', $data ?? [], null);
        $this->setIfExists('module_order_out', $data ?? [], null);
        $this->setIfExists('module_mesan', $data ?? [], null);
        $this->setIfExists('module_divisions', $data ?? [], null);
        $this->setIfExists('module_boligmappa', $data ?? [], null);
        $this->setIfExists('module_addition_project_markup', $data ?? [], null);
        $this->setIfExists('module_wage_project_accounting', $data ?? [], null);
        $this->setIfExists('module_accountant_connect_client', $data ?? [], null);
        $this->setIfExists('module_wage_amortization', $data ?? [], null);
        $this->setIfExists('module_subscriptions_periodisation', $data ?? [], null);
        $this->setIfExists('module_activity_hourly_wage_wage_code', $data ?? [], null);
        $this->setIfExists('module_crm', $data ?? [], null);
        $this->setIfExists('module_api20', $data ?? [], null);
        $this->setIfExists('module_control_schema_required_invoicing', $data ?? [], null);
        $this->setIfExists('module_control_schema_required_hour_tracking', $data ?? [], null);
        $this->setIfExists('module_finance_tax', $data ?? [], null);
        $this->setIfExists('module_pensionreport', $data ?? [], null);
        $this->setIfExists('module_agro', $data ?? [], null);
        $this->setIfExists('module_mamut', $data ?? [], null);
        $this->setIfExists('module_invoice_option_paper', $data ?? [], null);
        $this->setIfExists('module_smart_scan', $data ?? [], null);
        $this->setIfExists('module_offer', $data ?? [], null);
        $this->setIfExists('module_auto_bank_reconciliation', $data ?? [], null);
        $this->setIfExists('module_voucher_automation', $data ?? [], null);
        $this->setIfExists('module_encrypted_pay_slip', $data ?? [], null);
        $this->setIfExists('module_invoice_option_vipps', $data ?? [], null);
        $this->setIfExists('module_invoice_option_efaktura', $data ?? [], null);
        $this->setIfExists('module_invoice_option_avtale_giro', $data ?? [], null);
        $this->setIfExists('module_factoring_aprila', $data ?? [], null);
        $this->setIfExists('module_factoring_visma_finance', $data ?? [], null);
        $this->setIfExists('module_cash_credit_aprila', $data ?? [], null);
        $this->setIfExists('module_invoice_option_autoinvoice_ehf', $data ?? [], null);
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
     * Gets company_id
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int|null $company_id company_id
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {
        if (is_null($company_id)) {
            throw new \InvalidArgumentException('non-nullable company_id cannot be null');
        }
        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets modulehourlist
     *
     * @return bool|null
     */
    public function getModulehourlist()
    {
        return $this->container['modulehourlist'];
    }

    /**
     * Sets modulehourlist
     *
     * @param bool|null $modulehourlist modulehourlist
     *
     * @return self
     */
    public function setModulehourlist($modulehourlist)
    {
        if (is_null($modulehourlist)) {
            throw new \InvalidArgumentException('non-nullable modulehourlist cannot be null');
        }
        $this->container['modulehourlist'] = $modulehourlist;

        return $this;
    }

    /**
     * Gets module_travel_expense
     *
     * @return bool|null
     */
    public function getModuleTravelExpense()
    {
        return $this->container['module_travel_expense'];
    }

    /**
     * Sets module_travel_expense
     *
     * @param bool|null $module_travel_expense module_travel_expense
     *
     * @return self
     */
    public function setModuleTravelExpense($module_travel_expense)
    {
        if (is_null($module_travel_expense)) {
            throw new \InvalidArgumentException('non-nullable module_travel_expense cannot be null');
        }
        $this->container['module_travel_expense'] = $module_travel_expense;

        return $this;
    }

    /**
     * Gets module_invoice
     *
     * @return bool|null
     */
    public function getModuleInvoice()
    {
        return $this->container['module_invoice'];
    }

    /**
     * Sets module_invoice
     *
     * @param bool|null $module_invoice module_invoice
     *
     * @return self
     */
    public function setModuleInvoice($module_invoice)
    {
        if (is_null($module_invoice)) {
            throw new \InvalidArgumentException('non-nullable module_invoice cannot be null');
        }
        $this->container['module_invoice'] = $module_invoice;

        return $this;
    }

    /**
     * Gets moduleaccountinginternal
     *
     * @return bool|null
     */
    public function getModuleaccountinginternal()
    {
        return $this->container['moduleaccountinginternal'];
    }

    /**
     * Sets moduleaccountinginternal
     *
     * @param bool|null $moduleaccountinginternal moduleaccountinginternal
     *
     * @return self
     */
    public function setModuleaccountinginternal($moduleaccountinginternal)
    {
        if (is_null($moduleaccountinginternal)) {
            throw new \InvalidArgumentException('non-nullable moduleaccountinginternal cannot be null');
        }
        $this->container['moduleaccountinginternal'] = $moduleaccountinginternal;

        return $this;
    }

    /**
     * Gets module_accounting_external
     *
     * @return bool|null
     */
    public function getModuleAccountingExternal()
    {
        return $this->container['module_accounting_external'];
    }

    /**
     * Sets module_accounting_external
     *
     * @param bool|null $module_accounting_external module_accounting_external
     *
     * @return self
     */
    public function setModuleAccountingExternal($module_accounting_external)
    {
        if (is_null($module_accounting_external)) {
            throw new \InvalidArgumentException('non-nullable module_accounting_external cannot be null');
        }
        $this->container['module_accounting_external'] = $module_accounting_external;

        return $this;
    }

    /**
     * Gets moduleproject
     *
     * @return bool|null
     */
    public function getModuleproject()
    {
        return $this->container['moduleproject'];
    }

    /**
     * Sets moduleproject
     *
     * @param bool|null $moduleproject moduleproject
     *
     * @return self
     */
    public function setModuleproject($moduleproject)
    {
        if (is_null($moduleproject)) {
            throw new \InvalidArgumentException('non-nullable moduleproject cannot be null');
        }
        $this->container['moduleproject'] = $moduleproject;

        return $this;
    }

    /**
     * Gets moduleproduct
     *
     * @return bool|null
     */
    public function getModuleproduct()
    {
        return $this->container['moduleproduct'];
    }

    /**
     * Sets moduleproduct
     *
     * @param bool|null $moduleproduct moduleproduct
     *
     * @return self
     */
    public function setModuleproduct($moduleproduct)
    {
        if (is_null($moduleproduct)) {
            throw new \InvalidArgumentException('non-nullable moduleproduct cannot be null');
        }
        $this->container['moduleproduct'] = $moduleproduct;

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
     * Gets approveinvoices
     *
     * @return bool|null
     */
    public function getApproveinvoices()
    {
        return $this->container['approveinvoices'];
    }

    /**
     * Sets approveinvoices
     *
     * @param bool|null $approveinvoices approveinvoices
     *
     * @return self
     */
    public function setApproveinvoices($approveinvoices)
    {
        if (is_null($approveinvoices)) {
            throw new \InvalidArgumentException('non-nullable approveinvoices cannot be null');
        }
        $this->container['approveinvoices'] = $approveinvoices;

        return $this;
    }

    /**
     * Gets approvehourlists
     *
     * @return bool|null
     */
    public function getApprovehourlists()
    {
        return $this->container['approvehourlists'];
    }

    /**
     * Sets approvehourlists
     *
     * @param bool|null $approvehourlists approvehourlists
     *
     * @return self
     */
    public function setApprovehourlists($approvehourlists)
    {
        if (is_null($approvehourlists)) {
            throw new \InvalidArgumentException('non-nullable approvehourlists cannot be null');
        }
        $this->container['approvehourlists'] = $approvehourlists;

        return $this;
    }

    /**
     * Gets approvetravelreports
     *
     * @return bool|null
     */
    public function getApprovetravelreports()
    {
        return $this->container['approvetravelreports'];
    }

    /**
     * Sets approvetravelreports
     *
     * @param bool|null $approvetravelreports approvetravelreports
     *
     * @return self
     */
    public function setApprovetravelreports($approvetravelreports)
    {
        if (is_null($approvetravelreports)) {
            throw new \InvalidArgumentException('non-nullable approvetravelreports cannot be null');
        }
        $this->container['approvetravelreports'] = $approvetravelreports;

        return $this;
    }

    /**
     * Gets modulebudget
     *
     * @return bool|null
     */
    public function getModulebudget()
    {
        return $this->container['modulebudget'];
    }

    /**
     * Sets modulebudget
     *
     * @param bool|null $modulebudget modulebudget
     *
     * @return self
     */
    public function setModulebudget($modulebudget)
    {
        if (is_null($modulebudget)) {
            throw new \InvalidArgumentException('non-nullable modulebudget cannot be null');
        }
        $this->container['modulebudget'] = $modulebudget;

        return $this;
    }

    /**
     * Gets modulenote
     *
     * @return bool|null
     */
    public function getModulenote()
    {
        return $this->container['modulenote'];
    }

    /**
     * Sets modulenote
     *
     * @param bool|null $modulenote modulenote
     *
     * @return self
     */
    public function setModulenote($modulenote)
    {
        if (is_null($modulenote)) {
            throw new \InvalidArgumentException('non-nullable modulenote cannot be null');
        }
        $this->container['modulenote'] = $modulenote;

        return $this;
    }

    /**
     * Gets moduletask
     *
     * @return bool|null
     */
    public function getModuletask()
    {
        return $this->container['moduletask'];
    }

    /**
     * Sets moduletask
     *
     * @param bool|null $moduletask moduletask
     *
     * @return self
     */
    public function setModuletask($moduletask)
    {
        if (is_null($moduletask)) {
            throw new \InvalidArgumentException('non-nullable moduletask cannot be null');
        }
        $this->container['moduletask'] = $moduletask;

        return $this;
    }

    /**
     * Gets moduleresourceallocation
     *
     * @return bool|null
     */
    public function getModuleresourceallocation()
    {
        return $this->container['moduleresourceallocation'];
    }

    /**
     * Sets moduleresourceallocation
     *
     * @param bool|null $moduleresourceallocation moduleresourceallocation
     *
     * @return self
     */
    public function setModuleresourceallocation($moduleresourceallocation)
    {
        if (is_null($moduleresourceallocation)) {
            throw new \InvalidArgumentException('non-nullable moduleresourceallocation cannot be null');
        }
        $this->container['moduleresourceallocation'] = $moduleresourceallocation;

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
     * Gets modulereferencefee
     *
     * @return bool|null
     */
    public function getModulereferencefee()
    {
        return $this->container['modulereferencefee'];
    }

    /**
     * Sets modulereferencefee
     *
     * @param bool|null $modulereferencefee modulereferencefee
     *
     * @return self
     */
    public function setModulereferencefee($modulereferencefee)
    {
        if (is_null($modulereferencefee)) {
            throw new \InvalidArgumentException('non-nullable modulereferencefee cannot be null');
        }
        $this->container['modulereferencefee'] = $modulereferencefee;

        return $this;
    }

    /**
     * Gets modulehistorical
     *
     * @return bool|null
     */
    public function getModulehistorical()
    {
        return $this->container['modulehistorical'];
    }

    /**
     * Sets modulehistorical
     *
     * @param bool|null $modulehistorical modulehistorical
     *
     * @return self
     */
    public function setModulehistorical($modulehistorical)
    {
        if (is_null($modulehistorical)) {
            throw new \InvalidArgumentException('non-nullable modulehistorical cannot be null');
        }
        $this->container['modulehistorical'] = $modulehistorical;

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
     * Gets moduleprojectlocation
     *
     * @return bool|null
     */
    public function getModuleprojectlocation()
    {
        return $this->container['moduleprojectlocation'];
    }

    /**
     * Sets moduleprojectlocation
     *
     * @param bool|null $moduleprojectlocation moduleprojectlocation
     *
     * @return self
     */
    public function setModuleprojectlocation($moduleprojectlocation)
    {
        if (is_null($moduleprojectlocation)) {
            throw new \InvalidArgumentException('non-nullable moduleprojectlocation cannot be null');
        }
        $this->container['moduleprojectlocation'] = $moduleprojectlocation;

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
     * Gets modulesubscription
     *
     * @return bool|null
     */
    public function getModulesubscription()
    {
        return $this->container['modulesubscription'];
    }

    /**
     * Sets modulesubscription
     *
     * @param bool|null $modulesubscription modulesubscription
     *
     * @return self
     */
    public function setModulesubscription($modulesubscription)
    {
        if (is_null($modulesubscription)) {
            throw new \InvalidArgumentException('non-nullable modulesubscription cannot be null');
        }
        $this->container['modulesubscription'] = $modulesubscription;

        return $this;
    }

    /**
     * Gets completeweeklyhourlists
     *
     * @return bool|null
     */
    public function getCompleteweeklyhourlists()
    {
        return $this->container['completeweeklyhourlists'];
    }

    /**
     * Sets completeweeklyhourlists
     *
     * @param bool|null $completeweeklyhourlists completeweeklyhourlists
     *
     * @return self
     */
    public function setCompleteweeklyhourlists($completeweeklyhourlists)
    {
        if (is_null($completeweeklyhourlists)) {
            throw new \InvalidArgumentException('non-nullable completeweeklyhourlists cannot be null');
        }
        $this->container['completeweeklyhourlists'] = $completeweeklyhourlists;

        return $this;
    }

    /**
     * Gets completemonthlyhourlists
     *
     * @return bool|null
     */
    public function getCompletemonthlyhourlists()
    {
        return $this->container['completemonthlyhourlists'];
    }

    /**
     * Sets completemonthlyhourlists
     *
     * @param bool|null $completemonthlyhourlists completemonthlyhourlists
     *
     * @return self
     */
    public function setCompletemonthlyhourlists($completemonthlyhourlists)
    {
        if (is_null($completemonthlyhourlists)) {
            throw new \InvalidArgumentException('non-nullable completemonthlyhourlists cannot be null');
        }
        $this->container['completemonthlyhourlists'] = $completemonthlyhourlists;

        return $this;
    }

    /**
     * Gets approvemonthlyhourlists
     *
     * @return bool|null
     */
    public function getApprovemonthlyhourlists()
    {
        return $this->container['approvemonthlyhourlists'];
    }

    /**
     * Sets approvemonthlyhourlists
     *
     * @param bool|null $approvemonthlyhourlists approvemonthlyhourlists
     *
     * @return self
     */
    public function setApprovemonthlyhourlists($approvemonthlyhourlists)
    {
        if (is_null($approvemonthlyhourlists)) {
            throw new \InvalidArgumentException('non-nullable approvemonthlyhourlists cannot be null');
        }
        $this->container['approvemonthlyhourlists'] = $approvemonthlyhourlists;

        return $this;
    }

    /**
     * Gets moduleprojectprognosis
     *
     * @return bool|null
     */
    public function getModuleprojectprognosis()
    {
        return $this->container['moduleprojectprognosis'];
    }

    /**
     * Sets moduleprojectprognosis
     *
     * @param bool|null $moduleprojectprognosis moduleprojectprognosis
     *
     * @return self
     */
    public function setModuleprojectprognosis($moduleprojectprognosis)
    {
        if (is_null($moduleprojectprognosis)) {
            throw new \InvalidArgumentException('non-nullable moduleprojectprognosis cannot be null');
        }
        $this->container['moduleprojectprognosis'] = $moduleprojectprognosis;

        return $this;
    }

    /**
     * Gets modulebunches
     *
     * @return bool|null
     */
    public function getModulebunches()
    {
        return $this->container['modulebunches'];
    }

    /**
     * Sets modulebunches
     *
     * @param bool|null $modulebunches modulebunches
     *
     * @return self
     */
    public function setModulebunches($modulebunches)
    {
        if (is_null($modulebunches)) {
            throw new \InvalidArgumentException('non-nullable modulebunches cannot be null');
        }
        $this->container['modulebunches'] = $modulebunches;

        return $this;
    }

    /**
     * Gets module_vacation_balance
     *
     * @return bool|null
     */
    public function getModuleVacationBalance()
    {
        return $this->container['module_vacation_balance'];
    }

    /**
     * Sets module_vacation_balance
     *
     * @param bool|null $module_vacation_balance module_vacation_balance
     *
     * @return self
     */
    public function setModuleVacationBalance($module_vacation_balance)
    {
        if (is_null($module_vacation_balance)) {
            throw new \InvalidArgumentException('non-nullable module_vacation_balance cannot be null');
        }
        $this->container['module_vacation_balance'] = $module_vacation_balance;

        return $this;
    }

    /**
     * Gets module_accounting_reports
     *
     * @return bool|null
     */
    public function getModuleAccountingReports()
    {
        return $this->container['module_accounting_reports'];
    }

    /**
     * Sets module_accounting_reports
     *
     * @param bool|null $module_accounting_reports module_accounting_reports
     *
     * @return self
     */
    public function setModuleAccountingReports($module_accounting_reports)
    {
        if (is_null($module_accounting_reports)) {
            throw new \InvalidArgumentException('non-nullable module_accounting_reports cannot be null');
        }
        $this->container['module_accounting_reports'] = $module_accounting_reports;

        return $this;
    }

    /**
     * Gets module_customer_categories
     *
     * @return bool|null
     */
    public function getModuleCustomerCategories()
    {
        return $this->container['module_customer_categories'];
    }

    /**
     * Sets module_customer_categories
     *
     * @param bool|null $module_customer_categories module_customer_categories
     *
     * @return self
     */
    public function setModuleCustomerCategories($module_customer_categories)
    {
        if (is_null($module_customer_categories)) {
            throw new \InvalidArgumentException('non-nullable module_customer_categories cannot be null');
        }
        $this->container['module_customer_categories'] = $module_customer_categories;

        return $this;
    }

    /**
     * Gets module_customer_category1
     *
     * @return bool|null
     */
    public function getModuleCustomerCategory1()
    {
        return $this->container['module_customer_category1'];
    }

    /**
     * Sets module_customer_category1
     *
     * @param bool|null $module_customer_category1 module_customer_category1
     *
     * @return self
     */
    public function setModuleCustomerCategory1($module_customer_category1)
    {
        if (is_null($module_customer_category1)) {
            throw new \InvalidArgumentException('non-nullable module_customer_category1 cannot be null');
        }
        $this->container['module_customer_category1'] = $module_customer_category1;

        return $this;
    }

    /**
     * Gets module_customer_category2
     *
     * @return bool|null
     */
    public function getModuleCustomerCategory2()
    {
        return $this->container['module_customer_category2'];
    }

    /**
     * Sets module_customer_category2
     *
     * @param bool|null $module_customer_category2 module_customer_category2
     *
     * @return self
     */
    public function setModuleCustomerCategory2($module_customer_category2)
    {
        if (is_null($module_customer_category2)) {
            throw new \InvalidArgumentException('non-nullable module_customer_category2 cannot be null');
        }
        $this->container['module_customer_category2'] = $module_customer_category2;

        return $this;
    }

    /**
     * Gets module_customer_category3
     *
     * @return bool|null
     */
    public function getModuleCustomerCategory3()
    {
        return $this->container['module_customer_category3'];
    }

    /**
     * Sets module_customer_category3
     *
     * @param bool|null $module_customer_category3 module_customer_category3
     *
     * @return self
     */
    public function setModuleCustomerCategory3($module_customer_category3)
    {
        if (is_null($module_customer_category3)) {
            throw new \InvalidArgumentException('non-nullable module_customer_category3 cannot be null');
        }
        $this->container['module_customer_category3'] = $module_customer_category3;

        return $this;
    }

    /**
     * Gets moduleprojectsubcontract
     *
     * @return bool|null
     */
    public function getModuleprojectsubcontract()
    {
        return $this->container['moduleprojectsubcontract'];
    }

    /**
     * Sets moduleprojectsubcontract
     *
     * @param bool|null $moduleprojectsubcontract moduleprojectsubcontract
     *
     * @return self
     */
    public function setModuleprojectsubcontract($moduleprojectsubcontract)
    {
        if (is_null($moduleprojectsubcontract)) {
            throw new \InvalidArgumentException('non-nullable moduleprojectsubcontract cannot be null');
        }
        $this->container['moduleprojectsubcontract'] = $moduleprojectsubcontract;

        return $this;
    }

    /**
     * Gets module_payroll_accounting
     *
     * @return bool|null
     */
    public function getModulePayrollAccounting()
    {
        return $this->container['module_payroll_accounting'];
    }

    /**
     * Sets module_payroll_accounting
     *
     * @param bool|null $module_payroll_accounting module_payroll_accounting
     *
     * @return self
     */
    public function setModulePayrollAccounting($module_payroll_accounting)
    {
        if (is_null($module_payroll_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_payroll_accounting cannot be null');
        }
        $this->container['module_payroll_accounting'] = $module_payroll_accounting;

        return $this;
    }

    /**
     * Gets module_time_balance
     *
     * @return bool|null
     */
    public function getModuleTimeBalance()
    {
        return $this->container['module_time_balance'];
    }

    /**
     * Sets module_time_balance
     *
     * @param bool|null $module_time_balance module_time_balance
     *
     * @return self
     */
    public function setModuleTimeBalance($module_time_balance)
    {
        if (is_null($module_time_balance)) {
            throw new \InvalidArgumentException('non-nullable module_time_balance cannot be null');
        }
        $this->container['module_time_balance'] = $module_time_balance;

        return $this;
    }

    /**
     * Gets module_working_hours
     *
     * @return bool|null
     */
    public function getModuleWorkingHours()
    {
        return $this->container['module_working_hours'];
    }

    /**
     * Sets module_working_hours
     *
     * @param bool|null $module_working_hours module_working_hours
     *
     * @return self
     */
    public function setModuleWorkingHours($module_working_hours)
    {
        if (is_null($module_working_hours)) {
            throw new \InvalidArgumentException('non-nullable module_working_hours cannot be null');
        }
        $this->container['module_working_hours'] = $module_working_hours;

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
     * Gets module_wage_export
     *
     * @return bool|null
     */
    public function getModuleWageExport()
    {
        return $this->container['module_wage_export'];
    }

    /**
     * Sets module_wage_export
     *
     * @param bool|null $module_wage_export module_wage_export
     *
     * @return self
     */
    public function setModuleWageExport($module_wage_export)
    {
        if (is_null($module_wage_export)) {
            throw new \InvalidArgumentException('non-nullable module_wage_export cannot be null');
        }
        $this->container['module_wage_export'] = $module_wage_export;

        return $this;
    }

    /**
     * Gets module_auto_customer_number
     *
     * @return bool|null
     */
    public function getModuleAutoCustomerNumber()
    {
        return $this->container['module_auto_customer_number'];
    }

    /**
     * Sets module_auto_customer_number
     *
     * @param bool|null $module_auto_customer_number module_auto_customer_number
     *
     * @return self
     */
    public function setModuleAutoCustomerNumber($module_auto_customer_number)
    {
        if (is_null($module_auto_customer_number)) {
            throw new \InvalidArgumentException('non-nullable module_auto_customer_number cannot be null');
        }
        $this->container['module_auto_customer_number'] = $module_auto_customer_number;

        return $this;
    }

    /**
     * Gets module_auto_vendor_number
     *
     * @return bool|null
     */
    public function getModuleAutoVendorNumber()
    {
        return $this->container['module_auto_vendor_number'];
    }

    /**
     * Sets module_auto_vendor_number
     *
     * @param bool|null $module_auto_vendor_number module_auto_vendor_number
     *
     * @return self
     */
    public function setModuleAutoVendorNumber($module_auto_vendor_number)
    {
        if (is_null($module_auto_vendor_number)) {
            throw new \InvalidArgumentException('non-nullable module_auto_vendor_number cannot be null');
        }
        $this->container['module_auto_vendor_number'] = $module_auto_vendor_number;

        return $this;
    }

    /**
     * Gets module_provision_salary
     *
     * @return bool|null
     */
    public function getModuleProvisionSalary()
    {
        return $this->container['module_provision_salary'];
    }

    /**
     * Sets module_provision_salary
     *
     * @param bool|null $module_provision_salary module_provision_salary
     *
     * @return self
     */
    public function setModuleProvisionSalary($module_provision_salary)
    {
        if (is_null($module_provision_salary)) {
            throw new \InvalidArgumentException('non-nullable module_provision_salary cannot be null');
        }
        $this->container['module_provision_salary'] = $module_provision_salary;

        return $this;
    }

    /**
     * Gets module_order_number
     *
     * @return bool|null
     */
    public function getModuleOrderNumber()
    {
        return $this->container['module_order_number'];
    }

    /**
     * Sets module_order_number
     *
     * @param bool|null $module_order_number module_order_number
     *
     * @return self
     */
    public function setModuleOrderNumber($module_order_number)
    {
        if (is_null($module_order_number)) {
            throw new \InvalidArgumentException('non-nullable module_order_number cannot be null');
        }
        $this->container['module_order_number'] = $module_order_number;

        return $this;
    }

    /**
     * Gets module_order_discount
     *
     * @return bool|null
     */
    public function getModuleOrderDiscount()
    {
        return $this->container['module_order_discount'];
    }

    /**
     * Sets module_order_discount
     *
     * @param bool|null $module_order_discount module_order_discount
     *
     * @return self
     */
    public function setModuleOrderDiscount($module_order_discount)
    {
        if (is_null($module_order_discount)) {
            throw new \InvalidArgumentException('non-nullable module_order_discount cannot be null');
        }
        $this->container['module_order_discount'] = $module_order_discount;

        return $this;
    }

    /**
     * Gets module_order_markup
     *
     * @return bool|null
     */
    public function getModuleOrderMarkup()
    {
        return $this->container['module_order_markup'];
    }

    /**
     * Sets module_order_markup
     *
     * @param bool|null $module_order_markup module_order_markup
     *
     * @return self
     */
    public function setModuleOrderMarkup($module_order_markup)
    {
        if (is_null($module_order_markup)) {
            throw new \InvalidArgumentException('non-nullable module_order_markup cannot be null');
        }
        $this->container['module_order_markup'] = $module_order_markup;

        return $this;
    }

    /**
     * Gets module_order_line_cost
     *
     * @return bool|null
     */
    public function getModuleOrderLineCost()
    {
        return $this->container['module_order_line_cost'];
    }

    /**
     * Sets module_order_line_cost
     *
     * @param bool|null $module_order_line_cost module_order_line_cost
     *
     * @return self
     */
    public function setModuleOrderLineCost($module_order_line_cost)
    {
        if (is_null($module_order_line_cost)) {
            throw new \InvalidArgumentException('non-nullable module_order_line_cost cannot be null');
        }
        $this->container['module_order_line_cost'] = $module_order_line_cost;

        return $this;
    }

    /**
     * Gets module_stop_watch
     *
     * @return bool|null
     */
    public function getModuleStopWatch()
    {
        return $this->container['module_stop_watch'];
    }

    /**
     * Sets module_stop_watch
     *
     * @param bool|null $module_stop_watch module_stop_watch
     *
     * @return self
     */
    public function setModuleStopWatch($module_stop_watch)
    {
        if (is_null($module_stop_watch)) {
            throw new \InvalidArgumentException('non-nullable module_stop_watch cannot be null');
        }
        $this->container['module_stop_watch'] = $module_stop_watch;

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
     * Gets module_auto_project_number
     *
     * @return bool|null
     */
    public function getModuleAutoProjectNumber()
    {
        return $this->container['module_auto_project_number'];
    }

    /**
     * Sets module_auto_project_number
     *
     * @param bool|null $module_auto_project_number module_auto_project_number
     *
     * @return self
     */
    public function setModuleAutoProjectNumber($module_auto_project_number)
    {
        if (is_null($module_auto_project_number)) {
            throw new \InvalidArgumentException('non-nullable module_auto_project_number cannot be null');
        }
        $this->container['module_auto_project_number'] = $module_auto_project_number;

        return $this;
    }

    /**
     * Gets module_swedish
     *
     * @return bool|null
     */
    public function getModuleSwedish()
    {
        return $this->container['module_swedish'];
    }

    /**
     * Sets module_swedish
     *
     * @param bool|null $module_swedish module_swedish
     *
     * @return self
     */
    public function setModuleSwedish($module_swedish)
    {
        if (is_null($module_swedish)) {
            throw new \InvalidArgumentException('non-nullable module_swedish cannot be null');
        }
        $this->container['module_swedish'] = $module_swedish;

        return $this;
    }

    /**
     * Gets module_resource_groups
     *
     * @return bool|null
     */
    public function getModuleResourceGroups()
    {
        return $this->container['module_resource_groups'];
    }

    /**
     * Sets module_resource_groups
     *
     * @param bool|null $module_resource_groups module_resource_groups
     *
     * @return self
     */
    public function setModuleResourceGroups($module_resource_groups)
    {
        if (is_null($module_resource_groups)) {
            throw new \InvalidArgumentException('non-nullable module_resource_groups cannot be null');
        }
        $this->container['module_resource_groups'] = $module_resource_groups;

        return $this;
    }

    /**
     * Gets module_ocr
     *
     * @return bool|null
     */
    public function getModuleOcr()
    {
        return $this->container['module_ocr'];
    }

    /**
     * Sets module_ocr
     *
     * @param bool|null $module_ocr module_ocr
     *
     * @return self
     */
    public function setModuleOcr($module_ocr)
    {
        if (is_null($module_ocr)) {
            throw new \InvalidArgumentException('non-nullable module_ocr cannot be null');
        }
        $this->container['module_ocr'] = $module_ocr;

        return $this;
    }

    /**
     * Gets module_travel_expense_rates
     *
     * @return bool|null
     */
    public function getModuleTravelExpenseRates()
    {
        return $this->container['module_travel_expense_rates'];
    }

    /**
     * Sets module_travel_expense_rates
     *
     * @param bool|null $module_travel_expense_rates module_travel_expense_rates
     *
     * @return self
     */
    public function setModuleTravelExpenseRates($module_travel_expense_rates)
    {
        if (is_null($module_travel_expense_rates)) {
            throw new \InvalidArgumentException('non-nullable module_travel_expense_rates cannot be null');
        }
        $this->container['module_travel_expense_rates'] = $module_travel_expense_rates;

        return $this;
    }

    /**
     * Gets monthly_hourlist_minus_time_warning
     *
     * @return bool|null
     */
    public function getMonthlyHourlistMinusTimeWarning()
    {
        return $this->container['monthly_hourlist_minus_time_warning'];
    }

    /**
     * Sets monthly_hourlist_minus_time_warning
     *
     * @param bool|null $monthly_hourlist_minus_time_warning monthly_hourlist_minus_time_warning
     *
     * @return self
     */
    public function setMonthlyHourlistMinusTimeWarning($monthly_hourlist_minus_time_warning)
    {
        if (is_null($monthly_hourlist_minus_time_warning)) {
            throw new \InvalidArgumentException('non-nullable monthly_hourlist_minus_time_warning cannot be null');
        }
        $this->container['monthly_hourlist_minus_time_warning'] = $monthly_hourlist_minus_time_warning;

        return $this;
    }

    /**
     * Gets module_voucher_scanning
     *
     * @return bool|null
     */
    public function getModuleVoucherScanning()
    {
        return $this->container['module_voucher_scanning'];
    }

    /**
     * Sets module_voucher_scanning
     *
     * @param bool|null $module_voucher_scanning module_voucher_scanning
     *
     * @return self
     */
    public function setModuleVoucherScanning($module_voucher_scanning)
    {
        if (is_null($module_voucher_scanning)) {
            throw new \InvalidArgumentException('non-nullable module_voucher_scanning cannot be null');
        }
        $this->container['module_voucher_scanning'] = $module_voucher_scanning;

        return $this;
    }

    /**
     * Gets module_invoice_scanning
     *
     * @return bool|null
     */
    public function getModuleInvoiceScanning()
    {
        return $this->container['module_invoice_scanning'];
    }

    /**
     * Sets module_invoice_scanning
     *
     * @param bool|null $module_invoice_scanning module_invoice_scanning
     *
     * @return self
     */
    public function setModuleInvoiceScanning($module_invoice_scanning)
    {
        if (is_null($module_invoice_scanning)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_scanning cannot be null');
        }
        $this->container['module_invoice_scanning'] = $module_invoice_scanning;

        return $this;
    }

    /**
     * Gets module_project_participants
     *
     * @return bool|null
     */
    public function getModuleProjectParticipants()
    {
        return $this->container['module_project_participants'];
    }

    /**
     * Sets module_project_participants
     *
     * @param bool|null $module_project_participants module_project_participants
     *
     * @return self
     */
    public function setModuleProjectParticipants($module_project_participants)
    {
        if (is_null($module_project_participants)) {
            throw new \InvalidArgumentException('non-nullable module_project_participants cannot be null');
        }
        $this->container['module_project_participants'] = $module_project_participants;

        return $this;
    }

    /**
     * Gets module_holyday_plan
     *
     * @return bool|null
     */
    public function getModuleHolydayPlan()
    {
        return $this->container['module_holyday_plan'];
    }

    /**
     * Sets module_holyday_plan
     *
     * @param bool|null $module_holyday_plan module_holyday_plan
     *
     * @return self
     */
    public function setModuleHolydayPlan($module_holyday_plan)
    {
        if (is_null($module_holyday_plan)) {
            throw new \InvalidArgumentException('non-nullable module_holyday_plan cannot be null');
        }
        $this->container['module_holyday_plan'] = $module_holyday_plan;

        return $this;
    }

    /**
     * Gets module_employee_category
     *
     * @return bool|null
     */
    public function getModuleEmployeeCategory()
    {
        return $this->container['module_employee_category'];
    }

    /**
     * Sets module_employee_category
     *
     * @param bool|null $module_employee_category module_employee_category
     *
     * @return self
     */
    public function setModuleEmployeeCategory($module_employee_category)
    {
        if (is_null($module_employee_category)) {
            throw new \InvalidArgumentException('non-nullable module_employee_category cannot be null');
        }
        $this->container['module_employee_category'] = $module_employee_category;

        return $this;
    }

    /**
     * Gets module_product_invoice
     *
     * @return bool|null
     */
    public function getModuleProductInvoice()
    {
        return $this->container['module_product_invoice'];
    }

    /**
     * Sets module_product_invoice
     *
     * @param bool|null $module_product_invoice module_product_invoice
     *
     * @return self
     */
    public function setModuleProductInvoice($module_product_invoice)
    {
        if (is_null($module_product_invoice)) {
            throw new \InvalidArgumentException('non-nullable module_product_invoice cannot be null');
        }
        $this->container['module_product_invoice'] = $module_product_invoice;

        return $this;
    }

    /**
     * Gets auto_invoicing
     *
     * @return bool|null
     */
    public function getAutoInvoicing()
    {
        return $this->container['auto_invoicing'];
    }

    /**
     * Sets auto_invoicing
     *
     * @param bool|null $auto_invoicing auto_invoicing
     *
     * @return self
     */
    public function setAutoInvoicing($auto_invoicing)
    {
        if (is_null($auto_invoicing)) {
            throw new \InvalidArgumentException('non-nullable auto_invoicing cannot be null');
        }
        $this->container['auto_invoicing'] = $auto_invoicing;

        return $this;
    }

    /**
     * Gets module_invoice_fee_comment
     *
     * @return bool|null
     */
    public function getModuleInvoiceFeeComment()
    {
        return $this->container['module_invoice_fee_comment'];
    }

    /**
     * Sets module_invoice_fee_comment
     *
     * @param bool|null $module_invoice_fee_comment module_invoice_fee_comment
     *
     * @return self
     */
    public function setModuleInvoiceFeeComment($module_invoice_fee_comment)
    {
        if (is_null($module_invoice_fee_comment)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_fee_comment cannot be null');
        }
        $this->container['module_invoice_fee_comment'] = $module_invoice_fee_comment;

        return $this;
    }

    /**
     * Gets module_employee_accounting
     *
     * @return bool|null
     */
    public function getModuleEmployeeAccounting()
    {
        return $this->container['module_employee_accounting'];
    }

    /**
     * Sets module_employee_accounting
     *
     * @param bool|null $module_employee_accounting module_employee_accounting
     *
     * @return self
     */
    public function setModuleEmployeeAccounting($module_employee_accounting)
    {
        if (is_null($module_employee_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_employee_accounting cannot be null');
        }
        $this->container['module_employee_accounting'] = $module_employee_accounting;

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
     * @param bool|null $module_project_accounting module_project_accounting
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
     * @param bool|null $module_product_accounting module_product_accounting
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
     * Gets module_subscription_address_list
     *
     * @return bool|null
     */
    public function getModuleSubscriptionAddressList()
    {
        return $this->container['module_subscription_address_list'];
    }

    /**
     * Sets module_subscription_address_list
     *
     * @param bool|null $module_subscription_address_list module_subscription_address_list
     *
     * @return self
     */
    public function setModuleSubscriptionAddressList($module_subscription_address_list)
    {
        if (is_null($module_subscription_address_list)) {
            throw new \InvalidArgumentException('non-nullable module_subscription_address_list cannot be null');
        }
        $this->container['module_subscription_address_list'] = $module_subscription_address_list;

        return $this;
    }

    /**
     * Gets module_electro
     *
     * @return bool|null
     */
    public function getModuleElectro()
    {
        return $this->container['module_electro'];
    }

    /**
     * Sets module_electro
     *
     * @param bool|null $module_electro module_electro
     *
     * @return self
     */
    public function setModuleElectro($module_electro)
    {
        if (is_null($module_electro)) {
            throw new \InvalidArgumentException('non-nullable module_electro cannot be null');
        }
        $this->container['module_electro'] = $module_electro;

        return $this;
    }

    /**
     * Gets module_nrf
     *
     * @return bool|null
     */
    public function getModuleNrf()
    {
        return $this->container['module_nrf'];
    }

    /**
     * Sets module_nrf
     *
     * @param bool|null $module_nrf module_nrf
     *
     * @return self
     */
    public function setModuleNrf($module_nrf)
    {
        if (is_null($module_nrf)) {
            throw new \InvalidArgumentException('non-nullable module_nrf cannot be null');
        }
        $this->container['module_nrf'] = $module_nrf;

        return $this;
    }

    /**
     * Gets module_gtin
     *
     * @return bool|null
     */
    public function getModuleGtin()
    {
        return $this->container['module_gtin'];
    }

    /**
     * Sets module_gtin
     *
     * @param bool|null $module_gtin module_gtin
     *
     * @return self
     */
    public function setModuleGtin($module_gtin)
    {
        if (is_null($module_gtin)) {
            throw new \InvalidArgumentException('non-nullable module_gtin cannot be null');
        }
        $this->container['module_gtin'] = $module_gtin;

        return $this;
    }

    /**
     * Gets module_elproffen
     *
     * @return bool|null
     */
    public function getModuleElproffen()
    {
        return $this->container['module_elproffen'];
    }

    /**
     * Sets module_elproffen
     *
     * @param bool|null $module_elproffen module_elproffen
     *
     * @return self
     */
    public function setModuleElproffen($module_elproffen)
    {
        if (is_null($module_elproffen)) {
            throw new \InvalidArgumentException('non-nullable module_elproffen cannot be null');
        }
        $this->container['module_elproffen'] = $module_elproffen;

        return $this;
    }

    /**
     * Gets module_rorkjop
     *
     * @return bool|null
     */
    public function getModuleRorkjop()
    {
        return $this->container['module_rorkjop'];
    }

    /**
     * Sets module_rorkjop
     *
     * @param bool|null $module_rorkjop module_rorkjop
     *
     * @return self
     */
    public function setModuleRorkjop($module_rorkjop)
    {
        if (is_null($module_rorkjop)) {
            throw new \InvalidArgumentException('non-nullable module_rorkjop cannot be null');
        }
        $this->container['module_rorkjop'] = $module_rorkjop;

        return $this;
    }

    /**
     * Gets module_order_ext
     *
     * @return bool|null
     */
    public function getModuleOrderExt()
    {
        return $this->container['module_order_ext'];
    }

    /**
     * Sets module_order_ext
     *
     * @param bool|null $module_order_ext module_order_ext
     *
     * @return self
     */
    public function setModuleOrderExt($module_order_ext)
    {
        if (is_null($module_order_ext)) {
            throw new \InvalidArgumentException('non-nullable module_order_ext cannot be null');
        }
        $this->container['module_order_ext'] = $module_order_ext;

        return $this;
    }

    /**
     * Gets module_result_budget
     *
     * @return bool|null
     */
    public function getModuleResultBudget()
    {
        return $this->container['module_result_budget'];
    }

    /**
     * Sets module_result_budget
     *
     * @param bool|null $module_result_budget module_result_budget
     *
     * @return self
     */
    public function setModuleResultBudget($module_result_budget)
    {
        if (is_null($module_result_budget)) {
            throw new \InvalidArgumentException('non-nullable module_result_budget cannot be null');
        }
        $this->container['module_result_budget'] = $module_result_budget;

        return $this;
    }

    /**
     * Gets module_amortization
     *
     * @return bool|null
     */
    public function getModuleAmortization()
    {
        return $this->container['module_amortization'];
    }

    /**
     * Sets module_amortization
     *
     * @param bool|null $module_amortization module_amortization
     *
     * @return self
     */
    public function setModuleAmortization($module_amortization)
    {
        if (is_null($module_amortization)) {
            throw new \InvalidArgumentException('non-nullable module_amortization cannot be null');
        }
        $this->container['module_amortization'] = $module_amortization;

        return $this;
    }

    /**
     * Gets module_change_debt_collector
     *
     * @return bool|null
     */
    public function getModuleChangeDebtCollector()
    {
        return $this->container['module_change_debt_collector'];
    }

    /**
     * Sets module_change_debt_collector
     *
     * @param bool|null $module_change_debt_collector module_change_debt_collector
     *
     * @return self
     */
    public function setModuleChangeDebtCollector($module_change_debt_collector)
    {
        if (is_null($module_change_debt_collector)) {
            throw new \InvalidArgumentException('non-nullable module_change_debt_collector cannot be null');
        }
        $this->container['module_change_debt_collector'] = $module_change_debt_collector;

        return $this;
    }

    /**
     * Gets module_voucher_types
     *
     * @return bool|null
     */
    public function getModuleVoucherTypes()
    {
        return $this->container['module_voucher_types'];
    }

    /**
     * Sets module_voucher_types
     *
     * @param bool|null $module_voucher_types module_voucher_types
     *
     * @return self
     */
    public function setModuleVoucherTypes($module_voucher_types)
    {
        if (is_null($module_voucher_types)) {
            throw new \InvalidArgumentException('non-nullable module_voucher_types cannot be null');
        }
        $this->container['module_voucher_types'] = $module_voucher_types;

        return $this;
    }

    /**
     * Gets module_onninen123
     *
     * @return bool|null
     */
    public function getModuleOnninen123()
    {
        return $this->container['module_onninen123'];
    }

    /**
     * Sets module_onninen123
     *
     * @param bool|null $module_onninen123 module_onninen123
     *
     * @return self
     */
    public function setModuleOnninen123($module_onninen123)
    {
        if (is_null($module_onninen123)) {
            throw new \InvalidArgumentException('non-nullable module_onninen123 cannot be null');
        }
        $this->container['module_onninen123'] = $module_onninen123;

        return $this;
    }

    /**
     * Gets module_elektro_union
     *
     * @return bool|null
     */
    public function getModuleElektroUnion()
    {
        return $this->container['module_elektro_union'];
    }

    /**
     * Sets module_elektro_union
     *
     * @param bool|null $module_elektro_union module_elektro_union
     *
     * @return self
     */
    public function setModuleElektroUnion($module_elektro_union)
    {
        if (is_null($module_elektro_union)) {
            throw new \InvalidArgumentException('non-nullable module_elektro_union cannot be null');
        }
        $this->container['module_elektro_union'] = $module_elektro_union;

        return $this;
    }

    /**
     * Gets module_ahlsell_partner
     *
     * @return bool|null
     */
    public function getModuleAhlsellPartner()
    {
        return $this->container['module_ahlsell_partner'];
    }

    /**
     * Sets module_ahlsell_partner
     *
     * @param bool|null $module_ahlsell_partner module_ahlsell_partner
     *
     * @return self
     */
    public function setModuleAhlsellPartner($module_ahlsell_partner)
    {
        if (is_null($module_ahlsell_partner)) {
            throw new \InvalidArgumentException('non-nullable module_ahlsell_partner cannot be null');
        }
        $this->container['module_ahlsell_partner'] = $module_ahlsell_partner;

        return $this;
    }

    /**
     * Gets module_archive
     *
     * @return bool|null
     */
    public function getModuleArchive()
    {
        return $this->container['module_archive'];
    }

    /**
     * Sets module_archive
     *
     * @param bool|null $module_archive module_archive
     *
     * @return self
     */
    public function setModuleArchive($module_archive)
    {
        if (is_null($module_archive)) {
            throw new \InvalidArgumentException('non-nullable module_archive cannot be null');
        }
        $this->container['module_archive'] = $module_archive;

        return $this;
    }

    /**
     * Gets module_warehouse
     *
     * @return bool|null
     */
    public function getModuleWarehouse()
    {
        return $this->container['module_warehouse'];
    }

    /**
     * Sets module_warehouse
     *
     * @param bool|null $module_warehouse module_warehouse
     *
     * @return self
     */
    public function setModuleWarehouse($module_warehouse)
    {
        if (is_null($module_warehouse)) {
            throw new \InvalidArgumentException('non-nullable module_warehouse cannot be null');
        }
        $this->container['module_warehouse'] = $module_warehouse;

        return $this;
    }

    /**
     * Gets module_project_budget_reference_fee
     *
     * @return bool|null
     */
    public function getModuleProjectBudgetReferenceFee()
    {
        return $this->container['module_project_budget_reference_fee'];
    }

    /**
     * Sets module_project_budget_reference_fee
     *
     * @param bool|null $module_project_budget_reference_fee module_project_budget_reference_fee
     *
     * @return self
     */
    public function setModuleProjectBudgetReferenceFee($module_project_budget_reference_fee)
    {
        if (is_null($module_project_budget_reference_fee)) {
            throw new \InvalidArgumentException('non-nullable module_project_budget_reference_fee cannot be null');
        }
        $this->container['module_project_budget_reference_fee'] = $module_project_budget_reference_fee;

        return $this;
    }

    /**
     * Gets module_nets_eboks
     *
     * @return bool|null
     */
    public function getModuleNetsEboks()
    {
        return $this->container['module_nets_eboks'];
    }

    /**
     * Sets module_nets_eboks
     *
     * @param bool|null $module_nets_eboks module_nets_eboks
     *
     * @return self
     */
    public function setModuleNetsEboks($module_nets_eboks)
    {
        if (is_null($module_nets_eboks)) {
            throw new \InvalidArgumentException('non-nullable module_nets_eboks cannot be null');
        }
        $this->container['module_nets_eboks'] = $module_nets_eboks;

        return $this;
    }

    /**
     * Gets module_nets_print_salary
     *
     * @return bool|null
     */
    public function getModuleNetsPrintSalary()
    {
        return $this->container['module_nets_print_salary'];
    }

    /**
     * Sets module_nets_print_salary
     *
     * @param bool|null $module_nets_print_salary module_nets_print_salary
     *
     * @return self
     */
    public function setModuleNetsPrintSalary($module_nets_print_salary)
    {
        if (is_null($module_nets_print_salary)) {
            throw new \InvalidArgumentException('non-nullable module_nets_print_salary cannot be null');
        }
        $this->container['module_nets_print_salary'] = $module_nets_print_salary;

        return $this;
    }

    /**
     * Gets module_nets_print_invoice
     *
     * @return bool|null
     */
    public function getModuleNetsPrintInvoice()
    {
        return $this->container['module_nets_print_invoice'];
    }

    /**
     * Sets module_nets_print_invoice
     *
     * @param bool|null $module_nets_print_invoice module_nets_print_invoice
     *
     * @return self
     */
    public function setModuleNetsPrintInvoice($module_nets_print_invoice)
    {
        if (is_null($module_nets_print_invoice)) {
            throw new \InvalidArgumentException('non-nullable module_nets_print_invoice cannot be null');
        }
        $this->container['module_nets_print_invoice'] = $module_nets_print_invoice;

        return $this;
    }

    /**
     * Gets module_invoice_import
     *
     * @return bool|null
     */
    public function getModuleInvoiceImport()
    {
        return $this->container['module_invoice_import'];
    }

    /**
     * Sets module_invoice_import
     *
     * @param bool|null $module_invoice_import module_invoice_import
     *
     * @return self
     */
    public function setModuleInvoiceImport($module_invoice_import)
    {
        if (is_null($module_invoice_import)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_import cannot be null');
        }
        $this->container['module_invoice_import'] = $module_invoice_import;

        return $this;
    }

    /**
     * Gets module_email
     *
     * @return bool|null
     */
    public function getModuleEmail()
    {
        return $this->container['module_email'];
    }

    /**
     * Sets module_email
     *
     * @param bool|null $module_email module_email
     *
     * @return self
     */
    public function setModuleEmail($module_email)
    {
        if (is_null($module_email)) {
            throw new \InvalidArgumentException('non-nullable module_email cannot be null');
        }
        $this->container['module_email'] = $module_email;

        return $this;
    }

    /**
     * Gets module_ocr_auto_pay
     *
     * @return bool|null
     */
    public function getModuleOcrAutoPay()
    {
        return $this->container['module_ocr_auto_pay'];
    }

    /**
     * Sets module_ocr_auto_pay
     *
     * @param bool|null $module_ocr_auto_pay module_ocr_auto_pay
     *
     * @return self
     */
    public function setModuleOcrAutoPay($module_ocr_auto_pay)
    {
        if (is_null($module_ocr_auto_pay)) {
            throw new \InvalidArgumentException('non-nullable module_ocr_auto_pay cannot be null');
        }
        $this->container['module_ocr_auto_pay'] = $module_ocr_auto_pay;

        return $this;
    }

    /**
     * Gets module_approve_voucher
     *
     * @return bool|null
     */
    public function getModuleApproveVoucher()
    {
        return $this->container['module_approve_voucher'];
    }

    /**
     * Sets module_approve_voucher
     *
     * @param bool|null $module_approve_voucher module_approve_voucher
     *
     * @return self
     */
    public function setModuleApproveVoucher($module_approve_voucher)
    {
        if (is_null($module_approve_voucher)) {
            throw new \InvalidArgumentException('non-nullable module_approve_voucher cannot be null');
        }
        $this->container['module_approve_voucher'] = $module_approve_voucher;

        return $this;
    }

    /**
     * Gets module_approve_department_voucher
     *
     * @return bool|null
     */
    public function getModuleApproveDepartmentVoucher()
    {
        return $this->container['module_approve_department_voucher'];
    }

    /**
     * Sets module_approve_department_voucher
     *
     * @param bool|null $module_approve_department_voucher module_approve_department_voucher
     *
     * @return self
     */
    public function setModuleApproveDepartmentVoucher($module_approve_department_voucher)
    {
        if (is_null($module_approve_department_voucher)) {
            throw new \InvalidArgumentException('non-nullable module_approve_department_voucher cannot be null');
        }
        $this->container['module_approve_department_voucher'] = $module_approve_department_voucher;

        return $this;
    }

    /**
     * Gets module_approve_project_voucher
     *
     * @return bool|null
     */
    public function getModuleApproveProjectVoucher()
    {
        return $this->container['module_approve_project_voucher'];
    }

    /**
     * Sets module_approve_project_voucher
     *
     * @param bool|null $module_approve_project_voucher module_approve_project_voucher
     *
     * @return self
     */
    public function setModuleApproveProjectVoucher($module_approve_project_voucher)
    {
        if (is_null($module_approve_project_voucher)) {
            throw new \InvalidArgumentException('non-nullable module_approve_project_voucher cannot be null');
        }
        $this->container['module_approve_project_voucher'] = $module_approve_project_voucher;

        return $this;
    }

    /**
     * Gets module_order_out
     *
     * @return bool|null
     */
    public function getModuleOrderOut()
    {
        return $this->container['module_order_out'];
    }

    /**
     * Sets module_order_out
     *
     * @param bool|null $module_order_out module_order_out
     *
     * @return self
     */
    public function setModuleOrderOut($module_order_out)
    {
        if (is_null($module_order_out)) {
            throw new \InvalidArgumentException('non-nullable module_order_out cannot be null');
        }
        $this->container['module_order_out'] = $module_order_out;

        return $this;
    }

    /**
     * Gets module_mesan
     *
     * @return bool|null
     */
    public function getModuleMesan()
    {
        return $this->container['module_mesan'];
    }

    /**
     * Sets module_mesan
     *
     * @param bool|null $module_mesan module_mesan
     *
     * @return self
     */
    public function setModuleMesan($module_mesan)
    {
        if (is_null($module_mesan)) {
            throw new \InvalidArgumentException('non-nullable module_mesan cannot be null');
        }
        $this->container['module_mesan'] = $module_mesan;

        return $this;
    }

    /**
     * Gets module_divisions
     *
     * @return bool|null
     */
    public function getModuleDivisions()
    {
        return $this->container['module_divisions'];
    }

    /**
     * Sets module_divisions
     *
     * @param bool|null $module_divisions module_divisions
     *
     * @return self
     */
    public function setModuleDivisions($module_divisions)
    {
        if (is_null($module_divisions)) {
            throw new \InvalidArgumentException('non-nullable module_divisions cannot be null');
        }
        $this->container['module_divisions'] = $module_divisions;

        return $this;
    }

    /**
     * Gets module_boligmappa
     *
     * @return bool|null
     */
    public function getModuleBoligmappa()
    {
        return $this->container['module_boligmappa'];
    }

    /**
     * Sets module_boligmappa
     *
     * @param bool|null $module_boligmappa module_boligmappa
     *
     * @return self
     */
    public function setModuleBoligmappa($module_boligmappa)
    {
        if (is_null($module_boligmappa)) {
            throw new \InvalidArgumentException('non-nullable module_boligmappa cannot be null');
        }
        $this->container['module_boligmappa'] = $module_boligmappa;

        return $this;
    }

    /**
     * Gets module_addition_project_markup
     *
     * @return bool|null
     */
    public function getModuleAdditionProjectMarkup()
    {
        return $this->container['module_addition_project_markup'];
    }

    /**
     * Sets module_addition_project_markup
     *
     * @param bool|null $module_addition_project_markup module_addition_project_markup
     *
     * @return self
     */
    public function setModuleAdditionProjectMarkup($module_addition_project_markup)
    {
        if (is_null($module_addition_project_markup)) {
            throw new \InvalidArgumentException('non-nullable module_addition_project_markup cannot be null');
        }
        $this->container['module_addition_project_markup'] = $module_addition_project_markup;

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
     * Gets module_accountant_connect_client
     *
     * @return bool|null
     */
    public function getModuleAccountantConnectClient()
    {
        return $this->container['module_accountant_connect_client'];
    }

    /**
     * Sets module_accountant_connect_client
     *
     * @param bool|null $module_accountant_connect_client module_accountant_connect_client
     *
     * @return self
     */
    public function setModuleAccountantConnectClient($module_accountant_connect_client)
    {
        if (is_null($module_accountant_connect_client)) {
            throw new \InvalidArgumentException('non-nullable module_accountant_connect_client cannot be null');
        }
        $this->container['module_accountant_connect_client'] = $module_accountant_connect_client;

        return $this;
    }

    /**
     * Gets module_wage_amortization
     *
     * @return bool|null
     */
    public function getModuleWageAmortization()
    {
        return $this->container['module_wage_amortization'];
    }

    /**
     * Sets module_wage_amortization
     *
     * @param bool|null $module_wage_amortization module_wage_amortization
     *
     * @return self
     */
    public function setModuleWageAmortization($module_wage_amortization)
    {
        if (is_null($module_wage_amortization)) {
            throw new \InvalidArgumentException('non-nullable module_wage_amortization cannot be null');
        }
        $this->container['module_wage_amortization'] = $module_wage_amortization;

        return $this;
    }

    /**
     * Gets module_subscriptions_periodisation
     *
     * @return bool|null
     */
    public function getModuleSubscriptionsPeriodisation()
    {
        return $this->container['module_subscriptions_periodisation'];
    }

    /**
     * Sets module_subscriptions_periodisation
     *
     * @param bool|null $module_subscriptions_periodisation module_subscriptions_periodisation
     *
     * @return self
     */
    public function setModuleSubscriptionsPeriodisation($module_subscriptions_periodisation)
    {
        if (is_null($module_subscriptions_periodisation)) {
            throw new \InvalidArgumentException('non-nullable module_subscriptions_periodisation cannot be null');
        }
        $this->container['module_subscriptions_periodisation'] = $module_subscriptions_periodisation;

        return $this;
    }

    /**
     * Gets module_activity_hourly_wage_wage_code
     *
     * @return bool|null
     */
    public function getModuleActivityHourlyWageWageCode()
    {
        return $this->container['module_activity_hourly_wage_wage_code'];
    }

    /**
     * Sets module_activity_hourly_wage_wage_code
     *
     * @param bool|null $module_activity_hourly_wage_wage_code module_activity_hourly_wage_wage_code
     *
     * @return self
     */
    public function setModuleActivityHourlyWageWageCode($module_activity_hourly_wage_wage_code)
    {
        if (is_null($module_activity_hourly_wage_wage_code)) {
            throw new \InvalidArgumentException('non-nullable module_activity_hourly_wage_wage_code cannot be null');
        }
        $this->container['module_activity_hourly_wage_wage_code'] = $module_activity_hourly_wage_wage_code;

        return $this;
    }

    /**
     * Gets module_crm
     *
     * @return bool|null
     */
    public function getModuleCrm()
    {
        return $this->container['module_crm'];
    }

    /**
     * Sets module_crm
     *
     * @param bool|null $module_crm module_crm
     *
     * @return self
     */
    public function setModuleCrm($module_crm)
    {
        if (is_null($module_crm)) {
            throw new \InvalidArgumentException('non-nullable module_crm cannot be null');
        }
        $this->container['module_crm'] = $module_crm;

        return $this;
    }

    /**
     * Gets module_api20
     *
     * @return bool|null
     */
    public function getModuleApi20()
    {
        return $this->container['module_api20'];
    }

    /**
     * Sets module_api20
     *
     * @param bool|null $module_api20 module_api20
     *
     * @return self
     */
    public function setModuleApi20($module_api20)
    {
        if (is_null($module_api20)) {
            throw new \InvalidArgumentException('non-nullable module_api20 cannot be null');
        }
        $this->container['module_api20'] = $module_api20;

        return $this;
    }

    /**
     * Gets module_control_schema_required_invoicing
     *
     * @return bool|null
     */
    public function getModuleControlSchemaRequiredInvoicing()
    {
        return $this->container['module_control_schema_required_invoicing'];
    }

    /**
     * Sets module_control_schema_required_invoicing
     *
     * @param bool|null $module_control_schema_required_invoicing module_control_schema_required_invoicing
     *
     * @return self
     */
    public function setModuleControlSchemaRequiredInvoicing($module_control_schema_required_invoicing)
    {
        if (is_null($module_control_schema_required_invoicing)) {
            throw new \InvalidArgumentException('non-nullable module_control_schema_required_invoicing cannot be null');
        }
        $this->container['module_control_schema_required_invoicing'] = $module_control_schema_required_invoicing;

        return $this;
    }

    /**
     * Gets module_control_schema_required_hour_tracking
     *
     * @return bool|null
     */
    public function getModuleControlSchemaRequiredHourTracking()
    {
        return $this->container['module_control_schema_required_hour_tracking'];
    }

    /**
     * Sets module_control_schema_required_hour_tracking
     *
     * @param bool|null $module_control_schema_required_hour_tracking module_control_schema_required_hour_tracking
     *
     * @return self
     */
    public function setModuleControlSchemaRequiredHourTracking($module_control_schema_required_hour_tracking)
    {
        if (is_null($module_control_schema_required_hour_tracking)) {
            throw new \InvalidArgumentException('non-nullable module_control_schema_required_hour_tracking cannot be null');
        }
        $this->container['module_control_schema_required_hour_tracking'] = $module_control_schema_required_hour_tracking;

        return $this;
    }

    /**
     * Gets module_finance_tax
     *
     * @return bool|null
     */
    public function getModuleFinanceTax()
    {
        return $this->container['module_finance_tax'];
    }

    /**
     * Sets module_finance_tax
     *
     * @param bool|null $module_finance_tax module_finance_tax
     *
     * @return self
     */
    public function setModuleFinanceTax($module_finance_tax)
    {
        if (is_null($module_finance_tax)) {
            throw new \InvalidArgumentException('non-nullable module_finance_tax cannot be null');
        }
        $this->container['module_finance_tax'] = $module_finance_tax;

        return $this;
    }

    /**
     * Gets module_pensionreport
     *
     * @return bool|null
     */
    public function getModulePensionreport()
    {
        return $this->container['module_pensionreport'];
    }

    /**
     * Sets module_pensionreport
     *
     * @param bool|null $module_pensionreport module_pensionreport
     *
     * @return self
     */
    public function setModulePensionreport($module_pensionreport)
    {
        if (is_null($module_pensionreport)) {
            throw new \InvalidArgumentException('non-nullable module_pensionreport cannot be null');
        }
        $this->container['module_pensionreport'] = $module_pensionreport;

        return $this;
    }

    /**
     * Gets module_agro
     *
     * @return bool|null
     */
    public function getModuleAgro()
    {
        return $this->container['module_agro'];
    }

    /**
     * Sets module_agro
     *
     * @param bool|null $module_agro module_agro
     *
     * @return self
     */
    public function setModuleAgro($module_agro)
    {
        if (is_null($module_agro)) {
            throw new \InvalidArgumentException('non-nullable module_agro cannot be null');
        }
        $this->container['module_agro'] = $module_agro;

        return $this;
    }

    /**
     * Gets module_mamut
     *
     * @return bool|null
     */
    public function getModuleMamut()
    {
        return $this->container['module_mamut'];
    }

    /**
     * Sets module_mamut
     *
     * @param bool|null $module_mamut module_mamut
     *
     * @return self
     */
    public function setModuleMamut($module_mamut)
    {
        if (is_null($module_mamut)) {
            throw new \InvalidArgumentException('non-nullable module_mamut cannot be null');
        }
        $this->container['module_mamut'] = $module_mamut;

        return $this;
    }

    /**
     * Gets module_invoice_option_paper
     *
     * @return bool|null
     */
    public function getModuleInvoiceOptionPaper()
    {
        return $this->container['module_invoice_option_paper'];
    }

    /**
     * Sets module_invoice_option_paper
     *
     * @param bool|null $module_invoice_option_paper module_invoice_option_paper
     *
     * @return self
     */
    public function setModuleInvoiceOptionPaper($module_invoice_option_paper)
    {
        if (is_null($module_invoice_option_paper)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_option_paper cannot be null');
        }
        $this->container['module_invoice_option_paper'] = $module_invoice_option_paper;

        return $this;
    }

    /**
     * Gets module_smart_scan
     *
     * @return bool|null
     */
    public function getModuleSmartScan()
    {
        return $this->container['module_smart_scan'];
    }

    /**
     * Sets module_smart_scan
     *
     * @param bool|null $module_smart_scan module_smart_scan
     *
     * @return self
     */
    public function setModuleSmartScan($module_smart_scan)
    {
        if (is_null($module_smart_scan)) {
            throw new \InvalidArgumentException('non-nullable module_smart_scan cannot be null');
        }
        $this->container['module_smart_scan'] = $module_smart_scan;

        return $this;
    }

    /**
     * Gets module_offer
     *
     * @return bool|null
     */
    public function getModuleOffer()
    {
        return $this->container['module_offer'];
    }

    /**
     * Sets module_offer
     *
     * @param bool|null $module_offer module_offer
     *
     * @return self
     */
    public function setModuleOffer($module_offer)
    {
        if (is_null($module_offer)) {
            throw new \InvalidArgumentException('non-nullable module_offer cannot be null');
        }
        $this->container['module_offer'] = $module_offer;

        return $this;
    }

    /**
     * Gets module_auto_bank_reconciliation
     *
     * @return bool|null
     */
    public function getModuleAutoBankReconciliation()
    {
        return $this->container['module_auto_bank_reconciliation'];
    }

    /**
     * Sets module_auto_bank_reconciliation
     *
     * @param bool|null $module_auto_bank_reconciliation module_auto_bank_reconciliation
     *
     * @return self
     */
    public function setModuleAutoBankReconciliation($module_auto_bank_reconciliation)
    {
        if (is_null($module_auto_bank_reconciliation)) {
            throw new \InvalidArgumentException('non-nullable module_auto_bank_reconciliation cannot be null');
        }
        $this->container['module_auto_bank_reconciliation'] = $module_auto_bank_reconciliation;

        return $this;
    }

    /**
     * Gets module_voucher_automation
     *
     * @return bool|null
     */
    public function getModuleVoucherAutomation()
    {
        return $this->container['module_voucher_automation'];
    }

    /**
     * Sets module_voucher_automation
     *
     * @param bool|null $module_voucher_automation module_voucher_automation
     *
     * @return self
     */
    public function setModuleVoucherAutomation($module_voucher_automation)
    {
        if (is_null($module_voucher_automation)) {
            throw new \InvalidArgumentException('non-nullable module_voucher_automation cannot be null');
        }
        $this->container['module_voucher_automation'] = $module_voucher_automation;

        return $this;
    }

    /**
     * Gets module_encrypted_pay_slip
     *
     * @return bool|null
     */
    public function getModuleEncryptedPaySlip()
    {
        return $this->container['module_encrypted_pay_slip'];
    }

    /**
     * Sets module_encrypted_pay_slip
     *
     * @param bool|null $module_encrypted_pay_slip module_encrypted_pay_slip
     *
     * @return self
     */
    public function setModuleEncryptedPaySlip($module_encrypted_pay_slip)
    {
        if (is_null($module_encrypted_pay_slip)) {
            throw new \InvalidArgumentException('non-nullable module_encrypted_pay_slip cannot be null');
        }
        $this->container['module_encrypted_pay_slip'] = $module_encrypted_pay_slip;

        return $this;
    }

    /**
     * Gets module_invoice_option_vipps
     *
     * @return bool|null
     */
    public function getModuleInvoiceOptionVipps()
    {
        return $this->container['module_invoice_option_vipps'];
    }

    /**
     * Sets module_invoice_option_vipps
     *
     * @param bool|null $module_invoice_option_vipps module_invoice_option_vipps
     *
     * @return self
     */
    public function setModuleInvoiceOptionVipps($module_invoice_option_vipps)
    {
        if (is_null($module_invoice_option_vipps)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_option_vipps cannot be null');
        }
        $this->container['module_invoice_option_vipps'] = $module_invoice_option_vipps;

        return $this;
    }

    /**
     * Gets module_invoice_option_efaktura
     *
     * @return bool|null
     */
    public function getModuleInvoiceOptionEfaktura()
    {
        return $this->container['module_invoice_option_efaktura'];
    }

    /**
     * Sets module_invoice_option_efaktura
     *
     * @param bool|null $module_invoice_option_efaktura module_invoice_option_efaktura
     *
     * @return self
     */
    public function setModuleInvoiceOptionEfaktura($module_invoice_option_efaktura)
    {
        if (is_null($module_invoice_option_efaktura)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_option_efaktura cannot be null');
        }
        $this->container['module_invoice_option_efaktura'] = $module_invoice_option_efaktura;

        return $this;
    }

    /**
     * Gets module_invoice_option_avtale_giro
     *
     * @return bool|null
     */
    public function getModuleInvoiceOptionAvtaleGiro()
    {
        return $this->container['module_invoice_option_avtale_giro'];
    }

    /**
     * Sets module_invoice_option_avtale_giro
     *
     * @param bool|null $module_invoice_option_avtale_giro module_invoice_option_avtale_giro
     *
     * @return self
     */
    public function setModuleInvoiceOptionAvtaleGiro($module_invoice_option_avtale_giro)
    {
        if (is_null($module_invoice_option_avtale_giro)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_option_avtale_giro cannot be null');
        }
        $this->container['module_invoice_option_avtale_giro'] = $module_invoice_option_avtale_giro;

        return $this;
    }

    /**
     * Gets module_factoring_aprila
     *
     * @return bool|null
     */
    public function getModuleFactoringAprila()
    {
        return $this->container['module_factoring_aprila'];
    }

    /**
     * Sets module_factoring_aprila
     *
     * @param bool|null $module_factoring_aprila module_factoring_aprila
     *
     * @return self
     */
    public function setModuleFactoringAprila($module_factoring_aprila)
    {
        if (is_null($module_factoring_aprila)) {
            throw new \InvalidArgumentException('non-nullable module_factoring_aprila cannot be null');
        }
        $this->container['module_factoring_aprila'] = $module_factoring_aprila;

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
     * Gets module_cash_credit_aprila
     *
     * @return bool|null
     */
    public function getModuleCashCreditAprila()
    {
        return $this->container['module_cash_credit_aprila'];
    }

    /**
     * Sets module_cash_credit_aprila
     *
     * @param bool|null $module_cash_credit_aprila module_cash_credit_aprila
     *
     * @return self
     */
    public function setModuleCashCreditAprila($module_cash_credit_aprila)
    {
        if (is_null($module_cash_credit_aprila)) {
            throw new \InvalidArgumentException('non-nullable module_cash_credit_aprila cannot be null');
        }
        $this->container['module_cash_credit_aprila'] = $module_cash_credit_aprila;

        return $this;
    }

    /**
     * Gets module_invoice_option_autoinvoice_ehf
     *
     * @return bool|null
     */
    public function getModuleInvoiceOptionAutoinvoiceEhf()
    {
        return $this->container['module_invoice_option_autoinvoice_ehf'];
    }

    /**
     * Sets module_invoice_option_autoinvoice_ehf
     *
     * @param bool|null $module_invoice_option_autoinvoice_ehf module_invoice_option_autoinvoice_ehf
     *
     * @return self
     */
    public function setModuleInvoiceOptionAutoinvoiceEhf($module_invoice_option_autoinvoice_ehf)
    {
        if (is_null($module_invoice_option_autoinvoice_ehf)) {
            throw new \InvalidArgumentException('non-nullable module_invoice_option_autoinvoice_ehf cannot be null');
        }
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


