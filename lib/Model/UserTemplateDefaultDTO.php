<?php
/**
 * UserTemplateDefaultDTO
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
 * UserTemplateDefaultDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserTemplateDefaultDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'UserTemplateDefaultDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
'description' => 'string',
'template' => 'string',
'colors' => '\Learnist\Tripletex\Model\ColorField[]',
'fields' => 'string[]',
'comments' => '\Learnist\Tripletex\Model\CommentValue[]',
'images' => '\Learnist\Tripletex\Model\ImageValue[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
'description' => null,
'template' => null,
'colors' => null,
'fields' => null,
'comments' => null,
'images' => null    ];

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
        'name' => 'name',
'description' => 'description',
'template' => 'template',
'colors' => 'colors',
'fields' => 'fields',
'comments' => 'comments',
'images' => 'images'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
'description' => 'setDescription',
'template' => 'setTemplate',
'colors' => 'setColors',
'fields' => 'setFields',
'comments' => 'setComments',
'images' => 'setImages'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
'description' => 'getDescription',
'template' => 'getTemplate',
'colors' => 'getColors',
'fields' => 'getFields',
'comments' => 'getComments',
'images' => 'getImages'    ];

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

    const TEMPLATE_SIMPLE = 'SIMPLE';
const TEMPLATE_FANCY = 'FANCY';
const TEMPLATE_PAY_ME_PAYMENT_FOCUS = 'PAY_ME_PAYMENT_FOCUS';
const FIELDS_AMOUNT_TO_PAY_MAJOR = 'AMOUNT_TO_PAY_MAJOR';
const FIELDS_AMOUNT_TO_PAY_MINOR = 'AMOUNT_TO_PAY_MINOR';
const FIELDS_INVOICE_DATE = 'INVOICE_DATE';
const FIELDS_DUE_DATE = 'DUE_DATE';
const FIELDS_INVOICE_NUMBER = 'INVOICE_NUMBER';
const FIELDS_CUSTOMER_NUMBER = 'CUSTOMER_NUMBER';
const FIELDS_OUR_REFERENCE = 'OUR_REFERENCE';
const FIELDS_THEIR_REFERENCE = 'THEIR_REFERENCE';
const FIELDS_ACCOUNT = 'ACCOUNT';
const FIELDS_KID = 'KID';
const FIELDS_ORDER_LINE_SUMMARY_NET = 'ORDER_LINE_SUMMARY_NET';
const FIELDS_ORDER_LINE_SUMMARY_VAT = 'ORDER_LINE_SUMMARY_VAT';
const FIELDS_ORDER_LINE_SUMMARY_TOTAL = 'ORDER_LINE_SUMMARY_TOTAL';
const FIELDS_PROJECT_NAME = 'PROJECT_NAME';
const FIELDS_OUR_CONTACT = 'OUR_CONTACT';
const FIELDS_THEIR_CONTACT = 'THEIR_CONTACT';
const FIELDS_DELIVERY_DATE = 'DELIVERY_DATE';
const FIELDS_DELIVERY_ADDRESS = 'DELIVERY_ADDRESS';
const FIELDS_DELIVERY_TOTAL_WEIGHT = 'DELIVERY_TOTAL_WEIGHT';
const FIELDS_SENDER_NAME = 'SENDER_NAME';
const FIELDS_SENDER_ADDRESS_LINE_1 = 'SENDER_ADDRESS_LINE_1';
const FIELDS_SENDER_ADDRESS_LINE_2 = 'SENDER_ADDRESS_LINE_2';
const FIELDS_SENDER_ZIP_CODE = 'SENDER_ZIP_CODE';
const FIELDS_SENDER_AREA = 'SENDER_AREA';
const FIELDS_SENDER_ORG_NUMBER = 'SENDER_ORG_NUMBER';
const FIELDS_SENDER_PHONE = 'SENDER_PHONE';
const FIELDS_SENDER_EMAIL = 'SENDER_EMAIL';
const FIELDS_SENDER_ZIP_AND_CITY = 'SENDER_ZIP_AND_CITY';
const FIELDS_RECIPIENT_NAME = 'RECIPIENT_NAME';
const FIELDS_RECIPIENT_ADDRESS_LINE_1 = 'RECIPIENT_ADDRESS_LINE_1';
const FIELDS_RECIPIENT_ADDRESS_LINE_2 = 'RECIPIENT_ADDRESS_LINE_2';
const FIELDS_RECIPIENT_ZIP_CODE = 'RECIPIENT_ZIP_CODE';
const FIELDS_RECIPIENT_AREA = 'RECIPIENT_AREA';
const FIELDS_RECIPIENT_ORG_NUMBER = 'RECIPIENT_ORG_NUMBER';
const FIELDS_RECIPIENT_PHONE = 'RECIPIENT_PHONE';
const FIELDS_RECIPIENT_EMAIL = 'RECIPIENT_EMAIL';
const FIELDS_RECIPIENT_ZIP_AND_CITY = 'RECIPIENT_ZIP_AND_CITY';
const FIELDS_OL_PRODUCT_NUMBER = 'OL_PRODUCT_NUMBER';
const FIELDS_OL_DESCRIPTION = 'OL_DESCRIPTION';
const FIELDS_OL_QUANTITY = 'OL_QUANTITY';
const FIELDS_OL_ITEM_COST = 'OL_ITEM_COST';
const FIELDS_OL_VAT = 'OL_VAT';
const FIELDS_OL_NET_SUM = 'OL_NET_SUM';
const FIELDS_OL_DISCOUNT = 'OL_DISCOUNT';
const FIELDS_OL_SURCHARGE = 'OL_SURCHARGE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTemplateAllowableValues()
    {
        return [
            self::TEMPLATE_SIMPLE,
self::TEMPLATE_FANCY,
self::TEMPLATE_PAY_ME_PAYMENT_FOCUS,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getFieldsAllowableValues()
    {
        return [
            self::FIELDS_AMOUNT_TO_PAY_MAJOR,
self::FIELDS_AMOUNT_TO_PAY_MINOR,
self::FIELDS_INVOICE_DATE,
self::FIELDS_DUE_DATE,
self::FIELDS_INVOICE_NUMBER,
self::FIELDS_CUSTOMER_NUMBER,
self::FIELDS_OUR_REFERENCE,
self::FIELDS_THEIR_REFERENCE,
self::FIELDS_ACCOUNT,
self::FIELDS_KID,
self::FIELDS_ORDER_LINE_SUMMARY_NET,
self::FIELDS_ORDER_LINE_SUMMARY_VAT,
self::FIELDS_ORDER_LINE_SUMMARY_TOTAL,
self::FIELDS_PROJECT_NAME,
self::FIELDS_OUR_CONTACT,
self::FIELDS_THEIR_CONTACT,
self::FIELDS_DELIVERY_DATE,
self::FIELDS_DELIVERY_ADDRESS,
self::FIELDS_DELIVERY_TOTAL_WEIGHT,
self::FIELDS_SENDER_NAME,
self::FIELDS_SENDER_ADDRESS_LINE_1,
self::FIELDS_SENDER_ADDRESS_LINE_2,
self::FIELDS_SENDER_ZIP_CODE,
self::FIELDS_SENDER_AREA,
self::FIELDS_SENDER_ORG_NUMBER,
self::FIELDS_SENDER_PHONE,
self::FIELDS_SENDER_EMAIL,
self::FIELDS_SENDER_ZIP_AND_CITY,
self::FIELDS_RECIPIENT_NAME,
self::FIELDS_RECIPIENT_ADDRESS_LINE_1,
self::FIELDS_RECIPIENT_ADDRESS_LINE_2,
self::FIELDS_RECIPIENT_ZIP_CODE,
self::FIELDS_RECIPIENT_AREA,
self::FIELDS_RECIPIENT_ORG_NUMBER,
self::FIELDS_RECIPIENT_PHONE,
self::FIELDS_RECIPIENT_EMAIL,
self::FIELDS_RECIPIENT_ZIP_AND_CITY,
self::FIELDS_OL_PRODUCT_NUMBER,
self::FIELDS_OL_DESCRIPTION,
self::FIELDS_OL_QUANTITY,
self::FIELDS_OL_ITEM_COST,
self::FIELDS_OL_VAT,
self::FIELDS_OL_NET_SUM,
self::FIELDS_OL_DISCOUNT,
self::FIELDS_OL_SURCHARGE,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['template'] = isset($data['template']) ? $data['template'] : null;
        $this->container['colors'] = isset($data['colors']) ? $data['colors'] : null;
        $this->container['fields'] = isset($data['fields']) ? $data['fields'] : null;
        $this->container['comments'] = isset($data['comments']) ? $data['comments'] : null;
        $this->container['images'] = isset($data['images']) ? $data['images'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getTemplateAllowableValues();
        if (!is_null($this->container['template']) && !in_array($this->container['template'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'template', must be one of '%s'",
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
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->container['template'];
    }

    /**
     * Sets template
     *
     * @param string $template template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $allowedValues = $this->getTemplateAllowableValues();
        if (!is_null($template) && !in_array($template, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'template', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['template'] = $template;

        return $this;
    }

    /**
     * Gets colors
     *
     * @return \Learnist\Tripletex\Model\ColorField[]
     */
    public function getColors()
    {
        return $this->container['colors'];
    }

    /**
     * Sets colors
     *
     * @param \Learnist\Tripletex\Model\ColorField[] $colors colors
     *
     * @return $this
     */
    public function setColors($colors)
    {
        $this->container['colors'] = $colors;

        return $this;
    }

    /**
     * Gets fields
     *
     * @return string[]
     */
    public function getFields()
    {
        return $this->container['fields'];
    }

    /**
     * Sets fields
     *
     * @param string[] $fields fields
     *
     * @return $this
     */
    public function setFields($fields)
    {
        $allowedValues = $this->getFieldsAllowableValues();
        if (!is_null($fields) && array_diff($fields, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'fields', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['fields'] = $fields;

        return $this;
    }

    /**
     * Gets comments
     *
     * @return \Learnist\Tripletex\Model\CommentValue[]
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param \Learnist\Tripletex\Model\CommentValue[] $comments comments
     *
     * @return $this
     */
    public function setComments($comments)
    {
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets images
     *
     * @return \Learnist\Tripletex\Model\ImageValue[]
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param \Learnist\Tripletex\Model\ImageValue[] $images images
     *
     * @return $this
     */
    public function setImages($images)
    {
        $this->container['images'] = $images;

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
