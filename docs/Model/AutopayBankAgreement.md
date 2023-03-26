# # AutopayBankAgreement

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**iban** | **string** | The IBAN property. | [optional]
**bban** | **string** | The BBAN property. | [optional]
**description** | **string** | The description property. | [optional] [readonly]
**display_name** | **string** | display name needed for LoadableDropdown component | [optional] [readonly]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**uploader_employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**date_created** | **string** |  | [optional]
**bank** | [**\Learnist\Tripletex\Model\Bank**](Bank.md) |  | [optional]
**country** | [**\Learnist\Tripletex\Model\Country**](Country.md) |  | [optional]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**is_active** | **bool** |  | [optional] [readonly]
**balance** | [**\Learnist\Tripletex\Model\BankStatementBalance**](BankStatementBalance.md) |  | [optional]
**account_in_bank_id** | **string** |  | [optional]
**division** | **string** |  | [optional]
**ccm_agreement_id** | **string** |  | [optional]
**organisation_number** | **string** |  | [optional]
**approve_in_online_banking** | **bool** |  | [optional]
**active** | **bool** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
