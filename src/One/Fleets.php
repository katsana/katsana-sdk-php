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
     * @return \Katsana\Sdk\Response
     */
    public function all(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            'fleets',
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * List all drivers available for the fleets.
     *
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function drivers(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            'fleets/drivers',
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Show single fleet.
     *
     * @param int                     $fleetId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function get(int $fleetId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "fleets/{$fleetId}",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }
}
