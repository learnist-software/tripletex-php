<?php
/**
 * ProjectSettings
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
 * ProjectSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectSettings implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProjectSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'email_on_documents' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'email_on_documents' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'approve_hour_lists' => false,
		'approve_invoices' => false,
		'mark_ready_for_invoicing' => false,
		'historical_information' => false,
		'project_forecast' => false,
		'budget_on_subcontracts' => false,
		'project_categories' => false,
		'reference_fee' => false,
		'sort_order_projects' => false,
		'auto_close_invoiced_projects' => false,
		'must_approve_registered_hours' => false,
		'show_project_order_lines_to_all_project_participants' => false,
		'hour_cost_percentage' => false,
		'fixed_price_projects_fee_calc_method' => false,
		'fixed_price_projects_invoice_by_progress' => false,
		'project_budget_reference_fee' => false,
		'allow_multiple_project_invoice_vat' => false,
		'standard_reinvoicing' => false,
		'is_current_month_default_period' => false,
		'show_project_onboarding' => false,
		'auto_connect_incoming_orderline_to_project' => false,
		'auto_generate_project_number' => false,
		'auto_generate_starting_number' => false,
		'project_name_scheme' => false,
		'project_type_of_contract' => false,
		'project_order_lines_sort_order' => false,
		'project_hourly_rate_model' => false,
		'only_project_members_can_register_info' => false,
		'only_project_activities_timesheet_registration' => false,
		'hourly_rate_projects_write_up_down' => false,
		'show_recently_closed_projects_on_supplier_invoice' => false,
		'default_project_contract_comment' => false,
		'default_project_invoicing_comment' => false,
		'resource_planning' => false,
		'resource_groups' => false,
		'holiday_plan' => false,
		'resource_plan_period' => false,
		'control_forms_required_for_invoicing' => false,
		'control_forms_required_for_hour_tracking' => false,
		'use_logged_in_user_email_on_project_budget' => false,
		'email_on_project_budget' => false,
		'use_logged_in_user_email_on_project_contract' => false,
		'email_on_project_contract' => false,
		'use_logged_in_user_email_on_documents' => false,
		'email_on_documents' => false
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
        'email_on_documents' => 'emailOnDocuments'
    ];

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
        'email_on_documents' => 'setEmailOnDocuments'
    ];

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
        'email_on_documents' => 'getEmailOnDocuments'
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

    public const SORT_ORDER_PROJECTS_NAME_AND_NUMBER = 'SORT_ORDER_NAME_AND_NUMBER';
    public const SORT_ORDER_PROJECTS_NAME = 'SORT_ORDER_NAME';
    public const FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_INVOICED_FEE = 'FIXED_PRICE_PROJECTS_CALC_METHOD_INVOICED_FEE';
    public const FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_PERCENT_COMPLETED = 'FIXED_PRICE_PROJECTS_CALC_METHOD_PERCENT_COMPLETED';
    public const PROJECT_NAME_SCHEME_STANDARD = 'NAME_STANDARD';
    public const PROJECT_NAME_SCHEME_INCL_CUSTOMER_NAME = 'NAME_INCL_CUSTOMER_NAME';
    public const PROJECT_NAME_SCHEME_INCL_PARENT_NAME = 'NAME_INCL_PARENT_NAME';
    public const PROJECT_NAME_SCHEME_INCL_PARENT_NUMBER = 'NAME_INCL_PARENT_NUMBER';
    public const PROJECT_NAME_SCHEME_INCL_PARENT_NAME_AND_NUMBER = 'NAME_INCL_PARENT_NAME_AND_NUMBER';
    public const PROJECT_TYPE_OF_CONTRACT_FIXED_PRICE = 'PROJECT_FIXED_PRICE';
    public const PROJECT_TYPE_OF_CONTRACT_HOUR_RATES = 'PROJECT_HOUR_RATES';
    public const PROJECT_ORDER_LINES_SORT_ORDER_ID = 'SORT_ORDER_ID';
    public const PROJECT_ORDER_LINES_SORT_ORDER_DATE = 'SORT_ORDER_DATE';
    public const PROJECT_ORDER_LINES_SORT_ORDER_PRODUCT = 'SORT_ORDER_PRODUCT';
    public const PROJECT_ORDER_LINES_SORT_ORDER_CUSTOM = 'SORT_ORDER_CUSTOM';
    public const PROJECT_HOURLY_RATE_MODEL_PREDEFINED_HOURLY_RATES = 'TYPE_PREDEFINED_HOURLY_RATES';
    public const PROJECT_HOURLY_RATE_MODEL_PROJECT_SPECIFIC_HOURLY_RATES = 'TYPE_PROJECT_SPECIFIC_HOURLY_RATES';
    public const PROJECT_HOURLY_RATE_MODEL_FIXED_HOURLY_RATE = 'TYPE_FIXED_HOURLY_RATE';
    public const RESOURCE_PLAN_PERIOD_MONTH = 'PERIOD_MONTH';
    public const RESOURCE_PLAN_PERIOD_WEEK = 'PERIOD_WEEK';
    public const RESOURCE_PLAN_PERIOD_DAY = 'PERIOD_DAY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSortOrderProjectsAllowableValues()
    {
        return [
            self::SORT_ORDER_PROJECTS_NAME_AND_NUMBER,
            self::SORT_ORDER_PROJECTS_NAME,
        ];
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
            self::FIXED_PRICE_PROJECTS_FEE_CALC_METHOD_PERCENT_COMPLETED,
        ];
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
            self::PROJECT_NAME_SCHEME_INCL_PARENT_NAME_AND_NUMBER,
        ];
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
            self::PROJECT_TYPE_OF_CONTRACT_HOUR_RATES,
        ];
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
            self::PROJECT_ORDER_LINES_SORT_ORDER_CUSTOM,
        ];
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
            self::PROJECT_HOURLY_RATE_MODEL_FIXED_HOURLY_RATE,
        ];
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
            self::RESOURCE_PLAN_PERIOD_DAY,
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
        $this->setIfExists('approve_hour_lists', $data ?? [], null);
        $this->setIfExists('approve_invoices', $data ?? [], null);
        $this->setIfExists('mark_ready_for_invoicing', $data ?? [], null);
        $this->setIfExists('historical_information', $data ?? [], null);
        $this->setIfExists('project_forecast', $data ?? [], null);
        $this->setIfExists('budget_on_subcontracts', $data ?? [], null);
        $this->setIfExists('project_categories', $data ?? [], null);
        $this->setIfExists('reference_fee', $data ?? [], null);
        $this->setIfExists('sort_order_projects', $data ?? [], null);
        $this->setIfExists('auto_close_invoiced_projects', $data ?? [], null);
        $this->setIfExists('must_approve_registered_hours', $data ?? [], null);
        $this->setIfExists('show_project_order_lines_to_all_project_participants', $data ?? [], null);
        $this->setIfExists('hour_cost_percentage', $data ?? [], null);
        $this->setIfExists('fixed_price_projects_fee_calc_method', $data ?? [], null);
        $this->setIfExists('fixed_price_projects_invoice_by_progress', $data ?? [], null);
        $this->setIfExists('project_budget_reference_fee', $data ?? [], null);
        $this->setIfExists('allow_multiple_project_invoice_vat', $data ?? [], null);
        $this->setIfExists('standard_reinvoicing', $data ?? [], null);
        $this->setIfExists('is_current_month_default_period', $data ?? [], null);
        $this->setIfExists('show_project_onboarding', $data ?? [], null);
        $this->setIfExists('auto_connect_incoming_orderline_to_project', $data ?? [], null);
        $this->setIfExists('auto_generate_project_number', $data ?? [], null);
        $this->setIfExists('auto_generate_starting_number', $data ?? [], null);
        $this->setIfExists('project_name_scheme', $data ?? [], null);
        $this->setIfExists('project_type_of_contract', $data ?? [], null);
        $this->setIfExists('project_order_lines_sort_order', $data ?? [], null);
        $this->setIfExists('project_hourly_rate_model', $data ?? [], null);
        $this->setIfExists('only_project_members_can_register_info', $data ?? [], null);
        $this->setIfExists('only_project_activities_timesheet_registration', $data ?? [], null);
        $this->setIfExists('hourly_rate_projects_write_up_down', $data ?? [], null);
        $this->setIfExists('show_recently_closed_projects_on_supplier_invoice', $data ?? [], null);
        $this->setIfExists('default_project_contract_comment', $data ?? [], null);
        $this->setIfExists('default_project_invoicing_comment', $data ?? [], null);
        $this->setIfExists('resource_planning', $data ?? [], null);
        $this->setIfExists('resource_groups', $data ?? [], null);
        $this->setIfExists('holiday_plan', $data ?? [], null);
        $this->setIfExists('resource_plan_period', $data ?? [], null);
        $this->setIfExists('control_forms_required_for_invoicing', $data ?? [], null);
        $this->setIfExists('control_forms_required_for_hour_tracking', $data ?? [], null);
        $this->setIfExists('use_logged_in_user_email_on_project_budget', $data ?? [], null);
        $this->setIfExists('email_on_project_budget', $data ?? [], null);
        $this->setIfExists('use_logged_in_user_email_on_project_contract', $data ?? [], null);
        $this->setIfExists('email_on_project_contract', $data ?? [], null);
        $this->setIfExists('use_logged_in_user_email_on_documents', $data ?? [], null);
        $this->setIfExists('email_on_documents', $data ?? [], null);
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

        $allowedValues = $this->getSortOrderProjectsAllowableValues();
        if (!is_null($this->container['sort_order_projects']) && !in_array($this->container['sort_order_projects'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'sort_order_projects', must be one of '%s'",
                $this->container['sort_order_projects'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getFixedPriceProjectsFeeCalcMethodAllowableValues();
        if (!is_null($this->container['fixed_price_projects_fee_calc_method']) && !in_array($this->container['fixed_price_projects_fee_calc_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'fixed_price_projects_fee_calc_method', must be one of '%s'",
                $this->container['fixed_price_projects_fee_calc_method'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['auto_generate_starting_number']) && ($this->container['auto_generate_starting_number'] < 0)) {
            $invalidProperties[] = "invalid value for 'auto_generate_starting_number', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getProjectNameSchemeAllowableValues();
        if (!is_null($this->container['project_name_scheme']) && !in_array($this->container['project_name_scheme'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_name_scheme', must be one of '%s'",
                $this->container['project_name_scheme'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectTypeOfContractAllowableValues();
        if (!is_null($this->container['project_type_of_contract']) && !in_array($this->container['project_type_of_contract'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_type_of_contract', must be one of '%s'",
                $this->container['project_type_of_contract'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectOrderLinesSortOrderAllowableValues();
        if (!is_null($this->container['project_order_lines_sort_order']) && !in_array($this->container['project_order_lines_sort_order'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_order_lines_sort_order', must be one of '%s'",
                $this->container['project_order_lines_sort_order'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectHourlyRateModelAllowableValues();
        if (!is_null($this->container['project_hourly_rate_model']) && !in_array($this->container['project_hourly_rate_model'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_hourly_rate_model', must be one of '%s'",
                $this->container['project_hourly_rate_model'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getResourcePlanPeriodAllowableValues();
        if (!is_null($this->container['resource_plan_period']) && !in_array($this->container['resource_plan_period'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'resource_plan_period', must be one of '%s'",
                $this->container['resource_plan_period'],
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
     * @return bool|null
     */
    public function getApproveHourLists()
    {
        return $this->container['approve_hour_lists'];
    }

    /**
     * Sets approve_hour_lists
     *
     * @param bool|null $approve_hour_lists approve_hour_lists
     *
     * @return self
     */
    public function setApproveHourLists($approve_hour_lists)
    {

        if (is_null($approve_hour_lists)) {
            throw new \InvalidArgumentException('non-nullable approve_hour_lists cannot be null');
        }

        $this->container['approve_hour_lists'] = $approve_hour_lists;

        return $this;
    }

    /**
     * Gets approve_invoices
     *
     * @return bool|null
     */
    public function getApproveInvoices()
    {
        return $this->container['approve_invoices'];
    }

    /**
     * Sets approve_invoices
     *
     * @param bool|null $approve_invoices approve_invoices
     *
     * @return self
     */
    public function setApproveInvoices($approve_invoices)
    {

        if (is_null($approve_invoices)) {
            throw new \InvalidArgumentException('non-nullable approve_invoices cannot be null');
        }

        $this->container['approve_invoices'] = $approve_invoices;

        return $this;
    }

    /**
     * Gets mark_ready_for_invoicing
     *
     * @return bool|null
     */
    public function getMarkReadyForInvoicing()
    {
        return $this->container['mark_ready_for_invoicing'];
    }

    /**
     * Sets mark_ready_for_invoicing
     *
     * @param bool|null $mark_ready_for_invoicing mark_ready_for_invoicing
     *
     * @return self
     */
    public function setMarkReadyForInvoicing($mark_ready_for_invoicing)
    {

        if (is_null($mark_ready_for_invoicing)) {
            throw new \InvalidArgumentException('non-nullable mark_ready_for_invoicing cannot be null');
        }

        $this->container['mark_ready_for_invoicing'] = $mark_ready_for_invoicing;

        return $this;
    }

    /**
     * Gets historical_information
     *
     * @return bool|null
     */
    public function getHistoricalInformation()
    {
        return $this->container['historical_information'];
    }

    /**
     * Sets historical_information
     *
     * @param bool|null $historical_information historical_information
     *
     * @return self
     */
    public function setHistoricalInformation($historical_information)
    {

        if (is_null($historical_information)) {
            throw new \InvalidArgumentException('non-nullable historical_information cannot be null');
        }

        $this->container['historical_information'] = $historical_information;

        return $this;
    }

    /**
     * Gets project_forecast
     *
     * @return bool|null
     */
    public function getProjectForecast()
    {
        return $this->container['project_forecast'];
    }

    /**
     * Sets project_forecast
     *
     * @param bool|null $project_forecast project_forecast
     *
     * @return self
     */
    public function setProjectForecast($project_forecast)
    {

        if (is_null($project_forecast)) {
            throw new \InvalidArgumentException('non-nullable project_forecast cannot be null');
        }

        $this->container['project_forecast'] = $project_forecast;

        return $this;
    }

    /**
     * Gets budget_on_subcontracts
     *
     * @return bool|null
     */
    public function getBudgetOnSubcontracts()
    {
        return $this->container['budget_on_subcontracts'];
    }

    /**
     * Sets budget_on_subcontracts
     *
     * @param bool|null $budget_on_subcontracts budget_on_subcontracts
     *
     * @return self
     */
    public function setBudgetOnSubcontracts($budget_on_subcontracts)
    {

        if (is_null($budget_on_subcontracts)) {
            throw new \InvalidArgumentException('non-nullable budget_on_subcontracts cannot be null');
        }

        $this->container['budget_on_subcontracts'] = $budget_on_subcontracts;

        return $this;
    }

    /**
     * Gets project_categories
     *
     * @return bool|null
     */
    public function getProjectCategories()
    {
        return $this->container['project_categories'];
    }

    /**
     * Sets project_categories
     *
     * @param bool|null $project_categories project_categories
     *
     * @return self
     */
    public function setProjectCategories($project_categories)
    {

        if (is_null($project_categories)) {
            throw new \InvalidArgumentException('non-nullable project_categories cannot be null');
        }

        $this->container['project_categories'] = $project_categories;

        return $this;
    }

    /**
     * Gets reference_fee
     *
     * @return bool|null
     */
    public function getReferenceFee()
    {
        return $this->container['reference_fee'];
    }

    /**
     * Sets reference_fee
     *
     * @param bool|null $reference_fee reference_fee
     *
     * @return self
     */
    public function setReferenceFee($reference_fee)
    {

        if (is_null($reference_fee)) {
            throw new \InvalidArgumentException('non-nullable reference_fee cannot be null');
        }

        $this->container['reference_fee'] = $reference_fee;

        return $this;
    }

    /**
     * Gets sort_order_projects
     *
     * @return string|null
     */
    public function getSortOrderProjects()
    {
        return $this->container['sort_order_projects'];
    }

    /**
     * Sets sort_order_projects
     *
     * @param string|null $sort_order_projects sort_order_projects
     *
     * @return self
     */
    public function setSortOrderProjects($sort_order_projects)
    {
        $allowedValues = $this->getSortOrderProjectsAllowableValues();
        if (!is_null($sort_order_projects) && !in_array($sort_order_projects, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'sort_order_projects', must be one of '%s'",
                    $sort_order_projects,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($sort_order_projects)) {
            throw new \InvalidArgumentException('non-nullable sort_order_projects cannot be null');
        }

        $this->container['sort_order_projects'] = $sort_order_projects;

        return $this;
    }

    /**
     * Gets auto_close_invoiced_projects
     *
     * @return bool|null
     */
    public function getAutoCloseInvoicedProjects()
    {
        return $this->container['auto_close_invoiced_projects'];
    }

    /**
     * Sets auto_close_invoiced_projects
     *
     * @param bool|null $auto_close_invoiced_projects auto_close_invoiced_projects
     *
     * @return self
     */
    public function setAutoCloseInvoicedProjects($auto_close_invoiced_projects)
    {

        if (is_null($auto_close_invoiced_projects)) {
            throw new \InvalidArgumentException('non-nullable auto_close_invoiced_projects cannot be null');
        }

        $this->container['auto_close_invoiced_projects'] = $auto_close_invoiced_projects;

        return $this;
    }

    /**
     * Gets must_approve_registered_hours
     *
     * @return bool|null
     */
    public function getMustApproveRegisteredHours()
    {
        return $this->container['must_approve_registered_hours'];
    }

    /**
     * Sets must_approve_registered_hours
     *
     * @param bool|null $must_approve_registered_hours must_approve_registered_hours
     *
     * @return self
     */
    public function setMustApproveRegisteredHours($must_approve_registered_hours)
    {

        if (is_null($must_approve_registered_hours)) {
            throw new \InvalidArgumentException('non-nullable must_approve_registered_hours cannot be null');
        }

        $this->container['must_approve_registered_hours'] = $must_approve_registered_hours;

        return $this;
    }

    /**
     * Gets show_project_order_lines_to_all_project_participants
     *
     * @return bool|null
     */
    public function getShowProjectOrderLinesToAllProjectParticipants()
    {
        return $this->container['show_project_order_lines_to_all_project_participants'];
    }

    /**
     * Sets show_project_order_lines_to_all_project_participants
     *
     * @param bool|null $show_project_order_lines_to_all_project_participants show_project_order_lines_to_all_project_participants
     *
     * @return self
     */
    public function setShowProjectOrderLinesToAllProjectParticipants($show_project_order_lines_to_all_project_participants)
    {

        if (is_null($show_project_order_lines_to_all_project_participants)) {
            throw new \InvalidArgumentException('non-nullable show_project_order_lines_to_all_project_participants cannot be null');
        }

        $this->container['show_project_order_lines_to_all_project_participants'] = $show_project_order_lines_to_all_project_participants;

        return $this;
    }

    /**
     * Gets hour_cost_percentage
     *
     * @return bool|null
     */
    public function getHourCostPercentage()
    {
        return $this->container['hour_cost_percentage'];
    }

    /**
     * Sets hour_cost_percentage
     *
     * @param bool|null $hour_cost_percentage hour_cost_percentage
     *
     * @return self
     */
    public function setHourCostPercentage($hour_cost_percentage)
    {

        if (is_null($hour_cost_percentage)) {
            throw new \InvalidArgumentException('non-nullable hour_cost_percentage cannot be null');
        }

        $this->container['hour_cost_percentage'] = $hour_cost_percentage;

        return $this;
    }

    /**
     * Gets fixed_price_projects_fee_calc_method
     *
     * @return string|null
     */
    public function getFixedPriceProjectsFeeCalcMethod()
    {
        return $this->container['fixed_price_projects_fee_calc_method'];
    }

    /**
     * Sets fixed_price_projects_fee_calc_method
     *
     * @param string|null $fixed_price_projects_fee_calc_method fixed_price_projects_fee_calc_method
     *
     * @return self
     */
    public function setFixedPriceProjectsFeeCalcMethod($fixed_price_projects_fee_calc_method)
    {
        $allowedValues = $this->getFixedPriceProjectsFeeCalcMethodAllowableValues();
        if (!is_null($fixed_price_projects_fee_calc_method) && !in_array($fixed_price_projects_fee_calc_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'fixed_price_projects_fee_calc_method', must be one of '%s'",
                    $fixed_price_projects_fee_calc_method,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($fixed_price_projects_fee_calc_method)) {
            throw new \InvalidArgumentException('non-nullable fixed_price_projects_fee_calc_method cannot be null');
        }

        $this->container['fixed_price_projects_fee_calc_method'] = $fixed_price_projects_fee_calc_method;

        return $this;
    }

    /**
     * Gets fixed_price_projects_invoice_by_progress
     *
     * @return bool|null
     */
    public function getFixedPriceProjectsInvoiceByProgress()
    {
        return $this->container['fixed_price_projects_invoice_by_progress'];
    }

    /**
     * Sets fixed_price_projects_invoice_by_progress
     *
     * @param bool|null $fixed_price_projects_invoice_by_progress fixed_price_projects_invoice_by_progress
     *
     * @return self
     */
    public function setFixedPriceProjectsInvoiceByProgress($fixed_price_projects_invoice_by_progress)
    {

        if (is_null($fixed_price_projects_invoice_by_progress)) {
            throw new \InvalidArgumentException('non-nullable fixed_price_projects_invoice_by_progress cannot be null');
        }

        $this->container['fixed_price_projects_invoice_by_progress'] = $fixed_price_projects_invoice_by_progress;

        return $this;
    }

    /**
     * Gets project_budget_reference_fee
     *
     * @return bool|null
     */
    public function getProjectBudgetReferenceFee()
    {
        return $this->container['project_budget_reference_fee'];
    }

    /**
     * Sets project_budget_reference_fee
     *
     * @param bool|null $project_budget_reference_fee project_budget_reference_fee
     *
     * @return self
     */
    public function setProjectBudgetReferenceFee($project_budget_reference_fee)
    {

        if (is_null($project_budget_reference_fee)) {
            throw new \InvalidArgumentException('non-nullable project_budget_reference_fee cannot be null');
        }

        $this->container['project_budget_reference_fee'] = $project_budget_reference_fee;

        return $this;
    }

    /**
     * Gets allow_multiple_project_invoice_vat
     *
     * @return bool|null
     */
    public function getAllowMultipleProjectInvoiceVat()
    {
        return $this->container['allow_multiple_project_invoice_vat'];
    }

    /**
     * Sets allow_multiple_project_invoice_vat
     *
     * @param bool|null $allow_multiple_project_invoice_vat allow_multiple_project_invoice_vat
     *
     * @return self
     */
    public function setAllowMultipleProjectInvoiceVat($allow_multiple_project_invoice_vat)
    {

        if (is_null($allow_multiple_project_invoice_vat)) {
            throw new \InvalidArgumentException('non-nullable allow_multiple_project_invoice_vat cannot be null');
        }

        $this->container['allow_multiple_project_invoice_vat'] = $allow_multiple_project_invoice_vat;

        return $this;
    }

    /**
     * Gets standard_reinvoicing
     *
     * @return bool|null
     */
    public function getStandardReinvoicing()
    {
        return $this->container['standard_reinvoicing'];
    }

    /**
     * Sets standard_reinvoicing
     *
     * @param bool|null $standard_reinvoicing standard_reinvoicing
     *
     * @return self
     */
    public function setStandardReinvoicing($standard_reinvoicing)
    {

        if (is_null($standard_reinvoicing)) {
            throw new \InvalidArgumentException('non-nullable standard_reinvoicing cannot be null');
        }

        $this->container['standard_reinvoicing'] = $standard_reinvoicing;

        return $this;
    }

    /**
     * Gets is_current_month_default_period
     *
     * @return bool|null
     */
    public function getIsCurrentMonthDefaultPeriod()
    {
        return $this->container['is_current_month_default_period'];
    }

    /**
     * Sets is_current_month_default_period
     *
     * @param bool|null $is_current_month_default_period is_current_month_default_period
     *
     * @return self
     */
    public function setIsCurrentMonthDefaultPeriod($is_current_month_default_period)
    {

        if (is_null($is_current_month_default_period)) {
            throw new \InvalidArgumentException('non-nullable is_current_month_default_period cannot be null');
        }

        $this->container['is_current_month_default_period'] = $is_current_month_default_period;

        return $this;
    }

    /**
     * Gets show_project_onboarding
     *
     * @return bool|null
     */
    public function getShowProjectOnboarding()
    {
        return $this->container['show_project_onboarding'];
    }

    /**
     * Sets show_project_onboarding
     *
     * @param bool|null $show_project_onboarding show_project_onboarding
     *
     * @return self
     */
    public function setShowProjectOnboarding($show_project_onboarding)
    {

        if (is_null($show_project_onboarding)) {
            throw new \InvalidArgumentException('non-nullable show_project_onboarding cannot be null');
        }

        $this->container['show_project_onboarding'] = $show_project_onboarding;

        return $this;
    }

    /**
     * Gets auto_connect_incoming_orderline_to_project
     *
     * @return bool|null
     */
    public function getAutoConnectIncomingOrderlineToProject()
    {
        return $this->container['auto_connect_incoming_orderline_to_project'];
    }

    /**
     * Sets auto_connect_incoming_orderline_to_project
     *
     * @param bool|null $auto_connect_incoming_orderline_to_project auto_connect_incoming_orderline_to_project
     *
     * @return self
     */
    public function setAutoConnectIncomingOrderlineToProject($auto_connect_incoming_orderline_to_project)
    {

        if (is_null($auto_connect_incoming_orderline_to_project)) {
            throw new \InvalidArgumentException('non-nullable auto_connect_incoming_orderline_to_project cannot be null');
        }

        $this->container['auto_connect_incoming_orderline_to_project'] = $auto_connect_incoming_orderline_to_project;

        return $this;
    }

    /**
     * Gets auto_generate_project_number
     *
     * @return bool|null
     */
    public function getAutoGenerateProjectNumber()
    {
        return $this->container['auto_generate_project_number'];
    }

    /**
     * Sets auto_generate_project_number
     *
     * @param bool|null $auto_generate_project_number auto_generate_project_number
     *
     * @return self
     */
    public function setAutoGenerateProjectNumber($auto_generate_project_number)
    {

        if (is_null($auto_generate_project_number)) {
            throw new \InvalidArgumentException('non-nullable auto_generate_project_number cannot be null');
        }

        $this->container['auto_generate_project_number'] = $auto_generate_project_number;

        return $this;
    }

    /**
     * Gets auto_generate_starting_number
     *
     * @return int|null
     */
    public function getAutoGenerateStartingNumber()
    {
        return $this->container['auto_generate_starting_number'];
    }

    /**
     * Sets auto_generate_starting_number
     *
     * @param int|null $auto_generate_starting_number auto_generate_starting_number
     *
     * @return self
     */
    public function setAutoGenerateStartingNumber($auto_generate_starting_number)
    {

        if (!is_null($auto_generate_starting_number) && ($auto_generate_starting_number < 0)) {
            throw new \InvalidArgumentException('invalid value for $auto_generate_starting_number when calling ProjectSettings., must be bigger than or equal to 0.');
        }


        if (is_null($auto_generate_starting_number)) {
            throw new \InvalidArgumentException('non-nullable auto_generate_starting_number cannot be null');
        }

        $this->container['auto_generate_starting_number'] = $auto_generate_starting_number;

        return $this;
    }

    /**
     * Gets project_name_scheme
     *
     * @return string|null
     */
    public function getProjectNameScheme()
    {
        return $this->container['project_name_scheme'];
    }

    /**
     * Sets project_name_scheme
     *
     * @param string|null $project_name_scheme project_name_scheme
     *
     * @return self
     */
    public function setProjectNameScheme($project_name_scheme)
    {
        $allowedValues = $this->getProjectNameSchemeAllowableValues();
        if (!is_null($project_name_scheme) && !in_array($project_name_scheme, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_name_scheme', must be one of '%s'",
                    $project_name_scheme,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($project_name_scheme)) {
            throw new \InvalidArgumentException('non-nullable project_name_scheme cannot be null');
        }

        $this->container['project_name_scheme'] = $project_name_scheme;

        return $this;
    }

    /**
     * Gets project_type_of_contract
     *
     * @return string|null
     */
    public function getProjectTypeOfContract()
    {
        return $this->container['project_type_of_contract'];
    }

    /**
     * Sets project_type_of_contract
     *
     * @param string|null $project_type_of_contract project_type_of_contract
     *
     * @return self
     */
    public function setProjectTypeOfContract($project_type_of_contract)
    {
        $allowedValues = $this->getProjectTypeOfContractAllowableValues();
        if (!is_null($project_type_of_contract) && !in_array($project_type_of_contract, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_type_of_contract', must be one of '%s'",
                    $project_type_of_contract,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($project_type_of_contract)) {
            throw new \InvalidArgumentException('non-nullable project_type_of_contract cannot be null');
        }

        $this->container['project_type_of_contract'] = $project_type_of_contract;

        return $this;
    }

    /**
     * Gets project_order_lines_sort_order
     *
     * @return string|null
     */
    public function getProjectOrderLinesSortOrder()
    {
        return $this->container['project_order_lines_sort_order'];
    }

    /**
     * Sets project_order_lines_sort_order
     *
     * @param string|null $project_order_lines_sort_order project_order_lines_sort_order
     *
     * @return self
     */
    public function setProjectOrderLinesSortOrder($project_order_lines_sort_order)
    {
        $allowedValues = $this->getProjectOrderLinesSortOrderAllowableValues();
        if (!is_null($project_order_lines_sort_order) && !in_array($project_order_lines_sort_order, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_order_lines_sort_order', must be one of '%s'",
                    $project_order_lines_sort_order,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($project_order_lines_sort_order)) {
            throw new \InvalidArgumentException('non-nullable project_order_lines_sort_order cannot be null');
        }

        $this->container['project_order_lines_sort_order'] = $project_order_lines_sort_order;

        return $this;
    }

    /**
     * Gets project_hourly_rate_model
     *
     * @return string|null
     */
    public function getProjectHourlyRateModel()
    {
        return $this->container['project_hourly_rate_model'];
    }

    /**
     * Sets project_hourly_rate_model
     *
     * @param string|null $project_hourly_rate_model project_hourly_rate_model
     *
     * @return self
     */
    public function setProjectHourlyRateModel($project_hourly_rate_model)
    {
        $allowedValues = $this->getProjectHourlyRateModelAllowableValues();
        if (!is_null($project_hourly_rate_model) && !in_array($project_hourly_rate_model, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_hourly_rate_model', must be one of '%s'",
                    $project_hourly_rate_model,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($project_hourly_rate_model)) {
            throw new \InvalidArgumentException('non-nullable project_hourly_rate_model cannot be null');
        }

        $this->container['project_hourly_rate_model'] = $project_hourly_rate_model;

        return $this;
    }

    /**
     * Gets only_project_members_can_register_info
     *
     * @return bool|null
     */
    public function getOnlyProjectMembersCanRegisterInfo()
    {
        return $this->container['only_project_members_can_register_info'];
    }

    /**
     * Sets only_project_members_can_register_info
     *
     * @param bool|null $only_project_members_can_register_info only_project_members_can_register_info
     *
     * @return self
     */
    public function setOnlyProjectMembersCanRegisterInfo($only_project_members_can_register_info)
    {

        if (is_null($only_project_members_can_register_info)) {
            throw new \InvalidArgumentException('non-nullable only_project_members_can_register_info cannot be null');
        }

        $this->container['only_project_members_can_register_info'] = $only_project_members_can_register_info;

        return $this;
    }

    /**
     * Gets only_project_activities_timesheet_registration
     *
     * @return bool|null
     */
    public function getOnlyProjectActivitiesTimesheetRegistration()
    {
        return $this->container['only_project_activities_timesheet_registration'];
    }

    /**
     * Sets only_project_activities_timesheet_registration
     *
     * @param bool|null $only_project_activities_timesheet_registration only_project_activities_timesheet_registration
     *
     * @return self
     */
    public function setOnlyProjectActivitiesTimesheetRegistration($only_project_activities_timesheet_registration)
    {

        if (is_null($only_project_activities_timesheet_registration)) {
            throw new \InvalidArgumentException('non-nullable only_project_activities_timesheet_registration cannot be null');
        }

        $this->container['only_project_activities_timesheet_registration'] = $only_project_activities_timesheet_registration;

        return $this;
    }

    /**
     * Gets hourly_rate_projects_write_up_down
     *
     * @return bool|null
     */
    public function getHourlyRateProjectsWriteUpDown()
    {
        return $this->container['hourly_rate_projects_write_up_down'];
    }

    /**
     * Sets hourly_rate_projects_write_up_down
     *
     * @param bool|null $hourly_rate_projects_write_up_down hourly_rate_projects_write_up_down
     *
     * @return self
     */
    public function setHourlyRateProjectsWriteUpDown($hourly_rate_projects_write_up_down)
    {

        if (is_null($hourly_rate_projects_write_up_down)) {
            throw new \InvalidArgumentException('non-nullable hourly_rate_projects_write_up_down cannot be null');
        }

        $this->container['hourly_rate_projects_write_up_down'] = $hourly_rate_projects_write_up_down;

        return $this;
    }

    /**
     * Gets show_recently_closed_projects_on_supplier_invoice
     *
     * @return bool|null
     */
    public function getShowRecentlyClosedProjectsOnSupplierInvoice()
    {
        return $this->container['show_recently_closed_projects_on_supplier_invoice'];
    }

    /**
     * Sets show_recently_closed_projects_on_supplier_invoice
     *
     * @param bool|null $show_recently_closed_projects_on_supplier_invoice show_recently_closed_projects_on_supplier_invoice
     *
     * @return self
     */
    public function setShowRecentlyClosedProjectsOnSupplierInvoice($show_recently_closed_projects_on_supplier_invoice)
    {

        if (is_null($show_recently_closed_projects_on_supplier_invoice)) {
            throw new \InvalidArgumentException('non-nullable show_recently_closed_projects_on_supplier_invoice cannot be null');
        }

        $this->container['show_recently_closed_projects_on_supplier_invoice'] = $show_recently_closed_projects_on_supplier_invoice;

        return $this;
    }

    /**
     * Gets default_project_contract_comment
     *
     * @return string|null
     */
    public function getDefaultProjectContractComment()
    {
        return $this->container['default_project_contract_comment'];
    }

    /**
     * Sets default_project_contract_comment
     *
     * @param string|null $default_project_contract_comment default_project_contract_comment
     *
     * @return self
     */
    public function setDefaultProjectContractComment($default_project_contract_comment)
    {

        if (is_null($default_project_contract_comment)) {
            throw new \InvalidArgumentException('non-nullable default_project_contract_comment cannot be null');
        }

        $this->container['default_project_contract_comment'] = $default_project_contract_comment;

        return $this;
    }

    /**
     * Gets default_project_invoicing_comment
     *
     * @return string|null
     */
    public function getDefaultProjectInvoicingComment()
    {
        return $this->container['default_project_invoicing_comment'];
    }

    /**
     * Sets default_project_invoicing_comment
     *
     * @param string|null $default_project_invoicing_comment default_project_invoicing_comment
     *
     * @return self
     */
    public function setDefaultProjectInvoicingComment($default_project_invoicing_comment)
    {

        if (is_null($default_project_invoicing_comment)) {
            throw new \InvalidArgumentException('non-nullable default_project_invoicing_comment cannot be null');
        }

        $this->container['default_project_invoicing_comment'] = $default_project_invoicing_comment;

        return $this;
    }

    /**
     * Gets resource_planning
     *
     * @return bool|null
     */
    public function getResourcePlanning()
    {
        return $this->container['resource_planning'];
    }

    /**
     * Sets resource_planning
     *
     * @param bool|null $resource_planning resource_planning
     *
     * @return self
     */
    public function setResourcePlanning($resource_planning)
    {

        if (is_null($resource_planning)) {
            throw new \InvalidArgumentException('non-nullable resource_planning cannot be null');
        }

        $this->container['resource_planning'] = $resource_planning;

        return $this;
    }

    /**
     * Gets resource_groups
     *
     * @return bool|null
     */
    public function getResourceGroups()
    {
        return $this->container['resource_groups'];
    }

    /**
     * Sets resource_groups
     *
     * @param bool|null $resource_groups resource_groups
     *
     * @return self
     */
    public function setResourceGroups($resource_groups)
    {

        if (is_null($resource_groups)) {
            throw new \InvalidArgumentException('non-nullable resource_groups cannot be null');
        }

        $this->container['resource_groups'] = $resource_groups;

        return $this;
    }

    /**
     * Gets holiday_plan
     *
     * @return bool|null
     */
    public function getHolidayPlan()
    {
        return $this->container['holiday_plan'];
    }

    /**
     * Sets holiday_plan
     *
     * @param bool|null $holiday_plan holiday_plan
     *
     * @return self
     */
    public function setHolidayPlan($holiday_plan)
    {

        if (is_null($holiday_plan)) {
            throw new \InvalidArgumentException('non-nullable holiday_plan cannot be null');
        }

        $this->container['holiday_plan'] = $holiday_plan;

        return $this;
    }

    /**
     * Gets resource_plan_period
     *
     * @return string|null
     */
    public function getResourcePlanPeriod()
    {
        return $this->container['resource_plan_period'];
    }

    /**
     * Sets resource_plan_period
     *
     * @param string|null $resource_plan_period resource_plan_period
     *
     * @return self
     */
    public function setResourcePlanPeriod($resource_plan_period)
    {
        $allowedValues = $this->getResourcePlanPeriodAllowableValues();
        if (!is_null($resource_plan_period) && !in_array($resource_plan_period, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'resource_plan_period', must be one of '%s'",
                    $resource_plan_period,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($resource_plan_period)) {
            throw new \InvalidArgumentException('non-nullable resource_plan_period cannot be null');
        }

        $this->container['resource_plan_period'] = $resource_plan_period;

        return $this;
    }

    /**
     * Gets control_forms_required_for_invoicing
     *
     * @return \Learnist\Tripletex\Model\ProjectControlFormType[]|null
     */
    public function getControlFormsRequiredForInvoicing()
    {
        return $this->container['control_forms_required_for_invoicing'];
    }

    /**
     * Sets control_forms_required_for_invoicing
     *
     * @param \Learnist\Tripletex\Model\ProjectControlFormType[]|null $control_forms_required_for_invoicing Control forms required for invoicing
     *
     * @return self
     */
    public function setControlFormsRequiredForInvoicing($control_forms_required_for_invoicing)
    {

        if (is_null($control_forms_required_for_invoicing)) {
            throw new \InvalidArgumentException('non-nullable control_forms_required_for_invoicing cannot be null');
        }

        $this->container['control_forms_required_for_invoicing'] = $control_forms_required_for_invoicing;

        return $this;
    }

    /**
     * Gets control_forms_required_for_hour_tracking
     *
     * @return \Learnist\Tripletex\Model\ProjectControlFormType[]|null
     */
    public function getControlFormsRequiredForHourTracking()
    {
        return $this->container['control_forms_required_for_hour_tracking'];
    }

    /**
     * Sets control_forms_required_for_hour_tracking
     *
     * @param \Learnist\Tripletex\Model\ProjectControlFormType[]|null $control_forms_required_for_hour_tracking Control forms required for hour tracking
     *
     * @return self
     */
    public function setControlFormsRequiredForHourTracking($control_forms_required_for_hour_tracking)
    {

        if (is_null($control_forms_required_for_hour_tracking)) {
            throw new \InvalidArgumentException('non-nullable control_forms_required_for_hour_tracking cannot be null');
        }

        $this->container['control_forms_required_for_hour_tracking'] = $control_forms_required_for_hour_tracking;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_project_budget
     *
     * @return bool|null
     */
    public function getUseLoggedInUserEmailOnProjectBudget()
    {
        return $this->container['use_logged_in_user_email_on_project_budget'];
    }

    /**
     * Sets use_logged_in_user_email_on_project_budget
     *
     * @param bool|null $use_logged_in_user_email_on_project_budget use_logged_in_user_email_on_project_budget
     *
     * @return self
     */
    public function setUseLoggedInUserEmailOnProjectBudget($use_logged_in_user_email_on_project_budget)
    {

        if (is_null($use_logged_in_user_email_on_project_budget)) {
            throw new \InvalidArgumentException('non-nullable use_logged_in_user_email_on_project_budget cannot be null');
        }

        $this->container['use_logged_in_user_email_on_project_budget'] = $use_logged_in_user_email_on_project_budget;

        return $this;
    }

    /**
     * Gets email_on_project_budget
     *
     * @return string|null
     */
    public function getEmailOnProjectBudget()
    {
        return $this->container['email_on_project_budget'];
    }

    /**
     * Sets email_on_project_budget
     *
     * @param string|null $email_on_project_budget email_on_project_budget
     *
     * @return self
     */
    public function setEmailOnProjectBudget($email_on_project_budget)
    {

        if (is_null($email_on_project_budget)) {
            throw new \InvalidArgumentException('non-nullable email_on_project_budget cannot be null');
        }

        $this->container['email_on_project_budget'] = $email_on_project_budget;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_project_contract
     *
     * @return bool|null
     */
    public function getUseLoggedInUserEmailOnProjectContract()
    {
        return $this->container['use_logged_in_user_email_on_project_contract'];
    }

    /**
     * Sets use_logged_in_user_email_on_project_contract
     *
     * @param bool|null $use_logged_in_user_email_on_project_contract use_logged_in_user_email_on_project_contract
     *
     * @return self
     */
    public function setUseLoggedInUserEmailOnProjectContract($use_logged_in_user_email_on_project_contract)
    {

        if (is_null($use_logged_in_user_email_on_project_contract)) {
            throw new \InvalidArgumentException('non-nullable use_logged_in_user_email_on_project_contract cannot be null');
        }

        $this->container['use_logged_in_user_email_on_project_contract'] = $use_logged_in_user_email_on_project_contract;

        return $this;
    }

    /**
     * Gets email_on_project_contract
     *
     * @return string|null
     */
    public function getEmailOnProjectContract()
    {
        return $this->container['email_on_project_contract'];
    }

    /**
     * Sets email_on_project_contract
     *
     * @param string|null $email_on_project_contract email_on_project_contract
     *
     * @return self
     */
    public function setEmailOnProjectContract($email_on_project_contract)
    {

        if (is_null($email_on_project_contract)) {
            throw new \InvalidArgumentException('non-nullable email_on_project_contract cannot be null');
        }

        $this->container['email_on_project_contract'] = $email_on_project_contract;

        return $this;
    }

    /**
     * Gets use_logged_in_user_email_on_documents
     *
     * @return bool|null
     */
    public function getUseLoggedInUserEmailOnDocuments()
    {
        return $this->container['use_logged_in_user_email_on_documents'];
    }

    /**
     * Sets use_logged_in_user_email_on_documents
     *
     * @param bool|null $use_logged_in_user_email_on_documents use_logged_in_user_email_on_documents
     *
     * @return self
     */
    public function setUseLoggedInUserEmailOnDocuments($use_logged_in_user_email_on_documents)
    {

        if (is_null($use_logged_in_user_email_on_documents)) {
            throw new \InvalidArgumentException('non-nullable use_logged_in_user_email_on_documents cannot be null');
        }

        $this->container['use_logged_in_user_email_on_documents'] = $use_logged_in_user_email_on_documents;

        return $this;
    }

    /**
     * Gets email_on_documents
     *
     * @return string|null
     */
    public function getEmailOnDocuments()
    {
        return $this->container['email_on_documents'];
    }

    /**
     * Sets email_on_documents
     *
     * @param string|null $email_on_documents email_on_documents
     *
     * @return self
     */
    public function setEmailOnDocuments($email_on_documents)
    {

        if (is_null($email_on_documents)) {
            throw new \InvalidArgumentException('non-nullable email_on_documents cannot be null');
        }

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


