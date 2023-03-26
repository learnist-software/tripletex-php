# # ProjectHourlyRate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**start_date** | **string** |  |
**show_in_project_order** | **bool** | Show on contract confirmation/offers | [optional]
**hourly_rate_model** | **string** | Defines the model used for the hourly rate. |
**project_specific_rates** | [**\Learnist\Tripletex\Model\ProjectSpecificRate[]**](ProjectSpecificRate.md) | Project specific rates if hourlyRateModel is TYPE_PROJECT_SPECIFIC_HOURLY_RATES. | [optional]
**fixed_rate** | **float** | Fixed Hourly rates if hourlyRateModel is TYPE_FIXED_HOURLY_RATE. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)