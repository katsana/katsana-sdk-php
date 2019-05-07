<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Contracts\Response;

class Welcome extends Request
{
    /**
     * Show API information.
     *
     * @return \Katsana\Sdk\Response
     */
    public function info(): Response
    {
        return $this->send('GET', '/', $this->getApiHeaders());
    }
}
