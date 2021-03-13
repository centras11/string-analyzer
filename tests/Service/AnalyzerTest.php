<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service;

use Analyzer\Service\Analyzer;
use Analyzer\Service\StringParser;
use PHPUnit\Framework\TestCase;

/**
 * Class AnalyzerTest
 * @package Analyzer\Tests\Service
 */
class AnalyzerTest extends TestCase
{
    private Analyzer $analyzer;
    private StringParser $stringParser;

    public function setUp()
    {
        $this->stringParser = $this->createMock(StringParser::class);
        $this->analyzer = new Analyzer($this->stringParser);
    }

    /**
     * @group failing
     * @dataProvider provideCount
     */
    public function testMustReturnAnalyzedData(string $count, int $expected): void
    {
        $environment = 'anyValidEnvironment';
        $environmentData = ['Ąžuolas – bukinių šeimos medžių gentis.'];

        $this->stringParser->expects(self::once())
            ->method('setEnvironmentRule')
            ->with($environment);

        $this->stringParser->expects(self::once())
            ->method('getDataForAnalyze')
            ->willReturn($environmentData);

        $return = $this->analyzer->analyze('fileName', $environment, $count);
        self::assertSame($expected, $return[0]['count']);
        self::assertSame($environmentData[0], $return[0]['value']);
    }


    /**
     * @return array
     */
    public function provideCount(): array
    {
        return [
            [
                'Word',
                6
            ],
            [
                'Symbol',
                39
            ],
        ];
    }
}
