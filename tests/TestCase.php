<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Client;
use Laravie\Codex\Discovery;
use Laravie\Codex\Testing\FakeRequest as Faker;
use Mockery as m;
use PHPUnit\Framework\TestCase as PHPUnit;

abstract class TestCase extends PHPUnit
{
    const CLIENT_ID = 'homestead';
    const CLIENT_SECRET = 'secret';
    const ACCESS_TOKEN = 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF';

    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion;

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
     * @param \Laravie\Codex\Testing\FakeRequest $faker
     *
     * @return \Katsana\Sdk\Client
     */
    protected function makeClient(Faker $faker): Client
    {
        $client = new Client($faker->http(), static::CLIENT_ID, static::CLIENT_SECRET);

        if (! is_null($this->apiVersion)) {
            $client->useVersion($this->apiVersion);
        }

        return $client;
    }

    /**
     * Make KATSANA SDK Client.
     *
     * @param \Laravie\Codex\Testing\FakeRequest $faker
     *
     * @return \Katsana\Sdk\Client
     */
    protected function makeClientWithAccessToken(Faker $faker): Client
    {
        return $this->makeClient($faker)->setAccessToken(static::ACCESS_TOKEN);
    }
}
