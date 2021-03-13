<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service\CountRule;

use Analyzer\Service\CountRule\CountRuleInterface;
use Analyzer\Service\CountRule\Word;
use PHPUnit\Framework\TestCase;

/**
 * Class SymbolTest
 * @package Analyzer\Tests\Service\CountRule
 */
class WordTest extends TestCase
{
    private Word $word;

    public function setUp()
    {
        $this->word = new Word();
    }

    public function testMustImplementCorrectInterface(): void
    {
        self::assertInstanceOf(CountRuleInterface::class, $this->word);
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
            $this->word->count($text)
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
                6
            ],
            [
                'ultrices quam. Sed nec dictum est.',
                6
            ],
        ];
    }
}
