<?php

declare(strict_types=1);

namespace Analyzer\Service\CountRule;

/**
 * Class Word
 * @package Analyzer\Service\CountRule
 */
class Symbol implements CountRuleInterface
{
    /**
     * @inheritDoc
     */
    public function count(string $text): int
    {
        return mb_strlen($text, 'utf8');
    }
}
