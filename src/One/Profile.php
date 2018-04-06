<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Support\MultipartRequest;

class Profile extends Request
{
    use MultipartRequest;

    /**
     * Show user profile.
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function show()
    {
        return $this->send('GET', 'profile', $this->getApiHeaders());
    }

    /**
     * Verify user password.
     *
     * @param string $password
     *
     * @return bool
     */
    public function verifyPassword($password)
    {
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
    public function uploadAvatar($file)
    {
        list($headers, $stream) = $this->prepareMultipartRequestPayloads(
            $this->getApiHeaders(),
            $this->getApiBody(),
            compact('file')
        );

        return $this->send('POST', 'profile/avatar', $headers, $stream);
    }
}
