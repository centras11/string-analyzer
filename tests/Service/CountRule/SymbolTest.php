<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service\CountRule;

use Analyzer\Service\CountRule\CountRuleInterface;
use Analyzer\Service\CountRule\Symbol;
use PHPUnit\Framework\TestCase;

/**
 * Class SymbolTest
 * @package Analyzer\Tests\Service\CountRule
 */
class SymbolTest extends TestCase
{
    private Symbol $symbol;

    public function setUp()
    {
        $this->symbol = new Symbol();
    }

    public function testMustImplementCorrectInterface(): void
    {
        self::assertInstanceOf(CountRuleInterface::class, $this->symbol);
    }

    /**
     * @param string $text
     * @param int $expected
     * @dataProvider provideCasesForCounting
     */
    public function testMustCountCorrectly(string $text, int $expected): void
    {
        self::assertSame(
            $expected,
            $this->symbol->count($text)
        );
    }

    /**
     * @return array
     */
    public function provideCasesForCounting(): array
    {
        return [
            [
                'Ąžuolas – bukinių šeimos medžių gentis.',
                39
            ],
            [
                'ultrices quam. Sed nec dictum est.',
                34
            ],
        ];
    }
}
