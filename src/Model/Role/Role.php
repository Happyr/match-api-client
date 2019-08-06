<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Role;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class Role implements CreatableFromArray
{
    private $id;
    private $description;
    private $roleCategory;

    private $advertTitle;
    private $advertBodyText;
    private $advertBodyHtml;
    private $advertLink;

    private $country;
    private $region;
    private $city;
    private $address;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();

        $roleCategory = $data['data']['relationships']['category']['data']['id'] ?? null;
        foreach ($data['included'] as $included) {
            if ($included['id'] === $roleCategory && 'role-category' === $included['type']) {
                $model->roleCategory = RoleCategory::createFromArray($included);
            }
        }

        $data = $data['data'];
        $model->id = $data['id'];
        $model->description = $data['attributes']['description'];

        $model->advertTitle = $data['attributes']['advert']['title'];
        $model->advertBodyText = $data['attributes']['advert']['body_text'];
        $model->advertBodyHtml = $data['attributes']['advert']['body_html'];
        $model->advertLink = $data['attributes']['advert']['link'];

        $model->country = $data['attributes']['location']['country'];
        $model->region = $data['attributes']['location']['region'];
        $model->city = $data['attributes']['location']['city'];
        $model->address = $data['attributes']['location']['address'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRoleCategory(): RoleCategory
    {
        return $this->roleCategory;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdvertTitle(): string
    {
        return $this->advertTitle;
    }

    public function getAdvertBodyText(): string
    {
        return $this->advertBodyText;
    }

    public function getAdvertBodyHtml(): string
    {
        return $this->advertBodyHtml;
    }

    public function getAdvertLink(): string
    {
        return $this->advertLink;
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
