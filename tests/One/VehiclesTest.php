<?php

namespace Katsana\Sdk\Tests\One;

use GuzzleHttp\Psr7\Stream;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;
use Mockery as m;

class VehicleTest extends TestCase
{
    /** @test */
    public function it_can_list_vehicles()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/vehicles')
                        ->shouldResponseWith(200, '{"devices":[{"id":105,"user_id":1,"imei":"356173063386671","description":"Peugeot 308","vehicle_number":"WXG 3365","current":{"latitude":3.0093493,"longitude":101.5976447,"speed":0,"state":"idle","ignition":false,"voltage":12485,"gsm":3,"tracked_at":"2017-01-09 13:31:51"},"avatar":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png","marker":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png","today_max_speed":60.47518,"odometer":124277,"ends_at":"2020-08-30 16:00:00","timezone":"Asia/Kuala_Lumpur"}]}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles')
                        ->all();

        $data = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(105, $data['devices'][0]['id']);
        $this->assertSame('Peugeot 308', $data['devices'][0]['description']);
        $this->assertSame('WXG 3365', $data['devices'][0]['vehicle_number']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_list_vehicles_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles')
                    ->all();
    }

    /** @test */
    public function it_can_show_single_vehicle()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105')
                        ->shouldResponseWith(200, '{"device":{"id":105,"user_id":1,"imei":"356173063386671","description":"Peugeot 308","vehicle_number":"WXG 3365","current":{"latitude":3.0093493,"longitude":101.5976447,"speed":0,"state":"idle","ignition":false,"voltage":12485,"gsm":3,"tracked_at":"2017-01-09 13:31:51"},"avatar":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png","marker":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png","today_max_speed":60.47518,"odometer":124277,"ends_at":"2020-08-30 16:00:00","timezone":"Asia/Kuala_Lumpur"}}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles')
                        ->get(105);

        $data = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(105, $data['device']['id']);
        $this->assertSame('Peugeot 308', $data['device']['description']);
        $this->assertSame('WXG 3365', $data['device']['vehicle_number']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_show_single_vehicle_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles')
                    ->get(105);
    }

    /** @test */
    public function it_can_show_vehicle_location()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/vehicles/105/location')
                        ->shouldResponseWith(200, '{"id":105,"latitude":3.0093493,"longitude":101.5976447,"speed":0,"state":"idle","ignition":false,"voltage":12485,"gsm":3,"tracked_at":"2017-01-09 13:31:51"}');


        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles')
                        ->location(105);

        $data = $response->toArray();
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_show_vehicle_location_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles')
                    ->location(105);
    }

    /** @test */
    public function it_can_upload_avatar()
    {
        $faker = Faker::create()
                        ->call('POST', m::type('Array'), m::type(Stream::class))
                        ->expectEndpointIs('https://api.katsana.com/vehicles/888/avatar')
                        ->shouldResponseWith(200, '{"url":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.png","thumb":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png","marker":"https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles')
                        ->uploadAvatar(888, __DIR__.'/../stubs/katsana-logo.png');

        $avatar = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame('https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.png', $avatar['url']);
        $this->assertSame('https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.thumb.png', $avatar['thumb']);
        $this->assertSame('https://my.katsana.com/pictures/device-105/04375b22-d454-11e5-8724-f23c9126a0cc.marker.png', $avatar['marker']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_upload_avatar_without_access_token()
    {
        $this->makeClient(Faker::create())
                    ->uses('Vehicles')
                    ->uploadAvatar(888, __DIR__.'/../stubs/katsana-logo.png');
    }
}
