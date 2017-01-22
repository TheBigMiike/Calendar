# Calendar

WIP : A small library for manipulating periods and generate calendars. Still work in progress.

## Create a calendar
You can create a calendar in 2 different ways :

By using Laravel facades (requires `illuminate\support` package)

`$calendar = Calendar::create('2016-09-01', '2017-07-01');`

Or by instantiating a Calendar class

`$calendar = new Calendar('2016-09-01', '2017-07-01')`

You can pass `\DateTime()`  or `Moment()` instances instead of typing a date format

## Change Calendar settings
### Set locale / translate date and month names (Moment feature)

To translate day and month names : `MomentLocale::setLocale('fr_FR');`

### Change week first day
Parameter is an integer :

* 0 = Sunday
* 1 = Monday
* 2 = Tuesday
* 3 = Wednesday
* 4 = Thursday
* 5 = Friday
* 6 = Saturdy

Example to set the beginning of a week to Monday

`$calendar->setWeekFirstDay(1) // 1 for Monday`

### Change non business days in a week
Parameter is an array of integer and system is the same like above : Integers between 0 and 6 match to a specific day.

`$calendar->setNonBusinessDays([0, 3, 6]);`

## Add events and holidays

You need to create an `Event` or `Holiday` object. Both are similar but instantiating an Holiday class will set period as non business period.

`
$holiday = new Holiday('Christmas holidays', '2016-12-19', '2017-01-02');
$calendar->addHoliday($holiday);
// same for events
`

You can pass an `array` or a `Calendar\Collections\Collection`of holidays too.

## Generate HTML calendar

```php
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
```