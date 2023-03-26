<?php
/**
 * TravelExpenseRateCategory
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
 * TravelExpenseRateCategory Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TravelExpenseRateCategory implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TravelExpenseRateCategory';

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
'name' => 'string',
'amelding_wage_code' => 'int',
'wage_code_number' => 'string',
'is_valid_day_trip' => 'bool',
'is_valid_accommodation' => 'bool',
'is_valid_domestic' => 'bool',
'is_valid_foreign_travel' => 'bool',
'is_requires_zone' => 'bool',
'is_requires_overnight_accommodation' => 'bool',
'from_date' => 'string',
'to_date' => 'string',
'type' => 'string'    ];

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
'name' => null,
'amelding_wage_code' => 'int32',
'wage_code_number' => null,
'is_valid_day_trip' => null,
'is_valid_accommodation' => null,
'is_valid_domestic' => null,
'is_valid_foreign_travel' => null,
'is_requires_zone' => null,
'is_requires_overnight_accommodation' => null,
'from_date' => null,
'to_date' => null,
'type' => null    ];

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
'name' => 'name',
'amelding_wage_code' => 'ameldingWageCode',
'wage_code_number' => 'wageCodeNumber',
'is_valid_day_trip' => 'isValidDayTrip',
'is_valid_accommodation' => 'isValidAccommodation',
'is_valid_domestic' => 'isValidDomestic',
'is_valid_foreign_travel' => 'isValidForeignTravel',
'is_requires_zone' => 'isRequiresZone',
'is_requires_overnight_accommodation' => 'isRequiresOvernightAccommodation',
'from_date' => 'fromDate',
'to_date' => 'toDate',
'type' => 'type'    ];

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
'name' => 'setName',
'amelding_wage_code' => 'setAmeldingWageCode',
'wage_code_number' => 'setWageCodeNumber',
'is_valid_day_trip' => 'setIsValidDayTrip',
'is_valid_accommodation' => 'setIsValidAccommodation',
'is_valid_domestic' => 'setIsValidDomestic',
'is_valid_foreign_travel' => 'setIsValidForeignTravel',
'is_requires_zone' => 'setIsRequiresZone',
'is_requires_overnight_accommodation' => 'setIsRequiresOvernightAccommodation',
'from_date' => 'setFromDate',
'to_date' => 'setToDate',
'type' => 'setType'    ];

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
'name' => 'getName',
'amelding_wage_code' => 'getAmeldingWageCode',
'wage_code_number' => 'getWageCodeNumber',
'is_valid_day_trip' => 'getIsValidDayTrip',
'is_valid_accommodation' => 'getIsValidAccommodation',
'is_valid_domestic' => 'getIsValidDomestic',
'is_valid_foreign_travel' => 'getIsValidForeignTravel',
'is_requires_zone' => 'getIsRequiresZone',
'is_requires_overnight_accommodation' => 'getIsRequiresOvernightAccommodation',
'from_date' => 'getFromDate',
'to_date' => 'getToDate',
'type' => 'getType'    ];

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

    const TYPE_PER_DIEM = 'PER_DIEM';
const TYPE_ACCOMMODATION_ALLOWANCE = 'ACCOMMODATION_ALLOWANCE';
const TYPE_MILEAGE_ALLOWANCE = 'MILEAGE_ALLOWANCE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_PER_DIEM,
self::TYPE_ACCOMMODATION_ALLOWANCE,
self::TYPE_MILEAGE_ALLOWANCE,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['amelding_wage_code'] = isset($data['amelding_wage_code']) ? $data['amelding_wage_code'] : null;
        $this->container['wage_code_number'] = isset($data['wage_code_number']) ? $data['wage_code_number'] : null;
        $this->container['is_valid_day_trip'] = isset($data['is_valid_day_trip']) ? $data['is_valid_day_trip'] : null;
        $this->container['is_valid_accommodation'] = isset($data['is_valid_accommodation']) ? $data['is_valid_accommodation'] : null;
        $this->container['is_valid_domestic'] = isset($data['is_valid_domestic']) ? $data['is_valid_domestic'] : null;
        $this->container['is_valid_foreign_travel'] = isset($data['is_valid_foreign_travel']) ? $data['is_valid_foreign_travel'] : null;
        $this->container['is_requires_zone'] = isset($data['is_requires_zone']) ? $data['is_requires_zone'] : null;
        $this->container['is_requires_overnight_accommodation'] = isset($data['is_requires_overnight_accommodation']) ? $data['is_requires_overnight_accommodation'] : null;
        $this->container['from_date'] = isset($data['from_date']) ? $data['from_date'] : null;
        $this->container['to_date'] = isset($data['to_date']) ? $data['to_date'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['from_date'] === null) {
            $invalidProperties[] = "'from_date' can't be null";
        }
        if ($this->container['to_date'] === null) {
            $invalidProperties[] = "'to_date' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets amelding_wage_code
     *
     * @return int
     */
    public function getAmeldingWageCode()
    {
        return $this->container['amelding_wage_code'];
    }

    /**
     * Sets amelding_wage_code
     *
     * @param int $amelding_wage_code amelding_wage_code
     *
     * @return $this
     */
    public function setAmeldingWageCode($amelding_wage_code)
    {
        $this->container['amelding_wage_code'] = $amelding_wage_code;

        return $this;
    }

    /**
     * Gets wage_code_number
     *
     * @return string
     */
    public function getWageCodeNumber()
    {
        return $this->container['wage_code_number'];
    }

    /**
     * Sets wage_code_number
     *
     * @param string $wage_code_number wage_code_number
     *
     * @return $this
     */
    public function setWageCodeNumber($wage_code_number)
    {
        $this->container['wage_code_number'] = $wage_code_number;

        return $this;
    }

    /**
     * Gets is_valid_day_trip
     *
     * @return bool
     */
    public function getIsValidDayTrip()
    {
        return $this->container['is_valid_day_trip'];
    }

    /**
     * Sets is_valid_day_trip
     *
     * @param bool $is_valid_day_trip is_valid_day_trip
     *
     * @return $this
     */
    public function setIsValidDayTrip($is_valid_day_trip)
    {
        $this->container['is_valid_day_trip'] = $is_valid_day_trip;

        return $this;
    }

    /**
     * Gets is_valid_accommodation
     *
     * @return bool
     */
    public function getIsValidAccommodation()
    {
        return $this->container['is_valid_accommodation'];
    }

    /**
     * Sets is_valid_accommodation
     *
     * @param bool $is_valid_accommodation is_valid_accommodation
     *
     * @return $this
     */
    public function setIsValidAccommodation($is_valid_accommodation)
    {
        $this->container['is_valid_accommodation'] = $is_valid_accommodation;

        return $this;
    }

    /**
     * Gets is_valid_domestic
     *
     * @return bool
     */
    public function getIsValidDomestic()
    {
        return $this->container['is_valid_domestic'];
    }

    /**
     * Sets is_valid_domestic
     *
     * @param bool $is_valid_domestic is_valid_domestic
     *
     * @return $this
     */
    public function setIsValidDomestic($is_valid_domestic)
    {
        $this->container['is_valid_domestic'] = $is_valid_domestic;

        return $this;
    }

    /**
     * Gets is_valid_foreign_travel
     *
     * @return bool
     */
    public function getIsValidForeignTravel()
    {
        return $this->container['is_valid_foreign_travel'];
    }

    /**
     * Sets is_valid_foreign_travel
     *
     * @param bool $is_valid_foreign_travel is_valid_foreign_travel
     *
     * @return $this
     */
    public function setIsValidForeignTravel($is_valid_foreign_travel)
    {
        $this->container['is_valid_foreign_travel'] = $is_valid_foreign_travel;

        return $this;
    }

    /**
     * Gets is_requires_zone
     *
     * @return bool
     */
    public function getIsRequiresZone()
    {
        return $this->container['is_requires_zone'];
    }

    /**
     * Sets is_requires_zone
     *
     * @param bool $is_requires_zone is_requires_zone
     *
     * @return $this
     */
    public function setIsRequiresZone($is_requires_zone)
    {
        $this->container['is_requires_zone'] = $is_requires_zone;

        return $this;
    }

    /**
     * Gets is_requires_overnight_accommodation
     *
     * @return bool
     */
    public function getIsRequiresOvernightAccommodation()
    {
        return $this->container['is_requires_overnight_accommodation'];
    }

    /**
     * Sets is_requires_overnight_accommodation
     *
     * @param bool $is_requires_overnight_accommodation is_requires_overnight_accommodation
     *
     * @return $this
     */
    public function setIsRequiresOvernightAccommodation($is_requires_overnight_accommodation)
    {
        $this->container['is_requires_overnight_accommodation'] = $is_requires_overnight_accommodation;

        return $this;
    }

    /**
     * Gets from_date
     *
     * @return string
     */
    public function getFromDate()
    {
        return $this->container['from_date'];
    }

    /**
     * Sets from_date
     *
     * @param string $from_date from_date
     *
     * @return $this
     */
    public function setFromDate($from_date)
    {
        $this->container['from_date'] = $from_date;

        return $this;
    }

    /**
     * Gets to_date
     *
     * @return string
     */
    public function getToDate()
    {
        return $this->container['to_date'];
    }

    /**
     * Sets to_date
     *
     * @param string $to_date to_date
     *
     * @return $this
     */
    public function setToDate($to_date)
    {
        $this->container['to_date'] = $to_date;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

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
