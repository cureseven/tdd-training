<?php

namespace Money;

class Franc
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
        return new Franc($this->amount * $multiplier);
    }

    public function equals(Franc $dollar)
    {
        return $this->amount === $dollar->amount;
    }
}