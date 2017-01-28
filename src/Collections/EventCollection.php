<?php
namespace Calendar\Collections;

use Calendar\Traits\DateTrait;

class EventCollection extends Collection{

    use DateTrait;

    public function matches($begin, $end){
        return $this->getEventsWhile($begin, $end, function($begin, $end, $event){
            return ($event->begin() == $begin && $event->end() == $end);
        });
    }

    public function between($begin, $end){
        return $this->getEventsWhile($begin, $end, function($begin, $end, $event){
            return ($event->begin() <= $begin && $event->end() >= $end);
        });
    }

    public function overlaps($begin, $end){
        return $this->getEventsWhile($begin, $end, function($begin, $end, $event){
            return ($event->begin() <= $end && $event->end() >= $begin);
        });
    }

    protected function getEventsWhile($begin, $end, $callback){
        $collection = new EventCollection();
        $begin      = $this->getMoment($begin);
        $end        = $this->getMoment($end);

        foreach($this->toArray() as $event){
            if($callback($begin, $end, $event)){
                $collection->add($event);
            }
        }
        return $collection;
    }
}
