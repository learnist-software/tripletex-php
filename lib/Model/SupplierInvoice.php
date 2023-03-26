<?php
/**
 * SupplierInvoice
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
 * SupplierInvoice Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SupplierInvoice implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SupplierInvoice';

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
        'invoice_number' => 'string',
        'invoice_date' => 'string',
        'supplier' => '\Learnist\Tripletex\Model\Supplier',
        'invoice_due_date' => 'string',
        'kid_or_receiver_reference' => 'string',
        'voucher' => '\Learnist\Tripletex\Model\Voucher',
        'amount' => 'float',
        'amount_currency' => 'float',
        'amount_excluding_vat' => 'float',
        'amount_excluding_vat_currency' => 'float',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'is_credit_note' => 'bool',
        'order_lines' => '\Learnist\Tripletex\Model\OrderLine[]',
        'payments' => '\Learnist\Tripletex\Model\Posting[]',
        'original_invoice_document_id' => 'int',
        'approval_list_elements' => '\Learnist\Tripletex\Model\VoucherApprovalListElement[]',
        'outstanding_amount' => 'float'
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
        'invoice_number' => null,
        'invoice_date' => null,
        'supplier' => null,
        'invoice_due_date' => null,
        'kid_or_receiver_reference' => null,
        'voucher' => null,
        'amount' => null,
        'amount_currency' => null,
        'amount_excluding_vat' => null,
        'amount_excluding_vat_currency' => null,
        'currency' => null,
        'is_credit_note' => null,
        'order_lines' => null,
        'payments' => null,
        'original_invoice_document_id' => 'int32',
        'approval_list_elements' => null,
        'outstanding_amount' => null
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
		'invoice_number' => false,
		'invoice_date' => false,
		'supplier' => false,
		'invoice_due_date' => false,
		'kid_or_receiver_reference' => false,
		'voucher' => false,
		'amount' => false,
		'amount_currency' => false,
		'amount_excluding_vat' => false,
		'amount_excluding_vat_currency' => false,
		'currency' => false,
		'is_credit_note' => false,
		'order_lines' => false,
		'payments' => false,
		'original_invoice_document_id' => false,
		'approval_list_elements' => false,
		'outstanding_amount' => false
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
        'invoice_number' => 'invoiceNumber',
        'invoice_date' => 'invoiceDate',
        'supplier' => 'supplier',
        'invoice_due_date' => 'invoiceDueDate',
        'kid_or_receiver_reference' => 'kidOrReceiverReference',
        'voucher' => 'voucher',
        'amount' => 'amount',
        'amount_currency' => 'amountCurrency',
        'amount_excluding_vat' => 'amountExcludingVat',
        'amount_excluding_vat_currency' => 'amountExcludingVatCurrency',
        'currency' => 'currency',
        'is_credit_note' => 'isCreditNote',
        'order_lines' => 'orderLines',
        'payments' => 'payments',
        'original_invoice_document_id' => 'originalInvoiceDocumentId',
        'approval_list_elements' => 'approvalListElements',
        'outstanding_amount' => 'outstandingAmount'
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
        'invoice_number' => 'setInvoiceNumber',
        'invoice_date' => 'setInvoiceDate',
        'supplier' => 'setSupplier',
        'invoice_due_date' => 'setInvoiceDueDate',
        'kid_or_receiver_reference' => 'setKidOrReceiverReference',
        'voucher' => 'setVoucher',
        'amount' => 'setAmount',
        'amount_currency' => 'setAmountCurrency',
        'amount_excluding_vat' => 'setAmountExcludingVat',
        'amount_excluding_vat_currency' => 'setAmountExcludingVatCurrency',
        'currency' => 'setCurrency',
        'is_credit_note' => 'setIsCreditNote',
        'order_lines' => 'setOrderLines',
        'payments' => 'setPayments',
        'original_invoice_document_id' => 'setOriginalInvoiceDocumentId',
        'approval_list_elements' => 'setApprovalListElements',
        'outstanding_amount' => 'setOutstandingAmount'
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
        'invoice_number' => 'getInvoiceNumber',
        'invoice_date' => 'getInvoiceDate',
        'supplier' => 'getSupplier',
        'invoice_due_date' => 'getInvoiceDueDate',
        'kid_or_receiver_reference' => 'getKidOrReceiverReference',
        'voucher' => 'getVoucher',
        'amount' => 'getAmount',
        'amount_currency' => 'getAmountCurrency',
        'amount_excluding_vat' => 'getAmountExcludingVat',
        'amount_excluding_vat_currency' => 'getAmountExcludingVatCurrency',
        'currency' => 'getCurrency',
        'is_credit_note' => 'getIsCreditNote',
        'order_lines' => 'getOrderLines',
        'payments' => 'getPayments',
        'original_invoice_document_id' => 'getOriginalInvoiceDocumentId',
        'approval_list_elements' => 'getApprovalListElements',
        'outstanding_amount' => 'getOutstandingAmount'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('invoice_number', $data ?? [], null);
        $this->setIfExists('invoice_date', $data ?? [], null);
        $this->setIfExists('supplier', $data ?? [], null);
        $this->setIfExists('invoice_due_date', $data ?? [], null);
        $this->setIfExists('kid_or_receiver_reference', $data ?? [], null);
        $this->setIfExists('voucher', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('amount_currency', $data ?? [], null);
        $this->setIfExists('amount_excluding_vat', $data ?? [], null);
        $this->setIfExists('amount_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('is_credit_note', $data ?? [], null);
        $this->setIfExists('order_lines', $data ?? [], null);
        $this->setIfExists('payments', $data ?? [], null);
        $this->setIfExists('original_invoice_document_id', $data ?? [], null);
        $this->setIfExists('approval_list_elements', $data ?? [], null);
        $this->setIfExists('outstanding_amount', $data ?? [], null);
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

        if ($this->container['invoice_date'] === null) {
            $invalidProperties[] = "'invoice_date' can't be null";
        }
        if ($this->container['invoice_due_date'] === null) {
            $invalidProperties[] = "'invoice_due_date' can't be null";
        }
        if (!is_null($this->container['original_invoice_document_id']) && ($this->container['original_invoice_document_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'original_invoice_document_id', must be bigger than or equal to 0.";
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
     * @param string|null $invoice_number Invoice number
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        if (is_null($invoice_number)) {
            throw new \InvalidArgumentException('non-nullable invoice_number cannot be null');
        }
        if ((mb_strlen($invoice_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $invoice_number when calling SupplierInvoice., must be smaller than or equal to 100.');
        }

        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets invoice_date
     *
     * @return string
     */
    public function getInvoiceDate()
    {
        return $this->container['invoice_date'];
    }

    /**
     * Sets invoice_date
     *
     * @param string $invoice_date invoice_date
     *
     * @return self
     */
    public function setInvoiceDate($invoice_date)
    {
        if (is_null($invoice_date)) {
            throw new \InvalidArgumentException('non-nullable invoice_date cannot be null');
        }
        $this->container['invoice_date'] = $invoice_date;

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
     * Gets invoice_due_date
     *
     * @return string
     */
    public function getInvoiceDueDate()
    {
        return $this->container['invoice_due_date'];
    }

    /**
     * Sets invoice_due_date
     *
     * @param string $invoice_due_date invoice_due_date
     *
     * @return self
     */
    public function setInvoiceDueDate($invoice_due_date)
    {
        if (is_null($invoice_due_date)) {
            throw new \InvalidArgumentException('non-nullable invoice_due_date cannot be null');
        }
        $this->container['invoice_due_date'] = $invoice_due_date;

        return $this;
    }

    /**
     * Gets kid_or_receiver_reference
     *
     * @return string|null
     */
    public function getKidOrReceiverReference()
    {
        return $this->container['kid_or_receiver_reference'];
    }

    /**
     * Sets kid_or_receiver_reference
     *
     * @param string|null $kid_or_receiver_reference KID or message
     *
     * @return self
     */
    public function setKidOrReceiverReference($kid_or_receiver_reference)
    {
        if (is_null($kid_or_receiver_reference)) {
            throw new \InvalidArgumentException('non-nullable kid_or_receiver_reference cannot be null');
        }
        $this->container['kid_or_receiver_reference'] = $kid_or_receiver_reference;

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
     * @param float|null $amount In the company’s currency, typically NOK. Is 0 if value is missing.
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
     * @param float|null $amount_currency In the specified currency.
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
     * Gets amount_excluding_vat
     *
     * @return float|null
     */
    public function getAmountExcludingVat()
    {
        return $this->container['amount_excluding_vat'];
    }

    /**
     * Sets amount_excluding_vat
     *
     * @param float|null $amount_excluding_vat Amount excluding VAT (NOK). Is 0 if value is missing.
     *
     * @return self
     */
    public function setAmountExcludingVat($amount_excluding_vat)
    {
        if (is_null($amount_excluding_vat)) {
            throw new \InvalidArgumentException('non-nullable amount_excluding_vat cannot be null');
        }
        $this->container['amount_excluding_vat'] = $amount_excluding_vat;

        return $this;
    }

    /**
     * Gets amount_excluding_vat_currency
     *
     * @return float|null
     */
    public function getAmountExcludingVatCurrency()
    {
        return $this->container['amount_excluding_vat_currency'];
    }

    /**
     * Sets amount_excluding_vat_currency
     *
     * @param float|null $amount_excluding_vat_currency Amount excluding VAT in the specified currency. Is 0 if value is missing.
     *
     * @return self
     */
    public function setAmountExcludingVatCurrency($amount_excluding_vat_currency)
    {
        if (is_null($amount_excluding_vat_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_excluding_vat_currency cannot be null');
        }
        $this->container['amount_excluding_vat_currency'] = $amount_excluding_vat_currency;

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
     * Gets is_credit_note
     *
     * @return bool|null
     */
    public function getIsCreditNote()
    {
        return $this->container['is_credit_note'];
    }

    /**
     * Sets is_credit_note
     *
     * @param bool|null $is_credit_note is_credit_note
     *
     * @return self
     */
    public function setIsCreditNote($is_credit_note)
    {
        if (is_null($is_credit_note)) {
            throw new \InvalidArgumentException('non-nullable is_credit_note cannot be null');
        }
        $this->container['is_credit_note'] = $is_credit_note;

        return $this;
    }

    /**
     * Gets order_lines
     *
     * @return \Learnist\Tripletex\Model\OrderLine[]|null
     */
    public function getOrderLines()
    {
        return $this->container['order_lines'];
    }

    /**
     * Sets order_lines
     *
     * @param \Learnist\Tripletex\Model\OrderLine[]|null $order_lines order_lines
     *
     * @return self
     */
    public function setOrderLines($order_lines)
    {
        if (is_null($order_lines)) {
            throw new \InvalidArgumentException('non-nullable order_lines cannot be null');
        }
        $this->container['order_lines'] = $order_lines;

        return $this;
    }

    /**
     * Gets payments
     *
     * @return \Learnist\Tripletex\Model\Posting[]|null
     */
    public function getPayments()
    {
        return $this->container['payments'];
    }

    /**
     * Sets payments
     *
     * @param \Learnist\Tripletex\Model\Posting[]|null $payments payments
     *
     * @return self
     */
    public function setPayments($payments)
    {
        if (is_null($payments)) {
            throw new \InvalidArgumentException('non-nullable payments cannot be null');
        }
        $this->container['payments'] = $payments;

        return $this;
    }

    /**
     * Gets original_invoice_document_id
     *
     * @return int|null
     */
    public function getOriginalInvoiceDocumentId()
    {
        return $this->container['original_invoice_document_id'];
    }

    /**
     * Sets original_invoice_document_id
     *
     * @param int|null $original_invoice_document_id original_invoice_document_id
     *
     * @return self
     */
    public function setOriginalInvoiceDocumentId($original_invoice_document_id)
    {
        if (is_null($original_invoice_document_id)) {
            throw new \InvalidArgumentException('non-nullable original_invoice_document_id cannot be null');
        }

        if (($original_invoice_document_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $original_invoice_document_id when calling SupplierInvoice., must be bigger than or equal to 0.');
        }

        $this->container['original_invoice_document_id'] = $original_invoice_document_id;

        return $this;
    }

    /**
     * Gets approval_list_elements
     *
     * @return \Learnist\Tripletex\Model\VoucherApprovalListElement[]|null
     */
    public function getApprovalListElements()
    {
        return $this->container['approval_list_elements'];
    }

    /**
     * Sets approval_list_elements
     *
     * @param \Learnist\Tripletex\Model\VoucherApprovalListElement[]|null $approval_list_elements approval_list_elements
     *
     * @return self
     */
    public function setApprovalListElements($approval_list_elements)
    {
        if (is_null($approval_list_elements)) {
            throw new \InvalidArgumentException('non-nullable approval_list_elements cannot be null');
        }
        $this->container['approval_list_elements'] = $approval_list_elements;

        return $this;
    }

    /**
     * Gets outstanding_amount
     *
     * @return float|null
     */
    public function getOutstandingAmount()
    {
        return $this->container['outstanding_amount'];
    }

    /**
     * Sets outstanding_amount
     *
     * @param float|null $outstanding_amount The amount outstanding on the invoice, in the invoice currency.
     *
     * @return self
     */
    public function setOutstandingAmount($outstanding_amount)
    {
        if (is_null($outstanding_amount)) {
            throw new \InvalidArgumentException('non-nullable outstanding_amount cannot be null');
        }
        $this->container['outstanding_amount'] = $outstanding_amount;

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


