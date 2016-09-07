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
    protected function send($method, $path, array $headers = [], $body = [])
    {
        $headers['Accept'] = "application/vnd.KATSANA.{$this->getVersion()}+json";

        $query['api_key'] = $this->client->getApiKey();
        $query['api_token'] = $this->client->getApiSecret();

        if ($method === 'GET') {
            $path .= '?'.http_build_query($query, null, '&');
        } else {
            $body = array_merge($body, $query);
        }

        return parent::send($method, $path, $headers, $body);
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

        return new Uri(sprintf('%s/%s', $this->client->getApiEndpoint(), $endpoint));
    }
}
