# Learnist\Tripletex\SaftApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**exportSAFT**](SaftApi.md#exportsaft) | **GET** /saft/exportSAFT | [BETA] Create SAF-T export for the Tripletex account.
[**importSAFT**](SaftApi.md#importsaft) | **POST** /saft/importSAFT | [BETA] Import SAF-T. Send XML file as multipart form.

# **exportSAFT**
> string exportSAFT($year)

[BETA] Create SAF-T export for the Tripletex account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SaftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$year = 56; // int | Year to export

try {
    $result = $apiInstance->exportSAFT($year);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SaftApi->exportSAFT: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **year** | **int**| Year to export |

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **importSAFT**
> importSAFT($saft_file, $mapping_file, $import_customer_vendors, $create_missing_accounts, $import_start_balance_from_opening, $import_start_balance_from_closing, $import_vouchers, $import_departments, $import_projects, $tripletex_generates_customer_numbers, $create_customer_ib, $update_account_names, $create_vendor_ib, $override_voucher_date_on_discrepancy, $overwrite_customers_contacts, $only_active_customers, $only_active_accounts, $update_start_balance)

[BETA] Import SAF-T. Send XML file as multipart form.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SaftApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$saft_file = "saft_file_example"; // string | 
$mapping_file = "mapping_file_example"; // string | 
$import_customer_vendors = true; // bool | 
$create_missing_accounts = true; // bool | 
$import_start_balance_from_opening = true; // bool | 
$import_start_balance_from_closing = true; // bool | 
$import_vouchers = true; // bool | 
$import_departments = true; // bool | 
$import_projects = true; // bool | 
$tripletex_generates_customer_numbers = true; // bool | 
$create_customer_ib = true; // bool | 
$update_account_names = true; // bool | 
$create_vendor_ib = true; // bool | 
$override_voucher_date_on_discrepancy = true; // bool | 
$overwrite_customers_contacts = true; // bool | 
$only_active_customers = true; // bool | 
$only_active_accounts = true; // bool | 
$update_start_balance = true; // bool | 

try {
    $apiInstance->importSAFT($saft_file, $mapping_file, $import_customer_vendors, $create_missing_accounts, $import_start_balance_from_opening, $import_start_balance_from_closing, $import_vouchers, $import_departments, $import_projects, $tripletex_generates_customer_numbers, $create_customer_ib, $update_account_names, $create_vendor_ib, $override_voucher_date_on_discrepancy, $overwrite_customers_contacts, $only_active_customers, $only_active_accounts, $update_start_balance);
} catch (Exception $e) {
    echo 'Exception when calling SaftApi->importSAFT: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **saft_file** | **string****string**|  |
 **mapping_file** | **string****string**|  |
 **import_customer_vendors** | **bool**|  |
 **create_missing_accounts** | **bool**|  |
 **import_start_balance_from_opening** | **bool**|  |
 **import_start_balance_from_closing** | **bool**|  |
 **import_vouchers** | **bool**|  |
 **import_departments** | **bool**|  |
 **import_projects** | **bool**|  |
 **tripletex_generates_customer_numbers** | **bool**|  |
 **create_customer_ib** | **bool**|  |
 **update_account_names** | **bool**|  |
 **create_vendor_ib** | **bool**|  |
 **override_voucher_date_on_discrepancy** | **bool**|  |
 **overwrite_customers_contacts** | **bool**|  |
 **only_active_customers** | **bool**|  |
 **only_active_accounts** | **bool**|  |
 **update_start_balance** | **bool**|  |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

