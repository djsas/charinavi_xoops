<?php
require('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH.'/include/cp_header.php' ) ;

$myts =& MyTextSanitizer::getInstance();
if(isset($_POST["add"]) && $_POST["add"]){
	$name = $myts->makeTboxData4Save($_POST["newcategory"]);
	$sql = sprintf("INSERT INTO %s(name) VALUES('%s');", $xoopsDB->prefix("charinavi_category"), $name);
	$res = $xoopsDB->query($sql);
}

xoops_cp_header();
?>
<style type="text/css">
td{ vertical-align :middle; }
</style>
<?php
$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_category").";";
$res = $xoopsDB->query($sql);
$flag = false;
$html = "";
while($row = $xoopsDB->fetchArray($res)){
	$flag = true;
	$name = $myts->makeTareaData4Show($row["name"]);
	if($row["image"]){
		$img = "OK";
	}else{
		$img = XOOPS_URL."/modules/charinavi/images/noimage.jpg";
	}
	$html .= sprintf('<tr><td>%s</td><td><img src="%s" /><input type="file" name="imgfile" value="" /><input type="submit" name="changeimg" value="%s" /></td><td><input type="submit" name="delete" value="%s" /></td></tr>',
		$name, $img, _MD_CHARINAVI_ADMIN_CATEGORY_CHANGEIMG_SUBMIT, _MD_CHARINAVI_ADMIN_CATEGORY_DELETE_SUBMIT);
}
if($flag){
	//OpenTable();
	print "<table width='100%' border='0' cellspacing='1' class='outer'>"
		.'<tr><th>category</th><th>image</th><th></th></tr>';
	print $html;
	print "</table>";
	//CloseTable();
}else{
	print _MD_CHARINAVI_ADMIN_CATEGORY_NONE."<br /><br />";
}

?>
<form name="addcategory" method="POST" action="category.php">
<?= _MD_CHARINAVI_ADMIN_CATEGORY_NEW_LABEL ?><input type="text" name="newcategory" value="" /><input type="submit" name="add" value="<?= _MD_CHARINAVI_ADMIN_CATEGORY_NEW_SUBMIT ?>" />
</form>

<?php
xoops_cp_footer();
