# TimesheetEntry

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional] 
**activity** | [**\Learnist\Tripletex\Model\Activity**](Activity.md) |  | 
**date** | **string** |  | 
**hours** | **float** |  | 
**chargeable_hours** | **float** |  | [optional] 
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | 
**time_clocks** | [**\Learnist\Tripletex\Model\TimeClock[]**](TimeClock.md) | Link to stop watches on this hour. | [optional] 
**comment** | **string** |  | [optional] 
**locked** | **bool** | Indicates if the hour can be changed. | [optional] 
**chargeable** | **bool** |  | [optional] 
**invoice** | [**\Learnist\Tripletex\Model\Invoice**](Invoice.md) |  | [optional] 
**hourly_rate** | **float** |  | [optional] 
**hourly_cost** | **float** |  | [optional] 
**hourly_cost_percentage** | **float** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

