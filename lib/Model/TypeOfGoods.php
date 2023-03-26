<?php
/**
 * TypeOfGoods
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
 * TypeOfGoods Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TypeOfGoods implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TypeOfGoods';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'group_id' => 'float',
        'generic_data_type' => 'string',
        'generic_data_sub_type_group_id' => 'float',
        'type_of_goods' => 'string',
        'product_name' => 'string',
        'opening_stock' => 'float',
        'closing_stock' => 'float',
        'purchase_of_goods' => 'float',
        'cost_of_goods_sold' => 'float',
        'sales_revenue_and_withdrawals' => 'float',
        'sales_revenue_in_cash' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'group_id' => null,
        'generic_data_type' => null,
        'generic_data_sub_type_group_id' => null,
        'type_of_goods' => null,
        'product_name' => null,
        'opening_stock' => null,
        'closing_stock' => null,
        'purchase_of_goods' => null,
        'cost_of_goods_sold' => null,
        'sales_revenue_and_withdrawals' => null,
        'sales_revenue_in_cash' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'group_id' => false,
		'generic_data_type' => false,
		'generic_data_sub_type_group_id' => false,
		'type_of_goods' => false,
		'product_name' => false,
		'opening_stock' => false,
		'closing_stock' => false,
		'purchase_of_goods' => false,
		'cost_of_goods_sold' => false,
		'sales_revenue_and_withdrawals' => false,
		'sales_revenue_in_cash' => false
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
        'group_id' => 'groupId',
        'generic_data_type' => 'genericDataType',
        'generic_data_sub_type_group_id' => 'genericDataSubTypeGroupId',
        'type_of_goods' => 'typeOfGoods',
        'product_name' => 'productName',
        'opening_stock' => 'openingStock',
        'closing_stock' => 'closingStock',
        'purchase_of_goods' => 'purchaseOfGoods',
        'cost_of_goods_sold' => 'costOfGoodsSold',
        'sales_revenue_and_withdrawals' => 'salesRevenueAndWithdrawals',
        'sales_revenue_in_cash' => 'salesRevenueInCash'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'group_id' => 'setGroupId',
        'generic_data_type' => 'setGenericDataType',
        'generic_data_sub_type_group_id' => 'setGenericDataSubTypeGroupId',
        'type_of_goods' => 'setTypeOfGoods',
        'product_name' => 'setProductName',
        'opening_stock' => 'setOpeningStock',
        'closing_stock' => 'setClosingStock',
        'purchase_of_goods' => 'setPurchaseOfGoods',
        'cost_of_goods_sold' => 'setCostOfGoodsSold',
        'sales_revenue_and_withdrawals' => 'setSalesRevenueAndWithdrawals',
        'sales_revenue_in_cash' => 'setSalesRevenueInCash'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'group_id' => 'getGroupId',
        'generic_data_type' => 'getGenericDataType',
        'generic_data_sub_type_group_id' => 'getGenericDataSubTypeGroupId',
        'type_of_goods' => 'getTypeOfGoods',
        'product_name' => 'getProductName',
        'opening_stock' => 'getOpeningStock',
        'closing_stock' => 'getClosingStock',
        'purchase_of_goods' => 'getPurchaseOfGoods',
        'cost_of_goods_sold' => 'getCostOfGoodsSold',
        'sales_revenue_and_withdrawals' => 'getSalesRevenueAndWithdrawals',
        'sales_revenue_in_cash' => 'getSalesRevenueInCash'
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

    public const GENERIC_DATA_TYPE_MISC = 'MISC';
    public const GENERIC_DATA_TYPE_TRANSPORT = 'TRANSPORT';
    public const GENERIC_DATA_TYPE_ACCOMMODATION_AND_RESTAURANT = 'ACCOMMODATION_AND_RESTAURANT';
    public const GENERIC_DATA_TYPE_PROFIT_AND_LOSS = 'PROFIT_AND_LOSS';
    public const GENERIC_DATA_TYPE_CUSTOMER_RECEIVABLE = 'CUSTOMER_RECEIVABLE';
    public const GENERIC_DATA_TYPE_INVENTORIES = 'INVENTORIES';
    public const GENERIC_DATA_TYPE_TANGIBLE_FIXED_ASSETS = 'TANGIBLE_FIXED_ASSETS';
    public const GENERIC_DATA_TYPE_RECONCILIATION_OF_EQUITY = 'RECONCILIATION_OF_EQUITY';
    public const GENERIC_DATA_TYPE_PERMANENT_DIFFERENCES = 'PERMANENT_DIFFERENCES';
    public const GENERIC_DATA_TYPE_TEMPORARY_DIFFERENCES = 'TEMPORARY_DIFFERENCES';
    public const GENERIC_DATA_TYPE_DOCUMENT_DOWNLOADED = 'DOCUMENT_DOWNLOADED';
    public const GENERIC_DATA_TYPE_GROUP_CONTRIBUTIONS = 'GROUP_CONTRIBUTIONS';
    public const GENERIC_DATA_TYPE_TAX_RETURN = 'TAX_RETURN';
    public const GENERIC_DATA_TYPE_TAX_CALCULATIONS = 'TAX_CALCULATIONS';
    public const GENERIC_DATA_TYPE_DOCUMENTATION = 'DOCUMENTATION';
    public const TYPE_OF_GOODS_FOOD_STUFFS = 'FOOD_STUFFS';
    public const TYPE_OF_GOODS_TOBACCO_ETC = 'TOBACCO_ETC';
    public const TYPE_OF_GOODS_COFFEE_AND_TEA = 'COFFEE_AND_TEA';
    public const TYPE_OF_GOODS_SOFT_DRINKS = 'SOFT_DRINKS';
    public const TYPE_OF_GOODS_ALCOPOP_AND_CIDER = 'ALCOPOP_AND_CIDER';
    public const TYPE_OF_GOODS_BEER = 'BEER';
    public const TYPE_OF_GOODS_WINE = 'WINE';
    public const TYPE_OF_GOODS_SPIRITS = 'SPIRITS';
    public const TYPE_OF_GOODS_OTHER_PRODUCTS = 'OTHER_PRODUCTS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenericDataTypeAllowableValues()
    {
        return [
            self::GENERIC_DATA_TYPE_MISC,
            self::GENERIC_DATA_TYPE_TRANSPORT,
            self::GENERIC_DATA_TYPE_ACCOMMODATION_AND_RESTAURANT,
            self::GENERIC_DATA_TYPE_PROFIT_AND_LOSS,
            self::GENERIC_DATA_TYPE_CUSTOMER_RECEIVABLE,
            self::GENERIC_DATA_TYPE_INVENTORIES,
            self::GENERIC_DATA_TYPE_TANGIBLE_FIXED_ASSETS,
            self::GENERIC_DATA_TYPE_RECONCILIATION_OF_EQUITY,
            self::GENERIC_DATA_TYPE_PERMANENT_DIFFERENCES,
            self::GENERIC_DATA_TYPE_TEMPORARY_DIFFERENCES,
            self::GENERIC_DATA_TYPE_DOCUMENT_DOWNLOADED,
            self::GENERIC_DATA_TYPE_GROUP_CONTRIBUTIONS,
            self::GENERIC_DATA_TYPE_TAX_RETURN,
            self::GENERIC_DATA_TYPE_TAX_CALCULATIONS,
            self::GENERIC_DATA_TYPE_DOCUMENTATION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeOfGoodsAllowableValues()
    {
        return [
            self::TYPE_OF_GOODS_FOOD_STUFFS,
            self::TYPE_OF_GOODS_TOBACCO_ETC,
            self::TYPE_OF_GOODS_COFFEE_AND_TEA,
            self::TYPE_OF_GOODS_SOFT_DRINKS,
            self::TYPE_OF_GOODS_ALCOPOP_AND_CIDER,
            self::TYPE_OF_GOODS_BEER,
            self::TYPE_OF_GOODS_WINE,
            self::TYPE_OF_GOODS_SPIRITS,
            self::TYPE_OF_GOODS_OTHER_PRODUCTS,
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
        $this->setIfExists('group_id', $data ?? [], null);
        $this->setIfExists('generic_data_type', $data ?? [], null);
        $this->setIfExists('generic_data_sub_type_group_id', $data ?? [], null);
        $this->setIfExists('type_of_goods', $data ?? [], null);
        $this->setIfExists('product_name', $data ?? [], null);
        $this->setIfExists('opening_stock', $data ?? [], null);
        $this->setIfExists('closing_stock', $data ?? [], null);
        $this->setIfExists('purchase_of_goods', $data ?? [], null);
        $this->setIfExists('cost_of_goods_sold', $data ?? [], null);
        $this->setIfExists('sales_revenue_and_withdrawals', $data ?? [], null);
        $this->setIfExists('sales_revenue_in_cash', $data ?? [], null);
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

        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!is_null($this->container['generic_data_type']) && !in_array($this->container['generic_data_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'generic_data_type', must be one of '%s'",
                $this->container['generic_data_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTypeOfGoodsAllowableValues();
        if (!is_null($this->container['type_of_goods']) && !in_array($this->container['type_of_goods'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type_of_goods', must be one of '%s'",
                $this->container['type_of_goods'],
                implode("', '", $allowedValues)
            );
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
     * Gets group_id
     *
     * @return float|null
     */
    public function getGroupId()
    {
        return $this->container['group_id'];
    }

    /**
     * Sets group_id
     *
     * @param float|null $group_id group_id
     *
     * @return self
     */
    public function setGroupId($group_id)
    {
        if (is_null($group_id)) {
            throw new \InvalidArgumentException('non-nullable group_id cannot be null');
        }
        $this->container['group_id'] = $group_id;

        return $this;
    }

    /**
     * Gets generic_data_type
     *
     * @return string|null
     */
    public function getGenericDataType()
    {
        return $this->container['generic_data_type'];
    }

    /**
     * Sets generic_data_type
     *
     * @param string|null $generic_data_type generic_data_type
     *
     * @return self
     */
    public function setGenericDataType($generic_data_type)
    {
        if (is_null($generic_data_type)) {
            throw new \InvalidArgumentException('non-nullable generic_data_type cannot be null');
        }
        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!in_array($generic_data_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'generic_data_type', must be one of '%s'",
                    $generic_data_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['generic_data_type'] = $generic_data_type;

        return $this;
    }

    /**
     * Gets generic_data_sub_type_group_id
     *
     * @return float|null
     */
    public function getGenericDataSubTypeGroupId()
    {
        return $this->container['generic_data_sub_type_group_id'];
    }

    /**
     * Sets generic_data_sub_type_group_id
     *
     * @param float|null $generic_data_sub_type_group_id generic_data_sub_type_group_id
     *
     * @return self
     */
    public function setGenericDataSubTypeGroupId($generic_data_sub_type_group_id)
    {
        if (is_null($generic_data_sub_type_group_id)) {
            throw new \InvalidArgumentException('non-nullable generic_data_sub_type_group_id cannot be null');
        }
        $this->container['generic_data_sub_type_group_id'] = $generic_data_sub_type_group_id;

        return $this;
    }

    /**
     * Gets type_of_goods
     *
     * @return string|null
     */
    public function getTypeOfGoods()
    {
        return $this->container['type_of_goods'];
    }

    /**
     * Sets type_of_goods
     *
     * @param string|null $type_of_goods type_of_goods
     *
     * @return self
     */
    public function setTypeOfGoods($type_of_goods)
    {
        if (is_null($type_of_goods)) {
            throw new \InvalidArgumentException('non-nullable type_of_goods cannot be null');
        }
        $allowedValues = $this->getTypeOfGoodsAllowableValues();
        if (!in_array($type_of_goods, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type_of_goods', must be one of '%s'",
                    $type_of_goods,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type_of_goods'] = $type_of_goods;

        return $this;
    }

    /**
     * Gets product_name
     *
     * @return string|null
     */
    public function getProductName()
    {
        return $this->container['product_name'];
    }

    /**
     * Sets product_name
     *
     * @param string|null $product_name product_name
     *
     * @return self
     */
    public function setProductName($product_name)
    {
        if (is_null($product_name)) {
            throw new \InvalidArgumentException('non-nullable product_name cannot be null');
        }
        $this->container['product_name'] = $product_name;

        return $this;
    }

    /**
     * Gets opening_stock
     *
     * @return float|null
     */
    public function getOpeningStock()
    {
        return $this->container['opening_stock'];
    }

    /**
     * Sets opening_stock
     *
     * @param float|null $opening_stock opening_stock
     *
     * @return self
     */
    public function setOpeningStock($opening_stock)
    {
        if (is_null($opening_stock)) {
            throw new \InvalidArgumentException('non-nullable opening_stock cannot be null');
        }
        $this->container['opening_stock'] = $opening_stock;

        return $this;
    }

    /**
     * Gets closing_stock
     *
     * @return float|null
     */
    public function getClosingStock()
    {
        return $this->container['closing_stock'];
    }

    /**
     * Sets closing_stock
     *
     * @param float|null $closing_stock closing_stock
     *
     * @return self
     */
    public function setClosingStock($closing_stock)
    {
        if (is_null($closing_stock)) {
            throw new \InvalidArgumentException('non-nullable closing_stock cannot be null');
        }
        $this->container['closing_stock'] = $closing_stock;

        return $this;
    }

    /**
     * Gets purchase_of_goods
     *
     * @return float|null
     */
    public function getPurchaseOfGoods()
    {
        return $this->container['purchase_of_goods'];
    }

    /**
     * Sets purchase_of_goods
     *
     * @param float|null $purchase_of_goods purchase_of_goods
     *
     * @return self
     */
    public function setPurchaseOfGoods($purchase_of_goods)
    {
        if (is_null($purchase_of_goods)) {
            throw new \InvalidArgumentException('non-nullable purchase_of_goods cannot be null');
        }
        $this->container['purchase_of_goods'] = $purchase_of_goods;

        return $this;
    }

    /**
     * Gets cost_of_goods_sold
     *
     * @return float|null
     */
    public function getCostOfGoodsSold()
    {
        return $this->container['cost_of_goods_sold'];
    }

    /**
     * Sets cost_of_goods_sold
     *
     * @param float|null $cost_of_goods_sold cost_of_goods_sold
     *
     * @return self
     */
    public function setCostOfGoodsSold($cost_of_goods_sold)
    {
        if (is_null($cost_of_goods_sold)) {
            throw new \InvalidArgumentException('non-nullable cost_of_goods_sold cannot be null');
        }
        $this->container['cost_of_goods_sold'] = $cost_of_goods_sold;

        return $this;
    }

    /**
     * Gets sales_revenue_and_withdrawals
     *
     * @return float|null
     */
    public function getSalesRevenueAndWithdrawals()
    {
        return $this->container['sales_revenue_and_withdrawals'];
    }

    /**
     * Sets sales_revenue_and_withdrawals
     *
     * @param float|null $sales_revenue_and_withdrawals sales_revenue_and_withdrawals
     *
     * @return self
     */
    public function setSalesRevenueAndWithdrawals($sales_revenue_and_withdrawals)
    {
        if (is_null($sales_revenue_and_withdrawals)) {
            throw new \InvalidArgumentException('non-nullable sales_revenue_and_withdrawals cannot be null');
        }
        $this->container['sales_revenue_and_withdrawals'] = $sales_revenue_and_withdrawals;

        return $this;
    }

    /**
     * Gets sales_revenue_in_cash
     *
     * @return float|null
     */
    public function getSalesRevenueInCash()
    {
        return $this->container['sales_revenue_in_cash'];
    }

    /**
     * Sets sales_revenue_in_cash
     *
     * @param float|null $sales_revenue_in_cash sales_revenue_in_cash
     *
     * @return self
     */
    public function setSalesRevenueInCash($sales_revenue_in_cash)
    {
        if (is_null($sales_revenue_in_cash)) {
            throw new \InvalidArgumentException('non-nullable sales_revenue_in_cash cannot be null');
        }
        $this->container['sales_revenue_in_cash'] = $sales_revenue_in_cash;

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


