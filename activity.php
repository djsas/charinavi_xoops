<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

?>
<script type="text/javascript">
function checkForm(){
	var a = document.donation.amount.value;
	if(a.match(/^[0-9]+$/)){
		a = parseInt(a);
		if(a > 0){
			return true;
		}else{
			document.getElementById("log").innerHTML = "0�ʾ�ο��������Ϥ��Ƥ���������";
			return false;
		}
	}else{
		document.getElementById("log").innerHTML = "���������Ϥ��Ƥ���������";
		return false;
	}
}
</script>
<div id="log"></div>
<?php

$id = intval($_GET["id"]);
$sql = sprintf("SELECT * FROM %s WHERE id = %s", $xoopsDB->prefix("charinavi_activity"), $id);
$res = $xoopsDB->query($sql);
$row = $xoopsDB->fetchArray($res);
if($row === false){
	print _MD_CHARINAVI_ACTIVITY_ERROR;
}else{
	$myts =& MyTextSanitizer::getInstance();
	$name = $myts->makeTareaData4Show($row["name"]);
	$vname = $myts->makeTareaData4Show(getVolunteerName($row["vid"]));
	
	$body = new xoopsTpl();
	$body->assign("title", $name);
	$body->assign("vname", $vname._MD_CHARINAVI_ACTIVITY_VNAME_RIGHT);
	$body->assign("msg", _MD_CHARINAVI_ACTIVITY_MSG);
	$body->assign("unit", _MD_CHARINAVI_ACTIVITY_UNIT);
	$body->assign("submit", _MD_CHARINAVI_ACTIVITY_SUBMIT);
	$body->assign("volunteer_id", $id);
	echo $body->fetch("db:charinavi_activity.html");
}

include(XOOPS_ROOT_PATH.'/footer.php');
