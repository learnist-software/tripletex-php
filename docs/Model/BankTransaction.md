# # BankTransaction

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**posted_date** | **string** |  | [optional]
**description** | **string** |  | [optional]
**amount_currency** | **float** |  | [optional]
**bank_statement** | [**\Learnist\Tripletex\Model\BankStatement**](BankStatement.md) |  | [optional]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**grouped_postings** | [**\Learnist\Tripletex\Model\BankTransactionPosting[]**](BankTransactionPosting.md) |  | [optional]
**match_type** | **string** |  | [optional]
**company_id** | **int** |  | [optional]
**matched** | **bool** |  | [optional] [readonly]
**bank_reconciliation_match_sum** | **object** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
