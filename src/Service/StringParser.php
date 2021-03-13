<?php

declare(strict_types=1);

namespace Analyzer\Service;

use Analyzer\Service\EnvironmentRule\EnvironmentRuleInterface;
use Exception;

/**
 * Class StringParser
 * @package Analyzer\Service
 */
class StringParser
{
    private const UPLOAD_FOLDER = '/upload/';
    private EnvironmentRuleInterface $environmentRule;

    /**
     * @param string $fileName
     *
     * @return array
     */
    public function getDataForAnalyze(string $fileName): array
    {
        $text = $this->readFile($fileName);

        return $this->environmentRule->getEnvironment($text);
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
     *
     * @return string
     */
    private function readFile(string $fileName): string
    {
        return file_get_contents($this->getFullPath($fileName));
    }

    /**
     * @param string $environment
     *
     * @return $this
     * @throws Exception
     */
    public function setEnvironmentRule(string $environment): self
    {
        $environmentWithNameSpace = 'Analyzer\\Service\\EnvironmentRule\\' . $environment;

        if (!class_exists($environmentWithNameSpace)) {
            // @todo throw custom exception
            throw new Exception('Not supported environment: ' . $environment);
        }

        $this->environmentRule = new $environmentWithNameSpace();

        return $this;
    }

    /**
     * @return EnvironmentRuleInterface
     */
    public function getEnvironmentRule(): EnvironmentRuleInterface
    {
        return $this->environmentRule;
    }
}
