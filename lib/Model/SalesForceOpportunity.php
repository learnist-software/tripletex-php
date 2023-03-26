<?php
/**
 * SalesForceOpportunity
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
 * SalesForceOpportunity Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SalesForceOpportunity implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SalesForceOpportunity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'all_prices' => 'array<string,array<string,float>>',
        'sum_startup_category1_users' => 'float',
        'sum_service_category1_users' => 'float',
        'list_price_category1_user_startup' => 'float',
        'list_price_category1_user_service' => 'float',
        'sum_startup' => 'float',
        'sum_service' => 'float',
        'sum_yearly_service' => 'float',
        'sum_additional_services' => 'float',
        'accountant_startup_provision' => 'float',
        'accountant_monthly_provision' => 'float',
        'no_of_users_prepaid' => 'int',
        'no_of_users_included' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'all_prices' => null,
        'sum_startup_category1_users' => null,
        'sum_service_category1_users' => null,
        'list_price_category1_user_startup' => null,
        'list_price_category1_user_service' => null,
        'sum_startup' => null,
        'sum_service' => null,
        'sum_yearly_service' => null,
        'sum_additional_services' => null,
        'accountant_startup_provision' => null,
        'accountant_monthly_provision' => null,
        'no_of_users_prepaid' => 'int32',
        'no_of_users_included' => 'int32'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'all_prices' => false,
		'sum_startup_category1_users' => false,
		'sum_service_category1_users' => false,
		'list_price_category1_user_startup' => false,
		'list_price_category1_user_service' => false,
		'sum_startup' => false,
		'sum_service' => false,
		'sum_yearly_service' => false,
		'sum_additional_services' => false,
		'accountant_startup_provision' => false,
		'accountant_monthly_provision' => false,
		'no_of_users_prepaid' => false,
		'no_of_users_included' => false
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
        'all_prices' => 'allPrices',
        'sum_startup_category1_users' => 'sumStartupCategory1Users',
        'sum_service_category1_users' => 'sumServiceCategory1Users',
        'list_price_category1_user_startup' => 'listPriceCategory1UserStartup',
        'list_price_category1_user_service' => 'listPriceCategory1UserService',
        'sum_startup' => 'sumStartup',
        'sum_service' => 'sumService',
        'sum_yearly_service' => 'sumYearlyService',
        'sum_additional_services' => 'sumAdditionalServices',
        'accountant_startup_provision' => 'accountantStartupProvision',
        'accountant_monthly_provision' => 'accountantMonthlyProvision',
        'no_of_users_prepaid' => 'noOfUsersPrepaid',
        'no_of_users_included' => 'noOfUsersIncluded'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'all_prices' => 'setAllPrices',
        'sum_startup_category1_users' => 'setSumStartupCategory1Users',
        'sum_service_category1_users' => 'setSumServiceCategory1Users',
        'list_price_category1_user_startup' => 'setListPriceCategory1UserStartup',
        'list_price_category1_user_service' => 'setListPriceCategory1UserService',
        'sum_startup' => 'setSumStartup',
        'sum_service' => 'setSumService',
        'sum_yearly_service' => 'setSumYearlyService',
        'sum_additional_services' => 'setSumAdditionalServices',
        'accountant_startup_provision' => 'setAccountantStartupProvision',
        'accountant_monthly_provision' => 'setAccountantMonthlyProvision',
        'no_of_users_prepaid' => 'setNoOfUsersPrepaid',
        'no_of_users_included' => 'setNoOfUsersIncluded'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'all_prices' => 'getAllPrices',
        'sum_startup_category1_users' => 'getSumStartupCategory1Users',
        'sum_service_category1_users' => 'getSumServiceCategory1Users',
        'list_price_category1_user_startup' => 'getListPriceCategory1UserStartup',
        'list_price_category1_user_service' => 'getListPriceCategory1UserService',
        'sum_startup' => 'getSumStartup',
        'sum_service' => 'getSumService',
        'sum_yearly_service' => 'getSumYearlyService',
        'sum_additional_services' => 'getSumAdditionalServices',
        'accountant_startup_provision' => 'getAccountantStartupProvision',
        'accountant_monthly_provision' => 'getAccountantMonthlyProvision',
        'no_of_users_prepaid' => 'getNoOfUsersPrepaid',
        'no_of_users_included' => 'getNoOfUsersIncluded'
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
        $this->setIfExists('all_prices', $data ?? [], null);
        $this->setIfExists('sum_startup_category1_users', $data ?? [], null);
        $this->setIfExists('sum_service_category1_users', $data ?? [], null);
        $this->setIfExists('list_price_category1_user_startup', $data ?? [], null);
        $this->setIfExists('list_price_category1_user_service', $data ?? [], null);
        $this->setIfExists('sum_startup', $data ?? [], null);
        $this->setIfExists('sum_service', $data ?? [], null);
        $this->setIfExists('sum_yearly_service', $data ?? [], null);
        $this->setIfExists('sum_additional_services', $data ?? [], null);
        $this->setIfExists('accountant_startup_provision', $data ?? [], null);
        $this->setIfExists('accountant_monthly_provision', $data ?? [], null);
        $this->setIfExists('no_of_users_prepaid', $data ?? [], null);
        $this->setIfExists('no_of_users_included', $data ?? [], null);
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
     * Gets all_prices
     *
     * @return array<string,array<string,float>>|null
     */
    public function getAllPrices()
    {
        return $this->container['all_prices'];
    }

    /**
     * Sets all_prices
     *
     * @param array<string,array<string,float>>|null $all_prices A nested map of all active sales modules. The key in the outer map is the sales module, whilst the inner map contains the different pricing types for the given sales module. A pricing type could be PER_USE(10).
     *
     * @return self
     */
    public function setAllPrices($all_prices)
    {

        if (is_null($all_prices)) {
            throw new \InvalidArgumentException('non-nullable all_prices cannot be null');
        }

        $this->container['all_prices'] = $all_prices;

        return $this;
    }

    /**
     * Gets sum_startup_category1_users
     *
     * @return float|null
     */
    public function getSumStartupCategory1Users()
    {
        return $this->container['sum_startup_category1_users'];
    }

    /**
     * Sets sum_startup_category1_users
     *
     * @param float|null $sum_startup_category1_users The total startup price for users of category 1.
     *
     * @return self
     */
    public function setSumStartupCategory1Users($sum_startup_category1_users)
    {

        if (is_null($sum_startup_category1_users)) {
            throw new \InvalidArgumentException('non-nullable sum_startup_category1_users cannot be null');
        }

        $this->container['sum_startup_category1_users'] = $sum_startup_category1_users;

        return $this;
    }

    /**
     * Gets sum_service_category1_users
     *
     * @return float|null
     */
    public function getSumServiceCategory1Users()
    {
        return $this->container['sum_service_category1_users'];
    }

    /**
     * Sets sum_service_category1_users
     *
     * @param float|null $sum_service_category1_users The total price per monthly price for users of category 1.
     *
     * @return self
     */
    public function setSumServiceCategory1Users($sum_service_category1_users)
    {

        if (is_null($sum_service_category1_users)) {
            throw new \InvalidArgumentException('non-nullable sum_service_category1_users cannot be null');
        }

        $this->container['sum_service_category1_users'] = $sum_service_category1_users;

        return $this;
    }

    /**
     * Gets list_price_category1_user_startup
     *
     * @return float|null
     */
    public function getListPriceCategory1UserStartup()
    {
        return $this->container['list_price_category1_user_startup'];
    }

    /**
     * Sets list_price_category1_user_startup
     *
     * @param float|null $list_price_category1_user_startup The startup list price per user.
     *
     * @return self
     */
    public function setListPriceCategory1UserStartup($list_price_category1_user_startup)
    {

        if (is_null($list_price_category1_user_startup)) {
            throw new \InvalidArgumentException('non-nullable list_price_category1_user_startup cannot be null');
        }

        $this->container['list_price_category1_user_startup'] = $list_price_category1_user_startup;

        return $this;
    }

    /**
     * Gets list_price_category1_user_service
     *
     * @return float|null
     */
    public function getListPriceCategory1UserService()
    {
        return $this->container['list_price_category1_user_service'];
    }

    /**
     * Sets list_price_category1_user_service
     *
     * @param float|null $list_price_category1_user_service The monthly list price per user.
     *
     * @return self
     */
    public function setListPriceCategory1UserService($list_price_category1_user_service)
    {

        if (is_null($list_price_category1_user_service)) {
            throw new \InvalidArgumentException('non-nullable list_price_category1_user_service cannot be null');
        }

        $this->container['list_price_category1_user_service'] = $list_price_category1_user_service;

        return $this;
    }

    /**
     * Gets sum_startup
     *
     * @return float|null
     */
    public function getSumStartup()
    {
        return $this->container['sum_startup'];
    }

    /**
     * Sets sum_startup
     *
     * @param float|null $sum_startup The startup price for the company.
     *
     * @return self
     */
    public function setSumStartup($sum_startup)
    {

        if (is_null($sum_startup)) {
            throw new \InvalidArgumentException('non-nullable sum_startup cannot be null');
        }

        $this->container['sum_startup'] = $sum_startup;

        return $this;
    }

    /**
     * Gets sum_service
     *
     * @return float|null
     */
    public function getSumService()
    {
        return $this->container['sum_service'];
    }

    /**
     * Sets sum_service
     *
     * @param float|null $sum_service The monthly price for the company.
     *
     * @return self
     */
    public function setSumService($sum_service)
    {

        if (is_null($sum_service)) {
            throw new \InvalidArgumentException('non-nullable sum_service cannot be null');
        }

        $this->container['sum_service'] = $sum_service;

        return $this;
    }

    /**
     * Gets sum_yearly_service
     *
     * @return float|null
     */
    public function getSumYearlyService()
    {
        return $this->container['sum_yearly_service'];
    }

    /**
     * Sets sum_yearly_service
     *
     * @param float|null $sum_yearly_service The monthly price for the company.
     *
     * @return self
     */
    public function setSumYearlyService($sum_yearly_service)
    {

        if (is_null($sum_yearly_service)) {
            throw new \InvalidArgumentException('non-nullable sum_yearly_service cannot be null');
        }

        $this->container['sum_yearly_service'] = $sum_yearly_service;

        return $this;
    }

    /**
     * Gets sum_additional_services
     *
     * @return float|null
     */
    public function getSumAdditionalServices()
    {
        return $this->container['sum_additional_services'];
    }

    /**
     * Sets sum_additional_services
     *
     * @param float|null $sum_additional_services The total startup price for additional services.
     *
     * @return self
     */
    public function setSumAdditionalServices($sum_additional_services)
    {

        if (is_null($sum_additional_services)) {
            throw new \InvalidArgumentException('non-nullable sum_additional_services cannot be null');
        }

        $this->container['sum_additional_services'] = $sum_additional_services;

        return $this;
    }

    /**
     * Gets accountant_startup_provision
     *
     * @return float|null
     */
    public function getAccountantStartupProvision()
    {
        return $this->container['accountant_startup_provision'];
    }

    /**
     * Sets accountant_startup_provision
     *
     * @param float|null $accountant_startup_provision The initial provision for the accountant of the startup price (percentage)
     *
     * @return self
     */
    public function setAccountantStartupProvision($accountant_startup_provision)
    {

        if (is_null($accountant_startup_provision)) {
            throw new \InvalidArgumentException('non-nullable accountant_startup_provision cannot be null');
        }

        $this->container['accountant_startup_provision'] = $accountant_startup_provision;

        return $this;
    }

    /**
     * Gets accountant_monthly_provision
     *
     * @return float|null
     */
    public function getAccountantMonthlyProvision()
    {
        return $this->container['accountant_monthly_provision'];
    }

    /**
     * Sets accountant_monthly_provision
     *
     * @param float|null $accountant_monthly_provision The monthly provision for the accountant of the monthly price (percentage)
     *
     * @return self
     */
    public function setAccountantMonthlyProvision($accountant_monthly_provision)
    {

        if (is_null($accountant_monthly_provision)) {
            throw new \InvalidArgumentException('non-nullable accountant_monthly_provision cannot be null');
        }

        $this->container['accountant_monthly_provision'] = $accountant_monthly_provision;

        return $this;
    }

    /**
     * Gets no_of_users_prepaid
     *
     * @return int|null
     */
    public function getNoOfUsersPrepaid()
    {
        return $this->container['no_of_users_prepaid'];
    }

    /**
     * Sets no_of_users_prepaid
     *
     * @param int|null $no_of_users_prepaid The number of users prepaid when creating the company.
     *
     * @return self
     */
    public function setNoOfUsersPrepaid($no_of_users_prepaid)
    {

        if (is_null($no_of_users_prepaid)) {
            throw new \InvalidArgumentException('non-nullable no_of_users_prepaid cannot be null');
        }

        $this->container['no_of_users_prepaid'] = $no_of_users_prepaid;

        return $this;
    }

    /**
     * Gets no_of_users_included
     *
     * @return int|null
     */
    public function getNoOfUsersIncluded()
    {
        return $this->container['no_of_users_included'];
    }

    /**
     * Sets no_of_users_included
     *
     * @param int|null $no_of_users_included The number of users included for free in the purchased module.
     *
     * @return self
     */
    public function setNoOfUsersIncluded($no_of_users_included)
    {

        if (is_null($no_of_users_included)) {
            throw new \InvalidArgumentException('non-nullable no_of_users_included cannot be null');
        }

        $this->container['no_of_users_included'] = $no_of_users_included;

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


