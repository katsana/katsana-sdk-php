<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

use Katsana\Sdk\Response;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Testing\Faker;

class SharingTest extends TestCase
{
    /** @test */
    public function it_can_list_sharing()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105/sharing')
                        ->shouldResponseWith(200, '[{"id":250,"device_id":105,"user_id":73,"token":"anNUjJM1Qa","url":"https:\/\/my.katsana.com\/shares\/anNUjJM1Qa","description":null,"active":true,"started_at":"2018-04-07 02:03:44","ended_at":"2018-04-10 02:03:44","deleted_at":null}]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles.Sharing')
                        ->all(105);

        $sharing = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(250, $sharing[0]['id']);
        $this->assertSame('https://my.katsana.com/shares/anNUjJM1Qa', $sharing[0]['url']);
        $this->assertSame('anNUjJM1Qa', $sharing[0]['token']);
        $this->assertTrue($sharing[0]['active']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_can_list_sharing_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles.Sharing')
                    ->all(105);
    }

    /** @test */
    public function it_can_create_sharing()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
            'Content-Type' => 'application/json',
        ];

        $faker = Faker::create()
                        ->call('POST', $headers, '{"description":"Going on vacation!","duration":"3D"}')
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105/sharing')
                        ->shouldResponseWith(200, '{"id":250,"device_id":105,"user_id":73,"token":"anNUjJM1Qa","url":"https:\/\/my.katsana.com\/shares\/anNUjJM1Qa","description":null,"active":true,"started_at":"2018-04-07 02:03:44","ended_at":"2018-04-10 02:03:44","deleted_at":null}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles.Sharing')
                        ->create(105, 'Going on vacation!', '3D');

        $sharing = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(250, $sharing['id']);
        $this->assertSame('https://my.katsana.com/shares/anNUjJM1Qa', $sharing['url']);
        $this->assertSame('anNUjJM1Qa', $sharing['token']);
        $this->assertTrue($sharing['active']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_can_create_sharing_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles.Sharing')
                    ->create(105, 'Going on vacation!');
    }

    /** @test */
    public function it_can_update_sharing()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
            'Content-Type' => 'application/json',
        ];

        $faker = Faker::create()
                        ->call('PATCH', $headers, '{"description":"Going on vacation!","duration":"3D"}')
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105/sharing/250')
                        ->shouldResponseWith(200, '{"id":250,"device_id":105,"user_id":73,"token":"anNUjJM1Qa","url":"https:\/\/my.katsana.com\/shares\/anNUjJM1Qa","description":null,"active":true,"started_at":"2018-04-07 02:03:44","ended_at":"2018-04-10 02:10:44","deleted_at":null}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles.Sharing')
                        ->update(105, 250, 'Going on vacation!', '3D');

        $sharing = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(250, $sharing['id']);
        $this->assertSame('https://my.katsana.com/shares/anNUjJM1Qa', $sharing['url']);
        $this->assertSame('anNUjJM1Qa', $sharing['token']);
        $this->assertTrue($sharing['active']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_can_update_sharing_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles.Sharing')
                    ->update(105, 250, 'Going on vacation!');
    }

    /** @test */
    public function it_can_delete_sharing()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('DELETE', $headers)
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105/sharing/250')
                        ->shouldResponseWith(204, '');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles.Sharing')
                        ->destroy(105, 250);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(204, $response->getStatusCode());
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_can_delete_sharing_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles.Sharing')
                    ->destroy(105, 250);
    }
}
