<?php

namespace BAM\Domain\CoreDomain\Report;

use BAM\Domain\CoreDomain\Transaction\TransactionRepository;
use BAM\Domain\CoreDomain\User\User;
use BAM\Util\DateRange;
use Doctrine\Collections\ArrayCollection;
use \DateTime;

final class Reporter
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * Create a new Reporter instance
     * @param TransactionRepository $transactionRepository the Transaction Repository implementation
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * get the Weekly user report
     * @param  User       $user      the user
     * @param  DateTime   $startDate the start date
     * @return UserReport            the report
     */
    public function getWeeklyReportForUser(User $user, DateTime $startDate)
    {
        list($year, $week) = explode('-', $startDate->fomat('Y-W'));
        $dateRange = DateRange::createWeekRange($year, $week);

        return $this->getReport($user, $dateRange);
    }

    /**
     * get the monthly user report
     * @param  User       $user      the user
     * @param  DateTime   $startDate the start date
     * @return UserReport            the report
     */
    public function getMonthlyReportForUser(User $user, DateTime $startDate)
    {
        list($year, $month) = explode('-', $startDate->fomat('Y-m'));
        $dateRange = DateRange::createMonthRange($year, $month);

        return $this->getReport($user, $dateRange);
    }

    /**
     * generate the report with given parameters
     * @param  User       $user      the user
     * @param  DateRange  $dateRange the daterange
     * @return UserReport            the report
     */
    private function getReport(User $user, DateRange $dateRange)
    {
        $items = new ArrayCollection();
        foreach ($user->getAccounts() as $account) {
            $transactions = $this->transactionRepository->findByAccountAndDateRange($account, $dateRange);
            $total = 0;
            foreach ($transactions as $transaction) {
                $total += $transaction->getAmount()->getAmount();
            }
            $items->add(new ReportItem($account, new Money($total, $account->getCurrency())));
        }
        return new UserReport($user, $dateRange, $items);
    }
}
