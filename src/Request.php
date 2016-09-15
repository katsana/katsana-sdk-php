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
        return [
            'Accept' => "application/vnd.KATSANA.{$this->getVersion()}+json",
        ];
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
        $query['api_key'] = $this->client->getApiKey();
        $query['api_token'] = $this->client->getApiSecret();

        $endpoint .= '?'.http_build_query($query, null, '&');

        return new Uri(sprintf('%s/%s', $this->client->getApiEndpoint(), $endpoint));
    }
}
