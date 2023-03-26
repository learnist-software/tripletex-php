<?php
/**
 * TodoListWageTransaction
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
 * TodoListWageTransaction Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TodoListWageTransaction implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TodoListWageTransaction';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'item_identifier' => 'int',
        'customer_id' => 'int',
        'client_name' => 'string',
        'client_company_id' => 'int',
        'account_manager_name' => 'string',
        'account_manager_id' => 'int',
        'custom_account_manager_name' => 'string',
        'custom_account_manager_id' => 'int',
        'status' => '\Learnist\Tripletex\Model\TodoListItemStatus',
        'custom_status' => '\Learnist\Tripletex\Model\TodoListItemStatus',
        'due_date' => '\DateTime',
        'custom_due_date' => '\DateTime',
        'period_start' => '\DateTime',
        'period' => 'string',
        'year' => 'int',
        'expanded_details' => '\Learnist\Tripletex\Model\TodoListExpandedDetail[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'item_identifier' => 'int32',
        'customer_id' => 'int32',
        'client_name' => null,
        'client_company_id' => 'int32',
        'account_manager_name' => null,
        'account_manager_id' => 'int32',
        'custom_account_manager_name' => null,
        'custom_account_manager_id' => 'int32',
        'status' => null,
        'custom_status' => null,
        'due_date' => 'date',
        'custom_due_date' => 'date',
        'period_start' => 'date',
        'period' => null,
        'year' => 'int32',
        'expanded_details' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'item_identifier' => false,
		'customer_id' => false,
		'client_name' => false,
		'client_company_id' => false,
		'account_manager_name' => false,
		'account_manager_id' => false,
		'custom_account_manager_name' => false,
		'custom_account_manager_id' => false,
		'status' => false,
		'custom_status' => false,
		'due_date' => false,
		'custom_due_date' => false,
		'period_start' => false,
		'period' => false,
		'year' => false,
		'expanded_details' => false
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
        'item_identifier' => 'itemIdentifier',
        'customer_id' => 'customerId',
        'client_name' => 'clientName',
        'client_company_id' => 'clientCompanyId',
        'account_manager_name' => 'accountManagerName',
        'account_manager_id' => 'accountManagerId',
        'custom_account_manager_name' => 'customAccountManagerName',
        'custom_account_manager_id' => 'customAccountManagerId',
        'status' => 'status',
        'custom_status' => 'customStatus',
        'due_date' => 'dueDate',
        'custom_due_date' => 'customDueDate',
        'period_start' => 'periodStart',
        'period' => 'period',
        'year' => 'year',
        'expanded_details' => 'expandedDetails'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'item_identifier' => 'setItemIdentifier',
        'customer_id' => 'setCustomerId',
        'client_name' => 'setClientName',
        'client_company_id' => 'setClientCompanyId',
        'account_manager_name' => 'setAccountManagerName',
        'account_manager_id' => 'setAccountManagerId',
        'custom_account_manager_name' => 'setCustomAccountManagerName',
        'custom_account_manager_id' => 'setCustomAccountManagerId',
        'status' => 'setStatus',
        'custom_status' => 'setCustomStatus',
        'due_date' => 'setDueDate',
        'custom_due_date' => 'setCustomDueDate',
        'period_start' => 'setPeriodStart',
        'period' => 'setPeriod',
        'year' => 'setYear',
        'expanded_details' => 'setExpandedDetails'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'item_identifier' => 'getItemIdentifier',
        'customer_id' => 'getCustomerId',
        'client_name' => 'getClientName',
        'client_company_id' => 'getClientCompanyId',
        'account_manager_name' => 'getAccountManagerName',
        'account_manager_id' => 'getAccountManagerId',
        'custom_account_manager_name' => 'getCustomAccountManagerName',
        'custom_account_manager_id' => 'getCustomAccountManagerId',
        'status' => 'getStatus',
        'custom_status' => 'getCustomStatus',
        'due_date' => 'getDueDate',
        'custom_due_date' => 'getCustomDueDate',
        'period_start' => 'getPeriodStart',
        'period' => 'getPeriod',
        'year' => 'getYear',
        'expanded_details' => 'getExpandedDetails'
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
        $this->setIfExists('item_identifier', $data ?? [], null);
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('client_name', $data ?? [], null);
        $this->setIfExists('client_company_id', $data ?? [], null);
        $this->setIfExists('account_manager_name', $data ?? [], null);
        $this->setIfExists('account_manager_id', $data ?? [], null);
        $this->setIfExists('custom_account_manager_name', $data ?? [], null);
        $this->setIfExists('custom_account_manager_id', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('custom_status', $data ?? [], null);
        $this->setIfExists('due_date', $data ?? [], null);
        $this->setIfExists('custom_due_date', $data ?? [], null);
        $this->setIfExists('period_start', $data ?? [], null);
        $this->setIfExists('period', $data ?? [], null);
        $this->setIfExists('year', $data ?? [], null);
        $this->setIfExists('expanded_details', $data ?? [], null);
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
     * Gets item_identifier
     *
     * @return int|null
     */
    public function getItemIdentifier()
    {
        return $this->container['item_identifier'];
    }

    /**
     * Sets item_identifier
     *
     * @param int|null $item_identifier item_identifier
     *
     * @return self
     */
    public function setItemIdentifier($item_identifier)
    {

        if (is_null($item_identifier)) {
            throw new \InvalidArgumentException('non-nullable item_identifier cannot be null');
        }

        $this->container['item_identifier'] = $item_identifier;

        return $this;
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
     * @param int|null $customer_id customer_id
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
     * Gets client_name
     *
     * @return string|null
     */
    public function getClientName()
    {
        return $this->container['client_name'];
    }

    /**
     * Sets client_name
     *
     * @param string|null $client_name client_name
     *
     * @return self
     */
    public function setClientName($client_name)
    {

        if (is_null($client_name)) {
            throw new \InvalidArgumentException('non-nullable client_name cannot be null');
        }

        $this->container['client_name'] = $client_name;

        return $this;
    }

    /**
     * Gets client_company_id
     *
     * @return int|null
     */
    public function getClientCompanyId()
    {
        return $this->container['client_company_id'];
    }

    /**
     * Sets client_company_id
     *
     * @param int|null $client_company_id client_company_id
     *
     * @return self
     */
    public function setClientCompanyId($client_company_id)
    {

        if (is_null($client_company_id)) {
            throw new \InvalidArgumentException('non-nullable client_company_id cannot be null');
        }

        $this->container['client_company_id'] = $client_company_id;

        return $this;
    }

    /**
     * Gets account_manager_name
     *
     * @return string|null
     */
    public function getAccountManagerName()
    {
        return $this->container['account_manager_name'];
    }

    /**
     * Sets account_manager_name
     *
     * @param string|null $account_manager_name account_manager_name
     *
     * @return self
     */
    public function setAccountManagerName($account_manager_name)
    {

        if (is_null($account_manager_name)) {
            throw new \InvalidArgumentException('non-nullable account_manager_name cannot be null');
        }

        $this->container['account_manager_name'] = $account_manager_name;

        return $this;
    }

    /**
     * Gets account_manager_id
     *
     * @return int|null
     */
    public function getAccountManagerId()
    {
        return $this->container['account_manager_id'];
    }

    /**
     * Sets account_manager_id
     *
     * @param int|null $account_manager_id account_manager_id
     *
     * @return self
     */
    public function setAccountManagerId($account_manager_id)
    {

        if (is_null($account_manager_id)) {
            throw new \InvalidArgumentException('non-nullable account_manager_id cannot be null');
        }

        $this->container['account_manager_id'] = $account_manager_id;

        return $this;
    }

    /**
     * Gets custom_account_manager_name
     *
     * @return string|null
     */
    public function getCustomAccountManagerName()
    {
        return $this->container['custom_account_manager_name'];
    }

    /**
     * Sets custom_account_manager_name
     *
     * @param string|null $custom_account_manager_name custom_account_manager_name
     *
     * @return self
     */
    public function setCustomAccountManagerName($custom_account_manager_name)
    {

        if (is_null($custom_account_manager_name)) {
            throw new \InvalidArgumentException('non-nullable custom_account_manager_name cannot be null');
        }

        $this->container['custom_account_manager_name'] = $custom_account_manager_name;

        return $this;
    }

    /**
     * Gets custom_account_manager_id
     *
     * @return int|null
     */
    public function getCustomAccountManagerId()
    {
        return $this->container['custom_account_manager_id'];
    }

    /**
     * Sets custom_account_manager_id
     *
     * @param int|null $custom_account_manager_id custom_account_manager_id
     *
     * @return self
     */
    public function setCustomAccountManagerId($custom_account_manager_id)
    {

        if (is_null($custom_account_manager_id)) {
            throw new \InvalidArgumentException('non-nullable custom_account_manager_id cannot be null');
        }

        $this->container['custom_account_manager_id'] = $custom_account_manager_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \Learnist\Tripletex\Model\TodoListItemStatus|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \Learnist\Tripletex\Model\TodoListItemStatus|null $status status
     *
     * @return self
     */
    public function setStatus($status)
    {

        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }

        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets custom_status
     *
     * @return \Learnist\Tripletex\Model\TodoListItemStatus|null
     */
    public function getCustomStatus()
    {
        return $this->container['custom_status'];
    }

    /**
     * Sets custom_status
     *
     * @param \Learnist\Tripletex\Model\TodoListItemStatus|null $custom_status custom_status
     *
     * @return self
     */
    public function setCustomStatus($custom_status)
    {

        if (is_null($custom_status)) {
            throw new \InvalidArgumentException('non-nullable custom_status cannot be null');
        }

        $this->container['custom_status'] = $custom_status;

        return $this;
    }

    /**
     * Gets due_date
     *
     * @return \DateTime|null
     */
    public function getDueDate()
    {
        return $this->container['due_date'];
    }

    /**
     * Sets due_date
     *
     * @param \DateTime|null $due_date due_date
     *
     * @return self
     */
    public function setDueDate($due_date)
    {

        if (is_null($due_date)) {
            throw new \InvalidArgumentException('non-nullable due_date cannot be null');
        }

        $this->container['due_date'] = $due_date;

        return $this;
    }

    /**
     * Gets custom_due_date
     *
     * @return \DateTime|null
     */
    public function getCustomDueDate()
    {
        return $this->container['custom_due_date'];
    }

    /**
     * Sets custom_due_date
     *
     * @param \DateTime|null $custom_due_date custom_due_date
     *
     * @return self
     */
    public function setCustomDueDate($custom_due_date)
    {

        if (is_null($custom_due_date)) {
            throw new \InvalidArgumentException('non-nullable custom_due_date cannot be null');
        }

        $this->container['custom_due_date'] = $custom_due_date;

        return $this;
    }

    /**
     * Gets period_start
     *
     * @return \DateTime|null
     */
    public function getPeriodStart()
    {
        return $this->container['period_start'];
    }

    /**
     * Sets period_start
     *
     * @param \DateTime|null $period_start period_start
     *
     * @return self
     */
    public function setPeriodStart($period_start)
    {

        if (is_null($period_start)) {
            throw new \InvalidArgumentException('non-nullable period_start cannot be null');
        }

        $this->container['period_start'] = $period_start;

        return $this;
    }

    /**
     * Gets period
     *
     * @return string|null
     */
    public function getPeriod()
    {
        return $this->container['period'];
    }

    /**
     * Sets period
     *
     * @param string|null $period period
     *
     * @return self
     */
    public function setPeriod($period)
    {

        if (is_null($period)) {
            throw new \InvalidArgumentException('non-nullable period cannot be null');
        }

        $this->container['period'] = $period;

        return $this;
    }

    /**
     * Gets year
     *
     * @return int|null
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int|null $year year
     *
     * @return self
     */
    public function setYear($year)
    {

        if (is_null($year)) {
            throw new \InvalidArgumentException('non-nullable year cannot be null');
        }

        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets expanded_details
     *
     * @return \Learnist\Tripletex\Model\TodoListExpandedDetail[]|null
     */
    public function getExpandedDetails()
    {
        return $this->container['expanded_details'];
    }

    /**
     * Sets expanded_details
     *
     * @param \Learnist\Tripletex\Model\TodoListExpandedDetail[]|null $expanded_details expanded_details
     *
     * @return self
     */
    public function setExpandedDetails($expanded_details)
    {

        if (is_null($expanded_details)) {
            throw new \InvalidArgumentException('non-nullable expanded_details cannot be null');
        }

        $this->container['expanded_details'] = $expanded_details;

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


