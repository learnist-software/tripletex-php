<?php
/**
 * Invoice
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
 * Invoice Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Invoice implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Invoice';

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
'ehf_send_status' => 'string'    ];

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
'ehf_send_status' => null    ];

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
'ehf_send_status' => 'ehfSendStatus'    ];

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
'ehf_send_status' => 'setEhfSendStatus'    ];

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
'ehf_send_status' => 'getEhfSendStatus'    ];

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

    const EHF_SEND_STATUS_DO_NOT_SEND = 'DO_NOT_SEND';
const EHF_SEND_STATUS_SEND = 'SEND';
const EHF_SEND_STATUS_SENT = 'SENT';
const EHF_SEND_STATUS_SEND_FAILURE_RECIPIENT_NOT_FOUND = 'SEND_FAILURE_RECIPIENT_NOT_FOUND';

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
self::EHF_SEND_STATUS_SEND_FAILURE_RECIPIENT_NOT_FOUND,        ];
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
        $this->container['invoice_number'] = isset($data['invoice_number']) ? $data['invoice_number'] : null;
        $this->container['invoice_date'] = isset($data['invoice_date']) ? $data['invoice_date'] : null;
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['credited_invoice'] = isset($data['credited_invoice']) ? $data['credited_invoice'] : null;
        $this->container['is_credited'] = isset($data['is_credited']) ? $data['is_credited'] : null;
        $this->container['invoice_due_date'] = isset($data['invoice_due_date']) ? $data['invoice_due_date'] : null;
        $this->container['kid'] = isset($data['kid']) ? $data['kid'] : null;
        $this->container['invoice_comment'] = isset($data['invoice_comment']) ? $data['invoice_comment'] : null;
        $this->container['comment'] = isset($data['comment']) ? $data['comment'] : null;
        $this->container['orders'] = isset($data['orders']) ? $data['orders'] : null;
        $this->container['order_lines'] = isset($data['order_lines']) ? $data['order_lines'] : null;
        $this->container['travel_reports'] = isset($data['travel_reports']) ? $data['travel_reports'] : null;
        $this->container['project_invoice_details'] = isset($data['project_invoice_details']) ? $data['project_invoice_details'] : null;
        $this->container['voucher'] = isset($data['voucher']) ? $data['voucher'] : null;
        $this->container['delivery_date'] = isset($data['delivery_date']) ? $data['delivery_date'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['amount_currency'] = isset($data['amount_currency']) ? $data['amount_currency'] : null;
        $this->container['amount_excluding_vat'] = isset($data['amount_excluding_vat']) ? $data['amount_excluding_vat'] : null;
        $this->container['amount_excluding_vat_currency'] = isset($data['amount_excluding_vat_currency']) ? $data['amount_excluding_vat_currency'] : null;
        $this->container['amount_roundoff'] = isset($data['amount_roundoff']) ? $data['amount_roundoff'] : null;
        $this->container['amount_roundoff_currency'] = isset($data['amount_roundoff_currency']) ? $data['amount_roundoff_currency'] : null;
        $this->container['amount_outstanding'] = isset($data['amount_outstanding']) ? $data['amount_outstanding'] : null;
        $this->container['amount_currency_outstanding'] = isset($data['amount_currency_outstanding']) ? $data['amount_currency_outstanding'] : null;
        $this->container['amount_outstanding_total'] = isset($data['amount_outstanding_total']) ? $data['amount_outstanding_total'] : null;
        $this->container['amount_currency_outstanding_total'] = isset($data['amount_currency_outstanding_total']) ? $data['amount_currency_outstanding_total'] : null;
        $this->container['sum_remits'] = isset($data['sum_remits']) ? $data['sum_remits'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['is_credit_note'] = isset($data['is_credit_note']) ? $data['is_credit_note'] : null;
        $this->container['is_charged'] = isset($data['is_charged']) ? $data['is_charged'] : null;
        $this->container['is_approved'] = isset($data['is_approved']) ? $data['is_approved'] : null;
        $this->container['postings'] = isset($data['postings']) ? $data['postings'] : null;
        $this->container['reminders'] = isset($data['reminders']) ? $data['reminders'] : null;
        $this->container['invoice_remarks'] = isset($data['invoice_remarks']) ? $data['invoice_remarks'] : null;
        $this->container['invoice_remark'] = isset($data['invoice_remark']) ? $data['invoice_remark'] : null;
        $this->container['payment_type_id'] = isset($data['payment_type_id']) ? $data['payment_type_id'] : null;
        $this->container['paid_amount'] = isset($data['paid_amount']) ? $data['paid_amount'] : null;
        $this->container['is_periodization_possible'] = isset($data['is_periodization_possible']) ? $data['is_periodization_possible'] : null;
        $this->container['ehf_send_status'] = isset($data['ehf_send_status']) ? $data['ehf_send_status'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['invoice_date'] === null) {
            $invalidProperties[] = "'invoice_date' can't be null";
        }
        if ($this->container['invoice_due_date'] === null) {
            $invalidProperties[] = "'invoice_due_date' can't be null";
        }
        if ($this->container['orders'] === null) {
            $invalidProperties[] = "'orders' can't be null";
        }
        $allowedValues = $this->getEhfSendStatusAllowableValues();
        if (!is_null($this->container['ehf_send_status']) && !in_array($this->container['ehf_send_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'ehf_send_status', must be one of '%s'",
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
     * Gets invoice_number
     *
     * @return int
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param int $invoice_number If value is set to 0, the invoice number will be generated.
     *
     * @return $this
     */
    public function setInvoiceNumber($invoice_number)
    {
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
     * @return $this
     */
    public function setInvoiceDate($invoice_date)
    {
        $this->container['invoice_date'] = $invoice_date;

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
     * Gets credited_invoice
     *
     * @return int
     */
    public function getCreditedInvoice()
    {
        return $this->container['credited_invoice'];
    }

    /**
     * Sets credited_invoice
     *
     * @param int $credited_invoice The id of the original invoice if this is a credit note.
     *
     * @return $this
     */
    public function setCreditedInvoice($credited_invoice)
    {
        $this->container['credited_invoice'] = $credited_invoice;

        return $this;
    }

    /**
     * Gets is_credited
     *
     * @return bool
     */
    public function getIsCredited()
    {
        return $this->container['is_credited'];
    }

    /**
     * Sets is_credited
     *
     * @param bool $is_credited is_credited
     *
     * @return $this
     */
    public function setIsCredited($is_credited)
    {
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
     * @return $this
     */
    public function setInvoiceDueDate($invoice_due_date)
    {
        $this->container['invoice_due_date'] = $invoice_due_date;

        return $this;
    }

    /**
     * Gets kid
     *
     * @return string
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string $kid KID - Kundeidentifikasjonsnummer.
     *
     * @return $this
     */
    public function setKid($kid)
    {
        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets invoice_comment
     *
     * @return string
     */
    public function getInvoiceComment()
    {
        return $this->container['invoice_comment'];
    }

    /**
     * Sets invoice_comment
     *
     * @param string $invoice_comment Comment text for the invoice. This was specified on the order as invoiceComment.
     *
     * @return $this
     */
    public function setInvoiceComment($invoice_comment)
    {
        $this->container['invoice_comment'] = $invoice_comment;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string $comment Comment text for the specific invoice.
     *
     * @return $this
     */
    public function setComment($comment)
    {
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
     * @return $this
     */
    public function setOrders($orders)
    {
        $this->container['orders'] = $orders;

        return $this;
    }

    /**
     * Gets order_lines
     *
     * @return \Learnist\Tripletex\Model\OrderLine[]
     */
    public function getOrderLines()
    {
        return $this->container['order_lines'];
    }

    /**
     * Sets order_lines
     *
     * @param \Learnist\Tripletex\Model\OrderLine[] $order_lines Orderlines connected to the invoice.
     *
     * @return $this
     */
    public function setOrderLines($order_lines)
    {
        $this->container['order_lines'] = $order_lines;

        return $this;
    }

    /**
     * Gets travel_reports
     *
     * @return \Learnist\Tripletex\Model\TravelExpense[]
     */
    public function getTravelReports()
    {
        return $this->container['travel_reports'];
    }

    /**
     * Sets travel_reports
     *
     * @param \Learnist\Tripletex\Model\TravelExpense[] $travel_reports Travel reports connected to the invoice.
     *
     * @return $this
     */
    public function setTravelReports($travel_reports)
    {
        $this->container['travel_reports'] = $travel_reports;

        return $this;
    }

    /**
     * Gets project_invoice_details
     *
     * @return \Learnist\Tripletex\Model\ProjectInvoiceDetails[]
     */
    public function getProjectInvoiceDetails()
    {
        return $this->container['project_invoice_details'];
    }

    /**
     * Sets project_invoice_details
     *
     * @param \Learnist\Tripletex\Model\ProjectInvoiceDetails[] $project_invoice_details ProjectInvoiceDetails contains additional information about the invoice, in particular invoices for projects. It contains information about the charged project, the fee amount, extra percent and amount, extra costs, travel expenses, invoice and project comments, akonto amount and values determining if extra costs, akonto and hours should be included. ProjectInvoiceDetails is an object which represents the relation between an invoice and a Project, Orderline and OrderOut object.
     *
     * @return $this
     */
    public function setProjectInvoiceDetails($project_invoice_details)
    {
        $this->container['project_invoice_details'] = $project_invoice_details;

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
     * Gets delivery_date
     *
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->container['delivery_date'];
    }

    /**
     * Sets delivery_date
     *
     * @param string $delivery_date The delivery date.
     *
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->container['delivery_date'] = $delivery_date;

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
     * @param float $amount In the company’s currency, typically NOK.
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
     * @param float $amount_currency In the specified currency.
     *
     * @return $this
     */
    public function setAmountCurrency($amount_currency)
    {
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets amount_excluding_vat
     *
     * @return float
     */
    public function getAmountExcludingVat()
    {
        return $this->container['amount_excluding_vat'];
    }

    /**
     * Sets amount_excluding_vat
     *
     * @param float $amount_excluding_vat Amount excluding VAT (NOK).
     *
     * @return $this
     */
    public function setAmountExcludingVat($amount_excluding_vat)
    {
        $this->container['amount_excluding_vat'] = $amount_excluding_vat;

        return $this;
    }

    /**
     * Gets amount_excluding_vat_currency
     *
     * @return float
     */
    public function getAmountExcludingVatCurrency()
    {
        return $this->container['amount_excluding_vat_currency'];
    }

    /**
     * Sets amount_excluding_vat_currency
     *
     * @param float $amount_excluding_vat_currency Amount excluding VAT in the specified currency.
     *
     * @return $this
     */
    public function setAmountExcludingVatCurrency($amount_excluding_vat_currency)
    {
        $this->container['amount_excluding_vat_currency'] = $amount_excluding_vat_currency;

        return $this;
    }

    /**
     * Gets amount_roundoff
     *
     * @return float
     */
    public function getAmountRoundoff()
    {
        return $this->container['amount_roundoff'];
    }

    /**
     * Sets amount_roundoff
     *
     * @param float $amount_roundoff Amount of round off to nearest integer.
     *
     * @return $this
     */
    public function setAmountRoundoff($amount_roundoff)
    {
        $this->container['amount_roundoff'] = $amount_roundoff;

        return $this;
    }

    /**
     * Gets amount_roundoff_currency
     *
     * @return float
     */
    public function getAmountRoundoffCurrency()
    {
        return $this->container['amount_roundoff_currency'];
    }

    /**
     * Sets amount_roundoff_currency
     *
     * @param float $amount_roundoff_currency Amount of round off to nearest integer in the specified currency.
     *
     * @return $this
     */
    public function setAmountRoundoffCurrency($amount_roundoff_currency)
    {
        $this->container['amount_roundoff_currency'] = $amount_roundoff_currency;

        return $this;
    }

    /**
     * Gets amount_outstanding
     *
     * @return float
     */
    public function getAmountOutstanding()
    {
        return $this->container['amount_outstanding'];
    }

    /**
     * Sets amount_outstanding
     *
     * @param float $amount_outstanding The amount outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountOutstanding($amount_outstanding)
    {
        $this->container['amount_outstanding'] = $amount_outstanding;

        return $this;
    }

    /**
     * Gets amount_currency_outstanding
     *
     * @return float
     */
    public function getAmountCurrencyOutstanding()
    {
        return $this->container['amount_currency_outstanding'];
    }

    /**
     * Sets amount_currency_outstanding
     *
     * @param float $amount_currency_outstanding The amountCurrency outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountCurrencyOutstanding($amount_currency_outstanding)
    {
        $this->container['amount_currency_outstanding'] = $amount_currency_outstanding;

        return $this;
    }

    /**
     * Gets amount_outstanding_total
     *
     * @return float
     */
    public function getAmountOutstandingTotal()
    {
        return $this->container['amount_outstanding_total'];
    }

    /**
     * Sets amount_outstanding_total
     *
     * @param float $amount_outstanding_total The amount outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountOutstandingTotal($amount_outstanding_total)
    {
        $this->container['amount_outstanding_total'] = $amount_outstanding_total;

        return $this;
    }

    /**
     * Gets amount_currency_outstanding_total
     *
     * @return float
     */
    public function getAmountCurrencyOutstandingTotal()
    {
        return $this->container['amount_currency_outstanding_total'];
    }

    /**
     * Sets amount_currency_outstanding_total
     *
     * @param float $amount_currency_outstanding_total The amountCurrency outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency.
     *
     * @return $this
     */
    public function setAmountCurrencyOutstandingTotal($amount_currency_outstanding_total)
    {
        $this->container['amount_currency_outstanding_total'] = $amount_currency_outstanding_total;

        return $this;
    }

    /**
     * Gets sum_remits
     *
     * @return float
     */
    public function getSumRemits()
    {
        return $this->container['sum_remits'];
    }

    /**
     * Sets sum_remits
     *
     * @param float $sum_remits The sum of all open remittances of the invoice. Remittances are reimbursement payments back to the customer and are therefore relevant to the bookkeeping of the invoice in the accounts.
     *
     * @return $this
     */
    public function setSumRemits($sum_remits)
    {
        $this->container['sum_remits'] = $sum_remits;

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
     * Gets is_credit_note
     *
     * @return bool
     */
    public function getIsCreditNote()
    {
        return $this->container['is_credit_note'];
    }

    /**
     * Sets is_credit_note
     *
     * @param bool $is_credit_note is_credit_note
     *
     * @return $this
     */
    public function setIsCreditNote($is_credit_note)
    {
        $this->container['is_credit_note'] = $is_credit_note;

        return $this;
    }

    /**
     * Gets is_charged
     *
     * @return bool
     */
    public function getIsCharged()
    {
        return $this->container['is_charged'];
    }

    /**
     * Sets is_charged
     *
     * @param bool $is_charged is_charged
     *
     * @return $this
     */
    public function setIsCharged($is_charged)
    {
        $this->container['is_charged'] = $is_charged;

        return $this;
    }

    /**
     * Gets is_approved
     *
     * @return bool
     */
    public function getIsApproved()
    {
        return $this->container['is_approved'];
    }

    /**
     * Sets is_approved
     *
     * @param bool $is_approved is_approved
     *
     * @return $this
     */
    public function setIsApproved($is_approved)
    {
        $this->container['is_approved'] = $is_approved;

        return $this;
    }

    /**
     * Gets postings
     *
     * @return \Learnist\Tripletex\Model\Posting[]
     */
    public function getPostings()
    {
        return $this->container['postings'];
    }

    /**
     * Sets postings
     *
     * @param \Learnist\Tripletex\Model\Posting[] $postings The invoice postings, which includes a posting for the invoice with a positive amount, and one or more posting for the payments with negative amounts.
     *
     * @return $this
     */
    public function setPostings($postings)
    {
        $this->container['postings'] = $postings;

        return $this;
    }

    /**
     * Gets reminders
     *
     * @return \Learnist\Tripletex\Model\Reminder[]
     */
    public function getReminders()
    {
        return $this->container['reminders'];
    }

    /**
     * Sets reminders
     *
     * @param \Learnist\Tripletex\Model\Reminder[] $reminders Invoice debt collection and reminders.
     *
     * @return $this
     */
    public function setReminders($reminders)
    {
        $this->container['reminders'] = $reminders;

        return $this;
    }

    /**
     * Gets invoice_remarks
     *
     * @return string
     */
    public function getInvoiceRemarks()
    {
        return $this->container['invoice_remarks'];
    }

    /**
     * Sets invoice_remarks
     *
     * @param string $invoice_remarks Deprecated Invoice remarks - please use the 'invoiceRemark' instead.
     *
     * @return $this
     */
    public function setInvoiceRemarks($invoice_remarks)
    {
        $this->container['invoice_remarks'] = $invoice_remarks;

        return $this;
    }

    /**
     * Gets invoice_remark
     *
     * @return \Learnist\Tripletex\Model\InvoiceRemark
     */
    public function getInvoiceRemark()
    {
        return $this->container['invoice_remark'];
    }

    /**
     * Sets invoice_remark
     *
     * @param \Learnist\Tripletex\Model\InvoiceRemark $invoice_remark invoice_remark
     *
     * @return $this
     */
    public function setInvoiceRemark($invoice_remark)
    {
        $this->container['invoice_remark'] = $invoice_remark;

        return $this;
    }

    /**
     * Gets payment_type_id
     *
     * @return int
     */
    public function getPaymentTypeId()
    {
        return $this->container['payment_type_id'];
    }

    /**
     * Sets payment_type_id
     *
     * @param int $payment_type_id [BETA] Optional. Used to specify payment type for prepaid invoices. Payment type can be specified here, or as a parameter to the /invoice API endpoint.
     *
     * @return $this
     */
    public function setPaymentTypeId($payment_type_id)
    {
        $this->container['payment_type_id'] = $payment_type_id;

        return $this;
    }

    /**
     * Gets paid_amount
     *
     * @return float
     */
    public function getPaidAmount()
    {
        return $this->container['paid_amount'];
    }

    /**
     * Sets paid_amount
     *
     * @param float $paid_amount [BETA] Optional. Used to specify the prepaid amount of the invoice. The paid amount can be specified here, or as a parameter to the /invoice API endpoint.
     *
     * @return $this
     */
    public function setPaidAmount($paid_amount)
    {
        $this->container['paid_amount'] = $paid_amount;

        return $this;
    }

    /**
     * Gets is_periodization_possible
     *
     * @return bool
     */
    public function getIsPeriodizationPossible()
    {
        return $this->container['is_periodization_possible'];
    }

    /**
     * Sets is_periodization_possible
     *
     * @param bool $is_periodization_possible is_periodization_possible
     *
     * @return $this
     */
    public function setIsPeriodizationPossible($is_periodization_possible)
    {
        $this->container['is_periodization_possible'] = $is_periodization_possible;

        return $this;
    }

    /**
     * Gets ehf_send_status
     *
     * @return string
     */
    public function getEhfSendStatus()
    {
        return $this->container['ehf_send_status'];
    }

    /**
     * Sets ehf_send_status
     *
     * @param string $ehf_send_status [Deprecated] EHF (Peppol) send status. This only shows status for historic EHFs.
     *
     * @return $this
     */
    public function setEhfSendStatus($ehf_send_status)
    {
        $allowedValues = $this->getEhfSendStatusAllowableValues();
        if (!is_null($ehf_send_status) && !in_array($ehf_send_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'ehf_send_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
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
