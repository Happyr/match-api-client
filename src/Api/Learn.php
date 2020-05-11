<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Api;

use HappyrMatch\ApiClient\Exception;
use HappyrMatch\ApiClient\Model\Accepted;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Learn extends HttpApi
{
    /**
     * @param 'application'|'employed'|'hard_performance_data'|'interview'|'recruiter_grade'|'self_assessment'|'self_assessment' $category
     *
     * @return ResponseInterface|Accepted
     *
     * @throws Exception
     */
    public function create(string $candidate, string $role, string $learnName, string $category, ?int $score = null)
    {
        Assert::notEmpty($candidate, 'Candidate cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($learnName, 'Learn name cannot be empty');
        Assert::notEmpty($category, 'Category cannot be empty');

        $data = [
            'candidate' => $candidate,
            'role' => $role,
            'name' => $learnName,
            'category' => $category,
        ];

        if (null !== $score) {
            $data['score'] = $score;
        }

        $response = $this->httpPost('/api/learn', $data);

        if (!$this->hydrator) {
            return $response;
        }

        // Use any valid status code here
        if (202 !== $response->getStatusCode()) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Accepted::class);
    }
}
