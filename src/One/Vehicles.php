<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Concerns\Request\Json;
use Laravie\Codex\Concerns\Request\Multipart;
use Laravie\Codex\Contracts\Response;

class Vehicles extends Request
{
    use Json, Multipart;

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
            'GET', 'vehicles', $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }

    /**
     * Show single vehicle.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function get(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', "vehicles/{$vehicleId}", $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }

    /**
     * Get vehicle current location.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function location(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', "vehicles/{$vehicleId}/location", $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }

    /**
     * Update vehicle information.
     *
     * @param int   $vehicleId
     * @param array $payload
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function update(int $vehicleId, array $payload): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'PATCH', "vehicles/{$vehicleId}", $this->getApiHeaders(), $payload
        );
    }

    /**
     * Upload profile avatar.
     *
     * @param int    $vehicleId
     * @param string $file
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function uploadAvatar(int $vehicleId, string $file): Response
    {
        $this->requiresAccessToken();

        return $this->stream(
            'POST',
            "vehicles/{$vehicleId}/avatar",
            $this->getApiHeaders(),
            $this->getApiBody(),
            compact('file')
        );
    }
}
