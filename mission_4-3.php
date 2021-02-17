<?php
    $dsn = 'mysql:dbname=tb220711db;host=localhost';
	$user = 'tb-220711';
	$password = '8aJbXYhpg4';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";