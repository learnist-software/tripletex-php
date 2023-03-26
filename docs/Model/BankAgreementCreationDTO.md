# BankAgreementCreationDTO

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**bank_id** | **int** | Bank ID | 
**account_in_bank_id** | **string** | Customer number in bank | [optional] 
**ccm_agreement_id** | **string** | Customer Id from Bank | [optional] 
**division** | **string** | Division (DNB only) | [optional] 
**organization_number** | **string** | Organization number | [optional] 
**electronic_creation** | **bool** | Electronic agreement creation initiated. | [optional] 
**approve_in_online_banking** | **bool** | Accounting approve payments | [optional] 
**bank_accounts** | [**\Learnist\Tripletex\Model\Account[]**](Account.md) | JSON representing a list of new objects to be created. Should not have ID and version set. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

