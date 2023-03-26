<?php
/**
 * AdvancedPaymentWidget
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
 * AdvancedPaymentWidget Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AdvancedPaymentWidget implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'AdvancedPaymentWidget';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'amount' => '\Learnist\Tripletex\Model\TlxNumber',
'opposite_amount' => '\Learnist\Tripletex\Model\TlxNumber',
'date' => 'string',
'regulatory_reporting_code' => 'string',
'regulatory_reporting_info' => 'string',
'currency_code' => 'string',
'currency_id' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'currency_id' => 'int32'    ];

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
'currency_id' => 'currencyId'    ];

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
'currency_id' => 'setCurrencyId'    ];

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
'currency_id' => 'getCurrencyId'    ];

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
        $this->container['payment_types'] = isset($data['payment_types']) ? $data['payment_types'] : null;
        $this->container['selected_payment_type'] = isset($data['selected_payment_type']) ? $data['selected_payment_type'] : null;
        $this->container['is_auto_pay'] = isset($data['is_auto_pay']) ? $data['is_auto_pay'] : null;
        $this->container['is_ztl'] = isset($data['is_ztl']) ? $data['is_ztl'] : null;
        $this->container['is_foreign_payment'] = isset($data['is_foreign_payment']) ? $data['is_foreign_payment'] : null;
        $this->container['creditor_bank_identificator'] = isset($data['creditor_bank_identificator']) ? $data['creditor_bank_identificator'] : null;
        $this->container['creditor_name'] = isset($data['creditor_name']) ? $data['creditor_name'] : null;
        $this->container['creditor_address'] = isset($data['creditor_address']) ? $data['creditor_address'] : null;
        $this->container['creditor_postal_code'] = isset($data['creditor_postal_code']) ? $data['creditor_postal_code'] : null;
        $this->container['creditor_postal_city'] = isset($data['creditor_postal_city']) ? $data['creditor_postal_city'] : null;
        $this->container['creditor_country_id'] = isset($data['creditor_country_id']) ? $data['creditor_country_id'] : null;
        $this->container['creditor_bank_country_id'] = isset($data['creditor_bank_country_id']) ? $data['creditor_bank_country_id'] : null;
        $this->container['creditor_bank_name'] = isset($data['creditor_bank_name']) ? $data['creditor_bank_name'] : null;
        $this->container['creditor_bank_address'] = isset($data['creditor_bank_address']) ? $data['creditor_bank_address'] : null;
        $this->container['creditor_bank_postal_code'] = isset($data['creditor_bank_postal_code']) ? $data['creditor_bank_postal_code'] : null;
        $this->container['creditor_bank_postal_city'] = isset($data['creditor_bank_postal_city']) ? $data['creditor_bank_postal_city'] : null;
        $this->container['creditor_bank_code'] = isset($data['creditor_bank_code']) ? $data['creditor_bank_code'] : null;
        $this->container['creditor_bic'] = isset($data['creditor_bic']) ? $data['creditor_bic'] : null;
        $this->container['account_number'] = isset($data['account_number']) ? $data['account_number'] : null;
        $this->container['customer_vendor_iban_or_bban'] = isset($data['customer_vendor_iban_or_bban']) ? $data['customer_vendor_iban_or_bban'] : null;
        $this->container['creditor_clearing_code'] = isset($data['creditor_clearing_code']) ? $data['creditor_clearing_code'] : null;
        $this->container['is_creditor_address_only'] = isset($data['is_creditor_address_only']) ? $data['is_creditor_address_only'] : null;
        $this->container['kid'] = isset($data['kid']) ? $data['kid'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['opposite_amount'] = isset($data['opposite_amount']) ? $data['opposite_amount'] : null;
        $this->container['date'] = isset($data['date']) ? $data['date'] : null;
        $this->container['regulatory_reporting_code'] = isset($data['regulatory_reporting_code']) ? $data['regulatory_reporting_code'] : null;
        $this->container['regulatory_reporting_info'] = isset($data['regulatory_reporting_info']) ? $data['regulatory_reporting_info'] : null;
        $this->container['currency_code'] = isset($data['currency_code']) ? $data['currency_code'] : null;
        $this->container['currency_id'] = isset($data['currency_id']) ? $data['currency_id'] : null;
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
     * @return \Learnist\Tripletex\Model\PaymentWidgetPaymentType[]
     */
    public function getPaymentTypes()
    {
        return $this->container['payment_types'];
    }

    /**
     * Sets payment_types
     *
     * @param \Learnist\Tripletex\Model\PaymentWidgetPaymentType[] $payment_types List of payment types used in this Advanced Payment Widget
     *
     * @return $this
     */
    public function setPaymentTypes($payment_types)
    {
        $this->container['payment_types'] = $payment_types;

        return $this;
    }

    /**
     * Gets selected_payment_type
     *
     * @return \Learnist\Tripletex\Model\PaymentWidgetPaymentType
     */
    public function getSelectedPaymentType()
    {
        return $this->container['selected_payment_type'];
    }

    /**
     * Sets selected_payment_type
     *
     * @param \Learnist\Tripletex\Model\PaymentWidgetPaymentType $selected_payment_type selected_payment_type
     *
     * @return $this
     */
    public function setSelectedPaymentType($selected_payment_type)
    {
        $this->container['selected_payment_type'] = $selected_payment_type;

        return $this;
    }

    /**
     * Gets is_auto_pay
     *
     * @return bool
     */
    public function getIsAutoPay()
    {
        return $this->container['is_auto_pay'];
    }

    /**
     * Sets is_auto_pay
     *
     * @param bool $is_auto_pay Flag for an AutoPay payment
     *
     * @return $this
     */
    public function setIsAutoPay($is_auto_pay)
    {
        $this->container['is_auto_pay'] = $is_auto_pay;

        return $this;
    }

    /**
     * Gets is_ztl
     *
     * @return bool
     */
    public function getIsZtl()
    {
        return $this->container['is_ztl'];
    }

    /**
     * Sets is_ztl
     *
     * @param bool $is_ztl Flag for a ZTL payment
     *
     * @return $this
     */
    public function setIsZtl($is_ztl)
    {
        $this->container['is_ztl'] = $is_ztl;

        return $this;
    }

    /**
     * Gets is_foreign_payment
     *
     * @return bool
     */
    public function getIsForeignPayment()
    {
        return $this->container['is_foreign_payment'];
    }

    /**
     * Sets is_foreign_payment
     *
     * @param bool $is_foreign_payment Flag for an AutoPay foreign payment
     *
     * @return $this
     */
    public function setIsForeignPayment($is_foreign_payment)
    {
        $this->container['is_foreign_payment'] = $is_foreign_payment;

        return $this;
    }

    /**
     * Gets creditor_bank_identificator
     *
     * @return int
     */
    public function getCreditorBankIdentificator()
    {
        return $this->container['creditor_bank_identificator'];
    }

    /**
     * Sets creditor_bank_identificator
     *
     * @param int $creditor_bank_identificator AutoPay's SWIFT or bank code type for an abroad payment
     *
     * @return $this
     */
    public function setCreditorBankIdentificator($creditor_bank_identificator)
    {
        $this->container['creditor_bank_identificator'] = $creditor_bank_identificator;

        return $this;
    }

    /**
     * Gets creditor_name
     *
     * @return string
     */
    public function getCreditorName()
    {
        return $this->container['creditor_name'];
    }

    /**
     * Sets creditor_name
     *
     * @param string $creditor_name AutoPay's creditor name for an abroad payment
     *
     * @return $this
     */
    public function setCreditorName($creditor_name)
    {
        $this->container['creditor_name'] = $creditor_name;

        return $this;
    }

    /**
     * Gets creditor_address
     *
     * @return string
     */
    public function getCreditorAddress()
    {
        return $this->container['creditor_address'];
    }

    /**
     * Sets creditor_address
     *
     * @param string $creditor_address AutoPay's creditor address for an abroad payment
     *
     * @return $this
     */
    public function setCreditorAddress($creditor_address)
    {
        $this->container['creditor_address'] = $creditor_address;

        return $this;
    }

    /**
     * Gets creditor_postal_code
     *
     * @return string
     */
    public function getCreditorPostalCode()
    {
        return $this->container['creditor_postal_code'];
    }

    /**
     * Sets creditor_postal_code
     *
     * @param string $creditor_postal_code AutoPay's creditor postal code for an abroad payment
     *
     * @return $this
     */
    public function setCreditorPostalCode($creditor_postal_code)
    {
        $this->container['creditor_postal_code'] = $creditor_postal_code;

        return $this;
    }

    /**
     * Gets creditor_postal_city
     *
     * @return string
     */
    public function getCreditorPostalCity()
    {
        return $this->container['creditor_postal_city'];
    }

    /**
     * Sets creditor_postal_city
     *
     * @param string $creditor_postal_city AutoPay's creditor postal city for an abroad payment
     *
     * @return $this
     */
    public function setCreditorPostalCity($creditor_postal_city)
    {
        $this->container['creditor_postal_city'] = $creditor_postal_city;

        return $this;
    }

    /**
     * Gets creditor_country_id
     *
     * @return int
     */
    public function getCreditorCountryId()
    {
        return $this->container['creditor_country_id'];
    }

    /**
     * Sets creditor_country_id
     *
     * @param int $creditor_country_id AutoPay's creditor country id for an abroad payment
     *
     * @return $this
     */
    public function setCreditorCountryId($creditor_country_id)
    {
        $this->container['creditor_country_id'] = $creditor_country_id;

        return $this;
    }

    /**
     * Gets creditor_bank_country_id
     *
     * @return int
     */
    public function getCreditorBankCountryId()
    {
        return $this->container['creditor_bank_country_id'];
    }

    /**
     * Sets creditor_bank_country_id
     *
     * @param int $creditor_bank_country_id AutoPay's creditor bank country id for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankCountryId($creditor_bank_country_id)
    {
        $this->container['creditor_bank_country_id'] = $creditor_bank_country_id;

        return $this;
    }

    /**
     * Gets creditor_bank_name
     *
     * @return string
     */
    public function getCreditorBankName()
    {
        return $this->container['creditor_bank_name'];
    }

    /**
     * Sets creditor_bank_name
     *
     * @param string $creditor_bank_name AutoPay's creditor bank name for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankName($creditor_bank_name)
    {
        $this->container['creditor_bank_name'] = $creditor_bank_name;

        return $this;
    }

    /**
     * Gets creditor_bank_address
     *
     * @return string
     */
    public function getCreditorBankAddress()
    {
        return $this->container['creditor_bank_address'];
    }

    /**
     * Sets creditor_bank_address
     *
     * @param string $creditor_bank_address AutoPay's creditor bank address for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankAddress($creditor_bank_address)
    {
        $this->container['creditor_bank_address'] = $creditor_bank_address;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_code
     *
     * @return string
     */
    public function getCreditorBankPostalCode()
    {
        return $this->container['creditor_bank_postal_code'];
    }

    /**
     * Sets creditor_bank_postal_code
     *
     * @param string $creditor_bank_postal_code AutoPay's creditor bank postal code for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankPostalCode($creditor_bank_postal_code)
    {
        $this->container['creditor_bank_postal_code'] = $creditor_bank_postal_code;

        return $this;
    }

    /**
     * Gets creditor_bank_postal_city
     *
     * @return string
     */
    public function getCreditorBankPostalCity()
    {
        return $this->container['creditor_bank_postal_city'];
    }

    /**
     * Sets creditor_bank_postal_city
     *
     * @param string $creditor_bank_postal_city AutoPay's creditor bank postal city for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankPostalCity($creditor_bank_postal_city)
    {
        $this->container['creditor_bank_postal_city'] = $creditor_bank_postal_city;

        return $this;
    }

    /**
     * Gets creditor_bank_code
     *
     * @return string
     */
    public function getCreditorBankCode()
    {
        return $this->container['creditor_bank_code'];
    }

    /**
     * Sets creditor_bank_code
     *
     * @param string $creditor_bank_code AutoPay's creditor bank code for an abroad bank code payment
     *
     * @return $this
     */
    public function setCreditorBankCode($creditor_bank_code)
    {
        $this->container['creditor_bank_code'] = $creditor_bank_code;

        return $this;
    }

    /**
     * Gets creditor_bic
     *
     * @return string
     */
    public function getCreditorBic()
    {
        return $this->container['creditor_bic'];
    }

    /**
     * Sets creditor_bic
     *
     * @param string $creditor_bic AutoPay's SWIFT code for an abroad payment
     *
     * @return $this
     */
    public function setCreditorBic($creditor_bic)
    {
        $this->container['creditor_bic'] = $creditor_bic;

        return $this;
    }

    /**
     * Gets account_number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     *
     * @param string $account_number Payment type's account number
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets customer_vendor_iban_or_bban
     *
     * @return string[]
     */
    public function getCustomerVendorIbanOrBban()
    {
        return $this->container['customer_vendor_iban_or_bban'];
    }

    /**
     * Sets customer_vendor_iban_or_bban
     *
     * @param string[] $customer_vendor_iban_or_bban Account numbers for this vendor
     *
     * @return $this
     */
    public function setCustomerVendorIbanOrBban($customer_vendor_iban_or_bban)
    {
        $this->container['customer_vendor_iban_or_bban'] = $customer_vendor_iban_or_bban;

        return $this;
    }

    /**
     * Gets creditor_clearing_code
     *
     * @return string
     */
    public function getCreditorClearingCode()
    {
        return $this->container['creditor_clearing_code'];
    }

    /**
     * Sets creditor_clearing_code
     *
     * @param string $creditor_clearing_code AutoPay's creditor bank code
     *
     * @return $this
     */
    public function setCreditorClearingCode($creditor_clearing_code)
    {
        $this->container['creditor_clearing_code'] = $creditor_clearing_code;

        return $this;
    }

    /**
     * Gets is_creditor_address_only
     *
     * @return bool
     */
    public function getIsCreditorAddressOnly()
    {
        return $this->container['is_creditor_address_only'];
    }

    /**
     * Sets is_creditor_address_only
     *
     * @param bool $is_creditor_address_only Flag for the creditor address
     *
     * @return $this
     */
    public function setIsCreditorAddressOnly($is_creditor_address_only)
    {
        $this->container['is_creditor_address_only'] = $is_creditor_address_only;

        return $this;
    }

    /**
     * Gets kid
     *
     * @return string
     */
    public function getKid()
    {
        return $this->container['kid'];
    }

    /**
     * Sets kid
     *
     * @param string $kid Kid or receiver's reference value
     *
     * @return $this
     */
    public function setKid($kid)
    {
        $this->container['kid'] = $kid;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $amount amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets opposite_amount
     *
     * @return \Learnist\Tripletex\Model\TlxNumber
     */
    public function getOppositeAmount()
    {
        return $this->container['opposite_amount'];
    }

    /**
     * Sets opposite_amount
     *
     * @param \Learnist\Tripletex\Model\TlxNumber $opposite_amount opposite_amount
     *
     * @return $this
     */
    public function setOppositeAmount($opposite_amount)
    {
        $this->container['opposite_amount'] = $opposite_amount;

        return $this;
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date
     *
     * @param string $date Payment's date value
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets regulatory_reporting_code
     *
     * @return string
     */
    public function getRegulatoryReportingCode()
    {
        return $this->container['regulatory_reporting_code'];
    }

    /**
     * Sets regulatory_reporting_code
     *
     * @param string $regulatory_reporting_code AutoPay's regulatory reporting code
     *
     * @return $this
     */
    public function setRegulatoryReportingCode($regulatory_reporting_code)
    {
        $this->container['regulatory_reporting_code'] = $regulatory_reporting_code;

        return $this;
    }

    /**
     * Gets regulatory_reporting_info
     *
     * @return string
     */
    public function getRegulatoryReportingInfo()
    {
        return $this->container['regulatory_reporting_info'];
    }

    /**
     * Sets regulatory_reporting_info
     *
     * @param string $regulatory_reporting_info AutoPay's regulatory reporting info
     *
     * @return $this
     */
    public function setRegulatoryReportingInfo($regulatory_reporting_info)
    {
        $this->container['regulatory_reporting_info'] = $regulatory_reporting_info;

        return $this;
    }

    /**
     * Gets currency_code
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->container['currency_code'];
    }

    /**
     * Sets currency_code
     *
     * @param string $currency_code Invoice currency code or default
     *
     * @return $this
     */
    public function setCurrencyCode($currency_code)
    {
        $this->container['currency_code'] = $currency_code;

        return $this;
    }

    /**
     * Gets currency_id
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->container['currency_id'];
    }

    /**
     * Sets currency_id
     *
     * @param int $currency_id Invoice currency id or default
     *
     * @return $this
     */
    public function setCurrencyId($currency_id)
    {
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
