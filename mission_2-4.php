<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission2-4</title>
    </head>
    <body>
        <form action = "" method = "post">
            <input type = "text" name = "str">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        $str = $_POST["str"];
        $filename = "mission_2-4.txt";
        $fp = fopen($filename,"a");
        fwrite($fp,$str . PHP_EOL);
        fclose($fp);
        
        $items = file($filename); //ファイルを１行ずつ読み込み配列変数に代入
        foreach($items as $item){
            echo $item . "<br>";
        }