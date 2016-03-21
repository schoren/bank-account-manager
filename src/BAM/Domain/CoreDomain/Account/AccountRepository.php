<?php

namespace BAM\Domain\Account;

use BAM\Domain\User\User;
use BAM\Util\Exception\EntityNotFoundException;
use Doctrine\Collections\Collection;

interface UserRepository
{
    /**
     * Find all accounts for a User
     * @param  User                $user the user
     * @return Collection<Account> matching accounts
     */
    public function findByUser(User $user);
    /**
     * Find one account by ID
     * @param  int                     $id the id
     * @return Account                 the account
     * @throws EntityNotFoundException if the account cannot be found
     */
    public function findOneById($id);
}
