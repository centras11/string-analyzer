<?php

declare(strict_types=1);

namespace Analyzer\Service\EnvironmentRule;

/**
 * Interface EnvironmentRuleInterface
 * @package Analyzer\Service\EnvironmentRule
 */
interface EnvironmentRuleInterface
{
    /**
     * @param string $text
     *
     * @return array
     */
    public function getEnvironment(string $text): array;
}
