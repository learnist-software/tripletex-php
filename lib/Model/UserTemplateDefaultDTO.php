<?php
/**
 * UserTemplateDefaultDTO
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
 * UserTemplateDefaultDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class UserTemplateDefaultDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'UserTemplateDefaultDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'description' => 'string',
        'template' => 'string',
        'colors' => '\Learnist\Tripletex\Model\ColorField[]',
        'fields' => 'string[]',
        'comments' => '\Learnist\Tripletex\Model\CommentValue[]',
        'images' => '\Learnist\Tripletex\Model\ImageValue[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'description' => null,
        'template' => null,
        'colors' => null,
        'fields' => null,
        'comments' => null,
        'images' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
		'description' => false,
		'template' => false,
		'colors' => false,
		'fields' => false,
		'comments' => false,
		'images' => false
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
        'name' => 'name',
        'description' => 'description',
        'template' => 'template',
        'colors' => 'colors',
        'fields' => 'fields',
        'comments' => 'comments',
        'images' => 'images'
    ];

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
        'images' => 'setImages'
    ];

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
        'images' => 'getImages'
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

    public const TEMPLATE_SIMPLE = 'SIMPLE';
    public const TEMPLATE_FANCY = 'FANCY';
    public const TEMPLATE_PAY_ME_PAYMENT_FOCUS = 'PAY_ME_PAYMENT_FOCUS';
    public const FIELDS_AMOUNT_TO_PAY_MAJOR = 'AMOUNT_TO_PAY_MAJOR';
    public const FIELDS_AMOUNT_TO_PAY_MINOR = 'AMOUNT_TO_PAY_MINOR';
    public const FIELDS_INVOICE_DATE = 'INVOICE_DATE';
    public const FIELDS_DUE_DATE = 'DUE_DATE';
    public const FIELDS_INVOICE_NUMBER = 'INVOICE_NUMBER';
    public const FIELDS_CUSTOMER_NUMBER = 'CUSTOMER_NUMBER';
    public const FIELDS_OUR_REFERENCE = 'OUR_REFERENCE';
    public const FIELDS_THEIR_REFERENCE = 'THEIR_REFERENCE';
    public const FIELDS_ACCOUNT = 'ACCOUNT';
    public const FIELDS_KID = 'KID';
    public const FIELDS_ORDER_LINE_SUMMARY_NET = 'ORDER_LINE_SUMMARY_NET';
    public const FIELDS_ORDER_LINE_SUMMARY_VAT = 'ORDER_LINE_SUMMARY_VAT';
    public const FIELDS_ORDER_LINE_SUMMARY_TOTAL = 'ORDER_LINE_SUMMARY_TOTAL';
    public const FIELDS_PROJECT_NAME = 'PROJECT_NAME';
    public const FIELDS_OUR_CONTACT = 'OUR_CONTACT';
    public const FIELDS_THEIR_CONTACT = 'THEIR_CONTACT';
    public const FIELDS_DELIVERY_DATE = 'DELIVERY_DATE';
    public const FIELDS_DELIVERY_ADDRESS = 'DELIVERY_ADDRESS';
    public const FIELDS_DELIVERY_TOTAL_WEIGHT = 'DELIVERY_TOTAL_WEIGHT';
    public const FIELDS_SENDER_NAME = 'SENDER_NAME';
    public const FIELDS_SENDER_ADDRESS_LINE_1 = 'SENDER_ADDRESS_LINE_1';
    public const FIELDS_SENDER_ADDRESS_LINE_2 = 'SENDER_ADDRESS_LINE_2';
    public const FIELDS_SENDER_ZIP_CODE = 'SENDER_ZIP_CODE';
    public const FIELDS_SENDER_AREA = 'SENDER_AREA';
    public const FIELDS_SENDER_ORG_NUMBER = 'SENDER_ORG_NUMBER';
    public const FIELDS_SENDER_PHONE = 'SENDER_PHONE';
    public const FIELDS_SENDER_EMAIL = 'SENDER_EMAIL';
    public const FIELDS_SENDER_ZIP_AND_CITY = 'SENDER_ZIP_AND_CITY';
    public const FIELDS_RECIPIENT_NAME = 'RECIPIENT_NAME';
    public const FIELDS_RECIPIENT_ADDRESS_LINE_1 = 'RECIPIENT_ADDRESS_LINE_1';
    public const FIELDS_RECIPIENT_ADDRESS_LINE_2 = 'RECIPIENT_ADDRESS_LINE_2';
    public const FIELDS_RECIPIENT_ZIP_CODE = 'RECIPIENT_ZIP_CODE';
    public const FIELDS_RECIPIENT_AREA = 'RECIPIENT_AREA';
    public const FIELDS_RECIPIENT_ORG_NUMBER = 'RECIPIENT_ORG_NUMBER';
    public const FIELDS_RECIPIENT_PHONE = 'RECIPIENT_PHONE';
    public const FIELDS_RECIPIENT_EMAIL = 'RECIPIENT_EMAIL';
    public const FIELDS_RECIPIENT_ZIP_AND_CITY = 'RECIPIENT_ZIP_AND_CITY';
    public const FIELDS_OL_PRODUCT_NUMBER = 'OL_PRODUCT_NUMBER';
    public const FIELDS_OL_DESCRIPTION = 'OL_DESCRIPTION';
    public const FIELDS_OL_QUANTITY = 'OL_QUANTITY';
    public const FIELDS_OL_ITEM_COST = 'OL_ITEM_COST';
    public const FIELDS_OL_VAT = 'OL_VAT';
    public const FIELDS_OL_NET_SUM = 'OL_NET_SUM';
    public const FIELDS_OL_DISCOUNT = 'OL_DISCOUNT';
    public const FIELDS_OL_SURCHARGE = 'OL_SURCHARGE';

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
            self::TEMPLATE_PAY_ME_PAYMENT_FOCUS,
        ];
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
            self::FIELDS_OL_SURCHARGE,
        ];
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('template', $data ?? [], null);
        $this->setIfExists('colors', $data ?? [], null);
        $this->setIfExists('fields', $data ?? [], null);
        $this->setIfExists('comments', $data ?? [], null);
        $this->setIfExists('images', $data ?? [], null);
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

        $allowedValues = $this->getTemplateAllowableValues();
        if (!is_null($this->container['template']) && !in_array($this->container['template'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'template', must be one of '%s'",
                $this->container['template'],
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
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description description
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets template
     *
     * @return string|null
     */
    public function getTemplate()
    {
        return $this->container['template'];
    }

    /**
     * Sets template
     *
     * @param string|null $template template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        if (is_null($template)) {
            throw new \InvalidArgumentException('non-nullable template cannot be null');
        }
        $allowedValues = $this->getTemplateAllowableValues();
        if (!in_array($template, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'template', must be one of '%s'",
                    $template,
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
     * @return \Learnist\Tripletex\Model\ColorField[]|null
     */
    public function getColors()
    {
        return $this->container['colors'];
    }

    /**
     * Sets colors
     *
     * @param \Learnist\Tripletex\Model\ColorField[]|null $colors colors
     *
     * @return self
     */
    public function setColors($colors)
    {
        if (is_null($colors)) {
            throw new \InvalidArgumentException('non-nullable colors cannot be null');
        }
        $this->container['colors'] = $colors;

        return $this;
    }

    /**
     * Gets fields
     *
     * @return string[]|null
     */
    public function getFields()
    {
        return $this->container['fields'];
    }

    /**
     * Sets fields
     *
     * @param string[]|null $fields fields
     *
     * @return self
     */
    public function setFields($fields)
    {
        if (is_null($fields)) {
            throw new \InvalidArgumentException('non-nullable fields cannot be null');
        }
        $allowedValues = $this->getFieldsAllowableValues();
        if (array_diff($fields, $allowedValues)) {
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
     * @return \Learnist\Tripletex\Model\CommentValue[]|null
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments
     *
     * @param \Learnist\Tripletex\Model\CommentValue[]|null $comments comments
     *
     * @return self
     */
    public function setComments($comments)
    {
        if (is_null($comments)) {
            throw new \InvalidArgumentException('non-nullable comments cannot be null');
        }
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets images
     *
     * @return \Learnist\Tripletex\Model\ImageValue[]|null
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param \Learnist\Tripletex\Model\ImageValue[]|null $images images
     *
     * @return self
     */
    public function setImages($images)
    {
        if (is_null($images)) {
            throw new \InvalidArgumentException('non-nullable images cannot be null');
        }
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


