# # EmploymentDetails

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**employment** | [**\Learnist\Tripletex\Model\Employment**](Employment.md) |  | [optional]
**date** | **string** |  | [optional]
**employment_type** | **string** | Define the employment type. | [optional]
**employment_form** | **string** | Define the employment form. | [optional]
**maritime_employment** | [**\Learnist\Tripletex\Model\MaritimeEmployment**](MaritimeEmployment.md) |  | [optional]
**remuneration_type** | **string** | Define the remuneration type. | [optional]
**working_hours_scheme** | **string** | Define the working hours scheme type. If you enter a value for SHIFT WORK, you must also enter value for shiftDurationHours | [optional]
**shift_duration_hours** | **float** |  | [optional]
**occupation_code** | [**\Learnist\Tripletex\Model\OccupationCode**](OccupationCode.md) |  | [optional]
**percentage_of_full_time_equivalent** | **float** |  |
**annual_salary** | **float** |  | [optional]
**hourly_wage** | **float** |  | [optional]
**payroll_tax_municipality_id** | [**\Learnist\Tripletex\Model\Municipality**](Municipality.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
