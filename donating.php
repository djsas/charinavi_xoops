<?php
require('../../mainfile.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	$uid = $xoopsUser->uid();
	$amount = intval($_POST["amount"]);
	$volunteer_id = intval($_POST["volunteer_id"]);
	$id = insertLog($uid, "donate", $amount, $volunteer_id);
	header("Location:donated.php?id=".$id);
}else{
	redirect_header(XOOPS_URL, 2, _MD_CHARINAVI_ACCESS_ERROR);
}

// D.S.G.