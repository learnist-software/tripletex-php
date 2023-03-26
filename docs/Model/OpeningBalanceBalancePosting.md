# # OpeningBalanceBalancePosting

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  |
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional]
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**amount** | **float** |  |
**amount_currency** | **float** | Only relevant for accounts in a different currency than the company currency, e.g an EUR account in a Norwegian company.  If provided on other accounts, it must always equal &#39;amount&#39; | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
