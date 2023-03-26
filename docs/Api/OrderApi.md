# Learnist\Tripletex\OrderApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**approveSubscriptionInvoice**](OrderApi.md#approvesubscriptioninvoice) | **PUT** /order/{id}/:approveSubscriptionInvoice | To create a subscription invoice, first create a order with the subscription enabled, then approve it with this method. This approves the order for subscription invoicing.
[**attach**](OrderApi.md#attach) | **PUT** /order/{id}/:attach | Attach document to specified order ID.
[**get**](OrderApi.md#get) | **GET** /order/{id} | Get order by ID.
[**invoice**](OrderApi.md#invoice) | **PUT** /order/{id}/:invoice | Create new invoice from order.
[**invoiceMultipleOrders**](OrderApi.md#invoicemultipleorders) | **PUT** /order/:invoiceMultipleOrders | [BETA] Charges a single customer invoice from multiple orders. The orders must be to the same customer, currency, due date, receiver email, attn. and smsNotificationNumber
[**post**](OrderApi.md#post) | **POST** /order | Create order.
[**postList**](OrderApi.md#postlist) | **POST** /order/list | [BETA] Create multiple Orders with OrderLines. Max 100 at a time.
[**put**](OrderApi.md#put) | **PUT** /order/{id} | Update order.
[**search**](OrderApi.md#search) | **GET** /order | Find orders corresponding with sent data.
[**unApproveSubscriptionInvoice**](OrderApi.md#unapprovesubscriptioninvoice) | **PUT** /order/{id}/:unApproveSubscriptionInvoice | Unapproves the order for subscription invoicing.

# **approveSubscriptionInvoice**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice approveSubscriptionInvoice($id, $invoice_date)

To create a subscription invoice, first create a order with the subscription enabled, then approve it with this method. This approves the order for subscription invoicing.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | ID of order to approve for subscription invoicing.
$invoice_date = "invoice_date_example"; // string | The approval date for the subscription.

try {
    $result = $apiInstance->approveSubscriptionInvoice($id, $invoice_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->approveSubscriptionInvoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| ID of order to approve for subscription invoicing. |
 **invoice_date** | **string**| The approval date for the subscription. |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **attach**
> \Learnist\Tripletex\Model\ResponseWrapperDocumentArchive attach($file, $id)

Attach document to specified order ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = "file_example"; // string | 
$id = 56; // int | Element ID

try {
    $result = $apiInstance->attach($file, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->attach: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **file** | **string****string**|  |
 **id** | **int**| Element ID |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperDocumentArchive**](../Model/ResponseWrapperDocumentArchive.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperOrder get($id, $fields)

Get order by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
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
    echo 'Exception when calling OrderApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperOrder**](../Model/ResponseWrapperOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **invoice**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice invoice($id, $invoice_date, $send_to_customer, $send_type, $payment_type_id, $paid_amount, $paid_amount_account_currency, $payment_type_id_rest_amount, $paid_amount_account_currency_rest, $create_on_account, $amount_on_account, $on_account_comment, $create_backorder, $invoice_id_if_is_credit_note, $override_email_address)

Create new invoice from order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | ID of order to invoice.
$invoice_date = "invoice_date_example"; // string | The invoice date
$send_to_customer = true; // bool | Send invoice to customer
$send_type = "send_type_example"; // string | Send type used for sending the invoice
$payment_type_id = 56; // int | Payment type to register prepayment of the invoice. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. The payment type must be related to an account with the same currency as the invoice.
$paid_amount = 1.2; // float | Paid amount to register prepayment of the invoice, in invoice currency. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. This amount is in the invoice currency.
$paid_amount_account_currency = 1.2; // float | Amount paid in payment type currency
$payment_type_id_rest_amount = 56; // int | Payment type of rest amount. It is possible to have two prepaid payments when invoicing. If paymentTypeIdRestAmount > 0, this second payment will be calculated as invoice amount - paidAmount
$paid_amount_account_currency_rest = 1.2; // float | Amount rest in payment type currency
$create_on_account = "create_on_account_example"; // string | Create on account(a konto)
$amount_on_account = 0.0; // float | Amount on account
$on_account_comment = "on_account_comment_example"; // string | On account comment
$create_backorder = false; // bool | Create a backorder for this order, available only for pilot users
$invoice_id_if_is_credit_note = 0; // int | Id of the invoice a credit note refers to
$override_email_address = "override_email_address_example"; // string | Will override email address if sendType = EMAIL

try {
    $result = $apiInstance->invoice($id, $invoice_date, $send_to_customer, $send_type, $payment_type_id, $paid_amount, $paid_amount_account_currency, $payment_type_id_rest_amount, $paid_amount_account_currency_rest, $create_on_account, $amount_on_account, $on_account_comment, $create_backorder, $invoice_id_if_is_credit_note, $override_email_address);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->invoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| ID of order to invoice. |
 **invoice_date** | **string**| The invoice date |
 **send_to_customer** | **bool**| Send invoice to customer | [optional] [default to true]
 **send_type** | **string**| Send type used for sending the invoice | [optional]
 **payment_type_id** | **int**| Payment type to register prepayment of the invoice. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. The payment type must be related to an account with the same currency as the invoice. | [optional]
 **paid_amount** | **float**| Paid amount to register prepayment of the invoice, in invoice currency. paymentTypeId and paidAmount are optional, but both must be provided if the invoice has already been paid. This amount is in the invoice currency. | [optional]
 **paid_amount_account_currency** | **float**| Amount paid in payment type currency | [optional]
 **payment_type_id_rest_amount** | **int**| Payment type of rest amount. It is possible to have two prepaid payments when invoicing. If paymentTypeIdRestAmount &gt; 0, this second payment will be calculated as invoice amount - paidAmount | [optional]
 **paid_amount_account_currency_rest** | **float**| Amount rest in payment type currency | [optional]
 **create_on_account** | **string**| Create on account(a konto) | [optional]
 **amount_on_account** | **float**| Amount on account | [optional] [default to 0.0]
 **on_account_comment** | **string**| On account comment | [optional]
 **create_backorder** | **bool**| Create a backorder for this order, available only for pilot users | [optional] [default to false]
 **invoice_id_if_is_credit_note** | **int**| Id of the invoice a credit note refers to | [optional] [default to 0]
 **override_email_address** | **string**| Will override email address if sendType &#x3D; EMAIL | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **invoiceMultipleOrders**
> \Learnist\Tripletex\Model\ResponseWrapperInvoice invoiceMultipleOrders($id, $invoice_date, $send_to_customer, $create_backorders)

[BETA] Charges a single customer invoice from multiple orders. The orders must be to the same customer, currency, due date, receiver email, attn. and smsNotificationNumber

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = "id_example"; // string | List of Order IDs - to the same customer, separated by comma.
$invoice_date = "invoice_date_example"; // string | The invoice date
$send_to_customer = true; // bool | Send invoice to customer
$create_backorders = false; // bool | Create a backorder for all any orders that delivers less than ordered amount

try {
    $result = $apiInstance->invoiceMultipleOrders($id, $invoice_date, $send_to_customer, $create_backorders);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->invoiceMultipleOrders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| List of Order IDs - to the same customer, separated by comma. |
 **invoice_date** | **string**| The invoice date |
 **send_to_customer** | **bool**| Send invoice to customer | [optional] [default to true]
 **create_backorders** | **bool**| Create a backorder for all any orders that delivers less than ordered amount | [optional] [default to false]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperInvoice**](../Model/ResponseWrapperInvoice.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **post**
> \Learnist\Tripletex\Model\ResponseWrapperOrder post($body)

Create order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\Order(); // \Learnist\Tripletex\Model\Order | JSON representing the new object to be created. Should not have ID and version set.

try {
    $result = $apiInstance->post($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->post: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\Order**](../Model/Order.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperOrder**](../Model/ResponseWrapperOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postList**
> \Learnist\Tripletex\Model\ListResponseOrder postList($body)

[BETA] Create multiple Orders with OrderLines. Max 100 at a time.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = array(new \Learnist\Tripletex\Model\Order()); // \Learnist\Tripletex\Model\Order[] | JSON representing a list of new objects to be created. Should not have ID and version set.

try {
    $result = $apiInstance->postList($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->postList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\Order[]**](../Model/Order.md)| JSON representing a list of new objects to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseOrder**](../Model/ListResponseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **put**
> \Learnist\Tripletex\Model\ResponseWrapperOrder put($id, $body)

Update order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$body = new \Learnist\Tripletex\Model\Order(); // \Learnist\Tripletex\Model\Order | Partial object describing what should be updated

try {
    $result = $apiInstance->put($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->put: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **body** | [**\Learnist\Tripletex\Model\Order**](../Model/Order.md)| Partial object describing what should be updated | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperOrder**](../Model/ResponseWrapperOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseOrder search($order_date_from, $order_date_to, $id, $number, $customer_id, $is_closed, $is_subscription, $from, $count, $sorting, $fields)

Find orders corresponding with sent data.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_date_from = "order_date_from_example"; // string | From and including
$order_date_to = "order_date_to_example"; // string | To and excluding
$id = "id_example"; // string | List of IDs
$number = "number_example"; // string | Equals
$customer_id = "customer_id_example"; // string | List of IDs
$is_closed = true; // bool | Equals
$is_subscription = true; // bool | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($order_date_from, $order_date_to, $id, $number, $customer_id, $is_closed, $is_subscription, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **order_date_from** | **string**| From and including |
 **order_date_to** | **string**| To and excluding |
 **id** | **string**| List of IDs | [optional]
 **number** | **string**| Equals | [optional]
 **customer_id** | **string**| List of IDs | [optional]
 **is_closed** | **bool**| Equals | [optional]
 **is_subscription** | **bool**| Equals | [optional]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseOrder**](../Model/ListResponseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **unApproveSubscriptionInvoice**
> unApproveSubscriptionInvoice($id)

Unapproves the order for subscription invoicing.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\OrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | ID of order to unapprove for subscription invoicing.

try {
    $apiInstance->unApproveSubscriptionInvoice($id);
} catch (Exception $e) {
    echo 'Exception when calling OrderApi->unApproveSubscriptionInvoice: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| ID of order to unapprove for subscription invoicing. |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

