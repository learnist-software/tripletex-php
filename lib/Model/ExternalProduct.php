<?php
/**
 * ExternalProduct
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
 * ExternalProduct Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ExternalProduct implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ExternalProduct';

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
'el_number' => 'string',
'nrf_number' => 'string',
'cost_excluding_vat_currency' => 'float',
'price_excluding_vat_currency' => 'float',
'price_including_vat_currency' => 'float',
'is_inactive' => 'bool',
'product_unit' => '\Learnist\Tripletex\Model\ProductUnit',
'is_stock_item' => 'bool',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'currency' => '\Learnist\Tripletex\Model\Currency',
'department' => '\Learnist\Tripletex\Model\Department',
'account' => '\Learnist\Tripletex\Model\Account',
'discount_price' => 'float'    ];

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
'el_number' => null,
'nrf_number' => null,
'cost_excluding_vat_currency' => null,
'price_excluding_vat_currency' => null,
'price_including_vat_currency' => null,
'is_inactive' => null,
'product_unit' => null,
'is_stock_item' => null,
'vat_type' => null,
'currency' => null,
'department' => null,
'account' => null,
'discount_price' => null    ];

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
'el_number' => 'elNumber',
'nrf_number' => 'nrfNumber',
'cost_excluding_vat_currency' => 'costExcludingVatCurrency',
'price_excluding_vat_currency' => 'priceExcludingVatCurrency',
'price_including_vat_currency' => 'priceIncludingVatCurrency',
'is_inactive' => 'isInactive',
'product_unit' => 'productUnit',
'is_stock_item' => 'isStockItem',
'vat_type' => 'vatType',
'currency' => 'currency',
'department' => 'department',
'account' => 'account',
'discount_price' => 'discountPrice'    ];

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
'el_number' => 'setElNumber',
'nrf_number' => 'setNrfNumber',
'cost_excluding_vat_currency' => 'setCostExcludingVatCurrency',
'price_excluding_vat_currency' => 'setPriceExcludingVatCurrency',
'price_including_vat_currency' => 'setPriceIncludingVatCurrency',
'is_inactive' => 'setIsInactive',
'product_unit' => 'setProductUnit',
'is_stock_item' => 'setIsStockItem',
'vat_type' => 'setVatType',
'currency' => 'setCurrency',
'department' => 'setDepartment',
'account' => 'setAccount',
'discount_price' => 'setDiscountPrice'    ];

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
'el_number' => 'getElNumber',
'nrf_number' => 'getNrfNumber',
'cost_excluding_vat_currency' => 'getCostExcludingVatCurrency',
'price_excluding_vat_currency' => 'getPriceExcludingVatCurrency',
'price_including_vat_currency' => 'getPriceIncludingVatCurrency',
'is_inactive' => 'getIsInactive',
'product_unit' => 'getProductUnit',
'is_stock_item' => 'getIsStockItem',
'vat_type' => 'getVatType',
'currency' => 'getCurrency',
'department' => 'getDepartment',
'account' => 'getAccount',
'discount_price' => 'getDiscountPrice'    ];

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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['el_number'] = isset($data['el_number']) ? $data['el_number'] : null;
        $this->container['nrf_number'] = isset($data['nrf_number']) ? $data['nrf_number'] : null;
        $this->container['cost_excluding_vat_currency'] = isset($data['cost_excluding_vat_currency']) ? $data['cost_excluding_vat_currency'] : null;
        $this->container['price_excluding_vat_currency'] = isset($data['price_excluding_vat_currency']) ? $data['price_excluding_vat_currency'] : null;
        $this->container['price_including_vat_currency'] = isset($data['price_including_vat_currency']) ? $data['price_including_vat_currency'] : null;
        $this->container['is_inactive'] = isset($data['is_inactive']) ? $data['is_inactive'] : null;
        $this->container['product_unit'] = isset($data['product_unit']) ? $data['product_unit'] : null;
        $this->container['is_stock_item'] = isset($data['is_stock_item']) ? $data['is_stock_item'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['account'] = isset($data['account']) ? $data['account'] : null;
        $this->container['discount_price'] = isset($data['discount_price']) ? $data['discount_price'] : null;
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
     * Gets el_number
     *
     * @return string
     */
    public function getElNumber()
    {
        return $this->container['el_number'];
    }

    /**
     * Sets el_number
     *
     * @param string $el_number el_number
     *
     * @return $this
     */
    public function setElNumber($el_number)
    {
        $this->container['el_number'] = $el_number;

        return $this;
    }

    /**
     * Gets nrf_number
     *
     * @return string
     */
    public function getNrfNumber()
    {
        return $this->container['nrf_number'];
    }

    /**
     * Sets nrf_number
     *
     * @param string $nrf_number nrf_number
     *
     * @return $this
     */
    public function setNrfNumber($nrf_number)
    {
        $this->container['nrf_number'] = $nrf_number;

        return $this;
    }

    /**
     * Gets cost_excluding_vat_currency
     *
     * @return float
     */
    public function getCostExcludingVatCurrency()
    {
        return $this->container['cost_excluding_vat_currency'];
    }

    /**
     * Sets cost_excluding_vat_currency
     *
     * @param float $cost_excluding_vat_currency Price purchase (cost) excluding VAT in the product's currency
     *
     * @return $this
     */
    public function setCostExcludingVatCurrency($cost_excluding_vat_currency)
    {
        $this->container['cost_excluding_vat_currency'] = $cost_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets price_excluding_vat_currency
     *
     * @return float
     */
    public function getPriceExcludingVatCurrency()
    {
        return $this->container['price_excluding_vat_currency'];
    }

    /**
     * Sets price_excluding_vat_currency
     *
     * @param float $price_excluding_vat_currency Price of purchase excluding VAT in the product's currency
     *
     * @return $this
     */
    public function setPriceExcludingVatCurrency($price_excluding_vat_currency)
    {
        $this->container['price_excluding_vat_currency'] = $price_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets price_including_vat_currency
     *
     * @return float
     */
    public function getPriceIncludingVatCurrency()
    {
        return $this->container['price_including_vat_currency'];
    }

    /**
     * Sets price_including_vat_currency
     *
     * @param float $price_including_vat_currency Price of purchase including VAT in the product's currency
     *
     * @return $this
     */
    public function setPriceIncludingVatCurrency($price_including_vat_currency)
    {
        $this->container['price_including_vat_currency'] = $price_including_vat_currency;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool $is_inactive is_inactive
     *
     * @return $this
     */
    public function setIsInactive($is_inactive)
    {
        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets product_unit
     *
     * @return \Learnist\Tripletex\Model\ProductUnit
     */
    public function getProductUnit()
    {
        return $this->container['product_unit'];
    }

    /**
     * Sets product_unit
     *
     * @param \Learnist\Tripletex\Model\ProductUnit $product_unit product_unit
     *
     * @return $this
     */
    public function setProductUnit($product_unit)
    {
        $this->container['product_unit'] = $product_unit;

        return $this;
    }

    /**
     * Gets is_stock_item
     *
     * @return bool
     */
    public function getIsStockItem()
    {
        return $this->container['is_stock_item'];
    }

    /**
     * Sets is_stock_item
     *
     * @param bool $is_stock_item is_stock_item
     *
     * @return $this
     */
    public function setIsStockItem($is_stock_item)
    {
        $this->container['is_stock_item'] = $is_stock_item;

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
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department $department department
     *
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account $account account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets discount_price
     *
     * @return float
     */
    public function getDiscountPrice()
    {
        return $this->container['discount_price'];
    }

    /**
     * Sets discount_price
     *
     * @param float $discount_price discount_price
     *
     * @return $this
     */
    public function setDiscountPrice($discount_price)
    {
        $this->container['discount_price'] = $discount_price;

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
