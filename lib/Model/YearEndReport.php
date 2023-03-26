<?php
/**
 * YearEndReport
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
 * YearEndReport Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class YearEndReport implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'YearEndReport';

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
'year_end_report_basic_data' => '\Learnist\Tripletex\Model\BasicData',
'status' => 'string',
'altinn_metadata' => '\Learnist\Tripletex\Model\AltinnInstance',
'submission_result' => '\Learnist\Tripletex\Model\YearEndSubmissionResult',
'submission_in_progress' => 'bool',
'submission_attempt_date' => 'string',
'annual_result' => 'float',
'asset' => 'float',
'equity_and_debt' => 'float',
'operating_revenue' => '\Learnist\Tripletex\Model\YearEndReportType',
'operating_expense' => '\Learnist\Tripletex\Model\YearEndReportType',
'capital_income' => '\Learnist\Tripletex\Model\YearEndReportType',
'capital_cost' => '\Learnist\Tripletex\Model\YearEndReportType',
'extraordinary_cost' => '\Learnist\Tripletex\Model\YearEndReportType',
'tax_cost' => '\Learnist\Tripletex\Model\YearEndReportType',
'fixed_asset' => '\Learnist\Tripletex\Model\YearEndReportType',
'current_asset' => '\Learnist\Tripletex\Model\YearEndReportType',
'equity' => '\Learnist\Tripletex\Model\YearEndReportType',
'debt' => '\Learnist\Tripletex\Model\YearEndReportType',
'current_debt' => '\Learnist\Tripletex\Model\YearEndReportType',
'inventories' => '\Learnist\Tripletex\Model\YearEndReportType',
'year_end_report_posting' => '\Learnist\Tripletex\Model\YearEndReportType',
'tangible_fixed_assets' => '\Learnist\Tripletex\Model\TangibleFixedAsset[]',
'wealth_from_business_activity' => '\Learnist\Tripletex\Model\YearEndReportType'    ];

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
'year_end_report_basic_data' => null,
'status' => null,
'altinn_metadata' => null,
'submission_result' => null,
'submission_in_progress' => null,
'submission_attempt_date' => null,
'annual_result' => null,
'asset' => null,
'equity_and_debt' => null,
'operating_revenue' => null,
'operating_expense' => null,
'capital_income' => null,
'capital_cost' => null,
'extraordinary_cost' => null,
'tax_cost' => null,
'fixed_asset' => null,
'current_asset' => null,
'equity' => null,
'debt' => null,
'current_debt' => null,
'inventories' => null,
'year_end_report_posting' => null,
'tangible_fixed_assets' => null,
'wealth_from_business_activity' => null    ];

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
'year_end_report_basic_data' => 'yearEndReportBasicData',
'status' => 'status',
'altinn_metadata' => 'altinnMetadata',
'submission_result' => 'submissionResult',
'submission_in_progress' => 'submissionInProgress',
'submission_attempt_date' => 'submissionAttemptDate',
'annual_result' => 'annualResult',
'asset' => 'asset',
'equity_and_debt' => 'equityAndDebt',
'operating_revenue' => 'operatingRevenue',
'operating_expense' => 'operatingExpense',
'capital_income' => 'capitalIncome',
'capital_cost' => 'capitalCost',
'extraordinary_cost' => 'extraordinaryCost',
'tax_cost' => 'taxCost',
'fixed_asset' => 'fixedAsset',
'current_asset' => 'currentAsset',
'equity' => 'equity',
'debt' => 'debt',
'current_debt' => 'currentDebt',
'inventories' => 'inventories',
'year_end_report_posting' => 'yearEndReportPosting',
'tangible_fixed_assets' => 'tangibleFixedAssets',
'wealth_from_business_activity' => 'wealthFromBusinessActivity'    ];

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
'year_end_report_basic_data' => 'setYearEndReportBasicData',
'status' => 'setStatus',
'altinn_metadata' => 'setAltinnMetadata',
'submission_result' => 'setSubmissionResult',
'submission_in_progress' => 'setSubmissionInProgress',
'submission_attempt_date' => 'setSubmissionAttemptDate',
'annual_result' => 'setAnnualResult',
'asset' => 'setAsset',
'equity_and_debt' => 'setEquityAndDebt',
'operating_revenue' => 'setOperatingRevenue',
'operating_expense' => 'setOperatingExpense',
'capital_income' => 'setCapitalIncome',
'capital_cost' => 'setCapitalCost',
'extraordinary_cost' => 'setExtraordinaryCost',
'tax_cost' => 'setTaxCost',
'fixed_asset' => 'setFixedAsset',
'current_asset' => 'setCurrentAsset',
'equity' => 'setEquity',
'debt' => 'setDebt',
'current_debt' => 'setCurrentDebt',
'inventories' => 'setInventories',
'year_end_report_posting' => 'setYearEndReportPosting',
'tangible_fixed_assets' => 'setTangibleFixedAssets',
'wealth_from_business_activity' => 'setWealthFromBusinessActivity'    ];

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
'year_end_report_basic_data' => 'getYearEndReportBasicData',
'status' => 'getStatus',
'altinn_metadata' => 'getAltinnMetadata',
'submission_result' => 'getSubmissionResult',
'submission_in_progress' => 'getSubmissionInProgress',
'submission_attempt_date' => 'getSubmissionAttemptDate',
'annual_result' => 'getAnnualResult',
'asset' => 'getAsset',
'equity_and_debt' => 'getEquityAndDebt',
'operating_revenue' => 'getOperatingRevenue',
'operating_expense' => 'getOperatingExpense',
'capital_income' => 'getCapitalIncome',
'capital_cost' => 'getCapitalCost',
'extraordinary_cost' => 'getExtraordinaryCost',
'tax_cost' => 'getTaxCost',
'fixed_asset' => 'getFixedAsset',
'current_asset' => 'getCurrentAsset',
'equity' => 'getEquity',
'debt' => 'getDebt',
'current_debt' => 'getCurrentDebt',
'inventories' => 'getInventories',
'year_end_report_posting' => 'getYearEndReportPosting',
'tangible_fixed_assets' => 'getTangibleFixedAssets',
'wealth_from_business_activity' => 'getWealthFromBusinessActivity'    ];

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
const STATUS_COMPLEMENTARY_DATA_DOWNLOADED = 'COMPLEMENTARY_DATA_DOWNLOADED';
const STATUS_COMPLEMENTARY_DATA_MODIFIED = 'COMPLEMENTARY_DATA_MODIFIED';
const STATUS_PREVALIDATED_ACCEPTED = 'PREVALIDATED_ACCEPTED';
const STATUS_PREVALIDATED_DECLINED = 'PREVALIDATED_DECLINED';
const STATUS_ALTINN_INSTANCE_CREATED_AND_INITIATED = 'ALTINN_INSTANCE_CREATED_AND_INITIATED';
const STATUS_ALTINN_INSTANCE_MAIN_CONTENT_UPLOADED = 'ALTINN_INSTANCE_MAIN_CONTENT_UPLOADED';
const STATUS_ALTINN_INSTANCE_CLOSED = 'ALTINN_INSTANCE_CLOSED';
const STATUS_ALTINN_INSTANCE_APPROVED_FOR_TRANSFER = 'ALTINN_INSTANCE_APPROVED_FOR_TRANSFER';
const STATUS_CONTENT_PROCESSING_AT_RECIPIENT = 'CONTENT_PROCESSING_AT_RECIPIENT';
const STATUS_ALTINN_INSTANCE_HAS_FEEDBACK = 'ALTINN_INSTANCE_HAS_FEEDBACK';
const STATUS_FEEDBACK_ACCEPTED = 'FEEDBACK_ACCEPTED';
const STATUS_FEEDBACK_DECLINED = 'FEEDBACK_DECLINED';
const STATUS_USER_MARKED_AS_DELIVERED = 'USER_MARKED_AS_DELIVERED';

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
self::STATUS_COMPLEMENTARY_DATA_DOWNLOADED,
self::STATUS_COMPLEMENTARY_DATA_MODIFIED,
self::STATUS_PREVALIDATED_ACCEPTED,
self::STATUS_PREVALIDATED_DECLINED,
self::STATUS_ALTINN_INSTANCE_CREATED_AND_INITIATED,
self::STATUS_ALTINN_INSTANCE_MAIN_CONTENT_UPLOADED,
self::STATUS_ALTINN_INSTANCE_CLOSED,
self::STATUS_ALTINN_INSTANCE_APPROVED_FOR_TRANSFER,
self::STATUS_CONTENT_PROCESSING_AT_RECIPIENT,
self::STATUS_ALTINN_INSTANCE_HAS_FEEDBACK,
self::STATUS_FEEDBACK_ACCEPTED,
self::STATUS_FEEDBACK_DECLINED,
self::STATUS_USER_MARKED_AS_DELIVERED,        ];
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
        $this->container['year_end_report_basic_data'] = isset($data['year_end_report_basic_data']) ? $data['year_end_report_basic_data'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['altinn_metadata'] = isset($data['altinn_metadata']) ? $data['altinn_metadata'] : null;
        $this->container['submission_result'] = isset($data['submission_result']) ? $data['submission_result'] : null;
        $this->container['submission_in_progress'] = isset($data['submission_in_progress']) ? $data['submission_in_progress'] : null;
        $this->container['submission_attempt_date'] = isset($data['submission_attempt_date']) ? $data['submission_attempt_date'] : null;
        $this->container['annual_result'] = isset($data['annual_result']) ? $data['annual_result'] : null;
        $this->container['asset'] = isset($data['asset']) ? $data['asset'] : null;
        $this->container['equity_and_debt'] = isset($data['equity_and_debt']) ? $data['equity_and_debt'] : null;
        $this->container['operating_revenue'] = isset($data['operating_revenue']) ? $data['operating_revenue'] : null;
        $this->container['operating_expense'] = isset($data['operating_expense']) ? $data['operating_expense'] : null;
        $this->container['capital_income'] = isset($data['capital_income']) ? $data['capital_income'] : null;
        $this->container['capital_cost'] = isset($data['capital_cost']) ? $data['capital_cost'] : null;
        $this->container['extraordinary_cost'] = isset($data['extraordinary_cost']) ? $data['extraordinary_cost'] : null;
        $this->container['tax_cost'] = isset($data['tax_cost']) ? $data['tax_cost'] : null;
        $this->container['fixed_asset'] = isset($data['fixed_asset']) ? $data['fixed_asset'] : null;
        $this->container['current_asset'] = isset($data['current_asset']) ? $data['current_asset'] : null;
        $this->container['equity'] = isset($data['equity']) ? $data['equity'] : null;
        $this->container['debt'] = isset($data['debt']) ? $data['debt'] : null;
        $this->container['current_debt'] = isset($data['current_debt']) ? $data['current_debt'] : null;
        $this->container['inventories'] = isset($data['inventories']) ? $data['inventories'] : null;
        $this->container['year_end_report_posting'] = isset($data['year_end_report_posting']) ? $data['year_end_report_posting'] : null;
        $this->container['tangible_fixed_assets'] = isset($data['tangible_fixed_assets']) ? $data['tangible_fixed_assets'] : null;
        $this->container['wealth_from_business_activity'] = isset($data['wealth_from_business_activity']) ? $data['wealth_from_business_activity'] : null;
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
     * Gets year_end_report_basic_data
     *
     * @return \Learnist\Tripletex\Model\BasicData
     */
    public function getYearEndReportBasicData()
    {
        return $this->container['year_end_report_basic_data'];
    }

    /**
     * Sets year_end_report_basic_data
     *
     * @param \Learnist\Tripletex\Model\BasicData $year_end_report_basic_data year_end_report_basic_data
     *
     * @return $this
     */
    public function setYearEndReportBasicData($year_end_report_basic_data)
    {
        $this->container['year_end_report_basic_data'] = $year_end_report_basic_data;

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
     * Gets altinn_metadata
     *
     * @return \Learnist\Tripletex\Model\AltinnInstance
     */
    public function getAltinnMetadata()
    {
        return $this->container['altinn_metadata'];
    }

    /**
     * Sets altinn_metadata
     *
     * @param \Learnist\Tripletex\Model\AltinnInstance $altinn_metadata altinn_metadata
     *
     * @return $this
     */
    public function setAltinnMetadata($altinn_metadata)
    {
        $this->container['altinn_metadata'] = $altinn_metadata;

        return $this;
    }

    /**
     * Gets submission_result
     *
     * @return \Learnist\Tripletex\Model\YearEndSubmissionResult
     */
    public function getSubmissionResult()
    {
        return $this->container['submission_result'];
    }

    /**
     * Sets submission_result
     *
     * @param \Learnist\Tripletex\Model\YearEndSubmissionResult $submission_result submission_result
     *
     * @return $this
     */
    public function setSubmissionResult($submission_result)
    {
        $this->container['submission_result'] = $submission_result;

        return $this;
    }

    /**
     * Gets submission_in_progress
     *
     * @return bool
     */
    public function getSubmissionInProgress()
    {
        return $this->container['submission_in_progress'];
    }

    /**
     * Sets submission_in_progress
     *
     * @param bool $submission_in_progress submission_in_progress
     *
     * @return $this
     */
    public function setSubmissionInProgress($submission_in_progress)
    {
        $this->container['submission_in_progress'] = $submission_in_progress;

        return $this;
    }

    /**
     * Gets submission_attempt_date
     *
     * @return string
     */
    public function getSubmissionAttemptDate()
    {
        return $this->container['submission_attempt_date'];
    }

    /**
     * Sets submission_attempt_date
     *
     * @param string $submission_attempt_date submission_attempt_date
     *
     * @return $this
     */
    public function setSubmissionAttemptDate($submission_attempt_date)
    {
        $this->container['submission_attempt_date'] = $submission_attempt_date;

        return $this;
    }

    /**
     * Gets annual_result
     *
     * @return float
     */
    public function getAnnualResult()
    {
        return $this->container['annual_result'];
    }

    /**
     * Sets annual_result
     *
     * @param float $annual_result annual_result
     *
     * @return $this
     */
    public function setAnnualResult($annual_result)
    {
        $this->container['annual_result'] = $annual_result;

        return $this;
    }

    /**
     * Gets asset
     *
     * @return float
     */
    public function getAsset()
    {
        return $this->container['asset'];
    }

    /**
     * Sets asset
     *
     * @param float $asset asset
     *
     * @return $this
     */
    public function setAsset($asset)
    {
        $this->container['asset'] = $asset;

        return $this;
    }

    /**
     * Gets equity_and_debt
     *
     * @return float
     */
    public function getEquityAndDebt()
    {
        return $this->container['equity_and_debt'];
    }

    /**
     * Sets equity_and_debt
     *
     * @param float $equity_and_debt equity_and_debt
     *
     * @return $this
     */
    public function setEquityAndDebt($equity_and_debt)
    {
        $this->container['equity_and_debt'] = $equity_and_debt;

        return $this;
    }

    /**
     * Gets operating_revenue
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getOperatingRevenue()
    {
        return $this->container['operating_revenue'];
    }

    /**
     * Sets operating_revenue
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $operating_revenue operating_revenue
     *
     * @return $this
     */
    public function setOperatingRevenue($operating_revenue)
    {
        $this->container['operating_revenue'] = $operating_revenue;

        return $this;
    }

    /**
     * Gets operating_expense
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getOperatingExpense()
    {
        return $this->container['operating_expense'];
    }

    /**
     * Sets operating_expense
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $operating_expense operating_expense
     *
     * @return $this
     */
    public function setOperatingExpense($operating_expense)
    {
        $this->container['operating_expense'] = $operating_expense;

        return $this;
    }

    /**
     * Gets capital_income
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getCapitalIncome()
    {
        return $this->container['capital_income'];
    }

    /**
     * Sets capital_income
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $capital_income capital_income
     *
     * @return $this
     */
    public function setCapitalIncome($capital_income)
    {
        $this->container['capital_income'] = $capital_income;

        return $this;
    }

    /**
     * Gets capital_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getCapitalCost()
    {
        return $this->container['capital_cost'];
    }

    /**
     * Sets capital_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $capital_cost capital_cost
     *
     * @return $this
     */
    public function setCapitalCost($capital_cost)
    {
        $this->container['capital_cost'] = $capital_cost;

        return $this;
    }

    /**
     * Gets extraordinary_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getExtraordinaryCost()
    {
        return $this->container['extraordinary_cost'];
    }

    /**
     * Sets extraordinary_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $extraordinary_cost extraordinary_cost
     *
     * @return $this
     */
    public function setExtraordinaryCost($extraordinary_cost)
    {
        $this->container['extraordinary_cost'] = $extraordinary_cost;

        return $this;
    }

    /**
     * Gets tax_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getTaxCost()
    {
        return $this->container['tax_cost'];
    }

    /**
     * Sets tax_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $tax_cost tax_cost
     *
     * @return $this
     */
    public function setTaxCost($tax_cost)
    {
        $this->container['tax_cost'] = $tax_cost;

        return $this;
    }

    /**
     * Gets fixed_asset
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getFixedAsset()
    {
        return $this->container['fixed_asset'];
    }

    /**
     * Sets fixed_asset
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $fixed_asset fixed_asset
     *
     * @return $this
     */
    public function setFixedAsset($fixed_asset)
    {
        $this->container['fixed_asset'] = $fixed_asset;

        return $this;
    }

    /**
     * Gets current_asset
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getCurrentAsset()
    {
        return $this->container['current_asset'];
    }

    /**
     * Sets current_asset
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $current_asset current_asset
     *
     * @return $this
     */
    public function setCurrentAsset($current_asset)
    {
        $this->container['current_asset'] = $current_asset;

        return $this;
    }

    /**
     * Gets equity
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getEquity()
    {
        return $this->container['equity'];
    }

    /**
     * Sets equity
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $equity equity
     *
     * @return $this
     */
    public function setEquity($equity)
    {
        $this->container['equity'] = $equity;

        return $this;
    }

    /**
     * Gets debt
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getDebt()
    {
        return $this->container['debt'];
    }

    /**
     * Sets debt
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $debt debt
     *
     * @return $this
     */
    public function setDebt($debt)
    {
        $this->container['debt'] = $debt;

        return $this;
    }

    /**
     * Gets current_debt
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getCurrentDebt()
    {
        return $this->container['current_debt'];
    }

    /**
     * Sets current_debt
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $current_debt current_debt
     *
     * @return $this
     */
    public function setCurrentDebt($current_debt)
    {
        $this->container['current_debt'] = $current_debt;

        return $this;
    }

    /**
     * Gets inventories
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getInventories()
    {
        return $this->container['inventories'];
    }

    /**
     * Sets inventories
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $inventories inventories
     *
     * @return $this
     */
    public function setInventories($inventories)
    {
        $this->container['inventories'] = $inventories;

        return $this;
    }

    /**
     * Gets year_end_report_posting
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getYearEndReportPosting()
    {
        return $this->container['year_end_report_posting'];
    }

    /**
     * Sets year_end_report_posting
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $year_end_report_posting year_end_report_posting
     *
     * @return $this
     */
    public function setYearEndReportPosting($year_end_report_posting)
    {
        $this->container['year_end_report_posting'] = $year_end_report_posting;

        return $this;
    }

    /**
     * Gets tangible_fixed_assets
     *
     * @return \Learnist\Tripletex\Model\TangibleFixedAsset[]
     */
    public function getTangibleFixedAssets()
    {
        return $this->container['tangible_fixed_assets'];
    }

    /**
     * Sets tangible_fixed_assets
     *
     * @param \Learnist\Tripletex\Model\TangibleFixedAsset[] $tangible_fixed_assets tangible_fixed_assets
     *
     * @return $this
     */
    public function setTangibleFixedAssets($tangible_fixed_assets)
    {
        $this->container['tangible_fixed_assets'] = $tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets wealth_from_business_activity
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType
     */
    public function getWealthFromBusinessActivity()
    {
        return $this->container['wealth_from_business_activity'];
    }

    /**
     * Sets wealth_from_business_activity
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType $wealth_from_business_activity wealth_from_business_activity
     *
     * @return $this
     */
    public function setWealthFromBusinessActivity($wealth_from_business_activity)
    {
        $this->container['wealth_from_business_activity'] = $wealth_from_business_activity;

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
