# # HistoricalPosting

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**voucher** | [**\Learnist\Tripletex\Model\Voucher**](Voucher.md) |  | [optional]
**date** | **string** | The posting date. |
**description** | **string** | The description of the posting. | [optional]
**account** | [**\Learnist\Tripletex\Model\Account**](Account.md) |  |
**customer** | [**\Learnist\Tripletex\Model\Customer**](Customer.md) |  | [optional]
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  | [optional]
**employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional]
**product** | [**\Learnist\Tripletex\Model\Product**](Product.md) |  | [optional]
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional]
**vat_type** | [**\Learnist\Tripletex\Model\VatType**](VatType.md) |  | [optional]
**amount** | **float** | The posting amount in company currency. Important: The amounts in this amount field must have sum &#x3D; 0 on all the dates. If multiple postings with different dates, then the sum must be 0 on each of the dates. |
**amount_currency** | **float** | The posting amount in posting currency. |
**amount_gross** | **float** | The posting gross amount in company currency. |
**amount_gross_currency** | **float** | The posting gross amount in posting currency. |
**amount_vat** | **float** | The amount of vat on this posting in company currency (NOK). |
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  |
**invoice_number** | **string** | Invoice number. | [optional]
**term_of_payment** | **string** | Due date. | [optional]
**close_group** | **string** | Optional. Used to create a close group for postings. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
