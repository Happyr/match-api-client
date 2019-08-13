<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient;

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 *
 * @internal this class should not be used outside of the API Client, it is not part of the BC promise
 */
final class RequestBuilder
{
    private $requestFactory;
    private $streamFactory;

    public function __construct(
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?: Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * Creates a new PSR-7 request.
     *
     * @param array                       $headers name => value or name=>[value]
     * @param StreamInterface|string|null $body    request body
     */
    public function create(string $method, string $uri, array $headers = [], $body = null): RequestInterface
    {
        $request = $this->requestFactory->createRequest($method, $uri);
        foreach ($headers as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        if (null !== $body) {
            if (!$body instanceof StreamInterface) {
                $body = $this->streamFactory->createStream($body);
            }

            $request = $request->withBody($body);
        }

        return $request;
    }
}
