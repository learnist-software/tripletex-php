<?php
/**
 * SalesModuleDTO
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
 * SalesModuleDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalesModuleDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalesModuleDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
'cost_start_date' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
'cost_start_date' => null    ];

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
        'name' => 'name',
'cost_start_date' => 'costStartDate'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
'cost_start_date' => 'setCostStartDate'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
'cost_start_date' => 'getCostStartDate'    ];

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

    const NAME_MAMUT = 'MAMUT';
const NAME_MAMUT_WITH_WAGE = 'MAMUT_WITH_WAGE';
const NAME_AGRO_LICENCE = 'AGRO_LICENCE';
const NAME_AGRO_CLIENT = 'AGRO_CLIENT';
const NAME_AGRO_DOCUMENT_CENTER = 'AGRO_DOCUMENT_CENTER';
const NAME_AGRO_INVOICE = 'AGRO_INVOICE';
const NAME_AGRO_INVOICE_MIGRATED = 'AGRO_INVOICE_MIGRATED';
const NAME_AGRO_WAGE = 'AGRO_WAGE';
const NAME_NO1_TS = 'NO1TS';
const NAME_NO1_TS_TRAVELREPORT = 'NO1TS_TRAVELREPORT';
const NAME_NO1_TS_ACCOUNTING = 'NO1TS_ACCOUNTING';
const NAME_BASIS = 'BASIS';
const NAME_SMART = 'SMART';
const NAME_PLUSS = 'PLUSS';
const NAME_KOMPLETT = 'KOMPLETT';
const NAME_VVS = 'VVS';
const NAME_ELECTRO = 'ELECTRO';
const NAME_ACCOUNTING_OFFICE = 'ACCOUNTING_OFFICE';
const NAME_SMART_WAGE = 'SMART_WAGE';
const NAME_SMART_TIME_TRACKING = 'SMART_TIME_TRACKING';
const NAME_SMART_PROJECT = 'SMART_PROJECT';
const NAME_OCR = 'OCR';
const NAME_API_V2 = 'API_V2';
const NAME_ELECTRONIC_VOUCHERS = 'ELECTRONIC_VOUCHERS';
const NAME_UP_TO_100_VOUCHERS = 'UP_TO_100_VOUCHERS';
const NAME_UP_TO_500_VOUCHERS = 'UP_TO_500_VOUCHERS';
const NAME_UP_TO_1000_VOUCHERS = 'UP_TO_1000_VOUCHERS';
const NAME_UP_TO_2000_VOUCHERS = 'UP_TO_2000_VOUCHERS';
const NAME_UP_TO_3500_VOUCHERS = 'UP_TO_3500_VOUCHERS';
const NAME_UP_TO_5000_VOUCHERS = 'UP_TO_5000_VOUCHERS';
const NAME_UP_TO_10000_VOUCHERS = 'UP_TO_10000_VOUCHERS';
const NAME_UNLIMITED_VOUCHERS = 'UNLIMITED_VOUCHERS';
const NAME_UP_TO_100_VOUCHERS_AUTOMATION = 'UP_TO_100_VOUCHERS_AUTOMATION';
const NAME_UP_TO_500_VOUCHERS_AUTOMATION = 'UP_TO_500_VOUCHERS_AUTOMATION';
const NAME_UP_TO_1000_VOUCHERS_AUTOMATION = 'UP_TO_1000_VOUCHERS_AUTOMATION';
const NAME_UP_TO_2000_VOUCHERS_AUTOMATION = 'UP_TO_2000_VOUCHERS_AUTOMATION';
const NAME_UP_TO_3500_VOUCHERS_AUTOMATION = 'UP_TO_3500_VOUCHERS_AUTOMATION';
const NAME_UP_TO_5000_VOUCHERS_AUTOMATION = 'UP_TO_5000_VOUCHERS_AUTOMATION';
const NAME_UP_TO_10000_VOUCHERS_AUTOMATION = 'UP_TO_10000_VOUCHERS_AUTOMATION';
const NAME_UNLIMITED_VOUCHERS_AUTOMATION = 'UNLIMITED_VOUCHERS_AUTOMATION';
const NAME_LOGISTICS = 'LOGISTICS';
const NAME_MIKRO = 'MIKRO';
const NAME_AUTOPLUS_MINI = 'AUTOPLUS_MINI';
const NAME_AUTOPLUS_MEDIUM = 'AUTOPLUS_MEDIUM';
const NAME_AUTOPLUS_STOR = 'AUTOPLUS_STOR';
const NAME_INTEGRATION_PARTNER = 'INTEGRATION_PARTNER';
const NAME_PROJECT = 'PROJECT';
const NAME_YEAR_END_REPORTING_ENK = 'YEAR_END_REPORTING_ENK';
const NAME_YEAR_END_REPORTING_AS = 'YEAR_END_REPORTING_AS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNameAllowableValues()
    {
        return [
            self::NAME_MAMUT,
self::NAME_MAMUT_WITH_WAGE,
self::NAME_AGRO_LICENCE,
self::NAME_AGRO_CLIENT,
self::NAME_AGRO_DOCUMENT_CENTER,
self::NAME_AGRO_INVOICE,
self::NAME_AGRO_INVOICE_MIGRATED,
self::NAME_AGRO_WAGE,
self::NAME_NO1_TS,
self::NAME_NO1_TS_TRAVELREPORT,
self::NAME_NO1_TS_ACCOUNTING,
self::NAME_BASIS,
self::NAME_SMART,
self::NAME_PLUSS,
self::NAME_KOMPLETT,
self::NAME_VVS,
self::NAME_ELECTRO,
self::NAME_ACCOUNTING_OFFICE,
self::NAME_SMART_WAGE,
self::NAME_SMART_TIME_TRACKING,
self::NAME_SMART_PROJECT,
self::NAME_OCR,
self::NAME_API_V2,
self::NAME_ELECTRONIC_VOUCHERS,
self::NAME_UP_TO_100_VOUCHERS,
self::NAME_UP_TO_500_VOUCHERS,
self::NAME_UP_TO_1000_VOUCHERS,
self::NAME_UP_TO_2000_VOUCHERS,
self::NAME_UP_TO_3500_VOUCHERS,
self::NAME_UP_TO_5000_VOUCHERS,
self::NAME_UP_TO_10000_VOUCHERS,
self::NAME_UNLIMITED_VOUCHERS,
self::NAME_UP_TO_100_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_500_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_1000_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_2000_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_3500_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_5000_VOUCHERS_AUTOMATION,
self::NAME_UP_TO_10000_VOUCHERS_AUTOMATION,
self::NAME_UNLIMITED_VOUCHERS_AUTOMATION,
self::NAME_LOGISTICS,
self::NAME_MIKRO,
self::NAME_AUTOPLUS_MINI,
self::NAME_AUTOPLUS_MEDIUM,
self::NAME_AUTOPLUS_STOR,
self::NAME_INTEGRATION_PARTNER,
self::NAME_PROJECT,
self::NAME_YEAR_END_REPORTING_ENK,
self::NAME_YEAR_END_REPORTING_AS,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['cost_start_date'] = isset($data['cost_start_date']) ? $data['cost_start_date'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        $allowedValues = $this->getNameAllowableValues();
        if (!is_null($this->container['name']) && !in_array($this->container['name'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'name', must be one of '%s'",
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
        $allowedValues = $this->getNameAllowableValues();
        if (!in_array($name, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'name', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets cost_start_date
     *
     * @return string
     */
    public function getCostStartDate()
    {
        return $this->container['cost_start_date'];
    }

    /**
     * Sets cost_start_date
     *
     * @param string $cost_start_date cost_start_date
     *
     * @return $this
     */
    public function setCostStartDate($cost_start_date)
    {
        $this->container['cost_start_date'] = $cost_start_date;

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
