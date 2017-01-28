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
     * @param null $year
     * @param Calendar|null $calendar
     * @return Collection;
     */
    public function months($year = null, Calendar $calendar = null){
        if(is_null($year)){
            $year = date('Y');
        }

        if(!$year instanceof \DateTime){
            $year = new Moment($year.'-01-01');
        }

        $instance = new Year($year, $calendar);
        return $instance->months();
    }


    /**
     * @param null $year
     * @param null $month
     * @param null $day
     * @param Calendar|null $calendar
     * @return Day
     */
    public function day4($year = null, $month = null, $day = null, Calendar $calendar = null){
        return new Day($this->getMomentFromFormat($year, $month, $day), $calendar);
    }


    /**
     * @param $date
     * @param Calendar|null $calendar
     * @return Day
     */
    public function day2($date, Calendar $calendar = null){
        return new Day($this->getMoment($date), $calendar);
    }


    /**
     * @param null $month
     * @param null $year
     * @param Calendar|null $calendar
     * @return Month
     */
    public function month3($month = null, $year = null, Calendar $calendar = null){
        return new Month($this->getMomentFromFormat($year, $month));
    }


    /**
     * @param $month
     * @param Calendar|null $calendar
     * @return Month
     */
    public function month2($month, Calendar $calendar = null){
        return new Month($this->getMomentFromFormat($month), $calendar);
    }

    /**
     * @param null $year
     * @param Calendar|null $calendar
     * @return Year
     */
    public function year($year = null, Calendar $calendar = null){
        if(strlen($year) == 4){
            $year = $this->getMomentFromFormat($year);
        }

        return new Year($this->getMoment($year));
    }

    /**
     * Method for calling a method with the same name but not the same args
     * @param $name
     * @param $args
     * @return mixed
     */
    function __call($name, $args){
        $name = $name.count($args);
        return call_user_func_array(array($this, $name), $args);
    }
}
?>
