<?php
/**
 * HelpCenterArticles
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
 * HelpCenterArticles Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class HelpCenterArticles implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'HelpCenterArticles';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'main_article' => '\Learnist\Tripletex\Model\Article',
'relevant_articles' => '\Learnist\Tripletex\Model\Article[]',
'videos' => '\Learnist\Tripletex\Model\Video[]',
'faqs' => '\Learnist\Tripletex\Model\Article[]',
'salesforce_support_requests_url' => 'string',
'help_center_url' => 'string',
'keyboard_shortcuts_article_url' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'main_article' => null,
'relevant_articles' => null,
'videos' => null,
'faqs' => null,
'salesforce_support_requests_url' => null,
'help_center_url' => null,
'keyboard_shortcuts_article_url' => null    ];

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
        'main_article' => 'mainArticle',
'relevant_articles' => 'relevantArticles',
'videos' => 'videos',
'faqs' => 'faqs',
'salesforce_support_requests_url' => 'salesforceSupportRequestsUrl',
'help_center_url' => 'helpCenterUrl',
'keyboard_shortcuts_article_url' => 'keyboardShortcutsArticleUrl'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'main_article' => 'setMainArticle',
'relevant_articles' => 'setRelevantArticles',
'videos' => 'setVideos',
'faqs' => 'setFaqs',
'salesforce_support_requests_url' => 'setSalesforceSupportRequestsUrl',
'help_center_url' => 'setHelpCenterUrl',
'keyboard_shortcuts_article_url' => 'setKeyboardShortcutsArticleUrl'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'main_article' => 'getMainArticle',
'relevant_articles' => 'getRelevantArticles',
'videos' => 'getVideos',
'faqs' => 'getFaqs',
'salesforce_support_requests_url' => 'getSalesforceSupportRequestsUrl',
'help_center_url' => 'getHelpCenterUrl',
'keyboard_shortcuts_article_url' => 'getKeyboardShortcutsArticleUrl'    ];

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
        $this->container['main_article'] = isset($data['main_article']) ? $data['main_article'] : null;
        $this->container['relevant_articles'] = isset($data['relevant_articles']) ? $data['relevant_articles'] : null;
        $this->container['videos'] = isset($data['videos']) ? $data['videos'] : null;
        $this->container['faqs'] = isset($data['faqs']) ? $data['faqs'] : null;
        $this->container['salesforce_support_requests_url'] = isset($data['salesforce_support_requests_url']) ? $data['salesforce_support_requests_url'] : null;
        $this->container['help_center_url'] = isset($data['help_center_url']) ? $data['help_center_url'] : null;
        $this->container['keyboard_shortcuts_article_url'] = isset($data['keyboard_shortcuts_article_url']) ? $data['keyboard_shortcuts_article_url'] : null;
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
     * Gets main_article
     *
     * @return \Learnist\Tripletex\Model\Article
     */
    public function getMainArticle()
    {
        return $this->container['main_article'];
    }

    /**
     * Sets main_article
     *
     * @param \Learnist\Tripletex\Model\Article $main_article main_article
     *
     * @return $this
     */
    public function setMainArticle($main_article)
    {
        $this->container['main_article'] = $main_article;

        return $this;
    }

    /**
     * Gets relevant_articles
     *
     * @return \Learnist\Tripletex\Model\Article[]
     */
    public function getRelevantArticles()
    {
        return $this->container['relevant_articles'];
    }

    /**
     * Sets relevant_articles
     *
     * @param \Learnist\Tripletex\Model\Article[] $relevant_articles relevant_articles
     *
     * @return $this
     */
    public function setRelevantArticles($relevant_articles)
    {
        $this->container['relevant_articles'] = $relevant_articles;

        return $this;
    }

    /**
     * Gets videos
     *
     * @return \Learnist\Tripletex\Model\Video[]
     */
    public function getVideos()
    {
        return $this->container['videos'];
    }

    /**
     * Sets videos
     *
     * @param \Learnist\Tripletex\Model\Video[] $videos videos
     *
     * @return $this
     */
    public function setVideos($videos)
    {
        $this->container['videos'] = $videos;

        return $this;
    }

    /**
     * Gets faqs
     *
     * @return \Learnist\Tripletex\Model\Article[]
     */
    public function getFaqs()
    {
        return $this->container['faqs'];
    }

    /**
     * Sets faqs
     *
     * @param \Learnist\Tripletex\Model\Article[] $faqs faqs
     *
     * @return $this
     */
    public function setFaqs($faqs)
    {
        $this->container['faqs'] = $faqs;

        return $this;
    }

    /**
     * Gets salesforce_support_requests_url
     *
     * @return string
     */
    public function getSalesforceSupportRequestsUrl()
    {
        return $this->container['salesforce_support_requests_url'];
    }

    /**
     * Sets salesforce_support_requests_url
     *
     * @param string $salesforce_support_requests_url salesforce_support_requests_url
     *
     * @return $this
     */
    public function setSalesforceSupportRequestsUrl($salesforce_support_requests_url)
    {
        $this->container['salesforce_support_requests_url'] = $salesforce_support_requests_url;

        return $this;
    }

    /**
     * Gets help_center_url
     *
     * @return string
     */
    public function getHelpCenterUrl()
    {
        return $this->container['help_center_url'];
    }

    /**
     * Sets help_center_url
     *
     * @param string $help_center_url help_center_url
     *
     * @return $this
     */
    public function setHelpCenterUrl($help_center_url)
    {
        $this->container['help_center_url'] = $help_center_url;

        return $this;
    }

    /**
     * Gets keyboard_shortcuts_article_url
     *
     * @return string
     */
    public function getKeyboardShortcutsArticleUrl()
    {
        return $this->container['keyboard_shortcuts_article_url'];
    }

    /**
     * Sets keyboard_shortcuts_article_url
     *
     * @param string $keyboard_shortcuts_article_url keyboard_shortcuts_article_url
     *
     * @return $this
     */
    public function setKeyboardShortcutsArticleUrl($keyboard_shortcuts_article_url)
    {
        $this->container['keyboard_shortcuts_article_url'] = $keyboard_shortcuts_article_url;

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
