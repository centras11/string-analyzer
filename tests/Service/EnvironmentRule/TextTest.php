<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service\EnvironmentRule;

use Analyzer\Service\EnvironmentRule\EnvironmentRuleInterface;
use Analyzer\Service\EnvironmentRule\Text;
use PHPUnit\Framework\TestCase;

/**
 * Class LineTest
 * @package Analyzer\Tests\Service\EnvironmentRule
 */
class TextTest extends TestCase
{
    use TextTrait;
    
    private Text $text;

    public function setUp()
    {
        $this->text = new Text();
    }

    public function testMustImplementCorrectInterface(): void
    {
        self::assertInstanceOf(EnvironmentRuleInterface::class, $this->text);
    }

    public function testMustCountCorrectly(): void
    {
        $text = $this->getText();
        $results = $this->text->getEnvironment($text);

        self::assertCount(13, $results);
        self::assertSame('Ąžuolas – bukinių šeimos medžių gentis.', $results[0]);
        self::assertSame('Sed nec dictum est.', $results[12]);
    }
}
