# Learnist\Tripletex\PurchaseOrdergoodsReceiptApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**confirm**](PurchaseOrdergoodsReceiptApi.md#confirm) | **PUT** /purchaseOrder/goodsReceipt/{id}/:confirm | [BETA] Confirm goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**delete**](PurchaseOrdergoodsReceiptApi.md#delete) | **DELETE** /purchaseOrder/goodsReceipt/{id} | [BETA] Delete goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**deleteByIds**](PurchaseOrdergoodsReceiptApi.md#deletebyids) | **DELETE** /purchaseOrder/goodsReceipt/list | [BETA] Delete multiple goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**get**](PurchaseOrdergoodsReceiptApi.md#get) | **GET** /purchaseOrder/goodsReceipt/{id} | [BETA] Get goods receipt by purchase order ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**post**](PurchaseOrdergoodsReceiptApi.md#post) | **POST** /purchaseOrder/goodsReceipt | [BETA] Register goods receipt without an existing purchase order. When registration of several goods receipt, use /list for better performance. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**postList**](PurchaseOrdergoodsReceiptApi.md#postlist) | **POST** /purchaseOrder/goodsReceipt/list | [BETA] Register multiple goods receipt without an existing purchase order. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**put**](PurchaseOrdergoodsReceiptApi.md#put) | **PUT** /purchaseOrder/goodsReceipt/{id} | [BETA] Update goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**receiveAndConfirm**](PurchaseOrdergoodsReceiptApi.md#receiveandconfirm) | **PUT** /purchaseOrder/goodsReceipt/{id}/:receiveAndConfirm | [BETA]  Receive all ordered products and approve goods receipt. Only available for users that have activated the Logistics/Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**registerGoodsReceipt**](PurchaseOrdergoodsReceiptApi.md#registergoodsreceipt) | **PUT** /purchaseOrder/goodsReceipt/{id}/:registerGoodsReceipt | [BETA] Register goods receipt. Quantity received on the products is set to the same as quantity ordered. To update the quantity received, use PUT /purchaseOrder/goodsReceiptLine/{id}. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
[**search**](PurchaseOrdergoodsReceiptApi.md#search) | **GET** /purchaseOrder/goodsReceipt | [BETA] Get goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;

# **confirm**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder confirm($id, $create_rest_order, $fields)

[BETA] Confirm goods receipt. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Purchase Order ID.
$create_rest_order = false; // bool | Create restorder if quantity received is less than ordered
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->confirm($id, $create_rest_order, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->confirm: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Purchase Order ID. |
 **create_rest_order** | **bool**| Create restorder if quantity received is less than ordered | [optional] [default to false]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **delete**
> delete($id)

[BETA] Delete goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Element ID

try {
    $apiInstance->delete($id);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->delete: ', $e->getMessage(), PHP_EOL;
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

# **deleteByIds**
> deleteByIds($ids)

[BETA] Delete multiple goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = "ids_example"; // string | ID of the elements

try {
    $apiInstance->deleteByIds($ids);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->deleteByIds: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | **string**| ID of the elements |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **get**
> \Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt get($id, $fields)

[BETA] Get goods receipt by purchase order ID. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
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
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->get: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Element ID |
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt**](../Model/ResponseWrapperGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **post**
> \Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt post($body, $fields)

[BETA] Register goods receipt without an existing purchase order. When registration of several goods receipt, use /list for better performance. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Learnist\Tripletex\Model\GoodsReceipt(); // \Learnist\Tripletex\Model\GoodsReceipt | JSON representing the new object to be created. Should not have ID and version set.
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->post($body, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->post: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\GoodsReceipt**](../Model/GoodsReceipt.md)| JSON representing the new object to be created. Should not have ID and version set. | [optional]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt**](../Model/ResponseWrapperGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **postList**
> \Learnist\Tripletex\Model\ListResponseGoodsReceipt postList($body, $fields)

[BETA] Register multiple goods receipt without an existing purchase order. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = array(new \Learnist\Tripletex\Model\GoodsReceipt()); // \Learnist\Tripletex\Model\GoodsReceipt[] | JSON representing a list of new objects to be created. Should not have ID and version set.
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->postList($body, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->postList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Learnist\Tripletex\Model\GoodsReceipt[]**](../Model/GoodsReceipt.md)| JSON representing a list of new objects to be created. Should not have ID and version set. | [optional]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ListResponseGoodsReceipt**](../Model/ListResponseGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **put**
> \Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt put($id, $body, $fields)

[BETA] Update goods receipt. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Goods Receipt ID.
$body = new \Learnist\Tripletex\Model\GoodsReceipt(); // \Learnist\Tripletex\Model\GoodsReceipt | Partial object describing what should be updated
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->put($id, $body, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->put: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Goods Receipt ID. |
 **body** | [**\Learnist\Tripletex\Model\GoodsReceipt**](../Model/GoodsReceipt.md)| Partial object describing what should be updated | [optional]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt**](../Model/ResponseWrapperGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: application/json; charset=utf-8
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **receiveAndConfirm**
> \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder receiveAndConfirm($id, $received_date, $inventory_id, $fields)

[BETA]  Receive all ordered products and approve goods receipt. Only available for users that have activated the Logistics/Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Purchase Order ID.
$received_date = "received_date_example"; // string | The approval date for the subscription.
$inventory_id = 56; // int | ID of inventory. Main inventory is set as default
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->receiveAndConfirm($id, $received_date, $inventory_id, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->receiveAndConfirm: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Purchase Order ID. |
 **received_date** | **string**| The approval date for the subscription. |
 **inventory_id** | **int**| ID of inventory. Main inventory is set as default | [optional]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder**](../Model/ResponseWrapperPurchaseOrder.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **registerGoodsReceipt**
> \Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt registerGoodsReceipt($id, $registration_date, $inventory_id, $comment, $fields)

[BETA] Register goods receipt. Quantity received on the products is set to the same as quantity ordered. To update the quantity received, use PUT /purchaseOrder/goodsReceiptLine/{id}. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Purchase Order ID.
$registration_date = "registration_date_example"; // string | yyyy-MM-dd. Defaults to today.
$inventory_id = 56; // int | ID of inventory. Main inventory is set as default
$comment = "comment_example"; // string | Containing
$fields = "*"; // string | Fields filter pattern

try {
    $result = $apiInstance->registerGoodsReceipt($id, $registration_date, $inventory_id, $comment, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->registerGoodsReceipt: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Purchase Order ID. |
 **registration_date** | **string**| yyyy-MM-dd. Defaults to today. |
 **inventory_id** | **int**| ID of inventory. Main inventory is set as default | [optional]
 **comment** | **string**| Containing | [optional]
 **fields** | **string**| Fields filter pattern | [optional] [default to *]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperGoodsReceipt**](../Model/ResponseWrapperGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **search**
> \Learnist\Tripletex\Model\ListResponseGoodsReceipt search($received_date_from, $received_date_to, $status, $without_purchase, $from, $count, $sorting, $fields)

[BETA] Get goods receipt. Only available for users that have activated the Logistics Plus Beta-program in 'Our customer account'

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\PurchaseOrdergoodsReceiptApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$received_date_from = "received_date_from_example"; // string | Format is yyyy-MM-dd (from and incl.).
$received_date_to = "received_date_to_example"; // string | Format is yyyy-MM-dd (to and incl.).
$status = "status_example"; // string | Equals
$without_purchase = false; // bool | Equals
$from = 0; // int | From index
$count = 1000; // int | Number of elements to return
$sorting = "sorting_example"; // string | Sorting pattern
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->search($received_date_from, $received_date_to, $status, $without_purchase, $from, $count, $sorting, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PurchaseOrdergoodsReceiptApi->search: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **received_date_from** | **string**| Format is yyyy-MM-dd (from and incl.). | [optional]
 **received_date_to** | **string**| Format is yyyy-MM-dd (to and incl.). | [optional]
 **status** | **string**| Equals | [optional]
 **without_purchase** | **bool**| Equals | [optional] [default to false]
 **from** | **int**| From index | [optional] [default to 0]
 **count** | **int**| Number of elements to return | [optional] [default to 1000]
 **sorting** | **string**| Sorting pattern | [optional]
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ListResponseGoodsReceipt**](../Model/ListResponseGoodsReceipt.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

