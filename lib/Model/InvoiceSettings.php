<?php
/**
 * InvoiceSettings
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
 * InvoiceSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class InvoiceSettings implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'InvoiceSettings';

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
'has_first_invoice_number' => 'bool',
'next_invoice_number' => 'int',
'bank_account_ready' => 'bool',
'default_send_type_b2_b' => 'string',
'default_send_type_b2_c' => 'string',
'show_backorder' => 'bool',
'set_deliver_to_available_stock' => 'bool',
'send_types' => 'string[]',
'is_automatic_soft_reminder_enabled' => 'bool',
'automatic_soft_reminder_days_after_due_date' => 'int',
'is_automatic_reminder_enabled' => 'bool',
'automatic_reminder_days_after_due_date' => 'int',
'is_automatic_notice_of_debt_collection_enabled' => 'bool',
'automatic_notice_of_debt_collection_days_after_due_date' => 'int'    ];

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
'has_first_invoice_number' => null,
'next_invoice_number' => 'int32',
'bank_account_ready' => null,
'default_send_type_b2_b' => null,
'default_send_type_b2_c' => null,
'show_backorder' => null,
'set_deliver_to_available_stock' => null,
'send_types' => null,
'is_automatic_soft_reminder_enabled' => null,
'automatic_soft_reminder_days_after_due_date' => 'int32',
'is_automatic_reminder_enabled' => null,
'automatic_reminder_days_after_due_date' => 'int32',
'is_automatic_notice_of_debt_collection_enabled' => null,
'automatic_notice_of_debt_collection_days_after_due_date' => 'int32'    ];

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
'has_first_invoice_number' => 'hasFirstInvoiceNumber',
'next_invoice_number' => 'nextInvoiceNumber',
'bank_account_ready' => 'bankAccountReady',
'default_send_type_b2_b' => 'defaultSendTypeB2B',
'default_send_type_b2_c' => 'defaultSendTypeB2C',
'show_backorder' => 'showBackorder',
'set_deliver_to_available_stock' => 'setDeliverToAvailableStock',
'send_types' => 'sendTypes',
'is_automatic_soft_reminder_enabled' => 'isAutomaticSoftReminderEnabled',
'automatic_soft_reminder_days_after_due_date' => 'automaticSoftReminderDaysAfterDueDate',
'is_automatic_reminder_enabled' => 'isAutomaticReminderEnabled',
'automatic_reminder_days_after_due_date' => 'automaticReminderDaysAfterDueDate',
'is_automatic_notice_of_debt_collection_enabled' => 'isAutomaticNoticeOfDebtCollectionEnabled',
'automatic_notice_of_debt_collection_days_after_due_date' => 'automaticNoticeOfDebtCollectionDaysAfterDueDate'    ];

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
'has_first_invoice_number' => 'setHasFirstInvoiceNumber',
'next_invoice_number' => 'setNextInvoiceNumber',
'bank_account_ready' => 'setBankAccountReady',
'default_send_type_b2_b' => 'setDefaultSendTypeB2B',
'default_send_type_b2_c' => 'setDefaultSendTypeB2C',
'show_backorder' => 'setShowBackorder',
'set_deliver_to_available_stock' => 'setSetDeliverToAvailableStock',
'send_types' => 'setSendTypes',
'is_automatic_soft_reminder_enabled' => 'setIsAutomaticSoftReminderEnabled',
'automatic_soft_reminder_days_after_due_date' => 'setAutomaticSoftReminderDaysAfterDueDate',
'is_automatic_reminder_enabled' => 'setIsAutomaticReminderEnabled',
'automatic_reminder_days_after_due_date' => 'setAutomaticReminderDaysAfterDueDate',
'is_automatic_notice_of_debt_collection_enabled' => 'setIsAutomaticNoticeOfDebtCollectionEnabled',
'automatic_notice_of_debt_collection_days_after_due_date' => 'setAutomaticNoticeOfDebtCollectionDaysAfterDueDate'    ];

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
'has_first_invoice_number' => 'getHasFirstInvoiceNumber',
'next_invoice_number' => 'getNextInvoiceNumber',
'bank_account_ready' => 'getBankAccountReady',
'default_send_type_b2_b' => 'getDefaultSendTypeB2B',
'default_send_type_b2_c' => 'getDefaultSendTypeB2C',
'show_backorder' => 'getShowBackorder',
'set_deliver_to_available_stock' => 'getSetDeliverToAvailableStock',
'send_types' => 'getSendTypes',
'is_automatic_soft_reminder_enabled' => 'getIsAutomaticSoftReminderEnabled',
'automatic_soft_reminder_days_after_due_date' => 'getAutomaticSoftReminderDaysAfterDueDate',
'is_automatic_reminder_enabled' => 'getIsAutomaticReminderEnabled',
'automatic_reminder_days_after_due_date' => 'getAutomaticReminderDaysAfterDueDate',
'is_automatic_notice_of_debt_collection_enabled' => 'getIsAutomaticNoticeOfDebtCollectionEnabled',
'automatic_notice_of_debt_collection_days_after_due_date' => 'getAutomaticNoticeOfDebtCollectionDaysAfterDueDate'    ];

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

    const DEFAULT_SEND_TYPE_B2_B_EMAIL = 'EMAIL';
const DEFAULT_SEND_TYPE_B2_B_EHF = 'EHF';
const DEFAULT_SEND_TYPE_B2_B_EFAKTURA = 'EFAKTURA';
const DEFAULT_SEND_TYPE_B2_B_AVTALEGIRO = 'AVTALEGIRO';
const DEFAULT_SEND_TYPE_B2_B_VIPPS = 'VIPPS';
const DEFAULT_SEND_TYPE_B2_B_PAPER = 'PAPER';
const DEFAULT_SEND_TYPE_B2_B_MANUAL = 'MANUAL';
const DEFAULT_SEND_TYPE_B2_B_DIRECT = 'DIRECT';
const DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_OUTBOUND = 'AUTOINVOICE_EHF_OUTBOUND';
const DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_INCOMING = 'AUTOINVOICE_EHF_INCOMING';
const DEFAULT_SEND_TYPE_B2_B_PEPPOL_EHF_INCOMING = 'PEPPOL_EHF_INCOMING';
const DEFAULT_SEND_TYPE_B2_C_EMAIL = 'EMAIL';
const DEFAULT_SEND_TYPE_B2_C_EHF = 'EHF';
const DEFAULT_SEND_TYPE_B2_C_EFAKTURA = 'EFAKTURA';
const DEFAULT_SEND_TYPE_B2_C_AVTALEGIRO = 'AVTALEGIRO';
const DEFAULT_SEND_TYPE_B2_C_VIPPS = 'VIPPS';
const DEFAULT_SEND_TYPE_B2_C_PAPER = 'PAPER';
const DEFAULT_SEND_TYPE_B2_C_MANUAL = 'MANUAL';
const DEFAULT_SEND_TYPE_B2_C_DIRECT = 'DIRECT';
const DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_OUTBOUND = 'AUTOINVOICE_EHF_OUTBOUND';
const DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_INCOMING = 'AUTOINVOICE_EHF_INCOMING';
const DEFAULT_SEND_TYPE_B2_C_PEPPOL_EHF_INCOMING = 'PEPPOL_EHF_INCOMING';
const SEND_TYPES_EMAIL = 'EMAIL';
const SEND_TYPES_EHF = 'EHF';
const SEND_TYPES_AVTALEGIRO = 'AVTALEGIRO';
const SEND_TYPES_EFAKTURA = 'EFAKTURA';
const SEND_TYPES_VIPPS = 'VIPPS';
const SEND_TYPES_PAPER = 'PAPER';
const SEND_TYPES_MANUAL = 'MANUAL';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDefaultSendTypeB2BAllowableValues()
    {
        return [
            self::DEFAULT_SEND_TYPE_B2_B_EMAIL,
self::DEFAULT_SEND_TYPE_B2_B_EHF,
self::DEFAULT_SEND_TYPE_B2_B_EFAKTURA,
self::DEFAULT_SEND_TYPE_B2_B_AVTALEGIRO,
self::DEFAULT_SEND_TYPE_B2_B_VIPPS,
self::DEFAULT_SEND_TYPE_B2_B_PAPER,
self::DEFAULT_SEND_TYPE_B2_B_MANUAL,
self::DEFAULT_SEND_TYPE_B2_B_DIRECT,
self::DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_OUTBOUND,
self::DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_INCOMING,
self::DEFAULT_SEND_TYPE_B2_B_PEPPOL_EHF_INCOMING,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDefaultSendTypeB2CAllowableValues()
    {
        return [
            self::DEFAULT_SEND_TYPE_B2_C_EMAIL,
self::DEFAULT_SEND_TYPE_B2_C_EHF,
self::DEFAULT_SEND_TYPE_B2_C_EFAKTURA,
self::DEFAULT_SEND_TYPE_B2_C_AVTALEGIRO,
self::DEFAULT_SEND_TYPE_B2_C_VIPPS,
self::DEFAULT_SEND_TYPE_B2_C_PAPER,
self::DEFAULT_SEND_TYPE_B2_C_MANUAL,
self::DEFAULT_SEND_TYPE_B2_C_DIRECT,
self::DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_OUTBOUND,
self::DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_INCOMING,
self::DEFAULT_SEND_TYPE_B2_C_PEPPOL_EHF_INCOMING,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSendTypesAllowableValues()
    {
        return [
            self::SEND_TYPES_EMAIL,
self::SEND_TYPES_EHF,
self::SEND_TYPES_AVTALEGIRO,
self::SEND_TYPES_EFAKTURA,
self::SEND_TYPES_VIPPS,
self::SEND_TYPES_PAPER,
self::SEND_TYPES_MANUAL,        ];
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
        $this->container['has_first_invoice_number'] = isset($data['has_first_invoice_number']) ? $data['has_first_invoice_number'] : null;
        $this->container['next_invoice_number'] = isset($data['next_invoice_number']) ? $data['next_invoice_number'] : null;
        $this->container['bank_account_ready'] = isset($data['bank_account_ready']) ? $data['bank_account_ready'] : null;
        $this->container['default_send_type_b2_b'] = isset($data['default_send_type_b2_b']) ? $data['default_send_type_b2_b'] : null;
        $this->container['default_send_type_b2_c'] = isset($data['default_send_type_b2_c']) ? $data['default_send_type_b2_c'] : null;
        $this->container['show_backorder'] = isset($data['show_backorder']) ? $data['show_backorder'] : null;
        $this->container['set_deliver_to_available_stock'] = isset($data['set_deliver_to_available_stock']) ? $data['set_deliver_to_available_stock'] : null;
        $this->container['send_types'] = isset($data['send_types']) ? $data['send_types'] : null;
        $this->container['is_automatic_soft_reminder_enabled'] = isset($data['is_automatic_soft_reminder_enabled']) ? $data['is_automatic_soft_reminder_enabled'] : null;
        $this->container['automatic_soft_reminder_days_after_due_date'] = isset($data['automatic_soft_reminder_days_after_due_date']) ? $data['automatic_soft_reminder_days_after_due_date'] : null;
        $this->container['is_automatic_reminder_enabled'] = isset($data['is_automatic_reminder_enabled']) ? $data['is_automatic_reminder_enabled'] : null;
        $this->container['automatic_reminder_days_after_due_date'] = isset($data['automatic_reminder_days_after_due_date']) ? $data['automatic_reminder_days_after_due_date'] : null;
        $this->container['is_automatic_notice_of_debt_collection_enabled'] = isset($data['is_automatic_notice_of_debt_collection_enabled']) ? $data['is_automatic_notice_of_debt_collection_enabled'] : null;
        $this->container['automatic_notice_of_debt_collection_days_after_due_date'] = isset($data['automatic_notice_of_debt_collection_days_after_due_date']) ? $data['automatic_notice_of_debt_collection_days_after_due_date'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getDefaultSendTypeB2BAllowableValues();
        if (!is_null($this->container['default_send_type_b2_b']) && !in_array($this->container['default_send_type_b2_b'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'default_send_type_b2_b', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDefaultSendTypeB2CAllowableValues();
        if (!is_null($this->container['default_send_type_b2_c']) && !in_array($this->container['default_send_type_b2_c'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'default_send_type_b2_c', must be one of '%s'",
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
     * Gets has_first_invoice_number
     *
     * @return bool
     */
    public function getHasFirstInvoiceNumber()
    {
        return $this->container['has_first_invoice_number'];
    }

    /**
     * Sets has_first_invoice_number
     *
     * @param bool $has_first_invoice_number has_first_invoice_number
     *
     * @return $this
     */
    public function setHasFirstInvoiceNumber($has_first_invoice_number)
    {
        $this->container['has_first_invoice_number'] = $has_first_invoice_number;

        return $this;
    }

    /**
     * Gets next_invoice_number
     *
     * @return int
     */
    public function getNextInvoiceNumber()
    {
        return $this->container['next_invoice_number'];
    }

    /**
     * Sets next_invoice_number
     *
     * @param int $next_invoice_number next_invoice_number
     *
     * @return $this
     */
    public function setNextInvoiceNumber($next_invoice_number)
    {
        $this->container['next_invoice_number'] = $next_invoice_number;

        return $this;
    }

    /**
     * Gets bank_account_ready
     *
     * @return bool
     */
    public function getBankAccountReady()
    {
        return $this->container['bank_account_ready'];
    }

    /**
     * Sets bank_account_ready
     *
     * @param bool $bank_account_ready bank_account_ready
     *
     * @return $this
     */
    public function setBankAccountReady($bank_account_ready)
    {
        $this->container['bank_account_ready'] = $bank_account_ready;

        return $this;
    }

    /**
     * Gets default_send_type_b2_b
     *
     * @return string
     */
    public function getDefaultSendTypeB2B()
    {
        return $this->container['default_send_type_b2_b'];
    }

    /**
     * Sets default_send_type_b2_b
     *
     * @param string $default_send_type_b2_b default_send_type_b2_b
     *
     * @return $this
     */
    public function setDefaultSendTypeB2B($default_send_type_b2_b)
    {
        $allowedValues = $this->getDefaultSendTypeB2BAllowableValues();
        if (!is_null($default_send_type_b2_b) && !in_array($default_send_type_b2_b, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'default_send_type_b2_b', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['default_send_type_b2_b'] = $default_send_type_b2_b;

        return $this;
    }

    /**
     * Gets default_send_type_b2_c
     *
     * @return string
     */
    public function getDefaultSendTypeB2C()
    {
        return $this->container['default_send_type_b2_c'];
    }

    /**
     * Sets default_send_type_b2_c
     *
     * @param string $default_send_type_b2_c default_send_type_b2_c
     *
     * @return $this
     */
    public function setDefaultSendTypeB2C($default_send_type_b2_c)
    {
        $allowedValues = $this->getDefaultSendTypeB2CAllowableValues();
        if (!is_null($default_send_type_b2_c) && !in_array($default_send_type_b2_c, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'default_send_type_b2_c', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['default_send_type_b2_c'] = $default_send_type_b2_c;

        return $this;
    }

    /**
     * Gets show_backorder
     *
     * @return bool
     */
    public function getShowBackorder()
    {
        return $this->container['show_backorder'];
    }

    /**
     * Sets show_backorder
     *
     * @param bool $show_backorder show_backorder
     *
     * @return $this
     */
    public function setShowBackorder($show_backorder)
    {
        $this->container['show_backorder'] = $show_backorder;

        return $this;
    }

    /**
     * Gets set_deliver_to_available_stock
     *
     * @return bool
     */
    public function getSetDeliverToAvailableStock()
    {
        return $this->container['set_deliver_to_available_stock'];
    }

    /**
     * Sets set_deliver_to_available_stock
     *
     * @param bool $set_deliver_to_available_stock set_deliver_to_available_stock
     *
     * @return $this
     */
    public function setSetDeliverToAvailableStock($set_deliver_to_available_stock)
    {
        $this->container['set_deliver_to_available_stock'] = $set_deliver_to_available_stock;

        return $this;
    }

    /**
     * Gets send_types
     *
     * @return string[]
     */
    public function getSendTypes()
    {
        return $this->container['send_types'];
    }

    /**
     * Sets send_types
     *
     * @param string[] $send_types send_types
     *
     * @return $this
     */
    public function setSendTypes($send_types)
    {
        $allowedValues = $this->getSendTypesAllowableValues();
        if (!is_null($send_types) && array_diff($send_types, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'send_types', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['send_types'] = $send_types;

        return $this;
    }

    /**
     * Gets is_automatic_soft_reminder_enabled
     *
     * @return bool
     */
    public function getIsAutomaticSoftReminderEnabled()
    {
        return $this->container['is_automatic_soft_reminder_enabled'];
    }

    /**
     * Sets is_automatic_soft_reminder_enabled
     *
     * @param bool $is_automatic_soft_reminder_enabled Has automatic soft reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return $this
     */
    public function setIsAutomaticSoftReminderEnabled($is_automatic_soft_reminder_enabled)
    {
        $this->container['is_automatic_soft_reminder_enabled'] = $is_automatic_soft_reminder_enabled;

        return $this;
    }

    /**
     * Gets automatic_soft_reminder_days_after_due_date
     *
     * @return int
     */
    public function getAutomaticSoftReminderDaysAfterDueDate()
    {
        return $this->container['automatic_soft_reminder_days_after_due_date'];
    }

    /**
     * Sets automatic_soft_reminder_days_after_due_date
     *
     * @param int $automatic_soft_reminder_days_after_due_date Number of days after due date automatic soft reminders should be sent out if enabled.
     *
     * @return $this
     */
    public function setAutomaticSoftReminderDaysAfterDueDate($automatic_soft_reminder_days_after_due_date)
    {
        $this->container['automatic_soft_reminder_days_after_due_date'] = $automatic_soft_reminder_days_after_due_date;

        return $this;
    }

    /**
     * Gets is_automatic_reminder_enabled
     *
     * @return bool
     */
    public function getIsAutomaticReminderEnabled()
    {
        return $this->container['is_automatic_reminder_enabled'];
    }

    /**
     * Sets is_automatic_reminder_enabled
     *
     * @param bool $is_automatic_reminder_enabled Has automatic reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return $this
     */
    public function setIsAutomaticReminderEnabled($is_automatic_reminder_enabled)
    {
        $this->container['is_automatic_reminder_enabled'] = $is_automatic_reminder_enabled;

        return $this;
    }

    /**
     * Gets automatic_reminder_days_after_due_date
     *
     * @return int
     */
    public function getAutomaticReminderDaysAfterDueDate()
    {
        return $this->container['automatic_reminder_days_after_due_date'];
    }

    /**
     * Sets automatic_reminder_days_after_due_date
     *
     * @param int $automatic_reminder_days_after_due_date Number of days after due date automatic reminders should be sent ouf if enabled.
     *
     * @return $this
     */
    public function setAutomaticReminderDaysAfterDueDate($automatic_reminder_days_after_due_date)
    {
        $this->container['automatic_reminder_days_after_due_date'] = $automatic_reminder_days_after_due_date;

        return $this;
    }

    /**
     * Gets is_automatic_notice_of_debt_collection_enabled
     *
     * @return bool
     */
    public function getIsAutomaticNoticeOfDebtCollectionEnabled()
    {
        return $this->container['is_automatic_notice_of_debt_collection_enabled'];
    }

    /**
     * Sets is_automatic_notice_of_debt_collection_enabled
     *
     * @param bool $is_automatic_notice_of_debt_collection_enabled Has automatic notices of debt collection enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return $this
     */
    public function setIsAutomaticNoticeOfDebtCollectionEnabled($is_automatic_notice_of_debt_collection_enabled)
    {
        $this->container['is_automatic_notice_of_debt_collection_enabled'] = $is_automatic_notice_of_debt_collection_enabled;

        return $this;
    }

    /**
     * Gets automatic_notice_of_debt_collection_days_after_due_date
     *
     * @return int
     */
    public function getAutomaticNoticeOfDebtCollectionDaysAfterDueDate()
    {
        return $this->container['automatic_notice_of_debt_collection_days_after_due_date'];
    }

    /**
     * Sets automatic_notice_of_debt_collection_days_after_due_date
     *
     * @param int $automatic_notice_of_debt_collection_days_after_due_date Number of days after due date automatic notices of debt collection should be sent out if enabled.
     *
     * @return $this
     */
    public function setAutomaticNoticeOfDebtCollectionDaysAfterDueDate($automatic_notice_of_debt_collection_days_after_due_date)
    {
        $this->container['automatic_notice_of_debt_collection_days_after_due_date'] = $automatic_notice_of_debt_collection_days_after_due_date;

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
