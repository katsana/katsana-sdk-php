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
    public function today(int $vehicleId): Response
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
    public function yesterday(int $vehicleId): Response
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
    public function month(int $vehicleId, int $year, int $month = 1): Response
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
    public function date(int $vehicleId, int $year, int $month = 1, int $day = 1): Response
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
    public function duration(int $vehicleId, string $start, string $end): Response
    {
        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/summaries/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
