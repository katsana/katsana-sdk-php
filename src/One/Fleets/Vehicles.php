<?php

namespace Katsana\Sdk\One\Fleets;

use Katsana\Sdk\Query;
use Katsana\Sdk\One\Request;
use Laravie\Codex\Contracts\Response;

class Vehicles extends Request
{
    /**
     * List drivers for a fleet.
     *
     * @param int                     $fleetId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function all(int $fleetId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "fleets/{$fleetId}/vehicles",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }
}
