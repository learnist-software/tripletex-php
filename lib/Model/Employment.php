<?php
/**
 * Employment
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
 * Employment Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Employment implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Employment';

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
'employee' => '\Learnist\Tripletex\Model\Employee',
'employment_id' => 'string',
'start_date' => 'string',
'end_date' => 'string',
'employment_end_reason' => 'string',
'division' => '\Learnist\Tripletex\Model\Division',
'last_salary_change_date' => 'string',
'no_employment_relationship' => 'bool',
'is_main_employer' => 'bool',
'tax_deduction_code' => 'string',
'employment_details' => '\Learnist\Tripletex\Model\EmploymentDetails[]'    ];

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
'employee' => null,
'employment_id' => null,
'start_date' => null,
'end_date' => null,
'employment_end_reason' => null,
'division' => null,
'last_salary_change_date' => null,
'no_employment_relationship' => null,
'is_main_employer' => null,
'tax_deduction_code' => null,
'employment_details' => null    ];

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
'employee' => 'employee',
'employment_id' => 'employmentId',
'start_date' => 'startDate',
'end_date' => 'endDate',
'employment_end_reason' => 'employmentEndReason',
'division' => 'division',
'last_salary_change_date' => 'lastSalaryChangeDate',
'no_employment_relationship' => 'noEmploymentRelationship',
'is_main_employer' => 'isMainEmployer',
'tax_deduction_code' => 'taxDeductionCode',
'employment_details' => 'employmentDetails'    ];

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
'employee' => 'setEmployee',
'employment_id' => 'setEmploymentId',
'start_date' => 'setStartDate',
'end_date' => 'setEndDate',
'employment_end_reason' => 'setEmploymentEndReason',
'division' => 'setDivision',
'last_salary_change_date' => 'setLastSalaryChangeDate',
'no_employment_relationship' => 'setNoEmploymentRelationship',
'is_main_employer' => 'setIsMainEmployer',
'tax_deduction_code' => 'setTaxDeductionCode',
'employment_details' => 'setEmploymentDetails'    ];

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
'employee' => 'getEmployee',
'employment_id' => 'getEmploymentId',
'start_date' => 'getStartDate',
'end_date' => 'getEndDate',
'employment_end_reason' => 'getEmploymentEndReason',
'division' => 'getDivision',
'last_salary_change_date' => 'getLastSalaryChangeDate',
'no_employment_relationship' => 'getNoEmploymentRelationship',
'is_main_employer' => 'getIsMainEmployer',
'tax_deduction_code' => 'getTaxDeductionCode',
'employment_details' => 'getEmploymentDetails'    ];

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

    const EMPLOYMENT_END_REASON_EXPIRED = 'EMPLOYMENT_END_EXPIRED';
const EMPLOYMENT_END_REASON_EMPLOYEE = 'EMPLOYMENT_END_EMPLOYEE';
const EMPLOYMENT_END_REASON_EMPLOYER = 'EMPLOYMENT_END_EMPLOYER';
const EMPLOYMENT_END_REASON_WRONGLY_REPORTED = 'EMPLOYMENT_END_WRONGLY_REPORTED';
const EMPLOYMENT_END_REASON_SYSTEM_OR_ACCOUNTANT_CHANGE = 'EMPLOYMENT_END_SYSTEM_OR_ACCOUNTANT_CHANGE';
const EMPLOYMENT_END_REASON_INTERNAL_CHANGE = 'EMPLOYMENT_END_INTERNAL_CHANGE';
const TAX_DEDUCTION_CODE_LOENN_FRA_HOVEDARBEIDSGIVER = 'loennFraHovedarbeidsgiver';
const TAX_DEDUCTION_CODE_LOENN_FRA_BIARBEIDSGIVER = 'loennFraBiarbeidsgiver';
const TAX_DEDUCTION_CODE_PENSJON = 'pensjon';
const TAX_DEDUCTION_CODE_LOENN_TIL_UTENRIKSTJENESTEMANN = 'loennTilUtenrikstjenestemann';
const TAX_DEDUCTION_CODE_LOENN_KUN_TRYGDEAVGIFT_TIL_UTENLANDSK_BORGER = 'loennKunTrygdeavgiftTilUtenlandskBorger';
const TAX_DEDUCTION_CODE_LOENN_KUN_TRYGDEAVGIFT_TIL_UTENLANDSK_BORGER_SOM_GRENSEGJENGER = 'loennKunTrygdeavgiftTilUtenlandskBorgerSomGrensegjenger';
const TAX_DEDUCTION_CODE_INTRODUKSJONSSTOENAD = 'introduksjonsstoenad';
const TAX_DEDUCTION_CODE_UFOEREYTELSER_FRA_ANDRE = 'ufoereytelserFraAndre';
const TAX_DEDUCTION_CODE__EMPTY = 'EMPTY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEmploymentEndReasonAllowableValues()
    {
        return [
            self::EMPLOYMENT_END_REASON_EXPIRED,
self::EMPLOYMENT_END_REASON_EMPLOYEE,
self::EMPLOYMENT_END_REASON_EMPLOYER,
self::EMPLOYMENT_END_REASON_WRONGLY_REPORTED,
self::EMPLOYMENT_END_REASON_SYSTEM_OR_ACCOUNTANT_CHANGE,
self::EMPLOYMENT_END_REASON_INTERNAL_CHANGE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTaxDeductionCodeAllowableValues()
    {
        return [
            self::TAX_DEDUCTION_CODE_LOENN_FRA_HOVEDARBEIDSGIVER,
self::TAX_DEDUCTION_CODE_LOENN_FRA_BIARBEIDSGIVER,
self::TAX_DEDUCTION_CODE_PENSJON,
self::TAX_DEDUCTION_CODE_LOENN_TIL_UTENRIKSTJENESTEMANN,
self::TAX_DEDUCTION_CODE_LOENN_KUN_TRYGDEAVGIFT_TIL_UTENLANDSK_BORGER,
self::TAX_DEDUCTION_CODE_LOENN_KUN_TRYGDEAVGIFT_TIL_UTENLANDSK_BORGER_SOM_GRENSEGJENGER,
self::TAX_DEDUCTION_CODE_INTRODUKSJONSSTOENAD,
self::TAX_DEDUCTION_CODE_UFOEREYTELSER_FRA_ANDRE,
self::TAX_DEDUCTION_CODE__EMPTY,        ];
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
        $this->container['employee'] = isset($data['employee']) ? $data['employee'] : null;
        $this->container['employment_id'] = isset($data['employment_id']) ? $data['employment_id'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['employment_end_reason'] = isset($data['employment_end_reason']) ? $data['employment_end_reason'] : null;
        $this->container['division'] = isset($data['division']) ? $data['division'] : null;
        $this->container['last_salary_change_date'] = isset($data['last_salary_change_date']) ? $data['last_salary_change_date'] : null;
        $this->container['no_employment_relationship'] = isset($data['no_employment_relationship']) ? $data['no_employment_relationship'] : null;
        $this->container['is_main_employer'] = isset($data['is_main_employer']) ? $data['is_main_employer'] : null;
        $this->container['tax_deduction_code'] = isset($data['tax_deduction_code']) ? $data['tax_deduction_code'] : null;
        $this->container['employment_details'] = isset($data['employment_details']) ? $data['employment_details'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['start_date'] === null) {
            $invalidProperties[] = "'start_date' can't be null";
        }
        $allowedValues = $this->getEmploymentEndReasonAllowableValues();
        if (!is_null($this->container['employment_end_reason']) && !in_array($this->container['employment_end_reason'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'employment_end_reason', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getTaxDeductionCodeAllowableValues();
        if (!is_null($this->container['tax_deduction_code']) && !in_array($this->container['tax_deduction_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'tax_deduction_code', must be one of '%s'",
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
     * Gets employee
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getEmployee()
    {
        return $this->container['employee'];
    }

    /**
     * Sets employee
     *
     * @param \Learnist\Tripletex\Model\Employee $employee employee
     *
     * @return $this
     */
    public function setEmployee($employee)
    {
        $this->container['employee'] = $employee;

        return $this;
    }

    /**
     * Gets employment_id
     *
     * @return string
     */
    public function getEmploymentId()
    {
        return $this->container['employment_id'];
    }

    /**
     * Sets employment_id
     *
     * @param string $employment_id Existing employment ID used by the current accounting system
     *
     * @return $this
     */
    public function setEmploymentId($employment_id)
    {
        $this->container['employment_id'] = $employment_id;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string $start_date start_date
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string $end_date end_date
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets employment_end_reason
     *
     * @return string
     */
    public function getEmploymentEndReason()
    {
        return $this->container['employment_end_reason'];
    }

    /**
     * Sets employment_end_reason
     *
     * @param string $employment_end_reason Define the employment end reason.
     *
     * @return $this
     */
    public function setEmploymentEndReason($employment_end_reason)
    {
        $allowedValues = $this->getEmploymentEndReasonAllowableValues();
        if (!is_null($employment_end_reason) && !in_array($employment_end_reason, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'employment_end_reason', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['employment_end_reason'] = $employment_end_reason;

        return $this;
    }

    /**
     * Gets division
     *
     * @return \Learnist\Tripletex\Model\Division
     */
    public function getDivision()
    {
        return $this->container['division'];
    }

    /**
     * Sets division
     *
     * @param \Learnist\Tripletex\Model\Division $division division
     *
     * @return $this
     */
    public function setDivision($division)
    {
        $this->container['division'] = $division;

        return $this;
    }

    /**
     * Gets last_salary_change_date
     *
     * @return string
     */
    public function getLastSalaryChangeDate()
    {
        return $this->container['last_salary_change_date'];
    }

    /**
     * Sets last_salary_change_date
     *
     * @param string $last_salary_change_date last_salary_change_date
     *
     * @return $this
     */
    public function setLastSalaryChangeDate($last_salary_change_date)
    {
        $this->container['last_salary_change_date'] = $last_salary_change_date;

        return $this;
    }

    /**
     * Gets no_employment_relationship
     *
     * @return bool
     */
    public function getNoEmploymentRelationship()
    {
        return $this->container['no_employment_relationship'];
    }

    /**
     * Sets no_employment_relationship
     *
     * @param bool $no_employment_relationship Activate pensions and other benefits with no employment relationship.
     *
     * @return $this
     */
    public function setNoEmploymentRelationship($no_employment_relationship)
    {
        $this->container['no_employment_relationship'] = $no_employment_relationship;

        return $this;
    }

    /**
     * Gets is_main_employer
     *
     * @return bool
     */
    public function getIsMainEmployer()
    {
        return $this->container['is_main_employer'];
    }

    /**
     * Sets is_main_employer
     *
     * @param bool $is_main_employer Determines if company is main employer for the employee. Default value is true.<br />Some values will be default set if not sent upon creation of employment: <br/> If isMainEmployer is NOT sent and tax deduction code loennFraHovedarbeidsgiver is sent, isMainEmployer will be set to true. <br /> If isMainEmployer is NOT sent and tax deduction code loennFraBiarbeidsgiver is sent, isMainEmployer will be set to false. <br /> If true and deduction code is NOT sent, value of tax deduction code will be set to loennFraHovedarbeidsgiver. <br /> If false and deduction code is NOT sent, value of tax deduction code will be set to loennFraBiarbeidsgiver. <br /> For other types of Tax Deduction Codes, isMainEmployer does not influence anything.
     *
     * @return $this
     */
    public function setIsMainEmployer($is_main_employer)
    {
        $this->container['is_main_employer'] = $is_main_employer;

        return $this;
    }

    /**
     * Gets tax_deduction_code
     *
     * @return string
     */
    public function getTaxDeductionCode()
    {
        return $this->container['tax_deduction_code'];
    }

    /**
     * Sets tax_deduction_code
     *
     * @param string $tax_deduction_code EMPTY - represents that a tax deduction code is not set on the employment. It is illegal to set the field to this value.  <br /> Default value of this field is loennFraHovedarbeidsgiver or loennFraBiarbeidsgiver depending on boolean isMainEmployer
     *
     * @return $this
     */
    public function setTaxDeductionCode($tax_deduction_code)
    {
        $allowedValues = $this->getTaxDeductionCodeAllowableValues();
        if (!is_null($tax_deduction_code) && !in_array($tax_deduction_code, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'tax_deduction_code', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['tax_deduction_code'] = $tax_deduction_code;

        return $this;
    }

    /**
     * Gets employment_details
     *
     * @return \Learnist\Tripletex\Model\EmploymentDetails[]
     */
    public function getEmploymentDetails()
    {
        return $this->container['employment_details'];
    }

    /**
     * Sets employment_details
     *
     * @param \Learnist\Tripletex\Model\EmploymentDetails[] $employment_details Employment types tied to the employment
     *
     * @return $this
     */
    public function setEmploymentDetails($employment_details)
    {
        $this->container['employment_details'] = $employment_details;

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
