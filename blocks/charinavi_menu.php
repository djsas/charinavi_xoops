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
	$block['language']['menu_addactivity'] = _MB_CHARINAVI_MENU_ADDACTIVITY;
	
	return $block;
}

// D.S.G.