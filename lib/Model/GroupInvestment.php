<?php
/**
 * GroupInvestment
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
 * GroupInvestment Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GroupInvestment implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'GroupInvestment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'note' => '\Learnist\Tripletex\Model\YearEndReportNote',
        'note_post_type' => 'string',
        'note_group_type' => 'string',
        'note_sub_type_group_id' => 'float',
        'investment' => 'float',
        'opening_balance' => 'float',
        'revenue_recognized_as_income' => 'float',
        'other_changes' => 'float',
        'closing_balance' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'note' => null,
        'note_post_type' => null,
        'note_group_type' => null,
        'note_sub_type_group_id' => null,
        'investment' => null,
        'opening_balance' => null,
        'revenue_recognized_as_income' => null,
        'other_changes' => null,
        'closing_balance' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'note' => false,
		'note_post_type' => false,
		'note_group_type' => false,
		'note_sub_type_group_id' => false,
		'investment' => false,
		'opening_balance' => false,
		'revenue_recognized_as_income' => false,
		'other_changes' => false,
		'closing_balance' => false
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
        'note' => 'note',
        'note_post_type' => 'notePostType',
        'note_group_type' => 'noteGroupType',
        'note_sub_type_group_id' => 'noteSubTypeGroupId',
        'investment' => 'investment',
        'opening_balance' => 'openingBalance',
        'revenue_recognized_as_income' => 'revenueRecognizedAsIncome',
        'other_changes' => 'otherChanges',
        'closing_balance' => 'closingBalance'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'note' => 'setNote',
        'note_post_type' => 'setNotePostType',
        'note_group_type' => 'setNoteGroupType',
        'note_sub_type_group_id' => 'setNoteSubTypeGroupId',
        'investment' => 'setInvestment',
        'opening_balance' => 'setOpeningBalance',
        'revenue_recognized_as_income' => 'setRevenueRecognizedAsIncome',
        'other_changes' => 'setOtherChanges',
        'closing_balance' => 'setClosingBalance'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'note' => 'getNote',
        'note_post_type' => 'getNotePostType',
        'note_group_type' => 'getNoteGroupType',
        'note_sub_type_group_id' => 'getNoteSubTypeGroupId',
        'investment' => 'getInvestment',
        'opening_balance' => 'getOpeningBalance',
        'revenue_recognized_as_income' => 'getRevenueRecognizedAsIncome',
        'other_changes' => 'getOtherChanges',
        'closing_balance' => 'getClosingBalance'
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

    public const NOTE_POST_TYPE_ID_FOR_NOTE = 'ID_FOR_NOTE';
    public const NOTE_POST_TYPE_IS_CHECKED = 'IS_CHECKED';
    public const NOTE_POST_TYPE_UPDATED_BY = 'UPDATED_BY';
    public const NOTE_POST_TYPE_UPDATED_DATE = 'UPDATED_DATE';
    public const NOTE_POST_TYPE_ACCOUNTS = 'ACCOUNTS';
    public const NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT = 'ACCOUNTING_PRINCIPLES_FREE_TEXT';
    public const NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT = 'ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT';
    public const NOTE_POST_TYPE_STILL_IN_BUSINESS = 'STILL_IN_BUSINESS';
    public const NOTE_POST_TYPE_STILL_IN_BUSINESS_INFO = 'STILL_IN_BUSINESS_INFO';
    public const NOTE_POST_TYPE_NUMBER_OF_MAN_YEARS = 'NUMBER_OF_MAN_YEARS';
    public const NOTE_POST_TYPE_OPENING_BALANCE_SALARY = 'OPENING_BALANCE_SALARY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_SALARY = 'CLOSING_BALANCE_SALARY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
    public const NOTE_POST_TYPE_OPENING_BALANCE_PENSION_COST = 'OPENING_BALANCE_PENSION_COST';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_PENSION_COST = 'CLOSING_BALANCE_PENSION_COST';
    public const NOTE_POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS = 'OPENING_BALANCE_OTHER_BENEFITS';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS = 'CLOSING_BALANCE_OTHER_BENEFITS';
    public const NOTE_POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY = 'ABOUT_MAN_YEARS_AND_SALARY';
    public const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST = 'EXTRAORDINARY_INCOME_AND_COST';
    public const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION = 'EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION';
    public const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT = 'EXTRAORDINARY_INCOME_AND_COST_AMOUNT';
    public const NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST = 'FIXED_ASSETS_CLOSING_ACQUISITION_COST';
    public const NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE = 'FIXED_ASSETS_CLOSING_CAPITALISED_VALUE';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE = 'FIXED_ASSETS_ECONOMIC_LIFE';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS';
    public const NOTE_POST_TYPE_FIXED_ASSETS_ACQUISITION_COST = 'FIXED_ASSETS_ACQUISITION_COST';
    public const NOTE_POST_TYPE_FIXED_ASSETS_GOODWILL = 'FIXED_ASSETS_GOODWILL';
    public const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE';
    public const NOTE_POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION = 'FIXED_ASSETS_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_GROUP = 'GROUP';
    public const NOTE_POST_TYPE_GROUP_INVESTMENTS = 'GROUP_INVESTMENTS';
    public const NOTE_POST_TYPE_GROUP_OPENING_BALANCE = 'GROUP_OPENING_BALANCE';
    public const NOTE_POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME = 'GROUP_REVENUE_RECOGNIZED_AS_INCOME';
    public const NOTE_POST_TYPE_GROUP_OTHER_CHANGES = 'GROUP_OTHER_CHANGES';
    public const NOTE_POST_TYPE_GROUP_CLOSING_BALANCE = 'GROUP_CLOSING_BALANCE';
    public const NOTE_POST_TYPE_GROUP_ADDED_VALUE = 'GROUP_ADDED_VALUE';
    public const NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES = 'GROUP_DEPRECIATION_OF_ADDED_VALUES';
    public const NOTE_POST_TYPE_GROUP_GOODWILL = 'GROUP_GOODWILL';
    public const NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL = 'GROUP_DEPRECIATION_OF_GOODWILL';
    public const NOTE_POST_TYPE_GROUP_TOTAL_ACQUISITION_COST = 'GROUP_TOTAL_ACQUISITION_COST';
    public const NOTE_POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY = 'GROUP_TOTAL_CAPITALIZED_EQUITY';
    public const NOTE_POST_TYPE_GROUP_IS_SUBSIDIARY = 'GROUP_IS_SUBSIDIARY';
    public const NOTE_POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY = 'GROUP_NAME_OF_PARENT_COMPANY';
    public const NOTE_POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY = 'GROUP_BUSINESS_OFFICE_PARENT_COMPANY';
    public const NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION';
    public const NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION';
    public const NOTE_POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES = 'GROUP_TRANSACTIONS_WITH_SUBSIDIARIES';
    public const NOTE_POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS = 'GROUP_INTERNAL_GAIN_TRANSACTIONS';
    public const NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES = 'GROUP_RECEIVABLES_AND_LIABILITIES';
    public const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
    public const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const NOTE_POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS = 'OPENING_BALANCE_MORTGAGED_ASSETS';
    public const NOTE_POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL = 'OPENING_BALANCE_OTHER_COLLATERAL';
    public const NOTE_POST_TYPE_OPENING_BALANCE_GUANRANTEES = 'OPENING_BALANCE_GUANRANTEES';
    public const NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO = 'GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO';
    public const NOTE_POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR = 'RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR';
    public const NOTE_POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION = 'RECEIVABLES_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES = 'HOLDING_OWN_SHARES';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES = 'HOLDING_OWN_SHARES_NUMBER_OF_SHARES';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES = 'HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL = 'HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL';
    public const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
    public const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION = 'OWN_SHARES_ACQUISITIONS_REMUNERATION';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION = 'PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION';
    public const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
    public const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
    public const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
    public const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION = 'OWN_SHARES_DISPOSAL_REMUNERATION';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION = 'PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION';
    public const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
    public const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT = 'HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR = 'HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS = 'HOLDING_OWN_SHARES_PROVISIONS';
    public const NOTE_POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION = 'HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_DEBT_DUE_FOR_PAYMENT = 'DEBT_DUE_FOR_PAYMENT';
    public const NOTE_POST_TYPE_DEBT_SECURED_BY_MORTGAGE = 'DEBT_SECURED_BY_MORTGAGE';
    public const NOTE_POST_TYPE_DEBT_CAPITALISED_VALUE = 'DEBT_CAPITALISED_VALUE';
    public const NOTE_POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS = 'DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS';
    public const NOTE_POST_TYPE_DEBT_WARRANTY_OBLIGATIONS = 'DEBT_WARRANTY_OBLIGATIONS';
    public const NOTE_POST_TYPE_DEBT_ADDITIONAL_INFORMATION = 'DEBT_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED = 'LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES';
    public const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION = 'LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION';
    public const NOTE_POST_TYPE_FREE_NOTE_FREE_TEXT = 'FREE_NOTE_FREE_TEXT';
    public const NOTE_GROUP_TYPE_EXTRAORDINARY_INCOME_GROUP = 'EXTRAORDINARY_INCOME_GROUP';
    public const NOTE_GROUP_TYPE_EXTRAORDINARY_COST_GROUP = 'EXTRAORDINARY_COST_GROUP';
    public const NOTE_GROUP_TYPE_GROUP_GROUP = 'GROUP_GROUP';
    public const NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNotePostTypeAllowableValues()
    {
        return [
            self::NOTE_POST_TYPE_ID_FOR_NOTE,
            self::NOTE_POST_TYPE_IS_CHECKED,
            self::NOTE_POST_TYPE_UPDATED_BY,
            self::NOTE_POST_TYPE_UPDATED_DATE,
            self::NOTE_POST_TYPE_ACCOUNTS,
            self::NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT,
            self::NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT,
            self::NOTE_POST_TYPE_STILL_IN_BUSINESS,
            self::NOTE_POST_TYPE_STILL_IN_BUSINESS_INFO,
            self::NOTE_POST_TYPE_NUMBER_OF_MAN_YEARS,
            self::NOTE_POST_TYPE_OPENING_BALANCE_SALARY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_SALARY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS,
            self::NOTE_POST_TYPE_OPENING_BALANCE_PENSION_COST,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_PENSION_COST,
            self::NOTE_POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS,
            self::NOTE_POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY,
            self::NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST,
            self::NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION,
            self::NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT,
            self::NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST,
            self::NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS,
            self::NOTE_POST_TYPE_FIXED_ASSETS_ACQUISITION_COST,
            self::NOTE_POST_TYPE_FIXED_ASSETS_GOODWILL,
            self::NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE,
            self::NOTE_POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_GROUP,
            self::NOTE_POST_TYPE_GROUP_INVESTMENTS,
            self::NOTE_POST_TYPE_GROUP_OPENING_BALANCE,
            self::NOTE_POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME,
            self::NOTE_POST_TYPE_GROUP_OTHER_CHANGES,
            self::NOTE_POST_TYPE_GROUP_CLOSING_BALANCE,
            self::NOTE_POST_TYPE_GROUP_ADDED_VALUE,
            self::NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES,
            self::NOTE_POST_TYPE_GROUP_GOODWILL,
            self::NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL,
            self::NOTE_POST_TYPE_GROUP_TOTAL_ACQUISITION_COST,
            self::NOTE_POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY,
            self::NOTE_POST_TYPE_GROUP_IS_SUBSIDIARY,
            self::NOTE_POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY,
            self::NOTE_POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY,
            self::NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION,
            self::NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION,
            self::NOTE_POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES,
            self::NOTE_POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS,
            self::NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES,
            self::NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE,
            self::NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::NOTE_POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS,
            self::NOTE_POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL,
            self::NOTE_POST_TYPE_OPENING_BALANCE_GUANRANTEES,
            self::NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO,
            self::NOTE_POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR,
            self::NOTE_POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL,
            self::NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED,
            self::NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION,
            self::NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL,
            self::NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS,
            self::NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED,
            self::NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION,
            self::NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL,
            self::NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS,
            self::NOTE_POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_DEBT_DUE_FOR_PAYMENT,
            self::NOTE_POST_TYPE_DEBT_SECURED_BY_MORTGAGE,
            self::NOTE_POST_TYPE_DEBT_CAPITALISED_VALUE,
            self::NOTE_POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS,
            self::NOTE_POST_TYPE_DEBT_WARRANTY_OBLIGATIONS,
            self::NOTE_POST_TYPE_DEBT_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES,
            self::NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION,
            self::NOTE_POST_TYPE_FREE_NOTE_FREE_TEXT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNoteGroupTypeAllowableValues()
    {
        return [
            self::NOTE_GROUP_TYPE_EXTRAORDINARY_INCOME_GROUP,
            self::NOTE_GROUP_TYPE_EXTRAORDINARY_COST_GROUP,
            self::NOTE_GROUP_TYPE_GROUP_GROUP,
            self::NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP,
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
        $this->setIfExists('note', $data ?? [], null);
        $this->setIfExists('note_post_type', $data ?? [], null);
        $this->setIfExists('note_group_type', $data ?? [], null);
        $this->setIfExists('note_sub_type_group_id', $data ?? [], null);
        $this->setIfExists('investment', $data ?? [], null);
        $this->setIfExists('opening_balance', $data ?? [], null);
        $this->setIfExists('revenue_recognized_as_income', $data ?? [], null);
        $this->setIfExists('other_changes', $data ?? [], null);
        $this->setIfExists('closing_balance', $data ?? [], null);
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

        $allowedValues = $this->getNotePostTypeAllowableValues();
        if (!is_null($this->container['note_post_type']) && !in_array($this->container['note_post_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'note_post_type', must be one of '%s'",
                $this->container['note_post_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!is_null($this->container['note_group_type']) && !in_array($this->container['note_group_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'note_group_type', must be one of '%s'",
                $this->container['note_group_type'],
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
     * Gets note
     *
     * @return \Learnist\Tripletex\Model\YearEndReportNote|null
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param \Learnist\Tripletex\Model\YearEndReportNote|null $note note
     *
     * @return self
     */
    public function setNote($note)
    {
        if (is_null($note)) {
            throw new \InvalidArgumentException('non-nullable note cannot be null');
        }
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets note_post_type
     *
     * @return string|null
     */
    public function getNotePostType()
    {
        return $this->container['note_post_type'];
    }

    /**
     * Sets note_post_type
     *
     * @param string|null $note_post_type note_post_type
     *
     * @return self
     */
    public function setNotePostType($note_post_type)
    {
        if (is_null($note_post_type)) {
            throw new \InvalidArgumentException('non-nullable note_post_type cannot be null');
        }
        $allowedValues = $this->getNotePostTypeAllowableValues();
        if (!in_array($note_post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'note_post_type', must be one of '%s'",
                    $note_post_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['note_post_type'] = $note_post_type;

        return $this;
    }

    /**
     * Gets note_group_type
     *
     * @return string|null
     */
    public function getNoteGroupType()
    {
        return $this->container['note_group_type'];
    }

    /**
     * Sets note_group_type
     *
     * @param string|null $note_group_type note_group_type
     *
     * @return self
     */
    public function setNoteGroupType($note_group_type)
    {
        if (is_null($note_group_type)) {
            throw new \InvalidArgumentException('non-nullable note_group_type cannot be null');
        }
        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!in_array($note_group_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'note_group_type', must be one of '%s'",
                    $note_group_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['note_group_type'] = $note_group_type;

        return $this;
    }

    /**
     * Gets note_sub_type_group_id
     *
     * @return float|null
     */
    public function getNoteSubTypeGroupId()
    {
        return $this->container['note_sub_type_group_id'];
    }

    /**
     * Sets note_sub_type_group_id
     *
     * @param float|null $note_sub_type_group_id note_sub_type_group_id
     *
     * @return self
     */
    public function setNoteSubTypeGroupId($note_sub_type_group_id)
    {
        if (is_null($note_sub_type_group_id)) {
            throw new \InvalidArgumentException('non-nullable note_sub_type_group_id cannot be null');
        }
        $this->container['note_sub_type_group_id'] = $note_sub_type_group_id;

        return $this;
    }

    /**
     * Gets investment
     *
     * @return float|null
     */
    public function getInvestment()
    {
        return $this->container['investment'];
    }

    /**
     * Sets investment
     *
     * @param float|null $investment investment
     *
     * @return self
     */
    public function setInvestment($investment)
    {
        if (is_null($investment)) {
            throw new \InvalidArgumentException('non-nullable investment cannot be null');
        }
        $this->container['investment'] = $investment;

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
     * Gets revenue_recognized_as_income
     *
     * @return float|null
     */
    public function getRevenueRecognizedAsIncome()
    {
        return $this->container['revenue_recognized_as_income'];
    }

    /**
     * Sets revenue_recognized_as_income
     *
     * @param float|null $revenue_recognized_as_income revenue_recognized_as_income
     *
     * @return self
     */
    public function setRevenueRecognizedAsIncome($revenue_recognized_as_income)
    {
        if (is_null($revenue_recognized_as_income)) {
            throw new \InvalidArgumentException('non-nullable revenue_recognized_as_income cannot be null');
        }
        $this->container['revenue_recognized_as_income'] = $revenue_recognized_as_income;

        return $this;
    }

    /**
     * Gets other_changes
     *
     * @return float|null
     */
    public function getOtherChanges()
    {
        return $this->container['other_changes'];
    }

    /**
     * Sets other_changes
     *
     * @param float|null $other_changes other_changes
     *
     * @return self
     */
    public function setOtherChanges($other_changes)
    {
        if (is_null($other_changes)) {
            throw new \InvalidArgumentException('non-nullable other_changes cannot be null');
        }
        $this->container['other_changes'] = $other_changes;

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


