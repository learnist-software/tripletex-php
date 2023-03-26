<?php
/**
 * BankSettings
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
 * BankSettings Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BankSettings implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'BankSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'days_before_payment_outdated' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'days_before_payment_outdated' => 'int32'    ];

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
'days_before_payment_outdated' => 'daysBeforePaymentOutdated'    ];

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
'days_before_payment_outdated' => 'setDaysBeforePaymentOutdated'    ];

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
'days_before_payment_outdated' => 'getDaysBeforePaymentOutdated'    ];

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

    const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_VOUCHER_RECEPTION = 'VOUCHER_RECEPTION';
const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_PARSE = 'PARSE';
const PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_IGNORE = 'IGNORE';

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
self::PAYMENT_WITH_UNKNOWN_KID_PARSE_OPTION_IGNORE,        ];
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
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
        $this->container['changes'] = isset($data['changes']) ? $data['changes'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['tax_bank_agreement'] = isset($data['tax_bank_agreement']) ? $data['tax_bank_agreement'] : null;
        $this->container['remit_number_of_acceptors'] = isset($data['remit_number_of_acceptors']) ? $data['remit_number_of_acceptors'] : null;
        $this->container['show_advice_currency_mismatch'] = isset($data['show_advice_currency_mismatch']) ? $data['show_advice_currency_mismatch'] : null;
        $this->container['payment_with_unknown_kid_parse_option'] = isset($data['payment_with_unknown_kid_parse_option']) ? $data['payment_with_unknown_kid_parse_option'] : null;
        $this->container['sign_auto_pay_with_bank_id'] = isset($data['sign_auto_pay_with_bank_id']) ? $data['sign_auto_pay_with_bank_id'] : null;
        $this->container['batch_booking_of_payments'] = isset($data['batch_booking_of_payments']) ? $data['batch_booking_of_payments'] : null;
        $this->container['parse_entries_as_sum_posts'] = isset($data['parse_entries_as_sum_posts']) ? $data['parse_entries_as_sum_posts'] : null;
        $this->container['employees_with_direct_remit_access'] = isset($data['employees_with_direct_remit_access']) ? $data['employees_with_direct_remit_access'] : null;
        $this->container['days_before_payment_outdated'] = isset($data['days_before_payment_outdated']) ? $data['days_before_payment_outdated'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getPaymentWithUnknownKidParseOptionAllowableValues();
        if (!is_null($this->container['payment_with_unknown_kid_parse_option']) && !in_array($this->container['payment_with_unknown_kid_parse_option'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'payment_with_unknown_kid_parse_option', must be one of '%s'",
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
     * Gets version
     *
     * @return int
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param int $version version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets changes
     *
     * @return \Learnist\Tripletex\Model\Change[]
     */
    public function getChanges()
    {
        return $this->container['changes'];
    }

    /**
     * Sets changes
     *
     * @param \Learnist\Tripletex\Model\Change[] $changes changes
     *
     * @return $this
     */
    public function setChanges($changes)
    {
        $this->container['changes'] = $changes;

        return $this;
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     *
     * @param string $url url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets tax_bank_agreement
     *
     * @return \Learnist\Tripletex\Model\AutopayBankAgreement
     */
    public function getTaxBankAgreement()
    {
        return $this->container['tax_bank_agreement'];
    }

    /**
     * Sets tax_bank_agreement
     *
     * @param \Learnist\Tripletex\Model\AutopayBankAgreement $tax_bank_agreement tax_bank_agreement
     *
     * @return $this
     */
    public function setTaxBankAgreement($tax_bank_agreement)
    {
        $this->container['tax_bank_agreement'] = $tax_bank_agreement;

        return $this;
    }

    /**
     * Gets remit_number_of_acceptors
     *
     * @return int
     */
    public function getRemitNumberOfAcceptors()
    {
        return $this->container['remit_number_of_acceptors'];
    }

    /**
     * Sets remit_number_of_acceptors
     *
     * @param int $remit_number_of_acceptors The remit number of acceptors.
     *
     * @return $this
     */
    public function setRemitNumberOfAcceptors($remit_number_of_acceptors)
    {
        $this->container['remit_number_of_acceptors'] = $remit_number_of_acceptors;

        return $this;
    }

    /**
     * Gets show_advice_currency_mismatch
     *
     * @return bool
     */
    public function getShowAdviceCurrencyMismatch()
    {
        return $this->container['show_advice_currency_mismatch'];
    }

    /**
     * Sets show_advice_currency_mismatch
     *
     * @param bool $show_advice_currency_mismatch The showAdviceCurrencyMismatch property.
     *
     * @return $this
     */
    public function setShowAdviceCurrencyMismatch($show_advice_currency_mismatch)
    {
        $this->container['show_advice_currency_mismatch'] = $show_advice_currency_mismatch;

        return $this;
    }

    /**
     * Gets payment_with_unknown_kid_parse_option
     *
     * @return string
     */
    public function getPaymentWithUnknownKidParseOption()
    {
        return $this->container['payment_with_unknown_kid_parse_option'];
    }

    /**
     * Sets payment_with_unknown_kid_parse_option
     *
     * @param string $payment_with_unknown_kid_parse_option Setting for whether incoming AutoPay payments without KID should be automatically posted, sent to voucher reception or ignored.
     *
     * @return $this
     */
    public function setPaymentWithUnknownKidParseOption($payment_with_unknown_kid_parse_option)
    {
        $allowedValues = $this->getPaymentWithUnknownKidParseOptionAllowableValues();
        if (!is_null($payment_with_unknown_kid_parse_option) && !in_array($payment_with_unknown_kid_parse_option, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'payment_with_unknown_kid_parse_option', must be one of '%s'",
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
     * @return bool
     */
    public function getSignAutoPayWithBankId()
    {
        return $this->container['sign_auto_pay_with_bank_id'];
    }

    /**
     * Sets sign_auto_pay_with_bank_id
     *
     * @param bool $sign_auto_pay_with_bank_id Setting for whether the user should have the option to sign payments and agreements with Bank ID in addition to 2FA.
     *
     * @return $this
     */
    public function setSignAutoPayWithBankId($sign_auto_pay_with_bank_id)
    {
        $this->container['sign_auto_pay_with_bank_id'] = $sign_auto_pay_with_bank_id;

        return $this;
    }

    /**
     * Gets batch_booking_of_payments
     *
     * @return bool
     */
    public function getBatchBookingOfPayments()
    {
        return $this->container['batch_booking_of_payments'];
    }

    /**
     * Sets batch_booking_of_payments
     *
     * @param bool $batch_booking_of_payments Setting for the user to use or not the batch booking for payments.
     *
     * @return $this
     */
    public function setBatchBookingOfPayments($batch_booking_of_payments)
    {
        $this->container['batch_booking_of_payments'] = $batch_booking_of_payments;

        return $this;
    }

    /**
     * Gets parse_entries_as_sum_posts
     *
     * @return bool
     */
    public function getParseEntriesAsSumPosts()
    {
        return $this->container['parse_entries_as_sum_posts'];
    }

    /**
     * Sets parse_entries_as_sum_posts
     *
     * @param bool $parse_entries_as_sum_posts Setting for the user to choose if account statements entries should be parsed as sum posts or not.
     *
     * @return $this
     */
    public function setParseEntriesAsSumPosts($parse_entries_as_sum_posts)
    {
        $this->container['parse_entries_as_sum_posts'] = $parse_entries_as_sum_posts;

        return $this;
    }

    /**
     * Gets employees_with_direct_remit_access
     *
     * @return \Learnist\Tripletex\Model\Employee[]
     */
    public function getEmployeesWithDirectRemitAccess()
    {
        return $this->container['employees_with_direct_remit_access'];
    }

    /**
     * Sets employees_with_direct_remit_access
     *
     * @param \Learnist\Tripletex\Model\Employee[] $employees_with_direct_remit_access Employees with payment access
     *
     * @return $this
     */
    public function setEmployeesWithDirectRemitAccess($employees_with_direct_remit_access)
    {
        $this->container['employees_with_direct_remit_access'] = $employees_with_direct_remit_access;

        return $this;
    }

    /**
     * Gets days_before_payment_outdated
     *
     * @return int
     */
    public function getDaysBeforePaymentOutdated()
    {
        return $this->container['days_before_payment_outdated'];
    }

    /**
     * Sets days_before_payment_outdated
     *
     * @param int $days_before_payment_outdated Number of days before a payment is set as outdated
     *
     * @return $this
     */
    public function setDaysBeforePaymentOutdated($days_before_payment_outdated)
    {
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
