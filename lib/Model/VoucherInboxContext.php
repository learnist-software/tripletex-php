<?php
/**
 * VoucherInboxContext
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
 * VoucherInboxContext Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class VoucherInboxContext implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'VoucherInboxContext';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'context_id' => 'int',
'locale' => 'string',
'company_name' => 'string',
'show_inbox' => 'bool',
'show_attestation' => 'bool',
'show_follow_up' => 'bool',
'show_last_updated' => 'bool',
'show_go_to_payment' => 'bool',
'has_department' => 'bool',
'has_project' => 'bool',
'has_automation' => 'bool',
'can_user_upload' => 'bool',
'can_user_edit' => 'bool',
'can_user_delete' => 'bool',
'can_user_register_incoming_invoice' => 'bool',
'can_user_register_bank_reconciliation' => 'bool',
'can_user_register_advanced_voucher' => 'bool',
'can_user_register_payment_in' => 'bool',
'can_user_register_income' => 'bool',
'can_user_register_customs_declaration' => 'bool',
'in_developer_mode' => 'bool',
'voucher_scanning_email' => 'string',
'main_bank_account_id' => 'int',
'employee_id' => 'int',
'automated_vouchers_this_week' => 'int',
'tripletex_start_date' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'context_id' => 'int32',
'locale' => null,
'company_name' => null,
'show_inbox' => null,
'show_attestation' => null,
'show_follow_up' => null,
'show_last_updated' => null,
'show_go_to_payment' => null,
'has_department' => null,
'has_project' => null,
'has_automation' => null,
'can_user_upload' => null,
'can_user_edit' => null,
'can_user_delete' => null,
'can_user_register_incoming_invoice' => null,
'can_user_register_bank_reconciliation' => null,
'can_user_register_advanced_voucher' => null,
'can_user_register_payment_in' => null,
'can_user_register_income' => null,
'can_user_register_customs_declaration' => null,
'in_developer_mode' => null,
'voucher_scanning_email' => null,
'main_bank_account_id' => 'int32',
'employee_id' => 'int32',
'automated_vouchers_this_week' => 'int32',
'tripletex_start_date' => null    ];

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
        'context_id' => 'contextId',
'locale' => 'locale',
'company_name' => 'companyName',
'show_inbox' => 'showInbox',
'show_attestation' => 'showAttestation',
'show_follow_up' => 'showFollowUp',
'show_last_updated' => 'showLastUpdated',
'show_go_to_payment' => 'showGoToPayment',
'has_department' => 'hasDepartment',
'has_project' => 'hasProject',
'has_automation' => 'hasAutomation',
'can_user_upload' => 'canUserUpload',
'can_user_edit' => 'canUserEdit',
'can_user_delete' => 'canUserDelete',
'can_user_register_incoming_invoice' => 'canUserRegisterIncomingInvoice',
'can_user_register_bank_reconciliation' => 'canUserRegisterBankReconciliation',
'can_user_register_advanced_voucher' => 'canUserRegisterAdvancedVoucher',
'can_user_register_payment_in' => 'canUserRegisterPaymentIn',
'can_user_register_income' => 'canUserRegisterIncome',
'can_user_register_customs_declaration' => 'canUserRegisterCustomsDeclaration',
'in_developer_mode' => 'inDeveloperMode',
'voucher_scanning_email' => 'voucherScanningEmail',
'main_bank_account_id' => 'mainBankAccountId',
'employee_id' => 'employeeId',
'automated_vouchers_this_week' => 'automatedVouchersThisWeek',
'tripletex_start_date' => 'tripletexStartDate'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'context_id' => 'setContextId',
'locale' => 'setLocale',
'company_name' => 'setCompanyName',
'show_inbox' => 'setShowInbox',
'show_attestation' => 'setShowAttestation',
'show_follow_up' => 'setShowFollowUp',
'show_last_updated' => 'setShowLastUpdated',
'show_go_to_payment' => 'setShowGoToPayment',
'has_department' => 'setHasDepartment',
'has_project' => 'setHasProject',
'has_automation' => 'setHasAutomation',
'can_user_upload' => 'setCanUserUpload',
'can_user_edit' => 'setCanUserEdit',
'can_user_delete' => 'setCanUserDelete',
'can_user_register_incoming_invoice' => 'setCanUserRegisterIncomingInvoice',
'can_user_register_bank_reconciliation' => 'setCanUserRegisterBankReconciliation',
'can_user_register_advanced_voucher' => 'setCanUserRegisterAdvancedVoucher',
'can_user_register_payment_in' => 'setCanUserRegisterPaymentIn',
'can_user_register_income' => 'setCanUserRegisterIncome',
'can_user_register_customs_declaration' => 'setCanUserRegisterCustomsDeclaration',
'in_developer_mode' => 'setInDeveloperMode',
'voucher_scanning_email' => 'setVoucherScanningEmail',
'main_bank_account_id' => 'setMainBankAccountId',
'employee_id' => 'setEmployeeId',
'automated_vouchers_this_week' => 'setAutomatedVouchersThisWeek',
'tripletex_start_date' => 'setTripletexStartDate'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'context_id' => 'getContextId',
'locale' => 'getLocale',
'company_name' => 'getCompanyName',
'show_inbox' => 'getShowInbox',
'show_attestation' => 'getShowAttestation',
'show_follow_up' => 'getShowFollowUp',
'show_last_updated' => 'getShowLastUpdated',
'show_go_to_payment' => 'getShowGoToPayment',
'has_department' => 'getHasDepartment',
'has_project' => 'getHasProject',
'has_automation' => 'getHasAutomation',
'can_user_upload' => 'getCanUserUpload',
'can_user_edit' => 'getCanUserEdit',
'can_user_delete' => 'getCanUserDelete',
'can_user_register_incoming_invoice' => 'getCanUserRegisterIncomingInvoice',
'can_user_register_bank_reconciliation' => 'getCanUserRegisterBankReconciliation',
'can_user_register_advanced_voucher' => 'getCanUserRegisterAdvancedVoucher',
'can_user_register_payment_in' => 'getCanUserRegisterPaymentIn',
'can_user_register_income' => 'getCanUserRegisterIncome',
'can_user_register_customs_declaration' => 'getCanUserRegisterCustomsDeclaration',
'in_developer_mode' => 'getInDeveloperMode',
'voucher_scanning_email' => 'getVoucherScanningEmail',
'main_bank_account_id' => 'getMainBankAccountId',
'employee_id' => 'getEmployeeId',
'automated_vouchers_this_week' => 'getAutomatedVouchersThisWeek',
'tripletex_start_date' => 'getTripletexStartDate'    ];

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
        $this->container['context_id'] = isset($data['context_id']) ? $data['context_id'] : null;
        $this->container['locale'] = isset($data['locale']) ? $data['locale'] : null;
        $this->container['company_name'] = isset($data['company_name']) ? $data['company_name'] : null;
        $this->container['show_inbox'] = isset($data['show_inbox']) ? $data['show_inbox'] : null;
        $this->container['show_attestation'] = isset($data['show_attestation']) ? $data['show_attestation'] : null;
        $this->container['show_follow_up'] = isset($data['show_follow_up']) ? $data['show_follow_up'] : null;
        $this->container['show_last_updated'] = isset($data['show_last_updated']) ? $data['show_last_updated'] : null;
        $this->container['show_go_to_payment'] = isset($data['show_go_to_payment']) ? $data['show_go_to_payment'] : null;
        $this->container['has_department'] = isset($data['has_department']) ? $data['has_department'] : null;
        $this->container['has_project'] = isset($data['has_project']) ? $data['has_project'] : null;
        $this->container['has_automation'] = isset($data['has_automation']) ? $data['has_automation'] : null;
        $this->container['can_user_upload'] = isset($data['can_user_upload']) ? $data['can_user_upload'] : null;
        $this->container['can_user_edit'] = isset($data['can_user_edit']) ? $data['can_user_edit'] : null;
        $this->container['can_user_delete'] = isset($data['can_user_delete']) ? $data['can_user_delete'] : null;
        $this->container['can_user_register_incoming_invoice'] = isset($data['can_user_register_incoming_invoice']) ? $data['can_user_register_incoming_invoice'] : null;
        $this->container['can_user_register_bank_reconciliation'] = isset($data['can_user_register_bank_reconciliation']) ? $data['can_user_register_bank_reconciliation'] : null;
        $this->container['can_user_register_advanced_voucher'] = isset($data['can_user_register_advanced_voucher']) ? $data['can_user_register_advanced_voucher'] : null;
        $this->container['can_user_register_payment_in'] = isset($data['can_user_register_payment_in']) ? $data['can_user_register_payment_in'] : null;
        $this->container['can_user_register_income'] = isset($data['can_user_register_income']) ? $data['can_user_register_income'] : null;
        $this->container['can_user_register_customs_declaration'] = isset($data['can_user_register_customs_declaration']) ? $data['can_user_register_customs_declaration'] : null;
        $this->container['in_developer_mode'] = isset($data['in_developer_mode']) ? $data['in_developer_mode'] : null;
        $this->container['voucher_scanning_email'] = isset($data['voucher_scanning_email']) ? $data['voucher_scanning_email'] : null;
        $this->container['main_bank_account_id'] = isset($data['main_bank_account_id']) ? $data['main_bank_account_id'] : null;
        $this->container['employee_id'] = isset($data['employee_id']) ? $data['employee_id'] : null;
        $this->container['automated_vouchers_this_week'] = isset($data['automated_vouchers_this_week']) ? $data['automated_vouchers_this_week'] : null;
        $this->container['tripletex_start_date'] = isset($data['tripletex_start_date']) ? $data['tripletex_start_date'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets context_id
     *
     * @return int
     */
    public function getContextId()
    {
        return $this->container['context_id'];
    }

    /**
     * Sets context_id
     *
     * @param int $context_id context_id
     *
     * @return $this
     */
    public function setContextId($context_id)
    {
        $this->container['context_id'] = $context_id;

        return $this;
    }

    /**
     * Gets locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->container['locale'];
    }

    /**
     * Sets locale
     *
     * @param string $locale locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->container['locale'] = $locale;

        return $this;
    }

    /**
     * Gets company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->container['company_name'];
    }

    /**
     * Sets company_name
     *
     * @param string $company_name company_name
     *
     * @return $this
     */
    public function setCompanyName($company_name)
    {
        $this->container['company_name'] = $company_name;

        return $this;
    }

    /**
     * Gets show_inbox
     *
     * @return bool
     */
    public function getShowInbox()
    {
        return $this->container['show_inbox'];
    }

    /**
     * Sets show_inbox
     *
     * @param bool $show_inbox show_inbox
     *
     * @return $this
     */
    public function setShowInbox($show_inbox)
    {
        $this->container['show_inbox'] = $show_inbox;

        return $this;
    }

    /**
     * Gets show_attestation
     *
     * @return bool
     */
    public function getShowAttestation()
    {
        return $this->container['show_attestation'];
    }

    /**
     * Sets show_attestation
     *
     * @param bool $show_attestation show_attestation
     *
     * @return $this
     */
    public function setShowAttestation($show_attestation)
    {
        $this->container['show_attestation'] = $show_attestation;

        return $this;
    }

    /**
     * Gets show_follow_up
     *
     * @return bool
     */
    public function getShowFollowUp()
    {
        return $this->container['show_follow_up'];
    }

    /**
     * Sets show_follow_up
     *
     * @param bool $show_follow_up show_follow_up
     *
     * @return $this
     */
    public function setShowFollowUp($show_follow_up)
    {
        $this->container['show_follow_up'] = $show_follow_up;

        return $this;
    }

    /**
     * Gets show_last_updated
     *
     * @return bool
     */
    public function getShowLastUpdated()
    {
        return $this->container['show_last_updated'];
    }

    /**
     * Sets show_last_updated
     *
     * @param bool $show_last_updated show_last_updated
     *
     * @return $this
     */
    public function setShowLastUpdated($show_last_updated)
    {
        $this->container['show_last_updated'] = $show_last_updated;

        return $this;
    }

    /**
     * Gets show_go_to_payment
     *
     * @return bool
     */
    public function getShowGoToPayment()
    {
        return $this->container['show_go_to_payment'];
    }

    /**
     * Sets show_go_to_payment
     *
     * @param bool $show_go_to_payment show_go_to_payment
     *
     * @return $this
     */
    public function setShowGoToPayment($show_go_to_payment)
    {
        $this->container['show_go_to_payment'] = $show_go_to_payment;

        return $this;
    }

    /**
     * Gets has_department
     *
     * @return bool
     */
    public function getHasDepartment()
    {
        return $this->container['has_department'];
    }

    /**
     * Sets has_department
     *
     * @param bool $has_department has_department
     *
     * @return $this
     */
    public function setHasDepartment($has_department)
    {
        $this->container['has_department'] = $has_department;

        return $this;
    }

    /**
     * Gets has_project
     *
     * @return bool
     */
    public function getHasProject()
    {
        return $this->container['has_project'];
    }

    /**
     * Sets has_project
     *
     * @param bool $has_project has_project
     *
     * @return $this
     */
    public function setHasProject($has_project)
    {
        $this->container['has_project'] = $has_project;

        return $this;
    }

    /**
     * Gets has_automation
     *
     * @return bool
     */
    public function getHasAutomation()
    {
        return $this->container['has_automation'];
    }

    /**
     * Sets has_automation
     *
     * @param bool $has_automation has_automation
     *
     * @return $this
     */
    public function setHasAutomation($has_automation)
    {
        $this->container['has_automation'] = $has_automation;

        return $this;
    }

    /**
     * Gets can_user_upload
     *
     * @return bool
     */
    public function getCanUserUpload()
    {
        return $this->container['can_user_upload'];
    }

    /**
     * Sets can_user_upload
     *
     * @param bool $can_user_upload can_user_upload
     *
     * @return $this
     */
    public function setCanUserUpload($can_user_upload)
    {
        $this->container['can_user_upload'] = $can_user_upload;

        return $this;
    }

    /**
     * Gets can_user_edit
     *
     * @return bool
     */
    public function getCanUserEdit()
    {
        return $this->container['can_user_edit'];
    }

    /**
     * Sets can_user_edit
     *
     * @param bool $can_user_edit can_user_edit
     *
     * @return $this
     */
    public function setCanUserEdit($can_user_edit)
    {
        $this->container['can_user_edit'] = $can_user_edit;

        return $this;
    }

    /**
     * Gets can_user_delete
     *
     * @return bool
     */
    public function getCanUserDelete()
    {
        return $this->container['can_user_delete'];
    }

    /**
     * Sets can_user_delete
     *
     * @param bool $can_user_delete can_user_delete
     *
     * @return $this
     */
    public function setCanUserDelete($can_user_delete)
    {
        $this->container['can_user_delete'] = $can_user_delete;

        return $this;
    }

    /**
     * Gets can_user_register_incoming_invoice
     *
     * @return bool
     */
    public function getCanUserRegisterIncomingInvoice()
    {
        return $this->container['can_user_register_incoming_invoice'];
    }

    /**
     * Sets can_user_register_incoming_invoice
     *
     * @param bool $can_user_register_incoming_invoice can_user_register_incoming_invoice
     *
     * @return $this
     */
    public function setCanUserRegisterIncomingInvoice($can_user_register_incoming_invoice)
    {
        $this->container['can_user_register_incoming_invoice'] = $can_user_register_incoming_invoice;

        return $this;
    }

    /**
     * Gets can_user_register_bank_reconciliation
     *
     * @return bool
     */
    public function getCanUserRegisterBankReconciliation()
    {
        return $this->container['can_user_register_bank_reconciliation'];
    }

    /**
     * Sets can_user_register_bank_reconciliation
     *
     * @param bool $can_user_register_bank_reconciliation can_user_register_bank_reconciliation
     *
     * @return $this
     */
    public function setCanUserRegisterBankReconciliation($can_user_register_bank_reconciliation)
    {
        $this->container['can_user_register_bank_reconciliation'] = $can_user_register_bank_reconciliation;

        return $this;
    }

    /**
     * Gets can_user_register_advanced_voucher
     *
     * @return bool
     */
    public function getCanUserRegisterAdvancedVoucher()
    {
        return $this->container['can_user_register_advanced_voucher'];
    }

    /**
     * Sets can_user_register_advanced_voucher
     *
     * @param bool $can_user_register_advanced_voucher can_user_register_advanced_voucher
     *
     * @return $this
     */
    public function setCanUserRegisterAdvancedVoucher($can_user_register_advanced_voucher)
    {
        $this->container['can_user_register_advanced_voucher'] = $can_user_register_advanced_voucher;

        return $this;
    }

    /**
     * Gets can_user_register_payment_in
     *
     * @return bool
     */
    public function getCanUserRegisterPaymentIn()
    {
        return $this->container['can_user_register_payment_in'];
    }

    /**
     * Sets can_user_register_payment_in
     *
     * @param bool $can_user_register_payment_in can_user_register_payment_in
     *
     * @return $this
     */
    public function setCanUserRegisterPaymentIn($can_user_register_payment_in)
    {
        $this->container['can_user_register_payment_in'] = $can_user_register_payment_in;

        return $this;
    }

    /**
     * Gets can_user_register_income
     *
     * @return bool
     */
    public function getCanUserRegisterIncome()
    {
        return $this->container['can_user_register_income'];
    }

    /**
     * Sets can_user_register_income
     *
     * @param bool $can_user_register_income can_user_register_income
     *
     * @return $this
     */
    public function setCanUserRegisterIncome($can_user_register_income)
    {
        $this->container['can_user_register_income'] = $can_user_register_income;

        return $this;
    }

    /**
     * Gets can_user_register_customs_declaration
     *
     * @return bool
     */
    public function getCanUserRegisterCustomsDeclaration()
    {
        return $this->container['can_user_register_customs_declaration'];
    }

    /**
     * Sets can_user_register_customs_declaration
     *
     * @param bool $can_user_register_customs_declaration can_user_register_customs_declaration
     *
     * @return $this
     */
    public function setCanUserRegisterCustomsDeclaration($can_user_register_customs_declaration)
    {
        $this->container['can_user_register_customs_declaration'] = $can_user_register_customs_declaration;

        return $this;
    }

    /**
     * Gets in_developer_mode
     *
     * @return bool
     */
    public function getInDeveloperMode()
    {
        return $this->container['in_developer_mode'];
    }

    /**
     * Sets in_developer_mode
     *
     * @param bool $in_developer_mode in_developer_mode
     *
     * @return $this
     */
    public function setInDeveloperMode($in_developer_mode)
    {
        $this->container['in_developer_mode'] = $in_developer_mode;

        return $this;
    }

    /**
     * Gets voucher_scanning_email
     *
     * @return string
     */
    public function getVoucherScanningEmail()
    {
        return $this->container['voucher_scanning_email'];
    }

    /**
     * Sets voucher_scanning_email
     *
     * @param string $voucher_scanning_email voucher_scanning_email
     *
     * @return $this
     */
    public function setVoucherScanningEmail($voucher_scanning_email)
    {
        $this->container['voucher_scanning_email'] = $voucher_scanning_email;

        return $this;
    }

    /**
     * Gets main_bank_account_id
     *
     * @return int
     */
    public function getMainBankAccountId()
    {
        return $this->container['main_bank_account_id'];
    }

    /**
     * Sets main_bank_account_id
     *
     * @param int $main_bank_account_id main_bank_account_id
     *
     * @return $this
     */
    public function setMainBankAccountId($main_bank_account_id)
    {
        $this->container['main_bank_account_id'] = $main_bank_account_id;

        return $this;
    }

    /**
     * Gets employee_id
     *
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->container['employee_id'];
    }

    /**
     * Sets employee_id
     *
     * @param int $employee_id employee_id
     *
     * @return $this
     */
    public function setEmployeeId($employee_id)
    {
        $this->container['employee_id'] = $employee_id;

        return $this;
    }

    /**
     * Gets automated_vouchers_this_week
     *
     * @return int
     */
    public function getAutomatedVouchersThisWeek()
    {
        return $this->container['automated_vouchers_this_week'];
    }

    /**
     * Sets automated_vouchers_this_week
     *
     * @param int $automated_vouchers_this_week automated_vouchers_this_week
     *
     * @return $this
     */
    public function setAutomatedVouchersThisWeek($automated_vouchers_this_week)
    {
        $this->container['automated_vouchers_this_week'] = $automated_vouchers_this_week;

        return $this;
    }

    /**
     * Gets tripletex_start_date
     *
     * @return string
     */
    public function getTripletexStartDate()
    {
        return $this->container['tripletex_start_date'];
    }

    /**
     * Sets tripletex_start_date
     *
     * @param string $tripletex_start_date tripletex_start_date
     *
     * @return $this
     */
    public function setTripletexStartDate($tripletex_start_date)
    {
        $this->container['tripletex_start_date'] = $tripletex_start_date;

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
