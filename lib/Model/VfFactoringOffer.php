<?php
/**
 * VfFactoringOffer
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
 * VfFactoringOffer Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class VfFactoringOffer implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'VfFactoringOffer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'you_will_receive' => 'float'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'you_will_receive' => null    ];

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
'you_will_receive' => 'youWillReceive'    ];

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
'you_will_receive' => 'setYouWillReceive'    ];

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
'you_will_receive' => 'getYouWillReceive'    ];

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

    const OFFER_PRODUCT_TYPE_RECOURSE = 'RECOURSE';
const OFFER_PRODUCT_TYPE_NO_RECOURSE = 'NO_RECOURSE';
const OFFER_PRODUCT_TYPE_ARM = 'ARM';
const OFFER_TYPE_SOFT_OFFER = 'SOFT_OFFER';
const OFFER_TYPE_HARD_OFFER = 'HARD_OFFER';

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
self::OFFER_PRODUCT_TYPE_ARM,        ];
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
self::OFFER_TYPE_HARD_OFFER,        ];
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
        $this->container['offer_id'] = isset($data['offer_id']) ? $data['offer_id'] : null;
        $this->container['order_id'] = isset($data['order_id']) ? $data['order_id'] : null;
        $this->container['offer_product_type'] = isset($data['offer_product_type']) ? $data['offer_product_type'] : null;
        $this->container['offer_type'] = isset($data['offer_type']) ? $data['offer_type'] : null;
        $this->container['variable_fee_vat_amount'] = isset($data['variable_fee_vat_amount']) ? $data['variable_fee_vat_amount'] : null;
        $this->container['variable_fee_vat_excluded'] = isset($data['variable_fee_vat_excluded']) ? $data['variable_fee_vat_excluded'] : null;
        $this->container['variable_fee_price_percentage'] = isset($data['variable_fee_price_percentage']) ? $data['variable_fee_price_percentage'] : null;
        $this->container['variable_fee_minimum_fee_hit'] = isset($data['variable_fee_minimum_fee_hit']) ? $data['variable_fee_minimum_fee_hit'] : null;
        $this->container['fixed_fee_vat_amount'] = isset($data['fixed_fee_vat_amount']) ? $data['fixed_fee_vat_amount'] : null;
        $this->container['fixed_fee_vat_excluded'] = isset($data['fixed_fee_vat_excluded']) ? $data['fixed_fee_vat_excluded'] : null;
        $this->container['you_will_receive'] = isset($data['you_will_receive']) ? $data['you_will_receive'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getOfferProductTypeAllowableValues();
        if (!is_null($this->container['offer_product_type']) && !in_array($this->container['offer_product_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'offer_product_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getOfferTypeAllowableValues();
        if (!is_null($this->container['offer_type']) && !in_array($this->container['offer_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'offer_type', must be one of '%s'",
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
     * @return string
     */
    public function getOfferId()
    {
        return $this->container['offer_id'];
    }

    /**
     * Sets offer_id
     *
     * @param string $offer_id offer_id
     *
     * @return $this
     */
    public function setOfferId($offer_id)
    {
        $this->container['offer_id'] = $offer_id;

        return $this;
    }

    /**
     * Gets order_id
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param int $order_id order_id
     *
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets offer_product_type
     *
     * @return string
     */
    public function getOfferProductType()
    {
        return $this->container['offer_product_type'];
    }

    /**
     * Sets offer_product_type
     *
     * @param string $offer_product_type offer_product_type
     *
     * @return $this
     */
    public function setOfferProductType($offer_product_type)
    {
        $allowedValues = $this->getOfferProductTypeAllowableValues();
        if (!is_null($offer_product_type) && !in_array($offer_product_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'offer_product_type', must be one of '%s'",
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
     * @return string
     */
    public function getOfferType()
    {
        return $this->container['offer_type'];
    }

    /**
     * Sets offer_type
     *
     * @param string $offer_type offer_type
     *
     * @return $this
     */
    public function setOfferType($offer_type)
    {
        $allowedValues = $this->getOfferTypeAllowableValues();
        if (!is_null($offer_type) && !in_array($offer_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'offer_type', must be one of '%s'",
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
     * @return float
     */
    public function getVariableFeeVatAmount()
    {
        return $this->container['variable_fee_vat_amount'];
    }

    /**
     * Sets variable_fee_vat_amount
     *
     * @param float $variable_fee_vat_amount variable_fee_vat_amount
     *
     * @return $this
     */
    public function setVariableFeeVatAmount($variable_fee_vat_amount)
    {
        $this->container['variable_fee_vat_amount'] = $variable_fee_vat_amount;

        return $this;
    }

    /**
     * Gets variable_fee_vat_excluded
     *
     * @return float
     */
    public function getVariableFeeVatExcluded()
    {
        return $this->container['variable_fee_vat_excluded'];
    }

    /**
     * Sets variable_fee_vat_excluded
     *
     * @param float $variable_fee_vat_excluded variable_fee_vat_excluded
     *
     * @return $this
     */
    public function setVariableFeeVatExcluded($variable_fee_vat_excluded)
    {
        $this->container['variable_fee_vat_excluded'] = $variable_fee_vat_excluded;

        return $this;
    }

    /**
     * Gets variable_fee_price_percentage
     *
     * @return float
     */
    public function getVariableFeePricePercentage()
    {
        return $this->container['variable_fee_price_percentage'];
    }

    /**
     * Sets variable_fee_price_percentage
     *
     * @param float $variable_fee_price_percentage variable_fee_price_percentage
     *
     * @return $this
     */
    public function setVariableFeePricePercentage($variable_fee_price_percentage)
    {
        $this->container['variable_fee_price_percentage'] = $variable_fee_price_percentage;

        return $this;
    }

    /**
     * Gets variable_fee_minimum_fee_hit
     *
     * @return bool
     */
    public function getVariableFeeMinimumFeeHit()
    {
        return $this->container['variable_fee_minimum_fee_hit'];
    }

    /**
     * Sets variable_fee_minimum_fee_hit
     *
     * @param bool $variable_fee_minimum_fee_hit variable_fee_minimum_fee_hit
     *
     * @return $this
     */
    public function setVariableFeeMinimumFeeHit($variable_fee_minimum_fee_hit)
    {
        $this->container['variable_fee_minimum_fee_hit'] = $variable_fee_minimum_fee_hit;

        return $this;
    }

    /**
     * Gets fixed_fee_vat_amount
     *
     * @return float
     */
    public function getFixedFeeVatAmount()
    {
        return $this->container['fixed_fee_vat_amount'];
    }

    /**
     * Sets fixed_fee_vat_amount
     *
     * @param float $fixed_fee_vat_amount fixed_fee_vat_amount
     *
     * @return $this
     */
    public function setFixedFeeVatAmount($fixed_fee_vat_amount)
    {
        $this->container['fixed_fee_vat_amount'] = $fixed_fee_vat_amount;

        return $this;
    }

    /**
     * Gets fixed_fee_vat_excluded
     *
     * @return float
     */
    public function getFixedFeeVatExcluded()
    {
        return $this->container['fixed_fee_vat_excluded'];
    }

    /**
     * Sets fixed_fee_vat_excluded
     *
     * @param float $fixed_fee_vat_excluded fixed_fee_vat_excluded
     *
     * @return $this
     */
    public function setFixedFeeVatExcluded($fixed_fee_vat_excluded)
    {
        $this->container['fixed_fee_vat_excluded'] = $fixed_fee_vat_excluded;

        return $this;
    }

    /**
     * Gets you_will_receive
     *
     * @return float
     */
    public function getYouWillReceive()
    {
        return $this->container['you_will_receive'];
    }

    /**
     * Sets you_will_receive
     *
     * @param float $you_will_receive you_will_receive
     *
     * @return $this
     */
    public function setYouWillReceive($you_will_receive)
    {
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
