<?php
/**
 * SaftImportSAFTBody
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
 * SaftImportSAFTBody Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SaftImportSAFTBody implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'saft_importSAFT_body';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'saft_file' => 'string',
'mapping_file' => 'string',
'import_customer_vendors' => 'bool',
'create_missing_accounts' => 'bool',
'import_start_balance_from_opening' => 'bool',
'import_start_balance_from_closing' => 'bool',
'import_vouchers' => 'bool',
'import_departments' => 'bool',
'import_projects' => 'bool',
'tripletex_generates_customer_numbers' => 'bool',
'create_customer_ib' => 'bool',
'update_account_names' => 'bool',
'create_vendor_ib' => 'bool',
'override_voucher_date_on_discrepancy' => 'bool',
'overwrite_customers_contacts' => 'bool',
'only_active_customers' => 'bool',
'only_active_accounts' => 'bool',
'update_start_balance' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'saft_file' => 'binary',
'mapping_file' => 'binary',
'import_customer_vendors' => null,
'create_missing_accounts' => null,
'import_start_balance_from_opening' => null,
'import_start_balance_from_closing' => null,
'import_vouchers' => null,
'import_departments' => null,
'import_projects' => null,
'tripletex_generates_customer_numbers' => null,
'create_customer_ib' => null,
'update_account_names' => null,
'create_vendor_ib' => null,
'override_voucher_date_on_discrepancy' => null,
'overwrite_customers_contacts' => null,
'only_active_customers' => null,
'only_active_accounts' => null,
'update_start_balance' => null    ];

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
        'saft_file' => 'saftFile',
'mapping_file' => 'mappingFile',
'import_customer_vendors' => 'importCustomerVendors',
'create_missing_accounts' => 'createMissingAccounts',
'import_start_balance_from_opening' => 'importStartBalanceFromOpening',
'import_start_balance_from_closing' => 'importStartBalanceFromClosing',
'import_vouchers' => 'importVouchers',
'import_departments' => 'importDepartments',
'import_projects' => 'importProjects',
'tripletex_generates_customer_numbers' => 'tripletexGeneratesCustomerNumbers',
'create_customer_ib' => 'createCustomerIB',
'update_account_names' => 'updateAccountNames',
'create_vendor_ib' => 'createVendorIB',
'override_voucher_date_on_discrepancy' => 'overrideVoucherDateOnDiscrepancy',
'overwrite_customers_contacts' => 'overwriteCustomersContacts',
'only_active_customers' => 'onlyActiveCustomers',
'only_active_accounts' => 'onlyActiveAccounts',
'update_start_balance' => 'updateStartBalance'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'saft_file' => 'setSaftFile',
'mapping_file' => 'setMappingFile',
'import_customer_vendors' => 'setImportCustomerVendors',
'create_missing_accounts' => 'setCreateMissingAccounts',
'import_start_balance_from_opening' => 'setImportStartBalanceFromOpening',
'import_start_balance_from_closing' => 'setImportStartBalanceFromClosing',
'import_vouchers' => 'setImportVouchers',
'import_departments' => 'setImportDepartments',
'import_projects' => 'setImportProjects',
'tripletex_generates_customer_numbers' => 'setTripletexGeneratesCustomerNumbers',
'create_customer_ib' => 'setCreateCustomerIb',
'update_account_names' => 'setUpdateAccountNames',
'create_vendor_ib' => 'setCreateVendorIb',
'override_voucher_date_on_discrepancy' => 'setOverrideVoucherDateOnDiscrepancy',
'overwrite_customers_contacts' => 'setOverwriteCustomersContacts',
'only_active_customers' => 'setOnlyActiveCustomers',
'only_active_accounts' => 'setOnlyActiveAccounts',
'update_start_balance' => 'setUpdateStartBalance'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'saft_file' => 'getSaftFile',
'mapping_file' => 'getMappingFile',
'import_customer_vendors' => 'getImportCustomerVendors',
'create_missing_accounts' => 'getCreateMissingAccounts',
'import_start_balance_from_opening' => 'getImportStartBalanceFromOpening',
'import_start_balance_from_closing' => 'getImportStartBalanceFromClosing',
'import_vouchers' => 'getImportVouchers',
'import_departments' => 'getImportDepartments',
'import_projects' => 'getImportProjects',
'tripletex_generates_customer_numbers' => 'getTripletexGeneratesCustomerNumbers',
'create_customer_ib' => 'getCreateCustomerIb',
'update_account_names' => 'getUpdateAccountNames',
'create_vendor_ib' => 'getCreateVendorIb',
'override_voucher_date_on_discrepancy' => 'getOverrideVoucherDateOnDiscrepancy',
'overwrite_customers_contacts' => 'getOverwriteCustomersContacts',
'only_active_customers' => 'getOnlyActiveCustomers',
'only_active_accounts' => 'getOnlyActiveAccounts',
'update_start_balance' => 'getUpdateStartBalance'    ];

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
        $this->container['saft_file'] = isset($data['saft_file']) ? $data['saft_file'] : null;
        $this->container['mapping_file'] = isset($data['mapping_file']) ? $data['mapping_file'] : null;
        $this->container['import_customer_vendors'] = isset($data['import_customer_vendors']) ? $data['import_customer_vendors'] : null;
        $this->container['create_missing_accounts'] = isset($data['create_missing_accounts']) ? $data['create_missing_accounts'] : null;
        $this->container['import_start_balance_from_opening'] = isset($data['import_start_balance_from_opening']) ? $data['import_start_balance_from_opening'] : null;
        $this->container['import_start_balance_from_closing'] = isset($data['import_start_balance_from_closing']) ? $data['import_start_balance_from_closing'] : null;
        $this->container['import_vouchers'] = isset($data['import_vouchers']) ? $data['import_vouchers'] : null;
        $this->container['import_departments'] = isset($data['import_departments']) ? $data['import_departments'] : null;
        $this->container['import_projects'] = isset($data['import_projects']) ? $data['import_projects'] : null;
        $this->container['tripletex_generates_customer_numbers'] = isset($data['tripletex_generates_customer_numbers']) ? $data['tripletex_generates_customer_numbers'] : null;
        $this->container['create_customer_ib'] = isset($data['create_customer_ib']) ? $data['create_customer_ib'] : null;
        $this->container['update_account_names'] = isset($data['update_account_names']) ? $data['update_account_names'] : null;
        $this->container['create_vendor_ib'] = isset($data['create_vendor_ib']) ? $data['create_vendor_ib'] : null;
        $this->container['override_voucher_date_on_discrepancy'] = isset($data['override_voucher_date_on_discrepancy']) ? $data['override_voucher_date_on_discrepancy'] : null;
        $this->container['overwrite_customers_contacts'] = isset($data['overwrite_customers_contacts']) ? $data['overwrite_customers_contacts'] : null;
        $this->container['only_active_customers'] = isset($data['only_active_customers']) ? $data['only_active_customers'] : null;
        $this->container['only_active_accounts'] = isset($data['only_active_accounts']) ? $data['only_active_accounts'] : null;
        $this->container['update_start_balance'] = isset($data['update_start_balance']) ? $data['update_start_balance'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['saft_file'] === null) {
            $invalidProperties[] = "'saft_file' can't be null";
        }
        if ($this->container['mapping_file'] === null) {
            $invalidProperties[] = "'mapping_file' can't be null";
        }
        if ($this->container['import_customer_vendors'] === null) {
            $invalidProperties[] = "'import_customer_vendors' can't be null";
        }
        if ($this->container['create_missing_accounts'] === null) {
            $invalidProperties[] = "'create_missing_accounts' can't be null";
        }
        if ($this->container['import_start_balance_from_opening'] === null) {
            $invalidProperties[] = "'import_start_balance_from_opening' can't be null";
        }
        if ($this->container['import_start_balance_from_closing'] === null) {
            $invalidProperties[] = "'import_start_balance_from_closing' can't be null";
        }
        if ($this->container['import_vouchers'] === null) {
            $invalidProperties[] = "'import_vouchers' can't be null";
        }
        if ($this->container['import_departments'] === null) {
            $invalidProperties[] = "'import_departments' can't be null";
        }
        if ($this->container['import_projects'] === null) {
            $invalidProperties[] = "'import_projects' can't be null";
        }
        if ($this->container['tripletex_generates_customer_numbers'] === null) {
            $invalidProperties[] = "'tripletex_generates_customer_numbers' can't be null";
        }
        if ($this->container['create_customer_ib'] === null) {
            $invalidProperties[] = "'create_customer_ib' can't be null";
        }
        if ($this->container['update_account_names'] === null) {
            $invalidProperties[] = "'update_account_names' can't be null";
        }
        if ($this->container['create_vendor_ib'] === null) {
            $invalidProperties[] = "'create_vendor_ib' can't be null";
        }
        if ($this->container['override_voucher_date_on_discrepancy'] === null) {
            $invalidProperties[] = "'override_voucher_date_on_discrepancy' can't be null";
        }
        if ($this->container['overwrite_customers_contacts'] === null) {
            $invalidProperties[] = "'overwrite_customers_contacts' can't be null";
        }
        if ($this->container['only_active_customers'] === null) {
            $invalidProperties[] = "'only_active_customers' can't be null";
        }
        if ($this->container['only_active_accounts'] === null) {
            $invalidProperties[] = "'only_active_accounts' can't be null";
        }
        if ($this->container['update_start_balance'] === null) {
            $invalidProperties[] = "'update_start_balance' can't be null";
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
     * Gets saft_file
     *
     * @return string
     */
    public function getSaftFile()
    {
        return $this->container['saft_file'];
    }

    /**
     * Sets saft_file
     *
     * @param string $saft_file The SAF-T file (XML)
     *
     * @return $this
     */
    public function setSaftFile($saft_file)
    {
        $this->container['saft_file'] = $saft_file;

        return $this;
    }

    /**
     * Gets mapping_file
     *
     * @return string
     */
    public function getMappingFile()
    {
        return $this->container['mapping_file'];
    }

    /**
     * Sets mapping_file
     *
     * @param string $mapping_file Mapping of chart of accounts (Excel). See https://tripletex.no/resources/examples/saft_account_mapping.xls
     *
     * @return $this
     */
    public function setMappingFile($mapping_file)
    {
        $this->container['mapping_file'] = $mapping_file;

        return $this;
    }

    /**
     * Gets import_customer_vendors
     *
     * @return bool
     */
    public function getImportCustomerVendors()
    {
        return $this->container['import_customer_vendors'];
    }

    /**
     * Sets import_customer_vendors
     *
     * @param bool $import_customer_vendors Create customers and suppliers
     *
     * @return $this
     */
    public function setImportCustomerVendors($import_customer_vendors)
    {
        $this->container['import_customer_vendors'] = $import_customer_vendors;

        return $this;
    }

    /**
     * Gets create_missing_accounts
     *
     * @return bool
     */
    public function getCreateMissingAccounts()
    {
        return $this->container['create_missing_accounts'];
    }

    /**
     * Sets create_missing_accounts
     *
     * @param bool $create_missing_accounts Create new accounts
     *
     * @return $this
     */
    public function setCreateMissingAccounts($create_missing_accounts)
    {
        $this->container['create_missing_accounts'] = $create_missing_accounts;

        return $this;
    }

    /**
     * Gets import_start_balance_from_opening
     *
     * @return bool
     */
    public function getImportStartBalanceFromOpening()
    {
        return $this->container['import_start_balance_from_opening'];
    }

    /**
     * Sets import_start_balance_from_opening
     *
     * @param bool $import_start_balance_from_opening Create an opening balance from the import file's starting balance.
     *
     * @return $this
     */
    public function setImportStartBalanceFromOpening($import_start_balance_from_opening)
    {
        $this->container['import_start_balance_from_opening'] = $import_start_balance_from_opening;

        return $this;
    }

    /**
     * Gets import_start_balance_from_closing
     *
     * @return bool
     */
    public function getImportStartBalanceFromClosing()
    {
        return $this->container['import_start_balance_from_closing'];
    }

    /**
     * Sets import_start_balance_from_closing
     *
     * @param bool $import_start_balance_from_closing Create an opening balance from the import file's outgoing balance.
     *
     * @return $this
     */
    public function setImportStartBalanceFromClosing($import_start_balance_from_closing)
    {
        $this->container['import_start_balance_from_closing'] = $import_start_balance_from_closing;

        return $this;
    }

    /**
     * Gets import_vouchers
     *
     * @return bool
     */
    public function getImportVouchers()
    {
        return $this->container['import_vouchers'];
    }

    /**
     * Sets import_vouchers
     *
     * @param bool $import_vouchers Create vouchers
     *
     * @return $this
     */
    public function setImportVouchers($import_vouchers)
    {
        $this->container['import_vouchers'] = $import_vouchers;

        return $this;
    }

    /**
     * Gets import_departments
     *
     * @return bool
     */
    public function getImportDepartments()
    {
        return $this->container['import_departments'];
    }

    /**
     * Sets import_departments
     *
     * @param bool $import_departments Create departments
     *
     * @return $this
     */
    public function setImportDepartments($import_departments)
    {
        $this->container['import_departments'] = $import_departments;

        return $this;
    }

    /**
     * Gets import_projects
     *
     * @return bool
     */
    public function getImportProjects()
    {
        return $this->container['import_projects'];
    }

    /**
     * Sets import_projects
     *
     * @param bool $import_projects Create projects
     *
     * @return $this
     */
    public function setImportProjects($import_projects)
    {
        $this->container['import_projects'] = $import_projects;

        return $this;
    }

    /**
     * Gets tripletex_generates_customer_numbers
     *
     * @return bool
     */
    public function getTripletexGeneratesCustomerNumbers()
    {
        return $this->container['tripletex_generates_customer_numbers'];
    }

    /**
     * Sets tripletex_generates_customer_numbers
     *
     * @param bool $tripletex_generates_customer_numbers Let Tripletex create customer and supplier numbers and ignore the numbers in the import file.
     *
     * @return $this
     */
    public function setTripletexGeneratesCustomerNumbers($tripletex_generates_customer_numbers)
    {
        $this->container['tripletex_generates_customer_numbers'] = $tripletex_generates_customer_numbers;

        return $this;
    }

    /**
     * Gets create_customer_ib
     *
     * @return bool
     */
    public function getCreateCustomerIb()
    {
        return $this->container['create_customer_ib'];
    }

    /**
     * Sets create_customer_ib
     *
     * @param bool $create_customer_ib Create an opening balance on accounts receivable from customers
     *
     * @return $this
     */
    public function setCreateCustomerIb($create_customer_ib)
    {
        $this->container['create_customer_ib'] = $create_customer_ib;

        return $this;
    }

    /**
     * Gets update_account_names
     *
     * @return bool
     */
    public function getUpdateAccountNames()
    {
        return $this->container['update_account_names'];
    }

    /**
     * Sets update_account_names
     *
     * @param bool $update_account_names Overwrite existing names on accounts
     *
     * @return $this
     */
    public function setUpdateAccountNames($update_account_names)
    {
        $this->container['update_account_names'] = $update_account_names;

        return $this;
    }

    /**
     * Gets create_vendor_ib
     *
     * @return bool
     */
    public function getCreateVendorIb()
    {
        return $this->container['create_vendor_ib'];
    }

    /**
     * Sets create_vendor_ib
     *
     * @param bool $create_vendor_ib Create an opening balance on accounts payable
     *
     * @return $this
     */
    public function setCreateVendorIb($create_vendor_ib)
    {
        $this->container['create_vendor_ib'] = $create_vendor_ib;

        return $this;
    }

    /**
     * Gets override_voucher_date_on_discrepancy
     *
     * @return bool
     */
    public function getOverrideVoucherDateOnDiscrepancy()
    {
        return $this->container['override_voucher_date_on_discrepancy'];
    }

    /**
     * Sets override_voucher_date_on_discrepancy
     *
     * @param bool $override_voucher_date_on_discrepancy Overwrite transaction date on period discrepancies.
     *
     * @return $this
     */
    public function setOverrideVoucherDateOnDiscrepancy($override_voucher_date_on_discrepancy)
    {
        $this->container['override_voucher_date_on_discrepancy'] = $override_voucher_date_on_discrepancy;

        return $this;
    }

    /**
     * Gets overwrite_customers_contacts
     *
     * @return bool
     */
    public function getOverwriteCustomersContacts()
    {
        return $this->container['overwrite_customers_contacts'];
    }

    /**
     * Sets overwrite_customers_contacts
     *
     * @param bool $overwrite_customers_contacts Overwrite existing customers/contacts
     *
     * @return $this
     */
    public function setOverwriteCustomersContacts($overwrite_customers_contacts)
    {
        $this->container['overwrite_customers_contacts'] = $overwrite_customers_contacts;

        return $this;
    }

    /**
     * Gets only_active_customers
     *
     * @return bool
     */
    public function getOnlyActiveCustomers()
    {
        return $this->container['only_active_customers'];
    }

    /**
     * Sets only_active_customers
     *
     * @param bool $only_active_customers Only active customers
     *
     * @return $this
     */
    public function setOnlyActiveCustomers($only_active_customers)
    {
        $this->container['only_active_customers'] = $only_active_customers;

        return $this;
    }

    /**
     * Gets only_active_accounts
     *
     * @return bool
     */
    public function getOnlyActiveAccounts()
    {
        return $this->container['only_active_accounts'];
    }

    /**
     * Sets only_active_accounts
     *
     * @param bool $only_active_accounts Only active accounts
     *
     * @return $this
     */
    public function setOnlyActiveAccounts($only_active_accounts)
    {
        $this->container['only_active_accounts'] = $only_active_accounts;

        return $this;
    }

    /**
     * Gets update_start_balance
     *
     * @return bool
     */
    public function getUpdateStartBalance()
    {
        return $this->container['update_start_balance'];
    }

    /**
     * Sets update_start_balance
     *
     * @param bool $update_start_balance Update the opening balance of main ledger accounts from the import file by import before the opening balance.
     *
     * @return $this
     */
    public function setUpdateStartBalance($update_start_balance)
    {
        $this->container['update_start_balance'] = $update_start_balance;

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
