# Learnist\Tripletex\LedgerApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**openPost**](LedgerApi.md#openpost) | **GET** /ledger/openPost | Find open posts corresponding with sent data.
[**search**](LedgerApi.md#search) | **GET** /ledger | Get ledger (hovedbok).

# **openPost**
> \Learnist\Tripletex\Model\ListResponseLedgerAccount openPost($date, $account_id, $supplier_id, $customer_id, $employee_id, $department_id, $project_id, $product_id, $from, $count, $sorting, $fields)

Find open posts corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$date = "date_example"; // string | Invoice date. Format is yyyy-MM-dd (to and excl.).
$account_id = 56; // int | Element ID
$supplier_id = 56; // int | Element ID
$customer_id = 56; // int | Element ID
$employee_id = 56; // int | Element ID
$department_id = 56; // int | Element ID
$project_id = 56; // int | Element ID
$product_id = 56; // int | Element ID
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->openPost($date, $account_id, $supplier_id, $customer_id, $employee_id, $department_id, $project_id, $product_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgerApi->openPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **date** | **string**| Invoice date. Format is yyyy-MM-dd (to and excl.). |
 **account_id** | **int**| Element ID | [optional]
 **supplier_id** | **int**| Element ID | [optional]
 **customer_id** | **int**| Element ID | [optional]
 **employee_id** | **int**| Element ID | [optional]
 **department_id** | **int**| Element ID | [optional]
 **project_id** | **int**| Element ID | [optional]
 **product_id** | **int**| Element ID | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseLedgerAccount**](../Model/ListResponseLedgerAccount.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseLedgerAccount search($date_from, $date_to, $open_postings, $account_id, $supplier_id, $customer_id, $employee_id, $department_id, $project_id, $product_id, $from, $count, $sorting, $fields)

Get ledger (hovedbok).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgerApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$date_from = "date_from_example"; // string | Format is yyyy-MM-dd (from and incl.).
$date_to = "date_to_example"; // string | Format is yyyy-MM-dd (to and excl.).
$open_postings = "open_postings_example"; // string | Deprecated
$account_id = 56; // int | Element ID
$supplier_id = 56; // int | Element ID
$customer_id = 56; // int | Element ID
$employee_id = 56; // int | Element ID
$department_id = 56; // int | Element ID
$project_id = 56; // int | Element ID
$product_id = 56; // int | Element ID
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($date_from, $date_to, $open_postings, $account_id, $supplier_id, $customer_id, $employee_id, $department_id, $project_id, $product_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgerApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **date_from** | **string**| Format is yyyy-MM-dd (from and incl.). |
 **date_to** | **string**| Format is yyyy-MM-dd (to and excl.). |
 **open_postings** | **string**| Deprecated | [optional]
 **account_id** | **int**| Element ID | [optional]
 **supplier_id** | **int**| Element ID | [optional]
 **customer_id** | **int**| Element ID | [optional]
 **employee_id** | **int**| Element ID | [optional]
 **department_id** | **int**| Element ID | [optional]
 **project_id** | **int**| Element ID | [optional]
 **product_id** | **int**| Element ID | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseLedgerAccount**](../Model/ListResponseLedgerAccount.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

