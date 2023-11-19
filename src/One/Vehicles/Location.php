<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;
use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Location extends Request
{
    /**
     * Get vehicle current location.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function current(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', "vehicles/{$vehicleId}/location", $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }

    /**
     * Get vehicle location at speficied time.
     *
     * @param int                     $vehicleId
     * @param string                  $timestamps
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function at(int $vehicleId, $timestamps, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', "vehicles/{$vehicleId}/location/at/{$timestamps}", $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }
}
