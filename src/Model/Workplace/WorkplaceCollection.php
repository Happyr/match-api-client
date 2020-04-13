<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Workplace;

use HappyrMatch\ApiClient\Model\AbstractCollection;
use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class WorkplaceCollection extends AbstractCollection implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $items = [];

        foreach ($data as $item) {
            $items[] = Workplace::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}
