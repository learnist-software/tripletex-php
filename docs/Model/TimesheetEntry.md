# # TimesheetEntry

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**activity** | [**\Learnist\Tripletex\Model\Activity**](Activity.md) |  |
**date** | **string** |  |
**hours** | **float** |  |
**chargeable_hours** | **float** |  | [optional] [readonly]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  |
**time_clocks** | [**\Learnist\Tripletex\Model\TimeClock[]**](TimeClock.md) | Link to stop watches on this hour. | [optional] [readonly]
**comment** | **string** |  | [optional]
**locked** | **bool** | Indicates if the hour can be changed. | [optional] [readonly]
**chargeable** | **bool** |  | [optional] [readonly]
**invoice** | [**\Learnist\Tripletex\Model\Invoice**](Invoice.md) |  | [optional]
**hourly_rate** | **float** |  | [optional] [readonly]
**hourly_cost** | **float** |  | [optional] [readonly]
**hourly_cost_percentage** | **float** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
