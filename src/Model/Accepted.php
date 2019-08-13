<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model;

final class Accepted implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        return new self();
    }
}
