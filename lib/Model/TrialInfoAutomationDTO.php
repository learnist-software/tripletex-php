<?php
/**
 * TrialInfoAutomationDTO
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
 * TrialInfoAutomationDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TrialInfoAutomationDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TrialInfoAutomationDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
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
        'show_project_hint' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
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
        'show_project_hint' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'total_could_be_automated90days' => false,
		'total_could_be_automated365days' => false,
		'percent_suggestions_ehf' => false,
		'percent_automated_ehf' => false,
		'total_eh_finvoices' => false,
		'total_correct_suggestions' => false,
		'correct_suggestions90days' => false,
		'correct_suggestions365days' => false,
		'total_automated90days' => false,
		'total_automated365days' => false,
		'count_deactivated_vendors' => false,
		'count_activated_vendors' => false,
		'getvendors_could_be_automated' => false,
		'vendors_not_sending_ehf' => false,
		'voucher_count_non_ehf' => false,
		'percent_vendors_not_sending_ehf' => false,
		'percent_invoices_non_ehf' => false,
		'show_project_hint' => false
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
        'show_project_hint' => 'showProjectHint'
    ];

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
        'show_project_hint' => 'setShowProjectHint'
    ];

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
        'show_project_hint' => 'getShowProjectHint'
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
        $this->setIfExists('total_could_be_automated90days', $data ?? [], null);
        $this->setIfExists('total_could_be_automated365days', $data ?? [], null);
        $this->setIfExists('percent_suggestions_ehf', $data ?? [], null);
        $this->setIfExists('percent_automated_ehf', $data ?? [], null);
        $this->setIfExists('total_eh_finvoices', $data ?? [], null);
        $this->setIfExists('total_correct_suggestions', $data ?? [], null);
        $this->setIfExists('correct_suggestions90days', $data ?? [], null);
        $this->setIfExists('correct_suggestions365days', $data ?? [], null);
        $this->setIfExists('total_automated90days', $data ?? [], null);
        $this->setIfExists('total_automated365days', $data ?? [], null);
        $this->setIfExists('count_deactivated_vendors', $data ?? [], null);
        $this->setIfExists('count_activated_vendors', $data ?? [], null);
        $this->setIfExists('getvendors_could_be_automated', $data ?? [], null);
        $this->setIfExists('vendors_not_sending_ehf', $data ?? [], null);
        $this->setIfExists('voucher_count_non_ehf', $data ?? [], null);
        $this->setIfExists('percent_vendors_not_sending_ehf', $data ?? [], null);
        $this->setIfExists('percent_invoices_non_ehf', $data ?? [], null);
        $this->setIfExists('show_project_hint', $data ?? [], null);
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
     * @return int|null
     */
    public function getTotalCouldBeAutomated90days()
    {
        return $this->container['total_could_be_automated90days'];
    }

    /**
     * Sets total_could_be_automated90days
     *
     * @param int|null $total_could_be_automated90days total_could_be_automated90days
     *
     * @return self
     */
    public function setTotalCouldBeAutomated90days($total_could_be_automated90days)
    {

        if (is_null($total_could_be_automated90days)) {
            throw new \InvalidArgumentException('non-nullable total_could_be_automated90days cannot be null');
        }

        $this->container['total_could_be_automated90days'] = $total_could_be_automated90days;

        return $this;
    }

    /**
     * Gets total_could_be_automated365days
     *
     * @return int|null
     */
    public function getTotalCouldBeAutomated365days()
    {
        return $this->container['total_could_be_automated365days'];
    }

    /**
     * Sets total_could_be_automated365days
     *
     * @param int|null $total_could_be_automated365days total_could_be_automated365days
     *
     * @return self
     */
    public function setTotalCouldBeAutomated365days($total_could_be_automated365days)
    {

        if (is_null($total_could_be_automated365days)) {
            throw new \InvalidArgumentException('non-nullable total_could_be_automated365days cannot be null');
        }

        $this->container['total_could_be_automated365days'] = $total_could_be_automated365days;

        return $this;
    }

    /**
     * Gets percent_suggestions_ehf
     *
     * @return int|null
     */
    public function getPercentSuggestionsEhf()
    {
        return $this->container['percent_suggestions_ehf'];
    }

    /**
     * Sets percent_suggestions_ehf
     *
     * @param int|null $percent_suggestions_ehf percent_suggestions_ehf
     *
     * @return self
     */
    public function setPercentSuggestionsEhf($percent_suggestions_ehf)
    {

        if (is_null($percent_suggestions_ehf)) {
            throw new \InvalidArgumentException('non-nullable percent_suggestions_ehf cannot be null');
        }

        $this->container['percent_suggestions_ehf'] = $percent_suggestions_ehf;

        return $this;
    }

    /**
     * Gets percent_automated_ehf
     *
     * @return int|null
     */
    public function getPercentAutomatedEhf()
    {
        return $this->container['percent_automated_ehf'];
    }

    /**
     * Sets percent_automated_ehf
     *
     * @param int|null $percent_automated_ehf percent_automated_ehf
     *
     * @return self
     */
    public function setPercentAutomatedEhf($percent_automated_ehf)
    {

        if (is_null($percent_automated_ehf)) {
            throw new \InvalidArgumentException('non-nullable percent_automated_ehf cannot be null');
        }

        $this->container['percent_automated_ehf'] = $percent_automated_ehf;

        return $this;
    }

    /**
     * Gets total_eh_finvoices
     *
     * @return int|null
     */
    public function getTotalEhFinvoices()
    {
        return $this->container['total_eh_finvoices'];
    }

    /**
     * Sets total_eh_finvoices
     *
     * @param int|null $total_eh_finvoices total_eh_finvoices
     *
     * @return self
     */
    public function setTotalEhFinvoices($total_eh_finvoices)
    {

        if (is_null($total_eh_finvoices)) {
            throw new \InvalidArgumentException('non-nullable total_eh_finvoices cannot be null');
        }

        $this->container['total_eh_finvoices'] = $total_eh_finvoices;

        return $this;
    }

    /**
     * Gets total_correct_suggestions
     *
     * @return int|null
     */
    public function getTotalCorrectSuggestions()
    {
        return $this->container['total_correct_suggestions'];
    }

    /**
     * Sets total_correct_suggestions
     *
     * @param int|null $total_correct_suggestions total_correct_suggestions
     *
     * @return self
     */
    public function setTotalCorrectSuggestions($total_correct_suggestions)
    {

        if (is_null($total_correct_suggestions)) {
            throw new \InvalidArgumentException('non-nullable total_correct_suggestions cannot be null');
        }

        $this->container['total_correct_suggestions'] = $total_correct_suggestions;

        return $this;
    }

    /**
     * Gets correct_suggestions90days
     *
     * @return int|null
     */
    public function getCorrectSuggestions90days()
    {
        return $this->container['correct_suggestions90days'];
    }

    /**
     * Sets correct_suggestions90days
     *
     * @param int|null $correct_suggestions90days correct_suggestions90days
     *
     * @return self
     */
    public function setCorrectSuggestions90days($correct_suggestions90days)
    {

        if (is_null($correct_suggestions90days)) {
            throw new \InvalidArgumentException('non-nullable correct_suggestions90days cannot be null');
        }

        $this->container['correct_suggestions90days'] = $correct_suggestions90days;

        return $this;
    }

    /**
     * Gets correct_suggestions365days
     *
     * @return int|null
     */
    public function getCorrectSuggestions365days()
    {
        return $this->container['correct_suggestions365days'];
    }

    /**
     * Sets correct_suggestions365days
     *
     * @param int|null $correct_suggestions365days correct_suggestions365days
     *
     * @return self
     */
    public function setCorrectSuggestions365days($correct_suggestions365days)
    {

        if (is_null($correct_suggestions365days)) {
            throw new \InvalidArgumentException('non-nullable correct_suggestions365days cannot be null');
        }

        $this->container['correct_suggestions365days'] = $correct_suggestions365days;

        return $this;
    }

    /**
     * Gets total_automated90days
     *
     * @return int|null
     */
    public function getTotalAutomated90days()
    {
        return $this->container['total_automated90days'];
    }

    /**
     * Sets total_automated90days
     *
     * @param int|null $total_automated90days total_automated90days
     *
     * @return self
     */
    public function setTotalAutomated90days($total_automated90days)
    {

        if (is_null($total_automated90days)) {
            throw new \InvalidArgumentException('non-nullable total_automated90days cannot be null');
        }

        $this->container['total_automated90days'] = $total_automated90days;

        return $this;
    }

    /**
     * Gets total_automated365days
     *
     * @return int|null
     */
    public function getTotalAutomated365days()
    {
        return $this->container['total_automated365days'];
    }

    /**
     * Sets total_automated365days
     *
     * @param int|null $total_automated365days total_automated365days
     *
     * @return self
     */
    public function setTotalAutomated365days($total_automated365days)
    {

        if (is_null($total_automated365days)) {
            throw new \InvalidArgumentException('non-nullable total_automated365days cannot be null');
        }

        $this->container['total_automated365days'] = $total_automated365days;

        return $this;
    }

    /**
     * Gets count_deactivated_vendors
     *
     * @return int|null
     */
    public function getCountDeactivatedVendors()
    {
        return $this->container['count_deactivated_vendors'];
    }

    /**
     * Sets count_deactivated_vendors
     *
     * @param int|null $count_deactivated_vendors count_deactivated_vendors
     *
     * @return self
     */
    public function setCountDeactivatedVendors($count_deactivated_vendors)
    {

        if (is_null($count_deactivated_vendors)) {
            throw new \InvalidArgumentException('non-nullable count_deactivated_vendors cannot be null');
        }

        $this->container['count_deactivated_vendors'] = $count_deactivated_vendors;

        return $this;
    }

    /**
     * Gets count_activated_vendors
     *
     * @return int|null
     */
    public function getCountActivatedVendors()
    {
        return $this->container['count_activated_vendors'];
    }

    /**
     * Sets count_activated_vendors
     *
     * @param int|null $count_activated_vendors count_activated_vendors
     *
     * @return self
     */
    public function setCountActivatedVendors($count_activated_vendors)
    {

        if (is_null($count_activated_vendors)) {
            throw new \InvalidArgumentException('non-nullable count_activated_vendors cannot be null');
        }

        $this->container['count_activated_vendors'] = $count_activated_vendors;

        return $this;
    }

    /**
     * Gets getvendors_could_be_automated
     *
     * @return int|null
     */
    public function getGetvendorsCouldBeAutomated()
    {
        return $this->container['getvendors_could_be_automated'];
    }

    /**
     * Sets getvendors_could_be_automated
     *
     * @param int|null $getvendors_could_be_automated getvendors_could_be_automated
     *
     * @return self
     */
    public function setGetvendorsCouldBeAutomated($getvendors_could_be_automated)
    {

        if (is_null($getvendors_could_be_automated)) {
            throw new \InvalidArgumentException('non-nullable getvendors_could_be_automated cannot be null');
        }

        $this->container['getvendors_could_be_automated'] = $getvendors_could_be_automated;

        return $this;
    }

    /**
     * Gets vendors_not_sending_ehf
     *
     * @return int|null
     */
    public function getVendorsNotSendingEhf()
    {
        return $this->container['vendors_not_sending_ehf'];
    }

    /**
     * Sets vendors_not_sending_ehf
     *
     * @param int|null $vendors_not_sending_ehf vendors_not_sending_ehf
     *
     * @return self
     */
    public function setVendorsNotSendingEhf($vendors_not_sending_ehf)
    {

        if (is_null($vendors_not_sending_ehf)) {
            throw new \InvalidArgumentException('non-nullable vendors_not_sending_ehf cannot be null');
        }

        $this->container['vendors_not_sending_ehf'] = $vendors_not_sending_ehf;

        return $this;
    }

    /**
     * Gets voucher_count_non_ehf
     *
     * @return int|null
     */
    public function getVoucherCountNonEhf()
    {
        return $this->container['voucher_count_non_ehf'];
    }

    /**
     * Sets voucher_count_non_ehf
     *
     * @param int|null $voucher_count_non_ehf voucher_count_non_ehf
     *
     * @return self
     */
    public function setVoucherCountNonEhf($voucher_count_non_ehf)
    {

        if (is_null($voucher_count_non_ehf)) {
            throw new \InvalidArgumentException('non-nullable voucher_count_non_ehf cannot be null');
        }

        $this->container['voucher_count_non_ehf'] = $voucher_count_non_ehf;

        return $this;
    }

    /**
     * Gets percent_vendors_not_sending_ehf
     *
     * @return int|null
     */
    public function getPercentVendorsNotSendingEhf()
    {
        return $this->container['percent_vendors_not_sending_ehf'];
    }

    /**
     * Sets percent_vendors_not_sending_ehf
     *
     * @param int|null $percent_vendors_not_sending_ehf percent_vendors_not_sending_ehf
     *
     * @return self
     */
    public function setPercentVendorsNotSendingEhf($percent_vendors_not_sending_ehf)
    {

        if (is_null($percent_vendors_not_sending_ehf)) {
            throw new \InvalidArgumentException('non-nullable percent_vendors_not_sending_ehf cannot be null');
        }

        $this->container['percent_vendors_not_sending_ehf'] = $percent_vendors_not_sending_ehf;

        return $this;
    }

    /**
     * Gets percent_invoices_non_ehf
     *
     * @return int|null
     */
    public function getPercentInvoicesNonEhf()
    {
        return $this->container['percent_invoices_non_ehf'];
    }

    /**
     * Sets percent_invoices_non_ehf
     *
     * @param int|null $percent_invoices_non_ehf percent_invoices_non_ehf
     *
     * @return self
     */
    public function setPercentInvoicesNonEhf($percent_invoices_non_ehf)
    {

        if (is_null($percent_invoices_non_ehf)) {
            throw new \InvalidArgumentException('non-nullable percent_invoices_non_ehf cannot be null');
        }

        $this->container['percent_invoices_non_ehf'] = $percent_invoices_non_ehf;

        return $this;
    }

    /**
     * Gets show_project_hint
     *
     * @return bool|null
     */
    public function getShowProjectHint()
    {
        return $this->container['show_project_hint'];
    }

    /**
     * Sets show_project_hint
     *
     * @param bool|null $show_project_hint show_project_hint
     *
     * @return self
     */
    public function setShowProjectHint($show_project_hint)
    {

        if (is_null($show_project_hint)) {
            throw new \InvalidArgumentException('non-nullable show_project_hint cannot be null');
        }

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


