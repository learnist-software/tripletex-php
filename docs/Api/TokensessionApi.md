# Learnist\Tripletex\TokensessionApi

All URIs are relative to *https://tripletex.no/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**create**](TokensessionApi.md#create) | **PUT** /token/session/:create | Create session token.
[**delete**](TokensessionApi.md#delete) | **DELETE** /token/session/{token} | Delete session token.
[**whoAmI**](TokensessionApi.md#whoami) | **GET** /token/session/&gt;whoAmI | Find information about the current user.

# **create**
> \Learnist\Tripletex\Model\ResponseWrapperSessionToken create($consumer_token, $employee_token, $expiration_date)

Create session token.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Learnist\Tripletex\Api\TokensessionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$consumer_token = "consumer_token_example"; // string | Token of the API consumer
$employee_token = "employee_token_example"; // string | The employee's token
$expiration_date = "expiration_date_example"; // string | Expiration date for the combined token

try {
    $result = $apiInstance->create($consumer_token, $employee_token, $expiration_date);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TokensessionApi->create: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **consumer_token** | **string**| Token of the API consumer |
 **employee_token** | **string**| The employee&#x27;s token |
 **expiration_date** | **string**| Expiration date for the combined token |

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperSessionToken**](../Model/ResponseWrapperSessionToken.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **delete**
> delete($token)

Delete session token.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TokensessionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$token = "token_example"; // string | The login token string to delete

try {
    $apiInstance->delete($token);
} catch (Exception $e) {
    echo 'Exception when calling TokensessionApi->delete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **token** | **string**| The login token string to delete |

### Return type

void (empty response body)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **whoAmI**
> \Learnist\Tripletex\Model\ResponseWrapperLoggedInUserInfoDTO whoAmI($fields)

Find information about the current user.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new Learnist\Tripletex\Api\TokensessionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->whoAmI($fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TokensessionApi->whoAmI: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **fields** | **string**| Fields filter pattern | [optional]

### Return type

[**\Learnist\Tripletex\Model\ResponseWrapperLoggedInUserInfoDTO**](../Model/ResponseWrapperLoggedInUserInfoDTO.md)

### Authorization

[tokenAuthScheme](../../README.md#tokenAuthScheme)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

