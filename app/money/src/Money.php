<?php

namespace Money;

abstract class Money
{
    protected int $amount;

    abstract function times(int $multiplier);

    public static function dollar(int $amount)
    {
        return new Dollar($amount);
    }

    public static function franc(int $amount)
    {
        return new Franc($amount);
    }

    public function equals(self $money)
    {
        return $this->amount === $money->amount && $this::class == $money::class;
    }
}