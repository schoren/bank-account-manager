<?php

namespace BAM\Domain\Report;

use BAM\Domain\Account\Account;
use BAM\Util\Money;

final class ReportItem
{
    /**
     * @var Account
     */
    private $account;

    /**
     * @var Money
     */
    private $balance;

    public function __construct(Account $account, Money $balance)
    {
        $this->account = $account;
        $this->balance = $balance;
    }

    /**
     * Get the account
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Get the balance
     *
     * @return Money
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
