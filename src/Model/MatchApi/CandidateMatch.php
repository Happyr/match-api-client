<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\MatchApi;

use HappyrMatch\ApiClient\Model\CreatableFromArray;

final class CandidateMatch implements CreatableFromArray
{
    private $id;
    private $match;
    private $confidence;
    private $grade;
    private $dimensionScore;
    private $resultCulture;
    private $text;
    private $tests;

    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
        $data = $data['data'] ?? $data;
        $model = new self();
        $model->id = $data['id'];
        $model->match = $data['attributes']['match'] ?? null;
        $model->confidence = $data['attributes']['confidence'] ?? null;
        $model->grade = $data['attributes']['grade'] ?? null;
        $model->resultCulture = $data['attributes']['result_culture'] ?? null;
        $model->dimensionScore = $data['attributes']['dimension_score'] ?? [];
        $model->text = $data['attributes']['text'] ?? [];
        $model->tests = [];
        foreach ($data['attributes']['tests'] ?? [] as $test) {
            $model->tests[] = TestResult::create($test, $model->dimensionScore);
        }

        return $model;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMatch(): ?bool
    {
        return $this->match;
    }

    public function getConfidence(): ?string
    {
        return $this->confidence;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function getDimensionScore(): array
    {
        return $this->dimensionScore;
    }

    public function getText(): array
    {
        return $this->text;
    }

    public function getResultCulture(): ?int
    {
        return $this->resultCulture;
    }

    /**
     * @return TestResult[]
     */
    public function getTests(): array
    {
        return $this->tests;
    }
}
