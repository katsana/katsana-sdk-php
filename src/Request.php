<?php

namespace Katsana\Sdk;

use Laravie\Codex\Request as BaseRequest;

abstract class Request extends BaseRequest
{
    /**
     * Get API Header.
     *
     * @return array
     */
    protected function getApiHeaders(): array
    {
        $headers = [
            'Accept' => "application/vnd.KATSANA.{$this->getVersion()}+json",
        ];

        if (! is_null($accessToken = $this->client->getAccessToken())) {
            $headers['Authorization'] = "Bearer {$accessToken}";
        }

        return $headers;
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
