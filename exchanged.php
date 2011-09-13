<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	$uid = $xoopsUser->uid();
	$amount = intval($_POST["amount"]);
	
	//ページのreloadで再購入処理になっていないか確認処理
	if(isset($_SESSION["exchanged_id"]) && is_already_exchanged($_SESSION["exchanged_id"])){
		print _MD_CHARINAVI_EXCHANGED_ERROR;
	}else{
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
		$res = $xoopsDB->query($sql);
		
		$sql = sprintf("INSERT INTO %s(uid, eventtype, amount, time) VALUES(%s, 'exchanged', %s, '%s');", $xoopsDB->prefix("charinavi_log"), $uid, $amount, date("Y-m-d H:i:s"));
		//print $sql;
		$res = $xoopsDB->query($sql);
		$_SESSION["exchanged_id"] = $xoopsDB->getInsertId();
		
		print $_POST["amount"]._MD_CHARINAVI_EXCHANGED_MSG;
	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

function is_already_exchanged($sid){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_log"), $_SESSION["exchanged_id"]);
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	return $row ? true : false;
}

// D.S.G.