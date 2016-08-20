<?php

namespace Katsana\Sdk\One;

class Welcome extends Request
{
    /**
     * Show API information.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show()
    {
        return $this->send('GET', '/');
    }
}
