# # VatType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  | [optional]
**number** | **string** |  | [optional]
**display_name** | **string** |  | [optional]
**percentage** | **float** |  | [optional]
**deduction_percentage** | **float** | Percentage of the VAT amount that is deducted. Always 100% for all predefined VAT types, but can be lower for custom types for relative VAT. | [optional]
**parent_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
