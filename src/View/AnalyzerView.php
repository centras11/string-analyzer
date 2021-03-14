<?php

declare(strict_types=1);

namespace Analyzer\View;

use Analyzer\View\Group\GroupInterface;
use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class AnalyzerView
 * @package Analyzer\View
 */
class AnalyzerView
{
    private SymfonyStyle $symfonyStyle;

    /**
     * AnalyzerView constructor.
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->symfonyStyle = new SymfonyStyle($input, $output);
    }

    /**
     * @param array $data
     * @param array $groups
     *
     * @throws Exception
     */
    public function view(array $data, array $groups): void
    {
        $this->symfonyStyle->title('String Analyzer');

        foreach ($groups as $group) {
            $outputGroup = $this->getGroupRule(ucfirst($group));
            $this->symfonyStyle->title($outputGroup->getTitle());
            $this->symfonyStyle->table(['count', 'value'], $outputGroup->getData($data));
        }
    }

    /**
     * @param string $groupName
     *
     * @return GroupInterface
     * @throws Exception
     */
    private function getGroupRule(string $groupName): GroupInterface
    {
        $groupWithNameSpace = 'Analyzer\\View\\Group\\' . $groupName;

        if (!class_exists($groupWithNameSpace)) {
            // @todo throw custom exception
            throw new Exception('Not supported group: ' . $groupName);
        }

        return new $groupWithNameSpace();
    }
}
