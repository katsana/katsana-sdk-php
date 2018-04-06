<?php

namespace Katsana\Sdk\Tests\One;

use GuzzleHttp\Psr7\Stream;
use Katsana\Sdk\Client;
use Katsana\Sdk\Response;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Testing\Faker;
use Mockery as m;

class ProfileTest extends TestCase
{
    /** @test */
    public function it_can_show_user_profile()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/profile')
                        ->shouldResponseWith(200, '{"id":73,"email":"crynobone@gmail.com","address":"Lot 2805, Jalan Damansara,\r\n60000 Kuala Lumpur.","phone_home":"60123456789","phone_mobile":"60123456789","fullname":"Mior Muhammad Zaki","meta":{"emergency":{"fullname":"","phone":{"home":"","mobile":""}}},"avatar":null,"timezone":"Asia/Kuala_Lumpur","created_at":"2016-09-06 21:23:53","updated_at":"2016-12-18 12:10:20"}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
                        ->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF')
                        ->uses('Profile')
                        ->show();

        $user = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(73, $user['id']);
        $this->assertSame('crynobone@gmail.com', $user['email']);
    }

    /** @test */
    public function it_can_verify_valid_password()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $faker = Faker::create()
                        ->call('POST', $headers, 'password=secret%21')
                        ->expectEndpointIs('https://api.katsana.com/auth/verify')
                        ->shouldResponseWith(200, '{"success":true}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
                        ->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF')
                        ->uses('Profile')
                        ->verifyPassword('secret!');

        $this->assertTrue($response);
    }

    /** @test */
    public function it_cant_verify_invalid_password()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer AckfSECXIvnK5r28GVIWUAxmbBSjTsmF',
        ];

        $faker = Faker::create()
                        ->call('POST', $headers, 'password=secret%21%21')
                        ->expectEndpointIs('https://api.katsana.com/auth/verify')
                        ->shouldResponseWith(200, '{"success":false}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
                        ->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF')
                        ->uses('Profile')
                        ->verifyPassword('secret!!');

        $this->assertFalse($response);
    }

    /** @test */
    public function it_can_upload_avatar()
    {
        $faker = Faker::create()
                        ->call('POST', m::type('Array'), m::type(Stream::class))
                        ->expectEndpointIs('https://api.katsana.com/profile/avatar')
                        ->shouldResponseWith(200, '{"url":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.png","thumb":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.png","marker":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.marker.png"}');

        $response = (new Client($faker->http(), 'homestead', 'secret'))
                        ->useVersion('v1')
                        ->setAccessToken('AckfSECXIvnK5r28GVIWUAxmbBSjTsmF')
                        ->uses('Profile')
                        ->uploadAvatar(__DIR__.'/../stubs/katsana-logo.png');

        $avatar = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.png', $avatar['url']);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.png', $avatar['thumb']);
        $this->assertSame('https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.marker.png', $avatar['marker']);
    }
}