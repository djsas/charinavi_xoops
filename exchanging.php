<?php
require('../../mainfile.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	$uid = $xoopsUser->uid();
	$amount = intval($_POST["amount"]);
	
	$sql = sprintf("INSERT INTO %s(uid, eventtype, amount, time) VALUES(%s, 'exchange', %s, '%s');", $xoopsDB->prefix("charinavi_log"), $uid, $amount, date("Y-m-d H:i:s"));
	$res = $xoopsDB->query($sql);
	$id = $xoopsDB->getInsertId();
	header("Location:exchanged.php?id=".$id);
}else{
	header("Location:exchange.php");
}

// D.S.G.