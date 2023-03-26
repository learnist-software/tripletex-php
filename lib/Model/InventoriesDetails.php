<?php
/**
 * InventoriesDetails
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
 * InventoriesDetails Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InventoriesDetails implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InventoriesDetails';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
        'name' => 'string',
        'grouping' => 'string',
        'opening_balance' => 'float',
        'closing_balance' => 'float',
        'opening_balance_tax_value' => 'float',
        'closing_balance_tax_value' => 'float',
        'opening_balance_post_type' => 'string',
        'closing_balance_post_type' => 'string'
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
        'name' => null,
        'grouping' => null,
        'opening_balance' => null,
        'closing_balance' => null,
        'opening_balance_tax_value' => null,
        'closing_balance_tax_value' => null,
        'opening_balance_post_type' => null,
        'closing_balance_post_type' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'year_end_report' => false,
		'name' => false,
		'grouping' => false,
		'opening_balance' => false,
		'closing_balance' => false,
		'opening_balance_tax_value' => false,
		'closing_balance_tax_value' => false,
		'opening_balance_post_type' => false,
		'closing_balance_post_type' => false
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
        'name' => 'name',
        'grouping' => 'grouping',
        'opening_balance' => 'openingBalance',
        'closing_balance' => 'closingBalance',
        'opening_balance_tax_value' => 'openingBalanceTaxValue',
        'closing_balance_tax_value' => 'closingBalanceTaxValue',
        'opening_balance_post_type' => 'openingBalancePostType',
        'closing_balance_post_type' => 'closingBalancePostType'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
        'name' => 'setName',
        'grouping' => 'setGrouping',
        'opening_balance' => 'setOpeningBalance',
        'closing_balance' => 'setClosingBalance',
        'opening_balance_tax_value' => 'setOpeningBalanceTaxValue',
        'closing_balance_tax_value' => 'setClosingBalanceTaxValue',
        'opening_balance_post_type' => 'setOpeningBalancePostType',
        'closing_balance_post_type' => 'setClosingBalancePostType'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
        'name' => 'getName',
        'grouping' => 'getGrouping',
        'opening_balance' => 'getOpeningBalance',
        'closing_balance' => 'getClosingBalance',
        'opening_balance_tax_value' => 'getOpeningBalanceTaxValue',
        'closing_balance_tax_value' => 'getClosingBalanceTaxValue',
        'opening_balance_post_type' => 'getOpeningBalancePostType',
        'closing_balance_post_type' => 'getClosingBalancePostType'
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

    public const OPENING_BALANCE_POST_TYPE_REGISTRATION_NUMBER = 'REGISTRATION_NUMBER';
    public const OPENING_BALANCE_POST_TYPE_DESCRIPTION = 'DESCRIPTION';
    public const OPENING_BALANCE_POST_TYPE_VEHICLE_TYPE = 'VEHICLE_TYPE';
    public const OPENING_BALANCE_POST_TYPE_YEAR_OF_INITIAL_REGISTRATION = 'YEAR_OF_INITIAL_REGISTRATION';
    public const OPENING_BALANCE_POST_TYPE_LIST_PRICE = 'LIST_PRICE';
    public const OPENING_BALANCE_POST_TYPE_DATE_FROM = 'DATE_FROM';
    public const OPENING_BALANCE_POST_TYPE_DATE_TO = 'DATE_TO';
    public const OPENING_BALANCE_POST_TYPE_LICENCE = 'LICENCE';
    public const OPENING_BALANCE_POST_TYPE_LICENCE_NUMBER = 'LICENCE_NUMBER';
    public const OPENING_BALANCE_POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED = 'IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED';
    public const OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_TOTAL = 'NO_OF_KILOMETRES_TOTAL';
    public const OPENING_BALANCE_POST_TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
    public const OPENING_BALANCE_POST_TYPE_LEASING_RENT = 'LEASING_RENT';
    public const OPENING_BALANCE_POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE = 'IS_COMPANY_VEHICLE_USED_PRIVATE';
    public const OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_PRIVATE = 'NO_OF_KILOMETRES_PRIVATE';
    public const OPENING_BALANCE_POST_TYPE_DEPRECIATION_PRIVATE_USE = 'DEPRECIATION_PRIVATE_USE';
    public const OPENING_BALANCE_POST_TYPE_REVERSED_VEHICLE_EXPENSES = 'REVERSED_VEHICLE_EXPENSES';
    public const OPENING_BALANCE_POST_TYPE_FUEL_COST = 'FUEL_COST';
    public const OPENING_BALANCE_POST_TYPE_MAINTENANCE_COST = 'MAINTENANCE_COST';
    public const OPENING_BALANCE_POST_TYPE_COST_OF_INSURANCE_AND_TAX = 'COST_OF_INSURANCE_AND_TAX';
    public const OPENING_BALANCE_POST_TYPE_NO_OF_LITER_FUEL = 'NO_OF_LITER_FUEL';
    public const OPENING_BALANCE_POST_TYPE_TAXIMETER_TYPE = 'TAXIMETER_TYPE';
    public const OPENING_BALANCE_POST_TYPE_INCOME_PERSONAL_TRANSPORT = 'INCOME_PERSONAL_TRANSPORT';
    public const OPENING_BALANCE_POST_TYPE_INCOME_GOODS_TRANSPORT = 'INCOME_GOODS_TRANSPORT';
    public const OPENING_BALANCE_POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH = 'DRIVING_INCOME_PAYED_IN_CASH';
    public const OPENING_BALANCE_POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES = 'DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES';
    public const OPENING_BALANCE_POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE = 'TIP_PAYED_WITH_CARD_OR_INVOICE';
    public const OPENING_BALANCE_POST_TYPE_TIP_PAYED_IN_CASH = 'TIP_PAYED_IN_CASH';
    public const OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN = 'NO_OF_KILOMETRES_SCHOOL_CHILDREN';
    public const OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER = 'NO_OF_KILOMETRES_WITH_PASSENGER';
    public const OPENING_BALANCE_POST_TYPE_FLOP_TRIP_AMOUNT = 'FLOP_TRIP_AMOUNT';
    public const OPENING_BALANCE_POST_TYPE_IS_CONNECTED_TO_CENTRAL = 'IS_CONNECTED_TO_CENTRAL';
    public const OPENING_BALANCE_POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT = 'ID_FOR_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT = 'DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_MUNICIPALITY_NUMBER = 'MUNICIPALITY_NUMBER';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE = 'OPENING_BALANCE';
    public const OPENING_BALANCE_POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const OPENING_BALANCE_POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const OPENING_BALANCE_POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK = 'PROFIT_REALIZATIONS_LIVESTOCK';
    public const OPENING_BALANCE_POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS = 'ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS';
    public const OPENING_BALANCE_POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT = 'PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION = 'ANNUAL_INCOME_RECOGNITION';
    public const OPENING_BALANCE_POST_TYPE_ANNUAL_DEDUCTION = 'ANNUAL_DEDUCTION';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE = 'CLOSING_BALANCE';
    public const OPENING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY = 'IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY';
    public const OPENING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS = 'IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS';
    public const OPENING_BALANCE_POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT = 'ID_FOR_ACCOMMODATION_AND_RESTAURANT';
    public const OPENING_BALANCE_POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT = 'COVER_CHARGE_SUBJECT_TO_VAT';
    public const OPENING_BALANCE_POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT = 'COVER_CHARGE_NOT_SUBJECT_TO_VAT';
    public const OPENING_BALANCE_POST_TYPE_COVER_CHARGE = 'COVER_CHARGE';
    public const OPENING_BALANCE_POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT = 'DESCRIPTION_ACCOMMODATION_AND_RESTAURANT';
    public const OPENING_BALANCE_POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR = 'MUST_BE_CONFIRMED_BY_AUDITOR';
    public const OPENING_BALANCE_POST_TYPE_PRODUCT_TYPE = 'PRODUCT_TYPE';
    public const OPENING_BALANCE_POST_TYPE_OPENING_STOCK = 'OPENING_STOCK';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_STOCK = 'CLOSING_STOCK';
    public const OPENING_BALANCE_POST_TYPE_PURCHASE_OF_GOODS = 'PURCHASE_OF_GOODS';
    public const OPENING_BALANCE_POST_TYPE_COST_OF_GOODS_SOLD = 'COST_OF_GOODS_SOLD';
    public const OPENING_BALANCE_POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS = 'SALES_REVENUE_AND_WITHDRAWALS';
    public const OPENING_BALANCE_POST_TYPE_SALES_REVENUE_IN_CASH = 'SALES_REVENUE_IN_CASH';
    public const OPENING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION = 'CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION';
    public const OPENING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_TYPE = 'CASH_REGISTER_SYSTEM_TYPE';
    public const OPENING_BALANCE_POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER = 'WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER';
    public const OPENING_BALANCE_POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT = 'PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE = 'TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE';
    public const OPENING_BALANCE_POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const OPENING_BALANCE_POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE = 'WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE';
    public const OPENING_BALANCE_POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const OPENING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_CREDITSALES = 'OPENING_BALANCE_CREDITSALES';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_CREDITSALES = 'CLOSING_BALANCE_CREDITSALES';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM = 'OPENING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM = 'CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const OPENING_BALANCE_POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE = 'TANGIBLE_FIXED_ASSETS_TYPE';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS = 'OPENING_BALANCE_TANGIBLE_FIXED_ASSETS';
    public const OPENING_BALANCE_POST_TYPE_DEPRECIATION_PERCENTAGE = 'DEPRECIATION_PERCENTAGE';
    public const OPENING_BALANCE_POST_TYPE_STRAIGHT_LINE_DEPRECIATION = 'STRAIGHT_LINE_DEPRECIATION';
    public const OPENING_BALANCE_POST_TYPE_CASH_DEPOSITS = 'CASH_DEPOSITS';
    public const OPENING_BALANCE_POST_TYPE_CONTRIBUTIONS_IN_KIND = 'CONTRIBUTIONS_IN_KIND';
    public const OPENING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH';
    public const OPENING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS';
    public const OPENING_BALANCE_POST_TYPE_DEBT_WAVING = 'DEBT_WAVING';
    public const OPENING_BALANCE_POST_TYPE_BUYING_OWN_SHARES = 'BUYING_OWN_SHARES';
    public const OPENING_BALANCE_POST_TYPE_SELLING_OWN_SHARES = 'SELLING_OWN_SHARES';
    public const OPENING_BALANCE_POST_TYPE_DEBT_CONVERSION_TO_EQUITY = 'DEBT_CONVERSION_TO_EQUITY';
    public const OPENING_BALANCE_POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const OPENING_BALANCE_POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const OPENING_BALANCE_POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY = 'OTHER_POSITIVE_CHANGE_IN_EQUITY';
    public const OPENING_BALANCE_POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY = 'OTHER_NEGATIVE_CHANGE_IN_EQUITY';
    public const OPENING_BALANCE_POST_TYPE_NONE_DEDUCTIBLE_COST = 'NONE_DEDUCTIBLE_COST';
    public const OPENING_BALANCE_POST_TYPE_POSITIVE_TAX_COST = 'POSITIVE_TAX_COST';
    public const OPENING_BALANCE_POST_TYPE_INTEREST_EXPENSE_FIXED_TAX = 'INTEREST_EXPENSE_FIXED_TAX';
    public const OPENING_BALANCE_POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT = 'SHARE_OF_LOSS_FROM_INVESTMENT';
    public const OPENING_BALANCE_POST_TYPE_REVERSAL_OF_IMPAIRMENT = 'REVERSAL_OF_IMPAIRMENT';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_IMPAIRMENT = 'ACCOUNTING_IMPAIRMENT';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS = 'ACCOUNTING_LOSS';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF = 'ACCOUNTING_DEFICIT_NORWEAGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF = 'ACCOUNTING_DEFICIT_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF = 'ACCOUNTING_LOSS_NORWEAGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF = 'ACCOUNTING_LOSS_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_RETURNED_DEBT_INTEREST = 'RETURNED_DEBT_INTEREST';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES = 'TAXABLE_DIVIDEND_ON_SHARES';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION = 'TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION';
    public const OPENING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF = 'SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF = 'SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ADDITION_INTEREST_COST = 'ADDITION_INTEREST_COST';
    public const OPENING_BALANCE_POST_TYPE_CORRECTION_PURPOSED_DIVIDEND = 'CORRECTION_PURPOSED_DIVIDEND';
    public const OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const OPENING_BALANCE_POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE = 'INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE';
    public const OPENING_BALANCE_POST_TYPE_OTHER_INCOME_SUPPLEMENT = 'OTHER_INCOME_SUPPLEMENT';
    public const OPENING_BALANCE_POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS = 'RETURN_OF_INCOME_RELATED_DIVIDENDS';
    public const OPENING_BALANCE_POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION = 'PROFIT_AND_LOSS_GROUP_CONTRIBUTION';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF = 'ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF = 'ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF = 'ACCOUNTING_GAIN_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF = 'ACCOUNTING_GAIN_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const OPENING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF';
    public const OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF';
    public const OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const OPENING_BALANCE_POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST = 'ISSUE_AND_ESTABLISHMENT_COST';
    public const OPENING_BALANCE_POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK = 'INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK';
    public const OPENING_BALANCE_POST_TYPE_OTHER_INCOME_DEDUCTION = 'OTHER_INCOME_DEDUCTION';
    public const OPENING_BALANCE_POST_TYPE_TEMPORARY_DIFFERENCES_TYPE = 'TEMPORARY_DIFFERENCES_TYPE';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE = 'OPENING_BALANCE_ACCOUNTABLE_VALUE';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE = 'CLOSING_BALANCE_ACCOUNTABLE_VALUE';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_TAX_VALUE = 'OPENING_BALANCE_TAX_VALUE';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_TAX_VALUE = 'CLOSING_BALANCE_TAX_VALUE';
    public const OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_DIFFERENCES = 'OPENING_BALANCE_DIFFERENCES';
    public const OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_DIFFERENCES = 'CLOSING_BALANCE_DIFFERENCES';
    public const OPENING_BALANCE_POST_TYPE_SHOW_PROFIT_AND_LOSS = 'SHOW_PROFIT_AND_LOSS';
    public const OPENING_BALANCE_POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT = 'SHOW_ACCOMMODATION_AND_RESTAURANT';
    public const OPENING_BALANCE_POST_TYPE_IS_ACCOUNTABLE = 'IS_ACCOUNTABLE';
    public const OPENING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES = 'USE_ACCOUNTING_VALUES_IN_INVENTORIES';
    public const OPENING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES = 'USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES';
    public const OPENING_BALANCE_POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET = 'SHOW_TANGIBLE_FIXED_ASSET';
    public const OPENING_BALANCE_POST_TYPE_SHOW_CAR = 'SHOW_CAR';
    public const OPENING_BALANCE_POST_TYPE_SHOW_INVENTORIES = 'SHOW_INVENTORIES';
    public const OPENING_BALANCE_POST_TYPE_SHOW_CUSTOMER_RECEIVABLES = 'SHOW_CUSTOMER_RECEIVABLES';
    public const OPENING_BALANCE_POST_TYPE_SHOW_CONCERN_RELATION = 'SHOW_CONCERN_RELATION';
    public const OPENING_BALANCE_POST_TYPE_OWN_BUSINESS_PROPERTIES = 'OWN_BUSINESS_PROPERTIES';
    public const OPENING_BALANCE_POST_TYPE_OWN_ASSET_PAPIR = 'OWN_ASSET_PAPIR';
    public const OPENING_BALANCE_POST_TYPE_TRANSFERED_BY = 'TRANSFERED_BY';
    public const OPENING_BALANCE_POST_TYPE_TRANSFERED_DATE = 'TRANSFERED_DATE';
    public const OPENING_BALANCE_POST_TYPE_SET_ACCOUNTANT_REVISED = 'SET_ACCOUNTANT_REVISED';
    public const OPENING_BALANCE_POST_TYPE_IS_TAXABLE = 'IS_TAXABLE';
    public const OPENING_BALANCE_POST_TYPE_REQUIRE_AUDITORS_SIGNATURE = 'REQUIRE_AUDITORS_SIGNATURE';
    public const OPENING_BALANCE_POST_TYPE_VALIDATION_ONLY_ON_SUBMIT = 'VALIDATION_ONLY_ON_SUBMIT';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_ID = 'YEAR_END_BRREG_DOC_ID';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME = 'YEAR_END_BRREG_DOC_FETCHER_NAME';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT = 'YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT = 'YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE = 'YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS = 'YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES = 'YEAR_END_DOCUMENTATION_INVENTORIES';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS = 'YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS = 'YEAR_END_DOCUMENTATION_PROFIT_LOSS';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE = 'YEAR_END_DOCUMENTATION_BALANCE';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME = 'YEAR_END_DOCUMENTATION_PERSONAL_INCOME';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES = 'YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES = 'YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT = 'YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS = 'YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION = 'YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN = 'YEAR_END_DOCUMENTATION_TAX_RETURN';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND = 'YEAR_END_DOCUMENTATION_DIVIDEND';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS = 'YEAR_END_DOCUMENTATION_DISPOSITIONS';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES = 'YEAR_END_DOCUMENTATION_PROPERTIES';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES = 'YEAR_END_DOCUMENTATION_SECURITIES';
    public const OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION = 'YEAR_END_DOCUMENTATION_TAX_CALCULATION';
    public const OPENING_BALANCE_POST_TYPE_RECEIVER_ORG_NR = 'RECEIVER_ORG_NR';
    public const OPENING_BALANCE_POST_TYPE_RECEIVER_NAME = 'RECEIVER_NAME';
    public const OPENING_BALANCE_POST_TYPE_CONCERN_CONNECTION = 'CONCERN_CONNECTION';
    public const OPENING_BALANCE_POST_TYPE_VOTING_LIMIT = 'VOTING_LIMIT';
    public const OPENING_BALANCE_POST_TYPE_DATE_OF_ACQUISITION = 'DATE_OF_ACQUISITION';
    public const OPENING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const OPENING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const OPENING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const OPENING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const OPENING_BALANCE_POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS = 'APPLICATION_OF_LOSS_CARRY_FORWARDS';
    public const OPENING_BALANCE_POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS = 'ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS';
    public const OPENING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL = 'CORRECTIONS_AND_OTHER_CAPITAL';
    public const OPENING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_DEBT = 'CORRECTIONS_AND_OTHER_DEBT';
    public const OPENING_BALANCE_POST_TYPE_IS_PART_OF_GROUP_COMPANY = 'IS_PART_OF_GROUP_COMPANY';
    public const OPENING_BALANCE_POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE = 'IS_LISTED_ON_THE_STOCK_EXCHANGE';
    public const OPENING_BALANCE_POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS = 'IS_REORGANIZED_ACROSS_BORDERS';
    public const OPENING_BALANCE_POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS = 'HAS_RECEIVED_OR_TRANSFERED_ASSETS';
    public const OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_NAME = 'HEAD_OF_GROUP_NAME';
    public const OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE = 'HEAD_OF_GROUP_COUNTRY_CODE';
    public const OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME = 'HEAD_OF_GROUP_LAST_YEAR_NAME';
    public const OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE = 'HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE';
    public const OPENING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME = 'FOREIGN_OWNERSHIP_COMPANY_NAME';
    public const OPENING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE = 'FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE';
    public const OPENING_BALANCE_POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY = 'OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY';
    public const OPENING_BALANCE_POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD = 'HAS_PERMANENT_ESTABLISHMENT_ABROAD';
    public const OPENING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME';
    public const OPENING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE';
    public const OPENING_BALANCE_POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER = 'HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER';
    public const OPENING_BALANCE_POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID = 'HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID';
    public const OPENING_BALANCE_POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS = 'IS_SMALL_OR_MEDIUM_SIZED_BUSINESS';
    public const OPENING_BALANCE_POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR = 'HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR';
    public const OPENING_BALANCE_POST_TYPE_IS_GROUP_COMPANY = 'IS_GROUP_COMPANY';
    public const OPENING_BALANCE_POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT = 'HAS_RECEIVED_OTHER_PUBLIC_SUPPORT';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME = 'AID_SCHEME_TONNAGE_TAX_REGIME';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS = 'AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS = 'AID_SCHEME_FOR_LONGTERM_INVESTMENTS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP = 'AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_TAX_FUN = 'AID_SCHEME_TAX_FUN';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES = 'AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS = 'AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES = 'AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL = 'AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS = 'AID_SCHEME_EXEMPTION_CO2_TAX_GAS';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY = 'AID_SCHEME_EXEMPTION_NOX_DUTY';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE = 'AID_SCHEME_EXEMPTION_TRANSFER_FEE';
    public const OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX = 'AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX';
    public const OPENING_BALANCE_POST_TYPE_OTHER_CORRECTIONS = 'OTHER_CORRECTIONS';
    public const OPENING_BALANCE_POST_TYPE_YEARLY_DIVIDEND = 'YEARLY_DIVIDEND';
    public const CLOSING_BALANCE_POST_TYPE_REGISTRATION_NUMBER = 'REGISTRATION_NUMBER';
    public const CLOSING_BALANCE_POST_TYPE_DESCRIPTION = 'DESCRIPTION';
    public const CLOSING_BALANCE_POST_TYPE_VEHICLE_TYPE = 'VEHICLE_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_OF_INITIAL_REGISTRATION = 'YEAR_OF_INITIAL_REGISTRATION';
    public const CLOSING_BALANCE_POST_TYPE_LIST_PRICE = 'LIST_PRICE';
    public const CLOSING_BALANCE_POST_TYPE_DATE_FROM = 'DATE_FROM';
    public const CLOSING_BALANCE_POST_TYPE_DATE_TO = 'DATE_TO';
    public const CLOSING_BALANCE_POST_TYPE_LICENCE = 'LICENCE';
    public const CLOSING_BALANCE_POST_TYPE_LICENCE_NUMBER = 'LICENCE_NUMBER';
    public const CLOSING_BALANCE_POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED = 'IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED';
    public const CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_TOTAL = 'NO_OF_KILOMETRES_TOTAL';
    public const CLOSING_BALANCE_POST_TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
    public const CLOSING_BALANCE_POST_TYPE_LEASING_RENT = 'LEASING_RENT';
    public const CLOSING_BALANCE_POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE = 'IS_COMPANY_VEHICLE_USED_PRIVATE';
    public const CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_PRIVATE = 'NO_OF_KILOMETRES_PRIVATE';
    public const CLOSING_BALANCE_POST_TYPE_DEPRECIATION_PRIVATE_USE = 'DEPRECIATION_PRIVATE_USE';
    public const CLOSING_BALANCE_POST_TYPE_REVERSED_VEHICLE_EXPENSES = 'REVERSED_VEHICLE_EXPENSES';
    public const CLOSING_BALANCE_POST_TYPE_FUEL_COST = 'FUEL_COST';
    public const CLOSING_BALANCE_POST_TYPE_MAINTENANCE_COST = 'MAINTENANCE_COST';
    public const CLOSING_BALANCE_POST_TYPE_COST_OF_INSURANCE_AND_TAX = 'COST_OF_INSURANCE_AND_TAX';
    public const CLOSING_BALANCE_POST_TYPE_NO_OF_LITER_FUEL = 'NO_OF_LITER_FUEL';
    public const CLOSING_BALANCE_POST_TYPE_TAXIMETER_TYPE = 'TAXIMETER_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_INCOME_PERSONAL_TRANSPORT = 'INCOME_PERSONAL_TRANSPORT';
    public const CLOSING_BALANCE_POST_TYPE_INCOME_GOODS_TRANSPORT = 'INCOME_GOODS_TRANSPORT';
    public const CLOSING_BALANCE_POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH = 'DRIVING_INCOME_PAYED_IN_CASH';
    public const CLOSING_BALANCE_POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES = 'DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES';
    public const CLOSING_BALANCE_POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE = 'TIP_PAYED_WITH_CARD_OR_INVOICE';
    public const CLOSING_BALANCE_POST_TYPE_TIP_PAYED_IN_CASH = 'TIP_PAYED_IN_CASH';
    public const CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN = 'NO_OF_KILOMETRES_SCHOOL_CHILDREN';
    public const CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER = 'NO_OF_KILOMETRES_WITH_PASSENGER';
    public const CLOSING_BALANCE_POST_TYPE_FLOP_TRIP_AMOUNT = 'FLOP_TRIP_AMOUNT';
    public const CLOSING_BALANCE_POST_TYPE_IS_CONNECTED_TO_CENTRAL = 'IS_CONNECTED_TO_CENTRAL';
    public const CLOSING_BALANCE_POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT = 'ID_FOR_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT = 'DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_MUNICIPALITY_NUMBER = 'MUNICIPALITY_NUMBER';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE = 'OPENING_BALANCE';
    public const CLOSING_BALANCE_POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const CLOSING_BALANCE_POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS = 'LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS';
    public const CLOSING_BALANCE_POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK = 'PROFIT_REALIZATIONS_LIVESTOCK';
    public const CLOSING_BALANCE_POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT = 'VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS = 'ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS';
    public const CLOSING_BALANCE_POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT = 'PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION = 'ANNUAL_INCOME_RECOGNITION';
    public const CLOSING_BALANCE_POST_TYPE_ANNUAL_DEDUCTION = 'ANNUAL_DEDUCTION';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE = 'CLOSING_BALANCE';
    public const CLOSING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY = 'IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY';
    public const CLOSING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS = 'IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS';
    public const CLOSING_BALANCE_POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT = 'ID_FOR_ACCOMMODATION_AND_RESTAURANT';
    public const CLOSING_BALANCE_POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT = 'COVER_CHARGE_SUBJECT_TO_VAT';
    public const CLOSING_BALANCE_POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT = 'COVER_CHARGE_NOT_SUBJECT_TO_VAT';
    public const CLOSING_BALANCE_POST_TYPE_COVER_CHARGE = 'COVER_CHARGE';
    public const CLOSING_BALANCE_POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT = 'DESCRIPTION_ACCOMMODATION_AND_RESTAURANT';
    public const CLOSING_BALANCE_POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR = 'MUST_BE_CONFIRMED_BY_AUDITOR';
    public const CLOSING_BALANCE_POST_TYPE_PRODUCT_TYPE = 'PRODUCT_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_STOCK = 'OPENING_STOCK';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_STOCK = 'CLOSING_STOCK';
    public const CLOSING_BALANCE_POST_TYPE_PURCHASE_OF_GOODS = 'PURCHASE_OF_GOODS';
    public const CLOSING_BALANCE_POST_TYPE_COST_OF_GOODS_SOLD = 'COST_OF_GOODS_SOLD';
    public const CLOSING_BALANCE_POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS = 'SALES_REVENUE_AND_WITHDRAWALS';
    public const CLOSING_BALANCE_POST_TYPE_SALES_REVENUE_IN_CASH = 'SALES_REVENUE_IN_CASH';
    public const CLOSING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION = 'CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION';
    public const CLOSING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_TYPE = 'CASH_REGISTER_SYSTEM_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER = 'WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER';
    public const CLOSING_BALANCE_POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT = 'PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE = 'TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE';
    public const CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE = 'WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE';
    public const CLOSING_BALANCE_POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const CLOSING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT = 'TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_CREDITSALES = 'OPENING_BALANCE_CREDITSALES';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_CREDITSALES = 'CLOSING_BALANCE_CREDITSALES';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY = 'CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS = 'CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING = 'CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM = 'OPENING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM = 'CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE = 'CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE';
    public const CLOSING_BALANCE_POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE = 'TANGIBLE_FIXED_ASSETS_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS = 'OPENING_BALANCE_TANGIBLE_FIXED_ASSETS';
    public const CLOSING_BALANCE_POST_TYPE_DEPRECIATION_PERCENTAGE = 'DEPRECIATION_PERCENTAGE';
    public const CLOSING_BALANCE_POST_TYPE_STRAIGHT_LINE_DEPRECIATION = 'STRAIGHT_LINE_DEPRECIATION';
    public const CLOSING_BALANCE_POST_TYPE_CASH_DEPOSITS = 'CASH_DEPOSITS';
    public const CLOSING_BALANCE_POST_TYPE_CONTRIBUTIONS_IN_KIND = 'CONTRIBUTIONS_IN_KIND';
    public const CLOSING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH';
    public const CLOSING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS = 'CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS';
    public const CLOSING_BALANCE_POST_TYPE_DEBT_WAVING = 'DEBT_WAVING';
    public const CLOSING_BALANCE_POST_TYPE_BUYING_OWN_SHARES = 'BUYING_OWN_SHARES';
    public const CLOSING_BALANCE_POST_TYPE_SELLING_OWN_SHARES = 'SELLING_OWN_SHARES';
    public const CLOSING_BALANCE_POST_TYPE_DEBT_CONVERSION_TO_EQUITY = 'DEBT_CONVERSION_TO_EQUITY';
    public const CLOSING_BALANCE_POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const CLOSING_BALANCE_POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND = 'NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND';
    public const CLOSING_BALANCE_POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY = 'OTHER_POSITIVE_CHANGE_IN_EQUITY';
    public const CLOSING_BALANCE_POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY = 'OTHER_NEGATIVE_CHANGE_IN_EQUITY';
    public const CLOSING_BALANCE_POST_TYPE_NONE_DEDUCTIBLE_COST = 'NONE_DEDUCTIBLE_COST';
    public const CLOSING_BALANCE_POST_TYPE_POSITIVE_TAX_COST = 'POSITIVE_TAX_COST';
    public const CLOSING_BALANCE_POST_TYPE_INTEREST_EXPENSE_FIXED_TAX = 'INTEREST_EXPENSE_FIXED_TAX';
    public const CLOSING_BALANCE_POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT = 'SHARE_OF_LOSS_FROM_INVESTMENT';
    public const CLOSING_BALANCE_POST_TYPE_REVERSAL_OF_IMPAIRMENT = 'REVERSAL_OF_IMPAIRMENT';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_IMPAIRMENT = 'ACCOUNTING_IMPAIRMENT';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS = 'ACCOUNTING_LOSS';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF = 'ACCOUNTING_DEFICIT_NORWEAGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF = 'ACCOUNTING_DEFICIT_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF = 'ACCOUNTING_LOSS_NORWEAGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF = 'ACCOUNTING_LOSS_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_RETURNED_DEBT_INTEREST = 'RETURNED_DEBT_INTEREST';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES = 'TAXABLE_DIVIDEND_ON_SHARES';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION = 'TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION';
    public const CLOSING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF = 'SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF = 'SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF = 'TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ADDITION_INTEREST_COST = 'ADDITION_INTEREST_COST';
    public const CLOSING_BALANCE_POST_TYPE_CORRECTION_PURPOSED_DIVIDEND = 'CORRECTION_PURPOSED_DIVIDEND';
    public const CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const CLOSING_BALANCE_POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE = 'INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE';
    public const CLOSING_BALANCE_POST_TYPE_OTHER_INCOME_SUPPLEMENT = 'OTHER_INCOME_SUPPLEMENT';
    public const CLOSING_BALANCE_POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS = 'RETURN_OF_INCOME_RELATED_DIVIDENDS';
    public const CLOSING_BALANCE_POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION = 'PROFIT_AND_LOSS_GROUP_CONTRIBUTION';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF = 'ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF = 'ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF = 'ACCOUNTING_GAIN_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF = 'ACCOUNTING_GAIN_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS = 'DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS';
    public const CLOSING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF = 'SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF = 'DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF';
    public const CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA = 'DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA';
    public const CLOSING_BALANCE_POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST = 'ISSUE_AND_ESTABLISHMENT_COST';
    public const CLOSING_BALANCE_POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK = 'INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK';
    public const CLOSING_BALANCE_POST_TYPE_OTHER_INCOME_DEDUCTION = 'OTHER_INCOME_DEDUCTION';
    public const CLOSING_BALANCE_POST_TYPE_TEMPORARY_DIFFERENCES_TYPE = 'TEMPORARY_DIFFERENCES_TYPE';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE = 'OPENING_BALANCE_ACCOUNTABLE_VALUE';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE = 'CLOSING_BALANCE_ACCOUNTABLE_VALUE';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_TAX_VALUE = 'OPENING_BALANCE_TAX_VALUE';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_TAX_VALUE = 'CLOSING_BALANCE_TAX_VALUE';
    public const CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_DIFFERENCES = 'OPENING_BALANCE_DIFFERENCES';
    public const CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_DIFFERENCES = 'CLOSING_BALANCE_DIFFERENCES';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_PROFIT_AND_LOSS = 'SHOW_PROFIT_AND_LOSS';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT = 'SHOW_ACCOMMODATION_AND_RESTAURANT';
    public const CLOSING_BALANCE_POST_TYPE_IS_ACCOUNTABLE = 'IS_ACCOUNTABLE';
    public const CLOSING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES = 'USE_ACCOUNTING_VALUES_IN_INVENTORIES';
    public const CLOSING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES = 'USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET = 'SHOW_TANGIBLE_FIXED_ASSET';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_CAR = 'SHOW_CAR';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_INVENTORIES = 'SHOW_INVENTORIES';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_CUSTOMER_RECEIVABLES = 'SHOW_CUSTOMER_RECEIVABLES';
    public const CLOSING_BALANCE_POST_TYPE_SHOW_CONCERN_RELATION = 'SHOW_CONCERN_RELATION';
    public const CLOSING_BALANCE_POST_TYPE_OWN_BUSINESS_PROPERTIES = 'OWN_BUSINESS_PROPERTIES';
    public const CLOSING_BALANCE_POST_TYPE_OWN_ASSET_PAPIR = 'OWN_ASSET_PAPIR';
    public const CLOSING_BALANCE_POST_TYPE_TRANSFERED_BY = 'TRANSFERED_BY';
    public const CLOSING_BALANCE_POST_TYPE_TRANSFERED_DATE = 'TRANSFERED_DATE';
    public const CLOSING_BALANCE_POST_TYPE_SET_ACCOUNTANT_REVISED = 'SET_ACCOUNTANT_REVISED';
    public const CLOSING_BALANCE_POST_TYPE_IS_TAXABLE = 'IS_TAXABLE';
    public const CLOSING_BALANCE_POST_TYPE_REQUIRE_AUDITORS_SIGNATURE = 'REQUIRE_AUDITORS_SIGNATURE';
    public const CLOSING_BALANCE_POST_TYPE_VALIDATION_ONLY_ON_SUBMIT = 'VALIDATION_ONLY_ON_SUBMIT';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_ID = 'YEAR_END_BRREG_DOC_ID';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME = 'YEAR_END_BRREG_DOC_FETCHER_NAME';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT = 'YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT = 'YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE = 'YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS = 'YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES = 'YEAR_END_DOCUMENTATION_INVENTORIES';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS = 'YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS = 'YEAR_END_DOCUMENTATION_PROFIT_LOSS';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE = 'YEAR_END_DOCUMENTATION_BALANCE';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME = 'YEAR_END_DOCUMENTATION_PERSONAL_INCOME';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES = 'YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES = 'YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT = 'YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS = 'YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION = 'YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN = 'YEAR_END_DOCUMENTATION_TAX_RETURN';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND = 'YEAR_END_DOCUMENTATION_DIVIDEND';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS = 'YEAR_END_DOCUMENTATION_DISPOSITIONS';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES = 'YEAR_END_DOCUMENTATION_PROPERTIES';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES = 'YEAR_END_DOCUMENTATION_SECURITIES';
    public const CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION = 'YEAR_END_DOCUMENTATION_TAX_CALCULATION';
    public const CLOSING_BALANCE_POST_TYPE_RECEIVER_ORG_NR = 'RECEIVER_ORG_NR';
    public const CLOSING_BALANCE_POST_TYPE_RECEIVER_NAME = 'RECEIVER_NAME';
    public const CLOSING_BALANCE_POST_TYPE_CONCERN_CONNECTION = 'CONCERN_CONNECTION';
    public const CLOSING_BALANCE_POST_TYPE_VOTING_LIMIT = 'VOTING_LIMIT';
    public const CLOSING_BALANCE_POST_TYPE_DATE_OF_ACQUISITION = 'DATE_OF_ACQUISITION';
    public const CLOSING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const CLOSING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const CLOSING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION';
    public const CLOSING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION = 'SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION';
    public const CLOSING_BALANCE_POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS = 'APPLICATION_OF_LOSS_CARRY_FORWARDS';
    public const CLOSING_BALANCE_POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS = 'ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS';
    public const CLOSING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL = 'CORRECTIONS_AND_OTHER_CAPITAL';
    public const CLOSING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_DEBT = 'CORRECTIONS_AND_OTHER_DEBT';
    public const CLOSING_BALANCE_POST_TYPE_IS_PART_OF_GROUP_COMPANY = 'IS_PART_OF_GROUP_COMPANY';
    public const CLOSING_BALANCE_POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE = 'IS_LISTED_ON_THE_STOCK_EXCHANGE';
    public const CLOSING_BALANCE_POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS = 'IS_REORGANIZED_ACROSS_BORDERS';
    public const CLOSING_BALANCE_POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS = 'HAS_RECEIVED_OR_TRANSFERED_ASSETS';
    public const CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_NAME = 'HEAD_OF_GROUP_NAME';
    public const CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE = 'HEAD_OF_GROUP_COUNTRY_CODE';
    public const CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME = 'HEAD_OF_GROUP_LAST_YEAR_NAME';
    public const CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE = 'HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE';
    public const CLOSING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME = 'FOREIGN_OWNERSHIP_COMPANY_NAME';
    public const CLOSING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE = 'FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE';
    public const CLOSING_BALANCE_POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY = 'OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY';
    public const CLOSING_BALANCE_POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD = 'HAS_PERMANENT_ESTABLISHMENT_ABROAD';
    public const CLOSING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME';
    public const CLOSING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE = 'COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE';
    public const CLOSING_BALANCE_POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER = 'HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER';
    public const CLOSING_BALANCE_POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID = 'HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID';
    public const CLOSING_BALANCE_POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS = 'IS_SMALL_OR_MEDIUM_SIZED_BUSINESS';
    public const CLOSING_BALANCE_POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR = 'HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR';
    public const CLOSING_BALANCE_POST_TYPE_IS_GROUP_COMPANY = 'IS_GROUP_COMPANY';
    public const CLOSING_BALANCE_POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT = 'HAS_RECEIVED_OTHER_PUBLIC_SUPPORT';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME = 'AID_SCHEME_TONNAGE_TAX_REGIME';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS = 'AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS = 'AID_SCHEME_FOR_LONGTERM_INVESTMENTS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP = 'AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_TAX_FUN = 'AID_SCHEME_TAX_FUN';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES = 'AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS = 'AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES = 'AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS = 'AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS = 'AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS = 'AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY = 'AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL = 'AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS = 'AID_SCHEME_EXEMPTION_CO2_TAX_GAS';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY = 'AID_SCHEME_EXEMPTION_NOX_DUTY';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE = 'AID_SCHEME_EXEMPTION_TRANSFER_FEE';
    public const CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX = 'AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX';
    public const CLOSING_BALANCE_POST_TYPE_OTHER_CORRECTIONS = 'OTHER_CORRECTIONS';
    public const CLOSING_BALANCE_POST_TYPE_YEARLY_DIVIDEND = 'YEARLY_DIVIDEND';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOpeningBalancePostTypeAllowableValues()
    {
        return [
            self::OPENING_BALANCE_POST_TYPE_REGISTRATION_NUMBER,
            self::OPENING_BALANCE_POST_TYPE_DESCRIPTION,
            self::OPENING_BALANCE_POST_TYPE_VEHICLE_TYPE,
            self::OPENING_BALANCE_POST_TYPE_YEAR_OF_INITIAL_REGISTRATION,
            self::OPENING_BALANCE_POST_TYPE_LIST_PRICE,
            self::OPENING_BALANCE_POST_TYPE_DATE_FROM,
            self::OPENING_BALANCE_POST_TYPE_DATE_TO,
            self::OPENING_BALANCE_POST_TYPE_LICENCE,
            self::OPENING_BALANCE_POST_TYPE_LICENCE_NUMBER,
            self::OPENING_BALANCE_POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED,
            self::OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_TOTAL,
            self::OPENING_BALANCE_POST_TYPE_OPERATING_EXPENSES,
            self::OPENING_BALANCE_POST_TYPE_LEASING_RENT,
            self::OPENING_BALANCE_POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE,
            self::OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_PRIVATE,
            self::OPENING_BALANCE_POST_TYPE_DEPRECIATION_PRIVATE_USE,
            self::OPENING_BALANCE_POST_TYPE_REVERSED_VEHICLE_EXPENSES,
            self::OPENING_BALANCE_POST_TYPE_FUEL_COST,
            self::OPENING_BALANCE_POST_TYPE_MAINTENANCE_COST,
            self::OPENING_BALANCE_POST_TYPE_COST_OF_INSURANCE_AND_TAX,
            self::OPENING_BALANCE_POST_TYPE_NO_OF_LITER_FUEL,
            self::OPENING_BALANCE_POST_TYPE_TAXIMETER_TYPE,
            self::OPENING_BALANCE_POST_TYPE_INCOME_PERSONAL_TRANSPORT,
            self::OPENING_BALANCE_POST_TYPE_INCOME_GOODS_TRANSPORT,
            self::OPENING_BALANCE_POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH,
            self::OPENING_BALANCE_POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES,
            self::OPENING_BALANCE_POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE,
            self::OPENING_BALANCE_POST_TYPE_TIP_PAYED_IN_CASH,
            self::OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN,
            self::OPENING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER,
            self::OPENING_BALANCE_POST_TYPE_FLOP_TRIP_AMOUNT,
            self::OPENING_BALANCE_POST_TYPE_IS_CONNECTED_TO_CENTRAL,
            self::OPENING_BALANCE_POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_MUNICIPALITY_NUMBER,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE,
            self::OPENING_BALANCE_POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::OPENING_BALANCE_POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::OPENING_BALANCE_POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK,
            self::OPENING_BALANCE_POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS,
            self::OPENING_BALANCE_POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION,
            self::OPENING_BALANCE_POST_TYPE_ANNUAL_DEDUCTION,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE,
            self::OPENING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY,
            self::OPENING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS,
            self::OPENING_BALANCE_POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT,
            self::OPENING_BALANCE_POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT,
            self::OPENING_BALANCE_POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT,
            self::OPENING_BALANCE_POST_TYPE_COVER_CHARGE,
            self::OPENING_BALANCE_POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT,
            self::OPENING_BALANCE_POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR,
            self::OPENING_BALANCE_POST_TYPE_PRODUCT_TYPE,
            self::OPENING_BALANCE_POST_TYPE_OPENING_STOCK,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_STOCK,
            self::OPENING_BALANCE_POST_TYPE_PURCHASE_OF_GOODS,
            self::OPENING_BALANCE_POST_TYPE_COST_OF_GOODS_SOLD,
            self::OPENING_BALANCE_POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS,
            self::OPENING_BALANCE_POST_TYPE_SALES_REVENUE_IN_CASH,
            self::OPENING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION,
            self::OPENING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_TYPE,
            self::OPENING_BALANCE_POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER,
            self::OPENING_BALANCE_POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE,
            self::OPENING_BALANCE_POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::OPENING_BALANCE_POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE,
            self::OPENING_BALANCE_POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::OPENING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_CREDITSALES,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_CREDITSALES,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::OPENING_BALANCE_POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS,
            self::OPENING_BALANCE_POST_TYPE_DEPRECIATION_PERCENTAGE,
            self::OPENING_BALANCE_POST_TYPE_STRAIGHT_LINE_DEPRECIATION,
            self::OPENING_BALANCE_POST_TYPE_CASH_DEPOSITS,
            self::OPENING_BALANCE_POST_TYPE_CONTRIBUTIONS_IN_KIND,
            self::OPENING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH,
            self::OPENING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS,
            self::OPENING_BALANCE_POST_TYPE_DEBT_WAVING,
            self::OPENING_BALANCE_POST_TYPE_BUYING_OWN_SHARES,
            self::OPENING_BALANCE_POST_TYPE_SELLING_OWN_SHARES,
            self::OPENING_BALANCE_POST_TYPE_DEBT_CONVERSION_TO_EQUITY,
            self::OPENING_BALANCE_POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::OPENING_BALANCE_POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::OPENING_BALANCE_POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY,
            self::OPENING_BALANCE_POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY,
            self::OPENING_BALANCE_POST_TYPE_NONE_DEDUCTIBLE_COST,
            self::OPENING_BALANCE_POST_TYPE_POSITIVE_TAX_COST,
            self::OPENING_BALANCE_POST_TYPE_INTEREST_EXPENSE_FIXED_TAX,
            self::OPENING_BALANCE_POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT,
            self::OPENING_BALANCE_POST_TYPE_REVERSAL_OF_IMPAIRMENT,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_IMPAIRMENT,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_RETURNED_DEBT_INTEREST,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION,
            self::OPENING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ADDITION_INTEREST_COST,
            self::OPENING_BALANCE_POST_TYPE_CORRECTION_PURPOSED_DIVIDEND,
            self::OPENING_BALANCE_POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::OPENING_BALANCE_POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE,
            self::OPENING_BALANCE_POST_TYPE_OTHER_INCOME_SUPPLEMENT,
            self::OPENING_BALANCE_POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS,
            self::OPENING_BALANCE_POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::OPENING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF,
            self::OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF,
            self::OPENING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::OPENING_BALANCE_POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST,
            self::OPENING_BALANCE_POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK,
            self::OPENING_BALANCE_POST_TYPE_OTHER_INCOME_DEDUCTION,
            self::OPENING_BALANCE_POST_TYPE_TEMPORARY_DIFFERENCES_TYPE,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_TAX_VALUE,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_TAX_VALUE,
            self::OPENING_BALANCE_POST_TYPE_OPENING_BALANCE_DIFFERENCES,
            self::OPENING_BALANCE_POST_TYPE_CLOSING_BALANCE_DIFFERENCES,
            self::OPENING_BALANCE_POST_TYPE_SHOW_PROFIT_AND_LOSS,
            self::OPENING_BALANCE_POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT,
            self::OPENING_BALANCE_POST_TYPE_IS_ACCOUNTABLE,
            self::OPENING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES,
            self::OPENING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES,
            self::OPENING_BALANCE_POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET,
            self::OPENING_BALANCE_POST_TYPE_SHOW_CAR,
            self::OPENING_BALANCE_POST_TYPE_SHOW_INVENTORIES,
            self::OPENING_BALANCE_POST_TYPE_SHOW_CUSTOMER_RECEIVABLES,
            self::OPENING_BALANCE_POST_TYPE_SHOW_CONCERN_RELATION,
            self::OPENING_BALANCE_POST_TYPE_OWN_BUSINESS_PROPERTIES,
            self::OPENING_BALANCE_POST_TYPE_OWN_ASSET_PAPIR,
            self::OPENING_BALANCE_POST_TYPE_TRANSFERED_BY,
            self::OPENING_BALANCE_POST_TYPE_TRANSFERED_DATE,
            self::OPENING_BALANCE_POST_TYPE_SET_ACCOUNTANT_REVISED,
            self::OPENING_BALANCE_POST_TYPE_IS_TAXABLE,
            self::OPENING_BALANCE_POST_TYPE_REQUIRE_AUDITORS_SIGNATURE,
            self::OPENING_BALANCE_POST_TYPE_VALIDATION_ONLY_ON_SUBMIT,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_ID,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES,
            self::OPENING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION,
            self::OPENING_BALANCE_POST_TYPE_RECEIVER_ORG_NR,
            self::OPENING_BALANCE_POST_TYPE_RECEIVER_NAME,
            self::OPENING_BALANCE_POST_TYPE_CONCERN_CONNECTION,
            self::OPENING_BALANCE_POST_TYPE_VOTING_LIMIT,
            self::OPENING_BALANCE_POST_TYPE_DATE_OF_ACQUISITION,
            self::OPENING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::OPENING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::OPENING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::OPENING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::OPENING_BALANCE_POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS,
            self::OPENING_BALANCE_POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS,
            self::OPENING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL,
            self::OPENING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_DEBT,
            self::OPENING_BALANCE_POST_TYPE_IS_PART_OF_GROUP_COMPANY,
            self::OPENING_BALANCE_POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE,
            self::OPENING_BALANCE_POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS,
            self::OPENING_BALANCE_POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS,
            self::OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_NAME,
            self::OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE,
            self::OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME,
            self::OPENING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE,
            self::OPENING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME,
            self::OPENING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE,
            self::OPENING_BALANCE_POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY,
            self::OPENING_BALANCE_POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD,
            self::OPENING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME,
            self::OPENING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE,
            self::OPENING_BALANCE_POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER,
            self::OPENING_BALANCE_POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID,
            self::OPENING_BALANCE_POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS,
            self::OPENING_BALANCE_POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR,
            self::OPENING_BALANCE_POST_TYPE_IS_GROUP_COMPANY,
            self::OPENING_BALANCE_POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_TAX_FUN,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE,
            self::OPENING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX,
            self::OPENING_BALANCE_POST_TYPE_OTHER_CORRECTIONS,
            self::OPENING_BALANCE_POST_TYPE_YEARLY_DIVIDEND,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getClosingBalancePostTypeAllowableValues()
    {
        return [
            self::CLOSING_BALANCE_POST_TYPE_REGISTRATION_NUMBER,
            self::CLOSING_BALANCE_POST_TYPE_DESCRIPTION,
            self::CLOSING_BALANCE_POST_TYPE_VEHICLE_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_OF_INITIAL_REGISTRATION,
            self::CLOSING_BALANCE_POST_TYPE_LIST_PRICE,
            self::CLOSING_BALANCE_POST_TYPE_DATE_FROM,
            self::CLOSING_BALANCE_POST_TYPE_DATE_TO,
            self::CLOSING_BALANCE_POST_TYPE_LICENCE,
            self::CLOSING_BALANCE_POST_TYPE_LICENCE_NUMBER,
            self::CLOSING_BALANCE_POST_TYPE_IS_ELECTRONIC_VEHICLE_LOGBOOK_LOGGED,
            self::CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_TOTAL,
            self::CLOSING_BALANCE_POST_TYPE_OPERATING_EXPENSES,
            self::CLOSING_BALANCE_POST_TYPE_LEASING_RENT,
            self::CLOSING_BALANCE_POST_TYPE_IS_COMPANY_VEHICLE_USED_PRIVATE,
            self::CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_PRIVATE,
            self::CLOSING_BALANCE_POST_TYPE_DEPRECIATION_PRIVATE_USE,
            self::CLOSING_BALANCE_POST_TYPE_REVERSED_VEHICLE_EXPENSES,
            self::CLOSING_BALANCE_POST_TYPE_FUEL_COST,
            self::CLOSING_BALANCE_POST_TYPE_MAINTENANCE_COST,
            self::CLOSING_BALANCE_POST_TYPE_COST_OF_INSURANCE_AND_TAX,
            self::CLOSING_BALANCE_POST_TYPE_NO_OF_LITER_FUEL,
            self::CLOSING_BALANCE_POST_TYPE_TAXIMETER_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_INCOME_PERSONAL_TRANSPORT,
            self::CLOSING_BALANCE_POST_TYPE_INCOME_GOODS_TRANSPORT,
            self::CLOSING_BALANCE_POST_TYPE_DRIVING_INCOME_PAYED_IN_CASH,
            self::CLOSING_BALANCE_POST_TYPE_DRIVING_INCOME_INVOICED_PUBLIC_AGENCIES,
            self::CLOSING_BALANCE_POST_TYPE_TIP_PAYED_WITH_CARD_OR_INVOICE,
            self::CLOSING_BALANCE_POST_TYPE_TIP_PAYED_IN_CASH,
            self::CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_SCHOOL_CHILDREN,
            self::CLOSING_BALANCE_POST_TYPE_NO_OF_KILOMETRES_WITH_PASSENGER,
            self::CLOSING_BALANCE_POST_TYPE_FLOP_TRIP_AMOUNT,
            self::CLOSING_BALANCE_POST_TYPE_IS_CONNECTED_TO_CENTRAL,
            self::CLOSING_BALANCE_POST_TYPE_ID_FOR_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_DESCRIPTION_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_MUNICIPALITY_NUMBER,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE,
            self::CLOSING_BALANCE_POST_TYPE_PROFIT_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::CLOSING_BALANCE_POST_TYPE_LOSS_SALES_WITHDRAWAL_OTHER_REALIZATIONS,
            self::CLOSING_BALANCE_POST_TYPE_PROFIT_REALIZATIONS_LIVESTOCK,
            self::CLOSING_BALANCE_POST_TYPE_VALUE_ACQUIRED_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_VALUE_REALIZED_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION_OR_DEDUCTION_BASIS,
            self::CLOSING_BALANCE_POST_TYPE_PERCENTAGE_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_ANNUAL_INCOME_RECOGNITION,
            self::CLOSING_BALANCE_POST_TYPE_ANNUAL_DEDUCTION,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE,
            self::CLOSING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_SEPARATED_PLOT_AGRICULTURE_OR_FORESTRY,
            self::CLOSING_BALANCE_POST_TYPE_IS_REGARDING_REALIZATION_WHOLE_AGRICULTURE_OR_FORESTRY_BUSINESS,
            self::CLOSING_BALANCE_POST_TYPE_ID_FOR_ACCOMMODATION_AND_RESTAURANT,
            self::CLOSING_BALANCE_POST_TYPE_COVER_CHARGE_SUBJECT_TO_VAT,
            self::CLOSING_BALANCE_POST_TYPE_COVER_CHARGE_NOT_SUBJECT_TO_VAT,
            self::CLOSING_BALANCE_POST_TYPE_COVER_CHARGE,
            self::CLOSING_BALANCE_POST_TYPE_DESCRIPTION_ACCOMMODATION_AND_RESTAURANT,
            self::CLOSING_BALANCE_POST_TYPE_MUST_BE_CONFIRMED_BY_AUDITOR,
            self::CLOSING_BALANCE_POST_TYPE_PRODUCT_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_STOCK,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_STOCK,
            self::CLOSING_BALANCE_POST_TYPE_PURCHASE_OF_GOODS,
            self::CLOSING_BALANCE_POST_TYPE_COST_OF_GOODS_SOLD,
            self::CLOSING_BALANCE_POST_TYPE_SALES_REVENUE_AND_WITHDRAWALS,
            self::CLOSING_BALANCE_POST_TYPE_SALES_REVENUE_IN_CASH,
            self::CLOSING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_YEAR_OF_INITIAL_REGISTRATION,
            self::CLOSING_BALANCE_POST_TYPE_CASH_REGISTER_SYSTEM_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_OF_PRODUCTS_VALUED_AT_TURNOVER,
            self::CLOSING_BALANCE_POST_TYPE_PRIVATE_WITHDRAWAL_ENTERED_ON_PRIVATE_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_PRODUCTS_ENTERED_AS_SALES_REVENUE,
            self::CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::CLOSING_BALANCE_POST_TYPE_WITHDRAWAL_VALUE_VALUED_AT_MARKET_VALUE,
            self::CLOSING_BALANCE_POST_TYPE_MARKUP_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::CLOSING_BALANCE_POST_TYPE_TOTAL_WITHDRAWAL_COST_FOR_ENTERTAINMENT,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_CREDITSALES,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_CREDITSALES,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_WRITE_DOWN_NEW_COMPANY,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_RAW_MATERIAL_AND_SEMIFINISHED_PRODUCTS,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_PRODUCT_UNDER_MANUFACTURING,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_INVENTORIES_FINISHED_ITEM,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_PURCHASED_ITEM_FOR_RESALE,
            self::CLOSING_BALANCE_POST_TYPE_TANGIBLE_FIXED_ASSETS_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_TANGIBLE_FIXED_ASSETS,
            self::CLOSING_BALANCE_POST_TYPE_DEPRECIATION_PERCENTAGE,
            self::CLOSING_BALANCE_POST_TYPE_STRAIGHT_LINE_DEPRECIATION,
            self::CLOSING_BALANCE_POST_TYPE_CASH_DEPOSITS,
            self::CLOSING_BALANCE_POST_TYPE_CONTRIBUTIONS_IN_KIND,
            self::CLOSING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_CASH,
            self::CLOSING_BALANCE_POST_TYPE_CAPITAL_REDUCTION_DISTRIBUTED_SHARED_CAPITAL_OTHER_ASSETS,
            self::CLOSING_BALANCE_POST_TYPE_DEBT_WAVING,
            self::CLOSING_BALANCE_POST_TYPE_BUYING_OWN_SHARES,
            self::CLOSING_BALANCE_POST_TYPE_SELLING_OWN_SHARES,
            self::CLOSING_BALANCE_POST_TYPE_DEBT_CONVERSION_TO_EQUITY,
            self::CLOSING_BALANCE_POST_TYPE_POSITIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::CLOSING_BALANCE_POST_TYPE_NEGATIVE_DIFF_BETWEEN_ALLOCATED_AND_DISTRIBUTED_DIVIDEND,
            self::CLOSING_BALANCE_POST_TYPE_OTHER_POSITIVE_CHANGE_IN_EQUITY,
            self::CLOSING_BALANCE_POST_TYPE_OTHER_NEGATIVE_CHANGE_IN_EQUITY,
            self::CLOSING_BALANCE_POST_TYPE_NONE_DEDUCTIBLE_COST,
            self::CLOSING_BALANCE_POST_TYPE_POSITIVE_TAX_COST,
            self::CLOSING_BALANCE_POST_TYPE_INTEREST_EXPENSE_FIXED_TAX,
            self::CLOSING_BALANCE_POST_TYPE_SHARE_OF_LOSS_FROM_INVESTMENT,
            self::CLOSING_BALANCE_POST_TYPE_REVERSAL_OF_IMPAIRMENT,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_IMPAIRMENT,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_NORWEAGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_DEFICIT_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_NORWEAGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_LOSS_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_RETURNED_DEBT_INTEREST,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_DIVIDEND_ON_SHARES,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_PART_OF_DIVIDEND_AND_DISTRIBUTION,
            self::CLOSING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_SHARE_OF_TAXABLE_PROFIT_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_REALIZATION_OF_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ADDITION_INTEREST_COST,
            self::CLOSING_BALANCE_POST_TYPE_CORRECTION_PURPOSED_DIVIDEND,
            self::CLOSING_BALANCE_POST_TYPE_TAXABLE_PROFIT_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::CLOSING_BALANCE_POST_TYPE_INCOME_SUPPLEMENT_FOR_CONVERSION_DIFFERENCE,
            self::CLOSING_BALANCE_POST_TYPE_OTHER_INCOME_SUPPLEMENT,
            self::CLOSING_BALANCE_POST_TYPE_RETURN_OF_INCOME_RELATED_DIVIDENDS,
            self::CLOSING_BALANCE_POST_TYPE_PROFIT_AND_LOSS_GROUP_CONTRIBUTION,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_PROFIT_SHARE_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_ACCOUNTING_GAIN_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIZATION_OF_FINANCIAL_INSTRUMENTS,
            self::CLOSING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_SHARE_OF_DEDUCTIBLE_DEFICIT_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_NORWEGIAN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_REALIXATION_FOREIGN_SDF,
            self::CLOSING_BALANCE_POST_TYPE_DEDUCTIBLE_LOSS_ON_WITHDRAWAL_NORWEGIAN_TAX_AREA,
            self::CLOSING_BALANCE_POST_TYPE_ISSUE_AND_ESTABLISHMENT_COST,
            self::CLOSING_BALANCE_POST_TYPE_INCOME_DEDUCTION_FROM_ACCOUNTING_CURRENCY_TO_NOK,
            self::CLOSING_BALANCE_POST_TYPE_OTHER_INCOME_DEDUCTION,
            self::CLOSING_BALANCE_POST_TYPE_TEMPORARY_DIFFERENCES_TYPE,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_ACCOUNTABLE_VALUE,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_ACCOUNTABLE_VALUE,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_TAX_VALUE,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_TAX_VALUE,
            self::CLOSING_BALANCE_POST_TYPE_OPENING_BALANCE_DIFFERENCES,
            self::CLOSING_BALANCE_POST_TYPE_CLOSING_BALANCE_DIFFERENCES,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_PROFIT_AND_LOSS,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_ACCOMMODATION_AND_RESTAURANT,
            self::CLOSING_BALANCE_POST_TYPE_IS_ACCOUNTABLE,
            self::CLOSING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_INVENTORIES,
            self::CLOSING_BALANCE_POST_TYPE_USE_ACCOUNTING_VALUES_IN_CUSTOMER_RECEIVABLES,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_TANGIBLE_FIXED_ASSET,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_CAR,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_INVENTORIES,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_CUSTOMER_RECEIVABLES,
            self::CLOSING_BALANCE_POST_TYPE_SHOW_CONCERN_RELATION,
            self::CLOSING_BALANCE_POST_TYPE_OWN_BUSINESS_PROPERTIES,
            self::CLOSING_BALANCE_POST_TYPE_OWN_ASSET_PAPIR,
            self::CLOSING_BALANCE_POST_TYPE_TRANSFERED_BY,
            self::CLOSING_BALANCE_POST_TYPE_TRANSFERED_DATE,
            self::CLOSING_BALANCE_POST_TYPE_SET_ACCOUNTANT_REVISED,
            self::CLOSING_BALANCE_POST_TYPE_IS_TAXABLE,
            self::CLOSING_BALANCE_POST_TYPE_REQUIRE_AUDITORS_SIGNATURE,
            self::CLOSING_BALANCE_POST_TYPE_VALIDATION_ONLY_ON_SUBMIT,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_ID,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_BRREG_DOC_FETCHER_NAME,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOMMODATION_AND_RESTAURANT,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_AND_LOSS_ACCOUNT,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_COMMERCIAL_VEHICLE,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TANGIBLE_FIXED_ASSETS,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_INVENTORIES,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_ACCOUNTS_RECEIVABLE_FROM_CUSTOMERS,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROFIT_LOSS,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_BALANCE,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERSONAL_INCOME,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PERMANENT_DIFFERENCES,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TEMPORARY_DIFFERENCES,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RELATED_RESULT,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_GROUP_CONTRIBUTIONS,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_EQUITY_RECONCILIATION,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_RETURN,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DIVIDEND,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_DISPOSITIONS,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_PROPERTIES,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_SECURITIES,
            self::CLOSING_BALANCE_POST_TYPE_YEAR_END_DOCUMENTATION_TAX_CALCULATION,
            self::CLOSING_BALANCE_POST_TYPE_RECEIVER_ORG_NR,
            self::CLOSING_BALANCE_POST_TYPE_RECEIVER_NAME,
            self::CLOSING_BALANCE_POST_TYPE_CONCERN_CONNECTION,
            self::CLOSING_BALANCE_POST_TYPE_VOTING_LIMIT,
            self::CLOSING_BALANCE_POST_TYPE_DATE_OF_ACQUISITION,
            self::CLOSING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::CLOSING_BALANCE_POST_TYPE_RECEIVED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::CLOSING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITH_TAX_AFFECTION,
            self::CLOSING_BALANCE_POST_TYPE_SUBMITTED_GROUP_CONTRIBUTIONS_WITHOUT_TAX_AFFECTION,
            self::CLOSING_BALANCE_POST_TYPE_APPLICATION_OF_LOSS_CARRY_FORWARDS,
            self::CLOSING_BALANCE_POST_TYPE_ACCUMULATED_LOSS_FROM_PREVIOUS_YEARS,
            self::CLOSING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_CAPITAL,
            self::CLOSING_BALANCE_POST_TYPE_CORRECTIONS_AND_OTHER_DEBT,
            self::CLOSING_BALANCE_POST_TYPE_IS_PART_OF_GROUP_COMPANY,
            self::CLOSING_BALANCE_POST_TYPE_IS_LISTED_ON_THE_STOCK_EXCHANGE,
            self::CLOSING_BALANCE_POST_TYPE_IS_REORGANIZED_ACROSS_BORDERS,
            self::CLOSING_BALANCE_POST_TYPE_HAS_RECEIVED_OR_TRANSFERED_ASSETS,
            self::CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_NAME,
            self::CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_COUNTRY_CODE,
            self::CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_NAME,
            self::CLOSING_BALANCE_POST_TYPE_HEAD_OF_GROUP_LAST_YEAR_COUNTRY_CODE,
            self::CLOSING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_NAME,
            self::CLOSING_BALANCE_POST_TYPE_FOREIGN_OWNERSHIP_COMPANY_COUNTRY_CODE,
            self::CLOSING_BALANCE_POST_TYPE_OWNS_MIN_50_PERCENT_OF_FOREIGN_COMPANY,
            self::CLOSING_BALANCE_POST_TYPE_HAS_PERMANENT_ESTABLISHMENT_ABROAD,
            self::CLOSING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_NAME,
            self::CLOSING_BALANCE_POST_TYPE_COUNTRY_FOR_COUNTRY_REPORTABLE_ENTERPRISE_COUNTRY_CODE,
            self::CLOSING_BALANCE_POST_TYPE_HAS_PERFORMANCE_BETWEEN_SHAREHOLDERS_AND_OTHER,
            self::CLOSING_BALANCE_POST_TYPE_HAS_OUTSTANDING_PAYMENT_CLAIMS_RELATED_TO_ILLEGAL_STATE_AID,
            self::CLOSING_BALANCE_POST_TYPE_IS_SMALL_OR_MEDIUM_SIZED_BUSINESS,
            self::CLOSING_BALANCE_POST_TYPE_HAD_FINANCIAL_DIFFICULTIES_LAST_YEAR,
            self::CLOSING_BALANCE_POST_TYPE_IS_GROUP_COMPANY,
            self::CLOSING_BALANCE_POST_TYPE_HAS_RECEIVED_OTHER_PUBLIC_SUPPORT,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_TONNAGE_TAX_REGIME,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_RULES_FOR_ELECTRIC_DELIVERY_TRUCKS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FOR_LONGTERM_INVESTMENTS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EMPLOYMENT_RELATED_OPTIONS_START_UP,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_TAX_FUN,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DEPRECIATION_RULES,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REGIONALLY_DIFFERENTIATED_INSURANCE_CONTRIBUTIONS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_FAVOURABLE_DETERMINED_LIST_PRICES_ELECTRIC_VEHICLES,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_CARS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_LEASING_ELECTRIC_CARS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_BATTERIES,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_VAT_EXEMPTION_TURNOVER_ELECTRIC_NEWS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_INDUSTRIAL_SECTOR,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DISTRICT_HEATING,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_TARGET_ZONE,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_DATA_CENTRES,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_COMMERCIAL_VESSELS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ELECTRICITY_TAX_ENERGY_PRODUCTS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_WOOD_INDUSTRY,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_BASIC_TAX_MINERAL_OIL_PIGMENT_INDUSTRY,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_MINERAL_OIL,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_CO2_TAX_GAS,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_NOX_DUTY,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_EXEMPTION_TRANSFER_FEE,
            self::CLOSING_BALANCE_POST_TYPE_AID_SCHEME_REDUCED_ROAD_TRAFFIC_INSURANCE_TAX,
            self::CLOSING_BALANCE_POST_TYPE_OTHER_CORRECTIONS,
            self::CLOSING_BALANCE_POST_TYPE_YEARLY_DIVIDEND,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('grouping', $data ?? [], null);
        $this->setIfExists('opening_balance', $data ?? [], null);
        $this->setIfExists('closing_balance', $data ?? [], null);
        $this->setIfExists('opening_balance_tax_value', $data ?? [], null);
        $this->setIfExists('closing_balance_tax_value', $data ?? [], null);
        $this->setIfExists('opening_balance_post_type', $data ?? [], null);
        $this->setIfExists('closing_balance_post_type', $data ?? [], null);
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

        $allowedValues = $this->getOpeningBalancePostTypeAllowableValues();
        if (!is_null($this->container['opening_balance_post_type']) && !in_array($this->container['opening_balance_post_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'opening_balance_post_type', must be one of '%s'",
                $this->container['opening_balance_post_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getClosingBalancePostTypeAllowableValues();
        if (!is_null($this->container['closing_balance_post_type']) && !in_array($this->container['closing_balance_post_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'closing_balance_post_type', must be one of '%s'",
                $this->container['closing_balance_post_type'],
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
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets grouping
     *
     * @return string|null
     */
    public function getGrouping()
    {
        return $this->container['grouping'];
    }

    /**
     * Sets grouping
     *
     * @param string|null $grouping grouping
     *
     * @return self
     */
    public function setGrouping($grouping)
    {
        if (is_null($grouping)) {
            throw new \InvalidArgumentException('non-nullable grouping cannot be null');
        }
        $this->container['grouping'] = $grouping;

        return $this;
    }

    /**
     * Gets opening_balance
     *
     * @return float|null
     */
    public function getOpeningBalance()
    {
        return $this->container['opening_balance'];
    }

    /**
     * Sets opening_balance
     *
     * @param float|null $opening_balance opening_balance
     *
     * @return self
     */
    public function setOpeningBalance($opening_balance)
    {
        if (is_null($opening_balance)) {
            throw new \InvalidArgumentException('non-nullable opening_balance cannot be null');
        }
        $this->container['opening_balance'] = $opening_balance;

        return $this;
    }

    /**
     * Gets closing_balance
     *
     * @return float|null
     */
    public function getClosingBalance()
    {
        return $this->container['closing_balance'];
    }

    /**
     * Sets closing_balance
     *
     * @param float|null $closing_balance closing_balance
     *
     * @return self
     */
    public function setClosingBalance($closing_balance)
    {
        if (is_null($closing_balance)) {
            throw new \InvalidArgumentException('non-nullable closing_balance cannot be null');
        }
        $this->container['closing_balance'] = $closing_balance;

        return $this;
    }

    /**
     * Gets opening_balance_tax_value
     *
     * @return float|null
     */
    public function getOpeningBalanceTaxValue()
    {
        return $this->container['opening_balance_tax_value'];
    }

    /**
     * Sets opening_balance_tax_value
     *
     * @param float|null $opening_balance_tax_value opening_balance_tax_value
     *
     * @return self
     */
    public function setOpeningBalanceTaxValue($opening_balance_tax_value)
    {
        if (is_null($opening_balance_tax_value)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_tax_value cannot be null');
        }
        $this->container['opening_balance_tax_value'] = $opening_balance_tax_value;

        return $this;
    }

    /**
     * Gets closing_balance_tax_value
     *
     * @return float|null
     */
    public function getClosingBalanceTaxValue()
    {
        return $this->container['closing_balance_tax_value'];
    }

    /**
     * Sets closing_balance_tax_value
     *
     * @param float|null $closing_balance_tax_value closing_balance_tax_value
     *
     * @return self
     */
    public function setClosingBalanceTaxValue($closing_balance_tax_value)
    {
        if (is_null($closing_balance_tax_value)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_tax_value cannot be null');
        }
        $this->container['closing_balance_tax_value'] = $closing_balance_tax_value;

        return $this;
    }

    /**
     * Gets opening_balance_post_type
     *
     * @return string|null
     */
    public function getOpeningBalancePostType()
    {
        return $this->container['opening_balance_post_type'];
    }

    /**
     * Sets opening_balance_post_type
     *
     * @param string|null $opening_balance_post_type opening_balance_post_type
     *
     * @return self
     */
    public function setOpeningBalancePostType($opening_balance_post_type)
    {
        if (is_null($opening_balance_post_type)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_post_type cannot be null');
        }
        $allowedValues = $this->getOpeningBalancePostTypeAllowableValues();
        if (!in_array($opening_balance_post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'opening_balance_post_type', must be one of '%s'",
                    $opening_balance_post_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['opening_balance_post_type'] = $opening_balance_post_type;

        return $this;
    }

    /**
     * Gets closing_balance_post_type
     *
     * @return string|null
     */
    public function getClosingBalancePostType()
    {
        return $this->container['closing_balance_post_type'];
    }

    /**
     * Sets closing_balance_post_type
     *
     * @param string|null $closing_balance_post_type closing_balance_post_type
     *
     * @return self
     */
    public function setClosingBalancePostType($closing_balance_post_type)
    {
        if (is_null($closing_balance_post_type)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_post_type cannot be null');
        }
        $allowedValues = $this->getClosingBalancePostTypeAllowableValues();
        if (!in_array($closing_balance_post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'closing_balance_post_type', must be one of '%s'",
                    $closing_balance_post_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['closing_balance_post_type'] = $closing_balance_post_type;

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


