<?php

namespace BAM\Domain\Account;

use BAM\Domain\Transaction\Transaction;
use BAM\Util\Collection\ReadOnlyCollection;
use BAM\Util\Currency;
use BAM\Util\Money;
use Doctrine\Common\Collections\ArrayCollection;
use \InvalidArgumentException;

final class Account
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var Collection<Transaction>
     */
    private $transactions;

    /**
     * Create a new Account object
     * @param string $name    the name
     * @param Money  $balance the initial balance
     */
    private function __construct($name, Currency $currency, Money $balance)
    {
        if ($currency->getValue() != $balance->getCurrency()->getValue()) {
            throw new InvalidArgumentException('Balance currency does not match account currency');
        }

        $this->name = $name;
        $this->currency = $currency;
        $this->balance = $balance;
        $this->transactions = new ArrayCollection();
    }

    /**
     * Create a new Account object with 0 balance
     * @param  string   $name      the name
     * @param  Currency $currency  the currency
     * @return Account             the new Account
     */
    public static function create($name, Currency $currency)
    {
        $balance = new Money(0, $currency);
        return new self($name, $currency, $balance);
    }

    /**
     * Create a new account with specified initial balance
     * @param  string   $name      the name
     * @param  Currency $currency  the currency
     * @param  Money    $balance   the initial balance
     * @return Account             the new Account
     */
    public static function createWithBalance($name, Currency $currency, Money $balance)
    {
        return new self($name, $currency, $balance);
    }

    public function addTransaction(Transaction $transaction)
    {
        if ($transaction->getAmount()->getCurrency()->getValue() != $this->getCurrency()->getValue()) {
            throw new InvalidArgumentException('Transaction currency does not match account currency');
        }

        $this->transactions->add($transaction);
        $total = $this->balance->getValue() + $transaction->getAmount()->getValue();
        $this->balance = new Money($total, $this->currency);
    }

    /**
     * Get the id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the currency
     *
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
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

    /**
     * Get the transactions
     *
     * @return Collection<Transaction>
     */
    public function getTransactions()
    {
        return new ReadOnlyCollection($this->transactions->toArray());
    }
}
