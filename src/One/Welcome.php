<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Contracts\Response;

class Welcome extends Request
{
    /**
     * Show API information.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show(): Response
    {
        return $this->send('GET', [], $this->getApiHeaders());
    }
}
