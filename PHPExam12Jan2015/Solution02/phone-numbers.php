<?php

$inLine = $_GET['numbersString'];
$inLine = rawurldecode ($inLine);
$regex = '/[A-Z]{1}[a-zA-Z]*[^a-zA-Z+]*\+?[0-9]{1,}[\)\(\-\s\.\/0-9\W]*[0-9]{1,}/';
$rawExtract;
preg_match_all($regex,$inLine,$rawExtract);
$rawExtract = $rawExtract[0];
$names = [];
$numbers = [];
if(count($rawExtract)>0){
    for($cnt = 0; $cnt< count($rawExtract);$cnt++){
        $nameBuffer;
        $numBuffer;
        preg_match_all('/[a-z]{1,}/i',$rawExtract[$cnt],$nameBuffer);
        preg_match_all('/\+?[0-9]{1,}[\)\(\-\s\.\/0-9]*[0-9]{1,}/',$rawExtract[$cnt],$numBuffer);
        $numBuffer[0] = preg_replace('/[\-\.\s\/\)\(]/',"",$numBuffer[0]);
        array_push($names, $nameBuffer[0][0]);
        array_push($numbers, $numBuffer[0][0]);
    };
    for($idx = 0; $idx< count($numbers); $idx++){
        $numbers[$idx] = preg_replace('/[\-\.\s\/\)\(]/',"",$numbers[$idx]);
    };
    echo "<ol>";
    for($index = 0; $index<count($numbers); $index++){
        echo "<li><b>$names[$index]:</b> $numbers[$index]</li>";
    };
    echo "</ol>";
}else{
    echo "<p>No matches!</p>";
}


?>