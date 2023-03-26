<?php
/**
 * CompanyRepresentative
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
 * CompanyRepresentative Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CompanyRepresentative implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CompanyRepresentative';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'dirty' => 'bool',
        'revision' => 'int',
        'id' => 'int',
        'create_log_id' => 'int',
        'update_log_id' => 'int',
        'client_id' => 'string',
        'company_id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'role_in_company' => 'int',
        'birthdate' => '\DateTime',
        'company_name' => 'string',
        'social_security_number' => 'string',
        'signature_status' => 'int',
        'description' => 'string',
        'tripletex_user_id' => 'int',
        'authorization_manager' => 'object',
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
        'authorization_manager_for_csv_printer' => 'object'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'dirty' => null,
        'revision' => 'int32',
        'id' => 'int32',
        'create_log_id' => 'int64',
        'update_log_id' => 'int64',
        'client_id' => null,
        'company_id' => 'int32',
        'name' => null,
        'email' => null,
        'role_in_company' => 'int32',
        'birthdate' => 'date-time',
        'company_name' => null,
        'social_security_number' => null,
        'signature_status' => 'int32',
        'description' => null,
        'tripletex_user_id' => 'int32',
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
        'authorization_manager_for_csv_printer' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'dirty' => false,
		'revision' => false,
		'id' => false,
		'create_log_id' => false,
		'update_log_id' => false,
		'client_id' => false,
		'company_id' => false,
		'name' => false,
		'email' => false,
		'role_in_company' => false,
		'birthdate' => false,
		'company_name' => false,
		'social_security_number' => false,
		'signature_status' => false,
		'description' => false,
		'tripletex_user_id' => false,
		'authorization_manager' => false,
		'display_name' => false,
		'selected' => false,
		'changes' => false,
		'dirty_properties' => false,
		'long_id' => false,
		'gui_id' => false,
		'gui_revision' => false,
		'url_details' => false,
		'create_log' => false,
		'update_log' => false,
		'delete_log' => false,
		'delete_log_as_string' => false,
		'delete_log_id' => false,
		'create_log_as_string' => false,
		'update_log_as_string' => false,
		'deleted' => false,
		'new' => false,
		'authorization_manager_for_csv_printer' => false
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
        'dirty' => 'dirty',
        'revision' => 'revision',
        'id' => 'id',
        'create_log_id' => 'createLogId',
        'update_log_id' => 'updateLogId',
        'client_id' => 'clientId',
        'company_id' => 'companyId',
        'name' => 'name',
        'email' => 'email',
        'role_in_company' => 'roleInCompany',
        'birthdate' => 'birthdate',
        'company_name' => 'companyName',
        'social_security_number' => 'socialSecurityNumber',
        'signature_status' => 'signatureStatus',
        'description' => 'description',
        'tripletex_user_id' => 'tripletexUserId',
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
        'authorization_manager_for_csv_printer' => 'authorizationManagerForCsvPrinter'
    ];

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
        'name' => 'setName',
        'email' => 'setEmail',
        'role_in_company' => 'setRoleInCompany',
        'birthdate' => 'setBirthdate',
        'company_name' => 'setCompanyName',
        'social_security_number' => 'setSocialSecurityNumber',
        'signature_status' => 'setSignatureStatus',
        'description' => 'setDescription',
        'tripletex_user_id' => 'setTripletexUserId',
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
        'authorization_manager_for_csv_printer' => 'setAuthorizationManagerForCsvPrinter'
    ];

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
        'name' => 'getName',
        'email' => 'getEmail',
        'role_in_company' => 'getRoleInCompany',
        'birthdate' => 'getBirthdate',
        'company_name' => 'getCompanyName',
        'social_security_number' => 'getSocialSecurityNumber',
        'signature_status' => 'getSignatureStatus',
        'description' => 'getDescription',
        'tripletex_user_id' => 'getTripletexUserId',
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
        'authorization_manager_for_csv_printer' => 'getAuthorizationManagerForCsvPrinter'
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
        $this->setIfExists('dirty', $data ?? [], null);
        $this->setIfExists('revision', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('create_log_id', $data ?? [], null);
        $this->setIfExists('update_log_id', $data ?? [], null);
        $this->setIfExists('client_id', $data ?? [], null);
        $this->setIfExists('company_id', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('role_in_company', $data ?? [], null);
        $this->setIfExists('birthdate', $data ?? [], null);
        $this->setIfExists('company_name', $data ?? [], null);
        $this->setIfExists('social_security_number', $data ?? [], null);
        $this->setIfExists('signature_status', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('tripletex_user_id', $data ?? [], null);
        $this->setIfExists('authorization_manager', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('selected', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('dirty_properties', $data ?? [], null);
        $this->setIfExists('long_id', $data ?? [], null);
        $this->setIfExists('gui_id', $data ?? [], null);
        $this->setIfExists('gui_revision', $data ?? [], null);
        $this->setIfExists('url_details', $data ?? [], null);
        $this->setIfExists('create_log', $data ?? [], null);
        $this->setIfExists('update_log', $data ?? [], null);
        $this->setIfExists('delete_log', $data ?? [], null);
        $this->setIfExists('delete_log_as_string', $data ?? [], null);
        $this->setIfExists('delete_log_id', $data ?? [], null);
        $this->setIfExists('create_log_as_string', $data ?? [], null);
        $this->setIfExists('update_log_as_string', $data ?? [], null);
        $this->setIfExists('deleted', $data ?? [], null);
        $this->setIfExists('new', $data ?? [], null);
        $this->setIfExists('authorization_manager_for_csv_printer', $data ?? [], null);
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
     * Gets dirty
     *
     * @return bool|null
     */
    public function getDirty()
    {
        return $this->container['dirty'];
    }

    /**
     * Sets dirty
     *
     * @param bool|null $dirty dirty
     *
     * @return self
     */
    public function setDirty($dirty)
    {

        if (is_null($dirty)) {
            throw new \InvalidArgumentException('non-nullable dirty cannot be null');
        }

        $this->container['dirty'] = $dirty;

        return $this;
    }

    /**
     * Gets revision
     *
     * @return int|null
     */
    public function getRevision()
    {
        return $this->container['revision'];
    }

    /**
     * Sets revision
     *
     * @param int|null $revision revision
     *
     * @return self
     */
    public function setRevision($revision)
    {

        if (is_null($revision)) {
            throw new \InvalidArgumentException('non-nullable revision cannot be null');
        }

        $this->container['revision'] = $revision;

        return $this;
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
     * Gets create_log_id
     *
     * @return int|null
     */
    public function getCreateLogId()
    {
        return $this->container['create_log_id'];
    }

    /**
     * Sets create_log_id
     *
     * @param int|null $create_log_id create_log_id
     *
     * @return self
     */
    public function setCreateLogId($create_log_id)
    {

        if (is_null($create_log_id)) {
            throw new \InvalidArgumentException('non-nullable create_log_id cannot be null');
        }

        $this->container['create_log_id'] = $create_log_id;

        return $this;
    }

    /**
     * Gets update_log_id
     *
     * @return int|null
     */
    public function getUpdateLogId()
    {
        return $this->container['update_log_id'];
    }

    /**
     * Sets update_log_id
     *
     * @param int|null $update_log_id update_log_id
     *
     * @return self
     */
    public function setUpdateLogId($update_log_id)
    {

        if (is_null($update_log_id)) {
            throw new \InvalidArgumentException('non-nullable update_log_id cannot be null');
        }

        $this->container['update_log_id'] = $update_log_id;

        return $this;
    }

    /**
     * Gets client_id
     *
     * @return string|null
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     *
     * @param string|null $client_id client_id
     *
     * @return self
     */
    public function setClientId($client_id)
    {

        if (is_null($client_id)) {
            throw new \InvalidArgumentException('non-nullable client_id cannot be null');
        }

        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets company_id
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int|null $company_id company_id
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {

        if (is_null($company_id)) {
            throw new \InvalidArgumentException('non-nullable company_id cannot be null');
        }

        $this->container['company_id'] = $company_id;

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

        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {

        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets role_in_company
     *
     * @return int|null
     */
    public function getRoleInCompany()
    {
        return $this->container['role_in_company'];
    }

    /**
     * Sets role_in_company
     *
     * @param int|null $role_in_company role_in_company
     *
     * @return self
     */
    public function setRoleInCompany($role_in_company)
    {

        if (is_null($role_in_company)) {
            throw new \InvalidArgumentException('non-nullable role_in_company cannot be null');
        }

        $this->container['role_in_company'] = $role_in_company;

        return $this;
    }

    /**
     * Gets birthdate
     *
     * @return \DateTime|null
     */
    public function getBirthdate()
    {
        return $this->container['birthdate'];
    }

    /**
     * Sets birthdate
     *
     * @param \DateTime|null $birthdate birthdate
     *
     * @return self
     */
    public function setBirthdate($birthdate)
    {

        if (is_null($birthdate)) {
            throw new \InvalidArgumentException('non-nullable birthdate cannot be null');
        }

        $this->container['birthdate'] = $birthdate;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string|null $company_name company_name
     *
     * @return self
     */
    public function setCompanyName($company_name)
    {

        if (is_null($company_name)) {
            throw new \InvalidArgumentException('non-nullable company_name cannot be null');
        }

        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets social_security_number
     *
     * @return string|null
     */
    public function getSocialSecurityNumber()
    {
        return $this->container['social_security_number'];
    }

    /**
     * Sets social_security_number
     *
     * @param string|null $social_security_number social_security_number
     *
     * @return self
     */
    public function setSocialSecurityNumber($social_security_number)
    {

        if (is_null($social_security_number)) {
            throw new \InvalidArgumentException('non-nullable social_security_number cannot be null');
        }

        $this->container['social_security_number'] = $social_security_number;

        return $this;
    }

    /**
     * Gets signature_status
     *
     * @return int|null
     */
    public function getSignatureStatus()
    {
        return $this->container['signature_status'];
    }

    /**
     * Sets signature_status
     *
     * @param int|null $signature_status signature_status
     *
     * @return self
     */
    public function setSignatureStatus($signature_status)
    {

        if (is_null($signature_status)) {
            throw new \InvalidArgumentException('non-nullable signature_status cannot be null');
        }

        $this->container['signature_status'] = $signature_status;

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
     * Gets tripletex_user_id
     *
     * @return int|null
     */
    public function getTripletexUserId()
    {
        return $this->container['tripletex_user_id'];
    }

    /**
     * Sets tripletex_user_id
     *
     * @param int|null $tripletex_user_id tripletex_user_id
     *
     * @return self
     */
    public function setTripletexUserId($tripletex_user_id)
    {

        if (is_null($tripletex_user_id)) {
            throw new \InvalidArgumentException('non-nullable tripletex_user_id cannot be null');
        }

        $this->container['tripletex_user_id'] = $tripletex_user_id;

        return $this;
    }

    /**
     * Gets authorization_manager
     *
     * @return object|null
     */
    public function getAuthorizationManager()
    {
        return $this->container['authorization_manager'];
    }

    /**
     * Sets authorization_manager
     *
     * @param object|null $authorization_manager authorization_manager
     *
     * @return self
     */
    public function setAuthorizationManager($authorization_manager)
    {

        if (is_null($authorization_manager)) {
            throw new \InvalidArgumentException('non-nullable authorization_manager cannot be null');
        }

        $this->container['authorization_manager'] = $authorization_manager;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {

        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }

        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets selected
     *
     * @return bool|null
     */
    public function getSelected()
    {
        return $this->container['selected'];
    }

    /**
     * Sets selected
     *
     * @param bool|null $selected selected
     *
     * @return self
     */
    public function setSelected($selected)
    {

        if (is_null($selected)) {
            throw new \InvalidArgumentException('non-nullable selected cannot be null');
        }

        $this->container['selected'] = $selected;

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
     * Gets dirty_properties
     *
     * @return string[]|null
     */
    public function getDirtyProperties()
    {
        return $this->container['dirty_properties'];
    }

    /**
     * Sets dirty_properties
     *
     * @param string[]|null $dirty_properties dirty_properties
     *
     * @return self
     */
    public function setDirtyProperties($dirty_properties)
    {



        if (is_null($dirty_properties)) {
            throw new \InvalidArgumentException('non-nullable dirty_properties cannot be null');
        }

        $this->container['dirty_properties'] = $dirty_properties;

        return $this;
    }

    /**
     * Gets long_id
     *
     * @return int|null
     */
    public function getLongId()
    {
        return $this->container['long_id'];
    }

    /**
     * Sets long_id
     *
     * @param int|null $long_id long_id
     *
     * @return self
     */
    public function setLongId($long_id)
    {

        if (is_null($long_id)) {
            throw new \InvalidArgumentException('non-nullable long_id cannot be null');
        }

        $this->container['long_id'] = $long_id;

        return $this;
    }

    /**
     * Gets gui_id
     *
     * @return int|null
     */
    public function getGuiId()
    {
        return $this->container['gui_id'];
    }

    /**
     * Sets gui_id
     *
     * @param int|null $gui_id gui_id
     *
     * @return self
     */
    public function setGuiId($gui_id)
    {

        if (is_null($gui_id)) {
            throw new \InvalidArgumentException('non-nullable gui_id cannot be null');
        }

        $this->container['gui_id'] = $gui_id;

        return $this;
    }

    /**
     * Gets gui_revision
     *
     * @return int|null
     */
    public function getGuiRevision()
    {
        return $this->container['gui_revision'];
    }

    /**
     * Sets gui_revision
     *
     * @param int|null $gui_revision gui_revision
     *
     * @return self
     */
    public function setGuiRevision($gui_revision)
    {

        if (is_null($gui_revision)) {
            throw new \InvalidArgumentException('non-nullable gui_revision cannot be null');
        }

        $this->container['gui_revision'] = $gui_revision;

        return $this;
    }

    /**
     * Gets url_details
     *
     * @return string|null
     */
    public function getUrlDetails()
    {
        return $this->container['url_details'];
    }

    /**
     * Sets url_details
     *
     * @param string|null $url_details url_details
     *
     * @return self
     */
    public function setUrlDetails($url_details)
    {

        if (is_null($url_details)) {
            throw new \InvalidArgumentException('non-nullable url_details cannot be null');
        }

        $this->container['url_details'] = $url_details;

        return $this;
    }

    /**
     * Gets create_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel|null
     */
    public function getCreateLog()
    {
        return $this->container['create_log'];
    }

    /**
     * Sets create_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel|null $create_log create_log
     *
     * @return self
     */
    public function setCreateLog($create_log)
    {

        if (is_null($create_log)) {
            throw new \InvalidArgumentException('non-nullable create_log cannot be null');
        }

        $this->container['create_log'] = $create_log;

        return $this;
    }

    /**
     * Gets update_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel|null
     */
    public function getUpdateLog()
    {
        return $this->container['update_log'];
    }

    /**
     * Sets update_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel|null $update_log update_log
     *
     * @return self
     */
    public function setUpdateLog($update_log)
    {

        if (is_null($update_log)) {
            throw new \InvalidArgumentException('non-nullable update_log cannot be null');
        }

        $this->container['update_log'] = $update_log;

        return $this;
    }

    /**
     * Gets delete_log
     *
     * @return \Learnist\Tripletex\Model\RequestlogModel|null
     */
    public function getDeleteLog()
    {
        return $this->container['delete_log'];
    }

    /**
     * Sets delete_log
     *
     * @param \Learnist\Tripletex\Model\RequestlogModel|null $delete_log delete_log
     *
     * @return self
     */
    public function setDeleteLog($delete_log)
    {

        if (is_null($delete_log)) {
            throw new \InvalidArgumentException('non-nullable delete_log cannot be null');
        }

        $this->container['delete_log'] = $delete_log;

        return $this;
    }

    /**
     * Gets delete_log_as_string
     *
     * @return string|null
     */
    public function getDeleteLogAsString()
    {
        return $this->container['delete_log_as_string'];
    }

    /**
     * Sets delete_log_as_string
     *
     * @param string|null $delete_log_as_string delete_log_as_string
     *
     * @return self
     */
    public function setDeleteLogAsString($delete_log_as_string)
    {

        if (is_null($delete_log_as_string)) {
            throw new \InvalidArgumentException('non-nullable delete_log_as_string cannot be null');
        }

        $this->container['delete_log_as_string'] = $delete_log_as_string;

        return $this;
    }

    /**
     * Gets delete_log_id
     *
     * @return int|null
     */
    public function getDeleteLogId()
    {
        return $this->container['delete_log_id'];
    }

    /**
     * Sets delete_log_id
     *
     * @param int|null $delete_log_id delete_log_id
     *
     * @return self
     */
    public function setDeleteLogId($delete_log_id)
    {

        if (is_null($delete_log_id)) {
            throw new \InvalidArgumentException('non-nullable delete_log_id cannot be null');
        }

        $this->container['delete_log_id'] = $delete_log_id;

        return $this;
    }

    /**
     * Gets create_log_as_string
     *
     * @return string|null
     */
    public function getCreateLogAsString()
    {
        return $this->container['create_log_as_string'];
    }

    /**
     * Sets create_log_as_string
     *
     * @param string|null $create_log_as_string create_log_as_string
     *
     * @return self
     */
    public function setCreateLogAsString($create_log_as_string)
    {

        if (is_null($create_log_as_string)) {
            throw new \InvalidArgumentException('non-nullable create_log_as_string cannot be null');
        }

        $this->container['create_log_as_string'] = $create_log_as_string;

        return $this;
    }

    /**
     * Gets update_log_as_string
     *
     * @return string|null
     */
    public function getUpdateLogAsString()
    {
        return $this->container['update_log_as_string'];
    }

    /**
     * Sets update_log_as_string
     *
     * @param string|null $update_log_as_string update_log_as_string
     *
     * @return self
     */
    public function setUpdateLogAsString($update_log_as_string)
    {

        if (is_null($update_log_as_string)) {
            throw new \InvalidArgumentException('non-nullable update_log_as_string cannot be null');
        }

        $this->container['update_log_as_string'] = $update_log_as_string;

        return $this;
    }

    /**
     * Gets deleted
     *
     * @return bool|null
     */
    public function getDeleted()
    {
        return $this->container['deleted'];
    }

    /**
     * Sets deleted
     *
     * @param bool|null $deleted deleted
     *
     * @return self
     */
    public function setDeleted($deleted)
    {

        if (is_null($deleted)) {
            throw new \InvalidArgumentException('non-nullable deleted cannot be null');
        }

        $this->container['deleted'] = $deleted;

        return $this;
    }

    /**
     * Gets new
     *
     * @return bool|null
     */
    public function getNew()
    {
        return $this->container['new'];
    }

    /**
     * Sets new
     *
     * @param bool|null $new new
     *
     * @return self
     */
    public function setNew($new)
    {

        if (is_null($new)) {
            throw new \InvalidArgumentException('non-nullable new cannot be null');
        }

        $this->container['new'] = $new;

        return $this;
    }

    /**
     * Gets authorization_manager_for_csv_printer
     *
     * @return object|null
     */
    public function getAuthorizationManagerForCsvPrinter()
    {
        return $this->container['authorization_manager_for_csv_printer'];
    }

    /**
     * Sets authorization_manager_for_csv_printer
     *
     * @param object|null $authorization_manager_for_csv_printer authorization_manager_for_csv_printer
     *
     * @return self
     */
    public function setAuthorizationManagerForCsvPrinter($authorization_manager_for_csv_printer)
    {

        if (is_null($authorization_manager_for_csv_printer)) {
            throw new \InvalidArgumentException('non-nullable authorization_manager_for_csv_printer cannot be null');
        }

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


