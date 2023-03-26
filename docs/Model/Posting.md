# Posting

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional] 
**date** | **string** |  | [optional] 
**description** | **string** |  | [optional] 
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional] 
**amortization_account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional] 
**amortization_start_date** | **string** | Amortization start date. AmortizationAccountId, amortizationStartDate and amortizationEndDate should be provided. | [optional] 
**amortization_end_date** | **string** |  | [optional] 
**customer** | [**\Learnist\Tripletex\Model\Customer**](Customer.md) |  | [optional] 
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  | [optional] 
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional] 
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional] 
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional] 
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional] 
**amount** | **float** |  | [optional] 
**amount_currency** | **float** |  | [optional] 
**amount_gross** | **float** |  | [optional] 
**amount_gross_currency** | **float** |  | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**close_group** | [**\Learnist\Tripletex\Model\CloseGroup**](CloseGroup.md) |  | [optional] 
**invoice_number** | **string** |  | [optional] 
**term_of_payment** | **string** |  | [optional] 
**row** | **int** |  | [optional] 
**type** | **string** |  | [optional] 
**external_ref** | **string** | External reference for identifying payment basis of the posting, e.g., KID, customer identification or credit note number. | [optional] 
**system_generated** | **bool** |  | [optional] 
**tax_transaction_type** | **string** |  | [optional] 
**tax_transaction_type_id** | **int** |  | [optional] 
**matched** | **bool** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

