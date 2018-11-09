<?php

namespace Katsana\Sdk\Tests\One\Fleets;

use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

class VehiclesTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion = 'v1';

    /** @test */
    public function it_can_list_vehicles()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->send('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/fleets/1/vehicles')
                        ->shouldResponseWith(200, '{"devices":[{"id":105,"user_id":1,"imei":"356173063386671","description":"Peugeot 308","vehicle_number":"WXG 3365","current":{"latitude":3.0093493,"longitude":101.5976447,"speed":0,"state":"idle","ignition":false,"voltage":12485,"gsm":3,"tracked_at":"2017-01-09 13:31:51"},"avatar":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png","marker":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png","today_max_speed":60.47518,"odometer":124277,"ends_at":"2020-08-30 16:00:00","timezone":"Asia/Kuala_Lumpur"}]}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Fleets.Vehicles')
                        ->all(1);

        $data = $response->toArray()['devices'];

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(105, $data[0]['id']);
        $this->assertSame('Peugeot 308', $data[0]['description']);
        $this->assertSame('WXG 3365', $data[0]['vehicle_number']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_list_vehicles_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Fleets.Vehicles')
                ->all(1);
    }
}
