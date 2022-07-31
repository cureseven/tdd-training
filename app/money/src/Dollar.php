<?php

namespace Money;

class Dollar
{
    private $amount;
    /**
     * @param int $int
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function times(int $multiplier)
    {
        return new Dollar($this->amount * $multiplier);
    }

    public function equals(Dollar $dollar)
    {
        return $this->amount === $dollar->amount;
    }
}