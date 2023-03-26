<?php
/**
 * Reminder
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
 * Reminder Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Reminder implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Reminder';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'version' => 'int',
        'changes' => '\Learnist\Tripletex\Model\Change[]',
        'url' => 'string',
        'reminder_date' => 'string',
        'charge' => 'float',
        'charge_currency' => 'float',
        'total_charge' => 'float',
        'total_charge_currency' => 'float',
        'total_amount_currency' => 'float',
        'interests' => 'float',
        'interest_rate' => 'float',
        'term_of_payment' => 'string',
        'currency' => '\Learnist\Tripletex\Model\Currency',
        'type' => 'string',
        'comment' => 'string',
        'kid' => 'string',
        'bank_account_number' => 'string',
        'bank_account_iban' => 'string',
        'bank_account_swift' => 'string',
        'bank' => 'string'
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
        'version' => 'int32',
        'changes' => null,
        'url' => null,
        'reminder_date' => null,
        'charge' => null,
        'charge_currency' => null,
        'total_charge' => null,
        'total_charge_currency' => null,
        'total_amount_currency' => null,
        'interests' => null,
        'interest_rate' => null,
        'term_of_payment' => null,
        'currency' => null,
        'type' => null,
        'comment' => null,
        'kid' => null,
        'bank_account_number' => null,
        'bank_account_iban' => null,
        'bank_account_swift' => null,
        'bank' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'version' => false,
		'changes' => false,
		'url' => false,
		'reminder_date' => false,
		'charge' => false,
		'charge_currency' => false,
		'total_charge' => false,
		'total_charge_currency' => false,
		'total_amount_currency' => false,
		'interests' => false,
		'interest_rate' => false,
		'term_of_payment' => false,
		'currency' => false,
		'type' => false,
		'comment' => false,
		'kid' => false,
		'bank_account_number' => false,
		'bank_account_iban' => false,
		'bank_account_swift' => false,
		'bank' => false
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
        'version' => 'version',
        'changes' => 'changes',
        'url' => 'url',
        'reminder_date' => 'reminderDate',
        'charge' => 'charge',
        'charge_currency' => 'chargeCurrency',
        'total_charge' => 'totalCharge',
        'total_charge_currency' => 'totalChargeCurrency',
        'total_amount_currency' => 'totalAmountCurrency',
        'interests' => 'interests',
        'interest_rate' => 'interestRate',
        'term_of_payment' => 'termOfPayment',
        'currency' => 'currency',
        'type' => 'type',
        'comment' => 'comment',
        'kid' => 'kid',
        'bank_account_number' => 'bankAccountNumber',
        'bank_account_iban' => 'bankAccountIBAN',
        'bank_account_swift' => 'bankAccountSWIFT',
        'bank' => 'bank'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'version' => 'setVersion',
        'changes' => 'setChanges',
        'url' => 'setUrl',
        'reminder_date' => 'setReminderDate',
        'charge' => 'setCharge',
        'charge_currency' => 'setChargeCurrency',
        'total_charge' => 'setTotalCharge',
        'total_charge_currency' => 'setTotalChargeCurrency',
        'total_amount_currency' => 'setTotalAmountCurrency',
        'interests' => 'setInterests',
        'interest_rate' => 'setInterestRate',
        'term_of_payment' => 'setTermOfPayment',
        'currency' => 'setCurrency',
        'type' => 'setType',
        'comment' => 'setComment',
        'kid' => 'setKid',
        'bank_account_number' => 'setBankAccountNumber',
        'bank_account_iban' => 'setBankAccountIban',
        'bank_account_swift' => 'setBankAccountSwift',
        'bank' => 'setBank'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'version' => 'getVersion',
        'changes' => 'getChanges',
        'url' => 'getUrl',
        'reminder_date' => 'getReminderDate',
        'charge' => 'getCharge',
        'charge_currency' => 'getChargeCurrency',
        'total_charge' => 'getTotalCharge',
        'total_charge_currency' => 'getTotalChargeCurrency',
        'total_amount_currency' => 'getTotalAmountCurrency',
        'interests' => 'getInterests',
        'interest_rate' => 'getInterestRate',
        'term_of_payment' => 'getTermOfPayment',
        'currency' => 'getCurrency',
        'type' => 'getType',
        'comment' => 'getComment',
        'kid' => 'getKid',
        'bank_account_number' => 'getBankAccountNumber',
        'bank_account_iban' => 'getBankAccountIban',
        'bank_account_swift' => 'getBankAccountSwift',
        'bank' => 'getBank'
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

    public const TYPE_SOFT_REMINDER = 'SOFT_REMINDER';
    public const TYPE_REMINDER = 'REMINDER';
    public const TYPE_NOTICE_OF_DEBT_COLLECTION = 'NOTICE_OF_DEBT_COLLECTION';
    public const TYPE_DEBT_COLLECTION = 'DEBT_COLLECTION';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_SOFT_REMINDER,
            self::TYPE_REMINDER,
            self::TYPE_NOTICE_OF_DEBT_COLLECTION,
            self::TYPE_DEBT_COLLECTION,
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('reminder_date', $data ?? [], null);
        $this->setIfExists('charge', $data ?? [], null);
        $this->setIfExists('charge_currency', $data ?? [], null);
        $this->setIfExists('total_charge', $data ?? [], null);
        $this->setIfExists('total_charge_currency', $data ?? [], null);
        $this->setIfExists('total_amount_currency', $data ?? [], null);
        $this->setIfExists('interests', $data ?? [], null);
        $this->setIfExists('interest_rate', $data ?? [], null);
        $this->setIfExists('term_of_payment', $data ?? [], null);
        $this->setIfExists('currency', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('comment', $data ?? [], null);
        $this->setIfExists('kid', $data ?? [], null);
        $this->setIfExists('bank_account_number', $data ?? [], null);
        $this->setIfExists('bank_account_iban', $data ?? [], null);
        $this->setIfExists('bank_account_swift', $data ?? [], null);
        $this->setIfExists('bank', $data ?? [], null);
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

        if ($this->container['term_of_payment'] === null) {
            $invalidProperties[] = "'term_of_payment' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['kid']) && (mb_strlen($this->container['kid']) > 25)) {
            $invalidProperties[] = "invalid value for 'kid', the character length must be smaller than or equal to 25.";
        }

        if (!is_null($this->container['bank_account_number']) && (mb_strlen($this->container['bank_account_number']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_account_number', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank_account_iban']) && (mb_strlen($this->container['bank_account_iban']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_account_iban', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank_account_swift']) && (mb_strlen($this->container['bank_account_swift']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank_account_swift', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['bank']) && (mb_strlen($this->container['bank']) > 255)) {
            $invalidProperties[] = "invalid value for 'bank', the character length must be smaller than or equal to 255.";
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
     * Gets version
     *
     * @return int|null
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int|null $version version
     *
     * @return self
     */
    public function setVersion($version)
    {
        if (is_null($version)) {
            throw new \InvalidArgumentException('non-nullable version cannot be null');
        }
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return \Learnist\Tripletex\Model\Change[]|null
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param \Learnist\Tripletex\Model\Change[]|null $changes changes
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
     * Gets url
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string|null $url url
     *
     * @return self
     */
    public function setUrl($url)
    {
        if (is_null($url)) {
            throw new \InvalidArgumentException('non-nullable url cannot be null');
        }
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets reminder_date
     *
     * @return string|null
     */
    public function getReminderDate()
    {
        return $this->container['reminder_date'];
    }

    /**
     * Sets reminder_date
     *
     * @param string|null $reminder_date Creation date of the invoice reminder.
     *
     * @return self
     */
    public function setReminderDate($reminder_date)
    {
        if (is_null($reminder_date)) {
            throw new \InvalidArgumentException('non-nullable reminder_date cannot be null');
        }
        $this->container['reminder_date'] = $reminder_date;

        return $this;
    }

    /**
     * Gets charge
     *
     * @return float|null
     */
    public function getCharge()
    {
        return $this->container['charge'];
    }

    /**
     * Sets charge
     *
     * @param float|null $charge The fee part of the reminder, in the company's currency.
     *
     * @return self
     */
    public function setCharge($charge)
    {
        if (is_null($charge)) {
            throw new \InvalidArgumentException('non-nullable charge cannot be null');
        }
        $this->container['charge'] = $charge;

        return $this;
    }

    /**
     * Gets charge_currency
     *
     * @return float|null
     */
    public function getChargeCurrency()
    {
        return $this->container['charge_currency'];
    }

    /**
     * Sets charge_currency
     *
     * @param float|null $charge_currency The fee part of the reminder, in the invoice currency.
     *
     * @return self
     */
    public function setChargeCurrency($charge_currency)
    {
        if (is_null($charge_currency)) {
            throw new \InvalidArgumentException('non-nullable charge_currency cannot be null');
        }
        $this->container['charge_currency'] = $charge_currency;

        return $this;
    }

    /**
     * Gets total_charge
     *
     * @return float|null
     */
    public function getTotalCharge()
    {
        return $this->container['total_charge'];
    }

    /**
     * Sets total_charge
     *
     * @param float|null $total_charge The total fee part of all reminders, in the company's currency.
     *
     * @return self
     */
    public function setTotalCharge($total_charge)
    {
        if (is_null($total_charge)) {
            throw new \InvalidArgumentException('non-nullable total_charge cannot be null');
        }
        $this->container['total_charge'] = $total_charge;

        return $this;
    }

    /**
     * Gets total_charge_currency
     *
     * @return float|null
     */
    public function getTotalChargeCurrency()
    {
        return $this->container['total_charge_currency'];
    }

    /**
     * Sets total_charge_currency
     *
     * @param float|null $total_charge_currency The total fee part of all reminders, in the invoice currency.
     *
     * @return self
     */
    public function setTotalChargeCurrency($total_charge_currency)
    {
        if (is_null($total_charge_currency)) {
            throw new \InvalidArgumentException('non-nullable total_charge_currency cannot be null');
        }
        $this->container['total_charge_currency'] = $total_charge_currency;

        return $this;
    }

    /**
     * Gets total_amount_currency
     *
     * @return float|null
     */
    public function getTotalAmountCurrency()
    {
        return $this->container['total_amount_currency'];
    }

    /**
     * Sets total_amount_currency
     *
     * @param float|null $total_amount_currency The total amount to pay in reminder's currency.
     *
     * @return self
     */
    public function setTotalAmountCurrency($total_amount_currency)
    {
        if (is_null($total_amount_currency)) {
            throw new \InvalidArgumentException('non-nullable total_amount_currency cannot be null');
        }
        $this->container['total_amount_currency'] = $total_amount_currency;

        return $this;
    }

    /**
     * Gets interests
     *
     * @return float|null
     */
    public function getInterests()
    {
        return $this->container['interests'];
    }

    /**
     * Sets interests
     *
     * @param float|null $interests The interests part of the reminder.
     *
     * @return self
     */
    public function setInterests($interests)
    {
        if (is_null($interests)) {
            throw new \InvalidArgumentException('non-nullable interests cannot be null');
        }
        $this->container['interests'] = $interests;

        return $this;
    }

    /**
     * Gets interest_rate
     *
     * @return float|null
     */
    public function getInterestRate()
    {
        return $this->container['interest_rate'];
    }

    /**
     * Sets interest_rate
     *
     * @param float|null $interest_rate The reminder interest rate.
     *
     * @return self
     */
    public function setInterestRate($interest_rate)
    {
        if (is_null($interest_rate)) {
            throw new \InvalidArgumentException('non-nullable interest_rate cannot be null');
        }
        $this->container['interest_rate'] = $interest_rate;

        return $this;
    }

    /**
     * Gets term_of_payment
     *
     * @return string
     */
    public function getTermOfPayment()
    {
        return $this->container['term_of_payment'];
    }

    /**
     * Sets term_of_payment
     *
     * @param string $term_of_payment The reminder term of payment date.
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
     * Gets currency
     *
     * @return \Learnist\Tripletex\Model\Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param \Learnist\Tripletex\Model\Currency|null $currency currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        if (is_null($currency)) {
            throw new \InvalidArgumentException('non-nullable currency cannot be null');
        }
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets comment
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     *
     * @param string|null $comment comment
     *
     * @return self
     */
    public function setComment($comment)
    {
        if (is_null($comment)) {
            throw new \InvalidArgumentException('non-nullable comment cannot be null');
        }
        $this->container['comment'] = $comment;

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
     * @param string|null $kid KID - Kundeidentifikasjonsnummer.
     *
     * @return self
     */
    public function setKid($kid)
    {
        if (is_null($kid)) {
            throw new \InvalidArgumentException('non-nullable kid cannot be null');
        }
        if ((mb_strlen($kid) > 25)) {
            throw new \InvalidArgumentException('invalid length for $kid when calling Reminder., must be smaller than or equal to 25.');
        }

        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets bank_account_number
     *
     * @return string|null
     */
    public function getBankAccountNumber()
    {
        return $this->container['bank_account_number'];
    }

    /**
     * Sets bank_account_number
     *
     * @param string|null $bank_account_number bank_account_number
     *
     * @return self
     */
    public function setBankAccountNumber($bank_account_number)
    {
        if (is_null($bank_account_number)) {
            throw new \InvalidArgumentException('non-nullable bank_account_number cannot be null');
        }
        if ((mb_strlen($bank_account_number) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_number when calling Reminder., must be smaller than or equal to 255.');
        }

        $this->container['bank_account_number'] = $bank_account_number;

        return $this;
    }

    /**
     * Gets bank_account_iban
     *
     * @return string|null
     */
    public function getBankAccountIban()
    {
        return $this->container['bank_account_iban'];
    }

    /**
     * Sets bank_account_iban
     *
     * @param string|null $bank_account_iban bank_account_iban
     *
     * @return self
     */
    public function setBankAccountIban($bank_account_iban)
    {
        if (is_null($bank_account_iban)) {
            throw new \InvalidArgumentException('non-nullable bank_account_iban cannot be null');
        }
        if ((mb_strlen($bank_account_iban) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_iban when calling Reminder., must be smaller than or equal to 255.');
        }

        $this->container['bank_account_iban'] = $bank_account_iban;

        return $this;
    }

    /**
     * Gets bank_account_swift
     *
     * @return string|null
     */
    public function getBankAccountSwift()
    {
        return $this->container['bank_account_swift'];
    }

    /**
     * Sets bank_account_swift
     *
     * @param string|null $bank_account_swift bank_account_swift
     *
     * @return self
     */
    public function setBankAccountSwift($bank_account_swift)
    {
        if (is_null($bank_account_swift)) {
            throw new \InvalidArgumentException('non-nullable bank_account_swift cannot be null');
        }
        if ((mb_strlen($bank_account_swift) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank_account_swift when calling Reminder., must be smaller than or equal to 255.');
        }

        $this->container['bank_account_swift'] = $bank_account_swift;

        return $this;
    }

    /**
     * Gets bank
     *
     * @return string|null
     */
    public function getBank()
    {
        return $this->container['bank'];
    }

    /**
     * Sets bank
     *
     * @param string|null $bank bank
     *
     * @return self
     */
    public function setBank($bank)
    {
        if (is_null($bank)) {
            throw new \InvalidArgumentException('non-nullable bank cannot be null');
        }
        if ((mb_strlen($bank) > 255)) {
            throw new \InvalidArgumentException('invalid length for $bank when calling Reminder., must be smaller than or equal to 255.');
        }

        $this->container['bank'] = $bank;

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


