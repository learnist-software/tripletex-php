# # GoodsReceipt

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**purchase_order** | [**\Learnist\Tripletex\Model\PurchaseOrder**](PurchaseOrder.md) |  | [optional]
**registration_date** | **string** |  |
**received_by** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**status** | **string** |  | [optional] [readonly]
**comment** | **string** |  | [optional]
**goods_receipt_lines** | [**\Learnist\Tripletex\Model\GoodsReceiptLine[]**](GoodsReceiptLine.md) | Purchase Order lines tied to the goods receipt |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
