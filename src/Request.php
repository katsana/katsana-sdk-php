<?php

namespace Katsana\Sdk;

use GuzzleHttp\Psr7\Uri;

abstract class Request
{
    /**
     * Version namespace.
     *
     * @var string
     */
    protected $version;

    /**
     * The Billplz client.
     *
     * @var \Katsana\Sdk\Client
     */
    protected $client;

    /**
     * Construct a new Request.
     *
     * @param \Katsana\Sdk\Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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
        $domain = $this->client->getApiEndpoint();

        $uri = (new Uri(sprintf('%s/%s/%s', $domain, $name)));
        $headers['Accept'] = "application/vnd.katsana.{$this->version}+json";

        $body['client_id'] = $this->client->getApiKey();
        $body['client_secret'] = $this->client->getApiSecret();

        return $this->client->send(strtoupper($method), $uri, $headers, $body);
    }
}
