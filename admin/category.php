<?php
require('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH.'/include/cp_header.php' );
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

xoops_cp_header();
?>
<link href="../3rdparty/windows_js_1.3/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../3rdparty/windows_js_1.3/themes/alert.css" rel="stylesheet" type="text/css"/>
<link href="../3rdparty/windows_js_1.3/themes/alphacube.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="../3rdparty/windows_js_1.3/javascripts/prototype.js"> </script>
<script type="text/javascript" src="../3rdparty/windows_js_1.3/javascripts/effects.js"> </script>
<script type="text/javascript" src="../3rdparty/windows_js_1.3/javascripts/window.js"> </script>
<script type="text/javascript" src="../3rdparty/windows_js_1.3/javascripts/window_effects.js"> </script>
<script type="text/javascript" src="../3rdparty/windows_js_1.3/javascripts/debug.js"> </script>
<?php
$sql = sprintf("SELECT * FROM %s;", $xoopsDB->prefix("charinavi_categories"));
$res = $xoopsDB->query($sql);
$html = "";
while($row = $xoopsDB->fetchArray($res)){

}
if($html){
	print "<table>\n";
	printf("<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th>\n", 
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NAME, _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_IDNAME,
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_PICTURE, _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_ORDER,
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_BUTTONS);
	print "</table>\n";
}else{
	print "<div>"._MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NONE."</div>";
}
?>
<input type="button" value="<?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NEW; ?>" onclick="showNewCategoryForm();" />

<div id="pwc_newcategory_form" style="display:none;">
<form id="newcategory_form">
<table border="1">
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NAME; ?></td><td><input type="text" name="name" value="" /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_IDNAME; ?></td><td><input type="text" name="idname" value="" /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_PICTURE; ?></td><td><img src="<?= XOOPS_URL; ?>/modules/charinavi/images/loadPicture.php?x=70&y=70" /><br /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_ORDER; ?></td><td><input type="text" name="order" value="" /></td>
</table>
</form>
</div> <!-- id=pwd_newcategory_form //-->

<script type="text/javascript">
function checkNewCategoryForm(){
	
	return true;
}
function showNewCategoryForm(){
	Dialog.confirm($('pwc_newcategory_form').innerHTML,
		{top:10, width:400, height:300, className:"alphacube",
		okLabel:"<?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_CREATE; ?>", cancelLabel:"Cancel",
		onOk:function(win){
			var res = checkNewCategoryForm();
			if(res){
				$("newcategory_form").action = "../svr/changeCategory.php";
				$("newcategory_form").submit();
			}else{
				Windows.focusedWindow.updateHeight();
				new Effect.Shake(Windows.focusedWindow.getId());
				return false;
			}			
		}});
}
</script>

<?php
xoops_cp_footer();
