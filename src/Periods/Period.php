<?php
namespace Calendar\Periods;

use Calendar\Collections\Collection;
use Calendar\Traits\DateTrait;
use Moment\Moment;
use Calendar\Calendar;

abstract class Period{

    /**
     * @var Moment
     */
    protected $begin;

    /**
     * @var Moment
     */
    protected $end;

    /**
     * @var Collection
     */
    protected $events;

    /**
     * @var Collection
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
        $this->begin    = clone $begin;
        $this->end      = clone $begin->add($this->dateInterval());
        $this->config   = $config;
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
            $this->events = $this->config->events()->inRange($this->begin(), $this->end());
        }
        return $this->events;
    }

    /**
     * Returns last day or not
     * @return bool
     */
    public function holidays(){
        if(empty($this->holidays)){
            $this->holidays = $this->config->holidays()->inRange($this->begin(), $this->end());
        }
        return $this->holidays;
    }


}
