<?php
/**
 * VoucherInboxItem
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
 * VoucherInboxItem Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class VoucherInboxItem implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'VoucherInboxItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'company_id' => 'int',
        'description' => 'string',
        'type' => 'string',
        'received_date' => 'string',
        'voucher_id' => 'int',
        'invoice_id' => 'int',
        'invoice_type' => 'string',
        'last_comment' => 'string',
        'invoice_date' => 'string',
        'invoice_date_source_type' => 'string',
        'due_date' => 'string',
        'is_due' => 'bool',
        'due_date_source_type' => 'string',
        'supplier_name' => 'string',
        'supplier_source_type' => 'string',
        'invoice_amount' => 'float',
        'invoice_amount_source_type' => 'string',
        'invoice_currency' => 'string',
        'invoice_currency_source_type' => 'string',
        'documents' => 'string[]',
        'document_ids' => 'int[]',
        'account_id' => 'int',
        'account' => 'string',
        'account_source_type' => 'string',
        'vat_number' => 'string',
        'vat_amount' => 'float',
        'vat_percentage' => 'float',
        'vat_source_type' => 'string',
        'department_id' => 'int',
        'project_id' => 'int',
        'project' => 'string',
        'project_source_type' => 'string',
        'department' => 'string',
        'department_source_type' => 'string',
        'payment_type_id' => 'int',
        'payment_type' => 'string',
        'payment_type_source_type' => 'string',
        'import_failure_reason' => 'string',
        'accounting_period' => 'string',
        'filename' => 'string',
        'is_temporary' => 'bool',
        'is_invoice_simple' => 'bool',
        'is_invoice_detailed' => 'bool',
        'has_predictions' => 'bool',
        'has_smart_scan_suggestions' => 'bool',
        'is_locked' => 'bool',
        'comment_count' => 'int',
        'non_automation_reason' => 'string',
        'can_be_sent_to_ledger' => 'bool',
        'can_be_registered_as_changed' => 'bool',
        'can_be_registered_as_simple_invoice' => 'bool',
        'can_be_registered_as_detailed_invoice' => 'bool',
        'can_be_registered_as_bank_reconciliation' => 'bool',
        'can_be_registered_as_payment_in' => 'bool',
        'can_be_registered_as_income' => 'bool',
        'can_be_registered_as_customs_declaration' => 'bool',
        'can_be_registered_as_advanced' => 'bool',
        'can_be_sent_to_accountant' => 'bool',
        'can_be_sent_to_archive' => 'bool',
        'can_be_deleted' => 'bool',
        'can_be_registered_in_queue' => 'bool',
        'can_be_merged' => 'bool',
        'allow_posting_before_voucher_approved' => 'bool',
        'sender_email_address' => 'string',
        'is_spam' => 'bool',
        'email_arrival_time' => 'string',
        'spam_report_for_display' => 'string'
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
        'company_id' => 'int32',
        'description' => null,
        'type' => null,
        'received_date' => null,
        'voucher_id' => 'int32',
        'invoice_id' => 'int32',
        'invoice_type' => null,
        'last_comment' => null,
        'invoice_date' => null,
        'invoice_date_source_type' => null,
        'due_date' => null,
        'is_due' => null,
        'due_date_source_type' => null,
        'supplier_name' => null,
        'supplier_source_type' => null,
        'invoice_amount' => null,
        'invoice_amount_source_type' => null,
        'invoice_currency' => null,
        'invoice_currency_source_type' => null,
        'documents' => null,
        'document_ids' => 'int32',
        'account_id' => 'int32',
        'account' => null,
        'account_source_type' => null,
        'vat_number' => null,
        'vat_amount' => null,
        'vat_percentage' => null,
        'vat_source_type' => null,
        'department_id' => 'int32',
        'project_id' => 'int32',
        'project' => null,
        'project_source_type' => null,
        'department' => null,
        'department_source_type' => null,
        'payment_type_id' => 'int32',
        'payment_type' => null,
        'payment_type_source_type' => null,
        'import_failure_reason' => null,
        'accounting_period' => null,
        'filename' => null,
        'is_temporary' => null,
        'is_invoice_simple' => null,
        'is_invoice_detailed' => null,
        'has_predictions' => null,
        'has_smart_scan_suggestions' => null,
        'is_locked' => null,
        'comment_count' => 'int32',
        'non_automation_reason' => null,
        'can_be_sent_to_ledger' => null,
        'can_be_registered_as_changed' => null,
        'can_be_registered_as_simple_invoice' => null,
        'can_be_registered_as_detailed_invoice' => null,
        'can_be_registered_as_bank_reconciliation' => null,
        'can_be_registered_as_payment_in' => null,
        'can_be_registered_as_income' => null,
        'can_be_registered_as_customs_declaration' => null,
        'can_be_registered_as_advanced' => null,
        'can_be_sent_to_accountant' => null,
        'can_be_sent_to_archive' => null,
        'can_be_deleted' => null,
        'can_be_registered_in_queue' => null,
        'can_be_merged' => null,
        'allow_posting_before_voucher_approved' => null,
        'sender_email_address' => null,
        'is_spam' => null,
        'email_arrival_time' => null,
        'spam_report_for_display' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'company_id' => false,
		'description' => false,
		'type' => false,
		'received_date' => false,
		'voucher_id' => false,
		'invoice_id' => false,
		'invoice_type' => false,
		'last_comment' => false,
		'invoice_date' => false,
		'invoice_date_source_type' => false,
		'due_date' => false,
		'is_due' => false,
		'due_date_source_type' => false,
		'supplier_name' => false,
		'supplier_source_type' => false,
		'invoice_amount' => false,
		'invoice_amount_source_type' => false,
		'invoice_currency' => false,
		'invoice_currency_source_type' => false,
		'documents' => false,
		'document_ids' => false,
		'account_id' => false,
		'account' => false,
		'account_source_type' => false,
		'vat_number' => false,
		'vat_amount' => false,
		'vat_percentage' => false,
		'vat_source_type' => false,
		'department_id' => false,
		'project_id' => false,
		'project' => false,
		'project_source_type' => false,
		'department' => false,
		'department_source_type' => false,
		'payment_type_id' => false,
		'payment_type' => false,
		'payment_type_source_type' => false,
		'import_failure_reason' => false,
		'accounting_period' => false,
		'filename' => false,
		'is_temporary' => false,
		'is_invoice_simple' => false,
		'is_invoice_detailed' => false,
		'has_predictions' => false,
		'has_smart_scan_suggestions' => false,
		'is_locked' => false,
		'comment_count' => false,
		'non_automation_reason' => false,
		'can_be_sent_to_ledger' => false,
		'can_be_registered_as_changed' => false,
		'can_be_registered_as_simple_invoice' => false,
		'can_be_registered_as_detailed_invoice' => false,
		'can_be_registered_as_bank_reconciliation' => false,
		'can_be_registered_as_payment_in' => false,
		'can_be_registered_as_income' => false,
		'can_be_registered_as_customs_declaration' => false,
		'can_be_registered_as_advanced' => false,
		'can_be_sent_to_accountant' => false,
		'can_be_sent_to_archive' => false,
		'can_be_deleted' => false,
		'can_be_registered_in_queue' => false,
		'can_be_merged' => false,
		'allow_posting_before_voucher_approved' => false,
		'sender_email_address' => false,
		'is_spam' => false,
		'email_arrival_time' => false,
		'spam_report_for_display' => false
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
        'company_id' => 'companyId',
        'description' => 'description',
        'type' => 'type',
        'received_date' => 'receivedDate',
        'voucher_id' => 'voucherId',
        'invoice_id' => 'invoiceId',
        'invoice_type' => 'invoiceType',
        'last_comment' => 'lastComment',
        'invoice_date' => 'invoiceDate',
        'invoice_date_source_type' => 'invoiceDateSourceType',
        'due_date' => 'dueDate',
        'is_due' => 'isDue',
        'due_date_source_type' => 'dueDateSourceType',
        'supplier_name' => 'supplierName',
        'supplier_source_type' => 'supplierSourceType',
        'invoice_amount' => 'invoiceAmount',
        'invoice_amount_source_type' => 'invoiceAmountSourceType',
        'invoice_currency' => 'invoiceCurrency',
        'invoice_currency_source_type' => 'invoiceCurrencySourceType',
        'documents' => 'documents',
        'document_ids' => 'documentIds',
        'account_id' => 'accountId',
        'account' => 'account',
        'account_source_type' => 'accountSourceType',
        'vat_number' => 'vatNumber',
        'vat_amount' => 'vatAmount',
        'vat_percentage' => 'vatPercentage',
        'vat_source_type' => 'vatSourceType',
        'department_id' => 'departmentId',
        'project_id' => 'projectId',
        'project' => 'project',
        'project_source_type' => 'projectSourceType',
        'department' => 'department',
        'department_source_type' => 'departmentSourceType',
        'payment_type_id' => 'paymentTypeId',
        'payment_type' => 'paymentType',
        'payment_type_source_type' => 'paymentTypeSourceType',
        'import_failure_reason' => 'importFailureReason',
        'accounting_period' => 'accountingPeriod',
        'filename' => 'filename',
        'is_temporary' => 'isTemporary',
        'is_invoice_simple' => 'isInvoiceSimple',
        'is_invoice_detailed' => 'isInvoiceDetailed',
        'has_predictions' => 'hasPredictions',
        'has_smart_scan_suggestions' => 'hasSmartScanSuggestions',
        'is_locked' => 'isLocked',
        'comment_count' => 'commentCount',
        'non_automation_reason' => 'nonAutomationReason',
        'can_be_sent_to_ledger' => 'canBeSentToLedger',
        'can_be_registered_as_changed' => 'canBeRegisteredAsChanged',
        'can_be_registered_as_simple_invoice' => 'canBeRegisteredAsSimpleInvoice',
        'can_be_registered_as_detailed_invoice' => 'canBeRegisteredAsDetailedInvoice',
        'can_be_registered_as_bank_reconciliation' => 'canBeRegisteredAsBankReconciliation',
        'can_be_registered_as_payment_in' => 'canBeRegisteredAsPaymentIn',
        'can_be_registered_as_income' => 'canBeRegisteredAsIncome',
        'can_be_registered_as_customs_declaration' => 'canBeRegisteredAsCustomsDeclaration',
        'can_be_registered_as_advanced' => 'canBeRegisteredAsAdvanced',
        'can_be_sent_to_accountant' => 'canBeSentToAccountant',
        'can_be_sent_to_archive' => 'canBeSentToArchive',
        'can_be_deleted' => 'canBeDeleted',
        'can_be_registered_in_queue' => 'canBeRegisteredInQueue',
        'can_be_merged' => 'canBeMerged',
        'allow_posting_before_voucher_approved' => 'allowPostingBeforeVoucherApproved',
        'sender_email_address' => 'senderEmailAddress',
        'is_spam' => 'isSpam',
        'email_arrival_time' => 'emailArrivalTime',
        'spam_report_for_display' => 'spamReportForDisplay'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'company_id' => 'setCompanyId',
        'description' => 'setDescription',
        'type' => 'setType',
        'received_date' => 'setReceivedDate',
        'voucher_id' => 'setVoucherId',
        'invoice_id' => 'setInvoiceId',
        'invoice_type' => 'setInvoiceType',
        'last_comment' => 'setLastComment',
        'invoice_date' => 'setInvoiceDate',
        'invoice_date_source_type' => 'setInvoiceDateSourceType',
        'due_date' => 'setDueDate',
        'is_due' => 'setIsDue',
        'due_date_source_type' => 'setDueDateSourceType',
        'supplier_name' => 'setSupplierName',
        'supplier_source_type' => 'setSupplierSourceType',
        'invoice_amount' => 'setInvoiceAmount',
        'invoice_amount_source_type' => 'setInvoiceAmountSourceType',
        'invoice_currency' => 'setInvoiceCurrency',
        'invoice_currency_source_type' => 'setInvoiceCurrencySourceType',
        'documents' => 'setDocuments',
        'document_ids' => 'setDocumentIds',
        'account_id' => 'setAccountId',
        'account' => 'setAccount',
        'account_source_type' => 'setAccountSourceType',
        'vat_number' => 'setVatNumber',
        'vat_amount' => 'setVatAmount',
        'vat_percentage' => 'setVatPercentage',
        'vat_source_type' => 'setVatSourceType',
        'department_id' => 'setDepartmentId',
        'project_id' => 'setProjectId',
        'project' => 'setProject',
        'project_source_type' => 'setProjectSourceType',
        'department' => 'setDepartment',
        'department_source_type' => 'setDepartmentSourceType',
        'payment_type_id' => 'setPaymentTypeId',
        'payment_type' => 'setPaymentType',
        'payment_type_source_type' => 'setPaymentTypeSourceType',
        'import_failure_reason' => 'setImportFailureReason',
        'accounting_period' => 'setAccountingPeriod',
        'filename' => 'setFilename',
        'is_temporary' => 'setIsTemporary',
        'is_invoice_simple' => 'setIsInvoiceSimple',
        'is_invoice_detailed' => 'setIsInvoiceDetailed',
        'has_predictions' => 'setHasPredictions',
        'has_smart_scan_suggestions' => 'setHasSmartScanSuggestions',
        'is_locked' => 'setIsLocked',
        'comment_count' => 'setCommentCount',
        'non_automation_reason' => 'setNonAutomationReason',
        'can_be_sent_to_ledger' => 'setCanBeSentToLedger',
        'can_be_registered_as_changed' => 'setCanBeRegisteredAsChanged',
        'can_be_registered_as_simple_invoice' => 'setCanBeRegisteredAsSimpleInvoice',
        'can_be_registered_as_detailed_invoice' => 'setCanBeRegisteredAsDetailedInvoice',
        'can_be_registered_as_bank_reconciliation' => 'setCanBeRegisteredAsBankReconciliation',
        'can_be_registered_as_payment_in' => 'setCanBeRegisteredAsPaymentIn',
        'can_be_registered_as_income' => 'setCanBeRegisteredAsIncome',
        'can_be_registered_as_customs_declaration' => 'setCanBeRegisteredAsCustomsDeclaration',
        'can_be_registered_as_advanced' => 'setCanBeRegisteredAsAdvanced',
        'can_be_sent_to_accountant' => 'setCanBeSentToAccountant',
        'can_be_sent_to_archive' => 'setCanBeSentToArchive',
        'can_be_deleted' => 'setCanBeDeleted',
        'can_be_registered_in_queue' => 'setCanBeRegisteredInQueue',
        'can_be_merged' => 'setCanBeMerged',
        'allow_posting_before_voucher_approved' => 'setAllowPostingBeforeVoucherApproved',
        'sender_email_address' => 'setSenderEmailAddress',
        'is_spam' => 'setIsSpam',
        'email_arrival_time' => 'setEmailArrivalTime',
        'spam_report_for_display' => 'setSpamReportForDisplay'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'company_id' => 'getCompanyId',
        'description' => 'getDescription',
        'type' => 'getType',
        'received_date' => 'getReceivedDate',
        'voucher_id' => 'getVoucherId',
        'invoice_id' => 'getInvoiceId',
        'invoice_type' => 'getInvoiceType',
        'last_comment' => 'getLastComment',
        'invoice_date' => 'getInvoiceDate',
        'invoice_date_source_type' => 'getInvoiceDateSourceType',
        'due_date' => 'getDueDate',
        'is_due' => 'getIsDue',
        'due_date_source_type' => 'getDueDateSourceType',
        'supplier_name' => 'getSupplierName',
        'supplier_source_type' => 'getSupplierSourceType',
        'invoice_amount' => 'getInvoiceAmount',
        'invoice_amount_source_type' => 'getInvoiceAmountSourceType',
        'invoice_currency' => 'getInvoiceCurrency',
        'invoice_currency_source_type' => 'getInvoiceCurrencySourceType',
        'documents' => 'getDocuments',
        'document_ids' => 'getDocumentIds',
        'account_id' => 'getAccountId',
        'account' => 'getAccount',
        'account_source_type' => 'getAccountSourceType',
        'vat_number' => 'getVatNumber',
        'vat_amount' => 'getVatAmount',
        'vat_percentage' => 'getVatPercentage',
        'vat_source_type' => 'getVatSourceType',
        'department_id' => 'getDepartmentId',
        'project_id' => 'getProjectId',
        'project' => 'getProject',
        'project_source_type' => 'getProjectSourceType',
        'department' => 'getDepartment',
        'department_source_type' => 'getDepartmentSourceType',
        'payment_type_id' => 'getPaymentTypeId',
        'payment_type' => 'getPaymentType',
        'payment_type_source_type' => 'getPaymentTypeSourceType',
        'import_failure_reason' => 'getImportFailureReason',
        'accounting_period' => 'getAccountingPeriod',
        'filename' => 'getFilename',
        'is_temporary' => 'getIsTemporary',
        'is_invoice_simple' => 'getIsInvoiceSimple',
        'is_invoice_detailed' => 'getIsInvoiceDetailed',
        'has_predictions' => 'getHasPredictions',
        'has_smart_scan_suggestions' => 'getHasSmartScanSuggestions',
        'is_locked' => 'getIsLocked',
        'comment_count' => 'getCommentCount',
        'non_automation_reason' => 'getNonAutomationReason',
        'can_be_sent_to_ledger' => 'getCanBeSentToLedger',
        'can_be_registered_as_changed' => 'getCanBeRegisteredAsChanged',
        'can_be_registered_as_simple_invoice' => 'getCanBeRegisteredAsSimpleInvoice',
        'can_be_registered_as_detailed_invoice' => 'getCanBeRegisteredAsDetailedInvoice',
        'can_be_registered_as_bank_reconciliation' => 'getCanBeRegisteredAsBankReconciliation',
        'can_be_registered_as_payment_in' => 'getCanBeRegisteredAsPaymentIn',
        'can_be_registered_as_income' => 'getCanBeRegisteredAsIncome',
        'can_be_registered_as_customs_declaration' => 'getCanBeRegisteredAsCustomsDeclaration',
        'can_be_registered_as_advanced' => 'getCanBeRegisteredAsAdvanced',
        'can_be_sent_to_accountant' => 'getCanBeSentToAccountant',
        'can_be_sent_to_archive' => 'getCanBeSentToArchive',
        'can_be_deleted' => 'getCanBeDeleted',
        'can_be_registered_in_queue' => 'getCanBeRegisteredInQueue',
        'can_be_merged' => 'getCanBeMerged',
        'allow_posting_before_voucher_approved' => 'getAllowPostingBeforeVoucherApproved',
        'sender_email_address' => 'getSenderEmailAddress',
        'is_spam' => 'getIsSpam',
        'email_arrival_time' => 'getEmailArrivalTime',
        'spam_report_for_display' => 'getSpamReportForDisplay'
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

    public const TYPE_UNKNOWN = 'UNKNOWN';
    public const TYPE_INVOICE = 'INVOICE';
    public const TYPE_ERROR_EHF_IMPORT = 'ERROR_EHF_IMPORT';
    public const TYPE_REPLAYABLE_VOUCHER = 'REPLAYABLE_VOUCHER';
    public const TYPE_REMINDER_SPECIFICATION = 'REMINDER_SPECIFICATION';
    public const TYPE_CREDITNOTE = 'CREDITNOTE';
    public const TYPE_RECEIPT = 'RECEIPT';
    public const INVOICE_TYPE_UNKNOWN = 'UNKNOWN';
    public const INVOICE_TYPE_PDF = 'PDF';
    public const INVOICE_TYPE_EHF = 'EHF';
    public const INVOICE_TYPE_EFO_NELFO = 'EFO_NELFO';
    public const INVOICE_DATE_SOURCE_TYPE_NONE = 'NONE';
    public const INVOICE_DATE_SOURCE_TYPE_EDI = 'EDI';
    public const INVOICE_DATE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const INVOICE_DATE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const INVOICE_DATE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const DUE_DATE_SOURCE_TYPE_NONE = 'NONE';
    public const DUE_DATE_SOURCE_TYPE_EDI = 'EDI';
    public const DUE_DATE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const DUE_DATE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const DUE_DATE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const SUPPLIER_SOURCE_TYPE_NONE = 'NONE';
    public const SUPPLIER_SOURCE_TYPE_EDI = 'EDI';
    public const SUPPLIER_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const SUPPLIER_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const SUPPLIER_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const INVOICE_AMOUNT_SOURCE_TYPE_NONE = 'NONE';
    public const INVOICE_AMOUNT_SOURCE_TYPE_EDI = 'EDI';
    public const INVOICE_AMOUNT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const INVOICE_AMOUNT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const INVOICE_AMOUNT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const INVOICE_CURRENCY_SOURCE_TYPE_NONE = 'NONE';
    public const INVOICE_CURRENCY_SOURCE_TYPE_EDI = 'EDI';
    public const INVOICE_CURRENCY_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const INVOICE_CURRENCY_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const INVOICE_CURRENCY_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const ACCOUNT_SOURCE_TYPE_NONE = 'NONE';
    public const ACCOUNT_SOURCE_TYPE_EDI = 'EDI';
    public const ACCOUNT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const ACCOUNT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const ACCOUNT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const VAT_SOURCE_TYPE_NONE = 'NONE';
    public const VAT_SOURCE_TYPE_EDI = 'EDI';
    public const VAT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const VAT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const VAT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const PROJECT_SOURCE_TYPE_NONE = 'NONE';
    public const PROJECT_SOURCE_TYPE_EDI = 'EDI';
    public const PROJECT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const PROJECT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const PROJECT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const DEPARTMENT_SOURCE_TYPE_NONE = 'NONE';
    public const DEPARTMENT_SOURCE_TYPE_EDI = 'EDI';
    public const DEPARTMENT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const DEPARTMENT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const DEPARTMENT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
    public const PAYMENT_TYPE_SOURCE_TYPE_NONE = 'NONE';
    public const PAYMENT_TYPE_SOURCE_TYPE_EDI = 'EDI';
    public const PAYMENT_TYPE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
    public const PAYMENT_TYPE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
    public const PAYMENT_TYPE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_UNKNOWN,
            self::TYPE_INVOICE,
            self::TYPE_ERROR_EHF_IMPORT,
            self::TYPE_REPLAYABLE_VOUCHER,
            self::TYPE_REMINDER_SPECIFICATION,
            self::TYPE_CREDITNOTE,
            self::TYPE_RECEIPT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceTypeAllowableValues()
    {
        return [
            self::INVOICE_TYPE_UNKNOWN,
            self::INVOICE_TYPE_PDF,
            self::INVOICE_TYPE_EHF,
            self::INVOICE_TYPE_EFO_NELFO,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceDateSourceTypeAllowableValues()
    {
        return [
            self::INVOICE_DATE_SOURCE_TYPE_NONE,
            self::INVOICE_DATE_SOURCE_TYPE_EDI,
            self::INVOICE_DATE_SOURCE_TYPE_SMART_SCAN,
            self::INVOICE_DATE_SOURCE_TYPE_FABRIC_AI,
            self::INVOICE_DATE_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDueDateSourceTypeAllowableValues()
    {
        return [
            self::DUE_DATE_SOURCE_TYPE_NONE,
            self::DUE_DATE_SOURCE_TYPE_EDI,
            self::DUE_DATE_SOURCE_TYPE_SMART_SCAN,
            self::DUE_DATE_SOURCE_TYPE_FABRIC_AI,
            self::DUE_DATE_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSupplierSourceTypeAllowableValues()
    {
        return [
            self::SUPPLIER_SOURCE_TYPE_NONE,
            self::SUPPLIER_SOURCE_TYPE_EDI,
            self::SUPPLIER_SOURCE_TYPE_SMART_SCAN,
            self::SUPPLIER_SOURCE_TYPE_FABRIC_AI,
            self::SUPPLIER_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceAmountSourceTypeAllowableValues()
    {
        return [
            self::INVOICE_AMOUNT_SOURCE_TYPE_NONE,
            self::INVOICE_AMOUNT_SOURCE_TYPE_EDI,
            self::INVOICE_AMOUNT_SOURCE_TYPE_SMART_SCAN,
            self::INVOICE_AMOUNT_SOURCE_TYPE_FABRIC_AI,
            self::INVOICE_AMOUNT_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceCurrencySourceTypeAllowableValues()
    {
        return [
            self::INVOICE_CURRENCY_SOURCE_TYPE_NONE,
            self::INVOICE_CURRENCY_SOURCE_TYPE_EDI,
            self::INVOICE_CURRENCY_SOURCE_TYPE_SMART_SCAN,
            self::INVOICE_CURRENCY_SOURCE_TYPE_FABRIC_AI,
            self::INVOICE_CURRENCY_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccountSourceTypeAllowableValues()
    {
        return [
            self::ACCOUNT_SOURCE_TYPE_NONE,
            self::ACCOUNT_SOURCE_TYPE_EDI,
            self::ACCOUNT_SOURCE_TYPE_SMART_SCAN,
            self::ACCOUNT_SOURCE_TYPE_FABRIC_AI,
            self::ACCOUNT_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVatSourceTypeAllowableValues()
    {
        return [
            self::VAT_SOURCE_TYPE_NONE,
            self::VAT_SOURCE_TYPE_EDI,
            self::VAT_SOURCE_TYPE_SMART_SCAN,
            self::VAT_SOURCE_TYPE_FABRIC_AI,
            self::VAT_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectSourceTypeAllowableValues()
    {
        return [
            self::PROJECT_SOURCE_TYPE_NONE,
            self::PROJECT_SOURCE_TYPE_EDI,
            self::PROJECT_SOURCE_TYPE_SMART_SCAN,
            self::PROJECT_SOURCE_TYPE_FABRIC_AI,
            self::PROJECT_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDepartmentSourceTypeAllowableValues()
    {
        return [
            self::DEPARTMENT_SOURCE_TYPE_NONE,
            self::DEPARTMENT_SOURCE_TYPE_EDI,
            self::DEPARTMENT_SOURCE_TYPE_SMART_SCAN,
            self::DEPARTMENT_SOURCE_TYPE_FABRIC_AI,
            self::DEPARTMENT_SOURCE_TYPE_LAST_VOUCHER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentTypeSourceTypeAllowableValues()
    {
        return [
            self::PAYMENT_TYPE_SOURCE_TYPE_NONE,
            self::PAYMENT_TYPE_SOURCE_TYPE_EDI,
            self::PAYMENT_TYPE_SOURCE_TYPE_SMART_SCAN,
            self::PAYMENT_TYPE_SOURCE_TYPE_FABRIC_AI,
            self::PAYMENT_TYPE_SOURCE_TYPE_LAST_VOUCHER,
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
        $this->setIfExists('company_id', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('received_date', $data ?? [], null);
        $this->setIfExists('voucher_id', $data ?? [], null);
        $this->setIfExists('invoice_id', $data ?? [], null);
        $this->setIfExists('invoice_type', $data ?? [], null);
        $this->setIfExists('last_comment', $data ?? [], null);
        $this->setIfExists('invoice_date', $data ?? [], null);
        $this->setIfExists('invoice_date_source_type', $data ?? [], null);
        $this->setIfExists('due_date', $data ?? [], null);
        $this->setIfExists('is_due', $data ?? [], null);
        $this->setIfExists('due_date_source_type', $data ?? [], null);
        $this->setIfExists('supplier_name', $data ?? [], null);
        $this->setIfExists('supplier_source_type', $data ?? [], null);
        $this->setIfExists('invoice_amount', $data ?? [], null);
        $this->setIfExists('invoice_amount_source_type', $data ?? [], null);
        $this->setIfExists('invoice_currency', $data ?? [], null);
        $this->setIfExists('invoice_currency_source_type', $data ?? [], null);
        $this->setIfExists('documents', $data ?? [], null);
        $this->setIfExists('document_ids', $data ?? [], null);
        $this->setIfExists('account_id', $data ?? [], null);
        $this->setIfExists('account', $data ?? [], null);
        $this->setIfExists('account_source_type', $data ?? [], null);
        $this->setIfExists('vat_number', $data ?? [], null);
        $this->setIfExists('vat_amount', $data ?? [], null);
        $this->setIfExists('vat_percentage', $data ?? [], null);
        $this->setIfExists('vat_source_type', $data ?? [], null);
        $this->setIfExists('department_id', $data ?? [], null);
        $this->setIfExists('project_id', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('project_source_type', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('department_source_type', $data ?? [], null);
        $this->setIfExists('payment_type_id', $data ?? [], null);
        $this->setIfExists('payment_type', $data ?? [], null);
        $this->setIfExists('payment_type_source_type', $data ?? [], null);
        $this->setIfExists('import_failure_reason', $data ?? [], null);
        $this->setIfExists('accounting_period', $data ?? [], null);
        $this->setIfExists('filename', $data ?? [], null);
        $this->setIfExists('is_temporary', $data ?? [], null);
        $this->setIfExists('is_invoice_simple', $data ?? [], null);
        $this->setIfExists('is_invoice_detailed', $data ?? [], null);
        $this->setIfExists('has_predictions', $data ?? [], null);
        $this->setIfExists('has_smart_scan_suggestions', $data ?? [], null);
        $this->setIfExists('is_locked', $data ?? [], null);
        $this->setIfExists('comment_count', $data ?? [], null);
        $this->setIfExists('non_automation_reason', $data ?? [], null);
        $this->setIfExists('can_be_sent_to_ledger', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_changed', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_simple_invoice', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_detailed_invoice', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_bank_reconciliation', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_payment_in', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_income', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_customs_declaration', $data ?? [], null);
        $this->setIfExists('can_be_registered_as_advanced', $data ?? [], null);
        $this->setIfExists('can_be_sent_to_accountant', $data ?? [], null);
        $this->setIfExists('can_be_sent_to_archive', $data ?? [], null);
        $this->setIfExists('can_be_deleted', $data ?? [], null);
        $this->setIfExists('can_be_registered_in_queue', $data ?? [], null);
        $this->setIfExists('can_be_merged', $data ?? [], null);
        $this->setIfExists('allow_posting_before_voucher_approved', $data ?? [], null);
        $this->setIfExists('sender_email_address', $data ?? [], null);
        $this->setIfExists('is_spam', $data ?? [], null);
        $this->setIfExists('email_arrival_time', $data ?? [], null);
        $this->setIfExists('spam_report_for_display', $data ?? [], null);
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

        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_type', must be one of '%s'",
                $this->container['invoice_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceDateSourceTypeAllowableValues();
        if (!is_null($this->container['invoice_date_source_type']) && !in_array($this->container['invoice_date_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_date_source_type', must be one of '%s'",
                $this->container['invoice_date_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDueDateSourceTypeAllowableValues();
        if (!is_null($this->container['due_date_source_type']) && !in_array($this->container['due_date_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'due_date_source_type', must be one of '%s'",
                $this->container['due_date_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSupplierSourceTypeAllowableValues();
        if (!is_null($this->container['supplier_source_type']) && !in_array($this->container['supplier_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'supplier_source_type', must be one of '%s'",
                $this->container['supplier_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceAmountSourceTypeAllowableValues();
        if (!is_null($this->container['invoice_amount_source_type']) && !in_array($this->container['invoice_amount_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_amount_source_type', must be one of '%s'",
                $this->container['invoice_amount_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceCurrencySourceTypeAllowableValues();
        if (!is_null($this->container['invoice_currency_source_type']) && !in_array($this->container['invoice_currency_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_currency_source_type', must be one of '%s'",
                $this->container['invoice_currency_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAccountSourceTypeAllowableValues();
        if (!is_null($this->container['account_source_type']) && !in_array($this->container['account_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'account_source_type', must be one of '%s'",
                $this->container['account_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVatSourceTypeAllowableValues();
        if (!is_null($this->container['vat_source_type']) && !in_array($this->container['vat_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'vat_source_type', must be one of '%s'",
                $this->container['vat_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectSourceTypeAllowableValues();
        if (!is_null($this->container['project_source_type']) && !in_array($this->container['project_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_source_type', must be one of '%s'",
                $this->container['project_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDepartmentSourceTypeAllowableValues();
        if (!is_null($this->container['department_source_type']) && !in_array($this->container['department_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'department_source_type', must be one of '%s'",
                $this->container['department_source_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPaymentTypeSourceTypeAllowableValues();
        if (!is_null($this->container['payment_type_source_type']) && !in_array($this->container['payment_type_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_type_source_type', must be one of '%s'",
                $this->container['payment_type_source_type'],
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
     * Gets company_id
     *
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int|null $company_id company_id
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {
        if (is_null($company_id)) {
            throw new \InvalidArgumentException('non-nullable company_id cannot be null');
        }
        $this->container['company_id'] = $company_id;

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
     * Gets received_date
     *
     * @return string|null
     */
    public function getReceivedDate()
    {
        return $this->container['received_date'];
    }

    /**
     * Sets received_date
     *
     * @param string|null $received_date received_date
     *
     * @return self
     */
    public function setReceivedDate($received_date)
    {
        if (is_null($received_date)) {
            throw new \InvalidArgumentException('non-nullable received_date cannot be null');
        }
        $this->container['received_date'] = $received_date;

        return $this;
    }

    /**
     * Gets voucher_id
     *
     * @return int|null
     */
    public function getVoucherId()
    {
        return $this->container['voucher_id'];
    }

    /**
     * Sets voucher_id
     *
     * @param int|null $voucher_id voucher_id
     *
     * @return self
     */
    public function setVoucherId($voucher_id)
    {
        if (is_null($voucher_id)) {
            throw new \InvalidArgumentException('non-nullable voucher_id cannot be null');
        }
        $this->container['voucher_id'] = $voucher_id;

        return $this;
    }

    /**
     * Gets invoice_id
     *
     * @return int|null
     */
    public function getInvoiceId()
    {
        return $this->container['invoice_id'];
    }

    /**
     * Sets invoice_id
     *
     * @param int|null $invoice_id invoice_id
     *
     * @return self
     */
    public function setInvoiceId($invoice_id)
    {
        if (is_null($invoice_id)) {
            throw new \InvalidArgumentException('non-nullable invoice_id cannot be null');
        }
        $this->container['invoice_id'] = $invoice_id;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string|null
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string|null $invoice_type invoice_type
     *
     * @return self
     */
    public function setInvoiceType($invoice_type)
    {
        if (is_null($invoice_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_type cannot be null');
        }
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_type', must be one of '%s'",
                    $invoice_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_type'] = $invoice_type;

        return $this;
    }

    /**
     * Gets last_comment
     *
     * @return string|null
     */
    public function getLastComment()
    {
        return $this->container['last_comment'];
    }

    /**
     * Sets last_comment
     *
     * @param string|null $last_comment last_comment
     *
     * @return self
     */
    public function setLastComment($last_comment)
    {
        if (is_null($last_comment)) {
            throw new \InvalidArgumentException('non-nullable last_comment cannot be null');
        }
        $this->container['last_comment'] = $last_comment;

        return $this;
    }

    /**
     * Gets invoice_date
     *
     * @return string|null
     */
    public function getInvoiceDate()
    {
        return $this->container['invoice_date'];
    }

    /**
     * Sets invoice_date
     *
     * @param string|null $invoice_date invoice_date
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
     * Gets invoice_date_source_type
     *
     * @return string|null
     */
    public function getInvoiceDateSourceType()
    {
        return $this->container['invoice_date_source_type'];
    }

    /**
     * Sets invoice_date_source_type
     *
     * @param string|null $invoice_date_source_type invoice_date_source_type
     *
     * @return self
     */
    public function setInvoiceDateSourceType($invoice_date_source_type)
    {
        if (is_null($invoice_date_source_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_date_source_type cannot be null');
        }
        $allowedValues = $this->getInvoiceDateSourceTypeAllowableValues();
        if (!in_array($invoice_date_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_date_source_type', must be one of '%s'",
                    $invoice_date_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_date_source_type'] = $invoice_date_source_type;

        return $this;
    }

    /**
     * Gets due_date
     *
     * @return string|null
     */
    public function getDueDate()
    {
        return $this->container['due_date'];
    }

    /**
     * Sets due_date
     *
     * @param string|null $due_date due_date
     *
     * @return self
     */
    public function setDueDate($due_date)
    {
        if (is_null($due_date)) {
            throw new \InvalidArgumentException('non-nullable due_date cannot be null');
        }
        $this->container['due_date'] = $due_date;

        return $this;
    }

    /**
     * Gets is_due
     *
     * @return bool|null
     */
    public function getIsDue()
    {
        return $this->container['is_due'];
    }

    /**
     * Sets is_due
     *
     * @param bool|null $is_due is_due
     *
     * @return self
     */
    public function setIsDue($is_due)
    {
        if (is_null($is_due)) {
            throw new \InvalidArgumentException('non-nullable is_due cannot be null');
        }
        $this->container['is_due'] = $is_due;

        return $this;
    }

    /**
     * Gets due_date_source_type
     *
     * @return string|null
     */
    public function getDueDateSourceType()
    {
        return $this->container['due_date_source_type'];
    }

    /**
     * Sets due_date_source_type
     *
     * @param string|null $due_date_source_type due_date_source_type
     *
     * @return self
     */
    public function setDueDateSourceType($due_date_source_type)
    {
        if (is_null($due_date_source_type)) {
            throw new \InvalidArgumentException('non-nullable due_date_source_type cannot be null');
        }
        $allowedValues = $this->getDueDateSourceTypeAllowableValues();
        if (!in_array($due_date_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'due_date_source_type', must be one of '%s'",
                    $due_date_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['due_date_source_type'] = $due_date_source_type;

        return $this;
    }

    /**
     * Gets supplier_name
     *
     * @return string|null
     */
    public function getSupplierName()
    {
        return $this->container['supplier_name'];
    }

    /**
     * Sets supplier_name
     *
     * @param string|null $supplier_name supplier_name
     *
     * @return self
     */
    public function setSupplierName($supplier_name)
    {
        if (is_null($supplier_name)) {
            throw new \InvalidArgumentException('non-nullable supplier_name cannot be null');
        }
        $this->container['supplier_name'] = $supplier_name;

        return $this;
    }

    /**
     * Gets supplier_source_type
     *
     * @return string|null
     */
    public function getSupplierSourceType()
    {
        return $this->container['supplier_source_type'];
    }

    /**
     * Sets supplier_source_type
     *
     * @param string|null $supplier_source_type supplier_source_type
     *
     * @return self
     */
    public function setSupplierSourceType($supplier_source_type)
    {
        if (is_null($supplier_source_type)) {
            throw new \InvalidArgumentException('non-nullable supplier_source_type cannot be null');
        }
        $allowedValues = $this->getSupplierSourceTypeAllowableValues();
        if (!in_array($supplier_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'supplier_source_type', must be one of '%s'",
                    $supplier_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['supplier_source_type'] = $supplier_source_type;

        return $this;
    }

    /**
     * Gets invoice_amount
     *
     * @return float|null
     */
    public function getInvoiceAmount()
    {
        return $this->container['invoice_amount'];
    }

    /**
     * Sets invoice_amount
     *
     * @param float|null $invoice_amount invoice_amount
     *
     * @return self
     */
    public function setInvoiceAmount($invoice_amount)
    {
        if (is_null($invoice_amount)) {
            throw new \InvalidArgumentException('non-nullable invoice_amount cannot be null');
        }
        $this->container['invoice_amount'] = $invoice_amount;

        return $this;
    }

    /**
     * Gets invoice_amount_source_type
     *
     * @return string|null
     */
    public function getInvoiceAmountSourceType()
    {
        return $this->container['invoice_amount_source_type'];
    }

    /**
     * Sets invoice_amount_source_type
     *
     * @param string|null $invoice_amount_source_type invoice_amount_source_type
     *
     * @return self
     */
    public function setInvoiceAmountSourceType($invoice_amount_source_type)
    {
        if (is_null($invoice_amount_source_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_amount_source_type cannot be null');
        }
        $allowedValues = $this->getInvoiceAmountSourceTypeAllowableValues();
        if (!in_array($invoice_amount_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_amount_source_type', must be one of '%s'",
                    $invoice_amount_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_amount_source_type'] = $invoice_amount_source_type;

        return $this;
    }

    /**
     * Gets invoice_currency
     *
     * @return string|null
     */
    public function getInvoiceCurrency()
    {
        return $this->container['invoice_currency'];
    }

    /**
     * Sets invoice_currency
     *
     * @param string|null $invoice_currency invoice_currency
     *
     * @return self
     */
    public function setInvoiceCurrency($invoice_currency)
    {
        if (is_null($invoice_currency)) {
            throw new \InvalidArgumentException('non-nullable invoice_currency cannot be null');
        }
        $this->container['invoice_currency'] = $invoice_currency;

        return $this;
    }

    /**
     * Gets invoice_currency_source_type
     *
     * @return string|null
     */
    public function getInvoiceCurrencySourceType()
    {
        return $this->container['invoice_currency_source_type'];
    }

    /**
     * Sets invoice_currency_source_type
     *
     * @param string|null $invoice_currency_source_type invoice_currency_source_type
     *
     * @return self
     */
    public function setInvoiceCurrencySourceType($invoice_currency_source_type)
    {
        if (is_null($invoice_currency_source_type)) {
            throw new \InvalidArgumentException('non-nullable invoice_currency_source_type cannot be null');
        }
        $allowedValues = $this->getInvoiceCurrencySourceTypeAllowableValues();
        if (!in_array($invoice_currency_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_currency_source_type', must be one of '%s'",
                    $invoice_currency_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_currency_source_type'] = $invoice_currency_source_type;

        return $this;
    }

    /**
     * Gets documents
     *
     * @return string[]|null
     */
    public function getDocuments()
    {
        return $this->container['documents'];
    }

    /**
     * Sets documents
     *
     * @param string[]|null $documents documents
     *
     * @return self
     */
    public function setDocuments($documents)
    {
        if (is_null($documents)) {
            throw new \InvalidArgumentException('non-nullable documents cannot be null');
        }
        $this->container['documents'] = $documents;

        return $this;
    }

    /**
     * Gets document_ids
     *
     * @return int[]|null
     */
    public function getDocumentIds()
    {
        return $this->container['document_ids'];
    }

    /**
     * Sets document_ids
     *
     * @param int[]|null $document_ids document_ids
     *
     * @return self
     */
    public function setDocumentIds($document_ids)
    {
        if (is_null($document_ids)) {
            throw new \InvalidArgumentException('non-nullable document_ids cannot be null');
        }
        $this->container['document_ids'] = $document_ids;

        return $this;
    }

    /**
     * Gets account_id
     *
     * @return int|null
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param int|null $account_id account_id
     *
     * @return self
     */
    public function setAccountId($account_id)
    {
        if (is_null($account_id)) {
            throw new \InvalidArgumentException('non-nullable account_id cannot be null');
        }
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets account
     *
     * @return string|null
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param string|null $account account
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
     * Gets account_source_type
     *
     * @return string|null
     */
    public function getAccountSourceType()
    {
        return $this->container['account_source_type'];
    }

    /**
     * Sets account_source_type
     *
     * @param string|null $account_source_type account_source_type
     *
     * @return self
     */
    public function setAccountSourceType($account_source_type)
    {
        if (is_null($account_source_type)) {
            throw new \InvalidArgumentException('non-nullable account_source_type cannot be null');
        }
        $allowedValues = $this->getAccountSourceTypeAllowableValues();
        if (!in_array($account_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'account_source_type', must be one of '%s'",
                    $account_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_source_type'] = $account_source_type;

        return $this;
    }

    /**
     * Gets vat_number
     *
     * @return string|null
     */
    public function getVatNumber()
    {
        return $this->container['vat_number'];
    }

    /**
     * Sets vat_number
     *
     * @param string|null $vat_number vat_number
     *
     * @return self
     */
    public function setVatNumber($vat_number)
    {
        if (is_null($vat_number)) {
            throw new \InvalidArgumentException('non-nullable vat_number cannot be null');
        }
        $this->container['vat_number'] = $vat_number;

        return $this;
    }

    /**
     * Gets vat_amount
     *
     * @return float|null
     */
    public function getVatAmount()
    {
        return $this->container['vat_amount'];
    }

    /**
     * Sets vat_amount
     *
     * @param float|null $vat_amount vat_amount
     *
     * @return self
     */
    public function setVatAmount($vat_amount)
    {
        if (is_null($vat_amount)) {
            throw new \InvalidArgumentException('non-nullable vat_amount cannot be null');
        }
        $this->container['vat_amount'] = $vat_amount;

        return $this;
    }

    /**
     * Gets vat_percentage
     *
     * @return float|null
     */
    public function getVatPercentage()
    {
        return $this->container['vat_percentage'];
    }

    /**
     * Sets vat_percentage
     *
     * @param float|null $vat_percentage vat_percentage
     *
     * @return self
     */
    public function setVatPercentage($vat_percentage)
    {
        if (is_null($vat_percentage)) {
            throw new \InvalidArgumentException('non-nullable vat_percentage cannot be null');
        }
        $this->container['vat_percentage'] = $vat_percentage;

        return $this;
    }

    /**
     * Gets vat_source_type
     *
     * @return string|null
     */
    public function getVatSourceType()
    {
        return $this->container['vat_source_type'];
    }

    /**
     * Sets vat_source_type
     *
     * @param string|null $vat_source_type vat_source_type
     *
     * @return self
     */
    public function setVatSourceType($vat_source_type)
    {
        if (is_null($vat_source_type)) {
            throw new \InvalidArgumentException('non-nullable vat_source_type cannot be null');
        }
        $allowedValues = $this->getVatSourceTypeAllowableValues();
        if (!in_array($vat_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'vat_source_type', must be one of '%s'",
                    $vat_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['vat_source_type'] = $vat_source_type;

        return $this;
    }

    /**
     * Gets department_id
     *
     * @return int|null
     */
    public function getDepartmentId()
    {
        return $this->container['department_id'];
    }

    /**
     * Sets department_id
     *
     * @param int|null $department_id department_id
     *
     * @return self
     */
    public function setDepartmentId($department_id)
    {
        if (is_null($department_id)) {
            throw new \InvalidArgumentException('non-nullable department_id cannot be null');
        }
        $this->container['department_id'] = $department_id;

        return $this;
    }

    /**
     * Gets project_id
     *
     * @return int|null
     */
    public function getProjectId()
    {
        return $this->container['project_id'];
    }

    /**
     * Sets project_id
     *
     * @param int|null $project_id project_id
     *
     * @return self
     */
    public function setProjectId($project_id)
    {
        if (is_null($project_id)) {
            throw new \InvalidArgumentException('non-nullable project_id cannot be null');
        }
        $this->container['project_id'] = $project_id;

        return $this;
    }

    /**
     * Gets project
     *
     * @return string|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param string|null $project project
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
     * Gets project_source_type
     *
     * @return string|null
     */
    public function getProjectSourceType()
    {
        return $this->container['project_source_type'];
    }

    /**
     * Sets project_source_type
     *
     * @param string|null $project_source_type project_source_type
     *
     * @return self
     */
    public function setProjectSourceType($project_source_type)
    {
        if (is_null($project_source_type)) {
            throw new \InvalidArgumentException('non-nullable project_source_type cannot be null');
        }
        $allowedValues = $this->getProjectSourceTypeAllowableValues();
        if (!in_array($project_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_source_type', must be one of '%s'",
                    $project_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_source_type'] = $project_source_type;

        return $this;
    }

    /**
     * Gets department
     *
     * @return string|null
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param string|null $department department
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
     * Gets department_source_type
     *
     * @return string|null
     */
    public function getDepartmentSourceType()
    {
        return $this->container['department_source_type'];
    }

    /**
     * Sets department_source_type
     *
     * @param string|null $department_source_type department_source_type
     *
     * @return self
     */
    public function setDepartmentSourceType($department_source_type)
    {
        if (is_null($department_source_type)) {
            throw new \InvalidArgumentException('non-nullable department_source_type cannot be null');
        }
        $allowedValues = $this->getDepartmentSourceTypeAllowableValues();
        if (!in_array($department_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'department_source_type', must be one of '%s'",
                    $department_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['department_source_type'] = $department_source_type;

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
     * @param int|null $payment_type_id payment_type_id
     *
     * @return self
     */
    public function setPaymentTypeId($payment_type_id)
    {
        if (is_null($payment_type_id)) {
            throw new \InvalidArgumentException('non-nullable payment_type_id cannot be null');
        }
        $this->container['payment_type_id'] = $payment_type_id;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string|null $payment_type payment_type
     *
     * @return self
     */
    public function setPaymentType($payment_type)
    {
        if (is_null($payment_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type cannot be null');
        }
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets payment_type_source_type
     *
     * @return string|null
     */
    public function getPaymentTypeSourceType()
    {
        return $this->container['payment_type_source_type'];
    }

    /**
     * Sets payment_type_source_type
     *
     * @param string|null $payment_type_source_type payment_type_source_type
     *
     * @return self
     */
    public function setPaymentTypeSourceType($payment_type_source_type)
    {
        if (is_null($payment_type_source_type)) {
            throw new \InvalidArgumentException('non-nullable payment_type_source_type cannot be null');
        }
        $allowedValues = $this->getPaymentTypeSourceTypeAllowableValues();
        if (!in_array($payment_type_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_type_source_type', must be one of '%s'",
                    $payment_type_source_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_type_source_type'] = $payment_type_source_type;

        return $this;
    }

    /**
     * Gets import_failure_reason
     *
     * @return string|null
     */
    public function getImportFailureReason()
    {
        return $this->container['import_failure_reason'];
    }

    /**
     * Sets import_failure_reason
     *
     * @param string|null $import_failure_reason import_failure_reason
     *
     * @return self
     */
    public function setImportFailureReason($import_failure_reason)
    {
        if (is_null($import_failure_reason)) {
            throw new \InvalidArgumentException('non-nullable import_failure_reason cannot be null');
        }
        $this->container['import_failure_reason'] = $import_failure_reason;

        return $this;
    }

    /**
     * Gets accounting_period
     *
     * @return string|null
     */
    public function getAccountingPeriod()
    {
        return $this->container['accounting_period'];
    }

    /**
     * Sets accounting_period
     *
     * @param string|null $accounting_period accounting_period
     *
     * @return self
     */
    public function setAccountingPeriod($accounting_period)
    {
        if (is_null($accounting_period)) {
            throw new \InvalidArgumentException('non-nullable accounting_period cannot be null');
        }
        $this->container['accounting_period'] = $accounting_period;

        return $this;
    }

    /**
     * Gets filename
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->container['filename'];
    }

    /**
     * Sets filename
     *
     * @param string|null $filename filename
     *
     * @return self
     */
    public function setFilename($filename)
    {
        if (is_null($filename)) {
            throw new \InvalidArgumentException('non-nullable filename cannot be null');
        }
        $this->container['filename'] = $filename;

        return $this;
    }

    /**
     * Gets is_temporary
     *
     * @return bool|null
     */
    public function getIsTemporary()
    {
        return $this->container['is_temporary'];
    }

    /**
     * Sets is_temporary
     *
     * @param bool|null $is_temporary is_temporary
     *
     * @return self
     */
    public function setIsTemporary($is_temporary)
    {
        if (is_null($is_temporary)) {
            throw new \InvalidArgumentException('non-nullable is_temporary cannot be null');
        }
        $this->container['is_temporary'] = $is_temporary;

        return $this;
    }

    /**
     * Gets is_invoice_simple
     *
     * @return bool|null
     */
    public function getIsInvoiceSimple()
    {
        return $this->container['is_invoice_simple'];
    }

    /**
     * Sets is_invoice_simple
     *
     * @param bool|null $is_invoice_simple is_invoice_simple
     *
     * @return self
     */
    public function setIsInvoiceSimple($is_invoice_simple)
    {
        if (is_null($is_invoice_simple)) {
            throw new \InvalidArgumentException('non-nullable is_invoice_simple cannot be null');
        }
        $this->container['is_invoice_simple'] = $is_invoice_simple;

        return $this;
    }

    /**
     * Gets is_invoice_detailed
     *
     * @return bool|null
     */
    public function getIsInvoiceDetailed()
    {
        return $this->container['is_invoice_detailed'];
    }

    /**
     * Sets is_invoice_detailed
     *
     * @param bool|null $is_invoice_detailed is_invoice_detailed
     *
     * @return self
     */
    public function setIsInvoiceDetailed($is_invoice_detailed)
    {
        if (is_null($is_invoice_detailed)) {
            throw new \InvalidArgumentException('non-nullable is_invoice_detailed cannot be null');
        }
        $this->container['is_invoice_detailed'] = $is_invoice_detailed;

        return $this;
    }

    /**
     * Gets has_predictions
     *
     * @return bool|null
     */
    public function getHasPredictions()
    {
        return $this->container['has_predictions'];
    }

    /**
     * Sets has_predictions
     *
     * @param bool|null $has_predictions Has one or more predictions from FabricAi
     *
     * @return self
     */
    public function setHasPredictions($has_predictions)
    {
        if (is_null($has_predictions)) {
            throw new \InvalidArgumentException('non-nullable has_predictions cannot be null');
        }
        $this->container['has_predictions'] = $has_predictions;

        return $this;
    }

    /**
     * Gets has_smart_scan_suggestions
     *
     * @return bool|null
     */
    public function getHasSmartScanSuggestions()
    {
        return $this->container['has_smart_scan_suggestions'];
    }

    /**
     * Sets has_smart_scan_suggestions
     *
     * @param bool|null $has_smart_scan_suggestions Has one or more suggestions from SmartScan
     *
     * @return self
     */
    public function setHasSmartScanSuggestions($has_smart_scan_suggestions)
    {
        if (is_null($has_smart_scan_suggestions)) {
            throw new \InvalidArgumentException('non-nullable has_smart_scan_suggestions cannot be null');
        }
        $this->container['has_smart_scan_suggestions'] = $has_smart_scan_suggestions;

        return $this;
    }

    /**
     * Gets is_locked
     *
     * @return bool|null
     */
    public function getIsLocked()
    {
        return $this->container['is_locked'];
    }

    /**
     * Sets is_locked
     *
     * @param bool|null $is_locked Is voucher locked for change by external integration
     *
     * @return self
     */
    public function setIsLocked($is_locked)
    {
        if (is_null($is_locked)) {
            throw new \InvalidArgumentException('non-nullable is_locked cannot be null');
        }
        $this->container['is_locked'] = $is_locked;

        return $this;
    }

    /**
     * Gets comment_count
     *
     * @return int|null
     */
    public function getCommentCount()
    {
        return $this->container['comment_count'];
    }

    /**
     * Sets comment_count
     *
     * @param int|null $comment_count comment_count
     *
     * @return self
     */
    public function setCommentCount($comment_count)
    {
        if (is_null($comment_count)) {
            throw new \InvalidArgumentException('non-nullable comment_count cannot be null');
        }
        $this->container['comment_count'] = $comment_count;

        return $this;
    }

    /**
     * Gets non_automation_reason
     *
     * @return string|null
     */
    public function getNonAutomationReason()
    {
        return $this->container['non_automation_reason'];
    }

    /**
     * Sets non_automation_reason
     *
     * @param string|null $non_automation_reason non_automation_reason
     *
     * @return self
     */
    public function setNonAutomationReason($non_automation_reason)
    {
        if (is_null($non_automation_reason)) {
            throw new \InvalidArgumentException('non-nullable non_automation_reason cannot be null');
        }
        $this->container['non_automation_reason'] = $non_automation_reason;

        return $this;
    }

    /**
     * Gets can_be_sent_to_ledger
     *
     * @return bool|null
     */
    public function getCanBeSentToLedger()
    {
        return $this->container['can_be_sent_to_ledger'];
    }

    /**
     * Sets can_be_sent_to_ledger
     *
     * @param bool|null $can_be_sent_to_ledger Possible to do one click 'Send to ledger'
     *
     * @return self
     */
    public function setCanBeSentToLedger($can_be_sent_to_ledger)
    {
        if (is_null($can_be_sent_to_ledger)) {
            throw new \InvalidArgumentException('non-nullable can_be_sent_to_ledger cannot be null');
        }
        $this->container['can_be_sent_to_ledger'] = $can_be_sent_to_ledger;

        return $this;
    }

    /**
     * Gets can_be_registered_as_changed
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsChanged()
    {
        return $this->container['can_be_registered_as_changed'];
    }

    /**
     * Sets can_be_registered_as_changed
     *
     * @param bool|null $can_be_registered_as_changed Possible to do one click 'Send to ledger'
     *
     * @return self
     */
    public function setCanBeRegisteredAsChanged($can_be_registered_as_changed)
    {
        if (is_null($can_be_registered_as_changed)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_changed cannot be null');
        }
        $this->container['can_be_registered_as_changed'] = $can_be_registered_as_changed;

        return $this;
    }

    /**
     * Gets can_be_registered_as_simple_invoice
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsSimpleInvoice()
    {
        return $this->container['can_be_registered_as_simple_invoice'];
    }

    /**
     * Sets can_be_registered_as_simple_invoice
     *
     * @param bool|null $can_be_registered_as_simple_invoice can_be_registered_as_simple_invoice
     *
     * @return self
     */
    public function setCanBeRegisteredAsSimpleInvoice($can_be_registered_as_simple_invoice)
    {
        if (is_null($can_be_registered_as_simple_invoice)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_simple_invoice cannot be null');
        }
        $this->container['can_be_registered_as_simple_invoice'] = $can_be_registered_as_simple_invoice;

        return $this;
    }

    /**
     * Gets can_be_registered_as_detailed_invoice
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsDetailedInvoice()
    {
        return $this->container['can_be_registered_as_detailed_invoice'];
    }

    /**
     * Sets can_be_registered_as_detailed_invoice
     *
     * @param bool|null $can_be_registered_as_detailed_invoice can_be_registered_as_detailed_invoice
     *
     * @return self
     */
    public function setCanBeRegisteredAsDetailedInvoice($can_be_registered_as_detailed_invoice)
    {
        if (is_null($can_be_registered_as_detailed_invoice)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_detailed_invoice cannot be null');
        }
        $this->container['can_be_registered_as_detailed_invoice'] = $can_be_registered_as_detailed_invoice;

        return $this;
    }

    /**
     * Gets can_be_registered_as_bank_reconciliation
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsBankReconciliation()
    {
        return $this->container['can_be_registered_as_bank_reconciliation'];
    }

    /**
     * Sets can_be_registered_as_bank_reconciliation
     *
     * @param bool|null $can_be_registered_as_bank_reconciliation can_be_registered_as_bank_reconciliation
     *
     * @return self
     */
    public function setCanBeRegisteredAsBankReconciliation($can_be_registered_as_bank_reconciliation)
    {
        if (is_null($can_be_registered_as_bank_reconciliation)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_bank_reconciliation cannot be null');
        }
        $this->container['can_be_registered_as_bank_reconciliation'] = $can_be_registered_as_bank_reconciliation;

        return $this;
    }

    /**
     * Gets can_be_registered_as_payment_in
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsPaymentIn()
    {
        return $this->container['can_be_registered_as_payment_in'];
    }

    /**
     * Sets can_be_registered_as_payment_in
     *
     * @param bool|null $can_be_registered_as_payment_in can_be_registered_as_payment_in
     *
     * @return self
     */
    public function setCanBeRegisteredAsPaymentIn($can_be_registered_as_payment_in)
    {
        if (is_null($can_be_registered_as_payment_in)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_payment_in cannot be null');
        }
        $this->container['can_be_registered_as_payment_in'] = $can_be_registered_as_payment_in;

        return $this;
    }

    /**
     * Gets can_be_registered_as_income
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsIncome()
    {
        return $this->container['can_be_registered_as_income'];
    }

    /**
     * Sets can_be_registered_as_income
     *
     * @param bool|null $can_be_registered_as_income can_be_registered_as_income
     *
     * @return self
     */
    public function setCanBeRegisteredAsIncome($can_be_registered_as_income)
    {
        if (is_null($can_be_registered_as_income)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_income cannot be null');
        }
        $this->container['can_be_registered_as_income'] = $can_be_registered_as_income;

        return $this;
    }

    /**
     * Gets can_be_registered_as_customs_declaration
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsCustomsDeclaration()
    {
        return $this->container['can_be_registered_as_customs_declaration'];
    }

    /**
     * Sets can_be_registered_as_customs_declaration
     *
     * @param bool|null $can_be_registered_as_customs_declaration can_be_registered_as_customs_declaration
     *
     * @return self
     */
    public function setCanBeRegisteredAsCustomsDeclaration($can_be_registered_as_customs_declaration)
    {
        if (is_null($can_be_registered_as_customs_declaration)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_customs_declaration cannot be null');
        }
        $this->container['can_be_registered_as_customs_declaration'] = $can_be_registered_as_customs_declaration;

        return $this;
    }

    /**
     * Gets can_be_registered_as_advanced
     *
     * @return bool|null
     */
    public function getCanBeRegisteredAsAdvanced()
    {
        return $this->container['can_be_registered_as_advanced'];
    }

    /**
     * Sets can_be_registered_as_advanced
     *
     * @param bool|null $can_be_registered_as_advanced can_be_registered_as_advanced
     *
     * @return self
     */
    public function setCanBeRegisteredAsAdvanced($can_be_registered_as_advanced)
    {
        if (is_null($can_be_registered_as_advanced)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_as_advanced cannot be null');
        }
        $this->container['can_be_registered_as_advanced'] = $can_be_registered_as_advanced;

        return $this;
    }

    /**
     * Gets can_be_sent_to_accountant
     *
     * @return bool|null
     */
    public function getCanBeSentToAccountant()
    {
        return $this->container['can_be_sent_to_accountant'];
    }

    /**
     * Sets can_be_sent_to_accountant
     *
     * @param bool|null $can_be_sent_to_accountant can_be_sent_to_accountant
     *
     * @return self
     */
    public function setCanBeSentToAccountant($can_be_sent_to_accountant)
    {
        if (is_null($can_be_sent_to_accountant)) {
            throw new \InvalidArgumentException('non-nullable can_be_sent_to_accountant cannot be null');
        }
        $this->container['can_be_sent_to_accountant'] = $can_be_sent_to_accountant;

        return $this;
    }

    /**
     * Gets can_be_sent_to_archive
     *
     * @return bool|null
     */
    public function getCanBeSentToArchive()
    {
        return $this->container['can_be_sent_to_archive'];
    }

    /**
     * Sets can_be_sent_to_archive
     *
     * @param bool|null $can_be_sent_to_archive can_be_sent_to_archive
     *
     * @return self
     */
    public function setCanBeSentToArchive($can_be_sent_to_archive)
    {
        if (is_null($can_be_sent_to_archive)) {
            throw new \InvalidArgumentException('non-nullable can_be_sent_to_archive cannot be null');
        }
        $this->container['can_be_sent_to_archive'] = $can_be_sent_to_archive;

        return $this;
    }

    /**
     * Gets can_be_deleted
     *
     * @return bool|null
     */
    public function getCanBeDeleted()
    {
        return $this->container['can_be_deleted'];
    }

    /**
     * Sets can_be_deleted
     *
     * @param bool|null $can_be_deleted can_be_deleted
     *
     * @return self
     */
    public function setCanBeDeleted($can_be_deleted)
    {
        if (is_null($can_be_deleted)) {
            throw new \InvalidArgumentException('non-nullable can_be_deleted cannot be null');
        }
        $this->container['can_be_deleted'] = $can_be_deleted;

        return $this;
    }

    /**
     * Gets can_be_registered_in_queue
     *
     * @return bool|null
     */
    public function getCanBeRegisteredInQueue()
    {
        return $this->container['can_be_registered_in_queue'];
    }

    /**
     * Sets can_be_registered_in_queue
     *
     * @param bool|null $can_be_registered_in_queue can_be_registered_in_queue
     *
     * @return self
     */
    public function setCanBeRegisteredInQueue($can_be_registered_in_queue)
    {
        if (is_null($can_be_registered_in_queue)) {
            throw new \InvalidArgumentException('non-nullable can_be_registered_in_queue cannot be null');
        }
        $this->container['can_be_registered_in_queue'] = $can_be_registered_in_queue;

        return $this;
    }

    /**
     * Gets can_be_merged
     *
     * @return bool|null
     */
    public function getCanBeMerged()
    {
        return $this->container['can_be_merged'];
    }

    /**
     * Sets can_be_merged
     *
     * @param bool|null $can_be_merged can_be_merged
     *
     * @return self
     */
    public function setCanBeMerged($can_be_merged)
    {
        if (is_null($can_be_merged)) {
            throw new \InvalidArgumentException('non-nullable can_be_merged cannot be null');
        }
        $this->container['can_be_merged'] = $can_be_merged;

        return $this;
    }

    /**
     * Gets allow_posting_before_voucher_approved
     *
     * @return bool|null
     */
    public function getAllowPostingBeforeVoucherApproved()
    {
        return $this->container['allow_posting_before_voucher_approved'];
    }

    /**
     * Sets allow_posting_before_voucher_approved
     *
     * @param bool|null $allow_posting_before_voucher_approved allow_posting_before_voucher_approved
     *
     * @return self
     */
    public function setAllowPostingBeforeVoucherApproved($allow_posting_before_voucher_approved)
    {
        if (is_null($allow_posting_before_voucher_approved)) {
            throw new \InvalidArgumentException('non-nullable allow_posting_before_voucher_approved cannot be null');
        }
        $this->container['allow_posting_before_voucher_approved'] = $allow_posting_before_voucher_approved;

        return $this;
    }

    /**
     * Gets sender_email_address
     *
     * @return string|null
     */
    public function getSenderEmailAddress()
    {
        return $this->container['sender_email_address'];
    }

    /**
     * Sets sender_email_address
     *
     * @param string|null $sender_email_address sender_email_address
     *
     * @return self
     */
    public function setSenderEmailAddress($sender_email_address)
    {
        if (is_null($sender_email_address)) {
            throw new \InvalidArgumentException('non-nullable sender_email_address cannot be null');
        }
        $this->container['sender_email_address'] = $sender_email_address;

        return $this;
    }

    /**
     * Gets is_spam
     *
     * @return bool|null
     */
    public function getIsSpam()
    {
        return $this->container['is_spam'];
    }

    /**
     * Sets is_spam
     *
     * @param bool|null $is_spam is_spam
     *
     * @return self
     */
    public function setIsSpam($is_spam)
    {
        if (is_null($is_spam)) {
            throw new \InvalidArgumentException('non-nullable is_spam cannot be null');
        }
        $this->container['is_spam'] = $is_spam;

        return $this;
    }

    /**
     * Gets email_arrival_time
     *
     * @return string|null
     */
    public function getEmailArrivalTime()
    {
        return $this->container['email_arrival_time'];
    }

    /**
     * Sets email_arrival_time
     *
     * @param string|null $email_arrival_time email_arrival_time
     *
     * @return self
     */
    public function setEmailArrivalTime($email_arrival_time)
    {
        if (is_null($email_arrival_time)) {
            throw new \InvalidArgumentException('non-nullable email_arrival_time cannot be null');
        }
        $this->container['email_arrival_time'] = $email_arrival_time;

        return $this;
    }

    /**
     * Gets spam_report_for_display
     *
     * @return string|null
     */
    public function getSpamReportForDisplay()
    {
        return $this->container['spam_report_for_display'];
    }

    /**
     * Sets spam_report_for_display
     *
     * @param string|null $spam_report_for_display spam_report_for_display
     *
     * @return self
     */
    public function setSpamReportForDisplay($spam_report_for_display)
    {
        if (is_null($spam_report_for_display)) {
            throw new \InvalidArgumentException('non-nullable spam_report_for_display cannot be null');
        }
        $this->container['spam_report_for_display'] = $spam_report_for_display;

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


