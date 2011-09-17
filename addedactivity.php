<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	global $xoopsDB, $xoopsUser;

	//空でないか確認
	if(empty($_POST["name"]) || empty($_POST["description"])){
		print _MD_CHARINAVI_FORMINPUT_ERROR;
	}else{
		$uid = $xoopsUser->uid();
		$vid = getVolunteerID($uid);
		$myts =& MyTextSanitizer::getInstance();
		$name = $myts->makeTareaData4Save($_POST["name"]);
		$description = $myts->makeTareaData4Save($_POST["description"]);
		$tags_id = getTagsID($_POST["tags"]);
		$sql = sprintf("INSERT INTO %s(vid, name, description, tags) VALUES(%s, '%s', '%s', '%s');", $xoopsDB->prefix("charinavi_activity"), $vid, $name, $description, $tags_id);
		$res = $xoopsDB->query($sql);
		
		print _MD_CHARINAVI_ADDACTIVITY_COMPLETED;
	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

function getTagsID($tags){
	global $xoopsDB;
	$myts =& MyTextSanitizer::getInstance();
	$tags = $myts->makeTareaData4Save($tags);
	$tags = explode(",", $tags);
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_tags")." WHERE ";
	for($i=0; $i<count($tags); $i++){
		if($i != 0){
			$sql .= " OR ";
		}
		$sql .= "name = '".$tags[$i]."'";
	}
	$res = $xoopsDB->query($sql);
	$ids = array();
	while($row=$xoopsDB->fetchArray($res)){
		$ids[$row["name"]] = $row["id"];
	}
	$out = array();
	foreach($tags as $tag){
		$id = array_key_exists($tag, $ids) ? $ids[$tag] : insertNewTag($tag);
		array_push($out, $id);
	}
	return implode(",", $out);
}

function insertNewTag($tag){
	global $xoopsDB;
	$sql = sprintf("INSERT INTO %s(name) VALUES('%s');", $xoopsDB->prefix("charinavi_tags"), $tag);
	$res = $xoopsDB->query($sql);
	return $xoopsDB->getInsertId();
}

// D.S.G.