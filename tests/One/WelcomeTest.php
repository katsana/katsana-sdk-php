<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Client;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class WelcomeTest extends TestCase
{
    /** @test */
    public function it_can_show_welcome_message()
    {
        $faker = Faker::create()
                        ->call('GET', ['Accept' => 'application/vnd.KATSANA.v1+json'])
                        ->expectEndpointIs('https://api.katsana.com')
                        ->shouldResponseWith(200, '{"platform":"v5.0.0","api":["v1"]}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
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
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com')
                        ->shouldResponseWith(200, '{"platform":"v5.0.0","api":["v1"]}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
                        ->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF')
                        ->uses('Welcome')
                        ->show();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertContains('v5.0.0', $response->toArray()['platform']);
        $this->assertContains('v1', $response->toArray()['api']);
    }
}
