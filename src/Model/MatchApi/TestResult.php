<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model\MatchApi;

final class TestResult
{
    private $reportUrl;
    private $testType;
    private $displayName;
    private $score;
    private $dimensions;

    private function __construct()
    {
    }

    public static function create(array $data, array $dimensions)
    {
        $model = new self();
        $model->reportUrl = $data['report_url'];
        $model->testType = $data['test_type'];
        $model->displayName = $data['display_name'];
        $model->score = $data['test_result'];
        $model->dimensions = [];

        $dimensionByCode = [];
        foreach ($dimensions as $dimension) {
            $dimensionByCode[$dimension['code']] = $dimension;
        }

        foreach ($data['dimensions'] as $code) {
            $model->dimensions[] = $dimensionByCode[$code] ?? ['code' => $code];
        }

        return $model;
    }

    public function getReportUrl(): string
    {
        return $this->reportUrl;
    }

    public function getTestType(): string
    {
        return $this->testType;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return int|null
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return list<array{code: String, score?: int, name?: string, description?: string}>
     */
    public function getDimensions(): array
    {
        return $this->dimensions;
    }
}
