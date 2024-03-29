<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

$uid = $xoopsUser->uid();
$sql = sprintf("SELECT * FROM %s WHERE uid = %s;", $xoopsDB->prefix("charinavi_personal"), $uid);
$res = $xoopsDB->query($sql);
$amount = 0;
while($row = $xoopsDB->fetchArray($res)){
	$picture_id = intval($row["picture_id"]);
	$amount = intval($row["amount"]);
}

?>
<style type="text/css">
#left{ float:left; width:300px; }
#right{ float:left; }
.button{ cursor: pointer; }
.editor{
	border: 1px solid red;
	display: none;
	padding: 2px;
}
.important{
	color:blue;
	font-weight: 700;
}
.warning{ color:red; }
</style>

<script type="text/javascript">
function showEditor(id){
	var button_el = document.getElementById("button_" + id);
	var editor_el = document.getElementById("editor_" + id);
	if(editor_el.style.display == "block"){
		button_el.style.display = "block";
		editor_el.style.display = "none";
	}else{
		button_el.style.display = "none";
		editor_el.style.display = "block";
	}
}
</script>

<div id="left">

<img src="images/loadPicture.php?id=<?= $picture_id; ?>&x=150&y=150&r=25" /><img src="images/pencil24.png" id="button_1" class="button" onclick="showEditor(1);" />
<div id="editor_1" class="editor">
<div class="warning"><?= _MD_CHARINAVI_PERSONAL_EDIT_PHOTO; ?></div>
<form enctype="multipart/form-data" name="change_avater" action="svr/changeAvater.php" method="POST">
<input type="file" name="photo" />
<input type="submit" name="upload_photo" value="<?= _MD_CHARINAVI_PERSONAL_SUBMIT_PHOTO; ?>" />
<input type="button" value="<?= _MD_CHARINAVI_PERSONAL_CANCEL_PHOTO ?>" onclick="showEditor(1);" />
</form>
</div>

<h2><?= _MD_CHARINAVI_PERSONAL_LABEL_EMAIL ?></h2>
<?= $xoopsUser->email(); ?>

<h2><?= _MD_CHARINAVI_PERSONAL_LABEL_RANK; ?></h2>
<?= is_volunteer($uid) ? _MD_CHARINAVI_PERSONAL_LABEL_VOLUNTEER : _MD_CHARINAVI_PERSONAL_LABEL_COMMON; ?>

</div>  <!-- end #left //-->

<div id="right">
<h2><?= _MD_CHARINAVI_PERSONAL_LABEL_BALANCE; ?></h2>
<?= _MD_CHARINAVI_PERSONAL_MSG_BALANCE_LEFT; ?><span class="important"><?= $amount; ?></span><?= _MD_CHARINAVI_PERSONAL_MSG_BALANCE_RIGHT; ?>

<h2><?= _MD_CHARINAVI_PERSONAL_LABEL_DONATION; ?></h2>
<table>
<tr><th><?= _MD_CHARINAVI_PERSONAL_LABEL_DONATION_WHEN; ?></th><th><?= _MD_CHARINAVI_PERSONAL_LABEL_DONATION_WHERE; ?></th><th><?= _MD_CHARINAVI_PERSONAL_LABEL_DONATION_HOW; ?></th></tr>
<?php
$sql = sprintf("SELECT * FROM %s WHERE uid = %s AND eventtype = 'donated';", $xoopsDB->prefix("charinavi_log"), $uid);
$res = $xoopsDB->query($sql);
while($row = $xoopsDB->fetchArray($res)){
	$sql = sprintf("SELECT * FROM %s WHERE id = %s AND uid = %s AND eventtype = 'donate';", $xoopsDB->prefix("charinavi_log"), $row["to_id"], $uid);
	$res2 = $xoopsDB->query($sql);
	$row2 = $xoopsDB->fetchArray($res2);

	printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>".PHP_EOL, $row["time"], getVolunteerName($row2["to_id"]), $row["amount"]._MD_CHARINAVI_ACTIVITY_UNIT);
}
?>
</table>
</div>  <!-- end #right //-->

<?php
include(XOOPS_ROOT_PATH.'/footer.php');
