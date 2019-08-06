<?php

namespace HappyrMatch\ApiClient\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Hydrate a PSR-7 response to something else.
 */
interface Hydrator
{
    public function hydrate(ResponseInterface $response, string $class);
}
