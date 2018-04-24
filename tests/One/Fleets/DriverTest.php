<?php

namespace Katsana\Sdk\Tests\One\Fleets;

use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class DriverTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion = 'v1';

    /** @test */
    public function it_can_list_drivers()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->send('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/fleets/1/drivers')
                        ->shouldResponseWith(200, '{"drivers":[{"id":3,"fullname":"Ahmad Justin Yeo","identification":"830214015065","identification_type":"mykad","avatar":null,"timezone":"Asia\/Kuala_Lumpur","created_at":"2018-04-24 08:58:14","updated_at":"2018-04-24 08:58:14"}]}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Driver')
                        ->all(1);

        $driver = $response->toArray()['drivers'];

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(3, $driver[0]['id']);
        $this->assertSame('Ahmad Justin Yeo', $driver[0]['fullname']);
        $this->assertSame('830214015065', $driver[0]['identification']);
        $this->assertSame('mykad', $driver[0]['identification_type']);
        $this->assertSame('Asia/Kuala_Lumpur', $driver[0]['timezone']);
        $this->assertNull($driver[0]['avatar']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_list_drivers_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Fleets.Driver')
                ->all(1);
    }

    /** @test */
    public function it_can_create_driver()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $payload = [
            'fullname' => 'Ahmad Justin Yeo',
            'identification' => '830214015065',
        ];

        $faker = Faker::create()
                        ->sendJson('POST', $headers, json_encode($payload))
                        ->expectEndpointIs('https://api.katsana.com/fleets/1/drivers')
                        ->shouldResponseWith(200, '{"driver":{"id":3,"fullname":"Ahmad Justin Yeo","identification":"830214015065","identification_type":"mykad","avatar":null,"timezone":"Asia\/Kuala_Lumpur","created_at":"2018-04-24 08:58:14","updated_at":"2018-04-24 08:58:14"}}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Driver')
                        ->create(1, 'Ahmad Justin Yeo', '830214015065');

        $driver = $response->toArray()['driver'];

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(3, $driver['id']);
        $this->assertSame('Ahmad Justin Yeo', $driver['fullname']);
        $this->assertSame('830214015065', $driver['identification']);
        $this->assertSame('mykad', $driver['identification_type']);
        $this->assertSame('Asia/Kuala_Lumpur', $driver['timezone']);
        $this->assertNull($driver['avatar']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_create_driver_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Fleets.Driver')
                ->create(1, 'Ahmad Justin Yeo', '830214015065');
    }

    /** @test */
    public function it_can_update_driver()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $payload = [
            'fullname' => 'Ahmad Justin Yeo',
            'identification' => '830214015065',
        ];

        $faker = Faker::create()
                        ->sendJson('POST', $headers, json_encode($payload))
                        ->expectEndpointIs('https://api.katsana.com/fleets/1/drivers/3')
                        ->shouldResponseWith(200, '{"driver":{"id":3,"fullname":"Ahmad Justin Yeo","identification":"830214015065","identification_type":"mykad","avatar":null,"timezone":"Asia\/Kuala_Lumpur","created_at":"2018-04-24 08:58:14","updated_at":"2018-04-24 08:58:14"}}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Driver')
                        ->update(1, 3, 'Ahmad Justin Yeo', '830214015065');

        $driver = $response->toArray()['driver'];

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(3, $driver['id']);
        $this->assertSame('Ahmad Justin Yeo', $driver['fullname']);
        $this->assertSame('830214015065', $driver['identification']);
        $this->assertSame('mykad', $driver['identification_type']);
        $this->assertSame('Asia/Kuala_Lumpur', $driver['timezone']);
        $this->assertNull($driver['avatar']);
    }
}
