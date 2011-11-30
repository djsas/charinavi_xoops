<?php

include '../../../include/cp_header.php';
if ( file_exists("../language/".$xoopsConfig['language']."/modinfo.php") ) {
	include_once "../language/".$xoopsConfig['language']."/modinfo.php";
} else {
	include_once "../language/english/modinfo.php";
}
if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include_once "../language/".$xoopsConfig['language']."/main.php";
} else {
	include_once "../language/english/main.php";
}
include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH."/class/xoopslists.php";
$myts =& MyTextSanitizer::getInstance();

xoops_cp_header();

$mid = $xoopsModule -> getVar( 'mid' );
$x_url = XOOPS_URL;
$general = _PREFERENCES;

echo "<h4>"._MD_CHARINAVI_ADMIN."</h4>";

echo"<table width='100%' border='0' cellspacing='1' class='outer'>";
echo "<tr class=\"odd\"><td>";
//echo " - <a href='$x_url/modules/system/admin.php?fct=preferences&op=showmod&mod=$mid'>".$general."</a><br />\n";
echo " - <a href='$x_url/modules/charinavi/admin/screening.php'>"._MD_CHARINAVI_ADMIN_SCREENING_TITLE."</a><br />\n";
echo " - <a href='$x_url/modules/charinavi/admin/category.php'>"._MD_CHARINAVI_ADMIN_CATEGORY_TITLE."</a><br />\n";
echo "</td></tr>";
echo "</table>";


xoops_cp_footer();


?>
