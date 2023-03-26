<?php
/**
 * VatReturns2022
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
 * VatReturns2022 Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class VatReturns2022 implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'VatReturns2022';

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
        'total_amount_vat_to_pay' => 'object',
        'remaining_amount_vat_to_pay' => 'object',
        'is_paid' => 'bool'
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
        'is_paid' => null
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
		'start' => false,
		'closed_date' => false,
		'end' => false,
		'status' => false,
		'user_comment' => false,
		'structured_comment' => false,
		'vat_groups' => false,
		'voucher' => false,
		'altinn_metadata' => false,
		'receipt_id' => false,
		'total_amount_vat_to_pay' => false,
		'remaining_amount_vat_to_pay' => false,
		'is_paid' => false
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
        'is_paid' => 'isPaid'
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
        'is_paid' => 'setIsPaid'
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
        'is_paid' => 'getIsPaid'
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

    public const STATUS_NOT_STARTED = 'NOT_STARTED';
    public const STATUS_INSTANCE_CREATED = 'INSTANCE_CREATED';
    public const STATUS_VAT_ENVELOPE_DELIVERED = 'VAT_ENVELOPE_DELIVERED';
    public const STATUS_VAT_RETURNS_DELIVERED = 'VAT_RETURNS_DELIVERED';
    public const STATUS_ATTACHMENTS_DELIVERED = 'ATTACHMENTS_DELIVERED';
    public const STATUS_FILLING_COMPLETE = 'FILLING_COMPLETE';
    public const STATUS_SENDING_COMPLETE = 'SENDING_COMPLETE';
    public const STATUS_FEEDBACK_RECEIVED = 'FEEDBACK_RECEIVED';
    public const STATUS_MANUAL_DELIVERY = 'MANUAL_DELIVERY';
    public const STATUS_USER_FORBIDDEN = 'USER_FORBIDDEN';
    public const STATUS_SENDING_FAILED = 'SENDING_FAILED';

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
            self::STATUS_SENDING_FAILED,
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
        $this->setIfExists('start', $data ?? [], null);
        $this->setIfExists('closed_date', $data ?? [], null);
        $this->setIfExists('end', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('user_comment', $data ?? [], null);
        $this->setIfExists('structured_comment', $data ?? [], null);
        $this->setIfExists('vat_groups', $data ?? [], null);
        $this->setIfExists('voucher', $data ?? [], null);
        $this->setIfExists('altinn_metadata', $data ?? [], null);
        $this->setIfExists('receipt_id', $data ?? [], null);
        $this->setIfExists('total_amount_vat_to_pay', $data ?? [], null);
        $this->setIfExists('remaining_amount_vat_to_pay', $data ?? [], null);
        $this->setIfExists('is_paid', $data ?? [], null);
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

        if (!is_null($this->container['structured_comment']) && (mb_strlen($this->container['structured_comment']) > 255)) {
            $invalidProperties[] = "invalid value for 'structured_comment', the character length must be smaller than or equal to 255.";
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
     * Gets start
     *
     * @return string|null
     */
    public function getStart()
    {
        return $this->container['start'];
    }

    /**
     * Sets start
     *
     * @param string|null $start start
     *
     * @return self
     */
    public function setStart($start)
    {
        if (is_null($start)) {
            throw new \InvalidArgumentException('non-nullable start cannot be null');
        }
        $this->container['start'] = $start;

        return $this;
    }

    /**
     * Gets closed_date
     *
     * @return string|null
     */
    public function getClosedDate()
    {
        return $this->container['closed_date'];
    }

    /**
     * Sets closed_date
     *
     * @param string|null $closed_date closed_date
     *
     * @return self
     */
    public function setClosedDate($closed_date)
    {
        if (is_null($closed_date)) {
            throw new \InvalidArgumentException('non-nullable closed_date cannot be null');
        }
        $this->container['closed_date'] = $closed_date;

        return $this;
    }

    /**
     * Gets end
     *
     * @return string|null
     */
    public function getEnd()
    {
        return $this->container['end'];
    }

    /**
     * Sets end
     *
     * @param string|null $end end
     *
     * @return self
     */
    public function setEnd($end)
    {
        if (is_null($end)) {
            throw new \InvalidArgumentException('non-nullable end cannot be null');
        }
        $this->container['end'] = $end;

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
     * @param string|null $status The current instance status of the vatReturns.
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
     * @param string|null $user_comment user_comment
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
     * @param string|null $structured_comment structured_comment
     *
     * @return self
     */
    public function setStructuredComment($structured_comment)
    {
        if (is_null($structured_comment)) {
            throw new \InvalidArgumentException('non-nullable structured_comment cannot be null');
        }
        if ((mb_strlen($structured_comment) > 255)) {
            throw new \InvalidArgumentException('invalid length for $structured_comment when calling VatReturns2022., must be smaller than or equal to 255.');
        }

        $this->container['structured_comment'] = $structured_comment;

        return $this;
    }

    /**
     * Gets vat_groups
     *
     * @return \Learnist\Tripletex\Model\VatSpecificationGroup[]|null
     */
    public function getVatGroups()
    {
        return $this->container['vat_groups'];
    }

    /**
     * Sets vat_groups
     *
     * @param \Learnist\Tripletex\Model\VatSpecificationGroup[]|null $vat_groups vat_groups
     *
     * @return self
     */
    public function setVatGroups($vat_groups)
    {
        if (is_null($vat_groups)) {
            throw new \InvalidArgumentException('non-nullable vat_groups cannot be null');
        }
        $this->container['vat_groups'] = $vat_groups;

        return $this;
    }

    /**
     * Gets voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher|null
     */
    public function getVoucher()
    {
        return $this->container['voucher'];
    }

    /**
     * Sets voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher|null $voucher voucher
     *
     * @return self
     */
    public function setVoucher($voucher)
    {
        if (is_null($voucher)) {
            throw new \InvalidArgumentException('non-nullable voucher cannot be null');
        }
        $this->container['voucher'] = $voucher;

        return $this;
    }

    /**
     * Gets altinn_metadata
     *
     * @return \Learnist\Tripletex\Model\AltinnInstance|null
     */
    public function getAltinnMetadata()
    {
        return $this->container['altinn_metadata'];
    }

    /**
     * Sets altinn_metadata
     *
     * @param \Learnist\Tripletex\Model\AltinnInstance|null $altinn_metadata altinn_metadata
     *
     * @return self
     */
    public function setAltinnMetadata($altinn_metadata)
    {
        if (is_null($altinn_metadata)) {
            throw new \InvalidArgumentException('non-nullable altinn_metadata cannot be null');
        }
        $this->container['altinn_metadata'] = $altinn_metadata;

        return $this;
    }

    /**
     * Gets receipt_id
     *
     * @return int|null
     */
    public function getReceiptId()
    {
        return $this->container['receipt_id'];
    }

    /**
     * Sets receipt_id
     *
     * @param int|null $receipt_id Attachment for vat return
     *
     * @return self
     */
    public function setReceiptId($receipt_id)
    {
        if (is_null($receipt_id)) {
            throw new \InvalidArgumentException('non-nullable receipt_id cannot be null');
        }
        $this->container['receipt_id'] = $receipt_id;

        return $this;
    }

    /**
     * Gets total_amount_vat_to_pay
     *
     * @return object|null
     */
    public function getTotalAmountVatToPay()
    {
        return $this->container['total_amount_vat_to_pay'];
    }

    /**
     * Sets total_amount_vat_to_pay
     *
     * @param object|null $total_amount_vat_to_pay total_amount_vat_to_pay
     *
     * @return self
     */
    public function setTotalAmountVatToPay($total_amount_vat_to_pay)
    {
        if (is_null($total_amount_vat_to_pay)) {
            throw new \InvalidArgumentException('non-nullable total_amount_vat_to_pay cannot be null');
        }
        $this->container['total_amount_vat_to_pay'] = $total_amount_vat_to_pay;

        return $this;
    }

    /**
     * Gets remaining_amount_vat_to_pay
     *
     * @return object|null
     */
    public function getRemainingAmountVatToPay()
    {
        return $this->container['remaining_amount_vat_to_pay'];
    }

    /**
     * Sets remaining_amount_vat_to_pay
     *
     * @param object|null $remaining_amount_vat_to_pay remaining_amount_vat_to_pay
     *
     * @return self
     */
    public function setRemainingAmountVatToPay($remaining_amount_vat_to_pay)
    {
        if (is_null($remaining_amount_vat_to_pay)) {
            throw new \InvalidArgumentException('non-nullable remaining_amount_vat_to_pay cannot be null');
        }
        $this->container['remaining_amount_vat_to_pay'] = $remaining_amount_vat_to_pay;

        return $this;
    }

    /**
     * Gets is_paid
     *
     * @return bool|null
     */
    public function getIsPaid()
    {
        return $this->container['is_paid'];
    }

    /**
     * Sets is_paid
     *
     * @param bool|null $is_paid is_paid
     *
     * @return self
     */
    public function setIsPaid($is_paid)
    {
        if (is_null($is_paid)) {
            throw new \InvalidArgumentException('non-nullable is_paid cannot be null');
        }
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


