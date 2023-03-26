# # ZtlConsent

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**consent_url** | **string** |  | [optional] [readonly]
**valid** | **bool** |  | [optional] [readonly]
**status** | **string** |  | [optional] [readonly]
**expiration_date** | **string** |  | [optional] [readonly]
**bank** | [**\Learnist\Tripletex\Model\Bank**](Bank.md) |  |
**consent_reference** | **string** |  | [optional]
**ztl_accounts** | [**\Learnist\Tripletex\Model\ZtlAccount[]**](ZtlAccount.md) | Link to accounts this consent belongs to | [optional]
**user_id_or_ssn** | **string** | userId for DNB, socialSecurityNumber for other banks | [optional]
**called_from_onboarding** | **bool** | Specify if this is called from the onboarding process | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
