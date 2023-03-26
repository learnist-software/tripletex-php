# Learnist\Tripletex\SupplierInvoiceApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addPayment**](SupplierInvoiceApi.md#addpayment) | **POST** /supplierInvoice/{invoiceId}/:addPayment | Register payment, paymentType &#x3D;&#x3D; 0 finds the last paymentType for this vendor
[**addRecipient**](SupplierInvoiceApi.md#addrecipient) | **PUT** /supplierInvoice/{invoiceId}/:addRecipient | Add recipient to supplier invoices.
[**addRecipientToMany**](SupplierInvoiceApi.md#addrecipienttomany) | **PUT** /supplierInvoice/:addRecipient | Add recipient.
[**approve**](SupplierInvoiceApi.md#approve) | **PUT** /supplierInvoice/{invoiceId}/:approve | Approve supplier invoice.
[**approveMany**](SupplierInvoiceApi.md#approvemany) | **PUT** /supplierInvoice/:approve | Approve supplier invoices.
[**changeDimensionMany**](SupplierInvoiceApi.md#changedimensionmany) | **PUT** /supplierInvoice/{invoiceId}/:changeDimension | Change dimension on a supplier invoice.
[**downloadPdf**](SupplierInvoiceApi.md#downloadpdf) | **GET** /supplierInvoice/{invoiceId}/pdf | Get supplierInvoice document by invoice ID.
[**get**](SupplierInvoiceApi.md#get) | **GET** /supplierInvoice/{id} | Get supplierInvoice by ID.
[**getApprovalInvoices**](SupplierInvoiceApi.md#getapprovalinvoices) | **GET** /supplierInvoice/forApproval | Get supplierInvoices for approval
[**putPostings**](SupplierInvoiceApi.md#putpostings) | **PUT** /supplierInvoice/voucher/{id}/postings | [BETA] Put debit postings.
[**reject**](SupplierInvoiceApi.md#reject) | **PUT** /supplierInvoice/{invoiceId}/:reject | reject supplier invoice.
[**rejectMany**](SupplierInvoiceApi.md#rejectmany) | **PUT** /supplierInvoice/:reject | reject supplier invoices.
[**search**](SupplierInvoiceApi.md#search) | **GET** /supplierInvoice | Find supplierInvoices corresponding with sent data.

# **addPayment**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice addPayment($invoice_id, $payment_type, $amount, $kid_or_receiver_reference, $bban, $payment_date, $use_default_payment_type, $partial_payment)

Register payment, paymentType == 0 finds the last paymentType for this vendor

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID.
$payment_type = 56; // int | 
$amount = "amount_example"; // string | 
$kid_or_receiver_reference = "kid_or_receiver_reference_example"; // string | 
$bban = "bban_example"; // string | 
$payment_date = "payment_date_example"; // string | 
$use_default_payment_type = false; // bool | Set paymentType to last type for vendor, autopay, nets or first available other type
$partial_payment = false; // bool | Set to true to allow multiple payments registered.

try {
    $result = $apiInstance->addPayment($invoice_id, $payment_type, $amount, $kid_or_receiver_reference, $bban, $payment_date, $use_default_payment_type, $partial_payment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->addPayment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID. |
 **payment_type** | **int**|  |
 **amount** | **string**|  | [optional]
 **kid_or_receiver_reference** | **string**|  | [optional]
 **bban** | **string**|  | [optional]
 **payment_date** | **string**|  | [optional]
 **use_default_payment_type** | **bool**| Set paymentType to last type for vendor, autopay, nets or first available other type | [optional] [default to false]
 **partial_payment** | **bool**| Set to true to allow multiple payments registered. | [optional] [default to false]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **addRecipient**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice addRecipient($invoice_id, $employee_id, $comment)

Add recipient to supplier invoices.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID.
$employee_id = 56; // int | ID of the elements
$comment = "comment_example"; // string | comment

try {
    $result = $apiInstance->addRecipient($invoice_id, $employee_id, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->addRecipient: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID. |
 **employee_id** | **int**| ID of the elements |
 **comment** | **string**| comment | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **addRecipientToMany**
> \Learnist\Tripletex\Model\ListResponseSupplierInvoice addRecipientToMany($employee_id, $invoice_ids, $comment)

Add recipient.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$employee_id = 56; // int | Element ID
$invoice_ids = "invoice_ids_example"; // string | ID of the elements
$comment = "comment_example"; // string | comment

try {
    $result = $apiInstance->addRecipientToMany($employee_id, $invoice_ids, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->addRecipientToMany: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **employee_id** | **int**| Element ID |
 **invoice_ids** | **string**| ID of the elements | [optional]
 **comment** | **string**| comment | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseSupplierInvoice**](../Model/ListResponseSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **approve**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice approve($invoice_id, $comment)

Approve supplier invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | ID of the elements
$comment = "comment_example"; // string | comment

try {
    $result = $apiInstance->approve($invoice_id, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->approve: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| ID of the elements |
 **comment** | **string**| comment | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **approveMany**
> \Learnist\Tripletex\Model\ListResponseSupplierInvoice approveMany($invoice_ids, $comment)

Approve supplier invoices.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_ids = "invoice_ids_example"; // string | ID of the elements
$comment = "comment_example"; // string | comment

try {
    $result = $apiInstance->approveMany($invoice_ids, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->approveMany: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_ids** | **string**| ID of the elements | [optional]
 **comment** | **string**| comment | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseSupplierInvoice**](../Model/ListResponseSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **changeDimensionMany**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice changeDimensionMany($invoice_id, $dimension, $dimension_id, $debit_posting_ids)

Change dimension on a supplier invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID.
$dimension = "dimension_example"; // string | Dimension
$dimension_id = 56; // int | DimensionID
$debit_posting_ids = "debit_posting_ids_example"; // string | ID of the elements

try {
    $result = $apiInstance->changeDimensionMany($invoice_id, $dimension, $dimension_id, $debit_posting_ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->changeDimensionMany: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID. |
 **dimension** | **string**| Dimension |
 **dimension_id** | **int**| DimensionID |
 **debit_posting_ids** | **string**| ID of the elements | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **downloadPdf**
> string downloadPdf($invoice_id)

Get supplierInvoice document by invoice ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID from which document is downloaded.

try {
    $result = $apiInstance->downloadPdf($invoice_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID from which document is downloaded. |

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice get($id, $fields)

Get supplierInvoice by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
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
    echo 'Exception when calling SupplierInvoiceApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getApprovalInvoices**
> \Learnist\Tripletex\Model\ListResponseSupplierInvoice getApprovalInvoices($search_text, $show_all, $employee_id, $from, $count, $sorting, $fields)

Get supplierInvoices for approval

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$search_text = "search_text_example"; // string | Search for department, employee, project and more
$show_all = false; // bool | Show all or just your own
$employee_id = 56; // int | Default is logged in employee
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->getApprovalInvoices($search_text, $show_all, $employee_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->getApprovalInvoices: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **search_text** | **string**| Search for department, employee, project and more | [optional]
 **show_all** | **bool**| Show all or just your own | [optional] [default to false]
 **employee_id** | **int**| Default is logged in employee | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseSupplierInvoice**](../Model/ListResponseSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **putPostings**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice putPostings($id, $body, $send_to_ledger, $voucher_date)

[BETA] Put debit postings.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Voucher id
$body = array(new \Learnist\Tripletex\Model\OrderLinePostingDTO()); // \Learnist\Tripletex\Model\OrderLinePostingDTO[] | Postings
$send_to_ledger = false; // bool | Equals
$voucher_date = "voucher_date_example"; // string | If set, the date of the voucher and the supplier invoice will be changed to this date. If empty, date will not be changed

try {
    $result = $apiInstance->putPostings($id, $body, $send_to_ledger, $voucher_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->putPostings: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Voucher id |
 **body** | [**\Learnist\Tripletex\Model\OrderLinePostingDTO[]**](../Model/OrderLinePostingDTO.md)| Postings | [optional]
 **send_to_ledger** | **bool**| Equals | [optional] [default to false]
 **voucher_date** | **string**| If set, the date of the voucher and the supplier invoice will be changed to this date. If empty, date will not be changed | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **reject**
> \Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice reject($invoice_id, $comment)

reject supplier invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID.
$comment = "comment_example"; // string | 

try {
    $result = $apiInstance->reject($invoice_id, $comment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->reject: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID. |
 **comment** | **string**|  |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSupplierInvoice**](../Model/ResponseWrapperSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **rejectMany**
> \Learnist\Tripletex\Model\ListResponseSupplierInvoice rejectMany($comment, $invoice_ids)

reject supplier invoices.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$comment = "comment_example"; // string | 
$invoice_ids = "invoice_ids_example"; // string | ID of the elements

try {
    $result = $apiInstance->rejectMany($comment, $invoice_ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->rejectMany: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **comment** | **string**|  |
 **invoice_ids** | **string**| ID of the elements | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseSupplierInvoice**](../Model/ListResponseSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseSupplierInvoice search($invoice_date_from, $invoice_date_to, $id, $invoice_number, $kid, $voucher_id, $supplier_id, $from, $count, $sorting, $fields)

Find supplierInvoices corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\SupplierInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_date_from = "invoice_date_from_example"; // string | From and including
$invoice_date_to = "invoice_date_to_example"; // string | To and excluding
$id = "id_example"; // string | List of IDs
$invoice_number = "invoice_number_example"; // string | Equals
$kid = "kid_example"; // string | Equals
$voucher_id = "voucher_id_example"; // string | Equals
$supplier_id = "supplier_id_example"; // string | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($invoice_date_from, $invoice_date_to, $id, $invoice_number, $kid, $voucher_id, $supplier_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SupplierInvoiceApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_date_from** | **string**| From and including |
 **invoice_date_to** | **string**| To and excluding |
 **id** | **string**| List of IDs | [optional]
 **invoice_number** | **string**| Equals | [optional]
 **kid** | **string**| Equals | [optional]
 **voucher_id** | **string**| Equals | [optional]
 **supplier_id** | **string**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseSupplierInvoice**](../Model/ListResponseSupplierInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

