<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\Role\Role as Model;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Role extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(array $param)
    {
        $response = $this->httpPost('/api/roles', $param);

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
     * @return Model|ResponseInterface
     */
    public function update(string $role, array $param)
    {
        Assert::notEmpty($role, 'Role cannot be empty');
        $response = $this->httpPut(sprintf('/api/roles/%s', $role), $param);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Accepted::class);
    }

    public function getCategories()
    {
        $response = $this->httpGet('/api/role-categories');
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (202 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, RoleCategoryCollection::class);
    }
}
