<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/personalmanager.class.php');

function b_charinavi_login_show(){
	$pm = new PersonalManager();
	$block["is_login"] = $pm->isLogin() ? 1 : 0 ;
	if($block["is_login"]){
		$block["is_admin"] = $pm->isAdmin() ? 1 : 0 ;
	}else{
	}

	return $block;
}

// D.S.G.