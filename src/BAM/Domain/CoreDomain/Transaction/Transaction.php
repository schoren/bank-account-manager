<?php

namespace BAM\Domain\CoreDomain\Transaction;

use BAM\Util\Money;
use \DateTime;
use \InvalidArgumentException;

final class Transaction
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var Money
     */
    private $amount;

    /**
     * Create a new Transaction object
     * @param Money    $amount     the transaction amount
     * @param DateTime $created_at the transaction date
     */
    private function __construct(Money $amount, DateTime $created_at)
    {
        $this->amount = $amount;
        $this->created_at = $created_at;
    }

    /**
     * Create a new Transaction with default timestamp
     * @param  Money  $amount the amount
     * @return Transaction    the created Transaction
     */
    public static function create(Money $amount)
    {
        return new self($amount, new DateTime());
    }

    /**
     * Create a new transaction in the past
     * @param  Money    $amount         the amount
     * @param  DateTime $created_at     the transaction date in the past
     * @return Transaction              the created transaction
     * @throws InvalidArgumentException if the timestamp is not in the past
     */
    public static function createPastTransaction(Money $amount, DateTime $created_at)
    {
        if ($created_at >= new DateTime) {
            throw new InvalidArgumentException('Given timestamp must be in the past');
        }

        return new self($amount, $created_at);
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
     * Get the transaction date
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the amount
     *
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
