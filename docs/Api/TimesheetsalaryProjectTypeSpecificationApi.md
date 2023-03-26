# Learnist\Tripletex\TimesheetsalaryProjectTypeSpecificationApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**delete**](TimesheetsalaryProjectTypeSpecificationApi.md#delete) | **DELETE** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Delete a timesheet SalaryType Specification (PILOT USERS ONLY)
[**get**](TimesheetsalaryProjectTypeSpecificationApi.md#get) | **GET** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Get timesheet ProjectSalaryType Specification for a specific ID (PILOT USERS ONLY)
[**post**](TimesheetsalaryProjectTypeSpecificationApi.md#post) | **POST** /timesheet/salaryProjectTypeSpecification | [BETA] Create a timesheet ProjectSalaryType Specification. (PILOT USERS ONLY)
[**put**](TimesheetsalaryProjectTypeSpecificationApi.md#put) | **PUT** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Update a timesheet ProjectSalaryType Specification (PILOT USERS ONLY)
[**search**](TimesheetsalaryProjectTypeSpecificationApi.md#search) | **GET** /timesheet/salaryProjectTypeSpecification | [BETA] Get list of timesheet ProjectSalaryType Specifications (PILOT USERS ONLY)

# **delete**
> delete($id)

[BETA] Delete a timesheet SalaryType Specification (PILOT USERS ONLY)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetsalaryProjectTypeSpecificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID

try {
    $apiInstance->delete($id);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetsalaryProjectTypeSpecificationApi->delete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification get($id, $fields)

[BETA] Get timesheet ProjectSalaryType Specification for a specific ID (PILOT USERS ONLY)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetsalaryProjectTypeSpecificationApi(
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
    echo 'Exception when calling TimesheetsalaryProjectTypeSpecificationApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification**](../Model/ResponseWrapperTimesheetProjectSalaryTypeSpecification.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **post**
> \Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification post($body)

[BETA] Create a timesheet ProjectSalaryType Specification. (PILOT USERS ONLY)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetsalaryProjectTypeSpecificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification(); // \Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification | JSON representing the new object to be created. Should not have ID and version set.

try {
    $result = $apiInstance->post($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetsalaryProjectTypeSpecificationApi->post: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification**](../Model/TimesheetProjectSalaryTypeSpecification.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification**](../Model/ResponseWrapperTimesheetProjectSalaryTypeSpecification.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: */*
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **put**
> \Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification put($id, $body)

[BETA] Update a timesheet ProjectSalaryType Specification (PILOT USERS ONLY)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetsalaryProjectTypeSpecificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$body = new \Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification(); // \Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification | JSON representing the new object to be created. Should not have ID and version set.

try {
    $result = $apiInstance->put($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetsalaryProjectTypeSpecificationApi->put: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **body** | [**\Learnist\Tripletex\Model\TimesheetProjectSalaryTypeSpecification**](../Model/TimesheetProjectSalaryTypeSpecification.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperTimesheetProjectSalaryTypeSpecification**](../Model/ResponseWrapperTimesheetProjectSalaryTypeSpecification.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: */*
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseTimesheetProjectSalaryTypeSpecification search($date_from, $date_to, $employee_id, $project_id, $from, $count, $sorting, $fields)

[BETA] Get list of timesheet ProjectSalaryType Specifications (PILOT USERS ONLY)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetsalaryProjectTypeSpecificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$date_from = "date_from_example"; // string | From and including
$date_to = "date_to_example"; // string | To and excluding
$employee_id = 56; // int | Equals
$project_id = 56; // int | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($date_from, $date_to, $employee_id, $project_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetsalaryProjectTypeSpecificationApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **date_from** | **string**| From and including | [optional]
 **date_to** | **string**| To and excluding | [optional]
 **employee_id** | **int**| Equals | [optional]
 **project_id** | **int**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseTimesheetProjectSalaryTypeSpecification**](../Model/ListResponseTimesheetProjectSalaryTypeSpecification.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

