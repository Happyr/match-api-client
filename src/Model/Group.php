<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model;

class Group implements CreatableFromArray
{
    private $id;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $model = new self();
        $model->id = $data['id'];

        return $model;
    }

    public function getId()
    {
        return $this->id;
    }
}
