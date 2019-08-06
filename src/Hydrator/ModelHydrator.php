<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Hydrator;

use HappyrMatch\ApiClient\Exception\HydrationException;
use HappyrMatch\ApiClient\Model\CreatableFromArray;
use Psr\Http\Message\ResponseInterface;

/**
 * Hydrate an HTTP response to domain object.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class ModelHydrator implements Hydrator
{
    public function hydrate(ResponseInterface $response, string $class)
    {
        $body = $response->getBody()->__toString();
        if (0 !== \mb_strpos($response->getHeaderLine('Content-Type'), 'application/json')) {
            throw new HydrationException('The ModelHydrator cannot hydrate response with Content-Type:'.$response->getHeaderLine('Content-Type'));
        }

        $data = \json_decode($body, true);
        if (\JSON_ERROR_NONE !== \json_last_error()) {
            throw new HydrationException(\sprintf('Error (%d) when trying to json_decode response', \json_last_error()));
        }

        if (\is_subclass_of($class, CreatableFromArray::class)) {
            $object = \call_user_func($class.'::createFromArray', $data);
        } else {
            $object = new $class($data);
        }

        return $object;
    }
}
