<?php
/**
 * ProjectApi
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
 * ProjectApi Class Doc Comment
 *
 * @category Class
 * @package  Learnist\Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProjectApi
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
     * [BETA] Delete project.
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
     * [BETA] Delete project.
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
     * [BETA] Delete project.
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
     * [BETA] Delete project.
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

        $resourcePath = '/project/{id}';
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
     * Operation deleteByIds
     *
     * [BETA] Delete projects.
     *
     * @param  string $ids ID of the elements (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteByIds($ids)
    {
        $this->deleteByIdsWithHttpInfo($ids);
    }

    /**
     * Operation deleteByIdsWithHttpInfo
     *
     * [BETA] Delete projects.
     *
     * @param  string $ids ID of the elements (required)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteByIdsWithHttpInfo($ids)
    {
        $returnType = '';
        $request = $this->deleteByIdsRequest($ids);

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
     * Operation deleteByIdsAsync
     *
     * [BETA] Delete projects.
     *
     * @param  string $ids ID of the elements (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteByIdsAsync($ids)
    {
        return $this->deleteByIdsAsyncWithHttpInfo($ids)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteByIdsAsyncWithHttpInfo
     *
     * [BETA] Delete projects.
     *
     * @param  string $ids ID of the elements (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteByIdsAsyncWithHttpInfo($ids)
    {
        $returnType = '';
        $request = $this->deleteByIdsRequest($ids);

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
     * Create request for operation 'deleteByIds'
     *
     * @param  string $ids ID of the elements (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteByIdsRequest($ids)
    {
        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling deleteByIds'
            );
        }

        $resourcePath = '/project/list';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($ids !== null) {
            $queryParams['ids'] = ObjectSerializer::toQueryValue($ids, null);
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
     * Operation deleteList
     *
     * [BETA] Delete multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing objects to delete. Should have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteList($body = null)
    {
        $this->deleteListWithHttpInfo($body);
    }

    /**
     * Operation deleteListWithHttpInfo
     *
     * [BETA] Delete multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing objects to delete. Should have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteListWithHttpInfo($body = null)
    {
        $returnType = '';
        $request = $this->deleteListRequest($body);

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
     * Operation deleteListAsync
     *
     * [BETA] Delete multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing objects to delete. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteListAsync($body = null)
    {
        return $this->deleteListAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteListAsyncWithHttpInfo
     *
     * [BETA] Delete multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing objects to delete. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteListAsyncWithHttpInfo($body = null)
    {
        $returnType = '';
        $request = $this->deleteListRequest($body);

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
     * Create request for operation 'deleteList'
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing objects to delete. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function deleteListRequest($body = null)
    {

        $resourcePath = '/project';
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
                []
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                [],
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation get
     *
     * Find project by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperProject
     */
    public function get($id, $fields = null)
    {
        list($response) = $this->getWithHttpInfo($id, $fields);
        return $response;
    }

    /**
     * Operation getWithHttpInfo
     *
     * Find project by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function getWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperProject',
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
     * Find project by ID.
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
     * Find project by ID.
     *
     * @param  int $id Element ID (required)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAsyncWithHttpInfo($id, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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

        $resourcePath = '/project/{id}';
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
     * Operation getForTimeSheet
     *
     * Find projects applicable for time sheet registration on a specific day.
     *
     * @param  bool $include_project_offers Equals (optional, default to false)
     * @param  int $employee_id Employee ID. Defaults to ID of token owner. (optional)
     * @param  string $date yyyy-MM-dd. Defaults to today. (optional)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseProject
     */
    public function getForTimeSheet($include_project_offers = 'false', $employee_id = null, $date = null, $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        list($response) = $this->getForTimeSheetWithHttpInfo($include_project_offers, $employee_id, $date, $from, $count, $sorting, $fields);
        return $response;
    }

    /**
     * Operation getForTimeSheetWithHttpInfo
     *
     * Find projects applicable for time sheet registration on a specific day.
     *
     * @param  bool $include_project_offers Equals (optional, default to false)
     * @param  int $employee_id Employee ID. Defaults to ID of token owner. (optional)
     * @param  string $date yyyy-MM-dd. Defaults to today. (optional)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function getForTimeSheetWithHttpInfo($include_project_offers = 'false', $employee_id = null, $date = null, $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->getForTimeSheetRequest($include_project_offers, $employee_id, $date, $from, $count, $sorting, $fields);

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
                        '\Learnist\Tripletex\Model\ListResponseProject',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getForTimeSheetAsync
     *
     * Find projects applicable for time sheet registration on a specific day.
     *
     * @param  bool $include_project_offers Equals (optional, default to false)
     * @param  int $employee_id Employee ID. Defaults to ID of token owner. (optional)
     * @param  string $date yyyy-MM-dd. Defaults to today. (optional)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getForTimeSheetAsync($include_project_offers = 'false', $employee_id = null, $date = null, $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        return $this->getForTimeSheetAsyncWithHttpInfo($include_project_offers, $employee_id, $date, $from, $count, $sorting, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getForTimeSheetAsyncWithHttpInfo
     *
     * Find projects applicable for time sheet registration on a specific day.
     *
     * @param  bool $include_project_offers Equals (optional, default to false)
     * @param  int $employee_id Employee ID. Defaults to ID of token owner. (optional)
     * @param  string $date yyyy-MM-dd. Defaults to today. (optional)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getForTimeSheetAsyncWithHttpInfo($include_project_offers = 'false', $employee_id = null, $date = null, $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->getForTimeSheetRequest($include_project_offers, $employee_id, $date, $from, $count, $sorting, $fields);

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
     * Create request for operation 'getForTimeSheet'
     *
     * @param  bool $include_project_offers Equals (optional, default to false)
     * @param  int $employee_id Employee ID. Defaults to ID of token owner. (optional)
     * @param  string $date yyyy-MM-dd. Defaults to today. (optional)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getForTimeSheetRequest($include_project_offers = 'false', $employee_id = null, $date = null, $from = '0', $count = '1000', $sorting = null, $fields = null)
    {

        $resourcePath = '/project/>forTimeSheet';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($include_project_offers !== null) {
            $queryParams['includeProjectOffers'] = ObjectSerializer::toQueryValue($include_project_offers, null);
        }
        // query params
        if ($employee_id !== null) {
            $queryParams['employeeId'] = ObjectSerializer::toQueryValue($employee_id, 'int32');
        }
        // query params
        if ($date !== null) {
            $queryParams['date'] = ObjectSerializer::toQueryValue($date, null);
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
     * Operation post
     *
     * [BETA] Add new project.
     *
     * @param  \Learnist\Tripletex\Model\Project $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperProject
     */
    public function post($body = null)
    {
        list($response) = $this->postWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation postWithHttpInfo
     *
     * [BETA] Add new project.
     *
     * @param  \Learnist\Tripletex\Model\Project $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function postWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperProject',
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
     * [BETA] Add new project.
     *
     * @param  \Learnist\Tripletex\Model\Project $body JSON representing the new object to be created. Should not have ID and version set. (optional)
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
     * [BETA] Add new project.
     *
     * @param  \Learnist\Tripletex\Model\Project $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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
     * @param  \Learnist\Tripletex\Model\Project $body JSON representing the new object to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postRequest($body = null)
    {

        $resourcePath = '/project';
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
     * Operation postList
     *
     * [BETA] Register new projects. Multiple projects for different users can be sent in the same request.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing a list of new objects to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseProject
     */
    public function postList($body = null)
    {
        list($response) = $this->postListWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation postListWithHttpInfo
     *
     * [BETA] Register new projects. Multiple projects for different users can be sent in the same request.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing a list of new objects to be created. Should not have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function postListWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->postListRequest($body);

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
                        '\Learnist\Tripletex\Model\ListResponseProject',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation postListAsync
     *
     * [BETA] Register new projects. Multiple projects for different users can be sent in the same request.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing a list of new objects to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postListAsync($body = null)
    {
        return $this->postListAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation postListAsyncWithHttpInfo
     *
     * [BETA] Register new projects. Multiple projects for different users can be sent in the same request.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing a list of new objects to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postListAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->postListRequest($body);

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
     * Create request for operation 'postList'
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing a list of new objects to be created. Should not have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postListRequest($body = null)
    {

        $resourcePath = '/project/list';
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
     * [BETA] Update project.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\Project $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ResponseWrapperProject
     */
    public function put($id, $body = null)
    {
        list($response) = $this->putWithHttpInfo($id, $body);
        return $response;
    }

    /**
     * Operation putWithHttpInfo
     *
     * [BETA] Update project.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\Project $body Partial object describing what should be updated (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ResponseWrapperProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function putWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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
                        '\Learnist\Tripletex\Model\ResponseWrapperProject',
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
     * [BETA] Update project.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\Project $body Partial object describing what should be updated (optional)
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
     * [BETA] Update project.
     *
     * @param  int $id Element ID (required)
     * @param  \Learnist\Tripletex\Model\Project $body Partial object describing what should be updated (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putAsyncWithHttpInfo($id, $body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ResponseWrapperProject';
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
     * @param  \Learnist\Tripletex\Model\Project $body Partial object describing what should be updated (optional)
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

        $resourcePath = '/project/{id}';
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
     * Operation putList
     *
     * [BETA] Update multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing updates to objects. Should have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseProject
     */
    public function putList($body = null)
    {
        list($response) = $this->putListWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation putListWithHttpInfo
     *
     * [BETA] Update multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing updates to objects. Should have ID and version set. (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function putListWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->putListRequest($body);

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
                        '\Learnist\Tripletex\Model\ListResponseProject',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation putListAsync
     *
     * [BETA] Update multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing updates to objects. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putListAsync($body = null)
    {
        return $this->putListAsyncWithHttpInfo($body)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation putListAsyncWithHttpInfo
     *
     * [BETA] Update multiple projects.
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing updates to objects. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function putListAsyncWithHttpInfo($body = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->putListRequest($body);

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
     * Create request for operation 'putList'
     *
     * @param  \Learnist\Tripletex\Model\Project[] $body JSON representing updates to objects. Should have ID and version set. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function putListRequest($body = null)
    {

        $resourcePath = '/project/list';
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation search
     *
     * Find projects corresponding with sent data.
     *
     * @param  string $id List of IDs (optional)
     * @param  string $name Containing (optional)
     * @param  string $number Equals (optional)
     * @param  bool $is_offer Equals (optional)
     * @param  string $project_manager_id List of IDs (optional)
     * @param  string $employee_in_project_id List of IDs (optional)
     * @param  string $department_id List of IDs (optional)
     * @param  string $start_date_from From and including (optional)
     * @param  string $start_date_to To and excluding (optional)
     * @param  string $end_date_from From and including (optional)
     * @param  string $end_date_to To and excluding (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $is_fixed_price Equals (optional)
     * @param  string $customer_id Equals (optional)
     * @param  string $external_accounts_number Containing (optional)
     * @param  bool $include_recently_closed If isClosed is false, include projects that have been closed within the last 3 months. Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Learnist\Tripletex\Model\ListResponseProject
     */
    public function search($id = null, $name = null, $number = null, $is_offer = null, $project_manager_id = null, $employee_in_project_id = null, $department_id = null, $start_date_from = null, $start_date_to = null, $end_date_from = null, $end_date_to = null, $is_closed = null, $is_fixed_price = null, $customer_id = null, $external_accounts_number = null, $include_recently_closed = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        list($response) = $this->searchWithHttpInfo($id, $name, $number, $is_offer, $project_manager_id, $employee_in_project_id, $department_id, $start_date_from, $start_date_to, $end_date_from, $end_date_to, $is_closed, $is_fixed_price, $customer_id, $external_accounts_number, $include_recently_closed, $from, $count, $sorting, $fields);
        return $response;
    }

    /**
     * Operation searchWithHttpInfo
     *
     * Find projects corresponding with sent data.
     *
     * @param  string $id List of IDs (optional)
     * @param  string $name Containing (optional)
     * @param  string $number Equals (optional)
     * @param  bool $is_offer Equals (optional)
     * @param  string $project_manager_id List of IDs (optional)
     * @param  string $employee_in_project_id List of IDs (optional)
     * @param  string $department_id List of IDs (optional)
     * @param  string $start_date_from From and including (optional)
     * @param  string $start_date_to To and excluding (optional)
     * @param  string $end_date_from From and including (optional)
     * @param  string $end_date_to To and excluding (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $is_fixed_price Equals (optional)
     * @param  string $customer_id Equals (optional)
     * @param  string $external_accounts_number Containing (optional)
     * @param  bool $include_recently_closed If isClosed is false, include projects that have been closed within the last 3 months. Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \Learnist\Tripletex\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Learnist\Tripletex\Model\ListResponseProject, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchWithHttpInfo($id = null, $name = null, $number = null, $is_offer = null, $project_manager_id = null, $employee_in_project_id = null, $department_id = null, $start_date_from = null, $start_date_to = null, $end_date_from = null, $end_date_to = null, $is_closed = null, $is_fixed_price = null, $customer_id = null, $external_accounts_number = null, $include_recently_closed = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->searchRequest($id, $name, $number, $is_offer, $project_manager_id, $employee_in_project_id, $department_id, $start_date_from, $start_date_to, $end_date_from, $end_date_to, $is_closed, $is_fixed_price, $customer_id, $external_accounts_number, $include_recently_closed, $from, $count, $sorting, $fields);

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
                        '\Learnist\Tripletex\Model\ListResponseProject',
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
     * Find projects corresponding with sent data.
     *
     * @param  string $id List of IDs (optional)
     * @param  string $name Containing (optional)
     * @param  string $number Equals (optional)
     * @param  bool $is_offer Equals (optional)
     * @param  string $project_manager_id List of IDs (optional)
     * @param  string $employee_in_project_id List of IDs (optional)
     * @param  string $department_id List of IDs (optional)
     * @param  string $start_date_from From and including (optional)
     * @param  string $start_date_to To and excluding (optional)
     * @param  string $end_date_from From and including (optional)
     * @param  string $end_date_to To and excluding (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $is_fixed_price Equals (optional)
     * @param  string $customer_id Equals (optional)
     * @param  string $external_accounts_number Containing (optional)
     * @param  bool $include_recently_closed If isClosed is false, include projects that have been closed within the last 3 months. Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsync($id = null, $name = null, $number = null, $is_offer = null, $project_manager_id = null, $employee_in_project_id = null, $department_id = null, $start_date_from = null, $start_date_to = null, $end_date_from = null, $end_date_to = null, $is_closed = null, $is_fixed_price = null, $customer_id = null, $external_accounts_number = null, $include_recently_closed = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        return $this->searchAsyncWithHttpInfo($id, $name, $number, $is_offer, $project_manager_id, $employee_in_project_id, $department_id, $start_date_from, $start_date_to, $end_date_from, $end_date_to, $is_closed, $is_fixed_price, $customer_id, $external_accounts_number, $include_recently_closed, $from, $count, $sorting, $fields)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchAsyncWithHttpInfo
     *
     * Find projects corresponding with sent data.
     *
     * @param  string $id List of IDs (optional)
     * @param  string $name Containing (optional)
     * @param  string $number Equals (optional)
     * @param  bool $is_offer Equals (optional)
     * @param  string $project_manager_id List of IDs (optional)
     * @param  string $employee_in_project_id List of IDs (optional)
     * @param  string $department_id List of IDs (optional)
     * @param  string $start_date_from From and including (optional)
     * @param  string $start_date_to To and excluding (optional)
     * @param  string $end_date_from From and including (optional)
     * @param  string $end_date_to To and excluding (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $is_fixed_price Equals (optional)
     * @param  string $customer_id Equals (optional)
     * @param  string $external_accounts_number Containing (optional)
     * @param  bool $include_recently_closed If isClosed is false, include projects that have been closed within the last 3 months. Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsyncWithHttpInfo($id = null, $name = null, $number = null, $is_offer = null, $project_manager_id = null, $employee_in_project_id = null, $department_id = null, $start_date_from = null, $start_date_to = null, $end_date_from = null, $end_date_to = null, $is_closed = null, $is_fixed_price = null, $customer_id = null, $external_accounts_number = null, $include_recently_closed = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {
        $returnType = '\Learnist\Tripletex\Model\ListResponseProject';
        $request = $this->searchRequest($id, $name, $number, $is_offer, $project_manager_id, $employee_in_project_id, $department_id, $start_date_from, $start_date_to, $end_date_from, $end_date_to, $is_closed, $is_fixed_price, $customer_id, $external_accounts_number, $include_recently_closed, $from, $count, $sorting, $fields);

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
     * @param  string $id List of IDs (optional)
     * @param  string $name Containing (optional)
     * @param  string $number Equals (optional)
     * @param  bool $is_offer Equals (optional)
     * @param  string $project_manager_id List of IDs (optional)
     * @param  string $employee_in_project_id List of IDs (optional)
     * @param  string $department_id List of IDs (optional)
     * @param  string $start_date_from From and including (optional)
     * @param  string $start_date_to To and excluding (optional)
     * @param  string $end_date_from From and including (optional)
     * @param  string $end_date_to To and excluding (optional)
     * @param  bool $is_closed Equals (optional)
     * @param  bool $is_fixed_price Equals (optional)
     * @param  string $customer_id Equals (optional)
     * @param  string $external_accounts_number Containing (optional)
     * @param  bool $include_recently_closed If isClosed is false, include projects that have been closed within the last 3 months. Equals (optional, default to false)
     * @param  int $from From index (optional, default to 0)
     * @param  int $count Number of elements to return (optional, default to 1000)
     * @param  string $sorting Sorting pattern (optional)
     * @param  string $fields Fields filter pattern (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function searchRequest($id = null, $name = null, $number = null, $is_offer = null, $project_manager_id = null, $employee_in_project_id = null, $department_id = null, $start_date_from = null, $start_date_to = null, $end_date_from = null, $end_date_to = null, $is_closed = null, $is_fixed_price = null, $customer_id = null, $external_accounts_number = null, $include_recently_closed = 'false', $from = '0', $count = '1000', $sorting = null, $fields = null)
    {

        $resourcePath = '/project';
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
        if ($name !== null) {
            $queryParams['name'] = ObjectSerializer::toQueryValue($name, null);
        }
        // query params
        if ($number !== null) {
            $queryParams['number'] = ObjectSerializer::toQueryValue($number, null);
        }
        // query params
        if ($is_offer !== null) {
            $queryParams['isOffer'] = ObjectSerializer::toQueryValue($is_offer, null);
        }
        // query params
        if ($project_manager_id !== null) {
            $queryParams['projectManagerId'] = ObjectSerializer::toQueryValue($project_manager_id, null);
        }
        // query params
        if ($employee_in_project_id !== null) {
            $queryParams['employeeInProjectId'] = ObjectSerializer::toQueryValue($employee_in_project_id, null);
        }
        // query params
        if ($department_id !== null) {
            $queryParams['departmentId'] = ObjectSerializer::toQueryValue($department_id, null);
        }
        // query params
        if ($start_date_from !== null) {
            $queryParams['startDateFrom'] = ObjectSerializer::toQueryValue($start_date_from, null);
        }
        // query params
        if ($start_date_to !== null) {
            $queryParams['startDateTo'] = ObjectSerializer::toQueryValue($start_date_to, null);
        }
        // query params
        if ($end_date_from !== null) {
            $queryParams['endDateFrom'] = ObjectSerializer::toQueryValue($end_date_from, null);
        }
        // query params
        if ($end_date_to !== null) {
            $queryParams['endDateTo'] = ObjectSerializer::toQueryValue($end_date_to, null);
        }
        // query params
        if ($is_closed !== null) {
            $queryParams['isClosed'] = ObjectSerializer::toQueryValue($is_closed, null);
        }
        // query params
        if ($is_fixed_price !== null) {
            $queryParams['isFixedPrice'] = ObjectSerializer::toQueryValue($is_fixed_price, null);
        }
        // query params
        if ($customer_id !== null) {
            $queryParams['customerId'] = ObjectSerializer::toQueryValue($customer_id, null);
        }
        // query params
        if ($external_accounts_number !== null) {
            $queryParams['externalAccountsNumber'] = ObjectSerializer::toQueryValue($external_accounts_number, null);
        }
        // query params
        if ($include_recently_closed !== null) {
            $queryParams['includeRecentlyClosed'] = ObjectSerializer::toQueryValue($include_recently_closed, null);
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
