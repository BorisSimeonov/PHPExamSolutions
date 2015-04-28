<?php
$minSeats = (int)$_GET['minSeats'];
$maxSeats = (int)$_GET['maxSeats'];
$genreFilter = $_GET['filter'];
$sortOrder = $_GET['order'];

$input = $_GET['list'];
preg_match_all('/[a-zA-Z\W\s]+[0-9]?[a-zA-Z\W\s]+\/{1}\s{1}[0-9]+/', $input, $input);
$otherGnrArray = [];
$mainGnrArray = [];

foreach($input as $movie){
    $name = preg_replace('/(.*?)\({1}[a-z]+\){1}(.*)+/', "$1", $movie);
    $seats = preg_replace('/[a-zA-Z\W\s]+[0-9]?[a-zA-Z\W\s]+\/{1}\s*(.*?)+/', "$1", $movie);
    $stars = preg_replace('/[a-zA-Z\W\s]+[0-9]?[a-zA-Z\W\s]+\){1}\-{1}\s*(.*?)\s*\/{1}\s*[0-9\s]+/', "$1", $movie);
    $genre = preg_replace('/[a-zA-Z\W\s]+[0-9]?[a-zA-Z\W\s]+\({1}(.*?)\){1}\-{1}\s*(.*?)\s*\/{1}\s*[0-9\s]+/', "$1", $movie);
}
for($idx = 0; $idx<count($name); $idx++){
    $starsArray = trim($stars[$idx]);
    $starsArray = preg_split('/\s*\,{1}\s*/',$stars[$idx]);
    $bufferArr = [trim($name[$idx]), $starsArray, trim($genre[$idx]), trim($seats[$idx])];
    if((trim($genre[$idx]) === $genreFilter || $genreFilter === "all") && (int)trim($seats[$idx]) >= $minSeats && (int)trim($seats[$idx]) <= $maxSeats){
        array_push($mainGnrArray, $bufferArr);
    }
}
$mainGnrArray = sortArray($mainGnrArray, $sortOrder);

printArray($mainGnrArray);


function sortArray($arr, $stOrder){
    if($stOrder === "ascending"){
        usort($arr, "srtAsc");
    }else{
        usort($arr, "srtDsc");
    }
    return $arr;
}
function printArray($arr){
    $result = "";
    foreach($arr as $mov){
        $result.="<div class=\"screening\"><h2>$mov[0]</h2><ul>";
        foreach($mov[1] as $starItem){
            $result.= "<li class=\"star\">$starItem</li>";
        }
        $result.= "</ul><span class=\"seatsFilled\">$mov[3] seats filled</span></div>";
    }
    echo $result;
}
function srtAsc($a, $b){
    if($a[0] !== $b[0]){
        return $a[0] > $b[0];
    }else{
        return (int)$a[3] > (int)$b[3];
    }
    return 0;
}

function srtDsc($a, $b){
    if($a[0] !== $b[0]){
        return $a[0] < $b[0];
    }else{
        return (int)$a[3] > (int)$b[3];
    }
    return 0;
}