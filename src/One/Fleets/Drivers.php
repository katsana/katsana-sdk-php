<?php

namespace Katsana\Sdk\One\Fleets;

use Katsana\Sdk\One\Request;
use Katsana\Sdk\Query;
use Laravie\Codex\Concerns\Request\Json;
use Laravie\Codex\Contracts\Response;

class Drivers extends Request
{
    use Json;

    /**
     * List drivers for a fleet.
     *
     * @param int                     $fleetId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function all(int $fleetId=null, ?Query $query = null): Response
    {
        $this->requiresAccessToken();
        
        $endpoint = is_null($fleetId) ? 'fleets/drivers' : "fleets/{$fleetId}/drivers";

        return $this->send(
            'GET',
            $endpoint,
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Create driver for a fleet.
     *
     * @param int    $fleetId
     * @param string $fullname
     * @param string $identification
     * @param array  $optional
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function create(int $fleetId, string $fullname, string $identification, array $optional = []): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'POST',
            "fleets/{$fleetId}/drivers",
            $this->getApiHeaders(),
            \array_merge($optional, \compact('fullname', 'identification'))
        );
    }

    /**
     * Create driver for a fleet.
     *
     * @param int    $fleetId
     * @param int    $driverId
     * @param string $fullname
     * @param string $identification
     * @param array  $optional
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function update(int $fleetId, int $driverId, string $fullname, string $identification, array $optional = []): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'POST',
            "fleets/{$fleetId}/drivers/{$driverId}",
            $this->getApiHeaders(),
            \array_merge($optional, \compact('fullname', 'identification'))
        );
    }
}
