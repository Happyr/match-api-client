<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Workplace;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class Workplace implements CreatableFromArray
{
    private $id;
    private $organization;
    private $name;
    private $country;
    private $region;
    private $city;
    private $address;

    public static function createFromArray(array $data)
    {
        $data = isset($data['data']) ? $data['data'] : $data;
        $model = new self();
        $model->id = $data['id'];
        $model->organization = $data['attributes']['organization'];
        $model->name = $data['attributes']['name'];
        $model->country = $data['attributes']['country'];
        $model->region = $data['attributes']['region'];
        $model->city = $data['attributes']['city'];
        $model->address = $data['attributes']['address'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrganization(): string
    {
        return $this->organization;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
