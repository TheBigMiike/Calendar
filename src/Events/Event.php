<?php
namespace Calendar\Events;

use Calendar\Traits\DateTrait;

class Event{

    use DateTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $begin;

    /**
     * @var \DateTime
     */
    protected $end;

    /**
     * Event constructor.
     * @param string $name
     * @param \DateTime $begin
     * @param \DateTime $end
     */
    public function __construct($name, $begin, $end){
        $this->setName($name);
        $this->setBegin($begin);
        $this->setEnd($end);
    }

    /**
     * Setter for name
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Getter for name
     * @return string
     */
    public function name(){
        return $this->name;
    }

    /**
     * Setter for begin
     * @param \DateTime|string $begin
     */
    public function setBegin($begin){
        $this->begin = $this->getMoment($begin);
    }

    /**
     * Getter for begin
     * @return mixed
     */
    public function begin(){
        return $this->begin;
    }

    /**
     * Setter for end
     * @param \DateTime|string $end
     */
    public function setEnd($end){
        $this->end = $this->getMoment($end);
    }

    /**
     * Getter for end
     * @return mixed
     */
    public function end(){
        return $this->end;
    }
}