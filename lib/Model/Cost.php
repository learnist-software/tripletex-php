<?php
/**
 * Cost
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
 * OpenAPI Generator version: 6.3.0-SNAPSHOT
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
 * Cost Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Cost implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Cost';

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
        'predictions' => 'array<string,\Learnist\Tripletex\Model\Prediction>'
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
        'predictions' => null
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
		'travel_expense' => false,
		'vat_type' => false,
		'currency' => false,
		'cost_category' => false,
		'payment_type' => false,
		'category' => false,
		'comments' => false,
		'rate' => false,
		'amount_currency_inc_vat' => false,
		'amount_nok_incl_vat' => false,
		'amount_nok_incl_vat_low' => false,
		'amount_nok_incl_vat_medium' => false,
		'amount_nok_incl_vat_high' => false,
		'is_paid_by_employee' => false,
		'is_chargeable' => false,
		'date' => false,
		'predictions' => false
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
        'predictions' => 'predictions'
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
        'predictions' => 'setPredictions'
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
        'predictions' => 'getPredictions'
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
        $this->setIfExists('travel_expense', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('cost_category', $data ?? [], null);
        $this->setIfExists('payment_type', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('comments', $data ?? [], null);
        $this->setIfExists('rate', $data ?? [], null);
        $this->setIfExists('amount_currency_inc_vat', $data ?? [], null);
        $this->setIfExists('amount_nok_incl_vat', $data ?? [], null);
        $this->setIfExists('amount_nok_incl_vat_low', $data ?? [], null);
        $this->setIfExists('amount_nok_incl_vat_medium', $data ?? [], null);
        $this->setIfExists('amount_nok_incl_vat_high', $data ?? [], null);
        $this->setIfExists('is_paid_by_employee', $data ?? [], null);
        $this->setIfExists('is_chargeable', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('predictions', $data ?? [], null);
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

        if ($this->container['payment_type'] === null) {
            $invalidProperties[] = "'payment_type' can't be null";
        }
        if (!is_null($this->container['category']) && (mb_strlen($this->container['category']) > 100)) {
            $invalidProperties[] = "invalid value for 'category', the character length must be smaller than or equal to 100.";
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
     * Gets travel_expense
     *
     * @return \Learnist\Tripletex\Model\TravelExpense|null
     */
    public function getTravelExpense()
    {
        return $this->container['travel_expense'];
    }

    /**
     * Sets travel_expense
     *
     * @param \Learnist\Tripletex\Model\TravelExpense|null $travel_expense travel_expense
     *
     * @return self
     */
    public function setTravelExpense($travel_expense)
    {

        if (is_null($travel_expense)) {
            throw new \InvalidArgumentException('non-nullable travel_expense cannot be null');
        }

        $this->container['travel_expense'] = $travel_expense;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType|null
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType|null $vat_type vat_type
     *
     * @return self
     */
    public function setVatType($vat_type)
    {

        if (is_null($vat_type)) {
            throw new \InvalidArgumentException('non-nullable vat_type cannot be null');
        }

        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {

        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }

        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets cost_category
     *
     * @return \Learnist\Tripletex\Model\TravelCostCategory|null
     */
    public function getCostCategory()
    {
        return $this->container['cost_category'];
    }

    /**
     * Sets cost_category
     *
     * @param \Learnist\Tripletex\Model\TravelCostCategory|null $cost_category cost_category
     *
     * @return self
     */
    public function setCostCategory($cost_category)
    {

        if (is_null($cost_category)) {
            throw new \InvalidArgumentException('non-nullable cost_category cannot be null');
        }

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
     * @return self
     */
    public function setPaymentType($payment_type)
    {

        if (is_null($payment_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type cannot be null');
        }

        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets category
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string|null $category category
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (!is_null($category) && (mb_strlen($category) > 100)) {
            throw new \InvalidArgumentException('invalid length for $category when calling Cost., must be smaller than or equal to 100.');
        }


        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }

        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param string|null $comments comments
     *
     * @return self
     */
    public function setComments($comments)
    {

        if (is_null($comments)) {
            throw new \InvalidArgumentException('non-nullable comments cannot be null');
        }

        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return float|null
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param float|null $rate rate
     *
     * @return self
     */
    public function setRate($rate)
    {

        if (is_null($rate)) {
            throw new \InvalidArgumentException('non-nullable rate cannot be null');
        }

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
     * @return self
     */
    public function setAmountCurrencyIncVat($amount_currency_inc_vat)
    {

        if (is_null($amount_currency_inc_vat)) {
            throw new \InvalidArgumentException('non-nullable amount_currency_inc_vat cannot be null');
        }

        $this->container['amount_currency_inc_vat'] = $amount_currency_inc_vat;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat
     *
     * @return float|null
     */
    public function getAmountNokInclVat()
    {
        return $this->container['amount_nok_incl_vat'];
    }

    /**
     * Sets amount_nok_incl_vat
     *
     * @param float|null $amount_nok_incl_vat amount_nok_incl_vat
     *
     * @return self
     */
    public function setAmountNokInclVat($amount_nok_incl_vat)
    {

        if (is_null($amount_nok_incl_vat)) {
            throw new \InvalidArgumentException('non-nullable amount_nok_incl_vat cannot be null');
        }

        $this->container['amount_nok_incl_vat'] = $amount_nok_incl_vat;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_low
     *
     * @return float|null
     */
    public function getAmountNokInclVatLow()
    {
        return $this->container['amount_nok_incl_vat_low'];
    }

    /**
     * Sets amount_nok_incl_vat_low
     *
     * @param float|null $amount_nok_incl_vat_low amount_nok_incl_vat_low
     *
     * @return self
     */
    public function setAmountNokInclVatLow($amount_nok_incl_vat_low)
    {

        if (is_null($amount_nok_incl_vat_low)) {
            throw new \InvalidArgumentException('non-nullable amount_nok_incl_vat_low cannot be null');
        }

        $this->container['amount_nok_incl_vat_low'] = $amount_nok_incl_vat_low;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_medium
     *
     * @return float|null
     */
    public function getAmountNokInclVatMedium()
    {
        return $this->container['amount_nok_incl_vat_medium'];
    }

    /**
     * Sets amount_nok_incl_vat_medium
     *
     * @param float|null $amount_nok_incl_vat_medium amount_nok_incl_vat_medium
     *
     * @return self
     */
    public function setAmountNokInclVatMedium($amount_nok_incl_vat_medium)
    {

        if (is_null($amount_nok_incl_vat_medium)) {
            throw new \InvalidArgumentException('non-nullable amount_nok_incl_vat_medium cannot be null');
        }

        $this->container['amount_nok_incl_vat_medium'] = $amount_nok_incl_vat_medium;

        return $this;
    }

    /**
     * Gets amount_nok_incl_vat_high
     *
     * @return float|null
     */
    public function getAmountNokInclVatHigh()
    {
        return $this->container['amount_nok_incl_vat_high'];
    }

    /**
     * Sets amount_nok_incl_vat_high
     *
     * @param float|null $amount_nok_incl_vat_high amount_nok_incl_vat_high
     *
     * @return self
     */
    public function setAmountNokInclVatHigh($amount_nok_incl_vat_high)
    {

        if (is_null($amount_nok_incl_vat_high)) {
            throw new \InvalidArgumentException('non-nullable amount_nok_incl_vat_high cannot be null');
        }

        $this->container['amount_nok_incl_vat_high'] = $amount_nok_incl_vat_high;

        return $this;
    }

    /**
     * Gets is_paid_by_employee
     *
     * @return bool|null
     */
    public function getIsPaidByEmployee()
    {
        return $this->container['is_paid_by_employee'];
    }

    /**
     * Sets is_paid_by_employee
     *
     * @param bool|null $is_paid_by_employee is_paid_by_employee
     *
     * @return self
     */
    public function setIsPaidByEmployee($is_paid_by_employee)
    {

        if (is_null($is_paid_by_employee)) {
            throw new \InvalidArgumentException('non-nullable is_paid_by_employee cannot be null');
        }

        $this->container['is_paid_by_employee'] = $is_paid_by_employee;

        return $this;
    }

    /**
     * Gets is_chargeable
     *
     * @return bool|null
     */
    public function getIsChargeable()
    {
        return $this->container['is_chargeable'];
    }

    /**
     * Sets is_chargeable
     *
     * @param bool|null $is_chargeable is_chargeable
     *
     * @return self
     */
    public function setIsChargeable($is_chargeable)
    {

        if (is_null($is_chargeable)) {
            throw new \InvalidArgumentException('non-nullable is_chargeable cannot be null');
        }

        $this->container['is_chargeable'] = $is_chargeable;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {

        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }

        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets predictions
     *
     * @return array<string,\Learnist\Tripletex\Model\Prediction>|null
     */
    public function getPredictions()
    {
        return $this->container['predictions'];
    }

    /**
     * Sets predictions
     *
     * @param array<string,\Learnist\Tripletex\Model\Prediction>|null $predictions predictions
     *
     * @return self
     */
    public function setPredictions($predictions)
    {

        if (is_null($predictions)) {
            throw new \InvalidArgumentException('non-nullable predictions cannot be null');
        }

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


