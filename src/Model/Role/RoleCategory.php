<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Role;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class RoleCategory implements CreatableFromArray
{
    private $id;
    private $name;
    private $language;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $model->id = $data['id'];
        $model->name = $data['attributes']['name'];
        $model->language = $data['attributes']['language'];

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

    public function getLanguage(): string
    {
        return $this->language;
    }
}
