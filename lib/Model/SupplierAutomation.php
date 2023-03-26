<?php
/**
 * SupplierAutomation
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
 * SupplierAutomation Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SupplierAutomation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SupplierAutomation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'date_request_ehf_sent' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'date_request_ehf_sent' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'vendor_id' => false,
		'name' => false,
		'number' => false,
		'automatically_posted_invoices_last10_count' => false,
		'automatically_posted_invoices_last10_count_automation' => false,
		'automatically_posted_invoices_last10_count_automation_rule' => false,
		'not_automatically_posted_invoices_last10_count' => false,
		'vendor_account_number' => false,
		'activated' => false,
		'category' => false,
		'automated_count' => false,
		'voucher_count_last90_days_ehf' => false,
		'voucher_count_last90_days_non_ehf' => false,
		'voucher_count' => false,
		'completed_invoices' => false,
		'not_completed_invoices' => false,
		'can_send_ehf' => false,
		'email' => false,
		'automation_rules_details' => false,
		'payment_type_fabric_ai' => false,
		'amount_max_fabric_ai_vendor_invoice' => false,
		'date_request_ehf_sent' => false
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
        'date_request_ehf_sent' => 'dateRequestEhfSent'
    ];

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
        'date_request_ehf_sent' => 'setDateRequestEhfSent'
    ];

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
        'date_request_ehf_sent' => 'getDateRequestEhfSent'
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
        $this->setIfExists('vendor_id', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('automatically_posted_invoices_last10_count', $data ?? [], null);
        $this->setIfExists('automatically_posted_invoices_last10_count_automation', $data ?? [], null);
        $this->setIfExists('automatically_posted_invoices_last10_count_automation_rule', $data ?? [], null);
        $this->setIfExists('not_automatically_posted_invoices_last10_count', $data ?? [], null);
        $this->setIfExists('vendor_account_number', $data ?? [], null);
        $this->setIfExists('activated', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('automated_count', $data ?? [], null);
        $this->setIfExists('voucher_count_last90_days_ehf', $data ?? [], null);
        $this->setIfExists('voucher_count_last90_days_non_ehf', $data ?? [], null);
        $this->setIfExists('voucher_count', $data ?? [], null);
        $this->setIfExists('completed_invoices', $data ?? [], null);
        $this->setIfExists('not_completed_invoices', $data ?? [], null);
        $this->setIfExists('can_send_ehf', $data ?? [], null);
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('automation_rules_details', $data ?? [], null);
        $this->setIfExists('payment_type_fabric_ai', $data ?? [], null);
        $this->setIfExists('amount_max_fabric_ai_vendor_invoice', $data ?? [], null);
        $this->setIfExists('date_request_ehf_sent', $data ?? [], null);
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

        if ($this->container['vendor_id'] === null) {
            $invalidProperties[] = "'vendor_id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['number'] === null) {
            $invalidProperties[] = "'number' can't be null";
        }
        if (!is_null($this->container['automatically_posted_invoices_last10_count']) && ($this->container['automatically_posted_invoices_last10_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'automatically_posted_invoices_last10_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['automatically_posted_invoices_last10_count_automation']) && ($this->container['automatically_posted_invoices_last10_count_automation'] < 0)) {
            $invalidProperties[] = "invalid value for 'automatically_posted_invoices_last10_count_automation', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['automatically_posted_invoices_last10_count_automation_rule']) && ($this->container['automatically_posted_invoices_last10_count_automation_rule'] < 0)) {
            $invalidProperties[] = "invalid value for 'automatically_posted_invoices_last10_count_automation_rule', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['not_automatically_posted_invoices_last10_count']) && ($this->container['not_automatically_posted_invoices_last10_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'not_automatically_posted_invoices_last10_count', must be bigger than or equal to 0.";
        }

        if ($this->container['vendor_account_number'] === null) {
            $invalidProperties[] = "'vendor_account_number' can't be null";
        }
        if (!is_null($this->container['category']) && ($this->container['category'] < 0)) {
            $invalidProperties[] = "invalid value for 'category', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['automated_count']) && ($this->container['automated_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'automated_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['voucher_count_last90_days_ehf']) && ($this->container['voucher_count_last90_days_ehf'] < 0)) {
            $invalidProperties[] = "invalid value for 'voucher_count_last90_days_ehf', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['voucher_count_last90_days_non_ehf']) && ($this->container['voucher_count_last90_days_non_ehf'] < 0)) {
            $invalidProperties[] = "invalid value for 'voucher_count_last90_days_non_ehf', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['voucher_count']) && ($this->container['voucher_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'voucher_count', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['completed_invoices']) && ($this->container['completed_invoices'] < 0)) {
            $invalidProperties[] = "invalid value for 'completed_invoices', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['not_completed_invoices']) && ($this->container['not_completed_invoices'] < 0)) {
            $invalidProperties[] = "invalid value for 'not_completed_invoices', must be bigger than or equal to 0.";
        }

        if ($this->container['can_send_ehf'] === null) {
            $invalidProperties[] = "'can_send_ehf' can't be null";
        }
        if ($this->container['email'] === null) {
            $invalidProperties[] = "'email' can't be null";
        }
        if (!is_null($this->container['payment_type_fabric_ai']) && ($this->container['payment_type_fabric_ai'] < 0)) {
            $invalidProperties[] = "invalid value for 'payment_type_fabric_ai', must be bigger than or equal to 0.";
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
     * @return self
     */
    public function setVendorId($vendor_id)
    {

        if (is_null($vendor_id)) {
            throw new \InvalidArgumentException('non-nullable vendor_id cannot be null');
        }

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
     * @return self
     */
    public function setName($name)
    {

        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }

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
     * Gets automatically_posted_invoices_last10_count
     *
     * @return int|null
     */
    public function getAutomaticallyPostedInvoicesLast10Count()
    {
        return $this->container['automatically_posted_invoices_last10_count'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count
     *
     * @param int|null $automatically_posted_invoices_last10_count Number automatically of the latest 10 posted invoices
     *
     * @return self
     */
    public function setAutomaticallyPostedInvoicesLast10Count($automatically_posted_invoices_last10_count)
    {

        if (!is_null($automatically_posted_invoices_last10_count) && ($automatically_posted_invoices_last10_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $automatically_posted_invoices_last10_count when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($automatically_posted_invoices_last10_count)) {
            throw new \InvalidArgumentException('non-nullable automatically_posted_invoices_last10_count cannot be null');
        }

        $this->container['automatically_posted_invoices_last10_count'] = $automatically_posted_invoices_last10_count;

        return $this;
    }

    /**
     * Gets automatically_posted_invoices_last10_count_automation
     *
     * @return int|null
     */
    public function getAutomaticallyPostedInvoicesLast10CountAutomation()
    {
        return $this->container['automatically_posted_invoices_last10_count_automation'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count_automation
     *
     * @param int|null $automatically_posted_invoices_last10_count_automation Number automatically of the latest 10 posted invoices
     *
     * @return self
     */
    public function setAutomaticallyPostedInvoicesLast10CountAutomation($automatically_posted_invoices_last10_count_automation)
    {

        if (!is_null($automatically_posted_invoices_last10_count_automation) && ($automatically_posted_invoices_last10_count_automation < 0)) {
            throw new \InvalidArgumentException('invalid value for $automatically_posted_invoices_last10_count_automation when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($automatically_posted_invoices_last10_count_automation)) {
            throw new \InvalidArgumentException('non-nullable automatically_posted_invoices_last10_count_automation cannot be null');
        }

        $this->container['automatically_posted_invoices_last10_count_automation'] = $automatically_posted_invoices_last10_count_automation;

        return $this;
    }

    /**
     * Gets automatically_posted_invoices_last10_count_automation_rule
     *
     * @return int|null
     */
    public function getAutomaticallyPostedInvoicesLast10CountAutomationRule()
    {
        return $this->container['automatically_posted_invoices_last10_count_automation_rule'];
    }

    /**
     * Sets automatically_posted_invoices_last10_count_automation_rule
     *
     * @param int|null $automatically_posted_invoices_last10_count_automation_rule Number automatically of the latest 10 posted invoices
     *
     * @return self
     */
    public function setAutomaticallyPostedInvoicesLast10CountAutomationRule($automatically_posted_invoices_last10_count_automation_rule)
    {

        if (!is_null($automatically_posted_invoices_last10_count_automation_rule) && ($automatically_posted_invoices_last10_count_automation_rule < 0)) {
            throw new \InvalidArgumentException('invalid value for $automatically_posted_invoices_last10_count_automation_rule when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($automatically_posted_invoices_last10_count_automation_rule)) {
            throw new \InvalidArgumentException('non-nullable automatically_posted_invoices_last10_count_automation_rule cannot be null');
        }

        $this->container['automatically_posted_invoices_last10_count_automation_rule'] = $automatically_posted_invoices_last10_count_automation_rule;

        return $this;
    }

    /**
     * Gets not_automatically_posted_invoices_last10_count
     *
     * @return int|null
     */
    public function getNotAutomaticallyPostedInvoicesLast10Count()
    {
        return $this->container['not_automatically_posted_invoices_last10_count'];
    }

    /**
     * Sets not_automatically_posted_invoices_last10_count
     *
     * @param int|null $not_automatically_posted_invoices_last10_count Number of not automatically of the latest 10 posted invoices
     *
     * @return self
     */
    public function setNotAutomaticallyPostedInvoicesLast10Count($not_automatically_posted_invoices_last10_count)
    {

        if (!is_null($not_automatically_posted_invoices_last10_count) && ($not_automatically_posted_invoices_last10_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $not_automatically_posted_invoices_last10_count when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($not_automatically_posted_invoices_last10_count)) {
            throw new \InvalidArgumentException('non-nullable not_automatically_posted_invoices_last10_count cannot be null');
        }

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
     * @return self
     */
    public function setVendorAccountNumber($vendor_account_number)
    {

        if (is_null($vendor_account_number)) {
            throw new \InvalidArgumentException('non-nullable vendor_account_number cannot be null');
        }

        $this->container['vendor_account_number'] = $vendor_account_number;

        return $this;
    }

    /**
     * Gets activated
     *
     * @return bool|null
     */
    public function getActivated()
    {
        return $this->container['activated'];
    }

    /**
     * Sets activated
     *
     * @param bool|null $activated Is automation activated?
     *
     * @return self
     */
    public function setActivated($activated)
    {

        if (is_null($activated)) {
            throw new \InvalidArgumentException('non-nullable activated cannot be null');
        }

        $this->container['activated'] = $activated;

        return $this;
    }

    /**
     * Gets category
     *
     * @return int|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param int|null $category Automation category. 0-3.
     *
     * @return self
     */
    public function setCategory($category)
    {

        if (!is_null($category) && ($category < 0)) {
            throw new \InvalidArgumentException('invalid value for $category when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }

        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets automated_count
     *
     * @return int|null
     */
    public function getAutomatedCount()
    {
        return $this->container['automated_count'];
    }

    /**
     * Sets automated_count
     *
     * @param int|null $automated_count Number of automated vouchers
     *
     * @return self
     */
    public function setAutomatedCount($automated_count)
    {

        if (!is_null($automated_count) && ($automated_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $automated_count when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($automated_count)) {
            throw new \InvalidArgumentException('non-nullable automated_count cannot be null');
        }

        $this->container['automated_count'] = $automated_count;

        return $this;
    }

    /**
     * Gets voucher_count_last90_days_ehf
     *
     * @return int|null
     */
    public function getVoucherCountLast90DaysEhf()
    {
        return $this->container['voucher_count_last90_days_ehf'];
    }

    /**
     * Sets voucher_count_last90_days_ehf
     *
     * @param int|null $voucher_count_last90_days_ehf Number of EHF vouchers last 90 days.
     *
     * @return self
     */
    public function setVoucherCountLast90DaysEhf($voucher_count_last90_days_ehf)
    {

        if (!is_null($voucher_count_last90_days_ehf) && ($voucher_count_last90_days_ehf < 0)) {
            throw new \InvalidArgumentException('invalid value for $voucher_count_last90_days_ehf when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($voucher_count_last90_days_ehf)) {
            throw new \InvalidArgumentException('non-nullable voucher_count_last90_days_ehf cannot be null');
        }

        $this->container['voucher_count_last90_days_ehf'] = $voucher_count_last90_days_ehf;

        return $this;
    }

    /**
     * Gets voucher_count_last90_days_non_ehf
     *
     * @return int|null
     */
    public function getVoucherCountLast90DaysNonEhf()
    {
        return $this->container['voucher_count_last90_days_non_ehf'];
    }

    /**
     * Sets voucher_count_last90_days_non_ehf
     *
     * @param int|null $voucher_count_last90_days_non_ehf Number of non-EHF vouchers last 90 days.
     *
     * @return self
     */
    public function setVoucherCountLast90DaysNonEhf($voucher_count_last90_days_non_ehf)
    {

        if (!is_null($voucher_count_last90_days_non_ehf) && ($voucher_count_last90_days_non_ehf < 0)) {
            throw new \InvalidArgumentException('invalid value for $voucher_count_last90_days_non_ehf when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($voucher_count_last90_days_non_ehf)) {
            throw new \InvalidArgumentException('non-nullable voucher_count_last90_days_non_ehf cannot be null');
        }

        $this->container['voucher_count_last90_days_non_ehf'] = $voucher_count_last90_days_non_ehf;

        return $this;
    }

    /**
     * Gets voucher_count
     *
     * @return int|null
     */
    public function getVoucherCount()
    {
        return $this->container['voucher_count'];
    }

    /**
     * Sets voucher_count
     *
     * @param int|null $voucher_count Number of EHF vouchers send from this supplier regardless of time.
     *
     * @return self
     */
    public function setVoucherCount($voucher_count)
    {

        if (!is_null($voucher_count) && ($voucher_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $voucher_count when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($voucher_count)) {
            throw new \InvalidArgumentException('non-nullable voucher_count cannot be null');
        }

        $this->container['voucher_count'] = $voucher_count;

        return $this;
    }

    /**
     * Gets completed_invoices
     *
     * @return int|null
     */
    public function getCompletedInvoices()
    {
        return $this->container['completed_invoices'];
    }

    /**
     * Sets completed_invoices
     *
     * @param int|null $completed_invoices Number of invoices with status completed based on the last 10 invoices.
     *
     * @return self
     */
    public function setCompletedInvoices($completed_invoices)
    {

        if (!is_null($completed_invoices) && ($completed_invoices < 0)) {
            throw new \InvalidArgumentException('invalid value for $completed_invoices when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($completed_invoices)) {
            throw new \InvalidArgumentException('non-nullable completed_invoices cannot be null');
        }

        $this->container['completed_invoices'] = $completed_invoices;

        return $this;
    }

    /**
     * Gets not_completed_invoices
     *
     * @return int|null
     */
    public function getNotCompletedInvoices()
    {
        return $this->container['not_completed_invoices'];
    }

    /**
     * Sets not_completed_invoices
     *
     * @param int|null $not_completed_invoices Number of invoices with status not completed based on the last 10 invoices.
     *
     * @return self
     */
    public function setNotCompletedInvoices($not_completed_invoices)
    {

        if (!is_null($not_completed_invoices) && ($not_completed_invoices < 0)) {
            throw new \InvalidArgumentException('invalid value for $not_completed_invoices when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($not_completed_invoices)) {
            throw new \InvalidArgumentException('non-nullable not_completed_invoices cannot be null');
        }

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
     * @return self
     */
    public function setCanSendEhf($can_send_ehf)
    {

        if (is_null($can_send_ehf)) {
            throw new \InvalidArgumentException('non-nullable can_send_ehf cannot be null');
        }

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
     * @return self
     */
    public function setEmail($email)
    {

        if (is_null($email)) {
            throw new \InvalidArgumentException('non-nullable email cannot be null');
        }

        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets automation_rules_details
     *
     * @return \Learnist\Tripletex\Model\AutomationRuleDetails|null
     */
    public function getAutomationRulesDetails()
    {
        return $this->container['automation_rules_details'];
    }

    /**
     * Sets automation_rules_details
     *
     * @param \Learnist\Tripletex\Model\AutomationRuleDetails|null $automation_rules_details automation_rules_details
     *
     * @return self
     */
    public function setAutomationRulesDetails($automation_rules_details)
    {

        if (is_null($automation_rules_details)) {
            throw new \InvalidArgumentException('non-nullable automation_rules_details cannot be null');
        }

        $this->container['automation_rules_details'] = $automation_rules_details;

        return $this;
    }

    /**
     * Gets payment_type_fabric_ai
     *
     * @return int|null
     */
    public function getPaymentTypeFabricAi()
    {
        return $this->container['payment_type_fabric_ai'];
    }

    /**
     * Sets payment_type_fabric_ai
     *
     * @param int|null $payment_type_fabric_ai If set, the payment type to be used when automating an invoice from this vendor.
     *
     * @return self
     */
    public function setPaymentTypeFabricAi($payment_type_fabric_ai)
    {

        if (!is_null($payment_type_fabric_ai) && ($payment_type_fabric_ai < 0)) {
            throw new \InvalidArgumentException('invalid value for $payment_type_fabric_ai when calling SupplierAutomation., must be bigger than or equal to 0.');
        }


        if (is_null($payment_type_fabric_ai)) {
            throw new \InvalidArgumentException('non-nullable payment_type_fabric_ai cannot be null');
        }

        $this->container['payment_type_fabric_ai'] = $payment_type_fabric_ai;

        return $this;
    }

    /**
     * Gets amount_max_fabric_ai_vendor_invoice
     *
     * @return int|null
     */
    public function getAmountMaxFabricAiVendorInvoice()
    {
        return $this->container['amount_max_fabric_ai_vendor_invoice'];
    }

    /**
     * Sets amount_max_fabric_ai_vendor_invoice
     *
     * @param int|null $amount_max_fabric_ai_vendor_invoice If set, gives the amount limit for automating invoices for this vendor, it the total invoice amount is above the limit, the invoice is not automated.
     *
     * @return self
     */
    public function setAmountMaxFabricAiVendorInvoice($amount_max_fabric_ai_vendor_invoice)
    {

        if (is_null($amount_max_fabric_ai_vendor_invoice)) {
            throw new \InvalidArgumentException('non-nullable amount_max_fabric_ai_vendor_invoice cannot be null');
        }

        $this->container['amount_max_fabric_ai_vendor_invoice'] = $amount_max_fabric_ai_vendor_invoice;

        return $this;
    }

    /**
     * Gets date_request_ehf_sent
     *
     * @return string|null
     */
    public function getDateRequestEhfSent()
    {
        return $this->container['date_request_ehf_sent'];
    }

    /**
     * Sets date_request_ehf_sent
     *
     * @param string|null $date_request_ehf_sent The date the user has sent the request to a supplier to receive EHF.
     *
     * @return self
     */
    public function setDateRequestEhfSent($date_request_ehf_sent)
    {

        if (is_null($date_request_ehf_sent)) {
            throw new \InvalidArgumentException('non-nullable date_request_ehf_sent cannot be null');
        }

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


