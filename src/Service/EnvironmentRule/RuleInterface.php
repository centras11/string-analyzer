<?php

declare(strict_types=1);

namespace Analyzer\Service\EnvironmentRule;

/**
 * Interface RuleInterface
 * @package Analyzer\Service\EnvironmentRule
 */
interface RuleInterface
{
    /**
     * @param string $text
     *
     * @return array
     */
    public function getEnvironment(string $text): array;
}
