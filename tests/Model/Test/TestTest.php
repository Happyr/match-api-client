<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Test\Test;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

class TestTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "test",
        "id": "c980d2f8-c864-4d38-8233-c2bbef439125",
        "attributes": []
    }
}

JSON;
        $model = Test::createFromArray(json_decode($json, true));
        $this->assertEquals('c980d2f8-c864-4d38-8233-c2bbef439125', $model->getId());
    }
}
