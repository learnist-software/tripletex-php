<?php
/**
 * TravelExpenseApi
 * PHP version 5
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Tripletex API
 *
 * ## Usage  - **Download the spec** [swagger.json](/v2/swagger.json) file, it is a [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification).  - **Generating a client** can easily be done using tools like [swagger-codegen](https://github.com/swagger-api/swagger-codegen) or other that accepts [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) specs.     - For swagger codegen it is recommended to use the flag: **--removeOperationIdPrefix**.        Unique operation ids are about to be introduced to the spec, and this ensures forward compatibility - and results in less verbose generated code.   ## Overview  - Partial resource updating is done using the `PUT` method with optional fields instead of the `PATCH` method.  - **Actions** or **commands** are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  - **Summaries** or **aggregated** results are represented in our RESTful path with a prefixed `>`. Example: `/v2/hours/>thisWeeksBillables`.  - **Request ID** is a key found in all responses in the header with the name `x-tlx-request-id`. For validation and error responses it is also in the response body. If additional log information is absolutely necessary, our support division can locate the key value.  - **version** This is a revision number found on all persisted resources. If included, it will prevent your PUT/POST from overriding any updates to the resource since your GET.  - **Date** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DD`.  - **DateTime** follows the **[ISO 8601](https://en.wikipedia.org/wiki/ISO_8601)** standard, meaning the format `YYYY-MM-DDThh:mm:ss`.  - **Searching** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  - **Missing fields** or even **no response data** can occur because result objects and fields are filtered on authorization.  - **See [GitHub](https://github.com/Tripletex/tripletex-api2) for more documentation, examples, changelog and more.**  - **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for additional information.**   ## Authentication  - **Tokens:** The Tripletex API uses 3 different tokens    - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.    - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=1505&languageId=0)    - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header.  - **Authentication** is done via [Basic access authentication](https://en.wikipedia.org/wiki/Basic_access_authentication)    - **username** is used to specify what company to access.      - `0` or blank means the company of the employee.      - Any other value means accountant clients. Use `/company/>withLoginAccess` to get a list of those.    - **password** is the **sessionToken**.    - If you need to create the header yourself use `Authorization: Basic <encoded token>` where `encoded token` is the string `<target company id or 0>:<your session token>` Base64 encoded.   ## Tags  - `[BETA]` This is a beta endpoint and can be subject to change. - `[DEPRECATED]` Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.   ## Fields  Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements, done via `<field>(<subResourceFields>)`. `*` means all fields for that resource. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All resources and some subResources :  `*,activity(name),employee(*)`.   ## Sorting  Use the `sorting` parameter to specify sorting. It takes a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `<field>.<subObjectField>`. Example values: - `date` - `project.name` - `project.name, -date`   ## Changes  To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  **NOTE** > For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).   ## Rate limiting  Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope  #### Multiple values  ```json {   \"fullResultSize\": ###, // {number} [DEPRECATED]   \"from\": ###, // {number} Paging starting from   \"count\": ###, // {number} Paging count   \"versionDigest\": \"###\", // {string} Hash of full result, null if no result   \"values\": [...{...object...},{...object...},{...object...}...] } ```  #### Single value  ```json {   \"value\": {...single object...} } ```   ## WebHook envelope  ```json {   \"subscriptionId\": ###, // Subscription id   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Id of object this event is for   \"value\": {... single object, null if object.deleted ...} } ```   ## Error/warning envelope  ```json {   \"status\": ###, // {number} HTTP status code   \"code\": #####, // {number} internal status code of event   \"message\": \"###\", // {string} Basic feedback message in your language   \"link\": \"###\", // {string} Link to doc   \"developerMessage\": \"###\", // {string} More technical message   \"validationMessages\": [ // {array} List of validation messages, can be null     {       \"field\": \"###\", // {string} Name of field       \"message\": \"###\" // {string} Validation message for field     }   ],   \"requestId\": \"###\" // {string} Same as x-tlx-request-id  } ```   ## Status codes / Error codes  - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   -  **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000** Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception - **403 Forbidden** - When AuthorisationManager says no.   -  **9000** Security Exception - **404 Not Found** - For resources that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000** Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** - Unexpected condition was encountered and no more specific message is suitable   - **1000** Exception
 *
 * OpenAPI spec version: 2.70.19
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.41
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Learnist\Tripletex\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Learnist\Tripletex\ApiException;
use Learnist\Tripletex\Configuration;
use Learnist\Tripletex\HeaderSelector;
use Learnist\Tripletex\ObjectSerializer;

/**
 * TravelExpenseApi Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TravelExpenseApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation approve
     *
     * Approve travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function approve($id = null)
    {
        list($response) = $this->approveWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation approveWithHttpInfo
     *
     * Approve travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function approveWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->approveRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation approveAsync
     *
     * Approve travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function approveAsync($id = null)
    {
        return $this->approveAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation approveAsyncWithHttpInfo
     *
     * Approve travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function approveAsyncWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->approveRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'approve'
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function approveRequest($id = null)
    {

        $resourcePath = '/travelExpense/:approve';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation copy
     *
     * Copy travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperTravelExpense
     */
    public function copy($id)
    {
        list($response) = $this->copyWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation copyWithHttpInfo
     *
     * Copy travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function copyWithHttpInfo($id)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->copyRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation copyAsync
     *
     * Copy travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function copyAsync($id)
    {
        return $this->copyAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation copyAsyncWithHttpInfo
     *
     * Copy travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function copyAsyncWithHttpInfo($id)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->copyRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'copy'
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function copyRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling copy'
            );
        }

        $resourcePath = '/travelExpense/:copy';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, 'int32');
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createVouchers
     *
     * Create vouchers
     *
     * @param  string $date yyyy-MM-dd. Defaults to today. (required)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function createVouchers($date, $id = null)
    {
        list($response) = $this->createVouchersWithHttpInfo($date, $id);
        return $response;
    }

    /**
     * Operation createVouchersWithHttpInfo
     *
     * Create vouchers
     *
     * @param  string $date yyyy-MM-dd. Defaults to today. (required)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function createVouchersWithHttpInfo($date, $id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->createVouchersRequest($date, $id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createVouchersAsync
     *
     * Create vouchers
     *
     * @param  string $date yyyy-MM-dd. Defaults to today. (required)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createVouchersAsync($date, $id = null)
    {
        return $this->createVouchersAsyncWithHttpInfo($date, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createVouchersAsyncWithHttpInfo
     *
     * Create vouchers
     *
     * @param  string $date yyyy-MM-dd. Defaults to today. (required)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createVouchersAsyncWithHttpInfo($date, $id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->createVouchersRequest($date, $id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createVouchers'
     *
     * @param  string $date yyyy-MM-dd. Defaults to today. (required)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function createVouchersRequest($date, $id = null)
    {
        // verify the required parameter 'date' is set
        if ($date === null || (is_array($date) && count($date) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $date when calling createVouchers'
            );
        }

        $resourcePath = '/travelExpense/:createVouchers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }
        // query params
        if ($date !== null) {
            $queryParams['date'] = ObjectSerializer::toQueryValue($date, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation delete
     *
     * Delete travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function delete($id)
    {
        $this->deleteWithHttpInfo($id);
    }

    /**
     * Operation deleteWithHttpInfo
     *
     * Delete travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteAsync
     *
     * Delete travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAsync($id)
    {
        return $this->deleteAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAsyncWithHttpInfo
     *
     * Delete travel expense.
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAsyncWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'delete'
     *
     * @param  int $id Element ID (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling delete'
            );
        }

        $resourcePath = '/travelExpense/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteAttachment
     *
     * Delete attachment.
     *
     * @param  int $travel_expense_id ID of attachment containing the attachment to delete. (required)
     * @param  int $version Version of voucher containing the attachment to delete. (optional)
     * @param  bool $send_to_inbox Should the attachment be sent to inbox rather than deleted? (optional, default to false)
     * @param  bool $split If sendToInbox is true, should the attachment be split into one voucher per page? (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteAttachment($travel_expense_id, $version = null, $send_to_inbox = 'false', $split = 'false')
    {
        $this->deleteAttachmentWithHttpInfo($travel_expense_id, $version, $send_to_inbox, $split);
    }

    /**
     * Operation deleteAttachmentWithHttpInfo
     *
     * Delete attachment.
     *
     * @param  int $travel_expense_id ID of attachment containing the attachment to delete. (required)
     * @param  int $version Version of voucher containing the attachment to delete. (optional)
     * @param  bool $send_to_inbox Should the attachment be sent to inbox rather than deleted? (optional, default to false)
     * @param  bool $split If sendToInbox is true, should the attachment be split into one voucher per page? (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteAttachmentWithHttpInfo($travel_expense_id, $version = null, $send_to_inbox = 'false', $split = 'false')
    {
        $returnType = '';
        $request = $this->deleteAttachmentRequest($travel_expense_id, $version, $send_to_inbox, $split);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteAttachmentAsync
     *
     * Delete attachment.
     *
     * @param  int $travel_expense_id ID of attachment containing the attachment to delete. (required)
     * @param  int $version Version of voucher containing the attachment to delete. (optional)
     * @param  bool $send_to_inbox Should the attachment be sent to inbox rather than deleted? (optional, default to false)
     * @param  bool $split If sendToInbox is true, should the attachment be split into one voucher per page? (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAttachmentAsync($travel_expense_id, $version = null, $send_to_inbox = 'false', $split = 'false')
    {
        return $this->deleteAttachmentAsyncWithHttpInfo($travel_expense_id, $version, $send_to_inbox, $split)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAttachmentAsyncWithHttpInfo
     *
     * Delete attachment.
     *
     * @param  int $travel_expense_id ID of attachment containing the attachment to delete. (required)
     * @param  int $version Version of voucher containing the attachment to delete. (optional)
     * @param  bool $send_to_inbox Should the attachment be sent to inbox rather than deleted? (optional, default to false)
     * @param  bool $split If sendToInbox is true, should the attachment be split into one voucher per page? (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAttachmentAsyncWithHttpInfo($travel_expense_id, $version = null, $send_to_inbox = 'false', $split = 'false')
    {
        $returnType = '';
        $request = $this->deleteAttachmentRequest($travel_expense_id, $version, $send_to_inbox, $split);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteAttachment'
     *
     * @param  int $travel_expense_id ID of attachment containing the attachment to delete. (required)
     * @param  int $version Version of voucher containing the attachment to delete. (optional)
     * @param  bool $send_to_inbox Should the attachment be sent to inbox rather than deleted? (optional, default to false)
     * @param  bool $split If sendToInbox is true, should the attachment be split into one voucher per page? (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteAttachmentRequest($travel_expense_id, $version = null, $send_to_inbox = 'false', $split = 'false')
    {
        // verify the required parameter 'travel_expense_id' is set
        if ($travel_expense_id === null || (is_array($travel_expense_id) && count($travel_expense_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $travel_expense_id when calling deleteAttachment'
            );
        }

        $resourcePath = '/travelExpense/{travelExpenseId}/attachment';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($version !== null) {
            $queryParams['version'] = ObjectSerializer::toQueryValue($version, 'int32');
        }
        // query params
        if ($send_to_inbox !== null) {
            $queryParams['sendToInbox'] = ObjectSerializer::toQueryValue($send_to_inbox, null);
        }
        // query params
        if ($split !== null) {
            $queryParams['split'] = ObjectSerializer::toQueryValue($split, null);
        }

        // path params
        if ($travel_expense_id !== null) {
            $resourcePath = str_replace(
                '{' . 'travelExpenseId' . '}',
                ObjectSerializer::toPathValue($travel_expense_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deliver
     *
     * Deliver travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function deliver($id = null)
    {
        list($response) = $this->deliverWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation deliverWithHttpInfo
     *
     * Deliver travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function deliverWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->deliverRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deliverAsync
     *
     * Deliver travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deliverAsync($id = null)
    {
        return $this->deliverAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deliverAsyncWithHttpInfo
     *
     * Deliver travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deliverAsyncWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->deliverRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deliver'
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deliverRequest($id = null)
    {

        $resourcePath = '/travelExpense/:deliver';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation downloadAttachment
     *
     * Get attachment by travel expense ID.
     *
     * @param  int $travel_expense_id Travel Expense ID from which PDF is downloaded. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return string
     */
    public function downloadAttachment($travel_expense_id)
    {
        list($response) = $this->downloadAttachmentWithHttpInfo($travel_expense_id);
        return $response;
    }

    /**
     * Operation downloadAttachmentWithHttpInfo
     *
     * Get attachment by travel expense ID.
     *
     * @param  int $travel_expense_id Travel Expense ID from which PDF is downloaded. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of string, HTTP status code, HTTP response headers (array of strings)
     */
    public function downloadAttachmentWithHttpInfo($travel_expense_id)
    {
        $returnType = 'string';
        $request = $this->downloadAttachmentRequest($travel_expense_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'string',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation downloadAttachmentAsync
     *
     * Get attachment by travel expense ID.
     *
     * @param  int $travel_expense_id Travel Expense ID from which PDF is downloaded. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function downloadAttachmentAsync($travel_expense_id)
    {
        return $this->downloadAttachmentAsyncWithHttpInfo($travel_expense_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation downloadAttachmentAsyncWithHttpInfo
     *
     * Get attachment by travel expense ID.
     *
     * @param  int $travel_expense_id Travel Expense ID from which PDF is downloaded. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function downloadAttachmentAsyncWithHttpInfo($travel_expense_id)
    {
        $returnType = 'string';
        $request = $this->downloadAttachmentRequest($travel_expense_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'downloadAttachment'
     *
     * @param  int $travel_expense_id Travel Expense ID from which PDF is downloaded. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function downloadAttachmentRequest($travel_expense_id)
    {
        // verify the required parameter 'travel_expense_id' is set
        if ($travel_expense_id === null || (is_array($travel_expense_id) && count($travel_expense_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $travel_expense_id when calling downloadAttachment'
            );
        }

        $resourcePath = '/travelExpense/{travelExpenseId}/attachment';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($travel_expense_id !== null) {
            $resourcePath = str_replace(
                '{' . 'travelExpenseId' . '}',
                ObjectSerializer::toPathValue($travel_expense_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/octet-stream']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/octet-stream'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation get
     *
     * Get travel expense by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperTravelExpense
     */
    public function get($id, $fields = null)
    {
        list($response) = $this->getWithHttpInfo($id, $fields);
        return $response;
    }

    /**
     * Operation getWithHttpInfo
     *
     * Get travel expense by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->getRequest($id, $fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAsync
     *
     * Get travel expense by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsync($id, $fields = null)
    {
        return $this->getAsyncWithHttpInfo($id, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAsyncWithHttpInfo
     *
     * Get travel expense by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsyncWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->getRequest($id, $fields);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'get'
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getRequest($id, $fields = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling get'
            );
        }

        $resourcePath = '/travelExpense/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields, null);
        }

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation post
     *
     * Create travel expense.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperTravelExpense
     */
    public function post($body = null)
    {
        list($response) = $this->postWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation postWithHttpInfo
     *
     * Create travel expense.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function postWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->postRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation postAsync
     *
     * Create travel expense.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsync($body = null)
    {
        return $this->postAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postAsyncWithHttpInfo
     *
     * Create travel expense.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->postRequest($body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'post'
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postRequest($body = null)
    {

        $resourcePath = '/travelExpense';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                ['application/json; charset=utf-8']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation put
     *
     * Update travel expense.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperTravelExpense
     */
    public function put($id, $body = null)
    {
        list($response) = $this->putWithHttpInfo($id, $body);
        return $response;
    }

    /**
     * Operation putWithHttpInfo
     *
     * Update travel expense.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function putWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->putRequest($id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation putAsync
     *
     * Update travel expense.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsync($id, $body = null)
    {
        return $this->putAsyncWithHttpInfo($id, $body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putAsyncWithHttpInfo
     *
     * Update travel expense.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsyncWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperTravelExpense';
        $request = $this->putRequest($id, $body);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'put'
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function putRequest($id, $body = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling put'
            );
        }

        $resourcePath = '/travelExpense/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                ['application/json; charset=utf-8']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation search
     *
     * Find travel expenses corresponding with sent data.
     *
     * @param  string $employee_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $project_id Equals (optional)
     * @param  string $project_manager_id Equals (optional)
     * @param  string $departure_date_from From and including (optional)
     * @param  string $return_date_to To and excluding (optional)
     * @param  string $state category (optional, default to ALL)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function search($employee_id = null, $department_id = null, $project_id = null, $project_manager_id = null, $departure_date_from = null, $return_date_to = null, $state = 'ALL', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        list($response) = $this->searchWithHttpInfo($employee_id, $department_id, $project_id, $project_manager_id, $departure_date_from, $return_date_to, $state, $from, $count, $sorting, $fields);
        return $response;
    }

    /**
     * Operation searchWithHttpInfo
     *
     * Find travel expenses corresponding with sent data.
     *
     * @param  string $employee_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $project_id Equals (optional)
     * @param  string $project_manager_id Equals (optional)
     * @param  string $departure_date_from From and including (optional)
     * @param  string $return_date_to To and excluding (optional)
     * @param  string $state category (optional, default to ALL)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchWithHttpInfo($employee_id = null, $department_id = null, $project_id = null, $project_manager_id = null, $departure_date_from = null, $return_date_to = null, $state = 'ALL', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->searchRequest($employee_id, $department_id, $project_id, $project_manager_id, $departure_date_from, $return_date_to, $state, $from, $count, $sorting, $fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation searchAsync
     *
     * Find travel expenses corresponding with sent data.
     *
     * @param  string $employee_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $project_id Equals (optional)
     * @param  string $project_manager_id Equals (optional)
     * @param  string $departure_date_from From and including (optional)
     * @param  string $return_date_to To and excluding (optional)
     * @param  string $state category (optional, default to ALL)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsync($employee_id = null, $department_id = null, $project_id = null, $project_manager_id = null, $departure_date_from = null, $return_date_to = null, $state = 'ALL', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        return $this->searchAsyncWithHttpInfo($employee_id, $department_id, $project_id, $project_manager_id, $departure_date_from, $return_date_to, $state, $from, $count, $sorting, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchAsyncWithHttpInfo
     *
     * Find travel expenses corresponding with sent data.
     *
     * @param  string $employee_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $project_id Equals (optional)
     * @param  string $project_manager_id Equals (optional)
     * @param  string $departure_date_from From and including (optional)
     * @param  string $return_date_to To and excluding (optional)
     * @param  string $state category (optional, default to ALL)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsyncWithHttpInfo($employee_id = null, $department_id = null, $project_id = null, $project_manager_id = null, $departure_date_from = null, $return_date_to = null, $state = 'ALL', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->searchRequest($employee_id, $department_id, $project_id, $project_manager_id, $departure_date_from, $return_date_to, $state, $from, $count, $sorting, $fields);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'search'
     *
     * @param  string $employee_id Equals (optional)
     * @param  string $department_id Equals (optional)
     * @param  string $project_id Equals (optional)
     * @param  string $project_manager_id Equals (optional)
     * @param  string $departure_date_from From and including (optional)
     * @param  string $return_date_to To and excluding (optional)
     * @param  string $state category (optional, default to ALL)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function searchRequest($employee_id = null, $department_id = null, $project_id = null, $project_manager_id = null, $departure_date_from = null, $return_date_to = null, $state = 'ALL', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {

        $resourcePath = '/travelExpense';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($employee_id !== null) {
            $queryParams['employeeId'] = ObjectSerializer::toQueryValue($employee_id, null);
        }
        // query params
        if ($department_id !== null) {
            $queryParams['departmentId'] = ObjectSerializer::toQueryValue($department_id, null);
        }
        // query params
        if ($project_id !== null) {
            $queryParams['projectId'] = ObjectSerializer::toQueryValue($project_id, null);
        }
        // query params
        if ($project_manager_id !== null) {
            $queryParams['projectManagerId'] = ObjectSerializer::toQueryValue($project_manager_id, null);
        }
        // query params
        if ($departure_date_from !== null) {
            $queryParams['departureDateFrom'] = ObjectSerializer::toQueryValue($departure_date_from, null);
        }
        // query params
        if ($return_date_to !== null) {
            $queryParams['returnDateTo'] = ObjectSerializer::toQueryValue($return_date_to, null);
        }
        // query params
        if ($state !== null) {
            $queryParams['state'] = ObjectSerializer::toQueryValue($state, null);
        }
        // query params
        if ($from !== null) {
            $queryParams['from'] = ObjectSerializer::toQueryValue($from, null);
        }
        // query params
        if ($count !== null) {
            $queryParams['count'] = ObjectSerializer::toQueryValue($count, null);
        }
        // query params
        if ($sorting !== null) {
            $queryParams['sorting'] = ObjectSerializer::toQueryValue($sorting, null);
        }
        // query params
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation unapprove
     *
     * Unapprove travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function unapprove($id = null)
    {
        list($response) = $this->unapproveWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation unapproveWithHttpInfo
     *
     * Unapprove travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function unapproveWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->unapproveRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation unapproveAsync
     *
     * Unapprove travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unapproveAsync($id = null)
    {
        return $this->unapproveAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation unapproveAsyncWithHttpInfo
     *
     * Unapprove travel expenses.
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unapproveAsyncWithHttpInfo($id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->unapproveRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'unapprove'
     *
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function unapproveRequest($id = null)
    {

        $resourcePath = '/travelExpense/:unapprove';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation undeliver
     *
     * Undeliver travel expenses.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseTravelExpense
     */
    public function undeliver($body = null, $id = null)
    {
        list($response) = $this->undeliverWithHttpInfo($body, $id);
        return $response;
    }

    /**
     * Operation undeliverWithHttpInfo
     *
     * Undeliver travel expenses.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseTravelExpense, HTTP status code, HTTP response headers (array of strings)
     */
    public function undeliverWithHttpInfo($body = null, $id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->undeliverRequest($body, $id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!in_array($returnType, ['string','integer','bool'])) {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Learnist\Tripletex\Model\ListResponseTravelExpense',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation undeliverAsync
     *
     * Undeliver travel expenses.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function undeliverAsync($body = null, $id = null)
    {
        return $this->undeliverAsyncWithHttpInfo($body, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation undeliverAsyncWithHttpInfo
     *
     * Undeliver travel expenses.
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function undeliverAsyncWithHttpInfo($body = null, $id = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseTravelExpense';
        $request = $this->undeliverRequest($body, $id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'undeliver'
     *
     * @param  \Learnist\Tripletex\Model\TravelExpense $body Partial object describing what should be updated (optional)
     * @param  string $id ID of the elements (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function undeliverRequest($body = null, $id = null)
    {

        $resourcePath = '/travelExpense/:undeliver';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
                ['*/*']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation uploadAttachment
     *
     * Upload attachment to travel expense.
     *
     * @param  string $file file (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function uploadAttachment($file, $travel_expense_id, $create_new_cost = 'false')
    {
        $this->uploadAttachmentWithHttpInfo($file, $travel_expense_id, $create_new_cost);
    }

    /**
     * Operation uploadAttachmentWithHttpInfo
     *
     * Upload attachment to travel expense.
     *
     * @param  string $file (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function uploadAttachmentWithHttpInfo($file, $travel_expense_id, $create_new_cost = 'false')
    {
        $returnType = '';
        $request = $this->uploadAttachmentRequest($file, $travel_expense_id, $create_new_cost);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAttachmentAsync
     *
     * Upload attachment to travel expense.
     *
     * @param  string $file (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentAsync($file, $travel_expense_id, $create_new_cost = 'false')
    {
        return $this->uploadAttachmentAsyncWithHttpInfo($file, $travel_expense_id, $create_new_cost)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAttachmentAsyncWithHttpInfo
     *
     * Upload attachment to travel expense.
     *
     * @param  string $file (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentAsyncWithHttpInfo($file, $travel_expense_id, $create_new_cost = 'false')
    {
        $returnType = '';
        $request = $this->uploadAttachmentRequest($file, $travel_expense_id, $create_new_cost);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'uploadAttachment'
     *
     * @param  string $file (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function uploadAttachmentRequest($file, $travel_expense_id, $create_new_cost = 'false')
    {
        // verify the required parameter 'file' is set
        if ($file === null || (is_array($file) && count($file) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file when calling uploadAttachment'
            );
        }
        // verify the required parameter 'travel_expense_id' is set
        if ($travel_expense_id === null || (is_array($travel_expense_id) && count($travel_expense_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $travel_expense_id when calling uploadAttachment'
            );
        }

        $resourcePath = '/travelExpense/{travelExpenseId}/attachment';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($create_new_cost !== null) {
            $queryParams['createNewCost'] = ObjectSerializer::toQueryValue($create_new_cost, null);
        }

        // path params
        if ($travel_expense_id !== null) {
            $resourcePath = str_replace(
                '{' . 'travelExpenseId' . '}',
                ObjectSerializer::toPathValue($travel_expense_id),
                $resourcePath
            );
        }

        // form params
        if ($file !== null) {
            $multipart = true;
            $formParams['file'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($file), 'rb');
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation uploadAttachments
     *
     * Upload multiple attachments to travel expense.
     *
     * @param  \Learnist\Tripletex\Model\ContentDisposition $content_disposition content_disposition (required)
     * @param  object $entity entity (required)
     * @param  map[string,string[]] $headers headers (required)
     * @param  \Learnist\Tripletex\Model\MediaType $media_type media_type (required)
     * @param  \Learnist\Tripletex\Model\MessageBodyWorkers $message_body_workers message_body_workers (required)
     * @param  \Learnist\Tripletex\Model\MultiPart $parent parent (required)
     * @param  \Learnist\Tripletex\Model\Providers $providers providers (required)
     * @param  \Learnist\Tripletex\Model\BodyPart[] $body_parts body_parts (required)
     * @param  map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] $fields fields (required)
     * @param  map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] $parameterized_headers parameterized_headers (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function uploadAttachments($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost = 'false')
    {
        $this->uploadAttachmentsWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost);
    }

    /**
     * Operation uploadAttachmentsWithHttpInfo
     *
     * Upload multiple attachments to travel expense.
     *
     * @param  \Learnist\Tripletex\Model\ContentDisposition $content_disposition (required)
     * @param  object $entity (required)
     * @param  map[string,string[]] $headers (required)
     * @param  \Learnist\Tripletex\Model\MediaType $media_type (required)
     * @param  \Learnist\Tripletex\Model\MessageBodyWorkers $message_body_workers (required)
     * @param  \Learnist\Tripletex\Model\MultiPart $parent (required)
     * @param  \Learnist\Tripletex\Model\Providers $providers (required)
     * @param  \Learnist\Tripletex\Model\BodyPart[] $body_parts (required)
     * @param  map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] $fields (required)
     * @param  map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] $parameterized_headers (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function uploadAttachmentsWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost = 'false')
    {
        $returnType = '';
        $request = $this->uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAttachmentsAsync
     *
     * Upload multiple attachments to travel expense.
     *
     * @param  \Learnist\Tripletex\Model\ContentDisposition $content_disposition (required)
     * @param  object $entity (required)
     * @param  map[string,string[]] $headers (required)
     * @param  \Learnist\Tripletex\Model\MediaType $media_type (required)
     * @param  \Learnist\Tripletex\Model\MessageBodyWorkers $message_body_workers (required)
     * @param  \Learnist\Tripletex\Model\MultiPart $parent (required)
     * @param  \Learnist\Tripletex\Model\Providers $providers (required)
     * @param  \Learnist\Tripletex\Model\BodyPart[] $body_parts (required)
     * @param  map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] $fields (required)
     * @param  map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] $parameterized_headers (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentsAsync($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost = 'false')
    {
        return $this->uploadAttachmentsAsyncWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAttachmentsAsyncWithHttpInfo
     *
     * Upload multiple attachments to travel expense.
     *
     * @param  \Learnist\Tripletex\Model\ContentDisposition $content_disposition (required)
     * @param  object $entity (required)
     * @param  map[string,string[]] $headers (required)
     * @param  \Learnist\Tripletex\Model\MediaType $media_type (required)
     * @param  \Learnist\Tripletex\Model\MessageBodyWorkers $message_body_workers (required)
     * @param  \Learnist\Tripletex\Model\MultiPart $parent (required)
     * @param  \Learnist\Tripletex\Model\Providers $providers (required)
     * @param  \Learnist\Tripletex\Model\BodyPart[] $body_parts (required)
     * @param  map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] $fields (required)
     * @param  map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] $parameterized_headers (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentsAsyncWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost = 'false')
    {
        $returnType = '';
        $request = $this->uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'uploadAttachments'
     *
     * @param  \Learnist\Tripletex\Model\ContentDisposition $content_disposition (required)
     * @param  object $entity (required)
     * @param  map[string,string[]] $headers (required)
     * @param  \Learnist\Tripletex\Model\MediaType $media_type (required)
     * @param  \Learnist\Tripletex\Model\MessageBodyWorkers $message_body_workers (required)
     * @param  \Learnist\Tripletex\Model\MultiPart $parent (required)
     * @param  \Learnist\Tripletex\Model\Providers $providers (required)
     * @param  \Learnist\Tripletex\Model\BodyPart[] $body_parts (required)
     * @param  map[string,\Learnist\Tripletex\Model\FormDataBodyPart[]] $fields (required)
     * @param  map[string,\Learnist\Tripletex\Model\ParameterizedHeader[]] $parameterized_headers (required)
     * @param  int $travel_expense_id Travel Expense ID to upload attachment to. (required)
     * @param  bool $create_new_cost Create new cost row when you add the attachment (optional, default to false)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $travel_expense_id, $create_new_cost = 'false')
    {
        // verify the required parameter 'content_disposition' is set
        if ($content_disposition === null || (is_array($content_disposition) && count($content_disposition) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $content_disposition when calling uploadAttachments'
            );
        }
        // verify the required parameter 'entity' is set
        if ($entity === null || (is_array($entity) && count($entity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $entity when calling uploadAttachments'
            );
        }
        // verify the required parameter 'headers' is set
        if ($headers === null || (is_array($headers) && count($headers) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $headers when calling uploadAttachments'
            );
        }
        // verify the required parameter 'media_type' is set
        if ($media_type === null || (is_array($media_type) && count($media_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $media_type when calling uploadAttachments'
            );
        }
        // verify the required parameter 'message_body_workers' is set
        if ($message_body_workers === null || (is_array($message_body_workers) && count($message_body_workers) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $message_body_workers when calling uploadAttachments'
            );
        }
        // verify the required parameter 'parent' is set
        if ($parent === null || (is_array($parent) && count($parent) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $parent when calling uploadAttachments'
            );
        }
        // verify the required parameter 'providers' is set
        if ($providers === null || (is_array($providers) && count($providers) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $providers when calling uploadAttachments'
            );
        }
        // verify the required parameter 'body_parts' is set
        if ($body_parts === null || (is_array($body_parts) && count($body_parts) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body_parts when calling uploadAttachments'
            );
        }
        // verify the required parameter 'fields' is set
        if ($fields === null || (is_array($fields) && count($fields) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $fields when calling uploadAttachments'
            );
        }
        // verify the required parameter 'parameterized_headers' is set
        if ($parameterized_headers === null || (is_array($parameterized_headers) && count($parameterized_headers) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $parameterized_headers when calling uploadAttachments'
            );
        }
        // verify the required parameter 'travel_expense_id' is set
        if ($travel_expense_id === null || (is_array($travel_expense_id) && count($travel_expense_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $travel_expense_id when calling uploadAttachments'
            );
        }

        $resourcePath = '/travelExpense/{travelExpenseId}/attachment/list';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($create_new_cost !== null) {
            $queryParams['createNewCost'] = ObjectSerializer::toQueryValue($create_new_cost, null);
        }

        // path params
        if ($travel_expense_id !== null) {
            $resourcePath = str_replace(
                '{' . 'travelExpenseId' . '}',
                ObjectSerializer::toPathValue($travel_expense_id),
                $resourcePath
            );
        }

        // form params
        if ($content_disposition !== null) {
            $formParams['contentDisposition'] = ObjectSerializer::toFormValue($content_disposition);
        }
        // form params
        if ($entity !== null) {
            $formParams['entity'] = ObjectSerializer::toFormValue($entity);
        }
        // form params
        if ($headers !== null) {
            $formParams['headers'] = ObjectSerializer::toFormValue($headers);
        }
        // form params
        if ($media_type !== null) {
            $formParams['mediaType'] = ObjectSerializer::toFormValue($media_type);
        }
        // form params
        if ($message_body_workers !== null) {
            $formParams['messageBodyWorkers'] = ObjectSerializer::toFormValue($message_body_workers);
        }
        // form params
        if ($parent !== null) {
            $formParams['parent'] = ObjectSerializer::toFormValue($parent);
        }
        // form params
        if ($providers !== null) {
            $formParams['providers'] = ObjectSerializer::toFormValue($providers);
        }
        // form params
        if ($body_parts !== null) {
            $formParams['bodyParts'] = ObjectSerializer::toFormValue($body_parts);
        }
        // form params
        if ($fields !== null) {
            $formParams['fields'] = ObjectSerializer::toFormValue($fields);
        }
        // form params
        if ($parameterized_headers !== null) {
            $formParams['parameterizedHeaders'] = ObjectSerializer::toFormValue($parameterized_headers);
        }
        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
                ['multipart/form-data']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if ($this->config->getUsername() !== null || $this->config->getPassword() !== null) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
