<?php

namespace Katsana\Sdk\Tests\One\Vehicles\Travel;

use Katsana\Sdk\Tests\One\Vehicles\TestCase;

class SummaryTest extends TestCase
{
    /** @test */
    public function it_can_show_today()
    {
        $this->responseToToday(105, 'Vehicles.Travel.Summary', 'travels/summaries/today');
    }

    /** @test */
    public function it_can_show_yesterday()
    {
        $this->responseToYesterday(105, 'Vehicles.Travel.Summary', 'travels/summaries/yesterday');
    }

    /** @test */
    public function it_can_show_month()
    {
        $this->responseToMonth(105, 'Vehicles.Travel.Summary', 'travels/summaries/2014/4');
    }

    /** @test */
    public function it_can_show_date()
    {
        $this->responseToDate(105, 'Vehicles.Travel.Summary', 'travels/summaries/2014/4/1');
    }

    /** @test */
    public function it_can_show_duration()
    {
        $this->responseToDuration(105, 'Vehicles.Travel.Summary', 'travels/summaries/duration');
    }
}
