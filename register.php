<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

$body = new xoopsTpl();
$body->assign("register_title", _MD_CHARINAVI_REGISTER_TITLE);
$body->assign("name_title", _MD_CHARINAVI_REGISTER_NAME_TITLE);
$body->assign("post_title", _MD_CHARINAVI_REGISTER_POST_TITLE);
$body->assign("address_title", _MD_CHARINAVI_REGISTER_ADDRESS_TITLE);
$body->assign("phone_title", _MD_CHARINAVI_REGISTER_PHONE_TITLE);
$body->assign("fax_title", _MD_CHARINAVI_REGISTER_FAX_TITLE);
$body->assign("activity_title", _MD_CHARINAVI_REGISTER_ACTIVITY_TITLE);
$body->assign("submit", _MD_CHARINAVI_REGISTER_SUBMIT);
echo $body->fetch( "db:charinavi_register.html" );

include(XOOPS_ROOT_PATH.'/footer.php');
