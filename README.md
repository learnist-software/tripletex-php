# SwaggerClient-php
## Usage  - **Download the spec** [swagger.json](/v2/swagger.json) file, it is a [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification).  - **Generating a client** can easily be done using tools like [swagger-codegen](https://github.com/swagger-api/swagger-codegen) or other that accepts [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) specs.     - For swagger codegen it is recommended to use the flag: **--removeOperationIdPrefix**.        Unique operation ids are about to be introduced to the spec, and this ensures forward compatibility - and results in less verbose generated code.   ## Overview  - Partial resource updating is done using the `PUT` method with optional fields instead of the `PATCH` method.  - **Actions** or **commands** are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  - **Summaries** or **aggregated** results are represented in our RESTful path with a prefixed `>`. Example: `/v2/hours/>thisWeeksBillables`.  - **Request ID** is a key found in all responses in the header with the name `x-tlx-request-id`. For validation and error responses it is also in the response body. If additional log information is absolutely necessary, our support division can locate the key value.  - **version** This is a revision number found on all persisted resources. If included, it will prevent your PUT/POST from overriding any updates to the resource since your GET.  - **Date** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DD`.  - **DateTime** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DDThh:mm:ss`.  - **Searching** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  - **Missing fields** or even **no response data** can occur because result objects and fields are filtered on authorization.  - **See [GitHub](https://github.com/Tripletex/tripletex-api2) for more documentation, examples, changelog and more.**  - **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for additional information.**   ## Authentication  - **Tokens:** The Tripletex API uses 3 different tokens    - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.    - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=1505&languageId=0)    - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header.  - **Authentication** is done via [Basic access authentication](https://en.wikipedia.org/wiki/Basic_access_authentication)    - **username** is used to specify what company to access.      - `0` or blank means the company of the employee.      - Any other value means accountant clients. Use `/company/>withLoginAccess` to get a list of those.    - **password** is the **sessionToken**.    - If you need to create the header yourself use `Authorization: Basic <encoded token>` where `encoded token` is the string `<target company id or 0>:<your session token>` Base64 encoded.   ## Tags  - `[BETA]` This is a beta endpoint and can be subject to change. - `[DEPRECATED]` Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.   ## Fields  Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements, done via `<field>(<subResourceFields>)`. `*` means all fields for that resource. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All resources and some subResources :  `*,activity(name),employee(*)`.   ## Sorting  Use the `sorting` parameter to specify sorting. It takes a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `<field>.<subObjectField>`. Example values: - `date` - `project.name` - `project.name, -date`   ## Changes  To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  **NOTE** > For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).   ## Rate limiting  Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope  #### Multiple values  ```json {   \"fullResultSize\": ###, // {number} [DEPRECATED]   \"from\": ###, // {number} Paging starting from   \"count\": ###, // {number} Paging count   \"versionDigest\": \"###\", // {string} Hash of full result, null if no result   \"values\": [...{...object...},{...object...},{...object...}...] } ```  #### Single value  ```json {   \"value\": {...single object...} } ```   ## WebHook envelope  ```json {   \"subscriptionId\": ###, // Subscription id   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Id of object this event is for   \"value\": {... single object, null if object.deleted ...} } ```   ## Error/warning envelope  ```json {   \"status\": ###, // {number} HTTP status code   \"code\": #####, // {number} internal status code of event   \"message\": \"###\", // {string} Basic feedback message in your language   \"link\": \"###\", // {string} Link to doc   \"developerMessage\": \"###\", // {string} More technical message   \"validationMessages\": [ // {array} List of validation messages, can be null     {       \"field\": \"###\", // {string} Name of field       \"message\": \"###\" // {string} Validation message for field     }   ],   \"requestId\": \"###\" // {string} Same as x-tlx-request-id  } ```   ## Status codes / Error codes  - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   -  **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000** Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception - **403 Forbidden** - When AuthorisationManager says no.   -  **9000** Security Exception - **404 Not Found** - For resources that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000** Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** - Unexpected condition was encountered and no more specific message is suitable   - **1000** Exception

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 2.70.19
- Package version: 1.0.0
- Build package: io.swagger.codegen.v3.generators.php.PhpClientCodegen
For more information, please visit [https://github.com/Tripletex/tripletex-api2](https://github.com/Tripletex/tripletex-api2)

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/learnist-software/tripletex-php.git"
    }
  ],
  "require": {
    "learnist-software/tripletex-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/SwaggerClient-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: tokenAuthScheme
$config = Learnist\Tripletex\Configuration::getDefaultConfiguration()
    ->setUsername('YOUR_USERNAME')
    ->setPassword('YOUR_PASSWORD');

$apiInstance = new Learnist\Tripletex\Api\AccountantClientAccessApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$customer_ids = "customer_ids_example"; // string | List of IDs
$employee_ids = "employee_ids_example"; // string | List of IDs
$fields = "fields_example"; // string | Fields filter pattern

try {
    $result = $apiInstance->getRequiresLevel4Authorization($customer_ids, $employee_ids, $fields);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountantClientAccessApi->getRequiresLevel4Authorization: ', $e->getMessage(), PHP_EOL;
}
?>
```

## Documentation for API Endpoints

All URIs are relative to *https://tripletex.no/v2*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountantClientAccessApi* | [**getRequiresLevel4Authorization**](docs/Api/AccountantClientAccessApi.md#getrequireslevel4authorization) | **GET** /accountantClientAccess/requiresLevel4Authorization | Check if any of the employee ids requires level 4 authorizations to make changes
*ActivityApi* | [**get**](docs/Api/ActivityApi.md#get) | **GET** /activity/{id} | Find activity by ID.
*ActivityApi* | [**getForTimeSheet**](docs/Api/ActivityApi.md#getfortimesheet) | **GET** /activity/&gt;forTimeSheet | Find applicable time sheet activities for an employee on a specific day.
*ActivityApi* | [**post**](docs/Api/ActivityApi.md#post) | **POST** /activity | Add activity.
*ActivityApi* | [**postList**](docs/Api/ActivityApi.md#postlist) | **POST** /activity/list | Add multiple activities.
*ActivityApi* | [**search**](docs/Api/ActivityApi.md#search) | **GET** /activity | Find activities corresponding with sent data.
*AssetApi* | [**canDelete**](docs/Api/AssetApi.md#candelete) | **GET** /asset/canDelete/{id} | Validate delete asset
*AssetApi* | [**delete**](docs/Api/AssetApi.md#delete) | **DELETE** /asset/{id} | Delete asset.
*AssetApi* | [**get**](docs/Api/AssetApi.md#get) | **GET** /asset/{id} | Get asset by ID.
*AssetApi* | [**post**](docs/Api/AssetApi.md#post) | **POST** /asset | Create one asset.
*AssetApi* | [**postDuplicate**](docs/Api/AssetApi.md#postduplicate) | **POST** /asset/duplicate/{id} | Create copy of one asset
*AssetApi* | [**postList**](docs/Api/AssetApi.md#postlist) | **POST** /asset/list | Create several assets.
*AssetApi* | [**put**](docs/Api/AssetApi.md#put) | **PUT** /asset/{id} | Update asset.
*AssetApi* | [**search**](docs/Api/AssetApi.md#search) | **GET** /asset | Find assets corresponding with sent data.
*AuthinternalApi* | [**getConfig**](docs/Api/AuthinternalApi.md#getconfig) | **GET** /internal/auth/config | Get auth config
*BalanceSheetApi* | [**search**](docs/Api/BalanceSheetApi.md#search) | **GET** /balanceSheet | Get balance sheet (saldobalanse).
*BankApi* | [**get**](docs/Api/BankApi.md#get) | **GET** /bank/{id} | Get bank.
*BankApi* | [**search**](docs/Api/BankApi.md#search) | **GET** /bank | Find bank corresponding with sent data.
*BankadviceApi* | [**put**](docs/Api/BankadviceApi.md#put) | **PUT** /bank/advice/{id} | Update advice.
*BankadviceApi* | [**search**](docs/Api/BankadviceApi.md#search) | **GET** /bank/advice | Find advices for the company context
*BankreconciliationApi* | [**adjustment**](docs/Api/BankreconciliationApi.md#adjustment) | **PUT** /bank/reconciliation/{id}/:adjustment | Add an adjustment to reconciliation by ID.
*BankreconciliationApi* | [**closedWithUnmatchedTransactions**](docs/Api/BankreconciliationApi.md#closedwithunmatchedtransactions) | **GET** /bank/reconciliation/closedWithUnmatchedTransactions | Get the last closed reconciliation with unmached transactions by account ID.
*BankreconciliationApi* | [**delete**](docs/Api/BankreconciliationApi.md#delete) | **DELETE** /bank/reconciliation/{id} | Delete bank reconciliation by ID.
*BankreconciliationApi* | [**get**](docs/Api/BankreconciliationApi.md#get) | **GET** /bank/reconciliation/{id} | Get bank reconciliation.
*BankreconciliationApi* | [**last**](docs/Api/BankreconciliationApi.md#last) | **GET** /bank/reconciliation/&gt;last | Get the last created reconciliation by account ID.
*BankreconciliationApi* | [**lastClosed**](docs/Api/BankreconciliationApi.md#lastclosed) | **GET** /bank/reconciliation/&gt;lastClosed | Get last closed reconciliation by account ID.
*BankreconciliationApi* | [**post**](docs/Api/BankreconciliationApi.md#post) | **POST** /bank/reconciliation | Post a bank reconciliation.
*BankreconciliationApi* | [**put**](docs/Api/BankreconciliationApi.md#put) | **PUT** /bank/reconciliation/{id} | Update a bank reconciliation.
*BankreconciliationApi* | [**search**](docs/Api/BankreconciliationApi.md#search) | **GET** /bank/reconciliation | Find bank reconciliation corresponding with sent data.
*BankreconciliationmatchApi* | [**count**](docs/Api/BankreconciliationmatchApi.md#count) | **GET** /bank/reconciliation/match/count | Get the total number of matches
*BankreconciliationmatchApi* | [**delete**](docs/Api/BankreconciliationmatchApi.md#delete) | **DELETE** /bank/reconciliation/match/{id} | Delete a bank reconciliation match by ID.
*BankreconciliationmatchApi* | [**get**](docs/Api/BankreconciliationmatchApi.md#get) | **GET** /bank/reconciliation/match/{id} | Get bank reconciliation match by ID.
*BankreconciliationmatchApi* | [**get_0**](docs/Api/BankreconciliationmatchApi.md#get_0) | **GET** /bank/reconciliation/matches/counter | [BETA] Get number of matches since last page access.
*BankreconciliationmatchApi* | [**post**](docs/Api/BankreconciliationmatchApi.md#post) | **POST** /bank/reconciliation/match | Create a bank reconciliation match.
*BankreconciliationmatchApi* | [**post_0**](docs/Api/BankreconciliationmatchApi.md#post_0) | **POST** /bank/reconciliation/matches/counter | [BETA] Reset the number of matches after the page has been accessed.
*BankreconciliationmatchApi* | [**put**](docs/Api/BankreconciliationmatchApi.md#put) | **PUT** /bank/reconciliation/match/{id} | Update a bank reconciliation match by ID.
*BankreconciliationmatchApi* | [**query**](docs/Api/BankreconciliationmatchApi.md#query) | **GET** /bank/reconciliation/match/query | [INTERNAL] Wildcard search.
*BankreconciliationmatchApi* | [**search**](docs/Api/BankreconciliationmatchApi.md#search) | **GET** /bank/reconciliation/match | Find bank reconciliation match corresponding with sent data.
*BankreconciliationmatchApi* | [**suggest**](docs/Api/BankreconciliationmatchApi.md#suggest) | **PUT** /bank/reconciliation/match/:suggest | Suggest matches for a bank reconciliation by ID.
*BankreconciliationpaymentTypeApi* | [**get**](docs/Api/BankreconciliationpaymentTypeApi.md#get) | **GET** /bank/reconciliation/paymentType/{id} | Get payment type by ID.
*BankreconciliationpaymentTypeApi* | [**search**](docs/Api/BankreconciliationpaymentTypeApi.md#search) | **GET** /bank/reconciliation/paymentType | Find payment type corresponding with sent data.
*BankreconciliationsettingsApi* | [**get**](docs/Api/BankreconciliationsettingsApi.md#get) | **GET** /bank/reconciliation/settings | Get bank reconciliation settings.
*BankreconciliationsettingsApi* | [**post**](docs/Api/BankreconciliationsettingsApi.md#post) | **POST** /bank/reconciliation/settings | Post bank reconciliation settings.
*BankreconciliationsettingsApi* | [**put**](docs/Api/BankreconciliationsettingsApi.md#put) | **PUT** /bank/reconciliation/settings/{id} | Update bank reconciliation settings.
*BankstatementApi* | [**delete**](docs/Api/BankstatementApi.md#delete) | **DELETE** /bank/statement/{id} | Delete bank statement by ID.
*BankstatementApi* | [**get**](docs/Api/BankstatementApi.md#get) | **GET** /bank/statement/{id} | Get bank statement.
*BankstatementApi* | [**importBankStatement**](docs/Api/BankstatementApi.md#importbankstatement) | **POST** /bank/statement/import | Upload bank statement file.
*BankstatementApi* | [**search**](docs/Api/BankstatementApi.md#search) | **GET** /bank/statement | Find bank statement corresponding with sent data.
*BankstatementtransactionApi* | [**get**](docs/Api/BankstatementtransactionApi.md#get) | **GET** /bank/statement/transaction/{id} | Get bank transaction by ID.
*BankstatementtransactionApi* | [**getDetails**](docs/Api/BankstatementtransactionApi.md#getdetails) | **GET** /bank/statement/transaction/{id}/details | Get additional details about transaction by ID.
*BankstatementtransactionApi* | [**search**](docs/Api/BankstatementtransactionApi.md#search) | **GET** /bank/statement/transaction | Find bank transaction corresponding with sent data.
*CompanyApi* | [**get**](docs/Api/CompanyApi.md#get) | **GET** /company/{id} | Find company by ID.
*CompanyApi* | [**getDivisions**](docs/Api/CompanyApi.md#getdivisions) | **GET** /company/divisions | [DEPRECATED] Find divisions.
*CompanyApi* | [**getWithLoginAccess**](docs/Api/CompanyApi.md#getwithloginaccess) | **GET** /company/&gt;withLoginAccess | Returns client customers (with accountant/auditor relation) where the current user has login access (proxy login).
*CompanyApi* | [**put**](docs/Api/CompanyApi.md#put) | **PUT** /company | Update company information.
*CompanyaltinnApi* | [**put**](docs/Api/CompanyaltinnApi.md#put) | **PUT** /company/settings/altinn | Update AltInn id and password.
*CompanyaltinnApi* | [**search**](docs/Api/CompanyaltinnApi.md#search) | **GET** /company/settings/altinn | Find Altinn id for login in company.
*CompanysalesmodulesApi* | [**get**](docs/Api/CompanysalesmodulesApi.md#get) | **GET** /company/salesmodules | [BETA] Get active sales modules.
*CompanysalesmodulesApi* | [**post**](docs/Api/CompanysalesmodulesApi.md#post) | **POST** /company/salesmodules | [BETA] Add (activate) a new sales module.
*ContactApi* | [**deleteByIds**](docs/Api/ContactApi.md#deletebyids) | **DELETE** /contact/list | [BETA] Delete multiple contacts.
*ContactApi* | [**get**](docs/Api/ContactApi.md#get) | **GET** /contact/{id} | Get contact by ID.
*ContactApi* | [**post**](docs/Api/ContactApi.md#post) | **POST** /contact | Create contact.
*ContactApi* | [**put**](docs/Api/ContactApi.md#put) | **PUT** /contact/{id} | Update contact.
*ContactApi* | [**search**](docs/Api/ContactApi.md#search) | **GET** /contact | Find contacts corresponding with sent data.
*CountryApi* | [**get**](docs/Api/CountryApi.md#get) | **GET** /country/{id} | Get country by ID.
*CountryApi* | [**search**](docs/Api/CountryApi.md#search) | **GET** /country | Find countries corresponding with sent data.
*CrmprospectApi* | [**get**](docs/Api/CrmprospectApi.md#get) | **GET** /crm/prospect/{id} | Get prospect by ID.
*CrmprospectApi* | [**search**](docs/Api/CrmprospectApi.md#search) | **GET** /crm/prospect | Find prospects corresponding with sent data.
*CurrencyApi* | [**get**](docs/Api/CurrencyApi.md#get) | **GET** /currency/{id} | Get currency by ID.
*CurrencyApi* | [**getRate**](docs/Api/CurrencyApi.md#getrate) | **GET** /currency/{id}/rate | Find currency exchange rate corresponding with sent data.
*CurrencyApi* | [**search**](docs/Api/CurrencyApi.md#search) | **GET** /currency | Find currencies corresponding with sent data.
*CustomerApi* | [**delete**](docs/Api/CustomerApi.md#delete) | **DELETE** /customer/{id} | [BETA] Delete customer by ID
*CustomerApi* | [**get**](docs/Api/CustomerApi.md#get) | **GET** /customer/{id} | Get customer by ID.
*CustomerApi* | [**post**](docs/Api/CustomerApi.md#post) | **POST** /customer | Create customer. Related customer addresses may also be created.
*CustomerApi* | [**postList**](docs/Api/CustomerApi.md#postlist) | **POST** /customer/list | [BETA] Create multiple customers. Related supplier addresses may also be created.
*CustomerApi* | [**put**](docs/Api/CustomerApi.md#put) | **PUT** /customer/{id} | Update customer.
*CustomerApi* | [**putList**](docs/Api/CustomerApi.md#putlist) | **PUT** /customer/list | [BETA] Update multiple customers. Addresses can also be updated.
*CustomerApi* | [**search**](docs/Api/CustomerApi.md#search) | **GET** /customer | Find customers corresponding with sent data.
*CustomercategoryApi* | [**get**](docs/Api/CustomercategoryApi.md#get) | **GET** /customer/category/{id} | Find customer/supplier category by ID.
*CustomercategoryApi* | [**post**](docs/Api/CustomercategoryApi.md#post) | **POST** /customer/category | Add new customer/supplier category.
*CustomercategoryApi* | [**put**](docs/Api/CustomercategoryApi.md#put) | **PUT** /customer/category/{id} | Update customer/supplier category.
*CustomercategoryApi* | [**search**](docs/Api/CustomercategoryApi.md#search) | **GET** /customer/category | Find customer/supplier categories corresponding with sent data.
*DeliveryAddressApi* | [**get**](docs/Api/DeliveryAddressApi.md#get) | **GET** /deliveryAddress/{id} | Get address by ID.
*DeliveryAddressApi* | [**put**](docs/Api/DeliveryAddressApi.md#put) | **PUT** /deliveryAddress/{id} | Update address.
*DeliveryAddressApi* | [**search**](docs/Api/DeliveryAddressApi.md#search) | **GET** /deliveryAddress | Find addresses corresponding with sent data.
*DepartmentApi* | [**delete**](docs/Api/DepartmentApi.md#delete) | **DELETE** /department/{id} | Delete department by ID
*DepartmentApi* | [**get**](docs/Api/DepartmentApi.md#get) | **GET** /department/{id} | Get department by ID.
*DepartmentApi* | [**post**](docs/Api/DepartmentApi.md#post) | **POST** /department | Add new department.
*DepartmentApi* | [**postList**](docs/Api/DepartmentApi.md#postlist) | **POST** /department/list | Register new departments.
*DepartmentApi* | [**put**](docs/Api/DepartmentApi.md#put) | **PUT** /department/{id} | Update department.
*DepartmentApi* | [**putList**](docs/Api/DepartmentApi.md#putlist) | **PUT** /department/list | Update multiple departments.
*DepartmentApi* | [**query**](docs/Api/DepartmentApi.md#query) | **GET** /department/query | Wildcard search.
*DepartmentApi* | [**search**](docs/Api/DepartmentApi.md#search) | **GET** /department | Find department corresponding with sent data.
*DivisionApi* | [**post**](docs/Api/DivisionApi.md#post) | **POST** /division | Create division.
*DivisionApi* | [**postList**](docs/Api/DivisionApi.md#postlist) | **POST** /division/list | Create divisions.
*DivisionApi* | [**put**](docs/Api/DivisionApi.md#put) | **PUT** /division/{id} | Update division information.
*DivisionApi* | [**putList**](docs/Api/DivisionApi.md#putlist) | **PUT** /division/list | Update multiple divisions.
*DivisionApi* | [**search**](docs/Api/DivisionApi.md#search) | **GET** /division | Get divisions.
*DocumentApi* | [**downloadContent**](docs/Api/DocumentApi.md#downloadcontent) | **GET** /document/{id}/content | [BETA] Get content of document given by ID.
*DocumentApi* | [**get**](docs/Api/DocumentApi.md#get) | **GET** /document/{id} | [BETA] Get document by ID.
*DocumentArchiveApi* | [**accountPost**](docs/Api/DocumentArchiveApi.md#accountpost) | **POST** /documentArchive/account/{id} | [BETA] Upload file to Account Document Archive.
*DocumentArchiveApi* | [**customerPost**](docs/Api/DocumentArchiveApi.md#customerpost) | **POST** /documentArchive/customer/{id} | [BETA] Upload file to Customer Document Archive.
*DocumentArchiveApi* | [**delete**](docs/Api/DocumentArchiveApi.md#delete) | **DELETE** /documentArchive/{id} | [BETA] Delete document archive.
*DocumentArchiveApi* | [**employeePost**](docs/Api/DocumentArchiveApi.md#employeepost) | **POST** /documentArchive/employee/{id} | [BETA] Upload file to Employee Document Archive.
*DocumentArchiveApi* | [**getAccount**](docs/Api/DocumentArchiveApi.md#getaccount) | **GET** /documentArchive/account/{id} | [BETA] Find documents archived associated with account object type.
*DocumentArchiveApi* | [**getCustomer**](docs/Api/DocumentArchiveApi.md#getcustomer) | **GET** /documentArchive/customer/{id} | [BETA] Find documents archived associated with customer object type.
*DocumentArchiveApi* | [**getEmployee**](docs/Api/DocumentArchiveApi.md#getemployee) | **GET** /documentArchive/employee/{id} | [BETA] Find documents archived associated with employee object type.
*DocumentArchiveApi* | [**getProduct**](docs/Api/DocumentArchiveApi.md#getproduct) | **GET** /documentArchive/product/{id} | [BETA] Find documents archived associated with product object type.
*DocumentArchiveApi* | [**getProject**](docs/Api/DocumentArchiveApi.md#getproject) | **GET** /documentArchive/project/{id} | [BETA] Find documents archived associated with project object type.
*DocumentArchiveApi* | [**getProspect**](docs/Api/DocumentArchiveApi.md#getprospect) | **GET** /documentArchive/prospect/{id} | [BETA] Find documents archived associated with prospect object type.
*DocumentArchiveApi* | [**getSupplier**](docs/Api/DocumentArchiveApi.md#getsupplier) | **GET** /documentArchive/supplier/{id} | [BETA] Find documents archived associated with supplier object type.
*DocumentArchiveApi* | [**productPost**](docs/Api/DocumentArchiveApi.md#productpost) | **POST** /documentArchive/product/{id} | [BETA] Upload file to Product Document Archive.
*DocumentArchiveApi* | [**projectPost**](docs/Api/DocumentArchiveApi.md#projectpost) | **POST** /documentArchive/project/{id} | [BETA] Upload file to Project Document Archive.
*DocumentArchiveApi* | [**prospectPost**](docs/Api/DocumentArchiveApi.md#prospectpost) | **POST** /documentArchive/prospect/{id} | [BETA] Upload file to Prospect Document Archive.
*DocumentArchiveApi* | [**put**](docs/Api/DocumentArchiveApi.md#put) | **PUT** /documentArchive/{id} | [BETA] Update document archive.
*DocumentArchiveApi* | [**receptionPost**](docs/Api/DocumentArchiveApi.md#receptionpost) | **POST** /documentArchive/reception | [BETA] Upload a file to the document archive reception. Send as multipart form.
*DocumentArchiveApi* | [**supplierPost**](docs/Api/DocumentArchiveApi.md#supplierpost) | **POST** /documentArchive/supplier/{id} | [BETA] Upload file to Supplier Document Archive.
*EmployeeApi* | [**get**](docs/Api/EmployeeApi.md#get) | **GET** /employee/{id} | Get employee by ID.
*EmployeeApi* | [**post**](docs/Api/EmployeeApi.md#post) | **POST** /employee | Create one employee.
*EmployeeApi* | [**postList**](docs/Api/EmployeeApi.md#postlist) | **POST** /employee/list | Create several employees.
*EmployeeApi* | [**put**](docs/Api/EmployeeApi.md#put) | **PUT** /employee/{id} | Update employee.
*EmployeeApi* | [**search**](docs/Api/EmployeeApi.md#search) | **GET** /employee | Find employees corresponding with sent data.
*EmployeecategoryApi* | [**delete**](docs/Api/EmployeecategoryApi.md#delete) | **DELETE** /employee/category/{id} | Delete employee category by ID
*EmployeecategoryApi* | [**deleteByIds**](docs/Api/EmployeecategoryApi.md#deletebyids) | **DELETE** /employee/category/list | Delete multiple employee categories
*EmployeecategoryApi* | [**get**](docs/Api/EmployeecategoryApi.md#get) | **GET** /employee/category/{id} | Get employee category by ID.
*EmployeecategoryApi* | [**post**](docs/Api/EmployeecategoryApi.md#post) | **POST** /employee/category | Create a new employee category.
*EmployeecategoryApi* | [**postList**](docs/Api/EmployeecategoryApi.md#postlist) | **POST** /employee/category/list | Create new employee categories.
*EmployeecategoryApi* | [**put**](docs/Api/EmployeecategoryApi.md#put) | **PUT** /employee/category/{id} | Update employee category information.
*EmployeecategoryApi* | [**putList**](docs/Api/EmployeecategoryApi.md#putlist) | **PUT** /employee/category/list | Update multiple employee categories.
*EmployeecategoryApi* | [**search**](docs/Api/EmployeecategoryApi.md#search) | **GET** /employee/category | Find employee category corresponding with sent data.
*EmployeeemploymentApi* | [**get**](docs/Api/EmployeeemploymentApi.md#get) | **GET** /employee/employment/{id} | Find employment by ID.
*EmployeeemploymentApi* | [**post**](docs/Api/EmployeeemploymentApi.md#post) | **POST** /employee/employment | Create employment.
*EmployeeemploymentApi* | [**put**](docs/Api/EmployeeemploymentApi.md#put) | **PUT** /employee/employment/{id} | Update employemnt.
*EmployeeemploymentApi* | [**search**](docs/Api/EmployeeemploymentApi.md#search) | **GET** /employee/employment | Find all employments for employee.
*EmployeeemploymentdetailsApi* | [**get**](docs/Api/EmployeeemploymentdetailsApi.md#get) | **GET** /employee/employment/details/{id} | Find employment details by ID.
*EmployeeemploymentdetailsApi* | [**post**](docs/Api/EmployeeemploymentdetailsApi.md#post) | **POST** /employee/employment/details | Create employment details.
*EmployeeemploymentdetailsApi* | [**put**](docs/Api/EmployeeemploymentdetailsApi.md#put) | **PUT** /employee/employment/details/{id} | Update employment details.
*EmployeeemploymentdetailsApi* | [**search**](docs/Api/EmployeeemploymentdetailsApi.md#search) | **GET** /employee/employment/details | Find all employmentdetails for employment.
*EmployeeemploymentemploymentTypeApi* | [**getEmploymentEndReasonType**](docs/Api/EmployeeemploymentemploymentTypeApi.md#getemploymentendreasontype) | **GET** /employee/employment/employmentType/employmentEndReasonType | Find all employment end reason type IDs.
*EmployeeemploymentemploymentTypeApi* | [**getEmploymentFormType**](docs/Api/EmployeeemploymentemploymentTypeApi.md#getemploymentformtype) | **GET** /employee/employment/employmentType/employmentFormType | Find all employment form type IDs.
*EmployeeemploymentemploymentTypeApi* | [**getMaritimeEmploymentType**](docs/Api/EmployeeemploymentemploymentTypeApi.md#getmaritimeemploymenttype) | **GET** /employee/employment/employmentType/maritimeEmploymentType | Find all maritime employment type IDs.
*EmployeeemploymentemploymentTypeApi* | [**getSalaryType**](docs/Api/EmployeeemploymentemploymentTypeApi.md#getsalarytype) | **GET** /employee/employment/employmentType/salaryType | Find all salary type IDs.
*EmployeeemploymentemploymentTypeApi* | [**getScheduleType**](docs/Api/EmployeeemploymentemploymentTypeApi.md#getscheduletype) | **GET** /employee/employment/employmentType/scheduleType | Find all schedule type IDs.
*EmployeeemploymentemploymentTypeApi* | [**search**](docs/Api/EmployeeemploymentemploymentTypeApi.md#search) | **GET** /employee/employment/employmentType | Find all employment type IDs.
*EmployeeemploymentleaveOfAbsenceApi* | [**get**](docs/Api/EmployeeemploymentleaveOfAbsenceApi.md#get) | **GET** /employee/employment/leaveOfAbsence/{id} | Find leave of absence by ID.
*EmployeeemploymentleaveOfAbsenceApi* | [**post**](docs/Api/EmployeeemploymentleaveOfAbsenceApi.md#post) | **POST** /employee/employment/leaveOfAbsence | Create leave of absence.
*EmployeeemploymentleaveOfAbsenceApi* | [**postList**](docs/Api/EmployeeemploymentleaveOfAbsenceApi.md#postlist) | **POST** /employee/employment/leaveOfAbsence/list | Create multiple leave of absences.
*EmployeeemploymentleaveOfAbsenceApi* | [**put**](docs/Api/EmployeeemploymentleaveOfAbsenceApi.md#put) | **PUT** /employee/employment/leaveOfAbsence/{id} | Update leave of absence.
*EmployeeemploymentleaveOfAbsenceApi* | [**search**](docs/Api/EmployeeemploymentleaveOfAbsenceApi.md#search) | **GET** /employee/employment/leaveOfAbsence | Find all leave of absence corresponding with the sent data.
*EmployeeemploymentleaveOfAbsenceTypeApi* | [**search**](docs/Api/EmployeeemploymentleaveOfAbsenceTypeApi.md#search) | **GET** /employee/employment/leaveOfAbsenceType | Find all leave of absence type IDs.
*EmployeeemploymentoccupationCodeApi* | [**get**](docs/Api/EmployeeemploymentoccupationCodeApi.md#get) | **GET** /employee/employment/occupationCode/{id} | Get occupation by ID.
*EmployeeemploymentoccupationCodeApi* | [**search**](docs/Api/EmployeeemploymentoccupationCodeApi.md#search) | **GET** /employee/employment/occupationCode | Find all profession codes.
*EmployeeemploymentremunerationTypeApi* | [**search**](docs/Api/EmployeeemploymentremunerationTypeApi.md#search) | **GET** /employee/employment/remunerationType | Find all remuneration type IDs.
*EmployeeemploymentworkingHoursSchemeApi* | [**search**](docs/Api/EmployeeemploymentworkingHoursSchemeApi.md#search) | **GET** /employee/employment/workingHoursScheme | Find working hours scheme ID.
*EmployeeentitlementApi* | [**client**](docs/Api/EmployeeentitlementApi.md#client) | **GET** /employee/entitlement/client | [BETA] Find all entitlements at client for user.
*EmployeeentitlementApi* | [**get**](docs/Api/EmployeeentitlementApi.md#get) | **GET** /employee/entitlement/{id} | Get entitlement by ID.
*EmployeeentitlementApi* | [**grantClientEntitlementsByTemplate**](docs/Api/EmployeeentitlementApi.md#grantcliententitlementsbytemplate) | **PUT** /employee/entitlement/:grantClientEntitlementsByTemplate | [BETA] Update employee entitlements in client account.
*EmployeeentitlementApi* | [**grantEntitlementsByTemplate**](docs/Api/EmployeeentitlementApi.md#grantentitlementsbytemplate) | **PUT** /employee/entitlement/:grantEntitlementsByTemplate | [BETA] Update employee entitlements.
*EmployeeentitlementApi* | [**search**](docs/Api/EmployeeentitlementApi.md#search) | **GET** /employee/entitlement | Find all entitlements for user.
*EmployeehourlyCostAndRateApi* | [**get**](docs/Api/EmployeehourlyCostAndRateApi.md#get) | **GET** /employee/hourlyCostAndRate/{id} | Find hourly cost and rate by ID.
*EmployeehourlyCostAndRateApi* | [**post**](docs/Api/EmployeehourlyCostAndRateApi.md#post) | **POST** /employee/hourlyCostAndRate | Create hourly cost and rate.
*EmployeehourlyCostAndRateApi* | [**put**](docs/Api/EmployeehourlyCostAndRateApi.md#put) | **PUT** /employee/hourlyCostAndRate/{id} | Update hourly cost and rate.
*EmployeehourlyCostAndRateApi* | [**search**](docs/Api/EmployeehourlyCostAndRateApi.md#search) | **GET** /employee/hourlyCostAndRate | Find all hourly cost and rates for employee.
*EmployeelogininfoApi* | [**get**](docs/Api/EmployeelogininfoApi.md#get) | **GET** /employee/logininfo/{id} | [BETA] Get employee login info.
*EmployeenextOfKinApi* | [**get**](docs/Api/EmployeenextOfKinApi.md#get) | **GET** /employee/nextOfKin/{id} | Find next of kin by ID.
*EmployeenextOfKinApi* | [**post**](docs/Api/EmployeenextOfKinApi.md#post) | **POST** /employee/nextOfKin | Create next of kin.
*EmployeenextOfKinApi* | [**put**](docs/Api/EmployeenextOfKinApi.md#put) | **PUT** /employee/nextOfKin/{id} | Update next of kin.
*EmployeenextOfKinApi* | [**search**](docs/Api/EmployeenextOfKinApi.md#search) | **GET** /employee/nextOfKin | Find all next of kin for employee.
*EmployeepreferencesApi* | [**loggedInEmployeePreferences**](docs/Api/EmployeepreferencesApi.md#loggedinemployeepreferences) | **GET** /employee/preferences/&gt;loggedInEmployeePreferences | Get employee preferences for current user
*EmployeepreferencesApi* | [**put**](docs/Api/EmployeepreferencesApi.md#put) | **PUT** /employee/preferences/{id} | Update employee preferences information.
*EmployeepreferencesApi* | [**putList**](docs/Api/EmployeepreferencesApi.md#putlist) | **PUT** /employee/preferences/list | Update multiple employee preferences.
*EmployeepreferencesApi* | [**search**](docs/Api/EmployeepreferencesApi.md#search) | **GET** /employee/preferences | Find employee preferences corresponding with sent data.
*EmployeestandardTimeApi* | [**get**](docs/Api/EmployeestandardTimeApi.md#get) | **GET** /employee/standardTime/{id} | Find standard time by ID.
*EmployeestandardTimeApi* | [**getByDate**](docs/Api/EmployeestandardTimeApi.md#getbydate) | **GET** /employee/standardTime/byDate | Find standard time for employee by date.
*EmployeestandardTimeApi* | [**post**](docs/Api/EmployeestandardTimeApi.md#post) | **POST** /employee/standardTime | Create standard time.
*EmployeestandardTimeApi* | [**put**](docs/Api/EmployeestandardTimeApi.md#put) | **PUT** /employee/standardTime/{id} | Update standard time.
*EmployeestandardTimeApi* | [**search**](docs/Api/EmployeestandardTimeApi.md#search) | **GET** /employee/standardTime | Find all standard times for employee.
*EventApi* | [**example**](docs/Api/EventApi.md#example) | **GET** /event/{eventType} | [BETA] Get example webhook payload
*EventApi* | [**get**](docs/Api/EventApi.md#get) | **GET** /event | [BETA] Get all (WebHook) event keys.
*EventsubscriptionApi* | [**delete**](docs/Api/EventsubscriptionApi.md#delete) | **DELETE** /event/subscription/{id} | [BETA] Delete the given subscription.
*EventsubscriptionApi* | [**deleteByIds**](docs/Api/EventsubscriptionApi.md#deletebyids) | **DELETE** /event/subscription/list | [BETA] Delete multiple subscriptions.
*EventsubscriptionApi* | [**get**](docs/Api/EventsubscriptionApi.md#get) | **GET** /event/subscription/{id} | [BETA] Get subscription by ID.
*EventsubscriptionApi* | [**post**](docs/Api/EventsubscriptionApi.md#post) | **POST** /event/subscription | [BETA] Create a new subscription for current EmployeeToken.
*EventsubscriptionApi* | [**postList**](docs/Api/EventsubscriptionApi.md#postlist) | **POST** /event/subscription/list | [BETA] Create multiple subscriptions for current EmployeeToken.
*EventsubscriptionApi* | [**put**](docs/Api/EventsubscriptionApi.md#put) | **PUT** /event/subscription/{id} | [BETA] Change a current subscription, based on id.
*EventsubscriptionApi* | [**putList**](docs/Api/EventsubscriptionApi.md#putlist) | **PUT** /event/subscription/list | [BETA] Update multiple subscription.
*EventsubscriptionApi* | [**search**](docs/Api/EventsubscriptionApi.md#search) | **GET** /event/subscription | [BETA] Find all ongoing subscriptions.
*FavoritesinternalApi* | [**delete**](docs/Api/FavoritesinternalApi.md#delete) | **DELETE** /internal/favorites/{id} | Delete a favorite
*FavoritesinternalApi* | [**get**](docs/Api/FavoritesinternalApi.md#get) | **GET** /internal/favorites | Get favorite menu
*FavoritesinternalApi* | [**post**](docs/Api/FavoritesinternalApi.md#post) | **POST** /internal/favorites | Add new favorite
*FavoritesinternalApi* | [**put**](docs/Api/FavoritesinternalApi.md#put) | **PUT** /internal/favorites/{id} | Update a favorite
*InventoryApi* | [**delete**](docs/Api/InventoryApi.md#delete) | **DELETE** /inventory/{id} | [BETA] Delete inventory.
*InventoryApi* | [**get**](docs/Api/InventoryApi.md#get) | **GET** /inventory/{id} | Get inventory by ID.
*InventoryApi* | [**post**](docs/Api/InventoryApi.md#post) | **POST** /inventory | Create new inventory.
*InventoryApi* | [**put**](docs/Api/InventoryApi.md#put) | **PUT** /inventory/{id} | Update inventory.
*InventoryApi* | [**search**](docs/Api/InventoryApi.md#search) | **GET** /inventory | Find inventory corresponding with sent data.
*InventoryinventoriesApi* | [**search**](docs/Api/InventoryinventoriesApi.md#search) | **GET** /inventory/inventories | [BETA] Find inventories corresponding with sent data.
*InventorylocationApi* | [**delete**](docs/Api/InventorylocationApi.md#delete) | **DELETE** /inventory/location/{id} | [BETA] Delete inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**deleteByIds**](docs/Api/InventorylocationApi.md#deletebyids) | **DELETE** /inventory/location/list | [BETA] Delete inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**get**](docs/Api/InventorylocationApi.md#get) | **GET** /inventory/location/{id} | Get inventory location by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**post**](docs/Api/InventorylocationApi.md#post) | **POST** /inventory/location | [BETA] Create new inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**postList**](docs/Api/InventorylocationApi.md#postlist) | **POST** /inventory/location/list | [BETA] Add multiple inventory locations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**put**](docs/Api/InventorylocationApi.md#put) | **PUT** /inventory/location/{id} | [BETA] Update inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**putList**](docs/Api/InventorylocationApi.md#putlist) | **PUT** /inventory/location/list | [BETA] Update multiple inventory locations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorylocationApi* | [**search**](docs/Api/InventorylocationApi.md#search) | **GET** /inventory/location | [BETA] Find inventory locations by inventory ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*InventorystocktakingApi* | [**delete**](docs/Api/InventorystocktakingApi.md#delete) | **DELETE** /inventory/stocktaking/{id} | [BETA] Delete stocktaking.
*InventorystocktakingApi* | [**get**](docs/Api/InventorystocktakingApi.md#get) | **GET** /inventory/stocktaking/{id} | [BETA] Get stocktaking by ID.
*InventorystocktakingApi* | [**post**](docs/Api/InventorystocktakingApi.md#post) | **POST** /inventory/stocktaking | [BETA] Create new stocktaking.
*InventorystocktakingApi* | [**put**](docs/Api/InventorystocktakingApi.md#put) | **PUT** /inventory/stocktaking/{id} | [BETA] Update stocktaking.
*InventorystocktakingApi* | [**search**](docs/Api/InventorystocktakingApi.md#search) | **GET** /inventory/stocktaking | [BETA] Find stocktaking corresponding with sent data.
*InventorystocktakingproductlineApi* | [**delete**](docs/Api/InventorystocktakingproductlineApi.md#delete) | **DELETE** /inventory/stocktaking/productline/{id} | [BETA] Delete product line.
*InventorystocktakingproductlineApi* | [**get**](docs/Api/InventorystocktakingproductlineApi.md#get) | **GET** /inventory/stocktaking/productline/{id} | [BETA] Get product line by ID.
*InventorystocktakingproductlineApi* | [**post**](docs/Api/InventorystocktakingproductlineApi.md#post) | **POST** /inventory/stocktaking/productline | [BETA] Create product line. When creating several product lines, use /list for better performance.
*InventorystocktakingproductlineApi* | [**put**](docs/Api/InventorystocktakingproductlineApi.md#put) | **PUT** /inventory/stocktaking/productline/{id} | [BETA] Update product line.
*InventorystocktakingproductlineApi* | [**search**](docs/Api/InventorystocktakingproductlineApi.md#search) | **GET** /inventory/stocktaking/productline | [BETA] Find all product lines by stocktaking ID.
*InvoiceApi* | [**createCreditNote**](docs/Api/InvoiceApi.md#createcreditnote) | **PUT** /invoice/{id}/:createCreditNote | Creates a new Invoice representing a credit memo that nullifies the given invoice. Updates this invoice and any pre-existing inverse invoice.
*InvoiceApi* | [**createReminder**](docs/Api/InvoiceApi.md#createreminder) | **PUT** /invoice/{id}/:createReminder | Create invoice reminder and sends it by the given dispatch type. Supports the reminder types SOFT_REMINDER, REMINDER and NOTICE_OF_DEBT_COLLECTION. DispatchType NETS_PRINT must have type NOTICE_OF_DEBT_COLLECTION. SMS and NETS_PRINT must be activated prior to usage in the API.
*InvoiceApi* | [**downloadPdf**](docs/Api/InvoiceApi.md#downloadpdf) | **GET** /invoice/{invoiceId}/pdf | Get invoice document by invoice ID.
*InvoiceApi* | [**get**](docs/Api/InvoiceApi.md#get) | **GET** /invoice/{id} | Get invoice by ID.
*InvoiceApi* | [**payment**](docs/Api/InvoiceApi.md#payment) | **PUT** /invoice/{id}/:payment | Update invoice. The invoice is updated with payment information. The amount is in the invoice’s currency.
*InvoiceApi* | [**post**](docs/Api/InvoiceApi.md#post) | **POST** /invoice | Create invoice. Related Order and OrderLines can be created first, or included as new objects inside the Invoice.
*InvoiceApi* | [**postList**](docs/Api/InvoiceApi.md#postlist) | **POST** /invoice/list | [BETA] Create multiple invoices. Max 100 at a time.
*InvoiceApi* | [**search**](docs/Api/InvoiceApi.md#search) | **GET** /invoice | Find invoices corresponding with sent data. Includes charged outgoing invoices only.
*InvoiceApi* | [**send**](docs/Api/InvoiceApi.md#send) | **PUT** /invoice/{id}/:send | Send invoice by ID and sendType. Optionally override email recipient.
*InvoiceRemarkApi* | [**get**](docs/Api/InvoiceRemarkApi.md#get) | **GET** /invoiceRemark/{id} | Get invoice remark by ID.
*InvoicedetailsApi* | [**get**](docs/Api/InvoicedetailsApi.md#get) | **GET** /invoice/details/{id} | Get ProjectInvoiceDetails by ID.
*InvoicedetailsApi* | [**search**](docs/Api/InvoicedetailsApi.md#search) | **GET** /invoice/details | Find ProjectInvoiceDetails corresponding with sent data.
*InvoicepaymentTypeApi* | [**get**](docs/Api/InvoicepaymentTypeApi.md#get) | **GET** /invoice/paymentType/{id} | Get payment type by ID.
*InvoicepaymentTypeApi* | [**search**](docs/Api/InvoicepaymentTypeApi.md#search) | **GET** /invoice/paymentType | Find payment type corresponding with sent data.
*LedgerApi* | [**openPost**](docs/Api/LedgerApi.md#openpost) | **GET** /ledger/openPost | Find open posts corresponding with sent data.
*LedgerApi* | [**search**](docs/Api/LedgerApi.md#search) | **GET** /ledger | Get ledger (hovedbok).
*LedgeraccountApi* | [**delete**](docs/Api/LedgeraccountApi.md#delete) | **DELETE** /ledger/account/{id} | Delete account.
*LedgeraccountApi* | [**deleteByIds**](docs/Api/LedgeraccountApi.md#deletebyids) | **DELETE** /ledger/account/list | Delete multiple accounts.
*LedgeraccountApi* | [**get**](docs/Api/LedgeraccountApi.md#get) | **GET** /ledger/account/{id} | Get account by ID.
*LedgeraccountApi* | [**post**](docs/Api/LedgeraccountApi.md#post) | **POST** /ledger/account | Create a new account.
*LedgeraccountApi* | [**postList**](docs/Api/LedgeraccountApi.md#postlist) | **POST** /ledger/account/list | Create several accounts.
*LedgeraccountApi* | [**put**](docs/Api/LedgeraccountApi.md#put) | **PUT** /ledger/account/{id} | Update account.
*LedgeraccountApi* | [**putList**](docs/Api/LedgeraccountApi.md#putlist) | **PUT** /ledger/account/list | Update multiple accounts.
*LedgeraccountApi* | [**search**](docs/Api/LedgeraccountApi.md#search) | **GET** /ledger/account | Find accounts corresponding with sent data.
*LedgeraccountingPeriodApi* | [**get**](docs/Api/LedgeraccountingPeriodApi.md#get) | **GET** /ledger/accountingPeriod/{id} | Get accounting period by ID.
*LedgeraccountingPeriodApi* | [**search**](docs/Api/LedgeraccountingPeriodApi.md#search) | **GET** /ledger/accountingPeriod | Find accounting periods corresponding with sent data.
*LedgerannualAccountApi* | [**get**](docs/Api/LedgerannualAccountApi.md#get) | **GET** /ledger/annualAccount/{id} | Get annual account by ID.
*LedgerannualAccountApi* | [**search**](docs/Api/LedgerannualAccountApi.md#search) | **GET** /ledger/annualAccount | Find annual accounts corresponding with sent data.
*LedgercloseGroupApi* | [**get**](docs/Api/LedgercloseGroupApi.md#get) | **GET** /ledger/closeGroup/{id} | Get close group by ID.
*LedgercloseGroupApi* | [**search**](docs/Api/LedgercloseGroupApi.md#search) | **GET** /ledger/closeGroup | Find close groups corresponding with sent data.
*LedgerpaymentTypeOutApi* | [**delete**](docs/Api/LedgerpaymentTypeOutApi.md#delete) | **DELETE** /ledger/paymentTypeOut/{id} | [BETA] Delete payment type for outgoing payments by ID.
*LedgerpaymentTypeOutApi* | [**get**](docs/Api/LedgerpaymentTypeOutApi.md#get) | **GET** /ledger/paymentTypeOut/{id} | [BETA] Get payment type for outgoing payments by ID.
*LedgerpaymentTypeOutApi* | [**post**](docs/Api/LedgerpaymentTypeOutApi.md#post) | **POST** /ledger/paymentTypeOut | [BETA] Create new payment type for outgoing payments
*LedgerpaymentTypeOutApi* | [**postList**](docs/Api/LedgerpaymentTypeOutApi.md#postlist) | **POST** /ledger/paymentTypeOut/list | [BETA] Create multiple payment types for outgoing payments at once
*LedgerpaymentTypeOutApi* | [**put**](docs/Api/LedgerpaymentTypeOutApi.md#put) | **PUT** /ledger/paymentTypeOut/{id} | [BETA] Update existing payment type for outgoing payments
*LedgerpaymentTypeOutApi* | [**putList**](docs/Api/LedgerpaymentTypeOutApi.md#putlist) | **PUT** /ledger/paymentTypeOut/list | [BETA] Update multiple payment types for outgoing payments at once
*LedgerpaymentTypeOutApi* | [**search**](docs/Api/LedgerpaymentTypeOutApi.md#search) | **GET** /ledger/paymentTypeOut | [BETA] Gets payment types for outgoing payments
*LedgerpostingApi* | [**get**](docs/Api/LedgerpostingApi.md#get) | **GET** /ledger/posting/{id} | Find postings by ID.
*LedgerpostingApi* | [**openPost**](docs/Api/LedgerpostingApi.md#openpost) | **GET** /ledger/posting/openPost | Find open posts corresponding with sent data.
*LedgerpostingApi* | [**search**](docs/Api/LedgerpostingApi.md#search) | **GET** /ledger/posting | Find postings corresponding with sent data.
*LedgervatTypeApi* | [**createRelativeVatType**](docs/Api/LedgervatTypeApi.md#createrelativevattype) | **PUT** /ledger/vatType/createRelativeVatType | Create a new relative VAT Type. These are used if the company has &#x27;forholdsmessig fradrag for inngående MVA&#x27;.
*LedgervatTypeApi* | [**get**](docs/Api/LedgervatTypeApi.md#get) | **GET** /ledger/vatType/{id} | Get vat type by ID.
*LedgervatTypeApi* | [**search**](docs/Api/LedgervatTypeApi.md#search) | **GET** /ledger/vatType | Find vat types corresponding with sent data.
*LedgervoucherApi* | [**delete**](docs/Api/LedgervoucherApi.md#delete) | **DELETE** /ledger/voucher/{id} | Delete voucher by ID.
*LedgervoucherApi* | [**deleteAttachment**](docs/Api/LedgervoucherApi.md#deleteattachment) | **DELETE** /ledger/voucher/{voucherId}/attachment | Delete attachment.
*LedgervoucherApi* | [**downloadPdf**](docs/Api/LedgervoucherApi.md#downloadpdf) | **GET** /ledger/voucher/{voucherId}/pdf | Get PDF representation of voucher by ID.
*LedgervoucherApi* | [**externalVoucherNumber**](docs/Api/LedgervoucherApi.md#externalvouchernumber) | **GET** /ledger/voucher/&gt;externalVoucherNumber | Find vouchers based on the external voucher number.
*LedgervoucherApi* | [**get**](docs/Api/LedgervoucherApi.md#get) | **GET** /ledger/voucher/{id} | Get voucher by ID.
*LedgervoucherApi* | [**importDocument**](docs/Api/LedgervoucherApi.md#importdocument) | **POST** /ledger/voucher/importDocument | Upload a document to create one or more vouchers. Valid document formats are PDF, PNG, JPEG, TIFF and EHF. Send as multipart form.
*LedgervoucherApi* | [**importGbat10**](docs/Api/LedgervoucherApi.md#importgbat10) | **POST** /ledger/voucher/importGbat10 | Import GBAT10. Send as multipart form.
*LedgervoucherApi* | [**nonPosted**](docs/Api/LedgervoucherApi.md#nonposted) | **GET** /ledger/voucher/&gt;nonPosted | Find non-posted vouchers.
*LedgervoucherApi* | [**options**](docs/Api/LedgervoucherApi.md#options) | **GET** /ledger/voucher/{id}/options | Returns a data structure containing meta information about operations that are available for this voucher. Currently only implemented for DELETE: It is possible to check if the voucher is deletable.
*LedgervoucherApi* | [**post**](docs/Api/LedgervoucherApi.md#post) | **POST** /ledger/voucher | Add new voucher. IMPORTANT: Also creates postings. Only the gross amounts will be used
*LedgervoucherApi* | [**put**](docs/Api/LedgervoucherApi.md#put) | **PUT** /ledger/voucher/{id} | Update voucher. Postings with guiRow&#x3D;&#x3D;0 will be deleted and regenerated.
*LedgervoucherApi* | [**putList**](docs/Api/LedgervoucherApi.md#putlist) | **PUT** /ledger/voucher/list | Update multiple vouchers. Postings with guiRow&#x3D;&#x3D;0 will be deleted and regenerated.
*LedgervoucherApi* | [**reverse**](docs/Api/LedgervoucherApi.md#reverse) | **PUT** /ledger/voucher/{id}/:reverse | Reverses the voucher, and returns the reversed voucher. Supports reversing most voucher types, except salary transactions.
*LedgervoucherApi* | [**search**](docs/Api/LedgervoucherApi.md#search) | **GET** /ledger/voucher | Find vouchers corresponding with sent data.
*LedgervoucherApi* | [**sendToInbox**](docs/Api/LedgervoucherApi.md#sendtoinbox) | **PUT** /ledger/voucher/{id}/:sendToInbox | Send voucher to inbox.
*LedgervoucherApi* | [**sendToLedger**](docs/Api/LedgervoucherApi.md#sendtoledger) | **PUT** /ledger/voucher/{id}/:sendToLedger | Send voucher to ledger.
*LedgervoucherApi* | [**uploadAttachment**](docs/Api/LedgervoucherApi.md#uploadattachment) | **POST** /ledger/voucher/{voucherId}/attachment | Upload attachment to voucher. If the voucher already has an attachment the content will be appended to the existing attachment as new PDF page(s). Valid document formats are PDF, PNG, JPEG and TIFF. Non PDF formats will be converted to PDF. Send as multipart form.
*LedgervoucherApi* | [**uploadPdf**](docs/Api/LedgervoucherApi.md#uploadpdf) | **POST** /ledger/voucher/{voucherId}/pdf/{fileName} | [DEPRECATED] Use POST ledger/voucher/{voucherId}/attachment instead.
*LedgervoucherApi* | [**voucherReception**](docs/Api/LedgervoucherApi.md#voucherreception) | **GET** /ledger/voucher/&gt;voucherReception | Find vouchers in voucher reception.
*LedgervoucherTypeApi* | [**get**](docs/Api/LedgervoucherTypeApi.md#get) | **GET** /ledger/voucherType/{id} | Get voucher type by ID.
*LedgervoucherTypeApi* | [**search**](docs/Api/LedgervoucherTypeApi.md#search) | **GET** /ledger/voucherType | Find voucher types corresponding with sent data.
*LedgervoucherhistoricalApi* | [**closePostings**](docs/Api/LedgervoucherhistoricalApi.md#closepostings) | **PUT** /ledger/voucher/historical/:closePostings | [BETA] Close postings.
*LedgervoucherhistoricalApi* | [**postEmployee**](docs/Api/LedgervoucherhistoricalApi.md#postemployee) | **POST** /ledger/voucher/historical/employee | [BETA] Create one employee, based on import from external system. Validation is less strict, ie. employee department isn&#x27;t required.
*LedgervoucherhistoricalApi* | [**postHistorical**](docs/Api/LedgervoucherhistoricalApi.md#posthistorical) | **POST** /ledger/voucher/historical/historical | API endpoint for creating historical vouchers. These are vouchers created outside Tripletex, and should be from closed accounting years. The intended usage is to get access to historical transcations in Tripletex. Also creates postings. All amount fields in postings will be used. VAT postings must be included, these are not generated automatically like they are for normal vouchers in Tripletex. Requires the \\\&quot;All vouchers\\\&quot; and \\\&quot;Advanced Voucher\\\&quot; permissions.
*LedgervoucherhistoricalApi* | [**reverseHistoricalVouchers**](docs/Api/LedgervoucherhistoricalApi.md#reversehistoricalvouchers) | **PUT** /ledger/voucher/historical/:reverseHistoricalVouchers | [BETA] Deletes all historical vouchers. Requires the \&quot;All vouchers\&quot; and \&quot;Advanced Voucher\&quot; permissions.
*LedgervoucherhistoricalApi* | [**uploadAttachment**](docs/Api/LedgervoucherhistoricalApi.md#uploadattachment) | **POST** /ledger/voucher/historical/{voucherId}/attachment | Upload attachment to voucher. If the voucher already has an attachment the content will be appended to the existing attachment as new PDF page(s). Valid document formats are PDF, PNG, JPEG and TIFF. Non PDF formats will be converted to PDF. Send as multipart form.
*LedgervoucheropeningBalanceApi* | [**correctionVoucher**](docs/Api/LedgervoucheropeningBalanceApi.md#correctionvoucher) | **GET** /ledger/voucher/openingBalance/&gt;correctionVoucher | [BETA] Get the correction voucher for the opening balance.
*LedgervoucheropeningBalanceApi* | [**delete**](docs/Api/LedgervoucheropeningBalanceApi.md#delete) | **DELETE** /ledger/voucher/openingBalance | [BETA] Delete the opening balance. The correction voucher will also be deleted
*LedgervoucheropeningBalanceApi* | [**get**](docs/Api/LedgervoucheropeningBalanceApi.md#get) | **GET** /ledger/voucher/openingBalance | [BETA] Get the voucher for the opening balance.
*LedgervoucheropeningBalanceApi* | [**post**](docs/Api/LedgervoucheropeningBalanceApi.md#post) | **POST** /ledger/voucher/openingBalance | [BETA] Add an opening balance on the given date.  All movements before this date will be &#x27;zeroed out&#x27; in a separate correction voucher. The opening balance must have the first day of a month as the date, and it&#x27;s also recommended to have the first day of the year as the date. If the postings provided don&#x27;t balance the voucher, the difference will automatically be posted to a help account
*MunicipalityApi* | [**query**](docs/Api/MunicipalityApi.md#query) | **GET** /municipality/query | [BETA] Wildcard search.
*MunicipalityApi* | [**search**](docs/Api/MunicipalityApi.md#search) | **GET** /municipality | Get municipalities.
*OrderApi* | [**approveSubscriptionInvoice**](docs/Api/OrderApi.md#approvesubscriptioninvoice) | **PUT** /order/{id}/:approveSubscriptionInvoice | To create a subscription invoice, first create a order with the subscription enabled, then approve it with this method. This approves the order for subscription invoicing.
*OrderApi* | [**attach**](docs/Api/OrderApi.md#attach) | **PUT** /order/{id}/:attach | Attach document to specified order ID.
*OrderApi* | [**get**](docs/Api/OrderApi.md#get) | **GET** /order/{id} | Get order by ID.
*OrderApi* | [**invoice**](docs/Api/OrderApi.md#invoice) | **PUT** /order/{id}/:invoice | Create new invoice from order.
*OrderApi* | [**invoiceMultipleOrders**](docs/Api/OrderApi.md#invoicemultipleorders) | **PUT** /order/:invoiceMultipleOrders | [BETA] Charges a single customer invoice from multiple orders. The orders must be to the same customer, currency, due date, receiver email, attn. and smsNotificationNumber
*OrderApi* | [**post**](docs/Api/OrderApi.md#post) | **POST** /order | Create order.
*OrderApi* | [**postList**](docs/Api/OrderApi.md#postlist) | **POST** /order/list | [BETA] Create multiple Orders with OrderLines. Max 100 at a time.
*OrderApi* | [**put**](docs/Api/OrderApi.md#put) | **PUT** /order/{id} | Update order.
*OrderApi* | [**search**](docs/Api/OrderApi.md#search) | **GET** /order | Find orders corresponding with sent data.
*OrderApi* | [**unApproveSubscriptionInvoice**](docs/Api/OrderApi.md#unapprovesubscriptioninvoice) | **PUT** /order/{id}/:unApproveSubscriptionInvoice | Unapproves the order for subscription invoicing.
*OrderorderGroupApi* | [**delete**](docs/Api/OrderorderGroupApi.md#delete) | **DELETE** /order/orderGroup/{id} | [Beta] Delete orderGroup by ID.
*OrderorderGroupApi* | [**get**](docs/Api/OrderorderGroupApi.md#get) | **GET** /order/orderGroup/{id} | [Beta] Get orderGroup by ID. A orderGroup is a way to group orderLines, and add comments and subtotals
*OrderorderGroupApi* | [**post**](docs/Api/OrderorderGroupApi.md#post) | **POST** /order/orderGroup | [Beta] Post orderGroup.
*OrderorderGroupApi* | [**put**](docs/Api/OrderorderGroupApi.md#put) | **PUT** /order/orderGroup | [Beta] Put orderGroup.
*OrderorderGroupApi* | [**search**](docs/Api/OrderorderGroupApi.md#search) | **GET** /order/orderGroup | [BETA] Find orderGroups corresponding with sent data.
*OrderorderlineApi* | [**delete**](docs/Api/OrderorderlineApi.md#delete) | **DELETE** /order/orderline/{id} | [BETA] Delete order line by ID.
*OrderorderlineApi* | [**get**](docs/Api/OrderorderlineApi.md#get) | **GET** /order/orderline/{id} | Get order line by ID.
*OrderorderlineApi* | [**post**](docs/Api/OrderorderlineApi.md#post) | **POST** /order/orderline | Create order line. When creating several order lines, use /list for better performance.
*OrderorderlineApi* | [**postList**](docs/Api/OrderorderlineApi.md#postlist) | **POST** /order/orderline/list | Create multiple order lines.
*OrderorderlineApi* | [**put**](docs/Api/OrderorderlineApi.md#put) | **PUT** /order/orderline/{id} | [BETA] Put order line
*PickupPointApi* | [**get**](docs/Api/PickupPointApi.md#get) | **GET** /pickupPoint/{id} | [BETA] Find pickup point by ID.
*PickupPointApi* | [**search**](docs/Api/PickupPointApi.md#search) | **GET** /pickupPoint | [BETA] Search pickup points.
*ProductApi* | [**delete**](docs/Api/ProductApi.md#delete) | **DELETE** /product/{id} | [BETA] Delete product.
*ProductApi* | [**deleteImage**](docs/Api/ProductApi.md#deleteimage) | **DELETE** /product/{id}/image | [BETA] Delete image.
*ProductApi* | [**get**](docs/Api/ProductApi.md#get) | **GET** /product/{id} | Get product by ID.
*ProductApi* | [**post**](docs/Api/ProductApi.md#post) | **POST** /product | Create new product.
*ProductApi* | [**postList**](docs/Api/ProductApi.md#postlist) | **POST** /product/list | [BETA] Add multiple products.
*ProductApi* | [**put**](docs/Api/ProductApi.md#put) | **PUT** /product/{id} | Update product.
*ProductApi* | [**putList**](docs/Api/ProductApi.md#putlist) | **PUT** /product/list | [BETA] Update a list of products.
*ProductApi* | [**search**](docs/Api/ProductApi.md#search) | **GET** /product | Find products corresponding with sent data.
*ProductApi* | [**uploadImage**](docs/Api/ProductApi.md#uploadimage) | **POST** /product/{id}/image | [BETA] Upload image to Product. Existing image on product will be replaced if exists
*ProductdiscountGroupApi* | [**get**](docs/Api/ProductdiscountGroupApi.md#get) | **GET** /product/discountGroup/{id} | Get discount group by ID.
*ProductdiscountGroupApi* | [**search**](docs/Api/ProductdiscountGroupApi.md#search) | **GET** /product/discountGroup | Find discount groups corresponding with sent data.
*ProductexternalApi* | [**get**](docs/Api/ProductexternalApi.md#get) | **GET** /product/external/{id} | [BETA] Get external product by ID.
*ProductexternalApi* | [**search**](docs/Api/ProductexternalApi.md#search) | **GET** /product/external | [BETA] Find external products corresponding with sent data. The sorting-field is not in use on this endpoint.
*ProductgroupApi* | [**delete**](docs/Api/ProductgroupApi.md#delete) | **DELETE** /product/group/{id} | [BETA] Delete product group.
*ProductgroupApi* | [**deleteByIds**](docs/Api/ProductgroupApi.md#deletebyids) | **DELETE** /product/group/list | [BETA] Delete multiple product groups.
*ProductgroupApi* | [**get**](docs/Api/ProductgroupApi.md#get) | **GET** /product/group/{id} | [BETA] Find product group by ID.
*ProductgroupApi* | [**post**](docs/Api/ProductgroupApi.md#post) | **POST** /product/group | [BETA] Create new product group.
*ProductgroupApi* | [**postList**](docs/Api/ProductgroupApi.md#postlist) | **POST** /product/group/list | [BETA] Add multiple products groups.
*ProductgroupApi* | [**put**](docs/Api/ProductgroupApi.md#put) | **PUT** /product/group/{id} | [BETA] Update product group.
*ProductgroupApi* | [**putList**](docs/Api/ProductgroupApi.md#putlist) | **PUT** /product/group/list | [BETA] Update a list of product groups.
*ProductgroupApi* | [**query**](docs/Api/ProductgroupApi.md#query) | **GET** /product/group/query | [BETA] Wildcard search.
*ProductgroupApi* | [**search**](docs/Api/ProductgroupApi.md#search) | **GET** /product/group | [BETA] Find product group with sent data
*ProductgroupRelationApi* | [**delete**](docs/Api/ProductgroupRelationApi.md#delete) | **DELETE** /product/groupRelation/{id} | [BETA] Delete product group relation.
*ProductgroupRelationApi* | [**deleteByIds**](docs/Api/ProductgroupRelationApi.md#deletebyids) | **DELETE** /product/groupRelation/list | [BETA] Delete multiple product group relations.
*ProductgroupRelationApi* | [**get**](docs/Api/ProductgroupRelationApi.md#get) | **GET** /product/groupRelation/{id} | [BETA] Find product group relation by ID.
*ProductgroupRelationApi* | [**post**](docs/Api/ProductgroupRelationApi.md#post) | **POST** /product/groupRelation | [BETA] Create new product group relation.
*ProductgroupRelationApi* | [**postList**](docs/Api/ProductgroupRelationApi.md#postlist) | **POST** /product/groupRelation/list | [BETA] Add multiple products group relations.
*ProductgroupRelationApi* | [**search**](docs/Api/ProductgroupRelationApi.md#search) | **GET** /product/groupRelation | [BETA] Find product group relation with sent data.
*ProductinventoryLocationApi* | [**delete**](docs/Api/ProductinventoryLocationApi.md#delete) | **DELETE** /product/inventoryLocation/{id} | [BETA] Delete product inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**get**](docs/Api/ProductinventoryLocationApi.md#get) | **GET** /product/inventoryLocation/{id} | Get inventory location by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**post**](docs/Api/ProductinventoryLocationApi.md#post) | **POST** /product/inventoryLocation | [BETA] Create new product inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**postList**](docs/Api/ProductinventoryLocationApi.md#postlist) | **POST** /product/inventoryLocation/list | [BETA] Add multiple product inventory locations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**put**](docs/Api/ProductinventoryLocationApi.md#put) | **PUT** /product/inventoryLocation/{id} | [BETA] Update product inventory location. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**putList**](docs/Api/ProductinventoryLocationApi.md#putlist) | **PUT** /product/inventoryLocation/list | [BETA] Update multiple product inventory locations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductinventoryLocationApi* | [**search**](docs/Api/ProductinventoryLocationApi.md#search) | **GET** /product/inventoryLocation | [BETA] Find inventory locations by product ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ProductlogisticsSettingsApi* | [**get**](docs/Api/ProductlogisticsSettingsApi.md#get) | **GET** /product/logisticsSettings | [BETA] Get logistics settings of logged in company.
*ProductlogisticsSettingsApi* | [**put**](docs/Api/ProductlogisticsSettingsApi.md#put) | **PUT** /product/logisticsSettings | [BETA] Update logistics settings of logged in company.
*ProductproductPriceApi* | [**search**](docs/Api/ProductproductPriceApi.md#search) | **GET** /product/productPrice | [BETA] Find prices for a product. Only available for users that have activated the Logistics/Logistics Plus Beta-program in &#x27;Our customer account&#x27;.
*ProductsupplierProductApi* | [**delete**](docs/Api/ProductsupplierProductApi.md#delete) | **DELETE** /product/supplierProduct/{id} | [BETA] Delete supplierProduct.
*ProductsupplierProductApi* | [**get**](docs/Api/ProductsupplierProductApi.md#get) | **GET** /product/supplierProduct/{id} | Get supplierProduct by ID.
*ProductsupplierProductApi* | [**post**](docs/Api/ProductsupplierProductApi.md#post) | **POST** /product/supplierProduct | Create new supplierProduct.
*ProductsupplierProductApi* | [**postList**](docs/Api/ProductsupplierProductApi.md#postlist) | **POST** /product/supplierProduct/list | Create list of new supplierProduct.
*ProductsupplierProductApi* | [**put**](docs/Api/ProductsupplierProductApi.md#put) | **PUT** /product/supplierProduct/{id} | Update supplierProduct.
*ProductsupplierProductApi* | [**putList**](docs/Api/ProductsupplierProductApi.md#putlist) | **PUT** /product/supplierProduct/list | [BETA] Update a list of supplierProduct.
*ProductsupplierProductApi* | [**search**](docs/Api/ProductsupplierProductApi.md#search) | **GET** /product/supplierProduct | Find products corresponding with sent data.
*ProductunitApi* | [**delete**](docs/Api/ProductunitApi.md#delete) | **DELETE** /product/unit/{id} | [BETA] Delete product unit by ID.
*ProductunitApi* | [**get**](docs/Api/ProductunitApi.md#get) | **GET** /product/unit/{id} | Get product unit by ID.
*ProductunitApi* | [**post**](docs/Api/ProductunitApi.md#post) | **POST** /product/unit | [BETA] Create new product unit.
*ProductunitApi* | [**postList**](docs/Api/ProductunitApi.md#postlist) | **POST** /product/unit/list | [BETA] Create multiple product units.
*ProductunitApi* | [**put**](docs/Api/ProductunitApi.md#put) | **PUT** /product/unit/{id} | [BETA] Update product unit.
*ProductunitApi* | [**putList**](docs/Api/ProductunitApi.md#putlist) | **PUT** /product/unit/list | [BETA] Update list of product units.
*ProductunitApi* | [**query**](docs/Api/ProductunitApi.md#query) | **GET** /product/unit/query | [BETA] Wildcard search.
*ProductunitApi* | [**search**](docs/Api/ProductunitApi.md#search) | **GET** /product/unit | Find product units corresponding with sent data.
*ProductunitmasterApi* | [**get**](docs/Api/ProductunitmasterApi.md#get) | **GET** /product/unit/master/{id} | [BETA] Get product unit master by ID.
*ProductunitmasterApi* | [**search**](docs/Api/ProductunitmasterApi.md#search) | **GET** /product/unit/master | [BETA] Find product units master corresponding with sent data.
*ProjectApi* | [**delete**](docs/Api/ProjectApi.md#delete) | **DELETE** /project/{id} | [BETA] Delete project.
*ProjectApi* | [**deleteByIds**](docs/Api/ProjectApi.md#deletebyids) | **DELETE** /project/list | [BETA] Delete projects.
*ProjectApi* | [**deleteList**](docs/Api/ProjectApi.md#deletelist) | **DELETE** /project | [BETA] Delete multiple projects.
*ProjectApi* | [**get**](docs/Api/ProjectApi.md#get) | **GET** /project/{id} | Find project by ID.
*ProjectApi* | [**getForTimeSheet**](docs/Api/ProjectApi.md#getfortimesheet) | **GET** /project/&gt;forTimeSheet | Find projects applicable for time sheet registration on a specific day.
*ProjectApi* | [**post**](docs/Api/ProjectApi.md#post) | **POST** /project | [BETA] Add new project.
*ProjectApi* | [**postList**](docs/Api/ProjectApi.md#postlist) | **POST** /project/list | [BETA] Register new projects. Multiple projects for different users can be sent in the same request.
*ProjectApi* | [**put**](docs/Api/ProjectApi.md#put) | **PUT** /project/{id} | [BETA] Update project.
*ProjectApi* | [**putList**](docs/Api/ProjectApi.md#putlist) | **PUT** /project/list | [BETA] Update multiple projects.
*ProjectApi* | [**search**](docs/Api/ProjectApi.md#search) | **GET** /project | Find projects corresponding with sent data.
*ProjectcategoryApi* | [**get**](docs/Api/ProjectcategoryApi.md#get) | **GET** /project/category/{id} | Find project category by ID.
*ProjectcategoryApi* | [**post**](docs/Api/ProjectcategoryApi.md#post) | **POST** /project/category | Add new project category.
*ProjectcategoryApi* | [**put**](docs/Api/ProjectcategoryApi.md#put) | **PUT** /project/category/{id} | Update project category.
*ProjectcategoryApi* | [**search**](docs/Api/ProjectcategoryApi.md#search) | **GET** /project/category | Find project categories corresponding with sent data.
*ProjectcontrolFormApi* | [**get**](docs/Api/ProjectcontrolFormApi.md#get) | **GET** /project/controlForm/{id} | [BETA] Get project control form by ID.
*ProjectcontrolFormApi* | [**search**](docs/Api/ProjectcontrolFormApi.md#search) | **GET** /project/controlForm | [BETA] Get project control forms by project ID.
*ProjectcontrolFormTypeApi* | [**get**](docs/Api/ProjectcontrolFormTypeApi.md#get) | **GET** /project/controlFormType/{id} | [BETA] Get project control form type by ID.
*ProjectcontrolFormTypeApi* | [**search**](docs/Api/ProjectcontrolFormTypeApi.md#search) | **GET** /project/controlFormType | [BETA] Get project control form types
*ProjecthourlyRatesApi* | [**delete**](docs/Api/ProjecthourlyRatesApi.md#delete) | **DELETE** /project/hourlyRates/{id} | Delete Project Hourly Rate
*ProjecthourlyRatesApi* | [**deleteByIds**](docs/Api/ProjecthourlyRatesApi.md#deletebyids) | **DELETE** /project/hourlyRates/list | Delete project hourly rates.
*ProjecthourlyRatesApi* | [**deleteByProjectIds**](docs/Api/ProjecthourlyRatesApi.md#deletebyprojectids) | **DELETE** /project/hourlyRates/deleteByProjectIds | Delete project hourly rates by project id.
*ProjecthourlyRatesApi* | [**get**](docs/Api/ProjecthourlyRatesApi.md#get) | **GET** /project/hourlyRates/{id} | Find project hourly rate by ID.
*ProjecthourlyRatesApi* | [**post**](docs/Api/ProjecthourlyRatesApi.md#post) | **POST** /project/hourlyRates | Create a project hourly rate.
*ProjecthourlyRatesApi* | [**postList**](docs/Api/ProjecthourlyRatesApi.md#postlist) | **POST** /project/hourlyRates/list | Create multiple project hourly rates.
*ProjecthourlyRatesApi* | [**put**](docs/Api/ProjecthourlyRatesApi.md#put) | **PUT** /project/hourlyRates/{id} | Update a project hourly rate.
*ProjecthourlyRatesApi* | [**putList**](docs/Api/ProjecthourlyRatesApi.md#putlist) | **PUT** /project/hourlyRates/list | Update multiple project hourly rates.
*ProjecthourlyRatesApi* | [**search**](docs/Api/ProjecthourlyRatesApi.md#search) | **GET** /project/hourlyRates | Find project hourly rates corresponding with sent data.
*ProjecthourlyRatesApi* | [**updateOrAddHourRates**](docs/Api/ProjecthourlyRatesApi.md#updateoraddhourrates) | **PUT** /project/hourlyRates/updateOrAddHourRates | Update or add the same project hourly rate from project overview.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**delete**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#delete) | **DELETE** /project/hourlyRates/projectSpecificRates/{id} | Delete project specific rate
*ProjecthourlyRatesprojectSpecificRatesApi* | [**deleteByIds**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#deletebyids) | **DELETE** /project/hourlyRates/projectSpecificRates/list | Delete project specific rates.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**get**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#get) | **GET** /project/hourlyRates/projectSpecificRates/{id} | Find project specific rate by ID.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**post**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#post) | **POST** /project/hourlyRates/projectSpecificRates | Create new project specific rate.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**postList**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#postlist) | **POST** /project/hourlyRates/projectSpecificRates/list | Create multiple new project specific rates.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**put**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#put) | **PUT** /project/hourlyRates/projectSpecificRates/{id} | Update a project specific rate.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**putList**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#putlist) | **PUT** /project/hourlyRates/projectSpecificRates/list | Update multiple project specific rates.
*ProjecthourlyRatesprojectSpecificRatesApi* | [**search**](docs/Api/ProjecthourlyRatesprojectSpecificRatesApi.md#search) | **GET** /project/hourlyRates/projectSpecificRates | Find project specific rates corresponding with sent data.
*ProjectimportApi* | [**importProjectStatement**](docs/Api/ProjectimportApi.md#importprojectstatement) | **POST** /project/import | Upload project import file.
*ProjectorderlineApi* | [**delete**](docs/Api/ProjectorderlineApi.md#delete) | **DELETE** /project/orderline/{id} | Delete order line by ID.
*ProjectorderlineApi* | [**get**](docs/Api/ProjectorderlineApi.md#get) | **GET** /project/orderline/{id} | [BETA] Get order line by ID.
*ProjectorderlineApi* | [**post**](docs/Api/ProjectorderlineApi.md#post) | **POST** /project/orderline | [BETA] Create order line. When creating several order lines, use /list for better performance.
*ProjectorderlineApi* | [**postList**](docs/Api/ProjectorderlineApi.md#postlist) | **POST** /project/orderline/list | [BETA] Create multiple order lines.
*ProjectorderlineApi* | [**put**](docs/Api/ProjectorderlineApi.md#put) | **PUT** /project/orderline/{id} | [BETA] Update project orderline.
*ProjectorderlineApi* | [**search**](docs/Api/ProjectorderlineApi.md#search) | **GET** /project/orderline | [BETA] Find all order lines for project.
*ProjectparticipantApi* | [**deleteByIds**](docs/Api/ProjectparticipantApi.md#deletebyids) | **DELETE** /project/participant/list | [BETA] Delete project participants.
*ProjectparticipantApi* | [**get**](docs/Api/ProjectparticipantApi.md#get) | **GET** /project/participant/{id} | [BETA] Find project participant by ID.
*ProjectparticipantApi* | [**post**](docs/Api/ProjectparticipantApi.md#post) | **POST** /project/participant | [BETA] Add new project participant.
*ProjectparticipantApi* | [**postList**](docs/Api/ProjectparticipantApi.md#postlist) | **POST** /project/participant/list | [BETA] Add new project participant. Multiple project participants can be sent in the same request.
*ProjectparticipantApi* | [**put**](docs/Api/ProjectparticipantApi.md#put) | **PUT** /project/participant/{id} | [BETA] Update project participant.
*ProjectperiodApi* | [**getBudgetStatus**](docs/Api/ProjectperiodApi.md#getbudgetstatus) | **GET** /project/{id}/period/budgetStatus | Get the budget status for the project period
*ProjectperiodApi* | [**hourlistReport**](docs/Api/ProjectperiodApi.md#hourlistreport) | **GET** /project/{id}/period/hourlistReport | Find hourlist report by project period.
*ProjectperiodApi* | [**invoiced**](docs/Api/ProjectperiodApi.md#invoiced) | **GET** /project/{id}/period/invoiced | Find invoiced info by project period.
*ProjectperiodApi* | [**invoicingReserve**](docs/Api/ProjectperiodApi.md#invoicingreserve) | **GET** /project/{id}/period/invoicingReserve | Find invoicing reserve by project period.
*ProjectperiodApi* | [**monthlyStatus**](docs/Api/ProjectperiodApi.md#monthlystatus) | **GET** /project/{id}/period/monthlyStatus | Find overall status by project period.
*ProjectperiodApi* | [**overallStatus**](docs/Api/ProjectperiodApi.md#overallstatus) | **GET** /project/{id}/period/overallStatus | Find overall status by project period.
*ProjectprojectActivityApi* | [**delete**](docs/Api/ProjectprojectActivityApi.md#delete) | **DELETE** /project/projectActivity/{id} | Delete project activity
*ProjectprojectActivityApi* | [**deleteByIds**](docs/Api/ProjectprojectActivityApi.md#deletebyids) | **DELETE** /project/projectActivity/list | Delete project activities
*ProjectprojectActivityApi* | [**get**](docs/Api/ProjectprojectActivityApi.md#get) | **GET** /project/projectActivity/{id} | Find project activity by id
*ProjectprojectActivityApi* | [**post**](docs/Api/ProjectprojectActivityApi.md#post) | **POST** /project/projectActivity | Add project activity.
*ProjectresourceplanApi* | [**get**](docs/Api/ProjectresourceplanApi.md#get) | **GET** /project/resourcePlanBudget | Get resource plan entries in the specified period.
*ProjectsettingsApi* | [**get**](docs/Api/ProjectsettingsApi.md#get) | **GET** /project/settings | Get project settings of logged in company.
*ProjectsettingsApi* | [**put**](docs/Api/ProjectsettingsApi.md#put) | **PUT** /project/settings | Update project settings for company
*ProjecttaskApi* | [**search**](docs/Api/ProjecttaskApi.md#search) | **GET** /project/task | Find all tasks for project.
*ProjecttemplateApi* | [**get**](docs/Api/ProjecttemplateApi.md#get) | **GET** /project/template/{id} | Get project template by ID.
*PurchaseOrderApi* | [**delete**](docs/Api/PurchaseOrderApi.md#delete) | **DELETE** /purchaseOrder/{id} | [BETA] Delete purchase order.
*PurchaseOrderApi* | [**deleteAttachment**](docs/Api/PurchaseOrderApi.md#deleteattachment) | **DELETE** /purchaseOrder/{id}/attachment | [BETA] Delete attachment.
*PurchaseOrderApi* | [**get**](docs/Api/PurchaseOrderApi.md#get) | **GET** /purchaseOrder/{id} | [BETA] Find purchase order by ID.
*PurchaseOrderApi* | [**post**](docs/Api/PurchaseOrderApi.md#post) | **POST** /purchaseOrder | [BETA] Creates a new purchase order
*PurchaseOrderApi* | [**put**](docs/Api/PurchaseOrderApi.md#put) | **PUT** /purchaseOrder/{id} | [BETA] Update purchase order.
*PurchaseOrderApi* | [**search**](docs/Api/PurchaseOrderApi.md#search) | **GET** /purchaseOrder | [BETA] Find purchase orders with send data
*PurchaseOrderApi* | [**send**](docs/Api/PurchaseOrderApi.md#send) | **PUT** /purchaseOrder/{id}/:send | [BETA] Send purchase order by id and sendType.
*PurchaseOrderApi* | [**sendByEmail**](docs/Api/PurchaseOrderApi.md#sendbyemail) | **PUT** /purchaseOrder/{id}/:sendByEmail | [BETA] Send purchase order by customisable email.
*PurchaseOrderApi* | [**uploadAttachment**](docs/Api/PurchaseOrderApi.md#uploadattachment) | **POST** /purchaseOrder/{id}/attachment | [BETA] Upload attachment to Purchase Order.
*PurchaseOrderApi* | [**uploadAttachments**](docs/Api/PurchaseOrderApi.md#uploadattachments) | **POST** /purchaseOrder/{id}/attachment/list | Upload multiple attachments to Purchase Order.
*PurchaseOrderdeviationApi* | [**approve**](docs/Api/PurchaseOrderdeviationApi.md#approve) | **PUT** /purchaseOrder/deviation/{id}/:approve | [BETA] Approve deviations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**delete**](docs/Api/PurchaseOrderdeviationApi.md#delete) | **DELETE** /purchaseOrder/deviation/{id} | [BETA] Delete goods receipt by purchase order ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**deliver**](docs/Api/PurchaseOrderdeviationApi.md#deliver) | **PUT** /purchaseOrder/deviation/{id}/:deliver | [BETA] Send deviations to approval. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**get**](docs/Api/PurchaseOrderdeviationApi.md#get) | **GET** /purchaseOrder/deviation/{id} | [BETA] Get deviation by order line ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**post**](docs/Api/PurchaseOrderdeviationApi.md#post) | **POST** /purchaseOrder/deviation | [BETA] Register deviation on goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**postList**](docs/Api/PurchaseOrderdeviationApi.md#postlist) | **POST** /purchaseOrder/deviation/list | [BETA] Register multiple deviations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**put**](docs/Api/PurchaseOrderdeviationApi.md#put) | **PUT** /purchaseOrder/deviation/{id} | Update deviation. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**putList**](docs/Api/PurchaseOrderdeviationApi.md#putlist) | **PUT** /purchaseOrder/deviation/list | [BETA] Update multiple deviations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**search**](docs/Api/PurchaseOrderdeviationApi.md#search) | **GET** /purchaseOrder/deviation | [BETA] Find handled deviations for purchase order. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderdeviationApi* | [**undeliver**](docs/Api/PurchaseOrderdeviationApi.md#undeliver) | **PUT** /purchaseOrder/deviation/{id}/:undeliver | [BETA] Undeliver the deviations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**confirm**](docs/Api/PurchaseOrdergoodsReceiptApi.md#confirm) | **PUT** /purchaseOrder/goodsReceipt/{id}/:confirm | [BETA] Confirm goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**delete**](docs/Api/PurchaseOrdergoodsReceiptApi.md#delete) | **DELETE** /purchaseOrder/goodsReceipt/{id} | [BETA] Delete goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**deleteByIds**](docs/Api/PurchaseOrdergoodsReceiptApi.md#deletebyids) | **DELETE** /purchaseOrder/goodsReceipt/list | [BETA] Delete multiple goods receipt by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**get**](docs/Api/PurchaseOrdergoodsReceiptApi.md#get) | **GET** /purchaseOrder/goodsReceipt/{id} | [BETA] Get goods receipt by purchase order ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**post**](docs/Api/PurchaseOrdergoodsReceiptApi.md#post) | **POST** /purchaseOrder/goodsReceipt | [BETA] Register goods receipt without an existing purchase order. When registration of several goods receipt, use /list for better performance. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**postList**](docs/Api/PurchaseOrdergoodsReceiptApi.md#postlist) | **POST** /purchaseOrder/goodsReceipt/list | [BETA] Register multiple goods receipt without an existing purchase order. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**put**](docs/Api/PurchaseOrdergoodsReceiptApi.md#put) | **PUT** /purchaseOrder/goodsReceipt/{id} | [BETA] Update goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**receiveAndConfirm**](docs/Api/PurchaseOrdergoodsReceiptApi.md#receiveandconfirm) | **PUT** /purchaseOrder/goodsReceipt/{id}/:receiveAndConfirm | [BETA]  Receive all ordered products and approve goods receipt. Only available for users that have activated the Logistics/Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**registerGoodsReceipt**](docs/Api/PurchaseOrdergoodsReceiptApi.md#registergoodsreceipt) | **PUT** /purchaseOrder/goodsReceipt/{id}/:registerGoodsReceipt | [BETA] Register goods receipt. Quantity received on the products is set to the same as quantity ordered. To update the quantity received, use PUT /purchaseOrder/goodsReceiptLine/{id}. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptApi* | [**search**](docs/Api/PurchaseOrdergoodsReceiptApi.md#search) | **GET** /purchaseOrder/goodsReceipt | [BETA] Get goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**delete**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#delete) | **DELETE** /purchaseOrder/goodsReceiptLine/{id} | [BETA] Delete goods receipt line by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**deleteList**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#deletelist) | **DELETE** /purchaseOrder/goodsReceiptLine/list | [BETA] Delete goods receipt lines by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**get**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#get) | **GET** /purchaseOrder/goodsReceiptLine/{id} | [BETA] Get goods receipt line by purchase order line ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**post**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#post) | **POST** /purchaseOrder/goodsReceiptLine | [BETA] Register new goods receipt; new product on an existing purchase order. When registration of several goods receipt, use /list for better performance. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**postList**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#postlist) | **POST** /purchaseOrder/goodsReceiptLine/list | [BETA] Register multiple new goods receipt on an existing purchase order. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**put**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#put) | **PUT** /purchaseOrder/goodsReceiptLine/{id} | [BETA] Update a goods receipt line on a goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**putList**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#putlist) | **PUT** /purchaseOrder/goodsReceiptLine/list | [BETA] Update goods receipt lines on a goods receipt. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrdergoodsReceiptLineApi* | [**search**](docs/Api/PurchaseOrdergoodsReceiptLineApi.md#search) | **GET** /purchaseOrder/goodsReceiptLine | [BETA] Find goods receipt lines for purchase order. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderorderlineApi* | [**delete**](docs/Api/PurchaseOrderorderlineApi.md#delete) | **DELETE** /purchaseOrder/orderline/{id} | [BETA] Delete purchase order line.
*PurchaseOrderorderlineApi* | [**deleteList**](docs/Api/PurchaseOrderorderlineApi.md#deletelist) | **DELETE** /purchaseOrder/orderline/list | [BETA] Delete purchase order lines by ID.
*PurchaseOrderorderlineApi* | [**get**](docs/Api/PurchaseOrderorderlineApi.md#get) | **GET** /purchaseOrder/orderline/{id} | [BETA] Find purchase order line by ID.
*PurchaseOrderorderlineApi* | [**post**](docs/Api/PurchaseOrderorderlineApi.md#post) | **POST** /purchaseOrder/orderline | [BETA] Creates purchase order line.
*PurchaseOrderorderlineApi* | [**postList**](docs/Api/PurchaseOrderorderlineApi.md#postlist) | **POST** /purchaseOrder/orderline/list | Create list of new purchase order lines.
*PurchaseOrderorderlineApi* | [**put**](docs/Api/PurchaseOrderorderlineApi.md#put) | **PUT** /purchaseOrder/orderline/{id} | [BETA] Updates purchase order line
*PurchaseOrderorderlineApi* | [**putList**](docs/Api/PurchaseOrderorderlineApi.md#putlist) | **PUT** /purchaseOrder/orderline/list | [BETA] Update a list of purchase order lines.
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**delete**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#delete) | **DELETE** /purchaseOrder/purchaseOrderIncomingInvoiceRelation/{id} | [BETA] Delete purchase order voucher relation. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**deleteByIds**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#deletebyids) | **DELETE** /purchaseOrder/purchaseOrderIncomingInvoiceRelation/list | [BETA] Delete multiple purchase order voucher relations. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**get**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#get) | **GET** /purchaseOrder/purchaseOrderIncomingInvoiceRelation/{id} | [BETA] Find purchase order relation to voucher by ID. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**post**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#post) | **POST** /purchaseOrder/purchaseOrderIncomingInvoiceRelation | [BETA] Create new relation between purchase order and a voucher. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**postList**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#postlist) | **POST** /purchaseOrder/purchaseOrderIncomingInvoiceRelation/list | [BETA] Create a new list of relations between purchase order and voucher. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi* | [**search**](docs/Api/PurchaseOrderpurchaseOrderIncomingInvoiceRelationApi.md#search) | **GET** /purchaseOrder/purchaseOrderIncomingInvoiceRelation | [BETA] Find purchase order relation to voucher with sent data. Only available for users that have activated the Logistics Plus Beta-program in &#x27;Our customer account&#x27;
*ReminderApi* | [**downloadPdf**](docs/Api/ReminderApi.md#downloadpdf) | **GET** /reminder/{reminderId}/pdf | Get reminder document by reminder ID.
*ReminderApi* | [**get**](docs/Api/ReminderApi.md#get) | **GET** /reminder/{id} | Get reminder by ID.
*ReminderApi* | [**search**](docs/Api/ReminderApi.md#search) | **GET** /reminder | Find reminders corresponding with sent data.
*ResultbudgetApi* | [**getCompanyResultBudget**](docs/Api/ResultbudgetApi.md#getcompanyresultbudget) | **GET** /resultbudget/company | Get result budget for company
*ResultbudgetApi* | [**getDepartmentResultBudget**](docs/Api/ResultbudgetApi.md#getdepartmentresultbudget) | **GET** /resultbudget/department/{id} | Get result budget associated with a departmentId
*ResultbudgetApi* | [**getEmployeeResultBudget**](docs/Api/ResultbudgetApi.md#getemployeeresultbudget) | **GET** /resultbudget/employee/{id} | Get result budget associated with an employeeId
*ResultbudgetApi* | [**getProductResultBudget**](docs/Api/ResultbudgetApi.md#getproductresultbudget) | **GET** /resultbudget/product/{id} | Get result budget associated with a productId
*ResultbudgetApi* | [**getProjectResultBudget**](docs/Api/ResultbudgetApi.md#getprojectresultbudget) | **GET** /resultbudget/project/{id} | Get result budget associated with a projectId
*SaftApi* | [**exportSAFT**](docs/Api/SaftApi.md#exportsaft) | **GET** /saft/exportSAFT | [BETA] Create SAF-T export for the Tripletex account.
*SaftApi* | [**importSAFT**](docs/Api/SaftApi.md#importsaft) | **POST** /saft/importSAFT | [BETA] Import SAF-T. Send XML file as multipart form.
*SalarycompilationApi* | [**downloadPdf**](docs/Api/SalarycompilationApi.md#downloadpdf) | **GET** /salary/compilation/pdf | Find salary compilation (PDF document) by employee.
*SalarycompilationApi* | [**get**](docs/Api/SalarycompilationApi.md#get) | **GET** /salary/compilation | Find salary compilation by employee.
*SalarypayslipApi* | [**downloadPdf**](docs/Api/SalarypayslipApi.md#downloadpdf) | **GET** /salary/payslip/{id}/pdf | Find payslip (PDF document) by ID.
*SalarypayslipApi* | [**get**](docs/Api/SalarypayslipApi.md#get) | **GET** /salary/payslip/{id} | Find payslip by ID.
*SalarypayslipApi* | [**search**](docs/Api/SalarypayslipApi.md#search) | **GET** /salary/payslip | Find payslips corresponding with sent data.
*SalarysettingsApi* | [**get**](docs/Api/SalarysettingsApi.md#get) | **GET** /salary/settings | Get salary settings of logged in company.
*SalarysettingsApi* | [**put**](docs/Api/SalarysettingsApi.md#put) | **PUT** /salary/settings | Update settings of logged in company.
*SalarysettingsholidayApi* | [**deleteByIds**](docs/Api/SalarysettingsholidayApi.md#deletebyids) | **DELETE** /salary/settings/holiday/list | Delete multiple holiday settings of current logged in company.
*SalarysettingsholidayApi* | [**post**](docs/Api/SalarysettingsholidayApi.md#post) | **POST** /salary/settings/holiday | Create a holiday setting of current logged in company.
*SalarysettingsholidayApi* | [**postList**](docs/Api/SalarysettingsholidayApi.md#postlist) | **POST** /salary/settings/holiday/list | Create multiple holiday settings of current logged in company.
*SalarysettingsholidayApi* | [**put**](docs/Api/SalarysettingsholidayApi.md#put) | **PUT** /salary/settings/holiday/{id} | Update a holiday setting of current logged in company.
*SalarysettingsholidayApi* | [**putList**](docs/Api/SalarysettingsholidayApi.md#putlist) | **PUT** /salary/settings/holiday/list | Update multiple holiday settings of current logged in company.
*SalarysettingsholidayApi* | [**search**](docs/Api/SalarysettingsholidayApi.md#search) | **GET** /salary/settings/holiday | Find holiday settings of current logged in company.
*SalarysettingspensionSchemeApi* | [**delete**](docs/Api/SalarysettingspensionSchemeApi.md#delete) | **DELETE** /salary/settings/pensionScheme/{id} | Delete a Pension Scheme
*SalarysettingspensionSchemeApi* | [**deleteByIds**](docs/Api/SalarysettingspensionSchemeApi.md#deletebyids) | **DELETE** /salary/settings/pensionScheme/list | Delete multiple Pension Schemes.
*SalarysettingspensionSchemeApi* | [**get**](docs/Api/SalarysettingspensionSchemeApi.md#get) | **GET** /salary/settings/pensionScheme/{id} | Get Pension Scheme for a specific ID
*SalarysettingspensionSchemeApi* | [**post**](docs/Api/SalarysettingspensionSchemeApi.md#post) | **POST** /salary/settings/pensionScheme | Create a Pension Scheme.
*SalarysettingspensionSchemeApi* | [**postList**](docs/Api/SalarysettingspensionSchemeApi.md#postlist) | **POST** /salary/settings/pensionScheme/list | Create multiple Pension Schemes.
*SalarysettingspensionSchemeApi* | [**put**](docs/Api/SalarysettingspensionSchemeApi.md#put) | **PUT** /salary/settings/pensionScheme/{id} | Update a Pension Scheme
*SalarysettingspensionSchemeApi* | [**putList**](docs/Api/SalarysettingspensionSchemeApi.md#putlist) | **PUT** /salary/settings/pensionScheme/list | Update multiple Pension Schemes.
*SalarysettingspensionSchemeApi* | [**search**](docs/Api/SalarysettingspensionSchemeApi.md#search) | **GET** /salary/settings/pensionScheme | Find pension schemes.
*SalarysettingsstandardTimeApi* | [**get**](docs/Api/SalarysettingsstandardTimeApi.md#get) | **GET** /salary/settings/standardTime/{id} | Find standard time by ID.
*SalarysettingsstandardTimeApi* | [**getByDate**](docs/Api/SalarysettingsstandardTimeApi.md#getbydate) | **GET** /salary/settings/standardTime/byDate | Find standard time by date
*SalarysettingsstandardTimeApi* | [**post**](docs/Api/SalarysettingsstandardTimeApi.md#post) | **POST** /salary/settings/standardTime | Create standard time.
*SalarysettingsstandardTimeApi* | [**put**](docs/Api/SalarysettingsstandardTimeApi.md#put) | **PUT** /salary/settings/standardTime/{id} | Update standard time.
*SalarysettingsstandardTimeApi* | [**search**](docs/Api/SalarysettingsstandardTimeApi.md#search) | **GET** /salary/settings/standardTime | Get all standard times.
*SalarytransactionApi* | [**delete**](docs/Api/SalarytransactionApi.md#delete) | **DELETE** /salary/transaction/{id} | Delete salary transaction by ID.
*SalarytransactionApi* | [**get**](docs/Api/SalarytransactionApi.md#get) | **GET** /salary/transaction/{id} | Find salary transaction by ID.
*SalarytransactionApi* | [**post**](docs/Api/SalarytransactionApi.md#post) | **POST** /salary/transaction | Create a new salary transaction.
*SalarytypeApi* | [**get**](docs/Api/SalarytypeApi.md#get) | **GET** /salary/type/{id} | Find salary type by ID.
*SalarytypeApi* | [**search**](docs/Api/SalarytypeApi.md#search) | **GET** /salary/type | Find salary type corresponding with sent data.
*SegmentationinternalApi* | [**get**](docs/Api/SegmentationinternalApi.md#get) | **GET** /internal/segmentation | Get segmentation data
*SubscriptionApi* | [**getAdditionalOrderLines**](docs/Api/SubscriptionApi.md#getadditionalorderlines) | **GET** /subscription/additionalOrderLines | Returns the additional order lines for an account.
*SubscriptionApi* | [**getInvoiceHistory**](docs/Api/SubscriptionApi.md#getinvoicehistory) | **GET** /subscription/invoiceHistory | Returns the invoice history for an account.
*SubscriptionApi* | [**getPackages**](docs/Api/SubscriptionApi.md#getpackages) | **GET** /subscription/packages | Returns the packages that can exist for an account.
*SubscriptionApi* | [**getServices**](docs/Api/SubscriptionApi.md#getservices) | **GET** /subscription/services | Returns the services that are available for an account.
*SupplierApi* | [**delete**](docs/Api/SupplierApi.md#delete) | **DELETE** /supplier/{id} | [BETA] Delete supplier by ID
*SupplierApi* | [**get**](docs/Api/SupplierApi.md#get) | **GET** /supplier/{id} | Get supplier by ID.
*SupplierApi* | [**post**](docs/Api/SupplierApi.md#post) | **POST** /supplier | Create supplier. Related supplier addresses may also be created.
*SupplierApi* | [**postList**](docs/Api/SupplierApi.md#postlist) | **POST** /supplier/list | [BETA] Create multiple suppliers. Related supplier addresses may also be created.
*SupplierApi* | [**put**](docs/Api/SupplierApi.md#put) | **PUT** /supplier/{id} | Update supplier.
*SupplierApi* | [**putList**](docs/Api/SupplierApi.md#putlist) | **PUT** /supplier/list | [BETA] Update multiple suppliers. Addresses can also be updated.
*SupplierApi* | [**search**](docs/Api/SupplierApi.md#search) | **GET** /supplier | Find suppliers corresponding with sent data.
*SupplierInvoiceApi* | [**addPayment**](docs/Api/SupplierInvoiceApi.md#addpayment) | **POST** /supplierInvoice/{invoiceId}/:addPayment | Register payment, paymentType &#x3D;&#x3D; 0 finds the last paymentType for this vendor
*SupplierInvoiceApi* | [**addRecipient**](docs/Api/SupplierInvoiceApi.md#addrecipient) | **PUT** /supplierInvoice/{invoiceId}/:addRecipient | Add recipient to supplier invoices.
*SupplierInvoiceApi* | [**addRecipientToMany**](docs/Api/SupplierInvoiceApi.md#addrecipienttomany) | **PUT** /supplierInvoice/:addRecipient | Add recipient.
*SupplierInvoiceApi* | [**approve**](docs/Api/SupplierInvoiceApi.md#approve) | **PUT** /supplierInvoice/{invoiceId}/:approve | Approve supplier invoice.
*SupplierInvoiceApi* | [**approveMany**](docs/Api/SupplierInvoiceApi.md#approvemany) | **PUT** /supplierInvoice/:approve | Approve supplier invoices.
*SupplierInvoiceApi* | [**changeDimensionMany**](docs/Api/SupplierInvoiceApi.md#changedimensionmany) | **PUT** /supplierInvoice/{invoiceId}/:changeDimension | Change dimension on a supplier invoice.
*SupplierInvoiceApi* | [**downloadPdf**](docs/Api/SupplierInvoiceApi.md#downloadpdf) | **GET** /supplierInvoice/{invoiceId}/pdf | Get supplierInvoice document by invoice ID.
*SupplierInvoiceApi* | [**get**](docs/Api/SupplierInvoiceApi.md#get) | **GET** /supplierInvoice/{id} | Get supplierInvoice by ID.
*SupplierInvoiceApi* | [**getApprovalInvoices**](docs/Api/SupplierInvoiceApi.md#getapprovalinvoices) | **GET** /supplierInvoice/forApproval | Get supplierInvoices for approval
*SupplierInvoiceApi* | [**putPostings**](docs/Api/SupplierInvoiceApi.md#putpostings) | **PUT** /supplierInvoice/voucher/{id}/postings | [BETA] Put debit postings.
*SupplierInvoiceApi* | [**reject**](docs/Api/SupplierInvoiceApi.md#reject) | **PUT** /supplierInvoice/{invoiceId}/:reject | reject supplier invoice.
*SupplierInvoiceApi* | [**rejectMany**](docs/Api/SupplierInvoiceApi.md#rejectmany) | **PUT** /supplierInvoice/:reject | reject supplier invoices.
*SupplierInvoiceApi* | [**search**](docs/Api/SupplierInvoiceApi.md#search) | **GET** /supplierInvoice | Find supplierInvoices corresponding with sent data.
*TimesheetallocatedApi* | [**approve**](docs/Api/TimesheetallocatedApi.md#approve) | **PUT** /timesheet/allocated/{id}/:approve | Only for allocated hours on the company&#x27;s internal holiday/vacation activity. Mark the allocated hour entry as approved. The hours will be copied to the time sheet. A notification will be sent to the entry&#x27;s employee if the entry&#x27;s approval status or comment has changed.
*TimesheetallocatedApi* | [**approveList**](docs/Api/TimesheetallocatedApi.md#approvelist) | **PUT** /timesheet/allocated/:approveList | Only for allocated hours on the company&#x27;s internal holiday/vacation activity. Mark the allocated hour entry/entries as approved. The hours will be copied to the time sheet. Notifications will be sent to the entries&#x27; employees if the entries&#x27; approval statuses or comments have changed. If IDs are provided, the other args are ignored.
*TimesheetallocatedApi* | [**delete**](docs/Api/TimesheetallocatedApi.md#delete) | **DELETE** /timesheet/allocated/{id} | Delete allocated hour entry by ID.
*TimesheetallocatedApi* | [**get**](docs/Api/TimesheetallocatedApi.md#get) | **GET** /timesheet/allocated/{id} | Find allocated hour entry by ID.
*TimesheetallocatedApi* | [**post**](docs/Api/TimesheetallocatedApi.md#post) | **POST** /timesheet/allocated | Add new allocated hour entry. Only one entry per employee/date/activity/project combination is supported. Only holiday/vacation hours can receive comments. A notification will be sent to the entry&#x27;s employee if the entry has a comment.
*TimesheetallocatedApi* | [**postList**](docs/Api/TimesheetallocatedApi.md#postlist) | **POST** /timesheet/allocated/list | Add new allocated hour entry. Multiple objects for several users can be sent in the same request. Only holiday/vacation hours can receive comments. Notifications will be sent to the entries&#x27; employees if the entries have comments.
*TimesheetallocatedApi* | [**put**](docs/Api/TimesheetallocatedApi.md#put) | **PUT** /timesheet/allocated/{id} | Update allocated hour entry by ID. Note: Allocated hour entry object fields which are present but not set, or set to 0, will be nulled. Only holiday/vacation hours can receive comments. A notification will be sent to the entry&#x27;s employee if the entry&#x27;s comment has changed.
*TimesheetallocatedApi* | [**putList**](docs/Api/TimesheetallocatedApi.md#putlist) | **PUT** /timesheet/allocated/list | Update allocated hour entry. Multiple objects for different users can be sent in the same request. Note: Allocated hour entry object fields which are present but not set, or set to 0, will be nulled. Only holiday/vacation hours can receive comments. Notifications will be sent to the entries&#x27; employees if the entries&#x27; comments have changed.
*TimesheetallocatedApi* | [**search**](docs/Api/TimesheetallocatedApi.md#search) | **GET** /timesheet/allocated | Find allocated hour entries corresponding with sent data.
*TimesheetallocatedApi* | [**unapprove**](docs/Api/TimesheetallocatedApi.md#unapprove) | **PUT** /timesheet/allocated/{id}/:unapprove | Only for allocated hours on the company&#x27;s internal holiday/vacation activity. Mark the allocated hour entry as unapproved. A notification will be sent to the entry&#x27;s employee if the entry&#x27;s approval status or comment has changed.
*TimesheetallocatedApi* | [**unapproveList**](docs/Api/TimesheetallocatedApi.md#unapprovelist) | **PUT** /timesheet/allocated/:unapproveList | Only for allocated hours on the company&#x27;s internal holiday/vacation activity. Mark the allocated hour entry/entries as unapproved. Notifications will be sent to the entries&#x27; employees if the entries&#x27; approval statuses or comments have changed. If IDs are provided, the other args are ignored.
*TimesheetcompanyHolidayApi* | [**delete**](docs/Api/TimesheetcompanyHolidayApi.md#delete) | **DELETE** /timesheet/companyHoliday/{id} | [BETA] Delete a company holiday
*TimesheetcompanyHolidayApi* | [**get**](docs/Api/TimesheetcompanyHolidayApi.md#get) | **GET** /timesheet/companyHoliday/{id} | [BETA] Get company holiday by its ID
*TimesheetcompanyHolidayApi* | [**post**](docs/Api/TimesheetcompanyHolidayApi.md#post) | **POST** /timesheet/companyHoliday | [BETA] Create a company holiday
*TimesheetcompanyHolidayApi* | [**put**](docs/Api/TimesheetcompanyHolidayApi.md#put) | **PUT** /timesheet/companyHoliday/{id} | [BETA] Update a company holiday
*TimesheetcompanyHolidayApi* | [**search**](docs/Api/TimesheetcompanyHolidayApi.md#search) | **GET** /timesheet/companyHoliday | [BETA] Search for company holidays by id or year.
*TimesheetentryApi* | [**delete**](docs/Api/TimesheetentryApi.md#delete) | **DELETE** /timesheet/entry/{id} | Delete timesheet entry by ID.
*TimesheetentryApi* | [**get**](docs/Api/TimesheetentryApi.md#get) | **GET** /timesheet/entry/{id} | Find timesheet entry by ID.
*TimesheetentryApi* | [**getRecentActivities**](docs/Api/TimesheetentryApi.md#getrecentactivities) | **GET** /timesheet/entry/&gt;recentActivities | Find recently used timesheet activities.
*TimesheetentryApi* | [**getRecentProjects**](docs/Api/TimesheetentryApi.md#getrecentprojects) | **GET** /timesheet/entry/&gt;recentProjects | Find projects with recent activities (timesheet entry registered).
*TimesheetentryApi* | [**getTotalHours**](docs/Api/TimesheetentryApi.md#gettotalhours) | **GET** /timesheet/entry/&gt;totalHours | Find total hours registered on an employee in a specific period.
*TimesheetentryApi* | [**post**](docs/Api/TimesheetentryApi.md#post) | **POST** /timesheet/entry | Add new timesheet entry. Only one entry per employee/date/activity/project combination is supported.
*TimesheetentryApi* | [**postList**](docs/Api/TimesheetentryApi.md#postlist) | **POST** /timesheet/entry/list | Add new timesheet entry. Multiple objects for several users can be sent in the same request.
*TimesheetentryApi* | [**put**](docs/Api/TimesheetentryApi.md#put) | **PUT** /timesheet/entry/{id} | Update timesheet entry by ID. Note: Timesheet entry object fields which are present but not set, or set to 0, will be nulled.
*TimesheetentryApi* | [**putList**](docs/Api/TimesheetentryApi.md#putlist) | **PUT** /timesheet/entry/list | Update timesheet entry. Multiple objects for different users can be sent in the same request.
*TimesheetentryApi* | [**search**](docs/Api/TimesheetentryApi.md#search) | **GET** /timesheet/entry | Find timesheet entry corresponding with sent data.
*TimesheetmonthApi* | [**approve**](docs/Api/TimesheetmonthApi.md#approve) | **PUT** /timesheet/month/:approve | approve month(s).  If id is provided the other args are ignored
*TimesheetmonthApi* | [**complete**](docs/Api/TimesheetmonthApi.md#complete) | **PUT** /timesheet/month/:complete | complete month(s).  If id is provided the other args are ignored
*TimesheetmonthApi* | [**get**](docs/Api/TimesheetmonthApi.md#get) | **GET** /timesheet/month/{id} | Find monthly status entry by ID.
*TimesheetmonthApi* | [**getByMonthNumber**](docs/Api/TimesheetmonthApi.md#getbymonthnumber) | **GET** /timesheet/month/byMonthNumber | Find monthly status for given month.
*TimesheetmonthApi* | [**reopen**](docs/Api/TimesheetmonthApi.md#reopen) | **PUT** /timesheet/month/:reopen | reopen month(s).  If id is provided the other args are ignored
*TimesheetmonthApi* | [**unapprove**](docs/Api/TimesheetmonthApi.md#unapprove) | **PUT** /timesheet/month/:unapprove | unapprove month(s).  If id is provided the other args are ignored
*TimesheetsalaryProjectTypeSpecificationApi* | [**delete**](docs/Api/TimesheetsalaryProjectTypeSpecificationApi.md#delete) | **DELETE** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Delete a timesheet SalaryType Specification (PILOT USERS ONLY)
*TimesheetsalaryProjectTypeSpecificationApi* | [**get**](docs/Api/TimesheetsalaryProjectTypeSpecificationApi.md#get) | **GET** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Get timesheet ProjectSalaryType Specification for a specific ID (PILOT USERS ONLY)
*TimesheetsalaryProjectTypeSpecificationApi* | [**post**](docs/Api/TimesheetsalaryProjectTypeSpecificationApi.md#post) | **POST** /timesheet/salaryProjectTypeSpecification | [BETA] Create a timesheet ProjectSalaryType Specification. (PILOT USERS ONLY)
*TimesheetsalaryProjectTypeSpecificationApi* | [**put**](docs/Api/TimesheetsalaryProjectTypeSpecificationApi.md#put) | **PUT** /timesheet/salaryProjectTypeSpecification/{id} | [BETA] Update a timesheet ProjectSalaryType Specification (PILOT USERS ONLY)
*TimesheetsalaryProjectTypeSpecificationApi* | [**search**](docs/Api/TimesheetsalaryProjectTypeSpecificationApi.md#search) | **GET** /timesheet/salaryProjectTypeSpecification | [BETA] Get list of timesheet ProjectSalaryType Specifications (PILOT USERS ONLY)
*TimesheetsalaryTypeSpecificationApi* | [**delete**](docs/Api/TimesheetsalaryTypeSpecificationApi.md#delete) | **DELETE** /timesheet/salaryTypeSpecification/{id} | [BETA] Delete a timesheet SalaryType Specification
*TimesheetsalaryTypeSpecificationApi* | [**get**](docs/Api/TimesheetsalaryTypeSpecificationApi.md#get) | **GET** /timesheet/salaryTypeSpecification/{id} | [BETA] Get timesheet SalaryType Specification for a specific ID
*TimesheetsalaryTypeSpecificationApi* | [**post**](docs/Api/TimesheetsalaryTypeSpecificationApi.md#post) | **POST** /timesheet/salaryTypeSpecification | [BETA] Create a timesheet SalaryType Specification. Only one entry per employee/date/SalaryType
*TimesheetsalaryTypeSpecificationApi* | [**put**](docs/Api/TimesheetsalaryTypeSpecificationApi.md#put) | **PUT** /timesheet/salaryTypeSpecification/{id} | [BETA] Update a timesheet SalaryType Specification
*TimesheetsalaryTypeSpecificationApi* | [**search**](docs/Api/TimesheetsalaryTypeSpecificationApi.md#search) | **GET** /timesheet/salaryTypeSpecification | [BETA] Get list of timesheet SalaryType Specifications
*TimesheetsettingsApi* | [**get**](docs/Api/TimesheetsettingsApi.md#get) | **GET** /timesheet/settings | [BETA] Get timesheet settings of logged in company.
*TimesheettimeClockApi* | [**get**](docs/Api/TimesheettimeClockApi.md#get) | **GET** /timesheet/timeClock/{id} | Find time clock entry by ID.
*TimesheettimeClockApi* | [**getPresent**](docs/Api/TimesheettimeClockApi.md#getpresent) | **GET** /timesheet/timeClock/present | Find a user’s present running time clock.
*TimesheettimeClockApi* | [**put**](docs/Api/TimesheettimeClockApi.md#put) | **PUT** /timesheet/timeClock/{id} | Update time clock by ID.
*TimesheettimeClockApi* | [**search**](docs/Api/TimesheettimeClockApi.md#search) | **GET** /timesheet/timeClock | Find time clock entries corresponding with sent data.
*TimesheettimeClockApi* | [**start**](docs/Api/TimesheettimeClockApi.md#start) | **PUT** /timesheet/timeClock/:start | Start time clock.
*TimesheettimeClockApi* | [**stop**](docs/Api/TimesheettimeClockApi.md#stop) | **PUT** /timesheet/timeClock/{id}/:stop | Stop time clock.
*TimesheetweekApi* | [**approve**](docs/Api/TimesheetweekApi.md#approve) | **PUT** /timesheet/week/:approve | Approve week. By ID or (ISO-8601 week and employeeId combination).
*TimesheetweekApi* | [**complete**](docs/Api/TimesheetweekApi.md#complete) | **PUT** /timesheet/week/:complete | Complete week. By ID or (ISO-8601 week and employeeId combination).
*TimesheetweekApi* | [**reopen**](docs/Api/TimesheetweekApi.md#reopen) | **PUT** /timesheet/week/:reopen | Reopen week. By ID or (ISO-8601 week and employeeId combination).
*TimesheetweekApi* | [**search**](docs/Api/TimesheetweekApi.md#search) | **GET** /timesheet/week | Find weekly status By ID, week/year combination, employeeId. or an approver
*TimesheetweekApi* | [**unapprove**](docs/Api/TimesheetweekApi.md#unapprove) | **PUT** /timesheet/week/:unapprove | Unapprove week. By ID or (ISO-8601 week and employeeId combination).
*TokenconsumerApi* | [**getByToken**](docs/Api/TokenconsumerApi.md#getbytoken) | **GET** /token/consumer/byToken | Get consumer token by token string.
*TokenemployeeApi* | [**create**](docs/Api/TokenemployeeApi.md#create) | **PUT** /token/employee/:create | Create an employee token. Only selected consumers are allowed
*TokensessionApi* | [**create**](docs/Api/TokensessionApi.md#create) | **PUT** /token/session/:create | Create session token.
*TokensessionApi* | [**delete**](docs/Api/TokensessionApi.md#delete) | **DELETE** /token/session/{token} | Delete session token.
*TokensessionApi* | [**whoAmI**](docs/Api/TokensessionApi.md#whoami) | **GET** /token/session/&gt;whoAmI | Find information about the current user.
*TransportTypeApi* | [**get**](docs/Api/TransportTypeApi.md#get) | **GET** /transportType/{id} | [BETA] Find transport type by ID.
*TransportTypeApi* | [**search**](docs/Api/TransportTypeApi.md#search) | **GET** /transportType | [BETA] Search transport type.
*TravelExpenseApi* | [**approve**](docs/Api/TravelExpenseApi.md#approve) | **PUT** /travelExpense/:approve | Approve travel expenses.
*TravelExpenseApi* | [**copy**](docs/Api/TravelExpenseApi.md#copy) | **PUT** /travelExpense/:copy | Copy travel expense.
*TravelExpenseApi* | [**createVouchers**](docs/Api/TravelExpenseApi.md#createvouchers) | **PUT** /travelExpense/:createVouchers | Create vouchers
*TravelExpenseApi* | [**delete**](docs/Api/TravelExpenseApi.md#delete) | **DELETE** /travelExpense/{id} | Delete travel expense.
*TravelExpenseApi* | [**deleteAttachment**](docs/Api/TravelExpenseApi.md#deleteattachment) | **DELETE** /travelExpense/{travelExpenseId}/attachment | Delete attachment.
*TravelExpenseApi* | [**deliver**](docs/Api/TravelExpenseApi.md#deliver) | **PUT** /travelExpense/:deliver | Deliver travel expenses.
*TravelExpenseApi* | [**downloadAttachment**](docs/Api/TravelExpenseApi.md#downloadattachment) | **GET** /travelExpense/{travelExpenseId}/attachment | Get attachment by travel expense ID.
*TravelExpenseApi* | [**get**](docs/Api/TravelExpenseApi.md#get) | **GET** /travelExpense/{id} | Get travel expense by ID.
*TravelExpenseApi* | [**post**](docs/Api/TravelExpenseApi.md#post) | **POST** /travelExpense | Create travel expense.
*TravelExpenseApi* | [**put**](docs/Api/TravelExpenseApi.md#put) | **PUT** /travelExpense/{id} | Update travel expense.
*TravelExpenseApi* | [**search**](docs/Api/TravelExpenseApi.md#search) | **GET** /travelExpense | Find travel expenses corresponding with sent data.
*TravelExpenseApi* | [**unapprove**](docs/Api/TravelExpenseApi.md#unapprove) | **PUT** /travelExpense/:unapprove | Unapprove travel expenses.
*TravelExpenseApi* | [**undeliver**](docs/Api/TravelExpenseApi.md#undeliver) | **PUT** /travelExpense/:undeliver | Undeliver travel expenses.
*TravelExpenseApi* | [**uploadAttachment**](docs/Api/TravelExpenseApi.md#uploadattachment) | **POST** /travelExpense/{travelExpenseId}/attachment | Upload attachment to travel expense.
*TravelExpenseApi* | [**uploadAttachments**](docs/Api/TravelExpenseApi.md#uploadattachments) | **POST** /travelExpense/{travelExpenseId}/attachment/list | Upload multiple attachments to travel expense.
*TravelExpenseaccommodationAllowanceApi* | [**delete**](docs/Api/TravelExpenseaccommodationAllowanceApi.md#delete) | **DELETE** /travelExpense/accommodationAllowance/{id} | Delete accommodation allowance.
*TravelExpenseaccommodationAllowanceApi* | [**get**](docs/Api/TravelExpenseaccommodationAllowanceApi.md#get) | **GET** /travelExpense/accommodationAllowance/{id} | Get travel accommodation allowance by ID.
*TravelExpenseaccommodationAllowanceApi* | [**post**](docs/Api/TravelExpenseaccommodationAllowanceApi.md#post) | **POST** /travelExpense/accommodationAllowance | Create accommodation allowance.
*TravelExpenseaccommodationAllowanceApi* | [**put**](docs/Api/TravelExpenseaccommodationAllowanceApi.md#put) | **PUT** /travelExpense/accommodationAllowance/{id} | Update accommodation allowance.
*TravelExpenseaccommodationAllowanceApi* | [**search**](docs/Api/TravelExpenseaccommodationAllowanceApi.md#search) | **GET** /travelExpense/accommodationAllowance | Find accommodation allowances corresponding with sent data.
*TravelExpensecostApi* | [**delete**](docs/Api/TravelExpensecostApi.md#delete) | **DELETE** /travelExpense/cost/{id} | Delete cost.
*TravelExpensecostApi* | [**get**](docs/Api/TravelExpensecostApi.md#get) | **GET** /travelExpense/cost/{id} | Get cost by ID.
*TravelExpensecostApi* | [**post**](docs/Api/TravelExpensecostApi.md#post) | **POST** /travelExpense/cost | Create cost.
*TravelExpensecostApi* | [**put**](docs/Api/TravelExpensecostApi.md#put) | **PUT** /travelExpense/cost/{id} | Update cost.
*TravelExpensecostApi* | [**putList**](docs/Api/TravelExpensecostApi.md#putlist) | **PUT** /travelExpense/cost/list | Update costs.
*TravelExpensecostApi* | [**search**](docs/Api/TravelExpensecostApi.md#search) | **GET** /travelExpense/cost | Find costs corresponding with sent data.
*TravelExpensecostCategoryApi* | [**get**](docs/Api/TravelExpensecostCategoryApi.md#get) | **GET** /travelExpense/costCategory/{id} | Get cost category by ID.
*TravelExpensecostCategoryApi* | [**search**](docs/Api/TravelExpensecostCategoryApi.md#search) | **GET** /travelExpense/costCategory | Find cost category corresponding with sent data.
*TravelExpensedrivingStopApi* | [**delete**](docs/Api/TravelExpensedrivingStopApi.md#delete) | **DELETE** /travelExpense/drivingStop/{id} | Delete mileage allowance stops.
*TravelExpensedrivingStopApi* | [**get**](docs/Api/TravelExpensedrivingStopApi.md#get) | **GET** /travelExpense/drivingStop/{id} | Get driving stop by ID.
*TravelExpensedrivingStopApi* | [**post**](docs/Api/TravelExpensedrivingStopApi.md#post) | **POST** /travelExpense/drivingStop | Create mileage allowance driving stop.
*TravelExpensemileageAllowanceApi* | [**delete**](docs/Api/TravelExpensemileageAllowanceApi.md#delete) | **DELETE** /travelExpense/mileageAllowance/{id} | Delete mileage allowance.
*TravelExpensemileageAllowanceApi* | [**get**](docs/Api/TravelExpensemileageAllowanceApi.md#get) | **GET** /travelExpense/mileageAllowance/{id} | Get mileage allowance by ID.
*TravelExpensemileageAllowanceApi* | [**post**](docs/Api/TravelExpensemileageAllowanceApi.md#post) | **POST** /travelExpense/mileageAllowance | Create mileage allowance.
*TravelExpensemileageAllowanceApi* | [**put**](docs/Api/TravelExpensemileageAllowanceApi.md#put) | **PUT** /travelExpense/mileageAllowance/{id} | Update mileage allowance.
*TravelExpensemileageAllowanceApi* | [**search**](docs/Api/TravelExpensemileageAllowanceApi.md#search) | **GET** /travelExpense/mileageAllowance | Find mileage allowances corresponding with sent data.
*TravelExpensepassengerApi* | [**delete**](docs/Api/TravelExpensepassengerApi.md#delete) | **DELETE** /travelExpense/passenger/{id} | Delete passenger.
*TravelExpensepassengerApi* | [**get**](docs/Api/TravelExpensepassengerApi.md#get) | **GET** /travelExpense/passenger/{id} | Get passenger by ID.
*TravelExpensepassengerApi* | [**post**](docs/Api/TravelExpensepassengerApi.md#post) | **POST** /travelExpense/passenger | Create passenger.
*TravelExpensepassengerApi* | [**put**](docs/Api/TravelExpensepassengerApi.md#put) | **PUT** /travelExpense/passenger/{id} | Update passenger.
*TravelExpensepassengerApi* | [**search**](docs/Api/TravelExpensepassengerApi.md#search) | **GET** /travelExpense/passenger | Find passengers corresponding with sent data.
*TravelExpensepaymentTypeApi* | [**get**](docs/Api/TravelExpensepaymentTypeApi.md#get) | **GET** /travelExpense/paymentType/{id} | Get payment type by ID.
*TravelExpensepaymentTypeApi* | [**search**](docs/Api/TravelExpensepaymentTypeApi.md#search) | **GET** /travelExpense/paymentType | Find payment type corresponding with sent data.
*TravelExpenseperDiemCompensationApi* | [**delete**](docs/Api/TravelExpenseperDiemCompensationApi.md#delete) | **DELETE** /travelExpense/perDiemCompensation/{id} | Delete per diem compensation.
*TravelExpenseperDiemCompensationApi* | [**get**](docs/Api/TravelExpenseperDiemCompensationApi.md#get) | **GET** /travelExpense/perDiemCompensation/{id} | Get per diem compensation by ID.
*TravelExpenseperDiemCompensationApi* | [**post**](docs/Api/TravelExpenseperDiemCompensationApi.md#post) | **POST** /travelExpense/perDiemCompensation | Create per diem compensation.
*TravelExpenseperDiemCompensationApi* | [**put**](docs/Api/TravelExpenseperDiemCompensationApi.md#put) | **PUT** /travelExpense/perDiemCompensation/{id} | Update per diem compensation.
*TravelExpenseperDiemCompensationApi* | [**search**](docs/Api/TravelExpenseperDiemCompensationApi.md#search) | **GET** /travelExpense/perDiemCompensation | Find per diem compensations corresponding with sent data.
*TravelExpenserateApi* | [**get**](docs/Api/TravelExpenserateApi.md#get) | **GET** /travelExpense/rate/{id} | Get travel expense rate by ID.
*TravelExpenserateApi* | [**search**](docs/Api/TravelExpenserateApi.md#search) | **GET** /travelExpense/rate | Find rates corresponding with sent data.
*TravelExpenserateCategoryApi* | [**get**](docs/Api/TravelExpenserateCategoryApi.md#get) | **GET** /travelExpense/rateCategory/{id} | Get travel expense rate category by ID.
*TravelExpenserateCategoryApi* | [**search**](docs/Api/TravelExpenserateCategoryApi.md#search) | **GET** /travelExpense/rateCategory | Find rate categories corresponding with sent data.
*TravelExpenserateCategoryGroupApi* | [**get**](docs/Api/TravelExpenserateCategoryGroupApi.md#get) | **GET** /travelExpense/rateCategoryGroup/{id} | Get travel report rate category group by ID.
*TravelExpenserateCategoryGroupApi* | [**search**](docs/Api/TravelExpenserateCategoryGroupApi.md#search) | **GET** /travelExpense/rateCategoryGroup | Find rate categoriy groups corresponding with sent data.
*TravelExpensesettingsApi* | [**get**](docs/Api/TravelExpensesettingsApi.md#get) | **GET** /travelExpense/settings | Get travel expense settings of logged in company.
*TravelExpensezoneApi* | [**get**](docs/Api/TravelExpensezoneApi.md#get) | **GET** /travelExpense/zone/{id} | Get travel expense zone by ID.
*TravelExpensezoneApi* | [**search**](docs/Api/TravelExpensezoneApi.md#search) | **GET** /travelExpense/zone | Find travel expense zones corresponding with sent data.
*VatReturnscommentApi* | [**all**](docs/Api/VatReturnscommentApi.md#all) | **GET** /vatReturns/comment/&gt;all | [BETA] - Get all structured comments available
*VatReturnscommentApi* | [**query**](docs/Api/VatReturnscommentApi.md#query) | **GET** /vatReturns/comment | [BETA] - Get all structured comments related to a given vatCode
*VoucherApprovalListElementApi* | [**get**](docs/Api/VoucherApprovalListElementApi.md#get) | **GET** /voucherApprovalListElement/{id} | Get by ID.
*VoucherMessageApi* | [**post**](docs/Api/VoucherMessageApi.md#post) | **POST** /voucherMessage | [BETA] Post new voucherMessage.
*VoucherMessageApi* | [**search**](docs/Api/VoucherMessageApi.md#search) | **GET** /voucherMessage | [BETA] Find voucherMessage (or a comment) put on a voucher by inputting voucher ids
*VoucherStatusApi* | [**get**](docs/Api/VoucherStatusApi.md#get) | **GET** /voucherStatus/{id} | Get voucherStatus by ID.
*VoucherStatusApi* | [**post**](docs/Api/VoucherStatusApi.md#post) | **POST** /voucherStatus | Post new voucherStatus.
*VoucherStatusApi* | [**search**](docs/Api/VoucherStatusApi.md#search) | **GET** /voucherStatus | Find voucherStatus corresponding with sent data. The voucherStatus is used to coordinate integration processes. Requires setup done by Tripletex, currently supports debt collection.
*YearEndnoteApi* | [**get**](docs/Api/YearEndnoteApi.md#get) | **GET** /yearEnd/note/{id} | 

## Documentation For Models

 - [AccommodationAllowance](docs/Model/AccommodationAllowance.md)
 - [AccommodationAndRestaurant](docs/Model/AccommodationAndRestaurant.md)
 - [Account](docs/Model/Account.md)
 - [AccountClosureFeedback](docs/Model/AccountClosureFeedback.md)
 - [AccountClosureInfoDTO](docs/Model/AccountClosureInfoDTO.md)
 - [AccountIdBody](docs/Model/AccountIdBody.md)
 - [AccountSpecification](docs/Model/AccountSpecification.md)
 - [AccountantClientAccessCategoryModel](docs/Model/AccountantClientAccessCategoryModel.md)
 - [AccountantClientAccessModel](docs/Model/AccountantClientAccessModel.md)
 - [AccountantClientAccessRole](docs/Model/AccountantClientAccessRole.md)
 - [AccountingPeriod](docs/Model/AccountingPeriod.md)
 - [Activity](docs/Model/Activity.md)
 - [AdditionalServiceOrderLineDTO](docs/Model/AdditionalServiceOrderLineDTO.md)
 - [Addon](docs/Model/Addon.md)
 - [AddonLogoDTO](docs/Model/AddonLogoDTO.md)
 - [Address](docs/Model/Address.md)
 - [AdvancedPaymentWidget](docs/Model/AdvancedPaymentWidget.md)
 - [AgroToTripletexDTO](docs/Model/AgroToTripletexDTO.md)
 - [AidScheme](docs/Model/AidScheme.md)
 - [AltinnCompanyModule](docs/Model/AltinnCompanyModule.md)
 - [AltinnInstance](docs/Model/AltinnInstance.md)
 - [AnnualAccount](docs/Model/AnnualAccount.md)
 - [AnnualAccountsSubTotalLine](docs/Model/AnnualAccountsSubTotalLine.md)
 - [AnnualAccountsSubTotalSection](docs/Model/AnnualAccountsSubTotalSection.md)
 - [ApiConsumer](docs/Model/ApiConsumer.md)
 - [ApiError](docs/Model/ApiError.md)
 - [ApiValidationMessage](docs/Model/ApiValidationMessage.md)
 - [ApproveResponseDTO](docs/Model/ApproveResponseDTO.md)
 - [AprilaCashCreditApplicationResponseDTO](docs/Model/AprilaCashCreditApplicationResponseDTO.md)
 - [ArchiveModelTypes](docs/Model/ArchiveModelTypes.md)
 - [ArchiveTargetPath](docs/Model/ArchiveTargetPath.md)
 - [Article](docs/Model/Article.md)
 - [Asset](docs/Model/Asset.md)
 - [AssetDetails](docs/Model/AssetDetails.md)
 - [AssetGroup](docs/Model/AssetGroup.md)
 - [AssetOverview](docs/Model/AssetOverview.md)
 - [AuthConfigDTO](docs/Model/AuthConfigDTO.md)
 - [AuthorizationManager](docs/Model/AuthorizationManager.md)
 - [AuthorizationManagerCompanyRepresentative](docs/Model/AuthorizationManagerCompanyRepresentative.md)
 - [AutoLogin](docs/Model/AutoLogin.md)
 - [AutoLoginPayloadDTO](docs/Model/AutoLoginPayloadDTO.md)
 - [AutoPayMessageDTO](docs/Model/AutoPayMessageDTO.md)
 - [AutoPaySupport](docs/Model/AutoPaySupport.md)
 - [AutomationRuleDetails](docs/Model/AutomationRuleDetails.md)
 - [AutomationSettingsDTO](docs/Model/AutomationSettingsDTO.md)
 - [AutopayBankAgreement](docs/Model/AutopayBankAgreement.md)
 - [BalanceGroup](docs/Model/BalanceGroup.md)
 - [BalanceSheet](docs/Model/BalanceSheet.md)
 - [BalanceSheetAccount](docs/Model/BalanceSheetAccount.md)
 - [BalanceSheetRow](docs/Model/BalanceSheetRow.md)
 - [BalanceSheetSettingsDTO](docs/Model/BalanceSheetSettingsDTO.md)
 - [Bank](docs/Model/Bank.md)
 - [BankAgreementCreationDTO](docs/Model/BankAgreementCreationDTO.md)
 - [BankAgreementDTO](docs/Model/BankAgreementDTO.md)
 - [BankBalanceEstimation](docs/Model/BankBalanceEstimation.md)
 - [BankDashboardAdvice](docs/Model/BankDashboardAdvice.md)
 - [BankOnboardingAccessRequestDTO](docs/Model/BankOnboardingAccessRequestDTO.md)
 - [BankOnboardingDTO](docs/Model/BankOnboardingDTO.md)
 - [BankOnboardingStepDTO](docs/Model/BankOnboardingStepDTO.md)
 - [BankReconciliation](docs/Model/BankReconciliation.md)
 - [BankReconciliationAdjustment](docs/Model/BankReconciliationAdjustment.md)
 - [BankReconciliationMatch](docs/Model/BankReconciliationMatch.md)
 - [BankReconciliationMatchesCounter](docs/Model/BankReconciliationMatchesCounter.md)
 - [BankReconciliationPaymentType](docs/Model/BankReconciliationPaymentType.md)
 - [BankReconciliationSettings](docs/Model/BankReconciliationSettings.md)
 - [BankSettings](docs/Model/BankSettings.md)
 - [BankStatement](docs/Model/BankStatement.md)
 - [BankStatementBalance](docs/Model/BankStatementBalance.md)
 - [BankTransaction](docs/Model/BankTransaction.md)
 - [BankTransactionAggregates](docs/Model/BankTransactionAggregates.md)
 - [BankTransactionPosting](docs/Model/BankTransactionPosting.md)
 - [Banner](docs/Model/Banner.md)
 - [BasicData](docs/Model/BasicData.md)
 - [BodyPart](docs/Model/BodyPart.md)
 - [BringCredentials](docs/Model/BringCredentials.md)
 - [BrregCompanyLookupDTO](docs/Model/BrregCompanyLookupDTO.md)
 - [CalloutDTO](docs/Model/CalloutDTO.md)
 - [CashRegisterSystem](docs/Model/CashRegisterSystem.md)
 - [Category](docs/Model/Category.md)
 - [CellBlueprintV1](docs/Model/CellBlueprintV1.md)
 - [Change](docs/Model/Change.md)
 - [ChangeOfEquity](docs/Model/ChangeOfEquity.md)
 - [Checklist](docs/Model/Checklist.md)
 - [ChecklistProperty](docs/Model/ChecklistProperty.md)
 - [Checkout](docs/Model/Checkout.md)
 - [Choice](docs/Model/Choice.md)
 - [Client](docs/Model/Client.md)
 - [ClientAccessTemplate](docs/Model/ClientAccessTemplate.md)
 - [ClientForApproval](docs/Model/ClientForApproval.md)
 - [ClientForRemit](docs/Model/ClientForRemit.md)
 - [ClientForReview](docs/Model/ClientForReview.md)
 - [ClientInbox](docs/Model/ClientInbox.md)
 - [CloseGroup](docs/Model/CloseGroup.md)
 - [ColorField](docs/Model/ColorField.md)
 - [Comment](docs/Model/Comment.md)
 - [CommentCreation](docs/Model/CommentCreation.md)
 - [CommentField](docs/Model/CommentField.md)
 - [CommentInput](docs/Model/CommentInput.md)
 - [CommentValue](docs/Model/CommentValue.md)
 - [CommercialVehicle](docs/Model/CommercialVehicle.md)
 - [Company](docs/Model/Company.md)
 - [CompanyAuthorityDTO](docs/Model/CompanyAuthorityDTO.md)
 - [CompanyAutoCompleteDTO](docs/Model/CompanyAutoCompleteDTO.md)
 - [CompanyBankAccountPresentation](docs/Model/CompanyBankAccountPresentation.md)
 - [CompanyChooserDTO](docs/Model/CompanyChooserDTO.md)
 - [CompanyDTO](docs/Model/CompanyDTO.md)
 - [CompanyHoliday](docs/Model/CompanyHoliday.md)
 - [CompanyHolidays](docs/Model/CompanyHolidays.md)
 - [CompanyRepresentative](docs/Model/CompanyRepresentative.md)
 - [CompanyRepresentativeDTO](docs/Model/CompanyRepresentativeDTO.md)
 - [CompanyStandardTime](docs/Model/CompanyStandardTime.md)
 - [CompanyTransactionAggregates](docs/Model/CompanyTransactionAggregates.md)
 - [ConsumerToken](docs/Model/ConsumerToken.md)
 - [Contact](docs/Model/Contact.md)
 - [ContentDisposition](docs/Model/ContentDisposition.md)
 - [Coordinate](docs/Model/Coordinate.md)
 - [Cost](docs/Model/Cost.md)
 - [Country](docs/Model/Country.md)
 - [Credentials](docs/Model/Credentials.md)
 - [Currency](docs/Model/Currency.md)
 - [CurrencyExchangeRate](docs/Model/CurrencyExchangeRate.md)
 - [Customer](docs/Model/Customer.md)
 - [CustomerCategory](docs/Model/CustomerCategory.md)
 - [CustomerIdBody](docs/Model/CustomerIdBody.md)
 - [CustomerReceivable](docs/Model/CustomerReceivable.md)
 - [CustomerTripletexAccount2](docs/Model/CustomerTripletexAccount2.md)
 - [CustomizedChecklistProperty](docs/Model/CustomizedChecklistProperty.md)
 - [DashboardContextDTO](docs/Model/DashboardContextDTO.md)
 - [DashboardDTO](docs/Model/DashboardDTO.md)
 - [DatabaseComponentAuthorizationManager](docs/Model/DatabaseComponentAuthorizationManager.md)
 - [DatabaseComponentAuthorizationManagerRequestlogModel](docs/Model/DatabaseComponentAuthorizationManagerRequestlogModel.md)
 - [Day](docs/Model/Day.md)
 - [Delete](docs/Model/Delete.md)
 - [DeliveryAddress](docs/Model/DeliveryAddress.md)
 - [Department](docs/Model/Department.md)
 - [DepreciationRate](docs/Model/DepreciationRate.md)
 - [Deviation](docs/Model/Deviation.md)
 - [DifferencesOverview](docs/Model/DifferencesOverview.md)
 - [DiscountGroup](docs/Model/DiscountGroup.md)
 - [Disposition](docs/Model/Disposition.md)
 - [DistributionKey](docs/Model/DistributionKey.md)
 - [DistributionKeyBit](docs/Model/DistributionKeyBit.md)
 - [DistributionKeyBlade](docs/Model/DistributionKeyBlade.md)
 - [Dividend](docs/Model/Dividend.md)
 - [DividendDetails](docs/Model/DividendDetails.md)
 - [Division](docs/Model/Division.md)
 - [Document](docs/Model/Document.md)
 - [DocumentArchive](docs/Model/DocumentArchive.md)
 - [DocumentArchiveReceptionBody](docs/Model/DocumentArchiveReceptionBody.md)
 - [DocumentationGenericData](docs/Model/DocumentationGenericData.md)
 - [DownloadedBrreg](docs/Model/DownloadedBrreg.md)
 - [DrivingStop](docs/Model/DrivingStop.md)
 - [ElectronicSupportDTO](docs/Model/ElectronicSupportDTO.md)
 - [Employee](docs/Model/Employee.md)
 - [EmployeeCategory](docs/Model/EmployeeCategory.md)
 - [EmployeeCompanyDTO](docs/Model/EmployeeCompanyDTO.md)
 - [EmployeeEmail](docs/Model/EmployeeEmail.md)
 - [EmployeeIdBody](docs/Model/EmployeeIdBody.md)
 - [EmployeeLoginInfo](docs/Model/EmployeeLoginInfo.md)
 - [EmployeePreferences](docs/Model/EmployeePreferences.md)
 - [EmployeeRoleModelDTO](docs/Model/EmployeeRoleModelDTO.md)
 - [EmployeeToken](docs/Model/EmployeeToken.md)
 - [EmployeeTokenBundle](docs/Model/EmployeeTokenBundle.md)
 - [Employment](docs/Model/Employment.md)
 - [EmploymentDetails](docs/Model/EmploymentDetails.md)
 - [EmploymentType](docs/Model/EmploymentType.md)
 - [EnhetsregisteretDTO](docs/Model/EnhetsregisteretDTO.md)
 - [EnterpriseDTO](docs/Model/EnterpriseDTO.md)
 - [Entitlement](docs/Model/Entitlement.md)
 - [EnumType](docs/Model/EnumType.md)
 - [EventInfoDTO](docs/Model/EventInfoDTO.md)
 - [EventInfoDescription](docs/Model/EventInfoDescription.md)
 - [ExternalProduct](docs/Model/ExternalProduct.md)
 - [ExtraordinaryIncomeAndCost](docs/Model/ExtraordinaryIncomeAndCost.md)
 - [Favorite](docs/Model/Favorite.md)
 - [FavoriteMenu](docs/Model/FavoriteMenu.md)
 - [FavoritesIdBody](docs/Model/FavoritesIdBody.md)
 - [FileIdForIncomingPaymentsDTO](docs/Model/FileIdForIncomingPaymentsDTO.md)
 - [FinacialInstrumentAsset](docs/Model/FinacialInstrumentAsset.md)
 - [FlexSummary](docs/Model/FlexSummary.md)
 - [FormDataBodyPart](docs/Model/FormDataBodyPart.md)
 - [FormDataContentDisposition](docs/Model/FormDataContentDisposition.md)
 - [FormDataMultiPart](docs/Model/FormDataMultiPart.md)
 - [FundingPartnerApplication](docs/Model/FundingPartnerApplication.md)
 - [FundingPartnerQualify](docs/Model/FundingPartnerQualify.md)
 - [GenericData](docs/Model/GenericData.md)
 - [GenericDataOverview](docs/Model/GenericDataOverview.md)
 - [GenericDataRate](docs/Model/GenericDataRate.md)
 - [GoodsReceipt](docs/Model/GoodsReceipt.md)
 - [GoodsReceiptLine](docs/Model/GoodsReceiptLine.md)
 - [GroupContributions](docs/Model/GroupContributions.md)
 - [GroupInvestment](docs/Model/GroupInvestment.md)
 - [HeaderBlueprintV1](docs/Model/HeaderBlueprintV1.md)
 - [HelpCenterArticles](docs/Model/HelpCenterArticles.md)
 - [HistoricalPosting](docs/Model/HistoricalPosting.md)
 - [HistoricalVoucher](docs/Model/HistoricalVoucher.md)
 - [HolidayAllowanceEarned](docs/Model/HolidayAllowanceEarned.md)
 - [HourSummary](docs/Model/HourSummary.md)
 - [HourlyCostAndRate](docs/Model/HourlyCostAndRate.md)
 - [HourlyRate](docs/Model/HourlyRate.md)
 - [Hours](docs/Model/Hours.md)
 - [IdAttachBody](docs/Model/IdAttachBody.md)
 - [IdAttachmentBody](docs/Model/IdAttachmentBody.md)
 - [IdImageBody](docs/Model/IdImageBody.md)
 - [IdPortenLogin](docs/Model/IdPortenLogin.md)
 - [IdPortenLoginRequest](docs/Model/IdPortenLoginRequest.md)
 - [IdPortenLoginStatus](docs/Model/IdPortenLoginStatus.md)
 - [ImageField](docs/Model/ImageField.md)
 - [ImageValue](docs/Model/ImageValue.md)
 - [InboxData](docs/Model/InboxData.md)
 - [IncomeAndCostSummaryDTO](docs/Model/IncomeAndCostSummaryDTO.md)
 - [IncomeStatement](docs/Model/IncomeStatement.md)
 - [IncomingInvoicePaymentHistory](docs/Model/IncomingInvoicePaymentHistory.md)
 - [IncomingInvoicePaymentHistoryTransaction](docs/Model/IncomingInvoicePaymentHistoryTransaction.md)
 - [IntegrationData](docs/Model/IntegrationData.md)
 - [InternalFavoritesBody](docs/Model/InternalFavoritesBody.md)
 - [InternationalId](docs/Model/InternationalId.md)
 - [Inventories](docs/Model/Inventories.md)
 - [InventoriesDetails](docs/Model/InventoriesDetails.md)
 - [InventoriesOverview](docs/Model/InventoriesOverview.md)
 - [Inventory](docs/Model/Inventory.md)
 - [InventoryLocation](docs/Model/InventoryLocation.md)
 - [Invoice](docs/Model/Invoice.md)
 - [InvoiceAndOrdersData](docs/Model/InvoiceAndOrdersData.md)
 - [InvoiceField](docs/Model/InvoiceField.md)
 - [InvoiceMessage](docs/Model/InvoiceMessage.md)
 - [InvoiceOrderLineDTO](docs/Model/InvoiceOrderLineDTO.md)
 - [InvoiceRemark](docs/Model/InvoiceRemark.md)
 - [InvoiceReminder](docs/Model/InvoiceReminder.md)
 - [InvoiceSendTypeDTO](docs/Model/InvoiceSendTypeDTO.md)
 - [InvoiceSettings](docs/Model/InvoiceSettings.md)
 - [InvoiceStatus](docs/Model/InvoiceStatus.md)
 - [InvoiceSummaryDTO](docs/Model/InvoiceSummaryDTO.md)
 - [InvoiceTemplateRenderer](docs/Model/InvoiceTemplateRenderer.md)
 - [Job](docs/Model/Job.md)
 - [JobDetailDTO](docs/Model/JobDetailDTO.md)
 - [LeaveOfAbsence](docs/Model/LeaveOfAbsence.md)
 - [LeaveOfAbsenceType](docs/Model/LeaveOfAbsenceType.md)
 - [LedgerAccount](docs/Model/LedgerAccount.md)
 - [LegacyAddress](docs/Model/LegacyAddress.md)
 - [LegacyProfileDTO](docs/Model/LegacyProfileDTO.md)
 - [License](docs/Model/License.md)
 - [Link](docs/Model/Link.md)
 - [LinkMobilityReportDTO](docs/Model/LinkMobilityReportDTO.md)
 - [ListResponse](docs/Model/ListResponse.md)
 - [ListResponseAccommodationAllowance](docs/Model/ListResponseAccommodationAllowance.md)
 - [ListResponseAccount](docs/Model/ListResponseAccount.md)
 - [ListResponseAccountingPeriod](docs/Model/ListResponseAccountingPeriod.md)
 - [ListResponseActivity](docs/Model/ListResponseActivity.md)
 - [ListResponseAddon](docs/Model/ListResponseAddon.md)
 - [ListResponseAnnualAccount](docs/Model/ListResponseAnnualAccount.md)
 - [ListResponseApiConsumer](docs/Model/ListResponseApiConsumer.md)
 - [ListResponseArchiveTargetPath](docs/Model/ListResponseArchiveTargetPath.md)
 - [ListResponseAsset](docs/Model/ListResponseAsset.md)
 - [ListResponseAutopayBankAgreement](docs/Model/ListResponseAutopayBankAgreement.md)
 - [ListResponseBalanceSheetAccount](docs/Model/ListResponseBalanceSheetAccount.md)
 - [ListResponseBank](docs/Model/ListResponseBank.md)
 - [ListResponseBankAgreementDTO](docs/Model/ListResponseBankAgreementDTO.md)
 - [ListResponseBankBalanceEstimation](docs/Model/ListResponseBankBalanceEstimation.md)
 - [ListResponseBankDashboardAdvice](docs/Model/ListResponseBankDashboardAdvice.md)
 - [ListResponseBankReconciliation](docs/Model/ListResponseBankReconciliation.md)
 - [ListResponseBankReconciliationAdjustment](docs/Model/ListResponseBankReconciliationAdjustment.md)
 - [ListResponseBankReconciliationMatch](docs/Model/ListResponseBankReconciliationMatch.md)
 - [ListResponseBankReconciliationPaymentType](docs/Model/ListResponseBankReconciliationPaymentType.md)
 - [ListResponseBankStatement](docs/Model/ListResponseBankStatement.md)
 - [ListResponseBankTransaction](docs/Model/ListResponseBankTransaction.md)
 - [ListResponseBanner](docs/Model/ListResponseBanner.md)
 - [ListResponseBrregCompanyLookupDTO](docs/Model/ListResponseBrregCompanyLookupDTO.md)
 - [ListResponseCalloutDTO](docs/Model/ListResponseCalloutDTO.md)
 - [ListResponseChecklist](docs/Model/ListResponseChecklist.md)
 - [ListResponseChecklistProperty](docs/Model/ListResponseChecklistProperty.md)
 - [ListResponseClient](docs/Model/ListResponseClient.md)
 - [ListResponseClientAccessTemplate](docs/Model/ListResponseClientAccessTemplate.md)
 - [ListResponseCloseGroup](docs/Model/ListResponseCloseGroup.md)
 - [ListResponseComment](docs/Model/ListResponseComment.md)
 - [ListResponseCompany](docs/Model/ListResponseCompany.md)
 - [ListResponseCompanyAutoCompleteDTO](docs/Model/ListResponseCompanyAutoCompleteDTO.md)
 - [ListResponseCompanyHoliday](docs/Model/ListResponseCompanyHoliday.md)
 - [ListResponseCompanyHolidays](docs/Model/ListResponseCompanyHolidays.md)
 - [ListResponseCompanyStandardTime](docs/Model/ListResponseCompanyStandardTime.md)
 - [ListResponseContact](docs/Model/ListResponseContact.md)
 - [ListResponseCost](docs/Model/ListResponseCost.md)
 - [ListResponseCountry](docs/Model/ListResponseCountry.md)
 - [ListResponseCurrency](docs/Model/ListResponseCurrency.md)
 - [ListResponseCustomer](docs/Model/ListResponseCustomer.md)
 - [ListResponseCustomerCategory](docs/Model/ListResponseCustomerCategory.md)
 - [ListResponseCustomizedChecklistProperty](docs/Model/ListResponseCustomizedChecklistProperty.md)
 - [ListResponseDeliveryAddress](docs/Model/ListResponseDeliveryAddress.md)
 - [ListResponseDepartment](docs/Model/ListResponseDepartment.md)
 - [ListResponseDepreciationRate](docs/Model/ListResponseDepreciationRate.md)
 - [ListResponseDeviation](docs/Model/ListResponseDeviation.md)
 - [ListResponseDiscountGroup](docs/Model/ListResponseDiscountGroup.md)
 - [ListResponseDistributionKey](docs/Model/ListResponseDistributionKey.md)
 - [ListResponseDivision](docs/Model/ListResponseDivision.md)
 - [ListResponseDocument](docs/Model/ListResponseDocument.md)
 - [ListResponseDocumentArchive](docs/Model/ListResponseDocumentArchive.md)
 - [ListResponseEmployee](docs/Model/ListResponseEmployee.md)
 - [ListResponseEmployeeCategory](docs/Model/ListResponseEmployeeCategory.md)
 - [ListResponseEmployeeCompanyDTO](docs/Model/ListResponseEmployeeCompanyDTO.md)
 - [ListResponseEmployeePreferences](docs/Model/ListResponseEmployeePreferences.md)
 - [ListResponseEmployment](docs/Model/ListResponseEmployment.md)
 - [ListResponseEmploymentDetails](docs/Model/ListResponseEmploymentDetails.md)
 - [ListResponseEmploymentType](docs/Model/ListResponseEmploymentType.md)
 - [ListResponseEnhetsregisteretDTO](docs/Model/ListResponseEnhetsregisteretDTO.md)
 - [ListResponseEntitlement](docs/Model/ListResponseEntitlement.md)
 - [ListResponseEnumType](docs/Model/ListResponseEnumType.md)
 - [ListResponseExternalProduct](docs/Model/ListResponseExternalProduct.md)
 - [ListResponseGenericDataRate](docs/Model/ListResponseGenericDataRate.md)
 - [ListResponseGoodsReceipt](docs/Model/ListResponseGoodsReceipt.md)
 - [ListResponseGoodsReceiptLine](docs/Model/ListResponseGoodsReceiptLine.md)
 - [ListResponseHistoricalVoucher](docs/Model/ListResponseHistoricalVoucher.md)
 - [ListResponseHourlyCostAndRate](docs/Model/ListResponseHourlyCostAndRate.md)
 - [ListResponseInventories](docs/Model/ListResponseInventories.md)
 - [ListResponseInventory](docs/Model/ListResponseInventory.md)
 - [ListResponseInventoryLocation](docs/Model/ListResponseInventoryLocation.md)
 - [ListResponseInvoice](docs/Model/ListResponseInvoice.md)
 - [ListResponseInvoiceSendTypeDTO](docs/Model/ListResponseInvoiceSendTypeDTO.md)
 - [ListResponseInvoiceSummaryDTO](docs/Model/ListResponseInvoiceSummaryDTO.md)
 - [ListResponseLeaveOfAbsence](docs/Model/ListResponseLeaveOfAbsence.md)
 - [ListResponseLeaveOfAbsenceType](docs/Model/ListResponseLeaveOfAbsenceType.md)
 - [ListResponseLedgerAccount](docs/Model/ListResponseLedgerAccount.md)
 - [ListResponseLegacyAddress](docs/Model/ListResponseLegacyAddress.md)
 - [ListResponseMapping](docs/Model/ListResponseMapping.md)
 - [ListResponseMileageAllowance](docs/Model/ListResponseMileageAllowance.md)
 - [ListResponseMonthlyStatus](docs/Model/ListResponseMonthlyStatus.md)
 - [ListResponseMunicipality](docs/Model/ListResponseMunicipality.md)
 - [ListResponseNews](docs/Model/ListResponseNews.md)
 - [ListResponseNextOfKin](docs/Model/ListResponseNextOfKin.md)
 - [ListResponseNotification](docs/Model/ListResponseNotification.md)
 - [ListResponseOccupationCode](docs/Model/ListResponseOccupationCode.md)
 - [ListResponseOrder](docs/Model/ListResponseOrder.md)
 - [ListResponseOrderGroup](docs/Model/ListResponseOrderGroup.md)
 - [ListResponseOrderLine](docs/Model/ListResponseOrderLine.md)
 - [ListResponseOrderOffer](docs/Model/ListResponseOrderOffer.md)
 - [ListResponseOutgoingStock](docs/Model/ListResponseOutgoingStock.md)
 - [ListResponsePassenger](docs/Model/ListResponsePassenger.md)
 - [ListResponsePaymentDTO](docs/Model/ListResponsePaymentDTO.md)
 - [ListResponsePaymentType](docs/Model/ListResponsePaymentType.md)
 - [ListResponsePaymentTypeOut](docs/Model/ListResponsePaymentTypeOut.md)
 - [ListResponsePayslip](docs/Model/ListResponsePayslip.md)
 - [ListResponsePensionScheme](docs/Model/ListResponsePensionScheme.md)
 - [ListResponsePerDiemCompensation](docs/Model/ListResponsePerDiemCompensation.md)
 - [ListResponsePerDiemCompensationTransientDTO](docs/Model/ListResponsePerDiemCompensationTransientDTO.md)
 - [ListResponsePerson1881EntityDTO](docs/Model/ListResponsePerson1881EntityDTO.md)
 - [ListResponsePersonAutoCompleteDTO](docs/Model/ListResponsePersonAutoCompleteDTO.md)
 - [ListResponsePhonePrefixCountryInternal](docs/Model/ListResponsePhonePrefixCountryInternal.md)
 - [ListResponsePickupPoint](docs/Model/ListResponsePickupPoint.md)
 - [ListResponsePosting](docs/Model/ListResponsePosting.md)
 - [ListResponseProduct](docs/Model/ListResponseProduct.md)
 - [ListResponseProductGroup](docs/Model/ListResponseProductGroup.md)
 - [ListResponseProductGroupRelation](docs/Model/ListResponseProductGroupRelation.md)
 - [ListResponseProductImportHeader](docs/Model/ListResponseProductImportHeader.md)
 - [ListResponseProductImportHeaderFieldsRelation](docs/Model/ListResponseProductImportHeaderFieldsRelation.md)
 - [ListResponseProductInventoryLocation](docs/Model/ListResponseProductInventoryLocation.md)
 - [ListResponseProductLine](docs/Model/ListResponseProductLine.md)
 - [ListResponseProductPrice](docs/Model/ListResponseProductPrice.md)
 - [ListResponseProductUnit](docs/Model/ListResponseProductUnit.md)
 - [ListResponseProductUnitMaster](docs/Model/ListResponseProductUnitMaster.md)
 - [ListResponseProject](docs/Model/ListResponseProject.md)
 - [ListResponseProjectCategory](docs/Model/ListResponseProjectCategory.md)
 - [ListResponseProjectControlForm](docs/Model/ListResponseProjectControlForm.md)
 - [ListResponseProjectControlFormType](docs/Model/ListResponseProjectControlFormType.md)
 - [ListResponseProjectHourlyRate](docs/Model/ListResponseProjectHourlyRate.md)
 - [ListResponseProjectInvoiceDetails](docs/Model/ListResponseProjectInvoiceDetails.md)
 - [ListResponseProjectOrderLine](docs/Model/ListResponseProjectOrderLine.md)
 - [ListResponseProjectOverviewAggregate](docs/Model/ListResponseProjectOverviewAggregate.md)
 - [ListResponseProjectParticipant](docs/Model/ListResponseProjectParticipant.md)
 - [ListResponseProjectPeriodMonthlyStatus](docs/Model/ListResponseProjectPeriodMonthlyStatus.md)
 - [ListResponseProjectSpecificRate](docs/Model/ListResponseProjectSpecificRate.md)
 - [ListResponseProspect](docs/Model/ListResponseProspect.md)
 - [ListResponsePurchaseOrder](docs/Model/ListResponsePurchaseOrder.md)
 - [ListResponsePurchaseOrderAddress](docs/Model/ListResponsePurchaseOrderAddress.md)
 - [ListResponsePurchaseOrderIncomingInvoiceRelation](docs/Model/ListResponsePurchaseOrderIncomingInvoiceRelation.md)
 - [ListResponsePurchaseOrderline](docs/Model/ListResponsePurchaseOrderline.md)
 - [ListResponseRP2EmployeeAvailableTime](docs/Model/ListResponseRP2EmployeeAvailableTime.md)
 - [ListResponseRP2EmployeeBookedTime](docs/Model/ListResponseRP2EmployeeBookedTime.md)
 - [ListResponseRP2EmployeeJob](docs/Model/ListResponseRP2EmployeeJob.md)
 - [ListResponseRP2ProjectBookedTime](docs/Model/ListResponseRP2ProjectBookedTime.md)
 - [ListResponseRP2ProjectJob](docs/Model/ListResponseRP2ProjectJob.md)
 - [ListResponseRP2TotalTime](docs/Model/ListResponseRP2TotalTime.md)
 - [ListResponseRPJob](docs/Model/ListResponseRPJob.md)
 - [ListResponseReelDomainDTO](docs/Model/ListResponseReelDomainDTO.md)
 - [ListResponseReelFunctionDTO](docs/Model/ListResponseReelFunctionDTO.md)
 - [ListResponseReminder](docs/Model/ListResponseReminder.md)
 - [ListResponseRemunerationType](docs/Model/ListResponseRemunerationType.md)
 - [ListResponseReport](docs/Model/ListResponseReport.md)
 - [ListResponseReportAccess](docs/Model/ListResponseReportAccess.md)
 - [ListResponseReportAuthorization](docs/Model/ListResponseReportAuthorization.md)
 - [ListResponseReportClientAccess](docs/Model/ListResponseReportClientAccess.md)
 - [ListResponseReportingCompanyInternal](docs/Model/ListResponseReportingCompanyInternal.md)
 - [ListResponseResultBudget](docs/Model/ListResponseResultBudget.md)
 - [ListResponseRiskFreeInterestRate](docs/Model/ListResponseRiskFreeInterestRate.md)
 - [ListResponseSalarySpecification](docs/Model/ListResponseSalarySpecification.md)
 - [ListResponseSalaryTransaction](docs/Model/ListResponseSalaryTransaction.md)
 - [ListResponseSalaryType](docs/Model/ListResponseSalaryType.md)
 - [ListResponseSalaryV2Type](docs/Model/ListResponseSalaryV2Type.md)
 - [ListResponseSalesForceAccountInfo](docs/Model/ListResponseSalesForceAccountInfo.md)
 - [ListResponseSalesForceAccountantConnection](docs/Model/ListResponseSalesForceAccountantConnection.md)
 - [ListResponseSalesForceEmployee](docs/Model/ListResponseSalesForceEmployee.md)
 - [ListResponseSalesModuleDTO](docs/Model/ListResponseSalesModuleDTO.md)
 - [ListResponseSearchCompletionDTO](docs/Model/ListResponseSearchCompletionDTO.md)
 - [ListResponseSignatureCombinationDTO](docs/Model/ListResponseSignatureCombinationDTO.md)
 - [ListResponseStandardTime](docs/Model/ListResponseStandardTime.md)
 - [ListResponseStocktaking](docs/Model/ListResponseStocktaking.md)
 - [ListResponseSubscription](docs/Model/ListResponseSubscription.md)
 - [ListResponseSupplier](docs/Model/ListResponseSupplier.md)
 - [ListResponseSupplierAutomation](docs/Model/ListResponseSupplierAutomation.md)
 - [ListResponseSupplierBalance](docs/Model/ListResponseSupplierBalance.md)
 - [ListResponseSupplierInvoice](docs/Model/ListResponseSupplierInvoice.md)
 - [ListResponseSupplierProduct](docs/Model/ListResponseSupplierProduct.md)
 - [ListResponseSystemReportCategoryDTO](docs/Model/ListResponseSystemReportCategoryDTO.md)
 - [ListResponseTask](docs/Model/ListResponseTask.md)
 - [ListResponseTaxcardContactInternal](docs/Model/ListResponseTaxcardContactInternal.md)
 - [ListResponseTaxcardEmployeeInternal](docs/Model/ListResponseTaxcardEmployeeInternal.md)
 - [ListResponseTemplate](docs/Model/ListResponseTemplate.md)
 - [ListResponseTimeClock](docs/Model/ListResponseTimeClock.md)
 - [ListResponseTimesheetAllocated](docs/Model/ListResponseTimesheetAllocated.md)
 - [ListResponseTimesheetEntry](docs/Model/ListResponseTimesheetEntry.md)
 - [ListResponseTimesheetProjectSalaryTypeSpecification](docs/Model/ListResponseTimesheetProjectSalaryTypeSpecification.md)
 - [ListResponseTimesheetSalaryTypeSpecification](docs/Model/ListResponseTimesheetSalaryTypeSpecification.md)
 - [ListResponseTodoListComment](docs/Model/ListResponseTodoListComment.md)
 - [ListResponseTransportType](docs/Model/ListResponseTransportType.md)
 - [ListResponseTravelCostCategory](docs/Model/ListResponseTravelCostCategory.md)
 - [ListResponseTravelExpense](docs/Model/ListResponseTravelExpense.md)
 - [ListResponseTravelExpenseRate](docs/Model/ListResponseTravelExpenseRate.md)
 - [ListResponseTravelExpenseRateCategory](docs/Model/ListResponseTravelExpenseRateCategory.md)
 - [ListResponseTravelExpenseRateCategoryGroup](docs/Model/ListResponseTravelExpenseRateCategoryGroup.md)
 - [ListResponseTravelExpenseZone](docs/Model/ListResponseTravelExpenseZone.md)
 - [ListResponseTravelPaymentType](docs/Model/ListResponseTravelPaymentType.md)
 - [ListResponseTripletexCompanyModules](docs/Model/ListResponseTripletexCompanyModules.md)
 - [ListResponseUpsaleMetric](docs/Model/ListResponseUpsaleMetric.md)
 - [ListResponseUserTemplate](docs/Model/ListResponseUserTemplate.md)
 - [ListResponseVFFactoringInvoiceOffer](docs/Model/ListResponseVFFactoringInvoiceOffer.md)
 - [ListResponseVatReturnsComment](docs/Model/ListResponseVatReturnsComment.md)
 - [ListResponseVatReturnsVatCodeComment](docs/Model/ListResponseVatReturnsVatCodeComment.md)
 - [ListResponseVatTermPeriod](docs/Model/ListResponseVatTermPeriod.md)
 - [ListResponseVatType](docs/Model/ListResponseVatType.md)
 - [ListResponseVoucher](docs/Model/ListResponseVoucher.md)
 - [ListResponseVoucherInboxItem](docs/Model/ListResponseVoucherInboxItem.md)
 - [ListResponseVoucherInternal](docs/Model/ListResponseVoucherInternal.md)
 - [ListResponseVoucherMessage](docs/Model/ListResponseVoucherMessage.md)
 - [ListResponseVoucherStatus](docs/Model/ListResponseVoucherStatus.md)
 - [ListResponseVoucherType](docs/Model/ListResponseVoucherType.md)
 - [ListResponseWeek](docs/Model/ListResponseWeek.md)
 - [ListResponseWorkingHoursScheme](docs/Model/ListResponseWorkingHoursScheme.md)
 - [ListResponseZendeskSearchResultDTO](docs/Model/ListResponseZendeskSearchResultDTO.md)
 - [ListResponseZtlAccount](docs/Model/ListResponseZtlAccount.md)
 - [ListResponseZtlConsent](docs/Model/ListResponseZtlConsent.md)
 - [ListResponseZtlOnboarding](docs/Model/ListResponseZtlOnboarding.md)
 - [LoggedInUserInfoDTO](docs/Model/LoggedInUserInfoDTO.md)
 - [LogisticsSettings](docs/Model/LogisticsSettings.md)
 - [Mapping](docs/Model/Mapping.md)
 - [MaritimeEmployment](docs/Model/MaritimeEmployment.md)
 - [MaventaEventDataDTO](docs/Model/MaventaEventDataDTO.md)
 - [MaventaStatusDTO](docs/Model/MaventaStatusDTO.md)
 - [MediaType](docs/Model/MediaType.md)
 - [Menu](docs/Model/Menu.md)
 - [MenuItem](docs/Model/MenuItem.md)
 - [MessageBodyWorkers](docs/Model/MessageBodyWorkers.md)
 - [MileageAllowance](docs/Model/MileageAllowance.md)
 - [MobileAppLogin](docs/Model/MobileAppLogin.md)
 - [MobileAppSpecificRightsInfo](docs/Model/MobileAppSpecificRightsInfo.md)
 - [Modules](docs/Model/Modules.md)
 - [MonthlyStatus](docs/Model/MonthlyStatus.md)
 - [MultiPart](docs/Model/MultiPart.md)
 - [Municipality](docs/Model/Municipality.md)
 - [MySubscriptionAccountInfoDTO](docs/Model/MySubscriptionAccountInfoDTO.md)
 - [MySubscriptionModuleDTO](docs/Model/MySubscriptionModuleDTO.md)
 - [News](docs/Model/News.md)
 - [NextOfKin](docs/Model/NextOfKin.md)
 - [NoteContainer](docs/Model/NoteContainer.md)
 - [NoteOverview](docs/Model/NoteOverview.md)
 - [NoteTextLibrary](docs/Model/NoteTextLibrary.md)
 - [Notification](docs/Model/Notification.md)
 - [OccupationCode](docs/Model/OccupationCode.md)
 - [OnboardAccountDTO](docs/Model/OnboardAccountDTO.md)
 - [OpeningBalance](docs/Model/OpeningBalance.md)
 - [OpeningBalanceBalancePosting](docs/Model/OpeningBalanceBalancePosting.md)
 - [OpeningBalanceCustomerPosting](docs/Model/OpeningBalanceCustomerPosting.md)
 - [OpeningBalanceEmployeePosting](docs/Model/OpeningBalanceEmployeePosting.md)
 - [OpeningBalanceSupplierPosting](docs/Model/OpeningBalanceSupplierPosting.md)
 - [Order](docs/Model/Order.md)
 - [OrderGroup](docs/Model/OrderGroup.md)
 - [OrderLine](docs/Model/OrderLine.md)
 - [OrderLinePostingDTO](docs/Model/OrderLinePostingDTO.md)
 - [OrderOffer](docs/Model/OrderOffer.md)
 - [OutgoingStock](docs/Model/OutgoingStock.md)
 - [PGCallbackDTO](docs/Model/PGCallbackDTO.md)
 - [PageOptions](docs/Model/PageOptions.md)
 - [ParameterizedHeader](docs/Model/ParameterizedHeader.md)
 - [Passenger](docs/Model/Passenger.md)
 - [PaymentDTO](docs/Model/PaymentDTO.md)
 - [PaymentType](docs/Model/PaymentType.md)
 - [PaymentTypeOut](docs/Model/PaymentTypeOut.md)
 - [PaymentWidgetPaymentType](docs/Model/PaymentWidgetPaymentType.md)
 - [Payslip](docs/Model/Payslip.md)
 - [PdfFileNameBody](docs/Model/PdfFileNameBody.md)
 - [PensionScheme](docs/Model/PensionScheme.md)
 - [PerDiemCompensation](docs/Model/PerDiemCompensation.md)
 - [PerDiemCompensationTransientDTO](docs/Model/PerDiemCompensationTransientDTO.md)
 - [PermanentDifferences](docs/Model/PermanentDifferences.md)
 - [Person1881EntityDTO](docs/Model/Person1881EntityDTO.md)
 - [PersonAutoCompleteDTO](docs/Model/PersonAutoCompleteDTO.md)
 - [PersonalIncome](docs/Model/PersonalIncome.md)
 - [PersonalIncomeOverview](docs/Model/PersonalIncomeOverview.md)
 - [PhonePrefixCountryInternal](docs/Model/PhonePrefixCountryInternal.md)
 - [PickupPoint](docs/Model/PickupPoint.md)
 - [Posting](docs/Model/Posting.md)
 - [Prediction](docs/Model/Prediction.md)
 - [PrepareTaxcardsArgsInternal](docs/Model/PrepareTaxcardsArgsInternal.md)
 - [Price](docs/Model/Price.md)
 - [Product](docs/Model/Product.md)
 - [ProductGroup](docs/Model/ProductGroup.md)
 - [ProductGroupRelation](docs/Model/ProductGroupRelation.md)
 - [ProductIdBody](docs/Model/ProductIdBody.md)
 - [ProductImport](docs/Model/ProductImport.md)
 - [ProductImportFieldDTO](docs/Model/ProductImportFieldDTO.md)
 - [ProductImportHeader](docs/Model/ProductImportHeader.md)
 - [ProductImportHeaderFieldsRelation](docs/Model/ProductImportHeaderFieldsRelation.md)
 - [ProductInventoryLocation](docs/Model/ProductInventoryLocation.md)
 - [ProductLine](docs/Model/ProductLine.md)
 - [ProductPrice](docs/Model/ProductPrice.md)
 - [ProductSettings](docs/Model/ProductSettings.md)
 - [ProductUnit](docs/Model/ProductUnit.md)
 - [ProductUnitMaster](docs/Model/ProductUnitMaster.md)
 - [ProfileDTO](docs/Model/ProfileDTO.md)
 - [ProfileLoginCompany](docs/Model/ProfileLoginCompany.md)
 - [ProfitAndLoss](docs/Model/ProfitAndLoss.md)
 - [Project](docs/Model/Project.md)
 - [ProjectAccess](docs/Model/ProjectAccess.md)
 - [ProjectActivity](docs/Model/ProjectActivity.md)
 - [ProjectBudgetStatus](docs/Model/ProjectBudgetStatus.md)
 - [ProjectCategory](docs/Model/ProjectCategory.md)
 - [ProjectControlForm](docs/Model/ProjectControlForm.md)
 - [ProjectControlFormType](docs/Model/ProjectControlFormType.md)
 - [ProjectHourlyRate](docs/Model/ProjectHourlyRate.md)
 - [ProjectHourlyRateTemplate](docs/Model/ProjectHourlyRateTemplate.md)
 - [ProjectIdBody](docs/Model/ProjectIdBody.md)
 - [ProjectImportBody](docs/Model/ProjectImportBody.md)
 - [ProjectInvoiceDetails](docs/Model/ProjectInvoiceDetails.md)
 - [ProjectOnboardingSummaryDTO](docs/Model/ProjectOnboardingSummaryDTO.md)
 - [ProjectOrderLine](docs/Model/ProjectOrderLine.md)
 - [ProjectOverviewAggregate](docs/Model/ProjectOverviewAggregate.md)
 - [ProjectParticipant](docs/Model/ProjectParticipant.md)
 - [ProjectPeriodHourlyReport](docs/Model/ProjectPeriodHourlyReport.md)
 - [ProjectPeriodInvoiced](docs/Model/ProjectPeriodInvoiced.md)
 - [ProjectPeriodInvoicingReserve](docs/Model/ProjectPeriodInvoicingReserve.md)
 - [ProjectPeriodMonthlyStatus](docs/Model/ProjectPeriodMonthlyStatus.md)
 - [ProjectPeriodOverallStatus](docs/Model/ProjectPeriodOverallStatus.md)
 - [ProjectSettings](docs/Model/ProjectSettings.md)
 - [ProjectSpecificRate](docs/Model/ProjectSpecificRate.md)
 - [ProjectSpecificRateTemplate](docs/Model/ProjectSpecificRateTemplate.md)
 - [ProjectTemplate](docs/Model/ProjectTemplate.md)
 - [Prospect](docs/Model/Prospect.md)
 - [ProspectIdBody](docs/Model/ProspectIdBody.md)
 - [Providers](docs/Model/Providers.md)
 - [PurchaseOrder](docs/Model/PurchaseOrder.md)
 - [PurchaseOrderAddress](docs/Model/PurchaseOrderAddress.md)
 - [PurchaseOrderIncomingInvoiceRelation](docs/Model/PurchaseOrderIncomingInvoiceRelation.md)
 - [PurchaseOrderline](docs/Model/PurchaseOrderline.md)
 - [RP2EmployeeAvailableTime](docs/Model/RP2EmployeeAvailableTime.md)
 - [RP2EmployeeBookedTime](docs/Model/RP2EmployeeBookedTime.md)
 - [RP2EmployeeJob](docs/Model/RP2EmployeeJob.md)
 - [RP2EmployeeJobMoveResponse](docs/Model/RP2EmployeeJobMoveResponse.md)
 - [RP2JobPatchTemplate](docs/Model/RP2JobPatchTemplate.md)
 - [RP2JobTemplate](docs/Model/RP2JobTemplate.md)
 - [RP2PermissionsDTO](docs/Model/RP2PermissionsDTO.md)
 - [RP2ProjectBookedTime](docs/Model/RP2ProjectBookedTime.md)
 - [RP2ProjectJob](docs/Model/RP2ProjectJob.md)
 - [RP2ProjectJobMoveResponse](docs/Model/RP2ProjectJobMoveResponse.md)
 - [RP2TotalTime](docs/Model/RP2TotalTime.md)
 - [RPJob](docs/Model/RPJob.md)
 - [RPViewDTO](docs/Model/RPViewDTO.md)
 - [ReconciliationOfEquityOverview](docs/Model/ReconciliationOfEquityOverview.md)
 - [ReelDocumentationDTO](docs/Model/ReelDocumentationDTO.md)
 - [ReelDomainDTO](docs/Model/ReelDomainDTO.md)
 - [ReelFunctionDTO](docs/Model/ReelFunctionDTO.md)
 - [RegulatoryReportingCode](docs/Model/RegulatoryReportingCode.md)
 - [Reminder](docs/Model/Reminder.md)
 - [ReminderDTO](docs/Model/ReminderDTO.md)
 - [ReminderWidgetDTO](docs/Model/ReminderWidgetDTO.md)
 - [ReminderWidgetData](docs/Model/ReminderWidgetData.md)
 - [RemunerationType](docs/Model/RemunerationType.md)
 - [Report](docs/Model/Report.md)
 - [ReportAccess](docs/Model/ReportAccess.md)
 - [ReportAuthorization](docs/Model/ReportAuthorization.md)
 - [ReportBlueprintV1](docs/Model/ReportBlueprintV1.md)
 - [ReportClientAccess](docs/Model/ReportClientAccess.md)
 - [ReportFilterAccountV3](docs/Model/ReportFilterAccountV3.md)
 - [ReportFilterActivity](docs/Model/ReportFilterActivity.md)
 - [ReportFilterCustomer](docs/Model/ReportFilterCustomer.md)
 - [ReportFilterDepartment](docs/Model/ReportFilterDepartment.md)
 - [ReportFilterEmployee](docs/Model/ReportFilterEmployee.md)
 - [ReportFilterGeneral](docs/Model/ReportFilterGeneral.md)
 - [ReportFilterPeriod](docs/Model/ReportFilterPeriod.md)
 - [ReportFilterPeriodDatum](docs/Model/ReportFilterPeriodDatum.md)
 - [ReportFilterProduct](docs/Model/ReportFilterProduct.md)
 - [ReportFilterProject](docs/Model/ReportFilterProject.md)
 - [ReportFilterRange](docs/Model/ReportFilterRange.md)
 - [ReportFilterSingular](docs/Model/ReportFilterSingular.md)
 - [ReportFilterSupplier](docs/Model/ReportFilterSupplier.md)
 - [ReportGroupAutoGroup](docs/Model/ReportGroupAutoGroup.md)
 - [ReportGroupAutoGroupOrderBy](docs/Model/ReportGroupAutoGroupOrderBy.md)
 - [ReportGroupFilter](docs/Model/ReportGroupFilter.md)
 - [ReportResult](docs/Model/ReportResult.md)
 - [ReportResultCell](docs/Model/ReportResultCell.md)
 - [ReportResultCellValue](docs/Model/ReportResultCellValue.md)
 - [ReportResultColumnHeader](docs/Model/ReportResultColumnHeader.md)
 - [ReportResultEnvelope](docs/Model/ReportResultEnvelope.md)
 - [ReportResultParameters](docs/Model/ReportResultParameters.md)
 - [ReportResultRowHeader](docs/Model/ReportResultRowHeader.md)
 - [ReportSettings](docs/Model/ReportSettings.md)
 - [ReportSettingsFilters](docs/Model/ReportSettingsFilters.md)
 - [ReportSettingsFiltersOptionsPeriod](docs/Model/ReportSettingsFiltersOptionsPeriod.md)
 - [ReportingCompanyInternal](docs/Model/ReportingCompanyInternal.md)
 - [RequestlogModel](docs/Model/RequestlogModel.md)
 - [ResourceMessages](docs/Model/ResourceMessages.md)
 - [ResourceMessagesArgs](docs/Model/ResourceMessagesArgs.md)
 - [ResourcePlanActivity](docs/Model/ResourcePlanActivity.md)
 - [ResourcePlanBudget](docs/Model/ResourcePlanBudget.md)
 - [ResourcePlanEmployee](docs/Model/ResourcePlanEmployee.md)
 - [ResourcePlanHours](docs/Model/ResourcePlanHours.md)
 - [ResponseWrapper](docs/Model/ResponseWrapper.md)
 - [ResponseWrapperAccommodationAllowance](docs/Model/ResponseWrapperAccommodationAllowance.md)
 - [ResponseWrapperAccommodationAndRestaurant](docs/Model/ResponseWrapperAccommodationAndRestaurant.md)
 - [ResponseWrapperAccount](docs/Model/ResponseWrapperAccount.md)
 - [ResponseWrapperAccountClosureFeedback](docs/Model/ResponseWrapperAccountClosureFeedback.md)
 - [ResponseWrapperAccountSpecification](docs/Model/ResponseWrapperAccountSpecification.md)
 - [ResponseWrapperAccountingPeriod](docs/Model/ResponseWrapperAccountingPeriod.md)
 - [ResponseWrapperActivity](docs/Model/ResponseWrapperActivity.md)
 - [ResponseWrapperAdditionalServiceOrderLineDTO_](docs/Model/ResponseWrapperAdditionalServiceOrderLineDTO_.md)
 - [ResponseWrapperAddon](docs/Model/ResponseWrapperAddon.md)
 - [ResponseWrapperAddonStatusType](docs/Model/ResponseWrapperAddonStatusType.md)
 - [ResponseWrapperAdvancedPaymentWidget](docs/Model/ResponseWrapperAdvancedPaymentWidget.md)
 - [ResponseWrapperAltinnCompanyModule](docs/Model/ResponseWrapperAltinnCompanyModule.md)
 - [ResponseWrapperAltinnInstance](docs/Model/ResponseWrapperAltinnInstance.md)
 - [ResponseWrapperAnnualAccount](docs/Model/ResponseWrapperAnnualAccount.md)
 - [ResponseWrapperApiConsumer](docs/Model/ResponseWrapperApiConsumer.md)
 - [ResponseWrapperApproveResponseDTO](docs/Model/ResponseWrapperApproveResponseDTO.md)
 - [ResponseWrapperAprilaCashCreditApplicationResponseDTO](docs/Model/ResponseWrapperAprilaCashCreditApplicationResponseDTO.md)
 - [ResponseWrapperArchiveModelTypes](docs/Model/ResponseWrapperArchiveModelTypes.md)
 - [ResponseWrapperAsset](docs/Model/ResponseWrapperAsset.md)
 - [ResponseWrapperAssetOverview](docs/Model/ResponseWrapperAssetOverview.md)
 - [ResponseWrapperAuthConfigDTO](docs/Model/ResponseWrapperAuthConfigDTO.md)
 - [ResponseWrapperAutoLogin](docs/Model/ResponseWrapperAutoLogin.md)
 - [ResponseWrapperAutoPayStatus](docs/Model/ResponseWrapperAutoPayStatus.md)
 - [ResponseWrapperAutomationSettingsDTO](docs/Model/ResponseWrapperAutomationSettingsDTO.md)
 - [ResponseWrapperBalanceSheet](docs/Model/ResponseWrapperBalanceSheet.md)
 - [ResponseWrapperBalanceSheetSettingsDTO](docs/Model/ResponseWrapperBalanceSheetSettingsDTO.md)
 - [ResponseWrapperBank](docs/Model/ResponseWrapperBank.md)
 - [ResponseWrapperBankAgreementDTO](docs/Model/ResponseWrapperBankAgreementDTO.md)
 - [ResponseWrapperBankBalanceEstimation](docs/Model/ResponseWrapperBankBalanceEstimation.md)
 - [ResponseWrapperBankDashboardAdvice](docs/Model/ResponseWrapperBankDashboardAdvice.md)
 - [ResponseWrapperBankOnboardingDTO](docs/Model/ResponseWrapperBankOnboardingDTO.md)
 - [ResponseWrapperBankReconciliation](docs/Model/ResponseWrapperBankReconciliation.md)
 - [ResponseWrapperBankReconciliationMatch](docs/Model/ResponseWrapperBankReconciliationMatch.md)
 - [ResponseWrapperBankReconciliationMatchesCounter](docs/Model/ResponseWrapperBankReconciliationMatchesCounter.md)
 - [ResponseWrapperBankReconciliationPaymentType](docs/Model/ResponseWrapperBankReconciliationPaymentType.md)
 - [ResponseWrapperBankReconciliationSettings](docs/Model/ResponseWrapperBankReconciliationSettings.md)
 - [ResponseWrapperBankSettings](docs/Model/ResponseWrapperBankSettings.md)
 - [ResponseWrapperBankStatement](docs/Model/ResponseWrapperBankStatement.md)
 - [ResponseWrapperBankStatementBalance](docs/Model/ResponseWrapperBankStatementBalance.md)
 - [ResponseWrapperBankTransaction](docs/Model/ResponseWrapperBankTransaction.md)
 - [ResponseWrapperBankTransactionAggregates](docs/Model/ResponseWrapperBankTransactionAggregates.md)
 - [ResponseWrapperBanner](docs/Model/ResponseWrapperBanner.md)
 - [ResponseWrapperBasicData](docs/Model/ResponseWrapperBasicData.md)
 - [ResponseWrapperBigDecimal](docs/Model/ResponseWrapperBigDecimal.md)
 - [ResponseWrapperBoolean](docs/Model/ResponseWrapperBoolean.md)
 - [ResponseWrapperBringCredentials](docs/Model/ResponseWrapperBringCredentials.md)
 - [ResponseWrapperChecklist](docs/Model/ResponseWrapperChecklist.md)
 - [ResponseWrapperCheckout](docs/Model/ResponseWrapperCheckout.md)
 - [ResponseWrapperClientAccessTemplate](docs/Model/ResponseWrapperClientAccessTemplate.md)
 - [ResponseWrapperCloseGroup](docs/Model/ResponseWrapperCloseGroup.md)
 - [ResponseWrapperComment](docs/Model/ResponseWrapperComment.md)
 - [ResponseWrapperCommercialVehicle](docs/Model/ResponseWrapperCommercialVehicle.md)
 - [ResponseWrapperCompany](docs/Model/ResponseWrapperCompany.md)
 - [ResponseWrapperCompanyAuthorityDTO](docs/Model/ResponseWrapperCompanyAuthorityDTO.md)
 - [ResponseWrapperCompanyChooserDTO](docs/Model/ResponseWrapperCompanyChooserDTO.md)
 - [ResponseWrapperCompanyHoliday](docs/Model/ResponseWrapperCompanyHoliday.md)
 - [ResponseWrapperCompanyHolidays](docs/Model/ResponseWrapperCompanyHolidays.md)
 - [ResponseWrapperCompanyStandardTime](docs/Model/ResponseWrapperCompanyStandardTime.md)
 - [ResponseWrapperConsumerToken](docs/Model/ResponseWrapperConsumerToken.md)
 - [ResponseWrapperContact](docs/Model/ResponseWrapperContact.md)
 - [ResponseWrapperCost](docs/Model/ResponseWrapperCost.md)
 - [ResponseWrapperCountry](docs/Model/ResponseWrapperCountry.md)
 - [ResponseWrapperCurrency](docs/Model/ResponseWrapperCurrency.md)
 - [ResponseWrapperCurrencyExchangeRate](docs/Model/ResponseWrapperCurrencyExchangeRate.md)
 - [ResponseWrapperCustomer](docs/Model/ResponseWrapperCustomer.md)
 - [ResponseWrapperCustomerCategory](docs/Model/ResponseWrapperCustomerCategory.md)
 - [ResponseWrapperCustomerReceivable](docs/Model/ResponseWrapperCustomerReceivable.md)
 - [ResponseWrapperCustomizedChecklistProperty](docs/Model/ResponseWrapperCustomizedChecklistProperty.md)
 - [ResponseWrapperDashboardContextDTO](docs/Model/ResponseWrapperDashboardContextDTO.md)
 - [ResponseWrapperDashboardDTO](docs/Model/ResponseWrapperDashboardDTO.md)
 - [ResponseWrapperDate](docs/Model/ResponseWrapperDate.md)
 - [ResponseWrapperDeliveryAddress](docs/Model/ResponseWrapperDeliveryAddress.md)
 - [ResponseWrapperDepartment](docs/Model/ResponseWrapperDepartment.md)
 - [ResponseWrapperDeviation](docs/Model/ResponseWrapperDeviation.md)
 - [ResponseWrapperDifferencesOverview](docs/Model/ResponseWrapperDifferencesOverview.md)
 - [ResponseWrapperDiscountGroup](docs/Model/ResponseWrapperDiscountGroup.md)
 - [ResponseWrapperDisposition](docs/Model/ResponseWrapperDisposition.md)
 - [ResponseWrapperDistributionKey](docs/Model/ResponseWrapperDistributionKey.md)
 - [ResponseWrapperDividend](docs/Model/ResponseWrapperDividend.md)
 - [ResponseWrapperDivision](docs/Model/ResponseWrapperDivision.md)
 - [ResponseWrapperDocument](docs/Model/ResponseWrapperDocument.md)
 - [ResponseWrapperDocumentArchive](docs/Model/ResponseWrapperDocumentArchive.md)
 - [ResponseWrapperDownloadedBrreg](docs/Model/ResponseWrapperDownloadedBrreg.md)
 - [ResponseWrapperDrivingStop](docs/Model/ResponseWrapperDrivingStop.md)
 - [ResponseWrapperElectronicSupportDTO](docs/Model/ResponseWrapperElectronicSupportDTO.md)
 - [ResponseWrapperEmployee](docs/Model/ResponseWrapperEmployee.md)
 - [ResponseWrapperEmployeeCategory](docs/Model/ResponseWrapperEmployeeCategory.md)
 - [ResponseWrapperEmployeeLoginInfo](docs/Model/ResponseWrapperEmployeeLoginInfo.md)
 - [ResponseWrapperEmployeePreferences](docs/Model/ResponseWrapperEmployeePreferences.md)
 - [ResponseWrapperEmployeeToken](docs/Model/ResponseWrapperEmployeeToken.md)
 - [ResponseWrapperEmployeeTokenBundle](docs/Model/ResponseWrapperEmployeeTokenBundle.md)
 - [ResponseWrapperEmployment](docs/Model/ResponseWrapperEmployment.md)
 - [ResponseWrapperEmploymentDetails](docs/Model/ResponseWrapperEmploymentDetails.md)
 - [ResponseWrapperEntitlement](docs/Model/ResponseWrapperEntitlement.md)
 - [ResponseWrapperEventInfoDTO](docs/Model/ResponseWrapperEventInfoDTO.md)
 - [ResponseWrapperExternalProduct](docs/Model/ResponseWrapperExternalProduct.md)
 - [ResponseWrapperFavoriteMenu](docs/Model/ResponseWrapperFavoriteMenu.md)
 - [ResponseWrapperFundingPartnerApplication](docs/Model/ResponseWrapperFundingPartnerApplication.md)
 - [ResponseWrapperFundingPartnerQualify](docs/Model/ResponseWrapperFundingPartnerQualify.md)
 - [ResponseWrapperGenericDataOverview](docs/Model/ResponseWrapperGenericDataOverview.md)
 - [ResponseWrapperGoodsReceipt](docs/Model/ResponseWrapperGoodsReceipt.md)
 - [ResponseWrapperGoodsReceiptLine](docs/Model/ResponseWrapperGoodsReceiptLine.md)
 - [ResponseWrapperGroupContributions](docs/Model/ResponseWrapperGroupContributions.md)
 - [ResponseWrapperHelpCenterArticles](docs/Model/ResponseWrapperHelpCenterArticles.md)
 - [ResponseWrapperHistoricalPosting](docs/Model/ResponseWrapperHistoricalPosting.md)
 - [ResponseWrapperHourlyCostAndRate](docs/Model/ResponseWrapperHourlyCostAndRate.md)
 - [ResponseWrapperIdPortenLogin](docs/Model/ResponseWrapperIdPortenLogin.md)
 - [ResponseWrapperIdPortenLoginStatus](docs/Model/ResponseWrapperIdPortenLoginStatus.md)
 - [ResponseWrapperInboxData](docs/Model/ResponseWrapperInboxData.md)
 - [ResponseWrapperIncomeAndCostSummaryDTO](docs/Model/ResponseWrapperIncomeAndCostSummaryDTO.md)
 - [ResponseWrapperIncomeStatement](docs/Model/ResponseWrapperIncomeStatement.md)
 - [ResponseWrapperIncomingInvoicePaymentHistory](docs/Model/ResponseWrapperIncomingInvoicePaymentHistory.md)
 - [ResponseWrapperInteger](docs/Model/ResponseWrapperInteger.md)
 - [ResponseWrapperIntegrationData](docs/Model/ResponseWrapperIntegrationData.md)
 - [ResponseWrapperInventoriesOverview](docs/Model/ResponseWrapperInventoriesOverview.md)
 - [ResponseWrapperInventory](docs/Model/ResponseWrapperInventory.md)
 - [ResponseWrapperInventoryLocation](docs/Model/ResponseWrapperInventoryLocation.md)
 - [ResponseWrapperInvoice](docs/Model/ResponseWrapperInvoice.md)
 - [ResponseWrapperInvoiceAndOrdersData](docs/Model/ResponseWrapperInvoiceAndOrdersData.md)
 - [ResponseWrapperInvoiceOrderLineDTO_](docs/Model/ResponseWrapperInvoiceOrderLineDTO_.md)
 - [ResponseWrapperInvoiceRemark](docs/Model/ResponseWrapperInvoiceRemark.md)
 - [ResponseWrapperInvoiceSendTypeDTO](docs/Model/ResponseWrapperInvoiceSendTypeDTO.md)
 - [ResponseWrapperInvoiceSettings](docs/Model/ResponseWrapperInvoiceSettings.md)
 - [ResponseWrapperInvoiceSummaryDTO](docs/Model/ResponseWrapperInvoiceSummaryDTO.md)
 - [ResponseWrapperInvoiceTemplateRenderer](docs/Model/ResponseWrapperInvoiceTemplateRenderer.md)
 - [ResponseWrapperLeaveOfAbsence](docs/Model/ResponseWrapperLeaveOfAbsence.md)
 - [ResponseWrapperLegacyAddress](docs/Model/ResponseWrapperLegacyAddress.md)
 - [ResponseWrapperLegacyProfileDTO](docs/Model/ResponseWrapperLegacyProfileDTO.md)
 - [ResponseWrapperLicenseDTO_](docs/Model/ResponseWrapperLicenseDTO_.md)
 - [ResponseWrapperListAccountantClientAccessModel](docs/Model/ResponseWrapperListAccountantClientAccessModel.md)
 - [ResponseWrapperListBankBalanceEstimation](docs/Model/ResponseWrapperListBankBalanceEstimation.md)
 - [ResponseWrapperListClientAccessTemplate](docs/Model/ResponseWrapperListClientAccessTemplate.md)
 - [ResponseWrapperListClientForApproval](docs/Model/ResponseWrapperListClientForApproval.md)
 - [ResponseWrapperListClientForRemit](docs/Model/ResponseWrapperListClientForRemit.md)
 - [ResponseWrapperListClientForReview](docs/Model/ResponseWrapperListClientForReview.md)
 - [ResponseWrapperListClientInbox](docs/Model/ResponseWrapperListClientInbox.md)
 - [ResponseWrapperListCompanyDTO](docs/Model/ResponseWrapperListCompanyDTO.md)
 - [ResponseWrapperListDocumentationGenericData](docs/Model/ResponseWrapperListDocumentationGenericData.md)
 - [ResponseWrapperListElectronicSupportDTO](docs/Model/ResponseWrapperListElectronicSupportDTO.md)
 - [ResponseWrapperListEmployment](docs/Model/ResponseWrapperListEmployment.md)
 - [ResponseWrapperListFileIdForIncomingPaymentsDTO](docs/Model/ResponseWrapperListFileIdForIncomingPaymentsDTO.md)
 - [ResponseWrapperListInteger](docs/Model/ResponseWrapperListInteger.md)
 - [ResponseWrapperListJob](docs/Model/ResponseWrapperListJob.md)
 - [ResponseWrapperListPersonalIncomeOverview](docs/Model/ResponseWrapperListPersonalIncomeOverview.md)
 - [ResponseWrapperListProductImportFieldDTO](docs/Model/ResponseWrapperListProductImportFieldDTO.md)
 - [ResponseWrapperListRegulatoryReportingCode](docs/Model/ResponseWrapperListRegulatoryReportingCode.md)
 - [ResponseWrapperListRoleCategoryContainerDTO](docs/Model/ResponseWrapperListRoleCategoryContainerDTO.md)
 - [ResponseWrapperListSalaryV2Employee](docs/Model/ResponseWrapperListSalaryV2Employee.md)
 - [ResponseWrapperListSalaryV2EmployeeToEmploymentsRelationship](docs/Model/ResponseWrapperListSalaryV2EmployeeToEmploymentsRelationship.md)
 - [ResponseWrapperListSalaryV2PaymentType](docs/Model/ResponseWrapperListSalaryV2PaymentType.md)
 - [ResponseWrapperListSalaryV2Voucher](docs/Model/ResponseWrapperListSalaryV2Voucher.md)
 - [ResponseWrapperListString](docs/Model/ResponseWrapperListString.md)
 - [ResponseWrapperListTodoListAmelding](docs/Model/ResponseWrapperListTodoListAmelding.md)
 - [ResponseWrapperListTodoListAnnualAccounts](docs/Model/ResponseWrapperListTodoListAnnualAccounts.md)
 - [ResponseWrapperListTodoListHarmonization](docs/Model/ResponseWrapperListTodoListHarmonization.md)
 - [ResponseWrapperListTodoListPeriodOverview](docs/Model/ResponseWrapperListTodoListPeriodOverview.md)
 - [ResponseWrapperListTodoListVat](docs/Model/ResponseWrapperListTodoListVat.md)
 - [ResponseWrapperListTodoListWageTransaction](docs/Model/ResponseWrapperListTodoListWageTransaction.md)
 - [ResponseWrapperLoggedInUserInfoDTO](docs/Model/ResponseWrapperLoggedInUserInfoDTO.md)
 - [ResponseWrapperLogisticsSettings](docs/Model/ResponseWrapperLogisticsSettings.md)
 - [ResponseWrapperLong](docs/Model/ResponseWrapperLong.md)
 - [ResponseWrapperMapFeatureBoolean](docs/Model/ResponseWrapperMapFeatureBoolean.md)
 - [ResponseWrapperMapIntegerTlxNumber](docs/Model/ResponseWrapperMapIntegerTlxNumber.md)
 - [ResponseWrapperMapPilotFeatureBoolean](docs/Model/ResponseWrapperMapPilotFeatureBoolean.md)
 - [ResponseWrapperMapStringBoolean](docs/Model/ResponseWrapperMapStringBoolean.md)
 - [ResponseWrapperMapStringEventInfoDescription](docs/Model/ResponseWrapperMapStringEventInfoDescription.md)
 - [ResponseWrapperMenu](docs/Model/ResponseWrapperMenu.md)
 - [ResponseWrapperMileageAllowance](docs/Model/ResponseWrapperMileageAllowance.md)
 - [ResponseWrapperMobileAppSpecificRightsInfo](docs/Model/ResponseWrapperMobileAppSpecificRightsInfo.md)
 - [ResponseWrapperModules](docs/Model/ResponseWrapperModules.md)
 - [ResponseWrapperMonthlyStatus](docs/Model/ResponseWrapperMonthlyStatus.md)
 - [ResponseWrapperMySubscriptionAccountInfoDTO](docs/Model/ResponseWrapperMySubscriptionAccountInfoDTO.md)
 - [ResponseWrapperMySubscriptionModuleDTO_](docs/Model/ResponseWrapperMySubscriptionModuleDTO_.md)
 - [ResponseWrapperNextOfKin](docs/Model/ResponseWrapperNextOfKin.md)
 - [ResponseWrapperNoteContainer](docs/Model/ResponseWrapperNoteContainer.md)
 - [ResponseWrapperNoteOverview](docs/Model/ResponseWrapperNoteOverview.md)
 - [ResponseWrapperNotification](docs/Model/ResponseWrapperNotification.md)
 - [ResponseWrapperObject](docs/Model/ResponseWrapperObject.md)
 - [ResponseWrapperOccupationCode](docs/Model/ResponseWrapperOccupationCode.md)
 - [ResponseWrapperOrder](docs/Model/ResponseWrapperOrder.md)
 - [ResponseWrapperOrderGroup](docs/Model/ResponseWrapperOrderGroup.md)
 - [ResponseWrapperOrderLine](docs/Model/ResponseWrapperOrderLine.md)
 - [ResponseWrapperOrderOffer](docs/Model/ResponseWrapperOrderOffer.md)
 - [ResponseWrapperPageOptions](docs/Model/ResponseWrapperPageOptions.md)
 - [ResponseWrapperPassenger](docs/Model/ResponseWrapperPassenger.md)
 - [ResponseWrapperPaymentDTO](docs/Model/ResponseWrapperPaymentDTO.md)
 - [ResponseWrapperPaymentType](docs/Model/ResponseWrapperPaymentType.md)
 - [ResponseWrapperPaymentTypeOut](docs/Model/ResponseWrapperPaymentTypeOut.md)
 - [ResponseWrapperPayslip](docs/Model/ResponseWrapperPayslip.md)
 - [ResponseWrapperPensionScheme](docs/Model/ResponseWrapperPensionScheme.md)
 - [ResponseWrapperPerDiemCompensation](docs/Model/ResponseWrapperPerDiemCompensation.md)
 - [ResponseWrapperPersonalIncomeOverview](docs/Model/ResponseWrapperPersonalIncomeOverview.md)
 - [ResponseWrapperPhonePrefixCountryInternal](docs/Model/ResponseWrapperPhonePrefixCountryInternal.md)
 - [ResponseWrapperPickupPoint](docs/Model/ResponseWrapperPickupPoint.md)
 - [ResponseWrapperPosting](docs/Model/ResponseWrapperPosting.md)
 - [ResponseWrapperProduct](docs/Model/ResponseWrapperProduct.md)
 - [ResponseWrapperProductGroup](docs/Model/ResponseWrapperProductGroup.md)
 - [ResponseWrapperProductGroupRelation](docs/Model/ResponseWrapperProductGroupRelation.md)
 - [ResponseWrapperProductImport](docs/Model/ResponseWrapperProductImport.md)
 - [ResponseWrapperProductInventoryLocation](docs/Model/ResponseWrapperProductInventoryLocation.md)
 - [ResponseWrapperProductLine](docs/Model/ResponseWrapperProductLine.md)
 - [ResponseWrapperProductSettings](docs/Model/ResponseWrapperProductSettings.md)
 - [ResponseWrapperProductUnit](docs/Model/ResponseWrapperProductUnit.md)
 - [ResponseWrapperProductUnitMaster](docs/Model/ResponseWrapperProductUnitMaster.md)
 - [ResponseWrapperProfileDTO](docs/Model/ResponseWrapperProfileDTO.md)
 - [ResponseWrapperProfitAndLoss](docs/Model/ResponseWrapperProfitAndLoss.md)
 - [ResponseWrapperProject](docs/Model/ResponseWrapperProject.md)
 - [ResponseWrapperProjectAccess](docs/Model/ResponseWrapperProjectAccess.md)
 - [ResponseWrapperProjectActivity](docs/Model/ResponseWrapperProjectActivity.md)
 - [ResponseWrapperProjectBudgetStatus](docs/Model/ResponseWrapperProjectBudgetStatus.md)
 - [ResponseWrapperProjectCategory](docs/Model/ResponseWrapperProjectCategory.md)
 - [ResponseWrapperProjectControlForm](docs/Model/ResponseWrapperProjectControlForm.md)
 - [ResponseWrapperProjectControlFormType](docs/Model/ResponseWrapperProjectControlFormType.md)
 - [ResponseWrapperProjectHourlyRate](docs/Model/ResponseWrapperProjectHourlyRate.md)
 - [ResponseWrapperProjectInvoiceDetails](docs/Model/ResponseWrapperProjectInvoiceDetails.md)
 - [ResponseWrapperProjectOnboardingSummaryDTO](docs/Model/ResponseWrapperProjectOnboardingSummaryDTO.md)
 - [ResponseWrapperProjectOrderLine](docs/Model/ResponseWrapperProjectOrderLine.md)
 - [ResponseWrapperProjectParticipant](docs/Model/ResponseWrapperProjectParticipant.md)
 - [ResponseWrapperProjectPeriodHourlyReport](docs/Model/ResponseWrapperProjectPeriodHourlyReport.md)
 - [ResponseWrapperProjectPeriodInvoiced](docs/Model/ResponseWrapperProjectPeriodInvoiced.md)
 - [ResponseWrapperProjectPeriodInvoicingReserve](docs/Model/ResponseWrapperProjectPeriodInvoicingReserve.md)
 - [ResponseWrapperProjectPeriodOverallStatus](docs/Model/ResponseWrapperProjectPeriodOverallStatus.md)
 - [ResponseWrapperProjectSettings](docs/Model/ResponseWrapperProjectSettings.md)
 - [ResponseWrapperProjectSpecificRate](docs/Model/ResponseWrapperProjectSpecificRate.md)
 - [ResponseWrapperProjectTemplate](docs/Model/ResponseWrapperProjectTemplate.md)
 - [ResponseWrapperProspect](docs/Model/ResponseWrapperProspect.md)
 - [ResponseWrapperPurchaseOrder](docs/Model/ResponseWrapperPurchaseOrder.md)
 - [ResponseWrapperPurchaseOrderAddress](docs/Model/ResponseWrapperPurchaseOrderAddress.md)
 - [ResponseWrapperPurchaseOrderIncomingInvoiceRelation](docs/Model/ResponseWrapperPurchaseOrderIncomingInvoiceRelation.md)
 - [ResponseWrapperPurchaseOrderline](docs/Model/ResponseWrapperPurchaseOrderline.md)
 - [ResponseWrapperRP2EmployeeJobMoveResponse](docs/Model/ResponseWrapperRP2EmployeeJobMoveResponse.md)
 - [ResponseWrapperRP2JobTemplate](docs/Model/ResponseWrapperRP2JobTemplate.md)
 - [ResponseWrapperRP2PermissionsDTO](docs/Model/ResponseWrapperRP2PermissionsDTO.md)
 - [ResponseWrapperRP2ProjectJobMoveResponse](docs/Model/ResponseWrapperRP2ProjectJobMoveResponse.md)
 - [ResponseWrapperRPJob](docs/Model/ResponseWrapperRPJob.md)
 - [ResponseWrapperRPViewDTO](docs/Model/ResponseWrapperRPViewDTO.md)
 - [ResponseWrapperReconciliationOfEquityOverview](docs/Model/ResponseWrapperReconciliationOfEquityOverview.md)
 - [ResponseWrapperReelDomainDTO](docs/Model/ResponseWrapperReelDomainDTO.md)
 - [ResponseWrapperReminder](docs/Model/ResponseWrapperReminder.md)
 - [ResponseWrapperReminderDTO](docs/Model/ResponseWrapperReminderDTO.md)
 - [ResponseWrapperReminderWidgetData](docs/Model/ResponseWrapperReminderWidgetData.md)
 - [ResponseWrapperReport](docs/Model/ResponseWrapperReport.md)
 - [ResponseWrapperReportAccess](docs/Model/ResponseWrapperReportAccess.md)
 - [ResponseWrapperReportAuthorization](docs/Model/ResponseWrapperReportAuthorization.md)
 - [ResponseWrapperReportResultEnvelope](docs/Model/ResponseWrapperReportResultEnvelope.md)
 - [ResponseWrapperResourceMessages](docs/Model/ResponseWrapperResourceMessages.md)
 - [ResponseWrapperResourcePlanBudget](docs/Model/ResponseWrapperResourcePlanBudget.md)
 - [ResponseWrapperResultBudget](docs/Model/ResponseWrapperResultBudget.md)
 - [ResponseWrapperSalaryCompilation](docs/Model/ResponseWrapperSalaryCompilation.md)
 - [ResponseWrapperSalarySettings](docs/Model/ResponseWrapperSalarySettings.md)
 - [ResponseWrapperSalarySpecification](docs/Model/ResponseWrapperSalarySpecification.md)
 - [ResponseWrapperSalarySummaryDTO](docs/Model/ResponseWrapperSalarySummaryDTO.md)
 - [ResponseWrapperSalaryTaxcardInternal](docs/Model/ResponseWrapperSalaryTaxcardInternal.md)
 - [ResponseWrapperSalaryTransaction](docs/Model/ResponseWrapperSalaryTransaction.md)
 - [ResponseWrapperSalaryType](docs/Model/ResponseWrapperSalaryType.md)
 - [ResponseWrapperSalaryV2Employee](docs/Model/ResponseWrapperSalaryV2Employee.md)
 - [ResponseWrapperSalaryV2Modules](docs/Model/ResponseWrapperSalaryV2Modules.md)
 - [ResponseWrapperSalaryV2Overview](docs/Model/ResponseWrapperSalaryV2Overview.md)
 - [ResponseWrapperSalaryV2OverviewData](docs/Model/ResponseWrapperSalaryV2OverviewData.md)
 - [ResponseWrapperSalaryV2Payment](docs/Model/ResponseWrapperSalaryV2Payment.md)
 - [ResponseWrapperSalaryV2Settings](docs/Model/ResponseWrapperSalaryV2Settings.md)
 - [ResponseWrapperSalaryV2Specification](docs/Model/ResponseWrapperSalaryV2Specification.md)
 - [ResponseWrapperSalaryV2Supplement](docs/Model/ResponseWrapperSalaryV2Supplement.md)
 - [ResponseWrapperSalaryV2Transaction](docs/Model/ResponseWrapperSalaryV2Transaction.md)
 - [ResponseWrapperSalaryV2TravelExpense](docs/Model/ResponseWrapperSalaryV2TravelExpense.md)
 - [ResponseWrapperSalaryV2Type](docs/Model/ResponseWrapperSalaryV2Type.md)
 - [ResponseWrapperSalaryV2Voucher](docs/Model/ResponseWrapperSalaryV2Voucher.md)
 - [ResponseWrapperSalesForceAccountInfo](docs/Model/ResponseWrapperSalesForceAccountInfo.md)
 - [ResponseWrapperSalesForceCustomerStats](docs/Model/ResponseWrapperSalesForceCustomerStats.md)
 - [ResponseWrapperSalesForceEmployee](docs/Model/ResponseWrapperSalesForceEmployee.md)
 - [ResponseWrapperSalesForceEmployeeRole](docs/Model/ResponseWrapperSalesForceEmployeeRole.md)
 - [ResponseWrapperSalesForceTripletexSalesModulePurchase](docs/Model/ResponseWrapperSalesForceTripletexSalesModulePurchase.md)
 - [ResponseWrapperSalesForceUserOverview](docs/Model/ResponseWrapperSalesForceUserOverview.md)
 - [ResponseWrapperSalesModuleDTO](docs/Model/ResponseWrapperSalesModuleDTO.md)
 - [ResponseWrapperSegmentationData](docs/Model/ResponseWrapperSegmentationData.md)
 - [ResponseWrapperServiceActivationResponseDTO](docs/Model/ResponseWrapperServiceActivationResponseDTO.md)
 - [ResponseWrapperSessionToken](docs/Model/ResponseWrapperSessionToken.md)
 - [ResponseWrapperSimplePaymentWidget](docs/Model/ResponseWrapperSimplePaymentWidget.md)
 - [ResponseWrapperSnowplowContextSnowplowGlobalCompany](docs/Model/ResponseWrapperSnowplowContextSnowplowGlobalCompany.md)
 - [ResponseWrapperSnowplowContextSnowplowGlobalEmployee](docs/Model/ResponseWrapperSnowplowContextSnowplowGlobalEmployee.md)
 - [ResponseWrapperSpacesuitNotificationMeta](docs/Model/ResponseWrapperSpacesuitNotificationMeta.md)
 - [ResponseWrapperSseInitializationResultDTO](docs/Model/ResponseWrapperSseInitializationResultDTO.md)
 - [ResponseWrapperStandardTime](docs/Model/ResponseWrapperStandardTime.md)
 - [ResponseWrapperStocktaking](docs/Model/ResponseWrapperStocktaking.md)
 - [ResponseWrapperStorebrandPensionOnboarding](docs/Model/ResponseWrapperStorebrandPensionOnboarding.md)
 - [ResponseWrapperStorebrandPensionOnboardingQualify](docs/Model/ResponseWrapperStorebrandPensionOnboardingQualify.md)
 - [ResponseWrapperString](docs/Model/ResponseWrapperString.md)
 - [ResponseWrapperSubscription](docs/Model/ResponseWrapperSubscription.md)
 - [ResponseWrapperSupplier](docs/Model/ResponseWrapperSupplier.md)
 - [ResponseWrapperSupplierInvoice](docs/Model/ResponseWrapperSupplierInvoice.md)
 - [ResponseWrapperSupplierProduct](docs/Model/ResponseWrapperSupplierProduct.md)
 - [ResponseWrapperSystemMessage](docs/Model/ResponseWrapperSystemMessage.md)
 - [ResponseWrapperTaskDTO](docs/Model/ResponseWrapperTaskDTO.md)
 - [ResponseWrapperTasksWidgetData](docs/Model/ResponseWrapperTasksWidgetData.md)
 - [ResponseWrapperTaxCalculation](docs/Model/ResponseWrapperTaxCalculation.md)
 - [ResponseWrapperTaxReturnOverview](docs/Model/ResponseWrapperTaxReturnOverview.md)
 - [ResponseWrapperTaxcardContactInternal](docs/Model/ResponseWrapperTaxcardContactInternal.md)
 - [ResponseWrapperTemplate](docs/Model/ResponseWrapperTemplate.md)
 - [ResponseWrapperTimeClock](docs/Model/ResponseWrapperTimeClock.md)
 - [ResponseWrapperTimesheetAllocated](docs/Model/ResponseWrapperTimesheetAllocated.md)
 - [ResponseWrapperTimesheetEntry](docs/Model/ResponseWrapperTimesheetEntry.md)
 - [ResponseWrapperTimesheetProjectSalaryTypeSpecification](docs/Model/ResponseWrapperTimesheetProjectSalaryTypeSpecification.md)
 - [ResponseWrapperTimesheetSalaryTypeSpecification](docs/Model/ResponseWrapperTimesheetSalaryTypeSpecification.md)
 - [ResponseWrapperTimesheetSettings](docs/Model/ResponseWrapperTimesheetSettings.md)
 - [ResponseWrapperTodoListComment](docs/Model/ResponseWrapperTodoListComment.md)
 - [ResponseWrapperTransportType](docs/Model/ResponseWrapperTransportType.md)
 - [ResponseWrapperTravelCostCategory](docs/Model/ResponseWrapperTravelCostCategory.md)
 - [ResponseWrapperTravelExpense](docs/Model/ResponseWrapperTravelExpense.md)
 - [ResponseWrapperTravelExpenseRate](docs/Model/ResponseWrapperTravelExpenseRate.md)
 - [ResponseWrapperTravelExpenseRateCategory](docs/Model/ResponseWrapperTravelExpenseRateCategory.md)
 - [ResponseWrapperTravelExpenseRateCategoryGroup](docs/Model/ResponseWrapperTravelExpenseRateCategoryGroup.md)
 - [ResponseWrapperTravelExpenseSettings](docs/Model/ResponseWrapperTravelExpenseSettings.md)
 - [ResponseWrapperTravelExpenseZone](docs/Model/ResponseWrapperTravelExpenseZone.md)
 - [ResponseWrapperTravelPaymentType](docs/Model/ResponseWrapperTravelPaymentType.md)
 - [ResponseWrapperTrialDTO](docs/Model/ResponseWrapperTrialDTO.md)
 - [ResponseWrapperTrialInfoAutomationDTO](docs/Model/ResponseWrapperTrialInfoAutomationDTO.md)
 - [ResponseWrapperTripDTO](docs/Model/ResponseWrapperTripDTO.md)
 - [ResponseWrapperTripSearchResponseDTO](docs/Model/ResponseWrapperTripSearchResponseDTO.md)
 - [ResponseWrapperTripletexAccountPricesReturnDTO](docs/Model/ResponseWrapperTripletexAccountPricesReturnDTO.md)
 - [ResponseWrapperTripletexAccountReturn](docs/Model/ResponseWrapperTripletexAccountReturn.md)
 - [ResponseWrapperTripletexCompanyModules](docs/Model/ResponseWrapperTripletexCompanyModules.md)
 - [ResponseWrapperUnreadCountDTO](docs/Model/ResponseWrapperUnreadCountDTO.md)
 - [ResponseWrapperUserFeedback](docs/Model/ResponseWrapperUserFeedback.md)
 - [ResponseWrapperUserTemplate](docs/Model/ResponseWrapperUserTemplate.md)
 - [ResponseWrapperUserTemplateDefaultDTO](docs/Model/ResponseWrapperUserTemplateDefaultDTO.md)
 - [ResponseWrapperVFCustomerResponseDTO](docs/Model/ResponseWrapperVFCustomerResponseDTO.md)
 - [ResponseWrapperVatReturns2022](docs/Model/ResponseWrapperVatReturns2022.md)
 - [ResponseWrapperVatReturns2022ValidateCreate](docs/Model/ResponseWrapperVatReturns2022ValidateCreate.md)
 - [ResponseWrapperVatReturnsPaymentInfo](docs/Model/ResponseWrapperVatReturnsPaymentInfo.md)
 - [ResponseWrapperVatReturnsValidationResult](docs/Model/ResponseWrapperVatReturnsValidationResult.md)
 - [ResponseWrapperVatSpecificationLine](docs/Model/ResponseWrapperVatSpecificationLine.md)
 - [ResponseWrapperVatType](docs/Model/ResponseWrapperVatType.md)
 - [ResponseWrapperVismaConnectLogin](docs/Model/ResponseWrapperVismaConnectLogin.md)
 - [ResponseWrapperVoucher](docs/Model/ResponseWrapperVoucher.md)
 - [ResponseWrapperVoucherApprovalListElement](docs/Model/ResponseWrapperVoucherApprovalListElement.md)
 - [ResponseWrapperVoucherInboxContext](docs/Model/ResponseWrapperVoucherInboxContext.md)
 - [ResponseWrapperVoucherInboxItem](docs/Model/ResponseWrapperVoucherInboxItem.md)
 - [ResponseWrapperVoucherMessage](docs/Model/ResponseWrapperVoucherMessage.md)
 - [ResponseWrapperVoucherOptions](docs/Model/ResponseWrapperVoucherOptions.md)
 - [ResponseWrapperVoucherStatus](docs/Model/ResponseWrapperVoucherStatus.md)
 - [ResponseWrapperVoucherSummaryDTO](docs/Model/ResponseWrapperVoucherSummaryDTO.md)
 - [ResponseWrapperVoucherType](docs/Model/ResponseWrapperVoucherType.md)
 - [ResponseWrapperWeek](docs/Model/ResponseWrapperWeek.md)
 - [ResponseWrapperYearEndAnnualAccounts](docs/Model/ResponseWrapperYearEndAnnualAccounts.md)
 - [ResponseWrapperYearEndReport](docs/Model/ResponseWrapperYearEndReport.md)
 - [ResponseWrapperYearEndReportNote](docs/Model/ResponseWrapperYearEndReportNote.md)
 - [ResponseWrapperZendeskChatMetaDTO](docs/Model/ResponseWrapperZendeskChatMetaDTO.md)
 - [ResponseWrapperZtlAccount](docs/Model/ResponseWrapperZtlAccount.md)
 - [ResponseWrapperZtlConsent](docs/Model/ResponseWrapperZtlConsent.md)
 - [ResponseWrapperZtlOnboarding](docs/Model/ResponseWrapperZtlOnboarding.md)
 - [ResponseWrapperZtlSettings](docs/Model/ResponseWrapperZtlSettings.md)
 - [RestrictedEntitlementChange](docs/Model/RestrictedEntitlementChange.md)
 - [Result](docs/Model/Result.md)
 - [ResultBudget](docs/Model/ResultBudget.md)
 - [RiskFreeInterestRate](docs/Model/RiskFreeInterestRate.md)
 - [RoleCategoryContainerDTO](docs/Model/RoleCategoryContainerDTO.md)
 - [RoleContainerDTO](docs/Model/RoleContainerDTO.md)
 - [RushHoursToll](docs/Model/RushHoursToll.md)
 - [SaftImportSAFTBody](docs/Model/SaftImportSAFTBody.md)
 - [SalaryAdvanceTaxcardInternal](docs/Model/SalaryAdvanceTaxcardInternal.md)
 - [SalaryCompilation](docs/Model/SalaryCompilation.md)
 - [SalaryCompilationLine](docs/Model/SalaryCompilationLine.md)
 - [SalarySettings](docs/Model/SalarySettings.md)
 - [SalarySpecification](docs/Model/SalarySpecification.md)
 - [SalarySummaryDTO](docs/Model/SalarySummaryDTO.md)
 - [SalaryTaxcardInternal](docs/Model/SalaryTaxcardInternal.md)
 - [SalaryTransaction](docs/Model/SalaryTransaction.md)
 - [SalaryType](docs/Model/SalaryType.md)
 - [SalaryV2Employee](docs/Model/SalaryV2Employee.md)
 - [SalaryV2EmployeeToEmploymentsRelationship](docs/Model/SalaryV2EmployeeToEmploymentsRelationship.md)
 - [SalaryV2Modules](docs/Model/SalaryV2Modules.md)
 - [SalaryV2Overview](docs/Model/SalaryV2Overview.md)
 - [SalaryV2OverviewData](docs/Model/SalaryV2OverviewData.md)
 - [SalaryV2OverviewDataSalaryPayment](docs/Model/SalaryV2OverviewDataSalaryPayment.md)
 - [SalaryV2OverviewDataWageCodeColumn](docs/Model/SalaryV2OverviewDataWageCodeColumn.md)
 - [SalaryV2OverviewDataWageCodeRow](docs/Model/SalaryV2OverviewDataWageCodeRow.md)
 - [SalaryV2OverviewRow](docs/Model/SalaryV2OverviewRow.md)
 - [SalaryV2Payment](docs/Model/SalaryV2Payment.md)
 - [SalaryV2PaymentType](docs/Model/SalaryV2PaymentType.md)
 - [SalaryV2PaymentValidationResult](docs/Model/SalaryV2PaymentValidationResult.md)
 - [SalaryV2Settings](docs/Model/SalaryV2Settings.md)
 - [SalaryV2Specification](docs/Model/SalaryV2Specification.md)
 - [SalaryV2Supplement](docs/Model/SalaryV2Supplement.md)
 - [SalaryV2Transaction](docs/Model/SalaryV2Transaction.md)
 - [SalaryV2TravelExpense](docs/Model/SalaryV2TravelExpense.md)
 - [SalaryV2Type](docs/Model/SalaryV2Type.md)
 - [SalaryV2Voucher](docs/Model/SalaryV2Voucher.md)
 - [SalesForceAccountInfo](docs/Model/SalesForceAccountInfo.md)
 - [SalesForceAccountantConnection](docs/Model/SalesForceAccountantConnection.md)
 - [SalesForceAddress](docs/Model/SalesForceAddress.md)
 - [SalesForceCountry](docs/Model/SalesForceCountry.md)
 - [SalesForceCustomerStats](docs/Model/SalesForceCustomerStats.md)
 - [SalesForceEmployee](docs/Model/SalesForceEmployee.md)
 - [SalesForceEmployeeRole](docs/Model/SalesForceEmployeeRole.md)
 - [SalesForceOpportunity](docs/Model/SalesForceOpportunity.md)
 - [SalesForceTripletexSalesModulePurchase](docs/Model/SalesForceTripletexSalesModulePurchase.md)
 - [SalesForceUserOverview](docs/Model/SalesForceUserOverview.md)
 - [SalesModuleDTO](docs/Model/SalesModuleDTO.md)
 - [SearchCompletionDTO](docs/Model/SearchCompletionDTO.md)
 - [SegmentationData](docs/Model/SegmentationData.md)
 - [SegmentationModules](docs/Model/SegmentationModules.md)
 - [SegmentationRoles](docs/Model/SegmentationRoles.md)
 - [ServiceActivationResponseDTO](docs/Model/ServiceActivationResponseDTO.md)
 - [SessionToken](docs/Model/SessionToken.md)
 - [SignatureCombinationDTO](docs/Model/SignatureCombinationDTO.md)
 - [SimplePaymentWidget](docs/Model/SimplePaymentWidget.md)
 - [SnowplowContext](docs/Model/SnowplowContext.md)
 - [SnowplowContextSnowplowGlobalCompany](docs/Model/SnowplowContextSnowplowGlobalCompany.md)
 - [SnowplowContextSnowplowGlobalEmployee](docs/Model/SnowplowContextSnowplowGlobalEmployee.md)
 - [SnowplowGlobalCompany](docs/Model/SnowplowGlobalCompany.md)
 - [SnowplowGlobalEmployee](docs/Model/SnowplowGlobalEmployee.md)
 - [SpacesuitNotificationMeta](docs/Model/SpacesuitNotificationMeta.md)
 - [SseInitializationResultDTO](docs/Model/SseInitializationResultDTO.md)
 - [StandardTime](docs/Model/StandardTime.md)
 - [StatementImportBody](docs/Model/StatementImportBody.md)
 - [Stock](docs/Model/Stock.md)
 - [Stocktaking](docs/Model/Stocktaking.md)
 - [StorebrandPensionOnboarding](docs/Model/StorebrandPensionOnboarding.md)
 - [StorebrandPensionOnboardingQualify](docs/Model/StorebrandPensionOnboardingQualify.md)
 - [Subscription](docs/Model/Subscription.md)
 - [Supplier](docs/Model/Supplier.md)
 - [SupplierAutomation](docs/Model/SupplierAutomation.md)
 - [SupplierBalance](docs/Model/SupplierBalance.md)
 - [SupplierIdBody](docs/Model/SupplierIdBody.md)
 - [SupplierInvoice](docs/Model/SupplierInvoice.md)
 - [SupplierProduct](docs/Model/SupplierProduct.md)
 - [SystemMessage](docs/Model/SystemMessage.md)
 - [SystemReportCategoryDTO](docs/Model/SystemReportCategoryDTO.md)
 - [SystemReportDTO](docs/Model/SystemReportDTO.md)
 - [TangibleFixedAsset](docs/Model/TangibleFixedAsset.md)
 - [Task](docs/Model/Task.md)
 - [TaskDTO](docs/Model/TaskDTO.md)
 - [TaskWidgetDTO](docs/Model/TaskWidgetDTO.md)
 - [TasksWidget](docs/Model/TasksWidget.md)
 - [TasksWidgetData](docs/Model/TasksWidgetData.md)
 - [TaxCalculation](docs/Model/TaxCalculation.md)
 - [TaxReturn](docs/Model/TaxReturn.md)
 - [TaxReturnOverview](docs/Model/TaxReturnOverview.md)
 - [TaxcardContactInternal](docs/Model/TaxcardContactInternal.md)
 - [TaxcardEmployeeInternal](docs/Model/TaxcardEmployeeInternal.md)
 - [Template](docs/Model/Template.md)
 - [TemporaryDifferences](docs/Model/TemporaryDifferences.md)
 - [TimeClock](docs/Model/TimeClock.md)
 - [TimesheetAllocated](docs/Model/TimesheetAllocated.md)
 - [TimesheetEntry](docs/Model/TimesheetEntry.md)
 - [TimesheetEntrySearchResponse](docs/Model/TimesheetEntrySearchResponse.md)
 - [TimesheetProjectSalaryTypeSpecification](docs/Model/TimesheetProjectSalaryTypeSpecification.md)
 - [TimesheetSalaryTypeSpecification](docs/Model/TimesheetSalaryTypeSpecification.md)
 - [TimesheetSettings](docs/Model/TimesheetSettings.md)
 - [TlxNumber](docs/Model/TlxNumber.md)
 - [TodoListAmelding](docs/Model/TodoListAmelding.md)
 - [TodoListAnnualAccounts](docs/Model/TodoListAnnualAccounts.md)
 - [TodoListComment](docs/Model/TodoListComment.md)
 - [TodoListExpandedDetail](docs/Model/TodoListExpandedDetail.md)
 - [TodoListHarmonization](docs/Model/TodoListHarmonization.md)
 - [TodoListItemStatus](docs/Model/TodoListItemStatus.md)
 - [TodoListPeriodOverview](docs/Model/TodoListPeriodOverview.md)
 - [TodoListSingleChanges](docs/Model/TodoListSingleChanges.md)
 - [TodoListVat](docs/Model/TodoListVat.md)
 - [TodoListWageTransaction](docs/Model/TodoListWageTransaction.md)
 - [TollStationV2](docs/Model/TollStationV2.md)
 - [TotalToll](docs/Model/TotalToll.md)
 - [TransportType](docs/Model/TransportType.md)
 - [TravelCostCategory](docs/Model/TravelCostCategory.md)
 - [TravelDetails](docs/Model/TravelDetails.md)
 - [TravelExpense](docs/Model/TravelExpense.md)
 - [TravelExpenseIdAttachmentBody](docs/Model/TravelExpenseIdAttachmentBody.md)
 - [TravelExpenseRate](docs/Model/TravelExpenseRate.md)
 - [TravelExpenseRateCategory](docs/Model/TravelExpenseRateCategory.md)
 - [TravelExpenseRateCategoryGroup](docs/Model/TravelExpenseRateCategoryGroup.md)
 - [TravelExpenseSettings](docs/Model/TravelExpenseSettings.md)
 - [TravelExpenseZone](docs/Model/TravelExpenseZone.md)
 - [TravelPaymentType](docs/Model/TravelPaymentType.md)
 - [TrialDTO](docs/Model/TrialDTO.md)
 - [TrialInfoAutomationDTO](docs/Model/TrialInfoAutomationDTO.md)
 - [TriggerDTO](docs/Model/TriggerDTO.md)
 - [TripDTO](docs/Model/TripDTO.md)
 - [TripSearchDTO](docs/Model/TripSearchDTO.md)
 - [TripSearchResponseDTO](docs/Model/TripSearchResponseDTO.md)
 - [TripletexAccount](docs/Model/TripletexAccount.md)
 - [TripletexAccountPricesReturnDTO](docs/Model/TripletexAccountPricesReturnDTO.md)
 - [TripletexAccountReturn](docs/Model/TripletexAccountReturn.md)
 - [TripletexCompanyModules](docs/Model/TripletexCompanyModules.md)
 - [TypeOfGoods](docs/Model/TypeOfGoods.md)
 - [UnreadCountDTO](docs/Model/UnreadCountDTO.md)
 - [UpsaleMetric](docs/Model/UpsaleMetric.md)
 - [UserFeedback](docs/Model/UserFeedback.md)
 - [UserTemplate](docs/Model/UserTemplate.md)
 - [UserTemplateDefaultDTO](docs/Model/UserTemplateDefaultDTO.md)
 - [VFCustomerResponseDTO](docs/Model/VFCustomerResponseDTO.md)
 - [VFFactoringInvoiceOffer](docs/Model/VFFactoringInvoiceOffer.md)
 - [VFProductOnboardingStatusDTO](docs/Model/VFProductOnboardingStatusDTO.md)
 - [VacationSummary](docs/Model/VacationSummary.md)
 - [ValidationError](docs/Model/ValidationError.md)
 - [ValidationReasonDTO](docs/Model/ValidationReasonDTO.md)
 - [VatReturns2022](docs/Model/VatReturns2022.md)
 - [VatReturns2022Creation](docs/Model/VatReturns2022Creation.md)
 - [VatReturns2022ValidateCreate](docs/Model/VatReturns2022ValidateCreate.md)
 - [VatReturnsComment](docs/Model/VatReturnsComment.md)
 - [VatReturnsPaymentInfo](docs/Model/VatReturnsPaymentInfo.md)
 - [VatReturnsValidationResult](docs/Model/VatReturnsValidationResult.md)
 - [VatReturnsVatCodeComment](docs/Model/VatReturnsVatCodeComment.md)
 - [VatSpecificationGroup](docs/Model/VatSpecificationGroup.md)
 - [VatSpecificationLine](docs/Model/VatSpecificationLine.md)
 - [VatTermPeriod](docs/Model/VatTermPeriod.md)
 - [VatType](docs/Model/VatType.md)
 - [VfFactoringOffer](docs/Model/VfFactoringOffer.md)
 - [Video](docs/Model/Video.md)
 - [VismaConnectLogin](docs/Model/VismaConnectLogin.md)
 - [VismaConnectMobileAppLogin](docs/Model/VismaConnectMobileAppLogin.md)
 - [VismaConnectMobileAppTokens](docs/Model/VismaConnectMobileAppTokens.md)
 - [Voucher](docs/Model/Voucher.md)
 - [VoucherApprovalListElement](docs/Model/VoucherApprovalListElement.md)
 - [VoucherDetailsDTO](docs/Model/VoucherDetailsDTO.md)
 - [VoucherIdAttachmentBody](docs/Model/VoucherIdAttachmentBody.md)
 - [VoucherIdAttachmentBody1](docs/Model/VoucherIdAttachmentBody1.md)
 - [VoucherImportDocumentBody](docs/Model/VoucherImportDocumentBody.md)
 - [VoucherImportGbat10Body](docs/Model/VoucherImportGbat10Body.md)
 - [VoucherInboxArchive](docs/Model/VoucherInboxArchive.md)
 - [VoucherInboxContext](docs/Model/VoucherInboxContext.md)
 - [VoucherInboxItem](docs/Model/VoucherInboxItem.md)
 - [VoucherInternal](docs/Model/VoucherInternal.md)
 - [VoucherMessage](docs/Model/VoucherMessage.md)
 - [VoucherOptions](docs/Model/VoucherOptions.md)
 - [VoucherSearchResponse](docs/Model/VoucherSearchResponse.md)
 - [VoucherStatus](docs/Model/VoucherStatus.md)
 - [VoucherSummaryDTO](docs/Model/VoucherSummaryDTO.md)
 - [VoucherType](docs/Model/VoucherType.md)
 - [WebHookWrapper](docs/Model/WebHookWrapper.md)
 - [Week](docs/Model/Week.md)
 - [Widgets](docs/Model/Widgets.md)
 - [WorkingHoursScheme](docs/Model/WorkingHoursScheme.md)
 - [YearEndAnnualAccounts](docs/Model/YearEndAnnualAccounts.md)
 - [YearEndReport](docs/Model/YearEndReport.md)
 - [YearEndReportNote](docs/Model/YearEndReportNote.md)
 - [YearEndReportNoteData](docs/Model/YearEndReportNoteData.md)
 - [YearEndReportPost](docs/Model/YearEndReportPost.md)
 - [YearEndReportType](docs/Model/YearEndReportType.md)
 - [YearEndSubmissionResult](docs/Model/YearEndSubmissionResult.md)
 - [YearEndValidationDeviation](docs/Model/YearEndValidationDeviation.md)
 - [YearEndValidationGuidance](docs/Model/YearEndValidationGuidance.md)
 - [YearEndValidationResult](docs/Model/YearEndValidationResult.md)
 - [ZendeskChatMetaDTO](docs/Model/ZendeskChatMetaDTO.md)
 - [ZendeskSearchResultDTO](docs/Model/ZendeskSearchResultDTO.md)
 - [ZtlAccount](docs/Model/ZtlAccount.md)
 - [ZtlConsent](docs/Model/ZtlConsent.md)
 - [ZtlEmployee](docs/Model/ZtlEmployee.md)
 - [ZtlOnboarding](docs/Model/ZtlOnboarding.md)
 - [ZtlSettings](docs/Model/ZtlSettings.md)
 - [ZtlSettingsData](docs/Model/ZtlSettingsData.md)

## Documentation For Authorization


## tokenAuthScheme

- **Type**: HTTP basic authentication


## Author



