<?php

declare(strict_types=1);

namespace Money\Tests;

use Money\Bank;
use Money\Money;
use Money\Sum;
use PhpParser\Node\Expr\BitwiseNot;
use PhpParser\Node\Expr\Cast\Object_;
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

    public function testReduceSum()
    {
        $sum = (new Sum(Money::dollar(3), Money::dollar(4)));
        $bank = new Bank();
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::dollar(7), $result);
    }

    public function testReduceMoney()
    {
        $bank = new Bank();
        $result = $bank->reduce(Money::dollar(1), "USD");
        $this->assertEquals(Money::dollar(1), $result);
    }

    public function testReduceMoneyDifferentCurrenccy()
    {
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $result = $bank->reduce(Money::franc(2), "USD");
        $this->assertEquals(Money::dollar(1), $result);
    }

    public function testIdentityRate()
    {
        $this->assertEquals(1, (new Bank())->rate("USD", "USD"));
    }

    public function testMixAddition()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $result = $bank->reduce($fiveBucks->plus($tenFrancs), "USD");
        $this->assertEquals(Money::dollar(10), $result);
    }

    public function testSumPlusMoney()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->plus($fiveBucks);
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::dollar(15), $result);
    }

    public function testSumTimes()
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);
        $bank = new Bank();
        $bank->addRate("CHF", "USD", 2);
        $sum = (new Sum($fiveBucks, $tenFrancs))->times(2);
        $result = $bank->reduce($sum, "USD");
        $this->assertEquals(Money::dollar(20), $result);
    }

//    public function testPlusSameCurrencyReturnsMoney()
//    {
//        $sum = Money::dollar(1)->plus(Money::dollar(1));
//        $this->assertTrue($sum instanceof Money);
//    }
}
