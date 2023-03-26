<?php
/**
 * TemporaryDifferences
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
 * TemporaryDifferences Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TemporaryDifferences implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TemporaryDifferences';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
'name' => 'string',
'grouping' => 'string',
'object_identifier' => 'string',
'negate' => 'bool',
'read_only' => 'bool',
'source' => 'string',
'type' => 'string',
'opening_balance_account_value' => 'float',
'opening_balance_tax_value' => 'float',
'opening_balance_differences' => 'float',
'closing_balance_account_value' => 'float',
'closing_balance_tax_value' => 'float',
'closing_balance_differences' => 'float',
'changes' => 'float',
'show_accounting' => 'bool',
'show_tax' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'year_end_report' => null,
'name' => null,
'grouping' => null,
'object_identifier' => null,
'negate' => null,
'read_only' => null,
'source' => null,
'type' => null,
'opening_balance_account_value' => null,
'opening_balance_tax_value' => null,
'opening_balance_differences' => null,
'closing_balance_account_value' => null,
'closing_balance_tax_value' => null,
'closing_balance_differences' => null,
'changes' => null,
'show_accounting' => null,
'show_tax' => null    ];

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
        'year_end_report' => 'yearEndReport',
'name' => 'name',
'grouping' => 'grouping',
'object_identifier' => 'objectIdentifier',
'negate' => 'negate',
'read_only' => 'readOnly',
'source' => 'source',
'type' => 'type',
'opening_balance_account_value' => 'openingBalanceAccountValue',
'opening_balance_tax_value' => 'openingBalanceTaxValue',
'opening_balance_differences' => 'openingBalanceDifferences',
'closing_balance_account_value' => 'closingBalanceAccountValue',
'closing_balance_tax_value' => 'closingBalanceTaxValue',
'closing_balance_differences' => 'closingBalanceDifferences',
'changes' => 'changes',
'show_accounting' => 'showAccounting',
'show_tax' => 'showTax'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
'name' => 'setName',
'grouping' => 'setGrouping',
'object_identifier' => 'setObjectIdentifier',
'negate' => 'setNegate',
'read_only' => 'setReadOnly',
'source' => 'setSource',
'type' => 'setType',
'opening_balance_account_value' => 'setOpeningBalanceAccountValue',
'opening_balance_tax_value' => 'setOpeningBalanceTaxValue',
'opening_balance_differences' => 'setOpeningBalanceDifferences',
'closing_balance_account_value' => 'setClosingBalanceAccountValue',
'closing_balance_tax_value' => 'setClosingBalanceTaxValue',
'closing_balance_differences' => 'setClosingBalanceDifferences',
'changes' => 'setChanges',
'show_accounting' => 'setShowAccounting',
'show_tax' => 'setShowTax'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
'name' => 'getName',
'grouping' => 'getGrouping',
'object_identifier' => 'getObjectIdentifier',
'negate' => 'getNegate',
'read_only' => 'getReadOnly',
'source' => 'getSource',
'type' => 'getType',
'opening_balance_account_value' => 'getOpeningBalanceAccountValue',
'opening_balance_tax_value' => 'getOpeningBalanceTaxValue',
'opening_balance_differences' => 'getOpeningBalanceDifferences',
'closing_balance_account_value' => 'getClosingBalanceAccountValue',
'closing_balance_tax_value' => 'getClosingBalanceTaxValue',
'closing_balance_differences' => 'getClosingBalanceDifferences',
'changes' => 'getChanges',
'show_accounting' => 'getShowAccounting',
'show_tax' => 'getShowTax'    ];

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
        $this->container['year_end_report'] = isset($data['year_end_report']) ? $data['year_end_report'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['grouping'] = isset($data['grouping']) ? $data['grouping'] : null;
        $this->container['object_identifier'] = isset($data['object_identifier']) ? $data['object_identifier'] : null;
        $this->container['negate'] = isset($data['negate']) ? $data['negate'] : null;
        $this->container['read_only'] = isset($data['read_only']) ? $data['read_only'] : null;
        $this->container['source'] = isset($data['source']) ? $data['source'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['opening_balance_account_value'] = isset($data['opening_balance_account_value']) ? $data['opening_balance_account_value'] : null;
        $this->container['opening_balance_tax_value'] = isset($data['opening_balance_tax_value']) ? $data['opening_balance_tax_value'] : null;
        $this->container['opening_balance_differences'] = isset($data['opening_balance_differences']) ? $data['opening_balance_differences'] : null;
        $this->container['closing_balance_account_value'] = isset($data['closing_balance_account_value']) ? $data['closing_balance_account_value'] : null;
        $this->container['closing_balance_tax_value'] = isset($data['closing_balance_tax_value']) ? $data['closing_balance_tax_value'] : null;
        $this->container['closing_balance_differences'] = isset($data['closing_balance_differences']) ? $data['closing_balance_differences'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['show_accounting'] = isset($data['show_accounting']) ? $data['show_accounting'] : null;
        $this->container['show_tax'] = isset($data['show_tax']) ? $data['show_tax'] : null;
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
     * Gets year_end_report
     *
     * @return \Learnist\Tripletex\Model\YearEndReport
     */
    public function getYearEndReport()
    {
        return $this->container['year_end_report'];
    }

    /**
     * Sets year_end_report
     *
     * @param \Learnist\Tripletex\Model\YearEndReport $year_end_report year_end_report
     *
     * @return $this
     */
    public function setYearEndReport($year_end_report)
    {
        $this->container['year_end_report'] = $year_end_report;

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
     * Gets grouping
     *
     * @return string
     */
    public function getGrouping()
    {
        return $this->container['grouping'];
    }

    /**
     * Sets grouping
     *
     * @param string $grouping grouping
     *
     * @return $this
     */
    public function setGrouping($grouping)
    {
        $this->container['grouping'] = $grouping;

        return $this;
    }

    /**
     * Gets object_identifier
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        return $this->container['object_identifier'];
    }

    /**
     * Sets object_identifier
     *
     * @param string $object_identifier object_identifier
     *
     * @return $this
     */
    public function setObjectIdentifier($object_identifier)
    {
        $this->container['object_identifier'] = $object_identifier;

        return $this;
    }

    /**
     * Gets negate
     *
     * @return bool
     */
    public function getNegate()
    {
        return $this->container['negate'];
    }

    /**
     * Sets negate
     *
     * @param bool $negate negate
     *
     * @return $this
     */
    public function setNegate($negate)
    {
        $this->container['negate'] = $negate;

        return $this;
    }

    /**
     * Gets read_only
     *
     * @return bool
     */
    public function getReadOnly()
    {
        return $this->container['read_only'];
    }

    /**
     * Sets read_only
     *
     * @param bool $read_only read_only
     *
     * @return $this
     */
    public function setReadOnly($read_only)
    {
        $this->container['read_only'] = $read_only;

        return $this;
    }

    /**
     * Gets source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->container['source'];
    }

    /**
     * Sets source
     *
     * @param string $source source
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->container['source'] = $source;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets opening_balance_account_value
     *
     * @return float
     */
    public function getOpeningBalanceAccountValue()
    {
        return $this->container['opening_balance_account_value'];
    }

    /**
     * Sets opening_balance_account_value
     *
     * @param float $opening_balance_account_value opening_balance_account_value
     *
     * @return $this
     */
    public function setOpeningBalanceAccountValue($opening_balance_account_value)
    {
        $this->container['opening_balance_account_value'] = $opening_balance_account_value;

        return $this;
    }

    /**
     * Gets opening_balance_tax_value
     *
     * @return float
     */
    public function getOpeningBalanceTaxValue()
    {
        return $this->container['opening_balance_tax_value'];
    }

    /**
     * Sets opening_balance_tax_value
     *
     * @param float $opening_balance_tax_value opening_balance_tax_value
     *
     * @return $this
     */
    public function setOpeningBalanceTaxValue($opening_balance_tax_value)
    {
        $this->container['opening_balance_tax_value'] = $opening_balance_tax_value;

        return $this;
    }

    /**
     * Gets opening_balance_differences
     *
     * @return float
     */
    public function getOpeningBalanceDifferences()
    {
        return $this->container['opening_balance_differences'];
    }

    /**
     * Sets opening_balance_differences
     *
     * @param float $opening_balance_differences opening_balance_differences
     *
     * @return $this
     */
    public function setOpeningBalanceDifferences($opening_balance_differences)
    {
        $this->container['opening_balance_differences'] = $opening_balance_differences;

        return $this;
    }

    /**
     * Gets closing_balance_account_value
     *
     * @return float
     */
    public function getClosingBalanceAccountValue()
    {
        return $this->container['closing_balance_account_value'];
    }

    /**
     * Sets closing_balance_account_value
     *
     * @param float $closing_balance_account_value closing_balance_account_value
     *
     * @return $this
     */
    public function setClosingBalanceAccountValue($closing_balance_account_value)
    {
        $this->container['closing_balance_account_value'] = $closing_balance_account_value;

        return $this;
    }

    /**
     * Gets closing_balance_tax_value
     *
     * @return float
     */
    public function getClosingBalanceTaxValue()
    {
        return $this->container['closing_balance_tax_value'];
    }

    /**
     * Sets closing_balance_tax_value
     *
     * @param float $closing_balance_tax_value closing_balance_tax_value
     *
     * @return $this
     */
    public function setClosingBalanceTaxValue($closing_balance_tax_value)
    {
        $this->container['closing_balance_tax_value'] = $closing_balance_tax_value;

        return $this;
    }

    /**
     * Gets closing_balance_differences
     *
     * @return float
     */
    public function getClosingBalanceDifferences()
    {
        return $this->container['closing_balance_differences'];
    }

    /**
     * Sets closing_balance_differences
     *
     * @param float $closing_balance_differences closing_balance_differences
     *
     * @return $this
     */
    public function setClosingBalanceDifferences($closing_balance_differences)
    {
        $this->container['closing_balance_differences'] = $closing_balance_differences;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return float
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param float $changes changes
     *
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets show_accounting
     *
     * @return bool
     */
    public function getShowAccounting()
    {
        return $this->container['show_accounting'];
    }

    /**
     * Sets show_accounting
     *
     * @param bool $show_accounting show_accounting
     *
     * @return $this
     */
    public function setShowAccounting($show_accounting)
    {
        $this->container['show_accounting'] = $show_accounting;

        return $this;
    }

    /**
     * Gets show_tax
     *
     * @return bool
     */
    public function getShowTax()
    {
        return $this->container['show_tax'];
    }

    /**
     * Sets show_tax
     *
     * @param bool $show_tax show_tax
     *
     * @return $this
     */
    public function setShowTax($show_tax)
    {
        $this->container['show_tax'] = $show_tax;

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
