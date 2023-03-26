<?php
/**
 * SalaryV2Modules
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
 * SalaryV2Modules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SalaryV2Modules implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SalaryV2Modules';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'module_department' => 'bool',
'module_nets' => 'bool',
'module_autopay' => 'bool',
'module_agro' => 'bool',
'module_mamut' => 'bool',
'module_encrypted_payslip' => 'bool',
'module_union_deduction' => 'bool',
'module_free_company_car' => 'bool',
'module_mesan' => 'bool',
'module_department_accounting' => 'bool',
'module_wage_project_accounting' => 'bool',
'module_electronic_voucher' => 'bool',
'module_seamen_deduction' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'module_department' => null,
'module_nets' => null,
'module_autopay' => null,
'module_agro' => null,
'module_mamut' => null,
'module_encrypted_payslip' => null,
'module_union_deduction' => null,
'module_free_company_car' => null,
'module_mesan' => null,
'module_department_accounting' => null,
'module_wage_project_accounting' => null,
'module_electronic_voucher' => null,
'module_seamen_deduction' => null    ];

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
        'module_department' => 'moduleDepartment',
'module_nets' => 'moduleNets',
'module_autopay' => 'moduleAutopay',
'module_agro' => 'moduleAgro',
'module_mamut' => 'moduleMamut',
'module_encrypted_payslip' => 'moduleEncryptedPayslip',
'module_union_deduction' => 'moduleUnionDeduction',
'module_free_company_car' => 'moduleFreeCompanyCar',
'module_mesan' => 'moduleMesan',
'module_department_accounting' => 'moduleDepartmentAccounting',
'module_wage_project_accounting' => 'moduleWageProjectAccounting',
'module_electronic_voucher' => 'moduleElectronicVoucher',
'module_seamen_deduction' => 'moduleSeamenDeduction'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'module_department' => 'setModuleDepartment',
'module_nets' => 'setModuleNets',
'module_autopay' => 'setModuleAutopay',
'module_agro' => 'setModuleAgro',
'module_mamut' => 'setModuleMamut',
'module_encrypted_payslip' => 'setModuleEncryptedPayslip',
'module_union_deduction' => 'setModuleUnionDeduction',
'module_free_company_car' => 'setModuleFreeCompanyCar',
'module_mesan' => 'setModuleMesan',
'module_department_accounting' => 'setModuleDepartmentAccounting',
'module_wage_project_accounting' => 'setModuleWageProjectAccounting',
'module_electronic_voucher' => 'setModuleElectronicVoucher',
'module_seamen_deduction' => 'setModuleSeamenDeduction'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'module_department' => 'getModuleDepartment',
'module_nets' => 'getModuleNets',
'module_autopay' => 'getModuleAutopay',
'module_agro' => 'getModuleAgro',
'module_mamut' => 'getModuleMamut',
'module_encrypted_payslip' => 'getModuleEncryptedPayslip',
'module_union_deduction' => 'getModuleUnionDeduction',
'module_free_company_car' => 'getModuleFreeCompanyCar',
'module_mesan' => 'getModuleMesan',
'module_department_accounting' => 'getModuleDepartmentAccounting',
'module_wage_project_accounting' => 'getModuleWageProjectAccounting',
'module_electronic_voucher' => 'getModuleElectronicVoucher',
'module_seamen_deduction' => 'getModuleSeamenDeduction'    ];

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
        $this->container['module_department'] = isset($data['module_department']) ? $data['module_department'] : null;
        $this->container['module_nets'] = isset($data['module_nets']) ? $data['module_nets'] : null;
        $this->container['module_autopay'] = isset($data['module_autopay']) ? $data['module_autopay'] : null;
        $this->container['module_agro'] = isset($data['module_agro']) ? $data['module_agro'] : null;
        $this->container['module_mamut'] = isset($data['module_mamut']) ? $data['module_mamut'] : null;
        $this->container['module_encrypted_payslip'] = isset($data['module_encrypted_payslip']) ? $data['module_encrypted_payslip'] : null;
        $this->container['module_union_deduction'] = isset($data['module_union_deduction']) ? $data['module_union_deduction'] : null;
        $this->container['module_free_company_car'] = isset($data['module_free_company_car']) ? $data['module_free_company_car'] : null;
        $this->container['module_mesan'] = isset($data['module_mesan']) ? $data['module_mesan'] : null;
        $this->container['module_department_accounting'] = isset($data['module_department_accounting']) ? $data['module_department_accounting'] : null;
        $this->container['module_wage_project_accounting'] = isset($data['module_wage_project_accounting']) ? $data['module_wage_project_accounting'] : null;
        $this->container['module_electronic_voucher'] = isset($data['module_electronic_voucher']) ? $data['module_electronic_voucher'] : null;
        $this->container['module_seamen_deduction'] = isset($data['module_seamen_deduction']) ? $data['module_seamen_deduction'] : null;
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
     * Gets module_department
     *
     * @return bool
     */
    public function getModuleDepartment()
    {
        return $this->container['module_department'];
    }

    /**
     * Sets module_department
     *
     * @param bool $module_department Module department
     *
     * @return $this
     */
    public function setModuleDepartment($module_department)
    {
        $this->container['module_department'] = $module_department;

        return $this;
    }

    /**
     * Gets module_nets
     *
     * @return bool
     */
    public function getModuleNets()
    {
        return $this->container['module_nets'];
    }

    /**
     * Sets module_nets
     *
     * @param bool $module_nets Module Nets
     *
     * @return $this
     */
    public function setModuleNets($module_nets)
    {
        $this->container['module_nets'] = $module_nets;

        return $this;
    }

    /**
     * Gets module_autopay
     *
     * @return bool
     */
    public function getModuleAutopay()
    {
        return $this->container['module_autopay'];
    }

    /**
     * Sets module_autopay
     *
     * @param bool $module_autopay Module Autopay
     *
     * @return $this
     */
    public function setModuleAutopay($module_autopay)
    {
        $this->container['module_autopay'] = $module_autopay;

        return $this;
    }

    /**
     * Gets module_agro
     *
     * @return bool
     */
    public function getModuleAgro()
    {
        return $this->container['module_agro'];
    }

    /**
     * Sets module_agro
     *
     * @param bool $module_agro Module Agro
     *
     * @return $this
     */
    public function setModuleAgro($module_agro)
    {
        $this->container['module_agro'] = $module_agro;

        return $this;
    }

    /**
     * Gets module_mamut
     *
     * @return bool
     */
    public function getModuleMamut()
    {
        return $this->container['module_mamut'];
    }

    /**
     * Sets module_mamut
     *
     * @param bool $module_mamut Module Mamut
     *
     * @return $this
     */
    public function setModuleMamut($module_mamut)
    {
        $this->container['module_mamut'] = $module_mamut;

        return $this;
    }

    /**
     * Gets module_encrypted_payslip
     *
     * @return bool
     */
    public function getModuleEncryptedPayslip()
    {
        return $this->container['module_encrypted_payslip'];
    }

    /**
     * Sets module_encrypted_payslip
     *
     * @param bool $module_encrypted_payslip Module Encrypted Payslip
     *
     * @return $this
     */
    public function setModuleEncryptedPayslip($module_encrypted_payslip)
    {
        $this->container['module_encrypted_payslip'] = $module_encrypted_payslip;

        return $this;
    }

    /**
     * Gets module_union_deduction
     *
     * @return bool
     */
    public function getModuleUnionDeduction()
    {
        return $this->container['module_union_deduction'];
    }

    /**
     * Sets module_union_deduction
     *
     * @param bool $module_union_deduction Module Union Deduction
     *
     * @return $this
     */
    public function setModuleUnionDeduction($module_union_deduction)
    {
        $this->container['module_union_deduction'] = $module_union_deduction;

        return $this;
    }

    /**
     * Gets module_free_company_car
     *
     * @return bool
     */
    public function getModuleFreeCompanyCar()
    {
        return $this->container['module_free_company_car'];
    }

    /**
     * Sets module_free_company_car
     *
     * @param bool $module_free_company_car Module Free Company Car
     *
     * @return $this
     */
    public function setModuleFreeCompanyCar($module_free_company_car)
    {
        $this->container['module_free_company_car'] = $module_free_company_car;

        return $this;
    }

    /**
     * Gets module_mesan
     *
     * @return bool
     */
    public function getModuleMesan()
    {
        return $this->container['module_mesan'];
    }

    /**
     * Sets module_mesan
     *
     * @param bool $module_mesan Module Mesan
     *
     * @return $this
     */
    public function setModuleMesan($module_mesan)
    {
        $this->container['module_mesan'] = $module_mesan;

        return $this;
    }

    /**
     * Gets module_department_accounting
     *
     * @return bool
     */
    public function getModuleDepartmentAccounting()
    {
        return $this->container['module_department_accounting'];
    }

    /**
     * Sets module_department_accounting
     *
     * @param bool $module_department_accounting Module department accounting
     *
     * @return $this
     */
    public function setModuleDepartmentAccounting($module_department_accounting)
    {
        $this->container['module_department_accounting'] = $module_department_accounting;

        return $this;
    }

    /**
     * Gets module_wage_project_accounting
     *
     * @return bool
     */
    public function getModuleWageProjectAccounting()
    {
        return $this->container['module_wage_project_accounting'];
    }

    /**
     * Sets module_wage_project_accounting
     *
     * @param bool $module_wage_project_accounting Module wage project accounting
     *
     * @return $this
     */
    public function setModuleWageProjectAccounting($module_wage_project_accounting)
    {
        $this->container['module_wage_project_accounting'] = $module_wage_project_accounting;

        return $this;
    }

    /**
     * Gets module_electronic_voucher
     *
     * @return bool
     */
    public function getModuleElectronicVoucher()
    {
        return $this->container['module_electronic_voucher'];
    }

    /**
     * Sets module_electronic_voucher
     *
     * @param bool $module_electronic_voucher Module Electronic vouchers
     *
     * @return $this
     */
    public function setModuleElectronicVoucher($module_electronic_voucher)
    {
        $this->container['module_electronic_voucher'] = $module_electronic_voucher;

        return $this;
    }

    /**
     * Gets module_seamen_deduction
     *
     * @return bool
     */
    public function getModuleSeamenDeduction()
    {
        return $this->container['module_seamen_deduction'];
    }

    /**
     * Sets module_seamen_deduction
     *
     * @param bool $module_seamen_deduction Module seamen deduction
     *
     * @return $this
     */
    public function setModuleSeamenDeduction($module_seamen_deduction)
    {
        $this->container['module_seamen_deduction'] = $module_seamen_deduction;

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
