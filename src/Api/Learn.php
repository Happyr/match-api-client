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
     * @throws Exception
     *
     * @return ResponseInterface|Accepted
     */
    public function create(string $candidate, string $role, string $learnName, string $category, ?int $score = null)
    {
        Assert::notEmpty($candidate, 'Candidate cannot be empty');
        Assert::notEmpty($role, 'Role cannot be empty');
        Assert::notEmpty($learnName, 'Learn name cannot be empty');
        Assert::notEmpty($category, 'Category cannot be empty');
        Assert::inArray($category, [
            'application',
            'employed',
            'hard_performance_data',
            'interview',
            'recruiter_grade',
            'self_assessment',
            'soft_performance_data',
            ],
        'Invalid category');

        $response = $this->httpPost('/api/learn', [
            'candidate' => $candidate,
            'role' => $role,
            'name' => $learnName,
            'category' => $category,
            'score' => $score ?? 0,
        ]);

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
