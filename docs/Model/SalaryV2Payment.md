# # SalaryV2Payment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**transaction** | [**\Learnist\Tripletex\Model\SalaryV2Transaction**](SalaryV2Transaction.md) |  | [optional]
**employee** | [**\Learnist\Tripletex\Model\SalaryV2Employee**](SalaryV2Employee.md) |  |
**employment** | [**\Learnist\Tripletex\Model\Employment**](Employment.md) |  |
**date** | **string** | Voucher date. | [optional]
**year** | **int** |  | [optional]
**month** | **int** |  | [optional]
**vacation_allowance_amount** | **float** |  | [optional] [readonly]
**gross_amount** | **float** |  | [optional] [readonly]
**amount** | **float** |  | [optional] [readonly]
**number** | **int** |  | [optional] [readonly]
**sum_amount_tax_deductions** | **float** |  | [optional] [readonly]
**payroll_tax_amount** | **float** |  | [optional] [readonly]
**payroll_tax_basis** | **float** |  | [optional] [readonly]
**payroll_tax_municipality** | [**\Learnist\Tripletex\Model\Municipality**](Municipality.md) |  | [optional]
**division** | [**\Learnist\Tripletex\Model\Company**](Company.md) |  | [optional]
**holiday_allowance_rate** | **float** |  | [optional] [readonly]
**bank_account_or_iban** | **string** |  | [optional] [readonly]
**payroll_tax_percentage** | **float** |  | [optional] [readonly]
**delivery_method_pay_slip** | **string** |  | [optional] [readonly]
**is_tax_card_missing** | **bool** |  | [optional] [readonly]
**comment** | **string** |  | [optional]
**specifications** | [**\Learnist\Tripletex\Model\SalaryV2Specification[]**](SalaryV2Specification.md) | Link to salary specifications. | [optional]
**travel_expenses** | [**\Learnist\Tripletex\Model\SalaryV2TravelExpense[]**](SalaryV2TravelExpense.md) | Link to salary specifications. | [optional]
**employee_hourly_wage** | **float** |  | [optional] [readonly]
**tax_description** | **string** |  | [optional] [readonly]
**gross_amount_description** | **string** |  | [optional] [readonly]
**seamen_days_on_board** | **int** |  | [optional]
**last_month_paid_amount** | **float** |  | [optional] [readonly]
**employee_salary_date** | **string** |  | [optional] [readonly]
**suggest_add_readjustment** | **bool** |  | [optional] [readonly]
**is_employment_info_ameldinger** | **bool** |  | [optional] [readonly]
**seamen_deduction** | **bool** |  | [optional]
**validation_results** | [**\Learnist\Tripletex\Model\SalaryV2PaymentValidationResult**](SalaryV2PaymentValidationResult.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
