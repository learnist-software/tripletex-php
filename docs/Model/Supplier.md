# Supplier

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**name** | **string** |  | 
**organization_number** | **string** |  | [optional] 
**supplier_number** | **int** |  | [optional] 
**customer_number** | **int** |  | [optional] 
**is_supplier** | **bool** |  | [optional] 
**is_customer** | **bool** | Determine if the supplier is also a customer | [optional] 
**is_inactive** | **bool** |  | [optional] 
**email** | **string** |  | [optional] 
**bank_accounts** | **string[]** | [DEPRECATED] List of the bank account numbers for this supplier.  Norwegian bank account numbers only. | [optional] 
**invoice_email** | **string** |  | [optional] 
**overdue_notice_email** | **string** | The email address of the customer where the noticing emails are sent in case of an overdue | [optional] 
**phone_number** | **string** |  | [optional] 
**phone_number_mobile** | **string** |  | [optional] 
**description** | **string** |  | [optional] 
**is_private_individual** | **bool** |  | [optional] 
**show_products** | **bool** |  | [optional] 
**account_manager** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**postal_address** | [**\Learnist\Tripletex\Model\Address**](Address.md) |  | [optional] 
**physical_address** | [**\Learnist\Tripletex\Model\Address**](Address.md) |  | [optional] 
**delivery_address** | [**\Learnist\Tripletex\Model\DeliveryAddress**](DeliveryAddress.md) |  | [optional] 
**category1** | [**\Learnist\Tripletex\Model\CustomerCategory**](CustomerCategory.md) |  | [optional] 
**category2** | [**\Learnist\Tripletex\Model\CustomerCategory**](CustomerCategory.md) |  | [optional] 
**category3** | [**\Learnist\Tripletex\Model\CustomerCategory**](CustomerCategory.md) |  | [optional] 
**bank_account_presentation** | [**\Learnist\Tripletex\Model\CompanyBankAccountPresentation[]**](CompanyBankAccountPresentation.md) | List of bankAccount for this supplier | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**ledger_account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  | [optional] 
**is_wholesaler** | **bool** |  | [optional] 
**display_name** | **string** |  | [optional] 
**locale** | **string** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

