<?php

declare(strict_types=1);

namespace CommissionTask\Tests\Controller;

use CommissionTask\Controller\CalculatorController;
use CommissionTask\Service\Calculator;
use CommissionTask\Service\Converter;
use CommissionTask\Service\CsvParser;
use CommissionTask\View\Calculator as CalculatorView;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorControllerTest
 * @package CommissionTask\Tests\Controller
 */
class CalculatorControllerTest extends TestCase
{
    private CalculatorController $calculatorController;

    public function setUp()
    {
        define('ROOT_DIR', __DIR__ . '/../../public');

        $converter = new Converter();
        $calculator = new Calculator($converter);
        $csvParser = new CsvParser();
        $calculatorView = new CalculatorView();

        $this->calculatorController = new CalculatorController($calculator, $csvParser, $calculatorView);
    }

    public function testCalculate()
    {
        $this->calculatorController->calculateCommission('sample.csv');
        $this->expectOutputString($this->getCountedOutput());
    }

    public function getCountedOutput(): string
    {
        return '0.60
3.00
0.00
0.06
1.50
0.00
0.70
0.30
0.30
3.00
0.00
0.00
8,611.41
';
    }
}
