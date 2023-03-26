<?php
/**
 * ProjectSettings
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
 * ProjectSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProjectSettings implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ProjectSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'approve_hour_lists' => 'bool',
'approve_invoices' => 'bool',
'mark_ready_for_invoicing' => 'bool',
'historical_information' => 'bool',
'project_forecast' => 'bool',
'budget_on_subcontracts' => 'bool',
'project_categories' => 'bool',
'reference_fee' => 'bool',
'sort_order_projects' => 'string',
'auto_close_invoiced_projects' => 'bool',
'must_approve_registered_hours' => 'bool',
'show_project_order_lines_to_all_project_participants' => 'bool',
'hour_cost_percentage' => 'bool',
'fixed_price_projects_fee_calc_method' => 'string',
'fixed_price_projects_invoice_by_progress' => 'bool',
'project_budget_reference_fee' => 'bool',
'allow_multiple_project_invoice_vat' => 'bool',
'standard_reinvoicing' => 'bool',
'is_current_month_default_period' => 'bool',
'show_project_onboarding' => 'bool',
'auto_connect_incoming_orderline_to_project' => 'bool',
'auto_generate_project_number' => 'bool',
'auto_generate_starting_number' => 'int',
'project_name_scheme' => 'string',
'project_type_of_contract' => 'string',
'project_order_lines_sort_order' => 'string',
'project_hourly_rate_model' => 'string',
'only_project_members_can_register_info' => 'bool',
'only_project_activities_timesheet_registration' => 'bool',
'hourly_rate_projects_write_up_down' => 'bool',
'show_recently_closed_projects_on_supplier_invoice' => 'bool',
'default_project_contract_comment' => 'string',
'default_project_invoicing_comment' => 'string',
'resource_planning' => 'bool',
'resource_groups' => 'bool',
'holiday_plan' => 'bool',
'resource_plan_period' => 'string',
'control_forms_required_for_invoicing' => '\Learnist\Tripletex\Model\ProjectControlFormType[]',
'control_forms_required_for_hour_tracking' => '\Learnist\Tripletex\Model\ProjectControlFormType[]',
'use_logged_in_user_email_on_project_budget' => 'bool',
'email_on_project_budget' => 'string',
'use_logged_in_user_email_on_project_contract' => 'bool',
'email_on_project_contract' => 'string',
'use_logged_in_user_email_on_documents' => 'bool',
'email_on_documents' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'approve_hour_lists' => null,
'approve_invoices' => null,
'mark_ready_for_invoicing' => null,
'historical_information' => null,
'project_forecast' => null,
'budget_on_subcontracts' => null,
'project_categories' => null,
'reference_fee' => null,
'sort_order_projects' => null,
'auto_close_invoiced_projects' => null,
'must_approve_registered_hours' => null,
'show_project_order_lines_to_all_project_participants' => null,
'hour_cost_percentage' => null,
'fixed_price_projects_fee_calc_method' => null,
'fixed_price_projects_invoice_by_progress' => null,
'project_budget_reference_fee' => null,
'allow_multiple_project_invoice_vat' => null,
'standard_reinvoicing' => null,
'is_current_month_default_period' => null,
'show_project_onboarding' => null,
'auto_connect_incoming_orderline_to_project' => null,
'auto_generate_project_number' => null,
'auto_generate_starting_number' => 'int32',
'project_name_scheme' => null,
'project_type_of_contract' => null,
'project_order_lines_sort_order' => null,
'project_hourly_rate_model' => null,
'only_project_members_can_register_info' => null,
'only_project_activities_timesheet_registration' => null,
'hourly_rate_projects_write_up_down' => null,
'show_recently_closed_projects_on_supplier_invoice' => null,
'default_project_contract_comment' => null,
'default_project_invoicing_comment' => null,
'resource_planning' => null,
'resource_groups' => null,
'holiday_plan' => null,
'resource_plan_period' => null,
'control_forms_required_for_invoicing' => null,
'control_forms_required_for_hour_tracking' => null,
'use_logged_in_user_email_on_project_budget' => null,
'email_on_project_budget' => null,
'use_logged_in_user_email_on_project_contract' => null,
'email_on_project_contract' => null,
'use_logged_in_user_email_on_documents' => null,
'email_on_documents' => null    ];

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
        'approve_hour_lists' => 'approveHourLists',
'approve_invoices' => 'approveInvoices',
'mark_ready_for_invoicing' => 'markReadyForInvoicing',
'historical_information' => 'historicalInformation',
'project_forecast' => 'projectForecast',
'budget_on_subcontracts' => 'budgetOnSubcontracts',
'project_categories' => 'projectCategories',
'reference_fee' => 'referenceFee',
'sort_order_projects' => 'sortOrderProjects',
'auto_close_invoiced_projects' => 'autoCloseInvoicedProjects',
'must_approve_registered_hours' => 'mustApproveRegisteredHours',
'show_project_order_lines_to_all_project_participants' => 'showProjectOrderLinesToAllProjectParticipants',
'hour_cost_percentage' => 'hourCostPercentage',
'fixed_price_projects_fee_calc_method' => 'fixedPriceProjectsFeeCalcMethod',
'fixed_price_projects_invoice_by_progress' => 'fixedPriceProjectsInvoiceByProgress',
'project_budget_reference_fee' => 'projectBudgetReferenceFee',
'allow_multiple_project_invoice_vat' => 'allowMultipleProjectInvoiceVat',
'standard_reinvoicing' => 'standardReinvoicing',
'is_current_month_default_period' => 'isCurrentMonthDefaultPeriod',
'show_project_onboarding' => 'showProjectOnboarding',
'auto_connect_incoming_orderline_to_project' => 'autoConnectIncomingOrderlineToProject',
'auto_generate_project_number' => 'autoGenerateProjectNumber',
'auto_generate_starting_number' => 'autoGenerateStartingNumber',
'project_name_scheme' => 'projectNameScheme',
'project_type_of_contract' => 'projectTypeOfContract',
'project_order_lines_sort_order' => 'projectOrderLinesSortOrder',
'project_hourly_rate_model' => 'projectHourlyRateModel',
'only_project_members_can_register_info' => 'onlyProjectMembersCanRegisterInfo',
'only_project_activities_timesheet_registration' => 'onlyProjectActivitiesTimesheetRegistration',
'hourly_rate_projects_write_up_down' => 'hourlyRateProjectsWriteUpDown',
'show_recently_closed_projects_on_supplier_invoice' => 'showRecentlyClosedProjectsOnSupplierInvoice',
'default_project_contract_comment' => 'defaultProjectContractComment',
'default_project_invoicing_comment' => 'defaultProjectInvoicingComment',
'resource_planning' => 'resourcePlanning',
'resource_groups' => 'resourceGroups',
'holiday_plan' => 'holidayPlan',
'resource_plan_period' => 'resourcePlanPeriod',
'control_forms_required_for_invoicing' => 'controlFormsRequiredForInvoicing',
'control_forms_required_for_hour_tracking' => 'controlFormsRequiredForHourTracking',
'use_logged_in_user_email_on_project_budget' => 'useLoggedInUserEmailOnProjectBudget',
'email_on_project_budget' => 'emailOnProjectBudget',
'use_logged_in_user_email_on_project_contract' => 'useLoggedInUserEmailOnProjectContract',
'email_on_project_contract' => 'emailOnProjectContract',
'use_logged_in_user_email_on_documents' => 'useLoggedInUserEmailOnDocuments',
'email_on_documents' => 'emailOnDocuments'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'approve_hour_lists' => 'setApproveHourLists',
'approve_invoices' => 'setApproveInvoices',
'mark_ready_for_invoicing' => 'setMarkReadyForInvoicing',
'historical_information' => 'setHistoricalInformation',
'project_forecast' => 'setProjectForecast',
'budget_on_subcontracts' => 'setBudgetOnSubcontracts',
'project_categories' => 'setProjectCategories',
'reference_fee' => 'setReferenceFee',
'sort_order_projects' => 'setSortOrderProjects',
'auto_close_invoiced_projects' => 'setAutoCloseInvoicedProjects',
'must_approve_registered_hours' => 'setMustApproveRegisteredHours',
'show_project_order_lines_to_all_project_participants' => 'setShowProjectOrderLinesToAllProjectParticipants',
'hour_cost_percentage' => 'setHourCostPercentage',
'fixed_price_projects_fee_calc_method' => 'setFixedPriceProjectsFeeCalcMethod',
'fixed_price_projects_invoice_by_progress' => 'setFixedPriceProjectsInvoiceByProgress',
'project_budget_reference_fee' => 'setProjectBudgetReferenceFee',
'allow_multiple_project_invoice_vat' => 'setAllowMultipleProjectInvoiceVat',
'standard_reinvoicing' => 'setStandardReinvoicing',
'is_current_month_default_period' => 'setIsCurrentMonthDefaultPeriod',
'show_project_onboarding' => 'setShowProjectOnboarding',
'auto_connect_incoming_orderline_to_project' => 'setAutoConnectIncomingOrderlineToProject',
'auto_generate_project_number' => 'setAutoGenerateProjectNumber',
'auto_generate_starting_number' => 'setAutoGenerateStartingNumber',
'project_name_scheme' => 'setProjectNameScheme',
'project_type_of_contract' => 'setProjectTypeOfContract',
'project_order_lines_sort_order' => 'setProjectOrderLinesSortOrder',
'project_hourly_rate_model' => 'setProjectHourlyRateModel',
'only_project_members_can_register_info' => 'setOnlyProjectMembersCanRegisterInfo',
'only_project_activities_timesheet_registration' => 'setOnlyProjectActivitiesTimesheetRegistration',
'hourly_rate_projects_write_up_down' => 'setHourlyRateProjectsWriteUpDown',
'show_recently_closed_projects_on_supplier_invoice' => 'setShowRecentlyClosedProjectsOnSupplierInvoice',
'default_project_contract_comment' => 'setDefaultProjectContractComment',
'default_project_invoicing_comment' => 'setDefaultProjectInvoicingComment',
'resource_planning' => 'setResourcePlanning',
'resource_groups' => 'setResourceGroups',
'holiday_plan' => 'setHolidayPlan',
'resource_plan_period' => 'setResourcePlanPeriod',
'control_forms_required_for_invoicing' => 'setControlFormsRequiredForInvoicing',
'control_forms_required_for_hour_tracking' => 'setControlFormsRequiredForHourTracking',
'use_logged_in_user_email_on_project_budget' => 'setUseLoggedInUserEmailOnProjectBudget',
'email_on_project_budget' => 'setEmailOnProjectBudget',
'use_logged_in_user_email_on_project_contract' => 'setUseLoggedInUserEmailOnProjectContract',
'email_on_project_contract' => 'setEmailOnProjectContract',
'use_logged_in_user_email_on_documents' => 'setUseLoggedInUserEmailOnDocuments',
'email_on_documents' => 'setEmailOnDocuments'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'approve_hour_lists' => 'getApproveHourLists',
'approve_invoices' => 'getApproveInvoices',
'mark_ready_for_invoicing' => 'getMarkReadyForInvoicing',
'historical_information' => 'getHistoricalInformation',
'project_forecast' => 'getProjectForecast',
'budget_on_subcontracts' => 'getBudgetOnSubcontracts',
'project_categories' => 'getProjectCategories',
'reference_fee' => 'getReferenceFee',
'sort_order_projects' => 'getSortOrderProjects',
'auto_close_invoiced_projects' => 'getAutoCloseInvoicedProjects',
'must_approve_registered_hours' => 'getMustApproveRegisteredHours',
'show_project_order_lines_to_all_project_participants' => 'getShowProjectOrderLinesToAllProjectParticipants',
'hour_cost_percentage' => 'getHourCostPercentage',
'fixed_price_projects_fee_calc_method' => 'getFixedPriceProjectsFeeCalcMethod',
'fixed_price_projects_invoice_by_progress' => 'getFixedPriceProjectsInvoiceByProgress',
'project_budget_reference_fee' => 'getProjectBudgetReferenceFee',
'allow_multiple_project_invoice_vat' => 'getAllowMultipleProjectInvoiceVat',
'standard_reinvoicing' => 'getStandardReinvoicing',
'is_current_month_default_period' => 'getIsCurrentMonthDefaultPeriod',
'show_project_onboarding' => 'getShowProjectOnboarding',
'auto_connect_incoming_orderline_to_project' => 'getAutoConnectIncomingOrderlineToProject',
'auto_generate_project_number' => 'getAutoGenerateProjectNumber',
'auto_generate_starting_number' => 'getAutoGenerateStartingNumber',
'project_name_scheme' => 'getProjectNameScheme',
'project_type_of_contract' => 'getProjectTypeOfContract',
'project_order_lines_sort_order' => 'getProjectOrderLinesSortOrder',
'project_hourly_rate_model' => 'getProjectHourlyRateModel',
'only_project_members_can_register_info' => 'getOnlyProjectMembersCanRegisterInfo',
'only_project_activities_timesheet_registration' => 'getOnlyProjectActivitiesTimesheetRegistration',
'hourly_rate_projects_write_up_down' => 'getHourlyRateProjectsWriteUpDown',
'show_recently_closed_projects_on_supplier_invoice' => 'getShowRecentlyClosedProjectsOnSupplierInvoice',
'default_project_contract_comment' => 'getDefaultProjectContractComment',
'default_project_invoicing_comment' => 'getDefaultProjectInvoicingComment',
'resource_planning' => 'getResourcePlanning',
'resource_groups' => 'getResourceGroups',
'holiday_plan' => 'getHolidayPlan',
'resource_plan_period' => 'getResourcePlanPeriod',
'control_forms_required_for_invoicing' => 'getControlFormsRequiredForInvoicing',
'control_forms_required_for_hour_tracking' => 'getControlFormsRequiredForHourTracking',
'use_logged_in_user_email_on_project_budget' => 'getUseLoggedInUserEmailOnProjectBudget',
'email_on_project_budget' => 'getEmailOnProjectBudget',
'use_logged_in_user_email_on_project_contract' => 'getUseLoggedInUserEmailOnProjectContract',
'email_on_project_contract' => 'getEmailOnProjectContract',
'use_logged_in_user_email_on_documents' => 'getUseLoggedInUserEmailOnDocuments',
'email_on_documents' => 'getEmailOnDocuments'    ];

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

    const SORT_ORDER_PROJECTS_NAME_AND_NUMBER = 'SORT_ORDER_NAME_AND_NUMBER';
const SORT_ORDER_PROJECTS_NAME = 'SORT_ORDER_NAME';
const FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_INVOICED_FEE = 'FIXED_PRICE_PROJECTS_CALC_METHOD_INVOICED_FEE';
const FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_PERCENT_COMPLETED = 'FIXED_PRICE_PROJECTS_CALC_METHOD_PERCENT_COMPLETED';
const PROJECT_NAME_SCHEME_STANDARD = 'NAME_STANDARD';
const PROJECT_NAME_SCHEME_INCL_CUSTOMER_NAME = 'NAME_INCL_CUSTOMER_NAME';
const PROJECT_NAME_SCHEME_INCL_PARENT_NAME = 'NAME_INCL_PARENT_NAME';
const PROJECT_NAME_SCHEME_INCL_PARENT_NUMBER = 'NAME_INCL_PARENT_NUMBER';
const PROJECT_NAME_SCHEME_INCL_PARENT_NAME_AND_NUMBER = 'NAME_INCL_PARENT_NAME_AND_NUMBER';
const PROJECT_TYPE_OF_CONTRACT_FIXED_PRICE = 'PROJECT_FIXED_PRICE';
const PROJECT_TYPE_OF_CONTRACT_HOUR_RATES = 'PROJECT_HOUR_RATES';
const PROJECT_ORDER_LINES_SORT_ORDER_ID = 'SORT_ORDER_ID';
const PROJECT_ORDER_LINES_SORT_ORDER_DATE = 'SORT_ORDER_DATE';
const PROJECT_ORDER_LINES_SORT_ORDER_PRODUCT = 'SORT_ORDER_PRODUCT';
const PROJECT_ORDER_LINES_SORT_ORDER_CUSTOM = 'SORT_ORDER_CUSTOM';
const PROJECT_HOURLY_RATE_MODEL_PREDEFINED_HOURLY_RATES = 'TYPE_PREDEFINED_HOURLY_RATES';
const PROJECT_HOURLY_RATE_MODEL_PROJECT_SPECIFIC_HOURLY_RATES = 'TYPE_PROJECT_SPECIFIC_HOURLY_RATES';
const PROJECT_HOURLY_RATE_MODEL_FIXED_HOURLY_RATE = 'TYPE_FIXED_HOURLY_RATE';
const RESOURCE_PLAN_PERIOD_MONTH = 'PERIOD_MONTH';
const RESOURCE_PLAN_PERIOD_WEEK = 'PERIOD_WEEK';
const RESOURCE_PLAN_PERIOD_DAY = 'PERIOD_DAY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSortOrderProjectsAllowableValues()
    {
        return [
            self::SORT_ORDER_PROJECTS_NAME_AND_NUMBER,
self::SORT_ORDER_PROJECTS_NAME,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getFixedPriceProjectsFeeCalcMethodAllowableValues()
    {
        return [
            self::FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_INVOICED_FEE,
self::FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_PERCENT_COMPLETED,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectNameSchemeAllowableValues()
    {
        return [
            self::PROJECT_NAME_SCHEME_STANDARD,
self::PROJECT_NAME_SCHEME_INCL_CUSTOMER_NAME,
self::PROJECT_NAME_SCHEME_INCL_PARENT_NAME,
self::PROJECT_NAME_SCHEME_INCL_PARENT_NUMBER,
self::PROJECT_NAME_SCHEME_INCL_PARENT_NAME_AND_NUMBER,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectTypeOfContractAllowableValues()
    {
        return [
            self::PROJECT_TYPE_OF_CONTRACT_FIXED_PRICE,
self::PROJECT_TYPE_OF_CONTRACT_HOUR_RATES,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectOrderLinesSortOrderAllowableValues()
    {
        return [
            self::PROJECT_ORDER_LINES_SORT_ORDER_ID,
self::PROJECT_ORDER_LINES_SORT_ORDER_DATE,
self::PROJECT_ORDER_LINES_SORT_ORDER_PRODUCT,
self::PROJECT_ORDER_LINES_SORT_ORDER_CUSTOM,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectHourlyRateModelAllowableValues()
    {
        return [
            self::PROJECT_HOURLY_RATE_MODEL_PREDEFINED_HOURLY_RATES,
self::PROJECT_HOURLY_RATE_MODEL_PROJECT_SPECIFIC_HOURLY_RATES,
self::PROJECT_HOURLY_RATE_MODEL_FIXED_HOURLY_RATE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getResourcePlanPeriodAllowableValues()
    {
        return [
            self::RESOURCE_PLAN_PERIOD_MONTH,
self::RESOURCE_PLAN_PERIOD_WEEK,
self::RESOURCE_PLAN_PERIOD_DAY,        ];
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
        $this->container['approve_hour_lists'] = isset($data['approve_hour_lists']) ? $data['approve_hour_lists'] : null;
        $this->container['approve_invoices'] = isset($data['approve_invoices']) ? $data['approve_invoices'] : null;
        $this->container['mark_ready_for_invoicing'] = isset($data['mark_ready_for_invoicing']) ? $data['mark_ready_for_invoicing'] : null;
        $this->container['historical_information'] = isset($data['historical_information']) ? $data['historical_information'] : null;
        $this->container['project_forecast'] = isset($data['project_forecast']) ? $data['project_forecast'] : null;
        $this->container['budget_on_subcontracts'] = isset($data['budget_on_subcontracts']) ? $data['budget_on_subcontracts'] : null;
        $this->container['project_categories'] = isset($data['project_categories']) ? $data['project_categories'] : null;
        $this->container['reference_fee'] = isset($data['reference_fee']) ? $data['reference_fee'] : null;
        $this->container['sort_order_projects'] = isset($data['sort_order_projects']) ? $data['sort_order_projects'] : null;
        $this->container['auto_close_invoiced_projects'] = isset($data['auto_close_invoiced_projects']) ? $data['auto_close_invoiced_projects'] : null;
        $this->container['must_approve_registered_hours'] = isset($data['must_approve_registered_hours']) ? $data['must_approve_registered_hours'] : null;
        $this->container['show_project_order_lines_to_all_project_participants'] = isset($data['show_project_order_lines_to_all_project_participants']) ? $data['show_project_order_lines_to_all_project_participants'] : null;
        $this->container['hour_cost_percentage'] = isset($data['hour_cost_percentage']) ? $data['hour_cost_percentage'] : null;
        $this->container['fixed_price_projects_fee_calc_method'] = isset($data['fixed_price_projects_fee_calc_method']) ? $data['fixed_price_projects_fee_calc_method'] : null;
        $this->container['fixed_price_projects_invoice_by_progress'] = isset($data['fixed_price_projects_invoice_by_progress']) ? $data['fixed_price_projects_invoice_by_progress'] : null;
        $this->container['project_budget_reference_fee'] = isset($data['project_budget_reference_fee']) ? $data['project_budget_reference_fee'] : null;
        $this->container['allow_multiple_project_invoice_vat'] = isset($data['allow_multiple_project_invoice_vat']) ? $data['allow_multiple_project_invoice_vat'] : null;
        $this->container['standard_reinvoicing'] = isset($data['standard_reinvoicing']) ? $data['standard_reinvoicing'] : null;
        $this->container['is_current_month_default_period'] = isset($data['is_current_month_default_period']) ? $data['is_current_month_default_period'] : null;
        $this->container['show_project_onboarding'] = isset($data['show_project_onboarding']) ? $data['show_project_onboarding'] : null;
        $this->container['auto_connect_incoming_orderline_to_project'] = isset($data['auto_connect_incoming_orderline_to_project']) ? $data['auto_connect_incoming_orderline_to_project'] : null;
        $this->container['auto_generate_project_number'] = isset($data['auto_generate_project_number']) ? $data['auto_generate_project_number'] : null;
        $this->container['auto_generate_starting_number'] = isset($data['auto_generate_starting_number']) ? $data['auto_generate_starting_number'] : null;
        $this->container['project_name_scheme'] = isset($data['project_name_scheme']) ? $data['project_name_scheme'] : null;
        $this->container['project_type_of_contract'] = isset($data['project_type_of_contract']) ? $data['project_type_of_contract'] : null;
        $this->container['project_order_lines_sort_order'] = isset($data['project_order_lines_sort_order']) ? $data['project_order_lines_sort_order'] : null;
        $this->container['project_hourly_rate_model'] = isset($data['project_hourly_rate_model']) ? $data['project_hourly_rate_model'] : null;
        $this->container['only_project_members_can_register_info'] = isset($data['only_project_members_can_register_info']) ? $data['only_project_members_can_register_info'] : null;
        $this->container['only_project_activities_timesheet_registration'] = isset($data['only_project_activities_timesheet_registration']) ? $data['only_project_activities_timesheet_registration'] : null;
        $this->container['hourly_rate_projects_write_up_down'] = isset($data['hourly_rate_projects_write_up_down']) ? $data['hourly_rate_projects_write_up_down'] : null;
        $this->container['show_recently_closed_projects_on_supplier_invoice'] = isset($data['show_recently_closed_projects_on_supplier_invoice']) ? $data['show_recently_closed_projects_on_supplier_invoice'] : null;
        $this->container['default_project_contract_comment'] = isset($data['default_project_contract_comment']) ? $data['default_project_contract_comment'] : null;
        $this->container['default_project_invoicing_comment'] = isset($data['default_project_invoicing_comment']) ? $data['default_project_invoicing_comment'] : null;
        $this->container['resource_planning'] = isset($data['resource_planning']) ? $data['resource_planning'] : null;
        $this->container['resource_groups'] = isset($data['resource_groups']) ? $data['resource_groups'] : null;
        $this->container['holiday_plan'] = isset($data['holiday_plan']) ? $data['holiday_plan'] : null;
        $this->container['resource_plan_period'] = isset($data['resource_plan_period']) ? $data['resource_plan_period'] : null;
        $this->container['control_forms_required_for_invoicing'] = isset($data['control_forms_required_for_invoicing']) ? $data['control_forms_required_for_invoicing'] : null;
        $this->container['control_forms_required_for_hour_tracking'] = isset($data['control_forms_required_for_hour_tracking']) ? $data['control_forms_required_for_hour_tracking'] : null;
        $this->container['use_logged_in_user_email_on_project_budget'] = isset($data['use_logged_in_user_email_on_project_budget']) ? $data['use_logged_in_user_email_on_project_budget'] : null;
        $this->container['email_on_project_budget'] = isset($data['email_on_project_budget']) ? $data['email_on_project_budget'] : null;
        $this->container['use_logged_in_user_email_on_project_contract'] = isset($data['use_logged_in_user_email_on_project_contract']) ? $data['use_logged_in_user_email_on_project_contract'] : null;
        $this->container['email_on_project_contract'] = isset($data['email_on_project_contract']) ? $data['email_on_project_contract'] : null;
        $this->container['use_logged_in_user_email_on_documents'] = isset($data['use_logged_in_user_email_on_documents']) ? $data['use_logged_in_user_email_on_documents'] : null;
        $this->container['email_on_documents'] = isset($data['email_on_documents']) ? $data['email_on_documents'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getSortOrderProjectsAllowableValues();
        if (!is_null($this->container['sort_order_projects']) && !in_array($this->container['sort_order_projects'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'sort_order_projects', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getFixedPriceProjectsFeeCalcMethodAllowableValues();
        if (!is_null($this->container['fixed_price_projects_fee_calc_method']) && !in_array($this->container['fixed_price_projects_fee_calc_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'fixed_price_projects_fee_calc_method', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectNameSchemeAllowableValues();
        if (!is_null($this->container['project_name_scheme']) && !in_array($this->container['project_name_scheme'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'project_name_scheme', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectTypeOfContractAllowableValues();
        if (!is_null($this->container['project_type_of_contract']) && !in_array($this->container['project_type_of_contract'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'project_type_of_contract', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectOrderLinesSortOrderAllowableValues();
        if (!is_null($this->container['project_order_lines_sort_order']) && !in_array($this->container['project_order_lines_sort_order'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'project_order_lines_sort_order', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectHourlyRateModelAllowableValues();
        if (!is_null($this->container['project_hourly_rate_model']) && !in_array($this->container['project_hourly_rate_model'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'project_hourly_rate_model', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getResourcePlanPeriodAllowableValues();
        if (!is_null($this->container['resource_plan_period']) && !in_array($this->container['resource_plan_period'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'resource_plan_period', must be one of '%s'",
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
     * Gets approve_hour_lists
     *
     * @return bool
     */
    public function getApproveHourLists()
    {
        return $this->container['approve_hour_lists'];
    }

    /**
     * Sets approve_hour_lists
     *
     * @param bool $approve_hour_lists approve_hour_lists
     *
     * @return $this
     */
    public function setApproveHourLists($approve_hour_lists)
    {
        $this->container['approve_hour_lists'] = $approve_hour_lists;

        return $this;
    }

    /**
     * Gets approve_invoices
     *
     * @return bool
     */
    public function getApproveInvoices()
    {
        return $this->container['approve_invoices'];
    }

    /**
     * Sets approve_invoices
     *
     * @param bool $approve_invoices approve_invoices
     *
     * @return $this
     */
    public function setApproveInvoices($approve_invoices)
    {
        $this->container['approve_invoices'] = $approve_invoices;

        return $this;
    }

    /**
     * Gets mark_ready_for_invoicing
     *
     * @return bool
     */
    public function getMarkReadyForInvoicing()
    {
        return $this->container['mark_ready_for_invoicing'];
    }

    /**
     * Sets mark_ready_for_invoicing
     *
     * @param bool $mark_ready_for_invoicing mark_ready_for_invoicing
     *
     * @return $this
     */
    public function setMarkReadyForInvoicing($mark_ready_for_invoicing)
    {
        $this->container['mark_ready_for_invoicing'] = $mark_ready_for_invoicing;

        return $this;
    }

    /**
     * Gets historical_information
     *
     * @return bool
     */
    public function getHistoricalInformation()
    {
        return $this->container['historical_information'];
    }

    /**
     * Sets historical_information
     *
     * @param bool $historical_information historical_information
     *
     * @return $this
     */
    public function setHistoricalInformation($historical_information)
    {
        $this->container['historical_information'] = $historical_information;

        return $this;
    }

    /**
     * Gets project_forecast
     *
     * @return bool
     */
    public function getProjectForecast()
    {
        return $this->container['project_forecast'];
    }

    /**
     * Sets project_forecast
     *
     * @param bool $project_forecast project_forecast
     *
     * @return $this
     */
    public function setProjectForecast($project_forecast)
    {
        $this->container['project_forecast'] = $project_forecast;

        return $this;
    }

    /**
     * Gets budget_on_subcontracts
     *
     * @return bool
     */
    public function getBudgetOnSubcontracts()
    {
        return $this->container['budget_on_subcontracts'];
    }

    /**
     * Sets budget_on_subcontracts
     *
     * @param bool $budget_on_subcontracts budget_on_subcontracts
     *
     * @return $this
     */
    public function setBudgetOnSubcontracts($budget_on_subcontracts)
    {
        $this->container['budget_on_subcontracts'] = $budget_on_subcontracts;

        return $this;
    }

    /**
     * Gets project_categories
     *
     * @return bool
     */
    public function getProjectCategories()
    {
        return $this->container['project_categories'];
    }

    /**
     * Sets project_categories
     *
     * @param bool $project_categories project_categories
     *
     * @return $this
     */
    public function setProjectCategories($project_categories)
    {
        $this->container['project_categories'] = $project_categories;

        return $this;
    }

    /**
     * Gets reference_fee
     *
     * @return bool
     */
    public function getReferenceFee()
    {
        return $this->container['reference_fee'];
    }

    /**
     * Sets reference_fee
     *
     * @param bool $reference_fee reference_fee
     *
     * @return $this
     */
    public function setReferenceFee($reference_fee)
    {
        $this->container['reference_fee'] = $reference_fee;

        return $this;
    }

    /**
     * Gets sort_order_projects
     *
     * @return string
     */
    public function getSortOrderProjects()
    {
        return $this->container['sort_order_projects'];
    }

    /**
     * Sets sort_order_projects
     *
     * @param string $sort_order_projects sort_order_projects
     *
     * @return $this
     */
    public function setSortOrderProjects($sort_order_projects)
    {
        $allowedValues = $this->getSortOrderProjectsAllowableValues();
        if (!is_null($sort_order_projects) && !in_array($sort_order_projects, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'sort_order_projects', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['sort_order_projects'] = $sort_order_projects;

        return $this;
    }

    /**
     * Gets auto_close_invoiced_projects
     *
     * @return bool
     */
    public function getAutoCloseInvoicedProjects()
    {
        return $this->container['auto_close_invoiced_projects'];
    }

    /**
     * Sets auto_close_invoiced_projects
     *
     * @param bool $auto_close_invoiced_projects auto_close_invoiced_projects
     *
     * @return $this
     */
    public function setAutoCloseInvoicedProjects($auto_close_invoiced_projects)
    {
        $this->container['auto_close_invoiced_projects'] = $auto_close_invoiced_projects;

        return $this;
    }

    /**
     * Gets must_approve_registered_hours
     *
     * @return bool
     */
    public function getMustApproveRegisteredHours()
    {
        return $this->container['must_approve_registered_hours'];
    }

    /**
     * Sets must_approve_registered_hours
     *
     * @param bool $must_approve_registered_hours must_approve_registered_hours
     *
     * @return $this
     */
    public function setMustApproveRegisteredHours($must_approve_registered_hours)
    {
        $this->container['must_approve_registered_hours'] = $must_approve_registered_hours;

        return $this;
    }

    /**
     * Gets show_project_order_lines_to_all_project_participants
     *
     * @return bool
     */
    public function getShowProjectOrderLinesToAllProjectParticipants()
    {
        return $this->container['show_project_order_lines_to_all_project_participants'];
    }

    /**
     * Sets show_project_order_lines_to_all_project_participants
     *
     * @param bool $show_project_order_lines_to_all_project_participants show_project_order_lines_to_all_project_participants
     *
     * @return $this
     */
    public function setShowProjectOrderLinesToAllProjectParticipants($show_project_order_lines_to_all_project_participants)
    {
        $this->container['show_project_order_lines_to_all_project_participants'] = $show_project_order_lines_to_all_project_participants;

        return $this;
    }

    /**
     * Gets hour_cost_percentage
     *
     * @return bool
     */
    public function getHourCostPercentage()
    {
        return $this->container['hour_cost_percentage'];
    }

    /**
     * Sets hour_cost_percentage
     *
     * @param bool $hour_cost_percentage hour_cost_percentage
     *
     * @return $this
     */
    public function setHourCostPercentage($hour_cost_percentage)
    {
        $this->container['hour_cost_percentage'] = $hour_cost_percentage;

        return $this;
    }

    /**
     * Gets fixed_price_projects_fee_calc_method
     *
     * @return string
     */
    public function getFixedPriceProjectsFeeCalcMethod()
    {
        return $this->container['fixed_price_projects_fee_calc_method'];
    }

    /**
     * Sets fixed_price_projects_fee_calc_method
     *
     * @param string $fixed_price_projects_fee_calc_method fixed_price_projects_fee_calc_method
     *
     * @return $this
     */
    public function setFixedPriceProjectsFeeCalcMethod($fixed_price_projects_fee_calc_method)
    {
        $allowedValues = $this->getFixedPriceProjectsFeeCalcMethodAllowableValues();
        if (!is_null($fixed_price_projects_fee_calc_method) && !in_array($fixed_price_projects_fee_calc_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'fixed_price_projects_fee_calc_method', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['fixed_price_projects_fee_calc_method'] = $fixed_price_projects_fee_calc_method;

        return $this;
    }

    /**
     * Gets fixed_price_projects_invoice_by_progress
     *
     * @return bool
     */
    public function getFixedPriceProjectsInvoiceByProgress()
    {
        return $this->container['fixed_price_projects_invoice_by_progress'];
    }

    /**
     * Sets fixed_price_projects_invoice_by_progress
     *
     * @param bool $fixed_price_projects_invoice_by_progress fixed_price_projects_invoice_by_progress
     *
     * @return $this
     */
    public function setFixedPriceProjectsInvoiceByProgress($fixed_price_projects_invoice_by_progress)
    {
        $this->container['fixed_price_projects_invoice_by_progress'] = $fixed_price_projects_invoice_by_progress;

        return $this;
    }

    /**
     * Gets project_budget_reference_fee
     *
     * @return bool
     */
    public function getProjectBudgetReferenceFee()
    {
        return $this->container['project_budget_reference_fee'];
    }

    /**
     * Sets project_budget_reference_fee
     *
     * @param bool $project_budget_reference_fee project_budget_reference_fee
     *
     * @return $this
     */
    public function setProjectBudgetReferenceFee($project_budget_reference_fee)
    {
        $this->container['project_budget_reference_fee'] = $project_budget_reference_fee;

        return $this;
    }

    /**
     * Gets allow_multiple_project_invoice_vat
     *
     * @return bool
     */
    public function getAllowMultipleProjectInvoiceVat()
    {
        return $this->container['allow_multiple_project_invoice_vat'];
    }

    /**
     * Sets allow_multiple_project_invoice_vat
     *
     * @param bool $allow_multiple_project_invoice_vat allow_multiple_project_invoice_vat
     *
     * @return $this
     */
    public function setAllowMultipleProjectInvoiceVat($allow_multiple_project_invoice_vat)
    {
        $this->container['allow_multiple_project_invoice_vat'] = $allow_multiple_project_invoice_vat;

        return $this;
    }

    /**
     * Gets standard_reinvoicing
     *
     * @return bool
     */
    public function getStandardReinvoicing()
    {
        return $this->container['standard_reinvoicing'];
    }

    /**
     * Sets standard_reinvoicing
     *
     * @param bool $standard_reinvoicing standard_reinvoicing
     *
     * @return $this
     */
    public function setStandardReinvoicing($standard_reinvoicing)
    {
        $this->container['standard_reinvoicing'] = $standard_reinvoicing;

        return $this;
    }

    /**
     * Gets is_current_month_default_period
     *
     * @return bool
     */
    public function getIsCurrentMonthDefaultPeriod()
    {
        return $this->container['is_current_month_default_period'];
    }

    /**
     * Sets is_current_month_default_period
     *
     * @param bool $is_current_month_default_period is_current_month_default_period
     *
     * @return $this
     */
    public function setIsCurrentMonthDefaultPeriod($is_current_month_default_period)
    {
        $this->container['is_current_month_default_period'] = $is_current_month_default_period;

        return $this;
    }

    /**
     * Gets show_project_onboarding
     *
     * @return bool
     */
    public function getShowProjectOnboarding()
    {
        return $this->container['show_project_onboarding'];
    }

    /**
     * Sets show_project_onboarding
     *
     * @param bool $show_project_onboarding show_project_onboarding
     *
     * @return $this
     */
    public function setShowProjectOnboarding($show_project_onboarding)
    {
        $this->container['show_project_onboarding'] = $show_project_onboarding;

        return $this;
    }

    /**
     * Gets auto_connect_incoming_orderline_to_project
     *
     * @return bool
     */
    public function getAutoConnectIncomingOrderlineToProject()
    {
        return $this->container['auto_connect_incoming_orderline_to_project'];
    }

    /**
     * Sets auto_connect_incoming_orderline_to_project
     *
     * @param bool $auto_connect_incoming_orderline_to_project auto_connect_incoming_orderline_to_project
     *
     * @return $this
     */
    public function setAutoConnectIncomingOrderlineToProject($auto_connect_incoming_orderline_to_project)
    {
        $this->container['auto_connect_incoming_orderline_to_project'] = $auto_connect_incoming_orderline_to_project;

        return $this;
    }

    /**
     * Gets auto_generate_project_number
     *
     * @return bool
     */
    public function getAutoGenerateProjectNumber()
    {
        return $this->container['auto_generate_project_number'];
    }

    /**
     * Sets auto_generate_project_number
     *
     * @param bool $auto_generate_project_number auto_generate_project_number
     *
     * @return $this
     */
    public function setAutoGenerateProjectNumber($auto_generate_project_number)
    {
        $this->container['auto_generate_project_number'] = $auto_generate_project_number;

        return $this;
    }

    /**
     * Gets auto_generate_starting_number
     *
     * @return int
     */
    public function getAutoGenerateStartingNumber()
    {
        return $this->container['auto_generate_starting_number'];
    }

    /**
     * Sets auto_generate_starting_number
     *
     * @param int $auto_generate_starting_number auto_generate_starting_number
     *
     * @return $this
     */
    public function setAutoGenerateStartingNumber($auto_generate_starting_number)
    {
        $this->container['auto_generate_starting_number'] = $auto_generate_starting_number;

        return $this;
    }

    /**
     * Gets project_name_scheme
     *
     * @return string
     */
    public function getProjectNameScheme()
    {
        return $this->container['project_name_scheme'];
    }

    /**
     * Sets project_name_scheme
     *
     * @param string $project_name_scheme project_name_scheme
     *
     * @return $this
     */
    public function setProjectNameScheme($project_name_scheme)
    {
        $allowedValues = $this->getProjectNameSchemeAllowableValues();
        if (!is_null($project_name_scheme) && !in_array($project_name_scheme, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'project_name_scheme', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_name_scheme'] = $project_name_scheme;

        return $this;
    }

    /**
     * Gets project_type_of_contract
     *
     * @return string
     */
    public function getProjectTypeOfContract()
    {
        return $this->container['project_type_of_contract'];
    }

    /**
     * Sets project_type_of_contract
     *
     * @param string $project_type_of_contract project_type_of_contract
     *
     * @return $this
     */
    public function setProjectTypeOfContract($project_type_of_contract)
    {
        $allowedValues = $this->getProjectTypeOfContractAllowableValues();
        if (!is_null($project_type_of_contract) && !in_array($project_type_of_contract, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'project_type_of_contract', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_type_of_contract'] = $project_type_of_contract;

        return $this;
    }

    /**
     * Gets project_order_lines_sort_order
     *
     * @return string
     */
    public function getProjectOrderLinesSortOrder()
    {
        return $this->container['project_order_lines_sort_order'];
    }

    /**
     * Sets project_order_lines_sort_order
     *
     * @param string $project_order_lines_sort_order project_order_lines_sort_order
     *
     * @return $this
     */
    public function setProjectOrderLinesSortOrder($project_order_lines_sort_order)
    {
        $allowedValues = $this->getProjectOrderLinesSortOrderAllowableValues();
        if (!is_null($project_order_lines_sort_order) && !in_array($project_order_lines_sort_order, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'project_order_lines_sort_order', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_order_lines_sort_order'] = $project_order_lines_sort_order;

        return $this;
    }

    /**
     * Gets project_hourly_rate_model
     *
     * @return string
     */
    public function getProjectHourlyRateModel()
    {
        return $this->container['project_hourly_rate_model'];
    }

    /**
     * Sets project_hourly_rate_model
     *
     * @param string $project_hourly_rate_model project_hourly_rate_model
     *
     * @return $this
     */
    public function setProjectHourlyRateModel($project_hourly_rate_model)
    {
        $allowedValues = $this->getProjectHourlyRateModelAllowableValues();
        if (!is_null($project_hourly_rate_model) && !in_array($project_hourly_rate_model, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'project_hourly_rate_model', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_hourly_rate_model'] = $project_hourly_rate_model;

        return $this;
    }

    /**
     * Gets only_project_members_can_register_info
     *
     * @return bool
     */
    public function getOnlyProjectMembersCanRegisterInfo()
    {
        return $this->container['only_project_members_can_register_info'];
    }

    /**
     * Sets only_project_members_can_register_info
     *
     * @param bool $only_project_members_can_register_info only_project_members_can_register_info
     *
     * @return $this
     */
    public function setOnlyProjectMembersCanRegisterInfo($only_project_members_can_register_info)
    {
        $this->container['only_project_members_can_register_info'] = $only_project_members_can_register_info;

        return $this;
    }

    /**
     * Gets only_project_activities_timesheet_registration
     *
     * @return bool
     */
    public function getOnlyProjectActivitiesTimesheetRegistration()
    {
        return $this->container['only_project_activities_timesheet_registration'];
    }

    /**
     * Sets only_project_activities_timesheet_registration
     *
     * @param bool $only_project_activities_timesheet_registration only_project_activities_timesheet_registration
     *
     * @return $this
     */
    public function setOnlyProjectActivitiesTimesheetRegistration($only_project_activities_timesheet_registration)
    {
        $this->container['only_project_activities_timesheet_registration'] = $only_project_activities_timesheet_registration;

        return $this;
    }

    /**
     * Gets hourly_rate_projects_write_up_down
     *
     * @return bool
     */
    public function getHourlyRateProjectsWriteUpDown()
    {
        return $this->container['hourly_rate_projects_write_up_down'];
    }

    /**
     * Sets hourly_rate_projects_write_up_down
     *
     * @param bool $hourly_rate_projects_write_up_down hourly_rate_projects_write_up_down
     *
     * @return $this
     */
    public function setHourlyRateProjectsWriteUpDown($hourly_rate_projects_write_up_down)
    {
        $this->container['hourly_rate_projects_write_up_down'] = $hourly_rate_projects_write_up_down;

        return $this;
    }

    /**
     * Gets show_recently_closed_projects_on_supplier_invoice
     *
     * @return bool
     */
    public function getShowRecentlyClosedProjectsOnSupplierInvoice()
    {
        return $this->container['show_recently_closed_projects_on_supplier_invoice'];
    }

    /**
     * Sets show_recently_closed_projects_on_supplier_invoice
     *
     * @param bool $show_recently_closed_projects_on_supplier_invoice show_recently_closed_projects_on_supplier_invoice
     *
     * @return $this
     */
    public function setShowRecentlyClosedProjectsOnSupplierInvoice($show_recently_closed_projects_on_supplier_invoice)
    {
        $this->container['show_recently_closed_projects_on_supplier_invoice'] = $show_recently_closed_projects_on_supplier_invoice;

        return $this;
    }

    /**
     * Gets default_project_contract_comment
     *
     * @return string
     */
    public function getDefaultProjectContractComment()
    {
        return $this->container['default_project_contract_comment'];
    }

    /**
     * Sets default_project_contract_comment
     *
     * @param string $default_project_contract_comment default_project_contract_comment
     *
     * @return $this
     */
    public function setDefaultProjectContractComment($default_project_contract_comment)
    {
        $this->container['default_project_contract_comment'] = $default_project_contract_comment;

        return $this;
    }

    /**
     * Gets default_project_invoicing_comment
     *
     * @return string
     */
    public function getDefaultProjectInvoicingComment()
    {
        return $this->container['default_project_invoicing_comment'];
    }

    /**
     * Sets default_project_invoicing_comment
     *
     * @param string $default_project_invoicing_comment default_project_invoicing_comment
     *
     * @return $this
     */
    public function setDefaultProjectInvoicingComment($default_project_invoicing_comment)
    {
        $this->container['default_project_invoicing_comment'] = $default_project_invoicing_comment;

        return $this;
    }

    /**
     * Gets resource_planning
     *
     * @return bool
     */
    public function getResourcePlanning()
    {
        return $this->container['resource_planning'];
    }

    /**
     * Sets resource_planning
     *
     * @param bool $resource_planning resource_planning
     *
     * @return $this
     */
    public function setResourcePlanning($resource_planning)
    {
        $this->container['resource_planning'] = $resource_planning;

        return $this;
    }

    /**
     * Gets resource_groups
     *
     * @return bool
     */
    public function getResourceGroups()
    {
        return $this->container['resource_groups'];
    }

    /**
     * Sets resource_groups
     *
     * @param bool $resource_groups resource_groups
     *
     * @return $this
     */
    public function setResourceGroups($resource_groups)
    {
        $this->container['resource_groups'] = $resource_groups;

        return $this;
    }

    /**
     * Gets holiday_plan
     *
     * @return bool
     */
    public function getHolidayPlan()
    {
        return $this->container['holiday_plan'];
    }

    /**
     * Sets holiday_plan
     *
     * @param bool $holiday_plan holiday_plan
     *
     * @return $this
     */
    public function setHolidayPlan($holiday_plan)
    {
        $this->container['holiday_plan'] = $holiday_plan;

        return $this;
    }

    /**
     * Gets resource_plan_period
     *
     * @return string
     */
    public function getResourcePlanPeriod()
    {
        return $this->container['resource_plan_period'];
    }

    /**
     * Sets resource_plan_period
     *
     * @param string $resource_plan_period resource_plan_period
     *
     * @return $this
     */
    public function setResourcePlanPeriod($resource_plan_period)
    {
        $allowedValues = $this->getResourcePlanPeriodAllowableValues();
        if (!is_null($resource_plan_period) && !in_array($resource_plan_period, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'resource_plan_period', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['resource_plan_period'] = $resource_plan_period;

        return $this;
    }

    /**
     * Gets control_forms_required_for_invoicing
     *
     * @return \Learnist\Tripletex\Model\ProjectControlFormType[]
     */
    public function getControlFormsRequiredForInvoicing()
    {
        return $this->container['control_forms_required_for_invoicing'];
    }

    /**
     * Sets control_forms_required_for_invoicing
     *
     * @param \Learnist\Tripletex\Model\ProjectControlFormType[] $control_forms_required_for_invoicing Control forms required for invoicing
     *
     * @return $this
     */
    public function setControlFormsRequiredForInvoicing($control_forms_required_for_invoicing)
    {
        $this->container['control_forms_required_for_invoicing'] = $control_forms_required_for_invoicing;

        return $this;
    }

    /**
     * Gets control_forms_required_for_hour_tracking
     *
     * @return \Learnist\Tripletex\Model\ProjectControlFormType[]
     */
    public function getControlFormsRequiredForHourTracking()
    {
        return $this->container['control_forms_required_for_hour_tracking'];
    }

    /**
     * Sets control_forms_required_for_hour_tracking
     *
     * @param \Learnist\Tripletex\Model\ProjectControlFormType[] $control_forms_required_for_hour_tracking Control forms required for hour tracking
     *
     * @return $this
     */
    public function setControlFormsRequiredForHourTracking($control_forms_required_for_hour_tracking)
    {
        $this->container['control_forms_required_for_hour_tracking'] = $control_forms_required_for_hour_tracking;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_project_budget
     *
     * @return bool
     */
    public function getUseLoggedInUserEmailOnProjectBudget()
    {
        return $this->container['use_logged_in_user_email_on_project_budget'];
    }

    /**
     * Sets use_logged_in_user_email_on_project_budget
     *
     * @param bool $use_logged_in_user_email_on_project_budget use_logged_in_user_email_on_project_budget
     *
     * @return $this
     */
    public function setUseLoggedInUserEmailOnProjectBudget($use_logged_in_user_email_on_project_budget)
    {
        $this->container['use_logged_in_user_email_on_project_budget'] = $use_logged_in_user_email_on_project_budget;

        return $this;
    }

    /**
     * Gets email_on_project_budget
     *
     * @return string
     */
    public function getEmailOnProjectBudget()
    {
        return $this->container['email_on_project_budget'];
    }

    /**
     * Sets email_on_project_budget
     *
     * @param string $email_on_project_budget email_on_project_budget
     *
     * @return $this
     */
    public function setEmailOnProjectBudget($email_on_project_budget)
    {
        $this->container['email_on_project_budget'] = $email_on_project_budget;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_project_contract
     *
     * @return bool
     */
    public function getUseLoggedInUserEmailOnProjectContract()
    {
        return $this->container['use_logged_in_user_email_on_project_contract'];
    }

    /**
     * Sets use_logged_in_user_email_on_project_contract
     *
     * @param bool $use_logged_in_user_email_on_project_contract use_logged_in_user_email_on_project_contract
     *
     * @return $this
     */
    public function setUseLoggedInUserEmailOnProjectContract($use_logged_in_user_email_on_project_contract)
    {
        $this->container['use_logged_in_user_email_on_project_contract'] = $use_logged_in_user_email_on_project_contract;

        return $this;
    }

    /**
     * Gets email_on_project_contract
     *
     * @return string
     */
    public function getEmailOnProjectContract()
    {
        return $this->container['email_on_project_contract'];
    }

    /**
     * Sets email_on_project_contract
     *
     * @param string $email_on_project_contract email_on_project_contract
     *
     * @return $this
     */
    public function setEmailOnProjectContract($email_on_project_contract)
    {
        $this->container['email_on_project_contract'] = $email_on_project_contract;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_documents
     *
     * @return bool
     */
    public function getUseLoggedInUserEmailOnDocuments()
    {
        return $this->container['use_logged_in_user_email_on_documents'];
    }

    /**
     * Sets use_logged_in_user_email_on_documents
     *
     * @param bool $use_logged_in_user_email_on_documents use_logged_in_user_email_on_documents
     *
     * @return $this
     */
    public function setUseLoggedInUserEmailOnDocuments($use_logged_in_user_email_on_documents)
    {
        $this->container['use_logged_in_user_email_on_documents'] = $use_logged_in_user_email_on_documents;

        return $this;
    }

    /**
     * Gets email_on_documents
     *
     * @return string
     */
    public function getEmailOnDocuments()
    {
        return $this->container['email_on_documents'];
    }

    /**
     * Sets email_on_documents
     *
     * @param string $email_on_documents email_on_documents
     *
     * @return $this
     */
    public function setEmailOnDocuments($email_on_documents)
    {
        $this->container['email_on_documents'] = $email_on_documents;

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
