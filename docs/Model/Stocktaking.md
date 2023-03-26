# # Stocktaking

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**number** | **int** |  | [optional] [readonly]
**date** | **string** |  |
**comment** | **string** |  | [optional]
**type_of_stocktaking** | **string** | [Deprecated] Define the type of stoctaking.&lt;br&gt;ALL_PRODUCTS_WITH_INVENTORIES: Create a stocktaking for all products with inventories.&lt;br&gt;INCLUDE_PRODUCTS: Create a stocktaking which includes all products.&lt;br&gt;NO_PRODUCTS: Create a stocktaking without products.&lt;br&gt;If not specified, the value &#39;ALL_PRODUCTS_WITH_INVENTORIES&#39; is used. | [optional]
**inventory** | [**\Learnist\Tripletex\Model\Inventory**](Inventory.md) |  |
**is_completed** | **bool** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
