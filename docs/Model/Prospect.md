# # Prospect

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  | [optional]
**description** | **string** |  | [optional]
**created_date** | **string** |  |
**customer** | [**\Learnist\Tripletex\Model\Customer**](Customer.md) |  | [optional]
**sales_employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**is_closed** | **bool** |  | [optional]
**closed_reason** | **int** |  | [optional]
**closed_date** | **string** |  | [optional]
**competitor** | **string** |  | [optional]
**prospect_type** | **int** |  | [optional]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**project_offer** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**final_income_date** | **string** | The estimated start date for income on the prospect. | [optional]
**final_initial_value** | **float** | The estimated startup fee on this prospect. | [optional]
**final_monthly_value** | **float** | The estimated monthly fee on this prospect. | [optional]
**final_additional_services_value** | **float** | Tripletex specific. | [optional]
**total_value** | **float** | The estimated total fee on this prospect. | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
