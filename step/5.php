<?php
	include_once('../_conf.php');
	
	$name = $_POST['name'];
	$date = date("Y-m-d");
	$time = $_POST['time'];
	$photo = str_replace("'",'`',$_POST['photo']);

	
	$pdo = new PDO('mysql:host=localhost;dbname=ox','root','');
	$pdo->exec('set names `utf8`');
	
	$pdo->exec("insert into `rank`(`name`,`game_date`,`game_time`,`photo`) values('$name','$date','$time','$photo');");

	