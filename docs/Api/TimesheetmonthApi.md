# Learnist\Tripletex\TimesheetmonthApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**approve**](TimesheetmonthApi.md#approve) | **PUT** /timesheet/month/:approve | approve month(s).  If id is provided the other args are ignored
[**complete**](TimesheetmonthApi.md#complete) | **PUT** /timesheet/month/:complete | complete month(s).  If id is provided the other args are ignored
[**get**](TimesheetmonthApi.md#get) | **GET** /timesheet/month/{id} | Find monthly status entry by ID.
[**getByMonthNumber**](TimesheetmonthApi.md#getbymonthnumber) | **GET** /timesheet/month/byMonthNumber | Find monthly status for given month.
[**reopen**](TimesheetmonthApi.md#reopen) | **PUT** /timesheet/month/:reopen | reopen month(s).  If id is provided the other args are ignored
[**unapprove**](TimesheetmonthApi.md#unapprove) | **PUT** /timesheet/month/:unapprove | unapprove month(s).  If id is provided the other args are ignored

# **approve**
> \Learnist\Tripletex\Model\ListResponseMonthlyStatus approve($id, $employee_ids, $month_year, $approved_until_date)

approve month(s).  If id is provided the other args are ignored

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$employee_ids = "employee_ids_example"; // string | List of IDs. Defaults to ID of token owner.
$month_year = "month_year_example"; // string | 2020-01
$approved_until_date = "approved_until_date_example"; // string | yyyy-MM-dd. Defaults to today.. Defaults to end of month

try {
    $result = $apiInstance->approve($id, $employee_ids, $month_year, $approved_until_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetmonthApi->approve: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID | [optional]
 **employee_ids** | **string**| List of IDs. Defaults to ID of token owner. | [optional]
 **month_year** | **string**| 2020-01 | [optional]
 **approved_until_date** | **string**| yyyy-MM-dd. Defaults to today.. Defaults to end of month | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseMonthlyStatus**](../Model/ListResponseMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **complete**
> \Learnist\Tripletex\Model\ListResponseMonthlyStatus complete($id, $employee_ids, $month_year)

complete month(s).  If id is provided the other args are ignored

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$employee_ids = "employee_ids_example"; // string | List of IDs. Defaults to ID of token owner.
$month_year = "month_year_example"; // string | 2020-01

try {
    $result = $apiInstance->complete($id, $employee_ids, $month_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetmonthApi->complete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID | [optional]
 **employee_ids** | **string**| List of IDs. Defaults to ID of token owner. | [optional]
 **month_year** | **string**| 2020-01 | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseMonthlyStatus**](../Model/ListResponseMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperMonthlyStatus get($id, $fields)

Find monthly status entry by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
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
    echo 'Exception when calling TimesheetmonthApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperMonthlyStatus**](../Model/ResponseWrapperMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getByMonthNumber**
> \Learnist\Tripletex\Model\ListResponseMonthlyStatus getByMonthNumber($employee_ids, $month_year, $from, $count, $sorting, $fields)

Find monthly status for given month.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_ids = "employee_ids_example"; // string | List of IDs. Defaults to ID of token owner.
$month_year = "month_year_example"; // string | 2020-01
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->getByMonthNumber($employee_ids, $month_year, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetmonthApi->getByMonthNumber: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **employee_ids** | **string**| List of IDs. Defaults to ID of token owner. |
 **month_year** | **string**| 2020-01 |
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseMonthlyStatus**](../Model/ListResponseMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reopen**
> \Learnist\Tripletex\Model\ListResponseMonthlyStatus reopen($id, $employee_ids, $month_year)

reopen month(s).  If id is provided the other args are ignored

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$employee_ids = "employee_ids_example"; // string | List of IDs. Defaults to ID of token owner.
$month_year = "month_year_example"; // string | 2020-01

try {
    $result = $apiInstance->reopen($id, $employee_ids, $month_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetmonthApi->reopen: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID | [optional]
 **employee_ids** | **string**| List of IDs. Defaults to ID of token owner. | [optional]
 **month_year** | **string**| 2020-01 | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseMonthlyStatus**](../Model/ListResponseMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **unapprove**
> \Learnist\Tripletex\Model\ListResponseMonthlyStatus unapprove($id, $employee_ids, $month_year)

unapprove month(s).  If id is provided the other args are ignored

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TimesheetmonthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$employee_ids = "employee_ids_example"; // string | List of IDs. Defaults to ID of token owner.
$month_year = "month_year_example"; // string | 2020-01

try {
    $result = $apiInstance->unapprove($id, $employee_ids, $month_year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TimesheetmonthApi->unapprove: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID | [optional]
 **employee_ids** | **string**| List of IDs. Defaults to ID of token owner. | [optional]
 **month_year** | **string**| 2020-01 | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseMonthlyStatus**](../Model/ListResponseMonthlyStatus.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

