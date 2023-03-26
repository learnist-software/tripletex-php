<?php
/**
 * SupplierProduct
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
 * SupplierProduct Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SupplierProduct implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SupplierProduct';

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
        'is_main_supplier_product' => 'bool'
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
        'is_main_supplier_product' => null
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
		'display_name' => false,
		'number' => false,
		'description' => false,
		'ean' => false,
		'cost_excluding_vat_currency' => false,
		'cost' => false,
		'price_excluding_vat_currency' => false,
		'price_including_vat_currency' => false,
		'is_inactive' => false,
		'product_unit' => false,
		'is_stock_item' => false,
		'stock_of_goods' => false,
		'vat_type' => false,
		'currency' => false,
		'discount_price' => false,
		'supplier' => false,
		'resale_product' => false,
		'is_deletable' => false,
		'vendor_name' => false,
		'is_efo_nelfo_product' => false,
		'wholesaler_id' => false,
		'is_main_supplier_product' => false
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
        'is_main_supplier_product' => 'isMainSupplierProduct'
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
        'is_main_supplier_product' => 'setIsMainSupplierProduct'
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
        'is_main_supplier_product' => 'getIsMainSupplierProduct'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('ean', $data ?? [], null);
        $this->setIfExists('cost_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('cost', $data ?? [], null);
        $this->setIfExists('price_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('price_including_vat_currency', $data ?? [], null);
        $this->setIfExists('is_inactive', $data ?? [], null);
        $this->setIfExists('product_unit', $data ?? [], null);
        $this->setIfExists('is_stock_item', $data ?? [], null);
        $this->setIfExists('stock_of_goods', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('discount_price', $data ?? [], null);
        $this->setIfExists('supplier', $data ?? [], null);
        $this->setIfExists('resale_product', $data ?? [], null);
        $this->setIfExists('is_deletable', $data ?? [], null);
        $this->setIfExists('vendor_name', $data ?? [], null);
        $this->setIfExists('is_efo_nelfo_product', $data ?? [], null);
        $this->setIfExists('wholesaler_id', $data ?? [], null);
        $this->setIfExists('is_main_supplier_product', $data ?? [], null);
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

        if ($this->container['supplier'] === null) {
            $invalidProperties[] = "'supplier' can't be null";
        }
        if (!is_null($this->container['wholesaler_id']) && ($this->container['wholesaler_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'wholesaler_id', must be bigger than or equal to 0.";
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
            throw new \InvalidArgumentException('invalid length for $name when calling SupplierProduct., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

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
            throw new \InvalidArgumentException('invalid length for $number when calling SupplierProduct., must be smaller than or equal to 100.');
        }

        $this->container['number'] = $number;

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
            throw new \InvalidArgumentException('invalid length for $ean when calling SupplierProduct., must be smaller than or equal to 14.');
        }

        $this->container['ean'] = $ean;

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
     * Gets cost
     *
     * @return float|null
     */
    public function getCost()
    {
        return $this->container['cost'];
    }

    /**
     * Sets cost
     *
     * @param float|null $cost Price purchase (cost) in the company's currency
     *
     * @return self
     */
    public function setCost($cost)
    {
        if (is_null($cost)) {
            throw new \InvalidArgumentException('non-nullable cost cannot be null');
        }
        $this->container['cost'] = $cost;

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
     * @param float|null $stock_of_goods stock_of_goods
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
     * @param bool|null $is_deletable is_deletable
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
     * Gets vendor_name
     *
     * @return string|null
     */
    public function getVendorName()
    {
        return $this->container['vendor_name'];
    }

    /**
     * Sets vendor_name
     *
     * @param string|null $vendor_name vendor_name
     *
     * @return self
     */
    public function setVendorName($vendor_name)
    {
        if (is_null($vendor_name)) {
            throw new \InvalidArgumentException('non-nullable vendor_name cannot be null');
        }
        $this->container['vendor_name'] = $vendor_name;

        return $this;
    }

    /**
     * Gets is_efo_nelfo_product
     *
     * @return bool|null
     */
    public function getIsEfoNelfoProduct()
    {
        return $this->container['is_efo_nelfo_product'];
    }

    /**
     * Sets is_efo_nelfo_product
     *
     * @param bool|null $is_efo_nelfo_product is_efo_nelfo_product
     *
     * @return self
     */
    public function setIsEfoNelfoProduct($is_efo_nelfo_product)
    {
        if (is_null($is_efo_nelfo_product)) {
            throw new \InvalidArgumentException('non-nullable is_efo_nelfo_product cannot be null');
        }
        $this->container['is_efo_nelfo_product'] = $is_efo_nelfo_product;

        return $this;
    }

    /**
     * Gets wholesaler_id
     *
     * @return int|null
     */
    public function getWholesalerId()
    {
        return $this->container['wholesaler_id'];
    }

    /**
     * Sets wholesaler_id
     *
     * @param int|null $wholesaler_id wholesaler_id
     *
     * @return self
     */
    public function setWholesalerId($wholesaler_id)
    {
        if (is_null($wholesaler_id)) {
            throw new \InvalidArgumentException('non-nullable wholesaler_id cannot be null');
        }

        if (($wholesaler_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $wholesaler_id when calling SupplierProduct., must be bigger than or equal to 0.');
        }

        $this->container['wholesaler_id'] = $wholesaler_id;

        return $this;
    }

    /**
     * Gets is_main_supplier_product
     *
     * @return bool|null
     */
    public function getIsMainSupplierProduct()
    {
        return $this->container['is_main_supplier_product'];
    }

    /**
     * Sets is_main_supplier_product
     *
     * @param bool|null $is_main_supplier_product This feature is available only in pilot
     *
     * @return self
     */
    public function setIsMainSupplierProduct($is_main_supplier_product)
    {
        if (is_null($is_main_supplier_product)) {
            throw new \InvalidArgumentException('non-nullable is_main_supplier_product cannot be null');
        }
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


