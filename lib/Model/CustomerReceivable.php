<?php
/**
 * CustomerReceivable
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
 * CustomerReceivable Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CustomerReceivable implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CustomerReceivable';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'year_end_report' => '\Learnist\Tripletex\Model\YearEndReport',
        'opening_balance_receivable_and_non_invoiced_revenue' => 'float',
        'closing_balance_receivable_and_non_invoiced_revenue' => 'float',
        'opening_balance_ascertained_loss' => 'float',
        'closing_balance_ascertained_loss' => 'float',
        'opening_balance_write_down' => 'float',
        'closing_balance_write_down' => 'float',
        'sum_tax_value' => 'float',
        'amount_to_be_posted_on_account' => 'float',
        'accounted_value' => 'float',
        'opening_balance_differences' => 'float',
        'closing_balance_differences' => 'float',
        'changes' => 'float',
        'opening_balance_accounting_values' => 'float',
        'closing_balance_accounting_values' => 'float',
        'generic_data_overviews' => '\Learnist\Tripletex\Model\GenericDataOverview[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'year_end_report' => null,
        'opening_balance_receivable_and_non_invoiced_revenue' => null,
        'closing_balance_receivable_and_non_invoiced_revenue' => null,
        'opening_balance_ascertained_loss' => null,
        'closing_balance_ascertained_loss' => null,
        'opening_balance_write_down' => null,
        'closing_balance_write_down' => null,
        'sum_tax_value' => null,
        'amount_to_be_posted_on_account' => null,
        'accounted_value' => null,
        'opening_balance_differences' => null,
        'closing_balance_differences' => null,
        'changes' => null,
        'opening_balance_accounting_values' => null,
        'closing_balance_accounting_values' => null,
        'generic_data_overviews' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'year_end_report' => false,
		'opening_balance_receivable_and_non_invoiced_revenue' => false,
		'closing_balance_receivable_and_non_invoiced_revenue' => false,
		'opening_balance_ascertained_loss' => false,
		'closing_balance_ascertained_loss' => false,
		'opening_balance_write_down' => false,
		'closing_balance_write_down' => false,
		'sum_tax_value' => false,
		'amount_to_be_posted_on_account' => false,
		'accounted_value' => false,
		'opening_balance_differences' => false,
		'closing_balance_differences' => false,
		'changes' => false,
		'opening_balance_accounting_values' => false,
		'closing_balance_accounting_values' => false,
		'generic_data_overviews' => false
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
        'year_end_report' => 'yearEndReport',
        'opening_balance_receivable_and_non_invoiced_revenue' => 'openingBalanceReceivableAndNonInvoicedRevenue',
        'closing_balance_receivable_and_non_invoiced_revenue' => 'closingBalanceReceivableAndNonInvoicedRevenue',
        'opening_balance_ascertained_loss' => 'openingBalanceAscertainedLoss',
        'closing_balance_ascertained_loss' => 'closingBalanceAscertainedLoss',
        'opening_balance_write_down' => 'openingBalanceWriteDown',
        'closing_balance_write_down' => 'closingBalanceWriteDown',
        'sum_tax_value' => 'sumTaxValue',
        'amount_to_be_posted_on_account' => 'amountToBePostedOnAccount',
        'accounted_value' => 'accountedValue',
        'opening_balance_differences' => 'openingBalanceDifferences',
        'closing_balance_differences' => 'closingBalanceDifferences',
        'changes' => 'changes',
        'opening_balance_accounting_values' => 'openingBalanceAccountingValues',
        'closing_balance_accounting_values' => 'closingBalanceAccountingValues',
        'generic_data_overviews' => 'genericDataOverviews'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'year_end_report' => 'setYearEndReport',
        'opening_balance_receivable_and_non_invoiced_revenue' => 'setOpeningBalanceReceivableAndNonInvoicedRevenue',
        'closing_balance_receivable_and_non_invoiced_revenue' => 'setClosingBalanceReceivableAndNonInvoicedRevenue',
        'opening_balance_ascertained_loss' => 'setOpeningBalanceAscertainedLoss',
        'closing_balance_ascertained_loss' => 'setClosingBalanceAscertainedLoss',
        'opening_balance_write_down' => 'setOpeningBalanceWriteDown',
        'closing_balance_write_down' => 'setClosingBalanceWriteDown',
        'sum_tax_value' => 'setSumTaxValue',
        'amount_to_be_posted_on_account' => 'setAmountToBePostedOnAccount',
        'accounted_value' => 'setAccountedValue',
        'opening_balance_differences' => 'setOpeningBalanceDifferences',
        'closing_balance_differences' => 'setClosingBalanceDifferences',
        'changes' => 'setChanges',
        'opening_balance_accounting_values' => 'setOpeningBalanceAccountingValues',
        'closing_balance_accounting_values' => 'setClosingBalanceAccountingValues',
        'generic_data_overviews' => 'setGenericDataOverviews'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'year_end_report' => 'getYearEndReport',
        'opening_balance_receivable_and_non_invoiced_revenue' => 'getOpeningBalanceReceivableAndNonInvoicedRevenue',
        'closing_balance_receivable_and_non_invoiced_revenue' => 'getClosingBalanceReceivableAndNonInvoicedRevenue',
        'opening_balance_ascertained_loss' => 'getOpeningBalanceAscertainedLoss',
        'closing_balance_ascertained_loss' => 'getClosingBalanceAscertainedLoss',
        'opening_balance_write_down' => 'getOpeningBalanceWriteDown',
        'closing_balance_write_down' => 'getClosingBalanceWriteDown',
        'sum_tax_value' => 'getSumTaxValue',
        'amount_to_be_posted_on_account' => 'getAmountToBePostedOnAccount',
        'accounted_value' => 'getAccountedValue',
        'opening_balance_differences' => 'getOpeningBalanceDifferences',
        'closing_balance_differences' => 'getClosingBalanceDifferences',
        'changes' => 'getChanges',
        'opening_balance_accounting_values' => 'getOpeningBalanceAccountingValues',
        'closing_balance_accounting_values' => 'getClosingBalanceAccountingValues',
        'generic_data_overviews' => 'getGenericDataOverviews'
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
        $this->setIfExists('year_end_report', $data ?? [], null);
        $this->setIfExists('opening_balance_receivable_and_non_invoiced_revenue', $data ?? [], null);
        $this->setIfExists('closing_balance_receivable_and_non_invoiced_revenue', $data ?? [], null);
        $this->setIfExists('opening_balance_ascertained_loss', $data ?? [], null);
        $this->setIfExists('closing_balance_ascertained_loss', $data ?? [], null);
        $this->setIfExists('opening_balance_write_down', $data ?? [], null);
        $this->setIfExists('closing_balance_write_down', $data ?? [], null);
        $this->setIfExists('sum_tax_value', $data ?? [], null);
        $this->setIfExists('amount_to_be_posted_on_account', $data ?? [], null);
        $this->setIfExists('accounted_value', $data ?? [], null);
        $this->setIfExists('opening_balance_differences', $data ?? [], null);
        $this->setIfExists('closing_balance_differences', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('opening_balance_accounting_values', $data ?? [], null);
        $this->setIfExists('closing_balance_accounting_values', $data ?? [], null);
        $this->setIfExists('generic_data_overviews', $data ?? [], null);
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
     * Gets year_end_report
     *
     * @return \Learnist\Tripletex\Model\YearEndReport|null
     */
    public function getYearEndReport()
    {
        return $this->container['year_end_report'];
    }

    /**
     * Sets year_end_report
     *
     * @param \Learnist\Tripletex\Model\YearEndReport|null $year_end_report year_end_report
     *
     * @return self
     */
    public function setYearEndReport($year_end_report)
    {

        if (is_null($year_end_report)) {
            throw new \InvalidArgumentException('non-nullable year_end_report cannot be null');
        }

        $this->container['year_end_report'] = $year_end_report;

        return $this;
    }

    /**
     * Gets opening_balance_receivable_and_non_invoiced_revenue
     *
     * @return float|null
     */
    public function getOpeningBalanceReceivableAndNonInvoicedRevenue()
    {
        return $this->container['opening_balance_receivable_and_non_invoiced_revenue'];
    }

    /**
     * Sets opening_balance_receivable_and_non_invoiced_revenue
     *
     * @param float|null $opening_balance_receivable_and_non_invoiced_revenue opening_balance_receivable_and_non_invoiced_revenue
     *
     * @return self
     */
    public function setOpeningBalanceReceivableAndNonInvoicedRevenue($opening_balance_receivable_and_non_invoiced_revenue)
    {

        if (is_null($opening_balance_receivable_and_non_invoiced_revenue)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_receivable_and_non_invoiced_revenue cannot be null');
        }

        $this->container['opening_balance_receivable_and_non_invoiced_revenue'] = $opening_balance_receivable_and_non_invoiced_revenue;

        return $this;
    }

    /**
     * Gets closing_balance_receivable_and_non_invoiced_revenue
     *
     * @return float|null
     */
    public function getClosingBalanceReceivableAndNonInvoicedRevenue()
    {
        return $this->container['closing_balance_receivable_and_non_invoiced_revenue'];
    }

    /**
     * Sets closing_balance_receivable_and_non_invoiced_revenue
     *
     * @param float|null $closing_balance_receivable_and_non_invoiced_revenue closing_balance_receivable_and_non_invoiced_revenue
     *
     * @return self
     */
    public function setClosingBalanceReceivableAndNonInvoicedRevenue($closing_balance_receivable_and_non_invoiced_revenue)
    {

        if (is_null($closing_balance_receivable_and_non_invoiced_revenue)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_receivable_and_non_invoiced_revenue cannot be null');
        }

        $this->container['closing_balance_receivable_and_non_invoiced_revenue'] = $closing_balance_receivable_and_non_invoiced_revenue;

        return $this;
    }

    /**
     * Gets opening_balance_ascertained_loss
     *
     * @return float|null
     */
    public function getOpeningBalanceAscertainedLoss()
    {
        return $this->container['opening_balance_ascertained_loss'];
    }

    /**
     * Sets opening_balance_ascertained_loss
     *
     * @param float|null $opening_balance_ascertained_loss opening_balance_ascertained_loss
     *
     * @return self
     */
    public function setOpeningBalanceAscertainedLoss($opening_balance_ascertained_loss)
    {

        if (is_null($opening_balance_ascertained_loss)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_ascertained_loss cannot be null');
        }

        $this->container['opening_balance_ascertained_loss'] = $opening_balance_ascertained_loss;

        return $this;
    }

    /**
     * Gets closing_balance_ascertained_loss
     *
     * @return float|null
     */
    public function getClosingBalanceAscertainedLoss()
    {
        return $this->container['closing_balance_ascertained_loss'];
    }

    /**
     * Sets closing_balance_ascertained_loss
     *
     * @param float|null $closing_balance_ascertained_loss closing_balance_ascertained_loss
     *
     * @return self
     */
    public function setClosingBalanceAscertainedLoss($closing_balance_ascertained_loss)
    {

        if (is_null($closing_balance_ascertained_loss)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_ascertained_loss cannot be null');
        }

        $this->container['closing_balance_ascertained_loss'] = $closing_balance_ascertained_loss;

        return $this;
    }

    /**
     * Gets opening_balance_write_down
     *
     * @return float|null
     */
    public function getOpeningBalanceWriteDown()
    {
        return $this->container['opening_balance_write_down'];
    }

    /**
     * Sets opening_balance_write_down
     *
     * @param float|null $opening_balance_write_down opening_balance_write_down
     *
     * @return self
     */
    public function setOpeningBalanceWriteDown($opening_balance_write_down)
    {

        if (is_null($opening_balance_write_down)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_write_down cannot be null');
        }

        $this->container['opening_balance_write_down'] = $opening_balance_write_down;

        return $this;
    }

    /**
     * Gets closing_balance_write_down
     *
     * @return float|null
     */
    public function getClosingBalanceWriteDown()
    {
        return $this->container['closing_balance_write_down'];
    }

    /**
     * Sets closing_balance_write_down
     *
     * @param float|null $closing_balance_write_down closing_balance_write_down
     *
     * @return self
     */
    public function setClosingBalanceWriteDown($closing_balance_write_down)
    {

        if (is_null($closing_balance_write_down)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_write_down cannot be null');
        }

        $this->container['closing_balance_write_down'] = $closing_balance_write_down;

        return $this;
    }

    /**
     * Gets sum_tax_value
     *
     * @return float|null
     */
    public function getSumTaxValue()
    {
        return $this->container['sum_tax_value'];
    }

    /**
     * Sets sum_tax_value
     *
     * @param float|null $sum_tax_value sum_tax_value
     *
     * @return self
     */
    public function setSumTaxValue($sum_tax_value)
    {

        if (is_null($sum_tax_value)) {
            throw new \InvalidArgumentException('non-nullable sum_tax_value cannot be null');
        }

        $this->container['sum_tax_value'] = $sum_tax_value;

        return $this;
    }

    /**
     * Gets amount_to_be_posted_on_account
     *
     * @return float|null
     */
    public function getAmountToBePostedOnAccount()
    {
        return $this->container['amount_to_be_posted_on_account'];
    }

    /**
     * Sets amount_to_be_posted_on_account
     *
     * @param float|null $amount_to_be_posted_on_account amount_to_be_posted_on_account
     *
     * @return self
     */
    public function setAmountToBePostedOnAccount($amount_to_be_posted_on_account)
    {

        if (is_null($amount_to_be_posted_on_account)) {
            throw new \InvalidArgumentException('non-nullable amount_to_be_posted_on_account cannot be null');
        }

        $this->container['amount_to_be_posted_on_account'] = $amount_to_be_posted_on_account;

        return $this;
    }

    /**
     * Gets accounted_value
     *
     * @return float|null
     */
    public function getAccountedValue()
    {
        return $this->container['accounted_value'];
    }

    /**
     * Sets accounted_value
     *
     * @param float|null $accounted_value accounted_value
     *
     * @return self
     */
    public function setAccountedValue($accounted_value)
    {

        if (is_null($accounted_value)) {
            throw new \InvalidArgumentException('non-nullable accounted_value cannot be null');
        }

        $this->container['accounted_value'] = $accounted_value;

        return $this;
    }

    /**
     * Gets opening_balance_differences
     *
     * @return float|null
     */
    public function getOpeningBalanceDifferences()
    {
        return $this->container['opening_balance_differences'];
    }

    /**
     * Sets opening_balance_differences
     *
     * @param float|null $opening_balance_differences opening_balance_differences
     *
     * @return self
     */
    public function setOpeningBalanceDifferences($opening_balance_differences)
    {

        if (is_null($opening_balance_differences)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_differences cannot be null');
        }

        $this->container['opening_balance_differences'] = $opening_balance_differences;

        return $this;
    }

    /**
     * Gets closing_balance_differences
     *
     * @return float|null
     */
    public function getClosingBalanceDifferences()
    {
        return $this->container['closing_balance_differences'];
    }

    /**
     * Sets closing_balance_differences
     *
     * @param float|null $closing_balance_differences closing_balance_differences
     *
     * @return self
     */
    public function setClosingBalanceDifferences($closing_balance_differences)
    {

        if (is_null($closing_balance_differences)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_differences cannot be null');
        }

        $this->container['closing_balance_differences'] = $closing_balance_differences;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return float|null
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param float|null $changes changes
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
     * Gets opening_balance_accounting_values
     *
     * @return float|null
     */
    public function getOpeningBalanceAccountingValues()
    {
        return $this->container['opening_balance_accounting_values'];
    }

    /**
     * Sets opening_balance_accounting_values
     *
     * @param float|null $opening_balance_accounting_values opening_balance_accounting_values
     *
     * @return self
     */
    public function setOpeningBalanceAccountingValues($opening_balance_accounting_values)
    {

        if (is_null($opening_balance_accounting_values)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_accounting_values cannot be null');
        }

        $this->container['opening_balance_accounting_values'] = $opening_balance_accounting_values;

        return $this;
    }

    /**
     * Gets closing_balance_accounting_values
     *
     * @return float|null
     */
    public function getClosingBalanceAccountingValues()
    {
        return $this->container['closing_balance_accounting_values'];
    }

    /**
     * Sets closing_balance_accounting_values
     *
     * @param float|null $closing_balance_accounting_values closing_balance_accounting_values
     *
     * @return self
     */
    public function setClosingBalanceAccountingValues($closing_balance_accounting_values)
    {

        if (is_null($closing_balance_accounting_values)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_accounting_values cannot be null');
        }

        $this->container['closing_balance_accounting_values'] = $closing_balance_accounting_values;

        return $this;
    }

    /**
     * Gets generic_data_overviews
     *
     * @return \Learnist\Tripletex\Model\GenericDataOverview[]|null
     */
    public function getGenericDataOverviews()
    {
        return $this->container['generic_data_overviews'];
    }

    /**
     * Sets generic_data_overviews
     *
     * @param \Learnist\Tripletex\Model\GenericDataOverview[]|null $generic_data_overviews generic_data_overviews
     *
     * @return self
     */
    public function setGenericDataOverviews($generic_data_overviews)
    {

        if (is_null($generic_data_overviews)) {
            throw new \InvalidArgumentException('non-nullable generic_data_overviews cannot be null');
        }

        $this->container['generic_data_overviews'] = $generic_data_overviews;

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


