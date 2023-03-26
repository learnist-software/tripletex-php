# # ProjectOrderLine

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**inventory** | [**\Learnist\Tripletex\Model\Inventory**](Inventory.md) |  | [optional]
**inventory_location** | [**\Learnist\Tripletex\Model\InventoryLocation**](InventoryLocation.md) |  | [optional]
**description** | **string** |  | [optional]
**count** | **float** |  | [optional]
**unit_cost_currency** | **float** | Unit price purchase (cost) excluding VAT in the order&#39;s currency | [optional]
**unit_price_excluding_vat_currency** | **float** | Unit price of purchase excluding VAT in the order&#39;s currency | [optional]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**markup** | **float** | Markup given as a percentage (%) | [optional]
**discount** | **float** | Discount given as a percentage (%) | [optional]
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional]
**amount_excluding_vat_currency** | **float** | Total amount on order line excluding VAT in the order&#39;s currency | [optional] [readonly]
**amount_including_vat_currency** | **float** | Total amount on order line including VAT in the order&#39;s currency | [optional] [readonly]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  |
**date** | **string** |  |
**is_chargeable** | **bool** |  | [optional]
**is_budget** | **bool** |  | [optional] [readonly]
**invoice** | [**\Learnist\Tripletex\Model\Invoice**](Invoice.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
