# BankReconciliation

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | 
**accounting_period** | [**\Learnist\Tripletex\Model\AccountingPeriod**](AccountingPeriod.md) |  | 
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional] 
**transactions** | [**\Learnist\Tripletex\Model\BankTransaction[]**](BankTransaction.md) | Bank transactions tied to the bank reconciliation | [optional] 
**is_closed** | **bool** |  | [optional] 
**type** | **string** | Type of Bank Reconciliation. | 
**bank_account_closing_balance_currency** | **float** |  | [optional] 
**closed_date** | **string** |  | [optional] 
**closed_by_contact** | [**\Learnist\Tripletex\Model\Contact**](Contact.md) |  | [optional] 
**closed_by_employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**approvable** | **bool** |  | [optional] 
**auto_pay_reconciliation** | **bool** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

