<?php
/**
 * RP2PermissionsDTO
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
 * RP2PermissionsDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RP2PermissionsDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'RP2PermissionsDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'can_view_employees' => 'bool',
'can_view_projects' => 'bool',
'can_see_other_employees' => 'bool',
'can_open_jobs' => 'bool',
'can_edit' => 'bool',
'can_create' => 'bool',
'can_delete' => 'bool',
'can_filter' => 'bool',
'can_batch_edit' => 'bool',
'can_batch_select' => 'bool',
'can_batch_delete' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'can_view_employees' => null,
'can_view_projects' => null,
'can_see_other_employees' => null,
'can_open_jobs' => null,
'can_edit' => null,
'can_create' => null,
'can_delete' => null,
'can_filter' => null,
'can_batch_edit' => null,
'can_batch_select' => null,
'can_batch_delete' => null    ];

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
        'can_view_employees' => 'canViewEmployees',
'can_view_projects' => 'canViewProjects',
'can_see_other_employees' => 'canSeeOtherEmployees',
'can_open_jobs' => 'canOpenJobs',
'can_edit' => 'canEdit',
'can_create' => 'canCreate',
'can_delete' => 'canDelete',
'can_filter' => 'canFilter',
'can_batch_edit' => 'canBatchEdit',
'can_batch_select' => 'canBatchSelect',
'can_batch_delete' => 'canBatchDelete'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'can_view_employees' => 'setCanViewEmployees',
'can_view_projects' => 'setCanViewProjects',
'can_see_other_employees' => 'setCanSeeOtherEmployees',
'can_open_jobs' => 'setCanOpenJobs',
'can_edit' => 'setCanEdit',
'can_create' => 'setCanCreate',
'can_delete' => 'setCanDelete',
'can_filter' => 'setCanFilter',
'can_batch_edit' => 'setCanBatchEdit',
'can_batch_select' => 'setCanBatchSelect',
'can_batch_delete' => 'setCanBatchDelete'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'can_view_employees' => 'getCanViewEmployees',
'can_view_projects' => 'getCanViewProjects',
'can_see_other_employees' => 'getCanSeeOtherEmployees',
'can_open_jobs' => 'getCanOpenJobs',
'can_edit' => 'getCanEdit',
'can_create' => 'getCanCreate',
'can_delete' => 'getCanDelete',
'can_filter' => 'getCanFilter',
'can_batch_edit' => 'getCanBatchEdit',
'can_batch_select' => 'getCanBatchSelect',
'can_batch_delete' => 'getCanBatchDelete'    ];

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
        $this->container['can_view_employees'] = isset($data['can_view_employees']) ? $data['can_view_employees'] : null;
        $this->container['can_view_projects'] = isset($data['can_view_projects']) ? $data['can_view_projects'] : null;
        $this->container['can_see_other_employees'] = isset($data['can_see_other_employees']) ? $data['can_see_other_employees'] : null;
        $this->container['can_open_jobs'] = isset($data['can_open_jobs']) ? $data['can_open_jobs'] : null;
        $this->container['can_edit'] = isset($data['can_edit']) ? $data['can_edit'] : null;
        $this->container['can_create'] = isset($data['can_create']) ? $data['can_create'] : null;
        $this->container['can_delete'] = isset($data['can_delete']) ? $data['can_delete'] : null;
        $this->container['can_filter'] = isset($data['can_filter']) ? $data['can_filter'] : null;
        $this->container['can_batch_edit'] = isset($data['can_batch_edit']) ? $data['can_batch_edit'] : null;
        $this->container['can_batch_select'] = isset($data['can_batch_select']) ? $data['can_batch_select'] : null;
        $this->container['can_batch_delete'] = isset($data['can_batch_delete']) ? $data['can_batch_delete'] : null;
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
     * Gets can_view_employees
     *
     * @return bool
     */
    public function getCanViewEmployees()
    {
        return $this->container['can_view_employees'];
    }

    /**
     * Sets can_view_employees
     *
     * @param bool $can_view_employees can_view_employees
     *
     * @return $this
     */
    public function setCanViewEmployees($can_view_employees)
    {
        $this->container['can_view_employees'] = $can_view_employees;

        return $this;
    }

    /**
     * Gets can_view_projects
     *
     * @return bool
     */
    public function getCanViewProjects()
    {
        return $this->container['can_view_projects'];
    }

    /**
     * Sets can_view_projects
     *
     * @param bool $can_view_projects can_view_projects
     *
     * @return $this
     */
    public function setCanViewProjects($can_view_projects)
    {
        $this->container['can_view_projects'] = $can_view_projects;

        return $this;
    }

    /**
     * Gets can_see_other_employees
     *
     * @return bool
     */
    public function getCanSeeOtherEmployees()
    {
        return $this->container['can_see_other_employees'];
    }

    /**
     * Sets can_see_other_employees
     *
     * @param bool $can_see_other_employees can_see_other_employees
     *
     * @return $this
     */
    public function setCanSeeOtherEmployees($can_see_other_employees)
    {
        $this->container['can_see_other_employees'] = $can_see_other_employees;

        return $this;
    }

    /**
     * Gets can_open_jobs
     *
     * @return bool
     */
    public function getCanOpenJobs()
    {
        return $this->container['can_open_jobs'];
    }

    /**
     * Sets can_open_jobs
     *
     * @param bool $can_open_jobs can_open_jobs
     *
     * @return $this
     */
    public function setCanOpenJobs($can_open_jobs)
    {
        $this->container['can_open_jobs'] = $can_open_jobs;

        return $this;
    }

    /**
     * Gets can_edit
     *
     * @return bool
     */
    public function getCanEdit()
    {
        return $this->container['can_edit'];
    }

    /**
     * Sets can_edit
     *
     * @param bool $can_edit can_edit
     *
     * @return $this
     */
    public function setCanEdit($can_edit)
    {
        $this->container['can_edit'] = $can_edit;

        return $this;
    }

    /**
     * Gets can_create
     *
     * @return bool
     */
    public function getCanCreate()
    {
        return $this->container['can_create'];
    }

    /**
     * Sets can_create
     *
     * @param bool $can_create can_create
     *
     * @return $this
     */
    public function setCanCreate($can_create)
    {
        $this->container['can_create'] = $can_create;

        return $this;
    }

    /**
     * Gets can_delete
     *
     * @return bool
     */
    public function getCanDelete()
    {
        return $this->container['can_delete'];
    }

    /**
     * Sets can_delete
     *
     * @param bool $can_delete can_delete
     *
     * @return $this
     */
    public function setCanDelete($can_delete)
    {
        $this->container['can_delete'] = $can_delete;

        return $this;
    }

    /**
     * Gets can_filter
     *
     * @return bool
     */
    public function getCanFilter()
    {
        return $this->container['can_filter'];
    }

    /**
     * Sets can_filter
     *
     * @param bool $can_filter can_filter
     *
     * @return $this
     */
    public function setCanFilter($can_filter)
    {
        $this->container['can_filter'] = $can_filter;

        return $this;
    }

    /**
     * Gets can_batch_edit
     *
     * @return bool
     */
    public function getCanBatchEdit()
    {
        return $this->container['can_batch_edit'];
    }

    /**
     * Sets can_batch_edit
     *
     * @param bool $can_batch_edit can_batch_edit
     *
     * @return $this
     */
    public function setCanBatchEdit($can_batch_edit)
    {
        $this->container['can_batch_edit'] = $can_batch_edit;

        return $this;
    }

    /**
     * Gets can_batch_select
     *
     * @return bool
     */
    public function getCanBatchSelect()
    {
        return $this->container['can_batch_select'];
    }

    /**
     * Sets can_batch_select
     *
     * @param bool $can_batch_select can_batch_select
     *
     * @return $this
     */
    public function setCanBatchSelect($can_batch_select)
    {
        $this->container['can_batch_select'] = $can_batch_select;

        return $this;
    }

    /**
     * Gets can_batch_delete
     *
     * @return bool
     */
    public function getCanBatchDelete()
    {
        return $this->container['can_batch_delete'];
    }

    /**
     * Sets can_batch_delete
     *
     * @param bool $can_batch_delete can_batch_delete
     *
     * @return $this
     */
    public function setCanBatchDelete($can_batch_delete)
    {
        $this->container['can_batch_delete'] = $can_batch_delete;

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
