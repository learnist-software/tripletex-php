# # VatReturns2022

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**start** | **string** |  | [optional]
**closed_date** | **string** |  | [optional]
**end** | **string** |  | [optional]
**status** | **string** | The current instance status of the vatReturns. | [optional]
**user_comment** | **string** |  | [optional]
**structured_comment** | **string** |  | [optional]
**vat_groups** | [**\Learnist\Tripletex\Model\VatSpecificationGroup[]**](VatSpecificationGroup.md) |  | [optional] [readonly]
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**altinn_metadata** | [**\Learnist\Tripletex\Model\AltinnInstance**](AltinnInstance.md) |  | [optional]
**receipt_id** | **int** | Attachment for vat return | [optional] [readonly]
**total_amount_vat_to_pay** | **object** |  | [optional]
**remaining_amount_vat_to_pay** | **object** |  | [optional]
**is_paid** | **bool** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
