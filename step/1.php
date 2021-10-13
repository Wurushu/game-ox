<?php
	include_once('../_conf.php');
	$tmp = $_FILES['photo']['tmp_name'];
	$type = $_FILES['photo']['type'];
	$size = $_FILES['photo']['size'];

	$re = new stdClass();
	$re->status = 'ok';
	
	if($size > 64000000){
		$re->status = 'error';
		exit(json_encode($re));
	}
	switch($type){
		case 'image/png':
			$img = imagecreatefrompng($tmp);
			break;
		case 'image/jpeg':
			$img = imagecreatefromjpeg($tmp);
			break;
		default:
			$re->status = 'error';
			exit(json_encode($re));
	}
	$qid = uniqid();
	
	$re->photo = $qid;
	
	echo json_encode($re);
	
	$img2 = imagecreatetruecolor(60,60);
	list($w,$h) = getimagesize($tmp);
	imagecopyresampled($img2,$img,0,0,0,0,60,60,$w,$h);
	imagejpeg($img2,'../uploads/'. $qid . '.jpg');