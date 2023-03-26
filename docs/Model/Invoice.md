# # Invoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**invoice_number** | **int** | If value is set to 0, the invoice number will be generated. | [optional]
**invoice_date** | **string** |  |
**customer** | [**\Learnist\Tripletex\Model\Customer**](Customer.md) |  | [optional]
**credited_invoice** | **int** | The id of the original invoice if this is a credit note. | [optional] [readonly]
**is_credited** | **bool** |  | [optional] [readonly]
**invoice_due_date** | **string** |  |
**kid** | **string** | KID - Kundeidentifikasjonsnummer. | [optional]
**invoice_comment** | **string** | Comment text for the invoice. This was specified on the order as invoiceComment. | [optional] [readonly]
**comment** | **string** | Comment text for the specific invoice. | [optional]
**orders** | [**\Learnist\Tripletex\Model\Order[]**](Order.md) | Related orders. Only one order per invoice is supported at the moment. |
**order_lines** | [**\Learnist\Tripletex\Model\OrderLine[]**](OrderLine.md) | Orderlines connected to the invoice. | [optional] [readonly]
**travel_reports** | [**\Learnist\Tripletex\Model\TravelExpense[]**](TravelExpense.md) | Travel reports connected to the invoice. | [optional] [readonly]
**project_invoice_details** | [**\Learnist\Tripletex\Model\ProjectInvoiceDetails[]**](ProjectInvoiceDetails.md) | ProjectInvoiceDetails contains additional information about the invoice, in particular invoices for projects. It contains information about the charged project, the fee amount, extra percent and amount, extra costs, travel expenses, invoice and project comments, akonto amount and values determining if extra costs, akonto and hours should be included. ProjectInvoiceDetails is an object which represents the relation between an invoice and a Project, Orderline and OrderOut object. | [optional] [readonly]
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**delivery_date** | **string** | The delivery date. | [optional] [readonly]
**amount** | **float** | In the company’s currency, typically NOK. | [optional] [readonly]
**amount_currency** | **float** | In the specified currency. | [optional] [readonly]
**amount_excluding_vat** | **float** | Amount excluding VAT (NOK). | [optional] [readonly]
**amount_excluding_vat_currency** | **float** | Amount excluding VAT in the specified currency. | [optional] [readonly]
**amount_roundoff** | **float** | Amount of round off to nearest integer. | [optional] [readonly]
**amount_roundoff_currency** | **float** | Amount of round off to nearest integer in the specified currency. | [optional] [readonly]
**amount_outstanding** | **float** | The amount outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency. | [optional] [readonly]
**amount_currency_outstanding** | **float** | The amountCurrency outstanding based on the history collection, excluding reminders and any existing remits, in the invoice currency. | [optional] [readonly]
**amount_outstanding_total** | **float** | The amount outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency. | [optional] [readonly]
**amount_currency_outstanding_total** | **float** | The amountCurrency outstanding based on the history collection and including the last reminder and any existing remits. This is the total invoice balance including reminders and remittances, in the invoice currency. | [optional] [readonly]
**sum_remits** | **float** | The sum of all open remittances of the invoice. Remittances are reimbursement payments back to the customer and are therefore relevant to the bookkeeping of the invoice in the accounts. | [optional] [readonly]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**is_credit_note** | **bool** |  | [optional] [readonly]
**is_charged** | **bool** |  | [optional] [readonly]
**is_approved** | **bool** |  | [optional] [readonly]
**postings** | [**\Learnist\Tripletex\Model\Posting[]**](Posting.md) | The invoice postings, which includes a posting for the invoice with a positive amount, and one or more posting for the payments with negative amounts. | [optional] [readonly]
**reminders** | [**\Learnist\Tripletex\Model\Reminder[]**](Reminder.md) | Invoice debt collection and reminders. | [optional] [readonly]
**invoice_remarks** | **string** | Deprecated Invoice remarks - please use the &#39;invoiceRemark&#39; instead. | [optional]
**invoice_remark** | [**\Learnist\Tripletex\Model\InvoiceRemark**](InvoiceRemark.md) |  | [optional]
**payment_type_id** | **int** | [BETA] Optional. Used to specify payment type for prepaid invoices. Payment type can be specified here, or as a parameter to the /invoice API endpoint. | [optional]
**paid_amount** | **float** | [BETA] Optional. Used to specify the prepaid amount of the invoice. The paid amount can be specified here, or as a parameter to the /invoice API endpoint. | [optional]
**is_periodization_possible** | **bool** |  | [optional] [readonly]
**ehf_send_status** | **string** | [Deprecated] EHF (Peppol) send status. This only shows status for historic EHFs. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
