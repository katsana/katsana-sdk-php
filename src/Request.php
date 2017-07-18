<?php

namespace Katsana\Sdk;

use GuzzleHttp\Psr7\Uri;
use Laravie\Codex\Endpoint;
use Laravie\Codex\Request as BaseRequest;

abstract class Request extends BaseRequest
{
    /**
     * Get API Header.
     *
     * @return array
     */
    protected function getApiHeaders()
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
     * Get URI Endpoint.
     *
     * Used with Laravie Codex 0.4+
     *
     * @param  string  $endpoint
     *
     * @return \GuzzleHttp\Psr7\Uri
     */
    protected function getUriEndpoint($endpoint)
    {
        $query['client_id'] = $this->client->getClientId();
        $query['client_secret'] = $this->client->getClientSecret();

        $endpoint .= '?'.http_build_query($query, null, '&');

        return new Uri(sprintf('%s/%s', $this->client->getApiEndpoint(), $endpoint));
    }

    /**
     * Resolve URI.
     *
     * @param  \Laravie\Codex\Endpoint  $endpoint
     *
     * @return \GuzzleHttp\Psr7\Uri
     */
    protected function resolveUri(Endpoint $endpoint)
    {
        $endpoint->addQuery([
            'client_id' => $this->client->getClientId(),
            'client_secret' => $this->client->getClientSecret(),
        ]);

        return parent::resolveUri($endpoint);
    }
}
