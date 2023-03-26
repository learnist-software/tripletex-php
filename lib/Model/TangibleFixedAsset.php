<?php
/**
 * TangibleFixedAsset
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
 * TangibleFixedAsset Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TangibleFixedAsset implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'TangibleFixedAsset';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
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
'negate' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
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
'negate' => null    ];

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
'negate' => 'negate'    ];

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
'negate' => 'setNegate'    ];

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
'negate' => 'getNegate'    ];

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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['object_identifier'] = isset($data['object_identifier']) ? $data['object_identifier'] : null;
        $this->container['object_group'] = isset($data['object_group']) ? $data['object_group'] : null;
        $this->container['account_number'] = isset($data['account_number']) ? $data['account_number'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['opening_balance'] = isset($data['opening_balance']) ? $data['opening_balance'] : null;
        $this->container['opening_balance_tax_value'] = isset($data['opening_balance_tax_value']) ? $data['opening_balance_tax_value'] : null;
        $this->container['closing_balance'] = isset($data['closing_balance']) ? $data['closing_balance'] : null;
        $this->container['closing_balance_tax_value'] = isset($data['closing_balance_tax_value']) ? $data['closing_balance_tax_value'] : null;
        $this->container['new_acquisitions'] = isset($data['new_acquisitions']) ? $data['new_acquisitions'] : null;
        $this->container['acquisition_cost'] = isset($data['acquisition_cost']) ? $data['acquisition_cost'] : null;
        $this->container['improvements'] = isset($data['improvements']) ? $data['improvements'] : null;
        $this->container['public_subsidies'] = isset($data['public_subsidies']) ? $data['public_subsidies'] : null;
        $this->container['sales_and_other_realisation'] = isset($data['sales_and_other_realisation']) ? $data['sales_and_other_realisation'] : null;
        $this->container['sales_and_other_realisation_recognition'] = isset($data['sales_and_other_realisation_recognition']) ? $data['sales_and_other_realisation_recognition'] : null;
        $this->container['subsidies_for_regional_investments'] = isset($data['subsidies_for_regional_investments']) ? $data['subsidies_for_regional_investments'] : null;
        $this->container['reversal_of_subsidies_for_regional_investments'] = isset($data['reversal_of_subsidies_for_regional_investments']) ? $data['reversal_of_subsidies_for_regional_investments'] : null;
        $this->container['adjustment_of_input_vat'] = isset($data['adjustment_of_input_vat']) ? $data['adjustment_of_input_vat'] : null;
        $this->container['obvious_change_of_value'] = isset($data['obvious_change_of_value']) ? $data['obvious_change_of_value'] : null;
        $this->container['unknown_transaction_type'] = isset($data['unknown_transaction_type']) ? $data['unknown_transaction_type'] : null;
        $this->container['depreciation'] = isset($data['depreciation']) ? $data['depreciation'] : null;
        $this->container['depreciation_tax_value'] = isset($data['depreciation_tax_value']) ? $data['depreciation_tax_value'] : null;
        $this->container['depreciation_percentage'] = isset($data['depreciation_percentage']) ? $data['depreciation_percentage'] : null;
        $this->container['depreciation_percentage_tax_value'] = isset($data['depreciation_percentage_tax_value']) ? $data['depreciation_percentage_tax_value'] : null;
        $this->container['depreciation_difference'] = isset($data['depreciation_difference']) ? $data['depreciation_difference'] : null;
        $this->container['income_recognition_of_negative_balance'] = isset($data['income_recognition_of_negative_balance']) ? $data['income_recognition_of_negative_balance'] : null;
        $this->container['straight_line_depreciation'] = isset($data['straight_line_depreciation']) ? $data['straight_line_depreciation'] : null;
        $this->container['straight_line_depreciation_tax_value'] = isset($data['straight_line_depreciation_tax_value']) ? $data['straight_line_depreciation_tax_value'] : null;
        $this->container['basis_for_depreciation_or_income_recognition'] = isset($data['basis_for_depreciation_or_income_recognition']) ? $data['basis_for_depreciation_or_income_recognition'] : null;
        $this->container['basis_for_depreciation_or_income_recognition_tax_value'] = isset($data['basis_for_depreciation_or_income_recognition_tax_value']) ? $data['basis_for_depreciation_or_income_recognition_tax_value'] : null;
        $this->container['profit_transfered_to_profit_and_loss_account'] = isset($data['profit_transfered_to_profit_and_loss_account']) ? $data['profit_transfered_to_profit_and_loss_account'] : null;
        $this->container['loss_transfered_to_profit_and_loss_account'] = isset($data['loss_transfered_to_profit_and_loss_account']) ? $data['loss_transfered_to_profit_and_loss_account'] : null;
        $this->container['accounting_value_profit_and_loss'] = isset($data['accounting_value_profit_and_loss']) ? $data['accounting_value_profit_and_loss'] : null;
        $this->container['warning_too_high_percentage'] = isset($data['warning_too_high_percentage']) ? $data['warning_too_high_percentage'] : null;
        $this->container['warning_too_low_percentage'] = isset($data['warning_too_low_percentage']) ? $data['warning_too_low_percentage'] : null;
        $this->container['info_residual_write_off'] = isset($data['info_residual_write_off']) ? $data['info_residual_write_off'] : null;
        $this->container['info_message_depreciation'] = isset($data['info_message_depreciation']) ? $data['info_message_depreciation'] : null;
        $this->container['info_message_income_recognition'] = isset($data['info_message_income_recognition']) ? $data['info_message_income_recognition'] : null;
        $this->container['negate'] = isset($data['negate']) ? $data['negate'] : null;
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
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets object_identifier
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        return $this->container['object_identifier'];
    }

    /**
     * Sets object_identifier
     *
     * @param string $object_identifier object_identifier
     *
     * @return $this
     */
    public function setObjectIdentifier($object_identifier)
    {
        $this->container['object_identifier'] = $object_identifier;

        return $this;
    }

    /**
     * Gets object_group
     *
     * @return string
     */
    public function getObjectGroup()
    {
        return $this->container['object_group'];
    }

    /**
     * Sets object_group
     *
     * @param string $object_group object_group
     *
     * @return $this
     */
    public function setObjectGroup($object_group)
    {
        $this->container['object_group'] = $object_group;

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
     * @param string $account_number account_number
     *
     * @return $this
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

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
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets opening_balance
     *
     * @return float
     */
    public function getOpeningBalance()
    {
        return $this->container['opening_balance'];
    }

    /**
     * Sets opening_balance
     *
     * @param float $opening_balance opening_balance
     *
     * @return $this
     */
    public function setOpeningBalance($opening_balance)
    {
        $this->container['opening_balance'] = $opening_balance;

        return $this;
    }

    /**
     * Gets opening_balance_tax_value
     *
     * @return float
     */
    public function getOpeningBalanceTaxValue()
    {
        return $this->container['opening_balance_tax_value'];
    }

    /**
     * Sets opening_balance_tax_value
     *
     * @param float $opening_balance_tax_value opening_balance_tax_value
     *
     * @return $this
     */
    public function setOpeningBalanceTaxValue($opening_balance_tax_value)
    {
        $this->container['opening_balance_tax_value'] = $opening_balance_tax_value;

        return $this;
    }

    /**
     * Gets closing_balance
     *
     * @return float
     */
    public function getClosingBalance()
    {
        return $this->container['closing_balance'];
    }

    /**
     * Sets closing_balance
     *
     * @param float $closing_balance closing_balance
     *
     * @return $this
     */
    public function setClosingBalance($closing_balance)
    {
        $this->container['closing_balance'] = $closing_balance;

        return $this;
    }

    /**
     * Gets closing_balance_tax_value
     *
     * @return float
     */
    public function getClosingBalanceTaxValue()
    {
        return $this->container['closing_balance_tax_value'];
    }

    /**
     * Sets closing_balance_tax_value
     *
     * @param float $closing_balance_tax_value closing_balance_tax_value
     *
     * @return $this
     */
    public function setClosingBalanceTaxValue($closing_balance_tax_value)
    {
        $this->container['closing_balance_tax_value'] = $closing_balance_tax_value;

        return $this;
    }

    /**
     * Gets new_acquisitions
     *
     * @return float
     */
    public function getNewAcquisitions()
    {
        return $this->container['new_acquisitions'];
    }

    /**
     * Sets new_acquisitions
     *
     * @param float $new_acquisitions new_acquisitions
     *
     * @return $this
     */
    public function setNewAcquisitions($new_acquisitions)
    {
        $this->container['new_acquisitions'] = $new_acquisitions;

        return $this;
    }

    /**
     * Gets acquisition_cost
     *
     * @return float
     */
    public function getAcquisitionCost()
    {
        return $this->container['acquisition_cost'];
    }

    /**
     * Sets acquisition_cost
     *
     * @param float $acquisition_cost acquisition_cost
     *
     * @return $this
     */
    public function setAcquisitionCost($acquisition_cost)
    {
        $this->container['acquisition_cost'] = $acquisition_cost;

        return $this;
    }

    /**
     * Gets improvements
     *
     * @return float
     */
    public function getImprovements()
    {
        return $this->container['improvements'];
    }

    /**
     * Sets improvements
     *
     * @param float $improvements improvements
     *
     * @return $this
     */
    public function setImprovements($improvements)
    {
        $this->container['improvements'] = $improvements;

        return $this;
    }

    /**
     * Gets public_subsidies
     *
     * @return float
     */
    public function getPublicSubsidies()
    {
        return $this->container['public_subsidies'];
    }

    /**
     * Sets public_subsidies
     *
     * @param float $public_subsidies public_subsidies
     *
     * @return $this
     */
    public function setPublicSubsidies($public_subsidies)
    {
        $this->container['public_subsidies'] = $public_subsidies;

        return $this;
    }

    /**
     * Gets sales_and_other_realisation
     *
     * @return float
     */
    public function getSalesAndOtherRealisation()
    {
        return $this->container['sales_and_other_realisation'];
    }

    /**
     * Sets sales_and_other_realisation
     *
     * @param float $sales_and_other_realisation sales_and_other_realisation
     *
     * @return $this
     */
    public function setSalesAndOtherRealisation($sales_and_other_realisation)
    {
        $this->container['sales_and_other_realisation'] = $sales_and_other_realisation;

        return $this;
    }

    /**
     * Gets sales_and_other_realisation_recognition
     *
     * @return float
     */
    public function getSalesAndOtherRealisationRecognition()
    {
        return $this->container['sales_and_other_realisation_recognition'];
    }

    /**
     * Sets sales_and_other_realisation_recognition
     *
     * @param float $sales_and_other_realisation_recognition sales_and_other_realisation_recognition
     *
     * @return $this
     */
    public function setSalesAndOtherRealisationRecognition($sales_and_other_realisation_recognition)
    {
        $this->container['sales_and_other_realisation_recognition'] = $sales_and_other_realisation_recognition;

        return $this;
    }

    /**
     * Gets subsidies_for_regional_investments
     *
     * @return float
     */
    public function getSubsidiesForRegionalInvestments()
    {
        return $this->container['subsidies_for_regional_investments'];
    }

    /**
     * Sets subsidies_for_regional_investments
     *
     * @param float $subsidies_for_regional_investments subsidies_for_regional_investments
     *
     * @return $this
     */
    public function setSubsidiesForRegionalInvestments($subsidies_for_regional_investments)
    {
        $this->container['subsidies_for_regional_investments'] = $subsidies_for_regional_investments;

        return $this;
    }

    /**
     * Gets reversal_of_subsidies_for_regional_investments
     *
     * @return float
     */
    public function getReversalOfSubsidiesForRegionalInvestments()
    {
        return $this->container['reversal_of_subsidies_for_regional_investments'];
    }

    /**
     * Sets reversal_of_subsidies_for_regional_investments
     *
     * @param float $reversal_of_subsidies_for_regional_investments reversal_of_subsidies_for_regional_investments
     *
     * @return $this
     */
    public function setReversalOfSubsidiesForRegionalInvestments($reversal_of_subsidies_for_regional_investments)
    {
        $this->container['reversal_of_subsidies_for_regional_investments'] = $reversal_of_subsidies_for_regional_investments;

        return $this;
    }

    /**
     * Gets adjustment_of_input_vat
     *
     * @return float
     */
    public function getAdjustmentOfInputVat()
    {
        return $this->container['adjustment_of_input_vat'];
    }

    /**
     * Sets adjustment_of_input_vat
     *
     * @param float $adjustment_of_input_vat adjustment_of_input_vat
     *
     * @return $this
     */
    public function setAdjustmentOfInputVat($adjustment_of_input_vat)
    {
        $this->container['adjustment_of_input_vat'] = $adjustment_of_input_vat;

        return $this;
    }

    /**
     * Gets obvious_change_of_value
     *
     * @return float
     */
    public function getObviousChangeOfValue()
    {
        return $this->container['obvious_change_of_value'];
    }

    /**
     * Sets obvious_change_of_value
     *
     * @param float $obvious_change_of_value obvious_change_of_value
     *
     * @return $this
     */
    public function setObviousChangeOfValue($obvious_change_of_value)
    {
        $this->container['obvious_change_of_value'] = $obvious_change_of_value;

        return $this;
    }

    /**
     * Gets unknown_transaction_type
     *
     * @return float
     */
    public function getUnknownTransactionType()
    {
        return $this->container['unknown_transaction_type'];
    }

    /**
     * Sets unknown_transaction_type
     *
     * @param float $unknown_transaction_type unknown_transaction_type
     *
     * @return $this
     */
    public function setUnknownTransactionType($unknown_transaction_type)
    {
        $this->container['unknown_transaction_type'] = $unknown_transaction_type;

        return $this;
    }

    /**
     * Gets depreciation
     *
     * @return float
     */
    public function getDepreciation()
    {
        return $this->container['depreciation'];
    }

    /**
     * Sets depreciation
     *
     * @param float $depreciation depreciation
     *
     * @return $this
     */
    public function setDepreciation($depreciation)
    {
        $this->container['depreciation'] = $depreciation;

        return $this;
    }

    /**
     * Gets depreciation_tax_value
     *
     * @return float
     */
    public function getDepreciationTaxValue()
    {
        return $this->container['depreciation_tax_value'];
    }

    /**
     * Sets depreciation_tax_value
     *
     * @param float $depreciation_tax_value depreciation_tax_value
     *
     * @return $this
     */
    public function setDepreciationTaxValue($depreciation_tax_value)
    {
        $this->container['depreciation_tax_value'] = $depreciation_tax_value;

        return $this;
    }

    /**
     * Gets depreciation_percentage
     *
     * @return float
     */
    public function getDepreciationPercentage()
    {
        return $this->container['depreciation_percentage'];
    }

    /**
     * Sets depreciation_percentage
     *
     * @param float $depreciation_percentage depreciation_percentage
     *
     * @return $this
     */
    public function setDepreciationPercentage($depreciation_percentage)
    {
        $this->container['depreciation_percentage'] = $depreciation_percentage;

        return $this;
    }

    /**
     * Gets depreciation_percentage_tax_value
     *
     * @return float
     */
    public function getDepreciationPercentageTaxValue()
    {
        return $this->container['depreciation_percentage_tax_value'];
    }

    /**
     * Sets depreciation_percentage_tax_value
     *
     * @param float $depreciation_percentage_tax_value depreciation_percentage_tax_value
     *
     * @return $this
     */
    public function setDepreciationPercentageTaxValue($depreciation_percentage_tax_value)
    {
        $this->container['depreciation_percentage_tax_value'] = $depreciation_percentage_tax_value;

        return $this;
    }

    /**
     * Gets depreciation_difference
     *
     * @return float
     */
    public function getDepreciationDifference()
    {
        return $this->container['depreciation_difference'];
    }

    /**
     * Sets depreciation_difference
     *
     * @param float $depreciation_difference depreciation_difference
     *
     * @return $this
     */
    public function setDepreciationDifference($depreciation_difference)
    {
        $this->container['depreciation_difference'] = $depreciation_difference;

        return $this;
    }

    /**
     * Gets income_recognition_of_negative_balance
     *
     * @return float
     */
    public function getIncomeRecognitionOfNegativeBalance()
    {
        return $this->container['income_recognition_of_negative_balance'];
    }

    /**
     * Sets income_recognition_of_negative_balance
     *
     * @param float $income_recognition_of_negative_balance income_recognition_of_negative_balance
     *
     * @return $this
     */
    public function setIncomeRecognitionOfNegativeBalance($income_recognition_of_negative_balance)
    {
        $this->container['income_recognition_of_negative_balance'] = $income_recognition_of_negative_balance;

        return $this;
    }

    /**
     * Gets straight_line_depreciation
     *
     * @return float
     */
    public function getStraightLineDepreciation()
    {
        return $this->container['straight_line_depreciation'];
    }

    /**
     * Sets straight_line_depreciation
     *
     * @param float $straight_line_depreciation straight_line_depreciation
     *
     * @return $this
     */
    public function setStraightLineDepreciation($straight_line_depreciation)
    {
        $this->container['straight_line_depreciation'] = $straight_line_depreciation;

        return $this;
    }

    /**
     * Gets straight_line_depreciation_tax_value
     *
     * @return float
     */
    public function getStraightLineDepreciationTaxValue()
    {
        return $this->container['straight_line_depreciation_tax_value'];
    }

    /**
     * Sets straight_line_depreciation_tax_value
     *
     * @param float $straight_line_depreciation_tax_value straight_line_depreciation_tax_value
     *
     * @return $this
     */
    public function setStraightLineDepreciationTaxValue($straight_line_depreciation_tax_value)
    {
        $this->container['straight_line_depreciation_tax_value'] = $straight_line_depreciation_tax_value;

        return $this;
    }

    /**
     * Gets basis_for_depreciation_or_income_recognition
     *
     * @return float
     */
    public function getBasisForDepreciationOrIncomeRecognition()
    {
        return $this->container['basis_for_depreciation_or_income_recognition'];
    }

    /**
     * Sets basis_for_depreciation_or_income_recognition
     *
     * @param float $basis_for_depreciation_or_income_recognition basis_for_depreciation_or_income_recognition
     *
     * @return $this
     */
    public function setBasisForDepreciationOrIncomeRecognition($basis_for_depreciation_or_income_recognition)
    {
        $this->container['basis_for_depreciation_or_income_recognition'] = $basis_for_depreciation_or_income_recognition;

        return $this;
    }

    /**
     * Gets basis_for_depreciation_or_income_recognition_tax_value
     *
     * @return float
     */
    public function getBasisForDepreciationOrIncomeRecognitionTaxValue()
    {
        return $this->container['basis_for_depreciation_or_income_recognition_tax_value'];
    }

    /**
     * Sets basis_for_depreciation_or_income_recognition_tax_value
     *
     * @param float $basis_for_depreciation_or_income_recognition_tax_value basis_for_depreciation_or_income_recognition_tax_value
     *
     * @return $this
     */
    public function setBasisForDepreciationOrIncomeRecognitionTaxValue($basis_for_depreciation_or_income_recognition_tax_value)
    {
        $this->container['basis_for_depreciation_or_income_recognition_tax_value'] = $basis_for_depreciation_or_income_recognition_tax_value;

        return $this;
    }

    /**
     * Gets profit_transfered_to_profit_and_loss_account
     *
     * @return float
     */
    public function getProfitTransferedToProfitAndLossAccount()
    {
        return $this->container['profit_transfered_to_profit_and_loss_account'];
    }

    /**
     * Sets profit_transfered_to_profit_and_loss_account
     *
     * @param float $profit_transfered_to_profit_and_loss_account profit_transfered_to_profit_and_loss_account
     *
     * @return $this
     */
    public function setProfitTransferedToProfitAndLossAccount($profit_transfered_to_profit_and_loss_account)
    {
        $this->container['profit_transfered_to_profit_and_loss_account'] = $profit_transfered_to_profit_and_loss_account;

        return $this;
    }

    /**
     * Gets loss_transfered_to_profit_and_loss_account
     *
     * @return float
     */
    public function getLossTransferedToProfitAndLossAccount()
    {
        return $this->container['loss_transfered_to_profit_and_loss_account'];
    }

    /**
     * Sets loss_transfered_to_profit_and_loss_account
     *
     * @param float $loss_transfered_to_profit_and_loss_account loss_transfered_to_profit_and_loss_account
     *
     * @return $this
     */
    public function setLossTransferedToProfitAndLossAccount($loss_transfered_to_profit_and_loss_account)
    {
        $this->container['loss_transfered_to_profit_and_loss_account'] = $loss_transfered_to_profit_and_loss_account;

        return $this;
    }

    /**
     * Gets accounting_value_profit_and_loss
     *
     * @return string
     */
    public function getAccountingValueProfitAndLoss()
    {
        return $this->container['accounting_value_profit_and_loss'];
    }

    /**
     * Sets accounting_value_profit_and_loss
     *
     * @param string $accounting_value_profit_and_loss accounting_value_profit_and_loss
     *
     * @return $this
     */
    public function setAccountingValueProfitAndLoss($accounting_value_profit_and_loss)
    {
        $this->container['accounting_value_profit_and_loss'] = $accounting_value_profit_and_loss;

        return $this;
    }

    /**
     * Gets warning_too_high_percentage
     *
     * @return string
     */
    public function getWarningTooHighPercentage()
    {
        return $this->container['warning_too_high_percentage'];
    }

    /**
     * Sets warning_too_high_percentage
     *
     * @param string $warning_too_high_percentage warning_too_high_percentage
     *
     * @return $this
     */
    public function setWarningTooHighPercentage($warning_too_high_percentage)
    {
        $this->container['warning_too_high_percentage'] = $warning_too_high_percentage;

        return $this;
    }

    /**
     * Gets warning_too_low_percentage
     *
     * @return string
     */
    public function getWarningTooLowPercentage()
    {
        return $this->container['warning_too_low_percentage'];
    }

    /**
     * Sets warning_too_low_percentage
     *
     * @param string $warning_too_low_percentage warning_too_low_percentage
     *
     * @return $this
     */
    public function setWarningTooLowPercentage($warning_too_low_percentage)
    {
        $this->container['warning_too_low_percentage'] = $warning_too_low_percentage;

        return $this;
    }

    /**
     * Gets info_residual_write_off
     *
     * @return string
     */
    public function getInfoResidualWriteOff()
    {
        return $this->container['info_residual_write_off'];
    }

    /**
     * Sets info_residual_write_off
     *
     * @param string $info_residual_write_off info_residual_write_off
     *
     * @return $this
     */
    public function setInfoResidualWriteOff($info_residual_write_off)
    {
        $this->container['info_residual_write_off'] = $info_residual_write_off;

        return $this;
    }

    /**
     * Gets info_message_depreciation
     *
     * @return string
     */
    public function getInfoMessageDepreciation()
    {
        return $this->container['info_message_depreciation'];
    }

    /**
     * Sets info_message_depreciation
     *
     * @param string $info_message_depreciation info_message_depreciation
     *
     * @return $this
     */
    public function setInfoMessageDepreciation($info_message_depreciation)
    {
        $this->container['info_message_depreciation'] = $info_message_depreciation;

        return $this;
    }

    /**
     * Gets info_message_income_recognition
     *
     * @return string
     */
    public function getInfoMessageIncomeRecognition()
    {
        return $this->container['info_message_income_recognition'];
    }

    /**
     * Sets info_message_income_recognition
     *
     * @param string $info_message_income_recognition info_message_income_recognition
     *
     * @return $this
     */
    public function setInfoMessageIncomeRecognition($info_message_income_recognition)
    {
        $this->container['info_message_income_recognition'] = $info_message_income_recognition;

        return $this;
    }

    /**
     * Gets negate
     *
     * @return bool
     */
    public function getNegate()
    {
        return $this->container['negate'];
    }

    /**
     * Sets negate
     *
     * @param bool $negate negate
     *
     * @return $this
     */
    public function setNegate($negate)
    {
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
