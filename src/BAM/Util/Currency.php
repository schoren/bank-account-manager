<?php

namespace BAM\Util;

use \InvalidArgumentException;

final class Currency
{
    /**
     * Currency
     *
     * @var string
     */
    private $currency;

    private $valid_currencies = array(
        'USD',
        'EUR',
    );

    /**
     * Create a new Currency object
     * @param string $currency the currency
     * @throws InvalidArgumentException if the given currency is not supported
     */
    public function __construct($currency)
    {
        if (!in_array($currency, $this->valid_currencies)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid currency %s. Valid currencies are %s',
                    $currency,
                    implode(', ', $this->valid_currencies)
                )
            );
        }

        $this->currency = $currency;
    }

    /**
     * Create a new USD Currency
     * @return Currency the created Currency
     */
    public static function USD()
    {
        return new self('USD');
    }

    /**
     * Create a new EUR Currency
     * @return Currency the created Currency
     */
    public static function EUR()
    {
        return new self('EUR');
    }

    /**
     * Get the currency
     * @return string the currency
     */
    public function getValue()
    {
        return $this->currency;
    }

    public function __toString()
    {
        return $this->currency;
    }
}
