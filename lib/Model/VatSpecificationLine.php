<?php
/**
 * VatSpecificationLine
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
 * VatSpecificationLine Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class VatSpecificationLine implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'VatSpecificationLine';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'vat_returns2022_dto' => '\Learnist\Tripletex\Model\VatReturns2022',
        'id' => 'int',
        'standard_code' => 'int',
        'user_comment' => 'string',
        'structured_comment' => 'string',
        'rate' => 'object',
        'basis' => 'object',
        'vat_amount' => 'object',
        'is_reversable' => 'bool',
        'expected_sign' => 'string',
        'specification_type' => 'string',
        'vat_type' => '\Learnist\Tripletex\Model\VatType'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'vat_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'vat_returns2022_dto' => false,
		'id' => false,
		'standard_code' => false,
		'user_comment' => false,
		'structured_comment' => false,
		'rate' => false,
		'basis' => false,
		'vat_amount' => false,
		'is_reversable' => false,
		'expected_sign' => false,
		'specification_type' => false,
		'vat_type' => false
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
        'vat_type' => 'vatType'
    ];

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
        'vat_type' => 'setVatType'
    ];

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
        'vat_type' => 'getVatType'
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

    public const EXPECTED_SIGN_ZERO = 'ZERO';
    public const EXPECTED_SIGN_POSITIVE = 'POSITIVE';
    public const EXPECTED_SIGN_NEGATIVE = 'NEGATIVE';
    public const SPECIFICATION_TYPE__DEFAULT = 'DEFAULT';
    public const SPECIFICATION_TYPE_LOSS_OF_CLAIM = 'LOSS_OF_CLAIM';
    public const SPECIFICATION_TYPE_WITHDRAWAL = 'WITHDRAWAL';
    public const SPECIFICATION_TYPE_ADJUSTMENT = 'ADJUSTMENT';
    public const SPECIFICATION_TYPE_REVERSAL = 'REVERSAL';
    public const SPECIFICATION_TYPE_COMPENSATION = 'COMPENSATION';

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
            self::EXPECTED_SIGN_NEGATIVE,
        ];
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
            self::SPECIFICATION_TYPE_COMPENSATION,
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
        $this->setIfExists('vat_returns2022_dto', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('standard_code', $data ?? [], null);
        $this->setIfExists('user_comment', $data ?? [], null);
        $this->setIfExists('structured_comment', $data ?? [], null);
        $this->setIfExists('rate', $data ?? [], null);
        $this->setIfExists('basis', $data ?? [], null);
        $this->setIfExists('vat_amount', $data ?? [], null);
        $this->setIfExists('is_reversable', $data ?? [], null);
        $this->setIfExists('expected_sign', $data ?? [], null);
        $this->setIfExists('specification_type', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
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

        if (!is_null($this->container['structured_comment']) && (mb_strlen($this->container['structured_comment']) > 255)) {
            $invalidProperties[] = "invalid value for 'structured_comment', the character length must be smaller than or equal to 255.";
        }

        $allowedValues = $this->getExpectedSignAllowableValues();
        if (!is_null($this->container['expected_sign']) && !in_array($this->container['expected_sign'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'expected_sign', must be one of '%s'",
                $this->container['expected_sign'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSpecificationTypeAllowableValues();
        if (!is_null($this->container['specification_type']) && !in_array($this->container['specification_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'specification_type', must be one of '%s'",
                $this->container['specification_type'],
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
     * @return \Learnist\Tripletex\Model\VatReturns2022|null
     */
    public function getVatReturns2022Dto()
    {
        return $this->container['vat_returns2022_dto'];
    }

    /**
     * Sets vat_returns2022_dto
     *
     * @param \Learnist\Tripletex\Model\VatReturns2022|null $vat_returns2022_dto vat_returns2022_dto
     *
     * @return self
     */
    public function setVatReturns2022Dto($vat_returns2022_dto)
    {
        if (is_null($vat_returns2022_dto)) {
            throw new \InvalidArgumentException('non-nullable vat_returns2022_dto cannot be null');
        }
        $this->container['vat_returns2022_dto'] = $vat_returns2022_dto;

        return $this;
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
     * Gets standard_code
     *
     * @return int|null
     */
    public function getStandardCode()
    {
        return $this->container['standard_code'];
    }

    /**
     * Sets standard_code
     *
     * @param int|null $standard_code The SAF-T code
     *
     * @return self
     */
    public function setStandardCode($standard_code)
    {
        if (is_null($standard_code)) {
            throw new \InvalidArgumentException('non-nullable standard_code cannot be null');
        }
        $this->container['standard_code'] = $standard_code;

        return $this;
    }

    /**
     * Gets user_comment
     *
     * @return string|null
     */
    public function getUserComment()
    {
        return $this->container['user_comment'];
    }

    /**
     * Sets user_comment
     *
     * @param string|null $user_comment User comment
     *
     * @return self
     */
    public function setUserComment($user_comment)
    {
        if (is_null($user_comment)) {
            throw new \InvalidArgumentException('non-nullable user_comment cannot be null');
        }
        $this->container['user_comment'] = $user_comment;

        return $this;
    }

    /**
     * Gets structured_comment
     *
     * @return string|null
     */
    public function getStructuredComment()
    {
        return $this->container['structured_comment'];
    }

    /**
     * Sets structured_comment
     *
     * @param string|null $structured_comment Pre-generated structured comment
     *
     * @return self
     */
    public function setStructuredComment($structured_comment)
    {
        if (is_null($structured_comment)) {
            throw new \InvalidArgumentException('non-nullable structured_comment cannot be null');
        }
        if ((mb_strlen($structured_comment) > 255)) {
            throw new \InvalidArgumentException('invalid length for $structured_comment when calling VatSpecificationLine., must be smaller than or equal to 255.');
        }

        $this->container['structured_comment'] = $structured_comment;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return object|null
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param object|null $rate rate
     *
     * @return self
     */
    public function setRate($rate)
    {
        if (is_null($rate)) {
            throw new \InvalidArgumentException('non-nullable rate cannot be null');
        }
        $this->container['rate'] = $rate;

        return $this;
    }

    /**
     * Gets basis
     *
     * @return object|null
     */
    public function getBasis()
    {
        return $this->container['basis'];
    }

    /**
     * Sets basis
     *
     * @param object|null $basis basis
     *
     * @return self
     */
    public function setBasis($basis)
    {
        if (is_null($basis)) {
            throw new \InvalidArgumentException('non-nullable basis cannot be null');
        }
        $this->container['basis'] = $basis;

        return $this;
    }

    /**
     * Gets vat_amount
     *
     * @return object|null
     */
    public function getVatAmount()
    {
        return $this->container['vat_amount'];
    }

    /**
     * Sets vat_amount
     *
     * @param object|null $vat_amount vat_amount
     *
     * @return self
     */
    public function setVatAmount($vat_amount)
    {
        if (is_null($vat_amount)) {
            throw new \InvalidArgumentException('non-nullable vat_amount cannot be null');
        }
        $this->container['vat_amount'] = $vat_amount;

        return $this;
    }

    /**
     * Gets is_reversable
     *
     * @return bool|null
     */
    public function getIsReversable()
    {
        return $this->container['is_reversable'];
    }

    /**
     * Sets is_reversable
     *
     * @param bool|null $is_reversable Is Reversable
     *
     * @return self
     */
    public function setIsReversable($is_reversable)
    {
        if (is_null($is_reversable)) {
            throw new \InvalidArgumentException('non-nullable is_reversable cannot be null');
        }
        $this->container['is_reversable'] = $is_reversable;

        return $this;
    }

    /**
     * Gets expected_sign
     *
     * @return string|null
     */
    public function getExpectedSign()
    {
        return $this->container['expected_sign'];
    }

    /**
     * Sets expected_sign
     *
     * @param string|null $expected_sign Expected delivery sign
     *
     * @return self
     */
    public function setExpectedSign($expected_sign)
    {
        if (is_null($expected_sign)) {
            throw new \InvalidArgumentException('non-nullable expected_sign cannot be null');
        }
        $allowedValues = $this->getExpectedSignAllowableValues();
        if (!in_array($expected_sign, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'expected_sign', must be one of '%s'",
                    $expected_sign,
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
     * @return string|null
     */
    public function getSpecificationType()
    {
        return $this->container['specification_type'];
    }

    /**
     * Sets specification_type
     *
     * @param string|null $specification_type Vat specificationType
     *
     * @return self
     */
    public function setSpecificationType($specification_type)
    {
        if (is_null($specification_type)) {
            throw new \InvalidArgumentException('non-nullable specification_type cannot be null');
        }
        $allowedValues = $this->getSpecificationTypeAllowableValues();
        if (!in_array($specification_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'specification_type', must be one of '%s'",
                    $specification_type,
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
     * @return \Learnist\Tripletex\Model\VatType|null
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType|null $vat_type vat_type
     *
     * @return self
     */
    public function setVatType($vat_type)
    {
        if (is_null($vat_type)) {
            throw new \InvalidArgumentException('non-nullable vat_type cannot be null');
        }
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


