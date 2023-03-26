# Employee

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**first_name** | **string** |  | 
**last_name** | **string** |  | 
**display_name** | **string** |  | [optional] 
**employee_number** | **string** |  | [optional] 
**date_of_birth** | **string** |  | [optional] 
**email** | **string** |  | [optional] 
**phone_number_mobile_country** | [**\Learnist\Tripletex\Model\Country**](Country.md) |  | [optional] 
**phone_number_mobile** | **string** |  | [optional] 
**phone_number_home** | **string** |  | [optional] 
**phone_number_work** | **string** |  | [optional] 
**national_identity_number** | **string** |  | [optional] 
**dnumber** | **string** |  | [optional] 
**international_id** | [**\Learnist\Tripletex\Model\InternationalId**](InternationalId.md) |  | [optional] 
**bank_account_number** | **string** |  | [optional] 
**iban** | **string** | IBAN field | [optional] 
**bic** | **string** | Bic (swift) field | [optional] 
**creditor_bank_country_id** | **int** | Country of creditor bank field | [optional] 
**uses_abroad_payment** | **bool** | UsesAbroadPayment field. Determines if we should use domestic or abroad remittance. To be able to use abroad remittance, one has to: 1: have Autopay 2: have valid combination of the fields Iban, Bic (swift) and Country of creditor bank. | [optional] 
**user_type** | **string** | Define the employee&#x27;s user type.&lt;br&gt;STANDARD: Reduced access. Users with limited system entitlements.&lt;br&gt;EXTENDED: Users can be given all system entitlements.&lt;br&gt;NO_ACCESS: User with no log on access.&lt;br&gt;Users with access to Tripletex must confirm the email address. | [optional] 
**allow_information_registration** | **bool** | Determines if salary information can be registered on the user including hours, travel expenses and employee expenses. The user may also be selected as a project member on projects. | [optional] 
**is_contact** | **bool** |  | [optional] 
**comments** | **string** |  | [optional] 
**address** | [**\Learnist\Tripletex\Model\Address**](Address.md) |  | [optional] 
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional] 
**employments** | [**\Learnist\Tripletex\Model\Employment[]**](Employment.md) | Employments tied to the employee | [optional] 
**holiday_allowance_earned** | [**\Learnist\Tripletex\Model\HolidayAllowanceEarned**](HolidayAllowanceEarned.md) |  | [optional] 
**employee_category** | [**\Learnist\Tripletex\Model\EmployeeCategory**](EmployeeCategory.md) |  | [optional] 
**is_auth_project_overview_url** | **bool** |  | [optional] 
**picture_id** | **int** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

