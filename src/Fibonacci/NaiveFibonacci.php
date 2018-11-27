<?php

namespace App\Fibonacci;

class NaiveFibonacci implements FibonacciInterface
{
    /**
     * @param int $x
     *
     * @return int
     */
    public function calculate(int $x): int
    {
        if ($x === 0) {
            return 0;
        }

        if ($x === 1) {
            return 1;
        }

        return $this->calculate($x - 1) + $this->calculate($x - 2);
    }
}
