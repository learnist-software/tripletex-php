# Order

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**customer** | [**\Learnist\Tripletex\Model\Customer**](Customer.md) |  | 
**contact** | [**\Learnist\Tripletex\Model\Contact**](Contact.md) |  | [optional] 
**attn** | [**\Learnist\Tripletex\Model\Contact**](Contact.md) |  | [optional] 
**display_name** | **string** |  | [optional] 
**receiver_email** | **string** |  | [optional] 
**overdue_notice_email** | **string** |  | [optional] 
**number** | **string** |  | [optional] 
**reference** | **string** |  | [optional] 
**our_contact** | [**\Learnist\Tripletex\Model\Contact**](Contact.md) |  | [optional] 
**our_contact_employee** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional] 
**order_date** | **string** |  | 
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional] 
**invoice_comment** | **string** | Comment to be displayed in the invoice based on this order. Can be also found in Invoice.invoiceComment on Invoice objects. | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**invoices_due_in** | **int** | Number of days/months in which invoices created from this order is due | [optional] 
**invoices_due_in_type** | **string** | Set the time unit of invoicesDueIn. The special case RECURRING_DAY_OF_MONTH enables the due date to be fixed to a specific day of the month, in this case the fixed due date will automatically be set as standard on all invoices created from this order. Note that when RECURRING_DAY_OF_MONTH is set, the due date will be set to the last day of month if \&quot;31\&quot; is set in invoicesDueIn. | [optional] 
**is_show_open_posts_on_invoices** | **bool** | Show account statement - open posts on invoices created from this order | [optional] 
**is_closed** | **bool** | Denotes if this order is closed. A closed order can no longer be invoiced unless it is opened again. | [optional] 
**delivery_date** | **string** |  | 
**delivery_address** | [**\Learnist\Tripletex\Model\DeliveryAddress**](DeliveryAddress.md) |  | [optional] 
**delivery_comment** | **string** |  | [optional] 
**is_prioritize_amounts_including_vat** | **bool** |  | [optional] 
**order_line_sorting** | **string** |  | [optional] 
**order_lines** | [**\Learnist\Tripletex\Model\OrderLine[]**](OrderLine.md) | Order lines tied to the order. New OrderLines may be embedded here, in some endpoints. | [optional] 
**is_subscription** | **bool** | If true, the order is a subscription, which enables periodical invoicing of order lines. First, create an order with isSubscription&#x3D;true, then approve it for subscription invoicing with the :approveSubscriptionInvoice method. | [optional] 
**subscription_duration** | **int** | Number of months/years the subscription shall run | [optional] 
**subscription_duration_type** | **string** | The time unit of subscriptionDuration | [optional] 
**subscription_periods_on_invoice** | **int** | Number of periods on each invoice | [optional] 
**subscription_periods_on_invoice_type** | **string** | The time unit of subscriptionPeriodsOnInvoice | [optional] 
**subscription_invoicing_time_in_advance_or_arrears** | **string** | Invoicing in advance/in arrears | [optional] 
**subscription_invoicing_time** | **int** | Number of days/months invoicing in advance/in arrears | [optional] 
**subscription_invoicing_time_type** | **string** | The time unit of subscriptionInvoicingTime | [optional] 
**is_subscription_auto_invoicing** | **bool** | Automatic invoicing. Starts when the subscription is approved | [optional] 
**preliminary_invoice** | [**\Learnist\Tripletex\Model\Invoice**](Invoice.md) |  | [optional] 
**attachment** | [**\Learnist\Tripletex\Model\Document[]**](Document.md) | [BETA] Attachments belonging to this order | [optional] 
**send_method_description** | **string** | Description of how this invoice will be sent | [optional] 
**can_create_backorder** | **bool** |  | [optional] 
**invoice_on_account_vat_high** | **bool** | Is the on account(a konto) amounts including vat | [optional] 
**total_invoiced_on_account_amount_absolute_currency** | **float** | Amount paid on account(a konto) | [optional] 
**invoice_send_sms_notification** | **bool** | Is sms-notification on/off | [optional] 
**invoice_sms_notification_number** | **string** | The phone number of the receiver of sms notifications | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

