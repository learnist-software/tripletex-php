# Learnist\Tripletex\LedgervatTypeApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createRelativeVatType**](LedgervatTypeApi.md#createrelativevattype) | **PUT** /ledger/vatType/createRelativeVatType | Create a new relative VAT Type. These are used if the company has &#x27;forholdsmessig fradrag for inngående MVA&#x27;.
[**get**](LedgervatTypeApi.md#get) | **GET** /ledger/vatType/{id} | Get vat type by ID.
[**search**](LedgervatTypeApi.md#search) | **GET** /ledger/vatType | Find vat types corresponding with sent data.

# **createRelativeVatType**
> \Learnist\Tripletex\Model\ResponseWrapperVatType createRelativeVatType($name, $vat_type_id, $percentage)

Create a new relative VAT Type. These are used if the company has 'forholdsmessig fradrag for inngående MVA'.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervatTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$name = "name_example"; // string | VAT type name, max 8 characters.
$vat_type_id = 56; // int | VAT type ID. The relative VAT type will behave like this VAT type, except for the basis for calculating the VAT deduction, which is decided by the basis percentage.
$percentage = 1.2; // float | Basis percentage. This percentage will be multiplied with the transaction amount to find the amount that will be the basis for calculating the deduction amount.

try {
    $result = $apiInstance->createRelativeVatType($name, $vat_type_id, $percentage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgervatTypeApi->createRelativeVatType: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| VAT type name, max 8 characters. |
 **vat_type_id** | **int**| VAT type ID. The relative VAT type will behave like this VAT type, except for the basis for calculating the VAT deduction, which is decided by the basis percentage. |
 **percentage** | **float**| Basis percentage. This percentage will be multiplied with the transaction amount to find the amount that will be the basis for calculating the deduction amount. |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperVatType**](../Model/ResponseWrapperVatType.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperVatType get($id, $fields)

Get vat type by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervatTypeApi(
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
    echo 'Exception when calling LedgervatTypeApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperVatType**](../Model/ResponseWrapperVatType.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseVatType search($id, $number, $type_of_vat, $vat_date, $should_include_specification_types, $from, $count, $sorting, $fields)

Find vat types corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\LedgervatTypeApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | List of IDs
$number = "number_example"; // string | List of IDs
$type_of_vat = "type_of_vat_example"; // string | Type of VAT
$vat_date = "vat_date_example"; // string | yyyy-MM-dd. Defaults to today. Note that this is only used in combination with typeOfVat-parameter. Only valid vatTypes on the given date are returned.
$should_include_specification_types = true; // bool | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($id, $number, $type_of_vat, $vat_date, $should_include_specification_types, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling LedgervatTypeApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| List of IDs | [optional]
 **number** | **string**| List of IDs | [optional]
 **type_of_vat** | **string**| Type of VAT | [optional]
 **vat_date** | **string**| yyyy-MM-dd. Defaults to today. Note that this is only used in combination with typeOfVat-parameter. Only valid vatTypes on the given date are returned. | [optional]
 **should_include_specification_types** | **bool**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseVatType**](../Model/ListResponseVatType.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

