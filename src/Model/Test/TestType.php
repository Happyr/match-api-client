<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Test;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class TestType implements CreatableFromArray
{
    private $id;
    private $name;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->id = $data['id'];
        $model->name = $data['attributes']['name'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
