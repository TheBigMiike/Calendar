<?php
namespace Calendar;

use Calendar\Collections\Collection;
use Calendar\Periods\Day;
use Calendar\Periods\Month;
use Calendar\Periods\Year;
use Calendar\Traits\DateTrait;
use Moment\Moment;

class CalendarFactory{

    use DateTrait;

    /**
     * Calendar constructor.
     * @param $begin
     * @param $end
     * @return Calendar
     */
    public function createCalendar($begin, $end){
        return new Calendar($begin, $end);
    }


    /**
     * @param $begin
     * @param null $end
     * @param Calendar|null $calendar
     * @return Day
     */
    public function day($begin, $end = null, Calendar $calendar = null){
        return new Day($begin, $end, $calendar);
    }


    /**
     * @param $begin
     * @param null $end
     * @param Calendar|null $calendar
     * @return Month
     */
    public function month($begin, $end = null, Calendar $calendar = null){
        return new Month($begin, $end, $calendar);
    }


    /**
     * @param $begin
     * @param null $end
     * @param Calendar|null $calendar
     * @return Year
     */
    public function year($begin, $end = null, Calendar $calendar = null){
        return new Year($begin, $end, $calendar);
    }
}
?>
