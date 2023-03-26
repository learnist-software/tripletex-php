# Learnist\Tripletex\TravelExpenserateCategoryApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**get**](TravelExpenserateCategoryApi.md#get) | **GET** /travelExpense/rateCategory/{id} | Get travel expense rate category by ID.
[**search**](TravelExpenserateCategoryApi.md#search) | **GET** /travelExpense/rateCategory | Find rate categories corresponding with sent data.

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperTravelExpenseRateCategory get($id, $fields)

Get travel expense rate category by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TravelExpenserateCategoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($id, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TravelExpenserateCategoryApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperTravelExpenseRateCategory**](../Model/ResponseWrapperTravelExpenseRateCategory.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseTravelExpenseRateCategory search($type, $name, $travel_report_rate_category_group_id, $amelding_wage_code, $wage_code_number, $is_valid_day_trip, $is_valid_accommodation, $is_valid_domestic, $requires_zone, $is_requires_overnight_accommodation, $date_from, $date_to, $from, $count, $sorting, $fields)

Find rate categories corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TravelExpenserateCategoryApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$type = "type_example"; // string | Equals
$name = "name_example"; // string | Containing
$travel_report_rate_category_group_id = 56; // int | Equals
$amelding_wage_code = "amelding_wage_code_example"; // string | Containing
$wage_code_number = "wage_code_number_example"; // string | Equals
$is_valid_day_trip = true; // bool | Equals
$is_valid_accommodation = true; // bool | Equals
$is_valid_domestic = true; // bool | Equals
$requires_zone = true; // bool | Equals
$is_requires_overnight_accommodation = true; // bool | Equals
$date_from = "date_from_example"; // string | From and including
$date_to = "date_to_example"; // string | To and excluding
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($type, $name, $travel_report_rate_category_group_id, $amelding_wage_code, $wage_code_number, $is_valid_day_trip, $is_valid_accommodation, $is_valid_domestic, $requires_zone, $is_requires_overnight_accommodation, $date_from, $date_to, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TravelExpenserateCategoryApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **type** | **string**| Equals | [optional]
 **name** | **string**| Containing | [optional]
 **travel_report_rate_category_group_id** | **int**| Equals | [optional]
 **amelding_wage_code** | **string**| Containing | [optional]
 **wage_code_number** | **string**| Equals | [optional]
 **is_valid_day_trip** | **bool**| Equals | [optional]
 **is_valid_accommodation** | **bool**| Equals | [optional]
 **is_valid_domestic** | **bool**| Equals | [optional]
 **requires_zone** | **bool**| Equals | [optional]
 **is_requires_overnight_accommodation** | **bool**| Equals | [optional]
 **date_from** | **string**| From and including | [optional]
 **date_to** | **string**| To and excluding | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseTravelExpenseRateCategory**](../Model/ListResponseTravelExpenseRateCategory.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

