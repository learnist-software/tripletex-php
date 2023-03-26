# # ApproveResponseDTO

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**redirect_url** | **string** | The redirect URL to AutoPay 2FA after payments are sent to be approved | [optional]
**to_be_approved** | [**\Learnist\Tripletex\Model\PaymentDTO[]**](PaymentDTO.md) | List of payments that will be sent to AutoPay approval | [optional]
**not_approved** | [**\Learnist\Tripletex\Model\PaymentDTO[]**](PaymentDTO.md) | List of payments that won&#39;t be sent to AutoPay approval | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
