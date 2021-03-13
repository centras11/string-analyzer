<?php

declare(strict_types=1);

namespace Analyzer\Tests\Service;

use Analyzer\Service\EnvironmentRule\EnvironmentRuleInterface;
use Analyzer\Service\StringParser;
use Analyzer\Tests\InvokeMethodTrait;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class StringParserTest
 * @package Analyzer\Tests\Service
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

    /**
     * @throws \ReflectionException
     */
    public function testMustReturnFullPath(): void
    {
        $fileName = 'test.txt';
        $fullPath = ROOT_DIR . '/upload/' . $fileName;

        $return = $this->invokeMethod($this->stringParser, 'getFullPath', [$fileName]);
        self::assertSame($fullPath, $return);
    }

    /**
     * @throws \ReflectionException
     */
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
     * @throws Exception
     */
    public function testMustGetCorrectEnvironmentRule(string $environment): void
    {
        $return = $this->stringParser->setEnvironmentRule($environment);
        self::assertInstanceOf(EnvironmentRuleInterface::class, $return->getEnvironmentRule());
    }

    /**
     * @param string $environment
     * @dataProvider provideWrongEnvironments
     */
    public function testMustThrowExceptionIfNotSupportedEnvironment(string $environment): void
    {
        $this->expectException(Exception::class);
        $this->stringParser->setEnvironmentRule($environment);
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
        $this->stringParser->setEnvironmentRule($environment);
        $return = $this->stringParser->getDataForAnalyze('sample.txt');
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
            ['Line'],
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
