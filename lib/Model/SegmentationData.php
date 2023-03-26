<?php
/**
 * SegmentationData
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
 * SegmentationData Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SegmentationData implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SegmentationData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'pilot_features' => 'map[string,bool]',
'hacked_or_support_access' => 'bool',
'tripletex_customer_category_id3' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'tripletex_customer_category_id3' => 'int32'    ];

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
'tripletex_customer_category_id3' => 'tripletexCustomerCategoryId3'    ];

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
'tripletex_customer_category_id3' => 'setTripletexCustomerCategoryId3'    ];

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
'tripletex_customer_category_id3' => 'getTripletexCustomerCategoryId3'    ];

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
        $this->container['context_id'] = isset($data['context_id']) ? $data['context_id'] : null;
        $this->container['org_number'] = isset($data['org_number']) ? $data['org_number'] : null;
        $this->container['is_trial_account'] = isset($data['is_trial_account']) ? $data['is_trial_account'] : null;
        $this->container['is_test_or_free_company'] = isset($data['is_test_or_free_company']) ? $data['is_test_or_free_company'] : null;
        $this->container['employee_id'] = isset($data['employee_id']) ? $data['employee_id'] : null;
        $this->container['is_accountant'] = isset($data['is_accountant']) ? $data['is_accountant'] : null;
        $this->container['is_reseller'] = isset($data['is_reseller']) ? $data['is_reseller'] : null;
        $this->container['employee_number'] = isset($data['employee_number']) ? $data['employee_number'] : null;
        $this->container['package_name'] = isset($data['package_name']) ? $data['package_name'] : null;
        $this->container['industry'] = isset($data['industry']) ? $data['industry'] : null;
        $this->container['outgoing_invoices'] = isset($data['outgoing_invoices']) ? $data['outgoing_invoices'] : null;
        $this->container['incoming_invoices'] = isset($data['incoming_invoices']) ? $data['incoming_invoices'] : null;
        $this->container['company_start_date_year'] = isset($data['company_start_date_year']) ? $data['company_start_date_year'] : null;
        $this->container['company_type'] = isset($data['company_type']) ? $data['company_type'] : null;
        $this->container['company_name'] = isset($data['company_name']) ? $data['company_name'] : null;
        $this->container['main_account_bank'] = isset($data['main_account_bank']) ? $data['main_account_bank'] : null;
        $this->container['modules'] = isset($data['modules']) ? $data['modules'] : null;
        $this->container['roles'] = isset($data['roles']) ? $data['roles'] : null;
        $this->container['pilot_features'] = isset($data['pilot_features']) ? $data['pilot_features'] : null;
        $this->container['hacked_or_support_access'] = isset($data['hacked_or_support_access']) ? $data['hacked_or_support_access'] : null;
        $this->container['tripletex_customer_category_id3'] = isset($data['tripletex_customer_category_id3']) ? $data['tripletex_customer_category_id3'] : null;
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
     * @return int
     */
    public function getContextId()
    {
        return $this->container['context_id'];
    }

    /**
     * Sets context_id
     *
     * @param int $context_id context_id
     *
     * @return $this
     */
    public function setContextId($context_id)
    {
        $this->container['context_id'] = $context_id;

        return $this;
    }

    /**
     * Gets org_number
     *
     * @return string
     */
    public function getOrgNumber()
    {
        return $this->container['org_number'];
    }

    /**
     * Sets org_number
     *
     * @param string $org_number org_number
     *
     * @return $this
     */
    public function setOrgNumber($org_number)
    {
        $this->container['org_number'] = $org_number;

        return $this;
    }

    /**
     * Gets is_trial_account
     *
     * @return bool
     */
    public function getIsTrialAccount()
    {
        return $this->container['is_trial_account'];
    }

    /**
     * Sets is_trial_account
     *
     * @param bool $is_trial_account is_trial_account
     *
     * @return $this
     */
    public function setIsTrialAccount($is_trial_account)
    {
        $this->container['is_trial_account'] = $is_trial_account;

        return $this;
    }

    /**
     * Gets is_test_or_free_company
     *
     * @return bool
     */
    public function getIsTestOrFreeCompany()
    {
        return $this->container['is_test_or_free_company'];
    }

    /**
     * Sets is_test_or_free_company
     *
     * @param bool $is_test_or_free_company is_test_or_free_company
     *
     * @return $this
     */
    public function setIsTestOrFreeCompany($is_test_or_free_company)
    {
        $this->container['is_test_or_free_company'] = $is_test_or_free_company;

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
     * Gets is_accountant
     *
     * @return bool
     */
    public function getIsAccountant()
    {
        return $this->container['is_accountant'];
    }

    /**
     * Sets is_accountant
     *
     * @param bool $is_accountant is_accountant
     *
     * @return $this
     */
    public function setIsAccountant($is_accountant)
    {
        $this->container['is_accountant'] = $is_accountant;

        return $this;
    }

    /**
     * Gets is_reseller
     *
     * @return bool
     */
    public function getIsReseller()
    {
        return $this->container['is_reseller'];
    }

    /**
     * Sets is_reseller
     *
     * @param bool $is_reseller is_reseller
     *
     * @return $this
     */
    public function setIsReseller($is_reseller)
    {
        $this->container['is_reseller'] = $is_reseller;

        return $this;
    }

    /**
     * Gets employee_number
     *
     * @return int
     */
    public function getEmployeeNumber()
    {
        return $this->container['employee_number'];
    }

    /**
     * Sets employee_number
     *
     * @param int $employee_number employee_number
     *
     * @return $this
     */
    public function setEmployeeNumber($employee_number)
    {
        $this->container['employee_number'] = $employee_number;

        return $this;
    }

    /**
     * Gets package_name
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->container['package_name'];
    }

    /**
     * Sets package_name
     *
     * @param string $package_name package_name
     *
     * @return $this
     */
    public function setPackageName($package_name)
    {
        $this->container['package_name'] = $package_name;

        return $this;
    }

    /**
     * Gets industry
     *
     * @return string
     */
    public function getIndustry()
    {
        return $this->container['industry'];
    }

    /**
     * Sets industry
     *
     * @param string $industry industry
     *
     * @return $this
     */
    public function setIndustry($industry)
    {
        $this->container['industry'] = $industry;

        return $this;
    }

    /**
     * Gets outgoing_invoices
     *
     * @return int
     */
    public function getOutgoingInvoices()
    {
        return $this->container['outgoing_invoices'];
    }

    /**
     * Sets outgoing_invoices
     *
     * @param int $outgoing_invoices outgoing_invoices
     *
     * @return $this
     */
    public function setOutgoingInvoices($outgoing_invoices)
    {
        $this->container['outgoing_invoices'] = $outgoing_invoices;

        return $this;
    }

    /**
     * Gets incoming_invoices
     *
     * @return int
     */
    public function getIncomingInvoices()
    {
        return $this->container['incoming_invoices'];
    }

    /**
     * Sets incoming_invoices
     *
     * @param int $incoming_invoices incoming_invoices
     *
     * @return $this
     */
    public function setIncomingInvoices($incoming_invoices)
    {
        $this->container['incoming_invoices'] = $incoming_invoices;

        return $this;
    }

    /**
     * Gets company_start_date_year
     *
     * @return string
     */
    public function getCompanyStartDateYear()
    {
        return $this->container['company_start_date_year'];
    }

    /**
     * Sets company_start_date_year
     *
     * @param string $company_start_date_year company_start_date_year
     *
     * @return $this
     */
    public function setCompanyStartDateYear($company_start_date_year)
    {
        $this->container['company_start_date_year'] = $company_start_date_year;

        return $this;
    }

    /**
     * Gets company_type
     *
     * @return string
     */
    public function getCompanyType()
    {
        return $this->container['company_type'];
    }

    /**
     * Sets company_type
     *
     * @param string $company_type company_type
     *
     * @return $this
     */
    public function setCompanyType($company_type)
    {
        $this->container['company_type'] = $company_type;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string $company_name company_name
     *
     * @return $this
     */
    public function setCompanyName($company_name)
    {
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets main_account_bank
     *
     * @return string
     */
    public function getMainAccountBank()
    {
        return $this->container['main_account_bank'];
    }

    /**
     * Sets main_account_bank
     *
     * @param string $main_account_bank main_account_bank
     *
     * @return $this
     */
    public function setMainAccountBank($main_account_bank)
    {
        $this->container['main_account_bank'] = $main_account_bank;

        return $this;
    }

    /**
     * Gets modules
     *
     * @return \Learnist\Tripletex\Model\SegmentationModules
     */
    public function getModules()
    {
        return $this->container['modules'];
    }

    /**
     * Sets modules
     *
     * @param \Learnist\Tripletex\Model\SegmentationModules $modules modules
     *
     * @return $this
     */
    public function setModules($modules)
    {
        $this->container['modules'] = $modules;

        return $this;
    }

    /**
     * Gets roles
     *
     * @return \Learnist\Tripletex\Model\SegmentationRoles
     */
    public function getRoles()
    {
        return $this->container['roles'];
    }

    /**
     * Sets roles
     *
     * @param \Learnist\Tripletex\Model\SegmentationRoles $roles roles
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->container['roles'] = $roles;

        return $this;
    }

    /**
     * Gets pilot_features
     *
     * @return map[string,bool]
     */
    public function getPilotFeatures()
    {
        return $this->container['pilot_features'];
    }

    /**
     * Sets pilot_features
     *
     * @param map[string,bool] $pilot_features pilot_features
     *
     * @return $this
     */
    public function setPilotFeatures($pilot_features)
    {
        $this->container['pilot_features'] = $pilot_features;

        return $this;
    }

    /**
     * Gets hacked_or_support_access
     *
     * @return bool
     */
    public function getHackedOrSupportAccess()
    {
        return $this->container['hacked_or_support_access'];
    }

    /**
     * Sets hacked_or_support_access
     *
     * @param bool $hacked_or_support_access hacked_or_support_access
     *
     * @return $this
     */
    public function setHackedOrSupportAccess($hacked_or_support_access)
    {
        $this->container['hacked_or_support_access'] = $hacked_or_support_access;

        return $this;
    }

    /**
     * Gets tripletex_customer_category_id3
     *
     * @return int
     */
    public function getTripletexCustomerCategoryId3()
    {
        return $this->container['tripletex_customer_category_id3'];
    }

    /**
     * Sets tripletex_customer_category_id3
     *
     * @param int $tripletex_customer_category_id3 tripletex_customer_category_id3
     *
     * @return $this
     */
    public function setTripletexCustomerCategoryId3($tripletex_customer_category_id3)
    {
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
