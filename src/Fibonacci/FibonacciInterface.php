<?php

namespace App\Fibonacci;

interface FibonacciInterface
{
    public function calculate(int $x): int;
}
