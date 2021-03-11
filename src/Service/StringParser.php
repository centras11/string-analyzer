<?php

declare(strict_types=1);

namespace Analyzer\Service;

use Analyzer\Service\EnvironmentRule\RuleInterface;
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

        if (!class_exists($environmentWithNameSpace)) {
            // @todo throw custom exception
            throw new Exception('Not supported environment: ' . $environment);
        }

        $r = new $environmentWithNameSpace();

        return new $environmentWithNameSpace();
    }
}
