<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient;

use HappyrMatch\ApiClient\Http\AuthenticationPlugin;
use HappyrMatch\ApiClient\Http\Authenticator;
use HappyrMatch\ApiClient\Http\ClientConfigurator;
use HappyrMatch\ApiClient\Hydrator\Hydrator;
use HappyrMatch\ApiClient\Hydrator\ModelHydrator;
use Http\Client\HttpClient;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ApiClient
{
    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var ClientConfigurator
     */
    private $clientConfigurator;

    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     */
    public function __construct(
        ClientConfigurator $clientConfigurator,
        string $clientId,
        string $clientSecret,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->clientConfigurator = $clientConfigurator;
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
        $this->authenticator = new Authenticator($this->requestBuilder, $this->clientConfigurator->createConfiguredClient(), $clientId, $clientSecret);
    }

    public static function create(string $endpoint, string $clientId, string $clientSecret): self
    {
        $clientConfigurator = new ClientConfigurator();
        $clientConfigurator->setEndpoint($endpoint);

        return new self($clientConfigurator, $clientId, $clientSecret);
    }

    /**
     * Step 2 in the authentication process. See https://api.happyrmatch.com/doc/authentication.html for details.
     *
     * Warning, this will remove the current access token.
     */
    public function createNewAccessToken(string $code, string $redirectUri): ?string
    {
        $this->clientConfigurator->removePlugin(AuthenticationPlugin::class);

        return $this->authenticator->createAccessToken($code, $redirectUri);
    }

    /**
     * Authenticate the client with an access token. This should be the full access token object with
     * refresh token and expirery timestamps.
     *
     * ```php
     *   $accessToken = $client->createNewAccessToken('foo', 'bar');
     *   $client->authenticate($accessToken);
     *```
     */
    public function authenticate(string $accessToken): void
    {
        $this->clientConfigurator->removePlugin(AuthenticationPlugin::class);
        $this->clientConfigurator->appendPlugin(new AuthenticationPlugin($this->authenticator, $accessToken));
    }

    /**
     * The access token may have been refreshed during the requests. Use this function to
     * get back the (possibly) refreshed access token.
     */
    public function getAccessToken(): ?string
    {
        return $this->authenticator->getAccessToken();
    }

    public function find(): Api\Find
    {
        return new Api\Find($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function group(): Api\Group
    {
        return new Api\Group($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function match(): Api\Match
    {
        return new Api\Match($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function role(): Api\Role
    {
        return new Api\Role($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function test(): Api\Test
    {
        return new Api\Test($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function learn(): Api\Learn
    {
        return new Api\Learn($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    private function getHttpClient(): HttpClient
    {
        return $this->clientConfigurator->createConfiguredClient();
    }
}
