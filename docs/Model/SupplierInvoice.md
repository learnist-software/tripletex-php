# # SupplierInvoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**invoice_number** | **string** | Invoice number | [optional]
**invoice_date** | **string** |  |
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  | [optional]
**invoice_due_date** | **string** |  |
**kid_or_receiver_reference** | **string** | KID or message | [optional]
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**amount** | **float** | In the company’s currency, typically NOK. Is 0 if value is missing. | [optional] [readonly]
**amount_currency** | **float** | In the specified currency. | [optional]
**amount_excluding_vat** | **float** | Amount excluding VAT (NOK). Is 0 if value is missing. | [optional] [readonly]
**amount_excluding_vat_currency** | **float** | Amount excluding VAT in the specified currency. Is 0 if value is missing. | [optional] [readonly]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**is_credit_note** | **bool** |  | [optional] [readonly]
**order_lines** | [**\Learnist\Tripletex\Model\OrderLine[]**](OrderLine.md) |  | [optional] [readonly]
**payments** | [**\Learnist\Tripletex\Model\Posting[]**](Posting.md) |  | [optional] [readonly]
**original_invoice_document_id** | **int** |  | [optional] [readonly]
**approval_list_elements** | [**\Learnist\Tripletex\Model\VoucherApprovalListElement[]**](VoucherApprovalListElement.md) |  | [optional] [readonly]
**outstanding_amount** | **float** | The amount outstanding on the invoice, in the invoice currency. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
