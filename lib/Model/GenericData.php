<?php
/**
 * GenericData
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
 * GenericData Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GenericData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'GenericData';

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
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
        'group_id' => 'int',
        'generic_data_type' => 'string',
        'generic_data_sub_type' => 'string',
        'generic_data_sub_type_group_id' => 'int',
        'post_type' => 'string',
        'post_value' => 'string'
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
        'year_end_report' => null,
        'group_id' => 'int32',
        'generic_data_type' => null,
        'generic_data_sub_type' => null,
        'generic_data_sub_type_group_id' => 'int32',
        'post_type' => null,
        'post_value' => null
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
		'year_end_report' => false,
		'group_id' => false,
		'generic_data_type' => false,
		'generic_data_sub_type' => false,
		'generic_data_sub_type_group_id' => false,
		'post_type' => false,
		'post_value' => false
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
        'year_end_report' => 'yearEndReport',
        'group_id' => 'groupId',
        'generic_data_type' => 'genericDataType',
        'generic_data_sub_type' => 'genericDataSubType',
        'generic_data_sub_type_group_id' => 'genericDataSubTypeGroupId',
        'post_type' => 'postType',
        'post_value' => 'postValue'
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
        'year_end_report' => 'setYearEndReport',
        'group_id' => 'setGroupId',
        'generic_data_type' => 'setGenericDataType',
        'generic_data_sub_type' => 'setGenericDataSubType',
        'generic_data_sub_type_group_id' => 'setGenericDataSubTypeGroupId',
        'post_type' => 'setPostType',
        'post_value' => 'setPostValue'
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
        'year_end_report' => 'getYearEndReport',
        'group_id' => 'getGroupId',
        'generic_data_type' => 'getGenericDataType',
        'generic_data_sub_type' => 'getGenericDataSubType',
        'generic_data_sub_type_group_id' => 'getGenericDataSubTypeGroupId',
        'post_type' => 'getPostType',
        'post_value' => 'getPostValue'
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

    public const GENERIC_DATA_TYPE_MISC = 'MISC';
    public const GENERIC_DATA_TYPE_TRANSPORT = 'TRANSPORT';
    public const GENERIC_DATA_TYPE_ACCOMMODATION_AND_RESTAURANT = 'ACCOMMODATION_AND_RESTAURANT';
    public const GENERIC_DATA_TYPE_PROFIT_AND_LOSS = 'PROFIT_AND_LOSS';
    public const GENERIC_DATA_TYPE_CUSTOMER_RECEIVABLE = 'CUSTOMER_RECEIVABLE';
    public const GENERIC_DATA_TYPE_INVENTORIES = 'INVENTORIES';
    public const GENERIC_DATA_TYPE_TANGIBLE_FIXED_ASSETS = 'TANGIBLE_FIXED_ASSETS';
    public const GENERIC_DATA_TYPE_RECONCILIATION_OF_EQUITY = 'RECONCILIATION_OF_EQUITY';
    public const GENERIC_DATA_TYPE_PERMANENT_DIFFERENCES = 'PERMANENT_DIFFERENCES';
    public const GENERIC_DATA_TYPE_TEMPORARY_DIFFERENCES = 'TEMPORARY_DIFFERENCES';
    public const GENERIC_DATA_TYPE_DOCUMENT_DOWNLOADED = 'DOCUMENT_DOWNLOADED';
    public const GENERIC_DATA_TYPE_GROUP_CONTRIBUTIONS = 'GROUP_CONTRIBUTIONS';
    public const GENERIC_DATA_TYPE_TAX_RETURN = 'TAX_RETURN';
    public const GENERIC_DATA_TYPE_TAX_CALCULATIONS = 'TAX_CALCULATIONS';
    public const GENERIC_DATA_TYPE_DOCUMENTATION = 'DOCUMENTATION';
    public const GENERIC_DATA_SUB_TYPE_NONE = 'NONE';
    public const GENERIC_DATA_SUB_TYPE_NOT_LICENSED = 'NOT_LICENSED';
    public const GENERIC_DATA_SUB_TYPE_FREIGHT_TRANSPORT = 'FREIGHT_TRANSPORT';
    public const GENERIC_DATA_SUB_TYPE_TAXI = 'TAXI';
    public const GENERIC_DATA_SUB_TYPE_PRODUCT_TYPE_INVENTORY = 'PRODUCT_TYPE_INVENTORY';
    public const GENERIC_DATA_SUB_TYPE_CASH_REGISTER_SYSTEM = 'CASH_REGISTER_SYSTEM';
    public const GENERIC_DATA_SUB_TYPE_PRIVATE_WITHDRAWAL_OF_GOODS = 'PRIVATE_WITHDRAWAL_OF_GOODS';
    public const GENERIC_DATA_SUB_TYPE_ENTERTAINMENT = 'ENTERTAINMENT';
    public const POST_TYPE_REGISTRATION_NUMBER = 'REGISTRATION_NUMBER';
    public const POST_TYPE_DESCRIPTION = 'DESCRIPTION';
    public const POST_TYPE_VEHICLE_TYPE = 'VEHICLE_TYPE';
    public const POST_TYPE_YEAR_OF_INITIAL_REGISTRATION = 'YEAR_OF_INITIAL_REGISTRATION';
    public const POST_TYPE_LIST_PRICE = 'LIST_PRICE';
    public const POST_TYPE_DATE_FROM = 'DATE_FROM';
    public const POST_TYPE_DATE_TO = 'DATE_TO';
    public const POST_TYPE_LICENCE = 'LICENCE';
    public const POST_TYPE_LICENCE_NUMBER = 'LICENCE_NUMBER';
    public const POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED = 'IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED';
    public const POST_TYPE_NO_OF_KILOMETRES_TOTAL = 'NO_OF_KILOMETRES_TOTAL';
    public const POST_TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
    public const POST_TYPE_LEASING_RENT = 'LEASING_RENT';
    public const POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE = 'IS_COMPANY_VEHICLE_USED_PRIVATE';
    public const POST_TYPE_NO_OF_KILOMETRES_PRIVATE = 'NO_OF_KILOMETRES_PRIVATE';
    public const POST_TYPE_DEPRECIATION_PRIVATE_USE = 'DEPRECIATION_PRIVATE_USE';
    public const POST_TYPE_REVERSED_VEHICLE_EXPENSES = 'REVERSED_VEHICLE_EXPENSES';
    public const POST_TYPE_FUEL_COST = 'FUEL_COST';
    public const POST_TYPE_MAINTENANCE_COST = 'MAINTENANCE_COST';
    public const POST_TYPE_COST_OF_INSURANCE_AND_TAX = 'COST_OF_INSURANCE_AND_TAX';
    public const POST_TYPE_NO_OF_LITER_FUEL = 'NO_OF_LITER_FUEL';
    public const POST_TYPE_TAXIMETER_TYPE = 'TAXIMETER_TYPE';
    public const POST_TYPE_INCOME_PERSONAL_TRANSPORT = 'INCOME_PERSONAL_TRANSPORT';
    public const POST_TYPE_INCOME_GOODS_TRANSPORT = 'INCOME_GOODS_TRANSPORT';
    public const POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH = 'DRIVING_INCOME_PAYED_IN_CASH';
    public const POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES = 'DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES';
    public const POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE = 'TIP_PAYED_WITH_CARD_OR_INVOICE';
    public const POST_TYPE_TIP_PAYED_IN_CASH = 'TIP_PAYED_IN_CASH';
    public const POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN = 'NO_OF_KILOMETRES_SCHOOL_CHILDREN';
    public const POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER = 'NO_OF_KILOMETRES_WITH_PASSENGER';
    public const POST_TYPE_FLOP_TRIP_AMOUNT = 'FLOP_TRIP_AMOUNT';
    public const POST_TYPE_IS_CONNECTED_TO_CENTRAL = 'IS_CONNECTED_TO_CENTRAL';
    public const POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT = 'ID_FOR_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT = 'DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_MUNICIPALITY_NUMBER = 'MUNICIPALITY_NUMBER';
    public const POST_TYPE_OPENING_BALANCE = 'OPENING_BALANCE';
    public const POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK = 'PROFIT_REALIZATIONS_LIVESTOCK';
    public const POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS = 'ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS';
    public const POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT = 'PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_ANNUAL_INCOME_RECOGNITION = 'ANNUAL_INCOME_RECOGNITION';
    public const POST_TYPE_ANNUAL_DEDUCTION = 'ANNUAL_DEDUCTION';
    public const POST_TYPE_CLOSING_BALANCE = 'CLOSING_BALANCE';
    public const POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY = 'IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY';
    public const POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS = 'IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS';
    public const POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT = 'ID_FOR_ACCOMMODATION_AND_RESTAURANT';
    public const POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT = 'COVER_CHARGE_SUBJECT_TO_VAT';
    public const POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT = 'COVER_CHARGE_NOT_SUBJECT_TO_VAT';
    public const POST_TYPE_COVER_CHARGE = 'COVER_CHARGE';
    public const POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT = 'DESCRIPTION_ACCOMMODATION_AND_RESTAURANT';
    public const POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR = 'MUST_BE_CONFIRMED_BY_AUDITOR';
    public const POST_TYPE_PRODUCT_TYPE = 'PRODUCT_TYPE';
    public const POST_TYPE_OPENING_STOCK = 'OPENING_STOCK';
    public const POST_TYPE_CLOSING_STOCK = 'CLOSING_STOCK';
    public const POST_TYPE_PURCHASE_OF_GOODS = 'PURCHASE_OF_GOODS';
    public const POST_TYPE_COST_OF_GOODS_SOLD = 'COST_OF_GOODS_SOLD';
    public const POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS = 'SALES_REVENUE_AND_WITHDRAWALS';
    public const POST_TYPE_SALES_REVENUE_IN_CASH = 'SALES_REVENUE_IN_CASH';
    public const POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION = 'CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION';
    public const POST_TYPE_CASH_REGISTER_SYSTEM_TYPE = 'CASH_REGISTER_SYSTEM_TYPE';
    public const POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER = 'WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER';
    public const POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT = 'PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT';
    public const POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE = 'TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE';
    public const POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE = 'WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE';
    public const POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const POST_TYPE_OPENING_BALANCE_CREDITSALES = 'OPENING_BALANCE_CREDITSALES';
    public const POST_TYPE_CLOSING_BALANCE_CREDITSALES = 'CLOSING_BALANCE_CREDITSALES';
    public const POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM = 'OPENING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM = 'CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE = 'TANGIBLE_FIXED_ASSETS_TYPE';
    public const POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS = 'OPENING_BALANCE_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_DEPRECIATION_PERCENTAGE = 'DEPRECIATION_PERCENTAGE';
    public const POST_TYPE_STRAIGHT_LINE_DEPRECIATION = 'STRAIGHT_LINE_DEPRECIATION';
    public const POST_TYPE_CASH_DEPOSITS = 'CASH_DEPOSITS';
    public const POST_TYPE_CONTRIBUTIONS_IN_KIND = 'CONTRIBUTIONS_IN_KIND';
    public const POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH';
    public const POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS';
    public const POST_TYPE_DEBT_WAVING = 'DEBT_WAVING';
    public const POST_TYPE_BUYING_OWN_SHARES = 'BUYING_OWN_SHARES';
    public const POST_TYPE_SELLING_OWN_SHARES = 'SELLING_OWN_SHARES';
    public const POST_TYPE_DEBT_CONVERSION_TO_EQUITY = 'DEBT_CONVERSION_TO_EQUITY';
    public const POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY = 'OTHER_POSITIVE_CHANGE_IN_EQUITY';
    public const POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY = 'OTHER_NEGATIVE_CHANGE_IN_EQUITY';
    public const POST_TYPE_NONE_DEDUCTIBLE_COST = 'NONE_DEDUCTIBLE_COST';
    public const POST_TYPE_POSITIVE_TAX_COST = 'POSITIVE_TAX_COST';
    public const POST_TYPE_INTEREST_EXPENSE_FIXED_TAX = 'INTEREST_EXPENSE_FIXED_TAX';
    public const POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT = 'SHARE_OF_LOSS_FROM_INVESTMENT';
    public const POST_TYPE_REVERSAL_OF_IMPAIRMENT = 'REVERSAL_OF_IMPAIRMENT';
    public const POST_TYPE_ACCOUNTING_IMPAIRMENT = 'ACCOUNTING_IMPAIRMENT';
    public const POST_TYPE_ACCOUNTING_LOSS = 'ACCOUNTING_LOSS';
    public const POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF = 'ACCOUNTING_DEFICIT_NORWEAGIAN_SDF';
    public const POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF = 'ACCOUNTING_DEFICIT_FOREIGN_SDF';
    public const POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF = 'ACCOUNTING_LOSS_NORWEAGIAN_SDF';
    public const POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF = 'ACCOUNTING_LOSS_FOREIGN_SDF';
    public const POST_TYPE_RETURNED_DEBT_INTEREST = 'RETURNED_DEBT_INTEREST';
    public const POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES = 'TAXABLE_DIVIDEND_ON_SHARES';
    public const POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION = 'TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION';
    public const POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF = 'SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF';
    public const POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF = 'SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF';
    public const POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF';
    public const POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF';
    public const POST_TYPE_ADDITION_INTEREST_COST = 'ADDITION_INTEREST_COST';
    public const POST_TYPE_CORRECTION_PURPOSED_DIVIDEND = 'CORRECTION_PURPOSED_DIVIDEND';
    public const POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE = 'INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE';
    public const POST_TYPE_OTHER_INCOME_SUPPLEMENT = 'OTHER_INCOME_SUPPLEMENT';
    public const POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS = 'RETURN_OF_INCOME_RELATED_DIVIDENDS';
    public const POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION = 'PROFIT_AND_LOSS_GROUP_CONTRIBUTION';
    public const POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF = 'ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF';
    public const POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF = 'ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF';
    public const POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF = 'ACCOUNTING_GAIN_NORWEGIAN_SDF';
    public const POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF = 'ACCOUNTING_GAIN_FOREIGN_SDF';
    public const POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF';
    public const POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF';
    public const POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF';
    public const POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF';
    public const POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST = 'ISSUE_AND_ESTABLISHMENT_COST';
    public const POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK = 'INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK';
    public const POST_TYPE_OTHER_INCOME_DEDUCTION = 'OTHER_INCOME_DEDUCTION';
    public const POST_TYPE_TEMPORARY_DIFFERENCES_TYPE = 'TEMPORARY_DIFFERENCES_TYPE';
    public const POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE = 'OPENING_BALANCE_ACCOUNTABLE_VALUE';
    public const POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE = 'CLOSING_BALANCE_ACCOUNTABLE_VALUE';
    public const POST_TYPE_OPENING_BALANCE_TAX_VALUE = 'OPENING_BALANCE_TAX_VALUE';
    public const POST_TYPE_CLOSING_BALANCE_TAX_VALUE = 'CLOSING_BALANCE_TAX_VALUE';
    public const POST_TYPE_OPENING_BALANCE_DIFFERENCES = 'OPENING_BALANCE_DIFFERENCES';
    public const POST_TYPE_CLOSING_BALANCE_DIFFERENCES = 'CLOSING_BALANCE_DIFFERENCES';
    public const POST_TYPE_SHOW_PROFIT_AND_LOSS = 'SHOW_PROFIT_AND_LOSS';
    public const POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT = 'SHOW_ACCOMMODATION_AND_RESTAURANT';
    public const POST_TYPE_IS_ACCOUNTABLE = 'IS_ACCOUNTABLE';
    public const POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES = 'USE_ACCOUNTING_VALUES_IN_INVENTORIES';
    public const POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES = 'USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES';
    public const POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET = 'SHOW_TANGIBLE_FIXED_ASSET';
    public const POST_TYPE_SHOW_CAR = 'SHOW_CAR';
    public const POST_TYPE_SHOW_INVENTORIES = 'SHOW_INVENTORIES';
    public const POST_TYPE_SHOW_CUSTOMER_RECEIVABLES = 'SHOW_CUSTOMER_RECEIVABLES';
    public const POST_TYPE_SHOW_CONCERN_RELATION = 'SHOW_CONCERN_RELATION';
    public const POST_TYPE_OWN_BUSINESS_PROPERTIES = 'OWN_BUSINESS_PROPERTIES';
    public const POST_TYPE_OWN_ASSET_PAPIR = 'OWN_ASSET_PAPIR';
    public const POST_TYPE_TRANSFERED_BY = 'TRANSFERED_BY';
    public const POST_TYPE_TRANSFERED_DATE = 'TRANSFERED_DATE';
    public const POST_TYPE_SET_ACCOUNTANT_REVISED = 'SET_ACCOUNTANT_REVISED';
    public const POST_TYPE_IS_TAXABLE = 'IS_TAXABLE';
    public const POST_TYPE_REQUIRE_AUDITORS_SIGNATURE = 'REQUIRE_AUDITORS_SIGNATURE';
    public const POST_TYPE_VALIDATION_ONLY_ON_SUBMIT = 'VALIDATION_ONLY_ON_SUBMIT';
    public const POST_TYPE_YEAR_END_BRREG_DOC_ID = 'YEAR_END_BRREG_DOC_ID';
    public const POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME = 'YEAR_END_BRREG_DOC_FETCHER_NAME';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT = 'YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT = 'YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE = 'YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS = 'YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES = 'YEAR_END_DOCUMENTATION_INVENTORIES';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS = 'YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS = 'YEAR_END_DOCUMENTATION_PROFIT_LOSS';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE = 'YEAR_END_DOCUMENTATION_BALANCE';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME = 'YEAR_END_DOCUMENTATION_PERSONAL_INCOME';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES = 'YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES = 'YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT = 'YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS = 'YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION = 'YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN = 'YEAR_END_DOCUMENTATION_TAX_RETURN';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND = 'YEAR_END_DOCUMENTATION_DIVIDEND';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS = 'YEAR_END_DOCUMENTATION_DISPOSITIONS';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES = 'YEAR_END_DOCUMENTATION_PROPERTIES';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES = 'YEAR_END_DOCUMENTATION_SECURITIES';
    public const POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION = 'YEAR_END_DOCUMENTATION_TAX_CALCULATION';
    public const POST_TYPE_RECEIVER_ORG_NR = 'RECEIVER_ORG_NR';
    public const POST_TYPE_RECEIVER_NAME = 'RECEIVER_NAME';
    public const POST_TYPE_CONCERN_CONNECTION = 'CONCERN_CONNECTION';
    public const POST_TYPE_VOTING_LIMIT = 'VOTING_LIMIT';
    public const POST_TYPE_DATE_OF_ACQUISITION = 'DATE_OF_ACQUISITION';
    public const POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS = 'APPLICATION_OF_LOSS_CARRY_FORWARDS';
    public const POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS = 'ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS';
    public const POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL = 'CORRECTIONS_AND_OTHER_CAPITAL';
    public const POST_TYPE_CORRECTIONS_AND_OTHER_DEBT = 'CORRECTIONS_AND_OTHER_DEBT';
    public const POST_TYPE_IS_PART_OF_GROUP_COMPANY = 'IS_PART_OF_GROUP_COMPANY';
    public const POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE = 'IS_LISTED_ON_THE_STOCK_EXCHANGE';
    public const POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS = 'IS_REORGANIZED_ACROSS_BORDERS';
    public const POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS = 'HAS_RECEIVED_OR_TRANSFERED_ASSETS';
    public const POST_TYPE_HEAD_OF_GROUP_NAME = 'HEAD_OF_GROUP_NAME';
    public const POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE = 'HEAD_OF_GROUP_COUNTRY_CODE';
    public const POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME = 'HEAD_OF_GROUP_LAST_YEAR_NAME';
    public const POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE = 'HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE';
    public const POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME = 'FOREIGN_OWNERSHIP_COMPANY_NAME';
    public const POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE = 'FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE';
    public const POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY = 'OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY';
    public const POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD = 'HAS_PERMANENT_ESTABLISHMENT_ABROAD';
    public const POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME';
    public const POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE';
    public const POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER = 'HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER';
    public const POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID = 'HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID';
    public const POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS = 'IS_SMALL_OR_MEDIUM_SIZED_BUSINESS';
    public const POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR = 'HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR';
    public const POST_TYPE_IS_GROUP_COMPANY = 'IS_GROUP_COMPANY';
    public const POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT = 'HAS_RECEIVED_OTHER_PUBLIC_SUPPORT';
    public const POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME = 'AID_SCHEME_TONNAGE_TAX_REGIME';
    public const POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS = 'AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS';
    public const POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS = 'AID_SCHEME_FOR_LONGTERM_INVESTMENTS';
    public const POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP = 'AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP';
    public const POST_TYPE_AID_SCHEME_TAX_FUN = 'AID_SCHEME_TAX_FUN';
    public const POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES = 'AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES';
    public const POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS = 'AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS';
    public const POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES = 'AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES';
    public const POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS';
    public const POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS';
    public const POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES';
    public const POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS';
    public const POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS';
    public const POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY';
    public const POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY';
    public const POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL = 'AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL';
    public const POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS = 'AID_SCHEME_EXEMPTION_CO2_TAX_GAS';
    public const POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY = 'AID_SCHEME_EXEMPTION_NOX_DUTY';
    public const POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE = 'AID_SCHEME_EXEMPTION_TRANSFER_FEE';
    public const POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX = 'AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX';
    public const POST_TYPE_OTHER_CORRECTIONS = 'OTHER_CORRECTIONS';
    public const POST_TYPE_YEARLY_DIVIDEND = 'YEARLY_DIVIDEND';

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
            self::GENERIC_DATA_TYPE_DOCUMENTATION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getGenericDataSubTypeAllowableValues()
    {
        return [
            self::GENERIC_DATA_SUB_TYPE_NONE,
            self::GENERIC_DATA_SUB_TYPE_NOT_LICENSED,
            self::GENERIC_DATA_SUB_TYPE_FREIGHT_TRANSPORT,
            self::GENERIC_DATA_SUB_TYPE_TAXI,
            self::GENERIC_DATA_SUB_TYPE_PRODUCT_TYPE_INVENTORY,
            self::GENERIC_DATA_SUB_TYPE_CASH_REGISTER_SYSTEM,
            self::GENERIC_DATA_SUB_TYPE_PRIVATE_WITHDRAWAL_OF_GOODS,
            self::GENERIC_DATA_SUB_TYPE_ENTERTAINMENT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPostTypeAllowableValues()
    {
        return [
            self::POST_TYPE_REGISTRATION_NUMBER,
            self::POST_TYPE_DESCRIPTION,
            self::POST_TYPE_VEHICLE_TYPE,
            self::POST_TYPE_YEAR_OF_INITIAL_REGISTRATION,
            self::POST_TYPE_LIST_PRICE,
            self::POST_TYPE_DATE_FROM,
            self::POST_TYPE_DATE_TO,
            self::POST_TYPE_LICENCE,
            self::POST_TYPE_LICENCE_NUMBER,
            self::POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED,
            self::POST_TYPE_NO_OF_KILOMETRES_TOTAL,
            self::POST_TYPE_OPERATING_EXPENSES,
            self::POST_TYPE_LEASING_RENT,
            self::POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE,
            self::POST_TYPE_NO_OF_KILOMETRES_PRIVATE,
            self::POST_TYPE_DEPRECIATION_PRIVATE_USE,
            self::POST_TYPE_REVERSED_VEHICLE_EXPENSES,
            self::POST_TYPE_FUEL_COST,
            self::POST_TYPE_MAINTENANCE_COST,
            self::POST_TYPE_COST_OF_INSURANCE_AND_TAX,
            self::POST_TYPE_NO_OF_LITER_FUEL,
            self::POST_TYPE_TAXIMETER_TYPE,
            self::POST_TYPE_INCOME_PERSONAL_TRANSPORT,
            self::POST_TYPE_INCOME_GOODS_TRANSPORT,
            self::POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH,
            self::POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES,
            self::POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE,
            self::POST_TYPE_TIP_PAYED_IN_CASH,
            self::POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN,
            self::POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER,
            self::POST_TYPE_FLOP_TRIP_AMOUNT,
            self::POST_TYPE_IS_CONNECTED_TO_CENTRAL,
            self::POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_MUNICIPALITY_NUMBER,
            self::POST_TYPE_OPENING_BALANCE,
            self::POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK,
            self::POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS,
            self::POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_ANNUAL_INCOME_RECOGNITION,
            self::POST_TYPE_ANNUAL_DEDUCTION,
            self::POST_TYPE_CLOSING_BALANCE,
            self::POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY,
            self::POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS,
            self::POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT,
            self::POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT,
            self::POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT,
            self::POST_TYPE_COVER_CHARGE,
            self::POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT,
            self::POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR,
            self::POST_TYPE_PRODUCT_TYPE,
            self::POST_TYPE_OPENING_STOCK,
            self::POST_TYPE_CLOSING_STOCK,
            self::POST_TYPE_PURCHASE_OF_GOODS,
            self::POST_TYPE_COST_OF_GOODS_SOLD,
            self::POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS,
            self::POST_TYPE_SALES_REVENUE_IN_CASH,
            self::POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION,
            self::POST_TYPE_CASH_REGISTER_SYSTEM_TYPE,
            self::POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER,
            self::POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT,
            self::POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE,
            self::POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE,
            self::POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::POST_TYPE_OPENING_BALANCE_CREDITSALES,
            self::POST_TYPE_CLOSING_BALANCE_CREDITSALES,
            self::POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE,
            self::POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_DEPRECIATION_PERCENTAGE,
            self::POST_TYPE_STRAIGHT_LINE_DEPRECIATION,
            self::POST_TYPE_CASH_DEPOSITS,
            self::POST_TYPE_CONTRIBUTIONS_IN_KIND,
            self::POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH,
            self::POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS,
            self::POST_TYPE_DEBT_WAVING,
            self::POST_TYPE_BUYING_OWN_SHARES,
            self::POST_TYPE_SELLING_OWN_SHARES,
            self::POST_TYPE_DEBT_CONVERSION_TO_EQUITY,
            self::POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY,
            self::POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY,
            self::POST_TYPE_NONE_DEDUCTIBLE_COST,
            self::POST_TYPE_POSITIVE_TAX_COST,
            self::POST_TYPE_INTEREST_EXPENSE_FIXED_TAX,
            self::POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT,
            self::POST_TYPE_REVERSAL_OF_IMPAIRMENT,
            self::POST_TYPE_ACCOUNTING_IMPAIRMENT,
            self::POST_TYPE_ACCOUNTING_LOSS,
            self::POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF,
            self::POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF,
            self::POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF,
            self::POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF,
            self::POST_TYPE_RETURNED_DEBT_INTEREST,
            self::POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES,
            self::POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION,
            self::POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF,
            self::POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF,
            self::POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF,
            self::POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF,
            self::POST_TYPE_ADDITION_INTEREST_COST,
            self::POST_TYPE_CORRECTION_PURPOSED_DIVIDEND,
            self::POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE,
            self::POST_TYPE_OTHER_INCOME_SUPPLEMENT,
            self::POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS,
            self::POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION,
            self::POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF,
            self::POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF,
            self::POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF,
            self::POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF,
            self::POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF,
            self::POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF,
            self::POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF,
            self::POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF,
            self::POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST,
            self::POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK,
            self::POST_TYPE_OTHER_INCOME_DEDUCTION,
            self::POST_TYPE_TEMPORARY_DIFFERENCES_TYPE,
            self::POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE,
            self::POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE,
            self::POST_TYPE_OPENING_BALANCE_TAX_VALUE,
            self::POST_TYPE_CLOSING_BALANCE_TAX_VALUE,
            self::POST_TYPE_OPENING_BALANCE_DIFFERENCES,
            self::POST_TYPE_CLOSING_BALANCE_DIFFERENCES,
            self::POST_TYPE_SHOW_PROFIT_AND_LOSS,
            self::POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT,
            self::POST_TYPE_IS_ACCOUNTABLE,
            self::POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES,
            self::POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES,
            self::POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET,
            self::POST_TYPE_SHOW_CAR,
            self::POST_TYPE_SHOW_INVENTORIES,
            self::POST_TYPE_SHOW_CUSTOMER_RECEIVABLES,
            self::POST_TYPE_SHOW_CONCERN_RELATION,
            self::POST_TYPE_OWN_BUSINESS_PROPERTIES,
            self::POST_TYPE_OWN_ASSET_PAPIR,
            self::POST_TYPE_TRANSFERED_BY,
            self::POST_TYPE_TRANSFERED_DATE,
            self::POST_TYPE_SET_ACCOUNTANT_REVISED,
            self::POST_TYPE_IS_TAXABLE,
            self::POST_TYPE_REQUIRE_AUDITORS_SIGNATURE,
            self::POST_TYPE_VALIDATION_ONLY_ON_SUBMIT,
            self::POST_TYPE_YEAR_END_BRREG_DOC_ID,
            self::POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES,
            self::POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION,
            self::POST_TYPE_RECEIVER_ORG_NR,
            self::POST_TYPE_RECEIVER_NAME,
            self::POST_TYPE_CONCERN_CONNECTION,
            self::POST_TYPE_VOTING_LIMIT,
            self::POST_TYPE_DATE_OF_ACQUISITION,
            self::POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS,
            self::POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS,
            self::POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL,
            self::POST_TYPE_CORRECTIONS_AND_OTHER_DEBT,
            self::POST_TYPE_IS_PART_OF_GROUP_COMPANY,
            self::POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE,
            self::POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS,
            self::POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS,
            self::POST_TYPE_HEAD_OF_GROUP_NAME,
            self::POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE,
            self::POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME,
            self::POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE,
            self::POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME,
            self::POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE,
            self::POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY,
            self::POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD,
            self::POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME,
            self::POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE,
            self::POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER,
            self::POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID,
            self::POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS,
            self::POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR,
            self::POST_TYPE_IS_GROUP_COMPANY,
            self::POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT,
            self::POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME,
            self::POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS,
            self::POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS,
            self::POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP,
            self::POST_TYPE_AID_SCHEME_TAX_FUN,
            self::POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES,
            self::POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS,
            self::POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES,
            self::POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS,
            self::POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS,
            self::POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES,
            self::POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS,
            self::POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS,
            self::POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY,
            self::POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY,
            self::POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL,
            self::POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS,
            self::POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY,
            self::POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE,
            self::POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX,
            self::POST_TYPE_OTHER_CORRECTIONS,
            self::POST_TYPE_YEARLY_DIVIDEND,
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
        $this->setIfExists('year_end_report', $data ?? [], null);
        $this->setIfExists('group_id', $data ?? [], null);
        $this->setIfExists('generic_data_type', $data ?? [], null);
        $this->setIfExists('generic_data_sub_type', $data ?? [], null);
        $this->setIfExists('generic_data_sub_type_group_id', $data ?? [], null);
        $this->setIfExists('post_type', $data ?? [], null);
        $this->setIfExists('post_value', $data ?? [], null);
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

        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!is_null($this->container['generic_data_type']) && !in_array($this->container['generic_data_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'generic_data_type', must be one of '%s'",
                $this->container['generic_data_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getGenericDataSubTypeAllowableValues();
        if (!is_null($this->container['generic_data_sub_type']) && !in_array($this->container['generic_data_sub_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'generic_data_sub_type', must be one of '%s'",
                $this->container['generic_data_sub_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['post_type'] === null) {
            $invalidProperties[] = "'post_type' can't be null";
        }
        $allowedValues = $this->getPostTypeAllowableValues();
        if (!is_null($this->container['post_type']) && !in_array($this->container['post_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'post_type', must be one of '%s'",
                $this->container['post_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['post_value'] === null) {
            $invalidProperties[] = "'post_value' can't be null";
        }
        if ((mb_strlen($this->container['post_value']) > 255)) {
            $invalidProperties[] = "invalid value for 'post_value', the character length must be smaller than or equal to 255.";
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
     * Gets group_id
     *
     * @return int|null
     */
    public function getGroupId()
    {
        return $this->container['group_id'];
    }

    /**
     * Sets group_id
     *
     * @param int|null $group_id group_id
     *
     * @return self
     */
    public function setGroupId($group_id)
    {
        if (is_null($group_id)) {
            throw new \InvalidArgumentException('non-nullable group_id cannot be null');
        }
        $this->container['group_id'] = $group_id;

        return $this;
    }

    /**
     * Gets generic_data_type
     *
     * @return string|null
     */
    public function getGenericDataType()
    {
        return $this->container['generic_data_type'];
    }

    /**
     * Sets generic_data_type
     *
     * @param string|null $generic_data_type generic_data_type
     *
     * @return self
     */
    public function setGenericDataType($generic_data_type)
    {
        if (is_null($generic_data_type)) {
            throw new \InvalidArgumentException('non-nullable generic_data_type cannot be null');
        }
        $allowedValues = $this->getGenericDataTypeAllowableValues();
        if (!in_array($generic_data_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'generic_data_type', must be one of '%s'",
                    $generic_data_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['generic_data_type'] = $generic_data_type;

        return $this;
    }

    /**
     * Gets generic_data_sub_type
     *
     * @return string|null
     */
    public function getGenericDataSubType()
    {
        return $this->container['generic_data_sub_type'];
    }

    /**
     * Sets generic_data_sub_type
     *
     * @param string|null $generic_data_sub_type generic_data_sub_type
     *
     * @return self
     */
    public function setGenericDataSubType($generic_data_sub_type)
    {
        if (is_null($generic_data_sub_type)) {
            throw new \InvalidArgumentException('non-nullable generic_data_sub_type cannot be null');
        }
        $allowedValues = $this->getGenericDataSubTypeAllowableValues();
        if (!in_array($generic_data_sub_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'generic_data_sub_type', must be one of '%s'",
                    $generic_data_sub_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['generic_data_sub_type'] = $generic_data_sub_type;

        return $this;
    }

    /**
     * Gets generic_data_sub_type_group_id
     *
     * @return int|null
     */
    public function getGenericDataSubTypeGroupId()
    {
        return $this->container['generic_data_sub_type_group_id'];
    }

    /**
     * Sets generic_data_sub_type_group_id
     *
     * @param int|null $generic_data_sub_type_group_id generic_data_sub_type_group_id
     *
     * @return self
     */
    public function setGenericDataSubTypeGroupId($generic_data_sub_type_group_id)
    {
        if (is_null($generic_data_sub_type_group_id)) {
            throw new \InvalidArgumentException('non-nullable generic_data_sub_type_group_id cannot be null');
        }
        $this->container['generic_data_sub_type_group_id'] = $generic_data_sub_type_group_id;

        return $this;
    }

    /**
     * Gets post_type
     *
     * @return string
     */
    public function getPostType()
    {
        return $this->container['post_type'];
    }

    /**
     * Sets post_type
     *
     * @param string $post_type post_type
     *
     * @return self
     */
    public function setPostType($post_type)
    {
        if (is_null($post_type)) {
            throw new \InvalidArgumentException('non-nullable post_type cannot be null');
        }
        $allowedValues = $this->getPostTypeAllowableValues();
        if (!in_array($post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'post_type', must be one of '%s'",
                    $post_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['post_type'] = $post_type;

        return $this;
    }

    /**
     * Gets post_value
     *
     * @return string
     */
    public function getPostValue()
    {
        return $this->container['post_value'];
    }

    /**
     * Sets post_value
     *
     * @param string $post_value post_value
     *
     * @return self
     */
    public function setPostValue($post_value)
    {
        if (is_null($post_value)) {
            throw new \InvalidArgumentException('non-nullable post_value cannot be null');
        }
        if ((mb_strlen($post_value) > 255)) {
            throw new \InvalidArgumentException('invalid length for $post_value when calling GenericData., must be smaller than or equal to 255.');
        }

        $this->container['post_value'] = $post_value;

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


