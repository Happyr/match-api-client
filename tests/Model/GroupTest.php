<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model;

use HappyrMatch\ApiClient\Model\Group;
use HappyrMatch\ApiClient\Model\Product\Variant;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

class GroupTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "group",
        "id": "ed9f2d39-8c03-4524-beb2-daf6cf087b60",
        "attributes": []
    }
}
JSON;
        $model = Group::createFromArray(json_decode($json, true));
        $this->assertEquals('ed9f2d39-8c03-4524-beb2-daf6cf087b60', $model->getId());
    }
}
