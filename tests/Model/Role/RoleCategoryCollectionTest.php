<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Role\RoleCategory;
use HappyrMatch\ApiClient\Model\Role\RoleCategoryCollection;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

/**
 * @internal
 */
final class RoleCategoryCollectionTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": [
        {
            "type": "role-category",
            "id": "e286921e-acf4-4a29-988f-59faedc98f2b",
            "attributes": {
                "language": "sv",
                "name": "Role 0"
            }
        },
        {
            "type": "role-category",
            "id": "618e7c39-86b1-493d-84da-b9d0e4015d4e",
            "attributes": {
                "language": "sv",
                "name": "Role 1"
            }
        }
    ]
}
JSON;
        $model = RoleCategoryCollection::createFromArray(\json_decode($json, true));
        self::assertCount(2, $model);
        self::assertInstanceOf(RoleCategory::class, $model[0]);
        self::assertEquals('e286921e-acf4-4a29-988f-59faedc98f2b', $model[0]->getId());
    }
}
