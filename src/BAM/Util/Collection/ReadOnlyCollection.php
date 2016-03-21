<?php

namespace BAM\Util\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class ReadOnlyCollection extends ArrayCollection
{
    /**
     * {@inheritDoc}
     */
    public function remove($key)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function removeElement($element)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function set($key, $value)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function add($value)
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        throw new \RuntimeException('Read Only collection cannot be modified');
    }
}
