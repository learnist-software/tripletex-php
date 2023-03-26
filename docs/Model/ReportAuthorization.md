# # ReportAuthorization

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional]
**version** | **int** |  | [optional]
**changes** | [**\Learnist\Tripletex\Model\Change[]**](Change.md) |  | [optional] [readonly]
**url** | **string** |  | [optional] [readonly]
**granter** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  | [optional]
**granter_delegator_id** | **int** | If set specifies the delegator to the granter proxy employee. | [optional]
**subject** | [**\Learnist\Tripletex\Model\Employee**](Employee.md) |  |
**subject_delegator_id** | **int** | If set specifies the delegator to the subject proxy employee. | [optional]
**report** | [**\Learnist\Tripletex\Model\Report**](Report.md) |  |
**status** | **string** | The status of this grant of authorization |
**permission** | **string** | The specific permission this grant of authorization is for |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
