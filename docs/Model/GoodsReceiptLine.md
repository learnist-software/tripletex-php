# # GoodsReceiptLine

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**purchase_order** | [**\Learnist\Tripletex\Model\PurchaseOrder**](PurchaseOrder.md) |  | [optional]
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  |
**resale_product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**inventory** | [**\Learnist\Tripletex\Model\Inventory**](Inventory.md) |  | [optional]
**inventory_location** | [**\Learnist\Tripletex\Model\InventoryLocation**](InventoryLocation.md) |  | [optional]
**quantity_ordered** | **float** |  | [optional] [readonly]
**quantity_received** | **float** |  |
**quantity_rest** | **float** |  | [optional] [readonly]
**deviation** | **float** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
