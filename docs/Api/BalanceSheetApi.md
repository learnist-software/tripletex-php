# Learnist\Tripletex\BalanceSheetApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**search**](BalanceSheetApi.md#search) | **GET** /balanceSheet | Get balance sheet (saldobalanse).

# **search**
> \Learnist\Tripletex\Model\ListResponseBalanceSheetAccount search($date_from, $date_to, $account_number_from, $account_number_to, $customer_id, $employee_id, $department_id, $project_id, $include_sub_projects, $include_active_accounts_without_movements, $from, $count, $sorting, $fields)

Get balance sheet (saldobalanse).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\BalanceSheetApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$date_from = "date_from_example"; // string | Format is yyyy-MM-dd (from and incl.).
$date_to = "date_to_example"; // string | Format is yyyy-MM-dd (to and excl.).
$account_number_from = 56; // int | From and including
$account_number_to = 56; // int | To and excluding
$customer_id = 56; // int | Element ID
$employee_id = 56; // int | Element ID
$department_id = 56; // int | Element ID
$project_id = 56; // int | Element ID
$include_sub_projects = false; // bool | Should sub projects of the given project be included
$include_active_accounts_without_movements = false; // bool | Should active accounts with no movements be included
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($date_from, $date_to, $account_number_from, $account_number_to, $customer_id, $employee_id, $department_id, $project_id, $include_sub_projects, $include_active_accounts_without_movements, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BalanceSheetApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **date_from** | **string**| Format is yyyy-MM-dd (from and incl.). |
 **date_to** | **string**| Format is yyyy-MM-dd (to and excl.). |
 **account_number_from** | **int**| From and including | [optional]
 **account_number_to** | **int**| To and excluding | [optional]
 **customer_id** | **int**| Element ID | [optional]
 **employee_id** | **int**| Element ID | [optional]
 **department_id** | **int**| Element ID | [optional]
 **project_id** | **int**| Element ID | [optional]
 **include_sub_projects** | **bool**| Should sub projects of the given project be included | [optional] [default to false]
 **include_active_accounts_without_movements** | **bool**| Should active accounts with no movements be included | [optional] [default to false]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseBalanceSheetAccount**](../Model/ListResponseBalanceSheetAccount.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

