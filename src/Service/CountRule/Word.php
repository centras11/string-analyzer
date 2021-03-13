<?php

declare(strict_types=1);

namespace Analyzer\Service\CountRule;

/**
 * Class Word
 * @package Analyzer\Service\CountRule
 */
class Word implements CountRuleInterface
{
    /**
     * @inheritDoc
     */
    public function count(string $text): int
    {
        return str_word_count($text);
    }
}
