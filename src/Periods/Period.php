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
     * @param null $end
     * @param Calendar $config
     */
    public function __construct($begin, $end = null, Calendar $config = null){
        $this->setBegin($begin);
        $this->setEnd($end);
        $this->setConfig($config);
    }

    /**
     * Begin setter
     * @param $begin
     */
    public function setBegin($begin){
        $this->begin = clone $this->getMoment($begin);
        $this->setEnd();
    }

    /**
     * Beginning of this period
     * @return Moment
     */
    public function begin(){
        return clone $this->begin;
    }

    /**
     * End setter
     * @param $end
     */
    public function setEnd($end = null){
        if(!$end){
            $end = $this->begin()->endOf($this->period());
        }
        $this->end = clone $this->getMoment($end);
    }

    /**
    * End of this period
    * @return Moment
     */
    public function end(){
        return clone $this->end;
    }

    /**
     * Config setter
     * @param Calendar $config
     */
    public function setConfig(Calendar $config = null){
        if(!$config){
            $config = new Calendar($this->begin(), $this->end());
        }
        $this->config = $config;
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
