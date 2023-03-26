# SalaryTransaction

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**date** | **string** | Voucher date. | [optional] 
**year** | **int** |  | 
**month** | **int** |  | 
**is_historical** | **bool** | With historical wage vouchers you can update the wage system with information dated before the opening balance. | [optional] 
**pay_slips_available_date** | **string** | The date payslips are made available to the employee. Defaults to voucherDate. | [optional] 
**payslips** | [**\Learnist\Tripletex\Model\Payslip[]**](Payslip.md) | Link to individual payslip objects. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

