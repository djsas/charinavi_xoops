<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

if(isset($_GET["code"]) && defined("_MD_CHARINAVI_ERROR_MSG_".$_GET["code"])){
	print constant("_MD_CHARINAVI_ERROR_MSG_".$_GET["code"]);
}else{
	print _MD_CHARINAVI_PERSONAL_MSG_NOCODE;
}
include(XOOPS_ROOT_PATH.'/footer.php');