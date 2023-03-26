<?php
/**
 * YearEndAnnualAccounts
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
 * YearEndAnnualAccounts Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class YearEndAnnualAccounts implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'YearEndAnnualAccounts';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'version' => 'int',
'changes' => '\Learnist\Tripletex\Model\Change[]',
'url' => 'string',
'year' => 'int',
'sent_date' => 'string',
'status' => 'string',
'operating_profit_revenues' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'operating_profit_expenses' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'operating_profit' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'net_financial_items_income' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'net_financial_items_expenses' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'net_financial_items' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'ordinary_result_before_taxes' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'ordinary_result_after_taxes' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'net_profit_or_loss_for_the_year' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'net_profit_or_loss_for_the_year_after_minorities_share_of_profit' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'transfers' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'fixed_assets_intangible' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'fixed_assets_tangible' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'fixed_assets_financial' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'fixed_assets' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_assets_stocks' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_assets_receivables' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_assets_investments' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_assets_bank_deposits_cash' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_assets' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'assets' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'equity_paid_in_capital' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'equity_retained_earnings' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'equity' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'long_term_liabilities_provisions' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'long_term_liabilities_other' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'long_term_liabilities' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'current_liabilities' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'liabilities' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection',
'equity_and_liabilities' => '\Learnist\Tripletex\Model\AnnualAccountsSubTotalSection'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int32',
'version' => 'int32',
'changes' => null,
'url' => null,
'year' => 'int32',
'sent_date' => null,
'status' => null,
'operating_profit_revenues' => null,
'operating_profit_expenses' => null,
'operating_profit' => null,
'net_financial_items_income' => null,
'net_financial_items_expenses' => null,
'net_financial_items' => null,
'ordinary_result_before_taxes' => null,
'ordinary_result_after_taxes' => null,
'net_profit_or_loss_for_the_year' => null,
'net_profit_or_loss_for_the_year_after_minorities_share_of_profit' => null,
'transfers' => null,
'fixed_assets_intangible' => null,
'fixed_assets_tangible' => null,
'fixed_assets_financial' => null,
'fixed_assets' => null,
'current_assets_stocks' => null,
'current_assets_receivables' => null,
'current_assets_investments' => null,
'current_assets_bank_deposits_cash' => null,
'current_assets' => null,
'assets' => null,
'equity_paid_in_capital' => null,
'equity_retained_earnings' => null,
'equity' => null,
'long_term_liabilities_provisions' => null,
'long_term_liabilities_other' => null,
'long_term_liabilities' => null,
'current_liabilities' => null,
'liabilities' => null,
'equity_and_liabilities' => null    ];

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
        'id' => 'id',
'version' => 'version',
'changes' => 'changes',
'url' => 'url',
'year' => 'year',
'sent_date' => 'sentDate',
'status' => 'status',
'operating_profit_revenues' => 'operatingProfitRevenues',
'operating_profit_expenses' => 'operatingProfitExpenses',
'operating_profit' => 'operatingProfit',
'net_financial_items_income' => 'netFinancialItemsIncome',
'net_financial_items_expenses' => 'netFinancialItemsExpenses',
'net_financial_items' => 'netFinancialItems',
'ordinary_result_before_taxes' => 'ordinaryResultBeforeTaxes',
'ordinary_result_after_taxes' => 'ordinaryResultAfterTaxes',
'net_profit_or_loss_for_the_year' => 'netProfitOrLossForTheYear',
'net_profit_or_loss_for_the_year_after_minorities_share_of_profit' => 'netProfitOrLossForTheYearAfterMinoritiesShareOfProfit',
'transfers' => 'transfers',
'fixed_assets_intangible' => 'fixedAssetsIntangible',
'fixed_assets_tangible' => 'fixedAssetsTangible',
'fixed_assets_financial' => 'fixedAssetsFinancial',
'fixed_assets' => 'fixedAssets',
'current_assets_stocks' => 'currentAssetsStocks',
'current_assets_receivables' => 'currentAssetsReceivables',
'current_assets_investments' => 'currentAssetsInvestments',
'current_assets_bank_deposits_cash' => 'currentAssetsBankDepositsCash',
'current_assets' => 'currentAssets',
'assets' => 'assets',
'equity_paid_in_capital' => 'equityPaidInCapital',
'equity_retained_earnings' => 'equityRetainedEarnings',
'equity' => 'equity',
'long_term_liabilities_provisions' => 'longTermLiabilitiesProvisions',
'long_term_liabilities_other' => 'longTermLiabilitiesOther',
'long_term_liabilities' => 'longTermLiabilities',
'current_liabilities' => 'currentLiabilities',
'liabilities' => 'liabilities',
'equity_and_liabilities' => 'equityAndLiabilities'    ];

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
'year' => 'setYear',
'sent_date' => 'setSentDate',
'status' => 'setStatus',
'operating_profit_revenues' => 'setOperatingProfitRevenues',
'operating_profit_expenses' => 'setOperatingProfitExpenses',
'operating_profit' => 'setOperatingProfit',
'net_financial_items_income' => 'setNetFinancialItemsIncome',
'net_financial_items_expenses' => 'setNetFinancialItemsExpenses',
'net_financial_items' => 'setNetFinancialItems',
'ordinary_result_before_taxes' => 'setOrdinaryResultBeforeTaxes',
'ordinary_result_after_taxes' => 'setOrdinaryResultAfterTaxes',
'net_profit_or_loss_for_the_year' => 'setNetProfitOrLossForTheYear',
'net_profit_or_loss_for_the_year_after_minorities_share_of_profit' => 'setNetProfitOrLossForTheYearAfterMinoritiesShareOfProfit',
'transfers' => 'setTransfers',
'fixed_assets_intangible' => 'setFixedAssetsIntangible',
'fixed_assets_tangible' => 'setFixedAssetsTangible',
'fixed_assets_financial' => 'setFixedAssetsFinancial',
'fixed_assets' => 'setFixedAssets',
'current_assets_stocks' => 'setCurrentAssetsStocks',
'current_assets_receivables' => 'setCurrentAssetsReceivables',
'current_assets_investments' => 'setCurrentAssetsInvestments',
'current_assets_bank_deposits_cash' => 'setCurrentAssetsBankDepositsCash',
'current_assets' => 'setCurrentAssets',
'assets' => 'setAssets',
'equity_paid_in_capital' => 'setEquityPaidInCapital',
'equity_retained_earnings' => 'setEquityRetainedEarnings',
'equity' => 'setEquity',
'long_term_liabilities_provisions' => 'setLongTermLiabilitiesProvisions',
'long_term_liabilities_other' => 'setLongTermLiabilitiesOther',
'long_term_liabilities' => 'setLongTermLiabilities',
'current_liabilities' => 'setCurrentLiabilities',
'liabilities' => 'setLiabilities',
'equity_and_liabilities' => 'setEquityAndLiabilities'    ];

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
'year' => 'getYear',
'sent_date' => 'getSentDate',
'status' => 'getStatus',
'operating_profit_revenues' => 'getOperatingProfitRevenues',
'operating_profit_expenses' => 'getOperatingProfitExpenses',
'operating_profit' => 'getOperatingProfit',
'net_financial_items_income' => 'getNetFinancialItemsIncome',
'net_financial_items_expenses' => 'getNetFinancialItemsExpenses',
'net_financial_items' => 'getNetFinancialItems',
'ordinary_result_before_taxes' => 'getOrdinaryResultBeforeTaxes',
'ordinary_result_after_taxes' => 'getOrdinaryResultAfterTaxes',
'net_profit_or_loss_for_the_year' => 'getNetProfitOrLossForTheYear',
'net_profit_or_loss_for_the_year_after_minorities_share_of_profit' => 'getNetProfitOrLossForTheYearAfterMinoritiesShareOfProfit',
'transfers' => 'getTransfers',
'fixed_assets_intangible' => 'getFixedAssetsIntangible',
'fixed_assets_tangible' => 'getFixedAssetsTangible',
'fixed_assets_financial' => 'getFixedAssetsFinancial',
'fixed_assets' => 'getFixedAssets',
'current_assets_stocks' => 'getCurrentAssetsStocks',
'current_assets_receivables' => 'getCurrentAssetsReceivables',
'current_assets_investments' => 'getCurrentAssetsInvestments',
'current_assets_bank_deposits_cash' => 'getCurrentAssetsBankDepositsCash',
'current_assets' => 'getCurrentAssets',
'assets' => 'getAssets',
'equity_paid_in_capital' => 'getEquityPaidInCapital',
'equity_retained_earnings' => 'getEquityRetainedEarnings',
'equity' => 'getEquity',
'long_term_liabilities_provisions' => 'getLongTermLiabilitiesProvisions',
'long_term_liabilities_other' => 'getLongTermLiabilitiesOther',
'long_term_liabilities' => 'getLongTermLiabilities',
'current_liabilities' => 'getCurrentLiabilities',
'liabilities' => 'getLiabilities',
'equity_and_liabilities' => 'getEquityAndLiabilities'    ];

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

    const STATUS_STARTED = 'STARTED';
const STATUS_UPDATED = 'UPDATED';
const STATUS_RESTARTED = 'RESTARTED';
const STATUS_SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_OK = 'SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_OK';
const STATUS_SUBMITTED_SIGNED_ACCEPTED_VALIDATION_OK = 'SUBMITTED_SIGNED_ACCEPTED_VALIDATION_OK';
const STATUS_SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_FAILED = 'SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_FAILED';
const STATUS_SUBMITTED_SIGNED_ACCEPTED_VALIDATION_FAILED = 'SUBMITTED_SIGNED_ACCEPTED_VALIDATION_FAILED';
const STATUS_SUBMITTED_UNSIGNED_REJECTED = 'SUBMITTED_UNSIGNED_REJECTED';
const STATUS_SUBMITTED_SIGNED_REJECTED = 'SUBMITTED_SIGNED_REJECTED';
const STATUS_USER_MARKED_AS_SIGNEDBYALL = 'USER_MARKED_AS_SIGNEDBYALL';
const STATUS_SYSTEM_MARKED_AS_SIGNEDBYALL = 'SYSTEM_MARKED_AS_SIGNEDBYALL';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_STARTED,
self::STATUS_UPDATED,
self::STATUS_RESTARTED,
self::STATUS_SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_OK,
self::STATUS_SUBMITTED_SIGNED_ACCEPTED_VALIDATION_OK,
self::STATUS_SUBMITTED_UNSIGNED_ACCEPTED_VALIDATION_FAILED,
self::STATUS_SUBMITTED_SIGNED_ACCEPTED_VALIDATION_FAILED,
self::STATUS_SUBMITTED_UNSIGNED_REJECTED,
self::STATUS_SUBMITTED_SIGNED_REJECTED,
self::STATUS_USER_MARKED_AS_SIGNEDBYALL,
self::STATUS_SYSTEM_MARKED_AS_SIGNEDBYALL,        ];
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['year'] = isset($data['year']) ? $data['year'] : null;
        $this->container['sent_date'] = isset($data['sent_date']) ? $data['sent_date'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['operating_profit_revenues'] = isset($data['operating_profit_revenues']) ? $data['operating_profit_revenues'] : null;
        $this->container['operating_profit_expenses'] = isset($data['operating_profit_expenses']) ? $data['operating_profit_expenses'] : null;
        $this->container['operating_profit'] = isset($data['operating_profit']) ? $data['operating_profit'] : null;
        $this->container['net_financial_items_income'] = isset($data['net_financial_items_income']) ? $data['net_financial_items_income'] : null;
        $this->container['net_financial_items_expenses'] = isset($data['net_financial_items_expenses']) ? $data['net_financial_items_expenses'] : null;
        $this->container['net_financial_items'] = isset($data['net_financial_items']) ? $data['net_financial_items'] : null;
        $this->container['ordinary_result_before_taxes'] = isset($data['ordinary_result_before_taxes']) ? $data['ordinary_result_before_taxes'] : null;
        $this->container['ordinary_result_after_taxes'] = isset($data['ordinary_result_after_taxes']) ? $data['ordinary_result_after_taxes'] : null;
        $this->container['net_profit_or_loss_for_the_year'] = isset($data['net_profit_or_loss_for_the_year']) ? $data['net_profit_or_loss_for_the_year'] : null;
        $this->container['net_profit_or_loss_for_the_year_after_minorities_share_of_profit'] = isset($data['net_profit_or_loss_for_the_year_after_minorities_share_of_profit']) ? $data['net_profit_or_loss_for_the_year_after_minorities_share_of_profit'] : null;
        $this->container['transfers'] = isset($data['transfers']) ? $data['transfers'] : null;
        $this->container['fixed_assets_intangible'] = isset($data['fixed_assets_intangible']) ? $data['fixed_assets_intangible'] : null;
        $this->container['fixed_assets_tangible'] = isset($data['fixed_assets_tangible']) ? $data['fixed_assets_tangible'] : null;
        $this->container['fixed_assets_financial'] = isset($data['fixed_assets_financial']) ? $data['fixed_assets_financial'] : null;
        $this->container['fixed_assets'] = isset($data['fixed_assets']) ? $data['fixed_assets'] : null;
        $this->container['current_assets_stocks'] = isset($data['current_assets_stocks']) ? $data['current_assets_stocks'] : null;
        $this->container['current_assets_receivables'] = isset($data['current_assets_receivables']) ? $data['current_assets_receivables'] : null;
        $this->container['current_assets_investments'] = isset($data['current_assets_investments']) ? $data['current_assets_investments'] : null;
        $this->container['current_assets_bank_deposits_cash'] = isset($data['current_assets_bank_deposits_cash']) ? $data['current_assets_bank_deposits_cash'] : null;
        $this->container['current_assets'] = isset($data['current_assets']) ? $data['current_assets'] : null;
        $this->container['assets'] = isset($data['assets']) ? $data['assets'] : null;
        $this->container['equity_paid_in_capital'] = isset($data['equity_paid_in_capital']) ? $data['equity_paid_in_capital'] : null;
        $this->container['equity_retained_earnings'] = isset($data['equity_retained_earnings']) ? $data['equity_retained_earnings'] : null;
        $this->container['equity'] = isset($data['equity']) ? $data['equity'] : null;
        $this->container['long_term_liabilities_provisions'] = isset($data['long_term_liabilities_provisions']) ? $data['long_term_liabilities_provisions'] : null;
        $this->container['long_term_liabilities_other'] = isset($data['long_term_liabilities_other']) ? $data['long_term_liabilities_other'] : null;
        $this->container['long_term_liabilities'] = isset($data['long_term_liabilities']) ? $data['long_term_liabilities'] : null;
        $this->container['current_liabilities'] = isset($data['current_liabilities']) ? $data['current_liabilities'] : null;
        $this->container['liabilities'] = isset($data['liabilities']) ? $data['liabilities'] : null;
        $this->container['equity_and_liabilities'] = isset($data['equity_and_liabilities']) ? $data['equity_and_liabilities'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
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
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int $version version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->container['version'] = $version;

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
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int $year year
     *
     * @return $this
     */
    public function setYear($year)
    {
        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets sent_date
     *
     * @return string
     */
    public function getSentDate()
    {
        return $this->container['sent_date'];
    }

    /**
     * Sets sent_date
     *
     * @param string $sent_date sent_date
     *
     * @return $this
     */
    public function setSentDate($sent_date)
    {
        $this->container['sent_date'] = $sent_date;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets operating_profit_revenues
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getOperatingProfitRevenues()
    {
        return $this->container['operating_profit_revenues'];
    }

    /**
     * Sets operating_profit_revenues
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $operating_profit_revenues operating_profit_revenues
     *
     * @return $this
     */
    public function setOperatingProfitRevenues($operating_profit_revenues)
    {
        $this->container['operating_profit_revenues'] = $operating_profit_revenues;

        return $this;
    }

    /**
     * Gets operating_profit_expenses
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getOperatingProfitExpenses()
    {
        return $this->container['operating_profit_expenses'];
    }

    /**
     * Sets operating_profit_expenses
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $operating_profit_expenses operating_profit_expenses
     *
     * @return $this
     */
    public function setOperatingProfitExpenses($operating_profit_expenses)
    {
        $this->container['operating_profit_expenses'] = $operating_profit_expenses;

        return $this;
    }

    /**
     * Gets operating_profit
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getOperatingProfit()
    {
        return $this->container['operating_profit'];
    }

    /**
     * Sets operating_profit
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $operating_profit operating_profit
     *
     * @return $this
     */
    public function setOperatingProfit($operating_profit)
    {
        $this->container['operating_profit'] = $operating_profit;

        return $this;
    }

    /**
     * Gets net_financial_items_income
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getNetFinancialItemsIncome()
    {
        return $this->container['net_financial_items_income'];
    }

    /**
     * Sets net_financial_items_income
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $net_financial_items_income net_financial_items_income
     *
     * @return $this
     */
    public function setNetFinancialItemsIncome($net_financial_items_income)
    {
        $this->container['net_financial_items_income'] = $net_financial_items_income;

        return $this;
    }

    /**
     * Gets net_financial_items_expenses
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getNetFinancialItemsExpenses()
    {
        return $this->container['net_financial_items_expenses'];
    }

    /**
     * Sets net_financial_items_expenses
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $net_financial_items_expenses net_financial_items_expenses
     *
     * @return $this
     */
    public function setNetFinancialItemsExpenses($net_financial_items_expenses)
    {
        $this->container['net_financial_items_expenses'] = $net_financial_items_expenses;

        return $this;
    }

    /**
     * Gets net_financial_items
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getNetFinancialItems()
    {
        return $this->container['net_financial_items'];
    }

    /**
     * Sets net_financial_items
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $net_financial_items net_financial_items
     *
     * @return $this
     */
    public function setNetFinancialItems($net_financial_items)
    {
        $this->container['net_financial_items'] = $net_financial_items;

        return $this;
    }

    /**
     * Gets ordinary_result_before_taxes
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getOrdinaryResultBeforeTaxes()
    {
        return $this->container['ordinary_result_before_taxes'];
    }

    /**
     * Sets ordinary_result_before_taxes
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $ordinary_result_before_taxes ordinary_result_before_taxes
     *
     * @return $this
     */
    public function setOrdinaryResultBeforeTaxes($ordinary_result_before_taxes)
    {
        $this->container['ordinary_result_before_taxes'] = $ordinary_result_before_taxes;

        return $this;
    }

    /**
     * Gets ordinary_result_after_taxes
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getOrdinaryResultAfterTaxes()
    {
        return $this->container['ordinary_result_after_taxes'];
    }

    /**
     * Sets ordinary_result_after_taxes
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $ordinary_result_after_taxes ordinary_result_after_taxes
     *
     * @return $this
     */
    public function setOrdinaryResultAfterTaxes($ordinary_result_after_taxes)
    {
        $this->container['ordinary_result_after_taxes'] = $ordinary_result_after_taxes;

        return $this;
    }

    /**
     * Gets net_profit_or_loss_for_the_year
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getNetProfitOrLossForTheYear()
    {
        return $this->container['net_profit_or_loss_for_the_year'];
    }

    /**
     * Sets net_profit_or_loss_for_the_year
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $net_profit_or_loss_for_the_year net_profit_or_loss_for_the_year
     *
     * @return $this
     */
    public function setNetProfitOrLossForTheYear($net_profit_or_loss_for_the_year)
    {
        $this->container['net_profit_or_loss_for_the_year'] = $net_profit_or_loss_for_the_year;

        return $this;
    }

    /**
     * Gets net_profit_or_loss_for_the_year_after_minorities_share_of_profit
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getNetProfitOrLossForTheYearAfterMinoritiesShareOfProfit()
    {
        return $this->container['net_profit_or_loss_for_the_year_after_minorities_share_of_profit'];
    }

    /**
     * Sets net_profit_or_loss_for_the_year_after_minorities_share_of_profit
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $net_profit_or_loss_for_the_year_after_minorities_share_of_profit net_profit_or_loss_for_the_year_after_minorities_share_of_profit
     *
     * @return $this
     */
    public function setNetProfitOrLossForTheYearAfterMinoritiesShareOfProfit($net_profit_or_loss_for_the_year_after_minorities_share_of_profit)
    {
        $this->container['net_profit_or_loss_for_the_year_after_minorities_share_of_profit'] = $net_profit_or_loss_for_the_year_after_minorities_share_of_profit;

        return $this;
    }

    /**
     * Gets transfers
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getTransfers()
    {
        return $this->container['transfers'];
    }

    /**
     * Sets transfers
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $transfers transfers
     *
     * @return $this
     */
    public function setTransfers($transfers)
    {
        $this->container['transfers'] = $transfers;

        return $this;
    }

    /**
     * Gets fixed_assets_intangible
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getFixedAssetsIntangible()
    {
        return $this->container['fixed_assets_intangible'];
    }

    /**
     * Sets fixed_assets_intangible
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $fixed_assets_intangible fixed_assets_intangible
     *
     * @return $this
     */
    public function setFixedAssetsIntangible($fixed_assets_intangible)
    {
        $this->container['fixed_assets_intangible'] = $fixed_assets_intangible;

        return $this;
    }

    /**
     * Gets fixed_assets_tangible
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getFixedAssetsTangible()
    {
        return $this->container['fixed_assets_tangible'];
    }

    /**
     * Sets fixed_assets_tangible
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $fixed_assets_tangible fixed_assets_tangible
     *
     * @return $this
     */
    public function setFixedAssetsTangible($fixed_assets_tangible)
    {
        $this->container['fixed_assets_tangible'] = $fixed_assets_tangible;

        return $this;
    }

    /**
     * Gets fixed_assets_financial
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getFixedAssetsFinancial()
    {
        return $this->container['fixed_assets_financial'];
    }

    /**
     * Sets fixed_assets_financial
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $fixed_assets_financial fixed_assets_financial
     *
     * @return $this
     */
    public function setFixedAssetsFinancial($fixed_assets_financial)
    {
        $this->container['fixed_assets_financial'] = $fixed_assets_financial;

        return $this;
    }

    /**
     * Gets fixed_assets
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getFixedAssets()
    {
        return $this->container['fixed_assets'];
    }

    /**
     * Sets fixed_assets
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $fixed_assets fixed_assets
     *
     * @return $this
     */
    public function setFixedAssets($fixed_assets)
    {
        $this->container['fixed_assets'] = $fixed_assets;

        return $this;
    }

    /**
     * Gets current_assets_stocks
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentAssetsStocks()
    {
        return $this->container['current_assets_stocks'];
    }

    /**
     * Sets current_assets_stocks
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_assets_stocks current_assets_stocks
     *
     * @return $this
     */
    public function setCurrentAssetsStocks($current_assets_stocks)
    {
        $this->container['current_assets_stocks'] = $current_assets_stocks;

        return $this;
    }

    /**
     * Gets current_assets_receivables
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentAssetsReceivables()
    {
        return $this->container['current_assets_receivables'];
    }

    /**
     * Sets current_assets_receivables
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_assets_receivables current_assets_receivables
     *
     * @return $this
     */
    public function setCurrentAssetsReceivables($current_assets_receivables)
    {
        $this->container['current_assets_receivables'] = $current_assets_receivables;

        return $this;
    }

    /**
     * Gets current_assets_investments
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentAssetsInvestments()
    {
        return $this->container['current_assets_investments'];
    }

    /**
     * Sets current_assets_investments
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_assets_investments current_assets_investments
     *
     * @return $this
     */
    public function setCurrentAssetsInvestments($current_assets_investments)
    {
        $this->container['current_assets_investments'] = $current_assets_investments;

        return $this;
    }

    /**
     * Gets current_assets_bank_deposits_cash
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentAssetsBankDepositsCash()
    {
        return $this->container['current_assets_bank_deposits_cash'];
    }

    /**
     * Sets current_assets_bank_deposits_cash
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_assets_bank_deposits_cash current_assets_bank_deposits_cash
     *
     * @return $this
     */
    public function setCurrentAssetsBankDepositsCash($current_assets_bank_deposits_cash)
    {
        $this->container['current_assets_bank_deposits_cash'] = $current_assets_bank_deposits_cash;

        return $this;
    }

    /**
     * Gets current_assets
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentAssets()
    {
        return $this->container['current_assets'];
    }

    /**
     * Sets current_assets
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_assets current_assets
     *
     * @return $this
     */
    public function setCurrentAssets($current_assets)
    {
        $this->container['current_assets'] = $current_assets;

        return $this;
    }

    /**
     * Gets assets
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getAssets()
    {
        return $this->container['assets'];
    }

    /**
     * Sets assets
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $assets assets
     *
     * @return $this
     */
    public function setAssets($assets)
    {
        $this->container['assets'] = $assets;

        return $this;
    }

    /**
     * Gets equity_paid_in_capital
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getEquityPaidInCapital()
    {
        return $this->container['equity_paid_in_capital'];
    }

    /**
     * Sets equity_paid_in_capital
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $equity_paid_in_capital equity_paid_in_capital
     *
     * @return $this
     */
    public function setEquityPaidInCapital($equity_paid_in_capital)
    {
        $this->container['equity_paid_in_capital'] = $equity_paid_in_capital;

        return $this;
    }

    /**
     * Gets equity_retained_earnings
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getEquityRetainedEarnings()
    {
        return $this->container['equity_retained_earnings'];
    }

    /**
     * Sets equity_retained_earnings
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $equity_retained_earnings equity_retained_earnings
     *
     * @return $this
     */
    public function setEquityRetainedEarnings($equity_retained_earnings)
    {
        $this->container['equity_retained_earnings'] = $equity_retained_earnings;

        return $this;
    }

    /**
     * Gets equity
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getEquity()
    {
        return $this->container['equity'];
    }

    /**
     * Sets equity
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $equity equity
     *
     * @return $this
     */
    public function setEquity($equity)
    {
        $this->container['equity'] = $equity;

        return $this;
    }

    /**
     * Gets long_term_liabilities_provisions
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getLongTermLiabilitiesProvisions()
    {
        return $this->container['long_term_liabilities_provisions'];
    }

    /**
     * Sets long_term_liabilities_provisions
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $long_term_liabilities_provisions long_term_liabilities_provisions
     *
     * @return $this
     */
    public function setLongTermLiabilitiesProvisions($long_term_liabilities_provisions)
    {
        $this->container['long_term_liabilities_provisions'] = $long_term_liabilities_provisions;

        return $this;
    }

    /**
     * Gets long_term_liabilities_other
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getLongTermLiabilitiesOther()
    {
        return $this->container['long_term_liabilities_other'];
    }

    /**
     * Sets long_term_liabilities_other
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $long_term_liabilities_other long_term_liabilities_other
     *
     * @return $this
     */
    public function setLongTermLiabilitiesOther($long_term_liabilities_other)
    {
        $this->container['long_term_liabilities_other'] = $long_term_liabilities_other;

        return $this;
    }

    /**
     * Gets long_term_liabilities
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getLongTermLiabilities()
    {
        return $this->container['long_term_liabilities'];
    }

    /**
     * Sets long_term_liabilities
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $long_term_liabilities long_term_liabilities
     *
     * @return $this
     */
    public function setLongTermLiabilities($long_term_liabilities)
    {
        $this->container['long_term_liabilities'] = $long_term_liabilities;

        return $this;
    }

    /**
     * Gets current_liabilities
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getCurrentLiabilities()
    {
        return $this->container['current_liabilities'];
    }

    /**
     * Sets current_liabilities
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $current_liabilities current_liabilities
     *
     * @return $this
     */
    public function setCurrentLiabilities($current_liabilities)
    {
        $this->container['current_liabilities'] = $current_liabilities;

        return $this;
    }

    /**
     * Gets liabilities
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getLiabilities()
    {
        return $this->container['liabilities'];
    }

    /**
     * Sets liabilities
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $liabilities liabilities
     *
     * @return $this
     */
    public function setLiabilities($liabilities)
    {
        $this->container['liabilities'] = $liabilities;

        return $this;
    }

    /**
     * Gets equity_and_liabilities
     *
     * @return \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection
     */
    public function getEquityAndLiabilities()
    {
        return $this->container['equity_and_liabilities'];
    }

    /**
     * Sets equity_and_liabilities
     *
     * @param \Learnist\Tripletex\Model\AnnualAccountsSubTotalSection $equity_and_liabilities equity_and_liabilities
     *
     * @return $this
     */
    public function setEquityAndLiabilities($equity_and_liabilities)
    {
        $this->container['equity_and_liabilities'] = $equity_and_liabilities;

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
