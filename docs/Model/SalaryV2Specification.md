# # SalaryV2Specification

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**specification_type** | **string** | Type of specification; only TYPE_MANUAL are user create- and editable | [optional]
**rate** | **float** |  | [optional]
**count** | **float** |  | [optional]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional]
**salary_type** | [**\Learnist\Tripletex\Model\SalaryV2Type**](SalaryV2Type.md) |  | [optional]
**salary_payment** | [**\Learnist\Tripletex\Model\SalaryV2Payment**](SalaryV2Payment.md) |  | [optional]
**employee** | [**\Learnist\Tripletex\Model\SalaryV2Employee**](SalaryV2Employee.md) |  | [optional]
**description** | **string** |  | [optional]
**date** | **string** | date | [optional]
**year** | **int** |  | [optional]
**month** | **int** |  | [optional]
**amount** | **float** |  | [optional]
**payment_amount** | **float** |  | [optional]
**supplement** | [**\Learnist\Tripletex\Model\SalaryV2Supplement**](SalaryV2Supplement.md) |  | [optional]
**external_changes_since_last_time** | **bool** |  | [optional]
**cost_carrier_editable** | **bool** |  | [optional]
**count_and_rate_editable** | **bool** |  | [optional]
**salary_type_editable** | **bool** |  | [optional]
**template_increment** | **bool** |  | [optional]
**ref_year** | **int** |  | [optional]
**free_car_spec** | **bool** |  | [optional]
**union_spec** | **bool** |  | [optional]
**validations** | [**\Learnist\Tripletex\Model\ApiValidationMessage[]**](ApiValidationMessage.md) |  | [optional] [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
