<?php

namespace Katsana\Sdk;

class Signature
{
    /**
     * Signature key.
     *
     * @var string
     */
    protected $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * Verify signature.
     *
     * @param \Katsana\Sdk\Response $response
     * @param int                   $threshold
     *
     * @return bool
     */
    final public function verify(Response $response, $threshold = 3600): bool
    {
        $s = explode(',', $response->getHeader('HTTP_X_SIGNATURE')[0]);
        list(, $timestamp) = explode('=', $s[0]);
        list(, $signature) = explode('=', $s[1]);

        $payload = $timestamp.'.'.$response->getBody();

        $compared = hash_hmac('sha256', $payload, $this->key);

        if (! hash_equals($compared, $signature)) {
            return false;
        }

        if ((time() - (int) $timestamp) > $threshold) {
            return false;
        }

        return true;
    }
}
