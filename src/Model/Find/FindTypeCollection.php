<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Find;

use HappyrMatch\ApiClient\Model\AbstractCollection;
use HappyrMatch\ApiClient\Model\CreatableFromArray;
use HappyrMatch\ApiClient\Model\Role\RoleCategory;

final class FindTypeCollection extends AbstractCollection implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $items = [];

        foreach ($data as $item) {
            $items[] = FindType::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}
