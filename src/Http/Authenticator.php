<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Http;

use HappyrMatch\ApiClient\RequestBuilder;
use Http\Client\HttpClient;

/**
 * Helper class to get access tokens.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 *
 * @internal this class should not be used outside of the API Client, it is not part of the BC promise
 */
final class Authenticator
{
    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var string|null
     */
    private $accessToken;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    public function __construct(RequestBuilder $requestBuilder, HttpClient $httpClient, string $clientId, string $clientSecret)
    {
        $this->requestBuilder = $requestBuilder;
        $this->httpClient = $httpClient;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function createAccessToken(string $code, string $redirectUri): ?string
    {
        $request = $this->requestBuilder->create('POST', '/oauth/token', [
            'Content-type' => 'application/x-www-form-urlencoded',
        ], \http_build_query([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectUri,
            'code' => $code,
        ]));

        $response = $this->httpClient->sendRequest($request);
        if (200 !== $response->getStatusCode()) {
            return null;
        }

        $this->accessToken = $response->getBody()->__toString();

        return $this->accessToken;
    }

    public function refreshAccessToken(string $accessToken, string $refreshToken): ?string
    {
        $request = $this->requestBuilder->create('POST', '/oauth/token', [
            'Authorization' => \sprintf('Bearer %s', $accessToken),
            'Content-type' => 'application/x-www-form-urlencoded',
        ], \http_build_query([
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]));

        $response = $this->httpClient->sendRequest($request);
        if (200 !== $response->getStatusCode()) {
            return null;
        }

        $this->accessToken = $response->getBody()->__toString();

        return $this->accessToken;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }
}
