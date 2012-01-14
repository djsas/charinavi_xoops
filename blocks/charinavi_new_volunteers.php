<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

function b_charinavi_new_volunteers_show(){
	global $xoopsDB;
	$block = array();
	
	$block["volunteers"] = array();
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_volunteers")." ORDER BY id DESC LIMIT 5";
	$res = $xoopsDB->query($sql);
	$i = 0;
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){
		$block["volunteers"][$i] = array(
			"id" => intval($row["id"]),
			"name" => $myts->makeTareaData4Show($row["name"])
		);
				
		$i++;
	}
	
	return $block;
}

// D.S.G.