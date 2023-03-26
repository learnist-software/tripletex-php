# Learnist\Tripletex\SalarypayslipApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**downloadPdf**](SalarypayslipApi.md#downloadpdf) | **GET** /salary/payslip/{id}/pdf | Find payslip (PDF document) by ID.
[**get**](SalarypayslipApi.md#get) | **GET** /salary/payslip/{id} | Find payslip by ID.
[**search**](SalarypayslipApi.md#search) | **GET** /salary/payslip | Find payslips corresponding with sent data.

# **downloadPdf**
> string downloadPdf($id)

Find payslip (PDF document) by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarypayslipApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID

try {
    $result = $apiInstance->downloadPdf($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarypayslipApi->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperPayslip get($id, $fields)

Find payslip by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarypayslipApi(
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
    echo 'Exception when calling SalarypayslipApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPayslip**](../Model/ResponseWrapperPayslip.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponsePayslip search($id, $employee_id, $wage_transaction_id, $activity_id, $year_from, $year_to, $month_from, $month_to, $voucher_date_from, $voucher_date_to, $comment, $from, $count, $sorting, $fields)

Find payslips corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SalarypayslipApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | List of IDs
$employee_id = "employee_id_example"; // string | List of IDs
$wage_transaction_id = "wage_transaction_id_example"; // string | List of IDs
$activity_id = "activity_id_example"; // string | List of IDs
$year_from = 56; // int | From and including
$year_to = 56; // int | To and excluding
$month_from = 56; // int | From and including
$month_to = 56; // int | To and excluding
$voucher_date_from = "voucher_date_from_example"; // string | From and including
$voucher_date_to = "voucher_date_to_example"; // string | To and excluding
$comment = "comment_example"; // string | Containing
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($id, $employee_id, $wage_transaction_id, $activity_id, $year_from, $year_to, $month_from, $month_to, $voucher_date_from, $voucher_date_to, $comment, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalarypayslipApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| List of IDs | [optional]
 **employee_id** | **string**| List of IDs | [optional]
 **wage_transaction_id** | **string**| List of IDs | [optional]
 **activity_id** | **string**| List of IDs | [optional]
 **year_from** | **int**| From and including | [optional]
 **year_to** | **int**| To and excluding | [optional]
 **month_from** | **int**| From and including | [optional]
 **month_to** | **int**| To and excluding | [optional]
 **voucher_date_from** | **string**| From and including | [optional]
 **voucher_date_to** | **string**| To and excluding | [optional]
 **comment** | **string**| Containing | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponsePayslip**](../Model/ListResponsePayslip.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

