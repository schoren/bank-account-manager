<?php

namespace BAM\Domain\CoreDomain\User;

use BAM\Domain\CoreDomain\Account\Account;
use BAM\Util\EmailAddress;
use Doctrine\Common\Collections\ArrayCollection;
use \InvalidArgumentException;

final class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var strng
     */
    private $name;

    /**
     * @var EmailAddress
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var Collection<Account>
     */
    private $accounts;

    /**
     * Create a new user object
     * @param string        $name     the name
     * @param EmailAddress  $email    the email
     * @param string        $password the password
     */
    private function __construct($name, EmailAddress $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->settings = new Settings();
        $this->accounts = new ArrayCollection();
    }

    /**
     * Sign up a new user
     * @param  string       $name     the name
     * @param  EmailAddress $email    the email
     * @param  string       $password the password
     * @return User         the new user
     */
    public static function signup($name, EmailAddress $email, $password)
    {
        return new self($name, $email, $password);
    }

    /**
     * Add a new account for the user
     * @param Account $account the new account
     */
    public function addAccount(Account $account)
    {
        $this->accounts->add($account);
    }

    /**
     * Remove an account from the user
     * @param Account $account the account to remove
     * @throws InvalidArgumentException if the account does not exists
     */
    public function removeAccount(Account $account)
    {
        $exists = $this->accounts->removeElement($account);
        if (!$exists) {
            throw new InvalidArgumentException(sprintf('The account "%s" is invalid', $account->getName()));
        }
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
     * @return strng
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the email
     *
     * @return EmailAddress
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the settings
     *
     * @return Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Get the accounts
     *
     * @return Collection<Account>
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}
