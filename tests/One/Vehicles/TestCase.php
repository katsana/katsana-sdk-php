<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

use Katsana\Sdk\Tests\TestCase as SdkTestCase;
use Laravie\Codex\Contracts\Response;
use Laravie\Codex\Testing\Faker;

abstract class TestCase extends SdkTestCase
{
    /**
     * Response to today.
     *
     * @param int    $vehicleId
     * @param string $resource
     * @param string $endpoint
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseToToday(int $vehicleId, string $resource, string $endpoint): Response
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs("https://api.katsana.com/vehicles/{$vehicleId}/{$endpoint}")
                        ->shouldResponseWith(200, '[]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses($resource)
                        ->today($vehicleId);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());

        return $response;
    }

    /**
     * Response to yesterday.
     *
     * @param int    $vehicleId
     * @param string $resource
     * @param string $endpoint
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseToYesterday(int $vehicleId, string $resource, string $endpoint): Response
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs("https://api.katsana.com/vehicles/{$vehicleId}/{$endpoint}")
                        ->shouldResponseWith(200, '[]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses($resource)
                        ->yesterday($vehicleId);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());

        return $response;
    }

    /**
     * Response to month.
     *
     * @param int    $vehicleId
     * @param string $resource
     * @param string $endpoint
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseToMonth(int $vehicleId, string $resource, string $endpoint): Response
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs("https://api.katsana.com/vehicles/{$vehicleId}/{$endpoint}")
                        ->shouldResponseWith(200, '[]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses($resource)
                        ->month($vehicleId, 2014, 4);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());

        return $response;
    }

    /**
     * Response to date.
     *
     * @param int    $vehicleId
     * @param string $resource
     * @param string $endpoint
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseToDate(int $vehicleId, string $resource, string $endpoint): Response
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs("https://api.katsana.com/vehicles/{$vehicleId}/{$endpoint}")
                        ->shouldResponseWith(200, '[]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses($resource)
                        ->date($vehicleId, 2014, 4, 1);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());

        return $response;
    }

    /**
     * Response to date.
     *
     * @param int    $vehicleId
     * @param string $resource
     * @param string $endpoint
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    protected function responseToDuration(int $vehicleId, string $resource, string $endpoint): Response
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $start = $this->convertToUtc('2014-04-01 04:00:00');
        $end = $this->convertToUtc('2014-04-01 11:00:00');

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs("https://api.katsana.com/vehicles/{$vehicleId}/{$endpoint}?start=".urlencode($start).'&end='.urlencode($end))
                        ->shouldResponseWith(200, '[]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses($resource)
                        ->duration($vehicleId, $start, $end);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());

        return $response;
    }

    /**
     * Convert timestamp to UTC format.
     *
     * @param string $timestamp
     *
     * @return string
     */
    private function convertToUtc(string $timestamp): string
    {
        $datetime = new \DateTime($timestamp, new \DateTimeZone('Asia/Kuala_Lumpur'));
        $datetime->setTimeZone(new \DateTimeZone('UTC'));

        return $datetime->format('Y-m-d H:i:s');
    }
}
