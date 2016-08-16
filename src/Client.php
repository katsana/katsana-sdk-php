<?php

namespace Katsana\Sdk;

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
}
