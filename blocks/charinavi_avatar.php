<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/personalmanager.class.php');

function b_charinavi_avatar_show(){
	$pm = new PersonalManager();
	$block["is_login"] = $pm->isLogin() ? 1 : 0 ;
	if($block["is_login"]){
		$block["picture_id"] = $pm->getPictureId();
		$block["name"] = $pm->getName();
		$block["amount"] = $pm->getAmount();
		
		$block["language"]["label_amount"] = _MB_CHARINAVI_AVATAR_LABEL_AMOUNT;
		$block["language"]["label_buying"] = _MB_CHARINAVI_AVATAR_LABEL_BUYING;
		$block["language"]["label_buying_do"] = _MB_CHARINAVI_AVATAR_LABEL_BUYING_DO;
	}

	return $block;
}

// D.S.G.