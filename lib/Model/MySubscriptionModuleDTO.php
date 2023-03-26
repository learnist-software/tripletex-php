<?php
/**
 * MySubscriptionModuleDTO
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
 * MySubscriptionModuleDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class MySubscriptionModuleDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MySubscriptionModuleDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'category' => 'string',
        'title' => 'string',
        'short_description' => 'string',
        'description_part1' => 'string',
        'description_part2' => 'string',
        'per_use_price' => 'object',
        'per_user_price' => 'object',
        'monthly_price' => 'object',
        'yearly_price' => 'object',
        'start_up_price' => 'object',
        'per_user_over_limit_price' => 'object',
        'price_description' => 'string',
        'active' => 'bool',
        'available' => 'bool',
        'processing' => 'bool',
        'info_text' => 'string',
        'agreement_title' => 'string',
        'agreement_text' => 'string',
        'unavailable_text' => 'string',
        'license_url' => 'string',
        'license_text' => 'string',
        'redirect_url' => 'string',
        'price_line1_text' => 'string',
        'price_line2_text' => 'string',
        'price_line3_text' => 'string',
        'price1' => 'object',
        'price2' => 'object',
        'price3' => 'object',
        'can_deactivate' => 'bool',
        'deactivation_error' => 'string'
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
        'category' => null,
        'title' => null,
        'short_description' => null,
        'description_part1' => null,
        'description_part2' => null,
        'per_use_price' => null,
        'per_user_price' => null,
        'monthly_price' => null,
        'yearly_price' => null,
        'start_up_price' => null,
        'per_user_over_limit_price' => null,
        'price_description' => null,
        'active' => null,
        'available' => null,
        'processing' => null,
        'info_text' => null,
        'agreement_title' => null,
        'agreement_text' => null,
        'unavailable_text' => null,
        'license_url' => null,
        'license_text' => null,
        'redirect_url' => null,
        'price_line1_text' => null,
        'price_line2_text' => null,
        'price_line3_text' => null,
        'price1' => null,
        'price2' => null,
        'price3' => null,
        'can_deactivate' => null,
        'deactivation_error' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'category' => false,
		'title' => false,
		'short_description' => false,
		'description_part1' => false,
		'description_part2' => false,
		'per_use_price' => false,
		'per_user_price' => false,
		'monthly_price' => false,
		'yearly_price' => false,
		'start_up_price' => false,
		'per_user_over_limit_price' => false,
		'price_description' => false,
		'active' => false,
		'available' => false,
		'processing' => false,
		'info_text' => false,
		'agreement_title' => false,
		'agreement_text' => false,
		'unavailable_text' => false,
		'license_url' => false,
		'license_text' => false,
		'redirect_url' => false,
		'price_line1_text' => false,
		'price_line2_text' => false,
		'price_line3_text' => false,
		'price1' => false,
		'price2' => false,
		'price3' => false,
		'can_deactivate' => false,
		'deactivation_error' => false
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
        'category' => 'category',
        'title' => 'title',
        'short_description' => 'shortDescription',
        'description_part1' => 'descriptionPart1',
        'description_part2' => 'descriptionPart2',
        'per_use_price' => 'perUsePrice',
        'per_user_price' => 'perUserPrice',
        'monthly_price' => 'monthlyPrice',
        'yearly_price' => 'yearlyPrice',
        'start_up_price' => 'startUpPrice',
        'per_user_over_limit_price' => 'perUserOverLimitPrice',
        'price_description' => 'priceDescription',
        'active' => 'active',
        'available' => 'available',
        'processing' => 'processing',
        'info_text' => 'infoText',
        'agreement_title' => 'agreementTitle',
        'agreement_text' => 'agreementText',
        'unavailable_text' => 'unavailableText',
        'license_url' => 'licenseUrl',
        'license_text' => 'licenseText',
        'redirect_url' => 'redirectUrl',
        'price_line1_text' => 'priceLine1Text',
        'price_line2_text' => 'priceLine2Text',
        'price_line3_text' => 'priceLine3Text',
        'price1' => 'price1',
        'price2' => 'price2',
        'price3' => 'price3',
        'can_deactivate' => 'canDeactivate',
        'deactivation_error' => 'deactivationError'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'category' => 'setCategory',
        'title' => 'setTitle',
        'short_description' => 'setShortDescription',
        'description_part1' => 'setDescriptionPart1',
        'description_part2' => 'setDescriptionPart2',
        'per_use_price' => 'setPerUsePrice',
        'per_user_price' => 'setPerUserPrice',
        'monthly_price' => 'setMonthlyPrice',
        'yearly_price' => 'setYearlyPrice',
        'start_up_price' => 'setStartUpPrice',
        'per_user_over_limit_price' => 'setPerUserOverLimitPrice',
        'price_description' => 'setPriceDescription',
        'active' => 'setActive',
        'available' => 'setAvailable',
        'processing' => 'setProcessing',
        'info_text' => 'setInfoText',
        'agreement_title' => 'setAgreementTitle',
        'agreement_text' => 'setAgreementText',
        'unavailable_text' => 'setUnavailableText',
        'license_url' => 'setLicenseUrl',
        'license_text' => 'setLicenseText',
        'redirect_url' => 'setRedirectUrl',
        'price_line1_text' => 'setPriceLine1Text',
        'price_line2_text' => 'setPriceLine2Text',
        'price_line3_text' => 'setPriceLine3Text',
        'price1' => 'setPrice1',
        'price2' => 'setPrice2',
        'price3' => 'setPrice3',
        'can_deactivate' => 'setCanDeactivate',
        'deactivation_error' => 'setDeactivationError'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'category' => 'getCategory',
        'title' => 'getTitle',
        'short_description' => 'getShortDescription',
        'description_part1' => 'getDescriptionPart1',
        'description_part2' => 'getDescriptionPart2',
        'per_use_price' => 'getPerUsePrice',
        'per_user_price' => 'getPerUserPrice',
        'monthly_price' => 'getMonthlyPrice',
        'yearly_price' => 'getYearlyPrice',
        'start_up_price' => 'getStartUpPrice',
        'per_user_over_limit_price' => 'getPerUserOverLimitPrice',
        'price_description' => 'getPriceDescription',
        'active' => 'getActive',
        'available' => 'getAvailable',
        'processing' => 'getProcessing',
        'info_text' => 'getInfoText',
        'agreement_title' => 'getAgreementTitle',
        'agreement_text' => 'getAgreementText',
        'unavailable_text' => 'getUnavailableText',
        'license_url' => 'getLicenseUrl',
        'license_text' => 'getLicenseText',
        'redirect_url' => 'getRedirectUrl',
        'price_line1_text' => 'getPriceLine1Text',
        'price_line2_text' => 'getPriceLine2Text',
        'price_line3_text' => 'getPriceLine3Text',
        'price1' => 'getPrice1',
        'price2' => 'getPrice2',
        'price3' => 'getPrice3',
        'can_deactivate' => 'getCanDeactivate',
        'deactivation_error' => 'getDeactivationError'
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('category', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('short_description', $data ?? [], null);
        $this->setIfExists('description_part1', $data ?? [], null);
        $this->setIfExists('description_part2', $data ?? [], null);
        $this->setIfExists('per_use_price', $data ?? [], null);
        $this->setIfExists('per_user_price', $data ?? [], null);
        $this->setIfExists('monthly_price', $data ?? [], null);
        $this->setIfExists('yearly_price', $data ?? [], null);
        $this->setIfExists('start_up_price', $data ?? [], null);
        $this->setIfExists('per_user_over_limit_price', $data ?? [], null);
        $this->setIfExists('price_description', $data ?? [], null);
        $this->setIfExists('active', $data ?? [], null);
        $this->setIfExists('available', $data ?? [], null);
        $this->setIfExists('processing', $data ?? [], null);
        $this->setIfExists('info_text', $data ?? [], null);
        $this->setIfExists('agreement_title', $data ?? [], null);
        $this->setIfExists('agreement_text', $data ?? [], null);
        $this->setIfExists('unavailable_text', $data ?? [], null);
        $this->setIfExists('license_url', $data ?? [], null);
        $this->setIfExists('license_text', $data ?? [], null);
        $this->setIfExists('redirect_url', $data ?? [], null);
        $this->setIfExists('price_line1_text', $data ?? [], null);
        $this->setIfExists('price_line2_text', $data ?? [], null);
        $this->setIfExists('price_line3_text', $data ?? [], null);
        $this->setIfExists('price1', $data ?? [], null);
        $this->setIfExists('price2', $data ?? [], null);
        $this->setIfExists('price3', $data ?? [], null);
        $this->setIfExists('can_deactivate', $data ?? [], null);
        $this->setIfExists('deactivation_error', $data ?? [], null);
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
     * Gets category
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string|null $category category
     *
     * @return self
     */
    public function setCategory($category)
    {
        if (is_null($category)) {
            throw new \InvalidArgumentException('non-nullable category cannot be null');
        }
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title title
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets short_description
     *
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->container['short_description'];
    }

    /**
     * Sets short_description
     *
     * @param string|null $short_description short_description
     *
     * @return self
     */
    public function setShortDescription($short_description)
    {
        if (is_null($short_description)) {
            throw new \InvalidArgumentException('non-nullable short_description cannot be null');
        }
        $this->container['short_description'] = $short_description;

        return $this;
    }

    /**
     * Gets description_part1
     *
     * @return string|null
     */
    public function getDescriptionPart1()
    {
        return $this->container['description_part1'];
    }

    /**
     * Sets description_part1
     *
     * @param string|null $description_part1 description_part1
     *
     * @return self
     */
    public function setDescriptionPart1($description_part1)
    {
        if (is_null($description_part1)) {
            throw new \InvalidArgumentException('non-nullable description_part1 cannot be null');
        }
        $this->container['description_part1'] = $description_part1;

        return $this;
    }

    /**
     * Gets description_part2
     *
     * @return string|null
     */
    public function getDescriptionPart2()
    {
        return $this->container['description_part2'];
    }

    /**
     * Sets description_part2
     *
     * @param string|null $description_part2 description_part2
     *
     * @return self
     */
    public function setDescriptionPart2($description_part2)
    {
        if (is_null($description_part2)) {
            throw new \InvalidArgumentException('non-nullable description_part2 cannot be null');
        }
        $this->container['description_part2'] = $description_part2;

        return $this;
    }

    /**
     * Gets per_use_price
     *
     * @return object|null
     */
    public function getPerUsePrice()
    {
        return $this->container['per_use_price'];
    }

    /**
     * Sets per_use_price
     *
     * @param object|null $per_use_price per_use_price
     *
     * @return self
     */
    public function setPerUsePrice($per_use_price)
    {
        if (is_null($per_use_price)) {
            throw new \InvalidArgumentException('non-nullable per_use_price cannot be null');
        }
        $this->container['per_use_price'] = $per_use_price;

        return $this;
    }

    /**
     * Gets per_user_price
     *
     * @return object|null
     */
    public function getPerUserPrice()
    {
        return $this->container['per_user_price'];
    }

    /**
     * Sets per_user_price
     *
     * @param object|null $per_user_price per_user_price
     *
     * @return self
     */
    public function setPerUserPrice($per_user_price)
    {
        if (is_null($per_user_price)) {
            throw new \InvalidArgumentException('non-nullable per_user_price cannot be null');
        }
        $this->container['per_user_price'] = $per_user_price;

        return $this;
    }

    /**
     * Gets monthly_price
     *
     * @return object|null
     */
    public function getMonthlyPrice()
    {
        return $this->container['monthly_price'];
    }

    /**
     * Sets monthly_price
     *
     * @param object|null $monthly_price monthly_price
     *
     * @return self
     */
    public function setMonthlyPrice($monthly_price)
    {
        if (is_null($monthly_price)) {
            throw new \InvalidArgumentException('non-nullable monthly_price cannot be null');
        }
        $this->container['monthly_price'] = $monthly_price;

        return $this;
    }

    /**
     * Gets yearly_price
     *
     * @return object|null
     */
    public function getYearlyPrice()
    {
        return $this->container['yearly_price'];
    }

    /**
     * Sets yearly_price
     *
     * @param object|null $yearly_price yearly_price
     *
     * @return self
     */
    public function setYearlyPrice($yearly_price)
    {
        if (is_null($yearly_price)) {
            throw new \InvalidArgumentException('non-nullable yearly_price cannot be null');
        }
        $this->container['yearly_price'] = $yearly_price;

        return $this;
    }

    /**
     * Gets start_up_price
     *
     * @return object|null
     */
    public function getStartUpPrice()
    {
        return $this->container['start_up_price'];
    }

    /**
     * Sets start_up_price
     *
     * @param object|null $start_up_price start_up_price
     *
     * @return self
     */
    public function setStartUpPrice($start_up_price)
    {
        if (is_null($start_up_price)) {
            throw new \InvalidArgumentException('non-nullable start_up_price cannot be null');
        }
        $this->container['start_up_price'] = $start_up_price;

        return $this;
    }

    /**
     * Gets per_user_over_limit_price
     *
     * @return object|null
     */
    public function getPerUserOverLimitPrice()
    {
        return $this->container['per_user_over_limit_price'];
    }

    /**
     * Sets per_user_over_limit_price
     *
     * @param object|null $per_user_over_limit_price per_user_over_limit_price
     *
     * @return self
     */
    public function setPerUserOverLimitPrice($per_user_over_limit_price)
    {
        if (is_null($per_user_over_limit_price)) {
            throw new \InvalidArgumentException('non-nullable per_user_over_limit_price cannot be null');
        }
        $this->container['per_user_over_limit_price'] = $per_user_over_limit_price;

        return $this;
    }

    /**
     * Gets price_description
     *
     * @return string|null
     */
    public function getPriceDescription()
    {
        return $this->container['price_description'];
    }

    /**
     * Sets price_description
     *
     * @param string|null $price_description price_description
     *
     * @return self
     */
    public function setPriceDescription($price_description)
    {
        if (is_null($price_description)) {
            throw new \InvalidArgumentException('non-nullable price_description cannot be null');
        }
        $this->container['price_description'] = $price_description;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active active
     *
     * @return self
     */
    public function setActive($active)
    {
        if (is_null($active)) {
            throw new \InvalidArgumentException('non-nullable active cannot be null');
        }
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets available
     *
     * @return bool|null
     */
    public function getAvailable()
    {
        return $this->container['available'];
    }

    /**
     * Sets available
     *
     * @param bool|null $available available
     *
     * @return self
     */
    public function setAvailable($available)
    {
        if (is_null($available)) {
            throw new \InvalidArgumentException('non-nullable available cannot be null');
        }
        $this->container['available'] = $available;

        return $this;
    }

    /**
     * Gets processing
     *
     * @return bool|null
     */
    public function getProcessing()
    {
        return $this->container['processing'];
    }

    /**
     * Sets processing
     *
     * @param bool|null $processing processing
     *
     * @return self
     */
    public function setProcessing($processing)
    {
        if (is_null($processing)) {
            throw new \InvalidArgumentException('non-nullable processing cannot be null');
        }
        $this->container['processing'] = $processing;

        return $this;
    }

    /**
     * Gets info_text
     *
     * @return string|null
     */
    public function getInfoText()
    {
        return $this->container['info_text'];
    }

    /**
     * Sets info_text
     *
     * @param string|null $info_text info_text
     *
     * @return self
     */
    public function setInfoText($info_text)
    {
        if (is_null($info_text)) {
            throw new \InvalidArgumentException('non-nullable info_text cannot be null');
        }
        $this->container['info_text'] = $info_text;

        return $this;
    }

    /**
     * Gets agreement_title
     *
     * @return string|null
     */
    public function getAgreementTitle()
    {
        return $this->container['agreement_title'];
    }

    /**
     * Sets agreement_title
     *
     * @param string|null $agreement_title agreement_title
     *
     * @return self
     */
    public function setAgreementTitle($agreement_title)
    {
        if (is_null($agreement_title)) {
            throw new \InvalidArgumentException('non-nullable agreement_title cannot be null');
        }
        $this->container['agreement_title'] = $agreement_title;

        return $this;
    }

    /**
     * Gets agreement_text
     *
     * @return string|null
     */
    public function getAgreementText()
    {
        return $this->container['agreement_text'];
    }

    /**
     * Sets agreement_text
     *
     * @param string|null $agreement_text agreement_text
     *
     * @return self
     */
    public function setAgreementText($agreement_text)
    {
        if (is_null($agreement_text)) {
            throw new \InvalidArgumentException('non-nullable agreement_text cannot be null');
        }
        $this->container['agreement_text'] = $agreement_text;

        return $this;
    }

    /**
     * Gets unavailable_text
     *
     * @return string|null
     */
    public function getUnavailableText()
    {
        return $this->container['unavailable_text'];
    }

    /**
     * Sets unavailable_text
     *
     * @param string|null $unavailable_text unavailable_text
     *
     * @return self
     */
    public function setUnavailableText($unavailable_text)
    {
        if (is_null($unavailable_text)) {
            throw new \InvalidArgumentException('non-nullable unavailable_text cannot be null');
        }
        $this->container['unavailable_text'] = $unavailable_text;

        return $this;
    }

    /**
     * Gets license_url
     *
     * @return string|null
     */
    public function getLicenseUrl()
    {
        return $this->container['license_url'];
    }

    /**
     * Sets license_url
     *
     * @param string|null $license_url license_url
     *
     * @return self
     */
    public function setLicenseUrl($license_url)
    {
        if (is_null($license_url)) {
            throw new \InvalidArgumentException('non-nullable license_url cannot be null');
        }
        $this->container['license_url'] = $license_url;

        return $this;
    }

    /**
     * Gets license_text
     *
     * @return string|null
     */
    public function getLicenseText()
    {
        return $this->container['license_text'];
    }

    /**
     * Sets license_text
     *
     * @param string|null $license_text license_text
     *
     * @return self
     */
    public function setLicenseText($license_text)
    {
        if (is_null($license_text)) {
            throw new \InvalidArgumentException('non-nullable license_text cannot be null');
        }
        $this->container['license_text'] = $license_text;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string|null $redirect_url redirect_url
     *
     * @return self
     */
    public function setRedirectUrl($redirect_url)
    {
        if (is_null($redirect_url)) {
            throw new \InvalidArgumentException('non-nullable redirect_url cannot be null');
        }
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets price_line1_text
     *
     * @return string|null
     */
    public function getPriceLine1Text()
    {
        return $this->container['price_line1_text'];
    }

    /**
     * Sets price_line1_text
     *
     * @param string|null $price_line1_text price_line1_text
     *
     * @return self
     */
    public function setPriceLine1Text($price_line1_text)
    {
        if (is_null($price_line1_text)) {
            throw new \InvalidArgumentException('non-nullable price_line1_text cannot be null');
        }
        $this->container['price_line1_text'] = $price_line1_text;

        return $this;
    }

    /**
     * Gets price_line2_text
     *
     * @return string|null
     */
    public function getPriceLine2Text()
    {
        return $this->container['price_line2_text'];
    }

    /**
     * Sets price_line2_text
     *
     * @param string|null $price_line2_text price_line2_text
     *
     * @return self
     */
    public function setPriceLine2Text($price_line2_text)
    {
        if (is_null($price_line2_text)) {
            throw new \InvalidArgumentException('non-nullable price_line2_text cannot be null');
        }
        $this->container['price_line2_text'] = $price_line2_text;

        return $this;
    }

    /**
     * Gets price_line3_text
     *
     * @return string|null
     */
    public function getPriceLine3Text()
    {
        return $this->container['price_line3_text'];
    }

    /**
     * Sets price_line3_text
     *
     * @param string|null $price_line3_text price_line3_text
     *
     * @return self
     */
    public function setPriceLine3Text($price_line3_text)
    {
        if (is_null($price_line3_text)) {
            throw new \InvalidArgumentException('non-nullable price_line3_text cannot be null');
        }
        $this->container['price_line3_text'] = $price_line3_text;

        return $this;
    }

    /**
     * Gets price1
     *
     * @return object|null
     */
    public function getPrice1()
    {
        return $this->container['price1'];
    }

    /**
     * Sets price1
     *
     * @param object|null $price1 price1
     *
     * @return self
     */
    public function setPrice1($price1)
    {
        if (is_null($price1)) {
            throw new \InvalidArgumentException('non-nullable price1 cannot be null');
        }
        $this->container['price1'] = $price1;

        return $this;
    }

    /**
     * Gets price2
     *
     * @return object|null
     */
    public function getPrice2()
    {
        return $this->container['price2'];
    }

    /**
     * Sets price2
     *
     * @param object|null $price2 price2
     *
     * @return self
     */
    public function setPrice2($price2)
    {
        if (is_null($price2)) {
            throw new \InvalidArgumentException('non-nullable price2 cannot be null');
        }
        $this->container['price2'] = $price2;

        return $this;
    }

    /**
     * Gets price3
     *
     * @return object|null
     */
    public function getPrice3()
    {
        return $this->container['price3'];
    }

    /**
     * Sets price3
     *
     * @param object|null $price3 price3
     *
     * @return self
     */
    public function setPrice3($price3)
    {
        if (is_null($price3)) {
            throw new \InvalidArgumentException('non-nullable price3 cannot be null');
        }
        $this->container['price3'] = $price3;

        return $this;
    }

    /**
     * Gets can_deactivate
     *
     * @return bool|null
     */
    public function getCanDeactivate()
    {
        return $this->container['can_deactivate'];
    }

    /**
     * Sets can_deactivate
     *
     * @param bool|null $can_deactivate can_deactivate
     *
     * @return self
     */
    public function setCanDeactivate($can_deactivate)
    {
        if (is_null($can_deactivate)) {
            throw new \InvalidArgumentException('non-nullable can_deactivate cannot be null');
        }
        $this->container['can_deactivate'] = $can_deactivate;

        return $this;
    }

    /**
     * Gets deactivation_error
     *
     * @return string|null
     */
    public function getDeactivationError()
    {
        return $this->container['deactivation_error'];
    }

    /**
     * Sets deactivation_error
     *
     * @param string|null $deactivation_error deactivation_error
     *
     * @return self
     */
    public function setDeactivationError($deactivation_error)
    {
        if (is_null($deactivation_error)) {
            throw new \InvalidArgumentException('non-nullable deactivation_error cannot be null');
        }
        $this->container['deactivation_error'] = $deactivation_error;

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


