<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Match\CandidateMatch;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

/**
 * @internal
 */
final class CandidateMatchTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "candidate-match",
        "id": "1c227a66-92da-4192-bb0b-5103ed64b6a8",
        "attributes": {
            "match": true,
            "confidence": "medium",
            "grade": 3
        }
    }
}
JSON;
        $model = CandidateMatch::createFromArray(\json_decode($json, true));
        self::assertEquals('1c227a66-92da-4192-bb0b-5103ed64b6a8', $model->getId());
    }
}
