<?php
require('../../mainfile.php');

if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	if(isset($_GET["x"]) && intval($_GET["x"]) > 0){
		$x = intval($_GET["x"]);
	}else{
		$x = 100;
	}
	if(isset($_GET["y"]) && intval($_GET["y"]) > 0){
		$y = intval($_GET["y"]);
	}else{
		$y = 100;
	}
	
	
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
	$res = $xoopsDB->query($sql);
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){
		$type = $myts->makeTboxData4Show($row["imagetype"]);
		$img = $row["image"];
		
		header('Content-Type: '.$type);
		$src_image = imagecreatefromstring($img);

		/*
		if($type == "image/jpeg"){
			imagejpeg($src_image, "", 100);
		}else if($type == "image/png"){
			imagepng($src_image, "", 100);
		}
		exit();
		*/
		
		$src_w = imagesx($src_image);
		$src_h = imagesy($src_image);
		$dst_w = $x;
		$dst_h = $y;
		if($src_w > $src_h){  // 横長画像の場合
			$dst_h = $src_h * ($dst_w / $src_w);
		}else{  // 縦長画像の場合
			$dst_w = $src_w * ($dst_h / $src_h);
		}
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image,$src_image,0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		
		if($type == "image/jpeg"){
			imagejpeg($dst_image, "", 100);
		}else if($type == "image/png"){
			imagepng($dst_image, "", 100);
		}
	}
}





// D.S.G.