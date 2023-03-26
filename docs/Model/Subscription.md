# Subscription

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**event** | **string** | Event name (from /v2/event) you wish to subscribe to. Form should be: *subject.verb*. | 
**target_url** | **string** | The callback URL used for subscriptions (including authentication tokens). Must be absolute and use HTTPS. Basic authentication is supported. | 
**fields** | **string** | The fields in the object delivered with the notification callback, nested as in other API calls. | [optional] 
**status** | **string** | The status of the subscription. | [optional] 
**auth_header_name** | **string** | Custom authentication header name | [optional] 
**auth_header_value** | **string** | Custom authentication header value (write only) | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

