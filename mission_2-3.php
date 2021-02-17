<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission2-3</title>
    </head>
    <body>
        <form action = "" method = "post">
            <input type = "text" name = "str">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        $str = $_POST["str"];
        $filename = "mission_2-3.txt";
        if($str){
            $fp = fopen($filename,"a");
            fwrite($fp,$str . PHP_EOL);
            fclose($fp);
        }
        
       
        
        //改行タグを使って１行ずつ改行してファイルに追記して保存することができた。
        
        ?>
    </body>