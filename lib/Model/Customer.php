<?php
/**
 * Customer
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
 * Customer Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Customer implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Customer';

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
        'is_automatic_notice_of_debt_collection_enabled' => 'bool'
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
        'is_automatic_notice_of_debt_collection_enabled' => null
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
		'name' => false,
		'organization_number' => false,
		'supplier_number' => false,
		'customer_number' => false,
		'is_supplier' => false,
		'is_customer' => false,
		'is_inactive' => false,
		'account_manager' => false,
		'email' => false,
		'invoice_email' => false,
		'overdue_notice_email' => false,
		'bank_accounts' => false,
		'phone_number' => false,
		'phone_number_mobile' => false,
		'description' => false,
		'language' => false,
		'display_name' => false,
		'is_private_individual' => false,
		'single_customer_invoice' => false,
		'invoice_send_method' => false,
		'email_attachment_type' => false,
		'postal_address' => false,
		'physical_address' => false,
		'delivery_address' => false,
		'category1' => false,
		'category2' => false,
		'category3' => false,
		'invoices_due_in' => false,
		'invoices_due_in_type' => false,
		'currency' => false,
		'bank_account_presentation' => false,
		'ledger_account' => false,
		'is_factoring' => false,
		'invoice_send_sms_notification' => false,
		'is_automatic_soft_reminder_enabled' => false,
		'is_automatic_reminder_enabled' => false,
		'is_automatic_notice_of_debt_collection_enabled' => false
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
        'is_automatic_notice_of_debt_collection_enabled' => 'isAutomaticNoticeOfDebtCollectionEnabled'
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
        'is_automatic_notice_of_debt_collection_enabled' => 'setIsAutomaticNoticeOfDebtCollectionEnabled'
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
        'is_automatic_notice_of_debt_collection_enabled' => 'getIsAutomaticNoticeOfDebtCollectionEnabled'
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

    public const LANGUAGE_NO = 'NO';
    public const LANGUAGE_EN = 'EN';
    public const LANGUAGE_SV = 'SV';
    public const INVOICE_SEND_METHOD_EMAIL = 'EMAIL';
    public const INVOICE_SEND_METHOD_EHF = 'EHF';
    public const INVOICE_SEND_METHOD_EFAKTURA = 'EFAKTURA';
    public const INVOICE_SEND_METHOD_AVTALEGIRO = 'AVTALEGIRO';
    public const INVOICE_SEND_METHOD_VIPPS = 'VIPPS';
    public const INVOICE_SEND_METHOD_PAPER = 'PAPER';
    public const INVOICE_SEND_METHOD_MANUAL = 'MANUAL';
    public const EMAIL_ATTACHMENT_TYPE_LINK = 'LINK';
    public const EMAIL_ATTACHMENT_TYPE_ATTACHMENT = 'ATTACHMENT';
    public const INVOICES_DUE_IN_TYPE_DAYS = 'DAYS';
    public const INVOICES_DUE_IN_TYPE_MONTHS = 'MONTHS';
    public const INVOICES_DUE_IN_TYPE_RECURRING_DAY_OF_MONTH = 'RECURRING_DAY_OF_MONTH';

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
            self::LANGUAGE_SV,
        ];
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
            self::INVOICE_SEND_METHOD_MANUAL,
        ];
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
            self::EMAIL_ATTACHMENT_TYPE_ATTACHMENT,
        ];
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
            self::INVOICES_DUE_IN_TYPE_RECURRING_DAY_OF_MONTH,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('organization_number', $data ?? [], null);
        $this->setIfExists('supplier_number', $data ?? [], null);
        $this->setIfExists('customer_number', $data ?? [], null);
        $this->setIfExists('is_supplier', $data ?? [], null);
        $this->setIfExists('is_customer', $data ?? [], null);
        $this->setIfExists('is_inactive', $data ?? [], null);
        $this->setIfExists('account_manager', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('invoice_email', $data ?? [], null);
        $this->setIfExists('overdue_notice_email', $data ?? [], null);
        $this->setIfExists('bank_accounts', $data ?? [], null);
        $this->setIfExists('phone_number', $data ?? [], null);
        $this->setIfExists('phone_number_mobile', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('language', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('is_private_individual', $data ?? [], null);
        $this->setIfExists('single_customer_invoice', $data ?? [], null);
        $this->setIfExists('invoice_send_method', $data ?? [], null);
        $this->setIfExists('email_attachment_type', $data ?? [], null);
        $this->setIfExists('postal_address', $data ?? [], null);
        $this->setIfExists('physical_address', $data ?? [], null);
        $this->setIfExists('delivery_address', $data ?? [], null);
        $this->setIfExists('category1', $data ?? [], null);
        $this->setIfExists('category2', $data ?? [], null);
        $this->setIfExists('category3', $data ?? [], null);
        $this->setIfExists('invoices_due_in', $data ?? [], null);
        $this->setIfExists('invoices_due_in_type', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('bank_account_presentation', $data ?? [], null);
        $this->setIfExists('ledger_account', $data ?? [], null);
        $this->setIfExists('is_factoring', $data ?? [], null);
        $this->setIfExists('invoice_send_sms_notification', $data ?? [], null);
        $this->setIfExists('is_automatic_soft_reminder_enabled', $data ?? [], null);
        $this->setIfExists('is_automatic_reminder_enabled', $data ?? [], null);
        $this->setIfExists('is_automatic_notice_of_debt_collection_enabled', $data ?? [], null);
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

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 255)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['organization_number']) && (mb_strlen($this->container['organization_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'organization_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['supplier_number']) && ($this->container['supplier_number'] < 0)) {
            $invalidProperties[] = "invalid value for 'supplier_number', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['customer_number']) && ($this->container['customer_number'] < 0)) {
            $invalidProperties[] = "invalid value for 'customer_number', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['email']) && (mb_strlen($this->container['email']) > 254)) {
            $invalidProperties[] = "invalid value for 'email', the character length must be smaller than or equal to 254.";
        }

        if (!is_null($this->container['email']) && (mb_strlen($this->container['email']) < 0)) {
            $invalidProperties[] = "invalid value for 'email', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['invoice_email']) && (mb_strlen($this->container['invoice_email']) > 254)) {
            $invalidProperties[] = "invalid value for 'invoice_email', the character length must be smaller than or equal to 254.";
        }

        if (!is_null($this->container['invoice_email']) && (mb_strlen($this->container['invoice_email']) < 0)) {
            $invalidProperties[] = "invalid value for 'invoice_email', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['overdue_notice_email']) && (mb_strlen($this->container['overdue_notice_email']) > 254)) {
            $invalidProperties[] = "invalid value for 'overdue_notice_email', the character length must be smaller than or equal to 254.";
        }

        if (!is_null($this->container['overdue_notice_email']) && (mb_strlen($this->container['overdue_notice_email']) < 0)) {
            $invalidProperties[] = "invalid value for 'overdue_notice_email', the character length must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['phone_number']) && (mb_strlen($this->container['phone_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['phone_number_mobile']) && (mb_strlen($this->container['phone_number_mobile']) > 100)) {
            $invalidProperties[] = "invalid value for 'phone_number_mobile', the character length must be smaller than or equal to 100.";
        }

        $allowedValues = $this->getLanguageAllowableValues();
        if (!is_null($this->container['language']) && !in_array($this->container['language'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'language', must be one of '%s'",
                $this->container['language'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getInvoiceSendMethodAllowableValues();
        if (!is_null($this->container['invoice_send_method']) && !in_array($this->container['invoice_send_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_send_method', must be one of '%s'",
                $this->container['invoice_send_method'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getEmailAttachmentTypeAllowableValues();
        if (!is_null($this->container['email_attachment_type']) && !in_array($this->container['email_attachment_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'email_attachment_type', must be one of '%s'",
                $this->container['email_attachment_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['invoices_due_in']) && ($this->container['invoices_due_in'] > 10000)) {
            $invalidProperties[] = "invalid value for 'invoices_due_in', must be smaller than or equal to 10000.";
        }

        if (!is_null($this->container['invoices_due_in']) && ($this->container['invoices_due_in'] < 0)) {
            $invalidProperties[] = "invalid value for 'invoices_due_in', must be bigger than or equal to 0.";
        }

        $allowedValues = $this->getInvoicesDueInTypeAllowableValues();
        if (!is_null($this->container['invoices_due_in_type']) && !in_array($this->container['invoices_due_in_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoices_due_in_type', must be one of '%s'",
                $this->container['invoices_due_in_type'],
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
     * @return self
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Customer., must be smaller than or equal to 255.');
        }


        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets organization_number
     *
     * @return string|null
     */
    public function getOrganizationNumber()
    {
        return $this->container['organization_number'];
    }

    /**
     * Sets organization_number
     *
     * @param string|null $organization_number organization_number
     *
     * @return self
     */
    public function setOrganizationNumber($organization_number)
    {
        if (!is_null($organization_number) && (mb_strlen($organization_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $organization_number when calling Customer., must be smaller than or equal to 100.');
        }


        if (is_null($organization_number)) {
            throw new \InvalidArgumentException('non-nullable organization_number cannot be null');
        }

        $this->container['organization_number'] = $organization_number;

        return $this;
    }

    /**
     * Gets supplier_number
     *
     * @return int|null
     */
    public function getSupplierNumber()
    {
        return $this->container['supplier_number'];
    }

    /**
     * Sets supplier_number
     *
     * @param int|null $supplier_number supplier_number
     *
     * @return self
     */
    public function setSupplierNumber($supplier_number)
    {

        if (!is_null($supplier_number) && ($supplier_number < 0)) {
            throw new \InvalidArgumentException('invalid value for $supplier_number when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($supplier_number)) {
            throw new \InvalidArgumentException('non-nullable supplier_number cannot be null');
        }

        $this->container['supplier_number'] = $supplier_number;

        return $this;
    }

    /**
     * Gets customer_number
     *
     * @return int|null
     */
    public function getCustomerNumber()
    {
        return $this->container['customer_number'];
    }

    /**
     * Sets customer_number
     *
     * @param int|null $customer_number customer_number
     *
     * @return self
     */
    public function setCustomerNumber($customer_number)
    {

        if (!is_null($customer_number) && ($customer_number < 0)) {
            throw new \InvalidArgumentException('invalid value for $customer_number when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($customer_number)) {
            throw new \InvalidArgumentException('non-nullable customer_number cannot be null');
        }

        $this->container['customer_number'] = $customer_number;

        return $this;
    }

    /**
     * Gets is_supplier
     *
     * @return bool|null
     */
    public function getIsSupplier()
    {
        return $this->container['is_supplier'];
    }

    /**
     * Sets is_supplier
     *
     * @param bool|null $is_supplier Defines if the customer is also a supplier.
     *
     * @return self
     */
    public function setIsSupplier($is_supplier)
    {

        if (is_null($is_supplier)) {
            throw new \InvalidArgumentException('non-nullable is_supplier cannot be null');
        }

        $this->container['is_supplier'] = $is_supplier;

        return $this;
    }

    /**
     * Gets is_customer
     *
     * @return bool|null
     */
    public function getIsCustomer()
    {
        return $this->container['is_customer'];
    }

    /**
     * Sets is_customer
     *
     * @param bool|null $is_customer is_customer
     *
     * @return self
     */
    public function setIsCustomer($is_customer)
    {

        if (is_null($is_customer)) {
            throw new \InvalidArgumentException('non-nullable is_customer cannot be null');
        }

        $this->container['is_customer'] = $is_customer;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool|null
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool|null $is_inactive is_inactive
     *
     * @return self
     */
    public function setIsInactive($is_inactive)
    {

        if (is_null($is_inactive)) {
            throw new \InvalidArgumentException('non-nullable is_inactive cannot be null');
        }

        $this->container['is_inactive'] = $is_inactive;

        return $this;
    }

    /**
     * Gets account_manager
     *
     * @return \Learnist\Tripletex\Model\Employee|null
     */
    public function getAccountManager()
    {
        return $this->container['account_manager'];
    }

    /**
     * Sets account_manager
     *
     * @param \Learnist\Tripletex\Model\Employee|null $account_manager account_manager
     *
     * @return self
     */
    public function setAccountManager($account_manager)
    {

        if (is_null($account_manager)) {
            throw new \InvalidArgumentException('non-nullable account_manager cannot be null');
        }

        $this->container['account_manager'] = $account_manager;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (!is_null($email) && (mb_strlen($email) > 254)) {
            throw new \InvalidArgumentException('invalid length for $email when calling Customer., must be smaller than or equal to 254.');
        }
        if (!is_null($email) && (mb_strlen($email) < 0)) {
            throw new \InvalidArgumentException('invalid length for $email when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets invoice_email
     *
     * @return string|null
     */
    public function getInvoiceEmail()
    {
        return $this->container['invoice_email'];
    }

    /**
     * Sets invoice_email
     *
     * @param string|null $invoice_email invoice_email
     *
     * @return self
     */
    public function setInvoiceEmail($invoice_email)
    {
        if (!is_null($invoice_email) && (mb_strlen($invoice_email) > 254)) {
            throw new \InvalidArgumentException('invalid length for $invoice_email when calling Customer., must be smaller than or equal to 254.');
        }
        if (!is_null($invoice_email) && (mb_strlen($invoice_email) < 0)) {
            throw new \InvalidArgumentException('invalid length for $invoice_email when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($invoice_email)) {
            throw new \InvalidArgumentException('non-nullable invoice_email cannot be null');
        }

        $this->container['invoice_email'] = $invoice_email;

        return $this;
    }

    /**
     * Gets overdue_notice_email
     *
     * @return string|null
     */
    public function getOverdueNoticeEmail()
    {
        return $this->container['overdue_notice_email'];
    }

    /**
     * Sets overdue_notice_email
     *
     * @param string|null $overdue_notice_email The email address of the customer where the noticing emails are sent in case of an overdue
     *
     * @return self
     */
    public function setOverdueNoticeEmail($overdue_notice_email)
    {
        if (!is_null($overdue_notice_email) && (mb_strlen($overdue_notice_email) > 254)) {
            throw new \InvalidArgumentException('invalid length for $overdue_notice_email when calling Customer., must be smaller than or equal to 254.');
        }
        if (!is_null($overdue_notice_email) && (mb_strlen($overdue_notice_email) < 0)) {
            throw new \InvalidArgumentException('invalid length for $overdue_notice_email when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($overdue_notice_email)) {
            throw new \InvalidArgumentException('non-nullable overdue_notice_email cannot be null');
        }

        $this->container['overdue_notice_email'] = $overdue_notice_email;

        return $this;
    }

    /**
     * Gets bank_accounts
     *
     * @return string[]|null
     */
    public function getBankAccounts()
    {
        return $this->container['bank_accounts'];
    }

    /**
     * Sets bank_accounts
     *
     * @param string[]|null $bank_accounts [DEPRECATED] List of the bank account numbers for this customer. Norwegian bank account numbers only.
     *
     * @return self
     */
    public function setBankAccounts($bank_accounts)
    {

        if (is_null($bank_accounts)) {
            throw new \InvalidArgumentException('non-nullable bank_accounts cannot be null');
        }

        $this->container['bank_accounts'] = $bank_accounts;

        return $this;
    }

    /**
     * Gets phone_number
     *
     * @return string|null
     */
    public function getPhoneNumber()
    {
        return $this->container['phone_number'];
    }

    /**
     * Sets phone_number
     *
     * @param string|null $phone_number phone_number
     *
     * @return self
     */
    public function setPhoneNumber($phone_number)
    {
        if (!is_null($phone_number) && (mb_strlen($phone_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number when calling Customer., must be smaller than or equal to 100.');
        }


        if (is_null($phone_number)) {
            throw new \InvalidArgumentException('non-nullable phone_number cannot be null');
        }

        $this->container['phone_number'] = $phone_number;

        return $this;
    }

    /**
     * Gets phone_number_mobile
     *
     * @return string|null
     */
    public function getPhoneNumberMobile()
    {
        return $this->container['phone_number_mobile'];
    }

    /**
     * Sets phone_number_mobile
     *
     * @param string|null $phone_number_mobile phone_number_mobile
     *
     * @return self
     */
    public function setPhoneNumberMobile($phone_number_mobile)
    {
        if (!is_null($phone_number_mobile) && (mb_strlen($phone_number_mobile) > 100)) {
            throw new \InvalidArgumentException('invalid length for $phone_number_mobile when calling Customer., must be smaller than or equal to 100.');
        }


        if (is_null($phone_number_mobile)) {
            throw new \InvalidArgumentException('non-nullable phone_number_mobile cannot be null');
        }

        $this->container['phone_number_mobile'] = $phone_number_mobile;

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
     * Gets language
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param string|null $language language
     *
     * @return self
     */
    public function setLanguage($language)
    {
        $allowedValues = $this->getLanguageAllowableValues();
        if (!is_null($language) && !in_array($language, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'language', must be one of '%s'",
                    $language,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($language)) {
            throw new \InvalidArgumentException('non-nullable language cannot be null');
        }

        $this->container['language'] = $language;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string|null $display_name display_name
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {

        if (is_null($display_name)) {
            throw new \InvalidArgumentException('non-nullable display_name cannot be null');
        }

        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets is_private_individual
     *
     * @return bool|null
     */
    public function getIsPrivateIndividual()
    {
        return $this->container['is_private_individual'];
    }

    /**
     * Sets is_private_individual
     *
     * @param bool|null $is_private_individual is_private_individual
     *
     * @return self
     */
    public function setIsPrivateIndividual($is_private_individual)
    {

        if (is_null($is_private_individual)) {
            throw new \InvalidArgumentException('non-nullable is_private_individual cannot be null');
        }

        $this->container['is_private_individual'] = $is_private_individual;

        return $this;
    }

    /**
     * Gets single_customer_invoice
     *
     * @return bool|null
     */
    public function getSingleCustomerInvoice()
    {
        return $this->container['single_customer_invoice'];
    }

    /**
     * Sets single_customer_invoice
     *
     * @param bool|null $single_customer_invoice Enables various orders on one customer invoice.
     *
     * @return self
     */
    public function setSingleCustomerInvoice($single_customer_invoice)
    {

        if (is_null($single_customer_invoice)) {
            throw new \InvalidArgumentException('non-nullable single_customer_invoice cannot be null');
        }

        $this->container['single_customer_invoice'] = $single_customer_invoice;

        return $this;
    }

    /**
     * Gets invoice_send_method
     *
     * @return string|null
     */
    public function getInvoiceSendMethod()
    {
        return $this->container['invoice_send_method'];
    }

    /**
     * Sets invoice_send_method
     *
     * @param string|null $invoice_send_method Define the invoicing method for the customer.<br>EMAIL: Send invoices as email.<br>EHF: Send invoices as EHF.<br>EFAKTURA: Send invoices as EFAKTURA.<br>AVTALEGIRO: Send invoices as AVTALEGIRO.<br>VIPPS: Send invoices through VIPPS.<br>PAPER: Send invoices as paper invoice.<br>MANUAL: User will have to send invocie manually.<br>
     *
     * @return self
     */
    public function setInvoiceSendMethod($invoice_send_method)
    {
        $allowedValues = $this->getInvoiceSendMethodAllowableValues();
        if (!is_null($invoice_send_method) && !in_array($invoice_send_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_send_method', must be one of '%s'",
                    $invoice_send_method,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($invoice_send_method)) {
            throw new \InvalidArgumentException('non-nullable invoice_send_method cannot be null');
        }

        $this->container['invoice_send_method'] = $invoice_send_method;

        return $this;
    }

    /**
     * Gets email_attachment_type
     *
     * @return string|null
     */
    public function getEmailAttachmentType()
    {
        return $this->container['email_attachment_type'];
    }

    /**
     * Sets email_attachment_type
     *
     * @param string|null $email_attachment_type Define the invoice attachment type for emailing to the customer.<br>LINK: Send invoice as link in email.<br>ATTACHMENT: Send invoice as attachment in email.<br>
     *
     * @return self
     */
    public function setEmailAttachmentType($email_attachment_type)
    {
        $allowedValues = $this->getEmailAttachmentTypeAllowableValues();
        if (!is_null($email_attachment_type) && !in_array($email_attachment_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'email_attachment_type', must be one of '%s'",
                    $email_attachment_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($email_attachment_type)) {
            throw new \InvalidArgumentException('non-nullable email_attachment_type cannot be null');
        }

        $this->container['email_attachment_type'] = $email_attachment_type;

        return $this;
    }

    /**
     * Gets postal_address
     *
     * @return \Learnist\Tripletex\Model\Address|null
     */
    public function getPostalAddress()
    {
        return $this->container['postal_address'];
    }

    /**
     * Sets postal_address
     *
     * @param \Learnist\Tripletex\Model\Address|null $postal_address postal_address
     *
     * @return self
     */
    public function setPostalAddress($postal_address)
    {

        if (is_null($postal_address)) {
            throw new \InvalidArgumentException('non-nullable postal_address cannot be null');
        }

        $this->container['postal_address'] = $postal_address;

        return $this;
    }

    /**
     * Gets physical_address
     *
     * @return \Learnist\Tripletex\Model\Address|null
     */
    public function getPhysicalAddress()
    {
        return $this->container['physical_address'];
    }

    /**
     * Sets physical_address
     *
     * @param \Learnist\Tripletex\Model\Address|null $physical_address physical_address
     *
     * @return self
     */
    public function setPhysicalAddress($physical_address)
    {

        if (is_null($physical_address)) {
            throw new \InvalidArgumentException('non-nullable physical_address cannot be null');
        }

        $this->container['physical_address'] = $physical_address;

        return $this;
    }

    /**
     * Gets delivery_address
     *
     * @return \Learnist\Tripletex\Model\DeliveryAddress|null
     */
    public function getDeliveryAddress()
    {
        return $this->container['delivery_address'];
    }

    /**
     * Sets delivery_address
     *
     * @param \Learnist\Tripletex\Model\DeliveryAddress|null $delivery_address delivery_address
     *
     * @return self
     */
    public function setDeliveryAddress($delivery_address)
    {

        if (is_null($delivery_address)) {
            throw new \InvalidArgumentException('non-nullable delivery_address cannot be null');
        }

        $this->container['delivery_address'] = $delivery_address;

        return $this;
    }

    /**
     * Gets category1
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory|null
     */
    public function getCategory1()
    {
        return $this->container['category1'];
    }

    /**
     * Sets category1
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory|null $category1 category1
     *
     * @return self
     */
    public function setCategory1($category1)
    {

        if (is_null($category1)) {
            throw new \InvalidArgumentException('non-nullable category1 cannot be null');
        }

        $this->container['category1'] = $category1;

        return $this;
    }

    /**
     * Gets category2
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory|null
     */
    public function getCategory2()
    {
        return $this->container['category2'];
    }

    /**
     * Sets category2
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory|null $category2 category2
     *
     * @return self
     */
    public function setCategory2($category2)
    {

        if (is_null($category2)) {
            throw new \InvalidArgumentException('non-nullable category2 cannot be null');
        }

        $this->container['category2'] = $category2;

        return $this;
    }

    /**
     * Gets category3
     *
     * @return \Learnist\Tripletex\Model\CustomerCategory|null
     */
    public function getCategory3()
    {
        return $this->container['category3'];
    }

    /**
     * Sets category3
     *
     * @param \Learnist\Tripletex\Model\CustomerCategory|null $category3 category3
     *
     * @return self
     */
    public function setCategory3($category3)
    {

        if (is_null($category3)) {
            throw new \InvalidArgumentException('non-nullable category3 cannot be null');
        }

        $this->container['category3'] = $category3;

        return $this;
    }

    /**
     * Gets invoices_due_in
     *
     * @return int|null
     */
    public function getInvoicesDueIn()
    {
        return $this->container['invoices_due_in'];
    }

    /**
     * Sets invoices_due_in
     *
     * @param int|null $invoices_due_in Number of days/months in which invoices created from this customer is due
     *
     * @return self
     */
    public function setInvoicesDueIn($invoices_due_in)
    {

        if (!is_null($invoices_due_in) && ($invoices_due_in > 10000)) {
            throw new \InvalidArgumentException('invalid value for $invoices_due_in when calling Customer., must be smaller than or equal to 10000.');
        }
        if (!is_null($invoices_due_in) && ($invoices_due_in < 0)) {
            throw new \InvalidArgumentException('invalid value for $invoices_due_in when calling Customer., must be bigger than or equal to 0.');
        }


        if (is_null($invoices_due_in)) {
            throw new \InvalidArgumentException('non-nullable invoices_due_in cannot be null');
        }

        $this->container['invoices_due_in'] = $invoices_due_in;

        return $this;
    }

    /**
     * Gets invoices_due_in_type
     *
     * @return string|null
     */
    public function getInvoicesDueInType()
    {
        return $this->container['invoices_due_in_type'];
    }

    /**
     * Sets invoices_due_in_type
     *
     * @param string|null $invoices_due_in_type Set the time unit of invoicesDueIn. The special case RECURRING_DAY_OF_MONTH enables the due date to be fixed to a specific day of the month, in this case the fixed due date will automatically be set as standard on all invoices created from this customer. Note that when RECURRING_DAY_OF_MONTH is set, the due date will be set to the last day of month if \"31\" is set in invoicesDueIn.
     *
     * @return self
     */
    public function setInvoicesDueInType($invoices_due_in_type)
    {
        $allowedValues = $this->getInvoicesDueInTypeAllowableValues();
        if (!is_null($invoices_due_in_type) && !in_array($invoices_due_in_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoices_due_in_type', must be one of '%s'",
                    $invoices_due_in_type,
                    implode("', '", $allowedValues)
                )
            );
        }

        if (is_null($invoices_due_in_type)) {
            throw new \InvalidArgumentException('non-nullable invoices_due_in_type cannot be null');
        }

        $this->container['invoices_due_in_type'] = $invoices_due_in_type;

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
     * Gets bank_account_presentation
     *
     * @return \Learnist\Tripletex\Model\CompanyBankAccountPresentation[]|null
     */
    public function getBankAccountPresentation()
    {
        return $this->container['bank_account_presentation'];
    }

    /**
     * Sets bank_account_presentation
     *
     * @param \Learnist\Tripletex\Model\CompanyBankAccountPresentation[]|null $bank_account_presentation List of bankAccount for this customer
     *
     * @return self
     */
    public function setBankAccountPresentation($bank_account_presentation)
    {

        if (is_null($bank_account_presentation)) {
            throw new \InvalidArgumentException('non-nullable bank_account_presentation cannot be null');
        }

        $this->container['bank_account_presentation'] = $bank_account_presentation;

        return $this;
    }

    /**
     * Gets ledger_account
     *
     * @return \Learnist\Tripletex\Model\Account|null
     */
    public function getLedgerAccount()
    {
        return $this->container['ledger_account'];
    }

    /**
     * Sets ledger_account
     *
     * @param \Learnist\Tripletex\Model\Account|null $ledger_account ledger_account
     *
     * @return self
     */
    public function setLedgerAccount($ledger_account)
    {

        if (is_null($ledger_account)) {
            throw new \InvalidArgumentException('non-nullable ledger_account cannot be null');
        }

        $this->container['ledger_account'] = $ledger_account;

        return $this;
    }

    /**
     * Gets is_factoring
     *
     * @return bool|null
     */
    public function getIsFactoring()
    {
        return $this->container['is_factoring'];
    }

    /**
     * Sets is_factoring
     *
     * @param bool|null $is_factoring If true; send this customers invoices to factoring (if factoring is turned on in account).
     *
     * @return self
     */
    public function setIsFactoring($is_factoring)
    {

        if (is_null($is_factoring)) {
            throw new \InvalidArgumentException('non-nullable is_factoring cannot be null');
        }

        $this->container['is_factoring'] = $is_factoring;

        return $this;
    }

    /**
     * Gets invoice_send_sms_notification
     *
     * @return bool|null
     */
    public function getInvoiceSendSmsNotification()
    {
        return $this->container['invoice_send_sms_notification'];
    }

    /**
     * Sets invoice_send_sms_notification
     *
     * @param bool|null $invoice_send_sms_notification Is sms-notification on/off
     *
     * @return self
     */
    public function setInvoiceSendSmsNotification($invoice_send_sms_notification)
    {

        if (is_null($invoice_send_sms_notification)) {
            throw new \InvalidArgumentException('non-nullable invoice_send_sms_notification cannot be null');
        }

        $this->container['invoice_send_sms_notification'] = $invoice_send_sms_notification;

        return $this;
    }

    /**
     * Gets is_automatic_soft_reminder_enabled
     *
     * @return bool|null
     */
    public function getIsAutomaticSoftReminderEnabled()
    {
        return $this->container['is_automatic_soft_reminder_enabled'];
    }

    /**
     * Sets is_automatic_soft_reminder_enabled
     *
     * @param bool|null $is_automatic_soft_reminder_enabled Has automatic soft reminders enabled for this customer.
     *
     * @return self
     */
    public function setIsAutomaticSoftReminderEnabled($is_automatic_soft_reminder_enabled)
    {

        if (is_null($is_automatic_soft_reminder_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_soft_reminder_enabled cannot be null');
        }

        $this->container['is_automatic_soft_reminder_enabled'] = $is_automatic_soft_reminder_enabled;

        return $this;
    }

    /**
     * Gets is_automatic_reminder_enabled
     *
     * @return bool|null
     */
    public function getIsAutomaticReminderEnabled()
    {
        return $this->container['is_automatic_reminder_enabled'];
    }

    /**
     * Sets is_automatic_reminder_enabled
     *
     * @param bool|null $is_automatic_reminder_enabled Has automatic reminders enabled for this customer.
     *
     * @return self
     */
    public function setIsAutomaticReminderEnabled($is_automatic_reminder_enabled)
    {

        if (is_null($is_automatic_reminder_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_reminder_enabled cannot be null');
        }

        $this->container['is_automatic_reminder_enabled'] = $is_automatic_reminder_enabled;

        return $this;
    }

    /**
     * Gets is_automatic_notice_of_debt_collection_enabled
     *
     * @return bool|null
     */
    public function getIsAutomaticNoticeOfDebtCollectionEnabled()
    {
        return $this->container['is_automatic_notice_of_debt_collection_enabled'];
    }

    /**
     * Sets is_automatic_notice_of_debt_collection_enabled
     *
     * @param bool|null $is_automatic_notice_of_debt_collection_enabled Has automatic notice of debt collection enabled for this customer.
     *
     * @return self
     */
    public function setIsAutomaticNoticeOfDebtCollectionEnabled($is_automatic_notice_of_debt_collection_enabled)
    {

        if (is_null($is_automatic_notice_of_debt_collection_enabled)) {
            throw new \InvalidArgumentException('non-nullable is_automatic_notice_of_debt_collection_enabled cannot be null');
        }

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


