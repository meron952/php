<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>mission_5-1</title>
    </head>
    <body>


<?php
     
    $dsn = 'mysql:dbname=tb220711db;host=localhost';//データベースに接続
	$user = 'tb-220711';
	$password = '8aJbXYhpg4';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$sql = "CREATE TABLE IF NOT EXISTS tbtest_f"//テーブルを作る
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "dt DATETIME,"
	. "pass char(32)"
	.");";
	$stmt = $pdo->query($sql);//sqlをデータベースに登録
	
	
	
	
	
	//新規投稿 

	if(!empty($_POST["name"])  && !empty($_POST["comment"]) && !empty($_POST["pass"]) && empty($_POST["editnumber"]) ){//名前とコメントとパスワードが空じゃなく、編集用の目印がないとき
	    
	    $sql = $pdo -> prepare("INSERT INTO tbtest_f (name, comment, dt, pass) VALUES (:name, :comment, :dt, :pass)");//データを登録する
    	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
    	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    	$sql -> bindParam(':dt', $dt, PDO::PARAM_STR);
    	$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
    	$name = $_POST['name'];
    	$comment = $_POST['comment']; 
    	$dt = date("Y/m/d/H:i:s");
    	$pass = $_POST['pass'];
    	$sql -> execute();
	}
	
	
	//消去
	
	if(!empty($_POST["deletenumber"]) && $_POST["depass"]){//消去番号とパスワードを受け取ったら
	    
	    $id = $_POST["deletenumber"];//idを消去番号にする
	    $depass = $_POST['depass'];//パスワードを消去用のパスワードにする
    	$sql = 'delete from tbtest_f Where id=:id and pass = :pass';//SQL文の変動箇所をプレースホルダ（:で始まる代替文字列）で指定している. そして消去番号と消去用のパスワードに一致するデータを特定　
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':id', $id, PDO::PARAM_STR);//bindValueで実際の値をプレースホルダにバインドする
    	$stmt->bindParam(':pass', $depass, PDO::PARAM_STR);//:passを$depassにしている
    	
    	$stmt->execute();
	}
	
	
	//編集の際に表示させるところ
	
	 if(!empty($_POST["edit"]) && !empty($_POST["editpass"])){//編集番号と編集用パスワードが送られたとき
	    $id = $_POST["edit"];//idを編集番号にする
	    $pass = $_POST['editpass'];//パスワードを編集用のパスワードにする
	    $sql = 'SELECT * FROM tbtest_f WHERE id=:id and pass = :pass ';//編集番号と編集用のパスワードに一致したデータを特定
        $stmt = $pdo->prepare($sql);                  // 差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); // その差し替えるパラメータの値を指定してから、
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
        	foreach ($results as $row){
        		$editnumber = $row['id'];
        		$editname = $row['name'];//編集する名前を表示
        		$editcomment = $row['comment'];//編集するコメントを表示
        	}
        	}
	
	
	
	//編集 
	

          
	    
	    if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["pass"]) && !empty($_POST["editnumber"])){//名前とコメントがあり、編集する目印があるとき
	        $id = $_POST["editnumber"]; 
        	$name = $_POST["name"];
        	$comment = $_POST["comment"]; 
        	$dt = date("Y/m/d/H:i:s");
        	$pass = $_POST['pass'];
        	$sql = 'UPDATE tbtest_f SET name=:name,comment=:comment,dt=:dt, pass=:pass WHERE id=:id  ';//id(番号)が一致したものを編集
        	$stmt = $pdo->prepare($sql);
        	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
        	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        	$stmt -> bindParam(':pass', $pass, PDO::PARAM_STR);
        	$stmt -> bindParam(':dt', $dt, PDO::PARAM_STR);
        	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
        	$stmt->execute();
        	
	        
	    }
	    
	    
    	
	
	
	
	?>

	
	
	
	

	
	 
        
         <form action = "" method = "post">
             
             <p>[投稿フォーム]</p>
             
            名前: <input type = "text" name = "name" placeholder = "名前を入力" value =
            "<?php if(!empty($editname)){  echo $editname;}?>"  ><br>
           
                 
            コメント: <input type = "text" name = "comment" placeholder = "コメントを入力" 
            value = "<?php if(!empty($editcomment)) { echo $editcomment; } ?>">
                     
             <input type = "hidden" name = "editnumber"  
             value = "<?php if(!empty($editnumber)) {echo $editnumber;} ?>">
             <br>
             パスワード： <input type = "password" name = "pass" placeholder = "パスワードを入力">
             <input type = "submit" name = "submit">
             
             
             <p>[削除フォーム]</p>
            
             削除対象番号：<input type = "number" name = "deletenumber" placeholder = "削除番号を入力" ><br>
             
             パスワード：  <input type = "password" name = "depass" placeholder = "パスワードを入力">
             <input type = "submit" name = "submit2" value = "削除">
             
             
             <p>[編集フォーム]</p>
             編集対象番号：<input type = "number" name = "edit" placeholder = "編集番号を入力"><br>
             
             パスワード：  <input type = "password" name = "editpass" placeholder = "パスワードを入力">
             <input type = "submit" name = "submit3"  value = "編集">
                 
                
             
        </form>
        <br><br>
        
         <?php
         //エラーメッセージ
	    
	    //新規投稿
	    
	    if(!empty($_POST["submit"])){
	        if(!empty($_POST["name"])){
	            if(!empty($_POST["comment"])){
	                if(!empty($_POST["pass"])){
	                    
	                } else{
	                    echo "パスワードを入力してください" . "<br>";
	                }
	            } else{
	                echo "コメントを入力してください" . "<br>";
	            }
	        } else{
	            echo "名前を入力してください" .  "<br>";
	        }
	    }
	    
	    //削除
	    
	    if(!empty($_POST["submit2"])){
        	        if(empty($_POST["deletenumber"])){
        	        echo "削除番号を入力してください" . "<br>";
        	        
        	     } elseif(empty($_POST["depass"])){
            	    echo "パスワードを入力してください" . "<br>";
            	    
            	 } else{
            	     $sql = 'SELECT * FROM tbtest_f WHERE id=:id ';//idでひとつのものに特定する、つまり消去番号とテーブルの番号が一致したもの
            	     $id = $_POST["deletenumber"];
                     $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
                     $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
                     $stmt->execute();                             // ←SQLを実行する。
                     $results = $stmt->fetchAll(); 
                    	foreach ($results as $row){
                    		if($_POST["depass"] != $row['pass']){ //消去用のパスワードと該当する投稿番号パスワードが違った場合
                    		    echo "パスワードが間違っています";
                    		}
                    	    
                    	  }
            	     }
                	 }
	    
	    
	    //編集
	    
	    if(!empty($_POST["submit3"])){
	        if(empty($_POST["edit"])){
	            echo "編集番号を入力してください" . "<br>";
	        } elseif(empty($_POST["editpass"])){
	            echo "パスワードを入力してください" . "<br>";
	        } else{
	            $sql = 'SELECT * FROM tbtest_f WHERE id=:id ';//idで編集番号とテーブルの番号が一致したものに特定する.
        	    $id = $_POST["edit"];
                $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
                $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
                $stmt->execute();                             // ←SQLを実行する。
                $results = $stmt->fetchAll(); 
                	foreach ($results as $row){
                	    if($_POST["editpass"] != $row['pass']){//編集用のパスワードと該当する投稿番号のパスワードが違った場合
                	        echo "パスワードが間違っています";
                	    }
                	}
	        }
	    }
	    
	    
	    ?>
        
        <p>投稿一覧</p>
        
        <?php
        	$sql = 'SELECT * FROM tbtest_f';//   データを抽出する
        	$stmt = $pdo->query($sql);
        	$results = $stmt->fetchAll();
        	foreach ($results as $row){
        		//$rowの中にはテーブルのカラム名が入る
        		echo $row['id'].',';//データを表示する
        		echo $row['name'].',';
        		echo $row['comment'].',';
        		echo $row['dt'].'<br>';
        		echo "<hr>";
        		
        	
        	}
        	
        	
	
	?>