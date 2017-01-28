<?php
/**
 * Created by PhpStorm.
 * User: Brendan
 * Date: 26/01/2017
 * Time: 18:24
 */

namespace Calendar\Periods;


interface PeriodInterface{

    public function format($format);

    public function period();

    public function dateInterval();

    public function begin();

    public function end();
}