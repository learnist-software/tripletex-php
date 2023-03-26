<?php
/**
 * YearEndReport
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
 * YearEndReport Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class YearEndReport implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'YearEndReport';

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
        'wealth_from_business_activity' => '\Learnist\Tripletex\Model\YearEndReportType'
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
        'wealth_from_business_activity' => null
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
		'year' => false,
		'sent_date' => false,
		'year_end_report_basic_data' => false,
		'status' => false,
		'altinn_metadata' => false,
		'submission_result' => false,
		'submission_in_progress' => false,
		'submission_attempt_date' => false,
		'annual_result' => false,
		'asset' => false,
		'equity_and_debt' => false,
		'operating_revenue' => false,
		'operating_expense' => false,
		'capital_income' => false,
		'capital_cost' => false,
		'extraordinary_cost' => false,
		'tax_cost' => false,
		'fixed_asset' => false,
		'current_asset' => false,
		'equity' => false,
		'debt' => false,
		'current_debt' => false,
		'inventories' => false,
		'year_end_report_posting' => false,
		'tangible_fixed_assets' => false,
		'wealth_from_business_activity' => false
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
        'wealth_from_business_activity' => 'wealthFromBusinessActivity'
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
        'wealth_from_business_activity' => 'setWealthFromBusinessActivity'
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
        'wealth_from_business_activity' => 'getWealthFromBusinessActivity'
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

    public const STATUS_STARTED = 'STARTED';
    public const STATUS_UPDATED = 'UPDATED';
    public const STATUS_RESTARTED = 'RESTARTED';
    public const STATUS_COMPLEMENTARY_DATA_DOWNLOADED = 'COMPLEMENTARY_DATA_DOWNLOADED';
    public const STATUS_COMPLEMENTARY_DATA_MODIFIED = 'COMPLEMENTARY_DATA_MODIFIED';
    public const STATUS_PREVALIDATED_ACCEPTED = 'PREVALIDATED_ACCEPTED';
    public const STATUS_PREVALIDATED_DECLINED = 'PREVALIDATED_DECLINED';
    public const STATUS_ALTINN_INSTANCE_CREATED_AND_INITIATED = 'ALTINN_INSTANCE_CREATED_AND_INITIATED';
    public const STATUS_ALTINN_INSTANCE_MAIN_CONTENT_UPLOADED = 'ALTINN_INSTANCE_MAIN_CONTENT_UPLOADED';
    public const STATUS_ALTINN_INSTANCE_CLOSED = 'ALTINN_INSTANCE_CLOSED';
    public const STATUS_ALTINN_INSTANCE_APPROVED_FOR_TRANSFER = 'ALTINN_INSTANCE_APPROVED_FOR_TRANSFER';
    public const STATUS_CONTENT_PROCESSING_AT_RECIPIENT = 'CONTENT_PROCESSING_AT_RECIPIENT';
    public const STATUS_ALTINN_INSTANCE_HAS_FEEDBACK = 'ALTINN_INSTANCE_HAS_FEEDBACK';
    public const STATUS_FEEDBACK_ACCEPTED = 'FEEDBACK_ACCEPTED';
    public const STATUS_FEEDBACK_DECLINED = 'FEEDBACK_DECLINED';
    public const STATUS_USER_MARKED_AS_DELIVERED = 'USER_MARKED_AS_DELIVERED';

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
            self::STATUS_USER_MARKED_AS_DELIVERED,
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('year', $data ?? [], null);
        $this->setIfExists('sent_date', $data ?? [], null);
        $this->setIfExists('year_end_report_basic_data', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('altinn_metadata', $data ?? [], null);
        $this->setIfExists('submission_result', $data ?? [], null);
        $this->setIfExists('submission_in_progress', $data ?? [], null);
        $this->setIfExists('submission_attempt_date', $data ?? [], null);
        $this->setIfExists('annual_result', $data ?? [], null);
        $this->setIfExists('asset', $data ?? [], null);
        $this->setIfExists('equity_and_debt', $data ?? [], null);
        $this->setIfExists('operating_revenue', $data ?? [], null);
        $this->setIfExists('operating_expense', $data ?? [], null);
        $this->setIfExists('capital_income', $data ?? [], null);
        $this->setIfExists('capital_cost', $data ?? [], null);
        $this->setIfExists('extraordinary_cost', $data ?? [], null);
        $this->setIfExists('tax_cost', $data ?? [], null);
        $this->setIfExists('fixed_asset', $data ?? [], null);
        $this->setIfExists('current_asset', $data ?? [], null);
        $this->setIfExists('equity', $data ?? [], null);
        $this->setIfExists('debt', $data ?? [], null);
        $this->setIfExists('current_debt', $data ?? [], null);
        $this->setIfExists('inventories', $data ?? [], null);
        $this->setIfExists('year_end_report_posting', $data ?? [], null);
        $this->setIfExists('tangible_fixed_assets', $data ?? [], null);
        $this->setIfExists('wealth_from_business_activity', $data ?? [], null);
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

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
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
     * Gets year
     *
     * @return int|null
     */
    public function getYear()
    {
        return $this->container['year'];
    }

    /**
     * Sets year
     *
     * @param int|null $year year
     *
     * @return self
     */
    public function setYear($year)
    {

        if (is_null($year)) {
            throw new \InvalidArgumentException('non-nullable year cannot be null');
        }

        $this->container['year'] = $year;

        return $this;
    }

    /**
     * Gets sent_date
     *
     * @return string|null
     */
    public function getSentDate()
    {
        return $this->container['sent_date'];
    }

    /**
     * Sets sent_date
     *
     * @param string|null $sent_date sent_date
     *
     * @return self
     */
    public function setSentDate($sent_date)
    {

        if (is_null($sent_date)) {
            throw new \InvalidArgumentException('non-nullable sent_date cannot be null');
        }

        $this->container['sent_date'] = $sent_date;

        return $this;
    }

    /**
     * Gets year_end_report_basic_data
     *
     * @return \Learnist\Tripletex\Model\BasicData|null
     */
    public function getYearEndReportBasicData()
    {
        return $this->container['year_end_report_basic_data'];
    }

    /**
     * Sets year_end_report_basic_data
     *
     * @param \Learnist\Tripletex\Model\BasicData|null $year_end_report_basic_data year_end_report_basic_data
     *
     * @return self
     */
    public function setYearEndReportBasicData($year_end_report_basic_data)
    {

        if (is_null($year_end_report_basic_data)) {
            throw new \InvalidArgumentException('non-nullable year_end_report_basic_data cannot be null');
        }

        $this->container['year_end_report_basic_data'] = $year_end_report_basic_data;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }

        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets altinn_metadata
     *
     * @return \Learnist\Tripletex\Model\AltinnInstance|null
     */
    public function getAltinnMetadata()
    {
        return $this->container['altinn_metadata'];
    }

    /**
     * Sets altinn_metadata
     *
     * @param \Learnist\Tripletex\Model\AltinnInstance|null $altinn_metadata altinn_metadata
     *
     * @return self
     */
    public function setAltinnMetadata($altinn_metadata)
    {

        if (is_null($altinn_metadata)) {
            throw new \InvalidArgumentException('non-nullable altinn_metadata cannot be null');
        }

        $this->container['altinn_metadata'] = $altinn_metadata;

        return $this;
    }

    /**
     * Gets submission_result
     *
     * @return \Learnist\Tripletex\Model\YearEndSubmissionResult|null
     */
    public function getSubmissionResult()
    {
        return $this->container['submission_result'];
    }

    /**
     * Sets submission_result
     *
     * @param \Learnist\Tripletex\Model\YearEndSubmissionResult|null $submission_result submission_result
     *
     * @return self
     */
    public function setSubmissionResult($submission_result)
    {

        if (is_null($submission_result)) {
            throw new \InvalidArgumentException('non-nullable submission_result cannot be null');
        }

        $this->container['submission_result'] = $submission_result;

        return $this;
    }

    /**
     * Gets submission_in_progress
     *
     * @return bool|null
     */
    public function getSubmissionInProgress()
    {
        return $this->container['submission_in_progress'];
    }

    /**
     * Sets submission_in_progress
     *
     * @param bool|null $submission_in_progress submission_in_progress
     *
     * @return self
     */
    public function setSubmissionInProgress($submission_in_progress)
    {

        if (is_null($submission_in_progress)) {
            throw new \InvalidArgumentException('non-nullable submission_in_progress cannot be null');
        }

        $this->container['submission_in_progress'] = $submission_in_progress;

        return $this;
    }

    /**
     * Gets submission_attempt_date
     *
     * @return string|null
     */
    public function getSubmissionAttemptDate()
    {
        return $this->container['submission_attempt_date'];
    }

    /**
     * Sets submission_attempt_date
     *
     * @param string|null $submission_attempt_date submission_attempt_date
     *
     * @return self
     */
    public function setSubmissionAttemptDate($submission_attempt_date)
    {

        if (is_null($submission_attempt_date)) {
            throw new \InvalidArgumentException('non-nullable submission_attempt_date cannot be null');
        }

        $this->container['submission_attempt_date'] = $submission_attempt_date;

        return $this;
    }

    /**
     * Gets annual_result
     *
     * @return float|null
     */
    public function getAnnualResult()
    {
        return $this->container['annual_result'];
    }

    /**
     * Sets annual_result
     *
     * @param float|null $annual_result annual_result
     *
     * @return self
     */
    public function setAnnualResult($annual_result)
    {

        if (is_null($annual_result)) {
            throw new \InvalidArgumentException('non-nullable annual_result cannot be null');
        }

        $this->container['annual_result'] = $annual_result;

        return $this;
    }

    /**
     * Gets asset
     *
     * @return float|null
     */
    public function getAsset()
    {
        return $this->container['asset'];
    }

    /**
     * Sets asset
     *
     * @param float|null $asset asset
     *
     * @return self
     */
    public function setAsset($asset)
    {

        if (is_null($asset)) {
            throw new \InvalidArgumentException('non-nullable asset cannot be null');
        }

        $this->container['asset'] = $asset;

        return $this;
    }

    /**
     * Gets equity_and_debt
     *
     * @return float|null
     */
    public function getEquityAndDebt()
    {
        return $this->container['equity_and_debt'];
    }

    /**
     * Sets equity_and_debt
     *
     * @param float|null $equity_and_debt equity_and_debt
     *
     * @return self
     */
    public function setEquityAndDebt($equity_and_debt)
    {

        if (is_null($equity_and_debt)) {
            throw new \InvalidArgumentException('non-nullable equity_and_debt cannot be null');
        }

        $this->container['equity_and_debt'] = $equity_and_debt;

        return $this;
    }

    /**
     * Gets operating_revenue
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getOperatingRevenue()
    {
        return $this->container['operating_revenue'];
    }

    /**
     * Sets operating_revenue
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $operating_revenue operating_revenue
     *
     * @return self
     */
    public function setOperatingRevenue($operating_revenue)
    {

        if (is_null($operating_revenue)) {
            throw new \InvalidArgumentException('non-nullable operating_revenue cannot be null');
        }

        $this->container['operating_revenue'] = $operating_revenue;

        return $this;
    }

    /**
     * Gets operating_expense
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getOperatingExpense()
    {
        return $this->container['operating_expense'];
    }

    /**
     * Sets operating_expense
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $operating_expense operating_expense
     *
     * @return self
     */
    public function setOperatingExpense($operating_expense)
    {

        if (is_null($operating_expense)) {
            throw new \InvalidArgumentException('non-nullable operating_expense cannot be null');
        }

        $this->container['operating_expense'] = $operating_expense;

        return $this;
    }

    /**
     * Gets capital_income
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getCapitalIncome()
    {
        return $this->container['capital_income'];
    }

    /**
     * Sets capital_income
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $capital_income capital_income
     *
     * @return self
     */
    public function setCapitalIncome($capital_income)
    {

        if (is_null($capital_income)) {
            throw new \InvalidArgumentException('non-nullable capital_income cannot be null');
        }

        $this->container['capital_income'] = $capital_income;

        return $this;
    }

    /**
     * Gets capital_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getCapitalCost()
    {
        return $this->container['capital_cost'];
    }

    /**
     * Sets capital_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $capital_cost capital_cost
     *
     * @return self
     */
    public function setCapitalCost($capital_cost)
    {

        if (is_null($capital_cost)) {
            throw new \InvalidArgumentException('non-nullable capital_cost cannot be null');
        }

        $this->container['capital_cost'] = $capital_cost;

        return $this;
    }

    /**
     * Gets extraordinary_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getExtraordinaryCost()
    {
        return $this->container['extraordinary_cost'];
    }

    /**
     * Sets extraordinary_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $extraordinary_cost extraordinary_cost
     *
     * @return self
     */
    public function setExtraordinaryCost($extraordinary_cost)
    {

        if (is_null($extraordinary_cost)) {
            throw new \InvalidArgumentException('non-nullable extraordinary_cost cannot be null');
        }

        $this->container['extraordinary_cost'] = $extraordinary_cost;

        return $this;
    }

    /**
     * Gets tax_cost
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getTaxCost()
    {
        return $this->container['tax_cost'];
    }

    /**
     * Sets tax_cost
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $tax_cost tax_cost
     *
     * @return self
     */
    public function setTaxCost($tax_cost)
    {

        if (is_null($tax_cost)) {
            throw new \InvalidArgumentException('non-nullable tax_cost cannot be null');
        }

        $this->container['tax_cost'] = $tax_cost;

        return $this;
    }

    /**
     * Gets fixed_asset
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getFixedAsset()
    {
        return $this->container['fixed_asset'];
    }

    /**
     * Sets fixed_asset
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $fixed_asset fixed_asset
     *
     * @return self
     */
    public function setFixedAsset($fixed_asset)
    {

        if (is_null($fixed_asset)) {
            throw new \InvalidArgumentException('non-nullable fixed_asset cannot be null');
        }

        $this->container['fixed_asset'] = $fixed_asset;

        return $this;
    }

    /**
     * Gets current_asset
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getCurrentAsset()
    {
        return $this->container['current_asset'];
    }

    /**
     * Sets current_asset
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $current_asset current_asset
     *
     * @return self
     */
    public function setCurrentAsset($current_asset)
    {

        if (is_null($current_asset)) {
            throw new \InvalidArgumentException('non-nullable current_asset cannot be null');
        }

        $this->container['current_asset'] = $current_asset;

        return $this;
    }

    /**
     * Gets equity
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getEquity()
    {
        return $this->container['equity'];
    }

    /**
     * Sets equity
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $equity equity
     *
     * @return self
     */
    public function setEquity($equity)
    {

        if (is_null($equity)) {
            throw new \InvalidArgumentException('non-nullable equity cannot be null');
        }

        $this->container['equity'] = $equity;

        return $this;
    }

    /**
     * Gets debt
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getDebt()
    {
        return $this->container['debt'];
    }

    /**
     * Sets debt
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $debt debt
     *
     * @return self
     */
    public function setDebt($debt)
    {

        if (is_null($debt)) {
            throw new \InvalidArgumentException('non-nullable debt cannot be null');
        }

        $this->container['debt'] = $debt;

        return $this;
    }

    /**
     * Gets current_debt
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getCurrentDebt()
    {
        return $this->container['current_debt'];
    }

    /**
     * Sets current_debt
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $current_debt current_debt
     *
     * @return self
     */
    public function setCurrentDebt($current_debt)
    {

        if (is_null($current_debt)) {
            throw new \InvalidArgumentException('non-nullable current_debt cannot be null');
        }

        $this->container['current_debt'] = $current_debt;

        return $this;
    }

    /**
     * Gets inventories
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getInventories()
    {
        return $this->container['inventories'];
    }

    /**
     * Sets inventories
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $inventories inventories
     *
     * @return self
     */
    public function setInventories($inventories)
    {

        if (is_null($inventories)) {
            throw new \InvalidArgumentException('non-nullable inventories cannot be null');
        }

        $this->container['inventories'] = $inventories;

        return $this;
    }

    /**
     * Gets year_end_report_posting
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getYearEndReportPosting()
    {
        return $this->container['year_end_report_posting'];
    }

    /**
     * Sets year_end_report_posting
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $year_end_report_posting year_end_report_posting
     *
     * @return self
     */
    public function setYearEndReportPosting($year_end_report_posting)
    {

        if (is_null($year_end_report_posting)) {
            throw new \InvalidArgumentException('non-nullable year_end_report_posting cannot be null');
        }

        $this->container['year_end_report_posting'] = $year_end_report_posting;

        return $this;
    }

    /**
     * Gets tangible_fixed_assets
     *
     * @return \Learnist\Tripletex\Model\TangibleFixedAsset[]|null
     */
    public function getTangibleFixedAssets()
    {
        return $this->container['tangible_fixed_assets'];
    }

    /**
     * Sets tangible_fixed_assets
     *
     * @param \Learnist\Tripletex\Model\TangibleFixedAsset[]|null $tangible_fixed_assets tangible_fixed_assets
     *
     * @return self
     */
    public function setTangibleFixedAssets($tangible_fixed_assets)
    {

        if (is_null($tangible_fixed_assets)) {
            throw new \InvalidArgumentException('non-nullable tangible_fixed_assets cannot be null');
        }

        $this->container['tangible_fixed_assets'] = $tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets wealth_from_business_activity
     *
     * @return \Learnist\Tripletex\Model\YearEndReportType|null
     */
    public function getWealthFromBusinessActivity()
    {
        return $this->container['wealth_from_business_activity'];
    }

    /**
     * Sets wealth_from_business_activity
     *
     * @param \Learnist\Tripletex\Model\YearEndReportType|null $wealth_from_business_activity wealth_from_business_activity
     *
     * @return self
     */
    public function setWealthFromBusinessActivity($wealth_from_business_activity)
    {

        if (is_null($wealth_from_business_activity)) {
            throw new \InvalidArgumentException('non-nullable wealth_from_business_activity cannot be null');
        }

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


