# Learnist\Tripletex\InvoiceApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createCreditNote**](InvoiceApi.md#createcreditnote) | **PUT** /invoice/{id}/:createCreditNote | Creates a new Invoice representing a credit memo that nullifies the given invoice. Updates this invoice and any pre-existing inverse invoice.
[**createReminder**](InvoiceApi.md#createreminder) | **PUT** /invoice/{id}/:createReminder | Create invoice reminder and sends it by the given dispatch type. Supports the reminder types SOFT_REMINDER, REMINDER and NOTICE_OF_DEBT_COLLECTION. DispatchType NETS_PRINT must have type NOTICE_OF_DEBT_COLLECTION. SMS and NETS_PRINT must be activated prior to usage in the API.
[**downloadPdf**](InvoiceApi.md#downloadpdf) | **GET** /invoice/{invoiceId}/pdf | Get invoice document by invoice ID.
[**get**](InvoiceApi.md#get) | **GET** /invoice/{id} | Get invoice by ID.
[**payment**](InvoiceApi.md#payment) | **PUT** /invoice/{id}/:payment | Update invoice. The invoice is updated with payment information. The amount is in the invoice’s currency.
[**post**](InvoiceApi.md#post) | **POST** /invoice | Create invoice. Related Order and OrderLines can be created first, or included as new objects inside the Invoice.
[**postList**](InvoiceApi.md#postlist) | **POST** /invoice/list | [BETA] Create multiple invoices. Max 100 at a time.
[**search**](InvoiceApi.md#search) | **GET** /invoice | Find invoices corresponding with sent data. Includes charged outgoing invoices only.
[**send**](InvoiceApi.md#send) | **PUT** /invoice/{id}/:send | Send invoice by ID and sendType. Optionally override email recipient.

# **createCreditNote**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice createCreditNote($id, $date, $comment, $credit_note_email, $send_to_customer)

Creates a new Invoice representing a credit memo that nullifies the given invoice. Updates this invoice and any pre-existing inverse invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Invoice id
$date = "date_example"; // string | Credit note date
$comment = "comment_example"; // string | Comment
$credit_note_email = "credit_note_email_example"; // string | The credit note will not be sent if the customer send type is email and this field is empty
$send_to_customer = true; // bool | Equals

try {
    $result = $apiInstance->createCreditNote($id, $date, $comment, $credit_note_email, $send_to_customer);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->createCreditNote: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Invoice id |
 **date** | **string**| Credit note date |
 **comment** | **string**| Comment | [optional]
 **credit_note_email** | **string**| The credit note will not be sent if the customer send type is email and this field is empty | [optional]
 **send_to_customer** | **bool**| Equals | [optional] [default to true]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createReminder**
> createReminder($id, $type, $date, $dispatch_type, $include_charge, $include_interest, $sms_number)

Create invoice reminder and sends it by the given dispatch type. Supports the reminder types SOFT_REMINDER, REMINDER and NOTICE_OF_DEBT_COLLECTION. DispatchType NETS_PRINT must have type NOTICE_OF_DEBT_COLLECTION. SMS and NETS_PRINT must be activated prior to usage in the API.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$type = "type_example"; // string | type
$date = "date_example"; // string | yyyy-MM-dd. Defaults to today.
$dispatch_type = "dispatch_type_example"; // string | dispatchType
$include_charge = false; // bool | Equals
$include_interest = false; // bool | Equals
$sms_number = "sms_number_example"; // string | SMS number (must be a valid Norwegian telephone number)

try {
    $apiInstance->createReminder($id, $type, $date, $dispatch_type, $include_charge, $include_interest, $sms_number);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->createReminder: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **type** | **string**| type |
 **date** | **string**| yyyy-MM-dd. Defaults to today. |
 **dispatch_type** | **string**| dispatchType |
 **include_charge** | **bool**| Equals | [optional] [default to false]
 **include_interest** | **bool**| Equals | [optional] [default to false]
 **sms_number** | **string**| SMS number (must be a valid Norwegian telephone number) | [optional]

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **downloadPdf**
> string downloadPdf($invoice_id, $download)

Get invoice document by invoice ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_id = 56; // int | Invoice ID from which PDF is downloaded.
$download = true; // bool | Equals

try {
    $result = $apiInstance->downloadPdf($invoice_id, $download);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->downloadPdf: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **invoice_id** | **int**| Invoice ID from which PDF is downloaded. |
 **download** | **bool**| Equals | [optional] [default to true]

### Return type

**string**

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/octet-stream

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice get($id, $fields)

Get invoice by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
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
    echo 'Exception when calling InvoiceApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **payment**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice payment($id, $payment_date, $payment_type_id, $paid_amount, $paid_amount_currency)

Update invoice. The invoice is updated with payment information. The amount is in the invoice’s currency.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Invoice id
$payment_date = "payment_date_example"; // string | Payment date
$payment_type_id = 56; // int | PaymentType id
$paid_amount = 1.2; // float | Amount paid by customer in the company currency, typically NOK.
$paid_amount_currency = 1.2; // float | Amount paid by customer in the invoice currency. Optional, but required for invoices in alternate currencies.

try {
    $result = $apiInstance->payment($id, $payment_date, $payment_type_id, $paid_amount, $paid_amount_currency);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->payment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Invoice id |
 **payment_date** | **string**| Payment date |
 **payment_type_id** | **int**| PaymentType id |
 **paid_amount** | **float**| Amount paid by customer in the company currency, typically NOK. |
 **paid_amount_currency** | **float**| Amount paid by customer in the invoice currency. Optional, but required for invoices in alternate currencies. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **post**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice post($body, $send_to_customer, $payment_type_id, $paid_amount)

Create invoice. Related Order and OrderLines can be created first, or included as new objects inside the Invoice.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\Invoice(); // \Learnist\Tripletex\Model\Invoice | JSON representing the new object to be created. Should not have ID and version set.
$send_to_customer = true; // bool | Equals
$payment_type_id = 56; // int | Payment type to register prepayment of the invoice. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid.
$paid_amount = 1.2; // float | Paid amount to register prepayment of the invoice, in invoice currency. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid.

try {
    $result = $apiInstance->post($body, $send_to_customer, $payment_type_id, $paid_amount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->post: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\Invoice**](../Model/Invoice.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]
 **send_to_customer** | **bool**| Equals | [optional] [default to true]
 **payment_type_id** | **int**| Payment type to register prepayment of the invoice. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. | [optional]
 **paid_amount** | **float**| Paid amount to register prepayment of the invoice, in invoice currency. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postList**
> \Learnist\Tripletex\Model\ListResponseInvoice postList($body, $send_to_customer, $fields)

[BETA] Create multiple invoices. Max 100 at a time.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = array(new \Learnist\Tripletex\Model\Invoice()); // \Learnist\Tripletex\Model\Invoice[] | JSON representing a list of new objects to be created. Should not have ID and version set.
$send_to_customer = true; // bool | Equals
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->postList($body, $send_to_customer, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->postList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\Invoice[]**](../Model/Invoice.md)| JSON representing a list of new objects to be created. Should not have ID and version set. | [optional]
 **send_to_customer** | **bool**| Equals | [optional] [default to true]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ListResponseInvoice**](../Model/ListResponseInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseInvoice search($invoice_date_from, $invoice_date_to, $id, $invoice_number, $kid, $voucher_id, $customer_id, $from, $count, $sorting, $fields)

Find invoices corresponding with sent data. Includes charged outgoing invoices only.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
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
$voucher_id = "voucher_id_example"; // string | List of IDs
$customer_id = "customer_id_example"; // string | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($invoice_date_from, $invoice_date_to, $id, $invoice_number, $kid, $voucher_id, $customer_id, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->search: ', $e->getMessage(), PHP_EOL;
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
 **voucher_id** | **string**| List of IDs | [optional]
 **customer_id** | **string**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseInvoice**](../Model/ListResponseInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **send**
> send($id, $send_type, $override_email_address)

Send invoice by ID and sendType. Optionally override email recipient.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\InvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$send_type = "send_type_example"; // string | SendType
$override_email_address = "override_email_address_example"; // string | Will override email address if sendType = EMAIL

try {
    $apiInstance->send($id, $send_type, $override_email_address);
} catch (Exception $e) {
    echo 'Exception when calling InvoiceApi->send: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **send_type** | **string**| SendType |
 **override_email_address** | **string**| Will override email address if sendType &#x3D; EMAIL | [optional]

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

