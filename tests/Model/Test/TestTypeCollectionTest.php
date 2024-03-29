<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Test;

use HappyrMatch\ApiClient\Model\Test\TestType;
use HappyrMatch\ApiClient\Model\Test\TestTypeCollection;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

class TestTypeCollectionTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": [
        {
            "type": "test-type",
            "id": "cde14106-d800-403d-8005-fac9df3f98c5",
            "attributes": {
                "name": "Personality",
                "visibility": "public"
            }
        },
        {
            "type": "test-type",
            "id": "ff7f1c4a-b25e-49d6-afb1-4643d9703630",
            "attributes": {
                "name": "Culture",
                "visibility": "public"
            }
        }
    ]
}
JSON;
        $model = TestTypeCollection::createFromArray(json_decode($json, true));
        $this->assertCount(2, $model);
        $this->assertInstanceOf(TestType::class, $model[0]);
        $this->assertEquals('cde14106-d800-403d-8005-fac9df3f98c5', $model[0]->getId());
    }
}
