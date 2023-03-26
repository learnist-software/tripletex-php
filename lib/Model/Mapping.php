<?php
/**
 * Mapping
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
 * Mapping Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Mapping implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Mapping';

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
        'year' => 'int',
        'type' => 'string',
        'post' => 'string',
        'sub_post' => 'string',
        'group_number' => 'string',
        'negate' => 'bool',
        'exclude_from_tax_return' => 'bool',
        'grouping_enk' => 'string',
        'grouping_as' => 'string',
        'grouping_ans' => 'string',
        'negate_previous_year' => 'bool',
        'exclude_from_tax_return_previous_year' => 'bool',
        'grouping_enk_previous_year' => 'string',
        'grouping_as_previous_year' => 'string',
        'grouping_ans_previous_year' => 'string'
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
        'year' => 'int32',
        'type' => null,
        'post' => null,
        'sub_post' => null,
        'group_number' => null,
        'negate' => null,
        'exclude_from_tax_return' => null,
        'grouping_enk' => null,
        'grouping_as' => null,
        'grouping_ans' => null,
        'negate_previous_year' => null,
        'exclude_from_tax_return_previous_year' => null,
        'grouping_enk_previous_year' => null,
        'grouping_as_previous_year' => null,
        'grouping_ans_previous_year' => null
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
		'year' => false,
		'type' => false,
		'post' => false,
		'sub_post' => false,
		'group_number' => false,
		'negate' => false,
		'exclude_from_tax_return' => false,
		'grouping_enk' => false,
		'grouping_as' => false,
		'grouping_ans' => false,
		'negate_previous_year' => false,
		'exclude_from_tax_return_previous_year' => false,
		'grouping_enk_previous_year' => false,
		'grouping_as_previous_year' => false,
		'grouping_ans_previous_year' => false
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
        'year' => 'year',
        'type' => 'type',
        'post' => 'post',
        'sub_post' => 'subPost',
        'group_number' => 'groupNumber',
        'negate' => 'negate',
        'exclude_from_tax_return' => 'excludeFromTaxReturn',
        'grouping_enk' => 'groupingEnk',
        'grouping_as' => 'groupingAs',
        'grouping_ans' => 'groupingAns',
        'negate_previous_year' => 'negatePreviousYear',
        'exclude_from_tax_return_previous_year' => 'excludeFromTaxReturnPreviousYear',
        'grouping_enk_previous_year' => 'groupingEnkPreviousYear',
        'grouping_as_previous_year' => 'groupingAsPreviousYear',
        'grouping_ans_previous_year' => 'groupingAnsPreviousYear'
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
        'year' => 'setYear',
        'type' => 'setType',
        'post' => 'setPost',
        'sub_post' => 'setSubPost',
        'group_number' => 'setGroupNumber',
        'negate' => 'setNegate',
        'exclude_from_tax_return' => 'setExcludeFromTaxReturn',
        'grouping_enk' => 'setGroupingEnk',
        'grouping_as' => 'setGroupingAs',
        'grouping_ans' => 'setGroupingAns',
        'negate_previous_year' => 'setNegatePreviousYear',
        'exclude_from_tax_return_previous_year' => 'setExcludeFromTaxReturnPreviousYear',
        'grouping_enk_previous_year' => 'setGroupingEnkPreviousYear',
        'grouping_as_previous_year' => 'setGroupingAsPreviousYear',
        'grouping_ans_previous_year' => 'setGroupingAnsPreviousYear'
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
        'year' => 'getYear',
        'type' => 'getType',
        'post' => 'getPost',
        'sub_post' => 'getSubPost',
        'group_number' => 'getGroupNumber',
        'negate' => 'getNegate',
        'exclude_from_tax_return' => 'getExcludeFromTaxReturn',
        'grouping_enk' => 'getGroupingEnk',
        'grouping_as' => 'getGroupingAs',
        'grouping_ans' => 'getGroupingAns',
        'negate_previous_year' => 'getNegatePreviousYear',
        'exclude_from_tax_return_previous_year' => 'getExcludeFromTaxReturnPreviousYear',
        'grouping_enk_previous_year' => 'getGroupingEnkPreviousYear',
        'grouping_as_previous_year' => 'getGroupingAsPreviousYear',
        'grouping_ans_previous_year' => 'getGroupingAnsPreviousYear'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('year', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('post', $data ?? [], null);
        $this->setIfExists('sub_post', $data ?? [], null);
        $this->setIfExists('group_number', $data ?? [], null);
        $this->setIfExists('negate', $data ?? [], null);
        $this->setIfExists('exclude_from_tax_return', $data ?? [], null);
        $this->setIfExists('grouping_enk', $data ?? [], null);
        $this->setIfExists('grouping_as', $data ?? [], null);
        $this->setIfExists('grouping_ans', $data ?? [], null);
        $this->setIfExists('negate_previous_year', $data ?? [], null);
        $this->setIfExists('exclude_from_tax_return_previous_year', $data ?? [], null);
        $this->setIfExists('grouping_enk_previous_year', $data ?? [], null);
        $this->setIfExists('grouping_as_previous_year', $data ?? [], null);
        $this->setIfExists('grouping_ans_previous_year', $data ?? [], null);
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

        if (!is_null($this->container['type']) && (mb_strlen($this->container['type']) > 255)) {
            $invalidProperties[] = "invalid value for 'type', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['post']) && (mb_strlen($this->container['post']) > 255)) {
            $invalidProperties[] = "invalid value for 'post', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['sub_post']) && (mb_strlen($this->container['sub_post']) > 255)) {
            $invalidProperties[] = "invalid value for 'sub_post', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['group_number']) && (mb_strlen($this->container['group_number']) > 255)) {
            $invalidProperties[] = "invalid value for 'group_number', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['grouping_enk']) && (mb_strlen($this->container['grouping_enk']) > 255)) {
            $invalidProperties[] = "invalid value for 'grouping_enk', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['grouping_as']) && (mb_strlen($this->container['grouping_as']) > 255)) {
            $invalidProperties[] = "invalid value for 'grouping_as', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['grouping_ans']) && (mb_strlen($this->container['grouping_ans']) > 255)) {
            $invalidProperties[] = "invalid value for 'grouping_ans', the character length must be smaller than or equal to 255.";
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
     * Gets year
     *
     * @return int|null
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int|null $year year
     *
     * @return self
     */
    public function setYear($year)
    {
        if (is_null($year)) {
            throw new \InvalidArgumentException('non-nullable year cannot be null');
        }
        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        if ((mb_strlen($type) > 255)) {
            throw new \InvalidArgumentException('invalid length for $type when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets post
     *
     * @return string|null
     */
    public function getPost()
    {
        return $this->container['post'];
    }

    /**
     * Sets post
     *
     * @param string|null $post post
     *
     * @return self
     */
    public function setPost($post)
    {
        if (is_null($post)) {
            throw new \InvalidArgumentException('non-nullable post cannot be null');
        }
        if ((mb_strlen($post) > 255)) {
            throw new \InvalidArgumentException('invalid length for $post when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['post'] = $post;

        return $this;
    }

    /**
     * Gets sub_post
     *
     * @return string|null
     */
    public function getSubPost()
    {
        return $this->container['sub_post'];
    }

    /**
     * Sets sub_post
     *
     * @param string|null $sub_post sub_post
     *
     * @return self
     */
    public function setSubPost($sub_post)
    {
        if (is_null($sub_post)) {
            throw new \InvalidArgumentException('non-nullable sub_post cannot be null');
        }
        if ((mb_strlen($sub_post) > 255)) {
            throw new \InvalidArgumentException('invalid length for $sub_post when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['sub_post'] = $sub_post;

        return $this;
    }

    /**
     * Gets group_number
     *
     * @return string|null
     */
    public function getGroupNumber()
    {
        return $this->container['group_number'];
    }

    /**
     * Sets group_number
     *
     * @param string|null $group_number group_number
     *
     * @return self
     */
    public function setGroupNumber($group_number)
    {
        if (is_null($group_number)) {
            throw new \InvalidArgumentException('non-nullable group_number cannot be null');
        }
        if ((mb_strlen($group_number) > 255)) {
            throw new \InvalidArgumentException('invalid length for $group_number when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['group_number'] = $group_number;

        return $this;
    }

    /**
     * Gets negate
     *
     * @return bool|null
     */
    public function getNegate()
    {
        return $this->container['negate'];
    }

    /**
     * Sets negate
     *
     * @param bool|null $negate negate
     *
     * @return self
     */
    public function setNegate($negate)
    {
        if (is_null($negate)) {
            throw new \InvalidArgumentException('non-nullable negate cannot be null');
        }
        $this->container['negate'] = $negate;

        return $this;
    }

    /**
     * Gets exclude_from_tax_return
     *
     * @return bool|null
     */
    public function getExcludeFromTaxReturn()
    {
        return $this->container['exclude_from_tax_return'];
    }

    /**
     * Sets exclude_from_tax_return
     *
     * @param bool|null $exclude_from_tax_return exclude_from_tax_return
     *
     * @return self
     */
    public function setExcludeFromTaxReturn($exclude_from_tax_return)
    {
        if (is_null($exclude_from_tax_return)) {
            throw new \InvalidArgumentException('non-nullable exclude_from_tax_return cannot be null');
        }
        $this->container['exclude_from_tax_return'] = $exclude_from_tax_return;

        return $this;
    }

    /**
     * Gets grouping_enk
     *
     * @return string|null
     */
    public function getGroupingEnk()
    {
        return $this->container['grouping_enk'];
    }

    /**
     * Sets grouping_enk
     *
     * @param string|null $grouping_enk grouping_enk
     *
     * @return self
     */
    public function setGroupingEnk($grouping_enk)
    {
        if (is_null($grouping_enk)) {
            throw new \InvalidArgumentException('non-nullable grouping_enk cannot be null');
        }
        if ((mb_strlen($grouping_enk) > 255)) {
            throw new \InvalidArgumentException('invalid length for $grouping_enk when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['grouping_enk'] = $grouping_enk;

        return $this;
    }

    /**
     * Gets grouping_as
     *
     * @return string|null
     */
    public function getGroupingAs()
    {
        return $this->container['grouping_as'];
    }

    /**
     * Sets grouping_as
     *
     * @param string|null $grouping_as grouping_as
     *
     * @return self
     */
    public function setGroupingAs($grouping_as)
    {
        if (is_null($grouping_as)) {
            throw new \InvalidArgumentException('non-nullable grouping_as cannot be null');
        }
        if ((mb_strlen($grouping_as) > 255)) {
            throw new \InvalidArgumentException('invalid length for $grouping_as when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['grouping_as'] = $grouping_as;

        return $this;
    }

    /**
     * Gets grouping_ans
     *
     * @return string|null
     */
    public function getGroupingAns()
    {
        return $this->container['grouping_ans'];
    }

    /**
     * Sets grouping_ans
     *
     * @param string|null $grouping_ans grouping_ans
     *
     * @return self
     */
    public function setGroupingAns($grouping_ans)
    {
        if (is_null($grouping_ans)) {
            throw new \InvalidArgumentException('non-nullable grouping_ans cannot be null');
        }
        if ((mb_strlen($grouping_ans) > 255)) {
            throw new \InvalidArgumentException('invalid length for $grouping_ans when calling Mapping., must be smaller than or equal to 255.');
        }

        $this->container['grouping_ans'] = $grouping_ans;

        return $this;
    }

    /**
     * Gets negate_previous_year
     *
     * @return bool|null
     */
    public function getNegatePreviousYear()
    {
        return $this->container['negate_previous_year'];
    }

    /**
     * Sets negate_previous_year
     *
     * @param bool|null $negate_previous_year negate_previous_year
     *
     * @return self
     */
    public function setNegatePreviousYear($negate_previous_year)
    {
        if (is_null($negate_previous_year)) {
            throw new \InvalidArgumentException('non-nullable negate_previous_year cannot be null');
        }
        $this->container['negate_previous_year'] = $negate_previous_year;

        return $this;
    }

    /**
     * Gets exclude_from_tax_return_previous_year
     *
     * @return bool|null
     */
    public function getExcludeFromTaxReturnPreviousYear()
    {
        return $this->container['exclude_from_tax_return_previous_year'];
    }

    /**
     * Sets exclude_from_tax_return_previous_year
     *
     * @param bool|null $exclude_from_tax_return_previous_year exclude_from_tax_return_previous_year
     *
     * @return self
     */
    public function setExcludeFromTaxReturnPreviousYear($exclude_from_tax_return_previous_year)
    {
        if (is_null($exclude_from_tax_return_previous_year)) {
            throw new \InvalidArgumentException('non-nullable exclude_from_tax_return_previous_year cannot be null');
        }
        $this->container['exclude_from_tax_return_previous_year'] = $exclude_from_tax_return_previous_year;

        return $this;
    }

    /**
     * Gets grouping_enk_previous_year
     *
     * @return string|null
     */
    public function getGroupingEnkPreviousYear()
    {
        return $this->container['grouping_enk_previous_year'];
    }

    /**
     * Sets grouping_enk_previous_year
     *
     * @param string|null $grouping_enk_previous_year grouping_enk_previous_year
     *
     * @return self
     */
    public function setGroupingEnkPreviousYear($grouping_enk_previous_year)
    {
        if (is_null($grouping_enk_previous_year)) {
            throw new \InvalidArgumentException('non-nullable grouping_enk_previous_year cannot be null');
        }
        $this->container['grouping_enk_previous_year'] = $grouping_enk_previous_year;

        return $this;
    }

    /**
     * Gets grouping_as_previous_year
     *
     * @return string|null
     */
    public function getGroupingAsPreviousYear()
    {
        return $this->container['grouping_as_previous_year'];
    }

    /**
     * Sets grouping_as_previous_year
     *
     * @param string|null $grouping_as_previous_year grouping_as_previous_year
     *
     * @return self
     */
    public function setGroupingAsPreviousYear($grouping_as_previous_year)
    {
        if (is_null($grouping_as_previous_year)) {
            throw new \InvalidArgumentException('non-nullable grouping_as_previous_year cannot be null');
        }
        $this->container['grouping_as_previous_year'] = $grouping_as_previous_year;

        return $this;
    }

    /**
     * Gets grouping_ans_previous_year
     *
     * @return string|null
     */
    public function getGroupingAnsPreviousYear()
    {
        return $this->container['grouping_ans_previous_year'];
    }

    /**
     * Sets grouping_ans_previous_year
     *
     * @param string|null $grouping_ans_previous_year grouping_ans_previous_year
     *
     * @return self
     */
    public function setGroupingAnsPreviousYear($grouping_ans_previous_year)
    {
        if (is_null($grouping_ans_previous_year)) {
            throw new \InvalidArgumentException('non-nullable grouping_ans_previous_year cannot be null');
        }
        $this->container['grouping_ans_previous_year'] = $grouping_ans_previous_year;

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


