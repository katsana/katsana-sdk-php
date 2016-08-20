<?php

namespace Katsana\Sdk\One;

class Profile extends Request
{
    /**
     * Show user profile.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show()
    {
        list($uri, $headers) = $this->endpoint('profile');

        return $this->client->send('GET', $uri, $headers, []);
    }
}
