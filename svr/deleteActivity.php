<?php
/** 
 *  cmd:    php [this]
 *  create: 2011/10/25 19:13:22
 *  import: 
 *  input:  
 *  output: 
 *  description: 
 */
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH."/modules/charinavi/include/functions.php");

if(isset($_POST["id"])){
	$id = intval($_POST["id"]);
	$sql = sprintf("DELETE FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_activities"), $id);
	$res = $xoopsDB->query($sql);
	if($res){
		redirect_header(XOOPS_URL."/modules/charinavi/myactivities.php", 2, _MD_CHARINAVI_MYACTIVITIES_LABEL_COMPLETED);
	}else{
		occurError(123, _MD_CHARINAVI_MYACTIVITIES_LABEL_INCOMPLETED);
	}
}else{
	occurError(122, _MD_CHARINAVI_MYACTIVITIES_LABEL_INCOMPLETED);
}


// D.S.G.