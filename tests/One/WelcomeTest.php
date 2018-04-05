<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Client;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\FakeRequest;

class WelcomeTest extends TestCase
{
    /** @test */
    public function it_can_show_welcome_message()
    {
        $faker = FakeRequest::create()
                        ->call('GET', ['Accept' => 'application/vnd.KATSANA.v1+json'], '')
                        ->expectEndpointIs('https://api.katsana.com')
                        ->shouldResponseWith(200, '{"platform":"v5.0.0","api":["v1"]}');

        $response = (new Client($faker->http(), 'katsana', 'sdk'))
                        ->useVersion('v1')
                        ->uses('Welcome')
                        ->show();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertContains('v5.0.0', $response->toArray()['platform']);
        $this->assertContains('v1', $response->toArray()['api']);
    }
}
