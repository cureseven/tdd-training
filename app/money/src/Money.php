<?php

namespace Money;

abstract class Money
{
    protected int $amount;
    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    abstract function times(int $multiplier);

    public static function dollar(int $amount)
    {
        return new Dollar($amount, "USD");
    }

    public static function franc(int $amount)
    {
        return new Franc($amount, "CHF");
    }

    public function equals(self $money)
    {
        return $this->amount === $money->amount && $this::class == $money::class;
    }

    public function currency(): string{
        return $this->currency;
    }
}