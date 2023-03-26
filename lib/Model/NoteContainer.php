<?php
/**
 * NoteContainer
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
 * NoteContainer Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class NoteContainer implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'NoteContainer';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
        'note' => '\Learnist\Tripletex\Model\YearEndReportNote',
        'note_number' => 'int',
        'posts' => '\Learnist\Tripletex\Model\YearEndReportNoteData[]',
        'closing_sum_salary' => 'float',
        'opening_sum_salary' => 'float',
        'extraordinary_income_posts' => '\Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]',
        'extraordinary_cost_posts' => '\Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]',
        'sum_extraordinary_income' => 'object',
        'sum_extraordinary_cost' => 'object',
        'acquisition_cost_tangible_fixed_assets' => 'object',
        'acquisition_cost_intangible_assets' => 'object',
        'capitalised_value_tangible_fixed_assets' => 'object',
        'capitalised_value_intangible_assets' => 'object',
        'investments_posts' => '\Learnist\Tripletex\Model\GroupInvestment[]',
        'asset_posts' => '\Learnist\Tripletex\Model\FinacialInstrumentAsset[]',
        'sum_real_value' => 'object',
        'sum_value_adjustment' => 'object',
        'note_text_library' => '\Learnist\Tripletex\Model\NoteTextLibrary[]'
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
        'note' => null,
        'note_number' => 'int32',
        'posts' => null,
        'closing_sum_salary' => null,
        'opening_sum_salary' => null,
        'extraordinary_income_posts' => null,
        'extraordinary_cost_posts' => null,
        'sum_extraordinary_income' => null,
        'sum_extraordinary_cost' => null,
        'acquisition_cost_tangible_fixed_assets' => null,
        'acquisition_cost_intangible_assets' => null,
        'capitalised_value_tangible_fixed_assets' => null,
        'capitalised_value_intangible_assets' => null,
        'investments_posts' => null,
        'asset_posts' => null,
        'sum_real_value' => null,
        'sum_value_adjustment' => null,
        'note_text_library' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'year_end_report' => false,
		'note' => false,
		'note_number' => false,
		'posts' => false,
		'closing_sum_salary' => false,
		'opening_sum_salary' => false,
		'extraordinary_income_posts' => false,
		'extraordinary_cost_posts' => false,
		'sum_extraordinary_income' => false,
		'sum_extraordinary_cost' => false,
		'acquisition_cost_tangible_fixed_assets' => false,
		'acquisition_cost_intangible_assets' => false,
		'capitalised_value_tangible_fixed_assets' => false,
		'capitalised_value_intangible_assets' => false,
		'investments_posts' => false,
		'asset_posts' => false,
		'sum_real_value' => false,
		'sum_value_adjustment' => false,
		'note_text_library' => false
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
        'note' => 'note',
        'note_number' => 'noteNumber',
        'posts' => 'posts',
        'closing_sum_salary' => 'closingSumSalary',
        'opening_sum_salary' => 'openingSumSalary',
        'extraordinary_income_posts' => 'extraordinaryIncomePosts',
        'extraordinary_cost_posts' => 'extraordinaryCostPosts',
        'sum_extraordinary_income' => 'sumExtraordinaryIncome',
        'sum_extraordinary_cost' => 'sumExtraordinaryCost',
        'acquisition_cost_tangible_fixed_assets' => 'acquisitionCostTangibleFixedAssets',
        'acquisition_cost_intangible_assets' => 'acquisitionCostIntangibleAssets',
        'capitalised_value_tangible_fixed_assets' => 'capitalisedValueTangibleFixedAssets',
        'capitalised_value_intangible_assets' => 'capitalisedValueIntangibleAssets',
        'investments_posts' => 'investmentsPosts',
        'asset_posts' => 'assetPosts',
        'sum_real_value' => 'sumRealValue',
        'sum_value_adjustment' => 'sumValueAdjustment',
        'note_text_library' => 'noteTextLibrary'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
        'note' => 'setNote',
        'note_number' => 'setNoteNumber',
        'posts' => 'setPosts',
        'closing_sum_salary' => 'setClosingSumSalary',
        'opening_sum_salary' => 'setOpeningSumSalary',
        'extraordinary_income_posts' => 'setExtraordinaryIncomePosts',
        'extraordinary_cost_posts' => 'setExtraordinaryCostPosts',
        'sum_extraordinary_income' => 'setSumExtraordinaryIncome',
        'sum_extraordinary_cost' => 'setSumExtraordinaryCost',
        'acquisition_cost_tangible_fixed_assets' => 'setAcquisitionCostTangibleFixedAssets',
        'acquisition_cost_intangible_assets' => 'setAcquisitionCostIntangibleAssets',
        'capitalised_value_tangible_fixed_assets' => 'setCapitalisedValueTangibleFixedAssets',
        'capitalised_value_intangible_assets' => 'setCapitalisedValueIntangibleAssets',
        'investments_posts' => 'setInvestmentsPosts',
        'asset_posts' => 'setAssetPosts',
        'sum_real_value' => 'setSumRealValue',
        'sum_value_adjustment' => 'setSumValueAdjustment',
        'note_text_library' => 'setNoteTextLibrary'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
        'note' => 'getNote',
        'note_number' => 'getNoteNumber',
        'posts' => 'getPosts',
        'closing_sum_salary' => 'getClosingSumSalary',
        'opening_sum_salary' => 'getOpeningSumSalary',
        'extraordinary_income_posts' => 'getExtraordinaryIncomePosts',
        'extraordinary_cost_posts' => 'getExtraordinaryCostPosts',
        'sum_extraordinary_income' => 'getSumExtraordinaryIncome',
        'sum_extraordinary_cost' => 'getSumExtraordinaryCost',
        'acquisition_cost_tangible_fixed_assets' => 'getAcquisitionCostTangibleFixedAssets',
        'acquisition_cost_intangible_assets' => 'getAcquisitionCostIntangibleAssets',
        'capitalised_value_tangible_fixed_assets' => 'getCapitalisedValueTangibleFixedAssets',
        'capitalised_value_intangible_assets' => 'getCapitalisedValueIntangibleAssets',
        'investments_posts' => 'getInvestmentsPosts',
        'asset_posts' => 'getAssetPosts',
        'sum_real_value' => 'getSumRealValue',
        'sum_value_adjustment' => 'getSumValueAdjustment',
        'note_text_library' => 'getNoteTextLibrary'
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
        $this->setIfExists('note', $data ?? [], null);
        $this->setIfExists('note_number', $data ?? [], null);
        $this->setIfExists('posts', $data ?? [], null);
        $this->setIfExists('closing_sum_salary', $data ?? [], null);
        $this->setIfExists('opening_sum_salary', $data ?? [], null);
        $this->setIfExists('extraordinary_income_posts', $data ?? [], null);
        $this->setIfExists('extraordinary_cost_posts', $data ?? [], null);
        $this->setIfExists('sum_extraordinary_income', $data ?? [], null);
        $this->setIfExists('sum_extraordinary_cost', $data ?? [], null);
        $this->setIfExists('acquisition_cost_tangible_fixed_assets', $data ?? [], null);
        $this->setIfExists('acquisition_cost_intangible_assets', $data ?? [], null);
        $this->setIfExists('capitalised_value_tangible_fixed_assets', $data ?? [], null);
        $this->setIfExists('capitalised_value_intangible_assets', $data ?? [], null);
        $this->setIfExists('investments_posts', $data ?? [], null);
        $this->setIfExists('asset_posts', $data ?? [], null);
        $this->setIfExists('sum_real_value', $data ?? [], null);
        $this->setIfExists('sum_value_adjustment', $data ?? [], null);
        $this->setIfExists('note_text_library', $data ?? [], null);
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
     * Gets note_number
     *
     * @return int|null
     */
    public function getNoteNumber()
    {
        return $this->container['note_number'];
    }

    /**
     * Sets note_number
     *
     * @param int|null $note_number note_number
     *
     * @return self
     */
    public function setNoteNumber($note_number)
    {

        if (is_null($note_number)) {
            throw new \InvalidArgumentException('non-nullable note_number cannot be null');
        }

        $this->container['note_number'] = $note_number;

        return $this;
    }

    /**
     * Gets posts
     *
     * @return \Learnist\Tripletex\Model\YearEndReportNoteData[]|null
     */
    public function getPosts()
    {
        return $this->container['posts'];
    }

    /**
     * Sets posts
     *
     * @param \Learnist\Tripletex\Model\YearEndReportNoteData[]|null $posts posts
     *
     * @return self
     */
    public function setPosts($posts)
    {

        if (is_null($posts)) {
            throw new \InvalidArgumentException('non-nullable posts cannot be null');
        }

        $this->container['posts'] = $posts;

        return $this;
    }

    /**
     * Gets closing_sum_salary
     *
     * @return float|null
     */
    public function getClosingSumSalary()
    {
        return $this->container['closing_sum_salary'];
    }

    /**
     * Sets closing_sum_salary
     *
     * @param float|null $closing_sum_salary closing_sum_salary
     *
     * @return self
     */
    public function setClosingSumSalary($closing_sum_salary)
    {

        if (is_null($closing_sum_salary)) {
            throw new \InvalidArgumentException('non-nullable closing_sum_salary cannot be null');
        }

        $this->container['closing_sum_salary'] = $closing_sum_salary;

        return $this;
    }

    /**
     * Gets opening_sum_salary
     *
     * @return float|null
     */
    public function getOpeningSumSalary()
    {
        return $this->container['opening_sum_salary'];
    }

    /**
     * Sets opening_sum_salary
     *
     * @param float|null $opening_sum_salary opening_sum_salary
     *
     * @return self
     */
    public function setOpeningSumSalary($opening_sum_salary)
    {

        if (is_null($opening_sum_salary)) {
            throw new \InvalidArgumentException('non-nullable opening_sum_salary cannot be null');
        }

        $this->container['opening_sum_salary'] = $opening_sum_salary;

        return $this;
    }

    /**
     * Gets extraordinary_income_posts
     *
     * @return \Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]|null
     */
    public function getExtraordinaryIncomePosts()
    {
        return $this->container['extraordinary_income_posts'];
    }

    /**
     * Sets extraordinary_income_posts
     *
     * @param \Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]|null $extraordinary_income_posts extraordinary_income_posts
     *
     * @return self
     */
    public function setExtraordinaryIncomePosts($extraordinary_income_posts)
    {

        if (is_null($extraordinary_income_posts)) {
            throw new \InvalidArgumentException('non-nullable extraordinary_income_posts cannot be null');
        }

        $this->container['extraordinary_income_posts'] = $extraordinary_income_posts;

        return $this;
    }

    /**
     * Gets extraordinary_cost_posts
     *
     * @return \Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]|null
     */
    public function getExtraordinaryCostPosts()
    {
        return $this->container['extraordinary_cost_posts'];
    }

    /**
     * Sets extraordinary_cost_posts
     *
     * @param \Learnist\Tripletex\Model\ExtraordinaryIncomeAndCost[]|null $extraordinary_cost_posts extraordinary_cost_posts
     *
     * @return self
     */
    public function setExtraordinaryCostPosts($extraordinary_cost_posts)
    {

        if (is_null($extraordinary_cost_posts)) {
            throw new \InvalidArgumentException('non-nullable extraordinary_cost_posts cannot be null');
        }

        $this->container['extraordinary_cost_posts'] = $extraordinary_cost_posts;

        return $this;
    }

    /**
     * Gets sum_extraordinary_income
     *
     * @return object|null
     */
    public function getSumExtraordinaryIncome()
    {
        return $this->container['sum_extraordinary_income'];
    }

    /**
     * Sets sum_extraordinary_income
     *
     * @param object|null $sum_extraordinary_income sum_extraordinary_income
     *
     * @return self
     */
    public function setSumExtraordinaryIncome($sum_extraordinary_income)
    {

        if (is_null($sum_extraordinary_income)) {
            throw new \InvalidArgumentException('non-nullable sum_extraordinary_income cannot be null');
        }

        $this->container['sum_extraordinary_income'] = $sum_extraordinary_income;

        return $this;
    }

    /**
     * Gets sum_extraordinary_cost
     *
     * @return object|null
     */
    public function getSumExtraordinaryCost()
    {
        return $this->container['sum_extraordinary_cost'];
    }

    /**
     * Sets sum_extraordinary_cost
     *
     * @param object|null $sum_extraordinary_cost sum_extraordinary_cost
     *
     * @return self
     */
    public function setSumExtraordinaryCost($sum_extraordinary_cost)
    {

        if (is_null($sum_extraordinary_cost)) {
            throw new \InvalidArgumentException('non-nullable sum_extraordinary_cost cannot be null');
        }

        $this->container['sum_extraordinary_cost'] = $sum_extraordinary_cost;

        return $this;
    }

    /**
     * Gets acquisition_cost_tangible_fixed_assets
     *
     * @return object|null
     */
    public function getAcquisitionCostTangibleFixedAssets()
    {
        return $this->container['acquisition_cost_tangible_fixed_assets'];
    }

    /**
     * Sets acquisition_cost_tangible_fixed_assets
     *
     * @param object|null $acquisition_cost_tangible_fixed_assets acquisition_cost_tangible_fixed_assets
     *
     * @return self
     */
    public function setAcquisitionCostTangibleFixedAssets($acquisition_cost_tangible_fixed_assets)
    {

        if (is_null($acquisition_cost_tangible_fixed_assets)) {
            throw new \InvalidArgumentException('non-nullable acquisition_cost_tangible_fixed_assets cannot be null');
        }

        $this->container['acquisition_cost_tangible_fixed_assets'] = $acquisition_cost_tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets acquisition_cost_intangible_assets
     *
     * @return object|null
     */
    public function getAcquisitionCostIntangibleAssets()
    {
        return $this->container['acquisition_cost_intangible_assets'];
    }

    /**
     * Sets acquisition_cost_intangible_assets
     *
     * @param object|null $acquisition_cost_intangible_assets acquisition_cost_intangible_assets
     *
     * @return self
     */
    public function setAcquisitionCostIntangibleAssets($acquisition_cost_intangible_assets)
    {

        if (is_null($acquisition_cost_intangible_assets)) {
            throw new \InvalidArgumentException('non-nullable acquisition_cost_intangible_assets cannot be null');
        }

        $this->container['acquisition_cost_intangible_assets'] = $acquisition_cost_intangible_assets;

        return $this;
    }

    /**
     * Gets capitalised_value_tangible_fixed_assets
     *
     * @return object|null
     */
    public function getCapitalisedValueTangibleFixedAssets()
    {
        return $this->container['capitalised_value_tangible_fixed_assets'];
    }

    /**
     * Sets capitalised_value_tangible_fixed_assets
     *
     * @param object|null $capitalised_value_tangible_fixed_assets capitalised_value_tangible_fixed_assets
     *
     * @return self
     */
    public function setCapitalisedValueTangibleFixedAssets($capitalised_value_tangible_fixed_assets)
    {

        if (is_null($capitalised_value_tangible_fixed_assets)) {
            throw new \InvalidArgumentException('non-nullable capitalised_value_tangible_fixed_assets cannot be null');
        }

        $this->container['capitalised_value_tangible_fixed_assets'] = $capitalised_value_tangible_fixed_assets;

        return $this;
    }

    /**
     * Gets capitalised_value_intangible_assets
     *
     * @return object|null
     */
    public function getCapitalisedValueIntangibleAssets()
    {
        return $this->container['capitalised_value_intangible_assets'];
    }

    /**
     * Sets capitalised_value_intangible_assets
     *
     * @param object|null $capitalised_value_intangible_assets capitalised_value_intangible_assets
     *
     * @return self
     */
    public function setCapitalisedValueIntangibleAssets($capitalised_value_intangible_assets)
    {

        if (is_null($capitalised_value_intangible_assets)) {
            throw new \InvalidArgumentException('non-nullable capitalised_value_intangible_assets cannot be null');
        }

        $this->container['capitalised_value_intangible_assets'] = $capitalised_value_intangible_assets;

        return $this;
    }

    /**
     * Gets investments_posts
     *
     * @return \Learnist\Tripletex\Model\GroupInvestment[]|null
     */
    public function getInvestmentsPosts()
    {
        return $this->container['investments_posts'];
    }

    /**
     * Sets investments_posts
     *
     * @param \Learnist\Tripletex\Model\GroupInvestment[]|null $investments_posts investments_posts
     *
     * @return self
     */
    public function setInvestmentsPosts($investments_posts)
    {

        if (is_null($investments_posts)) {
            throw new \InvalidArgumentException('non-nullable investments_posts cannot be null');
        }

        $this->container['investments_posts'] = $investments_posts;

        return $this;
    }

    /**
     * Gets asset_posts
     *
     * @return \Learnist\Tripletex\Model\FinacialInstrumentAsset[]|null
     */
    public function getAssetPosts()
    {
        return $this->container['asset_posts'];
    }

    /**
     * Sets asset_posts
     *
     * @param \Learnist\Tripletex\Model\FinacialInstrumentAsset[]|null $asset_posts asset_posts
     *
     * @return self
     */
    public function setAssetPosts($asset_posts)
    {

        if (is_null($asset_posts)) {
            throw new \InvalidArgumentException('non-nullable asset_posts cannot be null');
        }

        $this->container['asset_posts'] = $asset_posts;

        return $this;
    }

    /**
     * Gets sum_real_value
     *
     * @return object|null
     */
    public function getSumRealValue()
    {
        return $this->container['sum_real_value'];
    }

    /**
     * Sets sum_real_value
     *
     * @param object|null $sum_real_value sum_real_value
     *
     * @return self
     */
    public function setSumRealValue($sum_real_value)
    {

        if (is_null($sum_real_value)) {
            throw new \InvalidArgumentException('non-nullable sum_real_value cannot be null');
        }

        $this->container['sum_real_value'] = $sum_real_value;

        return $this;
    }

    /**
     * Gets sum_value_adjustment
     *
     * @return object|null
     */
    public function getSumValueAdjustment()
    {
        return $this->container['sum_value_adjustment'];
    }

    /**
     * Sets sum_value_adjustment
     *
     * @param object|null $sum_value_adjustment sum_value_adjustment
     *
     * @return self
     */
    public function setSumValueAdjustment($sum_value_adjustment)
    {

        if (is_null($sum_value_adjustment)) {
            throw new \InvalidArgumentException('non-nullable sum_value_adjustment cannot be null');
        }

        $this->container['sum_value_adjustment'] = $sum_value_adjustment;

        return $this;
    }

    /**
     * Gets note_text_library
     *
     * @return \Learnist\Tripletex\Model\NoteTextLibrary[]|null
     */
    public function getNoteTextLibrary()
    {
        return $this->container['note_text_library'];
    }

    /**
     * Sets note_text_library
     *
     * @param \Learnist\Tripletex\Model\NoteTextLibrary[]|null $note_text_library note_text_library
     *
     * @return self
     */
    public function setNoteTextLibrary($note_text_library)
    {

        if (is_null($note_text_library)) {
            throw new \InvalidArgumentException('non-nullable note_text_library cannot be null');
        }

        $this->container['note_text_library'] = $note_text_library;

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


