<?php

namespace Katsana\Sdk\One\Fleets;

use Katsana\Sdk\One\Request;
use Laravie\Codex\Concerns\Request\Json;
use Laravie\Codex\Contracts\Response;

class Driver extends Request
{
    use Json;

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
            array_merge($optional, compact('fullname', 'identification'))
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
            array_merge($optional, compact('fullname', 'identification'))
        );
    }
}
