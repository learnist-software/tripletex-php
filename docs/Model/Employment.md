# # Employment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**employment_id** | **string** | Existing employment ID used by the current accounting system | [optional]
**start_date** | **string** |  |
**end_date** | **string** |  | [optional]
**employment_end_reason** | **string** | Define the employment end reason. | [optional]
**division** | [**\Learnist\Tripletex\Model\Division**](Division.md) |  | [optional]
**last_salary_change_date** | **string** |  | [optional]
**no_employment_relationship** | **bool** | Activate pensions and other benefits with no employment relationship. | [optional]
**is_main_employer** | **bool** | Determines if company is main employer for the employee. Default value is true.&lt;br /&gt;Some values will be default set if not sent upon creation of employment: &lt;br/&gt; If isMainEmployer is NOT sent and tax deduction code loennFraHovedarbeidsgiver is sent, isMainEmployer will be set to true. &lt;br /&gt; If isMainEmployer is NOT sent and tax deduction code loennFraBiarbeidsgiver is sent, isMainEmployer will be set to false. &lt;br /&gt; If true and deduction code is NOT sent, value of tax deduction code will be set to loennFraHovedarbeidsgiver. &lt;br /&gt; If false and deduction code is NOT sent, value of tax deduction code will be set to loennFraBiarbeidsgiver. &lt;br /&gt; For other types of Tax Deduction Codes, isMainEmployer does not influence anything. | [optional]
**tax_deduction_code** | **string** | EMPTY - represents that a tax deduction code is not set on the employment. It is illegal to set the field to this value.  &lt;br /&gt; Default value of this field is loennFraHovedarbeidsgiver or loennFraBiarbeidsgiver depending on boolean isMainEmployer | [optional]
**employment_details** | [**\Learnist\Tripletex\Model\EmploymentDetails[]**](EmploymentDetails.md) | Employment types tied to the employment | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
