<?php
/**
 * YearEndReportNoteData
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
 * YearEndReportNoteData Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class YearEndReportNoteData implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'YearEndReportNoteData';

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
        'note' => '\Learnist\Tripletex\Model\YearEndReportNote',
        'note_group_type' => 'string',
        'note_sub_type_group_id' => 'int',
        'post_type' => 'string',
        'post_value' => 'string',
        'post_medium_text_value' => 'string'
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
        'note' => null,
        'note_group_type' => null,
        'note_sub_type_group_id' => 'int32',
        'post_type' => null,
        'post_value' => null,
        'post_medium_text_value' => null
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
		'note' => false,
		'note_group_type' => false,
		'note_sub_type_group_id' => false,
		'post_type' => false,
		'post_value' => false,
		'post_medium_text_value' => false
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
        'note' => 'note',
        'note_group_type' => 'noteGroupType',
        'note_sub_type_group_id' => 'noteSubTypeGroupId',
        'post_type' => 'postType',
        'post_value' => 'postValue',
        'post_medium_text_value' => 'postMediumTextValue'
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
        'note' => 'setNote',
        'note_group_type' => 'setNoteGroupType',
        'note_sub_type_group_id' => 'setNoteSubTypeGroupId',
        'post_type' => 'setPostType',
        'post_value' => 'setPostValue',
        'post_medium_text_value' => 'setPostMediumTextValue'
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
        'note' => 'getNote',
        'note_group_type' => 'getNoteGroupType',
        'note_sub_type_group_id' => 'getNoteSubTypeGroupId',
        'post_type' => 'getPostType',
        'post_value' => 'getPostValue',
        'post_medium_text_value' => 'getPostMediumTextValue'
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

    public const NOTE_GROUP_TYPE_EXTRAORDINARY_INCOME_GROUP = 'EXTRAORDINARY_INCOME_GROUP';
    public const NOTE_GROUP_TYPE_EXTRAORDINARY_COST_GROUP = 'EXTRAORDINARY_COST_GROUP';
    public const NOTE_GROUP_TYPE_GROUP_GROUP = 'GROUP_GROUP';
    public const NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP';
    public const POST_TYPE_ID_FOR_NOTE = 'ID_FOR_NOTE';
    public const POST_TYPE_IS_CHECKED = 'IS_CHECKED';
    public const POST_TYPE_UPDATED_BY = 'UPDATED_BY';
    public const POST_TYPE_UPDATED_DATE = 'UPDATED_DATE';
    public const POST_TYPE_ACCOUNTS = 'ACCOUNTS';
    public const POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT = 'ACCOUNTING_PRINCIPLES_FREE_TEXT';
    public const POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT = 'ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT';
    public const POST_TYPE_STILL_IN_BUSINESS = 'STILL_IN_BUSINESS';
    public const POST_TYPE_STILL_IN_BUSINESS_INFO = 'STILL_IN_BUSINESS_INFO';
    public const POST_TYPE_NUMBER_OF_MAN_YEARS = 'NUMBER_OF_MAN_YEARS';
    public const POST_TYPE_OPENING_BALANCE_SALARY = 'OPENING_BALANCE_SALARY';
    public const POST_TYPE_CLOSING_BALANCE_SALARY = 'CLOSING_BALANCE_SALARY';
    public const POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
    public const POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
    public const POST_TYPE_OPENING_BALANCE_PENSION_COST = 'OPENING_BALANCE_PENSION_COST';
    public const POST_TYPE_CLOSING_BALANCE_PENSION_COST = 'CLOSING_BALANCE_PENSION_COST';
    public const POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS = 'OPENING_BALANCE_OTHER_BENEFITS';
    public const POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS = 'CLOSING_BALANCE_OTHER_BENEFITS';
    public const POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY = 'ABOUT_MAN_YEARS_AND_SALARY';
    public const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST = 'EXTRAORDINARY_INCOME_AND_COST';
    public const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION = 'EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION';
    public const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT = 'EXTRAORDINARY_INCOME_AND_COST_AMOUNT';
    public const POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST = 'FIXED_ASSETS_CLOSING_ACQUISITION_COST';
    public const POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE = 'FIXED_ASSETS_CLOSING_CAPITALISED_VALUE';
    public const POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE = 'FIXED_ASSETS_ECONOMIC_LIFE';
    public const POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS';
    public const POST_TYPE_FIXED_ASSETS_ACQUISITION_COST = 'FIXED_ASSETS_ACQUISITION_COST';
    public const POST_TYPE_FIXED_ASSETS_GOODWILL = 'FIXED_ASSETS_GOODWILL';
    public const POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE';
    public const POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION = 'FIXED_ASSETS_ADDITIONAL_INFORMATION';
    public const POST_TYPE_GROUP = 'GROUP';
    public const POST_TYPE_GROUP_INVESTMENTS = 'GROUP_INVESTMENTS';
    public const POST_TYPE_GROUP_OPENING_BALANCE = 'GROUP_OPENING_BALANCE';
    public const POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME = 'GROUP_REVENUE_RECOGNIZED_AS_INCOME';
    public const POST_TYPE_GROUP_OTHER_CHANGES = 'GROUP_OTHER_CHANGES';
    public const POST_TYPE_GROUP_CLOSING_BALANCE = 'GROUP_CLOSING_BALANCE';
    public const POST_TYPE_GROUP_ADDED_VALUE = 'GROUP_ADDED_VALUE';
    public const POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES = 'GROUP_DEPRECIATION_OF_ADDED_VALUES';
    public const POST_TYPE_GROUP_GOODWILL = 'GROUP_GOODWILL';
    public const POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL = 'GROUP_DEPRECIATION_OF_GOODWILL';
    public const POST_TYPE_GROUP_TOTAL_ACQUISITION_COST = 'GROUP_TOTAL_ACQUISITION_COST';
    public const POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY = 'GROUP_TOTAL_CAPITALIZED_EQUITY';
    public const POST_TYPE_GROUP_IS_SUBSIDIARY = 'GROUP_IS_SUBSIDIARY';
    public const POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY = 'GROUP_NAME_OF_PARENT_COMPANY';
    public const POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY = 'GROUP_BUSINESS_OFFICE_PARENT_COMPANY';
    public const POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION';
    public const POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION';
    public const POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES = 'GROUP_TRANSACTIONS_WITH_SUBSIDIARIES';
    public const POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS = 'GROUP_INTERNAL_GAIN_TRANSACTIONS';
    public const POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES = 'GROUP_RECEIVABLES_AND_LIABILITIES';
    public const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
    public const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
    public const POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS = 'OPENING_BALANCE_MORTGAGED_ASSETS';
    public const POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL = 'OPENING_BALANCE_OTHER_COLLATERAL';
    public const POST_TYPE_OPENING_BALANCE_GUANRANTEES = 'OPENING_BALANCE_GUANRANTEES';
    public const POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO = 'GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO';
    public const POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR = 'RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR';
    public const POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION = 'RECEIVABLES_ADDITIONAL_INFORMATION';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION';
    public const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION';
    public const POST_TYPE_HOLDING_OWN_SHARES = 'HOLDING_OWN_SHARES';
    public const POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES = 'HOLDING_OWN_SHARES_NUMBER_OF_SHARES';
    public const POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES = 'HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES';
    public const POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL = 'HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL';
    public const POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
    public const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
    public const POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION = 'OWN_SHARES_ACQUISITIONS_REMUNERATION';
    public const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION = 'PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION';
    public const POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
    public const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
    public const POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
    public const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
    public const POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
    public const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
    public const POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION = 'OWN_SHARES_DISPOSAL_REMUNERATION';
    public const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION = 'PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION';
    public const POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
    public const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
    public const POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT = 'HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT';
    public const POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR = 'HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR';
    public const POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS = 'HOLDING_OWN_SHARES_PROVISIONS';
    public const POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION = 'HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION';
    public const POST_TYPE_DEBT_DUE_FOR_PAYMENT = 'DEBT_DUE_FOR_PAYMENT';
    public const POST_TYPE_DEBT_SECURED_BY_MORTGAGE = 'DEBT_SECURED_BY_MORTGAGE';
    public const POST_TYPE_DEBT_CAPITALISED_VALUE = 'DEBT_CAPITALISED_VALUE';
    public const POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS = 'DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS';
    public const POST_TYPE_DEBT_WARRANTY_OBLIGATIONS = 'DEBT_WARRANTY_OBLIGATIONS';
    public const POST_TYPE_DEBT_ADDITIONAL_INFORMATION = 'DEBT_ADDITIONAL_INFORMATION';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED = 'LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES';
    public const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION = 'LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION';
    public const POST_TYPE_FREE_NOTE_FREE_TEXT = 'FREE_NOTE_FREE_TEXT';

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
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPostTypeAllowableValues()
    {
        return [
            self::POST_TYPE_ID_FOR_NOTE,
            self::POST_TYPE_IS_CHECKED,
            self::POST_TYPE_UPDATED_BY,
            self::POST_TYPE_UPDATED_DATE,
            self::POST_TYPE_ACCOUNTS,
            self::POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT,
            self::POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT,
            self::POST_TYPE_STILL_IN_BUSINESS,
            self::POST_TYPE_STILL_IN_BUSINESS_INFO,
            self::POST_TYPE_NUMBER_OF_MAN_YEARS,
            self::POST_TYPE_OPENING_BALANCE_SALARY,
            self::POST_TYPE_CLOSING_BALANCE_SALARY,
            self::POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS,
            self::POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS,
            self::POST_TYPE_OPENING_BALANCE_PENSION_COST,
            self::POST_TYPE_CLOSING_BALANCE_PENSION_COST,
            self::POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS,
            self::POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS,
            self::POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY,
            self::POST_TYPE_EXTRAORDINARY_INCOME_AND_COST,
            self::POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION,
            self::POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT,
            self::POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST,
            self::POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE,
            self::POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE,
            self::POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS,
            self::POST_TYPE_FIXED_ASSETS_ACQUISITION_COST,
            self::POST_TYPE_FIXED_ASSETS_GOODWILL,
            self::POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE,
            self::POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION,
            self::POST_TYPE_GROUP,
            self::POST_TYPE_GROUP_INVESTMENTS,
            self::POST_TYPE_GROUP_OPENING_BALANCE,
            self::POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME,
            self::POST_TYPE_GROUP_OTHER_CHANGES,
            self::POST_TYPE_GROUP_CLOSING_BALANCE,
            self::POST_TYPE_GROUP_ADDED_VALUE,
            self::POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES,
            self::POST_TYPE_GROUP_GOODWILL,
            self::POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL,
            self::POST_TYPE_GROUP_TOTAL_ACQUISITION_COST,
            self::POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY,
            self::POST_TYPE_GROUP_IS_SUBSIDIARY,
            self::POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY,
            self::POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY,
            self::POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION,
            self::POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION,
            self::POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES,
            self::POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS,
            self::POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES,
            self::POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE,
            self::POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY,
            self::POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS,
            self::POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL,
            self::POST_TYPE_OPENING_BALANCE_GUANRANTEES,
            self::POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO,
            self::POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR,
            self::POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION,
            self::POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION,
            self::POST_TYPE_HOLDING_OWN_SHARES,
            self::POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES,
            self::POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES,
            self::POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL,
            self::POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED,
            self::POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED,
            self::POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION,
            self::POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION,
            self::POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL,
            self::POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL,
            self::POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS,
            self::POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS,
            self::POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED,
            self::POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED,
            self::POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION,
            self::POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION,
            self::POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL,
            self::POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL,
            self::POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT,
            self::POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR,
            self::POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS,
            self::POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION,
            self::POST_TYPE_DEBT_DUE_FOR_PAYMENT,
            self::POST_TYPE_DEBT_SECURED_BY_MORTGAGE,
            self::POST_TYPE_DEBT_CAPITALISED_VALUE,
            self::POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS,
            self::POST_TYPE_DEBT_WARRANTY_OBLIGATIONS,
            self::POST_TYPE_DEBT_ADDITIONAL_INFORMATION,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES,
            self::POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION,
            self::POST_TYPE_FREE_NOTE_FREE_TEXT,
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
        $this->setIfExists('note', $data ?? [], null);
        $this->setIfExists('note_group_type', $data ?? [], null);
        $this->setIfExists('note_sub_type_group_id', $data ?? [], null);
        $this->setIfExists('post_type', $data ?? [], null);
        $this->setIfExists('post_value', $data ?? [], null);
        $this->setIfExists('post_medium_text_value', $data ?? [], null);
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

        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!is_null($this->container['note_group_type']) && !in_array($this->container['note_group_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'note_group_type', must be one of '%s'",
                $this->container['note_group_type'],
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
        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!is_null($note_group_type) && !in_array($note_group_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'note_group_type', must be one of '%s'",
                    $note_group_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($note_group_type)) {
            throw new \InvalidArgumentException('non-nullable note_group_type cannot be null');
        }

        $this->container['note_group_type'] = $note_group_type;

        return $this;
    }

    /**
     * Gets note_sub_type_group_id
     *
     * @return int|null
     */
    public function getNoteSubTypeGroupId()
    {
        return $this->container['note_sub_type_group_id'];
    }

    /**
     * Sets note_sub_type_group_id
     *
     * @param int|null $note_sub_type_group_id note_sub_type_group_id
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

        if (is_null($post_type)) {
            throw new \InvalidArgumentException('non-nullable post_type cannot be null');
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
        if ((mb_strlen($post_value) > 255)) {
            throw new \InvalidArgumentException('invalid length for $post_value when calling YearEndReportNoteData., must be smaller than or equal to 255.');
        }


        if (is_null($post_value)) {
            throw new \InvalidArgumentException('non-nullable post_value cannot be null');
        }

        $this->container['post_value'] = $post_value;

        return $this;
    }

    /**
     * Gets post_medium_text_value
     *
     * @return string|null
     */
    public function getPostMediumTextValue()
    {
        return $this->container['post_medium_text_value'];
    }

    /**
     * Sets post_medium_text_value
     *
     * @param string|null $post_medium_text_value post_medium_text_value
     *
     * @return self
     */
    public function setPostMediumTextValue($post_medium_text_value)
    {

        if (is_null($post_medium_text_value)) {
            throw new \InvalidArgumentException('non-nullable post_medium_text_value cannot be null');
        }

        $this->container['post_medium_text_value'] = $post_medium_text_value;

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


