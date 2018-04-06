<?php

namespace Katsana\Sdk\One;

class Welcome extends Request
{
    /**
     * Show API information.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show()
    {
        return $this->send('GET', '/', $this->getApiHeaders());
    }
}
