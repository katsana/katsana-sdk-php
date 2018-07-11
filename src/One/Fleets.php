<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Fleets extends Request
{
    /**
     * List all vehicles available for the user.
     *
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function all(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', 'fleets', $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }
}
