<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class PlaceTest extends TestCase
{

    /** @test */
    public function it_can_query_places()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/places?latitude=3.161907&longitude=101.617514')
                        ->shouldResponseWith(200, '{"areas":[],"locations":[],"address":null}');

        $response = $this->makeClientWithAccessToken($faker)
            ->uses('Place')
            ->query(3.161907, 101.617514);

        $data = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
    }

    /** @test */
    public function it_cant_query_places_without_access_token()
    {
        $this->expectException('Katsana\Sdk\Exceptions\MissingAccessToken');
        $this->expectExceptionMessage('Request requires valid access token to be available!');

        $this->makeClient(Faker::create())
            ->uses('Place')
            ->query(3.161907, 101.617514);
    }
}
