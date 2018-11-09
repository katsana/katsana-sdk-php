<?php

namespace Katsana\Sdk;

use Http\Client\Common\HttpMethodsClient as HttpClient;
use Laravie\Codex\Client as BaseClient;
use Laravie\Codex\Concerns\Passport;
use Laravie\Codex\Contracts\Request as RequestContract;
use Laravie\Codex\Contracts\Response as ResponseContract;
use Laravie\Codex\Discovery;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    use Passport;

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
     * Set request header timezone code.
     *
     * @var string
     */
    protected $requestHeaderTimezoneCode = 'UTC';

    /**
     * Construct a new Client.
     *
     * @param \Http\Client\Common\HttpMethodsClient $http
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Make a client.
     *
     * @param string|null $clientId
     * @param string|null $clientSecret
     *
     * @return static
     */
    public static function make(?string $clientId, ?string $clientSecret)
    {
        return (new static(Discovery::client()))
                        ->setClientId($clientId)
                        ->setClientSecret($clientSecret);
    }

    /**
     * Make a client using personal access token.
     *
     * @param string $accessToken
     *
     * @return static
     */
    public static function personal(string $accessToken)
    {
        return static::make(null, null)->setAccessToken($accessToken);
    }

     /**
     * Handle uses using via.
     *
     * @param  \Laravie\Codex\Contracts\Request  $request
     *
     * @return \Laravie\Codex\Contracts\Request
     */
    public function via(RequestContract $request): RequestContract
    {
        $request->setClient($this);
        $request->onTimeZone($this->requestHeaderTimezoneCode);

        return $request;
    }

    /**
     * Set timezone code.
     *
     * @param string $timeZoneCode
     *
     * @return $this
     */
    final public function onTimeZone(string $timeZoneCode): self
    {
        if (in_array($timeZoneCode, timezone_identifiers_list())) {
            $this->requestHeaderTimezoneCode = $timeZoneCode;
        }

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
