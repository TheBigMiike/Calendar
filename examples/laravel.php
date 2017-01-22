<?php
require '../vendor/autoload.php';

use Calendar\Facades\Calendar;
use Calendar\Events\Holiday;

// Set locale to french
// Calendar library uses Moment for manipulating dates.
\Moment\MomentLocale::setLocale('fr_FR');

// Create an instance of CalendarFactory
$calendar   = Calendar::createCalendar('2016-09-01', '2017-07-04');

$holiday    = new Holiday('Vacances de Noel', '2016-12-22', '2017-01-02');
$calendar->setWeekFirstDay(1);
$calendar->setNonBusinessDays([2, 5, 6]);
$calendar->addHoliday($holiday);
?>
<html>
    <?php foreach($calendar->years() as $year){ ?>
        <?php foreach($year->months() as $month) {
            echo $month->name();
        ?>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                    <th>Dim</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        foreach($month->days() as $day){
                            if($day->colspan() != 0){
                                echo '<td colspan="'.$day->colspan().'"></td>';
                            }

                            if(!$day->isBusinessDay()){
                                echo '<td style="color: #f00">';
                            }else{
                                echo '<td>';
                            }
                            echo $day.'</td>';
                            if($day->isWeekLastDay()){
                                echo '</tr><tr>';
                            }
                        }
                    ?>
                </tr>
            </tbody>
        </table>
        <?php } ?>
    <?php } ?>
</html>
