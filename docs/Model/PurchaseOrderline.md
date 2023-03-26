# # PurchaseOrderline

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**purchase_order** | [**\Learnist\Tripletex\Model\PurchaseOrder**](PurchaseOrder.md) |  |
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**supplier_product** | [**\Learnist\Tripletex\Model\SupplierProduct**](SupplierProduct.md) |  | [optional]
**resale_product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**description** | **string** |  | [optional]
**count** | **float** |  | [optional]
**quantity_received** | **float** | Used if the Purchase Order has a Goods received. | [optional]
**unit_cost_currency** | **float** | Unit price purchase (cost) excluding VAT in the order&#39;s currency | [optional]
**unit_price_excluding_vat_currency** | **float** | Unit price of purchase excluding VAT in the order&#39;s currency.If it&#39;s not specified,it takes the value from purchase price in productDTO | [optional]
**unit_list_price_currency** | **float** | Unit list price of purchase excluding VAT in the order&#39;s currency.If it&#39;s not specified,it takes the value from purchase price in productDTO | [optional]
**unit_price_inc_vat_currency** | **float** | Unit  price including VAT in the order&#39;s currency.If it&#39;s not specified,it takes the value from purchase price in productDTO | [optional]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**discount** | **float** | Discount given as a percentage (%) | [optional]
**amount_excluding_vat_currency** | **float** | Total amount on order line excluding VAT in the order&#39;s currency | [optional]
**amount_including_vat_currency** | **float** | Total amount on order line including VAT in the order&#39;s currency | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
