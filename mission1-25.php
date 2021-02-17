<?php
 $word = "Hello World" . PHP_EOL;
 $filename = "mission_1-24.txt";
 $fp = fopen($filename ,"w"); //wは上書きモード
 fwrite($fp,$word);
 fclose($fp);
 echo "書き込み成功!";