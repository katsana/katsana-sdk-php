<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;

class Summary extends Request
{
    /**
     * Get summaries for today.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function today($vehicleId)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/summaries/today",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for yesterday.
     *
     * @param int $vehicleId
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function yesterday($vehicleId)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/summaries/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for the month.
     *
     * @param int $vehicleId
     * @param int $year
     * @param int $month
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function month($vehicleId, $year, $month = 1)
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/summaries/{$year}/{$month}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for the date.
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
            "vehicles/{$vehicleId}/summaries/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for a duration.
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
            "vehicles/{$vehicleId}/summaries/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
