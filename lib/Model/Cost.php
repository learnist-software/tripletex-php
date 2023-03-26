<?php
/**
 * Cost
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
 * Cost Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Cost implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Cost';

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
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'currency' => '\Learnist\Tripletex\Model\Currency',
'cost_category' => '\Learnist\Tripletex\Model\TravelCostCategory',
'payment_type' => '\Learnist\Tripletex\Model\TravelPaymentType',
'category' => 'string',
'comments' => 'string',
'rate' => 'float',
'amount_currency_inc_vat' => 'float',
'amount_nok_incl_vat' => 'float',
'amount_nok_incl_vat_low' => 'float',
'amount_nok_incl_vat_medium' => 'float',
'amount_nok_incl_vat_high' => 'float',
'is_paid_by_employee' => 'bool',
'is_chargeable' => 'bool',
'date' => 'string',
'predictions' => 'map[string,\Learnist\Tripletex\Model\Prediction]'    ];

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
'vat_type' => null,
'currency' => null,
'cost_category' => null,
'payment_type' => null,
'category' => null,
'comments' => null,
'rate' => null,
'amount_currency_inc_vat' => null,
'amount_nok_incl_vat' => null,
'amount_nok_incl_vat_low' => null,
'amount_nok_incl_vat_medium' => null,
'amount_nok_incl_vat_high' => null,
'is_paid_by_employee' => null,
'is_chargeable' => null,
'date' => null,
'predictions' => null    ];

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
'vat_type' => 'vatType',
'currency' => 'currency',
'cost_category' => 'costCategory',
'payment_type' => 'paymentType',
'category' => 'category',
'comments' => 'comments',
'rate' => 'rate',
'amount_currency_inc_vat' => 'amountCurrencyIncVat',
'amount_nok_incl_vat' => 'amountNOKInclVAT',
'amount_nok_incl_vat_low' => 'amountNOKInclVATLow',
'amount_nok_incl_vat_medium' => 'amountNOKInclVATMedium',
'amount_nok_incl_vat_high' => 'amountNOKInclVATHigh',
'is_paid_by_employee' => 'isPaidByEmployee',
'is_chargeable' => 'isChargeable',
'date' => 'date',
'predictions' => 'predictions'    ];

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
'vat_type' => 'setVatType',
'currency' => 'setCurrency',
'cost_category' => 'setCostCategory',
'payment_type' => 'setPaymentType',
'category' => 'setCategory',
'comments' => 'setComments',
'rate' => 'setRate',
'amount_currency_inc_vat' => 'setAmountCurrencyIncVat',
'amount_nok_incl_vat' => 'setAmountNokInclVat',
'amount_nok_incl_vat_low' => 'setAmountNokInclVatLow',
'amount_nok_incl_vat_medium' => 'setAmountNokInclVatMedium',
'amount_nok_incl_vat_high' => 'setAmountNokInclVatHigh',
'is_paid_by_employee' => 'setIsPaidByEmployee',
'is_chargeable' => 'setIsChargeable',
'date' => 'setDate',
'predictions' => 'setPredictions'    ];

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
'vat_type' => 'getVatType',
'currency' => 'getCurrency',
'cost_category' => 'getCostCategory',
'payment_type' => 'getPaymentType',
'category' => 'getCategory',
'comments' => 'getComments',
'rate' => 'getRate',
'amount_currency_inc_vat' => 'getAmountCurrencyIncVat',
'amount_nok_incl_vat' => 'getAmountNokInclVat',
'amount_nok_incl_vat_low' => 'getAmountNokInclVatLow',
'amount_nok_incl_vat_medium' => 'getAmountNokInclVatMedium',
'amount_nok_incl_vat_high' => 'getAmountNokInclVatHigh',
'is_paid_by_employee' => 'getIsPaidByEmployee',
'is_chargeable' => 'getIsChargeable',
'date' => 'getDate',
'predictions' => 'getPredictions'    ];

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
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['cost_category'] = isset($data['cost_category']) ? $data['cost_category'] : null;
        $this->container['payment_type'] = isset($data['payment_type']) ? $data['payment_type'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['comments'] = isset($data['comments']) ? $data['comments'] : null;
        $this->container['rate'] = isset($data['rate']) ? $data['rate'] : null;
        $this->container['amount_currency_inc_vat'] = isset($data['amount_currency_inc_vat']) ? $data['amount_currency_inc_vat'] : null;
        $this->container['amount_nok_incl_vat'] = isset($data['amount_nok_incl_vat']) ? $data['amount_nok_incl_vat'] : null;
        $this->container['amount_nok_incl_vat_low'] = isset($data['amount_nok_incl_vat_low']) ? $data['amount_nok_incl_vat_low'] : null;
        $this->container['amount_nok_incl_vat_medium'] = isset($data['amount_nok_incl_vat_medium']) ? $data['amount_nok_incl_vat_medium'] : null;
        $this->container['amount_nok_incl_vat_high'] = isset($data['amount_nok_incl_vat_high']) ? $data['amount_nok_incl_vat_high'] : null;
        $this->container['is_paid_by_employee'] = isset($data['is_paid_by_employee']) ? $data['is_paid_by_employee'] : null;
        $this->container['is_chargeable'] = isset($data['is_chargeable']) ? $data['is_chargeable'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['predictions'] = isset($data['predictions']) ? $data['predictions'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['payment_type'] === null) {
            $invalidProperties[] = "'payment_type' can't be null";
        }
        if ($this->container['amount_currency_inc_vat'] === null) {
            $invalidProperties[] = "'amount_currency_inc_vat' can't be null";
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
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType $vat_type vat_type
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets cost_category
     *
     * @return \Learnist\Tripletex\Model\TravelCostCategory
     */
    public function getCostCategory()
    {
        return $this->container['cost_category'];
    }

    /**
     * Sets cost_category
     *
     * @param \Learnist\Tripletex\Model\TravelCostCategory $cost_category cost_category
     *
     * @return $this
     */
    public function setCostCategory($cost_category)
    {
        $this->container['cost_category'] = $cost_category;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return \Learnist\Tripletex\Model\TravelPaymentType
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param \Learnist\Tripletex\Model\TravelPaymentType $payment_type payment_type
     *
     * @return $this
     */
    public function setPaymentType($payment_type)
    {
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param string $comments comments
     *
     * @return $this
     */
    public function setComments($comments)
    {
        $this->container['comments'] = $comments;

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
     * Gets amount_currency_inc_vat
     *
     * @return float
     */
    public function getAmountCurrencyIncVat()
    {
        return $this->container['amount_currency_inc_vat'];
    }

    /**
     * Sets amount_currency_inc_vat
     *
     * @param float $amount_currency_inc_vat amount_currency_inc_vat
     *
     * @return $this
     */
    public function setAmountCurrencyIncVat($amount_currency_inc_vat)
    {
        $this->container['amount_currency_inc_vat'] = $amount_currency_inc_vat;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat
     *
     * @return float
     */
    public function getAmountNokInclVat()
    {
        return $this->container['amount_nok_incl_vat'];
    }

    /**
     * Sets amount_nok_incl_vat
     *
     * @param float $amount_nok_incl_vat amount_nok_incl_vat
     *
     * @return $this
     */
    public function setAmountNokInclVat($amount_nok_incl_vat)
    {
        $this->container['amount_nok_incl_vat'] = $amount_nok_incl_vat;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_low
     *
     * @return float
     */
    public function getAmountNokInclVatLow()
    {
        return $this->container['amount_nok_incl_vat_low'];
    }

    /**
     * Sets amount_nok_incl_vat_low
     *
     * @param float $amount_nok_incl_vat_low amount_nok_incl_vat_low
     *
     * @return $this
     */
    public function setAmountNokInclVatLow($amount_nok_incl_vat_low)
    {
        $this->container['amount_nok_incl_vat_low'] = $amount_nok_incl_vat_low;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_medium
     *
     * @return float
     */
    public function getAmountNokInclVatMedium()
    {
        return $this->container['amount_nok_incl_vat_medium'];
    }

    /**
     * Sets amount_nok_incl_vat_medium
     *
     * @param float $amount_nok_incl_vat_medium amount_nok_incl_vat_medium
     *
     * @return $this
     */
    public function setAmountNokInclVatMedium($amount_nok_incl_vat_medium)
    {
        $this->container['amount_nok_incl_vat_medium'] = $amount_nok_incl_vat_medium;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_high
     *
     * @return float
     */
    public function getAmountNokInclVatHigh()
    {
        return $this->container['amount_nok_incl_vat_high'];
    }

    /**
     * Sets amount_nok_incl_vat_high
     *
     * @param float $amount_nok_incl_vat_high amount_nok_incl_vat_high
     *
     * @return $this
     */
    public function setAmountNokInclVatHigh($amount_nok_incl_vat_high)
    {
        $this->container['amount_nok_incl_vat_high'] = $amount_nok_incl_vat_high;

        return $this;
    }

    /**
     * Gets is_paid_by_employee
     *
     * @return bool
     */
    public function getIsPaidByEmployee()
    {
        return $this->container['is_paid_by_employee'];
    }

    /**
     * Sets is_paid_by_employee
     *
     * @param bool $is_paid_by_employee is_paid_by_employee
     *
     * @return $this
     */
    public function setIsPaidByEmployee($is_paid_by_employee)
    {
        $this->container['is_paid_by_employee'] = $is_paid_by_employee;

        return $this;
    }

    /**
     * Gets is_chargeable
     *
     * @return bool
     */
    public function getIsChargeable()
    {
        return $this->container['is_chargeable'];
    }

    /**
     * Sets is_chargeable
     *
     * @param bool $is_chargeable is_chargeable
     *
     * @return $this
     */
    public function setIsChargeable($is_chargeable)
    {
        $this->container['is_chargeable'] = $is_chargeable;

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
     * Gets predictions
     *
     * @return map[string,\Learnist\Tripletex\Model\Prediction]
     */
    public function getPredictions()
    {
        return $this->container['predictions'];
    }

    /**
     * Sets predictions
     *
     * @param map[string,\Learnist\Tripletex\Model\Prediction] $predictions predictions
     *
     * @return $this
     */
    public function setPredictions($predictions)
    {
        $this->container['predictions'] = $predictions;

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
