<?php

namespace Katsana\Sdk\One;

use Katsana\Sdk\Request as BaseRequest;

abstract class Request extends BaseRequest
{
    /**
     * Version namespace.
     *
     * @var string
     */
    protected $version = 'v1';
}
