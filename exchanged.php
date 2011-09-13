<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	
	//ページのreloadで再購入処理になっていないか確認
	$sql = sprintf("SELECT * FROM %s WHERE eventtype = 'exchanged' AND to_id = %s;", $xoopsDB->prefix("charinavi_log"), $id);
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	if($row){  //再購入処理であった
		print _MD_CHARINAVI_EXCHANGED_ERROR;
	}else{  //未購入
		$uid = $xoopsUser->uid();
		$sql = sprintf("SELECT * FROM %s WHERE id = %s AND uid = %s AND eventtype = 'exchange';", $xoopsDB->prefix("charinavi_log"), $id, $uid);
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchArray($res);
		if($row){
			$amount = intval($row["amount"]);
			
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
		
			$sql = sprintf("INSERT INTO %s(uid, eventtype, amount, to_id, time) VALUES(%s, 'exchanged', %s, %s, '%s');", $xoopsDB->prefix("charinavi_log"), $uid, $amount, $id, date("Y-m-d H:i:s"));
			$res = $xoopsDB->queryF($sql);
			print $amount._MD_CHARINAVI_EXCHANGED_MSG;
		}else{
			print "ERROR";
		}
	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

// D.S.G.