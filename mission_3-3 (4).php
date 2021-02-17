<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission3-3</title>
    </head>
    <body>
        <form action = "mission_3-3.php" method = "post">
            <input type = "text" name = "name"> 
            <input type = "text" name = "comment"> 
            <input type = "submit" name = "submit">
            <br><br>
            <input type = "number" name = "number" placeholder = "削除番号の入力">
            <input type = "submit" value = "削除">
        </form>
        
        <?php
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        $filename = "mission_3-3.txt";
        $item = file($filename,FILE_IGNORE_NEW_LINES);
        
        if(file_exists($filename)){          
                $end=end($item);//endで最後の項目を取り出す                
                $lastnumber=explode("<>", $end);   //投稿番号を取得
                $num = $lastnumber[0] + 1;
            }else{                             
                $num = 1;                       
            }    
        
        $result = $num . "<>" . $name . "<>" . $comment . "<>" . $date;
       
        $deletenumber = $_POST["number"];
        
        
        
        if($deletenumber){ //消去番号を受け取ったら
            $fp = fopen($filename,"w");//wは既存のファイルを初期化してから書き込む
            for($i = 0; $i < count($item); $i++){
                $array = explode("<>",$item[$i]); //投稿番号を取得
                if($array[0] != $deletenumber){ //投稿番号消去番号を比較
                    fwrite($fp,$item[$i] . PHP_EOL); 
                    
                }    
                
            } 
            fclose($fp);
            
        } elseif($name && $comment) { //名前とコメントが送信されたとき
                $fp = fopen($filename,"a");
                fwrite($fp,$result . PHP_EOL);
                fclose($fp);
                
        } 
       
        
        
        
        
        ?>
        </body>
        </html>