# SalaryV2Payment

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**transaction** | [**\Learnist\Tripletex\Model\SalaryV2Transaction**](SalaryV2Transaction.md) |  | [optional] 
**employee** | [**\Learnist\Tripletex\Model\SalaryV2Employee**](SalaryV2Employee.md) |  | 
**employment** | [**\Learnist\Tripletex\Model\Employment**](Employment.md) |  | 
**date** | **string** | Voucher date. | [optional] 
**year** | **int** |  | [optional] 
**month** | **int** |  | [optional] 
**vacation_allowance_amount** | **float** |  | [optional] 
**gross_amount** | **float** |  | [optional] 
**amount** | **float** |  | [optional] 
**number** | **int** |  | [optional] 
**sum_amount_tax_deductions** | **float** |  | [optional] 
**payroll_tax_amount** | **float** |  | [optional] 
**payroll_tax_basis** | **float** |  | [optional] 
**payroll_tax_municipality** | [**\Learnist\Tripletex\Model\Municipality**](Municipality.md) |  | [optional] 
**division** | [**\Learnist\Tripletex\Model\Company**](Company.md) |  | [optional] 
**holiday_allowance_rate** | **float** |  | [optional] 
**bank_account_or_iban** | **string** |  | [optional] 
**payroll_tax_percentage** | **float** |  | [optional] 
**delivery_method_pay_slip** | **string** |  | [optional] 
**is_tax_card_missing** | **bool** |  | [optional] 
**comment** | **string** |  | [optional] 
**specifications** | [**\Learnist\Tripletex\Model\SalaryV2Specification[]**](SalaryV2Specification.md) | Link to salary specifications. | [optional] 
**travel_expenses** | [**\Learnist\Tripletex\Model\SalaryV2TravelExpense[]**](SalaryV2TravelExpense.md) | Link to salary specifications. | [optional] 
**employee_hourly_wage** | **float** |  | [optional] 
**tax_description** | **string** |  | [optional] 
**gross_amount_description** | **string** |  | [optional] 
**seamen_days_on_board** | **int** |  | [optional] 
**last_month_paid_amount** | **float** |  | [optional] 
**employee_salary_date** | **string** |  | [optional] 
**suggest_add_readjustment** | **bool** |  | [optional] 
**is_employment_info_ameldinger** | **bool** |  | [optional] 
**seamen_deduction** | **bool** |  | [optional] 
**validation_results** | [**\Learnist\Tripletex\Model\SalaryV2PaymentValidationResult**](SalaryV2PaymentValidationResult.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

