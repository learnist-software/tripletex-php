<?php
/**
 * PurchaseOrderline
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
 * PurchaseOrderline Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PurchaseOrderline implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PurchaseOrderline';

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
'purchase_order' => '\Learnist\Tripletex\Model\PurchaseOrder',
'product' => '\Learnist\Tripletex\Model\Product',
'supplier_product' => '\Learnist\Tripletex\Model\SupplierProduct',
'resale_product' => '\Learnist\Tripletex\Model\Product',
'description' => 'string',
'count' => 'float',
'quantity_received' => 'float',
'unit_cost_currency' => 'float',
'unit_price_excluding_vat_currency' => 'float',
'unit_list_price_currency' => 'float',
'unit_price_inc_vat_currency' => 'float',
'currency' => '\Learnist\Tripletex\Model\Currency',
'discount' => 'float',
'amount_excluding_vat_currency' => 'float',
'amount_including_vat_currency' => 'float'    ];

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
'purchase_order' => null,
'product' => null,
'supplier_product' => null,
'resale_product' => null,
'description' => null,
'count' => null,
'quantity_received' => null,
'unit_cost_currency' => null,
'unit_price_excluding_vat_currency' => null,
'unit_list_price_currency' => null,
'unit_price_inc_vat_currency' => null,
'currency' => null,
'discount' => null,
'amount_excluding_vat_currency' => null,
'amount_including_vat_currency' => null    ];

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
'purchase_order' => 'purchaseOrder',
'product' => 'product',
'supplier_product' => 'supplierProduct',
'resale_product' => 'resaleProduct',
'description' => 'description',
'count' => 'count',
'quantity_received' => 'quantityReceived',
'unit_cost_currency' => 'unitCostCurrency',
'unit_price_excluding_vat_currency' => 'unitPriceExcludingVatCurrency',
'unit_list_price_currency' => 'unitListPriceCurrency',
'unit_price_inc_vat_currency' => 'unitPriceIncVatCurrency',
'currency' => 'currency',
'discount' => 'discount',
'amount_excluding_vat_currency' => 'amountExcludingVatCurrency',
'amount_including_vat_currency' => 'amountIncludingVatCurrency'    ];

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
'purchase_order' => 'setPurchaseOrder',
'product' => 'setProduct',
'supplier_product' => 'setSupplierProduct',
'resale_product' => 'setResaleProduct',
'description' => 'setDescription',
'count' => 'setCount',
'quantity_received' => 'setQuantityReceived',
'unit_cost_currency' => 'setUnitCostCurrency',
'unit_price_excluding_vat_currency' => 'setUnitPriceExcludingVatCurrency',
'unit_list_price_currency' => 'setUnitListPriceCurrency',
'unit_price_inc_vat_currency' => 'setUnitPriceIncVatCurrency',
'currency' => 'setCurrency',
'discount' => 'setDiscount',
'amount_excluding_vat_currency' => 'setAmountExcludingVatCurrency',
'amount_including_vat_currency' => 'setAmountIncludingVatCurrency'    ];

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
'purchase_order' => 'getPurchaseOrder',
'product' => 'getProduct',
'supplier_product' => 'getSupplierProduct',
'resale_product' => 'getResaleProduct',
'description' => 'getDescription',
'count' => 'getCount',
'quantity_received' => 'getQuantityReceived',
'unit_cost_currency' => 'getUnitCostCurrency',
'unit_price_excluding_vat_currency' => 'getUnitPriceExcludingVatCurrency',
'unit_list_price_currency' => 'getUnitListPriceCurrency',
'unit_price_inc_vat_currency' => 'getUnitPriceIncVatCurrency',
'currency' => 'getCurrency',
'discount' => 'getDiscount',
'amount_excluding_vat_currency' => 'getAmountExcludingVatCurrency',
'amount_including_vat_currency' => 'getAmountIncludingVatCurrency'    ];

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
        $this->container['purchase_order'] = isset($data['purchase_order']) ? $data['purchase_order'] : null;
        $this->container['product'] = isset($data['product']) ? $data['product'] : null;
        $this->container['supplier_product'] = isset($data['supplier_product']) ? $data['supplier_product'] : null;
        $this->container['resale_product'] = isset($data['resale_product']) ? $data['resale_product'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['count'] = isset($data['count']) ? $data['count'] : null;
        $this->container['quantity_received'] = isset($data['quantity_received']) ? $data['quantity_received'] : null;
        $this->container['unit_cost_currency'] = isset($data['unit_cost_currency']) ? $data['unit_cost_currency'] : null;
        $this->container['unit_price_excluding_vat_currency'] = isset($data['unit_price_excluding_vat_currency']) ? $data['unit_price_excluding_vat_currency'] : null;
        $this->container['unit_list_price_currency'] = isset($data['unit_list_price_currency']) ? $data['unit_list_price_currency'] : null;
        $this->container['unit_price_inc_vat_currency'] = isset($data['unit_price_inc_vat_currency']) ? $data['unit_price_inc_vat_currency'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['discount'] = isset($data['discount']) ? $data['discount'] : null;
        $this->container['amount_excluding_vat_currency'] = isset($data['amount_excluding_vat_currency']) ? $data['amount_excluding_vat_currency'] : null;
        $this->container['amount_including_vat_currency'] = isset($data['amount_including_vat_currency']) ? $data['amount_including_vat_currency'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['purchase_order'] === null) {
            $invalidProperties[] = "'purchase_order' can't be null";
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
     * Gets purchase_order
     *
     * @return \Learnist\Tripletex\Model\PurchaseOrder
     */
    public function getPurchaseOrder()
    {
        return $this->container['purchase_order'];
    }

    /**
     * Sets purchase_order
     *
     * @param \Learnist\Tripletex\Model\PurchaseOrder $purchase_order purchase_order
     *
     * @return $this
     */
    public function setPurchaseOrder($purchase_order)
    {
        $this->container['purchase_order'] = $purchase_order;

        return $this;
    }

    /**
     * Gets product
     *
     * @return \Learnist\Tripletex\Model\Product
     */
    public function getProduct()
    {
        return $this->container['product'];
    }

    /**
     * Sets product
     *
     * @param \Learnist\Tripletex\Model\Product $product product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->container['product'] = $product;

        return $this;
    }

    /**
     * Gets supplier_product
     *
     * @return \Learnist\Tripletex\Model\SupplierProduct
     */
    public function getSupplierProduct()
    {
        return $this->container['supplier_product'];
    }

    /**
     * Sets supplier_product
     *
     * @param \Learnist\Tripletex\Model\SupplierProduct $supplier_product supplier_product
     *
     * @return $this
     */
    public function setSupplierProduct($supplier_product)
    {
        $this->container['supplier_product'] = $supplier_product;

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
     * Gets count
     *
     * @return float
     */
    public function getCount()
    {
        return $this->container['count'];
    }

    /**
     * Sets count
     *
     * @param float $count count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->container['count'] = $count;

        return $this;
    }

    /**
     * Gets quantity_received
     *
     * @return float
     */
    public function getQuantityReceived()
    {
        return $this->container['quantity_received'];
    }

    /**
     * Sets quantity_received
     *
     * @param float $quantity_received Used if the Purchase Order has a Goods received.
     *
     * @return $this
     */
    public function setQuantityReceived($quantity_received)
    {
        $this->container['quantity_received'] = $quantity_received;

        return $this;
    }

    /**
     * Gets unit_cost_currency
     *
     * @return float
     */
    public function getUnitCostCurrency()
    {
        return $this->container['unit_cost_currency'];
    }

    /**
     * Sets unit_cost_currency
     *
     * @param float $unit_cost_currency Unit price purchase (cost) excluding VAT in the order's currency
     *
     * @return $this
     */
    public function setUnitCostCurrency($unit_cost_currency)
    {
        $this->container['unit_cost_currency'] = $unit_cost_currency;

        return $this;
    }

    /**
     * Gets unit_price_excluding_vat_currency
     *
     * @return float
     */
    public function getUnitPriceExcludingVatCurrency()
    {
        return $this->container['unit_price_excluding_vat_currency'];
    }

    /**
     * Sets unit_price_excluding_vat_currency
     *
     * @param float $unit_price_excluding_vat_currency Unit price of purchase excluding VAT in the order's currency.If it's not specified,it takes the value from purchase price in productDTO
     *
     * @return $this
     */
    public function setUnitPriceExcludingVatCurrency($unit_price_excluding_vat_currency)
    {
        $this->container['unit_price_excluding_vat_currency'] = $unit_price_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets unit_list_price_currency
     *
     * @return float
     */
    public function getUnitListPriceCurrency()
    {
        return $this->container['unit_list_price_currency'];
    }

    /**
     * Sets unit_list_price_currency
     *
     * @param float $unit_list_price_currency Unit list price of purchase excluding VAT in the order's currency.If it's not specified,it takes the value from purchase price in productDTO
     *
     * @return $this
     */
    public function setUnitListPriceCurrency($unit_list_price_currency)
    {
        $this->container['unit_list_price_currency'] = $unit_list_price_currency;

        return $this;
    }

    /**
     * Gets unit_price_inc_vat_currency
     *
     * @return float
     */
    public function getUnitPriceIncVatCurrency()
    {
        return $this->container['unit_price_inc_vat_currency'];
    }

    /**
     * Sets unit_price_inc_vat_currency
     *
     * @param float $unit_price_inc_vat_currency Unit  price including VAT in the order's currency.If it's not specified,it takes the value from purchase price in productDTO
     *
     * @return $this
     */
    public function setUnitPriceIncVatCurrency($unit_price_inc_vat_currency)
    {
        $this->container['unit_price_inc_vat_currency'] = $unit_price_inc_vat_currency;

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
     * Gets discount
     *
     * @return float
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param float $discount Discount given as a percentage (%)
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->container['discount'] = $discount;

        return $this;
    }

    /**
     * Gets amount_excluding_vat_currency
     *
     * @return float
     */
    public function getAmountExcludingVatCurrency()
    {
        return $this->container['amount_excluding_vat_currency'];
    }

    /**
     * Sets amount_excluding_vat_currency
     *
     * @param float $amount_excluding_vat_currency Total amount on order line excluding VAT in the order's currency
     *
     * @return $this
     */
    public function setAmountExcludingVatCurrency($amount_excluding_vat_currency)
    {
        $this->container['amount_excluding_vat_currency'] = $amount_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets amount_including_vat_currency
     *
     * @return float
     */
    public function getAmountIncludingVatCurrency()
    {
        return $this->container['amount_including_vat_currency'];
    }

    /**
     * Sets amount_including_vat_currency
     *
     * @param float $amount_including_vat_currency Total amount on order line including VAT in the order's currency
     *
     * @return $this
     */
    public function setAmountIncludingVatCurrency($amount_including_vat_currency)
    {
        $this->container['amount_including_vat_currency'] = $amount_including_vat_currency;

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
