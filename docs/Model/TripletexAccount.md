# TripletexAccount

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**company** | [**\Learnist\Tripletex\Model\Company**](Company.md) |  | [optional] 
**administrator** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**account_type** | **string** | Is this a test account or a paying account? | 
**modules** | [**\Learnist\Tripletex\Model\SalesModuleDTO[]**](SalesModuleDTO.md) | Sales modules (functionality in the application) to activate for the newly created account. Some modules have extra costs. | 
**administrator_password** | **string** | Password for the administrator user to create. Not a part of the administrator employee object since this is a value that never can be read (it is salted and hashed before storing) | [optional] 
**send_emails** | **bool** | Should the regular creation emails be sent to the company created and its users? If false you probably want to set autoValidateUserLogin to true | [optional] 
**auto_validate_user_login** | **bool** | If true, the users created will be allowed to log in without validating their email address. ONLY USE THIS IF YOU ALREADY HAVE VALIDATED THE USER EMAILS. | [optional] 
**create_administrator_api_token** | **bool** | Create an API token for the administrator user for the consumer token used during this call. The token will be returned in the response. | [optional] 
**create_company_owned_api_token** | **bool** | Create an API token for the company to use to call their clients, only possible for accounting and auditor accounts. The token will be returned in the response. | [optional] 
**may_create_tripletex_accounts** | **bool** | Should the company we are creating be able to create new Tripletex accounts? | [optional] 
**number_of_vouchers** | **string** | Used to calculate prices. | [optional] 
**chart_of_accounts_type** | **string** | The chart of accounts to use for the new company | [optional] 
**vat_status_type** | **string** | VAT type | [optional] 
**bank_account** | **string** | Main bank account | [optional] 
**post_account** | **string** | Swedish post account number (PlusGirot) | [optional] 
**number_of_prepaid_users** | **int** | Number of users Prepaid. Only available for some consumers. | [optional] 
**customer_category_id2** | **int** | Customer category id used to indicate that the customer is created by Salesforce | [optional] 
**marketing_consent** | **string** | Marketing consent | [optional] 
**invoice_start_date** | **string** | Start date for invoicing | [optional] 
**invoice_email** | **string** | Email address used for invoices/reminders | [optional] 
**customer_card_id** | **int** | Customer card id is used to indicate what customer account to use when creating the TripletexCompany object. 0 means customer account does not already exist. | [optional] 
**signed_tc** | **string** | Terms and conditions | [optional] 
**auditor** | **bool** |  | [optional] 
**reseller** | **bool** |  | [optional] 
**accounting_office** | **bool** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

