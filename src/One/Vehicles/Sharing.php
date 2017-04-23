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

    /**
     * Create a new share.
     *
     * @param  int  $vehicleId
     * @param  string|null  $description
     * @param  string|null  $duration
     *
     * @return \Katsana\Sdk\Response
     */
    public function store($vehicleId, $description, $duration)
    {
        return $this->send(
            'POST',
            "vehicles/{$vehicleId}/sharing",
            $this->getApiHeaders(),
            $this->mergeApiBody(compact('description', 'duration'))
        );
    }

    /**
     * Update an existing share.
     *
     * @param  int  $vehicleId
     * @param  int  $sharingId
     * @param  string|null  $description
     * @param  string|null  $duration
     *
     * @return \Katsana\Sdk\Response
     */
    public function update($vehicleId, $sharingId, $description, $duration)
    {
        return $this->send(
            'PATCH',
            "vehicles/{$vehicleId}/sharing/{$sharingId}",
            $this->getApiHeaders(),
            $this->mergeApiBody(compact('description', 'duration'))
        );
    }

    /**
     * Delete an existing share.
     *
     * @param  int  $vehicleId
     * @param  int  $sharingId
     *
     * @return \Katsana\Sdk\Response
     */
    public function destroy($vehicleId, $sharingId)
    {
        return $this->send(
            'DELETE',
            "vehicles/{$vehicleId}/sharing/{$sharingId}",
            $this->getApiHeaders()
        );
    }
}
