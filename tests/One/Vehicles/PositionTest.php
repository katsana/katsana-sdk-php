<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

class PositionTest extends TestCase
{
    /** @test */
    public function it_can_show_today()
    {
        $this->responseToToday(105, 'Vehicles.Position', 'positions/today');
    }

    /** @test */
    public function it_can_show_yesterday()
    {
        $this->responseToYesterday(105, 'Vehicles.Position', 'positions/yesterday');
    }

    /** @test */
    public function it_can_show_date()
    {
        $this->responseToDate(105, 'Vehicles.Position', 'positions/2014/4/1');
    }

    /** @test */
    public function it_can_show_duration()
    {
        $this->responseToDuration(105, 'Vehicles.Position', 'positions/duration');
    }
}
