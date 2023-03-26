# Learnist\Tripletex\ProjectresourceplanApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**get**](ProjectresourceplanApi.md#get) | **GET** /project/resourcePlanBudget | Get resource plan entries in the specified period.

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperResourcePlanBudget get($period_type, $project_id, $period_start, $period_end, $fields)

Get resource plan entries in the specified period.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\ProjectresourceplanApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$period_type = "period_type_example"; // string | Equals
$project_id = 56; // int | Equals
$period_start = "period_start_example"; // string | From and including
$period_end = "period_end_example"; // string | To and excluding
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->get($period_type, $project_id, $period_start, $period_end, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectresourceplanApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **period_type** | **string**| Equals |
 **project_id** | **int**| Equals | [optional]
 **period_start** | **string**| From and including | [optional]
 **period_end** | **string**| To and excluding | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperResourcePlanBudget**](../Model/ResponseWrapperResourcePlanBudget.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

