<?php
$keys = $_GET['keys'];
$text = $_GET['text'];
$startKey = preg_replace('/[0-9]{1,}[a-zA-Z\_]*/',"",$keys);
$endKey = preg_replace('/[a-zA-Z\_0-9]*[0-9]+/',"",$keys);


if($startKey === "" || $endKey === "" || !preg_match('/^[a-zA-Z_]+$/',$startKey) || !preg_match('/^[a-zA-Z_]+$/',$endKey)){
    echo "<p>A key is missing</p>";
}else{
    $matchedNumbers = [];
    preg_match_all('/'.preg_quote($startKey).'(.*?)'.preg_quote($endKey).'/is', $text, $matchedNumbers);
    $matchedNumbers = $matchedNumbers[1];
    $sum = 0;
    $hasNums = false;

    foreach($matchedNumbers as $match){
        if(preg_match('/^[0-9]{0,}\.{0,1}[0-9]+]*$/', $match)){
            $sum += $match;
            $hasNums = true;
        }
    }

    if($hasNums && $sum>0){
        echo "<p>The total value is: <em>$sum</em></p>";
    }else{
        echo "<p>The total value is: <em>nothing</em></p>";
    }
}