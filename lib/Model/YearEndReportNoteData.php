<?php
/**
 * YearEndReportNoteData
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
 * YearEndReportNoteData Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class YearEndReportNoteData implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'YearEndReportNoteData';

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
'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
'note' => '\Learnist\Tripletex\Model\YearEndReportNote',
'note_group_type' => 'string',
'note_sub_type_group_id' => 'int',
'post_type' => 'string',
'post_value' => 'string',
'post_medium_text_value' => 'string'    ];

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
'year_end_report' => null,
'note' => null,
'note_group_type' => null,
'note_sub_type_group_id' => 'int32',
'post_type' => null,
'post_value' => null,
'post_medium_text_value' => null    ];

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
'year_end_report' => 'yearEndReport',
'note' => 'note',
'note_group_type' => 'noteGroupType',
'note_sub_type_group_id' => 'noteSubTypeGroupId',
'post_type' => 'postType',
'post_value' => 'postValue',
'post_medium_text_value' => 'postMediumTextValue'    ];

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
'post_medium_text_value' => 'setPostMediumTextValue'    ];

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
'post_medium_text_value' => 'getPostMediumTextValue'    ];

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

    const NOTE_GROUP_TYPE_EXTRAORDINARY_INCOME_GROUP = 'EXTRAORDINARY_INCOME_GROUP';
const NOTE_GROUP_TYPE_EXTRAORDINARY_COST_GROUP = 'EXTRAORDINARY_COST_GROUP';
const NOTE_GROUP_TYPE_GROUP_GROUP = 'GROUP_GROUP';
const NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP';
const POST_TYPE_ID_FOR_NOTE = 'ID_FOR_NOTE';
const POST_TYPE_IS_CHECKED = 'IS_CHECKED';
const POST_TYPE_UPDATED_BY = 'UPDATED_BY';
const POST_TYPE_UPDATED_DATE = 'UPDATED_DATE';
const POST_TYPE_ACCOUNTS = 'ACCOUNTS';
const POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT = 'ACCOUNTING_PRINCIPLES_FREE_TEXT';
const POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT = 'ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT';
const POST_TYPE_STILL_IN_BUSINESS = 'STILL_IN_BUSINESS';
const POST_TYPE_STILL_IN_BUSINESS_INFO = 'STILL_IN_BUSINESS_INFO';
const POST_TYPE_NUMBER_OF_MAN_YEARS = 'NUMBER_OF_MAN_YEARS';
const POST_TYPE_OPENING_BALANCE_SALARY = 'OPENING_BALANCE_SALARY';
const POST_TYPE_CLOSING_BALANCE_SALARY = 'CLOSING_BALANCE_SALARY';
const POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
const POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
const POST_TYPE_OPENING_BALANCE_PENSION_COST = 'OPENING_BALANCE_PENSION_COST';
const POST_TYPE_CLOSING_BALANCE_PENSION_COST = 'CLOSING_BALANCE_PENSION_COST';
const POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS = 'OPENING_BALANCE_OTHER_BENEFITS';
const POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS = 'CLOSING_BALANCE_OTHER_BENEFITS';
const POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY = 'ABOUT_MAN_YEARS_AND_SALARY';
const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST = 'EXTRAORDINARY_INCOME_AND_COST';
const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION = 'EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION';
const POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT = 'EXTRAORDINARY_INCOME_AND_COST_AMOUNT';
const POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS';
const POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
const POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
const POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST = 'FIXED_ASSETS_CLOSING_ACQUISITION_COST';
const POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
const POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE = 'FIXED_ASSETS_CLOSING_CAPITALISED_VALUE';
const POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
const POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE = 'FIXED_ASSETS_ECONOMIC_LIFE';
const POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS';
const POST_TYPE_FIXED_ASSETS_ACQUISITION_COST = 'FIXED_ASSETS_ACQUISITION_COST';
const POST_TYPE_FIXED_ASSETS_GOODWILL = 'FIXED_ASSETS_GOODWILL';
const POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE';
const POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION = 'FIXED_ASSETS_ADDITIONAL_INFORMATION';
const POST_TYPE_GROUP = 'GROUP';
const POST_TYPE_GROUP_INVESTMENTS = 'GROUP_INVESTMENTS';
const POST_TYPE_GROUP_OPENING_BALANCE = 'GROUP_OPENING_BALANCE';
const POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME = 'GROUP_REVENUE_RECOGNIZED_AS_INCOME';
const POST_TYPE_GROUP_OTHER_CHANGES = 'GROUP_OTHER_CHANGES';
const POST_TYPE_GROUP_CLOSING_BALANCE = 'GROUP_CLOSING_BALANCE';
const POST_TYPE_GROUP_ADDED_VALUE = 'GROUP_ADDED_VALUE';
const POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES = 'GROUP_DEPRECIATION_OF_ADDED_VALUES';
const POST_TYPE_GROUP_GOODWILL = 'GROUP_GOODWILL';
const POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL = 'GROUP_DEPRECIATION_OF_GOODWILL';
const POST_TYPE_GROUP_TOTAL_ACQUISITION_COST = 'GROUP_TOTAL_ACQUISITION_COST';
const POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY = 'GROUP_TOTAL_CAPITALIZED_EQUITY';
const POST_TYPE_GROUP_IS_SUBSIDIARY = 'GROUP_IS_SUBSIDIARY';
const POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY = 'GROUP_NAME_OF_PARENT_COMPANY';
const POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY = 'GROUP_BUSINESS_OFFICE_PARENT_COMPANY';
const POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION';
const POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION';
const POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES = 'GROUP_TRANSACTIONS_WITH_SUBSIDIARIES';
const POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS = 'GROUP_INTERNAL_GAIN_TRANSACTIONS';
const POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES = 'GROUP_RECEIVABLES_AND_LIABILITIES';
const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
const POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS = 'OPENING_BALANCE_MORTGAGED_ASSETS';
const POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL = 'OPENING_BALANCE_OTHER_COLLATERAL';
const POST_TYPE_OPENING_BALANCE_GUANRANTEES = 'OPENING_BALANCE_GUANRANTEES';
const POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO = 'GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO';
const POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR = 'RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR';
const POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION = 'RECEIVABLES_ADDITIONAL_INFORMATION';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION';
const POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION';
const POST_TYPE_HOLDING_OWN_SHARES = 'HOLDING_OWN_SHARES';
const POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES = 'HOLDING_OWN_SHARES_NUMBER_OF_SHARES';
const POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES = 'HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES';
const POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL = 'HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL';
const POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
const POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION = 'OWN_SHARES_ACQUISITIONS_REMUNERATION';
const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION = 'PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION';
const POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
const POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
const POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
const POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
const POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION = 'OWN_SHARES_DISPOSAL_REMUNERATION';
const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION = 'PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION';
const POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
const POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
const POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT = 'HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT';
const POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR = 'HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR';
const POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS = 'HOLDING_OWN_SHARES_PROVISIONS';
const POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION = 'HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION';
const POST_TYPE_DEBT_DUE_FOR_PAYMENT = 'DEBT_DUE_FOR_PAYMENT';
const POST_TYPE_DEBT_SECURED_BY_MORTGAGE = 'DEBT_SECURED_BY_MORTGAGE';
const POST_TYPE_DEBT_CAPITALISED_VALUE = 'DEBT_CAPITALISED_VALUE';
const POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS = 'DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS';
const POST_TYPE_DEBT_WARRANTY_OBLIGATIONS = 'DEBT_WARRANTY_OBLIGATIONS';
const POST_TYPE_DEBT_ADDITIONAL_INFORMATION = 'DEBT_ADDITIONAL_INFORMATION';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED = 'LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES';
const POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION = 'LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION';
const POST_TYPE_FREE_NOTE_FREE_TEXT = 'FREE_NOTE_FREE_TEXT';

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
self::NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP,        ];
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
self::POST_TYPE_FREE_NOTE_FREE_TEXT,        ];
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
        $this->container['year_end_report'] = isset($data['year_end_report']) ? $data['year_end_report'] : null;
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
        $this->container['note_group_type'] = isset($data['note_group_type']) ? $data['note_group_type'] : null;
        $this->container['note_sub_type_group_id'] = isset($data['note_sub_type_group_id']) ? $data['note_sub_type_group_id'] : null;
        $this->container['post_type'] = isset($data['post_type']) ? $data['post_type'] : null;
        $this->container['post_value'] = isset($data['post_value']) ? $data['post_value'] : null;
        $this->container['post_medium_text_value'] = isset($data['post_medium_text_value']) ? $data['post_medium_text_value'] : null;
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
                "invalid value for 'note_group_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['post_type'] === null) {
            $invalidProperties[] = "'post_type' can't be null";
        }
        $allowedValues = $this->getPostTypeAllowableValues();
        if (!is_null($this->container['post_type']) && !in_array($this->container['post_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'post_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['post_value'] === null) {
            $invalidProperties[] = "'post_value' can't be null";
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
     * Gets note
     *
     * @return \Learnist\Tripletex\Model\YearEndReportNote
     */
    public function getNote()
    {
        return $this->container['note'];
    }

    /**
     * Sets note
     *
     * @param \Learnist\Tripletex\Model\YearEndReportNote $note note
     *
     * @return $this
     */
    public function setNote($note)
    {
        $this->container['note'] = $note;

        return $this;
    }

    /**
     * Gets note_group_type
     *
     * @return string
     */
    public function getNoteGroupType()
    {
        return $this->container['note_group_type'];
    }

    /**
     * Sets note_group_type
     *
     * @param string $note_group_type note_group_type
     *
     * @return $this
     */
    public function setNoteGroupType($note_group_type)
    {
        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!is_null($note_group_type) && !in_array($note_group_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'note_group_type', must be one of '%s'",
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
     * @return int
     */
    public function getNoteSubTypeGroupId()
    {
        return $this->container['note_sub_type_group_id'];
    }

    /**
     * Sets note_sub_type_group_id
     *
     * @param int $note_sub_type_group_id note_sub_type_group_id
     *
     * @return $this
     */
    public function setNoteSubTypeGroupId($note_sub_type_group_id)
    {
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
     * @return $this
     */
    public function setPostType($post_type)
    {
        $allowedValues = $this->getPostTypeAllowableValues();
        if (!in_array($post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'post_type', must be one of '%s'",
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
     * @return $this
     */
    public function setPostValue($post_value)
    {
        $this->container['post_value'] = $post_value;

        return $this;
    }

    /**
     * Gets post_medium_text_value
     *
     * @return string
     */
    public function getPostMediumTextValue()
    {
        return $this->container['post_medium_text_value'];
    }

    /**
     * Sets post_medium_text_value
     *
     * @param string $post_medium_text_value post_medium_text_value
     *
     * @return $this
     */
    public function setPostMediumTextValue($post_medium_text_value)
    {
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
