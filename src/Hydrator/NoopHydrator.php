<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Do not hydrate to any object at all.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class NoopHydrator implements Hydrator
{
    /**
     * @throws \LogicException
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        throw new \LogicException('The NoopHydrator should never be called');
    }
}
