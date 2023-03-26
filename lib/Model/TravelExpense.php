<?php
/**
 * TravelExpense
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
 * TravelExpense Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TravelExpense implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TravelExpense';

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
        'accounting_period_vat_closed' => 'bool'
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
        'accounting_period_vat_closed' => null
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
		'project' => false,
		'employee' => false,
		'approved_by' => false,
		'completed_by' => false,
		'rejected_by' => false,
		'department' => false,
		'payslip' => false,
		'vat_type' => false,
		'payment_currency' => false,
		'travel_details' => false,
		'voucher' => false,
		'attachment' => false,
		'is_completed' => false,
		'is_approved' => false,
		'rejected_comment' => false,
		'is_chargeable' => false,
		'is_fixed_invoiced_amount' => false,
		'is_include_attached_receipts_when_reinvoicing' => false,
		'completed_date' => false,
		'approved_date' => false,
		'date' => false,
		'travel_advance' => false,
		'fixed_invoiced_amount' => false,
		'amount' => false,
		'payment_amount' => false,
		'chargeable_amount' => false,
		'low_rate_vat' => false,
		'medium_rate_vat' => false,
		'high_rate_vat' => false,
		'payment_amount_currency' => false,
		'number' => false,
		'invoice' => false,
		'title' => false,
		'per_diem_compensations' => false,
		'mileage_allowances' => false,
		'accommodation_allowances' => false,
		'costs' => false,
		'attachment_count' => false,
		'state' => false,
		'actions' => false,
		'is_salary_admin' => false,
		'show_payslip' => false,
		'accounting_period_closed' => false,
		'accounting_period_vat_closed' => false
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
        'accounting_period_vat_closed' => 'accountingPeriodVATClosed'
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
        'accounting_period_vat_closed' => 'setAccountingPeriodVatClosed'
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
        'accounting_period_vat_closed' => 'getAccountingPeriodVatClosed'
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

    public const STATE_ALL = 'ALL';
    public const STATE_OPEN = 'OPEN';
    public const STATE_APPROVED = 'APPROVED';
    public const STATE_SALARY_PAID = 'SALARY_PAID';
    public const STATE_DELIVERED = 'DELIVERED';
    public const STATE_REJECTED = 'REJECTED';

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
            self::STATE_REJECTED,
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
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('employee', $data ?? [], null);
        $this->setIfExists('approved_by', $data ?? [], null);
        $this->setIfExists('completed_by', $data ?? [], null);
        $this->setIfExists('rejected_by', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('payslip', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('payment_currency', $data ?? [], null);
        $this->setIfExists('travel_details', $data ?? [], null);
        $this->setIfExists('voucher', $data ?? [], null);
        $this->setIfExists('attachment', $data ?? [], null);
        $this->setIfExists('is_completed', $data ?? [], null);
        $this->setIfExists('is_approved', $data ?? [], null);
        $this->setIfExists('rejected_comment', $data ?? [], null);
        $this->setIfExists('is_chargeable', $data ?? [], null);
        $this->setIfExists('is_fixed_invoiced_amount', $data ?? [], null);
        $this->setIfExists('is_include_attached_receipts_when_reinvoicing', $data ?? [], null);
        $this->setIfExists('completed_date', $data ?? [], null);
        $this->setIfExists('approved_date', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('travel_advance', $data ?? [], null);
        $this->setIfExists('fixed_invoiced_amount', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('payment_amount', $data ?? [], null);
        $this->setIfExists('chargeable_amount', $data ?? [], null);
        $this->setIfExists('low_rate_vat', $data ?? [], null);
        $this->setIfExists('medium_rate_vat', $data ?? [], null);
        $this->setIfExists('high_rate_vat', $data ?? [], null);
        $this->setIfExists('payment_amount_currency', $data ?? [], null);
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('invoice', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('per_diem_compensations', $data ?? [], null);
        $this->setIfExists('mileage_allowances', $data ?? [], null);
        $this->setIfExists('accommodation_allowances', $data ?? [], null);
        $this->setIfExists('costs', $data ?? [], null);
        $this->setIfExists('attachment_count', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], null);
        $this->setIfExists('actions', $data ?? [], null);
        $this->setIfExists('is_salary_admin', $data ?? [], null);
        $this->setIfExists('show_payslip', $data ?? [], null);
        $this->setIfExists('accounting_period_closed', $data ?? [], null);
        $this->setIfExists('accounting_period_vat_closed', $data ?? [], null);
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

        if ($this->container['employee'] === null) {
            $invalidProperties[] = "'employee' can't be null";
        }
        if (!is_null($this->container['title']) && (mb_strlen($this->container['title']) > 255)) {
            $invalidProperties[] = "invalid value for 'title', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['attachment_count']) && ($this->container['attachment_count'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'attachment_count', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['attachment_count']) && ($this->container['attachment_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'attachment_count', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($this->container['state']) && !in_array($this->container['state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'state', must be one of '%s'",
                $this->container['state'],
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
     * Gets approved_by
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getApprovedBy()
    {
        return $this->container['approved_by'];
    }

    /**
     * Sets approved_by
     *
     * @param \Learnist\Tripletex\Model\Employee|null $approved_by approved_by
     *
     * @return self
     */
    public function setApprovedBy($approved_by)
    {
        if (is_null($approved_by)) {
            throw new \InvalidArgumentException('non-nullable approved_by cannot be null');
        }
        $this->container['approved_by'] = $approved_by;

        return $this;
    }

    /**
     * Gets completed_by
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getCompletedBy()
    {
        return $this->container['completed_by'];
    }

    /**
     * Sets completed_by
     *
     * @param \Learnist\Tripletex\Model\Employee|null $completed_by completed_by
     *
     * @return self
     */
    public function setCompletedBy($completed_by)
    {
        if (is_null($completed_by)) {
            throw new \InvalidArgumentException('non-nullable completed_by cannot be null');
        }
        $this->container['completed_by'] = $completed_by;

        return $this;
    }

    /**
     * Gets rejected_by
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getRejectedBy()
    {
        return $this->container['rejected_by'];
    }

    /**
     * Sets rejected_by
     *
     * @param \Learnist\Tripletex\Model\Employee|null $rejected_by rejected_by
     *
     * @return self
     */
    public function setRejectedBy($rejected_by)
    {
        if (is_null($rejected_by)) {
            throw new \InvalidArgumentException('non-nullable rejected_by cannot be null');
        }
        $this->container['rejected_by'] = $rejected_by;

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
     * Gets payslip
     *
     * @return \Learnist\Tripletex\Model\Payslip|null
     */
    public function getPayslip()
    {
        return $this->container['payslip'];
    }

    /**
     * Sets payslip
     *
     * @param \Learnist\Tripletex\Model\Payslip|null $payslip payslip
     *
     * @return self
     */
    public function setPayslip($payslip)
    {
        if (is_null($payslip)) {
            throw new \InvalidArgumentException('non-nullable payslip cannot be null');
        }
        $this->container['payslip'] = $payslip;

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
     * Gets payment_currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getPaymentCurrency()
    {
        return $this->container['payment_currency'];
    }

    /**
     * Sets payment_currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $payment_currency payment_currency
     *
     * @return self
     */
    public function setPaymentCurrency($payment_currency)
    {
        if (is_null($payment_currency)) {
            throw new \InvalidArgumentException('non-nullable payment_currency cannot be null');
        }
        $this->container['payment_currency'] = $payment_currency;

        return $this;
    }

    /**
     * Gets travel_details
     *
     * @return \Learnist\Tripletex\Model\TravelDetails|null
     */
    public function getTravelDetails()
    {
        return $this->container['travel_details'];
    }

    /**
     * Sets travel_details
     *
     * @param \Learnist\Tripletex\Model\TravelDetails|null $travel_details travel_details
     *
     * @return self
     */
    public function setTravelDetails($travel_details)
    {
        if (is_null($travel_details)) {
            throw new \InvalidArgumentException('non-nullable travel_details cannot be null');
        }
        $this->container['travel_details'] = $travel_details;

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
     * Gets attachment
     *
     * @return \Learnist\Tripletex\Model\Document|null
     */
    public function getAttachment()
    {
        return $this->container['attachment'];
    }

    /**
     * Sets attachment
     *
     * @param \Learnist\Tripletex\Model\Document|null $attachment attachment
     *
     * @return self
     */
    public function setAttachment($attachment)
    {
        if (is_null($attachment)) {
            throw new \InvalidArgumentException('non-nullable attachment cannot be null');
        }
        $this->container['attachment'] = $attachment;

        return $this;
    }

    /**
     * Gets is_completed
     *
     * @return bool|null
     */
    public function getIsCompleted()
    {
        return $this->container['is_completed'];
    }

    /**
     * Sets is_completed
     *
     * @param bool|null $is_completed is_completed
     *
     * @return self
     */
    public function setIsCompleted($is_completed)
    {
        if (is_null($is_completed)) {
            throw new \InvalidArgumentException('non-nullable is_completed cannot be null');
        }
        $this->container['is_completed'] = $is_completed;

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
     * Gets rejected_comment
     *
     * @return string|null
     */
    public function getRejectedComment()
    {
        return $this->container['rejected_comment'];
    }

    /**
     * Sets rejected_comment
     *
     * @param string|null $rejected_comment rejected_comment
     *
     * @return self
     */
    public function setRejectedComment($rejected_comment)
    {
        if (is_null($rejected_comment)) {
            throw new \InvalidArgumentException('non-nullable rejected_comment cannot be null');
        }
        $this->container['rejected_comment'] = $rejected_comment;

        return $this;
    }

    /**
     * Gets is_chargeable
     *
     * @return bool|null
     */
    public function getIsChargeable()
    {
        return $this->container['is_chargeable'];
    }

    /**
     * Sets is_chargeable
     *
     * @param bool|null $is_chargeable is_chargeable
     *
     * @return self
     */
    public function setIsChargeable($is_chargeable)
    {
        if (is_null($is_chargeable)) {
            throw new \InvalidArgumentException('non-nullable is_chargeable cannot be null');
        }
        $this->container['is_chargeable'] = $is_chargeable;

        return $this;
    }

    /**
     * Gets is_fixed_invoiced_amount
     *
     * @return bool|null
     */
    public function getIsFixedInvoicedAmount()
    {
        return $this->container['is_fixed_invoiced_amount'];
    }

    /**
     * Sets is_fixed_invoiced_amount
     *
     * @param bool|null $is_fixed_invoiced_amount is_fixed_invoiced_amount
     *
     * @return self
     */
    public function setIsFixedInvoicedAmount($is_fixed_invoiced_amount)
    {
        if (is_null($is_fixed_invoiced_amount)) {
            throw new \InvalidArgumentException('non-nullable is_fixed_invoiced_amount cannot be null');
        }
        $this->container['is_fixed_invoiced_amount'] = $is_fixed_invoiced_amount;

        return $this;
    }

    /**
     * Gets is_include_attached_receipts_when_reinvoicing
     *
     * @return bool|null
     */
    public function getIsIncludeAttachedReceiptsWhenReinvoicing()
    {
        return $this->container['is_include_attached_receipts_when_reinvoicing'];
    }

    /**
     * Sets is_include_attached_receipts_when_reinvoicing
     *
     * @param bool|null $is_include_attached_receipts_when_reinvoicing is_include_attached_receipts_when_reinvoicing
     *
     * @return self
     */
    public function setIsIncludeAttachedReceiptsWhenReinvoicing($is_include_attached_receipts_when_reinvoicing)
    {
        if (is_null($is_include_attached_receipts_when_reinvoicing)) {
            throw new \InvalidArgumentException('non-nullable is_include_attached_receipts_when_reinvoicing cannot be null');
        }
        $this->container['is_include_attached_receipts_when_reinvoicing'] = $is_include_attached_receipts_when_reinvoicing;

        return $this;
    }

    /**
     * Gets completed_date
     *
     * @return string|null
     */
    public function getCompletedDate()
    {
        return $this->container['completed_date'];
    }

    /**
     * Sets completed_date
     *
     * @param string|null $completed_date completed_date
     *
     * @return self
     */
    public function setCompletedDate($completed_date)
    {
        if (is_null($completed_date)) {
            throw new \InvalidArgumentException('non-nullable completed_date cannot be null');
        }
        $this->container['completed_date'] = $completed_date;

        return $this;
    }

    /**
     * Gets approved_date
     *
     * @return string|null
     */
    public function getApprovedDate()
    {
        return $this->container['approved_date'];
    }

    /**
     * Sets approved_date
     *
     * @param string|null $approved_date approved_date
     *
     * @return self
     */
    public function setApprovedDate($approved_date)
    {
        if (is_null($approved_date)) {
            throw new \InvalidArgumentException('non-nullable approved_date cannot be null');
        }
        $this->container['approved_date'] = $approved_date;

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
     * Gets travel_advance
     *
     * @return float|null
     */
    public function getTravelAdvance()
    {
        return $this->container['travel_advance'];
    }

    /**
     * Sets travel_advance
     *
     * @param float|null $travel_advance travel_advance
     *
     * @return self
     */
    public function setTravelAdvance($travel_advance)
    {
        if (is_null($travel_advance)) {
            throw new \InvalidArgumentException('non-nullable travel_advance cannot be null');
        }
        $this->container['travel_advance'] = $travel_advance;

        return $this;
    }

    /**
     * Gets fixed_invoiced_amount
     *
     * @return float|null
     */
    public function getFixedInvoicedAmount()
    {
        return $this->container['fixed_invoiced_amount'];
    }

    /**
     * Sets fixed_invoiced_amount
     *
     * @param float|null $fixed_invoiced_amount fixed_invoiced_amount
     *
     * @return self
     */
    public function setFixedInvoicedAmount($fixed_invoiced_amount)
    {
        if (is_null($fixed_invoiced_amount)) {
            throw new \InvalidArgumentException('non-nullable fixed_invoiced_amount cannot be null');
        }
        $this->container['fixed_invoiced_amount'] = $fixed_invoiced_amount;

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
     * Gets payment_amount
     *
     * @return float|null
     */
    public function getPaymentAmount()
    {
        return $this->container['payment_amount'];
    }

    /**
     * Sets payment_amount
     *
     * @param float|null $payment_amount payment_amount
     *
     * @return self
     */
    public function setPaymentAmount($payment_amount)
    {
        if (is_null($payment_amount)) {
            throw new \InvalidArgumentException('non-nullable payment_amount cannot be null');
        }
        $this->container['payment_amount'] = $payment_amount;

        return $this;
    }

    /**
     * Gets chargeable_amount
     *
     * @return float|null
     */
    public function getChargeableAmount()
    {
        return $this->container['chargeable_amount'];
    }

    /**
     * Sets chargeable_amount
     *
     * @param float|null $chargeable_amount chargeable_amount
     *
     * @return self
     */
    public function setChargeableAmount($chargeable_amount)
    {
        if (is_null($chargeable_amount)) {
            throw new \InvalidArgumentException('non-nullable chargeable_amount cannot be null');
        }
        $this->container['chargeable_amount'] = $chargeable_amount;

        return $this;
    }

    /**
     * Gets low_rate_vat
     *
     * @return float|null
     */
    public function getLowRateVat()
    {
        return $this->container['low_rate_vat'];
    }

    /**
     * Sets low_rate_vat
     *
     * @param float|null $low_rate_vat low_rate_vat
     *
     * @return self
     */
    public function setLowRateVat($low_rate_vat)
    {
        if (is_null($low_rate_vat)) {
            throw new \InvalidArgumentException('non-nullable low_rate_vat cannot be null');
        }
        $this->container['low_rate_vat'] = $low_rate_vat;

        return $this;
    }

    /**
     * Gets medium_rate_vat
     *
     * @return float|null
     */
    public function getMediumRateVat()
    {
        return $this->container['medium_rate_vat'];
    }

    /**
     * Sets medium_rate_vat
     *
     * @param float|null $medium_rate_vat medium_rate_vat
     *
     * @return self
     */
    public function setMediumRateVat($medium_rate_vat)
    {
        if (is_null($medium_rate_vat)) {
            throw new \InvalidArgumentException('non-nullable medium_rate_vat cannot be null');
        }
        $this->container['medium_rate_vat'] = $medium_rate_vat;

        return $this;
    }

    /**
     * Gets high_rate_vat
     *
     * @return float|null
     */
    public function getHighRateVat()
    {
        return $this->container['high_rate_vat'];
    }

    /**
     * Sets high_rate_vat
     *
     * @param float|null $high_rate_vat high_rate_vat
     *
     * @return self
     */
    public function setHighRateVat($high_rate_vat)
    {
        if (is_null($high_rate_vat)) {
            throw new \InvalidArgumentException('non-nullable high_rate_vat cannot be null');
        }
        $this->container['high_rate_vat'] = $high_rate_vat;

        return $this;
    }

    /**
     * Gets payment_amount_currency
     *
     * @return float|null
     */
    public function getPaymentAmountCurrency()
    {
        return $this->container['payment_amount_currency'];
    }

    /**
     * Sets payment_amount_currency
     *
     * @param float|null $payment_amount_currency payment_amount_currency
     *
     * @return self
     */
    public function setPaymentAmountCurrency($payment_amount_currency)
    {
        if (is_null($payment_amount_currency)) {
            throw new \InvalidArgumentException('non-nullable payment_amount_currency cannot be null');
        }
        $this->container['payment_amount_currency'] = $payment_amount_currency;

        return $this;
    }

    /**
     * Gets number
     *
     * @return int|null
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param int|null $number number
     *
     * @return self
     */
    public function setNumber($number)
    {
        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }
        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets invoice
     *
     * @return \Learnist\Tripletex\Model\Invoice|null
     */
    public function getInvoice()
    {
        return $this->container['invoice'];
    }

    /**
     * Sets invoice
     *
     * @param \Learnist\Tripletex\Model\Invoice|null $invoice invoice
     *
     * @return self
     */
    public function setInvoice($invoice)
    {
        if (is_null($invoice)) {
            throw new \InvalidArgumentException('non-nullable invoice cannot be null');
        }
        $this->container['invoice'] = $invoice;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title title
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        if ((mb_strlen($title) > 255)) {
            throw new \InvalidArgumentException('invalid length for $title when calling TravelExpense., must be smaller than or equal to 255.');
        }

        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets per_diem_compensations
     *
     * @return \Learnist\Tripletex\Model\PerDiemCompensation[]|null
     */
    public function getPerDiemCompensations()
    {
        return $this->container['per_diem_compensations'];
    }

    /**
     * Sets per_diem_compensations
     *
     * @param \Learnist\Tripletex\Model\PerDiemCompensation[]|null $per_diem_compensations Link to individual per diem compensations.
     *
     * @return self
     */
    public function setPerDiemCompensations($per_diem_compensations)
    {
        if (is_null($per_diem_compensations)) {
            throw new \InvalidArgumentException('non-nullable per_diem_compensations cannot be null');
        }
        $this->container['per_diem_compensations'] = $per_diem_compensations;

        return $this;
    }

    /**
     * Gets mileage_allowances
     *
     * @return \Learnist\Tripletex\Model\MileageAllowance[]|null
     */
    public function getMileageAllowances()
    {
        return $this->container['mileage_allowances'];
    }

    /**
     * Sets mileage_allowances
     *
     * @param \Learnist\Tripletex\Model\MileageAllowance[]|null $mileage_allowances Link to individual mileage allowances.
     *
     * @return self
     */
    public function setMileageAllowances($mileage_allowances)
    {
        if (is_null($mileage_allowances)) {
            throw new \InvalidArgumentException('non-nullable mileage_allowances cannot be null');
        }
        $this->container['mileage_allowances'] = $mileage_allowances;

        return $this;
    }

    /**
     * Gets accommodation_allowances
     *
     * @return \Learnist\Tripletex\Model\AccommodationAllowance[]|null
     */
    public function getAccommodationAllowances()
    {
        return $this->container['accommodation_allowances'];
    }

    /**
     * Sets accommodation_allowances
     *
     * @param \Learnist\Tripletex\Model\AccommodationAllowance[]|null $accommodation_allowances Link to individual accommodation allowances.
     *
     * @return self
     */
    public function setAccommodationAllowances($accommodation_allowances)
    {
        if (is_null($accommodation_allowances)) {
            throw new \InvalidArgumentException('non-nullable accommodation_allowances cannot be null');
        }
        $this->container['accommodation_allowances'] = $accommodation_allowances;

        return $this;
    }

    /**
     * Gets costs
     *
     * @return \Learnist\Tripletex\Model\Cost[]|null
     */
    public function getCosts()
    {
        return $this->container['costs'];
    }

    /**
     * Sets costs
     *
     * @param \Learnist\Tripletex\Model\Cost[]|null $costs Link to individual costs.
     *
     * @return self
     */
    public function setCosts($costs)
    {
        if (is_null($costs)) {
            throw new \InvalidArgumentException('non-nullable costs cannot be null');
        }
        $this->container['costs'] = $costs;

        return $this;
    }

    /**
     * Gets attachment_count
     *
     * @return int|null
     */
    public function getAttachmentCount()
    {
        return $this->container['attachment_count'];
    }

    /**
     * Sets attachment_count
     *
     * @param int|null $attachment_count attachment_count
     *
     * @return self
     */
    public function setAttachmentCount($attachment_count)
    {
        if (is_null($attachment_count)) {
            throw new \InvalidArgumentException('non-nullable attachment_count cannot be null');
        }

        if (($attachment_count > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $attachment_count when calling TravelExpense., must be smaller than or equal to 2147483647.');
        }
        if (($attachment_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $attachment_count when calling TravelExpense., must be bigger than or equal to 0.');
        }

        $this->container['attachment_count'] = $attachment_count;

        return $this;
    }

    /**
     * Gets state
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string|null $state state
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            throw new \InvalidArgumentException('non-nullable state cannot be null');
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!in_array($state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'state', must be one of '%s'",
                    $state,
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
     * @return \Learnist\Tripletex\Model\Link[]|null
     */
    public function getActions()
    {
        return $this->container['actions'];
    }

    /**
     * Sets actions
     *
     * @param \Learnist\Tripletex\Model\Link[]|null $actions actions
     *
     * @return self
     */
    public function setActions($actions)
    {
        if (is_null($actions)) {
            throw new \InvalidArgumentException('non-nullable actions cannot be null');
        }
        $this->container['actions'] = $actions;

        return $this;
    }

    /**
     * Gets is_salary_admin
     *
     * @return bool|null
     */
    public function getIsSalaryAdmin()
    {
        return $this->container['is_salary_admin'];
    }

    /**
     * Sets is_salary_admin
     *
     * @param bool|null $is_salary_admin is_salary_admin
     *
     * @return self
     */
    public function setIsSalaryAdmin($is_salary_admin)
    {
        if (is_null($is_salary_admin)) {
            throw new \InvalidArgumentException('non-nullable is_salary_admin cannot be null');
        }
        $this->container['is_salary_admin'] = $is_salary_admin;

        return $this;
    }

    /**
     * Gets show_payslip
     *
     * @return bool|null
     */
    public function getShowPayslip()
    {
        return $this->container['show_payslip'];
    }

    /**
     * Sets show_payslip
     *
     * @param bool|null $show_payslip show_payslip
     *
     * @return self
     */
    public function setShowPayslip($show_payslip)
    {
        if (is_null($show_payslip)) {
            throw new \InvalidArgumentException('non-nullable show_payslip cannot be null');
        }
        $this->container['show_payslip'] = $show_payslip;

        return $this;
    }

    /**
     * Gets accounting_period_closed
     *
     * @return bool|null
     */
    public function getAccountingPeriodClosed()
    {
        return $this->container['accounting_period_closed'];
    }

    /**
     * Sets accounting_period_closed
     *
     * @param bool|null $accounting_period_closed accounting_period_closed
     *
     * @return self
     */
    public function setAccountingPeriodClosed($accounting_period_closed)
    {
        if (is_null($accounting_period_closed)) {
            throw new \InvalidArgumentException('non-nullable accounting_period_closed cannot be null');
        }
        $this->container['accounting_period_closed'] = $accounting_period_closed;

        return $this;
    }

    /**
     * Gets accounting_period_vat_closed
     *
     * @return bool|null
     */
    public function getAccountingPeriodVatClosed()
    {
        return $this->container['accounting_period_vat_closed'];
    }

    /**
     * Sets accounting_period_vat_closed
     *
     * @param bool|null $accounting_period_vat_closed accounting_period_vat_closed
     *
     * @return self
     */
    public function setAccountingPeriodVatClosed($accounting_period_vat_closed)
    {
        if (is_null($accounting_period_vat_closed)) {
            throw new \InvalidArgumentException('non-nullable accounting_period_vat_closed cannot be null');
        }
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


