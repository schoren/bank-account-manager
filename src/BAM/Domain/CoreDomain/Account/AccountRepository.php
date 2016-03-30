<?php

namespace BAM\Domain\CoreDomain\Account;

use BAM\Domain\CoreDomain\User\User;
use BAM\Util\Exception\EntityNotFoundException;
use Doctrine\Collections\Collection;

interface AccountRepository
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
