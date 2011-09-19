<?php
require('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH.'/include/cp_header.php' ) ;

xoops_cp_header();

//OpenTable();
$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_category").";";
$res = $xoopsDB->query($sql);
$flag = false;
while($row = $xoopsDB->fetchArray($res)){
	$flag = true;
}
if(!$flag){
	print "not categories";
}
//CloseTable();


xoops_cp_footer();
