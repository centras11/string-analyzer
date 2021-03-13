<?php

declare(strict_types=1);

namespace Analyzer\Service;

use Analyzer\Service\CountRule\CountRuleInterface;
use Exception;

/**
 * Class Analyzer
 * @package Analyzer\Service
 */
class Analyzer
{
    private StringParser $stringParser;
    private CountRuleInterface $countRule;

    /**
     * Analyzer constructor.
     * @param StringParser $stringParser
     */
    public function __construct(StringParser $stringParser)
    {
        $this->stringParser = $stringParser;
    }

    /**
     * @param string $fileName
     * @param string $environment
     * @param string $count
     *
     * @return array
     * @throws Exception
     */
    public function analyze(string $fileName, string $environment, string $count): array
    {
        $data = [];
        $this->stringParser->setEnvironmentRule($environment);
        $dataForAnalyze = $this->stringParser->getDataForAnalyze($fileName);
        $this->setCountRule($count);

        foreach ($dataForAnalyze as $value) {
            $data[] = [
                'count' => $this->countRule->count($value),
                'value' => $value,
            ];
        }

        return $data;
    }

    /**
     * @param string $count
     *
     * @throws Exception
     */
    private function setCountRule(string $count): void
    {
        $ruleWithNameSpace = 'Analyzer\\Service\\CountRule\\' . $count;

        if (!class_exists($ruleWithNameSpace)) {
            // @todo throw custom exception
            throw new Exception('Not supported count rule: ' . $count);
        }

        $this->countRule = new $ruleWithNameSpace();
    }
}
