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
	$sql = sprintf("DELETE FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_categories"), $id);
	$res = $xoopsDB->query($sql);
	if($res){
		redirect_header(XOOPS_URL."/modules/charinavi/admin/category.php", 2, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_COMPLETED);
	}else{
		occurError(113, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_INCOMPLETED);
	}
}else{
	occurError(112, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_INCOMPLETED);
}


// D.S.G.