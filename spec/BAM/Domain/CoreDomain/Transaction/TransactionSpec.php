<?php

namespace spec\BAM\Domain\CoreDomain\Transaction;

use BAM\Util\Currency;
use BAM\Util\Money;
use PhpSpec\ObjectBehavior;

class TransactionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('create', [new Money(120, Currency::USD())]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Domain\CoreDomain\Transaction\Transaction');
    }

    public function it_should_be_configured()
    {
        $this->getAmount()->getValue()->shouldBe(120);
        $this->getAmount()->getCurrency()->getValue()->shouldBe('USD');
    }

    public function it_can_be_created_in_the_past()
    {
        $this->beConstructedThrough('createPastTransaction', [new Money(120, Currency::USD()), new \DateTime('2015-01-01')]);
        $this->getAmount()->getValue()->shouldBe(120);
        $this->getAmount()->getCurrency()->getValue()->shouldBe('USD');
        $this->getCreatedAt()->format('Y-m-d')->shouldBe('2015-01-01');
    }

    public function it_cannot_be_created_in_the_future()
    {
        $this->beConstructedThrough('createPastTransaction', [new Money(120, Currency::USD()), new \DateTime('2100-01-01')]);
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }
}
