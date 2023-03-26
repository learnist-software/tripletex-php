<?php
/**
 * BankReconciliationAdjustment
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
 * BankReconciliationAdjustment Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class BankReconciliationAdjustment implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'BankReconciliationAdjustment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'payment_type' => '\Learnist\Tripletex\Model\BankReconciliationPaymentType',
        'bank_transactions' => '\Learnist\Tripletex\Model\BankTransaction[]',
        'posting_date' => 'string',
        'amount' => 'float',
        'postings' => '\Learnist\Tripletex\Model\Posting[]',
        'bank_reconciliation_match' => '\Learnist\Tripletex\Model\BankReconciliationMatch',
        'date' => 'string',
        'description' => 'string',
        'interim_account' => '\Learnist\Tripletex\Model\Account',
        'voucher_number' => 'string',
        'voucher_view_link' => 'string',
        'voucher_details_link' => 'string'
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
        'bank_transactions' => null,
        'posting_date' => null,
        'amount' => null,
        'postings' => null,
        'bank_reconciliation_match' => null,
        'date' => null,
        'description' => null,
        'interim_account' => null,
        'voucher_number' => null,
        'voucher_view_link' => null,
        'voucher_details_link' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'payment_type' => false,
		'bank_transactions' => false,
		'posting_date' => false,
		'amount' => false,
		'postings' => false,
		'bank_reconciliation_match' => false,
		'date' => false,
		'description' => false,
		'interim_account' => false,
		'voucher_number' => false,
		'voucher_view_link' => false,
		'voucher_details_link' => false
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
        'bank_transactions' => 'bankTransactions',
        'posting_date' => 'postingDate',
        'amount' => 'amount',
        'postings' => 'postings',
        'bank_reconciliation_match' => 'bankReconciliationMatch',
        'date' => 'date',
        'description' => 'description',
        'interim_account' => 'interimAccount',
        'voucher_number' => 'voucherNumber',
        'voucher_view_link' => 'voucherViewLink',
        'voucher_details_link' => 'voucherDetailsLink'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'payment_type' => 'setPaymentType',
        'bank_transactions' => 'setBankTransactions',
        'posting_date' => 'setPostingDate',
        'amount' => 'setAmount',
        'postings' => 'setPostings',
        'bank_reconciliation_match' => 'setBankReconciliationMatch',
        'date' => 'setDate',
        'description' => 'setDescription',
        'interim_account' => 'setInterimAccount',
        'voucher_number' => 'setVoucherNumber',
        'voucher_view_link' => 'setVoucherViewLink',
        'voucher_details_link' => 'setVoucherDetailsLink'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'payment_type' => 'getPaymentType',
        'bank_transactions' => 'getBankTransactions',
        'posting_date' => 'getPostingDate',
        'amount' => 'getAmount',
        'postings' => 'getPostings',
        'bank_reconciliation_match' => 'getBankReconciliationMatch',
        'date' => 'getDate',
        'description' => 'getDescription',
        'interim_account' => 'getInterimAccount',
        'voucher_number' => 'getVoucherNumber',
        'voucher_view_link' => 'getVoucherViewLink',
        'voucher_details_link' => 'getVoucherDetailsLink'
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
        $this->setIfExists('bank_transactions', $data ?? [], null);
        $this->setIfExists('posting_date', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('postings', $data ?? [], null);
        $this->setIfExists('bank_reconciliation_match', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('interim_account', $data ?? [], null);
        $this->setIfExists('voucher_number', $data ?? [], null);
        $this->setIfExists('voucher_view_link', $data ?? [], null);
        $this->setIfExists('voucher_details_link', $data ?? [], null);
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

        if (!is_null($this->container['amount']) && ($this->container['amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'amount', must be bigger than or equal to 0.";
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
     * @return \Learnist\Tripletex\Model\BankReconciliationPaymentType|null
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param \Learnist\Tripletex\Model\BankReconciliationPaymentType|null $payment_type payment_type
     *
     * @return self
     */
    public function setPaymentType($payment_type)
    {
        if (is_null($payment_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type cannot be null');
        }
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets bank_transactions
     *
     * @return \Learnist\Tripletex\Model\BankTransaction[]|null
     */
    public function getBankTransactions()
    {
        return $this->container['bank_transactions'];
    }

    /**
     * Sets bank_transactions
     *
     * @param \Learnist\Tripletex\Model\BankTransaction[]|null $bank_transactions bank_transactions
     *
     * @return self
     */
    public function setBankTransactions($bank_transactions)
    {
        if (is_null($bank_transactions)) {
            throw new \InvalidArgumentException('non-nullable bank_transactions cannot be null');
        }
        $this->container['bank_transactions'] = $bank_transactions;

        return $this;
    }

    /**
     * Gets posting_date
     *
     * @return string|null
     */
    public function getPostingDate()
    {
        return $this->container['posting_date'];
    }

    /**
     * Sets posting_date
     *
     * @param string|null $posting_date posting_date
     *
     * @return self
     */
    public function setPostingDate($posting_date)
    {
        if (is_null($posting_date)) {
            throw new \InvalidArgumentException('non-nullable posting_date cannot be null');
        }
        $this->container['posting_date'] = $posting_date;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return float|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float|null $amount amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (is_null($amount)) {
            throw new \InvalidArgumentException('non-nullable amount cannot be null');
        }

        if (($amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling BankReconciliationAdjustment., must be bigger than or equal to 0.');
        }

        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting[]|null
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting[]|null $postings postings
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
     * Gets bank_reconciliation_match
     *
     * @return \Learnist\Tripletex\Model\BankReconciliationMatch|null
     */
    public function getBankReconciliationMatch()
    {
        return $this->container['bank_reconciliation_match'];
    }

    /**
     * Sets bank_reconciliation_match
     *
     * @param \Learnist\Tripletex\Model\BankReconciliationMatch|null $bank_reconciliation_match bank_reconciliation_match
     *
     * @return self
     */
    public function setBankReconciliationMatch($bank_reconciliation_match)
    {
        if (is_null($bank_reconciliation_match)) {
            throw new \InvalidArgumentException('non-nullable bank_reconciliation_match cannot be null');
        }
        $this->container['bank_reconciliation_match'] = $bank_reconciliation_match;

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
     * Gets interim_account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getInterimAccount()
    {
        return $this->container['interim_account'];
    }

    /**
     * Sets interim_account
     *
     * @param \Learnist\Tripletex\Model\Account|null $interim_account interim_account
     *
     * @return self
     */
    public function setInterimAccount($interim_account)
    {
        if (is_null($interim_account)) {
            throw new \InvalidArgumentException('non-nullable interim_account cannot be null');
        }
        $this->container['interim_account'] = $interim_account;

        return $this;
    }

    /**
     * Gets voucher_number
     *
     * @return string|null
     */
    public function getVoucherNumber()
    {
        return $this->container['voucher_number'];
    }

    /**
     * Sets voucher_number
     *
     * @param string|null $voucher_number voucher_number
     *
     * @return self
     */
    public function setVoucherNumber($voucher_number)
    {
        if (is_null($voucher_number)) {
            throw new \InvalidArgumentException('non-nullable voucher_number cannot be null');
        }
        $this->container['voucher_number'] = $voucher_number;

        return $this;
    }

    /**
     * Gets voucher_view_link
     *
     * @return string|null
     */
    public function getVoucherViewLink()
    {
        return $this->container['voucher_view_link'];
    }

    /**
     * Sets voucher_view_link
     *
     * @param string|null $voucher_view_link voucher_view_link
     *
     * @return self
     */
    public function setVoucherViewLink($voucher_view_link)
    {
        if (is_null($voucher_view_link)) {
            throw new \InvalidArgumentException('non-nullable voucher_view_link cannot be null');
        }
        $this->container['voucher_view_link'] = $voucher_view_link;

        return $this;
    }

    /**
     * Gets voucher_details_link
     *
     * @return string|null
     */
    public function getVoucherDetailsLink()
    {
        return $this->container['voucher_details_link'];
    }

    /**
     * Sets voucher_details_link
     *
     * @param string|null $voucher_details_link voucher_details_link
     *
     * @return self
     */
    public function setVoucherDetailsLink($voucher_details_link)
    {
        if (is_null($voucher_details_link)) {
            throw new \InvalidArgumentException('non-nullable voucher_details_link cannot be null');
        }
        $this->container['voucher_details_link'] = $voucher_details_link;

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


