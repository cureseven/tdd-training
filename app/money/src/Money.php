<?php

namespace Money;

class Money implements Expression
{
    protected int $amount;
    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public static function dollar(int $amount)
    {
        return new Money($amount, "USD");
    }

    public static function franc(int $amount)
    {
        return new Money($amount, "CHF");
    }

    public function times(int $multiplier): Expression
    {
        return new Money($this->amount * $multiplier, $this->currency);
    }

    public function equals(self $money)
    {
        return $this->amount === $money->amount && $this->currency() === $money->currency();
    }

    public function toString()
    {
        return $this->amount . " " . $this->currency;
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $to): Expression
    {
        $rate = $bank->rate($this->currency, $to);
        return new Money($this->amount / $rate, $to);
    }
}