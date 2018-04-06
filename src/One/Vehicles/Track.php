<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;

class Track extends Request
{
    /**
     * Get travel for today.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function today($vehicleId)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/today",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for yesterday.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function yesterday($vehicleId)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for the date.
     *
     * @param int $vehicleId
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function date($vehicleId, $year, $month = 1, $day = 1)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for a duration.
     *
     * @param int    $vehicleId
     * @param string $start
     * @param string $end
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function duration($vehicleId, $start, $end)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
