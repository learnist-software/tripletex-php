# Account

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**number** | **int** |  | 
**name** | **string** |  | 
**description** | **string** |  | [optional] 
**type** | **string** |  | [optional] 
**legal_vat_types** | [**\Learnist\Tripletex\Model\VatType[]**](VatType.md) | List of legal vat types for this account. | [optional] 
**ledger_type** | **string** | Supported ledger types, default is GENERAL. Only available for customers with the module multiple ledgers. | [optional] 
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional] 
**vat_locked** | **bool** | True if all entries on this account must have the vat type given by vatType. | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**is_closeable** | **bool** | True if it should be possible to close entries on this account and it is possible to filter on open entries. | [optional] 
**is_applicable_for_supplier_invoice** | **bool** | True if this account is applicable for supplier invoice registration. | [optional] 
**require_reconciliation** | **bool** | True if this account must be reconciled before the accounting period closure. | [optional] 
**is_inactive** | **bool** | Inactive accounts will not show up in UI lists. | [optional] 
**is_bank_account** | **bool** |  | [optional] 
**is_invoice_account** | **bool** |  | [optional] 
**bank_account_number** | **string** |  | [optional] 
**bank_account_country** | [**\Learnist\Tripletex\Model\Country**](Country.md) |  | [optional] 
**bank_name** | **string** |  | [optional] 
**bank_account_iban** | **string** |  | [optional] 
**bank_account_swift** | **string** |  | [optional] 
**saft_code** | **string** | SAF-T code for account. It will be given a default value based on account number if empty. | [optional] 
**display_name** | **string** |  | [optional] 
**requires_department** | **bool** | Posting against this account requires department. | [optional] 
**requires_project** | **bool** | Posting against this account requires project. | [optional] 
**invoicing_department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

