<?php

namespace Katsana\Sdk\Tests;

use Mockery as m;
use Laravie\Codex\Discovery;
use PHPUnit\Framework\TestCase as PHPUnit;

abstract class TestCase extends PHPUnit
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown()
    {
        m::close();

        Discovery::flush();
    }
}
