<?php
$minPrice = (float)$_GET['min-price'];
$maxPrice = (float)$_GET['max-price'];
$sortCrit = $_GET['sort'];
$order = $_GET['order'];
$books = preg_split('/\n/', $_GET['text']);

$matchedBooks = [];
//filter by price
for($idx = 0; $idx<count($books); $idx++){
    $books[$idx] = preg_split('/\s*\/{1}\s*/', $books[$idx]);
    if((float)$books[$idx][3] >= $minPrice && (float)$books[$idx][3] <= $maxPrice){
        array_push($matchedBooks, $books[$idx]);
    }
}


switch($sortCrit){
    case 'genre': {
        if($order === 'ascending') {
            usort($matchedBooks, 'aSortGenre');
        } else if($order === 'descending') {
            usort($matchedBooks, 'dSortGenre');
        }
        break;
    }
    case 'author': {
        if($order === 'ascending') {
            usort($matchedBooks, 'aSortAuthor');
        } else if($order === 'descending') {
            usort($matchedBooks, 'dSortAuthor');
        }
        break;
    }
    case 'publish-date': {
        if($order === 'ascending') {
            usort($matchedBooks, 'aSortDate');
        } else if($order === 'descending') {
            usort($matchedBooks, 'dSortDate');
        }
        break;
    }
}

printArray($matchedBooks);


function aSortGenre($a, $b) {
    $compare = strcmp($a[2], $b[2]);
    if($compare == 0) {
        if(date_create($a[4], timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
        if(date_create($a[4],timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    }
    return $compare;
}

function dSortGenre($a, $b) {
    $compare = strcmp($a[2], $b[2]);
    $compare *= -1;
    if($compare == 0) {
        if(date_create($a[4], timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
        if(date_create($a[4],timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    }
    return $compare;
}

function aSortAuthor($a, $b) {
    $compare = strcmp($a[0], $b[0]);
    if($compare === 0) {
        if(date_create($a[4], timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
        if(date_create($a[4],timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    }
    return $compare;
}

function dSortAuthor($a, $b) {
    $compare = strcmp($a[0], $b[0]);
    $compare *= -1;
    if($compare == 0) {
        if(date_create($a[4], timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
        if(date_create($a[4],timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    }
    return $compare;
}

function aSortDate($a, $b) {
    if(date_create($a[4], timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
    if(date_create($a[4],timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    return 0;
}

function dSortDate($a, $b) {
    if(date_create($a[4], timezone_open("Europe/Sofia")) < date_create($b[4],timezone_open("Europe/Sofia"))) return 1;
    if(date_create($a[4],timezone_open("Europe/Sofia")) > date_create($b[4],timezone_open("Europe/Sofia"))) return -1;
    return 0;
}

function printArray($array){
    $result = "";
    for($idx = 0; $idx<count($array); $idx++)
    {
        $result .= "<div><p>".htmlspecialchars(trim($array[$idx][1]))."</p><ul><li>".htmlspecialchars(trim($array[$idx][0]))."</li>".
            "<li>".htmlspecialchars(trim($array[$idx][2]))."</li><li>".htmlspecialchars(trim($array[$idx][3]))."</li><li>".
            htmlspecialchars(trim($array[$idx][4]))."</li><li>".htmlspecialchars(trim($array[$idx][5]))."</li></ul></div>";
    }
    echo $result;
}