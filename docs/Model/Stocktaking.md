# Stocktaking

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**number** | **int** |  | [optional] 
**date** | **string** |  | 
**comment** | **string** |  | [optional] 
**type_of_stocktaking** | **string** | [Deprecated] Define the type of stoctaking.&lt;br&gt;ALL_PRODUCTS_WITH_INVENTORIES: Create a stocktaking for all products with inventories.&lt;br&gt;INCLUDE_PRODUCTS: Create a stocktaking which includes all products.&lt;br&gt;NO_PRODUCTS: Create a stocktaking without products.&lt;br&gt;If not specified, the value &#x27;ALL_PRODUCTS_WITH_INVENTORIES&#x27; is used. | [optional] 
**inventory** | [**\Learnist\Tripletex\Model\Inventory**](Inventory.md) |  | 
**is_completed** | **bool** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

