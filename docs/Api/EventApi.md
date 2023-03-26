# Learnist\Tripletex\EventApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**example**](EventApi.md#example) | **GET** /event/{eventType} | [BETA] Get example webhook payload
[**get**](EventApi.md#get) | **GET** /event | [BETA] Get all (WebHook) event keys.

# **example**
> \Learnist\Tripletex\Model\ResponseWrapperEventInfoDTO example($event_type, $fields)

[BETA] Get example webhook payload

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\EventApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$event_type = "event_type_example"; // string | Event type, from /event endpoint
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->example($event_type, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EventApi->example: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **event_type** | **string**| Event type, from /event endpoint |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperEventInfoDTO**](../Model/ResponseWrapperEventInfoDTO.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperMapStringEventInfoDescription get($fields)

[BETA] Get all (WebHook) event keys.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Learnist\Tripletex\Api\EventApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EventApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperMapStringEventInfoDescription**](../Model/ResponseWrapperMapStringEventInfoDescription.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

