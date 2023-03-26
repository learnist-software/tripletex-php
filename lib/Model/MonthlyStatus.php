<?php
/**
 * MonthlyStatus
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
 * MonthlyStatus Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MonthlyStatus implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'MonthlyStatus';

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
'timesheet_entries' => '\Learnist\Tripletex\Model\TimesheetEntry[]',
'approved_date' => 'string',
'completed' => 'bool',
'approved_by' => '\Learnist\Tripletex\Model\Employee',
'approved' => 'bool',
'approved_until_date' => 'string',
'month_year' => 'string',
'hours_payout' => 'float',
'vacation_payout' => 'float',
'hour_summary' => '\Learnist\Tripletex\Model\HourSummary',
'flex_summary' => '\Learnist\Tripletex\Model\FlexSummary',
'vacation_summary' => '\Learnist\Tripletex\Model\VacationSummary'    ];

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
'timesheet_entries' => null,
'approved_date' => null,
'completed' => null,
'approved_by' => null,
'approved' => null,
'approved_until_date' => null,
'month_year' => null,
'hours_payout' => null,
'vacation_payout' => null,
'hour_summary' => null,
'flex_summary' => null,
'vacation_summary' => null    ];

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
'timesheet_entries' => 'timesheetEntries',
'approved_date' => 'approvedDate',
'completed' => 'completed',
'approved_by' => 'approvedBy',
'approved' => 'approved',
'approved_until_date' => 'approvedUntilDate',
'month_year' => 'monthYear',
'hours_payout' => 'hoursPayout',
'vacation_payout' => 'vacationPayout',
'hour_summary' => 'hourSummary',
'flex_summary' => 'flexSummary',
'vacation_summary' => 'vacationSummary'    ];

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
'timesheet_entries' => 'setTimesheetEntries',
'approved_date' => 'setApprovedDate',
'completed' => 'setCompleted',
'approved_by' => 'setApprovedBy',
'approved' => 'setApproved',
'approved_until_date' => 'setApprovedUntilDate',
'month_year' => 'setMonthYear',
'hours_payout' => 'setHoursPayout',
'vacation_payout' => 'setVacationPayout',
'hour_summary' => 'setHourSummary',
'flex_summary' => 'setFlexSummary',
'vacation_summary' => 'setVacationSummary'    ];

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
'timesheet_entries' => 'getTimesheetEntries',
'approved_date' => 'getApprovedDate',
'completed' => 'getCompleted',
'approved_by' => 'getApprovedBy',
'approved' => 'getApproved',
'approved_until_date' => 'getApprovedUntilDate',
'month_year' => 'getMonthYear',
'hours_payout' => 'getHoursPayout',
'vacation_payout' => 'getVacationPayout',
'hour_summary' => 'getHourSummary',
'flex_summary' => 'getFlexSummary',
'vacation_summary' => 'getVacationSummary'    ];

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
        $this->container['timesheet_entries'] = isset($data['timesheet_entries']) ? $data['timesheet_entries'] : null;
        $this->container['approved_date'] = isset($data['approved_date']) ? $data['approved_date'] : null;
        $this->container['completed'] = isset($data['completed']) ? $data['completed'] : null;
        $this->container['approved_by'] = isset($data['approved_by']) ? $data['approved_by'] : null;
        $this->container['approved'] = isset($data['approved']) ? $data['approved'] : null;
        $this->container['approved_until_date'] = isset($data['approved_until_date']) ? $data['approved_until_date'] : null;
        $this->container['month_year'] = isset($data['month_year']) ? $data['month_year'] : null;
        $this->container['hours_payout'] = isset($data['hours_payout']) ? $data['hours_payout'] : null;
        $this->container['vacation_payout'] = isset($data['vacation_payout']) ? $data['vacation_payout'] : null;
        $this->container['hour_summary'] = isset($data['hour_summary']) ? $data['hour_summary'] : null;
        $this->container['flex_summary'] = isset($data['flex_summary']) ? $data['flex_summary'] : null;
        $this->container['vacation_summary'] = isset($data['vacation_summary']) ? $data['vacation_summary'] : null;
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
     * Gets timesheet_entries
     *
     * @return \Learnist\Tripletex\Model\TimesheetEntry[]
     */
    public function getTimesheetEntries()
    {
        return $this->container['timesheet_entries'];
    }

    /**
     * Sets timesheet_entries
     *
     * @param \Learnist\Tripletex\Model\TimesheetEntry[] $timesheet_entries timesheet_entries
     *
     * @return $this
     */
    public function setTimesheetEntries($timesheet_entries)
    {
        $this->container['timesheet_entries'] = $timesheet_entries;

        return $this;
    }

    /**
     * Gets approved_date
     *
     * @return string
     */
    public function getApprovedDate()
    {
        return $this->container['approved_date'];
    }

    /**
     * Sets approved_date
     *
     * @param string $approved_date approved_date
     *
     * @return $this
     */
    public function setApprovedDate($approved_date)
    {
        $this->container['approved_date'] = $approved_date;

        return $this;
    }

    /**
     * Gets completed
     *
     * @return bool
     */
    public function getCompleted()
    {
        return $this->container['completed'];
    }

    /**
     * Sets completed
     *
     * @param bool $completed completed
     *
     * @return $this
     */
    public function setCompleted($completed)
    {
        $this->container['completed'] = $completed;

        return $this;
    }

    /**
     * Gets approved_by
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getApprovedBy()
    {
        return $this->container['approved_by'];
    }

    /**
     * Sets approved_by
     *
     * @param \Learnist\Tripletex\Model\Employee $approved_by approved_by
     *
     * @return $this
     */
    public function setApprovedBy($approved_by)
    {
        $this->container['approved_by'] = $approved_by;

        return $this;
    }

    /**
     * Gets approved
     *
     * @return bool
     */
    public function getApproved()
    {
        return $this->container['approved'];
    }

    /**
     * Sets approved
     *
     * @param bool $approved approved
     *
     * @return $this
     */
    public function setApproved($approved)
    {
        $this->container['approved'] = $approved;

        return $this;
    }

    /**
     * Gets approved_until_date
     *
     * @return string
     */
    public function getApprovedUntilDate()
    {
        return $this->container['approved_until_date'];
    }

    /**
     * Sets approved_until_date
     *
     * @param string $approved_until_date approved_until_date
     *
     * @return $this
     */
    public function setApprovedUntilDate($approved_until_date)
    {
        $this->container['approved_until_date'] = $approved_until_date;

        return $this;
    }

    /**
     * Gets month_year
     *
     * @return string
     */
    public function getMonthYear()
    {
        return $this->container['month_year'];
    }

    /**
     * Sets month_year
     *
     * @param string $month_year month_year
     *
     * @return $this
     */
    public function setMonthYear($month_year)
    {
        $this->container['month_year'] = $month_year;

        return $this;
    }

    /**
     * Gets hours_payout
     *
     * @return float
     */
    public function getHoursPayout()
    {
        return $this->container['hours_payout'];
    }

    /**
     * Sets hours_payout
     *
     * @param float $hours_payout hours_payout
     *
     * @return $this
     */
    public function setHoursPayout($hours_payout)
    {
        $this->container['hours_payout'] = $hours_payout;

        return $this;
    }

    /**
     * Gets vacation_payout
     *
     * @return float
     */
    public function getVacationPayout()
    {
        return $this->container['vacation_payout'];
    }

    /**
     * Sets vacation_payout
     *
     * @param float $vacation_payout vacation_payout
     *
     * @return $this
     */
    public function setVacationPayout($vacation_payout)
    {
        $this->container['vacation_payout'] = $vacation_payout;

        return $this;
    }

    /**
     * Gets hour_summary
     *
     * @return \Learnist\Tripletex\Model\HourSummary
     */
    public function getHourSummary()
    {
        return $this->container['hour_summary'];
    }

    /**
     * Sets hour_summary
     *
     * @param \Learnist\Tripletex\Model\HourSummary $hour_summary hour_summary
     *
     * @return $this
     */
    public function setHourSummary($hour_summary)
    {
        $this->container['hour_summary'] = $hour_summary;

        return $this;
    }

    /**
     * Gets flex_summary
     *
     * @return \Learnist\Tripletex\Model\FlexSummary
     */
    public function getFlexSummary()
    {
        return $this->container['flex_summary'];
    }

    /**
     * Sets flex_summary
     *
     * @param \Learnist\Tripletex\Model\FlexSummary $flex_summary flex_summary
     *
     * @return $this
     */
    public function setFlexSummary($flex_summary)
    {
        $this->container['flex_summary'] = $flex_summary;

        return $this;
    }

    /**
     * Gets vacation_summary
     *
     * @return \Learnist\Tripletex\Model\VacationSummary
     */
    public function getVacationSummary()
    {
        return $this->container['vacation_summary'];
    }

    /**
     * Sets vacation_summary
     *
     * @param \Learnist\Tripletex\Model\VacationSummary $vacation_summary vacation_summary
     *
     * @return $this
     */
    public function setVacationSummary($vacation_summary)
    {
        $this->container['vacation_summary'] = $vacation_summary;

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
