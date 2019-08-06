<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Match;

use HappyrMatch\ApiClient\Model\AbstractCollection;
use HappyrMatch\ApiClient\Model\CreatableFromArray;
use HappyrMatch\ApiClient\Model\Role\CandidateMatch;
use HappyrMatch\ApiClient\Model\Role\RoleCategory;

final class GroupMatch extends AbstractCollection implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $items = [];

        foreach ($data as $item) {
            $items[] = CandidateMatch::createFromArray($item);
        }

        $model = new self();
        $model->setItems($items);

        return $model;
    }
}
