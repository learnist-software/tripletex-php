<?php
/**
 * ProfitAndLoss
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
 * ProfitAndLoss Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProfitAndLoss implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ProfitAndLoss';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
'sum_profit' => 'float',
'sum_loss' => 'float',
'sum_profit_and_loss' => 'float',
'opening_balance' => 'float',
'opening_balance_profit' => 'float',
'opening_balance_loss' => 'float',
'closing_balance_profit' => 'float',
'closing_balance_loss' => 'float',
'posted_opening_balance_profit' => 'float',
'posted_opening_balance_loss' => 'float',
'posted_closing_balance_profit' => 'float',
'posted_closing_balance_loss' => 'float',
'closing_balance' => 'float',
'annual_income_recognition' => 'float',
'annual_deduction' => 'float',
'amount_to_be_posted_on_income_recognition_account' => 'float',
'amount_to_be_posted_on_deduction_account' => 'float',
'generic_data_overviews' => '\Learnist\Tripletex\Model\GenericDataOverview[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'year_end_report' => null,
'sum_profit' => null,
'sum_loss' => null,
'sum_profit_and_loss' => null,
'opening_balance' => null,
'opening_balance_profit' => null,
'opening_balance_loss' => null,
'closing_balance_profit' => null,
'closing_balance_loss' => null,
'posted_opening_balance_profit' => null,
'posted_opening_balance_loss' => null,
'posted_closing_balance_profit' => null,
'posted_closing_balance_loss' => null,
'closing_balance' => null,
'annual_income_recognition' => null,
'annual_deduction' => null,
'amount_to_be_posted_on_income_recognition_account' => null,
'amount_to_be_posted_on_deduction_account' => null,
'generic_data_overviews' => null    ];

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
'sum_profit' => 'sumProfit',
'sum_loss' => 'sumLoss',
'sum_profit_and_loss' => 'sumProfitAndLoss',
'opening_balance' => 'openingBalance',
'opening_balance_profit' => 'openingBalanceProfit',
'opening_balance_loss' => 'openingBalanceLoss',
'closing_balance_profit' => 'closingBalanceProfit',
'closing_balance_loss' => 'closingBalanceLoss',
'posted_opening_balance_profit' => 'postedOpeningBalanceProfit',
'posted_opening_balance_loss' => 'postedOpeningBalanceLoss',
'posted_closing_balance_profit' => 'postedClosingBalanceProfit',
'posted_closing_balance_loss' => 'postedClosingBalanceLoss',
'closing_balance' => 'closingBalance',
'annual_income_recognition' => 'annualIncomeRecognition',
'annual_deduction' => 'annualDeduction',
'amount_to_be_posted_on_income_recognition_account' => 'amountToBePostedOnIncomeRecognitionAccount',
'amount_to_be_posted_on_deduction_account' => 'amountToBePostedOnDeductionAccount',
'generic_data_overviews' => 'genericDataOverviews'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
'sum_profit' => 'setSumProfit',
'sum_loss' => 'setSumLoss',
'sum_profit_and_loss' => 'setSumProfitAndLoss',
'opening_balance' => 'setOpeningBalance',
'opening_balance_profit' => 'setOpeningBalanceProfit',
'opening_balance_loss' => 'setOpeningBalanceLoss',
'closing_balance_profit' => 'setClosingBalanceProfit',
'closing_balance_loss' => 'setClosingBalanceLoss',
'posted_opening_balance_profit' => 'setPostedOpeningBalanceProfit',
'posted_opening_balance_loss' => 'setPostedOpeningBalanceLoss',
'posted_closing_balance_profit' => 'setPostedClosingBalanceProfit',
'posted_closing_balance_loss' => 'setPostedClosingBalanceLoss',
'closing_balance' => 'setClosingBalance',
'annual_income_recognition' => 'setAnnualIncomeRecognition',
'annual_deduction' => 'setAnnualDeduction',
'amount_to_be_posted_on_income_recognition_account' => 'setAmountToBePostedOnIncomeRecognitionAccount',
'amount_to_be_posted_on_deduction_account' => 'setAmountToBePostedOnDeductionAccount',
'generic_data_overviews' => 'setGenericDataOverviews'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
'sum_profit' => 'getSumProfit',
'sum_loss' => 'getSumLoss',
'sum_profit_and_loss' => 'getSumProfitAndLoss',
'opening_balance' => 'getOpeningBalance',
'opening_balance_profit' => 'getOpeningBalanceProfit',
'opening_balance_loss' => 'getOpeningBalanceLoss',
'closing_balance_profit' => 'getClosingBalanceProfit',
'closing_balance_loss' => 'getClosingBalanceLoss',
'posted_opening_balance_profit' => 'getPostedOpeningBalanceProfit',
'posted_opening_balance_loss' => 'getPostedOpeningBalanceLoss',
'posted_closing_balance_profit' => 'getPostedClosingBalanceProfit',
'posted_closing_balance_loss' => 'getPostedClosingBalanceLoss',
'closing_balance' => 'getClosingBalance',
'annual_income_recognition' => 'getAnnualIncomeRecognition',
'annual_deduction' => 'getAnnualDeduction',
'amount_to_be_posted_on_income_recognition_account' => 'getAmountToBePostedOnIncomeRecognitionAccount',
'amount_to_be_posted_on_deduction_account' => 'getAmountToBePostedOnDeductionAccount',
'generic_data_overviews' => 'getGenericDataOverviews'    ];

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
        $this->container['sum_profit'] = isset($data['sum_profit']) ? $data['sum_profit'] : null;
        $this->container['sum_loss'] = isset($data['sum_loss']) ? $data['sum_loss'] : null;
        $this->container['sum_profit_and_loss'] = isset($data['sum_profit_and_loss']) ? $data['sum_profit_and_loss'] : null;
        $this->container['opening_balance'] = isset($data['opening_balance']) ? $data['opening_balance'] : null;
        $this->container['opening_balance_profit'] = isset($data['opening_balance_profit']) ? $data['opening_balance_profit'] : null;
        $this->container['opening_balance_loss'] = isset($data['opening_balance_loss']) ? $data['opening_balance_loss'] : null;
        $this->container['closing_balance_profit'] = isset($data['closing_balance_profit']) ? $data['closing_balance_profit'] : null;
        $this->container['closing_balance_loss'] = isset($data['closing_balance_loss']) ? $data['closing_balance_loss'] : null;
        $this->container['posted_opening_balance_profit'] = isset($data['posted_opening_balance_profit']) ? $data['posted_opening_balance_profit'] : null;
        $this->container['posted_opening_balance_loss'] = isset($data['posted_opening_balance_loss']) ? $data['posted_opening_balance_loss'] : null;
        $this->container['posted_closing_balance_profit'] = isset($data['posted_closing_balance_profit']) ? $data['posted_closing_balance_profit'] : null;
        $this->container['posted_closing_balance_loss'] = isset($data['posted_closing_balance_loss']) ? $data['posted_closing_balance_loss'] : null;
        $this->container['closing_balance'] = isset($data['closing_balance']) ? $data['closing_balance'] : null;
        $this->container['annual_income_recognition'] = isset($data['annual_income_recognition']) ? $data['annual_income_recognition'] : null;
        $this->container['annual_deduction'] = isset($data['annual_deduction']) ? $data['annual_deduction'] : null;
        $this->container['amount_to_be_posted_on_income_recognition_account'] = isset($data['amount_to_be_posted_on_income_recognition_account']) ? $data['amount_to_be_posted_on_income_recognition_account'] : null;
        $this->container['amount_to_be_posted_on_deduction_account'] = isset($data['amount_to_be_posted_on_deduction_account']) ? $data['amount_to_be_posted_on_deduction_account'] : null;
        $this->container['generic_data_overviews'] = isset($data['generic_data_overviews']) ? $data['generic_data_overviews'] : null;
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
     * Gets sum_profit
     *
     * @return float
     */
    public function getSumProfit()
    {
        return $this->container['sum_profit'];
    }

    /**
     * Sets sum_profit
     *
     * @param float $sum_profit sum_profit
     *
     * @return $this
     */
    public function setSumProfit($sum_profit)
    {
        $this->container['sum_profit'] = $sum_profit;

        return $this;
    }

    /**
     * Gets sum_loss
     *
     * @return float
     */
    public function getSumLoss()
    {
        return $this->container['sum_loss'];
    }

    /**
     * Sets sum_loss
     *
     * @param float $sum_loss sum_loss
     *
     * @return $this
     */
    public function setSumLoss($sum_loss)
    {
        $this->container['sum_loss'] = $sum_loss;

        return $this;
    }

    /**
     * Gets sum_profit_and_loss
     *
     * @return float
     */
    public function getSumProfitAndLoss()
    {
        return $this->container['sum_profit_and_loss'];
    }

    /**
     * Sets sum_profit_and_loss
     *
     * @param float $sum_profit_and_loss sum_profit_and_loss
     *
     * @return $this
     */
    public function setSumProfitAndLoss($sum_profit_and_loss)
    {
        $this->container['sum_profit_and_loss'] = $sum_profit_and_loss;

        return $this;
    }

    /**
     * Gets opening_balance
     *
     * @return float
     */
    public function getOpeningBalance()
    {
        return $this->container['opening_balance'];
    }

    /**
     * Sets opening_balance
     *
     * @param float $opening_balance opening_balance
     *
     * @return $this
     */
    public function setOpeningBalance($opening_balance)
    {
        $this->container['opening_balance'] = $opening_balance;

        return $this;
    }

    /**
     * Gets opening_balance_profit
     *
     * @return float
     */
    public function getOpeningBalanceProfit()
    {
        return $this->container['opening_balance_profit'];
    }

    /**
     * Sets opening_balance_profit
     *
     * @param float $opening_balance_profit opening_balance_profit
     *
     * @return $this
     */
    public function setOpeningBalanceProfit($opening_balance_profit)
    {
        $this->container['opening_balance_profit'] = $opening_balance_profit;

        return $this;
    }

    /**
     * Gets opening_balance_loss
     *
     * @return float
     */
    public function getOpeningBalanceLoss()
    {
        return $this->container['opening_balance_loss'];
    }

    /**
     * Sets opening_balance_loss
     *
     * @param float $opening_balance_loss opening_balance_loss
     *
     * @return $this
     */
    public function setOpeningBalanceLoss($opening_balance_loss)
    {
        $this->container['opening_balance_loss'] = $opening_balance_loss;

        return $this;
    }

    /**
     * Gets closing_balance_profit
     *
     * @return float
     */
    public function getClosingBalanceProfit()
    {
        return $this->container['closing_balance_profit'];
    }

    /**
     * Sets closing_balance_profit
     *
     * @param float $closing_balance_profit closing_balance_profit
     *
     * @return $this
     */
    public function setClosingBalanceProfit($closing_balance_profit)
    {
        $this->container['closing_balance_profit'] = $closing_balance_profit;

        return $this;
    }

    /**
     * Gets closing_balance_loss
     *
     * @return float
     */
    public function getClosingBalanceLoss()
    {
        return $this->container['closing_balance_loss'];
    }

    /**
     * Sets closing_balance_loss
     *
     * @param float $closing_balance_loss closing_balance_loss
     *
     * @return $this
     */
    public function setClosingBalanceLoss($closing_balance_loss)
    {
        $this->container['closing_balance_loss'] = $closing_balance_loss;

        return $this;
    }

    /**
     * Gets posted_opening_balance_profit
     *
     * @return float
     */
    public function getPostedOpeningBalanceProfit()
    {
        return $this->container['posted_opening_balance_profit'];
    }

    /**
     * Sets posted_opening_balance_profit
     *
     * @param float $posted_opening_balance_profit posted_opening_balance_profit
     *
     * @return $this
     */
    public function setPostedOpeningBalanceProfit($posted_opening_balance_profit)
    {
        $this->container['posted_opening_balance_profit'] = $posted_opening_balance_profit;

        return $this;
    }

    /**
     * Gets posted_opening_balance_loss
     *
     * @return float
     */
    public function getPostedOpeningBalanceLoss()
    {
        return $this->container['posted_opening_balance_loss'];
    }

    /**
     * Sets posted_opening_balance_loss
     *
     * @param float $posted_opening_balance_loss posted_opening_balance_loss
     *
     * @return $this
     */
    public function setPostedOpeningBalanceLoss($posted_opening_balance_loss)
    {
        $this->container['posted_opening_balance_loss'] = $posted_opening_balance_loss;

        return $this;
    }

    /**
     * Gets posted_closing_balance_profit
     *
     * @return float
     */
    public function getPostedClosingBalanceProfit()
    {
        return $this->container['posted_closing_balance_profit'];
    }

    /**
     * Sets posted_closing_balance_profit
     *
     * @param float $posted_closing_balance_profit posted_closing_balance_profit
     *
     * @return $this
     */
    public function setPostedClosingBalanceProfit($posted_closing_balance_profit)
    {
        $this->container['posted_closing_balance_profit'] = $posted_closing_balance_profit;

        return $this;
    }

    /**
     * Gets posted_closing_balance_loss
     *
     * @return float
     */
    public function getPostedClosingBalanceLoss()
    {
        return $this->container['posted_closing_balance_loss'];
    }

    /**
     * Sets posted_closing_balance_loss
     *
     * @param float $posted_closing_balance_loss posted_closing_balance_loss
     *
     * @return $this
     */
    public function setPostedClosingBalanceLoss($posted_closing_balance_loss)
    {
        $this->container['posted_closing_balance_loss'] = $posted_closing_balance_loss;

        return $this;
    }

    /**
     * Gets closing_balance
     *
     * @return float
     */
    public function getClosingBalance()
    {
        return $this->container['closing_balance'];
    }

    /**
     * Sets closing_balance
     *
     * @param float $closing_balance closing_balance
     *
     * @return $this
     */
    public function setClosingBalance($closing_balance)
    {
        $this->container['closing_balance'] = $closing_balance;

        return $this;
    }

    /**
     * Gets annual_income_recognition
     *
     * @return float
     */
    public function getAnnualIncomeRecognition()
    {
        return $this->container['annual_income_recognition'];
    }

    /**
     * Sets annual_income_recognition
     *
     * @param float $annual_income_recognition annual_income_recognition
     *
     * @return $this
     */
    public function setAnnualIncomeRecognition($annual_income_recognition)
    {
        $this->container['annual_income_recognition'] = $annual_income_recognition;

        return $this;
    }

    /**
     * Gets annual_deduction
     *
     * @return float
     */
    public function getAnnualDeduction()
    {
        return $this->container['annual_deduction'];
    }

    /**
     * Sets annual_deduction
     *
     * @param float $annual_deduction annual_deduction
     *
     * @return $this
     */
    public function setAnnualDeduction($annual_deduction)
    {
        $this->container['annual_deduction'] = $annual_deduction;

        return $this;
    }

    /**
     * Gets amount_to_be_posted_on_income_recognition_account
     *
     * @return float
     */
    public function getAmountToBePostedOnIncomeRecognitionAccount()
    {
        return $this->container['amount_to_be_posted_on_income_recognition_account'];
    }

    /**
     * Sets amount_to_be_posted_on_income_recognition_account
     *
     * @param float $amount_to_be_posted_on_income_recognition_account amount_to_be_posted_on_income_recognition_account
     *
     * @return $this
     */
    public function setAmountToBePostedOnIncomeRecognitionAccount($amount_to_be_posted_on_income_recognition_account)
    {
        $this->container['amount_to_be_posted_on_income_recognition_account'] = $amount_to_be_posted_on_income_recognition_account;

        return $this;
    }

    /**
     * Gets amount_to_be_posted_on_deduction_account
     *
     * @return float
     */
    public function getAmountToBePostedOnDeductionAccount()
    {
        return $this->container['amount_to_be_posted_on_deduction_account'];
    }

    /**
     * Sets amount_to_be_posted_on_deduction_account
     *
     * @param float $amount_to_be_posted_on_deduction_account amount_to_be_posted_on_deduction_account
     *
     * @return $this
     */
    public function setAmountToBePostedOnDeductionAccount($amount_to_be_posted_on_deduction_account)
    {
        $this->container['amount_to_be_posted_on_deduction_account'] = $amount_to_be_posted_on_deduction_account;

        return $this;
    }

    /**
     * Gets generic_data_overviews
     *
     * @return \Learnist\Tripletex\Model\GenericDataOverview[]
     */
    public function getGenericDataOverviews()
    {
        return $this->container['generic_data_overviews'];
    }

    /**
     * Sets generic_data_overviews
     *
     * @param \Learnist\Tripletex\Model\GenericDataOverview[] $generic_data_overviews generic_data_overviews
     *
     * @return $this
     */
    public function setGenericDataOverviews($generic_data_overviews)
    {
        $this->container['generic_data_overviews'] = $generic_data_overviews;

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
