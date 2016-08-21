<?php

namespace Katsana\Sdk\One;

class Profile extends Request
{
    /**
     * Show user profile.
     *
     * @return \Laravie\Codex\Response
     */
    public function show()
    {
        return $this->send('GET', 'profile');
    }
}
