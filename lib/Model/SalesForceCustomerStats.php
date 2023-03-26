<?php
/**
 * SalesForceCustomerStats
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
 * SalesForceCustomerStats Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalesForceCustomerStats implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalesForceCustomerStats';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'customer_id' => 'int',
        'number_of_users' => 'int',
        'number_of_employees' => 'int',
        'number_of_invoiced_transactions_ehf' => 'int',
        'number_of_invoiced_employees_on_last_invoice' => 'int',
        'date_of_last_admin_login' => 'string',
        'total_startup_fees' => 'object',
        'total_monthly_fees' => 'object'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'customer_id' => 'int32',
        'number_of_users' => 'int32',
        'number_of_employees' => 'int32',
        'number_of_invoiced_transactions_ehf' => 'int32',
        'number_of_invoiced_employees_on_last_invoice' => 'int32',
        'date_of_last_admin_login' => null,
        'total_startup_fees' => null,
        'total_monthly_fees' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'customer_id' => false,
		'number_of_users' => false,
		'number_of_employees' => false,
		'number_of_invoiced_transactions_ehf' => false,
		'number_of_invoiced_employees_on_last_invoice' => false,
		'date_of_last_admin_login' => false,
		'total_startup_fees' => false,
		'total_monthly_fees' => false
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
        'customer_id' => 'customerId',
        'number_of_users' => 'numberOfUsers',
        'number_of_employees' => 'numberOfEmployees',
        'number_of_invoiced_transactions_ehf' => 'numberOfInvoicedTransactionsEHF',
        'number_of_invoiced_employees_on_last_invoice' => 'numberOfInvoicedEmployeesOnLastInvoice',
        'date_of_last_admin_login' => 'dateOfLastAdminLogin',
        'total_startup_fees' => 'totalStartupFees',
        'total_monthly_fees' => 'totalMonthlyFees'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'customer_id' => 'setCustomerId',
        'number_of_users' => 'setNumberOfUsers',
        'number_of_employees' => 'setNumberOfEmployees',
        'number_of_invoiced_transactions_ehf' => 'setNumberOfInvoicedTransactionsEhf',
        'number_of_invoiced_employees_on_last_invoice' => 'setNumberOfInvoicedEmployeesOnLastInvoice',
        'date_of_last_admin_login' => 'setDateOfLastAdminLogin',
        'total_startup_fees' => 'setTotalStartupFees',
        'total_monthly_fees' => 'setTotalMonthlyFees'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'customer_id' => 'getCustomerId',
        'number_of_users' => 'getNumberOfUsers',
        'number_of_employees' => 'getNumberOfEmployees',
        'number_of_invoiced_transactions_ehf' => 'getNumberOfInvoicedTransactionsEhf',
        'number_of_invoiced_employees_on_last_invoice' => 'getNumberOfInvoicedEmployeesOnLastInvoice',
        'date_of_last_admin_login' => 'getDateOfLastAdminLogin',
        'total_startup_fees' => 'getTotalStartupFees',
        'total_monthly_fees' => 'getTotalMonthlyFees'
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
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('number_of_users', $data ?? [], null);
        $this->setIfExists('number_of_employees', $data ?? [], null);
        $this->setIfExists('number_of_invoiced_transactions_ehf', $data ?? [], null);
        $this->setIfExists('number_of_invoiced_employees_on_last_invoice', $data ?? [], null);
        $this->setIfExists('date_of_last_admin_login', $data ?? [], null);
        $this->setIfExists('total_startup_fees', $data ?? [], null);
        $this->setIfExists('total_monthly_fees', $data ?? [], null);
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
     * Gets customer_id
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     *
     * @param int|null $customer_id Customer Id
     *
     * @return self
     */
    public function setCustomerId($customer_id)
    {
        if (is_null($customer_id)) {
            throw new \InvalidArgumentException('non-nullable customer_id cannot be null');
        }
        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets number_of_users
     *
     * @return int|null
     */
    public function getNumberOfUsers()
    {
        return $this->container['number_of_users'];
    }

    /**
     * Sets number_of_users
     *
     * @param int|null $number_of_users Number of users
     *
     * @return self
     */
    public function setNumberOfUsers($number_of_users)
    {
        if (is_null($number_of_users)) {
            throw new \InvalidArgumentException('non-nullable number_of_users cannot be null');
        }
        $this->container['number_of_users'] = $number_of_users;

        return $this;
    }

    /**
     * Gets number_of_employees
     *
     * @return int|null
     */
    public function getNumberOfEmployees()
    {
        return $this->container['number_of_employees'];
    }

    /**
     * Sets number_of_employees
     *
     * @param int|null $number_of_employees Number of employees
     *
     * @return self
     */
    public function setNumberOfEmployees($number_of_employees)
    {
        if (is_null($number_of_employees)) {
            throw new \InvalidArgumentException('non-nullable number_of_employees cannot be null');
        }
        $this->container['number_of_employees'] = $number_of_employees;

        return $this;
    }

    /**
     * Gets number_of_invoiced_transactions_ehf
     *
     * @return int|null
     */
    public function getNumberOfInvoicedTransactionsEhf()
    {
        return $this->container['number_of_invoiced_transactions_ehf'];
    }

    /**
     * Sets number_of_invoiced_transactions_ehf
     *
     * @param int|null $number_of_invoiced_transactions_ehf Number of invoiced transactions EHF
     *
     * @return self
     */
    public function setNumberOfInvoicedTransactionsEhf($number_of_invoiced_transactions_ehf)
    {
        if (is_null($number_of_invoiced_transactions_ehf)) {
            throw new \InvalidArgumentException('non-nullable number_of_invoiced_transactions_ehf cannot be null');
        }
        $this->container['number_of_invoiced_transactions_ehf'] = $number_of_invoiced_transactions_ehf;

        return $this;
    }

    /**
     * Gets number_of_invoiced_employees_on_last_invoice
     *
     * @return int|null
     */
    public function getNumberOfInvoicedEmployeesOnLastInvoice()
    {
        return $this->container['number_of_invoiced_employees_on_last_invoice'];
    }

    /**
     * Sets number_of_invoiced_employees_on_last_invoice
     *
     * @param int|null $number_of_invoiced_employees_on_last_invoice Number of invoiced employees on last invoice
     *
     * @return self
     */
    public function setNumberOfInvoicedEmployeesOnLastInvoice($number_of_invoiced_employees_on_last_invoice)
    {
        if (is_null($number_of_invoiced_employees_on_last_invoice)) {
            throw new \InvalidArgumentException('non-nullable number_of_invoiced_employees_on_last_invoice cannot be null');
        }
        $this->container['number_of_invoiced_employees_on_last_invoice'] = $number_of_invoiced_employees_on_last_invoice;

        return $this;
    }

    /**
     * Gets date_of_last_admin_login
     *
     * @return string|null
     */
    public function getDateOfLastAdminLogin()
    {
        return $this->container['date_of_last_admin_login'];
    }

    /**
     * Sets date_of_last_admin_login
     *
     * @param string|null $date_of_last_admin_login Last Admin login to Tripletex date
     *
     * @return self
     */
    public function setDateOfLastAdminLogin($date_of_last_admin_login)
    {
        if (is_null($date_of_last_admin_login)) {
            throw new \InvalidArgumentException('non-nullable date_of_last_admin_login cannot be null');
        }
        $this->container['date_of_last_admin_login'] = $date_of_last_admin_login;

        return $this;
    }

    /**
     * Gets total_startup_fees
     *
     * @return object|null
     */
    public function getTotalStartupFees()
    {
        return $this->container['total_startup_fees'];
    }

    /**
     * Sets total_startup_fees
     *
     * @param object|null $total_startup_fees total_startup_fees
     *
     * @return self
     */
    public function setTotalStartupFees($total_startup_fees)
    {
        if (is_null($total_startup_fees)) {
            throw new \InvalidArgumentException('non-nullable total_startup_fees cannot be null');
        }
        $this->container['total_startup_fees'] = $total_startup_fees;

        return $this;
    }

    /**
     * Gets total_monthly_fees
     *
     * @return object|null
     */
    public function getTotalMonthlyFees()
    {
        return $this->container['total_monthly_fees'];
    }

    /**
     * Sets total_monthly_fees
     *
     * @param object|null $total_monthly_fees total_monthly_fees
     *
     * @return self
     */
    public function setTotalMonthlyFees($total_monthly_fees)
    {
        if (is_null($total_monthly_fees)) {
            throw new \InvalidArgumentException('non-nullable total_monthly_fees cannot be null');
        }
        $this->container['total_monthly_fees'] = $total_monthly_fees;

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


