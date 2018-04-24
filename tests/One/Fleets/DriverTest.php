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
                        ->shouldResponseWith(200, '{"id":3,"fullname":"Ahmad Justin Yeo","identification":"830214015065","identification_type":"mykad","avatar":null,"timezone":"Asia\/Kuala_Lumpur","created_at":"2018-04-24 08:58:14","updated_at":"2018-04-24 08:58:14"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Driver')
                        ->create(1, 'Ahmad Justin Yeo', '830214015065');

        $user = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(3, $user['id']);
        $this->assertSame('Ahmad Justin Yeo', $user['fullname']);
        $this->assertSame('830214015065', $user['identification']);
        $this->assertSame('mykad', $user['identification_type']);
        $this->assertSame('Asia/Kuala_Lumpur', $user['timezone']);
        $this->assertNull($user['avatar']);
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
                        ->shouldResponseWith(200, '{"id":3,"fullname":"Ahmad Justin Yeo","identification":"830214015065","identification_type":"mykad","avatar":null,"timezone":"Asia\/Kuala_Lumpur","created_at":"2018-04-24 08:58:14","updated_at":"2018-04-24 08:58:14"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Driver')
                        ->update(1, 3, 'Ahmad Justin Yeo', '830214015065');

        $user = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(3, $user['id']);
        $this->assertSame('Ahmad Justin Yeo', $user['fullname']);
        $this->assertSame('830214015065', $user['identification']);
        $this->assertSame('mykad', $user['identification_type']);
        $this->assertSame('Asia/Kuala_Lumpur', $user['timezone']);
        $this->assertNull($user['avatar']);
    }
}
