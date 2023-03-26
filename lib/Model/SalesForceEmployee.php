<?php
/**
 * SalesForceEmployee
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
 * SalesForceEmployee Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalesForceEmployee implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalesForceEmployee';

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
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone_number_mobile' => 'string',
        'phone_number_home' => 'string',
        'phone_number_work' => 'string',
        'user_id' => 'int',
        'company_id' => 'int',
        'customer_id' => 'int',
        'phone_number_sms_certified' => 'string',
        'is_user_administrator' => 'bool',
        'is_account_administrator' => 'bool',
        'allow_login' => 'bool',
        'is_external' => 'bool',
        'is_tripletex_certified' => 'bool',
        'is_default_login' => 'bool',
        'login_end_date' => 'string',
        'address' => '\Learnist\Tripletex\Model\SalesForceAddress',
        'is_marketing_consent' => 'bool',
        'is_app_user' => 'bool'
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
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone_number_mobile' => null,
        'phone_number_home' => null,
        'phone_number_work' => null,
        'user_id' => 'int32',
        'company_id' => 'int32',
        'customer_id' => 'int32',
        'phone_number_sms_certified' => null,
        'is_user_administrator' => null,
        'is_account_administrator' => null,
        'allow_login' => null,
        'is_external' => null,
        'is_tripletex_certified' => null,
        'is_default_login' => null,
        'login_end_date' => null,
        'address' => null,
        'is_marketing_consent' => null,
        'is_app_user' => null
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
		'first_name' => false,
		'last_name' => false,
		'email' => false,
		'phone_number_mobile' => false,
		'phone_number_home' => false,
		'phone_number_work' => false,
		'user_id' => false,
		'company_id' => false,
		'customer_id' => false,
		'phone_number_sms_certified' => false,
		'is_user_administrator' => false,
		'is_account_administrator' => false,
		'allow_login' => false,
		'is_external' => false,
		'is_tripletex_certified' => false,
		'is_default_login' => false,
		'login_end_date' => false,
		'address' => false,
		'is_marketing_consent' => false,
		'is_app_user' => false
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
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'email' => 'email',
        'phone_number_mobile' => 'phoneNumberMobile',
        'phone_number_home' => 'phoneNumberHome',
        'phone_number_work' => 'phoneNumberWork',
        'user_id' => 'userId',
        'company_id' => 'companyId',
        'customer_id' => 'customerId',
        'phone_number_sms_certified' => 'phoneNumberSmsCertified',
        'is_user_administrator' => 'isUserAdministrator',
        'is_account_administrator' => 'isAccountAdministrator',
        'allow_login' => 'allowLogin',
        'is_external' => 'isExternal',
        'is_tripletex_certified' => 'isTripletexCertified',
        'is_default_login' => 'isDefaultLogin',
        'login_end_date' => 'loginEndDate',
        'address' => 'address',
        'is_marketing_consent' => 'isMarketingConsent',
        'is_app_user' => 'isAppUser'
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
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'email' => 'setEmail',
        'phone_number_mobile' => 'setPhoneNumberMobile',
        'phone_number_home' => 'setPhoneNumberHome',
        'phone_number_work' => 'setPhoneNumberWork',
        'user_id' => 'setUserId',
        'company_id' => 'setCompanyId',
        'customer_id' => 'setCustomerId',
        'phone_number_sms_certified' => 'setPhoneNumberSmsCertified',
        'is_user_administrator' => 'setIsUserAdministrator',
        'is_account_administrator' => 'setIsAccountAdministrator',
        'allow_login' => 'setAllowLogin',
        'is_external' => 'setIsExternal',
        'is_tripletex_certified' => 'setIsTripletexCertified',
        'is_default_login' => 'setIsDefaultLogin',
        'login_end_date' => 'setLoginEndDate',
        'address' => 'setAddress',
        'is_marketing_consent' => 'setIsMarketingConsent',
        'is_app_user' => 'setIsAppUser'
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
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'email' => 'getEmail',
        'phone_number_mobile' => 'getPhoneNumberMobile',
        'phone_number_home' => 'getPhoneNumberHome',
        'phone_number_work' => 'getPhoneNumberWork',
        'user_id' => 'getUserId',
        'company_id' => 'getCompanyId',
        'customer_id' => 'getCustomerId',
        'phone_number_sms_certified' => 'getPhoneNumberSmsCertified',
        'is_user_administrator' => 'getIsUserAdministrator',
        'is_account_administrator' => 'getIsAccountAdministrator',
        'allow_login' => 'getAllowLogin',
        'is_external' => 'getIsExternal',
        'is_tripletex_certified' => 'getIsTripletexCertified',
        'is_default_login' => 'getIsDefaultLogin',
        'login_end_date' => 'getLoginEndDate',
        'address' => 'getAddress',
        'is_marketing_consent' => 'getIsMarketingConsent',
        'is_app_user' => 'getIsAppUser'
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
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('phone_number_mobile', $data ?? [], null);
        $this->setIfExists('phone_number_home', $data ?? [], null);
        $this->setIfExists('phone_number_work', $data ?? [], null);
        $this->setIfExists('user_id', $data ?? [], null);
        $this->setIfExists('company_id', $data ?? [], null);
        $this->setIfExists('customer_id', $data ?? [], null);
        $this->setIfExists('phone_number_sms_certified', $data ?? [], null);
        $this->setIfExists('is_user_administrator', $data ?? [], null);
        $this->setIfExists('is_account_administrator', $data ?? [], null);
        $this->setIfExists('allow_login', $data ?? [], null);
        $this->setIfExists('is_external', $data ?? [], null);
        $this->setIfExists('is_tripletex_certified', $data ?? [], null);
        $this->setIfExists('is_default_login', $data ?? [], null);
        $this->setIfExists('login_end_date', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('is_marketing_consent', $data ?? [], null);
        $this->setIfExists('is_app_user', $data ?? [], null);
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

        if (!is_null($this->container['first_name']) && (mb_strlen($this->container['first_name']) > 100)) {
            $invalidProperties[] = "invalid value for 'first_name', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['last_name']) && (mb_strlen($this->container['last_name']) > 100)) {
            $invalidProperties[] = "invalid value for 'last_name', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['email']) && (mb_strlen($this->container['email']) > 100)) {
            $invalidProperties[] = "invalid value for 'email', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_mobile']) && (mb_strlen($this->container['phone_number_mobile']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_mobile', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_home']) && (mb_strlen($this->container['phone_number_home']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_home', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_work']) && (mb_strlen($this->container['phone_number_work']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_work', the character length must be smaller than or equal to 100.";
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
     * Gets first_name
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string|null $first_name first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        if (is_null($first_name)) {
            throw new \InvalidArgumentException('non-nullable first_name cannot be null');
        }
        if ((mb_strlen($first_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $first_name when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string|null $last_name last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        if (is_null($last_name)) {
            throw new \InvalidArgumentException('non-nullable last_name cannot be null');
        }
        if ((mb_strlen($last_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $last_name when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['last_name'] = $last_name;

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
        if ((mb_strlen($email) > 100)) {
            throw new \InvalidArgumentException('invalid length for $email when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets phone_number_mobile
     *
     * @return string|null
     */
    public function getPhoneNumberMobile()
    {
        return $this->container['phone_number_mobile'];
    }

    /**
     * Sets phone_number_mobile
     *
     * @param string|null $phone_number_mobile phone_number_mobile
     *
     * @return self
     */
    public function setPhoneNumberMobile($phone_number_mobile)
    {
        if (is_null($phone_number_mobile)) {
            throw new \InvalidArgumentException('non-nullable phone_number_mobile cannot be null');
        }
        if ((mb_strlen($phone_number_mobile) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_mobile when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['phone_number_mobile'] = $phone_number_mobile;

        return $this;
    }

    /**
     * Gets phone_number_home
     *
     * @return string|null
     */
    public function getPhoneNumberHome()
    {
        return $this->container['phone_number_home'];
    }

    /**
     * Sets phone_number_home
     *
     * @param string|null $phone_number_home phone_number_home
     *
     * @return self
     */
    public function setPhoneNumberHome($phone_number_home)
    {
        if (is_null($phone_number_home)) {
            throw new \InvalidArgumentException('non-nullable phone_number_home cannot be null');
        }
        if ((mb_strlen($phone_number_home) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_home when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['phone_number_home'] = $phone_number_home;

        return $this;
    }

    /**
     * Gets phone_number_work
     *
     * @return string|null
     */
    public function getPhoneNumberWork()
    {
        return $this->container['phone_number_work'];
    }

    /**
     * Sets phone_number_work
     *
     * @param string|null $phone_number_work phone_number_work
     *
     * @return self
     */
    public function setPhoneNumberWork($phone_number_work)
    {
        if (is_null($phone_number_work)) {
            throw new \InvalidArgumentException('non-nullable phone_number_work cannot be null');
        }
        if ((mb_strlen($phone_number_work) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_work when calling SalesForceEmployee., must be smaller than or equal to 100.');
        }

        $this->container['phone_number_work'] = $phone_number_work;

        return $this;
    }

    /**
     * Gets user_id
     *
     * @return int|null
     */
    public function getUserId()
    {
        return $this->container['user_id'];
    }

    /**
     * Sets user_id
     *
     * @param int|null $user_id user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        if (is_null($user_id)) {
            throw new \InvalidArgumentException('non-nullable user_id cannot be null');
        }
        $this->container['user_id'] = $user_id;

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
     * Gets phone_number_sms_certified
     *
     * @return string|null
     */
    public function getPhoneNumberSmsCertified()
    {
        return $this->container['phone_number_sms_certified'];
    }

    /**
     * Sets phone_number_sms_certified
     *
     * @param string|null $phone_number_sms_certified phone_number_sms_certified
     *
     * @return self
     */
    public function setPhoneNumberSmsCertified($phone_number_sms_certified)
    {
        if (is_null($phone_number_sms_certified)) {
            throw new \InvalidArgumentException('non-nullable phone_number_sms_certified cannot be null');
        }
        $this->container['phone_number_sms_certified'] = $phone_number_sms_certified;

        return $this;
    }

    /**
     * Gets is_user_administrator
     *
     * @return bool|null
     */
    public function getIsUserAdministrator()
    {
        return $this->container['is_user_administrator'];
    }

    /**
     * Sets is_user_administrator
     *
     * @param bool|null $is_user_administrator is_user_administrator
     *
     * @return self
     */
    public function setIsUserAdministrator($is_user_administrator)
    {
        if (is_null($is_user_administrator)) {
            throw new \InvalidArgumentException('non-nullable is_user_administrator cannot be null');
        }
        $this->container['is_user_administrator'] = $is_user_administrator;

        return $this;
    }

    /**
     * Gets is_account_administrator
     *
     * @return bool|null
     */
    public function getIsAccountAdministrator()
    {
        return $this->container['is_account_administrator'];
    }

    /**
     * Sets is_account_administrator
     *
     * @param bool|null $is_account_administrator is_account_administrator
     *
     * @return self
     */
    public function setIsAccountAdministrator($is_account_administrator)
    {
        if (is_null($is_account_administrator)) {
            throw new \InvalidArgumentException('non-nullable is_account_administrator cannot be null');
        }
        $this->container['is_account_administrator'] = $is_account_administrator;

        return $this;
    }

    /**
     * Gets allow_login
     *
     * @return bool|null
     */
    public function getAllowLogin()
    {
        return $this->container['allow_login'];
    }

    /**
     * Sets allow_login
     *
     * @param bool|null $allow_login allow_login
     *
     * @return self
     */
    public function setAllowLogin($allow_login)
    {
        if (is_null($allow_login)) {
            throw new \InvalidArgumentException('non-nullable allow_login cannot be null');
        }
        $this->container['allow_login'] = $allow_login;

        return $this;
    }

    /**
     * Gets is_external
     *
     * @return bool|null
     */
    public function getIsExternal()
    {
        return $this->container['is_external'];
    }

    /**
     * Sets is_external
     *
     * @param bool|null $is_external is_external
     *
     * @return self
     */
    public function setIsExternal($is_external)
    {
        if (is_null($is_external)) {
            throw new \InvalidArgumentException('non-nullable is_external cannot be null');
        }
        $this->container['is_external'] = $is_external;

        return $this;
    }

    /**
     * Gets is_tripletex_certified
     *
     * @return bool|null
     */
    public function getIsTripletexCertified()
    {
        return $this->container['is_tripletex_certified'];
    }

    /**
     * Sets is_tripletex_certified
     *
     * @param bool|null $is_tripletex_certified is_tripletex_certified
     *
     * @return self
     */
    public function setIsTripletexCertified($is_tripletex_certified)
    {
        if (is_null($is_tripletex_certified)) {
            throw new \InvalidArgumentException('non-nullable is_tripletex_certified cannot be null');
        }
        $this->container['is_tripletex_certified'] = $is_tripletex_certified;

        return $this;
    }

    /**
     * Gets is_default_login
     *
     * @return bool|null
     */
    public function getIsDefaultLogin()
    {
        return $this->container['is_default_login'];
    }

    /**
     * Sets is_default_login
     *
     * @param bool|null $is_default_login is_default_login
     *
     * @return self
     */
    public function setIsDefaultLogin($is_default_login)
    {
        if (is_null($is_default_login)) {
            throw new \InvalidArgumentException('non-nullable is_default_login cannot be null');
        }
        $this->container['is_default_login'] = $is_default_login;

        return $this;
    }

    /**
     * Gets login_end_date
     *
     * @return string|null
     */
    public function getLoginEndDate()
    {
        return $this->container['login_end_date'];
    }

    /**
     * Sets login_end_date
     *
     * @param string|null $login_end_date Login end date
     *
     * @return self
     */
    public function setLoginEndDate($login_end_date)
    {
        if (is_null($login_end_date)) {
            throw new \InvalidArgumentException('non-nullable login_end_date cannot be null');
        }
        $this->container['login_end_date'] = $login_end_date;

        return $this;
    }

    /**
     * Gets address
     *
     * @return \Learnist\Tripletex\Model\SalesForceAddress|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \Learnist\Tripletex\Model\SalesForceAddress|null $address address
     *
     * @return self
     */
    public function setAddress($address)
    {
        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets is_marketing_consent
     *
     * @return bool|null
     */
    public function getIsMarketingConsent()
    {
        return $this->container['is_marketing_consent'];
    }

    /**
     * Sets is_marketing_consent
     *
     * @param bool|null $is_marketing_consent is_marketing_consent
     *
     * @return self
     */
    public function setIsMarketingConsent($is_marketing_consent)
    {
        if (is_null($is_marketing_consent)) {
            throw new \InvalidArgumentException('non-nullable is_marketing_consent cannot be null');
        }
        $this->container['is_marketing_consent'] = $is_marketing_consent;

        return $this;
    }

    /**
     * Gets is_app_user
     *
     * @return bool|null
     */
    public function getIsAppUser()
    {
        return $this->container['is_app_user'];
    }

    /**
     * Sets is_app_user
     *
     * @param bool|null $is_app_user is_app_user
     *
     * @return self
     */
    public function setIsAppUser($is_app_user)
    {
        if (is_null($is_app_user)) {
            throw new \InvalidArgumentException('non-nullable is_app_user cannot be null');
        }
        $this->container['is_app_user'] = $is_app_user;

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


