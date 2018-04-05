<?php

namespace Katsana\Sdk;

use Katsana\Sdk\Exceptions\UnauthorizedHttpException;
use Laravie\Codex\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * Validate response.
     *
     * @return $this
     */
    public function validate(): self
    {
        $this->validateUnauthorizedRequest();

        return $this;
    }

    /**
     * Validate for unauthorized request.
     *
     * @throws \Katsana\Sdk\Exceptions\UnauthorizedHttpException
     *
     * @return void
     */
    protected function validateUnauthorizedRequest(): void
    {
        if ($this->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($this);
        }
    }
}
