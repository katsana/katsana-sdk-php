<?php

namespace Katsana\Sdk\Passport;

use InvalidArgumentException;
use Katsana\Sdk\Request;
use Laravie\Codex\Contracts\Response;
use RuntimeException;

class PasswordGrant extends Request
{
    /**
     * Create access token.
     *
     * @param string      $username
     * @param string      $password
     * @param string|null $scope
     *
     * @return \Katsana\Sdk\Response
     */
    public function authenticate(string $username, string $password, ?string $scope = '*'): Response
    {
        $body = $this->mergeApiBody(
            \array_filter(\compact('username', 'password', 'scope'))
        );

        return $this->send('POST', 'oauth/token', $this->getApiHeaders(), $body)
                    ->validateWith(function ($statusCode, $response) {
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
    protected function getApiHeaders(): array
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
    protected function getApiBody(): array
    {
        $clientId = $this->client->getClientId();
        $clientSecret = $this->client->getClientSecret();

        if (empty($clientId) || empty($clientSecret)) {
            throw new InvalidArgumentException('Missing client_id and client_secret information!');
        }

        return [
            'scope' => '*',
            'grant_type' => 'password',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];
    }
}
