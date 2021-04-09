<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\MatchApi;

use HappyrMatch\ApiClient\Model\Match\CandidateMatch;
use HappyrMatch\ApiClient\Model\Match\GroupMatch;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

/**
 * @internal
 */
final class GroupMatchTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": [
        {
            "type": "candidate-match",
            "id": "d503d4bf-8ab6-47fa-ab61-7c935e8cee4c",
            "attributes": {
                "match": true,
                "confidence": "medium",
                "grade": 3
            }
        },
        {
            "type": "candidate-match",
            "id": "65f24261-af5a-4b59-a63c-835ead7d97fa",
            "attributes": {
                "match": true,
                "confidence": "medium",
                "grade": 3
            }
        }
    ]
}
JSON;
        $model = GroupMatch::createFromArray(\json_decode($json, true));
        $this->assertCount(2, $model);
        $this->assertInstanceOf(CandidateMatch::class, $model[0]);
        $this->assertEquals('d503d4bf-8ab6-47fa-ab61-7c935e8cee4c', $model[0]->getId());
    }
}
