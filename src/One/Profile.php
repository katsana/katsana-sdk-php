<?php

namespace Katsana\Sdk\One;

use Laravie\Codex\Support\MultipartRequest;

class Profile extends Request
{
    use MultipartRequest;

    /**
     * Show user profile.
     *
     * @return \Laravie\Codex\Response
     */
    public function show()
    {
        return $this->send('GET', 'profile', $this->getApiHeaders());
    }

    /**
     * Upload profile avatar.
     *
     * @param  mixed  $file
     *
     * @return \Laravie\Codex\Response
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
