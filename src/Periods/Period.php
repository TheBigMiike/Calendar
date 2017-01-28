<?php
namespace Calendar\Periods;

use Calendar\Collections\Collection;
use Calendar\Collections\EventCollection;
use Calendar\Traits\DateTrait;
use Moment\Moment;
use Calendar\Calendar;

abstract class Period implements PeriodInterface{

    use DateTrait;

    /**
     * @var Moment
     */
    protected $begin;

    /**
     * @var Moment
     */
    protected $end;

    /**
     * @var EventCollection
     */
    protected $events;

    /**
     * @var EventCollection
     */
    protected $holidays;

    /**
     * @var Calendar
     */
    protected $config;


    /**
     * Constructor
     * @param $begin
     * @param Calendar|NULL $calendar
     */
    public function __construct($begin, Calendar $config = null){
        $this->begin    = clone $this->getMoment($begin);
        $this->end      = clone $this->getMoment($begin)->add($this->dateInterval());
        $this->config   = $config;
        // destroy $begin
        unset($begin);
    }

    /**
     * Beginning of this period
     * @return Moment
     */
    public function begin(){
        return clone $this->begin;
    }

    /**
    * End of this period
    * @return Moment
     */
    public function end(){
        return clone $this->end;
    }

    /**
     * Return the date in a specific format
     * @return string
     */
    public function format($format){
        return $this->begin->format($format);
    }

    /**
     * Returns last day or not
     * @return bool
     */
    public function events(){
        if(empty($this->events)){
            $this->events = $this->config->events()->overlaps($this->begin(), $this->end());
        }
        return $this->events;
    }

    /**
     * Returns last day or not
     * @return bool
     */
    public function holidays(){
        if(empty($this->holidays)){
            $this->holidays = $this->config->holidays()->overlaps($this->begin(), $this->end());
        }
        return $this->holidays;
    }


}
