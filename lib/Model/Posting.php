<?php
/**
 * Posting
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
 * Posting Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Posting implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Posting';

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
        'voucher' => '\Learnist\Tripletex\Model\Voucher',
        'date' => 'string',
        'description' => 'string',
        'account' => '\Learnist\Tripletex\Model\Account',
        'amortization_account' => '\Learnist\Tripletex\Model\Account',
        'amortization_start_date' => 'string',
        'amortization_end_date' => 'string',
        'customer' => '\Learnist\Tripletex\Model\Customer',
        'supplier' => '\Learnist\Tripletex\Model\Supplier',
        'employee' => '\Learnist\Tripletex\Model\Employee',
        'project' => '\Learnist\Tripletex\Model\Project',
        'product' => '\Learnist\Tripletex\Model\Product',
        'department' => '\Learnist\Tripletex\Model\Department',
        'vat_type' => '\Learnist\Tripletex\Model\VatType',
        'amount' => 'float',
        'amount_currency' => 'float',
        'amount_gross' => 'float',
        'amount_gross_currency' => 'float',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'close_group' => '\Learnist\Tripletex\Model\CloseGroup',
        'invoice_number' => 'string',
        'term_of_payment' => 'string',
        'row' => 'int',
        'type' => 'string',
        'external_ref' => 'string',
        'system_generated' => 'bool',
        'tax_transaction_type' => 'string',
        'tax_transaction_type_id' => 'int',
        'matched' => 'bool'
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
        'voucher' => null,
        'date' => null,
        'description' => null,
        'account' => null,
        'amortization_account' => null,
        'amortization_start_date' => null,
        'amortization_end_date' => null,
        'customer' => null,
        'supplier' => null,
        'employee' => null,
        'project' => null,
        'product' => null,
        'department' => null,
        'vat_type' => null,
        'amount' => null,
        'amount_currency' => null,
        'amount_gross' => null,
        'amount_gross_currency' => null,
        'currency' => null,
        'close_group' => null,
        'invoice_number' => null,
        'term_of_payment' => null,
        'row' => 'int32',
        'type' => null,
        'external_ref' => null,
        'system_generated' => null,
        'tax_transaction_type' => null,
        'tax_transaction_type_id' => 'int32',
        'matched' => null
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
		'voucher' => false,
		'date' => false,
		'description' => false,
		'account' => false,
		'amortization_account' => false,
		'amortization_start_date' => false,
		'amortization_end_date' => false,
		'customer' => false,
		'supplier' => false,
		'employee' => false,
		'project' => false,
		'product' => false,
		'department' => false,
		'vat_type' => false,
		'amount' => false,
		'amount_currency' => false,
		'amount_gross' => false,
		'amount_gross_currency' => false,
		'currency' => false,
		'close_group' => false,
		'invoice_number' => false,
		'term_of_payment' => false,
		'row' => false,
		'type' => false,
		'external_ref' => false,
		'system_generated' => false,
		'tax_transaction_type' => false,
		'tax_transaction_type_id' => false,
		'matched' => false
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
        'voucher' => 'voucher',
        'date' => 'date',
        'description' => 'description',
        'account' => 'account',
        'amortization_account' => 'amortizationAccount',
        'amortization_start_date' => 'amortizationStartDate',
        'amortization_end_date' => 'amortizationEndDate',
        'customer' => 'customer',
        'supplier' => 'supplier',
        'employee' => 'employee',
        'project' => 'project',
        'product' => 'product',
        'department' => 'department',
        'vat_type' => 'vatType',
        'amount' => 'amount',
        'amount_currency' => 'amountCurrency',
        'amount_gross' => 'amountGross',
        'amount_gross_currency' => 'amountGrossCurrency',
        'currency' => 'currency',
        'close_group' => 'closeGroup',
        'invoice_number' => 'invoiceNumber',
        'term_of_payment' => 'termOfPayment',
        'row' => 'row',
        'type' => 'type',
        'external_ref' => 'externalRef',
        'system_generated' => 'systemGenerated',
        'tax_transaction_type' => 'taxTransactionType',
        'tax_transaction_type_id' => 'taxTransactionTypeId',
        'matched' => 'matched'
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
        'voucher' => 'setVoucher',
        'date' => 'setDate',
        'description' => 'setDescription',
        'account' => 'setAccount',
        'amortization_account' => 'setAmortizationAccount',
        'amortization_start_date' => 'setAmortizationStartDate',
        'amortization_end_date' => 'setAmortizationEndDate',
        'customer' => 'setCustomer',
        'supplier' => 'setSupplier',
        'employee' => 'setEmployee',
        'project' => 'setProject',
        'product' => 'setProduct',
        'department' => 'setDepartment',
        'vat_type' => 'setVatType',
        'amount' => 'setAmount',
        'amount_currency' => 'setAmountCurrency',
        'amount_gross' => 'setAmountGross',
        'amount_gross_currency' => 'setAmountGrossCurrency',
        'currency' => 'setCurrency',
        'close_group' => 'setCloseGroup',
        'invoice_number' => 'setInvoiceNumber',
        'term_of_payment' => 'setTermOfPayment',
        'row' => 'setRow',
        'type' => 'setType',
        'external_ref' => 'setExternalRef',
        'system_generated' => 'setSystemGenerated',
        'tax_transaction_type' => 'setTaxTransactionType',
        'tax_transaction_type_id' => 'setTaxTransactionTypeId',
        'matched' => 'setMatched'
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
        'voucher' => 'getVoucher',
        'date' => 'getDate',
        'description' => 'getDescription',
        'account' => 'getAccount',
        'amortization_account' => 'getAmortizationAccount',
        'amortization_start_date' => 'getAmortizationStartDate',
        'amortization_end_date' => 'getAmortizationEndDate',
        'customer' => 'getCustomer',
        'supplier' => 'getSupplier',
        'employee' => 'getEmployee',
        'project' => 'getProject',
        'product' => 'getProduct',
        'department' => 'getDepartment',
        'vat_type' => 'getVatType',
        'amount' => 'getAmount',
        'amount_currency' => 'getAmountCurrency',
        'amount_gross' => 'getAmountGross',
        'amount_gross_currency' => 'getAmountGrossCurrency',
        'currency' => 'getCurrency',
        'close_group' => 'getCloseGroup',
        'invoice_number' => 'getInvoiceNumber',
        'term_of_payment' => 'getTermOfPayment',
        'row' => 'getRow',
        'type' => 'getType',
        'external_ref' => 'getExternalRef',
        'system_generated' => 'getSystemGenerated',
        'tax_transaction_type' => 'getTaxTransactionType',
        'tax_transaction_type_id' => 'getTaxTransactionTypeId',
        'matched' => 'getMatched'
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

    public const TYPE_INCOMING_PAYMENT = 'INCOMING_PAYMENT';
    public const TYPE_INCOMING_PAYMENT_OPPOSITE = 'INCOMING_PAYMENT_OPPOSITE';
    public const TYPE_INVOICE_EXPENSE = 'INVOICE_EXPENSE';
    public const TYPE_OUTGOING_INVOICE_CUSTOMER_POSTING = 'OUTGOING_INVOICE_CUSTOMER_POSTING';
    public const TYPE_WAGE = 'WAGE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_INCOMING_PAYMENT,
            self::TYPE_INCOMING_PAYMENT_OPPOSITE,
            self::TYPE_INVOICE_EXPENSE,
            self::TYPE_OUTGOING_INVOICE_CUSTOMER_POSTING,
            self::TYPE_WAGE,
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
        $this->setIfExists('voucher', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('account', $data ?? [], null);
        $this->setIfExists('amortization_account', $data ?? [], null);
        $this->setIfExists('amortization_start_date', $data ?? [], null);
        $this->setIfExists('amortization_end_date', $data ?? [], null);
        $this->setIfExists('customer', $data ?? [], null);
        $this->setIfExists('supplier', $data ?? [], null);
        $this->setIfExists('employee', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('product', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('amount_currency', $data ?? [], null);
        $this->setIfExists('amount_gross', $data ?? [], null);
        $this->setIfExists('amount_gross_currency', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('close_group', $data ?? [], null);
        $this->setIfExists('invoice_number', $data ?? [], null);
        $this->setIfExists('term_of_payment', $data ?? [], null);
        $this->setIfExists('row', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('external_ref', $data ?? [], null);
        $this->setIfExists('system_generated', $data ?? [], null);
        $this->setIfExists('tax_transaction_type', $data ?? [], null);
        $this->setIfExists('tax_transaction_type_id', $data ?? [], null);
        $this->setIfExists('matched', $data ?? [], null);
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

        if (!is_null($this->container['invoice_number']) && (mb_strlen($this->container['invoice_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'invoice_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['row']) && ($this->container['row'] < 0)) {
            $invalidProperties[] = "invalid value for 'row', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['external_ref']) && (mb_strlen($this->container['external_ref']) > 100)) {
            $invalidProperties[] = "invalid value for 'external_ref', the character length must be smaller than or equal to 100.";
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
     * Gets voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher|null
     */
    public function getVoucher()
    {
        return $this->container['voucher'];
    }

    /**
     * Sets voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher|null $voucher voucher
     *
     * @return self
     */
    public function setVoucher($voucher)
    {
        if (is_null($voucher)) {
            throw new \InvalidArgumentException('non-nullable voucher cannot be null');
        }
        $this->container['voucher'] = $voucher;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {
        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

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
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account|null $account account
     *
     * @return self
     */
    public function setAccount($account)
    {
        if (is_null($account)) {
            throw new \InvalidArgumentException('non-nullable account cannot be null');
        }
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets amortization_account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getAmortizationAccount()
    {
        return $this->container['amortization_account'];
    }

    /**
     * Sets amortization_account
     *
     * @param \Learnist\Tripletex\Model\Account|null $amortization_account amortization_account
     *
     * @return self
     */
    public function setAmortizationAccount($amortization_account)
    {
        if (is_null($amortization_account)) {
            throw new \InvalidArgumentException('non-nullable amortization_account cannot be null');
        }
        $this->container['amortization_account'] = $amortization_account;

        return $this;
    }

    /**
     * Gets amortization_start_date
     *
     * @return string|null
     */
    public function getAmortizationStartDate()
    {
        return $this->container['amortization_start_date'];
    }

    /**
     * Sets amortization_start_date
     *
     * @param string|null $amortization_start_date Amortization start date. AmortizationAccountId, amortizationStartDate and amortizationEndDate should be provided.
     *
     * @return self
     */
    public function setAmortizationStartDate($amortization_start_date)
    {
        if (is_null($amortization_start_date)) {
            throw new \InvalidArgumentException('non-nullable amortization_start_date cannot be null');
        }
        $this->container['amortization_start_date'] = $amortization_start_date;

        return $this;
    }

    /**
     * Gets amortization_end_date
     *
     * @return string|null
     */
    public function getAmortizationEndDate()
    {
        return $this->container['amortization_end_date'];
    }

    /**
     * Sets amortization_end_date
     *
     * @param string|null $amortization_end_date amortization_end_date
     *
     * @return self
     */
    public function setAmortizationEndDate($amortization_end_date)
    {
        if (is_null($amortization_end_date)) {
            throw new \InvalidArgumentException('non-nullable amortization_end_date cannot be null');
        }
        $this->container['amortization_end_date'] = $amortization_end_date;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Customer|null
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Customer|null $customer customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {
        if (is_null($customer)) {
            throw new \InvalidArgumentException('non-nullable customer cannot be null');
        }
        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets supplier
     *
     * @return \Learnist\Tripletex\Model\Supplier|null
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Learnist\Tripletex\Model\Supplier|null $supplier supplier
     *
     * @return self
     */
    public function setSupplier($supplier)
    {
        if (is_null($supplier)) {
            throw new \InvalidArgumentException('non-nullable supplier cannot be null');
        }
        $this->container['supplier'] = $supplier;

        return $this;
    }

    /**
     * Gets employee
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getEmployee()
    {
        return $this->container['employee'];
    }

    /**
     * Sets employee
     *
     * @param \Learnist\Tripletex\Model\Employee|null $employee employee
     *
     * @return self
     */
    public function setEmployee($employee)
    {
        if (is_null($employee)) {
            throw new \InvalidArgumentException('non-nullable employee cannot be null');
        }
        $this->container['employee'] = $employee;

        return $this;
    }

    /**
     * Gets project
     *
     * @return \Learnist\Tripletex\Model\Project|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param \Learnist\Tripletex\Model\Project|null $project project
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets product
     *
     * @return \Learnist\Tripletex\Model\Product|null
     */
    public function getProduct()
    {
        return $this->container['product'];
    }

    /**
     * Sets product
     *
     * @param \Learnist\Tripletex\Model\Product|null $product product
     *
     * @return self
     */
    public function setProduct($product)
    {
        if (is_null($product)) {
            throw new \InvalidArgumentException('non-nullable product cannot be null');
        }
        $this->container['product'] = $product;

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
     * Gets amount
     *
     * @return float|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float|null $amount amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (is_null($amount)) {
            throw new \InvalidArgumentException('non-nullable amount cannot be null');
        }
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets amount_currency
     *
     * @return float|null
     */
    public function getAmountCurrency()
    {
        return $this->container['amount_currency'];
    }

    /**
     * Sets amount_currency
     *
     * @param float|null $amount_currency amount_currency
     *
     * @return self
     */
    public function setAmountCurrency($amount_currency)
    {
        if (is_null($amount_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_currency cannot be null');
        }
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets amount_gross
     *
     * @return float|null
     */
    public function getAmountGross()
    {
        return $this->container['amount_gross'];
    }

    /**
     * Sets amount_gross
     *
     * @param float|null $amount_gross amount_gross
     *
     * @return self
     */
    public function setAmountGross($amount_gross)
    {
        if (is_null($amount_gross)) {
            throw new \InvalidArgumentException('non-nullable amount_gross cannot be null');
        }
        $this->container['amount_gross'] = $amount_gross;

        return $this;
    }

    /**
     * Gets amount_gross_currency
     *
     * @return float|null
     */
    public function getAmountGrossCurrency()
    {
        return $this->container['amount_gross_currency'];
    }

    /**
     * Sets amount_gross_currency
     *
     * @param float|null $amount_gross_currency amount_gross_currency
     *
     * @return self
     */
    public function setAmountGrossCurrency($amount_gross_currency)
    {
        if (is_null($amount_gross_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_gross_currency cannot be null');
        }
        $this->container['amount_gross_currency'] = $amount_gross_currency;

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
     * Gets close_group
     *
     * @return \Learnist\Tripletex\Model\CloseGroup|null
     */
    public function getCloseGroup()
    {
        return $this->container['close_group'];
    }

    /**
     * Sets close_group
     *
     * @param \Learnist\Tripletex\Model\CloseGroup|null $close_group close_group
     *
     * @return self
     */
    public function setCloseGroup($close_group)
    {
        if (is_null($close_group)) {
            throw new \InvalidArgumentException('non-nullable close_group cannot be null');
        }
        $this->container['close_group'] = $close_group;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string|null
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string|null $invoice_number invoice_number
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        if (is_null($invoice_number)) {
            throw new \InvalidArgumentException('non-nullable invoice_number cannot be null');
        }
        if ((mb_strlen($invoice_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $invoice_number when calling Posting., must be smaller than or equal to 100.');
        }

        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets term_of_payment
     *
     * @return string|null
     */
    public function getTermOfPayment()
    {
        return $this->container['term_of_payment'];
    }

    /**
     * Sets term_of_payment
     *
     * @param string|null $term_of_payment term_of_payment
     *
     * @return self
     */
    public function setTermOfPayment($term_of_payment)
    {
        if (is_null($term_of_payment)) {
            throw new \InvalidArgumentException('non-nullable term_of_payment cannot be null');
        }
        $this->container['term_of_payment'] = $term_of_payment;

        return $this;
    }

    /**
     * Gets row
     *
     * @return int|null
     */
    public function getRow()
    {
        return $this->container['row'];
    }

    /**
     * Sets row
     *
     * @param int|null $row row
     *
     * @return self
     */
    public function setRow($row)
    {
        if (is_null($row)) {
            throw new \InvalidArgumentException('non-nullable row cannot be null');
        }

        if (($row < 0)) {
            throw new \InvalidArgumentException('invalid value for $row when calling Posting., must be bigger than or equal to 0.');
        }

        $this->container['row'] = $row;

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
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets external_ref
     *
     * @return string|null
     */
    public function getExternalRef()
    {
        return $this->container['external_ref'];
    }

    /**
     * Sets external_ref
     *
     * @param string|null $external_ref External reference for identifying payment basis of the posting, e.g., KID, customer identification or credit note number.
     *
     * @return self
     */
    public function setExternalRef($external_ref)
    {
        if (is_null($external_ref)) {
            throw new \InvalidArgumentException('non-nullable external_ref cannot be null');
        }
        if ((mb_strlen($external_ref) > 100)) {
            throw new \InvalidArgumentException('invalid length for $external_ref when calling Posting., must be smaller than or equal to 100.');
        }

        $this->container['external_ref'] = $external_ref;

        return $this;
    }

    /**
     * Gets system_generated
     *
     * @return bool|null
     */
    public function getSystemGenerated()
    {
        return $this->container['system_generated'];
    }

    /**
     * Sets system_generated
     *
     * @param bool|null $system_generated system_generated
     *
     * @return self
     */
    public function setSystemGenerated($system_generated)
    {
        if (is_null($system_generated)) {
            throw new \InvalidArgumentException('non-nullable system_generated cannot be null');
        }
        $this->container['system_generated'] = $system_generated;

        return $this;
    }

    /**
     * Gets tax_transaction_type
     *
     * @return string|null
     */
    public function getTaxTransactionType()
    {
        return $this->container['tax_transaction_type'];
    }

    /**
     * Sets tax_transaction_type
     *
     * @param string|null $tax_transaction_type tax_transaction_type
     *
     * @return self
     */
    public function setTaxTransactionType($tax_transaction_type)
    {
        if (is_null($tax_transaction_type)) {
            throw new \InvalidArgumentException('non-nullable tax_transaction_type cannot be null');
        }
        $this->container['tax_transaction_type'] = $tax_transaction_type;

        return $this;
    }

    /**
     * Gets tax_transaction_type_id
     *
     * @return int|null
     */
    public function getTaxTransactionTypeId()
    {
        return $this->container['tax_transaction_type_id'];
    }

    /**
     * Sets tax_transaction_type_id
     *
     * @param int|null $tax_transaction_type_id tax_transaction_type_id
     *
     * @return self
     */
    public function setTaxTransactionTypeId($tax_transaction_type_id)
    {
        if (is_null($tax_transaction_type_id)) {
            throw new \InvalidArgumentException('non-nullable tax_transaction_type_id cannot be null');
        }
        $this->container['tax_transaction_type_id'] = $tax_transaction_type_id;

        return $this;
    }

    /**
     * Gets matched
     *
     * @return bool|null
     */
    public function getMatched()
    {
        return $this->container['matched'];
    }

    /**
     * Sets matched
     *
     * @param bool|null $matched matched
     *
     * @return self
     */
    public function setMatched($matched)
    {
        if (is_null($matched)) {
            throw new \InvalidArgumentException('non-nullable matched cannot be null');
        }
        $this->container['matched'] = $matched;

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


