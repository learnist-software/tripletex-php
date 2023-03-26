<?php
/**
 * TaxReturnOverview
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
 * TaxReturnOverview Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TaxReturnOverview implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TaxReturnOverview';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
        'show_concern_relation' => 'bool',
        'business_income' => 'float',
        'group_contribution_received' => 'float',
        'group_contribution_received_grouping' => 'string',
        'paid_group_contribution' => 'float',
        'paid_group_contribution_grouping' => 'string',
        'obtained_private_agreement_and_debt_forgiveness' => 'float',
        'obtained_private_agreement_and_debt_forgiveness_grouping' => 'string',
        'taxable_profit_for_the_year' => 'float',
        'accumulated_loss_from_previous_year' => 'float',
        'losses_in_business_and_real_estate' => 'float',
        'use_of_loss_carry_forwards' => 'float',
        'accumulated_loss_for_next_year' => 'float',
        'tax_value_tangible_fixed_assets' => 'float',
        'tax_value_inventories' => 'float',
        'tax_value_customer_receivables' => 'float',
        'sum_gross_assets' => 'float',
        'total_debt_in_accounts' => 'float',
        'tax_to_pay' => 'float',
        'sum_debt' => 'float',
        'posts' => '\Learnist\Tripletex\Model\GenericData[]',
        'capital_and_debt' => '\Learnist\Tripletex\Model\TaxReturn[]',
        'aid_schemes' => '\Learnist\Tripletex\Model\AidScheme[]'
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
        'show_concern_relation' => null,
        'business_income' => null,
        'group_contribution_received' => null,
        'group_contribution_received_grouping' => null,
        'paid_group_contribution' => null,
        'paid_group_contribution_grouping' => null,
        'obtained_private_agreement_and_debt_forgiveness' => null,
        'obtained_private_agreement_and_debt_forgiveness_grouping' => null,
        'taxable_profit_for_the_year' => null,
        'accumulated_loss_from_previous_year' => null,
        'losses_in_business_and_real_estate' => null,
        'use_of_loss_carry_forwards' => null,
        'accumulated_loss_for_next_year' => null,
        'tax_value_tangible_fixed_assets' => null,
        'tax_value_inventories' => null,
        'tax_value_customer_receivables' => null,
        'sum_gross_assets' => null,
        'total_debt_in_accounts' => null,
        'tax_to_pay' => null,
        'sum_debt' => null,
        'posts' => null,
        'capital_and_debt' => null,
        'aid_schemes' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'year_end_report' => false,
		'show_concern_relation' => false,
		'business_income' => false,
		'group_contribution_received' => false,
		'group_contribution_received_grouping' => false,
		'paid_group_contribution' => false,
		'paid_group_contribution_grouping' => false,
		'obtained_private_agreement_and_debt_forgiveness' => false,
		'obtained_private_agreement_and_debt_forgiveness_grouping' => false,
		'taxable_profit_for_the_year' => false,
		'accumulated_loss_from_previous_year' => false,
		'losses_in_business_and_real_estate' => false,
		'use_of_loss_carry_forwards' => false,
		'accumulated_loss_for_next_year' => false,
		'tax_value_tangible_fixed_assets' => false,
		'tax_value_inventories' => false,
		'tax_value_customer_receivables' => false,
		'sum_gross_assets' => false,
		'total_debt_in_accounts' => false,
		'tax_to_pay' => false,
		'sum_debt' => false,
		'posts' => false,
		'capital_and_debt' => false,
		'aid_schemes' => false
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
        'show_concern_relation' => 'showConcernRelation',
        'business_income' => 'businessIncome',
        'group_contribution_received' => 'groupContributionReceived',
        'group_contribution_received_grouping' => 'groupContributionReceivedGrouping',
        'paid_group_contribution' => 'paidGroupContribution',
        'paid_group_contribution_grouping' => 'paidGroupContributionGrouping',
        'obtained_private_agreement_and_debt_forgiveness' => 'obtainedPrivateAgreementAndDebtForgiveness',
        'obtained_private_agreement_and_debt_forgiveness_grouping' => 'obtainedPrivateAgreementAndDebtForgivenessGrouping',
        'taxable_profit_for_the_year' => 'taxableProfitForTheYear',
        'accumulated_loss_from_previous_year' => 'accumulatedLossFromPreviousYear',
        'losses_in_business_and_real_estate' => 'lossesInBusinessAndRealEstate',
        'use_of_loss_carry_forwards' => 'useOfLossCarryForwards',
        'accumulated_loss_for_next_year' => 'accumulatedLossForNextYear',
        'tax_value_tangible_fixed_assets' => 'taxValueTangibleFixedAssets',
        'tax_value_inventories' => 'taxValueInventories',
        'tax_value_customer_receivables' => 'taxValueCustomerReceivables',
        'sum_gross_assets' => 'sumGrossAssets',
        'total_debt_in_accounts' => 'totalDebtInAccounts',
        'tax_to_pay' => 'taxToPay',
        'sum_debt' => 'sumDebt',
        'posts' => 'posts',
        'capital_and_debt' => 'capitalAndDebt',
        'aid_schemes' => 'aidSchemes'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
        'show_concern_relation' => 'setShowConcernRelation',
        'business_income' => 'setBusinessIncome',
        'group_contribution_received' => 'setGroupContributionReceived',
        'group_contribution_received_grouping' => 'setGroupContributionReceivedGrouping',
        'paid_group_contribution' => 'setPaidGroupContribution',
        'paid_group_contribution_grouping' => 'setPaidGroupContributionGrouping',
        'obtained_private_agreement_and_debt_forgiveness' => 'setObtainedPrivateAgreementAndDebtForgiveness',
        'obtained_private_agreement_and_debt_forgiveness_grouping' => 'setObtainedPrivateAgreementAndDebtForgivenessGrouping',
        'taxable_profit_for_the_year' => 'setTaxableProfitForTheYear',
        'accumulated_loss_from_previous_year' => 'setAccumulatedLossFromPreviousYear',
        'losses_in_business_and_real_estate' => 'setLossesInBusinessAndRealEstate',
        'use_of_loss_carry_forwards' => 'setUseOfLossCarryForwards',
        'accumulated_loss_for_next_year' => 'setAccumulatedLossForNextYear',
        'tax_value_tangible_fixed_assets' => 'setTaxValueTangibleFixedAssets',
        'tax_value_inventories' => 'setTaxValueInventories',
        'tax_value_customer_receivables' => 'setTaxValueCustomerReceivables',
        'sum_gross_assets' => 'setSumGrossAssets',
        'total_debt_in_accounts' => 'setTotalDebtInAccounts',
        'tax_to_pay' => 'setTaxToPay',
        'sum_debt' => 'setSumDebt',
        'posts' => 'setPosts',
        'capital_and_debt' => 'setCapitalAndDebt',
        'aid_schemes' => 'setAidSchemes'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
        'show_concern_relation' => 'getShowConcernRelation',
        'business_income' => 'getBusinessIncome',
        'group_contribution_received' => 'getGroupContributionReceived',
        'group_contribution_received_grouping' => 'getGroupContributionReceivedGrouping',
        'paid_group_contribution' => 'getPaidGroupContribution',
        'paid_group_contribution_grouping' => 'getPaidGroupContributionGrouping',
        'obtained_private_agreement_and_debt_forgiveness' => 'getObtainedPrivateAgreementAndDebtForgiveness',
        'obtained_private_agreement_and_debt_forgiveness_grouping' => 'getObtainedPrivateAgreementAndDebtForgivenessGrouping',
        'taxable_profit_for_the_year' => 'getTaxableProfitForTheYear',
        'accumulated_loss_from_previous_year' => 'getAccumulatedLossFromPreviousYear',
        'losses_in_business_and_real_estate' => 'getLossesInBusinessAndRealEstate',
        'use_of_loss_carry_forwards' => 'getUseOfLossCarryForwards',
        'accumulated_loss_for_next_year' => 'getAccumulatedLossForNextYear',
        'tax_value_tangible_fixed_assets' => 'getTaxValueTangibleFixedAssets',
        'tax_value_inventories' => 'getTaxValueInventories',
        'tax_value_customer_receivables' => 'getTaxValueCustomerReceivables',
        'sum_gross_assets' => 'getSumGrossAssets',
        'total_debt_in_accounts' => 'getTotalDebtInAccounts',
        'tax_to_pay' => 'getTaxToPay',
        'sum_debt' => 'getSumDebt',
        'posts' => 'getPosts',
        'capital_and_debt' => 'getCapitalAndDebt',
        'aid_schemes' => 'getAidSchemes'
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
        $this->setIfExists('year_end_report', $data ?? [], null);
        $this->setIfExists('show_concern_relation', $data ?? [], null);
        $this->setIfExists('business_income', $data ?? [], null);
        $this->setIfExists('group_contribution_received', $data ?? [], null);
        $this->setIfExists('group_contribution_received_grouping', $data ?? [], null);
        $this->setIfExists('paid_group_contribution', $data ?? [], null);
        $this->setIfExists('paid_group_contribution_grouping', $data ?? [], null);
        $this->setIfExists('obtained_private_agreement_and_debt_forgiveness', $data ?? [], null);
        $this->setIfExists('obtained_private_agreement_and_debt_forgiveness_grouping', $data ?? [], null);
        $this->setIfExists('taxable_profit_for_the_year', $data ?? [], null);
        $this->setIfExists('accumulated_loss_from_previous_year', $data ?? [], null);
        $this->setIfExists('losses_in_business_and_real_estate', $data ?? [], null);
        $this->setIfExists('use_of_loss_carry_forwards', $data ?? [], null);
        $this->setIfExists('accumulated_loss_for_next_year', $data ?? [], null);
        $this->setIfExists('tax_value_tangible_fixed_assets', $data ?? [], null);
        $this->setIfExists('tax_value_inventories', $data ?? [], null);
        $this->setIfExists('tax_value_customer_receivables', $data ?? [], null);
        $this->setIfExists('sum_gross_assets', $data ?? [], null);
        $this->setIfExists('total_debt_in_accounts', $data ?? [], null);
        $this->setIfExists('tax_to_pay', $data ?? [], null);
        $this->setIfExists('sum_debt', $data ?? [], null);
        $this->setIfExists('posts', $data ?? [], null);
        $this->setIfExists('capital_and_debt', $data ?? [], null);
        $this->setIfExists('aid_schemes', $data ?? [], null);
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
     * Gets show_concern_relation
     *
     * @return bool|null
     */
    public function getShowConcernRelation()
    {
        return $this->container['show_concern_relation'];
    }

    /**
     * Sets show_concern_relation
     *
     * @param bool|null $show_concern_relation show_concern_relation
     *
     * @return self
     */
    public function setShowConcernRelation($show_concern_relation)
    {
        if (is_null($show_concern_relation)) {
            throw new \InvalidArgumentException('non-nullable show_concern_relation cannot be null');
        }
        $this->container['show_concern_relation'] = $show_concern_relation;

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
     * Gets group_contribution_received
     *
     * @return float|null
     */
    public function getGroupContributionReceived()
    {
        return $this->container['group_contribution_received'];
    }

    /**
     * Sets group_contribution_received
     *
     * @param float|null $group_contribution_received group_contribution_received
     *
     * @return self
     */
    public function setGroupContributionReceived($group_contribution_received)
    {
        if (is_null($group_contribution_received)) {
            throw new \InvalidArgumentException('non-nullable group_contribution_received cannot be null');
        }
        $this->container['group_contribution_received'] = $group_contribution_received;

        return $this;
    }

    /**
     * Gets group_contribution_received_grouping
     *
     * @return string|null
     */
    public function getGroupContributionReceivedGrouping()
    {
        return $this->container['group_contribution_received_grouping'];
    }

    /**
     * Sets group_contribution_received_grouping
     *
     * @param string|null $group_contribution_received_grouping group_contribution_received_grouping
     *
     * @return self
     */
    public function setGroupContributionReceivedGrouping($group_contribution_received_grouping)
    {
        if (is_null($group_contribution_received_grouping)) {
            throw new \InvalidArgumentException('non-nullable group_contribution_received_grouping cannot be null');
        }
        $this->container['group_contribution_received_grouping'] = $group_contribution_received_grouping;

        return $this;
    }

    /**
     * Gets paid_group_contribution
     *
     * @return float|null
     */
    public function getPaidGroupContribution()
    {
        return $this->container['paid_group_contribution'];
    }

    /**
     * Sets paid_group_contribution
     *
     * @param float|null $paid_group_contribution paid_group_contribution
     *
     * @return self
     */
    public function setPaidGroupContribution($paid_group_contribution)
    {
        if (is_null($paid_group_contribution)) {
            throw new \InvalidArgumentException('non-nullable paid_group_contribution cannot be null');
        }
        $this->container['paid_group_contribution'] = $paid_group_contribution;

        return $this;
    }

    /**
     * Gets paid_group_contribution_grouping
     *
     * @return string|null
     */
    public function getPaidGroupContributionGrouping()
    {
        return $this->container['paid_group_contribution_grouping'];
    }

    /**
     * Sets paid_group_contribution_grouping
     *
     * @param string|null $paid_group_contribution_grouping paid_group_contribution_grouping
     *
     * @return self
     */
    public function setPaidGroupContributionGrouping($paid_group_contribution_grouping)
    {
        if (is_null($paid_group_contribution_grouping)) {
            throw new \InvalidArgumentException('non-nullable paid_group_contribution_grouping cannot be null');
        }
        $this->container['paid_group_contribution_grouping'] = $paid_group_contribution_grouping;

        return $this;
    }

    /**
     * Gets obtained_private_agreement_and_debt_forgiveness
     *
     * @return float|null
     */
    public function getObtainedPrivateAgreementAndDebtForgiveness()
    {
        return $this->container['obtained_private_agreement_and_debt_forgiveness'];
    }

    /**
     * Sets obtained_private_agreement_and_debt_forgiveness
     *
     * @param float|null $obtained_private_agreement_and_debt_forgiveness obtained_private_agreement_and_debt_forgiveness
     *
     * @return self
     */
    public function setObtainedPrivateAgreementAndDebtForgiveness($obtained_private_agreement_and_debt_forgiveness)
    {
        if (is_null($obtained_private_agreement_and_debt_forgiveness)) {
            throw new \InvalidArgumentException('non-nullable obtained_private_agreement_and_debt_forgiveness cannot be null');
        }
        $this->container['obtained_private_agreement_and_debt_forgiveness'] = $obtained_private_agreement_and_debt_forgiveness;

        return $this;
    }

    /**
     * Gets obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @return string|null
     */
    public function getObtainedPrivateAgreementAndDebtForgivenessGrouping()
    {
        return $this->container['obtained_private_agreement_and_debt_forgiveness_grouping'];
    }

    /**
     * Sets obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @param string|null $obtained_private_agreement_and_debt_forgiveness_grouping obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @return self
     */
    public function setObtainedPrivateAgreementAndDebtForgivenessGrouping($obtained_private_agreement_and_debt_forgiveness_grouping)
    {
        if (is_null($obtained_private_agreement_and_debt_forgiveness_grouping)) {
            throw new \InvalidArgumentException('non-nullable obtained_private_agreement_and_debt_forgiveness_grouping cannot be null');
        }
        $this->container['obtained_private_agreement_and_debt_forgiveness_grouping'] = $obtained_private_agreement_and_debt_forgiveness_grouping;

        return $this;
    }

    /**
     * Gets taxable_profit_for_the_year
     *
     * @return float|null
     */
    public function getTaxableProfitForTheYear()
    {
        return $this->container['taxable_profit_for_the_year'];
    }

    /**
     * Sets taxable_profit_for_the_year
     *
     * @param float|null $taxable_profit_for_the_year taxable_profit_for_the_year
     *
     * @return self
     */
    public function setTaxableProfitForTheYear($taxable_profit_for_the_year)
    {
        if (is_null($taxable_profit_for_the_year)) {
            throw new \InvalidArgumentException('non-nullable taxable_profit_for_the_year cannot be null');
        }
        $this->container['taxable_profit_for_the_year'] = $taxable_profit_for_the_year;

        return $this;
    }

    /**
     * Gets accumulated_loss_from_previous_year
     *
     * @return float|null
     */
    public function getAccumulatedLossFromPreviousYear()
    {
        return $this->container['accumulated_loss_from_previous_year'];
    }

    /**
     * Sets accumulated_loss_from_previous_year
     *
     * @param float|null $accumulated_loss_from_previous_year accumulated_loss_from_previous_year
     *
     * @return self
     */
    public function setAccumulatedLossFromPreviousYear($accumulated_loss_from_previous_year)
    {
        if (is_null($accumulated_loss_from_previous_year)) {
            throw new \InvalidArgumentException('non-nullable accumulated_loss_from_previous_year cannot be null');
        }
        $this->container['accumulated_loss_from_previous_year'] = $accumulated_loss_from_previous_year;

        return $this;
    }

    /**
     * Gets losses_in_business_and_real_estate
     *
     * @return float|null
     */
    public function getLossesInBusinessAndRealEstate()
    {
        return $this->container['losses_in_business_and_real_estate'];
    }

    /**
     * Sets losses_in_business_and_real_estate
     *
     * @param float|null $losses_in_business_and_real_estate losses_in_business_and_real_estate
     *
     * @return self
     */
    public function setLossesInBusinessAndRealEstate($losses_in_business_and_real_estate)
    {
        if (is_null($losses_in_business_and_real_estate)) {
            throw new \InvalidArgumentException('non-nullable losses_in_business_and_real_estate cannot be null');
        }
        $this->container['losses_in_business_and_real_estate'] = $losses_in_business_and_real_estate;

        return $this;
    }

    /**
     * Gets use_of_loss_carry_forwards
     *
     * @return float|null
     */
    public function getUseOfLossCarryForwards()
    {
        return $this->container['use_of_loss_carry_forwards'];
    }

    /**
     * Sets use_of_loss_carry_forwards
     *
     * @param float|null $use_of_loss_carry_forwards use_of_loss_carry_forwards
     *
     * @return self
     */
    public function setUseOfLossCarryForwards($use_of_loss_carry_forwards)
    {
        if (is_null($use_of_loss_carry_forwards)) {
            throw new \InvalidArgumentException('non-nullable use_of_loss_carry_forwards cannot be null');
        }
        $this->container['use_of_loss_carry_forwards'] = $use_of_loss_carry_forwards;

        return $this;
    }

    /**
     * Gets accumulated_loss_for_next_year
     *
     * @return float|null
     */
    public function getAccumulatedLossForNextYear()
    {
        return $this->container['accumulated_loss_for_next_year'];
    }

    /**
     * Sets accumulated_loss_for_next_year
     *
     * @param float|null $accumulated_loss_for_next_year accumulated_loss_for_next_year
     *
     * @return self
     */
    public function setAccumulatedLossForNextYear($accumulated_loss_for_next_year)
    {
        if (is_null($accumulated_loss_for_next_year)) {
            throw new \InvalidArgumentException('non-nullable accumulated_loss_for_next_year cannot be null');
        }
        $this->container['accumulated_loss_for_next_year'] = $accumulated_loss_for_next_year;

        return $this;
    }

    /**
     * Gets tax_value_tangible_fixed_assets
     *
     * @return float|null
     */
    public function getTaxValueTangibleFixedAssets()
    {
        return $this->container['tax_value_tangible_fixed_assets'];
    }

    /**
     * Sets tax_value_tangible_fixed_assets
     *
     * @param float|null $tax_value_tangible_fixed_assets tax_value_tangible_fixed_assets
     *
     * @return self
     */
    public function setTaxValueTangibleFixedAssets($tax_value_tangible_fixed_assets)
    {
        if (is_null($tax_value_tangible_fixed_assets)) {
            throw new \InvalidArgumentException('non-nullable tax_value_tangible_fixed_assets cannot be null');
        }
        $this->container['tax_value_tangible_fixed_assets'] = $tax_value_tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets tax_value_inventories
     *
     * @return float|null
     */
    public function getTaxValueInventories()
    {
        return $this->container['tax_value_inventories'];
    }

    /**
     * Sets tax_value_inventories
     *
     * @param float|null $tax_value_inventories tax_value_inventories
     *
     * @return self
     */
    public function setTaxValueInventories($tax_value_inventories)
    {
        if (is_null($tax_value_inventories)) {
            throw new \InvalidArgumentException('non-nullable tax_value_inventories cannot be null');
        }
        $this->container['tax_value_inventories'] = $tax_value_inventories;

        return $this;
    }

    /**
     * Gets tax_value_customer_receivables
     *
     * @return float|null
     */
    public function getTaxValueCustomerReceivables()
    {
        return $this->container['tax_value_customer_receivables'];
    }

    /**
     * Sets tax_value_customer_receivables
     *
     * @param float|null $tax_value_customer_receivables tax_value_customer_receivables
     *
     * @return self
     */
    public function setTaxValueCustomerReceivables($tax_value_customer_receivables)
    {
        if (is_null($tax_value_customer_receivables)) {
            throw new \InvalidArgumentException('non-nullable tax_value_customer_receivables cannot be null');
        }
        $this->container['tax_value_customer_receivables'] = $tax_value_customer_receivables;

        return $this;
    }

    /**
     * Gets sum_gross_assets
     *
     * @return float|null
     */
    public function getSumGrossAssets()
    {
        return $this->container['sum_gross_assets'];
    }

    /**
     * Sets sum_gross_assets
     *
     * @param float|null $sum_gross_assets sum_gross_assets
     *
     * @return self
     */
    public function setSumGrossAssets($sum_gross_assets)
    {
        if (is_null($sum_gross_assets)) {
            throw new \InvalidArgumentException('non-nullable sum_gross_assets cannot be null');
        }
        $this->container['sum_gross_assets'] = $sum_gross_assets;

        return $this;
    }

    /**
     * Gets total_debt_in_accounts
     *
     * @return float|null
     */
    public function getTotalDebtInAccounts()
    {
        return $this->container['total_debt_in_accounts'];
    }

    /**
     * Sets total_debt_in_accounts
     *
     * @param float|null $total_debt_in_accounts total_debt_in_accounts
     *
     * @return self
     */
    public function setTotalDebtInAccounts($total_debt_in_accounts)
    {
        if (is_null($total_debt_in_accounts)) {
            throw new \InvalidArgumentException('non-nullable total_debt_in_accounts cannot be null');
        }
        $this->container['total_debt_in_accounts'] = $total_debt_in_accounts;

        return $this;
    }

    /**
     * Gets tax_to_pay
     *
     * @return float|null
     */
    public function getTaxToPay()
    {
        return $this->container['tax_to_pay'];
    }

    /**
     * Sets tax_to_pay
     *
     * @param float|null $tax_to_pay tax_to_pay
     *
     * @return self
     */
    public function setTaxToPay($tax_to_pay)
    {
        if (is_null($tax_to_pay)) {
            throw new \InvalidArgumentException('non-nullable tax_to_pay cannot be null');
        }
        $this->container['tax_to_pay'] = $tax_to_pay;

        return $this;
    }

    /**
     * Gets sum_debt
     *
     * @return float|null
     */
    public function getSumDebt()
    {
        return $this->container['sum_debt'];
    }

    /**
     * Sets sum_debt
     *
     * @param float|null $sum_debt sum_debt
     *
     * @return self
     */
    public function setSumDebt($sum_debt)
    {
        if (is_null($sum_debt)) {
            throw new \InvalidArgumentException('non-nullable sum_debt cannot be null');
        }
        $this->container['sum_debt'] = $sum_debt;

        return $this;
    }

    /**
     * Gets posts
     *
     * @return \Learnist\Tripletex\Model\GenericData[]|null
     */
    public function getPosts()
    {
        return $this->container['posts'];
    }

    /**
     * Sets posts
     *
     * @param \Learnist\Tripletex\Model\GenericData[]|null $posts posts
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
     * Gets capital_and_debt
     *
     * @return \Learnist\Tripletex\Model\TaxReturn[]|null
     */
    public function getCapitalAndDebt()
    {
        return $this->container['capital_and_debt'];
    }

    /**
     * Sets capital_and_debt
     *
     * @param \Learnist\Tripletex\Model\TaxReturn[]|null $capital_and_debt capital_and_debt
     *
     * @return self
     */
    public function setCapitalAndDebt($capital_and_debt)
    {
        if (is_null($capital_and_debt)) {
            throw new \InvalidArgumentException('non-nullable capital_and_debt cannot be null');
        }
        $this->container['capital_and_debt'] = $capital_and_debt;

        return $this;
    }

    /**
     * Gets aid_schemes
     *
     * @return \Learnist\Tripletex\Model\AidScheme[]|null
     */
    public function getAidSchemes()
    {
        return $this->container['aid_schemes'];
    }

    /**
     * Sets aid_schemes
     *
     * @param \Learnist\Tripletex\Model\AidScheme[]|null $aid_schemes aid_schemes
     *
     * @return self
     */
    public function setAidSchemes($aid_schemes)
    {
        if (is_null($aid_schemes)) {
            throw new \InvalidArgumentException('non-nullable aid_schemes cannot be null');
        }
        $this->container['aid_schemes'] = $aid_schemes;

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


