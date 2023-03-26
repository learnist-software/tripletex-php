# # VoucherStatus

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  |
**type** | **string** | The type of process | [optional] [readonly]
**status** | **string** | Process status | [optional]
**timestamp** | **string** | Time of last update | [optional] [readonly]
**message** | **string** | 1 or 0 predefined status message | [optional]
**external_object_url** | **string** | Link to external object | [optional]
**comment** | **string** |  | [optional]
**reference_number** | **string** | reference number to external object | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
