<?php

namespace Katsana\Sdk\One\Vehicles;

use Katsana\Sdk\One\Request;

class Travel extends Request
{
    /**
     * Get travel for today.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function today($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/travels/today",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for yesterday.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function yesterday($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/travels/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get travel for the date.
     *
     * @param  int  $id
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     *
     * @return \Laravie\Codex\Response
     */
    public function date($id, $year, $month = 1, $day = 1)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/travels/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }
}
