<?php
require('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH.'/include/cp_header.php' );
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

$im = new ImageManager();

$myts =& MyTextSanitizer::getInstance();
if(isset($_POST["add"]) && $_POST["add"]){
	$name = $myts->makeTboxData4Save($_POST["newcategory"]);
	$sql = sprintf("INSERT INTO %s(name) VALUES('%s');", $xoopsDB->prefix("charinavi_category"), $name);
	$res = $xoopsDB->query($sql);
}

xoops_cp_header();

if(isset($_POST["id"]) && isset($_POST["type"]) && in_array($_POST["type"], array("change", "delete"))){
	$id = intval($_POST["id"]);
	if($_POST["type"] == "change" && is_uploaded_file($_FILES["imgfile_".$id]["tmp_name"])){
		$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchArray($res);
		$img = file_get_contents($_FILES["imgfile_".$id]["tmp_name"]);
		$imgtype = $_FILES["imgfile_".$id]["type"];
		if($row["picture_id"]){
			$im->update($row["picture_id"], $img, $imgtype);
		}else{
			$picture_id = $im->insert($img, $imgtype);
			$sql = sprintf("UPDATE %s SET picture_id = %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $picture_id, $id);
			$xoopsDB->query($sql);
		}
	}else if($_POST["type"] == "delete"){
		$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchArray($res);
		if($row["picture_id"]){
			$im->delete($row["picture_id"]);
		}
		$sql = sprintf("DELETE FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
		$xoopsDB->query($sql);
	}
}

?>
<style type="text/css">
td{ vertical-align :middle; }
</style>
<script type="text/javascript">
function changeImage(id, type){
	document.categories.id.value = id;
	document.categories.type.value = type;
	document.categories.submit();
}
</script>
<?php
$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_category")." ORDER BY id;";
$res = $xoopsDB->query($sql);
$flag = false;
$html = "";
while($row = $xoopsDB->fetchArray($res)){
	$flag = true;
	$id = intval($row["id"]);
	$name = $myts->makeTareaData4Show($row["name"]);
	$img = $im->getUrl($row["picture_id"], 70, 70);
	$html .= sprintf('<tr><td>%s</td><td><img src="%s" /><input type="file" name="imgfile_%s" /><input type="button" name="changeimg" value="%s" onclick="changeImage(%s, \'change\');" /></td><td><input type="button" name="delete" value="%s" onclick="changeImage(%s, \'delete\');" /></td></tr>',
		$name, $img, $id, _MD_CHARINAVI_ADMIN_CATEGORY_CHANGEIMG_SUBMIT, $id, _MD_CHARINAVI_ADMIN_CATEGORY_DELETE_SUBMIT, $id);
}
if($flag){
	//OpenTable();
	print '<form enctype="multipart/form-data" name="categories" method="POST" action="category.php">'
		."<table width='100%' border='0' cellspacing='1' class='outer'>"
		.'<tr><th>category</th><th>image</th><th></th></tr>'
		.$html
		."</table><input type='hidden' name='id' value='' /><input type='hidden' name='type' value='' /></form>";
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
