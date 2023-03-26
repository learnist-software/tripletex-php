# # Cost

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**travel_expense** | [**\Learnist\Tripletex\Model\TravelExpense**](TravelExpense.md) |  | [optional]
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**cost_category** | [**\Learnist\Tripletex\Model\TravelCostCategory**](TravelCostCategory.md) |  | [optional]
**payment_type** | [**\Learnist\Tripletex\Model\TravelPaymentType**](TravelPaymentType.md) |  |
**category** | **string** |  | [optional]
**comments** | **string** |  | [optional]
**rate** | **float** |  | [optional]
**amount_currency_inc_vat** | **float** |  |
**amount_nok_incl_vat** | **float** |  | [optional]
**amount_nok_incl_vat_low** | **float** |  | [optional] [readonly]
**amount_nok_incl_vat_medium** | **float** |  | [optional] [readonly]
**amount_nok_incl_vat_high** | **float** |  | [optional] [readonly]
**is_paid_by_employee** | **bool** |  | [optional] [readonly]
**is_chargeable** | **bool** |  | [optional]
**date** | **string** |  | [optional]
**predictions** | [**array<string,\Learnist\Tripletex\Model\Prediction>**](Prediction.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)