<?php

declare(strict_types=1);

namespace Analyzer\Service;

use Analyzer\Service\EnvironmentRule\RuleInterface;
use Analyzer\Service\EnvironmentRule\Text;
use Exception;

/**
 * Class StringParser
 * @package Analyzer\Service
 */
class StringParser
{
    private const UPLOAD_FOLDER = '/upload/';

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getFullPath(string $fileName): string
    {
        return ROOT_DIR . self::UPLOAD_FOLDER . $fileName;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function readFile(string $fileName): string
    {
        return file_get_contents($this->getFullPath($fileName));
    }

    /**
     * @param string $environment
     *
     * @return RuleInterface
     * @throws Exception
     */
    private function getEnvironmentRule(string $environment): RuleInterface
    {
        $environmentWithNameSpace = 'Analyzer\\Service\\EnvironmentRule\\' . $environment;

        if (!class_exists($environmentWithNameSpace )) {
            throw new Exception('Not supported environment: ' . $environment);
        }

        return new $environmentWithNameSpace;

//        $r1 = class_exists('Analyzer\\Service\\EnvironmentRule\\' . $environment, false);
//        $r2 = class_exists('\\Analyzer\\Service\\EnvironmentRule\\' . $environment, false);
//        $r3 = class_exists('\Analyzer\Service\EnvironmentRule\\' . $environment, false);
//        $r4 = class_exists("\Analyzer\Service\EnvironmentRule\{$environment}", false);
//        $r5 = class_exists("Analyzer\Service\EnvironmentRule\{$environment}", false);
//
//        return new Text();
    }

    /**
     * @param string $fileName
     * @param string $environment
     *
     * @return array
     * @throws Exception
     */
    public function getDataForAnalyze(string $fileName, string $environment): array
    {
        $text = $this->readFile($fileName);
        $environmentRule = $this->getEnvironmentRule($environment);

        return $environmentRule->getEnvironment($text);
    }
}
