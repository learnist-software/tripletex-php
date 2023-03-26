<?php
/**
 * TaxCalculation
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
 * TaxCalculation Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TaxCalculation implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TaxCalculation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'object_identifier' => 'float',
        'taxable_profit' => 'float',
        'accumulated_loss' => 'float',
        'tax_rate_this_year' => 'float',
        'tax_rate_next_year' => 'float',
        'tax_calculated' => 'float',
        'tax_posted' => 'float',
        'tax_diff' => 'float',
        'too_little_tax_set_aside' => 'float',
        'too_much_tax_set_aside' => 'float',
        'total_tax_set_aside' => 'float',
        'basis_deffered_tax' => 'float',
        'basis_deffered_tax_assets' => 'float',
        'deferred_tax_opening_balance' => 'float',
        'deferred_tax_assets_opening_balance' => 'float',
        'deferred_tax_closing_balance' => 'float',
        'deferred_tax_assets_closing_balance' => 'float',
        'calculated_deferred_tax' => 'float',
        'calculated_deferred_tax_assets' => 'float',
        'increased_deferred_tax' => 'float',
        'decreased_deferred_tax' => 'float',
        'increased_deferred_tax_assets' => 'float',
        'decreased_deferred_tax_assets' => 'float',
        'deferred_tax_to_be_posted' => 'float',
        'deferred_tax_assets_to_be_posted' => 'float',
        'total_tax_to_set_asside' => 'float',
        'total_additions' => 'float',
        'total_deductions' => 'float',
        'total_basis' => 'float'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'object_identifier' => null,
        'taxable_profit' => null,
        'accumulated_loss' => null,
        'tax_rate_this_year' => null,
        'tax_rate_next_year' => null,
        'tax_calculated' => null,
        'tax_posted' => null,
        'tax_diff' => null,
        'too_little_tax_set_aside' => null,
        'too_much_tax_set_aside' => null,
        'total_tax_set_aside' => null,
        'basis_deffered_tax' => null,
        'basis_deffered_tax_assets' => null,
        'deferred_tax_opening_balance' => null,
        'deferred_tax_assets_opening_balance' => null,
        'deferred_tax_closing_balance' => null,
        'deferred_tax_assets_closing_balance' => null,
        'calculated_deferred_tax' => null,
        'calculated_deferred_tax_assets' => null,
        'increased_deferred_tax' => null,
        'decreased_deferred_tax' => null,
        'increased_deferred_tax_assets' => null,
        'decreased_deferred_tax_assets' => null,
        'deferred_tax_to_be_posted' => null,
        'deferred_tax_assets_to_be_posted' => null,
        'total_tax_to_set_asside' => null,
        'total_additions' => null,
        'total_deductions' => null,
        'total_basis' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'object_identifier' => false,
		'taxable_profit' => false,
		'accumulated_loss' => false,
		'tax_rate_this_year' => false,
		'tax_rate_next_year' => false,
		'tax_calculated' => false,
		'tax_posted' => false,
		'tax_diff' => false,
		'too_little_tax_set_aside' => false,
		'too_much_tax_set_aside' => false,
		'total_tax_set_aside' => false,
		'basis_deffered_tax' => false,
		'basis_deffered_tax_assets' => false,
		'deferred_tax_opening_balance' => false,
		'deferred_tax_assets_opening_balance' => false,
		'deferred_tax_closing_balance' => false,
		'deferred_tax_assets_closing_balance' => false,
		'calculated_deferred_tax' => false,
		'calculated_deferred_tax_assets' => false,
		'increased_deferred_tax' => false,
		'decreased_deferred_tax' => false,
		'increased_deferred_tax_assets' => false,
		'decreased_deferred_tax_assets' => false,
		'deferred_tax_to_be_posted' => false,
		'deferred_tax_assets_to_be_posted' => false,
		'total_tax_to_set_asside' => false,
		'total_additions' => false,
		'total_deductions' => false,
		'total_basis' => false
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
        'object_identifier' => 'objectIdentifier',
        'taxable_profit' => 'taxableProfit',
        'accumulated_loss' => 'accumulatedLoss',
        'tax_rate_this_year' => 'taxRateThisYear',
        'tax_rate_next_year' => 'taxRateNextYear',
        'tax_calculated' => 'taxCalculated',
        'tax_posted' => 'taxPosted',
        'tax_diff' => 'taxDiff',
        'too_little_tax_set_aside' => 'tooLittleTaxSetAside',
        'too_much_tax_set_aside' => 'tooMuchTaxSetAside',
        'total_tax_set_aside' => 'totalTaxSetAside',
        'basis_deffered_tax' => 'basisDefferedTax',
        'basis_deffered_tax_assets' => 'basisDefferedTaxAssets',
        'deferred_tax_opening_balance' => 'deferredTaxOpeningBalance',
        'deferred_tax_assets_opening_balance' => 'deferredTaxAssetsOpeningBalance',
        'deferred_tax_closing_balance' => 'deferredTaxClosingBalance',
        'deferred_tax_assets_closing_balance' => 'deferredTaxAssetsClosingBalance',
        'calculated_deferred_tax' => 'calculatedDeferredTax',
        'calculated_deferred_tax_assets' => 'calculatedDeferredTaxAssets',
        'increased_deferred_tax' => 'increasedDeferredTax',
        'decreased_deferred_tax' => 'decreasedDeferredTax',
        'increased_deferred_tax_assets' => 'increasedDeferredTaxAssets',
        'decreased_deferred_tax_assets' => 'decreasedDeferredTaxAssets',
        'deferred_tax_to_be_posted' => 'deferredTaxToBePosted',
        'deferred_tax_assets_to_be_posted' => 'deferredTaxAssetsToBePosted',
        'total_tax_to_set_asside' => 'totalTaxToSetAsside',
        'total_additions' => 'totalAdditions',
        'total_deductions' => 'totalDeductions',
        'total_basis' => 'totalBasis'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'object_identifier' => 'setObjectIdentifier',
        'taxable_profit' => 'setTaxableProfit',
        'accumulated_loss' => 'setAccumulatedLoss',
        'tax_rate_this_year' => 'setTaxRateThisYear',
        'tax_rate_next_year' => 'setTaxRateNextYear',
        'tax_calculated' => 'setTaxCalculated',
        'tax_posted' => 'setTaxPosted',
        'tax_diff' => 'setTaxDiff',
        'too_little_tax_set_aside' => 'setTooLittleTaxSetAside',
        'too_much_tax_set_aside' => 'setTooMuchTaxSetAside',
        'total_tax_set_aside' => 'setTotalTaxSetAside',
        'basis_deffered_tax' => 'setBasisDefferedTax',
        'basis_deffered_tax_assets' => 'setBasisDefferedTaxAssets',
        'deferred_tax_opening_balance' => 'setDeferredTaxOpeningBalance',
        'deferred_tax_assets_opening_balance' => 'setDeferredTaxAssetsOpeningBalance',
        'deferred_tax_closing_balance' => 'setDeferredTaxClosingBalance',
        'deferred_tax_assets_closing_balance' => 'setDeferredTaxAssetsClosingBalance',
        'calculated_deferred_tax' => 'setCalculatedDeferredTax',
        'calculated_deferred_tax_assets' => 'setCalculatedDeferredTaxAssets',
        'increased_deferred_tax' => 'setIncreasedDeferredTax',
        'decreased_deferred_tax' => 'setDecreasedDeferredTax',
        'increased_deferred_tax_assets' => 'setIncreasedDeferredTaxAssets',
        'decreased_deferred_tax_assets' => 'setDecreasedDeferredTaxAssets',
        'deferred_tax_to_be_posted' => 'setDeferredTaxToBePosted',
        'deferred_tax_assets_to_be_posted' => 'setDeferredTaxAssetsToBePosted',
        'total_tax_to_set_asside' => 'setTotalTaxToSetAsside',
        'total_additions' => 'setTotalAdditions',
        'total_deductions' => 'setTotalDeductions',
        'total_basis' => 'setTotalBasis'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'object_identifier' => 'getObjectIdentifier',
        'taxable_profit' => 'getTaxableProfit',
        'accumulated_loss' => 'getAccumulatedLoss',
        'tax_rate_this_year' => 'getTaxRateThisYear',
        'tax_rate_next_year' => 'getTaxRateNextYear',
        'tax_calculated' => 'getTaxCalculated',
        'tax_posted' => 'getTaxPosted',
        'tax_diff' => 'getTaxDiff',
        'too_little_tax_set_aside' => 'getTooLittleTaxSetAside',
        'too_much_tax_set_aside' => 'getTooMuchTaxSetAside',
        'total_tax_set_aside' => 'getTotalTaxSetAside',
        'basis_deffered_tax' => 'getBasisDefferedTax',
        'basis_deffered_tax_assets' => 'getBasisDefferedTaxAssets',
        'deferred_tax_opening_balance' => 'getDeferredTaxOpeningBalance',
        'deferred_tax_assets_opening_balance' => 'getDeferredTaxAssetsOpeningBalance',
        'deferred_tax_closing_balance' => 'getDeferredTaxClosingBalance',
        'deferred_tax_assets_closing_balance' => 'getDeferredTaxAssetsClosingBalance',
        'calculated_deferred_tax' => 'getCalculatedDeferredTax',
        'calculated_deferred_tax_assets' => 'getCalculatedDeferredTaxAssets',
        'increased_deferred_tax' => 'getIncreasedDeferredTax',
        'decreased_deferred_tax' => 'getDecreasedDeferredTax',
        'increased_deferred_tax_assets' => 'getIncreasedDeferredTaxAssets',
        'decreased_deferred_tax_assets' => 'getDecreasedDeferredTaxAssets',
        'deferred_tax_to_be_posted' => 'getDeferredTaxToBePosted',
        'deferred_tax_assets_to_be_posted' => 'getDeferredTaxAssetsToBePosted',
        'total_tax_to_set_asside' => 'getTotalTaxToSetAsside',
        'total_additions' => 'getTotalAdditions',
        'total_deductions' => 'getTotalDeductions',
        'total_basis' => 'getTotalBasis'
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
        $this->setIfExists('object_identifier', $data ?? [], null);
        $this->setIfExists('taxable_profit', $data ?? [], null);
        $this->setIfExists('accumulated_loss', $data ?? [], null);
        $this->setIfExists('tax_rate_this_year', $data ?? [], null);
        $this->setIfExists('tax_rate_next_year', $data ?? [], null);
        $this->setIfExists('tax_calculated', $data ?? [], null);
        $this->setIfExists('tax_posted', $data ?? [], null);
        $this->setIfExists('tax_diff', $data ?? [], null);
        $this->setIfExists('too_little_tax_set_aside', $data ?? [], null);
        $this->setIfExists('too_much_tax_set_aside', $data ?? [], null);
        $this->setIfExists('total_tax_set_aside', $data ?? [], null);
        $this->setIfExists('basis_deffered_tax', $data ?? [], null);
        $this->setIfExists('basis_deffered_tax_assets', $data ?? [], null);
        $this->setIfExists('deferred_tax_opening_balance', $data ?? [], null);
        $this->setIfExists('deferred_tax_assets_opening_balance', $data ?? [], null);
        $this->setIfExists('deferred_tax_closing_balance', $data ?? [], null);
        $this->setIfExists('deferred_tax_assets_closing_balance', $data ?? [], null);
        $this->setIfExists('calculated_deferred_tax', $data ?? [], null);
        $this->setIfExists('calculated_deferred_tax_assets', $data ?? [], null);
        $this->setIfExists('increased_deferred_tax', $data ?? [], null);
        $this->setIfExists('decreased_deferred_tax', $data ?? [], null);
        $this->setIfExists('increased_deferred_tax_assets', $data ?? [], null);
        $this->setIfExists('decreased_deferred_tax_assets', $data ?? [], null);
        $this->setIfExists('deferred_tax_to_be_posted', $data ?? [], null);
        $this->setIfExists('deferred_tax_assets_to_be_posted', $data ?? [], null);
        $this->setIfExists('total_tax_to_set_asside', $data ?? [], null);
        $this->setIfExists('total_additions', $data ?? [], null);
        $this->setIfExists('total_deductions', $data ?? [], null);
        $this->setIfExists('total_basis', $data ?? [], null);
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
     * Gets object_identifier
     *
     * @return float|null
     */
    public function getObjectIdentifier()
    {
        return $this->container['object_identifier'];
    }

    /**
     * Sets object_identifier
     *
     * @param float|null $object_identifier object_identifier
     *
     * @return self
     */
    public function setObjectIdentifier($object_identifier)
    {

        if (is_null($object_identifier)) {
            throw new \InvalidArgumentException('non-nullable object_identifier cannot be null');
        }

        $this->container['object_identifier'] = $object_identifier;

        return $this;
    }

    /**
     * Gets taxable_profit
     *
     * @return float|null
     */
    public function getTaxableProfit()
    {
        return $this->container['taxable_profit'];
    }

    /**
     * Sets taxable_profit
     *
     * @param float|null $taxable_profit taxable_profit
     *
     * @return self
     */
    public function setTaxableProfit($taxable_profit)
    {

        if (is_null($taxable_profit)) {
            throw new \InvalidArgumentException('non-nullable taxable_profit cannot be null');
        }

        $this->container['taxable_profit'] = $taxable_profit;

        return $this;
    }

    /**
     * Gets accumulated_loss
     *
     * @return float|null
     */
    public function getAccumulatedLoss()
    {
        return $this->container['accumulated_loss'];
    }

    /**
     * Sets accumulated_loss
     *
     * @param float|null $accumulated_loss accumulated_loss
     *
     * @return self
     */
    public function setAccumulatedLoss($accumulated_loss)
    {

        if (is_null($accumulated_loss)) {
            throw new \InvalidArgumentException('non-nullable accumulated_loss cannot be null');
        }

        $this->container['accumulated_loss'] = $accumulated_loss;

        return $this;
    }

    /**
     * Gets tax_rate_this_year
     *
     * @return float|null
     */
    public function getTaxRateThisYear()
    {
        return $this->container['tax_rate_this_year'];
    }

    /**
     * Sets tax_rate_this_year
     *
     * @param float|null $tax_rate_this_year tax_rate_this_year
     *
     * @return self
     */
    public function setTaxRateThisYear($tax_rate_this_year)
    {

        if (is_null($tax_rate_this_year)) {
            throw new \InvalidArgumentException('non-nullable tax_rate_this_year cannot be null');
        }

        $this->container['tax_rate_this_year'] = $tax_rate_this_year;

        return $this;
    }

    /**
     * Gets tax_rate_next_year
     *
     * @return float|null
     */
    public function getTaxRateNextYear()
    {
        return $this->container['tax_rate_next_year'];
    }

    /**
     * Sets tax_rate_next_year
     *
     * @param float|null $tax_rate_next_year tax_rate_next_year
     *
     * @return self
     */
    public function setTaxRateNextYear($tax_rate_next_year)
    {

        if (is_null($tax_rate_next_year)) {
            throw new \InvalidArgumentException('non-nullable tax_rate_next_year cannot be null');
        }

        $this->container['tax_rate_next_year'] = $tax_rate_next_year;

        return $this;
    }

    /**
     * Gets tax_calculated
     *
     * @return float|null
     */
    public function getTaxCalculated()
    {
        return $this->container['tax_calculated'];
    }

    /**
     * Sets tax_calculated
     *
     * @param float|null $tax_calculated tax_calculated
     *
     * @return self
     */
    public function setTaxCalculated($tax_calculated)
    {

        if (is_null($tax_calculated)) {
            throw new \InvalidArgumentException('non-nullable tax_calculated cannot be null');
        }

        $this->container['tax_calculated'] = $tax_calculated;

        return $this;
    }

    /**
     * Gets tax_posted
     *
     * @return float|null
     */
    public function getTaxPosted()
    {
        return $this->container['tax_posted'];
    }

    /**
     * Sets tax_posted
     *
     * @param float|null $tax_posted tax_posted
     *
     * @return self
     */
    public function setTaxPosted($tax_posted)
    {

        if (is_null($tax_posted)) {
            throw new \InvalidArgumentException('non-nullable tax_posted cannot be null');
        }

        $this->container['tax_posted'] = $tax_posted;

        return $this;
    }

    /**
     * Gets tax_diff
     *
     * @return float|null
     */
    public function getTaxDiff()
    {
        return $this->container['tax_diff'];
    }

    /**
     * Sets tax_diff
     *
     * @param float|null $tax_diff tax_diff
     *
     * @return self
     */
    public function setTaxDiff($tax_diff)
    {

        if (is_null($tax_diff)) {
            throw new \InvalidArgumentException('non-nullable tax_diff cannot be null');
        }

        $this->container['tax_diff'] = $tax_diff;

        return $this;
    }

    /**
     * Gets too_little_tax_set_aside
     *
     * @return float|null
     */
    public function getTooLittleTaxSetAside()
    {
        return $this->container['too_little_tax_set_aside'];
    }

    /**
     * Sets too_little_tax_set_aside
     *
     * @param float|null $too_little_tax_set_aside too_little_tax_set_aside
     *
     * @return self
     */
    public function setTooLittleTaxSetAside($too_little_tax_set_aside)
    {

        if (is_null($too_little_tax_set_aside)) {
            throw new \InvalidArgumentException('non-nullable too_little_tax_set_aside cannot be null');
        }

        $this->container['too_little_tax_set_aside'] = $too_little_tax_set_aside;

        return $this;
    }

    /**
     * Gets too_much_tax_set_aside
     *
     * @return float|null
     */
    public function getTooMuchTaxSetAside()
    {
        return $this->container['too_much_tax_set_aside'];
    }

    /**
     * Sets too_much_tax_set_aside
     *
     * @param float|null $too_much_tax_set_aside too_much_tax_set_aside
     *
     * @return self
     */
    public function setTooMuchTaxSetAside($too_much_tax_set_aside)
    {

        if (is_null($too_much_tax_set_aside)) {
            throw new \InvalidArgumentException('non-nullable too_much_tax_set_aside cannot be null');
        }

        $this->container['too_much_tax_set_aside'] = $too_much_tax_set_aside;

        return $this;
    }

    /**
     * Gets total_tax_set_aside
     *
     * @return float|null
     */
    public function getTotalTaxSetAside()
    {
        return $this->container['total_tax_set_aside'];
    }

    /**
     * Sets total_tax_set_aside
     *
     * @param float|null $total_tax_set_aside total_tax_set_aside
     *
     * @return self
     */
    public function setTotalTaxSetAside($total_tax_set_aside)
    {

        if (is_null($total_tax_set_aside)) {
            throw new \InvalidArgumentException('non-nullable total_tax_set_aside cannot be null');
        }

        $this->container['total_tax_set_aside'] = $total_tax_set_aside;

        return $this;
    }

    /**
     * Gets basis_deffered_tax
     *
     * @return float|null
     */
    public function getBasisDefferedTax()
    {
        return $this->container['basis_deffered_tax'];
    }

    /**
     * Sets basis_deffered_tax
     *
     * @param float|null $basis_deffered_tax basis_deffered_tax
     *
     * @return self
     */
    public function setBasisDefferedTax($basis_deffered_tax)
    {

        if (is_null($basis_deffered_tax)) {
            throw new \InvalidArgumentException('non-nullable basis_deffered_tax cannot be null');
        }

        $this->container['basis_deffered_tax'] = $basis_deffered_tax;

        return $this;
    }

    /**
     * Gets basis_deffered_tax_assets
     *
     * @return float|null
     */
    public function getBasisDefferedTaxAssets()
    {
        return $this->container['basis_deffered_tax_assets'];
    }

    /**
     * Sets basis_deffered_tax_assets
     *
     * @param float|null $basis_deffered_tax_assets basis_deffered_tax_assets
     *
     * @return self
     */
    public function setBasisDefferedTaxAssets($basis_deffered_tax_assets)
    {

        if (is_null($basis_deffered_tax_assets)) {
            throw new \InvalidArgumentException('non-nullable basis_deffered_tax_assets cannot be null');
        }

        $this->container['basis_deffered_tax_assets'] = $basis_deffered_tax_assets;

        return $this;
    }

    /**
     * Gets deferred_tax_opening_balance
     *
     * @return float|null
     */
    public function getDeferredTaxOpeningBalance()
    {
        return $this->container['deferred_tax_opening_balance'];
    }

    /**
     * Sets deferred_tax_opening_balance
     *
     * @param float|null $deferred_tax_opening_balance deferred_tax_opening_balance
     *
     * @return self
     */
    public function setDeferredTaxOpeningBalance($deferred_tax_opening_balance)
    {

        if (is_null($deferred_tax_opening_balance)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_opening_balance cannot be null');
        }

        $this->container['deferred_tax_opening_balance'] = $deferred_tax_opening_balance;

        return $this;
    }

    /**
     * Gets deferred_tax_assets_opening_balance
     *
     * @return float|null
     */
    public function getDeferredTaxAssetsOpeningBalance()
    {
        return $this->container['deferred_tax_assets_opening_balance'];
    }

    /**
     * Sets deferred_tax_assets_opening_balance
     *
     * @param float|null $deferred_tax_assets_opening_balance deferred_tax_assets_opening_balance
     *
     * @return self
     */
    public function setDeferredTaxAssetsOpeningBalance($deferred_tax_assets_opening_balance)
    {

        if (is_null($deferred_tax_assets_opening_balance)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_assets_opening_balance cannot be null');
        }

        $this->container['deferred_tax_assets_opening_balance'] = $deferred_tax_assets_opening_balance;

        return $this;
    }

    /**
     * Gets deferred_tax_closing_balance
     *
     * @return float|null
     */
    public function getDeferredTaxClosingBalance()
    {
        return $this->container['deferred_tax_closing_balance'];
    }

    /**
     * Sets deferred_tax_closing_balance
     *
     * @param float|null $deferred_tax_closing_balance deferred_tax_closing_balance
     *
     * @return self
     */
    public function setDeferredTaxClosingBalance($deferred_tax_closing_balance)
    {

        if (is_null($deferred_tax_closing_balance)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_closing_balance cannot be null');
        }

        $this->container['deferred_tax_closing_balance'] = $deferred_tax_closing_balance;

        return $this;
    }

    /**
     * Gets deferred_tax_assets_closing_balance
     *
     * @return float|null
     */
    public function getDeferredTaxAssetsClosingBalance()
    {
        return $this->container['deferred_tax_assets_closing_balance'];
    }

    /**
     * Sets deferred_tax_assets_closing_balance
     *
     * @param float|null $deferred_tax_assets_closing_balance deferred_tax_assets_closing_balance
     *
     * @return self
     */
    public function setDeferredTaxAssetsClosingBalance($deferred_tax_assets_closing_balance)
    {

        if (is_null($deferred_tax_assets_closing_balance)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_assets_closing_balance cannot be null');
        }

        $this->container['deferred_tax_assets_closing_balance'] = $deferred_tax_assets_closing_balance;

        return $this;
    }

    /**
     * Gets calculated_deferred_tax
     *
     * @return float|null
     */
    public function getCalculatedDeferredTax()
    {
        return $this->container['calculated_deferred_tax'];
    }

    /**
     * Sets calculated_deferred_tax
     *
     * @param float|null $calculated_deferred_tax calculated_deferred_tax
     *
     * @return self
     */
    public function setCalculatedDeferredTax($calculated_deferred_tax)
    {

        if (is_null($calculated_deferred_tax)) {
            throw new \InvalidArgumentException('non-nullable calculated_deferred_tax cannot be null');
        }

        $this->container['calculated_deferred_tax'] = $calculated_deferred_tax;

        return $this;
    }

    /**
     * Gets calculated_deferred_tax_assets
     *
     * @return float|null
     */
    public function getCalculatedDeferredTaxAssets()
    {
        return $this->container['calculated_deferred_tax_assets'];
    }

    /**
     * Sets calculated_deferred_tax_assets
     *
     * @param float|null $calculated_deferred_tax_assets calculated_deferred_tax_assets
     *
     * @return self
     */
    public function setCalculatedDeferredTaxAssets($calculated_deferred_tax_assets)
    {

        if (is_null($calculated_deferred_tax_assets)) {
            throw new \InvalidArgumentException('non-nullable calculated_deferred_tax_assets cannot be null');
        }

        $this->container['calculated_deferred_tax_assets'] = $calculated_deferred_tax_assets;

        return $this;
    }

    /**
     * Gets increased_deferred_tax
     *
     * @return float|null
     */
    public function getIncreasedDeferredTax()
    {
        return $this->container['increased_deferred_tax'];
    }

    /**
     * Sets increased_deferred_tax
     *
     * @param float|null $increased_deferred_tax increased_deferred_tax
     *
     * @return self
     */
    public function setIncreasedDeferredTax($increased_deferred_tax)
    {

        if (is_null($increased_deferred_tax)) {
            throw new \InvalidArgumentException('non-nullable increased_deferred_tax cannot be null');
        }

        $this->container['increased_deferred_tax'] = $increased_deferred_tax;

        return $this;
    }

    /**
     * Gets decreased_deferred_tax
     *
     * @return float|null
     */
    public function getDecreasedDeferredTax()
    {
        return $this->container['decreased_deferred_tax'];
    }

    /**
     * Sets decreased_deferred_tax
     *
     * @param float|null $decreased_deferred_tax decreased_deferred_tax
     *
     * @return self
     */
    public function setDecreasedDeferredTax($decreased_deferred_tax)
    {

        if (is_null($decreased_deferred_tax)) {
            throw new \InvalidArgumentException('non-nullable decreased_deferred_tax cannot be null');
        }

        $this->container['decreased_deferred_tax'] = $decreased_deferred_tax;

        return $this;
    }

    /**
     * Gets increased_deferred_tax_assets
     *
     * @return float|null
     */
    public function getIncreasedDeferredTaxAssets()
    {
        return $this->container['increased_deferred_tax_assets'];
    }

    /**
     * Sets increased_deferred_tax_assets
     *
     * @param float|null $increased_deferred_tax_assets increased_deferred_tax_assets
     *
     * @return self
     */
    public function setIncreasedDeferredTaxAssets($increased_deferred_tax_assets)
    {

        if (is_null($increased_deferred_tax_assets)) {
            throw new \InvalidArgumentException('non-nullable increased_deferred_tax_assets cannot be null');
        }

        $this->container['increased_deferred_tax_assets'] = $increased_deferred_tax_assets;

        return $this;
    }

    /**
     * Gets decreased_deferred_tax_assets
     *
     * @return float|null
     */
    public function getDecreasedDeferredTaxAssets()
    {
        return $this->container['decreased_deferred_tax_assets'];
    }

    /**
     * Sets decreased_deferred_tax_assets
     *
     * @param float|null $decreased_deferred_tax_assets decreased_deferred_tax_assets
     *
     * @return self
     */
    public function setDecreasedDeferredTaxAssets($decreased_deferred_tax_assets)
    {

        if (is_null($decreased_deferred_tax_assets)) {
            throw new \InvalidArgumentException('non-nullable decreased_deferred_tax_assets cannot be null');
        }

        $this->container['decreased_deferred_tax_assets'] = $decreased_deferred_tax_assets;

        return $this;
    }

    /**
     * Gets deferred_tax_to_be_posted
     *
     * @return float|null
     */
    public function getDeferredTaxToBePosted()
    {
        return $this->container['deferred_tax_to_be_posted'];
    }

    /**
     * Sets deferred_tax_to_be_posted
     *
     * @param float|null $deferred_tax_to_be_posted deferred_tax_to_be_posted
     *
     * @return self
     */
    public function setDeferredTaxToBePosted($deferred_tax_to_be_posted)
    {

        if (is_null($deferred_tax_to_be_posted)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_to_be_posted cannot be null');
        }

        $this->container['deferred_tax_to_be_posted'] = $deferred_tax_to_be_posted;

        return $this;
    }

    /**
     * Gets deferred_tax_assets_to_be_posted
     *
     * @return float|null
     */
    public function getDeferredTaxAssetsToBePosted()
    {
        return $this->container['deferred_tax_assets_to_be_posted'];
    }

    /**
     * Sets deferred_tax_assets_to_be_posted
     *
     * @param float|null $deferred_tax_assets_to_be_posted deferred_tax_assets_to_be_posted
     *
     * @return self
     */
    public function setDeferredTaxAssetsToBePosted($deferred_tax_assets_to_be_posted)
    {

        if (is_null($deferred_tax_assets_to_be_posted)) {
            throw new \InvalidArgumentException('non-nullable deferred_tax_assets_to_be_posted cannot be null');
        }

        $this->container['deferred_tax_assets_to_be_posted'] = $deferred_tax_assets_to_be_posted;

        return $this;
    }

    /**
     * Gets total_tax_to_set_asside
     *
     * @return float|null
     */
    public function getTotalTaxToSetAsside()
    {
        return $this->container['total_tax_to_set_asside'];
    }

    /**
     * Sets total_tax_to_set_asside
     *
     * @param float|null $total_tax_to_set_asside total_tax_to_set_asside
     *
     * @return self
     */
    public function setTotalTaxToSetAsside($total_tax_to_set_asside)
    {

        if (is_null($total_tax_to_set_asside)) {
            throw new \InvalidArgumentException('non-nullable total_tax_to_set_asside cannot be null');
        }

        $this->container['total_tax_to_set_asside'] = $total_tax_to_set_asside;

        return $this;
    }

    /**
     * Gets total_additions
     *
     * @return float|null
     */
    public function getTotalAdditions()
    {
        return $this->container['total_additions'];
    }

    /**
     * Sets total_additions
     *
     * @param float|null $total_additions total_additions
     *
     * @return self
     */
    public function setTotalAdditions($total_additions)
    {

        if (is_null($total_additions)) {
            throw new \InvalidArgumentException('non-nullable total_additions cannot be null');
        }

        $this->container['total_additions'] = $total_additions;

        return $this;
    }

    /**
     * Gets total_deductions
     *
     * @return float|null
     */
    public function getTotalDeductions()
    {
        return $this->container['total_deductions'];
    }

    /**
     * Sets total_deductions
     *
     * @param float|null $total_deductions total_deductions
     *
     * @return self
     */
    public function setTotalDeductions($total_deductions)
    {

        if (is_null($total_deductions)) {
            throw new \InvalidArgumentException('non-nullable total_deductions cannot be null');
        }

        $this->container['total_deductions'] = $total_deductions;

        return $this;
    }

    /**
     * Gets total_basis
     *
     * @return float|null
     */
    public function getTotalBasis()
    {
        return $this->container['total_basis'];
    }

    /**
     * Sets total_basis
     *
     * @param float|null $total_basis total_basis
     *
     * @return self
     */
    public function setTotalBasis($total_basis)
    {

        if (is_null($total_basis)) {
            throw new \InvalidArgumentException('non-nullable total_basis cannot be null');
        }

        $this->container['total_basis'] = $total_basis;

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


