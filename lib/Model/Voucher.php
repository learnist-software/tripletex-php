<?php
/**
 * Voucher
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
 * Voucher Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Voucher implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Voucher';

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
'date' => 'string',
'number' => 'int',
'temp_number' => 'int',
'year' => 'int',
'description' => 'string',
'voucher_type' => '\Learnist\Tripletex\Model\VoucherType',
'reverse_voucher' => '\Learnist\Tripletex\Model\Voucher',
'postings' => '\Learnist\Tripletex\Model\Posting[]',
'document' => '\Learnist\Tripletex\Model\Document',
'attachment' => '\Learnist\Tripletex\Model\Document',
'external_voucher_number' => 'string',
'edi_document' => '\Learnist\Tripletex\Model\Document',
'supplier_voucher_type' => 'string'    ];

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
'date' => null,
'number' => 'int32',
'temp_number' => 'int32',
'year' => 'int32',
'description' => null,
'voucher_type' => null,
'reverse_voucher' => null,
'postings' => null,
'document' => null,
'attachment' => null,
'external_voucher_number' => null,
'edi_document' => null,
'supplier_voucher_type' => null    ];

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
'date' => 'date',
'number' => 'number',
'temp_number' => 'tempNumber',
'year' => 'year',
'description' => 'description',
'voucher_type' => 'voucherType',
'reverse_voucher' => 'reverseVoucher',
'postings' => 'postings',
'document' => 'document',
'attachment' => 'attachment',
'external_voucher_number' => 'externalVoucherNumber',
'edi_document' => 'ediDocument',
'supplier_voucher_type' => 'supplierVoucherType'    ];

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
'date' => 'setDate',
'number' => 'setNumber',
'temp_number' => 'setTempNumber',
'year' => 'setYear',
'description' => 'setDescription',
'voucher_type' => 'setVoucherType',
'reverse_voucher' => 'setReverseVoucher',
'postings' => 'setPostings',
'document' => 'setDocument',
'attachment' => 'setAttachment',
'external_voucher_number' => 'setExternalVoucherNumber',
'edi_document' => 'setEdiDocument',
'supplier_voucher_type' => 'setSupplierVoucherType'    ];

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
'date' => 'getDate',
'number' => 'getNumber',
'temp_number' => 'getTempNumber',
'year' => 'getYear',
'description' => 'getDescription',
'voucher_type' => 'getVoucherType',
'reverse_voucher' => 'getReverseVoucher',
'postings' => 'getPostings',
'document' => 'getDocument',
'attachment' => 'getAttachment',
'external_voucher_number' => 'getExternalVoucherNumber',
'edi_document' => 'getEdiDocument',
'supplier_voucher_type' => 'getSupplierVoucherType'    ];

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

    const SUPPLIER_VOUCHER_TYPE_SIMPLE = 'TYPE_SUPPLIER_INVOICE_SIMPLE';
const SUPPLIER_VOUCHER_TYPE_DETAILED = 'TYPE_SUPPLIER_INVOICE_DETAILED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSupplierVoucherTypeAllowableValues()
    {
        return [
            self::SUPPLIER_VOUCHER_TYPE_SIMPLE,
self::SUPPLIER_VOUCHER_TYPE_DETAILED,        ];
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
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['temp_number'] = isset($data['temp_number']) ? $data['temp_number'] : null;
        $this->container['year'] = isset($data['year']) ? $data['year'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['voucher_type'] = isset($data['voucher_type']) ? $data['voucher_type'] : null;
        $this->container['reverse_voucher'] = isset($data['reverse_voucher']) ? $data['reverse_voucher'] : null;
        $this->container['postings'] = isset($data['postings']) ? $data['postings'] : null;
        $this->container['document'] = isset($data['document']) ? $data['document'] : null;
        $this->container['attachment'] = isset($data['attachment']) ? $data['attachment'] : null;
        $this->container['external_voucher_number'] = isset($data['external_voucher_number']) ? $data['external_voucher_number'] : null;
        $this->container['edi_document'] = isset($data['edi_document']) ? $data['edi_document'] : null;
        $this->container['supplier_voucher_type'] = isset($data['supplier_voucher_type']) ? $data['supplier_voucher_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['date'] === null) {
            $invalidProperties[] = "'date' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['postings'] === null) {
            $invalidProperties[] = "'postings' can't be null";
        }
        $allowedValues = $this->getSupplierVoucherTypeAllowableValues();
        if (!is_null($this->container['supplier_voucher_type']) && !in_array($this->container['supplier_voucher_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'supplier_voucher_type', must be one of '%s'",
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
     * Gets number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param int $number System generated number that cannot be changed.
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets temp_number
     *
     * @return int
     */
    public function getTempNumber()
    {
        return $this->container['temp_number'];
    }

    /**
     * Sets temp_number
     *
     * @param int $temp_number Temporary voucher number.
     *
     * @return $this
     */
    public function setTempNumber($temp_number)
    {
        $this->container['temp_number'] = $temp_number;

        return $this;
    }

    /**
     * Gets year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int $year System generated number that cannot be changed.
     *
     * @return $this
     */
    public function setYear($year)
    {
        $this->container['year'] = $year;

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
     * Gets voucher_type
     *
     * @return \Learnist\Tripletex\Model\VoucherType
     */
    public function getVoucherType()
    {
        return $this->container['voucher_type'];
    }

    /**
     * Sets voucher_type
     *
     * @param \Learnist\Tripletex\Model\VoucherType $voucher_type voucher_type
     *
     * @return $this
     */
    public function setVoucherType($voucher_type)
    {
        $this->container['voucher_type'] = $voucher_type;

        return $this;
    }

    /**
     * Gets reverse_voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher
     */
    public function getReverseVoucher()
    {
        return $this->container['reverse_voucher'];
    }

    /**
     * Sets reverse_voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher $reverse_voucher reverse_voucher
     *
     * @return $this
     */
    public function setReverseVoucher($reverse_voucher)
    {
        $this->container['reverse_voucher'] = $reverse_voucher;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting[]
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting[] $postings postings
     *
     * @return $this
     */
    public function setPostings($postings)
    {
        $this->container['postings'] = $postings;

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
     * Gets external_voucher_number
     *
     * @return string
     */
    public function getExternalVoucherNumber()
    {
        return $this->container['external_voucher_number'];
    }

    /**
     * Sets external_voucher_number
     *
     * @param string $external_voucher_number External voucher number.
     *
     * @return $this
     */
    public function setExternalVoucherNumber($external_voucher_number)
    {
        $this->container['external_voucher_number'] = $external_voucher_number;

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
     * Gets supplier_voucher_type
     *
     * @return string
     */
    public function getSupplierVoucherType()
    {
        return $this->container['supplier_voucher_type'];
    }

    /**
     * Sets supplier_voucher_type
     *
     * @param string $supplier_voucher_type Supplier voucher type - simple and detailed.
     *
     * @return $this
     */
    public function setSupplierVoucherType($supplier_voucher_type)
    {
        $allowedValues = $this->getSupplierVoucherTypeAllowableValues();
        if (!is_null($supplier_voucher_type) && !in_array($supplier_voucher_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'supplier_voucher_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['supplier_voucher_type'] = $supplier_voucher_type;

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
