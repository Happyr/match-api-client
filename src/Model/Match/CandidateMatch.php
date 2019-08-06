<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\Role;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class CandidateMatch implements CreatableFromArray
{
    private $id;
    private $match;
    private $confidence;
    private $grade;
    private $dimensionScore;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'] ?? $data;
        $model = new self();
        $model->id = $data['id'];
        $model->match = $data['attributes']['match'];
        $model->confidence = $data['attributes']['confidence'];
        $model->grade = $data['attributes']['grade'];
        $model->dimensionScore = $data['attributes']['dimension_score'];

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMatch(): bool
    {
        return $this->match;
    }

    public function getConfidence(): string
    {
        return $this->confidence;
    }

    public function getGrade(): int
    {
        return $this->grade;
    }

    public function getDimensionScore(): array
    {
        return $this->dimensionScore;
    }
}
