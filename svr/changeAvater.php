<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

$im = new ImageManager();


if($_POST["upload_photo"] && is_uploaded_file($_FILES["photo"]["tmp_name"]) && $im->isImageType($_FILES["photo"]["type"])){
	$img = file_get_contents($_FILES["photo"]["tmp_name"]);
	//$img = mysql_real_escape_string($img);  //ImageManagerで対応しているので要らない
	$myts =& MyTextSanitizer::getInstance();
	$imgtype = $myts->makeTboxData4Save($_FILES["photo"]["type"]);
	
	$uid = $xoopsUser->uid();
	$sql = sprintf("SELECT * FROM %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $uid);
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row["picture_id"]){
		$im->update($row["picture_id"], $img, $imgtype);
	}else{
		$picture_id = $im->insert($img, $imgtype);
		$sql = sprintf("UPDATE %s SET picture_id = %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $picture_id, $uid);
		$res = $xoopsDB->query($sql);
	}
}
redirect_header(XOOPS_URL."/modules/charinavi/personal.php", 2, _MD_CHARINAVI_PERSONAL_COMPLETED_PHOTO);