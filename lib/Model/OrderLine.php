<?php
/**
 * OrderLine
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
 * OrderLine Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OrderLine implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'OrderLine';

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
        'product' => '\Learnist\Tripletex\Model\Product',
        'inventory' => '\Learnist\Tripletex\Model\Inventory',
        'inventory_location' => '\Learnist\Tripletex\Model\InventoryLocation',
        'description' => 'string',
        'count' => 'float',
        'unit_cost_currency' => 'float',
        'unit_price_excluding_vat_currency' => 'float',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'markup' => 'float',
        'discount' => 'float',
        'vat_type' => '\Learnist\Tripletex\Model\VatType',
        'amount_excluding_vat_currency' => 'float',
        'amount_including_vat_currency' => 'float',
        'order' => '\Learnist\Tripletex\Model\Order',
        'unit_price_including_vat_currency' => 'float',
        'is_subscription' => 'bool',
        'subscription_period_start' => 'string',
        'subscription_period_end' => 'string',
        'order_group' => '\Learnist\Tripletex\Model\OrderGroup'
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
        'product' => null,
        'inventory' => null,
        'inventory_location' => null,
        'description' => null,
        'count' => null,
        'unit_cost_currency' => null,
        'unit_price_excluding_vat_currency' => null,
        'currency' => null,
        'markup' => null,
        'discount' => null,
        'vat_type' => null,
        'amount_excluding_vat_currency' => null,
        'amount_including_vat_currency' => null,
        'order' => null,
        'unit_price_including_vat_currency' => null,
        'is_subscription' => null,
        'subscription_period_start' => null,
        'subscription_period_end' => null,
        'order_group' => null
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
		'product' => false,
		'inventory' => false,
		'inventory_location' => false,
		'description' => false,
		'count' => false,
		'unit_cost_currency' => false,
		'unit_price_excluding_vat_currency' => false,
		'currency' => false,
		'markup' => false,
		'discount' => false,
		'vat_type' => false,
		'amount_excluding_vat_currency' => false,
		'amount_including_vat_currency' => false,
		'order' => false,
		'unit_price_including_vat_currency' => false,
		'is_subscription' => false,
		'subscription_period_start' => false,
		'subscription_period_end' => false,
		'order_group' => false
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
        'product' => 'product',
        'inventory' => 'inventory',
        'inventory_location' => 'inventoryLocation',
        'description' => 'description',
        'count' => 'count',
        'unit_cost_currency' => 'unitCostCurrency',
        'unit_price_excluding_vat_currency' => 'unitPriceExcludingVatCurrency',
        'currency' => 'currency',
        'markup' => 'markup',
        'discount' => 'discount',
        'vat_type' => 'vatType',
        'amount_excluding_vat_currency' => 'amountExcludingVatCurrency',
        'amount_including_vat_currency' => 'amountIncludingVatCurrency',
        'order' => 'order',
        'unit_price_including_vat_currency' => 'unitPriceIncludingVatCurrency',
        'is_subscription' => 'isSubscription',
        'subscription_period_start' => 'subscriptionPeriodStart',
        'subscription_period_end' => 'subscriptionPeriodEnd',
        'order_group' => 'orderGroup'
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
        'product' => 'setProduct',
        'inventory' => 'setInventory',
        'inventory_location' => 'setInventoryLocation',
        'description' => 'setDescription',
        'count' => 'setCount',
        'unit_cost_currency' => 'setUnitCostCurrency',
        'unit_price_excluding_vat_currency' => 'setUnitPriceExcludingVatCurrency',
        'currency' => 'setCurrency',
        'markup' => 'setMarkup',
        'discount' => 'setDiscount',
        'vat_type' => 'setVatType',
        'amount_excluding_vat_currency' => 'setAmountExcludingVatCurrency',
        'amount_including_vat_currency' => 'setAmountIncludingVatCurrency',
        'order' => 'setOrder',
        'unit_price_including_vat_currency' => 'setUnitPriceIncludingVatCurrency',
        'is_subscription' => 'setIsSubscription',
        'subscription_period_start' => 'setSubscriptionPeriodStart',
        'subscription_period_end' => 'setSubscriptionPeriodEnd',
        'order_group' => 'setOrderGroup'
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
        'product' => 'getProduct',
        'inventory' => 'getInventory',
        'inventory_location' => 'getInventoryLocation',
        'description' => 'getDescription',
        'count' => 'getCount',
        'unit_cost_currency' => 'getUnitCostCurrency',
        'unit_price_excluding_vat_currency' => 'getUnitPriceExcludingVatCurrency',
        'currency' => 'getCurrency',
        'markup' => 'getMarkup',
        'discount' => 'getDiscount',
        'vat_type' => 'getVatType',
        'amount_excluding_vat_currency' => 'getAmountExcludingVatCurrency',
        'amount_including_vat_currency' => 'getAmountIncludingVatCurrency',
        'order' => 'getOrder',
        'unit_price_including_vat_currency' => 'getUnitPriceIncludingVatCurrency',
        'is_subscription' => 'getIsSubscription',
        'subscription_period_start' => 'getSubscriptionPeriodStart',
        'subscription_period_end' => 'getSubscriptionPeriodEnd',
        'order_group' => 'getOrderGroup'
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
        $this->setIfExists('product', $data ?? [], null);
        $this->setIfExists('inventory', $data ?? [], null);
        $this->setIfExists('inventory_location', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('count', $data ?? [], null);
        $this->setIfExists('unit_cost_currency', $data ?? [], null);
        $this->setIfExists('unit_price_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('markup', $data ?? [], null);
        $this->setIfExists('discount', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('amount_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('amount_including_vat_currency', $data ?? [], null);
        $this->setIfExists('order', $data ?? [], null);
        $this->setIfExists('unit_price_including_vat_currency', $data ?? [], null);
        $this->setIfExists('is_subscription', $data ?? [], null);
        $this->setIfExists('subscription_period_start', $data ?? [], null);
        $this->setIfExists('subscription_period_end', $data ?? [], null);
        $this->setIfExists('order_group', $data ?? [], null);
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
     * Gets product
     *
     * @return \Learnist\Tripletex\Model\Product|null
     */
    public function getProduct()
    {
        return $this->container['product'];
    }

    /**
     * Sets product
     *
     * @param \Learnist\Tripletex\Model\Product|null $product product
     *
     * @return self
     */
    public function setProduct($product)
    {

        if (is_null($product)) {
            throw new \InvalidArgumentException('non-nullable product cannot be null');
        }

        $this->container['product'] = $product;

        return $this;
    }

    /**
     * Gets inventory
     *
     * @return \Learnist\Tripletex\Model\Inventory|null
     */
    public function getInventory()
    {
        return $this->container['inventory'];
    }

    /**
     * Sets inventory
     *
     * @param \Learnist\Tripletex\Model\Inventory|null $inventory inventory
     *
     * @return self
     */
    public function setInventory($inventory)
    {

        if (is_null($inventory)) {
            throw new \InvalidArgumentException('non-nullable inventory cannot be null');
        }

        $this->container['inventory'] = $inventory;

        return $this;
    }

    /**
     * Gets inventory_location
     *
     * @return \Learnist\Tripletex\Model\InventoryLocation|null
     */
    public function getInventoryLocation()
    {
        return $this->container['inventory_location'];
    }

    /**
     * Sets inventory_location
     *
     * @param \Learnist\Tripletex\Model\InventoryLocation|null $inventory_location inventory_location
     *
     * @return self
     */
    public function setInventoryLocation($inventory_location)
    {

        if (is_null($inventory_location)) {
            throw new \InvalidArgumentException('non-nullable inventory_location cannot be null');
        }

        $this->container['inventory_location'] = $inventory_location;

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
     * Gets count
     *
     * @return float|null
     */
    public function getCount()
    {
        return $this->container['count'];
    }

    /**
     * Sets count
     *
     * @param float|null $count count
     *
     * @return self
     */
    public function setCount($count)
    {

        if (is_null($count)) {
            throw new \InvalidArgumentException('non-nullable count cannot be null');
        }

        $this->container['count'] = $count;

        return $this;
    }

    /**
     * Gets unit_cost_currency
     *
     * @return float|null
     */
    public function getUnitCostCurrency()
    {
        return $this->container['unit_cost_currency'];
    }

    /**
     * Sets unit_cost_currency
     *
     * @param float|null $unit_cost_currency Unit price purchase (cost) excluding VAT in the order's currency
     *
     * @return self
     */
    public function setUnitCostCurrency($unit_cost_currency)
    {

        if (is_null($unit_cost_currency)) {
            throw new \InvalidArgumentException('non-nullable unit_cost_currency cannot be null');
        }

        $this->container['unit_cost_currency'] = $unit_cost_currency;

        return $this;
    }

    /**
     * Gets unit_price_excluding_vat_currency
     *
     * @return float|null
     */
    public function getUnitPriceExcludingVatCurrency()
    {
        return $this->container['unit_price_excluding_vat_currency'];
    }

    /**
     * Sets unit_price_excluding_vat_currency
     *
     * @param float|null $unit_price_excluding_vat_currency Unit price of purchase excluding VAT in the order's currency
     *
     * @return self
     */
    public function setUnitPriceExcludingVatCurrency($unit_price_excluding_vat_currency)
    {

        if (is_null($unit_price_excluding_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable unit_price_excluding_vat_currency cannot be null');
        }

        $this->container['unit_price_excluding_vat_currency'] = $unit_price_excluding_vat_currency;

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
     * Gets markup
     *
     * @return float|null
     */
    public function getMarkup()
    {
        return $this->container['markup'];
    }

    /**
     * Sets markup
     *
     * @param float|null $markup Markup given as a percentage (%)
     *
     * @return self
     */
    public function setMarkup($markup)
    {

        if (is_null($markup)) {
            throw new \InvalidArgumentException('non-nullable markup cannot be null');
        }

        $this->container['markup'] = $markup;

        return $this;
    }

    /**
     * Gets discount
     *
     * @return float|null
     */
    public function getDiscount()
    {
        return $this->container['discount'];
    }

    /**
     * Sets discount
     *
     * @param float|null $discount Discount given as a percentage (%)
     *
     * @return self
     */
    public function setDiscount($discount)
    {

        if (is_null($discount)) {
            throw new \InvalidArgumentException('non-nullable discount cannot be null');
        }

        $this->container['discount'] = $discount;

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
     * Gets amount_excluding_vat_currency
     *
     * @return float|null
     */
    public function getAmountExcludingVatCurrency()
    {
        return $this->container['amount_excluding_vat_currency'];
    }

    /**
     * Sets amount_excluding_vat_currency
     *
     * @param float|null $amount_excluding_vat_currency Total amount on order line excluding VAT in the order's currency
     *
     * @return self
     */
    public function setAmountExcludingVatCurrency($amount_excluding_vat_currency)
    {

        if (is_null($amount_excluding_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_excluding_vat_currency cannot be null');
        }

        $this->container['amount_excluding_vat_currency'] = $amount_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets amount_including_vat_currency
     *
     * @return float|null
     */
    public function getAmountIncludingVatCurrency()
    {
        return $this->container['amount_including_vat_currency'];
    }

    /**
     * Sets amount_including_vat_currency
     *
     * @param float|null $amount_including_vat_currency Total amount on order line including VAT in the order's currency
     *
     * @return self
     */
    public function setAmountIncludingVatCurrency($amount_including_vat_currency)
    {

        if (is_null($amount_including_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_including_vat_currency cannot be null');
        }

        $this->container['amount_including_vat_currency'] = $amount_including_vat_currency;

        return $this;
    }

    /**
     * Gets order
     *
     * @return \Learnist\Tripletex\Model\Order|null
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order
     *
     * @param \Learnist\Tripletex\Model\Order|null $order order
     *
     * @return self
     */
    public function setOrder($order)
    {

        if (is_null($order)) {
            throw new \InvalidArgumentException('non-nullable order cannot be null');
        }

        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets unit_price_including_vat_currency
     *
     * @return float|null
     */
    public function getUnitPriceIncludingVatCurrency()
    {
        return $this->container['unit_price_including_vat_currency'];
    }

    /**
     * Sets unit_price_including_vat_currency
     *
     * @param float|null $unit_price_including_vat_currency Unit price of purchase including VAT in the order's currency
     *
     * @return self
     */
    public function setUnitPriceIncludingVatCurrency($unit_price_including_vat_currency)
    {

        if (is_null($unit_price_including_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable unit_price_including_vat_currency cannot be null');
        }

        $this->container['unit_price_including_vat_currency'] = $unit_price_including_vat_currency;

        return $this;
    }

    /**
     * Gets is_subscription
     *
     * @return bool|null
     */
    public function getIsSubscription()
    {
        return $this->container['is_subscription'];
    }

    /**
     * Sets is_subscription
     *
     * @param bool|null $is_subscription is_subscription
     *
     * @return self
     */
    public function setIsSubscription($is_subscription)
    {

        if (is_null($is_subscription)) {
            throw new \InvalidArgumentException('non-nullable is_subscription cannot be null');
        }

        $this->container['is_subscription'] = $is_subscription;

        return $this;
    }

    /**
     * Gets subscription_period_start
     *
     * @return string|null
     */
    public function getSubscriptionPeriodStart()
    {
        return $this->container['subscription_period_start'];
    }

    /**
     * Sets subscription_period_start
     *
     * @param string|null $subscription_period_start subscription_period_start
     *
     * @return self
     */
    public function setSubscriptionPeriodStart($subscription_period_start)
    {

        if (is_null($subscription_period_start)) {
            throw new \InvalidArgumentException('non-nullable subscription_period_start cannot be null');
        }

        $this->container['subscription_period_start'] = $subscription_period_start;

        return $this;
    }

    /**
     * Gets subscription_period_end
     *
     * @return string|null
     */
    public function getSubscriptionPeriodEnd()
    {
        return $this->container['subscription_period_end'];
    }

    /**
     * Sets subscription_period_end
     *
     * @param string|null $subscription_period_end subscription_period_end
     *
     * @return self
     */
    public function setSubscriptionPeriodEnd($subscription_period_end)
    {

        if (is_null($subscription_period_end)) {
            throw new \InvalidArgumentException('non-nullable subscription_period_end cannot be null');
        }

        $this->container['subscription_period_end'] = $subscription_period_end;

        return $this;
    }

    /**
     * Gets order_group
     *
     * @return \Learnist\Tripletex\Model\OrderGroup|null
     */
    public function getOrderGroup()
    {
        return $this->container['order_group'];
    }

    /**
     * Sets order_group
     *
     * @param \Learnist\Tripletex\Model\OrderGroup|null $order_group order_group
     *
     * @return self
     */
    public function setOrderGroup($order_group)
    {

        if (is_null($order_group)) {
            throw new \InvalidArgumentException('non-nullable order_group cannot be null');
        }

        $this->container['order_group'] = $order_group;

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


