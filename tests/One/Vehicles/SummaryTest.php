<?php

namespace Katsana\Sdk\Tests\One\Vehicles;

class SummaryTest extends TestCase
{
    /** @test */
    public function it_can_show_today()
    {
        $this->responseToToday(105, 'Vehicles.Summary', 'summaries/today');
    }

    /** @test */
    public function it_can_show_yesterday()
    {
        $this->responseToYesterday(105, 'Vehicles.Summary', 'summaries/yesterday');
    }

    /** @test */
    public function it_can_show_month()
    {
        $this->responseToMonth(105, 'Vehicles.Summary', 'summaries/2014/4');
    }

    /** @test */
    public function it_can_show_date()
    {
        $this->responseToDate(105, 'Vehicles.Summary', 'summaries/2014/4/1');
    }

    /** @test */
    public function it_can_show_duration()
    {
        $this->responseToDuration(105, 'Vehicles.Summary', 'summaries/duration');
    }
}
