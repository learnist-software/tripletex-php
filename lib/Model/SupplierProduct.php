<?php
/**
 * SupplierProduct
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
 * SupplierProduct Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SupplierProduct implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SupplierProduct';

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
'display_name' => 'string',
'number' => 'string',
'description' => 'string',
'ean' => 'string',
'cost_excluding_vat_currency' => 'float',
'cost' => 'float',
'price_excluding_vat_currency' => 'float',
'price_including_vat_currency' => 'float',
'is_inactive' => 'bool',
'product_unit' => '\Learnist\Tripletex\Model\ProductUnit',
'is_stock_item' => 'bool',
'stock_of_goods' => 'float',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'currency' => '\Learnist\Tripletex\Model\Currency',
'discount_price' => 'float',
'supplier' => '\Learnist\Tripletex\Model\Supplier',
'resale_product' => '\Learnist\Tripletex\Model\Product',
'is_deletable' => 'bool',
'vendor_name' => 'string',
'is_efo_nelfo_product' => 'bool',
'wholesaler_id' => 'int',
'is_main_supplier_product' => 'bool'    ];

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
'display_name' => null,
'number' => null,
'description' => null,
'ean' => null,
'cost_excluding_vat_currency' => null,
'cost' => null,
'price_excluding_vat_currency' => null,
'price_including_vat_currency' => null,
'is_inactive' => null,
'product_unit' => null,
'is_stock_item' => null,
'stock_of_goods' => null,
'vat_type' => null,
'currency' => null,
'discount_price' => null,
'supplier' => null,
'resale_product' => null,
'is_deletable' => null,
'vendor_name' => null,
'is_efo_nelfo_product' => null,
'wholesaler_id' => 'int32',
'is_main_supplier_product' => null    ];

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
'display_name' => 'displayName',
'number' => 'number',
'description' => 'description',
'ean' => 'ean',
'cost_excluding_vat_currency' => 'costExcludingVatCurrency',
'cost' => 'cost',
'price_excluding_vat_currency' => 'priceExcludingVatCurrency',
'price_including_vat_currency' => 'priceIncludingVatCurrency',
'is_inactive' => 'isInactive',
'product_unit' => 'productUnit',
'is_stock_item' => 'isStockItem',
'stock_of_goods' => 'stockOfGoods',
'vat_type' => 'vatType',
'currency' => 'currency',
'discount_price' => 'discountPrice',
'supplier' => 'supplier',
'resale_product' => 'resaleProduct',
'is_deletable' => 'isDeletable',
'vendor_name' => 'vendorName',
'is_efo_nelfo_product' => 'isEfoNelfoProduct',
'wholesaler_id' => 'wholesalerId',
'is_main_supplier_product' => 'isMainSupplierProduct'    ];

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
'display_name' => 'setDisplayName',
'number' => 'setNumber',
'description' => 'setDescription',
'ean' => 'setEan',
'cost_excluding_vat_currency' => 'setCostExcludingVatCurrency',
'cost' => 'setCost',
'price_excluding_vat_currency' => 'setPriceExcludingVatCurrency',
'price_including_vat_currency' => 'setPriceIncludingVatCurrency',
'is_inactive' => 'setIsInactive',
'product_unit' => 'setProductUnit',
'is_stock_item' => 'setIsStockItem',
'stock_of_goods' => 'setStockOfGoods',
'vat_type' => 'setVatType',
'currency' => 'setCurrency',
'discount_price' => 'setDiscountPrice',
'supplier' => 'setSupplier',
'resale_product' => 'setResaleProduct',
'is_deletable' => 'setIsDeletable',
'vendor_name' => 'setVendorName',
'is_efo_nelfo_product' => 'setIsEfoNelfoProduct',
'wholesaler_id' => 'setWholesalerId',
'is_main_supplier_product' => 'setIsMainSupplierProduct'    ];

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
'display_name' => 'getDisplayName',
'number' => 'getNumber',
'description' => 'getDescription',
'ean' => 'getEan',
'cost_excluding_vat_currency' => 'getCostExcludingVatCurrency',
'cost' => 'getCost',
'price_excluding_vat_currency' => 'getPriceExcludingVatCurrency',
'price_including_vat_currency' => 'getPriceIncludingVatCurrency',
'is_inactive' => 'getIsInactive',
'product_unit' => 'getProductUnit',
'is_stock_item' => 'getIsStockItem',
'stock_of_goods' => 'getStockOfGoods',
'vat_type' => 'getVatType',
'currency' => 'getCurrency',
'discount_price' => 'getDiscountPrice',
'supplier' => 'getSupplier',
'resale_product' => 'getResaleProduct',
'is_deletable' => 'getIsDeletable',
'vendor_name' => 'getVendorName',
'is_efo_nelfo_product' => 'getIsEfoNelfoProduct',
'wholesaler_id' => 'getWholesalerId',
'is_main_supplier_product' => 'getIsMainSupplierProduct'    ];

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
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['ean'] = isset($data['ean']) ? $data['ean'] : null;
        $this->container['cost_excluding_vat_currency'] = isset($data['cost_excluding_vat_currency']) ? $data['cost_excluding_vat_currency'] : null;
        $this->container['cost'] = isset($data['cost']) ? $data['cost'] : null;
        $this->container['price_excluding_vat_currency'] = isset($data['price_excluding_vat_currency']) ? $data['price_excluding_vat_currency'] : null;
        $this->container['price_including_vat_currency'] = isset($data['price_including_vat_currency']) ? $data['price_including_vat_currency'] : null;
        $this->container['is_inactive'] = isset($data['is_inactive']) ? $data['is_inactive'] : null;
        $this->container['product_unit'] = isset($data['product_unit']) ? $data['product_unit'] : null;
        $this->container['is_stock_item'] = isset($data['is_stock_item']) ? $data['is_stock_item'] : null;
        $this->container['stock_of_goods'] = isset($data['stock_of_goods']) ? $data['stock_of_goods'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['discount_price'] = isset($data['discount_price']) ? $data['discount_price'] : null;
        $this->container['supplier'] = isset($data['supplier']) ? $data['supplier'] : null;
        $this->container['resale_product'] = isset($data['resale_product']) ? $data['resale_product'] : null;
        $this->container['is_deletable'] = isset($data['is_deletable']) ? $data['is_deletable'] : null;
        $this->container['vendor_name'] = isset($data['vendor_name']) ? $data['vendor_name'] : null;
        $this->container['is_efo_nelfo_product'] = isset($data['is_efo_nelfo_product']) ? $data['is_efo_nelfo_product'] : null;
        $this->container['wholesaler_id'] = isset($data['wholesaler_id']) ? $data['wholesaler_id'] : null;
        $this->container['is_main_supplier_product'] = isset($data['is_main_supplier_product']) ? $data['is_main_supplier_product'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['supplier'] === null) {
            $invalidProperties[] = "'supplier' can't be null";
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
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name display_name
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets ean
     *
     * @return string
     */
    public function getEan()
    {
        return $this->container['ean'];
    }

    /**
     * Sets ean
     *
     * @param string $ean ean
     *
     * @return $this
     */
    public function setEan($ean)
    {
        $this->container['ean'] = $ean;

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
     * Gets cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->container['cost'];
    }

    /**
     * Sets cost
     *
     * @param float $cost Price purchase (cost) in the company's currency
     *
     * @return $this
     */
    public function setCost($cost)
    {
        $this->container['cost'] = $cost;

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
     * Gets stock_of_goods
     *
     * @return float
     */
    public function getStockOfGoods()
    {
        return $this->container['stock_of_goods'];
    }

    /**
     * Sets stock_of_goods
     *
     * @param float $stock_of_goods stock_of_goods
     *
     * @return $this
     */
    public function setStockOfGoods($stock_of_goods)
    {
        $this->container['stock_of_goods'] = $stock_of_goods;

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
     * Gets supplier
     *
     * @return \Learnist\Tripletex\Model\Supplier
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Learnist\Tripletex\Model\Supplier $supplier supplier
     *
     * @return $this
     */
    public function setSupplier($supplier)
    {
        $this->container['supplier'] = $supplier;

        return $this;
    }

    /**
     * Gets resale_product
     *
     * @return \Learnist\Tripletex\Model\Product
     */
    public function getResaleProduct()
    {
        return $this->container['resale_product'];
    }

    /**
     * Sets resale_product
     *
     * @param \Learnist\Tripletex\Model\Product $resale_product resale_product
     *
     * @return $this
     */
    public function setResaleProduct($resale_product)
    {
        $this->container['resale_product'] = $resale_product;

        return $this;
    }

    /**
     * Gets is_deletable
     *
     * @return bool
     */
    public function getIsDeletable()
    {
        return $this->container['is_deletable'];
    }

    /**
     * Sets is_deletable
     *
     * @param bool $is_deletable is_deletable
     *
     * @return $this
     */
    public function setIsDeletable($is_deletable)
    {
        $this->container['is_deletable'] = $is_deletable;

        return $this;
    }

    /**
     * Gets vendor_name
     *
     * @return string
     */
    public function getVendorName()
    {
        return $this->container['vendor_name'];
    }

    /**
     * Sets vendor_name
     *
     * @param string $vendor_name vendor_name
     *
     * @return $this
     */
    public function setVendorName($vendor_name)
    {
        $this->container['vendor_name'] = $vendor_name;

        return $this;
    }

    /**
     * Gets is_efo_nelfo_product
     *
     * @return bool
     */
    public function getIsEfoNelfoProduct()
    {
        return $this->container['is_efo_nelfo_product'];
    }

    /**
     * Sets is_efo_nelfo_product
     *
     * @param bool $is_efo_nelfo_product is_efo_nelfo_product
     *
     * @return $this
     */
    public function setIsEfoNelfoProduct($is_efo_nelfo_product)
    {
        $this->container['is_efo_nelfo_product'] = $is_efo_nelfo_product;

        return $this;
    }

    /**
     * Gets wholesaler_id
     *
     * @return int
     */
    public function getWholesalerId()
    {
        return $this->container['wholesaler_id'];
    }

    /**
     * Sets wholesaler_id
     *
     * @param int $wholesaler_id wholesaler_id
     *
     * @return $this
     */
    public function setWholesalerId($wholesaler_id)
    {
        $this->container['wholesaler_id'] = $wholesaler_id;

        return $this;
    }

    /**
     * Gets is_main_supplier_product
     *
     * @return bool
     */
    public function getIsMainSupplierProduct()
    {
        return $this->container['is_main_supplier_product'];
    }

    /**
     * Sets is_main_supplier_product
     *
     * @param bool $is_main_supplier_product This feature is available only in pilot
     *
     * @return $this
     */
    public function setIsMainSupplierProduct($is_main_supplier_product)
    {
        $this->container['is_main_supplier_product'] = $is_main_supplier_product;

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
