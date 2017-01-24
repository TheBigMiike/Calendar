<?php
namespace Calendar\Periods;

use Calendar\Collections\Collection;

class Month extends Period{


    /**
     * @var Collection <Day>
     */
    protected $days;



    /**
     * Echo the month number
     * @return string
     */
    public function __toString(){
        return (string) $this->format('m');
    }

    /**
     * Return the month name
     * @return string
     */
    public function name(){
        return $this->format('F');
    }

    /**
     * Return the short name
     * @return string
     */
    public function short(){
        return $this->format('M');
    }

    /**
     * Get the day number
     * @return string
     */
    public function number(){
        return (string) $this->format('m');
    }

    /**
     * Creates a collection of CalendarMonth instances
     * @return Collection
     */
    public function days(){
        $collection = new Collection();
        $current    = clone $this->begin;

        while($current < $this->end){
            $collection->add(new Day($current, $this->config));
        }
        return $collection;
    }

    /**
     * Get the DateInterval
     * @return \DateInterval
     */
    public function dateInterval(){
        return new \DateInterval('P1M');
    }
}
