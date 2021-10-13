<?php
	include_once('../_conf.php');
	
	$n = $_POST['n'];
	$re = new stdclass();
	$re->status = 'ok';
	$re->win = '0';
	$time = date("s",date('U') - $_SESSION['start_time']);
	
	if(!is_numeric($n)){
		$re->status = 'error';
	}
	if(count($_SESSION['user_click']) > 4){
		$re->status = 'error';
	}
	if(in_array($n,$_SESSION['user_click']) || in_array($n,$_SESSION['ai_click'])){
		$re->status = 'error';
	}
	
	if($re->status == 'ok'){
		$_SESSION['user_click'][] = $n;
		
		$win_check = false;
		foreach($ox_answer as $k){
			$win_check2 = true;
			foreach($k as $k2){
				if(!in_array($k2,$_SESSION['user_click'])){
					$win_check2 = false;
				}
			}
			if($win_check2){
				$win_check = true;
			}
		}
		
		if($win_check){
			$re->win = 'user';
		}
		
		$re->user_click = $_SESSION['user_click'];
		$re->ai_click = $_SESSION['ai_click'];
		$re->time = $time;
	}
	
	echo json_encode($re);