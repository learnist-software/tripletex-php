# # SupplierProduct

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  | [optional]
**display_name** | **string** |  | [optional] [readonly]
**number** | **string** |  | [optional]
**description** | **string** |  | [optional]
**ean** | **string** |  | [optional]
**cost_excluding_vat_currency** | **float** | Price purchase (cost) excluding VAT in the product&#39;s currency | [optional]
**cost** | **float** | Price purchase (cost) in the company&#39;s currency | [optional]
**price_excluding_vat_currency** | **float** | Price of purchase excluding VAT in the product&#39;s currency | [optional]
**price_including_vat_currency** | **float** | Price of purchase including VAT in the product&#39;s currency | [optional]
**is_inactive** | **bool** |  | [optional]
**product_unit** | [**\Learnist\Tripletex\Model\ProductUnit**](ProductUnit.md) |  | [optional]
**is_stock_item** | **bool** |  | [optional]
**stock_of_goods** | **float** |  | [optional] [readonly]
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**discount_price** | **float** |  | [optional] [readonly]
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  |
**resale_product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**is_deletable** | **bool** |  | [optional] [readonly]
**vendor_name** | **string** |  | [optional] [readonly]
**is_efo_nelfo_product** | **bool** |  | [optional] [readonly]
**wholesaler_id** | **int** |  | [optional] [readonly]
**is_main_supplier_product** | **bool** | This feature is available only in pilot | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
