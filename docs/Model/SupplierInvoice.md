# SupplierInvoice

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**invoice_number** | **string** | Invoice number | [optional] 
**invoice_date** | **string** |  | 
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  | [optional] 
**invoice_due_date** | **string** |  | 
**kid_or_receiver_reference** | **string** | KID or message | [optional] 
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional] 
**amount** | **float** | In the company’s currency, typically NOK. Is 0 if value is missing. | [optional] 
**amount_currency** | **float** | In the specified currency. | [optional] 
**amount_excluding_vat** | **float** | Amount excluding VAT (NOK). Is 0 if value is missing. | [optional] 
**amount_excluding_vat_currency** | **float** | Amount excluding VAT in the specified currency. Is 0 if value is missing. | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**is_credit_note** | **bool** |  | [optional] 
**order_lines** | [**\Learnist\Tripletex\Model\OrderLine[]**](OrderLine.md) |  | [optional] 
**payments** | [**\Learnist\Tripletex\Model\Posting[]**](Posting.md) |  | [optional] 
**original_invoice_document_id** | **int** |  | [optional] 
**approval_list_elements** | [**\Learnist\Tripletex\Model\VoucherApprovalListElement[]**](VoucherApprovalListElement.md) |  | [optional] 
**outstanding_amount** | **float** | The amount outstanding on the invoice, in the invoice currency. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

