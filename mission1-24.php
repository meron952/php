<?php
    $word = "apple" . PHP_EOL;
    $file = "mission_1-24.txt"; //開くファイルを指定
    $handle = fopen($file,"a"); //変数を定義してfopen関数を使い読み込みモードを指定
    fwrite($handle,$word); //fwrite関数を使ってファイルに言葉を追記
    fclose($handle); //fcloseを使ってファイルを閉じる
    echo "書き込み成功！！"
?>