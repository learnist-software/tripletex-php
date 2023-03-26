<?php
/**
 * CustomerReceivable
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
 * CustomerReceivable Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CustomerReceivable implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'CustomerReceivable';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'generic_data_overviews' => '\Learnist\Tripletex\Model\GenericDataOverview[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'generic_data_overviews' => null    ];

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
'generic_data_overviews' => 'genericDataOverviews'    ];

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
'generic_data_overviews' => 'setGenericDataOverviews'    ];

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
'generic_data_overviews' => 'getGenericDataOverviews'    ];

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
        $this->container['year_end_report'] = isset($data['year_end_report']) ? $data['year_end_report'] : null;
        $this->container['opening_balance_receivable_and_non_invoiced_revenue'] = isset($data['opening_balance_receivable_and_non_invoiced_revenue']) ? $data['opening_balance_receivable_and_non_invoiced_revenue'] : null;
        $this->container['closing_balance_receivable_and_non_invoiced_revenue'] = isset($data['closing_balance_receivable_and_non_invoiced_revenue']) ? $data['closing_balance_receivable_and_non_invoiced_revenue'] : null;
        $this->container['opening_balance_ascertained_loss'] = isset($data['opening_balance_ascertained_loss']) ? $data['opening_balance_ascertained_loss'] : null;
        $this->container['closing_balance_ascertained_loss'] = isset($data['closing_balance_ascertained_loss']) ? $data['closing_balance_ascertained_loss'] : null;
        $this->container['opening_balance_write_down'] = isset($data['opening_balance_write_down']) ? $data['opening_balance_write_down'] : null;
        $this->container['closing_balance_write_down'] = isset($data['closing_balance_write_down']) ? $data['closing_balance_write_down'] : null;
        $this->container['sum_tax_value'] = isset($data['sum_tax_value']) ? $data['sum_tax_value'] : null;
        $this->container['amount_to_be_posted_on_account'] = isset($data['amount_to_be_posted_on_account']) ? $data['amount_to_be_posted_on_account'] : null;
        $this->container['accounted_value'] = isset($data['accounted_value']) ? $data['accounted_value'] : null;
        $this->container['opening_balance_differences'] = isset($data['opening_balance_differences']) ? $data['opening_balance_differences'] : null;
        $this->container['closing_balance_differences'] = isset($data['closing_balance_differences']) ? $data['closing_balance_differences'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['opening_balance_accounting_values'] = isset($data['opening_balance_accounting_values']) ? $data['opening_balance_accounting_values'] : null;
        $this->container['closing_balance_accounting_values'] = isset($data['closing_balance_accounting_values']) ? $data['closing_balance_accounting_values'] : null;
        $this->container['generic_data_overviews'] = isset($data['generic_data_overviews']) ? $data['generic_data_overviews'] : null;
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
     * @return \Learnist\Tripletex\Model\YearEndReport
     */
    public function getYearEndReport()
    {
        return $this->container['year_end_report'];
    }

    /**
     * Sets year_end_report
     *
     * @param \Learnist\Tripletex\Model\YearEndReport $year_end_report year_end_report
     *
     * @return $this
     */
    public function setYearEndReport($year_end_report)
    {
        $this->container['year_end_report'] = $year_end_report;

        return $this;
    }

    /**
     * Gets opening_balance_receivable_and_non_invoiced_revenue
     *
     * @return float
     */
    public function getOpeningBalanceReceivableAndNonInvoicedRevenue()
    {
        return $this->container['opening_balance_receivable_and_non_invoiced_revenue'];
    }

    /**
     * Sets opening_balance_receivable_and_non_invoiced_revenue
     *
     * @param float $opening_balance_receivable_and_non_invoiced_revenue opening_balance_receivable_and_non_invoiced_revenue
     *
     * @return $this
     */
    public function setOpeningBalanceReceivableAndNonInvoicedRevenue($opening_balance_receivable_and_non_invoiced_revenue)
    {
        $this->container['opening_balance_receivable_and_non_invoiced_revenue'] = $opening_balance_receivable_and_non_invoiced_revenue;

        return $this;
    }

    /**
     * Gets closing_balance_receivable_and_non_invoiced_revenue
     *
     * @return float
     */
    public function getClosingBalanceReceivableAndNonInvoicedRevenue()
    {
        return $this->container['closing_balance_receivable_and_non_invoiced_revenue'];
    }

    /**
     * Sets closing_balance_receivable_and_non_invoiced_revenue
     *
     * @param float $closing_balance_receivable_and_non_invoiced_revenue closing_balance_receivable_and_non_invoiced_revenue
     *
     * @return $this
     */
    public function setClosingBalanceReceivableAndNonInvoicedRevenue($closing_balance_receivable_and_non_invoiced_revenue)
    {
        $this->container['closing_balance_receivable_and_non_invoiced_revenue'] = $closing_balance_receivable_and_non_invoiced_revenue;

        return $this;
    }

    /**
     * Gets opening_balance_ascertained_loss
     *
     * @return float
     */
    public function getOpeningBalanceAscertainedLoss()
    {
        return $this->container['opening_balance_ascertained_loss'];
    }

    /**
     * Sets opening_balance_ascertained_loss
     *
     * @param float $opening_balance_ascertained_loss opening_balance_ascertained_loss
     *
     * @return $this
     */
    public function setOpeningBalanceAscertainedLoss($opening_balance_ascertained_loss)
    {
        $this->container['opening_balance_ascertained_loss'] = $opening_balance_ascertained_loss;

        return $this;
    }

    /**
     * Gets closing_balance_ascertained_loss
     *
     * @return float
     */
    public function getClosingBalanceAscertainedLoss()
    {
        return $this->container['closing_balance_ascertained_loss'];
    }

    /**
     * Sets closing_balance_ascertained_loss
     *
     * @param float $closing_balance_ascertained_loss closing_balance_ascertained_loss
     *
     * @return $this
     */
    public function setClosingBalanceAscertainedLoss($closing_balance_ascertained_loss)
    {
        $this->container['closing_balance_ascertained_loss'] = $closing_balance_ascertained_loss;

        return $this;
    }

    /**
     * Gets opening_balance_write_down
     *
     * @return float
     */
    public function getOpeningBalanceWriteDown()
    {
        return $this->container['opening_balance_write_down'];
    }

    /**
     * Sets opening_balance_write_down
     *
     * @param float $opening_balance_write_down opening_balance_write_down
     *
     * @return $this
     */
    public function setOpeningBalanceWriteDown($opening_balance_write_down)
    {
        $this->container['opening_balance_write_down'] = $opening_balance_write_down;

        return $this;
    }

    /**
     * Gets closing_balance_write_down
     *
     * @return float
     */
    public function getClosingBalanceWriteDown()
    {
        return $this->container['closing_balance_write_down'];
    }

    /**
     * Sets closing_balance_write_down
     *
     * @param float $closing_balance_write_down closing_balance_write_down
     *
     * @return $this
     */
    public function setClosingBalanceWriteDown($closing_balance_write_down)
    {
        $this->container['closing_balance_write_down'] = $closing_balance_write_down;

        return $this;
    }

    /**
     * Gets sum_tax_value
     *
     * @return float
     */
    public function getSumTaxValue()
    {
        return $this->container['sum_tax_value'];
    }

    /**
     * Sets sum_tax_value
     *
     * @param float $sum_tax_value sum_tax_value
     *
     * @return $this
     */
    public function setSumTaxValue($sum_tax_value)
    {
        $this->container['sum_tax_value'] = $sum_tax_value;

        return $this;
    }

    /**
     * Gets amount_to_be_posted_on_account
     *
     * @return float
     */
    public function getAmountToBePostedOnAccount()
    {
        return $this->container['amount_to_be_posted_on_account'];
    }

    /**
     * Sets amount_to_be_posted_on_account
     *
     * @param float $amount_to_be_posted_on_account amount_to_be_posted_on_account
     *
     * @return $this
     */
    public function setAmountToBePostedOnAccount($amount_to_be_posted_on_account)
    {
        $this->container['amount_to_be_posted_on_account'] = $amount_to_be_posted_on_account;

        return $this;
    }

    /**
     * Gets accounted_value
     *
     * @return float
     */
    public function getAccountedValue()
    {
        return $this->container['accounted_value'];
    }

    /**
     * Sets accounted_value
     *
     * @param float $accounted_value accounted_value
     *
     * @return $this
     */
    public function setAccountedValue($accounted_value)
    {
        $this->container['accounted_value'] = $accounted_value;

        return $this;
    }

    /**
     * Gets opening_balance_differences
     *
     * @return float
     */
    public function getOpeningBalanceDifferences()
    {
        return $this->container['opening_balance_differences'];
    }

    /**
     * Sets opening_balance_differences
     *
     * @param float $opening_balance_differences opening_balance_differences
     *
     * @return $this
     */
    public function setOpeningBalanceDifferences($opening_balance_differences)
    {
        $this->container['opening_balance_differences'] = $opening_balance_differences;

        return $this;
    }

    /**
     * Gets closing_balance_differences
     *
     * @return float
     */
    public function getClosingBalanceDifferences()
    {
        return $this->container['closing_balance_differences'];
    }

    /**
     * Sets closing_balance_differences
     *
     * @param float $closing_balance_differences closing_balance_differences
     *
     * @return $this
     */
    public function setClosingBalanceDifferences($closing_balance_differences)
    {
        $this->container['closing_balance_differences'] = $closing_balance_differences;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return float
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param float $changes changes
     *
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets opening_balance_accounting_values
     *
     * @return float
     */
    public function getOpeningBalanceAccountingValues()
    {
        return $this->container['opening_balance_accounting_values'];
    }

    /**
     * Sets opening_balance_accounting_values
     *
     * @param float $opening_balance_accounting_values opening_balance_accounting_values
     *
     * @return $this
     */
    public function setOpeningBalanceAccountingValues($opening_balance_accounting_values)
    {
        $this->container['opening_balance_accounting_values'] = $opening_balance_accounting_values;

        return $this;
    }

    /**
     * Gets closing_balance_accounting_values
     *
     * @return float
     */
    public function getClosingBalanceAccountingValues()
    {
        return $this->container['closing_balance_accounting_values'];
    }

    /**
     * Sets closing_balance_accounting_values
     *
     * @param float $closing_balance_accounting_values closing_balance_accounting_values
     *
     * @return $this
     */
    public function setClosingBalanceAccountingValues($closing_balance_accounting_values)
    {
        $this->container['closing_balance_accounting_values'] = $closing_balance_accounting_values;

        return $this;
    }

    /**
     * Gets generic_data_overviews
     *
     * @return \Learnist\Tripletex\Model\GenericDataOverview[]
     */
    public function getGenericDataOverviews()
    {
        return $this->container['generic_data_overviews'];
    }

    /**
     * Sets generic_data_overviews
     *
     * @param \Learnist\Tripletex\Model\GenericDataOverview[] $generic_data_overviews generic_data_overviews
     *
     * @return $this
     */
    public function setGenericDataOverviews($generic_data_overviews)
    {
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
