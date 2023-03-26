<?php
/**
 * IncomingInvoicePaymentHistoryTransaction
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
 * IncomingInvoicePaymentHistoryTransaction Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class IncomingInvoicePaymentHistoryTransaction implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'IncomingInvoicePaymentHistoryTransaction';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'payment_type' => 'string',
        'base_voucher_id' => 'int',
        'posting_id' => 'int',
        'voucher_id' => 'int',
        'voucher_number_as_string' => 'string',
        'date' => 'string',
        'text1' => 'string',
        'text2' => 'string',
        'text3' => 'string',
        'amount_negative' => 'object',
        'amount_currency_negative' => 'object',
        'currency_id' => 'int',
        'currency_code' => 'string',
        'is_deletable' => 'bool',
        'is_reversed' => 'bool',
        'delete_message' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'payment_type' => null,
        'base_voucher_id' => 'int32',
        'posting_id' => 'int32',
        'voucher_id' => 'int32',
        'voucher_number_as_string' => null,
        'date' => null,
        'text1' => null,
        'text2' => null,
        'text3' => null,
        'amount_negative' => null,
        'amount_currency_negative' => null,
        'currency_id' => 'int32',
        'currency_code' => null,
        'is_deletable' => null,
        'is_reversed' => null,
        'delete_message' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'payment_type' => false,
		'base_voucher_id' => false,
		'posting_id' => false,
		'voucher_id' => false,
		'voucher_number_as_string' => false,
		'date' => false,
		'text1' => false,
		'text2' => false,
		'text3' => false,
		'amount_negative' => false,
		'amount_currency_negative' => false,
		'currency_id' => false,
		'currency_code' => false,
		'is_deletable' => false,
		'is_reversed' => false,
		'delete_message' => false
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
        'payment_type' => 'paymentType',
        'base_voucher_id' => 'baseVoucherId',
        'posting_id' => 'postingId',
        'voucher_id' => 'voucherId',
        'voucher_number_as_string' => 'voucherNumberAsString',
        'date' => 'date',
        'text1' => 'text1',
        'text2' => 'text2',
        'text3' => 'text3',
        'amount_negative' => 'amountNegative',
        'amount_currency_negative' => 'amountCurrencyNegative',
        'currency_id' => 'currencyId',
        'currency_code' => 'currencyCode',
        'is_deletable' => 'isDeletable',
        'is_reversed' => 'isReversed',
        'delete_message' => 'deleteMessage'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'payment_type' => 'setPaymentType',
        'base_voucher_id' => 'setBaseVoucherId',
        'posting_id' => 'setPostingId',
        'voucher_id' => 'setVoucherId',
        'voucher_number_as_string' => 'setVoucherNumberAsString',
        'date' => 'setDate',
        'text1' => 'setText1',
        'text2' => 'setText2',
        'text3' => 'setText3',
        'amount_negative' => 'setAmountNegative',
        'amount_currency_negative' => 'setAmountCurrencyNegative',
        'currency_id' => 'setCurrencyId',
        'currency_code' => 'setCurrencyCode',
        'is_deletable' => 'setIsDeletable',
        'is_reversed' => 'setIsReversed',
        'delete_message' => 'setDeleteMessage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'payment_type' => 'getPaymentType',
        'base_voucher_id' => 'getBaseVoucherId',
        'posting_id' => 'getPostingId',
        'voucher_id' => 'getVoucherId',
        'voucher_number_as_string' => 'getVoucherNumberAsString',
        'date' => 'getDate',
        'text1' => 'getText1',
        'text2' => 'getText2',
        'text3' => 'getText3',
        'amount_negative' => 'getAmountNegative',
        'amount_currency_negative' => 'getAmountCurrencyNegative',
        'currency_id' => 'getCurrencyId',
        'currency_code' => 'getCurrencyCode',
        'is_deletable' => 'getIsDeletable',
        'is_reversed' => 'getIsReversed',
        'delete_message' => 'getDeleteMessage'
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

    public const PAYMENT_TYPE_NOT_PAID = 'NOT_PAID';
    public const PAYMENT_TYPE_NETS = 'NETS';
    public const PAYMENT_TYPE_AUTOPAY = 'AUTOPAY';
    public const PAYMENT_TYPE_POSTING_RULE = 'POSTING_RULE';
    public const PAYMENT_TYPE_ZTL = 'ZTL';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentTypeAllowableValues()
    {
        return [
            self::PAYMENT_TYPE_NOT_PAID,
            self::PAYMENT_TYPE_NETS,
            self::PAYMENT_TYPE_AUTOPAY,
            self::PAYMENT_TYPE_POSTING_RULE,
            self::PAYMENT_TYPE_ZTL,
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
        $this->setIfExists('payment_type', $data ?? [], null);
        $this->setIfExists('base_voucher_id', $data ?? [], null);
        $this->setIfExists('posting_id', $data ?? [], null);
        $this->setIfExists('voucher_id', $data ?? [], null);
        $this->setIfExists('voucher_number_as_string', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('text1', $data ?? [], null);
        $this->setIfExists('text2', $data ?? [], null);
        $this->setIfExists('text3', $data ?? [], null);
        $this->setIfExists('amount_negative', $data ?? [], null);
        $this->setIfExists('amount_currency_negative', $data ?? [], null);
        $this->setIfExists('currency_id', $data ?? [], null);
        $this->setIfExists('currency_code', $data ?? [], null);
        $this->setIfExists('is_deletable', $data ?? [], null);
        $this->setIfExists('is_reversed', $data ?? [], null);
        $this->setIfExists('delete_message', $data ?? [], null);
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

        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!is_null($this->container['payment_type']) && !in_array($this->container['payment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_type', must be one of '%s'",
                $this->container['payment_type'],
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
     * Gets payment_type
     *
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string|null $payment_type payment_type
     *
     * @return self
     */
    public function setPaymentType($payment_type)
    {
        if (is_null($payment_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type cannot be null');
        }
        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!in_array($payment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_type', must be one of '%s'",
                    $payment_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets base_voucher_id
     *
     * @return int|null
     */
    public function getBaseVoucherId()
    {
        return $this->container['base_voucher_id'];
    }

    /**
     * Sets base_voucher_id
     *
     * @param int|null $base_voucher_id base_voucher_id
     *
     * @return self
     */
    public function setBaseVoucherId($base_voucher_id)
    {
        if (is_null($base_voucher_id)) {
            throw new \InvalidArgumentException('non-nullable base_voucher_id cannot be null');
        }
        $this->container['base_voucher_id'] = $base_voucher_id;

        return $this;
    }

    /**
     * Gets posting_id
     *
     * @return int|null
     */
    public function getPostingId()
    {
        return $this->container['posting_id'];
    }

    /**
     * Sets posting_id
     *
     * @param int|null $posting_id posting_id
     *
     * @return self
     */
    public function setPostingId($posting_id)
    {
        if (is_null($posting_id)) {
            throw new \InvalidArgumentException('non-nullable posting_id cannot be null');
        }
        $this->container['posting_id'] = $posting_id;

        return $this;
    }

    /**
     * Gets voucher_id
     *
     * @return int|null
     */
    public function getVoucherId()
    {
        return $this->container['voucher_id'];
    }

    /**
     * Sets voucher_id
     *
     * @param int|null $voucher_id voucher_id
     *
     * @return self
     */
    public function setVoucherId($voucher_id)
    {
        if (is_null($voucher_id)) {
            throw new \InvalidArgumentException('non-nullable voucher_id cannot be null');
        }
        $this->container['voucher_id'] = $voucher_id;

        return $this;
    }

    /**
     * Gets voucher_number_as_string
     *
     * @return string|null
     */
    public function getVoucherNumberAsString()
    {
        return $this->container['voucher_number_as_string'];
    }

    /**
     * Sets voucher_number_as_string
     *
     * @param string|null $voucher_number_as_string voucher_number_as_string
     *
     * @return self
     */
    public function setVoucherNumberAsString($voucher_number_as_string)
    {
        if (is_null($voucher_number_as_string)) {
            throw new \InvalidArgumentException('non-nullable voucher_number_as_string cannot be null');
        }
        $this->container['voucher_number_as_string'] = $voucher_number_as_string;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {
        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets text1
     *
     * @return string|null
     */
    public function getText1()
    {
        return $this->container['text1'];
    }

    /**
     * Sets text1
     *
     * @param string|null $text1 text1
     *
     * @return self
     */
    public function setText1($text1)
    {
        if (is_null($text1)) {
            throw new \InvalidArgumentException('non-nullable text1 cannot be null');
        }
        $this->container['text1'] = $text1;

        return $this;
    }

    /**
     * Gets text2
     *
     * @return string|null
     */
    public function getText2()
    {
        return $this->container['text2'];
    }

    /**
     * Sets text2
     *
     * @param string|null $text2 text2
     *
     * @return self
     */
    public function setText2($text2)
    {
        if (is_null($text2)) {
            throw new \InvalidArgumentException('non-nullable text2 cannot be null');
        }
        $this->container['text2'] = $text2;

        return $this;
    }

    /**
     * Gets text3
     *
     * @return string|null
     */
    public function getText3()
    {
        return $this->container['text3'];
    }

    /**
     * Sets text3
     *
     * @param string|null $text3 text3
     *
     * @return self
     */
    public function setText3($text3)
    {
        if (is_null($text3)) {
            throw new \InvalidArgumentException('non-nullable text3 cannot be null');
        }
        $this->container['text3'] = $text3;

        return $this;
    }

    /**
     * Gets amount_negative
     *
     * @return object|null
     */
    public function getAmountNegative()
    {
        return $this->container['amount_negative'];
    }

    /**
     * Sets amount_negative
     *
     * @param object|null $amount_negative amount_negative
     *
     * @return self
     */
    public function setAmountNegative($amount_negative)
    {
        if (is_null($amount_negative)) {
            throw new \InvalidArgumentException('non-nullable amount_negative cannot be null');
        }
        $this->container['amount_negative'] = $amount_negative;

        return $this;
    }

    /**
     * Gets amount_currency_negative
     *
     * @return object|null
     */
    public function getAmountCurrencyNegative()
    {
        return $this->container['amount_currency_negative'];
    }

    /**
     * Sets amount_currency_negative
     *
     * @param object|null $amount_currency_negative amount_currency_negative
     *
     * @return self
     */
    public function setAmountCurrencyNegative($amount_currency_negative)
    {
        if (is_null($amount_currency_negative)) {
            throw new \InvalidArgumentException('non-nullable amount_currency_negative cannot be null');
        }
        $this->container['amount_currency_negative'] = $amount_currency_negative;

        return $this;
    }

    /**
     * Gets currency_id
     *
     * @return int|null
     */
    public function getCurrencyId()
    {
        return $this->container['currency_id'];
    }

    /**
     * Sets currency_id
     *
     * @param int|null $currency_id currency_id
     *
     * @return self
     */
    public function setCurrencyId($currency_id)
    {
        if (is_null($currency_id)) {
            throw new \InvalidArgumentException('non-nullable currency_id cannot be null');
        }
        $this->container['currency_id'] = $currency_id;

        return $this;
    }

    /**
     * Gets currency_code
     *
     * @return string|null
     */
    public function getCurrencyCode()
    {
        return $this->container['currency_code'];
    }

    /**
     * Sets currency_code
     *
     * @param string|null $currency_code currency_code
     *
     * @return self
     */
    public function setCurrencyCode($currency_code)
    {
        if (is_null($currency_code)) {
            throw new \InvalidArgumentException('non-nullable currency_code cannot be null');
        }
        $this->container['currency_code'] = $currency_code;

        return $this;
    }

    /**
     * Gets is_deletable
     *
     * @return bool|null
     */
    public function getIsDeletable()
    {
        return $this->container['is_deletable'];
    }

    /**
     * Sets is_deletable
     *
     * @param bool|null $is_deletable is_deletable
     *
     * @return self
     */
    public function setIsDeletable($is_deletable)
    {
        if (is_null($is_deletable)) {
            throw new \InvalidArgumentException('non-nullable is_deletable cannot be null');
        }
        $this->container['is_deletable'] = $is_deletable;

        return $this;
    }

    /**
     * Gets is_reversed
     *
     * @return bool|null
     */
    public function getIsReversed()
    {
        return $this->container['is_reversed'];
    }

    /**
     * Sets is_reversed
     *
     * @param bool|null $is_reversed is_reversed
     *
     * @return self
     */
    public function setIsReversed($is_reversed)
    {
        if (is_null($is_reversed)) {
            throw new \InvalidArgumentException('non-nullable is_reversed cannot be null');
        }
        $this->container['is_reversed'] = $is_reversed;

        return $this;
    }

    /**
     * Gets delete_message
     *
     * @return string|null
     */
    public function getDeleteMessage()
    {
        return $this->container['delete_message'];
    }

    /**
     * Sets delete_message
     *
     * @param string|null $delete_message delete_message
     *
     * @return self
     */
    public function setDeleteMessage($delete_message)
    {
        if (is_null($delete_message)) {
            throw new \InvalidArgumentException('non-nullable delete_message cannot be null');
        }
        $this->container['delete_message'] = $delete_message;

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


