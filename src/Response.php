<?php

namespace Katsana\Sdk;

use Laravie\Codex\Response as BaseResponse;
use Katsana\Sdk\Exceptions\UnauthorizedHttpException;

class Response extends BaseResponse
{
    /**
     * Validate response.
     *
     * @return $this
     */
    public function validate()
    {
        $this->validateUnauthorizedRequest();

        return $this;
    }

    /**
     * Validate for unauthorized request.
     *
     * @return void
     *
     * @throws \Katsana\Sdk\Exceptions\UnauthorizedHttpException
     */
    protected function validateUnauthorizedRequest()
    {
        if ($this->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($this);
        }
    }
}
