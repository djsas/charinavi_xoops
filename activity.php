<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

?>
<script type="text/javascript">
function checkForm(){
	var a = document.donation.amount.value;
	if(a.match(/^[0-9]+$/)){
		a = parseInt(a);
		if(a > 0){
			return true;
		}else{
			document.getElementById("log").innerHTML = "0以上の数字を入力してください。";
			return false;
		}
	}else{
		document.getElementById("log").innerHTML = "数字を入力してください。";
		return false;
	}
}
</script>
<div id="log"></div>
<?php

$id = intval($_GET["id"]);
$sql = sprintf("SELECT * FROM %s WHERE id = %s", $xoopsDB->prefix("charinavi_activity"), $id);
$res = $xoopsDB->query($sql);
$row = $xoopsDB->fetchArray($res);
if($row === false){
	print _MD_CHARINAVI_ACTIVITY_ERROR;
}else{
	$myts =& MyTextSanitizer::getInstance();
	$name = $myts->makeTareaData4Show($row["name"]);
	$vname = $myts->makeTareaData4Show(getVolunteerName($row["vid"]));
	
	$body = new xoopsTpl();
	$body->assign("title", $name);
	$body->assign("vname", $vname._MD_CHARINAVI_ACTIVITY_VNAME_RIGHT);
	$body->assign("msg", _MD_CHARINAVI_ACTIVITY_MSG);
	$body->assign("unit", _MD_CHARINAVI_ACTIVITY_UNIT);
	$body->assign("submit", _MD_CHARINAVI_ACTIVITY_SUBMIT);
	$body->assign("volunteer_id", $id);
	echo $body->fetch("db:charinavi_activity.html");
?>

<h2><?= _MD_CHARINAVI_ACTIVITY_REVIEW_TITLE; ?></h2>
<?php
$sql = sprintf("SELECT * FROM %s WHERE activity_id = %s;", $xoopsDB->prefix("charinavi_activity_review"), $id);
$res = $xoopsDB->query($sql);
$flag = false;
while($row = $xoopsDB->fetchArray($res)){
	$flag = true;
}
if(!$flag){
	print _MD_CHARINAVI_ACTIVITY_REVIEW_NOTHING;
	print _MD_CHARINAVI_ACTIVITY_REVIEW_RECOMMEND;
} ?>

<form name="review" method="POST" action="svr/uploadReview.php">
<!-- star rating //-->
<script src="3rdparty/jquery-1.6.4.js" type="text/javascript"></script>
<script src="3rdparty/star-rating/jquery.rating.js" type="text/javascript"></script>
<link rel="stylesheet" href="3rdparty/star-rating/jquery.rating.css" type="text/css" />
<input name="star" type="radio" class="star" value="1" />
<input name="star" type="radio" class="star" value="2" />
<input name="star" type="radio" class="star" value="3" />
<input name="star" type="radio" class="star" value="4" />
<input name="star" type="radio" class="star" value="5" />
<br />
<!-- richtext editor //-->
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<textarea name="editor" style="width:650px;"></textarea>
<input type="submit" name="upload" value="<?= _MD_CHARINAVI_FORM_SUBMIT; ?>">
</form>

<?php
}
include(XOOPS_ROOT_PATH.'/footer.php');
