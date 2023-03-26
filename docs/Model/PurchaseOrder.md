# PurchaseOrder

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**number** | **string** | Purchase order number | [optional] 
**receiver_email** | **string** | Email when purchase order is send by email. | [optional] 
**discount** | **float** | Discount Percentage | [optional] 
**internal_comment** | **string** |  | [optional] 
**packing_note_message** | **string** | Message on packing note.Wholesaler specific. | [optional] 
**transporter_message** | **string** | Message to transporter.Wholesaler specific. | [optional] 
**comments** | **string** | Delivery information and invoice comments | [optional] 
**supplier** | [**\Learnist\Tripletex\Model\Supplier**](Supplier.md) |  | 
**delivery_date** | **string** |  | 
**received_date** | **string** |  | [optional] 
**order_lines** | [**\Learnist\Tripletex\Model\PurchaseOrderline[]**](PurchaseOrderline.md) | Order lines tied to the purchase order | [optional] 
**project** | [**\Learnist\Tripletex\Model\Project**](Project.md) |  | [optional] 
**department** | [**\Learnist\Tripletex\Model\Department**](Department.md) |  | [optional] 
**delivery_address** | [**\Learnist\Tripletex\Model\Address**](Address.md) |  | [optional] 
**creation_date** | **string** |  | [optional] 
**is_closed** | **bool** |  | [optional] 
**our_contact** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | 
**supplier_contact** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**attention** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional] 
**status** | **string** |  | [optional] 
**currency** | [**\Learnist\Tripletex\Model\Currency**](Currency.md) |  | [optional] 
**restorder** | [**\Learnist\Tripletex\Model\PurchaseOrder**](PurchaseOrder.md) |  | [optional] 
**transport_type** | [**\Learnist\Tripletex\Model\TransportType**](TransportType.md) |  | [optional] 
**pickup_point** | [**\Learnist\Tripletex\Model\PickupPoint**](PickupPoint.md) |  | [optional] 
**document** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional] 
**attachment** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional] 
**edi_document** | [**\Learnist\Tripletex\Model\Document**](Document.md) |  | [optional] 
**last_sent_timestamp** | **string** |  | [optional] 
**last_sent_employee_name** | **string** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

