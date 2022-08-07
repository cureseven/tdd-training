<?php

declare(strict_types=1);

namespace Money\Tests;

use Money\Bank;
use Money\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testMultiplication()
    {
        $five = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $five->times(2));
        $this->assertEquals(Money::dollar(15), $five->times(3));
    }

    public function testEquality()
    {
        $five = Money::dollar(5);
        $this->assertTrue($five->equals(Money::dollar(5)));
        $this->assertFalse($five->equals(Money::dollar(6)));
        $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
    }

    public function testCurrency()
    {
        $this->assertEquals("USD", (Money::dollar(1))->currency());
        $this->assertEquals("CHF", (Money::franc(1))->currency());
    }

    public function testSimpleAddition()
    {
        $five = Money::dollar(5);
        $sum = $five->plus($five); // Expression型
        $bank = new Bank();
        $reduced = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::dollar(10), $reduced);
    }

    public function testPlusReturnsSum()
    {
        $five = Money::dollar(5);
        $result = $five->plus($five); // Expression型
        $sum = $result;
        $this->assertEquals($five, $sum->augend);
        $this->assertEquals($five, $sum->addend);
    }
}
