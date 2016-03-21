<?php

namespace BAM\Domain\User;

use BAM\Util\EmailAddress;
use BAM\Util\Exception\EntityNotFoundException;

interface UserRepository
{
    /**
     * Find one user using the email as search value
     * @param  EmailAddress  $email the email
     * @return User          The found user
     * @throws EntityNotFoundException if the user cannot be found
     */
    public function findOneByEmail(EmailAddress $email);

    /**
     * Find one user using the email as search value
     * @param  int  $id the id
     * @return User     The found user
     * @throws EntityNotFoundException if the user cannot be found
     */
    public function findOneById($id);
}
