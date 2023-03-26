# Learnist\Tripletex\SalarysettingsApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**get**](SalarysettingsApi.md#get) | **GET** /salary/settings | Get salary settings of logged in company.
[**put**](SalarysettingsApi.md#put) | **PUT** /salary/settings | Update settings of logged in company.

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperSalarySettings get($fields)

Get salary settings of logged in company.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarysettingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarysettingsApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSalarySettings**](../Model/ResponseWrapperSalarySettings.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **put**
> \Learnist\Tripletex\Model\ResponseWrapperSalarySettings put($body)

Update settings of logged in company.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarysettingsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\SalarySettings(); // \Learnist\Tripletex\Model\SalarySettings | Partial object describing what should be updated

try {
    $result = $apiInstance->put($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarysettingsApi->put: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\SalarySettings**](../Model/SalarySettings.md)| Partial object describing what should be updated | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSalarySettings**](../Model/ResponseWrapperSalarySettings.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

