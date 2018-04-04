<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Query;

class QueryTest extends TestCase
{
    /** @test */
    public function it_can_be_initiated()
    {
        $query = Query::make()
                    ->includes('drivemark', 'speed')
                    ->excludes('driver')
                    ->forPage(5);

        $this->assertSame([
            'includes' => 'drivemark,speed',
            'excludes' => 'driver',
            'page' => 5,
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_with_customs()
    {
        $query = Query::make()
                    ->includes('drivemark', 'speed')
                    ->excludes('driver')
                    ->with('take', 1000)
                    ->forPage(5);

        $this->assertSame([
            'take' => 1000,
            'includes' => 'drivemark,speed',
            'excludes' => 'driver',
            'page' => 5,
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_build_with_custom_callback()
    {
        $query = Query::make()
                    ->includes('drivemark', 'speed')
                    ->excludes('driver')
                    ->with('take', 1000)
                    ->forPage(5);

        $this->assertSame([
            'content' => [
                'take' => 1000,
                'includes' => 'drivemark,speed',
                'excludes' => 'driver',
                'page' => 5,
            ],
        ], $query->build(function ($data, $customs) {
            return ['content' => array_merge($customs, $data)];
        }));
    }
}
