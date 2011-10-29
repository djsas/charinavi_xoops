<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

if(isset($_GET["v"])){
	$myts =& MyTextSanitizer::getInstance();
	$sql = sprintf("SELECT * FROM %s WHERE idname = '%s';", $xoopsDB->prefix("charinavi_categories"), $myts->makeTboxData4Save($_GET["v"]));
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row){
		$sql = sprintf("SELECT * FROM %s WHERE category_id = %s;", $xoopsDB->prefix("charinavi_activities"), intval($row["id"]));
		$res = $xoopsDB->query($sql);
		$html = "";
		$myts =& MyTextSanitizer::getInstance();
		while($row = $xoopsDB->fetchArray($res)){
			$html .= "<div><a href='activity.php?id=".intval($row["id"])."'>".$myts->makeTboxData4Show($row["name"])."</a></div>";
		}
		if($html){
			print $html;
		}else{
			print _MD_CHARINAVI_CATEGORY_MSG_NOACTIVITY;
		}
	}else{
		print _MD_CHARINAVI_CATEGORY_MSG_NOCATGORY;
	}
}else{
	print _MD_CHARINAVI_CATEGORY_MSG_NOCATEGORY;
}

include(XOOPS_ROOT_PATH.'/footer.php');
