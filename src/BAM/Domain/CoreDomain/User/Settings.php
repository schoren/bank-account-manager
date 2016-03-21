<?php

namespace BAM\Domain\CoreDomain\User;

final class Settings
{
    /**
     * @var boolean
     */
    private $weekly_email = false;

    /**
     * @var boolean
     */
    private $monthly_email = false;

    /**
     * Get Weekly Email
     *
     * @return boolean
     */
    public function getWeeklyEmail()
    {
        return $this->weekly_email;
    }

    /**
     * Set Weekly Email
     *
     * @param boolean $weekly_email the weekly email
     *
     * @return self
     */
    public function setWeeklyEmail($weekly_email)
    {
        $this->weekly_email = $weekly_email;

        return $this;
    }

    /**
     * Get Monthly Email
     *
     * @return boolean
     */
    public function getMonthlyEmail()
    {
        return $this->monthly_email;
    }

    /**
     * Set Monthly Email
     *
     * @param boolean $monthly_email the monthly email
     *
     * @return self
     */
    public function setMonthlyEmail($monthly_email)
    {
        $this->monthly_email = $monthly_email;

        return $this;
    }
}
