<?php

namespace Money;

class Money
{
    protected int $amount;
    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function times(int $multiplier)
    {
        return null;
    }

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
        return $this->amount === $money->amount && $this->currency == $money->currency;
    }

    public function currency(): string{
        return $this->currency;
    }

    public function toString()
    {
        return $this->amount . " " . $this->currency;
    }
}