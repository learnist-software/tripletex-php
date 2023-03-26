<?php
/**
 * TravelExpense
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
 * TravelExpense Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TravelExpense implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TravelExpense';

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
'project' => '\Learnist\Tripletex\Model\Project',
'employee' => '\Learnist\Tripletex\Model\Employee',
'approved_by' => '\Learnist\Tripletex\Model\Employee',
'completed_by' => '\Learnist\Tripletex\Model\Employee',
'rejected_by' => '\Learnist\Tripletex\Model\Employee',
'department' => '\Learnist\Tripletex\Model\Department',
'payslip' => '\Learnist\Tripletex\Model\Payslip',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'payment_currency' => '\Learnist\Tripletex\Model\Currency',
'travel_details' => '\Learnist\Tripletex\Model\TravelDetails',
'voucher' => '\Learnist\Tripletex\Model\Voucher',
'attachment' => '\Learnist\Tripletex\Model\Document',
'is_completed' => 'bool',
'is_approved' => 'bool',
'rejected_comment' => 'string',
'is_chargeable' => 'bool',
'is_fixed_invoiced_amount' => 'bool',
'is_include_attached_receipts_when_reinvoicing' => 'bool',
'completed_date' => 'string',
'approved_date' => 'string',
'date' => 'string',
'travel_advance' => 'float',
'fixed_invoiced_amount' => 'float',
'amount' => 'float',
'payment_amount' => 'float',
'chargeable_amount' => 'float',
'low_rate_vat' => 'float',
'medium_rate_vat' => 'float',
'high_rate_vat' => 'float',
'payment_amount_currency' => 'float',
'number' => 'int',
'invoice' => '\Learnist\Tripletex\Model\Invoice',
'title' => 'string',
'per_diem_compensations' => '\Learnist\Tripletex\Model\PerDiemCompensation[]',
'mileage_allowances' => '\Learnist\Tripletex\Model\MileageAllowance[]',
'accommodation_allowances' => '\Learnist\Tripletex\Model\AccommodationAllowance[]',
'costs' => '\Learnist\Tripletex\Model\Cost[]',
'attachment_count' => 'int',
'state' => 'string',
'actions' => '\Learnist\Tripletex\Model\Link[]',
'is_salary_admin' => 'bool',
'show_payslip' => 'bool',
'accounting_period_closed' => 'bool',
'accounting_period_vat_closed' => 'bool'    ];

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
'project' => null,
'employee' => null,
'approved_by' => null,
'completed_by' => null,
'rejected_by' => null,
'department' => null,
'payslip' => null,
'vat_type' => null,
'payment_currency' => null,
'travel_details' => null,
'voucher' => null,
'attachment' => null,
'is_completed' => null,
'is_approved' => null,
'rejected_comment' => null,
'is_chargeable' => null,
'is_fixed_invoiced_amount' => null,
'is_include_attached_receipts_when_reinvoicing' => null,
'completed_date' => null,
'approved_date' => null,
'date' => null,
'travel_advance' => null,
'fixed_invoiced_amount' => null,
'amount' => null,
'payment_amount' => null,
'chargeable_amount' => null,
'low_rate_vat' => null,
'medium_rate_vat' => null,
'high_rate_vat' => null,
'payment_amount_currency' => null,
'number' => 'int32',
'invoice' => null,
'title' => null,
'per_diem_compensations' => null,
'mileage_allowances' => null,
'accommodation_allowances' => null,
'costs' => null,
'attachment_count' => 'int32',
'state' => null,
'actions' => null,
'is_salary_admin' => null,
'show_payslip' => null,
'accounting_period_closed' => null,
'accounting_period_vat_closed' => null    ];

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
'project' => 'project',
'employee' => 'employee',
'approved_by' => 'approvedBy',
'completed_by' => 'completedBy',
'rejected_by' => 'rejectedBy',
'department' => 'department',
'payslip' => 'payslip',
'vat_type' => 'vatType',
'payment_currency' => 'paymentCurrency',
'travel_details' => 'travelDetails',
'voucher' => 'voucher',
'attachment' => 'attachment',
'is_completed' => 'isCompleted',
'is_approved' => 'isApproved',
'rejected_comment' => 'rejectedComment',
'is_chargeable' => 'isChargeable',
'is_fixed_invoiced_amount' => 'isFixedInvoicedAmount',
'is_include_attached_receipts_when_reinvoicing' => 'isIncludeAttachedReceiptsWhenReinvoicing',
'completed_date' => 'completedDate',
'approved_date' => 'approvedDate',
'date' => 'date',
'travel_advance' => 'travelAdvance',
'fixed_invoiced_amount' => 'fixedInvoicedAmount',
'amount' => 'amount',
'payment_amount' => 'paymentAmount',
'chargeable_amount' => 'chargeableAmount',
'low_rate_vat' => 'lowRateVAT',
'medium_rate_vat' => 'mediumRateVAT',
'high_rate_vat' => 'highRateVAT',
'payment_amount_currency' => 'paymentAmountCurrency',
'number' => 'number',
'invoice' => 'invoice',
'title' => 'title',
'per_diem_compensations' => 'perDiemCompensations',
'mileage_allowances' => 'mileageAllowances',
'accommodation_allowances' => 'accommodationAllowances',
'costs' => 'costs',
'attachment_count' => 'attachmentCount',
'state' => 'state',
'actions' => 'actions',
'is_salary_admin' => 'isSalaryAdmin',
'show_payslip' => 'showPayslip',
'accounting_period_closed' => 'accountingPeriodClosed',
'accounting_period_vat_closed' => 'accountingPeriodVATClosed'    ];

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
'project' => 'setProject',
'employee' => 'setEmployee',
'approved_by' => 'setApprovedBy',
'completed_by' => 'setCompletedBy',
'rejected_by' => 'setRejectedBy',
'department' => 'setDepartment',
'payslip' => 'setPayslip',
'vat_type' => 'setVatType',
'payment_currency' => 'setPaymentCurrency',
'travel_details' => 'setTravelDetails',
'voucher' => 'setVoucher',
'attachment' => 'setAttachment',
'is_completed' => 'setIsCompleted',
'is_approved' => 'setIsApproved',
'rejected_comment' => 'setRejectedComment',
'is_chargeable' => 'setIsChargeable',
'is_fixed_invoiced_amount' => 'setIsFixedInvoicedAmount',
'is_include_attached_receipts_when_reinvoicing' => 'setIsIncludeAttachedReceiptsWhenReinvoicing',
'completed_date' => 'setCompletedDate',
'approved_date' => 'setApprovedDate',
'date' => 'setDate',
'travel_advance' => 'setTravelAdvance',
'fixed_invoiced_amount' => 'setFixedInvoicedAmount',
'amount' => 'setAmount',
'payment_amount' => 'setPaymentAmount',
'chargeable_amount' => 'setChargeableAmount',
'low_rate_vat' => 'setLowRateVat',
'medium_rate_vat' => 'setMediumRateVat',
'high_rate_vat' => 'setHighRateVat',
'payment_amount_currency' => 'setPaymentAmountCurrency',
'number' => 'setNumber',
'invoice' => 'setInvoice',
'title' => 'setTitle',
'per_diem_compensations' => 'setPerDiemCompensations',
'mileage_allowances' => 'setMileageAllowances',
'accommodation_allowances' => 'setAccommodationAllowances',
'costs' => 'setCosts',
'attachment_count' => 'setAttachmentCount',
'state' => 'setState',
'actions' => 'setActions',
'is_salary_admin' => 'setIsSalaryAdmin',
'show_payslip' => 'setShowPayslip',
'accounting_period_closed' => 'setAccountingPeriodClosed',
'accounting_period_vat_closed' => 'setAccountingPeriodVatClosed'    ];

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
'project' => 'getProject',
'employee' => 'getEmployee',
'approved_by' => 'getApprovedBy',
'completed_by' => 'getCompletedBy',
'rejected_by' => 'getRejectedBy',
'department' => 'getDepartment',
'payslip' => 'getPayslip',
'vat_type' => 'getVatType',
'payment_currency' => 'getPaymentCurrency',
'travel_details' => 'getTravelDetails',
'voucher' => 'getVoucher',
'attachment' => 'getAttachment',
'is_completed' => 'getIsCompleted',
'is_approved' => 'getIsApproved',
'rejected_comment' => 'getRejectedComment',
'is_chargeable' => 'getIsChargeable',
'is_fixed_invoiced_amount' => 'getIsFixedInvoicedAmount',
'is_include_attached_receipts_when_reinvoicing' => 'getIsIncludeAttachedReceiptsWhenReinvoicing',
'completed_date' => 'getCompletedDate',
'approved_date' => 'getApprovedDate',
'date' => 'getDate',
'travel_advance' => 'getTravelAdvance',
'fixed_invoiced_amount' => 'getFixedInvoicedAmount',
'amount' => 'getAmount',
'payment_amount' => 'getPaymentAmount',
'chargeable_amount' => 'getChargeableAmount',
'low_rate_vat' => 'getLowRateVat',
'medium_rate_vat' => 'getMediumRateVat',
'high_rate_vat' => 'getHighRateVat',
'payment_amount_currency' => 'getPaymentAmountCurrency',
'number' => 'getNumber',
'invoice' => 'getInvoice',
'title' => 'getTitle',
'per_diem_compensations' => 'getPerDiemCompensations',
'mileage_allowances' => 'getMileageAllowances',
'accommodation_allowances' => 'getAccommodationAllowances',
'costs' => 'getCosts',
'attachment_count' => 'getAttachmentCount',
'state' => 'getState',
'actions' => 'getActions',
'is_salary_admin' => 'getIsSalaryAdmin',
'show_payslip' => 'getShowPayslip',
'accounting_period_closed' => 'getAccountingPeriodClosed',
'accounting_period_vat_closed' => 'getAccountingPeriodVatClosed'    ];

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

    const STATE_ALL = 'ALL';
const STATE_OPEN = 'OPEN';
const STATE_APPROVED = 'APPROVED';
const STATE_SALARY_PAID = 'SALARY_PAID';
const STATE_DELIVERED = 'DELIVERED';
const STATE_REJECTED = 'REJECTED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStateAllowableValues()
    {
        return [
            self::STATE_ALL,
self::STATE_OPEN,
self::STATE_APPROVED,
self::STATE_SALARY_PAID,
self::STATE_DELIVERED,
self::STATE_REJECTED,        ];
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
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['employee'] = isset($data['employee']) ? $data['employee'] : null;
        $this->container['approved_by'] = isset($data['approved_by']) ? $data['approved_by'] : null;
        $this->container['completed_by'] = isset($data['completed_by']) ? $data['completed_by'] : null;
        $this->container['rejected_by'] = isset($data['rejected_by']) ? $data['rejected_by'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['payslip'] = isset($data['payslip']) ? $data['payslip'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['payment_currency'] = isset($data['payment_currency']) ? $data['payment_currency'] : null;
        $this->container['travel_details'] = isset($data['travel_details']) ? $data['travel_details'] : null;
        $this->container['voucher'] = isset($data['voucher']) ? $data['voucher'] : null;
        $this->container['attachment'] = isset($data['attachment']) ? $data['attachment'] : null;
        $this->container['is_completed'] = isset($data['is_completed']) ? $data['is_completed'] : null;
        $this->container['is_approved'] = isset($data['is_approved']) ? $data['is_approved'] : null;
        $this->container['rejected_comment'] = isset($data['rejected_comment']) ? $data['rejected_comment'] : null;
        $this->container['is_chargeable'] = isset($data['is_chargeable']) ? $data['is_chargeable'] : null;
        $this->container['is_fixed_invoiced_amount'] = isset($data['is_fixed_invoiced_amount']) ? $data['is_fixed_invoiced_amount'] : null;
        $this->container['is_include_attached_receipts_when_reinvoicing'] = isset($data['is_include_attached_receipts_when_reinvoicing']) ? $data['is_include_attached_receipts_when_reinvoicing'] : null;
        $this->container['completed_date'] = isset($data['completed_date']) ? $data['completed_date'] : null;
        $this->container['approved_date'] = isset($data['approved_date']) ? $data['approved_date'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['travel_advance'] = isset($data['travel_advance']) ? $data['travel_advance'] : null;
        $this->container['fixed_invoiced_amount'] = isset($data['fixed_invoiced_amount']) ? $data['fixed_invoiced_amount'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['payment_amount'] = isset($data['payment_amount']) ? $data['payment_amount'] : null;
        $this->container['chargeable_amount'] = isset($data['chargeable_amount']) ? $data['chargeable_amount'] : null;
        $this->container['low_rate_vat'] = isset($data['low_rate_vat']) ? $data['low_rate_vat'] : null;
        $this->container['medium_rate_vat'] = isset($data['medium_rate_vat']) ? $data['medium_rate_vat'] : null;
        $this->container['high_rate_vat'] = isset($data['high_rate_vat']) ? $data['high_rate_vat'] : null;
        $this->container['payment_amount_currency'] = isset($data['payment_amount_currency']) ? $data['payment_amount_currency'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['invoice'] = isset($data['invoice']) ? $data['invoice'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
        $this->container['per_diem_compensations'] = isset($data['per_diem_compensations']) ? $data['per_diem_compensations'] : null;
        $this->container['mileage_allowances'] = isset($data['mileage_allowances']) ? $data['mileage_allowances'] : null;
        $this->container['accommodation_allowances'] = isset($data['accommodation_allowances']) ? $data['accommodation_allowances'] : null;
        $this->container['costs'] = isset($data['costs']) ? $data['costs'] : null;
        $this->container['attachment_count'] = isset($data['attachment_count']) ? $data['attachment_count'] : null;
        $this->container['state'] = isset($data['state']) ? $data['state'] : null;
        $this->container['actions'] = isset($data['actions']) ? $data['actions'] : null;
        $this->container['is_salary_admin'] = isset($data['is_salary_admin']) ? $data['is_salary_admin'] : null;
        $this->container['show_payslip'] = isset($data['show_payslip']) ? $data['show_payslip'] : null;
        $this->container['accounting_period_closed'] = isset($data['accounting_period_closed']) ? $data['accounting_period_closed'] : null;
        $this->container['accounting_period_vat_closed'] = isset($data['accounting_period_vat_closed']) ? $data['accounting_period_vat_closed'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['employee'] === null) {
            $invalidProperties[] = "'employee' can't be null";
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($this->container['state']) && !in_array($this->container['state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'state', must be one of '%s'",
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
     * Gets approved_by
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getApprovedBy()
    {
        return $this->container['approved_by'];
    }

    /**
     * Sets approved_by
     *
     * @param \Learnist\Tripletex\Model\Employee $approved_by approved_by
     *
     * @return $this
     */
    public function setApprovedBy($approved_by)
    {
        $this->container['approved_by'] = $approved_by;

        return $this;
    }

    /**
     * Gets completed_by
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getCompletedBy()
    {
        return $this->container['completed_by'];
    }

    /**
     * Sets completed_by
     *
     * @param \Learnist\Tripletex\Model\Employee $completed_by completed_by
     *
     * @return $this
     */
    public function setCompletedBy($completed_by)
    {
        $this->container['completed_by'] = $completed_by;

        return $this;
    }

    /**
     * Gets rejected_by
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getRejectedBy()
    {
        return $this->container['rejected_by'];
    }

    /**
     * Sets rejected_by
     *
     * @param \Learnist\Tripletex\Model\Employee $rejected_by rejected_by
     *
     * @return $this
     */
    public function setRejectedBy($rejected_by)
    {
        $this->container['rejected_by'] = $rejected_by;

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
     * Gets payslip
     *
     * @return \Learnist\Tripletex\Model\Payslip
     */
    public function getPayslip()
    {
        return $this->container['payslip'];
    }

    /**
     * Sets payslip
     *
     * @param \Learnist\Tripletex\Model\Payslip $payslip payslip
     *
     * @return $this
     */
    public function setPayslip($payslip)
    {
        $this->container['payslip'] = $payslip;

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
     * Gets payment_currency
     *
     * @return \Learnist\Tripletex\Model\Currency
     */
    public function getPaymentCurrency()
    {
        return $this->container['payment_currency'];
    }

    /**
     * Sets payment_currency
     *
     * @param \Learnist\Tripletex\Model\Currency $payment_currency payment_currency
     *
     * @return $this
     */
    public function setPaymentCurrency($payment_currency)
    {
        $this->container['payment_currency'] = $payment_currency;

        return $this;
    }

    /**
     * Gets travel_details
     *
     * @return \Learnist\Tripletex\Model\TravelDetails
     */
    public function getTravelDetails()
    {
        return $this->container['travel_details'];
    }

    /**
     * Sets travel_details
     *
     * @param \Learnist\Tripletex\Model\TravelDetails $travel_details travel_details
     *
     * @return $this
     */
    public function setTravelDetails($travel_details)
    {
        $this->container['travel_details'] = $travel_details;

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
     * Gets attachment
     *
     * @return \Learnist\Tripletex\Model\Document
     */
    public function getAttachment()
    {
        return $this->container['attachment'];
    }

    /**
     * Sets attachment
     *
     * @param \Learnist\Tripletex\Model\Document $attachment attachment
     *
     * @return $this
     */
    public function setAttachment($attachment)
    {
        $this->container['attachment'] = $attachment;

        return $this;
    }

    /**
     * Gets is_completed
     *
     * @return bool
     */
    public function getIsCompleted()
    {
        return $this->container['is_completed'];
    }

    /**
     * Sets is_completed
     *
     * @param bool $is_completed is_completed
     *
     * @return $this
     */
    public function setIsCompleted($is_completed)
    {
        $this->container['is_completed'] = $is_completed;

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
     * Gets rejected_comment
     *
     * @return string
     */
    public function getRejectedComment()
    {
        return $this->container['rejected_comment'];
    }

    /**
     * Sets rejected_comment
     *
     * @param string $rejected_comment rejected_comment
     *
     * @return $this
     */
    public function setRejectedComment($rejected_comment)
    {
        $this->container['rejected_comment'] = $rejected_comment;

        return $this;
    }

    /**
     * Gets is_chargeable
     *
     * @return bool
     */
    public function getIsChargeable()
    {
        return $this->container['is_chargeable'];
    }

    /**
     * Sets is_chargeable
     *
     * @param bool $is_chargeable is_chargeable
     *
     * @return $this
     */
    public function setIsChargeable($is_chargeable)
    {
        $this->container['is_chargeable'] = $is_chargeable;

        return $this;
    }

    /**
     * Gets is_fixed_invoiced_amount
     *
     * @return bool
     */
    public function getIsFixedInvoicedAmount()
    {
        return $this->container['is_fixed_invoiced_amount'];
    }

    /**
     * Sets is_fixed_invoiced_amount
     *
     * @param bool $is_fixed_invoiced_amount is_fixed_invoiced_amount
     *
     * @return $this
     */
    public function setIsFixedInvoicedAmount($is_fixed_invoiced_amount)
    {
        $this->container['is_fixed_invoiced_amount'] = $is_fixed_invoiced_amount;

        return $this;
    }

    /**
     * Gets is_include_attached_receipts_when_reinvoicing
     *
     * @return bool
     */
    public function getIsIncludeAttachedReceiptsWhenReinvoicing()
    {
        return $this->container['is_include_attached_receipts_when_reinvoicing'];
    }

    /**
     * Sets is_include_attached_receipts_when_reinvoicing
     *
     * @param bool $is_include_attached_receipts_when_reinvoicing is_include_attached_receipts_when_reinvoicing
     *
     * @return $this
     */
    public function setIsIncludeAttachedReceiptsWhenReinvoicing($is_include_attached_receipts_when_reinvoicing)
    {
        $this->container['is_include_attached_receipts_when_reinvoicing'] = $is_include_attached_receipts_when_reinvoicing;

        return $this;
    }

    /**
     * Gets completed_date
     *
     * @return string
     */
    public function getCompletedDate()
    {
        return $this->container['completed_date'];
    }

    /**
     * Sets completed_date
     *
     * @param string $completed_date completed_date
     *
     * @return $this
     */
    public function setCompletedDate($completed_date)
    {
        $this->container['completed_date'] = $completed_date;

        return $this;
    }

    /**
     * Gets approved_date
     *
     * @return string
     */
    public function getApprovedDate()
    {
        return $this->container['approved_date'];
    }

    /**
     * Sets approved_date
     *
     * @param string $approved_date approved_date
     *
     * @return $this
     */
    public function setApprovedDate($approved_date)
    {
        $this->container['approved_date'] = $approved_date;

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
     * Gets travel_advance
     *
     * @return float
     */
    public function getTravelAdvance()
    {
        return $this->container['travel_advance'];
    }

    /**
     * Sets travel_advance
     *
     * @param float $travel_advance travel_advance
     *
     * @return $this
     */
    public function setTravelAdvance($travel_advance)
    {
        $this->container['travel_advance'] = $travel_advance;

        return $this;
    }

    /**
     * Gets fixed_invoiced_amount
     *
     * @return float
     */
    public function getFixedInvoicedAmount()
    {
        return $this->container['fixed_invoiced_amount'];
    }

    /**
     * Sets fixed_invoiced_amount
     *
     * @param float $fixed_invoiced_amount fixed_invoiced_amount
     *
     * @return $this
     */
    public function setFixedInvoicedAmount($fixed_invoiced_amount)
    {
        $this->container['fixed_invoiced_amount'] = $fixed_invoiced_amount;

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
     * Gets payment_amount
     *
     * @return float
     */
    public function getPaymentAmount()
    {
        return $this->container['payment_amount'];
    }

    /**
     * Sets payment_amount
     *
     * @param float $payment_amount payment_amount
     *
     * @return $this
     */
    public function setPaymentAmount($payment_amount)
    {
        $this->container['payment_amount'] = $payment_amount;

        return $this;
    }

    /**
     * Gets chargeable_amount
     *
     * @return float
     */
    public function getChargeableAmount()
    {
        return $this->container['chargeable_amount'];
    }

    /**
     * Sets chargeable_amount
     *
     * @param float $chargeable_amount chargeable_amount
     *
     * @return $this
     */
    public function setChargeableAmount($chargeable_amount)
    {
        $this->container['chargeable_amount'] = $chargeable_amount;

        return $this;
    }

    /**
     * Gets low_rate_vat
     *
     * @return float
     */
    public function getLowRateVat()
    {
        return $this->container['low_rate_vat'];
    }

    /**
     * Sets low_rate_vat
     *
     * @param float $low_rate_vat low_rate_vat
     *
     * @return $this
     */
    public function setLowRateVat($low_rate_vat)
    {
        $this->container['low_rate_vat'] = $low_rate_vat;

        return $this;
    }

    /**
     * Gets medium_rate_vat
     *
     * @return float
     */
    public function getMediumRateVat()
    {
        return $this->container['medium_rate_vat'];
    }

    /**
     * Sets medium_rate_vat
     *
     * @param float $medium_rate_vat medium_rate_vat
     *
     * @return $this
     */
    public function setMediumRateVat($medium_rate_vat)
    {
        $this->container['medium_rate_vat'] = $medium_rate_vat;

        return $this;
    }

    /**
     * Gets high_rate_vat
     *
     * @return float
     */
    public function getHighRateVat()
    {
        return $this->container['high_rate_vat'];
    }

    /**
     * Sets high_rate_vat
     *
     * @param float $high_rate_vat high_rate_vat
     *
     * @return $this
     */
    public function setHighRateVat($high_rate_vat)
    {
        $this->container['high_rate_vat'] = $high_rate_vat;

        return $this;
    }

    /**
     * Gets payment_amount_currency
     *
     * @return float
     */
    public function getPaymentAmountCurrency()
    {
        return $this->container['payment_amount_currency'];
    }

    /**
     * Sets payment_amount_currency
     *
     * @param float $payment_amount_currency payment_amount_currency
     *
     * @return $this
     */
    public function setPaymentAmountCurrency($payment_amount_currency)
    {
        $this->container['payment_amount_currency'] = $payment_amount_currency;

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
     * Gets invoice
     *
     * @return \Learnist\Tripletex\Model\Invoice
     */
    public function getInvoice()
    {
        return $this->container['invoice'];
    }

    /**
     * Sets invoice
     *
     * @param \Learnist\Tripletex\Model\Invoice $invoice invoice
     *
     * @return $this
     */
    public function setInvoice($invoice)
    {
        $this->container['invoice'] = $invoice;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets per_diem_compensations
     *
     * @return \Learnist\Tripletex\Model\PerDiemCompensation[]
     */
    public function getPerDiemCompensations()
    {
        return $this->container['per_diem_compensations'];
    }

    /**
     * Sets per_diem_compensations
     *
     * @param \Learnist\Tripletex\Model\PerDiemCompensation[] $per_diem_compensations Link to individual per diem compensations.
     *
     * @return $this
     */
    public function setPerDiemCompensations($per_diem_compensations)
    {
        $this->container['per_diem_compensations'] = $per_diem_compensations;

        return $this;
    }

    /**
     * Gets mileage_allowances
     *
     * @return \Learnist\Tripletex\Model\MileageAllowance[]
     */
    public function getMileageAllowances()
    {
        return $this->container['mileage_allowances'];
    }

    /**
     * Sets mileage_allowances
     *
     * @param \Learnist\Tripletex\Model\MileageAllowance[] $mileage_allowances Link to individual mileage allowances.
     *
     * @return $this
     */
    public function setMileageAllowances($mileage_allowances)
    {
        $this->container['mileage_allowances'] = $mileage_allowances;

        return $this;
    }

    /**
     * Gets accommodation_allowances
     *
     * @return \Learnist\Tripletex\Model\AccommodationAllowance[]
     */
    public function getAccommodationAllowances()
    {
        return $this->container['accommodation_allowances'];
    }

    /**
     * Sets accommodation_allowances
     *
     * @param \Learnist\Tripletex\Model\AccommodationAllowance[] $accommodation_allowances Link to individual accommodation allowances.
     *
     * @return $this
     */
    public function setAccommodationAllowances($accommodation_allowances)
    {
        $this->container['accommodation_allowances'] = $accommodation_allowances;

        return $this;
    }

    /**
     * Gets costs
     *
     * @return \Learnist\Tripletex\Model\Cost[]
     */
    public function getCosts()
    {
        return $this->container['costs'];
    }

    /**
     * Sets costs
     *
     * @param \Learnist\Tripletex\Model\Cost[] $costs Link to individual costs.
     *
     * @return $this
     */
    public function setCosts($costs)
    {
        $this->container['costs'] = $costs;

        return $this;
    }

    /**
     * Gets attachment_count
     *
     * @return int
     */
    public function getAttachmentCount()
    {
        return $this->container['attachment_count'];
    }

    /**
     * Sets attachment_count
     *
     * @param int $attachment_count attachment_count
     *
     * @return $this
     */
    public function setAttachmentCount($attachment_count)
    {
        $this->container['attachment_count'] = $attachment_count;

        return $this;
    }

    /**
     * Gets state
     *
     * @return string
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string $state state
     *
     * @return $this
     */
    public function setState($state)
    {
        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($state) && !in_array($state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'state', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets actions
     *
     * @return \Learnist\Tripletex\Model\Link[]
     */
    public function getActions()
    {
        return $this->container['actions'];
    }

    /**
     * Sets actions
     *
     * @param \Learnist\Tripletex\Model\Link[] $actions actions
     *
     * @return $this
     */
    public function setActions($actions)
    {
        $this->container['actions'] = $actions;

        return $this;
    }

    /**
     * Gets is_salary_admin
     *
     * @return bool
     */
    public function getIsSalaryAdmin()
    {
        return $this->container['is_salary_admin'];
    }

    /**
     * Sets is_salary_admin
     *
     * @param bool $is_salary_admin is_salary_admin
     *
     * @return $this
     */
    public function setIsSalaryAdmin($is_salary_admin)
    {
        $this->container['is_salary_admin'] = $is_salary_admin;

        return $this;
    }

    /**
     * Gets show_payslip
     *
     * @return bool
     */
    public function getShowPayslip()
    {
        return $this->container['show_payslip'];
    }

    /**
     * Sets show_payslip
     *
     * @param bool $show_payslip show_payslip
     *
     * @return $this
     */
    public function setShowPayslip($show_payslip)
    {
        $this->container['show_payslip'] = $show_payslip;

        return $this;
    }

    /**
     * Gets accounting_period_closed
     *
     * @return bool
     */
    public function getAccountingPeriodClosed()
    {
        return $this->container['accounting_period_closed'];
    }

    /**
     * Sets accounting_period_closed
     *
     * @param bool $accounting_period_closed accounting_period_closed
     *
     * @return $this
     */
    public function setAccountingPeriodClosed($accounting_period_closed)
    {
        $this->container['accounting_period_closed'] = $accounting_period_closed;

        return $this;
    }

    /**
     * Gets accounting_period_vat_closed
     *
     * @return bool
     */
    public function getAccountingPeriodVatClosed()
    {
        return $this->container['accounting_period_vat_closed'];
    }

    /**
     * Sets accounting_period_vat_closed
     *
     * @param bool $accounting_period_vat_closed accounting_period_vat_closed
     *
     * @return $this
     */
    public function setAccountingPeriodVatClosed($accounting_period_vat_closed)
    {
        $this->container['accounting_period_vat_closed'] = $accounting_period_vat_closed;

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
