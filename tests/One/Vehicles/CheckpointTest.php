<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

class CheckpointTest extends TestCase
{
    /** @test */
    public function it_can_show_today()
    {
        $this->responseToToday(105, 'Vehicles.Checkpoint', 'checkpoints/today');
    }

    /** @test */
    public function it_can_show_yesterday()
    {
        $this->responseToYesterday(105, 'Vehicles.Checkpoint', 'checkpoints/yesterday');
    }

    /** @test */
    public function it_can_show_month()
    {
        $this->responseToMonth(105, 'Vehicles.Checkpoint', 'checkpoints/2014/4');
    }

    /** @test */
    public function it_can_show_date()
    {
        $this->responseToDate(105, 'Vehicles.Checkpoint', 'checkpoints/2014/4/1');
    }

    /** @test */
    public function it_can_show_duration()
    {
        $this->responseToDuration(105, 'Vehicles.Checkpoint', 'checkpoints/duration');
    }
}
