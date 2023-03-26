<?php
/**
 * PaymentDTO
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
 * PaymentDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PaymentDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PaymentDTO';

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
        'payment_date' => 'string',
        'booking_date' => 'string',
        'value_date' => 'string',
        'amount_currency' => 'float',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'creditor_bank_name' => 'string',
        'creditor_bank_address' => 'string',
        'creditor_bank_postal_code' => 'string',
        'creditor_bank_postal_city' => 'string',
        'status' => 'string',
        'status_id' => 'string',
        'is_final_status' => 'bool',
        'is_foreign_payment' => 'bool',
        'is_salary' => 'bool',
        'description' => 'string',
        'kid' => 'string',
        'receiver_reference' => 'string',
        'source_voucher' => '\Learnist\Tripletex\Model\Voucher',
        'postings' => '\Learnist\Tripletex\Model\Posting',
        'account' => '\Learnist\Tripletex\Model\Account',
        'amount_in_account_currency' => 'float'
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
        'payment_date' => null,
        'booking_date' => null,
        'value_date' => null,
        'amount_currency' => null,
        'currency' => null,
        'creditor_bank_name' => null,
        'creditor_bank_address' => null,
        'creditor_bank_postal_code' => null,
        'creditor_bank_postal_city' => null,
        'status' => null,
        'status_id' => null,
        'is_final_status' => null,
        'is_foreign_payment' => null,
        'is_salary' => null,
        'description' => null,
        'kid' => null,
        'receiver_reference' => null,
        'source_voucher' => null,
        'postings' => null,
        'account' => null,
        'amount_in_account_currency' => null
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
		'payment_date' => false,
		'booking_date' => false,
		'value_date' => false,
		'amount_currency' => false,
		'currency' => false,
		'creditor_bank_name' => false,
		'creditor_bank_address' => false,
		'creditor_bank_postal_code' => false,
		'creditor_bank_postal_city' => false,
		'status' => false,
		'status_id' => false,
		'is_final_status' => false,
		'is_foreign_payment' => false,
		'is_salary' => false,
		'description' => false,
		'kid' => false,
		'receiver_reference' => false,
		'source_voucher' => false,
		'postings' => false,
		'account' => false,
		'amount_in_account_currency' => false
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
        'payment_date' => 'paymentDate',
        'booking_date' => 'bookingDate',
        'value_date' => 'valueDate',
        'amount_currency' => 'amountCurrency',
        'currency' => 'currency',
        'creditor_bank_name' => 'creditorBankName',
        'creditor_bank_address' => 'creditorBankAddress',
        'creditor_bank_postal_code' => 'creditorBankPostalCode',
        'creditor_bank_postal_city' => 'creditorBankPostalCity',
        'status' => 'status',
        'status_id' => 'statusId',
        'is_final_status' => 'isFinalStatus',
        'is_foreign_payment' => 'isForeignPayment',
        'is_salary' => 'isSalary',
        'description' => 'description',
        'kid' => 'kid',
        'receiver_reference' => 'receiverReference',
        'source_voucher' => 'sourceVoucher',
        'postings' => 'postings',
        'account' => 'account',
        'amount_in_account_currency' => 'amountInAccountCurrency'
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
        'payment_date' => 'setPaymentDate',
        'booking_date' => 'setBookingDate',
        'value_date' => 'setValueDate',
        'amount_currency' => 'setAmountCurrency',
        'currency' => 'setCurrency',
        'creditor_bank_name' => 'setCreditorBankName',
        'creditor_bank_address' => 'setCreditorBankAddress',
        'creditor_bank_postal_code' => 'setCreditorBankPostalCode',
        'creditor_bank_postal_city' => 'setCreditorBankPostalCity',
        'status' => 'setStatus',
        'status_id' => 'setStatusId',
        'is_final_status' => 'setIsFinalStatus',
        'is_foreign_payment' => 'setIsForeignPayment',
        'is_salary' => 'setIsSalary',
        'description' => 'setDescription',
        'kid' => 'setKid',
        'receiver_reference' => 'setReceiverReference',
        'source_voucher' => 'setSourceVoucher',
        'postings' => 'setPostings',
        'account' => 'setAccount',
        'amount_in_account_currency' => 'setAmountInAccountCurrency'
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
        'payment_date' => 'getPaymentDate',
        'booking_date' => 'getBookingDate',
        'value_date' => 'getValueDate',
        'amount_currency' => 'getAmountCurrency',
        'currency' => 'getCurrency',
        'creditor_bank_name' => 'getCreditorBankName',
        'creditor_bank_address' => 'getCreditorBankAddress',
        'creditor_bank_postal_code' => 'getCreditorBankPostalCode',
        'creditor_bank_postal_city' => 'getCreditorBankPostalCity',
        'status' => 'getStatus',
        'status_id' => 'getStatusId',
        'is_final_status' => 'getIsFinalStatus',
        'is_foreign_payment' => 'getIsForeignPayment',
        'is_salary' => 'getIsSalary',
        'description' => 'getDescription',
        'kid' => 'getKid',
        'receiver_reference' => 'getReceiverReference',
        'source_voucher' => 'getSourceVoucher',
        'postings' => 'getPostings',
        'account' => 'getAccount',
        'amount_in_account_currency' => 'getAmountInAccountCurrency'
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

    public const STATUS_NOT_APPROVED = 'NOT_APPROVED';
    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_SENT_TO_AUTOPAY = 'SENT_TO_AUTOPAY';
    public const STATUS_RECEIVED_BY_BANK = 'RECEIVED_BY_BANK';
    public const STATUS_ACCEPTED_BY_BANK = 'ACCEPTED_BY_BANK';
    public const STATUS_FAILED = 'FAILED';
    public const STATUS_CANCELLED = 'CANCELLED';
    public const STATUS_SUCCESS = 'SUCCESS';
    public const STATUS_ID__NEW = 'NEW';
    public const STATUS_ID_PENDING_SIGNING = 'PENDING_SIGNING';
    public const STATUS_ID_CANCELLED = 'CANCELLED';
    public const STATUS_ID_ERROR = 'ERROR';
    public const STATUS_ID_RECEIVED_BY_BANK = 'RECEIVED_BY_BANK';
    public const STATUS_ID_ACCEPTED_BY_BANK = 'ACCEPTED_BY_BANK';
    public const STATUS_ID_CANCELLED_IN_BANK = 'CANCELLED_IN_BANK';
    public const STATUS_ID_REJECTED_BY_BANK = 'REJECTED_BY_BANK';
    public const STATUS_ID_PAID = 'PAID';
    public const STATUS_ID_OTHER = 'OTHER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_NOT_APPROVED,
            self::STATUS_APPROVED,
            self::STATUS_SENT_TO_AUTOPAY,
            self::STATUS_RECEIVED_BY_BANK,
            self::STATUS_ACCEPTED_BY_BANK,
            self::STATUS_FAILED,
            self::STATUS_CANCELLED,
            self::STATUS_SUCCESS,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusIdAllowableValues()
    {
        return [
            self::STATUS_ID__NEW,
            self::STATUS_ID_PENDING_SIGNING,
            self::STATUS_ID_CANCELLED,
            self::STATUS_ID_ERROR,
            self::STATUS_ID_RECEIVED_BY_BANK,
            self::STATUS_ID_ACCEPTED_BY_BANK,
            self::STATUS_ID_CANCELLED_IN_BANK,
            self::STATUS_ID_REJECTED_BY_BANK,
            self::STATUS_ID_PAID,
            self::STATUS_ID_OTHER,
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
        $this->setIfExists('payment_date', $data ?? [], null);
        $this->setIfExists('booking_date', $data ?? [], null);
        $this->setIfExists('value_date', $data ?? [], null);
        $this->setIfExists('amount_currency', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('creditor_bank_name', $data ?? [], null);
        $this->setIfExists('creditor_bank_address', $data ?? [], null);
        $this->setIfExists('creditor_bank_postal_code', $data ?? [], null);
        $this->setIfExists('creditor_bank_postal_city', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('status_id', $data ?? [], null);
        $this->setIfExists('is_final_status', $data ?? [], null);
        $this->setIfExists('is_foreign_payment', $data ?? [], null);
        $this->setIfExists('is_salary', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('kid', $data ?? [], null);
        $this->setIfExists('receiver_reference', $data ?? [], null);
        $this->setIfExists('source_voucher', $data ?? [], null);
        $this->setIfExists('postings', $data ?? [], null);
        $this->setIfExists('account', $data ?? [], null);
        $this->setIfExists('amount_in_account_currency', $data ?? [], null);
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

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStatusIdAllowableValues();
        if (!is_null($this->container['status_id']) && !in_array($this->container['status_id'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status_id', must be one of '%s'",
                $this->container['status_id'],
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
     * Gets payment_date
     *
     * @return string|null
     */
    public function getPaymentDate()
    {
        return $this->container['payment_date'];
    }

    /**
     * Sets payment_date
     *
     * @param string|null $payment_date payment_date
     *
     * @return self
     */
    public function setPaymentDate($payment_date)
    {
        if (is_null($payment_date)) {
            throw new \InvalidArgumentException('non-nullable payment_date cannot be null');
        }
        $this->container['payment_date'] = $payment_date;

        return $this;
    }

    /**
     * Gets booking_date
     *
     * @return string|null
     */
    public function getBookingDate()
    {
        return $this->container['booking_date'];
    }

    /**
     * Sets booking_date
     *
     * @param string|null $booking_date booking_date
     *
     * @return self
     */
    public function setBookingDate($booking_date)
    {
        if (is_null($booking_date)) {
            throw new \InvalidArgumentException('non-nullable booking_date cannot be null');
        }
        $this->container['booking_date'] = $booking_date;

        return $this;
    }

    /**
     * Gets value_date
     *
     * @return string|null
     */
    public function getValueDate()
    {
        return $this->container['value_date'];
    }

    /**
     * Sets value_date
     *
     * @param string|null $value_date value_date
     *
     * @return self
     */
    public function setValueDate($value_date)
    {
        if (is_null($value_date)) {
            throw new \InvalidArgumentException('non-nullable value_date cannot be null');
        }
        $this->container['value_date'] = $value_date;

        return $this;
    }

    /**
     * Gets amount_currency
     *
     * @return float|null
     */
    public function getAmountCurrency()
    {
        return $this->container['amount_currency'];
    }

    /**
     * Sets amount_currency
     *
     * @param float|null $amount_currency In the specified currency.
     *
     * @return self
     */
    public function setAmountCurrency($amount_currency)
    {
        if (is_null($amount_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_currency cannot be null');
        }
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets creditor_bank_name
     *
     * @return string|null
     */
    public function getCreditorBankName()
    {
        return $this->container['creditor_bank_name'];
    }

    /**
     * Sets creditor_bank_name
     *
     * @param string|null $creditor_bank_name creditor_bank_name
     *
     * @return self
     */
    public function setCreditorBankName($creditor_bank_name)
    {
        if (is_null($creditor_bank_name)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_name cannot be null');
        }
        $this->container['creditor_bank_name'] = $creditor_bank_name;

        return $this;
    }

    /**
     * Gets creditor_bank_address
     *
     * @return string|null
     */
    public function getCreditorBankAddress()
    {
        return $this->container['creditor_bank_address'];
    }

    /**
     * Sets creditor_bank_address
     *
     * @param string|null $creditor_bank_address creditor_bank_address
     *
     * @return self
     */
    public function setCreditorBankAddress($creditor_bank_address)
    {
        if (is_null($creditor_bank_address)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_address cannot be null');
        }
        $this->container['creditor_bank_address'] = $creditor_bank_address;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_code
     *
     * @return string|null
     */
    public function getCreditorBankPostalCode()
    {
        return $this->container['creditor_bank_postal_code'];
    }

    /**
     * Sets creditor_bank_postal_code
     *
     * @param string|null $creditor_bank_postal_code creditor_bank_postal_code
     *
     * @return self
     */
    public function setCreditorBankPostalCode($creditor_bank_postal_code)
    {
        if (is_null($creditor_bank_postal_code)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_postal_code cannot be null');
        }
        $this->container['creditor_bank_postal_code'] = $creditor_bank_postal_code;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_city
     *
     * @return string|null
     */
    public function getCreditorBankPostalCity()
    {
        return $this->container['creditor_bank_postal_city'];
    }

    /**
     * Sets creditor_bank_postal_city
     *
     * @param string|null $creditor_bank_postal_city creditor_bank_postal_city
     *
     * @return self
     */
    public function setCreditorBankPostalCity($creditor_bank_postal_city)
    {
        if (is_null($creditor_bank_postal_city)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_postal_city cannot be null');
        }
        $this->container['creditor_bank_postal_city'] = $creditor_bank_postal_city;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The payment status.NOT_APPROVED: Payment not approved yet.<br>APPROVED: Payment approved, but not yet sent to bank.<br>SENT_TO_AUTOPAY: Payment sent to bank.<br>RECEIVED_BY_BANK: Payment received by the bank.<br>ACCEPTED_BY_BANK: Payment that was accepted by the bank.<br>FAILED: Payment that failed.<br>CANCELLED: Cancelled payment.<br>SUCCESS: Payment that ended successfully.<br>
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets status_id
     *
     * @return string|null
     */
    public function getStatusId()
    {
        return $this->container['status_id'];
    }

    /**
     * Sets status_id
     *
     * @param string|null $status_id The payment status Id. Usually all the payments in one batch have the same status ID, at least to the point of being received by bank.NEW: Payment is new.<br>PENDING_SIGNING: Payment is sent to AutoPay but not signed yet, requires re-approving.<br>CANCELLED: Payment was cancelled by ERP.<br>ERROR: Payment that failed.<br>RECEIVED_BY_BANK: Payment was received by the bank.<br>ACCEPTED_BY_BANK: Payment was accepted by bank.<br>CANCELLED_IN_BANK: Payment was cancelled in bank.<br>REJECTED_BY_BANK: Payment was rejected by bank.<br>PAID: Payment is paid.<br>OTHER: In case status in unknown. Will never be a final status.<br>
     *
     * @return self
     */
    public function setStatusId($status_id)
    {
        if (is_null($status_id)) {
            throw new \InvalidArgumentException('non-nullable status_id cannot be null');
        }
        $allowedValues = $this->getStatusIdAllowableValues();
        if (!in_array($status_id, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status_id', must be one of '%s'",
                    $status_id,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status_id'] = $status_id;

        return $this;
    }

    /**
     * Gets is_final_status
     *
     * @return bool|null
     */
    public function getIsFinalStatus()
    {
        return $this->container['is_final_status'];
    }

    /**
     * Sets is_final_status
     *
     * @param bool|null $is_final_status is_final_status
     *
     * @return self
     */
    public function setIsFinalStatus($is_final_status)
    {
        if (is_null($is_final_status)) {
            throw new \InvalidArgumentException('non-nullable is_final_status cannot be null');
        }
        $this->container['is_final_status'] = $is_final_status;

        return $this;
    }

    /**
     * Gets is_foreign_payment
     *
     * @return bool|null
     */
    public function getIsForeignPayment()
    {
        return $this->container['is_foreign_payment'];
    }

    /**
     * Sets is_foreign_payment
     *
     * @param bool|null $is_foreign_payment is_foreign_payment
     *
     * @return self
     */
    public function setIsForeignPayment($is_foreign_payment)
    {
        if (is_null($is_foreign_payment)) {
            throw new \InvalidArgumentException('non-nullable is_foreign_payment cannot be null');
        }
        $this->container['is_foreign_payment'] = $is_foreign_payment;

        return $this;
    }

    /**
     * Gets is_salary
     *
     * @return bool|null
     */
    public function getIsSalary()
    {
        return $this->container['is_salary'];
    }

    /**
     * Sets is_salary
     *
     * @param bool|null $is_salary is_salary
     *
     * @return self
     */
    public function setIsSalary($is_salary)
    {
        if (is_null($is_salary)) {
            throw new \InvalidArgumentException('non-nullable is_salary cannot be null');
        }
        $this->container['is_salary'] = $is_salary;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets kid
     *
     * @return string|null
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string|null $kid KID - Kundeidentifikasjonsnummer.
     *
     * @return self
     */
    public function setKid($kid)
    {
        if (is_null($kid)) {
            throw new \InvalidArgumentException('non-nullable kid cannot be null');
        }
        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets receiver_reference
     *
     * @return string|null
     */
    public function getReceiverReference()
    {
        return $this->container['receiver_reference'];
    }

    /**
     * Sets receiver_reference
     *
     * @param string|null $receiver_reference receiver_reference
     *
     * @return self
     */
    public function setReceiverReference($receiver_reference)
    {
        if (is_null($receiver_reference)) {
            throw new \InvalidArgumentException('non-nullable receiver_reference cannot be null');
        }
        $this->container['receiver_reference'] = $receiver_reference;

        return $this;
    }

    /**
     * Gets source_voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher|null
     */
    public function getSourceVoucher()
    {
        return $this->container['source_voucher'];
    }

    /**
     * Sets source_voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher|null $source_voucher source_voucher
     *
     * @return self
     */
    public function setSourceVoucher($source_voucher)
    {
        if (is_null($source_voucher)) {
            throw new \InvalidArgumentException('non-nullable source_voucher cannot be null');
        }
        $this->container['source_voucher'] = $source_voucher;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting|null
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting|null $postings postings
     *
     * @return self
     */
    public function setPostings($postings)
    {
        if (is_null($postings)) {
            throw new \InvalidArgumentException('non-nullable postings cannot be null');
        }
        $this->container['postings'] = $postings;

        return $this;
    }

    /**
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account|null $account account
     *
     * @return self
     */
    public function setAccount($account)
    {
        if (is_null($account)) {
            throw new \InvalidArgumentException('non-nullable account cannot be null');
        }
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets amount_in_account_currency
     *
     * @return float|null
     */
    public function getAmountInAccountCurrency()
    {
        return $this->container['amount_in_account_currency'];
    }

    /**
     * Sets amount_in_account_currency
     *
     * @param float|null $amount_in_account_currency Amount specified in the currency of the bank agreements account.
     *
     * @return self
     */
    public function setAmountInAccountCurrency($amount_in_account_currency)
    {
        if (is_null($amount_in_account_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_in_account_currency cannot be null');
        }
        $this->container['amount_in_account_currency'] = $amount_in_account_currency;

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


