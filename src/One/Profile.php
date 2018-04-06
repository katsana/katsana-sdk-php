<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Support\MultipartRequest;

class Profile extends Request
{
    use MultipartRequest;

    /**
     * Show user profile.
     *
     * @param \Katsana\Sdk\Query $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send('GET', 'profile', $this->getApiHeaders(), $this->buildHttpQuery($query));
    }

    /**
     * Verify user password.
     *
     * @param string $password
     *
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        $this->requiresAccessToken();

        $response = $this->send(
            'POST',
            'auth/verify',
            $this->getApiHeaders(),
            $this->mergeApiBody(compact('password'))
        );

        return $response->toArray()['success'] === true;
    }

    /**
     * Upload profile avatar.
     *
     * @param mixed $file
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function uploadAvatar($file): Response
    {
        $this->requiresAccessToken();

        return $this->stream(
            'POST', 'profile/avatar', $this->getApiHeaders(), $this->getApiBody(), compact('file')
        );
    }
}
