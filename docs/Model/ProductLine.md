# ProductLine

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**stocktaking** | [**\Learnist\Tripletex\Model\Stocktaking**](Stocktaking.md) |  | 
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | 
**count** | **float** |  | [optional] 
**unit_cost_currency** | **float** | Unit price purchase (cost) excluding VAT in the order&#x27;s currency | [optional] 
**cost_currency** | **float** |  | [optional] 
**comment** | **string** |  | [optional] 
**counted** | **bool** | If a line is counted or not - only for internal use; will return true/false based on whether the stocktaking is completed otherwise. | [optional] 
**counter** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**date_counted** | [**\DateTime**](\DateTime.md) | When the line was counted - only for internal use | [optional] 
**expected_stock** | **float** | For internal use only | [optional] 
**location** | [**\Learnist\Tripletex\Model\InventoryLocation**](InventoryLocation.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

