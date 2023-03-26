# SaftImportSAFTBody

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**saft_file** | **string** | The SAF-T file (XML) | 
**mapping_file** | **string** | Mapping of chart of accounts (Excel). See https://tripletex.no/resources/examples/saft_account_mapping.xls | 
**import_customer_vendors** | **bool** | Create customers and suppliers | 
**create_missing_accounts** | **bool** | Create new accounts | 
**import_start_balance_from_opening** | **bool** | Create an opening balance from the import file&#x27;s starting balance. | 
**import_start_balance_from_closing** | **bool** | Create an opening balance from the import file&#x27;s outgoing balance. | 
**import_vouchers** | **bool** | Create vouchers | 
**import_departments** | **bool** | Create departments | 
**import_projects** | **bool** | Create projects | 
**tripletex_generates_customer_numbers** | **bool** | Let Tripletex create customer and supplier numbers and ignore the numbers in the import file. | 
**create_customer_ib** | **bool** | Create an opening balance on accounts receivable from customers | 
**update_account_names** | **bool** | Overwrite existing names on accounts | 
**create_vendor_ib** | **bool** | Create an opening balance on accounts payable | 
**override_voucher_date_on_discrepancy** | **bool** | Overwrite transaction date on period discrepancies. | 
**overwrite_customers_contacts** | **bool** | Overwrite existing customers/contacts | 
**only_active_customers** | **bool** | Only active customers | 
**only_active_accounts** | **bool** | Only active accounts | 
**update_start_balance** | **bool** | Update the opening balance of main ledger accounts from the import file by import before the opening balance. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

