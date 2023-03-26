<?php
/**
 * TripletexAccount
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
 * TripletexAccount Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TripletexAccount implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TripletexAccount';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'company' => '\Learnist\Tripletex\Model\Company',
'administrator' => '\Learnist\Tripletex\Model\Employee',
'account_type' => 'string',
'modules' => '\Learnist\Tripletex\Model\SalesModuleDTO[]',
'administrator_password' => 'string',
'send_emails' => 'bool',
'auto_validate_user_login' => 'bool',
'create_administrator_api_token' => 'bool',
'create_company_owned_api_token' => 'bool',
'may_create_tripletex_accounts' => 'bool',
'number_of_vouchers' => 'string',
'chart_of_accounts_type' => 'string',
'vat_status_type' => 'string',
'bank_account' => 'string',
'post_account' => 'string',
'number_of_prepaid_users' => 'int',
'customer_category_id2' => 'int',
'marketing_consent' => 'string',
'invoice_start_date' => 'string',
'invoice_email' => 'string',
'customer_card_id' => 'int',
'signed_tc' => 'string',
'auditor' => 'bool',
'reseller' => 'bool',
'accounting_office' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'company' => null,
'administrator' => null,
'account_type' => null,
'modules' => null,
'administrator_password' => null,
'send_emails' => null,
'auto_validate_user_login' => null,
'create_administrator_api_token' => null,
'create_company_owned_api_token' => null,
'may_create_tripletex_accounts' => null,
'number_of_vouchers' => null,
'chart_of_accounts_type' => null,
'vat_status_type' => null,
'bank_account' => null,
'post_account' => null,
'number_of_prepaid_users' => 'int32',
'customer_category_id2' => 'int32',
'marketing_consent' => null,
'invoice_start_date' => null,
'invoice_email' => null,
'customer_card_id' => 'int32',
'signed_tc' => null,
'auditor' => null,
'reseller' => null,
'accounting_office' => null    ];

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
        'company' => 'company',
'administrator' => 'administrator',
'account_type' => 'accountType',
'modules' => 'modules',
'administrator_password' => 'administratorPassword',
'send_emails' => 'sendEmails',
'auto_validate_user_login' => 'autoValidateUserLogin',
'create_administrator_api_token' => 'createAdministratorApiToken',
'create_company_owned_api_token' => 'createCompanyOwnedApiToken',
'may_create_tripletex_accounts' => 'mayCreateTripletexAccounts',
'number_of_vouchers' => 'numberOfVouchers',
'chart_of_accounts_type' => 'chartOfAccountsType',
'vat_status_type' => 'vatStatusType',
'bank_account' => 'bankAccount',
'post_account' => 'postAccount',
'number_of_prepaid_users' => 'numberOfPrepaidUsers',
'customer_category_id2' => 'customerCategoryId2',
'marketing_consent' => 'marketingConsent',
'invoice_start_date' => 'invoiceStartDate',
'invoice_email' => 'invoiceEmail',
'customer_card_id' => 'customerCardId',
'signed_tc' => 'signedTC',
'auditor' => 'auditor',
'reseller' => 'reseller',
'accounting_office' => 'accountingOffice'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'company' => 'setCompany',
'administrator' => 'setAdministrator',
'account_type' => 'setAccountType',
'modules' => 'setModules',
'administrator_password' => 'setAdministratorPassword',
'send_emails' => 'setSendEmails',
'auto_validate_user_login' => 'setAutoValidateUserLogin',
'create_administrator_api_token' => 'setCreateAdministratorApiToken',
'create_company_owned_api_token' => 'setCreateCompanyOwnedApiToken',
'may_create_tripletex_accounts' => 'setMayCreateTripletexAccounts',
'number_of_vouchers' => 'setNumberOfVouchers',
'chart_of_accounts_type' => 'setChartOfAccountsType',
'vat_status_type' => 'setVatStatusType',
'bank_account' => 'setBankAccount',
'post_account' => 'setPostAccount',
'number_of_prepaid_users' => 'setNumberOfPrepaidUsers',
'customer_category_id2' => 'setCustomerCategoryId2',
'marketing_consent' => 'setMarketingConsent',
'invoice_start_date' => 'setInvoiceStartDate',
'invoice_email' => 'setInvoiceEmail',
'customer_card_id' => 'setCustomerCardId',
'signed_tc' => 'setSignedTc',
'auditor' => 'setAuditor',
'reseller' => 'setReseller',
'accounting_office' => 'setAccountingOffice'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'company' => 'getCompany',
'administrator' => 'getAdministrator',
'account_type' => 'getAccountType',
'modules' => 'getModules',
'administrator_password' => 'getAdministratorPassword',
'send_emails' => 'getSendEmails',
'auto_validate_user_login' => 'getAutoValidateUserLogin',
'create_administrator_api_token' => 'getCreateAdministratorApiToken',
'create_company_owned_api_token' => 'getCreateCompanyOwnedApiToken',
'may_create_tripletex_accounts' => 'getMayCreateTripletexAccounts',
'number_of_vouchers' => 'getNumberOfVouchers',
'chart_of_accounts_type' => 'getChartOfAccountsType',
'vat_status_type' => 'getVatStatusType',
'bank_account' => 'getBankAccount',
'post_account' => 'getPostAccount',
'number_of_prepaid_users' => 'getNumberOfPrepaidUsers',
'customer_category_id2' => 'getCustomerCategoryId2',
'marketing_consent' => 'getMarketingConsent',
'invoice_start_date' => 'getInvoiceStartDate',
'invoice_email' => 'getInvoiceEmail',
'customer_card_id' => 'getCustomerCardId',
'signed_tc' => 'getSignedTc',
'auditor' => 'getAuditor',
'reseller' => 'getReseller',
'accounting_office' => 'getAccountingOffice'    ];

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

    const ACCOUNT_TYPE_TEST = 'TEST';
const ACCOUNT_TYPE_PAYING = 'PAYING';
const ACCOUNT_TYPE_FREE = 'FREE';
const NUMBER_OF_VOUCHERS__0_100 = 'INTERVAL_0_100';
const NUMBER_OF_VOUCHERS__101_500 = 'INTERVAL_101_500';
const NUMBER_OF_VOUCHERS__0_500 = 'INTERVAL_0_500';
const NUMBER_OF_VOUCHERS__501_1000 = 'INTERVAL_501_1000';
const NUMBER_OF_VOUCHERS__1001_2000 = 'INTERVAL_1001_2000';
const NUMBER_OF_VOUCHERS__2001_3500 = 'INTERVAL_2001_3500';
const NUMBER_OF_VOUCHERS__3501_5000 = 'INTERVAL_3501_5000';
const NUMBER_OF_VOUCHERS__5001_10000 = 'INTERVAL_5001_10000';
const NUMBER_OF_VOUCHERS_UNLIMITED = 'INTERVAL_UNLIMITED';
const CHART_OF_ACCOUNTS_TYPE__DEFAULT = 'DEFAULT';
const CHART_OF_ACCOUNTS_TYPE_MAMUT_STD_PAYROLL = 'MAMUT_STD_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_MAMUT_NARF_PAYROLL = 'MAMUT_NARF_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORRETNING_PAYROLL = 'AGRO_FORRETNING_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_LANDBRUK_PAYROLL = 'AGRO_LANDBRUK_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FISKE_PAYROLL = 'AGRO_FISKE_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORSOKSRING_PAYROLL = 'AGRO_FORSOKSRING_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_IDRETTSLAG_PAYROLL = 'AGRO_IDRETTSLAG_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL = 'AGRO_FORENING_PAYROLL';
const VAT_STATUS_TYPE_REGISTERED = 'VAT_REGISTERED';
const VAT_STATUS_TYPE_NOT_REGISTERED = 'VAT_NOT_REGISTERED';
const VAT_STATUS_TYPE_APPLICANT = 'VAT_APPLICANT';
const MARKETING_CONSENT__DEFAULT = 'DEFAULT';
const MARKETING_CONSENT_GRANTED = 'GRANTED';
const MARKETING_CONSENT_DENIED = 'DENIED';
const SIGNED_TC__DEFAULT = 'DEFAULT';
const SIGNED_TC_GRANTED = 'GRANTED';
const SIGNED_TC_DENIED = 'DENIED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccountTypeAllowableValues()
    {
        return [
            self::ACCOUNT_TYPE_TEST,
self::ACCOUNT_TYPE_PAYING,
self::ACCOUNT_TYPE_FREE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNumberOfVouchersAllowableValues()
    {
        return [
            self::NUMBER_OF_VOUCHERS__0_100,
self::NUMBER_OF_VOUCHERS__101_500,
self::NUMBER_OF_VOUCHERS__0_500,
self::NUMBER_OF_VOUCHERS__501_1000,
self::NUMBER_OF_VOUCHERS__1001_2000,
self::NUMBER_OF_VOUCHERS__2001_3500,
self::NUMBER_OF_VOUCHERS__3501_5000,
self::NUMBER_OF_VOUCHERS__5001_10000,
self::NUMBER_OF_VOUCHERS_UNLIMITED,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getChartOfAccountsTypeAllowableValues()
    {
        return [
            self::CHART_OF_ACCOUNTS_TYPE__DEFAULT,
self::CHART_OF_ACCOUNTS_TYPE_MAMUT_STD_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_MAMUT_NARF_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORRETNING_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_LANDBRUK_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FISKE_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORSOKSRING_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_IDRETTSLAG_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVatStatusTypeAllowableValues()
    {
        return [
            self::VAT_STATUS_TYPE_REGISTERED,
self::VAT_STATUS_TYPE_NOT_REGISTERED,
self::VAT_STATUS_TYPE_APPLICANT,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMarketingConsentAllowableValues()
    {
        return [
            self::MARKETING_CONSENT__DEFAULT,
self::MARKETING_CONSENT_GRANTED,
self::MARKETING_CONSENT_DENIED,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSignedTcAllowableValues()
    {
        return [
            self::SIGNED_TC__DEFAULT,
self::SIGNED_TC_GRANTED,
self::SIGNED_TC_DENIED,        ];
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
        $this->container['company'] = isset($data['company']) ? $data['company'] : null;
        $this->container['administrator'] = isset($data['administrator']) ? $data['administrator'] : null;
        $this->container['account_type'] = isset($data['account_type']) ? $data['account_type'] : null;
        $this->container['modules'] = isset($data['modules']) ? $data['modules'] : null;
        $this->container['administrator_password'] = isset($data['administrator_password']) ? $data['administrator_password'] : null;
        $this->container['send_emails'] = isset($data['send_emails']) ? $data['send_emails'] : null;
        $this->container['auto_validate_user_login'] = isset($data['auto_validate_user_login']) ? $data['auto_validate_user_login'] : null;
        $this->container['create_administrator_api_token'] = isset($data['create_administrator_api_token']) ? $data['create_administrator_api_token'] : null;
        $this->container['create_company_owned_api_token'] = isset($data['create_company_owned_api_token']) ? $data['create_company_owned_api_token'] : null;
        $this->container['may_create_tripletex_accounts'] = isset($data['may_create_tripletex_accounts']) ? $data['may_create_tripletex_accounts'] : null;
        $this->container['number_of_vouchers'] = isset($data['number_of_vouchers']) ? $data['number_of_vouchers'] : null;
        $this->container['chart_of_accounts_type'] = isset($data['chart_of_accounts_type']) ? $data['chart_of_accounts_type'] : null;
        $this->container['vat_status_type'] = isset($data['vat_status_type']) ? $data['vat_status_type'] : null;
        $this->container['bank_account'] = isset($data['bank_account']) ? $data['bank_account'] : null;
        $this->container['post_account'] = isset($data['post_account']) ? $data['post_account'] : null;
        $this->container['number_of_prepaid_users'] = isset($data['number_of_prepaid_users']) ? $data['number_of_prepaid_users'] : null;
        $this->container['customer_category_id2'] = isset($data['customer_category_id2']) ? $data['customer_category_id2'] : null;
        $this->container['marketing_consent'] = isset($data['marketing_consent']) ? $data['marketing_consent'] : null;
        $this->container['invoice_start_date'] = isset($data['invoice_start_date']) ? $data['invoice_start_date'] : null;
        $this->container['invoice_email'] = isset($data['invoice_email']) ? $data['invoice_email'] : null;
        $this->container['customer_card_id'] = isset($data['customer_card_id']) ? $data['customer_card_id'] : null;
        $this->container['signed_tc'] = isset($data['signed_tc']) ? $data['signed_tc'] : null;
        $this->container['auditor'] = isset($data['auditor']) ? $data['auditor'] : null;
        $this->container['reseller'] = isset($data['reseller']) ? $data['reseller'] : null;
        $this->container['accounting_office'] = isset($data['accounting_office']) ? $data['accounting_office'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['account_type'] === null) {
            $invalidProperties[] = "'account_type' can't be null";
        }
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($this->container['account_type']) && !in_array($this->container['account_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'account_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['modules'] === null) {
            $invalidProperties[] = "'modules' can't be null";
        }
        $allowedValues = $this->getNumberOfVouchersAllowableValues();
        if (!is_null($this->container['number_of_vouchers']) && !in_array($this->container['number_of_vouchers'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'number_of_vouchers', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!is_null($this->container['chart_of_accounts_type']) && !in_array($this->container['chart_of_accounts_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'chart_of_accounts_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVatStatusTypeAllowableValues();
        if (!is_null($this->container['vat_status_type']) && !in_array($this->container['vat_status_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'vat_status_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getMarketingConsentAllowableValues();
        if (!is_null($this->container['marketing_consent']) && !in_array($this->container['marketing_consent'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'marketing_consent', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSignedTcAllowableValues();
        if (!is_null($this->container['signed_tc']) && !in_array($this->container['signed_tc'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'signed_tc', must be one of '%s'",
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
     * Gets company
     *
     * @return \Learnist\Tripletex\Model\Company
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param \Learnist\Tripletex\Model\Company $company company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->container['company'] = $company;

        return $this;
    }

    /**
     * Gets administrator
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getAdministrator()
    {
        return $this->container['administrator'];
    }

    /**
     * Sets administrator
     *
     * @param \Learnist\Tripletex\Model\Employee $administrator administrator
     *
     * @return $this
     */
    public function setAdministrator($administrator)
    {
        $this->container['administrator'] = $administrator;

        return $this;
    }

    /**
     * Gets account_type
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type
     *
     * @param string $account_type Is this a test account or a paying account?
     *
     * @return $this
     */
    public function setAccountType($account_type)
    {
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!in_array($account_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'account_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets modules
     *
     * @return \Learnist\Tripletex\Model\SalesModuleDTO[]
     */
    public function getModules()
    {
        return $this->container['modules'];
    }

    /**
     * Sets modules
     *
     * @param \Learnist\Tripletex\Model\SalesModuleDTO[] $modules Sales modules (functionality in the application) to activate for the newly created account. Some modules have extra costs.
     *
     * @return $this
     */
    public function setModules($modules)
    {
        $this->container['modules'] = $modules;

        return $this;
    }

    /**
     * Gets administrator_password
     *
     * @return string
     */
    public function getAdministratorPassword()
    {
        return $this->container['administrator_password'];
    }

    /**
     * Sets administrator_password
     *
     * @param string $administrator_password Password for the administrator user to create. Not a part of the administrator employee object since this is a value that never can be read (it is salted and hashed before storing)
     *
     * @return $this
     */
    public function setAdministratorPassword($administrator_password)
    {
        $this->container['administrator_password'] = $administrator_password;

        return $this;
    }

    /**
     * Gets send_emails
     *
     * @return bool
     */
    public function getSendEmails()
    {
        return $this->container['send_emails'];
    }

    /**
     * Sets send_emails
     *
     * @param bool $send_emails Should the regular creation emails be sent to the company created and its users? If false you probably want to set autoValidateUserLogin to true
     *
     * @return $this
     */
    public function setSendEmails($send_emails)
    {
        $this->container['send_emails'] = $send_emails;

        return $this;
    }

    /**
     * Gets auto_validate_user_login
     *
     * @return bool
     */
    public function getAutoValidateUserLogin()
    {
        return $this->container['auto_validate_user_login'];
    }

    /**
     * Sets auto_validate_user_login
     *
     * @param bool $auto_validate_user_login If true, the users created will be allowed to log in without validating their email address. ONLY USE THIS IF YOU ALREADY HAVE VALIDATED THE USER EMAILS.
     *
     * @return $this
     */
    public function setAutoValidateUserLogin($auto_validate_user_login)
    {
        $this->container['auto_validate_user_login'] = $auto_validate_user_login;

        return $this;
    }

    /**
     * Gets create_administrator_api_token
     *
     * @return bool
     */
    public function getCreateAdministratorApiToken()
    {
        return $this->container['create_administrator_api_token'];
    }

    /**
     * Sets create_administrator_api_token
     *
     * @param bool $create_administrator_api_token Create an API token for the administrator user for the consumer token used during this call. The token will be returned in the response.
     *
     * @return $this
     */
    public function setCreateAdministratorApiToken($create_administrator_api_token)
    {
        $this->container['create_administrator_api_token'] = $create_administrator_api_token;

        return $this;
    }

    /**
     * Gets create_company_owned_api_token
     *
     * @return bool
     */
    public function getCreateCompanyOwnedApiToken()
    {
        return $this->container['create_company_owned_api_token'];
    }

    /**
     * Sets create_company_owned_api_token
     *
     * @param bool $create_company_owned_api_token Create an API token for the company to use to call their clients, only possible for accounting and auditor accounts. The token will be returned in the response.
     *
     * @return $this
     */
    public function setCreateCompanyOwnedApiToken($create_company_owned_api_token)
    {
        $this->container['create_company_owned_api_token'] = $create_company_owned_api_token;

        return $this;
    }

    /**
     * Gets may_create_tripletex_accounts
     *
     * @return bool
     */
    public function getMayCreateTripletexAccounts()
    {
        return $this->container['may_create_tripletex_accounts'];
    }

    /**
     * Sets may_create_tripletex_accounts
     *
     * @param bool $may_create_tripletex_accounts Should the company we are creating be able to create new Tripletex accounts?
     *
     * @return $this
     */
    public function setMayCreateTripletexAccounts($may_create_tripletex_accounts)
    {
        $this->container['may_create_tripletex_accounts'] = $may_create_tripletex_accounts;

        return $this;
    }

    /**
     * Gets number_of_vouchers
     *
     * @return string
     */
    public function getNumberOfVouchers()
    {
        return $this->container['number_of_vouchers'];
    }

    /**
     * Sets number_of_vouchers
     *
     * @param string $number_of_vouchers Used to calculate prices.
     *
     * @return $this
     */
    public function setNumberOfVouchers($number_of_vouchers)
    {
        $allowedValues = $this->getNumberOfVouchersAllowableValues();
        if (!is_null($number_of_vouchers) && !in_array($number_of_vouchers, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'number_of_vouchers', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['number_of_vouchers'] = $number_of_vouchers;

        return $this;
    }

    /**
     * Gets chart_of_accounts_type
     *
     * @return string
     */
    public function getChartOfAccountsType()
    {
        return $this->container['chart_of_accounts_type'];
    }

    /**
     * Sets chart_of_accounts_type
     *
     * @param string $chart_of_accounts_type The chart of accounts to use for the new company
     *
     * @return $this
     */
    public function setChartOfAccountsType($chart_of_accounts_type)
    {
        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!is_null($chart_of_accounts_type) && !in_array($chart_of_accounts_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'chart_of_accounts_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['chart_of_accounts_type'] = $chart_of_accounts_type;

        return $this;
    }

    /**
     * Gets vat_status_type
     *
     * @return string
     */
    public function getVatStatusType()
    {
        return $this->container['vat_status_type'];
    }

    /**
     * Sets vat_status_type
     *
     * @param string $vat_status_type VAT type
     *
     * @return $this
     */
    public function setVatStatusType($vat_status_type)
    {
        $allowedValues = $this->getVatStatusTypeAllowableValues();
        if (!is_null($vat_status_type) && !in_array($vat_status_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'vat_status_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['vat_status_type'] = $vat_status_type;

        return $this;
    }

    /**
     * Gets bank_account
     *
     * @return string
     */
    public function getBankAccount()
    {
        return $this->container['bank_account'];
    }

    /**
     * Sets bank_account
     *
     * @param string $bank_account Main bank account
     *
     * @return $this
     */
    public function setBankAccount($bank_account)
    {
        $this->container['bank_account'] = $bank_account;

        return $this;
    }

    /**
     * Gets post_account
     *
     * @return string
     */
    public function getPostAccount()
    {
        return $this->container['post_account'];
    }

    /**
     * Sets post_account
     *
     * @param string $post_account Swedish post account number (PlusGirot)
     *
     * @return $this
     */
    public function setPostAccount($post_account)
    {
        $this->container['post_account'] = $post_account;

        return $this;
    }

    /**
     * Gets number_of_prepaid_users
     *
     * @return int
     */
    public function getNumberOfPrepaidUsers()
    {
        return $this->container['number_of_prepaid_users'];
    }

    /**
     * Sets number_of_prepaid_users
     *
     * @param int $number_of_prepaid_users Number of users Prepaid. Only available for some consumers.
     *
     * @return $this
     */
    public function setNumberOfPrepaidUsers($number_of_prepaid_users)
    {
        $this->container['number_of_prepaid_users'] = $number_of_prepaid_users;

        return $this;
    }

    /**
     * Gets customer_category_id2
     *
     * @return int
     */
    public function getCustomerCategoryId2()
    {
        return $this->container['customer_category_id2'];
    }

    /**
     * Sets customer_category_id2
     *
     * @param int $customer_category_id2 Customer category id used to indicate that the customer is created by Salesforce
     *
     * @return $this
     */
    public function setCustomerCategoryId2($customer_category_id2)
    {
        $this->container['customer_category_id2'] = $customer_category_id2;

        return $this;
    }

    /**
     * Gets marketing_consent
     *
     * @return string
     */
    public function getMarketingConsent()
    {
        return $this->container['marketing_consent'];
    }

    /**
     * Sets marketing_consent
     *
     * @param string $marketing_consent Marketing consent
     *
     * @return $this
     */
    public function setMarketingConsent($marketing_consent)
    {
        $allowedValues = $this->getMarketingConsentAllowableValues();
        if (!is_null($marketing_consent) && !in_array($marketing_consent, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'marketing_consent', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['marketing_consent'] = $marketing_consent;

        return $this;
    }

    /**
     * Gets invoice_start_date
     *
     * @return string
     */
    public function getInvoiceStartDate()
    {
        return $this->container['invoice_start_date'];
    }

    /**
     * Sets invoice_start_date
     *
     * @param string $invoice_start_date Start date for invoicing
     *
     * @return $this
     */
    public function setInvoiceStartDate($invoice_start_date)
    {
        $this->container['invoice_start_date'] = $invoice_start_date;

        return $this;
    }

    /**
     * Gets invoice_email
     *
     * @return string
     */
    public function getInvoiceEmail()
    {
        return $this->container['invoice_email'];
    }

    /**
     * Sets invoice_email
     *
     * @param string $invoice_email Email address used for invoices/reminders
     *
     * @return $this
     */
    public function setInvoiceEmail($invoice_email)
    {
        $this->container['invoice_email'] = $invoice_email;

        return $this;
    }

    /**
     * Gets customer_card_id
     *
     * @return int
     */
    public function getCustomerCardId()
    {
        return $this->container['customer_card_id'];
    }

    /**
     * Sets customer_card_id
     *
     * @param int $customer_card_id Customer card id is used to indicate what customer account to use when creating the TripletexCompany object. 0 means customer account does not already exist.
     *
     * @return $this
     */
    public function setCustomerCardId($customer_card_id)
    {
        $this->container['customer_card_id'] = $customer_card_id;

        return $this;
    }

    /**
     * Gets signed_tc
     *
     * @return string
     */
    public function getSignedTc()
    {
        return $this->container['signed_tc'];
    }

    /**
     * Sets signed_tc
     *
     * @param string $signed_tc Terms and conditions
     *
     * @return $this
     */
    public function setSignedTc($signed_tc)
    {
        $allowedValues = $this->getSignedTcAllowableValues();
        if (!is_null($signed_tc) && !in_array($signed_tc, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'signed_tc', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['signed_tc'] = $signed_tc;

        return $this;
    }

    /**
     * Gets auditor
     *
     * @return bool
     */
    public function getAuditor()
    {
        return $this->container['auditor'];
    }

    /**
     * Sets auditor
     *
     * @param bool $auditor auditor
     *
     * @return $this
     */
    public function setAuditor($auditor)
    {
        $this->container['auditor'] = $auditor;

        return $this;
    }

    /**
     * Gets reseller
     *
     * @return bool
     */
    public function getReseller()
    {
        return $this->container['reseller'];
    }

    /**
     * Sets reseller
     *
     * @param bool $reseller reseller
     *
     * @return $this
     */
    public function setReseller($reseller)
    {
        $this->container['reseller'] = $reseller;

        return $this;
    }

    /**
     * Gets accounting_office
     *
     * @return bool
     */
    public function getAccountingOffice()
    {
        return $this->container['accounting_office'];
    }

    /**
     * Sets accounting_office
     *
     * @param bool $accounting_office accounting_office
     *
     * @return $this
     */
    public function setAccountingOffice($accounting_office)
    {
        $this->container['accounting_office'] = $accounting_office;

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
