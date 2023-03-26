<?php
/**
 * TangibleFixedAsset
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
 * TangibleFixedAsset Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class TangibleFixedAsset implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TangibleFixedAsset';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'object_identifier' => 'string',
        'object_group' => 'string',
        'account_number' => 'string',
        'type' => 'string',
        'opening_balance' => 'float',
        'opening_balance_tax_value' => 'float',
        'closing_balance' => 'float',
        'closing_balance_tax_value' => 'float',
        'new_acquisitions' => 'float',
        'acquisition_cost' => 'float',
        'improvements' => 'float',
        'public_subsidies' => 'float',
        'sales_and_other_realisation' => 'float',
        'sales_and_other_realisation_recognition' => 'float',
        'subsidies_for_regional_investments' => 'float',
        'reversal_of_subsidies_for_regional_investments' => 'float',
        'adjustment_of_input_vat' => 'float',
        'obvious_change_of_value' => 'float',
        'unknown_transaction_type' => 'float',
        'depreciation' => 'float',
        'depreciation_tax_value' => 'float',
        'depreciation_percentage' => 'float',
        'depreciation_percentage_tax_value' => 'float',
        'depreciation_difference' => 'float',
        'income_recognition_of_negative_balance' => 'float',
        'straight_line_depreciation' => 'float',
        'straight_line_depreciation_tax_value' => 'float',
        'basis_for_depreciation_or_income_recognition' => 'float',
        'basis_for_depreciation_or_income_recognition_tax_value' => 'float',
        'profit_transfered_to_profit_and_loss_account' => 'float',
        'loss_transfered_to_profit_and_loss_account' => 'float',
        'accounting_value_profit_and_loss' => 'string',
        'warning_too_high_percentage' => 'string',
        'warning_too_low_percentage' => 'string',
        'info_residual_write_off' => 'string',
        'info_message_depreciation' => 'string',
        'info_message_income_recognition' => 'string',
        'negate' => 'bool'
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
        'object_identifier' => null,
        'object_group' => null,
        'account_number' => null,
        'type' => null,
        'opening_balance' => null,
        'opening_balance_tax_value' => null,
        'closing_balance' => null,
        'closing_balance_tax_value' => null,
        'new_acquisitions' => null,
        'acquisition_cost' => null,
        'improvements' => null,
        'public_subsidies' => null,
        'sales_and_other_realisation' => null,
        'sales_and_other_realisation_recognition' => null,
        'subsidies_for_regional_investments' => null,
        'reversal_of_subsidies_for_regional_investments' => null,
        'adjustment_of_input_vat' => null,
        'obvious_change_of_value' => null,
        'unknown_transaction_type' => null,
        'depreciation' => null,
        'depreciation_tax_value' => null,
        'depreciation_percentage' => null,
        'depreciation_percentage_tax_value' => null,
        'depreciation_difference' => null,
        'income_recognition_of_negative_balance' => null,
        'straight_line_depreciation' => null,
        'straight_line_depreciation_tax_value' => null,
        'basis_for_depreciation_or_income_recognition' => null,
        'basis_for_depreciation_or_income_recognition_tax_value' => null,
        'profit_transfered_to_profit_and_loss_account' => null,
        'loss_transfered_to_profit_and_loss_account' => null,
        'accounting_value_profit_and_loss' => null,
        'warning_too_high_percentage' => null,
        'warning_too_low_percentage' => null,
        'info_residual_write_off' => null,
        'info_message_depreciation' => null,
        'info_message_income_recognition' => null,
        'negate' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
		'object_identifier' => false,
		'object_group' => false,
		'account_number' => false,
		'type' => false,
		'opening_balance' => false,
		'opening_balance_tax_value' => false,
		'closing_balance' => false,
		'closing_balance_tax_value' => false,
		'new_acquisitions' => false,
		'acquisition_cost' => false,
		'improvements' => false,
		'public_subsidies' => false,
		'sales_and_other_realisation' => false,
		'sales_and_other_realisation_recognition' => false,
		'subsidies_for_regional_investments' => false,
		'reversal_of_subsidies_for_regional_investments' => false,
		'adjustment_of_input_vat' => false,
		'obvious_change_of_value' => false,
		'unknown_transaction_type' => false,
		'depreciation' => false,
		'depreciation_tax_value' => false,
		'depreciation_percentage' => false,
		'depreciation_percentage_tax_value' => false,
		'depreciation_difference' => false,
		'income_recognition_of_negative_balance' => false,
		'straight_line_depreciation' => false,
		'straight_line_depreciation_tax_value' => false,
		'basis_for_depreciation_or_income_recognition' => false,
		'basis_for_depreciation_or_income_recognition_tax_value' => false,
		'profit_transfered_to_profit_and_loss_account' => false,
		'loss_transfered_to_profit_and_loss_account' => false,
		'accounting_value_profit_and_loss' => false,
		'warning_too_high_percentage' => false,
		'warning_too_low_percentage' => false,
		'info_residual_write_off' => false,
		'info_message_depreciation' => false,
		'info_message_income_recognition' => false,
		'negate' => false
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
        'object_identifier' => 'objectIdentifier',
        'object_group' => 'objectGroup',
        'account_number' => 'accountNumber',
        'type' => 'type',
        'opening_balance' => 'openingBalance',
        'opening_balance_tax_value' => 'openingBalanceTaxValue',
        'closing_balance' => 'closingBalance',
        'closing_balance_tax_value' => 'closingBalanceTaxValue',
        'new_acquisitions' => 'newAcquisitions',
        'acquisition_cost' => 'acquisitionCost',
        'improvements' => 'improvements',
        'public_subsidies' => 'publicSubsidies',
        'sales_and_other_realisation' => 'salesAndOtherRealisation',
        'sales_and_other_realisation_recognition' => 'salesAndOtherRealisationRecognition',
        'subsidies_for_regional_investments' => 'subsidiesForRegionalInvestments',
        'reversal_of_subsidies_for_regional_investments' => 'reversalOfSubsidiesForRegionalInvestments',
        'adjustment_of_input_vat' => 'adjustmentOfInputVat',
        'obvious_change_of_value' => 'obviousChangeOfValue',
        'unknown_transaction_type' => 'unknownTransactionType',
        'depreciation' => 'depreciation',
        'depreciation_tax_value' => 'depreciationTaxValue',
        'depreciation_percentage' => 'depreciationPercentage',
        'depreciation_percentage_tax_value' => 'depreciationPercentageTaxValue',
        'depreciation_difference' => 'depreciationDifference',
        'income_recognition_of_negative_balance' => 'incomeRecognitionOfNegativeBalance',
        'straight_line_depreciation' => 'straightLineDepreciation',
        'straight_line_depreciation_tax_value' => 'straightLineDepreciationTaxValue',
        'basis_for_depreciation_or_income_recognition' => 'basisForDepreciationOrIncomeRecognition',
        'basis_for_depreciation_or_income_recognition_tax_value' => 'basisForDepreciationOrIncomeRecognitionTaxValue',
        'profit_transfered_to_profit_and_loss_account' => 'profitTransferedToProfitAndLossAccount',
        'loss_transfered_to_profit_and_loss_account' => 'lossTransferedToProfitAndLossAccount',
        'accounting_value_profit_and_loss' => 'accountingValueProfitAndLoss',
        'warning_too_high_percentage' => 'warningTooHighPercentage',
        'warning_too_low_percentage' => 'warningTooLowPercentage',
        'info_residual_write_off' => 'infoResidualWriteOff',
        'info_message_depreciation' => 'infoMessageDepreciation',
        'info_message_income_recognition' => 'infoMessageIncomeRecognition',
        'negate' => 'negate'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'object_identifier' => 'setObjectIdentifier',
        'object_group' => 'setObjectGroup',
        'account_number' => 'setAccountNumber',
        'type' => 'setType',
        'opening_balance' => 'setOpeningBalance',
        'opening_balance_tax_value' => 'setOpeningBalanceTaxValue',
        'closing_balance' => 'setClosingBalance',
        'closing_balance_tax_value' => 'setClosingBalanceTaxValue',
        'new_acquisitions' => 'setNewAcquisitions',
        'acquisition_cost' => 'setAcquisitionCost',
        'improvements' => 'setImprovements',
        'public_subsidies' => 'setPublicSubsidies',
        'sales_and_other_realisation' => 'setSalesAndOtherRealisation',
        'sales_and_other_realisation_recognition' => 'setSalesAndOtherRealisationRecognition',
        'subsidies_for_regional_investments' => 'setSubsidiesForRegionalInvestments',
        'reversal_of_subsidies_for_regional_investments' => 'setReversalOfSubsidiesForRegionalInvestments',
        'adjustment_of_input_vat' => 'setAdjustmentOfInputVat',
        'obvious_change_of_value' => 'setObviousChangeOfValue',
        'unknown_transaction_type' => 'setUnknownTransactionType',
        'depreciation' => 'setDepreciation',
        'depreciation_tax_value' => 'setDepreciationTaxValue',
        'depreciation_percentage' => 'setDepreciationPercentage',
        'depreciation_percentage_tax_value' => 'setDepreciationPercentageTaxValue',
        'depreciation_difference' => 'setDepreciationDifference',
        'income_recognition_of_negative_balance' => 'setIncomeRecognitionOfNegativeBalance',
        'straight_line_depreciation' => 'setStraightLineDepreciation',
        'straight_line_depreciation_tax_value' => 'setStraightLineDepreciationTaxValue',
        'basis_for_depreciation_or_income_recognition' => 'setBasisForDepreciationOrIncomeRecognition',
        'basis_for_depreciation_or_income_recognition_tax_value' => 'setBasisForDepreciationOrIncomeRecognitionTaxValue',
        'profit_transfered_to_profit_and_loss_account' => 'setProfitTransferedToProfitAndLossAccount',
        'loss_transfered_to_profit_and_loss_account' => 'setLossTransferedToProfitAndLossAccount',
        'accounting_value_profit_and_loss' => 'setAccountingValueProfitAndLoss',
        'warning_too_high_percentage' => 'setWarningTooHighPercentage',
        'warning_too_low_percentage' => 'setWarningTooLowPercentage',
        'info_residual_write_off' => 'setInfoResidualWriteOff',
        'info_message_depreciation' => 'setInfoMessageDepreciation',
        'info_message_income_recognition' => 'setInfoMessageIncomeRecognition',
        'negate' => 'setNegate'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'object_identifier' => 'getObjectIdentifier',
        'object_group' => 'getObjectGroup',
        'account_number' => 'getAccountNumber',
        'type' => 'getType',
        'opening_balance' => 'getOpeningBalance',
        'opening_balance_tax_value' => 'getOpeningBalanceTaxValue',
        'closing_balance' => 'getClosingBalance',
        'closing_balance_tax_value' => 'getClosingBalanceTaxValue',
        'new_acquisitions' => 'getNewAcquisitions',
        'acquisition_cost' => 'getAcquisitionCost',
        'improvements' => 'getImprovements',
        'public_subsidies' => 'getPublicSubsidies',
        'sales_and_other_realisation' => 'getSalesAndOtherRealisation',
        'sales_and_other_realisation_recognition' => 'getSalesAndOtherRealisationRecognition',
        'subsidies_for_regional_investments' => 'getSubsidiesForRegionalInvestments',
        'reversal_of_subsidies_for_regional_investments' => 'getReversalOfSubsidiesForRegionalInvestments',
        'adjustment_of_input_vat' => 'getAdjustmentOfInputVat',
        'obvious_change_of_value' => 'getObviousChangeOfValue',
        'unknown_transaction_type' => 'getUnknownTransactionType',
        'depreciation' => 'getDepreciation',
        'depreciation_tax_value' => 'getDepreciationTaxValue',
        'depreciation_percentage' => 'getDepreciationPercentage',
        'depreciation_percentage_tax_value' => 'getDepreciationPercentageTaxValue',
        'depreciation_difference' => 'getDepreciationDifference',
        'income_recognition_of_negative_balance' => 'getIncomeRecognitionOfNegativeBalance',
        'straight_line_depreciation' => 'getStraightLineDepreciation',
        'straight_line_depreciation_tax_value' => 'getStraightLineDepreciationTaxValue',
        'basis_for_depreciation_or_income_recognition' => 'getBasisForDepreciationOrIncomeRecognition',
        'basis_for_depreciation_or_income_recognition_tax_value' => 'getBasisForDepreciationOrIncomeRecognitionTaxValue',
        'profit_transfered_to_profit_and_loss_account' => 'getProfitTransferedToProfitAndLossAccount',
        'loss_transfered_to_profit_and_loss_account' => 'getLossTransferedToProfitAndLossAccount',
        'accounting_value_profit_and_loss' => 'getAccountingValueProfitAndLoss',
        'warning_too_high_percentage' => 'getWarningTooHighPercentage',
        'warning_too_low_percentage' => 'getWarningTooLowPercentage',
        'info_residual_write_off' => 'getInfoResidualWriteOff',
        'info_message_depreciation' => 'getInfoMessageDepreciation',
        'info_message_income_recognition' => 'getInfoMessageIncomeRecognition',
        'negate' => 'getNegate'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('object_identifier', $data ?? [], null);
        $this->setIfExists('object_group', $data ?? [], null);
        $this->setIfExists('account_number', $data ?? [], null);
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('opening_balance', $data ?? [], null);
        $this->setIfExists('opening_balance_tax_value', $data ?? [], null);
        $this->setIfExists('closing_balance', $data ?? [], null);
        $this->setIfExists('closing_balance_tax_value', $data ?? [], null);
        $this->setIfExists('new_acquisitions', $data ?? [], null);
        $this->setIfExists('acquisition_cost', $data ?? [], null);
        $this->setIfExists('improvements', $data ?? [], null);
        $this->setIfExists('public_subsidies', $data ?? [], null);
        $this->setIfExists('sales_and_other_realisation', $data ?? [], null);
        $this->setIfExists('sales_and_other_realisation_recognition', $data ?? [], null);
        $this->setIfExists('subsidies_for_regional_investments', $data ?? [], null);
        $this->setIfExists('reversal_of_subsidies_for_regional_investments', $data ?? [], null);
        $this->setIfExists('adjustment_of_input_vat', $data ?? [], null);
        $this->setIfExists('obvious_change_of_value', $data ?? [], null);
        $this->setIfExists('unknown_transaction_type', $data ?? [], null);
        $this->setIfExists('depreciation', $data ?? [], null);
        $this->setIfExists('depreciation_tax_value', $data ?? [], null);
        $this->setIfExists('depreciation_percentage', $data ?? [], null);
        $this->setIfExists('depreciation_percentage_tax_value', $data ?? [], null);
        $this->setIfExists('depreciation_difference', $data ?? [], null);
        $this->setIfExists('income_recognition_of_negative_balance', $data ?? [], null);
        $this->setIfExists('straight_line_depreciation', $data ?? [], null);
        $this->setIfExists('straight_line_depreciation_tax_value', $data ?? [], null);
        $this->setIfExists('basis_for_depreciation_or_income_recognition', $data ?? [], null);
        $this->setIfExists('basis_for_depreciation_or_income_recognition_tax_value', $data ?? [], null);
        $this->setIfExists('profit_transfered_to_profit_and_loss_account', $data ?? [], null);
        $this->setIfExists('loss_transfered_to_profit_and_loss_account', $data ?? [], null);
        $this->setIfExists('accounting_value_profit_and_loss', $data ?? [], null);
        $this->setIfExists('warning_too_high_percentage', $data ?? [], null);
        $this->setIfExists('warning_too_low_percentage', $data ?? [], null);
        $this->setIfExists('info_residual_write_off', $data ?? [], null);
        $this->setIfExists('info_message_depreciation', $data ?? [], null);
        $this->setIfExists('info_message_income_recognition', $data ?? [], null);
        $this->setIfExists('negate', $data ?? [], null);
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
     * Gets object_identifier
     *
     * @return string|null
     */
    public function getObjectIdentifier()
    {
        return $this->container['object_identifier'];
    }

    /**
     * Sets object_identifier
     *
     * @param string|null $object_identifier object_identifier
     *
     * @return self
     */
    public function setObjectIdentifier($object_identifier)
    {
        if (is_null($object_identifier)) {
            throw new \InvalidArgumentException('non-nullable object_identifier cannot be null');
        }
        $this->container['object_identifier'] = $object_identifier;

        return $this;
    }

    /**
     * Gets object_group
     *
     * @return string|null
     */
    public function getObjectGroup()
    {
        return $this->container['object_group'];
    }

    /**
     * Sets object_group
     *
     * @param string|null $object_group object_group
     *
     * @return self
     */
    public function setObjectGroup($object_group)
    {
        if (is_null($object_group)) {
            throw new \InvalidArgumentException('non-nullable object_group cannot be null');
        }
        $this->container['object_group'] = $object_group;

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
     * @param string|null $account_number account_number
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
     * Gets type
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets opening_balance
     *
     * @return float|null
     */
    public function getOpeningBalance()
    {
        return $this->container['opening_balance'];
    }

    /**
     * Sets opening_balance
     *
     * @param float|null $opening_balance opening_balance
     *
     * @return self
     */
    public function setOpeningBalance($opening_balance)
    {
        if (is_null($opening_balance)) {
            throw new \InvalidArgumentException('non-nullable opening_balance cannot be null');
        }
        $this->container['opening_balance'] = $opening_balance;

        return $this;
    }

    /**
     * Gets opening_balance_tax_value
     *
     * @return float|null
     */
    public function getOpeningBalanceTaxValue()
    {
        return $this->container['opening_balance_tax_value'];
    }

    /**
     * Sets opening_balance_tax_value
     *
     * @param float|null $opening_balance_tax_value opening_balance_tax_value
     *
     * @return self
     */
    public function setOpeningBalanceTaxValue($opening_balance_tax_value)
    {
        if (is_null($opening_balance_tax_value)) {
            throw new \InvalidArgumentException('non-nullable opening_balance_tax_value cannot be null');
        }
        $this->container['opening_balance_tax_value'] = $opening_balance_tax_value;

        return $this;
    }

    /**
     * Gets closing_balance
     *
     * @return float|null
     */
    public function getClosingBalance()
    {
        return $this->container['closing_balance'];
    }

    /**
     * Sets closing_balance
     *
     * @param float|null $closing_balance closing_balance
     *
     * @return self
     */
    public function setClosingBalance($closing_balance)
    {
        if (is_null($closing_balance)) {
            throw new \InvalidArgumentException('non-nullable closing_balance cannot be null');
        }
        $this->container['closing_balance'] = $closing_balance;

        return $this;
    }

    /**
     * Gets closing_balance_tax_value
     *
     * @return float|null
     */
    public function getClosingBalanceTaxValue()
    {
        return $this->container['closing_balance_tax_value'];
    }

    /**
     * Sets closing_balance_tax_value
     *
     * @param float|null $closing_balance_tax_value closing_balance_tax_value
     *
     * @return self
     */
    public function setClosingBalanceTaxValue($closing_balance_tax_value)
    {
        if (is_null($closing_balance_tax_value)) {
            throw new \InvalidArgumentException('non-nullable closing_balance_tax_value cannot be null');
        }
        $this->container['closing_balance_tax_value'] = $closing_balance_tax_value;

        return $this;
    }

    /**
     * Gets new_acquisitions
     *
     * @return float|null
     */
    public function getNewAcquisitions()
    {
        return $this->container['new_acquisitions'];
    }

    /**
     * Sets new_acquisitions
     *
     * @param float|null $new_acquisitions new_acquisitions
     *
     * @return self
     */
    public function setNewAcquisitions($new_acquisitions)
    {
        if (is_null($new_acquisitions)) {
            throw new \InvalidArgumentException('non-nullable new_acquisitions cannot be null');
        }
        $this->container['new_acquisitions'] = $new_acquisitions;

        return $this;
    }

    /**
     * Gets acquisition_cost
     *
     * @return float|null
     */
    public function getAcquisitionCost()
    {
        return $this->container['acquisition_cost'];
    }

    /**
     * Sets acquisition_cost
     *
     * @param float|null $acquisition_cost acquisition_cost
     *
     * @return self
     */
    public function setAcquisitionCost($acquisition_cost)
    {
        if (is_null($acquisition_cost)) {
            throw new \InvalidArgumentException('non-nullable acquisition_cost cannot be null');
        }
        $this->container['acquisition_cost'] = $acquisition_cost;

        return $this;
    }

    /**
     * Gets improvements
     *
     * @return float|null
     */
    public function getImprovements()
    {
        return $this->container['improvements'];
    }

    /**
     * Sets improvements
     *
     * @param float|null $improvements improvements
     *
     * @return self
     */
    public function setImprovements($improvements)
    {
        if (is_null($improvements)) {
            throw new \InvalidArgumentException('non-nullable improvements cannot be null');
        }
        $this->container['improvements'] = $improvements;

        return $this;
    }

    /**
     * Gets public_subsidies
     *
     * @return float|null
     */
    public function getPublicSubsidies()
    {
        return $this->container['public_subsidies'];
    }

    /**
     * Sets public_subsidies
     *
     * @param float|null $public_subsidies public_subsidies
     *
     * @return self
     */
    public function setPublicSubsidies($public_subsidies)
    {
        if (is_null($public_subsidies)) {
            throw new \InvalidArgumentException('non-nullable public_subsidies cannot be null');
        }
        $this->container['public_subsidies'] = $public_subsidies;

        return $this;
    }

    /**
     * Gets sales_and_other_realisation
     *
     * @return float|null
     */
    public function getSalesAndOtherRealisation()
    {
        return $this->container['sales_and_other_realisation'];
    }

    /**
     * Sets sales_and_other_realisation
     *
     * @param float|null $sales_and_other_realisation sales_and_other_realisation
     *
     * @return self
     */
    public function setSalesAndOtherRealisation($sales_and_other_realisation)
    {
        if (is_null($sales_and_other_realisation)) {
            throw new \InvalidArgumentException('non-nullable sales_and_other_realisation cannot be null');
        }
        $this->container['sales_and_other_realisation'] = $sales_and_other_realisation;

        return $this;
    }

    /**
     * Gets sales_and_other_realisation_recognition
     *
     * @return float|null
     */
    public function getSalesAndOtherRealisationRecognition()
    {
        return $this->container['sales_and_other_realisation_recognition'];
    }

    /**
     * Sets sales_and_other_realisation_recognition
     *
     * @param float|null $sales_and_other_realisation_recognition sales_and_other_realisation_recognition
     *
     * @return self
     */
    public function setSalesAndOtherRealisationRecognition($sales_and_other_realisation_recognition)
    {
        if (is_null($sales_and_other_realisation_recognition)) {
            throw new \InvalidArgumentException('non-nullable sales_and_other_realisation_recognition cannot be null');
        }
        $this->container['sales_and_other_realisation_recognition'] = $sales_and_other_realisation_recognition;

        return $this;
    }

    /**
     * Gets subsidies_for_regional_investments
     *
     * @return float|null
     */
    public function getSubsidiesForRegionalInvestments()
    {
        return $this->container['subsidies_for_regional_investments'];
    }

    /**
     * Sets subsidies_for_regional_investments
     *
     * @param float|null $subsidies_for_regional_investments subsidies_for_regional_investments
     *
     * @return self
     */
    public function setSubsidiesForRegionalInvestments($subsidies_for_regional_investments)
    {
        if (is_null($subsidies_for_regional_investments)) {
            throw new \InvalidArgumentException('non-nullable subsidies_for_regional_investments cannot be null');
        }
        $this->container['subsidies_for_regional_investments'] = $subsidies_for_regional_investments;

        return $this;
    }

    /**
     * Gets reversal_of_subsidies_for_regional_investments
     *
     * @return float|null
     */
    public function getReversalOfSubsidiesForRegionalInvestments()
    {
        return $this->container['reversal_of_subsidies_for_regional_investments'];
    }

    /**
     * Sets reversal_of_subsidies_for_regional_investments
     *
     * @param float|null $reversal_of_subsidies_for_regional_investments reversal_of_subsidies_for_regional_investments
     *
     * @return self
     */
    public function setReversalOfSubsidiesForRegionalInvestments($reversal_of_subsidies_for_regional_investments)
    {
        if (is_null($reversal_of_subsidies_for_regional_investments)) {
            throw new \InvalidArgumentException('non-nullable reversal_of_subsidies_for_regional_investments cannot be null');
        }
        $this->container['reversal_of_subsidies_for_regional_investments'] = $reversal_of_subsidies_for_regional_investments;

        return $this;
    }

    /**
     * Gets adjustment_of_input_vat
     *
     * @return float|null
     */
    public function getAdjustmentOfInputVat()
    {
        return $this->container['adjustment_of_input_vat'];
    }

    /**
     * Sets adjustment_of_input_vat
     *
     * @param float|null $adjustment_of_input_vat adjustment_of_input_vat
     *
     * @return self
     */
    public function setAdjustmentOfInputVat($adjustment_of_input_vat)
    {
        if (is_null($adjustment_of_input_vat)) {
            throw new \InvalidArgumentException('non-nullable adjustment_of_input_vat cannot be null');
        }
        $this->container['adjustment_of_input_vat'] = $adjustment_of_input_vat;

        return $this;
    }

    /**
     * Gets obvious_change_of_value
     *
     * @return float|null
     */
    public function getObviousChangeOfValue()
    {
        return $this->container['obvious_change_of_value'];
    }

    /**
     * Sets obvious_change_of_value
     *
     * @param float|null $obvious_change_of_value obvious_change_of_value
     *
     * @return self
     */
    public function setObviousChangeOfValue($obvious_change_of_value)
    {
        if (is_null($obvious_change_of_value)) {
            throw new \InvalidArgumentException('non-nullable obvious_change_of_value cannot be null');
        }
        $this->container['obvious_change_of_value'] = $obvious_change_of_value;

        return $this;
    }

    /**
     * Gets unknown_transaction_type
     *
     * @return float|null
     */
    public function getUnknownTransactionType()
    {
        return $this->container['unknown_transaction_type'];
    }

    /**
     * Sets unknown_transaction_type
     *
     * @param float|null $unknown_transaction_type unknown_transaction_type
     *
     * @return self
     */
    public function setUnknownTransactionType($unknown_transaction_type)
    {
        if (is_null($unknown_transaction_type)) {
            throw new \InvalidArgumentException('non-nullable unknown_transaction_type cannot be null');
        }
        $this->container['unknown_transaction_type'] = $unknown_transaction_type;

        return $this;
    }

    /**
     * Gets depreciation
     *
     * @return float|null
     */
    public function getDepreciation()
    {
        return $this->container['depreciation'];
    }

    /**
     * Sets depreciation
     *
     * @param float|null $depreciation depreciation
     *
     * @return self
     */
    public function setDepreciation($depreciation)
    {
        if (is_null($depreciation)) {
            throw new \InvalidArgumentException('non-nullable depreciation cannot be null');
        }
        $this->container['depreciation'] = $depreciation;

        return $this;
    }

    /**
     * Gets depreciation_tax_value
     *
     * @return float|null
     */
    public function getDepreciationTaxValue()
    {
        return $this->container['depreciation_tax_value'];
    }

    /**
     * Sets depreciation_tax_value
     *
     * @param float|null $depreciation_tax_value depreciation_tax_value
     *
     * @return self
     */
    public function setDepreciationTaxValue($depreciation_tax_value)
    {
        if (is_null($depreciation_tax_value)) {
            throw new \InvalidArgumentException('non-nullable depreciation_tax_value cannot be null');
        }
        $this->container['depreciation_tax_value'] = $depreciation_tax_value;

        return $this;
    }

    /**
     * Gets depreciation_percentage
     *
     * @return float|null
     */
    public function getDepreciationPercentage()
    {
        return $this->container['depreciation_percentage'];
    }

    /**
     * Sets depreciation_percentage
     *
     * @param float|null $depreciation_percentage depreciation_percentage
     *
     * @return self
     */
    public function setDepreciationPercentage($depreciation_percentage)
    {
        if (is_null($depreciation_percentage)) {
            throw new \InvalidArgumentException('non-nullable depreciation_percentage cannot be null');
        }
        $this->container['depreciation_percentage'] = $depreciation_percentage;

        return $this;
    }

    /**
     * Gets depreciation_percentage_tax_value
     *
     * @return float|null
     */
    public function getDepreciationPercentageTaxValue()
    {
        return $this->container['depreciation_percentage_tax_value'];
    }

    /**
     * Sets depreciation_percentage_tax_value
     *
     * @param float|null $depreciation_percentage_tax_value depreciation_percentage_tax_value
     *
     * @return self
     */
    public function setDepreciationPercentageTaxValue($depreciation_percentage_tax_value)
    {
        if (is_null($depreciation_percentage_tax_value)) {
            throw new \InvalidArgumentException('non-nullable depreciation_percentage_tax_value cannot be null');
        }
        $this->container['depreciation_percentage_tax_value'] = $depreciation_percentage_tax_value;

        return $this;
    }

    /**
     * Gets depreciation_difference
     *
     * @return float|null
     */
    public function getDepreciationDifference()
    {
        return $this->container['depreciation_difference'];
    }

    /**
     * Sets depreciation_difference
     *
     * @param float|null $depreciation_difference depreciation_difference
     *
     * @return self
     */
    public function setDepreciationDifference($depreciation_difference)
    {
        if (is_null($depreciation_difference)) {
            throw new \InvalidArgumentException('non-nullable depreciation_difference cannot be null');
        }
        $this->container['depreciation_difference'] = $depreciation_difference;

        return $this;
    }

    /**
     * Gets income_recognition_of_negative_balance
     *
     * @return float|null
     */
    public function getIncomeRecognitionOfNegativeBalance()
    {
        return $this->container['income_recognition_of_negative_balance'];
    }

    /**
     * Sets income_recognition_of_negative_balance
     *
     * @param float|null $income_recognition_of_negative_balance income_recognition_of_negative_balance
     *
     * @return self
     */
    public function setIncomeRecognitionOfNegativeBalance($income_recognition_of_negative_balance)
    {
        if (is_null($income_recognition_of_negative_balance)) {
            throw new \InvalidArgumentException('non-nullable income_recognition_of_negative_balance cannot be null');
        }
        $this->container['income_recognition_of_negative_balance'] = $income_recognition_of_negative_balance;

        return $this;
    }

    /**
     * Gets straight_line_depreciation
     *
     * @return float|null
     */
    public function getStraightLineDepreciation()
    {
        return $this->container['straight_line_depreciation'];
    }

    /**
     * Sets straight_line_depreciation
     *
     * @param float|null $straight_line_depreciation straight_line_depreciation
     *
     * @return self
     */
    public function setStraightLineDepreciation($straight_line_depreciation)
    {
        if (is_null($straight_line_depreciation)) {
            throw new \InvalidArgumentException('non-nullable straight_line_depreciation cannot be null');
        }
        $this->container['straight_line_depreciation'] = $straight_line_depreciation;

        return $this;
    }

    /**
     * Gets straight_line_depreciation_tax_value
     *
     * @return float|null
     */
    public function getStraightLineDepreciationTaxValue()
    {
        return $this->container['straight_line_depreciation_tax_value'];
    }

    /**
     * Sets straight_line_depreciation_tax_value
     *
     * @param float|null $straight_line_depreciation_tax_value straight_line_depreciation_tax_value
     *
     * @return self
     */
    public function setStraightLineDepreciationTaxValue($straight_line_depreciation_tax_value)
    {
        if (is_null($straight_line_depreciation_tax_value)) {
            throw new \InvalidArgumentException('non-nullable straight_line_depreciation_tax_value cannot be null');
        }
        $this->container['straight_line_depreciation_tax_value'] = $straight_line_depreciation_tax_value;

        return $this;
    }

    /**
     * Gets basis_for_depreciation_or_income_recognition
     *
     * @return float|null
     */
    public function getBasisForDepreciationOrIncomeRecognition()
    {
        return $this->container['basis_for_depreciation_or_income_recognition'];
    }

    /**
     * Sets basis_for_depreciation_or_income_recognition
     *
     * @param float|null $basis_for_depreciation_or_income_recognition basis_for_depreciation_or_income_recognition
     *
     * @return self
     */
    public function setBasisForDepreciationOrIncomeRecognition($basis_for_depreciation_or_income_recognition)
    {
        if (is_null($basis_for_depreciation_or_income_recognition)) {
            throw new \InvalidArgumentException('non-nullable basis_for_depreciation_or_income_recognition cannot be null');
        }
        $this->container['basis_for_depreciation_or_income_recognition'] = $basis_for_depreciation_or_income_recognition;

        return $this;
    }

    /**
     * Gets basis_for_depreciation_or_income_recognition_tax_value
     *
     * @return float|null
     */
    public function getBasisForDepreciationOrIncomeRecognitionTaxValue()
    {
        return $this->container['basis_for_depreciation_or_income_recognition_tax_value'];
    }

    /**
     * Sets basis_for_depreciation_or_income_recognition_tax_value
     *
     * @param float|null $basis_for_depreciation_or_income_recognition_tax_value basis_for_depreciation_or_income_recognition_tax_value
     *
     * @return self
     */
    public function setBasisForDepreciationOrIncomeRecognitionTaxValue($basis_for_depreciation_or_income_recognition_tax_value)
    {
        if (is_null($basis_for_depreciation_or_income_recognition_tax_value)) {
            throw new \InvalidArgumentException('non-nullable basis_for_depreciation_or_income_recognition_tax_value cannot be null');
        }
        $this->container['basis_for_depreciation_or_income_recognition_tax_value'] = $basis_for_depreciation_or_income_recognition_tax_value;

        return $this;
    }

    /**
     * Gets profit_transfered_to_profit_and_loss_account
     *
     * @return float|null
     */
    public function getProfitTransferedToProfitAndLossAccount()
    {
        return $this->container['profit_transfered_to_profit_and_loss_account'];
    }

    /**
     * Sets profit_transfered_to_profit_and_loss_account
     *
     * @param float|null $profit_transfered_to_profit_and_loss_account profit_transfered_to_profit_and_loss_account
     *
     * @return self
     */
    public function setProfitTransferedToProfitAndLossAccount($profit_transfered_to_profit_and_loss_account)
    {
        if (is_null($profit_transfered_to_profit_and_loss_account)) {
            throw new \InvalidArgumentException('non-nullable profit_transfered_to_profit_and_loss_account cannot be null');
        }
        $this->container['profit_transfered_to_profit_and_loss_account'] = $profit_transfered_to_profit_and_loss_account;

        return $this;
    }

    /**
     * Gets loss_transfered_to_profit_and_loss_account
     *
     * @return float|null
     */
    public function getLossTransferedToProfitAndLossAccount()
    {
        return $this->container['loss_transfered_to_profit_and_loss_account'];
    }

    /**
     * Sets loss_transfered_to_profit_and_loss_account
     *
     * @param float|null $loss_transfered_to_profit_and_loss_account loss_transfered_to_profit_and_loss_account
     *
     * @return self
     */
    public function setLossTransferedToProfitAndLossAccount($loss_transfered_to_profit_and_loss_account)
    {
        if (is_null($loss_transfered_to_profit_and_loss_account)) {
            throw new \InvalidArgumentException('non-nullable loss_transfered_to_profit_and_loss_account cannot be null');
        }
        $this->container['loss_transfered_to_profit_and_loss_account'] = $loss_transfered_to_profit_and_loss_account;

        return $this;
    }

    /**
     * Gets accounting_value_profit_and_loss
     *
     * @return string|null
     */
    public function getAccountingValueProfitAndLoss()
    {
        return $this->container['accounting_value_profit_and_loss'];
    }

    /**
     * Sets accounting_value_profit_and_loss
     *
     * @param string|null $accounting_value_profit_and_loss accounting_value_profit_and_loss
     *
     * @return self
     */
    public function setAccountingValueProfitAndLoss($accounting_value_profit_and_loss)
    {
        if (is_null($accounting_value_profit_and_loss)) {
            throw new \InvalidArgumentException('non-nullable accounting_value_profit_and_loss cannot be null');
        }
        $this->container['accounting_value_profit_and_loss'] = $accounting_value_profit_and_loss;

        return $this;
    }

    /**
     * Gets warning_too_high_percentage
     *
     * @return string|null
     */
    public function getWarningTooHighPercentage()
    {
        return $this->container['warning_too_high_percentage'];
    }

    /**
     * Sets warning_too_high_percentage
     *
     * @param string|null $warning_too_high_percentage warning_too_high_percentage
     *
     * @return self
     */
    public function setWarningTooHighPercentage($warning_too_high_percentage)
    {
        if (is_null($warning_too_high_percentage)) {
            throw new \InvalidArgumentException('non-nullable warning_too_high_percentage cannot be null');
        }
        $this->container['warning_too_high_percentage'] = $warning_too_high_percentage;

        return $this;
    }

    /**
     * Gets warning_too_low_percentage
     *
     * @return string|null
     */
    public function getWarningTooLowPercentage()
    {
        return $this->container['warning_too_low_percentage'];
    }

    /**
     * Sets warning_too_low_percentage
     *
     * @param string|null $warning_too_low_percentage warning_too_low_percentage
     *
     * @return self
     */
    public function setWarningTooLowPercentage($warning_too_low_percentage)
    {
        if (is_null($warning_too_low_percentage)) {
            throw new \InvalidArgumentException('non-nullable warning_too_low_percentage cannot be null');
        }
        $this->container['warning_too_low_percentage'] = $warning_too_low_percentage;

        return $this;
    }

    /**
     * Gets info_residual_write_off
     *
     * @return string|null
     */
    public function getInfoResidualWriteOff()
    {
        return $this->container['info_residual_write_off'];
    }

    /**
     * Sets info_residual_write_off
     *
     * @param string|null $info_residual_write_off info_residual_write_off
     *
     * @return self
     */
    public function setInfoResidualWriteOff($info_residual_write_off)
    {
        if (is_null($info_residual_write_off)) {
            throw new \InvalidArgumentException('non-nullable info_residual_write_off cannot be null');
        }
        $this->container['info_residual_write_off'] = $info_residual_write_off;

        return $this;
    }

    /**
     * Gets info_message_depreciation
     *
     * @return string|null
     */
    public function getInfoMessageDepreciation()
    {
        return $this->container['info_message_depreciation'];
    }

    /**
     * Sets info_message_depreciation
     *
     * @param string|null $info_message_depreciation info_message_depreciation
     *
     * @return self
     */
    public function setInfoMessageDepreciation($info_message_depreciation)
    {
        if (is_null($info_message_depreciation)) {
            throw new \InvalidArgumentException('non-nullable info_message_depreciation cannot be null');
        }
        $this->container['info_message_depreciation'] = $info_message_depreciation;

        return $this;
    }

    /**
     * Gets info_message_income_recognition
     *
     * @return string|null
     */
    public function getInfoMessageIncomeRecognition()
    {
        return $this->container['info_message_income_recognition'];
    }

    /**
     * Sets info_message_income_recognition
     *
     * @param string|null $info_message_income_recognition info_message_income_recognition
     *
     * @return self
     */
    public function setInfoMessageIncomeRecognition($info_message_income_recognition)
    {
        if (is_null($info_message_income_recognition)) {
            throw new \InvalidArgumentException('non-nullable info_message_income_recognition cannot be null');
        }
        $this->container['info_message_income_recognition'] = $info_message_income_recognition;

        return $this;
    }

    /**
     * Gets negate
     *
     * @return bool|null
     */
    public function getNegate()
    {
        return $this->container['negate'];
    }

    /**
     * Sets negate
     *
     * @param bool|null $negate negate
     *
     * @return self
     */
    public function setNegate($negate)
    {
        if (is_null($negate)) {
            throw new \InvalidArgumentException('non-nullable negate cannot be null');
        }
        $this->container['negate'] = $negate;

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


