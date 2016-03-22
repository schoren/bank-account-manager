<?php

namespace BAM\Domain\CoreDomain\Report;

use BAM\Domain\CoreDomain\User\User;
use BAM\Util\DateRange;
use Doctrine\Common\Collections\Collection;

final class UserReport
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var DateRange
     */
    private $date_range;

    /**
     * @var Collection
     */
    private $items;

    public function __construct(User $user, DateRange $date_range, Collection $items)
    {
        $this->user = $user;
        $this->date_range = $date_range;
        $this->items = $items;
    }

    /**
     * Get the report User
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the report date range
     *
     * @return DateRange
     */
    public function getDateRange()
    {
        return $this->date_range;
    }

    /**
     * Get the report items
     *
     * @return Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
