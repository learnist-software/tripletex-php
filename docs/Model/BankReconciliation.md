# # BankReconciliation

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  |
**accounting_period** | [**\Learnist\Tripletex\Model\AccountingPeriod**](AccountingPeriod.md) |  |
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**transactions** | [**\Learnist\Tripletex\Model\BankTransaction[]**](BankTransaction.md) | Bank transactions tied to the bank reconciliation | [optional] [readonly]
**is_closed** | **bool** |  | [optional]
**type** | **string** | Type of Bank Reconciliation. |
**bank_account_closing_balance_currency** | **float** |  | [optional]
**closed_date** | **string** |  | [optional] [readonly]
**closed_by_contact** | [**\Learnist\Tripletex\Model\Contact**](Contact.md) |  | [optional]
**closed_by_employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**approvable** | **bool** |  | [optional] [readonly]
**auto_pay_reconciliation** | **bool** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
