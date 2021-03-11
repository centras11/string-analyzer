<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service;

use Analyzer\Service\EnvironmentRule\RuleInterface;
use Analyzer\Service\StringParser;
use Analyzer\Tests\InvokeMethodTrait;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorControllerTest
 * @package CommissionTask\Tests\Controller
 */
class StringParserTest extends TestCase
{
    use InvokeMethodTrait;

    private StringParser $stringParser;

    public function setUp()
    {
        define('ROOT_DIR', __DIR__ . '/../../public');

        $this->stringParser = new StringParser();
    }

    public function testMustReturnFullPath(): void
    {
        $fileName = 'test.txt';
        $fullPath = ROOT_DIR . '/upload/' . $fileName;

        $return = $this->invokeMethod($this->stringParser, 'getFullPath', [$fileName]);
        self::assertSame($fullPath, $return);
    }

    public function testMustReadFileContent(): void
    {
        $fileName = 'sample.txt';
        $fullPath = ROOT_DIR . '/upload/' . $fileName;
        $content = file_get_contents($fullPath);

        $return = $this->invokeMethod($this->stringParser, 'readFile', [$fileName]);
        self::assertSame($content, $return);
    }

    /**
     * @param string $environment
     * @dataProvider provideCorrectEnvironments
     * @throws \ReflectionException
     */
    public function testMustGetCorrectEnvironmentRule(string $environment): void
    {
        $return = $this->invokeMethod($this->stringParser, 'getEnvironmentRule', [$environment]);
        self::assertInstanceOf(RuleInterface::class, $return);
    }

    /**
     * @param string $environment
     * @dataProvider provideWrongEnvironments
     * @throws \ReflectionException
     */
    public function testMustThrowExceptionIfNotSupportedEnvironment(string $environment): void
    {
        $this->expectException(Exception::class);
        $this->invokeMethod($this->stringParser, 'getEnvironmentRule', [$environment]);
    }

    /**
     * @param string $environment
     * @param string $firstResult
     * @param int $resultCount
     * @dataProvider provideEnvironmentsWithData
     * @throws Exception
     */
    public function testMustProvideCorrectData(string $environment, string $firstResult, int $resultCount): void
    {
        $return = $this->stringParser->getDataForAnalyze('sample.txt', $environment);
        self::assertSame($firstResult, $return[0]);
        self::assertCount($resultCount, $return);
    }

    /**
     * @return array
     */
    public function provideCorrectEnvironments(): array
    {
        return [
            ['Text'],
            ['text'],
            ['Line'],
            ['line'],
        ];
    }

    /**
     * @return array
     */
    public function provideWrongEnvironments(): array
    {
        return [
            ['something_not_supported'],
            ['null'],
            ['false'],
        ];
    }

    /**
     * @return array
     */
    public function provideEnvironmentsWithData(): array
    {
        return [
            [
                'Text',
                'Ąžuolas – bukinių šeimos medžių gentis.',
                13
            ],
            [
                'Line',
                'Ąžuolas – bukinių šeimos medžių gentis.',
                5
            ],
        ];
    }
}
