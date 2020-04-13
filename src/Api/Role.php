<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Hydrator\ArrayHydrator;
use HappyrMatch\ApiClient\Model\Accepted;
use HappyrMatch\ApiClient\Model\Role\Role as Model;
use HappyrMatch\ApiClient\Model\Role\RoleCategoryCollection;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class Role extends HttpApi
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
     * @return Accepted|ResponseInterface
     */
    public function update(string $role, array $param)
    {
        Assert::notEmpty($role, 'Role cannot be empty');
        $response = $this->httpPut(\sprintf('/api/roles/%s', $role), $param);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (202 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Accepted::class);
    }

    /**
     * @throws Exception
     *
     * @return RoleCategoryCollection|ResponseInterface|array
     */
    public function allCategories($rawArray = false)
    {
        $response = $this->httpGet('/api/roles/all-categories');

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        if ($rawArray) {
            return (new ArrayHydrator())->hydrate($response, RoleCategoryCollection::class);
        }

        return $this->hydrator->hydrate($response, RoleCategoryCollection::class);
    }

    /**
     * @throws Exception
     *
     * @return ResponseInterface|RoleCategoryCollection
     */
    public function search(string $name, string $language)
    {
        $response = $this->httpGet('/api/role-categories/search', ['language' => $language, 'name' => $name], ['Authorization' => '']);
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, RoleCategoryCollection::class);
    }
}
