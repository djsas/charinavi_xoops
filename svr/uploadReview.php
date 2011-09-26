<?php
require('../../../mainfile.php');

if(isset($_POST["body"]) && $_POST["body"] && isset($_POST["activity_id"])){
	$uid = $xoopsUser->uid();
	$activity_id = intval($_POST["activity_id"]);
	$myts =& MyTextSanitizer::getInstance();
	$review = $myts->makeTareaData4Save($_POST["body"]);
	$star = isset($_POST["star"]) ? intval($_POST["star"]) : 0 ;
	if($star < 0 || $star > 5){
		exit("ERROR: invalid star value.");
	}
	$date = date("Y-m-d H:i:s");
	$sql = sprintf("INSERT INTO %s(activity_id, uid, review, star, created_date, modified_date) VALUES(%s, %s, '%s', %s, '%s', '%s');",
		$xoopsDB->prefix("charinavi_activity_review"), $activity_id, $uid, $review, $star, $date, $date);
	$res = $xoopsDB->query($sql);
	redirect_header(XOOPS_URL."/modules/charinavi/activity.php?id=".$activity_id, 2, _MD_CHARINAVI_ACTIVITY_REVIEW_COMPLETED);
}
redirect_header(XOOPS_URL, 2, _MD_CHARINAVI_ACCESS_ERROR);