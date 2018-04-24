<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Signature;
use Laravie\Codex\Testing\Faker;

class SignatureTest extends TestCase
{
    /** @test */
    public function it_can_verify_response()
    {
        $now = time();
        $payload = '{"device_id":123,"event":"Device+mobilized"}';

        $response = $this->getMessageWithPayload('secret', $payload, $now);

        $signature = new Signature('secret');
        $this->assertTrue($signature->verifyFrom($response));
    }

    /** @test */
    public function it_cant_verify_response_given_invalid_signature()
    {
        $now = time();
        $payload = '{"device_id":123,"event":"Device+mobilized"}';

        $response = $this->getMessageWithPayload('secret!', $payload, $now);

        $signature = new Signature('secret');
        $this->assertFalse($signature->verifyFrom($response));
    }

    /** @test */
    public function it_can_verify_response_when_timestamp_exceed_treshold()
    {
        $now = time() - 3600;
        $payload = '{"device_id":123,"event":"Device+mobilized"}';

        $response = $this->getMessageWithPayload('secret', $payload, $now);

        $signature = new Signature('secret');
        $this->assertFalse($signature->verifyFrom($response, 60));
    }

    /**
     * Get mocked message with payload.
     *
     * @param string $key
     * @param string $payload
     * @param int    $timestamp
     *
     * @return \Mockery\MockeryInterface
     */
    protected function getMessageWithPayload(string $key, string $payload, int $timestamp)
    {
        $message = Faker::create()->message();
        $signature = hash_hmac('sha256', "{$timestamp}.{$payload}", $key);

        $message->shouldReceive('getHeader')->with('HTTP_X_SIGNATURE')->andReturn([
            "t={$timestamp},v1={$signature}",
        ])->shouldReceive('getBody')->andReturn($payload);

        return $message;
    }
}
