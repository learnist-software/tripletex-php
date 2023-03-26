# SalaryV2Transaction

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**display_name** | **string** |  | [optional] 
**date** | **string** | Voucher date. | [optional] 
**year** | **int** |  | 
**month** | **int** |  | 
**period_as_string** | **string** |  | [optional] 
**is_historical** | **bool** | With historical wage vouchers you can update the wage system with information dated before the opening balance. | [optional] 
**payroll_tax_calc_method** | **string** | Employee National Insurance calculation method | [optional] 
**voucher_comment** | **string** | Comment on voucher | [optional] 
**payslip_general_comment** | **string** | Comment to be shown on all payslips | [optional] 
**completed** | **bool** |  | [optional] 
**reversed** | **bool** |  | [optional] 
**reverser** | **bool** |  | [optional] 
**pay_slips_available_date** | **string** | The date payslips are made available to the employee. Defaults to voucherDate. | [optional] 
**salary_payments** | [**\Learnist\Tripletex\Model\SalaryV2Payment[]**](SalaryV2Payment.md) | Link to individual payslip objects. | 
**payment_date** | **string** | The date payslips are paid | [optional] 
**not_deletable_message** | **string** |  | [optional] 
**has_bank_transfers** | **bool** |  | [optional] 
**voucher** | [**\Learnist\Tripletex\Model\SalaryV2Voucher**](SalaryV2Voucher.md) |  | [optional] 
**allow_delete_payments** | **bool** | True if bank payments are deletable | [optional] 
**payroll_tax_basis_amount** | **float** |  | [optional] 
**sum_paid_amount** | **float** |  | [optional] 
**sum_total_vacation_allowance_amount** | **float** |  | [optional] 
**sum_tax_deduction_amount** | **float** |  | [optional] 
**sum_payroll_tax_amount** | **float** |  | [optional] 
**any_external_changes_on_this_transaction** | **bool** |  | [optional] 
**attachment** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional] 
**amelding_wage_id** | **int** |  | [optional] 
**hourly_wage_code_ids** | **int[]** | List of wage code ids that are hourly wage code | [optional] 
**contains_negative_wps** | **bool** |  | [optional] 
**payment_type** | [**\Learnist\Tripletex\Model\SalaryV2PaymentType**](SalaryV2PaymentType.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

