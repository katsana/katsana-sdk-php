<?php

namespace Katsana\Sdk\One\Vehicles\Travel;

use Katsana\Sdk\One\Request;
use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Summary extends Request
{
    /**
     * Get travel for today.
     *
     * @param int                $vehicleId
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function today(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/travels/summaries/today",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Get travel for yesterday.
     *
     * @param int                $vehicleId
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function yesterday(int $vehicleId): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/travels/summaries/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for the month.
     *
     * @param int                $vehicleId
     * @param int                $year
     * @param int                $month
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function month(int $vehicleId, int $year, int $month = 1): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/travels/summaries/{$year}/{$month}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for the date.
     *
     * @param int                $vehicleId
     * @param int                $year
     * @param int                $month
     * @param int                $day
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function date(int $vehicleId, int $year, int $month = 1, int $day = 1): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/travels/summaries/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for a duration.
     *
     * @param int                $vehicleId
     * @param string             $start
     * @param string             $end
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function duration(int $vehicleId, string $start, string $end, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/travels/summaries/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
