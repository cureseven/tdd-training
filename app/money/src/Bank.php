<?php

namespace Money;

class Bank
{
    private $rates = [];
    public function reduce(Expression $source, string $to): Expression
    {
        return $source->reduce($this, $to);
    }

    public function addRate(string $from, string $to, int $rate){
        $this->rates[(new Pair($from, $to))->hashCode()] = $rate;
    }

    public function rate(string $from, string $to): int
    {
        if ($from === $to){
            return 1;
        }
        return $this->rates[(new Pair($from, $to))->hashCode()];
    }
}