# # BankStatement

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**opening_balance_currency** | **float** | Opening balance on the account. | [optional] [readonly]
**closing_balance_currency** | **float** | Closing balance on the account. | [optional] [readonly]
**file_name** | **string** | Bank statement file name. | [optional] [readonly]
**bank** | [**\Learnist\Tripletex\Model\Bank**](Bank.md) |  | [optional]
**from_date** | **string** |  | [optional] [readonly]
**to_date** | **string** |  | [optional] [readonly]
**transactions** | [**\Learnist\Tripletex\Model\BankTransaction[]**](BankTransaction.md) | Bank transactions tied to the bank statement | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
