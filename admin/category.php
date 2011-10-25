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

<style type="text/css">
#categories_table td{ text-align: center; }
</style>

<?php
$sql = sprintf("SELECT * FROM %s;", $xoopsDB->prefix("charinavi_categories"));
$res = $xoopsDB->query($sql);
$html = "";
$myts =& MyTextSanitizer::getInstance();
while($row = $xoopsDB->fetchArray($res)){
	$id = intval($row["id"]);
	$name = $myts->makeTboxData4Show($row["name"]);
	$idname = $myts->makeTboxData4Show($row["idname"]);
	$picture_id = $row["picture_id"] ? "id=".intval($row["picture_id"])."&" : "" ;
	$rank = intval($row["rank"]);
	$html .= "<tr><td class='even' id='category_name_".$id."'>".$name."</td>"
		."<td class='even' id='category_idname_".$id."'>".$idname."</td>"
		."<td class='even' id='category_picture_".$id."'><img src='".XOOPS_URL."/modules/charinavi/images/loadPicture.php?".$picture_id."x=70&y=70' /></td>"
		."<td class='even' id='category_rank_".$id."'>".$rank."</td>"
		."<td class='even'><input type='button' value='"._MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_EDIT."' onclick='showEditCategoryForm(".$id.");' /><input type='button' value='"._MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_DELETE."' /></td></tr>\n";
}
if($html){
	print "<table id='categories_table' width='100%' border='0' cellspacing='1' class='outer'>\n";
	printf("<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th>\n", 
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NAME, _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_IDNAME,
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_PICTURE, _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_ORDER,
		_MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_BUTTONS);
	print $html."</table>\n";
}else{
	print "<div>"._MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NONE."</div>";
}
?>
<input type="button" value="<?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NEW; ?>" onclick="showNewCategoryForm();" />

<div id="pwc_newcategory_form" style="display:none;">
<form enctype="multipart/form-data" method="POST" id="newcategory_form">
<table border="1">
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_NAME; ?></td><td><input type="text" name="name" id="newcategory_form_name" value="" /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_IDNAME; ?></td><td><input type="text" name="idname" id="newcategory_form_idname" value="" /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_PICTURE; ?></td><td><div id="newcategory_form_picture"><img src="<?= XOOPS_URL; ?>/modules/charinavi/images/loadPicture.php?x=70&y=70" /></div><input type="file" name="picture" /></td>
<tr><td><?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_ORDER; ?></td><td><input type="text" name="rank" id="newcategory_form_rank" value="0" /></td>
</table>
<input type="hidden" id="newcategory_form_id" name="id" value="" />
</form>
<div id="newcategory_errormsg"></div>
</div> <!-- id=pwd_newcategory_form //-->

<script type="text/javascript">
function checkNewCategoryForm(){
	var name = $("newcategory_form_name").value;
	if(!name){
		showError("newcategory_form_name", "<?= _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_ERROR_NAME; ?>");
		return false;
	}

	var idname = $("newcategory_form_idname").value;
	if(!idname || !idname.match(/^[a-z0-9]+$/)){
		showError("newcategory_form_idname", "<?= _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_ERROR_IDNAME; ?>");
		return false;
	}
	
	var order = $("newcategory_form_rank").value;
	if(!order.match(/^[0-9]+$/) || isNaN(parseInt(order)) || parseInt(order) < 0){
		showError("newcategory_form_rank", "<?= _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_ERROR_ORDER; ?>");
		return false;
	}
	return true;	
}
function showError(id, msg){
	var contents = ["name", "idname", "rank"];
	for(var i=0; i<contents.length; i++){
		var tmp = "newcategory_form_" + contents[i];
		console.log(tmp);
		$(tmp).style.backgroundColor = id == tmp ? "pink" : "white" ;
	}
	$("newcategory_errormsg").innerHTML = msg;
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
	$("newcategory_form_id").value = "";
}
function showEditCategoryForm(id){
	Dialog.confirm($('pwc_newcategory_form').innerHTML,
		{top:10, width:400, height:300, className:"alphacube",
		okLabel:"<?= _MD_CHARINAVI_ADMIN_CATEGORIES_LABEL_CHANGE; ?>", cancelLabel:"Cancel",
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
	$("newcategory_form_name").value = $("category_name_"+id).innerHTML;
	$("newcategory_form_idname").value = $("category_idname_"+id).innerHTML;
	$("newcategory_form_picture").innerHTML = $("category_picture_"+id).innerHTML;
	$("newcategory_form_rank").value = $("category_rank_"+id).innerHTML;
	$("newcategory_form_id").value = id;
}
</script>

<?php
xoops_cp_footer();
