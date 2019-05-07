<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;
use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Track extends Request
{
    /**
     * Get travel for today.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function today(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/today",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Get travel for yesterday.
     *
     * @param int                     $vehicleId
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function yesterday(int $vehicleId, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/yesterday",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Get travel for the date.
     *
     * @param int                     $vehicleId
     * @param int                     $year
     * @param int                     $month
     * @param int                     $day
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function date(int $vehicleId, int $year, int $month = 1, int $day = 1, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/{$year}/{$month}/{$day}",
            $this->getApiHeaders(),
            $this->buildHttpQuery($query)
        );
    }

    /**
     * Get travel for a duration.
     *
     * @param int                     $vehicleId
     * @param string                  $start
     * @param string                  $end
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function duration(int $vehicleId, string $start, string $end, ?Query $query = null): Response
    {
        $this->requiresAccessToken();

        $payload = $this->buildHttpQuery($query);
        $payload['start'] = $start;
        $payload['end'] = $end;

        return $this->send(
            'GET',
            "vehicles/{$vehicleId}/tracks/duration",
            $this->getApiHeaders(),
            $payload
        );
    }
}
