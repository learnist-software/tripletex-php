<?php
/**
 * VoucherInboxItem
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
 * VoucherInboxItem Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class VoucherInboxItem implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'VoucherInboxItem';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'spam_report_for_display' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'spam_report_for_display' => null    ];

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
'spam_report_for_display' => 'spamReportForDisplay'    ];

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
'spam_report_for_display' => 'setSpamReportForDisplay'    ];

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
'spam_report_for_display' => 'getSpamReportForDisplay'    ];

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

    const TYPE_UNKNOWN = 'UNKNOWN';
const TYPE_INVOICE = 'INVOICE';
const TYPE_ERROR_EHF_IMPORT = 'ERROR_EHF_IMPORT';
const TYPE_REPLAYABLE_VOUCHER = 'REPLAYABLE_VOUCHER';
const TYPE_REMINDER_SPECIFICATION = 'REMINDER_SPECIFICATION';
const TYPE_CREDITNOTE = 'CREDITNOTE';
const TYPE_RECEIPT = 'RECEIPT';
const INVOICE_TYPE_UNKNOWN = 'UNKNOWN';
const INVOICE_TYPE_PDF = 'PDF';
const INVOICE_TYPE_EHF = 'EHF';
const INVOICE_TYPE_EFO_NELFO = 'EFO_NELFO';
const INVOICE_DATE_SOURCE_TYPE_NONE = 'NONE';
const INVOICE_DATE_SOURCE_TYPE_EDI = 'EDI';
const INVOICE_DATE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const INVOICE_DATE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const INVOICE_DATE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const DUE_DATE_SOURCE_TYPE_NONE = 'NONE';
const DUE_DATE_SOURCE_TYPE_EDI = 'EDI';
const DUE_DATE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const DUE_DATE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const DUE_DATE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const SUPPLIER_SOURCE_TYPE_NONE = 'NONE';
const SUPPLIER_SOURCE_TYPE_EDI = 'EDI';
const SUPPLIER_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const SUPPLIER_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const SUPPLIER_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const INVOICE_AMOUNT_SOURCE_TYPE_NONE = 'NONE';
const INVOICE_AMOUNT_SOURCE_TYPE_EDI = 'EDI';
const INVOICE_AMOUNT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const INVOICE_AMOUNT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const INVOICE_AMOUNT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const INVOICE_CURRENCY_SOURCE_TYPE_NONE = 'NONE';
const INVOICE_CURRENCY_SOURCE_TYPE_EDI = 'EDI';
const INVOICE_CURRENCY_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const INVOICE_CURRENCY_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const INVOICE_CURRENCY_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const ACCOUNT_SOURCE_TYPE_NONE = 'NONE';
const ACCOUNT_SOURCE_TYPE_EDI = 'EDI';
const ACCOUNT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const ACCOUNT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const ACCOUNT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const VAT_SOURCE_TYPE_NONE = 'NONE';
const VAT_SOURCE_TYPE_EDI = 'EDI';
const VAT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const VAT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const VAT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const PROJECT_SOURCE_TYPE_NONE = 'NONE';
const PROJECT_SOURCE_TYPE_EDI = 'EDI';
const PROJECT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const PROJECT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const PROJECT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const DEPARTMENT_SOURCE_TYPE_NONE = 'NONE';
const DEPARTMENT_SOURCE_TYPE_EDI = 'EDI';
const DEPARTMENT_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const DEPARTMENT_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const DEPARTMENT_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';
const PAYMENT_TYPE_SOURCE_TYPE_NONE = 'NONE';
const PAYMENT_TYPE_SOURCE_TYPE_EDI = 'EDI';
const PAYMENT_TYPE_SOURCE_TYPE_SMART_SCAN = 'SMART_SCAN';
const PAYMENT_TYPE_SOURCE_TYPE_FABRIC_AI = 'FABRIC_AI';
const PAYMENT_TYPE_SOURCE_TYPE_LAST_VOUCHER = 'LAST_VOUCHER';

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
self::TYPE_RECEIPT,        ];
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
self::INVOICE_TYPE_EFO_NELFO,        ];
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
self::INVOICE_DATE_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::DUE_DATE_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::SUPPLIER_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::INVOICE_AMOUNT_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::INVOICE_CURRENCY_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::ACCOUNT_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::VAT_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::PROJECT_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::DEPARTMENT_SOURCE_TYPE_LAST_VOUCHER,        ];
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
self::PAYMENT_TYPE_SOURCE_TYPE_LAST_VOUCHER,        ];
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
        $this->container['company_id'] = isset($data['company_id']) ? $data['company_id'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['received_date'] = isset($data['received_date']) ? $data['received_date'] : null;
        $this->container['voucher_id'] = isset($data['voucher_id']) ? $data['voucher_id'] : null;
        $this->container['invoice_id'] = isset($data['invoice_id']) ? $data['invoice_id'] : null;
        $this->container['invoice_type'] = isset($data['invoice_type']) ? $data['invoice_type'] : null;
        $this->container['last_comment'] = isset($data['last_comment']) ? $data['last_comment'] : null;
        $this->container['invoice_date'] = isset($data['invoice_date']) ? $data['invoice_date'] : null;
        $this->container['invoice_date_source_type'] = isset($data['invoice_date_source_type']) ? $data['invoice_date_source_type'] : null;
        $this->container['due_date'] = isset($data['due_date']) ? $data['due_date'] : null;
        $this->container['is_due'] = isset($data['is_due']) ? $data['is_due'] : null;
        $this->container['due_date_source_type'] = isset($data['due_date_source_type']) ? $data['due_date_source_type'] : null;
        $this->container['supplier_name'] = isset($data['supplier_name']) ? $data['supplier_name'] : null;
        $this->container['supplier_source_type'] = isset($data['supplier_source_type']) ? $data['supplier_source_type'] : null;
        $this->container['invoice_amount'] = isset($data['invoice_amount']) ? $data['invoice_amount'] : null;
        $this->container['invoice_amount_source_type'] = isset($data['invoice_amount_source_type']) ? $data['invoice_amount_source_type'] : null;
        $this->container['invoice_currency'] = isset($data['invoice_currency']) ? $data['invoice_currency'] : null;
        $this->container['invoice_currency_source_type'] = isset($data['invoice_currency_source_type']) ? $data['invoice_currency_source_type'] : null;
        $this->container['documents'] = isset($data['documents']) ? $data['documents'] : null;
        $this->container['document_ids'] = isset($data['document_ids']) ? $data['document_ids'] : null;
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['account'] = isset($data['account']) ? $data['account'] : null;
        $this->container['account_source_type'] = isset($data['account_source_type']) ? $data['account_source_type'] : null;
        $this->container['vat_number'] = isset($data['vat_number']) ? $data['vat_number'] : null;
        $this->container['vat_amount'] = isset($data['vat_amount']) ? $data['vat_amount'] : null;
        $this->container['vat_percentage'] = isset($data['vat_percentage']) ? $data['vat_percentage'] : null;
        $this->container['vat_source_type'] = isset($data['vat_source_type']) ? $data['vat_source_type'] : null;
        $this->container['department_id'] = isset($data['department_id']) ? $data['department_id'] : null;
        $this->container['project_id'] = isset($data['project_id']) ? $data['project_id'] : null;
        $this->container['project'] = isset($data['project']) ? $data['project'] : null;
        $this->container['project_source_type'] = isset($data['project_source_type']) ? $data['project_source_type'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['department_source_type'] = isset($data['department_source_type']) ? $data['department_source_type'] : null;
        $this->container['payment_type_id'] = isset($data['payment_type_id']) ? $data['payment_type_id'] : null;
        $this->container['payment_type'] = isset($data['payment_type']) ? $data['payment_type'] : null;
        $this->container['payment_type_source_type'] = isset($data['payment_type_source_type']) ? $data['payment_type_source_type'] : null;
        $this->container['import_failure_reason'] = isset($data['import_failure_reason']) ? $data['import_failure_reason'] : null;
        $this->container['accounting_period'] = isset($data['accounting_period']) ? $data['accounting_period'] : null;
        $this->container['filename'] = isset($data['filename']) ? $data['filename'] : null;
        $this->container['is_temporary'] = isset($data['is_temporary']) ? $data['is_temporary'] : null;
        $this->container['is_invoice_simple'] = isset($data['is_invoice_simple']) ? $data['is_invoice_simple'] : null;
        $this->container['is_invoice_detailed'] = isset($data['is_invoice_detailed']) ? $data['is_invoice_detailed'] : null;
        $this->container['has_predictions'] = isset($data['has_predictions']) ? $data['has_predictions'] : null;
        $this->container['has_smart_scan_suggestions'] = isset($data['has_smart_scan_suggestions']) ? $data['has_smart_scan_suggestions'] : null;
        $this->container['is_locked'] = isset($data['is_locked']) ? $data['is_locked'] : null;
        $this->container['comment_count'] = isset($data['comment_count']) ? $data['comment_count'] : null;
        $this->container['non_automation_reason'] = isset($data['non_automation_reason']) ? $data['non_automation_reason'] : null;
        $this->container['can_be_sent_to_ledger'] = isset($data['can_be_sent_to_ledger']) ? $data['can_be_sent_to_ledger'] : null;
        $this->container['can_be_registered_as_changed'] = isset($data['can_be_registered_as_changed']) ? $data['can_be_registered_as_changed'] : null;
        $this->container['can_be_registered_as_simple_invoice'] = isset($data['can_be_registered_as_simple_invoice']) ? $data['can_be_registered_as_simple_invoice'] : null;
        $this->container['can_be_registered_as_detailed_invoice'] = isset($data['can_be_registered_as_detailed_invoice']) ? $data['can_be_registered_as_detailed_invoice'] : null;
        $this->container['can_be_registered_as_bank_reconciliation'] = isset($data['can_be_registered_as_bank_reconciliation']) ? $data['can_be_registered_as_bank_reconciliation'] : null;
        $this->container['can_be_registered_as_payment_in'] = isset($data['can_be_registered_as_payment_in']) ? $data['can_be_registered_as_payment_in'] : null;
        $this->container['can_be_registered_as_income'] = isset($data['can_be_registered_as_income']) ? $data['can_be_registered_as_income'] : null;
        $this->container['can_be_registered_as_customs_declaration'] = isset($data['can_be_registered_as_customs_declaration']) ? $data['can_be_registered_as_customs_declaration'] : null;
        $this->container['can_be_registered_as_advanced'] = isset($data['can_be_registered_as_advanced']) ? $data['can_be_registered_as_advanced'] : null;
        $this->container['can_be_sent_to_accountant'] = isset($data['can_be_sent_to_accountant']) ? $data['can_be_sent_to_accountant'] : null;
        $this->container['can_be_sent_to_archive'] = isset($data['can_be_sent_to_archive']) ? $data['can_be_sent_to_archive'] : null;
        $this->container['can_be_deleted'] = isset($data['can_be_deleted']) ? $data['can_be_deleted'] : null;
        $this->container['can_be_registered_in_queue'] = isset($data['can_be_registered_in_queue']) ? $data['can_be_registered_in_queue'] : null;
        $this->container['can_be_merged'] = isset($data['can_be_merged']) ? $data['can_be_merged'] : null;
        $this->container['allow_posting_before_voucher_approved'] = isset($data['allow_posting_before_voucher_approved']) ? $data['allow_posting_before_voucher_approved'] : null;
        $this->container['sender_email_address'] = isset($data['sender_email_address']) ? $data['sender_email_address'] : null;
        $this->container['is_spam'] = isset($data['is_spam']) ? $data['is_spam'] : null;
        $this->container['email_arrival_time'] = isset($data['email_arrival_time']) ? $data['email_arrival_time'] : null;
        $this->container['spam_report_for_display'] = isset($data['spam_report_for_display']) ? $data['spam_report_for_display'] : null;
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

        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($this->container['invoice_type']) && !in_array($this->container['invoice_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceDateSourceTypeAllowableValues();
        if (!is_null($this->container['invoice_date_source_type']) && !in_array($this->container['invoice_date_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_date_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDueDateSourceTypeAllowableValues();
        if (!is_null($this->container['due_date_source_type']) && !in_array($this->container['due_date_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'due_date_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getSupplierSourceTypeAllowableValues();
        if (!is_null($this->container['supplier_source_type']) && !in_array($this->container['supplier_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'supplier_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceAmountSourceTypeAllowableValues();
        if (!is_null($this->container['invoice_amount_source_type']) && !in_array($this->container['invoice_amount_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_amount_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceCurrencySourceTypeAllowableValues();
        if (!is_null($this->container['invoice_currency_source_type']) && !in_array($this->container['invoice_currency_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_currency_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAccountSourceTypeAllowableValues();
        if (!is_null($this->container['account_source_type']) && !in_array($this->container['account_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'account_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVatSourceTypeAllowableValues();
        if (!is_null($this->container['vat_source_type']) && !in_array($this->container['vat_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'vat_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getProjectSourceTypeAllowableValues();
        if (!is_null($this->container['project_source_type']) && !in_array($this->container['project_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'project_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getDepartmentSourceTypeAllowableValues();
        if (!is_null($this->container['department_source_type']) && !in_array($this->container['department_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'department_source_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getPaymentTypeSourceTypeAllowableValues();
        if (!is_null($this->container['payment_type_source_type']) && !in_array($this->container['payment_type_source_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'payment_type_source_type', must be one of '%s'",
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
     * Gets company_id
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id
     *
     * @param int $company_id company_id
     *
     * @return $this
     */
    public function setCompanyId($company_id)
    {
        $this->container['company_id'] = $company_id;

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
     * Gets received_date
     *
     * @return string
     */
    public function getReceivedDate()
    {
        return $this->container['received_date'];
    }

    /**
     * Sets received_date
     *
     * @param string $received_date received_date
     *
     * @return $this
     */
    public function setReceivedDate($received_date)
    {
        $this->container['received_date'] = $received_date;

        return $this;
    }

    /**
     * Gets voucher_id
     *
     * @return int
     */
    public function getVoucherId()
    {
        return $this->container['voucher_id'];
    }

    /**
     * Sets voucher_id
     *
     * @param int $voucher_id voucher_id
     *
     * @return $this
     */
    public function setVoucherId($voucher_id)
    {
        $this->container['voucher_id'] = $voucher_id;

        return $this;
    }

    /**
     * Gets invoice_id
     *
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->container['invoice_id'];
    }

    /**
     * Sets invoice_id
     *
     * @param int $invoice_id invoice_id
     *
     * @return $this
     */
    public function setInvoiceId($invoice_id)
    {
        $this->container['invoice_id'] = $invoice_id;

        return $this;
    }

    /**
     * Gets invoice_type
     *
     * @return string
     */
    public function getInvoiceType()
    {
        return $this->container['invoice_type'];
    }

    /**
     * Sets invoice_type
     *
     * @param string $invoice_type invoice_type
     *
     * @return $this
     */
    public function setInvoiceType($invoice_type)
    {
        $allowedValues = $this->getInvoiceTypeAllowableValues();
        if (!is_null($invoice_type) && !in_array($invoice_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_type', must be one of '%s'",
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
     * @return string
     */
    public function getLastComment()
    {
        return $this->container['last_comment'];
    }

    /**
     * Sets last_comment
     *
     * @param string $last_comment last_comment
     *
     * @return $this
     */
    public function setLastComment($last_comment)
    {
        $this->container['last_comment'] = $last_comment;

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
     * Gets invoice_date_source_type
     *
     * @return string
     */
    public function getInvoiceDateSourceType()
    {
        return $this->container['invoice_date_source_type'];
    }

    /**
     * Sets invoice_date_source_type
     *
     * @param string $invoice_date_source_type invoice_date_source_type
     *
     * @return $this
     */
    public function setInvoiceDateSourceType($invoice_date_source_type)
    {
        $allowedValues = $this->getInvoiceDateSourceTypeAllowableValues();
        if (!is_null($invoice_date_source_type) && !in_array($invoice_date_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_date_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getDueDate()
    {
        return $this->container['due_date'];
    }

    /**
     * Sets due_date
     *
     * @param string $due_date due_date
     *
     * @return $this
     */
    public function setDueDate($due_date)
    {
        $this->container['due_date'] = $due_date;

        return $this;
    }

    /**
     * Gets is_due
     *
     * @return bool
     */
    public function getIsDue()
    {
        return $this->container['is_due'];
    }

    /**
     * Sets is_due
     *
     * @param bool $is_due is_due
     *
     * @return $this
     */
    public function setIsDue($is_due)
    {
        $this->container['is_due'] = $is_due;

        return $this;
    }

    /**
     * Gets due_date_source_type
     *
     * @return string
     */
    public function getDueDateSourceType()
    {
        return $this->container['due_date_source_type'];
    }

    /**
     * Sets due_date_source_type
     *
     * @param string $due_date_source_type due_date_source_type
     *
     * @return $this
     */
    public function setDueDateSourceType($due_date_source_type)
    {
        $allowedValues = $this->getDueDateSourceTypeAllowableValues();
        if (!is_null($due_date_source_type) && !in_array($due_date_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'due_date_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getSupplierName()
    {
        return $this->container['supplier_name'];
    }

    /**
     * Sets supplier_name
     *
     * @param string $supplier_name supplier_name
     *
     * @return $this
     */
    public function setSupplierName($supplier_name)
    {
        $this->container['supplier_name'] = $supplier_name;

        return $this;
    }

    /**
     * Gets supplier_source_type
     *
     * @return string
     */
    public function getSupplierSourceType()
    {
        return $this->container['supplier_source_type'];
    }

    /**
     * Sets supplier_source_type
     *
     * @param string $supplier_source_type supplier_source_type
     *
     * @return $this
     */
    public function setSupplierSourceType($supplier_source_type)
    {
        $allowedValues = $this->getSupplierSourceTypeAllowableValues();
        if (!is_null($supplier_source_type) && !in_array($supplier_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'supplier_source_type', must be one of '%s'",
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
     * @return float
     */
    public function getInvoiceAmount()
    {
        return $this->container['invoice_amount'];
    }

    /**
     * Sets invoice_amount
     *
     * @param float $invoice_amount invoice_amount
     *
     * @return $this
     */
    public function setInvoiceAmount($invoice_amount)
    {
        $this->container['invoice_amount'] = $invoice_amount;

        return $this;
    }

    /**
     * Gets invoice_amount_source_type
     *
     * @return string
     */
    public function getInvoiceAmountSourceType()
    {
        return $this->container['invoice_amount_source_type'];
    }

    /**
     * Sets invoice_amount_source_type
     *
     * @param string $invoice_amount_source_type invoice_amount_source_type
     *
     * @return $this
     */
    public function setInvoiceAmountSourceType($invoice_amount_source_type)
    {
        $allowedValues = $this->getInvoiceAmountSourceTypeAllowableValues();
        if (!is_null($invoice_amount_source_type) && !in_array($invoice_amount_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_amount_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getInvoiceCurrency()
    {
        return $this->container['invoice_currency'];
    }

    /**
     * Sets invoice_currency
     *
     * @param string $invoice_currency invoice_currency
     *
     * @return $this
     */
    public function setInvoiceCurrency($invoice_currency)
    {
        $this->container['invoice_currency'] = $invoice_currency;

        return $this;
    }

    /**
     * Gets invoice_currency_source_type
     *
     * @return string
     */
    public function getInvoiceCurrencySourceType()
    {
        return $this->container['invoice_currency_source_type'];
    }

    /**
     * Sets invoice_currency_source_type
     *
     * @param string $invoice_currency_source_type invoice_currency_source_type
     *
     * @return $this
     */
    public function setInvoiceCurrencySourceType($invoice_currency_source_type)
    {
        $allowedValues = $this->getInvoiceCurrencySourceTypeAllowableValues();
        if (!is_null($invoice_currency_source_type) && !in_array($invoice_currency_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_currency_source_type', must be one of '%s'",
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
     * @return string[]
     */
    public function getDocuments()
    {
        return $this->container['documents'];
    }

    /**
     * Sets documents
     *
     * @param string[] $documents documents
     *
     * @return $this
     */
    public function setDocuments($documents)
    {
        $this->container['documents'] = $documents;

        return $this;
    }

    /**
     * Gets document_ids
     *
     * @return int[]
     */
    public function getDocumentIds()
    {
        return $this->container['document_ids'];
    }

    /**
     * Sets document_ids
     *
     * @param int[] $document_ids document_ids
     *
     * @return $this
     */
    public function setDocumentIds($document_ids)
    {
        $this->container['document_ids'] = $document_ids;

        return $this;
    }

    /**
     * Gets account_id
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param int $account_id account_id
     *
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->container['account'];
    }

    /**
     * Sets account
     *
     * @param string $account account
     *
     * @return $this
     */
    public function setAccount($account)
    {
        $this->container['account'] = $account;

        return $this;
    }

    /**
     * Gets account_source_type
     *
     * @return string
     */
    public function getAccountSourceType()
    {
        return $this->container['account_source_type'];
    }

    /**
     * Sets account_source_type
     *
     * @param string $account_source_type account_source_type
     *
     * @return $this
     */
    public function setAccountSourceType($account_source_type)
    {
        $allowedValues = $this->getAccountSourceTypeAllowableValues();
        if (!is_null($account_source_type) && !in_array($account_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'account_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getVatNumber()
    {
        return $this->container['vat_number'];
    }

    /**
     * Sets vat_number
     *
     * @param string $vat_number vat_number
     *
     * @return $this
     */
    public function setVatNumber($vat_number)
    {
        $this->container['vat_number'] = $vat_number;

        return $this;
    }

    /**
     * Gets vat_amount
     *
     * @return float
     */
    public function getVatAmount()
    {
        return $this->container['vat_amount'];
    }

    /**
     * Sets vat_amount
     *
     * @param float $vat_amount vat_amount
     *
     * @return $this
     */
    public function setVatAmount($vat_amount)
    {
        $this->container['vat_amount'] = $vat_amount;

        return $this;
    }

    /**
     * Gets vat_percentage
     *
     * @return float
     */
    public function getVatPercentage()
    {
        return $this->container['vat_percentage'];
    }

    /**
     * Sets vat_percentage
     *
     * @param float $vat_percentage vat_percentage
     *
     * @return $this
     */
    public function setVatPercentage($vat_percentage)
    {
        $this->container['vat_percentage'] = $vat_percentage;

        return $this;
    }

    /**
     * Gets vat_source_type
     *
     * @return string
     */
    public function getVatSourceType()
    {
        return $this->container['vat_source_type'];
    }

    /**
     * Sets vat_source_type
     *
     * @param string $vat_source_type vat_source_type
     *
     * @return $this
     */
    public function setVatSourceType($vat_source_type)
    {
        $allowedValues = $this->getVatSourceTypeAllowableValues();
        if (!is_null($vat_source_type) && !in_array($vat_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'vat_source_type', must be one of '%s'",
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
     * @return int
     */
    public function getDepartmentId()
    {
        return $this->container['department_id'];
    }

    /**
     * Sets department_id
     *
     * @param int $department_id department_id
     *
     * @return $this
     */
    public function setDepartmentId($department_id)
    {
        $this->container['department_id'] = $department_id;

        return $this;
    }

    /**
     * Gets project_id
     *
     * @return int
     */
    public function getProjectId()
    {
        return $this->container['project_id'];
    }

    /**
     * Sets project_id
     *
     * @param int $project_id project_id
     *
     * @return $this
     */
    public function setProjectId($project_id)
    {
        $this->container['project_id'] = $project_id;

        return $this;
    }

    /**
     * Gets project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param string $project project
     *
     * @return $this
     */
    public function setProject($project)
    {
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets project_source_type
     *
     * @return string
     */
    public function getProjectSourceType()
    {
        return $this->container['project_source_type'];
    }

    /**
     * Sets project_source_type
     *
     * @param string $project_source_type project_source_type
     *
     * @return $this
     */
    public function setProjectSourceType($project_source_type)
    {
        $allowedValues = $this->getProjectSourceTypeAllowableValues();
        if (!is_null($project_source_type) && !in_array($project_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'project_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getDepartment()
    {
        return $this->container['department'];
    }

    /**
     * Sets department
     *
     * @param string $department department
     *
     * @return $this
     */
    public function setDepartment($department)
    {
        $this->container['department'] = $department;

        return $this;
    }

    /**
     * Gets department_source_type
     *
     * @return string
     */
    public function getDepartmentSourceType()
    {
        return $this->container['department_source_type'];
    }

    /**
     * Sets department_source_type
     *
     * @param string $department_source_type department_source_type
     *
     * @return $this
     */
    public function setDepartmentSourceType($department_source_type)
    {
        $allowedValues = $this->getDepartmentSourceTypeAllowableValues();
        if (!is_null($department_source_type) && !in_array($department_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'department_source_type', must be one of '%s'",
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
     * @return int
     */
    public function getPaymentTypeId()
    {
        return $this->container['payment_type_id'];
    }

    /**
     * Sets payment_type_id
     *
     * @param int $payment_type_id payment_type_id
     *
     * @return $this
     */
    public function setPaymentTypeId($payment_type_id)
    {
        $this->container['payment_type_id'] = $payment_type_id;

        return $this;
    }

    /**
     * Gets payment_type
     *
     * @return string
     */
    public function getPaymentType()
    {
        return $this->container['payment_type'];
    }

    /**
     * Sets payment_type
     *
     * @param string $payment_type payment_type
     *
     * @return $this
     */
    public function setPaymentType($payment_type)
    {
        $this->container['payment_type'] = $payment_type;

        return $this;
    }

    /**
     * Gets payment_type_source_type
     *
     * @return string
     */
    public function getPaymentTypeSourceType()
    {
        return $this->container['payment_type_source_type'];
    }

    /**
     * Sets payment_type_source_type
     *
     * @param string $payment_type_source_type payment_type_source_type
     *
     * @return $this
     */
    public function setPaymentTypeSourceType($payment_type_source_type)
    {
        $allowedValues = $this->getPaymentTypeSourceTypeAllowableValues();
        if (!is_null($payment_type_source_type) && !in_array($payment_type_source_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'payment_type_source_type', must be one of '%s'",
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
     * @return string
     */
    public function getImportFailureReason()
    {
        return $this->container['import_failure_reason'];
    }

    /**
     * Sets import_failure_reason
     *
     * @param string $import_failure_reason import_failure_reason
     *
     * @return $this
     */
    public function setImportFailureReason($import_failure_reason)
    {
        $this->container['import_failure_reason'] = $import_failure_reason;

        return $this;
    }

    /**
     * Gets accounting_period
     *
     * @return string
     */
    public function getAccountingPeriod()
    {
        return $this->container['accounting_period'];
    }

    /**
     * Sets accounting_period
     *
     * @param string $accounting_period accounting_period
     *
     * @return $this
     */
    public function setAccountingPeriod($accounting_period)
    {
        $this->container['accounting_period'] = $accounting_period;

        return $this;
    }

    /**
     * Gets filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->container['filename'];
    }

    /**
     * Sets filename
     *
     * @param string $filename filename
     *
     * @return $this
     */
    public function setFilename($filename)
    {
        $this->container['filename'] = $filename;

        return $this;
    }

    /**
     * Gets is_temporary
     *
     * @return bool
     */
    public function getIsTemporary()
    {
        return $this->container['is_temporary'];
    }

    /**
     * Sets is_temporary
     *
     * @param bool $is_temporary is_temporary
     *
     * @return $this
     */
    public function setIsTemporary($is_temporary)
    {
        $this->container['is_temporary'] = $is_temporary;

        return $this;
    }

    /**
     * Gets is_invoice_simple
     *
     * @return bool
     */
    public function getIsInvoiceSimple()
    {
        return $this->container['is_invoice_simple'];
    }

    /**
     * Sets is_invoice_simple
     *
     * @param bool $is_invoice_simple is_invoice_simple
     *
     * @return $this
     */
    public function setIsInvoiceSimple($is_invoice_simple)
    {
        $this->container['is_invoice_simple'] = $is_invoice_simple;

        return $this;
    }

    /**
     * Gets is_invoice_detailed
     *
     * @return bool
     */
    public function getIsInvoiceDetailed()
    {
        return $this->container['is_invoice_detailed'];
    }

    /**
     * Sets is_invoice_detailed
     *
     * @param bool $is_invoice_detailed is_invoice_detailed
     *
     * @return $this
     */
    public function setIsInvoiceDetailed($is_invoice_detailed)
    {
        $this->container['is_invoice_detailed'] = $is_invoice_detailed;

        return $this;
    }

    /**
     * Gets has_predictions
     *
     * @return bool
     */
    public function getHasPredictions()
    {
        return $this->container['has_predictions'];
    }

    /**
     * Sets has_predictions
     *
     * @param bool $has_predictions Has one or more predictions from FabricAi
     *
     * @return $this
     */
    public function setHasPredictions($has_predictions)
    {
        $this->container['has_predictions'] = $has_predictions;

        return $this;
    }

    /**
     * Gets has_smart_scan_suggestions
     *
     * @return bool
     */
    public function getHasSmartScanSuggestions()
    {
        return $this->container['has_smart_scan_suggestions'];
    }

    /**
     * Sets has_smart_scan_suggestions
     *
     * @param bool $has_smart_scan_suggestions Has one or more suggestions from SmartScan
     *
     * @return $this
     */
    public function setHasSmartScanSuggestions($has_smart_scan_suggestions)
    {
        $this->container['has_smart_scan_suggestions'] = $has_smart_scan_suggestions;

        return $this;
    }

    /**
     * Gets is_locked
     *
     * @return bool
     */
    public function getIsLocked()
    {
        return $this->container['is_locked'];
    }

    /**
     * Sets is_locked
     *
     * @param bool $is_locked Is voucher locked for change by external integration
     *
     * @return $this
     */
    public function setIsLocked($is_locked)
    {
        $this->container['is_locked'] = $is_locked;

        return $this;
    }

    /**
     * Gets comment_count
     *
     * @return int
     */
    public function getCommentCount()
    {
        return $this->container['comment_count'];
    }

    /**
     * Sets comment_count
     *
     * @param int $comment_count comment_count
     *
     * @return $this
     */
    public function setCommentCount($comment_count)
    {
        $this->container['comment_count'] = $comment_count;

        return $this;
    }

    /**
     * Gets non_automation_reason
     *
     * @return string
     */
    public function getNonAutomationReason()
    {
        return $this->container['non_automation_reason'];
    }

    /**
     * Sets non_automation_reason
     *
     * @param string $non_automation_reason non_automation_reason
     *
     * @return $this
     */
    public function setNonAutomationReason($non_automation_reason)
    {
        $this->container['non_automation_reason'] = $non_automation_reason;

        return $this;
    }

    /**
     * Gets can_be_sent_to_ledger
     *
     * @return bool
     */
    public function getCanBeSentToLedger()
    {
        return $this->container['can_be_sent_to_ledger'];
    }

    /**
     * Sets can_be_sent_to_ledger
     *
     * @param bool $can_be_sent_to_ledger Possible to do one click 'Send to ledger'
     *
     * @return $this
     */
    public function setCanBeSentToLedger($can_be_sent_to_ledger)
    {
        $this->container['can_be_sent_to_ledger'] = $can_be_sent_to_ledger;

        return $this;
    }

    /**
     * Gets can_be_registered_as_changed
     *
     * @return bool
     */
    public function getCanBeRegisteredAsChanged()
    {
        return $this->container['can_be_registered_as_changed'];
    }

    /**
     * Sets can_be_registered_as_changed
     *
     * @param bool $can_be_registered_as_changed Possible to do one click 'Send to ledger'
     *
     * @return $this
     */
    public function setCanBeRegisteredAsChanged($can_be_registered_as_changed)
    {
        $this->container['can_be_registered_as_changed'] = $can_be_registered_as_changed;

        return $this;
    }

    /**
     * Gets can_be_registered_as_simple_invoice
     *
     * @return bool
     */
    public function getCanBeRegisteredAsSimpleInvoice()
    {
        return $this->container['can_be_registered_as_simple_invoice'];
    }

    /**
     * Sets can_be_registered_as_simple_invoice
     *
     * @param bool $can_be_registered_as_simple_invoice can_be_registered_as_simple_invoice
     *
     * @return $this
     */
    public function setCanBeRegisteredAsSimpleInvoice($can_be_registered_as_simple_invoice)
    {
        $this->container['can_be_registered_as_simple_invoice'] = $can_be_registered_as_simple_invoice;

        return $this;
    }

    /**
     * Gets can_be_registered_as_detailed_invoice
     *
     * @return bool
     */
    public function getCanBeRegisteredAsDetailedInvoice()
    {
        return $this->container['can_be_registered_as_detailed_invoice'];
    }

    /**
     * Sets can_be_registered_as_detailed_invoice
     *
     * @param bool $can_be_registered_as_detailed_invoice can_be_registered_as_detailed_invoice
     *
     * @return $this
     */
    public function setCanBeRegisteredAsDetailedInvoice($can_be_registered_as_detailed_invoice)
    {
        $this->container['can_be_registered_as_detailed_invoice'] = $can_be_registered_as_detailed_invoice;

        return $this;
    }

    /**
     * Gets can_be_registered_as_bank_reconciliation
     *
     * @return bool
     */
    public function getCanBeRegisteredAsBankReconciliation()
    {
        return $this->container['can_be_registered_as_bank_reconciliation'];
    }

    /**
     * Sets can_be_registered_as_bank_reconciliation
     *
     * @param bool $can_be_registered_as_bank_reconciliation can_be_registered_as_bank_reconciliation
     *
     * @return $this
     */
    public function setCanBeRegisteredAsBankReconciliation($can_be_registered_as_bank_reconciliation)
    {
        $this->container['can_be_registered_as_bank_reconciliation'] = $can_be_registered_as_bank_reconciliation;

        return $this;
    }

    /**
     * Gets can_be_registered_as_payment_in
     *
     * @return bool
     */
    public function getCanBeRegisteredAsPaymentIn()
    {
        return $this->container['can_be_registered_as_payment_in'];
    }

    /**
     * Sets can_be_registered_as_payment_in
     *
     * @param bool $can_be_registered_as_payment_in can_be_registered_as_payment_in
     *
     * @return $this
     */
    public function setCanBeRegisteredAsPaymentIn($can_be_registered_as_payment_in)
    {
        $this->container['can_be_registered_as_payment_in'] = $can_be_registered_as_payment_in;

        return $this;
    }

    /**
     * Gets can_be_registered_as_income
     *
     * @return bool
     */
    public function getCanBeRegisteredAsIncome()
    {
        return $this->container['can_be_registered_as_income'];
    }

    /**
     * Sets can_be_registered_as_income
     *
     * @param bool $can_be_registered_as_income can_be_registered_as_income
     *
     * @return $this
     */
    public function setCanBeRegisteredAsIncome($can_be_registered_as_income)
    {
        $this->container['can_be_registered_as_income'] = $can_be_registered_as_income;

        return $this;
    }

    /**
     * Gets can_be_registered_as_customs_declaration
     *
     * @return bool
     */
    public function getCanBeRegisteredAsCustomsDeclaration()
    {
        return $this->container['can_be_registered_as_customs_declaration'];
    }

    /**
     * Sets can_be_registered_as_customs_declaration
     *
     * @param bool $can_be_registered_as_customs_declaration can_be_registered_as_customs_declaration
     *
     * @return $this
     */
    public function setCanBeRegisteredAsCustomsDeclaration($can_be_registered_as_customs_declaration)
    {
        $this->container['can_be_registered_as_customs_declaration'] = $can_be_registered_as_customs_declaration;

        return $this;
    }

    /**
     * Gets can_be_registered_as_advanced
     *
     * @return bool
     */
    public function getCanBeRegisteredAsAdvanced()
    {
        return $this->container['can_be_registered_as_advanced'];
    }

    /**
     * Sets can_be_registered_as_advanced
     *
     * @param bool $can_be_registered_as_advanced can_be_registered_as_advanced
     *
     * @return $this
     */
    public function setCanBeRegisteredAsAdvanced($can_be_registered_as_advanced)
    {
        $this->container['can_be_registered_as_advanced'] = $can_be_registered_as_advanced;

        return $this;
    }

    /**
     * Gets can_be_sent_to_accountant
     *
     * @return bool
     */
    public function getCanBeSentToAccountant()
    {
        return $this->container['can_be_sent_to_accountant'];
    }

    /**
     * Sets can_be_sent_to_accountant
     *
     * @param bool $can_be_sent_to_accountant can_be_sent_to_accountant
     *
     * @return $this
     */
    public function setCanBeSentToAccountant($can_be_sent_to_accountant)
    {
        $this->container['can_be_sent_to_accountant'] = $can_be_sent_to_accountant;

        return $this;
    }

    /**
     * Gets can_be_sent_to_archive
     *
     * @return bool
     */
    public function getCanBeSentToArchive()
    {
        return $this->container['can_be_sent_to_archive'];
    }

    /**
     * Sets can_be_sent_to_archive
     *
     * @param bool $can_be_sent_to_archive can_be_sent_to_archive
     *
     * @return $this
     */
    public function setCanBeSentToArchive($can_be_sent_to_archive)
    {
        $this->container['can_be_sent_to_archive'] = $can_be_sent_to_archive;

        return $this;
    }

    /**
     * Gets can_be_deleted
     *
     * @return bool
     */
    public function getCanBeDeleted()
    {
        return $this->container['can_be_deleted'];
    }

    /**
     * Sets can_be_deleted
     *
     * @param bool $can_be_deleted can_be_deleted
     *
     * @return $this
     */
    public function setCanBeDeleted($can_be_deleted)
    {
        $this->container['can_be_deleted'] = $can_be_deleted;

        return $this;
    }

    /**
     * Gets can_be_registered_in_queue
     *
     * @return bool
     */
    public function getCanBeRegisteredInQueue()
    {
        return $this->container['can_be_registered_in_queue'];
    }

    /**
     * Sets can_be_registered_in_queue
     *
     * @param bool $can_be_registered_in_queue can_be_registered_in_queue
     *
     * @return $this
     */
    public function setCanBeRegisteredInQueue($can_be_registered_in_queue)
    {
        $this->container['can_be_registered_in_queue'] = $can_be_registered_in_queue;

        return $this;
    }

    /**
     * Gets can_be_merged
     *
     * @return bool
     */
    public function getCanBeMerged()
    {
        return $this->container['can_be_merged'];
    }

    /**
     * Sets can_be_merged
     *
     * @param bool $can_be_merged can_be_merged
     *
     * @return $this
     */
    public function setCanBeMerged($can_be_merged)
    {
        $this->container['can_be_merged'] = $can_be_merged;

        return $this;
    }

    /**
     * Gets allow_posting_before_voucher_approved
     *
     * @return bool
     */
    public function getAllowPostingBeforeVoucherApproved()
    {
        return $this->container['allow_posting_before_voucher_approved'];
    }

    /**
     * Sets allow_posting_before_voucher_approved
     *
     * @param bool $allow_posting_before_voucher_approved allow_posting_before_voucher_approved
     *
     * @return $this
     */
    public function setAllowPostingBeforeVoucherApproved($allow_posting_before_voucher_approved)
    {
        $this->container['allow_posting_before_voucher_approved'] = $allow_posting_before_voucher_approved;

        return $this;
    }

    /**
     * Gets sender_email_address
     *
     * @return string
     */
    public function getSenderEmailAddress()
    {
        return $this->container['sender_email_address'];
    }

    /**
     * Sets sender_email_address
     *
     * @param string $sender_email_address sender_email_address
     *
     * @return $this
     */
    public function setSenderEmailAddress($sender_email_address)
    {
        $this->container['sender_email_address'] = $sender_email_address;

        return $this;
    }

    /**
     * Gets is_spam
     *
     * @return bool
     */
    public function getIsSpam()
    {
        return $this->container['is_spam'];
    }

    /**
     * Sets is_spam
     *
     * @param bool $is_spam is_spam
     *
     * @return $this
     */
    public function setIsSpam($is_spam)
    {
        $this->container['is_spam'] = $is_spam;

        return $this;
    }

    /**
     * Gets email_arrival_time
     *
     * @return string
     */
    public function getEmailArrivalTime()
    {
        return $this->container['email_arrival_time'];
    }

    /**
     * Sets email_arrival_time
     *
     * @param string $email_arrival_time email_arrival_time
     *
     * @return $this
     */
    public function setEmailArrivalTime($email_arrival_time)
    {
        $this->container['email_arrival_time'] = $email_arrival_time;

        return $this;
    }

    /**
     * Gets spam_report_for_display
     *
     * @return string
     */
    public function getSpamReportForDisplay()
    {
        return $this->container['spam_report_for_display'];
    }

    /**
     * Sets spam_report_for_display
     *
     * @param string $spam_report_for_display spam_report_for_display
     *
     * @return $this
     */
    public function setSpamReportForDisplay($spam_report_for_display)
    {
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
