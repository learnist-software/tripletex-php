# # Activity

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  | [optional]
**number** | **string** |  | [optional]
**description** | **string** |  | [optional]
**activity_type** | **string** | PROJECT_SPECIFIC_ACTIVITY are made via project/projectactivity, as they must be part of a project. | [optional]
**is_project_activity** | **bool** | Manipulate these with ActivityType | [optional] [readonly]
**is_general** | **bool** | Manipulate these with ActivityType | [optional] [readonly]
**is_task** | **bool** | Manipulate these with ActivityType | [optional] [readonly]
**is_disabled** | **bool** |  | [optional] [readonly]
**is_chargeable** | **bool** |  | [optional]
**rate** | **float** |  | [optional]
**cost_percentage** | **float** |  | [optional]
**display_name** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
