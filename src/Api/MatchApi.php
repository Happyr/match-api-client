<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\MatchApi\CandidateMatch;
use HappyrMatch\ApiClient\Model\MatchApi\GroupFilter;
use HappyrMatch\ApiClient\Model\MatchApi\GroupMatch;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class MatchApi extends HttpApi
{
    /**
     * @throws Exception
     *
     * @return CandidateMatch|ResponseInterface
     */
    public function candidateMatch(string $candidate, string $role, string $type, ?string $language = null)
    {
        Assert::notEmpty($candidate, 'Candidate cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($type, 'Type cannot be empty');
        Assert::nullOrStringNotEmpty($language, 'Languge can only be null or not empty');

        $data = [
            'role' => $role,
            'type' => $type,
        ];

        if (null !== $language) {
            $data['language'] = $language;
        }

        $response = $this->httpGet(sprintf('/api/candidates/%s/match', $candidate), $data);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (200 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, CandidateMatch::class);
    }

    /**
     * @throws Exception
     *
     * @return ResponseInterface|GroupMatch
     */
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

    /**
     * @throws Exception
     *
     * @return ResponseInterface|GroupFilter
     */
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
