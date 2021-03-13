<?php

declare(strict_types=1);

namespace Analyzer\Command;

use Analyzer\Service\Analyzer;
use Analyzer\Service\StringParser;
use Analyzer\View\AnalyzerView;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AnalyzeCommand
 * @package Analyzer\Command
 */
class AnalyzeCommand extends Command
{
    protected static $defaultName = 'analyzer:analyze';

    protected function configure(): void
    {
        $this
            ->setDescription('Analyzes string.')
            ->setHelp('Analyzes string by collecting some statistic')
            ->addArgument('filename', InputArgument::OPTIONAL, 'The name of file to analyze.', 'sample.txt')
            ->addArgument('environment', InputArgument::OPTIONAL, 'The environment to analyze - text or line.', 'text')
            ->addArgument('count', InputArgument::OPTIONAL, 'What to count - word or symbol.', 'word')
            ->addArgument('group', InputArgument::IS_ARRAY, 'How to group results. Supported: max, asc', ['max', 'asc'])
        ;
    }

    private Analyzer $analyzer;

    /**
     * AnalyzeCommand constructor.
     */
    public function __construct()
    {
        $this->analyzer = new Analyzer(new StringParser());

        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('filename');
        $environment = ucfirst($input->getArgument('environment'));
        $count = ucfirst($input->getArgument('count'));
        $group = $input->getArgument('group');

        $data = $this->analyzer->analyze($fileName, $environment, $count);
        $view = new AnalyzerView($input, $output);
        $view->view($data, $group);

        return Command::SUCCESS;
    }
}
