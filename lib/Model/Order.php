<?php
/**
 * Order
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
 * Order Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Order implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Order';

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
'customer' => '\Learnist\Tripletex\Model\Customer',
'contact' => '\Learnist\Tripletex\Model\Contact',
'attn' => '\Learnist\Tripletex\Model\Contact',
'display_name' => 'string',
'receiver_email' => 'string',
'overdue_notice_email' => 'string',
'number' => 'string',
'reference' => 'string',
'our_contact' => '\Learnist\Tripletex\Model\Contact',
'our_contact_employee' => '\Learnist\Tripletex\Model\Employee',
'department' => '\Learnist\Tripletex\Model\Department',
'order_date' => 'string',
'project' => '\Learnist\Tripletex\Model\Project',
'invoice_comment' => 'string',
'currency' => '\Learnist\Tripletex\Model\Currency',
'invoices_due_in' => 'int',
'invoices_due_in_type' => 'string',
'is_show_open_posts_on_invoices' => 'bool',
'is_closed' => 'bool',
'delivery_date' => 'string',
'delivery_address' => '\Learnist\Tripletex\Model\DeliveryAddress',
'delivery_comment' => 'string',
'is_prioritize_amounts_including_vat' => 'bool',
'order_line_sorting' => 'string',
'order_lines' => '\Learnist\Tripletex\Model\OrderLine[]',
'is_subscription' => 'bool',
'subscription_duration' => 'int',
'subscription_duration_type' => 'string',
'subscription_periods_on_invoice' => 'int',
'subscription_periods_on_invoice_type' => 'string',
'subscription_invoicing_time_in_advance_or_arrears' => 'string',
'subscription_invoicing_time' => 'int',
'subscription_invoicing_time_type' => 'string',
'is_subscription_auto_invoicing' => 'bool',
'preliminary_invoice' => '\Learnist\Tripletex\Model\Invoice',
'attachment' => '\Learnist\Tripletex\Model\Document[]',
'send_method_description' => 'string',
'can_create_backorder' => 'bool',
'invoice_on_account_vat_high' => 'bool',
'total_invoiced_on_account_amount_absolute_currency' => 'float',
'invoice_send_sms_notification' => 'bool',
'invoice_sms_notification_number' => 'string'    ];

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
'customer' => null,
'contact' => null,
'attn' => null,
'display_name' => null,
'receiver_email' => null,
'overdue_notice_email' => 'email',
'number' => null,
'reference' => null,
'our_contact' => null,
'our_contact_employee' => null,
'department' => null,
'order_date' => null,
'project' => null,
'invoice_comment' => null,
'currency' => null,
'invoices_due_in' => 'int32',
'invoices_due_in_type' => null,
'is_show_open_posts_on_invoices' => null,
'is_closed' => null,
'delivery_date' => null,
'delivery_address' => null,
'delivery_comment' => null,
'is_prioritize_amounts_including_vat' => null,
'order_line_sorting' => null,
'order_lines' => null,
'is_subscription' => null,
'subscription_duration' => 'int32',
'subscription_duration_type' => null,
'subscription_periods_on_invoice' => 'int32',
'subscription_periods_on_invoice_type' => null,
'subscription_invoicing_time_in_advance_or_arrears' => null,
'subscription_invoicing_time' => 'int32',
'subscription_invoicing_time_type' => null,
'is_subscription_auto_invoicing' => null,
'preliminary_invoice' => null,
'attachment' => null,
'send_method_description' => null,
'can_create_backorder' => null,
'invoice_on_account_vat_high' => null,
'total_invoiced_on_account_amount_absolute_currency' => null,
'invoice_send_sms_notification' => null,
'invoice_sms_notification_number' => null    ];

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
'customer' => 'customer',
'contact' => 'contact',
'attn' => 'attn',
'display_name' => 'displayName',
'receiver_email' => 'receiverEmail',
'overdue_notice_email' => 'overdueNoticeEmail',
'number' => 'number',
'reference' => 'reference',
'our_contact' => 'ourContact',
'our_contact_employee' => 'ourContactEmployee',
'department' => 'department',
'order_date' => 'orderDate',
'project' => 'project',
'invoice_comment' => 'invoiceComment',
'currency' => 'currency',
'invoices_due_in' => 'invoicesDueIn',
'invoices_due_in_type' => 'invoicesDueInType',
'is_show_open_posts_on_invoices' => 'isShowOpenPostsOnInvoices',
'is_closed' => 'isClosed',
'delivery_date' => 'deliveryDate',
'delivery_address' => 'deliveryAddress',
'delivery_comment' => 'deliveryComment',
'is_prioritize_amounts_including_vat' => 'isPrioritizeAmountsIncludingVat',
'order_line_sorting' => 'orderLineSorting',
'order_lines' => 'orderLines',
'is_subscription' => 'isSubscription',
'subscription_duration' => 'subscriptionDuration',
'subscription_duration_type' => 'subscriptionDurationType',
'subscription_periods_on_invoice' => 'subscriptionPeriodsOnInvoice',
'subscription_periods_on_invoice_type' => 'subscriptionPeriodsOnInvoiceType',
'subscription_invoicing_time_in_advance_or_arrears' => 'subscriptionInvoicingTimeInAdvanceOrArrears',
'subscription_invoicing_time' => 'subscriptionInvoicingTime',
'subscription_invoicing_time_type' => 'subscriptionInvoicingTimeType',
'is_subscription_auto_invoicing' => 'isSubscriptionAutoInvoicing',
'preliminary_invoice' => 'preliminaryInvoice',
'attachment' => 'attachment',
'send_method_description' => 'sendMethodDescription',
'can_create_backorder' => 'canCreateBackorder',
'invoice_on_account_vat_high' => 'invoiceOnAccountVatHigh',
'total_invoiced_on_account_amount_absolute_currency' => 'totalInvoicedOnAccountAmountAbsoluteCurrency',
'invoice_send_sms_notification' => 'invoiceSendSMSNotification',
'invoice_sms_notification_number' => 'invoiceSMSNotificationNumber'    ];

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
'customer' => 'setCustomer',
'contact' => 'setContact',
'attn' => 'setAttn',
'display_name' => 'setDisplayName',
'receiver_email' => 'setReceiverEmail',
'overdue_notice_email' => 'setOverdueNoticeEmail',
'number' => 'setNumber',
'reference' => 'setReference',
'our_contact' => 'setOurContact',
'our_contact_employee' => 'setOurContactEmployee',
'department' => 'setDepartment',
'order_date' => 'setOrderDate',
'project' => 'setProject',
'invoice_comment' => 'setInvoiceComment',
'currency' => 'setCurrency',
'invoices_due_in' => 'setInvoicesDueIn',
'invoices_due_in_type' => 'setInvoicesDueInType',
'is_show_open_posts_on_invoices' => 'setIsShowOpenPostsOnInvoices',
'is_closed' => 'setIsClosed',
'delivery_date' => 'setDeliveryDate',
'delivery_address' => 'setDeliveryAddress',
'delivery_comment' => 'setDeliveryComment',
'is_prioritize_amounts_including_vat' => 'setIsPrioritizeAmountsIncludingVat',
'order_line_sorting' => 'setOrderLineSorting',
'order_lines' => 'setOrderLines',
'is_subscription' => 'setIsSubscription',
'subscription_duration' => 'setSubscriptionDuration',
'subscription_duration_type' => 'setSubscriptionDurationType',
'subscription_periods_on_invoice' => 'setSubscriptionPeriodsOnInvoice',
'subscription_periods_on_invoice_type' => 'setSubscriptionPeriodsOnInvoiceType',
'subscription_invoicing_time_in_advance_or_arrears' => 'setSubscriptionInvoicingTimeInAdvanceOrArrears',
'subscription_invoicing_time' => 'setSubscriptionInvoicingTime',
'subscription_invoicing_time_type' => 'setSubscriptionInvoicingTimeType',
'is_subscription_auto_invoicing' => 'setIsSubscriptionAutoInvoicing',
'preliminary_invoice' => 'setPreliminaryInvoice',
'attachment' => 'setAttachment',
'send_method_description' => 'setSendMethodDescription',
'can_create_backorder' => 'setCanCreateBackorder',
'invoice_on_account_vat_high' => 'setInvoiceOnAccountVatHigh',
'total_invoiced_on_account_amount_absolute_currency' => 'setTotalInvoicedOnAccountAmountAbsoluteCurrency',
'invoice_send_sms_notification' => 'setInvoiceSendSmsNotification',
'invoice_sms_notification_number' => 'setInvoiceSmsNotificationNumber'    ];

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
'customer' => 'getCustomer',
'contact' => 'getContact',
'attn' => 'getAttn',
'display_name' => 'getDisplayName',
'receiver_email' => 'getReceiverEmail',
'overdue_notice_email' => 'getOverdueNoticeEmail',
'number' => 'getNumber',
'reference' => 'getReference',
'our_contact' => 'getOurContact',
'our_contact_employee' => 'getOurContactEmployee',
'department' => 'getDepartment',
'order_date' => 'getOrderDate',
'project' => 'getProject',
'invoice_comment' => 'getInvoiceComment',
'currency' => 'getCurrency',
'invoices_due_in' => 'getInvoicesDueIn',
'invoices_due_in_type' => 'getInvoicesDueInType',
'is_show_open_posts_on_invoices' => 'getIsShowOpenPostsOnInvoices',
'is_closed' => 'getIsClosed',
'delivery_date' => 'getDeliveryDate',
'delivery_address' => 'getDeliveryAddress',
'delivery_comment' => 'getDeliveryComment',
'is_prioritize_amounts_including_vat' => 'getIsPrioritizeAmountsIncludingVat',
'order_line_sorting' => 'getOrderLineSorting',
'order_lines' => 'getOrderLines',
'is_subscription' => 'getIsSubscription',
'subscription_duration' => 'getSubscriptionDuration',
'subscription_duration_type' => 'getSubscriptionDurationType',
'subscription_periods_on_invoice' => 'getSubscriptionPeriodsOnInvoice',
'subscription_periods_on_invoice_type' => 'getSubscriptionPeriodsOnInvoiceType',
'subscription_invoicing_time_in_advance_or_arrears' => 'getSubscriptionInvoicingTimeInAdvanceOrArrears',
'subscription_invoicing_time' => 'getSubscriptionInvoicingTime',
'subscription_invoicing_time_type' => 'getSubscriptionInvoicingTimeType',
'is_subscription_auto_invoicing' => 'getIsSubscriptionAutoInvoicing',
'preliminary_invoice' => 'getPreliminaryInvoice',
'attachment' => 'getAttachment',
'send_method_description' => 'getSendMethodDescription',
'can_create_backorder' => 'getCanCreateBackorder',
'invoice_on_account_vat_high' => 'getInvoiceOnAccountVatHigh',
'total_invoiced_on_account_amount_absolute_currency' => 'getTotalInvoicedOnAccountAmountAbsoluteCurrency',
'invoice_send_sms_notification' => 'getInvoiceSendSmsNotification',
'invoice_sms_notification_number' => 'getInvoiceSmsNotificationNumber'    ];

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

    const INVOICES_DUE_IN_TYPE_DAYS = 'DAYS';
const INVOICES_DUE_IN_TYPE_MONTHS = 'MONTHS';
const INVOICES_DUE_IN_TYPE_RECURRING_DAY_OF_MONTH = 'RECURRING_DAY_OF_MONTH';
const ORDER_LINE_SORTING_ID = 'ID';
const ORDER_LINE_SORTING_PRODUCT = 'PRODUCT';
const ORDER_LINE_SORTING_CUSTOM = 'CUSTOM';
const SUBSCRIPTION_DURATION_TYPE_MONTHS = 'MONTHS';
const SUBSCRIPTION_DURATION_TYPE_YEAR = 'YEAR';
const SUBSCRIPTION_PERIODS_ON_INVOICE_TYPE_MONTHS = 'MONTHS';
const SUBSCRIPTION_INVOICING_TIME_IN_ADVANCE_OR_ARREARS_ADVANCE = 'ADVANCE';
const SUBSCRIPTION_INVOICING_TIME_IN_ADVANCE_OR_ARREARS_ARREARS = 'ARREARS';
const SUBSCRIPTION_INVOICING_TIME_TYPE_DAYS = 'DAYS';
const SUBSCRIPTION_INVOICING_TIME_TYPE_MONTHS = 'MONTHS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoicesDueInTypeAllowableValues()
    {
        return [
            self::INVOICES_DUE_IN_TYPE_DAYS,
self::INVOICES_DUE_IN_TYPE_MONTHS,
self::INVOICES_DUE_IN_TYPE_RECURRING_DAY_OF_MONTH,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOrderLineSortingAllowableValues()
    {
        return [
            self::ORDER_LINE_SORTING_ID,
self::ORDER_LINE_SORTING_PRODUCT,
self::ORDER_LINE_SORTING_CUSTOM,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSubscriptionDurationTypeAllowableValues()
    {
        return [
            self::SUBSCRIPTION_DURATION_TYPE_MONTHS,
self::SUBSCRIPTION_DURATION_TYPE_YEAR,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSubscriptionPeriodsOnInvoiceTypeAllowableValues()
    {
        return [
            self::SUBSCRIPTION_PERIODS_ON_INVOICE_TYPE_MONTHS,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSubscriptionInvoicingTimeInAdvanceOrArrearsAllowableValues()
    {
        return [
            self::SUBSCRIPTION_INVOICING_TIME_IN_ADVANCE_OR_ARREARS_ADVANCE,
self::SUBSCRIPTION_INVOICING_TIME_IN_ADVANCE_OR_ARREARS_ARREARS,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSubscriptionInvoicingTimeTypeAllowableValues()
    {
        return [
            self::SUBSCRIPTION_INVOICING_TIME_TYPE_DAYS,
self::SUBSCRIPTION_INVOICING_TIME_TYPE_MONTHS,        ];
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
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['contact'] = isset($data['contact']) ? $data['contact'] : null;
        $this->container['attn'] = isset($data['attn']) ? $data['attn'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['receiver_email'] = isset($data['receiver_email']) ? $data['receiver_email'] : null;
        $this->container['overdue_notice_email'] = isset($data['overdue_notice_email']) ? $data['overdue_notice_email'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['reference'] = isset($data['reference']) ? $data['reference'] : null;
        $this->container['our_contact'] = isset($data['our_contact']) ? $data['our_contact'] : null;
        $this->container['our_contact_employee'] = isset($data['our_contact_employee']) ? $data['our_contact_employee'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['order_date'] = isset($data['order_date']) ? $data['order_date'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['invoice_comment'] = isset($data['invoice_comment']) ? $data['invoice_comment'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['invoices_due_in'] = isset($data['invoices_due_in']) ? $data['invoices_due_in'] : null;
        $this->container['invoices_due_in_type'] = isset($data['invoices_due_in_type']) ? $data['invoices_due_in_type'] : null;
        $this->container['is_show_open_posts_on_invoices'] = isset($data['is_show_open_posts_on_invoices']) ? $data['is_show_open_posts_on_invoices'] : null;
        $this->container['is_closed'] = isset($data['is_closed']) ? $data['is_closed'] : null;
        $this->container['delivery_date'] = isset($data['delivery_date']) ? $data['delivery_date'] : null;
        $this->container['delivery_address'] = isset($data['delivery_address']) ? $data['delivery_address'] : null;
        $this->container['delivery_comment'] = isset($data['delivery_comment']) ? $data['delivery_comment'] : null;
        $this->container['is_prioritize_amounts_including_vat'] = isset($data['is_prioritize_amounts_including_vat']) ? $data['is_prioritize_amounts_including_vat'] : null;
        $this->container['order_line_sorting'] = isset($data['order_line_sorting']) ? $data['order_line_sorting'] : null;
        $this->container['order_lines'] = isset($data['order_lines']) ? $data['order_lines'] : null;
        $this->container['is_subscription'] = isset($data['is_subscription']) ? $data['is_subscription'] : null;
        $this->container['subscription_duration'] = isset($data['subscription_duration']) ? $data['subscription_duration'] : null;
        $this->container['subscription_duration_type'] = isset($data['subscription_duration_type']) ? $data['subscription_duration_type'] : null;
        $this->container['subscription_periods_on_invoice'] = isset($data['subscription_periods_on_invoice']) ? $data['subscription_periods_on_invoice'] : null;
        $this->container['subscription_periods_on_invoice_type'] = isset($data['subscription_periods_on_invoice_type']) ? $data['subscription_periods_on_invoice_type'] : null;
        $this->container['subscription_invoicing_time_in_advance_or_arrears'] = isset($data['subscription_invoicing_time_in_advance_or_arrears']) ? $data['subscription_invoicing_time_in_advance_or_arrears'] : null;
        $this->container['subscription_invoicing_time'] = isset($data['subscription_invoicing_time']) ? $data['subscription_invoicing_time'] : null;
        $this->container['subscription_invoicing_time_type'] = isset($data['subscription_invoicing_time_type']) ? $data['subscription_invoicing_time_type'] : null;
        $this->container['is_subscription_auto_invoicing'] = isset($data['is_subscription_auto_invoicing']) ? $data['is_subscription_auto_invoicing'] : null;
        $this->container['preliminary_invoice'] = isset($data['preliminary_invoice']) ? $data['preliminary_invoice'] : null;
        $this->container['attachment'] = isset($data['attachment']) ? $data['attachment'] : null;
        $this->container['send_method_description'] = isset($data['send_method_description']) ? $data['send_method_description'] : null;
        $this->container['can_create_backorder'] = isset($data['can_create_backorder']) ? $data['can_create_backorder'] : null;
        $this->container['invoice_on_account_vat_high'] = isset($data['invoice_on_account_vat_high']) ? $data['invoice_on_account_vat_high'] : null;
        $this->container['total_invoiced_on_account_amount_absolute_currency'] = isset($data['total_invoiced_on_account_amount_absolute_currency']) ? $data['total_invoiced_on_account_amount_absolute_currency'] : null;
        $this->container['invoice_send_sms_notification'] = isset($data['invoice_send_sms_notification']) ? $data['invoice_send_sms_notification'] : null;
        $this->container['invoice_sms_notification_number'] = isset($data['invoice_sms_notification_number']) ? $data['invoice_sms_notification_number'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['customer'] === null) {
            $invalidProperties[] = "'customer' can't be null";
        }
        if ($this->container['order_date'] === null) {
            $invalidProperties[] = "'order_date' can't be null";
        }
        $allowedValues = $this->getInvoicesDueInTypeAllowableValues();
        if (!is_null($this->container['invoices_due_in_type']) && !in_array($this->container['invoices_due_in_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoices_due_in_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['delivery_date'] === null) {
            $invalidProperties[] = "'delivery_date' can't be null";
        }
        $allowedValues = $this->getOrderLineSortingAllowableValues();
        if (!is_null($this->container['order_line_sorting']) && !in_array($this->container['order_line_sorting'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'order_line_sorting', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSubscriptionDurationTypeAllowableValues();
        if (!is_null($this->container['subscription_duration_type']) && !in_array($this->container['subscription_duration_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'subscription_duration_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSubscriptionPeriodsOnInvoiceTypeAllowableValues();
        if (!is_null($this->container['subscription_periods_on_invoice_type']) && !in_array($this->container['subscription_periods_on_invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'subscription_periods_on_invoice_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSubscriptionInvoicingTimeInAdvanceOrArrearsAllowableValues();
        if (!is_null($this->container['subscription_invoicing_time_in_advance_or_arrears']) && !in_array($this->container['subscription_invoicing_time_in_advance_or_arrears'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'subscription_invoicing_time_in_advance_or_arrears', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSubscriptionInvoicingTimeTypeAllowableValues();
        if (!is_null($this->container['subscription_invoicing_time_type']) && !in_array($this->container['subscription_invoicing_time_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'subscription_invoicing_time_type', must be one of '%s'",
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
     * Gets contact
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \Learnist\Tripletex\Model\Contact $contact contact
     *
     * @return $this
     */
    public function setContact($contact)
    {
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets attn
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getAttn()
    {
        return $this->container['attn'];
    }

    /**
     * Sets attn
     *
     * @param \Learnist\Tripletex\Model\Contact $attn attn
     *
     * @return $this
     */
    public function setAttn($attn)
    {
        $this->container['attn'] = $attn;

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
     * Gets receiver_email
     *
     * @return string
     */
    public function getReceiverEmail()
    {
        return $this->container['receiver_email'];
    }

    /**
     * Sets receiver_email
     *
     * @param string $receiver_email receiver_email
     *
     * @return $this
     */
    public function setReceiverEmail($receiver_email)
    {
        $this->container['receiver_email'] = $receiver_email;

        return $this;
    }

    /**
     * Gets overdue_notice_email
     *
     * @return string
     */
    public function getOverdueNoticeEmail()
    {
        return $this->container['overdue_notice_email'];
    }

    /**
     * Sets overdue_notice_email
     *
     * @param string $overdue_notice_email overdue_notice_email
     *
     * @return $this
     */
    public function setOverdueNoticeEmail($overdue_notice_email)
    {
        $this->container['overdue_notice_email'] = $overdue_notice_email;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string $number number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->container['reference'];
    }

    /**
     * Sets reference
     *
     * @param string $reference reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->container['reference'] = $reference;

        return $this;
    }

    /**
     * Gets our_contact
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getOurContact()
    {
        return $this->container['our_contact'];
    }

    /**
     * Sets our_contact
     *
     * @param \Learnist\Tripletex\Model\Contact $our_contact our_contact
     *
     * @return $this
     */
    public function setOurContact($our_contact)
    {
        $this->container['our_contact'] = $our_contact;

        return $this;
    }

    /**
     * Gets our_contact_employee
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getOurContactEmployee()
    {
        return $this->container['our_contact_employee'];
    }

    /**
     * Sets our_contact_employee
     *
     * @param \Learnist\Tripletex\Model\Employee $our_contact_employee our_contact_employee
     *
     * @return $this
     */
    public function setOurContactEmployee($our_contact_employee)
    {
        $this->container['our_contact_employee'] = $our_contact_employee;

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
     * Gets order_date
     *
     * @return string
     */
    public function getOrderDate()
    {
        return $this->container['order_date'];
    }

    /**
     * Sets order_date
     *
     * @param string $order_date order_date
     *
     * @return $this
     */
    public function setOrderDate($order_date)
    {
        $this->container['order_date'] = $order_date;

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
     * @param string $invoice_comment Comment to be displayed in the invoice based on this order. Can be also found in Invoice.invoiceComment on Invoice objects.
     *
     * @return $this
     */
    public function setInvoiceComment($invoice_comment)
    {
        $this->container['invoice_comment'] = $invoice_comment;

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
     * Gets invoices_due_in
     *
     * @return int
     */
    public function getInvoicesDueIn()
    {
        return $this->container['invoices_due_in'];
    }

    /**
     * Sets invoices_due_in
     *
     * @param int $invoices_due_in Number of days/months in which invoices created from this order is due
     *
     * @return $this
     */
    public function setInvoicesDueIn($invoices_due_in)
    {
        $this->container['invoices_due_in'] = $invoices_due_in;

        return $this;
    }

    /**
     * Gets invoices_due_in_type
     *
     * @return string
     */
    public function getInvoicesDueInType()
    {
        return $this->container['invoices_due_in_type'];
    }

    /**
     * Sets invoices_due_in_type
     *
     * @param string $invoices_due_in_type Set the time unit of invoicesDueIn. The special case RECURRING_DAY_OF_MONTH enables the due date to be fixed to a specific day of the month, in this case the fixed due date will automatically be set as standard on all invoices created from this order. Note that when RECURRING_DAY_OF_MONTH is set, the due date will be set to the last day of month if \"31\" is set in invoicesDueIn.
     *
     * @return $this
     */
    public function setInvoicesDueInType($invoices_due_in_type)
    {
        $allowedValues = $this->getInvoicesDueInTypeAllowableValues();
        if (!is_null($invoices_due_in_type) && !in_array($invoices_due_in_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoices_due_in_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoices_due_in_type'] = $invoices_due_in_type;

        return $this;
    }

    /**
     * Gets is_show_open_posts_on_invoices
     *
     * @return bool
     */
    public function getIsShowOpenPostsOnInvoices()
    {
        return $this->container['is_show_open_posts_on_invoices'];
    }

    /**
     * Sets is_show_open_posts_on_invoices
     *
     * @param bool $is_show_open_posts_on_invoices Show account statement - open posts on invoices created from this order
     *
     * @return $this
     */
    public function setIsShowOpenPostsOnInvoices($is_show_open_posts_on_invoices)
    {
        $this->container['is_show_open_posts_on_invoices'] = $is_show_open_posts_on_invoices;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool $is_closed Denotes if this order is closed. A closed order can no longer be invoiced unless it is opened again.
     *
     * @return $this
     */
    public function setIsClosed($is_closed)
    {
        $this->container['is_closed'] = $is_closed;

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
     * @param string $delivery_date delivery_date
     *
     * @return $this
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->container['delivery_date'] = $delivery_date;

        return $this;
    }

    /**
     * Gets delivery_address
     *
     * @return \Learnist\Tripletex\Model\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->container['delivery_address'];
    }

    /**
     * Sets delivery_address
     *
     * @param \Learnist\Tripletex\Model\DeliveryAddress $delivery_address delivery_address
     *
     * @return $this
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->container['delivery_address'] = $delivery_address;

        return $this;
    }

    /**
     * Gets delivery_comment
     *
     * @return string
     */
    public function getDeliveryComment()
    {
        return $this->container['delivery_comment'];
    }

    /**
     * Sets delivery_comment
     *
     * @param string $delivery_comment delivery_comment
     *
     * @return $this
     */
    public function setDeliveryComment($delivery_comment)
    {
        $this->container['delivery_comment'] = $delivery_comment;

        return $this;
    }

    /**
     * Gets is_prioritize_amounts_including_vat
     *
     * @return bool
     */
    public function getIsPrioritizeAmountsIncludingVat()
    {
        return $this->container['is_prioritize_amounts_including_vat'];
    }

    /**
     * Sets is_prioritize_amounts_including_vat
     *
     * @param bool $is_prioritize_amounts_including_vat is_prioritize_amounts_including_vat
     *
     * @return $this
     */
    public function setIsPrioritizeAmountsIncludingVat($is_prioritize_amounts_including_vat)
    {
        $this->container['is_prioritize_amounts_including_vat'] = $is_prioritize_amounts_including_vat;

        return $this;
    }

    /**
     * Gets order_line_sorting
     *
     * @return string
     */
    public function getOrderLineSorting()
    {
        return $this->container['order_line_sorting'];
    }

    /**
     * Sets order_line_sorting
     *
     * @param string $order_line_sorting order_line_sorting
     *
     * @return $this
     */
    public function setOrderLineSorting($order_line_sorting)
    {
        $allowedValues = $this->getOrderLineSortingAllowableValues();
        if (!is_null($order_line_sorting) && !in_array($order_line_sorting, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'order_line_sorting', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['order_line_sorting'] = $order_line_sorting;

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
     * @param \Learnist\Tripletex\Model\OrderLine[] $order_lines Order lines tied to the order. New OrderLines may be embedded here, in some endpoints.
     *
     * @return $this
     */
    public function setOrderLines($order_lines)
    {
        $this->container['order_lines'] = $order_lines;

        return $this;
    }

    /**
     * Gets is_subscription
     *
     * @return bool
     */
    public function getIsSubscription()
    {
        return $this->container['is_subscription'];
    }

    /**
     * Sets is_subscription
     *
     * @param bool $is_subscription If true, the order is a subscription, which enables periodical invoicing of order lines. First, create an order with isSubscription=true, then approve it for subscription invoicing with the :approveSubscriptionInvoice method.
     *
     * @return $this
     */
    public function setIsSubscription($is_subscription)
    {
        $this->container['is_subscription'] = $is_subscription;

        return $this;
    }

    /**
     * Gets subscription_duration
     *
     * @return int
     */
    public function getSubscriptionDuration()
    {
        return $this->container['subscription_duration'];
    }

    /**
     * Sets subscription_duration
     *
     * @param int $subscription_duration Number of months/years the subscription shall run
     *
     * @return $this
     */
    public function setSubscriptionDuration($subscription_duration)
    {
        $this->container['subscription_duration'] = $subscription_duration;

        return $this;
    }

    /**
     * Gets subscription_duration_type
     *
     * @return string
     */
    public function getSubscriptionDurationType()
    {
        return $this->container['subscription_duration_type'];
    }

    /**
     * Sets subscription_duration_type
     *
     * @param string $subscription_duration_type The time unit of subscriptionDuration
     *
     * @return $this
     */
    public function setSubscriptionDurationType($subscription_duration_type)
    {
        $allowedValues = $this->getSubscriptionDurationTypeAllowableValues();
        if (!is_null($subscription_duration_type) && !in_array($subscription_duration_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'subscription_duration_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['subscription_duration_type'] = $subscription_duration_type;

        return $this;
    }

    /**
     * Gets subscription_periods_on_invoice
     *
     * @return int
     */
    public function getSubscriptionPeriodsOnInvoice()
    {
        return $this->container['subscription_periods_on_invoice'];
    }

    /**
     * Sets subscription_periods_on_invoice
     *
     * @param int $subscription_periods_on_invoice Number of periods on each invoice
     *
     * @return $this
     */
    public function setSubscriptionPeriodsOnInvoice($subscription_periods_on_invoice)
    {
        $this->container['subscription_periods_on_invoice'] = $subscription_periods_on_invoice;

        return $this;
    }

    /**
     * Gets subscription_periods_on_invoice_type
     *
     * @return string
     */
    public function getSubscriptionPeriodsOnInvoiceType()
    {
        return $this->container['subscription_periods_on_invoice_type'];
    }

    /**
     * Sets subscription_periods_on_invoice_type
     *
     * @param string $subscription_periods_on_invoice_type The time unit of subscriptionPeriodsOnInvoice
     *
     * @return $this
     */
    public function setSubscriptionPeriodsOnInvoiceType($subscription_periods_on_invoice_type)
    {
        $allowedValues = $this->getSubscriptionPeriodsOnInvoiceTypeAllowableValues();
        if (!is_null($subscription_periods_on_invoice_type) && !in_array($subscription_periods_on_invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'subscription_periods_on_invoice_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['subscription_periods_on_invoice_type'] = $subscription_periods_on_invoice_type;

        return $this;
    }

    /**
     * Gets subscription_invoicing_time_in_advance_or_arrears
     *
     * @return string
     */
    public function getSubscriptionInvoicingTimeInAdvanceOrArrears()
    {
        return $this->container['subscription_invoicing_time_in_advance_or_arrears'];
    }

    /**
     * Sets subscription_invoicing_time_in_advance_or_arrears
     *
     * @param string $subscription_invoicing_time_in_advance_or_arrears Invoicing in advance/in arrears
     *
     * @return $this
     */
    public function setSubscriptionInvoicingTimeInAdvanceOrArrears($subscription_invoicing_time_in_advance_or_arrears)
    {
        $allowedValues = $this->getSubscriptionInvoicingTimeInAdvanceOrArrearsAllowableValues();
        if (!is_null($subscription_invoicing_time_in_advance_or_arrears) && !in_array($subscription_invoicing_time_in_advance_or_arrears, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'subscription_invoicing_time_in_advance_or_arrears', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['subscription_invoicing_time_in_advance_or_arrears'] = $subscription_invoicing_time_in_advance_or_arrears;

        return $this;
    }

    /**
     * Gets subscription_invoicing_time
     *
     * @return int
     */
    public function getSubscriptionInvoicingTime()
    {
        return $this->container['subscription_invoicing_time'];
    }

    /**
     * Sets subscription_invoicing_time
     *
     * @param int $subscription_invoicing_time Number of days/months invoicing in advance/in arrears
     *
     * @return $this
     */
    public function setSubscriptionInvoicingTime($subscription_invoicing_time)
    {
        $this->container['subscription_invoicing_time'] = $subscription_invoicing_time;

        return $this;
    }

    /**
     * Gets subscription_invoicing_time_type
     *
     * @return string
     */
    public function getSubscriptionInvoicingTimeType()
    {
        return $this->container['subscription_invoicing_time_type'];
    }

    /**
     * Sets subscription_invoicing_time_type
     *
     * @param string $subscription_invoicing_time_type The time unit of subscriptionInvoicingTime
     *
     * @return $this
     */
    public function setSubscriptionInvoicingTimeType($subscription_invoicing_time_type)
    {
        $allowedValues = $this->getSubscriptionInvoicingTimeTypeAllowableValues();
        if (!is_null($subscription_invoicing_time_type) && !in_array($subscription_invoicing_time_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'subscription_invoicing_time_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['subscription_invoicing_time_type'] = $subscription_invoicing_time_type;

        return $this;
    }

    /**
     * Gets is_subscription_auto_invoicing
     *
     * @return bool
     */
    public function getIsSubscriptionAutoInvoicing()
    {
        return $this->container['is_subscription_auto_invoicing'];
    }

    /**
     * Sets is_subscription_auto_invoicing
     *
     * @param bool $is_subscription_auto_invoicing Automatic invoicing. Starts when the subscription is approved
     *
     * @return $this
     */
    public function setIsSubscriptionAutoInvoicing($is_subscription_auto_invoicing)
    {
        $this->container['is_subscription_auto_invoicing'] = $is_subscription_auto_invoicing;

        return $this;
    }

    /**
     * Gets preliminary_invoice
     *
     * @return \Learnist\Tripletex\Model\Invoice
     */
    public function getPreliminaryInvoice()
    {
        return $this->container['preliminary_invoice'];
    }

    /**
     * Sets preliminary_invoice
     *
     * @param \Learnist\Tripletex\Model\Invoice $preliminary_invoice preliminary_invoice
     *
     * @return $this
     */
    public function setPreliminaryInvoice($preliminary_invoice)
    {
        $this->container['preliminary_invoice'] = $preliminary_invoice;

        return $this;
    }

    /**
     * Gets attachment
     *
     * @return \Learnist\Tripletex\Model\Document[]
     */
    public function getAttachment()
    {
        return $this->container['attachment'];
    }

    /**
     * Sets attachment
     *
     * @param \Learnist\Tripletex\Model\Document[] $attachment [BETA] Attachments belonging to this order
     *
     * @return $this
     */
    public function setAttachment($attachment)
    {
        $this->container['attachment'] = $attachment;

        return $this;
    }

    /**
     * Gets send_method_description
     *
     * @return string
     */
    public function getSendMethodDescription()
    {
        return $this->container['send_method_description'];
    }

    /**
     * Sets send_method_description
     *
     * @param string $send_method_description Description of how this invoice will be sent
     *
     * @return $this
     */
    public function setSendMethodDescription($send_method_description)
    {
        $this->container['send_method_description'] = $send_method_description;

        return $this;
    }

    /**
     * Gets can_create_backorder
     *
     * @return bool
     */
    public function getCanCreateBackorder()
    {
        return $this->container['can_create_backorder'];
    }

    /**
     * Sets can_create_backorder
     *
     * @param bool $can_create_backorder can_create_backorder
     *
     * @return $this
     */
    public function setCanCreateBackorder($can_create_backorder)
    {
        $this->container['can_create_backorder'] = $can_create_backorder;

        return $this;
    }

    /**
     * Gets invoice_on_account_vat_high
     *
     * @return bool
     */
    public function getInvoiceOnAccountVatHigh()
    {
        return $this->container['invoice_on_account_vat_high'];
    }

    /**
     * Sets invoice_on_account_vat_high
     *
     * @param bool $invoice_on_account_vat_high Is the on account(a konto) amounts including vat
     *
     * @return $this
     */
    public function setInvoiceOnAccountVatHigh($invoice_on_account_vat_high)
    {
        $this->container['invoice_on_account_vat_high'] = $invoice_on_account_vat_high;

        return $this;
    }

    /**
     * Gets total_invoiced_on_account_amount_absolute_currency
     *
     * @return float
     */
    public function getTotalInvoicedOnAccountAmountAbsoluteCurrency()
    {
        return $this->container['total_invoiced_on_account_amount_absolute_currency'];
    }

    /**
     * Sets total_invoiced_on_account_amount_absolute_currency
     *
     * @param float $total_invoiced_on_account_amount_absolute_currency Amount paid on account(a konto)
     *
     * @return $this
     */
    public function setTotalInvoicedOnAccountAmountAbsoluteCurrency($total_invoiced_on_account_amount_absolute_currency)
    {
        $this->container['total_invoiced_on_account_amount_absolute_currency'] = $total_invoiced_on_account_amount_absolute_currency;

        return $this;
    }

    /**
     * Gets invoice_send_sms_notification
     *
     * @return bool
     */
    public function getInvoiceSendSmsNotification()
    {
        return $this->container['invoice_send_sms_notification'];
    }

    /**
     * Sets invoice_send_sms_notification
     *
     * @param bool $invoice_send_sms_notification Is sms-notification on/off
     *
     * @return $this
     */
    public function setInvoiceSendSmsNotification($invoice_send_sms_notification)
    {
        $this->container['invoice_send_sms_notification'] = $invoice_send_sms_notification;

        return $this;
    }

    /**
     * Gets invoice_sms_notification_number
     *
     * @return string
     */
    public function getInvoiceSmsNotificationNumber()
    {
        return $this->container['invoice_sms_notification_number'];
    }

    /**
     * Sets invoice_sms_notification_number
     *
     * @param string $invoice_sms_notification_number The phone number of the receiver of sms notifications
     *
     * @return $this
     */
    public function setInvoiceSmsNotificationNumber($invoice_sms_notification_number)
    {
        $this->container['invoice_sms_notification_number'] = $invoice_sms_notification_number;

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
