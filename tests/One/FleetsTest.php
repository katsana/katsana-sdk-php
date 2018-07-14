<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class FleetTest extends TestCase
{
    /** @test */
    public function it_can_list_fleets()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/fleets')
                        ->shouldResponseWith(200, '{"fleets":[]}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets')
                        ->all();

        $data = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_list_fleets_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Fleets')
                    ->all();
    }

    /** @test */
    public function it_can_show_single_fleet()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/fleets/105')
                        ->shouldResponseWith(200, '{"fleet":null}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets')
                        ->get(105);

        $data = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_show_single_fleet_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Fleets')
                    ->get(105);
    }
}
