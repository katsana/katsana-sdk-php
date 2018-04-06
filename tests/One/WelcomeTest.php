<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class WelcomeTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion = 'v1';

    /** @test */
    public function it_can_show_welcome_message()
    {
        $faker = Faker::create()
                        ->call('GET', ['Accept' => 'application/vnd.KATSANA.v1+json'])
                        ->expectEndpointIs('https://api.katsana.com')
                        ->shouldResponseWith(200, '{"platform":"v5.0.0","api":["v1"]}');

        $response = $this->makeClient($faker)
                        ->uses('Welcome')
                        ->show();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertContains('v5.0.0', $response->toArray()['platform']);
        $this->assertContains('v1', $response->toArray()['api']);
    }

    /** @test */
    public function it_can_show_welcome_message_with_access_token()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com')
                        ->shouldResponseWith(200, '{"platform":"v5.0.0","api":["v1"]}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Welcome')
                        ->show();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertContains('v5.0.0', $response->toArray()['platform']);
        $this->assertContains('v1', $response->toArray()['api']);
    }
}
