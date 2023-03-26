# # PaymentDTO

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**payment_date** | **string** |  | [optional] [readonly]
**booking_date** | **string** |  | [optional] [readonly]
**value_date** | **string** |  | [optional] [readonly]
**amount_currency** | **float** | In the specified currency. | [optional] [readonly]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**creditor_bank_name** | **string** |  | [optional] [readonly]
**creditor_bank_address** | **string** |  | [optional] [readonly]
**creditor_bank_postal_code** | **string** |  | [optional] [readonly]
**creditor_bank_postal_city** | **string** |  | [optional] [readonly]
**status** | **string** | The payment status.NOT_APPROVED: Payment not approved yet.&lt;br&gt;APPROVED: Payment approved, but not yet sent to bank.&lt;br&gt;SENT_TO_AUTOPAY: Payment sent to bank.&lt;br&gt;RECEIVED_BY_BANK: Payment received by the bank.&lt;br&gt;ACCEPTED_BY_BANK: Payment that was accepted by the bank.&lt;br&gt;FAILED: Payment that failed.&lt;br&gt;CANCELLED: Cancelled payment.&lt;br&gt;SUCCESS: Payment that ended successfully.&lt;br&gt; | [optional] [readonly]
**status_id** | **string** | The payment status Id. Usually all the payments in one batch have the same status ID, at least to the point of being received by bank.NEW: Payment is new.&lt;br&gt;PENDING_SIGNING: Payment is sent to AutoPay but not signed yet, requires re-approving.&lt;br&gt;CANCELLED: Payment was cancelled by ERP.&lt;br&gt;ERROR: Payment that failed.&lt;br&gt;RECEIVED_BY_BANK: Payment was received by the bank.&lt;br&gt;ACCEPTED_BY_BANK: Payment was accepted by bank.&lt;br&gt;CANCELLED_IN_BANK: Payment was cancelled in bank.&lt;br&gt;REJECTED_BY_BANK: Payment was rejected by bank.&lt;br&gt;PAID: Payment is paid.&lt;br&gt;OTHER: In case status in unknown. Will never be a final status.&lt;br&gt; | [optional]
**is_final_status** | **bool** |  | [optional] [readonly]
**is_foreign_payment** | **bool** |  | [optional] [readonly]
**is_salary** | **bool** |  | [optional] [readonly]
**description** | **string** |  | [optional] [readonly]
**kid** | **string** | KID - Kundeidentifikasjonsnummer. | [optional] [readonly]
**receiver_reference** | **string** |  | [optional] [readonly]
**source_voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**postings** | [**\Learnist\Tripletex\Model\Posting**](Posting.md) |  | [optional]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**amount_in_account_currency** | **float** | Amount specified in the currency of the bank agreements account. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)