<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/transmanager.class.php');

$tm = new TransManager();
if(empty($_POST["amount"])){
	die(getErrorMsg(130));
}else if(empty($_POST["transid"])){
	die(getErrorMsg(131));
}else if($tm->check($_POST["transid"])){
	die(getErrorMsg(132));
}else{
	$tm->add($_POST["transid"]);
	$uid = $xoopsUser->uid();
	$amount = intval($_POST["amount"]);
	
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_personal")." WHERE uid = ".$uid.";";
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row){
		$have_amount = intval($row["amount"]);
		if($have_amount < $amount){  //残金が足りない
			die(getErrorMsg(133));
		}else{
			$have_amount -= $amount;
			$sql = sprintf("UPDATE %s SET amount = %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $have_amount, $uid);
		}
		$res = $xoopsDB->queryF($sql);
		//insertLog($uid, "donated", $amount, $id);
		redirect_header(XOOPS_URL, 2, $amount._MD_CHARINAVI_DONATED_COMPLETED);
			
		//寄付した額がボランティア団体に渡される処理が抜けている
	}else{
		die(getErrorMsg(134));
	}
}

// D.S.G.