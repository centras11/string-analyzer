<?php

declare(strict_types=1);

namespace Analyzer\Command;

use Analyzer\Service\Analyzer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addArgument('count', InputArgument::OPTIONAL, 'What to count - words or symbols.', 'word')
            ->addArgument('group', InputArgument::IS_ARRAY, 'How to group results.')
        ;
    }

    private Analyzer $analyzer;

    /**
     * AnalyzeCommand constructor.
     */
    public function __construct()
    {
        $this->analyzer = new Analyzer();

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('filename');
        $environment = ucfirst($input->getArgument('environment'));
        $count = $input->getArgument('count');
        $group = $input->getArgument('group');

        $r = $this->analyzer->analyze($fileName, $environment);

        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}
