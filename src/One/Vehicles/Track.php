<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;

class Track extends Request
{
    /**
     * Get travel for today.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function today($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/tracks/today",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for yesterday.
     *
     * @param int $id
     *
     * @return \Katsana\Sdk\Response
     */
    public function yesterday($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/tracks/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for the date.
     *
     * @param int $id
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return \Katsana\Sdk\Response
     */
    public function date($id, $year, $month = 1, $day = 1)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/tracks/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for a duration.
     *
     * @param int    $id
     * @param string $start
     * @param string $end
     *
     * @return \Katsana\Sdk\Response
     */
    public function duration($id, $start, $end)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/tracks/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
