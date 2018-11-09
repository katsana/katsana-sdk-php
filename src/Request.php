<?php

namespace Katsana\Sdk;

use Laravie\Codex\Request as BaseRequest;

abstract class Request extends BaseRequest
{
    /**
     * Set request header timezone code.
     *
     * @var string
     */
    protected static $requestHeaderTimezoneCode = 'UTC';

    /**
     * Get API Header.
     *
     * @return array
     */
    protected function getApiHeaders(): array
    {
        $headers = [
            'Accept' => "application/vnd.KATSANA.{$this->getVersion()}+json",
            'Time-Zone' => static::$requestHeaderTimezoneCode ?? 'UTC',
        ];

        if (! is_null($accessToken = $this->client->getAccessToken())) {
            $headers['Authorization'] = "Bearer {$accessToken}";
        }

        return $headers;
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
            static::$requestHeaderTimezoneCode = $timeZoneCode;
        }

        return $this;
    }

    /**
     * Check for access token is available before trying to make a request.
     *
     * @return void
     */
    final protected function requiresAccessToken(): void
    {
        if (is_null($accessToken = $this->client->getAccessToken())) {
            throw new Exceptions\MissingAccessToken('Request requires valid access token to be available!');
        }
    }

    /**
     * Build query string from Katsana\Sdk\Query.
     *
     * @param \Katsana\Sdk\Query $query
     *
     * @return array
     */
    final protected function buildHttpQuery(?Query $query): array
    {
        return $query instanceof Query ? $query->toArray() : [];
    }
}
