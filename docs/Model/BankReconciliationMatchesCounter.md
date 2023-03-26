# # BankReconciliationMatchesCounter

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**bank_reconciliation_id** | **int** | The reconciliation id for which the number of matches is stored. | [optional]
**auto_matched_matches** | **int** | Number of auto-matched matches since last page access. | [optional]
**suggested_matches** | **int** | Number of suggested matches since last page access. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
