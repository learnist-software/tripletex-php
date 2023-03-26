<?php
/**
 * PaymentTypeOut
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
 * PaymentTypeOut Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PaymentTypeOut implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PaymentTypeOut';

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
        'description' => 'string',
        'is_brutto_wage_deduction' => 'bool',
        'credit_account' => '\Learnist\Tripletex\Model\Account',
        'show_incoming_invoice' => 'bool',
        'show_wage_payment' => 'bool',
        'show_vat_returns' => 'bool',
        'show_wage_period_transaction' => 'bool',
        'requires_separate_voucher' => 'bool',
        'sequence' => 'int',
        'is_inactive' => 'bool'
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
        'description' => null,
        'is_brutto_wage_deduction' => null,
        'credit_account' => null,
        'show_incoming_invoice' => null,
        'show_wage_payment' => null,
        'show_vat_returns' => null,
        'show_wage_period_transaction' => null,
        'requires_separate_voucher' => null,
        'sequence' => 'int32',
        'is_inactive' => null
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
		'description' => false,
		'is_brutto_wage_deduction' => false,
		'credit_account' => false,
		'show_incoming_invoice' => false,
		'show_wage_payment' => false,
		'show_vat_returns' => false,
		'show_wage_period_transaction' => false,
		'requires_separate_voucher' => false,
		'sequence' => false,
		'is_inactive' => false
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
        'description' => 'description',
        'is_brutto_wage_deduction' => 'isBruttoWageDeduction',
        'credit_account' => 'creditAccount',
        'show_incoming_invoice' => 'showIncomingInvoice',
        'show_wage_payment' => 'showWagePayment',
        'show_vat_returns' => 'showVatReturns',
        'show_wage_period_transaction' => 'showWagePeriodTransaction',
        'requires_separate_voucher' => 'requiresSeparateVoucher',
        'sequence' => 'sequence',
        'is_inactive' => 'isInactive'
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
        'description' => 'setDescription',
        'is_brutto_wage_deduction' => 'setIsBruttoWageDeduction',
        'credit_account' => 'setCreditAccount',
        'show_incoming_invoice' => 'setShowIncomingInvoice',
        'show_wage_payment' => 'setShowWagePayment',
        'show_vat_returns' => 'setShowVatReturns',
        'show_wage_period_transaction' => 'setShowWagePeriodTransaction',
        'requires_separate_voucher' => 'setRequiresSeparateVoucher',
        'sequence' => 'setSequence',
        'is_inactive' => 'setIsInactive'
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
        'description' => 'getDescription',
        'is_brutto_wage_deduction' => 'getIsBruttoWageDeduction',
        'credit_account' => 'getCreditAccount',
        'show_incoming_invoice' => 'getShowIncomingInvoice',
        'show_wage_payment' => 'getShowWagePayment',
        'show_vat_returns' => 'getShowVatReturns',
        'show_wage_period_transaction' => 'getShowWagePeriodTransaction',
        'requires_separate_voucher' => 'getRequiresSeparateVoucher',
        'sequence' => 'getSequence',
        'is_inactive' => 'getIsInactive'
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
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('changes', $data ?? [], null);
        $this->setIfExists('url', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('is_brutto_wage_deduction', $data ?? [], null);
        $this->setIfExists('credit_account', $data ?? [], null);
        $this->setIfExists('show_incoming_invoice', $data ?? [], null);
        $this->setIfExists('show_wage_payment', $data ?? [], null);
        $this->setIfExists('show_vat_returns', $data ?? [], null);
        $this->setIfExists('show_wage_period_transaction', $data ?? [], null);
        $this->setIfExists('requires_separate_voucher', $data ?? [], null);
        $this->setIfExists('sequence', $data ?? [], null);
        $this->setIfExists('is_inactive', $data ?? [], null);
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

        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ((mb_strlen($this->container['description']) > 255)) {
            $invalidProperties[] = "invalid value for 'description', the character length must be smaller than or equal to 255.";
        }

        if ($this->container['credit_account'] === null) {
            $invalidProperties[] = "'credit_account' can't be null";
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
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        if ((mb_strlen($description) > 255)) {
            throw new \InvalidArgumentException('invalid length for $description when calling PaymentTypeOut., must be smaller than or equal to 255.');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets is_brutto_wage_deduction
     *
     * @return bool|null
     */
    public function getIsBruttoWageDeduction()
    {
        return $this->container['is_brutto_wage_deduction'];
    }

    /**
     * Sets is_brutto_wage_deduction
     *
     * @param bool|null $is_brutto_wage_deduction true if it should be a deduction from the wage. The module PROVISIONSALARY is required to both view and change this setting
     *
     * @return self
     */
    public function setIsBruttoWageDeduction($is_brutto_wage_deduction)
    {
        if (is_null($is_brutto_wage_deduction)) {
            throw new \InvalidArgumentException('non-nullable is_brutto_wage_deduction cannot be null');
        }
        $this->container['is_brutto_wage_deduction'] = $is_brutto_wage_deduction;

        return $this;
    }

    /**
     * Gets credit_account
     *
     * @return \Learnist\Tripletex\Model\Account
     */
    public function getCreditAccount()
    {
        return $this->container['credit_account'];
    }

    /**
     * Sets credit_account
     *
     * @param \Learnist\Tripletex\Model\Account $credit_account credit_account
     *
     * @return self
     */
    public function setCreditAccount($credit_account)
    {
        if (is_null($credit_account)) {
            throw new \InvalidArgumentException('non-nullable credit_account cannot be null');
        }
        $this->container['credit_account'] = $credit_account;

        return $this;
    }

    /**
     * Gets show_incoming_invoice
     *
     * @return bool|null
     */
    public function getShowIncomingInvoice()
    {
        return $this->container['show_incoming_invoice'];
    }

    /**
     * Sets show_incoming_invoice
     *
     * @param bool|null $show_incoming_invoice true if the payment type should be available in supplier invoices
     *
     * @return self
     */
    public function setShowIncomingInvoice($show_incoming_invoice)
    {
        if (is_null($show_incoming_invoice)) {
            throw new \InvalidArgumentException('non-nullable show_incoming_invoice cannot be null');
        }
        $this->container['show_incoming_invoice'] = $show_incoming_invoice;

        return $this;
    }

    /**
     * Gets show_wage_payment
     *
     * @return bool|null
     */
    public function getShowWagePayment()
    {
        return $this->container['show_wage_payment'];
    }

    /**
     * Sets show_wage_payment
     *
     * @param bool|null $show_wage_payment true if the payment type should be available in wage payments. The wage module is required to both view and change this setting
     *
     * @return self
     */
    public function setShowWagePayment($show_wage_payment)
    {
        if (is_null($show_wage_payment)) {
            throw new \InvalidArgumentException('non-nullable show_wage_payment cannot be null');
        }
        $this->container['show_wage_payment'] = $show_wage_payment;

        return $this;
    }

    /**
     * Gets show_vat_returns
     *
     * @return bool|null
     */
    public function getShowVatReturns()
    {
        return $this->container['show_vat_returns'];
    }

    /**
     * Sets show_vat_returns
     *
     * @param bool|null $show_vat_returns true if the payment type should be available in vat returns
     *
     * @return self
     */
    public function setShowVatReturns($show_vat_returns)
    {
        if (is_null($show_vat_returns)) {
            throw new \InvalidArgumentException('non-nullable show_vat_returns cannot be null');
        }
        $this->container['show_vat_returns'] = $show_vat_returns;

        return $this;
    }

    /**
     * Gets show_wage_period_transaction
     *
     * @return bool|null
     */
    public function getShowWagePeriodTransaction()
    {
        return $this->container['show_wage_period_transaction'];
    }

    /**
     * Sets show_wage_period_transaction
     *
     * @param bool|null $show_wage_period_transaction true if the payment type should be available in period transactionsThe wage module is required to both view and change this setting
     *
     * @return self
     */
    public function setShowWagePeriodTransaction($show_wage_period_transaction)
    {
        if (is_null($show_wage_period_transaction)) {
            throw new \InvalidArgumentException('non-nullable show_wage_period_transaction cannot be null');
        }
        $this->container['show_wage_period_transaction'] = $show_wage_period_transaction;

        return $this;
    }

    /**
     * Gets requires_separate_voucher
     *
     * @return bool|null
     */
    public function getRequiresSeparateVoucher()
    {
        return $this->container['requires_separate_voucher'];
    }

    /**
     * Sets requires_separate_voucher
     *
     * @param bool|null $requires_separate_voucher true if a separate voucher is required
     *
     * @return self
     */
    public function setRequiresSeparateVoucher($requires_separate_voucher)
    {
        if (is_null($requires_separate_voucher)) {
            throw new \InvalidArgumentException('non-nullable requires_separate_voucher cannot be null');
        }
        $this->container['requires_separate_voucher'] = $requires_separate_voucher;

        return $this;
    }

    /**
     * Gets sequence
     *
     * @return int|null
     */
    public function getSequence()
    {
        return $this->container['sequence'];
    }

    /**
     * Sets sequence
     *
     * @param int|null $sequence determines in which order the types should be listed. No 1 is listed first
     *
     * @return self
     */
    public function setSequence($sequence)
    {
        if (is_null($sequence)) {
            throw new \InvalidArgumentException('non-nullable sequence cannot be null');
        }
        $this->container['sequence'] = $sequence;

        return $this;
    }

    /**
     * Gets is_inactive
     *
     * @return bool|null
     */
    public function getIsInactive()
    {
        return $this->container['is_inactive'];
    }

    /**
     * Sets is_inactive
     *
     * @param bool|null $is_inactive true if the payment type should be hidden from available payment types
     *
     * @return self
     */
    public function setIsInactive($is_inactive)
    {
        if (is_null($is_inactive)) {
            throw new \InvalidArgumentException('non-nullable is_inactive cannot be null');
        }
        $this->container['is_inactive'] = $is_inactive;

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


