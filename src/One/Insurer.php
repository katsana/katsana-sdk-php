<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;

class Insurer extends Request
{
    /**
     * Get all available insurer by country.
     *
     * @param string                  $country
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function all(string $country = 'MY', ?Query $query = null): Response
    {
        return $this->send('GET', "insurer/{$country}", $this->getApiHeaders(), $this->buildHttpQuery($query));
    }
}
