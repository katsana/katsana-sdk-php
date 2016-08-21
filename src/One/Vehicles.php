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
        return $this->send('GET', 'vehicles');
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
        return $this->send('GET', "vehicles/{$id}");
    }
}
