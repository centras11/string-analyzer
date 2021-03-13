<?php

declare(strict_types=1);

namespace Analyzer\Service\CountRule;

/**
 * Interface CountRuleInterface
 * @package Analyzer\Service\CountRule
 */
interface CountRuleInterface
{
    /**
     * @param string $text
     *
     * @return int
     */
    public function count(string $text): int;
}
