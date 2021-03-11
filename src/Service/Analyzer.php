<?php

declare(strict_types=1);

namespace Analyzer\Service;

/**
 * Class Analyzer
 * @package Analyzer\Service
 */
class Analyzer
{
    private StringParser $stringParser;

    /**
     * Analyzer constructor.
     */
    public function __construct()
    {
        $this->stringParser = new StringParser();
    }

    public function analyze(string $fileName, string $environment): array
    {
        $dataForAnalyze = $this->stringParser->getDataForAnalyze($fileName, $environment);

        return [];
    }
}
