<?php
/**
 * TaxReturnOverview
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
 * TaxReturnOverview Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TaxReturnOverview implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TaxReturnOverview';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'aid_schemes' => '\Learnist\Tripletex\Model\AidScheme[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'aid_schemes' => null    ];

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
'aid_schemes' => 'aidSchemes'    ];

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
'aid_schemes' => 'setAidSchemes'    ];

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
'aid_schemes' => 'getAidSchemes'    ];

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
        $this->container['year_end_report'] = isset($data['year_end_report']) ? $data['year_end_report'] : null;
        $this->container['show_concern_relation'] = isset($data['show_concern_relation']) ? $data['show_concern_relation'] : null;
        $this->container['business_income'] = isset($data['business_income']) ? $data['business_income'] : null;
        $this->container['group_contribution_received'] = isset($data['group_contribution_received']) ? $data['group_contribution_received'] : null;
        $this->container['group_contribution_received_grouping'] = isset($data['group_contribution_received_grouping']) ? $data['group_contribution_received_grouping'] : null;
        $this->container['paid_group_contribution'] = isset($data['paid_group_contribution']) ? $data['paid_group_contribution'] : null;
        $this->container['paid_group_contribution_grouping'] = isset($data['paid_group_contribution_grouping']) ? $data['paid_group_contribution_grouping'] : null;
        $this->container['obtained_private_agreement_and_debt_forgiveness'] = isset($data['obtained_private_agreement_and_debt_forgiveness']) ? $data['obtained_private_agreement_and_debt_forgiveness'] : null;
        $this->container['obtained_private_agreement_and_debt_forgiveness_grouping'] = isset($data['obtained_private_agreement_and_debt_forgiveness_grouping']) ? $data['obtained_private_agreement_and_debt_forgiveness_grouping'] : null;
        $this->container['taxable_profit_for_the_year'] = isset($data['taxable_profit_for_the_year']) ? $data['taxable_profit_for_the_year'] : null;
        $this->container['accumulated_loss_from_previous_year'] = isset($data['accumulated_loss_from_previous_year']) ? $data['accumulated_loss_from_previous_year'] : null;
        $this->container['losses_in_business_and_real_estate'] = isset($data['losses_in_business_and_real_estate']) ? $data['losses_in_business_and_real_estate'] : null;
        $this->container['use_of_loss_carry_forwards'] = isset($data['use_of_loss_carry_forwards']) ? $data['use_of_loss_carry_forwards'] : null;
        $this->container['accumulated_loss_for_next_year'] = isset($data['accumulated_loss_for_next_year']) ? $data['accumulated_loss_for_next_year'] : null;
        $this->container['tax_value_tangible_fixed_assets'] = isset($data['tax_value_tangible_fixed_assets']) ? $data['tax_value_tangible_fixed_assets'] : null;
        $this->container['tax_value_inventories'] = isset($data['tax_value_inventories']) ? $data['tax_value_inventories'] : null;
        $this->container['tax_value_customer_receivables'] = isset($data['tax_value_customer_receivables']) ? $data['tax_value_customer_receivables'] : null;
        $this->container['sum_gross_assets'] = isset($data['sum_gross_assets']) ? $data['sum_gross_assets'] : null;
        $this->container['total_debt_in_accounts'] = isset($data['total_debt_in_accounts']) ? $data['total_debt_in_accounts'] : null;
        $this->container['tax_to_pay'] = isset($data['tax_to_pay']) ? $data['tax_to_pay'] : null;
        $this->container['sum_debt'] = isset($data['sum_debt']) ? $data['sum_debt'] : null;
        $this->container['posts'] = isset($data['posts']) ? $data['posts'] : null;
        $this->container['capital_and_debt'] = isset($data['capital_and_debt']) ? $data['capital_and_debt'] : null;
        $this->container['aid_schemes'] = isset($data['aid_schemes']) ? $data['aid_schemes'] : null;
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
     * Gets show_concern_relation
     *
     * @return bool
     */
    public function getShowConcernRelation()
    {
        return $this->container['show_concern_relation'];
    }

    /**
     * Sets show_concern_relation
     *
     * @param bool $show_concern_relation show_concern_relation
     *
     * @return $this
     */
    public function setShowConcernRelation($show_concern_relation)
    {
        $this->container['show_concern_relation'] = $show_concern_relation;

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
     * Gets group_contribution_received
     *
     * @return float
     */
    public function getGroupContributionReceived()
    {
        return $this->container['group_contribution_received'];
    }

    /**
     * Sets group_contribution_received
     *
     * @param float $group_contribution_received group_contribution_received
     *
     * @return $this
     */
    public function setGroupContributionReceived($group_contribution_received)
    {
        $this->container['group_contribution_received'] = $group_contribution_received;

        return $this;
    }

    /**
     * Gets group_contribution_received_grouping
     *
     * @return string
     */
    public function getGroupContributionReceivedGrouping()
    {
        return $this->container['group_contribution_received_grouping'];
    }

    /**
     * Sets group_contribution_received_grouping
     *
     * @param string $group_contribution_received_grouping group_contribution_received_grouping
     *
     * @return $this
     */
    public function setGroupContributionReceivedGrouping($group_contribution_received_grouping)
    {
        $this->container['group_contribution_received_grouping'] = $group_contribution_received_grouping;

        return $this;
    }

    /**
     * Gets paid_group_contribution
     *
     * @return float
     */
    public function getPaidGroupContribution()
    {
        return $this->container['paid_group_contribution'];
    }

    /**
     * Sets paid_group_contribution
     *
     * @param float $paid_group_contribution paid_group_contribution
     *
     * @return $this
     */
    public function setPaidGroupContribution($paid_group_contribution)
    {
        $this->container['paid_group_contribution'] = $paid_group_contribution;

        return $this;
    }

    /**
     * Gets paid_group_contribution_grouping
     *
     * @return string
     */
    public function getPaidGroupContributionGrouping()
    {
        return $this->container['paid_group_contribution_grouping'];
    }

    /**
     * Sets paid_group_contribution_grouping
     *
     * @param string $paid_group_contribution_grouping paid_group_contribution_grouping
     *
     * @return $this
     */
    public function setPaidGroupContributionGrouping($paid_group_contribution_grouping)
    {
        $this->container['paid_group_contribution_grouping'] = $paid_group_contribution_grouping;

        return $this;
    }

    /**
     * Gets obtained_private_agreement_and_debt_forgiveness
     *
     * @return float
     */
    public function getObtainedPrivateAgreementAndDebtForgiveness()
    {
        return $this->container['obtained_private_agreement_and_debt_forgiveness'];
    }

    /**
     * Sets obtained_private_agreement_and_debt_forgiveness
     *
     * @param float $obtained_private_agreement_and_debt_forgiveness obtained_private_agreement_and_debt_forgiveness
     *
     * @return $this
     */
    public function setObtainedPrivateAgreementAndDebtForgiveness($obtained_private_agreement_and_debt_forgiveness)
    {
        $this->container['obtained_private_agreement_and_debt_forgiveness'] = $obtained_private_agreement_and_debt_forgiveness;

        return $this;
    }

    /**
     * Gets obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @return string
     */
    public function getObtainedPrivateAgreementAndDebtForgivenessGrouping()
    {
        return $this->container['obtained_private_agreement_and_debt_forgiveness_grouping'];
    }

    /**
     * Sets obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @param string $obtained_private_agreement_and_debt_forgiveness_grouping obtained_private_agreement_and_debt_forgiveness_grouping
     *
     * @return $this
     */
    public function setObtainedPrivateAgreementAndDebtForgivenessGrouping($obtained_private_agreement_and_debt_forgiveness_grouping)
    {
        $this->container['obtained_private_agreement_and_debt_forgiveness_grouping'] = $obtained_private_agreement_and_debt_forgiveness_grouping;

        return $this;
    }

    /**
     * Gets taxable_profit_for_the_year
     *
     * @return float
     */
    public function getTaxableProfitForTheYear()
    {
        return $this->container['taxable_profit_for_the_year'];
    }

    /**
     * Sets taxable_profit_for_the_year
     *
     * @param float $taxable_profit_for_the_year taxable_profit_for_the_year
     *
     * @return $this
     */
    public function setTaxableProfitForTheYear($taxable_profit_for_the_year)
    {
        $this->container['taxable_profit_for_the_year'] = $taxable_profit_for_the_year;

        return $this;
    }

    /**
     * Gets accumulated_loss_from_previous_year
     *
     * @return float
     */
    public function getAccumulatedLossFromPreviousYear()
    {
        return $this->container['accumulated_loss_from_previous_year'];
    }

    /**
     * Sets accumulated_loss_from_previous_year
     *
     * @param float $accumulated_loss_from_previous_year accumulated_loss_from_previous_year
     *
     * @return $this
     */
    public function setAccumulatedLossFromPreviousYear($accumulated_loss_from_previous_year)
    {
        $this->container['accumulated_loss_from_previous_year'] = $accumulated_loss_from_previous_year;

        return $this;
    }

    /**
     * Gets losses_in_business_and_real_estate
     *
     * @return float
     */
    public function getLossesInBusinessAndRealEstate()
    {
        return $this->container['losses_in_business_and_real_estate'];
    }

    /**
     * Sets losses_in_business_and_real_estate
     *
     * @param float $losses_in_business_and_real_estate losses_in_business_and_real_estate
     *
     * @return $this
     */
    public function setLossesInBusinessAndRealEstate($losses_in_business_and_real_estate)
    {
        $this->container['losses_in_business_and_real_estate'] = $losses_in_business_and_real_estate;

        return $this;
    }

    /**
     * Gets use_of_loss_carry_forwards
     *
     * @return float
     */
    public function getUseOfLossCarryForwards()
    {
        return $this->container['use_of_loss_carry_forwards'];
    }

    /**
     * Sets use_of_loss_carry_forwards
     *
     * @param float $use_of_loss_carry_forwards use_of_loss_carry_forwards
     *
     * @return $this
     */
    public function setUseOfLossCarryForwards($use_of_loss_carry_forwards)
    {
        $this->container['use_of_loss_carry_forwards'] = $use_of_loss_carry_forwards;

        return $this;
    }

    /**
     * Gets accumulated_loss_for_next_year
     *
     * @return float
     */
    public function getAccumulatedLossForNextYear()
    {
        return $this->container['accumulated_loss_for_next_year'];
    }

    /**
     * Sets accumulated_loss_for_next_year
     *
     * @param float $accumulated_loss_for_next_year accumulated_loss_for_next_year
     *
     * @return $this
     */
    public function setAccumulatedLossForNextYear($accumulated_loss_for_next_year)
    {
        $this->container['accumulated_loss_for_next_year'] = $accumulated_loss_for_next_year;

        return $this;
    }

    /**
     * Gets tax_value_tangible_fixed_assets
     *
     * @return float
     */
    public function getTaxValueTangibleFixedAssets()
    {
        return $this->container['tax_value_tangible_fixed_assets'];
    }

    /**
     * Sets tax_value_tangible_fixed_assets
     *
     * @param float $tax_value_tangible_fixed_assets tax_value_tangible_fixed_assets
     *
     * @return $this
     */
    public function setTaxValueTangibleFixedAssets($tax_value_tangible_fixed_assets)
    {
        $this->container['tax_value_tangible_fixed_assets'] = $tax_value_tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets tax_value_inventories
     *
     * @return float
     */
    public function getTaxValueInventories()
    {
        return $this->container['tax_value_inventories'];
    }

    /**
     * Sets tax_value_inventories
     *
     * @param float $tax_value_inventories tax_value_inventories
     *
     * @return $this
     */
    public function setTaxValueInventories($tax_value_inventories)
    {
        $this->container['tax_value_inventories'] = $tax_value_inventories;

        return $this;
    }

    /**
     * Gets tax_value_customer_receivables
     *
     * @return float
     */
    public function getTaxValueCustomerReceivables()
    {
        return $this->container['tax_value_customer_receivables'];
    }

    /**
     * Sets tax_value_customer_receivables
     *
     * @param float $tax_value_customer_receivables tax_value_customer_receivables
     *
     * @return $this
     */
    public function setTaxValueCustomerReceivables($tax_value_customer_receivables)
    {
        $this->container['tax_value_customer_receivables'] = $tax_value_customer_receivables;

        return $this;
    }

    /**
     * Gets sum_gross_assets
     *
     * @return float
     */
    public function getSumGrossAssets()
    {
        return $this->container['sum_gross_assets'];
    }

    /**
     * Sets sum_gross_assets
     *
     * @param float $sum_gross_assets sum_gross_assets
     *
     * @return $this
     */
    public function setSumGrossAssets($sum_gross_assets)
    {
        $this->container['sum_gross_assets'] = $sum_gross_assets;

        return $this;
    }

    /**
     * Gets total_debt_in_accounts
     *
     * @return float
     */
    public function getTotalDebtInAccounts()
    {
        return $this->container['total_debt_in_accounts'];
    }

    /**
     * Sets total_debt_in_accounts
     *
     * @param float $total_debt_in_accounts total_debt_in_accounts
     *
     * @return $this
     */
    public function setTotalDebtInAccounts($total_debt_in_accounts)
    {
        $this->container['total_debt_in_accounts'] = $total_debt_in_accounts;

        return $this;
    }

    /**
     * Gets tax_to_pay
     *
     * @return float
     */
    public function getTaxToPay()
    {
        return $this->container['tax_to_pay'];
    }

    /**
     * Sets tax_to_pay
     *
     * @param float $tax_to_pay tax_to_pay
     *
     * @return $this
     */
    public function setTaxToPay($tax_to_pay)
    {
        $this->container['tax_to_pay'] = $tax_to_pay;

        return $this;
    }

    /**
     * Gets sum_debt
     *
     * @return float
     */
    public function getSumDebt()
    {
        return $this->container['sum_debt'];
    }

    /**
     * Sets sum_debt
     *
     * @param float $sum_debt sum_debt
     *
     * @return $this
     */
    public function setSumDebt($sum_debt)
    {
        $this->container['sum_debt'] = $sum_debt;

        return $this;
    }

    /**
     * Gets posts
     *
     * @return \Learnist\Tripletex\Model\GenericData[]
     */
    public function getPosts()
    {
        return $this->container['posts'];
    }

    /**
     * Sets posts
     *
     * @param \Learnist\Tripletex\Model\GenericData[] $posts posts
     *
     * @return $this
     */
    public function setPosts($posts)
    {
        $this->container['posts'] = $posts;

        return $this;
    }

    /**
     * Gets capital_and_debt
     *
     * @return \Learnist\Tripletex\Model\TaxReturn[]
     */
    public function getCapitalAndDebt()
    {
        return $this->container['capital_and_debt'];
    }

    /**
     * Sets capital_and_debt
     *
     * @param \Learnist\Tripletex\Model\TaxReturn[] $capital_and_debt capital_and_debt
     *
     * @return $this
     */
    public function setCapitalAndDebt($capital_and_debt)
    {
        $this->container['capital_and_debt'] = $capital_and_debt;

        return $this;
    }

    /**
     * Gets aid_schemes
     *
     * @return \Learnist\Tripletex\Model\AidScheme[]
     */
    public function getAidSchemes()
    {
        return $this->container['aid_schemes'];
    }

    /**
     * Sets aid_schemes
     *
     * @param \Learnist\Tripletex\Model\AidScheme[] $aid_schemes aid_schemes
     *
     * @return $this
     */
    public function setAidSchemes($aid_schemes)
    {
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
