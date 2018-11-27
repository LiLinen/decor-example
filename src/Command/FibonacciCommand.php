<?php

namespace App\Command;

use App\Fibonacci\FibonacciInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class FibonacciCommand extends Command
{
    /**
     * @var FibonacciInterface
     */
    private $fibonacci;

    /**
     * @param FibonacciInterface $fibonacci
     */
    public function __construct(FibonacciInterface $fibonacci)
    {
        parent::__construct(null);

        $this->fibonacci = $fibonacci;
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Calculate Fibonacci number')
            ->addArgument('number', InputArgument::REQUIRED, 'Fibonacci number')
            ->addOption('iterations' , 'i',  InputArgument::OPTIONAL, 'Iterations', 1)
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $number = $input->getArgument('number');
        $iterations = $input->getOption('iterations');

        $io->comment("Calculating {$number}-th fibonacci number... for {$iterations} iterations.");

        $totalStart = \microtime(true);

        for ($i = 1; $i <= $iterations; $i++) {
            $this->runIteration($i, $number, $io);
        }

        $totalEnd = \microtime(true);

        $totalTime = $totalEnd - $totalStart;
        $io->comment("Total time: {$totalTime} s");
    }

    /**
     * @param int $i
     * @param int $number
     * @param SymfonyStyle $io
     */
    private function runIteration(int $i, int $number, SymfonyStyle $io): void
    {
        $iterationStart = \microtime(true);

        $result = $this->fibonacci->calculate($number);

        $iterationEnd = \microtime(true);

        if ($i === 1) {
            $io->success("Result: {$result}");
        }

        $iterationTotal = $iterationEnd - $iterationStart;
        $io->comment("Iteration '{$i}' time: {$iterationTotal} s");
    }
}
