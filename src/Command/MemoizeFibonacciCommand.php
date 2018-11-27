<?php

namespace App\Command;

class MemoizeFibonacciCommand extends FibonacciCommand
{
    protected static $defaultName = 'fibonacci:memoize';
}
