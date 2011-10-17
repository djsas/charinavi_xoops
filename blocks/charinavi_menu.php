<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

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
	$block['language']['menu_donation'] = _MB_CHARINAVI_MENU_DONATION;
	$block['language']['menu_personal'] = _MB_CHARINAVI_MENU_PERSONAL;
	$block['language']['menu_admin'] = _MB_CHARINAVI_MENU_ADMIN;
	
	$block['is_admin'] = 0;
	if($block["mode"] != "guest"){
		$sql = sprintf("SELECT * FROM %s WHERE groupid = 1 AND uid = %s;", $xoopsDB->prefix("groups_users_link"), $uid);
		$res = $xoopsDB->query($sql);
		while($row = $xoopsDB->fetchArray($res)){
			$block['is_admin'] = 1;
		}
	}	
	return $block;
}

// D.S.G.