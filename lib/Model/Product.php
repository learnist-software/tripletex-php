<?php
/**
 * Product
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
 * Product Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Product implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Product';

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
        'name' => 'string',
        'number' => 'string',
        'display_number' => 'string',
        'description' => 'string',
        'ean' => 'string',
        'el_number' => 'string',
        'nrf_number' => 'string',
        'cost_excluding_vat_currency' => 'float',
        'expenses' => 'float',
        'expenses_in_percent' => 'float',
        'cost_price' => 'float',
        'profit' => 'float',
        'profit_in_percent' => 'float',
        'price_excluding_vat_currency' => 'float',
        'price_including_vat_currency' => 'float',
        'is_inactive' => 'bool',
        'discount_group' => '\Learnist\Tripletex\Model\DiscountGroup',
        'product_unit' => '\Learnist\Tripletex\Model\ProductUnit',
        'is_stock_item' => 'bool',
        'stock_of_goods' => 'float',
        'vat_type' => '\Learnist\Tripletex\Model\VatType',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'department' => '\Learnist\Tripletex\Model\Department',
        'account' => '\Learnist\Tripletex\Model\Account',
        'discount_price' => 'float',
        'supplier' => '\Learnist\Tripletex\Model\Supplier',
        'resale_product' => '\Learnist\Tripletex\Model\Product',
        'is_deletable' => 'bool',
        'has_supplier_product_connected' => 'bool',
        'weight' => 'float',
        'weight_unit' => 'string',
        'volume' => 'float',
        'volume_unit' => 'string',
        'hsn_code' => 'string',
        'image' => '\Learnist\Tripletex\Model\Document',
        'markup_list_percentage' => 'float',
        'markup_net_percentage' => 'float',
        'display_name' => 'string',
        'main_supplier_product' => '\Learnist\Tripletex\Model\SupplierProduct'
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
        'name' => null,
        'number' => null,
        'display_number' => null,
        'description' => null,
        'ean' => null,
        'el_number' => null,
        'nrf_number' => null,
        'cost_excluding_vat_currency' => null,
        'expenses' => null,
        'expenses_in_percent' => null,
        'cost_price' => null,
        'profit' => null,
        'profit_in_percent' => null,
        'price_excluding_vat_currency' => null,
        'price_including_vat_currency' => null,
        'is_inactive' => null,
        'discount_group' => null,
        'product_unit' => null,
        'is_stock_item' => null,
        'stock_of_goods' => null,
        'vat_type' => null,
        'currency' => null,
        'department' => null,
        'account' => null,
        'discount_price' => null,
        'supplier' => null,
        'resale_product' => null,
        'is_deletable' => null,
        'has_supplier_product_connected' => null,
        'weight' => null,
        'weight_unit' => null,
        'volume' => null,
        'volume_unit' => null,
        'hsn_code' => null,
        'image' => null,
        'markup_list_percentage' => null,
        'markup_net_percentage' => null,
        'display_name' => null,
        'main_supplier_product' => null
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
		'name' => false,
		'number' => false,
		'display_number' => false,
		'description' => false,
		'ean' => false,
		'el_number' => false,
		'nrf_number' => false,
		'cost_excluding_vat_currency' => false,
		'expenses' => false,
		'expenses_in_percent' => false,
		'cost_price' => false,
		'profit' => false,
		'profit_in_percent' => false,
		'price_excluding_vat_currency' => false,
		'price_including_vat_currency' => false,
		'is_inactive' => false,
		'discount_group' => false,
		'product_unit' => false,
		'is_stock_item' => false,
		'stock_of_goods' => false,
		'vat_type' => false,
		'currency' => false,
		'department' => false,
		'account' => false,
		'discount_price' => false,
		'supplier' => false,
		'resale_product' => false,
		'is_deletable' => false,
		'has_supplier_product_connected' => false,
		'weight' => false,
		'weight_unit' => false,
		'volume' => false,
		'volume_unit' => false,
		'hsn_code' => false,
		'image' => false,
		'markup_list_percentage' => false,
		'markup_net_percentage' => false,
		'display_name' => false,
		'main_supplier_product' => false
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
        'name' => 'name',
        'number' => 'number',
        'display_number' => 'displayNumber',
        'description' => 'description',
        'ean' => 'ean',
        'el_number' => 'elNumber',
        'nrf_number' => 'nrfNumber',
        'cost_excluding_vat_currency' => 'costExcludingVatCurrency',
        'expenses' => 'expenses',
        'expenses_in_percent' => 'expensesInPercent',
        'cost_price' => 'costPrice',
        'profit' => 'profit',
        'profit_in_percent' => 'profitInPercent',
        'price_excluding_vat_currency' => 'priceExcludingVatCurrency',
        'price_including_vat_currency' => 'priceIncludingVatCurrency',
        'is_inactive' => 'isInactive',
        'discount_group' => 'discountGroup',
        'product_unit' => 'productUnit',
        'is_stock_item' => 'isStockItem',
        'stock_of_goods' => 'stockOfGoods',
        'vat_type' => 'vatType',
        'currency' => 'currency',
        'department' => 'department',
        'account' => 'account',
        'discount_price' => 'discountPrice',
        'supplier' => 'supplier',
        'resale_product' => 'resaleProduct',
        'is_deletable' => 'isDeletable',
        'has_supplier_product_connected' => 'hasSupplierProductConnected',
        'weight' => 'weight',
        'weight_unit' => 'weightUnit',
        'volume' => 'volume',
        'volume_unit' => 'volumeUnit',
        'hsn_code' => 'hsnCode',
        'image' => 'image',
        'markup_list_percentage' => 'markupListPercentage',
        'markup_net_percentage' => 'markupNetPercentage',
        'display_name' => 'displayName',
        'main_supplier_product' => 'mainSupplierProduct'
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
        'name' => 'setName',
        'number' => 'setNumber',
        'display_number' => 'setDisplayNumber',
        'description' => 'setDescription',
        'ean' => 'setEan',
        'el_number' => 'setElNumber',
        'nrf_number' => 'setNrfNumber',
        'cost_excluding_vat_currency' => 'setCostExcludingVatCurrency',
        'expenses' => 'setExpenses',
        'expenses_in_percent' => 'setExpensesInPercent',
        'cost_price' => 'setCostPrice',
        'profit' => 'setProfit',
        'profit_in_percent' => 'setProfitInPercent',
        'price_excluding_vat_currency' => 'setPriceExcludingVatCurrency',
        'price_including_vat_currency' => 'setPriceIncludingVatCurrency',
        'is_inactive' => 'setIsInactive',
        'discount_group' => 'setDiscountGroup',
        'product_unit' => 'setProductUnit',
        'is_stock_item' => 'setIsStockItem',
        'stock_of_goods' => 'setStockOfGoods',
        'vat_type' => 'setVatType',
        'currency' => 'setCurrency',
        'department' => 'setDepartment',
        'account' => 'setAccount',
        'discount_price' => 'setDiscountPrice',
        'supplier' => 'setSupplier',
        'resale_product' => 'setResaleProduct',
        'is_deletable' => 'setIsDeletable',
        'has_supplier_product_connected' => 'setHasSupplierProductConnected',
        'weight' => 'setWeight',
        'weight_unit' => 'setWeightUnit',
        'volume' => 'setVolume',
        'volume_unit' => 'setVolumeUnit',
        'hsn_code' => 'setHsnCode',
        'image' => 'setImage',
        'markup_list_percentage' => 'setMarkupListPercentage',
        'markup_net_percentage' => 'setMarkupNetPercentage',
        'display_name' => 'setDisplayName',
        'main_supplier_product' => 'setMainSupplierProduct'
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
        'name' => 'getName',
        'number' => 'getNumber',
        'display_number' => 'getDisplayNumber',
        'description' => 'getDescription',
        'ean' => 'getEan',
        'el_number' => 'getElNumber',
        'nrf_number' => 'getNrfNumber',
        'cost_excluding_vat_currency' => 'getCostExcludingVatCurrency',
        'expenses' => 'getExpenses',
        'expenses_in_percent' => 'getExpensesInPercent',
        'cost_price' => 'getCostPrice',
        'profit' => 'getProfit',
        'profit_in_percent' => 'getProfitInPercent',
        'price_excluding_vat_currency' => 'getPriceExcludingVatCurrency',
        'price_including_vat_currency' => 'getPriceIncludingVatCurrency',
        'is_inactive' => 'getIsInactive',
        'discount_group' => 'getDiscountGroup',
        'product_unit' => 'getProductUnit',
        'is_stock_item' => 'getIsStockItem',
        'stock_of_goods' => 'getStockOfGoods',
        'vat_type' => 'getVatType',
        'currency' => 'getCurrency',
        'department' => 'getDepartment',
        'account' => 'getAccount',
        'discount_price' => 'getDiscountPrice',
        'supplier' => 'getSupplier',
        'resale_product' => 'getResaleProduct',
        'is_deletable' => 'getIsDeletable',
        'has_supplier_product_connected' => 'getHasSupplierProductConnected',
        'weight' => 'getWeight',
        'weight_unit' => 'getWeightUnit',
        'volume' => 'getVolume',
        'volume_unit' => 'getVolumeUnit',
        'hsn_code' => 'getHsnCode',
        'image' => 'getImage',
        'markup_list_percentage' => 'getMarkupListPercentage',
        'markup_net_percentage' => 'getMarkupNetPercentage',
        'display_name' => 'getDisplayName',
        'main_supplier_product' => 'getMainSupplierProduct'
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

    public const WEIGHT_UNIT_KG = 'kg';
    public const WEIGHT_UNIT_G = 'g';
    public const WEIGHT_UNIT_HG = 'hg';
    public const VOLUME_UNIT_CM3 = 'cm3';
    public const VOLUME_UNIT_DM3 = 'dm3';
    public const VOLUME_UNIT_M3 = 'm3';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getWeightUnitAllowableValues()
    {
        return [
            self::WEIGHT_UNIT_KG,
            self::WEIGHT_UNIT_G,
            self::WEIGHT_UNIT_HG,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVolumeUnitAllowableValues()
    {
        return [
            self::VOLUME_UNIT_CM3,
            self::VOLUME_UNIT_DM3,
            self::VOLUME_UNIT_M3,
        ];
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('display_number', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('ean', $data ?? [], null);
        $this->setIfExists('el_number', $data ?? [], null);
        $this->setIfExists('nrf_number', $data ?? [], null);
        $this->setIfExists('cost_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('expenses', $data ?? [], null);
        $this->setIfExists('expenses_in_percent', $data ?? [], null);
        $this->setIfExists('cost_price', $data ?? [], null);
        $this->setIfExists('profit', $data ?? [], null);
        $this->setIfExists('profit_in_percent', $data ?? [], null);
        $this->setIfExists('price_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('price_including_vat_currency', $data ?? [], null);
        $this->setIfExists('is_inactive', $data ?? [], null);
        $this->setIfExists('discount_group', $data ?? [], null);
        $this->setIfExists('product_unit', $data ?? [], null);
        $this->setIfExists('is_stock_item', $data ?? [], null);
        $this->setIfExists('stock_of_goods', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('account', $data ?? [], null);
        $this->setIfExists('discount_price', $data ?? [], null);
        $this->setIfExists('supplier', $data ?? [], null);
        $this->setIfExists('resale_product', $data ?? [], null);
        $this->setIfExists('is_deletable', $data ?? [], null);
        $this->setIfExists('has_supplier_product_connected', $data ?? [], null);
        $this->setIfExists('weight', $data ?? [], null);
        $this->setIfExists('weight_unit', $data ?? [], null);
        $this->setIfExists('volume', $data ?? [], null);
        $this->setIfExists('volume_unit', $data ?? [], null);
        $this->setIfExists('hsn_code', $data ?? [], null);
        $this->setIfExists('image', $data ?? [], null);
        $this->setIfExists('markup_list_percentage', $data ?? [], null);
        $this->setIfExists('markup_net_percentage', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('main_supplier_product', $data ?? [], null);
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

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['number']) && (mb_strlen($this->container['number']) > 100)) {
            $invalidProperties[] = "invalid value for 'number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['ean']) && (mb_strlen($this->container['ean']) > 14)) {
            $invalidProperties[] = "invalid value for 'ean', the character length must be smaller than or equal to 14.";
        }

        if (!is_null($this->container['el_number']) && (mb_strlen($this->container['el_number']) > 14)) {
            $invalidProperties[] = "invalid value for 'el_number', the character length must be smaller than or equal to 14.";
        }

        if (!is_null($this->container['nrf_number']) && (mb_strlen($this->container['nrf_number']) > 14)) {
            $invalidProperties[] = "invalid value for 'nrf_number', the character length must be smaller than or equal to 14.";
        }

        $allowedValues = $this->getWeightUnitAllowableValues();
        if (!is_null($this->container['weight_unit']) && !in_array($this->container['weight_unit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'weight_unit', must be one of '%s'",
                $this->container['weight_unit'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVolumeUnitAllowableValues();
        if (!is_null($this->container['volume_unit']) && !in_array($this->container['volume_unit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'volume_unit', must be one of '%s'",
                $this->container['volume_unit'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['hsn_code']) && (mb_strlen($this->container['hsn_code']) > 20)) {
            $invalidProperties[] = "invalid value for 'hsn_code', the character length must be smaller than or equal to 20.";
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
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Product., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string|null $number number
     *
     * @return self
     */
    public function setNumber($number)
    {
        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }
        if ((mb_strlen($number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $number when calling Product., must be smaller than or equal to 100.');
        }

        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets display_number
     *
     * @return string|null
     */
    public function getDisplayNumber()
    {
        return $this->container['display_number'];
    }

    /**
     * Sets display_number
     *
     * @param string|null $display_number display_number
     *
     * @return self
     */
    public function setDisplayNumber($display_number)
    {
        if (is_null($display_number)) {
            throw new \InvalidArgumentException('non-nullable display_number cannot be null');
        }
        $this->container['display_number'] = $display_number;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets ean
     *
     * @return string|null
     */
    public function getEan()
    {
        return $this->container['ean'];
    }

    /**
     * Sets ean
     *
     * @param string|null $ean ean
     *
     * @return self
     */
    public function setEan($ean)
    {
        if (is_null($ean)) {
            throw new \InvalidArgumentException('non-nullable ean cannot be null');
        }
        if ((mb_strlen($ean) > 14)) {
            throw new \InvalidArgumentException('invalid length for $ean when calling Product., must be smaller than or equal to 14.');
        }

        $this->container['ean'] = $ean;

        return $this;
    }

    /**
     * Gets el_number
     *
     * @return string|null
     */
    public function getElNumber()
    {
        return $this->container['el_number'];
    }

    /**
     * Sets el_number
     *
     * @param string|null $el_number el_number
     *
     * @return self
     */
    public function setElNumber($el_number)
    {
        if (is_null($el_number)) {
            throw new \InvalidArgumentException('non-nullable el_number cannot be null');
        }
        if ((mb_strlen($el_number) > 14)) {
            throw new \InvalidArgumentException('invalid length for $el_number when calling Product., must be smaller than or equal to 14.');
        }

        $this->container['el_number'] = $el_number;

        return $this;
    }

    /**
     * Gets nrf_number
     *
     * @return string|null
     */
    public function getNrfNumber()
    {
        return $this->container['nrf_number'];
    }

    /**
     * Sets nrf_number
     *
     * @param string|null $nrf_number nrf_number
     *
     * @return self
     */
    public function setNrfNumber($nrf_number)
    {
        if (is_null($nrf_number)) {
            throw new \InvalidArgumentException('non-nullable nrf_number cannot be null');
        }
        if ((mb_strlen($nrf_number) > 14)) {
            throw new \InvalidArgumentException('invalid length for $nrf_number when calling Product., must be smaller than or equal to 14.');
        }

        $this->container['nrf_number'] = $nrf_number;

        return $this;
    }

    /**
     * Gets cost_excluding_vat_currency
     *
     * @return float|null
     */
    public function getCostExcludingVatCurrency()
    {
        return $this->container['cost_excluding_vat_currency'];
    }

    /**
     * Sets cost_excluding_vat_currency
     *
     * @param float|null $cost_excluding_vat_currency Price purchase (cost) excluding VAT in the product's currency
     *
     * @return self
     */
    public function setCostExcludingVatCurrency($cost_excluding_vat_currency)
    {
        if (is_null($cost_excluding_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable cost_excluding_vat_currency cannot be null');
        }
        $this->container['cost_excluding_vat_currency'] = $cost_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets expenses
     *
     * @return float|null
     */
    public function getExpenses()
    {
        return $this->container['expenses'];
    }

    /**
     * Sets expenses
     *
     * @param float|null $expenses expenses
     *
     * @return self
     */
    public function setExpenses($expenses)
    {
        if (is_null($expenses)) {
            throw new \InvalidArgumentException('non-nullable expenses cannot be null');
        }
        $this->container['expenses'] = $expenses;

        return $this;
    }

    /**
     * Gets expenses_in_percent
     *
     * @return float|null
     */
    public function getExpensesInPercent()
    {
        return $this->container['expenses_in_percent'];
    }

    /**
     * Sets expenses_in_percent
     *
     * @param float|null $expenses_in_percent expenses_in_percent
     *
     * @return self
     */
    public function setExpensesInPercent($expenses_in_percent)
    {
        if (is_null($expenses_in_percent)) {
            throw new \InvalidArgumentException('non-nullable expenses_in_percent cannot be null');
        }
        $this->container['expenses_in_percent'] = $expenses_in_percent;

        return $this;
    }

    /**
     * Gets cost_price
     *
     * @return float|null
     */
    public function getCostPrice()
    {
        return $this->container['cost_price'];
    }

    /**
     * Sets cost_price
     *
     * @param float|null $cost_price Cost price of purchase
     *
     * @return self
     */
    public function setCostPrice($cost_price)
    {
        if (is_null($cost_price)) {
            throw new \InvalidArgumentException('non-nullable cost_price cannot be null');
        }
        $this->container['cost_price'] = $cost_price;

        return $this;
    }

    /**
     * Gets profit
     *
     * @return float|null
     */
    public function getProfit()
    {
        return $this->container['profit'];
    }

    /**
     * Sets profit
     *
     * @param float|null $profit profit
     *
     * @return self
     */
    public function setProfit($profit)
    {
        if (is_null($profit)) {
            throw new \InvalidArgumentException('non-nullable profit cannot be null');
        }
        $this->container['profit'] = $profit;

        return $this;
    }

    /**
     * Gets profit_in_percent
     *
     * @return float|null
     */
    public function getProfitInPercent()
    {
        return $this->container['profit_in_percent'];
    }

    /**
     * Sets profit_in_percent
     *
     * @param float|null $profit_in_percent profit_in_percent
     *
     * @return self
     */
    public function setProfitInPercent($profit_in_percent)
    {
        if (is_null($profit_in_percent)) {
            throw new \InvalidArgumentException('non-nullable profit_in_percent cannot be null');
        }
        $this->container['profit_in_percent'] = $profit_in_percent;

        return $this;
    }

    /**
     * Gets price_excluding_vat_currency
     *
     * @return float|null
     */
    public function getPriceExcludingVatCurrency()
    {
        return $this->container['price_excluding_vat_currency'];
    }

    /**
     * Sets price_excluding_vat_currency
     *
     * @param float|null $price_excluding_vat_currency Price of purchase excluding VAT in the product's currency
     *
     * @return self
     */
    public function setPriceExcludingVatCurrency($price_excluding_vat_currency)
    {
        if (is_null($price_excluding_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable price_excluding_vat_currency cannot be null');
        }
        $this->container['price_excluding_vat_currency'] = $price_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets price_including_vat_currency
     *
     * @return float|null
     */
    public function getPriceIncludingVatCurrency()
    {
        return $this->container['price_including_vat_currency'];
    }

    /**
     * Sets price_including_vat_currency
     *
     * @param float|null $price_including_vat_currency Price of purchase including VAT in the product's currency
     *
     * @return self
     */
    public function setPriceIncludingVatCurrency($price_including_vat_currency)
    {
        if (is_null($price_including_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable price_including_vat_currency cannot be null');
        }
        $this->container['price_including_vat_currency'] = $price_including_vat_currency;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool|null
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool|null $is_inactive is_inactive
     *
     * @return self
     */
    public function setIsInactive($is_inactive)
    {
        if (is_null($is_inactive)) {
            throw new \InvalidArgumentException('non-nullable is_inactive cannot be null');
        }
        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets discount_group
     *
     * @return \Learnist\Tripletex\Model\DiscountGroup|null
     */
    public function getDiscountGroup()
    {
        return $this->container['discount_group'];
    }

    /**
     * Sets discount_group
     *
     * @param \Learnist\Tripletex\Model\DiscountGroup|null $discount_group discount_group
     *
     * @return self
     */
    public function setDiscountGroup($discount_group)
    {
        if (is_null($discount_group)) {
            throw new \InvalidArgumentException('non-nullable discount_group cannot be null');
        }
        $this->container['discount_group'] = $discount_group;

        return $this;
    }

    /**
     * Gets product_unit
     *
     * @return \Learnist\Tripletex\Model\ProductUnit|null
     */
    public function getProductUnit()
    {
        return $this->container['product_unit'];
    }

    /**
     * Sets product_unit
     *
     * @param \Learnist\Tripletex\Model\ProductUnit|null $product_unit product_unit
     *
     * @return self
     */
    public function setProductUnit($product_unit)
    {
        if (is_null($product_unit)) {
            throw new \InvalidArgumentException('non-nullable product_unit cannot be null');
        }
        $this->container['product_unit'] = $product_unit;

        return $this;
    }

    /**
     * Gets is_stock_item
     *
     * @return bool|null
     */
    public function getIsStockItem()
    {
        return $this->container['is_stock_item'];
    }

    /**
     * Sets is_stock_item
     *
     * @param bool|null $is_stock_item is_stock_item
     *
     * @return self
     */
    public function setIsStockItem($is_stock_item)
    {
        if (is_null($is_stock_item)) {
            throw new \InvalidArgumentException('non-nullable is_stock_item cannot be null');
        }
        $this->container['is_stock_item'] = $is_stock_item;

        return $this;
    }

    /**
     * Gets stock_of_goods
     *
     * @return float|null
     */
    public function getStockOfGoods()
    {
        return $this->container['stock_of_goods'];
    }

    /**
     * Sets stock_of_goods
     *
     * @param float|null $stock_of_goods From January 23rd 2023 this field will be available only on demand
     *
     * @return self
     */
    public function setStockOfGoods($stock_of_goods)
    {
        if (is_null($stock_of_goods)) {
            throw new \InvalidArgumentException('non-nullable stock_of_goods cannot be null');
        }
        $this->container['stock_of_goods'] = $stock_of_goods;

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
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department|null
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department|null $department department
     *
     * @return self
     */
    public function setDepartment($department)
    {
        if (is_null($department)) {
            throw new \InvalidArgumentException('non-nullable department cannot be null');
        }
        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account|null $account account
     *
     * @return self
     */
    public function setAccount($account)
    {
        if (is_null($account)) {
            throw new \InvalidArgumentException('non-nullable account cannot be null');
        }
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets discount_price
     *
     * @return float|null
     */
    public function getDiscountPrice()
    {
        return $this->container['discount_price'];
    }

    /**
     * Sets discount_price
     *
     * @param float|null $discount_price discount_price
     *
     * @return self
     */
    public function setDiscountPrice($discount_price)
    {
        if (is_null($discount_price)) {
            throw new \InvalidArgumentException('non-nullable discount_price cannot be null');
        }
        $this->container['discount_price'] = $discount_price;

        return $this;
    }

    /**
     * Gets supplier
     *
     * @return \Learnist\Tripletex\Model\Supplier|null
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Learnist\Tripletex\Model\Supplier|null $supplier supplier
     *
     * @return self
     */
    public function setSupplier($supplier)
    {
        if (is_null($supplier)) {
            throw new \InvalidArgumentException('non-nullable supplier cannot be null');
        }
        $this->container['supplier'] = $supplier;

        return $this;
    }

    /**
     * Gets resale_product
     *
     * @return \Learnist\Tripletex\Model\Product|null
     */
    public function getResaleProduct()
    {
        return $this->container['resale_product'];
    }

    /**
     * Sets resale_product
     *
     * @param \Learnist\Tripletex\Model\Product|null $resale_product resale_product
     *
     * @return self
     */
    public function setResaleProduct($resale_product)
    {
        if (is_null($resale_product)) {
            throw new \InvalidArgumentException('non-nullable resale_product cannot be null');
        }
        $this->container['resale_product'] = $resale_product;

        return $this;
    }

    /**
     * Gets is_deletable
     *
     * @return bool|null
     */
    public function getIsDeletable()
    {
        return $this->container['is_deletable'];
    }

    /**
     * Sets is_deletable
     *
     * @param bool|null $is_deletable For performance reasons, field is deprecated and it will always return false.
     *
     * @return self
     */
    public function setIsDeletable($is_deletable)
    {
        if (is_null($is_deletable)) {
            throw new \InvalidArgumentException('non-nullable is_deletable cannot be null');
        }
        $this->container['is_deletable'] = $is_deletable;

        return $this;
    }

    /**
     * Gets has_supplier_product_connected
     *
     * @return bool|null
     */
    public function getHasSupplierProductConnected()
    {
        return $this->container['has_supplier_product_connected'];
    }

    /**
     * Sets has_supplier_product_connected
     *
     * @param bool|null $has_supplier_product_connected has_supplier_product_connected
     *
     * @return self
     */
    public function setHasSupplierProductConnected($has_supplier_product_connected)
    {
        if (is_null($has_supplier_product_connected)) {
            throw new \InvalidArgumentException('non-nullable has_supplier_product_connected cannot be null');
        }
        $this->container['has_supplier_product_connected'] = $has_supplier_product_connected;

        return $this;
    }

    /**
     * Gets weight
     *
     * @return float|null
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param float|null $weight weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        if (is_null($weight)) {
            throw new \InvalidArgumentException('non-nullable weight cannot be null');
        }
        $this->container['weight'] = $weight;

        return $this;
    }

    /**
     * Gets weight_unit
     *
     * @return string|null
     */
    public function getWeightUnit()
    {
        return $this->container['weight_unit'];
    }

    /**
     * Sets weight_unit
     *
     * @param string|null $weight_unit weight_unit
     *
     * @return self
     */
    public function setWeightUnit($weight_unit)
    {
        if (is_null($weight_unit)) {
            throw new \InvalidArgumentException('non-nullable weight_unit cannot be null');
        }
        $allowedValues = $this->getWeightUnitAllowableValues();
        if (!in_array($weight_unit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'weight_unit', must be one of '%s'",
                    $weight_unit,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['weight_unit'] = $weight_unit;

        return $this;
    }

    /**
     * Gets volume
     *
     * @return float|null
     */
    public function getVolume()
    {
        return $this->container['volume'];
    }

    /**
     * Sets volume
     *
     * @param float|null $volume volume
     *
     * @return self
     */
    public function setVolume($volume)
    {
        if (is_null($volume)) {
            throw new \InvalidArgumentException('non-nullable volume cannot be null');
        }
        $this->container['volume'] = $volume;

        return $this;
    }

    /**
     * Gets volume_unit
     *
     * @return string|null
     */
    public function getVolumeUnit()
    {
        return $this->container['volume_unit'];
    }

    /**
     * Sets volume_unit
     *
     * @param string|null $volume_unit volume_unit
     *
     * @return self
     */
    public function setVolumeUnit($volume_unit)
    {
        if (is_null($volume_unit)) {
            throw new \InvalidArgumentException('non-nullable volume_unit cannot be null');
        }
        $allowedValues = $this->getVolumeUnitAllowableValues();
        if (!in_array($volume_unit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'volume_unit', must be one of '%s'",
                    $volume_unit,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['volume_unit'] = $volume_unit;

        return $this;
    }

    /**
     * Gets hsn_code
     *
     * @return string|null
     */
    public function getHsnCode()
    {
        return $this->container['hsn_code'];
    }

    /**
     * Sets hsn_code
     *
     * @param string|null $hsn_code hsn_code
     *
     * @return self
     */
    public function setHsnCode($hsn_code)
    {
        if (is_null($hsn_code)) {
            throw new \InvalidArgumentException('non-nullable hsn_code cannot be null');
        }
        if ((mb_strlen($hsn_code) > 20)) {
            throw new \InvalidArgumentException('invalid length for $hsn_code when calling Product., must be smaller than or equal to 20.');
        }

        $this->container['hsn_code'] = $hsn_code;

        return $this;
    }

    /**
     * Gets image
     *
     * @return \Learnist\Tripletex\Model\Document|null
     */
    public function getImage()
    {
        return $this->container['image'];
    }

    /**
     * Sets image
     *
     * @param \Learnist\Tripletex\Model\Document|null $image image
     *
     * @return self
     */
    public function setImage($image)
    {
        if (is_null($image)) {
            throw new \InvalidArgumentException('non-nullable image cannot be null');
        }
        $this->container['image'] = $image;

        return $this;
    }

    /**
     * Gets markup_list_percentage
     *
     * @return float|null
     */
    public function getMarkupListPercentage()
    {
        return $this->container['markup_list_percentage'];
    }

    /**
     * Sets markup_list_percentage
     *
     * @param float|null $markup_list_percentage markup_list_percentage
     *
     * @return self
     */
    public function setMarkupListPercentage($markup_list_percentage)
    {
        if (is_null($markup_list_percentage)) {
            throw new \InvalidArgumentException('non-nullable markup_list_percentage cannot be null');
        }
        $this->container['markup_list_percentage'] = $markup_list_percentage;

        return $this;
    }

    /**
     * Gets markup_net_percentage
     *
     * @return float|null
     */
    public function getMarkupNetPercentage()
    {
        return $this->container['markup_net_percentage'];
    }

    /**
     * Sets markup_net_percentage
     *
     * @param float|null $markup_net_percentage markup_net_percentage
     *
     * @return self
     */
    public function setMarkupNetPercentage($markup_net_percentage)
    {
        if (is_null($markup_net_percentage)) {
            throw new \InvalidArgumentException('non-nullable markup_net_percentage cannot be null');
        }
        $this->container['markup_net_percentage'] = $markup_net_percentage;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets main_supplier_product
     *
     * @return \Learnist\Tripletex\Model\SupplierProduct|null
     */
    public function getMainSupplierProduct()
    {
        return $this->container['main_supplier_product'];
    }

    /**
     * Sets main_supplier_product
     *
     * @param \Learnist\Tripletex\Model\SupplierProduct|null $main_supplier_product main_supplier_product
     *
     * @return self
     */
    public function setMainSupplierProduct($main_supplier_product)
    {
        if (is_null($main_supplier_product)) {
            throw new \InvalidArgumentException('non-nullable main_supplier_product cannot be null');
        }
        $this->container['main_supplier_product'] = $main_supplier_product;

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


