<?php
/**
 * InvoiceOrderLineDTO
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
 * InvoiceOrderLineDTO Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class InvoiceOrderLineDTO implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceOrderLineDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'invoice_number' => 'string',
        'kid' => 'string',
        'date' => '\DateTime',
        'term_of_payment' => '\DateTime',
        'amount_currency' => 'object',
        'amount_currency_outstanding' => 'object',
        'is_reminder' => 'bool',
        'is_last_reminder' => 'bool',
        'last_reminder_type' => 'int',
        'has_credit_note' => 'bool',
        'reminder_type' => 'int',
        'reminder_type_description' => 'string',
        'status_text' => 'string'
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
        'invoice_number' => null,
        'kid' => null,
        'date' => 'date-time',
        'term_of_payment' => 'date-time',
        'amount_currency' => null,
        'amount_currency_outstanding' => null,
        'is_reminder' => null,
        'is_last_reminder' => null,
        'last_reminder_type' => 'int32',
        'has_credit_note' => null,
        'reminder_type' => 'int32',
        'reminder_type_description' => null,
        'status_text' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'invoice_number' => false,
		'kid' => false,
		'date' => false,
		'term_of_payment' => false,
		'amount_currency' => false,
		'amount_currency_outstanding' => false,
		'is_reminder' => false,
		'is_last_reminder' => false,
		'last_reminder_type' => false,
		'has_credit_note' => false,
		'reminder_type' => false,
		'reminder_type_description' => false,
		'status_text' => false
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
        'invoice_number' => 'invoiceNumber',
        'kid' => 'kid',
        'date' => 'date',
        'term_of_payment' => 'termOfPayment',
        'amount_currency' => 'amountCurrency',
        'amount_currency_outstanding' => 'amountCurrencyOutstanding',
        'is_reminder' => 'isReminder',
        'is_last_reminder' => 'isLastReminder',
        'last_reminder_type' => 'lastReminderType',
        'has_credit_note' => 'hasCreditNote',
        'reminder_type' => 'reminderType',
        'reminder_type_description' => 'reminderTypeDescription',
        'status_text' => 'statusText'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'invoice_number' => 'setInvoiceNumber',
        'kid' => 'setKid',
        'date' => 'setDate',
        'term_of_payment' => 'setTermOfPayment',
        'amount_currency' => 'setAmountCurrency',
        'amount_currency_outstanding' => 'setAmountCurrencyOutstanding',
        'is_reminder' => 'setIsReminder',
        'is_last_reminder' => 'setIsLastReminder',
        'last_reminder_type' => 'setLastReminderType',
        'has_credit_note' => 'setHasCreditNote',
        'reminder_type' => 'setReminderType',
        'reminder_type_description' => 'setReminderTypeDescription',
        'status_text' => 'setStatusText'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'invoice_number' => 'getInvoiceNumber',
        'kid' => 'getKid',
        'date' => 'getDate',
        'term_of_payment' => 'getTermOfPayment',
        'amount_currency' => 'getAmountCurrency',
        'amount_currency_outstanding' => 'getAmountCurrencyOutstanding',
        'is_reminder' => 'getIsReminder',
        'is_last_reminder' => 'getIsLastReminder',
        'last_reminder_type' => 'getLastReminderType',
        'has_credit_note' => 'getHasCreditNote',
        'reminder_type' => 'getReminderType',
        'reminder_type_description' => 'getReminderTypeDescription',
        'status_text' => 'getStatusText'
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
        $this->setIfExists('invoice_number', $data ?? [], null);
        $this->setIfExists('kid', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('term_of_payment', $data ?? [], null);
        $this->setIfExists('amount_currency', $data ?? [], null);
        $this->setIfExists('amount_currency_outstanding', $data ?? [], null);
        $this->setIfExists('is_reminder', $data ?? [], null);
        $this->setIfExists('is_last_reminder', $data ?? [], null);
        $this->setIfExists('last_reminder_type', $data ?? [], null);
        $this->setIfExists('has_credit_note', $data ?? [], null);
        $this->setIfExists('reminder_type', $data ?? [], null);
        $this->setIfExists('reminder_type_description', $data ?? [], null);
        $this->setIfExists('status_text', $data ?? [], null);
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
     * Gets invoice_number
     *
     * @return string|null
     */
    public function getInvoiceNumber()
    {
        return $this->container['invoice_number'];
    }

    /**
     * Sets invoice_number
     *
     * @param string|null $invoice_number invoice_number
     *
     * @return self
     */
    public function setInvoiceNumber($invoice_number)
    {
        if (is_null($invoice_number)) {
            throw new \InvalidArgumentException('non-nullable invoice_number cannot be null');
        }
        $this->container['invoice_number'] = $invoice_number;

        return $this;
    }

    /**
     * Gets kid
     *
     * @return string|null
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string|null $kid kid
     *
     * @return self
     */
    public function setKid($kid)
    {
        if (is_null($kid)) {
            throw new \InvalidArgumentException('non-nullable kid cannot be null');
        }
        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets date
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param \DateTime|null $date date
     *
     * @return self
     */
    public function setDate($date)
    {
        if (is_null($date)) {
            throw new \InvalidArgumentException('non-nullable date cannot be null');
        }
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets term_of_payment
     *
     * @return \DateTime|null
     */
    public function getTermOfPayment()
    {
        return $this->container['term_of_payment'];
    }

    /**
     * Sets term_of_payment
     *
     * @param \DateTime|null $term_of_payment term_of_payment
     *
     * @return self
     */
    public function setTermOfPayment($term_of_payment)
    {
        if (is_null($term_of_payment)) {
            throw new \InvalidArgumentException('non-nullable term_of_payment cannot be null');
        }
        $this->container['term_of_payment'] = $term_of_payment;

        return $this;
    }

    /**
     * Gets amount_currency
     *
     * @return object|null
     */
    public function getAmountCurrency()
    {
        return $this->container['amount_currency'];
    }

    /**
     * Sets amount_currency
     *
     * @param object|null $amount_currency amount_currency
     *
     * @return self
     */
    public function setAmountCurrency($amount_currency)
    {
        if (is_null($amount_currency)) {
            throw new \InvalidArgumentException('non-nullable amount_currency cannot be null');
        }
        $this->container['amount_currency'] = $amount_currency;

        return $this;
    }

    /**
     * Gets amount_currency_outstanding
     *
     * @return object|null
     */
    public function getAmountCurrencyOutstanding()
    {
        return $this->container['amount_currency_outstanding'];
    }

    /**
     * Sets amount_currency_outstanding
     *
     * @param object|null $amount_currency_outstanding amount_currency_outstanding
     *
     * @return self
     */
    public function setAmountCurrencyOutstanding($amount_currency_outstanding)
    {
        if (is_null($amount_currency_outstanding)) {
            throw new \InvalidArgumentException('non-nullable amount_currency_outstanding cannot be null');
        }
        $this->container['amount_currency_outstanding'] = $amount_currency_outstanding;

        return $this;
    }

    /**
     * Gets is_reminder
     *
     * @return bool|null
     */
    public function getIsReminder()
    {
        return $this->container['is_reminder'];
    }

    /**
     * Sets is_reminder
     *
     * @param bool|null $is_reminder is_reminder
     *
     * @return self
     */
    public function setIsReminder($is_reminder)
    {
        if (is_null($is_reminder)) {
            throw new \InvalidArgumentException('non-nullable is_reminder cannot be null');
        }
        $this->container['is_reminder'] = $is_reminder;

        return $this;
    }

    /**
     * Gets is_last_reminder
     *
     * @return bool|null
     */
    public function getIsLastReminder()
    {
        return $this->container['is_last_reminder'];
    }

    /**
     * Sets is_last_reminder
     *
     * @param bool|null $is_last_reminder is_last_reminder
     *
     * @return self
     */
    public function setIsLastReminder($is_last_reminder)
    {
        if (is_null($is_last_reminder)) {
            throw new \InvalidArgumentException('non-nullable is_last_reminder cannot be null');
        }
        $this->container['is_last_reminder'] = $is_last_reminder;

        return $this;
    }

    /**
     * Gets last_reminder_type
     *
     * @return int|null
     */
    public function getLastReminderType()
    {
        return $this->container['last_reminder_type'];
    }

    /**
     * Sets last_reminder_type
     *
     * @param int|null $last_reminder_type last_reminder_type
     *
     * @return self
     */
    public function setLastReminderType($last_reminder_type)
    {
        if (is_null($last_reminder_type)) {
            throw new \InvalidArgumentException('non-nullable last_reminder_type cannot be null');
        }
        $this->container['last_reminder_type'] = $last_reminder_type;

        return $this;
    }

    /**
     * Gets has_credit_note
     *
     * @return bool|null
     */
    public function getHasCreditNote()
    {
        return $this->container['has_credit_note'];
    }

    /**
     * Sets has_credit_note
     *
     * @param bool|null $has_credit_note has_credit_note
     *
     * @return self
     */
    public function setHasCreditNote($has_credit_note)
    {
        if (is_null($has_credit_note)) {
            throw new \InvalidArgumentException('non-nullable has_credit_note cannot be null');
        }
        $this->container['has_credit_note'] = $has_credit_note;

        return $this;
    }

    /**
     * Gets reminder_type
     *
     * @return int|null
     */
    public function getReminderType()
    {
        return $this->container['reminder_type'];
    }

    /**
     * Sets reminder_type
     *
     * @param int|null $reminder_type reminder_type
     *
     * @return self
     */
    public function setReminderType($reminder_type)
    {
        if (is_null($reminder_type)) {
            throw new \InvalidArgumentException('non-nullable reminder_type cannot be null');
        }
        $this->container['reminder_type'] = $reminder_type;

        return $this;
    }

    /**
     * Gets reminder_type_description
     *
     * @return string|null
     */
    public function getReminderTypeDescription()
    {
        return $this->container['reminder_type_description'];
    }

    /**
     * Sets reminder_type_description
     *
     * @param string|null $reminder_type_description reminder_type_description
     *
     * @return self
     */
    public function setReminderTypeDescription($reminder_type_description)
    {
        if (is_null($reminder_type_description)) {
            throw new \InvalidArgumentException('non-nullable reminder_type_description cannot be null');
        }
        $this->container['reminder_type_description'] = $reminder_type_description;

        return $this;
    }

    /**
     * Gets status_text
     *
     * @return string|null
     */
    public function getStatusText()
    {
        return $this->container['status_text'];
    }

    /**
     * Sets status_text
     *
     * @param string|null $status_text status_text
     *
     * @return self
     */
    public function setStatusText($status_text)
    {
        if (is_null($status_text)) {
            throw new \InvalidArgumentException('non-nullable status_text cannot be null');
        }
        $this->container['status_text'] = $status_text;

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


