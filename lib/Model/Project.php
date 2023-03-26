<?php
/**
 * Project
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
 * Project Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Project implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Project';

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
'number' => 'string',
'display_name' => 'string',
'description' => 'string',
'project_manager' => '\Learnist\Tripletex\Model\Employee',
'department' => '\Learnist\Tripletex\Model\Department',
'main_project' => '\Learnist\Tripletex\Model\Project',
'start_date' => 'string',
'end_date' => 'string',
'customer' => '\Learnist\Tripletex\Model\Customer',
'is_closed' => 'bool',
'is_ready_for_invoicing' => 'bool',
'is_internal' => 'bool',
'is_offer' => 'bool',
'is_fixed_price' => 'bool',
'project_category' => '\Learnist\Tripletex\Model\ProjectCategory',
'delivery_address' => '\Learnist\Tripletex\Model\DeliveryAddress',
'display_name_format' => 'string',
'reference' => 'string',
'external_accounts_number' => 'string',
'discount_percentage' => 'float',
'vat_type' => '\Learnist\Tripletex\Model\VatType',
'fixedprice' => 'float',
'contribution_margin_percent' => 'float',
'number_of_sub_projects' => 'int',
'number_of_project_participants' => 'int',
'order_lines' => '\Learnist\Tripletex\Model\ProjectOrderLine[]',
'currency' => '\Learnist\Tripletex\Model\Currency',
'mark_up_order_lines' => 'float',
'mark_up_fees_earned' => 'float',
'is_price_ceiling' => 'bool',
'price_ceiling_amount' => 'float',
'project_hourly_rates' => '\Learnist\Tripletex\Model\ProjectHourlyRate[]',
'for_participants_only' => 'bool',
'participants' => '\Learnist\Tripletex\Model\ProjectParticipant[]',
'contact' => '\Learnist\Tripletex\Model\Contact',
'attention' => '\Learnist\Tripletex\Model\Contact',
'invoice_comment' => 'string',
'invoicing_plan' => '\Learnist\Tripletex\Model\Invoice[]',
'preliminary_invoice' => '\Learnist\Tripletex\Model\Invoice',
'general_project_activities_per_project_only' => 'bool',
'project_activities' => '\Learnist\Tripletex\Model\ProjectActivity[]',
'hierarchy_name_and_number' => 'string',
'invoice_due_date' => 'int',
'invoice_receiver_email' => 'string',
'access_type' => 'string',
'use_product_net_price' => 'bool',
'ignore_company_product_discount_agreement' => 'bool'    ];

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
'number' => null,
'display_name' => null,
'description' => null,
'project_manager' => null,
'department' => null,
'main_project' => null,
'start_date' => null,
'end_date' => null,
'customer' => null,
'is_closed' => null,
'is_ready_for_invoicing' => null,
'is_internal' => null,
'is_offer' => null,
'is_fixed_price' => null,
'project_category' => null,
'delivery_address' => null,
'display_name_format' => null,
'reference' => null,
'external_accounts_number' => null,
'discount_percentage' => null,
'vat_type' => null,
'fixedprice' => null,
'contribution_margin_percent' => null,
'number_of_sub_projects' => 'int32',
'number_of_project_participants' => 'int32',
'order_lines' => null,
'currency' => null,
'mark_up_order_lines' => null,
'mark_up_fees_earned' => null,
'is_price_ceiling' => null,
'price_ceiling_amount' => null,
'project_hourly_rates' => null,
'for_participants_only' => null,
'participants' => null,
'contact' => null,
'attention' => null,
'invoice_comment' => null,
'invoicing_plan' => null,
'preliminary_invoice' => null,
'general_project_activities_per_project_only' => null,
'project_activities' => null,
'hierarchy_name_and_number' => null,
'invoice_due_date' => 'int32',
'invoice_receiver_email' => null,
'access_type' => null,
'use_product_net_price' => null,
'ignore_company_product_discount_agreement' => null    ];

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
'number' => 'number',
'display_name' => 'displayName',
'description' => 'description',
'project_manager' => 'projectManager',
'department' => 'department',
'main_project' => 'mainProject',
'start_date' => 'startDate',
'end_date' => 'endDate',
'customer' => 'customer',
'is_closed' => 'isClosed',
'is_ready_for_invoicing' => 'isReadyForInvoicing',
'is_internal' => 'isInternal',
'is_offer' => 'isOffer',
'is_fixed_price' => 'isFixedPrice',
'project_category' => 'projectCategory',
'delivery_address' => 'deliveryAddress',
'display_name_format' => 'displayNameFormat',
'reference' => 'reference',
'external_accounts_number' => 'externalAccountsNumber',
'discount_percentage' => 'discountPercentage',
'vat_type' => 'vatType',
'fixedprice' => 'fixedprice',
'contribution_margin_percent' => 'contributionMarginPercent',
'number_of_sub_projects' => 'numberOfSubProjects',
'number_of_project_participants' => 'numberOfProjectParticipants',
'order_lines' => 'orderLines',
'currency' => 'currency',
'mark_up_order_lines' => 'markUpOrderLines',
'mark_up_fees_earned' => 'markUpFeesEarned',
'is_price_ceiling' => 'isPriceCeiling',
'price_ceiling_amount' => 'priceCeilingAmount',
'project_hourly_rates' => 'projectHourlyRates',
'for_participants_only' => 'forParticipantsOnly',
'participants' => 'participants',
'contact' => 'contact',
'attention' => 'attention',
'invoice_comment' => 'invoiceComment',
'invoicing_plan' => 'invoicingPlan',
'preliminary_invoice' => 'preliminaryInvoice',
'general_project_activities_per_project_only' => 'generalProjectActivitiesPerProjectOnly',
'project_activities' => 'projectActivities',
'hierarchy_name_and_number' => 'hierarchyNameAndNumber',
'invoice_due_date' => 'invoiceDueDate',
'invoice_receiver_email' => 'invoiceReceiverEmail',
'access_type' => 'accessType',
'use_product_net_price' => 'useProductNetPrice',
'ignore_company_product_discount_agreement' => 'ignoreCompanyProductDiscountAgreement'    ];

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
'number' => 'setNumber',
'display_name' => 'setDisplayName',
'description' => 'setDescription',
'project_manager' => 'setProjectManager',
'department' => 'setDepartment',
'main_project' => 'setMainProject',
'start_date' => 'setStartDate',
'end_date' => 'setEndDate',
'customer' => 'setCustomer',
'is_closed' => 'setIsClosed',
'is_ready_for_invoicing' => 'setIsReadyForInvoicing',
'is_internal' => 'setIsInternal',
'is_offer' => 'setIsOffer',
'is_fixed_price' => 'setIsFixedPrice',
'project_category' => 'setProjectCategory',
'delivery_address' => 'setDeliveryAddress',
'display_name_format' => 'setDisplayNameFormat',
'reference' => 'setReference',
'external_accounts_number' => 'setExternalAccountsNumber',
'discount_percentage' => 'setDiscountPercentage',
'vat_type' => 'setVatType',
'fixedprice' => 'setFixedprice',
'contribution_margin_percent' => 'setContributionMarginPercent',
'number_of_sub_projects' => 'setNumberOfSubProjects',
'number_of_project_participants' => 'setNumberOfProjectParticipants',
'order_lines' => 'setOrderLines',
'currency' => 'setCurrency',
'mark_up_order_lines' => 'setMarkUpOrderLines',
'mark_up_fees_earned' => 'setMarkUpFeesEarned',
'is_price_ceiling' => 'setIsPriceCeiling',
'price_ceiling_amount' => 'setPriceCeilingAmount',
'project_hourly_rates' => 'setProjectHourlyRates',
'for_participants_only' => 'setForParticipantsOnly',
'participants' => 'setParticipants',
'contact' => 'setContact',
'attention' => 'setAttention',
'invoice_comment' => 'setInvoiceComment',
'invoicing_plan' => 'setInvoicingPlan',
'preliminary_invoice' => 'setPreliminaryInvoice',
'general_project_activities_per_project_only' => 'setGeneralProjectActivitiesPerProjectOnly',
'project_activities' => 'setProjectActivities',
'hierarchy_name_and_number' => 'setHierarchyNameAndNumber',
'invoice_due_date' => 'setInvoiceDueDate',
'invoice_receiver_email' => 'setInvoiceReceiverEmail',
'access_type' => 'setAccessType',
'use_product_net_price' => 'setUseProductNetPrice',
'ignore_company_product_discount_agreement' => 'setIgnoreCompanyProductDiscountAgreement'    ];

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
'number' => 'getNumber',
'display_name' => 'getDisplayName',
'description' => 'getDescription',
'project_manager' => 'getProjectManager',
'department' => 'getDepartment',
'main_project' => 'getMainProject',
'start_date' => 'getStartDate',
'end_date' => 'getEndDate',
'customer' => 'getCustomer',
'is_closed' => 'getIsClosed',
'is_ready_for_invoicing' => 'getIsReadyForInvoicing',
'is_internal' => 'getIsInternal',
'is_offer' => 'getIsOffer',
'is_fixed_price' => 'getIsFixedPrice',
'project_category' => 'getProjectCategory',
'delivery_address' => 'getDeliveryAddress',
'display_name_format' => 'getDisplayNameFormat',
'reference' => 'getReference',
'external_accounts_number' => 'getExternalAccountsNumber',
'discount_percentage' => 'getDiscountPercentage',
'vat_type' => 'getVatType',
'fixedprice' => 'getFixedprice',
'contribution_margin_percent' => 'getContributionMarginPercent',
'number_of_sub_projects' => 'getNumberOfSubProjects',
'number_of_project_participants' => 'getNumberOfProjectParticipants',
'order_lines' => 'getOrderLines',
'currency' => 'getCurrency',
'mark_up_order_lines' => 'getMarkUpOrderLines',
'mark_up_fees_earned' => 'getMarkUpFeesEarned',
'is_price_ceiling' => 'getIsPriceCeiling',
'price_ceiling_amount' => 'getPriceCeilingAmount',
'project_hourly_rates' => 'getProjectHourlyRates',
'for_participants_only' => 'getForParticipantsOnly',
'participants' => 'getParticipants',
'contact' => 'getContact',
'attention' => 'getAttention',
'invoice_comment' => 'getInvoiceComment',
'invoicing_plan' => 'getInvoicingPlan',
'preliminary_invoice' => 'getPreliminaryInvoice',
'general_project_activities_per_project_only' => 'getGeneralProjectActivitiesPerProjectOnly',
'project_activities' => 'getProjectActivities',
'hierarchy_name_and_number' => 'getHierarchyNameAndNumber',
'invoice_due_date' => 'getInvoiceDueDate',
'invoice_receiver_email' => 'getInvoiceReceiverEmail',
'access_type' => 'getAccessType',
'use_product_net_price' => 'getUseProductNetPrice',
'ignore_company_product_discount_agreement' => 'getIgnoreCompanyProductDiscountAgreement'    ];

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

    const DISPLAY_NAME_FORMAT_STANDARD = 'NAME_STANDARD';
const DISPLAY_NAME_FORMAT_INCL_CUSTOMER_NAME = 'NAME_INCL_CUSTOMER_NAME';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME = 'NAME_INCL_PARENT_NAME';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NUMBER = 'NAME_INCL_PARENT_NUMBER';
const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER = 'NAME_INCL_PARENT_NAME_AND_NUMBER';
const ACCESS_TYPE_NONE = 'NONE';
const ACCESS_TYPE_READ = 'READ';
const ACCESS_TYPE_WRITE = 'WRITE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDisplayNameFormatAllowableValues()
    {
        return [
            self::DISPLAY_NAME_FORMAT_STANDARD,
self::DISPLAY_NAME_FORMAT_INCL_CUSTOMER_NAME,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NAME,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NUMBER,
self::DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccessTypeAllowableValues()
    {
        return [
            self::ACCESS_TYPE_NONE,
self::ACCESS_TYPE_READ,
self::ACCESS_TYPE_WRITE,        ];
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
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['project_manager'] = isset($data['project_manager']) ? $data['project_manager'] : null;
        $this->container['department'] = isset($data['department']) ? $data['department'] : null;
        $this->container['main_project'] = isset($data['main_project']) ? $data['main_project'] : null;
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['customer'] = isset($data['customer']) ? $data['customer'] : null;
        $this->container['is_closed'] = isset($data['is_closed']) ? $data['is_closed'] : null;
        $this->container['is_ready_for_invoicing'] = isset($data['is_ready_for_invoicing']) ? $data['is_ready_for_invoicing'] : null;
        $this->container['is_internal'] = isset($data['is_internal']) ? $data['is_internal'] : null;
        $this->container['is_offer'] = isset($data['is_offer']) ? $data['is_offer'] : null;
        $this->container['is_fixed_price'] = isset($data['is_fixed_price']) ? $data['is_fixed_price'] : null;
        $this->container['project_category'] = isset($data['project_category']) ? $data['project_category'] : null;
        $this->container['delivery_address'] = isset($data['delivery_address']) ? $data['delivery_address'] : null;
        $this->container['display_name_format'] = isset($data['display_name_format']) ? $data['display_name_format'] : null;
        $this->container['reference'] = isset($data['reference']) ? $data['reference'] : null;
        $this->container['external_accounts_number'] = isset($data['external_accounts_number']) ? $data['external_accounts_number'] : null;
        $this->container['discount_percentage'] = isset($data['discount_percentage']) ? $data['discount_percentage'] : null;
        $this->container['vat_type'] = isset($data['vat_type']) ? $data['vat_type'] : null;
        $this->container['fixedprice'] = isset($data['fixedprice']) ? $data['fixedprice'] : null;
        $this->container['contribution_margin_percent'] = isset($data['contribution_margin_percent']) ? $data['contribution_margin_percent'] : null;
        $this->container['number_of_sub_projects'] = isset($data['number_of_sub_projects']) ? $data['number_of_sub_projects'] : null;
        $this->container['number_of_project_participants'] = isset($data['number_of_project_participants']) ? $data['number_of_project_participants'] : null;
        $this->container['order_lines'] = isset($data['order_lines']) ? $data['order_lines'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['mark_up_order_lines'] = isset($data['mark_up_order_lines']) ? $data['mark_up_order_lines'] : null;
        $this->container['mark_up_fees_earned'] = isset($data['mark_up_fees_earned']) ? $data['mark_up_fees_earned'] : null;
        $this->container['is_price_ceiling'] = isset($data['is_price_ceiling']) ? $data['is_price_ceiling'] : null;
        $this->container['price_ceiling_amount'] = isset($data['price_ceiling_amount']) ? $data['price_ceiling_amount'] : null;
        $this->container['project_hourly_rates'] = isset($data['project_hourly_rates']) ? $data['project_hourly_rates'] : null;
        $this->container['for_participants_only'] = isset($data['for_participants_only']) ? $data['for_participants_only'] : null;
        $this->container['participants'] = isset($data['participants']) ? $data['participants'] : null;
        $this->container['contact'] = isset($data['contact']) ? $data['contact'] : null;
        $this->container['attention'] = isset($data['attention']) ? $data['attention'] : null;
        $this->container['invoice_comment'] = isset($data['invoice_comment']) ? $data['invoice_comment'] : null;
        $this->container['invoicing_plan'] = isset($data['invoicing_plan']) ? $data['invoicing_plan'] : null;
        $this->container['preliminary_invoice'] = isset($data['preliminary_invoice']) ? $data['preliminary_invoice'] : null;
        $this->container['general_project_activities_per_project_only'] = isset($data['general_project_activities_per_project_only']) ? $data['general_project_activities_per_project_only'] : null;
        $this->container['project_activities'] = isset($data['project_activities']) ? $data['project_activities'] : null;
        $this->container['hierarchy_name_and_number'] = isset($data['hierarchy_name_and_number']) ? $data['hierarchy_name_and_number'] : null;
        $this->container['invoice_due_date'] = isset($data['invoice_due_date']) ? $data['invoice_due_date'] : null;
        $this->container['invoice_receiver_email'] = isset($data['invoice_receiver_email']) ? $data['invoice_receiver_email'] : null;
        $this->container['access_type'] = isset($data['access_type']) ? $data['access_type'] : null;
        $this->container['use_product_net_price'] = isset($data['use_product_net_price']) ? $data['use_product_net_price'] : null;
        $this->container['ignore_company_product_discount_agreement'] = isset($data['ignore_company_product_discount_agreement']) ? $data['ignore_company_product_discount_agreement'] : null;
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
        if ($this->container['project_manager'] === null) {
            $invalidProperties[] = "'project_manager' can't be null";
        }
        if ($this->container['start_date'] === null) {
            $invalidProperties[] = "'start_date' can't be null";
        }
        if ($this->container['is_internal'] === null) {
            $invalidProperties[] = "'is_internal' can't be null";
        }
        $allowedValues = $this->getDisplayNameFormatAllowableValues();
        if (!is_null($this->container['display_name_format']) && !in_array($this->container['display_name_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'display_name_format', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($this->container['access_type']) && !in_array($this->container['access_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'access_type', must be one of '%s'",
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
     * Gets project_manager
     *
     * @return \Learnist\Tripletex\Model\Employee
     */
    public function getProjectManager()
    {
        return $this->container['project_manager'];
    }

    /**
     * Sets project_manager
     *
     * @param \Learnist\Tripletex\Model\Employee $project_manager project_manager
     *
     * @return $this
     */
    public function setProjectManager($project_manager)
    {
        $this->container['project_manager'] = $project_manager;

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
     * Gets main_project
     *
     * @return \Learnist\Tripletex\Model\Project
     */
    public function getMainProject()
    {
        return $this->container['main_project'];
    }

    /**
     * Sets main_project
     *
     * @param \Learnist\Tripletex\Model\Project $main_project main_project
     *
     * @return $this
     */
    public function setMainProject($main_project)
    {
        $this->container['main_project'] = $main_project;

        return $this;
    }

    /**
     * Gets start_date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     *
     * @param string $start_date start_date
     *
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string $end_date end_date
     *
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

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
     * @param bool $is_closed is_closed
     *
     * @return $this
     */
    public function setIsClosed($is_closed)
    {
        $this->container['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Gets is_ready_for_invoicing
     *
     * @return bool
     */
    public function getIsReadyForInvoicing()
    {
        return $this->container['is_ready_for_invoicing'];
    }

    /**
     * Sets is_ready_for_invoicing
     *
     * @param bool $is_ready_for_invoicing is_ready_for_invoicing
     *
     * @return $this
     */
    public function setIsReadyForInvoicing($is_ready_for_invoicing)
    {
        $this->container['is_ready_for_invoicing'] = $is_ready_for_invoicing;

        return $this;
    }

    /**
     * Gets is_internal
     *
     * @return bool
     */
    public function getIsInternal()
    {
        return $this->container['is_internal'];
    }

    /**
     * Sets is_internal
     *
     * @param bool $is_internal is_internal
     *
     * @return $this
     */
    public function setIsInternal($is_internal)
    {
        $this->container['is_internal'] = $is_internal;

        return $this;
    }

    /**
     * Gets is_offer
     *
     * @return bool
     */
    public function getIsOffer()
    {
        return $this->container['is_offer'];
    }

    /**
     * Sets is_offer
     *
     * @param bool $is_offer is_offer
     *
     * @return $this
     */
    public function setIsOffer($is_offer)
    {
        $this->container['is_offer'] = $is_offer;

        return $this;
    }

    /**
     * Gets is_fixed_price
     *
     * @return bool
     */
    public function getIsFixedPrice()
    {
        return $this->container['is_fixed_price'];
    }

    /**
     * Sets is_fixed_price
     *
     * @param bool $is_fixed_price Project is fixed price if set to true, hourly rate if set to false.
     *
     * @return $this
     */
    public function setIsFixedPrice($is_fixed_price)
    {
        $this->container['is_fixed_price'] = $is_fixed_price;

        return $this;
    }

    /**
     * Gets project_category
     *
     * @return \Learnist\Tripletex\Model\ProjectCategory
     */
    public function getProjectCategory()
    {
        return $this->container['project_category'];
    }

    /**
     * Sets project_category
     *
     * @param \Learnist\Tripletex\Model\ProjectCategory $project_category project_category
     *
     * @return $this
     */
    public function setProjectCategory($project_category)
    {
        $this->container['project_category'] = $project_category;

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
     * Gets display_name_format
     *
     * @return string
     */
    public function getDisplayNameFormat()
    {
        return $this->container['display_name_format'];
    }

    /**
     * Sets display_name_format
     *
     * @param string $display_name_format Defines project name presentation in overviews.
     *
     * @return $this
     */
    public function setDisplayNameFormat($display_name_format)
    {
        $allowedValues = $this->getDisplayNameFormatAllowableValues();
        if (!is_null($display_name_format) && !in_array($display_name_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'display_name_format', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['display_name_format'] = $display_name_format;

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
     * Gets external_accounts_number
     *
     * @return string
     */
    public function getExternalAccountsNumber()
    {
        return $this->container['external_accounts_number'];
    }

    /**
     * Sets external_accounts_number
     *
     * @param string $external_accounts_number external_accounts_number
     *
     * @return $this
     */
    public function setExternalAccountsNumber($external_accounts_number)
    {
        $this->container['external_accounts_number'] = $external_accounts_number;

        return $this;
    }

    /**
     * Gets discount_percentage
     *
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->container['discount_percentage'];
    }

    /**
     * Sets discount_percentage
     *
     * @param float $discount_percentage Project discount percentage.
     *
     * @return $this
     */
    public function setDiscountPercentage($discount_percentage)
    {
        $this->container['discount_percentage'] = $discount_percentage;

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
     * Gets fixedprice
     *
     * @return float
     */
    public function getFixedprice()
    {
        return $this->container['fixedprice'];
    }

    /**
     * Sets fixedprice
     *
     * @param float $fixedprice Fixed price amount, in the project's currency.
     *
     * @return $this
     */
    public function setFixedprice($fixedprice)
    {
        $this->container['fixedprice'] = $fixedprice;

        return $this;
    }

    /**
     * Gets contribution_margin_percent
     *
     * @return float
     */
    public function getContributionMarginPercent()
    {
        return $this->container['contribution_margin_percent'];
    }

    /**
     * Sets contribution_margin_percent
     *
     * @param float $contribution_margin_percent contribution_margin_percent
     *
     * @return $this
     */
    public function setContributionMarginPercent($contribution_margin_percent)
    {
        $this->container['contribution_margin_percent'] = $contribution_margin_percent;

        return $this;
    }

    /**
     * Gets number_of_sub_projects
     *
     * @return int
     */
    public function getNumberOfSubProjects()
    {
        return $this->container['number_of_sub_projects'];
    }

    /**
     * Sets number_of_sub_projects
     *
     * @param int $number_of_sub_projects number_of_sub_projects
     *
     * @return $this
     */
    public function setNumberOfSubProjects($number_of_sub_projects)
    {
        $this->container['number_of_sub_projects'] = $number_of_sub_projects;

        return $this;
    }

    /**
     * Gets number_of_project_participants
     *
     * @return int
     */
    public function getNumberOfProjectParticipants()
    {
        return $this->container['number_of_project_participants'];
    }

    /**
     * Sets number_of_project_participants
     *
     * @param int $number_of_project_participants number_of_project_participants
     *
     * @return $this
     */
    public function setNumberOfProjectParticipants($number_of_project_participants)
    {
        $this->container['number_of_project_participants'] = $number_of_project_participants;

        return $this;
    }

    /**
     * Gets order_lines
     *
     * @return \Learnist\Tripletex\Model\ProjectOrderLine[]
     */
    public function getOrderLines()
    {
        return $this->container['order_lines'];
    }

    /**
     * Sets order_lines
     *
     * @param \Learnist\Tripletex\Model\ProjectOrderLine[] $order_lines Order lines tied to the order
     *
     * @return $this
     */
    public function setOrderLines($order_lines)
    {
        $this->container['order_lines'] = $order_lines;

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
     * Gets mark_up_order_lines
     *
     * @return float
     */
    public function getMarkUpOrderLines()
    {
        return $this->container['mark_up_order_lines'];
    }

    /**
     * Sets mark_up_order_lines
     *
     * @param float $mark_up_order_lines Set mark-up (%) for order lines.
     *
     * @return $this
     */
    public function setMarkUpOrderLines($mark_up_order_lines)
    {
        $this->container['mark_up_order_lines'] = $mark_up_order_lines;

        return $this;
    }

    /**
     * Gets mark_up_fees_earned
     *
     * @return float
     */
    public function getMarkUpFeesEarned()
    {
        return $this->container['mark_up_fees_earned'];
    }

    /**
     * Sets mark_up_fees_earned
     *
     * @param float $mark_up_fees_earned Set mark-up (%) for fees earned.
     *
     * @return $this
     */
    public function setMarkUpFeesEarned($mark_up_fees_earned)
    {
        $this->container['mark_up_fees_earned'] = $mark_up_fees_earned;

        return $this;
    }

    /**
     * Gets is_price_ceiling
     *
     * @return bool
     */
    public function getIsPriceCeiling()
    {
        return $this->container['is_price_ceiling'];
    }

    /**
     * Sets is_price_ceiling
     *
     * @param bool $is_price_ceiling Set to true if an hourly rate project has a price ceiling.
     *
     * @return $this
     */
    public function setIsPriceCeiling($is_price_ceiling)
    {
        $this->container['is_price_ceiling'] = $is_price_ceiling;

        return $this;
    }

    /**
     * Gets price_ceiling_amount
     *
     * @return float
     */
    public function getPriceCeilingAmount()
    {
        return $this->container['price_ceiling_amount'];
    }

    /**
     * Sets price_ceiling_amount
     *
     * @param float $price_ceiling_amount Price ceiling amount, in the project's currency.
     *
     * @return $this
     */
    public function setPriceCeilingAmount($price_ceiling_amount)
    {
        $this->container['price_ceiling_amount'] = $price_ceiling_amount;

        return $this;
    }

    /**
     * Gets project_hourly_rates
     *
     * @return \Learnist\Tripletex\Model\ProjectHourlyRate[]
     */
    public function getProjectHourlyRates()
    {
        return $this->container['project_hourly_rates'];
    }

    /**
     * Sets project_hourly_rates
     *
     * @param \Learnist\Tripletex\Model\ProjectHourlyRate[] $project_hourly_rates Project Rate Types tied to the project.
     *
     * @return $this
     */
    public function setProjectHourlyRates($project_hourly_rates)
    {
        $this->container['project_hourly_rates'] = $project_hourly_rates;

        return $this;
    }

    /**
     * Gets for_participants_only
     *
     * @return bool
     */
    public function getForParticipantsOnly()
    {
        return $this->container['for_participants_only'];
    }

    /**
     * Sets for_participants_only
     *
     * @param bool $for_participants_only Set to true if only project participants can register information on the project
     *
     * @return $this
     */
    public function setForParticipantsOnly($for_participants_only)
    {
        $this->container['for_participants_only'] = $for_participants_only;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \Learnist\Tripletex\Model\ProjectParticipant[]
     */
    public function getParticipants()
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \Learnist\Tripletex\Model\ProjectParticipant[] $participants Link to individual project participants.
     *
     * @return $this
     */
    public function setParticipants($participants)
    {
        $this->container['participants'] = $participants;

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
     * Gets attention
     *
     * @return \Learnist\Tripletex\Model\Contact
     */
    public function getAttention()
    {
        return $this->container['attention'];
    }

    /**
     * Sets attention
     *
     * @param \Learnist\Tripletex\Model\Contact $attention attention
     *
     * @return $this
     */
    public function setAttention($attention)
    {
        $this->container['attention'] = $attention;

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
     * @param string $invoice_comment Comment for project invoices
     *
     * @return $this
     */
    public function setInvoiceComment($invoice_comment)
    {
        $this->container['invoice_comment'] = $invoice_comment;

        return $this;
    }

    /**
     * Gets invoicing_plan
     *
     * @return \Learnist\Tripletex\Model\Invoice[]
     */
    public function getInvoicingPlan()
    {
        return $this->container['invoicing_plan'];
    }

    /**
     * Sets invoicing_plan
     *
     * @param \Learnist\Tripletex\Model\Invoice[] $invoicing_plan Invoicing plans tied to the project
     *
     * @return $this
     */
    public function setInvoicingPlan($invoicing_plan)
    {
        $this->container['invoicing_plan'] = $invoicing_plan;

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
     * Gets general_project_activities_per_project_only
     *
     * @return bool
     */
    public function getGeneralProjectActivitiesPerProjectOnly()
    {
        return $this->container['general_project_activities_per_project_only'];
    }

    /**
     * Sets general_project_activities_per_project_only
     *
     * @param bool $general_project_activities_per_project_only Set to true if a general project activity must be linked to project to allow time tracking.
     *
     * @return $this
     */
    public function setGeneralProjectActivitiesPerProjectOnly($general_project_activities_per_project_only)
    {
        $this->container['general_project_activities_per_project_only'] = $general_project_activities_per_project_only;

        return $this;
    }

    /**
     * Gets project_activities
     *
     * @return \Learnist\Tripletex\Model\ProjectActivity[]
     */
    public function getProjectActivities()
    {
        return $this->container['project_activities'];
    }

    /**
     * Sets project_activities
     *
     * @param \Learnist\Tripletex\Model\ProjectActivity[] $project_activities Project Activities
     *
     * @return $this
     */
    public function setProjectActivities($project_activities)
    {
        $this->container['project_activities'] = $project_activities;

        return $this;
    }

    /**
     * Gets hierarchy_name_and_number
     *
     * @return string
     */
    public function getHierarchyNameAndNumber()
    {
        return $this->container['hierarchy_name_and_number'];
    }

    /**
     * Sets hierarchy_name_and_number
     *
     * @param string $hierarchy_name_and_number hierarchy_name_and_number
     *
     * @return $this
     */
    public function setHierarchyNameAndNumber($hierarchy_name_and_number)
    {
        $this->container['hierarchy_name_and_number'] = $hierarchy_name_and_number;

        return $this;
    }

    /**
     * Gets invoice_due_date
     *
     * @return int
     */
    public function getInvoiceDueDate()
    {
        return $this->container['invoice_due_date'];
    }

    /**
     * Sets invoice_due_date
     *
     * @param int $invoice_due_date invoice due date
     *
     * @return $this
     */
    public function setInvoiceDueDate($invoice_due_date)
    {
        $this->container['invoice_due_date'] = $invoice_due_date;

        return $this;
    }

    /**
     * Gets invoice_receiver_email
     *
     * @return string
     */
    public function getInvoiceReceiverEmail()
    {
        return $this->container['invoice_receiver_email'];
    }

    /**
     * Sets invoice_receiver_email
     *
     * @param string $invoice_receiver_email receiver email
     *
     * @return $this
     */
    public function setInvoiceReceiverEmail($invoice_receiver_email)
    {
        $this->container['invoice_receiver_email'] = $invoice_receiver_email;

        return $this;
    }

    /**
     * Gets access_type
     *
     * @return string
     */
    public function getAccessType()
    {
        return $this->container['access_type'];
    }

    /**
     * Sets access_type
     *
     * @param string $access_type READ/WRITE access on project
     *
     * @return $this
     */
    public function setAccessType($access_type)
    {
        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($access_type) && !in_array($access_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'access_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['access_type'] = $access_type;

        return $this;
    }

    /**
     * Gets use_product_net_price
     *
     * @return bool
     */
    public function getUseProductNetPrice()
    {
        return $this->container['use_product_net_price'];
    }

    /**
     * Sets use_product_net_price
     *
     * @param bool $use_product_net_price use_product_net_price
     *
     * @return $this
     */
    public function setUseProductNetPrice($use_product_net_price)
    {
        $this->container['use_product_net_price'] = $use_product_net_price;

        return $this;
    }

    /**
     * Gets ignore_company_product_discount_agreement
     *
     * @return bool
     */
    public function getIgnoreCompanyProductDiscountAgreement()
    {
        return $this->container['ignore_company_product_discount_agreement'];
    }

    /**
     * Sets ignore_company_product_discount_agreement
     *
     * @param bool $ignore_company_product_discount_agreement ignore_company_product_discount_agreement
     *
     * @return $this
     */
    public function setIgnoreCompanyProductDiscountAgreement($ignore_company_product_discount_agreement)
    {
        $this->container['ignore_company_product_discount_agreement'] = $ignore_company_product_discount_agreement;

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
