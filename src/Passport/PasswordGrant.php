<?php

namespace Katsana\Sdk\Passport;

use Katsana\Sdk\Request;

class PasswordGrant extends Request
{
    /**
     * Create access token.
     *
     * @param  string  $username
     * @param  string  $password
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    public function authenticate($username, $password)
    {
        $body = $this->mergeApiBody(compact('username', 'password'));

        return $this->send('POST', 'oauth/token', $this->getApiHeaders(), $body)
                    ->validateWith(function($statusCode, $response) {
                        if ($statusCode !== 200) {
                            throw new RuntimeException('Unable to generate access token!');
                        }

                        $this->client->setAccessToken($response->toArray()['access_token']);
                    });
    }

    /**
     * Get API Header.
     *
     * @return array
     */
    protected function getApiHeaders()
    {
        return [
            'Accept' => 'application/json',
        ];
    }

    /**
     * Get API Body.
     *
     * @return array
     */
    protected function getApiBody()
    {
        return [
            'scope' => '*',
            'grant_type' => 'password',
            'client_id' => $this->client->getClientId(),
            'client_secret' => $this->client->getClientSecret(),
        ];
    }
}
