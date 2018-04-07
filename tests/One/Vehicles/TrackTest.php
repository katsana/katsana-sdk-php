<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

class TrackTest extends TestCase
{
    /** @test */
    public function it_can_show_today()
    {
        $this->responseToToday(105, 'Vehicles.Track', 'tracks/today');
    }

    /** @test */
    public function it_can_show_yesterday()
    {
        $this->responseToYesterday(105, 'Vehicles.Track', 'tracks/yesterday');
    }

    /** @test */
    public function it_can_show_date()
    {
        $this->responseToDate(105, 'Vehicles.Track', 'tracks/2014/4/1');
    }

    /** @test */
    public function it_can_show_duration()
    {
        $this->responseToDuration(105, 'Vehicles.Track', 'tracks/duration');
    }
}
