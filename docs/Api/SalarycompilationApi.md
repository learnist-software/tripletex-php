# Learnist\Tripletex\SalarycompilationApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadPdf**](SalarycompilationApi.md#downloadpdf) | **GET** /salary/compilation/pdf | Find salary compilation (PDF document) by employee.
[**get**](SalarycompilationApi.md#get) | **GET** /salary/compilation | Find salary compilation by employee.

# **downloadPdf**
> string downloadPdf($employee_id, $year)

Find salary compilation (PDF document) by employee.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarycompilationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_id = 56; // int | Element ID
$year = 56; // int | Must be between 1900-2100. Defaults to previous year.

try {
    $result = $apiInstance->downloadPdf($employee_id, $year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarycompilationApi->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **employee_id** | **int**| Element ID |
 **year** | **int**| Must be between 1900-2100. Defaults to previous year. | [optional]

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperSalaryCompilation get($employee_id, $year, $fields)

Find salary compilation by employee.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarycompilationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_id = 56; // int | Element ID
$year = 56; // int | Must be between 1900-2100. Defaults to previous year.
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($employee_id, $year, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarycompilationApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **employee_id** | **int**| Element ID |
 **year** | **int**| Must be between 1900-2100. Defaults to previous year. | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSalaryCompilation**](../Model/ResponseWrapperSalaryCompilation.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

