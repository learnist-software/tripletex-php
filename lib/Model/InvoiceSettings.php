<?php
/**
 * InvoiceSettings
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
 * InvoiceSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InvoiceSettings implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceSettings';

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
        'automatic_notice_of_debt_collection_days_after_due_date' => 'int'
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
        'automatic_notice_of_debt_collection_days_after_due_date' => 'int32'
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
		'has_first_invoice_number' => false,
		'next_invoice_number' => false,
		'bank_account_ready' => false,
		'default_send_type_b2_b' => false,
		'default_send_type_b2_c' => false,
		'show_backorder' => false,
		'set_deliver_to_available_stock' => false,
		'send_types' => false,
		'is_automatic_soft_reminder_enabled' => false,
		'automatic_soft_reminder_days_after_due_date' => false,
		'is_automatic_reminder_enabled' => false,
		'automatic_reminder_days_after_due_date' => false,
		'is_automatic_notice_of_debt_collection_enabled' => false,
		'automatic_notice_of_debt_collection_days_after_due_date' => false
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
        'automatic_notice_of_debt_collection_days_after_due_date' => 'automaticNoticeOfDebtCollectionDaysAfterDueDate'
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
        'automatic_notice_of_debt_collection_days_after_due_date' => 'setAutomaticNoticeOfDebtCollectionDaysAfterDueDate'
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
        'automatic_notice_of_debt_collection_days_after_due_date' => 'getAutomaticNoticeOfDebtCollectionDaysAfterDueDate'
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

    public const DEFAULT_SEND_TYPE_B2_B_EMAIL = 'EMAIL';
    public const DEFAULT_SEND_TYPE_B2_B_EHF = 'EHF';
    public const DEFAULT_SEND_TYPE_B2_B_EFAKTURA = 'EFAKTURA';
    public const DEFAULT_SEND_TYPE_B2_B_AVTALEGIRO = 'AVTALEGIRO';
    public const DEFAULT_SEND_TYPE_B2_B_VIPPS = 'VIPPS';
    public const DEFAULT_SEND_TYPE_B2_B_PAPER = 'PAPER';
    public const DEFAULT_SEND_TYPE_B2_B_MANUAL = 'MANUAL';
    public const DEFAULT_SEND_TYPE_B2_B_DIRECT = 'DIRECT';
    public const DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_OUTBOUND = 'AUTOINVOICE_EHF_OUTBOUND';
    public const DEFAULT_SEND_TYPE_B2_B_AUTOINVOICE_EHF_INCOMING = 'AUTOINVOICE_EHF_INCOMING';
    public const DEFAULT_SEND_TYPE_B2_B_PEPPOL_EHF_INCOMING = 'PEPPOL_EHF_INCOMING';
    public const DEFAULT_SEND_TYPE_B2_C_EMAIL = 'EMAIL';
    public const DEFAULT_SEND_TYPE_B2_C_EHF = 'EHF';
    public const DEFAULT_SEND_TYPE_B2_C_EFAKTURA = 'EFAKTURA';
    public const DEFAULT_SEND_TYPE_B2_C_AVTALEGIRO = 'AVTALEGIRO';
    public const DEFAULT_SEND_TYPE_B2_C_VIPPS = 'VIPPS';
    public const DEFAULT_SEND_TYPE_B2_C_PAPER = 'PAPER';
    public const DEFAULT_SEND_TYPE_B2_C_MANUAL = 'MANUAL';
    public const DEFAULT_SEND_TYPE_B2_C_DIRECT = 'DIRECT';
    public const DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_OUTBOUND = 'AUTOINVOICE_EHF_OUTBOUND';
    public const DEFAULT_SEND_TYPE_B2_C_AUTOINVOICE_EHF_INCOMING = 'AUTOINVOICE_EHF_INCOMING';
    public const DEFAULT_SEND_TYPE_B2_C_PEPPOL_EHF_INCOMING = 'PEPPOL_EHF_INCOMING';
    public const SEND_TYPES_EMAIL = 'EMAIL';
    public const SEND_TYPES_EHF = 'EHF';
    public const SEND_TYPES_AVTALEGIRO = 'AVTALEGIRO';
    public const SEND_TYPES_EFAKTURA = 'EFAKTURA';
    public const SEND_TYPES_VIPPS = 'VIPPS';
    public const SEND_TYPES_PAPER = 'PAPER';
    public const SEND_TYPES_MANUAL = 'MANUAL';

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
            self::DEFAULT_SEND_TYPE_B2_B_PEPPOL_EHF_INCOMING,
        ];
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
            self::DEFAULT_SEND_TYPE_B2_C_PEPPOL_EHF_INCOMING,
        ];
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
            self::SEND_TYPES_MANUAL,
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
        $this->setIfExists('has_first_invoice_number', $data ?? [], null);
        $this->setIfExists('next_invoice_number', $data ?? [], null);
        $this->setIfExists('bank_account_ready', $data ?? [], null);
        $this->setIfExists('default_send_type_b2_b', $data ?? [], null);
        $this->setIfExists('default_send_type_b2_c', $data ?? [], null);
        $this->setIfExists('show_backorder', $data ?? [], null);
        $this->setIfExists('set_deliver_to_available_stock', $data ?? [], null);
        $this->setIfExists('send_types', $data ?? [], null);
        $this->setIfExists('is_automatic_soft_reminder_enabled', $data ?? [], null);
        $this->setIfExists('automatic_soft_reminder_days_after_due_date', $data ?? [], null);
        $this->setIfExists('is_automatic_reminder_enabled', $data ?? [], null);
        $this->setIfExists('automatic_reminder_days_after_due_date', $data ?? [], null);
        $this->setIfExists('is_automatic_notice_of_debt_collection_enabled', $data ?? [], null);
        $this->setIfExists('automatic_notice_of_debt_collection_days_after_due_date', $data ?? [], null);
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

        $allowedValues = $this->getDefaultSendTypeB2BAllowableValues();
        if (!is_null($this->container['default_send_type_b2_b']) && !in_array($this->container['default_send_type_b2_b'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'default_send_type_b2_b', must be one of '%s'",
                $this->container['default_send_type_b2_b'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDefaultSendTypeB2CAllowableValues();
        if (!is_null($this->container['default_send_type_b2_c']) && !in_array($this->container['default_send_type_b2_c'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'default_send_type_b2_c', must be one of '%s'",
                $this->container['default_send_type_b2_c'],
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
     * Gets has_first_invoice_number
     *
     * @return bool|null
     */
    public function getHasFirstInvoiceNumber()
    {
        return $this->container['has_first_invoice_number'];
    }

    /**
     * Sets has_first_invoice_number
     *
     * @param bool|null $has_first_invoice_number has_first_invoice_number
     *
     * @return self
     */
    public function setHasFirstInvoiceNumber($has_first_invoice_number)
    {
        if (is_null($has_first_invoice_number)) {
            throw new \InvalidArgumentException('non-nullable has_first_invoice_number cannot be null');
        }
        $this->container['has_first_invoice_number'] = $has_first_invoice_number;

        return $this;
    }

    /**
     * Gets next_invoice_number
     *
     * @return int|null
     */
    public function getNextInvoiceNumber()
    {
        return $this->container['next_invoice_number'];
    }

    /**
     * Sets next_invoice_number
     *
     * @param int|null $next_invoice_number next_invoice_number
     *
     * @return self
     */
    public function setNextInvoiceNumber($next_invoice_number)
    {
        if (is_null($next_invoice_number)) {
            throw new \InvalidArgumentException('non-nullable next_invoice_number cannot be null');
        }
        $this->container['next_invoice_number'] = $next_invoice_number;

        return $this;
    }

    /**
     * Gets bank_account_ready
     *
     * @return bool|null
     */
    public function getBankAccountReady()
    {
        return $this->container['bank_account_ready'];
    }

    /**
     * Sets bank_account_ready
     *
     * @param bool|null $bank_account_ready bank_account_ready
     *
     * @return self
     */
    public function setBankAccountReady($bank_account_ready)
    {
        if (is_null($bank_account_ready)) {
            throw new \InvalidArgumentException('non-nullable bank_account_ready cannot be null');
        }
        $this->container['bank_account_ready'] = $bank_account_ready;

        return $this;
    }

    /**
     * Gets default_send_type_b2_b
     *
     * @return string|null
     */
    public function getDefaultSendTypeB2B()
    {
        return $this->container['default_send_type_b2_b'];
    }

    /**
     * Sets default_send_type_b2_b
     *
     * @param string|null $default_send_type_b2_b default_send_type_b2_b
     *
     * @return self
     */
    public function setDefaultSendTypeB2B($default_send_type_b2_b)
    {
        if (is_null($default_send_type_b2_b)) {
            throw new \InvalidArgumentException('non-nullable default_send_type_b2_b cannot be null');
        }
        $allowedValues = $this->getDefaultSendTypeB2BAllowableValues();
        if (!in_array($default_send_type_b2_b, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'default_send_type_b2_b', must be one of '%s'",
                    $default_send_type_b2_b,
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
     * @return string|null
     */
    public function getDefaultSendTypeB2C()
    {
        return $this->container['default_send_type_b2_c'];
    }

    /**
     * Sets default_send_type_b2_c
     *
     * @param string|null $default_send_type_b2_c default_send_type_b2_c
     *
     * @return self
     */
    public function setDefaultSendTypeB2C($default_send_type_b2_c)
    {
        if (is_null($default_send_type_b2_c)) {
            throw new \InvalidArgumentException('non-nullable default_send_type_b2_c cannot be null');
        }
        $allowedValues = $this->getDefaultSendTypeB2CAllowableValues();
        if (!in_array($default_send_type_b2_c, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'default_send_type_b2_c', must be one of '%s'",
                    $default_send_type_b2_c,
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
     * @return bool|null
     */
    public function getShowBackorder()
    {
        return $this->container['show_backorder'];
    }

    /**
     * Sets show_backorder
     *
     * @param bool|null $show_backorder show_backorder
     *
     * @return self
     */
    public function setShowBackorder($show_backorder)
    {
        if (is_null($show_backorder)) {
            throw new \InvalidArgumentException('non-nullable show_backorder cannot be null');
        }
        $this->container['show_backorder'] = $show_backorder;

        return $this;
    }

    /**
     * Gets set_deliver_to_available_stock
     *
     * @return bool|null
     */
    public function getSetDeliverToAvailableStock()
    {
        return $this->container['set_deliver_to_available_stock'];
    }

    /**
     * Sets set_deliver_to_available_stock
     *
     * @param bool|null $set_deliver_to_available_stock set_deliver_to_available_stock
     *
     * @return self
     */
    public function setSetDeliverToAvailableStock($set_deliver_to_available_stock)
    {
        if (is_null($set_deliver_to_available_stock)) {
            throw new \InvalidArgumentException('non-nullable set_deliver_to_available_stock cannot be null');
        }
        $this->container['set_deliver_to_available_stock'] = $set_deliver_to_available_stock;

        return $this;
    }

    /**
     * Gets send_types
     *
     * @return string[]|null
     */
    public function getSendTypes()
    {
        return $this->container['send_types'];
    }

    /**
     * Sets send_types
     *
     * @param string[]|null $send_types send_types
     *
     * @return self
     */
    public function setSendTypes($send_types)
    {
        if (is_null($send_types)) {
            throw new \InvalidArgumentException('non-nullable send_types cannot be null');
        }
        $allowedValues = $this->getSendTypesAllowableValues();
        if (array_diff($send_types, $allowedValues)) {
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
     * @return bool|null
     */
    public function getIsAutomaticSoftReminderEnabled()
    {
        return $this->container['is_automatic_soft_reminder_enabled'];
    }

    /**
     * Sets is_automatic_soft_reminder_enabled
     *
     * @param bool|null $is_automatic_soft_reminder_enabled Has automatic soft reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return self
     */
    public function setIsAutomaticSoftReminderEnabled($is_automatic_soft_reminder_enabled)
    {
        if (is_null($is_automatic_soft_reminder_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_soft_reminder_enabled cannot be null');
        }
        $this->container['is_automatic_soft_reminder_enabled'] = $is_automatic_soft_reminder_enabled;

        return $this;
    }

    /**
     * Gets automatic_soft_reminder_days_after_due_date
     *
     * @return int|null
     */
    public function getAutomaticSoftReminderDaysAfterDueDate()
    {
        return $this->container['automatic_soft_reminder_days_after_due_date'];
    }

    /**
     * Sets automatic_soft_reminder_days_after_due_date
     *
     * @param int|null $automatic_soft_reminder_days_after_due_date Number of days after due date automatic soft reminders should be sent out if enabled.
     *
     * @return self
     */
    public function setAutomaticSoftReminderDaysAfterDueDate($automatic_soft_reminder_days_after_due_date)
    {
        if (is_null($automatic_soft_reminder_days_after_due_date)) {
            throw new \InvalidArgumentException('non-nullable automatic_soft_reminder_days_after_due_date cannot be null');
        }
        $this->container['automatic_soft_reminder_days_after_due_date'] = $automatic_soft_reminder_days_after_due_date;

        return $this;
    }

    /**
     * Gets is_automatic_reminder_enabled
     *
     * @return bool|null
     */
    public function getIsAutomaticReminderEnabled()
    {
        return $this->container['is_automatic_reminder_enabled'];
    }

    /**
     * Sets is_automatic_reminder_enabled
     *
     * @param bool|null $is_automatic_reminder_enabled Has automatic reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return self
     */
    public function setIsAutomaticReminderEnabled($is_automatic_reminder_enabled)
    {
        if (is_null($is_automatic_reminder_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_reminder_enabled cannot be null');
        }
        $this->container['is_automatic_reminder_enabled'] = $is_automatic_reminder_enabled;

        return $this;
    }

    /**
     * Gets automatic_reminder_days_after_due_date
     *
     * @return int|null
     */
    public function getAutomaticReminderDaysAfterDueDate()
    {
        return $this->container['automatic_reminder_days_after_due_date'];
    }

    /**
     * Sets automatic_reminder_days_after_due_date
     *
     * @param int|null $automatic_reminder_days_after_due_date Number of days after due date automatic reminders should be sent ouf if enabled.
     *
     * @return self
     */
    public function setAutomaticReminderDaysAfterDueDate($automatic_reminder_days_after_due_date)
    {
        if (is_null($automatic_reminder_days_after_due_date)) {
            throw new \InvalidArgumentException('non-nullable automatic_reminder_days_after_due_date cannot be null');
        }
        $this->container['automatic_reminder_days_after_due_date'] = $automatic_reminder_days_after_due_date;

        return $this;
    }

    /**
     * Gets is_automatic_notice_of_debt_collection_enabled
     *
     * @return bool|null
     */
    public function getIsAutomaticNoticeOfDebtCollectionEnabled()
    {
        return $this->container['is_automatic_notice_of_debt_collection_enabled'];
    }

    /**
     * Sets is_automatic_notice_of_debt_collection_enabled
     *
     * @param bool|null $is_automatic_notice_of_debt_collection_enabled Has automatic notices of debt collection enabled for this company. This setting need to be enabled both here and on each customer card to take effect.
     *
     * @return self
     */
    public function setIsAutomaticNoticeOfDebtCollectionEnabled($is_automatic_notice_of_debt_collection_enabled)
    {
        if (is_null($is_automatic_notice_of_debt_collection_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_notice_of_debt_collection_enabled cannot be null');
        }
        $this->container['is_automatic_notice_of_debt_collection_enabled'] = $is_automatic_notice_of_debt_collection_enabled;

        return $this;
    }

    /**
     * Gets automatic_notice_of_debt_collection_days_after_due_date
     *
     * @return int|null
     */
    public function getAutomaticNoticeOfDebtCollectionDaysAfterDueDate()
    {
        return $this->container['automatic_notice_of_debt_collection_days_after_due_date'];
    }

    /**
     * Sets automatic_notice_of_debt_collection_days_after_due_date
     *
     * @param int|null $automatic_notice_of_debt_collection_days_after_due_date Number of days after due date automatic notices of debt collection should be sent out if enabled.
     *
     * @return self
     */
    public function setAutomaticNoticeOfDebtCollectionDaysAfterDueDate($automatic_notice_of_debt_collection_days_after_due_date)
    {
        if (is_null($automatic_notice_of_debt_collection_days_after_due_date)) {
            throw new \InvalidArgumentException('non-nullable automatic_notice_of_debt_collection_days_after_due_date cannot be null');
        }
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


