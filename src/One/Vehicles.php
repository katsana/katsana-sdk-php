<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;

class Vehicles extends Request
{
    /**
     * List all vehicles available for the user.
     *
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function index(?Query $query = null): Response
    {
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
    public function show($vehicleId, ?Query $query = null): Response
    {
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
        return $this->send('GET', "vehicles/{$vehicleId}/location", $this->getApiHeaders());
    }

    /**
     * Update vehicle information.
     *
     * @param array $data
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function update($vehicleId, array $data): Response
    {
        return $this->send('PATCH', "vehicles/{$vehicleId}", $this->getApiHeaders(), $data);
    }

    /**
     * Set the vehicle under lockdown mode.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function locked(int $vehicleId): Response
    {
        $body = [
            'mode' => 'parked',
        ];

        return $this->send('PATCH', "vehicles/{$vehicleId}", $this->getApiHeaders(), $body);
    }

    /**
     * Set the vehicle under working mode.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function unlock(int $vehicleId): Response
    {
        $body = [
            'mode' => 'working',
        ];

        return $this->send('PATCH', "vehicles/{$vehicleId}", $this->getApiHeaders(), $body);
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
        return $this->stream(
            'POST', "vehicles/{$vehicleId}/avatar", $this->getApiHeaders(), $this->getApiBody(), compact('file')
        );
    }
}
