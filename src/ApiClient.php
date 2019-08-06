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
     * @var HttpClient
     */
    private $httpClient;

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
     * @var string|null
     */
    private $clientId;

    /**
     * @var string|null
     */
    private $clientSecret;

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
     * Autnenticate a user with the API. This will return an access token.
     * Warning, this will remove the current access token.
     */
    public function createNewAccessToken(string $username, string $password): ?string
    {
        $this->clientConfigurator->removePlugin(AuthenticationPlugin::class);

        return $this->authenticator->createAccessToken($username, $password);
    }

    /**
     * Autenticate the client with an access token. This should be the full access token object with
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

    public function custom(Hydrator $hydrator = null): Api\Custom
    {
        return new Api\Custom($this->getHttpClient(), $hydrator ?? $this->hydrator, $this->requestBuilder);
    }

    public function customer(): Api\Customer
    {
        return new Api\Customer($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function cart(): Api\Test
    {
        return new Api\Test($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function product(): Api\Product
    {
        return new Api\Product($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function taxon(): Api\Product\Taxon
    {
        return new Api\Product\Taxon($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    public function checkout(): Api\Checkout
    {
        return new Api\Checkout($this->getHttpClient(), $this->hydrator, $this->requestBuilder);
    }

    private function getHttpClient(): HttpClient
    {
        return $this->clientConfigurator->createConfiguredClient();
    }
}
