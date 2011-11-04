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
<?php
$id = intval($_GET["id"]);
$sql = sprintf("SELECT * FROM %s WHERE id = %s", $xoopsDB->prefix("charinavi_activities"), $id);
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
	$tm = new TransManager();
	$body->assign("trans_id", $tm->get());
	echo $body->fetch("db:charinavi_activity.html");
	
	$xoopsTpl->assign('xoops_pagesubtitle', $name);
?>
<div id="log"></div>

<h2><?= _MD_CHARINAVI_ACTIVITY_REVIEW_TITLE; ?></h2>
<?php
$sql = sprintf("SELECT * FROM %s WHERE activity_id = %s ORDER BY id DESC;", $xoopsDB->prefix("charinavi_activity_review"), $id);
$res = $xoopsDB->query($sql);
$starstr = "";
while($row = $xoopsDB->fetchArray($res)){
	$usr = new $xoopsUser(intval($row["uid"]));
	$activity_id = $row["id"];
	$starstr .= $activity_id.",".intval($row["star"]).",";
?>
<div><?= $usr->uname(); ?><?= _MD_CHARINAVI_ACTIVITY_REVIEW_UNAME_RIGHT; ?> (<?= _MD_CHARINAVI_ACTIVITY_REVIEW_DATE_RIGHT.$row["modified_date"]; ?>)</div>
<span id="starspan_<?= $activity_id; ?>">
<input name="star_<?= $activity_id; ?>" type="radio" class="star" value="1" />
<input name="star_<?= $activity_id; ?>" type="radio" class="star" value="2" />
<input name="star_<?= $activity_id; ?>" type="radio" class="star" value="3" />
<input name="star_<?= $activity_id; ?>" type="radio" class="star" value="4" />
<input name="star_<?= $activity_id; ?>" type="radio" class="star" value="5" />
</span>
<div><?= htmlspecialchars_decode($myts->makeTareaData4Show($row["review"])); ?></div>
<br />

<?php }
if($starstr){
	print _MD_CHARINAVI_ACTIVITY_REVIEW_RECOMMEND2;
}else{
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
<script type="text/javascript">
bkLib.onDomLoaded(nicEditors.allTextAreas);

window.onload = function(){
	var starstr = "<?= $starstr; ?>";
	var s = starstr.split(",");
	for(var i=0; i<s.length; i+=2){
		if(s[i]){
			var selector = "#starspan_"+s[i]+" input";
			//console.log(selector);
			$(selector).rating("select", s[i+1]);
			$(selector).rating("readOnly", true);
		}
	}
}

function htmlspecialchars(ch) {
    ch = ch.replace(/&/g,"&amp;") ;
    ch = ch.replace(/"/g,"&quot;") ;
    ch = ch.replace(/'/g,"&#039;") ;
    ch = ch.replace(/</g,"&lt;") ;
    ch = ch.replace(/>/g,"&gt;") ;
    return ch ;
}
function sendReview(){
	//var myNicEditor = new nicEditor();
	//myNicEditor.addInstance('editor');
	document.review.body.value = htmlspecialchars(nicEditors.findEditor('editor').getContent());
	//console.log(nicEditors.findEditor('editor').getContent());
	document.review.submit();
}
</script>
<textarea name="editor" id="editor" style="width:650px;"></textarea>
<input type="button" name="upload" value="<?= _MD_CHARINAVI_FORM_SUBMIT; ?>" onclick="sendReview();" />
<input type="hidden" name="activity_id" value="<?= $id; ?>" />
<input type="hidden" name="body" value="" />
</form>

<?php
}
include(XOOPS_ROOT_PATH.'/footer.php');
