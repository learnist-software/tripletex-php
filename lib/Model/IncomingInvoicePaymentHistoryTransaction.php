<?php
/**
 * IncomingInvoicePaymentHistoryTransaction
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
 * IncomingInvoicePaymentHistoryTransaction Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class IncomingInvoicePaymentHistoryTransaction implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'IncomingInvoicePaymentHistoryTransaction';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'payment_type' => 'string',
'base_voucher_id' => 'int',
'posting_id' => 'int',
'voucher_id' => 'int',
'voucher_number_as_string' => 'string',
'date' => 'string',
'text1' => 'string',
'text2' => 'string',
'text3' => 'string',
'amount_negative' => '\Learnist\Tripletex\Model\TlxNumber',
'amount_currency_negative' => '\Learnist\Tripletex\Model\TlxNumber',
'currency_id' => 'int',
'currency_code' => 'string',
'is_deletable' => 'bool',
'is_reversed' => 'bool',
'delete_message' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'delete_message' => null    ];

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
'delete_message' => 'deleteMessage'    ];

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
'delete_message' => 'setDeleteMessage'    ];

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
'delete_message' => 'getDeleteMessage'    ];

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

    const PAYMENT_TYPE_NOT_PAID = 'NOT_PAID';
const PAYMENT_TYPE_NETS = 'NETS';
const PAYMENT_TYPE_AUTOPAY = 'AUTOPAY';
const PAYMENT_TYPE_POSTING_RULE = 'POSTING_RULE';
const PAYMENT_TYPE_ZTL = 'ZTL';

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
self::PAYMENT_TYPE_ZTL,        ];
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
        $this->container['payment_type'] = isset($data['payment_type']) ? $data['payment_type'] : null;
        $this->container['base_voucher_id'] = isset($data['base_voucher_id']) ? $data['base_voucher_id'] : null;
        $this->container['posting_id'] = isset($data['posting_id']) ? $data['posting_id'] : null;
        $this->container['voucher_id'] = isset($data['voucher_id']) ? $data['voucher_id'] : null;
        $this->container['voucher_number_as_string'] = isset($data['voucher_number_as_string']) ? $data['voucher_number_as_string'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['text1'] = isset($data['text1']) ? $data['text1'] : null;
        $this->container['text2'] = isset($data['text2']) ? $data['text2'] : null;
        $this->container['text3'] = isset($data['text3']) ? $data['text3'] : null;
        $this->container['amount_negative'] = isset($data['amount_negative']) ? $data['amount_negative'] : null;
        $this->container['amount_currency_negative'] = isset($data['amount_currency_negative']) ? $data['amount_currency_negative'] : null;
        $this->container['currency_id'] = isset($data['currency_id']) ? $data['currency_id'] : null;
        $this->container['currency_code'] = isset($data['currency_code']) ? $data['currency_code'] : null;
        $this->container['is_deletable'] = isset($data['is_deletable']) ? $data['is_deletable'] : null;
        $this->container['is_reversed'] = isset($data['is_reversed']) ? $data['is_reversed'] : null;
        $this->container['delete_message'] = isset($data['delete_message']) ? $data['delete_message'] : null;
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
                "invalid value for 'payment_type', must be one of '%s'",
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
     * @return string
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string $payment_type payment_type
     *
     * @return $this
     */
    public function setPaymentType($payment_type)
    {
        $allowedValues = $this->getPaymentTypeAllowableValues();
        if (!is_null($payment_type) && !in_array($payment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'payment_type', must be one of '%s'",
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
     * @return int
     */
    public function getBaseVoucherId()
    {
        return $this->container['base_voucher_id'];
    }

    /**
     * Sets base_voucher_id
     *
     * @param int $base_voucher_id base_voucher_id
     *
     * @return $this
     */
    public function setBaseVoucherId($base_voucher_id)
    {
        $this->container['base_voucher_id'] = $base_voucher_id;

        return $this;
    }

    /**
     * Gets posting_id
     *
     * @return int
     */
    public function getPostingId()
    {
        return $this->container['posting_id'];
    }

    /**
     * Sets posting_id
     *
     * @param int $posting_id posting_id
     *
     * @return $this
     */
    public function setPostingId($posting_id)
    {
        $this->container['posting_id'] = $posting_id;

        return $this;
    }

    /**
     * Gets voucher_id
     *
     * @return int
     */
    public function getVoucherId()
    {
        return $this->container['voucher_id'];
    }

    /**
     * Sets voucher_id
     *
     * @param int $voucher_id voucher_id
     *
     * @return $this
     */
    public function setVoucherId($voucher_id)
    {
        $this->container['voucher_id'] = $voucher_id;

        return $this;
    }

    /**
     * Gets voucher_number_as_string
     *
     * @return string
     */
    public function getVoucherNumberAsString()
    {
        return $this->container['voucher_number_as_string'];
    }

    /**
     * Sets voucher_number_as_string
     *
     * @param string $voucher_number_as_string voucher_number_as_string
     *
     * @return $this
     */
    public function setVoucherNumberAsString($voucher_number_as_string)
    {
        $this->container['voucher_number_as_string'] = $voucher_number_as_string;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets text1
     *
     * @return string
     */
    public function getText1()
    {
        return $this->container['text1'];
    }

    /**
     * Sets text1
     *
     * @param string $text1 text1
     *
     * @return $this
     */
    public function setText1($text1)
    {
        $this->container['text1'] = $text1;

        return $this;
    }

    /**
     * Gets text2
     *
     * @return string
     */
    public function getText2()
    {
        return $this->container['text2'];
    }

    /**
     * Sets text2
     *
     * @param string $text2 text2
     *
     * @return $this
     */
    public function setText2($text2)
    {
        $this->container['text2'] = $text2;

        return $this;
    }

    /**
     * Gets text3
     *
     * @return string
     */
    public function getText3()
    {
        return $this->container['text3'];
    }

    /**
     * Sets text3
     *
     * @param string $text3 text3
     *
     * @return $this
     */
    public function setText3($text3)
    {
        $this->container['text3'] = $text3;

        return $this;
    }

    /**
     * Gets amount_negative
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getAmountNegative()
    {
        return $this->container['amount_negative'];
    }

    /**
     * Sets amount_negative
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $amount_negative amount_negative
     *
     * @return $this
     */
    public function setAmountNegative($amount_negative)
    {
        $this->container['amount_negative'] = $amount_negative;

        return $this;
    }

    /**
     * Gets amount_currency_negative
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getAmountCurrencyNegative()
    {
        return $this->container['amount_currency_negative'];
    }

    /**
     * Sets amount_currency_negative
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $amount_currency_negative amount_currency_negative
     *
     * @return $this
     */
    public function setAmountCurrencyNegative($amount_currency_negative)
    {
        $this->container['amount_currency_negative'] = $amount_currency_negative;

        return $this;
    }

    /**
     * Gets currency_id
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->container['currency_id'];
    }

    /**
     * Sets currency_id
     *
     * @param int $currency_id currency_id
     *
     * @return $this
     */
    public function setCurrencyId($currency_id)
    {
        $this->container['currency_id'] = $currency_id;

        return $this;
    }

    /**
     * Gets currency_code
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->container['currency_code'];
    }

    /**
     * Sets currency_code
     *
     * @param string $currency_code currency_code
     *
     * @return $this
     */
    public function setCurrencyCode($currency_code)
    {
        $this->container['currency_code'] = $currency_code;

        return $this;
    }

    /**
     * Gets is_deletable
     *
     * @return bool
     */
    public function getIsDeletable()
    {
        return $this->container['is_deletable'];
    }

    /**
     * Sets is_deletable
     *
     * @param bool $is_deletable is_deletable
     *
     * @return $this
     */
    public function setIsDeletable($is_deletable)
    {
        $this->container['is_deletable'] = $is_deletable;

        return $this;
    }

    /**
     * Gets is_reversed
     *
     * @return bool
     */
    public function getIsReversed()
    {
        return $this->container['is_reversed'];
    }

    /**
     * Sets is_reversed
     *
     * @param bool $is_reversed is_reversed
     *
     * @return $this
     */
    public function setIsReversed($is_reversed)
    {
        $this->container['is_reversed'] = $is_reversed;

        return $this;
    }

    /**
     * Gets delete_message
     *
     * @return string
     */
    public function getDeleteMessage()
    {
        return $this->container['delete_message'];
    }

    /**
     * Sets delete_message
     *
     * @param string $delete_message delete_message
     *
     * @return $this
     */
    public function setDeleteMessage($delete_message)
    {
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
