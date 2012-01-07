<?php
/** 
 *  cmd:    php [this]
 *  create: 2011/10/26 10:35:48
 *  import: 
 *  input:  
 *  output: 
 *  description: 
 */

require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/volunteer.class.php');

$vol = new Volunteer();
$vol->restrict();
$vol->setUid($xoopsUser->uid());
?>

<table class="tablecloth">
<tr>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITY; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_REPORT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_VISIT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_DONATION; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_UPBEAT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIONS; ?></th>
</tr>
<?php
$sql = sprintf("SELECT * FROM %s WHERE vid = %s;", $xoopsDB->prefix("charinavi_activities"), $vol->getId());
$res = $xoopsDB->query($sql);
$myts =& MyTextSanitizer::getInstance();
while($row = $xoopsDB->fetchArray($res)){
	$id = intval($row["id"]);
	print "<tr>"
		."<td id='activity_title_".$id."'>".$myts->makeTboxData4Show($row["name"])."</td>"
		."<td><a href=''>"._MD_CHARINAVI_MYACTIVITIES_LABEL_SHOWREPORT."</a></td>"
		."<td>0</td>"
		."<td>0</td>"
		."<td>0</td>"
		."<td><input type='button' value='"._MD_CHARINAVI_MYACTIVITIES_LABEL_EDIT."' onclick='showEditActivityForm(".$id.");' /><input type='button' value='"._MD_CHARINAVI_MYACTIVITIES_LABEL_DELETE."' onclick='deleteActivity(".$id.");' /><input type='hidden' id='activity_description_".$id."' value='".$myts->makeTboxData4Show($row["description"])."' /><input type='hidden' id='activity_category_".$id."' value='".intval($row["category_id"])."' /></td>"
		."</tr>\n";
}
?>
</table>
<a href="javascript:showAddActivityForm();"><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ADD; ?>&gt;&gt;</a>

<div id="pwc_addactivity_form" style="display:none;">
<h2><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ADDACTIVITY; ?></h2>
<form id="addactivity_form" method="POST" action="svr/addedactivity.php">
<table>
<tr><th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITYTITLE; ?></th><td><input type="text" id="addactivity_form_title" name="title" value="" /></td></tr>
<tr><th>都道府県</th><td></td></tr>
<tr><th>市区町村</th><td></td></tr>
<tr><th>市区町村以降の住所</th><td></td></tr>
<tr><th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITYDESCRIPTION; ?></th><td><input type="text" id="addactivity_form_description" name="description" id="addactivity_form_category" value="" /></td></tr>
<tr><th>活動動画のURL</th><td></td></tr>
<tr><th>活動担当者の氏名</th><td></td></tr>
<tr><th>連絡先の電話番号</th><td></td></tr>
<tr><th>連絡先のFAX番号</th><td></td></tr>
<tr><th>連絡先のメールアドレス</th><td></td></tr>
<tr><th>活動時期</th><td></td></tr>
<tr><th>活動頻度</th><td></td></tr>
<tr><th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITYCATEGORY; ?></th><td><select name="category" id="addactivity_form_category"><?php
$sql = sprintf("SELECT * FROM %s ORDER BY rank", $xoopsDB->prefix("charinavi_categories"));
$res = $xoopsDB->query($sql);
$selectedId = 14;
while($row = $xoopsDB->fetchArray($res)){
	$selected = intval($row["id"]) == $selectedId ? " selected" : "";
	printf("<option value='%s'%s>%s</option>", $myts->makeTboxData4Show($row["id"]), $selected, $myts->makeTboxData4Show($row["name"]));
}
?></select></td></tr>
<tr><th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITYTAGS; ?></th><td><input type="text" id="addactivity_form_tags" name="tags" value="" /></td></tr>

<tr><th>スタッフ募集の有無</th><td></td></tr>
<tr><th>スタッフ募集の人数</th><td></td></tr>

</table>
<input type="hidden" id="addactivity_form_id" name="id" value="" />
</form>
<div id="addactivity_errormsg"></div>
</div>  <!-- end id=pwc_addactivity //-->
<script type="text/javascript">
function checkAddActivityForm(){
	var title = $("addactivity_form_title").value;
	if(!title){
		showError("addactivity_form_title", "<?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ERRORTITLE; ?>");
		return false;
	}
	
	var desc = $("addactivity_form_description").value;
	if(!desc){
		showError("addactivity_form_description", "<?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ERRORDESCRIPTION; ?>");
		return false;
	}
	
	return true;
}
function showError(id, msg){
	var contents = ["title", "description"];
	for(var i=0; i<contents.length; i++){
		var tmp = "addactivity_form_" + contents[i];
		console.log(tmp);
		$(tmp).style.backgroundColor = id == tmp ? "pink" : "white" ;
	}
	$("addactivity_errormsg").innerHTML = msg;
}
function showAddActivityForm(){
	Dialog.confirm($('pwc_addactivity_form').innerHTML, 
		{top: 10, width:400, height:300, className: "alphacube", okLabel: "<?= _MD_CHARINAVI_MYACTIVITIES_LABEL_REGISTRATION; ?>", cancelLabel:"Cancel",
		onOk: function(win){
			var res = checkAddActivityForm();
			if(res){
				$("addactivity_form").action = "svr/changeActivity.php";
				$("addactivity_form").submit();
			}else{
				Windows.focusedWindow.updateHeight();
				new Effect.Shake(Windows.focusedWindow.getId());
				return false;
			}
		}});
	$("addactivity_form_id").value = "";
}
function showEditActivityForm(id){
	Dialog.confirm($('pwc_addactivity_form').innerHTML,
		{top:10, width:400, height:300, className:"alphacube",
		okLabel:"<?= _MD_CHARINAVI_MYACTIVITIES_LABEL_CHANGE; ?>", cancelLabel:"Cancel",
		onOk:function(win){
			var res = checkAddActivityForm();
			if(res){
				$("addactivity_form").action = "svr/changeActivity.php";
				$("addactivity_form").submit();
			}else{
				Windows.focusedWindow.updateHeight();
				new Effect.Shake(Windows.focusedWindow.getId());
				return false;
			}			
		}});
	$("addactivity_form_title").value = $("activity_title_"+id).innerHTML;
	$("addactivity_form_description").value = $("activity_description_"+id).value;
	selectedChange("addactivity_form_category", $("activity_category_"+id).value);
	$("addactivity_form_id").value = id;
}
function deleteActivity(id){
	$("addactivity_form").action = "svr/deleteActivity.php";
	$("addactivity_form_id").value = id;
	$("addactivity_form").submit();
}
function selectedChange(formSelectId, itemValue){
	var objSelect = document.getElementById(formSelectId);
	var m = objSelect.length;
	var i = 0;
	for(i=0;m>i;i++){
		if(objSelect.options[i].value == itemValue){
			objSelect.options[i].selected = true;
			break;
		}
	}
}
</script>


<?php
include(XOOPS_ROOT_PATH.'/footer.php');


// D.S.G.