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
        return $this->send('GET', 'vehicles', $this->getApiHeaders(), $query->toArray());
    }

    /**
     * Show single vehicle.
     *
     * @param int                     $id
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show($id, Query $query = null)
    {
        return $this->send('GET', "vehicles/{$id}", $this->getApiHeaders(), $query->toArray());
    }

    /**
     * Get vehicle current location.
     *
     * @param int $id
     *
     * @return \Laravie\Codex\Contracts\Response
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
     * @return \Laravie\Codex\Contracts\Response
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
     * @return \Laravie\Codex\Contracts\Response
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
     * @return \Laravie\Codex\Contracts\Response
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
     * @return \Laravie\Codex\Contracts\Response
     */
    public function uploadAvatar($id, $file): Response
    {
        list($headers, $stream) = $this->prepareMultipartRequestPayloads(
            $this->getApiHeaders(),
            $this->getApiBody(),
            compact('file')
        );

        return $this->send('POST', "vehicles/{$id}/avatar", $headers, $stream);
    }
}
