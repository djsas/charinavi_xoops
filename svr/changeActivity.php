<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH."/modules/charinavi/include/functions.php");
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["category"])){
	//必要なクラスの定義
	$myts =& MyTextSanitizer::getInstance();
	
	if(!empty($_POST["id"])){
		$id = intval($_POST["id"]);
		$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_activities"), $id);
		$res = $xoopsDB->query($sql);
		if($res){
			$row = $xoopsDB->fetchArray($res);
			$activity_id = intval($row["id"]);
			//$already_picture_id = intval($row["picture_id"]);
		}else{
			$activity_id = false;
			//$already_picture_id = false;
		}
	}
	
	//画像ファイルがアップロードされていればpictureテーブルに登録する
/*
	if(is_uploaded_file($_FILES["picture"]["tmp_name"]) && $im->isImageType($_FILES["picture"]["type"])){
		$img = file_get_contents($_FILES["picture"]["tmp_name"]);
		$imgtype = $myts->makeTboxData4Save($_FILES["picture"]["type"]);
		if($already_picture_id){
			$im->update($already_picture_id, $img, $imgtype);
			$picture_id = $already_picture_id;
		}else{
			$picture_id = $im->insert($img, $imgtype);
		}
	}else{
		$picture_id = false;
	}
*/
	
	$vid = getVolunteerId($xoopsUser->uid());
	$title = $myts->makeTboxData4Save($_POST["title"]);
	$description = $myts->makeTboxData4Save($_POST["description"]);
	$category_id = intval($_POST["category"]);
	$tags_id = getTagsID($_POST["tags"]);

	if(!empty($activity_id)){
		if($tags_id){
			$sql = sprintf("UPDATE %s SET name = '%s', description = '%s', category_id = %s, tags = '%s' WHERE id = %s;",
				$xoopsDB->prefix("charinavi_activities"), $title, $description, $category_id, $tags_id, $activity_id);
		}else{
			$sql = sprintf("UPDATE %s SET name = '%s', description = '%s', category_id = %s WHERE id = %s;",
				$xoopsDB->prefix("charinavi_activities"), $title, $description, $category_id, $activity_id);
		}
	}else{
		if($tags_id){
			$sql = sprintf("INSERT INTO %s(vid, name, description, category_id, tags) VALUES(%s, '%s', '%s', %s, '%s');",
				$xoopsDB->prefix("charinavi_activities"), $vid, $title, $description, $category_id, $tags_id);
		}else{
			$sql = sprintf("INSERT INTO %s(vid, name, description, category_id) VALUES(%s, '%s', '%s', %s);",
				$xoopsDB->prefix("charinavi_activities"), $vid, $title, $description, $category_id);
		}
	}
	$res = $xoopsDB->queryF($sql);
	if($res){
		redirect_header(XOOPS_URL."/modules/charinavi/myactivities.php", 2, _MD_CHARINAVI_MYACTIVITIES_LABEL_COMPLETED);
	}else{
		occurError(121, _MD_CHARINAVI_MYACTIVITIES_LABEL_INCOMPLETED);
	}
}else{
	occurError(120, _MD_CHARINAVI_MYACTIVITIES_LABEL_COMPLETED);
}

function getTagsID($tags){
	if($tags === ""){
		return "";
	}
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