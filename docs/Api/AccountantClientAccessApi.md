# Learnist\Tripletex\AccountantClientAccessApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getRequiresLevel4Authorization**](AccountantClientAccessApi.md#getrequireslevel4authorization) | **GET** /accountantClientAccess/requiresLevel4Authorization | Check if any of the employee ids requires level 4 authorizations to make changes

# **getRequiresLevel4Authorization**
> \Learnist\Tripletex\Model\ResponseWrapperBoolean getRequiresLevel4Authorization($customer_ids, $employee_ids, $fields)

Check if any of the employee ids requires level 4 authorizations to make changes

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\AccountantClientAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$customer_ids = "customer_ids_example"; // string | List of IDs
$employee_ids = "employee_ids_example"; // string | List of IDs
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->getRequiresLevel4Authorization($customer_ids, $employee_ids, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountantClientAccessApi->getRequiresLevel4Authorization: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **customer_ids** | **string**| List of IDs | [optional]
 **employee_ids** | **string**| List of IDs | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperBoolean**](../Model/ResponseWrapperBoolean.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

