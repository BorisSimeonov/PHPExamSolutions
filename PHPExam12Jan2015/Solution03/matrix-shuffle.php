<?php
$count = (int)$_GET['size'];
$text = $_GET['text'];
//echo $text."<br/>";
$array = createEmptyArr($count);
$array = fillSpiral($array, $text, $count);

//foreach($array as $row){
//    var_dump($row);
//    echo "<br />";
//}

$newText = GetNewText($array);
//echo $newText;
$isPalindrome = checkPal($newText);
$color = "";
if($isPalindrome){
    $color = "style='background-color:#4FE000'";
}else{
    $color = "style='background-color:#E0000F'";
}
echo "<div $color>".$newText."</div>";




function createEmptyArr($cnt){
    $arr=[];
    $arrBuilder = str_repeat("*", $cnt);
    $arrBuilder = str_split($arrBuilder);

    for($row = 0; $row<$cnt; $row++){
        array_push($arr, $arrBuilder);
    }
    return $arr;
}
function fillSpiral($arr, $chars, $cnt){
    $direction = "right";
    $buffer = strlen($chars);
    $row=0;
    $col=0;
    $counter = 0;

    while(true){
        if($direction ==="right" && $col<$cnt && $arr[$row][$col] === "*"){
            $arr[$row][$col] = $chars[$counter];
            $col++;
            $counter++;
            continue;
        }
        if($direction ==="left" && $col>=0 && $arr[$row][$col] === "*"){
            $arr[$row][$col] = $chars[$counter];
            $col--;
            $counter++;
            continue;
        }
        if($direction ==="up" && $row>=0 && $arr[$row][$col] === "*"){
            $arr[$row][$col] = $chars[$counter];
            $row--;
            $counter++;
            continue;
        }
        if($direction ==="down" && $row<$cnt && $arr[$row][$col] === "*"){
            $arr[$row][$col] = $chars[$counter];
            $row++;
            $counter++;
            continue;
        }
        if($counter === strlen($chars)){
            break;
        }
//        //driver
        switch($direction){
            case "right":
                $col--;
                $direction = "down";
                $row++;
                break;
            case "left":
                $col++;
                $direction = "up";
                $row--;
                break;
            case "up":
                $row++;
                $direction = "right";
                $col++;
                break;
            case "down":
                $row--;
                $direction = "left";
                $col--;
                break;
        }
    }
    return $arr;
}
function GetNewText($arr){
    $even = "";
    $odd = "";
    for($row = 0; $row<count($arr); $row++){
        for($col = 0; $col<count($arr[$row]); $col++){
            if($row === 0 || $row%2===0){
                if(($col+2)%2===0){
                    $even.=$arr[$row][$col];
                }else{
                    $odd.=$arr[$row][$col];
                }
            }else{
                if(($col+2)%2===0){
                    $odd.=$arr[$row][$col];
                }else{
                    $even.=$arr[$row][$col];
                }
            }
        }
    }

    $result =  $even.$odd;
    return $result;
}
function checkPal($text){
    $text = strtolower(preg_replace('/[^a-z]/i', "", $text));
    $isPal = true;
    for($idx = 0; $idx<strlen($text)/2; $idx++){
        if($text[$idx] !== $text[(strlen($text)-1)-$idx]){
            $isPal = false;
            break;
        }
    }
    return $isPal;
}