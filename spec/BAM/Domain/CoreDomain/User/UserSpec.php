<?php

namespace spec\BAM\Domain\CoreDomain\User;

use BAM\Domain\CoreDomain\Account\Account;
use BAM\Util\Currency;
use BAM\Util\EmailAddress;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('signup', ['Test Name', new EmailAddress('test@test.com'), 'password123']);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Domain\CoreDomain\User\User');
    }

    public function it_should_allow_add_accounts()
    {
        $account = Account::create('Test', Currency::USD());
        $this->addAccount($account);
        $this->getAccounts()->shouldHaveCount(1);

        $this->addAccount($account);
        $this->getAccounts()->shouldHaveCount(2);
    }

    public function it_should_allow_remove_accounts()
    {
        $account = Account::create('Test', Currency::USD());
        $this->addAccount($account);
        $this->removeAccount($account);
        $this->getAccounts()->shouldHaveCount(0);
    }

    public function it_should_have_default_settings()
    {
        $this->getSettings()->getWeeklyEmail()->shouldBe(false);
        $this->getSettings()->getMonthlyEmail()->shouldBe(false);
    }
}
