<?php
namespace Calendar\Periods;

use Calendar\Collections\Collection;

class Year extends Period{

    /**
     * @var Collection <CalendarMonth>
     */
    protected $months;


    /**
     * Echo the year
     * @return string
     */
    public function __toString(){
        return (string) $this->format('Y');
    }

    /**
     * Creates a collection of CalendarMonth instances
     * @return Collection
     */
    public function months(){
        $collection = new Collection();
        $current    = clone $this->begin;

        while($current < $this->end()){
            $collection->add(new Month($current, null, $this->config));
            $current->endOf('month')->addSeconds(1);
        }

        $collection->last()->setEnd($this->end());
        return $collection;
    }

    /**
     * Get the DateInterval
     * @return \DateInterval
     */
    public function dateInterval(){
        return new \DateInterval('P1Y');
    }

    /**
     * Get the period type
     * @return string
     */
    public function period(){
        return 'year';
    }
}
