<?php
/**
 * PersonalIncomeOverview
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
 * PersonalIncomeOverview Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PersonalIncomeOverview implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PersonalIncomeOverview';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'posts' => '\Learnist\Tripletex\Model\PersonalIncome[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'posts' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'year_end_report' => false,
		'income_group_id' => false,
		'business_activity_type' => false,
		'business_activity_description' => false,
		'business_income' => false,
		'business_income_after_shared_with_spouse' => false,
		'corrected_business_income' => false,
		'deductions_for_risk_free_return' => false,
		'risk_free_return' => false,
		'valid_basis_for_risk_free_return' => false,
		'personal_income_for_the_year' => false,
		'after_shared_with_spouse' => false,
		'calculated_personal_income_spouse' => false,
		'calculated_business_income_spouse' => false,
		'after_coordination' => false,
		'sum_opening_balance_before_enterprise_debt' => false,
		'sum_closing_balance_before_enterprise_debt' => false,
		'sum_opening_balance_after_enterprise_debt' => false,
		'sum_closing_balance_after_enterprise_debt' => false,
		'basis_for_risk_free_return_ex_enterprise_debt' => false,
		'basis_enterprise_debt' => false,
		'basis_for_risk_free_return_inc_enterprise_debt' => false,
		'balance_groups' => false,
		'posts' => false
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
        'posts' => 'posts'
    ];

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
        'posts' => 'setPosts'
    ];

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
        'posts' => 'getPosts'
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

    public const BUSINESS_ACTIVITY_TYPE_OTHER_COMMERCIAL_ACTIVITIES = 'OTHER_COMMERCIAL_ACTIVITIES';
    public const BUSINESS_ACTIVITY_TYPE_AGRICULTURE_HORTICULTURE_FUR_FARMING = 'AGRICULTURE_HORTICULTURE_FUR_FARMING';
    public const BUSINESS_ACTIVITY_TYPE_FISHING_AND_HUNTING_AT_SEA = 'FISHING_AND_HUNTING_AT_SEA';
    public const BUSINESS_ACTIVITY_TYPE_REINDEER_HUSBANDRY = 'REINDEER_HUSBANDRY';
    public const BUSINESS_ACTIVITY_TYPE_FAMILY_DAY_CARE_CENTRE_IN_OWN_HOME = 'FAMILY_DAY_CARE_CENTRE_IN_OWN_HOME';
    public const BUSINESS_ACTIVITY_TYPE_SLATE_QUARRYING = 'SLATE_QUARRYING';
    public const BUSINESS_ACTIVITY_TYPE_FORESTRY = 'FORESTRY';

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
            self::BUSINESS_ACTIVITY_TYPE_FORESTRY,
        ];
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
        $this->setIfExists('year_end_report', $data ?? [], null);
        $this->setIfExists('income_group_id', $data ?? [], null);
        $this->setIfExists('business_activity_type', $data ?? [], null);
        $this->setIfExists('business_activity_description', $data ?? [], null);
        $this->setIfExists('business_income', $data ?? [], null);
        $this->setIfExists('business_income_after_shared_with_spouse', $data ?? [], null);
        $this->setIfExists('corrected_business_income', $data ?? [], null);
        $this->setIfExists('deductions_for_risk_free_return', $data ?? [], null);
        $this->setIfExists('risk_free_return', $data ?? [], null);
        $this->setIfExists('valid_basis_for_risk_free_return', $data ?? [], null);
        $this->setIfExists('personal_income_for_the_year', $data ?? [], null);
        $this->setIfExists('after_shared_with_spouse', $data ?? [], null);
        $this->setIfExists('calculated_personal_income_spouse', $data ?? [], null);
        $this->setIfExists('calculated_business_income_spouse', $data ?? [], null);
        $this->setIfExists('after_coordination', $data ?? [], null);
        $this->setIfExists('sum_opening_balance_before_enterprise_debt', $data ?? [], null);
        $this->setIfExists('sum_closing_balance_before_enterprise_debt', $data ?? [], null);
        $this->setIfExists('sum_opening_balance_after_enterprise_debt', $data ?? [], null);
        $this->setIfExists('sum_closing_balance_after_enterprise_debt', $data ?? [], null);
        $this->setIfExists('basis_for_risk_free_return_ex_enterprise_debt', $data ?? [], null);
        $this->setIfExists('basis_enterprise_debt', $data ?? [], null);
        $this->setIfExists('basis_for_risk_free_return_inc_enterprise_debt', $data ?? [], null);
        $this->setIfExists('balance_groups', $data ?? [], null);
        $this->setIfExists('posts', $data ?? [], null);
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

        if (!is_null($this->container['income_group_id']) && ($this->container['income_group_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'income_group_id', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getBusinessActivityTypeAllowableValues();
        if (!is_null($this->container['business_activity_type']) && !in_array($this->container['business_activity_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'business_activity_type', must be one of '%s'",
                $this->container['business_activity_type'],
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
     * @return \Learnist\Tripletex\Model\YearEndReport|null
     */
    public function getYearEndReport()
    {
        return $this->container['year_end_report'];
    }

    /**
     * Sets year_end_report
     *
     * @param \Learnist\Tripletex\Model\YearEndReport|null $year_end_report year_end_report
     *
     * @return self
     */
    public function setYearEndReport($year_end_report)
    {

        if (is_null($year_end_report)) {
            throw new \InvalidArgumentException('non-nullable year_end_report cannot be null');
        }

        $this->container['year_end_report'] = $year_end_report;

        return $this;
    }

    /**
     * Gets income_group_id
     *
     * @return int|null
     */
    public function getIncomeGroupId()
    {
        return $this->container['income_group_id'];
    }

    /**
     * Sets income_group_id
     *
     * @param int|null $income_group_id income_group_id
     *
     * @return self
     */
    public function setIncomeGroupId($income_group_id)
    {

        if (!is_null($income_group_id) && ($income_group_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $income_group_id when calling PersonalIncomeOverview., must be bigger than or equal to 0.');
        }


        if (is_null($income_group_id)) {
            throw new \InvalidArgumentException('non-nullable income_group_id cannot be null');
        }

        $this->container['income_group_id'] = $income_group_id;

        return $this;
    }

    /**
     * Gets business_activity_type
     *
     * @return string|null
     */
    public function getBusinessActivityType()
    {
        return $this->container['business_activity_type'];
    }

    /**
     * Sets business_activity_type
     *
     * @param string|null $business_activity_type business_activity_type
     *
     * @return self
     */
    public function setBusinessActivityType($business_activity_type)
    {
        $allowedValues = $this->getBusinessActivityTypeAllowableValues();
        if (!is_null($business_activity_type) && !in_array($business_activity_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'business_activity_type', must be one of '%s'",
                    $business_activity_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($business_activity_type)) {
            throw new \InvalidArgumentException('non-nullable business_activity_type cannot be null');
        }

        $this->container['business_activity_type'] = $business_activity_type;

        return $this;
    }

    /**
     * Gets business_activity_description
     *
     * @return string|null
     */
    public function getBusinessActivityDescription()
    {
        return $this->container['business_activity_description'];
    }

    /**
     * Sets business_activity_description
     *
     * @param string|null $business_activity_description business_activity_description
     *
     * @return self
     */
    public function setBusinessActivityDescription($business_activity_description)
    {

        if (is_null($business_activity_description)) {
            throw new \InvalidArgumentException('non-nullable business_activity_description cannot be null');
        }

        $this->container['business_activity_description'] = $business_activity_description;

        return $this;
    }

    /**
     * Gets business_income
     *
     * @return float|null
     */
    public function getBusinessIncome()
    {
        return $this->container['business_income'];
    }

    /**
     * Sets business_income
     *
     * @param float|null $business_income business_income
     *
     * @return self
     */
    public function setBusinessIncome($business_income)
    {

        if (is_null($business_income)) {
            throw new \InvalidArgumentException('non-nullable business_income cannot be null');
        }

        $this->container['business_income'] = $business_income;

        return $this;
    }

    /**
     * Gets business_income_after_shared_with_spouse
     *
     * @return float|null
     */
    public function getBusinessIncomeAfterSharedWithSpouse()
    {
        return $this->container['business_income_after_shared_with_spouse'];
    }

    /**
     * Sets business_income_after_shared_with_spouse
     *
     * @param float|null $business_income_after_shared_with_spouse business_income_after_shared_with_spouse
     *
     * @return self
     */
    public function setBusinessIncomeAfterSharedWithSpouse($business_income_after_shared_with_spouse)
    {

        if (is_null($business_income_after_shared_with_spouse)) {
            throw new \InvalidArgumentException('non-nullable business_income_after_shared_with_spouse cannot be null');
        }

        $this->container['business_income_after_shared_with_spouse'] = $business_income_after_shared_with_spouse;

        return $this;
    }

    /**
     * Gets corrected_business_income
     *
     * @return float|null
     */
    public function getCorrectedBusinessIncome()
    {
        return $this->container['corrected_business_income'];
    }

    /**
     * Sets corrected_business_income
     *
     * @param float|null $corrected_business_income corrected_business_income
     *
     * @return self
     */
    public function setCorrectedBusinessIncome($corrected_business_income)
    {

        if (is_null($corrected_business_income)) {
            throw new \InvalidArgumentException('non-nullable corrected_business_income cannot be null');
        }

        $this->container['corrected_business_income'] = $corrected_business_income;

        return $this;
    }

    /**
     * Gets deductions_for_risk_free_return
     *
     * @return float|null
     */
    public function getDeductionsForRiskFreeReturn()
    {
        return $this->container['deductions_for_risk_free_return'];
    }

    /**
     * Sets deductions_for_risk_free_return
     *
     * @param float|null $deductions_for_risk_free_return deductions_for_risk_free_return
     *
     * @return self
     */
    public function setDeductionsForRiskFreeReturn($deductions_for_risk_free_return)
    {

        if (is_null($deductions_for_risk_free_return)) {
            throw new \InvalidArgumentException('non-nullable deductions_for_risk_free_return cannot be null');
        }

        $this->container['deductions_for_risk_free_return'] = $deductions_for_risk_free_return;

        return $this;
    }

    /**
     * Gets risk_free_return
     *
     * @return float|null
     */
    public function getRiskFreeReturn()
    {
        return $this->container['risk_free_return'];
    }

    /**
     * Sets risk_free_return
     *
     * @param float|null $risk_free_return risk_free_return
     *
     * @return self
     */
    public function setRiskFreeReturn($risk_free_return)
    {

        if (is_null($risk_free_return)) {
            throw new \InvalidArgumentException('non-nullable risk_free_return cannot be null');
        }

        $this->container['risk_free_return'] = $risk_free_return;

        return $this;
    }

    /**
     * Gets valid_basis_for_risk_free_return
     *
     * @return bool|null
     */
    public function getValidBasisForRiskFreeReturn()
    {
        return $this->container['valid_basis_for_risk_free_return'];
    }

    /**
     * Sets valid_basis_for_risk_free_return
     *
     * @param bool|null $valid_basis_for_risk_free_return valid_basis_for_risk_free_return
     *
     * @return self
     */
    public function setValidBasisForRiskFreeReturn($valid_basis_for_risk_free_return)
    {

        if (is_null($valid_basis_for_risk_free_return)) {
            throw new \InvalidArgumentException('non-nullable valid_basis_for_risk_free_return cannot be null');
        }

        $this->container['valid_basis_for_risk_free_return'] = $valid_basis_for_risk_free_return;

        return $this;
    }

    /**
     * Gets personal_income_for_the_year
     *
     * @return float|null
     */
    public function getPersonalIncomeForTheYear()
    {
        return $this->container['personal_income_for_the_year'];
    }

    /**
     * Sets personal_income_for_the_year
     *
     * @param float|null $personal_income_for_the_year personal_income_for_the_year
     *
     * @return self
     */
    public function setPersonalIncomeForTheYear($personal_income_for_the_year)
    {

        if (is_null($personal_income_for_the_year)) {
            throw new \InvalidArgumentException('non-nullable personal_income_for_the_year cannot be null');
        }

        $this->container['personal_income_for_the_year'] = $personal_income_for_the_year;

        return $this;
    }

    /**
     * Gets after_shared_with_spouse
     *
     * @return float|null
     */
    public function getAfterSharedWithSpouse()
    {
        return $this->container['after_shared_with_spouse'];
    }

    /**
     * Sets after_shared_with_spouse
     *
     * @param float|null $after_shared_with_spouse after_shared_with_spouse
     *
     * @return self
     */
    public function setAfterSharedWithSpouse($after_shared_with_spouse)
    {

        if (is_null($after_shared_with_spouse)) {
            throw new \InvalidArgumentException('non-nullable after_shared_with_spouse cannot be null');
        }

        $this->container['after_shared_with_spouse'] = $after_shared_with_spouse;

        return $this;
    }

    /**
     * Gets calculated_personal_income_spouse
     *
     * @return float|null
     */
    public function getCalculatedPersonalIncomeSpouse()
    {
        return $this->container['calculated_personal_income_spouse'];
    }

    /**
     * Sets calculated_personal_income_spouse
     *
     * @param float|null $calculated_personal_income_spouse calculated_personal_income_spouse
     *
     * @return self
     */
    public function setCalculatedPersonalIncomeSpouse($calculated_personal_income_spouse)
    {

        if (is_null($calculated_personal_income_spouse)) {
            throw new \InvalidArgumentException('non-nullable calculated_personal_income_spouse cannot be null');
        }

        $this->container['calculated_personal_income_spouse'] = $calculated_personal_income_spouse;

        return $this;
    }

    /**
     * Gets calculated_business_income_spouse
     *
     * @return float|null
     */
    public function getCalculatedBusinessIncomeSpouse()
    {
        return $this->container['calculated_business_income_spouse'];
    }

    /**
     * Sets calculated_business_income_spouse
     *
     * @param float|null $calculated_business_income_spouse calculated_business_income_spouse
     *
     * @return self
     */
    public function setCalculatedBusinessIncomeSpouse($calculated_business_income_spouse)
    {

        if (is_null($calculated_business_income_spouse)) {
            throw new \InvalidArgumentException('non-nullable calculated_business_income_spouse cannot be null');
        }

        $this->container['calculated_business_income_spouse'] = $calculated_business_income_spouse;

        return $this;
    }

    /**
     * Gets after_coordination
     *
     * @return float|null
     */
    public function getAfterCoordination()
    {
        return $this->container['after_coordination'];
    }

    /**
     * Sets after_coordination
     *
     * @param float|null $after_coordination after_coordination
     *
     * @return self
     */
    public function setAfterCoordination($after_coordination)
    {

        if (is_null($after_coordination)) {
            throw new \InvalidArgumentException('non-nullable after_coordination cannot be null');
        }

        $this->container['after_coordination'] = $after_coordination;

        return $this;
    }

    /**
     * Gets sum_opening_balance_before_enterprise_debt
     *
     * @return float|null
     */
    public function getSumOpeningBalanceBeforeEnterpriseDebt()
    {
        return $this->container['sum_opening_balance_before_enterprise_debt'];
    }

    /**
     * Sets sum_opening_balance_before_enterprise_debt
     *
     * @param float|null $sum_opening_balance_before_enterprise_debt sum_opening_balance_before_enterprise_debt
     *
     * @return self
     */
    public function setSumOpeningBalanceBeforeEnterpriseDebt($sum_opening_balance_before_enterprise_debt)
    {

        if (is_null($sum_opening_balance_before_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable sum_opening_balance_before_enterprise_debt cannot be null');
        }

        $this->container['sum_opening_balance_before_enterprise_debt'] = $sum_opening_balance_before_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_closing_balance_before_enterprise_debt
     *
     * @return float|null
     */
    public function getSumClosingBalanceBeforeEnterpriseDebt()
    {
        return $this->container['sum_closing_balance_before_enterprise_debt'];
    }

    /**
     * Sets sum_closing_balance_before_enterprise_debt
     *
     * @param float|null $sum_closing_balance_before_enterprise_debt sum_closing_balance_before_enterprise_debt
     *
     * @return self
     */
    public function setSumClosingBalanceBeforeEnterpriseDebt($sum_closing_balance_before_enterprise_debt)
    {

        if (is_null($sum_closing_balance_before_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable sum_closing_balance_before_enterprise_debt cannot be null');
        }

        $this->container['sum_closing_balance_before_enterprise_debt'] = $sum_closing_balance_before_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_opening_balance_after_enterprise_debt
     *
     * @return float|null
     */
    public function getSumOpeningBalanceAfterEnterpriseDebt()
    {
        return $this->container['sum_opening_balance_after_enterprise_debt'];
    }

    /**
     * Sets sum_opening_balance_after_enterprise_debt
     *
     * @param float|null $sum_opening_balance_after_enterprise_debt sum_opening_balance_after_enterprise_debt
     *
     * @return self
     */
    public function setSumOpeningBalanceAfterEnterpriseDebt($sum_opening_balance_after_enterprise_debt)
    {

        if (is_null($sum_opening_balance_after_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable sum_opening_balance_after_enterprise_debt cannot be null');
        }

        $this->container['sum_opening_balance_after_enterprise_debt'] = $sum_opening_balance_after_enterprise_debt;

        return $this;
    }

    /**
     * Gets sum_closing_balance_after_enterprise_debt
     *
     * @return float|null
     */
    public function getSumClosingBalanceAfterEnterpriseDebt()
    {
        return $this->container['sum_closing_balance_after_enterprise_debt'];
    }

    /**
     * Sets sum_closing_balance_after_enterprise_debt
     *
     * @param float|null $sum_closing_balance_after_enterprise_debt sum_closing_balance_after_enterprise_debt
     *
     * @return self
     */
    public function setSumClosingBalanceAfterEnterpriseDebt($sum_closing_balance_after_enterprise_debt)
    {

        if (is_null($sum_closing_balance_after_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable sum_closing_balance_after_enterprise_debt cannot be null');
        }

        $this->container['sum_closing_balance_after_enterprise_debt'] = $sum_closing_balance_after_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_for_risk_free_return_ex_enterprise_debt
     *
     * @return float|null
     */
    public function getBasisForRiskFreeReturnExEnterpriseDebt()
    {
        return $this->container['basis_for_risk_free_return_ex_enterprise_debt'];
    }

    /**
     * Sets basis_for_risk_free_return_ex_enterprise_debt
     *
     * @param float|null $basis_for_risk_free_return_ex_enterprise_debt basis_for_risk_free_return_ex_enterprise_debt
     *
     * @return self
     */
    public function setBasisForRiskFreeReturnExEnterpriseDebt($basis_for_risk_free_return_ex_enterprise_debt)
    {

        if (is_null($basis_for_risk_free_return_ex_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable basis_for_risk_free_return_ex_enterprise_debt cannot be null');
        }

        $this->container['basis_for_risk_free_return_ex_enterprise_debt'] = $basis_for_risk_free_return_ex_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_enterprise_debt
     *
     * @return float|null
     */
    public function getBasisEnterpriseDebt()
    {
        return $this->container['basis_enterprise_debt'];
    }

    /**
     * Sets basis_enterprise_debt
     *
     * @param float|null $basis_enterprise_debt basis_enterprise_debt
     *
     * @return self
     */
    public function setBasisEnterpriseDebt($basis_enterprise_debt)
    {

        if (is_null($basis_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable basis_enterprise_debt cannot be null');
        }

        $this->container['basis_enterprise_debt'] = $basis_enterprise_debt;

        return $this;
    }

    /**
     * Gets basis_for_risk_free_return_inc_enterprise_debt
     *
     * @return float|null
     */
    public function getBasisForRiskFreeReturnIncEnterpriseDebt()
    {
        return $this->container['basis_for_risk_free_return_inc_enterprise_debt'];
    }

    /**
     * Sets basis_for_risk_free_return_inc_enterprise_debt
     *
     * @param float|null $basis_for_risk_free_return_inc_enterprise_debt basis_for_risk_free_return_inc_enterprise_debt
     *
     * @return self
     */
    public function setBasisForRiskFreeReturnIncEnterpriseDebt($basis_for_risk_free_return_inc_enterprise_debt)
    {

        if (is_null($basis_for_risk_free_return_inc_enterprise_debt)) {
            throw new \InvalidArgumentException('non-nullable basis_for_risk_free_return_inc_enterprise_debt cannot be null');
        }

        $this->container['basis_for_risk_free_return_inc_enterprise_debt'] = $basis_for_risk_free_return_inc_enterprise_debt;

        return $this;
    }

    /**
     * Gets balance_groups
     *
     * @return \Learnist\Tripletex\Model\BalanceGroup[]|null
     */
    public function getBalanceGroups()
    {
        return $this->container['balance_groups'];
    }

    /**
     * Sets balance_groups
     *
     * @param \Learnist\Tripletex\Model\BalanceGroup[]|null $balance_groups balance_groups
     *
     * @return self
     */
    public function setBalanceGroups($balance_groups)
    {

        if (is_null($balance_groups)) {
            throw new \InvalidArgumentException('non-nullable balance_groups cannot be null');
        }

        $this->container['balance_groups'] = $balance_groups;

        return $this;
    }

    /**
     * Gets posts
     *
     * @return \Learnist\Tripletex\Model\PersonalIncome[]|null
     */
    public function getPosts()
    {
        return $this->container['posts'];
    }

    /**
     * Sets posts
     *
     * @param \Learnist\Tripletex\Model\PersonalIncome[]|null $posts posts
     *
     * @return self
     */
    public function setPosts($posts)
    {

        if (is_null($posts)) {
            throw new \InvalidArgumentException('non-nullable posts cannot be null');
        }

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


