<?php
/**
 * MySubscriptionModuleDTO
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
 * MySubscriptionModuleDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MySubscriptionModuleDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'MySubscriptionModuleDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'category' => 'string',
'title' => 'string',
'short_description' => 'string',
'description_part1' => 'string',
'description_part2' => 'string',
'per_use_price' => '\Learnist\Tripletex\Model\TlxNumber',
'per_user_price' => '\Learnist\Tripletex\Model\TlxNumber',
'monthly_price' => '\Learnist\Tripletex\Model\TlxNumber',
'yearly_price' => '\Learnist\Tripletex\Model\TlxNumber',
'start_up_price' => '\Learnist\Tripletex\Model\TlxNumber',
'per_user_over_limit_price' => '\Learnist\Tripletex\Model\TlxNumber',
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
'price1' => '\Learnist\Tripletex\Model\TlxNumber',
'price2' => '\Learnist\Tripletex\Model\TlxNumber',
'price3' => '\Learnist\Tripletex\Model\TlxNumber',
'can_deactivate' => 'bool',
'deactivation_error' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'deactivation_error' => null    ];

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
'deactivation_error' => 'deactivationError'    ];

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
'deactivation_error' => 'setDeactivationError'    ];

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
'deactivation_error' => 'getDeactivationError'    ];

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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['category'] = isset($data['category']) ? $data['category'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
        $this->container['short_description'] = isset($data['short_description']) ? $data['short_description'] : null;
        $this->container['description_part1'] = isset($data['description_part1']) ? $data['description_part1'] : null;
        $this->container['description_part2'] = isset($data['description_part2']) ? $data['description_part2'] : null;
        $this->container['per_use_price'] = isset($data['per_use_price']) ? $data['per_use_price'] : null;
        $this->container['per_user_price'] = isset($data['per_user_price']) ? $data['per_user_price'] : null;
        $this->container['monthly_price'] = isset($data['monthly_price']) ? $data['monthly_price'] : null;
        $this->container['yearly_price'] = isset($data['yearly_price']) ? $data['yearly_price'] : null;
        $this->container['start_up_price'] = isset($data['start_up_price']) ? $data['start_up_price'] : null;
        $this->container['per_user_over_limit_price'] = isset($data['per_user_over_limit_price']) ? $data['per_user_over_limit_price'] : null;
        $this->container['price_description'] = isset($data['price_description']) ? $data['price_description'] : null;
        $this->container['active'] = isset($data['active']) ? $data['active'] : null;
        $this->container['available'] = isset($data['available']) ? $data['available'] : null;
        $this->container['processing'] = isset($data['processing']) ? $data['processing'] : null;
        $this->container['info_text'] = isset($data['info_text']) ? $data['info_text'] : null;
        $this->container['agreement_title'] = isset($data['agreement_title']) ? $data['agreement_title'] : null;
        $this->container['agreement_text'] = isset($data['agreement_text']) ? $data['agreement_text'] : null;
        $this->container['unavailable_text'] = isset($data['unavailable_text']) ? $data['unavailable_text'] : null;
        $this->container['license_url'] = isset($data['license_url']) ? $data['license_url'] : null;
        $this->container['license_text'] = isset($data['license_text']) ? $data['license_text'] : null;
        $this->container['redirect_url'] = isset($data['redirect_url']) ? $data['redirect_url'] : null;
        $this->container['price_line1_text'] = isset($data['price_line1_text']) ? $data['price_line1_text'] : null;
        $this->container['price_line2_text'] = isset($data['price_line2_text']) ? $data['price_line2_text'] : null;
        $this->container['price_line3_text'] = isset($data['price_line3_text']) ? $data['price_line3_text'] : null;
        $this->container['price1'] = isset($data['price1']) ? $data['price1'] : null;
        $this->container['price2'] = isset($data['price2']) ? $data['price2'] : null;
        $this->container['price3'] = isset($data['price3']) ? $data['price3'] : null;
        $this->container['can_deactivate'] = isset($data['can_deactivate']) ? $data['can_deactivate'] : null;
        $this->container['deactivation_error'] = isset($data['deactivation_error']) ? $data['deactivation_error'] : null;
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
     * Gets category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param string $category category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets short_description
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->container['short_description'];
    }

    /**
     * Sets short_description
     *
     * @param string $short_description short_description
     *
     * @return $this
     */
    public function setShortDescription($short_description)
    {
        $this->container['short_description'] = $short_description;

        return $this;
    }

    /**
     * Gets description_part1
     *
     * @return string
     */
    public function getDescriptionPart1()
    {
        return $this->container['description_part1'];
    }

    /**
     * Sets description_part1
     *
     * @param string $description_part1 description_part1
     *
     * @return $this
     */
    public function setDescriptionPart1($description_part1)
    {
        $this->container['description_part1'] = $description_part1;

        return $this;
    }

    /**
     * Gets description_part2
     *
     * @return string
     */
    public function getDescriptionPart2()
    {
        return $this->container['description_part2'];
    }

    /**
     * Sets description_part2
     *
     * @param string $description_part2 description_part2
     *
     * @return $this
     */
    public function setDescriptionPart2($description_part2)
    {
        $this->container['description_part2'] = $description_part2;

        return $this;
    }

    /**
     * Gets per_use_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPerUsePrice()
    {
        return $this->container['per_use_price'];
    }

    /**
     * Sets per_use_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $per_use_price per_use_price
     *
     * @return $this
     */
    public function setPerUsePrice($per_use_price)
    {
        $this->container['per_use_price'] = $per_use_price;

        return $this;
    }

    /**
     * Gets per_user_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPerUserPrice()
    {
        return $this->container['per_user_price'];
    }

    /**
     * Sets per_user_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $per_user_price per_user_price
     *
     * @return $this
     */
    public function setPerUserPrice($per_user_price)
    {
        $this->container['per_user_price'] = $per_user_price;

        return $this;
    }

    /**
     * Gets monthly_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getMonthlyPrice()
    {
        return $this->container['monthly_price'];
    }

    /**
     * Sets monthly_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $monthly_price monthly_price
     *
     * @return $this
     */
    public function setMonthlyPrice($monthly_price)
    {
        $this->container['monthly_price'] = $monthly_price;

        return $this;
    }

    /**
     * Gets yearly_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getYearlyPrice()
    {
        return $this->container['yearly_price'];
    }

    /**
     * Sets yearly_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $yearly_price yearly_price
     *
     * @return $this
     */
    public function setYearlyPrice($yearly_price)
    {
        $this->container['yearly_price'] = $yearly_price;

        return $this;
    }

    /**
     * Gets start_up_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getStartUpPrice()
    {
        return $this->container['start_up_price'];
    }

    /**
     * Sets start_up_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $start_up_price start_up_price
     *
     * @return $this
     */
    public function setStartUpPrice($start_up_price)
    {
        $this->container['start_up_price'] = $start_up_price;

        return $this;
    }

    /**
     * Gets per_user_over_limit_price
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPerUserOverLimitPrice()
    {
        return $this->container['per_user_over_limit_price'];
    }

    /**
     * Sets per_user_over_limit_price
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $per_user_over_limit_price per_user_over_limit_price
     *
     * @return $this
     */
    public function setPerUserOverLimitPrice($per_user_over_limit_price)
    {
        $this->container['per_user_over_limit_price'] = $per_user_over_limit_price;

        return $this;
    }

    /**
     * Gets price_description
     *
     * @return string
     */
    public function getPriceDescription()
    {
        return $this->container['price_description'];
    }

    /**
     * Sets price_description
     *
     * @param string $price_description price_description
     *
     * @return $this
     */
    public function setPriceDescription($price_description)
    {
        $this->container['price_description'] = $price_description;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool $active active
     *
     * @return $this
     */
    public function setActive($active)
    {
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets available
     *
     * @return bool
     */
    public function getAvailable()
    {
        return $this->container['available'];
    }

    /**
     * Sets available
     *
     * @param bool $available available
     *
     * @return $this
     */
    public function setAvailable($available)
    {
        $this->container['available'] = $available;

        return $this;
    }

    /**
     * Gets processing
     *
     * @return bool
     */
    public function getProcessing()
    {
        return $this->container['processing'];
    }

    /**
     * Sets processing
     *
     * @param bool $processing processing
     *
     * @return $this
     */
    public function setProcessing($processing)
    {
        $this->container['processing'] = $processing;

        return $this;
    }

    /**
     * Gets info_text
     *
     * @return string
     */
    public function getInfoText()
    {
        return $this->container['info_text'];
    }

    /**
     * Sets info_text
     *
     * @param string $info_text info_text
     *
     * @return $this
     */
    public function setInfoText($info_text)
    {
        $this->container['info_text'] = $info_text;

        return $this;
    }

    /**
     * Gets agreement_title
     *
     * @return string
     */
    public function getAgreementTitle()
    {
        return $this->container['agreement_title'];
    }

    /**
     * Sets agreement_title
     *
     * @param string $agreement_title agreement_title
     *
     * @return $this
     */
    public function setAgreementTitle($agreement_title)
    {
        $this->container['agreement_title'] = $agreement_title;

        return $this;
    }

    /**
     * Gets agreement_text
     *
     * @return string
     */
    public function getAgreementText()
    {
        return $this->container['agreement_text'];
    }

    /**
     * Sets agreement_text
     *
     * @param string $agreement_text agreement_text
     *
     * @return $this
     */
    public function setAgreementText($agreement_text)
    {
        $this->container['agreement_text'] = $agreement_text;

        return $this;
    }

    /**
     * Gets unavailable_text
     *
     * @return string
     */
    public function getUnavailableText()
    {
        return $this->container['unavailable_text'];
    }

    /**
     * Sets unavailable_text
     *
     * @param string $unavailable_text unavailable_text
     *
     * @return $this
     */
    public function setUnavailableText($unavailable_text)
    {
        $this->container['unavailable_text'] = $unavailable_text;

        return $this;
    }

    /**
     * Gets license_url
     *
     * @return string
     */
    public function getLicenseUrl()
    {
        return $this->container['license_url'];
    }

    /**
     * Sets license_url
     *
     * @param string $license_url license_url
     *
     * @return $this
     */
    public function setLicenseUrl($license_url)
    {
        $this->container['license_url'] = $license_url;

        return $this;
    }

    /**
     * Gets license_text
     *
     * @return string
     */
    public function getLicenseText()
    {
        return $this->container['license_text'];
    }

    /**
     * Sets license_text
     *
     * @param string $license_text license_text
     *
     * @return $this
     */
    public function setLicenseText($license_text)
    {
        $this->container['license_text'] = $license_text;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string $redirect_url redirect_url
     *
     * @return $this
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets price_line1_text
     *
     * @return string
     */
    public function getPriceLine1Text()
    {
        return $this->container['price_line1_text'];
    }

    /**
     * Sets price_line1_text
     *
     * @param string $price_line1_text price_line1_text
     *
     * @return $this
     */
    public function setPriceLine1Text($price_line1_text)
    {
        $this->container['price_line1_text'] = $price_line1_text;

        return $this;
    }

    /**
     * Gets price_line2_text
     *
     * @return string
     */
    public function getPriceLine2Text()
    {
        return $this->container['price_line2_text'];
    }

    /**
     * Sets price_line2_text
     *
     * @param string $price_line2_text price_line2_text
     *
     * @return $this
     */
    public function setPriceLine2Text($price_line2_text)
    {
        $this->container['price_line2_text'] = $price_line2_text;

        return $this;
    }

    /**
     * Gets price_line3_text
     *
     * @return string
     */
    public function getPriceLine3Text()
    {
        return $this->container['price_line3_text'];
    }

    /**
     * Sets price_line3_text
     *
     * @param string $price_line3_text price_line3_text
     *
     * @return $this
     */
    public function setPriceLine3Text($price_line3_text)
    {
        $this->container['price_line3_text'] = $price_line3_text;

        return $this;
    }

    /**
     * Gets price1
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPrice1()
    {
        return $this->container['price1'];
    }

    /**
     * Sets price1
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $price1 price1
     *
     * @return $this
     */
    public function setPrice1($price1)
    {
        $this->container['price1'] = $price1;

        return $this;
    }

    /**
     * Gets price2
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPrice2()
    {
        return $this->container['price2'];
    }

    /**
     * Sets price2
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $price2 price2
     *
     * @return $this
     */
    public function setPrice2($price2)
    {
        $this->container['price2'] = $price2;

        return $this;
    }

    /**
     * Gets price3
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getPrice3()
    {
        return $this->container['price3'];
    }

    /**
     * Sets price3
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $price3 price3
     *
     * @return $this
     */
    public function setPrice3($price3)
    {
        $this->container['price3'] = $price3;

        return $this;
    }

    /**
     * Gets can_deactivate
     *
     * @return bool
     */
    public function getCanDeactivate()
    {
        return $this->container['can_deactivate'];
    }

    /**
     * Sets can_deactivate
     *
     * @param bool $can_deactivate can_deactivate
     *
     * @return $this
     */
    public function setCanDeactivate($can_deactivate)
    {
        $this->container['can_deactivate'] = $can_deactivate;

        return $this;
    }

    /**
     * Gets deactivation_error
     *
     * @return string
     */
    public function getDeactivationError()
    {
        return $this->container['deactivation_error'];
    }

    /**
     * Sets deactivation_error
     *
     * @param string $deactivation_error deactivation_error
     *
     * @return $this
     */
    public function setDeactivationError($deactivation_error)
    {
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
