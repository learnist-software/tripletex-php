<?php
/**
 * HourSummary
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
 * HourSummary Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class HourSummary implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'HourSummary';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'sum_hours' => 'float',
        'hours_with_pay' => 'float',
        'hourly_wage_hours_with_pay' => 'float',
        'standard_time' => 'float',
        'non_chargeable_hours' => 'float',
        'chargeable_hours' => 'float',
        'non_chargeable_hours_with_pay' => 'float',
        'budget_chargeable_hours' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'sum_hours' => null,
        'hours_with_pay' => null,
        'hourly_wage_hours_with_pay' => null,
        'standard_time' => null,
        'non_chargeable_hours' => null,
        'chargeable_hours' => null,
        'non_chargeable_hours_with_pay' => null,
        'budget_chargeable_hours' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'sum_hours' => false,
		'hours_with_pay' => false,
		'hourly_wage_hours_with_pay' => false,
		'standard_time' => false,
		'non_chargeable_hours' => false,
		'chargeable_hours' => false,
		'non_chargeable_hours_with_pay' => false,
		'budget_chargeable_hours' => false
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
        'sum_hours' => 'sumHours',
        'hours_with_pay' => 'hoursWithPay',
        'hourly_wage_hours_with_pay' => 'hourlyWageHoursWithPay',
        'standard_time' => 'standardTime',
        'non_chargeable_hours' => 'nonChargeableHours',
        'chargeable_hours' => 'chargeableHours',
        'non_chargeable_hours_with_pay' => 'nonChargeableHoursWithPay',
        'budget_chargeable_hours' => 'budgetChargeableHours'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'sum_hours' => 'setSumHours',
        'hours_with_pay' => 'setHoursWithPay',
        'hourly_wage_hours_with_pay' => 'setHourlyWageHoursWithPay',
        'standard_time' => 'setStandardTime',
        'non_chargeable_hours' => 'setNonChargeableHours',
        'chargeable_hours' => 'setChargeableHours',
        'non_chargeable_hours_with_pay' => 'setNonChargeableHoursWithPay',
        'budget_chargeable_hours' => 'setBudgetChargeableHours'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'sum_hours' => 'getSumHours',
        'hours_with_pay' => 'getHoursWithPay',
        'hourly_wage_hours_with_pay' => 'getHourlyWageHoursWithPay',
        'standard_time' => 'getStandardTime',
        'non_chargeable_hours' => 'getNonChargeableHours',
        'chargeable_hours' => 'getChargeableHours',
        'non_chargeable_hours_with_pay' => 'getNonChargeableHoursWithPay',
        'budget_chargeable_hours' => 'getBudgetChargeableHours'
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
        $this->setIfExists('sum_hours', $data ?? [], null);
        $this->setIfExists('hours_with_pay', $data ?? [], null);
        $this->setIfExists('hourly_wage_hours_with_pay', $data ?? [], null);
        $this->setIfExists('standard_time', $data ?? [], null);
        $this->setIfExists('non_chargeable_hours', $data ?? [], null);
        $this->setIfExists('chargeable_hours', $data ?? [], null);
        $this->setIfExists('non_chargeable_hours_with_pay', $data ?? [], null);
        $this->setIfExists('budget_chargeable_hours', $data ?? [], null);
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
     * Gets sum_hours
     *
     * @return float|null
     */
    public function getSumHours()
    {
        return $this->container['sum_hours'];
    }

    /**
     * Sets sum_hours
     *
     * @param float|null $sum_hours sum_hours
     *
     * @return self
     */
    public function setSumHours($sum_hours)
    {
        if (is_null($sum_hours)) {
            throw new \InvalidArgumentException('non-nullable sum_hours cannot be null');
        }
        $this->container['sum_hours'] = $sum_hours;

        return $this;
    }

    /**
     * Gets hours_with_pay
     *
     * @return float|null
     */
    public function getHoursWithPay()
    {
        return $this->container['hours_with_pay'];
    }

    /**
     * Sets hours_with_pay
     *
     * @param float|null $hours_with_pay hours_with_pay
     *
     * @return self
     */
    public function setHoursWithPay($hours_with_pay)
    {
        if (is_null($hours_with_pay)) {
            throw new \InvalidArgumentException('non-nullable hours_with_pay cannot be null');
        }
        $this->container['hours_with_pay'] = $hours_with_pay;

        return $this;
    }

    /**
     * Gets hourly_wage_hours_with_pay
     *
     * @return float|null
     */
    public function getHourlyWageHoursWithPay()
    {
        return $this->container['hourly_wage_hours_with_pay'];
    }

    /**
     * Sets hourly_wage_hours_with_pay
     *
     * @param float|null $hourly_wage_hours_with_pay hourly_wage_hours_with_pay
     *
     * @return self
     */
    public function setHourlyWageHoursWithPay($hourly_wage_hours_with_pay)
    {
        if (is_null($hourly_wage_hours_with_pay)) {
            throw new \InvalidArgumentException('non-nullable hourly_wage_hours_with_pay cannot be null');
        }
        $this->container['hourly_wage_hours_with_pay'] = $hourly_wage_hours_with_pay;

        return $this;
    }

    /**
     * Gets standard_time
     *
     * @return float|null
     */
    public function getStandardTime()
    {
        return $this->container['standard_time'];
    }

    /**
     * Sets standard_time
     *
     * @param float|null $standard_time standard_time
     *
     * @return self
     */
    public function setStandardTime($standard_time)
    {
        if (is_null($standard_time)) {
            throw new \InvalidArgumentException('non-nullable standard_time cannot be null');
        }
        $this->container['standard_time'] = $standard_time;

        return $this;
    }

    /**
     * Gets non_chargeable_hours
     *
     * @return float|null
     */
    public function getNonChargeableHours()
    {
        return $this->container['non_chargeable_hours'];
    }

    /**
     * Sets non_chargeable_hours
     *
     * @param float|null $non_chargeable_hours non_chargeable_hours
     *
     * @return self
     */
    public function setNonChargeableHours($non_chargeable_hours)
    {
        if (is_null($non_chargeable_hours)) {
            throw new \InvalidArgumentException('non-nullable non_chargeable_hours cannot be null');
        }
        $this->container['non_chargeable_hours'] = $non_chargeable_hours;

        return $this;
    }

    /**
     * Gets chargeable_hours
     *
     * @return float|null
     */
    public function getChargeableHours()
    {
        return $this->container['chargeable_hours'];
    }

    /**
     * Sets chargeable_hours
     *
     * @param float|null $chargeable_hours chargeable_hours
     *
     * @return self
     */
    public function setChargeableHours($chargeable_hours)
    {
        if (is_null($chargeable_hours)) {
            throw new \InvalidArgumentException('non-nullable chargeable_hours cannot be null');
        }
        $this->container['chargeable_hours'] = $chargeable_hours;

        return $this;
    }

    /**
     * Gets non_chargeable_hours_with_pay
     *
     * @return float|null
     */
    public function getNonChargeableHoursWithPay()
    {
        return $this->container['non_chargeable_hours_with_pay'];
    }

    /**
     * Sets non_chargeable_hours_with_pay
     *
     * @param float|null $non_chargeable_hours_with_pay non_chargeable_hours_with_pay
     *
     * @return self
     */
    public function setNonChargeableHoursWithPay($non_chargeable_hours_with_pay)
    {
        if (is_null($non_chargeable_hours_with_pay)) {
            throw new \InvalidArgumentException('non-nullable non_chargeable_hours_with_pay cannot be null');
        }
        $this->container['non_chargeable_hours_with_pay'] = $non_chargeable_hours_with_pay;

        return $this;
    }

    /**
     * Gets budget_chargeable_hours
     *
     * @return float|null
     */
    public function getBudgetChargeableHours()
    {
        return $this->container['budget_chargeable_hours'];
    }

    /**
     * Sets budget_chargeable_hours
     *
     * @param float|null $budget_chargeable_hours budget_chargeable_hours
     *
     * @return self
     */
    public function setBudgetChargeableHours($budget_chargeable_hours)
    {
        if (is_null($budget_chargeable_hours)) {
            throw new \InvalidArgumentException('non-nullable budget_chargeable_hours cannot be null');
        }
        $this->container['budget_chargeable_hours'] = $budget_chargeable_hours;

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


