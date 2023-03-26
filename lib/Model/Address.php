<?php
/**
 * Address
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
 * Address Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Address implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Address';

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
        'address_line1' => 'string',
        'address_line2' => 'string',
        'postal_code' => 'string',
        'city' => 'string',
        'country' => '\Learnist\Tripletex\Model\Country',
        'display_name' => 'string',
        'display_name_inkl_matrikkel' => 'string',
        'knr' => 'int',
        'gnr' => 'int',
        'bnr' => 'int',
        'fnr' => 'int',
        'snr' => 'int',
        'unit_number' => 'string'
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
        'address_line1' => null,
        'address_line2' => null,
        'postal_code' => null,
        'city' => null,
        'country' => null,
        'display_name' => null,
        'display_name_inkl_matrikkel' => null,
        'knr' => 'int32',
        'gnr' => 'int32',
        'bnr' => 'int32',
        'fnr' => 'int32',
        'snr' => 'int32',
        'unit_number' => null
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
		'address_line1' => false,
		'address_line2' => false,
		'postal_code' => false,
		'city' => false,
		'country' => false,
		'display_name' => false,
		'display_name_inkl_matrikkel' => false,
		'knr' => false,
		'gnr' => false,
		'bnr' => false,
		'fnr' => false,
		'snr' => false,
		'unit_number' => false
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
        'address_line1' => 'addressLine1',
        'address_line2' => 'addressLine2',
        'postal_code' => 'postalCode',
        'city' => 'city',
        'country' => 'country',
        'display_name' => 'displayName',
        'display_name_inkl_matrikkel' => 'displayNameInklMatrikkel',
        'knr' => 'knr',
        'gnr' => 'gnr',
        'bnr' => 'bnr',
        'fnr' => 'fnr',
        'snr' => 'snr',
        'unit_number' => 'unitNumber'
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
        'address_line1' => 'setAddressLine1',
        'address_line2' => 'setAddressLine2',
        'postal_code' => 'setPostalCode',
        'city' => 'setCity',
        'country' => 'setCountry',
        'display_name' => 'setDisplayName',
        'display_name_inkl_matrikkel' => 'setDisplayNameInklMatrikkel',
        'knr' => 'setKnr',
        'gnr' => 'setGnr',
        'bnr' => 'setBnr',
        'fnr' => 'setFnr',
        'snr' => 'setSnr',
        'unit_number' => 'setUnitNumber'
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
        'address_line1' => 'getAddressLine1',
        'address_line2' => 'getAddressLine2',
        'postal_code' => 'getPostalCode',
        'city' => 'getCity',
        'country' => 'getCountry',
        'display_name' => 'getDisplayName',
        'display_name_inkl_matrikkel' => 'getDisplayNameInklMatrikkel',
        'knr' => 'getKnr',
        'gnr' => 'getGnr',
        'bnr' => 'getBnr',
        'fnr' => 'getFnr',
        'snr' => 'getSnr',
        'unit_number' => 'getUnitNumber'
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
        $this->setIfExists('address_line1', $data ?? [], null);
        $this->setIfExists('address_line2', $data ?? [], null);
        $this->setIfExists('postal_code', $data ?? [], null);
        $this->setIfExists('city', $data ?? [], null);
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('display_name_inkl_matrikkel', $data ?? [], null);
        $this->setIfExists('knr', $data ?? [], null);
        $this->setIfExists('gnr', $data ?? [], null);
        $this->setIfExists('bnr', $data ?? [], null);
        $this->setIfExists('fnr', $data ?? [], null);
        $this->setIfExists('snr', $data ?? [], null);
        $this->setIfExists('unit_number', $data ?? [], null);
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

        if (!is_null($this->container['address_line1']) && (mb_strlen($this->container['address_line1']) > 255)) {
            $invalidProperties[] = "invalid value for 'address_line1', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['address_line1']) && (mb_strlen($this->container['address_line1']) < 0)) {
            $invalidProperties[] = "invalid value for 'address_line1', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['address_line2']) && (mb_strlen($this->container['address_line2']) > 255)) {
            $invalidProperties[] = "invalid value for 'address_line2', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['address_line2']) && (mb_strlen($this->container['address_line2']) < 0)) {
            $invalidProperties[] = "invalid value for 'address_line2', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['postal_code']) && (mb_strlen($this->container['postal_code']) > 100)) {
            $invalidProperties[] = "invalid value for 'postal_code', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['postal_code']) && (mb_strlen($this->container['postal_code']) < 0)) {
            $invalidProperties[] = "invalid value for 'postal_code', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['city']) && (mb_strlen($this->container['city']) > 100)) {
            $invalidProperties[] = "invalid value for 'city', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['city']) && (mb_strlen($this->container['city']) < 0)) {
            $invalidProperties[] = "invalid value for 'city', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['knr']) && ($this->container['knr'] < 0)) {
            $invalidProperties[] = "invalid value for 'knr', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['gnr']) && ($this->container['gnr'] < 0)) {
            $invalidProperties[] = "invalid value for 'gnr', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['bnr']) && ($this->container['bnr'] < 0)) {
            $invalidProperties[] = "invalid value for 'bnr', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['fnr']) && ($this->container['fnr'] < 0)) {
            $invalidProperties[] = "invalid value for 'fnr', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['snr']) && ($this->container['snr'] < 0)) {
            $invalidProperties[] = "invalid value for 'snr', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['unit_number']) && (mb_strlen($this->container['unit_number']) > 255)) {
            $invalidProperties[] = "invalid value for 'unit_number', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['unit_number']) && (mb_strlen($this->container['unit_number']) < 0)) {
            $invalidProperties[] = "invalid value for 'unit_number', the character length must be bigger than or equal to 0.";
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
     * Gets address_line1
     *
     * @return string|null
     */
    public function getAddressLine1()
    {
        return $this->container['address_line1'];
    }

    /**
     * Sets address_line1
     *
     * @param string|null $address_line1 address_line1
     *
     * @return self
     */
    public function setAddressLine1($address_line1)
    {
        if (is_null($address_line1)) {
            throw new \InvalidArgumentException('non-nullable address_line1 cannot be null');
        }
        if ((mb_strlen($address_line1) > 255)) {
            throw new \InvalidArgumentException('invalid length for $address_line1 when calling Address., must be smaller than or equal to 255.');
        }
        if ((mb_strlen($address_line1) < 0)) {
            throw new \InvalidArgumentException('invalid length for $address_line1 when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['address_line1'] = $address_line1;

        return $this;
    }

    /**
     * Gets address_line2
     *
     * @return string|null
     */
    public function getAddressLine2()
    {
        return $this->container['address_line2'];
    }

    /**
     * Sets address_line2
     *
     * @param string|null $address_line2 address_line2
     *
     * @return self
     */
    public function setAddressLine2($address_line2)
    {
        if (is_null($address_line2)) {
            throw new \InvalidArgumentException('non-nullable address_line2 cannot be null');
        }
        if ((mb_strlen($address_line2) > 255)) {
            throw new \InvalidArgumentException('invalid length for $address_line2 when calling Address., must be smaller than or equal to 255.');
        }
        if ((mb_strlen($address_line2) < 0)) {
            throw new \InvalidArgumentException('invalid length for $address_line2 when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['address_line2'] = $address_line2;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string|null $postal_code postal_code
     *
     * @return self
     */
    public function setPostalCode($postal_code)
    {
        if (is_null($postal_code)) {
            throw new \InvalidArgumentException('non-nullable postal_code cannot be null');
        }
        if ((mb_strlen($postal_code) > 100)) {
            throw new \InvalidArgumentException('invalid length for $postal_code when calling Address., must be smaller than or equal to 100.');
        }
        if ((mb_strlen($postal_code) < 0)) {
            throw new \InvalidArgumentException('invalid length for $postal_code when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string|null $city city
     *
     * @return self
     */
    public function setCity($city)
    {
        if (is_null($city)) {
            throw new \InvalidArgumentException('non-nullable city cannot be null');
        }
        if ((mb_strlen($city) > 100)) {
            throw new \InvalidArgumentException('invalid length for $city when calling Address., must be smaller than or equal to 100.');
        }
        if ((mb_strlen($city) < 0)) {
            throw new \InvalidArgumentException('invalid length for $city when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets country
     *
     * @return \Learnist\Tripletex\Model\Country|null
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param \Learnist\Tripletex\Model\Country|null $country country
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets display_name_inkl_matrikkel
     *
     * @return string|null
     */
    public function getDisplayNameInklMatrikkel()
    {
        return $this->container['display_name_inkl_matrikkel'];
    }

    /**
     * Sets display_name_inkl_matrikkel
     *
     * @param string|null $display_name_inkl_matrikkel display_name_inkl_matrikkel
     *
     * @return self
     */
    public function setDisplayNameInklMatrikkel($display_name_inkl_matrikkel)
    {
        if (is_null($display_name_inkl_matrikkel)) {
            throw new \InvalidArgumentException('non-nullable display_name_inkl_matrikkel cannot be null');
        }
        $this->container['display_name_inkl_matrikkel'] = $display_name_inkl_matrikkel;

        return $this;
    }

    /**
     * Gets knr
     *
     * @return int|null
     */
    public function getKnr()
    {
        return $this->container['knr'];
    }

    /**
     * Sets knr
     *
     * @param int|null $knr knr
     *
     * @return self
     */
    public function setKnr($knr)
    {
        if (is_null($knr)) {
            throw new \InvalidArgumentException('non-nullable knr cannot be null');
        }

        if (($knr < 0)) {
            throw new \InvalidArgumentException('invalid value for $knr when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['knr'] = $knr;

        return $this;
    }

    /**
     * Gets gnr
     *
     * @return int|null
     */
    public function getGnr()
    {
        return $this->container['gnr'];
    }

    /**
     * Sets gnr
     *
     * @param int|null $gnr gnr
     *
     * @return self
     */
    public function setGnr($gnr)
    {
        if (is_null($gnr)) {
            throw new \InvalidArgumentException('non-nullable gnr cannot be null');
        }

        if (($gnr < 0)) {
            throw new \InvalidArgumentException('invalid value for $gnr when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['gnr'] = $gnr;

        return $this;
    }

    /**
     * Gets bnr
     *
     * @return int|null
     */
    public function getBnr()
    {
        return $this->container['bnr'];
    }

    /**
     * Sets bnr
     *
     * @param int|null $bnr bnr
     *
     * @return self
     */
    public function setBnr($bnr)
    {
        if (is_null($bnr)) {
            throw new \InvalidArgumentException('non-nullable bnr cannot be null');
        }

        if (($bnr < 0)) {
            throw new \InvalidArgumentException('invalid value for $bnr when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['bnr'] = $bnr;

        return $this;
    }

    /**
     * Gets fnr
     *
     * @return int|null
     */
    public function getFnr()
    {
        return $this->container['fnr'];
    }

    /**
     * Sets fnr
     *
     * @param int|null $fnr fnr
     *
     * @return self
     */
    public function setFnr($fnr)
    {
        if (is_null($fnr)) {
            throw new \InvalidArgumentException('non-nullable fnr cannot be null');
        }

        if (($fnr < 0)) {
            throw new \InvalidArgumentException('invalid value for $fnr when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['fnr'] = $fnr;

        return $this;
    }

    /**
     * Gets snr
     *
     * @return int|null
     */
    public function getSnr()
    {
        return $this->container['snr'];
    }

    /**
     * Sets snr
     *
     * @param int|null $snr snr
     *
     * @return self
     */
    public function setSnr($snr)
    {
        if (is_null($snr)) {
            throw new \InvalidArgumentException('non-nullable snr cannot be null');
        }

        if (($snr < 0)) {
            throw new \InvalidArgumentException('invalid value for $snr when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['snr'] = $snr;

        return $this;
    }

    /**
     * Gets unit_number
     *
     * @return string|null
     */
    public function getUnitNumber()
    {
        return $this->container['unit_number'];
    }

    /**
     * Sets unit_number
     *
     * @param string|null $unit_number unit_number
     *
     * @return self
     */
    public function setUnitNumber($unit_number)
    {
        if (is_null($unit_number)) {
            throw new \InvalidArgumentException('non-nullable unit_number cannot be null');
        }
        if ((mb_strlen($unit_number) > 255)) {
            throw new \InvalidArgumentException('invalid length for $unit_number when calling Address., must be smaller than or equal to 255.');
        }
        if ((mb_strlen($unit_number) < 0)) {
            throw new \InvalidArgumentException('invalid length for $unit_number when calling Address., must be bigger than or equal to 0.');
        }

        $this->container['unit_number'] = $unit_number;

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


