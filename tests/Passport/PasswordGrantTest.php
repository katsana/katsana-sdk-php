<?php

namespace Katsana\Sdk\Tests\Passport;

use Katsana\Sdk\Client;
use Laravie\Codex\Discovery;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;
use Katsana\Sdk\Passport\PasswordGrant;

class PasswordGrantTest extends TestCase
{
    /** @test */
    public function it_can_get_access_token()
    {
        $headers = ['Accept' => 'application/json'];
        $payloads = 'scope=%2A&grant_type=password&client_id=homestead&client_secret=secret&username=contact%40katsana.com&password=secret';

        $faker = Faker::create()
                    ->call('POST', $headers, $payloads)
                    ->expectEndpointIs('https://api.katsana.com/oauth/token')
                    ->shouldResponseWith(200, '{"token_type":"Bearer","expires_in":31535999,"access_token":"AckfSECXIvnK5r28GVIWUAxmbBSjTsmF","refresh_token":"wCDLf7qqGhVri5p4K4qdfA5kzqFt56HafDeIWDI60U1V0modBGPNweX"}');

        Discovery::override($faker->http());

        $client = Client::make('homestead', 'secret');

        $this->assertNull($client->getAccessToken());

        $response = $client->via(new PasswordGrant($client))
                        ->authenticate('contact@katsana.com', 'secret');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF', $response->toArray()['access_token']);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Unable to generate access token!
     */
    public function it_cant_get_access_token_when_authentication_return_other_than_200_http_status()
    {
        $headers = ['Accept' => 'application/json'];
        $payloads = 'scope=%2A&grant_type=password&client_id=homestead&client_secret=secret&username=dummy%40katsana.com&password=secret';

        $faker = Faker::create()
                    ->call('POST', $headers, $payloads)
                    ->expectEndpointIs('https://api.katsana.com/oauth/token')
                    ->shouldResponseWith(500)
                    ->expectReasonPhraseIs('Server not found');

        Discovery::override($faker->http());

        $client = Client::make('homestead', 'secret');

        $this->assertNull($client->getAccessToken());

        $client->via(new PasswordGrant($client))
                ->authenticate('dummy@katsana.com', 'secret');
    }
}
