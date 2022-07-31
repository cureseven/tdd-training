<?php

namespace Money;

class Money
{
    protected $amount;

    public function equals(self $object)
    {
        return $this->amount === $object->amount;
    }
}