<?php
/**
 * PurchaseOrderApi
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
 * PurchaseOrderApi Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PurchaseOrderApi
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
     * Operation delete
     *
     * [BETA] Delete purchase order.
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
     * [BETA] Delete purchase order.
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
     * [BETA] Delete purchase order.
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
     * [BETA] Delete purchase order.
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

        $resourcePath = '/purchaseOrder/{id}';
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
     * [BETA] Delete attachment.
     *
     * @param  int $id ID of purchase order containing the attachment to delete. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteAttachment($id)
    {
        $this->deleteAttachmentWithHttpInfo($id);
    }

    /**
     * Operation deleteAttachmentWithHttpInfo
     *
     * [BETA] Delete attachment.
     *
     * @param  int $id ID of purchase order containing the attachment to delete. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteAttachmentWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteAttachmentRequest($id);

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
     * [BETA] Delete attachment.
     *
     * @param  int $id ID of purchase order containing the attachment to delete. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAttachmentAsync($id)
    {
        return $this->deleteAttachmentAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteAttachmentAsyncWithHttpInfo
     *
     * [BETA] Delete attachment.
     *
     * @param  int $id ID of purchase order containing the attachment to delete. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAttachmentAsyncWithHttpInfo($id)
    {
        $returnType = '';
        $request = $this->deleteAttachmentRequest($id);

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
     * @param  int $id ID of purchase order containing the attachment to delete. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteAttachmentRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling deleteAttachment'
            );
        }

        $resourcePath = '/purchaseOrder/{id}/attachment';
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
     * Operation get
     *
     * [BETA] Find purchase order by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function get($id, $fields = null)
    {
        list($response) = $this->getWithHttpInfo($id, $fields);
        return $response;
    }

    /**
     * Operation getWithHttpInfo
     *
     * [BETA] Find purchase order by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
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
     * [BETA] Find purchase order by ID.
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
     * [BETA] Find purchase order by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsyncWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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

        $resourcePath = '/purchaseOrder/{id}';
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
     * [BETA] Creates a new purchase order
     *
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function post($body = null)
    {
        list($response) = $this->postWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation postWithHttpInfo
     *
     * [BETA] Creates a new purchase order
     *
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function postWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
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
     * [BETA] Creates a new purchase order
     *
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body JSON representing the new object to be created. Should not have ID and version set. (optional)
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
     * [BETA] Creates a new purchase order
     *
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postRequest($body = null)
    {

        $resourcePath = '/purchaseOrder';
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
     * [BETA] Update purchase order.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function put($id, $body = null)
    {
        list($response) = $this->putWithHttpInfo($id, $body);
        return $response;
    }

    /**
     * Operation putWithHttpInfo
     *
     * [BETA] Update purchase order.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function putWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
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
     * [BETA] Update purchase order.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body Partial object describing what should be updated (optional)
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
     * [BETA] Update purchase order.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsyncWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
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
     * @param  \Learnist\Tripletex\Model\PurchaseOrder $body Partial object describing what should be updated (optional)
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

        $resourcePath = '/purchaseOrder/{id}';
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
     * [BETA] Find purchase orders with send data
     *
     * @param  string $number Equals (optional)
     * @param  string $delivery_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $delivery_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $creation_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $creation_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $id List of IDs (optional)
     * @param  string $supplier_id List of IDs (optional)
     * @param  string $project_id List of IDs (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $with_deviation_only Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponsePurchaseOrder
     */
    public function search($number = null, $delivery_date_from = null, $delivery_date_to = null, $creation_date_from = null, $creation_date_to = null, $id = null, $supplier_id = null, $project_id = null, $is_closed = null, $with_deviation_only = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        list($response) = $this->searchWithHttpInfo($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields);
        return $response;
    }

    /**
     * Operation searchWithHttpInfo
     *
     * [BETA] Find purchase orders with send data
     *
     * @param  string $number Equals (optional)
     * @param  string $delivery_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $delivery_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $creation_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $creation_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $id List of IDs (optional)
     * @param  string $supplier_id List of IDs (optional)
     * @param  string $project_id List of IDs (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $with_deviation_only Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponsePurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchWithHttpInfo($number = null, $delivery_date_from = null, $delivery_date_to = null, $creation_date_from = null, $creation_date_to = null, $id = null, $supplier_id = null, $project_id = null, $is_closed = null, $with_deviation_only = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponsePurchaseOrder';
        $request = $this->searchRequest($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields);

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
                        '\Learnist\Tripletex\Model\ListResponsePurchaseOrder',
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
     * [BETA] Find purchase orders with send data
     *
     * @param  string $number Equals (optional)
     * @param  string $delivery_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $delivery_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $creation_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $creation_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $id List of IDs (optional)
     * @param  string $supplier_id List of IDs (optional)
     * @param  string $project_id List of IDs (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $with_deviation_only Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsync($number = null, $delivery_date_from = null, $delivery_date_to = null, $creation_date_from = null, $creation_date_to = null, $id = null, $supplier_id = null, $project_id = null, $is_closed = null, $with_deviation_only = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        return $this->searchAsyncWithHttpInfo($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchAsyncWithHttpInfo
     *
     * [BETA] Find purchase orders with send data
     *
     * @param  string $number Equals (optional)
     * @param  string $delivery_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $delivery_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $creation_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $creation_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $id List of IDs (optional)
     * @param  string $supplier_id List of IDs (optional)
     * @param  string $project_id List of IDs (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $with_deviation_only Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsyncWithHttpInfo($number = null, $delivery_date_from = null, $delivery_date_to = null, $creation_date_from = null, $creation_date_to = null, $id = null, $supplier_id = null, $project_id = null, $is_closed = null, $with_deviation_only = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponsePurchaseOrder';
        $request = $this->searchRequest($number, $delivery_date_from, $delivery_date_to, $creation_date_from, $creation_date_to, $id, $supplier_id, $project_id, $is_closed, $with_deviation_only, $from, $count, $sorting, $fields);

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
     * @param  string $number Equals (optional)
     * @param  string $delivery_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $delivery_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $creation_date_from Format is yyyy-MM-dd (from and incl.). (optional)
     * @param  string $creation_date_to Format is yyyy-MM-dd (to and incl.). (optional)
     * @param  string $id List of IDs (optional)
     * @param  string $supplier_id List of IDs (optional)
     * @param  string $project_id List of IDs (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $with_deviation_only Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function searchRequest($number = null, $delivery_date_from = null, $delivery_date_to = null, $creation_date_from = null, $creation_date_to = null, $id = null, $supplier_id = null, $project_id = null, $is_closed = null, $with_deviation_only = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {

        $resourcePath = '/purchaseOrder';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number, null);
        }
        // query params
        if ($delivery_date_from !== null) {
            $queryParams['deliveryDateFrom'] = ObjectSerializer::toQueryValue($delivery_date_from, null);
        }
        // query params
        if ($delivery_date_to !== null) {
            $queryParams['deliveryDateTo'] = ObjectSerializer::toQueryValue($delivery_date_to, null);
        }
        // query params
        if ($creation_date_from !== null) {
            $queryParams['creationDateFrom'] = ObjectSerializer::toQueryValue($creation_date_from, null);
        }
        // query params
        if ($creation_date_to !== null) {
            $queryParams['creationDateTo'] = ObjectSerializer::toQueryValue($creation_date_to, null);
        }
        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id, null);
        }
        // query params
        if ($supplier_id !== null) {
            $queryParams['supplierId'] = ObjectSerializer::toQueryValue($supplier_id, null);
        }
        // query params
        if ($project_id !== null) {
            $queryParams['projectId'] = ObjectSerializer::toQueryValue($project_id, null);
        }
        // query params
        if ($is_closed !== null) {
            $queryParams['isClosed'] = ObjectSerializer::toQueryValue($is_closed, null);
        }
        // query params
        if ($with_deviation_only !== null) {
            $queryParams['withDeviationOnly'] = ObjectSerializer::toQueryValue($with_deviation_only, null);
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
     * Operation send
     *
     * [BETA] Send purchase order by id and sendType.
     *
     * @param  int $id Element ID (required)
     * @param  string $send_type Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. (optional, default to DEFAULT)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function send($id, $send_type = 'DEFAULT')
    {
        list($response) = $this->sendWithHttpInfo($id, $send_type);
        return $response;
    }

    /**
     * Operation sendWithHttpInfo
     *
     * [BETA] Send purchase order by id and sendType.
     *
     * @param  int $id Element ID (required)
     * @param  string $send_type Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. (optional, default to DEFAULT)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendWithHttpInfo($id, $send_type = 'DEFAULT')
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->sendRequest($id, $send_type);

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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendAsync
     *
     * [BETA] Send purchase order by id and sendType.
     *
     * @param  int $id Element ID (required)
     * @param  string $send_type Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. (optional, default to DEFAULT)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendAsync($id, $send_type = 'DEFAULT')
    {
        return $this->sendAsyncWithHttpInfo($id, $send_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendAsyncWithHttpInfo
     *
     * [BETA] Send purchase order by id and sendType.
     *
     * @param  int $id Element ID (required)
     * @param  string $send_type Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. (optional, default to DEFAULT)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendAsyncWithHttpInfo($id, $send_type = 'DEFAULT')
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->sendRequest($id, $send_type);

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
     * Create request for operation 'send'
     *
     * @param  int $id Element ID (required)
     * @param  string $send_type Send type.DEFAULT will determine the send parameter based on the supplier type.If supplier is not wholesaler, receiverEmail from the PO will be used if it&#x27;s specified.If receiverEmail empty it will take the vendor email. (optional, default to DEFAULT)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function sendRequest($id, $send_type = 'DEFAULT')
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling send'
            );
        }

        $resourcePath = '/purchaseOrder/{id}/:send';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($send_type !== null) {
            $queryParams['sendType'] = ObjectSerializer::toQueryValue($send_type, null);
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation sendByEmail
     *
     * [BETA] Send purchase order by customisable email.
     *
     * @param  int $id Element ID (required)
     * @param  string $email_address Email address (required)
     * @param  string $subject Subject (required)
     * @param  string $message Message (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function sendByEmail($id, $email_address, $subject, $message = null)
    {
        list($response) = $this->sendByEmailWithHttpInfo($id, $email_address, $subject, $message);
        return $response;
    }

    /**
     * Operation sendByEmailWithHttpInfo
     *
     * [BETA] Send purchase order by customisable email.
     *
     * @param  int $id Element ID (required)
     * @param  string $email_address Email address (required)
     * @param  string $subject Subject (required)
     * @param  string $message Message (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendByEmailWithHttpInfo($id, $email_address, $subject, $message = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->sendByEmailRequest($id, $email_address, $subject, $message);

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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendByEmailAsync
     *
     * [BETA] Send purchase order by customisable email.
     *
     * @param  int $id Element ID (required)
     * @param  string $email_address Email address (required)
     * @param  string $subject Subject (required)
     * @param  string $message Message (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendByEmailAsync($id, $email_address, $subject, $message = null)
    {
        return $this->sendByEmailAsyncWithHttpInfo($id, $email_address, $subject, $message)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendByEmailAsyncWithHttpInfo
     *
     * [BETA] Send purchase order by customisable email.
     *
     * @param  int $id Element ID (required)
     * @param  string $email_address Email address (required)
     * @param  string $subject Subject (required)
     * @param  string $message Message (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendByEmailAsyncWithHttpInfo($id, $email_address, $subject, $message = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->sendByEmailRequest($id, $email_address, $subject, $message);

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
     * Create request for operation 'sendByEmail'
     *
     * @param  int $id Element ID (required)
     * @param  string $email_address Email address (required)
     * @param  string $subject Subject (required)
     * @param  string $message Message (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function sendByEmailRequest($id, $email_address, $subject, $message = null)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling sendByEmail'
            );
        }
        // verify the required parameter 'email_address' is set
        if ($email_address === null || (is_array($email_address) && count($email_address) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $email_address when calling sendByEmail'
            );
        }
        // verify the required parameter 'subject' is set
        if ($subject === null || (is_array($subject) && count($subject) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $subject when calling sendByEmail'
            );
        }

        $resourcePath = '/purchaseOrder/{id}/:sendByEmail';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($email_address !== null) {
            $queryParams['emailAddress'] = ObjectSerializer::toQueryValue($email_address, null);
        }
        // query params
        if ($subject !== null) {
            $queryParams['subject'] = ObjectSerializer::toQueryValue($subject, null);
        }
        // query params
        if ($message !== null) {
            $queryParams['message'] = ObjectSerializer::toQueryValue($message, null);
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation uploadAttachment
     *
     * [BETA] Upload attachment to Purchase Order.
     *
     * @param  string $file file (required)
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     * @param  string $fields Fields filter pattern (optional, default to *)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function uploadAttachment($file, $id, $fields = '*')
    {
        list($response) = $this->uploadAttachmentWithHttpInfo($file, $id, $fields);
        return $response;
    }

    /**
     * Operation uploadAttachmentWithHttpInfo
     *
     * [BETA] Upload attachment to Purchase Order.
     *
     * @param  string $file (required)
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     * @param  string $fields Fields filter pattern (optional, default to *)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function uploadAttachmentWithHttpInfo($file, $id, $fields = '*')
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->uploadAttachmentRequest($file, $id, $fields);

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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAttachmentAsync
     *
     * [BETA] Upload attachment to Purchase Order.
     *
     * @param  string $file (required)
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     * @param  string $fields Fields filter pattern (optional, default to *)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentAsync($file, $id, $fields = '*')
    {
        return $this->uploadAttachmentAsyncWithHttpInfo($file, $id, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAttachmentAsyncWithHttpInfo
     *
     * [BETA] Upload attachment to Purchase Order.
     *
     * @param  string $file (required)
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     * @param  string $fields Fields filter pattern (optional, default to *)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentAsyncWithHttpInfo($file, $id, $fields = '*')
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->uploadAttachmentRequest($file, $id, $fields);

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
     * Create request for operation 'uploadAttachment'
     *
     * @param  string $file (required)
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     * @param  string $fields Fields filter pattern (optional, default to *)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function uploadAttachmentRequest($file, $id, $fields = '*')
    {
        // verify the required parameter 'file' is set
        if ($file === null || (is_array($file) && count($file) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $file when calling uploadAttachment'
            );
        }
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling uploadAttachment'
            );
        }

        $resourcePath = '/purchaseOrder/{id}/attachment';
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

        // form params
        if ($file !== null) {
            $multipart = true;
            $formParams['file'] = \GuzzleHttp\Psr7\try_fopen(ObjectSerializer::toFormValue($file), 'rb');
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
     * Upload multiple attachments to Purchase Order.
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
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder
     */
    public function uploadAttachments($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
    {
        list($response) = $this->uploadAttachmentsWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id);
        return $response;
    }

    /**
     * Operation uploadAttachmentsWithHttpInfo
     *
     * Upload multiple attachments to Purchase Order.
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
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder, HTTP status code, HTTP response headers (array of strings)
     */
    public function uploadAttachmentsWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id);

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
                        '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation uploadAttachmentsAsync
     *
     * Upload multiple attachments to Purchase Order.
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
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentsAsync($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
    {
        return $this->uploadAttachmentsAsyncWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation uploadAttachmentsAsyncWithHttpInfo
     *
     * Upload multiple attachments to Purchase Order.
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
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadAttachmentsAsyncWithHttpInfo($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperPurchaseOrder';
        $request = $this->uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id);

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
     * @param  int $id Purchase Order ID to upload attachment to. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function uploadAttachmentsRequest($content_disposition, $entity, $headers, $media_type, $message_body_workers, $parent, $providers, $body_parts, $fields, $parameterized_headers, $id)
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
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling uploadAttachments'
            );
        }

        $resourcePath = '/purchaseOrder/{id}/attachment/list';
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
                ['*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['*/*'],
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
