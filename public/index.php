<?php

declare(strict_types=1);

define('ROOT_DIR', __DIR__);

require_once ROOT_DIR . '/../vendor/autoload.php';

use Analyzer\Command\AnalyzeCommand;
use Symfony\Component\Console\Application;

$command = new AnalyzeCommand();

$application = new Application();

$application->add($command);
$application->setDefaultCommand($command->getName(), true);


$application->run();
