<?php
/**
 * SalesForceAccountInfo
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
 * SalesForceAccountInfo Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalesForceAccountInfo implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalesForceAccountInfo';

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
        'customer_id' => 'int',
        'customer_company_id' => 'int',
        'is_reseller' => 'bool',
        'is_accountant' => 'bool',
        'is_auditor' => 'bool',
        'is_suspended' => 'bool',
        'module_accountant_connect_client' => 'bool',
        'register_date' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'active_main_module' => 'string',
        'sales_force_opportunity_dto' => '\Learnist\Tripletex\Model\SalesForceOpportunity'
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
        'customer_id' => 'int32',
        'customer_company_id' => 'int32',
        'is_reseller' => null,
        'is_accountant' => null,
        'is_auditor' => null,
        'is_suspended' => null,
        'module_accountant_connect_client' => null,
        'register_date' => null,
        'start_date' => null,
        'end_date' => null,
        'active_main_module' => null,
        'sales_force_opportunity_dto' => null
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
		'customer_id' => false,
		'customer_company_id' => false,
		'is_reseller' => false,
		'is_accountant' => false,
		'is_auditor' => false,
		'is_suspended' => false,
		'module_accountant_connect_client' => false,
		'register_date' => false,
		'start_date' => false,
		'end_date' => false,
		'active_main_module' => false,
		'sales_force_opportunity_dto' => false
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
        'customer_id' => 'customerId',
        'customer_company_id' => 'customerCompanyId',
        'is_reseller' => 'isReseller',
        'is_accountant' => 'isAccountant',
        'is_auditor' => 'isAuditor',
        'is_suspended' => 'isSuspended',
        'module_accountant_connect_client' => 'moduleAccountantConnectClient',
        'register_date' => 'registerDate',
        'start_date' => 'startDate',
        'end_date' => 'endDate',
        'active_main_module' => 'activeMainModule',
        'sales_force_opportunity_dto' => 'salesForceOpportunityDTO'
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
        'customer_id' => 'setCustomerId',
        'customer_company_id' => 'setCustomerCompanyId',
        'is_reseller' => 'setIsReseller',
        'is_accountant' => 'setIsAccountant',
        'is_auditor' => 'setIsAuditor',
        'is_suspended' => 'setIsSuspended',
        'module_accountant_connect_client' => 'setModuleAccountantConnectClient',
        'register_date' => 'setRegisterDate',
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
        'active_main_module' => 'setActiveMainModule',
        'sales_force_opportunity_dto' => 'setSalesForceOpportunityDto'
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
        'customer_id' => 'getCustomerId',
        'customer_company_id' => 'getCustomerCompanyId',
        'is_reseller' => 'getIsReseller',
        'is_accountant' => 'getIsAccountant',
        'is_auditor' => 'getIsAuditor',
        'is_suspended' => 'getIsSuspended',
        'module_accountant_connect_client' => 'getModuleAccountantConnectClient',
        'register_date' => 'getRegisterDate',
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
        'active_main_module' => 'getActiveMainModule',
        'sales_force_opportunity_dto' => 'getSalesForceOpportunityDto'
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

    public const ACTIVE_MAIN_MODULE_ACCOUNTING = 'ACCOUNTING';
    public const ACTIVE_MAIN_MODULE_INVOICE = 'INVOICE';
    public const ACTIVE_MAIN_MODULE_CRM = 'CRM';
    public const ACTIVE_MAIN_MODULE_PROJECT = 'PROJECT';
    public const ACTIVE_MAIN_MODULE_WAGE = 'WAGE';
    public const ACTIVE_MAIN_MODULE_NETS_PRINT = 'NETS_PRINT';
    public const ACTIVE_MAIN_MODULE_NETS_PRINT_SALARY = 'NETS_PRINT_SALARY';
    public const ACTIVE_MAIN_MODULE_OCR = 'OCR';
    public const ACTIVE_MAIN_MODULE_REMIT = 'REMIT';
    public const ACTIVE_MAIN_MODULE_SMS_NOTIFICATION = 'SMS_NOTIFICATION';
    public const ACTIVE_MAIN_MODULE_VOUCHER_SCANNING = 'VOUCHER_SCANNING';
    public const ACTIVE_MAIN_MODULE_TIME_TRACKING = 'TIME_TRACKING';
    public const ACTIVE_MAIN_MODULE_VVS_ELECTRO = 'VVS_ELECTRO';
    public const ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_VVS_ELEKTRO = 'UBEGRENSET_BILAG_VVS_ELEKTRO';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_VIPPS = 'INVOICE_OPTION_VIPPS';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_EFAKTURA = 'INVOICE_OPTION_EFAKTURA';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_AVTALEGIRO = 'INVOICE_OPTION_AVTALEGIRO';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_PAPER = 'INVOICE_OPTION_PAPER';
    public const ACTIVE_MAIN_MODULE_FACTORING_APRILA = 'FACTORING_APRILA';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_AUTOINVOICE_OUTBOUND_EHF = 'INVOICE_OPTION_AUTOINVOICE_OUTBOUND_EHF';
    public const ACTIVE_MAIN_MODULE_API_V2 = 'API_V2';
    public const ACTIVE_MAIN_MODULE_SMART_SCAN = 'SMART_SCAN';
    public const ACTIVE_MAIN_MODULE_BILAG_0_100_MIKRO = 'BILAG_0_100_mikro';
    public const ACTIVE_MAIN_MODULE_BILAG_0_500_VANLIG_LEGACY = 'BILAG_0_500_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_501_1000_VANLIG_LEGACY = 'BILAG_501_1000_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_1001_2000_VANLIG_LEGACY = 'BILAG_1001_2000_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_2001_3500_VANLIG_LEGACY = 'BILAG_2001_3500_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_3501_5000_VANLIG_LEGACY = 'BILAG_3501_5000_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_5001_10001_VANLIG_LEGACY = 'BILAG_5001_10001_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_VANLIG_LEGACY = 'UBEGRENSET_BILAG_vanlig_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_0_500_PROSJEKT_LEGACY = 'BILAG_0_500_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_501_1000_PROSJEKT_LEGACY = 'BILAG_501_1000_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_1001_2000_PROSJEKT_LEGACY = 'BILAG_1001_2000_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_2001_3500_PROSJEKT_LEGACY = 'BILAG_2001_3500_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_3501_5000_PROSJEKT_LEGACY = 'BILAG_3501_5000_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_BILAG_5001_10001_PROSJEKT_LEGACY = 'BILAG_5001_10001_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_PROSJEKT_LEGACY = 'UBEGRENSET_BILAG_prosjekt_legacy';
    public const ACTIVE_MAIN_MODULE_MIKRO = 'MIKRO';
    public const ACTIVE_MAIN_MODULE_MINI = 'MINI';
    public const ACTIVE_MAIN_MODULE_MEDIUM = 'MEDIUM';
    public const ACTIVE_MAIN_MODULE_TOTAL = 'TOTAL';
    public const ACTIVE_MAIN_MODULE_BASIS = 'BASIS';
    public const ACTIVE_MAIN_MODULE_SMART = 'SMART';
    public const ACTIVE_MAIN_MODULE_AGRO_CLIENT = 'AGRO_CLIENT';
    public const ACTIVE_MAIN_MODULE_MAMUT = 'MAMUT';
    public const ACTIVE_MAIN_MODULE_KOMPLETT = 'KOMPLETT';
    public const ACTIVE_MAIN_MODULE_SMART_WAGE = 'SMART_WAGE';
    public const ACTIVE_MAIN_MODULE_SMART_TIME_TRACKING = 'SMART_TIME_TRACKING';
    public const ACTIVE_MAIN_MODULE_BILAG_0_500 = 'BILAG_0_500';
    public const ACTIVE_MAIN_MODULE_BILAG_501_1000 = 'BILAG_501_1000';
    public const ACTIVE_MAIN_MODULE_BILAG_1001_2000 = 'BILAG_1001_2000';
    public const ACTIVE_MAIN_MODULE_BILAG_2001_3500 = 'BILAG_2001_3500';
    public const ACTIVE_MAIN_MODULE_BILAG_3501_5000 = 'BILAG_3501_5000';
    public const ACTIVE_MAIN_MODULE_BILAG_5001_10001 = 'BILAG_5001_10001';
    public const ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG = 'UBEGRENSET_BILAG';
    public const ACTIVE_MAIN_MODULE_READ_ONLY_ACCESS = 'READ_ONLY_ACCESS';
    public const ACTIVE_MAIN_MODULE_READ_ONLY_ACCESS_FREE = 'READ_ONLY_ACCESS_FREE';
    public const ACTIVE_MAIN_MODULE_AUTOPAY = 'AUTOPAY';
    public const ACTIVE_MAIN_MODULE_VOUCHER_APPROVAL = 'VOUCHER_APPROVAL';
    public const ACTIVE_MAIN_MODULE_SMART_PROJECT = 'SMART_PROJECT';
    public const ACTIVE_MAIN_MODULE_ACCOUNT_OFFICE = 'ACCOUNT_OFFICE';
    public const ACTIVE_MAIN_MODULE_UNLIMITED_VOUCHER_ACCOUNT_OFFICE = 'UNLIMITED_VOUCHER_ACCOUNT_OFFICE';
    public const ACTIVE_MAIN_MODULE_COMPANY_SERVICE_FOR_PAYING_ACCOUNT_OFFICES = 'COMPANY_SERVICE_FOR_PAYING_ACCOUNT_OFFICES';
    public const ACTIVE_MAIN_MODULE_AGRO_WAGE = 'AGRO_WAGE';
    public const ACTIVE_MAIN_MODULE_INVOICE_OPTION_AUTOINVOICE_INCOMING_EHF = 'INVOICE_OPTION_AUTOINVOICE_INCOMING_EHF';
    public const ACTIVE_MAIN_MODULE_MAMUT_PROJECT = 'MAMUT_PROJECT';
    public const ACTIVE_MAIN_MODULE_MAMUT_WITH_WAGE = 'MAMUT_WITH_WAGE';
    public const ACTIVE_MAIN_MODULE_USER_SERVICE_HISTORIC_CUSTOMERS_NON_STANDARD = 'USER_SERVICE_HISTORIC_CUSTOMERS_NON_STANDARD';
    public const ACTIVE_MAIN_MODULE_ENCRYPTED_PAYSLIP = 'ENCRYPTED_PAYSLIP';
    public const ACTIVE_MAIN_MODULE_AGRO_LICENCE = 'AGRO_LICENCE';
    public const ACTIVE_MAIN_MODULE_AGRO_DOCUMENT_CENTER = 'AGRO_DOCUMENT_CENTER';
    public const ACTIVE_MAIN_MODULE_AGRO_INVOICE = 'AGRO_INVOICE';
    public const ACTIVE_MAIN_MODULE_FIVE_EMPLOYEES = 'FIVE_EMPLOYEES';
    public const ACTIVE_MAIN_MODULE_AUTOPLUS_MINI = 'AUTOPLUS_MINI';
    public const ACTIVE_MAIN_MODULE_AUTOPLUS_MEDIUM = 'AUTOPLUS_MEDIUM';
    public const ACTIVE_MAIN_MODULE_AUTOPLUS_STOR = 'AUTOPLUS_STOR';
    public const ACTIVE_MAIN_MODULE_CASH_CREDIT_APRILA = 'CASH_CREDIT_APRILA';
    public const ACTIVE_MAIN_MODULE_NO1_TS = 'NO1TS';
    public const ACTIVE_MAIN_MODULE_NO1_TS_TRAVELREPORT = 'NO1TS_TRAVELREPORT';
    public const ACTIVE_MAIN_MODULE_NO1_TS_ACCOUNTING = 'NO1TS_ACCOUNTING';
    public const ACTIVE_MAIN_MODULE_AGRO_INVOICE_MIGRATED = 'AGRO_INVOICE_MIGRATED';
    public const ACTIVE_MAIN_MODULE_USER_CATEGORY_1_LICENSE = 'USER_CATEGORY_1_LICENSE';
    public const ACTIVE_MAIN_MODULE_USER_CATEGORY_2_LICENSE = 'USER_CATEGORY_2_LICENSE';
    public const ACTIVE_MAIN_MODULE_USER_CATEGORY_3_LICENSE = 'USER_CATEGORY_3_LICENSE';
    public const ACTIVE_MAIN_MODULE_VOUCHER_FACTORY = 'VOUCHER_FACTORY';
    public const ACTIVE_MAIN_MODULE_OCR_AUTOPAY = 'OCR_AUTOPAY';
    public const ACTIVE_MAIN_MODULE_CLOSED_ACCOUNT = 'CLOSED_ACCOUNT';
    public const ACTIVE_MAIN_MODULE_LOGISTICS = 'LOGISTICS';
    public const ACTIVE_MAIN_MODULE_INTEGRATION_PARTNER = 'INTEGRATION_PARTNER';
    public const ACTIVE_MAIN_MODULE_CREDIT_SCORING = 'CREDIT_SCORING';
    public const ACTIVE_MAIN_MODULE_ZTL = 'ZTL';
    public const ACTIVE_MAIN_MODULE_PLUSS = 'PLUSS';
    public const ACTIVE_MAIN_MODULE_YEAR_END_REPORTING_ENK = 'YEAR_END_REPORTING_ENK';
    public const ACTIVE_MAIN_MODULE_FACTORING_VISMA_FINANCE = 'FACTORING_VISMA_FINANCE';
    public const ACTIVE_MAIN_MODULE_YEAR_END_REPORTING_AS = 'YEAR_END_REPORTING_AS';
    public const ACTIVE_MAIN_MODULE_BILAG_0_100_MIKRO_AUTOMATION = 'BILAG_0_100_MIKRO_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_0_500_AUTOMATION = 'BILAG_0_500_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_501_1000_AUTOMATION = 'BILAG_501_1000_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_1001_2000_AUTOMATION = 'BILAG_1001_2000_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_2001_3500_AUTOMATION = 'BILAG_2001_3500_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_3501_5000_AUTOMATION = 'BILAG_3501_5000_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_BILAG_5001_10001_AUTOMATION = 'BILAG_5001_10001_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_AUTOMATION = 'UBEGRENSET_BILAG_AUTOMATION';
    public const ACTIVE_MAIN_MODULE_CMA_SHOPIFY = 'CMA_SHOPIFY';
    public const ACTIVE_MAIN_MODULE_CMA_MYSTORE = 'CMA_MYSTORE';
    public const ACTIVE_MAIN_MODULE_CMA_WOOCOMMERCE = 'CMA_WOOCOMMERCE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getActiveMainModuleAllowableValues()
    {
        return [
            self::ACTIVE_MAIN_MODULE_ACCOUNTING,
            self::ACTIVE_MAIN_MODULE_INVOICE,
            self::ACTIVE_MAIN_MODULE_CRM,
            self::ACTIVE_MAIN_MODULE_PROJECT,
            self::ACTIVE_MAIN_MODULE_WAGE,
            self::ACTIVE_MAIN_MODULE_NETS_PRINT,
            self::ACTIVE_MAIN_MODULE_NETS_PRINT_SALARY,
            self::ACTIVE_MAIN_MODULE_OCR,
            self::ACTIVE_MAIN_MODULE_REMIT,
            self::ACTIVE_MAIN_MODULE_SMS_NOTIFICATION,
            self::ACTIVE_MAIN_MODULE_VOUCHER_SCANNING,
            self::ACTIVE_MAIN_MODULE_TIME_TRACKING,
            self::ACTIVE_MAIN_MODULE_VVS_ELECTRO,
            self::ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_VVS_ELEKTRO,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_VIPPS,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_EFAKTURA,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_AVTALEGIRO,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_PAPER,
            self::ACTIVE_MAIN_MODULE_FACTORING_APRILA,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_AUTOINVOICE_OUTBOUND_EHF,
            self::ACTIVE_MAIN_MODULE_API_V2,
            self::ACTIVE_MAIN_MODULE_SMART_SCAN,
            self::ACTIVE_MAIN_MODULE_BILAG_0_100_MIKRO,
            self::ACTIVE_MAIN_MODULE_BILAG_0_500_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_501_1000_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_1001_2000_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_2001_3500_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_3501_5000_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_5001_10001_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_VANLIG_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_0_500_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_501_1000_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_1001_2000_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_2001_3500_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_3501_5000_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_BILAG_5001_10001_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_PROSJEKT_LEGACY,
            self::ACTIVE_MAIN_MODULE_MIKRO,
            self::ACTIVE_MAIN_MODULE_MINI,
            self::ACTIVE_MAIN_MODULE_MEDIUM,
            self::ACTIVE_MAIN_MODULE_TOTAL,
            self::ACTIVE_MAIN_MODULE_BASIS,
            self::ACTIVE_MAIN_MODULE_SMART,
            self::ACTIVE_MAIN_MODULE_AGRO_CLIENT,
            self::ACTIVE_MAIN_MODULE_MAMUT,
            self::ACTIVE_MAIN_MODULE_KOMPLETT,
            self::ACTIVE_MAIN_MODULE_SMART_WAGE,
            self::ACTIVE_MAIN_MODULE_SMART_TIME_TRACKING,
            self::ACTIVE_MAIN_MODULE_BILAG_0_500,
            self::ACTIVE_MAIN_MODULE_BILAG_501_1000,
            self::ACTIVE_MAIN_MODULE_BILAG_1001_2000,
            self::ACTIVE_MAIN_MODULE_BILAG_2001_3500,
            self::ACTIVE_MAIN_MODULE_BILAG_3501_5000,
            self::ACTIVE_MAIN_MODULE_BILAG_5001_10001,
            self::ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG,
            self::ACTIVE_MAIN_MODULE_READ_ONLY_ACCESS,
            self::ACTIVE_MAIN_MODULE_READ_ONLY_ACCESS_FREE,
            self::ACTIVE_MAIN_MODULE_AUTOPAY,
            self::ACTIVE_MAIN_MODULE_VOUCHER_APPROVAL,
            self::ACTIVE_MAIN_MODULE_SMART_PROJECT,
            self::ACTIVE_MAIN_MODULE_ACCOUNT_OFFICE,
            self::ACTIVE_MAIN_MODULE_UNLIMITED_VOUCHER_ACCOUNT_OFFICE,
            self::ACTIVE_MAIN_MODULE_COMPANY_SERVICE_FOR_PAYING_ACCOUNT_OFFICES,
            self::ACTIVE_MAIN_MODULE_AGRO_WAGE,
            self::ACTIVE_MAIN_MODULE_INVOICE_OPTION_AUTOINVOICE_INCOMING_EHF,
            self::ACTIVE_MAIN_MODULE_MAMUT_PROJECT,
            self::ACTIVE_MAIN_MODULE_MAMUT_WITH_WAGE,
            self::ACTIVE_MAIN_MODULE_USER_SERVICE_HISTORIC_CUSTOMERS_NON_STANDARD,
            self::ACTIVE_MAIN_MODULE_ENCRYPTED_PAYSLIP,
            self::ACTIVE_MAIN_MODULE_AGRO_LICENCE,
            self::ACTIVE_MAIN_MODULE_AGRO_DOCUMENT_CENTER,
            self::ACTIVE_MAIN_MODULE_AGRO_INVOICE,
            self::ACTIVE_MAIN_MODULE_FIVE_EMPLOYEES,
            self::ACTIVE_MAIN_MODULE_AUTOPLUS_MINI,
            self::ACTIVE_MAIN_MODULE_AUTOPLUS_MEDIUM,
            self::ACTIVE_MAIN_MODULE_AUTOPLUS_STOR,
            self::ACTIVE_MAIN_MODULE_CASH_CREDIT_APRILA,
            self::ACTIVE_MAIN_MODULE_NO1_TS,
            self::ACTIVE_MAIN_MODULE_NO1_TS_TRAVELREPORT,
            self::ACTIVE_MAIN_MODULE_NO1_TS_ACCOUNTING,
            self::ACTIVE_MAIN_MODULE_AGRO_INVOICE_MIGRATED,
            self::ACTIVE_MAIN_MODULE_USER_CATEGORY_1_LICENSE,
            self::ACTIVE_MAIN_MODULE_USER_CATEGORY_2_LICENSE,
            self::ACTIVE_MAIN_MODULE_USER_CATEGORY_3_LICENSE,
            self::ACTIVE_MAIN_MODULE_VOUCHER_FACTORY,
            self::ACTIVE_MAIN_MODULE_OCR_AUTOPAY,
            self::ACTIVE_MAIN_MODULE_CLOSED_ACCOUNT,
            self::ACTIVE_MAIN_MODULE_LOGISTICS,
            self::ACTIVE_MAIN_MODULE_INTEGRATION_PARTNER,
            self::ACTIVE_MAIN_MODULE_CREDIT_SCORING,
            self::ACTIVE_MAIN_MODULE_ZTL,
            self::ACTIVE_MAIN_MODULE_PLUSS,
            self::ACTIVE_MAIN_MODULE_YEAR_END_REPORTING_ENK,
            self::ACTIVE_MAIN_MODULE_FACTORING_VISMA_FINANCE,
            self::ACTIVE_MAIN_MODULE_YEAR_END_REPORTING_AS,
            self::ACTIVE_MAIN_MODULE_BILAG_0_100_MIKRO_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_0_500_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_501_1000_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_1001_2000_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_2001_3500_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_3501_5000_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_BILAG_5001_10001_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_UBEGRENSET_BILAG_AUTOMATION,
            self::ACTIVE_MAIN_MODULE_CMA_SHOPIFY,
            self::ACTIVE_MAIN_MODULE_CMA_MYSTORE,
            self::ACTIVE_MAIN_MODULE_CMA_WOOCOMMERCE,
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
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('customer_company_id', $data ?? [], null);
        $this->setIfExists('is_reseller', $data ?? [], null);
        $this->setIfExists('is_accountant', $data ?? [], null);
        $this->setIfExists('is_auditor', $data ?? [], null);
        $this->setIfExists('is_suspended', $data ?? [], null);
        $this->setIfExists('module_accountant_connect_client', $data ?? [], null);
        $this->setIfExists('register_date', $data ?? [], null);
        $this->setIfExists('start_date', $data ?? [], null);
        $this->setIfExists('end_date', $data ?? [], null);
        $this->setIfExists('active_main_module', $data ?? [], null);
        $this->setIfExists('sales_force_opportunity_dto', $data ?? [], null);
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

        $allowedValues = $this->getActiveMainModuleAllowableValues();
        if (!is_null($this->container['active_main_module']) && !in_array($this->container['active_main_module'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'active_main_module', must be one of '%s'",
                $this->container['active_main_module'],
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
     * Gets customer_id
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     *
     * @param int|null $customer_id customer_id
     *
     * @return self
     */
    public function setCustomerId($customer_id)
    {

        if (is_null($customer_id)) {
            throw new \InvalidArgumentException('non-nullable customer_id cannot be null');
        }

        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets customer_company_id
     *
     * @return int|null
     */
    public function getCustomerCompanyId()
    {
        return $this->container['customer_company_id'];
    }

    /**
     * Sets customer_company_id
     *
     * @param int|null $customer_company_id customer_company_id
     *
     * @return self
     */
    public function setCustomerCompanyId($customer_company_id)
    {

        if (is_null($customer_company_id)) {
            throw new \InvalidArgumentException('non-nullable customer_company_id cannot be null');
        }

        $this->container['customer_company_id'] = $customer_company_id;

        return $this;
    }

    /**
     * Gets is_reseller
     *
     * @return bool|null
     */
    public function getIsReseller()
    {
        return $this->container['is_reseller'];
    }

    /**
     * Sets is_reseller
     *
     * @param bool|null $is_reseller is_reseller
     *
     * @return self
     */
    public function setIsReseller($is_reseller)
    {

        if (is_null($is_reseller)) {
            throw new \InvalidArgumentException('non-nullable is_reseller cannot be null');
        }

        $this->container['is_reseller'] = $is_reseller;

        return $this;
    }

    /**
     * Gets is_accountant
     *
     * @return bool|null
     */
    public function getIsAccountant()
    {
        return $this->container['is_accountant'];
    }

    /**
     * Sets is_accountant
     *
     * @param bool|null $is_accountant is_accountant
     *
     * @return self
     */
    public function setIsAccountant($is_accountant)
    {

        if (is_null($is_accountant)) {
            throw new \InvalidArgumentException('non-nullable is_accountant cannot be null');
        }

        $this->container['is_accountant'] = $is_accountant;

        return $this;
    }

    /**
     * Gets is_auditor
     *
     * @return bool|null
     */
    public function getIsAuditor()
    {
        return $this->container['is_auditor'];
    }

    /**
     * Sets is_auditor
     *
     * @param bool|null $is_auditor is_auditor
     *
     * @return self
     */
    public function setIsAuditor($is_auditor)
    {

        if (is_null($is_auditor)) {
            throw new \InvalidArgumentException('non-nullable is_auditor cannot be null');
        }

        $this->container['is_auditor'] = $is_auditor;

        return $this;
    }

    /**
     * Gets is_suspended
     *
     * @return bool|null
     */
    public function getIsSuspended()
    {
        return $this->container['is_suspended'];
    }

    /**
     * Sets is_suspended
     *
     * @param bool|null $is_suspended is_suspended
     *
     * @return self
     */
    public function setIsSuspended($is_suspended)
    {

        if (is_null($is_suspended)) {
            throw new \InvalidArgumentException('non-nullable is_suspended cannot be null');
        }

        $this->container['is_suspended'] = $is_suspended;

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
     * Gets register_date
     *
     * @return string|null
     */
    public function getRegisterDate()
    {
        return $this->container['register_date'];
    }

    /**
     * Sets register_date
     *
     * @param string|null $register_date Tripletex account register Date
     *
     * @return self
     */
    public function setRegisterDate($register_date)
    {

        if (is_null($register_date)) {
            throw new \InvalidArgumentException('non-nullable register_date cannot be null');
        }

        $this->container['register_date'] = $register_date;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string|null
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string|null $start_date Tripletex account start Date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {

        if (is_null($start_date)) {
            throw new \InvalidArgumentException('non-nullable start_date cannot be null');
        }

        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string|null $end_date Tripletex account end Date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {

        if (is_null($end_date)) {
            throw new \InvalidArgumentException('non-nullable end_date cannot be null');
        }

        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets active_main_module
     *
     * @return string|null
     */
    public function getActiveMainModule()
    {
        return $this->container['active_main_module'];
    }

    /**
     * Sets active_main_module
     *
     * @param string|null $active_main_module Active main module
     *
     * @return self
     */
    public function setActiveMainModule($active_main_module)
    {
        $allowedValues = $this->getActiveMainModuleAllowableValues();
        if (!is_null($active_main_module) && !in_array($active_main_module, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'active_main_module', must be one of '%s'",
                    $active_main_module,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($active_main_module)) {
            throw new \InvalidArgumentException('non-nullable active_main_module cannot be null');
        }

        $this->container['active_main_module'] = $active_main_module;

        return $this;
    }

    /**
     * Gets sales_force_opportunity_dto
     *
     * @return \Learnist\Tripletex\Model\SalesForceOpportunity|null
     */
    public function getSalesForceOpportunityDto()
    {
        return $this->container['sales_force_opportunity_dto'];
    }

    /**
     * Sets sales_force_opportunity_dto
     *
     * @param \Learnist\Tripletex\Model\SalesForceOpportunity|null $sales_force_opportunity_dto sales_force_opportunity_dto
     *
     * @return self
     */
    public function setSalesForceOpportunityDto($sales_force_opportunity_dto)
    {

        if (is_null($sales_force_opportunity_dto)) {
            throw new \InvalidArgumentException('non-nullable sales_force_opportunity_dto cannot be null');
        }

        $this->container['sales_force_opportunity_dto'] = $sales_force_opportunity_dto;

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


