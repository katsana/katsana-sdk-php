<?php

namespace Katsana\Sdk;

use Http\Client\Common\HttpMethodsClient as HttpClient;
use Laravie\Codex\Client as BaseClient;
use Laravie\Codex\Discovery;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * API Key.
     *
     * @var string
     */
    protected $clientId;

    /**
     * API Secret.
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * API Access Token.
     *
     * @var string|null
     */
    protected $accessToken;

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
     * @param \Http\Client\Common\HttpMethodsClient $http
     * @param string                                $clientId
     * @param string                                $clientSecret
     */
    public function __construct(HttpClient $http, $clientId, $clientSecret)
    {
        $this->http = $http;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Make a client.
     *
     * @param string $clientId
     * @param string $clientSecret
     *
     * @return $this
     */
    public static function make($clientId, $clientSecret)
    {
        return new static(Discovery::client(), $clientId, $clientSecret);
    }

    /**
     * Get API Key.
     *
     * @return string|null
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get API Secret.
     *
     * @return string|null
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Get access token.
     *
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set access token.
     *
     * @param string $accessToken
     *
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Resolve the responder class.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Katsana\Sdk\Response
     */
    protected function responseWith(ResponseInterface $response)
    {
        return new Response($response);
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
