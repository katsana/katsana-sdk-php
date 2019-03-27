<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;
use Katsana\Sdk\Query;
use Laravie\Codex\Concerns\Request\Json;
use Laravie\Codex\Contracts\Response;

class Sharing extends Request
{
    use Json;

    /**
     * List sharing vehicles.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function all(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/sharing",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Create a new share.
     *
     * @param int         $vehicleId
     * @param string|null $description
     * @param string|null $duration
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function create(int $vehicleId, ?string $description, ?string $duration = '1D'): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'POST',
            "vehicles/{$vehicleId}/sharing",
            $this->getApiHeaders(),
            $this->mergeApiBody(\compact('description', 'duration'))
        );
    }

    /**
     * Update an existing share.
     *
     * @param int         $vehicleId
     * @param int         $sharingId
     * @param string|null $description
     * @param string|null $duration
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function update(int $vehicleId, int $sharingId, ?string $description, ?string $duration = '1D'): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'PATCH',
            "vehicles/{$vehicleId}/sharing/{$sharingId}",
            $this->getApiHeaders(),
            $this->mergeApiBody(\compact('description', 'duration'))
        );
    }

    /**
     * Delete an existing share.
     *
     * @param int $vehicleId
     * @param int $sharingId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function destroy(int $vehicleId, int $sharingId): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'DELETE',
            "vehicles/{$vehicleId}/sharing/{$sharingId}",
            $this->getApiHeaders()
        );
    }
}
