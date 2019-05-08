<?php

namespace Katsana\Sdk\Tests;

use Mockery as m;
use Katsana\Sdk\Client;
use Laravie\Codex\Discovery;
use Laravie\Codex\Testing\Faker;

class ClientTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_has_proper_signature()
    {
        $faker = Faker::create();

        $client = new Client($faker->http());

        $this->assertInstanceOf('Laravie\Codex\Contracts\Client', $client);
        $this->assertSame('https://api.katsana.com', $client->getApiEndpoint());
        $this->assertSame('v1', $client->getApiVersion());
    }

    /** @test */
    public function it_can_be_initiated_using_make()
    {
        $faker = Faker::create();

        Discovery::override($faker->http());

        $client = Client::make('homestead', 'secret');

        $this->assertInstanceOf(Client::class, $client);
        $this->assertSame('homestead', $client->getClientId());
        $this->assertSame('secret', $client->getClientSecret());
        $this->assertNull($client->getAccessToken());
    }

    /** @test */
    public function it_can_be_initiated_using_personal_access_token()
    {
        $faker = Faker::create();

        Discovery::override($faker->http());

        $client = Client::personal('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $this->assertInstanceOf(Client::class, $client);
        $this->assertNull($client->getClientId());
        $this->assertNull($client->getClientSecret());
        $this->assertSame('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF', $client->getAccessToken());
    }

    /** @test */
    public function it_can_use_the_default_timezone_on_request()
    {
        $faker = Faker::create();

        Discovery::override($faker->http());

        $client = Client::personal('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');

        $request = m::mock('Laravie\Codex\Contracts\Request');
        $request->shouldReceive('setClient')->once()->with($client)->andReturnNull()
            ->shouldReceive('onTimeZone')->once()->with('UTC')->andReturnNull();

        $this->assertSame($request, $client->via($request));
    }

    /** @test */
    public function it_can_use_different_timezone_on_request()
    {
        $faker = Faker::create();

        Discovery::override($faker->http());

        $client = Client::personal('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $client->onTimeZone('Asia/Kuala_Lumpur');

        $request = m::mock('Laravie\Codex\Contracts\Request');
        $request->shouldReceive('setClient')->once()->with($client)->andReturnNull()
            ->shouldReceive('onTimeZone')->once()->with('Asia/Kuala_Lumpur')->andReturnNull();

        $this->assertSame($request, $client->via($request));
    }
}
