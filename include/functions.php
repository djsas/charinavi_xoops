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
 * volunteerグループのグループIDを取得する
 * @return int volunteerグループのID
 */
function getVolunteerGroupId(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("groups")." WHERE name = 'volunteer';";
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	return intval($row["groupid"]);
}

/**
 * 所属するボランティア団体のIDを取得する。
 * @param int $uid ユーザID。
 * @return int ボランティア団体ID。
 */
function getVolunteerId($uid){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE uid = '%s';", $xoopsDB->prefix("charinavi_volunteers"), $uid);
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
	$sql = sprintf("SELECT * FROM %s WHERE id = '%s';", $xoopsDB->prefix("charinavi_volunteers"), $vid);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["name"];
	}
	return false;	
}

/**
 * ログを作成する。
 * @param int $uid ユーザID。
 * @param string $eventtype イベントタイプ。
 * @param int $amount 寄付額などの数量
 * @return int 生成されたログID。
 */
function insertLog($uid, $eventtype, $amount, $to_id=false){
	global $xoopsDB;
	if($to_id === false){
		$sql = sprintf("INSERT INTO %s(uid, eventtype, amount, time) VALUES(%s, '%s', %s, '%s');",
			$xoopsDB->prefix("charinavi_log"), $uid, $eventtype, $amount, date("Y-m-d H:i:s"));
	}else{
		$sql = sprintf("INSERT INTO %s(uid, eventtype, amount, to_id, time) VALUES(%s, '%s', %s, %s, '%s');",
			$xoopsDB->prefix("charinavi_log"), $uid, $eventtype, $amount, $to_id, date("Y-m-d H:i:s"));
	}
	$res = $xoopsDB->queryF($sql);
	$id = $xoopsDB->getInsertId();
	return $id;
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

/**
 * エラーを発生させ、ログに残す
 * @param int $code エラー番号
 * @param string $msg リダイレクト時のエラーメッセージ
 */
function occurError($code, $msg){
	global $xoopsDB, $xoopsUser;
	$myts =& MyTextSanitizer::getInstance();

	$uid = is_object($xoopsUser) ? $xoopsUser->uid() : -1 ;
	$url = $myts->makeTboxData4Save($_SERVER['REQUEST_URI']);
	$datetime = date("Y-m-d H:i:s");
	
	$sql = sprintf("INSERT INTO %s(code, uid, url, datetime) VALUES(%s, %s, '%s', '%s');",
		$xoopsDB->prefix("charinavi_error"), $code, $uid, $url, $datetime);
	$res = $xoopsDB->queryF($sql);
	redirect_header(XOOPS_URL."/modules/charinavi/error.php?code=".$code, 2, $msg);
}

function getErrorMsg($num){  //エラーメッセージの出力
	$msg = constant("_MD_CHARINAVI_ERROR_MSG_".$num);
	return "("._MD_CHARINAVI_ERRORNUM."&rarr;".$num.')<br />'.$msg;
}

//==== デバッグ用の関数 ====
function p($a){
	if(is_array($a)){
		print_r($a);
	}else{
		print($a);
	}
}
function v($a){
	var_dump($a);
}

// D.S.G.





