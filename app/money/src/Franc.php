<?php

namespace Money;

class Franc extends Money
{
    /**
     * @param int $int
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier)
    {
        return new Franc($this->amount * $multiplier);
    }
}