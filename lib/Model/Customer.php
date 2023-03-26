<?php
/**
 * Customer
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
 * Customer Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Customer implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Customer';

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
'name' => 'string',
'organization_number' => 'string',
'supplier_number' => 'int',
'customer_number' => 'int',
'is_supplier' => 'bool',
'is_customer' => 'bool',
'is_inactive' => 'bool',
'account_manager' => '\Learnist\Tripletex\Model\Employee',
'email' => 'string',
'invoice_email' => 'string',
'overdue_notice_email' => 'string',
'bank_accounts' => 'string[]',
'phone_number' => 'string',
'phone_number_mobile' => 'string',
'description' => 'string',
'language' => 'string',
'display_name' => 'string',
'is_private_individual' => 'bool',
'single_customer_invoice' => 'bool',
'invoice_send_method' => 'string',
'email_attachment_type' => 'string',
'postal_address' => '\Learnist\Tripletex\Model\Address',
'physical_address' => '\Learnist\Tripletex\Model\Address',
'delivery_address' => '\Learnist\Tripletex\Model\DeliveryAddress',
'category1' => '\Learnist\Tripletex\Model\CustomerCategory',
'category2' => '\Learnist\Tripletex\Model\CustomerCategory',
'category3' => '\Learnist\Tripletex\Model\CustomerCategory',
'invoices_due_in' => 'int',
'invoices_due_in_type' => 'string',
'currency' => '\Learnist\Tripletex\Model\Currency',
'bank_account_presentation' => '\Learnist\Tripletex\Model\CompanyBankAccountPresentation[]',
'ledger_account' => '\Learnist\Tripletex\Model\Account',
'is_factoring' => 'bool',
'invoice_send_sms_notification' => 'bool',
'is_automatic_soft_reminder_enabled' => 'bool',
'is_automatic_reminder_enabled' => 'bool',
'is_automatic_notice_of_debt_collection_enabled' => 'bool'    ];

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
'name' => null,
'organization_number' => null,
'supplier_number' => 'int32',
'customer_number' => 'int32',
'is_supplier' => null,
'is_customer' => null,
'is_inactive' => null,
'account_manager' => null,
'email' => 'email',
'invoice_email' => null,
'overdue_notice_email' => 'email',
'bank_accounts' => null,
'phone_number' => null,
'phone_number_mobile' => null,
'description' => null,
'language' => null,
'display_name' => null,
'is_private_individual' => null,
'single_customer_invoice' => null,
'invoice_send_method' => null,
'email_attachment_type' => null,
'postal_address' => null,
'physical_address' => null,
'delivery_address' => null,
'category1' => null,
'category2' => null,
'category3' => null,
'invoices_due_in' => 'int32',
'invoices_due_in_type' => null,
'currency' => null,
'bank_account_presentation' => null,
'ledger_account' => null,
'is_factoring' => null,
'invoice_send_sms_notification' => null,
'is_automatic_soft_reminder_enabled' => null,
'is_automatic_reminder_enabled' => null,
'is_automatic_notice_of_debt_collection_enabled' => null    ];

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
'name' => 'name',
'organization_number' => 'organizationNumber',
'supplier_number' => 'supplierNumber',
'customer_number' => 'customerNumber',
'is_supplier' => 'isSupplier',
'is_customer' => 'isCustomer',
'is_inactive' => 'isInactive',
'account_manager' => 'accountManager',
'email' => 'email',
'invoice_email' => 'invoiceEmail',
'overdue_notice_email' => 'overdueNoticeEmail',
'bank_accounts' => 'bankAccounts',
'phone_number' => 'phoneNumber',
'phone_number_mobile' => 'phoneNumberMobile',
'description' => 'description',
'language' => 'language',
'display_name' => 'displayName',
'is_private_individual' => 'isPrivateIndividual',
'single_customer_invoice' => 'singleCustomerInvoice',
'invoice_send_method' => 'invoiceSendMethod',
'email_attachment_type' => 'emailAttachmentType',
'postal_address' => 'postalAddress',
'physical_address' => 'physicalAddress',
'delivery_address' => 'deliveryAddress',
'category1' => 'category1',
'category2' => 'category2',
'category3' => 'category3',
'invoices_due_in' => 'invoicesDueIn',
'invoices_due_in_type' => 'invoicesDueInType',
'currency' => 'currency',
'bank_account_presentation' => 'bankAccountPresentation',
'ledger_account' => 'ledgerAccount',
'is_factoring' => 'isFactoring',
'invoice_send_sms_notification' => 'invoiceSendSMSNotification',
'is_automatic_soft_reminder_enabled' => 'isAutomaticSoftReminderEnabled',
'is_automatic_reminder_enabled' => 'isAutomaticReminderEnabled',
'is_automatic_notice_of_debt_collection_enabled' => 'isAutomaticNoticeOfDebtCollectionEnabled'    ];

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
'name' => 'setName',
'organization_number' => 'setOrganizationNumber',
'supplier_number' => 'setSupplierNumber',
'customer_number' => 'setCustomerNumber',
'is_supplier' => 'setIsSupplier',
'is_customer' => 'setIsCustomer',
'is_inactive' => 'setIsInactive',
'account_manager' => 'setAccountManager',
'email' => 'setEmail',
'invoice_email' => 'setInvoiceEmail',
'overdue_notice_email' => 'setOverdueNoticeEmail',
'bank_accounts' => 'setBankAccounts',
'phone_number' => 'setPhoneNumber',
'phone_number_mobile' => 'setPhoneNumberMobile',
'description' => 'setDescription',
'language' => 'setLanguage',
'display_name' => 'setDisplayName',
'is_private_individual' => 'setIsPrivateIndividual',
'single_customer_invoice' => 'setSingleCustomerInvoice',
'invoice_send_method' => 'setInvoiceSendMethod',
'email_attachment_type' => 'setEmailAttachmentType',
'postal_address' => 'setPostalAddress',
'physical_address' => 'setPhysicalAddress',
'delivery_address' => 'setDeliveryAddress',
'category1' => 'setCategory1',
'category2' => 'setCategory2',
'category3' => 'setCategory3',
'invoices_due_in' => 'setInvoicesDueIn',
'invoices_due_in_type' => 'setInvoicesDueInType',
'currency' => 'setCurrency',
'bank_account_presentation' => 'setBankAccountPresentation',
'ledger_account' => 'setLedgerAccount',
'is_factoring' => 'setIsFactoring',
'invoice_send_sms_notification' => 'setInvoiceSendSmsNotification',
'is_automatic_soft_reminder_enabled' => 'setIsAutomaticSoftReminderEnabled',
'is_automatic_reminder_enabled' => 'setIsAutomaticReminderEnabled',
'is_automatic_notice_of_debt_collection_enabled' => 'setIsAutomaticNoticeOfDebtCollectionEnabled'    ];

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
'name' => 'getName',
'organization_number' => 'getOrganizationNumber',
'supplier_number' => 'getSupplierNumber',
'customer_number' => 'getCustomerNumber',
'is_supplier' => 'getIsSupplier',
'is_customer' => 'getIsCustomer',
'is_inactive' => 'getIsInactive',
'account_manager' => 'getAccountManager',
'email' => 'getEmail',
'invoice_email' => 'getInvoiceEmail',
'overdue_notice_email' => 'getOverdueNoticeEmail',
'bank_accounts' => 'getBankAccounts',
'phone_number' => 'getPhoneNumber',
'phone_number_mobile' => 'getPhoneNumberMobile',
'description' => 'getDescription',
'language' => 'getLanguage',
'display_name' => 'getDisplayName',
'is_private_individual' => 'getIsPrivateIndividual',
'single_customer_invoice' => 'getSingleCustomerInvoice',
'invoice_send_method' => 'getInvoiceSendMethod',
'email_attachment_type' => 'getEmailAttachmentType',
'postal_address' => 'getPostalAddress',
'physical_address' => 'getPhysicalAddress',
'delivery_address' => 'getDeliveryAddress',
'category1' => 'getCategory1',
'category2' => 'getCategory2',
'category3' => 'getCategory3',
'invoices_due_in' => 'getInvoicesDueIn',
'invoices_due_in_type' => 'getInvoicesDueInType',
'currency' => 'getCurrency',
'bank_account_presentation' => 'getBankAccountPresentation',
'ledger_account' => 'getLedgerAccount',
'is_factoring' => 'getIsFactoring',
'invoice_send_sms_notification' => 'getInvoiceSendSmsNotification',
'is_automatic_soft_reminder_enabled' => 'getIsAutomaticSoftReminderEnabled',
'is_automatic_reminder_enabled' => 'getIsAutomaticReminderEnabled',
'is_automatic_notice_of_debt_collection_enabled' => 'getIsAutomaticNoticeOfDebtCollectionEnabled'    ];

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

    const LANGUAGE_NO = 'NO';
const LANGUAGE_EN = 'EN';
const LANGUAGE_SV = 'SV';
const INVOICE_SEND_METHOD_EMAIL = 'EMAIL';
const INVOICE_SEND_METHOD_EHF = 'EHF';
const INVOICE_SEND_METHOD_EFAKTURA = 'EFAKTURA';
const INVOICE_SEND_METHOD_AVTALEGIRO = 'AVTALEGIRO';
const INVOICE_SEND_METHOD_VIPPS = 'VIPPS';
const INVOICE_SEND_METHOD_PAPER = 'PAPER';
const INVOICE_SEND_METHOD_MANUAL = 'MANUAL';
const EMAIL_ATTACHMENT_TYPE_LINK = 'LINK';
const EMAIL_ATTACHMENT_TYPE_ATTACHMENT = 'ATTACHMENT';
const INVOICES_DUE_IN_TYPE_DAYS = 'DAYS';
const INVOICES_DUE_IN_TYPE_MONTHS = 'MONTHS';
const INVOICES_DUE_IN_TYPE_RECURRING_DAY_OF_MONTH = 'RECURRING_DAY_OF_MONTH';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLanguageAllowableValues()
    {
        return [
            self::LANGUAGE_NO,
self::LANGUAGE_EN,
self::LANGUAGE_SV,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInvoiceSendMethodAllowableValues()
    {
        return [
            self::INVOICE_SEND_METHOD_EMAIL,
self::INVOICE_SEND_METHOD_EHF,
self::INVOICE_SEND_METHOD_EFAKTURA,
self::INVOICE_SEND_METHOD_AVTALEGIRO,
self::INVOICE_SEND_METHOD_VIPPS,
self::INVOICE_SEND_METHOD_PAPER,
self::INVOICE_SEND_METHOD_MANUAL,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getEmailAttachmentTypeAllowableValues()
    {
        return [
            self::EMAIL_ATTACHMENT_TYPE_LINK,
self::EMAIL_ATTACHMENT_TYPE_ATTACHMENT,        ];
    }
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['organization_number'] = isset($data['organization_number']) ? $data['organization_number'] : null;
        $this->container['supplier_number'] = isset($data['supplier_number']) ? $data['supplier_number'] : null;
        $this->container['customer_number'] = isset($data['customer_number']) ? $data['customer_number'] : null;
        $this->container['is_supplier'] = isset($data['is_supplier']) ? $data['is_supplier'] : null;
        $this->container['is_customer'] = isset($data['is_customer']) ? $data['is_customer'] : null;
        $this->container['is_inactive'] = isset($data['is_inactive']) ? $data['is_inactive'] : null;
        $this->container['account_manager'] = isset($data['account_manager']) ? $data['account_manager'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['invoice_email'] = isset($data['invoice_email']) ? $data['invoice_email'] : null;
        $this->container['overdue_notice_email'] = isset($data['overdue_notice_email']) ? $data['overdue_notice_email'] : null;
        $this->container['bank_accounts'] = isset($data['bank_accounts']) ? $data['bank_accounts'] : null;
        $this->container['phone_number'] = isset($data['phone_number']) ? $data['phone_number'] : null;
        $this->container['phone_number_mobile'] = isset($data['phone_number_mobile']) ? $data['phone_number_mobile'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['is_private_individual'] = isset($data['is_private_individual']) ? $data['is_private_individual'] : null;
        $this->container['single_customer_invoice'] = isset($data['single_customer_invoice']) ? $data['single_customer_invoice'] : null;
        $this->container['invoice_send_method'] = isset($data['invoice_send_method']) ? $data['invoice_send_method'] : null;
        $this->container['email_attachment_type'] = isset($data['email_attachment_type']) ? $data['email_attachment_type'] : null;
        $this->container['postal_address'] = isset($data['postal_address']) ? $data['postal_address'] : null;
        $this->container['physical_address'] = isset($data['physical_address']) ? $data['physical_address'] : null;
        $this->container['delivery_address'] = isset($data['delivery_address']) ? $data['delivery_address'] : null;
        $this->container['category1'] = isset($data['category1']) ? $data['category1'] : null;
        $this->container['category2'] = isset($data['category2']) ? $data['category2'] : null;
        $this->container['category3'] = isset($data['category3']) ? $data['category3'] : null;
        $this->container['invoices_due_in'] = isset($data['invoices_due_in']) ? $data['invoices_due_in'] : null;
        $this->container['invoices_due_in_type'] = isset($data['invoices_due_in_type']) ? $data['invoices_due_in_type'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['bank_account_presentation'] = isset($data['bank_account_presentation']) ? $data['bank_account_presentation'] : null;
        $this->container['ledger_account'] = isset($data['ledger_account']) ? $data['ledger_account'] : null;
        $this->container['is_factoring'] = isset($data['is_factoring']) ? $data['is_factoring'] : null;
        $this->container['invoice_send_sms_notification'] = isset($data['invoice_send_sms_notification']) ? $data['invoice_send_sms_notification'] : null;
        $this->container['is_automatic_soft_reminder_enabled'] = isset($data['is_automatic_soft_reminder_enabled']) ? $data['is_automatic_soft_reminder_enabled'] : null;
        $this->container['is_automatic_reminder_enabled'] = isset($data['is_automatic_reminder_enabled']) ? $data['is_automatic_reminder_enabled'] : null;
        $this->container['is_automatic_notice_of_debt_collection_enabled'] = isset($data['is_automatic_notice_of_debt_collection_enabled']) ? $data['is_automatic_notice_of_debt_collection_enabled'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        $allowedValues = $this->getLanguageAllowableValues();
        if (!is_null($this->container['language']) && !in_array($this->container['language'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'language', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceSendMethodAllowableValues();
        if (!is_null($this->container['invoice_send_method']) && !in_array($this->container['invoice_send_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoice_send_method', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getEmailAttachmentTypeAllowableValues();
        if (!is_null($this->container['email_attachment_type']) && !in_array($this->container['email_attachment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'email_attachment_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoicesDueInTypeAllowableValues();
        if (!is_null($this->container['invoices_due_in_type']) && !in_array($this->container['invoices_due_in_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'invoices_due_in_type', must be one of '%s'",
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets organization_number
     *
     * @return string
     */
    public function getOrganizationNumber()
    {
        return $this->container['organization_number'];
    }

    /**
     * Sets organization_number
     *
     * @param string $organization_number organization_number
     *
     * @return $this
     */
    public function setOrganizationNumber($organization_number)
    {
        $this->container['organization_number'] = $organization_number;

        return $this;
    }

    /**
     * Gets supplier_number
     *
     * @return int
     */
    public function getSupplierNumber()
    {
        return $this->container['supplier_number'];
    }

    /**
     * Sets supplier_number
     *
     * @param int $supplier_number supplier_number
     *
     * @return $this
     */
    public function setSupplierNumber($supplier_number)
    {
        $this->container['supplier_number'] = $supplier_number;

        return $this;
    }

    /**
     * Gets customer_number
     *
     * @return int
     */
    public function getCustomerNumber()
    {
        return $this->container['customer_number'];
    }

    /**
     * Sets customer_number
     *
     * @param int $customer_number customer_number
     *
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->container['customer_number'] = $customer_number;

        return $this;
    }

    /**
     * Gets is_supplier
     *
     * @return bool
     */
    public function getIsSupplier()
    {
        return $this->container['is_supplier'];
    }

    /**
     * Sets is_supplier
     *
     * @param bool $is_supplier Defines if the customer is also a supplier.
     *
     * @return $this
     */
    public function setIsSupplier($is_supplier)
    {
        $this->container['is_supplier'] = $is_supplier;

        return $this;
    }

    /**
     * Gets is_customer
     *
     * @return bool
     */
    public function getIsCustomer()
    {
        return $this->container['is_customer'];
    }

    /**
     * Sets is_customer
     *
     * @param bool $is_customer is_customer
     *
     * @return $this
     */
    public function setIsCustomer($is_customer)
    {
        $this->container['is_customer'] = $is_customer;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool $is_inactive is_inactive
     *
     * @return $this
     */
    public function setIsInactive($is_inactive)
    {
        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets account_manager
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getAccountManager()
    {
        return $this->container['account_manager'];
    }

    /**
     * Sets account_manager
     *
     * @param \Learnist\Tripletex\Model\Employee $account_manager account_manager
     *
     * @return $this
     */
    public function setAccountManager($account_manager)
    {
        $this->container['account_manager'] = $account_manager;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets invoice_email
     *
     * @return string
     */
    public function getInvoiceEmail()
    {
        return $this->container['invoice_email'];
    }

    /**
     * Sets invoice_email
     *
     * @param string $invoice_email invoice_email
     *
     * @return $this
     */
    public function setInvoiceEmail($invoice_email)
    {
        $this->container['invoice_email'] = $invoice_email;

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
     * @param string $overdue_notice_email The email address of the customer where the noticing emails are sent in case of an overdue
     *
     * @return $this
     */
    public function setOverdueNoticeEmail($overdue_notice_email)
    {
        $this->container['overdue_notice_email'] = $overdue_notice_email;

        return $this;
    }

    /**
     * Gets bank_accounts
     *
     * @return string[]
     */
    public function getBankAccounts()
    {
        return $this->container['bank_accounts'];
    }

    /**
     * Sets bank_accounts
     *
     * @param string[] $bank_accounts [DEPRECATED] List of the bank account numbers for this customer. Norwegian bank account numbers only.
     *
     * @return $this
     */
    public function setBankAccounts($bank_accounts)
    {
        $this->container['bank_accounts'] = $bank_accounts;

        return $this;
    }

    /**
     * Gets phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->container['phone_number'];
    }

    /**
     * Sets phone_number
     *
     * @param string $phone_number phone_number
     *
     * @return $this
     */
    public function setPhoneNumber($phone_number)
    {
        $this->container['phone_number'] = $phone_number;

        return $this;
    }

    /**
     * Gets phone_number_mobile
     *
     * @return string
     */
    public function getPhoneNumberMobile()
    {
        return $this->container['phone_number_mobile'];
    }

    /**
     * Sets phone_number_mobile
     *
     * @param string $phone_number_mobile phone_number_mobile
     *
     * @return $this
     */
    public function setPhoneNumberMobile($phone_number_mobile)
    {
        $this->container['phone_number_mobile'] = $phone_number_mobile;

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
     * Gets language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param string $language language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $allowedValues = $this->getLanguageAllowableValues();
        if (!is_null($language) && !in_array($language, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'language', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['language'] = $language;

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
     * Gets is_private_individual
     *
     * @return bool
     */
    public function getIsPrivateIndividual()
    {
        return $this->container['is_private_individual'];
    }

    /**
     * Sets is_private_individual
     *
     * @param bool $is_private_individual is_private_individual
     *
     * @return $this
     */
    public function setIsPrivateIndividual($is_private_individual)
    {
        $this->container['is_private_individual'] = $is_private_individual;

        return $this;
    }

    /**
     * Gets single_customer_invoice
     *
     * @return bool
     */
    public function getSingleCustomerInvoice()
    {
        return $this->container['single_customer_invoice'];
    }

    /**
     * Sets single_customer_invoice
     *
     * @param bool $single_customer_invoice Enables various orders on one customer invoice.
     *
     * @return $this
     */
    public function setSingleCustomerInvoice($single_customer_invoice)
    {
        $this->container['single_customer_invoice'] = $single_customer_invoice;

        return $this;
    }

    /**
     * Gets invoice_send_method
     *
     * @return string
     */
    public function getInvoiceSendMethod()
    {
        return $this->container['invoice_send_method'];
    }

    /**
     * Sets invoice_send_method
     *
     * @param string $invoice_send_method Define the invoicing method for the customer.<br>EMAIL: Send invoices as email.<br>EHF: Send invoices as EHF.<br>EFAKTURA: Send invoices as EFAKTURA.<br>AVTALEGIRO: Send invoices as AVTALEGIRO.<br>VIPPS: Send invoices through VIPPS.<br>PAPER: Send invoices as paper invoice.<br>MANUAL: User will have to send invocie manually.<br>
     *
     * @return $this
     */
    public function setInvoiceSendMethod($invoice_send_method)
    {
        $allowedValues = $this->getInvoiceSendMethodAllowableValues();
        if (!is_null($invoice_send_method) && !in_array($invoice_send_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'invoice_send_method', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_send_method'] = $invoice_send_method;

        return $this;
    }

    /**
     * Gets email_attachment_type
     *
     * @return string
     */
    public function getEmailAttachmentType()
    {
        return $this->container['email_attachment_type'];
    }

    /**
     * Sets email_attachment_type
     *
     * @param string $email_attachment_type Define the invoice attachment type for emailing to the customer.<br>LINK: Send invoice as link in email.<br>ATTACHMENT: Send invoice as attachment in email.<br>
     *
     * @return $this
     */
    public function setEmailAttachmentType($email_attachment_type)
    {
        $allowedValues = $this->getEmailAttachmentTypeAllowableValues();
        if (!is_null($email_attachment_type) && !in_array($email_attachment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'email_attachment_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['email_attachment_type'] = $email_attachment_type;

        return $this;
    }

    /**
     * Gets postal_address
     *
     * @return \Learnist\Tripletex\Model\Address
     */
    public function getPostalAddress()
    {
        return $this->container['postal_address'];
    }

    /**
     * Sets postal_address
     *
     * @param \Learnist\Tripletex\Model\Address $postal_address postal_address
     *
     * @return $this
     */
    public function setPostalAddress($postal_address)
    {
        $this->container['postal_address'] = $postal_address;

        return $this;
    }

    /**
     * Gets physical_address
     *
     * @return \Learnist\Tripletex\Model\Address
     */
    public function getPhysicalAddress()
    {
        return $this->container['physical_address'];
    }

    /**
     * Sets physical_address
     *
     * @param \Learnist\Tripletex\Model\Address $physical_address physical_address
     *
     * @return $this
     */
    public function setPhysicalAddress($physical_address)
    {
        $this->container['physical_address'] = $physical_address;

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
     * Gets category1
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory
     */
    public function getCategory1()
    {
        return $this->container['category1'];
    }

    /**
     * Sets category1
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory $category1 category1
     *
     * @return $this
     */
    public function setCategory1($category1)
    {
        $this->container['category1'] = $category1;

        return $this;
    }

    /**
     * Gets category2
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory
     */
    public function getCategory2()
    {
        return $this->container['category2'];
    }

    /**
     * Sets category2
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory $category2 category2
     *
     * @return $this
     */
    public function setCategory2($category2)
    {
        $this->container['category2'] = $category2;

        return $this;
    }

    /**
     * Gets category3
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory
     */
    public function getCategory3()
    {
        return $this->container['category3'];
    }

    /**
     * Sets category3
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory $category3 category3
     *
     * @return $this
     */
    public function setCategory3($category3)
    {
        $this->container['category3'] = $category3;

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
     * @param int $invoices_due_in Number of days/months in which invoices created from this customer is due
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
     * @param string $invoices_due_in_type Set the time unit of invoicesDueIn. The special case RECURRING_DAY_OF_MONTH enables the due date to be fixed to a specific day of the month, in this case the fixed due date will automatically be set as standard on all invoices created from this customer. Note that when RECURRING_DAY_OF_MONTH is set, the due date will be set to the last day of month if \"31\" is set in invoicesDueIn.
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
     * Gets bank_account_presentation
     *
     * @return \Learnist\Tripletex\Model\CompanyBankAccountPresentation[]
     */
    public function getBankAccountPresentation()
    {
        return $this->container['bank_account_presentation'];
    }

    /**
     * Sets bank_account_presentation
     *
     * @param \Learnist\Tripletex\Model\CompanyBankAccountPresentation[] $bank_account_presentation List of bankAccount for this customer
     *
     * @return $this
     */
    public function setBankAccountPresentation($bank_account_presentation)
    {
        $this->container['bank_account_presentation'] = $bank_account_presentation;

        return $this;
    }

    /**
     * Gets ledger_account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getLedgerAccount()
    {
        return $this->container['ledger_account'];
    }

    /**
     * Sets ledger_account
     *
     * @param \Learnist\Tripletex\Model\Account $ledger_account ledger_account
     *
     * @return $this
     */
    public function setLedgerAccount($ledger_account)
    {
        $this->container['ledger_account'] = $ledger_account;

        return $this;
    }

    /**
     * Gets is_factoring
     *
     * @return bool
     */
    public function getIsFactoring()
    {
        return $this->container['is_factoring'];
    }

    /**
     * Sets is_factoring
     *
     * @param bool $is_factoring If true; send this customers invoices to factoring (if factoring is turned on in account).
     *
     * @return $this
     */
    public function setIsFactoring($is_factoring)
    {
        $this->container['is_factoring'] = $is_factoring;

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
     * Gets is_automatic_soft_reminder_enabled
     *
     * @return bool
     */
    public function getIsAutomaticSoftReminderEnabled()
    {
        return $this->container['is_automatic_soft_reminder_enabled'];
    }

    /**
     * Sets is_automatic_soft_reminder_enabled
     *
     * @param bool $is_automatic_soft_reminder_enabled Has automatic soft reminders enabled for this customer.
     *
     * @return $this
     */
    public function setIsAutomaticSoftReminderEnabled($is_automatic_soft_reminder_enabled)
    {
        $this->container['is_automatic_soft_reminder_enabled'] = $is_automatic_soft_reminder_enabled;

        return $this;
    }

    /**
     * Gets is_automatic_reminder_enabled
     *
     * @return bool
     */
    public function getIsAutomaticReminderEnabled()
    {
        return $this->container['is_automatic_reminder_enabled'];
    }

    /**
     * Sets is_automatic_reminder_enabled
     *
     * @param bool $is_automatic_reminder_enabled Has automatic reminders enabled for this customer.
     *
     * @return $this
     */
    public function setIsAutomaticReminderEnabled($is_automatic_reminder_enabled)
    {
        $this->container['is_automatic_reminder_enabled'] = $is_automatic_reminder_enabled;

        return $this;
    }

    /**
     * Gets is_automatic_notice_of_debt_collection_enabled
     *
     * @return bool
     */
    public function getIsAutomaticNoticeOfDebtCollectionEnabled()
    {
        return $this->container['is_automatic_notice_of_debt_collection_enabled'];
    }

    /**
     * Sets is_automatic_notice_of_debt_collection_enabled
     *
     * @param bool $is_automatic_notice_of_debt_collection_enabled Has automatic notice of debt collection enabled for this customer.
     *
     * @return $this
     */
    public function setIsAutomaticNoticeOfDebtCollectionEnabled($is_automatic_notice_of_debt_collection_enabled)
    {
        $this->container['is_automatic_notice_of_debt_collection_enabled'] = $is_automatic_notice_of_debt_collection_enabled;

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
