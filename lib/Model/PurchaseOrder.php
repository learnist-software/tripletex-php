<?php
/**
 * PurchaseOrder
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
 * PurchaseOrder Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PurchaseOrder implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PurchaseOrder';

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
'number' => 'string',
'receiver_email' => 'string',
'discount' => 'float',
'internal_comment' => 'string',
'packing_note_message' => 'string',
'transporter_message' => 'string',
'comments' => 'string',
'supplier' => '\Learnist\Tripletex\Model\Supplier',
'delivery_date' => 'string',
'received_date' => 'string',
'order_lines' => '\Learnist\Tripletex\Model\PurchaseOrderline[]',
'project' => '\Learnist\Tripletex\Model\Project',
'department' => '\Learnist\Tripletex\Model\Department',
'delivery_address' => '\Learnist\Tripletex\Model\Address',
'creation_date' => 'string',
'is_closed' => 'bool',
'our_contact' => '\Learnist\Tripletex\Model\Employee',
'supplier_contact' => '\Learnist\Tripletex\Model\Employee',
'attention' => '\Learnist\Tripletex\Model\Employee',
'status' => 'string',
'currency' => '\Learnist\Tripletex\Model\Currency',
'restorder' => '\Learnist\Tripletex\Model\PurchaseOrder',
'transport_type' => '\Learnist\Tripletex\Model\TransportType',
'pickup_point' => '\Learnist\Tripletex\Model\PickupPoint',
'document' => '\Learnist\Tripletex\Model\Document',
'attachment' => '\Learnist\Tripletex\Model\Document',
'edi_document' => '\Learnist\Tripletex\Model\Document',
'last_sent_timestamp' => 'string',
'last_sent_employee_name' => 'string'    ];

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
'number' => null,
'receiver_email' => null,
'discount' => null,
'internal_comment' => null,
'packing_note_message' => null,
'transporter_message' => null,
'comments' => null,
'supplier' => null,
'delivery_date' => null,
'received_date' => null,
'order_lines' => null,
'project' => null,
'department' => null,
'delivery_address' => null,
'creation_date' => null,
'is_closed' => null,
'our_contact' => null,
'supplier_contact' => null,
'attention' => null,
'status' => null,
'currency' => null,
'restorder' => null,
'transport_type' => null,
'pickup_point' => null,
'document' => null,
'attachment' => null,
'edi_document' => null,
'last_sent_timestamp' => null,
'last_sent_employee_name' => null    ];

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
'number' => 'number',
'receiver_email' => 'receiverEmail',
'discount' => 'discount',
'internal_comment' => 'internalComment',
'packing_note_message' => 'packingNoteMessage',
'transporter_message' => 'transporterMessage',
'comments' => 'comments',
'supplier' => 'supplier',
'delivery_date' => 'deliveryDate',
'received_date' => 'receivedDate',
'order_lines' => 'orderLines',
'project' => 'project',
'department' => 'department',
'delivery_address' => 'deliveryAddress',
'creation_date' => 'creationDate',
'is_closed' => 'isClosed',
'our_contact' => 'ourContact',
'supplier_contact' => 'supplierContact',
'attention' => 'attention',
'status' => 'status',
'currency' => 'currency',
'restorder' => 'restorder',
'transport_type' => 'transportType',
'pickup_point' => 'pickupPoint',
'document' => 'document',
'attachment' => 'attachment',
'edi_document' => 'ediDocument',
'last_sent_timestamp' => 'lastSentTimestamp',
'last_sent_employee_name' => 'lastSentEmployeeName'    ];

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
'number' => 'setNumber',
'receiver_email' => 'setReceiverEmail',
'discount' => 'setDiscount',
'internal_comment' => 'setInternalComment',
'packing_note_message' => 'setPackingNoteMessage',
'transporter_message' => 'setTransporterMessage',
'comments' => 'setComments',
'supplier' => 'setSupplier',
'delivery_date' => 'setDeliveryDate',
'received_date' => 'setReceivedDate',
'order_lines' => 'setOrderLines',
'project' => 'setProject',
'department' => 'setDepartment',
'delivery_address' => 'setDeliveryAddress',
'creation_date' => 'setCreationDate',
'is_closed' => 'setIsClosed',
'our_contact' => 'setOurContact',
'supplier_contact' => 'setSupplierContact',
'attention' => 'setAttention',
'status' => 'setStatus',
'currency' => 'setCurrency',
'restorder' => 'setRestorder',
'transport_type' => 'setTransportType',
'pickup_point' => 'setPickupPoint',
'document' => 'setDocument',
'attachment' => 'setAttachment',
'edi_document' => 'setEdiDocument',
'last_sent_timestamp' => 'setLastSentTimestamp',
'last_sent_employee_name' => 'setLastSentEmployeeName'    ];

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
'number' => 'getNumber',
'receiver_email' => 'getReceiverEmail',
'discount' => 'getDiscount',
'internal_comment' => 'getInternalComment',
'packing_note_message' => 'getPackingNoteMessage',
'transporter_message' => 'getTransporterMessage',
'comments' => 'getComments',
'supplier' => 'getSupplier',
'delivery_date' => 'getDeliveryDate',
'received_date' => 'getReceivedDate',
'order_lines' => 'getOrderLines',
'project' => 'getProject',
'department' => 'getDepartment',
'delivery_address' => 'getDeliveryAddress',
'creation_date' => 'getCreationDate',
'is_closed' => 'getIsClosed',
'our_contact' => 'getOurContact',
'supplier_contact' => 'getSupplierContact',
'attention' => 'getAttention',
'status' => 'getStatus',
'currency' => 'getCurrency',
'restorder' => 'getRestorder',
'transport_type' => 'getTransportType',
'pickup_point' => 'getPickupPoint',
'document' => 'getDocument',
'attachment' => 'getAttachment',
'edi_document' => 'getEdiDocument',
'last_sent_timestamp' => 'getLastSentTimestamp',
'last_sent_employee_name' => 'getLastSentEmployeeName'    ];

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

    const STATUS_OPEN = 'STATUS_OPEN';
const STATUS_SENT = 'STATUS_SENT';
const STATUS_RECEIVING = 'STATUS_RECEIVING';
const STATUS_CONFIRMED_DEVIATION_DETECTED = 'STATUS_CONFIRMED_DEVIATION_DETECTED';
const STATUS_DEVIATION_OPEN = 'STATUS_DEVIATION_OPEN';
const STATUS_DEVIATION_CONFIRMED = 'STATUS_DEVIATION_CONFIRMED';
const STATUS_CLOSED = 'STATUS_CLOSED';
const STATUS_CANCELLED = 'STATUS_CANCELLED';
const STATUS_CONFIRMED = 'STATUS_CONFIRMED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_OPEN,
self::STATUS_SENT,
self::STATUS_RECEIVING,
self::STATUS_CONFIRMED_DEVIATION_DETECTED,
self::STATUS_DEVIATION_OPEN,
self::STATUS_DEVIATION_CONFIRMED,
self::STATUS_CLOSED,
self::STATUS_CANCELLED,
self::STATUS_CONFIRMED,        ];
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
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['receiver_email'] = isset($data['receiver_email']) ? $data['receiver_email'] : null;
        $this->container['discount'] = isset($data['discount']) ? $data['discount'] : null;
        $this->container['internal_comment'] = isset($data['internal_comment']) ? $data['internal_comment'] : null;
        $this->container['packing_note_message'] = isset($data['packing_note_message']) ? $data['packing_note_message'] : null;
        $this->container['transporter_message'] = isset($data['transporter_message']) ? $data['transporter_message'] : null;
        $this->container['comments'] = isset($data['comments']) ? $data['comments'] : null;
        $this->container['supplier'] = isset($data['supplier']) ? $data['supplier'] : null;
        $this->container['delivery_date'] = isset($data['delivery_date']) ? $data['delivery_date'] : null;
        $this->container['received_date'] = isset($data['received_date']) ? $data['received_date'] : null;
        $this->container['order_lines'] = isset($data['order_lines']) ? $data['order_lines'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['delivery_address'] = isset($data['delivery_address']) ? $data['delivery_address'] : null;
        $this->container['creation_date'] = isset($data['creation_date']) ? $data['creation_date'] : null;
        $this->container['is_closed'] = isset($data['is_closed']) ? $data['is_closed'] : null;
        $this->container['our_contact'] = isset($data['our_contact']) ? $data['our_contact'] : null;
        $this->container['supplier_contact'] = isset($data['supplier_contact']) ? $data['supplier_contact'] : null;
        $this->container['attention'] = isset($data['attention']) ? $data['attention'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['restorder'] = isset($data['restorder']) ? $data['restorder'] : null;
        $this->container['transport_type'] = isset($data['transport_type']) ? $data['transport_type'] : null;
        $this->container['pickup_point'] = isset($data['pickup_point']) ? $data['pickup_point'] : null;
        $this->container['document'] = isset($data['document']) ? $data['document'] : null;
        $this->container['attachment'] = isset($data['attachment']) ? $data['attachment'] : null;
        $this->container['edi_document'] = isset($data['edi_document']) ? $data['edi_document'] : null;
        $this->container['last_sent_timestamp'] = isset($data['last_sent_timestamp']) ? $data['last_sent_timestamp'] : null;
        $this->container['last_sent_employee_name'] = isset($data['last_sent_employee_name']) ? $data['last_sent_employee_name'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['supplier'] === null) {
            $invalidProperties[] = "'supplier' can't be null";
        }
        if ($this->container['delivery_date'] === null) {
            $invalidProperties[] = "'delivery_date' can't be null";
        }
        if ($this->container['our_contact'] === null) {
            $invalidProperties[] = "'our_contact' can't be null";
        }
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
     * Gets number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string $number Purchase order number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets receiver_email
     *
     * @return string
     */
    public function getReceiverEmail()
    {
        return $this->container['receiver_email'];
    }

    /**
     * Sets receiver_email
     *
     * @param string $receiver_email Email when purchase order is send by email.
     *
     * @return $this
     */
    public function setReceiverEmail($receiver_email)
    {
        $this->container['receiver_email'] = $receiver_email;

        return $this;
    }

    /**
     * Gets discount
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param float $discount Discount Percentage
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->container['discount'] = $discount;

        return $this;
    }

    /**
     * Gets internal_comment
     *
     * @return string
     */
    public function getInternalComment()
    {
        return $this->container['internal_comment'];
    }

    /**
     * Sets internal_comment
     *
     * @param string $internal_comment internal_comment
     *
     * @return $this
     */
    public function setInternalComment($internal_comment)
    {
        $this->container['internal_comment'] = $internal_comment;

        return $this;
    }

    /**
     * Gets packing_note_message
     *
     * @return string
     */
    public function getPackingNoteMessage()
    {
        return $this->container['packing_note_message'];
    }

    /**
     * Sets packing_note_message
     *
     * @param string $packing_note_message Message on packing note.Wholesaler specific.
     *
     * @return $this
     */
    public function setPackingNoteMessage($packing_note_message)
    {
        $this->container['packing_note_message'] = $packing_note_message;

        return $this;
    }

    /**
     * Gets transporter_message
     *
     * @return string
     */
    public function getTransporterMessage()
    {
        return $this->container['transporter_message'];
    }

    /**
     * Sets transporter_message
     *
     * @param string $transporter_message Message to transporter.Wholesaler specific.
     *
     * @return $this
     */
    public function setTransporterMessage($transporter_message)
    {
        $this->container['transporter_message'] = $transporter_message;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param string $comments Delivery information and invoice comments
     *
     * @return $this
     */
    public function setComments($comments)
    {
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets supplier
     *
     * @return \Learnist\Tripletex\Model\Supplier
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Learnist\Tripletex\Model\Supplier $supplier supplier
     *
     * @return $this
     */
    public function setSupplier($supplier)
    {
        $this->container['supplier'] = $supplier;

        return $this;
    }

    /**
     * Gets delivery_date
     *
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->container['delivery_date'];
    }

    /**
     * Sets delivery_date
     *
     * @param string $delivery_date delivery_date
     *
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->container['delivery_date'] = $delivery_date;

        return $this;
    }

    /**
     * Gets received_date
     *
     * @return string
     */
    public function getReceivedDate()
    {
        return $this->container['received_date'];
    }

    /**
     * Sets received_date
     *
     * @param string $received_date received_date
     *
     * @return $this
     */
    public function setReceivedDate($received_date)
    {
        $this->container['received_date'] = $received_date;

        return $this;
    }

    /**
     * Gets order_lines
     *
     * @return \Learnist\Tripletex\Model\PurchaseOrderline[]
     */
    public function getOrderLines()
    {
        return $this->container['order_lines'];
    }

    /**
     * Sets order_lines
     *
     * @param \Learnist\Tripletex\Model\PurchaseOrderline[] $order_lines Order lines tied to the purchase order
     *
     * @return $this
     */
    public function setOrderLines($order_lines)
    {
        $this->container['order_lines'] = $order_lines;

        return $this;
    }

    /**
     * Gets project
     *
     * @return \Learnist\Tripletex\Model\Project
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param \Learnist\Tripletex\Model\Project $project project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department $department department
     *
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets delivery_address
     *
     * @return \Learnist\Tripletex\Model\Address
     */
    public function getDeliveryAddress()
    {
        return $this->container['delivery_address'];
    }

    /**
     * Sets delivery_address
     *
     * @param \Learnist\Tripletex\Model\Address $delivery_address delivery_address
     *
     * @return $this
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->container['delivery_address'] = $delivery_address;

        return $this;
    }

    /**
     * Gets creation_date
     *
     * @return string
     */
    public function getCreationDate()
    {
        return $this->container['creation_date'];
    }

    /**
     * Sets creation_date
     *
     * @param string $creation_date creation_date
     *
     * @return $this
     */
    public function setCreationDate($creation_date)
    {
        $this->container['creation_date'] = $creation_date;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool $is_closed is_closed
     *
     * @return $this
     */
    public function setIsClosed($is_closed)
    {
        $this->container['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Gets our_contact
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getOurContact()
    {
        return $this->container['our_contact'];
    }

    /**
     * Sets our_contact
     *
     * @param \Learnist\Tripletex\Model\Employee $our_contact our_contact
     *
     * @return $this
     */
    public function setOurContact($our_contact)
    {
        $this->container['our_contact'] = $our_contact;

        return $this;
    }

    /**
     * Gets supplier_contact
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getSupplierContact()
    {
        return $this->container['supplier_contact'];
    }

    /**
     * Sets supplier_contact
     *
     * @param \Learnist\Tripletex\Model\Employee $supplier_contact supplier_contact
     *
     * @return $this
     */
    public function setSupplierContact($supplier_contact)
    {
        $this->container['supplier_contact'] = $supplier_contact;

        return $this;
    }

    /**
     * Gets attention
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getAttention()
    {
        return $this->container['attention'];
    }

    /**
     * Sets attention
     *
     * @param \Learnist\Tripletex\Model\Employee $attention attention
     *
     * @return $this
     */
    public function setAttention($attention)
    {
        $this->container['attention'] = $attention;

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
     * @param string $status status
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
     * Gets restorder
     *
     * @return \Learnist\Tripletex\Model\PurchaseOrder
     */
    public function getRestorder()
    {
        return $this->container['restorder'];
    }

    /**
     * Sets restorder
     *
     * @param \Learnist\Tripletex\Model\PurchaseOrder $restorder restorder
     *
     * @return $this
     */
    public function setRestorder($restorder)
    {
        $this->container['restorder'] = $restorder;

        return $this;
    }

    /**
     * Gets transport_type
     *
     * @return \Learnist\Tripletex\Model\TransportType
     */
    public function getTransportType()
    {
        return $this->container['transport_type'];
    }

    /**
     * Sets transport_type
     *
     * @param \Learnist\Tripletex\Model\TransportType $transport_type transport_type
     *
     * @return $this
     */
    public function setTransportType($transport_type)
    {
        $this->container['transport_type'] = $transport_type;

        return $this;
    }

    /**
     * Gets pickup_point
     *
     * @return \Learnist\Tripletex\Model\PickupPoint
     */
    public function getPickupPoint()
    {
        return $this->container['pickup_point'];
    }

    /**
     * Sets pickup_point
     *
     * @param \Learnist\Tripletex\Model\PickupPoint $pickup_point pickup_point
     *
     * @return $this
     */
    public function setPickupPoint($pickup_point)
    {
        $this->container['pickup_point'] = $pickup_point;

        return $this;
    }

    /**
     * Gets document
     *
     * @return \Learnist\Tripletex\Model\Document
     */
    public function getDocument()
    {
        return $this->container['document'];
    }

    /**
     * Sets document
     *
     * @param \Learnist\Tripletex\Model\Document $document document
     *
     * @return $this
     */
    public function setDocument($document)
    {
        $this->container['document'] = $document;

        return $this;
    }

    /**
     * Gets attachment
     *
     * @return \Learnist\Tripletex\Model\Document
     */
    public function getAttachment()
    {
        return $this->container['attachment'];
    }

    /**
     * Sets attachment
     *
     * @param \Learnist\Tripletex\Model\Document $attachment attachment
     *
     * @return $this
     */
    public function setAttachment($attachment)
    {
        $this->container['attachment'] = $attachment;

        return $this;
    }

    /**
     * Gets edi_document
     *
     * @return \Learnist\Tripletex\Model\Document
     */
    public function getEdiDocument()
    {
        return $this->container['edi_document'];
    }

    /**
     * Sets edi_document
     *
     * @param \Learnist\Tripletex\Model\Document $edi_document edi_document
     *
     * @return $this
     */
    public function setEdiDocument($edi_document)
    {
        $this->container['edi_document'] = $edi_document;

        return $this;
    }

    /**
     * Gets last_sent_timestamp
     *
     * @return string
     */
    public function getLastSentTimestamp()
    {
        return $this->container['last_sent_timestamp'];
    }

    /**
     * Sets last_sent_timestamp
     *
     * @param string $last_sent_timestamp last_sent_timestamp
     *
     * @return $this
     */
    public function setLastSentTimestamp($last_sent_timestamp)
    {
        $this->container['last_sent_timestamp'] = $last_sent_timestamp;

        return $this;
    }

    /**
     * Gets last_sent_employee_name
     *
     * @return string
     */
    public function getLastSentEmployeeName()
    {
        return $this->container['last_sent_employee_name'];
    }

    /**
     * Sets last_sent_employee_name
     *
     * @param string $last_sent_employee_name last_sent_employee_name
     *
     * @return $this
     */
    public function setLastSentEmployeeName($last_sent_employee_name)
    {
        $this->container['last_sent_employee_name'] = $last_sent_employee_name;

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
