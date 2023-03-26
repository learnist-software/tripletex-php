<?php
/**
 * Account
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
 * Account Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Account implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Account';

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
        'invoicing_department' => '\Learnist\Tripletex\Model\Department'
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
        'invoicing_department' => null
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
		'number' => false,
		'name' => false,
		'description' => false,
		'type' => false,
		'legal_vat_types' => false,
		'ledger_type' => false,
		'vat_type' => false,
		'vat_locked' => false,
		'currency' => false,
		'is_closeable' => false,
		'is_applicable_for_supplier_invoice' => false,
		'require_reconciliation' => false,
		'is_inactive' => false,
		'is_bank_account' => false,
		'is_invoice_account' => false,
		'bank_account_number' => false,
		'bank_account_country' => false,
		'bank_name' => false,
		'bank_account_iban' => false,
		'bank_account_swift' => false,
		'saft_code' => false,
		'display_name' => false,
		'requires_department' => false,
		'requires_project' => false,
		'invoicing_department' => false
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
        'invoicing_department' => 'invoicingDepartment'
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
        'invoicing_department' => 'setInvoicingDepartment'
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
        'invoicing_department' => 'getInvoicingDepartment'
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

    public const TYPE_ASSETS = 'ASSETS';
    public const TYPE_EQUITY = 'EQUITY';
    public const TYPE_LIABILITIES = 'LIABILITIES';
    public const TYPE_OPERATING_REVENUES = 'OPERATING_REVENUES';
    public const TYPE_OPERATING_EXPENSES = 'OPERATING_EXPENSES';
    public const TYPE_INVESTMENT_INCOME = 'INVESTMENT_INCOME';
    public const TYPE_COST_OF_CAPITAL = 'COST_OF_CAPITAL';
    public const TYPE_TAX_ON_ORDINARY_ACTIVITIES = 'TAX_ON_ORDINARY_ACTIVITIES';
    public const TYPE_EXTRAORDINARY_INCOME = 'EXTRAORDINARY_INCOME';
    public const TYPE_EXTRAORDINARY_COST = 'EXTRAORDINARY_COST';
    public const TYPE_TAX_ON_EXTRAORDINARY_ACTIVITIES = 'TAX_ON_EXTRAORDINARY_ACTIVITIES';
    public const TYPE_ANNUAL_RESULT = 'ANNUAL_RESULT';
    public const TYPE_TRANSFERS_AND_ALLOCATIONS = 'TRANSFERS_AND_ALLOCATIONS';
    public const LEDGER_TYPE_GENERAL = 'GENERAL';
    public const LEDGER_TYPE_CUSTOMER = 'CUSTOMER';
    public const LEDGER_TYPE_VENDOR = 'VENDOR';
    public const LEDGER_TYPE_EMPLOYEE = 'EMPLOYEE';
    public const LEDGER_TYPE_ASSET = 'ASSET';

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
            self::TYPE_TRANSFERS_AND_ALLOCATIONS,
        ];
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
            self::LEDGER_TYPE_ASSET,
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
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('legal_vat_types', $data ?? [], null);
        $this->setIfExists('ledger_type', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('vat_locked', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('is_closeable', $data ?? [], null);
        $this->setIfExists('is_applicable_for_supplier_invoice', $data ?? [], null);
        $this->setIfExists('require_reconciliation', $data ?? [], null);
        $this->setIfExists('is_inactive', $data ?? [], null);
        $this->setIfExists('is_bank_account', $data ?? [], null);
        $this->setIfExists('is_invoice_account', $data ?? [], null);
        $this->setIfExists('bank_account_number', $data ?? [], null);
        $this->setIfExists('bank_account_country', $data ?? [], null);
        $this->setIfExists('bank_name', $data ?? [], null);
        $this->setIfExists('bank_account_iban', $data ?? [], null);
        $this->setIfExists('bank_account_swift', $data ?? [], null);
        $this->setIfExists('saft_code', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('requires_department', $data ?? [], null);
        $this->setIfExists('requires_project', $data ?? [], null);
        $this->setIfExists('invoicing_department', $data ?? [], null);
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

        if ($this->container['number'] === null) {
            $invalidProperties[] = "'number' can't be null";
        }
        if (($this->container['number'] < 0)) {
            $invalidProperties[] = "invalid value for 'number', must be bigger than or equal to 0.";
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getLedgerTypeAllowableValues();
        if (!is_null($this->container['ledger_type']) && !in_array($this->container['ledger_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'ledger_type', must be one of '%s'",
                $this->container['ledger_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['bank_account_number']) && (mb_strlen($this->container['bank_account_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['bank_name']) && (mb_strlen($this->container['bank_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank_account_iban']) && (mb_strlen($this->container['bank_account_iban']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_iban', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['bank_account_swift']) && (mb_strlen($this->container['bank_account_swift']) > 100)) {
            $invalidProperties[] = "invalid value for 'bank_account_swift', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['saft_code']) && (mb_strlen($this->container['saft_code']) > 4)) {
            $invalidProperties[] = "invalid value for 'saft_code', the character length must be smaller than or equal to 4.";
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
     * @return self
     */
    public function setNumber($number)
    {

        if (($number < 0)) {
            throw new \InvalidArgumentException('invalid value for $number when calling Account., must be bigger than or equal to 0.');
        }


        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }

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
     * @return self
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Account., must be smaller than or equal to 255.');
        }


        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {

        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($type) && !in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }

        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets legal_vat_types
     *
     * @return \Learnist\Tripletex\Model\VatType[]|null
     */
    public function getLegalVatTypes()
    {
        return $this->container['legal_vat_types'];
    }

    /**
     * Sets legal_vat_types
     *
     * @param \Learnist\Tripletex\Model\VatType[]|null $legal_vat_types List of legal vat types for this account.
     *
     * @return self
     */
    public function setLegalVatTypes($legal_vat_types)
    {

        if (is_null($legal_vat_types)) {
            throw new \InvalidArgumentException('non-nullable legal_vat_types cannot be null');
        }

        $this->container['legal_vat_types'] = $legal_vat_types;

        return $this;
    }

    /**
     * Gets ledger_type
     *
     * @return string|null
     */
    public function getLedgerType()
    {
        return $this->container['ledger_type'];
    }

    /**
     * Sets ledger_type
     *
     * @param string|null $ledger_type Supported ledger types, default is GENERAL. Only available for customers with the module multiple ledgers.
     *
     * @return self
     */
    public function setLedgerType($ledger_type)
    {
        $allowedValues = $this->getLedgerTypeAllowableValues();
        if (!is_null($ledger_type) && !in_array($ledger_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'ledger_type', must be one of '%s'",
                    $ledger_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($ledger_type)) {
            throw new \InvalidArgumentException('non-nullable ledger_type cannot be null');
        }

        $this->container['ledger_type'] = $ledger_type;

        return $this;
    }

    /**
     * Gets vat_type
     *
     * @return \Learnist\Tripletex\Model\VatType|null
     */
    public function getVatType()
    {
        return $this->container['vat_type'];
    }

    /**
     * Sets vat_type
     *
     * @param \Learnist\Tripletex\Model\VatType|null $vat_type vat_type
     *
     * @return self
     */
    public function setVatType($vat_type)
    {

        if (is_null($vat_type)) {
            throw new \InvalidArgumentException('non-nullable vat_type cannot be null');
        }

        $this->container['vat_type'] = $vat_type;

        return $this;
    }

    /**
     * Gets vat_locked
     *
     * @return bool|null
     */
    public function getVatLocked()
    {
        return $this->container['vat_locked'];
    }

    /**
     * Sets vat_locked
     *
     * @param bool|null $vat_locked True if all entries on this account must have the vat type given by vatType.
     *
     * @return self
     */
    public function setVatLocked($vat_locked)
    {

        if (is_null($vat_locked)) {
            throw new \InvalidArgumentException('non-nullable vat_locked cannot be null');
        }

        $this->container['vat_locked'] = $vat_locked;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {

        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }

        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets is_closeable
     *
     * @return bool|null
     */
    public function getIsCloseable()
    {
        return $this->container['is_closeable'];
    }

    /**
     * Sets is_closeable
     *
     * @param bool|null $is_closeable True if it should be possible to close entries on this account and it is possible to filter on open entries.
     *
     * @return self
     */
    public function setIsCloseable($is_closeable)
    {

        if (is_null($is_closeable)) {
            throw new \InvalidArgumentException('non-nullable is_closeable cannot be null');
        }

        $this->container['is_closeable'] = $is_closeable;

        return $this;
    }

    /**
     * Gets is_applicable_for_supplier_invoice
     *
     * @return bool|null
     */
    public function getIsApplicableForSupplierInvoice()
    {
        return $this->container['is_applicable_for_supplier_invoice'];
    }

    /**
     * Sets is_applicable_for_supplier_invoice
     *
     * @param bool|null $is_applicable_for_supplier_invoice True if this account is applicable for supplier invoice registration.
     *
     * @return self
     */
    public function setIsApplicableForSupplierInvoice($is_applicable_for_supplier_invoice)
    {

        if (is_null($is_applicable_for_supplier_invoice)) {
            throw new \InvalidArgumentException('non-nullable is_applicable_for_supplier_invoice cannot be null');
        }

        $this->container['is_applicable_for_supplier_invoice'] = $is_applicable_for_supplier_invoice;

        return $this;
    }

    /**
     * Gets require_reconciliation
     *
     * @return bool|null
     */
    public function getRequireReconciliation()
    {
        return $this->container['require_reconciliation'];
    }

    /**
     * Sets require_reconciliation
     *
     * @param bool|null $require_reconciliation True if this account must be reconciled before the accounting period closure.
     *
     * @return self
     */
    public function setRequireReconciliation($require_reconciliation)
    {

        if (is_null($require_reconciliation)) {
            throw new \InvalidArgumentException('non-nullable require_reconciliation cannot be null');
        }

        $this->container['require_reconciliation'] = $require_reconciliation;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool|null
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool|null $is_inactive Inactive accounts will not show up in UI lists.
     *
     * @return self
     */
    public function setIsInactive($is_inactive)
    {

        if (is_null($is_inactive)) {
            throw new \InvalidArgumentException('non-nullable is_inactive cannot be null');
        }

        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets is_bank_account
     *
     * @return bool|null
     */
    public function getIsBankAccount()
    {
        return $this->container['is_bank_account'];
    }

    /**
     * Sets is_bank_account
     *
     * @param bool|null $is_bank_account is_bank_account
     *
     * @return self
     */
    public function setIsBankAccount($is_bank_account)
    {

        if (is_null($is_bank_account)) {
            throw new \InvalidArgumentException('non-nullable is_bank_account cannot be null');
        }

        $this->container['is_bank_account'] = $is_bank_account;

        return $this;
    }

    /**
     * Gets is_invoice_account
     *
     * @return bool|null
     */
    public function getIsInvoiceAccount()
    {
        return $this->container['is_invoice_account'];
    }

    /**
     * Sets is_invoice_account
     *
     * @param bool|null $is_invoice_account is_invoice_account
     *
     * @return self
     */
    public function setIsInvoiceAccount($is_invoice_account)
    {

        if (is_null($is_invoice_account)) {
            throw new \InvalidArgumentException('non-nullable is_invoice_account cannot be null');
        }

        $this->container['is_invoice_account'] = $is_invoice_account;

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
            throw new \InvalidArgumentException('invalid length for $bank_account_number when calling Account., must be smaller than or equal to 100.');
        }


        if (is_null($bank_account_number)) {
            throw new \InvalidArgumentException('non-nullable bank_account_number cannot be null');
        }

        $this->container['bank_account_number'] = $bank_account_number;

        return $this;
    }

    /**
     * Gets bank_account_country
     *
     * @return \Learnist\Tripletex\Model\Country|null
     */
    public function getBankAccountCountry()
    {
        return $this->container['bank_account_country'];
    }

    /**
     * Sets bank_account_country
     *
     * @param \Learnist\Tripletex\Model\Country|null $bank_account_country bank_account_country
     *
     * @return self
     */
    public function setBankAccountCountry($bank_account_country)
    {

        if (is_null($bank_account_country)) {
            throw new \InvalidArgumentException('non-nullable bank_account_country cannot be null');
        }

        $this->container['bank_account_country'] = $bank_account_country;

        return $this;
    }

    /**
     * Gets bank_name
     *
     * @return string|null
     */
    public function getBankName()
    {
        return $this->container['bank_name'];
    }

    /**
     * Sets bank_name
     *
     * @param string|null $bank_name bank_name
     *
     * @return self
     */
    public function setBankName($bank_name)
    {
        if (!is_null($bank_name) && (mb_strlen($bank_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_name when calling Account., must be smaller than or equal to 255.');
        }


        if (is_null($bank_name)) {
            throw new \InvalidArgumentException('non-nullable bank_name cannot be null');
        }

        $this->container['bank_name'] = $bank_name;

        return $this;
    }

    /**
     * Gets bank_account_iban
     *
     * @return string|null
     */
    public function getBankAccountIban()
    {
        return $this->container['bank_account_iban'];
    }

    /**
     * Sets bank_account_iban
     *
     * @param string|null $bank_account_iban bank_account_iban
     *
     * @return self
     */
    public function setBankAccountIban($bank_account_iban)
    {
        if (!is_null($bank_account_iban) && (mb_strlen($bank_account_iban) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_iban when calling Account., must be smaller than or equal to 100.');
        }


        if (is_null($bank_account_iban)) {
            throw new \InvalidArgumentException('non-nullable bank_account_iban cannot be null');
        }

        $this->container['bank_account_iban'] = $bank_account_iban;

        return $this;
    }

    /**
     * Gets bank_account_swift
     *
     * @return string|null
     */
    public function getBankAccountSwift()
    {
        return $this->container['bank_account_swift'];
    }

    /**
     * Sets bank_account_swift
     *
     * @param string|null $bank_account_swift bank_account_swift
     *
     * @return self
     */
    public function setBankAccountSwift($bank_account_swift)
    {
        if (!is_null($bank_account_swift) && (mb_strlen($bank_account_swift) > 100)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_swift when calling Account., must be smaller than or equal to 100.');
        }


        if (is_null($bank_account_swift)) {
            throw new \InvalidArgumentException('non-nullable bank_account_swift cannot be null');
        }

        $this->container['bank_account_swift'] = $bank_account_swift;

        return $this;
    }

    /**
     * Gets saft_code
     *
     * @return string|null
     */
    public function getSaftCode()
    {
        return $this->container['saft_code'];
    }

    /**
     * Sets saft_code
     *
     * @param string|null $saft_code SAF-T code for account. It will be given a default value based on account number if empty.
     *
     * @return self
     */
    public function setSaftCode($saft_code)
    {
        if (!is_null($saft_code) && (mb_strlen($saft_code) > 4)) {
            throw new \InvalidArgumentException('invalid length for $saft_code when calling Account., must be smaller than or equal to 4.');
        }


        if (is_null($saft_code)) {
            throw new \InvalidArgumentException('non-nullable saft_code cannot be null');
        }

        $this->container['saft_code'] = $saft_code;

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
     * Gets requires_department
     *
     * @return bool|null
     */
    public function getRequiresDepartment()
    {
        return $this->container['requires_department'];
    }

    /**
     * Sets requires_department
     *
     * @param bool|null $requires_department Posting against this account requires department.
     *
     * @return self
     */
    public function setRequiresDepartment($requires_department)
    {

        if (is_null($requires_department)) {
            throw new \InvalidArgumentException('non-nullable requires_department cannot be null');
        }

        $this->container['requires_department'] = $requires_department;

        return $this;
    }

    /**
     * Gets requires_project
     *
     * @return bool|null
     */
    public function getRequiresProject()
    {
        return $this->container['requires_project'];
    }

    /**
     * Sets requires_project
     *
     * @param bool|null $requires_project Posting against this account requires project.
     *
     * @return self
     */
    public function setRequiresProject($requires_project)
    {

        if (is_null($requires_project)) {
            throw new \InvalidArgumentException('non-nullable requires_project cannot be null');
        }

        $this->container['requires_project'] = $requires_project;

        return $this;
    }

    /**
     * Gets invoicing_department
     *
     * @return \Learnist\Tripletex\Model\Department|null
     */
    public function getInvoicingDepartment()
    {
        return $this->container['invoicing_department'];
    }

    /**
     * Sets invoicing_department
     *
     * @param \Learnist\Tripletex\Model\Department|null $invoicing_department invoicing_department
     *
     * @return self
     */
    public function setInvoicingDepartment($invoicing_department)
    {

        if (is_null($invoicing_department)) {
            throw new \InvalidArgumentException('non-nullable invoicing_department cannot be null');
        }

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


