<?php
/**
 * SalarySummaryDTO
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
 * SalarySummaryDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalarySummaryDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalarySummaryDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'number_of_active_employees' => 'int',
'salary_payment_sum' => '\Learnist\Tripletex\Model\TlxNumber',
'currency' => 'string',
'salary_percentage' => '\Learnist\Tripletex\Model\TlxNumber',
'employers_payment_percentage' => '\Learnist\Tripletex\Model\TlxNumber',
'taxes_percentage' => '\Learnist\Tripletex\Model\TlxNumber',
'salary_period_month_first_day' => '\DateTime',
'salary_period_month_last_day' => '\DateTime',
'valid_alt_inn_config' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'number_of_active_employees' => 'int32',
'salary_payment_sum' => null,
'currency' => null,
'salary_percentage' => null,
'employers_payment_percentage' => null,
'taxes_percentage' => null,
'salary_period_month_first_day' => 'date',
'salary_period_month_last_day' => 'date',
'valid_alt_inn_config' => null    ];

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
        'number_of_active_employees' => 'numberOfActiveEmployees',
'salary_payment_sum' => 'salaryPaymentSum',
'currency' => 'currency',
'salary_percentage' => 'salaryPercentage',
'employers_payment_percentage' => 'employersPaymentPercentage',
'taxes_percentage' => 'taxesPercentage',
'salary_period_month_first_day' => 'salaryPeriodMonthFirstDay',
'salary_period_month_last_day' => 'salaryPeriodMonthLastDay',
'valid_alt_inn_config' => 'validAltInnConfig'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'number_of_active_employees' => 'setNumberOfActiveEmployees',
'salary_payment_sum' => 'setSalaryPaymentSum',
'currency' => 'setCurrency',
'salary_percentage' => 'setSalaryPercentage',
'employers_payment_percentage' => 'setEmployersPaymentPercentage',
'taxes_percentage' => 'setTaxesPercentage',
'salary_period_month_first_day' => 'setSalaryPeriodMonthFirstDay',
'salary_period_month_last_day' => 'setSalaryPeriodMonthLastDay',
'valid_alt_inn_config' => 'setValidAltInnConfig'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'number_of_active_employees' => 'getNumberOfActiveEmployees',
'salary_payment_sum' => 'getSalaryPaymentSum',
'currency' => 'getCurrency',
'salary_percentage' => 'getSalaryPercentage',
'employers_payment_percentage' => 'getEmployersPaymentPercentage',
'taxes_percentage' => 'getTaxesPercentage',
'salary_period_month_first_day' => 'getSalaryPeriodMonthFirstDay',
'salary_period_month_last_day' => 'getSalaryPeriodMonthLastDay',
'valid_alt_inn_config' => 'getValidAltInnConfig'    ];

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
        $this->container['number_of_active_employees'] = isset($data['number_of_active_employees']) ? $data['number_of_active_employees'] : null;
        $this->container['salary_payment_sum'] = isset($data['salary_payment_sum']) ? $data['salary_payment_sum'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['salary_percentage'] = isset($data['salary_percentage']) ? $data['salary_percentage'] : null;
        $this->container['employers_payment_percentage'] = isset($data['employers_payment_percentage']) ? $data['employers_payment_percentage'] : null;
        $this->container['taxes_percentage'] = isset($data['taxes_percentage']) ? $data['taxes_percentage'] : null;
        $this->container['salary_period_month_first_day'] = isset($data['salary_period_month_first_day']) ? $data['salary_period_month_first_day'] : null;
        $this->container['salary_period_month_last_day'] = isset($data['salary_period_month_last_day']) ? $data['salary_period_month_last_day'] : null;
        $this->container['valid_alt_inn_config'] = isset($data['valid_alt_inn_config']) ? $data['valid_alt_inn_config'] : null;
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
     * Gets number_of_active_employees
     *
     * @return int
     */
    public function getNumberOfActiveEmployees()
    {
        return $this->container['number_of_active_employees'];
    }

    /**
     * Sets number_of_active_employees
     *
     * @param int $number_of_active_employees number_of_active_employees
     *
     * @return $this
     */
    public function setNumberOfActiveEmployees($number_of_active_employees)
    {
        $this->container['number_of_active_employees'] = $number_of_active_employees;

        return $this;
    }

    /**
     * Gets salary_payment_sum
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getSalaryPaymentSum()
    {
        return $this->container['salary_payment_sum'];
    }

    /**
     * Sets salary_payment_sum
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $salary_payment_sum salary_payment_sum
     *
     * @return $this
     */
    public function setSalaryPaymentSum($salary_payment_sum)
    {
        $this->container['salary_payment_sum'] = $salary_payment_sum;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets salary_percentage
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getSalaryPercentage()
    {
        return $this->container['salary_percentage'];
    }

    /**
     * Sets salary_percentage
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $salary_percentage salary_percentage
     *
     * @return $this
     */
    public function setSalaryPercentage($salary_percentage)
    {
        $this->container['salary_percentage'] = $salary_percentage;

        return $this;
    }

    /**
     * Gets employers_payment_percentage
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getEmployersPaymentPercentage()
    {
        return $this->container['employers_payment_percentage'];
    }

    /**
     * Sets employers_payment_percentage
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $employers_payment_percentage employers_payment_percentage
     *
     * @return $this
     */
    public function setEmployersPaymentPercentage($employers_payment_percentage)
    {
        $this->container['employers_payment_percentage'] = $employers_payment_percentage;

        return $this;
    }

    /**
     * Gets taxes_percentage
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getTaxesPercentage()
    {
        return $this->container['taxes_percentage'];
    }

    /**
     * Sets taxes_percentage
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $taxes_percentage taxes_percentage
     *
     * @return $this
     */
    public function setTaxesPercentage($taxes_percentage)
    {
        $this->container['taxes_percentage'] = $taxes_percentage;

        return $this;
    }

    /**
     * Gets salary_period_month_first_day
     *
     * @return \DateTime
     */
    public function getSalaryPeriodMonthFirstDay()
    {
        return $this->container['salary_period_month_first_day'];
    }

    /**
     * Sets salary_period_month_first_day
     *
     * @param \DateTime $salary_period_month_first_day salary_period_month_first_day
     *
     * @return $this
     */
    public function setSalaryPeriodMonthFirstDay($salary_period_month_first_day)
    {
        $this->container['salary_period_month_first_day'] = $salary_period_month_first_day;

        return $this;
    }

    /**
     * Gets salary_period_month_last_day
     *
     * @return \DateTime
     */
    public function getSalaryPeriodMonthLastDay()
    {
        return $this->container['salary_period_month_last_day'];
    }

    /**
     * Sets salary_period_month_last_day
     *
     * @param \DateTime $salary_period_month_last_day salary_period_month_last_day
     *
     * @return $this
     */
    public function setSalaryPeriodMonthLastDay($salary_period_month_last_day)
    {
        $this->container['salary_period_month_last_day'] = $salary_period_month_last_day;

        return $this;
    }

    /**
     * Gets valid_alt_inn_config
     *
     * @return bool
     */
    public function getValidAltInnConfig()
    {
        return $this->container['valid_alt_inn_config'];
    }

    /**
     * Sets valid_alt_inn_config
     *
     * @param bool $valid_alt_inn_config valid_alt_inn_config
     *
     * @return $this
     */
    public function setValidAltInnConfig($valid_alt_inn_config)
    {
        $this->container['valid_alt_inn_config'] = $valid_alt_inn_config;

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
