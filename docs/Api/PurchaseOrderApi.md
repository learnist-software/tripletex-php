# Learnist\Tripletex\PurchaseOrderApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**delete**](PurchaseOrderApi.md#delete) | **DELETE** /purchaseOrder/{id} | [BETA] Delete purchase order.
[**deleteAttachment**](PurchaseOrderApi.md#deleteattachment) | **DELETE** /purchaseOrder/{id}/attachment | [BETA] Delete attachment.
[**get**](PurchaseOrderApi.md#get) | **GET** /purchaseOrder/{id} | [BETA] Find purchase order by ID.
[**post**](PurchaseOrderApi.md#post) | **POST** /purchaseOrder | [BETA] Creates a new purchase order
[**put**](PurchaseOrderApi.md#put) | **PUT** /purchaseOrder/{id} | [BETA] Update purchase order.
[**search**](PurchaseOrderApi.md#search) | **GET** /purchaseOrder | [BETA] Find purchase orders with send data
[**send**](PurchaseOrderApi.md#send) | **PUT** /purchaseOrder/{id}/:send | [BETA] Send purchase order by id and sendType.
[**sendByEmail**](PurchaseOrderApi.md#sendbyemail) | **PUT** /purchaseOrder/{id}/:sendByEmail | [BETA] Send purchase order by customisable email.
[**uploadAttachment**](PurchaseOrderApi.md#uploadattachment) | **POST** /purchaseOrder/{id}/attachment | [BETA] Upload attachment to Purchase Order.
[**uploadAttachments**](PurchaseOrderApi.md#uploadattachments) | **POST** /purchaseOrder/{id}/attachment/list | Upload multiple attachments to Purchase Order.

# **delete**
> delete($id)

[BETA] Delete purchase order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID

try {
    $apiInstance->delete($id);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->delete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteAttachment**
> deleteAttachment($id)

[BETA] Delete attachment.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | ID of purchase order containing the attachment to delete.

try {
    $apiInstance->deleteAttachment($id);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->deleteAttachment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| ID of purchase order containing the attachment to delete. |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder get($id, $fields)

[BETA] Find purchase order by ID.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
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
    echo 'Exception when calling PurchaseOrderApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **post**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder post($body)

[BETA] Creates a new purchase order

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\PurchaseOrder(); // \Learnist\Tripletex\Model\PurchaseOrder | JSON representing the new object to be created. Should not have ID and version set.

try {
    $result = $apiInstance->post($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->post: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\PurchaseOrder**](../Model/PurchaseOrder.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **put**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder put($id, $body)

[BETA] Update purchase order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$body = new \Learnist\Tripletex\Model\PurchaseOrder(); // \Learnist\Tripletex\Model\PurchaseOrder | Partial object describing what should be updated

try {
    $result = $apiInstance->put($id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->put: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **body** | [**\Learnist\Tripletex\Model\PurchaseOrder**](../Model/PurchaseOrder.md)| Partial object describing what should be updated | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponsePurchaseOrder search($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields)

[BETA] Find purchase orders with send data

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$number = "number_example"; // string | Equals
$delivery_date_from = "delivery_date_from_example"; // string | Format is yyyy-MM-dd (from and incl.).
$delivery_date_to = "delivery_date_to_example"; // string | Format is yyyy-MM-dd (to and incl.).
$creation_date_from = "creation_date_from_example"; // string | Format is yyyy-MM-dd (from and incl.).
$creation_date_to = "creation_date_to_example"; // string | Format is yyyy-MM-dd (to and incl.).
$id = "id_example"; // string | List of IDs
$supplier_id = "supplier_id_example"; // string | List of IDs
$project_id = "project_id_example"; // string | List of IDs
$is_closed = true; // bool | Equals
$with_deviation_only = false; // bool | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **number** | **string**| Equals | [optional]
 **delivery_date_from** | **string**| Format is yyyy-MM-dd (from and incl.). | [optional]
 **delivery_date_to** | **string**| Format is yyyy-MM-dd (to and incl.). | [optional]
 **creation_date_from** | **string**| Format is yyyy-MM-dd (from and incl.). | [optional]
 **creation_date_to** | **string**| Format is yyyy-MM-dd (to and incl.). | [optional]
 **id** | **string**| List of IDs | [optional]
 **supplier_id** | **string**| List of IDs | [optional]
 **project_id** | **string**| List of IDs | [optional]
 **is_closed** | **bool**| Equals | [optional]
 **with_deviation_only** | **bool**| Equals | [optional] [default to false]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponsePurchaseOrder**](../Model/ListResponsePurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **send**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder send($id, $send_type)

[BETA] Send purchase order by id and sendType.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$send_type = "DEFAULT"; // string | Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it's specified.If receiverEmail empty it will take the vendor email.

try {
    $result = $apiInstance->send($id, $send_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->send: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **send_type** | **string**| Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. | [optional] [default to DEFAULT]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **sendByEmail**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder sendByEmail($id, $email_address, $subject, $message)

[BETA] Send purchase order by customisable email.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID
$email_address = "email_address_example"; // string | Email address
$subject = "subject_example"; // string | Subject
$message = "message_example"; // string | Message

try {
    $result = $apiInstance->sendByEmail($id, $email_address, $subject, $message);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->sendByEmail: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **email_address** | **string**| Email address |
 **subject** | **string**| Subject |
 **message** | **string**| Message | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadAttachment**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder uploadAttachment($file, $id, $fields)

[BETA] Upload attachment to Purchase Order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = "file_example"; // string | 
$id = 56; // int | Purchase Order ID to upload attachment to.
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->uploadAttachment($file, $id, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->uploadAttachment: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **file** | **string****string**|  |
 **id** | **int**| Purchase Order ID to upload attachment to. |
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **uploadAttachments**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder uploadAttachments($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)

Upload multiple attachments to Purchase Order.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrderApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$content_disposition = new \Learnist\Tripletex\Model\ContentDisposition(); // \Learnist\Tripletex\Model\ContentDisposition | 
$entity = new \stdClass; // object | 
$headers = array('key' => new \Learnist\Tripletex\Model\string[]()); // map[string,string[]] | 
$media_type = new \Learnist\Tripletex\Model\MediaType(); // \Learnist\Tripletex\Model\MediaType | 
$message_body_workers = new \Learnist\Tripletex\Model\MessageBodyWorkers(); // \Learnist\Tripletex\Model\MessageBodyWorkers | 
$parent = new \Learnist\Tripletex\Model\MultiPart(); // \Learnist\Tripletex\Model\MultiPart | 
$providers = new \Learnist\Tripletex\Model\Providers(); // \Learnist\Tripletex\Model\Providers | 
$body_parts = array(new \Learnist\Tripletex\Model\BodyPart()); // \Learnist\Tripletex\Model\BodyPart[] | 
$fields = array('key' => new \Learnist\Tripletex\Model\FormDataBodyPart[]()); // map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] | 
$parameterized_headers = array('key' => new \Learnist\Tripletex\Model\ParameterizedHeader[]()); // map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] | 
$id = 56; // int | Purchase Order ID to upload attachment to.

try {
    $result = $apiInstance->uploadAttachments($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrderApi->uploadAttachments: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **content_disposition** | [**\Learnist\Tripletex\Model\ContentDisposition**](../Model/.md)|  |
 **entity** | [**object**](../Model/.md)|  |
 **headers** | [**map[string,string[]]**](../Model/string[].md)|  |
 **media_type** | [**\Learnist\Tripletex\Model\MediaType**](../Model/.md)|  |
 **message_body_workers** | [**\Learnist\Tripletex\Model\MessageBodyWorkers**](../Model/.md)|  |
 **parent** | [**\Learnist\Tripletex\Model\MultiPart**](../Model/.md)|  |
 **providers** | [**\Learnist\Tripletex\Model\Providers**](../Model/.md)|  |
 **body_parts** | [**\Learnist\Tripletex\Model\BodyPart[]**](../Model/\Learnist\Tripletex\Model\BodyPart.md)|  |
 **fields** | [**map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]]**](../Model/\Learnist\Tripletex\Model\FormDataBodyPart[].md)|  |
 **parameterized_headers** | [**map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]]**](../Model/\Learnist\Tripletex\Model\ParameterizedHeader[].md)|  |
 **id** | **int**| Purchase Order ID to upload attachment to. |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: multipart/form-data
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

