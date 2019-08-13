<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Test;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class Test implements CreatableFromArray
{
    private $id;
    private $url;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'];
        $model = new self();
        $model->id = $data['id'];
        $model->url = $data['attributes']['url'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
