<?php
/**
 * PersonalIncomeOverview
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
 * PersonalIncomeOverview Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PersonalIncomeOverview implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PersonalIncomeOverview';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
'income_group_id' => 'int',
'business_activity_type' => 'string',
'business_activity_description' => 'string',
'business_income' => 'float',
'business_income_after_shared_with_spouse' => 'float',
'corrected_business_income' => 'float',
'deductions_for_risk_free_return' => 'float',
'risk_free_return' => 'float',
'valid_basis_for_risk_free_return' => 'bool',
'personal_income_for_the_year' => 'float',
'after_shared_with_spouse' => 'float',
'calculated_personal_income_spouse' => 'float',
'calculated_business_income_spouse' => 'float',
'after_coordination' => 'float',
'sum_opening_balance_before_enterprise_debt' => 'float',
'sum_closing_balance_before_enterprise_debt' => 'float',
'sum_opening_balance_after_enterprise_debt' => 'float',
'sum_closing_balance_after_enterprise_debt' => 'float',
'basis_for_risk_free_return_ex_enterprise_debt' => 'float',
'basis_enterprise_debt' => 'float',
'basis_for_risk_free_return_inc_enterprise_debt' => 'float',
'balance_groups' => '\Learnist\Tripletex\Model\BalanceGroup[]',
'posts' => '\Learnist\Tripletex\Model\PersonalIncome[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'year_end_report' => null,
'income_group_id' => 'int32',
'business_activity_type' => null,
'business_activity_description' => null,
'business_income' => null,
'business_income_after_shared_with_spouse' => null,
'corrected_business_income' => null,
'deductions_for_risk_free_return' => null,
'risk_free_return' => null,
'valid_basis_for_risk_free_return' => null,
'personal_income_for_the_year' => null,
'after_shared_with_spouse' => null,
'calculated_personal_income_spouse' => null,
'calculated_business_income_spouse' => null,
'after_coordination' => null,
'sum_opening_balance_before_enterprise_debt' => null,
'sum_closing_balance_before_enterprise_debt' => null,
'sum_opening_balance_after_enterprise_debt' => null,
'sum_closing_balance_after_enterprise_debt' => null,
'basis_for_risk_free_return_ex_enterprise_debt' => null,
'basis_enterprise_debt' => null,
'basis_for_risk_free_return_inc_enterprise_debt' => null,
'balance_groups' => null,
'posts' => null    ];

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
        'year_end_report' => 'yearEndReport',
'income_group_id' => 'incomeGroupId',
'business_activity_type' => 'businessActivityType',
'business_activity_description' => 'businessActivityDescription',
'business_income' => 'businessIncome',
'business_income_after_shared_with_spouse' => 'businessIncomeAfterSharedWithSpouse',
'corrected_business_income' => 'correctedBusinessIncome',
'deductions_for_risk_free_return' => 'deductionsForRiskFreeReturn',
'risk_free_return' => 'riskFreeReturn',
'valid_basis_for_risk_free_return' => 'validBasisForRiskFreeReturn',
'personal_income_for_the_year' => 'personalIncomeForTheYear',
'after_shared_with_spouse' => 'afterSharedWithSpouse',
'calculated_personal_income_spouse' => 'calculatedPersonalIncomeSpouse',
'calculated_business_income_spouse' => 'calculatedBusinessIncomeSpouse',
'after_coordination' => 'afterCoordination',
'sum_opening_balance_before_enterprise_debt' => 'sumOpeningBalanceBeforeEnterpriseDebt',
'sum_closing_balance_before_enterprise_debt' => 'sumClosingBalanceBeforeEnterpriseDebt',
'sum_opening_balance_after_enterprise_debt' => 'sumOpeningBalanceAfterEnterpriseDebt',
'sum_closing_balance_after_enterprise_debt' => 'sumClosingBalanceAfterEnterpriseDebt',
'basis_for_risk_free_return_ex_enterprise_debt' => 'basisForRiskFreeReturnExEnterpriseDebt',
'basis_enterprise_debt' => 'basisEnterpriseDebt',
'basis_for_risk_free_return_inc_enterprise_debt' => 'basisForRiskFreeReturnIncEnterpriseDebt',
'balance_groups' => 'balanceGroups',
'posts' => 'posts'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
'income_group_id' => 'setIncomeGroupId',
'business_activity_type' => 'setBusinessActivityType',
'business_activity_description' => 'setBusinessActivityDescription',
'business_income' => 'setBusinessIncome',
'business_income_after_shared_with_spouse' => 'setBusinessIncomeAfterSharedWithSpouse',
'corrected_business_income' => 'setCorrectedBusinessIncome',
'deductions_for_risk_free_return' => 'setDeductionsForRiskFreeReturn',
'risk_free_return' => 'setRiskFreeReturn',
'valid_basis_for_risk_free_return' => 'setValidBasisForRiskFreeReturn',
'personal_income_for_the_year' => 'setPersonalIncomeForTheYear',
'after_shared_with_spouse' => 'setAfterSharedWithSpouse',
'calculated_personal_income_spouse' => 'setCalculatedPersonalIncomeSpouse',
'calculated_business_income_spouse' => 'setCalculatedBusinessIncomeSpouse',
'after_coordination' => 'setAfterCoordination',
'sum_opening_balance_before_enterprise_debt' => 'setSumOpeningBalanceBeforeEnterpriseDebt',
'sum_closing_balance_before_enterprise_debt' => 'setSumClosingBalanceBeforeEnterpriseDebt',
'sum_opening_balance_after_enterprise_debt' => 'setSumOpeningBalanceAfterEnterpriseDebt',
'sum_closing_balance_after_enterprise_debt' => 'setSumClosingBalanceAfterEnterpriseDebt',
'basis_for_risk_free_return_ex_enterprise_debt' => 'setBasisForRiskFreeReturnExEnterpriseDebt',
'basis_enterprise_debt' => 'setBasisEnterpriseDebt',
'basis_for_risk_free_return_inc_enterprise_debt' => 'setBasisForRiskFreeReturnIncEnterpriseDebt',
'balance_groups' => 'setBalanceGroups',
'posts' => 'setPosts'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
'income_group_id' => 'getIncomeGroupId',
'business_activity_type' => 'getBusinessActivityType',
'business_activity_description' => 'getBusinessActivityDescription',
'business_income' => 'getBusinessIncome',
'business_income_after_shared_with_spouse' => 'getBusinessIncomeAfterSharedWithSpouse',
'corrected_business_income' => 'getCorrectedBusinessIncome',
'deductions_for_risk_free_return' => 'getDeductionsForRiskFreeReturn',
'risk_free_return' => 'getRiskFreeReturn',
'valid_basis_for_risk_free_return' => 'getValidBasisForRiskFreeReturn',
'personal_income_for_the_year' => 'getPersonalIncomeForTheYear',
'after_shared_with_spouse' => 'getAfterSharedWithSpouse',
'calculated_personal_income_spouse' => 'getCalculatedPersonalIncomeSpouse',
'calculated_business_income_spouse' => 'getCalculatedBusinessIncomeSpouse',
'after_coordination' => 'getAfterCoordination',
'sum_opening_balance_before_enterprise_debt' => 'getSumOpeningBalanceBeforeEnterpriseDebt',
'sum_closing_balance_before_enterprise_debt' => 'getSumClosingBalanceBeforeEnterpriseDebt',
'sum_opening_balance_after_enterprise_debt' => 'getSumOpeningBalanceAfterEnterpriseDebt',
'sum_closing_balance_after_enterprise_debt' => 'getSumClosingBalanceAfterEnterpriseDebt',
'basis_for_risk_free_return_ex_enterprise_debt' => 'getBasisForRiskFreeReturnExEnterpriseDebt',
'basis_enterprise_debt' => 'getBasisEnterpriseDebt',
'basis_for_risk_free_return_inc_enterprise_debt' => 'getBasisForRiskFreeReturnIncEnterpriseDebt',
'balance_groups' => 'getBalanceGroups',
'posts' => 'getPosts'    ];

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

    const BUSINESS_ACTIVITY_TYPE_OTHER_COMMERCIAL_ACTIVITIES = 'OTHER_COMMERCIAL_ACTIVITIES';
const BUSINESS_ACTIVITY_TYPE_AGRICULTURE_HORTICULTURE_FUR_FARMING = 'AGRICULTURE_HORTICULTURE_FUR_FARMING';
const BUSINESS_ACTIVITY_TYPE_FISHING_AND_HUNTING_AT_SEA = 'FISHING_AND_HUNTING_AT_SEA';
const BUSINESS_ACTIVITY_TYPE_REINDEER_HUSBANDRY = 'REINDEER_HUSBANDRY';
const BUSINESS_ACTIVITY_TYPE_FAMILY_DAY_CARE_CENTRE_IN_OWN_HOME = 'FAMILY_DAY_CARE_CENTRE_IN_OWN_HOME';
const BUSINESS_ACTIVITY_TYPE_SLATE_QUARRYING = 'SLATE_QUARRYING';
const BUSINESS_ACTIVITY_TYPE_FORESTRY = 'FORESTRY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBusinessActivityTypeAllowableValues()
    {
        return [
            self::BUSINESS_ACTIVITY_TYPE_OTHER_COMMERCIAL_ACTIVITIES,
self::BUSINESS_ACTIVITY_TYPE_AGRICULTURE_HORTICULTURE_FUR_FARMING,
self::BUSINESS_ACTIVITY_TYPE_FISHING_AND_HUNTING_AT_SEA,
self::BUSINESS_ACTIVITY_TYPE_REINDEER_HUSBANDRY,
self::BUSINESS_ACTIVITY_TYPE_FAMILY_DAY_CARE_CENTRE_IN_OWN_HOME,
self::BUSINESS_ACTIVITY_TYPE_SLATE_QUARRYING,
self::BUSINESS_ACTIVITY_TYPE_FORESTRY,        ];
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
        $this->container['year_end_report'] = isset($data['year_end_report']) ? $data['year_end_report'] : null;
        $this->container['income_group_id'] = isset($data['income_group_id']) ? $data['income_group_id'] : null;
        $this->container['business_activity_type'] = isset($data['business_activity_type']) ? $data['business_activity_type'] : null;
        $this->container['business_activity_description'] = isset($data['business_activity_description']) ? $data['business_activity_description'] : null;
        $this->container['business_income'] = isset($data['business_income']) ? $data['business_income'] : null;
        $this->container['business_income_after_shared_with_spouse'] = isset($data['business_income_after_shared_with_spouse']) ? $data['business_income_after_shared_with_spouse'] : null;
        $this->container['corrected_business_income'] = isset($data['corrected_business_income']) ? $data['corrected_business_income'] : null;
        $this->container['deductions_for_risk_free_return'] = isset($data['deductions_for_risk_free_return']) ? $data['deductions_for_risk_free_return'] : null;
        $this->container['risk_free_return'] = isset($data['risk_free_return']) ? $data['risk_free_return'] : null;
        $this->container['valid_basis_for_risk_free_return'] = isset($data['valid_basis_for_risk_free_return']) ? $data['valid_basis_for_risk_free_return'] : null;
        $this->container['personal_income_for_the_year'] = isset($data['personal_income_for_the_year']) ? $data['personal_income_for_the_year'] : null;
        $this->container['after_shared_with_spouse'] = isset($data['after_shared_with_spouse']) ? $data['after_shared_with_spouse'] : null;
        $this->container['calculated_personal_income_spouse'] = isset($data['calculated_personal_income_spouse']) ? $data['calculated_personal_income_spouse'] : null;
        $this->container['calculated_business_income_spouse'] = isset($data['calculated_business_income_spouse']) ? $data['calculated_business_income_spouse'] : null;
        $this->container['after_coordination'] = isset($data['after_coordination']) ? $data['after_coordination'] : null;
        $this->container['sum_opening_balance_before_enterprise_debt'] = isset($data['sum_opening_balance_before_enterprise_debt']) ? $data['sum_opening_balance_before_enterprise_debt'] : null;
        $this->container['sum_closing_balance_before_enterprise_debt'] = isset($data['sum_closing_balance_before_enterprise_debt']) ? $data['sum_closing_balance_before_enterprise_debt'] : null;
        $this->container['sum_opening_balance_after_enterprise_debt'] = isset($data['sum_opening_balance_after_enterprise_debt']) ? $data['sum_opening_balance_after_enterprise_debt'] : null;
        $this->container['sum_closing_balance_after_enterprise_debt'] = isset($data['sum_closing_balance_after_enterprise_debt']) ? $data['sum_closing_balance_after_enterprise_debt'] : null;
        $this->container['basis_for_risk_free_return_ex_enterprise_debt'] = isset($data['basis_for_risk_free_return_ex_enterprise_debt']) ? $data['basis_for_risk_free_return_ex_enterprise_debt'] : null;
        $this->container['basis_enterprise_debt'] = isset($data['basis_enterprise_debt']) ? $data['basis_enterprise_debt'] : null;
        $this->container['basis_for_risk_free_return_inc_enterprise_debt'] = isset($data['basis_for_risk_free_return_inc_enterprise_debt']) ? $data['basis_for_risk_free_return_inc_enterprise_debt'] : null;
        $this->container['balance_groups'] = isset($data['balance_groups']) ? $data['balance_groups'] : null;
        $this->container['posts'] = isset($data['posts']) ? $data['posts'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getBusinessActivityTypeAllowableValues();
        if (!is_null($this->container['business_activity_type']) && !in_array($this->container['business_activity_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'business_activity_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets year_end_report
     *
     * @return \Learnist\Tripletex\Model\YearEndReport
     */
    public function getYearEndReport()
    {
        return $this->container['year_end_report'];
    }

    /**
     * Sets year_end_report
     *
     * @param \Learnist\Tripletex\Model\YearEndReport $year_end_report year_end_report
     *
     * @return $this
     */
    public function setYearEndReport($year_end_report)
    {
        $this->container['year_end_report'] = $year_end_report;

        return $this;
    }

    /**
     * Gets income_group_id
     *
     * @return int
     */
    public function getIncomeGroupId()
    {
        return $this->container['income_group_id'];
    }

    /**
     * Sets income_group_id
     *
     * @param int $income_group_id income_group_id
     *
     * @return $this
     */
    public function setIncomeGroupId($income_group_id)
    {
        $this->container['income_group_id'] = $income_group_id;

        return $this;
    }

    /**
     * Gets business_activity_type
     *
     * @return string
     */
    public function getBusinessActivityType()
    {
        return $this->container['business_activity_type'];
    }

    /**
     * Sets business_activity_type
     *
     * @param string $business_activity_type business_activity_type
     *
     * @return $this
     */
    public function setBusinessActivityType($business_activity_type)
    {
        $allowedValues = $this->getBusinessActivityTypeAllowableValues();
        if (!is_null($business_activity_type) && !in_array($business_activity_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'business_activity_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['business_activity_type'] = $business_activity_type;

        return $this;
    }

    /**
     * Gets business_activity_description
     *
     * @return string
     */
    public function getBusinessActivityDescription()
    {
        return $this->container['business_activity_description'];
    }

    /**
     * Sets business_activity_description
     *
     * @param string $business_activity_description business_activity_description
     *
     * @return $this
     */
    public function setBusinessActivityDescription($business_activity_description)
    {
        $this->container['business_activity_description'] = $business_activity_description;

        return $this;
    }

    /**
     * Gets business_income
     *
     * @return float
     */
    public function getBusinessIncome()
    {
        return $this->container['business_income'];
    }

    /**
     * Sets business_income
     *
     * @param float $business_income business_income
     *
     * @return $this
     */
    public function setBusinessIncome($business_income)
    {
        $this->container['business_income'] = $business_income;

        return $this;
    }

    /**
     * Gets business_income_after_shared_with_spouse
     *
     * @return float
     */
    public function getBusinessIncomeAfterSharedWithSpouse()
    {
        return $this->container['business_income_after_shared_with_spouse'];
    }

    /**
     * Sets business_income_after_shared_with_spouse
     *
     * @param float $business_income_after_shared_with_spouse business_income_after_shared_with_spouse
     *
     * @return $this
     */
    public function setBusinessIncomeAfterSharedWithSpouse($business_income_after_shared_with_spouse)
    {
        $this->container['business_income_after_shared_with_spouse'] = $business_income_after_shared_with_spouse;

        return $this;
    }

    /**
     * Gets corrected_business_income
     *
     * @return float
     */
    public function getCorrectedBusinessIncome()
    {
        return $this->container['corrected_business_income'];
    }

    /**
     * Sets corrected_business_income
     *
     * @param float $corrected_business_income corrected_business_income
     *
     * @return $this
     */
    public function setCorrectedBusinessIncome($corrected_business_income)
    {
        $this->container['corrected_business_income'] = $corrected_business_income;

        return $this;
    }

    /**
     * Gets deductions_for_risk_free_return
     *
     * @return float
     */
    public function getDeductionsForRiskFreeReturn()
    {
        return $this->container['deductions_for_risk_free_return'];
    }

    /**
     * Sets deductions_for_risk_free_return
     *
     * @param float $deductions_for_risk_free_return deductions_for_risk_free_return
     *
     * @return $this
     */
    public function setDeductionsForRiskFreeReturn($deductions_for_risk_free_return)
    {
        $this->container['deductions_for_risk_free_return'] = $deductions_for_risk_free_return;

        return $this;
    }

    /**
     * Gets risk_free_return
     *
     * @return float
     */
    public function getRiskFreeReturn()
    {
        return $this->container['risk_free_return'];
    }

    /**
     * Sets risk_free_return
     *
     * @param float $risk_free_return risk_free_return
     *
     * @return $this
     */
    public function setRiskFreeReturn($risk_free_return)
    {
        $this->container['risk_free_return'] = $risk_free_return;

        return $this;
    }

    /**
     * Gets valid_basis_for_risk_free_return
     *
     * @return bool
     */
    public function getValidBasisForRiskFreeReturn()
    {
        return $this->container['valid_basis_for_risk_free_return'];
    }

    /**
     * Sets valid_basis_for_risk_free_return
     *
     * @param bool $valid_basis_for_risk_free_return valid_basis_for_risk_free_return
     *
     * @return $this
     */
    public function setValidBasisForRiskFreeReturn($valid_basis_for_risk_free_return)
    {
        $this->container['valid_basis_for_risk_free_return'] = $valid_basis_for_risk_free_return;

        return $this;
    }

    /**
     * Gets personal_income_for_the_year
     *
     * @return float
     */
    public function getPersonalIncomeForTheYear()
    {
        return $this->container['personal_income_for_the_year'];
    }

    /**
     * Sets personal_income_for_the_year
     *
     * @param float $personal_income_for_the_year personal_income_for_the_year
     *
     * @return $this
     */
    public function setPersonalIncomeForTheYear($personal_income_for_the_year)
    {
        $this->container['personal_income_for_the_year'] = $personal_income_for_the_year;

        return $this;
    }

    /**
     * Gets after_shared_with_spouse
     *
     * @return float
     */
    public function getAfterSharedWithSpouse()
    {
        return $this->container['after_shared_with_spouse'];
    }

    /**
     * Sets after_shared_with_spouse
     *
     * @param float $after_shared_with_spouse after_shared_with_spouse
     *
     * @return $this
     */
    public function setAfterSharedWithSpouse($after_shared_with_spouse)
    {
        $this->container['after_shared_with_spouse'] = $after_shared_with_spouse;

        return $this;
    }

    /**
     * Gets calculated_personal_income_spouse
     *
     * @return float
     */
    public function getCalculatedPersonalIncomeSpouse()
    {
        return $this->container['calculated_personal_income_spouse'];
    }

    /**
     * Sets calculated_personal_income_spouse
     *
     * @param float $calculated_personal_income_spouse calculated_personal_income_spouse
     *
     * @return $this
     */
    public function setCalculatedPersonalIncomeSpouse($calculated_personal_income_spouse)
    {
        $this->container['calculated_personal_income_spouse'] = $calculated_personal_income_spouse;

        return $this;
    }

    /**
     * Gets calculated_business_income_spouse
     *
     * @return float
     */
    public function getCalculatedBusinessIncomeSpouse()
    {
        return $this->container['calculated_business_income_spouse'];
    }

    /**
     * Sets calculated_business_income_spouse
     *
     * @param float $calculated_business_income_spouse calculated_business_income_spouse
     *
     * @return $this
     */
    public function setCalculatedBusinessIncomeSpouse($calculated_business_income_spouse)
    {
        $this->container['calculated_business_income_spouse'] = $calculated_business_income_spouse;

        return $this;
    }

    /**
     * Gets after_coordination
     *
     * @return float
     */
    public function getAfterCoordination()
    {
        return $this->container['after_coordination'];
    }

    /**
     * Sets after_coordination
     *
     * @param float $after_coordination after_coordination
     *
     * @return $this
     */
    public function setAfterCoordination($after_coordination)
    {
        $this->container['after_coordination'] = $after_coordination;

        return $this;
    }

    /**
     * Gets sum_opening_balance_before_enterprise_debt
     *
     * @return float
     */
    public function getSumOpeningBalanceBeforeEnterpriseDebt()
    {
        return $this->container['sum_opening_balance_before_enterprise_debt'];
    }

    /**
     * Sets sum_opening_balance_before_enterprise_debt
     *
     * @param float $sum_opening_balance_before_enterprise_debt sum_opening_balance_before_enterprise_debt
     *
     * @return $this
     */
    public function setSumOpeningBalanceBeforeEnterpriseDebt($sum_opening_balance_before_enterprise_debt)
    {
        $this->container['sum_opening_balance_before_enterprise_debt'] = $sum_opening_balance_before_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_closing_balance_before_enterprise_debt
     *
     * @return float
     */
    public function getSumClosingBalanceBeforeEnterpriseDebt()
    {
        return $this->container['sum_closing_balance_before_enterprise_debt'];
    }

    /**
     * Sets sum_closing_balance_before_enterprise_debt
     *
     * @param float $sum_closing_balance_before_enterprise_debt sum_closing_balance_before_enterprise_debt
     *
     * @return $this
     */
    public function setSumClosingBalanceBeforeEnterpriseDebt($sum_closing_balance_before_enterprise_debt)
    {
        $this->container['sum_closing_balance_before_enterprise_debt'] = $sum_closing_balance_before_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_opening_balance_after_enterprise_debt
     *
     * @return float
     */
    public function getSumOpeningBalanceAfterEnterpriseDebt()
    {
        return $this->container['sum_opening_balance_after_enterprise_debt'];
    }

    /**
     * Sets sum_opening_balance_after_enterprise_debt
     *
     * @param float $sum_opening_balance_after_enterprise_debt sum_opening_balance_after_enterprise_debt
     *
     * @return $this
     */
    public function setSumOpeningBalanceAfterEnterpriseDebt($sum_opening_balance_after_enterprise_debt)
    {
        $this->container['sum_opening_balance_after_enterprise_debt'] = $sum_opening_balance_after_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_closing_balance_after_enterprise_debt
     *
     * @return float
     */
    public function getSumClosingBalanceAfterEnterpriseDebt()
    {
        return $this->container['sum_closing_balance_after_enterprise_debt'];
    }

    /**
     * Sets sum_closing_balance_after_enterprise_debt
     *
     * @param float $sum_closing_balance_after_enterprise_debt sum_closing_balance_after_enterprise_debt
     *
     * @return $this
     */
    public function setSumClosingBalanceAfterEnterpriseDebt($sum_closing_balance_after_enterprise_debt)
    {
        $this->container['sum_closing_balance_after_enterprise_debt'] = $sum_closing_balance_after_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_for_risk_free_return_ex_enterprise_debt
     *
     * @return float
     */
    public function getBasisForRiskFreeReturnExEnterpriseDebt()
    {
        return $this->container['basis_for_risk_free_return_ex_enterprise_debt'];
    }

    /**
     * Sets basis_for_risk_free_return_ex_enterprise_debt
     *
     * @param float $basis_for_risk_free_return_ex_enterprise_debt basis_for_risk_free_return_ex_enterprise_debt
     *
     * @return $this
     */
    public function setBasisForRiskFreeReturnExEnterpriseDebt($basis_for_risk_free_return_ex_enterprise_debt)
    {
        $this->container['basis_for_risk_free_return_ex_enterprise_debt'] = $basis_for_risk_free_return_ex_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_enterprise_debt
     *
     * @return float
     */
    public function getBasisEnterpriseDebt()
    {
        return $this->container['basis_enterprise_debt'];
    }

    /**
     * Sets basis_enterprise_debt
     *
     * @param float $basis_enterprise_debt basis_enterprise_debt
     *
     * @return $this
     */
    public function setBasisEnterpriseDebt($basis_enterprise_debt)
    {
        $this->container['basis_enterprise_debt'] = $basis_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_for_risk_free_return_inc_enterprise_debt
     *
     * @return float
     */
    public function getBasisForRiskFreeReturnIncEnterpriseDebt()
    {
        return $this->container['basis_for_risk_free_return_inc_enterprise_debt'];
    }

    /**
     * Sets basis_for_risk_free_return_inc_enterprise_debt
     *
     * @param float $basis_for_risk_free_return_inc_enterprise_debt basis_for_risk_free_return_inc_enterprise_debt
     *
     * @return $this
     */
    public function setBasisForRiskFreeReturnIncEnterpriseDebt($basis_for_risk_free_return_inc_enterprise_debt)
    {
        $this->container['basis_for_risk_free_return_inc_enterprise_debt'] = $basis_for_risk_free_return_inc_enterprise_debt;

        return $this;
    }

    /**
     * Gets balance_groups
     *
     * @return \Learnist\Tripletex\Model\BalanceGroup[]
     */
    public function getBalanceGroups()
    {
        return $this->container['balance_groups'];
    }

    /**
     * Sets balance_groups
     *
     * @param \Learnist\Tripletex\Model\BalanceGroup[] $balance_groups balance_groups
     *
     * @return $this
     */
    public function setBalanceGroups($balance_groups)
    {
        $this->container['balance_groups'] = $balance_groups;

        return $this;
    }

    /**
     * Gets posts
     *
     * @return \Learnist\Tripletex\Model\PersonalIncome[]
     */
    public function getPosts()
    {
        return $this->container['posts'];
    }

    /**
     * Sets posts
     *
     * @param \Learnist\Tripletex\Model\PersonalIncome[] $posts posts
     *
     * @return $this
     */
    public function setPosts($posts)
    {
        $this->container['posts'] = $posts;

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
