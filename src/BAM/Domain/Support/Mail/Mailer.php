<?php

namespace Support\Mail;

interface Mailer
{
    /**
     * Send an email
     * @param  Email  $email the email to send
     * @return bool          true if the mail was sent, false otherwise
     */
    public function sendEmail(Email $email);
}
