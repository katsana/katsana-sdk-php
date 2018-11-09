<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Response;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Testing\Faker;

class ProfileTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion = 'v1';

    /** @test */
    public function it_can_show_user_profile()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/profile')
                        ->shouldResponseWith(200, '{"id":73,"email":"hanna@katsana.com","address":"Lot 2805, Jalan Damansara,\r\n60000 Kuala Lumpur.","phone_home":"60123456789","phone_mobile":"60123456789","fullname":"Hanna Syahira","meta":{"emergency":{"fullname":"","phone":{"home":"","mobile":""}}},"avatar":null,"timezone":"Asia/Kuala_Lumpur","created_at":"2016-09-06 21:23:53","updated_at":"2016-12-18 12:10:20"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Profile')
                        ->get();

        $user = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(73, $user['id']);
        $this->assertSame('hanna@katsana.com', $user['email']);
        $this->assertSame('Hanna Syahira', $user['fullname']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_show_user_profile_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Profile')
                ->get();
    }

    /** @test */
    public function it_can_update_user_profile()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
            'Content-Type' => 'application/json',
        ];

        $payload = [
            'fullname' => 'Hanna is a bot',
        ];

        $faker = Faker::create()
                        ->call('PATCH', $headers, json_encode($payload))
                        ->expectEndpointIs('https://api.katsana.com/profile')
                        ->shouldResponseWith(200, '{"id":73,"email":"hanna@katsana.com","address":"Lot 2805, Jalan Damansara,\r\n60000 Kuala Lumpur.","phone_home":"60123456789","phone_mobile":"60123456789","fullname":"Hanna is a bot","meta":{"emergency":{"fullname":"","phone":{"home":"","mobile":""}}},"avatar":null,"timezone":"Asia/Kuala_Lumpur","created_at":"2016-09-06 21:23:53","updated_at":"2016-12-18 12:10:20"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Profile')
                        ->update($payload);

        $user = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(73, $user['id']);
        $this->assertSame('hanna@katsana.com', $user['email']);
        $this->assertSame('Hanna is a bot', $user['fullname']);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_update_user_profile_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Profile')
                ->update(['fullname' => 'Hanna is a bot']);
    }

    /** @test */
    public function it_can_verify_valid_password()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('POST', $headers, 'password=secret%21')
                        ->expectEndpointIs('https://api.katsana.com/auth/verify')
                        ->shouldResponseWith(200, '{"success":true}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Profile')
                        ->verifyPassword('secret!');

        $this->assertTrue($response);
    }

    /** @test */
    public function it_cant_verify_invalid_password()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->call('POST', $headers, 'password=secret%21%21')
                        ->expectEndpointIs('https://api.katsana.com/auth/verify')
                        ->shouldResponseWith(401, '{"success":false}')
                        ->expectReasonPhraseIs('Unauthorized');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Profile')
                        ->verifyPassword('secret!!');

        $this->assertFalse($response);
    }

    /**
     * @test
     * @expectedException \Katsana\Sdk\Exceptions\MissingAccessToken
     * @expectedExceptionMessage Request requires valid access token to be available!
     */
    public function it_cant_verify_valid_password_without_access_token()
    {
        $this->makeClient(Faker::create())
                ->uses('Profile')
                ->verifyPassword('secret!');
    }

    /** @test */
    public function it_can_upload_avatar()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
            'Time-Zone' => 'UTC',
        ];

        $faker = Faker::create()
                        ->stream('POST', $headers)
                        ->expectEndpointIs('https://api.katsana.com/profile/avatar')
                        ->shouldResponseWith(200, '{"url":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.png","thumb":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.thumb.png","marker":"https://my.katsana.com/pictures/user-73/0153cf08-31e2-11e6-99b7-08002777c33d.marker.png"}');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Profile')
                        ->uploadAvatar(__DIR__.'/../stubs/katsana-logo.png');

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
                ->uses('Profile')
                ->uploadAvatar(__DIR__.'/../stubs/katsana-logo.png');
    }
}
