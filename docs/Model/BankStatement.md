# BankStatement

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**opening_balance_currency** | **float** | Opening balance on the account. | [optional] 
**closing_balance_currency** | **float** | Closing balance on the account. | [optional] 
**file_name** | **string** | Bank statement file name. | [optional] 
**bank** | [**\Learnist\Tripletex\Model\Bank**](Bank.md) |  | [optional] 
**from_date** | **string** |  | [optional] 
**to_date** | **string** |  | [optional] 
**transactions** | [**\Learnist\Tripletex\Model\BankTransaction[]**](BankTransaction.md) | Bank transactions tied to the bank statement | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

