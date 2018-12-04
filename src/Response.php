<?php

namespace Katsana\Sdk;

use Laravie\Codex\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * Validate the response object.
     *
     * @return $this
     */
    public function validate()
    {
        $this->abortIfRequestNotFound();
        $this->abortIfRequestUnauthorized();

        return $this;
    }
}
