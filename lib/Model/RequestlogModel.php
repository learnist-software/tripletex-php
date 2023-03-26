<?php
/**
 * RequestlogModel
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
 * RequestlogModel Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RequestlogModel implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'RequestlogModel';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'dirty' => 'bool',
'revision' => 'int',
'id' => 'int',
'create_log_id' => 'int',
'update_log_id' => 'int',
'client_id' => 'string',
'company_id' => 'int',
'employee_id' => 'int',
'time' => '\DateTime',
'requesturi' => 'string',
'querystring' => 'string',
'method' => 'string',
'tripletex_employee_id' => 'int',
'authorization_manager' => '\Learnist\Tripletex\Model\DatabaseComponentAuthorizationManagerRequestlogModel',
'display_name' => 'string',
'selected' => 'bool',
'changes' => '\Learnist\Tripletex\Model\Change[]',
'dirty_properties' => 'string[]',
'long_id' => 'int',
'gui_id' => 'int',
'gui_revision' => 'int',
'url_details' => 'string',
'create_log' => '\Learnist\Tripletex\Model\RequestlogModel',
'update_log' => '\Learnist\Tripletex\Model\RequestlogModel',
'delete_log' => '\Learnist\Tripletex\Model\RequestlogModel',
'delete_log_as_string' => 'string',
'delete_log_id' => 'int',
'create_log_as_string' => 'string',
'update_log_as_string' => 'string',
'deleted' => 'bool',
'new' => 'bool',
'authorization_manager_for_csv_printer' => '\Learnist\Tripletex\Model\AuthorizationManager'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'dirty' => null,
'revision' => 'int32',
'id' => 'int32',
'create_log_id' => 'int64',
'update_log_id' => 'int64',
'client_id' => null,
'company_id' => 'int32',
'employee_id' => 'int32',
'time' => 'date-time',
'requesturi' => null,
'querystring' => null,
'method' => null,
'tripletex_employee_id' => 'int32',
'authorization_manager' => null,
'display_name' => null,
'selected' => null,
'changes' => null,
'dirty_properties' => null,
'long_id' => 'int64',
'gui_id' => 'int32',
'gui_revision' => 'int32',
'url_details' => null,
'create_log' => null,
'update_log' => null,
'delete_log' => null,
'delete_log_as_string' => null,
'delete_log_id' => 'int64',
'create_log_as_string' => null,
'update_log_as_string' => null,
'deleted' => null,
'new' => null,
'authorization_manager_for_csv_printer' => null    ];

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
        'dirty' => 'dirty',
'revision' => 'revision',
'id' => 'id',
'create_log_id' => 'createLogId',
'update_log_id' => 'updateLogId',
'client_id' => 'clientId',
'company_id' => 'companyId',
'employee_id' => 'employeeId',
'time' => 'time',
'requesturi' => 'requesturi',
'querystring' => 'querystring',
'method' => 'method',
'tripletex_employee_id' => 'tripletexEmployeeId',
'authorization_manager' => 'authorizationManager',
'display_name' => 'displayName',
'selected' => 'selected',
'changes' => 'changes',
'dirty_properties' => 'dirtyProperties',
'long_id' => 'longId',
'gui_id' => 'guiId',
'gui_revision' => 'guiRevision',
'url_details' => 'urlDetails',
'create_log' => 'createLog',
'update_log' => 'updateLog',
'delete_log' => 'deleteLog',
'delete_log_as_string' => 'deleteLogAsString',
'delete_log_id' => 'deleteLogId',
'create_log_as_string' => 'createLogAsString',
'update_log_as_string' => 'updateLogAsString',
'deleted' => 'deleted',
'new' => 'new',
'authorization_manager_for_csv_printer' => 'authorizationManagerForCsvPrinter'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'dirty' => 'setDirty',
'revision' => 'setRevision',
'id' => 'setId',
'create_log_id' => 'setCreateLogId',
'update_log_id' => 'setUpdateLogId',
'client_id' => 'setClientId',
'company_id' => 'setCompanyId',
'employee_id' => 'setEmployeeId',
'time' => 'setTime',
'requesturi' => 'setRequesturi',
'querystring' => 'setQuerystring',
'method' => 'setMethod',
'tripletex_employee_id' => 'setTripletexEmployeeId',
'authorization_manager' => 'setAuthorizationManager',
'display_name' => 'setDisplayName',
'selected' => 'setSelected',
'changes' => 'setChanges',
'dirty_properties' => 'setDirtyProperties',
'long_id' => 'setLongId',
'gui_id' => 'setGuiId',
'gui_revision' => 'setGuiRevision',
'url_details' => 'setUrlDetails',
'create_log' => 'setCreateLog',
'update_log' => 'setUpdateLog',
'delete_log' => 'setDeleteLog',
'delete_log_as_string' => 'setDeleteLogAsString',
'delete_log_id' => 'setDeleteLogId',
'create_log_as_string' => 'setCreateLogAsString',
'update_log_as_string' => 'setUpdateLogAsString',
'deleted' => 'setDeleted',
'new' => 'setNew',
'authorization_manager_for_csv_printer' => 'setAuthorizationManagerForCsvPrinter'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'dirty' => 'getDirty',
'revision' => 'getRevision',
'id' => 'getId',
'create_log_id' => 'getCreateLogId',
'update_log_id' => 'getUpdateLogId',
'client_id' => 'getClientId',
'company_id' => 'getCompanyId',
'employee_id' => 'getEmployeeId',
'time' => 'getTime',
'requesturi' => 'getRequesturi',
'querystring' => 'getQuerystring',
'method' => 'getMethod',
'tripletex_employee_id' => 'getTripletexEmployeeId',
'authorization_manager' => 'getAuthorizationManager',
'display_name' => 'getDisplayName',
'selected' => 'getSelected',
'changes' => 'getChanges',
'dirty_properties' => 'getDirtyProperties',
'long_id' => 'getLongId',
'gui_id' => 'getGuiId',
'gui_revision' => 'getGuiRevision',
'url_details' => 'getUrlDetails',
'create_log' => 'getCreateLog',
'update_log' => 'getUpdateLog',
'delete_log' => 'getDeleteLog',
'delete_log_as_string' => 'getDeleteLogAsString',
'delete_log_id' => 'getDeleteLogId',
'create_log_as_string' => 'getCreateLogAsString',
'update_log_as_string' => 'getUpdateLogAsString',
'deleted' => 'getDeleted',
'new' => 'getNew',
'authorization_manager_for_csv_printer' => 'getAuthorizationManagerForCsvPrinter'    ];

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
        $this->container['dirty'] = isset($data['dirty']) ? $data['dirty'] : null;
        $this->container['revision'] = isset($data['revision']) ? $data['revision'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['create_log_id'] = isset($data['create_log_id']) ? $data['create_log_id'] : null;
        $this->container['update_log_id'] = isset($data['update_log_id']) ? $data['update_log_id'] : null;
        $this->container['client_id'] = isset($data['client_id']) ? $data['client_id'] : null;
        $this->container['company_id'] = isset($data['company_id']) ? $data['company_id'] : null;
        $this->container['employee_id'] = isset($data['employee_id']) ? $data['employee_id'] : null;
        $this->container['time'] = isset($data['time']) ? $data['time'] : null;
        $this->container['requesturi'] = isset($data['requesturi']) ? $data['requesturi'] : null;
        $this->container['querystring'] = isset($data['querystring']) ? $data['querystring'] : null;
        $this->container['method'] = isset($data['method']) ? $data['method'] : null;
        $this->container['tripletex_employee_id'] = isset($data['tripletex_employee_id']) ? $data['tripletex_employee_id'] : null;
        $this->container['authorization_manager'] = isset($data['authorization_manager']) ? $data['authorization_manager'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['selected'] = isset($data['selected']) ? $data['selected'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['dirty_properties'] = isset($data['dirty_properties']) ? $data['dirty_properties'] : null;
        $this->container['long_id'] = isset($data['long_id']) ? $data['long_id'] : null;
        $this->container['gui_id'] = isset($data['gui_id']) ? $data['gui_id'] : null;
        $this->container['gui_revision'] = isset($data['gui_revision']) ? $data['gui_revision'] : null;
        $this->container['url_details'] = isset($data['url_details']) ? $data['url_details'] : null;
        $this->container['create_log'] = isset($data['create_log']) ? $data['create_log'] : null;
        $this->container['update_log'] = isset($data['update_log']) ? $data['update_log'] : null;
        $this->container['delete_log'] = isset($data['delete_log']) ? $data['delete_log'] : null;
        $this->container['delete_log_as_string'] = isset($data['delete_log_as_string']) ? $data['delete_log_as_string'] : null;
        $this->container['delete_log_id'] = isset($data['delete_log_id']) ? $data['delete_log_id'] : null;
        $this->container['create_log_as_string'] = isset($data['create_log_as_string']) ? $data['create_log_as_string'] : null;
        $this->container['update_log_as_string'] = isset($data['update_log_as_string']) ? $data['update_log_as_string'] : null;
        $this->container['deleted'] = isset($data['deleted']) ? $data['deleted'] : null;
        $this->container['new'] = isset($data['new']) ? $data['new'] : null;
        $this->container['authorization_manager_for_csv_printer'] = isset($data['authorization_manager_for_csv_printer']) ? $data['authorization_manager_for_csv_printer'] : null;
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
     * Gets dirty
     *
     * @return bool
     */
    public function getDirty()
    {
        return $this->container['dirty'];
    }

    /**
     * Sets dirty
     *
     * @param bool $dirty dirty
     *
     * @return $this
     */
    public function setDirty($dirty)
    {
        $this->container['dirty'] = $dirty;

        return $this;
    }

    /**
     * Gets revision
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->container['revision'];
    }

    /**
     * Sets revision
     *
     * @param int $revision revision
     *
     * @return $this
     */
    public function setRevision($revision)
    {
        $this->container['revision'] = $revision;

        return $this;
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
     * Gets create_log_id
     *
     * @return int
     */
    public function getCreateLogId()
    {
        return $this->container['create_log_id'];
    }

    /**
     * Sets create_log_id
     *
     * @param int $create_log_id create_log_id
     *
     * @return $this
     */
    public function setCreateLogId($create_log_id)
    {
        $this->container['create_log_id'] = $create_log_id;

        return $this;
    }

    /**
     * Gets update_log_id
     *
     * @return int
     */
    public function getUpdateLogId()
    {
        return $this->container['update_log_id'];
    }

    /**
     * Sets update_log_id
     *
     * @param int $update_log_id update_log_id
     *
     * @return $this
     */
    public function setUpdateLogId($update_log_id)
    {
        $this->container['update_log_id'] = $update_log_id;

        return $this;
    }

    /**
     * Gets client_id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     *
     * @param string $client_id client_id
     *
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets company_id
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int $company_id company_id
     *
     * @return $this
     */
    public function setCompanyId($company_id)
    {
        $this->container['company_id'] = $company_id;

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
     * Gets time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->container['time'];
    }

    /**
     * Sets time
     *
     * @param \DateTime $time time
     *
     * @return $this
     */
    public function setTime($time)
    {
        $this->container['time'] = $time;

        return $this;
    }

    /**
     * Gets requesturi
     *
     * @return string
     */
    public function getRequesturi()
    {
        return $this->container['requesturi'];
    }

    /**
     * Sets requesturi
     *
     * @param string $requesturi requesturi
     *
     * @return $this
     */
    public function setRequesturi($requesturi)
    {
        $this->container['requesturi'] = $requesturi;

        return $this;
    }

    /**
     * Gets querystring
     *
     * @return string
     */
    public function getQuerystring()
    {
        return $this->container['querystring'];
    }

    /**
     * Sets querystring
     *
     * @param string $querystring querystring
     *
     * @return $this
     */
    public function setQuerystring($querystring)
    {
        $this->container['querystring'] = $querystring;

        return $this;
    }

    /**
     * Gets method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->container['method'];
    }

    /**
     * Sets method
     *
     * @param string $method method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->container['method'] = $method;

        return $this;
    }

    /**
     * Gets tripletex_employee_id
     *
     * @return int
     */
    public function getTripletexEmployeeId()
    {
        return $this->container['tripletex_employee_id'];
    }

    /**
     * Sets tripletex_employee_id
     *
     * @param int $tripletex_employee_id tripletex_employee_id
     *
     * @return $this
     */
    public function setTripletexEmployeeId($tripletex_employee_id)
    {
        $this->container['tripletex_employee_id'] = $tripletex_employee_id;

        return $this;
    }

    /**
     * Gets authorization_manager
     *
     * @return \Learnist\Tripletex\Model\DatabaseComponentAuthorizationManagerRequestlogModel
     */
    public function getAuthorizationManager()
    {
        return $this->container['authorization_manager'];
    }

    /**
     * Sets authorization_manager
     *
     * @param \Learnist\Tripletex\Model\DatabaseComponentAuthorizationManagerRequestlogModel $authorization_manager authorization_manager
     *
     * @return $this
     */
    public function setAuthorizationManager($authorization_manager)
    {
        $this->container['authorization_manager'] = $authorization_manager;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name display_name
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets selected
     *
     * @return bool
     */
    public function getSelected()
    {
        return $this->container['selected'];
    }

    /**
     * Sets selected
     *
     * @param bool $selected selected
     *
     * @return $this
     */
    public function setSelected($selected)
    {
        $this->container['selected'] = $selected;

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
     * Gets dirty_properties
     *
     * @return string[]
     */
    public function getDirtyProperties()
    {
        return $this->container['dirty_properties'];
    }

    /**
     * Sets dirty_properties
     *
     * @param string[] $dirty_properties dirty_properties
     *
     * @return $this
     */
    public function setDirtyProperties($dirty_properties)
    {
        $this->container['dirty_properties'] = $dirty_properties;

        return $this;
    }

    /**
     * Gets long_id
     *
     * @return int
     */
    public function getLongId()
    {
        return $this->container['long_id'];
    }

    /**
     * Sets long_id
     *
     * @param int $long_id long_id
     *
     * @return $this
     */
    public function setLongId($long_id)
    {
        $this->container['long_id'] = $long_id;

        return $this;
    }

    /**
     * Gets gui_id
     *
     * @return int
     */
    public function getGuiId()
    {
        return $this->container['gui_id'];
    }

    /**
     * Sets gui_id
     *
     * @param int $gui_id gui_id
     *
     * @return $this
     */
    public function setGuiId($gui_id)
    {
        $this->container['gui_id'] = $gui_id;

        return $this;
    }

    /**
     * Gets gui_revision
     *
     * @return int
     */
    public function getGuiRevision()
    {
        return $this->container['gui_revision'];
    }

    /**
     * Sets gui_revision
     *
     * @param int $gui_revision gui_revision
     *
     * @return $this
     */
    public function setGuiRevision($gui_revision)
    {
        $this->container['gui_revision'] = $gui_revision;

        return $this;
    }

    /**
     * Gets url_details
     *
     * @return string
     */
    public function getUrlDetails()
    {
        return $this->container['url_details'];
    }

    /**
     * Sets url_details
     *
     * @param string $url_details url_details
     *
     * @return $this
     */
    public function setUrlDetails($url_details)
    {
        $this->container['url_details'] = $url_details;

        return $this;
    }

    /**
     * Gets create_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel
     */
    public function getCreateLog()
    {
        return $this->container['create_log'];
    }

    /**
     * Sets create_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel $create_log create_log
     *
     * @return $this
     */
    public function setCreateLog($create_log)
    {
        $this->container['create_log'] = $create_log;

        return $this;
    }

    /**
     * Gets update_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel
     */
    public function getUpdateLog()
    {
        return $this->container['update_log'];
    }

    /**
     * Sets update_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel $update_log update_log
     *
     * @return $this
     */
    public function setUpdateLog($update_log)
    {
        $this->container['update_log'] = $update_log;

        return $this;
    }

    /**
     * Gets delete_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel
     */
    public function getDeleteLog()
    {
        return $this->container['delete_log'];
    }

    /**
     * Sets delete_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel $delete_log delete_log
     *
     * @return $this
     */
    public function setDeleteLog($delete_log)
    {
        $this->container['delete_log'] = $delete_log;

        return $this;
    }

    /**
     * Gets delete_log_as_string
     *
     * @return string
     */
    public function getDeleteLogAsString()
    {
        return $this->container['delete_log_as_string'];
    }

    /**
     * Sets delete_log_as_string
     *
     * @param string $delete_log_as_string delete_log_as_string
     *
     * @return $this
     */
    public function setDeleteLogAsString($delete_log_as_string)
    {
        $this->container['delete_log_as_string'] = $delete_log_as_string;

        return $this;
    }

    /**
     * Gets delete_log_id
     *
     * @return int
     */
    public function getDeleteLogId()
    {
        return $this->container['delete_log_id'];
    }

    /**
     * Sets delete_log_id
     *
     * @param int $delete_log_id delete_log_id
     *
     * @return $this
     */
    public function setDeleteLogId($delete_log_id)
    {
        $this->container['delete_log_id'] = $delete_log_id;

        return $this;
    }

    /**
     * Gets create_log_as_string
     *
     * @return string
     */
    public function getCreateLogAsString()
    {
        return $this->container['create_log_as_string'];
    }

    /**
     * Sets create_log_as_string
     *
     * @param string $create_log_as_string create_log_as_string
     *
     * @return $this
     */
    public function setCreateLogAsString($create_log_as_string)
    {
        $this->container['create_log_as_string'] = $create_log_as_string;

        return $this;
    }

    /**
     * Gets update_log_as_string
     *
     * @return string
     */
    public function getUpdateLogAsString()
    {
        return $this->container['update_log_as_string'];
    }

    /**
     * Sets update_log_as_string
     *
     * @param string $update_log_as_string update_log_as_string
     *
     * @return $this
     */
    public function setUpdateLogAsString($update_log_as_string)
    {
        $this->container['update_log_as_string'] = $update_log_as_string;

        return $this;
    }

    /**
     * Gets deleted
     *
     * @return bool
     */
    public function getDeleted()
    {
        return $this->container['deleted'];
    }

    /**
     * Sets deleted
     *
     * @param bool $deleted deleted
     *
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->container['deleted'] = $deleted;

        return $this;
    }

    /**
     * Gets new
     *
     * @return bool
     */
    public function getNew()
    {
        return $this->container['new'];
    }

    /**
     * Sets new
     *
     * @param bool $new new
     *
     * @return $this
     */
    public function setNew($new)
    {
        $this->container['new'] = $new;

        return $this;
    }

    /**
     * Gets authorization_manager_for_csv_printer
     *
     * @return \Learnist\Tripletex\Model\AuthorizationManager
     */
    public function getAuthorizationManagerForCsvPrinter()
    {
        return $this->container['authorization_manager_for_csv_printer'];
    }

    /**
     * Sets authorization_manager_for_csv_printer
     *
     * @param \Learnist\Tripletex\Model\AuthorizationManager $authorization_manager_for_csv_printer authorization_manager_for_csv_printer
     *
     * @return $this
     */
    public function setAuthorizationManagerForCsvPrinter($authorization_manager_for_csv_printer)
    {
        $this->container['authorization_manager_for_csv_printer'] = $authorization_manager_for_csv_printer;

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
