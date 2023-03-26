# # Asset

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  |
**description** | **string** |  |
**date_of_acquisition** | **string** |  |
**acquisition_cost** | **float** | Acquisition cost. | [optional]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**depreciation_account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**incoming_balance** | **float** | Incoming balance for the asset. | [optional]
**accumulated_depreciation** | **float** | Accumulated depreciation for the asset. | [optional]
**lifetime** | **int** | Lifetime in months for the asset. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
