<?php

namespace BAM\Domain\CoreDomain\Transaction;

use BAM\Domain\CoreDomain\Account\Account;
use BAM\Util\DateRange;

interface TransactionRepository
{
    /**
     * Find transactions by account
     * @param  Account                 $account the account
     * @return Collection<Transaction>          matching transactions
     */
    public function findByAccount(Account $account);

    /**
     * Find transactions by account in a given date range
     * @param  Account                 $account     the account
     * @param  DateRange               $date_range  the date range
     * @return Collection<Transaction>              matching transactions
     */
    public function findByAccountAndDateRange(Account $account, DateRange $date_range);
}
