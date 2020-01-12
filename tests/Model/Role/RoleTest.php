<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Role\Role;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

/**
 * @internal
 */
final class RoleTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data":
        {
            "type": "role",
            "id": "e286921e-acf4-4a29-988f-59faedc98f2b",
            "attributes": {}
        }
}
JSON;
        $model = Role::createFromArray(\json_decode($json, true));
        $this->assertEquals('e286921e-acf4-4a29-988f-59faedc98f2b', $model->getId());
    }
}
