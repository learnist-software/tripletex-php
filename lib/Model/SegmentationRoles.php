<?php
/**
 * SegmentationRoles
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
 * OpenAPI Generator version: 6.3.0-SNAPSHOT
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
 * SegmentationRoles Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SegmentationRoles implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SegmentationRoles';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'role_administrator' => 'bool',
        'role_account_administrator' => 'bool',
        'role_system_administrator' => 'bool',
        'is_auth_invoicing' => 'bool',
        'is_auth_company_admin' => 'bool',
        'is_auth_read_only' => 'bool',
        'is_auth_create_order' => 'bool',
        'is_auth_accounting_settings' => 'bool',
        'is_auth_company_wage_admin' => 'bool',
        'is_auth_travels_and_expenses_admin_settings' => 'bool',
        'is_auth_invoice_admin_settings' => 'bool',
        'is_auth_inbox_voucher' => 'bool',
        'is_aut_wage_admin_setting' => 'bool',
        'is_auth_wage_settings' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'role_administrator' => null,
        'role_account_administrator' => null,
        'role_system_administrator' => null,
        'is_auth_invoicing' => null,
        'is_auth_company_admin' => null,
        'is_auth_read_only' => null,
        'is_auth_create_order' => null,
        'is_auth_accounting_settings' => null,
        'is_auth_company_wage_admin' => null,
        'is_auth_travels_and_expenses_admin_settings' => null,
        'is_auth_invoice_admin_settings' => null,
        'is_auth_inbox_voucher' => null,
        'is_aut_wage_admin_setting' => null,
        'is_auth_wage_settings' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'role_administrator' => false,
		'role_account_administrator' => false,
		'role_system_administrator' => false,
		'is_auth_invoicing' => false,
		'is_auth_company_admin' => false,
		'is_auth_read_only' => false,
		'is_auth_create_order' => false,
		'is_auth_accounting_settings' => false,
		'is_auth_company_wage_admin' => false,
		'is_auth_travels_and_expenses_admin_settings' => false,
		'is_auth_invoice_admin_settings' => false,
		'is_auth_inbox_voucher' => false,
		'is_aut_wage_admin_setting' => false,
		'is_auth_wage_settings' => false
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
        'role_administrator' => 'roleAdministrator',
        'role_account_administrator' => 'roleAccountAdministrator',
        'role_system_administrator' => 'roleSystemAdministrator',
        'is_auth_invoicing' => 'isAuthInvoicing',
        'is_auth_company_admin' => 'isAuthCompanyAdmin',
        'is_auth_read_only' => 'isAuthReadOnly',
        'is_auth_create_order' => 'isAuthCreateOrder',
        'is_auth_accounting_settings' => 'isAuthAccountingSettings',
        'is_auth_company_wage_admin' => 'isAuthCompanyWageAdmin',
        'is_auth_travels_and_expenses_admin_settings' => 'isAuthTravelsAndExpensesAdminSettings',
        'is_auth_invoice_admin_settings' => 'isAuthInvoiceAdminSettings',
        'is_auth_inbox_voucher' => 'isAuthInboxVoucher',
        'is_aut_wage_admin_setting' => 'isAutWageAdminSetting',
        'is_auth_wage_settings' => 'isAuthWageSettings'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'role_administrator' => 'setRoleAdministrator',
        'role_account_administrator' => 'setRoleAccountAdministrator',
        'role_system_administrator' => 'setRoleSystemAdministrator',
        'is_auth_invoicing' => 'setIsAuthInvoicing',
        'is_auth_company_admin' => 'setIsAuthCompanyAdmin',
        'is_auth_read_only' => 'setIsAuthReadOnly',
        'is_auth_create_order' => 'setIsAuthCreateOrder',
        'is_auth_accounting_settings' => 'setIsAuthAccountingSettings',
        'is_auth_company_wage_admin' => 'setIsAuthCompanyWageAdmin',
        'is_auth_travels_and_expenses_admin_settings' => 'setIsAuthTravelsAndExpensesAdminSettings',
        'is_auth_invoice_admin_settings' => 'setIsAuthInvoiceAdminSettings',
        'is_auth_inbox_voucher' => 'setIsAuthInboxVoucher',
        'is_aut_wage_admin_setting' => 'setIsAutWageAdminSetting',
        'is_auth_wage_settings' => 'setIsAuthWageSettings'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'role_administrator' => 'getRoleAdministrator',
        'role_account_administrator' => 'getRoleAccountAdministrator',
        'role_system_administrator' => 'getRoleSystemAdministrator',
        'is_auth_invoicing' => 'getIsAuthInvoicing',
        'is_auth_company_admin' => 'getIsAuthCompanyAdmin',
        'is_auth_read_only' => 'getIsAuthReadOnly',
        'is_auth_create_order' => 'getIsAuthCreateOrder',
        'is_auth_accounting_settings' => 'getIsAuthAccountingSettings',
        'is_auth_company_wage_admin' => 'getIsAuthCompanyWageAdmin',
        'is_auth_travels_and_expenses_admin_settings' => 'getIsAuthTravelsAndExpensesAdminSettings',
        'is_auth_invoice_admin_settings' => 'getIsAuthInvoiceAdminSettings',
        'is_auth_inbox_voucher' => 'getIsAuthInboxVoucher',
        'is_aut_wage_admin_setting' => 'getIsAutWageAdminSetting',
        'is_auth_wage_settings' => 'getIsAuthWageSettings'
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
        $this->setIfExists('role_administrator', $data ?? [], null);
        $this->setIfExists('role_account_administrator', $data ?? [], null);
        $this->setIfExists('role_system_administrator', $data ?? [], null);
        $this->setIfExists('is_auth_invoicing', $data ?? [], null);
        $this->setIfExists('is_auth_company_admin', $data ?? [], null);
        $this->setIfExists('is_auth_read_only', $data ?? [], null);
        $this->setIfExists('is_auth_create_order', $data ?? [], null);
        $this->setIfExists('is_auth_accounting_settings', $data ?? [], null);
        $this->setIfExists('is_auth_company_wage_admin', $data ?? [], null);
        $this->setIfExists('is_auth_travels_and_expenses_admin_settings', $data ?? [], null);
        $this->setIfExists('is_auth_invoice_admin_settings', $data ?? [], null);
        $this->setIfExists('is_auth_inbox_voucher', $data ?? [], null);
        $this->setIfExists('is_aut_wage_admin_setting', $data ?? [], null);
        $this->setIfExists('is_auth_wage_settings', $data ?? [], null);
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
     * Gets role_administrator
     *
     * @return bool|null
     */
    public function getRoleAdministrator()
    {
        return $this->container['role_administrator'];
    }

    /**
     * Sets role_administrator
     *
     * @param bool|null $role_administrator role_administrator
     *
     * @return self
     */
    public function setRoleAdministrator($role_administrator)
    {

        if (is_null($role_administrator)) {
            throw new \InvalidArgumentException('non-nullable role_administrator cannot be null');
        }

        $this->container['role_administrator'] = $role_administrator;

        return $this;
    }

    /**
     * Gets role_account_administrator
     *
     * @return bool|null
     */
    public function getRoleAccountAdministrator()
    {
        return $this->container['role_account_administrator'];
    }

    /**
     * Sets role_account_administrator
     *
     * @param bool|null $role_account_administrator role_account_administrator
     *
     * @return self
     */
    public function setRoleAccountAdministrator($role_account_administrator)
    {

        if (is_null($role_account_administrator)) {
            throw new \InvalidArgumentException('non-nullable role_account_administrator cannot be null');
        }

        $this->container['role_account_administrator'] = $role_account_administrator;

        return $this;
    }

    /**
     * Gets role_system_administrator
     *
     * @return bool|null
     */
    public function getRoleSystemAdministrator()
    {
        return $this->container['role_system_administrator'];
    }

    /**
     * Sets role_system_administrator
     *
     * @param bool|null $role_system_administrator role_system_administrator
     *
     * @return self
     */
    public function setRoleSystemAdministrator($role_system_administrator)
    {

        if (is_null($role_system_administrator)) {
            throw new \InvalidArgumentException('non-nullable role_system_administrator cannot be null');
        }

        $this->container['role_system_administrator'] = $role_system_administrator;

        return $this;
    }

    /**
     * Gets is_auth_invoicing
     *
     * @return bool|null
     */
    public function getIsAuthInvoicing()
    {
        return $this->container['is_auth_invoicing'];
    }

    /**
     * Sets is_auth_invoicing
     *
     * @param bool|null $is_auth_invoicing is_auth_invoicing
     *
     * @return self
     */
    public function setIsAuthInvoicing($is_auth_invoicing)
    {

        if (is_null($is_auth_invoicing)) {
            throw new \InvalidArgumentException('non-nullable is_auth_invoicing cannot be null');
        }

        $this->container['is_auth_invoicing'] = $is_auth_invoicing;

        return $this;
    }

    /**
     * Gets is_auth_company_admin
     *
     * @return bool|null
     */
    public function getIsAuthCompanyAdmin()
    {
        return $this->container['is_auth_company_admin'];
    }

    /**
     * Sets is_auth_company_admin
     *
     * @param bool|null $is_auth_company_admin is_auth_company_admin
     *
     * @return self
     */
    public function setIsAuthCompanyAdmin($is_auth_company_admin)
    {

        if (is_null($is_auth_company_admin)) {
            throw new \InvalidArgumentException('non-nullable is_auth_company_admin cannot be null');
        }

        $this->container['is_auth_company_admin'] = $is_auth_company_admin;

        return $this;
    }

    /**
     * Gets is_auth_read_only
     *
     * @return bool|null
     */
    public function getIsAuthReadOnly()
    {
        return $this->container['is_auth_read_only'];
    }

    /**
     * Sets is_auth_read_only
     *
     * @param bool|null $is_auth_read_only is_auth_read_only
     *
     * @return self
     */
    public function setIsAuthReadOnly($is_auth_read_only)
    {

        if (is_null($is_auth_read_only)) {
            throw new \InvalidArgumentException('non-nullable is_auth_read_only cannot be null');
        }

        $this->container['is_auth_read_only'] = $is_auth_read_only;

        return $this;
    }

    /**
     * Gets is_auth_create_order
     *
     * @return bool|null
     */
    public function getIsAuthCreateOrder()
    {
        return $this->container['is_auth_create_order'];
    }

    /**
     * Sets is_auth_create_order
     *
     * @param bool|null $is_auth_create_order is_auth_create_order
     *
     * @return self
     */
    public function setIsAuthCreateOrder($is_auth_create_order)
    {

        if (is_null($is_auth_create_order)) {
            throw new \InvalidArgumentException('non-nullable is_auth_create_order cannot be null');
        }

        $this->container['is_auth_create_order'] = $is_auth_create_order;

        return $this;
    }

    /**
     * Gets is_auth_accounting_settings
     *
     * @return bool|null
     */
    public function getIsAuthAccountingSettings()
    {
        return $this->container['is_auth_accounting_settings'];
    }

    /**
     * Sets is_auth_accounting_settings
     *
     * @param bool|null $is_auth_accounting_settings is_auth_accounting_settings
     *
     * @return self
     */
    public function setIsAuthAccountingSettings($is_auth_accounting_settings)
    {

        if (is_null($is_auth_accounting_settings)) {
            throw new \InvalidArgumentException('non-nullable is_auth_accounting_settings cannot be null');
        }

        $this->container['is_auth_accounting_settings'] = $is_auth_accounting_settings;

        return $this;
    }

    /**
     * Gets is_auth_company_wage_admin
     *
     * @return bool|null
     */
    public function getIsAuthCompanyWageAdmin()
    {
        return $this->container['is_auth_company_wage_admin'];
    }

    /**
     * Sets is_auth_company_wage_admin
     *
     * @param bool|null $is_auth_company_wage_admin is_auth_company_wage_admin
     *
     * @return self
     */
    public function setIsAuthCompanyWageAdmin($is_auth_company_wage_admin)
    {

        if (is_null($is_auth_company_wage_admin)) {
            throw new \InvalidArgumentException('non-nullable is_auth_company_wage_admin cannot be null');
        }

        $this->container['is_auth_company_wage_admin'] = $is_auth_company_wage_admin;

        return $this;
    }

    /**
     * Gets is_auth_travels_and_expenses_admin_settings
     *
     * @return bool|null
     */
    public function getIsAuthTravelsAndExpensesAdminSettings()
    {
        return $this->container['is_auth_travels_and_expenses_admin_settings'];
    }

    /**
     * Sets is_auth_travels_and_expenses_admin_settings
     *
     * @param bool|null $is_auth_travels_and_expenses_admin_settings is_auth_travels_and_expenses_admin_settings
     *
     * @return self
     */
    public function setIsAuthTravelsAndExpensesAdminSettings($is_auth_travels_and_expenses_admin_settings)
    {

        if (is_null($is_auth_travels_and_expenses_admin_settings)) {
            throw new \InvalidArgumentException('non-nullable is_auth_travels_and_expenses_admin_settings cannot be null');
        }

        $this->container['is_auth_travels_and_expenses_admin_settings'] = $is_auth_travels_and_expenses_admin_settings;

        return $this;
    }

    /**
     * Gets is_auth_invoice_admin_settings
     *
     * @return bool|null
     */
    public function getIsAuthInvoiceAdminSettings()
    {
        return $this->container['is_auth_invoice_admin_settings'];
    }

    /**
     * Sets is_auth_invoice_admin_settings
     *
     * @param bool|null $is_auth_invoice_admin_settings is_auth_invoice_admin_settings
     *
     * @return self
     */
    public function setIsAuthInvoiceAdminSettings($is_auth_invoice_admin_settings)
    {

        if (is_null($is_auth_invoice_admin_settings)) {
            throw new \InvalidArgumentException('non-nullable is_auth_invoice_admin_settings cannot be null');
        }

        $this->container['is_auth_invoice_admin_settings'] = $is_auth_invoice_admin_settings;

        return $this;
    }

    /**
     * Gets is_auth_inbox_voucher
     *
     * @return bool|null
     */
    public function getIsAuthInboxVoucher()
    {
        return $this->container['is_auth_inbox_voucher'];
    }

    /**
     * Sets is_auth_inbox_voucher
     *
     * @param bool|null $is_auth_inbox_voucher is_auth_inbox_voucher
     *
     * @return self
     */
    public function setIsAuthInboxVoucher($is_auth_inbox_voucher)
    {

        if (is_null($is_auth_inbox_voucher)) {
            throw new \InvalidArgumentException('non-nullable is_auth_inbox_voucher cannot be null');
        }

        $this->container['is_auth_inbox_voucher'] = $is_auth_inbox_voucher;

        return $this;
    }

    /**
     * Gets is_aut_wage_admin_setting
     *
     * @return bool|null
     */
    public function getIsAutWageAdminSetting()
    {
        return $this->container['is_aut_wage_admin_setting'];
    }

    /**
     * Sets is_aut_wage_admin_setting
     *
     * @param bool|null $is_aut_wage_admin_setting is_aut_wage_admin_setting
     *
     * @return self
     */
    public function setIsAutWageAdminSetting($is_aut_wage_admin_setting)
    {

        if (is_null($is_aut_wage_admin_setting)) {
            throw new \InvalidArgumentException('non-nullable is_aut_wage_admin_setting cannot be null');
        }

        $this->container['is_aut_wage_admin_setting'] = $is_aut_wage_admin_setting;

        return $this;
    }

    /**
     * Gets is_auth_wage_settings
     *
     * @return bool|null
     */
    public function getIsAuthWageSettings()
    {
        return $this->container['is_auth_wage_settings'];
    }

    /**
     * Sets is_auth_wage_settings
     *
     * @param bool|null $is_auth_wage_settings is_auth_wage_settings
     *
     * @return self
     */
    public function setIsAuthWageSettings($is_auth_wage_settings)
    {

        if (is_null($is_auth_wage_settings)) {
            throw new \InvalidArgumentException('non-nullable is_auth_wage_settings cannot be null');
        }

        $this->container['is_auth_wage_settings'] = $is_auth_wage_settings;

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


