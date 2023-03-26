# # AdvancedPaymentWidget

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**payment_types** | [**\Learnist\Tripletex\Model\PaymentWidgetPaymentType[]**](PaymentWidgetPaymentType.md) | List of payment types used in this Advanced Payment Widget | [optional]
**selected_payment_type** | [**\Learnist\Tripletex\Model\PaymentWidgetPaymentType**](PaymentWidgetPaymentType.md) |  | [optional]
**is_auto_pay** | **bool** | Flag for an AutoPay payment | [optional]
**is_ztl** | **bool** | Flag for a ZTL payment | [optional]
**is_foreign_payment** | **bool** | Flag for an AutoPay foreign payment | [optional]
**creditor_bank_identificator** | **int** | AutoPay&#39;s SWIFT or bank code type for an abroad payment | [optional]
**creditor_name** | **string** | AutoPay&#39;s creditor name for an abroad payment | [optional]
**creditor_address** | **string** | AutoPay&#39;s creditor address for an abroad payment | [optional]
**creditor_postal_code** | **string** | AutoPay&#39;s creditor postal code for an abroad payment | [optional]
**creditor_postal_city** | **string** | AutoPay&#39;s creditor postal city for an abroad payment | [optional]
**creditor_country_id** | **int** | AutoPay&#39;s creditor country id for an abroad payment | [optional]
**creditor_bank_country_id** | **int** | AutoPay&#39;s creditor bank country id for an abroad bank code payment | [optional]
**creditor_bank_name** | **string** | AutoPay&#39;s creditor bank name for an abroad bank code payment | [optional]
**creditor_bank_address** | **string** | AutoPay&#39;s creditor bank address for an abroad bank code payment | [optional]
**creditor_bank_postal_code** | **string** | AutoPay&#39;s creditor bank postal code for an abroad bank code payment | [optional]
**creditor_bank_postal_city** | **string** | AutoPay&#39;s creditor bank postal city for an abroad bank code payment | [optional]
**creditor_bank_code** | **string** | AutoPay&#39;s creditor bank code for an abroad bank code payment | [optional]
**creditor_bic** | **string** | AutoPay&#39;s SWIFT code for an abroad payment | [optional]
**account_number** | **string** | Payment type&#39;s account number | [optional]
**customer_vendor_iban_or_bban** | **string[]** | Account numbers for this vendor | [optional]
**creditor_clearing_code** | **string** | AutoPay&#39;s creditor bank code | [optional]
**is_creditor_address_only** | **bool** | Flag for the creditor address | [optional]
**kid** | **string** | Kid or receiver&#39;s reference value | [optional]
**amount** | **object** |  | [optional]
**opposite_amount** | **object** |  | [optional]
**date** | **string** | Payment&#39;s date value | [optional]
**regulatory_reporting_code** | **string** | AutoPay&#39;s regulatory reporting code | [optional]
**regulatory_reporting_info** | **string** | AutoPay&#39;s regulatory reporting info | [optional]
**currency_code** | **string** | Invoice currency code or default | [optional]
**currency_id** | **int** | Invoice currency id or default | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
