<?php
/**
 * VfFactoringOffer
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
 * VfFactoringOffer Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class VfFactoringOffer implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'VfFactoringOffer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'offer_id' => 'string',
        'order_id' => 'int',
        'offer_product_type' => 'string',
        'offer_type' => 'string',
        'variable_fee_vat_amount' => 'float',
        'variable_fee_vat_excluded' => 'float',
        'variable_fee_price_percentage' => 'float',
        'variable_fee_minimum_fee_hit' => 'bool',
        'fixed_fee_vat_amount' => 'float',
        'fixed_fee_vat_excluded' => 'float',
        'you_will_receive' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'offer_id' => null,
        'order_id' => 'int32',
        'offer_product_type' => null,
        'offer_type' => null,
        'variable_fee_vat_amount' => null,
        'variable_fee_vat_excluded' => null,
        'variable_fee_price_percentage' => null,
        'variable_fee_minimum_fee_hit' => null,
        'fixed_fee_vat_amount' => null,
        'fixed_fee_vat_excluded' => null,
        'you_will_receive' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'offer_id' => false,
		'order_id' => false,
		'offer_product_type' => false,
		'offer_type' => false,
		'variable_fee_vat_amount' => false,
		'variable_fee_vat_excluded' => false,
		'variable_fee_price_percentage' => false,
		'variable_fee_minimum_fee_hit' => false,
		'fixed_fee_vat_amount' => false,
		'fixed_fee_vat_excluded' => false,
		'you_will_receive' => false
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
        'offer_id' => 'offerId',
        'order_id' => 'orderId',
        'offer_product_type' => 'offerProductType',
        'offer_type' => 'offerType',
        'variable_fee_vat_amount' => 'variableFeeVatAmount',
        'variable_fee_vat_excluded' => 'variableFeeVatExcluded',
        'variable_fee_price_percentage' => 'variableFeePricePercentage',
        'variable_fee_minimum_fee_hit' => 'variableFeeMinimumFeeHit',
        'fixed_fee_vat_amount' => 'fixedFeeVatAmount',
        'fixed_fee_vat_excluded' => 'fixedFeeVatExcluded',
        'you_will_receive' => 'youWillReceive'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'offer_id' => 'setOfferId',
        'order_id' => 'setOrderId',
        'offer_product_type' => 'setOfferProductType',
        'offer_type' => 'setOfferType',
        'variable_fee_vat_amount' => 'setVariableFeeVatAmount',
        'variable_fee_vat_excluded' => 'setVariableFeeVatExcluded',
        'variable_fee_price_percentage' => 'setVariableFeePricePercentage',
        'variable_fee_minimum_fee_hit' => 'setVariableFeeMinimumFeeHit',
        'fixed_fee_vat_amount' => 'setFixedFeeVatAmount',
        'fixed_fee_vat_excluded' => 'setFixedFeeVatExcluded',
        'you_will_receive' => 'setYouWillReceive'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'offer_id' => 'getOfferId',
        'order_id' => 'getOrderId',
        'offer_product_type' => 'getOfferProductType',
        'offer_type' => 'getOfferType',
        'variable_fee_vat_amount' => 'getVariableFeeVatAmount',
        'variable_fee_vat_excluded' => 'getVariableFeeVatExcluded',
        'variable_fee_price_percentage' => 'getVariableFeePricePercentage',
        'variable_fee_minimum_fee_hit' => 'getVariableFeeMinimumFeeHit',
        'fixed_fee_vat_amount' => 'getFixedFeeVatAmount',
        'fixed_fee_vat_excluded' => 'getFixedFeeVatExcluded',
        'you_will_receive' => 'getYouWillReceive'
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

    public const OFFER_PRODUCT_TYPE_RECOURSE = 'RECOURSE';
    public const OFFER_PRODUCT_TYPE_NO_RECOURSE = 'NO_RECOURSE';
    public const OFFER_PRODUCT_TYPE_ARM = 'ARM';
    public const OFFER_TYPE_SOFT_OFFER = 'SOFT_OFFER';
    public const OFFER_TYPE_HARD_OFFER = 'HARD_OFFER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOfferProductTypeAllowableValues()
    {
        return [
            self::OFFER_PRODUCT_TYPE_RECOURSE,
            self::OFFER_PRODUCT_TYPE_NO_RECOURSE,
            self::OFFER_PRODUCT_TYPE_ARM,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOfferTypeAllowableValues()
    {
        return [
            self::OFFER_TYPE_SOFT_OFFER,
            self::OFFER_TYPE_HARD_OFFER,
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
        $this->setIfExists('offer_id', $data ?? [], null);
        $this->setIfExists('order_id', $data ?? [], null);
        $this->setIfExists('offer_product_type', $data ?? [], null);
        $this->setIfExists('offer_type', $data ?? [], null);
        $this->setIfExists('variable_fee_vat_amount', $data ?? [], null);
        $this->setIfExists('variable_fee_vat_excluded', $data ?? [], null);
        $this->setIfExists('variable_fee_price_percentage', $data ?? [], null);
        $this->setIfExists('variable_fee_minimum_fee_hit', $data ?? [], null);
        $this->setIfExists('fixed_fee_vat_amount', $data ?? [], null);
        $this->setIfExists('fixed_fee_vat_excluded', $data ?? [], null);
        $this->setIfExists('you_will_receive', $data ?? [], null);
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

        if (!is_null($this->container['order_id']) && ($this->container['order_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'order_id', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getOfferProductTypeAllowableValues();
        if (!is_null($this->container['offer_product_type']) && !in_array($this->container['offer_product_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'offer_product_type', must be one of '%s'",
                $this->container['offer_product_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getOfferTypeAllowableValues();
        if (!is_null($this->container['offer_type']) && !in_array($this->container['offer_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'offer_type', must be one of '%s'",
                $this->container['offer_type'],
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
     * Gets offer_id
     *
     * @return string|null
     */
    public function getOfferId()
    {
        return $this->container['offer_id'];
    }

    /**
     * Sets offer_id
     *
     * @param string|null $offer_id offer_id
     *
     * @return self
     */
    public function setOfferId($offer_id)
    {
        if (is_null($offer_id)) {
            throw new \InvalidArgumentException('non-nullable offer_id cannot be null');
        }
        $this->container['offer_id'] = $offer_id;

        return $this;
    }

    /**
     * Gets order_id
     *
     * @return int|null
     */
    public function getOrderId()
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param int|null $order_id order_id
     *
     * @return self
     */
    public function setOrderId($order_id)
    {
        if (is_null($order_id)) {
            throw new \InvalidArgumentException('non-nullable order_id cannot be null');
        }

        if (($order_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $order_id when calling VfFactoringOffer., must be bigger than or equal to 0.');
        }

        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets offer_product_type
     *
     * @return string|null
     */
    public function getOfferProductType()
    {
        return $this->container['offer_product_type'];
    }

    /**
     * Sets offer_product_type
     *
     * @param string|null $offer_product_type offer_product_type
     *
     * @return self
     */
    public function setOfferProductType($offer_product_type)
    {
        if (is_null($offer_product_type)) {
            throw new \InvalidArgumentException('non-nullable offer_product_type cannot be null');
        }
        $allowedValues = $this->getOfferProductTypeAllowableValues();
        if (!in_array($offer_product_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'offer_product_type', must be one of '%s'",
                    $offer_product_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['offer_product_type'] = $offer_product_type;

        return $this;
    }

    /**
     * Gets offer_type
     *
     * @return string|null
     */
    public function getOfferType()
    {
        return $this->container['offer_type'];
    }

    /**
     * Sets offer_type
     *
     * @param string|null $offer_type offer_type
     *
     * @return self
     */
    public function setOfferType($offer_type)
    {
        if (is_null($offer_type)) {
            throw new \InvalidArgumentException('non-nullable offer_type cannot be null');
        }
        $allowedValues = $this->getOfferTypeAllowableValues();
        if (!in_array($offer_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'offer_type', must be one of '%s'",
                    $offer_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['offer_type'] = $offer_type;

        return $this;
    }

    /**
     * Gets variable_fee_vat_amount
     *
     * @return float|null
     */
    public function getVariableFeeVatAmount()
    {
        return $this->container['variable_fee_vat_amount'];
    }

    /**
     * Sets variable_fee_vat_amount
     *
     * @param float|null $variable_fee_vat_amount variable_fee_vat_amount
     *
     * @return self
     */
    public function setVariableFeeVatAmount($variable_fee_vat_amount)
    {
        if (is_null($variable_fee_vat_amount)) {
            throw new \InvalidArgumentException('non-nullable variable_fee_vat_amount cannot be null');
        }
        $this->container['variable_fee_vat_amount'] = $variable_fee_vat_amount;

        return $this;
    }

    /**
     * Gets variable_fee_vat_excluded
     *
     * @return float|null
     */
    public function getVariableFeeVatExcluded()
    {
        return $this->container['variable_fee_vat_excluded'];
    }

    /**
     * Sets variable_fee_vat_excluded
     *
     * @param float|null $variable_fee_vat_excluded variable_fee_vat_excluded
     *
     * @return self
     */
    public function setVariableFeeVatExcluded($variable_fee_vat_excluded)
    {
        if (is_null($variable_fee_vat_excluded)) {
            throw new \InvalidArgumentException('non-nullable variable_fee_vat_excluded cannot be null');
        }
        $this->container['variable_fee_vat_excluded'] = $variable_fee_vat_excluded;

        return $this;
    }

    /**
     * Gets variable_fee_price_percentage
     *
     * @return float|null
     */
    public function getVariableFeePricePercentage()
    {
        return $this->container['variable_fee_price_percentage'];
    }

    /**
     * Sets variable_fee_price_percentage
     *
     * @param float|null $variable_fee_price_percentage variable_fee_price_percentage
     *
     * @return self
     */
    public function setVariableFeePricePercentage($variable_fee_price_percentage)
    {
        if (is_null($variable_fee_price_percentage)) {
            throw new \InvalidArgumentException('non-nullable variable_fee_price_percentage cannot be null');
        }
        $this->container['variable_fee_price_percentage'] = $variable_fee_price_percentage;

        return $this;
    }

    /**
     * Gets variable_fee_minimum_fee_hit
     *
     * @return bool|null
     */
    public function getVariableFeeMinimumFeeHit()
    {
        return $this->container['variable_fee_minimum_fee_hit'];
    }

    /**
     * Sets variable_fee_minimum_fee_hit
     *
     * @param bool|null $variable_fee_minimum_fee_hit variable_fee_minimum_fee_hit
     *
     * @return self
     */
    public function setVariableFeeMinimumFeeHit($variable_fee_minimum_fee_hit)
    {
        if (is_null($variable_fee_minimum_fee_hit)) {
            throw new \InvalidArgumentException('non-nullable variable_fee_minimum_fee_hit cannot be null');
        }
        $this->container['variable_fee_minimum_fee_hit'] = $variable_fee_minimum_fee_hit;

        return $this;
    }

    /**
     * Gets fixed_fee_vat_amount
     *
     * @return float|null
     */
    public function getFixedFeeVatAmount()
    {
        return $this->container['fixed_fee_vat_amount'];
    }

    /**
     * Sets fixed_fee_vat_amount
     *
     * @param float|null $fixed_fee_vat_amount fixed_fee_vat_amount
     *
     * @return self
     */
    public function setFixedFeeVatAmount($fixed_fee_vat_amount)
    {
        if (is_null($fixed_fee_vat_amount)) {
            throw new \InvalidArgumentException('non-nullable fixed_fee_vat_amount cannot be null');
        }
        $this->container['fixed_fee_vat_amount'] = $fixed_fee_vat_amount;

        return $this;
    }

    /**
     * Gets fixed_fee_vat_excluded
     *
     * @return float|null
     */
    public function getFixedFeeVatExcluded()
    {
        return $this->container['fixed_fee_vat_excluded'];
    }

    /**
     * Sets fixed_fee_vat_excluded
     *
     * @param float|null $fixed_fee_vat_excluded fixed_fee_vat_excluded
     *
     * @return self
     */
    public function setFixedFeeVatExcluded($fixed_fee_vat_excluded)
    {
        if (is_null($fixed_fee_vat_excluded)) {
            throw new \InvalidArgumentException('non-nullable fixed_fee_vat_excluded cannot be null');
        }
        $this->container['fixed_fee_vat_excluded'] = $fixed_fee_vat_excluded;

        return $this;
    }

    /**
     * Gets you_will_receive
     *
     * @return float|null
     */
    public function getYouWillReceive()
    {
        return $this->container['you_will_receive'];
    }

    /**
     * Sets you_will_receive
     *
     * @param float|null $you_will_receive you_will_receive
     *
     * @return self
     */
    public function setYouWillReceive($you_will_receive)
    {
        if (is_null($you_will_receive)) {
            throw new \InvalidArgumentException('non-nullable you_will_receive cannot be null');
        }
        $this->container['you_will_receive'] = $you_will_receive;

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


