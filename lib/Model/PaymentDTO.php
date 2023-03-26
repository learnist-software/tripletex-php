<?php
/**
 * PaymentDTO
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
 * PaymentDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PaymentDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PaymentDTO';

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
'amount_in_account_currency' => 'float'    ];

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
'amount_in_account_currency' => null    ];

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
'amount_in_account_currency' => 'amountInAccountCurrency'    ];

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
'amount_in_account_currency' => 'setAmountInAccountCurrency'    ];

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
'amount_in_account_currency' => 'getAmountInAccountCurrency'    ];

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

    const STATUS_NOT_APPROVED = 'NOT_APPROVED';
const STATUS_APPROVED = 'APPROVED';
const STATUS_SENT_TO_AUTOPAY = 'SENT_TO_AUTOPAY';
const STATUS_RECEIVED_BY_BANK = 'RECEIVED_BY_BANK';
const STATUS_ACCEPTED_BY_BANK = 'ACCEPTED_BY_BANK';
const STATUS_FAILED = 'FAILED';
const STATUS_CANCELLED = 'CANCELLED';
const STATUS_SUCCESS = 'SUCCESS';
const STATUS_ID__NEW = 'NEW';
const STATUS_ID_PENDING_SIGNING = 'PENDING_SIGNING';
const STATUS_ID_CANCELLED = 'CANCELLED';
const STATUS_ID_ERROR = 'ERROR';
const STATUS_ID_RECEIVED_BY_BANK = 'RECEIVED_BY_BANK';
const STATUS_ID_ACCEPTED_BY_BANK = 'ACCEPTED_BY_BANK';
const STATUS_ID_CANCELLED_IN_BANK = 'CANCELLED_IN_BANK';
const STATUS_ID_REJECTED_BY_BANK = 'REJECTED_BY_BANK';
const STATUS_ID_PAID = 'PAID';
const STATUS_ID_OTHER = 'OTHER';

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
self::STATUS_SUCCESS,        ];
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
self::STATUS_ID_OTHER,        ];
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
        $this->container['payment_date'] = isset($data['payment_date']) ? $data['payment_date'] : null;
        $this->container['booking_date'] = isset($data['booking_date']) ? $data['booking_date'] : null;
        $this->container['value_date'] = isset($data['value_date']) ? $data['value_date'] : null;
        $this->container['amount_currency'] = isset($data['amount_currency']) ? $data['amount_currency'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['creditor_bank_name'] = isset($data['creditor_bank_name']) ? $data['creditor_bank_name'] : null;
        $this->container['creditor_bank_address'] = isset($data['creditor_bank_address']) ? $data['creditor_bank_address'] : null;
        $this->container['creditor_bank_postal_code'] = isset($data['creditor_bank_postal_code']) ? $data['creditor_bank_postal_code'] : null;
        $this->container['creditor_bank_postal_city'] = isset($data['creditor_bank_postal_city']) ? $data['creditor_bank_postal_city'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['status_id'] = isset($data['status_id']) ? $data['status_id'] : null;
        $this->container['is_final_status'] = isset($data['is_final_status']) ? $data['is_final_status'] : null;
        $this->container['is_foreign_payment'] = isset($data['is_foreign_payment']) ? $data['is_foreign_payment'] : null;
        $this->container['is_salary'] = isset($data['is_salary']) ? $data['is_salary'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['kid'] = isset($data['kid']) ? $data['kid'] : null;
        $this->container['receiver_reference'] = isset($data['receiver_reference']) ? $data['receiver_reference'] : null;
        $this->container['source_voucher'] = isset($data['source_voucher']) ? $data['source_voucher'] : null;
        $this->container['postings'] = isset($data['postings']) ? $data['postings'] : null;
        $this->container['account'] = isset($data['account']) ? $data['account'] : null;
        $this->container['amount_in_account_currency'] = isset($data['amount_in_account_currency']) ? $data['amount_in_account_currency'] : null;
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
                "invalid value for 'status', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStatusIdAllowableValues();
        if (!is_null($this->container['status_id']) && !in_array($this->container['status_id'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status_id', must be one of '%s'",
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
     * Gets payment_date
     *
     * @return string
     */
    public function getPaymentDate()
    {
        return $this->container['payment_date'];
    }

    /**
     * Sets payment_date
     *
     * @param string $payment_date payment_date
     *
     * @return $this
     */
    public function setPaymentDate($payment_date)
    {
        $this->container['payment_date'] = $payment_date;

        return $this;
    }

    /**
     * Gets booking_date
     *
     * @return string
     */
    public function getBookingDate()
    {
        return $this->container['booking_date'];
    }

    /**
     * Sets booking_date
     *
     * @param string $booking_date booking_date
     *
     * @return $this
     */
    public function setBookingDate($booking_date)
    {
        $this->container['booking_date'] = $booking_date;

        return $this;
    }

    /**
     * Gets value_date
     *
     * @return string
     */
    public function getValueDate()
    {
        return $this->container['value_date'];
    }

    /**
     * Sets value_date
     *
     * @param string $value_date value_date
     *
     * @return $this
     */
    public function setValueDate($value_date)
    {
        $this->container['value_date'] = $value_date;

        return $this;
    }

    /**
     * Gets amount_currency
     *
     * @return float
     */
    public function getAmountCurrency()
    {
        return $this->container['amount_currency'];
    }

    /**
     * Sets amount_currency
     *
     * @param float $amount_currency In the specified currency.
     *
     * @return $this
     */
    public function setAmountCurrency($amount_currency)
    {
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets creditor_bank_name
     *
     * @return string
     */
    public function getCreditorBankName()
    {
        return $this->container['creditor_bank_name'];
    }

    /**
     * Sets creditor_bank_name
     *
     * @param string $creditor_bank_name creditor_bank_name
     *
     * @return $this
     */
    public function setCreditorBankName($creditor_bank_name)
    {
        $this->container['creditor_bank_name'] = $creditor_bank_name;

        return $this;
    }

    /**
     * Gets creditor_bank_address
     *
     * @return string
     */
    public function getCreditorBankAddress()
    {
        return $this->container['creditor_bank_address'];
    }

    /**
     * Sets creditor_bank_address
     *
     * @param string $creditor_bank_address creditor_bank_address
     *
     * @return $this
     */
    public function setCreditorBankAddress($creditor_bank_address)
    {
        $this->container['creditor_bank_address'] = $creditor_bank_address;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_code
     *
     * @return string
     */
    public function getCreditorBankPostalCode()
    {
        return $this->container['creditor_bank_postal_code'];
    }

    /**
     * Sets creditor_bank_postal_code
     *
     * @param string $creditor_bank_postal_code creditor_bank_postal_code
     *
     * @return $this
     */
    public function setCreditorBankPostalCode($creditor_bank_postal_code)
    {
        $this->container['creditor_bank_postal_code'] = $creditor_bank_postal_code;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_city
     *
     * @return string
     */
    public function getCreditorBankPostalCity()
    {
        return $this->container['creditor_bank_postal_city'];
    }

    /**
     * Sets creditor_bank_postal_city
     *
     * @param string $creditor_bank_postal_city creditor_bank_postal_city
     *
     * @return $this
     */
    public function setCreditorBankPostalCity($creditor_bank_postal_city)
    {
        $this->container['creditor_bank_postal_city'] = $creditor_bank_postal_city;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status The payment status.NOT_APPROVED: Payment not approved yet.<br>APPROVED: Payment approved, but not yet sent to bank.<br>SENT_TO_AUTOPAY: Payment sent to bank.<br>RECEIVED_BY_BANK: Payment received by the bank.<br>ACCEPTED_BY_BANK: Payment that was accepted by the bank.<br>FAILED: Payment that failed.<br>CANCELLED: Cancelled payment.<br>SUCCESS: Payment that ended successfully.<br>
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
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
     * @return string
     */
    public function getStatusId()
    {
        return $this->container['status_id'];
    }

    /**
     * Sets status_id
     *
     * @param string $status_id The payment status Id. Usually all the payments in one batch have the same status ID, at least to the point of being received by bank.NEW: Payment is new.<br>PENDING_SIGNING: Payment is sent to AutoPay but not signed yet, requires re-approving.<br>CANCELLED: Payment was cancelled by ERP.<br>ERROR: Payment that failed.<br>RECEIVED_BY_BANK: Payment was received by the bank.<br>ACCEPTED_BY_BANK: Payment was accepted by bank.<br>CANCELLED_IN_BANK: Payment was cancelled in bank.<br>REJECTED_BY_BANK: Payment was rejected by bank.<br>PAID: Payment is paid.<br>OTHER: In case status in unknown. Will never be a final status.<br>
     *
     * @return $this
     */
    public function setStatusId($status_id)
    {
        $allowedValues = $this->getStatusIdAllowableValues();
        if (!is_null($status_id) && !in_array($status_id, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status_id', must be one of '%s'",
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
     * @return bool
     */
    public function getIsFinalStatus()
    {
        return $this->container['is_final_status'];
    }

    /**
     * Sets is_final_status
     *
     * @param bool $is_final_status is_final_status
     *
     * @return $this
     */
    public function setIsFinalStatus($is_final_status)
    {
        $this->container['is_final_status'] = $is_final_status;

        return $this;
    }

    /**
     * Gets is_foreign_payment
     *
     * @return bool
     */
    public function getIsForeignPayment()
    {
        return $this->container['is_foreign_payment'];
    }

    /**
     * Sets is_foreign_payment
     *
     * @param bool $is_foreign_payment is_foreign_payment
     *
     * @return $this
     */
    public function setIsForeignPayment($is_foreign_payment)
    {
        $this->container['is_foreign_payment'] = $is_foreign_payment;

        return $this;
    }

    /**
     * Gets is_salary
     *
     * @return bool
     */
    public function getIsSalary()
    {
        return $this->container['is_salary'];
    }

    /**
     * Sets is_salary
     *
     * @param bool $is_salary is_salary
     *
     * @return $this
     */
    public function setIsSalary($is_salary)
    {
        $this->container['is_salary'] = $is_salary;

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
     * Gets kid
     *
     * @return string
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string $kid KID - Kundeidentifikasjonsnummer.
     *
     * @return $this
     */
    public function setKid($kid)
    {
        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets receiver_reference
     *
     * @return string
     */
    public function getReceiverReference()
    {
        return $this->container['receiver_reference'];
    }

    /**
     * Sets receiver_reference
     *
     * @param string $receiver_reference receiver_reference
     *
     * @return $this
     */
    public function setReceiverReference($receiver_reference)
    {
        $this->container['receiver_reference'] = $receiver_reference;

        return $this;
    }

    /**
     * Gets source_voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher
     */
    public function getSourceVoucher()
    {
        return $this->container['source_voucher'];
    }

    /**
     * Sets source_voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher $source_voucher source_voucher
     *
     * @return $this
     */
    public function setSourceVoucher($source_voucher)
    {
        $this->container['source_voucher'] = $source_voucher;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting $postings postings
     *
     * @return $this
     */
    public function setPostings($postings)
    {
        $this->container['postings'] = $postings;

        return $this;
    }

    /**
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account $account account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets amount_in_account_currency
     *
     * @return float
     */
    public function getAmountInAccountCurrency()
    {
        return $this->container['amount_in_account_currency'];
    }

    /**
     * Sets amount_in_account_currency
     *
     * @param float $amount_in_account_currency Amount specified in the currency of the bank agreements account.
     *
     * @return $this
     */
    public function setAmountInAccountCurrency($amount_in_account_currency)
    {
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
