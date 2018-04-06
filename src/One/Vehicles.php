<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Support\MultipartRequest;

class Vehicles extends Request
{
    use MultipartRequest;

    /**
     * List all vehicles available for the user.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function index()
    {
        return $this->send('GET', 'vehicles', $this->getApiHeaders());
    }

    /**
     * Show single vehicle.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show($vehicleId)
    {
        return $this->send('GET', "vehicles/{$vehicleId}", $this->getApiHeaders());
    }

    /**
     * Get vehicle current location.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function location($vehicleId)
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
    public function update(array $data)
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
    public function locked($vehicleId)
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
    public function unlock($vehicleId)
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
    public function uploadAvatar($vehicleId, $file)
    {
        list($headers, $stream) = $this->prepareMultipartRequestPayloads(
            $this->getApiHeaders(),
            $this->getApiBody(),
            compact('file')
        );

        return $this->send('POST', "vehicles/{$vehicleId}/avatar", $headers, $stream);
    }
}
