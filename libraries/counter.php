<?php
$today            =    'Hôm nay : ';
$yesterday        =    'Hôm qua : ';
$x_month        =    'Tháng này : ';
$x_week            =    'Tuần này : ';
$all            =    'Tất cả : ';

$locktime        =  15;
$initialvalue    =    1;
$records        =    500000;

$s_today        =    1;
$s_yesterday    =    1;
$s_all            =    1;
$s_week            =    1;
$s_month        =    1;

$s_digit        =    1;
$disp_type        =     'Mechanical';

$widthtable        =    '60';
$pretext        =     '';
$posttext        =     '';
$locktime        =    $locktime * 60;
// Now we are checking if the ip was logged in the database. Depending of the value in minutes in the locktime variable. 
$day             =    date('d');
$month             =    date('n');
$year             =    date('Y');
$daystart         =    mktime(0, 0, 0, $month, $day, $year);
$monthstart         =  mktime(0, 0, 0, $month, 1, $year);
// weekstart 
$weekday         =    date('w');
$weekday--;
if ($weekday < 0)    $weekday = 7;
$weekday         =    $weekday * 24 * 60 * 60;
$weekstart         =    $daystart - $weekday;

$yesterdaystart     =    $daystart - (24 * 60 * 60);
$now             =    time();
$ip                 =    $_SERVER['REMOTE_ADDR'];

$query             =    "SELECT MAX(id) AS total FROM table_counter";
$d->query($query);
$t = $d->fetch_array();
$all_visitors     =    $t['total'];

if ($all_visitors !== NULL) {
    $all_visitors += $initialvalue;
} else {
    $all_visitors = $initialvalue;
}

// Delete old records 
$temp = $all_visitors - $records;

if ($temp > 0) {
    $query         =  "DELETE FROM table_counter WHERE id<'$temp'";
    $d->query($query);
}

$query             =    "SELECT COUNT(*) AS visitip FROM table_counter WHERE ip='$ip' AND (tm+'$locktime')>'$now'";
$d->query($query);
$vip  = $d->fetch_array();
$items             =    $vip['visitip'];

if (empty($items)) {
    //$query = "INSERT INTO table_counter (tm, ip) VALUES ('$now', '$ip')";
    $d->reset();
    $datax['tm'] = $now;
    $datax['ip'] = $ip;
    $d->setTable('counter');
    if($d->insert($datax)){

    } 
}
$n                 =     $all_visitors;
$div = 100000;
while ($n > $div) {
    $div *= 10;
}

$query             =    "SELECT COUNT(*) AS todayrecord FROM table_counter WHERE tm>'$daystart'";
$d->query($query);
$todayrc  = $d->fetch_array();
$today_visitors     =    $todayrc['todayrecord'];

$query             =    "SELECT COUNT(*) AS yesterdayrec FROM table_counter WHERE tm>'$yesterdaystart' and tm<'$daystart'";
$d->query($query);
$yesrec  = $d->fetch_array();
$yesterday_visitors     =    $yesrec['yesterdayrec'];

$query             =    "SELECT COUNT(*) AS weekrec FROM table_counter WHERE tm>='$weekstart'";
$d->query($query);
$weekrec = $d->fetch_array();
$week_visitors     =    $weekrec['weekrec'];

$query             =    "SELECT COUNT(*) AS monthrec FROM table_counter WHERE tm>='$monthstart'";
$d->query($query);
$monthrec  = $d->fetch_array();
$month_visitors     =    $monthrec['monthrec'];
