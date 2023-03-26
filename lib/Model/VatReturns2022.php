<?php
/**
 * VatReturns2022
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
 * VatReturns2022 Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class VatReturns2022 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'VatReturns2022';

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
'start' => 'string',
'closed_date' => 'string',
'end' => 'string',
'status' => 'string',
'user_comment' => 'string',
'structured_comment' => 'string',
'vat_groups' => '\Learnist\Tripletex\Model\VatSpecificationGroup[]',
'voucher' => '\Learnist\Tripletex\Model\Voucher',
'altinn_metadata' => '\Learnist\Tripletex\Model\AltinnInstance',
'receipt_id' => 'int',
'total_amount_vat_to_pay' => '\Learnist\Tripletex\Model\TlxNumber',
'remaining_amount_vat_to_pay' => '\Learnist\Tripletex\Model\TlxNumber',
'is_paid' => 'bool'    ];

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
'start' => null,
'closed_date' => null,
'end' => null,
'status' => null,
'user_comment' => null,
'structured_comment' => null,
'vat_groups' => null,
'voucher' => null,
'altinn_metadata' => null,
'receipt_id' => 'int32',
'total_amount_vat_to_pay' => null,
'remaining_amount_vat_to_pay' => null,
'is_paid' => null    ];

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
'start' => 'start',
'closed_date' => 'closedDate',
'end' => 'end',
'status' => 'status',
'user_comment' => 'userComment',
'structured_comment' => 'structuredComment',
'vat_groups' => 'vatGroups',
'voucher' => 'voucher',
'altinn_metadata' => 'altinnMetadata',
'receipt_id' => 'receiptId',
'total_amount_vat_to_pay' => 'totalAmountVatToPay',
'remaining_amount_vat_to_pay' => 'remainingAmountVatToPay',
'is_paid' => 'isPaid'    ];

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
'start' => 'setStart',
'closed_date' => 'setClosedDate',
'end' => 'setEnd',
'status' => 'setStatus',
'user_comment' => 'setUserComment',
'structured_comment' => 'setStructuredComment',
'vat_groups' => 'setVatGroups',
'voucher' => 'setVoucher',
'altinn_metadata' => 'setAltinnMetadata',
'receipt_id' => 'setReceiptId',
'total_amount_vat_to_pay' => 'setTotalAmountVatToPay',
'remaining_amount_vat_to_pay' => 'setRemainingAmountVatToPay',
'is_paid' => 'setIsPaid'    ];

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
'start' => 'getStart',
'closed_date' => 'getClosedDate',
'end' => 'getEnd',
'status' => 'getStatus',
'user_comment' => 'getUserComment',
'structured_comment' => 'getStructuredComment',
'vat_groups' => 'getVatGroups',
'voucher' => 'getVoucher',
'altinn_metadata' => 'getAltinnMetadata',
'receipt_id' => 'getReceiptId',
'total_amount_vat_to_pay' => 'getTotalAmountVatToPay',
'remaining_amount_vat_to_pay' => 'getRemainingAmountVatToPay',
'is_paid' => 'getIsPaid'    ];

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

    const STATUS_NOT_STARTED = 'NOT_STARTED';
const STATUS_INSTANCE_CREATED = 'INSTANCE_CREATED';
const STATUS_VAT_ENVELOPE_DELIVERED = 'VAT_ENVELOPE_DELIVERED';
const STATUS_VAT_RETURNS_DELIVERED = 'VAT_RETURNS_DELIVERED';
const STATUS_ATTACHMENTS_DELIVERED = 'ATTACHMENTS_DELIVERED';
const STATUS_FILLING_COMPLETE = 'FILLING_COMPLETE';
const STATUS_SENDING_COMPLETE = 'SENDING_COMPLETE';
const STATUS_FEEDBACK_RECEIVED = 'FEEDBACK_RECEIVED';
const STATUS_MANUAL_DELIVERY = 'MANUAL_DELIVERY';
const STATUS_USER_FORBIDDEN = 'USER_FORBIDDEN';
const STATUS_SENDING_FAILED = 'SENDING_FAILED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_NOT_STARTED,
self::STATUS_INSTANCE_CREATED,
self::STATUS_VAT_ENVELOPE_DELIVERED,
self::STATUS_VAT_RETURNS_DELIVERED,
self::STATUS_ATTACHMENTS_DELIVERED,
self::STATUS_FILLING_COMPLETE,
self::STATUS_SENDING_COMPLETE,
self::STATUS_FEEDBACK_RECEIVED,
self::STATUS_MANUAL_DELIVERY,
self::STATUS_USER_FORBIDDEN,
self::STATUS_SENDING_FAILED,        ];
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
        $this->container['start'] = isset($data['start']) ? $data['start'] : null;
        $this->container['closed_date'] = isset($data['closed_date']) ? $data['closed_date'] : null;
        $this->container['end'] = isset($data['end']) ? $data['end'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['user_comment'] = isset($data['user_comment']) ? $data['user_comment'] : null;
        $this->container['structured_comment'] = isset($data['structured_comment']) ? $data['structured_comment'] : null;
        $this->container['vat_groups'] = isset($data['vat_groups']) ? $data['vat_groups'] : null;
        $this->container['voucher'] = isset($data['voucher']) ? $data['voucher'] : null;
        $this->container['altinn_metadata'] = isset($data['altinn_metadata']) ? $data['altinn_metadata'] : null;
        $this->container['receipt_id'] = isset($data['receipt_id']) ? $data['receipt_id'] : null;
        $this->container['total_amount_vat_to_pay'] = isset($data['total_amount_vat_to_pay']) ? $data['total_amount_vat_to_pay'] : null;
        $this->container['remaining_amount_vat_to_pay'] = isset($data['remaining_amount_vat_to_pay']) ? $data['remaining_amount_vat_to_pay'] : null;
        $this->container['is_paid'] = isset($data['is_paid']) ? $data['is_paid'] : null;
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
     * Gets start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->container['start'];
    }

    /**
     * Sets start
     *
     * @param string $start start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->container['start'] = $start;

        return $this;
    }

    /**
     * Gets closed_date
     *
     * @return string
     */
    public function getClosedDate()
    {
        return $this->container['closed_date'];
    }

    /**
     * Sets closed_date
     *
     * @param string $closed_date closed_date
     *
     * @return $this
     */
    public function setClosedDate($closed_date)
    {
        $this->container['closed_date'] = $closed_date;

        return $this;
    }

    /**
     * Gets end
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->container['end'];
    }

    /**
     * Sets end
     *
     * @param string $end end
     *
     * @return $this
     */
    public function setEnd($end)
    {
        $this->container['end'] = $end;

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
     * @param string $status The current instance status of the vatReturns.
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
     * Gets user_comment
     *
     * @return string
     */
    public function getUserComment()
    {
        return $this->container['user_comment'];
    }

    /**
     * Sets user_comment
     *
     * @param string $user_comment user_comment
     *
     * @return $this
     */
    public function setUserComment($user_comment)
    {
        $this->container['user_comment'] = $user_comment;

        return $this;
    }

    /**
     * Gets structured_comment
     *
     * @return string
     */
    public function getStructuredComment()
    {
        return $this->container['structured_comment'];
    }

    /**
     * Sets structured_comment
     *
     * @param string $structured_comment structured_comment
     *
     * @return $this
     */
    public function setStructuredComment($structured_comment)
    {
        $this->container['structured_comment'] = $structured_comment;

        return $this;
    }

    /**
     * Gets vat_groups
     *
     * @return \Learnist\Tripletex\Model\VatSpecificationGroup[]
     */
    public function getVatGroups()
    {
        return $this->container['vat_groups'];
    }

    /**
     * Sets vat_groups
     *
     * @param \Learnist\Tripletex\Model\VatSpecificationGroup[] $vat_groups vat_groups
     *
     * @return $this
     */
    public function setVatGroups($vat_groups)
    {
        $this->container['vat_groups'] = $vat_groups;

        return $this;
    }

    /**
     * Gets voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher
     */
    public function getVoucher()
    {
        return $this->container['voucher'];
    }

    /**
     * Sets voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher $voucher voucher
     *
     * @return $this
     */
    public function setVoucher($voucher)
    {
        $this->container['voucher'] = $voucher;

        return $this;
    }

    /**
     * Gets altinn_metadata
     *
     * @return \Learnist\Tripletex\Model\AltinnInstance
     */
    public function getAltinnMetadata()
    {
        return $this->container['altinn_metadata'];
    }

    /**
     * Sets altinn_metadata
     *
     * @param \Learnist\Tripletex\Model\AltinnInstance $altinn_metadata altinn_metadata
     *
     * @return $this
     */
    public function setAltinnMetadata($altinn_metadata)
    {
        $this->container['altinn_metadata'] = $altinn_metadata;

        return $this;
    }

    /**
     * Gets receipt_id
     *
     * @return int
     */
    public function getReceiptId()
    {
        return $this->container['receipt_id'];
    }

    /**
     * Sets receipt_id
     *
     * @param int $receipt_id Attachment for vat return
     *
     * @return $this
     */
    public function setReceiptId($receipt_id)
    {
        $this->container['receipt_id'] = $receipt_id;

        return $this;
    }

    /**
     * Gets total_amount_vat_to_pay
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getTotalAmountVatToPay()
    {
        return $this->container['total_amount_vat_to_pay'];
    }

    /**
     * Sets total_amount_vat_to_pay
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $total_amount_vat_to_pay total_amount_vat_to_pay
     *
     * @return $this
     */
    public function setTotalAmountVatToPay($total_amount_vat_to_pay)
    {
        $this->container['total_amount_vat_to_pay'] = $total_amount_vat_to_pay;

        return $this;
    }

    /**
     * Gets remaining_amount_vat_to_pay
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getRemainingAmountVatToPay()
    {
        return $this->container['remaining_amount_vat_to_pay'];
    }

    /**
     * Sets remaining_amount_vat_to_pay
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $remaining_amount_vat_to_pay remaining_amount_vat_to_pay
     *
     * @return $this
     */
    public function setRemainingAmountVatToPay($remaining_amount_vat_to_pay)
    {
        $this->container['remaining_amount_vat_to_pay'] = $remaining_amount_vat_to_pay;

        return $this;
    }

    /**
     * Gets is_paid
     *
     * @return bool
     */
    public function getIsPaid()
    {
        return $this->container['is_paid'];
    }

    /**
     * Sets is_paid
     *
     * @param bool $is_paid is_paid
     *
     * @return $this
     */
    public function setIsPaid($is_paid)
    {
        $this->container['is_paid'] = $is_paid;

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
