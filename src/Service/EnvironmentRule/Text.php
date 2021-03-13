<?php

declare(strict_types=1);

namespace Analyzer\Service\EnvironmentRule;

/**
 * Class Text
 * @package Analyzer\Service\EnvironmentRule
 */
class Text implements EnvironmentRuleInterface
{
    private string $rule = '/\p{Lu}.*?\./su';

    /**
     * @inheritDoc
     */
    public function getEnvironment(string $text): array
    {
        preg_match_all($this->rule, $text, $matches);

        return $matches[0] ?? [];
    }
}
