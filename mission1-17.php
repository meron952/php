<?php
$num = 30;

if($num%3 == 0 && $num%5 == 0) {  
    echo "Fizzbuz";
} elseif($num%5 == 0){
    echo "Buzz";
} elseif($num%3 == 0){
    echo "Fizz";
} else {
    echo $num;
}

//最初にif文の処理が実行されるので、
//今回の場合だと３の倍数の処理を最初のif文にかいてelseifに15の倍数の処理を書くと
//１５の倍数でも３の倍数の処理になってしまう
//どういう処理をしたいかみきわめて数字の場合は順番が大事だと感じた。