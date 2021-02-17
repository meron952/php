<?php
$filename = "mission_3-1.txt";
$items = file($filename); //ファイルを読み込み配列変数に代入

   
    for($i = 0; $i < count($items); $i++){
        $result = explode("<>",$items[$i] . "<br>");
        echo $result[0];
        echo $result[1];
        echo $result[2];
        echo $result[3];
    }