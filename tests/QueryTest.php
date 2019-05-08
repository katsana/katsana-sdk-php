<?php

namespace Katsana\Sdk\Tests;

use Katsana\Sdk\Query;

class QueryTest extends TestCase
{
    /** @test */
    public function it_can_be_initiated()
    {
        $query = Query::includes('drivemark', 'speed')
                    ->excludes('driver')
                    ->forPage(5);

        $this->assertSame([
            'includes' => 'drivemark,speed',
            'excludes' => 'driver',
            'page' => 5,
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_with_custom_timezone()
    {
        $query = Query::onTimeZone('Asia/Kuala_Lumpur');

        $this->assertSame([
            'timezone' => 'Asia/Kuala_Lumpur',
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_with_resetting_timezone()
    {
        $query = Query::onTimeZone(null);

        $this->assertSame([], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_when_includes_is_missing()
    {
        $query = Query::excludes('driver')
                    ->forPage(5);

        $this->assertSame([
            'excludes' => 'driver',
            'page' => 5,
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_when_excludes_is_missing()
    {
        $query = Query::includes('drivemark', 'speed')
                    ->forPage(5)
                    ->take(20);

        $this->assertSame([
            'includes' => 'drivemark,speed',
            'page' => 5,
            'per_page' => 20,
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_when_page_is_missing()
    {
        $query = Query::includes('drivemark', 'speed')
                    ->excludes('driver');

        $this->assertSame([
            'includes' => 'drivemark,speed',
            'excludes' => 'driver',
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_without_per_page_when_page_is_missing()
    {
        $query = Query::includes('drivemark', 'speed')
                    ->excludes('driver')
                    ->take(20);

        $this->assertSame([
            'includes' => 'drivemark,speed',
            'excludes' => 'driver',
        ], $query->toArray());
    }

    /** @test */
    public function it_can_be_initiated_with_customs()
    {
        $query = Query::includes('drivemark', 'speed')
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
        $query = Query::includes('drivemark', 'speed')
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

    /** @test */
    public function it_cant_be_initiated_with_unsupported_method()
    {
        $this->expectException('BadMethodCallException');
        $this->expectExceptionMessage("Katsana\Sdk\Query::foo() method doesn't exist!");

        Query::foo(20);
    }
}
