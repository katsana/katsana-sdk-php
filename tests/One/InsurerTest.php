<?php

namespace Katsana\Sdk\Tests\One;

use Katsana\Sdk\Response;
use Katsana\Sdk\Tests\TestCase;
use Laravie\Codex\Testing\Faker;

class InsurerTest extends TestCase
{
    /**
     * API Version.
     *
     * @var string
     */
    private $apiVersion = 'v1';

    /** @test */
    public function it_can_get_list_of_insurers()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
            'Authorization' => 'Bearer '.static::ACCESS_TOKEN,
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/insurer/MY')
                        ->shouldResponseWith(200, '[{"country":"MY","name":"AIA","partner":false},{"country":"MY","name":"AIG","partner":false},{"country":"MY","name":"Allianz Malaysia Berhad","partner":true},{"country":"MY","name":"AmGeneral","partner":false},{"country":"MY","name":"Axa Affin","partner":false},{"country":"MY","name":"Berjaya Sompo","partner":false},{"country":"MY","name":"Chubb","partner":false},{"country":"MY","name":"Etiqa Insurance Berhad","partner":true},{"country":"MY","name":"Etiqa Takaful Berhad","partner":true},{"country":"MY","name":"Hong Leong","partner":false},{"country":"MY","name":"Kurnia","partner":false},{"country":"MY","name":"Liberty Insurance","partner":false},{"country":"MY","name":"Lonpac","partner":false},{"country":"MY","name":"MPI Generali","partner":false},{"country":"MY","name":"MSIG","partner":false},{"country":"MY","name":"RHB Insurance","partner":false},{"country":"MY","name":"Takaful Ikhlas","partner":false},{"country":"MY","name":"Takaful Malaysia","partner":false},{"country":"MY","name":"Tokio Marine","partner":false},{"country":"MY","name":"Zurich","partner":false}]');

        $response = $this->makeClientWithAccessToken($faker)
                        ->uses('Insurer')
                        ->all();

        $insurers = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
    }

    /** @test */
    public function it_can_get_list_of_insurers_without_access_token()
    {
        $headers = [
            'Accept' => 'application/vnd.KATSANA.v1+json',
        ];

        $faker = Faker::create()
                        ->call('GET', $headers)
                        ->expectEndpointIs('https://api.katsana.com/insurer/MY')
                        ->shouldResponseWith(200, '[{"country":"MY","name":"AIA","partner":false},{"country":"MY","name":"AIG","partner":false},{"country":"MY","name":"Allianz Malaysia Berhad","partner":true},{"country":"MY","name":"AmGeneral","partner":false},{"country":"MY","name":"Axa Affin","partner":false},{"country":"MY","name":"Berjaya Sompo","partner":false},{"country":"MY","name":"Chubb","partner":false},{"country":"MY","name":"Etiqa Insurance Berhad","partner":true},{"country":"MY","name":"Etiqa Takaful Berhad","partner":true},{"country":"MY","name":"Hong Leong","partner":false},{"country":"MY","name":"Kurnia","partner":false},{"country":"MY","name":"Liberty Insurance","partner":false},{"country":"MY","name":"Lonpac","partner":false},{"country":"MY","name":"MPI Generali","partner":false},{"country":"MY","name":"MSIG","partner":false},{"country":"MY","name":"RHB Insurance","partner":false},{"country":"MY","name":"Takaful Ikhlas","partner":false},{"country":"MY","name":"Takaful Malaysia","partner":false},{"country":"MY","name":"Tokio Marine","partner":false},{"country":"MY","name":"Zurich","partner":false}]');

        $response = $this->makeClient($faker)
                        ->uses('Insurer')
                        ->all();

        $insurers = $response->toArray();

        $this->assertInstanceOf(Response::class, $response);
    }
}
