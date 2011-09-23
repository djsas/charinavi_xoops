<?php
require('../../../mainfile.php');

if($_POST["upload_photo"] && is_uploaded_file($_FILES["photo"]["tmp_name"])){
	$img = file_get_contents($_FILES["photo"]["tmp_name"]);
	$img = mysql_real_escape_string($img);
	$myts =& MyTextSanitizer::getInstance();
	$imgtype = $myts->makeTboxData4Save($_FILES["photo"]["type"]);
	
	$uid = $xoopsUser->uid();
	$sql = sprintf("SELECT * FROM %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $uid);
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row["picture_id"]){
		$sql = sprintf("UPDATE %s SET image = BINARY '%s', imagetype = '%s' WHERE id = %s;", $xoopsDB->prefix("charinavi_pictures"), $img, $imgtype, $row["picture_id"]);
		$xoopsDB->query($sql);
	}else{
		$sql = sprintf("INSERT INTO %s(image, imagetype) VALUES('%s', '%s');", $xoopsDB->prefix("charinavi_pictures"), $img, $imgtype);
		$res = $xoopsDB->query($sql);
		$picture_id = $xoopsDB->getInsertId();
		$sql = sprintf("UPDATE %s SET picture_id = %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $picture_id, $uid);
		$res = $xoopsDB->query($sql);
	}
}
redirect_header(XOOPS_URL."/modules/charinavi/personal.php", 2, _MD_CHARINAVI_PERSONAL_COMPLETED_PHOTO);