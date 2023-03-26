# # SupplierAutomation

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**vendor_id** | **int** |  |
**name** | **string** |  |
**number** | **string** |  |
**automatically_posted_invoices_last10_count** | **int** | Number automatically of the latest 10 posted invoices | [optional] [readonly]
**automatically_posted_invoices_last10_count_automation** | **int** | Number automatically of the latest 10 posted invoices | [optional]
**automatically_posted_invoices_last10_count_automation_rule** | **int** | Number automatically of the latest 10 posted invoices | [optional]
**not_automatically_posted_invoices_last10_count** | **int** | Number of not automatically of the latest 10 posted invoices | [optional] [readonly]
**vendor_account_number** | **int** |  |
**activated** | **bool** | Is automation activated? | [optional]
**category** | **int** | Automation category. 0-3. | [optional]
**automated_count** | **int** | Number of automated vouchers | [optional]
**voucher_count_last90_days_ehf** | **int** | Number of EHF vouchers last 90 days. | [optional]
**voucher_count_last90_days_non_ehf** | **int** | Number of non-EHF vouchers last 90 days. | [optional]
**voucher_count** | **int** | Number of EHF vouchers send from this supplier regardless of time. | [optional] [readonly]
**completed_invoices** | **int** | Number of invoices with status completed based on the last 10 invoices. | [optional]
**not_completed_invoices** | **int** | Number of invoices with status not completed based on the last 10 invoices. | [optional]
**can_send_ehf** | **bool** | Whether the vendor can send EHF |
**email** | **string** | email of the vendor |
**automation_rules_details** | [**\Learnist\Tripletex\Model\AutomationRuleDetails**](AutomationRuleDetails.md) |  | [optional]
**payment_type_fabric_ai** | **int** | If set, the payment type to be used when automating an invoice from this vendor. | [optional]
**amount_max_fabric_ai_vendor_invoice** | **int** | If set, gives the amount limit for automating invoices for this vendor, it the total invoice amount is above the limit, the invoice is not automated. | [optional]
**date_request_ehf_sent** | **string** | The date the user has sent the request to a supplier to receive EHF. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
