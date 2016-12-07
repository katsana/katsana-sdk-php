<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Client;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    public function makeClient()
    {
        $client = Client::make($_ENV['CLIENT_ID'], $_ENV['CLIENT_SECRET']);
        $endpoint = isset($_ENV['ENDPOINT']) ? $_ENV['ENDPOINT'] : null;

        if (! is_null($endpoint)) {
            $client->useCustomApiEndpoint($endpoint);
        }

        return $client;
    }
}
