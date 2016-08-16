<?php

namespace Katsana\Sdk;

use InvalidArgumentException;
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
}
