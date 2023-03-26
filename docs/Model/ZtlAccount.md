# # ZtlAccount

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**name** | **string** |  | [optional]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional]
**bban** | **string** |  | [optional] [readonly]
**iban** | **string** |  | [optional] [readonly]
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional]
**available_balance_currency** | **object** |  | [optional]
**booked_balance_currency** | **object** |  | [optional]
**last_updated** | **string** | Last time the account information was updated, mainly balance. | [optional] [readonly]
**deletable** | **bool** |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
