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