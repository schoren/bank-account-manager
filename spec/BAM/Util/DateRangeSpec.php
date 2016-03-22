<?php

namespace spec\BAM\Util;

use PhpSpec\ObjectBehavior;

class DateRangeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('BAM\Util\DateRange');
    }

    public function it_has_week_range_constructor()
    {
        $this->beConstructedThrough('createWeekRange', ['2016', '1']);
        $this->getStart()->format('Y-m-d')->shouldBe('2016-01-04');
        $this->getEnd()->format('Y-m-d')->shouldBe('2016-01-11');
    }

    public function it_has_month_range_constructor()
    {
        $this->beConstructedThrough('createMonthRange', ['2016', '01']);
        $this->getStart()->format('Y-m-d')->shouldBe('2016-01-01');
        $this->getEnd()->format('Y-m-d')->shouldBe('2016-02-01');
    }
}
