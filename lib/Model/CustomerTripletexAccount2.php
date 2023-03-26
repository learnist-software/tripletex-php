<?php
/**
 * CustomerTripletexAccount2
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
 * CustomerTripletexAccount2 Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CustomerTripletexAccount2 implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CustomerTripletexAccount2';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'administrator' => '\Learnist\Tripletex\Model\Employee',
        'customer_id' => 'int',
        'account_type' => 'string',
        'access_request_type' => 'string',
        'modules' => '\Learnist\Tripletex\Model\SalesModuleDTO[]',
        'type' => 'string',
        'send_emails' => 'bool',
        'auto_validate_user_login' => 'bool',
        'create_api_token' => 'bool',
        'send_invoice_to_customer' => 'bool',
        'customer_invoice_email' => 'string',
        'creator_receiving_receipt' => 'bool',
        'number_of_employees' => 'int',
        'administrator_password' => 'string',
        'chart_of_accounts_type' => 'string',
        'vat_status_type' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'administrator' => null,
        'customer_id' => 'int32',
        'account_type' => null,
        'access_request_type' => null,
        'modules' => null,
        'type' => null,
        'send_emails' => null,
        'auto_validate_user_login' => null,
        'create_api_token' => null,
        'send_invoice_to_customer' => null,
        'customer_invoice_email' => null,
        'creator_receiving_receipt' => null,
        'number_of_employees' => 'int32',
        'administrator_password' => null,
        'chart_of_accounts_type' => null,
        'vat_status_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'administrator' => false,
		'customer_id' => false,
		'account_type' => false,
		'access_request_type' => false,
		'modules' => false,
		'type' => false,
		'send_emails' => false,
		'auto_validate_user_login' => false,
		'create_api_token' => false,
		'send_invoice_to_customer' => false,
		'customer_invoice_email' => false,
		'creator_receiving_receipt' => false,
		'number_of_employees' => false,
		'administrator_password' => false,
		'chart_of_accounts_type' => false,
		'vat_status_type' => false
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
        'administrator' => 'administrator',
        'customer_id' => 'customerId',
        'account_type' => 'accountType',
        'access_request_type' => 'accessRequestType',
        'modules' => 'modules',
        'type' => 'type',
        'send_emails' => 'sendEmails',
        'auto_validate_user_login' => 'autoValidateUserLogin',
        'create_api_token' => 'createApiToken',
        'send_invoice_to_customer' => 'sendInvoiceToCustomer',
        'customer_invoice_email' => 'customerInvoiceEmail',
        'creator_receiving_receipt' => 'creatorReceivingReceipt',
        'number_of_employees' => 'numberOfEmployees',
        'administrator_password' => 'administratorPassword',
        'chart_of_accounts_type' => 'chartOfAccountsType',
        'vat_status_type' => 'vatStatusType'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'administrator' => 'setAdministrator',
        'customer_id' => 'setCustomerId',
        'account_type' => 'setAccountType',
        'access_request_type' => 'setAccessRequestType',
        'modules' => 'setModules',
        'type' => 'setType',
        'send_emails' => 'setSendEmails',
        'auto_validate_user_login' => 'setAutoValidateUserLogin',
        'create_api_token' => 'setCreateApiToken',
        'send_invoice_to_customer' => 'setSendInvoiceToCustomer',
        'customer_invoice_email' => 'setCustomerInvoiceEmail',
        'creator_receiving_receipt' => 'setCreatorReceivingReceipt',
        'number_of_employees' => 'setNumberOfEmployees',
        'administrator_password' => 'setAdministratorPassword',
        'chart_of_accounts_type' => 'setChartOfAccountsType',
        'vat_status_type' => 'setVatStatusType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'administrator' => 'getAdministrator',
        'customer_id' => 'getCustomerId',
        'account_type' => 'getAccountType',
        'access_request_type' => 'getAccessRequestType',
        'modules' => 'getModules',
        'type' => 'getType',
        'send_emails' => 'getSendEmails',
        'auto_validate_user_login' => 'getAutoValidateUserLogin',
        'create_api_token' => 'getCreateApiToken',
        'send_invoice_to_customer' => 'getSendInvoiceToCustomer',
        'customer_invoice_email' => 'getCustomerInvoiceEmail',
        'creator_receiving_receipt' => 'getCreatorReceivingReceipt',
        'number_of_employees' => 'getNumberOfEmployees',
        'administrator_password' => 'getAdministratorPassword',
        'chart_of_accounts_type' => 'getChartOfAccountsType',
        'vat_status_type' => 'getVatStatusType'
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

    public const ACCOUNT_TYPE_TEST = 'TEST';
    public const ACCOUNT_TYPE_PAYING = 'PAYING';
    public const ACCOUNT_TYPE_FREE = 'FREE';
    public const ACCESS_REQUEST_TYPE__DEFAULT = 'DEFAULT';
    public const ACCESS_REQUEST_TYPE_ACCOUNTANT = 'ACCOUNTANT';
    public const ACCESS_REQUEST_TYPE_AUDITOR = 'AUDITOR';
    public const TYPE_NONE = 'NONE';
    public const TYPE_ENK = 'ENK';
    public const TYPE__AS = 'AS';
    public const TYPE_NUF = 'NUF';
    public const TYPE_ANS = 'ANS';
    public const TYPE_DA = 'DA';
    public const TYPE_PRE = 'PRE';
    public const TYPE_KS = 'KS';
    public const TYPE_ASA = 'ASA';
    public const TYPE_BBL = 'BBL';
    public const TYPE_BRL = 'BRL';
    public const TYPE_GFS = 'GFS';
    public const TYPE_SPA = 'SPA';
    public const TYPE_SF = 'SF';
    public const TYPE_IKS = 'IKS';
    public const TYPE_KF_FKF = 'KF_FKF';
    public const TYPE_FCD = 'FCD';
    public const TYPE_EOFG = 'EOFG';
    public const TYPE_BA = 'BA';
    public const TYPE_STI = 'STI';
    public const TYPE_ORG = 'ORG';
    public const TYPE_ESEK = 'ESEK';
    public const TYPE_SA = 'SA';
    public const TYPE_SAM = 'SAM';
    public const TYPE_BO = 'BO';
    public const TYPE_VPFO = 'VPFO';
    public const TYPE_OS = 'OS';
    public const TYPE_FLI = 'FLI';
    public const TYPE_OTHER = 'Other';
    public const CHART_OF_ACCOUNTS_TYPE__DEFAULT = 'DEFAULT';
    public const CHART_OF_ACCOUNTS_TYPE_MAMUT_STD_PAYROLL = 'MAMUT_STD_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_MAMUT_NARF_PAYROLL = 'MAMUT_NARF_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_FORRETNING_PAYROLL = 'AGRO_FORRETNING_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_LANDBRUK_PAYROLL = 'AGRO_LANDBRUK_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_FISKE_PAYROLL = 'AGRO_FISKE_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_FORSOKSRING_PAYROLL = 'AGRO_FORSOKSRING_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_IDRETTSLAG_PAYROLL = 'AGRO_IDRETTSLAG_PAYROLL';
    public const CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL = 'AGRO_FORENING_PAYROLL';
    public const VAT_STATUS_TYPE_REGISTERED = 'VAT_REGISTERED';
    public const VAT_STATUS_TYPE_NOT_REGISTERED = 'VAT_NOT_REGISTERED';
    public const VAT_STATUS_TYPE_APPLICANT = 'VAT_APPLICANT';

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
            self::ACCOUNT_TYPE_FREE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccessRequestTypeAllowableValues()
    {
        return [
            self::ACCESS_REQUEST_TYPE__DEFAULT,
            self::ACCESS_REQUEST_TYPE_ACCOUNTANT,
            self::ACCESS_REQUEST_TYPE_AUDITOR,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_NONE,
            self::TYPE_ENK,
            self::TYPE__AS,
            self::TYPE_NUF,
            self::TYPE_ANS,
            self::TYPE_DA,
            self::TYPE_PRE,
            self::TYPE_KS,
            self::TYPE_ASA,
            self::TYPE_BBL,
            self::TYPE_BRL,
            self::TYPE_GFS,
            self::TYPE_SPA,
            self::TYPE_SF,
            self::TYPE_IKS,
            self::TYPE_KF_FKF,
            self::TYPE_FCD,
            self::TYPE_EOFG,
            self::TYPE_BA,
            self::TYPE_STI,
            self::TYPE_ORG,
            self::TYPE_ESEK,
            self::TYPE_SA,
            self::TYPE_SAM,
            self::TYPE_BO,
            self::TYPE_VPFO,
            self::TYPE_OS,
            self::TYPE_FLI,
            self::TYPE_OTHER,
        ];
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
            self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL,
        ];
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
            self::VAT_STATUS_TYPE_APPLICANT,
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
        $this->setIfExists('administrator', $data ?? [], null);
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('account_type', $data ?? [], null);
        $this->setIfExists('access_request_type', $data ?? [], null);
        $this->setIfExists('modules', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('send_emails', $data ?? [], null);
        $this->setIfExists('auto_validate_user_login', $data ?? [], null);
        $this->setIfExists('create_api_token', $data ?? [], null);
        $this->setIfExists('send_invoice_to_customer', $data ?? [], null);
        $this->setIfExists('customer_invoice_email', $data ?? [], null);
        $this->setIfExists('creator_receiving_receipt', $data ?? [], null);
        $this->setIfExists('number_of_employees', $data ?? [], null);
        $this->setIfExists('administrator_password', $data ?? [], null);
        $this->setIfExists('chart_of_accounts_type', $data ?? [], null);
        $this->setIfExists('vat_status_type', $data ?? [], null);
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

        if ($this->container['account_type'] === null) {
            $invalidProperties[] = "'account_type' can't be null";
        }
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($this->container['account_type']) && !in_array($this->container['account_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'account_type', must be one of '%s'",
                $this->container['account_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAccessRequestTypeAllowableValues();
        if (!is_null($this->container['access_request_type']) && !in_array($this->container['access_request_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'access_request_type', must be one of '%s'",
                $this->container['access_request_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['modules'] === null) {
            $invalidProperties[] = "'modules' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['number_of_employees']) && ($this->container['number_of_employees'] < 0)) {
            $invalidProperties[] = "invalid value for 'number_of_employees', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!is_null($this->container['chart_of_accounts_type']) && !in_array($this->container['chart_of_accounts_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'chart_of_accounts_type', must be one of '%s'",
                $this->container['chart_of_accounts_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVatStatusTypeAllowableValues();
        if (!is_null($this->container['vat_status_type']) && !in_array($this->container['vat_status_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'vat_status_type', must be one of '%s'",
                $this->container['vat_status_type'],
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
     * Gets administrator
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getAdministrator()
    {
        return $this->container['administrator'];
    }

    /**
     * Sets administrator
     *
     * @param \Learnist\Tripletex\Model\Employee|null $administrator administrator
     *
     * @return self
     */
    public function setAdministrator($administrator)
    {
        if (is_null($administrator)) {
            throw new \InvalidArgumentException('non-nullable administrator cannot be null');
        }
        $this->container['administrator'] = $administrator;

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
     * @param int|null $customer_id The customer id to an already created customer to create a Tripletex account for.
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
     * @param string $account_type account_type
     *
     * @return self
     */
    public function setAccountType($account_type)
    {
        if (is_null($account_type)) {
            throw new \InvalidArgumentException('non-nullable account_type cannot be null');
        }
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!in_array($account_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'account_type', must be one of '%s'",
                    $account_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets access_request_type
     *
     * @return string|null
     */
    public function getAccessRequestType()
    {
        return $this->container['access_request_type'];
    }

    /**
     * Sets access_request_type
     *
     * @param string|null $access_request_type If the accounting office is both an accounatant and an auditor
     *
     * @return self
     */
    public function setAccessRequestType($access_request_type)
    {
        if (is_null($access_request_type)) {
            throw new \InvalidArgumentException('non-nullable access_request_type cannot be null');
        }
        $allowedValues = $this->getAccessRequestTypeAllowableValues();
        if (!in_array($access_request_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'access_request_type', must be one of '%s'",
                    $access_request_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['access_request_type'] = $access_request_type;

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
     * @param \Learnist\Tripletex\Model\SalesModuleDTO[] $modules modules
     *
     * @return self
     */
    public function setModules($modules)
    {
        if (is_null($modules)) {
            throw new \InvalidArgumentException('non-nullable modules cannot be null');
        }
        $this->container['modules'] = $modules;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets send_emails
     *
     * @return bool|null
     */
    public function getSendEmails()
    {
        return $this->container['send_emails'];
    }

    /**
     * Sets send_emails
     *
     * @param bool|null $send_emails Should the emails normally sent during creation be sent in this case?
     *
     * @return self
     */
    public function setSendEmails($send_emails)
    {
        if (is_null($send_emails)) {
            throw new \InvalidArgumentException('non-nullable send_emails cannot be null');
        }
        $this->container['send_emails'] = $send_emails;

        return $this;
    }

    /**
     * Gets auto_validate_user_login
     *
     * @return bool|null
     */
    public function getAutoValidateUserLogin()
    {
        return $this->container['auto_validate_user_login'];
    }

    /**
     * Sets auto_validate_user_login
     *
     * @param bool|null $auto_validate_user_login Should the user be automatically validated?
     *
     * @return self
     */
    public function setAutoValidateUserLogin($auto_validate_user_login)
    {
        if (is_null($auto_validate_user_login)) {
            throw new \InvalidArgumentException('non-nullable auto_validate_user_login cannot be null');
        }
        $this->container['auto_validate_user_login'] = $auto_validate_user_login;

        return $this;
    }

    /**
     * Gets create_api_token
     *
     * @return bool|null
     */
    public function getCreateApiToken()
    {
        return $this->container['create_api_token'];
    }

    /**
     * Sets create_api_token
     *
     * @param bool|null $create_api_token Creates a token for the admin user. The accounting office could also use their tokens so you might not need this.
     *
     * @return self
     */
    public function setCreateApiToken($create_api_token)
    {
        if (is_null($create_api_token)) {
            throw new \InvalidArgumentException('non-nullable create_api_token cannot be null');
        }
        $this->container['create_api_token'] = $create_api_token;

        return $this;
    }

    /**
     * Gets send_invoice_to_customer
     *
     * @return bool|null
     */
    public function getSendInvoiceToCustomer()
    {
        return $this->container['send_invoice_to_customer'];
    }

    /**
     * Sets send_invoice_to_customer
     *
     * @param bool|null $send_invoice_to_customer Should the invoices for this account be sent to the customer?
     *
     * @return self
     */
    public function setSendInvoiceToCustomer($send_invoice_to_customer)
    {
        if (is_null($send_invoice_to_customer)) {
            throw new \InvalidArgumentException('non-nullable send_invoice_to_customer cannot be null');
        }
        $this->container['send_invoice_to_customer'] = $send_invoice_to_customer;

        return $this;
    }

    /**
     * Gets customer_invoice_email
     *
     * @return string|null
     */
    public function getCustomerInvoiceEmail()
    {
        return $this->container['customer_invoice_email'];
    }

    /**
     * Sets customer_invoice_email
     *
     * @param string|null $customer_invoice_email The address to send the invoice to at the customer.
     *
     * @return self
     */
    public function setCustomerInvoiceEmail($customer_invoice_email)
    {
        if (is_null($customer_invoice_email)) {
            throw new \InvalidArgumentException('non-nullable customer_invoice_email cannot be null');
        }
        $this->container['customer_invoice_email'] = $customer_invoice_email;

        return $this;
    }

    /**
     * Gets creator_receiving_receipt
     *
     * @return bool|null
     */
    public function getCreatorReceivingReceipt()
    {
        return $this->container['creator_receiving_receipt'];
    }

    /**
     * Sets creator_receiving_receipt
     *
     * @param bool|null $creator_receiving_receipt Should the receipt for this order be sent to the user creating the account?
     *
     * @return self
     */
    public function setCreatorReceivingReceipt($creator_receiving_receipt)
    {
        if (is_null($creator_receiving_receipt)) {
            throw new \InvalidArgumentException('non-nullable creator_receiving_receipt cannot be null');
        }
        $this->container['creator_receiving_receipt'] = $creator_receiving_receipt;

        return $this;
    }

    /**
     * Gets number_of_employees
     *
     * @return int|null
     */
    public function getNumberOfEmployees()
    {
        return $this->container['number_of_employees'];
    }

    /**
     * Sets number_of_employees
     *
     * @param int|null $number_of_employees The number of employees in the customer company. Is used for calculating prices and setting some default settings, i.e. approval settings for timesheet.
     *
     * @return self
     */
    public function setNumberOfEmployees($number_of_employees)
    {
        if (is_null($number_of_employees)) {
            throw new \InvalidArgumentException('non-nullable number_of_employees cannot be null');
        }

        if (($number_of_employees < 0)) {
            throw new \InvalidArgumentException('invalid value for $number_of_employees when calling CustomerTripletexAccount2., must be bigger than or equal to 0.');
        }

        $this->container['number_of_employees'] = $number_of_employees;

        return $this;
    }

    /**
     * Gets administrator_password
     *
     * @return string|null
     */
    public function getAdministratorPassword()
    {
        return $this->container['administrator_password'];
    }

    /**
     * Sets administrator_password
     *
     * @param string|null $administrator_password The password of the administrator user.
     *
     * @return self
     */
    public function setAdministratorPassword($administrator_password)
    {
        if (is_null($administrator_password)) {
            throw new \InvalidArgumentException('non-nullable administrator_password cannot be null');
        }
        $this->container['administrator_password'] = $administrator_password;

        return $this;
    }

    /**
     * Gets chart_of_accounts_type
     *
     * @return string|null
     */
    public function getChartOfAccountsType()
    {
        return $this->container['chart_of_accounts_type'];
    }

    /**
     * Sets chart_of_accounts_type
     *
     * @param string|null $chart_of_accounts_type The chart of accounts to use for the new company
     *
     * @return self
     */
    public function setChartOfAccountsType($chart_of_accounts_type)
    {
        if (is_null($chart_of_accounts_type)) {
            throw new \InvalidArgumentException('non-nullable chart_of_accounts_type cannot be null');
        }
        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!in_array($chart_of_accounts_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'chart_of_accounts_type', must be one of '%s'",
                    $chart_of_accounts_type,
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
     * @return string|null
     */
    public function getVatStatusType()
    {
        return $this->container['vat_status_type'];
    }

    /**
     * Sets vat_status_type
     *
     * @param string|null $vat_status_type VAT type
     *
     * @return self
     */
    public function setVatStatusType($vat_status_type)
    {
        if (is_null($vat_status_type)) {
            throw new \InvalidArgumentException('non-nullable vat_status_type cannot be null');
        }
        $allowedValues = $this->getVatStatusTypeAllowableValues();
        if (!in_array($vat_status_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'vat_status_type', must be one of '%s'",
                    $vat_status_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['vat_status_type'] = $vat_status_type;

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


