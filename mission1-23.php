<?php
$names = array("ken", "Alice","Judy","BOSS","Bob");
$key = "Hi! ";


    foreach($names as $name){
        if($name == "BOSS"){
    echo "Good moorning " . $name . "!". "<br>";
    } else{
        echo $key . $name . "<br>";
    }
    }
    //foreach (配列as変数)といった形式で用いる。
    //配列の全ての要素について変数の代入を繰り返す