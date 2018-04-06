<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Support\MultipartRequest;

class Vehicles extends Request
{
    use MultipartRequest;

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

        return $this->send('GET', 'vehicles', $this->getApiHeaders(), $this->buildHttpQuery($query));
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

        return $this->send('GET', "vehicles/{$vehicleId}", $this->getApiHeaders(), $this->buildHttpQuery($query));
    }

    /**
     * Get vehicle current location.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function location(int $vehicleId): Response
    {
        $this->requiresAccessToken();

        return $this->send('GET', "vehicles/{$vehicleId}/location", $this->getApiHeaders());
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

        $headers = ['Content-Type' => 'application/json'];

        return $this->send(
            'PATCH', "vehicles/{$vehicleId}", $this->mergeApiHeaders($headers), $payload
        );
    }

    /**
     * Upload profile avatar.
     *
     * @param int   $vehicleId
     * @param mixed $file
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function uploadAvatar(int $vehicleId, $file): Response
    {
        $this->requiresAccessToken();

        return $this->stream(
            'POST', "vehicles/{$vehicleId}/avatar", $this->getApiHeaders(), $this->getApiBody(), compact('file')
        );
    }
}
