<?php
/**
 * VatSpecificationLine
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
 * VatSpecificationLine Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class VatSpecificationLine implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'VatSpecificationLine';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'vat_returns2022_dto' => '\Learnist\Tripletex\Model\VatReturns2022',
'id' => 'int',
'standard_code' => 'int',
'user_comment' => 'string',
'structured_comment' => 'string',
'rate' => '\Learnist\Tripletex\Model\TlxNumber',
'basis' => '\Learnist\Tripletex\Model\TlxNumber',
'vat_amount' => '\Learnist\Tripletex\Model\TlxNumber',
'is_reversable' => 'bool',
'expected_sign' => 'string',
'specification_type' => 'string',
'vat_type' => '\Learnist\Tripletex\Model\VatType'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'vat_returns2022_dto' => null,
'id' => 'int32',
'standard_code' => 'int32',
'user_comment' => null,
'structured_comment' => null,
'rate' => null,
'basis' => null,
'vat_amount' => null,
'is_reversable' => null,
'expected_sign' => null,
'specification_type' => null,
'vat_type' => null    ];

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
        'vat_returns2022_dto' => 'vatReturns2022DTO',
'id' => 'id',
'standard_code' => 'standardCode',
'user_comment' => 'userComment',
'structured_comment' => 'structuredComment',
'rate' => 'rate',
'basis' => 'basis',
'vat_amount' => 'vatAmount',
'is_reversable' => 'isReversable',
'expected_sign' => 'expectedSign',
'specification_type' => 'specificationType',
'vat_type' => 'vatType'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'vat_returns2022_dto' => 'setVatReturns2022Dto',
'id' => 'setId',
'standard_code' => 'setStandardCode',
'user_comment' => 'setUserComment',
'structured_comment' => 'setStructuredComment',
'rate' => 'setRate',
'basis' => 'setBasis',
'vat_amount' => 'setVatAmount',
'is_reversable' => 'setIsReversable',
'expected_sign' => 'setExpectedSign',
'specification_type' => 'setSpecificationType',
'vat_type' => 'setVatType'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'vat_returns2022_dto' => 'getVatReturns2022Dto',
'id' => 'getId',
'standard_code' => 'getStandardCode',
'user_comment' => 'getUserComment',
'structured_comment' => 'getStructuredComment',
'rate' => 'getRate',
'basis' => 'getBasis',
'vat_amount' => 'getVatAmount',
'is_reversable' => 'getIsReversable',
'expected_sign' => 'getExpectedSign',
'specification_type' => 'getSpecificationType',
'vat_type' => 'getVatType'    ];

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

    const EXPECTED_SIGN_ZERO = 'ZERO';
const EXPECTED_SIGN_POSITIVE = 'POSITIVE';
const EXPECTED_SIGN_NEGATIVE = 'NEGATIVE';
const SPECIFICATION_TYPE__DEFAULT = 'DEFAULT';
const SPECIFICATION_TYPE_LOSS_OF_CLAIM = 'LOSS_OF_CLAIM';
const SPECIFICATION_TYPE_WITHDRAWAL = 'WITHDRAWAL';
const SPECIFICATION_TYPE_ADJUSTMENT = 'ADJUSTMENT';
const SPECIFICATION_TYPE_REVERSAL = 'REVERSAL';
const SPECIFICATION_TYPE_COMPENSATION = 'COMPENSATION';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getExpectedSignAllowableValues()
    {
        return [
            self::EXPECTED_SIGN_ZERO,
self::EXPECTED_SIGN_POSITIVE,
self::EXPECTED_SIGN_NEGATIVE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSpecificationTypeAllowableValues()
    {
        return [
            self::SPECIFICATION_TYPE__DEFAULT,
self::SPECIFICATION_TYPE_LOSS_OF_CLAIM,
self::SPECIFICATION_TYPE_WITHDRAWAL,
self::SPECIFICATION_TYPE_ADJUSTMENT,
self::SPECIFICATION_TYPE_REVERSAL,
self::SPECIFICATION_TYPE_COMPENSATION,        ];
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
        $this->container['vat_returns2022_dto'] = isset($data['vat_returns2022_dto']) ? $data['vat_returns2022_dto'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['standard_code'] = isset($data['standard_code']) ? $data['standard_code'] : null;
        $this->container['user_comment'] = isset($data['user_comment']) ? $data['user_comment'] : null;
        $this->container['structured_comment'] = isset($data['structured_comment']) ? $data['structured_comment'] : null;
        $this->container['rate'] = isset($data['rate']) ? $data['rate'] : null;
        $this->container['basis'] = isset($data['basis']) ? $data['basis'] : null;
        $this->container['vat_amount'] = isset($data['vat_amount']) ? $data['vat_amount'] : null;
        $this->container['is_reversable'] = isset($data['is_reversable']) ? $data['is_reversable'] : null;
        $this->container['expected_sign'] = isset($data['expected_sign']) ? $data['expected_sign'] : null;
        $this->container['specification_type'] = isset($data['specification_type']) ? $data['specification_type'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getExpectedSignAllowableValues();
        if (!is_null($this->container['expected_sign']) && !in_array($this->container['expected_sign'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'expected_sign', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSpecificationTypeAllowableValues();
        if (!is_null($this->container['specification_type']) && !in_array($this->container['specification_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'specification_type', must be one of '%s'",
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
     * Gets vat_returns2022_dto
     *
     * @return \Learnist\Tripletex\Model\VatReturns2022
     */
    public function getVatReturns2022Dto()
    {
        return $this->container['vat_returns2022_dto'];
    }

    /**
     * Sets vat_returns2022_dto
     *
     * @param \Learnist\Tripletex\Model\VatReturns2022 $vat_returns2022_dto vat_returns2022_dto
     *
     * @return $this
     */
    public function setVatReturns2022Dto($vat_returns2022_dto)
    {
        $this->container['vat_returns2022_dto'] = $vat_returns2022_dto;

        return $this;
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
     * Gets standard_code
     *
     * @return int
     */
    public function getStandardCode()
    {
        return $this->container['standard_code'];
    }

    /**
     * Sets standard_code
     *
     * @param int $standard_code The SAF-T code
     *
     * @return $this
     */
    public function setStandardCode($standard_code)
    {
        $this->container['standard_code'] = $standard_code;

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
     * @param string $user_comment User comment
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
     * @param string $structured_comment Pre-generated structured comment
     *
     * @return $this
     */
    public function setStructuredComment($structured_comment)
    {
        $this->container['structured_comment'] = $structured_comment;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $rate rate
     *
     * @return $this
     */
    public function setRate($rate)
    {
        $this->container['rate'] = $rate;

        return $this;
    }

    /**
     * Gets basis
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getBasis()
    {
        return $this->container['basis'];
    }

    /**
     * Sets basis
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $basis basis
     *
     * @return $this
     */
    public function setBasis($basis)
    {
        $this->container['basis'] = $basis;

        return $this;
    }

    /**
     * Gets vat_amount
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getVatAmount()
    {
        return $this->container['vat_amount'];
    }

    /**
     * Sets vat_amount
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $vat_amount vat_amount
     *
     * @return $this
     */
    public function setVatAmount($vat_amount)
    {
        $this->container['vat_amount'] = $vat_amount;

        return $this;
    }

    /**
     * Gets is_reversable
     *
     * @return bool
     */
    public function getIsReversable()
    {
        return $this->container['is_reversable'];
    }

    /**
     * Sets is_reversable
     *
     * @param bool $is_reversable Is Reversable
     *
     * @return $this
     */
    public function setIsReversable($is_reversable)
    {
        $this->container['is_reversable'] = $is_reversable;

        return $this;
    }

    /**
     * Gets expected_sign
     *
     * @return string
     */
    public function getExpectedSign()
    {
        return $this->container['expected_sign'];
    }

    /**
     * Sets expected_sign
     *
     * @param string $expected_sign Expected delivery sign
     *
     * @return $this
     */
    public function setExpectedSign($expected_sign)
    {
        $allowedValues = $this->getExpectedSignAllowableValues();
        if (!is_null($expected_sign) && !in_array($expected_sign, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'expected_sign', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['expected_sign'] = $expected_sign;

        return $this;
    }

    /**
     * Gets specification_type
     *
     * @return string
     */
    public function getSpecificationType()
    {
        return $this->container['specification_type'];
    }

    /**
     * Sets specification_type
     *
     * @param string $specification_type Vat specificationType
     *
     * @return $this
     */
    public function setSpecificationType($specification_type)
    {
        $allowedValues = $this->getSpecificationTypeAllowableValues();
        if (!is_null($specification_type) && !in_array($specification_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'specification_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['specification_type'] = $specification_type;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType $vat_type vat_type
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

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
