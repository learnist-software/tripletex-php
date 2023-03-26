<?php
/**
 * SalaryV2Supplement
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
 * SalaryV2Supplement Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalaryV2Supplement implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalaryV2Supplement';

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
'salary_specification' => '\Learnist\Tripletex\Model\SalaryV2Specification',
'country' => '\Learnist\Tripletex\Model\Country',
'tax_country' => '\Learnist\Tripletex\Model\Country',
'car_number_of_km' => 'float',
'car_number_of_km_to_home_or_work' => 'float',
'car_list_price' => 'float',
'car_registration_number' => 'string',
'number_of_journeys' => 'int',
'upgrossing_basis' => 'float',
'upgrossing_table_number' => 'int',
'year_of_income' => 'int',
'deducted_artist_tax' => 'int',
'tax_paid_abroad' => 'float',
'continental_shaft' => 'bool',
'start_date' => 'string',
'end_date' => 'string',
'number_of_days' => 'int',
'validations' => '\Learnist\Tripletex\Model\ApiValidationMessage[]'    ];

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
'salary_specification' => null,
'country' => null,
'tax_country' => null,
'car_number_of_km' => null,
'car_number_of_km_to_home_or_work' => null,
'car_list_price' => null,
'car_registration_number' => null,
'number_of_journeys' => 'int32',
'upgrossing_basis' => null,
'upgrossing_table_number' => 'int32',
'year_of_income' => 'int32',
'deducted_artist_tax' => 'int32',
'tax_paid_abroad' => null,
'continental_shaft' => null,
'start_date' => null,
'end_date' => null,
'number_of_days' => 'int32',
'validations' => null    ];

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
'salary_specification' => 'salarySpecification',
'country' => 'country',
'tax_country' => 'taxCountry',
'car_number_of_km' => 'carNumberOfKm',
'car_number_of_km_to_home_or_work' => 'carNumberOfKmToHomeOrWork',
'car_list_price' => 'carListPrice',
'car_registration_number' => 'carRegistrationNumber',
'number_of_journeys' => 'numberOfJourneys',
'upgrossing_basis' => 'upgrossingBasis',
'upgrossing_table_number' => 'upgrossingTableNumber',
'year_of_income' => 'yearOfIncome',
'deducted_artist_tax' => 'deductedArtistTax',
'tax_paid_abroad' => 'taxPaidAbroad',
'continental_shaft' => 'continentalShaft',
'start_date' => 'startDate',
'end_date' => 'endDate',
'number_of_days' => 'numberOfDays',
'validations' => 'validations'    ];

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
'salary_specification' => 'setSalarySpecification',
'country' => 'setCountry',
'tax_country' => 'setTaxCountry',
'car_number_of_km' => 'setCarNumberOfKm',
'car_number_of_km_to_home_or_work' => 'setCarNumberOfKmToHomeOrWork',
'car_list_price' => 'setCarListPrice',
'car_registration_number' => 'setCarRegistrationNumber',
'number_of_journeys' => 'setNumberOfJourneys',
'upgrossing_basis' => 'setUpgrossingBasis',
'upgrossing_table_number' => 'setUpgrossingTableNumber',
'year_of_income' => 'setYearOfIncome',
'deducted_artist_tax' => 'setDeductedArtistTax',
'tax_paid_abroad' => 'setTaxPaidAbroad',
'continental_shaft' => 'setContinentalShaft',
'start_date' => 'setStartDate',
'end_date' => 'setEndDate',
'number_of_days' => 'setNumberOfDays',
'validations' => 'setValidations'    ];

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
'salary_specification' => 'getSalarySpecification',
'country' => 'getCountry',
'tax_country' => 'getTaxCountry',
'car_number_of_km' => 'getCarNumberOfKm',
'car_number_of_km_to_home_or_work' => 'getCarNumberOfKmToHomeOrWork',
'car_list_price' => 'getCarListPrice',
'car_registration_number' => 'getCarRegistrationNumber',
'number_of_journeys' => 'getNumberOfJourneys',
'upgrossing_basis' => 'getUpgrossingBasis',
'upgrossing_table_number' => 'getUpgrossingTableNumber',
'year_of_income' => 'getYearOfIncome',
'deducted_artist_tax' => 'getDeductedArtistTax',
'tax_paid_abroad' => 'getTaxPaidAbroad',
'continental_shaft' => 'getContinentalShaft',
'start_date' => 'getStartDate',
'end_date' => 'getEndDate',
'number_of_days' => 'getNumberOfDays',
'validations' => 'getValidations'    ];

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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['salary_specification'] = isset($data['salary_specification']) ? $data['salary_specification'] : null;
        $this->container['country'] = isset($data['country']) ? $data['country'] : null;
        $this->container['tax_country'] = isset($data['tax_country']) ? $data['tax_country'] : null;
        $this->container['car_number_of_km'] = isset($data['car_number_of_km']) ? $data['car_number_of_km'] : null;
        $this->container['car_number_of_km_to_home_or_work'] = isset($data['car_number_of_km_to_home_or_work']) ? $data['car_number_of_km_to_home_or_work'] : null;
        $this->container['car_list_price'] = isset($data['car_list_price']) ? $data['car_list_price'] : null;
        $this->container['car_registration_number'] = isset($data['car_registration_number']) ? $data['car_registration_number'] : null;
        $this->container['number_of_journeys'] = isset($data['number_of_journeys']) ? $data['number_of_journeys'] : null;
        $this->container['upgrossing_basis'] = isset($data['upgrossing_basis']) ? $data['upgrossing_basis'] : null;
        $this->container['upgrossing_table_number'] = isset($data['upgrossing_table_number']) ? $data['upgrossing_table_number'] : null;
        $this->container['year_of_income'] = isset($data['year_of_income']) ? $data['year_of_income'] : null;
        $this->container['deducted_artist_tax'] = isset($data['deducted_artist_tax']) ? $data['deducted_artist_tax'] : null;
        $this->container['tax_paid_abroad'] = isset($data['tax_paid_abroad']) ? $data['tax_paid_abroad'] : null;
        $this->container['continental_shaft'] = isset($data['continental_shaft']) ? $data['continental_shaft'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['number_of_days'] = isset($data['number_of_days']) ? $data['number_of_days'] : null;
        $this->container['validations'] = isset($data['validations']) ? $data['validations'] : null;
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
     * Gets salary_specification
     *
     * @return \Learnist\Tripletex\Model\SalaryV2Specification
     */
    public function getSalarySpecification()
    {
        return $this->container['salary_specification'];
    }

    /**
     * Sets salary_specification
     *
     * @param \Learnist\Tripletex\Model\SalaryV2Specification $salary_specification salary_specification
     *
     * @return $this
     */
    public function setSalarySpecification($salary_specification)
    {
        $this->container['salary_specification'] = $salary_specification;

        return $this;
    }

    /**
     * Gets country
     *
     * @return \Learnist\Tripletex\Model\Country
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param \Learnist\Tripletex\Model\Country $country country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets tax_country
     *
     * @return \Learnist\Tripletex\Model\Country
     */
    public function getTaxCountry()
    {
        return $this->container['tax_country'];
    }

    /**
     * Sets tax_country
     *
     * @param \Learnist\Tripletex\Model\Country $tax_country tax_country
     *
     * @return $this
     */
    public function setTaxCountry($tax_country)
    {
        $this->container['tax_country'] = $tax_country;

        return $this;
    }

    /**
     * Gets car_number_of_km
     *
     * @return float
     */
    public function getCarNumberOfKm()
    {
        return $this->container['car_number_of_km'];
    }

    /**
     * Sets car_number_of_km
     *
     * @param float $car_number_of_km car_number_of_km
     *
     * @return $this
     */
    public function setCarNumberOfKm($car_number_of_km)
    {
        $this->container['car_number_of_km'] = $car_number_of_km;

        return $this;
    }

    /**
     * Gets car_number_of_km_to_home_or_work
     *
     * @return float
     */
    public function getCarNumberOfKmToHomeOrWork()
    {
        return $this->container['car_number_of_km_to_home_or_work'];
    }

    /**
     * Sets car_number_of_km_to_home_or_work
     *
     * @param float $car_number_of_km_to_home_or_work car_number_of_km_to_home_or_work
     *
     * @return $this
     */
    public function setCarNumberOfKmToHomeOrWork($car_number_of_km_to_home_or_work)
    {
        $this->container['car_number_of_km_to_home_or_work'] = $car_number_of_km_to_home_or_work;

        return $this;
    }

    /**
     * Gets car_list_price
     *
     * @return float
     */
    public function getCarListPrice()
    {
        return $this->container['car_list_price'];
    }

    /**
     * Sets car_list_price
     *
     * @param float $car_list_price car_list_price
     *
     * @return $this
     */
    public function setCarListPrice($car_list_price)
    {
        $this->container['car_list_price'] = $car_list_price;

        return $this;
    }

    /**
     * Gets car_registration_number
     *
     * @return string
     */
    public function getCarRegistrationNumber()
    {
        return $this->container['car_registration_number'];
    }

    /**
     * Sets car_registration_number
     *
     * @param string $car_registration_number car_registration_number
     *
     * @return $this
     */
    public function setCarRegistrationNumber($car_registration_number)
    {
        $this->container['car_registration_number'] = $car_registration_number;

        return $this;
    }

    /**
     * Gets number_of_journeys
     *
     * @return int
     */
    public function getNumberOfJourneys()
    {
        return $this->container['number_of_journeys'];
    }

    /**
     * Sets number_of_journeys
     *
     * @param int $number_of_journeys number_of_journeys
     *
     * @return $this
     */
    public function setNumberOfJourneys($number_of_journeys)
    {
        $this->container['number_of_journeys'] = $number_of_journeys;

        return $this;
    }

    /**
     * Gets upgrossing_basis
     *
     * @return float
     */
    public function getUpgrossingBasis()
    {
        return $this->container['upgrossing_basis'];
    }

    /**
     * Sets upgrossing_basis
     *
     * @param float $upgrossing_basis upgrossing_basis
     *
     * @return $this
     */
    public function setUpgrossingBasis($upgrossing_basis)
    {
        $this->container['upgrossing_basis'] = $upgrossing_basis;

        return $this;
    }

    /**
     * Gets upgrossing_table_number
     *
     * @return int
     */
    public function getUpgrossingTableNumber()
    {
        return $this->container['upgrossing_table_number'];
    }

    /**
     * Sets upgrossing_table_number
     *
     * @param int $upgrossing_table_number upgrossing_table_number
     *
     * @return $this
     */
    public function setUpgrossingTableNumber($upgrossing_table_number)
    {
        $this->container['upgrossing_table_number'] = $upgrossing_table_number;

        return $this;
    }

    /**
     * Gets year_of_income
     *
     * @return int
     */
    public function getYearOfIncome()
    {
        return $this->container['year_of_income'];
    }

    /**
     * Sets year_of_income
     *
     * @param int $year_of_income year_of_income
     *
     * @return $this
     */
    public function setYearOfIncome($year_of_income)
    {
        $this->container['year_of_income'] = $year_of_income;

        return $this;
    }

    /**
     * Gets deducted_artist_tax
     *
     * @return int
     */
    public function getDeductedArtistTax()
    {
        return $this->container['deducted_artist_tax'];
    }

    /**
     * Sets deducted_artist_tax
     *
     * @param int $deducted_artist_tax deducted_artist_tax
     *
     * @return $this
     */
    public function setDeductedArtistTax($deducted_artist_tax)
    {
        $this->container['deducted_artist_tax'] = $deducted_artist_tax;

        return $this;
    }

    /**
     * Gets tax_paid_abroad
     *
     * @return float
     */
    public function getTaxPaidAbroad()
    {
        return $this->container['tax_paid_abroad'];
    }

    /**
     * Sets tax_paid_abroad
     *
     * @param float $tax_paid_abroad tax_paid_abroad
     *
     * @return $this
     */
    public function setTaxPaidAbroad($tax_paid_abroad)
    {
        $this->container['tax_paid_abroad'] = $tax_paid_abroad;

        return $this;
    }

    /**
     * Gets continental_shaft
     *
     * @return bool
     */
    public function getContinentalShaft()
    {
        return $this->container['continental_shaft'];
    }

    /**
     * Sets continental_shaft
     *
     * @param bool $continental_shaft continental_shaft
     *
     * @return $this
     */
    public function setContinentalShaft($continental_shaft)
    {
        $this->container['continental_shaft'] = $continental_shaft;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string $start_date start date, currently only for Norwegian Continental Shaft
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string $end_date end date, currently only for Norwegian Continental Shaft
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets number_of_days
     *
     * @return int
     */
    public function getNumberOfDays()
    {
        return $this->container['number_of_days'];
    }

    /**
     * Sets number_of_days
     *
     * @param int $number_of_days number_of_days
     *
     * @return $this
     */
    public function setNumberOfDays($number_of_days)
    {
        $this->container['number_of_days'] = $number_of_days;

        return $this;
    }

    /**
     * Gets validations
     *
     * @return \Learnist\Tripletex\Model\ApiValidationMessage[]
     */
    public function getValidations()
    {
        return $this->container['validations'];
    }

    /**
     * Sets validations
     *
     * @param \Learnist\Tripletex\Model\ApiValidationMessage[] $validations validations
     *
     * @return $this
     */
    public function setValidations($validations)
    {
        $this->container['validations'] = $validations;

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
