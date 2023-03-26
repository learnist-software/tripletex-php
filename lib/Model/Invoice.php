<?php
/**
 * Invoice
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
 * Invoice Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Invoice implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Invoice';

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
        'invoice_number' => 'int',
        'invoice_date' => 'string',
        'customer' => '\Learnist\Tripletex\Model\Customer',
        'credited_invoice' => 'int',
        'is_credited' => 'bool',
        'invoice_due_date' => 'string',
        'kid' => 'string',
        'invoice_comment' => 'string',
        'comment' => 'string',
        'orders' => '\Learnist\Tripletex\Model\Order[]',
        'order_lines' => '\Learnist\Tripletex\Model\OrderLine[]',
        'travel_reports' => '\Learnist\Tripletex\Model\TravelExpense[]',
        'project_invoice_details' => '\Learnist\Tripletex\Model\ProjectInvoiceDetails[]',
        'voucher' => '\Learnist\Tripletex\Model\Voucher',
        'delivery_date' => 'string',
        'amount' => 'float',
        'amount_currency' => 'float',
        'amount_excluding_vat' => 'float',
        'amount_excluding_vat_currency' => 'float',
        'amount_roundoff' => 'float',
        'amount_roundoff_currency' => 'float',
        'amount_outstanding' => 'float',
        'amount_currency_outstanding' => 'float',
        'amount_outstanding_total' => 'float',
        'amount_currency_outstanding_total' => 'float',
        'sum_remits' => 'float',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'is_credit_note' => 'bool',
        'is_charged' => 'bool',
        'is_approved' => 'bool',
        'postings' => '\Learnist\Tripletex\Model\Posting[]',
        'reminders' => '\Learnist\Tripletex\Model\Reminder[]',
        'invoice_remarks' => 'string',
        'invoice_remark' => '\Learnist\Tripletex\Model\InvoiceRemark',
        'payment_type_id' => 'int',
        'paid_amount' => 'float',
        'is_periodization_possible' => 'bool',
        'ehf_send_status' => 'string'
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
        'invoice_number' => 'int32',
        'invoice_date' => null,
        'customer' => null,
        'credited_invoice' => 'int32',
        'is_credited' => null,
        'invoice_due_date' => null,
        'kid' => null,
        'invoice_comment' => null,
        'comment' => null,
        'orders' => null,
        'order_lines' => null,
        'travel_reports' => null,
        'project_invoice_details' => null,
        'voucher' => null,
        'delivery_date' => null,
        'amount' => null,
        'amount_currency' => null,
        'amount_excluding_vat' => null,
        'amount_excluding_vat_currency' => null,
        'amount_roundoff' => null,
        'amount_roundoff_currency' => null,
        'amount_outstanding' => null,
        'amount_currency_outstanding' => null,
        'amount_outstanding_total' => null,
        'amount_currency_outstanding_total' => null,
        'sum_remits' => null,
        'currency' => null,
        'is_credit_note' => null,
        'is_charged' => null,
        'is_approved' => null,
        'postings' => null,
        'reminders' => null,
        'invoice_remarks' => null,
        'invoice_remark' => null,
        'payment_type_id' => 'int32',
        'paid_amount' => null,
        'is_periodization_possible' => null,
        'ehf_send_status' => null
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
		'customer' => false,
		'credited_invoice' => false,
		'is_credited' => false,
		'invoice_due_date' => false,
		'kid' => false,
		'invoice_comment' => false,
		'comment' => false,
		'orders' => false,
		'order_lines' => false,
		'travel_reports' => false,
		'project_invoice_details' => false,
		'voucher' => false,
		'delivery_date' => false,
		'amount' => false,
		'amount_currency' => false,
		'amount_excluding_vat' => false,
		'amount_excluding_vat_currency' => false,
		'amount_roundoff' => false,
		'amount_roundoff_currency' => false,
		'amount_outstanding' => false,
		'amount_currency_outstanding' => false,
		'amount_outstanding_total' => false,
		'amount_currency_outstanding_total' => false,
		'sum_remits' => false,
		'currency' => false,
		'is_credit_note' => false,
		'is_charged' => false,
		'is_approved' => false,
		'postings' => false,
		'reminders' => false,
		'invoice_remarks' => false,
		'invoice_remark' => false,
		'payment_type_id' => false,
		'paid_amount' => false,
		'is_periodization_possible' => false,
		'ehf_send_status' => false
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
        'customer' => 'customer',
        'credited_invoice' => 'creditedInvoice',
        'is_credited' => 'isCredited',
        'invoice_due_date' => 'invoiceDueDate',
        'kid' => 'kid',
        'invoice_comment' => 'invoiceComment',
        'comment' => 'comment',
        'orders' => 'orders',
        'order_lines' => 'orderLines',
        'travel_reports' => 'travelReports',
        'project_invoice_details' => 'projectInvoiceDetails',
        'voucher' => 'voucher',
        'delivery_date' => 'deliveryDate',
        'amount' => 'amount',
        'amount_currency' => 'amountCurrency',
        'amount_excluding_vat' => 'amountExcludingVat',
        'amount_excluding_vat_currency' => 'amountExcludingVatCurrency',
        'amount_roundoff' => 'amountRoundoff',
        'amount_roundoff_currency' => 'amountRoundoffCurrency',
        'amount_outstanding' => 'amountOutstanding',
        'amount_currency_outstanding' => 'amountCurrencyOutstanding',
        'amount_outstanding_total' => 'amountOutstandingTotal',
        'amount_currency_outstanding_total' => 'amountCurrencyOutstandingTotal',
        'sum_remits' => 'sumRemits',
        'currency' => 'currency',
        'is_credit_note' => 'isCreditNote',
        'is_charged' => 'isCharged',
        'is_approved' => 'isApproved',
        'postings' => 'postings',
        'reminders' => 'reminders',
        'invoice_remarks' => 'invoiceRemarks',
        'invoice_remark' => 'invoiceRemark',
        'payment_type_id' => 'paymentTypeId',
        'paid_amount' => 'paidAmount',
        'is_periodization_possible' => 'isPeriodizationPossible',
        'ehf_send_status' => 'ehfSendStatus'
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
        'customer' => 'setCustomer',
        'credited_invoice' => 'setCreditedInvoice',
        'is_credited' => 'setIsCredited',
        'invoice_due_date' => 'setInvoiceDueDate',
        'kid' => 'setKid',
        'invoice_comment' => 'setInvoiceComment',
        'comment' => 'setComment',
        'orders' => 'setOrders',
        'order_lines' => 'setOrderLines',
        'travel_reports' => 'setTravelReports',
        'project_invoice_details' => 'setProjectInvoiceDetails',
        'voucher' => 'setVoucher',
        'delivery_date' => 'setDeliveryDate',
        'amount' => 'setAmount',
        'amount_currency' => 'setAmountCurrency',
        'amount_excluding_vat' => 'setAmountExcludingVat',
        'amount_excluding_vat_currency' => 'setAmountExcludingVatCurrency',
        'amount_roundoff' => 'setAmountRoundoff',
        'amount_roundoff_currency' => 'setAmountRoundoffCurrency',
        'amount_outstanding' => 'setAmountOutstanding',
        'amount_currency_outstanding' => 'setAmountCurrencyOutstanding',
        'amount_outstanding_total' => 'setAmountOutstandingTotal',
        'amount_currency_outstanding_total' => 'setAmountCurrencyOutstandingTotal',
        'sum_remits' => 'setSumRemits',
        'currency' => 'setCurrency',
        'is_credit_note' => 'setIsCreditNote',
        'is_charged' => 'setIsCharged',
        'is_approved' => 'setIsApproved',
        'postings' => 'setPostings',
        'reminders' => 'setReminders',
        'invoice_remarks' => 'setInvoiceRemarks',
        'invoice_remark' => 'setInvoiceRemark',
        'payment_type_id' => 'setPaymentTypeId',
        'paid_amount' => 'setPaidAmount',
        'is_periodization_possible' => 'setIsPeriodizationPossible',
        'ehf_send_status' => 'setEhfSendStatus'
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
        'customer' => 'getCustomer',
        'credited_invoice' => 'getCreditedInvoice',
        'is_credited' => 'getIsCredited',
        'invoice_due_date' => 'getInvoiceDueDate',
        'kid' => 'getKid',
        'invoice_comment' => 'getInvoiceComment',
        'comment' => 'getComment',
        'orders' => 'getOrders',
        'order_lines' => 'getOrderLines',
        'travel_reports' => 'getTravelReports',
        'project_invoice_details' => 'getProjectInvoiceDetails',
        'voucher' => 'getVoucher',
        'delivery_date' => 'getDeliveryDate',
        'amount' => 'getAmount',
        'amount_currency' => 'getAmountCurrency',
        'amount_excluding_vat' => 'getAmountExcludingVat',
        'amount_excluding_vat_currency' => 'getAmountExcludingVatCurrency',
        'amount_roundoff' => 'getAmountRoundoff',
        'amount_roundoff_currency' => 'getAmountRoundoffCurrency',
        'amount_outstanding' => 'getAmountOutstanding',
        'amount_currency_outstanding' => 'getAmountCurrencyOutstanding',
        'amount_outstanding_total' => 'getAmountOutstandingTotal',
        'amount_currency_outstanding_total' => 'getAmountCurrencyOutstandingTotal',
        'sum_remits' => 'getSumRemits',
        'currency' => 'getCurrency',
        'is_credit_note' => 'getIsCreditNote',
        'is_charged' => 'getIsCharged',
        'is_approved' => 'getIsApproved',
        'postings' => 'getPostings',
        'reminders' => 'getReminders',
        'invoice_remarks' => 'getInvoiceRemarks',
        'invoice_remark' => 'getInvoiceRemark',
        'payment_type_id' => 'getPaymentTypeId',
        'paid_amount' => 'getPaidAmount',
        'is_periodization_possible' => 'getIsPeriodizationPossible',
        'ehf_send_status' => 'getEhfSendStatus'
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

    public const EHF_SEND_STATUS_DO_NOT_SEND = 'DO_NOT_SEND';
    public const EHF_SEND_STATUS_SEND = 'SEND';
    public const EHF_SEND_STATUS_SENT = 'SENT';
    public const EHF_SEND_STATUS_SEND_FAILURE_RECIPIENT_NOT_FOUND = 'SEND_FAILURE_RECIPIENT_NOT_FOUND';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEhfSendStatusAllowableValues()
    {
        return [
            self::EHF_SEND_STATUS_DO_NOT_SEND,
            self::EHF_SEND_STATUS_SEND,
            self::EHF_SEND_STATUS_SENT,
            self::EHF_SEND_STATUS_SEND_FAILURE_RECIPIENT_NOT_FOUND,
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
        $this->setIfExists('invoice_number', $data ?? [], null);
        $this->setIfExists('invoice_date', $data ?? [], null);
        $this->setIfExists('customer', $data ?? [], null);
        $this->setIfExists('credited_invoice', $data ?? [], null);
        $this->setIfExists('is_credited', $data ?? [], null);
        $this->setIfExists('invoice_due_date', $data ?? [], null);
        $this->setIfExists('kid', $data ?? [], null);
        $this->setIfExists('invoice_comment', $data ?? [], null);
        $this->setIfExists('comment', $data ?? [], null);
        $this->setIfExists('orders', $data ?? [], null);
        $this->setIfExists('order_lines', $data ?? [], null);
        $this->setIfExists('travel_reports', $data ?? [], null);
        $this->setIfExists('project_invoice_details', $data ?? [], null);
        $this->setIfExists('voucher', $data ?? [], null);
        $this->setIfExists('delivery_date', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('amount_currency', $data ?? [], null);
        $this->setIfExists('amount_excluding_vat', $data ?? [], null);
        $this->setIfExists('amount_excluding_vat_currency', $data ?? [], null);
        $this->setIfExists('amount_roundoff', $data ?? [], null);
        $this->setIfExists('amount_roundoff_currency', $data ?? [], null);
        $this->setIfExists('amount_outstanding', $data ?? [], null);
        $this->setIfExists('amount_currency_outstanding', $data ?? [], null);
        $this->setIfExists('amount_outstanding_total', $data ?? [], null);
        $this->setIfExists('amount_currency_outstanding_total', $data ?? [], null);
        $this->setIfExists('sum_remits', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('is_credit_note', $data ?? [], null);
        $this->setIfExists('is_charged', $data ?? [], null);
        $this->setIfExists('is_approved', $data ?? [], null);
        $this->setIfExists('postings', $data ?? [], null);
        $this->setIfExists('reminders', $data ?? [], null);
        $this->setIfExists('invoice_remarks', $data ?? [], null);
        $this->setIfExists('invoice_remark', $data ?? [], null);
        $this->setIfExists('payment_type_id', $data ?? [], null);
        $this->setIfExists('paid_amount', $data ?? [], null);
        $this->setIfExists('is_periodization_possible', $data ?? [], null);
        $this->setIfExists('ehf_send_status', $data ?? [], null);
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

        if (!is_null($this->container['invoice_number']) && ($this->container['invoice_number'] < 0)) {
            $invalidProperties[] = "invalid value for 'invoice_number', must be bigger than or equal to 0.";
        }

        if ($this->container['invoice_date'] === null) {
            $invalidProperties[] = "'invoice_date' can't be null";
        }
        if ($this->container['invoice_due_date'] === null) {
            $invalidProperties[] = "'invoice_due_date' can't be null";
        }
        if (!is_null($this->container['kid']) && (mb_strlen($this->container['kid']) > 25)) {
            $invalidProperties[] = "invalid value for 'kid', the character length must be smaller than or equal to 25.";
        }

        if ($this->container['orders'] === null) {
            $invalidProperties[] = "'orders' can't be null";
        }
        if (!is_null($this->container['payment_type_id']) && ($this->container['payment_type_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'payment_type_id', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getEhfSendStatusAllowableValues();
        if (!is_null($this->container['ehf_send_status']) && !in_array($this->container['ehf_send_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'ehf_send_status', must be one of '%s'",
                $this->container['ehf_send_status'],
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
     * @return int|null
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param int|null $invoice_number If value is set to 0, the invoice number will be generated.
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {

        if (!is_null($invoice_number) && ($invoice_number < 0)) {
            throw new \InvalidArgumentException('invalid value for $invoice_number when calling Invoice., must be bigger than or equal to 0.');
        }


        if (is_null($invoice_number)) {
            throw new \InvalidArgumentException('non-nullable invoice_number cannot be null');
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
     * Gets credited_invoice
     *
     * @return int|null
     */
    public function getCreditedInvoice()
    {
        return $this->container['credited_invoice'];
    }

    /**
     * Sets credited_invoice
     *
     * @param int|null $credited_invoice The id of the original invoice if this is a credit note.
     *
     * @return self
     */
    public function setCreditedInvoice($credited_invoice)
    {

        if (is_null($credited_invoice)) {
            throw new \InvalidArgumentException('non-nullable credited_invoice cannot be null');
        }

        $this->container['credited_invoice'] = $credited_invoice;

        return $this;
    }

    /**
     * Gets is_credited
     *
     * @return bool|null
     */
    public function getIsCredited()
    {
        return $this->container['is_credited'];
    }

    /**
     * Sets is_credited
     *
     * @param bool|null $is_credited is_credited
     *
     * @return self
     */
    public function setIsCredited($is_credited)
    {

        if (is_null($is_credited)) {
            throw new \InvalidArgumentException('non-nullable is_credited cannot be null');
        }

        $this->container['is_credited'] = $is_credited;

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
     * Gets kid
     *
     * @return string|null
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string|null $kid KID - Kundeidentifikasjonsnummer.
     *
     * @return self
     */
    public function setKid($kid)
    {
        if (!is_null($kid) && (mb_strlen($kid) > 25)) {
            throw new \InvalidArgumentException('invalid length for $kid when calling Invoice., must be smaller than or equal to 25.');
        }


        if (is_null($kid)) {
            throw new \InvalidArgumentException('non-nullable kid cannot be null');
        }

        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets invoice_comment
     *
     * @return string|null
     */
    public function getInvoiceComment()
    {
        return $this->container['invoice_comment'];
    }

    /**
     * Sets invoice_comment
     *
     * @param string|null $invoice_comment Comment text for the invoice. This was specified on the order as invoiceComment.
     *
     * @return self
     */
    public function setInvoiceComment($invoice_comment)
    {

        if (is_null($invoice_comment)) {
            throw new \InvalidArgumentException('non-nullable invoice_comment cannot be null');
        }

        $this->container['invoice_comment'] = $invoice_comment;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string|null $comment Comment text for the specific invoice.
     *
     * @return self
     */
    public function setComment($comment)
    {

        if (is_null($comment)) {
            throw new \InvalidArgumentException('non-nullable comment cannot be null');
        }

        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets orders
     *
     * @return \Learnist\Tripletex\Model\Order[]
     */
    public function getOrders()
    {
        return $this->container['orders'];
    }

    /**
     * Sets orders
     *
     * @param \Learnist\Tripletex\Model\Order[] $orders Related orders. Only one order per invoice is supported at the moment.
     *
     * @return self
     */
    public function setOrders($orders)
    {

        if (is_null($orders)) {
            throw new \InvalidArgumentException('non-nullable orders cannot be null');
        }

        $this->container['orders'] = $orders;

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
     * @param \Learnist\Tripletex\Model\OrderLine[]|null $order_lines Orderlines connected to the invoice.
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
     * Gets travel_reports
     *
     * @return \Learnist\Tripletex\Model\TravelExpense[]|null
     */
    public function getTravelReports()
    {
        return $this->container['travel_reports'];
    }

    /**
     * Sets travel_reports
     *
     * @param \Learnist\Tripletex\Model\TravelExpense[]|null $travel_reports Travel reports connected to the invoice.
     *
     * @return self
     */
    public function setTravelReports($travel_reports)
    {

        if (is_null($travel_reports)) {
            throw new \InvalidArgumentException('non-nullable travel_reports cannot be null');
        }

        $this->container['travel_reports'] = $travel_reports;

        return $this;
    }

    /**
     * Gets project_invoice_details
     *
     * @return \Learnist\Tripletex\Model\ProjectInvoiceDetails[]|null
     */
    public function getProjectInvoiceDetails()
    {
        return $this->container['project_invoice_details'];
    }

    /**
     * Sets project_invoice_details
     *
     * @param \Learnist\Tripletex\Model\ProjectInvoiceDetails[]|null $project_invoice_details ProjectInvoiceDetails contains additional information about the invoice, in particular invoices for projects. It contains information about the charged project, the fee amount, extra percent and amount, extra costs, travel expenses, invoice and project comments, akonto amount and values determining if extra costs, akonto and hours should be included. ProjectInvoiceDetails is an object which represents the relation between an invoice and a Project, Orderline and OrderOut object.
     *
     * @return self
     */
    public function setProjectInvoiceDetails($project_invoice_details)
    {

        if (is_null($project_invoice_details)) {
            throw new \InvalidArgumentException('non-nullable project_invoice_details cannot be null');
        }

        $this->container['project_invoice_details'] = $project_invoice_details;

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
     * Gets delivery_date
     *
     * @return string|null
     */
    public function getDeliveryDate()
    {
        return $this->container['delivery_date'];
    }

    /**
     * Sets delivery_date
     *
     * @param string|null $delivery_date The delivery date.
     *
     * @return self
     */
    public function setDeliveryDate($delivery_date)
    {

        if (is_null($delivery_date)) {
            throw new \InvalidArgumentException('non-nullable delivery_date cannot be null');
        }

        $this->container['delivery_date'] = $delivery_date;

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
     * @param float|null $amount In the company’s currency, typically NOK.
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
     * @param float|null $amount_excluding_vat Amount excluding VAT (NOK).
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
     * @param float|null $amount_excluding_vat_currency Amount excluding VAT in the specified currency.
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
     * Gets amount_roundoff
     *
     * @return float|null
     */
    public function getAmountRoundoff()
    {
        return $this->container['amount_roundoff'];
    }

    /**
     * Sets amount_roundoff
     *
     * @param float|null $amount_roundoff Amount of round off to nearest integer.
     *
     * @return self
     */
    public function setAmountRoundoff($amount_roundoff)
    {

        if (is_null($amount_roundoff)) {
            throw new \InvalidArgumentException('non-nullable amount_roundoff cannot be null');
        }

        $this->container['amount_roundoff'] = $amount_roundoff;

        return $this;
    }

    /**
     * Gets amount_roundoff_currency
     *
     * @return float|null
     */
    public function getAmountRoundoffCurrency()
    {
        return $this->container['amount_roundoff_currency'];
    }

    /**
     * Sets amount_roundoff_currency
     *
     * @param float|null $amount_roundoff_currency Amount of round off to nearest integer in the specified currency.
     *
     * @return self
     */
    public function setAmountRoundoffCurrency($amount_roundoff_currency)
    {

        if (is_null($amount_roundoff_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_roundoff_currency cannot be null');
        }

        $this->container['amount_roundoff_currency'] = $amount_roundoff_currency;

        return $this;
    }

    /**
     * Gets amount_outstanding
     *
     * @return float|null
     */
    public function getAmountOutstanding()
    {
        return $this->container['amount_outstanding'];
    }

    /**
     * Sets amount_outstanding
     *
     * @param float|null $amount_outstanding The amount outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency.
     *
     * @return self
     */
    public function setAmountOutstanding($amount_outstanding)
    {

        if (is_null($amount_outstanding)) {
            throw new \InvalidArgumentException('non-nullable amount_outstanding cannot be null');
        }

        $this->container['amount_outstanding'] = $amount_outstanding;

        return $this;
    }

    /**
     * Gets amount_currency_outstanding
     *
     * @return float|null
     */
    public function getAmountCurrencyOutstanding()
    {
        return $this->container['amount_currency_outstanding'];
    }

    /**
     * Sets amount_currency_outstanding
     *
     * @param float|null $amount_currency_outstanding The amountCurrency outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency.
     *
     * @return self
     */
    public function setAmountCurrencyOutstanding($amount_currency_outstanding)
    {

        if (is_null($amount_currency_outstanding)) {
            throw new \InvalidArgumentException('non-nullable amount_currency_outstanding cannot be null');
        }

        $this->container['amount_currency_outstanding'] = $amount_currency_outstanding;

        return $this;
    }

    /**
     * Gets amount_outstanding_total
     *
     * @return float|null
     */
    public function getAmountOutstandingTotal()
    {
        return $this->container['amount_outstanding_total'];
    }

    /**
     * Sets amount_outstanding_total
     *
     * @param float|null $amount_outstanding_total The amount outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency.
     *
     * @return self
     */
    public function setAmountOutstandingTotal($amount_outstanding_total)
    {

        if (is_null($amount_outstanding_total)) {
            throw new \InvalidArgumentException('non-nullable amount_outstanding_total cannot be null');
        }

        $this->container['amount_outstanding_total'] = $amount_outstanding_total;

        return $this;
    }

    /**
     * Gets amount_currency_outstanding_total
     *
     * @return float|null
     */
    public function getAmountCurrencyOutstandingTotal()
    {
        return $this->container['amount_currency_outstanding_total'];
    }

    /**
     * Sets amount_currency_outstanding_total
     *
     * @param float|null $amount_currency_outstanding_total The amountCurrency outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency.
     *
     * @return self
     */
    public function setAmountCurrencyOutstandingTotal($amount_currency_outstanding_total)
    {

        if (is_null($amount_currency_outstanding_total)) {
            throw new \InvalidArgumentException('non-nullable amount_currency_outstanding_total cannot be null');
        }

        $this->container['amount_currency_outstanding_total'] = $amount_currency_outstanding_total;

        return $this;
    }

    /**
     * Gets sum_remits
     *
     * @return float|null
     */
    public function getSumRemits()
    {
        return $this->container['sum_remits'];
    }

    /**
     * Sets sum_remits
     *
     * @param float|null $sum_remits The sum of all open remittances of the invoice. Remittances are reimbursement payments back to the customer and are therefore relevant to the bookkeeping of the invoice in the accounts.
     *
     * @return self
     */
    public function setSumRemits($sum_remits)
    {

        if (is_null($sum_remits)) {
            throw new \InvalidArgumentException('non-nullable sum_remits cannot be null');
        }

        $this->container['sum_remits'] = $sum_remits;

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
     * Gets is_charged
     *
     * @return bool|null
     */
    public function getIsCharged()
    {
        return $this->container['is_charged'];
    }

    /**
     * Sets is_charged
     *
     * @param bool|null $is_charged is_charged
     *
     * @return self
     */
    public function setIsCharged($is_charged)
    {

        if (is_null($is_charged)) {
            throw new \InvalidArgumentException('non-nullable is_charged cannot be null');
        }

        $this->container['is_charged'] = $is_charged;

        return $this;
    }

    /**
     * Gets is_approved
     *
     * @return bool|null
     */
    public function getIsApproved()
    {
        return $this->container['is_approved'];
    }

    /**
     * Sets is_approved
     *
     * @param bool|null $is_approved is_approved
     *
     * @return self
     */
    public function setIsApproved($is_approved)
    {

        if (is_null($is_approved)) {
            throw new \InvalidArgumentException('non-nullable is_approved cannot be null');
        }

        $this->container['is_approved'] = $is_approved;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting[]|null
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting[]|null $postings The invoice postings, which includes a posting for the invoice with a positive amount, and one or more posting for the payments with negative amounts.
     *
     * @return self
     */
    public function setPostings($postings)
    {

        if (is_null($postings)) {
            throw new \InvalidArgumentException('non-nullable postings cannot be null');
        }

        $this->container['postings'] = $postings;

        return $this;
    }

    /**
     * Gets reminders
     *
     * @return \Learnist\Tripletex\Model\Reminder[]|null
     */
    public function getReminders()
    {
        return $this->container['reminders'];
    }

    /**
     * Sets reminders
     *
     * @param \Learnist\Tripletex\Model\Reminder[]|null $reminders Invoice debt collection and reminders.
     *
     * @return self
     */
    public function setReminders($reminders)
    {

        if (is_null($reminders)) {
            throw new \InvalidArgumentException('non-nullable reminders cannot be null');
        }

        $this->container['reminders'] = $reminders;

        return $this;
    }

    /**
     * Gets invoice_remarks
     *
     * @return string|null
     */
    public function getInvoiceRemarks()
    {
        return $this->container['invoice_remarks'];
    }

    /**
     * Sets invoice_remarks
     *
     * @param string|null $invoice_remarks Deprecated Invoice remarks - please use the 'invoiceRemark' instead.
     *
     * @return self
     */
    public function setInvoiceRemarks($invoice_remarks)
    {

        if (is_null($invoice_remarks)) {
            throw new \InvalidArgumentException('non-nullable invoice_remarks cannot be null');
        }

        $this->container['invoice_remarks'] = $invoice_remarks;

        return $this;
    }

    /**
     * Gets invoice_remark
     *
     * @return \Learnist\Tripletex\Model\InvoiceRemark|null
     */
    public function getInvoiceRemark()
    {
        return $this->container['invoice_remark'];
    }

    /**
     * Sets invoice_remark
     *
     * @param \Learnist\Tripletex\Model\InvoiceRemark|null $invoice_remark invoice_remark
     *
     * @return self
     */
    public function setInvoiceRemark($invoice_remark)
    {

        if (is_null($invoice_remark)) {
            throw new \InvalidArgumentException('non-nullable invoice_remark cannot be null');
        }

        $this->container['invoice_remark'] = $invoice_remark;

        return $this;
    }

    /**
     * Gets payment_type_id
     *
     * @return int|null
     */
    public function getPaymentTypeId()
    {
        return $this->container['payment_type_id'];
    }

    /**
     * Sets payment_type_id
     *
     * @param int|null $payment_type_id [BETA] Optional. Used to specify payment type for prepaid invoices. Payment type can be specified here, or as a parameter to the /invoice API endpoint.
     *
     * @return self
     */
    public function setPaymentTypeId($payment_type_id)
    {

        if (!is_null($payment_type_id) && ($payment_type_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $payment_type_id when calling Invoice., must be bigger than or equal to 0.');
        }


        if (is_null($payment_type_id)) {
            throw new \InvalidArgumentException('non-nullable payment_type_id cannot be null');
        }

        $this->container['payment_type_id'] = $payment_type_id;

        return $this;
    }

    /**
     * Gets paid_amount
     *
     * @return float|null
     */
    public function getPaidAmount()
    {
        return $this->container['paid_amount'];
    }

    /**
     * Sets paid_amount
     *
     * @param float|null $paid_amount [BETA] Optional. Used to specify the prepaid amount of the invoice. The paid amount can be specified here, or as a parameter to the /invoice API endpoint.
     *
     * @return self
     */
    public function setPaidAmount($paid_amount)
    {

        if (is_null($paid_amount)) {
            throw new \InvalidArgumentException('non-nullable paid_amount cannot be null');
        }

        $this->container['paid_amount'] = $paid_amount;

        return $this;
    }

    /**
     * Gets is_periodization_possible
     *
     * @return bool|null
     */
    public function getIsPeriodizationPossible()
    {
        return $this->container['is_periodization_possible'];
    }

    /**
     * Sets is_periodization_possible
     *
     * @param bool|null $is_periodization_possible is_periodization_possible
     *
     * @return self
     */
    public function setIsPeriodizationPossible($is_periodization_possible)
    {

        if (is_null($is_periodization_possible)) {
            throw new \InvalidArgumentException('non-nullable is_periodization_possible cannot be null');
        }

        $this->container['is_periodization_possible'] = $is_periodization_possible;

        return $this;
    }

    /**
     * Gets ehf_send_status
     *
     * @return string|null
     */
    public function getEhfSendStatus()
    {
        return $this->container['ehf_send_status'];
    }

    /**
     * Sets ehf_send_status
     *
     * @param string|null $ehf_send_status [Deprecated] EHF (Peppol) send status. This only shows status for historic EHFs.
     *
     * @return self
     */
    public function setEhfSendStatus($ehf_send_status)
    {
        $allowedValues = $this->getEhfSendStatusAllowableValues();
        if (!is_null($ehf_send_status) && !in_array($ehf_send_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'ehf_send_status', must be one of '%s'",
                    $ehf_send_status,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($ehf_send_status)) {
            throw new \InvalidArgumentException('non-nullable ehf_send_status cannot be null');
        }

        $this->container['ehf_send_status'] = $ehf_send_status;

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


