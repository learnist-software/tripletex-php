# # Payslip

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**transaction** | [**\Learnist\Tripletex\Model\SalaryTransaction**](SalaryTransaction.md) |  | [optional]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  |
**date** | **string** | Voucher date. | [optional]
**year** | **int** |  | [optional]
**month** | **int** |  | [optional]
**specifications** | [**\Learnist\Tripletex\Model\SalarySpecification[]**](SalarySpecification.md) | Link to salary specifications. | [optional]
**vacation_allowance_amount** | **float** |  | [optional] [readonly]
**gross_amount** | **float** |  | [optional] [readonly]
**amount** | **float** |  | [optional] [readonly]
**number** | **int** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
