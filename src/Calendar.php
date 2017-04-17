<?php
namespace Calendar;

use Calendar\Collections\Collection;
use Calendar\Collections\EventCollection;
use Calendar\Periods\Day;
use Calendar\Periods\Year;
use Calendar\Traits\DateTrait;
use Moment\Moment;

class Calendar{

    use DateTrait;

    /**
     * @var Day
     */
    protected $begin;

    /**
     * @var Day
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
     * @var integer
     */
    protected $week_first_day = 0;

    /**
     * @var array
     */
    protected $non_business_days = [0, 3, 6];

    /**
     * @var CalendarFactory
     */
    protected $factory;

    /**
     * Constructor
     * @param string|\DateTime $begin
     * @param string|\DateTime $end
     */
    public function __construct($begin, $end){
        $this->begin    = $this->getMoment($begin);
        $this->end      = $this->getMoment($end);
        $this->events   = new EventCollection();
        $this->holidays = new EventCollection();
    }

    /**
     * Add Event / Vacation
     * @param Event $event
     * @return int
     * @internal param string $locale
     */
    public function addEvent($event){
        $this->events->addOrMerge($event);
    }

    /**
     * Get all events
     * @return Collection
     */
    public function events(){
        return $this->events;
    }

    /**
     * Get all events
     * @return Collection
     */
    public function addHoliday($holiday){
        $this->holidays->addOrMerge($holiday);
    }

    /**
     * Get all holidays / bank holidays
     * @return Collection
     */
    public function holidays(){
        return $this->holidays;
    }

    /**
     * Set week first day
     * @param int $day
     */
    public function setWeekFirstDay($day = 0){
        $this->week_first_day = $day;
    }

    /**
     * Get week first day
     * @return integer
     */
    public function weekFirstDay(){
        return $this->week_first_day;
    }

    /**
     * Set casual non business days
     * @param array $non_business_days
     */
    public function setNonBusinessDays($non_business_days){
        $this->non_business_days = $non_business_days;
    }

    /**
     * Get non business days
     * @return array $non_business_days
     */
    public function nonBusinessDays(){
        return $this->non_business_days;
    }

    /**
     * Get the start date
     * @return Moment
     */
    public function begin(){
        return clone $this->begin;
    }

    /**
     * Get the end date
     * @return Moment
     */
    public function end(){
        return clone $this->end;
    }

    /**
     * Get the factory
     * @return CalendarFactory
     */
    public function factory(){
        if(!$this->factory){
            $this->factory = new CalendarFactory();
        }
        return $this->factory;
    }

    /**
     * Create a collection of years, months or days
     * @param string
     * @return Collection
     */
    public function createPeriodCollection($period){
        $collection = new Collection();
        $current    = clone $this->begin();

        while($current < $this->end()){
            $collection->add($this->factory()->$period($current, null, $this));
            $current->endOf($period)->addSeconds(1);
        }

        $collection->last()->setEnd($this->end());
        return $collection;
    }


    /**
     * Handle dynamic calls
     */
    public function __call($method, $arguments = array()){
        if(in_array($method, ['years', 'months', 'days'])){
            return $this->createPeriodCollection(rtrim($method, 's'));
        }
    }
}
 ?>
