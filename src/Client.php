<?php

namespace Katsana\Sdk;

use Laravie\Codex\Client as BaseClient;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client extends BaseClient
{
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
        $this->http = $http;
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
        return new static(static::makeHttpClient(), $apiKey, $apiSecret);
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
     * Resolve the sanitizer class.
     *
     * @return \Laravie\Codex\Sanitizer
     */
    protected function sanitizeWith()
    {
        return null;
    }

    /**
     * Get resource default namespace.
     *
     * @return string
     */
    protected function getResourceNamespace()
    {
        return __NAMESPACE__;
    }
}
