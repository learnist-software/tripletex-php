# SalesForceOpportunity

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**all_prices** | [**map[string,map[string,float]]**](map.md) | A nested map of all active sales modules. The key in the outer map is the sales module, whilst the inner map contains the different pricing types for the given sales module. A pricing type could be PER_USE(10). | [optional] 
**sum_startup_category1_users** | **float** | The total startup price for users of category 1. | [optional] 
**sum_service_category1_users** | **float** | The total price per monthly price for users of category 1. | [optional] 
**list_price_category1_user_startup** | **float** | The startup list price per user. | [optional] 
**list_price_category1_user_service** | **float** | The monthly list price per user. | [optional] 
**sum_startup** | **float** | The startup price for the company. | [optional] 
**sum_service** | **float** | The monthly price for the company. | [optional] 
**sum_yearly_service** | **float** | The monthly price for the company. | [optional] 
**sum_additional_services** | **float** | The total startup price for additional services. | [optional] 
**accountant_startup_provision** | **float** | The initial provision for the accountant of the startup price (percentage) | [optional] 
**accountant_monthly_provision** | **float** | The monthly provision for the accountant of the monthly price (percentage) | [optional] 
**no_of_users_prepaid** | **int** | The number of users prepaid when creating the company. | [optional] 
**no_of_users_included** | **int** | The number of users included for free in the purchased module. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

