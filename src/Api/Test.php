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
    public function create(string $role, string $type, string $redirectUrl)
    {
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');
        Assert::notEmpty($redirectUrl, 'RedirectUrl cannot be empty');

        $response = $this->httpPost('/api/tests', [
            'role' => $role,
            'type' => $type,
            'redirect_url' => $redirectUrl,
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
