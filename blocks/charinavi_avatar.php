<?php
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/personalmanager.class.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/transmanager.class.php');

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
		$block["language"]["exchange_title"] = _MB_CHARINAVI_AVATAR_EXCHANGE_TITLE;
		$block["language"]["exchange_description"] = _MB_CHARINAVI_AVATAR_EXCHANGE_DESCRIPTION;
		$block["language"]["exchange_msg_form"] = _MB_CHARINAVI_AVATAR_EXCHANGE_MSG_FORM;
		$block["language"]["label_interror"] = _MB_CHARINAVI_AVATAR_LABEL_INTERROR;
		$block["language"]["label_stringerror"] = _MB_CHARINAVI_AVATAR_LABEL_STRINGERROR;
		
		$tm = new TransManager();
		$block["trans_id"] = $tm->get();
	}else{
		//header("Location:".XOOPS_URL."/modules/charinavi/login.php");
	}

	return $block;
}

// D.S.G.