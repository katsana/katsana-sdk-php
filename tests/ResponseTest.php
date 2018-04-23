<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Response;
use Laravie\Codex\Discovery;
use Laravie\Codex\Testing\Faker;

class ResponseTest extends TestCase
{
     /** @test */
    public function it_has_proper_signature()
    {
        $faker = Faker::create()
                    ->shouldResponseWith(200, '{"status":"OK"}');

        $response = new Response($faker->message());

        $this->assertInstanceOf('Laravie\Codex\Contracts\Response', $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('{"status":"OK"}', $response->getBody());
        $this->assertSame(['status' => 'OK'], $response->toArray());
    }
}
