# # ProjectOverviewAggregate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**name** | **string** |  | [optional]
**display_name** | **string** |  | [optional]
**number** | **string** |  | [optional]
**start_date** | **string** |  | [optional]
**end_date** | **string** |  | [optional]
**is_ready_for_invoicing** | **bool** |  | [optional]
**is_closed** | **bool** |  | [optional]
**is_fixed_price** | **bool** |  | [optional]
**is_internal** | **bool** |  | [optional]
**is_auth_project_overview_contract_type** | **bool** |  | [optional]
**project_manager** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**customer** | [**\Learnist\Tripletex\Model\Company**](Company.md) |  | [optional]
**main_project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional]
**project_category** | [**\Learnist\Tripletex\Model\ProjectCategory**](ProjectCategory.md) |  | [optional]
**planned_budget** | **float** |  | [optional]
**completed_budget** | **float** |  | [optional]
**access_type** | **string** | READ/WRITE access on project | [optional]
**invoice_reserve_total_amount_currency** | **float** |  | [optional]
**invoice_akonto_reserve_amount_currency** | **float** |  | [optional]
**invoice_extracosts_reserve_currency** | **float** |  | [optional]
**invoice_fee_reserve_currency** | **float** |  | [optional]
**hours_to_approve** | **float** |  | [optional]
**invoices_to_approve** | **float** |  | [optional]
**expenses_to_approve** | **float** |  | [optional]
**vouchers_to_approve** | **float** |  | [optional]
**is_project_attestor** | **bool** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
