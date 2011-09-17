<?php
/** 
 *  cmd:    php programs/
 *  create: 2011/09/17 11:43:32
 *  import: 
 *  input:  
 *  output: 
 *  description: 
 */

/**
 * タグIDに対応するタグ名を取得する。
 * @param int $tid タグID。
 * @return string タグ名。
 */
function getTagName($tid){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s", $xoopsDB->prefix("charinavi_tags"), $tid);
	$res = $xoopsDB->query($sql);
	while($row=$xoopsDB->fetchArray($res)){
		return $row["name"];
	}
	return false;
}

/**
 * 所属するボランティア団体のIDを取得する。
 * @param int $uid ユーザID。
 * @return int ボランティア団体ID。
 */
function getVolunteerID($uid){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE uid = '%s';", $xoopsDB->prefix("charinavi_volunteer"), $uid);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["id"];
	}
	return false;	
}

/**
 * ボランティア団体IDから団体名を取得する。
 * @param int $vid ボランティア団体ID。
 * @return int ボランティア団体名。
 */
function getVolunteerName($vid){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = '%s';", $xoopsDB->prefix("charinavi_volunteer"), $vid);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["name"];
	}
	return false;	
}

/**
 * ボランティア団体として登録されているユーザかどうか判定する。
 * @param int $uid ユーザID。
 * @return bool ボランティア団体であればtrue。でなければ、false。
 */
function is_volunteer($uid){
	global $xoopsDB;
	
	//volunteerグループのグループIDを取得する
	$sql = "SELECT * FROM ".$xoopsDB->prefix("groups")." WHERE name = 'volunteer';";
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	$gid = $row["groupid"];
	
	//volunteerグループに所属しているか確認する
	$sql = "SELECT * FROM ".$xoopsDB->prefix("groups_users_link")." WHERE groupid = ".$gid." AND uid = ".$uid.";";
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return true;
	}
	return false;
}

// D.S.G.