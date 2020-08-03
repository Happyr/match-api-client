<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\Workplace\Workplace as Model;
use HappyrMatch\ApiClient\Model\Workplace\WorkplaceCollection;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class Workplace extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return WorkplaceCollection|ResponseInterface
     */
    public function index()
    {
        $response = $this->httpGet('/api/workplaces');

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, WorkplaceCollection::class);
    }

    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function show(string $id)
    {
        Assert::notEmpty($id, 'Workplace id cannot be empty');
        $response = $this->httpGet(\sprintf('/api/workplaces/%s', $id));

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(array $param)
    {
        $response = $this->httpPost('/api/workplaces', $param);

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
    public function update(string $id, array $param)
    {
        Assert::notEmpty($id, 'Workplace id cannot be empty');
        $response = $this->httpPut(\sprintf('/api/workplaces/%s', $id), $param);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @throws Exception
     *
     * @return ResponseInterface|null
     */
    public function delete(string $id)
    {
        $response = $this->httpDelete(\sprintf('/api/workplaces/%s', $id));
        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (204 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return null;
    }
}
