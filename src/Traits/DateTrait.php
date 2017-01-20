<?php
namespace Calendar\Traits;

use InvalidArgumentException;
use Moment\Moment;

trait DateTrait{

    protected function getMoment($date){

        // If $date is already a Moment instance, then we return the given value
        if($date instanceof Moment){
            return $date;
        }

        // If $date is an instance of DateTime, we convert $date to a Moment instance
        if($date instanceof \DateTime ){
            return new Moment($date->format('Y-m-d H:i:s.u'));
        }

        // We'll assume $date is a given format so a Moment instance is created
        return new Moment($date);
    }


    protected function getMomentFromFormat($y = null, $m = '01', $d = '01', $h = '00', $m = '00', $s = '00'){
        if(is_null($y)){
            $y = date('Y');
        }
        return new Moment($y.'-'.$m.'-'.$d.' '.$h.':'.$m.':'.$s);
    }


    protected function getDateFormat($date, $format = 'Y-m-d'){
        if(!$date instanceof \DateTime){
            throw new InvalidArgumentException('This method only accepts \DateTime instances');
        }

        return $date->format($format);
    }

}