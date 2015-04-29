<?php
$nameIn = $_GET['list'];
$nameIn = preg_split('/\n/', $nameIn);
$names = [];
for($idx = 0; $idx<count($nameIn); $idx++){
    if(trim($nameIn[$idx]) !== ""){
        $names[$idx] = trim($nameIn[$idx]);
    }
}
$display = isset($_GET['show']);
$minLength = (int)$_GET['length'];

echo "<ul>";

foreach($names as $name){
    $result = "";
    if(strlen($name)>=$minLength){
        $result ='<li>'.htmlspecialchars($name).'</li>';
    }elseif($display){
        $result ='<li style="color: red;">'.htmlspecialchars($name).'</li>';
    }
    echo $result;
}
echo "</ul>";