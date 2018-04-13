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

    /**
     * Construct a new signature.
     *
     * @param string $key
     */
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
    final public function verify(Response $response, int $threshold = 3600): bool
    {
        return $this->verifyFrom(
            $response->getHeader('HTTP_X_SIGNATURE')[0],
            $response->getBody(),
            $threshold
        );
    }

    /**
     * Verify from header and body.
     *
     * @param string $header
     * @param string $body
     * @param int    $threshold
     *
     * @return bool
     */
    final public function verifyFrom(string $header, string $body, int $threshold = 3600): bool
    {
        $s = explode(',', $header);
        list(, $timestamp) = explode('=', $s[0]);
        list(, $signature) = explode('=', $s[1]);

        $payload = $timestamp.'.'.$body;

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
