<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\Test\Test as Model;
use HappyrMatch\ApiClient\Model\Test\TestTypeCollection;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Test extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(string $role, array $types, string $redirectUri)
    {
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::allString($types, 'Types must be an array with strings');
        Assert::notEmpty($redirectUri, 'RedirectUri cannot be empty');

        $response = $this->httpPost('/api/tests', [
            'role' => $role,
            'types' => $types,
            'redirect_uri' => $redirectUri,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @throws Exception
     *
     * @return ResponseInterface|TestTypeCollection
     */
    public function getTypes()
    {
        $response = $this->httpGet('/api/test-types');
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, TestTypeCollection::class);
    }
}
