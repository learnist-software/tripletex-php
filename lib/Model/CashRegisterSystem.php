<?php
/**
 * CashRegisterSystem
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
 * CashRegisterSystem Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CashRegisterSystem implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CashRegisterSystem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'group_id' => 'float',
        'generic_data_type' => 'string',
        'generic_data_sub_type_group_id' => 'float',
        'year_of_initial_registration' => 'float',
        'cash_register_system' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'group_id' => null,
        'generic_data_type' => null,
        'generic_data_sub_type_group_id' => null,
        'year_of_initial_registration' => null,
        'cash_register_system' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'group_id' => false,
		'generic_data_type' => false,
		'generic_data_sub_type_group_id' => false,
		'year_of_initial_registration' => false,
		'cash_register_system' => false
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
        'group_id' => 'groupId',
        'generic_data_type' => 'genericDataType',
        'generic_data_sub_type_group_id' => 'genericDataSubTypeGroupId',
        'year_of_initial_registration' => 'yearOfInitialRegistration',
        'cash_register_system' => 'cashRegisterSystem'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'group_id' => 'setGroupId',
        'generic_data_type' => 'setGenericDataType',
        'generic_data_sub_type_group_id' => 'setGenericDataSubTypeGroupId',
        'year_of_initial_registration' => 'setYearOfInitialRegistration',
        'cash_register_system' => 'setCashRegisterSystem'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'group_id' => 'getGroupId',
        'generic_data_type' => 'getGenericDataType',
        'generic_data_sub_type_group_id' => 'getGenericDataSubTypeGroupId',
        'year_of_initial_registration' => 'getYearOfInitialRegistration',
        'cash_register_system' => 'getCashRegisterSystem'
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
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11240 = 'ABLINDEX_EVERESTBYLINDEX_11240';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11250 = 'ABLINDEX_EVERESTBYLINDEX_11250';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11260 = 'ABLINDEX_EVERESTBYLINDEX_11260';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11270 = 'ABLINDEX_EVERESTBYLINDEX_11270';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113110 = 'ABLINDEX_EVERESTBYLINDEX_113110';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113170 = 'ABLINDEX_EVERESTBYLINDEX_113170';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113250 = 'ABLINDEX_EVERESTBYLINDEX_113250';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113290 = 'ABLINDEX_EVERESTBYLINDEX_113290';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113300 = 'ABLINDEX_EVERESTBYLINDEX_113300';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113310 = 'ABLINDEX_EVERESTBYLINDEX_113310';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113320 = 'ABLINDEX_EVERESTBYLINDEX_113320';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113330 = 'ABLINDEX_EVERESTBYLINDEX_113330';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116110 = 'ABLINDEX_EVERESTBYLINDEX_116110';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116170 = 'ABLINDEX_EVERESTBYLINDEX_116170';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116200 = 'ABLINDEX_EVERESTBYLINDEX_116200';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11670 = 'ABLINDEX_EVERESTBYLINDEX_11670';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_117110 = 'ABLINDEX_EVERESTBYLINDEX_117110';
    public const CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11740 = 'ABLINDEX_EVERESTBYLINDEX_11740';
    public const CASH_REGISTER_SYSTEM_AJOURNORDICAPS_AJOUR_SOFTWAREBESTEMT_70 = 'AJOURNORDICAPS_AJOUR_SOFTWAREBESTEMT_70';
    public const CASH_REGISTER_SYSTEM_AJOURNORDIC_NORGEAS_AJOUR_2 = 'AJOURNORDIC_NORGEAS_AJOUR_2';
    public const CASH_REGISTER_SYSTEM_AKTECHOTELAS_PICASSO_83 = 'AKTECHOTELAS_PICASSO_83';
    public const CASH_REGISTER_SYSTEM_AKTSIASELTSHELMES_HELMESPOS_101 = 'AKTSIASELTSHELMES_HELMESPOS_101';
    public const CASH_REGISTER_SYSTEM_ALFAGRUPPENAS_ALFAKASSE_V10 = 'ALFAGRUPPENAS_ALFAKASSE_V10';
    public const CASH_REGISTER_SYSTEM_ALFASOFTWAREAS_ROLFPOS_701 = 'ALFASOFTWAREAS_ROLFPOS_701';
    public const CASH_REGISTER_SYSTEM_ALREADYORDEREDAS_MOBILE04_31 = 'ALREADYORDEREDAS_MOBILE04_31';
    public const CASH_REGISTER_SYSTEM_AMICABUSINESSSOLUTIONS_TENDERPOS_13000 = 'AMICABUSINESSSOLUTIONS_TENDERPOS_13000';
    public const CASH_REGISTER_SYSTEM_ANCONAB_SHARPDININGNO_10 = 'ANCONAB_SHARPDININGNO_10';
    public const CASH_REGISTER_SYSTEM_APPEXAS_MANITSYS_010 = 'APPEXAS_MANITSYS_010';
    public const CASH_REGISTER_SYSTEM_ARANTEK_ARANTEK_74_XX = 'ARANTEK_ARANTEK_74XX';
    public const CASH_REGISTER_SYSTEM_ARANTEK_ARANTEK_75_XX = 'ARANTEK_ARANTEK_75XX';
    public const CASH_REGISTER_SYSTEM_ARANTEK_PAYONE_7_XXX = 'ARANTEK_PAYONE_7XXX';
    public const CASH_REGISTER_SYSTEM_ARANTEK_S8_RPOS_75_XX = 'ARANTEK_S8RPOS_75XX';
    public const CASH_REGISTER_SYSTEM_ARANTEK_TOPTOUCH_75_XX = 'ARANTEK_TOPTOUCH_75XX';
    public const CASH_REGISTER_SYSTEM_ARKOTERAPEUT_WINDOWS_5_XX = 'ARKOTERAPEUT_WINDOWS_5XX';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ACE130_V1103 = 'ATRONELECTRONICGMBH_ACE130_V1103';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFA460_491_V1103 = 'ATRONELECTRONICGMBH_AFA460_491_V1103';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFA470_V1103 = 'ATRONELECTRONICGMBH_AFA470_V1103';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFR4_V1103 = 'ATRONELECTRONICGMBH_AFR4_V1103';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AMR172_V323 = 'ATRONELECTRONICGMBH_AMR172_V323';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ASTS_V123 = 'ATRONELECTRONICGMBH_ASTS_V123';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ATRIES_256 = 'ATRONELECTRONICGMBH_ATRIES_256';
    public const CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_FRTOUCH_V1101 = 'ATRONELECTRONICGMBH_FRTOUCH_V1101';
    public const CASH_REGISTER_SYSTEM_AVIONORWAYAS_AVIOMOBILEPOS_30 = 'AVIONORWAYAS_AVIOMOBILEPOS_30';
    public const CASH_REGISTER_SYSTEM_AVIONORWAYAS_AVIOPOS_31 = 'AVIONORWAYAS_AVIOPOS_31';
    public const CASH_REGISTER_SYSTEM_AXESSAG_SMARTPOS_121 = 'AXESSAG_SMARTPOS_121';
    public const CASH_REGISTER_SYSTEM_B2_BTRADING_MICROPOS = 'B2BTRADING_MICROPOS';
    public const CASH_REGISTER_SYSTEM_BAIKINGUAS_BAIKINGUFOOD_BEVERAGE_ANDROID112 = 'BAIKINGUAS_BAIKINGUFOOD_BEVERAGE_ANDROID112';
    public const CASH_REGISTER_SYSTEM_BAIKINGUAS_RETAILCLOUD_20181 = 'BAIKINGUAS_RETAILCLOUD_20181';
    public const CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_401 = 'BESTVALUEAS_HANDELIPRAKSIS_401';
    public const CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_402 = 'BESTVALUEAS_HANDELIPRAKSIS_402';
    public const CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_403 = 'BESTVALUEAS_HANDELIPRAKSIS_403';
    public const CASH_REGISTER_SYSTEM_BESTVALUEAS_HIPSELVBETJENT_101 = 'BESTVALUEAS_HIPSELVBETJENT_101';
    public const CASH_REGISTER_SYSTEM_BIESBROECKAUTOMATIONBV_UNITOUCH_370 = 'BIESBROECKAUTOMATIONBV_UNITOUCH_370';
    public const CASH_REGISTER_SYSTEM_BIESBROECKAUTOMATIONBV_UNITOUCH_370_ELLERNYEREVERSJON = 'BIESBROECKAUTOMATIONBV_UNITOUCH_370ELLERNYEREVERSJON';
    public const CASH_REGISTER_SYSTEM_BITMAKERAS_FYSIOPILATESKASSE_10 = 'BITMAKERAS_FYSIOPILATESKASSE_10';
    public const CASH_REGISTER_SYSTEM_BIZSYSAPS_BIZSYSPOS_2019 = 'BIZSYSAPS_BIZSYSPOS_2019';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_75 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_75';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_76 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_76';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_77 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_77';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_78 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_78';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_79 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_79';
    public const CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_8 = 'BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_8';
    public const CASH_REGISTER_SYSTEM_BOOKNOWSOFTWARELTD_V200_200182 = 'BOOKNOWSOFTWARELTD_V200_200182';
    public const CASH_REGISTER_SYSTEM_BOOSTITAS_CML2020_R2100 = 'BOOSTITAS_CML2020_R2100';
    public const CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRPSYSTEMSPOSNO_10 = 'BRPSYSTEMSAB_BRPSYSTEMSPOSNO_10';
    public const CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRPSYSTEMSPOSNO_11 = 'BRPSYSTEMSAB_BRPSYSTEMSPOSNO_11';
    public const CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRP_251 = 'BRPSYSTEMSAB_BRP_251';
    public const CASH_REGISTER_SYSTEM_CAGISTAAS_CAGISTAPOS_1_X = 'CAGISTAAS_CAGISTAPOS_1X';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_520 = 'CAPGEMININORGEAS_FARMAPRO_520';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_A = 'CAPGEMININORGEAS_FARMAPRO_521A';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_B = 'CAPGEMININORGEAS_FARMAPRO_521B';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_RC2 = 'CAPGEMININORGEAS_FARMAPRO_521RC2';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_522 = 'CAPGEMININORGEAS_FARMAPRO_522';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_523 = 'CAPGEMININORGEAS_FARMAPRO_523';
    public const CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_524 = 'CAPGEMININORGEAS_FARMAPRO_524';
    public const CASH_REGISTER_SYSTEM_CASHITAB_CASHITRETAILMOBILE_34_XX = 'CASHITAB_CASHITRETAILMOBILE_34XX';
    public const CASH_REGISTER_SYSTEM_CASHITAB_CASHITRETAIL_34_XX = 'CASHITAB_CASHITRETAIL_34XX';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_102 = 'CASIO_CASIOSEC3500_102';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_103 = 'CASIO_CASIOSEC3500_103';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_109 = 'CASIO_CASIOSEC3500_109';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_102 = 'CASIO_CASIOSEC450_102';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_103 = 'CASIO_CASIOSEC450_103';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_109 = 'CASIO_CASIOSEC450_109';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_102 = 'CASIO_CASIOSES3000_102';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_103 = 'CASIO_CASIOSES3000_103';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_109 = 'CASIO_CASIOSES3000_109';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_M_STORSKUFF_103 = 'CASIO_CASIOSES400M_STORSKUFF_103';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_M_STORSKUFF_109 = 'CASIO_CASIOSES400M_STORSKUFF_109';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_STORSKUFF_102 = 'CASIO_CASIOSES400_STORSKUFF_102';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOVR100_108 = 'CASIO_CASIOVR100_108';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOVR200_108 = 'CASIO_CASIOVR200_108';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOVR7000_108 = 'CASIO_CASIOVR7000_108';
    public const CASH_REGISTER_SYSTEM_CASIO_CASIOVR7100_108 = 'CASIO_CASIOVR7100_108';
    public const CASH_REGISTER_SYSTEM_CASIO_SEC3500_101 = 'CASIO_SEC3500_101';
    public const CASH_REGISTER_SYSTEM_CASIO_SEC450_101 = 'CASIO_SEC450_101';
    public const CASH_REGISTER_SYSTEM_CASIO_SES3000_101 = 'CASIO_SES3000_101';
    public const CASH_REGISTER_SYSTEM_CASIO_SES400_M_STORSKUFF_101 = 'CASIO_SES400M_STORSKUFF_101';
    public const CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR200_116 = 'CASIO_SUSOFT_CASIOVR200_116';
    public const CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR7000_116 = 'CASIO_SUSOFT_CASIOVR7000_116';
    public const CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR7100_116 = 'CASIO_SUSOFT_CASIOVR7100_116';
    public const CASH_REGISTER_SYSTEM_CASIO_VR100_108 = 'CASIO_VR100_108';
    public const CASH_REGISTER_SYSTEM_CASIO_VR200_108 = 'CASIO_VR200_108';
    public const CASH_REGISTER_SYSTEM_CASIO_VR7000_108 = 'CASIO_VR7000_108';
    public const CASH_REGISTER_SYSTEM_CASIO_VR7100_108 = 'CASIO_VR7100_108';
    public const CASH_REGISTER_SYSTEM_CASPECOAB_CASPECOCHECKOUT_30 = 'CASPECOAB_CASPECOCHECKOUT_30';
    public const CASH_REGISTER_SYSTEM_CATENOAS_CLAWPOS_2_X = 'CATENOAS_CLAWPOS_2X';
    public const CASH_REGISTER_SYSTEM_CATENOAS_CPOS_1_X = 'CATENOAS_CPOS_1X';
    public const CASH_REGISTER_SYSTEM_CBITAS_WELLNESS_1 = 'CBITAS_WELLNESS_1';
    public const CASH_REGISTER_SYSTEM_CDKGLOBAL_DRACAR_070900 = 'CDKGLOBAL_DRACAR_070900';
    public const CASH_REGISTER_SYSTEM_CEGID_Y2_2016_EDITION = 'CEGID_Y2_2016EDITION';
    public const CASH_REGISTER_SYSTEM_CEGID_Y2_V13_ELLERNYERE = 'CEGID_Y2_V13ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_CENIUMAS_HOSPITALITYPOINTOFSALE_1_XXX = 'CENIUMAS_HOSPITALITYPOINTOFSALE_1XXX';
    public const CASH_REGISTER_SYSTEM_CENTRICNETHERLANDSBV_CENTRICDYNAVISION_2016 = 'CENTRICNETHERLANDSBV_CENTRICDYNAVISION_2016';
    public const CASH_REGISTER_SYSTEM_CENTRICNETHERLANDSBV_CENTRICINPOSITION_2017 = 'CENTRICNETHERLANDSBV_CENTRICINPOSITION_2017';
    public const CASH_REGISTER_SYSTEM_CENTRIC_DYNAVISION_4224001 = 'CENTRIC_DYNAVISION_4224001';
    public const CASH_REGISTER_SYSTEM_CHD_CHD6800_MINIPOS_2260 = 'CHD_CHD6800MINIPOS_2260';
    public const CASH_REGISTER_SYSTEM_CHECKINAS_KASSAWEB_10 = 'CHECKINAS_KASSAWEB_10';
    public const CASH_REGISTER_SYSTEM_CINCHAS_CINCHPAY_1 = 'CINCHAS_CINCHPAY_1';
    public const CASH_REGISTER_SYSTEM_CLOUDRETAILSYSTEMSA_S_CBRETAIL_53 = 'CLOUDRETAILSYSTEMSA_S_CBRETAIL_53';
    public const CASH_REGISTER_SYSTEM_CLOUDRETAILSYSTEMSA_S_CBRETAIL_64070_ELLERNYERE = 'CLOUDRETAILSYSTEMSA_S_CBRETAIL_64070ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_CODAB_G3_VERSION1 = 'CODAB_G3_VERSION1';
    public const CASH_REGISTER_SYSTEM_COMPILATORAB_DACKDATA_520_ELLERNYERE = 'COMPILATORAB_DACKDATA_520ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_COMPUSOFTAS_COMPUSOFT_48 = 'COMPUSOFTAS_COMPUSOFT_48';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERINGMOBILE_51_XKLM = 'COMPUTANSEAS_ASSETSERVERINGMOBILE_51XKLM';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERINGMOBILE_520_KLM = 'COMPUTANSEAS_ASSETSERVERINGMOBILE_520KLM';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERING_51_XKL = 'COMPUTANSEAS_ASSETSERVERING_51XKL';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERING_520_KL = 'COMPUTANSEAS_ASSETSERVERING_520KL';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_MOBILE_51_XKLM = 'COMPUTANSEAS_ASSET_M3MOBILE_51XKLM';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_MOBILE_520_KLM = 'COMPUTANSEAS_ASSET_M3MOBILE_520KLM';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_51_XKL = 'COMPUTANSEAS_ASSET_M3_51XKL';
    public const CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_520_KL = 'COMPUTANSEAS_ASSET_M3_520KL';
    public const CASH_REGISTER_SYSTEM_CONDUENTOGENTUR_EXPERT900_OGEXPERT9200_030_ENTUR_ELECTRON100_AFCREST20195_CONDUENT = 'CONDUENTOGENTUR_EXPERT900OGEXPERT9200_030_ENTUR_ELECTRON100AFCREST20195_CONDUENT_';
    public const CASH_REGISTER_SYSTEM_CONDUENTOGENTUR_EXPERT900_OGEXPERT9200_1_X_ENTUR_ELECTRON100_AFCREST20195_CONDUENT = 'CONDUENTOGENTUR_EXPERT900OGEXPERT9200_1X_ENTUR_ELECTRON100AFCREST20195_CONDUENT_';
    public const CASH_REGISTER_SYSTEM_CONDUENT_EXPERT900_OGEXPERT9200_20191 = 'CONDUENT_EXPERT900OGEXPERT9200_20191';
    public const CASH_REGISTER_SYSTEM_COOLNETNORGEAS_LIMEPOS_1 = 'COOLNETNORGEAS_LIMEPOS_1';
    public const CASH_REGISTER_SYSTEM_CORDELNORGEAS_CORDEL_20 = 'CORDELNORGEAS_CORDEL_20';
    public const CASH_REGISTER_SYSTEM_COWHILLS_RPOS_10 = 'COWHILLS_RPOS_10';
    public const CASH_REGISTER_SYSTEM_CRDSYSTEMSOY_BARTRACE_10 = 'CRDSYSTEMSOY_BARTRACE_10';
    public const CASH_REGISTER_SYSTEM_CRDSYSTEMSOY_BARTRACE_100 = 'CRDSYSTEMSOY_BARTRACE_100';
    public const CASH_REGISTER_SYSTEM_CROSSOVERTECHNOLOGIESLTD_XPOS_VERSIONS1_AND2 = 'CROSSOVERTECHNOLOGIESLTD_XPOS_VERSIONS1AND2';
    public const CASH_REGISTER_SYSTEM_DATANOVAAS_DATANOVAIZI_1 = 'DATANOVAAS_DATANOVAIZI_1';
    public const CASH_REGISTER_SYSTEM_DATANOVAAS_WINDOWSSHOPPINGRETAIL_5 = 'DATANOVAAS_WINDOWSSHOPPINGRETAIL_5';
    public const CASH_REGISTER_SYSTEM_DATATEKNIKKNILSEN_TIMEBOKPOS_102 = 'DATATEKNIKKNILSEN_TIMEBOKPOS_102';
    public const CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGABASIC_3211 = 'DATORAMAAB_OMEGABASIC_3211';
    public const CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGAKASSASYSTEM_3211 = 'DATORAMAAB_OMEGAKASSASYSTEM_3211';
    public const CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGALITE_3211 = 'DATORAMAAB_OMEGALITE_3211';
    public const CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGASPLASH_3211 = 'DATORAMAAB_OMEGASPLASH_3211';
    public const CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGASTYLE_3211 = 'DATORAMAAB_OMEGASTYLE_3211';
    public const CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_1884 = 'DDDRETAILNORWAYAS_DDDPOS_1884';
    public const CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_1911 = 'DDDRETAILNORWAYAS_DDDPOS_1911';
    public const CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_19_XX = 'DDDRETAILNORWAYAS_DDDPOS_19XX';
    public const CASH_REGISTER_SYSTEM_DEFINITAS_ANOVAKASSE_K170 = 'DEFINITAS_ANOVAKASSE_K170';
    public const CASH_REGISTER_SYSTEM_DEFINITAS_OMNISHOPPOSMOBILE_20_OGNYERE = 'DEFINITAS_OMNISHOPPOSMOBILE_20OGNYERE';
    public const CASH_REGISTER_SYSTEM_DEGREECONSULTINGGROUPAS_DEGREEPOINTOFSALESSOLUTION_1 = 'DEGREECONSULTINGGROUPAS_DEGREEPOINTOFSALESSOLUTION_1';
    public const CASH_REGISTER_SYSTEM_DEKKPROSOLUTIONSAS_DEKKPROPOS_10 = 'DEKKPROSOLUTIONSAS_DEKKPROPOS_10';
    public const CASH_REGISTER_SYSTEM_DENVER_NORSHOPPRO_143900 = 'DENVER_NORSHOPPRO_143900';
    public const CASH_REGISTER_SYSTEM_DFSTOKHEIM_FUELPOS_VERSION51 = 'DFSTOKHEIM_FUELPOS_VERSION51';
    public const CASH_REGISTER_SYSTEM_DIALOGEXEAS_DXPOS_110 = 'DIALOGEXEAS_DXPOS_110';
    public const CASH_REGISTER_SYSTEM_DIEBOLDNIXDORFAS_TPNET_1010 = 'DIEBOLDNIXDORFAS_TPNET_1010';
    public const CASH_REGISTER_SYSTEM_DLSOFTWARE_DLPRIME_3 = 'DLSOFTWARE_DLPRIME_3';
    public const CASH_REGISTER_SYSTEM_DOMINOS_PULSE_385 = 'DOMINOS_PULSE_385';
    public const CASH_REGISTER_SYSTEM_DOVERFUELINGSOLUTIONS_FUSION_10 = 'DOVERFUELINGSOLUTIONS_FUSION_10';
    public const CASH_REGISTER_SYSTEM_DOVERFUELINGSOLUTIONS_NUCLEUS10_FORFUSION_103 = 'DOVERFUELINGSOLUTIONS_NUCLEUS10FORFUSION_103';
    public const CASH_REGISTER_SYSTEM_EASYUPDATEAS_BUTIKKDATA_70 = 'EASYUPDATEAS_BUTIKKDATA_70';
    public const CASH_REGISTER_SYSTEM_EASYUPDATEAS_BUTIKKDATA_70_ELLERNYERE = 'EASYUPDATEAS_BUTIKKDATA_70ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_EGA_S_DETAIL6_6828 = 'EGA_S_DETAIL6_6828';
    public const CASH_REGISTER_SYSTEM_EGA_S_FACKTAPOS_610 = 'EGA_S_FACKTAPOS_610';
    public const CASH_REGISTER_SYSTEM_EGA_S_HAIRTOOLS_120_ELLERNYERE = 'EGA_S_HAIRTOOLS_120ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_EGNORGEAS_2_DPOINT_7_X = 'EGNORGEAS_2DPOINT_7X';
    public const CASH_REGISTER_SYSTEM_EGNORGEAS_EGBRLDYNAMICSAX2009_POS_10 = 'EGNORGEAS_EGBRLDYNAMICSAX2009POS_10';
    public const CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_242_X = 'EGRETAILAS_EGPOS_242X';
    public const CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_300_X = 'EGRETAILAS_EGPOS_300X';
    public const CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_30_X = 'EGRETAILAS_EGPOS_30X';
    public const CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_40_X = 'EGRETAILAS_EGPOS_40X';
    public const CASH_REGISTER_SYSTEM_EINRSOFTWAREAS_POS9_100 = 'EINRSOFTWAREAS_POS9_100';
    public const CASH_REGISTER_SYSTEM_EINRSOFTWAREAS_POSBE_VERSJON10_ELLERNYERE = 'EINRSOFTWAREAS_POSBE_VERSJON10ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_ELECTRASWEDENAB_ELECTRASMARTBDS_3 = 'ELECTRASWEDENAB_ELECTRASMARTBDS_3';
    public const CASH_REGISTER_SYSTEM_ELEKTRONISKEBETALINGSSYSTEMERAS_FLEXPAY_30 = 'ELEKTRONISKEBETALINGSSYSTEMERAS_FLEXPAY_30';
    public const CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOINT_6 = 'ELFOAS_VISIONPOINT_6';
    public const CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOS_222 = 'ELFOAS_VISIONPOS_222';
    public const CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOS_6 = 'ELFOAS_VISIONPOS_6';
    public const CASH_REGISTER_SYSTEM_ELWATCHAS_JUSTCARDROUGHLINE = 'ELWATCHAS_JUSTCARDROUGHLINE';
    public const CASH_REGISTER_SYSTEM_EMMAEDBAS_BRAVOPOS_3 = 'EMMAEDBAS_BRAVOPOS_3';
    public const CASH_REGISTER_SYSTEM_EMSOFTWAREPARTNERSAS_ELGUIDE_65600 = 'EMSOFTWAREPARTNERSAS_ELGUIDE_65600';
    public const CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT3452 = 'ENTUR_BLUEBIRDBM180_MT3452';
    public const CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT35 = 'ENTUR_BLUEBIRDBM180_MT35';
    public const CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT37 = 'ENTUR_BLUEBIRDBM180_MT37';
    public const CASH_REGISTER_SYSTEM_ENTUR_ESS_5 = 'ENTUR_ESS_5';
    public const CASH_REGISTER_SYSTEM_ENTUR_ESS_6 = 'ENTUR_ESS_6';
    public const CASH_REGISTER_SYSTEM_ENTUR_ESS_7 = 'ENTUR_ESS_7';
    public const CASH_REGISTER_SYSTEM_EONBITAS_EONTYRE_100 = 'EONBITAS_EONTYRE_100';
    public const CASH_REGISTER_SYSTEM_ESCHERGROUPIRL_PULS_5502 = 'ESCHERGROUPIRL_PULS_5502';
    public const CASH_REGISTER_SYSTEM_ESPOSNORGEAS_DIGGIPOS_10 = 'ESPOSNORGEAS_DIGGIPOS_10';
    public const CASH_REGISTER_SYSTEM_ESPOSNORGEAS_ESPOSLIGHT_60 = 'ESPOSNORGEAS_ESPOSLIGHT_60';
    public const CASH_REGISTER_SYSTEM_EVRYASA_OPAS_921812_XX = 'EVRYASA_OPAS_921812XX';
    public const CASH_REGISTER_SYSTEM_EXPRESSRETAILSVERIGEAB_EXPRESSRETAIL_20 = 'EXPRESSRETAILSVERIGEAB_EXPRESSRETAIL_20';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_177_X = 'EXTENDARETAILAB_EXTENDARETAILPOS_177X';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_178_X = 'EXTENDARETAILAB_EXTENDARETAILPOS_178X';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_179 = 'EXTENDARETAILAB_EXTENDARETAILPOS_179';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_171 = 'EXTENDARETAILAS_RSPOS_171';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_173 = 'EXTENDARETAILAS_RSPOS_173';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_174 = 'EXTENDARETAILAS_RSPOS_174';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_162_SP1 = 'EXTENDARETAILAS_SILENTTOUCH_162SP1';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_171 = 'EXTENDARETAILAS_SILENTTOUCH_171';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_172 = 'EXTENDARETAILAS_SILENTTOUCH_172';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_181 = 'EXTENDARETAILAS_SILENTTOUCH_181';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_191 = 'EXTENDARETAILAS_SILENTTOUCH_191';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_201 = 'EXTENDARETAILAS_SILENTTOUCH_201';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_211 = 'EXTENDARETAILAS_SILENTTOUCH_211';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SUPERPOS_1721 = 'EXTENDARETAILAS_SUPERPOS_1721';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SUPERPOS_173 = 'EXTENDARETAILAS_SUPERPOS_173';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILAS_WALLMOBPOS_217 = 'EXTENDARETAILAS_WALLMOBPOS_217';
    public const CASH_REGISTER_SYSTEM_EXTENDARETAILSOFTWAREAB_EXTENDARETAILPOS_EXTENDARETAILKAPV1816 = 'EXTENDARETAILSOFTWAREAB_EXTENDARETAILPOS_EXTENDARETAILKAPV1816';
    public const CASH_REGISTER_SYSTEM_EXTENSORAS_EXTENSOR05_132 = 'EXTENSORAS_EXTENSOR05_132';
    public const CASH_REGISTER_SYSTEM_FARAAS_FARAFTS_FTSCSR3800_FTSTN31 = 'FARAAS_FARAFTS_FTSCSR3800FTSTN31';
    public const CASH_REGISTER_SYSTEM_FASFLOWSOLUTIONSAS_FASTFLOW_2406 = 'FASFLOWSOLUTIONSAS_FASTFLOW_2406';
    public const CASH_REGISTER_SYSTEM_FASTFLOWSOLUTIONSAS_FASTFLOW_2600 = 'FASTFLOWSOLUTIONSAS_FASTFLOW_2600';
    public const CASH_REGISTER_SYSTEM_FDTSYSTEMAB_EXCELLENCERETAILPOS_10220 = 'FDTSYSTEMAB_EXCELLENCERETAILPOS_10220';
    public const CASH_REGISTER_SYSTEM_FIFTYTWO_BORDINGDATA_LBAILBNDLBNSLBNNLBVDLSSBLSSDLSSELGARLGABLGAPLMBLLAPGLAPZLGPSLGPZLAPT_52 = 'FIFTYTWO_BORDINGDATA_LBAILBNDLBNSLBNNLBVDLSSBLSSDLSSELGARLGABLGAPLMBLLAPGLAPZLGPSLGPZLAPT_52';
    public const CASH_REGISTER_SYSTEM_FILMSTADENAB_BOSS_20 = 'FILMSTADENAB_BOSS_20';
    public const CASH_REGISTER_SYSTEM_FLEXICONSYSTEMAB_EXCELLENCE_201811 = 'FLEXICONSYSTEMAB_EXCELLENCE_201811';
    public const CASH_REGISTER_SYSTEM_FLEXPOS_FLEXPOS_215 = 'FLEXPOS_FLEXPOS_215';
    public const CASH_REGISTER_SYSTEM_FLUGGERNORWAYAS_FLUGGERAX2009_POS_10 = 'FLUGGERNORWAYAS_FLUGGERAX2009POS_10';
    public const CASH_REGISTER_SYSTEM_FRONTSYSTEMS_FRONTKASSEFORIOS_10 = 'FRONTSYSTEMS_FRONTKASSEFORIOS_10';
    public const CASH_REGISTER_SYSTEM_FRONTSYSTEMS_I_T_21 = 'FRONTSYSTEMS_I_T_21';
    public const CASH_REGISTER_SYSTEM_FROSTVIKAS_NPOS_421 = 'FROSTVIKAS_NPOS_421';
    public const CASH_REGISTER_SYSTEM_FUTURARETAILSOLUTIONSAG_FUTURERS_337 = 'FUTURARETAILSOLUTIONSAG_FUTURERS_337';
    public const CASH_REGISTER_SYSTEM_FWHTECHNOLOGIES_SUBWAYPOS_20190_NO = 'FWHTECHNOLOGIES_SUBWAYPOS_20190NO';
    public const CASH_REGISTER_SYSTEM_FWHTECHNOLOGIES_SUBWAYPOS_20191_NO = 'FWHTECHNOLOGIES_SUBWAYPOS_20191NO';
    public const CASH_REGISTER_SYSTEM_FYGITECHNOLOGIESAS_SPG_10 = 'FYGITECHNOLOGIESAS_SPG_10';
    public const CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIXPOS_215 = 'GASTROFIXGMBH_GASTROFIXPOS_215';
    public const CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIXPOS_225 = 'GASTROFIXGMBH_GASTROFIXPOS_225';
    public const CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIX_214 = 'GASTROFIXGMBH_GASTROFIX_214';
    public const CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIX_215 = 'GASTROFIXGMBH_GASTROFIX_215';
    public const CASH_REGISTER_SYSTEM_GASTROFIXGMBH_LIGHTSPEEDGASTROFIXPOS_30 = 'GASTROFIXGMBH_LIGHTSPEEDGASTROFIXPOS_30';
    public const CASH_REGISTER_SYSTEM_GETAPOS_WINSILVER_391_ELLERSENERE = 'GETAPOS_WINSILVER_391ELLERSENERE';
    public const CASH_REGISTER_SYSTEM_GETSAS_INSIDEPOS_10 = 'GETSAS_INSIDEPOS_10';
    public const CASH_REGISTER_SYSTEM_GETSHOPAS_1_1 = 'GETSHOPAS_1_1';
    public const CASH_REGISTER_SYSTEM_GIANTLEAPTECHNOLOGIESAS_POCKETSALES_20 = 'GIANTLEAPTECHNOLOGIESAS_POCKETSALES_20';
    public const CASH_REGISTER_SYSTEM_GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_300_ADD = 'GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_300ADD';
    public const CASH_REGISTER_SYSTEM_GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_570_PVH = 'GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_570PVH';
    public const CASH_REGISTER_SYSTEM_GKSOFTWARESE_TPOS1024_12061803 = 'GKSOFTWARESE_TPOS1024_12061803';
    public const CASH_REGISTER_SYSTEM_HANOAS_HANOFOTTERAPEUT_2 = 'HANOAS_HANOFOTTERAPEUT_2';
    public const CASH_REGISTER_SYSTEM_HANOAS_HANOFRISOER_2 = 'HANOAS_HANOFRISOER_2';
    public const CASH_REGISTER_SYSTEM_HANOAS_HANOHANDEL_2 = 'HANOAS_HANOHANDEL_2';
    public const CASH_REGISTER_SYSTEM_HANOAS_HANOHUDPLEIE_2 = 'HANOAS_HANOHUDPLEIE_2';
    public const CASH_REGISTER_SYSTEM_HANOAS_MASSOR_2 = 'HANOAS_MASSOR_2';
    public const CASH_REGISTER_SYSTEM_HANO_NORPOS_2 = 'HANO_NORPOS_2';
    public const CASH_REGISTER_SYSTEM_HANSAWORLD_STANDARDERP_85 = 'HANSAWORLD_STANDARDERP_85';
    public const CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_162 = 'HEADSSVENSKAAB_HEADSRETAIL_162';
    public const CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_172 = 'HEADSSVENSKAAB_HEADSRETAIL_172';
    public const CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_18_X = 'HEADSSVENSKAAB_HEADSRETAIL_18X';
    public const CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_19_X = 'HEADSSVENSKAAB_HEADSRETAIL_19X';
    public const CASH_REGISTER_SYSTEM_HOEDEGAARD_COAS_QUORION_QMP50 = 'HOEDEGAARD_COAS_QUORION_QMP50';
    public const CASH_REGISTER_SYSTEM_HOISTGROUPDEVELOPMENTLTD_HOTSOFT_82400 = 'HOISTGROUPDEVELOPMENTLTD_HOTSOFT_82400';
    public const CASH_REGISTER_SYSTEM_HOLTLRETAILSOLUTIONSGMBH_POSFLOW5_5 = 'HOLTLRETAILSOLUTIONSGMBH_POSFLOW5_5';
    public const CASH_REGISTER_SYSTEM_HOOPLAAS_HOOPLAPOS_12_X = 'HOOPLAAS_HOOPLAPOS_12X';
    public const CASH_REGISTER_SYSTEM_HOOPLASERVICESAS_HOOPLAMPOS_12_X = 'HOOPLASERVICESAS_HOOPLAMPOS_12X';
    public const CASH_REGISTER_SYSTEM_HOOPLASERVICESAS_HOOPLAPOS_12_X = 'HOOPLASERVICESAS_HOOPLAPOS_12X';
    public const CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYOPERA_54 = 'HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYOPERA_54';
    public const CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_50 = 'HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_50';
    public const CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_52 = 'HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_52';
    public const CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_54 = 'HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_54';
    public const CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_55 = 'HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_55';
    public const CASH_REGISTER_SYSTEM_HUGBNAURHF_CENTARA_27 = 'HUGBNAURHF_CENTARA_27';
    public const CASH_REGISTER_SYSTEM_IBM_SUREPOS_566 = 'IBM_SUREPOS_566';
    public const CASH_REGISTER_SYSTEM_INCADEA_ENGINE_2_XOG3_X = 'INCADEA_ENGINE_2XOG3X';
    public const CASH_REGISTER_SYSTEM_INFOTRONICSAS_INFOPAYKASSE_1030 = 'INFOTRONICSAS_INFOPAYKASSE_1030';
    public const CASH_REGISTER_SYSTEM_INSOFTAS_CASHREG_11_XX = 'INSOFTAS_CASHREG_11XX';
    public const CASH_REGISTER_SYSTEM_INTELLIGENTPOINTOFSALE_SALES_LTD_IPOSKASSAREGISTER_10 = 'INTELLIGENTPOINTOFSALE_SALES_LTD_IPOSKASSAREGISTER_10';
    public const CASH_REGISTER_SYSTEM_INTELLITIXTECHNOLOGIESINC_INTELLIPAY_216 = 'INTELLITIXTECHNOLOGIESINC_INTELLIPAY_216';
    public const CASH_REGISTER_SYSTEM_INTELLITIXTECHNOLOGIES_INTELLIPAY_216 = 'INTELLITIXTECHNOLOGIES_INTELLIPAY_216';
    public const CASH_REGISTER_SYSTEM_ITICKET_POS_V1 = 'ITICKET_POS_V1';
    public const CASH_REGISTER_SYSTEM_ITPARTNERHELGELANDAS_PLANITKASSE_2018_OKTOBER = 'ITPARTNERHELGELANDAS_PLANITKASSE_2018OKTOBER';
    public const CASH_REGISTER_SYSTEM_ITXMERKENBV_HIPOS_NOR43 = 'ITXMERKENBV_HIPOS_NOR43';
    public const CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICEAS_IZZETTLEKASSESYSTEM_11 = 'IZETTLEMERCHANTSERVICEAS_IZZETTLEKASSESYSTEM_11';
    public const CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_11 = 'IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_11';
    public const CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_21 = 'IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_21';
    public const CASH_REGISTER_SYSTEM_IZETTLE_IZETTLEREADER_03000000 = 'IZETTLE_IZETTLEREADER_03000000';
    public const CASH_REGISTER_SYSTEM_JEEVESINFORMATIONSYSTEMSAB_GARP_43 = 'JEEVESINFORMATIONSYSTEMSAB_GARP_43';
    public const CASH_REGISTER_SYSTEM_JEEVESINFORMATIONSYSTEMS_GARP_42 = 'JEEVESINFORMATIONSYSTEMS_GARP_42';
    public const CASH_REGISTER_SYSTEM_JMDATASYSTEMAS_JMTPOS_10 = 'JMDATASYSTEMAS_JMTPOS_10';
    public const CASH_REGISTER_SYSTEM_K3_BUSINESSTECHNOLOGIES_IMAGINE_1_XXX = 'K3BUSINESSTECHNOLOGIES_IMAGINE_1XXX';
    public const CASH_REGISTER_SYSTEM_KASSAMAGNEETTIOY_RESTOLUTION_N21 = 'KASSAMAGNEETTIOY_RESTOLUTION_N21';
    public const CASH_REGISTER_SYSTEM_KASSEOGBUTIKKDATA_CASIO_SES3000 = 'KASSEOGBUTIKKDATA_CASIO_SES3000';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1006 = 'KASSESERVICEAS_DUELLAGENT_1006';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1008 = 'KASSESERVICEAS_DUELLAGENT_1008';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1_X = 'KASSESERVICEAS_DUELLAGENT_1X';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_2028 = 'KASSESERVICEAS_DUELLAGENT_2028';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_2029 = 'KASSESERVICEAS_DUELLAGENT_2029';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_112 = 'KASSESERVICEAS_DUELLPOS_112';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_113 = 'KASSESERVICEAS_DUELLPOS_113';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_114 = 'KASSESERVICEAS_DUELLPOS_114';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_115 = 'KASSESERVICEAS_DUELLPOS_115';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_116 = 'KASSESERVICEAS_DUELLPOS_116';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_117 = 'KASSESERVICEAS_DUELLPOS_117';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_118 = 'KASSESERVICEAS_DUELLPOS_118';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_119 = 'KASSESERVICEAS_DUELLPOS_119';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_120 = 'KASSESERVICEAS_DUELLPOS_120';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_121 = 'KASSESERVICEAS_DUELLPOS_121';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_122 = 'KASSESERVICEAS_DUELLPOS_122';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_123 = 'KASSESERVICEAS_DUELLPOS_123';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_124 = 'KASSESERVICEAS_DUELLPOS_124';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_125 = 'KASSESERVICEAS_DUELLPOS_125';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_126 = 'KASSESERVICEAS_DUELLPOS_126';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_127 = 'KASSESERVICEAS_DUELLPOS_127';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_128 = 'KASSESERVICEAS_DUELLPOS_128';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_129 = 'KASSESERVICEAS_DUELLPOS_129';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_130 = 'KASSESERVICEAS_DUELLPOS_130';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_131 = 'KASSESERVICEAS_DUELLPOS_131';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_132 = 'KASSESERVICEAS_DUELLPOS_132';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_134 = 'KASSESERVICEAS_DUELLPOS_134';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_135 = 'KASSESERVICEAS_DUELLPOS_135';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_136 = 'KASSESERVICEAS_DUELLPOS_136';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_140 = 'KASSESERVICEAS_DUELLPOS_140';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_150 = 'KASSESERVICEAS_DUELLPOS_150';
    public const CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_160 = 'KASSESERVICEAS_DUELLPOS_160';
    public const CASH_REGISTER_SYSTEM_KONSULENTDATA_RESTAURANTAS_KDRGOLD_37 = 'KONSULENTDATA_RESTAURANTAS_KDRGOLD_37';
    public const CASH_REGISTER_SYSTEM_KONSULENTDATA_RESTAURANTAS_KDRGOLD_40 = 'KONSULENTDATA_RESTAURANTAS_KDRGOLD_40';
    public const CASH_REGISTER_SYSTEM_KONTAKTLOES_K1_101 = 'KONTAKTLOES_K1_101';
    public const CASH_REGISTER_SYSTEM_LAVACLOUDPOSAS_AVELYN_1000 = 'LAVACLOUDPOSAS_AVELYN_1000';
    public const CASH_REGISTER_SYSTEM_LAVU_LAVUPOS_389 = 'LAVU_LAVUPOS_389';
    public const CASH_REGISTER_SYSTEM_LEEROYGROUPAB_LEEROYMPOS_20_NO = 'LEEROYGROUPAB_LEEROYMPOS_20NO';
    public const CASH_REGISTER_SYSTEM_LEXITGROUPNORWAYAS_LEXPOS_10 = 'LEXITGROUPNORWAYAS_LEXPOS_10';
    public const CASH_REGISTER_SYSTEM_LEXITGROUPNORWAYAS_LEXPOS_10_ELLERNYERE = 'LEXITGROUPNORWAYAS_LEXPOS_10ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_LIGHTSPEEDPOSGERMANYGMBH_LIGHTSPEEDGASTROFIXPOS_312 = 'LIGHTSPEEDPOSGERMANYGMBH_LIGHTSPEEDGASTROFIXPOS_312';
    public const CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_EGPOS_40_X = 'LINDBAKRETAILSYSTEMSAS_EGPOS_40X';
    public const CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_25_X = 'LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_25X';
    public const CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_300_X = 'LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_300X';
    public const CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_30_X = 'LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_30X';
    public const CASH_REGISTER_SYSTEM_LIVINGCONSULTINGAS_POCKETERP_20 = 'LIVINGCONSULTINGAS_POCKETERP_20';
    public const CASH_REGISTER_SYSTEM_LONGRUNSOFTWARE_ECWINS_2019_R1 = 'LONGRUNSOFTWARE_ECWINS_2019R1';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSCENTRAL_150_ANDNEWER = 'LSRETAILEHF_LSCENTRAL_150ANDNEWER';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1002 = 'LSRETAILEHF_LSNAV_1002';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1006 = 'LSRETAILEHF_LSNAV_1006';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_110 = 'LSRETAILEHF_LSNAV_110';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1105750 = 'LSRETAILEHF_LSNAV_1105750';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_130_ANDNEWER = 'LSRETAILEHF_LSNAV_130ANDNEWER';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_90007244 = 'LSRETAILEHF_LSNAV_90007244';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSONEFORSAPBUSINESSONE_2019_ANDLATER = 'LSRETAILEHF_LSONEFORSAPBUSINESSONE_2019ANDLATER';
    public const CASH_REGISTER_SYSTEM_LSRETAILEHF_LSONE_2019_ANDLATER = 'LSRETAILEHF_LSONE_2019ANDLATER';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2009_64 = 'LSRETAIL_LSNAV2009_64';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2015_80 = 'LSRETAIL_LSNAV2015_80';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_100200396 = 'LSRETAIL_LSNAV2017_100200396';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_1002_ELLERNYERE = 'LSRETAIL_LSNAV2017_1002_ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_1008 = 'LSRETAIL_LSNAV2017_1008';
    public const CASH_REGISTER_SYSTEM_LSRETAIL_LSONE_20172 = 'LSRETAIL_LSONE_20172';
    public const CASH_REGISTER_SYSTEM_LYKO_LYKOSMP_2 = 'LYKO_LYKOSMP_2';
    public const CASH_REGISTER_SYSTEM_MABUAS_ZPOS_14 = 'MABUAS_ZPOS_14';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1033 = 'MESTERBLOMSTAS_MGKASSASYSTEM_1033';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1044 = 'MESTERBLOMSTAS_MGKASSASYSTEM_1044';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1055 = 'MESTERBLOMSTAS_MGKASSASYSTEM_1055';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1066 = 'MESTERBLOMSTAS_MGKASSASYSTEM_1066';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_9111 = 'MESTERBLOMSTAS_MGKASSASYSTEM_9111';
    public const CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_922 = 'MESTERBLOMSTAS_MGKASSASYSTEM_922';
    public const CASH_REGISTER_SYSTEM_METRA_LCC_7_XX = 'METRA_LCC_7XX';
    public const CASH_REGISTER_SYSTEM_MICROSOFTCORP_DYNAMICS365_FORFINANCEANDOPERATIONSDYNAMICS365_FORRETAILANDCOMMERCE_ENTERPRISEEDITIONAPPLICATIONUPDATE5_ANDLATER = 'MICROSOFTCORP_DYNAMICS365FORFINANCEANDOPERATIONSDYNAMICS365FORRETAILANDCOMMERCE_ENTERPRISEEDITIONAPPLICATIONUPDATE5ANDLATER';
    public const CASH_REGISTER_SYSTEM_MICROSOFTCORP_DYNAMICS365_FORFINANCEANDOPERATIONSDYNAMICS365_FORRETAIL_ENTERPRISEEDITIONAPPLICATIONUPDATE5 = 'MICROSOFTCORP_DYNAMICS365FORFINANCEANDOPERATIONSDYNAMICS365FORRETAIL_ENTERPRISEEDITIONAPPLICATIONUPDATE5';
    public const CASH_REGISTER_SYSTEM_MICROSOFT_AX2009_LSPOS_SPESIALTILPASNINGFORSKEIDAR = 'MICROSOFT_AX2009LSPOS_SPESIALTILPASNINGFORSKEIDAR';
    public const CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSAX2012_R3 = 'MICROSOFT_DYNAMICSAX2012_R3';
    public const CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSAXSPESIALTILPASSETFORAKZONOBELEUROPE_2012_R3 = 'MICROSOFT_DYNAMICSAXSPESIALTILPASSETFORAKZONOBELEUROPE_2012R3';
    public const CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSNAVCLASSICPOS_50 = 'MICROSOFT_DYNAMICSNAVCLASSICPOS_50';
    public const CASH_REGISTER_SYSTEM_MINSAITSA_TMSFORPOS_240 = 'MINSAITSA_TMSFORPOS_240';
    public const CASH_REGISTER_SYSTEM_MOBITECHAS_MTPROG_05 = 'MOBITECHAS_MTPROG_05';
    public const CASH_REGISTER_SYSTEM_MOBITECHAS_SVPOS_MRK2 = 'MOBITECHAS_SVPOS_MRK2';
    public const CASH_REGISTER_SYSTEM_MOREFLO_MOREFLO_3 = 'MOREFLO_MOREFLO_3';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_317_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_317X';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_417_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_417X';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_418_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_418X';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_419_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_419X';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_420_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_420X';
    public const CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_421_X = 'MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_421X';
    public const CASH_REGISTER_SYSTEM_MUNUAS_MUNUCLOUDPOS_16_ANDABOVE = 'MUNUAS_MUNUCLOUDPOS_16ANDABOVE';
    public const CASH_REGISTER_SYSTEM_MUNUAS_RSPOS_16_ANDBELOW = 'MUNUAS_RSPOS_16ANDBELOW';
    public const CASH_REGISTER_SYSTEM_MYSTORENOAS_20_20 = 'MYSTORENOAS_20_20';
    public const CASH_REGISTER_SYSTEM_MYSTORENOAS_MYSTOREDATAKASSE_32 = 'MYSTORENOAS_MYSTOREDATAKASSE_32';
    public const CASH_REGISTER_SYSTEM_NASOFT_MYCRON_NASOFTKASSADEL_VER62 = 'NASOFT_MYCRON_NASOFTKASSADEL_VER62';
    public const CASH_REGISTER_SYSTEM_NAVIPARTNER_NPRETAIL_2017 = 'NAVIPARTNER_NPRETAIL_2017';
    public const CASH_REGISTER_SYSTEM_NAVIPROAB_CASHJET_2013 = 'NAVIPROAB_CASHJET_2013';
    public const CASH_REGISTER_SYSTEM_NAVIPROAB_CASHJET_IPOS10 = 'NAVIPROAB_CASHJET_IPOS10';
    public const CASH_REGISTER_SYSTEM_NCRDANMARKAS_ASARPOS_304 = 'NCRDANMARKAS_ASARPOS_304';
    public const CASH_REGISTER_SYSTEM_NCRDANMARKAS_NCRALOHAAFM_19 = 'NCRDANMARKAS_NCRALOHAAFM_19';
    public const CASH_REGISTER_SYSTEM_NCRDANMARKAS_OCTANE2000_Z0933 = 'NCRDANMARKAS_OCTANE2000_Z0933';
    public const CASH_REGISTER_SYSTEM_NCRDANMARK_STOREPOINT18104_18104 = 'NCRDANMARK_STOREPOINT18104_18104';
    public const CASH_REGISTER_SYSTEM_NEWBLACKBV_EVAUNIFIEDCOMMERCE_20 = 'NEWBLACKBV_EVAUNIFIEDCOMMERCE_20';
    public const CASH_REGISTER_SYSTEM_NMIRUNEEDGARSVENDSEN_MULTISYSPOS_907 = 'NMIRUNEEDGARSVENDSEN_MULTISYSPOS_907';
    public const CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAPAY_10 = 'NORBITSAS_ATHENAPAY_10';
    public const CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAPOS_30 = 'NORBITSAS_ATHENAPOS_30';
    public const CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAXPOS_10 = 'NORBITSAS_ATHENAXPOS_10';
    public const CASH_REGISTER_SYSTEM_NORDICCINEMAGROUP_BOSS_10 = 'NORDICCINEMAGROUP_BOSS_10';
    public const CASH_REGISTER_SYSTEM_NORENSIKT_JUMPEREZPAD5_S_10 = 'NORENSIKT_JUMPEREZPAD5S_10';
    public const CASH_REGISTER_SYSTEM_NORSKSOLIMPORT_SUNMASTER_SUNMASTER1048 = 'NORSKSOLIMPORT_SUNMASTER_SUNMASTER1048';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3851811281 = 'NUTIDAB_NUTIDPCKASSA_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190221 = 'NUTIDAB_NUTIDPCKASSA_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190528 = 'NUTIDAB_NUTIDPCKASSA_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190911 = 'NUTIDAB_NUTIDPCKASSA_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191002 = 'NUTIDAB_NUTIDPCKASSA_385191002';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3851910021 = 'NUTIDAB_NUTIDPCKASSA_3851910021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191022 = 'NUTIDAB_NUTIDPCKASSA_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191204 = 'NUTIDAB_NUTIDPCKASSA_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852001291 = 'NUTIDAB_NUTIDPCKASSA_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852003021 = 'NUTIDAB_NUTIDPCKASSA_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852005041 = 'NUTIDAB_NUTIDPCKASSA_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852009301 = 'NUTIDAB_NUTIDPCKASSA_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852101271 = 'NUTIDAB_NUTIDPCKASSA_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210127_X = 'NUTIDAB_NUTIDPCKASSA_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210414_X = 'NUTIDAB_NUTIDPCKASSA_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210624_X = 'NUTIDAB_NUTIDPCKASSA_385210624X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851701011 = 'NUTIDAB_SHARPHOSPITALITY_3851701011';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851702141 = 'NUTIDAB_SHARPHOSPITALITY_3851702141';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851704051 = 'NUTIDAB_SHARPHOSPITALITY_3851704051';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851705111 = 'NUTIDAB_SHARPHOSPITALITY_3851705111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851707061 = 'NUTIDAB_SHARPHOSPITALITY_3851707061';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851708161 = 'NUTIDAB_SHARPHOSPITALITY_3851708161';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851709041 = 'NUTIDAB_SHARPHOSPITALITY_3851709041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851710101 = 'NUTIDAB_SHARPHOSPITALITY_3851710101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851711151 = 'NUTIDAB_SHARPHOSPITALITY_3851711151';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851712281 = 'NUTIDAB_SHARPHOSPITALITY_3851712281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851802131 = 'NUTIDAB_SHARPHOSPITALITY_3851802131';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851804111 = 'NUTIDAB_SHARPHOSPITALITY_3851804111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851805221 = 'NUTIDAB_SHARPHOSPITALITY_3851805221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851807091 = 'NUTIDAB_SHARPHOSPITALITY_3851807091';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851807241 = 'NUTIDAB_SHARPHOSPITALITY_3851807241';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851810101 = 'NUTIDAB_SHARPHOSPITALITY_3851810101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851811281 = 'NUTIDAB_SHARPHOSPITALITY_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190221 = 'NUTIDAB_SHARPHOSPITALITY_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190528 = 'NUTIDAB_SHARPHOSPITALITY_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190911 = 'NUTIDAB_SHARPHOSPITALITY_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191002 = 'NUTIDAB_SHARPHOSPITALITY_385191002';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191022 = 'NUTIDAB_SHARPHOSPITALITY_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191204 = 'NUTIDAB_SHARPHOSPITALITY_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852001291 = 'NUTIDAB_SHARPHOSPITALITY_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852003021 = 'NUTIDAB_SHARPHOSPITALITY_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852005021 = 'NUTIDAB_SHARPHOSPITALITY_3852005021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852005041 = 'NUTIDAB_SHARPHOSPITALITY_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852009301 = 'NUTIDAB_SHARPHOSPITALITY_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852101271 = 'NUTIDAB_SHARPHOSPITALITY_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210127_X = 'NUTIDAB_SHARPHOSPITALITY_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210414_X = 'NUTIDAB_SHARPHOSPITALITY_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210624_X = 'NUTIDAB_SHARPHOSPITALITY_385210624X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPMPAYANDROID_110_X = 'NUTIDAB_SHARPMPAYANDROID_110X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851701011 = 'NUTIDAB_SHARPRETAIL_3851701011';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851702141 = 'NUTIDAB_SHARPRETAIL_3851702141';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851704051 = 'NUTIDAB_SHARPRETAIL_3851704051';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851705111 = 'NUTIDAB_SHARPRETAIL_3851705111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851707061 = 'NUTIDAB_SHARPRETAIL_3851707061';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851708161 = 'NUTIDAB_SHARPRETAIL_3851708161';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851709041 = 'NUTIDAB_SHARPRETAIL_3851709041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851710101 = 'NUTIDAB_SHARPRETAIL_3851710101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851711151 = 'NUTIDAB_SHARPRETAIL_3851711151';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851712281 = 'NUTIDAB_SHARPRETAIL_3851712281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851802131 = 'NUTIDAB_SHARPRETAIL_3851802131';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851804111 = 'NUTIDAB_SHARPRETAIL_3851804111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851805221 = 'NUTIDAB_SHARPRETAIL_3851805221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851807091 = 'NUTIDAB_SHARPRETAIL_3851807091';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851807241 = 'NUTIDAB_SHARPRETAIL_3851807241';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851810101 = 'NUTIDAB_SHARPRETAIL_3851810101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851811281 = 'NUTIDAB_SHARPRETAIL_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190221 = 'NUTIDAB_SHARPRETAIL_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190528 = 'NUTIDAB_SHARPRETAIL_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190911 = 'NUTIDAB_SHARPRETAIL_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191002 = 'NUTIDAB_SHARPRETAIL_385191002';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191022 = 'NUTIDAB_SHARPRETAIL_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191204 = 'NUTIDAB_SHARPRETAIL_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852001291 = 'NUTIDAB_SHARPRETAIL_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852003021 = 'NUTIDAB_SHARPRETAIL_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852005041 = 'NUTIDAB_SHARPRETAIL_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852009301 = 'NUTIDAB_SHARPRETAIL_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852101271 = 'NUTIDAB_SHARPRETAIL_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210127_X = 'NUTIDAB_SHARPRETAIL_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210414_X = 'NUTIDAB_SHARPRETAIL_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210624_X = 'NUTIDAB_SHARPRETAIL_385210624X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_10 = 'NUTIDAB_SHARPSTARTANDROID_10';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_101 = 'NUTIDAB_SHARPSTARTANDROID_101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_102 = 'NUTIDAB_SHARPSTARTANDROID_102';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_103 = 'NUTIDAB_SHARPSTARTANDROID_103';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_10_X = 'NUTIDAB_SHARPSTARTANDROID_10X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851701011 = 'NUTIDAB_SHARPSTART_3851701011';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851702141 = 'NUTIDAB_SHARPSTART_3851702141';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851704051 = 'NUTIDAB_SHARPSTART_3851704051';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851705111 = 'NUTIDAB_SHARPSTART_3851705111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851707061 = 'NUTIDAB_SHARPSTART_3851707061';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851708161 = 'NUTIDAB_SHARPSTART_3851708161';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851709041 = 'NUTIDAB_SHARPSTART_3851709041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851710101 = 'NUTIDAB_SHARPSTART_3851710101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851711151 = 'NUTIDAB_SHARPSTART_3851711151';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851712281 = 'NUTIDAB_SHARPSTART_3851712281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851802131 = 'NUTIDAB_SHARPSTART_3851802131';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851804111 = 'NUTIDAB_SHARPSTART_3851804111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851805221 = 'NUTIDAB_SHARPSTART_3851805221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851807091 = 'NUTIDAB_SHARPSTART_3851807091';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851807241 = 'NUTIDAB_SHARPSTART_3851807241';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851810101 = 'NUTIDAB_SHARPSTART_3851810101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851811281 = 'NUTIDAB_SHARPSTART_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190221 = 'NUTIDAB_SHARPSTART_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190528 = 'NUTIDAB_SHARPSTART_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190911 = 'NUTIDAB_SHARPSTART_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191002 = 'NUTIDAB_SHARPSTART_385191002';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191022 = 'NUTIDAB_SHARPSTART_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191204 = 'NUTIDAB_SHARPSTART_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852001291 = 'NUTIDAB_SHARPSTART_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852003021 = 'NUTIDAB_SHARPSTART_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852005041 = 'NUTIDAB_SHARPSTART_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852009301 = 'NUTIDAB_SHARPSTART_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852101271 = 'NUTIDAB_SHARPSTART_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210127_X = 'NUTIDAB_SHARPSTART_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210414_X = 'NUTIDAB_SHARPSTART_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210624_X = 'NUTIDAB_SHARPSTART_385210624X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851701011 = 'NUTIDAB_SHARPSUPERMARKET_3851701011';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851702141 = 'NUTIDAB_SHARPSUPERMARKET_3851702141';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851704051 = 'NUTIDAB_SHARPSUPERMARKET_3851704051';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851705111 = 'NUTIDAB_SHARPSUPERMARKET_3851705111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851707061 = 'NUTIDAB_SHARPSUPERMARKET_3851707061';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851708161 = 'NUTIDAB_SHARPSUPERMARKET_3851708161';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851709041 = 'NUTIDAB_SHARPSUPERMARKET_3851709041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851710101 = 'NUTIDAB_SHARPSUPERMARKET_3851710101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851711151 = 'NUTIDAB_SHARPSUPERMARKET_3851711151';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851712281 = 'NUTIDAB_SHARPSUPERMARKET_3851712281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851802131 = 'NUTIDAB_SHARPSUPERMARKET_3851802131';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851804111 = 'NUTIDAB_SHARPSUPERMARKET_3851804111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851805221 = 'NUTIDAB_SHARPSUPERMARKET_3851805221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851807091 = 'NUTIDAB_SHARPSUPERMARKET_3851807091';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851807241 = 'NUTIDAB_SHARPSUPERMARKET_3851807241';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851810101 = 'NUTIDAB_SHARPSUPERMARKET_3851810101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851811281 = 'NUTIDAB_SHARPSUPERMARKET_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190221 = 'NUTIDAB_SHARPSUPERMARKET_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190528 = 'NUTIDAB_SHARPSUPERMARKET_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190911 = 'NUTIDAB_SHARPSUPERMARKET_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851910021 = 'NUTIDAB_SHARPSUPERMARKET_3851910021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385191022 = 'NUTIDAB_SHARPSUPERMARKET_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385191204 = 'NUTIDAB_SHARPSUPERMARKET_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852001291 = 'NUTIDAB_SHARPSUPERMARKET_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852003021 = 'NUTIDAB_SHARPSUPERMARKET_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852005041 = 'NUTIDAB_SHARPSUPERMARKET_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852009301 = 'NUTIDAB_SHARPSUPERMARKET_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852101271 = 'NUTIDAB_SHARPSUPERMARKET_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210127_X = 'NUTIDAB_SHARPSUPERMARKET_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210414_X = 'NUTIDAB_SHARPSUPERMARKET_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210624_X = 'NUTIDAB_SHARPSUPERMARKET_385210624X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851701011 = 'NUTIDAB_SHARPWELLNESS_3851701011';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851702141 = 'NUTIDAB_SHARPWELLNESS_3851702141';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851704051 = 'NUTIDAB_SHARPWELLNESS_3851704051';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851705111 = 'NUTIDAB_SHARPWELLNESS_3851705111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851707061 = 'NUTIDAB_SHARPWELLNESS_3851707061';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851708161 = 'NUTIDAB_SHARPWELLNESS_3851708161';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851709041 = 'NUTIDAB_SHARPWELLNESS_3851709041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851710101 = 'NUTIDAB_SHARPWELLNESS_3851710101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851711151 = 'NUTIDAB_SHARPWELLNESS_3851711151';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851712281 = 'NUTIDAB_SHARPWELLNESS_3851712281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851802131 = 'NUTIDAB_SHARPWELLNESS_3851802131';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851804111 = 'NUTIDAB_SHARPWELLNESS_3851804111';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851805221 = 'NUTIDAB_SHARPWELLNESS_3851805221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851807091 = 'NUTIDAB_SHARPWELLNESS_3851807091';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851807241 = 'NUTIDAB_SHARPWELLNESS_3851807241';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851810101 = 'NUTIDAB_SHARPWELLNESS_3851810101';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851811281 = 'NUTIDAB_SHARPWELLNESS_3851811281';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190221 = 'NUTIDAB_SHARPWELLNESS_385190221';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190528 = 'NUTIDAB_SHARPWELLNESS_385190528';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190911 = 'NUTIDAB_SHARPWELLNESS_385190911';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191002 = 'NUTIDAB_SHARPWELLNESS_385191002';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191022 = 'NUTIDAB_SHARPWELLNESS_385191022';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191204 = 'NUTIDAB_SHARPWELLNESS_385191204';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852001291 = 'NUTIDAB_SHARPWELLNESS_3852001291';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852003021 = 'NUTIDAB_SHARPWELLNESS_3852003021';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852005041 = 'NUTIDAB_SHARPWELLNESS_3852005041';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852009301 = 'NUTIDAB_SHARPWELLNESS_3852009301';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852101271 = 'NUTIDAB_SHARPWELLNESS_3852101271';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210127_X = 'NUTIDAB_SHARPWELLNESS_385210127X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210414_X = 'NUTIDAB_SHARPWELLNESS_385210414X';
    public const CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210624_X = 'NUTIDAB_SHARPWELLNESS_385210624X';
    public const CASH_REGISTER_SYSTEM_ODINSYSTEMERAS_FIXIT_3426 = 'ODINSYSTEMERAS_FIXIT_3426';
    public const CASH_REGISTER_SYSTEM_ODINSYSTEMERAS_FIXIT_35_X = 'ODINSYSTEMERAS_FIXIT_35X';
    public const CASH_REGISTER_SYSTEM_OFFICELINKAS_FRONTLINE_40 = 'OFFICELINKAS_FRONTLINE_40';
    public const CASH_REGISTER_SYSTEM_OLYMPIAGOEUROPEGMBH_OLYMPIA_CM911 = 'OLYMPIAGOEUROPEGMBH_OLYMPIA_CM911';
    public const CASH_REGISTER_SYSTEM_OMDATAAS_ORC_10 = 'OMDATAAS_ORC_10';
    public const CASH_REGISTER_SYSTEM_OMEGAPSAS_PIMSKASSE_10 = 'OMEGAPSAS_PIMSKASSE_10';
    public const CASH_REGISTER_SYSTEM_ONLINEEDBAS_EXCELINE_2000 = 'ONLINEEDBAS_EXCELINE_2000';
    public const CASH_REGISTER_SYSTEM_ONLINEPOS_ALLINONE_1 = 'ONLINEPOS_ALLINONE_1';
    public const CASH_REGISTER_SYSTEM_OPENSOLUTIONNORWAYAS_OPENSOLUTIONRETAILSYSTEM_40 = 'OPENSOLUTIONNORWAYAS_OPENSOLUTIONRETAILSYSTEM_40';
    public const CASH_REGISTER_SYSTEM_OPENSOLUTIONNORWAYAS_OPENVENUE_20 = 'OPENSOLUTIONNORWAYAS_OPENVENUE_20';
    public const CASH_REGISTER_SYSTEM_ORACLE_SIMPHONY_29 = 'ORACLE_SIMPHONY_29';
    public const CASH_REGISTER_SYSTEM_ORACLE_SIMPHONY_29_ANDLATER = 'ORACLE_SIMPHONY_29ANDLATER';
    public const CASH_REGISTER_SYSTEM_ORDERXAS_ORDERXMPOS_10 = 'ORDERXAS_ORDERXMPOS_10';
    public const CASH_REGISTER_SYSTEM_ORDRAS_1000_1 = 'ORDRAS_1000_1';
    public const CASH_REGISTER_SYSTEM_PALISIS_PIDION_4_X = 'PALISIS_PIDION_4X';
    public const CASH_REGISTER_SYSTEM_PASTELLDATAAB_PROFIT10_NO_88 = 'PASTELLDATAAB_PROFIT10NO_88';
    public const CASH_REGISTER_SYSTEM_PCKASSE_PCK_3 = 'PCKASSE_PCK_3';
    public const CASH_REGISTER_SYSTEM_PCKAS_COMPLETEPOS_4 = 'PCKAS_COMPLETEPOS_4';
    public const CASH_REGISTER_SYSTEM_PCKAS_COMPLETEPOS_40 = 'PCKAS_COMPLETEPOS_40';
    public const CASH_REGISTER_SYSTEM_PCKAS_ERPPOS_15_XXXX = 'PCKAS_ERPPOS_15XXXX';
    public const CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_31 = 'PCKAS_PCKASSE_31';
    public const CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_3158 = 'PCKAS_PCKASSE_3158';
    public const CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_VER3_X = 'PCKAS_PCKASSE_VER3X';
    public const CASH_REGISTER_SYSTEM_PCKNO_PCKASSE_3158 = 'PCKNO_PCKASSE_3158';
    public const CASH_REGISTER_SYSTEM_PENGVINAFFARSSYSTEMAB_PENGVIN_4262 = 'PENGVINAFFARSSYSTEMAB_PENGVIN_4262';
    public const CASH_REGISTER_SYSTEM_PERFECTITBEXAB_BEXPOS_3_XX = 'PERFECTITBEXAB_BEXPOS_3XX';
    public const CASH_REGISTER_SYSTEM_PILAROAS_PILAROPROPOS_3 = 'PILAROAS_PILAROPROPOS_3';
    public const CASH_REGISTER_SYSTEM_PINCHONATIONAB_CASHIERCLOUD_100 = 'PINCHONATIONAB_CASHIERCLOUD_100';
    public const CASH_REGISTER_SYSTEM_PLUTOSYSTEMSAB_PLUTO1024_K0427_OGNYERE = 'PLUTOSYSTEMSAB_PLUTO1024_K0427OGNYERE';
    public const CASH_REGISTER_SYSTEM_POINTSOFTSCANDINAVIAAS_POINTSOFT_2701961 = 'POINTSOFTSCANDINAVIAAS_POINTSOFT_2701961';
    public const CASH_REGISTER_SYSTEM_POLYGONCOMMUNICATIONSAS_PRSPOS_214 = 'POLYGONCOMMUNICATIONSAS_PRSPOS_214';
    public const CASH_REGISTER_SYSTEM_POSONEA_S_POSONE_POSONE4 = 'POSONEA_S_POSONE_POSONE4';
    public const CASH_REGISTER_SYSTEM_POWEREDBYYONOTONOY_POWEREDBYYONOTONPOS_10 = 'POWEREDBYYONOTONOY_POWEREDBYYONOTONPOS_10';
    public const CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V20 = 'PRESSISCONSULTINGAS_PRESSISPOS_V20';
    public const CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V5030 = 'PRESSISCONSULTINGAS_PRESSISPOS_V5030';
    public const CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V5220 = 'PRESSISCONSULTINGAS_PRESSISPOS_V5220';
    public const CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V6001 = 'PRESSISCONSULTINGAS_PRESSISPOS_V6001';
    public const CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V7002 = 'PRESSISCONSULTINGAS_PRESSISPOS_V7002';
    public const CASH_REGISTER_SYSTEM_PROFITIMPACTNORGEAS_PIMS_100 = 'PROFITIMPACTNORGEAS_PIMS_100';
    public const CASH_REGISTER_SYSTEM_PROFITIMPACTNORGEAS_RESERVATOR_100 = 'PROFITIMPACTNORGEAS_RESERVATOR_100';
    public const CASH_REGISTER_SYSTEM_PROOPTICSAS_HEADSOPTICS_1 = 'PROOPTICSAS_HEADSOPTICS_1';
    public const CASH_REGISTER_SYSTEM_PROVENDO_ODOO_11 = 'PROVENDO_ODOO_11';
    public const CASH_REGISTER_SYSTEM_PULSENRETAILAB_HARMONEY_35_XX = 'PULSENRETAILAB_HARMONEY_35XX';
    public const CASH_REGISTER_SYSTEM_PUNTOFASL_EJOURNALNOR_2018111 = 'PUNTOFASL_EJOURNALNOR_2018111';
    public const CASH_REGISTER_SYSTEM_QUADRIGAAB_EUROSHOP_2018 = 'QUADRIGAAB_EUROSHOP_2018';
    public const CASH_REGISTER_SYSTEM_QUICKORDERAPS_QUICKPOS_251 = 'QUICKORDERAPS_QUICKPOS_251';
    public const CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_Q3_30240 = 'QUICKSYSYTEMSAS_Q3_30240';
    public const CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_Q3_30_X = 'QUICKSYSYTEMSAS_Q3_30X';
    public const CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_QUICKNG_2089 = 'QUICKSYSYTEMSAS_QUICKNG_2089';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR18_G3180822_NO = 'QUORIONDATASYSTEMSGMBH_CR18_G3180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR21_B_G1170615_NO = 'QUORIONDATASYSTEMSGMBH_CR21B_G1170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR50_170601_NO = 'QUORIONDATASYSTEMSGMBH_CR50_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP18_G3180822_NO = 'QUORIONDATASYSTEMSGMBH_QMP18_G3180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP18_QA180822_NO = 'QUORIONDATASYSTEMSGMBH_QMP18_QA180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_170601_NO = 'QUORIONDATASYSTEMSGMBH_QMP2044_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_H4170615_NO = 'QUORIONDATASYSTEMSGMBH_QMP2044_H4170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_H4180822_NO = 'QUORIONDATASYSTEMSGMBH_QMP2044_H4180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_170601_NO = 'QUORIONDATASYSTEMSGMBH_QMP2264_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_H4170615_NO = 'QUORIONDATASYSTEMSGMBH_QMP2264_H4170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_H4180822_NO = 'QUORIONDATASYSTEMSGMBH_QMP2264_H4180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP50_G1170615_NO = 'QUORIONDATASYSTEMSGMBH_QMP50_G1170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP50_H1180822_NO = 'QUORIONDATASYSTEMSGMBH_QMP50_H1180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170215_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170215NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170615_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA180822_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH10_QA180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_170601_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH12_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_QA170615_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH12_QA170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_QA180822_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH12_QA180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_170601_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH15_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_QA170615_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH15_QA170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_QA180822_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH15_QA180822NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_170601_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH8_170601NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_QB170615_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH8_QB170615NO';
    public const CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_QB180822_NO = 'QUORIONDATASYSTEMSGMBH_QTOUCH8_QB180822NO';
    public const CASH_REGISTER_SYSTEM_RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_1 = 'RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_1';
    public const CASH_REGISTER_SYSTEM_RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_2 = 'RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_2';
    public const CASH_REGISTER_SYSTEM_RDISOFTWAREACAPGEMINICOMPANYT_NP61_SLE141_FMNP6130_MR5_QR0_HF0_K517_MR2_HF25 = 'RDISOFTWAREACAPGEMINICOMPANYT_NP61_SLE141FMNP6130MR5QR0HF0K517MR2HF25';
    public const CASH_REGISTER_SYSTEM_RDISOFTWAREACAPGEMINICOMPANY_NP61_SLE145_ELLERNYERE = 'RDISOFTWAREACAPGEMINICOMPANY_NP61_SLE145ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_RDISOFTWARE_NP61_2021_Q2_HF5_NP613010_QR1_HF151_K5176_QR4_HF9_SLE445 = 'RDISOFTWARE_NP61_2021Q2HF5_NP613010QR1HF151K5176QR4HF9SLE445';
    public const CASH_REGISTER_SYSTEM_REDROCKSOLUTIONSAS_TOGITALPOS_V286 = 'REDROCKSOLUTIONSAS_TOGITALPOS_V286';
    public const CASH_REGISTER_SYSTEM_REKNESAS_REKNESWMS_154_X = 'REKNESAS_REKNESWMS_154X';
    public const CASH_REGISTER_SYSTEM_RESPONSERETAILAS_MANDARIN_442 = 'RESPONSERETAILAS_MANDARIN_442';
    public const CASH_REGISTER_SYSTEM_RETAILPLANITAS_OPTITECRS_16271 = 'RETAILPLANITAS_OPTITECRS_16271';
    public const CASH_REGISTER_SYSTEM_RETAILPLANITNORGEAS_OPTIMALTILL_OPTIMALKASSE_16351_OGNYERE = 'RETAILPLANITNORGEAS_OPTIMALTILL_OPTIMALKASSE_16351OGNYERE';
    public const CASH_REGISTER_SYSTEM_RETAILPROINTERNATIONALLLC_PRISMNO_1_XXXX = 'RETAILPROINTERNATIONALLLC_PRISMNO_1XXXX';
    public const CASH_REGISTER_SYSTEM_RETAILPROINTERNATIONALLLC_RETAILPROVERSION86_860 = 'RETAILPROINTERNATIONALLLC_RETAILPROVERSION86_860';
    public const CASH_REGISTER_SYSTEM_SALDIDKAPS_GERNERSPOS_1 = 'SALDIDKAPS_GERNERSPOS_1';
    public const CASH_REGISTER_SYSTEM_SCALEITAS_SCALEITPOS_10 = 'SCALEITAS_SCALEITPOS_10';
    public const CASH_REGISTER_SYSTEM_SEATGEEK_SRO_4221_OGNYERE = 'SEATGEEK_SRO_4221OGNYERE';
    public const CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER230_EJ_NOR04000 = 'SHINHEUNGPRECISIONCOLTD_SAM4SER230EJ_NOR04000';
    public const CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER260_EJ_NOR04000 = 'SHINHEUNGPRECISIONCOLTD_SAM4SER260EJ_NOR04000';
    public const CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER265_EJ_NOR04000 = 'SHINHEUNGPRECISIONCOLTD_SAM4SER265EJ_NOR04000';
    public const CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER510_BSE_NOR04000 = 'SHINHEUNGPRECISIONCOLTD_SAM4SER510BSE_NOR04000';
    public const CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SNR500_NOR04000 = 'SHINHEUNGPRECISIONCOLTD_SAM4SNR500_NOR04000';
    public const CASH_REGISTER_SYSTEM_SHOEDVISIONAMBA_SHOESHOP_3161 = 'SHOEDVISIONAMBA_SHOESHOP_3161';
    public const CASH_REGISTER_SYSTEM_SHOPBOXAPS_SHOPBOX_16_X = 'SHOPBOXAPS_SHOPBOX_16X';
    public const CASH_REGISTER_SYSTEM_SHOPLABSAS_SHOPLABS_160 = 'SHOPLABSAS_SHOPLABS_160';
    public const CASH_REGISTER_SYSTEM_SIAIBSC_COMPANY_RESICO_40 = 'SIAIBSC_COMPANY_RESICO_40';
    public const CASH_REGISTER_SYSTEM_SITOO_SITOOPOS_1_X = 'SITOO_SITOOPOS_1X';
    public const CASH_REGISTER_SYSTEM_SKIBARSYSTEMSAB_SKIBARV2_CASHIER_09100 = 'SKIBARSYSTEMSAB_SKIBARV2CASHIER_09100';
    public const CASH_REGISTER_SYSTEM_SKIDATASCANDINAVIAAB_SUMMITLOGIC_26 = 'SKIDATASCANDINAVIAAB_SUMMITLOGIC_26';
    public const CASH_REGISTER_SYSTEM_SKISTARAB_SORENPOS_446151_OCHSENARE = 'SKISTARAB_SORENPOS_446151OCHSENARE';
    public const CASH_REGISTER_SYSTEM_SMARTIPOS_APP_10 = 'SMARTIPOS_APP_10';
    public const CASH_REGISTER_SYSTEM_SMARTLAUNDRYAS_SMARTIPOS_100 = 'SMARTLAUNDRYAS_SMARTIPOS_100';
    public const CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_595_NO = 'SMSAS_RMSV_IDNR151190_595NO';
    public const CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_RMSV592_NO = 'SMSAS_RMSV_IDNR151190_RMSV592NO';
    public const CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_RMSV59_NO = 'SMSAS_RMSV_IDNR151190_RMSV59NO';
    public const CASH_REGISTER_SYSTEM_SODVINSYSTEMERAS_XAKTMEDLEMBUTIKK_20181201_ELLERNYERE = 'SODVINSYSTEMERAS_XAKTMEDLEMBUTIKK_20181201ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_SODVINSYSTEMERAS_XAKTMEDLEM_20181201_ELLERNYERE = 'SODVINSYSTEMERAS_XAKTMEDLEM_20181201ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_314 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_314';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_332 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_332';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_335 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_335';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_3351 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_3351';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_340 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_340';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_341 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_341';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_342 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_342';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_343 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_343';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_344 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_344';
    public const CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_346 = 'SPECSAVERSORACLERETAILJAVA_OPTICUS_346';
    public const CASH_REGISTER_SYSTEM_SPECTERAB_SPECTERPOS_3_XX = 'SPECTERAB_SPECTERPOS_3XX';
    public const CASH_REGISTER_SYSTEM_STAMFORDAB_ECSBUTIKSDATA_62031_OCHSENARE = 'STAMFORDAB_ECSBUTIKSDATA_62031OCHSENARE';
    public const CASH_REGISTER_SYSTEM_SUNMITECHNOLOGYCOLTD_OLIVERPOS_2388 = 'SUNMITECHNOLOGYCOLTD_OLIVERPOS_2388';
    public const CASH_REGISTER_SYSTEM_SUSOFT_APOS_11 = 'SUSOFT_APOS_11';
    public const CASH_REGISTER_SYSTEM_SVERIGEKASSANAB_NORPOS_A02 = 'SVERIGEKASSANAB_NORPOS_A02';
    public const CASH_REGISTER_SYSTEM_SYNSAMGROUPSWEDENAB_EYELIFE_30 = 'SYNSAMGROUPSWEDENAB_EYELIFE_30';
    public const CASH_REGISTER_SYSTEM_TAILORMOADEAPS_TAILORSOFT_2913902 = 'TAILORMOADEAPS_TAILORSOFT_2913902';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_1130 = 'TELLIXAS_PROTOUCH_1130';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_12_X = 'TELLIXAS_PROTOUCH_12X';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_13_X = 'TELLIXAS_PROTOUCH_13X';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_14_X = 'TELLIXAS_PROTOUCH_14X';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_15_X = 'TELLIXAS_PROTOUCH_15X';
    public const CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_16_X = 'TELLIXAS_PROTOUCH_16X';
    public const CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_166_ANDROID = 'TICKETCOAS_TICKETCOADMIN_166ANDROID';
    public const CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_180_ANDROID = 'TICKETCOAS_TICKETCOADMIN_180ANDROID';
    public const CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_3200_IOS = 'TICKETCOAS_TICKETCOADMIN_3200IOS';
    public const CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_3210_IOS = 'TICKETCOAS_TICKETCOADMIN_3210IOS';
    public const CASH_REGISTER_SYSTEM_TICKETINTERNATIONALSOFTWARETRADINGGMBH_COKG_DOLPHIN_81300 = 'TICKETINTERNATIONALSOFTWARETRADINGGMBH_COKG_DOLPHIN_81300';
    public const CASH_REGISTER_SYSTEM_TICKSTERAB_TICKSTERBLINKPOS_21_X = 'TICKSTERAB_TICKSTERBLINKPOS_21X';
    public const CASH_REGISTER_SYSTEM_TICKSTERAB_TICKSTERBLINKPOS_22_X = 'TICKSTERAB_TICKSTERBLINKPOS_22X';
    public const CASH_REGISTER_SYSTEM_TIDYPOSAS_POCKETERP_TIDYPAY_217 = 'TIDYPOSAS_POCKETERP_TIDYPAY_217';
    public const CASH_REGISTER_SYSTEM_TIMEKIOSKAS_TIMEKIOSKPOS_52 = 'TIMEKIOSKAS_TIMEKIOSKPOS_52';
    public const CASH_REGISTER_SYSTEM_TIMMAOY_TIMMABUSINESS_1 = 'TIMMAOY_TIMMABUSINESS_1';
    public const CASH_REGISTER_SYSTEM_TIMMAOY_TIMMABUSINESS_1200 = 'TIMMAOY_TIMMABUSINESS_1200';
    public const CASH_REGISTER_SYSTEM_TIXAS_BOTIXNO_2019 = 'TIXAS_BOTIXNO_2019';
    public const CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR46 = 'TOKHEIMBELGIUMNV_FUELPOS_EUR46';
    public const CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR49 = 'TOKHEIMBELGIUMNV_FUELPOS_EUR49';
    public const CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR52 = 'TOKHEIMBELGIUMNV_FUELPOS_EUR52';
    public const CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_2381 = 'TOUCHSOFTAS_TOUCHSOFTPOS_2381';
    public const CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_32 = 'TOUCHSOFTAS_TOUCHSOFTPOS_32';
    public const CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_32_XX = 'TOUCHSOFTAS_TOUCHSOFTPOS_32XX';
    public const CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_33_XX = 'TOUCHSOFTAS_TOUCHSOFTPOS_33XX';
    public const CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_4_XX = 'TOUCHSOFTAS_TOUCHSOFTPOS_4XX';
    public const CASH_REGISTER_SYSTEM_TRIVECSYSTEMSAS_DOMINONO_385 = 'TRIVECSYSTEMSAS_DOMINONO_385';
    public const CASH_REGISTER_SYSTEM_TRIVECSYSTEMSAS_DOMINONO_4_XXXX = 'TRIVECSYSTEMSAS_DOMINONO_4XXXX';
    public const CASH_REGISTER_SYSTEM_TURNITOU_TURNITRIDE_31 = 'TURNITOU_TURNITRIDE_31';
    public const CASH_REGISTER_SYSTEM_UNIKUMDATASYSTEMAB_PYRAMIDBUSINESSSTUDIOS_342 = 'UNIKUMDATASYSTEMAB_PYRAMIDBUSINESSSTUDIOS_342';
    public const CASH_REGISTER_SYSTEM_UNIMICROAS_UNIOEKONOMIV3_366_XXX = 'UNIMICROAS_UNIOEKONOMIV3_366XXX';
    public const CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_623 = 'UNIPOSAS_BUTIKKDATA_623';
    public const CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_7_X = 'UNIPOSAS_BUTIKKDATA_7X';
    public const CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_8_X = 'UNIPOSAS_BUTIKKDATA_8X';
    public const CASH_REGISTER_SYSTEM_UNIPOSAS_SMARTKASSE_10 = 'UNIPOSAS_SMARTKASSE_10';
    public const CASH_REGISTER_SYSTEM_UNIPOSAS_SMARTKASSE_2_X = 'UNIPOSAS_SMARTKASSE_2X';
    public const CASH_REGISTER_SYSTEM_VANGSOFTWARE_VANGSOFTWARE_VASO22 = 'VANGSOFTWARE_VANGSOFTWARE_VASO22';
    public const CASH_REGISTER_SYSTEM_VECTRONSYSTEMAG_VECTRONPOS_5_X = 'VECTRONSYSTEMAG_VECTRONPOS_5X';
    public const CASH_REGISTER_SYSTEM_VECTRON_VECTRONPOSTOUCH_600 = 'VECTRON_VECTRONPOSTOUCH_600';
    public const CASH_REGISTER_SYSTEM_VERENDUSSYSTEMAB_VERENDUSBUTIKK_11 = 'VERENDUSSYSTEMAB_VERENDUSBUTIKK_11';
    public const CASH_REGISTER_SYSTEM_VESTSYSTEMPARTNERAS_VSPMILJOE_30 = 'VESTSYSTEMPARTNERAS_VSPMILJOE_30';
    public const CASH_REGISTER_SYSTEM_VESTSYSTEMPARTNER_APOS_30 = 'VESTSYSTEMPARTNER_APOS_30';
    public const CASH_REGISTER_SYSTEM_VETSERVEAS_VETSERVECLASSIC_1187_ELLERNYERE = 'VETSERVEAS_VETSERVECLASSIC_1187ELLERNYERE';
    public const CASH_REGISTER_SYSTEM_VISBOOKAS_VISBOOK_7_X = 'VISBOOKAS_VISBOOK_7X';
    public const CASH_REGISTER_SYSTEM_VISMARETAILAS_WALLMOBPOS_217_PLUSS = 'VISMARETAILAS_WALLMOBPOS_217PLUSS';
    public const CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_162_SP1 = 'VISMARETAILSOFTWAREAS_SILENTTOUCH_162SP1';
    public const CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_171 = 'VISMARETAILSOFTWAREAS_SILENTTOUCH_171';
    public const CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_172 = 'VISMARETAILSOFTWAREAS_SILENTTOUCH_172';
    public const CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_181 = 'VISMARETAILSOFTWAREAS_SILENTTOUCH_181';
    public const CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SUPERPOS_1721 = 'VISMARETAILSOFTWAREAS_SUPERPOS_1721';
    public const CASH_REGISTER_SYSTEM_VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_12_X = 'VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_12X';
    public const CASH_REGISTER_SYSTEM_VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_13000 = 'VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_13000';
    public const CASH_REGISTER_SYSTEM_VISMASOFTWARELABSAS_VISMAENTERPRISEKASSEPLUS_20202 = 'VISMASOFTWARELABSAS_VISMAENTERPRISEKASSEPLUS_20202';
    public const CASH_REGISTER_SYSTEM_VISMASOFTWARELABSAS_VISMAENTERPRISEKASSE_20202 = 'VISMASOFTWARELABSAS_VISMAENTERPRISEKASSE_20202';
    public const CASH_REGISTER_SYSTEM_VITECAUTODATAAS_ADKASSE_1001 = 'VITECAUTODATAAS_ADKASSE_1001';
    public const CASH_REGISTER_SYSTEM_VITECFIXITSYSTEMERAS_FIXIT_35_X = 'VITECFIXITSYSTEMERAS_FIXIT_35X';
    public const CASH_REGISTER_SYSTEM_VITECINFOEASYAS_PCKASSE_10218 = 'VITECINFOEASYAS_PCKASSE_10218';
    public const CASH_REGISTER_SYSTEM_VITECSMARTVISITORSYSTEMAB_DK5000_3110 = 'VITECSMARTVISITORSYSTEMAB_DK5000_3110';
    public const CASH_REGISTER_SYSTEM_WINPOSGROUP_WINPOSMEGASTORE_30 = 'WINPOSGROUP_WINPOSMEGASTORE_30';
    public const CASH_REGISTER_SYSTEM_WINSOLUTIONAS_2021_10 = 'WINSOLUTIONAS_2021_10';
    public const CASH_REGISTER_SYSTEM_WINTERSTEIGERAG_EASYRENT_17 = 'WINTERSTEIGERAG_EASYRENT_17';
    public const CASH_REGISTER_SYSTEM_WLCOMAS_BUILD103_2018310245 = 'WLCOMAS_BUILD103_2018310245';
    public const CASH_REGISTER_SYSTEM_WSAELECTRONICGMBH_TICKETLINE_72_XOGNYERE = 'WSAELECTRONICGMBH_TICKETLINE_72XOGNYERE';
    public const CASH_REGISTER_SYSTEM_WTWAS_LINEFARE_10 = 'WTWAS_LINEFARE_10';
    public const CASH_REGISTER_SYSTEM_ZIRIUSAS_ZIRIUSKASSE_35 = 'ZIRIUSAS_ZIRIUSKASSE_35';
    public const CASH_REGISTER_SYSTEM_ANNET_KASSASYSTEM = 'ANNET_KASSASYSTEM';

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
    public function getCashRegisterSystemAllowableValues()
    {
        return [
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11240,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11250,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11260,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11270,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113110,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113170,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113250,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113290,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113300,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113310,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113320,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_113330,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116110,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116170,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_116200,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11670,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_117110,
            self::CASH_REGISTER_SYSTEM_ABLINDEX_EVERESTBYLINDEX_11740,
            self::CASH_REGISTER_SYSTEM_AJOURNORDICAPS_AJOUR_SOFTWAREBESTEMT_70,
            self::CASH_REGISTER_SYSTEM_AJOURNORDIC_NORGEAS_AJOUR_2,
            self::CASH_REGISTER_SYSTEM_AKTECHOTELAS_PICASSO_83,
            self::CASH_REGISTER_SYSTEM_AKTSIASELTSHELMES_HELMESPOS_101,
            self::CASH_REGISTER_SYSTEM_ALFAGRUPPENAS_ALFAKASSE_V10,
            self::CASH_REGISTER_SYSTEM_ALFASOFTWAREAS_ROLFPOS_701,
            self::CASH_REGISTER_SYSTEM_ALREADYORDEREDAS_MOBILE04_31,
            self::CASH_REGISTER_SYSTEM_AMICABUSINESSSOLUTIONS_TENDERPOS_13000,
            self::CASH_REGISTER_SYSTEM_ANCONAB_SHARPDININGNO_10,
            self::CASH_REGISTER_SYSTEM_APPEXAS_MANITSYS_010,
            self::CASH_REGISTER_SYSTEM_ARANTEK_ARANTEK_74_XX,
            self::CASH_REGISTER_SYSTEM_ARANTEK_ARANTEK_75_XX,
            self::CASH_REGISTER_SYSTEM_ARANTEK_PAYONE_7_XXX,
            self::CASH_REGISTER_SYSTEM_ARANTEK_S8_RPOS_75_XX,
            self::CASH_REGISTER_SYSTEM_ARANTEK_TOPTOUCH_75_XX,
            self::CASH_REGISTER_SYSTEM_ARKOTERAPEUT_WINDOWS_5_XX,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ACE130_V1103,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFA460_491_V1103,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFA470_V1103,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AFR4_V1103,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_AMR172_V323,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ASTS_V123,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_ATRIES_256,
            self::CASH_REGISTER_SYSTEM_ATRONELECTRONICGMBH_FRTOUCH_V1101,
            self::CASH_REGISTER_SYSTEM_AVIONORWAYAS_AVIOMOBILEPOS_30,
            self::CASH_REGISTER_SYSTEM_AVIONORWAYAS_AVIOPOS_31,
            self::CASH_REGISTER_SYSTEM_AXESSAG_SMARTPOS_121,
            self::CASH_REGISTER_SYSTEM_B2_BTRADING_MICROPOS,
            self::CASH_REGISTER_SYSTEM_BAIKINGUAS_BAIKINGUFOOD_BEVERAGE_ANDROID112,
            self::CASH_REGISTER_SYSTEM_BAIKINGUAS_RETAILCLOUD_20181,
            self::CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_401,
            self::CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_402,
            self::CASH_REGISTER_SYSTEM_BESTVALUEAS_HANDELIPRAKSIS_403,
            self::CASH_REGISTER_SYSTEM_BESTVALUEAS_HIPSELVBETJENT_101,
            self::CASH_REGISTER_SYSTEM_BIESBROECKAUTOMATIONBV_UNITOUCH_370,
            self::CASH_REGISTER_SYSTEM_BIESBROECKAUTOMATIONBV_UNITOUCH_370_ELLERNYEREVERSJON,
            self::CASH_REGISTER_SYSTEM_BITMAKERAS_FYSIOPILATESKASSE_10,
            self::CASH_REGISTER_SYSTEM_BIZSYSAPS_BIZSYSPOS_2019,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_75,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_76,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_77,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_78,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_79,
            self::CASH_REGISTER_SYSTEM_BLEKENDATAAS_MABBUTIKKOGVERKSTEDSYSTEM_8,
            self::CASH_REGISTER_SYSTEM_BOOKNOWSOFTWARELTD_V200_200182,
            self::CASH_REGISTER_SYSTEM_BOOSTITAS_CML2020_R2100,
            self::CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRPSYSTEMSPOSNO_10,
            self::CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRPSYSTEMSPOSNO_11,
            self::CASH_REGISTER_SYSTEM_BRPSYSTEMSAB_BRP_251,
            self::CASH_REGISTER_SYSTEM_CAGISTAAS_CAGISTAPOS_1_X,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_520,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_A,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_B,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_521_RC2,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_522,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_523,
            self::CASH_REGISTER_SYSTEM_CAPGEMININORGEAS_FARMAPRO_524,
            self::CASH_REGISTER_SYSTEM_CASHITAB_CASHITRETAILMOBILE_34_XX,
            self::CASH_REGISTER_SYSTEM_CASHITAB_CASHITRETAIL_34_XX,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_102,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_103,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC3500_109,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_102,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_103,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSEC450_109,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_102,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_103,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES3000_109,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_M_STORSKUFF_103,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_M_STORSKUFF_109,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOSES400_STORSKUFF_102,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOVR100_108,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOVR200_108,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOVR7000_108,
            self::CASH_REGISTER_SYSTEM_CASIO_CASIOVR7100_108,
            self::CASH_REGISTER_SYSTEM_CASIO_SEC3500_101,
            self::CASH_REGISTER_SYSTEM_CASIO_SEC450_101,
            self::CASH_REGISTER_SYSTEM_CASIO_SES3000_101,
            self::CASH_REGISTER_SYSTEM_CASIO_SES400_M_STORSKUFF_101,
            self::CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR200_116,
            self::CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR7000_116,
            self::CASH_REGISTER_SYSTEM_CASIO_SUSOFT_CASIOVR7100_116,
            self::CASH_REGISTER_SYSTEM_CASIO_VR100_108,
            self::CASH_REGISTER_SYSTEM_CASIO_VR200_108,
            self::CASH_REGISTER_SYSTEM_CASIO_VR7000_108,
            self::CASH_REGISTER_SYSTEM_CASIO_VR7100_108,
            self::CASH_REGISTER_SYSTEM_CASPECOAB_CASPECOCHECKOUT_30,
            self::CASH_REGISTER_SYSTEM_CATENOAS_CLAWPOS_2_X,
            self::CASH_REGISTER_SYSTEM_CATENOAS_CPOS_1_X,
            self::CASH_REGISTER_SYSTEM_CBITAS_WELLNESS_1,
            self::CASH_REGISTER_SYSTEM_CDKGLOBAL_DRACAR_070900,
            self::CASH_REGISTER_SYSTEM_CEGID_Y2_2016_EDITION,
            self::CASH_REGISTER_SYSTEM_CEGID_Y2_V13_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_CENIUMAS_HOSPITALITYPOINTOFSALE_1_XXX,
            self::CASH_REGISTER_SYSTEM_CENTRICNETHERLANDSBV_CENTRICDYNAVISION_2016,
            self::CASH_REGISTER_SYSTEM_CENTRICNETHERLANDSBV_CENTRICINPOSITION_2017,
            self::CASH_REGISTER_SYSTEM_CENTRIC_DYNAVISION_4224001,
            self::CASH_REGISTER_SYSTEM_CHD_CHD6800_MINIPOS_2260,
            self::CASH_REGISTER_SYSTEM_CHECKINAS_KASSAWEB_10,
            self::CASH_REGISTER_SYSTEM_CINCHAS_CINCHPAY_1,
            self::CASH_REGISTER_SYSTEM_CLOUDRETAILSYSTEMSA_S_CBRETAIL_53,
            self::CASH_REGISTER_SYSTEM_CLOUDRETAILSYSTEMSA_S_CBRETAIL_64070_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_CODAB_G3_VERSION1,
            self::CASH_REGISTER_SYSTEM_COMPILATORAB_DACKDATA_520_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_COMPUSOFTAS_COMPUSOFT_48,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERINGMOBILE_51_XKLM,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERINGMOBILE_520_KLM,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERING_51_XKL,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSETSERVERING_520_KL,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_MOBILE_51_XKLM,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_MOBILE_520_KLM,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_51_XKL,
            self::CASH_REGISTER_SYSTEM_COMPUTANSEAS_ASSET_M3_520_KL,
            self::CASH_REGISTER_SYSTEM_CONDUENTOGENTUR_EXPERT900_OGEXPERT9200_030_ENTUR_ELECTRON100_AFCREST20195_CONDUENT,
            self::CASH_REGISTER_SYSTEM_CONDUENTOGENTUR_EXPERT900_OGEXPERT9200_1_X_ENTUR_ELECTRON100_AFCREST20195_CONDUENT,
            self::CASH_REGISTER_SYSTEM_CONDUENT_EXPERT900_OGEXPERT9200_20191,
            self::CASH_REGISTER_SYSTEM_COOLNETNORGEAS_LIMEPOS_1,
            self::CASH_REGISTER_SYSTEM_CORDELNORGEAS_CORDEL_20,
            self::CASH_REGISTER_SYSTEM_COWHILLS_RPOS_10,
            self::CASH_REGISTER_SYSTEM_CRDSYSTEMSOY_BARTRACE_10,
            self::CASH_REGISTER_SYSTEM_CRDSYSTEMSOY_BARTRACE_100,
            self::CASH_REGISTER_SYSTEM_CROSSOVERTECHNOLOGIESLTD_XPOS_VERSIONS1_AND2,
            self::CASH_REGISTER_SYSTEM_DATANOVAAS_DATANOVAIZI_1,
            self::CASH_REGISTER_SYSTEM_DATANOVAAS_WINDOWSSHOPPINGRETAIL_5,
            self::CASH_REGISTER_SYSTEM_DATATEKNIKKNILSEN_TIMEBOKPOS_102,
            self::CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGABASIC_3211,
            self::CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGAKASSASYSTEM_3211,
            self::CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGALITE_3211,
            self::CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGASPLASH_3211,
            self::CASH_REGISTER_SYSTEM_DATORAMAAB_OMEGASTYLE_3211,
            self::CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_1884,
            self::CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_1911,
            self::CASH_REGISTER_SYSTEM_DDDRETAILNORWAYAS_DDDPOS_19_XX,
            self::CASH_REGISTER_SYSTEM_DEFINITAS_ANOVAKASSE_K170,
            self::CASH_REGISTER_SYSTEM_DEFINITAS_OMNISHOPPOSMOBILE_20_OGNYERE,
            self::CASH_REGISTER_SYSTEM_DEGREECONSULTINGGROUPAS_DEGREEPOINTOFSALESSOLUTION_1,
            self::CASH_REGISTER_SYSTEM_DEKKPROSOLUTIONSAS_DEKKPROPOS_10,
            self::CASH_REGISTER_SYSTEM_DENVER_NORSHOPPRO_143900,
            self::CASH_REGISTER_SYSTEM_DFSTOKHEIM_FUELPOS_VERSION51,
            self::CASH_REGISTER_SYSTEM_DIALOGEXEAS_DXPOS_110,
            self::CASH_REGISTER_SYSTEM_DIEBOLDNIXDORFAS_TPNET_1010,
            self::CASH_REGISTER_SYSTEM_DLSOFTWARE_DLPRIME_3,
            self::CASH_REGISTER_SYSTEM_DOMINOS_PULSE_385,
            self::CASH_REGISTER_SYSTEM_DOVERFUELINGSOLUTIONS_FUSION_10,
            self::CASH_REGISTER_SYSTEM_DOVERFUELINGSOLUTIONS_NUCLEUS10_FORFUSION_103,
            self::CASH_REGISTER_SYSTEM_EASYUPDATEAS_BUTIKKDATA_70,
            self::CASH_REGISTER_SYSTEM_EASYUPDATEAS_BUTIKKDATA_70_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_EGA_S_DETAIL6_6828,
            self::CASH_REGISTER_SYSTEM_EGA_S_FACKTAPOS_610,
            self::CASH_REGISTER_SYSTEM_EGA_S_HAIRTOOLS_120_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_EGNORGEAS_2_DPOINT_7_X,
            self::CASH_REGISTER_SYSTEM_EGNORGEAS_EGBRLDYNAMICSAX2009_POS_10,
            self::CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_242_X,
            self::CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_300_X,
            self::CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_30_X,
            self::CASH_REGISTER_SYSTEM_EGRETAILAS_EGPOS_40_X,
            self::CASH_REGISTER_SYSTEM_EINRSOFTWAREAS_POS9_100,
            self::CASH_REGISTER_SYSTEM_EINRSOFTWAREAS_POSBE_VERSJON10_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_ELECTRASWEDENAB_ELECTRASMARTBDS_3,
            self::CASH_REGISTER_SYSTEM_ELEKTRONISKEBETALINGSSYSTEMERAS_FLEXPAY_30,
            self::CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOINT_6,
            self::CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOS_222,
            self::CASH_REGISTER_SYSTEM_ELFOAS_VISIONPOS_6,
            self::CASH_REGISTER_SYSTEM_ELWATCHAS_JUSTCARDROUGHLINE,
            self::CASH_REGISTER_SYSTEM_EMMAEDBAS_BRAVOPOS_3,
            self::CASH_REGISTER_SYSTEM_EMSOFTWAREPARTNERSAS_ELGUIDE_65600,
            self::CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT3452,
            self::CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT35,
            self::CASH_REGISTER_SYSTEM_ENTUR_BLUEBIRDBM180_MT37,
            self::CASH_REGISTER_SYSTEM_ENTUR_ESS_5,
            self::CASH_REGISTER_SYSTEM_ENTUR_ESS_6,
            self::CASH_REGISTER_SYSTEM_ENTUR_ESS_7,
            self::CASH_REGISTER_SYSTEM_EONBITAS_EONTYRE_100,
            self::CASH_REGISTER_SYSTEM_ESCHERGROUPIRL_PULS_5502,
            self::CASH_REGISTER_SYSTEM_ESPOSNORGEAS_DIGGIPOS_10,
            self::CASH_REGISTER_SYSTEM_ESPOSNORGEAS_ESPOSLIGHT_60,
            self::CASH_REGISTER_SYSTEM_EVRYASA_OPAS_921812_XX,
            self::CASH_REGISTER_SYSTEM_EXPRESSRETAILSVERIGEAB_EXPRESSRETAIL_20,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_177_X,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_178_X,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAB_EXTENDARETAILPOS_179,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_171,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_173,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_RSPOS_174,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_162_SP1,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_171,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_172,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_181,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_191,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_201,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SILENTTOUCH_211,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SUPERPOS_1721,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_SUPERPOS_173,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILAS_WALLMOBPOS_217,
            self::CASH_REGISTER_SYSTEM_EXTENDARETAILSOFTWAREAB_EXTENDARETAILPOS_EXTENDARETAILKAPV1816,
            self::CASH_REGISTER_SYSTEM_EXTENSORAS_EXTENSOR05_132,
            self::CASH_REGISTER_SYSTEM_FARAAS_FARAFTS_FTSCSR3800_FTSTN31,
            self::CASH_REGISTER_SYSTEM_FASFLOWSOLUTIONSAS_FASTFLOW_2406,
            self::CASH_REGISTER_SYSTEM_FASTFLOWSOLUTIONSAS_FASTFLOW_2600,
            self::CASH_REGISTER_SYSTEM_FDTSYSTEMAB_EXCELLENCERETAILPOS_10220,
            self::CASH_REGISTER_SYSTEM_FIFTYTWO_BORDINGDATA_LBAILBNDLBNSLBNNLBVDLSSBLSSDLSSELGARLGABLGAPLMBLLAPGLAPZLGPSLGPZLAPT_52,
            self::CASH_REGISTER_SYSTEM_FILMSTADENAB_BOSS_20,
            self::CASH_REGISTER_SYSTEM_FLEXICONSYSTEMAB_EXCELLENCE_201811,
            self::CASH_REGISTER_SYSTEM_FLEXPOS_FLEXPOS_215,
            self::CASH_REGISTER_SYSTEM_FLUGGERNORWAYAS_FLUGGERAX2009_POS_10,
            self::CASH_REGISTER_SYSTEM_FRONTSYSTEMS_FRONTKASSEFORIOS_10,
            self::CASH_REGISTER_SYSTEM_FRONTSYSTEMS_I_T_21,
            self::CASH_REGISTER_SYSTEM_FROSTVIKAS_NPOS_421,
            self::CASH_REGISTER_SYSTEM_FUTURARETAILSOLUTIONSAG_FUTURERS_337,
            self::CASH_REGISTER_SYSTEM_FWHTECHNOLOGIES_SUBWAYPOS_20190_NO,
            self::CASH_REGISTER_SYSTEM_FWHTECHNOLOGIES_SUBWAYPOS_20191_NO,
            self::CASH_REGISTER_SYSTEM_FYGITECHNOLOGIESAS_SPG_10,
            self::CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIXPOS_215,
            self::CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIXPOS_225,
            self::CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIX_214,
            self::CASH_REGISTER_SYSTEM_GASTROFIXGMBH_GASTROFIX_215,
            self::CASH_REGISTER_SYSTEM_GASTROFIXGMBH_LIGHTSPEEDGASTROFIXPOS_30,
            self::CASH_REGISTER_SYSTEM_GETAPOS_WINSILVER_391_ELLERSENERE,
            self::CASH_REGISTER_SYSTEM_GETSAS_INSIDEPOS_10,
            self::CASH_REGISTER_SYSTEM_GETSHOPAS_1_1,
            self::CASH_REGISTER_SYSTEM_GIANTLEAPTECHNOLOGIESAS_POCKETSALES_20,
            self::CASH_REGISTER_SYSTEM_GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_300_ADD,
            self::CASH_REGISTER_SYSTEM_GKSOFTWARESE_SAPOMNICHANNELPOINTOFSALEBYGK_570_PVH,
            self::CASH_REGISTER_SYSTEM_GKSOFTWARESE_TPOS1024_12061803,
            self::CASH_REGISTER_SYSTEM_HANOAS_HANOFOTTERAPEUT_2,
            self::CASH_REGISTER_SYSTEM_HANOAS_HANOFRISOER_2,
            self::CASH_REGISTER_SYSTEM_HANOAS_HANOHANDEL_2,
            self::CASH_REGISTER_SYSTEM_HANOAS_HANOHUDPLEIE_2,
            self::CASH_REGISTER_SYSTEM_HANOAS_MASSOR_2,
            self::CASH_REGISTER_SYSTEM_HANO_NORPOS_2,
            self::CASH_REGISTER_SYSTEM_HANSAWORLD_STANDARDERP_85,
            self::CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_162,
            self::CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_172,
            self::CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_18_X,
            self::CASH_REGISTER_SYSTEM_HEADSSVENSKAAB_HEADSRETAIL_19_X,
            self::CASH_REGISTER_SYSTEM_HOEDEGAARD_COAS_QUORION_QMP50,
            self::CASH_REGISTER_SYSTEM_HOISTGROUPDEVELOPMENTLTD_HOTSOFT_82400,
            self::CASH_REGISTER_SYSTEM_HOLTLRETAILSOLUTIONSGMBH_POSFLOW5_5,
            self::CASH_REGISTER_SYSTEM_HOOPLAAS_HOOPLAPOS_12_X,
            self::CASH_REGISTER_SYSTEM_HOOPLASERVICESAS_HOOPLAMPOS_12_X,
            self::CASH_REGISTER_SYSTEM_HOOPLASERVICESAS_HOOPLAPOS_12_X,
            self::CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYOPERA_54,
            self::CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_50,
            self::CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_52,
            self::CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_54,
            self::CASH_REGISTER_SYSTEM_HRSHOSPITALITYANDRETAILSYSTEMS_ORACLEHOSPITALITYRES3700_55,
            self::CASH_REGISTER_SYSTEM_HUGBNAURHF_CENTARA_27,
            self::CASH_REGISTER_SYSTEM_IBM_SUREPOS_566,
            self::CASH_REGISTER_SYSTEM_INCADEA_ENGINE_2_XOG3_X,
            self::CASH_REGISTER_SYSTEM_INFOTRONICSAS_INFOPAYKASSE_1030,
            self::CASH_REGISTER_SYSTEM_INSOFTAS_CASHREG_11_XX,
            self::CASH_REGISTER_SYSTEM_INTELLIGENTPOINTOFSALE_SALES_LTD_IPOSKASSAREGISTER_10,
            self::CASH_REGISTER_SYSTEM_INTELLITIXTECHNOLOGIESINC_INTELLIPAY_216,
            self::CASH_REGISTER_SYSTEM_INTELLITIXTECHNOLOGIES_INTELLIPAY_216,
            self::CASH_REGISTER_SYSTEM_ITICKET_POS_V1,
            self::CASH_REGISTER_SYSTEM_ITPARTNERHELGELANDAS_PLANITKASSE_2018_OKTOBER,
            self::CASH_REGISTER_SYSTEM_ITXMERKENBV_HIPOS_NOR43,
            self::CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICEAS_IZZETTLEKASSESYSTEM_11,
            self::CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_11,
            self::CASH_REGISTER_SYSTEM_IZETTLEMERCHANTSERVICESAB_IZETTLEKASSAREGISTER_21,
            self::CASH_REGISTER_SYSTEM_IZETTLE_IZETTLEREADER_03000000,
            self::CASH_REGISTER_SYSTEM_JEEVESINFORMATIONSYSTEMSAB_GARP_43,
            self::CASH_REGISTER_SYSTEM_JEEVESINFORMATIONSYSTEMS_GARP_42,
            self::CASH_REGISTER_SYSTEM_JMDATASYSTEMAS_JMTPOS_10,
            self::CASH_REGISTER_SYSTEM_K3_BUSINESSTECHNOLOGIES_IMAGINE_1_XXX,
            self::CASH_REGISTER_SYSTEM_KASSAMAGNEETTIOY_RESTOLUTION_N21,
            self::CASH_REGISTER_SYSTEM_KASSEOGBUTIKKDATA_CASIO_SES3000,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1006,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1008,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_1_X,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_2028,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLAGENT_2029,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_112,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_113,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_114,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_115,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_116,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_117,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_118,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_119,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_120,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_121,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_122,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_123,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_124,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_125,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_126,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_127,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_128,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_129,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_130,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_131,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_132,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_134,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_135,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_136,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_140,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_150,
            self::CASH_REGISTER_SYSTEM_KASSESERVICEAS_DUELLPOS_160,
            self::CASH_REGISTER_SYSTEM_KONSULENTDATA_RESTAURANTAS_KDRGOLD_37,
            self::CASH_REGISTER_SYSTEM_KONSULENTDATA_RESTAURANTAS_KDRGOLD_40,
            self::CASH_REGISTER_SYSTEM_KONTAKTLOES_K1_101,
            self::CASH_REGISTER_SYSTEM_LAVACLOUDPOSAS_AVELYN_1000,
            self::CASH_REGISTER_SYSTEM_LAVU_LAVUPOS_389,
            self::CASH_REGISTER_SYSTEM_LEEROYGROUPAB_LEEROYMPOS_20_NO,
            self::CASH_REGISTER_SYSTEM_LEXITGROUPNORWAYAS_LEXPOS_10,
            self::CASH_REGISTER_SYSTEM_LEXITGROUPNORWAYAS_LEXPOS_10_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_LIGHTSPEEDPOSGERMANYGMBH_LIGHTSPEEDGASTROFIXPOS_312,
            self::CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_EGPOS_40_X,
            self::CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_25_X,
            self::CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_300_X,
            self::CASH_REGISTER_SYSTEM_LINDBAKRETAILSYSTEMSAS_LINDBAKPOS_30_X,
            self::CASH_REGISTER_SYSTEM_LIVINGCONSULTINGAS_POCKETERP_20,
            self::CASH_REGISTER_SYSTEM_LONGRUNSOFTWARE_ECWINS_2019_R1,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSCENTRAL_150_ANDNEWER,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1002,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1006,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_110,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_1105750,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_130_ANDNEWER,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSNAV_90007244,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSONEFORSAPBUSINESSONE_2019_ANDLATER,
            self::CASH_REGISTER_SYSTEM_LSRETAILEHF_LSONE_2019_ANDLATER,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2009_64,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2015_80,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_100200396,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_1002_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSNAV2017_1008,
            self::CASH_REGISTER_SYSTEM_LSRETAIL_LSONE_20172,
            self::CASH_REGISTER_SYSTEM_LYKO_LYKOSMP_2,
            self::CASH_REGISTER_SYSTEM_MABUAS_ZPOS_14,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1033,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1044,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1055,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_1066,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_9111,
            self::CASH_REGISTER_SYSTEM_MESTERBLOMSTAS_MGKASSASYSTEM_922,
            self::CASH_REGISTER_SYSTEM_METRA_LCC_7_XX,
            self::CASH_REGISTER_SYSTEM_MICROSOFTCORP_DYNAMICS365_FORFINANCEANDOPERATIONSDYNAMICS365_FORRETAILANDCOMMERCE_ENTERPRISEEDITIONAPPLICATIONUPDATE5_ANDLATER,
            self::CASH_REGISTER_SYSTEM_MICROSOFTCORP_DYNAMICS365_FORFINANCEANDOPERATIONSDYNAMICS365_FORRETAIL_ENTERPRISEEDITIONAPPLICATIONUPDATE5,
            self::CASH_REGISTER_SYSTEM_MICROSOFT_AX2009_LSPOS_SPESIALTILPASNINGFORSKEIDAR,
            self::CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSAX2012_R3,
            self::CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSAXSPESIALTILPASSETFORAKZONOBELEUROPE_2012_R3,
            self::CASH_REGISTER_SYSTEM_MICROSOFT_DYNAMICSNAVCLASSICPOS_50,
            self::CASH_REGISTER_SYSTEM_MINSAITSA_TMSFORPOS_240,
            self::CASH_REGISTER_SYSTEM_MOBITECHAS_MTPROG_05,
            self::CASH_REGISTER_SYSTEM_MOBITECHAS_SVPOS_MRK2,
            self::CASH_REGISTER_SYSTEM_MOREFLO_MOREFLO_3,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_317_X,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_417_X,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_418_X,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_419_X,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_420_X,
            self::CASH_REGISTER_SYSTEM_MULTICASENORGEAS_MULTICASEFORRETNINGSSYSTEM_421_X,
            self::CASH_REGISTER_SYSTEM_MUNUAS_MUNUCLOUDPOS_16_ANDABOVE,
            self::CASH_REGISTER_SYSTEM_MUNUAS_RSPOS_16_ANDBELOW,
            self::CASH_REGISTER_SYSTEM_MYSTORENOAS_20_20,
            self::CASH_REGISTER_SYSTEM_MYSTORENOAS_MYSTOREDATAKASSE_32,
            self::CASH_REGISTER_SYSTEM_NASOFT_MYCRON_NASOFTKASSADEL_VER62,
            self::CASH_REGISTER_SYSTEM_NAVIPARTNER_NPRETAIL_2017,
            self::CASH_REGISTER_SYSTEM_NAVIPROAB_CASHJET_2013,
            self::CASH_REGISTER_SYSTEM_NAVIPROAB_CASHJET_IPOS10,
            self::CASH_REGISTER_SYSTEM_NCRDANMARKAS_ASARPOS_304,
            self::CASH_REGISTER_SYSTEM_NCRDANMARKAS_NCRALOHAAFM_19,
            self::CASH_REGISTER_SYSTEM_NCRDANMARKAS_OCTANE2000_Z0933,
            self::CASH_REGISTER_SYSTEM_NCRDANMARK_STOREPOINT18104_18104,
            self::CASH_REGISTER_SYSTEM_NEWBLACKBV_EVAUNIFIEDCOMMERCE_20,
            self::CASH_REGISTER_SYSTEM_NMIRUNEEDGARSVENDSEN_MULTISYSPOS_907,
            self::CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAPAY_10,
            self::CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAPOS_30,
            self::CASH_REGISTER_SYSTEM_NORBITSAS_ATHENAXPOS_10,
            self::CASH_REGISTER_SYSTEM_NORDICCINEMAGROUP_BOSS_10,
            self::CASH_REGISTER_SYSTEM_NORENSIKT_JUMPEREZPAD5_S_10,
            self::CASH_REGISTER_SYSTEM_NORSKSOLIMPORT_SUNMASTER_SUNMASTER1048,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191002,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3851910021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_NUTIDPCKASSA_385210624_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851701011,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851702141,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851704051,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851705111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851707061,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851708161,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851709041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851710101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851711151,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851712281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851802131,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851804111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851805221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851807091,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851807241,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851810101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191002,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852005021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPHOSPITALITY_385210624_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPMPAYANDROID_110_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851701011,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851702141,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851704051,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851705111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851707061,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851708161,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851709041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851710101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851711151,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851712281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851802131,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851804111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851805221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851807091,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851807241,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851810101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191002,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPRETAIL_385210624_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_10,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_102,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_103,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTARTANDROID_10_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851701011,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851702141,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851704051,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851705111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851707061,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851708161,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851709041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851710101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851711151,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851712281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851802131,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851804111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851805221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851807091,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851807241,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851810101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191002,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSTART_385210624_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851701011,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851702141,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851704051,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851705111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851707061,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851708161,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851709041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851710101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851711151,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851712281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851802131,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851804111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851805221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851807091,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851807241,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851810101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3851910021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPSUPERMARKET_385210624_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851701011,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851702141,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851704051,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851705111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851707061,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851708161,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851709041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851710101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851711151,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851712281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851802131,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851804111,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851805221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851807091,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851807241,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851810101,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3851811281,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190221,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190528,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385190911,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191002,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191022,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385191204,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852001291,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852003021,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852005041,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852009301,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_3852101271,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210127_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210414_X,
            self::CASH_REGISTER_SYSTEM_NUTIDAB_SHARPWELLNESS_385210624_X,
            self::CASH_REGISTER_SYSTEM_ODINSYSTEMERAS_FIXIT_3426,
            self::CASH_REGISTER_SYSTEM_ODINSYSTEMERAS_FIXIT_35_X,
            self::CASH_REGISTER_SYSTEM_OFFICELINKAS_FRONTLINE_40,
            self::CASH_REGISTER_SYSTEM_OLYMPIAGOEUROPEGMBH_OLYMPIA_CM911,
            self::CASH_REGISTER_SYSTEM_OMDATAAS_ORC_10,
            self::CASH_REGISTER_SYSTEM_OMEGAPSAS_PIMSKASSE_10,
            self::CASH_REGISTER_SYSTEM_ONLINEEDBAS_EXCELINE_2000,
            self::CASH_REGISTER_SYSTEM_ONLINEPOS_ALLINONE_1,
            self::CASH_REGISTER_SYSTEM_OPENSOLUTIONNORWAYAS_OPENSOLUTIONRETAILSYSTEM_40,
            self::CASH_REGISTER_SYSTEM_OPENSOLUTIONNORWAYAS_OPENVENUE_20,
            self::CASH_REGISTER_SYSTEM_ORACLE_SIMPHONY_29,
            self::CASH_REGISTER_SYSTEM_ORACLE_SIMPHONY_29_ANDLATER,
            self::CASH_REGISTER_SYSTEM_ORDERXAS_ORDERXMPOS_10,
            self::CASH_REGISTER_SYSTEM_ORDRAS_1000_1,
            self::CASH_REGISTER_SYSTEM_PALISIS_PIDION_4_X,
            self::CASH_REGISTER_SYSTEM_PASTELLDATAAB_PROFIT10_NO_88,
            self::CASH_REGISTER_SYSTEM_PCKASSE_PCK_3,
            self::CASH_REGISTER_SYSTEM_PCKAS_COMPLETEPOS_4,
            self::CASH_REGISTER_SYSTEM_PCKAS_COMPLETEPOS_40,
            self::CASH_REGISTER_SYSTEM_PCKAS_ERPPOS_15_XXXX,
            self::CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_31,
            self::CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_3158,
            self::CASH_REGISTER_SYSTEM_PCKAS_PCKASSE_VER3_X,
            self::CASH_REGISTER_SYSTEM_PCKNO_PCKASSE_3158,
            self::CASH_REGISTER_SYSTEM_PENGVINAFFARSSYSTEMAB_PENGVIN_4262,
            self::CASH_REGISTER_SYSTEM_PERFECTITBEXAB_BEXPOS_3_XX,
            self::CASH_REGISTER_SYSTEM_PILAROAS_PILAROPROPOS_3,
            self::CASH_REGISTER_SYSTEM_PINCHONATIONAB_CASHIERCLOUD_100,
            self::CASH_REGISTER_SYSTEM_PLUTOSYSTEMSAB_PLUTO1024_K0427_OGNYERE,
            self::CASH_REGISTER_SYSTEM_POINTSOFTSCANDINAVIAAS_POINTSOFT_2701961,
            self::CASH_REGISTER_SYSTEM_POLYGONCOMMUNICATIONSAS_PRSPOS_214,
            self::CASH_REGISTER_SYSTEM_POSONEA_S_POSONE_POSONE4,
            self::CASH_REGISTER_SYSTEM_POWEREDBYYONOTONOY_POWEREDBYYONOTONPOS_10,
            self::CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V20,
            self::CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V5030,
            self::CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V5220,
            self::CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V6001,
            self::CASH_REGISTER_SYSTEM_PRESSISCONSULTINGAS_PRESSISPOS_V7002,
            self::CASH_REGISTER_SYSTEM_PROFITIMPACTNORGEAS_PIMS_100,
            self::CASH_REGISTER_SYSTEM_PROFITIMPACTNORGEAS_RESERVATOR_100,
            self::CASH_REGISTER_SYSTEM_PROOPTICSAS_HEADSOPTICS_1,
            self::CASH_REGISTER_SYSTEM_PROVENDO_ODOO_11,
            self::CASH_REGISTER_SYSTEM_PULSENRETAILAB_HARMONEY_35_XX,
            self::CASH_REGISTER_SYSTEM_PUNTOFASL_EJOURNALNOR_2018111,
            self::CASH_REGISTER_SYSTEM_QUADRIGAAB_EUROSHOP_2018,
            self::CASH_REGISTER_SYSTEM_QUICKORDERAPS_QUICKPOS_251,
            self::CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_Q3_30240,
            self::CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_Q3_30_X,
            self::CASH_REGISTER_SYSTEM_QUICKSYSYTEMSAS_QUICKNG_2089,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR18_G3180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR21_B_G1170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_CR50_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP18_G3180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP18_QA180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_H4170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2044_H4180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_H4170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP2264_H4180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP50_G1170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QMP50_H1180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170215_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH10_QA180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_QA170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH12_QA180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_QA170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH15_QA180822_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_170601_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_QB170615_NO,
            self::CASH_REGISTER_SYSTEM_QUORIONDATASYSTEMSGMBH_QTOUCH8_QB180822_NO,
            self::CASH_REGISTER_SYSTEM_RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_1,
            self::CASH_REGISTER_SYSTEM_RAVNWEBVEVERIETAS_KINOLOGGBILLETTSALG_2,
            self::CASH_REGISTER_SYSTEM_RDISOFTWAREACAPGEMINICOMPANYT_NP61_SLE141_FMNP6130_MR5_QR0_HF0_K517_MR2_HF25,
            self::CASH_REGISTER_SYSTEM_RDISOFTWAREACAPGEMINICOMPANY_NP61_SLE145_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_RDISOFTWARE_NP61_2021_Q2_HF5_NP613010_QR1_HF151_K5176_QR4_HF9_SLE445,
            self::CASH_REGISTER_SYSTEM_REDROCKSOLUTIONSAS_TOGITALPOS_V286,
            self::CASH_REGISTER_SYSTEM_REKNESAS_REKNESWMS_154_X,
            self::CASH_REGISTER_SYSTEM_RESPONSERETAILAS_MANDARIN_442,
            self::CASH_REGISTER_SYSTEM_RETAILPLANITAS_OPTITECRS_16271,
            self::CASH_REGISTER_SYSTEM_RETAILPLANITNORGEAS_OPTIMALTILL_OPTIMALKASSE_16351_OGNYERE,
            self::CASH_REGISTER_SYSTEM_RETAILPROINTERNATIONALLLC_PRISMNO_1_XXXX,
            self::CASH_REGISTER_SYSTEM_RETAILPROINTERNATIONALLLC_RETAILPROVERSION86_860,
            self::CASH_REGISTER_SYSTEM_SALDIDKAPS_GERNERSPOS_1,
            self::CASH_REGISTER_SYSTEM_SCALEITAS_SCALEITPOS_10,
            self::CASH_REGISTER_SYSTEM_SEATGEEK_SRO_4221_OGNYERE,
            self::CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER230_EJ_NOR04000,
            self::CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER260_EJ_NOR04000,
            self::CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER265_EJ_NOR04000,
            self::CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SER510_BSE_NOR04000,
            self::CASH_REGISTER_SYSTEM_SHINHEUNGPRECISIONCOLTD_SAM4_SNR500_NOR04000,
            self::CASH_REGISTER_SYSTEM_SHOEDVISIONAMBA_SHOESHOP_3161,
            self::CASH_REGISTER_SYSTEM_SHOPBOXAPS_SHOPBOX_16_X,
            self::CASH_REGISTER_SYSTEM_SHOPLABSAS_SHOPLABS_160,
            self::CASH_REGISTER_SYSTEM_SIAIBSC_COMPANY_RESICO_40,
            self::CASH_REGISTER_SYSTEM_SITOO_SITOOPOS_1_X,
            self::CASH_REGISTER_SYSTEM_SKIBARSYSTEMSAB_SKIBARV2_CASHIER_09100,
            self::CASH_REGISTER_SYSTEM_SKIDATASCANDINAVIAAB_SUMMITLOGIC_26,
            self::CASH_REGISTER_SYSTEM_SKISTARAB_SORENPOS_446151_OCHSENARE,
            self::CASH_REGISTER_SYSTEM_SMARTIPOS_APP_10,
            self::CASH_REGISTER_SYSTEM_SMARTLAUNDRYAS_SMARTIPOS_100,
            self::CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_595_NO,
            self::CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_RMSV592_NO,
            self::CASH_REGISTER_SYSTEM_SMSAS_RMSV_IDNR151190_RMSV59_NO,
            self::CASH_REGISTER_SYSTEM_SODVINSYSTEMERAS_XAKTMEDLEMBUTIKK_20181201_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_SODVINSYSTEMERAS_XAKTMEDLEM_20181201_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_314,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_332,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_335,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_3351,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_340,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_341,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_342,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_343,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_344,
            self::CASH_REGISTER_SYSTEM_SPECSAVERSORACLERETAILJAVA_OPTICUS_346,
            self::CASH_REGISTER_SYSTEM_SPECTERAB_SPECTERPOS_3_XX,
            self::CASH_REGISTER_SYSTEM_STAMFORDAB_ECSBUTIKSDATA_62031_OCHSENARE,
            self::CASH_REGISTER_SYSTEM_SUNMITECHNOLOGYCOLTD_OLIVERPOS_2388,
            self::CASH_REGISTER_SYSTEM_SUSOFT_APOS_11,
            self::CASH_REGISTER_SYSTEM_SVERIGEKASSANAB_NORPOS_A02,
            self::CASH_REGISTER_SYSTEM_SYNSAMGROUPSWEDENAB_EYELIFE_30,
            self::CASH_REGISTER_SYSTEM_TAILORMOADEAPS_TAILORSOFT_2913902,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_1130,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_12_X,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_13_X,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_14_X,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_15_X,
            self::CASH_REGISTER_SYSTEM_TELLIXAS_PROTOUCH_16_X,
            self::CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_166_ANDROID,
            self::CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_180_ANDROID,
            self::CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_3200_IOS,
            self::CASH_REGISTER_SYSTEM_TICKETCOAS_TICKETCOADMIN_3210_IOS,
            self::CASH_REGISTER_SYSTEM_TICKETINTERNATIONALSOFTWARETRADINGGMBH_COKG_DOLPHIN_81300,
            self::CASH_REGISTER_SYSTEM_TICKSTERAB_TICKSTERBLINKPOS_21_X,
            self::CASH_REGISTER_SYSTEM_TICKSTERAB_TICKSTERBLINKPOS_22_X,
            self::CASH_REGISTER_SYSTEM_TIDYPOSAS_POCKETERP_TIDYPAY_217,
            self::CASH_REGISTER_SYSTEM_TIMEKIOSKAS_TIMEKIOSKPOS_52,
            self::CASH_REGISTER_SYSTEM_TIMMAOY_TIMMABUSINESS_1,
            self::CASH_REGISTER_SYSTEM_TIMMAOY_TIMMABUSINESS_1200,
            self::CASH_REGISTER_SYSTEM_TIXAS_BOTIXNO_2019,
            self::CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR46,
            self::CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR49,
            self::CASH_REGISTER_SYSTEM_TOKHEIMBELGIUMNV_FUELPOS_EUR52,
            self::CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_2381,
            self::CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_32,
            self::CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_32_XX,
            self::CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_33_XX,
            self::CASH_REGISTER_SYSTEM_TOUCHSOFTAS_TOUCHSOFTPOS_4_XX,
            self::CASH_REGISTER_SYSTEM_TRIVECSYSTEMSAS_DOMINONO_385,
            self::CASH_REGISTER_SYSTEM_TRIVECSYSTEMSAS_DOMINONO_4_XXXX,
            self::CASH_REGISTER_SYSTEM_TURNITOU_TURNITRIDE_31,
            self::CASH_REGISTER_SYSTEM_UNIKUMDATASYSTEMAB_PYRAMIDBUSINESSSTUDIOS_342,
            self::CASH_REGISTER_SYSTEM_UNIMICROAS_UNIOEKONOMIV3_366_XXX,
            self::CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_623,
            self::CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_7_X,
            self::CASH_REGISTER_SYSTEM_UNIPOSAS_BUTIKKDATA_8_X,
            self::CASH_REGISTER_SYSTEM_UNIPOSAS_SMARTKASSE_10,
            self::CASH_REGISTER_SYSTEM_UNIPOSAS_SMARTKASSE_2_X,
            self::CASH_REGISTER_SYSTEM_VANGSOFTWARE_VANGSOFTWARE_VASO22,
            self::CASH_REGISTER_SYSTEM_VECTRONSYSTEMAG_VECTRONPOS_5_X,
            self::CASH_REGISTER_SYSTEM_VECTRON_VECTRONPOSTOUCH_600,
            self::CASH_REGISTER_SYSTEM_VERENDUSSYSTEMAB_VERENDUSBUTIKK_11,
            self::CASH_REGISTER_SYSTEM_VESTSYSTEMPARTNERAS_VSPMILJOE_30,
            self::CASH_REGISTER_SYSTEM_VESTSYSTEMPARTNER_APOS_30,
            self::CASH_REGISTER_SYSTEM_VETSERVEAS_VETSERVECLASSIC_1187_ELLERNYERE,
            self::CASH_REGISTER_SYSTEM_VISBOOKAS_VISBOOK_7_X,
            self::CASH_REGISTER_SYSTEM_VISMARETAILAS_WALLMOBPOS_217_PLUSS,
            self::CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_162_SP1,
            self::CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_171,
            self::CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_172,
            self::CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SILENTTOUCH_181,
            self::CASH_REGISTER_SYSTEM_VISMARETAILSOFTWAREAS_SUPERPOS_1721,
            self::CASH_REGISTER_SYSTEM_VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_12_X,
            self::CASH_REGISTER_SYSTEM_VISMASOFTWAREINTERNATIONALAS_VISMAERPPOS_13000,
            self::CASH_REGISTER_SYSTEM_VISMASOFTWARELABSAS_VISMAENTERPRISEKASSEPLUS_20202,
            self::CASH_REGISTER_SYSTEM_VISMASOFTWARELABSAS_VISMAENTERPRISEKASSE_20202,
            self::CASH_REGISTER_SYSTEM_VITECAUTODATAAS_ADKASSE_1001,
            self::CASH_REGISTER_SYSTEM_VITECFIXITSYSTEMERAS_FIXIT_35_X,
            self::CASH_REGISTER_SYSTEM_VITECINFOEASYAS_PCKASSE_10218,
            self::CASH_REGISTER_SYSTEM_VITECSMARTVISITORSYSTEMAB_DK5000_3110,
            self::CASH_REGISTER_SYSTEM_WINPOSGROUP_WINPOSMEGASTORE_30,
            self::CASH_REGISTER_SYSTEM_WINSOLUTIONAS_2021_10,
            self::CASH_REGISTER_SYSTEM_WINTERSTEIGERAG_EASYRENT_17,
            self::CASH_REGISTER_SYSTEM_WLCOMAS_BUILD103_2018310245,
            self::CASH_REGISTER_SYSTEM_WSAELECTRONICGMBH_TICKETLINE_72_XOGNYERE,
            self::CASH_REGISTER_SYSTEM_WTWAS_LINEFARE_10,
            self::CASH_REGISTER_SYSTEM_ZIRIUSAS_ZIRIUSKASSE_35,
            self::CASH_REGISTER_SYSTEM_ANNET_KASSASYSTEM,
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
        $this->setIfExists('group_id', $data ?? [], null);
        $this->setIfExists('generic_data_type', $data ?? [], null);
        $this->setIfExists('generic_data_sub_type_group_id', $data ?? [], null);
        $this->setIfExists('year_of_initial_registration', $data ?? [], null);
        $this->setIfExists('cash_register_system', $data ?? [], null);
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

        $allowedValues = $this->getCashRegisterSystemAllowableValues();
        if (!is_null($this->container['cash_register_system']) && !in_array($this->container['cash_register_system'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'cash_register_system', must be one of '%s'",
                $this->container['cash_register_system'],
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
     * Gets group_id
     *
     * @return float|null
     */
    public function getGroupId()
    {
        return $this->container['group_id'];
    }

    /**
     * Sets group_id
     *
     * @param float|null $group_id group_id
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
     * Gets generic_data_sub_type_group_id
     *
     * @return float|null
     */
    public function getGenericDataSubTypeGroupId()
    {
        return $this->container['generic_data_sub_type_group_id'];
    }

    /**
     * Sets generic_data_sub_type_group_id
     *
     * @param float|null $generic_data_sub_type_group_id generic_data_sub_type_group_id
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
     * Gets year_of_initial_registration
     *
     * @return float|null
     */
    public function getYearOfInitialRegistration()
    {
        return $this->container['year_of_initial_registration'];
    }

    /**
     * Sets year_of_initial_registration
     *
     * @param float|null $year_of_initial_registration year_of_initial_registration
     *
     * @return self
     */
    public function setYearOfInitialRegistration($year_of_initial_registration)
    {
        if (is_null($year_of_initial_registration)) {
            throw new \InvalidArgumentException('non-nullable year_of_initial_registration cannot be null');
        }
        $this->container['year_of_initial_registration'] = $year_of_initial_registration;

        return $this;
    }

    /**
     * Gets cash_register_system
     *
     * @return string|null
     */
    public function getCashRegisterSystem()
    {
        return $this->container['cash_register_system'];
    }

    /**
     * Sets cash_register_system
     *
     * @param string|null $cash_register_system cash_register_system
     *
     * @return self
     */
    public function setCashRegisterSystem($cash_register_system)
    {
        if (is_null($cash_register_system)) {
            throw new \InvalidArgumentException('non-nullable cash_register_system cannot be null');
        }
        $allowedValues = $this->getCashRegisterSystemAllowableValues();
        if (!in_array($cash_register_system, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'cash_register_system', must be one of '%s'",
                    $cash_register_system,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['cash_register_system'] = $cash_register_system;

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


