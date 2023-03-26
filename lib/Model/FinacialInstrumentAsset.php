<?php
/**
 * FinacialInstrumentAsset
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
 * FinacialInstrumentAsset Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class FinacialInstrumentAsset implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'FinacialInstrumentAsset';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'note' => '\Learnist\Tripletex\Model\YearEndReportNote',
'note_post_type' => 'string',
'note_group_type' => 'string',
'note_sub_type_group_id' => 'float',
'asset' => 'float',
'real_value' => 'float',
'value_adjustment' => 'float'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'note' => null,
'note_post_type' => null,
'note_group_type' => null,
'note_sub_type_group_id' => null,
'asset' => null,
'real_value' => null,
'value_adjustment' => null    ];

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
        'note' => 'note',
'note_post_type' => 'notePostType',
'note_group_type' => 'noteGroupType',
'note_sub_type_group_id' => 'noteSubTypeGroupId',
'asset' => 'asset',
'real_value' => 'realValue',
'value_adjustment' => 'valueAdjustment'    ];

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
'asset' => 'setAsset',
'real_value' => 'setRealValue',
'value_adjustment' => 'setValueAdjustment'    ];

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
'asset' => 'getAsset',
'real_value' => 'getRealValue',
'value_adjustment' => 'getValueAdjustment'    ];

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

    const NOTE_POST_TYPE_ID_FOR_NOTE = 'ID_FOR_NOTE';
const NOTE_POST_TYPE_IS_CHECKED = 'IS_CHECKED';
const NOTE_POST_TYPE_UPDATED_BY = 'UPDATED_BY';
const NOTE_POST_TYPE_UPDATED_DATE = 'UPDATED_DATE';
const NOTE_POST_TYPE_ACCOUNTS = 'ACCOUNTS';
const NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_FREE_TEXT = 'ACCOUNTING_PRINCIPLES_FREE_TEXT';
const NOTE_POST_TYPE_ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT = 'ACCOUNTING_PRINCIPLES_USE_DEFAULT_TEXT';
const NOTE_POST_TYPE_STILL_IN_BUSINESS = 'STILL_IN_BUSINESS';
const NOTE_POST_TYPE_STILL_IN_BUSINESS_INFO = 'STILL_IN_BUSINESS_INFO';
const NOTE_POST_TYPE_NUMBER_OF_MAN_YEARS = 'NUMBER_OF_MAN_YEARS';
const NOTE_POST_TYPE_OPENING_BALANCE_SALARY = 'OPENING_BALANCE_SALARY';
const NOTE_POST_TYPE_CLOSING_BALANCE_SALARY = 'CLOSING_BALANCE_SALARY';
const NOTE_POST_TYPE_OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'OPENING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
const NOTE_POST_TYPE_CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS = 'CLOSING_BALANCE_NATIONAL_INSURANCE_CONTRIBUTIONS';
const NOTE_POST_TYPE_OPENING_BALANCE_PENSION_COST = 'OPENING_BALANCE_PENSION_COST';
const NOTE_POST_TYPE_CLOSING_BALANCE_PENSION_COST = 'CLOSING_BALANCE_PENSION_COST';
const NOTE_POST_TYPE_OPENING_BALANCE_OTHER_BENEFITS = 'OPENING_BALANCE_OTHER_BENEFITS';
const NOTE_POST_TYPE_CLOSING_BALANCE_OTHER_BENEFITS = 'CLOSING_BALANCE_OTHER_BENEFITS';
const NOTE_POST_TYPE_ABOUT_MAN_YEARS_AND_SALARY = 'ABOUT_MAN_YEARS_AND_SALARY';
const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST = 'EXTRAORDINARY_INCOME_AND_COST';
const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION = 'EXTRAORDINARY_INCOME_AND_COST_DESCRIPTION';
const NOTE_POST_TYPE_EXTRAORDINARY_INCOME_AND_COST_AMOUNT = 'EXTRAORDINARY_INCOME_AND_COST_AMOUNT';
const NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_TANGIBLE_FIXED_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS = 'FIXED_ASSETS_OPENING_ACQUISITION_COST_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_INFLOW_IN_THE_YEAR_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_TANGIBLE_FIXED_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DISPOSAL_IN_THE_YEAR_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_ACQUISITION_COST = 'FIXED_ASSETS_CLOSING_ACQUISITION_COST';
const NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_TOTAL_DEPRECIATIONS_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_CLOSING_CAPITALISED_VALUE = 'FIXED_ASSETS_CLOSING_CAPITALISED_VALUE';
const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_TANGIBLE_FIXED_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATIONS_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_ECONOMIC_LIFE = 'FIXED_ASSETS_ECONOMIC_LIFE';
const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE_INTANGIBLE_ASSETS';
const NOTE_POST_TYPE_FIXED_ASSETS_ACQUISITION_COST = 'FIXED_ASSETS_ACQUISITION_COST';
const NOTE_POST_TYPE_FIXED_ASSETS_GOODWILL = 'FIXED_ASSETS_GOODWILL';
const NOTE_POST_TYPE_FIXED_ASSETS_DEPRECIATION_SCHEDULE = 'FIXED_ASSETS_DEPRECIATION_SCHEDULE';
const NOTE_POST_TYPE_FIXED_ASSETS_ADDITIONAL_INFORMATION = 'FIXED_ASSETS_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_GROUP = 'GROUP';
const NOTE_POST_TYPE_GROUP_INVESTMENTS = 'GROUP_INVESTMENTS';
const NOTE_POST_TYPE_GROUP_OPENING_BALANCE = 'GROUP_OPENING_BALANCE';
const NOTE_POST_TYPE_GROUP_REVENUE_RECOGNIZED_AS_INCOME = 'GROUP_REVENUE_RECOGNIZED_AS_INCOME';
const NOTE_POST_TYPE_GROUP_OTHER_CHANGES = 'GROUP_OTHER_CHANGES';
const NOTE_POST_TYPE_GROUP_CLOSING_BALANCE = 'GROUP_CLOSING_BALANCE';
const NOTE_POST_TYPE_GROUP_ADDED_VALUE = 'GROUP_ADDED_VALUE';
const NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_ADDED_VALUES = 'GROUP_DEPRECIATION_OF_ADDED_VALUES';
const NOTE_POST_TYPE_GROUP_GOODWILL = 'GROUP_GOODWILL';
const NOTE_POST_TYPE_GROUP_DEPRECIATION_OF_GOODWILL = 'GROUP_DEPRECIATION_OF_GOODWILL';
const NOTE_POST_TYPE_GROUP_TOTAL_ACQUISITION_COST = 'GROUP_TOTAL_ACQUISITION_COST';
const NOTE_POST_TYPE_GROUP_TOTAL_CAPITALIZED_EQUITY = 'GROUP_TOTAL_CAPITALIZED_EQUITY';
const NOTE_POST_TYPE_GROUP_IS_SUBSIDIARY = 'GROUP_IS_SUBSIDIARY';
const NOTE_POST_TYPE_GROUP_NAME_OF_PARENT_COMPANY = 'GROUP_NAME_OF_PARENT_COMPANY';
const NOTE_POST_TYPE_GROUP_BUSINESS_OFFICE_PARENT_COMPANY = 'GROUP_BUSINESS_OFFICE_PARENT_COMPANY';
const NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION';
const NOTE_POST_TYPE_GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION = 'GROUP_EXCLUDED_FROM_CONSOLIDATION_JUSTIFICATION';
const NOTE_POST_TYPE_GROUP_TRANSACTIONS_WITH_SUBSIDIARIES = 'GROUP_TRANSACTIONS_WITH_SUBSIDIARIES';
const NOTE_POST_TYPE_GROUP_INTERNAL_GAIN_TRANSACTIONS = 'GROUP_INTERNAL_GAIN_TRANSACTIONS';
const NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES = 'GROUP_RECEIVABLES_AND_LIABILITIES';
const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_RECEIVABLES_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_LONG_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CORPORATE';
const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'OPENING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY = 'CLOSING_BALANCE_SHORT_TERM_TOTAL_AMOUNT_CONTROLLED_COMPANY';
const NOTE_POST_TYPE_OPENING_BALANCE_MORTGAGED_ASSETS = 'OPENING_BALANCE_MORTGAGED_ASSETS';
const NOTE_POST_TYPE_OPENING_BALANCE_OTHER_COLLATERAL = 'OPENING_BALANCE_OTHER_COLLATERAL';
const NOTE_POST_TYPE_OPENING_BALANCE_GUANRANTEES = 'OPENING_BALANCE_GUANRANTEES';
const NOTE_POST_TYPE_GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO = 'GROUP_RECEIVABLES_AND_LIABILITIES_ADDITIONAL_INFO';
const NOTE_POST_TYPE_RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR = 'RECEIVABLES_FALL_DUE_LATER_THAN_ONE_YEAR';
const NOTE_POST_TYPE_RECEIVABLES_ADDITIONAL_INFORMATION = 'RECEIVABLES_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ASSET';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_REAL_VALUE';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_VALUE_ADJUSTMENT';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_DESCRIPTION';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES = 'HOLDING_OWN_SHARES';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_NUMBER_OF_SHARES = 'HOLDING_OWN_SHARES_NUMBER_OF_SHARES';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES = 'HOLDING_OWN_SHARES_NOMINAL_VALUE_OF_SHARES';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL = 'HOLDING_OWN_SHARES_PART_OF_SHARE_CAPITAL';
const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_ACQUISITIONS_NUMBER_OF_SHARES_ACQUIRED';
const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_REMUNERATION = 'OWN_SHARES_ACQUISITIONS_REMUNERATION';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION = 'PARENT_COMPANY_SHARES_ACQUISITIONS_REMUNERATION';
const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_ACQUISITIONS_PART_OF_SHARE_CAPITAL';
const NOTE_POST_TYPE_OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'OWN_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS = 'PARENT_COMPANY_SHARES_ACQUISITIONS_BACKGROUND_ACQUISITIONS';
const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'OWN_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED = 'PARENT_COMPANY_SHARES_DISPOSAL_NUMBER_OF_SHARES_ACQUIRED';
const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_REMUNERATION = 'OWN_SHARES_DISPOSAL_REMUNERATION';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION = 'PARENT_COMPANY_SHARES_DISPOSAL_REMUNERATION';
const NOTE_POST_TYPE_OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'OWN_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
const NOTE_POST_TYPE_PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL = 'PARENT_COMPANY_SHARES_DISPOSAL_PART_OF_SHARE_CAPITAL';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT = 'HOLDING_OWN_SHARES_THIS_YEARS_PAYOUT';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR = 'HOLDING_OWN_SHARES_PROVISION_FOR_THE_YEAR';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_PROVISIONS = 'HOLDING_OWN_SHARES_PROVISIONS';
const NOTE_POST_TYPE_HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION = 'HOLDING_OWN_SHARES_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_DEBT_DUE_FOR_PAYMENT = 'DEBT_DUE_FOR_PAYMENT';
const NOTE_POST_TYPE_DEBT_SECURED_BY_MORTGAGE = 'DEBT_SECURED_BY_MORTGAGE';
const NOTE_POST_TYPE_DEBT_CAPITALISED_VALUE = 'DEBT_CAPITALISED_VALUE';
const NOTE_POST_TYPE_DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS = 'DEBT_TOTAL_NON_RECOGNIZED_WARRANTY_OBLIGATIONS';
const NOTE_POST_TYPE_DEBT_WARRANTY_OBLIGATIONS = 'DEBT_WARRANTY_OBLIGATIONS';
const NOTE_POST_TYPE_DEBT_ADDITIONAL_INFORMATION = 'DEBT_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED = 'LOAN_AND_PROVISION_OF_SECURITY_IS_GRANTED';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_TOTAL_LOAN_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_PROVISION_OF_COLLATERAL_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_INTEREST_RATE_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_MAIN_TERMS_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_REIMBURSED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_DEDUCTED_AMOUNT_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_BOARD_MEMBERS';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES = 'LOAN_AND_PROVISION_OF_SECURITY_WAIVED_AMOUNTS_MEMBERS_OF_OTHER_BODIES';
const NOTE_POST_TYPE_LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION = 'LOAN_AND_PROVISION_OF_SECURITY_ADDITIONAL_INFORMATION';
const NOTE_POST_TYPE_FREE_NOTE_FREE_TEXT = 'FREE_NOTE_FREE_TEXT';
const NOTE_GROUP_TYPE_EXTRAORDINARY_INCOME_GROUP = 'EXTRAORDINARY_INCOME_GROUP';
const NOTE_GROUP_TYPE_EXTRAORDINARY_COST_GROUP = 'EXTRAORDINARY_COST_GROUP';
const NOTE_GROUP_TYPE_GROUP_GROUP = 'GROUP_GROUP';
const NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP = 'ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP';

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
self::NOTE_POST_TYPE_FREE_NOTE_FREE_TEXT,        ];
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
self::NOTE_GROUP_TYPE_ACTUAL_VALUE_FINACIAL_INSTRUMENTS_GROUP,        ];
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
        $this->container['note'] = isset($data['note']) ? $data['note'] : null;
        $this->container['note_post_type'] = isset($data['note_post_type']) ? $data['note_post_type'] : null;
        $this->container['note_group_type'] = isset($data['note_group_type']) ? $data['note_group_type'] : null;
        $this->container['note_sub_type_group_id'] = isset($data['note_sub_type_group_id']) ? $data['note_sub_type_group_id'] : null;
        $this->container['asset'] = isset($data['asset']) ? $data['asset'] : null;
        $this->container['real_value'] = isset($data['real_value']) ? $data['real_value'] : null;
        $this->container['value_adjustment'] = isset($data['value_adjustment']) ? $data['value_adjustment'] : null;
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
                "invalid value for 'note_post_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getNoteGroupTypeAllowableValues();
        if (!is_null($this->container['note_group_type']) && !in_array($this->container['note_group_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'note_group_type', must be one of '%s'",
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
     * Gets note_post_type
     *
     * @return string
     */
    public function getNotePostType()
    {
        return $this->container['note_post_type'];
    }

    /**
     * Sets note_post_type
     *
     * @param string $note_post_type note_post_type
     *
     * @return $this
     */
    public function setNotePostType($note_post_type)
    {
        $allowedValues = $this->getNotePostTypeAllowableValues();
        if (!is_null($note_post_type) && !in_array($note_post_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'note_post_type', must be one of '%s'",
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
     * @return float
     */
    public function getNoteSubTypeGroupId()
    {
        return $this->container['note_sub_type_group_id'];
    }

    /**
     * Sets note_sub_type_group_id
     *
     * @param float $note_sub_type_group_id note_sub_type_group_id
     *
     * @return $this
     */
    public function setNoteSubTypeGroupId($note_sub_type_group_id)
    {
        $this->container['note_sub_type_group_id'] = $note_sub_type_group_id;

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
     * Gets real_value
     *
     * @return float
     */
    public function getRealValue()
    {
        return $this->container['real_value'];
    }

    /**
     * Sets real_value
     *
     * @param float $real_value real_value
     *
     * @return $this
     */
    public function setRealValue($real_value)
    {
        $this->container['real_value'] = $real_value;

        return $this;
    }

    /**
     * Gets value_adjustment
     *
     * @return float
     */
    public function getValueAdjustment()
    {
        return $this->container['value_adjustment'];
    }

    /**
     * Sets value_adjustment
     *
     * @param float $value_adjustment value_adjustment
     *
     * @return $this
     */
    public function setValueAdjustment($value_adjustment)
    {
        $this->container['value_adjustment'] = $value_adjustment;

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
