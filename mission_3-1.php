<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-1</title>
    </head>
    
    <body>
        <form action = "" method = "post">
            <input type = "text" name = "name" placeholder = "名前を入力">
            <input type = "text" name = "comment" placeholder = "コメントを入力">
            <input type = "submit" name = "submit">
            
        </form>
        
        <?php
        
            $filename = "mission_3-1.txt";
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $date = date("Y/m/d H:i:s" );
            $number = count(file($filename)) + 1; //投稿番号 countで配列の数を数える
            $result = $number ."<>" .   $name . "<>" . $comment . "<>" . $date;
            
            
            
            if($name){
                $fp = fopen($filename,"a");
                fwrite($fp,$result . PHP_EOL);
                fclose($fp);
            }
            
                
            

                
            
            
            
            
        
        
        
        ?>
    </body>
    
</html>