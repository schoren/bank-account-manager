<?php

namespace spec\BAM\Domain\CoreDomain\Account;

use BAM\Domain\CoreDomain\Transaction\Transaction;
use BAM\Util\Currency;
use BAM\Util\Money;
use PhpSpec\ObjectBehavior;

class AccountSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('create', ['Test Account', Currency::USD()]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Domain\CoreDomain\Account\Account');
    }

    public function it_should_be_configured()
    {
        $this->getBalance()->getValue()->shouldBe(0);
        $this->getBalance()->getCurrency()->getValue()->shouldBe('USD');
        $this->getName()->shouldBe('Test Account');
    }

    public function it_can_be_created_with_balance()
    {
        $this->beConstructedThrough('createWithBalance',
            ['Test Account', Currency::USD(), new Money(120, Currency::USD())]
        );
        $this->getBalance()->getValue()->shouldBe(120);
        $this->getBalance()->getCurrency()->getValue()->shouldBe('USD');
        $this->getName()->shouldBe('Test Account');
    }

    public function it_can_be_created_with_different_currency()
    {
        $this->beConstructedThrough('createWithBalance',
            ['Test Account', Currency::EUR(), new Money(120, Currency::EUR())]
        );
        $this->getBalance()->getValue()->shouldBe(120);
        $this->getBalance()->getCurrency()->getValue()->shouldBe('EUR');
        $this->getName()->shouldBe('Test Account');
    }

    public function it_can_add_transactions()
    {
        $transaction = Transaction::create(new Money(120, Currency::USD()));
        $this->addTransaction($transaction);

        $this->getTransactions()->shouldHaveCount(1);
        $this->getBalance()->getValue()->shouldBe(120);
    }

    public function it_cannot_add_transactions_in_different_currency()
    {
        $transaction = Transaction::create(new Money(120, Currency::EUR()));

        $this->shouldThrow('\InvalidArgumentException')->during('addTransaction', [$transaction]);

        $this->getTransactions()->shouldHaveCount(0);
        $this->getBalance()->getValue()->shouldBe(0);
    }

    public function it_cannot_add_transactions_from_outside()
    {
        $transaction = Transaction::create(new Money(120, Currency::EUR()));

        $this->getTransactions()->shouldThrow('\RuntimeException')->during('add', [$transaction]);
        $this->getTransactions()->shouldThrow('\RuntimeException')->during('offsetSet', [1, $transaction]);
        $this->getTransactions()->shouldThrow('\RuntimeException')->during('set', [1, $transaction]);
        $this->getTransactions()->shouldHaveCount(0);
        $this->getTransactions()->shouldHaveCount(0);
        $this->getBalance()->getValue()->shouldBe(0);
    }

    public function it_cannot_remove_transactions_from_outside()
    {
        $transaction = Transaction::create(new Money(120, Currency::USD()));
        $this->addTransaction($transaction);

        $this->getTransactions()->shouldThrow('\RuntimeException')->during('removeElement', [$transaction]);
        $this->getTransactions()->shouldThrow('\RuntimeException')->during('remove', [0]);
        $this->getTransactions()->shouldThrow('\RuntimeException')->during('offsetUnset', [0]);
        $this->getTransactions()->shouldThrow('\RuntimeException')->during('clear');
        $this->getTransactions()->shouldHaveCount(1);
        $this->getTransactions()->shouldHaveCount(1);
        $this->getBalance()->getValue()->shouldBe(120);
    }
}
