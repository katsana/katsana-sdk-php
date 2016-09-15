<?php

namespace Katsana\Sdk\One\Vehicles;

use DateTime;
use Katsana\Sdk\One\Request;

class Summary extends Request
{
    /**
     * Get summaries for today.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function today($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/summaries/today",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for yesterday.
     *
     * @param  int  $id
     *
     * @return \Laravie\Codex\Response
     */
    public function yesterday($id)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/summaries/yesterday",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for the month.
     *
     * @param  int  $id
     * @param  int  $year
     * @param  int  $month
     *
     * @return \Laravie\Codex\Response
     */
    public function month($id, $year, $month = 1)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/summaries/{$year}/{$month}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for the date.
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
            "vehicles/{$id}/summaries/{$year}/{$month}/{$day}",
            $this->getApiHeaders()
        );
    }

    /**
     * Get summaries for a duration.
     *
     * @param  int  $id
     * @param  string  $start
     * @param  string  $end
     *
     * @return \Laravie\Codex\Response
     */
    public function duration($id, $start, $end)
    {
        return $this->send(
            'GET',
            "vehicles/{$id}/summaries/duration",
            $this->getApiHeaders(),
            compact('start', 'end')
        );
    }
}
