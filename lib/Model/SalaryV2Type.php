<?php
/**
 * SalaryV2Type
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
 * SalaryV2Type Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalaryV2Type implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalaryV2Type';

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
        'number' => 'string',
        'name' => 'string',
        'display_name' => 'string',
        'pay_statement_code' => 'string',
        'description' => 'string',
        'show_in_timesheet' => 'bool',
        'taxable' => 'bool',
        'payroll_taxable' => 'bool',
        'vacation_payable' => 'bool',
        'sick_payable' => 'bool',
        'payment' => 'bool',
        'vacation_allowance' => 'bool',
        'requires_additional_info' => 'bool',
        'requires_supplement' => 'bool',
        'required_supplement_fields' => 'string[]',
        'rate' => 'float',
        'percent_increase' => 'float',
        'max_rate' => 'float',
        'calc_type' => 'int'
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
        'number' => null,
        'name' => null,
        'display_name' => null,
        'pay_statement_code' => null,
        'description' => null,
        'show_in_timesheet' => null,
        'taxable' => null,
        'payroll_taxable' => null,
        'vacation_payable' => null,
        'sick_payable' => null,
        'payment' => null,
        'vacation_allowance' => null,
        'requires_additional_info' => null,
        'requires_supplement' => null,
        'required_supplement_fields' => null,
        'rate' => null,
        'percent_increase' => null,
        'max_rate' => null,
        'calc_type' => 'int32'
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
		'number' => false,
		'name' => false,
		'display_name' => false,
		'pay_statement_code' => false,
		'description' => false,
		'show_in_timesheet' => false,
		'taxable' => false,
		'payroll_taxable' => false,
		'vacation_payable' => false,
		'sick_payable' => false,
		'payment' => false,
		'vacation_allowance' => false,
		'requires_additional_info' => false,
		'requires_supplement' => false,
		'required_supplement_fields' => false,
		'rate' => false,
		'percent_increase' => false,
		'max_rate' => false,
		'calc_type' => false
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
        'number' => 'number',
        'name' => 'name',
        'display_name' => 'displayName',
        'pay_statement_code' => 'payStatementCode',
        'description' => 'description',
        'show_in_timesheet' => 'showInTimesheet',
        'taxable' => 'taxable',
        'payroll_taxable' => 'payrollTaxable',
        'vacation_payable' => 'vacationPayable',
        'sick_payable' => 'sickPayable',
        'payment' => 'payment',
        'vacation_allowance' => 'vacationAllowance',
        'requires_additional_info' => 'requiresAdditionalInfo',
        'requires_supplement' => 'requiresSupplement',
        'required_supplement_fields' => 'requiredSupplementFields',
        'rate' => 'rate',
        'percent_increase' => 'percentIncrease',
        'max_rate' => 'maxRate',
        'calc_type' => 'calcType'
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
        'number' => 'setNumber',
        'name' => 'setName',
        'display_name' => 'setDisplayName',
        'pay_statement_code' => 'setPayStatementCode',
        'description' => 'setDescription',
        'show_in_timesheet' => 'setShowInTimesheet',
        'taxable' => 'setTaxable',
        'payroll_taxable' => 'setPayrollTaxable',
        'vacation_payable' => 'setVacationPayable',
        'sick_payable' => 'setSickPayable',
        'payment' => 'setPayment',
        'vacation_allowance' => 'setVacationAllowance',
        'requires_additional_info' => 'setRequiresAdditionalInfo',
        'requires_supplement' => 'setRequiresSupplement',
        'required_supplement_fields' => 'setRequiredSupplementFields',
        'rate' => 'setRate',
        'percent_increase' => 'setPercentIncrease',
        'max_rate' => 'setMaxRate',
        'calc_type' => 'setCalcType'
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
        'number' => 'getNumber',
        'name' => 'getName',
        'display_name' => 'getDisplayName',
        'pay_statement_code' => 'getPayStatementCode',
        'description' => 'getDescription',
        'show_in_timesheet' => 'getShowInTimesheet',
        'taxable' => 'getTaxable',
        'payroll_taxable' => 'getPayrollTaxable',
        'vacation_payable' => 'getVacationPayable',
        'sick_payable' => 'getSickPayable',
        'payment' => 'getPayment',
        'vacation_allowance' => 'getVacationAllowance',
        'requires_additional_info' => 'getRequiresAdditionalInfo',
        'requires_supplement' => 'getRequiresSupplement',
        'required_supplement_fields' => 'getRequiredSupplementFields',
        'rate' => 'getRate',
        'percent_increase' => 'getPercentIncrease',
        'max_rate' => 'getMaxRate',
        'calc_type' => 'getCalcType'
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

    public const REQUIRED_SUPPLEMENT_FIELDS_COUNTRY = 'COUNTRY';
    public const REQUIRED_SUPPLEMENT_FIELDS_TAX_COUNTRY = 'TAX_COUNTRY';
    public const REQUIRED_SUPPLEMENT_FIELDS_CAR_NUMBER_OF_KM = 'CAR_NUMBER_OF_KM';
    public const REQUIRED_SUPPLEMENT_FIELDS_CAR_NUMBER_OF_KM_TO_HOME_OR_WORK = 'CAR_NUMBER_OF_KM_TO_HOME_OR_WORK';
    public const REQUIRED_SUPPLEMENT_FIELDS_CAR_LIST_PRICE = 'CAR_LIST_PRICE';
    public const REQUIRED_SUPPLEMENT_FIELDS_CAR_REGISTRATION_NUMBER = 'CAR_REGISTRATION_NUMBER';
    public const REQUIRED_SUPPLEMENT_FIELDS_NUMBER_OF_JOURNEYS = 'NUMBER_OF_JOURNEYS';
    public const REQUIRED_SUPPLEMENT_FIELDS_UPGROSSING_BASIS = 'UPGROSSING_BASIS';
    public const REQUIRED_SUPPLEMENT_FIELDS_UPGROSSING_TABLE_NUMBER = 'UPGROSSING_TABLE_NUMBER';
    public const REQUIRED_SUPPLEMENT_FIELDS_YEAR_OF_INCOME = 'YEAR_OF_INCOME';
    public const REQUIRED_SUPPLEMENT_FIELDS_DEDUCTED_ARTIST_TAX = 'DEDUCTED_ARTIST_TAX';
    public const REQUIRED_SUPPLEMENT_FIELDS_TAX_PAID_ABROAD = 'TAX_PAID_ABROAD';
    public const REQUIRED_SUPPLEMENT_FIELDS_SUPPORT_VESSEL = 'SUPPORT_VESSEL';
    public const REQUIRED_SUPPLEMENT_FIELDS_IS_CONTINENTAL_SHAFT = 'IS_CONTINENTAL_SHAFT';
    public const REQUIRED_SUPPLEMENT_FIELDS_NORWEGIAN_SHAFT_PERIOD = 'NORWEGIAN_SHAFT_PERIOD';
    public const REQUIRED_SUPPLEMENT_FIELDS_NORWEGIAN_SHAFT_FIRST_60_DAYS = 'NORWEGIAN_SHAFT_FIRST_60_DAYS';
    public const REQUIRED_SUPPLEMENT_FIELDS_NUMBER_OF_DAYS = 'NUMBER_OF_DAYS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRequiredSupplementFieldsAllowableValues()
    {
        return [
            self::REQUIRED_SUPPLEMENT_FIELDS_COUNTRY,
            self::REQUIRED_SUPPLEMENT_FIELDS_TAX_COUNTRY,
            self::REQUIRED_SUPPLEMENT_FIELDS_CAR_NUMBER_OF_KM,
            self::REQUIRED_SUPPLEMENT_FIELDS_CAR_NUMBER_OF_KM_TO_HOME_OR_WORK,
            self::REQUIRED_SUPPLEMENT_FIELDS_CAR_LIST_PRICE,
            self::REQUIRED_SUPPLEMENT_FIELDS_CAR_REGISTRATION_NUMBER,
            self::REQUIRED_SUPPLEMENT_FIELDS_NUMBER_OF_JOURNEYS,
            self::REQUIRED_SUPPLEMENT_FIELDS_UPGROSSING_BASIS,
            self::REQUIRED_SUPPLEMENT_FIELDS_UPGROSSING_TABLE_NUMBER,
            self::REQUIRED_SUPPLEMENT_FIELDS_YEAR_OF_INCOME,
            self::REQUIRED_SUPPLEMENT_FIELDS_DEDUCTED_ARTIST_TAX,
            self::REQUIRED_SUPPLEMENT_FIELDS_TAX_PAID_ABROAD,
            self::REQUIRED_SUPPLEMENT_FIELDS_SUPPORT_VESSEL,
            self::REQUIRED_SUPPLEMENT_FIELDS_IS_CONTINENTAL_SHAFT,
            self::REQUIRED_SUPPLEMENT_FIELDS_NORWEGIAN_SHAFT_PERIOD,
            self::REQUIRED_SUPPLEMENT_FIELDS_NORWEGIAN_SHAFT_FIRST_60_DAYS,
            self::REQUIRED_SUPPLEMENT_FIELDS_NUMBER_OF_DAYS,
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
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('pay_statement_code', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('show_in_timesheet', $data ?? [], null);
        $this->setIfExists('taxable', $data ?? [], null);
        $this->setIfExists('payroll_taxable', $data ?? [], null);
        $this->setIfExists('vacation_payable', $data ?? [], null);
        $this->setIfExists('sick_payable', $data ?? [], null);
        $this->setIfExists('payment', $data ?? [], null);
        $this->setIfExists('vacation_allowance', $data ?? [], null);
        $this->setIfExists('requires_additional_info', $data ?? [], null);
        $this->setIfExists('requires_supplement', $data ?? [], null);
        $this->setIfExists('required_supplement_fields', $data ?? [], null);
        $this->setIfExists('rate', $data ?? [], null);
        $this->setIfExists('percent_increase', $data ?? [], null);
        $this->setIfExists('max_rate', $data ?? [], null);
        $this->setIfExists('calc_type', $data ?? [], null);
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

        if (!is_null($this->container['number']) && (mb_strlen($this->container['number']) > 10)) {
            $invalidProperties[] = "invalid value for 'number', the character length must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['name']) && (mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
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
     * Gets number
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string|null $number number
     *
     * @return self
     */
    public function setNumber($number)
    {
        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }
        if ((mb_strlen($number) > 10)) {
            throw new \InvalidArgumentException('invalid length for $number when calling SalaryV2Type., must be smaller than or equal to 10.');
        }

        $this->container['number'] = $number;

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
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling SalaryV2Type., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets pay_statement_code
     *
     * @return string|null
     */
    public function getPayStatementCode()
    {
        return $this->container['pay_statement_code'];
    }

    /**
     * Sets pay_statement_code
     *
     * @param string|null $pay_statement_code pay_statement_code
     *
     * @return self
     */
    public function setPayStatementCode($pay_statement_code)
    {
        if (is_null($pay_statement_code)) {
            throw new \InvalidArgumentException('non-nullable pay_statement_code cannot be null');
        }
        $this->container['pay_statement_code'] = $pay_statement_code;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets show_in_timesheet
     *
     * @return bool|null
     */
    public function getShowInTimesheet()
    {
        return $this->container['show_in_timesheet'];
    }

    /**
     * Sets show_in_timesheet
     *
     * @param bool|null $show_in_timesheet show_in_timesheet
     *
     * @return self
     */
    public function setShowInTimesheet($show_in_timesheet)
    {
        if (is_null($show_in_timesheet)) {
            throw new \InvalidArgumentException('non-nullable show_in_timesheet cannot be null');
        }
        $this->container['show_in_timesheet'] = $show_in_timesheet;

        return $this;
    }

    /**
     * Gets taxable
     *
     * @return bool|null
     */
    public function getTaxable()
    {
        return $this->container['taxable'];
    }

    /**
     * Sets taxable
     *
     * @param bool|null $taxable taxable
     *
     * @return self
     */
    public function setTaxable($taxable)
    {
        if (is_null($taxable)) {
            throw new \InvalidArgumentException('non-nullable taxable cannot be null');
        }
        $this->container['taxable'] = $taxable;

        return $this;
    }

    /**
     * Gets payroll_taxable
     *
     * @return bool|null
     */
    public function getPayrollTaxable()
    {
        return $this->container['payroll_taxable'];
    }

    /**
     * Sets payroll_taxable
     *
     * @param bool|null $payroll_taxable payroll_taxable
     *
     * @return self
     */
    public function setPayrollTaxable($payroll_taxable)
    {
        if (is_null($payroll_taxable)) {
            throw new \InvalidArgumentException('non-nullable payroll_taxable cannot be null');
        }
        $this->container['payroll_taxable'] = $payroll_taxable;

        return $this;
    }

    /**
     * Gets vacation_payable
     *
     * @return bool|null
     */
    public function getVacationPayable()
    {
        return $this->container['vacation_payable'];
    }

    /**
     * Sets vacation_payable
     *
     * @param bool|null $vacation_payable vacation_payable
     *
     * @return self
     */
    public function setVacationPayable($vacation_payable)
    {
        if (is_null($vacation_payable)) {
            throw new \InvalidArgumentException('non-nullable vacation_payable cannot be null');
        }
        $this->container['vacation_payable'] = $vacation_payable;

        return $this;
    }

    /**
     * Gets sick_payable
     *
     * @return bool|null
     */
    public function getSickPayable()
    {
        return $this->container['sick_payable'];
    }

    /**
     * Sets sick_payable
     *
     * @param bool|null $sick_payable sick_payable
     *
     * @return self
     */
    public function setSickPayable($sick_payable)
    {
        if (is_null($sick_payable)) {
            throw new \InvalidArgumentException('non-nullable sick_payable cannot be null');
        }
        $this->container['sick_payable'] = $sick_payable;

        return $this;
    }

    /**
     * Gets payment
     *
     * @return bool|null
     */
    public function getPayment()
    {
        return $this->container['payment'];
    }

    /**
     * Sets payment
     *
     * @param bool|null $payment payment
     *
     * @return self
     */
    public function setPayment($payment)
    {
        if (is_null($payment)) {
            throw new \InvalidArgumentException('non-nullable payment cannot be null');
        }
        $this->container['payment'] = $payment;

        return $this;
    }

    /**
     * Gets vacation_allowance
     *
     * @return bool|null
     */
    public function getVacationAllowance()
    {
        return $this->container['vacation_allowance'];
    }

    /**
     * Sets vacation_allowance
     *
     * @param bool|null $vacation_allowance vacation_allowance
     *
     * @return self
     */
    public function setVacationAllowance($vacation_allowance)
    {
        if (is_null($vacation_allowance)) {
            throw new \InvalidArgumentException('non-nullable vacation_allowance cannot be null');
        }
        $this->container['vacation_allowance'] = $vacation_allowance;

        return $this;
    }

    /**
     * Gets requires_additional_info
     *
     * @return bool|null
     */
    public function getRequiresAdditionalInfo()
    {
        return $this->container['requires_additional_info'];
    }

    /**
     * Sets requires_additional_info
     *
     * @param bool|null $requires_additional_info requires_additional_info
     *
     * @return self
     */
    public function setRequiresAdditionalInfo($requires_additional_info)
    {
        if (is_null($requires_additional_info)) {
            throw new \InvalidArgumentException('non-nullable requires_additional_info cannot be null');
        }
        $this->container['requires_additional_info'] = $requires_additional_info;

        return $this;
    }

    /**
     * Gets requires_supplement
     *
     * @return bool|null
     */
    public function getRequiresSupplement()
    {
        return $this->container['requires_supplement'];
    }

    /**
     * Sets requires_supplement
     *
     * @param bool|null $requires_supplement requires_supplement
     *
     * @return self
     */
    public function setRequiresSupplement($requires_supplement)
    {
        if (is_null($requires_supplement)) {
            throw new \InvalidArgumentException('non-nullable requires_supplement cannot be null');
        }
        $this->container['requires_supplement'] = $requires_supplement;

        return $this;
    }

    /**
     * Gets required_supplement_fields
     *
     * @return string[]|null
     */
    public function getRequiredSupplementFields()
    {
        return $this->container['required_supplement_fields'];
    }

    /**
     * Sets required_supplement_fields
     *
     * @param string[]|null $required_supplement_fields required_supplement_fields
     *
     * @return self
     */
    public function setRequiredSupplementFields($required_supplement_fields)
    {
        if (is_null($required_supplement_fields)) {
            throw new \InvalidArgumentException('non-nullable required_supplement_fields cannot be null');
        }
        $allowedValues = $this->getRequiredSupplementFieldsAllowableValues();
        if (array_diff($required_supplement_fields, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'required_supplement_fields', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['required_supplement_fields'] = $required_supplement_fields;

        return $this;
    }

    /**
     * Gets rate
     *
     * @return float|null
     */
    public function getRate()
    {
        return $this->container['rate'];
    }

    /**
     * Sets rate
     *
     * @param float|null $rate rate
     *
     * @return self
     */
    public function setRate($rate)
    {
        if (is_null($rate)) {
            throw new \InvalidArgumentException('non-nullable rate cannot be null');
        }
        $this->container['rate'] = $rate;

        return $this;
    }

    /**
     * Gets percent_increase
     *
     * @return float|null
     */
    public function getPercentIncrease()
    {
        return $this->container['percent_increase'];
    }

    /**
     * Sets percent_increase
     *
     * @param float|null $percent_increase percent_increase
     *
     * @return self
     */
    public function setPercentIncrease($percent_increase)
    {
        if (is_null($percent_increase)) {
            throw new \InvalidArgumentException('non-nullable percent_increase cannot be null');
        }
        $this->container['percent_increase'] = $percent_increase;

        return $this;
    }

    /**
     * Gets max_rate
     *
     * @return float|null
     */
    public function getMaxRate()
    {
        return $this->container['max_rate'];
    }

    /**
     * Sets max_rate
     *
     * @param float|null $max_rate max_rate
     *
     * @return self
     */
    public function setMaxRate($max_rate)
    {
        if (is_null($max_rate)) {
            throw new \InvalidArgumentException('non-nullable max_rate cannot be null');
        }
        $this->container['max_rate'] = $max_rate;

        return $this;
    }

    /**
     * Gets calc_type
     *
     * @return int|null
     */
    public function getCalcType()
    {
        return $this->container['calc_type'];
    }

    /**
     * Sets calc_type
     *
     * @param int|null $calc_type calc_type
     *
     * @return self
     */
    public function setCalcType($calc_type)
    {
        if (is_null($calc_type)) {
            throw new \InvalidArgumentException('non-nullable calc_type cannot be null');
        }
        $this->container['calc_type'] = $calc_type;

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


