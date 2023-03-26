# # Reminder

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**reminder_date** | **string** | Creation date of the invoice reminder. | [optional] [readonly]
**charge** | **float** | The fee part of the reminder, in the company&#39;s currency. | [optional] [readonly]
**charge_currency** | **float** | The fee part of the reminder, in the invoice currency. | [optional] [readonly]
**total_charge** | **float** | The total fee part of all reminders, in the company&#39;s currency. | [optional] [readonly]
**total_charge_currency** | **float** | The total fee part of all reminders, in the invoice currency. | [optional] [readonly]
**total_amount_currency** | **float** | The total amount to pay in reminder&#39;s currency. | [optional] [readonly]
**interests** | **float** | The interests part of the reminder. | [optional] [readonly]
**interest_rate** | **float** | The reminder interest rate. | [optional] [readonly]
**term_of_payment** | **string** | The reminder term of payment date. |
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**type** | **string** |  |
**comment** | **string** |  | [optional]
**kid** | **string** | KID - Kundeidentifikasjonsnummer. | [optional]
**bank_account_number** | **string** |  | [optional]
**bank_account_iban** | **string** |  | [optional]
**bank_account_swift** | **string** |  | [optional]
**bank** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
