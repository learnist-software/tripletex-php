<?php
/**
 * AutopayBankAgreement
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
 * AutopayBankAgreement Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AutopayBankAgreement implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AutopayBankAgreement';

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
        'iban' => 'string',
        'bban' => 'string',
        'description' => 'string',
        'display_name' => 'string',
        'account' => '\Learnist\Tripletex\Model\Account',
        'uploader_employee' => '\Learnist\Tripletex\Model\Employee',
        'date_created' => 'string',
        'bank' => '\Learnist\Tripletex\Model\Bank',
        'country' => '\Learnist\Tripletex\Model\Country',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'is_active' => 'bool',
        'balance' => '\Learnist\Tripletex\Model\BankStatementBalance',
        'account_in_bank_id' => 'string',
        'division' => 'string',
        'ccm_agreement_id' => 'string',
        'organisation_number' => 'string',
        'approve_in_online_banking' => 'bool',
        'active' => 'bool'
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
        'iban' => null,
        'bban' => null,
        'description' => null,
        'display_name' => null,
        'account' => null,
        'uploader_employee' => null,
        'date_created' => null,
        'bank' => null,
        'country' => null,
        'currency' => null,
        'is_active' => null,
        'balance' => null,
        'account_in_bank_id' => null,
        'division' => null,
        'ccm_agreement_id' => null,
        'organisation_number' => null,
        'approve_in_online_banking' => null,
        'active' => null
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
		'iban' => false,
		'bban' => false,
		'description' => false,
		'display_name' => false,
		'account' => false,
		'uploader_employee' => false,
		'date_created' => false,
		'bank' => false,
		'country' => false,
		'currency' => false,
		'is_active' => false,
		'balance' => false,
		'account_in_bank_id' => false,
		'division' => false,
		'ccm_agreement_id' => false,
		'organisation_number' => false,
		'approve_in_online_banking' => false,
		'active' => false
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
        'iban' => 'iban',
        'bban' => 'bban',
        'description' => 'description',
        'display_name' => 'displayName',
        'account' => 'account',
        'uploader_employee' => 'uploaderEmployee',
        'date_created' => 'dateCreated',
        'bank' => 'bank',
        'country' => 'country',
        'currency' => 'currency',
        'is_active' => 'isActive',
        'balance' => 'balance',
        'account_in_bank_id' => 'accountInBankId',
        'division' => 'division',
        'ccm_agreement_id' => 'ccmAgreementId',
        'organisation_number' => 'organisationNumber',
        'approve_in_online_banking' => 'approveInOnlineBanking',
        'active' => 'active'
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
        'iban' => 'setIban',
        'bban' => 'setBban',
        'description' => 'setDescription',
        'display_name' => 'setDisplayName',
        'account' => 'setAccount',
        'uploader_employee' => 'setUploaderEmployee',
        'date_created' => 'setDateCreated',
        'bank' => 'setBank',
        'country' => 'setCountry',
        'currency' => 'setCurrency',
        'is_active' => 'setIsActive',
        'balance' => 'setBalance',
        'account_in_bank_id' => 'setAccountInBankId',
        'division' => 'setDivision',
        'ccm_agreement_id' => 'setCcmAgreementId',
        'organisation_number' => 'setOrganisationNumber',
        'approve_in_online_banking' => 'setApproveInOnlineBanking',
        'active' => 'setActive'
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
        'iban' => 'getIban',
        'bban' => 'getBban',
        'description' => 'getDescription',
        'display_name' => 'getDisplayName',
        'account' => 'getAccount',
        'uploader_employee' => 'getUploaderEmployee',
        'date_created' => 'getDateCreated',
        'bank' => 'getBank',
        'country' => 'getCountry',
        'currency' => 'getCurrency',
        'is_active' => 'getIsActive',
        'balance' => 'getBalance',
        'account_in_bank_id' => 'getAccountInBankId',
        'division' => 'getDivision',
        'ccm_agreement_id' => 'getCcmAgreementId',
        'organisation_number' => 'getOrganisationNumber',
        'approve_in_online_banking' => 'getApproveInOnlineBanking',
        'active' => 'getActive'
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
        $this->setIfExists('iban', $data ?? [], null);
        $this->setIfExists('bban', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('account', $data ?? [], null);
        $this->setIfExists('uploader_employee', $data ?? [], null);
        $this->setIfExists('date_created', $data ?? [], null);
        $this->setIfExists('bank', $data ?? [], null);
        $this->setIfExists('country', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('is_active', $data ?? [], null);
        $this->setIfExists('balance', $data ?? [], null);
        $this->setIfExists('account_in_bank_id', $data ?? [], null);
        $this->setIfExists('division', $data ?? [], null);
        $this->setIfExists('ccm_agreement_id', $data ?? [], null);
        $this->setIfExists('organisation_number', $data ?? [], null);
        $this->setIfExists('approve_in_online_banking', $data ?? [], null);
        $this->setIfExists('active', $data ?? [], null);
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

        if (!is_null($this->container['iban']) && (mb_strlen($this->container['iban']) > 50)) {
            $invalidProperties[] = "invalid value for 'iban', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['bban']) && (mb_strlen($this->container['bban']) > 50)) {
            $invalidProperties[] = "invalid value for 'bban', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['description']) && (mb_strlen($this->container['description']) > 250)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 250.";
        }

        if (!is_null($this->container['account_in_bank_id']) && (mb_strlen($this->container['account_in_bank_id']) > 50)) {
            $invalidProperties[] = "invalid value for 'account_in_bank_id', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['division']) && (mb_strlen($this->container['division']) > 50)) {
            $invalidProperties[] = "invalid value for 'division', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['ccm_agreement_id']) && (mb_strlen($this->container['ccm_agreement_id']) > 50)) {
            $invalidProperties[] = "invalid value for 'ccm_agreement_id', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['organisation_number']) && (mb_strlen($this->container['organisation_number']) > 50)) {
            $invalidProperties[] = "invalid value for 'organisation_number', the character length must be smaller than or equal to 50.";
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
     * Gets iban
     *
     * @return string|null
     */
    public function getIban()
    {
        return $this->container['iban'];
    }

    /**
     * Sets iban
     *
     * @param string|null $iban The IBAN property.
     *
     * @return self
     */
    public function setIban($iban)
    {
        if (is_null($iban)) {
            throw new \InvalidArgumentException('non-nullable iban cannot be null');
        }
        if ((mb_strlen($iban) > 50)) {
            throw new \InvalidArgumentException('invalid length for $iban when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['iban'] = $iban;

        return $this;
    }

    /**
     * Gets bban
     *
     * @return string|null
     */
    public function getBban()
    {
        return $this->container['bban'];
    }

    /**
     * Sets bban
     *
     * @param string|null $bban The BBAN property.
     *
     * @return self
     */
    public function setBban($bban)
    {
        if (is_null($bban)) {
            throw new \InvalidArgumentException('non-nullable bban cannot be null');
        }
        if ((mb_strlen($bban) > 50)) {
            throw new \InvalidArgumentException('invalid length for $bban when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['bban'] = $bban;

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
     * @param string|null $description The description property.
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        if ((mb_strlen($description) > 250)) {
            throw new \InvalidArgumentException('invalid length for $description when calling AutopayBankAgreement., must be smaller than or equal to 250.');
        }

        $this->container['description'] = $description;

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
     * @param string|null $display_name display name needed for LoadableDropdown component
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
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account|null $account account
     *
     * @return self
     */
    public function setAccount($account)
    {
        if (is_null($account)) {
            throw new \InvalidArgumentException('non-nullable account cannot be null');
        }
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets uploader_employee
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getUploaderEmployee()
    {
        return $this->container['uploader_employee'];
    }

    /**
     * Sets uploader_employee
     *
     * @param \Learnist\Tripletex\Model\Employee|null $uploader_employee uploader_employee
     *
     * @return self
     */
    public function setUploaderEmployee($uploader_employee)
    {
        if (is_null($uploader_employee)) {
            throw new \InvalidArgumentException('non-nullable uploader_employee cannot be null');
        }
        $this->container['uploader_employee'] = $uploader_employee;

        return $this;
    }

    /**
     * Gets date_created
     *
     * @return string|null
     */
    public function getDateCreated()
    {
        return $this->container['date_created'];
    }

    /**
     * Sets date_created
     *
     * @param string|null $date_created date_created
     *
     * @return self
     */
    public function setDateCreated($date_created)
    {
        if (is_null($date_created)) {
            throw new \InvalidArgumentException('non-nullable date_created cannot be null');
        }
        $this->container['date_created'] = $date_created;

        return $this;
    }

    /**
     * Gets bank
     *
     * @return \Learnist\Tripletex\Model\Bank|null
     */
    public function getBank()
    {
        return $this->container['bank'];
    }

    /**
     * Sets bank
     *
     * @param \Learnist\Tripletex\Model\Bank|null $bank bank
     *
     * @return self
     */
    public function setBank($bank)
    {
        if (is_null($bank)) {
            throw new \InvalidArgumentException('non-nullable bank cannot be null');
        }
        $this->container['bank'] = $bank;

        return $this;
    }

    /**
     * Gets country
     *
     * @return \Learnist\Tripletex\Model\Country|null
     */
    public function getCountry()
    {
        return $this->container['country'];
    }

    /**
     * Sets country
     *
     * @param \Learnist\Tripletex\Model\Country|null $country country
     *
     * @return self
     */
    public function setCountry($country)
    {
        if (is_null($country)) {
            throw new \InvalidArgumentException('non-nullable country cannot be null');
        }
        $this->container['country'] = $country;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets is_active
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->container['is_active'];
    }

    /**
     * Sets is_active
     *
     * @param bool|null $is_active is_active
     *
     * @return self
     */
    public function setIsActive($is_active)
    {
        if (is_null($is_active)) {
            throw new \InvalidArgumentException('non-nullable is_active cannot be null');
        }
        $this->container['is_active'] = $is_active;

        return $this;
    }

    /**
     * Gets balance
     *
     * @return \Learnist\Tripletex\Model\BankStatementBalance|null
     */
    public function getBalance()
    {
        return $this->container['balance'];
    }

    /**
     * Sets balance
     *
     * @param \Learnist\Tripletex\Model\BankStatementBalance|null $balance balance
     *
     * @return self
     */
    public function setBalance($balance)
    {
        if (is_null($balance)) {
            throw new \InvalidArgumentException('non-nullable balance cannot be null');
        }
        $this->container['balance'] = $balance;

        return $this;
    }

    /**
     * Gets account_in_bank_id
     *
     * @return string|null
     */
    public function getAccountInBankId()
    {
        return $this->container['account_in_bank_id'];
    }

    /**
     * Sets account_in_bank_id
     *
     * @param string|null $account_in_bank_id account_in_bank_id
     *
     * @return self
     */
    public function setAccountInBankId($account_in_bank_id)
    {
        if (is_null($account_in_bank_id)) {
            throw new \InvalidArgumentException('non-nullable account_in_bank_id cannot be null');
        }
        if ((mb_strlen($account_in_bank_id) > 50)) {
            throw new \InvalidArgumentException('invalid length for $account_in_bank_id when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['account_in_bank_id'] = $account_in_bank_id;

        return $this;
    }

    /**
     * Gets division
     *
     * @return string|null
     */
    public function getDivision()
    {
        return $this->container['division'];
    }

    /**
     * Sets division
     *
     * @param string|null $division division
     *
     * @return self
     */
    public function setDivision($division)
    {
        if (is_null($division)) {
            throw new \InvalidArgumentException('non-nullable division cannot be null');
        }
        if ((mb_strlen($division) > 50)) {
            throw new \InvalidArgumentException('invalid length for $division when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['division'] = $division;

        return $this;
    }

    /**
     * Gets ccm_agreement_id
     *
     * @return string|null
     */
    public function getCcmAgreementId()
    {
        return $this->container['ccm_agreement_id'];
    }

    /**
     * Sets ccm_agreement_id
     *
     * @param string|null $ccm_agreement_id ccm_agreement_id
     *
     * @return self
     */
    public function setCcmAgreementId($ccm_agreement_id)
    {
        if (is_null($ccm_agreement_id)) {
            throw new \InvalidArgumentException('non-nullable ccm_agreement_id cannot be null');
        }
        if ((mb_strlen($ccm_agreement_id) > 50)) {
            throw new \InvalidArgumentException('invalid length for $ccm_agreement_id when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['ccm_agreement_id'] = $ccm_agreement_id;

        return $this;
    }

    /**
     * Gets organisation_number
     *
     * @return string|null
     */
    public function getOrganisationNumber()
    {
        return $this->container['organisation_number'];
    }

    /**
     * Sets organisation_number
     *
     * @param string|null $organisation_number organisation_number
     *
     * @return self
     */
    public function setOrganisationNumber($organisation_number)
    {
        if (is_null($organisation_number)) {
            throw new \InvalidArgumentException('non-nullable organisation_number cannot be null');
        }
        if ((mb_strlen($organisation_number) > 50)) {
            throw new \InvalidArgumentException('invalid length for $organisation_number when calling AutopayBankAgreement., must be smaller than or equal to 50.');
        }

        $this->container['organisation_number'] = $organisation_number;

        return $this;
    }

    /**
     * Gets approve_in_online_banking
     *
     * @return bool|null
     */
    public function getApproveInOnlineBanking()
    {
        return $this->container['approve_in_online_banking'];
    }

    /**
     * Sets approve_in_online_banking
     *
     * @param bool|null $approve_in_online_banking approve_in_online_banking
     *
     * @return self
     */
    public function setApproveInOnlineBanking($approve_in_online_banking)
    {
        if (is_null($approve_in_online_banking)) {
            throw new \InvalidArgumentException('non-nullable approve_in_online_banking cannot be null');
        }
        $this->container['approve_in_online_banking'] = $approve_in_online_banking;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active active
     *
     * @return self
     */
    public function setActive($active)
    {
        if (is_null($active)) {
            throw new \InvalidArgumentException('non-nullable active cannot be null');
        }
        $this->container['active'] = $active;

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


