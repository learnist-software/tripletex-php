<?php
/**
 * AdvancedPaymentWidget
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
 * AdvancedPaymentWidget Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class AdvancedPaymentWidget implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AdvancedPaymentWidget';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'payment_types' => '\Learnist\Tripletex\Model\PaymentWidgetPaymentType[]',
        'selected_payment_type' => '\Learnist\Tripletex\Model\PaymentWidgetPaymentType',
        'is_auto_pay' => 'bool',
        'is_ztl' => 'bool',
        'is_foreign_payment' => 'bool',
        'creditor_bank_identificator' => 'int',
        'creditor_name' => 'string',
        'creditor_address' => 'string',
        'creditor_postal_code' => 'string',
        'creditor_postal_city' => 'string',
        'creditor_country_id' => 'int',
        'creditor_bank_country_id' => 'int',
        'creditor_bank_name' => 'string',
        'creditor_bank_address' => 'string',
        'creditor_bank_postal_code' => 'string',
        'creditor_bank_postal_city' => 'string',
        'creditor_bank_code' => 'string',
        'creditor_bic' => 'string',
        'account_number' => 'string',
        'customer_vendor_iban_or_bban' => 'string[]',
        'creditor_clearing_code' => 'string',
        'is_creditor_address_only' => 'bool',
        'kid' => 'string',
        'amount' => 'object',
        'opposite_amount' => 'object',
        'date' => 'string',
        'regulatory_reporting_code' => 'string',
        'regulatory_reporting_info' => 'string',
        'currency_code' => 'string',
        'currency_id' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'payment_types' => null,
        'selected_payment_type' => null,
        'is_auto_pay' => null,
        'is_ztl' => null,
        'is_foreign_payment' => null,
        'creditor_bank_identificator' => 'int32',
        'creditor_name' => null,
        'creditor_address' => null,
        'creditor_postal_code' => null,
        'creditor_postal_city' => null,
        'creditor_country_id' => 'int32',
        'creditor_bank_country_id' => 'int32',
        'creditor_bank_name' => null,
        'creditor_bank_address' => null,
        'creditor_bank_postal_code' => null,
        'creditor_bank_postal_city' => null,
        'creditor_bank_code' => null,
        'creditor_bic' => null,
        'account_number' => null,
        'customer_vendor_iban_or_bban' => null,
        'creditor_clearing_code' => null,
        'is_creditor_address_only' => null,
        'kid' => null,
        'amount' => null,
        'opposite_amount' => null,
        'date' => null,
        'regulatory_reporting_code' => null,
        'regulatory_reporting_info' => null,
        'currency_code' => null,
        'currency_id' => 'int32'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'payment_types' => false,
		'selected_payment_type' => false,
		'is_auto_pay' => false,
		'is_ztl' => false,
		'is_foreign_payment' => false,
		'creditor_bank_identificator' => false,
		'creditor_name' => false,
		'creditor_address' => false,
		'creditor_postal_code' => false,
		'creditor_postal_city' => false,
		'creditor_country_id' => false,
		'creditor_bank_country_id' => false,
		'creditor_bank_name' => false,
		'creditor_bank_address' => false,
		'creditor_bank_postal_code' => false,
		'creditor_bank_postal_city' => false,
		'creditor_bank_code' => false,
		'creditor_bic' => false,
		'account_number' => false,
		'customer_vendor_iban_or_bban' => false,
		'creditor_clearing_code' => false,
		'is_creditor_address_only' => false,
		'kid' => false,
		'amount' => false,
		'opposite_amount' => false,
		'date' => false,
		'regulatory_reporting_code' => false,
		'regulatory_reporting_info' => false,
		'currency_code' => false,
		'currency_id' => false
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
        'payment_types' => 'paymentTypes',
        'selected_payment_type' => 'selectedPaymentType',
        'is_auto_pay' => 'isAutoPay',
        'is_ztl' => 'isZtl',
        'is_foreign_payment' => 'isForeignPayment',
        'creditor_bank_identificator' => 'creditorBankIdentificator',
        'creditor_name' => 'creditorName',
        'creditor_address' => 'creditorAddress',
        'creditor_postal_code' => 'creditorPostalCode',
        'creditor_postal_city' => 'creditorPostalCity',
        'creditor_country_id' => 'creditorCountryId',
        'creditor_bank_country_id' => 'creditorBankCountryId',
        'creditor_bank_name' => 'creditorBankName',
        'creditor_bank_address' => 'creditorBankAddress',
        'creditor_bank_postal_code' => 'creditorBankPostalCode',
        'creditor_bank_postal_city' => 'creditorBankPostalCity',
        'creditor_bank_code' => 'creditorBankCode',
        'creditor_bic' => 'creditorBic',
        'account_number' => 'accountNumber',
        'customer_vendor_iban_or_bban' => 'customerVendorIbanOrBban',
        'creditor_clearing_code' => 'creditorClearingCode',
        'is_creditor_address_only' => 'isCreditorAddressOnly',
        'kid' => 'kid',
        'amount' => 'amount',
        'opposite_amount' => 'oppositeAmount',
        'date' => 'date',
        'regulatory_reporting_code' => 'regulatoryReportingCode',
        'regulatory_reporting_info' => 'regulatoryReportingInfo',
        'currency_code' => 'currencyCode',
        'currency_id' => 'currencyId'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'payment_types' => 'setPaymentTypes',
        'selected_payment_type' => 'setSelectedPaymentType',
        'is_auto_pay' => 'setIsAutoPay',
        'is_ztl' => 'setIsZtl',
        'is_foreign_payment' => 'setIsForeignPayment',
        'creditor_bank_identificator' => 'setCreditorBankIdentificator',
        'creditor_name' => 'setCreditorName',
        'creditor_address' => 'setCreditorAddress',
        'creditor_postal_code' => 'setCreditorPostalCode',
        'creditor_postal_city' => 'setCreditorPostalCity',
        'creditor_country_id' => 'setCreditorCountryId',
        'creditor_bank_country_id' => 'setCreditorBankCountryId',
        'creditor_bank_name' => 'setCreditorBankName',
        'creditor_bank_address' => 'setCreditorBankAddress',
        'creditor_bank_postal_code' => 'setCreditorBankPostalCode',
        'creditor_bank_postal_city' => 'setCreditorBankPostalCity',
        'creditor_bank_code' => 'setCreditorBankCode',
        'creditor_bic' => 'setCreditorBic',
        'account_number' => 'setAccountNumber',
        'customer_vendor_iban_or_bban' => 'setCustomerVendorIbanOrBban',
        'creditor_clearing_code' => 'setCreditorClearingCode',
        'is_creditor_address_only' => 'setIsCreditorAddressOnly',
        'kid' => 'setKid',
        'amount' => 'setAmount',
        'opposite_amount' => 'setOppositeAmount',
        'date' => 'setDate',
        'regulatory_reporting_code' => 'setRegulatoryReportingCode',
        'regulatory_reporting_info' => 'setRegulatoryReportingInfo',
        'currency_code' => 'setCurrencyCode',
        'currency_id' => 'setCurrencyId'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'payment_types' => 'getPaymentTypes',
        'selected_payment_type' => 'getSelectedPaymentType',
        'is_auto_pay' => 'getIsAutoPay',
        'is_ztl' => 'getIsZtl',
        'is_foreign_payment' => 'getIsForeignPayment',
        'creditor_bank_identificator' => 'getCreditorBankIdentificator',
        'creditor_name' => 'getCreditorName',
        'creditor_address' => 'getCreditorAddress',
        'creditor_postal_code' => 'getCreditorPostalCode',
        'creditor_postal_city' => 'getCreditorPostalCity',
        'creditor_country_id' => 'getCreditorCountryId',
        'creditor_bank_country_id' => 'getCreditorBankCountryId',
        'creditor_bank_name' => 'getCreditorBankName',
        'creditor_bank_address' => 'getCreditorBankAddress',
        'creditor_bank_postal_code' => 'getCreditorBankPostalCode',
        'creditor_bank_postal_city' => 'getCreditorBankPostalCity',
        'creditor_bank_code' => 'getCreditorBankCode',
        'creditor_bic' => 'getCreditorBic',
        'account_number' => 'getAccountNumber',
        'customer_vendor_iban_or_bban' => 'getCustomerVendorIbanOrBban',
        'creditor_clearing_code' => 'getCreditorClearingCode',
        'is_creditor_address_only' => 'getIsCreditorAddressOnly',
        'kid' => 'getKid',
        'amount' => 'getAmount',
        'opposite_amount' => 'getOppositeAmount',
        'date' => 'getDate',
        'regulatory_reporting_code' => 'getRegulatoryReportingCode',
        'regulatory_reporting_info' => 'getRegulatoryReportingInfo',
        'currency_code' => 'getCurrencyCode',
        'currency_id' => 'getCurrencyId'
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
        $this->setIfExists('payment_types', $data ?? [], null);
        $this->setIfExists('selected_payment_type', $data ?? [], null);
        $this->setIfExists('is_auto_pay', $data ?? [], null);
        $this->setIfExists('is_ztl', $data ?? [], null);
        $this->setIfExists('is_foreign_payment', $data ?? [], null);
        $this->setIfExists('creditor_bank_identificator', $data ?? [], null);
        $this->setIfExists('creditor_name', $data ?? [], null);
        $this->setIfExists('creditor_address', $data ?? [], null);
        $this->setIfExists('creditor_postal_code', $data ?? [], null);
        $this->setIfExists('creditor_postal_city', $data ?? [], null);
        $this->setIfExists('creditor_country_id', $data ?? [], null);
        $this->setIfExists('creditor_bank_country_id', $data ?? [], null);
        $this->setIfExists('creditor_bank_name', $data ?? [], null);
        $this->setIfExists('creditor_bank_address', $data ?? [], null);
        $this->setIfExists('creditor_bank_postal_code', $data ?? [], null);
        $this->setIfExists('creditor_bank_postal_city', $data ?? [], null);
        $this->setIfExists('creditor_bank_code', $data ?? [], null);
        $this->setIfExists('creditor_bic', $data ?? [], null);
        $this->setIfExists('account_number', $data ?? [], null);
        $this->setIfExists('customer_vendor_iban_or_bban', $data ?? [], null);
        $this->setIfExists('creditor_clearing_code', $data ?? [], null);
        $this->setIfExists('is_creditor_address_only', $data ?? [], null);
        $this->setIfExists('kid', $data ?? [], null);
        $this->setIfExists('amount', $data ?? [], null);
        $this->setIfExists('opposite_amount', $data ?? [], null);
        $this->setIfExists('date', $data ?? [], null);
        $this->setIfExists('regulatory_reporting_code', $data ?? [], null);
        $this->setIfExists('regulatory_reporting_info', $data ?? [], null);
        $this->setIfExists('currency_code', $data ?? [], null);
        $this->setIfExists('currency_id', $data ?? [], null);
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
     * Gets payment_types
     *
     * @return \Learnist\Tripletex\Model\PaymentWidgetPaymentType[]|null
     */
    public function getPaymentTypes()
    {
        return $this->container['payment_types'];
    }

    /**
     * Sets payment_types
     *
     * @param \Learnist\Tripletex\Model\PaymentWidgetPaymentType[]|null $payment_types List of payment types used in this Advanced Payment Widget
     *
     * @return self
     */
    public function setPaymentTypes($payment_types)
    {
        if (is_null($payment_types)) {
            throw new \InvalidArgumentException('non-nullable payment_types cannot be null');
        }
        $this->container['payment_types'] = $payment_types;

        return $this;
    }

    /**
     * Gets selected_payment_type
     *
     * @return \Learnist\Tripletex\Model\PaymentWidgetPaymentType|null
     */
    public function getSelectedPaymentType()
    {
        return $this->container['selected_payment_type'];
    }

    /**
     * Sets selected_payment_type
     *
     * @param \Learnist\Tripletex\Model\PaymentWidgetPaymentType|null $selected_payment_type selected_payment_type
     *
     * @return self
     */
    public function setSelectedPaymentType($selected_payment_type)
    {
        if (is_null($selected_payment_type)) {
            throw new \InvalidArgumentException('non-nullable selected_payment_type cannot be null');
        }
        $this->container['selected_payment_type'] = $selected_payment_type;

        return $this;
    }

    /**
     * Gets is_auto_pay
     *
     * @return bool|null
     */
    public function getIsAutoPay()
    {
        return $this->container['is_auto_pay'];
    }

    /**
     * Sets is_auto_pay
     *
     * @param bool|null $is_auto_pay Flag for an AutoPay payment
     *
     * @return self
     */
    public function setIsAutoPay($is_auto_pay)
    {
        if (is_null($is_auto_pay)) {
            throw new \InvalidArgumentException('non-nullable is_auto_pay cannot be null');
        }
        $this->container['is_auto_pay'] = $is_auto_pay;

        return $this;
    }

    /**
     * Gets is_ztl
     *
     * @return bool|null
     */
    public function getIsZtl()
    {
        return $this->container['is_ztl'];
    }

    /**
     * Sets is_ztl
     *
     * @param bool|null $is_ztl Flag for a ZTL payment
     *
     * @return self
     */
    public function setIsZtl($is_ztl)
    {
        if (is_null($is_ztl)) {
            throw new \InvalidArgumentException('non-nullable is_ztl cannot be null');
        }
        $this->container['is_ztl'] = $is_ztl;

        return $this;
    }

    /**
     * Gets is_foreign_payment
     *
     * @return bool|null
     */
    public function getIsForeignPayment()
    {
        return $this->container['is_foreign_payment'];
    }

    /**
     * Sets is_foreign_payment
     *
     * @param bool|null $is_foreign_payment Flag for an AutoPay foreign payment
     *
     * @return self
     */
    public function setIsForeignPayment($is_foreign_payment)
    {
        if (is_null($is_foreign_payment)) {
            throw new \InvalidArgumentException('non-nullable is_foreign_payment cannot be null');
        }
        $this->container['is_foreign_payment'] = $is_foreign_payment;

        return $this;
    }

    /**
     * Gets creditor_bank_identificator
     *
     * @return int|null
     */
    public function getCreditorBankIdentificator()
    {
        return $this->container['creditor_bank_identificator'];
    }

    /**
     * Sets creditor_bank_identificator
     *
     * @param int|null $creditor_bank_identificator AutoPay's SWIFT or bank code type for an abroad payment
     *
     * @return self
     */
    public function setCreditorBankIdentificator($creditor_bank_identificator)
    {
        if (is_null($creditor_bank_identificator)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_identificator cannot be null');
        }
        $this->container['creditor_bank_identificator'] = $creditor_bank_identificator;

        return $this;
    }

    /**
     * Gets creditor_name
     *
     * @return string|null
     */
    public function getCreditorName()
    {
        return $this->container['creditor_name'];
    }

    /**
     * Sets creditor_name
     *
     * @param string|null $creditor_name AutoPay's creditor name for an abroad payment
     *
     * @return self
     */
    public function setCreditorName($creditor_name)
    {
        if (is_null($creditor_name)) {
            throw new \InvalidArgumentException('non-nullable creditor_name cannot be null');
        }
        $this->container['creditor_name'] = $creditor_name;

        return $this;
    }

    /**
     * Gets creditor_address
     *
     * @return string|null
     */
    public function getCreditorAddress()
    {
        return $this->container['creditor_address'];
    }

    /**
     * Sets creditor_address
     *
     * @param string|null $creditor_address AutoPay's creditor address for an abroad payment
     *
     * @return self
     */
    public function setCreditorAddress($creditor_address)
    {
        if (is_null($creditor_address)) {
            throw new \InvalidArgumentException('non-nullable creditor_address cannot be null');
        }
        $this->container['creditor_address'] = $creditor_address;

        return $this;
    }

    /**
     * Gets creditor_postal_code
     *
     * @return string|null
     */
    public function getCreditorPostalCode()
    {
        return $this->container['creditor_postal_code'];
    }

    /**
     * Sets creditor_postal_code
     *
     * @param string|null $creditor_postal_code AutoPay's creditor postal code for an abroad payment
     *
     * @return self
     */
    public function setCreditorPostalCode($creditor_postal_code)
    {
        if (is_null($creditor_postal_code)) {
            throw new \InvalidArgumentException('non-nullable creditor_postal_code cannot be null');
        }
        $this->container['creditor_postal_code'] = $creditor_postal_code;

        return $this;
    }

    /**
     * Gets creditor_postal_city
     *
     * @return string|null
     */
    public function getCreditorPostalCity()
    {
        return $this->container['creditor_postal_city'];
    }

    /**
     * Sets creditor_postal_city
     *
     * @param string|null $creditor_postal_city AutoPay's creditor postal city for an abroad payment
     *
     * @return self
     */
    public function setCreditorPostalCity($creditor_postal_city)
    {
        if (is_null($creditor_postal_city)) {
            throw new \InvalidArgumentException('non-nullable creditor_postal_city cannot be null');
        }
        $this->container['creditor_postal_city'] = $creditor_postal_city;

        return $this;
    }

    /**
     * Gets creditor_country_id
     *
     * @return int|null
     */
    public function getCreditorCountryId()
    {
        return $this->container['creditor_country_id'];
    }

    /**
     * Sets creditor_country_id
     *
     * @param int|null $creditor_country_id AutoPay's creditor country id for an abroad payment
     *
     * @return self
     */
    public function setCreditorCountryId($creditor_country_id)
    {
        if (is_null($creditor_country_id)) {
            throw new \InvalidArgumentException('non-nullable creditor_country_id cannot be null');
        }
        $this->container['creditor_country_id'] = $creditor_country_id;

        return $this;
    }

    /**
     * Gets creditor_bank_country_id
     *
     * @return int|null
     */
    public function getCreditorBankCountryId()
    {
        return $this->container['creditor_bank_country_id'];
    }

    /**
     * Sets creditor_bank_country_id
     *
     * @param int|null $creditor_bank_country_id AutoPay's creditor bank country id for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankCountryId($creditor_bank_country_id)
    {
        if (is_null($creditor_bank_country_id)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_country_id cannot be null');
        }
        $this->container['creditor_bank_country_id'] = $creditor_bank_country_id;

        return $this;
    }

    /**
     * Gets creditor_bank_name
     *
     * @return string|null
     */
    public function getCreditorBankName()
    {
        return $this->container['creditor_bank_name'];
    }

    /**
     * Sets creditor_bank_name
     *
     * @param string|null $creditor_bank_name AutoPay's creditor bank name for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankName($creditor_bank_name)
    {
        if (is_null($creditor_bank_name)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_name cannot be null');
        }
        $this->container['creditor_bank_name'] = $creditor_bank_name;

        return $this;
    }

    /**
     * Gets creditor_bank_address
     *
     * @return string|null
     */
    public function getCreditorBankAddress()
    {
        return $this->container['creditor_bank_address'];
    }

    /**
     * Sets creditor_bank_address
     *
     * @param string|null $creditor_bank_address AutoPay's creditor bank address for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankAddress($creditor_bank_address)
    {
        if (is_null($creditor_bank_address)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_address cannot be null');
        }
        $this->container['creditor_bank_address'] = $creditor_bank_address;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_code
     *
     * @return string|null
     */
    public function getCreditorBankPostalCode()
    {
        return $this->container['creditor_bank_postal_code'];
    }

    /**
     * Sets creditor_bank_postal_code
     *
     * @param string|null $creditor_bank_postal_code AutoPay's creditor bank postal code for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankPostalCode($creditor_bank_postal_code)
    {
        if (is_null($creditor_bank_postal_code)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_postal_code cannot be null');
        }
        $this->container['creditor_bank_postal_code'] = $creditor_bank_postal_code;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_city
     *
     * @return string|null
     */
    public function getCreditorBankPostalCity()
    {
        return $this->container['creditor_bank_postal_city'];
    }

    /**
     * Sets creditor_bank_postal_city
     *
     * @param string|null $creditor_bank_postal_city AutoPay's creditor bank postal city for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankPostalCity($creditor_bank_postal_city)
    {
        if (is_null($creditor_bank_postal_city)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_postal_city cannot be null');
        }
        $this->container['creditor_bank_postal_city'] = $creditor_bank_postal_city;

        return $this;
    }

    /**
     * Gets creditor_bank_code
     *
     * @return string|null
     */
    public function getCreditorBankCode()
    {
        return $this->container['creditor_bank_code'];
    }

    /**
     * Sets creditor_bank_code
     *
     * @param string|null $creditor_bank_code AutoPay's creditor bank code for an abroad bank code payment
     *
     * @return self
     */
    public function setCreditorBankCode($creditor_bank_code)
    {
        if (is_null($creditor_bank_code)) {
            throw new \InvalidArgumentException('non-nullable creditor_bank_code cannot be null');
        }
        $this->container['creditor_bank_code'] = $creditor_bank_code;

        return $this;
    }

    /**
     * Gets creditor_bic
     *
     * @return string|null
     */
    public function getCreditorBic()
    {
        return $this->container['creditor_bic'];
    }

    /**
     * Sets creditor_bic
     *
     * @param string|null $creditor_bic AutoPay's SWIFT code for an abroad payment
     *
     * @return self
     */
    public function setCreditorBic($creditor_bic)
    {
        if (is_null($creditor_bic)) {
            throw new \InvalidArgumentException('non-nullable creditor_bic cannot be null');
        }
        $this->container['creditor_bic'] = $creditor_bic;

        return $this;
    }

    /**
     * Gets account_number
     *
     * @return string|null
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     *
     * @param string|null $account_number Payment type's account number
     *
     * @return self
     */
    public function setAccountNumber($account_number)
    {
        if (is_null($account_number)) {
            throw new \InvalidArgumentException('non-nullable account_number cannot be null');
        }
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets customer_vendor_iban_or_bban
     *
     * @return string[]|null
     */
    public function getCustomerVendorIbanOrBban()
    {
        return $this->container['customer_vendor_iban_or_bban'];
    }

    /**
     * Sets customer_vendor_iban_or_bban
     *
     * @param string[]|null $customer_vendor_iban_or_bban Account numbers for this vendor
     *
     * @return self
     */
    public function setCustomerVendorIbanOrBban($customer_vendor_iban_or_bban)
    {
        if (is_null($customer_vendor_iban_or_bban)) {
            throw new \InvalidArgumentException('non-nullable customer_vendor_iban_or_bban cannot be null');
        }
        $this->container['customer_vendor_iban_or_bban'] = $customer_vendor_iban_or_bban;

        return $this;
    }

    /**
     * Gets creditor_clearing_code
     *
     * @return string|null
     */
    public function getCreditorClearingCode()
    {
        return $this->container['creditor_clearing_code'];
    }

    /**
     * Sets creditor_clearing_code
     *
     * @param string|null $creditor_clearing_code AutoPay's creditor bank code
     *
     * @return self
     */
    public function setCreditorClearingCode($creditor_clearing_code)
    {
        if (is_null($creditor_clearing_code)) {
            throw new \InvalidArgumentException('non-nullable creditor_clearing_code cannot be null');
        }
        $this->container['creditor_clearing_code'] = $creditor_clearing_code;

        return $this;
    }

    /**
     * Gets is_creditor_address_only
     *
     * @return bool|null
     */
    public function getIsCreditorAddressOnly()
    {
        return $this->container['is_creditor_address_only'];
    }

    /**
     * Sets is_creditor_address_only
     *
     * @param bool|null $is_creditor_address_only Flag for the creditor address
     *
     * @return self
     */
    public function setIsCreditorAddressOnly($is_creditor_address_only)
    {
        if (is_null($is_creditor_address_only)) {
            throw new \InvalidArgumentException('non-nullable is_creditor_address_only cannot be null');
        }
        $this->container['is_creditor_address_only'] = $is_creditor_address_only;

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
     * @param string|null $kid Kid or receiver's reference value
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
     * Gets amount
     *
     * @return object|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param object|null $amount amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (is_null($amount)) {
            throw new \InvalidArgumentException('non-nullable amount cannot be null');
        }
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets opposite_amount
     *
     * @return object|null
     */
    public function getOppositeAmount()
    {
        return $this->container['opposite_amount'];
    }

    /**
     * Sets opposite_amount
     *
     * @param object|null $opposite_amount opposite_amount
     *
     * @return self
     */
    public function setOppositeAmount($opposite_amount)
    {
        if (is_null($opposite_amount)) {
            throw new \InvalidArgumentException('non-nullable opposite_amount cannot be null');
        }
        $this->container['opposite_amount'] = $opposite_amount;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string|null
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string|null $date Payment's date value
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
     * Gets regulatory_reporting_code
     *
     * @return string|null
     */
    public function getRegulatoryReportingCode()
    {
        return $this->container['regulatory_reporting_code'];
    }

    /**
     * Sets regulatory_reporting_code
     *
     * @param string|null $regulatory_reporting_code AutoPay's regulatory reporting code
     *
     * @return self
     */
    public function setRegulatoryReportingCode($regulatory_reporting_code)
    {
        if (is_null($regulatory_reporting_code)) {
            throw new \InvalidArgumentException('non-nullable regulatory_reporting_code cannot be null');
        }
        $this->container['regulatory_reporting_code'] = $regulatory_reporting_code;

        return $this;
    }

    /**
     * Gets regulatory_reporting_info
     *
     * @return string|null
     */
    public function getRegulatoryReportingInfo()
    {
        return $this->container['regulatory_reporting_info'];
    }

    /**
     * Sets regulatory_reporting_info
     *
     * @param string|null $regulatory_reporting_info AutoPay's regulatory reporting info
     *
     * @return self
     */
    public function setRegulatoryReportingInfo($regulatory_reporting_info)
    {
        if (is_null($regulatory_reporting_info)) {
            throw new \InvalidArgumentException('non-nullable regulatory_reporting_info cannot be null');
        }
        $this->container['regulatory_reporting_info'] = $regulatory_reporting_info;

        return $this;
    }

    /**
     * Gets currency_code
     *
     * @return string|null
     */
    public function getCurrencyCode()
    {
        return $this->container['currency_code'];
    }

    /**
     * Sets currency_code
     *
     * @param string|null $currency_code Invoice currency code or default
     *
     * @return self
     */
    public function setCurrencyCode($currency_code)
    {
        if (is_null($currency_code)) {
            throw new \InvalidArgumentException('non-nullable currency_code cannot be null');
        }
        $this->container['currency_code'] = $currency_code;

        return $this;
    }

    /**
     * Gets currency_id
     *
     * @return int|null
     */
    public function getCurrencyId()
    {
        return $this->container['currency_id'];
    }

    /**
     * Sets currency_id
     *
     * @param int|null $currency_id Invoice currency id or default
     *
     * @return self
     */
    public function setCurrencyId($currency_id)
    {
        if (is_null($currency_id)) {
            throw new \InvalidArgumentException('non-nullable currency_id cannot be null');
        }
        $this->container['currency_id'] = $currency_id;

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


