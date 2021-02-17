<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission2-2</title>
    </head>
    <body>
        <form action = "" method = "post">
            <input type = "text" name = "str">
            <input type = "submit" name = "submit">
        </form>
        
        <?php
        $str = $_POST["str"];
        
        if($str){
            $filename = "mission_2-2.txt";
            $fp = fopen($filename,"w");
            fwrite($fp,$str . PHP_EOL);
            fclose($fp);
            
            $items = file($filename , FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                if($item == "完成"){
                    echo "おめでとう";
                } else{
                    echo $item . "<br>";
                }
                
            }
        }
        //foreachのなかにif文を組み込むことによってformである文字を
        //受け取っときに特定の値を表示させることができた。
        ?>
        
            
            
        
        
        
    </body>