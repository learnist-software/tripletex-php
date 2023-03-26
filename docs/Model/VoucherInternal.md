# # VoucherInternal

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**date** | **string** |  |
**number** | **int** | System generated number that cannot be changed. | [optional] [readonly]
**temp_number** | **int** | Temporary voucher number. | [optional] [readonly]
**year** | **int** | System generated number that cannot be changed. | [optional] [readonly]
**description** | **string** |  |
**voucher_type** | [**\Learnist\Tripletex\Model\VoucherType**](VoucherType.md) |  | [optional]
**reverse_voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**postings** | [**\Learnist\Tripletex\Model\Posting[]**](Posting.md) |  |
**document** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional]
**attachment** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional]
**external_voucher_number** | **string** | External voucher number. | [optional]
**edi_document** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional]
**supplier_voucher_type** | **string** | Supplier voucher type - simple and detailed. | [optional]
**url_details** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
