<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission1-27</title>
    </head>
    <body>
        <form action = "" method = "post">
            <input type = "number" name = "str">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        $str = $_POST["str"];
        
        $word1 = "Fizzbuz";
        $word2 = "Buzz";
        $word3 = "Fizz";
        
        if(!empty($str)){
            $filename = "mission_1-27.txt";
            $fp = fopen($filename,"a");
            if($str%3 == 0 && $str%5 == 0){
              
              fwrite($fp,$word1 . PHP_EOL);
            } elseif ($str%5 == 0) {
              
              fwrite($fp,$word2 . PHP_EOL);
            } elseif ($str%3 == 0) {
              
              fwrite($fp,$word3 . PHP_EOL);
            } else{
              fwrite($fp,$str);
            }
            
    
            fclose($fp);
            echo "書き込み成功！<br>";
           
            if(file_exists($filename)){
                
                $items = file($filename, FILE_IGNORE_NEW_LINES);
                
                foreach($items as $item){
                    echo $item ." ";
                    
                }
            }
        }
        //if文で値が送信されたときという条件にした
        //fwrite関数はif文のなかにも書くことができる
        //だからある条件に一致したときその条件のときに
        //追記したい文字などをfwrite関数で追記するように条件分岐
        //fileの中身を表示させるときはfile関数でファイルを開いたものを
        //変数で定義してforeach関数を使う。