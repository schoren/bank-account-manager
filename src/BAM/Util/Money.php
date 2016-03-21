<?php

namespace BAM\Util;

final class Money
{
    /**
     * Amount
     *
     * @var float
     */
    private $amount;

    /**
     * Currency
     *
     * @var Currency
     */
    private $Currency;

    /**
     * Create a new Money object
     * @param float    $amount   the amount
     * @param Currency $currency the currency
     */
    public function __construct($amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Get the amount
     * @return float the amount
     */
    public function getValue()
    {
        return $this->amount;
    }

    /**
     * Get the currency
     * @return Currency the currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
