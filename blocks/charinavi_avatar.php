<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/personalmanager.class.php');

function b_charinavi_avatar_show(){
	$pm = new PersonalManager();
	$block["is_login"] = $pm->isLogin() ? 1 : 0 ;
	if($block["is_login"]){
		$block["picture_id"] = $pm->getPictureId();
		$block["name"] = $pm->getName(); 
	}

	return $block;
}

// D.S.G.