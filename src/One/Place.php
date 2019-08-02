<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Place extends Request
{
    /**
     * Query places by latitude and longitude.
     *
     * @param  float  $latitude
     * @param  float $longitude
     *
     * @return \Katsana\Sdk\Response
     */
    public function query($latitude, $longitude): Response
    {
        $this->requiresAccessToken();

        $query = Query::with('latitude', $latitude)->with('longitude', $longitude);

        return $this->send(
            'GET', "places", $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }
}
