<?php
/**
 * EmploymentDetails
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
 * EmploymentDetails Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EmploymentDetails implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EmploymentDetails';

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
        'employment' => '\Learnist\Tripletex\Model\Employment',
        'date' => 'string',
        'employment_type' => 'string',
        'employment_form' => 'string',
        'maritime_employment' => '\Learnist\Tripletex\Model\MaritimeEmployment',
        'remuneration_type' => 'string',
        'working_hours_scheme' => 'string',
        'shift_duration_hours' => 'float',
        'occupation_code' => '\Learnist\Tripletex\Model\OccupationCode',
        'percentage_of_full_time_equivalent' => 'float',
        'annual_salary' => 'float',
        'hourly_wage' => 'float',
        'payroll_tax_municipality_id' => '\Learnist\Tripletex\Model\Municipality'
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
        'employment' => null,
        'date' => null,
        'employment_type' => null,
        'employment_form' => null,
        'maritime_employment' => null,
        'remuneration_type' => null,
        'working_hours_scheme' => null,
        'shift_duration_hours' => null,
        'occupation_code' => null,
        'percentage_of_full_time_equivalent' => null,
        'annual_salary' => null,
        'hourly_wage' => null,
        'payroll_tax_municipality_id' => null
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
		'employment' => false,
		'date' => false,
		'employment_type' => false,
		'employment_form' => false,
		'maritime_employment' => false,
		'remuneration_type' => false,
		'working_hours_scheme' => false,
		'shift_duration_hours' => false,
		'occupation_code' => false,
		'percentage_of_full_time_equivalent' => false,
		'annual_salary' => false,
		'hourly_wage' => false,
		'payroll_tax_municipality_id' => false
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
        'employment' => 'employment',
        'date' => 'date',
        'employment_type' => 'employmentType',
        'employment_form' => 'employmentForm',
        'maritime_employment' => 'maritimeEmployment',
        'remuneration_type' => 'remunerationType',
        'working_hours_scheme' => 'workingHoursScheme',
        'shift_duration_hours' => 'shiftDurationHours',
        'occupation_code' => 'occupationCode',
        'percentage_of_full_time_equivalent' => 'percentageOfFullTimeEquivalent',
        'annual_salary' => 'annualSalary',
        'hourly_wage' => 'hourlyWage',
        'payroll_tax_municipality_id' => 'payrollTaxMunicipalityId'
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
        'employment' => 'setEmployment',
        'date' => 'setDate',
        'employment_type' => 'setEmploymentType',
        'employment_form' => 'setEmploymentForm',
        'maritime_employment' => 'setMaritimeEmployment',
        'remuneration_type' => 'setRemunerationType',
        'working_hours_scheme' => 'setWorkingHoursScheme',
        'shift_duration_hours' => 'setShiftDurationHours',
        'occupation_code' => 'setOccupationCode',
        'percentage_of_full_time_equivalent' => 'setPercentageOfFullTimeEquivalent',
        'annual_salary' => 'setAnnualSalary',
        'hourly_wage' => 'setHourlyWage',
        'payroll_tax_municipality_id' => 'setPayrollTaxMunicipalityId'
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
        'employment' => 'getEmployment',
        'date' => 'getDate',
        'employment_type' => 'getEmploymentType',
        'employment_form' => 'getEmploymentForm',
        'maritime_employment' => 'getMaritimeEmployment',
        'remuneration_type' => 'getRemunerationType',
        'working_hours_scheme' => 'getWorkingHoursScheme',
        'shift_duration_hours' => 'getShiftDurationHours',
        'occupation_code' => 'getOccupationCode',
        'percentage_of_full_time_equivalent' => 'getPercentageOfFullTimeEquivalent',
        'annual_salary' => 'getAnnualSalary',
        'hourly_wage' => 'getHourlyWage',
        'payroll_tax_municipality_id' => 'getPayrollTaxMunicipalityId'
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

    public const EMPLOYMENT_TYPE_ORDINARY = 'ORDINARY';
    public const EMPLOYMENT_TYPE_MARITIME = 'MARITIME';
    public const EMPLOYMENT_TYPE_FREELANCE = 'FREELANCE';
    public const EMPLOYMENT_FORM_PERMANENT = 'PERMANENT';
    public const EMPLOYMENT_FORM_TEMPORARY = 'TEMPORARY';
    public const REMUNERATION_TYPE_MONTHLY_WAGE = 'MONTHLY_WAGE';
    public const REMUNERATION_TYPE_HOURLY_WAGE = 'HOURLY_WAGE';
    public const REMUNERATION_TYPE_COMMISION_PERCENTAGE = 'COMMISION_PERCENTAGE';
    public const REMUNERATION_TYPE_FEE = 'FEE';
    public const REMUNERATION_TYPE_PIECEWORK_WAGE = 'PIECEWORK_WAGE';
    public const WORKING_HOURS_SCHEME_NOT_SHIFT = 'NOT_SHIFT';
    public const WORKING_HOURS_SCHEME_ROUND_THE_CLOCK = 'ROUND_THE_CLOCK';
    public const WORKING_HOURS_SCHEME_SHIFT_365 = 'SHIFT_365';
    public const WORKING_HOURS_SCHEME_OFFSHORE_336 = 'OFFSHORE_336';
    public const WORKING_HOURS_SCHEME_CONTINUOUS = 'CONTINUOUS';
    public const WORKING_HOURS_SCHEME_OTHER_SHIFT = 'OTHER_SHIFT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEmploymentTypeAllowableValues()
    {
        return [
            self::EMPLOYMENT_TYPE_ORDINARY,
            self::EMPLOYMENT_TYPE_MARITIME,
            self::EMPLOYMENT_TYPE_FREELANCE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEmploymentFormAllowableValues()
    {
        return [
            self::EMPLOYMENT_FORM_PERMANENT,
            self::EMPLOYMENT_FORM_TEMPORARY,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRemunerationTypeAllowableValues()
    {
        return [
            self::REMUNERATION_TYPE_MONTHLY_WAGE,
            self::REMUNERATION_TYPE_HOURLY_WAGE,
            self::REMUNERATION_TYPE_COMMISION_PERCENTAGE,
            self::REMUNERATION_TYPE_FEE,
            self::REMUNERATION_TYPE_PIECEWORK_WAGE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getWorkingHoursSchemeAllowableValues()
    {
        return [
            self::WORKING_HOURS_SCHEME_NOT_SHIFT,
            self::WORKING_HOURS_SCHEME_ROUND_THE_CLOCK,
            self::WORKING_HOURS_SCHEME_SHIFT_365,
            self::WORKING_HOURS_SCHEME_OFFSHORE_336,
            self::WORKING_HOURS_SCHEME_CONTINUOUS,
            self::WORKING_HOURS_SCHEME_OTHER_SHIFT,
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
        $this->setIfExists('employment', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('employment_type', $data ?? [], null);
        $this->setIfExists('employment_form', $data ?? [], null);
        $this->setIfExists('maritime_employment', $data ?? [], null);
        $this->setIfExists('remuneration_type', $data ?? [], null);
        $this->setIfExists('working_hours_scheme', $data ?? [], null);
        $this->setIfExists('shift_duration_hours', $data ?? [], null);
        $this->setIfExists('occupation_code', $data ?? [], null);
        $this->setIfExists('percentage_of_full_time_equivalent', $data ?? [], null);
        $this->setIfExists('annual_salary', $data ?? [], null);
        $this->setIfExists('hourly_wage', $data ?? [], null);
        $this->setIfExists('payroll_tax_municipality_id', $data ?? [], null);
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

        $allowedValues = $this->getEmploymentTypeAllowableValues();
        if (!is_null($this->container['employment_type']) && !in_array($this->container['employment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'employment_type', must be one of '%s'",
                $this->container['employment_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getEmploymentFormAllowableValues();
        if (!is_null($this->container['employment_form']) && !in_array($this->container['employment_form'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'employment_form', must be one of '%s'",
                $this->container['employment_form'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getRemunerationTypeAllowableValues();
        if (!is_null($this->container['remuneration_type']) && !in_array($this->container['remuneration_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'remuneration_type', must be one of '%s'",
                $this->container['remuneration_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getWorkingHoursSchemeAllowableValues();
        if (!is_null($this->container['working_hours_scheme']) && !in_array($this->container['working_hours_scheme'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'working_hours_scheme', must be one of '%s'",
                $this->container['working_hours_scheme'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['percentage_of_full_time_equivalent'] === null) {
            $invalidProperties[] = "'percentage_of_full_time_equivalent' can't be null";
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
     * Gets employment
     *
     * @return \Learnist\Tripletex\Model\Employment|null
     */
    public function getEmployment()
    {
        return $this->container['employment'];
    }

    /**
     * Sets employment
     *
     * @param \Learnist\Tripletex\Model\Employment|null $employment employment
     *
     * @return self
     */
    public function setEmployment($employment)
    {

        if (is_null($employment)) {
            throw new \InvalidArgumentException('non-nullable employment cannot be null');
        }

        $this->container['employment'] = $employment;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {

        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }

        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets employment_type
     *
     * @return string|null
     */
    public function getEmploymentType()
    {
        return $this->container['employment_type'];
    }

    /**
     * Sets employment_type
     *
     * @param string|null $employment_type Define the employment type.
     *
     * @return self
     */
    public function setEmploymentType($employment_type)
    {
        $allowedValues = $this->getEmploymentTypeAllowableValues();
        if (!is_null($employment_type) && !in_array($employment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'employment_type', must be one of '%s'",
                    $employment_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($employment_type)) {
            throw new \InvalidArgumentException('non-nullable employment_type cannot be null');
        }

        $this->container['employment_type'] = $employment_type;

        return $this;
    }

    /**
     * Gets employment_form
     *
     * @return string|null
     */
    public function getEmploymentForm()
    {
        return $this->container['employment_form'];
    }

    /**
     * Sets employment_form
     *
     * @param string|null $employment_form Define the employment form.
     *
     * @return self
     */
    public function setEmploymentForm($employment_form)
    {
        $allowedValues = $this->getEmploymentFormAllowableValues();
        if (!is_null($employment_form) && !in_array($employment_form, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'employment_form', must be one of '%s'",
                    $employment_form,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($employment_form)) {
            throw new \InvalidArgumentException('non-nullable employment_form cannot be null');
        }

        $this->container['employment_form'] = $employment_form;

        return $this;
    }

    /**
     * Gets maritime_employment
     *
     * @return \Learnist\Tripletex\Model\MaritimeEmployment|null
     */
    public function getMaritimeEmployment()
    {
        return $this->container['maritime_employment'];
    }

    /**
     * Sets maritime_employment
     *
     * @param \Learnist\Tripletex\Model\MaritimeEmployment|null $maritime_employment maritime_employment
     *
     * @return self
     */
    public function setMaritimeEmployment($maritime_employment)
    {

        if (is_null($maritime_employment)) {
            throw new \InvalidArgumentException('non-nullable maritime_employment cannot be null');
        }

        $this->container['maritime_employment'] = $maritime_employment;

        return $this;
    }

    /**
     * Gets remuneration_type
     *
     * @return string|null
     */
    public function getRemunerationType()
    {
        return $this->container['remuneration_type'];
    }

    /**
     * Sets remuneration_type
     *
     * @param string|null $remuneration_type Define the remuneration type.
     *
     * @return self
     */
    public function setRemunerationType($remuneration_type)
    {
        $allowedValues = $this->getRemunerationTypeAllowableValues();
        if (!is_null($remuneration_type) && !in_array($remuneration_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'remuneration_type', must be one of '%s'",
                    $remuneration_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($remuneration_type)) {
            throw new \InvalidArgumentException('non-nullable remuneration_type cannot be null');
        }

        $this->container['remuneration_type'] = $remuneration_type;

        return $this;
    }

    /**
     * Gets working_hours_scheme
     *
     * @return string|null
     */
    public function getWorkingHoursScheme()
    {
        return $this->container['working_hours_scheme'];
    }

    /**
     * Sets working_hours_scheme
     *
     * @param string|null $working_hours_scheme Define the working hours scheme type. If you enter a value for SHIFT WORK, you must also enter value for shiftDurationHours
     *
     * @return self
     */
    public function setWorkingHoursScheme($working_hours_scheme)
    {
        $allowedValues = $this->getWorkingHoursSchemeAllowableValues();
        if (!is_null($working_hours_scheme) && !in_array($working_hours_scheme, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'working_hours_scheme', must be one of '%s'",
                    $working_hours_scheme,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($working_hours_scheme)) {
            throw new \InvalidArgumentException('non-nullable working_hours_scheme cannot be null');
        }

        $this->container['working_hours_scheme'] = $working_hours_scheme;

        return $this;
    }

    /**
     * Gets shift_duration_hours
     *
     * @return float|null
     */
    public function getShiftDurationHours()
    {
        return $this->container['shift_duration_hours'];
    }

    /**
     * Sets shift_duration_hours
     *
     * @param float|null $shift_duration_hours shift_duration_hours
     *
     * @return self
     */
    public function setShiftDurationHours($shift_duration_hours)
    {

        if (is_null($shift_duration_hours)) {
            throw new \InvalidArgumentException('non-nullable shift_duration_hours cannot be null');
        }

        $this->container['shift_duration_hours'] = $shift_duration_hours;

        return $this;
    }

    /**
     * Gets occupation_code
     *
     * @return \Learnist\Tripletex\Model\OccupationCode|null
     */
    public function getOccupationCode()
    {
        return $this->container['occupation_code'];
    }

    /**
     * Sets occupation_code
     *
     * @param \Learnist\Tripletex\Model\OccupationCode|null $occupation_code occupation_code
     *
     * @return self
     */
    public function setOccupationCode($occupation_code)
    {

        if (is_null($occupation_code)) {
            throw new \InvalidArgumentException('non-nullable occupation_code cannot be null');
        }

        $this->container['occupation_code'] = $occupation_code;

        return $this;
    }

    /**
     * Gets percentage_of_full_time_equivalent
     *
     * @return float
     */
    public function getPercentageOfFullTimeEquivalent()
    {
        return $this->container['percentage_of_full_time_equivalent'];
    }

    /**
     * Sets percentage_of_full_time_equivalent
     *
     * @param float $percentage_of_full_time_equivalent percentage_of_full_time_equivalent
     *
     * @return self
     */
    public function setPercentageOfFullTimeEquivalent($percentage_of_full_time_equivalent)
    {

        if (is_null($percentage_of_full_time_equivalent)) {
            throw new \InvalidArgumentException('non-nullable percentage_of_full_time_equivalent cannot be null');
        }

        $this->container['percentage_of_full_time_equivalent'] = $percentage_of_full_time_equivalent;

        return $this;
    }

    /**
     * Gets annual_salary
     *
     * @return float|null
     */
    public function getAnnualSalary()
    {
        return $this->container['annual_salary'];
    }

    /**
     * Sets annual_salary
     *
     * @param float|null $annual_salary annual_salary
     *
     * @return self
     */
    public function setAnnualSalary($annual_salary)
    {

        if (is_null($annual_salary)) {
            throw new \InvalidArgumentException('non-nullable annual_salary cannot be null');
        }

        $this->container['annual_salary'] = $annual_salary;

        return $this;
    }

    /**
     * Gets hourly_wage
     *
     * @return float|null
     */
    public function getHourlyWage()
    {
        return $this->container['hourly_wage'];
    }

    /**
     * Sets hourly_wage
     *
     * @param float|null $hourly_wage hourly_wage
     *
     * @return self
     */
    public function setHourlyWage($hourly_wage)
    {

        if (is_null($hourly_wage)) {
            throw new \InvalidArgumentException('non-nullable hourly_wage cannot be null');
        }

        $this->container['hourly_wage'] = $hourly_wage;

        return $this;
    }

    /**
     * Gets payroll_tax_municipality_id
     *
     * @return \Learnist\Tripletex\Model\Municipality|null
     */
    public function getPayrollTaxMunicipalityId()
    {
        return $this->container['payroll_tax_municipality_id'];
    }

    /**
     * Sets payroll_tax_municipality_id
     *
     * @param \Learnist\Tripletex\Model\Municipality|null $payroll_tax_municipality_id payroll_tax_municipality_id
     *
     * @return self
     */
    public function setPayrollTaxMunicipalityId($payroll_tax_municipality_id)
    {

        if (is_null($payroll_tax_municipality_id)) {
            throw new \InvalidArgumentException('non-nullable payroll_tax_municipality_id cannot be null');
        }

        $this->container['payroll_tax_municipality_id'] = $payroll_tax_municipality_id;

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


