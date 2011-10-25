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
		
		
	}else{
		print _MD_CHARINAVI_CATEGORIES_MSG_NONE;
	}
}else{
	print _MD_CHARINAVI_CATEGORIES_MSG_NONE;
}

include(XOOPS_ROOT_PATH.'/footer.php');
