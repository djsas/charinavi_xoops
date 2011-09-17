<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

function b_charinavi_new_show(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_activity")." ORDER BY id DESC LIMIT 2";
	$res = $xoopsDB->query($sql);
	$i = 0;
	$myts =& MyTextSanitizer::getInstance();
	while($row=$xoopsDB->fetchArray($res)){
		$block["activity_name"][$i] = sprintf('<a href="%s/modules/charinavi/activity.php?id=%s">%s</a>', XOOPS_URL, $row["id"], $myts->makeTareaData4Show($row["name"]));
		//$block["activity_description"][$i] = $myts->makeTareaData4Show($row["description"]);
		$block["activity_tags"][$i] = "";
		$tags = explode(",", $row["tags"]);
		foreach($tags as $id){
			$tag = getTagName($id);
			$tag = $myts->makeTareaData4Show($tag);
			$block["activity_tags"][$i] .= sprintf('[<a href="%s/modules/charinavi/tag.php?id=%s">%s</a>] ', XOOPS_URL, $id, $tag);
		}
		
		$i++;
	}
	
	
	return $block;
}

// D.S.G.