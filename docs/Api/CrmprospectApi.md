# Learnist\Tripletex\CrmprospectApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**get**](CrmprospectApi.md#get) | **GET** /crm/prospect/{id} | Get prospect by ID.
[**search**](CrmprospectApi.md#search) | **GET** /crm/prospect | Find prospects corresponding with sent data.

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperProspect get($id, $fields)

Get prospect by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\CrmprospectApi(
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
    echo 'Exception when calling CrmprospectApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperProspect**](../Model/ResponseWrapperProspect.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseProspect search($name, $description, $created_date_from, $created_date_to, $customer_id, $sales_employee_id, $is_closed, $closed_reason, $closed_date_from, $closed_date_to, $competitor, $prospect_type, $project_id, $project_offer_id, $from, $count, $sorting, $fields)

Find prospects corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\CrmprospectApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$name = "name_example"; // string | Containing
$description = "description_example"; // string | Containing
$created_date_from = "created_date_from_example"; // string | From and including
$created_date_to = "created_date_to_example"; // string | To and excluding
$customer_id = "customer_id_example"; // string | Equals
$sales_employee_id = "sales_employee_id_example"; // string | Equals
$is_closed = true; // bool | Equals
$closed_reason = "closed_reason_example"; // string | Equals
$closed_date_from = "closed_date_from_example"; // string | From and including
$closed_date_to = "closed_date_to_example"; // string | To and excluding
$competitor = "competitor_example"; // string | Containing
$prospect_type = "prospect_type_example"; // string | Equals
$project_id = "project_id_example"; // string | Equals
$project_offer_id = "project_offer_id_example"; // string | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($name, $description, $created_date_from, $created_date_to, $customer_id, $sales_employee_id, $is_closed, $closed_reason, $closed_date_from, $closed_date_to, $competitor, $prospect_type, $project_id, $project_offer_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CrmprospectApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| Containing | [optional]
 **description** | **string**| Containing | [optional]
 **created_date_from** | **string**| From and including | [optional]
 **created_date_to** | **string**| To and excluding | [optional]
 **customer_id** | **string**| Equals | [optional]
 **sales_employee_id** | **string**| Equals | [optional]
 **is_closed** | **bool**| Equals | [optional]
 **closed_reason** | **string**| Equals | [optional]
 **closed_date_from** | **string**| From and including | [optional]
 **closed_date_to** | **string**| To and excluding | [optional]
 **competitor** | **string**| Containing | [optional]
 **prospect_type** | **string**| Equals | [optional]
 **project_id** | **string**| Equals | [optional]
 **project_offer_id** | **string**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseProspect**](../Model/ListResponseProspect.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

