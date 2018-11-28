<?php

namespace App\Fibonacci;

use LiLinen\Decor\Decoration\Profile;

class ProfileFibonacci implements FibonacciInterface
{
    /**
     * @Profile
     *
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
