<?php

namespace Katsana\Sdk;

use InvalidArgumentException;
use Psr\Http\Message\StreamInterface;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client
{
    /**
     * Http Client instance.
     *
     * @var \Http\Client\Common\HttpMethodsClient
     */
    protected $http;

    /**
     * API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * API Secret.
     *
     * @var string
     */
    protected $apiSecret;

    /**
     * API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint = 'https://api.katsana.com';

    /**
     * Default version.
     *
     * @var string
     */
    protected $defaultVersion = 'v1';

    /**
     * List of supported API versions.
     *
     * @var array
     */
    protected $supportedVersions = [
        'v1' => 'One',
    ];

    /**
     * Construct a new Client.
     *
     * @param \Http\Client\Common\HttpMethodsClient  $http
     * @param string  $apiKey
     * @param string  $apiSecret
     */
    public function __construct(HttpClient $http, $apiKey, $apiSecret)
    {
        $this->http   = $http;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * Make a client.
     *
     * @param string  $apiKey
     * @param string  $apiSecret
     *
     * @return $this
     */
    public static function make($apiKey, $apiSecret)
    {
        $client = new HttpClient(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find()
        );

        return new static($client, $apiKey, $apiSecret);
    }

    /**
     * Use custom endpoint.
     *
     * @param  string  $apiEndpoint
     *
     * @return $this
     */
    public function useCustomApiEndpoint($apiEndpoint)
    {
        $this->apiEndpoint = $apiEndpoint;

        return $this;
    }

    /**
     * Use different API version.
     *
     * @param  string  $version
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function useVersion($version)
    {
        if (! array_key_exists($version, $this->supportedVersions)) {
            throw new InvalidArgumentException("API version {$version} is not supported");
        }

        $this->defaultVersion = $version;

        return $this;
    }

    /**
     * Get API endpoint URL.
     *
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * Get API Key.
     *
     * @return string|null
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Get API Secret.
     *
     * @return string|null
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Get versioned resource (service).
     *
     * @param  string  $service
     * @param  string|null  $version
     *
     * @throws \InvalidArgumentException
     *
     * @return object
     */
    public function resource($service, $version = null)
    {
        if (is_null($version) || ! array_key_exists($version, $this->supportedVersions)) {
            $version = $this->defaultVersion;
        }

        $base  = str_replace('.', '\\', $service);
        $class = sprintf('%s\%s\%s', __NAMESPACE__, $this->supportedVersions[$version], $base);

        if (! class_exists($class)) {
            throw new InvalidArgumentException("Resource [{$service}] for version [{$version}] is not available");
        }

        return new $class($this);
    }

    /**
     * Send the HTTP request.
     *
     * @param  string  $method
     * @param  \Psr\Http\Message\UriInterface|string  $uri
     * @param  array  $headers
     * @param  array  $body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($method, $uri, array $headers = [], $body = [])
    {
        $headers = $this->prepareRequestHeaders($headers);
        list($headers, $body) = $this->prepareRequestPayloads($headers, $body);

        return $this->http->send($method, $uri, $headers, $body);
    }

    /**
     * Prepare request headers.
     *
     * @param  array  $headers
     *
     * @return array
     */
    protected function prepareRequestHeaders(array $headers = [])
    {
        return $headers;
    }

    /**
     * Prepare request payloads.
     *
     * @param  array  $headers
     * @param  mixed  $body
     *
     * @return string
     */
    protected function prepareRequestPayloads(array $headers = [], $body = [])
    {
        if (isset($headers['Content-Type']) && $headers['Content-Type'] == 'application/json') {
            $body = json_encode($body);
        } elseif (! $body instanceof StreamInterface) {
            $body = http_build_query($body, null, '&');
        }

        return [$headers, $body];
    }
}
