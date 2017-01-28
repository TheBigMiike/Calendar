<?php
namespace Calendar\Periods;

class Day extends Period{

    protected $is_business_day = null;

    const SUNDAY = 0;

    const MONDAY = 1;

    const TUESDAY = 2;

    const WEDNESDAY = 3;

    const THURSDAY = 4;

    const FRIDAY = 5;

    const SATURDAY = 6;

    /**
     * Echo the day number
     * @return string
     */
    public function __toString(){
        return $this->number();
    }

    /**
     * Return the short name
     * @return string
     */
    public function short(){
        return $this->format('D');
    }

    /**
     * Return the full name
     * @return string
     */
    public function name(){
        return $this->format('l');
    }

    /**
     * Get the day number
     * @return string
     */
    public function number(){
        return (string) $this->format('d');
    }

    /**
     * Get the weekday using integer. From 0 to 6.
     * @return integer
     */
    public function weekday(){
        return $this->format('w');
    }

    /**
     * Get the DateInterval
     * @return \DateInterval
     */
    public function dateInterval(){
        return new \DateInterval('P1D');
    }

    /**
     * Get the period type
     * @return string
     */
    public function period(){
        return 'day';
    }

    /**
     * Get the offset for generating HTML calendar
     * @return integer
     */
    public function colspan(){
        if($this->format('d') == '01'){
            return (int) (7 + (($this->format('w') - $this->config->weekFirstDay()) % 7)) % 7;
        }
        return 0;
    }

    /**
     * Returns first day or not
     * @return bool
     */
    public function isWeekFirstDay(){
        return ($this->weekday() == 0);
    }

    /**
     * Returns last day or not
     * @return bool
     */
    public function isWeekLastDay(){
        return ($this->weekday() == 6);
    }

    /**
     * Returns if day is a working day or not
     * @return bool
     */
    public function isBusinessDay(){
        if(empty($this->is_business_day)){
            $this->is_business_day = true;
            if(in_array($this->weekday(), $this->config->nonBusinessDays()) || !$this->holidays()->isEmpty()){
                $this->is_business_day = false;
            }
        }
        return $this->is_business_day;
    }
}
