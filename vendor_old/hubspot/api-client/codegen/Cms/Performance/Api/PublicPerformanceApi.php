<?php
/**
 * PublicPerformanceApi
 * PHP version 7.3
 *
 * @category Class
 * @package  HubSpot\Client\Cms\Performance
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * CMS Performance API
 *
 * Use these endpoints to get a time series view of your website's performance.
 *
 * The version of the OpenAPI document: v3
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.2.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HubSpot\Client\Cms\Performance\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use HubSpot\Client\Cms\Performance\ApiException;
use HubSpot\Client\Cms\Performance\Configuration;
use HubSpot\Client\Cms\Performance\HeaderSelector;
use HubSpot\Client\Cms\Performance\ObjectSerializer;

/**
 * PublicPerformanceApi Class Doc Comment
 *
 * @category Class
 * @package  HubSpot\Client\Cms\Performance
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PublicPerformanceApi
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
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getPage
     *
     * View your website&#39;s performance.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path The url path of the domain to return data for. (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \HubSpot\Client\Cms\Performance\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse|\HubSpot\Client\Cms\Performance\Model\Error
     */
    public function getPage($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        list($response) = $this->getPageWithHttpInfo($domain, $path, $pad, $sum, $period, $interval, $start, $end);
        return $response;
    }

    /**
     * Operation getPageWithHttpInfo
     *
     * View your website&#39;s performance.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path The url path of the domain to return data for. (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \HubSpot\Client\Cms\Performance\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse|\HubSpot\Client\Cms\Performance\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPageWithHttpInfo($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        $request = $this->getPageRequest($domain, $path, $pad, $sum, $period, $interval, $start, $end);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\HubSpot\Client\Cms\Performance\Model\Error' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\HubSpot\Client\Cms\Performance\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\HubSpot\Client\Cms\Performance\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPageAsync
     *
     * View your website&#39;s performance.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path The url path of the domain to return data for. (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPageAsync($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        return $this->getPageAsyncWithHttpInfo($domain, $path, $pad, $sum, $period, $interval, $start, $end)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPageAsyncWithHttpInfo
     *
     * View your website&#39;s performance.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path The url path of the domain to return data for. (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPageAsyncWithHttpInfo($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        $returnType = '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse';
        $request = $this->getPageRequest($domain, $path, $pad, $sum, $period, $interval, $start, $end);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPage'
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path The url path of the domain to return data for. (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPageRequest($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {

        $resourcePath = '/cms/v3/performance/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($domain !== null) {
            if('form' === 'form' && is_array($domain)) {
                foreach($domain as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['domain'] = $domain;
            }
        }
        // query params
        if ($path !== null) {
            if('form' === 'form' && is_array($path)) {
                foreach($path as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['path'] = $path;
            }
        }
        // query params
        if ($pad !== null) {
            if('form' === 'form' && is_array($pad)) {
                foreach($pad as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['pad'] = $pad;
            }
        }
        // query params
        if ($sum !== null) {
            if('form' === 'form' && is_array($sum)) {
                foreach($sum as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['sum'] = $sum;
            }
        }
        // query params
        if ($period !== null) {
            if('form' === 'form' && is_array($period)) {
                foreach($period as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['period'] = $period;
            }
        }
        // query params
        if ($interval !== null) {
            if('form' === 'form' && is_array($interval)) {
                foreach($interval as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['interval'] = $interval;
            }
        }
        // query params
        if ($start !== null) {
            if('form' === 'form' && is_array($start)) {
                foreach($start as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['start'] = $start;
            }
        }
        // query params
        if ($end !== null) {
            if('form' === 'form' && is_array($end)) {
                foreach($end as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['end'] = $end;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', '*/*'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('hapikey');
        if ($apiKey !== null) {
            $queryParams['hapikey'] = $apiKey;
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUptime
     *
     * View your website&#39;s uptime.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path path (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \HubSpot\Client\Cms\Performance\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse|\HubSpot\Client\Cms\Performance\Model\Error
     */
    public function getUptime($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        list($response) = $this->getUptimeWithHttpInfo($domain, $path, $pad, $sum, $period, $interval, $start, $end);
        return $response;
    }

    /**
     * Operation getUptimeWithHttpInfo
     *
     * View your website&#39;s uptime.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \HubSpot\Client\Cms\Performance\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse|\HubSpot\Client\Cms\Performance\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUptimeWithHttpInfo($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        $request = $this->getUptimeRequest($domain, $path, $pad, $sum, $period, $interval, $start, $end);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\HubSpot\Client\Cms\Performance\Model\Error' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\HubSpot\Client\Cms\Performance\Model\Error', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\HubSpot\Client\Cms\Performance\Model\Error',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getUptimeAsync
     *
     * View your website&#39;s uptime.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUptimeAsync($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        return $this->getUptimeAsyncWithHttpInfo($domain, $path, $pad, $sum, $period, $interval, $start, $end)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUptimeAsyncWithHttpInfo
     *
     * View your website&#39;s uptime.
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUptimeAsyncWithHttpInfo($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {
        $returnType = '\HubSpot\Client\Cms\Performance\Model\PublicPerformanceResponse';
        $request = $this->getUptimeRequest($domain, $path, $pad, $sum, $period, $interval, $start, $end);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUptime'
     *
     * @param  string $domain The domain to search return data for. (optional)
     * @param  string $path (optional)
     * @param  bool $pad Specifies whether the time series data should have empty intervals if performance data is not present to create a continuous set. (optional)
     * @param  bool $sum Specifies whether the time series data should be summated for the given period. Defaults to false. (optional)
     * @param  string $period A relative period to return time series data for. This value is ignored if start and/or end are provided. Valid periods: [15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  string $interval The time series interval to group data by. Valid intervals: [1m, 5m, 15m, 30m, 1h, 4h, 12h, 1d, 1w] (optional)
     * @param  int $start A timestamp in milliseconds that indicates the start of the time period. (optional)
     * @param  int $end A timestamp in milliseconds that indicates the end of the time period. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUptimeRequest($domain = null, $path = null, $pad = null, $sum = null, $period = null, $interval = null, $start = null, $end = null)
    {

        $resourcePath = '/cms/v3/performance/uptime';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($domain !== null) {
            if('form' === 'form' && is_array($domain)) {
                foreach($domain as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['domain'] = $domain;
            }
        }
        // query params
        if ($path !== null) {
            if('form' === 'form' && is_array($path)) {
                foreach($path as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['path'] = $path;
            }
        }
        // query params
        if ($pad !== null) {
            if('form' === 'form' && is_array($pad)) {
                foreach($pad as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['pad'] = $pad;
            }
        }
        // query params
        if ($sum !== null) {
            if('form' === 'form' && is_array($sum)) {
                foreach($sum as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['sum'] = $sum;
            }
        }
        // query params
        if ($period !== null) {
            if('form' === 'form' && is_array($period)) {
                foreach($period as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['period'] = $period;
            }
        }
        // query params
        if ($interval !== null) {
            if('form' === 'form' && is_array($interval)) {
                foreach($interval as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['interval'] = $interval;
            }
        }
        // query params
        if ($start !== null) {
            if('form' === 'form' && is_array($start)) {
                foreach($start as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['start'] = $start;
            }
        }
        // query params
        if ($end !== null) {
            if('form' === 'form' && is_array($end)) {
                foreach($end as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['end'] = $end;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', '*/*']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', '*/*'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('hapikey');
        if ($apiKey !== null) {
            $queryParams['hapikey'] = $apiKey;
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
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
