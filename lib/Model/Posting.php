<?php
/**
 * Posting
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
 * Posting Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Posting implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Posting';

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
'matched' => 'bool'    ];

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
'matched' => null    ];

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
'matched' => 'matched'    ];

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
'matched' => 'setMatched'    ];

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
'matched' => 'getMatched'    ];

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

    const TYPE_INCOMING_PAYMENT = 'INCOMING_PAYMENT';
const TYPE_INCOMING_PAYMENT_OPPOSITE = 'INCOMING_PAYMENT_OPPOSITE';
const TYPE_INVOICE_EXPENSE = 'INVOICE_EXPENSE';
const TYPE_OUTGOING_INVOICE_CUSTOMER_POSTING = 'OUTGOING_INVOICE_CUSTOMER_POSTING';
const TYPE_WAGE = 'WAGE';

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
self::TYPE_WAGE,        ];
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
        $this->container['voucher'] = isset($data['voucher']) ? $data['voucher'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['account'] = isset($data['account']) ? $data['account'] : null;
        $this->container['amortization_account'] = isset($data['amortization_account']) ? $data['amortization_account'] : null;
        $this->container['amortization_start_date'] = isset($data['amortization_start_date']) ? $data['amortization_start_date'] : null;
        $this->container['amortization_end_date'] = isset($data['amortization_end_date']) ? $data['amortization_end_date'] : null;
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['supplier'] = isset($data['supplier']) ? $data['supplier'] : null;
        $this->container['employee'] = isset($data['employee']) ? $data['employee'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['product'] = isset($data['product']) ? $data['product'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['amount_currency'] = isset($data['amount_currency']) ? $data['amount_currency'] : null;
        $this->container['amount_gross'] = isset($data['amount_gross']) ? $data['amount_gross'] : null;
        $this->container['amount_gross_currency'] = isset($data['amount_gross_currency']) ? $data['amount_gross_currency'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['close_group'] = isset($data['close_group']) ? $data['close_group'] : null;
        $this->container['invoice_number'] = isset($data['invoice_number']) ? $data['invoice_number'] : null;
        $this->container['term_of_payment'] = isset($data['term_of_payment']) ? $data['term_of_payment'] : null;
        $this->container['row'] = isset($data['row']) ? $data['row'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['external_ref'] = isset($data['external_ref']) ? $data['external_ref'] : null;
        $this->container['system_generated'] = isset($data['system_generated']) ? $data['system_generated'] : null;
        $this->container['tax_transaction_type'] = isset($data['tax_transaction_type']) ? $data['tax_transaction_type'] : null;
        $this->container['tax_transaction_type_id'] = isset($data['tax_transaction_type_id']) ? $data['tax_transaction_type_id'] : null;
        $this->container['matched'] = isset($data['matched']) ? $data['matched'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
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
     * Gets voucher
     *
     * @return \Learnist\Tripletex\Model\Voucher
     */
    public function getVoucher()
    {
        return $this->container['voucher'];
    }

    /**
     * Sets voucher
     *
     * @param \Learnist\Tripletex\Model\Voucher $voucher voucher
     *
     * @return $this
     */
    public function setVoucher($voucher)
    {
        $this->container['voucher'] = $voucher;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

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
     * Gets account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param \Learnist\Tripletex\Model\Account $account account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets amortization_account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getAmortizationAccount()
    {
        return $this->container['amortization_account'];
    }

    /**
     * Sets amortization_account
     *
     * @param \Learnist\Tripletex\Model\Account $amortization_account amortization_account
     *
     * @return $this
     */
    public function setAmortizationAccount($amortization_account)
    {
        $this->container['amortization_account'] = $amortization_account;

        return $this;
    }

    /**
     * Gets amortization_start_date
     *
     * @return string
     */
    public function getAmortizationStartDate()
    {
        return $this->container['amortization_start_date'];
    }

    /**
     * Sets amortization_start_date
     *
     * @param string $amortization_start_date Amortization start date. AmortizationAccountId, amortizationStartDate and amortizationEndDate should be provided.
     *
     * @return $this
     */
    public function setAmortizationStartDate($amortization_start_date)
    {
        $this->container['amortization_start_date'] = $amortization_start_date;

        return $this;
    }

    /**
     * Gets amortization_end_date
     *
     * @return string
     */
    public function getAmortizationEndDate()
    {
        return $this->container['amortization_end_date'];
    }

    /**
     * Sets amortization_end_date
     *
     * @param string $amortization_end_date amortization_end_date
     *
     * @return $this
     */
    public function setAmortizationEndDate($amortization_end_date)
    {
        $this->container['amortization_end_date'] = $amortization_end_date;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Customer
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Customer $customer customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets supplier
     *
     * @return \Learnist\Tripletex\Model\Supplier
     */
    public function getSupplier()
    {
        return $this->container['supplier'];
    }

    /**
     * Sets supplier
     *
     * @param \Learnist\Tripletex\Model\Supplier $supplier supplier
     *
     * @return $this
     */
    public function setSupplier($supplier)
    {
        $this->container['supplier'] = $supplier;

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
     * Gets project
     *
     * @return \Learnist\Tripletex\Model\Project
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param \Learnist\Tripletex\Model\Project $project project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets product
     *
     * @return \Learnist\Tripletex\Model\Product
     */
    public function getProduct()
    {
        return $this->container['product'];
    }

    /**
     * Sets product
     *
     * @param \Learnist\Tripletex\Model\Product $product product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->container['product'] = $product;

        return $this;
    }

    /**
     * Gets department
     *
     * @return \Learnist\Tripletex\Model\Department
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param \Learnist\Tripletex\Model\Department $department department
     *
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->container['department'] = $department;

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
     * Gets amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets amount_currency
     *
     * @return float
     */
    public function getAmountCurrency()
    {
        return $this->container['amount_currency'];
    }

    /**
     * Sets amount_currency
     *
     * @param float $amount_currency amount_currency
     *
     * @return $this
     */
    public function setAmountCurrency($amount_currency)
    {
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets amount_gross
     *
     * @return float
     */
    public function getAmountGross()
    {
        return $this->container['amount_gross'];
    }

    /**
     * Sets amount_gross
     *
     * @param float $amount_gross amount_gross
     *
     * @return $this
     */
    public function setAmountGross($amount_gross)
    {
        $this->container['amount_gross'] = $amount_gross;

        return $this;
    }

    /**
     * Gets amount_gross_currency
     *
     * @return float
     */
    public function getAmountGrossCurrency()
    {
        return $this->container['amount_gross_currency'];
    }

    /**
     * Sets amount_gross_currency
     *
     * @param float $amount_gross_currency amount_gross_currency
     *
     * @return $this
     */
    public function setAmountGrossCurrency($amount_gross_currency)
    {
        $this->container['amount_gross_currency'] = $amount_gross_currency;

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
     * Gets close_group
     *
     * @return \Learnist\Tripletex\Model\CloseGroup
     */
    public function getCloseGroup()
    {
        return $this->container['close_group'];
    }

    /**
     * Sets close_group
     *
     * @param \Learnist\Tripletex\Model\CloseGroup $close_group close_group
     *
     * @return $this
     */
    public function setCloseGroup($close_group)
    {
        $this->container['close_group'] = $close_group;

        return $this;
    }

    /**
     * Gets invoice_number
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string $invoice_number invoice_number
     *
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets term_of_payment
     *
     * @return string
     */
    public function getTermOfPayment()
    {
        return $this->container['term_of_payment'];
    }

    /**
     * Sets term_of_payment
     *
     * @param string $term_of_payment term_of_payment
     *
     * @return $this
     */
    public function setTermOfPayment($term_of_payment)
    {
        $this->container['term_of_payment'] = $term_of_payment;

        return $this;
    }

    /**
     * Gets row
     *
     * @return int
     */
    public function getRow()
    {
        return $this->container['row'];
    }

    /**
     * Sets row
     *
     * @param int $row row
     *
     * @return $this
     */
    public function setRow($row)
    {
        $this->container['row'] = $row;

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
     * Gets external_ref
     *
     * @return string
     */
    public function getExternalRef()
    {
        return $this->container['external_ref'];
    }

    /**
     * Sets external_ref
     *
     * @param string $external_ref External reference for identifying payment basis of the posting, e.g., KID, customer identification or credit note number.
     *
     * @return $this
     */
    public function setExternalRef($external_ref)
    {
        $this->container['external_ref'] = $external_ref;

        return $this;
    }

    /**
     * Gets system_generated
     *
     * @return bool
     */
    public function getSystemGenerated()
    {
        return $this->container['system_generated'];
    }

    /**
     * Sets system_generated
     *
     * @param bool $system_generated system_generated
     *
     * @return $this
     */
    public function setSystemGenerated($system_generated)
    {
        $this->container['system_generated'] = $system_generated;

        return $this;
    }

    /**
     * Gets tax_transaction_type
     *
     * @return string
     */
    public function getTaxTransactionType()
    {
        return $this->container['tax_transaction_type'];
    }

    /**
     * Sets tax_transaction_type
     *
     * @param string $tax_transaction_type tax_transaction_type
     *
     * @return $this
     */
    public function setTaxTransactionType($tax_transaction_type)
    {
        $this->container['tax_transaction_type'] = $tax_transaction_type;

        return $this;
    }

    /**
     * Gets tax_transaction_type_id
     *
     * @return int
     */
    public function getTaxTransactionTypeId()
    {
        return $this->container['tax_transaction_type_id'];
    }

    /**
     * Sets tax_transaction_type_id
     *
     * @param int $tax_transaction_type_id tax_transaction_type_id
     *
     * @return $this
     */
    public function setTaxTransactionTypeId($tax_transaction_type_id)
    {
        $this->container['tax_transaction_type_id'] = $tax_transaction_type_id;

        return $this;
    }

    /**
     * Gets matched
     *
     * @return bool
     */
    public function getMatched()
    {
        return $this->container['matched'];
    }

    /**
     * Sets matched
     *
     * @param bool $matched matched
     *
     * @return $this
     */
    public function setMatched($matched)
    {
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
