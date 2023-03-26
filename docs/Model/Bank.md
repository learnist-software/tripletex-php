# # Bank

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** | Bank name | [optional] [readonly]
**bank_statement_file_format_support** | **string[]** | Bank statement file formats supported. | [optional] [readonly]
**register_numbers** | **int[]** | Register numbers belonging to bank. | [optional] [readonly]
**display_name** | **string** | Bank name to comply with LoadableDropdown | [optional] [readonly]
**auto_pay_support** | [**\Learnist\Tripletex\Model\AutoPaySupport**](AutoPaySupport.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
