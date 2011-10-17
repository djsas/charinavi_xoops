<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/transmanager.class.php');

$tm = new TransManager();
if(empty($_POST["amount"])){
	die(getErrorMsg(100));
}else if(empty($_POST["transid"])){
	die(getErrorMsg(101));
}else if($tm->check($_POST["transid"])){
	die(getErrorMsg(102));
}else{
	$tm->add($_POST["transid"]);
	$uid = $xoopsUser->uid();
	$amount = intval($_POST["amount"]);
	
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_personal")." WHERE uid = ".$uid.";";
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row){
		$have_amount = intval($row["amount"]);
		$have_amount += $amount;
		$sql = sprintf("UPDATE %s SET amount = %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $have_amount, $uid);
	}else{
		$sql = sprintf("INSERT INTO %s(uid, amount) VALUES(%s, %s);", $xoopsDB->prefix("charinavi_personal"), $uid, $amount);
	}
	$res = $xoopsDB->queryF($sql);
	
	if(isset($_POST["url"])){
		redirect_header($_POST["url"], 2, $amount._MD_CHARINAVI_EXCHANGED_MSG);
	}else{
		redirect_header(XOOPS_URL, 2, $amount._MD_CHARINAVI_EXCHANGED_MSG);
	}
}

// D.S.G.