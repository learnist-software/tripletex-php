# # VoucherMessage

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**voucher_id** | **int** | The voucher to connect the message to, only set on create | [optional]
**content** | **string** | The message | [optional]
**sender** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**send_time** | **string** | The timestamp of the message | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
