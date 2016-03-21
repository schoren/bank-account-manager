<?php

namespace spec\BAM\Util;

use PhpSpec\ObjectBehavior;

class EmailAddressSpec extends ObjectBehavior
{
    public function it_fails_with_invalid_email()
    {
        $this->beConstructedWith('invalid email');
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }

    public function it_fails_with_invalid_email2()
    {
        $this->beConstructedWith('invalid@email!com');
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }

    public function it_accepts_valid_emails()
    {
        $this->beConstructedWith('valid@example.com');
        $this->getValue()->shouldEqual('valid@example.com');
    }
}
