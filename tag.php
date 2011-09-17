<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

$tag = getTagName(intval($_GET["id"]));
if($tag === false){
	print _MD_CHARINAVI_TAG_ERROR;
}else{
	$myts =& MyTextSanitizer::getInstance();
	$tag = $myts->makeTareaData4Show($tag);
	print "<h2>"._MD_CHARINAVI_TAG_TITLE_LEFT.$tag._MD_CHARINAVI_TAG_TITLE_RIGHT."</h2>";
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_activity");
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		$tag_ids = explode(",", $row["tags"]);
		if(in_array($_GET["id"], $tag_ids)){
			//sanitizing
			$id = intval($row["id"]);
			$name = $myts->makeTareaData4Show($row["name"]);
			printf('<a href="%s/modules/charinavi/activity.php?id=%s">%s</a><br />', XOOPS_URL, $id, $name);
		}
	}
}

include(XOOPS_ROOT_PATH.'/footer.php');
