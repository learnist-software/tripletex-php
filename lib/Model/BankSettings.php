<?php
/**
 * BankSettings
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
 * BankSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class BankSettings implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'BankSettings';

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
        'tax_bank_agreement' => '\Learnist\Tripletex\Model\AutopayBankAgreement',
        'remit_number_of_acceptors' => 'int',
        'show_advice_currency_mismatch' => 'bool',
        'payment_with_unknown_kid_parse_option' => 'string',
        'sign_auto_pay_with_bank_id' => 'bool',
        'batch_booking_of_payments' => 'bool',
        'parse_entries_as_sum_posts' => 'bool',
        'employees_with_direct_remit_access' => '\Learnist\Tripletex\Model\Employee[]',
        'days_before_payment_outdated' => 'int'
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
        'tax_bank_agreement' => null,
        'remit_number_of_acceptors' => 'int32',
        'show_advice_currency_mismatch' => null,
        'payment_with_unknown_kid_parse_option' => null,
        'sign_auto_pay_with_bank_id' => null,
        'batch_booking_of_payments' => null,
        'parse_entries_as_sum_posts' => null,
        'employees_with_direct_remit_access' => null,
        'days_before_payment_outdated' => 'int32'
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
		'tax_bank_agreement' => false,
		'remit_number_of_acceptors' => false,
		'show_advice_currency_mismatch' => false,
		'payment_with_unknown_kid_parse_option' => false,
		'sign_auto_pay_with_bank_id' => false,
		'batch_booking_of_payments' => false,
		'parse_entries_as_sum_posts' => false,
		'employees_with_direct_remit_access' => false,
		'days_before_payment_outdated' => false
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
        'tax_bank_agreement' => 'taxBankAgreement',
        'remit_number_of_acceptors' => 'remitNumberOfAcceptors',
        'show_advice_currency_mismatch' => 'showAdviceCurrencyMismatch',
        'payment_with_unknown_kid_parse_option' => 'paymentWithUnknownKidParseOption',
        'sign_auto_pay_with_bank_id' => 'signAutoPayWithBankId',
        'batch_booking_of_payments' => 'batchBookingOfPayments',
        'parse_entries_as_sum_posts' => 'parseEntriesAsSumPosts',
        'employees_with_direct_remit_access' => 'employeesWithDirectRemitAccess',
        'days_before_payment_outdated' => 'daysBeforePaymentOutdated'
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
        'tax_bank_agreement' => 'setTaxBankAgreement',
        'remit_number_of_acceptors' => 'setRemitNumberOfAcceptors',
        'show_advice_currency_mismatch' => 'setShowAdviceCurrencyMismatch',
        'payment_with_unknown_kid_parse_option' => 'setPaymentWithUnknownKidParseOption',
        'sign_auto_pay_with_bank_id' => 'setSignAutoPayWithBankId',
        'batch_booking_of_payments' => 'setBatchBookingOfPayments',
        'parse_entries_as_sum_posts' => 'setParseEntriesAsSumPosts',
        'employees_with_direct_remit_access' => 'setEmployeesWithDirectRemitAccess',
        'days_before_payment_outdated' => 'setDaysBeforePaymentOutdated'
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
        'tax_bank_agreement' => 'getTaxBankAgreement',
        'remit_number_of_acceptors' => 'getRemitNumberOfAcceptors',
        'show_advice_currency_mismatch' => 'getShowAdviceCurrencyMismatch',
        'payment_with_unknown_kid_parse_option' => 'getPaymentWithUnknownKidParseOption',
        'sign_auto_pay_with_bank_id' => 'getSignAutoPayWithBankId',
        'batch_booking_of_payments' => 'getBatchBookingOfPayments',
        'parse_entries_as_sum_posts' => 'getParseEntriesAsSumPosts',
        'employees_with_direct_remit_access' => 'getEmployeesWithDirectRemitAccess',
        'days_before_payment_outdated' => 'getDaysBeforePaymentOutdated'
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

    public const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_VOUCHER_RECEPTION = 'VOUCHER_RECEPTION';
    public const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_PARSE = 'PARSE';
    public const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_IGNORE = 'IGNORE';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentWithUnknownKidParseOptionAllowableValues()
    {
        return [
            self::PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_VOUCHER_RECEPTION,
            self::PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_PARSE,
            self::PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_IGNORE,
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
        $this->setIfExists('tax_bank_agreement', $data ?? [], null);
        $this->setIfExists('remit_number_of_acceptors', $data ?? [], null);
        $this->setIfExists('show_advice_currency_mismatch', $data ?? [], null);
        $this->setIfExists('payment_with_unknown_kid_parse_option', $data ?? [], null);
        $this->setIfExists('sign_auto_pay_with_bank_id', $data ?? [], null);
        $this->setIfExists('batch_booking_of_payments', $data ?? [], null);
        $this->setIfExists('parse_entries_as_sum_posts', $data ?? [], null);
        $this->setIfExists('employees_with_direct_remit_access', $data ?? [], null);
        $this->setIfExists('days_before_payment_outdated', $data ?? [], null);
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

        if (!is_null($this->container['remit_number_of_acceptors']) && ($this->container['remit_number_of_acceptors'] < 1)) {
            $invalidProperties[] = "invalid value for 'remit_number_of_acceptors', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getPaymentWithUnknownKidParseOptionAllowableValues();
        if (!is_null($this->container['payment_with_unknown_kid_parse_option']) && !in_array($this->container['payment_with_unknown_kid_parse_option'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_with_unknown_kid_parse_option', must be one of '%s'",
                $this->container['payment_with_unknown_kid_parse_option'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['days_before_payment_outdated']) && ($this->container['days_before_payment_outdated'] > 99)) {
            $invalidProperties[] = "invalid value for 'days_before_payment_outdated', must be smaller than or equal to 99.";
        }

        if (!is_null($this->container['days_before_payment_outdated']) && ($this->container['days_before_payment_outdated'] < 3)) {
            $invalidProperties[] = "invalid value for 'days_before_payment_outdated', must be bigger than or equal to 3.";
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
     * Gets tax_bank_agreement
     *
     * @return \Learnist\Tripletex\Model\AutopayBankAgreement|null
     */
    public function getTaxBankAgreement()
    {
        return $this->container['tax_bank_agreement'];
    }

    /**
     * Sets tax_bank_agreement
     *
     * @param \Learnist\Tripletex\Model\AutopayBankAgreement|null $tax_bank_agreement tax_bank_agreement
     *
     * @return self
     */
    public function setTaxBankAgreement($tax_bank_agreement)
    {
        if (is_null($tax_bank_agreement)) {
            throw new \InvalidArgumentException('non-nullable tax_bank_agreement cannot be null');
        }
        $this->container['tax_bank_agreement'] = $tax_bank_agreement;

        return $this;
    }

    /**
     * Gets remit_number_of_acceptors
     *
     * @return int|null
     */
    public function getRemitNumberOfAcceptors()
    {
        return $this->container['remit_number_of_acceptors'];
    }

    /**
     * Sets remit_number_of_acceptors
     *
     * @param int|null $remit_number_of_acceptors The remit number of acceptors.
     *
     * @return self
     */
    public function setRemitNumberOfAcceptors($remit_number_of_acceptors)
    {
        if (is_null($remit_number_of_acceptors)) {
            throw new \InvalidArgumentException('non-nullable remit_number_of_acceptors cannot be null');
        }

        if (($remit_number_of_acceptors < 1)) {
            throw new \InvalidArgumentException('invalid value for $remit_number_of_acceptors when calling BankSettings., must be bigger than or equal to 1.');
        }

        $this->container['remit_number_of_acceptors'] = $remit_number_of_acceptors;

        return $this;
    }

    /**
     * Gets show_advice_currency_mismatch
     *
     * @return bool|null
     */
    public function getShowAdviceCurrencyMismatch()
    {
        return $this->container['show_advice_currency_mismatch'];
    }

    /**
     * Sets show_advice_currency_mismatch
     *
     * @param bool|null $show_advice_currency_mismatch The showAdviceCurrencyMismatch property.
     *
     * @return self
     */
    public function setShowAdviceCurrencyMismatch($show_advice_currency_mismatch)
    {
        if (is_null($show_advice_currency_mismatch)) {
            throw new \InvalidArgumentException('non-nullable show_advice_currency_mismatch cannot be null');
        }
        $this->container['show_advice_currency_mismatch'] = $show_advice_currency_mismatch;

        return $this;
    }

    /**
     * Gets payment_with_unknown_kid_parse_option
     *
     * @return string|null
     */
    public function getPaymentWithUnknownKidParseOption()
    {
        return $this->container['payment_with_unknown_kid_parse_option'];
    }

    /**
     * Sets payment_with_unknown_kid_parse_option
     *
     * @param string|null $payment_with_unknown_kid_parse_option Setting for whether incoming AutoPay payments without KID should be automatically posted, sent to voucher reception or ignored.
     *
     * @return self
     */
    public function setPaymentWithUnknownKidParseOption($payment_with_unknown_kid_parse_option)
    {
        if (is_null($payment_with_unknown_kid_parse_option)) {
            throw new \InvalidArgumentException('non-nullable payment_with_unknown_kid_parse_option cannot be null');
        }
        $allowedValues = $this->getPaymentWithUnknownKidParseOptionAllowableValues();
        if (!in_array($payment_with_unknown_kid_parse_option, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_with_unknown_kid_parse_option', must be one of '%s'",
                    $payment_with_unknown_kid_parse_option,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_with_unknown_kid_parse_option'] = $payment_with_unknown_kid_parse_option;

        return $this;
    }

    /**
     * Gets sign_auto_pay_with_bank_id
     *
     * @return bool|null
     */
    public function getSignAutoPayWithBankId()
    {
        return $this->container['sign_auto_pay_with_bank_id'];
    }

    /**
     * Sets sign_auto_pay_with_bank_id
     *
     * @param bool|null $sign_auto_pay_with_bank_id Setting for whether the user should have the option to sign payments and agreements with Bank ID in addition to 2FA.
     *
     * @return self
     */
    public function setSignAutoPayWithBankId($sign_auto_pay_with_bank_id)
    {
        if (is_null($sign_auto_pay_with_bank_id)) {
            throw new \InvalidArgumentException('non-nullable sign_auto_pay_with_bank_id cannot be null');
        }
        $this->container['sign_auto_pay_with_bank_id'] = $sign_auto_pay_with_bank_id;

        return $this;
    }

    /**
     * Gets batch_booking_of_payments
     *
     * @return bool|null
     */
    public function getBatchBookingOfPayments()
    {
        return $this->container['batch_booking_of_payments'];
    }

    /**
     * Sets batch_booking_of_payments
     *
     * @param bool|null $batch_booking_of_payments Setting for the user to use or not the batch booking for payments.
     *
     * @return self
     */
    public function setBatchBookingOfPayments($batch_booking_of_payments)
    {
        if (is_null($batch_booking_of_payments)) {
            throw new \InvalidArgumentException('non-nullable batch_booking_of_payments cannot be null');
        }
        $this->container['batch_booking_of_payments'] = $batch_booking_of_payments;

        return $this;
    }

    /**
     * Gets parse_entries_as_sum_posts
     *
     * @return bool|null
     */
    public function getParseEntriesAsSumPosts()
    {
        return $this->container['parse_entries_as_sum_posts'];
    }

    /**
     * Sets parse_entries_as_sum_posts
     *
     * @param bool|null $parse_entries_as_sum_posts Setting for the user to choose if account statements entries should be parsed as sum posts or not.
     *
     * @return self
     */
    public function setParseEntriesAsSumPosts($parse_entries_as_sum_posts)
    {
        if (is_null($parse_entries_as_sum_posts)) {
            throw new \InvalidArgumentException('non-nullable parse_entries_as_sum_posts cannot be null');
        }
        $this->container['parse_entries_as_sum_posts'] = $parse_entries_as_sum_posts;

        return $this;
    }

    /**
     * Gets employees_with_direct_remit_access
     *
     * @return \Learnist\Tripletex\Model\Employee[]|null
     */
    public function getEmployeesWithDirectRemitAccess()
    {
        return $this->container['employees_with_direct_remit_access'];
    }

    /**
     * Sets employees_with_direct_remit_access
     *
     * @param \Learnist\Tripletex\Model\Employee[]|null $employees_with_direct_remit_access Employees with payment access
     *
     * @return self
     */
    public function setEmployeesWithDirectRemitAccess($employees_with_direct_remit_access)
    {
        if (is_null($employees_with_direct_remit_access)) {
            throw new \InvalidArgumentException('non-nullable employees_with_direct_remit_access cannot be null');
        }
        $this->container['employees_with_direct_remit_access'] = $employees_with_direct_remit_access;

        return $this;
    }

    /**
     * Gets days_before_payment_outdated
     *
     * @return int|null
     */
    public function getDaysBeforePaymentOutdated()
    {
        return $this->container['days_before_payment_outdated'];
    }

    /**
     * Sets days_before_payment_outdated
     *
     * @param int|null $days_before_payment_outdated Number of days before a payment is set as outdated
     *
     * @return self
     */
    public function setDaysBeforePaymentOutdated($days_before_payment_outdated)
    {
        if (is_null($days_before_payment_outdated)) {
            throw new \InvalidArgumentException('non-nullable days_before_payment_outdated cannot be null');
        }

        if (($days_before_payment_outdated > 99)) {
            throw new \InvalidArgumentException('invalid value for $days_before_payment_outdated when calling BankSettings., must be smaller than or equal to 99.');
        }
        if (($days_before_payment_outdated < 3)) {
            throw new \InvalidArgumentException('invalid value for $days_before_payment_outdated when calling BankSettings., must be bigger than or equal to 3.');
        }

        $this->container['days_before_payment_outdated'] = $days_before_payment_outdated;

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


