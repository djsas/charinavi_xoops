<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

$uid = $xoopsUser->uid();
if(is_volunteer($uid)){
	$body = new xoopsTpl();
	$body->assign("addactivity_title", _MD_CHARINAVI_ADDACTIVITY_TITLE);
	$body->assign("name_title", _MD_CHARINAVI_ADDACTIVITY_NAME_TITLE);
	$body->assign("description_title", _MD_CHARINAVI_ADDACTIVITY_DESCRIPTION_TITLE);
	$body->assign("tags_title", _MD_CHARINAVI_ADDACTIVITY_TAGS_TITLE);
	$body->assign("submit", _MD_CHARINAVI_ADDACTIVITY_SUBMIT);
	echo $body->fetch( "db:charinavi_addactivity.html" );
	
	//一口幾らからという入力フォームも入れる？

}else{
	redirect_header(XOOPS_URL, 2, _MD_CHARINAVI_ACCESS_ERROR);
}

include(XOOPS_ROOT_PATH.'/footer.php');
