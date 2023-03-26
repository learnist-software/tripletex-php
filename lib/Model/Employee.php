<?php
/**
 * Employee
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
 * Employee Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Employee implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Employee';

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
        'first_name' => 'string',
        'last_name' => 'string',
        'display_name' => 'string',
        'employee_number' => 'string',
        'date_of_birth' => 'string',
        'email' => 'string',
        'phone_number_mobile_country' => '\Learnist\Tripletex\Model\Country',
        'phone_number_mobile' => 'string',
        'phone_number_home' => 'string',
        'phone_number_work' => 'string',
        'national_identity_number' => 'string',
        'dnumber' => 'string',
        'international_id' => '\Learnist\Tripletex\Model\InternationalId',
        'bank_account_number' => 'string',
        'iban' => 'string',
        'bic' => 'string',
        'creditor_bank_country_id' => 'int',
        'uses_abroad_payment' => 'bool',
        'user_type' => 'string',
        'allow_information_registration' => 'bool',
        'is_contact' => 'bool',
        'comments' => 'string',
        'address' => '\Learnist\Tripletex\Model\Address',
        'department' => '\Learnist\Tripletex\Model\Department',
        'employments' => '\Learnist\Tripletex\Model\Employment[]',
        'holiday_allowance_earned' => '\Learnist\Tripletex\Model\HolidayAllowanceEarned',
        'employee_category' => '\Learnist\Tripletex\Model\EmployeeCategory',
        'is_auth_project_overview_url' => 'bool',
        'picture_id' => 'int'
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
        'first_name' => null,
        'last_name' => null,
        'display_name' => null,
        'employee_number' => null,
        'date_of_birth' => null,
        'email' => 'email',
        'phone_number_mobile_country' => null,
        'phone_number_mobile' => null,
        'phone_number_home' => null,
        'phone_number_work' => null,
        'national_identity_number' => null,
        'dnumber' => null,
        'international_id' => null,
        'bank_account_number' => null,
        'iban' => null,
        'bic' => null,
        'creditor_bank_country_id' => 'int32',
        'uses_abroad_payment' => null,
        'user_type' => null,
        'allow_information_registration' => null,
        'is_contact' => null,
        'comments' => null,
        'address' => null,
        'department' => null,
        'employments' => null,
        'holiday_allowance_earned' => null,
        'employee_category' => null,
        'is_auth_project_overview_url' => null,
        'picture_id' => 'int32'
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
		'first_name' => false,
		'last_name' => false,
		'display_name' => false,
		'employee_number' => false,
		'date_of_birth' => false,
		'email' => false,
		'phone_number_mobile_country' => false,
		'phone_number_mobile' => false,
		'phone_number_home' => false,
		'phone_number_work' => false,
		'national_identity_number' => false,
		'dnumber' => false,
		'international_id' => false,
		'bank_account_number' => false,
		'iban' => false,
		'bic' => false,
		'creditor_bank_country_id' => false,
		'uses_abroad_payment' => false,
		'user_type' => false,
		'allow_information_registration' => false,
		'is_contact' => false,
		'comments' => false,
		'address' => false,
		'department' => false,
		'employments' => false,
		'holiday_allowance_earned' => false,
		'employee_category' => false,
		'is_auth_project_overview_url' => false,
		'picture_id' => false
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
        'first_name' => 'firstName',
        'last_name' => 'lastName',
        'display_name' => 'displayName',
        'employee_number' => 'employeeNumber',
        'date_of_birth' => 'dateOfBirth',
        'email' => 'email',
        'phone_number_mobile_country' => 'phoneNumberMobileCountry',
        'phone_number_mobile' => 'phoneNumberMobile',
        'phone_number_home' => 'phoneNumberHome',
        'phone_number_work' => 'phoneNumberWork',
        'national_identity_number' => 'nationalIdentityNumber',
        'dnumber' => 'dnumber',
        'international_id' => 'internationalId',
        'bank_account_number' => 'bankAccountNumber',
        'iban' => 'iban',
        'bic' => 'bic',
        'creditor_bank_country_id' => 'creditorBankCountryId',
        'uses_abroad_payment' => 'usesAbroadPayment',
        'user_type' => 'userType',
        'allow_information_registration' => 'allowInformationRegistration',
        'is_contact' => 'isContact',
        'comments' => 'comments',
        'address' => 'address',
        'department' => 'department',
        'employments' => 'employments',
        'holiday_allowance_earned' => 'holidayAllowanceEarned',
        'employee_category' => 'employeeCategory',
        'is_auth_project_overview_url' => 'isAuthProjectOverviewURL',
        'picture_id' => 'pictureId'
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
        'first_name' => 'setFirstName',
        'last_name' => 'setLastName',
        'display_name' => 'setDisplayName',
        'employee_number' => 'setEmployeeNumber',
        'date_of_birth' => 'setDateOfBirth',
        'email' => 'setEmail',
        'phone_number_mobile_country' => 'setPhoneNumberMobileCountry',
        'phone_number_mobile' => 'setPhoneNumberMobile',
        'phone_number_home' => 'setPhoneNumberHome',
        'phone_number_work' => 'setPhoneNumberWork',
        'national_identity_number' => 'setNationalIdentityNumber',
        'dnumber' => 'setDnumber',
        'international_id' => 'setInternationalId',
        'bank_account_number' => 'setBankAccountNumber',
        'iban' => 'setIban',
        'bic' => 'setBic',
        'creditor_bank_country_id' => 'setCreditorBankCountryId',
        'uses_abroad_payment' => 'setUsesAbroadPayment',
        'user_type' => 'setUserType',
        'allow_information_registration' => 'setAllowInformationRegistration',
        'is_contact' => 'setIsContact',
        'comments' => 'setComments',
        'address' => 'setAddress',
        'department' => 'setDepartment',
        'employments' => 'setEmployments',
        'holiday_allowance_earned' => 'setHolidayAllowanceEarned',
        'employee_category' => 'setEmployeeCategory',
        'is_auth_project_overview_url' => 'setIsAuthProjectOverviewUrl',
        'picture_id' => 'setPictureId'
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
        'first_name' => 'getFirstName',
        'last_name' => 'getLastName',
        'display_name' => 'getDisplayName',
        'employee_number' => 'getEmployeeNumber',
        'date_of_birth' => 'getDateOfBirth',
        'email' => 'getEmail',
        'phone_number_mobile_country' => 'getPhoneNumberMobileCountry',
        'phone_number_mobile' => 'getPhoneNumberMobile',
        'phone_number_home' => 'getPhoneNumberHome',
        'phone_number_work' => 'getPhoneNumberWork',
        'national_identity_number' => 'getNationalIdentityNumber',
        'dnumber' => 'getDnumber',
        'international_id' => 'getInternationalId',
        'bank_account_number' => 'getBankAccountNumber',
        'iban' => 'getIban',
        'bic' => 'getBic',
        'creditor_bank_country_id' => 'getCreditorBankCountryId',
        'uses_abroad_payment' => 'getUsesAbroadPayment',
        'user_type' => 'getUserType',
        'allow_information_registration' => 'getAllowInformationRegistration',
        'is_contact' => 'getIsContact',
        'comments' => 'getComments',
        'address' => 'getAddress',
        'department' => 'getDepartment',
        'employments' => 'getEmployments',
        'holiday_allowance_earned' => 'getHolidayAllowanceEarned',
        'employee_category' => 'getEmployeeCategory',
        'is_auth_project_overview_url' => 'getIsAuthProjectOverviewUrl',
        'picture_id' => 'getPictureId'
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

    public const USER_TYPE_STANDARD = 'STANDARD';
    public const USER_TYPE_EXTENDED = 'EXTENDED';
    public const USER_TYPE_NO_ACCESS = 'NO_ACCESS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getUserTypeAllowableValues()
    {
        return [
            self::USER_TYPE_STANDARD,
            self::USER_TYPE_EXTENDED,
            self::USER_TYPE_NO_ACCESS,
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
        $this->setIfExists('first_name', $data ?? [], null);
        $this->setIfExists('last_name', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('employee_number', $data ?? [], null);
        $this->setIfExists('date_of_birth', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('phone_number_mobile_country', $data ?? [], null);
        $this->setIfExists('phone_number_mobile', $data ?? [], null);
        $this->setIfExists('phone_number_home', $data ?? [], null);
        $this->setIfExists('phone_number_work', $data ?? [], null);
        $this->setIfExists('national_identity_number', $data ?? [], null);
        $this->setIfExists('dnumber', $data ?? [], null);
        $this->setIfExists('international_id', $data ?? [], null);
        $this->setIfExists('bank_account_number', $data ?? [], null);
        $this->setIfExists('iban', $data ?? [], null);
        $this->setIfExists('bic', $data ?? [], null);
        $this->setIfExists('creditor_bank_country_id', $data ?? [], null);
        $this->setIfExists('uses_abroad_payment', $data ?? [], null);
        $this->setIfExists('user_type', $data ?? [], null);
        $this->setIfExists('allow_information_registration', $data ?? [], null);
        $this->setIfExists('is_contact', $data ?? [], null);
        $this->setIfExists('comments', $data ?? [], null);
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('employments', $data ?? [], null);
        $this->setIfExists('holiday_allowance_earned', $data ?? [], null);
        $this->setIfExists('employee_category', $data ?? [], null);
        $this->setIfExists('is_auth_project_overview_url', $data ?? [], null);
        $this->setIfExists('picture_id', $data ?? [], null);
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

        if ($this->container['first_name'] === null) {
            $invalidProperties[] = "'first_name' can't be null";
        }
        if ((mb_strlen($this->container['first_name']) > 100)) {
            $invalidProperties[] = "invalid value for 'first_name', the character length must be smaller than or equal to 100.";
        }

        if ((mb_strlen($this->container['first_name']) < 1)) {
            $invalidProperties[] = "invalid value for 'first_name', the character length must be bigger than or equal to 1.";
        }

        if ($this->container['last_name'] === null) {
            $invalidProperties[] = "'last_name' can't be null";
        }
        if ((mb_strlen($this->container['last_name']) > 100)) {
            $invalidProperties[] = "invalid value for 'last_name', the character length must be smaller than or equal to 100.";
        }

        if ((mb_strlen($this->container['last_name']) < 1)) {
            $invalidProperties[] = "invalid value for 'last_name', the character length must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['employee_number']) && (mb_strlen($this->container['employee_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'employee_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['employee_number']) && (mb_strlen($this->container['employee_number']) < 0)) {
            $invalidProperties[] = "invalid value for 'employee_number', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['email']) && (mb_strlen($this->container['email']) > 100)) {
            $invalidProperties[] = "invalid value for 'email', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_mobile']) && (mb_strlen($this->container['phone_number_mobile']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_mobile', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_home']) && (mb_strlen($this->container['phone_number_home']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_home', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_work']) && (mb_strlen($this->container['phone_number_work']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_work', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['national_identity_number']) && (mb_strlen($this->container['national_identity_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'national_identity_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['dnumber']) && (mb_strlen($this->container['dnumber']) > 11)) {
            $invalidProperties[] = "invalid value for 'dnumber', the character length must be smaller than or equal to 11.";
        }

        if (!is_null($this->container['bank_account_number']) && (mb_strlen($this->container['bank_account_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_number', the character length must be smaller than or equal to 100.";
        }

        $allowedValues = $this->getUserTypeAllowableValues();
        if (!is_null($this->container['user_type']) && !in_array($this->container['user_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'user_type', must be one of '%s'",
                $this->container['user_type'],
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
     * Gets first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        if ((mb_strlen($first_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $first_name when calling Employee., must be smaller than or equal to 100.');
        }
        if ((mb_strlen($first_name) < 1)) {
            throw new \InvalidArgumentException('invalid length for $first_name when calling Employee., must be bigger than or equal to 1.');
        }


        if (is_null($first_name)) {
            throw new \InvalidArgumentException('non-nullable first_name cannot be null');
        }

        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string $last_name last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        if ((mb_strlen($last_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $last_name when calling Employee., must be smaller than or equal to 100.');
        }
        if ((mb_strlen($last_name) < 1)) {
            throw new \InvalidArgumentException('invalid length for $last_name when calling Employee., must be bigger than or equal to 1.');
        }


        if (is_null($last_name)) {
            throw new \InvalidArgumentException('non-nullable last_name cannot be null');
        }

        $this->container['last_name'] = $last_name;

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
     * Gets employee_number
     *
     * @return string|null
     */
    public function getEmployeeNumber()
    {
        return $this->container['employee_number'];
    }

    /**
     * Sets employee_number
     *
     * @param string|null $employee_number employee_number
     *
     * @return self
     */
    public function setEmployeeNumber($employee_number)
    {
        if (!is_null($employee_number) && (mb_strlen($employee_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $employee_number when calling Employee., must be smaller than or equal to 100.');
        }
        if (!is_null($employee_number) && (mb_strlen($employee_number) < 0)) {
            throw new \InvalidArgumentException('invalid length for $employee_number when calling Employee., must be bigger than or equal to 0.');
        }


        if (is_null($employee_number)) {
            throw new \InvalidArgumentException('non-nullable employee_number cannot be null');
        }

        $this->container['employee_number'] = $employee_number;

        return $this;
    }

    /**
     * Gets date_of_birth
     *
     * @return string|null
     */
    public function getDateOfBirth()
    {
        return $this->container['date_of_birth'];
    }

    /**
     * Sets date_of_birth
     *
     * @param string|null $date_of_birth date_of_birth
     *
     * @return self
     */
    public function setDateOfBirth($date_of_birth)
    {

        if (is_null($date_of_birth)) {
            throw new \InvalidArgumentException('non-nullable date_of_birth cannot be null');
        }

        $this->container['date_of_birth'] = $date_of_birth;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (!is_null($email) && (mb_strlen($email) > 100)) {
            throw new \InvalidArgumentException('invalid length for $email when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets phone_number_mobile_country
     *
     * @return \Learnist\Tripletex\Model\Country|null
     */
    public function getPhoneNumberMobileCountry()
    {
        return $this->container['phone_number_mobile_country'];
    }

    /**
     * Sets phone_number_mobile_country
     *
     * @param \Learnist\Tripletex\Model\Country|null $phone_number_mobile_country phone_number_mobile_country
     *
     * @return self
     */
    public function setPhoneNumberMobileCountry($phone_number_mobile_country)
    {

        if (is_null($phone_number_mobile_country)) {
            throw new \InvalidArgumentException('non-nullable phone_number_mobile_country cannot be null');
        }

        $this->container['phone_number_mobile_country'] = $phone_number_mobile_country;

        return $this;
    }

    /**
     * Gets phone_number_mobile
     *
     * @return string|null
     */
    public function getPhoneNumberMobile()
    {
        return $this->container['phone_number_mobile'];
    }

    /**
     * Sets phone_number_mobile
     *
     * @param string|null $phone_number_mobile phone_number_mobile
     *
     * @return self
     */
    public function setPhoneNumberMobile($phone_number_mobile)
    {
        if (!is_null($phone_number_mobile) && (mb_strlen($phone_number_mobile) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_mobile when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($phone_number_mobile)) {
            throw new \InvalidArgumentException('non-nullable phone_number_mobile cannot be null');
        }

        $this->container['phone_number_mobile'] = $phone_number_mobile;

        return $this;
    }

    /**
     * Gets phone_number_home
     *
     * @return string|null
     */
    public function getPhoneNumberHome()
    {
        return $this->container['phone_number_home'];
    }

    /**
     * Sets phone_number_home
     *
     * @param string|null $phone_number_home phone_number_home
     *
     * @return self
     */
    public function setPhoneNumberHome($phone_number_home)
    {
        if (!is_null($phone_number_home) && (mb_strlen($phone_number_home) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_home when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($phone_number_home)) {
            throw new \InvalidArgumentException('non-nullable phone_number_home cannot be null');
        }

        $this->container['phone_number_home'] = $phone_number_home;

        return $this;
    }

    /**
     * Gets phone_number_work
     *
     * @return string|null
     */
    public function getPhoneNumberWork()
    {
        return $this->container['phone_number_work'];
    }

    /**
     * Sets phone_number_work
     *
     * @param string|null $phone_number_work phone_number_work
     *
     * @return self
     */
    public function setPhoneNumberWork($phone_number_work)
    {
        if (!is_null($phone_number_work) && (mb_strlen($phone_number_work) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_work when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($phone_number_work)) {
            throw new \InvalidArgumentException('non-nullable phone_number_work cannot be null');
        }

        $this->container['phone_number_work'] = $phone_number_work;

        return $this;
    }

    /**
     * Gets national_identity_number
     *
     * @return string|null
     */
    public function getNationalIdentityNumber()
    {
        return $this->container['national_identity_number'];
    }

    /**
     * Sets national_identity_number
     *
     * @param string|null $national_identity_number national_identity_number
     *
     * @return self
     */
    public function setNationalIdentityNumber($national_identity_number)
    {
        if (!is_null($national_identity_number) && (mb_strlen($national_identity_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $national_identity_number when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($national_identity_number)) {
            throw new \InvalidArgumentException('non-nullable national_identity_number cannot be null');
        }

        $this->container['national_identity_number'] = $national_identity_number;

        return $this;
    }

    /**
     * Gets dnumber
     *
     * @return string|null
     */
    public function getDnumber()
    {
        return $this->container['dnumber'];
    }

    /**
     * Sets dnumber
     *
     * @param string|null $dnumber dnumber
     *
     * @return self
     */
    public function setDnumber($dnumber)
    {
        if (!is_null($dnumber) && (mb_strlen($dnumber) > 11)) {
            throw new \InvalidArgumentException('invalid length for $dnumber when calling Employee., must be smaller than or equal to 11.');
        }


        if (is_null($dnumber)) {
            throw new \InvalidArgumentException('non-nullable dnumber cannot be null');
        }

        $this->container['dnumber'] = $dnumber;

        return $this;
    }

    /**
     * Gets international_id
     *
     * @return \Learnist\Tripletex\Model\InternationalId|null
     */
    public function getInternationalId()
    {
        return $this->container['international_id'];
    }

    /**
     * Sets international_id
     *
     * @param \Learnist\Tripletex\Model\InternationalId|null $international_id international_id
     *
     * @return self
     */
    public function setInternationalId($international_id)
    {

        if (is_null($international_id)) {
            throw new \InvalidArgumentException('non-nullable international_id cannot be null');
        }

        $this->container['international_id'] = $international_id;

        return $this;
    }

    /**
     * Gets bank_account_number
     *
     * @return string|null
     */
    public function getBankAccountNumber()
    {
        return $this->container['bank_account_number'];
    }

    /**
     * Sets bank_account_number
     *
     * @param string|null $bank_account_number bank_account_number
     *
     * @return self
     */
    public function setBankAccountNumber($bank_account_number)
    {
        if (!is_null($bank_account_number) && (mb_strlen($bank_account_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_number when calling Employee., must be smaller than or equal to 100.');
        }


        if (is_null($bank_account_number)) {
            throw new \InvalidArgumentException('non-nullable bank_account_number cannot be null');
        }

        $this->container['bank_account_number'] = $bank_account_number;

        return $this;
    }

    /**
     * Gets iban
     *
     * @return string|null
     */
    public function getIban()
    {
        return $this->container['iban'];
    }

    /**
     * Sets iban
     *
     * @param string|null $iban IBAN field
     *
     * @return self
     */
    public function setIban($iban)
    {

        if (is_null($iban)) {
            throw new \InvalidArgumentException('non-nullable iban cannot be null');
        }

        $this->container['iban'] = $iban;

        return $this;
    }

    /**
     * Gets bic
     *
     * @return string|null
     */
    public function getBic()
    {
        return $this->container['bic'];
    }

    /**
     * Sets bic
     *
     * @param string|null $bic Bic (swift) field
     *
     * @return self
     */
    public function setBic($bic)
    {

        if (is_null($bic)) {
            throw new \InvalidArgumentException('non-nullable bic cannot be null');
        }

        $this->container['bic'] = $bic;

        return $this;
    }

    /**
     * Gets creditor_bank_country_id
     *
     * @return int|null
     */
    public function getCreditorBankCountryId()
    {
        return $this->container['creditor_bank_country_id'];
    }

    /**
     * Sets creditor_bank_country_id
     *
     * @param int|null $creditor_bank_country_id Country of creditor bank field
     *
     * @return self
     */
    public function setCreditorBankCountryId($creditor_bank_country_id)
    {

        if (is_null($creditor_bank_country_id)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_country_id cannot be null');
        }

        $this->container['creditor_bank_country_id'] = $creditor_bank_country_id;

        return $this;
    }

    /**
     * Gets uses_abroad_payment
     *
     * @return bool|null
     */
    public function getUsesAbroadPayment()
    {
        return $this->container['uses_abroad_payment'];
    }

    /**
     * Sets uses_abroad_payment
     *
     * @param bool|null $uses_abroad_payment UsesAbroadPayment field. Determines if we should use domestic or abroad remittance. To be able to use abroad remittance, one has to: 1: have Autopay 2: have valid combination of the fields Iban, Bic (swift) and Country of creditor bank.
     *
     * @return self
     */
    public function setUsesAbroadPayment($uses_abroad_payment)
    {

        if (is_null($uses_abroad_payment)) {
            throw new \InvalidArgumentException('non-nullable uses_abroad_payment cannot be null');
        }

        $this->container['uses_abroad_payment'] = $uses_abroad_payment;

        return $this;
    }

    /**
     * Gets user_type
     *
     * @return string|null
     */
    public function getUserType()
    {
        return $this->container['user_type'];
    }

    /**
     * Sets user_type
     *
     * @param string|null $user_type Define the employee's user type.<br>STANDARD: Reduced access. Users with limited system entitlements.<br>EXTENDED: Users can be given all system entitlements.<br>NO_ACCESS: User with no log on access.<br>Users with access to Tripletex must confirm the email address.
     *
     * @return self
     */
    public function setUserType($user_type)
    {
        $allowedValues = $this->getUserTypeAllowableValues();
        if (!is_null($user_type) && !in_array($user_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'user_type', must be one of '%s'",
                    $user_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($user_type)) {
            throw new \InvalidArgumentException('non-nullable user_type cannot be null');
        }

        $this->container['user_type'] = $user_type;

        return $this;
    }

    /**
     * Gets allow_information_registration
     *
     * @return bool|null
     */
    public function getAllowInformationRegistration()
    {
        return $this->container['allow_information_registration'];
    }

    /**
     * Sets allow_information_registration
     *
     * @param bool|null $allow_information_registration Determines if salary information can be registered on the user including hours, travel expenses and employee expenses. The user may also be selected as a project member on projects.
     *
     * @return self
     */
    public function setAllowInformationRegistration($allow_information_registration)
    {

        if (is_null($allow_information_registration)) {
            throw new \InvalidArgumentException('non-nullable allow_information_registration cannot be null');
        }

        $this->container['allow_information_registration'] = $allow_information_registration;

        return $this;
    }

    /**
     * Gets is_contact
     *
     * @return bool|null
     */
    public function getIsContact()
    {
        return $this->container['is_contact'];
    }

    /**
     * Sets is_contact
     *
     * @param bool|null $is_contact is_contact
     *
     * @return self
     */
    public function setIsContact($is_contact)
    {

        if (is_null($is_contact)) {
            throw new \InvalidArgumentException('non-nullable is_contact cannot be null');
        }

        $this->container['is_contact'] = $is_contact;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return string|null
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param string|null $comments comments
     *
     * @return self
     */
    public function setComments($comments)
    {

        if (is_null($comments)) {
            throw new \InvalidArgumentException('non-nullable comments cannot be null');
        }

        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets address
     *
     * @return \Learnist\Tripletex\Model\Address|null
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param \Learnist\Tripletex\Model\Address|null $address address
     *
     * @return self
     */
    public function setAddress($address)
    {

        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }

        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department|null
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department|null $department department
     *
     * @return self
     */
    public function setDepartment($department)
    {

        if (is_null($department)) {
            throw new \InvalidArgumentException('non-nullable department cannot be null');
        }

        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets employments
     *
     * @return \Learnist\Tripletex\Model\Employment[]|null
     */
    public function getEmployments()
    {
        return $this->container['employments'];
    }

    /**
     * Sets employments
     *
     * @param \Learnist\Tripletex\Model\Employment[]|null $employments Employments tied to the employee
     *
     * @return self
     */
    public function setEmployments($employments)
    {

        if (is_null($employments)) {
            throw new \InvalidArgumentException('non-nullable employments cannot be null');
        }

        $this->container['employments'] = $employments;

        return $this;
    }

    /**
     * Gets holiday_allowance_earned
     *
     * @return \Learnist\Tripletex\Model\HolidayAllowanceEarned|null
     */
    public function getHolidayAllowanceEarned()
    {
        return $this->container['holiday_allowance_earned'];
    }

    /**
     * Sets holiday_allowance_earned
     *
     * @param \Learnist\Tripletex\Model\HolidayAllowanceEarned|null $holiday_allowance_earned holiday_allowance_earned
     *
     * @return self
     */
    public function setHolidayAllowanceEarned($holiday_allowance_earned)
    {

        if (is_null($holiday_allowance_earned)) {
            throw new \InvalidArgumentException('non-nullable holiday_allowance_earned cannot be null');
        }

        $this->container['holiday_allowance_earned'] = $holiday_allowance_earned;

        return $this;
    }

    /**
     * Gets employee_category
     *
     * @return \Learnist\Tripletex\Model\EmployeeCategory|null
     */
    public function getEmployeeCategory()
    {
        return $this->container['employee_category'];
    }

    /**
     * Sets employee_category
     *
     * @param \Learnist\Tripletex\Model\EmployeeCategory|null $employee_category employee_category
     *
     * @return self
     */
    public function setEmployeeCategory($employee_category)
    {

        if (is_null($employee_category)) {
            throw new \InvalidArgumentException('non-nullable employee_category cannot be null');
        }

        $this->container['employee_category'] = $employee_category;

        return $this;
    }

    /**
     * Gets is_auth_project_overview_url
     *
     * @return bool|null
     */
    public function getIsAuthProjectOverviewUrl()
    {
        return $this->container['is_auth_project_overview_url'];
    }

    /**
     * Sets is_auth_project_overview_url
     *
     * @param bool|null $is_auth_project_overview_url is_auth_project_overview_url
     *
     * @return self
     */
    public function setIsAuthProjectOverviewUrl($is_auth_project_overview_url)
    {

        if (is_null($is_auth_project_overview_url)) {
            throw new \InvalidArgumentException('non-nullable is_auth_project_overview_url cannot be null');
        }

        $this->container['is_auth_project_overview_url'] = $is_auth_project_overview_url;

        return $this;
    }

    /**
     * Gets picture_id
     *
     * @return int|null
     */
    public function getPictureId()
    {
        return $this->container['picture_id'];
    }

    /**
     * Sets picture_id
     *
     * @param int|null $picture_id picture_id
     *
     * @return self
     */
    public function setPictureId($picture_id)
    {

        if (is_null($picture_id)) {
            throw new \InvalidArgumentException('non-nullable picture_id cannot be null');
        }

        $this->container['picture_id'] = $picture_id;

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


