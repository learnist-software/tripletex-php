# Learnist\Tripletex\ProjectimportApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**importProjectStatement**](ProjectimportApi.md#importprojectstatement) | **POST** /project/import | Upload project import file.

# **importProjectStatement**
> \Learnist\Tripletex\Model\ListResponseProject importProjectStatement($file, $file_format, $encoding, $delimiter, $ignore_first_row)

Upload project import file.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\ProjectimportApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = "file_example"; // string | 
$file_format = "file_format_example"; // string | File format
$encoding = "encoding_example"; // string | Encoding
$delimiter = "delimiter_example"; // string | Delimiter
$ignore_first_row = true; // bool | Ignore first row

try {
    $result = $apiInstance->importProjectStatement($file, $file_format, $encoding, $delimiter, $ignore_first_row);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectimportApi->importProjectStatement: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **file** | **string****string**|  |
 **file_format** | **string**| File format |
 **encoding** | **string**| Encoding | [optional]
 **delimiter** | **string**| Delimiter | [optional]
 **ignore_first_row** | **bool**| Ignore first row | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseProject**](../Model/ListResponseProject.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

