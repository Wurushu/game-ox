<?php
	include_once('../_conf.php');
	
	$re = new stdClass();
	$re->status = 'ok';
	$re->win = '0';
	$time = date("s",date('U') - $_SESSION['start_time'] + 1.5);
	
	do{
		$n = rand(1,9);
	}while(in_array($n,$_SESSION['user_click']) || in_array($n,$_SESSION['ai_click']));
	
	$_SESSION['ai_click'][] = $n;
	
	$win_check = false;
	foreach($ox_answer as $k){
		$win_check2 = true;
		foreach($k as $k2){
			if(!in_array($k2,$_SESSION['ai_click'])){
				$win_check2 = false;
			}
		}
		if($win_check2){
			$win_check = true;
		}
	}
	
	if($win_check){
		$re->win = 'ai';
	}
	
	$re->user_click = $_SESSION['user_click'];
	$re->ai_click = $_SESSION['ai_click'];
	$re->time = $time;
	
	echo json_encode($re);