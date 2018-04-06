<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Support\MultipartRequest;

class Vehicles extends Request
{
    use MultipartRequest;

    /**
     * List all vehicles available for the user.
     *
     * @return \Katsana\Sdk\Response
     */
    public function index()
    {
        return $this->send('GET', 'vehicles', $this->getApiHeaders());
    }

    /**
     * Show single vehicle.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function show($id)
    {
        return $this->send('GET', "vehicles/{$id}", $this->getApiHeaders());
    }

    /**
     * Get vehicle current location.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function location($id)
    {
        return $this->send('GET', "vehicles/{$id}/location", $this->getApiHeaders());
    }

    /**
     * Update vehicle information.
     *
     * @param array $data
     *
     * @return \Katsana\Sdk\Response
     */
    public function update(array $data)
    {
        return $this->send('PATCH', "vehicles/{$id}", $this->getApiHeaders(), $data);
    }

    /**
     * Set the vehicle under lockdown mode.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function locked($id)
    {
        $body = [
            'mode' => 'parked',
        ];

        return $this->send('PATCH', "vehicles/{$id}", $this->getApiHeaders(), $body);
    }

    /**
     * Set the vehicle under working mode.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function unlock($id)
    {
        $body = [
            'mode' => 'working',
        ];

        return $this->send('PATCH', "vehicles/{$id}", $this->getApiHeaders(), $body);
    }

    /**
     * Upload profile avatar.
     *
     * @param int   $id
     * @param mixed $file
     *
     * @return \Katsana\Sdk\Response
     */
    public function uploadAvatar($id, $file)
    {
        list($headers, $stream) = $this->prepareMultipartRequestPayloads(
            $this->getApiHeaders(),
            $this->getApiBody(),
            compact('file')
        );

        return $this->send('POST', "vehicles/{$id}/avatar", $headers, $stream);
    }
}
