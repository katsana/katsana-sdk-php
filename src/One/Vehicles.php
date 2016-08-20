<?php

namespace Katsana\Sdk\One;

class Vehicles extends Request
{
    /**
     * List all vehicles available for the user.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        list($uri, $headers) = $this->endpoint('vehicles');

        return $this->client->send('GET', $uri, $headers, []);
    }

    /**
     * Show single vehicle.
     *
     * @param  int  $id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show($id)
    {
        list($uri, $headers) = $this->endpoint("vehicles/{$id}");

        return $this->client->send('GET', $uri, $headers, []);
    }
}
