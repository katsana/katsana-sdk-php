<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Tests\TestCase;

class WelcomeTest extends TestCase
{
    /** @test */
    public function show_application_version()
    {
        $response = $this->makeClient()
                        ->useVersion('v1')
                        ->resource('Welcome')
                        ->show();

        $actualStatusCode = $response->getStatusCode();

        $this->assertTrue($actualStatusCode === 200, "Expected response status 200, got {$actualStatusCode}");
        $this->assertContains('v1', $response->toArray()['api']);
    }
}
