<?php

namespace Money;

class Money
{
    protected $amount;

    public function equals(self $money)
    {
        return $this->amount === $money->amount && $this::class == $money::class;
    }
}