<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Find;


use HappyrMatch\ApiClient\Model\Find\FindType;
use HappyrMatch\ApiClient\Model\Find\FindTypeCollection;
use HappyrMatch\ApiClient\Model\Test\TestType;
use HappyrMatch\ApiClient\Model\Test\TestTypeCollection;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

class FindTypeCollectionTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": [
        {
            "type": "find-type",
            "id": "8a624af8-903a-4e7f-b4fa-c96b9afd8a52",
            "attributes": {
                "name": "Small"
            }
        },
        {
            "type": "find-type",
            "id": "8669e18e-57e4-478d-b026-b934cc6b6ab0",
            "attributes": {
                "name": "Medium"
            }
        }
    ]
}
JSON;
        $model = FindTypeCollection::createFromArray(json_decode($json, true));
        $this->assertCount(2, $model);
        $this->assertInstanceOf(FindType::class, $model[0]);
        $this->assertEquals('8a624af8-903a-4e7f-b4fa-c96b9afd8a52', $model[0]->getId());
    }
}
