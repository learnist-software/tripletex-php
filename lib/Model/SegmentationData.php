<?php
/**
 * SegmentationData
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
 * SegmentationData Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SegmentationData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SegmentationData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'context_id' => 'int',
        'org_number' => 'string',
        'is_trial_account' => 'bool',
        'is_test_or_free_company' => 'bool',
        'employee_id' => 'int',
        'is_accountant' => 'bool',
        'is_reseller' => 'bool',
        'employee_number' => 'int',
        'package_name' => 'string',
        'industry' => 'string',
        'outgoing_invoices' => 'int',
        'incoming_invoices' => 'int',
        'company_start_date_year' => 'string',
        'company_type' => 'string',
        'company_name' => 'string',
        'main_account_bank' => 'string',
        'modules' => '\Learnist\Tripletex\Model\SegmentationModules',
        'roles' => '\Learnist\Tripletex\Model\SegmentationRoles',
        'pilot_features' => 'array<string,bool>',
        'hacked_or_support_access' => 'bool',
        'tripletex_customer_category_id3' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'context_id' => 'int32',
        'org_number' => null,
        'is_trial_account' => null,
        'is_test_or_free_company' => null,
        'employee_id' => 'int32',
        'is_accountant' => null,
        'is_reseller' => null,
        'employee_number' => 'int32',
        'package_name' => null,
        'industry' => null,
        'outgoing_invoices' => 'int32',
        'incoming_invoices' => 'int32',
        'company_start_date_year' => null,
        'company_type' => null,
        'company_name' => null,
        'main_account_bank' => null,
        'modules' => null,
        'roles' => null,
        'pilot_features' => null,
        'hacked_or_support_access' => null,
        'tripletex_customer_category_id3' => 'int32'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'context_id' => false,
		'org_number' => false,
		'is_trial_account' => false,
		'is_test_or_free_company' => false,
		'employee_id' => false,
		'is_accountant' => false,
		'is_reseller' => false,
		'employee_number' => false,
		'package_name' => false,
		'industry' => false,
		'outgoing_invoices' => false,
		'incoming_invoices' => false,
		'company_start_date_year' => false,
		'company_type' => false,
		'company_name' => false,
		'main_account_bank' => false,
		'modules' => false,
		'roles' => false,
		'pilot_features' => false,
		'hacked_or_support_access' => false,
		'tripletex_customer_category_id3' => false
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
        'context_id' => 'contextId',
        'org_number' => 'orgNumber',
        'is_trial_account' => 'isTrialAccount',
        'is_test_or_free_company' => 'isTestOrFreeCompany',
        'employee_id' => 'employeeId',
        'is_accountant' => 'isAccountant',
        'is_reseller' => 'isReseller',
        'employee_number' => 'employeeNumber',
        'package_name' => 'packageName',
        'industry' => 'industry',
        'outgoing_invoices' => 'outgoingInvoices',
        'incoming_invoices' => 'incomingInvoices',
        'company_start_date_year' => 'companyStartDateYear',
        'company_type' => 'companyType',
        'company_name' => 'companyName',
        'main_account_bank' => 'mainAccountBank',
        'modules' => 'modules',
        'roles' => 'roles',
        'pilot_features' => 'pilotFeatures',
        'hacked_or_support_access' => 'hackedOrSupportAccess',
        'tripletex_customer_category_id3' => 'tripletexCustomerCategoryId3'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'context_id' => 'setContextId',
        'org_number' => 'setOrgNumber',
        'is_trial_account' => 'setIsTrialAccount',
        'is_test_or_free_company' => 'setIsTestOrFreeCompany',
        'employee_id' => 'setEmployeeId',
        'is_accountant' => 'setIsAccountant',
        'is_reseller' => 'setIsReseller',
        'employee_number' => 'setEmployeeNumber',
        'package_name' => 'setPackageName',
        'industry' => 'setIndustry',
        'outgoing_invoices' => 'setOutgoingInvoices',
        'incoming_invoices' => 'setIncomingInvoices',
        'company_start_date_year' => 'setCompanyStartDateYear',
        'company_type' => 'setCompanyType',
        'company_name' => 'setCompanyName',
        'main_account_bank' => 'setMainAccountBank',
        'modules' => 'setModules',
        'roles' => 'setRoles',
        'pilot_features' => 'setPilotFeatures',
        'hacked_or_support_access' => 'setHackedOrSupportAccess',
        'tripletex_customer_category_id3' => 'setTripletexCustomerCategoryId3'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'context_id' => 'getContextId',
        'org_number' => 'getOrgNumber',
        'is_trial_account' => 'getIsTrialAccount',
        'is_test_or_free_company' => 'getIsTestOrFreeCompany',
        'employee_id' => 'getEmployeeId',
        'is_accountant' => 'getIsAccountant',
        'is_reseller' => 'getIsReseller',
        'employee_number' => 'getEmployeeNumber',
        'package_name' => 'getPackageName',
        'industry' => 'getIndustry',
        'outgoing_invoices' => 'getOutgoingInvoices',
        'incoming_invoices' => 'getIncomingInvoices',
        'company_start_date_year' => 'getCompanyStartDateYear',
        'company_type' => 'getCompanyType',
        'company_name' => 'getCompanyName',
        'main_account_bank' => 'getMainAccountBank',
        'modules' => 'getModules',
        'roles' => 'getRoles',
        'pilot_features' => 'getPilotFeatures',
        'hacked_or_support_access' => 'getHackedOrSupportAccess',
        'tripletex_customer_category_id3' => 'getTripletexCustomerCategoryId3'
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
        $this->setIfExists('context_id', $data ?? [], null);
        $this->setIfExists('org_number', $data ?? [], null);
        $this->setIfExists('is_trial_account', $data ?? [], null);
        $this->setIfExists('is_test_or_free_company', $data ?? [], null);
        $this->setIfExists('employee_id', $data ?? [], null);
        $this->setIfExists('is_accountant', $data ?? [], null);
        $this->setIfExists('is_reseller', $data ?? [], null);
        $this->setIfExists('employee_number', $data ?? [], null);
        $this->setIfExists('package_name', $data ?? [], null);
        $this->setIfExists('industry', $data ?? [], null);
        $this->setIfExists('outgoing_invoices', $data ?? [], null);
        $this->setIfExists('incoming_invoices', $data ?? [], null);
        $this->setIfExists('company_start_date_year', $data ?? [], null);
        $this->setIfExists('company_type', $data ?? [], null);
        $this->setIfExists('company_name', $data ?? [], null);
        $this->setIfExists('main_account_bank', $data ?? [], null);
        $this->setIfExists('modules', $data ?? [], null);
        $this->setIfExists('roles', $data ?? [], null);
        $this->setIfExists('pilot_features', $data ?? [], null);
        $this->setIfExists('hacked_or_support_access', $data ?? [], null);
        $this->setIfExists('tripletex_customer_category_id3', $data ?? [], null);
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
     * Gets context_id
     *
     * @return int|null
     */
    public function getContextId()
    {
        return $this->container['context_id'];
    }

    /**
     * Sets context_id
     *
     * @param int|null $context_id context_id
     *
     * @return self
     */
    public function setContextId($context_id)
    {

        if (is_null($context_id)) {
            throw new \InvalidArgumentException('non-nullable context_id cannot be null');
        }

        $this->container['context_id'] = $context_id;

        return $this;
    }

    /**
     * Gets org_number
     *
     * @return string|null
     */
    public function getOrgNumber()
    {
        return $this->container['org_number'];
    }

    /**
     * Sets org_number
     *
     * @param string|null $org_number org_number
     *
     * @return self
     */
    public function setOrgNumber($org_number)
    {

        if (is_null($org_number)) {
            throw new \InvalidArgumentException('non-nullable org_number cannot be null');
        }

        $this->container['org_number'] = $org_number;

        return $this;
    }

    /**
     * Gets is_trial_account
     *
     * @return bool|null
     */
    public function getIsTrialAccount()
    {
        return $this->container['is_trial_account'];
    }

    /**
     * Sets is_trial_account
     *
     * @param bool|null $is_trial_account is_trial_account
     *
     * @return self
     */
    public function setIsTrialAccount($is_trial_account)
    {

        if (is_null($is_trial_account)) {
            throw new \InvalidArgumentException('non-nullable is_trial_account cannot be null');
        }

        $this->container['is_trial_account'] = $is_trial_account;

        return $this;
    }

    /**
     * Gets is_test_or_free_company
     *
     * @return bool|null
     */
    public function getIsTestOrFreeCompany()
    {
        return $this->container['is_test_or_free_company'];
    }

    /**
     * Sets is_test_or_free_company
     *
     * @param bool|null $is_test_or_free_company is_test_or_free_company
     *
     * @return self
     */
    public function setIsTestOrFreeCompany($is_test_or_free_company)
    {

        if (is_null($is_test_or_free_company)) {
            throw new \InvalidArgumentException('non-nullable is_test_or_free_company cannot be null');
        }

        $this->container['is_test_or_free_company'] = $is_test_or_free_company;

        return $this;
    }

    /**
     * Gets employee_id
     *
     * @return int|null
     */
    public function getEmployeeId()
    {
        return $this->container['employee_id'];
    }

    /**
     * Sets employee_id
     *
     * @param int|null $employee_id employee_id
     *
     * @return self
     */
    public function setEmployeeId($employee_id)
    {

        if (is_null($employee_id)) {
            throw new \InvalidArgumentException('non-nullable employee_id cannot be null');
        }

        $this->container['employee_id'] = $employee_id;

        return $this;
    }

    /**
     * Gets is_accountant
     *
     * @return bool|null
     */
    public function getIsAccountant()
    {
        return $this->container['is_accountant'];
    }

    /**
     * Sets is_accountant
     *
     * @param bool|null $is_accountant is_accountant
     *
     * @return self
     */
    public function setIsAccountant($is_accountant)
    {

        if (is_null($is_accountant)) {
            throw new \InvalidArgumentException('non-nullable is_accountant cannot be null');
        }

        $this->container['is_accountant'] = $is_accountant;

        return $this;
    }

    /**
     * Gets is_reseller
     *
     * @return bool|null
     */
    public function getIsReseller()
    {
        return $this->container['is_reseller'];
    }

    /**
     * Sets is_reseller
     *
     * @param bool|null $is_reseller is_reseller
     *
     * @return self
     */
    public function setIsReseller($is_reseller)
    {

        if (is_null($is_reseller)) {
            throw new \InvalidArgumentException('non-nullable is_reseller cannot be null');
        }

        $this->container['is_reseller'] = $is_reseller;

        return $this;
    }

    /**
     * Gets employee_number
     *
     * @return int|null
     */
    public function getEmployeeNumber()
    {
        return $this->container['employee_number'];
    }

    /**
     * Sets employee_number
     *
     * @param int|null $employee_number employee_number
     *
     * @return self
     */
    public function setEmployeeNumber($employee_number)
    {

        if (is_null($employee_number)) {
            throw new \InvalidArgumentException('non-nullable employee_number cannot be null');
        }

        $this->container['employee_number'] = $employee_number;

        return $this;
    }

    /**
     * Gets package_name
     *
     * @return string|null
     */
    public function getPackageName()
    {
        return $this->container['package_name'];
    }

    /**
     * Sets package_name
     *
     * @param string|null $package_name package_name
     *
     * @return self
     */
    public function setPackageName($package_name)
    {

        if (is_null($package_name)) {
            throw new \InvalidArgumentException('non-nullable package_name cannot be null');
        }

        $this->container['package_name'] = $package_name;

        return $this;
    }

    /**
     * Gets industry
     *
     * @return string|null
     */
    public function getIndustry()
    {
        return $this->container['industry'];
    }

    /**
     * Sets industry
     *
     * @param string|null $industry industry
     *
     * @return self
     */
    public function setIndustry($industry)
    {

        if (is_null($industry)) {
            throw new \InvalidArgumentException('non-nullable industry cannot be null');
        }

        $this->container['industry'] = $industry;

        return $this;
    }

    /**
     * Gets outgoing_invoices
     *
     * @return int|null
     */
    public function getOutgoingInvoices()
    {
        return $this->container['outgoing_invoices'];
    }

    /**
     * Sets outgoing_invoices
     *
     * @param int|null $outgoing_invoices outgoing_invoices
     *
     * @return self
     */
    public function setOutgoingInvoices($outgoing_invoices)
    {

        if (is_null($outgoing_invoices)) {
            throw new \InvalidArgumentException('non-nullable outgoing_invoices cannot be null');
        }

        $this->container['outgoing_invoices'] = $outgoing_invoices;

        return $this;
    }

    /**
     * Gets incoming_invoices
     *
     * @return int|null
     */
    public function getIncomingInvoices()
    {
        return $this->container['incoming_invoices'];
    }

    /**
     * Sets incoming_invoices
     *
     * @param int|null $incoming_invoices incoming_invoices
     *
     * @return self
     */
    public function setIncomingInvoices($incoming_invoices)
    {

        if (is_null($incoming_invoices)) {
            throw new \InvalidArgumentException('non-nullable incoming_invoices cannot be null');
        }

        $this->container['incoming_invoices'] = $incoming_invoices;

        return $this;
    }

    /**
     * Gets company_start_date_year
     *
     * @return string|null
     */
    public function getCompanyStartDateYear()
    {
        return $this->container['company_start_date_year'];
    }

    /**
     * Sets company_start_date_year
     *
     * @param string|null $company_start_date_year company_start_date_year
     *
     * @return self
     */
    public function setCompanyStartDateYear($company_start_date_year)
    {

        if (is_null($company_start_date_year)) {
            throw new \InvalidArgumentException('non-nullable company_start_date_year cannot be null');
        }

        $this->container['company_start_date_year'] = $company_start_date_year;

        return $this;
    }

    /**
     * Gets company_type
     *
     * @return string|null
     */
    public function getCompanyType()
    {
        return $this->container['company_type'];
    }

    /**
     * Sets company_type
     *
     * @param string|null $company_type company_type
     *
     * @return self
     */
    public function setCompanyType($company_type)
    {

        if (is_null($company_type)) {
            throw new \InvalidArgumentException('non-nullable company_type cannot be null');
        }

        $this->container['company_type'] = $company_type;

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
     * Gets main_account_bank
     *
     * @return string|null
     */
    public function getMainAccountBank()
    {
        return $this->container['main_account_bank'];
    }

    /**
     * Sets main_account_bank
     *
     * @param string|null $main_account_bank main_account_bank
     *
     * @return self
     */
    public function setMainAccountBank($main_account_bank)
    {

        if (is_null($main_account_bank)) {
            throw new \InvalidArgumentException('non-nullable main_account_bank cannot be null');
        }

        $this->container['main_account_bank'] = $main_account_bank;

        return $this;
    }

    /**
     * Gets modules
     *
     * @return \Learnist\Tripletex\Model\SegmentationModules|null
     */
    public function getModules()
    {
        return $this->container['modules'];
    }

    /**
     * Sets modules
     *
     * @param \Learnist\Tripletex\Model\SegmentationModules|null $modules modules
     *
     * @return self
     */
    public function setModules($modules)
    {

        if (is_null($modules)) {
            throw new \InvalidArgumentException('non-nullable modules cannot be null');
        }

        $this->container['modules'] = $modules;

        return $this;
    }

    /**
     * Gets roles
     *
     * @return \Learnist\Tripletex\Model\SegmentationRoles|null
     */
    public function getRoles()
    {
        return $this->container['roles'];
    }

    /**
     * Sets roles
     *
     * @param \Learnist\Tripletex\Model\SegmentationRoles|null $roles roles
     *
     * @return self
     */
    public function setRoles($roles)
    {

        if (is_null($roles)) {
            throw new \InvalidArgumentException('non-nullable roles cannot be null');
        }

        $this->container['roles'] = $roles;

        return $this;
    }

    /**
     * Gets pilot_features
     *
     * @return array<string,bool>|null
     */
    public function getPilotFeatures()
    {
        return $this->container['pilot_features'];
    }

    /**
     * Sets pilot_features
     *
     * @param array<string,bool>|null $pilot_features pilot_features
     *
     * @return self
     */
    public function setPilotFeatures($pilot_features)
    {

        if (is_null($pilot_features)) {
            throw new \InvalidArgumentException('non-nullable pilot_features cannot be null');
        }

        $this->container['pilot_features'] = $pilot_features;

        return $this;
    }

    /**
     * Gets hacked_or_support_access
     *
     * @return bool|null
     */
    public function getHackedOrSupportAccess()
    {
        return $this->container['hacked_or_support_access'];
    }

    /**
     * Sets hacked_or_support_access
     *
     * @param bool|null $hacked_or_support_access hacked_or_support_access
     *
     * @return self
     */
    public function setHackedOrSupportAccess($hacked_or_support_access)
    {

        if (is_null($hacked_or_support_access)) {
            throw new \InvalidArgumentException('non-nullable hacked_or_support_access cannot be null');
        }

        $this->container['hacked_or_support_access'] = $hacked_or_support_access;

        return $this;
    }

    /**
     * Gets tripletex_customer_category_id3
     *
     * @return int|null
     */
    public function getTripletexCustomerCategoryId3()
    {
        return $this->container['tripletex_customer_category_id3'];
    }

    /**
     * Sets tripletex_customer_category_id3
     *
     * @param int|null $tripletex_customer_category_id3 tripletex_customer_category_id3
     *
     * @return self
     */
    public function setTripletexCustomerCategoryId3($tripletex_customer_category_id3)
    {

        if (is_null($tripletex_customer_category_id3)) {
            throw new \InvalidArgumentException('non-nullable tripletex_customer_category_id3 cannot be null');
        }

        $this->container['tripletex_customer_category_id3'] = $tripletex_customer_category_id3;

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


