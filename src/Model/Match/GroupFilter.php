<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Role;

use HappyrMatch\ApiClient\Model\CreatableFromArray;
use HappyrMatch\ApiClient\Model\Group;

final class GroupFilter implements CreatableFromArray
{
    private $id;
    private $candidates;
    private $group;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $model = new self();
        $group = $data['data']['relationships']['group-created']['data']['id'] ?? null;
        if (null !== $group) {
            foreach ($data['included'] as $included) {
                if ($included['id'] === $group && 'group' === $included['type']) {
                    $model->group = Group::createFromArray($included);
                }
            }
        }

        $data = $data['data'];
        $model->id = $data['id'];
        $model->candidates = $data['attributes']['candidates'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string[] ids of candidates
     */
    public function getCandidates(): array
    {
        return $this->candidates;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }
}
