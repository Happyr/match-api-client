<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Match extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return CandidateMatch|ResponseInterface
     */
    public function candidateMatch(string $candidate, string $role, string $type)
    {
        Assert::notEmpty($candidate, 'Candidate cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');

        $response = $this->httpGet(sprintf('/api/candidates/%s/match', $candidate), [
            'role_id' => $role,
            'type' => $type,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CandidateMatch::class);
    }

    public function groupMatch(string $group, string $role, string $type)
    {
        Assert::notEmpty($group, 'Group cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');

        $response = $this->httpGet(sprintf('/api/groups/%s/match', $group), [
            'role_id' => $role,
            'type' => $type,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, GroupMatch::class);
    }

    public function groupFilter(string $group, string $role, string $type)
    {
        Assert::notEmpty($group, 'Group cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');

        $response = $this->httpGet(sprintf('/api/groups/%s/match/filter', $group), [
            'role_id' => $role,
            'type' => $type,
        ]);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (201 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, GroupFilter::class);
    }
}
