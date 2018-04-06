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
    public function it_can_upload_avatar()
    {
        $faker = Faker::create()
                        ->call('POST', m::type('Array'), m::type(Stream::class))
                        ->expectEndpointIs('https://api.katsana.com/vehicles/888/avatar')
                        ->shouldResponseWith(200, '{"url":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.png","thumb":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.png","marker":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.marker.png"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Vehicles')
                        ->uploadAvatar(888, __DIR__.'/../stubs/katsana-logo.png');

        $avatar = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.png', $avatar['url']);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.png', $avatar['thumb']);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.marker.png', $avatar['marker']);
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
