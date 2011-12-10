<?php
// 
// create: 2011/11/30 14:51:54
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// 

require('../../../mainfile.php');
include_once( XOOPS_ROOT_PATH.'/include/cp_header.php' );

xoops_cp_header();

if(isset($_POST["id"])){  //承認処理
	$sql = sprintf("UPDATE %s SET authorized = 1 WHERE id = %s;",
		$xoopsDB->prefix("charinavi_volunteers"), intval($_POST["id"]));
	$res = $xoopsDB->query($sql);

}

?>
以下のボランティア団体が未承認です。

<script type="text/javascript">
function acceptVolunteer(id){
	document.form_accept.id.value = id;
	document.form_accept.submit();
}
</script>

<table width='100%' border='0' cellspacing='1' class='outer'>
<tr><th>ID</th><th>団体名 (クリックして詳細を表示)</th><th></th></tr>
<?php
$sql = sprintf("SELECT * FROM %s WHERE authorized = 0;", $xoopsDB->prefix("charinavi_volunteers"));
$res = $xoopsDB->query($sql);
$myts =& MyTextSanitizer::getInstance();
while($row = $xoopsDB->fetchArray($res)){
	printf("<tr><td class='even'>%s</td><td class='even'><a href='%s/modules/charinavi/volunteer.php?id=%s' target='_blank'>%s</a></td><td class='even'><input type='button' value='承認' onclick='acceptVolunteer(%s);' /></td></tr>", 
		intval($row["id"]), XOOPS_URL, intval($row["id"]), $myts->makeTareaData4Show($row["name"]), intval($row["id"]));
}
?>
</table>

<form name="form_accept" action="screening.php" method="POST">
<input type="hidden" name="id" value="" />
</form>

<?php
xoops_cp_footer();

// S.D.G.