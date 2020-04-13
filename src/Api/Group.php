<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\Accepted;
use HappyrMatch\ApiClient\Model\Group as Model;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Group extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return Model|ResponseInterface
     */
    public function create(array $candidates = [])
    {
        $params = [];
        if (!empty($candidates)) {
            $params['candidates'] = $candidates;
        }

        $response = $this->httpPost('/api/groups', $params);

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
     * @return ResponseInterface|Accepted
     */
    public function addCandidates(string $group, array $candidates = [])
    {
        Assert::notEmpty($group, 'Group cannot be empty');
        Assert::notEmpty($candidates, 'Candidates cannot be empty');

        $params = [];
        if (!empty($candidates)) {
            $params['candidates'] = $candidates;
        }

        $response = $this->httpPost(sprintf('/api/groups/%s/candidates', $group), [
            'candidates' => $candidates,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Accepted::class);
    }
}
