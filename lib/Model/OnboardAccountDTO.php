<?php
/**
 * OnboardAccountDTO
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
 * OnboardAccountDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class OnboardAccountDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'OnboardAccountDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'company_name' => 'string',
'org_number' => 'string',
'address' => 'string',
'city' => 'string',
'postal_code' => 'string',
'municipality' => 'string',
'start_date_municipality' => '\DateTime',
'registration_date' => '\DateTime',
'vat_registered' => 'bool',
'logistics_module' => 'bool',
'salary_module' => 'bool',
'enterprises' => '\Learnist\Tripletex\Model\EnterpriseDTO[]',
'package_id' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'company_name' => null,
'org_number' => null,
'address' => null,
'city' => null,
'postal_code' => null,
'municipality' => null,
'start_date_municipality' => 'date',
'registration_date' => 'date',
'vat_registered' => null,
'logistics_module' => null,
'salary_module' => null,
'enterprises' => null,
'package_id' => 'int32'    ];

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
        'company_name' => 'companyName',
'org_number' => 'orgNumber',
'address' => 'address',
'city' => 'city',
'postal_code' => 'postalCode',
'municipality' => 'municipality',
'start_date_municipality' => 'startDateMunicipality',
'registration_date' => 'registrationDate',
'vat_registered' => 'vatRegistered',
'logistics_module' => 'logisticsModule',
'salary_module' => 'salaryModule',
'enterprises' => 'enterprises',
'package_id' => 'packageId'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'company_name' => 'setCompanyName',
'org_number' => 'setOrgNumber',
'address' => 'setAddress',
'city' => 'setCity',
'postal_code' => 'setPostalCode',
'municipality' => 'setMunicipality',
'start_date_municipality' => 'setStartDateMunicipality',
'registration_date' => 'setRegistrationDate',
'vat_registered' => 'setVatRegistered',
'logistics_module' => 'setLogisticsModule',
'salary_module' => 'setSalaryModule',
'enterprises' => 'setEnterprises',
'package_id' => 'setPackageId'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'company_name' => 'getCompanyName',
'org_number' => 'getOrgNumber',
'address' => 'getAddress',
'city' => 'getCity',
'postal_code' => 'getPostalCode',
'municipality' => 'getMunicipality',
'start_date_municipality' => 'getStartDateMunicipality',
'registration_date' => 'getRegistrationDate',
'vat_registered' => 'getVatRegistered',
'logistics_module' => 'getLogisticsModule',
'salary_module' => 'getSalaryModule',
'enterprises' => 'getEnterprises',
'package_id' => 'getPackageId'    ];

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
        $this->container['company_name'] = isset($data['company_name']) ? $data['company_name'] : null;
        $this->container['org_number'] = isset($data['org_number']) ? $data['org_number'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
        $this->container['postal_code'] = isset($data['postal_code']) ? $data['postal_code'] : null;
        $this->container['municipality'] = isset($data['municipality']) ? $data['municipality'] : null;
        $this->container['start_date_municipality'] = isset($data['start_date_municipality']) ? $data['start_date_municipality'] : null;
        $this->container['registration_date'] = isset($data['registration_date']) ? $data['registration_date'] : null;
        $this->container['vat_registered'] = isset($data['vat_registered']) ? $data['vat_registered'] : null;
        $this->container['logistics_module'] = isset($data['logistics_module']) ? $data['logistics_module'] : null;
        $this->container['salary_module'] = isset($data['salary_module']) ? $data['salary_module'] : null;
        $this->container['enterprises'] = isset($data['enterprises']) ? $data['enterprises'] : null;
        $this->container['package_id'] = isset($data['package_id']) ? $data['package_id'] : null;
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
     * Gets company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string $company_name company_name
     *
     * @return $this
     */
    public function setCompanyName($company_name)
    {
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets org_number
     *
     * @return string
     */
    public function getOrgNumber()
    {
        return $this->container['org_number'];
    }

    /**
     * Sets org_number
     *
     * @param string $org_number org_number
     *
     * @return $this
     */
    public function setOrgNumber($org_number)
    {
        $this->container['org_number'] = $org_number;

        return $this;
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param string $address address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string $city city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string $postal_code postal_code
     *
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets municipality
     *
     * @return string
     */
    public function getMunicipality()
    {
        return $this->container['municipality'];
    }

    /**
     * Sets municipality
     *
     * @param string $municipality municipality
     *
     * @return $this
     */
    public function setMunicipality($municipality)
    {
        $this->container['municipality'] = $municipality;

        return $this;
    }

    /**
     * Gets start_date_municipality
     *
     * @return \DateTime
     */
    public function getStartDateMunicipality()
    {
        return $this->container['start_date_municipality'];
    }

    /**
     * Sets start_date_municipality
     *
     * @param \DateTime $start_date_municipality start_date_municipality
     *
     * @return $this
     */
    public function setStartDateMunicipality($start_date_municipality)
    {
        $this->container['start_date_municipality'] = $start_date_municipality;

        return $this;
    }

    /**
     * Gets registration_date
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->container['registration_date'];
    }

    /**
     * Sets registration_date
     *
     * @param \DateTime $registration_date registration_date
     *
     * @return $this
     */
    public function setRegistrationDate($registration_date)
    {
        $this->container['registration_date'] = $registration_date;

        return $this;
    }

    /**
     * Gets vat_registered
     *
     * @return bool
     */
    public function getVatRegistered()
    {
        return $this->container['vat_registered'];
    }

    /**
     * Sets vat_registered
     *
     * @param bool $vat_registered vat_registered
     *
     * @return $this
     */
    public function setVatRegistered($vat_registered)
    {
        $this->container['vat_registered'] = $vat_registered;

        return $this;
    }

    /**
     * Gets logistics_module
     *
     * @return bool
     */
    public function getLogisticsModule()
    {
        return $this->container['logistics_module'];
    }

    /**
     * Sets logistics_module
     *
     * @param bool $logistics_module logistics_module
     *
     * @return $this
     */
    public function setLogisticsModule($logistics_module)
    {
        $this->container['logistics_module'] = $logistics_module;

        return $this;
    }

    /**
     * Gets salary_module
     *
     * @return bool
     */
    public function getSalaryModule()
    {
        return $this->container['salary_module'];
    }

    /**
     * Sets salary_module
     *
     * @param bool $salary_module salary_module
     *
     * @return $this
     */
    public function setSalaryModule($salary_module)
    {
        $this->container['salary_module'] = $salary_module;

        return $this;
    }

    /**
     * Gets enterprises
     *
     * @return \Learnist\Tripletex\Model\EnterpriseDTO[]
     */
    public function getEnterprises()
    {
        return $this->container['enterprises'];
    }

    /**
     * Sets enterprises
     *
     * @param \Learnist\Tripletex\Model\EnterpriseDTO[] $enterprises enterprises
     *
     * @return $this
     */
    public function setEnterprises($enterprises)
    {
        $this->container['enterprises'] = $enterprises;

        return $this;
    }

    /**
     * Gets package_id
     *
     * @return int
     */
    public function getPackageId()
    {
        return $this->container['package_id'];
    }

    /**
     * Sets package_id
     *
     * @param int $package_id package_id
     *
     * @return $this
     */
    public function setPackageId($package_id)
    {
        $this->container['package_id'] = $package_id;

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
