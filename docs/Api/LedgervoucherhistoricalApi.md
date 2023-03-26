# Learnist\Tripletex\LedgervoucherhistoricalApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**closePostings**](LedgervoucherhistoricalApi.md#closepostings) | **PUT** /ledger/voucher/historical/:closePostings | [BETA] Close postings.
[**postEmployee**](LedgervoucherhistoricalApi.md#postemployee) | **POST** /ledger/voucher/historical/employee | [BETA] Create one employee, based on import from external system. Validation is less strict, ie. employee department isn&#x27;t required.
[**postHistorical**](LedgervoucherhistoricalApi.md#posthistorical) | **POST** /ledger/voucher/historical/historical | API endpoint for creating historical vouchers. These are vouchers created outside Tripletex, and should be from closed accounting years. The intended usage is to get access to historical transcations in Tripletex. Also creates postings. All amount fields in postings will be used. VAT postings must be included, these are not generated automatically like they are for normal vouchers in Tripletex. Requires the \\\&quot;All vouchers\\\&quot; and \\\&quot;Advanced Voucher\\\&quot; permissions.
[**reverseHistoricalVouchers**](LedgervoucherhistoricalApi.md#reversehistoricalvouchers) | **PUT** /ledger/voucher/historical/:reverseHistoricalVouchers | [BETA] Deletes all historical vouchers. Requires the \&quot;All vouchers\&quot; and \&quot;Advanced Voucher\&quot; permissions.
[**uploadAttachment**](LedgervoucherhistoricalApi.md#uploadattachment) | **POST** /ledger/voucher/historical/{voucherId}/attachment | Upload attachment to voucher. If the voucher already has an attachment the content will be appended to the existing attachment as new PDF page(s). Valid document formats are PDF, PNG, JPEG and TIFF. Non PDF formats will be converted to PDF. Send as multipart form.

# **closePostings**
> closePostings($body, $posting_ids)

[BETA] Close postings.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervoucherhistoricalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = "body_example"; // string | List of Posting IDs to close separated by comma. The postings should have the same customer, supplier or employee. The sum of amount for all postings MUST be 0.0, otherwise an exception will be thrown.
$posting_ids = "posting_ids_example"; // string | [Deprecated] List of Posting IDs to close separated by comma. The postings should have the same customer, supplier or employee. The sum of amount for all postings MUST be 0.0, otherwise an exception will be thrown.

try {
    $apiInstance->closePostings($body, $posting_ids);
} catch (Exception $e) {
    echo 'Exception when calling LedgervoucherhistoricalApi->closePostings: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**string**](../Model/string.md)| List of Posting IDs to close separated by comma. The postings should have the same customer, supplier or employee. The sum of amount for all postings MUST be 0.0, otherwise an exception will be thrown. | [optional]
 **posting_ids** | **string**| [Deprecated] List of Posting IDs to close separated by comma. The postings should have the same customer, supplier or employee. The sum of amount for all postings MUST be 0.0, otherwise an exception will be thrown. | [optional]

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: */*
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postEmployee**
> \Learnist\Tripletex\Model\ResponseWrapperEmployee postEmployee($body)

[BETA] Create one employee, based on import from external system. Validation is less strict, ie. employee department isn't required.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervoucherhistoricalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\Employee(); // \Learnist\Tripletex\Model\Employee | JSON representing the new object to be created. Should not have ID and version set.

try {
    $result = $apiInstance->postEmployee($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgervoucherhistoricalApi->postEmployee: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\Employee**](../Model/Employee.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperEmployee**](../Model/ResponseWrapperEmployee.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postHistorical**
> \Learnist\Tripletex\Model\ListResponseHistoricalVoucher postHistorical($body, $comment)

API endpoint for creating historical vouchers. These are vouchers created outside Tripletex, and should be from closed accounting years. The intended usage is to get access to historical transcations in Tripletex. Also creates postings. All amount fields in postings will be used. VAT postings must be included, these are not generated automatically like they are for normal vouchers in Tripletex. Requires the \\\"All vouchers\\\" and \\\"Advanced Voucher\\\" permissions.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervoucherhistoricalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = array(new \Learnist\Tripletex\Model\HistoricalVoucher()); // \Learnist\Tripletex\Model\HistoricalVoucher[] | List of vouchers and related postings to import. Max 500.  
$comment = "comment_example"; // string | Import comment, include the name and version of the source system.

try {
    $result = $apiInstance->postHistorical($body, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgervoucherhistoricalApi->postHistorical: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\HistoricalVoucher[]**](../Model/HistoricalVoucher.md)| List of vouchers and related postings to import. Max 500.   | [optional]
 **comment** | **string**| Import comment, include the name and version of the source system. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseHistoricalVoucher**](../Model/ListResponseHistoricalVoucher.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reverseHistoricalVouchers**
> reverseHistoricalVouchers()

[BETA] Deletes all historical vouchers. Requires the \"All vouchers\" and \"Advanced Voucher\" permissions.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervoucherhistoricalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->reverseHistoricalVouchers();
} catch (Exception $e) {
    echo 'Exception when calling LedgervoucherhistoricalApi->reverseHistoricalVouchers: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadAttachment**
> uploadAttachment($file, $voucher_id)

Upload attachment to voucher. If the voucher already has an attachment the content will be appended to the existing attachment as new PDF page(s). Valid document formats are PDF, PNG, JPEG and TIFF. Non PDF formats will be converted to PDF. Send as multipart form.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervoucherhistoricalApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = "file_example"; // string | 
$voucher_id = 56; // int | Voucher ID to upload attachment to.

try {
    $apiInstance->uploadAttachment($file, $voucher_id);
} catch (Exception $e) {
    echo 'Exception when calling LedgervoucherhistoricalApi->uploadAttachment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **file** | **string****string**|  |
 **voucher_id** | **int**| Voucher ID to upload attachment to. |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

