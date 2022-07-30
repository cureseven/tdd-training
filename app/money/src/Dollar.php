<?php

namespace Money;

class Dollar
{
    public $amount;
    /**
     * @param int $int
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier)
    {
        $this->amount = $this->amount * $multiplier;
    }
}