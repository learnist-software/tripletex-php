<?php
/**
 * SalaryV2Modules
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
 * SalaryV2Modules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalaryV2Modules implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalaryV2Modules';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'module_seamen_deduction' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'module_seamen_deduction' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'module_department' => false,
		'module_nets' => false,
		'module_autopay' => false,
		'module_agro' => false,
		'module_mamut' => false,
		'module_encrypted_payslip' => false,
		'module_union_deduction' => false,
		'module_free_company_car' => false,
		'module_mesan' => false,
		'module_department_accounting' => false,
		'module_wage_project_accounting' => false,
		'module_electronic_voucher' => false,
		'module_seamen_deduction' => false
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
        'module_seamen_deduction' => 'moduleSeamenDeduction'
    ];

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
        'module_seamen_deduction' => 'setModuleSeamenDeduction'
    ];

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
        'module_seamen_deduction' => 'getModuleSeamenDeduction'
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
        $this->setIfExists('module_department', $data ?? [], null);
        $this->setIfExists('module_nets', $data ?? [], null);
        $this->setIfExists('module_autopay', $data ?? [], null);
        $this->setIfExists('module_agro', $data ?? [], null);
        $this->setIfExists('module_mamut', $data ?? [], null);
        $this->setIfExists('module_encrypted_payslip', $data ?? [], null);
        $this->setIfExists('module_union_deduction', $data ?? [], null);
        $this->setIfExists('module_free_company_car', $data ?? [], null);
        $this->setIfExists('module_mesan', $data ?? [], null);
        $this->setIfExists('module_department_accounting', $data ?? [], null);
        $this->setIfExists('module_wage_project_accounting', $data ?? [], null);
        $this->setIfExists('module_electronic_voucher', $data ?? [], null);
        $this->setIfExists('module_seamen_deduction', $data ?? [], null);
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
     * Gets module_department
     *
     * @return bool|null
     */
    public function getModuleDepartment()
    {
        return $this->container['module_department'];
    }

    /**
     * Sets module_department
     *
     * @param bool|null $module_department Module department
     *
     * @return self
     */
    public function setModuleDepartment($module_department)
    {
        if (is_null($module_department)) {
            throw new \InvalidArgumentException('non-nullable module_department cannot be null');
        }
        $this->container['module_department'] = $module_department;

        return $this;
    }

    /**
     * Gets module_nets
     *
     * @return bool|null
     */
    public function getModuleNets()
    {
        return $this->container['module_nets'];
    }

    /**
     * Sets module_nets
     *
     * @param bool|null $module_nets Module Nets
     *
     * @return self
     */
    public function setModuleNets($module_nets)
    {
        if (is_null($module_nets)) {
            throw new \InvalidArgumentException('non-nullable module_nets cannot be null');
        }
        $this->container['module_nets'] = $module_nets;

        return $this;
    }

    /**
     * Gets module_autopay
     *
     * @return bool|null
     */
    public function getModuleAutopay()
    {
        return $this->container['module_autopay'];
    }

    /**
     * Sets module_autopay
     *
     * @param bool|null $module_autopay Module Autopay
     *
     * @return self
     */
    public function setModuleAutopay($module_autopay)
    {
        if (is_null($module_autopay)) {
            throw new \InvalidArgumentException('non-nullable module_autopay cannot be null');
        }
        $this->container['module_autopay'] = $module_autopay;

        return $this;
    }

    /**
     * Gets module_agro
     *
     * @return bool|null
     */
    public function getModuleAgro()
    {
        return $this->container['module_agro'];
    }

    /**
     * Sets module_agro
     *
     * @param bool|null $module_agro Module Agro
     *
     * @return self
     */
    public function setModuleAgro($module_agro)
    {
        if (is_null($module_agro)) {
            throw new \InvalidArgumentException('non-nullable module_agro cannot be null');
        }
        $this->container['module_agro'] = $module_agro;

        return $this;
    }

    /**
     * Gets module_mamut
     *
     * @return bool|null
     */
    public function getModuleMamut()
    {
        return $this->container['module_mamut'];
    }

    /**
     * Sets module_mamut
     *
     * @param bool|null $module_mamut Module Mamut
     *
     * @return self
     */
    public function setModuleMamut($module_mamut)
    {
        if (is_null($module_mamut)) {
            throw new \InvalidArgumentException('non-nullable module_mamut cannot be null');
        }
        $this->container['module_mamut'] = $module_mamut;

        return $this;
    }

    /**
     * Gets module_encrypted_payslip
     *
     * @return bool|null
     */
    public function getModuleEncryptedPayslip()
    {
        return $this->container['module_encrypted_payslip'];
    }

    /**
     * Sets module_encrypted_payslip
     *
     * @param bool|null $module_encrypted_payslip Module Encrypted Payslip
     *
     * @return self
     */
    public function setModuleEncryptedPayslip($module_encrypted_payslip)
    {
        if (is_null($module_encrypted_payslip)) {
            throw new \InvalidArgumentException('non-nullable module_encrypted_payslip cannot be null');
        }
        $this->container['module_encrypted_payslip'] = $module_encrypted_payslip;

        return $this;
    }

    /**
     * Gets module_union_deduction
     *
     * @return bool|null
     */
    public function getModuleUnionDeduction()
    {
        return $this->container['module_union_deduction'];
    }

    /**
     * Sets module_union_deduction
     *
     * @param bool|null $module_union_deduction Module Union Deduction
     *
     * @return self
     */
    public function setModuleUnionDeduction($module_union_deduction)
    {
        if (is_null($module_union_deduction)) {
            throw new \InvalidArgumentException('non-nullable module_union_deduction cannot be null');
        }
        $this->container['module_union_deduction'] = $module_union_deduction;

        return $this;
    }

    /**
     * Gets module_free_company_car
     *
     * @return bool|null
     */
    public function getModuleFreeCompanyCar()
    {
        return $this->container['module_free_company_car'];
    }

    /**
     * Sets module_free_company_car
     *
     * @param bool|null $module_free_company_car Module Free Company Car
     *
     * @return self
     */
    public function setModuleFreeCompanyCar($module_free_company_car)
    {
        if (is_null($module_free_company_car)) {
            throw new \InvalidArgumentException('non-nullable module_free_company_car cannot be null');
        }
        $this->container['module_free_company_car'] = $module_free_company_car;

        return $this;
    }

    /**
     * Gets module_mesan
     *
     * @return bool|null
     */
    public function getModuleMesan()
    {
        return $this->container['module_mesan'];
    }

    /**
     * Sets module_mesan
     *
     * @param bool|null $module_mesan Module Mesan
     *
     * @return self
     */
    public function setModuleMesan($module_mesan)
    {
        if (is_null($module_mesan)) {
            throw new \InvalidArgumentException('non-nullable module_mesan cannot be null');
        }
        $this->container['module_mesan'] = $module_mesan;

        return $this;
    }

    /**
     * Gets module_department_accounting
     *
     * @return bool|null
     */
    public function getModuleDepartmentAccounting()
    {
        return $this->container['module_department_accounting'];
    }

    /**
     * Sets module_department_accounting
     *
     * @param bool|null $module_department_accounting Module department accounting
     *
     * @return self
     */
    public function setModuleDepartmentAccounting($module_department_accounting)
    {
        if (is_null($module_department_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_department_accounting cannot be null');
        }
        $this->container['module_department_accounting'] = $module_department_accounting;

        return $this;
    }

    /**
     * Gets module_wage_project_accounting
     *
     * @return bool|null
     */
    public function getModuleWageProjectAccounting()
    {
        return $this->container['module_wage_project_accounting'];
    }

    /**
     * Sets module_wage_project_accounting
     *
     * @param bool|null $module_wage_project_accounting Module wage project accounting
     *
     * @return self
     */
    public function setModuleWageProjectAccounting($module_wage_project_accounting)
    {
        if (is_null($module_wage_project_accounting)) {
            throw new \InvalidArgumentException('non-nullable module_wage_project_accounting cannot be null');
        }
        $this->container['module_wage_project_accounting'] = $module_wage_project_accounting;

        return $this;
    }

    /**
     * Gets module_electronic_voucher
     *
     * @return bool|null
     */
    public function getModuleElectronicVoucher()
    {
        return $this->container['module_electronic_voucher'];
    }

    /**
     * Sets module_electronic_voucher
     *
     * @param bool|null $module_electronic_voucher Module Electronic vouchers
     *
     * @return self
     */
    public function setModuleElectronicVoucher($module_electronic_voucher)
    {
        if (is_null($module_electronic_voucher)) {
            throw new \InvalidArgumentException('non-nullable module_electronic_voucher cannot be null');
        }
        $this->container['module_electronic_voucher'] = $module_electronic_voucher;

        return $this;
    }

    /**
     * Gets module_seamen_deduction
     *
     * @return bool|null
     */
    public function getModuleSeamenDeduction()
    {
        return $this->container['module_seamen_deduction'];
    }

    /**
     * Sets module_seamen_deduction
     *
     * @param bool|null $module_seamen_deduction Module seamen deduction
     *
     * @return self
     */
    public function setModuleSeamenDeduction($module_seamen_deduction)
    {
        if (is_null($module_seamen_deduction)) {
            throw new \InvalidArgumentException('non-nullable module_seamen_deduction cannot be null');
        }
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


