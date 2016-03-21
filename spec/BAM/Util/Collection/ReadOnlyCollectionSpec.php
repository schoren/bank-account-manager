<?php

namespace spec\BAM\Util\Collection;

use PhpSpec\ObjectBehavior;

class ReadOnlyCollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Util\Collection\ReadOnlyCollection');
    }

    public function it_cannot_add_elements()
    {
        $this->shouldThrow('\RuntimeException')->during('add', ['test']);
        $this->shouldThrow('\RuntimeException')->during('offsetSet', [1, 'test']);
        $this->shouldThrow('\RuntimeException')->during('set', [1, 'test']);
        $this->shouldHaveCount(0);
        $this->shouldHaveCount(0);
    }

    public function it_cannot_remove_elements()
    {
        $this->beConstructedWith(['test']);

        $this->shouldThrow('\RuntimeException')->during('removeElement', ['test']);
        $this->shouldThrow('\RuntimeException')->during('remove', [0]);
        $this->shouldThrow('\RuntimeException')->during('offsetUnset', [0]);
        $this->shouldThrow('\RuntimeException')->during('clear');
        $this->shouldHaveCount(1);
        $this->shouldHaveCount(1);
    }
}
