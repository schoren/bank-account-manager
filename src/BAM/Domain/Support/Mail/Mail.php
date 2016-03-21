<?php

namespace Support\Mail;

use Util\EmailAddress;

class Email
{
    /**
     * @var EmailAddress
     */
    private $rcpt;

    /**
     * @var array<EmailAddress>
     */
    private $cc;

    /**
     * @var array<EmailAddress>
     */
    private $bcc;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * array of paths of files to attach. The key is the attached file name, the value is the path.
     *
     * @var array<string>
     */
    private $attachments;

    /**
     * Create a new Email
     * @param EmailAddress $rcpt    the main recipient
     * @param string       $subject the subject
     * @param string       $body    the body
     */
    public function __construct(EmailAddress $rcpt, $subject, $body)
    {
        $this->rcpt = $rcpt;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Add a file attachment
     * @param  string $name the attached name
     * @param  string $path the file path
     * @return Mail         self
     */
    public function attachFile($name, $path)
    {
        $this->attachments[$name] = $path;
        return $this;
    }

    /**
     * Add a BCC address
     * @param EmailAddress $address the email address
     * @return Mail                  self
     */
    public function addBcc(EmailAddress $address)
    {
        $this->bcc[] = $address;
        return $this;
    }

    /**
     * Add a CC address
     * @param EmailAddress $address the email address
     * @return Mail                  self
     */
    public function addCc(EmailAddress $address)
    {
        $this->bcc[] = $address;
        return $this;
    }

    /**
     * Get the rcpt
     *
     * @return EmailAddress
     */
    public function getRcpt()
    {
        return $this->rcpt;
    }

    /**
     * Get the cc
     *
     * @return array<EmailAddress>
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Get the bcc
     *
     * @return array<EmailAddress>
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Get the subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Gets the attachments
     *
     * @return array<string>
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}
