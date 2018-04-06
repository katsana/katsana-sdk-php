<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Query;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Exceptions\UnauthorizedHttpException;
use Laravie\Codex\Support\MultipartRequest;

class Profile extends Request
{
    use MultipartRequest;

    /**
     * Show user profile.
     *
     * @param \Katsana\Sdk\Query|null $query
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function get(?Query $query = null): Response
    {
        $this->requiresAccessToken();

        return $this->send('GET', 'profile', $this->getApiHeaders(), $this->buildHttpQuery($query));
    }

    /**
     * Update user profile.
     *
     * @param array $payload
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function update(array $payload): Response
    {
        $this->requiresAccessToken();

        $headers = ['Content-Type' => 'application/json'];

        return $this->send(
            'PATCH', 'profile', $this->mergeApiHeaders($headers), $this->mergeApiBody($payload)
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
        } catch (UnauthorizedHttpException $e) {
            return false;
        }

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
