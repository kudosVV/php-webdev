<?php

$pageContent = NULL;
$dateContent = NULL;
$timeContent = NULL;
$semesterContent = NULL;
$holidayContent = NULL;
$amChecked = $pmChecked = NULL;

date_default_timezone_set('America/Chicago');

$ampm = date('A');
$seconds = date('s');
$minutes = date('i');
$hours = date('g');
$displayhours = $hours;
$month = date('m');
$day = date('j');
$year = date("Y");

if (filter_has_var(INPUT_POST, 'submit')) {
$ampm = filter_input(INPUT_POST, 'ampm');
$seconds = filter_input(INPUT_POST, 'seconds');
$minutes = filter_input(INPUT_POST, 'ampm');
$displayhours = filter_input(INPUT_POST, 'hours');
$month = filter_input(INPUT_POST, 'month');
$day = filter_input(INPUT_POST, 'day');
$year = filter_input(INPUT_POST, 'year');
$hours = $displayhours;
}

if($ampm = 'PM') {
    if($hours < 12) {
        $hours += 12;

    }
    $pmChecked = "checked";
} else {
    if($hours == 12) {
        $hours = 0;
    }
    $amChecked = "checked";
}

$today = mktime($hours,$minutes,$seconds, $month,$day,$year);

$timeForm = <<<HERE
<p>What if we used another time to show the results below?</p>
<form method = "post">
<input type="number" name="hours" value="$displayhours" placeholder="HH" size="3" min="0" max="59">
<input type="number" name="minutes" value="$minutes" placeholder="MM" size="3" min="0" max="59">
<input type="number" name="minutes" value="$seconds" placeholder="MM" size="3" min="0" max="59">
<label><input type="radio" name="ampm" value="AM" $amChecked>&nbsp;AM</label>
<label><input type="radio" name="ampm" value="PM" $pmChecked>&nbsp;PM</label>
<input type="submit" name="submit" value="Show Selected">
<input type="submit" name="reset" value="Show Now">

HERE;

$month_select = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthList = NULL;

foreach ($month_select as $key => $value) {
    if($key == $month) {
        $monthList .= <<<HERE
        <option value="$key" selected>$value</option>\n
HERE;
    }else{
        $monthList .= <<<HERE
        <option value="$key">$value</option>\n
HERE;
    }
}

$dayList = NULL;
for ($i = 1; $i <= 31; $i++) {
    if($i == $day){
        $dayList .= <<<HERE
        <option value="$i" selected>$i</option>\n
HERE;
    }else{
        $dayList .= <<<HERE
        <option value="$i>$i</option>\n
HERE;
    }
}

$yearList = NULL;
for ($j = date('Y'); $j >=  2000; $j--) {
    if($j == $year) {
        $yearList .= <<<HERE
        <option value="$j" selected>$j</option>\n
HERE;
    }else{
        $yearList .= <<<HERE
        <option value="$j">$j</option>\n
HERE;
    }
}

$dateForm = <<< HERE
<p>What if we used another date to show the results below?</p>
<select name="month">
    $monthList
</select>
<select name="day">
    $dayList
</select>
<select name="year">
    $yearList
</select>
<input type="submit" name="submit" value="Show Selected">
<input type="submit" name="reset" value="Show Today">
</form>


HERE;

$currentDate = date("l, F j, Y", $today);
$currentTime = date("g:i A", $today);
$dateContent = <<<HERE
<h2>Hello guest! The day is $currentDate. The time is $currentTime.</h2>
HERE;

//Time of Day

$morning = 6;
$daytime= 12;
$evening = 18;

if ($hours >= $evening) {
    $timeContent .= <<<HERE
    <figure>
    <img src="images/evening.jpeg" alt="Evening Image">
    <figcaption>It's evening...</figcaption>
    </figure>
HERE;
} else if ($hours >= $daytime) {
    $timeContent .= <<<HERE
    <figure>
    <img src="images/daytime.jpeg" alt="Day Image">
    <figcaption>It's day time...</figcaption>
    </figure>
HERE;
} else if ($hours >= $morning) {
    $timeContent .= <<<HERE
    <figure>
<img src="images/morning.png" alt="Morning Image">
    <figcaption>It's morning...</figcaption>
    </figure>
HERE;


} else {
    $timeContent .= <<<HERE
    <figure>
    <img src="images/night.png" alt="Night Image">
    <figcaption>It's night time...</figcaption>
    </figure>
HERE;
}

$newyears = 1;
$summer = 6;
$fall = 9;

if ($month >= $fall) {
    $semesterContent .= <<<HERE
    <figure>
    <img src="images/fall.jpeg" alt="Fall Image">
    <figcaption>..and it's the fall semester.</figcaption>
    </figure>

HERE;
} else if ($month >= $summer) {
    $semesterContent .= <<<HERE
    <figure>
    <img src="images/summer.jpeg" alt="Summer Image">
    <figcaption>..and it's the summer semester.</figcaption>
    </figure>

HERE;
} else {
    $semesterContent .= <<<HERE
    <figure>
    <img src="images/spring.jpeg" alt="Spring Image">
    <figcaption>..and it's the spring semester.</figcaption>
    </figure>

HERE;
} 

//Determine Holiday

$day1 = date('z', strtotime("July 4"));
$day2 = date('z', $today);

if ($day1 == $day2) {
    $holidayContent .= <<<HERE
    <figure>
    <img src="images/july42.jpeg" alt="July4 Image">
    </figcaption>Happy Independence Day!!</figcaption>
    </figure>

HERE;
} elseif($day1 > $day2){
    $diff = $day1 - $day2;
    $holidayContent .= <<<HERE
    <figure>
    <img src="images/july4.jpg" alt="Almost July4 Image">
    </figcaption>There are $diff days until Independence Day!</figcaption>
    </figure>
HERE;
} else {
    $day4 = date('z', strtotime("July 4"));
    $day3 = date('z', strtotime("July 4 +1 year"));
    $diff = ($day4 - $day2) + $day3;
    $holidayContent .= <<<HERE
    <figure>
    <img src="images/july4.jpg" alt="Almost July4 Image">
    </figcaption>There are $diff days until next Independence Day!!</figcaption>
    </figure>
 HERE;   
}

//Assemble page contents


$pageContent .= <<<HERE


$dateContent

<div class="container">
  <div class="row">
    <div class="col-md-4">
      $timeContent
    </div>
    <div class="col-md-4">
      $semesterContent
    </div>
    <div class="col-md-4">
       $holidayContent
    </div>
  </div>
  
  $timeForm
    $dateForm
</div>
HERE;



$postArray = "<pre>";
$postArray .= print_r($POST, true);
$postArray .="</pre>";
$pageContent .= $postArray;
$pageContent .= $hours;

$pageTitle = "My Calendar";
include "template.php";
?>