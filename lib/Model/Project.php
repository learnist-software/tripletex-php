<?php
/**
 * Project
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
 * Project Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Project implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Project';

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
        'ignore_company_product_discount_agreement' => 'bool'
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
        'ignore_company_product_discount_agreement' => null
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
		'number' => false,
		'display_name' => false,
		'description' => false,
		'project_manager' => false,
		'department' => false,
		'main_project' => false,
		'start_date' => false,
		'end_date' => false,
		'customer' => false,
		'is_closed' => false,
		'is_ready_for_invoicing' => false,
		'is_internal' => false,
		'is_offer' => false,
		'is_fixed_price' => false,
		'project_category' => false,
		'delivery_address' => false,
		'display_name_format' => false,
		'reference' => false,
		'external_accounts_number' => false,
		'discount_percentage' => false,
		'vat_type' => false,
		'fixedprice' => false,
		'contribution_margin_percent' => false,
		'number_of_sub_projects' => false,
		'number_of_project_participants' => false,
		'order_lines' => false,
		'currency' => false,
		'mark_up_order_lines' => false,
		'mark_up_fees_earned' => false,
		'is_price_ceiling' => false,
		'price_ceiling_amount' => false,
		'project_hourly_rates' => false,
		'for_participants_only' => false,
		'participants' => false,
		'contact' => false,
		'attention' => false,
		'invoice_comment' => false,
		'invoicing_plan' => false,
		'preliminary_invoice' => false,
		'general_project_activities_per_project_only' => false,
		'project_activities' => false,
		'hierarchy_name_and_number' => false,
		'invoice_due_date' => false,
		'invoice_receiver_email' => false,
		'access_type' => false,
		'use_product_net_price' => false,
		'ignore_company_product_discount_agreement' => false
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
        'ignore_company_product_discount_agreement' => 'ignoreCompanyProductDiscountAgreement'
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
        'ignore_company_product_discount_agreement' => 'setIgnoreCompanyProductDiscountAgreement'
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
        'ignore_company_product_discount_agreement' => 'getIgnoreCompanyProductDiscountAgreement'
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

    public const DISPLAY_NAME_FORMAT_STANDARD = 'NAME_STANDARD';
    public const DISPLAY_NAME_FORMAT_INCL_CUSTOMER_NAME = 'NAME_INCL_CUSTOMER_NAME';
    public const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME = 'NAME_INCL_PARENT_NAME';
    public const DISPLAY_NAME_FORMAT_INCL_PARENT_NUMBER = 'NAME_INCL_PARENT_NUMBER';
    public const DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER = 'NAME_INCL_PARENT_NAME_AND_NUMBER';
    public const ACCESS_TYPE_NONE = 'NONE';
    public const ACCESS_TYPE_READ = 'READ';
    public const ACCESS_TYPE_WRITE = 'WRITE';

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
            self::DISPLAY_NAME_FORMAT_INCL_PARENT_NAME_AND_NUMBER,
        ];
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
            self::ACCESS_TYPE_WRITE,
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
        $this->setIfExists('number', $data ?? [], null);
        $this->setIfExists('display_name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('project_manager', $data ?? [], null);
        $this->setIfExists('department', $data ?? [], null);
        $this->setIfExists('main_project', $data ?? [], null);
        $this->setIfExists('start_date', $data ?? [], null);
        $this->setIfExists('end_date', $data ?? [], null);
        $this->setIfExists('customer', $data ?? [], null);
        $this->setIfExists('is_closed', $data ?? [], null);
        $this->setIfExists('is_ready_for_invoicing', $data ?? [], null);
        $this->setIfExists('is_internal', $data ?? [], null);
        $this->setIfExists('is_offer', $data ?? [], null);
        $this->setIfExists('is_fixed_price', $data ?? [], null);
        $this->setIfExists('project_category', $data ?? [], null);
        $this->setIfExists('delivery_address', $data ?? [], null);
        $this->setIfExists('display_name_format', $data ?? [], null);
        $this->setIfExists('reference', $data ?? [], null);
        $this->setIfExists('external_accounts_number', $data ?? [], null);
        $this->setIfExists('discount_percentage', $data ?? [], null);
        $this->setIfExists('vat_type', $data ?? [], null);
        $this->setIfExists('fixedprice', $data ?? [], null);
        $this->setIfExists('contribution_margin_percent', $data ?? [], null);
        $this->setIfExists('number_of_sub_projects', $data ?? [], null);
        $this->setIfExists('number_of_project_participants', $data ?? [], null);
        $this->setIfExists('order_lines', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('mark_up_order_lines', $data ?? [], null);
        $this->setIfExists('mark_up_fees_earned', $data ?? [], null);
        $this->setIfExists('is_price_ceiling', $data ?? [], null);
        $this->setIfExists('price_ceiling_amount', $data ?? [], null);
        $this->setIfExists('project_hourly_rates', $data ?? [], null);
        $this->setIfExists('for_participants_only', $data ?? [], null);
        $this->setIfExists('participants', $data ?? [], null);
        $this->setIfExists('contact', $data ?? [], null);
        $this->setIfExists('attention', $data ?? [], null);
        $this->setIfExists('invoice_comment', $data ?? [], null);
        $this->setIfExists('invoicing_plan', $data ?? [], null);
        $this->setIfExists('preliminary_invoice', $data ?? [], null);
        $this->setIfExists('general_project_activities_per_project_only', $data ?? [], null);
        $this->setIfExists('project_activities', $data ?? [], null);
        $this->setIfExists('hierarchy_name_and_number', $data ?? [], null);
        $this->setIfExists('invoice_due_date', $data ?? [], null);
        $this->setIfExists('invoice_receiver_email', $data ?? [], null);
        $this->setIfExists('access_type', $data ?? [], null);
        $this->setIfExists('use_product_net_price', $data ?? [], null);
        $this->setIfExists('ignore_company_product_discount_agreement', $data ?? [], null);
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

        if (!is_null($this->container['number']) && (mb_strlen($this->container['number']) > 100)) {
            $invalidProperties[] = "invalid value for 'number', the character length must be smaller than or equal to 100.";
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
                "invalid value '%s' for 'display_name_format', must be one of '%s'",
                $this->container['display_name_format'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['reference']) && (mb_strlen($this->container['reference']) > 255)) {
            $invalidProperties[] = "invalid value for 'reference', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['external_accounts_number']) && (mb_strlen($this->container['external_accounts_number']) > 100)) {
            $invalidProperties[] = "invalid value for 'external_accounts_number', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['invoice_receiver_email']) && (mb_strlen($this->container['invoice_receiver_email']) > 254)) {
            $invalidProperties[] = "invalid value for 'invoice_receiver_email', the character length must be smaller than or equal to 254.";
        }

        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!is_null($this->container['access_type']) && !in_array($this->container['access_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'access_type', must be one of '%s'",
                $this->container['access_type'],
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
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        if ((mb_strlen($name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name when calling Project., must be smaller than or equal to 255.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets number
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number
     *
     * @param string|null $number number
     *
     * @return self
     */
    public function setNumber($number)
    {
        if (is_null($number)) {
            throw new \InvalidArgumentException('non-nullable number cannot be null');
        }
        if ((mb_strlen($number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $number when calling Project., must be smaller than or equal to 100.');
        }

        $this->container['number'] = $number;

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
     * @return self
     */
    public function setProjectManager($project_manager)
    {
        if (is_null($project_manager)) {
            throw new \InvalidArgumentException('non-nullable project_manager cannot be null');
        }
        $this->container['project_manager'] = $project_manager;

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
     * Gets main_project
     *
     * @return \Learnist\Tripletex\Model\Project|null
     */
    public function getMainProject()
    {
        return $this->container['main_project'];
    }

    /**
     * Sets main_project
     *
     * @param \Learnist\Tripletex\Model\Project|null $main_project main_project
     *
     * @return self
     */
    public function setMainProject($main_project)
    {
        if (is_null($main_project)) {
            throw new \InvalidArgumentException('non-nullable main_project cannot be null');
        }
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
     * @return self
     */
    public function setStartDate($start_date)
    {
        if (is_null($start_date)) {
            throw new \InvalidArgumentException('non-nullable start_date cannot be null');
        }
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     *
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     *
     * @param string|null $end_date end_date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        if (is_null($end_date)) {
            throw new \InvalidArgumentException('non-nullable end_date cannot be null');
        }
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets customer
     *
     * @return \Learnist\Tripletex\Model\Customer|null
     */
    public function getCustomer()
    {
        return $this->container['customer'];
    }

    /**
     * Sets customer
     *
     * @param \Learnist\Tripletex\Model\Customer|null $customer customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {
        if (is_null($customer)) {
            throw new \InvalidArgumentException('non-nullable customer cannot be null');
        }
        $this->container['customer'] = $customer;

        return $this;
    }

    /**
     * Gets is_closed
     *
     * @return bool|null
     */
    public function getIsClosed()
    {
        return $this->container['is_closed'];
    }

    /**
     * Sets is_closed
     *
     * @param bool|null $is_closed is_closed
     *
     * @return self
     */
    public function setIsClosed($is_closed)
    {
        if (is_null($is_closed)) {
            throw new \InvalidArgumentException('non-nullable is_closed cannot be null');
        }
        $this->container['is_closed'] = $is_closed;

        return $this;
    }

    /**
     * Gets is_ready_for_invoicing
     *
     * @return bool|null
     */
    public function getIsReadyForInvoicing()
    {
        return $this->container['is_ready_for_invoicing'];
    }

    /**
     * Sets is_ready_for_invoicing
     *
     * @param bool|null $is_ready_for_invoicing is_ready_for_invoicing
     *
     * @return self
     */
    public function setIsReadyForInvoicing($is_ready_for_invoicing)
    {
        if (is_null($is_ready_for_invoicing)) {
            throw new \InvalidArgumentException('non-nullable is_ready_for_invoicing cannot be null');
        }
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
     * @return self
     */
    public function setIsInternal($is_internal)
    {
        if (is_null($is_internal)) {
            throw new \InvalidArgumentException('non-nullable is_internal cannot be null');
        }
        $this->container['is_internal'] = $is_internal;

        return $this;
    }

    /**
     * Gets is_offer
     *
     * @return bool|null
     */
    public function getIsOffer()
    {
        return $this->container['is_offer'];
    }

    /**
     * Sets is_offer
     *
     * @param bool|null $is_offer is_offer
     *
     * @return self
     */
    public function setIsOffer($is_offer)
    {
        if (is_null($is_offer)) {
            throw new \InvalidArgumentException('non-nullable is_offer cannot be null');
        }
        $this->container['is_offer'] = $is_offer;

        return $this;
    }

    /**
     * Gets is_fixed_price
     *
     * @return bool|null
     */
    public function getIsFixedPrice()
    {
        return $this->container['is_fixed_price'];
    }

    /**
     * Sets is_fixed_price
     *
     * @param bool|null $is_fixed_price Project is fixed price if set to true, hourly rate if set to false.
     *
     * @return self
     */
    public function setIsFixedPrice($is_fixed_price)
    {
        if (is_null($is_fixed_price)) {
            throw new \InvalidArgumentException('non-nullable is_fixed_price cannot be null');
        }
        $this->container['is_fixed_price'] = $is_fixed_price;

        return $this;
    }

    /**
     * Gets project_category
     *
     * @return \Learnist\Tripletex\Model\ProjectCategory|null
     */
    public function getProjectCategory()
    {
        return $this->container['project_category'];
    }

    /**
     * Sets project_category
     *
     * @param \Learnist\Tripletex\Model\ProjectCategory|null $project_category project_category
     *
     * @return self
     */
    public function setProjectCategory($project_category)
    {
        if (is_null($project_category)) {
            throw new \InvalidArgumentException('non-nullable project_category cannot be null');
        }
        $this->container['project_category'] = $project_category;

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
     * Gets display_name_format
     *
     * @return string|null
     */
    public function getDisplayNameFormat()
    {
        return $this->container['display_name_format'];
    }

    /**
     * Sets display_name_format
     *
     * @param string|null $display_name_format Defines project name presentation in overviews.
     *
     * @return self
     */
    public function setDisplayNameFormat($display_name_format)
    {
        if (is_null($display_name_format)) {
            throw new \InvalidArgumentException('non-nullable display_name_format cannot be null');
        }
        $allowedValues = $this->getDisplayNameFormatAllowableValues();
        if (!in_array($display_name_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'display_name_format', must be one of '%s'",
                    $display_name_format,
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
     * @return string|null
     */
    public function getReference()
    {
        return $this->container['reference'];
    }

    /**
     * Sets reference
     *
     * @param string|null $reference reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        if (is_null($reference)) {
            throw new \InvalidArgumentException('non-nullable reference cannot be null');
        }
        if ((mb_strlen($reference) > 255)) {
            throw new \InvalidArgumentException('invalid length for $reference when calling Project., must be smaller than or equal to 255.');
        }

        $this->container['reference'] = $reference;

        return $this;
    }

    /**
     * Gets external_accounts_number
     *
     * @return string|null
     */
    public function getExternalAccountsNumber()
    {
        return $this->container['external_accounts_number'];
    }

    /**
     * Sets external_accounts_number
     *
     * @param string|null $external_accounts_number external_accounts_number
     *
     * @return self
     */
    public function setExternalAccountsNumber($external_accounts_number)
    {
        if (is_null($external_accounts_number)) {
            throw new \InvalidArgumentException('non-nullable external_accounts_number cannot be null');
        }
        if ((mb_strlen($external_accounts_number) > 100)) {
            throw new \InvalidArgumentException('invalid length for $external_accounts_number when calling Project., must be smaller than or equal to 100.');
        }

        $this->container['external_accounts_number'] = $external_accounts_number;

        return $this;
    }

    /**
     * Gets discount_percentage
     *
     * @return float|null
     */
    public function getDiscountPercentage()
    {
        return $this->container['discount_percentage'];
    }

    /**
     * Sets discount_percentage
     *
     * @param float|null $discount_percentage Project discount percentage.
     *
     * @return self
     */
    public function setDiscountPercentage($discount_percentage)
    {
        if (is_null($discount_percentage)) {
            throw new \InvalidArgumentException('non-nullable discount_percentage cannot be null');
        }
        $this->container['discount_percentage'] = $discount_percentage;

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
     * Gets fixedprice
     *
     * @return float|null
     */
    public function getFixedprice()
    {
        return $this->container['fixedprice'];
    }

    /**
     * Sets fixedprice
     *
     * @param float|null $fixedprice Fixed price amount, in the project's currency.
     *
     * @return self
     */
    public function setFixedprice($fixedprice)
    {
        if (is_null($fixedprice)) {
            throw new \InvalidArgumentException('non-nullable fixedprice cannot be null');
        }
        $this->container['fixedprice'] = $fixedprice;

        return $this;
    }

    /**
     * Gets contribution_margin_percent
     *
     * @return float|null
     */
    public function getContributionMarginPercent()
    {
        return $this->container['contribution_margin_percent'];
    }

    /**
     * Sets contribution_margin_percent
     *
     * @param float|null $contribution_margin_percent contribution_margin_percent
     *
     * @return self
     */
    public function setContributionMarginPercent($contribution_margin_percent)
    {
        if (is_null($contribution_margin_percent)) {
            throw new \InvalidArgumentException('non-nullable contribution_margin_percent cannot be null');
        }
        $this->container['contribution_margin_percent'] = $contribution_margin_percent;

        return $this;
    }

    /**
     * Gets number_of_sub_projects
     *
     * @return int|null
     */
    public function getNumberOfSubProjects()
    {
        return $this->container['number_of_sub_projects'];
    }

    /**
     * Sets number_of_sub_projects
     *
     * @param int|null $number_of_sub_projects number_of_sub_projects
     *
     * @return self
     */
    public function setNumberOfSubProjects($number_of_sub_projects)
    {
        if (is_null($number_of_sub_projects)) {
            throw new \InvalidArgumentException('non-nullable number_of_sub_projects cannot be null');
        }
        $this->container['number_of_sub_projects'] = $number_of_sub_projects;

        return $this;
    }

    /**
     * Gets number_of_project_participants
     *
     * @return int|null
     */
    public function getNumberOfProjectParticipants()
    {
        return $this->container['number_of_project_participants'];
    }

    /**
     * Sets number_of_project_participants
     *
     * @param int|null $number_of_project_participants number_of_project_participants
     *
     * @return self
     */
    public function setNumberOfProjectParticipants($number_of_project_participants)
    {
        if (is_null($number_of_project_participants)) {
            throw new \InvalidArgumentException('non-nullable number_of_project_participants cannot be null');
        }
        $this->container['number_of_project_participants'] = $number_of_project_participants;

        return $this;
    }

    /**
     * Gets order_lines
     *
     * @return \Learnist\Tripletex\Model\ProjectOrderLine[]|null
     */
    public function getOrderLines()
    {
        return $this->container['order_lines'];
    }

    /**
     * Sets order_lines
     *
     * @param \Learnist\Tripletex\Model\ProjectOrderLine[]|null $order_lines Order lines tied to the order
     *
     * @return self
     */
    public function setOrderLines($order_lines)
    {
        if (is_null($order_lines)) {
            throw new \InvalidArgumentException('non-nullable order_lines cannot be null');
        }
        $this->container['order_lines'] = $order_lines;

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
     * Gets mark_up_order_lines
     *
     * @return float|null
     */
    public function getMarkUpOrderLines()
    {
        return $this->container['mark_up_order_lines'];
    }

    /**
     * Sets mark_up_order_lines
     *
     * @param float|null $mark_up_order_lines Set mark-up (%) for order lines.
     *
     * @return self
     */
    public function setMarkUpOrderLines($mark_up_order_lines)
    {
        if (is_null($mark_up_order_lines)) {
            throw new \InvalidArgumentException('non-nullable mark_up_order_lines cannot be null');
        }
        $this->container['mark_up_order_lines'] = $mark_up_order_lines;

        return $this;
    }

    /**
     * Gets mark_up_fees_earned
     *
     * @return float|null
     */
    public function getMarkUpFeesEarned()
    {
        return $this->container['mark_up_fees_earned'];
    }

    /**
     * Sets mark_up_fees_earned
     *
     * @param float|null $mark_up_fees_earned Set mark-up (%) for fees earned.
     *
     * @return self
     */
    public function setMarkUpFeesEarned($mark_up_fees_earned)
    {
        if (is_null($mark_up_fees_earned)) {
            throw new \InvalidArgumentException('non-nullable mark_up_fees_earned cannot be null');
        }
        $this->container['mark_up_fees_earned'] = $mark_up_fees_earned;

        return $this;
    }

    /**
     * Gets is_price_ceiling
     *
     * @return bool|null
     */
    public function getIsPriceCeiling()
    {
        return $this->container['is_price_ceiling'];
    }

    /**
     * Sets is_price_ceiling
     *
     * @param bool|null $is_price_ceiling Set to true if an hourly rate project has a price ceiling.
     *
     * @return self
     */
    public function setIsPriceCeiling($is_price_ceiling)
    {
        if (is_null($is_price_ceiling)) {
            throw new \InvalidArgumentException('non-nullable is_price_ceiling cannot be null');
        }
        $this->container['is_price_ceiling'] = $is_price_ceiling;

        return $this;
    }

    /**
     * Gets price_ceiling_amount
     *
     * @return float|null
     */
    public function getPriceCeilingAmount()
    {
        return $this->container['price_ceiling_amount'];
    }

    /**
     * Sets price_ceiling_amount
     *
     * @param float|null $price_ceiling_amount Price ceiling amount, in the project's currency.
     *
     * @return self
     */
    public function setPriceCeilingAmount($price_ceiling_amount)
    {
        if (is_null($price_ceiling_amount)) {
            throw new \InvalidArgumentException('non-nullable price_ceiling_amount cannot be null');
        }
        $this->container['price_ceiling_amount'] = $price_ceiling_amount;

        return $this;
    }

    /**
     * Gets project_hourly_rates
     *
     * @return \Learnist\Tripletex\Model\ProjectHourlyRate[]|null
     */
    public function getProjectHourlyRates()
    {
        return $this->container['project_hourly_rates'];
    }

    /**
     * Sets project_hourly_rates
     *
     * @param \Learnist\Tripletex\Model\ProjectHourlyRate[]|null $project_hourly_rates Project Rate Types tied to the project.
     *
     * @return self
     */
    public function setProjectHourlyRates($project_hourly_rates)
    {
        if (is_null($project_hourly_rates)) {
            throw new \InvalidArgumentException('non-nullable project_hourly_rates cannot be null');
        }
        $this->container['project_hourly_rates'] = $project_hourly_rates;

        return $this;
    }

    /**
     * Gets for_participants_only
     *
     * @return bool|null
     */
    public function getForParticipantsOnly()
    {
        return $this->container['for_participants_only'];
    }

    /**
     * Sets for_participants_only
     *
     * @param bool|null $for_participants_only Set to true if only project participants can register information on the project
     *
     * @return self
     */
    public function setForParticipantsOnly($for_participants_only)
    {
        if (is_null($for_participants_only)) {
            throw new \InvalidArgumentException('non-nullable for_participants_only cannot be null');
        }
        $this->container['for_participants_only'] = $for_participants_only;

        return $this;
    }

    /**
     * Gets participants
     *
     * @return \Learnist\Tripletex\Model\ProjectParticipant[]|null
     */
    public function getParticipants()
    {
        return $this->container['participants'];
    }

    /**
     * Sets participants
     *
     * @param \Learnist\Tripletex\Model\ProjectParticipant[]|null $participants Link to individual project participants.
     *
     * @return self
     */
    public function setParticipants($participants)
    {
        if (is_null($participants)) {
            throw new \InvalidArgumentException('non-nullable participants cannot be null');
        }
        $this->container['participants'] = $participants;

        return $this;
    }

    /**
     * Gets contact
     *
     * @return \Learnist\Tripletex\Model\Contact|null
     */
    public function getContact()
    {
        return $this->container['contact'];
    }

    /**
     * Sets contact
     *
     * @param \Learnist\Tripletex\Model\Contact|null $contact contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        if (is_null($contact)) {
            throw new \InvalidArgumentException('non-nullable contact cannot be null');
        }
        $this->container['contact'] = $contact;

        return $this;
    }

    /**
     * Gets attention
     *
     * @return \Learnist\Tripletex\Model\Contact|null
     */
    public function getAttention()
    {
        return $this->container['attention'];
    }

    /**
     * Sets attention
     *
     * @param \Learnist\Tripletex\Model\Contact|null $attention attention
     *
     * @return self
     */
    public function setAttention($attention)
    {
        if (is_null($attention)) {
            throw new \InvalidArgumentException('non-nullable attention cannot be null');
        }
        $this->container['attention'] = $attention;

        return $this;
    }

    /**
     * Gets invoice_comment
     *
     * @return string|null
     */
    public function getInvoiceComment()
    {
        return $this->container['invoice_comment'];
    }

    /**
     * Sets invoice_comment
     *
     * @param string|null $invoice_comment Comment for project invoices
     *
     * @return self
     */
    public function setInvoiceComment($invoice_comment)
    {
        if (is_null($invoice_comment)) {
            throw new \InvalidArgumentException('non-nullable invoice_comment cannot be null');
        }
        $this->container['invoice_comment'] = $invoice_comment;

        return $this;
    }

    /**
     * Gets invoicing_plan
     *
     * @return \Learnist\Tripletex\Model\Invoice[]|null
     */
    public function getInvoicingPlan()
    {
        return $this->container['invoicing_plan'];
    }

    /**
     * Sets invoicing_plan
     *
     * @param \Learnist\Tripletex\Model\Invoice[]|null $invoicing_plan Invoicing plans tied to the project
     *
     * @return self
     */
    public function setInvoicingPlan($invoicing_plan)
    {
        if (is_null($invoicing_plan)) {
            throw new \InvalidArgumentException('non-nullable invoicing_plan cannot be null');
        }
        $this->container['invoicing_plan'] = $invoicing_plan;

        return $this;
    }

    /**
     * Gets preliminary_invoice
     *
     * @return \Learnist\Tripletex\Model\Invoice|null
     */
    public function getPreliminaryInvoice()
    {
        return $this->container['preliminary_invoice'];
    }

    /**
     * Sets preliminary_invoice
     *
     * @param \Learnist\Tripletex\Model\Invoice|null $preliminary_invoice preliminary_invoice
     *
     * @return self
     */
    public function setPreliminaryInvoice($preliminary_invoice)
    {
        if (is_null($preliminary_invoice)) {
            throw new \InvalidArgumentException('non-nullable preliminary_invoice cannot be null');
        }
        $this->container['preliminary_invoice'] = $preliminary_invoice;

        return $this;
    }

    /**
     * Gets general_project_activities_per_project_only
     *
     * @return bool|null
     */
    public function getGeneralProjectActivitiesPerProjectOnly()
    {
        return $this->container['general_project_activities_per_project_only'];
    }

    /**
     * Sets general_project_activities_per_project_only
     *
     * @param bool|null $general_project_activities_per_project_only Set to true if a general project activity must be linked to project to allow time tracking.
     *
     * @return self
     */
    public function setGeneralProjectActivitiesPerProjectOnly($general_project_activities_per_project_only)
    {
        if (is_null($general_project_activities_per_project_only)) {
            throw new \InvalidArgumentException('non-nullable general_project_activities_per_project_only cannot be null');
        }
        $this->container['general_project_activities_per_project_only'] = $general_project_activities_per_project_only;

        return $this;
    }

    /**
     * Gets project_activities
     *
     * @return \Learnist\Tripletex\Model\ProjectActivity[]|null
     */
    public function getProjectActivities()
    {
        return $this->container['project_activities'];
    }

    /**
     * Sets project_activities
     *
     * @param \Learnist\Tripletex\Model\ProjectActivity[]|null $project_activities Project Activities
     *
     * @return self
     */
    public function setProjectActivities($project_activities)
    {
        if (is_null($project_activities)) {
            throw new \InvalidArgumentException('non-nullable project_activities cannot be null');
        }
        $this->container['project_activities'] = $project_activities;

        return $this;
    }

    /**
     * Gets hierarchy_name_and_number
     *
     * @return string|null
     */
    public function getHierarchyNameAndNumber()
    {
        return $this->container['hierarchy_name_and_number'];
    }

    /**
     * Sets hierarchy_name_and_number
     *
     * @param string|null $hierarchy_name_and_number hierarchy_name_and_number
     *
     * @return self
     */
    public function setHierarchyNameAndNumber($hierarchy_name_and_number)
    {
        if (is_null($hierarchy_name_and_number)) {
            throw new \InvalidArgumentException('non-nullable hierarchy_name_and_number cannot be null');
        }
        $this->container['hierarchy_name_and_number'] = $hierarchy_name_and_number;

        return $this;
    }

    /**
     * Gets invoice_due_date
     *
     * @return int|null
     */
    public function getInvoiceDueDate()
    {
        return $this->container['invoice_due_date'];
    }

    /**
     * Sets invoice_due_date
     *
     * @param int|null $invoice_due_date invoice due date
     *
     * @return self
     */
    public function setInvoiceDueDate($invoice_due_date)
    {
        if (is_null($invoice_due_date)) {
            throw new \InvalidArgumentException('non-nullable invoice_due_date cannot be null');
        }
        $this->container['invoice_due_date'] = $invoice_due_date;

        return $this;
    }

    /**
     * Gets invoice_receiver_email
     *
     * @return string|null
     */
    public function getInvoiceReceiverEmail()
    {
        return $this->container['invoice_receiver_email'];
    }

    /**
     * Sets invoice_receiver_email
     *
     * @param string|null $invoice_receiver_email receiver email
     *
     * @return self
     */
    public function setInvoiceReceiverEmail($invoice_receiver_email)
    {
        if (is_null($invoice_receiver_email)) {
            throw new \InvalidArgumentException('non-nullable invoice_receiver_email cannot be null');
        }
        if ((mb_strlen($invoice_receiver_email) > 254)) {
            throw new \InvalidArgumentException('invalid length for $invoice_receiver_email when calling Project., must be smaller than or equal to 254.');
        }

        $this->container['invoice_receiver_email'] = $invoice_receiver_email;

        return $this;
    }

    /**
     * Gets access_type
     *
     * @return string|null
     */
    public function getAccessType()
    {
        return $this->container['access_type'];
    }

    /**
     * Sets access_type
     *
     * @param string|null $access_type READ/WRITE access on project
     *
     * @return self
     */
    public function setAccessType($access_type)
    {
        if (is_null($access_type)) {
            throw new \InvalidArgumentException('non-nullable access_type cannot be null');
        }
        $allowedValues = $this->getAccessTypeAllowableValues();
        if (!in_array($access_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'access_type', must be one of '%s'",
                    $access_type,
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
     * @return bool|null
     */
    public function getUseProductNetPrice()
    {
        return $this->container['use_product_net_price'];
    }

    /**
     * Sets use_product_net_price
     *
     * @param bool|null $use_product_net_price use_product_net_price
     *
     * @return self
     */
    public function setUseProductNetPrice($use_product_net_price)
    {
        if (is_null($use_product_net_price)) {
            throw new \InvalidArgumentException('non-nullable use_product_net_price cannot be null');
        }
        $this->container['use_product_net_price'] = $use_product_net_price;

        return $this;
    }

    /**
     * Gets ignore_company_product_discount_agreement
     *
     * @return bool|null
     */
    public function getIgnoreCompanyProductDiscountAgreement()
    {
        return $this->container['ignore_company_product_discount_agreement'];
    }

    /**
     * Sets ignore_company_product_discount_agreement
     *
     * @param bool|null $ignore_company_product_discount_agreement ignore_company_product_discount_agreement
     *
     * @return self
     */
    public function setIgnoreCompanyProductDiscountAgreement($ignore_company_product_discount_agreement)
    {
        if (is_null($ignore_company_product_discount_agreement)) {
            throw new \InvalidArgumentException('non-nullable ignore_company_product_discount_agreement cannot be null');
        }
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


