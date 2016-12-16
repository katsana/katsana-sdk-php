<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;

class Sharing extends Request
{
    /**
     * List sharing vehicles.
     *
     * @param  int  $vehicleId
     *
     * @return \Katsana\Sdk\Response
     */
    public function index($vehicleId)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/sharing",
            $this->getApiHeaders()
        );
    }
}
