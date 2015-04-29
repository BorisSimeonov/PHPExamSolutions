<?php
$input = json_decode($_GET['jsonTable']);
$wordArr = $input[0];
$keysArr = $input[1];
$maxCells = 1;

for($idx = 0; $idx<count($wordArr); $idx++){
    $newWord = "";
    for($charIdx = 0; $charIdx<strlen($wordArr[$idx]); $charIdx++){
        $char = $wordArr[$idx][$charIdx];
        if(ctype_alpha($char)){
            $x = ord(strtolower($char)) - 97;
            $s = (int)$keysArr[1];
            $k = (int)$keysArr[0];
            $m = 26;
            $newChar = chr(((($k*$x)+$s)%$m)+65);
            $newWord.=$newChar;
        }else{
            $newWord.=$char;
        }
    }
    $maxCells = max($maxCells, strlen($newWord));
    $wordArr[$idx] = $newWord;
}

$result = "<table border='1' cellpadding='5'>";
for($cnt = 0; $cnt<count($wordArr); $cnt++){
    $result.="<tr>";
        for($chars = 0; $chars<$maxCells; $chars++){
            if($chars < strlen($wordArr[$cnt])){
                $result.="<td style='background:#CCC'>".$wordArr[$cnt][$chars]."</td>";
            }else{
                $result.="<td></td>";
            }
        }
    $result.="</tr>";
}
$result.="</table>";

echo $result;