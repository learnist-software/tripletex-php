<?php
/**
 * Account
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
 * Account Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Account implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Account';

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
'number' => 'int',
'name' => 'string',
'description' => 'string',
'type' => 'string',
'legal_vat_types' => '\Learnist\Tripletex\Model\VatType[]',
'ledger_type' => 'string',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'vat_locked' => 'bool',
'currency' => '\Learnist\Tripletex\Model\Currency',
'is_closeable' => 'bool',
'is_applicable_for_supplier_invoice' => 'bool',
'require_reconciliation' => 'bool',
'is_inactive' => 'bool',
'is_bank_account' => 'bool',
'is_invoice_account' => 'bool',
'bank_account_number' => 'string',
'bank_account_country' => '\Learnist\Tripletex\Model\Country',
'bank_name' => 'string',
'bank_account_iban' => 'string',
'bank_account_swift' => 'string',
'saft_code' => 'string',
'display_name' => 'string',
'requires_department' => 'bool',
'requires_project' => 'bool',
'invoicing_department' => '\Learnist\Tripletex\Model\Department'    ];

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
'number' => 'int32',
'name' => null,
'description' => null,
'type' => null,
'legal_vat_types' => null,
'ledger_type' => null,
'vat_type' => null,
'vat_locked' => null,
'currency' => null,
'is_closeable' => null,
'is_applicable_for_supplier_invoice' => null,
'require_reconciliation' => null,
'is_inactive' => null,
'is_bank_account' => null,
'is_invoice_account' => null,
'bank_account_number' => null,
'bank_account_country' => null,
'bank_name' => null,
'bank_account_iban' => null,
'bank_account_swift' => null,
'saft_code' => null,
'display_name' => null,
'requires_department' => null,
'requires_project' => null,
'invoicing_department' => null    ];

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
'number' => 'number',
'name' => 'name',
'description' => 'description',
'type' => 'type',
'legal_vat_types' => 'legalVatTypes',
'ledger_type' => 'ledgerType',
'vat_type' => 'vatType',
'vat_locked' => 'vatLocked',
'currency' => 'currency',
'is_closeable' => 'isCloseable',
'is_applicable_for_supplier_invoice' => 'isApplicableForSupplierInvoice',
'require_reconciliation' => 'requireReconciliation',
'is_inactive' => 'isInactive',
'is_bank_account' => 'isBankAccount',
'is_invoice_account' => 'isInvoiceAccount',
'bank_account_number' => 'bankAccountNumber',
'bank_account_country' => 'bankAccountCountry',
'bank_name' => 'bankName',
'bank_account_iban' => 'bankAccountIBAN',
'bank_account_swift' => 'bankAccountSWIFT',
'saft_code' => 'saftCode',
'display_name' => 'displayName',
'requires_department' => 'requiresDepartment',
'requires_project' => 'requiresProject',
'invoicing_department' => 'invoicingDepartment'    ];

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
'description' => 'setDescription',
'type' => 'setType',
'legal_vat_types' => 'setLegalVatTypes',
'ledger_type' => 'setLedgerType',
'vat_type' => 'setVatType',
'vat_locked' => 'setVatLocked',
'currency' => 'setCurrency',
'is_closeable' => 'setIsCloseable',
'is_applicable_for_supplier_invoice' => 'setIsApplicableForSupplierInvoice',
'require_reconciliation' => 'setRequireReconciliation',
'is_inactive' => 'setIsInactive',
'is_bank_account' => 'setIsBankAccount',
'is_invoice_account' => 'setIsInvoiceAccount',
'bank_account_number' => 'setBankAccountNumber',
'bank_account_country' => 'setBankAccountCountry',
'bank_name' => 'setBankName',
'bank_account_iban' => 'setBankAccountIban',
'bank_account_swift' => 'setBankAccountSwift',
'saft_code' => 'setSaftCode',
'display_name' => 'setDisplayName',
'requires_department' => 'setRequiresDepartment',
'requires_project' => 'setRequiresProject',
'invoicing_department' => 'setInvoicingDepartment'    ];

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
'description' => 'getDescription',
'type' => 'getType',
'legal_vat_types' => 'getLegalVatTypes',
'ledger_type' => 'getLedgerType',
'vat_type' => 'getVatType',
'vat_locked' => 'getVatLocked',
'currency' => 'getCurrency',
'is_closeable' => 'getIsCloseable',
'is_applicable_for_supplier_invoice' => 'getIsApplicableForSupplierInvoice',
'require_reconciliation' => 'getRequireReconciliation',
'is_inactive' => 'getIsInactive',
'is_bank_account' => 'getIsBankAccount',
'is_invoice_account' => 'getIsInvoiceAccount',
'bank_account_number' => 'getBankAccountNumber',
'bank_account_country' => 'getBankAccountCountry',
'bank_name' => 'getBankName',
'bank_account_iban' => 'getBankAccountIban',
'bank_account_swift' => 'getBankAccountSwift',
'saft_code' => 'getSaftCode',
'display_name' => 'getDisplayName',
'requires_department' => 'getRequiresDepartment',
'requires_project' => 'getRequiresProject',
'invoicing_department' => 'getInvoicingDepartment'    ];

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

    const TYPE_ASSETS = 'ASSETS';
const TYPE_EQUITY = 'EQUITY';
const TYPE_LIABILITIES = 'LIABILITIES';
const TYPE_OPERATING_REVENUES = 'OPERATING_REVENUES';
const TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
const TYPE_INVESTMENT_INCOME = 'INVESTMENT_INCOME';
const TYPE_COST_OF_CAPITAL = 'COST_OF_CAPITAL';
const TYPE_TAX_ON_ORDINARY_ACTIVITIES = 'TAX_ON_ORDINARY_ACTIVITIES';
const TYPE_EXTRAORDINARY_INCOME = 'EXTRAORDINARY_INCOME';
const TYPE_EXTRAORDINARY_COST = 'EXTRAORDINARY_COST';
const TYPE_TAX_ON_EXTRAORDINARY_ACTIVITIES = 'TAX_ON_EXTRAORDINARY_ACTIVITIES';
const TYPE_ANNUAL_RESULT = 'ANNUAL_RESULT';
const TYPE_TRANSFERS_AND_ALLOCATIONS = 'TRANSFERS_AND_ALLOCATIONS';
const LEDGER_TYPE_GENERAL = 'GENERAL';
const LEDGER_TYPE_CUSTOMER = 'CUSTOMER';
const LEDGER_TYPE_VENDOR = 'VENDOR';
const LEDGER_TYPE_EMPLOYEE = 'EMPLOYEE';
const LEDGER_TYPE_ASSET = 'ASSET';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_ASSETS,
self::TYPE_EQUITY,
self::TYPE_LIABILITIES,
self::TYPE_OPERATING_REVENUES,
self::TYPE_OPERATING_EXPENSES,
self::TYPE_INVESTMENT_INCOME,
self::TYPE_COST_OF_CAPITAL,
self::TYPE_TAX_ON_ORDINARY_ACTIVITIES,
self::TYPE_EXTRAORDINARY_INCOME,
self::TYPE_EXTRAORDINARY_COST,
self::TYPE_TAX_ON_EXTRAORDINARY_ACTIVITIES,
self::TYPE_ANNUAL_RESULT,
self::TYPE_TRANSFERS_AND_ALLOCATIONS,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLedgerTypeAllowableValues()
    {
        return [
            self::LEDGER_TYPE_GENERAL,
self::LEDGER_TYPE_CUSTOMER,
self::LEDGER_TYPE_VENDOR,
self::LEDGER_TYPE_EMPLOYEE,
self::LEDGER_TYPE_ASSET,        ];
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
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['legal_vat_types'] = isset($data['legal_vat_types']) ? $data['legal_vat_types'] : null;
        $this->container['ledger_type'] = isset($data['ledger_type']) ? $data['ledger_type'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['vat_locked'] = isset($data['vat_locked']) ? $data['vat_locked'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['is_closeable'] = isset($data['is_closeable']) ? $data['is_closeable'] : null;
        $this->container['is_applicable_for_supplier_invoice'] = isset($data['is_applicable_for_supplier_invoice']) ? $data['is_applicable_for_supplier_invoice'] : null;
        $this->container['require_reconciliation'] = isset($data['require_reconciliation']) ? $data['require_reconciliation'] : null;
        $this->container['is_inactive'] = isset($data['is_inactive']) ? $data['is_inactive'] : null;
        $this->container['is_bank_account'] = isset($data['is_bank_account']) ? $data['is_bank_account'] : null;
        $this->container['is_invoice_account'] = isset($data['is_invoice_account']) ? $data['is_invoice_account'] : null;
        $this->container['bank_account_number'] = isset($data['bank_account_number']) ? $data['bank_account_number'] : null;
        $this->container['bank_account_country'] = isset($data['bank_account_country']) ? $data['bank_account_country'] : null;
        $this->container['bank_name'] = isset($data['bank_name']) ? $data['bank_name'] : null;
        $this->container['bank_account_iban'] = isset($data['bank_account_iban']) ? $data['bank_account_iban'] : null;
        $this->container['bank_account_swift'] = isset($data['bank_account_swift']) ? $data['bank_account_swift'] : null;
        $this->container['saft_code'] = isset($data['saft_code']) ? $data['saft_code'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['requires_department'] = isset($data['requires_department']) ? $data['requires_department'] : null;
        $this->container['requires_project'] = isset($data['requires_project']) ? $data['requires_project'] : null;
        $this->container['invoicing_department'] = isset($data['invoicing_department']) ? $data['invoicing_department'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['number'] === null) {
            $invalidProperties[] = "'number' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getLedgerTypeAllowableValues();
        if (!is_null($this->container['ledger_type']) && !in_array($this->container['ledger_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'ledger_type', must be one of '%s'",
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
     * Gets number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param int $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets legal_vat_types
     *
     * @return \Learnist\Tripletex\Model\VatType[]
     */
    public function getLegalVatTypes()
    {
        return $this->container['legal_vat_types'];
    }

    /**
     * Sets legal_vat_types
     *
     * @param \Learnist\Tripletex\Model\VatType[] $legal_vat_types List of legal vat types for this account.
     *
     * @return $this
     */
    public function setLegalVatTypes($legal_vat_types)
    {
        $this->container['legal_vat_types'] = $legal_vat_types;

        return $this;
    }

    /**
     * Gets ledger_type
     *
     * @return string
     */
    public function getLedgerType()
    {
        return $this->container['ledger_type'];
    }

    /**
     * Sets ledger_type
     *
     * @param string $ledger_type Supported ledger types, default is GENERAL. Only available for customers with the module multiple ledgers.
     *
     * @return $this
     */
    public function setLedgerType($ledger_type)
    {
        $allowedValues = $this->getLedgerTypeAllowableValues();
        if (!is_null($ledger_type) && !in_array($ledger_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'ledger_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['ledger_type'] = $ledger_type;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType $vat_type vat_type
     *
     * @return $this
     */
    public function setVatType($vat_type)
    {
        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets vat_locked
     *
     * @return bool
     */
    public function getVatLocked()
    {
        return $this->container['vat_locked'];
    }

    /**
     * Sets vat_locked
     *
     * @param bool $vat_locked True if all entries on this account must have the vat type given by vatType.
     *
     * @return $this
     */
    public function setVatLocked($vat_locked)
    {
        $this->container['vat_locked'] = $vat_locked;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency $currency currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets is_closeable
     *
     * @return bool
     */
    public function getIsCloseable()
    {
        return $this->container['is_closeable'];
    }

    /**
     * Sets is_closeable
     *
     * @param bool $is_closeable True if it should be possible to close entries on this account and it is possible to filter on open entries.
     *
     * @return $this
     */
    public function setIsCloseable($is_closeable)
    {
        $this->container['is_closeable'] = $is_closeable;

        return $this;
    }

    /**
     * Gets is_applicable_for_supplier_invoice
     *
     * @return bool
     */
    public function getIsApplicableForSupplierInvoice()
    {
        return $this->container['is_applicable_for_supplier_invoice'];
    }

    /**
     * Sets is_applicable_for_supplier_invoice
     *
     * @param bool $is_applicable_for_supplier_invoice True if this account is applicable for supplier invoice registration.
     *
     * @return $this
     */
    public function setIsApplicableForSupplierInvoice($is_applicable_for_supplier_invoice)
    {
        $this->container['is_applicable_for_supplier_invoice'] = $is_applicable_for_supplier_invoice;

        return $this;
    }

    /**
     * Gets require_reconciliation
     *
     * @return bool
     */
    public function getRequireReconciliation()
    {
        return $this->container['require_reconciliation'];
    }

    /**
     * Sets require_reconciliation
     *
     * @param bool $require_reconciliation True if this account must be reconciled before the accounting period closure.
     *
     * @return $this
     */
    public function setRequireReconciliation($require_reconciliation)
    {
        $this->container['require_reconciliation'] = $require_reconciliation;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool $is_inactive Inactive accounts will not show up in UI lists.
     *
     * @return $this
     */
    public function setIsInactive($is_inactive)
    {
        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets is_bank_account
     *
     * @return bool
     */
    public function getIsBankAccount()
    {
        return $this->container['is_bank_account'];
    }

    /**
     * Sets is_bank_account
     *
     * @param bool $is_bank_account is_bank_account
     *
     * @return $this
     */
    public function setIsBankAccount($is_bank_account)
    {
        $this->container['is_bank_account'] = $is_bank_account;

        return $this;
    }

    /**
     * Gets is_invoice_account
     *
     * @return bool
     */
    public function getIsInvoiceAccount()
    {
        return $this->container['is_invoice_account'];
    }

    /**
     * Sets is_invoice_account
     *
     * @param bool $is_invoice_account is_invoice_account
     *
     * @return $this
     */
    public function setIsInvoiceAccount($is_invoice_account)
    {
        $this->container['is_invoice_account'] = $is_invoice_account;

        return $this;
    }

    /**
     * Gets bank_account_number
     *
     * @return string
     */
    public function getBankAccountNumber()
    {
        return $this->container['bank_account_number'];
    }

    /**
     * Sets bank_account_number
     *
     * @param string $bank_account_number bank_account_number
     *
     * @return $this
     */
    public function setBankAccountNumber($bank_account_number)
    {
        $this->container['bank_account_number'] = $bank_account_number;

        return $this;
    }

    /**
     * Gets bank_account_country
     *
     * @return \Learnist\Tripletex\Model\Country
     */
    public function getBankAccountCountry()
    {
        return $this->container['bank_account_country'];
    }

    /**
     * Sets bank_account_country
     *
     * @param \Learnist\Tripletex\Model\Country $bank_account_country bank_account_country
     *
     * @return $this
     */
    public function setBankAccountCountry($bank_account_country)
    {
        $this->container['bank_account_country'] = $bank_account_country;

        return $this;
    }

    /**
     * Gets bank_name
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->container['bank_name'];
    }

    /**
     * Sets bank_name
     *
     * @param string $bank_name bank_name
     *
     * @return $this
     */
    public function setBankName($bank_name)
    {
        $this->container['bank_name'] = $bank_name;

        return $this;
    }

    /**
     * Gets bank_account_iban
     *
     * @return string
     */
    public function getBankAccountIban()
    {
        return $this->container['bank_account_iban'];
    }

    /**
     * Sets bank_account_iban
     *
     * @param string $bank_account_iban bank_account_iban
     *
     * @return $this
     */
    public function setBankAccountIban($bank_account_iban)
    {
        $this->container['bank_account_iban'] = $bank_account_iban;

        return $this;
    }

    /**
     * Gets bank_account_swift
     *
     * @return string
     */
    public function getBankAccountSwift()
    {
        return $this->container['bank_account_swift'];
    }

    /**
     * Sets bank_account_swift
     *
     * @param string $bank_account_swift bank_account_swift
     *
     * @return $this
     */
    public function setBankAccountSwift($bank_account_swift)
    {
        $this->container['bank_account_swift'] = $bank_account_swift;

        return $this;
    }

    /**
     * Gets saft_code
     *
     * @return string
     */
    public function getSaftCode()
    {
        return $this->container['saft_code'];
    }

    /**
     * Sets saft_code
     *
     * @param string $saft_code SAF-T code for account. It will be given a default value based on account number if empty.
     *
     * @return $this
     */
    public function setSaftCode($saft_code)
    {
        $this->container['saft_code'] = $saft_code;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name display_name
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets requires_department
     *
     * @return bool
     */
    public function getRequiresDepartment()
    {
        return $this->container['requires_department'];
    }

    /**
     * Sets requires_department
     *
     * @param bool $requires_department Posting against this account requires department.
     *
     * @return $this
     */
    public function setRequiresDepartment($requires_department)
    {
        $this->container['requires_department'] = $requires_department;

        return $this;
    }

    /**
     * Gets requires_project
     *
     * @return bool
     */
    public function getRequiresProject()
    {
        return $this->container['requires_project'];
    }

    /**
     * Sets requires_project
     *
     * @param bool $requires_project Posting against this account requires project.
     *
     * @return $this
     */
    public function setRequiresProject($requires_project)
    {
        $this->container['requires_project'] = $requires_project;

        return $this;
    }

    /**
     * Gets invoicing_department
     *
     * @return \Learnist\Tripletex\Model\Department
     */
    public function getInvoicingDepartment()
    {
        return $this->container['invoicing_department'];
    }

    /**
     * Sets invoicing_department
     *
     * @param \Learnist\Tripletex\Model\Department $invoicing_department invoicing_department
     *
     * @return $this
     */
    public function setInvoicingDepartment($invoicing_department)
    {
        $this->container['invoicing_department'] = $invoicing_department;

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
