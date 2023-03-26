# MileageAllowance

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**travel_expense** | [**\Learnist\Tripletex\Model\TravelExpense**](TravelExpense.md) |  | [optional] 
**rate_type** | [**\Learnist\Tripletex\Model\TravelExpenseRate**](TravelExpenseRate.md) |  | [optional] 
**rate_category** | [**\Learnist\Tripletex\Model\TravelExpenseRateCategory**](TravelExpenseRateCategory.md) |  | [optional] 
**date** | **string** |  | 
**departure_location** | **string** |  | 
**destination** | **string** |  | 
**km** | **float** |  | [optional] 
**rate** | **float** |  | [optional] 
**amount** | **float** |  | [optional] 
**is_company_car** | **bool** |  | [optional] 
**vehicle_type** | **int** | The corresponded number for the vehicleType. Default value &#x3D; 0. | [optional] 
**passengers** | [**\Learnist\Tripletex\Model\Passenger[]**](Passenger.md) | Link to individual passengers. | [optional] 
**passenger_supplement** | [**\Learnist\Tripletex\Model\MileageAllowance**](MileageAllowance.md) |  | [optional] 
**trailer_supplement** | [**\Learnist\Tripletex\Model\MileageAllowance**](MileageAllowance.md) |  | [optional] 
**toll_cost** | [**\Learnist\Tripletex\Model\Cost**](Cost.md) |  | [optional] 
**driving_stops** | [**\Learnist\Tripletex\Model\DrivingStop[]**](DrivingStop.md) | Link to individual mileage stops. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

