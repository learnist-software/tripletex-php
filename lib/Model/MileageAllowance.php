<?php
/**
 * MileageAllowance
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
 * MileageAllowance Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MileageAllowance implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'MileageAllowance';

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
'travel_expense' => '\Learnist\Tripletex\Model\TravelExpense',
'rate_type' => '\Learnist\Tripletex\Model\TravelExpenseRate',
'rate_category' => '\Learnist\Tripletex\Model\TravelExpenseRateCategory',
'date' => 'string',
'departure_location' => 'string',
'destination' => 'string',
'km' => 'float',
'rate' => 'float',
'amount' => 'float',
'is_company_car' => 'bool',
'vehicle_type' => 'int',
'passengers' => '\Learnist\Tripletex\Model\Passenger[]',
'passenger_supplement' => '\Learnist\Tripletex\Model\MileageAllowance',
'trailer_supplement' => '\Learnist\Tripletex\Model\MileageAllowance',
'toll_cost' => '\Learnist\Tripletex\Model\Cost',
'driving_stops' => '\Learnist\Tripletex\Model\DrivingStop[]'    ];

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
'travel_expense' => null,
'rate_type' => null,
'rate_category' => null,
'date' => null,
'departure_location' => null,
'destination' => null,
'km' => null,
'rate' => null,
'amount' => null,
'is_company_car' => null,
'vehicle_type' => 'int32',
'passengers' => null,
'passenger_supplement' => null,
'trailer_supplement' => null,
'toll_cost' => null,
'driving_stops' => null    ];

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
'travel_expense' => 'travelExpense',
'rate_type' => 'rateType',
'rate_category' => 'rateCategory',
'date' => 'date',
'departure_location' => 'departureLocation',
'destination' => 'destination',
'km' => 'km',
'rate' => 'rate',
'amount' => 'amount',
'is_company_car' => 'isCompanyCar',
'vehicle_type' => 'vehicleType',
'passengers' => 'passengers',
'passenger_supplement' => 'passengerSupplement',
'trailer_supplement' => 'trailerSupplement',
'toll_cost' => 'tollCost',
'driving_stops' => 'drivingStops'    ];

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
'travel_expense' => 'setTravelExpense',
'rate_type' => 'setRateType',
'rate_category' => 'setRateCategory',
'date' => 'setDate',
'departure_location' => 'setDepartureLocation',
'destination' => 'setDestination',
'km' => 'setKm',
'rate' => 'setRate',
'amount' => 'setAmount',
'is_company_car' => 'setIsCompanyCar',
'vehicle_type' => 'setVehicleType',
'passengers' => 'setPassengers',
'passenger_supplement' => 'setPassengerSupplement',
'trailer_supplement' => 'setTrailerSupplement',
'toll_cost' => 'setTollCost',
'driving_stops' => 'setDrivingStops'    ];

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
'travel_expense' => 'getTravelExpense',
'rate_type' => 'getRateType',
'rate_category' => 'getRateCategory',
'date' => 'getDate',
'departure_location' => 'getDepartureLocation',
'destination' => 'getDestination',
'km' => 'getKm',
'rate' => 'getRate',
'amount' => 'getAmount',
'is_company_car' => 'getIsCompanyCar',
'vehicle_type' => 'getVehicleType',
'passengers' => 'getPassengers',
'passenger_supplement' => 'getPassengerSupplement',
'trailer_supplement' => 'getTrailerSupplement',
'toll_cost' => 'getTollCost',
'driving_stops' => 'getDrivingStops'    ];

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
        $this->container['travel_expense'] = isset($data['travel_expense']) ? $data['travel_expense'] : null;
        $this->container['rate_type'] = isset($data['rate_type']) ? $data['rate_type'] : null;
        $this->container['rate_category'] = isset($data['rate_category']) ? $data['rate_category'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['departure_location'] = isset($data['departure_location']) ? $data['departure_location'] : null;
        $this->container['destination'] = isset($data['destination']) ? $data['destination'] : null;
        $this->container['km'] = isset($data['km']) ? $data['km'] : null;
        $this->container['rate'] = isset($data['rate']) ? $data['rate'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['is_company_car'] = isset($data['is_company_car']) ? $data['is_company_car'] : null;
        $this->container['vehicle_type'] = isset($data['vehicle_type']) ? $data['vehicle_type'] : null;
        $this->container['passengers'] = isset($data['passengers']) ? $data['passengers'] : null;
        $this->container['passenger_supplement'] = isset($data['passenger_supplement']) ? $data['passenger_supplement'] : null;
        $this->container['trailer_supplement'] = isset($data['trailer_supplement']) ? $data['trailer_supplement'] : null;
        $this->container['toll_cost'] = isset($data['toll_cost']) ? $data['toll_cost'] : null;
        $this->container['driving_stops'] = isset($data['driving_stops']) ? $data['driving_stops'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['date'] === null) {
            $invalidProperties[] = "'date' can't be null";
        }
        if ($this->container['departure_location'] === null) {
            $invalidProperties[] = "'departure_location' can't be null";
        }
        if ($this->container['destination'] === null) {
            $invalidProperties[] = "'destination' can't be null";
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
     * Gets travel_expense
     *
     * @return \Learnist\Tripletex\Model\TravelExpense
     */
    public function getTravelExpense()
    {
        return $this->container['travel_expense'];
    }

    /**
     * Sets travel_expense
     *
     * @param \Learnist\Tripletex\Model\TravelExpense $travel_expense travel_expense
     *
     * @return $this
     */
    public function setTravelExpense($travel_expense)
    {
        $this->container['travel_expense'] = $travel_expense;

        return $this;
    }

    /**
     * Gets rate_type
     *
     * @return \Learnist\Tripletex\Model\TravelExpenseRate
     */
    public function getRateType()
    {
        return $this->container['rate_type'];
    }

    /**
     * Sets rate_type
     *
     * @param \Learnist\Tripletex\Model\TravelExpenseRate $rate_type rate_type
     *
     * @return $this
     */
    public function setRateType($rate_type)
    {
        $this->container['rate_type'] = $rate_type;

        return $this;
    }

    /**
     * Gets rate_category
     *
     * @return \Learnist\Tripletex\Model\TravelExpenseRateCategory
     */
    public function getRateCategory()
    {
        return $this->container['rate_category'];
    }

    /**
     * Sets rate_category
     *
     * @param \Learnist\Tripletex\Model\TravelExpenseRateCategory $rate_category rate_category
     *
     * @return $this
     */
    public function setRateCategory($rate_category)
    {
        $this->container['rate_category'] = $rate_category;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets departure_location
     *
     * @return string
     */
    public function getDepartureLocation()
    {
        return $this->container['departure_location'];
    }

    /**
     * Sets departure_location
     *
     * @param string $departure_location departure_location
     *
     * @return $this
     */
    public function setDepartureLocation($departure_location)
    {
        $this->container['departure_location'] = $departure_location;

        return $this;
    }

    /**
     * Gets destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->container['destination'];
    }

    /**
     * Sets destination
     *
     * @param string $destination destination
     *
     * @return $this
     */
    public function setDestination($destination)
    {
        $this->container['destination'] = $destination;

        return $this;
    }

    /**
     * Gets km
     *
     * @return float
     */
    public function getKm()
    {
        return $this->container['km'];
    }

    /**
     * Sets km
     *
     * @param float $km km
     *
     * @return $this
     */
    public function setKm($km)
    {
        $this->container['km'] = $km;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param float $rate rate
     *
     * @return $this
     */
    public function setRate($rate)
    {
        $this->container['rate'] = $rate;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets is_company_car
     *
     * @return bool
     */
    public function getIsCompanyCar()
    {
        return $this->container['is_company_car'];
    }

    /**
     * Sets is_company_car
     *
     * @param bool $is_company_car is_company_car
     *
     * @return $this
     */
    public function setIsCompanyCar($is_company_car)
    {
        $this->container['is_company_car'] = $is_company_car;

        return $this;
    }

    /**
     * Gets vehicle_type
     *
     * @return int
     */
    public function getVehicleType()
    {
        return $this->container['vehicle_type'];
    }

    /**
     * Sets vehicle_type
     *
     * @param int $vehicle_type The corresponded number for the vehicleType. Default value = 0.
     *
     * @return $this
     */
    public function setVehicleType($vehicle_type)
    {
        $this->container['vehicle_type'] = $vehicle_type;

        return $this;
    }

    /**
     * Gets passengers
     *
     * @return \Learnist\Tripletex\Model\Passenger[]
     */
    public function getPassengers()
    {
        return $this->container['passengers'];
    }

    /**
     * Sets passengers
     *
     * @param \Learnist\Tripletex\Model\Passenger[] $passengers Link to individual passengers.
     *
     * @return $this
     */
    public function setPassengers($passengers)
    {
        $this->container['passengers'] = $passengers;

        return $this;
    }

    /**
     * Gets passenger_supplement
     *
     * @return \Learnist\Tripletex\Model\MileageAllowance
     */
    public function getPassengerSupplement()
    {
        return $this->container['passenger_supplement'];
    }

    /**
     * Sets passenger_supplement
     *
     * @param \Learnist\Tripletex\Model\MileageAllowance $passenger_supplement passenger_supplement
     *
     * @return $this
     */
    public function setPassengerSupplement($passenger_supplement)
    {
        $this->container['passenger_supplement'] = $passenger_supplement;

        return $this;
    }

    /**
     * Gets trailer_supplement
     *
     * @return \Learnist\Tripletex\Model\MileageAllowance
     */
    public function getTrailerSupplement()
    {
        return $this->container['trailer_supplement'];
    }

    /**
     * Sets trailer_supplement
     *
     * @param \Learnist\Tripletex\Model\MileageAllowance $trailer_supplement trailer_supplement
     *
     * @return $this
     */
    public function setTrailerSupplement($trailer_supplement)
    {
        $this->container['trailer_supplement'] = $trailer_supplement;

        return $this;
    }

    /**
     * Gets toll_cost
     *
     * @return \Learnist\Tripletex\Model\Cost
     */
    public function getTollCost()
    {
        return $this->container['toll_cost'];
    }

    /**
     * Sets toll_cost
     *
     * @param \Learnist\Tripletex\Model\Cost $toll_cost toll_cost
     *
     * @return $this
     */
    public function setTollCost($toll_cost)
    {
        $this->container['toll_cost'] = $toll_cost;

        return $this;
    }

    /**
     * Gets driving_stops
     *
     * @return \Learnist\Tripletex\Model\DrivingStop[]
     */
    public function getDrivingStops()
    {
        return $this->container['driving_stops'];
    }

    /**
     * Sets driving_stops
     *
     * @param \Learnist\Tripletex\Model\DrivingStop[] $driving_stops Link to individual mileage stops.
     *
     * @return $this
     */
    public function setDrivingStops($driving_stops)
    {
        $this->container['driving_stops'] = $driving_stops;

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
