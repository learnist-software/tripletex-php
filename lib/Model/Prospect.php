<?php
/**
 * Prospect
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
 * Prospect Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Prospect implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Prospect';

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
        'description' => 'string',
        'created_date' => 'string',
        'customer' => '\Learnist\Tripletex\Model\Customer',
        'sales_employee' => '\Learnist\Tripletex\Model\Employee',
        'is_closed' => 'bool',
        'closed_reason' => 'int',
        'closed_date' => 'string',
        'competitor' => 'string',
        'prospect_type' => 'int',
        'project' => '\Learnist\Tripletex\Model\Project',
        'project_offer' => '\Learnist\Tripletex\Model\Project',
        'final_income_date' => 'string',
        'final_initial_value' => 'float',
        'final_monthly_value' => 'float',
        'final_additional_services_value' => 'float',
        'total_value' => 'float'
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
        'description' => null,
        'created_date' => null,
        'customer' => null,
        'sales_employee' => null,
        'is_closed' => null,
        'closed_reason' => 'int32',
        'closed_date' => null,
        'competitor' => null,
        'prospect_type' => 'int32',
        'project' => null,
        'project_offer' => null,
        'final_income_date' => null,
        'final_initial_value' => null,
        'final_monthly_value' => null,
        'final_additional_services_value' => null,
        'total_value' => null
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
		'description' => false,
		'created_date' => false,
		'customer' => false,
		'sales_employee' => false,
		'is_closed' => false,
		'closed_reason' => false,
		'closed_date' => false,
		'competitor' => false,
		'prospect_type' => false,
		'project' => false,
		'project_offer' => false,
		'final_income_date' => false,
		'final_initial_value' => false,
		'final_monthly_value' => false,
		'final_additional_services_value' => false,
		'total_value' => false
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
        'description' => 'description',
        'created_date' => 'createdDate',
        'customer' => 'customer',
        'sales_employee' => 'salesEmployee',
        'is_closed' => 'isClosed',
        'closed_reason' => 'closedReason',
        'closed_date' => 'closedDate',
        'competitor' => 'competitor',
        'prospect_type' => 'prospectType',
        'project' => 'project',
        'project_offer' => 'projectOffer',
        'final_income_date' => 'finalIncomeDate',
        'final_initial_value' => 'finalInitialValue',
        'final_monthly_value' => 'finalMonthlyValue',
        'final_additional_services_value' => 'finalAdditionalServicesValue',
        'total_value' => 'totalValue'
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
        'description' => 'setDescription',
        'created_date' => 'setCreatedDate',
        'customer' => 'setCustomer',
        'sales_employee' => 'setSalesEmployee',
        'is_closed' => 'setIsClosed',
        'closed_reason' => 'setClosedReason',
        'closed_date' => 'setClosedDate',
        'competitor' => 'setCompetitor',
        'prospect_type' => 'setProspectType',
        'project' => 'setProject',
        'project_offer' => 'setProjectOffer',
        'final_income_date' => 'setFinalIncomeDate',
        'final_initial_value' => 'setFinalInitialValue',
        'final_monthly_value' => 'setFinalMonthlyValue',
        'final_additional_services_value' => 'setFinalAdditionalServicesValue',
        'total_value' => 'setTotalValue'
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
        'description' => 'getDescription',
        'created_date' => 'getCreatedDate',
        'customer' => 'getCustomer',
        'sales_employee' => 'getSalesEmployee',
        'is_closed' => 'getIsClosed',
        'closed_reason' => 'getClosedReason',
        'closed_date' => 'getClosedDate',
        'competitor' => 'getCompetitor',
        'prospect_type' => 'getProspectType',
        'project' => 'getProject',
        'project_offer' => 'getProjectOffer',
        'final_income_date' => 'getFinalIncomeDate',
        'final_initial_value' => 'getFinalInitialValue',
        'final_monthly_value' => 'getFinalMonthlyValue',
        'final_additional_services_value' => 'getFinalAdditionalServicesValue',
        'total_value' => 'getTotalValue'
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
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('created_date', $data ?? [], null);
        $this->setIfExists('customer', $data ?? [], null);
        $this->setIfExists('sales_employee', $data ?? [], null);
        $this->setIfExists('is_closed', $data ?? [], null);
        $this->setIfExists('closed_reason', $data ?? [], null);
        $this->setIfExists('closed_date', $data ?? [], null);
        $this->setIfExists('competitor', $data ?? [], null);
        $this->setIfExists('prospect_type', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('project_offer', $data ?? [], null);
        $this->setIfExists('final_income_date', $data ?? [], null);
        $this->setIfExists('final_initial_value', $data ?? [], null);
        $this->setIfExists('final_monthly_value', $data ?? [], null);
        $this->setIfExists('final_additional_services_value', $data ?? [], null);
        $this->setIfExists('total_value', $data ?? [], null);
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

        if ($this->container['created_date'] === null) {
            $invalidProperties[] = "'created_date' can't be null";
        }
        if (!is_null($this->container['closed_reason']) && ($this->container['closed_reason'] < 0)) {
            $invalidProperties[] = "invalid value for 'closed_reason', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['competitor']) && (mb_strlen($this->container['competitor']) > 255)) {
            $invalidProperties[] = "invalid value for 'competitor', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['prospect_type']) && ($this->container['prospect_type'] < 1)) {
            $invalidProperties[] = "invalid value for 'prospect_type', must be bigger than or equal to 1.";
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
        if (!is_null($name) && (mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Prospect., must be smaller than or equal to 255.');
        }


        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

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
     * Gets created_date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->container['created_date'];
    }

    /**
     * Sets created_date
     *
     * @param string $created_date created_date
     *
     * @return self
     */
    public function setCreatedDate($created_date)
    {

        if (is_null($created_date)) {
            throw new \InvalidArgumentException('non-nullable created_date cannot be null');
        }

        $this->container['created_date'] = $created_date;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Customer|null
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Customer|null $customer customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {

        if (is_null($customer)) {
            throw new \InvalidArgumentException('non-nullable customer cannot be null');
        }

        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets sales_employee
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getSalesEmployee()
    {
        return $this->container['sales_employee'];
    }

    /**
     * Sets sales_employee
     *
     * @param \Learnist\Tripletex\Model\Employee|null $sales_employee sales_employee
     *
     * @return self
     */
    public function setSalesEmployee($sales_employee)
    {

        if (is_null($sales_employee)) {
            throw new \InvalidArgumentException('non-nullable sales_employee cannot be null');
        }

        $this->container['sales_employee'] = $sales_employee;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool|null
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool|null $is_closed is_closed
     *
     * @return self
     */
    public function setIsClosed($is_closed)
    {

        if (is_null($is_closed)) {
            throw new \InvalidArgumentException('non-nullable is_closed cannot be null');
        }

        $this->container['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Gets closed_reason
     *
     * @return int|null
     */
    public function getClosedReason()
    {
        return $this->container['closed_reason'];
    }

    /**
     * Sets closed_reason
     *
     * @param int|null $closed_reason closed_reason
     *
     * @return self
     */
    public function setClosedReason($closed_reason)
    {

        if (!is_null($closed_reason) && ($closed_reason < 0)) {
            throw new \InvalidArgumentException('invalid value for $closed_reason when calling Prospect., must be bigger than or equal to 0.');
        }


        if (is_null($closed_reason)) {
            throw new \InvalidArgumentException('non-nullable closed_reason cannot be null');
        }

        $this->container['closed_reason'] = $closed_reason;

        return $this;
    }

    /**
     * Gets closed_date
     *
     * @return string|null
     */
    public function getClosedDate()
    {
        return $this->container['closed_date'];
    }

    /**
     * Sets closed_date
     *
     * @param string|null $closed_date closed_date
     *
     * @return self
     */
    public function setClosedDate($closed_date)
    {

        if (is_null($closed_date)) {
            throw new \InvalidArgumentException('non-nullable closed_date cannot be null');
        }

        $this->container['closed_date'] = $closed_date;

        return $this;
    }

    /**
     * Gets competitor
     *
     * @return string|null
     */
    public function getCompetitor()
    {
        return $this->container['competitor'];
    }

    /**
     * Sets competitor
     *
     * @param string|null $competitor competitor
     *
     * @return self
     */
    public function setCompetitor($competitor)
    {
        if (!is_null($competitor) && (mb_strlen($competitor) > 255)) {
            throw new \InvalidArgumentException('invalid length for $competitor when calling Prospect., must be smaller than or equal to 255.');
        }


        if (is_null($competitor)) {
            throw new \InvalidArgumentException('non-nullable competitor cannot be null');
        }

        $this->container['competitor'] = $competitor;

        return $this;
    }

    /**
     * Gets prospect_type
     *
     * @return int|null
     */
    public function getProspectType()
    {
        return $this->container['prospect_type'];
    }

    /**
     * Sets prospect_type
     *
     * @param int|null $prospect_type prospect_type
     *
     * @return self
     */
    public function setProspectType($prospect_type)
    {

        if (!is_null($prospect_type) && ($prospect_type < 1)) {
            throw new \InvalidArgumentException('invalid value for $prospect_type when calling Prospect., must be bigger than or equal to 1.');
        }


        if (is_null($prospect_type)) {
            throw new \InvalidArgumentException('non-nullable prospect_type cannot be null');
        }

        $this->container['prospect_type'] = $prospect_type;

        return $this;
    }

    /**
     * Gets project
     *
     * @return \Learnist\Tripletex\Model\Project|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param \Learnist\Tripletex\Model\Project|null $project project
     *
     * @return self
     */
    public function setProject($project)
    {

        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }

        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets project_offer
     *
     * @return \Learnist\Tripletex\Model\Project|null
     */
    public function getProjectOffer()
    {
        return $this->container['project_offer'];
    }

    /**
     * Sets project_offer
     *
     * @param \Learnist\Tripletex\Model\Project|null $project_offer project_offer
     *
     * @return self
     */
    public function setProjectOffer($project_offer)
    {

        if (is_null($project_offer)) {
            throw new \InvalidArgumentException('non-nullable project_offer cannot be null');
        }

        $this->container['project_offer'] = $project_offer;

        return $this;
    }

    /**
     * Gets final_income_date
     *
     * @return string|null
     */
    public function getFinalIncomeDate()
    {
        return $this->container['final_income_date'];
    }

    /**
     * Sets final_income_date
     *
     * @param string|null $final_income_date The estimated start date for income on the prospect.
     *
     * @return self
     */
    public function setFinalIncomeDate($final_income_date)
    {

        if (is_null($final_income_date)) {
            throw new \InvalidArgumentException('non-nullable final_income_date cannot be null');
        }

        $this->container['final_income_date'] = $final_income_date;

        return $this;
    }

    /**
     * Gets final_initial_value
     *
     * @return float|null
     */
    public function getFinalInitialValue()
    {
        return $this->container['final_initial_value'];
    }

    /**
     * Sets final_initial_value
     *
     * @param float|null $final_initial_value The estimated startup fee on this prospect.
     *
     * @return self
     */
    public function setFinalInitialValue($final_initial_value)
    {

        if (is_null($final_initial_value)) {
            throw new \InvalidArgumentException('non-nullable final_initial_value cannot be null');
        }

        $this->container['final_initial_value'] = $final_initial_value;

        return $this;
    }

    /**
     * Gets final_monthly_value
     *
     * @return float|null
     */
    public function getFinalMonthlyValue()
    {
        return $this->container['final_monthly_value'];
    }

    /**
     * Sets final_monthly_value
     *
     * @param float|null $final_monthly_value The estimated monthly fee on this prospect.
     *
     * @return self
     */
    public function setFinalMonthlyValue($final_monthly_value)
    {

        if (is_null($final_monthly_value)) {
            throw new \InvalidArgumentException('non-nullable final_monthly_value cannot be null');
        }

        $this->container['final_monthly_value'] = $final_monthly_value;

        return $this;
    }

    /**
     * Gets final_additional_services_value
     *
     * @return float|null
     */
    public function getFinalAdditionalServicesValue()
    {
        return $this->container['final_additional_services_value'];
    }

    /**
     * Sets final_additional_services_value
     *
     * @param float|null $final_additional_services_value Tripletex specific.
     *
     * @return self
     */
    public function setFinalAdditionalServicesValue($final_additional_services_value)
    {

        if (is_null($final_additional_services_value)) {
            throw new \InvalidArgumentException('non-nullable final_additional_services_value cannot be null');
        }

        $this->container['final_additional_services_value'] = $final_additional_services_value;

        return $this;
    }

    /**
     * Gets total_value
     *
     * @return float|null
     */
    public function getTotalValue()
    {
        return $this->container['total_value'];
    }

    /**
     * Sets total_value
     *
     * @param float|null $total_value The estimated total fee on this prospect.
     *
     * @return self
     */
    public function setTotalValue($total_value)
    {

        if (is_null($total_value)) {
            throw new \InvalidArgumentException('non-nullable total_value cannot be null');
        }

        $this->container['total_value'] = $total_value;

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


