<?php

namespace Katsana\Sdk;

use GuzzleHttp\Psr7\Uri;
use Laravie\Codex\Request as BaseRequest;

abstract class Request extends BaseRequest
{
    /**
     * Get API endpoint.
     *
     * @param  string  $name
     * @param  array  $headers
     * @param  array  $body
     *
     * @return array
     */
    protected function send($method, $name, array $headers = [], array $body = [])
    {
        $headers['Accept'] = "application/vnd.katsana.{$this->getVersion()}+json";

        $body['client_id'] = $this->client->getApiKey();
        $body['client_secret'] = $this->client->getApiSecret();

        return parent::send($method, $uri, $headers, $body);
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
        return new Uri(sprintf('%s/%s/%s', $this->client->getApiEndpoint(), $name));
    }
}
