<?php

namespace App\Fibonacci;

use LiLinen\Decor\Decoration\Memoize;

class MemoizedStaticFibonacci
{
    /**
     * @var \App\Fibonacci\FibonacciInterface
     */
    private $fibonacci;

    /**
     * @var int
     */
    private $number;

    /**
     * @param FibonacciInterface $fibonacci
     * @param int $number
     */
    public function __construct(FibonacciInterface $fibonacci, int $number)
    {
        $this->fibonacci = $fibonacci;
        $this->number = $number;
    }

    /**
     * @Memoize
     *
     * @return int
     */
    public function calculate(): int
    {
        return $this->fibonacci->calculate($this->number);
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }
}
