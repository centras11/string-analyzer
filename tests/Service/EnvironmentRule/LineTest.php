<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service\EnvironmentRule;

use Analyzer\Service\EnvironmentRule\EnvironmentRuleInterface;
use Analyzer\Service\EnvironmentRule\Line;
use PHPUnit\Framework\TestCase;

/**
 * Class LineTest
 * @package Analyzer\Tests\Service\EnvironmentRule
 */
class LineTest extends TestCase
{
    use TextTrait;

    private Line $line;

    public function setUp()
    {
        $this->line = new Line();
    }

    public function testMustImplementCorrectInterface(): void
    {
        self::assertInstanceOf(EnvironmentRuleInterface::class, $this->line);
    }

    public function testMustCountCorrectly(): void
    {
        $text = $this->getText();
        $results = $this->line->getEnvironment($text);

        self::assertCount(5, $results);
        self::assertSame('Ąžuolas – bukinių šeimos medžių gentis.', $results[0]);
        self::assertSame('Sed nec dictum est.', $results[4]);
    }
}
