<?php
/**
 * SalesForceTripletexSalesModulePurchase
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
 * SalesForceTripletexSalesModulePurchase Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalesForceTripletexSalesModulePurchase implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalesForceTripletexSalesModulePurchase';

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
'tripletex_company_id' => 'int',
'tripletex_price_list' => 'string',
'employee_id' => 'int',
'purchase_date' => 'string',
'end_date' => 'string',
'customer_id' => 'int',
'tripletex_sales_module_name' => 'string',
'type' => 'int',
'sales_force_opportunity_dto' => '\Learnist\Tripletex\Model\SalesForceOpportunity'    ];

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
'tripletex_company_id' => 'int32',
'tripletex_price_list' => null,
'employee_id' => 'int32',
'purchase_date' => null,
'end_date' => null,
'customer_id' => 'int32',
'tripletex_sales_module_name' => null,
'type' => 'int32',
'sales_force_opportunity_dto' => null    ];

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
'tripletex_company_id' => 'tripletexCompanyId',
'tripletex_price_list' => 'tripletexPriceList',
'employee_id' => 'employeeId',
'purchase_date' => 'purchaseDate',
'end_date' => 'endDate',
'customer_id' => 'customerId',
'tripletex_sales_module_name' => 'tripletexSalesModuleName',
'type' => 'type',
'sales_force_opportunity_dto' => 'salesForceOpportunityDTO'    ];

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
'tripletex_company_id' => 'setTripletexCompanyId',
'tripletex_price_list' => 'setTripletexPriceList',
'employee_id' => 'setEmployeeId',
'purchase_date' => 'setPurchaseDate',
'end_date' => 'setEndDate',
'customer_id' => 'setCustomerId',
'tripletex_sales_module_name' => 'setTripletexSalesModuleName',
'type' => 'setType',
'sales_force_opportunity_dto' => 'setSalesForceOpportunityDto'    ];

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
'tripletex_company_id' => 'getTripletexCompanyId',
'tripletex_price_list' => 'getTripletexPriceList',
'employee_id' => 'getEmployeeId',
'purchase_date' => 'getPurchaseDate',
'end_date' => 'getEndDate',
'customer_id' => 'getCustomerId',
'tripletex_sales_module_name' => 'getTripletexSalesModuleName',
'type' => 'getType',
'sales_force_opportunity_dto' => 'getSalesForceOpportunityDto'    ];

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

    const TRIPLETEX_PRICE_LIST_TRIPLETEX_OLD_MODEL = 'TRIPLETEX_OLD_MODEL';
const TRIPLETEX_PRICE_LIST_TRIPLETEX_STANDARD = 'TRIPLETEX_STANDARD';
const TRIPLETEX_PRICE_LIST_AGRO = 'AGRO';
const TRIPLETEX_PRICE_LIST_MAMUT = 'MAMUT';
const TRIPLETEX_PRICE_LIST_BASIS = 'BASIS';
const TRIPLETEX_PRICE_LIST_SMART = 'SMART';
const TRIPLETEX_PRICE_LIST_KOMPLETT = 'KOMPLETT';
const TRIPLETEX_PRICE_LIST_VVS_ELEKTRO = 'VVS_ELEKTRO';
const TRIPLETEX_PRICE_LIST_AUTOPLUS = 'AUTOPLUS';
const TRIPLETEX_PRICE_LIST_MIKRO = 'MIKRO';
const TRIPLETEX_PRICE_LIST_INTEGRATION_PARTNER = 'INTEGRATION_PARTNER';
const TRIPLETEX_PRICE_LIST_PLUSS = 'PLUSS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTripletexPriceListAllowableValues()
    {
        return [
            self::TRIPLETEX_PRICE_LIST_TRIPLETEX_OLD_MODEL,
self::TRIPLETEX_PRICE_LIST_TRIPLETEX_STANDARD,
self::TRIPLETEX_PRICE_LIST_AGRO,
self::TRIPLETEX_PRICE_LIST_MAMUT,
self::TRIPLETEX_PRICE_LIST_BASIS,
self::TRIPLETEX_PRICE_LIST_SMART,
self::TRIPLETEX_PRICE_LIST_KOMPLETT,
self::TRIPLETEX_PRICE_LIST_VVS_ELEKTRO,
self::TRIPLETEX_PRICE_LIST_AUTOPLUS,
self::TRIPLETEX_PRICE_LIST_MIKRO,
self::TRIPLETEX_PRICE_LIST_INTEGRATION_PARTNER,
self::TRIPLETEX_PRICE_LIST_PLUSS,        ];
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
        $this->container['tripletex_company_id'] = isset($data['tripletex_company_id']) ? $data['tripletex_company_id'] : null;
        $this->container['tripletex_price_list'] = isset($data['tripletex_price_list']) ? $data['tripletex_price_list'] : null;
        $this->container['employee_id'] = isset($data['employee_id']) ? $data['employee_id'] : null;
        $this->container['purchase_date'] = isset($data['purchase_date']) ? $data['purchase_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->container['tripletex_sales_module_name'] = isset($data['tripletex_sales_module_name']) ? $data['tripletex_sales_module_name'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['sales_force_opportunity_dto'] = isset($data['sales_force_opportunity_dto']) ? $data['sales_force_opportunity_dto'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTripletexPriceListAllowableValues();
        if (!is_null($this->container['tripletex_price_list']) && !in_array($this->container['tripletex_price_list'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'tripletex_price_list', must be one of '%s'",
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
     * Gets tripletex_company_id
     *
     * @return int
     */
    public function getTripletexCompanyId()
    {
        return $this->container['tripletex_company_id'];
    }

    /**
     * Sets tripletex_company_id
     *
     * @param int $tripletex_company_id tripletex_company_id
     *
     * @return $this
     */
    public function setTripletexCompanyId($tripletex_company_id)
    {
        $this->container['tripletex_company_id'] = $tripletex_company_id;

        return $this;
    }

    /**
     * Gets tripletex_price_list
     *
     * @return string
     */
    public function getTripletexPriceList()
    {
        return $this->container['tripletex_price_list'];
    }

    /**
     * Sets tripletex_price_list
     *
     * @param string $tripletex_price_list tripletex_price_list
     *
     * @return $this
     */
    public function setTripletexPriceList($tripletex_price_list)
    {
        $allowedValues = $this->getTripletexPriceListAllowableValues();
        if (!is_null($tripletex_price_list) && !in_array($tripletex_price_list, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'tripletex_price_list', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tripletex_price_list'] = $tripletex_price_list;

        return $this;
    }

    /**
     * Gets employee_id
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->container['employee_id'];
    }

    /**
     * Sets employee_id
     *
     * @param int $employee_id employee_id
     *
     * @return $this
     */
    public function setEmployeeId($employee_id)
    {
        $this->container['employee_id'] = $employee_id;

        return $this;
    }

    /**
     * Gets purchase_date
     *
     * @return string
     */
    public function getPurchaseDate()
    {
        return $this->container['purchase_date'];
    }

    /**
     * Sets purchase_date
     *
     * @param string $purchase_date Purchase date
     *
     * @return $this
     */
    public function setPurchaseDate($purchase_date)
    {
        $this->container['purchase_date'] = $purchase_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string $end_date Purchase end date
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets customer_id
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     *
     * @param int $customer_id customer_id
     *
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets tripletex_sales_module_name
     *
     * @return string
     */
    public function getTripletexSalesModuleName()
    {
        return $this->container['tripletex_sales_module_name'];
    }

    /**
     * Sets tripletex_sales_module_name
     *
     * @param string $tripletex_sales_module_name tripletex_sales_module_name
     *
     * @return $this
     */
    public function setTripletexSalesModuleName($tripletex_sales_module_name)
    {
        $this->container['tripletex_sales_module_name'] = $tripletex_sales_module_name;

        return $this;
    }

    /**
     * Gets type
     *
     * @return int
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param int $type Type upSale or newSales
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets sales_force_opportunity_dto
     *
     * @return \Learnist\Tripletex\Model\SalesForceOpportunity
     */
    public function getSalesForceOpportunityDto()
    {
        return $this->container['sales_force_opportunity_dto'];
    }

    /**
     * Sets sales_force_opportunity_dto
     *
     * @param \Learnist\Tripletex\Model\SalesForceOpportunity $sales_force_opportunity_dto sales_force_opportunity_dto
     *
     * @return $this
     */
    public function setSalesForceOpportunityDto($sales_force_opportunity_dto)
    {
        $this->container['sales_force_opportunity_dto'] = $sales_force_opportunity_dto;

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
