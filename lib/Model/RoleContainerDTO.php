<?php
/**
 * RoleContainerDTO
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
 * RoleContainerDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RoleContainerDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'RoleContainerDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'container' => 'string',
'description' => 'string',
'category' => '\Learnist\Tripletex\Model\Category',
'client_has_requirements' => 'bool',
'dependencies' => 'string[]',
'hidden' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'container' => null,
'description' => null,
'category' => null,
'client_has_requirements' => null,
'dependencies' => null,
'hidden' => null    ];

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
        'container' => 'container',
'description' => 'description',
'category' => 'category',
'client_has_requirements' => 'clientHasRequirements',
'dependencies' => 'dependencies',
'hidden' => 'hidden'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'container' => 'setContainer',
'description' => 'setDescription',
'category' => 'setCategory',
'client_has_requirements' => 'setClientHasRequirements',
'dependencies' => 'setDependencies',
'hidden' => 'setHidden'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'container' => 'getContainer',
'description' => 'getDescription',
'category' => 'getCategory',
'client_has_requirements' => 'getClientHasRequirements',
'dependencies' => 'getDependencies',
'hidden' => 'getHidden'    ];

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

    const CONTAINER_ROLE_ADMINISTRATOR = 'ROLE_ADMINISTRATOR';
const CONTAINER_AUTH_READ_ONLY = 'AUTH_READ_ONLY';
const CONTAINER_AUTH_LOGIN = 'AUTH_LOGIN';
const CONTAINER_AUTH_ALL_VOUCHERS = 'AUTH_ALL_VOUCHERS';
const CONTAINER_AUTH_COMPANY_ACCOUNTING_REPORTS = 'AUTH_COMPANY_ACCOUNTING_REPORTS';
const CONTAINER_AUTH_ACCOUNTING_SETTINGS = 'AUTH_ACCOUNTING_SETTINGS';
const CONTAINER_AUTH_COMPANY_RESULT_BUDGET = 'AUTH_COMPANY_RESULT_BUDGET';
const CONTAINER_AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS = 'AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS';
const CONTAINER_AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS = 'AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS';
const CONTAINER_AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS = 'AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS';
const CONTAINER_AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS = 'AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS';
const CONTAINER_AUTH_COMPANY_ATTESTOR = 'AUTH_COMPANY_ATTESTOR';
const CONTAINER_AUTH_DIRECT_REMIT_ADMIN = 'AUTH_DIRECT_REMIT_ADMIN';
const CONTAINER_AUTH_DIRECT_REMIT_LIGHT = 'AUTH_DIRECT_REMIT_LIGHT';
const CONTAINER_AUTH_MANAGE_BANK_ACCOUNT_NUMBERS = 'AUTH_MANAGE_BANK_ACCOUNT_NUMBERS';
const CONTAINER_AUTH_DIRECT_REMIT_CREATE_NEW = 'AUTH_DIRECT_REMIT_CREATE_NEW';
const CONTAINER_AUTH_DIRECT_REMIT_ADMIN_ZTL = 'AUTH_DIRECT_REMIT_ADMIN_ZTL';
const CONTAINER_AUTH_COMPANY_ADMIN = 'AUTH_COMPANY_ADMIN';
const CONTAINER_AUTH_EMPLOYEE_INFO = 'AUTH_EMPLOYEE_INFO';
const CONTAINER_AUTH_COMPANY_EMPLOYEE_ADMIN = 'AUTH_COMPANY_EMPLOYEE_ADMIN';
const CONTAINER_AUTH_CUSTOMER_ADMIN = 'AUTH_CUSTOMER_ADMIN';
const CONTAINER_AUTH_CUSTOMER_INFO = 'AUTH_CUSTOMER_INFO';
const CONTAINER_AUTH_CREATE_CUSTOMER = 'AUTH_CREATE_CUSTOMER';
const CONTAINER_AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES = 'AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES';
const CONTAINER_AUTH_ARCHIVE_READ = 'AUTH_ARCHIVE_READ';
const CONTAINER_AUTH_ARCHIVE_WRITE = 'AUTH_ARCHIVE_WRITE';
const CONTAINER_AUTH_ARCHIVE_ADMIN = 'AUTH_ARCHIVE_ADMIN';
const CONTAINER_AUTH_CREATE_NOTE = 'AUTH_CREATE_NOTE';
const CONTAINER_AUTH_CREATE_NOTE_TEMPLATE = 'AUTH_CREATE_NOTE_TEMPLATE';
const CONTAINER_AUTH_INVOICING = 'AUTH_INVOICING';
const CONTAINER_AUTH_OFFER_ADMIN = 'AUTH_OFFER_ADMIN';
const CONTAINER_AUTH_ORDER_ADMIN = 'AUTH_ORDER_ADMIN';
const CONTAINER_AUTH_CREATE_OFFER = 'AUTH_CREATE_OFFER';
const CONTAINER_AUTH_CREATE_ORDER = 'AUTH_CREATE_ORDER';
const CONTAINER_AUTH_FACTORING_EXPORT = 'AUTH_FACTORING_EXPORT';
const CONTAINER_AUTH_INVOICE_ADMIN_SETTINGS = 'AUTH_INVOICE_ADMIN_SETTINGS';
const CONTAINER_AUTH_PROJECT_MANAGER = 'AUTH_PROJECT_MANAGER';
const CONTAINER_AUTH_PROJECT_MANAGER_COMPANY = 'AUTH_PROJECT_MANAGER_COMPANY';
const CONTAINER_AUTH_DEPARTMENT_REPORT = 'AUTH_DEPARTMENT_REPORT';
const CONTAINER_AUTH_CREATE_PROJECT = 'AUTH_CREATE_PROJECT';
const CONTAINER_AUTH_PROJECT_EXTRA_COSTS = 'AUTH_PROJECT_EXTRA_COSTS';
const CONTAINER_AUTH_PROJECT_INFO = 'AUTH_PROJECT_INFO';
const CONTAINER_AUTH_PROJECT_ADMIN_SETTINGS = 'AUTH_PROJECT_ADMIN_SETTINGS';
const CONTAINER_AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT = 'AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT';
const CONTAINER_AUTH_PROJECT_CONTROL_FORMS = 'AUTH_PROJECT_CONTROL_FORMS';
const CONTAINER_AUTH_PRODUCT_ADMIN = 'AUTH_PRODUCT_ADMIN';
const CONTAINER_REPORT_ADMINISTRATOR = 'REPORT_ADMINISTRATOR';
const CONTAINER_REPORT_AUTHOR = 'REPORT_AUTHOR';
const CONTAINER_AUTH_COMPANY_WAGE_ADMIN = 'AUTH_COMPANY_WAGE_ADMIN';
const CONTAINER_AUTH_WAGE_ADMIN_SETTINGS = 'AUTH_WAGE_ADMIN_SETTINGS';
const CONTAINER_AUTH_WAGE_INFORMATION = 'AUTH_WAGE_INFORMATION';
const CONTAINER_AUTH_TASK_ADMIN = 'AUTH_TASK_ADMIN';
const CONTAINER_AUTH_HOURS_COMPANY = 'AUTH_HOURS_COMPANY';
const CONTAINER_AUTH_HOUR_STATISTICS_COMPANY = 'AUTH_HOUR_STATISTICS_COMPANY';
const CONTAINER_AUTH_HOURLIST = 'AUTH_HOURLIST';
const CONTAINER_AUTH_HOURLIST_SETTINGS = 'AUTH_HOURLIST_SETTINGS';
const CONTAINER_AUTH_HOLYDAY_PLAN = 'AUTH_HOLYDAY_PLAN';
const CONTAINER_AUTH_TRAVEL_REPORTS_COMPANY = 'AUTH_TRAVEL_REPORTS_COMPANY';
const CONTAINER_AUTH_TRAVEL_REPORT = 'AUTH_TRAVEL_REPORT';
const CONTAINER_AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS = 'AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS';
const CONTAINER_AUTH_VOUCHER_EXPORT = 'AUTH_VOUCHER_EXPORT';
const CONTAINER_AUTH_INBOX_VOUCHER = 'AUTH_INBOX_VOUCHER';
const CONTAINER_AUTH_INCOMPLETE_VOUCHERS = 'AUTH_INCOMPLETE_VOUCHERS';
const CONTAINER_AUTH_INCOMING_INVOICE = 'AUTH_INCOMING_INVOICE';
const CONTAINER_AUTH_VOUCHER_SETTINGS = 'AUTH_VOUCHER_SETTINGS';
const CONTAINER_AUTH_BANK_RECONCILIATION = 'AUTH_BANK_RECONCILIATION';
const CONTAINER_AUTH_VAT_REPORT = 'AUTH_VAT_REPORT';
const CONTAINER_AUTH_SICKNESS_REIMBURSEMENT = 'AUTH_SICKNESS_REIMBURSEMENT';
const CONTAINER_AUTH_REGISTER_INCOME = 'AUTH_REGISTER_INCOME';
const CONTAINER_AUTH_ADVANCED_VOUCHER = 'AUTH_ADVANCED_VOUCHER';
const CONTAINER_AUTH_VOUCHER_IMPORT = 'AUTH_VOUCHER_IMPORT';
const CONTAINER_AUTH_PRODUCT_INVOICE = 'AUTH_PRODUCT_INVOICE';
const CONTAINER_AUTH_CUSTOMS_DECLARATION = 'AUTH_CUSTOMS_DECLARATION';
const CONTAINER_AUTH_VOUCHER_AUTOMATION = 'AUTH_VOUCHER_AUTOMATION';
const CONTAINER_AUTH_REMIT_FILES_VOUCHER_OVERVIEW = 'AUTH_REMIT_FILES_VOUCHER_OVERVIEW';
const CONTAINER_YEAR_END_REPORT_ADMINISTRATOR = 'YEAR_END_REPORT_ADMINISTRATOR';
const DEPENDENCIES_ROLE_ADMINISTRATOR = 'ROLE_ADMINISTRATOR';
const DEPENDENCIES_AUTH_READ_ONLY = 'AUTH_READ_ONLY';
const DEPENDENCIES_AUTH_LOGIN = 'AUTH_LOGIN';
const DEPENDENCIES_AUTH_ALL_VOUCHERS = 'AUTH_ALL_VOUCHERS';
const DEPENDENCIES_AUTH_COMPANY_ACCOUNTING_REPORTS = 'AUTH_COMPANY_ACCOUNTING_REPORTS';
const DEPENDENCIES_AUTH_ACCOUNTING_SETTINGS = 'AUTH_ACCOUNTING_SETTINGS';
const DEPENDENCIES_AUTH_COMPANY_RESULT_BUDGET = 'AUTH_COMPANY_RESULT_BUDGET';
const DEPENDENCIES_AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS = 'AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS';
const DEPENDENCIES_AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS = 'AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS';
const DEPENDENCIES_AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS = 'AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS';
const DEPENDENCIES_AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS = 'AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS';
const DEPENDENCIES_AUTH_COMPANY_ATTESTOR = 'AUTH_COMPANY_ATTESTOR';
const DEPENDENCIES_AUTH_DIRECT_REMIT_ADMIN = 'AUTH_DIRECT_REMIT_ADMIN';
const DEPENDENCIES_AUTH_DIRECT_REMIT_LIGHT = 'AUTH_DIRECT_REMIT_LIGHT';
const DEPENDENCIES_AUTH_MANAGE_BANK_ACCOUNT_NUMBERS = 'AUTH_MANAGE_BANK_ACCOUNT_NUMBERS';
const DEPENDENCIES_AUTH_DIRECT_REMIT_CREATE_NEW = 'AUTH_DIRECT_REMIT_CREATE_NEW';
const DEPENDENCIES_AUTH_DIRECT_REMIT_ADMIN_ZTL = 'AUTH_DIRECT_REMIT_ADMIN_ZTL';
const DEPENDENCIES_AUTH_COMPANY_ADMIN = 'AUTH_COMPANY_ADMIN';
const DEPENDENCIES_AUTH_EMPLOYEE_INFO = 'AUTH_EMPLOYEE_INFO';
const DEPENDENCIES_AUTH_COMPANY_EMPLOYEE_ADMIN = 'AUTH_COMPANY_EMPLOYEE_ADMIN';
const DEPENDENCIES_AUTH_CUSTOMER_ADMIN = 'AUTH_CUSTOMER_ADMIN';
const DEPENDENCIES_AUTH_CUSTOMER_INFO = 'AUTH_CUSTOMER_INFO';
const DEPENDENCIES_AUTH_CREATE_CUSTOMER = 'AUTH_CREATE_CUSTOMER';
const DEPENDENCIES_AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES = 'AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES';
const DEPENDENCIES_AUTH_ARCHIVE_READ = 'AUTH_ARCHIVE_READ';
const DEPENDENCIES_AUTH_ARCHIVE_WRITE = 'AUTH_ARCHIVE_WRITE';
const DEPENDENCIES_AUTH_ARCHIVE_ADMIN = 'AUTH_ARCHIVE_ADMIN';
const DEPENDENCIES_AUTH_CREATE_NOTE = 'AUTH_CREATE_NOTE';
const DEPENDENCIES_AUTH_CREATE_NOTE_TEMPLATE = 'AUTH_CREATE_NOTE_TEMPLATE';
const DEPENDENCIES_AUTH_INVOICING = 'AUTH_INVOICING';
const DEPENDENCIES_AUTH_OFFER_ADMIN = 'AUTH_OFFER_ADMIN';
const DEPENDENCIES_AUTH_ORDER_ADMIN = 'AUTH_ORDER_ADMIN';
const DEPENDENCIES_AUTH_CREATE_OFFER = 'AUTH_CREATE_OFFER';
const DEPENDENCIES_AUTH_CREATE_ORDER = 'AUTH_CREATE_ORDER';
const DEPENDENCIES_AUTH_FACTORING_EXPORT = 'AUTH_FACTORING_EXPORT';
const DEPENDENCIES_AUTH_INVOICE_ADMIN_SETTINGS = 'AUTH_INVOICE_ADMIN_SETTINGS';
const DEPENDENCIES_AUTH_PROJECT_MANAGER = 'AUTH_PROJECT_MANAGER';
const DEPENDENCIES_AUTH_PROJECT_MANAGER_COMPANY = 'AUTH_PROJECT_MANAGER_COMPANY';
const DEPENDENCIES_AUTH_DEPARTMENT_REPORT = 'AUTH_DEPARTMENT_REPORT';
const DEPENDENCIES_AUTH_CREATE_PROJECT = 'AUTH_CREATE_PROJECT';
const DEPENDENCIES_AUTH_PROJECT_EXTRA_COSTS = 'AUTH_PROJECT_EXTRA_COSTS';
const DEPENDENCIES_AUTH_PROJECT_INFO = 'AUTH_PROJECT_INFO';
const DEPENDENCIES_AUTH_PROJECT_ADMIN_SETTINGS = 'AUTH_PROJECT_ADMIN_SETTINGS';
const DEPENDENCIES_AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT = 'AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT';
const DEPENDENCIES_AUTH_PROJECT_CONTROL_FORMS = 'AUTH_PROJECT_CONTROL_FORMS';
const DEPENDENCIES_AUTH_PRODUCT_ADMIN = 'AUTH_PRODUCT_ADMIN';
const DEPENDENCIES_REPORT_ADMINISTRATOR = 'REPORT_ADMINISTRATOR';
const DEPENDENCIES_REPORT_AUTHOR = 'REPORT_AUTHOR';
const DEPENDENCIES_AUTH_COMPANY_WAGE_ADMIN = 'AUTH_COMPANY_WAGE_ADMIN';
const DEPENDENCIES_AUTH_WAGE_ADMIN_SETTINGS = 'AUTH_WAGE_ADMIN_SETTINGS';
const DEPENDENCIES_AUTH_WAGE_INFORMATION = 'AUTH_WAGE_INFORMATION';
const DEPENDENCIES_AUTH_TASK_ADMIN = 'AUTH_TASK_ADMIN';
const DEPENDENCIES_AUTH_HOURS_COMPANY = 'AUTH_HOURS_COMPANY';
const DEPENDENCIES_AUTH_HOUR_STATISTICS_COMPANY = 'AUTH_HOUR_STATISTICS_COMPANY';
const DEPENDENCIES_AUTH_HOURLIST = 'AUTH_HOURLIST';
const DEPENDENCIES_AUTH_HOURLIST_SETTINGS = 'AUTH_HOURLIST_SETTINGS';
const DEPENDENCIES_AUTH_HOLYDAY_PLAN = 'AUTH_HOLYDAY_PLAN';
const DEPENDENCIES_AUTH_TRAVEL_REPORTS_COMPANY = 'AUTH_TRAVEL_REPORTS_COMPANY';
const DEPENDENCIES_AUTH_TRAVEL_REPORT = 'AUTH_TRAVEL_REPORT';
const DEPENDENCIES_AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS = 'AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS';
const DEPENDENCIES_AUTH_VOUCHER_EXPORT = 'AUTH_VOUCHER_EXPORT';
const DEPENDENCIES_AUTH_INBOX_VOUCHER = 'AUTH_INBOX_VOUCHER';
const DEPENDENCIES_AUTH_INCOMPLETE_VOUCHERS = 'AUTH_INCOMPLETE_VOUCHERS';
const DEPENDENCIES_AUTH_INCOMING_INVOICE = 'AUTH_INCOMING_INVOICE';
const DEPENDENCIES_AUTH_VOUCHER_SETTINGS = 'AUTH_VOUCHER_SETTINGS';
const DEPENDENCIES_AUTH_BANK_RECONCILIATION = 'AUTH_BANK_RECONCILIATION';
const DEPENDENCIES_AUTH_VAT_REPORT = 'AUTH_VAT_REPORT';
const DEPENDENCIES_AUTH_SICKNESS_REIMBURSEMENT = 'AUTH_SICKNESS_REIMBURSEMENT';
const DEPENDENCIES_AUTH_REGISTER_INCOME = 'AUTH_REGISTER_INCOME';
const DEPENDENCIES_AUTH_ADVANCED_VOUCHER = 'AUTH_ADVANCED_VOUCHER';
const DEPENDENCIES_AUTH_VOUCHER_IMPORT = 'AUTH_VOUCHER_IMPORT';
const DEPENDENCIES_AUTH_PRODUCT_INVOICE = 'AUTH_PRODUCT_INVOICE';
const DEPENDENCIES_AUTH_CUSTOMS_DECLARATION = 'AUTH_CUSTOMS_DECLARATION';
const DEPENDENCIES_AUTH_VOUCHER_AUTOMATION = 'AUTH_VOUCHER_AUTOMATION';
const DEPENDENCIES_AUTH_REMIT_FILES_VOUCHER_OVERVIEW = 'AUTH_REMIT_FILES_VOUCHER_OVERVIEW';
const DEPENDENCIES_YEAR_END_REPORT_ADMINISTRATOR = 'YEAR_END_REPORT_ADMINISTRATOR';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getContainerAllowableValues()
    {
        return [
            self::CONTAINER_ROLE_ADMINISTRATOR,
self::CONTAINER_AUTH_READ_ONLY,
self::CONTAINER_AUTH_LOGIN,
self::CONTAINER_AUTH_ALL_VOUCHERS,
self::CONTAINER_AUTH_COMPANY_ACCOUNTING_REPORTS,
self::CONTAINER_AUTH_ACCOUNTING_SETTINGS,
self::CONTAINER_AUTH_COMPANY_RESULT_BUDGET,
self::CONTAINER_AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS,
self::CONTAINER_AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS,
self::CONTAINER_AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS,
self::CONTAINER_AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS,
self::CONTAINER_AUTH_COMPANY_ATTESTOR,
self::CONTAINER_AUTH_DIRECT_REMIT_ADMIN,
self::CONTAINER_AUTH_DIRECT_REMIT_LIGHT,
self::CONTAINER_AUTH_MANAGE_BANK_ACCOUNT_NUMBERS,
self::CONTAINER_AUTH_DIRECT_REMIT_CREATE_NEW,
self::CONTAINER_AUTH_DIRECT_REMIT_ADMIN_ZTL,
self::CONTAINER_AUTH_COMPANY_ADMIN,
self::CONTAINER_AUTH_EMPLOYEE_INFO,
self::CONTAINER_AUTH_COMPANY_EMPLOYEE_ADMIN,
self::CONTAINER_AUTH_CUSTOMER_ADMIN,
self::CONTAINER_AUTH_CUSTOMER_INFO,
self::CONTAINER_AUTH_CREATE_CUSTOMER,
self::CONTAINER_AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES,
self::CONTAINER_AUTH_ARCHIVE_READ,
self::CONTAINER_AUTH_ARCHIVE_WRITE,
self::CONTAINER_AUTH_ARCHIVE_ADMIN,
self::CONTAINER_AUTH_CREATE_NOTE,
self::CONTAINER_AUTH_CREATE_NOTE_TEMPLATE,
self::CONTAINER_AUTH_INVOICING,
self::CONTAINER_AUTH_OFFER_ADMIN,
self::CONTAINER_AUTH_ORDER_ADMIN,
self::CONTAINER_AUTH_CREATE_OFFER,
self::CONTAINER_AUTH_CREATE_ORDER,
self::CONTAINER_AUTH_FACTORING_EXPORT,
self::CONTAINER_AUTH_INVOICE_ADMIN_SETTINGS,
self::CONTAINER_AUTH_PROJECT_MANAGER,
self::CONTAINER_AUTH_PROJECT_MANAGER_COMPANY,
self::CONTAINER_AUTH_DEPARTMENT_REPORT,
self::CONTAINER_AUTH_CREATE_PROJECT,
self::CONTAINER_AUTH_PROJECT_EXTRA_COSTS,
self::CONTAINER_AUTH_PROJECT_INFO,
self::CONTAINER_AUTH_PROJECT_ADMIN_SETTINGS,
self::CONTAINER_AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT,
self::CONTAINER_AUTH_PROJECT_CONTROL_FORMS,
self::CONTAINER_AUTH_PRODUCT_ADMIN,
self::CONTAINER_REPORT_ADMINISTRATOR,
self::CONTAINER_REPORT_AUTHOR,
self::CONTAINER_AUTH_COMPANY_WAGE_ADMIN,
self::CONTAINER_AUTH_WAGE_ADMIN_SETTINGS,
self::CONTAINER_AUTH_WAGE_INFORMATION,
self::CONTAINER_AUTH_TASK_ADMIN,
self::CONTAINER_AUTH_HOURS_COMPANY,
self::CONTAINER_AUTH_HOUR_STATISTICS_COMPANY,
self::CONTAINER_AUTH_HOURLIST,
self::CONTAINER_AUTH_HOURLIST_SETTINGS,
self::CONTAINER_AUTH_HOLYDAY_PLAN,
self::CONTAINER_AUTH_TRAVEL_REPORTS_COMPANY,
self::CONTAINER_AUTH_TRAVEL_REPORT,
self::CONTAINER_AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS,
self::CONTAINER_AUTH_VOUCHER_EXPORT,
self::CONTAINER_AUTH_INBOX_VOUCHER,
self::CONTAINER_AUTH_INCOMPLETE_VOUCHERS,
self::CONTAINER_AUTH_INCOMING_INVOICE,
self::CONTAINER_AUTH_VOUCHER_SETTINGS,
self::CONTAINER_AUTH_BANK_RECONCILIATION,
self::CONTAINER_AUTH_VAT_REPORT,
self::CONTAINER_AUTH_SICKNESS_REIMBURSEMENT,
self::CONTAINER_AUTH_REGISTER_INCOME,
self::CONTAINER_AUTH_ADVANCED_VOUCHER,
self::CONTAINER_AUTH_VOUCHER_IMPORT,
self::CONTAINER_AUTH_PRODUCT_INVOICE,
self::CONTAINER_AUTH_CUSTOMS_DECLARATION,
self::CONTAINER_AUTH_VOUCHER_AUTOMATION,
self::CONTAINER_AUTH_REMIT_FILES_VOUCHER_OVERVIEW,
self::CONTAINER_YEAR_END_REPORT_ADMINISTRATOR,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDependenciesAllowableValues()
    {
        return [
            self::DEPENDENCIES_ROLE_ADMINISTRATOR,
self::DEPENDENCIES_AUTH_READ_ONLY,
self::DEPENDENCIES_AUTH_LOGIN,
self::DEPENDENCIES_AUTH_ALL_VOUCHERS,
self::DEPENDENCIES_AUTH_COMPANY_ACCOUNTING_REPORTS,
self::DEPENDENCIES_AUTH_ACCOUNTING_SETTINGS,
self::DEPENDENCIES_AUTH_COMPANY_RESULT_BUDGET,
self::DEPENDENCIES_AUTH_COMPANY_CUSTOMER_ACCOUNTING_REPORTS,
self::DEPENDENCIES_AUTH_COMPANY_VENDOR_ACCOUNTING_REPORTS,
self::DEPENDENCIES_AUTH_COMPANY_EMPLOYEE_ACCOUNTING_REPORTS,
self::DEPENDENCIES_AUTH_COMPANY_ASSET_ACCOUNTING_REPORTS,
self::DEPENDENCIES_AUTH_COMPANY_ATTESTOR,
self::DEPENDENCIES_AUTH_DIRECT_REMIT_ADMIN,
self::DEPENDENCIES_AUTH_DIRECT_REMIT_LIGHT,
self::DEPENDENCIES_AUTH_MANAGE_BANK_ACCOUNT_NUMBERS,
self::DEPENDENCIES_AUTH_DIRECT_REMIT_CREATE_NEW,
self::DEPENDENCIES_AUTH_DIRECT_REMIT_ADMIN_ZTL,
self::DEPENDENCIES_AUTH_COMPANY_ADMIN,
self::DEPENDENCIES_AUTH_EMPLOYEE_INFO,
self::DEPENDENCIES_AUTH_COMPANY_EMPLOYEE_ADMIN,
self::DEPENDENCIES_AUTH_CUSTOMER_ADMIN,
self::DEPENDENCIES_AUTH_CUSTOMER_INFO,
self::DEPENDENCIES_AUTH_CREATE_CUSTOMER,
self::DEPENDENCIES_AUTH_INBOX_ARCHIVE_ALL_EMPLOYEES,
self::DEPENDENCIES_AUTH_ARCHIVE_READ,
self::DEPENDENCIES_AUTH_ARCHIVE_WRITE,
self::DEPENDENCIES_AUTH_ARCHIVE_ADMIN,
self::DEPENDENCIES_AUTH_CREATE_NOTE,
self::DEPENDENCIES_AUTH_CREATE_NOTE_TEMPLATE,
self::DEPENDENCIES_AUTH_INVOICING,
self::DEPENDENCIES_AUTH_OFFER_ADMIN,
self::DEPENDENCIES_AUTH_ORDER_ADMIN,
self::DEPENDENCIES_AUTH_CREATE_OFFER,
self::DEPENDENCIES_AUTH_CREATE_ORDER,
self::DEPENDENCIES_AUTH_FACTORING_EXPORT,
self::DEPENDENCIES_AUTH_INVOICE_ADMIN_SETTINGS,
self::DEPENDENCIES_AUTH_PROJECT_MANAGER,
self::DEPENDENCIES_AUTH_PROJECT_MANAGER_COMPANY,
self::DEPENDENCIES_AUTH_DEPARTMENT_REPORT,
self::DEPENDENCIES_AUTH_CREATE_PROJECT,
self::DEPENDENCIES_AUTH_PROJECT_EXTRA_COSTS,
self::DEPENDENCIES_AUTH_PROJECT_INFO,
self::DEPENDENCIES_AUTH_PROJECT_ADMIN_SETTINGS,
self::DEPENDENCIES_AUTH_PROJECT_OWN_PROJECT_RESULT_REPORT,
self::DEPENDENCIES_AUTH_PROJECT_CONTROL_FORMS,
self::DEPENDENCIES_AUTH_PRODUCT_ADMIN,
self::DEPENDENCIES_REPORT_ADMINISTRATOR,
self::DEPENDENCIES_REPORT_AUTHOR,
self::DEPENDENCIES_AUTH_COMPANY_WAGE_ADMIN,
self::DEPENDENCIES_AUTH_WAGE_ADMIN_SETTINGS,
self::DEPENDENCIES_AUTH_WAGE_INFORMATION,
self::DEPENDENCIES_AUTH_TASK_ADMIN,
self::DEPENDENCIES_AUTH_HOURS_COMPANY,
self::DEPENDENCIES_AUTH_HOUR_STATISTICS_COMPANY,
self::DEPENDENCIES_AUTH_HOURLIST,
self::DEPENDENCIES_AUTH_HOURLIST_SETTINGS,
self::DEPENDENCIES_AUTH_HOLYDAY_PLAN,
self::DEPENDENCIES_AUTH_TRAVEL_REPORTS_COMPANY,
self::DEPENDENCIES_AUTH_TRAVEL_REPORT,
self::DEPENDENCIES_AUTH_TRAVEL_EXPENSE_ADMIN_SETTINGS,
self::DEPENDENCIES_AUTH_VOUCHER_EXPORT,
self::DEPENDENCIES_AUTH_INBOX_VOUCHER,
self::DEPENDENCIES_AUTH_INCOMPLETE_VOUCHERS,
self::DEPENDENCIES_AUTH_INCOMING_INVOICE,
self::DEPENDENCIES_AUTH_VOUCHER_SETTINGS,
self::DEPENDENCIES_AUTH_BANK_RECONCILIATION,
self::DEPENDENCIES_AUTH_VAT_REPORT,
self::DEPENDENCIES_AUTH_SICKNESS_REIMBURSEMENT,
self::DEPENDENCIES_AUTH_REGISTER_INCOME,
self::DEPENDENCIES_AUTH_ADVANCED_VOUCHER,
self::DEPENDENCIES_AUTH_VOUCHER_IMPORT,
self::DEPENDENCIES_AUTH_PRODUCT_INVOICE,
self::DEPENDENCIES_AUTH_CUSTOMS_DECLARATION,
self::DEPENDENCIES_AUTH_VOUCHER_AUTOMATION,
self::DEPENDENCIES_AUTH_REMIT_FILES_VOUCHER_OVERVIEW,
self::DEPENDENCIES_YEAR_END_REPORT_ADMINISTRATOR,        ];
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
        $this->container['container'] = isset($data['container']) ? $data['container'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['client_has_requirements'] = isset($data['client_has_requirements']) ? $data['client_has_requirements'] : null;
        $this->container['dependencies'] = isset($data['dependencies']) ? $data['dependencies'] : null;
        $this->container['hidden'] = isset($data['hidden']) ? $data['hidden'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getContainerAllowableValues();
        if (!is_null($this->container['container']) && !in_array($this->container['container'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'container', must be one of '%s'",
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
     * Gets container
     *
     * @return string
     */
    public function getContainer()
    {
        return $this->container['container'];
    }

    /**
     * Sets container
     *
     * @param string $container container
     *
     * @return $this
     */
    public function setContainer($container)
    {
        $allowedValues = $this->getContainerAllowableValues();
        if (!is_null($container) && !in_array($container, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'container', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['container'] = $container;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets category
     *
     * @return \Learnist\Tripletex\Model\Category
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param \Learnist\Tripletex\Model\Category $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets client_has_requirements
     *
     * @return bool
     */
    public function getClientHasRequirements()
    {
        return $this->container['client_has_requirements'];
    }

    /**
     * Sets client_has_requirements
     *
     * @param bool $client_has_requirements client_has_requirements
     *
     * @return $this
     */
    public function setClientHasRequirements($client_has_requirements)
    {
        $this->container['client_has_requirements'] = $client_has_requirements;

        return $this;
    }

    /**
     * Gets dependencies
     *
     * @return string[]
     */
    public function getDependencies()
    {
        return $this->container['dependencies'];
    }

    /**
     * Sets dependencies
     *
     * @param string[] $dependencies dependencies
     *
     * @return $this
     */
    public function setDependencies($dependencies)
    {
        $allowedValues = $this->getDependenciesAllowableValues();
        if (!is_null($dependencies) && array_diff($dependencies, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'dependencies', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['dependencies'] = $dependencies;

        return $this;
    }

    /**
     * Gets hidden
     *
     * @return bool
     */
    public function getHidden()
    {
        return $this->container['hidden'];
    }

    /**
     * Sets hidden
     *
     * @param bool $hidden hidden
     *
     * @return $this
     */
    public function setHidden($hidden)
    {
        $this->container['hidden'] = $hidden;

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
