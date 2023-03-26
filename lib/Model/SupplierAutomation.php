<?php
/**
 * SupplierAutomation
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
 * SupplierAutomation Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SupplierAutomation implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'SupplierAutomation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'vendor_id' => 'int',
'name' => 'string',
'number' => 'string',
'automatically_posted_invoices_last10_count' => 'int',
'automatically_posted_invoices_last10_count_automation' => 'int',
'automatically_posted_invoices_last10_count_automation_rule' => 'int',
'not_automatically_posted_invoices_last10_count' => 'int',
'vendor_account_number' => 'int',
'activated' => 'bool',
'category' => 'int',
'automated_count' => 'int',
'voucher_count_last90_days_ehf' => 'int',
'voucher_count_last90_days_non_ehf' => 'int',
'voucher_count' => 'int',
'completed_invoices' => 'int',
'not_completed_invoices' => 'int',
'can_send_ehf' => 'bool',
'email' => 'string',
'automation_rules_details' => '\Learnist\Tripletex\Model\AutomationRuleDetails',
'payment_type_fabric_ai' => 'int',
'amount_max_fabric_ai_vendor_invoice' => 'int',
'date_request_ehf_sent' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'vendor_id' => 'int32',
'name' => null,
'number' => null,
'automatically_posted_invoices_last10_count' => 'int32',
'automatically_posted_invoices_last10_count_automation' => 'int32',
'automatically_posted_invoices_last10_count_automation_rule' => 'int32',
'not_automatically_posted_invoices_last10_count' => 'int32',
'vendor_account_number' => 'int32',
'activated' => null,
'category' => 'int32',
'automated_count' => 'int32',
'voucher_count_last90_days_ehf' => 'int32',
'voucher_count_last90_days_non_ehf' => 'int32',
'voucher_count' => 'int32',
'completed_invoices' => 'int32',
'not_completed_invoices' => 'int32',
'can_send_ehf' => null,
'email' => null,
'automation_rules_details' => null,
'payment_type_fabric_ai' => 'int64',
'amount_max_fabric_ai_vendor_invoice' => 'int32',
'date_request_ehf_sent' => null    ];

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
        'vendor_id' => 'vendorId',
'name' => 'name',
'number' => 'number',
'automatically_posted_invoices_last10_count' => 'automaticallyPostedInvoicesLast10Count',
'automatically_posted_invoices_last10_count_automation' => 'automaticallyPostedInvoicesLast10CountAutomation',
'automatically_posted_invoices_last10_count_automation_rule' => 'automaticallyPostedInvoicesLast10CountAutomationRule',
'not_automatically_posted_invoices_last10_count' => 'notAutomaticallyPostedInvoicesLast10Count',
'vendor_account_number' => 'vendorAccountNumber',
'activated' => 'activated',
'category' => 'category',
'automated_count' => 'automatedCount',
'voucher_count_last90_days_ehf' => 'voucherCountLast90DaysEhf',
'voucher_count_last90_days_non_ehf' => 'voucherCountLast90DaysNonEhf',
'voucher_count' => 'voucherCount',
'completed_invoices' => 'completedInvoices',
'not_completed_invoices' => 'notCompletedInvoices',
'can_send_ehf' => 'canSendEhf',
'email' => 'email',
'automation_rules_details' => 'automationRulesDetails',
'payment_type_fabric_ai' => 'paymentTypeFabricAi',
'amount_max_fabric_ai_vendor_invoice' => 'amountMaxFabricAiVendorInvoice',
'date_request_ehf_sent' => 'dateRequestEhfSent'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'vendor_id' => 'setVendorId',
'name' => 'setName',
'number' => 'setNumber',
'automatically_posted_invoices_last10_count' => 'setAutomaticallyPostedInvoicesLast10Count',
'automatically_posted_invoices_last10_count_automation' => 'setAutomaticallyPostedInvoicesLast10CountAutomation',
'automatically_posted_invoices_last10_count_automation_rule' => 'setAutomaticallyPostedInvoicesLast10CountAutomationRule',
'not_automatically_posted_invoices_last10_count' => 'setNotAutomaticallyPostedInvoicesLast10Count',
'vendor_account_number' => 'setVendorAccountNumber',
'activated' => 'setActivated',
'category' => 'setCategory',
'automated_count' => 'setAutomatedCount',
'voucher_count_last90_days_ehf' => 'setVoucherCountLast90DaysEhf',
'voucher_count_last90_days_non_ehf' => 'setVoucherCountLast90DaysNonEhf',
'voucher_count' => 'setVoucherCount',
'completed_invoices' => 'setCompletedInvoices',
'not_completed_invoices' => 'setNotCompletedInvoices',
'can_send_ehf' => 'setCanSendEhf',
'email' => 'setEmail',
'automation_rules_details' => 'setAutomationRulesDetails',
'payment_type_fabric_ai' => 'setPaymentTypeFabricAi',
'amount_max_fabric_ai_vendor_invoice' => 'setAmountMaxFabricAiVendorInvoice',
'date_request_ehf_sent' => 'setDateRequestEhfSent'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'vendor_id' => 'getVendorId',
'name' => 'getName',
'number' => 'getNumber',
'automatically_posted_invoices_last10_count' => 'getAutomaticallyPostedInvoicesLast10Count',
'automatically_posted_invoices_last10_count_automation' => 'getAutomaticallyPostedInvoicesLast10CountAutomation',
'automatically_posted_invoices_last10_count_automation_rule' => 'getAutomaticallyPostedInvoicesLast10CountAutomationRule',
'not_automatically_posted_invoices_last10_count' => 'getNotAutomaticallyPostedInvoicesLast10Count',
'vendor_account_number' => 'getVendorAccountNumber',
'activated' => 'getActivated',
'category' => 'getCategory',
'automated_count' => 'getAutomatedCount',
'voucher_count_last90_days_ehf' => 'getVoucherCountLast90DaysEhf',
'voucher_count_last90_days_non_ehf' => 'getVoucherCountLast90DaysNonEhf',
'voucher_count' => 'getVoucherCount',
'completed_invoices' => 'getCompletedInvoices',
'not_completed_invoices' => 'getNotCompletedInvoices',
'can_send_ehf' => 'getCanSendEhf',
'email' => 'getEmail',
'automation_rules_details' => 'getAutomationRulesDetails',
'payment_type_fabric_ai' => 'getPaymentTypeFabricAi',
'amount_max_fabric_ai_vendor_invoice' => 'getAmountMaxFabricAiVendorInvoice',
'date_request_ehf_sent' => 'getDateRequestEhfSent'    ];

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
        $this->container['vendor_id'] = isset($data['vendor_id']) ? $data['vendor_id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['automatically_posted_invoices_last10_count'] = isset($data['automatically_posted_invoices_last10_count']) ? $data['automatically_posted_invoices_last10_count'] : null;
        $this->container['automatically_posted_invoices_last10_count_automation'] = isset($data['automatically_posted_invoices_last10_count_automation']) ? $data['automatically_posted_invoices_last10_count_automation'] : null;
        $this->container['automatically_posted_invoices_last10_count_automation_rule'] = isset($data['automatically_posted_invoices_last10_count_automation_rule']) ? $data['automatically_posted_invoices_last10_count_automation_rule'] : null;
        $this->container['not_automatically_posted_invoices_last10_count'] = isset($data['not_automatically_posted_invoices_last10_count']) ? $data['not_automatically_posted_invoices_last10_count'] : null;
        $this->container['vendor_account_number'] = isset($data['vendor_account_number']) ? $data['vendor_account_number'] : null;
        $this->container['activated'] = isset($data['activated']) ? $data['activated'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['automated_count'] = isset($data['automated_count']) ? $data['automated_count'] : null;
        $this->container['voucher_count_last90_days_ehf'] = isset($data['voucher_count_last90_days_ehf']) ? $data['voucher_count_last90_days_ehf'] : null;
        $this->container['voucher_count_last90_days_non_ehf'] = isset($data['voucher_count_last90_days_non_ehf']) ? $data['voucher_count_last90_days_non_ehf'] : null;
        $this->container['voucher_count'] = isset($data['voucher_count']) ? $data['voucher_count'] : null;
        $this->container['completed_invoices'] = isset($data['completed_invoices']) ? $data['completed_invoices'] : null;
        $this->container['not_completed_invoices'] = isset($data['not_completed_invoices']) ? $data['not_completed_invoices'] : null;
        $this->container['can_send_ehf'] = isset($data['can_send_ehf']) ? $data['can_send_ehf'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['automation_rules_details'] = isset($data['automation_rules_details']) ? $data['automation_rules_details'] : null;
        $this->container['payment_type_fabric_ai'] = isset($data['payment_type_fabric_ai']) ? $data['payment_type_fabric_ai'] : null;
        $this->container['amount_max_fabric_ai_vendor_invoice'] = isset($data['amount_max_fabric_ai_vendor_invoice']) ? $data['amount_max_fabric_ai_vendor_invoice'] : null;
        $this->container['date_request_ehf_sent'] = isset($data['date_request_ehf_sent']) ? $data['date_request_ehf_sent'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['vendor_id'] === null) {
            $invalidProperties[] = "'vendor_id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['number'] === null) {
            $invalidProperties[] = "'number' can't be null";
        }
        if ($this->container['vendor_account_number'] === null) {
            $invalidProperties[] = "'vendor_account_number' can't be null";
        }
        if ($this->container['can_send_ehf'] === null) {
            $invalidProperties[] = "'can_send_ehf' can't be null";
        }
        if ($this->container['email'] === null) {
            $invalidProperties[] = "'email' can't be null";
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
     * Gets vendor_id
     *
     * @return int
     */
    public function getVendorId()
    {
        return $this->container['vendor_id'];
    }

    /**
     * Sets vendor_id
     *
     * @param int $vendor_id vendor_id
     *
     * @return $this
     */
    public function setVendorId($vendor_id)
    {
        $this->container['vendor_id'] = $vendor_id;

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
     * Gets automatically_posted_invoices_last10_count
     *
     * @return int
     */
    public function getAutomaticallyPostedInvoicesLast10Count()
    {
        return $this->container['automatically_posted_invoices_last10_count'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count
     *
     * @param int $automatically_posted_invoices_last10_count Number automatically of the latest 10 posted invoices
     *
     * @return $this
     */
    public function setAutomaticallyPostedInvoicesLast10Count($automatically_posted_invoices_last10_count)
    {
        $this->container['automatically_posted_invoices_last10_count'] = $automatically_posted_invoices_last10_count;

        return $this;
    }

    /**
     * Gets automatically_posted_invoices_last10_count_automation
     *
     * @return int
     */
    public function getAutomaticallyPostedInvoicesLast10CountAutomation()
    {
        return $this->container['automatically_posted_invoices_last10_count_automation'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count_automation
     *
     * @param int $automatically_posted_invoices_last10_count_automation Number automatically of the latest 10 posted invoices
     *
     * @return $this
     */
    public function setAutomaticallyPostedInvoicesLast10CountAutomation($automatically_posted_invoices_last10_count_automation)
    {
        $this->container['automatically_posted_invoices_last10_count_automation'] = $automatically_posted_invoices_last10_count_automation;

        return $this;
    }

    /**
     * Gets automatically_posted_invoices_last10_count_automation_rule
     *
     * @return int
     */
    public function getAutomaticallyPostedInvoicesLast10CountAutomationRule()
    {
        return $this->container['automatically_posted_invoices_last10_count_automation_rule'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count_automation_rule
     *
     * @param int $automatically_posted_invoices_last10_count_automation_rule Number automatically of the latest 10 posted invoices
     *
     * @return $this
     */
    public function setAutomaticallyPostedInvoicesLast10CountAutomationRule($automatically_posted_invoices_last10_count_automation_rule)
    {
        $this->container['automatically_posted_invoices_last10_count_automation_rule'] = $automatically_posted_invoices_last10_count_automation_rule;

        return $this;
    }

    /**
     * Gets not_automatically_posted_invoices_last10_count
     *
     * @return int
     */
    public function getNotAutomaticallyPostedInvoicesLast10Count()
    {
        return $this->container['not_automatically_posted_invoices_last10_count'];
    }

    /**
     * Sets not_automatically_posted_invoices_last10_count
     *
     * @param int $not_automatically_posted_invoices_last10_count Number of not automatically of the latest 10 posted invoices
     *
     * @return $this
     */
    public function setNotAutomaticallyPostedInvoicesLast10Count($not_automatically_posted_invoices_last10_count)
    {
        $this->container['not_automatically_posted_invoices_last10_count'] = $not_automatically_posted_invoices_last10_count;

        return $this;
    }

    /**
     * Gets vendor_account_number
     *
     * @return int
     */
    public function getVendorAccountNumber()
    {
        return $this->container['vendor_account_number'];
    }

    /**
     * Sets vendor_account_number
     *
     * @param int $vendor_account_number vendor_account_number
     *
     * @return $this
     */
    public function setVendorAccountNumber($vendor_account_number)
    {
        $this->container['vendor_account_number'] = $vendor_account_number;

        return $this;
    }

    /**
     * Gets activated
     *
     * @return bool
     */
    public function getActivated()
    {
        return $this->container['activated'];
    }

    /**
     * Sets activated
     *
     * @param bool $activated Is automation activated?
     *
     * @return $this
     */
    public function setActivated($activated)
    {
        $this->container['activated'] = $activated;

        return $this;
    }

    /**
     * Gets category
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param int $category Automation category. 0-3.
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets automated_count
     *
     * @return int
     */
    public function getAutomatedCount()
    {
        return $this->container['automated_count'];
    }

    /**
     * Sets automated_count
     *
     * @param int $automated_count Number of automated vouchers
     *
     * @return $this
     */
    public function setAutomatedCount($automated_count)
    {
        $this->container['automated_count'] = $automated_count;

        return $this;
    }

    /**
     * Gets voucher_count_last90_days_ehf
     *
     * @return int
     */
    public function getVoucherCountLast90DaysEhf()
    {
        return $this->container['voucher_count_last90_days_ehf'];
    }

    /**
     * Sets voucher_count_last90_days_ehf
     *
     * @param int $voucher_count_last90_days_ehf Number of EHF vouchers last 90 days.
     *
     * @return $this
     */
    public function setVoucherCountLast90DaysEhf($voucher_count_last90_days_ehf)
    {
        $this->container['voucher_count_last90_days_ehf'] = $voucher_count_last90_days_ehf;

        return $this;
    }

    /**
     * Gets voucher_count_last90_days_non_ehf
     *
     * @return int
     */
    public function getVoucherCountLast90DaysNonEhf()
    {
        return $this->container['voucher_count_last90_days_non_ehf'];
    }

    /**
     * Sets voucher_count_last90_days_non_ehf
     *
     * @param int $voucher_count_last90_days_non_ehf Number of non-EHF vouchers last 90 days.
     *
     * @return $this
     */
    public function setVoucherCountLast90DaysNonEhf($voucher_count_last90_days_non_ehf)
    {
        $this->container['voucher_count_last90_days_non_ehf'] = $voucher_count_last90_days_non_ehf;

        return $this;
    }

    /**
     * Gets voucher_count
     *
     * @return int
     */
    public function getVoucherCount()
    {
        return $this->container['voucher_count'];
    }

    /**
     * Sets voucher_count
     *
     * @param int $voucher_count Number of EHF vouchers send from this supplier regardless of time.
     *
     * @return $this
     */
    public function setVoucherCount($voucher_count)
    {
        $this->container['voucher_count'] = $voucher_count;

        return $this;
    }

    /**
     * Gets completed_invoices
     *
     * @return int
     */
    public function getCompletedInvoices()
    {
        return $this->container['completed_invoices'];
    }

    /**
     * Sets completed_invoices
     *
     * @param int $completed_invoices Number of invoices with status completed based on the last 10 invoices.
     *
     * @return $this
     */
    public function setCompletedInvoices($completed_invoices)
    {
        $this->container['completed_invoices'] = $completed_invoices;

        return $this;
    }

    /**
     * Gets not_completed_invoices
     *
     * @return int
     */
    public function getNotCompletedInvoices()
    {
        return $this->container['not_completed_invoices'];
    }

    /**
     * Sets not_completed_invoices
     *
     * @param int $not_completed_invoices Number of invoices with status not completed based on the last 10 invoices.
     *
     * @return $this
     */
    public function setNotCompletedInvoices($not_completed_invoices)
    {
        $this->container['not_completed_invoices'] = $not_completed_invoices;

        return $this;
    }

    /**
     * Gets can_send_ehf
     *
     * @return bool
     */
    public function getCanSendEhf()
    {
        return $this->container['can_send_ehf'];
    }

    /**
     * Sets can_send_ehf
     *
     * @param bool $can_send_ehf Whether the vendor can send EHF
     *
     * @return $this
     */
    public function setCanSendEhf($can_send_ehf)
    {
        $this->container['can_send_ehf'] = $can_send_ehf;

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
     * @param string $email email of the vendor
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets automation_rules_details
     *
     * @return \Learnist\Tripletex\Model\AutomationRuleDetails
     */
    public function getAutomationRulesDetails()
    {
        return $this->container['automation_rules_details'];
    }

    /**
     * Sets automation_rules_details
     *
     * @param \Learnist\Tripletex\Model\AutomationRuleDetails $automation_rules_details automation_rules_details
     *
     * @return $this
     */
    public function setAutomationRulesDetails($automation_rules_details)
    {
        $this->container['automation_rules_details'] = $automation_rules_details;

        return $this;
    }

    /**
     * Gets payment_type_fabric_ai
     *
     * @return int
     */
    public function getPaymentTypeFabricAi()
    {
        return $this->container['payment_type_fabric_ai'];
    }

    /**
     * Sets payment_type_fabric_ai
     *
     * @param int $payment_type_fabric_ai If set, the payment type to be used when automating an invoice from this vendor.
     *
     * @return $this
     */
    public function setPaymentTypeFabricAi($payment_type_fabric_ai)
    {
        $this->container['payment_type_fabric_ai'] = $payment_type_fabric_ai;

        return $this;
    }

    /**
     * Gets amount_max_fabric_ai_vendor_invoice
     *
     * @return int
     */
    public function getAmountMaxFabricAiVendorInvoice()
    {
        return $this->container['amount_max_fabric_ai_vendor_invoice'];
    }

    /**
     * Sets amount_max_fabric_ai_vendor_invoice
     *
     * @param int $amount_max_fabric_ai_vendor_invoice If set, gives the amount limit for automating invoices for this vendor, it the total invoice amount is above the limit, the invoice is not automated.
     *
     * @return $this
     */
    public function setAmountMaxFabricAiVendorInvoice($amount_max_fabric_ai_vendor_invoice)
    {
        $this->container['amount_max_fabric_ai_vendor_invoice'] = $amount_max_fabric_ai_vendor_invoice;

        return $this;
    }

    /**
     * Gets date_request_ehf_sent
     *
     * @return string
     */
    public function getDateRequestEhfSent()
    {
        return $this->container['date_request_ehf_sent'];
    }

    /**
     * Sets date_request_ehf_sent
     *
     * @param string $date_request_ehf_sent The date the user has sent the request to a supplier to receive EHF.
     *
     * @return $this
     */
    public function setDateRequestEhfSent($date_request_ehf_sent)
    {
        $this->container['date_request_ehf_sent'] = $date_request_ehf_sent;

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
