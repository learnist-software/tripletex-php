<?php
/**
 * GenericDataOverview
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
 * GenericDataOverview Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class GenericDataOverview implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'GenericDataOverview';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
'group_id' => 'int',
'generic_data_type' => 'string',
'generic_data_type_group_id' => 'int',
'posts' => '\Learnist\Tripletex\Model\GenericData[]',
'type_of_goods_posts' => '\Learnist\Tripletex\Model\TypeOfGoods[]',
'cash_register_system_posts' => '\Learnist\Tripletex\Model\CashRegisterSystem[]',
'calculated_deduction' => 'float',
'expenses' => 'float',
'reversed_expenses' => 'float',
'show_profit_and_loss_details' => 'bool',
'annual_income_recognition_or_deduction_basis' => 'float',
'annual_income_recognition' => 'float',
'annual_deduction' => 'float',
'sum_profit_and_loss' => 'float',
'opening_balance_profit_and_loss' => 'float',
'closing_balance_profit_and_loss' => 'float',
'object_identifier' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'year_end_report' => null,
'group_id' => 'int32',
'generic_data_type' => null,
'generic_data_type_group_id' => 'int32',
'posts' => null,
'type_of_goods_posts' => null,
'cash_register_system_posts' => null,
'calculated_deduction' => null,
'expenses' => null,
'reversed_expenses' => null,
'show_profit_and_loss_details' => null,
'annual_income_recognition_or_deduction_basis' => null,
'annual_income_recognition' => null,
'annual_deduction' => null,
'sum_profit_and_loss' => null,
'opening_balance_profit_and_loss' => null,
'closing_balance_profit_and_loss' => null,
'object_identifier' => null    ];

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
'group_id' => 'groupId',
'generic_data_type' => 'genericDataType',
'generic_data_type_group_id' => 'genericDataTypeGroupId',
'posts' => 'posts',
'type_of_goods_posts' => 'typeOfGoodsPosts',
'cash_register_system_posts' => 'cashRegisterSystemPosts',
'calculated_deduction' => 'calculatedDeduction',
'expenses' => 'expenses',
'reversed_expenses' => 'reversedExpenses',
'show_profit_and_loss_details' => 'showProfitAndLossDetails',
'annual_income_recognition_or_deduction_basis' => 'annualIncomeRecognitionOrDeductionBasis',
'annual_income_recognition' => 'annualIncomeRecognition',
'annual_deduction' => 'annualDeduction',
'sum_profit_and_loss' => 'sumProfitAndLoss',
'opening_balance_profit_and_loss' => 'openingBalanceProfitAndLoss',
'closing_balance_profit_and_loss' => 'closingBalanceProfitAndLoss',
'object_identifier' => 'objectIdentifier'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
'group_id' => 'setGroupId',
'generic_data_type' => 'setGenericDataType',
'generic_data_type_group_id' => 'setGenericDataTypeGroupId',
'posts' => 'setPosts',
'type_of_goods_posts' => 'setTypeOfGoodsPosts',
'cash_register_system_posts' => 'setCashRegisterSystemPosts',
'calculated_deduction' => 'setCalculatedDeduction',
'expenses' => 'setExpenses',
'reversed_expenses' => 'setReversedExpenses',
'show_profit_and_loss_details' => 'setShowProfitAndLossDetails',
'annual_income_recognition_or_deduction_basis' => 'setAnnualIncomeRecognitionOrDeductionBasis',
'annual_income_recognition' => 'setAnnualIncomeRecognition',
'annual_deduction' => 'setAnnualDeduction',
'sum_profit_and_loss' => 'setSumProfitAndLoss',
'opening_balance_profit_and_loss' => 'setOpeningBalanceProfitAndLoss',
'closing_balance_profit_and_loss' => 'setClosingBalanceProfitAndLoss',
'object_identifier' => 'setObjectIdentifier'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
'group_id' => 'getGroupId',
'generic_data_type' => 'getGenericDataType',
'generic_data_type_group_id' => 'getGenericDataTypeGroupId',
'posts' => 'getPosts',
'type_of_goods_posts' => 'getTypeOfGoodsPosts',
'cash_register_system_posts' => 'getCashRegisterSystemPosts',
'calculated_deduction' => 'getCalculatedDeduction',
'expenses' => 'getExpenses',
'reversed_expenses' => 'getReversedExpenses',
'show_profit_and_loss_details' => 'getShowProfitAndLossDetails',
'annual_income_recognition_or_deduction_basis' => 'getAnnualIncomeRecognitionOrDeductionBasis',
'annual_income_recognition' => 'getAnnualIncomeRecognition',
'annual_deduction' => 'getAnnualDeduction',
'sum_profit_and_loss' => 'getSumProfitAndLoss',
'opening_balance_profit_and_loss' => 'getOpeningBalanceProfitAndLoss',
'closing_balance_profit_and_loss' => 'getClosingBalanceProfitAndLoss',
'object_identifier' => 'getObjectIdentifier'    ];

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

    const GENERIC_DATA_TYPE_MISC = 'MISC';
const GENERIC_DATA_TYPE_TRANSPORT = 'TRANSPORT';
const GENERIC_DATA_TYPE_ACCOMMODATION_AND_RESTAURANT = 'ACCOMMODATION_AND_RESTAURANT';
const GENERIC_DATA_TYPE_PROFIT_AND_LOSS = 'PROFIT_AND_LOSS';
const GENERIC_DATA_TYPE_CUSTOMER_RECEIVABLE = 'CUSTOMER_RECEIVABLE';
const GENERIC_DATA_TYPE_INVENTORIES = 'INVENTORIES';
const GENERIC_DATA_TYPE_TANGIBLE_FIXED_ASSETS = 'TANGIBLE_FIXED_ASSETS';
const GENERIC_DATA_TYPE_RECONCILIATION_OF_EQUITY = 'RECONCILIATION_OF_EQUITY';
const GENERIC_DATA_TYPE_PERMANENT_DIFFERENCES = 'PERMANENT_DIFFERENCES';
const GENERIC_DATA_TYPE_TEMPORARY_DIFFERENCES = 'TEMPORARY_DIFFERENCES';
const GENERIC_DATA_TYPE_DOCUMENT_DOWNLOADED = 'DOCUMENT_DOWNLOADED';
const GENERIC_DATA_TYPE_GROUP_CONTRIBUTIONS = 'GROUP_CONTRIBUTIONS';
const GENERIC_DATA_TYPE_TAX_RETURN = 'TAX_RETURN';
const GENERIC_DATA_TYPE_TAX_CALCULATIONS = 'TAX_CALCULATIONS';
const GENERIC_DATA_TYPE_DOCUMENTATION = 'DOCUMENTATION';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenericDataTypeAllowableValues()
    {
        return [
            self::GENERIC_DATA_TYPE_MISC,
self::GENERIC_DATA_TYPE_TRANSPORT,
self::GENERIC_DATA_TYPE_ACCOMMODATION_AND_RESTAURANT,
self::GENERIC_DATA_TYPE_PROFIT_AND_LOSS,
self::GENERIC_DATA_TYPE_CUSTOMER_RECEIVABLE,
self::GENERIC_DATA_TYPE_INVENTORIES,
self::GENERIC_DATA_TYPE_TANGIBLE_FIXED_ASSETS,
self::GENERIC_DATA_TYPE_RECONCILIATION_OF_EQUITY,
self::GENERIC_DATA_TYPE_PERMANENT_DIFFERENCES,
self::GENERIC_DATA_TYPE_TEMPORARY_DIFFERENCES,
self::GENERIC_DATA_TYPE_DOCUMENT_DOWNLOADED,
self::GENERIC_DATA_TYPE_GROUP_CONTRIBUTIONS,
self::GENERIC_DATA_TYPE_TAX_RETURN,
self::GENERIC_DATA_TYPE_TAX_CALCULATIONS,
self::GENERIC_DATA_TYPE_DOCUMENTATION,        ];
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
        $this->container['group_id'] = isset($data['group_id']) ? $data['group_id'] : null;
        $this->container['generic_data_type'] = isset($data['generic_data_type']) ? $data['generic_data_type'] : null;
        $this->container['generic_data_type_group_id'] = isset($data['generic_data_type_group_id']) ? $data['generic_data_type_group_id'] : null;
        $this->container['posts'] = isset($data['posts']) ? $data['posts'] : null;
        $this->container['type_of_goods_posts'] = isset($data['type_of_goods_posts']) ? $data['type_of_goods_posts'] : null;
        $this->container['cash_register_system_posts'] = isset($data['cash_register_system_posts']) ? $data['cash_register_system_posts'] : null;
        $this->container['calculated_deduction'] = isset($data['calculated_deduction']) ? $data['calculated_deduction'] : null;
        $this->container['expenses'] = isset($data['expenses']) ? $data['expenses'] : null;
        $this->container['reversed_expenses'] = isset($data['reversed_expenses']) ? $data['reversed_expenses'] : null;
        $this->container['show_profit_and_loss_details'] = isset($data['show_profit_and_loss_details']) ? $data['show_profit_and_loss_details'] : null;
        $this->container['annual_income_recognition_or_deduction_basis'] = isset($data['annual_income_recognition_or_deduction_basis']) ? $data['annual_income_recognition_or_deduction_basis'] : null;
        $this->container['annual_income_recognition'] = isset($data['annual_income_recognition']) ? $data['annual_income_recognition'] : null;
        $this->container['annual_deduction'] = isset($data['annual_deduction']) ? $data['annual_deduction'] : null;
        $this->container['sum_profit_and_loss'] = isset($data['sum_profit_and_loss']) ? $data['sum_profit_and_loss'] : null;
        $this->container['opening_balance_profit_and_loss'] = isset($data['opening_balance_profit_and_loss']) ? $data['opening_balance_profit_and_loss'] : null;
        $this->container['closing_balance_profit_and_loss'] = isset($data['closing_balance_profit_and_loss']) ? $data['closing_balance_profit_and_loss'] : null;
        $this->container['object_identifier'] = isset($data['object_identifier']) ? $data['object_identifier'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!is_null($this->container['generic_data_type']) && !in_array($this->container['generic_data_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'generic_data_type', must be one of '%s'",
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
     * Gets group_id
     *
     * @return int
     */
    public function getGroupId()
    {
        return $this->container['group_id'];
    }

    /**
     * Sets group_id
     *
     * @param int $group_id group_id
     *
     * @return $this
     */
    public function setGroupId($group_id)
    {
        $this->container['group_id'] = $group_id;

        return $this;
    }

    /**
     * Gets generic_data_type
     *
     * @return string
     */
    public function getGenericDataType()
    {
        return $this->container['generic_data_type'];
    }

    /**
     * Sets generic_data_type
     *
     * @param string $generic_data_type generic_data_type
     *
     * @return $this
     */
    public function setGenericDataType($generic_data_type)
    {
        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!is_null($generic_data_type) && !in_array($generic_data_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'generic_data_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['generic_data_type'] = $generic_data_type;

        return $this;
    }

    /**
     * Gets generic_data_type_group_id
     *
     * @return int
     */
    public function getGenericDataTypeGroupId()
    {
        return $this->container['generic_data_type_group_id'];
    }

    /**
     * Sets generic_data_type_group_id
     *
     * @param int $generic_data_type_group_id generic_data_type_group_id
     *
     * @return $this
     */
    public function setGenericDataTypeGroupId($generic_data_type_group_id)
    {
        $this->container['generic_data_type_group_id'] = $generic_data_type_group_id;

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
     * Gets type_of_goods_posts
     *
     * @return \Learnist\Tripletex\Model\TypeOfGoods[]
     */
    public function getTypeOfGoodsPosts()
    {
        return $this->container['type_of_goods_posts'];
    }

    /**
     * Sets type_of_goods_posts
     *
     * @param \Learnist\Tripletex\Model\TypeOfGoods[] $type_of_goods_posts type_of_goods_posts
     *
     * @return $this
     */
    public function setTypeOfGoodsPosts($type_of_goods_posts)
    {
        $this->container['type_of_goods_posts'] = $type_of_goods_posts;

        return $this;
    }

    /**
     * Gets cash_register_system_posts
     *
     * @return \Learnist\Tripletex\Model\CashRegisterSystem[]
     */
    public function getCashRegisterSystemPosts()
    {
        return $this->container['cash_register_system_posts'];
    }

    /**
     * Sets cash_register_system_posts
     *
     * @param \Learnist\Tripletex\Model\CashRegisterSystem[] $cash_register_system_posts cash_register_system_posts
     *
     * @return $this
     */
    public function setCashRegisterSystemPosts($cash_register_system_posts)
    {
        $this->container['cash_register_system_posts'] = $cash_register_system_posts;

        return $this;
    }

    /**
     * Gets calculated_deduction
     *
     * @return float
     */
    public function getCalculatedDeduction()
    {
        return $this->container['calculated_deduction'];
    }

    /**
     * Sets calculated_deduction
     *
     * @param float $calculated_deduction calculated_deduction
     *
     * @return $this
     */
    public function setCalculatedDeduction($calculated_deduction)
    {
        $this->container['calculated_deduction'] = $calculated_deduction;

        return $this;
    }

    /**
     * Gets expenses
     *
     * @return float
     */
    public function getExpenses()
    {
        return $this->container['expenses'];
    }

    /**
     * Sets expenses
     *
     * @param float $expenses expenses
     *
     * @return $this
     */
    public function setExpenses($expenses)
    {
        $this->container['expenses'] = $expenses;

        return $this;
    }

    /**
     * Gets reversed_expenses
     *
     * @return float
     */
    public function getReversedExpenses()
    {
        return $this->container['reversed_expenses'];
    }

    /**
     * Sets reversed_expenses
     *
     * @param float $reversed_expenses reversed_expenses
     *
     * @return $this
     */
    public function setReversedExpenses($reversed_expenses)
    {
        $this->container['reversed_expenses'] = $reversed_expenses;

        return $this;
    }

    /**
     * Gets show_profit_and_loss_details
     *
     * @return bool
     */
    public function getShowProfitAndLossDetails()
    {
        return $this->container['show_profit_and_loss_details'];
    }

    /**
     * Sets show_profit_and_loss_details
     *
     * @param bool $show_profit_and_loss_details show_profit_and_loss_details
     *
     * @return $this
     */
    public function setShowProfitAndLossDetails($show_profit_and_loss_details)
    {
        $this->container['show_profit_and_loss_details'] = $show_profit_and_loss_details;

        return $this;
    }

    /**
     * Gets annual_income_recognition_or_deduction_basis
     *
     * @return float
     */
    public function getAnnualIncomeRecognitionOrDeductionBasis()
    {
        return $this->container['annual_income_recognition_or_deduction_basis'];
    }

    /**
     * Sets annual_income_recognition_or_deduction_basis
     *
     * @param float $annual_income_recognition_or_deduction_basis annual_income_recognition_or_deduction_basis
     *
     * @return $this
     */
    public function setAnnualIncomeRecognitionOrDeductionBasis($annual_income_recognition_or_deduction_basis)
    {
        $this->container['annual_income_recognition_or_deduction_basis'] = $annual_income_recognition_or_deduction_basis;

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
     * Gets opening_balance_profit_and_loss
     *
     * @return float
     */
    public function getOpeningBalanceProfitAndLoss()
    {
        return $this->container['opening_balance_profit_and_loss'];
    }

    /**
     * Sets opening_balance_profit_and_loss
     *
     * @param float $opening_balance_profit_and_loss opening_balance_profit_and_loss
     *
     * @return $this
     */
    public function setOpeningBalanceProfitAndLoss($opening_balance_profit_and_loss)
    {
        $this->container['opening_balance_profit_and_loss'] = $opening_balance_profit_and_loss;

        return $this;
    }

    /**
     * Gets closing_balance_profit_and_loss
     *
     * @return float
     */
    public function getClosingBalanceProfitAndLoss()
    {
        return $this->container['closing_balance_profit_and_loss'];
    }

    /**
     * Sets closing_balance_profit_and_loss
     *
     * @param float $closing_balance_profit_and_loss closing_balance_profit_and_loss
     *
     * @return $this
     */
    public function setClosingBalanceProfitAndLoss($closing_balance_profit_and_loss)
    {
        $this->container['closing_balance_profit_and_loss'] = $closing_balance_profit_and_loss;

        return $this;
    }

    /**
     * Gets object_identifier
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        return $this->container['object_identifier'];
    }

    /**
     * Sets object_identifier
     *
     * @param string $object_identifier object_identifier
     *
     * @return $this
     */
    public function setObjectIdentifier($object_identifier)
    {
        $this->container['object_identifier'] = $object_identifier;

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
