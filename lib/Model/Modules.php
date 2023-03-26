<?php
/**
 * Modules
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
 * Modules Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Modules implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Modules';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'accounting' => 'bool',
'invoice' => 'bool',
'salary' => 'bool',
'salary_start_date' => 'string',
'project' => 'bool',
'ocr' => 'bool',
'auto_pay_ocr' => 'bool',
'remit' => 'bool',
'electronic_vouchers' => 'bool',
'electro' => 'bool',
'vvs' => 'bool',
'agro' => 'bool',
'mamut' => 'bool',
'approve_voucher' => 'bool',
'moduleprojecteconomy' => 'bool',
'moduleemployee' => 'bool',
'module_contact' => 'bool',
'modulecustomer' => 'bool',
'moduledepartment' => 'bool',
'moduleprojectcategory' => 'bool',
'moduleinvoice' => 'bool',
'module_currency' => 'bool',
'module_project_budget' => 'bool',
'module_factoring_visma_finance' => 'string',
'complete_monthly_hour_lists' => 'bool',
'module_department_accounting' => 'bool',
'module_wage_project_accounting' => 'bool',
'module_project_accounting' => 'bool',
'module_product_accounting' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'accounting' => null,
'invoice' => null,
'salary' => null,
'salary_start_date' => null,
'project' => null,
'ocr' => null,
'auto_pay_ocr' => null,
'remit' => null,
'electronic_vouchers' => null,
'electro' => null,
'vvs' => null,
'agro' => null,
'mamut' => null,
'approve_voucher' => null,
'moduleprojecteconomy' => null,
'moduleemployee' => null,
'module_contact' => null,
'modulecustomer' => null,
'moduledepartment' => null,
'moduleprojectcategory' => null,
'moduleinvoice' => null,
'module_currency' => null,
'module_project_budget' => null,
'module_factoring_visma_finance' => null,
'complete_monthly_hour_lists' => null,
'module_department_accounting' => null,
'module_wage_project_accounting' => null,
'module_project_accounting' => null,
'module_product_accounting' => null    ];

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
        'accounting' => 'accounting',
'invoice' => 'invoice',
'salary' => 'salary',
'salary_start_date' => 'salaryStartDate',
'project' => 'project',
'ocr' => 'ocr',
'auto_pay_ocr' => 'autoPayOcr',
'remit' => 'remit',
'electronic_vouchers' => 'electronicVouchers',
'electro' => 'electro',
'vvs' => 'vvs',
'agro' => 'agro',
'mamut' => 'mamut',
'approve_voucher' => 'approveVoucher',
'moduleprojecteconomy' => 'moduleprojecteconomy',
'moduleemployee' => 'moduleemployee',
'module_contact' => 'moduleContact',
'modulecustomer' => 'modulecustomer',
'moduledepartment' => 'moduledepartment',
'moduleprojectcategory' => 'moduleprojectcategory',
'moduleinvoice' => 'moduleinvoice',
'module_currency' => 'moduleCurrency',
'module_project_budget' => 'moduleProjectBudget',
'module_factoring_visma_finance' => 'moduleFactoringVismaFinance',
'complete_monthly_hour_lists' => 'completeMonthlyHourLists',
'module_department_accounting' => 'moduleDepartmentAccounting',
'module_wage_project_accounting' => 'moduleWageProjectAccounting',
'module_project_accounting' => 'moduleProjectAccounting',
'module_product_accounting' => 'moduleProductAccounting'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'accounting' => 'setAccounting',
'invoice' => 'setInvoice',
'salary' => 'setSalary',
'salary_start_date' => 'setSalaryStartDate',
'project' => 'setProject',
'ocr' => 'setOcr',
'auto_pay_ocr' => 'setAutoPayOcr',
'remit' => 'setRemit',
'electronic_vouchers' => 'setElectronicVouchers',
'electro' => 'setElectro',
'vvs' => 'setVvs',
'agro' => 'setAgro',
'mamut' => 'setMamut',
'approve_voucher' => 'setApproveVoucher',
'moduleprojecteconomy' => 'setModuleprojecteconomy',
'moduleemployee' => 'setModuleemployee',
'module_contact' => 'setModuleContact',
'modulecustomer' => 'setModulecustomer',
'moduledepartment' => 'setModuledepartment',
'moduleprojectcategory' => 'setModuleprojectcategory',
'moduleinvoice' => 'setModuleinvoice',
'module_currency' => 'setModuleCurrency',
'module_project_budget' => 'setModuleProjectBudget',
'module_factoring_visma_finance' => 'setModuleFactoringVismaFinance',
'complete_monthly_hour_lists' => 'setCompleteMonthlyHourLists',
'module_department_accounting' => 'setModuleDepartmentAccounting',
'module_wage_project_accounting' => 'setModuleWageProjectAccounting',
'module_project_accounting' => 'setModuleProjectAccounting',
'module_product_accounting' => 'setModuleProductAccounting'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'accounting' => 'getAccounting',
'invoice' => 'getInvoice',
'salary' => 'getSalary',
'salary_start_date' => 'getSalaryStartDate',
'project' => 'getProject',
'ocr' => 'getOcr',
'auto_pay_ocr' => 'getAutoPayOcr',
'remit' => 'getRemit',
'electronic_vouchers' => 'getElectronicVouchers',
'electro' => 'getElectro',
'vvs' => 'getVvs',
'agro' => 'getAgro',
'mamut' => 'getMamut',
'approve_voucher' => 'getApproveVoucher',
'moduleprojecteconomy' => 'getModuleprojecteconomy',
'moduleemployee' => 'getModuleemployee',
'module_contact' => 'getModuleContact',
'modulecustomer' => 'getModulecustomer',
'moduledepartment' => 'getModuledepartment',
'moduleprojectcategory' => 'getModuleprojectcategory',
'moduleinvoice' => 'getModuleinvoice',
'module_currency' => 'getModuleCurrency',
'module_project_budget' => 'getModuleProjectBudget',
'module_factoring_visma_finance' => 'getModuleFactoringVismaFinance',
'complete_monthly_hour_lists' => 'getCompleteMonthlyHourLists',
'module_department_accounting' => 'getModuleDepartmentAccounting',
'module_wage_project_accounting' => 'getModuleWageProjectAccounting',
'module_project_accounting' => 'getModuleProjectAccounting',
'module_product_accounting' => 'getModuleProductAccounting'    ];

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

    const MODULE_FACTORING_VISMA_FINANCE_OFF = 'OFF';
const MODULE_FACTORING_VISMA_FINANCE_STARTED = 'STARTED';
const MODULE_FACTORING_VISMA_FINANCE_SIGNING_STARTED = 'SIGNING_STARTED';
const MODULE_FACTORING_VISMA_FINANCE_ON = 'ON';
const MODULE_FACTORING_VISMA_FINANCE_IN_REVIEW = 'IN_REVIEW';
const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_ON = 'DEACTIVATED_FROM_ON';
const MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_OFF = 'DEACTIVATED_FROM_OFF';
const MODULE_FACTORING_VISMA_FINANCE_FAILED = 'FAILED';
const MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT = 'OPTED_OUT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getModuleFactoringVismaFinanceAllowableValues()
    {
        return [
            self::MODULE_FACTORING_VISMA_FINANCE_OFF,
self::MODULE_FACTORING_VISMA_FINANCE_STARTED,
self::MODULE_FACTORING_VISMA_FINANCE_SIGNING_STARTED,
self::MODULE_FACTORING_VISMA_FINANCE_ON,
self::MODULE_FACTORING_VISMA_FINANCE_IN_REVIEW,
self::MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_ON,
self::MODULE_FACTORING_VISMA_FINANCE_DEACTIVATED_FROM_OFF,
self::MODULE_FACTORING_VISMA_FINANCE_FAILED,
self::MODULE_FACTORING_VISMA_FINANCE_OPTED_OUT,        ];
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
        $this->container['accounting'] = isset($data['accounting']) ? $data['accounting'] : null;
        $this->container['invoice'] = isset($data['invoice']) ? $data['invoice'] : null;
        $this->container['salary'] = isset($data['salary']) ? $data['salary'] : null;
        $this->container['salary_start_date'] = isset($data['salary_start_date']) ? $data['salary_start_date'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['ocr'] = isset($data['ocr']) ? $data['ocr'] : null;
        $this->container['auto_pay_ocr'] = isset($data['auto_pay_ocr']) ? $data['auto_pay_ocr'] : null;
        $this->container['remit'] = isset($data['remit']) ? $data['remit'] : null;
        $this->container['electronic_vouchers'] = isset($data['electronic_vouchers']) ? $data['electronic_vouchers'] : null;
        $this->container['electro'] = isset($data['electro']) ? $data['electro'] : null;
        $this->container['vvs'] = isset($data['vvs']) ? $data['vvs'] : null;
        $this->container['agro'] = isset($data['agro']) ? $data['agro'] : null;
        $this->container['mamut'] = isset($data['mamut']) ? $data['mamut'] : null;
        $this->container['approve_voucher'] = isset($data['approve_voucher']) ? $data['approve_voucher'] : null;
        $this->container['moduleprojecteconomy'] = isset($data['moduleprojecteconomy']) ? $data['moduleprojecteconomy'] : null;
        $this->container['moduleemployee'] = isset($data['moduleemployee']) ? $data['moduleemployee'] : null;
        $this->container['module_contact'] = isset($data['module_contact']) ? $data['module_contact'] : null;
        $this->container['modulecustomer'] = isset($data['modulecustomer']) ? $data['modulecustomer'] : null;
        $this->container['moduledepartment'] = isset($data['moduledepartment']) ? $data['moduledepartment'] : null;
        $this->container['moduleprojectcategory'] = isset($data['moduleprojectcategory']) ? $data['moduleprojectcategory'] : null;
        $this->container['moduleinvoice'] = isset($data['moduleinvoice']) ? $data['moduleinvoice'] : null;
        $this->container['module_currency'] = isset($data['module_currency']) ? $data['module_currency'] : null;
        $this->container['module_project_budget'] = isset($data['module_project_budget']) ? $data['module_project_budget'] : null;
        $this->container['module_factoring_visma_finance'] = isset($data['module_factoring_visma_finance']) ? $data['module_factoring_visma_finance'] : null;
        $this->container['complete_monthly_hour_lists'] = isset($data['complete_monthly_hour_lists']) ? $data['complete_monthly_hour_lists'] : null;
        $this->container['module_department_accounting'] = isset($data['module_department_accounting']) ? $data['module_department_accounting'] : null;
        $this->container['module_wage_project_accounting'] = isset($data['module_wage_project_accounting']) ? $data['module_wage_project_accounting'] : null;
        $this->container['module_project_accounting'] = isset($data['module_project_accounting']) ? $data['module_project_accounting'] : null;
        $this->container['module_product_accounting'] = isset($data['module_product_accounting']) ? $data['module_product_accounting'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getModuleFactoringVismaFinanceAllowableValues();
        if (!is_null($this->container['module_factoring_visma_finance']) && !in_array($this->container['module_factoring_visma_finance'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'module_factoring_visma_finance', must be one of '%s'",
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
     * Gets accounting
     *
     * @return bool
     */
    public function getAccounting()
    {
        return $this->container['accounting'];
    }

    /**
     * Sets accounting
     *
     * @param bool $accounting Not readable. Only for input.
     *
     * @return $this
     */
    public function setAccounting($accounting)
    {
        $this->container['accounting'] = $accounting;

        return $this;
    }

    /**
     * Gets invoice
     *
     * @return bool
     */
    public function getInvoice()
    {
        return $this->container['invoice'];
    }

    /**
     * Sets invoice
     *
     * @param bool $invoice Not readable. Only for input.
     *
     * @return $this
     */
    public function setInvoice($invoice)
    {
        $this->container['invoice'] = $invoice;

        return $this;
    }

    /**
     * Gets salary
     *
     * @return bool
     */
    public function getSalary()
    {
        return $this->container['salary'];
    }

    /**
     * Sets salary
     *
     * @param bool $salary Not readable. Only for input.
     *
     * @return $this
     */
    public function setSalary($salary)
    {
        $this->container['salary'] = $salary;

        return $this;
    }

    /**
     * Gets salary_start_date
     *
     * @return string
     */
    public function getSalaryStartDate()
    {
        return $this->container['salary_start_date'];
    }

    /**
     * Sets salary_start_date
     *
     * @param string $salary_start_date salary_start_date
     *
     * @return $this
     */
    public function setSalaryStartDate($salary_start_date)
    {
        $this->container['salary_start_date'] = $salary_start_date;

        return $this;
    }

    /**
     * Gets project
     *
     * @return bool
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param bool $project Not readable. Only for input.
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets ocr
     *
     * @return bool
     */
    public function getOcr()
    {
        return $this->container['ocr'];
    }

    /**
     * Sets ocr
     *
     * @param bool $ocr ocr
     *
     * @return $this
     */
    public function setOcr($ocr)
    {
        $this->container['ocr'] = $ocr;

        return $this;
    }

    /**
     * Gets auto_pay_ocr
     *
     * @return bool
     */
    public function getAutoPayOcr()
    {
        return $this->container['auto_pay_ocr'];
    }

    /**
     * Sets auto_pay_ocr
     *
     * @param bool $auto_pay_ocr auto_pay_ocr
     *
     * @return $this
     */
    public function setAutoPayOcr($auto_pay_ocr)
    {
        $this->container['auto_pay_ocr'] = $auto_pay_ocr;

        return $this;
    }

    /**
     * Gets remit
     *
     * @return bool
     */
    public function getRemit()
    {
        return $this->container['remit'];
    }

    /**
     * Sets remit
     *
     * @param bool $remit remit
     *
     * @return $this
     */
    public function setRemit($remit)
    {
        $this->container['remit'] = $remit;

        return $this;
    }

    /**
     * Gets electronic_vouchers
     *
     * @return bool
     */
    public function getElectronicVouchers()
    {
        return $this->container['electronic_vouchers'];
    }

    /**
     * Sets electronic_vouchers
     *
     * @param bool $electronic_vouchers Not readable. Only for input.
     *
     * @return $this
     */
    public function setElectronicVouchers($electronic_vouchers)
    {
        $this->container['electronic_vouchers'] = $electronic_vouchers;

        return $this;
    }

    /**
     * Gets electro
     *
     * @return bool
     */
    public function getElectro()
    {
        return $this->container['electro'];
    }

    /**
     * Sets electro
     *
     * @param bool $electro Not readable. Only for input.
     *
     * @return $this
     */
    public function setElectro($electro)
    {
        $this->container['electro'] = $electro;

        return $this;
    }

    /**
     * Gets vvs
     *
     * @return bool
     */
    public function getVvs()
    {
        return $this->container['vvs'];
    }

    /**
     * Sets vvs
     *
     * @param bool $vvs Not readable. Only for input.
     *
     * @return $this
     */
    public function setVvs($vvs)
    {
        $this->container['vvs'] = $vvs;

        return $this;
    }

    /**
     * Gets agro
     *
     * @return bool
     */
    public function getAgro()
    {
        return $this->container['agro'];
    }

    /**
     * Sets agro
     *
     * @param bool $agro agro
     *
     * @return $this
     */
    public function setAgro($agro)
    {
        $this->container['agro'] = $agro;

        return $this;
    }

    /**
     * Gets mamut
     *
     * @return bool
     */
    public function getMamut()
    {
        return $this->container['mamut'];
    }

    /**
     * Sets mamut
     *
     * @param bool $mamut mamut
     *
     * @return $this
     */
    public function setMamut($mamut)
    {
        $this->container['mamut'] = $mamut;

        return $this;
    }

    /**
     * Gets approve_voucher
     *
     * @return bool
     */
    public function getApproveVoucher()
    {
        return $this->container['approve_voucher'];
    }

    /**
     * Sets approve_voucher
     *
     * @param bool $approve_voucher Only readable for now
     *
     * @return $this
     */
    public function setApproveVoucher($approve_voucher)
    {
        $this->container['approve_voucher'] = $approve_voucher;

        return $this;
    }

    /**
     * Gets moduleprojecteconomy
     *
     * @return bool
     */
    public function getModuleprojecteconomy()
    {
        return $this->container['moduleprojecteconomy'];
    }

    /**
     * Sets moduleprojecteconomy
     *
     * @param bool $moduleprojecteconomy moduleprojecteconomy
     *
     * @return $this
     */
    public function setModuleprojecteconomy($moduleprojecteconomy)
    {
        $this->container['moduleprojecteconomy'] = $moduleprojecteconomy;

        return $this;
    }

    /**
     * Gets moduleemployee
     *
     * @return bool
     */
    public function getModuleemployee()
    {
        return $this->container['moduleemployee'];
    }

    /**
     * Sets moduleemployee
     *
     * @param bool $moduleemployee moduleemployee
     *
     * @return $this
     */
    public function setModuleemployee($moduleemployee)
    {
        $this->container['moduleemployee'] = $moduleemployee;

        return $this;
    }

    /**
     * Gets module_contact
     *
     * @return bool
     */
    public function getModuleContact()
    {
        return $this->container['module_contact'];
    }

    /**
     * Sets module_contact
     *
     * @param bool $module_contact module_contact
     *
     * @return $this
     */
    public function setModuleContact($module_contact)
    {
        $this->container['module_contact'] = $module_contact;

        return $this;
    }

    /**
     * Gets modulecustomer
     *
     * @return bool
     */
    public function getModulecustomer()
    {
        return $this->container['modulecustomer'];
    }

    /**
     * Sets modulecustomer
     *
     * @param bool $modulecustomer modulecustomer
     *
     * @return $this
     */
    public function setModulecustomer($modulecustomer)
    {
        $this->container['modulecustomer'] = $modulecustomer;

        return $this;
    }

    /**
     * Gets moduledepartment
     *
     * @return bool
     */
    public function getModuledepartment()
    {
        return $this->container['moduledepartment'];
    }

    /**
     * Sets moduledepartment
     *
     * @param bool $moduledepartment moduledepartment
     *
     * @return $this
     */
    public function setModuledepartment($moduledepartment)
    {
        $this->container['moduledepartment'] = $moduledepartment;

        return $this;
    }

    /**
     * Gets moduleprojectcategory
     *
     * @return bool
     */
    public function getModuleprojectcategory()
    {
        return $this->container['moduleprojectcategory'];
    }

    /**
     * Sets moduleprojectcategory
     *
     * @param bool $moduleprojectcategory moduleprojectcategory
     *
     * @return $this
     */
    public function setModuleprojectcategory($moduleprojectcategory)
    {
        $this->container['moduleprojectcategory'] = $moduleprojectcategory;

        return $this;
    }

    /**
     * Gets moduleinvoice
     *
     * @return bool
     */
    public function getModuleinvoice()
    {
        return $this->container['moduleinvoice'];
    }

    /**
     * Sets moduleinvoice
     *
     * @param bool $moduleinvoice moduleinvoice
     *
     * @return $this
     */
    public function setModuleinvoice($moduleinvoice)
    {
        $this->container['moduleinvoice'] = $moduleinvoice;

        return $this;
    }

    /**
     * Gets module_currency
     *
     * @return bool
     */
    public function getModuleCurrency()
    {
        return $this->container['module_currency'];
    }

    /**
     * Sets module_currency
     *
     * @param bool $module_currency module_currency
     *
     * @return $this
     */
    public function setModuleCurrency($module_currency)
    {
        $this->container['module_currency'] = $module_currency;

        return $this;
    }

    /**
     * Gets module_project_budget
     *
     * @return bool
     */
    public function getModuleProjectBudget()
    {
        return $this->container['module_project_budget'];
    }

    /**
     * Sets module_project_budget
     *
     * @param bool $module_project_budget module_project_budget
     *
     * @return $this
     */
    public function setModuleProjectBudget($module_project_budget)
    {
        $this->container['module_project_budget'] = $module_project_budget;

        return $this;
    }

    /**
     * Gets module_factoring_visma_finance
     *
     * @return string
     */
    public function getModuleFactoringVismaFinance()
    {
        return $this->container['module_factoring_visma_finance'];
    }

    /**
     * Sets module_factoring_visma_finance
     *
     * @param string $module_factoring_visma_finance module_factoring_visma_finance
     *
     * @return $this
     */
    public function setModuleFactoringVismaFinance($module_factoring_visma_finance)
    {
        $allowedValues = $this->getModuleFactoringVismaFinanceAllowableValues();
        if (!is_null($module_factoring_visma_finance) && !in_array($module_factoring_visma_finance, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'module_factoring_visma_finance', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['module_factoring_visma_finance'] = $module_factoring_visma_finance;

        return $this;
    }

    /**
     * Gets complete_monthly_hour_lists
     *
     * @return bool
     */
    public function getCompleteMonthlyHourLists()
    {
        return $this->container['complete_monthly_hour_lists'];
    }

    /**
     * Sets complete_monthly_hour_lists
     *
     * @param bool $complete_monthly_hour_lists complete_monthly_hour_lists
     *
     * @return $this
     */
    public function setCompleteMonthlyHourLists($complete_monthly_hour_lists)
    {
        $this->container['complete_monthly_hour_lists'] = $complete_monthly_hour_lists;

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
     * @param bool $module_department_accounting module_department_accounting
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
     * @param bool $module_wage_project_accounting module_wage_project_accounting
     *
     * @return $this
     */
    public function setModuleWageProjectAccounting($module_wage_project_accounting)
    {
        $this->container['module_wage_project_accounting'] = $module_wage_project_accounting;

        return $this;
    }

    /**
     * Gets module_project_accounting
     *
     * @return bool
     */
    public function getModuleProjectAccounting()
    {
        return $this->container['module_project_accounting'];
    }

    /**
     * Sets module_project_accounting
     *
     * @param bool $module_project_accounting read only
     *
     * @return $this
     */
    public function setModuleProjectAccounting($module_project_accounting)
    {
        $this->container['module_project_accounting'] = $module_project_accounting;

        return $this;
    }

    /**
     * Gets module_product_accounting
     *
     * @return bool
     */
    public function getModuleProductAccounting()
    {
        return $this->container['module_product_accounting'];
    }

    /**
     * Sets module_product_accounting
     *
     * @param bool $module_product_accounting read only
     *
     * @return $this
     */
    public function setModuleProductAccounting($module_product_accounting)
    {
        $this->container['module_product_accounting'] = $module_product_accounting;

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
