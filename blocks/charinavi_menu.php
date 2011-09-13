<?php
function b_charinavi_menu_show(){
	global $xoopsDB, $xoopsUser;
	if(is_object($xoopsUser)){  //ログインしている
		$uid = $xoopsUser->uid();
		$block["mode"] = is_volunteer($uid) ? "volunteer" : "common" ;
	}else{  //ログインしていない
		$block["mode"] = "guest";
	}
	
	//言語の取得
	$block['language']['menu_register'] = _MB_CHARINAVI_MENU_REGISTER;
	$block['language']['menu_exchange'] = _MB_CHARINAVI_MENU_EXCHANGE;
	
	return $block;
}

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