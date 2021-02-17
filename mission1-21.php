<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>mission1-21</title>
    </head>
    <body>
        <form action = "" method = "post">
            <input type = "number" name = "str" placefolder = "数字を入力してください">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        $str = $_POST["str"];
        
        if($str%3 == 0 && $str%5 == 0) {  
                echo "Fizzbuz";
            } elseif($str%5 == 0){
                echo "Buzz";
            } elseif($str%3 == 0){
                echo "Fizz";
            } else {
                echo $str;
            } //入力フォームから受け取った値によってif文を使って表示内容を変えることができる
            ?>
            
            </body>