<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Client;
use Laravie\Codex\Discovery;
use Laravie\Codex\Testing\Faker;
use Mockery as m;
use PHPUnit\Framework\TestCase as PHPUnit;

abstract class TestCase extends PHPUnit
{
    /**
     * API Version.
     *
     * @var string
     */
    protected $apiVersion;

    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();

        Discovery::flush();
    }

    /**
     * Make KATSANA SDK Client.
     *
     * @param \Laravie\Codex\Testing\Faker $faker
     *
     * @return \Katsana\Sdk\Client
     */
    protected function makeClient(Faker $faker): Client
    {
        $client = (new Client($faker->http()))
                        ->setClientId('homestead')
                        ->setClientSecret('secret');

        if (! is_null($this->apiVersion)) {
            $client->useVersion($this->apiVersion);
        }

        return $client;
    }
}
