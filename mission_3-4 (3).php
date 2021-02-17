<?php
        $filename = "mission_3-4.txt";
        $items = file($filename,FILE_IGNORE_NEW_LINES);
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $editnumber = $_POST["editnumber"];
        
        if(file_exists($filename)){
            $end = end($items); //配列の最後のデータを取り出す
            $lastnumber = explode("<>",$end);
            $num = $lastnumber[0] + 1;
        } else{
            $num = 1;
        }
        $date = date("Y/m/d H:i:s");
        $result = $num ."<>" .  $name . "<>" . $comment .  "<>" . $date;
        
        $deletenumber = $_POST["deletenumber"];
        $edit = $_POST["edit"];
        
        
        if(!empty($deletenumber)){ //消去番号を受け取ったら
            $fp = fopen($filename,"w");
            for($i = 0; $i < count($items); $i++){
                $array = explode("<>",$items[$i]); //投稿番号を取得
                if($array[0] != $deletenumber){ //投稿番号と消去番号を比較
                    fwrite($fp,$items[$i] . PHP_EOL); 
                    
                }    
                
            } 
            fclose($fp);//for文の外でファイルを開いてるから
                        //for文の外で閉じる
            
        }
        
        
        if(!empty($name) && !empty($comment)){ //名前とコメントが送信されて
            if(empty($editnumber)){//編集番号がないとき
                $fp = fopen($filename,"a");
                fwrite($fp,$result . PHP_EOL);
                fclose($fp);
            }
        }
        
        
        
        
        if(!empty($edit)){ //編集番号が送信されたとき
            
            for($i = 0; $i < count($items); $i++) {
                $array = explode("<>",$items[$i]); //<>で分割
                if($edit == $array[0]){ //投稿番号と編集対象番号を比較
                    $editnumber = $array[0]; //投稿番号を取得
                    $editname = $array[1];//名前を取得
                    $editcomment = $array[2];//コメントを取得
                    
                    
                }   
            }
        } 
        
        
        
        if(!empty($name) && !empty($comment)){ //名前とコメントがあって
            if(!empty($editnumber)){ //編集番号があるとき
                    $num = $editnumber;//投稿番号を編集対象の番号にする
                    $result = $num ."<>" .  $name . "<>" . $comment .  "<>" . $date;//上書きするからもう一度
                                                                                    //書き入れるものを定義する
                    $fp=fopen($filename, "w");
                        
                        for($i = 0 ; $i < count($items); $i++ ){
                            $explode = explode ("<>", $items[$i]);
                            if($explode[0] == $editnumber){     //編集対象と投稿番号が一致したとき          
                                fwrite ($fp, $result . PHP_EOL);//先ほど定義したのを書き入れる               
                            }else{                                     
                                fwrite ($fp, $items[$i] . PHP_EOL );               
                            }
                        } fclose($fp);      
                
                       }
                    }    
                
        
        
        ?>
        <!DOCTYPE html>
       <html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission_3-4</title>
    </head>
    <body>
        
         <form action = "" method = "post">
             <input type = "text" name = "name"  value = "<?php echo $editname ?>">
             <br>
             <input type = "text" name = "comment"  value = "<?php echo $editcomment; ?>">
             <input type = "hidden" name = "editnumber" value = "<?php echo $editnumber ?>" >
             <input type = "submit" name = "submit">
             <br><br>
             <input type = "number" name = "deletenumber" placeholder = "削除番号を入力" >
             <input type = "submit" value = "削除">
             <br><br>
             <input type = "number" name = "edit" placeholder = "編集番号を入力">
             <input type = "submit"  value = "編集">
        </form>
        
    </body>
    
    
</html>