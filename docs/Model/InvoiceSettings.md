# # InvoiceSettings

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**has_first_invoice_number** | **bool** |  | [optional]
**next_invoice_number** | **int** |  | [optional]
**bank_account_ready** | **bool** |  | [optional]
**default_send_type_b2_b** | **string** |  | [optional]
**default_send_type_b2_c** | **string** |  | [optional]
**show_backorder** | **bool** |  | [optional]
**set_deliver_to_available_stock** | **bool** |  | [optional]
**send_types** | **string[]** |  | [optional]
**is_automatic_soft_reminder_enabled** | **bool** | Has automatic soft reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect. | [optional] [readonly]
**automatic_soft_reminder_days_after_due_date** | **int** | Number of days after due date automatic soft reminders should be sent out if enabled. | [optional] [readonly]
**is_automatic_reminder_enabled** | **bool** | Has automatic reminders enabled for this company. This setting need to be enabled both here and on each customer card to take effect. | [optional] [readonly]
**automatic_reminder_days_after_due_date** | **int** | Number of days after due date automatic reminders should be sent ouf if enabled. | [optional] [readonly]
**is_automatic_notice_of_debt_collection_enabled** | **bool** | Has automatic notices of debt collection enabled for this company. This setting need to be enabled both here and on each customer card to take effect. | [optional] [readonly]
**automatic_notice_of_debt_collection_days_after_due_date** | **int** | Number of days after due date automatic notices of debt collection should be sent out if enabled. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
