<?php

namespace BAM\Util;

use \DateTime;

class DateRange
{
    /**
     * @var DateTime
     */
    private $start;

    /**
     * @var DateTime
     */
    private $end;

    private function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Create a Month DateRange
     * @param  int $year  year
     * @param  int $month month
     * @return DateRange  month date range
     */
    public static function createMonthRange($year, $month)
    {
        $start = new \DateTime();
        $start
            ->setDate($year, $month, 1)
            ->setTime(0, 0, 0)
        ;

        $end = clone $start;
        $end->modify('+1 month');

        return new static($start, $end);
    }

    /**
     * Create a Month DateRange
     * @param  int $year       year
     * @param  int $weekNumber week number of the year
     * @return DateRange       week date range
     */
    public static function createWeekRange($year, $weekNumber)
    {
        $start = \DateTime::createFromFormat('U', strtotime($year . 'W' . str_pad($weekNumber, 2, '0', STR_PAD_LEFT)));
        $start->setTime(0, 0, 0);

        $end = clone $start;
        $end->modify('+7 days');

        return new static($start, $end);
    }

    /**
     * Get start
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get end
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}
