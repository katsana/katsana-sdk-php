<?php

namespace Katsana\Sdk;

use Http\Client\Common\HttpMethodsClient as HttpClient;
use Laravie\Codex\Client as BaseClient;
use Laravie\Codex\Contracts\Response as ResponseContract;
use Laravie\Codex\Discovery;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * API Key.
     *
     * @var string|null
     */
    protected $clientId;

    /**
     * API Secret.
     *
     * @var string|null
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
     * @param string|null $clientId
     * @param string|null $clientSecret
     */
    public function __construct(HttpClient $http, ?string $clientId, ?string $clientSecret)
    {
        $this->http = $http;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Make a client.
     *
     * @param string|null $clientId
     * @param string|null $clientSecret
     *
     * @return static
     */
    public static function make(?string $clientId, ?string $clientSecret): self
    {
        return new static(Discovery::client(), $clientId, $clientSecret);
    }

    /**
     * Make a client using personal access token.
     *
     * @param string $accessToken
     *
     * @return static
     */
    public static function personal(string $accessToken): self
    {
        return static::make(null, null)->setAccessToken($accessToken);
    }

    /**
     * Get API Key.
     *
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * Get API Secret.
     *
     * @return string|null
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * Get access token.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Set access token.
     *
     * @param string|null $accessToken
     *
     * @return $this
     */
    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Resolve the responder class.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseWith(ResponseInterface $response): ResponseContract
    {
        return new Response($response);
    }

    /**
     * Get resource default namespace.
     *
     * @return string
     */
    protected function getResourceNamespace(): string
    {
        return __NAMESPACE__;
    }
}
