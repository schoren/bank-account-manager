<?php

namespace spec\BAM\Domain\CoreDomain\Report;

use BAM\Domain\CoreDomain\Account\Account;
use BAM\Domain\CoreDomain\Transaction\Transaction;
use BAM\Domain\CoreDomain\Transaction\TransactionRepository;
use BAM\Domain\CoreDomain\User\User;
use BAM\Util\Currency;
use BAM\Util\DateRange;
use BAM\Util\EmailAddress;
use BAM\Util\Money;
use PhpSpec\ObjectBehavior;
use \DateTime;

class ReporterSpec extends ObjectBehavior
{
    public function let(TransactionRepository $repo)
    {
        $this->beConstructedWith($repo);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Domain\CoreDomain\Report\Reporter');
    }

    public function it_should_return_a_valid_weekly_report(TransactionRepository $repo)
    {

        $account = Account::create('Test Account', Currency::USD());

        $t = Transaction::create(new Money(120, Currency::USD()));
        $account->addTransaction($t);

        $t = Transaction::create(new Money(120, Currency::USD()));
        $account->addTransaction($t);

        $user = User::signup('Test Name', new EmailAddress('test@test.com'), 'password123');
        $user->addAccount($account);

        $date = new DateTime();
        $repo
            ->findByAccountAndDateRange(
                $account,
                DateRange::createWeekRange($date->format('Y'), $date->format('W'))
            )
            ->willReturn($account->getTransactions())
        ;
        $this->beConstructedWith($repo);

        $report = $this->getWeeklyReportForUser($user, $date);

        $report->shouldBeAnInstanceOf('BAM\Domain\CoreDomain\Report\UserReport');
        $report->getUser()->shouldBeLike($user);

        $report->getItems()->get(0)->shouldBeAnInstanceOf('BAM\Domain\CoreDomain\Report\ReportItem');
        $report->getItems()->get(0)->getAccount()->shouldBeLike($account);
        $report->getItems()->get(0)->getBalance()->getValue()->shouldBe(240);
    }

    public function it_should_return_a_valid_monthly_report(TransactionRepository $repo)
    {

        $account = Account::create('Test Account', Currency::USD());

        $t = Transaction::create(new Money(120, Currency::USD()));
        $account->addTransaction($t);

        $t = Transaction::create(new Money(120, Currency::USD()));
        $account->addTransaction($t);

        $user = User::signup('Test Name', new EmailAddress('test@test.com'), 'password123');
        $user->addAccount($account);

        $date = new DateTime();
        $repo
            ->findByAccountAndDateRange(
                $account,
                DateRange::createMonthRange($date->format('Y'), $date->format('m'))
            )
            ->willReturn($account->getTransactions())
        ;
        $this->beConstructedWith($repo);

        $report = $this->getMonthlyReportForUser($user, $date);

        $report->shouldBeAnInstanceOf('BAM\Domain\CoreDomain\Report\UserReport');
        $report->getUser()->shouldBeLike($user);

        $report->getItems()->get(0)->shouldBeAnInstanceOf('BAM\Domain\CoreDomain\Report\ReportItem');
        $report->getItems()->get(0)->getAccount()->shouldBeLike($account);
        $report->getItems()->get(0)->getBalance()->getValue()->shouldBe(240);
    }
}
