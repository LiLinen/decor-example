<?php

namespace App\Command;

use App\Fibonacci\FibonacciInterface;
use App\Fibonacci\MemoizedStaticFibonacci;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StaticFibonacciCommand extends Command
{
    protected static $defaultName = 'fibonacci:static';

    /**
     * @var MemoizedStaticFibonacci
     */
    private $fibonacci;

    /**
     * @param \App\Fibonacci\MemoizedStaticFibonacci $fibonacci
     */
    public function __construct(MemoizedStaticFibonacci $fibonacci)
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
            ->setDescription('Calculate a static Fibonacci number')
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
        $iterations = $input->getOption('iterations');

        $io->comment("Calculating {$this->fibonacci->getNumber()}-th fibonacci number... for $iterations iterations.");

        $totalStart = \microtime(true);
        for ($i = 0; $i < $iterations; $i++) {
            $start = \microtime(true);
            $result = $this->fibonacci->calculate();
            $end = \microtime(true);
            $total = $end - $start;

            if ($i === 1) {
                $io->success("Result: $result");
            }

            $io->comment("Iteration '$i' time: $total s");
        }
        $totalEnd = \microtime(true);

        $totalTime = $totalEnd - $totalStart;
        $io->comment("Total time: $totalTime s");
    }
}
