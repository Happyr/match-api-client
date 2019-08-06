<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Role;

use HappyrMatch\ApiClient\Model\AbstractCollection;
use HappyrMatch\ApiClient\Model\CreatableFromArray;
use HappyrMatch\ApiClient\Model\Role\RoleCategory;

final class RoleCategoryCollection extends AbstractCollection implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $items = [];

        foreach ($data as $item) {
            $items[] = RoleCategory::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}
