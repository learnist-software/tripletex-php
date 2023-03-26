# # MonthlyStatus

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**timesheet_entries** | [**\Learnist\Tripletex\Model\TimesheetEntry[]**](TimesheetEntry.md) |  | [optional] [readonly]
**approved_date** | **string** |  | [optional] [readonly]
**completed** | **bool** |  | [optional] [readonly]
**approved_by** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**approved** | **bool** |  | [optional] [readonly]
**approved_until_date** | **string** |  | [optional] [readonly]
**month_year** | **string** |  | [optional] [readonly]
**hours_payout** | **float** |  | [optional]
**vacation_payout** | **float** |  | [optional]
**hour_summary** | [**\Learnist\Tripletex\Model\HourSummary**](HourSummary.md) |  | [optional]
**flex_summary** | [**\Learnist\Tripletex\Model\FlexSummary**](FlexSummary.md) |  | [optional]
**vacation_summary** | [**\Learnist\Tripletex\Model\VacationSummary**](VacationSummary.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
