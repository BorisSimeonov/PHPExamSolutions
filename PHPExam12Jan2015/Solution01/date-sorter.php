<?php
$dateNow = date_create($_GET['currDate'], timezone_open("Europe/Sofia"));
$allDates = getDates();
sort($allDates);

$text = "<ul>";
foreach ($allDates as $date) {
    if($date < $dateNow){
        $text = $text."<li><em>".date_format($date, "d/m/Y")."</em></li>";
    }else{
        $text = $text."<li>".date_format($date, "d/m/Y")."</li>";
    }
}
$text = $text."</ul>";
echo $text;

function getDates(){
    $input = $_GET['list'];
    $dates = preg_split('/\n/', $input);
    $datesArray = array();
    foreach($dates as $date){
        $checkValid = date_create($date, timezone_open("Europe/Sofia"));
        if($date != "" && $checkValid){
            $datesArray[] = $checkValid;
        }
    }
    return $datesArray;
}
?>