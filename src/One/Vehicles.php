<?php

namespace Katsana\Sdk\One;

class Vehicles extends Request
{
    /**
     * List all vehicles available for the user.
     *
     * @return \Laravie\Codex\Response
     */
    public function index()
    {
        return $this->send('GET', 'vehicles', $this->getApiHeaders());
    }

    /**
     * Show single vehicle.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function show($id)
    {
        return $this->send('GET', "vehicles/{$id}", $this->getApiHeaders());
    }

    /**
     * Get vehicle current location.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function location($id)
    {
        return $this->send('GET', "vehicles/{$id}/location", $this->getApiHeaders());
    }

    /**
     * Upload profile avatar.
     *
     * @param  int  $id
     * @param  mixed  $file
     *
     * @return \Laravie\Codex\Response
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
