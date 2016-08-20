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
        return $this->send('GET', 'profile');
    }
}
