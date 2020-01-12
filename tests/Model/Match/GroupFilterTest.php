<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Group;
use HappyrMatch\ApiClient\Model\Match\GroupFilter;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

/**
 * @internal
 */
final class GroupFilterTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "group-match-filtered",
        "id": "b5c98cac-9837-4df4-b053-0bc7eb6f70f6",
        "attributes": {
            "candidates": [
                "0861cebe-60ee-47b5-b5e7-0f5d6c5bf2b0",
                "0c3395a6-66a4-485a-8451-caedfcfebc45",
                "135a6233-ebe1-423b-adbe-5cb742d0c146",
                "6cce6daf-5e0e-4e42-929b-879692b44dc2",
                "aba04eaa-fee1-43f6-85da-46af63ce88cf"
            ]
        },
        "relationships": {
            "group-created": {
                "data": {
                    "type": "group",
                    "id": "65fc109f-a19b-467b-9c15-83920eeaa2b6"
                }
            }
        }
    },
    "included": [
        {
            "type": "group",
            "id": "65fc109f-a19b-467b-9c15-83920eeaa2b6",
            "attributes": []
        }
    ]
}
JSON;
        $model = GroupFilter::createFromArray(\json_decode($json, true));
        $this->assertCount(5, $model->getCandidates());
        $this->assertInstanceOf(Group::class, $model->getGroup());
        $this->assertEquals('65fc109f-a19b-467b-9c15-83920eeaa2b6', $model->getGroup()->getId());
    }

    public function testCreateWithoutGroup()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "group-match-filtered",
        "id": "b5c98cac-9837-4df4-b053-0bc7eb6f70f6",
        "attributes": {
            "candidates": [
                "0861cebe-60ee-47b5-b5e7-0f5d6c5bf2b0",
                "0c3395a6-66a4-485a-8451-caedfcfebc45",
                "135a6233-ebe1-423b-adbe-5cb742d0c146",
                "6cce6daf-5e0e-4e42-929b-879692b44dc2",
                "aba04eaa-fee1-43f6-85da-46af63ce88cf"
            ]
        }
    }
}
JSON;
        $model = GroupFilter::createFromArray(\json_decode($json, true));
        $this->assertCount(5, $model->getCandidates());
        $this->assertNull($model->getGroup());
    }
}
