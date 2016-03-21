<?php

namespace BAM\Util;

use \InvalidArgumentException;

final class EmailAddress
{
    /**
     * Email
     *
     * @var string
     */
    private $email;

    /**
     * Create a new EmailAddress object
     * @param string $email an email address
     * @throws InvalidArgumentException if the given address is invalid
     */
    public function __construct($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Malformed email address');
        }

        $this->email = $email;
    }

    /**
     * Get the email address
     * @return string the email address
     */
    public function getValue()
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->email;
    }
}
