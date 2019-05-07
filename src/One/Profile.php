<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Concerns\Request\Json;
use Laravie\Codex\Concerns\Request\Multipart;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Exceptions\UnauthorizedException;

class Profile extends Request
{
    use Json, Multipart;

    /**
     * Show user profile.
     *
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Katsana\Sdk\Response
     */
    public function get(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send(
            'GET', 'profile', $this->getApiHeaders(), $this->buildHttpQuery($query)
        );
    }

    /**
     * Update user profile.
     *
     * @param array $payload
     *
     * @return \Katsana\Sdk\Response
     */
    public function update(array $payload): Response
    {
        $this->requiresAccessToken();

        return $this->sendJson(
            'PATCH', 'profile', $this->getApiHeaders(), $this->mergeApiBody($payload)
        );
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

        try {
            $response = $this->send(
                'POST',
                'auth/verify',
                $this->getApiHeaders(),
                $this->mergeApiBody(compact('password'))
            );
        } catch (UnauthorizedException $e) {
            return false;
        }

        return $response->toArray()['success'] === true;
    }

    /**
     * Upload profile avatar.
     *
     * @param string $file
     *
     * @return \Katsana\Sdk\Response
     */
    public function uploadAvatar(string $file): Response
    {
        $this->requiresAccessToken();

        return $this->stream(
            'POST', 'profile/avatar', $this->getApiHeaders(), $this->getApiBody(), compact('file')
        );
    }
}
