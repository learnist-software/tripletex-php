<?php
/**
 * TrialInfoAutomationDTO
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
 * TrialInfoAutomationDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TrialInfoAutomationDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TrialInfoAutomationDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'total_could_be_automated90days' => 'int',
'total_could_be_automated365days' => 'int',
'percent_suggestions_ehf' => 'int',
'percent_automated_ehf' => 'int',
'total_eh_finvoices' => 'int',
'total_correct_suggestions' => 'int',
'correct_suggestions90days' => 'int',
'correct_suggestions365days' => 'int',
'total_automated90days' => 'int',
'total_automated365days' => 'int',
'count_deactivated_vendors' => 'int',
'count_activated_vendors' => 'int',
'getvendors_could_be_automated' => 'int',
'vendors_not_sending_ehf' => 'int',
'voucher_count_non_ehf' => 'int',
'percent_vendors_not_sending_ehf' => 'int',
'percent_invoices_non_ehf' => 'int',
'show_project_hint' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'total_could_be_automated90days' => 'int32',
'total_could_be_automated365days' => 'int32',
'percent_suggestions_ehf' => 'int32',
'percent_automated_ehf' => 'int32',
'total_eh_finvoices' => 'int32',
'total_correct_suggestions' => 'int32',
'correct_suggestions90days' => 'int32',
'correct_suggestions365days' => 'int32',
'total_automated90days' => 'int32',
'total_automated365days' => 'int32',
'count_deactivated_vendors' => 'int32',
'count_activated_vendors' => 'int32',
'getvendors_could_be_automated' => 'int32',
'vendors_not_sending_ehf' => 'int32',
'voucher_count_non_ehf' => 'int32',
'percent_vendors_not_sending_ehf' => 'int32',
'percent_invoices_non_ehf' => 'int32',
'show_project_hint' => null    ];

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
        'total_could_be_automated90days' => 'totalCouldBeAutomated90days',
'total_could_be_automated365days' => 'totalCouldBeAutomated365days',
'percent_suggestions_ehf' => 'percentSuggestionsEHF',
'percent_automated_ehf' => 'percentAutomatedEHF',
'total_eh_finvoices' => 'totalEHFinvoices',
'total_correct_suggestions' => 'totalCorrectSuggestions',
'correct_suggestions90days' => 'correctSuggestions90days',
'correct_suggestions365days' => 'correctSuggestions365days',
'total_automated90days' => 'totalAutomated90days',
'total_automated365days' => 'totalAutomated365days',
'count_deactivated_vendors' => 'countDeactivatedVendors',
'count_activated_vendors' => 'countActivatedVendors',
'getvendors_could_be_automated' => 'getvendorsCouldBeAutomated',
'vendors_not_sending_ehf' => 'vendorsNotSendingEhf',
'voucher_count_non_ehf' => 'voucherCountNonEhf',
'percent_vendors_not_sending_ehf' => 'percentVendorsNotSendingEhf',
'percent_invoices_non_ehf' => 'percentInvoicesNonEhf',
'show_project_hint' => 'showProjectHint'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'total_could_be_automated90days' => 'setTotalCouldBeAutomated90days',
'total_could_be_automated365days' => 'setTotalCouldBeAutomated365days',
'percent_suggestions_ehf' => 'setPercentSuggestionsEhf',
'percent_automated_ehf' => 'setPercentAutomatedEhf',
'total_eh_finvoices' => 'setTotalEhFinvoices',
'total_correct_suggestions' => 'setTotalCorrectSuggestions',
'correct_suggestions90days' => 'setCorrectSuggestions90days',
'correct_suggestions365days' => 'setCorrectSuggestions365days',
'total_automated90days' => 'setTotalAutomated90days',
'total_automated365days' => 'setTotalAutomated365days',
'count_deactivated_vendors' => 'setCountDeactivatedVendors',
'count_activated_vendors' => 'setCountActivatedVendors',
'getvendors_could_be_automated' => 'setGetvendorsCouldBeAutomated',
'vendors_not_sending_ehf' => 'setVendorsNotSendingEhf',
'voucher_count_non_ehf' => 'setVoucherCountNonEhf',
'percent_vendors_not_sending_ehf' => 'setPercentVendorsNotSendingEhf',
'percent_invoices_non_ehf' => 'setPercentInvoicesNonEhf',
'show_project_hint' => 'setShowProjectHint'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'total_could_be_automated90days' => 'getTotalCouldBeAutomated90days',
'total_could_be_automated365days' => 'getTotalCouldBeAutomated365days',
'percent_suggestions_ehf' => 'getPercentSuggestionsEhf',
'percent_automated_ehf' => 'getPercentAutomatedEhf',
'total_eh_finvoices' => 'getTotalEhFinvoices',
'total_correct_suggestions' => 'getTotalCorrectSuggestions',
'correct_suggestions90days' => 'getCorrectSuggestions90days',
'correct_suggestions365days' => 'getCorrectSuggestions365days',
'total_automated90days' => 'getTotalAutomated90days',
'total_automated365days' => 'getTotalAutomated365days',
'count_deactivated_vendors' => 'getCountDeactivatedVendors',
'count_activated_vendors' => 'getCountActivatedVendors',
'getvendors_could_be_automated' => 'getGetvendorsCouldBeAutomated',
'vendors_not_sending_ehf' => 'getVendorsNotSendingEhf',
'voucher_count_non_ehf' => 'getVoucherCountNonEhf',
'percent_vendors_not_sending_ehf' => 'getPercentVendorsNotSendingEhf',
'percent_invoices_non_ehf' => 'getPercentInvoicesNonEhf',
'show_project_hint' => 'getShowProjectHint'    ];

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
        $this->container['total_could_be_automated90days'] = isset($data['total_could_be_automated90days']) ? $data['total_could_be_automated90days'] : null;
        $this->container['total_could_be_automated365days'] = isset($data['total_could_be_automated365days']) ? $data['total_could_be_automated365days'] : null;
        $this->container['percent_suggestions_ehf'] = isset($data['percent_suggestions_ehf']) ? $data['percent_suggestions_ehf'] : null;
        $this->container['percent_automated_ehf'] = isset($data['percent_automated_ehf']) ? $data['percent_automated_ehf'] : null;
        $this->container['total_eh_finvoices'] = isset($data['total_eh_finvoices']) ? $data['total_eh_finvoices'] : null;
        $this->container['total_correct_suggestions'] = isset($data['total_correct_suggestions']) ? $data['total_correct_suggestions'] : null;
        $this->container['correct_suggestions90days'] = isset($data['correct_suggestions90days']) ? $data['correct_suggestions90days'] : null;
        $this->container['correct_suggestions365days'] = isset($data['correct_suggestions365days']) ? $data['correct_suggestions365days'] : null;
        $this->container['total_automated90days'] = isset($data['total_automated90days']) ? $data['total_automated90days'] : null;
        $this->container['total_automated365days'] = isset($data['total_automated365days']) ? $data['total_automated365days'] : null;
        $this->container['count_deactivated_vendors'] = isset($data['count_deactivated_vendors']) ? $data['count_deactivated_vendors'] : null;
        $this->container['count_activated_vendors'] = isset($data['count_activated_vendors']) ? $data['count_activated_vendors'] : null;
        $this->container['getvendors_could_be_automated'] = isset($data['getvendors_could_be_automated']) ? $data['getvendors_could_be_automated'] : null;
        $this->container['vendors_not_sending_ehf'] = isset($data['vendors_not_sending_ehf']) ? $data['vendors_not_sending_ehf'] : null;
        $this->container['voucher_count_non_ehf'] = isset($data['voucher_count_non_ehf']) ? $data['voucher_count_non_ehf'] : null;
        $this->container['percent_vendors_not_sending_ehf'] = isset($data['percent_vendors_not_sending_ehf']) ? $data['percent_vendors_not_sending_ehf'] : null;
        $this->container['percent_invoices_non_ehf'] = isset($data['percent_invoices_non_ehf']) ? $data['percent_invoices_non_ehf'] : null;
        $this->container['show_project_hint'] = isset($data['show_project_hint']) ? $data['show_project_hint'] : null;
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
     * Gets total_could_be_automated90days
     *
     * @return int
     */
    public function getTotalCouldBeAutomated90days()
    {
        return $this->container['total_could_be_automated90days'];
    }

    /**
     * Sets total_could_be_automated90days
     *
     * @param int $total_could_be_automated90days total_could_be_automated90days
     *
     * @return $this
     */
    public function setTotalCouldBeAutomated90days($total_could_be_automated90days)
    {
        $this->container['total_could_be_automated90days'] = $total_could_be_automated90days;

        return $this;
    }

    /**
     * Gets total_could_be_automated365days
     *
     * @return int
     */
    public function getTotalCouldBeAutomated365days()
    {
        return $this->container['total_could_be_automated365days'];
    }

    /**
     * Sets total_could_be_automated365days
     *
     * @param int $total_could_be_automated365days total_could_be_automated365days
     *
     * @return $this
     */
    public function setTotalCouldBeAutomated365days($total_could_be_automated365days)
    {
        $this->container['total_could_be_automated365days'] = $total_could_be_automated365days;

        return $this;
    }

    /**
     * Gets percent_suggestions_ehf
     *
     * @return int
     */
    public function getPercentSuggestionsEhf()
    {
        return $this->container['percent_suggestions_ehf'];
    }

    /**
     * Sets percent_suggestions_ehf
     *
     * @param int $percent_suggestions_ehf percent_suggestions_ehf
     *
     * @return $this
     */
    public function setPercentSuggestionsEhf($percent_suggestions_ehf)
    {
        $this->container['percent_suggestions_ehf'] = $percent_suggestions_ehf;

        return $this;
    }

    /**
     * Gets percent_automated_ehf
     *
     * @return int
     */
    public function getPercentAutomatedEhf()
    {
        return $this->container['percent_automated_ehf'];
    }

    /**
     * Sets percent_automated_ehf
     *
     * @param int $percent_automated_ehf percent_automated_ehf
     *
     * @return $this
     */
    public function setPercentAutomatedEhf($percent_automated_ehf)
    {
        $this->container['percent_automated_ehf'] = $percent_automated_ehf;

        return $this;
    }

    /**
     * Gets total_eh_finvoices
     *
     * @return int
     */
    public function getTotalEhFinvoices()
    {
        return $this->container['total_eh_finvoices'];
    }

    /**
     * Sets total_eh_finvoices
     *
     * @param int $total_eh_finvoices total_eh_finvoices
     *
     * @return $this
     */
    public function setTotalEhFinvoices($total_eh_finvoices)
    {
        $this->container['total_eh_finvoices'] = $total_eh_finvoices;

        return $this;
    }

    /**
     * Gets total_correct_suggestions
     *
     * @return int
     */
    public function getTotalCorrectSuggestions()
    {
        return $this->container['total_correct_suggestions'];
    }

    /**
     * Sets total_correct_suggestions
     *
     * @param int $total_correct_suggestions total_correct_suggestions
     *
     * @return $this
     */
    public function setTotalCorrectSuggestions($total_correct_suggestions)
    {
        $this->container['total_correct_suggestions'] = $total_correct_suggestions;

        return $this;
    }

    /**
     * Gets correct_suggestions90days
     *
     * @return int
     */
    public function getCorrectSuggestions90days()
    {
        return $this->container['correct_suggestions90days'];
    }

    /**
     * Sets correct_suggestions90days
     *
     * @param int $correct_suggestions90days correct_suggestions90days
     *
     * @return $this
     */
    public function setCorrectSuggestions90days($correct_suggestions90days)
    {
        $this->container['correct_suggestions90days'] = $correct_suggestions90days;

        return $this;
    }

    /**
     * Gets correct_suggestions365days
     *
     * @return int
     */
    public function getCorrectSuggestions365days()
    {
        return $this->container['correct_suggestions365days'];
    }

    /**
     * Sets correct_suggestions365days
     *
     * @param int $correct_suggestions365days correct_suggestions365days
     *
     * @return $this
     */
    public function setCorrectSuggestions365days($correct_suggestions365days)
    {
        $this->container['correct_suggestions365days'] = $correct_suggestions365days;

        return $this;
    }

    /**
     * Gets total_automated90days
     *
     * @return int
     */
    public function getTotalAutomated90days()
    {
        return $this->container['total_automated90days'];
    }

    /**
     * Sets total_automated90days
     *
     * @param int $total_automated90days total_automated90days
     *
     * @return $this
     */
    public function setTotalAutomated90days($total_automated90days)
    {
        $this->container['total_automated90days'] = $total_automated90days;

        return $this;
    }

    /**
     * Gets total_automated365days
     *
     * @return int
     */
    public function getTotalAutomated365days()
    {
        return $this->container['total_automated365days'];
    }

    /**
     * Sets total_automated365days
     *
     * @param int $total_automated365days total_automated365days
     *
     * @return $this
     */
    public function setTotalAutomated365days($total_automated365days)
    {
        $this->container['total_automated365days'] = $total_automated365days;

        return $this;
    }

    /**
     * Gets count_deactivated_vendors
     *
     * @return int
     */
    public function getCountDeactivatedVendors()
    {
        return $this->container['count_deactivated_vendors'];
    }

    /**
     * Sets count_deactivated_vendors
     *
     * @param int $count_deactivated_vendors count_deactivated_vendors
     *
     * @return $this
     */
    public function setCountDeactivatedVendors($count_deactivated_vendors)
    {
        $this->container['count_deactivated_vendors'] = $count_deactivated_vendors;

        return $this;
    }

    /**
     * Gets count_activated_vendors
     *
     * @return int
     */
    public function getCountActivatedVendors()
    {
        return $this->container['count_activated_vendors'];
    }

    /**
     * Sets count_activated_vendors
     *
     * @param int $count_activated_vendors count_activated_vendors
     *
     * @return $this
     */
    public function setCountActivatedVendors($count_activated_vendors)
    {
        $this->container['count_activated_vendors'] = $count_activated_vendors;

        return $this;
    }

    /**
     * Gets getvendors_could_be_automated
     *
     * @return int
     */
    public function getGetvendorsCouldBeAutomated()
    {
        return $this->container['getvendors_could_be_automated'];
    }

    /**
     * Sets getvendors_could_be_automated
     *
     * @param int $getvendors_could_be_automated getvendors_could_be_automated
     *
     * @return $this
     */
    public function setGetvendorsCouldBeAutomated($getvendors_could_be_automated)
    {
        $this->container['getvendors_could_be_automated'] = $getvendors_could_be_automated;

        return $this;
    }

    /**
     * Gets vendors_not_sending_ehf
     *
     * @return int
     */
    public function getVendorsNotSendingEhf()
    {
        return $this->container['vendors_not_sending_ehf'];
    }

    /**
     * Sets vendors_not_sending_ehf
     *
     * @param int $vendors_not_sending_ehf vendors_not_sending_ehf
     *
     * @return $this
     */
    public function setVendorsNotSendingEhf($vendors_not_sending_ehf)
    {
        $this->container['vendors_not_sending_ehf'] = $vendors_not_sending_ehf;

        return $this;
    }

    /**
     * Gets voucher_count_non_ehf
     *
     * @return int
     */
    public function getVoucherCountNonEhf()
    {
        return $this->container['voucher_count_non_ehf'];
    }

    /**
     * Sets voucher_count_non_ehf
     *
     * @param int $voucher_count_non_ehf voucher_count_non_ehf
     *
     * @return $this
     */
    public function setVoucherCountNonEhf($voucher_count_non_ehf)
    {
        $this->container['voucher_count_non_ehf'] = $voucher_count_non_ehf;

        return $this;
    }

    /**
     * Gets percent_vendors_not_sending_ehf
     *
     * @return int
     */
    public function getPercentVendorsNotSendingEhf()
    {
        return $this->container['percent_vendors_not_sending_ehf'];
    }

    /**
     * Sets percent_vendors_not_sending_ehf
     *
     * @param int $percent_vendors_not_sending_ehf percent_vendors_not_sending_ehf
     *
     * @return $this
     */
    public function setPercentVendorsNotSendingEhf($percent_vendors_not_sending_ehf)
    {
        $this->container['percent_vendors_not_sending_ehf'] = $percent_vendors_not_sending_ehf;

        return $this;
    }

    /**
     * Gets percent_invoices_non_ehf
     *
     * @return int
     */
    public function getPercentInvoicesNonEhf()
    {
        return $this->container['percent_invoices_non_ehf'];
    }

    /**
     * Sets percent_invoices_non_ehf
     *
     * @param int $percent_invoices_non_ehf percent_invoices_non_ehf
     *
     * @return $this
     */
    public function setPercentInvoicesNonEhf($percent_invoices_non_ehf)
    {
        $this->container['percent_invoices_non_ehf'] = $percent_invoices_non_ehf;

        return $this;
    }

    /**
     * Gets show_project_hint
     *
     * @return bool
     */
    public function getShowProjectHint()
    {
        return $this->container['show_project_hint'];
    }

    /**
     * Sets show_project_hint
     *
     * @param bool $show_project_hint show_project_hint
     *
     * @return $this
     */
    public function setShowProjectHint($show_project_hint)
    {
        $this->container['show_project_hint'] = $show_project_hint;

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
