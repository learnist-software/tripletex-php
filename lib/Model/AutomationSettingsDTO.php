<?php
/**
 * AutomationSettingsDTO
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
 * AutomationSettingsDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AutomationSettingsDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AutomationSettingsDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'can_access_auto_pay' => 'bool',
        'can_access_fabric_ai' => 'bool',
        'can_access_fabric_ai_training' => 'bool',
        'can_add_auto_pay_payments' => 'bool',
        'has_bookkeeping_before_attestation_setting' => 'bool',
        'has_voucher_approval_module' => 'bool',
        'has_fabric_ai_max_amount_pilot_flag' => 'bool',
        'test_account' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'can_access_auto_pay' => null,
        'can_access_fabric_ai' => null,
        'can_access_fabric_ai_training' => null,
        'can_add_auto_pay_payments' => null,
        'has_bookkeeping_before_attestation_setting' => null,
        'has_voucher_approval_module' => null,
        'has_fabric_ai_max_amount_pilot_flag' => null,
        'test_account' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'can_access_auto_pay' => false,
		'can_access_fabric_ai' => false,
		'can_access_fabric_ai_training' => false,
		'can_add_auto_pay_payments' => false,
		'has_bookkeeping_before_attestation_setting' => false,
		'has_voucher_approval_module' => false,
		'has_fabric_ai_max_amount_pilot_flag' => false,
		'test_account' => false
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
        'can_access_auto_pay' => 'canAccessAutoPay',
        'can_access_fabric_ai' => 'canAccessFabricAi',
        'can_access_fabric_ai_training' => 'canAccessFabricAiTraining',
        'can_add_auto_pay_payments' => 'canAddAutoPayPayments',
        'has_bookkeeping_before_attestation_setting' => 'hasBookkeepingBeforeAttestationSetting',
        'has_voucher_approval_module' => 'hasVoucherApprovalModule',
        'has_fabric_ai_max_amount_pilot_flag' => 'hasFabricAiMaxAmountPilotFlag',
        'test_account' => 'testAccount'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'can_access_auto_pay' => 'setCanAccessAutoPay',
        'can_access_fabric_ai' => 'setCanAccessFabricAi',
        'can_access_fabric_ai_training' => 'setCanAccessFabricAiTraining',
        'can_add_auto_pay_payments' => 'setCanAddAutoPayPayments',
        'has_bookkeeping_before_attestation_setting' => 'setHasBookkeepingBeforeAttestationSetting',
        'has_voucher_approval_module' => 'setHasVoucherApprovalModule',
        'has_fabric_ai_max_amount_pilot_flag' => 'setHasFabricAiMaxAmountPilotFlag',
        'test_account' => 'setTestAccount'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'can_access_auto_pay' => 'getCanAccessAutoPay',
        'can_access_fabric_ai' => 'getCanAccessFabricAi',
        'can_access_fabric_ai_training' => 'getCanAccessFabricAiTraining',
        'can_add_auto_pay_payments' => 'getCanAddAutoPayPayments',
        'has_bookkeeping_before_attestation_setting' => 'getHasBookkeepingBeforeAttestationSetting',
        'has_voucher_approval_module' => 'getHasVoucherApprovalModule',
        'has_fabric_ai_max_amount_pilot_flag' => 'getHasFabricAiMaxAmountPilotFlag',
        'test_account' => 'getTestAccount'
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
        $this->setIfExists('can_access_auto_pay', $data ?? [], null);
        $this->setIfExists('can_access_fabric_ai', $data ?? [], null);
        $this->setIfExists('can_access_fabric_ai_training', $data ?? [], null);
        $this->setIfExists('can_add_auto_pay_payments', $data ?? [], null);
        $this->setIfExists('has_bookkeeping_before_attestation_setting', $data ?? [], null);
        $this->setIfExists('has_voucher_approval_module', $data ?? [], null);
        $this->setIfExists('has_fabric_ai_max_amount_pilot_flag', $data ?? [], null);
        $this->setIfExists('test_account', $data ?? [], null);
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
     * Gets can_access_auto_pay
     *
     * @return bool|null
     */
    public function getCanAccessAutoPay()
    {
        return $this->container['can_access_auto_pay'];
    }

    /**
     * Sets can_access_auto_pay
     *
     * @param bool|null $can_access_auto_pay can_access_auto_pay
     *
     * @return self
     */
    public function setCanAccessAutoPay($can_access_auto_pay)
    {
        if (is_null($can_access_auto_pay)) {
            throw new \InvalidArgumentException('non-nullable can_access_auto_pay cannot be null');
        }
        $this->container['can_access_auto_pay'] = $can_access_auto_pay;

        return $this;
    }

    /**
     * Gets can_access_fabric_ai
     *
     * @return bool|null
     */
    public function getCanAccessFabricAi()
    {
        return $this->container['can_access_fabric_ai'];
    }

    /**
     * Sets can_access_fabric_ai
     *
     * @param bool|null $can_access_fabric_ai can_access_fabric_ai
     *
     * @return self
     */
    public function setCanAccessFabricAi($can_access_fabric_ai)
    {
        if (is_null($can_access_fabric_ai)) {
            throw new \InvalidArgumentException('non-nullable can_access_fabric_ai cannot be null');
        }
        $this->container['can_access_fabric_ai'] = $can_access_fabric_ai;

        return $this;
    }

    /**
     * Gets can_access_fabric_ai_training
     *
     * @return bool|null
     */
    public function getCanAccessFabricAiTraining()
    {
        return $this->container['can_access_fabric_ai_training'];
    }

    /**
     * Sets can_access_fabric_ai_training
     *
     * @param bool|null $can_access_fabric_ai_training can_access_fabric_ai_training
     *
     * @return self
     */
    public function setCanAccessFabricAiTraining($can_access_fabric_ai_training)
    {
        if (is_null($can_access_fabric_ai_training)) {
            throw new \InvalidArgumentException('non-nullable can_access_fabric_ai_training cannot be null');
        }
        $this->container['can_access_fabric_ai_training'] = $can_access_fabric_ai_training;

        return $this;
    }

    /**
     * Gets can_add_auto_pay_payments
     *
     * @return bool|null
     */
    public function getCanAddAutoPayPayments()
    {
        return $this->container['can_add_auto_pay_payments'];
    }

    /**
     * Sets can_add_auto_pay_payments
     *
     * @param bool|null $can_add_auto_pay_payments can_add_auto_pay_payments
     *
     * @return self
     */
    public function setCanAddAutoPayPayments($can_add_auto_pay_payments)
    {
        if (is_null($can_add_auto_pay_payments)) {
            throw new \InvalidArgumentException('non-nullable can_add_auto_pay_payments cannot be null');
        }
        $this->container['can_add_auto_pay_payments'] = $can_add_auto_pay_payments;

        return $this;
    }

    /**
     * Gets has_bookkeeping_before_attestation_setting
     *
     * @return bool|null
     */
    public function getHasBookkeepingBeforeAttestationSetting()
    {
        return $this->container['has_bookkeeping_before_attestation_setting'];
    }

    /**
     * Sets has_bookkeeping_before_attestation_setting
     *
     * @param bool|null $has_bookkeeping_before_attestation_setting has_bookkeeping_before_attestation_setting
     *
     * @return self
     */
    public function setHasBookkeepingBeforeAttestationSetting($has_bookkeeping_before_attestation_setting)
    {
        if (is_null($has_bookkeeping_before_attestation_setting)) {
            throw new \InvalidArgumentException('non-nullable has_bookkeeping_before_attestation_setting cannot be null');
        }
        $this->container['has_bookkeeping_before_attestation_setting'] = $has_bookkeeping_before_attestation_setting;

        return $this;
    }

    /**
     * Gets has_voucher_approval_module
     *
     * @return bool|null
     */
    public function getHasVoucherApprovalModule()
    {
        return $this->container['has_voucher_approval_module'];
    }

    /**
     * Sets has_voucher_approval_module
     *
     * @param bool|null $has_voucher_approval_module has_voucher_approval_module
     *
     * @return self
     */
    public function setHasVoucherApprovalModule($has_voucher_approval_module)
    {
        if (is_null($has_voucher_approval_module)) {
            throw new \InvalidArgumentException('non-nullable has_voucher_approval_module cannot be null');
        }
        $this->container['has_voucher_approval_module'] = $has_voucher_approval_module;

        return $this;
    }

    /**
     * Gets has_fabric_ai_max_amount_pilot_flag
     *
     * @return bool|null
     */
    public function getHasFabricAiMaxAmountPilotFlag()
    {
        return $this->container['has_fabric_ai_max_amount_pilot_flag'];
    }

    /**
     * Sets has_fabric_ai_max_amount_pilot_flag
     *
     * @param bool|null $has_fabric_ai_max_amount_pilot_flag has_fabric_ai_max_amount_pilot_flag
     *
     * @return self
     */
    public function setHasFabricAiMaxAmountPilotFlag($has_fabric_ai_max_amount_pilot_flag)
    {
        if (is_null($has_fabric_ai_max_amount_pilot_flag)) {
            throw new \InvalidArgumentException('non-nullable has_fabric_ai_max_amount_pilot_flag cannot be null');
        }
        $this->container['has_fabric_ai_max_amount_pilot_flag'] = $has_fabric_ai_max_amount_pilot_flag;

        return $this;
    }

    /**
     * Gets test_account
     *
     * @return bool|null
     */
    public function getTestAccount()
    {
        return $this->container['test_account'];
    }

    /**
     * Sets test_account
     *
     * @param bool|null $test_account test_account
     *
     * @return self
     */
    public function setTestAccount($test_account)
    {
        if (is_null($test_account)) {
            throw new \InvalidArgumentException('non-nullable test_account cannot be null');
        }
        $this->container['test_account'] = $test_account;

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


