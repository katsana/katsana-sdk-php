<?php

namespace Katsana\Sdk;

use GuzzleHttp\Psr7\Uri;
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
     * Get API Body.
     *
     * @return array
     */
    protected function getApiBody()
    {
        return [];
    }

    /**
     * Get URI Endpoint.
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
}
